<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Models\Cart;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'account';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    public function sendFailedLoginResponse()
    {
        return response()->json([
            'email'=>['Неверные имя пользователя и пароль']
        ], 422);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $cart = Cart::get();

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            if ($cart){
                auth()->user()->cart()->delete();
                $cart->hash = '';
                $cart->user_id = auth()->id();
                $cart->save();
            }
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function authenticated () {
        return response()->json([
            'redirect'=>redirect()->intended($this->redirectPath())->getTargetUrl()
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required|max:255',
            'place' => 'required|max:255'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'place' => $data['place'],
            'trafic_source' => $data['trafic_source'],
            'bento_card' => $data['bento_card'],
            'password' => bcrypt($data['password'])
        ]);

        if ( $cart = Cart::get() ){
            $cart->hash = '';
            $cart->user_id = $user->id;
            $cart->save();
        }

        return $user;
    }

    public function ulogin (Request $request) {

        $uLogin = json_decode(
            file_get_contents('http://ulogin.ru/token.php?token=' . $request->uToken . '&host=' . $_SERVER['HTTP_HOST']),
            true
        );

        $user = User::firstOrNew(['email'=>$uLogin['email']]);
        $user->{$uLogin['network']} = $uLogin['profile'];

        if (!$user->first_name)
            $user->first_name = $uLogin['first_name'];

        if (!$user->last_name)
            $user->last_name = $uLogin['last_name'];

        if (!$user->image) {
            $user->image = public_path('files/uploads/') . time() . '-' . str_slug($user->last_name).'.jpg';
            \Image::make($uLogin['photo_big'])->save($user->image);
        }

        $user->save();

        if ( $cart = Cart::get() ){
            $user->cart()->delete();
            $cart->hash = '';
            $cart->user_id = $user->id;
            $cart->save();
        }

        auth()->login($user, $remember = true);


        return redirect()->intended($this->redirectPath());
    }
}
