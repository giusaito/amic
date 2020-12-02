@extends('Frontend.Layout.amic')
@section('title', $article->title)
@section('content')
	<div class="root">
  	@include('Frontend.Layout.Includes.header')
  		<div class="container">
		    <div class="row">
				<div class="col-12">
					<hgroup>
						<h1 class="font-weight-bold">{{$article->title}}</h1>
						<h5>{{$article->description}}</h5>
						<h6 class="info-published">Publicado em  <i class="far fa-calendar-alt"></i> 04/11/1992 às <i class="far fa-clock"></i> 08:32 por <i class="fas fa-user-circle"></i> AMIC | ECONOMIA</h6>
					</hgroup>
					@if($article->video)
						<div class="embed-responsive embed-responsive-21by9">
							{!! $article->video !!}
						</div>
					@elseif($article->image)
					<figure>
						<img src="{{asset('storage')}}/{{$article->path}}1200x380-{{$article->image}}" class="img-fluid"> 
						@if($article->author_photo)
						<figcaption><small><i>Fotografia: {{$article->author_photo}}</i></small></figcaption>
						@endif
						</figure>
					@endif
				</div>
			</div>
  			<div class="row">
  				<div class="col-9">
					<div class="share">
						<a class="btn"><i class="fab fa-facebook-f"></i></a>
						<a class="btn ml-3"><i class="fab fa-twitter"></i></a>
						<a class="btn ml-3"><i class="fas fa-envelope"></i></a>
						<a class="btn ml-3"><i class="fab fa-whatsapp"></i></a>
					</div>
					<div class="content mt-5">
						{!! $article->content !!}
					</div>
					@if($article->photos)
						@include('Frontend.Article.Themes.Includes.photos')
					@endif
  				</div>
				<div class="col-3 mt-5">
					<p class="text-center">Publicidade</p>
					<img src="http://via.placeholder.com/300x250">
				</div>
  			</div>
  		</div>
   	@include('Frontend.Layout.Includes.footer')
	</div>
@endsection

<style>

.share a {
    background: #fb6629;
    color: #fff;
    /* border-radius: 72%; */
    font-size: 1em;
    width: 100;
    border-radius: 50%;
    width: 40px;
    height: 40px;
}

.share a i {
	margin-top:3px;
}
</style>