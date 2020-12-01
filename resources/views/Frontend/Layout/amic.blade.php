<!DOCTYPE html>
<html lang=pt-BR>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1">
    <meta name="web-author" content="Leonardo Nascimento, Giuliano Saito - BEWWEB">
    <meta name="reply-to" content="leonardo.nascimento21@gmail.com, giulianosaito@gmail.com">
    <title>AMIC OESTE - @yield('title')</title>
    <link rel="icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/dist/plugins.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/dist/style.min.css')}}">
    <link rel="canonical" href="{{env('APP_URL')}}">
    @yield('css')
</head>
<body>
    <noscript>Você precisa habilitar o javascript para rodar esse portal</noscript>
    @yield('content')
<script src="{{asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/plugins.js')}}"></script>
<script src="{{asset('frontend/assets/js/dist/main.prod.js')}}"></script>
@yield('js')
</body>
</html>
