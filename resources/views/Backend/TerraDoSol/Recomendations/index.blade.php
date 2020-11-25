@extends('Backend.Layouts.layout')
@section('title', 'Terra do Sol - '.$edicao->title.' - Recomendações')
@section('content')
    <h1>Terra do Sol - {{ $edicao->title }} &raquo; Recomendações</h1>
    <form action="{{ route('backend.ts.recomendations.store', ['edicao' => $edicao->id]) }}" class="form-bordered" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-warning" href="{{route('backend.ts.editions.index')}}">	<i class="fa fa-arrow-left"></i> 
                    VOLTAR
                </a>
                <button type="submit" id="submit-all" class="btn btn-primary pull-right">
                    <i class="fa fa-check"></i>
                    Adicionar
                </button>
                <div class="card mt-3" style="padding:15px;">
                    <div class="form-group">
                        <label for="subtitle">Recomendações</label>
                        <textarea class="form-control editor" name="content" id="content" rows="15" data-height="400">@if(isset($record->content)) {{$record->content}} @endif</textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </section>
@endsection
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

@include('Backend.Includes.published_at')