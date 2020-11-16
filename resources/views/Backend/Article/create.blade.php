<?php
/*
 * Projeto: amic
 * Arquivo: create.blade.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 11/11/2020 10:02:26 am
 * Last Modified:  12/11/2020 11:07:36 pm
 * Modified By: Leonardo Nascimento
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Leo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */


?>
@extends('Backend.Layouts.layout')
@section('title', 'Adicionar Notícia')
@section('content')


<form action="{{ route('backend.noticia.store') }}" class="form-bordered" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row mb-5">
		<div class="col-md-9 mt-3">
			<a class="btn btn-warning" href="{{route('backend.noticia.index')}}">	<i class="fa fa-arrow-left"></i> 
					VOLTAR
			</a>
			<div class="card mt-3" style="padding:15px;">
				<div class="form-group">
					<label for="title">Título</label>
					<input name="title" type="text" class="form-control" id="title" placeholder="Título da notícia" required="required">
				</div>
				<div class="form-group">
					<label for="description">Descrição</label>
					<input name="description" type="text" class="form-control" id="description" placeholder="Descrição curta da notícia" required="required">
				</div>
				<div class="form-group">
					<label for="video">Vídeo</label>
					<input name="video" type="text" class="form-control" id="video" placeholder="Insira o iframe do vídeo">
				</div>
				<div class="form-group">
					<label for="alternative_link">Link alternativo</label>
					<input name="alternative_link" type="text" class="form-control" id="alternative_link" placeholder="Link alternativo">
				</div>
				<div class="form-group">
					<label for="content">Conteúdo</label>
					<textarea class="form-control editor" name="content" id="content" rows="15" data-height="400">{{old('content')}}</textarea>
                        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
				</div>
                <div id="tagsd" class="widget">
                <label for="template">Escolha um tema para a notícia</label>
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-3" style="margin-bottom:10px;">
                                <a class="template">
                                    <img src="https://via.placeholder.com/500" class="img-fluid" style="cursor: pointer;" />
                                </a>
                            </div>
                            <div class="col-md-3" style="margin-bottom:10px;">
                                <a class="template">
                                    <img src="https://via.placeholder.com/300" class="img-fluid" style="cursor: pointer;" />
                                </a>
                            </div>
                            <div class="col-md-3 temaAtivo" style="margin-bottom:10px;">
                                <a class="template">
                                    <img src="https://via.placeholder.com/500" class="img-fluid" style="cursor: pointer;" />
                                </a>
                            </div>
                            <input type="hidden" name="template_id">
                            </div>
                    </div>
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
					<h5>Agendamento</h5>
					<span>Defina a data de publicação</span>
				</div>
					<div class="card-block p-3">
						<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
	                    <input type="text" class="form-control datetimepicker-input" name="published_at" data-target="#datetimepicker1">
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
						<option value="PUBLISHED">Publicado</option>
						<option value="DRAFT">Rascunho</option>
					</select>
					@if($errors->first('status'))
						<label for="status" class="error">{{ $errors->first('status') }}</label>
					@endif
				</div>
			</div>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Destaque</h5>
					<span>Defina se a publicação será fixada na primeira posição do site</span>
				</div>
				<div class="card-block p-3">
					<select name="feature" id="feature" class="form-control" required="required">
						<option value="">Selecione...</option>
						<option value="1">Sim</option>
						<option value="0">Não</option>
					</select>
					@if($errors->first('feature'))
						<label for="feature" class="error">{{ $errors->first('feature') }}</label>
					@endif
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h5>Fonte</h5>
					<span>Insira o nome da fonte da matéria</span>
				</div>
				<div class="card-block p-3">
					<input name="font" type="text" class="form-control" id="font" placeholder="Insira o nome ou marca da fonte">
				</div>
			</div>
			
            <div class="card">
				<div class="card-header">
					<h5>Foto</h5>
					<span>Capa do Podcast</span>
				</div>
				<div class="card-block p-3">
					<input name="author_photo" type="text" class="form-control" id="author_photo" placeholder="Insira o nome do autor da foto">
					<input type="file" name="feature_image" class="dropify" data-max-file-size="1M" />
				</div>
			</div>
		</div>
	</div>
</form>
</section>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />

<style>
.form-control, .single-line {
    border-radius:5px;
}
ul.tagit input[type="text"] {
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: none;
    margin: 0;
    padding: 0;
    width: inherit;
    background-color: inherit;
    outline: none;
}

.temaAtivo {
  border: 3px solid #f78900;
}

input.ui-widget-content.ui-autocomplete-input, span.tagit-label, .ui-menu-item-wrapper {
  text-transform: uppercase;
}</style>
@endsection

@section('js')
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
    });
</script>

@endsection

@include('Backend.Includes.published_at')