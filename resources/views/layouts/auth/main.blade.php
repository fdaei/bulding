<!doctype html>
<html lang="fa-IR" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="shervin yazdan">
    <meta name="author" content="fgpersian">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{mix("/asset/operator/css/main.css")}}">
    <script src="{{asset("vendor/sweetalert/sweetalert.all.js")}}"></script>
    <title>
        @yield('title') |
        {{ config('app.name') }}
    </title>
    @livewireStyles
</head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-12 col-sm-4">
                    @yield('content')
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
        @livewireScripts
    @include("layouts.partial.sweet-alert-script")
    </body>
</html>
