<?php
/*
 * Projeto: amic
 * Arquivo: search.blade.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: oi@bewweb.com.br
 * ---------------------------------------------------------------------
 * Data da criação: 12/11/2020 10:28:37 pm
 * Last Modified:  12/11/2020 11:55:48 pm
 * Modificado por: Leonardo Nascimento - <oi@bewweb.com.br>
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Bewweb
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */


?>
@extends('Backend.Layouts.layout')
@section('title', 'Encontrar notícias')
@section('content')

<section id="tvAmic">
    <div class="text-right mt-4">
        <a href="{{route('backend.noticia.index')}}/" class="btn btn-warning right"><i class="fa fa-chevron-left"></i> Voltar</a>
    </div>
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card pt-2">
	                    <form action="{{route('backend.noticia.search')}}" method="GET">
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
	                        @foreach($articles as $article)
	                            <tr>
	                                <th scope="row">
	                                    <a href="{{$article->image}}" target="_blank">
	                                        <img src="{{$article->image}}" class="img-fluid" width="80">
	                                    </a>
	                                </th>
	                                @if($article->status == "PUBLISHED")
	                                    <th scope="row"><span class="label label-primary">Publicado</span></th>
	                                @else
	                                    <th scope="row"><span class="label label-default">Rascunho</span></th>
	                                @endif
	                                <th scope="row">{{$article->title}}</th>
	                                <th scope="row">{{ Str::limit($article->description, 50) }}</th>
	                                <th scope="row">{{$article->user->name}}</th>
	                                <th scope="row">
	                                    <a href="{{route('backend.noticia.edit', ['noticium' => $article->id])}}" class="btn btn-white btn-sm">
	                                        <i class="fa fa-pencil"></i> 
	                                        Editar
	                                    </a>
	                                    <form  method="POST" action="{{route('backend.noticia.destroy', ['noticium' => $article->id])}}" style="display:inline-block">
	                                        {{ csrf_field() }}
	                                        {{ method_field('DELETE') }}
	                                        <div class="form-group">
	                                            <button onclick="return confirm('Tem certeza que deseja excluir o vídeo {{$article->title}}?')"  type="submit" class="btn btn-danger text-white">
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
	                @if($articles->count() < 1)
	                <h4 class="text-center mb-3">
	                	Não encontramos resultados para a pesquisa <i>{{Request::input('pesquisar')}}</i> por favor, revise o termo pesquisado e tente novamente
	                </h4>
	                @endif
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="mx-auto d-block">
        		{{ $articles->withQueryString()->onEachSide(3)->links() }}
        	</div>
        </div>
    </div>
</section>
@endsection