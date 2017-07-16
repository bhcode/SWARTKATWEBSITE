<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    <!--Jquery Script-->
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Fortuna Group Limited') }}</title>
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-grid.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-reboot.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stickyfooter.css') }}" rel="stylesheet">

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

</head>
<body>
<div class="page-wrap">
    <nav class="navbar navbar-toggleable-md navbar-inverse bg-primary nav-custom-border">
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'FGL Data Site') }}</a>
        <ul class="navbar-nav">
            @if (Auth::guest())
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                </li>
            @else
                <li class="nav-item">
                    <a href="/home" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();" class="nav-link">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endif
        </ul>
    </nav>
    <div class="container p-3">
        <br><br>
        @yield('content')
    </div>
    <br><br>
</div>
</div>
<footer class="site-footer">
    <div class="container p-3">
        <small>
            Fortuna Group Limited<span class="text-muted ml-1">July 2017</span><br>
            <strong>
                @if(\Illuminate\Support\Facades\Auth::user())
                    <a href="home" class="mr-2"  style="color:#3a3a3a; text-decoration: none">Dashboard</a>
                    <a href="user-settings" class="mr-2" style="color:#828282; text-decoration: none">Settings</a>
                    @can('access.admin')
                        <a href="manage-farms" class="mr-2"  style="color:#828282; text-decoration: none">Manage Farms</a>
                        <a href="modify-users" class="mr-2"  style="color:#828282; text-decoration: none">Modify Users</a>
                    @endcan
                @endcan
                <a href="userguide" class="mr-2" style="color:#828282; text-decoration: none">User Guide</a>
            </strong>
        </small>

</footer>
</body>

<script>
    window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!}};
</script>

</html>
