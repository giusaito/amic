@extends('Backend.Layouts.layout')
@section('title', 'Projetos')
@section('content')

<section id="link-util">
    <projetos-component home-route="{{ route('backend.index', [], false) }}" list-route="{{ route('backend.projects.lista', [], false) }}"></projetos-component>
</section>

@endsection