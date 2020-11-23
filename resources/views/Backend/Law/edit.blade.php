@extends('Backend.Layouts.layout')
@section('title', 'Editar - ' . $record->title)
@section('content')

@if(session('error'))
	<div class="alert alert-danger text-center">
		<strong>{{ session('error') }}</strong>
	</div>
@endif

<form action="{{ route('backend.lei.update', ['lei_e_regimento' => $record->id]) }}" id="article-form" class=" form-bordered" method="post" enctype="multipart/form-data">
	@method('PUT')
	@csrf
	<div class="row">
		<div class="col-md-9 mt-3">
			<a class="btn btn-warning" href="{{route('backend.lei.index')}}">	<i class="fa fa-arrow-left"></i> 
					VOLTAR
			</a>
			<div class="card mt-3" style="padding:15px;">
				<div class="form-group">
					<label for="title">Título</label>
					<input name="title" type="text" value="{{$record->title}}" class="form-control" id="title" placeholder="Título" required="required">
				</div>
				<div class="form-group">
					<label for="description">Descrição</label>
					<input name="description" type="text" value="{{$record->description}}" class="form-control" id="description" placeholder="Descrição curta" required="required">
				</div>
				<div class="form-group">
					<label for="url">Url</label>
					<input name="url" type="url" value={{$record->url}} class="form-control" id="url" placeholder="Insira a URL">
				</div>
			</div>
		</div>
		
		<div class="col-md-3 mt-3">
			<button type="submit" id="submit-all" class="btn btn-primary">
				<i class="fa fa-check"></i>
					Adicionar
			</button>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Capa</h5>
					<span>Defina a capa do informativo</span>
				</div>
					<div class="card-block p-3">
						<input type="file" id="capa" name="feature_image" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M" @if($record->path) value="{{asset('storage')}}/{{$record->path}}original-{{$record->image}}" data-default-file="{{asset('storage')}}/{{$record->path}}original-{{$record->image}}" @endif/>
						<input type="hidden" name="isPhoto" id="isPhoto" value="{{!empty($record->path) ? 1 : 0}}">
					</div>
			</div>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Arquivo</h5>
					<span>Faça upload do informativo em PDF, WORLD, OU EXCEL</span>
				</div>
					<div class="card-block p-3">
						<input type="file" id="archive" name="archive" class="dropify" data-allowed-file-extensions="pdf xlsx xltx excel word"  data-max-file-size="1M" @if($record->archive) value="{{asset('storage')}}/{{$record->archive}}" data-default-file="{{asset('storage')}}/{{$record->archive}}" @endif/>
						<input type="hidden" name="isArchive" id="isArchive" value="{{!empty($record->archive) ? 1 : 0}}">
					</div>
				</div>
		</div>
	</div>
</form>
</section>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
@endsection


@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="{{ URL::asset('js/backend/summernote-ptbr.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>


<script>
$('.dropify').attr("data-default-file");
	$('.dropify').dropify({
		messages: {
			default: 'Arraste e solte um arquivo aqui ou clique',
			replace: 'Arraste e solte um arquivo ou clique para substituir',
			remove:  'remover',
			fileSize:   'Desculpe, o arquivo é muito grande'
		}
	});
	var drEvent = $('#capa').dropify();
	drEvent.on('dropify.beforeClear', function(event, element){
		return confirm("Você tem certeza que deseja excluir a foto?");
	});

	drEvent.on('dropify.afterClear', function(event, element){
		$('#isPhoto').attr('value', 2);
	});

	$(".dropify").change(function(){
		$('#isPhoto').attr('value', 3);
	});
	
	var drEvent = $('#archive').dropify();
	drEvent.on('dropify.beforeClear', function(event, element){
		return confirm("Você tem certeza que deseja excluir o arquivo?");
	});

	drEvent.on('dropify.afterClear', function(event, element){
		$('#isArchive').attr('value', 2);
	});

	$(".dropify").change(function(){
		$('#isArchive').attr('value', 3);
	});
</script>

@endsection
@include('Backend.Includes.published_at')