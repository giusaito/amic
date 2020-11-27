@extends('Backend.Layouts.layout')
@section('title', 'Terra do Sol - '.$edicao->title.' - Patrocinadores - Adicionar')
@section('content')
<h1>Terra do Sol - {{ $edicao->title }} &raquo; Patrocinadores - Adicionar</h1>
    <form action="{{ route('backend.ts.sponsors.store', ['edicao' => $edicao->id]) }}" class="form form-vertical" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-warning" href="{{route('backend.ts.sponsors.index', ['edicao' => $edicao->id])}}">
                    <i class="fa fa-arrow-left"></i> 
                    VOLTAR
                </a>
                <button type="submit" id="submit-all" class="btn btn-primary pull-right">
                    <i class="fa fa-check"></i>
                    Adicionar
                </button>
                <div class="card mt-3" style="padding:15px;">
                    <div class="row">
                        <div class="col-sm-4 text-center">
                            <div class="kv-avatar">
                                <div class="file-loading">
                                    <input id="file" name="file" type="file" required>
                                </div>
                            </div>
                            <div class="kv-avatar-hint">
                                <small>Arquivo deve ser menor que 1500 KB</small>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="title">Empresa<span class="kv-reqd">*</span></label>
                                        <input type="text" class="form-control" name="title" id="title" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="url">Site da empresa</label>
                                        <input type="text" class="form-control" name="url" id="url">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <hr>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </section>
@endsection

@include('Backend.Includes.published_at')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/css/fileinput.min.css" />
<style>
.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar {
    display: inline-block;
}
.kv-avatar .file-input {
    display: table-cell;
    width: 100%;
}
.kv-reqd {
    color: red;
    font-family: monospace;
    font-weight: normal;
}
.krajee-default.file-preview-frame .kv-file-content {
    width:auto !important;
    height: auto !important;
}
</style>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/js/locales/pt-BR.min.js"></script>
<script>
var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
    'onclick="alert(\'Call your custom code here.\')">' +
    '<i class="glyphicon glyphicon-tag"></i>' +
    '</button>'; 
$("#file").fileinput({
    overwriteInitial: true,
    maxFileSize: 1500,
    showClose: false,
    showCaption: false,
    browseLabel: '&nbsp;Selecionar Logomarca',
    removeLabel: '&nbsp;Remover Logomarca',
    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
    removeTitle: 'Cancelar alterações',
    elErrorContainer: '#kv-avatar-errors-1',
    msgErrorClass: 'alert alert-block alert-danger',
    defaultPreviewContent: '<img src="/images/no-logo.png" alt="Logo" class="img-fluid">',
    // layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
    layoutTemplates: {main2: '{preview} {remove} {browse}'},
    allowedFileExtensions: ["jpg", "png", "gif"],
    language: "pt-BR",
    uploadUrl: "{{ route('backend.ts.sponsors.store', ['edicao' => $edicao->id]) }}",
});
</script>
@endsection