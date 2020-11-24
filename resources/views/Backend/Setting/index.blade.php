@extends('Backend.Layouts.layout')
@section('title', 'Configurações Amic')
@section('content')

<section id="RecordAmic">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Configurações AMIC</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/painel">Painel</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Configurações Amic</strong>
                </li>
            </ol>
        </div>  
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="ibox-title">
                        <h5>Configurações</h5>
                    </div>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Logo</th>
                            <th scope="col">Logo Footer</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Número</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <a href="{{asset('storage')}}/{{$record->logomarca}}" target="_blank">
                                        <img src="{{asset('storage')}}/{{$record->logomarca}}" class="img-fluid" width="50">
                                    </a>
                                </th>
                                <th scope="row">
                                    <a href="{{asset('storage')}}/{{$record->logomarca_footer}}" target="_blank">
                                        <img src="{{asset('storage')}}/{{$record->logomarca_footer}}" class="img-fluid" width="50">
                                    </a>
                                </th>
                                <th scope="row">{{$record->address}}</th>
                                <th scope="row">{{$record->address_number}}</th>
                                <th scope="row">{{$record->phone}}</th>
                                <th scope="row">{{$record->whatsapp}}</th>
                                <th scope="row">{{$record->email}}</th>
                                {{-- <th scope="row">{{ Str::limit($record->description, 50) }}</th> --}}
                                <th scope="row">
                                    <a href="{{route('backend.configuracoes.edit', ['configuraco' => $record->id])}}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil"></i> 
                                        Editar
                                    </a>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@include('Backend.Includes.toast')