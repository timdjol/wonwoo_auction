<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Wonwoo</title>
    <link rel="icon" href="{{ url('/') }}/img/favicon.jpg">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/') }}/img/favicon.jpg">
    <link rel="stylesheet" href="/css/main.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="{{route('index')}}/css/admin.css">
</head>
<body>

<header>
    <div class="head">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-8">
                    <a href="{{ route('index') }}"><img src="{{ url('/') }}/img/logo.svg"></a>
                </div>
                <div class="col-md-10 col-4">
                    <nav>
                        <a href="#" class="toggle-mnu d-xl-none d-lg-none"><span></span></a>
                        <ul>
                            <li class="current"><a href="{{ route('index') }}" target="_blank">Перейти на сайт</a></li>
                            @guest
                                <li><a href="{{route('register')}}">Регистрация</a></li>
                                <li><a href="{{route('login')}}">Войти</a></li>
                            @endguest
                            @auth
                                <li><a href="{{ route('get-logout') }}">Выйти</a></li>
                            @endauth
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

@yield('content')

<footer>
    <div class="copy">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>WonWoo {{ date('Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{route('index')}}/js/scripts.min.js"></script>

</body>
</html>
