@extends('Backend.Layouts.layout')
@section('title', 'Adicionar Patrocinador ou Parceiro')
@section('content')

<form action="{{ route('backend.patrocinador.store') }}" class="form-bordered" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-md-9">
			<a class="btn btn-warning" href="{{route('backend.patrocinador.index')}}">	<i class="fa fa-arrow-left"></i> 
					VOLTAR
			</a>
			<div class="card mt-3" style="padding:15px;">
				<div class="form-group">
					<label for="title">Título</label>
					<input name="title" type="text" class="form-control" id="title" placeholder="Título" required="required">
				</div>
				<div class="form-group">
					<label for="description">Descrição</label>
					<input name="description" type="text" class="form-control" id="description" placeholder="Descrição" required="required">
				</div>
				<div class="form-group">
					<label for="link">Link</label>
					<input name="link" type="url" class="form-control" id="link" placeholder="Link do site ou rede social">
				</div>
			</div>
		</div>
		
		<div class="col-md-3">
			<button type="submit" id="submit-all" class="btn btn-primary">
				<i class="fa fa-check"></i>
					Adicionar
			</button>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Tipo</h5>
					<span>Escolha entre um parceiro ou patrocinador</span>
				</div>
				<div class="card-block p-3">
					<select name="type" id="type" class="form-control" required="required">
						<option value="">Selecione...</option>
						<option value="PATROCINADOR">Patrocinador</option>
						<option value="PARCEIRO">Parceiro</option>
						<option value="AMBOS">Patrocinador & parceiro</option>
					</select>
					@if($errors->first('type'))
						<label for="type" class="error">{{ $errors->first('type') }}</label>
					@endif
				</div>
			</div>
		</div>
	</div>
</form>
</section>
@endsection

@include('Backend.Includes.published_at')