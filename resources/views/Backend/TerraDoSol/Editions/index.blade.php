@extends('Backend.Layouts.layout')
@section('title', 'Terra do Sol')
@section('content')

<section id="RecordAmic">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Terra do Sol</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/painel">Painel</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Terra do Sol</strong>
                </li>
            </ol>
        </div>  
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="ibox-title">
                        <h5>Lista de edições cadastradas</h5>
                        <div class="ibox-tools">
                            <a href="{{route('backend.ts.editions.create')}}/" class="btn btn-primary btn-sm right">
                                <i class="fa fa-plus"></i> 
                                Adicionar
                            </a>
                        </div>
                    </div>
                    <hr>
                    <form action="{{route('backend.ts.editions.search')}}" method="GET">
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
                    <div class="ibox-content">
                        <table class="table center-content-table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">@sortablelink('title', 'Título')</th>
                                    <th scope="col">@sortablelink('event_start', 'Início')</th>
                                    <th scope="col">@sortablelink('event_finish', 'Término')</th>
                                    <th scope="col">@sortablelink('event_suspended', 'Evento Suspenso')</th>
                                    <th scope="col">@sortablelink('created_at', 'Adicionado')</th>
                                    <th scope="col">@sortablelink('updated_at', 'Modificado')</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <th scope="row">
                                            @if($record->path)
                                            <a href="{{asset('storage')}}/{{$record->path}}150x150-{{$record->logo}}" target="_blank">
                                                <img src="{{asset('storage')}}/{{$record->path}}150x150-{{$record->logo}}" class="img-fluid" width="50">
                                            </a>
                                            @endif
                                        </th>
                                        <th scope="row">{{$record->title}}</th>
                                        <th scope="row">{{ Carbon\Carbon::parse($record->event_start)->format('d/m/Y') }}</th>
                                        <th scope="row">{{ Carbon\Carbon::parse($record->event_finish)->format('d/m/Y') }}</th>
                                        <th scope="row">{!!  $record->event_suspended === "true" ? '<span class="label label-danger">Sim</label>' : '<span class="label label-info">Não</span>' !!}</th>
                                        <th scope="row">{{ Carbon\Carbon::parse($record->created_at)->format('d/m/Y') }}</th>
                                        <th scope="row">{{ Carbon\Carbon::parse($record->updated_at)->format('d/m/Y') }}</th>
                                        <th scope="row">
                                            <div class="tooltip-link">
                                                <a class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Sobre">
                                                    <i class="fas fa-address-card"></i>
                                                </a>
                                                <a class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Checklist">
                                                    <i class="fas fa-tasks"></i>
                                                </a>
                                                <a class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Dias">
                                                    <i class="fas fa-calendar-day"></i>
                                                </a>
                                                <a class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Trajeto">
                                                    <i class="fas fa-route"></i>
                                                </a>
                                                <a class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Fotos">
                                                    <i class="fa fa-file-picture-o"></i>
                                                </a>
                                                <a class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Recomendação">
                                                    <i class="fas fa-comment-dots"></i>
                                                </a>
                                                <a class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Slideshow">
                                                    <i class="fas fa-images"></i>
                                                </a>
                                                <a class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Patrocinadores">
                                                    <i class="fas fa-briefcase"></i>
                                                </a>
                                                <a class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Vídeos">
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            </div>
                                        </th>
                                        <th scope="row">
                                            <a href="{{route('backend.ts.editions.edit', ['edico' => $record->id])}}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil"></i> 
                                                Editar
                                            </a>
                                            <form  method="POST" action="{{route('backend.ts.editions.destroy', ['edico' => $record->id])}}" style="display:inline-block">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="mx-auto d-block">
                    @include('Backend.Includes.pagination', ['paginator' => $records])
                </div>
            </div>
        </div>  
    </div>
</section>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
@endsection

@include('Backend.Includes.toast')