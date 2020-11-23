<?php
/*
 * Projeto: amic
 * Arquivo: edit.blade.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: oi@bewweb.com.br
 * ---------------------------------------------------------------------
 * Data da criação: 12/11/2020 10:28:37 pm
 * Last Modified:  23/11/2020 2:49:03 pm
 * Modificado por: Leonardo Nascimento - <oi@bewweb.com.br>
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Bewweb
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */


?>
@extends('Backend.Layouts.layout')
@section('title', 'Editar Notícia ' . $article->title)
@section('content')


<form action="{{ route('backend.noticia.update', ['noticium' => $article->id]) }}" class="form-bordered" method="post" enctype="multipart/form-data">
    @method('PUT')
	@csrf
	<div class="row mb-5">
		<div class="col-md-9 mt-3">
			<a class="btn btn-warning" href="{{route('backend.noticia.index')}}">	<i class="fa fa-arrow-left"></i> 
					VOLTAR
			</a>
			<div class="card mt-3" style="padding:15px;">
				<div class="form-group">
					<label for="title">Título</label>
					<input name="title" type="text" value="{{$article->title}}" class="form-control" id="title" placeholder="Título da notícia" required="required">
				</div>
				<div class="form-group">
					<label for="description">Descrição</label>
					<input name="description" type="text"  value="{{$article->description}}" class="form-control" id="description" placeholder="Descrição curta da notícia" required="required">
				</div>
				<div class="form-group">
					<label for="video">Vídeo</label>
					<input name="video" type="text" class="form-control"  value="{{$article->video}}" id="video" placeholder="Insira o iframe do vídeo">
				</div>
				<div class="form-group">
					<label for="alternative_link">Link alternativo</label>
					<input name="alternative_link" type="text" class="form-control"  value="{{$article->alternative_link}}" id="alternative_link" placeholder="Link alternativo">
				</div>
				<div class="form-group">
					<label for="content">Conteúdo</label>
					<textarea class="form-control editor" name="content" id="content" rows="15" data-height="400">{{$article->content}}</textarea>
                        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
				</div>
                <div id="tagsd" class="widget">
                <label for="template">Escolha um tema para a notícia</label>
                    <div class="row">
						<div class="col-md-4" style="margin-bottom:10px;">
							<label>
								<input id="tema1" class="themeSet form-control" type="radio" name="candidate" value="1" {{$article->template_id == 1 ? 'checked' : ''}} />
								<img src="https://via.placeholder.com/500" class="img-fluid" style="cursor: pointer;" />
							</label>
							</div>
						<div class="col-md-4" style="margin-bottom:10px;">
							<label>
								<input id="tema2" class="themeSet form-control" type="radio" name="candidate" value="2" {{$article->template_id == 2 ? 'checked' : ''}} />
								<img src="https://via.placeholder.com/500" class="img-fluid" style="cursor: pointer;" />
							</label>
						</div>
						<div class="col-md-4 temaAtivo" style="margin-bottom:10px;">
							<label>
								<input id="tema3" class="themeSet form-control" type="radio" name="candidate" value="3" {{$article->template_id == 3 ? 'checked' : ''}} />
								<img src="https://via.placeholder.com/500" class="img-fluid" style="cursor: pointer;" />
							</label>
						</div>
						<input type="hidden" id="template_id" name="template_id" value="{{$article->template_id}}">
					</div>
                </div>
			</div>
		</div>
		
		<div class="col-md-3 mt-3">
			<button type="submit" id="submit-all" class="btn btn-primary">
				<i class="fa fa-check"></i>
					Atualizar
			</button>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Agendamento</h5>
					<span>Defina a data de publicação</span>
				</div>
					<div class="card-block p-3">
						<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
	                    <input type="text" value="{{date("d/m/Y H:i", strtotime($article->published_at))}}" class="form-control datetimepicker-input" name="published_at" data-target="#datetimepicker1">
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
						<option value="PUBLISHED" {{ ($article->status == 'PUBLISHED' ? "selected":"") }}>Publicado</option>
						<option value="DRAFT" {{ ($article->status == 'DRAFT' ? "selected":"") }}>Rascunho</option>
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
						<option value="1" {{ ($article->feature == 1 ? "selected":"") }}>Sim</option>
						<option value="0" {{ ($article->feature == 0 ? "selected":"") }}>Não</option>
					</select>
					@if($errors->first('feature'))
						<label for="feature" class="error">{{ $errors->first('feature') }}</label>
					@endif
				</div>
			</div>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Editorias</h5>
				</div>
				<div class="card-block p-3">
					@foreach($editorias as $key => $editoria)
							<div>
								<div class="border-checkbox-group border-checkbox-group-primary">
									<input class="border-checkbox" type="checkbox" id="{{$editoria->slug}}" name="editoria[]" value="{{$editoria->id}}" @if(in_array($editoria->id,$editoriasSalvas)) checked @endif />
									<label class="border-checkbox-label" for="{{$editoria->slug}}">{{$editoria->title}}</label>
								</div>
							</div>
					@endforeach
					@if($errors->first('editorias'))
						<label for="feature" class="error">{{ $errors->first('editorias') }}</label>
					@endif
				</div>
			</div>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Tags</h5>
				</div>
				<div class="card-block p-3">
					<select id="tag_list" name="tags[]" class="form-control" multiple>
                       @foreach($article->tag as $tag)
	                    	<option val="{{addslashes($tag->title)}}" selected>{{addslashes($tag->title)}}</option>
	                    @endforeach
                    </select>
					@if($errors->first('tags'))
						<label for="tags" class="error">{{ $errors->first('tags') }}</label>
					@endif
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h5>Fonte</h5>
					<span>Insira o nome da fonte da matéria</span>
				</div>
				<div class="card-block p-3">
					<input name="font" type="text"  value="{{$article->font}}" class="form-control" id="font" placeholder="Insira o nome ou marca da fonte">
				</div>
			</div>
			
            <div class="card">
				<div class="card-header">
					<h5>Foto</h5>
					<span>Defina a foto destaque da matéria</span>
				</div>
				<div class="card-block p-3">
					<input name="author_photo" type="text" class="mb-3 form-control" id="author_photo" placeholder="Insira o nome do autor da foto">
					<input type="file" name="feature_image" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M" @if($article->path) value="{{asset('storage')}}/{{$article->path}}original-{{$article->image}}" data-default-file="{{asset('storage')}}/{{$article->path}}original-{{$article->image}}" @endif />
					<input type="hidden" name="isPhoto" id="isPhoto" value="{{!empty($article->path) ? 1 : 0}}">
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

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

