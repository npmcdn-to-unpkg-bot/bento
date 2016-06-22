@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

@section('title') Главная @endsection
@section('meta-title') @endsection
@section('meta-desctiption') @endsection

@section('content')
	<div class="container">
		<div class="title">
			<span class="title__text">НОВИНКИ ОТ <strong>BENTO</strong></span>
		</div>
		@include('general.product.list',['products' => App\Models\Product::orderBy('created_at')->take(6)->get()])
	</div>

	@include('general.block.visitus')

	@include('general.block.howwework')

	<div class="container-fluid container-fluid_lightgray">
		<div class="container">
			<div class="row">
				<div class="row__col-9 row__col-mob-12">
					@include('general.article.slider',[
						'articles'=> App\Models\News\Article::orderBy('created_at')->take(3)->get(),
						'title' => 'НОВОСТИ И АКЦИИ'
					])
				</div>
				<div class="row__col-3 row__col-mob-12">
					@include(Agent::isMobile() ? 'general.article.slider' : 'general.article.block',[
						'articles'=> App\Models\Blog\Article::orderBy('created_at')->take(3)->get(),
						'title'=>'БЛОГ',
						'url'=>url('blog')
					])
				</div>
			</div>
		</div>
	</div>

	@include('general.block.advantages')

	@include('general.review.slider')

	<div class="container">
		<div class="title">
			<div class="title__text">ДОСТАВКА</div>
		</div>
			<div class="deliver">
				<img src="img/deliver.jpg" alt="" class="deliver__image">
				<div class="deliver__title">Доставка ваших любимых блюд по Одессе</div>
				<div class="deliver__text">
					С другой стороны постоянный количественный рост и сфера нашей 
					активности требуют от нас анализа систем массового участия. Не следует, 
					однако забывать, что реализация намеченных плановых заданий позволяет 
					оценить значение позиций, занимаемых участниками в отношении поставленных 
					задач. 
					<br><br>
					Таким образом укрепление и развитие структуры позволяет выполнять 
					важные задания по разработке системы обучения кадров, соответствует 
					насущным потребностям. Идейные соображения высшего порядка, а также 
				</div>
				<a href="" class="deliver__more button button_red">ПОДРОБНЕЕ</a>
			</div>
		</div>
	</div>
@endsection