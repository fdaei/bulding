<!doctype html>
<html lang="fa" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="description" content="سایت () اولین آگهی نامه صنعت ساختمان کرمان می باشد.جهت درج آگهی رایگان ساختمانی در کرمان اقدام نمایید.">
        <link rel="stylesheet" href="{{mix("/asset/web/css/main.css")}}">
        <script src="{{asset("vendor/sweetalert/sweetalert.all.js")}}"></script>
        <meta name="description" content=@yield('description')>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> @yield('title')</title>
{{--        <title>@section('title')صفحه اصلی@show</title>--}}
        @livewireStyles
    </head>
    <body class="position-relative">
    <livewire:web.header-wire />
        @yield("content")
        @include("layouts.web.partial.footer")
        @livewireScripts
        <script src="{{mix("/asset/web/js/main.js")}}"></script>
        @yield("script")
        <script>
            function openNav(button) {
                document.getElementById("sidebar-menu").style.transform = "translate(0,0)";
                const parent = button.parentNode;
                var div = document.createElement("div");
                div.setAttribute("class" , "overlay animation");
                div.setAttribute("onclick" , 'closeNav()');
                parent.appendChild(div);
            }
            function closeNav(){
                document.getElementById("sidebar-menu").style.transform = "translate(100%,0)";
                $(".overlay").remove()
            }
        </script>
    @include("layouts.partial.sweet-alert-script")
    @stack("custom-script")
    </body>
</html>
