@extends('Backend.Layouts.layout')
@section('title', 'Terra do Sol - '.$edicao->title.' - Fotos')
@section('content')
    <h1>Terra do Sol - {{ $edicao->title }} &raquo; Fotos</h1>
        <div class="row">
            <div class="col-md-12 mt-3">
                <a class="btn btn-warning" href="{{route('backend.ts.editions.index')}}">	<i class="fa fa-arrow-left"></i> 
                    VOLTAR
                </a>
                {!! csrf_field() !!}
                <div class="file-loading">
                    {{-- <input id="input-700" name="kartik-input-700[]" type="file" data-browse-on-zone-click="true" multiple> --}}
                    <input id="file-1" type="file" name="file" multiple data-browse-on-zone-click="true" data-overwrite-initial="false" data-min-file-count="1">
                </div>
            </div>
        </div>
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
    $("#file-1").fileinput({
        @if($records)
            initialPreview: [@foreach($records as $record) '{{asset('storage')}}/{{ $record->path}}original-{{$record->image}}', @endforeach],
            initialPreviewAsData: true,
            initialPreviewConfig: [
                @foreach($records as $record) 
                            {caption: "{{asset('storage')}}/{{ $record->path}}original-{{$record->image}}", key: {{$record->id}}},
                @endforeach
            ],
        @endif
        language: "pt-BR",
        uploadUrl: "{{ route('backend.ts.pictures.store', ['edicao' => $edicao->id]) }}",
        deleteUrl: "{{ route('backend.ts.pictures.destroy') }}",
        uploadExtraData: function() {
            return {
                _token: $("input[name='_token']").val(),
            };
        },
        deleteExtraData: function() {
            return {
                _token: $("input[name='_token']").val(),
            };
        },
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        overwriteInitial: false,
        maxFileSize:2000,
        maxFilesNum: 10,
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });
    $('#file-1').on('fileuploaded', function(event, data, previewId, index) {
        $('#'+previewId).attr('data-id',data['response']['key']);

    });
});
</script>

@endsection

@include('Backend.Includes.published_at')