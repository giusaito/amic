@extends('Backend.Layouts.layout')
@section('title', 'Podcast Amic')
@section('content')

<section id="tvAmic">
    <div class="text-right mt-4">
        <a href="{{route('backend.podcast.index')}}/" class="btn btn-warning right"><i class="fa fa-chevron-left"></i> Voltar</a>
    </div>
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card pt-2">
	                    <form action="{{route('backend.podcast.search')}}" method="GET">
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
	                        <th scope="col">Imagem</th>
	                        <th scope="col">Status</th>
	                        <th scope="col">Título</th>
	                        <th scope="col">Descrição</th>
	                        <th scope="col">Autor:</th>
	                        <th scope="col">Ações</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        @foreach($podcasts as $podcast)
	                            <tr>
	                                <th scope="row">
	                                    <a href="{{$podcast->image}}" target="_blank">
	                                        <img src="{{$podcast->image}}" class="img-fluid" width="80">
	                                    </a>
	                                </th>
	                                @if($podcast->status == "PUBLISHED")
	                                    <th scope="row"><span class="label label-primary">Publicado</span></th>
	                                @else
	                                    <th scope="row"><span class="label label-default">Rascunho</span></th>
	                                @endif
	                                <th scope="row">{{$podcast->title}}</th>
	                                <th scope="row">{{ Str::limit($podcast->description, 50) }}</th>
	                                <th scope="row">{{$podcast->user->name}}</th>
	                                <th scope="row">
	                                    <a href="{{route('backend.podcast.edit', ['podcast' => $podcast->id])}}" class="btn btn-white btn-sm">
	                                        <i class="fa fa-pencil"></i> 
	                                        Editar
	                                    </a>
	                                    <form  method="POST" action="{{route('backend.podcast.destroy', ['podcast' => $podcast->id])}}" style="display:inline-block">
	                                        {{ csrf_field() }}
	                                        {{ method_field('DELETE') }}
	                                        <div class="form-group">
	                                            <button onclick="return confirm('Tem certeza que deseja excluir o vídeo {{$podcast->title}}?')"  type="submit" class="btn btn-danger text-white">
	                                                <i class="fa fa-pencil"></i>
	                                                Excluir
	                                            </button>
	                                        </div>
	                                    </form>
	                                </th>
	                            </tr>
	                        @endforeach
	                    </tbody>
	                </table>
	                @if($podcasts->count() < 1)
	                <h4 class="text-center mb-3">
	                	Não encontramos resultados para a pesquisa <i>{{Request::input('pesquisar')}}</i> por favor, revise o termo pesquisado e tente novamente
	                </h4>
	                @endif
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="mx-auto d-block">
        		{{ $podcasts->withQueryString()->onEachSide(3)->links() }}
        	</div>
        </div>
    </div>
</section>
@endsection