input.ui-widget-content.ui-autocomplete-input, span.tagit-label, .ui-menu-item-wrapper {
  text-transform: uppercase;
}

/* HIDE RADIO */
[type=radio] { 
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

/* IMAGE STYLES */
[type=radio] + img {
  cursor: pointer;
  filter: gray; /* IE6-9 */
  -webkit-filter: grayscale(1); /* Google Chrome, Safari 6+ & Opera 15+ */
  filter: grayscale(1); /* Microsoft Edge and Firefox 35+ */
}

/* CHECKED STYLES */
[type=radio]:checked + img {
  outline: 2px solid #f78900;
  -webkit-filter: grayscale(0);
  filter: none;
}

input.ui-widget-content.ui-autocomplete-input, span.tagit-label, .ui-menu-item-wrapper {
  text-transform: uppercase;
}
</style>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{ URL::asset('js/backend/summernote-ptbr.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/i18n/pt-BR.js" integrity="sha256-/pqU7mByO80szYr1JmBQCoGGTtAgj2viXKUnyEK7I5k=" crossorigin="anonymous"></script>
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
		drEvent.on('dropify.afterClear', function(event, element){
			$('#isPhoto').attr('value', 2);
		});

		$(".dropify").change(function(){
			$('#isPhoto').attr('value', 3);
		});
    });
	$('#tag_list').select2({
		placeholder: "Comece a digitar...",
		language: 'pt-BR',
		minimumInputLength: 3,
		tags: true,
		tokenSeparators: ['/',',',';',' '],

		ajax: {
			url: '{{route('backend.noticia.tag')}}',
			dataType: 'json',
			data: function (params) {
				return {
					query: $.trim(params.term)
				};
			},
			processResults: function (data) {
				return {
					results:  $.map(data, function (item) {
						return {
						text: item.text,
						id: item.text
						}
					})
				};
			},
			cache: true
		}
	});

$(document).on('click','.themeSet',function(event){
    var selectedOption = $(this).val();
    var id = $(this).attr('value');
	
	$('#template_id').attr('value', id);
    
});
</script>

@endsection

@include('Backend.Includes.published_at')