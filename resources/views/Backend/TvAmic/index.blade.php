@extends('Backend.Layouts.layout')
@section('title', 'TV Amic')
@section('content')

<section id="tvAmic">
    <tv-amic-component home-route="{{ route('backend.index', [], false) }}" list-route="{{ route('backend.tvamic.index', [], false) }}"></tv-amic-component>
</section>

@endsection