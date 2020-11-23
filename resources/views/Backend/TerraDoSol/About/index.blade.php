@extends('Backend.Layouts.layout')
@section('title', 'Terra do Sol - '.$edicao->title.' - Sobre')
@section('content')
    <h1>Terra do Sol - {{ $edicao->title }} &raquo; Sobre</h1>
    <form action="{{ route('backend.ts.about.store', ['edicao' => $edicao->id]) }}" class="form-bordered" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9 mt-3">
                <a class="btn btn-warning" href="{{route('backend.ts.editions.index')}}">	<i class="fa fa-arrow-left"></i> 
                    VOLTAR
                </a>
                <div class="card mt-3" style="padding:15px;">
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input name="title" type="text" class="form-control" id="title" placeholder="Título" required="required">
                    </div>
                    <div class="form-group">
                        <label for="subtitle">Subtítulo</label>
                        <textarea class="form-control editor" name="content" id="content" rows="15" data-height="400">{{old('content')}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <button type="submit" id="submit-all" class="btn btn-primary">
                    <i class="fa fa-check"></i>
                        Adicionar
                </button>
                <div class="card mt-3 mb-3">
                    <div class="card-header">
                        <h5>Imagem 1</h5>
                        <span>Defina a Imagem</span>
                    </div>
                    <div class="card-block p-3">
                        <input type="file" name="image1" class="dropify1" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M"/>
                        <input type="hidden" name="isPhoto1" id="isPhoto1" value="{{!empty($record->path1) ? 1 : 0}}">
                    </div>
                </div>
                <div class="card mt-3 mb-3">
                    <div class="card-header">
                        <h5>Imagem 2</h5>
                        <span>Defina a Imagem</span>
                    </div>
                    <div class="card-block p-3">
                        <input type="file" name="image2" class="dropify2" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M"/>
                        <input type="hidden" name="isPhoto2" id="isPhoto2" value="{{!empty($record->path2) ? 1 : 0}}">
                    </div>
                </div>
            </div>
        </div>
    </form>
    </section>
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
$('.dropify1').attr("data-default-file");
$('.dropify1').dropify({
    messages: {
        default: 'Arraste e solte um arquivo aqui ou clique',
        replace: 'Arraste e solte um arquivo ou clique para substituir',
        remove:  'remover',
        fileSize:   'Desculpe, o arquivo é muito grande'
    }
});
$(".dropify1").change(function(){
    $('#isPhoto1').attr('value', 3);
});

$('.dropify2').attr("data-default-file");
$('.dropify2').dropify({
    messages: {
        default: 'Arraste e solte um arquivo aqui ou clique',
        replace: 'Arraste e solte um arquivo ou clique para substituir',
        remove:  'remover',
        fileSize:   'Desculpe, o arquivo é muito grande'
    }
});
$(".dropify2").change(function(){
    $('#isPhoto2').attr('value', 3);
});

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