@extends('Backend.Layouts.layout')
@section('title', 'Editar - ' . $podcast->title)
@section('content')

<form action="{{ route('backend.podcast.update', ['podcast' => $podcast->id]) }}" id="article-form" class=" form-bordered" method="post" enctype="multipart/form-data">
	@method('PUT')
	@csrf
	<div class="row">
		<div class="col-md-9">
			<a class="btn btn-warning" href="{{route('backend.podcast.index')}}">	<i class="fa fa-arrow-left"></i> 
					VOLTAR
			</a>
			<div class="card mt-3" style="padding:15px;">
				<div class="form-group">
					<label for="title">Título do vídeo</label>
					<input name="title" type="text" class="form-control" id="title" placeholder="Título do vídeo" value="{{$podcast->title}}" required="required">
				</div>
				<div class="form-group">
					<label for="description">Descrição do vídeo</label>
					<input name="description" type="text" class="form-control" id="description" placeholder="Descrição curta do vídeo" value="{{$podcast->description}}" required="required">
				</div>
				<div class="form-group">
					<label for="iframe">Iframe do vídeo</label>
					<input name="iframe" type="text" class="form-control" id="iframe" placeholder="Iframe do vídeo" value="{{$podcast->iframe}}" required="required">
				</div>
				<div class="form-group">
					<label for="iframe">Texto</label>
					<textarea class="form-control editor" name="content" id="content" rows="15" data-height="400">{{old('content', $podcast->content)}}</textarea>
                        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
				</div>
			</div>
		</div>
		
		<div class="col-md-3">
			<button type="submit" class="btn btn-primary">
				<i class="fa fa-refresh"></i> 
				ATUALIZAR
			</button>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Agendamento</h5>
					<span>Defina a data de publicação</span>
				</div>
					<div class="card-block p-3">
						<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
	                    <input type="text" class="form-control datetimepicker-input" name="published_at" data-target="#datetimepicker1" value="{{date("d/m/Y H:i", strtotime($podcast->published_at))}}">
	                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
	                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
	                    </div>
	                </div>
				</div>
			</div>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Status</h5>
					<span>Defina se a publicação será publicada ou rascunho</span>
				</div>
				<div class="card-block p-3">
					<select name="status" id="status" class="form-control" required="required">
						<option value="">Selecione...</option>
						<option value="PUBLISHED" {{ ($podcast->status == 'PUBLISHED' ? "selected":"") }}>Publicado</option>
						<option value="DRAFT" {{ ($podcast->status == 'DRAFT' ? "selected":"") }}>Rascunho</option>
					</select>
					@if($errors->first('status'))
						<label for="status" class="error">{{ $errors->first('status') }}</label>
					@endif
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h5>Foto</h5>
					<span>Capa do vídeo</span>
				</div>
				<div class="card-block">
					<input type="file" name="feature_image" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M" />
				</div>
			</div>
		</div>
	</div>
</form>
</section>
@endsection

@section('css-include')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
@endsection



@section('js-include')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="{{ URL::asset('js/backend/summernote-ptbr.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>


<script>
$(document).ready(function() {
	$(".editor").summernote({
		height:$(".editor").attr("data-height"),
		fontNamesIgnoreCheck: ['Advent Pro', 'Anton', 'Open Sans', 'Oswald','PT Serif','Roboto'],
		lang: 'pt-BR',
		toolbar: [
			['style', ['style', 'bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['table', ['table']],
			['insert', ['link', 'picture', 'video', 'hr']],
			['view', ['fullscreen', 'help']]
		],
		opover: {
			image: [
				['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
				['float', ['floatLeft', 'floatRight', 'floatNone']],
				['remove', ['removeMedia']]
			],
			link: [
				['link', ['linkDialogShow', 'unlink']]
			],
			table: [
				['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
				['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
			],
			air: [
				['color', ['color']],
				['font', ['bold', 'underline', 'clear']],
				['para', ['ul', 'paragraph']],
				['table', ['table']],
				['insert', ['link', 'picture']]
			]
		},
		codeviewFilter: false,
		codeviewIframeFilter: true

	});
});

$('.dropify').attr("data-default-file");
	$('.dropify').dropify({
		messages: {
			default: 'Arraste e solte um arquivo aqui ou clique',
			replace: 'Arraste e solte um arquivo ou clique para substituir',
			remove:  'remover',
			fileSize:   'Desculpe, o arquivo é muito grande'
		}
	});
	var drEvent = $('#photoArtigo').dropify();
	drEvent.on('dropify.beforeClear', function(event, element){
		return confirm("Você tem certeza que deseja excluir a foto?");
	});
</script>

@endsection

@include('Backend.Includes.published_at')