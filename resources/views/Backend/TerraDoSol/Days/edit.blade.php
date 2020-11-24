@extends('Backend.Layouts.layout')
@section('title', 'Terra do Sol - '.$edicao->title.' - Editar')
@section('content')
<h1>Terra do Sol - {{ $edicao->title }} &raquo; Dias - Editar</h1>
    <form action="{{ route('backend.ts.days.update', ['edicao' => $edicao->id, 'id' => $record->id]) }}" class="form-bordered" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-warning" href="{{route('backend.ts.days.index', ['edicao' => $edicao->id, 'id' => $record->id])}}">	<i class="fa fa-arrow-left"></i> 
                    VOLTAR
                </a>
                <button type="submit" id="submit-all" class="btn btn-primary pull-right">
                    <i class="fa fa-check"></i>
                    Editar
                </button>
                <div class="card mt-3" style="padding:15px;">
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input name="title" type="text" value="{{$record->title}}" class="form-control" id="title" placeholder="Título" required="required">
                    </div>
                    <div class="form-group">
                        <label for="content">Conteúdo</label>
                        <textarea class="form-control editor" name="content" id="content" rows="15" data-height="400">{{$record->content}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="ambient_conditions">Condições do ambiente</label>
                        <textarea class="form-control editor" name="ambient_conditions" id="ambient_conditions" rows="15" data-height="400">{{$record->ambient_conditions}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@include('Backend.Includes.published_at')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="{{ URL::asset('js/backend/summernote-ptbr.js') }}"></script>

<script>
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
    </script>
    
    @endsection