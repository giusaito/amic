@extends('Backend.Layouts.layout')
@section('title', 'CNA')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>CNA</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/painel">Painel</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>CNA</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight">
    <form action="{{ route('backend.cna.store') }}" class="form-bordered" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-8">
                <div class="ibox">
                    <div class="ibox-content">
                        @csrf
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input name="title" type="text" class="form-control" id="title" required="required" value="@if(isset($record->title)) {{$record->title}} @endif">
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea class="form-control editor" name="description" id="description" rows="15" data-height="400">@if(isset($record->description)) {{$record->description}} @endif</textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="imagem_destaque" class="dropify-imagem_destaque" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M" @if(isset($record->imagem_destaque_path) && $record->imagem_destaque_path) value="{{asset('storage')}}/{{$record->imagem_destaque_path}}original-{{$record->imagem_destaque}}" data-default-file="{{asset('storage')}}/{{$record->imagem_destaque_path}}original-{{$record->imagem_destaque}}" @endif />
                            <input type="hidden" name="isPhoto2" id="isPhoto2" value="{{!empty($record->imagem_destaque_path) ? 1 : 0}}">
                        </div>
                        <button type="submit" id="submit-all" class="btn btn-primary pull-right">
                            <i class="fa fa-check"></i>
                            Salvar
                        </button>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="ibox selected">
                    <div class="ibox-content">
                        <div class="client-detail">
                            <input type="file" name="logo" class="dropify-logo" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M" @if(isset($record->logo_path) && $record->logo_path) value="{{asset('storage')}}/{{$record->logo_path}}original-{{$record->logo}}" data-default-file="{{asset('storage')}}/{{$record->logo_path}}original-{{$record->logo}}" @endif />
                            <input type="hidden" name="isPhoto" id="isPhoto" value="{{!empty($record->logo_path) ? 1 : 0}}">
                            <div class="full-height-scroll">
                                <hr>

                                <ul class="list-group clear-list m-t">
                                    <li class="list-group-item fist-item">
                                        <a href="{{ route('backend.cna.about.index') }}">
                                            <span class="label label-default"><i class="fa fa-caret-right"></i></span>
                                            <strong>Sobre o CNA</strong>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('backend.cna.noticias.index') }}">
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
    </form>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="{{ URL::asset('js/backend/summernote-ptbr.js') }}"></script>
<script>
$(document).ready(function() {
    $(".editor").summernote({
        height:$(".editor").attr("data-height"),
        fontNamesIgnoreCheck: ['Advent Pro', 'Anton', 'Open Sans', 'Oswald','PT Serif','Roboto'],
        lang: 'pt-BR',
        toolbar: [
            ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video', 'hr']],
            ['view', ['fullscreen', 'help']]
        ],
        opover: {
            image: [
                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']]
            ],
            link: [
                ['link', ['linkDialogShow', 'unlink']]
            ],
            table: [
                ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
            ],
            air: [
                ['color', ['color']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']]
            ]
        },
        codeviewFilter: false,
        codeviewIframeFilter: true

    });
    $('.dropify-logo').attr("data-default-file");
    $('.dropify-logo').dropify({
        messages: {
            default: 'Logomarca',
            replace: 'Arraste e solte um arquivo ou clique para substituir',
            remove:  'remover',
            fileSize:   'Desculpe, o arquivo é muito grande'
        }
    });
    var drEvent = $('#photoArtigo').dropify();
    drEvent.on('dropify.beforeClear', function(event, element){
        return confirm("Você tem certeza que deseja excluir a foto?");
    });
    drEvent.on('dropify.afterClear', function(event, element){
        $('#isPhoto').attr('value', 2);
    });

    $(".dropify-logo").change(function(){
        $('#isPhoto').attr('value', 3);
    });

    $('.dropify-imagem_destaque').attr("data-default-file");
    $('.dropify-imagem_destaque').dropify({
        messages: {
            default: 'Imagem destaque',
            replace: 'Arraste e solte um arquivo ou clique para substituir',
            remove:  'remover',
            fileSize:   'Desculpe, o arquivo é muito grande'
        }
    });
    $(".dropify-imagem_destaque").change(function(){
        $('#isPhoto2').attr('value', 3);
    });
});
</script>

@endsection

@include('Backend.Includes.published_at')