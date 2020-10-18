@extends('Backend.Layouts.layout')
@section('title', 'Sites Úteis')
@section('content')

<section id="sitesUteis">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Sites Úteis</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/painel">Painel</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Sites úteis</strong>
                </li>
            </ol>
        </div>  
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="ibox-title">
                        <h5>Lista de sites úteis cadastrados</h5>
                        <div class="ibox-tools">
                            <a href="{{route('backend.site-util.create')}}/" class="btn btn-primary btn-sm right">
                                <i class="fa fa-plus"></i> 
                                Adicionar
                            </a>
                        </div>
                    </div>
                    <hr>
                    <form action="{{route('backend.site-util.search')}}" method="GET">
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
                            @foreach($siteUtils as $siteUtil)
                                <tr>
                                    <th scope="row">
                                        <a href="{{$siteUtil->image}}" target="_blank">
                                            <img src="{{$siteUtil->image}}" class="img-fluid" width="80">
                                        </a>
                                    </th>
                                    @if($siteUtil->status == "PUBLISHED")
                                        <th scope="row"><span class="label label-primary">Publicado</span></th>
                                    @else
                                        <th scope="row"><span class="label label-warning">Rascunho</span></th>
                                    @endif
                                    <th scope="row">{{$siteUtil->title}}</th>
                                    {{-- <th scope="row">{{ Str::limit($siteUtil->description, 50) }}</th> --}}
                                    <th scope="row">{{$siteUtil->user->name}}</th>
                                    <th scope="row">
                                        <a href="{{route('backend.site-util.edit', ['site_util' => $siteUtil->id])}}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-pencil"></i> 
                                            Editar
                                        </a>
                                        <form  method="POST" action="{{route('backend.site-util.destroy', ['site_util' => $siteUtil->id])}}" style="display:inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <div class="form-group">
                                                <button onclick="return confirm('Tem certeza que deseja excluir {{$siteUtil->title}}?')"  type="submit" class="btn btn-danger text-white">
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
                    @include('Backend.Includes.pagination', ['paginator' => $siteUtils])
                </div>
            </div>
        </div>  
    </div>
</section>
@endsection

@include('Backend.Includes.toast')