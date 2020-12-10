@extends('Frontend.Layout.amic')

@section('title', 'Equipe Amic')
@section('content')
@include('Frontend.Layout.Includes.header')

<section id="page-team" class="pb-5 pt-5">
	<div class="container">
		<div class="row">
			@foreach($records as $record)
				<div class="col-xs-12 col-md-4 text-center">
					<div class="bg-light pt-4 pb-4">
						<figure>
							<img src="{{asset('storage')}}/{{$record->path}}222x235-{{$record->image}}" class="">
						</figure>
						<hgroup>
							<h4 class="text-center font-weight-bold">{{$record->name}}</h4>
							<h5>{{ Str::limit($record->office, 65) }}</h5>
							<h6>{{ $record->description }}</h6>
						</hgroup>
						<a href="https://wa.me/55{{preg_replace('/[^0-9]/', '', $record->whatsapp)}}">
							<i class="fab fa-whatsapp"></i>
						</a>
						<a href="mailto:{{$record->email}}">
							<i class="fa fa-envelope"></i>
						</a>
					</div>
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
@section('css')
<style type="text/css">
	i.fab.fa-whatsapp, i.fa.fa-envelope{
		font-size: 1.2em;
		color: #f0825f !important;
	}
</style>
@endsection
@include('Frontend.Layout.Includes.footer')
@endsection