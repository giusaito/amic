@extends('Backend.Layouts.layout')
@section('title', 'Editar - ' . $record->title)
@section('content')

<form action="{{ route('backend.telefone.update', ['telefone' => $record->id]) }}" id="article-form" class=" form-bordered" method="post" enctype="multipart/form-data">
	@method('PUT')
	@csrf
	<div class="row">
		<div class="col-md-12 mt-3">
			<a class="btn btn-warning" href="{{route('backend.telefone.index')}}">	<i class="fa fa-arrow-left"></i> 
					VOLTAR
			</a>
			<button type="submit" id="submit-all" class="btn btn-primary pull-right">
				<i class="fa fa-check"></i>
					Adicionar
			</button>
			<div class="card mt-3" style="padding:15px;">
				<div class="form-group">
					<label for="title">Nome completo</label>
					<input name="name" type="text" value="{{$record->name}}" class="form-control" id="name" placeholder="Nome" required="required">
				</div>
				<div class="form-group">
					<label for="phone">Telefone</label>
					<input name="phone" type="tel" value="{{$record->phone}}" class="form-control" id="phone" placeholder="Telefone" required="required">
				</div>
				<div class="form-group">
					<label for="url">Url</label>
					<input name="url" type="url" value="{{$record->url}}" class="form-control" id="url" placeholder="Url">
				</div>
			</div>
		</div>
	</div>
</form>
</section>
@endsection

@include('Backend.Includes.published_at')