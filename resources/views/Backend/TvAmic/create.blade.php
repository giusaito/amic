@extends('Backend.Layouts.layout')
@section('title', 'Adicionar vídeo')
@section('content')

<form action="{{ route('backend.tv-amic.store') }}" id="article-form" class=" form-bordered" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-md-9">
			<div class="card" style="padding:15px;">
				<div class="form-group">
					<label for="url_video">Url Vídeo</label>
					<input name="url_video" type="text" class="form-control" id="url_video" placeholder="Url do vídeo">
				</div>
				<div class="form-group">
					<label for="title">Título do vídeo</label>
					<input name="title" type="text" class="form-control" id="title" placeholder="Título do vídeo">
				</div>
				<div class="form-group">
					<label for="description">Descrição do vídeo</label>
					<input name="description" type="text" class="form-control" id="description" placeholder="Descrição do vídeo">
				</div>
				<div class="form-group">
					<label for="iframe">Iframe do vídeo</label>
					<input name="iframe" type="text" class="form-control" id="iframe" placeholder="Iframe do vídeo">
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="provider_name">Nome do provedor de vídeo</label>
						<input name="provider_name" type="text" class="form-control" id="provider_name">
					</div>
						<div class="form-group col-md-6">
							<label for="provider_url">Url do provedor de vídeo</label>
							<input name="provider_url" type="text" class="form-control" id="provider_url">
						</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-3">
			<button type="submit" class="btn btn-primary">Adicionar vídeo</button>
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
			<div class="card">
				<div class="card-header">
					<h5>Foto</h5>
					<span>Capa do vídeo</span>
				</div>
				<div class="card-block">
				<foto-component textUpload="Enviar Foto destaque" id="starring-photo"></foto-component>
				</div>
			</div>
		</div>
	</div>
</form>
</section>
@endsection