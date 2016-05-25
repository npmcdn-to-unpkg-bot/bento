<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Image;

class ImageController extends Controller
{

	protected $lifetime = 12000;

    public function fit ($width, $height, Request $request) {

    	$path = $request->image;

		$source = Image::cache( function($image) use ($width,$height,$path) {

    		$image->make($path);
	    	$image->fit($width,$height, function($constraint) {
		   			$constraint->upsize();
		   		});

		}, $this->lifetime);

		$image = Image::make($source);

    	return $image->response();
    }

    public function resize ($width, $height, Request $request) {

    	$path = $request->image;
		$source = Image::cache( function($image) use ($width,$height,$path) {

	        $image->make($path);
	        $image->resize($width,$height,function ($constraint) {
			    $constraint->aspectRatio();
			    $constraint->upsize();
			});
			$image->resizeCanvas($width, $height, 'center', false, 'rgba(255,255,255,0)');
		}, $this->lifetime);

		$image = Image::make($source);
		
    	return $image->response();
    }


    public function width ($width, Request $request) {

    	$path = $request->image;

		$source = Image::cache( function($image) use ($width,$path) {

			$image->make($path);
	        $image->resize($width,null,function ($constraint) {
			    $constraint->aspectRatio();
			    $constraint->upsize();
			});

		}, $this->lifetime);

		$image = Image::make($source);
		
    	return $image->response();
    }

    public function height ($height, Request $request) {

    	$path = $request->image;

		$source = Image::cache( function($image) use ($height,$path) {

			$image->make($path);
	        $image->resize(null,$height,function ($constraint) {
			    $constraint->aspectRatio();
			    $constraint->upsize();
			});

		}, $this->lifetime);

		$image = Image::make($source);
		
    	return $image->response();
    }

    public function greyscale (Request $request) {

    	$path = $request->image;

		$source = Image::cache( function($image) use ($path) {

    		$image->make($path);
	    	$image->greyscale()->brightness(-35);

		}, $this->lifetime);

		$image = Image::make($source);

    	return $image->response();
    }

}
