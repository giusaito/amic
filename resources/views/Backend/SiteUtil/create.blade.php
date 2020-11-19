@extends('Backend.Layouts.layout')
@section('title', 'Adicionar Site Útil')
@section('content')

<form action="{{ route('backend.site-util.store') }}" class="form-bordered" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-md-9 mt-3">
			<a class="btn btn-warning" href="{{route('backend.site-util.index')}}">	<i class="fa fa-arrow-left"></i> 
					VOLTAR
			</a>
			<div class="card mt-3" style="padding:15px;">
				<div class="form-group">
					<label for="title">Título</label>
					<input name="title" type="text" class="form-control" id="title" placeholder="Título do site útil" required="required">
				</div>
				<div class="form-group">
					<label for="description">Descrição</label>
					<input name="description" type="text" class="form-control" id="description" placeholder="Descrição curta do site útil" required="required">
				</div>
				<div class="form-group">
					<label for="url">Url</label>
					<input name="url" type="url" class="form-control" id="url" placeholder="Url do site útil" required="required">
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
					<h5>Categorias</h5>
					<span>Escolha uma categoria</span>
				</div>
				<div class="card-block p-3">
					@foreach($categories as $category)
						<div>
							<div class="border-checkbox-group border-checkbox-group-primary">
								<input class="border-checkbox" type="checkbox" id="{{$category->slug}}" name="category[]" value="{{$category->id}}" @if(is_array(old('category')) && in_array($category->id, old('category'))) checked @endif>
								<label class="border-checkbox-label" for="{{$category->slug}}">{{$category->title}}</label>
							</div>
						</div>
					@endforeach	
				</div>
			</div>
		</div>
	</div>
</form>
</section>
@endsection

@include('Backend.Includes.published_at')