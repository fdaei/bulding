<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix("/asset/web/css/main.css")}}">
    <script src="{{asset("vendor/sweetalert/sweetalert.all.js")}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@section('title')صفحه اصلی@show</title>
    @livewireStyles
</head>
<body class="position-relative">
    @include("layouts.web.partial.header",['currentUrl'=>Route::currentRouteName()])
        <h3 class="p-4">پنل کاربری</h3>
    <div class="container-fluid">
        <div class="row" >
{{--            @include("layouts.web.panel.user.sidebar")--}}
            <livewire:user.sidebar-wire >
            <div class="col-sm-8 col-lg-9 p-3 ">
                <div class="border rounded shadow-lg mb-3 h-100">
                    @yield("content")
                </div>
            </div>
        </div>
    </div>
    @include("layouts.web.partial.footer")
    @livewireScripts
    <script src="{{mix("/asset/web/js/main.js")}}"></script>
    @include("layouts.partial.sweet-alert-script")
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
    @include('sweetalert::alert')
</body>
</html>
