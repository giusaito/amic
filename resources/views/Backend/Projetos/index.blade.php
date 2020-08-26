@extends('Backend.Layouts.layout')
@section('title', 'Projetos')
@section('content')

<section id="link-util">
    <projetos-component home-route="{{ route('backend.index') }}" list-route="{{ route('backend.projects.lista') }}"></projetos-component>
</section>

@endsection