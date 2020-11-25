<?php
/*
 * Projeto: amic
 * Arquivo: index.blade.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 11/11/2020 10:02:04 am
 * Last Modified:  25/11/2020 3:47:24 pm
 * Modified By: Leonardo Nascimento - <leonardo.nascimento21@gmail.com> / MAC OS
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Leo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */


?>
@extends('Backend.Layouts.layout')
@section('title', 'Notícias')
@section('content')

<section id="noticias">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Notícias</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/painel">Painel</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Notícias</strong>
                </li>
            </ol>
        </div>  
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="ibox-title">
                        <h5>Lista de notícias cadastrados</h5>
                        <div class="ibox-tools">
                            <a href="{{route('backend.noticia.create')}}/" class="btn btn-primary btn-sm right">
                                <i class="fa fa-plus"></i> 
                                Adicionar
                            </a>
                        </div>
                    </div>
                    <hr>
                    <form action="{{route('backend.noticia.search')}}" method="GET">
                       <div class="col-12">
                           <div class="input-group">
                                <input type="text" name="pesquisar" class="form-control mb-2" placeholder="Digite um termo para buscar" required="required">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary mb-2">
                                    <i class="fa fa-search"></i> 
                                        Pesquisar
                                    </button>
                                </span>
                            </div>
                       </div>
                    </form> 
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Imagem</th>
                            <th scope="col">Status</th>
                            <th scope="col">Título</th>
                            {{-- <th scope="col">Descrição</th> --}}
                            <th scope="col">Autor:</th>
                            <th scope="col">Fotos:</th>
                            <th scope="col">Push:</th>
                            <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <th scope="row">
                                        @if($article->path)
                                        <a href="{{asset('storage')}}/{{$article->path}}150x150-{{$article->image}}" target="_blank">
                                            <img src="{{asset('storage')}}/{{$article->path}}150x150-{{$article->image}}" class="img-fluid" width="80">
                                        </a>
                                        @endif
                                    </th>
                                    @if($article->status == "PUBLISHED")
                                        <th scope="row"><span class="label label-primary">Publicado</span></th>
                                    @else
                                        <th scope="row"><span class="label label-warning">Rascunho</span></th>
                                    @endif
                                    <th scope="row">{{$article->title}}</th>
                                    <th scope="row">{{$article->user->name}}</th>
                                    <th scope="row">
                                        <a href="{{route('backend.photo.noticias.index', ['photo' => $article->id])}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Fotos">
                                            <i class="fa fa-file-picture-o"></i>
                                        </a>
                                    </th>
                                    <th scope="row">
                                    <form action="{{route('backend.noticia.push', $article->id)}}" method="POST">
                                        @csrf
                                        <button onclick="return confirm('Tem certeza que deseja enviar push para a notícia {{$article->title}}?')" type="submit" data-toggle="tooltip" data-container="body" data-title="Enviar Push" style="border: none;color: #2e353c;font-size: 14px;line-height: 18px;float: left;padding: 8px 10px;border-radius: 4px;background: #f2f3f4;margin-right: 5px; margin-left:5px">
                                            <i class="fa fa-paper-plane"></i>
                                        </button>
                                    </form>
                                        {{-- <a href="{{route('backend.photo.noticias.index', ['photo' => $article->id])}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Fotos">
                                            <i class="fa fa-paper-plane"></i>
                                        </a> --}}
                                    </th>
                                    <th scope="row">
                                        <a href="{{route('backend.noticia.edit', ['noticium' => $article->id])}}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-pencil"></i> 
                                            Editar
                                        </a>
                                        <form  method="POST" action="{{route('backend.noticia.destroy', ['noticium' => $article->id])}}" style="display:inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <div class="form-group">
                                                <button onclick="return confirm('Tem certeza que deseja excluir {{$article->title}}?')"  type="submit" class="btn btn-danger text-white">
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
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="mx-auto d-block">
                    @include('Backend.Includes.pagination', ['paginator' => $articles])
                </div>
            </div>
        </div>  
    </div>
</section>
@endsection
@include('Backend.Includes.toast')