@extends('Backend.Layouts.layout')
@section('title', 'Editar - ' . $record->title)
@section('content')

@if(session('error'))
	<div class="alert alert-danger text-center">
		<strong>{{ session('error') }}</strong>
	</div>
@endif

<form action="{{ route('backend.configuracoes.update', ['configuraco' => $record->id]) }}" id="article-form" class=" form-bordered" method="post" enctype="multipart/form-data">
	@method('PUT')
	@csrf
	<div class="row">
		<div class="col-md-9 mt-3">
			<a class="btn btn-warning" href="{{route('backend.configuracoes.index')}}">	<i class="fa fa-arrow-left"></i> 
					VOLTAR
			</a>
			<div class="card mt-3" style="padding:15px;">
				<div class="form-group row">
					<div class="col-md-12">
						<label for="email">E-mail</label>
						<input class="form-control form-radius {{ $errors->has('email') ? 'form-control-danger' : ''}}" type="email" id="email" name="email" placeholder="seuemail@seudominio.com.br"  value="{{$record->email}}">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-4">
						<label for="address">Endereço</label>
						<input class="form-control form-radius {{ $errors->has('address') ? 'form-control-danger' : ''}}" type="text" id="address" name="address" placeholder="Ex: Avenida Brasil" value="{{$record->address}}">
					</div>
					<div class="col-md-4">
						<label for="address_number">Número</label>
						<input class="form-control form-radius {{ $errors->has('address_number') ? 'form-control-danger' : ''}}" type="number" id="address_number" name="address_number" placeholder="Ex: 2456" value="{{$record->address_number}}">
					</div>
					<div class="col-md-4">
						<label for="zipcode">Cep</label>
						<input class="form-control form-radius {{ $errors->has('zipcode') ? 'form-control-danger' : ''}}" type="text" id="zipcode" name="zipcode" placeholder="Ex: 85420-000" value="{{$record->zipcode}}">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-6">
						<label for="city">Cidade</label>
						<input class="form-control form-radius {{ $errors->has('city') ? 'form-control-danger' : ''}}" type="text" id="city" name="city" placeholder="Ex: Cascavel" value="{{$record->city}}">
					</div>
					<div class="col-md-6">
						<label for="state">Estado</label>
						<input class="form-control form-radius {{ $errors->has('state') ? 'form-control-danger' : ''}}" type="text" id="state" name="state" placeholder="Ex: Paraná" value="{{$record->state}}">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-6">
						<label for="phone">Telefone</label>
						<input class="form-control telefone form-radius {{ $errors->has('phone') ? 'form-control-danger' : ''}}" type="tel" id="phone" name="phone" placeholder="Ex: 45 3222-2222" value="{{$record->phone}}">
					</div>
					<div class="col-md-6">
						<label for="whatsapp">Whatsapp</label>
						<input class="form-control telefone2 form-radius {{ $errors->has('whatsapp') ? 'form-control-danger' : ''}}" type="tel" id="whatsapp" name="whatsapp" placeholder="Ex: 45 3222-2222" value="{{$record->whatsapp}}">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-6">
						<label for="phone2">Telefone 2</label>
						<input class="form-control telefone form-radius {{ $errors->has('phone2') ? 'form-control-danger' : ''}}" type="tel" id="phone2" name="phone2" placeholder="Ex: 45 3222-2222" value="{{$record->phone2}}">
					</div>
					<div class="col-md-6">
						<label for="whatsapp2">Whatsapp 2</label>
						<input class="form-control telefone2 form-radius {{ $errors->has('whatsapp2') ? 'form-control-danger' : ''}}" type="tel" id="whatsapp" name="whatsapp2" placeholder="Ex: 45 3222-2222" value="{{$record->whatsapp2}}">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-4">
						<label for="facebook">Facebook</label>
						<input class="form-control form-radius {{ $errors->has('facebook') ? 'form-control-danger' : ''}}" type="url" id="facebook" name="facebook" placeholder="http://facebook.com/bewweb.com.br" value="{{$record->facebook}}">
					</div>
					<div class="col-md-4">
						<label for="instagram">Instagram</label>
						<input class="form-control form-radius {{ $errors->has('instagram') ? 'form-control-danger' : ''}}" type="url" id="instagram" name="instagram" placeholder="https://www.instagram.com/bewwebr" value="{{$record->instagram}}">
					</div>
					<div class="col-md-4">
						<label for="twitter">Twitter</label>
						<input class="form-control form-radius {{ $errors->has('twitter') ? 'form-control-danger' : ''}}" type="url" id="twitter" name="twitter" placeholder="https://www.twitter.com/bewwebr" value="{{$record->twitter}}">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-6">
						<label for="linkedin">Linkedin</label>
						<input class="form-control form-radius {{ $errors->has('linkedin') ? 'form-control-danger' : ''}}" type="url" id="linkedin" name="linkedin" placeholder="http://linkedin.com/bewweb.com.br" value="{{$record->linkedin}}">
					</div>
					<div class="col-md-6">
						<label for="youtube">Youtube</label>
						<input class="form-control form-radius {{ $errors->has('youtube') ? 'form-control-danger' : ''}}" type="url" id="youtube" name="youtube" placeholder="https://www.youtube.com/bewwebr" value="{{$record->youtube}}">
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-3 mt-3">
			<button type="submit" id="submit-all" class="btn btn-primary">
				<i class="fa fa-refresh"></i> 
					Atualizar
			</button>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Logomarca principal</h5>
					<span>Defina uma logo principal</span>
				</div>
				<div class="card-block p-3">
					<input type="file" id="photo" name="feature_image" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M" data-max-file-size="1M" @if($record->logomarca) value="{{asset('storage')}}/{{$record->logomarca}}" data-default-file="{{asset('storage')}}/{{$record->logomarca}}" @endif/>
					<input type="hidden" name="isPhoto" id="isPhoto" value="{{!empty($record->logomarca) ? 1 : 0}}">
				</div>
			</div>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Logomarca Footer</h5>
					<span>Defina uma logo para o footer</span>
				</div>
				<div class="card-block p-3">
					<input type="file" id="photoFooter" name="feature_image_footer" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M" @if($record->logomarca_footer) value="{{asset('storage')}}/{{$record->logomarca_footer}}" data-default-file="{{asset('storage')}}/{{$record->logomarca_footer}}" @endif />
					<input type="hidden" name="isPhotoFooter" id="isPhotoFooter" value="{{!empty($record->logomarca_footer) ? 1 : 0}}">
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
	var drEvent = $('.dropify').dropify();
	drEvent.on('dropify.beforeClear', function(event, element){
		return confirm("Você tem certeza que deseja excluir a logomarca?");
	});

	drEvent.on('dropify.afterClear', function(event, element){
		$('#isPhoto').attr('value', 2);
	});

	$(".dropify").change(function(){
		$('#isPhoto').attr('value', 3);
	});
	drEvent.on('dropify.afterClear', function(event, element){
		$('#isPhotoFooter').attr('value', 2);
	});

	$(".dropify").change(function(){
		$('#isPhotoFooter').attr('value', 3);
	});
</script>

@endsection
@include('Backend.Includes.published_at')