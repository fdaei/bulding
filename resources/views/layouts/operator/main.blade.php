<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@section('title')پنل مدیریت@show</title>
    <script src="{{asset("vendor/sweetalert/sweetalert.all.js")}}"></script>
    <link rel="stylesheet" href="{{mix("asset/operator/css/main.css")}}">
    <script src="{{asset("vendor/sweetalert/sweetalert.all.js")}}"></script>
{{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}
    @livewireStyles
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
    @include("layouts.operator.partial.navbar")
    @include("layouts.operator.partial.sidebar")
    <div class="content-wrapper">
        @include("layouts.operator.partial.content-header")
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>
    <aside class="control-sidebar control-sidebar-dark"></aside>
    @include("layouts.operator.partial.footer")
</div>
    @include("layouts.partial.sweet-alert-script")
@livewireScripts
<script src="{{mix("asset/operator/js/main.js")}}"></script>
    @yield("script")
@include("layouts.partial.sweet-alert-script")
</body>
</html>
