@extends('Backend.Layouts.layout')
@section('title', 'Terra do Sol - '.$edicao->title.' - Checklist - Adicionar')
@section('content')
<h1>Terra do Sol - {{ $edicao->title }} &raquo; Checklist - Adicionar</h1>
    <form action="{{ route('backend.ts.checklist.store', ['edicao' => $edicao->id]) }}" class="form-bordered" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-warning" href="{{route('backend.ts.checklist.index', ['edicao' => $edicao->id])}}">	<i class="fa fa-arrow-left"></i> 
                    VOLTAR
                </a>
                <button type="submit" id="submit-all" class="btn btn-primary pull-right">
                    <i class="fa fa-check"></i>
                    Adicionar
                </button>
                <div class="card mt-3" style="padding:15px;">
                    <div class="form-group">
                        <label for="content">Item</label>
                        <textarea name="content" class="form-control" id="content" required="required" rows="10"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </section>
@endsection

@include('Backend.Includes.published_at')