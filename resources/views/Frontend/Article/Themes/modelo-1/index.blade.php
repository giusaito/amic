@extends('Frontend.Layout.amic')
@section('title', $article->title)
@section('content')
	<div class="root">
  	@include('Frontend.Layout.Includes.header')
  		<div class="container">
		    <div class="row">
				<div class="col-12">
					<hgroup class="article-title">
						<h1>{{$article->title}}</h1>
						<h4>{{$article->description}}</h4>
						<h6 class="info-published">Publicado em <i class="far fa-calendar-alt"></i> {{date('d/m/Y', strtotime($article->published_at))}} às <i class="far fa-clock"></i> {{date('H:m', strtotime($article->published_at))}} por <i class="fas fa-user-circle"></i> {{$article->user->name}} | ECONOMIA</h6>
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
						<div class="pt-2 pb-3">
							@include('Frontend.Article.Themes.Includes.photos')
						</div>
					@endif
						@include('Frontend.Article.Themes.Includes.newsletter')
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
.article-title h1 {
	font-family: louis_george_cafebold, sans-serif;
}

.article-title h4, .article-title h6{
	margin-top:12px;
}

.newsletter {
	background-image: url(https://i.imgur.com/FB4KXfB.jpg);
	width: 100%;
	height: 250px;
	background-size:cover;
}

.newsletter h1 {
	color:#fff !important;
}

.newsletter i {
	color: #f27a28;
}

.btn-amic { 
  color: #FFFFFF !important; 
  background-color: #FB6629 !important;  
  border-color: #FB6629 !important; 
} 
 
.btn-amic:hover, 
.btn-amic:focus, 
.btn-amic:active, 
.btn-amic.active, 
.open .dropdown-toggle.btn-amic { 
  color: #FFFFFF !important; 
  background-color: #000000 !important; 
  border-color: #000000 !important;
} 
 
.btn-amic:active, 
.btn-amic.active, 
.open .dropdown-toggle.btn-amic { 
  background-image: none; 
} 
 
.btn-amic.disabled, 
.btn-amic[disabled], 
fieldset[disabled] .btn-amic, 
.btn-amic.disabled:hover, 
.btn-amic[disabled]:hover, 
fieldset[disabled] .btn-amic:hover, 
.btn-amic.disabled:focus, 
.btn-amic[disabled]:focus, 
fieldset[disabled] .btn-amic:focus, 
.btn-amic.disabled:active, 
.btn-amic[disabled]:active, 
fieldset[disabled] .btn-amic:active, 
.btn-amic.disabled.active, 
.btn-amic[disabled].active, 
fieldset[disabled] .btn-amic.active { 
  background-color: #FB6629; 
  border-color: #FB6629; 
} 
 
.btn-amic .badge { 
  color: #FB6629; 
  background-color: #FFFFFF; 
}
</style>