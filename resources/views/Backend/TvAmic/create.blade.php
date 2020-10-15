@extends('Backend.Layouts.layout')
@section('title', 'Adicionar vídeo')
@section('content')

<form action="{{ route('backend.tv-amic.store') }}" class="form-bordered" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-md-9">
			<div class="card" style="padding:15px;">
				<div class="form-group">
					<label for="title">Título</label>
					<input name="title" type="text" class="form-control" id="title" placeholder="Título do vídeo" required="required">
				</div>
				<div class="form-group">
					<label for="description">Descrição</label>
					<input name="description" type="text" class="form-control" id="description" placeholder="Descrição curta do vídeo" required="required">
				</div>
				<div class="form-group">
					<label for="iframe">Iframe</label>
					<input name="iframe" type="text" class="form-control" id="iframe" placeholder="Iframe do vídeo" required="required">
				</div>
				<div class="form-group">
					<label for="iframe">Texto</label>
					<textarea class="form-control" name="texto" required="required"></textarea>
				</div>
			</div>
		</div>
		
		<div class="col-md-3">
			<button type="submit" id="submit-all" class="btn btn-primary">Adicionar vídeo</button>
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
					FOTO
				</div>
			</div>
		</div>
	</div>
</form>
</section>
@endsection