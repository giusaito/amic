@extends('Backend.Layouts.layout')
@section('title', 'Editar - ' . $record->title)
@section('content')
    <form action="{{ route('backend.ts.editions.update', ['edico' => $record->id]) }} }}" class="form-bordered" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-9 mt-3">
                <a class="btn btn-warning" href="{{route('backend.ts.editions.index')}}">	<i class="fa fa-arrow-left"></i> 
                    VOLTAR
                </a>
                <div class="card mt-3" style="padding:15px;">
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input name="title" type="text" value="{{$record->title}}" class="form-control" id="title" placeholder="Título" required="required">
                    </div>
                    <div class="form-group">
                        <label for="subtitle">Subtítulo</label>
                        <input name="subtitle" type="text" value="{{$record->subtitle}}" class="form-control" id="subtitle" required="required">
                    </div>
                    <div class="form-group" id="inicio_fim_edicao">
                        <label class="font-normal">Período da Edição</label>
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="form-control-sm form-control" name="event_start" value="{{Carbon\Carbon::parse($record->event_start)->format('d/m/Y')}}"/>
                            <span class="input-group-addon"> até </span>
                            <input type="text" class="form-control-sm form-control" name="event_finish" value="{{Carbon\Carbon::parse($record->event_finish)->format('d/m/Y')}}" />
                        </div>
                    </div>
                    <div class="form-group" id="inicio_fim_inscricao">
                        <label class="font-normal">Período da Inscrição</label>
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="form-control-sm form-control" name="subscription_start" value="{{Carbon\Carbon::parse($record->subscription_start)->format('d/m/Y')}}"/>
                            <span class="input-group-addon"> até </span>
                            <input type="text" class="form-control-sm form-control" name="subscription_finish" value="{{Carbon\Carbon::parse($record->subscription_finish)->format('d/m/Y')}}" />
                        </div>
                    </div>
                    <fieldset>
                        <legend>Suspender Evento?</legend>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="onoff-group-text">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                {{-- <input type="checkbox" checked class="onoffswitch-checkbox" id="event_suspended"> --}}
                                                <input type="checkbox" name="event_suspended" @if($record->event_suspended == 'true') checked @endif class="onoffswitch-checkbox" id="event_suspended">
                                                <label class="onoffswitch-label red-sn-label" for="event_suspended">
                                                    <span class="onoffswitch-inner red-sn"></span>
                                                    <span class="onoffswitch-switch red-sn-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                                <input name="event_suspended_cause" type="text" class="form-control" id="event_suspended_cause" placeholder="Qual o motivo de suspender esta edição?">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <button type="submit" id="submit-all" class="btn btn-primary">
                    <i class="fa fa-check"></i>
                        Editar
                </button>
                <div class="card mt-3 mb-3">
                    <div class="card-header">
                        <h5>Logo</h5>
                        <span>Defina a logo da Edição</span>
                    </div>
                    <div class="card-block p-3">
                        <input type="file" name="logo" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M"  @if($record->path) value="{{asset('storage')}}/{{$record->path}}original-{{$record->logo}}" data-default-file="{{asset('storage')}}/{{$record->path}}original-{{$record->logo}}" @endif/>
                        <input type="hidden" name="isPhoto" id="isPhoto" value="{{!empty($record->path) ? 1 : 0}}">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
<link href="{{ URL::asset('css/backend/datepicker3.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/backend/daterangepicker-bs3.css') }}" rel="stylesheet">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
<script src="{{ URL::asset('js/backend/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('js/backend/bootstrap-datepicker.pt-BR.min.js') }}"></script>
<script src="{{ URL::asset('js/backend/daterangepicker.js') }}"></script>

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
var drEvent = $('#photoArtigo').dropify();
drEvent.on('dropify.beforeClear', function(event, element){
return confirm("Você tem certeza que deseja excluir a foto?");
});

$('.input-daterange').datepicker({
keyboardNavigation: false,
forceParse: false,
autoclose: true,
format: "dd/mm/yyyy",
language: "pt-BR"
});
</script>

@endsection

@include('Backend.Includes.published_at')