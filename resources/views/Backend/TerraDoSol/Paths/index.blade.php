@extends('Backend.Layouts.layout')
@section('title', 'Terra do Sol - '.$edicao->title.' - Percurso')
@section('content')
    <h1>Terra do Sol - {{ $edicao->title }} &raquo; Percurso</h1>
    <form action="{{ route('backend.ts.paths.store', ['edicao' => $edicao->id]) }}" class="form-bordered" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9 mt-3">
                <a class="btn btn-warning" href="{{route('backend.ts.editions.index')}}">	<i class="fa fa-arrow-left"></i> 
                    VOLTAR
                </a>
                <div class="card mt-3" style="padding:15px;">
                    <div class="form-group">
                        <label for="video">Vídeo</label>
                        <input name="video" type="text" class="form-control" id="video" placeholder="Iframe" required="required" value="@if($record) {{$record->video}} @endif">
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
                        <h5>Mapa</h5>
                        <span>Defina a Imagem</span>
                    </div>
                    <div class="card-block p-3">
                        <input type="file" name="map" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M"  @if($record) value="{{asset('storage')}}/{{$record->path}}original-{{$record->map}}" data-default-file="{{asset('storage')}}/{{$record->path}}original-{{$record->map}}" @endif/>
                        <input type="hidden" name="isPhoto" id="isPhoto" value="{{!empty($record->path) ? 1 : 0}}">
                    </div>
                </div>
            </div>
        </div>
    </form>
    </section>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>

<script>
$('.dropify').attr("data-default-file");
$('.dropify').dropify({
    messages: {
        default: 'Arraste e solte um arquivo aqui ou clique',
        replace: 'Arraste e solte um arquivo ou clique para substituir',
        remove:  'remover',
        fileSize:   'Desculpe, o arquivo é muito grande'
    }
});
$(".dropify").change(function(){
    $('#isPhoto').attr('value', 3);
});
</script>

@endsection

@include('Backend.Includes.published_at')