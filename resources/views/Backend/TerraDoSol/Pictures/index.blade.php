@extends('Backend.Layouts.layout')
@section('title', 'Terra do Sol - '.$edicao->title.' - Fotos')
@section('content')
    <h1>Terra do Sol - {{ $edicao->title }} &raquo; Fotos</h1>
    <form action="{{ route('backend.ts.paths.store', ['edicao' => $edicao->id]) }}" class="form-bordered" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12 mt-3">
                <a class="btn btn-warning" href="{{route('backend.ts.editions.index')}}">	<i class="fa fa-arrow-left"></i> 
                    VOLTAR
                </a>
                <div class="file-loading">
                    <input id="input-700" name="kartik-input-700[]" type="file" data-browse-on-zone-click="true" multiple>
                </div>
            </div>
        </div>
    </form>
    </section>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/css/fileinput.min.css" />
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/js/locales/pt-BR.min.js"></script>

<script>
$(document).ready(function() {
    $("#input-700").fileinput({
        language: "pt-BR",
        uploadUrl: "/file-upload-single/1",
        allowedFileExtensions: ["jpg", "png", "gif"],
        maxFileCount: 20
    });
});
</script>

@endsection

@include('Backend.Includes.published_at')