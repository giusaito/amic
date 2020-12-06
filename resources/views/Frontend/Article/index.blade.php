@extends('Frontend.Layout.amic')

@section('title', 'Últimas notícias página' . $articles->currentPage())
@section('content')
@include('Frontend.Layout.Includes.header')

<section id="bg-dark-amic"></section>

<section id="page-title-news">
   <div class="container">
      <h1 class="text-center">
     	<strong>
     		<i class="fa fa-newspaper"></i>
     		Notícias
     	</strong>
  	</h1>
   </div>
</section>

<section id="page-news" class="pb-5">
	<div class="container">
		<div class="row">
			@foreach($articles as $article)
				<div class="col-xs-12 col-md-4 mt-3">
					<a href="{{route('frontend.article.view', ['id' => $article->id, 'slug' => $article->slug])}}">
						<figure>
							@if($article->image)
								<img src="{{asset('storage')}}/{{$article->path}}500x300-{{$article->image}}" class="img-fluid">
							@else
								<img src="https://via.placeholder.com/500x300.png?text=AMIC" class="img-fluid">
							@endif
						</figure>
					</a>
				</div>
				<div class="col-xs-12 col-md-8 mt-3">
					<a href="{{route('frontend.article.view', ['id' => $article->id, 'slug' => $article->slug])}}">
						<hgroup>
							<h3><strong>{{$article->title}}</strong></h3>
							<h5 class="mt-2">{{$article->description}}</h5>
							<h6 class="info-published font-weight-bolder">
								@if(isset($articles->editorias[0]))
									{{$article->editorias[0]->title}}
								@endif
								<i class="far fa-calendar-alt"></i>
								{{date('d/m/Y', strtotime($article->published_at))}} 
								<i class="far fa-clock"></i>
									às 
								{{date('H:m', strtotime($article->published_at))}}
							</h6>
						</hgroup>
					</a>
				</div>
			@endforeach
		</div>
	</div>
	<div class="container">
		<div class="row">
		  @if ($articles->hasPages())
			  <ul class="pagination" role="navigation">
			    @if ($articles->onFirstPage())
			    	<li class="disabled page-item active"><span class="page-link link-previous-edt">‹ Anterior</span></li>
			    @else
			    	<li>
			    		<a href="{{ $articles->previousPageUrl() }}" rel="prev" class="page-link link-previous-edt">‹ Anterior</a>
			    	</li>
			    @endif
			    @foreach(range(1, $articles->lastPage()) as $i)
			    	@if($i >= $articles->currentPage() - 1 && $i <= $articles->currentPage() + 1)
			    		@if ($i == $articles->currentPage())
			    			<li class="page-item active">
			    				<span class="page-link">{{ $i }}</span>
			    			</li>
			    		@else
			    			<li>
			    				<a href="{{ $articles->url($i) }}" class="page-link">{{ $i }}</a>
			    			</li>
			    		@endif
			    	@endif
			    @endforeach
			    @if ($articles->hasMorePages())
			    	<li>
			    		<a href="{{ $articles->nextPageUrl() }}" rel="next" class="page-link">Próximo ›</a>
			    	</li>
			    @else
			    	<li class="disabled page-item active">
			    		<span class="page-link">Próximo ›</span>
			    	</li>
			    @endif
			  </ul>
		  @endif
		</div>
	</div>
</section>
@include('Frontend.Layout.Includes.footer')
@endsection

@section('css')
<style type="text/css">
	#bg-dark-amic {
		background-color: #000000;
		width: 100%;
		height: 10px;
	}
	#page-title-news {
		background-color: #eef2f6;
		padding: 20px;
		margin-bottom: 80px;
	}

	#page-title-news i {
		color: orange;
	}
</style>
@endsection