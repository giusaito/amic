@extends('Backend.Layouts.layout')
@section('title', 'Editar - ' . $record->title)
@section('content')

<form action="{{ route('backend.informativo.update', ['informativo' => $record->id]) }}" id="article-form" class=" form-bordered" method="post" enctype="multipart/form-data">
	@method('PUT')
	@csrf
	<div class="row">
		<div class="col-md-9">
			<a class="btn btn-warning" href="{{route('backend.informativo.index')}}">	<i class="fa fa-arrow-left"></i> 
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
					<label for="link">link</label>
					<input name="link" type="url" value="{{$record->link}}" class="form-control" id="link" placeholder="Link" required="required">
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
					<h5>Capa</h5>
					<span>Defina a capa do informativo</span>
				</div>
					<div class="card-block p-3">
						Capa
					</div>
			</div>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Arquivo</h5>
					<span>Faça upload do informativo em PDF, WORLD, OU EXCEL</span>
				</div>
					<div class="card-block p-3">
						Informativo
					</div>
				</div>
		</div>
	</div>
</form>
</section>
@endsection

@include('Backend.Includes.published_at')