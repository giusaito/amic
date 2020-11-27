@extends('Backend.Layouts.layout')
@section('title', 'Terra do Sol - '.$edicao->title.' - Patrocinadores')
@section('content')
<section id="RecordAmic">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Terra do Sol - {{ $edicao->title }} &raquo; Patrocinadores</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/painel">Painel</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('backend.ts.editions.index') }}">Terra do Sol</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Patrocinadores</strong>
                </li>
            </ol>
        </div>  
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <h5>Cadastros</h5>
                        <div class="ibox-tools">
                            @if(Route::current()->getName() == 'backend.ts.sponsors.search') 
                            <a href="{{route('backend.ts.sponsors.index', ['edicao' => $edicao->id])}}/" class="btn btn-warning btn-sm right" style="color:#fff !important;">
                                <i class="fas fa-times"></i>
                                Limpar
                            </a>
                            @endif
                            <a href="{{route('backend.ts.sponsors.create', ['edicao' => $edicao->id])}}/" class="btn btn-primary btn-sm right">
                                <i class="fa fa-plus"></i> 
                                Adicionar
                            </a>
                        </div>
                        <hr>
                        <form action="{{route('backend.ts.sponsors.search', ['edicao' => $edicao->id])}}" method="GET">
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
                    </div> 
                </div>
                        @isset($records)
                            <div class="grid" >
                                @foreach($records as $record)
                                    <div class="grid-item">
                                        <div class="ibox">
                                            <div class="ibox-content">
                                                <h4 class="font-bold">
                                                    {{$record->title}}
                                                </h4>
                                                <img src="{{asset('storage')}}/{{$record->path}}original-{{$record->logo}}" class="img-fluid">
                                            </div>
                                            <div class="ibox-footer">
                                                <a href="{{route('backend.ts.sponsors.edit', ['edicao' => $edicao->id, 'id' => $record->id])}}" class="btn btn-warning">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form  method="POST" action="{{route('backend.ts.sponsors.destroy', ['edicao' => $edicao->id, 'sponsor' => $record])}}" style="display:inline-block">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div class="form-group">
                                                        <button onclick="return confirm('Tem certeza que deseja excluir {{$record->title}}?')"  type="submit" class="btn btn-danger text-white">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endisset
                        @empty($records)  
                            <div class="ibox-content"> 
                                <div class="alert alert-warning">
                                    Nenhum patrocinador cadastrado.
                                </div>
                            </div>
                        @endempty
                        {{-- <table class="table center-content-table">
                            <thead>
                                <tr>
                                    <th scope="col">@sortablelink('content', 'Item')</th>
                                    <th scope="col">@sortablelink('created_at', 'Adicionado')</th>
                                    <th scope="col">@sortablelink('updated_at', 'Modificado')</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <th scope="row">{{$record->content}}</th>
                                        <th scope="row">{{ Carbon\Carbon::parse($record->created_at)->format('d/m/Y') }}</th>
                                        <th scope="row">{{ Carbon\Carbon::parse($record->updated_at)->format('d/m/Y') }}</th>
                                        <th scope="row">
                                            <a href="{{route('backend.ts.sponsors.edit', ['edicao' => $edicao->id, 'id' => $record->id])}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                                Editar
                                            </a>
                                            <form  method="POST" action="{{route('backend.ts.sponsors.destroy', ['edicao' => $edicao->id, 'checklist' => $record])}}" style="display:inline-block">
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
                        </table> --}}
            </div>
        </div> 
    </div>
</section>
@endsection
@section('css')
<style>
    .grid .ibox {
        margin-bottom: 0;
    }

    .grid-item {
        margin-bottom: 25px;
        width: 300px;
    }
</style>
@endsection
@section('js')
<script src="{{ URL::asset('js/backend/masonry.pkgd.min.js') }}"></script>
<script>
$(window).on('load', function(){ 
    $('.grid').masonry({
        // options
        itemSelector: '.grid-item',
        columnWidth: 300,
        gutter: 25
    });
});
</script>
@endsection
@include('Backend.Includes.toast')