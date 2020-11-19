@extends('Backend.Layouts.layout')
@section('title', 'Editar - ' . $record->title)
@section('content')

<form action="{{ route('backend.publicidade.update', ['publicidade' => $record->id]) }}" id="article-form" class=" form-bordered" method="post" enctype="multipart/form-data">
	@method('PUT')
	@csrf
	<div class="row">
		<div class="col-md-9 mt-3">
			<a class="btn btn-warning" href="{{route('backend.publicidade.index')}}">	<i class="fa fa-arrow-left"></i> 
					VOLTAR
			</a>
			<div class="card mt-3" style="padding:15px;">
				<div class="form-group">
					<label for="title">Título</label>
					<input name="title" type="text" value={{$record->title}} class="form-control" id="title" placeholder="Título" required="required">
				</div>
				<div class="form-group">
					<label for="url">Código</label>
					<textarea name="code" placeholder="Cole o código gerado no DFP" class="form-control">{{$record->code}}</textarea>
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
					<h5>Posição</h5>
					<span>Defina se a posição que a publicidade irá aparecer</span>
				</div>
				<div class="card-block p-3">
					<select name="position" id="position" class="form-control" required="required">
						<option value="">Selecione...</option>
						<option value="PUBLISHED">Header</option>
						<option value="DRAFT">Após ...</option>
						<option value="DRAFT">Após ...</option>
						<option value="DRAFT">Rodapé</option>
					</select>
					@if($errors->first('status'))
						<label for="status" class="error">{{ $errors->first('status') }}</label>
					@endif
				</div>
			</div>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Página</h5>
					<span>Defina se a página que a publicidade irá aparecer</span>
				</div>
				<div class="card-block p-3">
					<select name="page" id="page" class="form-control" required="required">
						<option value="">Selecione...</option>
						<option value="DRAFT">Interna (notícias)</option>
						<option value="PUBLISHED">Demais páginas</option>
					</select>
					@if($errors->first('status'))
						<label for="status" class="error">{{ $errors->first('status') }}</label>
					@endif
				</div>
			</div>
	</div>
</form>
</section>
@endsection

@include('Backend.Includes.published_at')