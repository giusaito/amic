@extends('Backend.Layouts.layout')
@section('title', 'Eventos Amic')
@section('content')

<section id="eventoAmic">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Eventos AMIC</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/painel">Painel</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Eventos Amic</strong>
                </li>
            </ol>
        </div>  
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="ibox-title">
                        <h5>Lista de eventos cadastrados</h5>
                        <div class="ibox-tools">
                            <a href="{{route('backend.evento.create')}}/" class="btn btn-primary btn-sm right">
                                <i class="fa fa-plus"></i> 
                                Adicionar
                            </a>
                        </div>
                    </div>
                    <hr>
                    <form action="{{route('backend.evento.search')}}" method="GET">
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
                            <th scope="col">Título do evento</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Cidade/Estado</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Data de início</th>
                            <th scope="col">Data final</th>
                            <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <th scope="row">{{$event->title}}</th>
                                    <th scope="row">{{$event->description}}</th>
                                    <th scope="row">{{$event->city_state}}</th>
                                    <th scope="row">{{$event->address}}</th>
                                    <th scope="row">{{date("d/m/Y H:i", strtotime($event->start_date))}}</th>
                                    <th scope="row">{{date("d/m/Y H:i", strtotime($event->finish_date))}}</th>
                                    {{-- <th scope="row">{{ Str::limit($event->description, 50) }}</th> --}}
                                    <th scope="row">
                                        <a href="{{route('backend.evento.edit', ['evento' => $event->id])}}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-pencil"></i> 
                                            Editar
                                        </a>
                                        <form  method="POST" action="{{route('backend.evento.destroy', ['evento' => $event->id])}}" style="display:inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <div class="form-group">
                                                <button onclick="return confirm('Tem certeza que deseja excluir {{$event->title}}?')"  type="submit" class="btn btn-danger text-white">
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
                    @include('Backend.Includes.pagination', ['paginator' => $events])
                </div>
            </div>
        </div>  
    </div>
</section>
@endsection

@include('Backend.Includes.toast')