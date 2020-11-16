@extends('Backend.Layouts.layout')
@section('title', 'Slide Amic')
@section('content')

<section id="tvAmic">
    <div class="text-right mt-4">
        <a href="{{route('backend.slide.index')}}/" class="btn btn-warning right"><i class="fa fa-chevron-left"></i> Voltar</a>
    </div>
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card pt-2">
	                    <form action="{{route('backend.slide.search')}}" method="GET">
	                        <div class="form-row align-items-center">
	                            <div class="pl-5 col-10">
	                            <input type="text" name="pesquisar" class="form-control mb-2" id="inlineFormInput" placeholder="Digite um termo para buscar" value="{{Request::input('pesquisar')}}">
	                            </div>
	                            <div class="col-1">
	                            <button type="submit" class="btn btn-primary mb-2"> 
	                            	<i class="fa fa-search"></i> Pesquisar</button>
	                            </div>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            	<div class="card">
	                <table class="table">
	                    <thead>
	                        <tr>
	                        <th scope="col">Foto</th>
                            <th scope="col">Título</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Link</th>
                            <th scope="col">Ações</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        @foreach($records as $record)
                                <tr>
                                    <th scope="row">{{$record->photo}}</th>
                                    <th scope="row">{{$record->title}}</th>
                                    <th scope="row">{{$record->description}}</th>
                                    <th scope="row">{{$record->url}}</th>
                                    {{-- <th scope="row">{{ Str::limit($record->description, 50) }}</th> --}}
                                    <th scope="row">
                                        <a href="{{route('backend.slide.edit', ['slide' => $record->id])}}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-pencil"></i> 
                                            Editar
                                        </a>
                                        <form  method="POST" action="{{route('backend.slide.destroy', ['slide' => $record->id])}}" style="display:inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <div class="form-group">
                                                <button onclick="return confirm('Tem certeza que deseja excluir {{$record->title}}?')"  type="submit" class="btn btn-danger text-white">
                                                    <i class="fa fa-trash"></i>
                                                    Excluir
                                                </button>
                                            </div>
                                        </form>
                                    </th>
                                </tr>
                            @endforeach
	                    </tbody>
	                </table>
	                @if($records->count() < 1)
	                <h4 class="text-center mb-3">
	                	Não encontramos resultados para a pesquisa <i>{{Request::input('pesquisar')}}</i> por favor, revise o termo pesquisado e tente novamente
	                </h4>
	                @endif
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="mx-auto d-block">
        		{{ $records->withQueryString()->onEachSide(3)->links() }}
        	</div>
        </div>
    </div>
</section>
@endsection