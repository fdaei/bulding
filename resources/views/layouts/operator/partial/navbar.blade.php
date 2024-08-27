<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{route("operator.changePassword")}}">
                <i class="fal fa-lock-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route("operator.profile")}}">
                <i class="fal fa-user"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route("logout")}}">
                <i class="fal fa-power-off"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
