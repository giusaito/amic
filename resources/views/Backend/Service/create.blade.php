@extends('Backend.Layouts.layout')
@section('title', 'Adicionar Serviço')
@section('content')

<form action="{{ route('backend.servico.store') }}" class="form-bordered" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-md-9 mt-3">
			<a class="btn btn-warning" href="{{route('backend.servico.index')}}">	<i class="fa fa-arrow-left"></i> 
				VOLTAR
			</a>
			<div class="card mt-3" style="padding:15px;">
				<div class="form-group">
					<label for="title">Título</label>
					<input name="title" type="text" class="form-control" id="title" placeholder="Título" required="required">
				</div>
				<div class="form-group">
					<label for="description">Descrição</label>
					<input name="description" type="text" class="form-control" id="description" placeholder="Descrição curta" required="required">
				</div>
				<div class="form-group">
					<label for="content">Conteúdo</label>
					<textarea class="form-control editor" name="content" id="content" rows="15" data-height="400">{{old('content')}}</textarea>
                        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
				</div>
				<h3 class="mb-3">Benefícios</h3> 
				<div class="row mb-5">
					<div class="col-md-3 mb-4">
						<input type="file" name="benefit_icon_1" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M"/>
					</div>
					<div class="col-md-9">
						<textarea class="form-control" name="benefit_desc_1" id="benefit_desc_1" rows="9" maxlength="255">{{old('benefit_desc_1')}}</textarea>
							{!! $errors->first('benefit_desc_1', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-3 mb-4">
						<input type="file" name="benefit_icon_2" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M"/>
					</div>
					<div class="col-md-9">
						<textarea class="form-control" name="benefit_desc_2" id="benefit_desc_2" rows="9" maxlength="255">{{old('benefit_desc_2')}}</textarea>
							{!! $errors->first('benefit_desc_2', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-3 mb-4">
						<input type="file" name="benefit_icon_3" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M"/>
					</div>
					<div class="col-md-9">
						<textarea class="form-control" name="benefit_desc_3" id="benefit_desc_3" rows="9" maxlength="255">{{old('benefit_desc_3')}}</textarea>
							{!! $errors->first('benefit_desc_3', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-3 mb-4">
						<input type="file" name="benefit_icon_4" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M"/>
					</div>
					<div class="col-md-9">
						<textarea class="form-control" name="benefit_desc_4" id="benefit_desc_4" rows="9" maxlength="255">{{old('benefit_desc_4')}}</textarea>
							{!! $errors->first('benefit_desc_4', '<p class="help-block">:message</p>') !!}
					</div>
				</div>
					<div class="form-group">
						<label for="after_content">Pós Conteúdo</label>
						<textarea class="form-control editor" name="after_content" id="after_content" rows="15" data-height="400">{{old('after_content')}}</textarea>
                        {!! $errors->first('after_content', '<p class="help-block">:message</p>') !!}
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
					<h5>Descrição do formulário de contato</h5>
					<span>Descrição curta do formulário de contato max: 155</span>
				</div>
				<div class="card-block p-3">
					<input type="text" name="desc_form_contact" class="form-control" maxlength="155" required="required"/>
				</div>
			</div>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>E-mail do formulário de contato</h5>
					<span>Insira o e-mail que receberá os as mensagens enviadas pelos visitantes</span>
				</div>
				<div class="card-block p-3">
					<input type="email" name="email_to" class="form-control" maxlength="155" required="required"/>
				</div>
			</div>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Capa</h5>
					<span>Defina a capa do informativo</span>
				</div>
				<div class="card-block p-3">
					<input type="file" name="feature_image" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M" required="required"/>
				</div>
			</div>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Arquivo</h5>
					<span>Faça upload do informativo em PDF, WORLD, OU EXCEL</span>
				</div>
				<div class="card-block p-3">
					<input type="file" name="image_internal" class="dropify" data-allowed-file-extensions="jpeg jpg png">
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