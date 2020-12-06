<?php
/*
 * Projeto: amic
 * Arquivo: index.blade.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 01/12/2020 11:22:56 am
 * Last Modified:  01/12/2020 11:23:25 am
 * Modified By: Leonardo Nascimento - <leonardo.nascimento21@gmail.com> / MAC OS
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Leo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */


?>
@extends('Frontend.Layout.amic')
@section('title', $article->title)
@section('content')
@include('Frontend.Layout.Includes.header')
	<section id="model-2">
  		<div class="bg-model-2">
  			<div class="container">
  				<div class="row">
					<div class="col-xs-12 col-lg-5">
						@if($article->video)
							<div class="embed-responsive embed-responsive-16by9">
								{!! $article->video !!}
							</div>
						@elseif($article->image)
							<figure>
								<img src="{{asset('storage')}}/{{$article->path}}500x300-{{$article->image}}" class="img-fluid"> 
								@if($article->author_photo)
								<figcaption><small><i>Fotografia: {{$article->author_photo}}</i></small></figcaption>
								@endif
							</figure>
						@endif
					</div>
					<div class="col-xs-12 col-lg-7">
						<hgroup class="article-title">
							<h1>{{$article->title}}</h1>
							<h4>{{$article->description}}</h4>
							<h6 class="info-published">Publicado em 
								<i class="far fa-calendar-alt"></i>
								{{date('d/m/Y', strtotime($article->published_at))}} às 
								<i class="far fa-clock"></i> 
								{{date('H:m', strtotime($article->published_at))}} por
								<i class="fas fa-user-circle"></i> 
								{{$article->user->name}} |
								{{$article->editorias[0]->title}}
							</h6>
						</hgroup>
					</div>
				</div>
  			</div>
  		</div>
  		<div class="container">
  			<div class="row">
  				<div class="col-xs-12 col-lg-8">
					@include('Frontend.Article.Themes.Includes.share')
					<div class="article-content mt-5">
						{!! $article->content !!}
						@if($article->font)
							<small><i>Fonte: {{$article->font}}</i></small>
						@endif
					</div>
					@if($article->photos)
						<div class="pt-2 pb-3">
							@include('Frontend.Article.Themes.Includes.photos')
						</div>
					@endif
						@include('Frontend.Article.Themes.Includes.newsletter')
  				</div>
				<div class="col-xs-12 col-lg-4 mt-5">
					@include('Frontend.Article.Themes.Includes.ads')
					@if(isset($relateds))
						@include('Frontend.Article.Themes.Includes.related')
					@endif
				</div>
  			</div>
  		</div>
		@if($services)
			@include('Frontend.Article.Themes.Includes.services')
		@endif
	</section>
@include('Frontend.Layout.Includes.footer')
@endsection

