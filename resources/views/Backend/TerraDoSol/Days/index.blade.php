@extends('Backend.Layouts.layout')
@section('title', 'Terra do Sol - '.$edicao->title.' - Dias')
@section('content')
<section id="RecordAmic">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Terra do Sol - {{ $edicao->title }} &raquo; Dias</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/painel">Painel</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('backend.ts.editions.index') }}">Terra do Sol</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Dias</strong>
                </li>
            </ol>
        </div>  
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="ibox-title">
                        <h5>Cadastros</h5>
                        <div class="ibox-tools">
                            @if(Route::current()->getName() == 'backend.ts.days.search') 
                            <a href="{{route('backend.ts.days.index', ['edicao' => $edicao->id])}}/" class="btn btn-warning btn-sm right" style="color:#fff !important;">
                                <i class="fas fa-times"></i>
                                Limpar
                            </a>
                            @endif
                            <a href="{{route('backend.ts.days.create', ['edicao' => $edicao->id])}}/" class="btn btn-primary btn-sm right">
                                <i class="fa fa-plus"></i> 
                                Adicionar
                            </a>
                        </div>
                    </div>
                    <hr>
                    <form action="{{route('backend.ts.days.search', ['edicao' => $edicao->id])}}" method="GET">
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
                                    <th scope="col">@sortablelink('title', 'Título')</th>
                                    <th scope="col">@sortablelink('content', 'Conteúdo')</th>
                                    <th scope="col">@sortablelink('ambient_conditions', 'Condições do ambiente')</th>
                                    <th scope="col">@sortablelink('created_at', 'Adicionado')</th>
                                    <th scope="col">@sortablelink('updated_at', 'Modificado')</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <th scope="row">{{$record->title}}</th>
                                        <th scope="row">{!! $record->content !!}</th>
                                        <th scope="row">{!! $record->ambient_conditions !!}</th>
                                        <th scope="row">{{ Carbon\Carbon::parse($record->created_at)->format('d/m/Y') }}</th>
                                        <th scope="row">{{ Carbon\Carbon::parse($record->updated_at)->format('d/m/Y') }}</th>
                                        <th scope="row">
                                            <a href="{{route('backend.ts.days.edit', ['edicao' => $edicao->id, 'id' => $record->id])}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                                Editar
                                            </a>
                                            <form  method="POST" action="{{route('backend.ts.days.destroy', ['edicao' => $edicao->id, 'day' => $record])}}" style="display:inline-block">
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