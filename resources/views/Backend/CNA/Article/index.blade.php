@extends('Backend.Layouts.layout')
@section('title', 'CNA - Notícias')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>CNA &raquo; Notícias</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/painel">Painel</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('backend.cna.index') }}">CNA</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Notícias</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-8">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Lista de notícias cadastrados</h5>
                    <div class="ibox-tools">
                        <a href="{{route('backend.cna.noticias.create')}}/" class="btn btn-primary btn-sm right">
                            <i class="fa fa-plus"></i> 
                            Adicionar
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form action="{{route('backend.cna.noticias.search')}}" method="GET">
                        <div class="input-group">
                            <input type="text" name="pesquisar" class="form-control mb-2" placeholder="Digite um termo para buscar" required="required">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary mb-2">
                                <i class="fa fa-search"></i> 
                                    Pesquisar
                                </button>
                            </span>
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
                                    <form action="{{route('backend.cna.noticias.push', $article->id)}}" method="POST">
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
                                        <a href="{{route('backend.cna.noticias.edit', ['noticium' => $article->id])}}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-pencil"></i> 
                                            Editar
                                        </a>
                                        <form  method="POST" action="{{route('backend.cna.noticias.destroy', ['noticium' => $article->id])}}" style="display:inline-block">
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
                    <div class="mx-auto d-block">
                        @include('Backend.Includes.pagination', ['paginator' => $articles])
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="ibox selected">
                <div class="ibox-content">
                    <div class="client-detail">
                        <div class="full-height-scroll">
                            <ul class="list-group clear-list m-t">
                                <li class="list-group-item fist-item">
                                    <a href="{{ route('backend.cna.about.index') }}">
                                        <span class="label label-default"><i class="fa fa-caret-right"></i></span>
                                        <strong>Sobre o CNA</strong>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('backend.cna.noticias.index') }}" class="btn btn-success active">
                                        <span class="label label-default"><i class="fa fa-caret-right"></i></span>
                                        <strong>Notícias</strong>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('backend.cna.diretoria.index') }}">
                                        <span class="label label-default"><i class="fa fa-caret-right"></i></span>
                                        <strong>Diretoria</strong>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('backend.cna.eventos.index') }}">
                                        <span class="label label-default"><i class="fa fa-caret-right"></i></span>
                                        <strong>Eventos</strong>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<style>
.list-group-item a {
    display: block;
    text-align: left;
}
</style>
@endsection
@include('Backend.Includes.toast')