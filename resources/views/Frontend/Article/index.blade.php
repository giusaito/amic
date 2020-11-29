@extends('Frontend.Layout.amic')
@section('title', $article->title)
@section('content')
	<div class="root">
  	@include('Frontend.Layout.Includes.header')
  		<div class="container">
  			<div class="row">
  				<div class="col-9">
  					<hgroup>
  						<h1>{{$article->title}}</h1>
  						<h5>{{$article->description}}</h5>
  					</hgroup>
  					<p class="content">
  						{{$article->content}}
  					</p>
  					<div class="tags">
  						tags
  					</div>
  					<div class="photos">
  						galeria de fotos
  					</div>
  				</div>
  				<div class="col-3">
  					<small>Publicidade</small>
  				</div>
  			</div>
  		</div>
   	@include('Frontend.Layout.Includes.footer')
	</div>
@endsection
