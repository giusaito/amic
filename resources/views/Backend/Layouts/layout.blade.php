<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ Auth::user()->id }}">

    <title>@yield('title') | Painel administrativo</title>
    <link rel="apple-touch-icon" href="{{ URL::asset('favicon/apple-icon-180x180.png') }}">
    <link rel="shortcut icon" href="{{ URL::asset('favicon.png') }}">
    <link href="{{ URL::asset('css/backend/all.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/backend/style.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        {{-- <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens> --}}
        <div id="wrapper">
            @include("Backend.Layouts.Includes.sidebar")
            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" method="post" action="#">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>

                            {!! Form::open(['method' => 'POST', 'route' => 'logout']) !!}
                            {!! Form::button('<i class="fa fa-sign-out"></i> Sair', ['type'=>'submit', 'class'=>'logout-button','onclick' => 'return confirm("Você tem certeza que deseja sair do Painel administrativo?");']) !!}
                            {!! Form::close() !!}
                        </li>
                    </ul>

                </nav>
                </div>
                @yield('content')
                @include("Backend.Layouts.Includes.footer")
            </div>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/backend/all.js') }}"></script>
</html>