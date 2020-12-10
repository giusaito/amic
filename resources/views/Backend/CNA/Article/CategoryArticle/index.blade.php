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
                <div class="ibox-content">
                    CONTEUDO
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