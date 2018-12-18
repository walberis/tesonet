<header class="main-header row">
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-light p-xl-4 p-lg-4 p-md-4 p-sm-4">
    <a class="navbar-brand pl-4" href="{{ route('home') }}"><img src="{{ asset('img/logo-testio.png') }}"> </a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"><span class="btn btn-light"> <span><img class="mr-2" src="{{ asset('img/ico-logout.png') }}"></span>Logout</span></a>
        </li>
    </ul>
</nav>
</header>