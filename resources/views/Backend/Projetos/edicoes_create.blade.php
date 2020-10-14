@extends('Backend.Layouts.layout')
@section('title', 'Projetos &raquo; Edições')
@section('content')

<section id="link-util">
   {{-- {{dd($projeto)}} --}}
    <edicoes-component home-route="{{ route('backend.index', [], false) }}" projetos-route="{{ route('backend.projetos.index', [], false) }}" edicoes-save-route="{{ route('backend.edicoes.store', [], false) }}" :projeto="{{ $projeto }}"></edicoes-component>
</section>

@endsection