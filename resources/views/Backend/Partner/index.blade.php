@extends('Backend.Layouts.layout')
@section('title', 'Patrocinadores & Parceiros Amic')
@section('content')

<section id="eventoAmic">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Patrocinadores & Parceiros</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/painel">Painel</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Patrocinadores & Parceiros Amic</strong>
                </li>
            </ol>
        </div>  
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="ibox-title">
                        <h5>Lista de patrocinadores e parceiros cadastrados</h5>
                        <div class="ibox-tools">
                            <a href="{{route('backend.patrocinador.create')}}/" class="btn btn-primary btn-sm right">
                                <i class="fa fa-plus"></i> 
                                Adicionar
                            </a>
                        </div>
                    </div>
                    <hr>
                    <form action="{{route('backend.patrocinador.search')}}" method="GET">
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
                            <th scope="col">Foto</th>
                            <th scope="col">Título</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Link</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($partners as $partner)
                                <tr>
                                    <th scope="row">
                                        @if($partner->path)
                                            <a href="{{asset('storage')}}/{{$partner->path}}150x150-{{$partner->image}}" target="_blank">
                                                <img src="{{asset('storage')}}/{{$partner->path}}150x150-{{$partner->image}}" class="img-fluid" width="80">
                                            </a>  
                                        @endif  
                                    </th>
                                    <th scope="row">{{$partner->title}}</th>
                                   <th scope="row">{{ Str::limit($partner->description, 50) }}</th>
                                    <th scope="row">{{$partner->link}}</th>
                                    <th scope="row">{{$partner->type}}</th>
                                    <th scope="row">
                                        <a href="{{route('backend.patrocinador.edit', ['patrocinador' => $partner->id])}}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-pencil"></i> 
                                            Editar
                                        </a>
                                        <form  method="POST" action="{{route('backend.patrocinador.destroy', ['patrocinador' => $partner->id])}}" style="display:inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <div class="form-group">
                                                <button onclick="return confirm('Tem certeza que deseja excluir {{$partner->title}}?')"  type="submit" class="btn btn-danger text-white">
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
                    @include('Backend.Includes.pagination', ['paginator' => $partners])
                </div>
            </div>
        </div>  
    </div>
</section>
@endsection

@include('Backend.Includes.toast')