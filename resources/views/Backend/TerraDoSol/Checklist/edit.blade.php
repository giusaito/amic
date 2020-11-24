@extends('Backend.Layouts.layout')
@section('title', 'Terra do Sol - '.$edicao->title.' - Editar')
@section('content')
<h1>Terra do Sol - {{ $edicao->title }} &raquo; Checklist - Editar</h1>
    <form action="{{ route('backend.ts.checklist.update', ['edicao' => $edicao->id, 'id' => $record->id]) }}" class="form-bordered" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-warning" href="{{route('backend.ts.checklist.index', ['edicao' => $edicao->id, 'id' => $record->id])}}">	<i class="fa fa-arrow-left"></i> 
                    VOLTAR
                </a>
                <button type="submit" id="submit-all" class="btn btn-primary pull-right">
                    <i class="fa fa-check"></i>
                    Editar
                </button>
                <div class="card mt-3" style="padding:15px;">
                    <div class="form-group">
                        <label for="content">Item</label>
                        <input name="content" type="text" value="{{$record->content}}" class="form-control" id="content" placeholder="Item" required="required">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@include('Backend.Includes.published_at')