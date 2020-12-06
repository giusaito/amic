@extends('Frontend.Layout.amic')

@section('title', 'Serviços Aamic')
@section('content')
@include('Frontend.Layout.Includes.header')

<section id="page-title-service" class="mb-5">
   <div class="container">
      <h1 class="text-center">
     	<strong>
     		<i class="fa fa-newspaper"></i>
     		Serviços
     	</strong>
  	</h1>
   </div>
</section>

<section id="page-news" class="pb-5">
	<div class="container">
		<div class="row">
			@foreach($records as $record)
				<div class="col-xs-12 col-md-4">
					<figure>
						<img src="{{asset('storage')}}/{{$record->path}}500x300-{{$record->image}}" class="img-fluid">
					</figure>
					<h2 class="text-center">{{$record->title}}</h2>
					<h5>{{ Str::limit($record->description, 65) }}</h5>
				</div>
			@endforeach
		</div>
	</div>
	<div class="container">
		<div class="row">
		  @if ($records->hasPages())
			  <ul class="pagination" role="navigation">
			    @if ($records->onFirstPage())
			    	<li class="disabled page-item active"><span class="page-link link-previous-edt">‹ Anterior</span></li>
			    @else
			    	<li>
			    		<a href="{{ $records->previousPageUrl() }}" rel="prev" class="page-link link-previous-edt">‹ Anterior</a>
			    	</li>
			    @endif
			    @foreach(range(1, $records->lastPage()) as $i)
			    	@if($i >= $records->currentPage() - 1 && $i <= $records->currentPage() + 1)
			    		@if ($i == $records->currentPage())
			    			<li class="page-item active">
			    				<span class="page-link">{{ $i }}</span>
			    			</li>
			    		@else
			    			<li>
			    				<a href="{{ $records->url($i) }}" class="page-link">{{ $i }}</a>
			    			</li>
			    		@endif
			    	@endif
			    @endforeach
			    @if ($records->hasMorePages())
			    	<li>
			    		<a href="{{ $records->nextPageUrl() }}" rel="next" class="page-link">Próximo ›</a>
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