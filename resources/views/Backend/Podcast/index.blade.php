@extends('Backend.Layouts.layout')
@section('title', 'Podcast Amic')
@section('content')

<section id="PodcastAmic">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Podcast AMIC</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/painel">Painel</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Podcast Amic</strong>
                </li>
            </ol>
        </div>  
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="ibox-title">
                        <h5>Lista de Podcast's cadastrados</h5>
                        <div class="ibox-tools">
                            <a href="{{route('backend.podcast.create')}}/" class="btn btn-primary btn-sm right">
                                <i class="fa fa-plus"></i> 
                                Adicionar
                            </a>
                        </div>
                    </div>
                    <hr>
                    <form action="{{route('backend.podcast.search')}}" method="GET">
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
                            <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($podcasts as $podcast)
                                <tr>
                                    <th scope="row">
                                        <a href="{{asset('storage')}}/{{$podcast->path}}150x150-{{$podcast->image}}" target="_blank">
                                            <img src="{{asset('storage')}}/{{$podcast->path}}150x150-{{$podcast->image}}" class="img-fluid" width="80">
                                        </a>
                                    </th>
                                    @if($podcast->status == "PUBLISHED")
                                        <th scope="row"><span class="label label-primary">Publicado</span></th>
                                    @else
                                        <th scope="row"><span class="label label-warning">Rascunho</span></th>
                                    @endif
                                    <th scope="row">{{$podcast->title}}</th>
                                    {{-- <th scope="row">{{ Str::limit($podcast->description, 50) }}</th> --}}
                                    <th scope="row">{{$podcast->user->name}}</th>
                                    <th scope="row">
                                        <a href="{{route('backend.podcast.edit', ['podcast' => $podcast->id])}}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-pencil"></i> 
                                            Editar
                                        </a>
                                        <form  method="POST" action="{{route('backend.podcast.destroy', ['podcast' => $podcast->id])}}" style="display:inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <div class="form-group">
                                                <button onclick="return confirm('Tem certeza que deseja excluir {{$podcast->title}}?')"  type="submit" class="btn btn-danger text-white">
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
                    @include('Backend.Includes.pagination', ['paginator' => $podcasts])
                </div>
            </div>
        </div>  
    </div>
</section>
@endsection

@include('Backend.Includes.toast')