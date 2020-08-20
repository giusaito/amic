@extends('Backend.Layouts.layout')
@section('title', 'Projetos')
@section('content')

<section id="link-util">
    <projetos-component home-route="{{ route('backend.index') }}"></projetos-component>
</section>

@endsection