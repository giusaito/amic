@extends('Backend.Layouts.layout')
@section('title', 'Adicionar Notícia')
@section('content')


<form action="{{ route('backend.category.noticias.store') }}" class="form-bordered" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row mb-5">
		<div class="col-md-12 mt-3">
			<a class="btn btn-warning" href="{{route('backend.category.noticias.index')}}">	<i class="fa fa-arrow-left"></i> 
				VOLTAR
			</a>
			<div class="card mt-3" style="padding:15px;">
				<div class="form-group">
					<label for="title">Título</label>
					<input name="title" type="text" class="form-control" id="title" placeholder="Título da categoria" required="required">
				</div>
				<div class="form-group">
					<label for="description">Descrição</label>
					<input name="description" type="text" class="form-control" id="description" placeholder="Descrição curta da categoria" required="required">
                </div>
                <div class="form-group">
                    <label for="parent_id">Categoria Pai</label>
                    <select class="form-control" id="parent_id" name="parent_id">
                        <option value="0">Nenhum</option>
                        @php
                        $editoriasEspacos = function ($categories, $prefix = '&emsp;') use (&$editoriasEspacos, &$editoria) {
                            foreach ($categories as $category) {
                                 // {{ (Input::old("state_id") == $estado->id ? "selected":"") }}
                                // if(\Route::current()->getName() == 'backend.category.noticias.index'){
                                //     Input::old("parent_id") == $category->id ? $selected = "selected": $selected = "";
                                // }else {
                                //     $editoria->parent_id == $category->id ? $selected = "selected": $selected = "";
                                // }
                                // echo PHP_EOL.$prefix.$category->name;
                                echo PHP_EOL.'<option value="'.$category->id.'">'.$prefix.$category->title.'</option>';

                                $editoriasEspacos($category->children, $prefix.'&emsp;');
                            }
                        };

                        $editoriasEspacos($editorias->toTree());
                        @endphp
                    </select>
                </div>
                <button type="submit" id="submit-all" class="btn btn-primary">
                    <i class="fa fa-check"></i>
                        Adicionar
                </button>
			</div>
		</div>
	</div>
</form>
</section>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<style>
.form-control, .single-line {
    border-radius:5px;
}
ul.tagit input[type="text"] {
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: none;
    margin: 0;
    padding: 0;
    width: inherit;
    background-color: inherit;
    outline: none;
}

.temaAtivo {
  border: 3px solid #f78900;
}

input.ui-widget-content.ui-autocomplete-input, span.tagit-label, .ui-menu-item-wrapper {
  text-transform: uppercase;
}

</style>
@endsection

@include('Backend.Includes.published_at')