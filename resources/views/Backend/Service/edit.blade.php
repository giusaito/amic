@extends('Backend.Layouts.layout')
@section('title', 'Editar - ' . $record->title)
@section('content')

<form action="{{ route('backend.servico.update', ['servico' => $record->id]) }}" id="article-form" class=" form-bordered" method="post" enctype="multipart/form-data">
	@method('PUT')
	@csrf
	<div class="row">
		<div class="col-md-9 mt-3">
			<a class="btn btn-warning" href="{{route('backend.servico.index')}}">	<i class="fa fa-arrow-left"></i> 
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
					<label for="content">Conteúdo</label>
					<textarea class="form-control editor" name="content" id="content" rows="15" data-height="400">{!! $record->content !!}</textarea>
                        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
				</div>
				<h3 class="mb-3">Benefícios</h3> 
				<div class="row mb-5">
					<div class="col-md-3 mb-4">
						<input type="file" name="benefit_icon_1" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M" @if($record->benefit_icon_1) value="{{asset('storage')}}/{{$record->path}}original-{{$record->benefit_icon_1}}" data-default-file="{{asset('storage')}}/{{$record->path}}original-{{$record->benefit_icon_1}}" @endif />
						<input type="text" name="isPhoto_benefitit_1" id="isPhoto_benefitit_1" value="{{!empty($record->benefit_icon_1) ? 1 : 0}}">
					</div>
					<div class="col-md-9">
						<textarea class="form-control" name="benefit_desc_1" id="benefit_desc_1" rows="9" maxlength="255">{{$record->benefit_desc_1}}</textarea>
							{!! $errors->first('benefit_desc_1', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-3 mb-4">
						<input type="file" name="benefit_icon_2" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M" @if($record->benefit_icon_2) value="{{asset('storage')}}/{{$record->path}}original-{{$record->benefit_icon_2}}" data-default-file="{{asset('storage')}}/{{$record->path}}original-{{$record->benefit_icon_2}}" @endif/>
						<input type="text" name="isPhoto_benefitit_2" id="isPhoto_benefitit_2" value="{{!empty($record->benefit_icon_2) ? 1 : 0}}">
					</div>
					<div class="col-md-9">
						<textarea class="form-control" name="benefit_desc_2" id="benefit_desc_2" rows="9" maxlength="255">{{$record->benefit_desc_2}}</textarea>
							{!! $errors->first('benefit_desc_2', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-3 mb-4">
						<input type="file" name="benefit_icon_3" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M" @if($record->benefit_icon_3) value="{{asset('storage')}}/{{$record->path}}original-{{$record->benefit_icon_3}}" data-default-file="{{asset('storage')}}/{{$record->path}}original-{{$record->benefit_icon_3}}" @endif/>
						<input type="text" name="isPhoto_benefitit_3" id="isPhoto_benefitit_3" value="{{!empty($record->benefit_icon_3) ? 1 : 0}}">
					</div>
					<div class="col-md-9">
						<textarea class="form-control" name="benefit_desc_3" id="benefit_desc_3" rows="9" maxlength="255">{{$record->benefit_desc_3}}</textarea>
							{!! $errors->first('benefit_desc_3', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-3 mb-4">
						<input type="file" name="benefit_icon_4" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M" @if($record->benefit_icon_4) value="{{asset('storage')}}/{{$record->path}}original-{{$record->benefit_icon_4}}" data-default-file="{{asset('storage')}}/{{$record->path}}original-{{$record->benefit_icon_4}}" @endif/>
						<input type="text" name="isPhoto_benefitit_4" id="isPhoto_benefitit_4" value="{{!empty($record->benefit_icon_4) ? 1 : 0}}">
					</div>
					<div class="col-md-9">
						<textarea class="form-control" name="benefit_desc_4" id="benefit_desc_4" rows="9" maxlength="255">{{$record->benefit_desc_4}}</textarea>
							{!! $errors->first('benefit_desc_4', '<p class="help-block">:message</p>') !!}
					</div>
				</div>
					<div class="form-group">
						<label for="after_content">Pós Conteúdo</label>
						<textarea class="form-control editor" name="after_content" id="after_content" rows="15" data-height="400">{!! $record->after_content !!}</textarea>
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
					<input type="text" name="desc_form_contact" value="{{$record->desc_form_contact}}" class="form-control" maxlength="155" required="required"/>
				</div>
			</div>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>E-mail do formulário de contato</h5>
					<span>Insira o e-mail que receberá os as mensagens enviadas pelos visitantes</span>
				</div>
				<div class="card-block p-3">
					<input type="email" name="email_to" class="form-control" value="{{$record->email_to}}" maxlength="155" required="required"/>
				</div>
			</div>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Capa</h5>
					<span>Defina uma foto destaque</span>
				</div>
				<div class="card-block p-3">
					<input type="file" id="feature_image" name="feature_image" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M" @if($record->path) value="{{asset('storage')}}/{{$record->path}}original-{{$record->image}}" data-default-file="{{asset('storage')}}/{{$record->path}}original-{{$record->image}}" @endif required="required"/>
					<input type="text" name="isPhoto" id="isPhoto" value="{{!empty($record->image) ? 1 : 0}}">
				</div>
			</div>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Foto interna</h5>
					<span>Faça upload de uma foto interna</span>
				</div>
				<div class="card-block p-3">
					<input type="file" id="feature_image_internal" name="image_internal" class="dropify feature_image_internal" data-allowed-file-extensions="jpeg jpg png" @if($record->image_internal) value="{{asset('storage')}}/{{$record->path}}original-{{$record->image_internal}}" data-default-file="{{asset('storage')}}/{{$record->path}}original-{{$record->image_internal}}" @endif />
					<input type="text" name="isPhotoInternal" id="isPhotoInternal" value="{{!empty($record->image_internal) ? 1 : 0}}">
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
	var drEvent = $('#feature_image').dropify();
	drEvent.on('dropify.feature_image.beforeClear', function(event, element){
		return confirm("Você tem certeza que deseja excluir a foto?");
	});

	drEvent.on('dropify.feature_image.afterClear', function(event, element){
		$('#isPhoto').attr('value', 2);
	});

	$("#feature_image").change(function(){
		$('#isPhoto').attr('value', 3);
	});
	


	
	
</script>

@endsection
@include('Backend.Includes.published_at')