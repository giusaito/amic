<?php
  /*
   * Projeto: amic
   * Arquivo: index.blade.php
   * ---------------------------------------------------------------------
   * Autor: Leonardo Nascimento
   * E-mail: leonardo.nascimento21@gmail.com
   * ---------------------------------------------------------------------
   * Data da criação: 24/11/2020 2:25:13 pm
   * Last Modified:  24/11/2020 3:02:47 pm
   * Modified By: Leonardo Nascimento - <leonardo.nascimento21@gmail.com> / MAC OS
   * ---------------------------------------------------------------------
   * Copyright (c) 2020 Leo
   * HISTORY:
   * Date      	By	Comments
   * ----------	---	---------------------------------------------------------
   */
  ?>
@extends('Backend.Layouts.layout')
@section('title', 'Categorias notícias')
@section('content')


@if(session('error'))
	<div class="alert alert-danger text-center">
		<strong>{{ session('error') }}</strong>
	</div>
@endif

<div class="card card user-card-full">
	<div class="row m-l-0 m-r-0">
		<div class="col-6">
			<div class="card-block text-center">
				<form action="@if(\Route::current()->getName() == 'backend.category.site.util.index') {{ route('backend.category.site.util.index') }} @else {{ route('backend.category.site.util.update', $editoria->id) }} @endif" class="form-bordered" method="post">
					    @csrf
                        @if(\Route::current()->getName() == 'backend.category.site.util.index')
                            @method('post')
                        @else
                            @method('put')
                        @endif
                        <div class="ibox-title">
							<h2>@if(\Route::current()->getName() == 'backend.category.site.util.index') Adicionar nova categoria @else Editar categoria {{$editoria->title}}</> @endif</h2>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label class="control-label" for="name">Título <span class="required">*</span></label>
								<input type="text" class="form-control" id="titulo" name="title" value="@if(\Route::current()->getName() == 'backend.category.site.util.index') {{ old('title') }} @else {{$editoria->title}} @endif">
								@if($errors->first('title'))
									<label for="title" class="error">{{ $errors->first('title') }}</label>
								@endif
							</div>
							<div class="form-group">
								<label class="control-label" for="parent">Editoria Pai</label>
								<select class="form-control" id="parent" name="parent">
									<option value="0">Nenhum</option>
									@php
									$editoriasEspacos = function ($categories, $prefix = '&emsp;') use (&$editoriasEspacos, &$editoria) {
									    foreach ($categories as $category) {
									    	 // {{ (\Input::old("state_id") == $estado->id ? "selected":"") }}
									    	if(\Route::current()->getName() == 'backend.category.site.util.index'){
									    		Request::old("parent") == $category->id ? $selected = "selected": $selected = "";
									    	}else {
									    		$editoria->parent_id == $category->id ? $selected = "selected": $selected = "";
									    	}
									        // echo PHP_EOL.$prefix.$category->name;
									        echo PHP_EOL.'<option value="'.$category->id.'" '.$selected.'>'.$prefix.$category->title.'</option>';

									        $editoriasEspacos($category->children, $prefix.'&emsp;');
									    }
									};

									$editoriasEspacos($editorias->toTree());
									@endphp
								</select>
							</div>
						</div>
						<footer class="panel-footer">
							<div class="row">
								<div class="col-sm-6">
									<button type="submit" class="btn btn-primary">@if(\Route::current()->getName() == 'backend.category.site.util.index') Cadastrar @else Editar @endif</button>
								</div>
								<div class="col-sm-6 text-right">
									@if(\Route::current()->getName() != 'backend.category.site.util.index')
										<a href="{{route('backend.category.site.util.index')}}" class="btn btn-default btn-sm"><i class="fa fa-arrow-circle-left"></i> Voltar</a>
									@endif
									{{-- @if($countLixo > 0)
										<a href="#lixeira" class="thrash-button btn btn-danger btn-sm"><i class="fa fa-trash"></i> Lixeira <span class="badge">{{$countLixo}}</span></a>
									@endif --}}
								</div>
							</div>
						</footer>
				</form>
			</div>
		</div>
		<div class="col-6">
			<div class="card-block">
				<div class="table-responsive">
					<section class="panel">
						<div class="panel-body">
							@php
							function RecursiveCategories($array) {

							    if (count($array)) {
							            echo "\n<ul class=\"tree\">\n";
							        foreach ($array as $category) {
                                        echo "<li id=\"".$category->id."\">".
                                            '&nbsp;<a href="'.route('backend.category.site.util.edit',$category->id).'" class="warning-row mini-button" data-toggle="tooltip" data-placement="top" title="Editar registro" style="background: none;border: none;color: #85c9e7;"><i class="fa fa-edit"></i></a>'.
                                            '<form class="delete" action="'.route('backend.category.site.util.destroy', $category->id).'" method="POST" style="display: inline-block;">'.
                                            method_field('delete').
                                            '<input type="hidden" name="_method" value="DELETE">'.
                                            '<input type="hidden" name="_token" value="'.csrf_token().'" />'.
                                            '<button type="submit" class="delete-row mini-button" data-toggle="tooltip" data-placement="top" title="Excluir registro" style="background: none;border: none;color: #85c9e7;"><i class="fa fa-trash"></i></button>'.
                                            '</form>'.$category->title;
                                        if (count($category->children)) {
                                                RecursiveCategories($category->children);
                                        }
                                        echo "</li>\n";
							        }
							        echo "</ul>\n";
							    }
							}
							RecursiveCategories($editorias->toTree());
							@endphp
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<style type="text/css">
	ul.tree, ul.tree ul {
		list-style-type: none;
		background: url(http://oestnews.com.br/assets/backend/images/vline.png) repeat-y;
		margin: 0;
		padding: 0;
	}
   
	ul.tree ul {
		margin-left: 10px;
	}

	ul.tree li {
		margin: 0;
		padding: 0 12px;
		line-height: 20px;
		background: url(http://oestnews.com.br/assets/backend/images/node.png) no-repeat;
		color: #369;
		font-weight: bold;
	}

	ul.tree li li {
	    color: inherit;
	}

	ul.tree li.last {
		background: #000 url(http://oestnews.com.br/assets/backend/images/lastnode.png) no-repeat;
	}
</style>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-bottom-right",
  "preventDuplicates": true,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}


  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
        break;
    }
  @endif

  @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif

</script>
@endsection
