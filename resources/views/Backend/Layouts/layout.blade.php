<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | Painel administrativo</title>
    <link rel="apple-touch-icon" href="{{ URL::asset('favicon/apple-icon-180x180.png') }}">
    <link rel="shortcut icon" href="{{ URL::asset('favicon.png') }}">
    <link href="{{ URL::asset('css/backend/all.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/backend/style.css') }}" rel="stylesheet">

</head>

<body>

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
                        <a href="#">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                @yield('content')
            </div>
            @include("Backend.Layouts.Includes.footer")
        </div>
    </div>
    <script src="{{ URL::asset('js/backend/all.js') }}"></script>
</html>