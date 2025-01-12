<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - WonWoo Auction</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Template Basic Images Start -->
    <meta property="og:image" content="path/to/image.jpg">
    <link rel="icon" href="{{ url('/') }}/img/favicon.jpg">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/') }}/img/favicon.jpg">
    <!-- Template Basic Images End -->
    <!-- Custom Browsers Color Start -->
    <meta name="theme-color" content="#000">
    <!-- Custom Browsers Color End -->
    <link rel="stylesheet" href="{{route('index')}}/css/main.min.css">
    <link rel="stylesheet" href="{{route('index')}}/css/style.css?ver=2.0">

    @livewireStyles

</head>
<body>

@php
    $contacts = \App\Models\Contact::first();
@endphp
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-8">
                <div class="logo">
                    <a href="{{route('index')}}">
                        <img src="{{ url('/') }}/img/logo.svg">
                    </a>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-4">
                <nav>
                    <a href="#" class="toggle-mnu d-xl-none d-lg-none"><span></span></a>
                    <ul>
                        <li @routeactive(
                        'index')><a href="{{ route('index') }}">Главная</a></li>
                        <li @routeactive(
                        'catalog')><a href="{{ route('catalog') }}">Список аукционов</a></li>
                        <li @routeactive(
                        'stock')><a href="{{ route('stock') }}">Авто в наличии</a></li>
                        <li @routeactive(
                        'about')><a href="{{ route('about') }}">О сервисе</a></li>
                        <li @routeactive(
                        'contact')><a href="{{ route('contactspage') }}">Контакты</a></li>
                        @guest
                            <li class="d-xl-none d-lg-none d-block"><a class="more" href="{{ route('login')
                        }}">Войти</a></li>
                            <li class="d-xl-none d-lg-none d-block"><a href="{{route('register')}}">Регистрация</a></li>
                        @endguest
                        @auth
                            <li class="d-xl-none d-lg-none d-block"><a class="more" href="{{ route('get-logout') }}">Выйти</a></li>
                        @endauth
                        @foreach($currencies as $currency)
                            <li class="d-xl-none d-lg-none d-block"
                                    @if($currencySymbol == $currency->symbol) class="current"
                                    @endif
                            ><a href="{{ route('currency', $currency->code) }}">{{ $currency->symbol
                                }}</a></li>
                        @endforeach
                    </ul>
                    <ul class="icons">
                        <li><a href="#search"><img class="search" src="{{ url('/') }}/img/search.svg" alt=""></a></li>
                        <li>
                            @if (Auth::check())
                                <a href="{{ route('wishlist') }}">
                                    <img class="wish" src="{{ url('/') }}/img/wishlist.svg" alt="">
                                </a>
                            @else
                                <a href="{{ route('login') }}">
                                    <img class="wish" src="{{ url('/') }}/img/wishlist.svg" alt="">
                                </a>
                            @endif
                        </li>
                        <li><a href="{{ route('login') }}">
                                <img src="{{ url('/') }}/img/user.png" alt="">
                                @auth
                                    <small>{{ \Illuminate\Support\Facades\Auth::user()->name }}</small>
                                @endauth
                            </a>
                        </li>
                    </ul>
                    <div class="currency d-xl-inline-block d-lg-inline-block d-none">
                        <ul>
                            @foreach($currencies as $currency)
                                <li
                                        @if($currencySymbol == $currency->symbol) class="current"
                                        @endif
                                ><a href="{{ route('currency', $currency->code) }}">{{ $currency->symbol
                                }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('success'))
                <p class="alert alert-success">{{ session()->get('success') }}</p>
            @endif
            @if(session()->has('warning'))
                <p class="alert alert-warning">{{ session()->get('warning') }}</p>
            @endif
        </div>
    </div>
</div>

@yield('content')

<footer>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <div class="logo">
                            <img src="{{ url('/') }}/img/logo.svg">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4>Категории</h4>
                        <ul>
                            @foreach($categories as $category)
                                <li><a href="{{ route('category', $category->code) }}">{{ $category->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4>Информация</h4>
                        <ul>
                            <li><a href="{{ route('policy') }}">Политика конфиденциальности</a></li>
                            <li><a href="{{ route('oferta') }}">Договор оферты</a></li>
                            <li><a href="{{ route('dogovor') }}">Условия использования сервиса</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4>Контакты</h4>
                        <ul>
                            <li><a href="">{{ $contacts->phone }}</a></li>
                            <li><a href="">{{ $contacts->phone2 }}</a></li>
                            <li><a href="">{{ $contacts->email }}</a></li>
                        </ul>
                        <ul class="soc">
                            <li><a href="{{ $contacts->instagram }}" target="_blank"><img src="{{ url('/')
                            }}/img/instagram.svg" alt=""></a>
                            </li>
                            <li><a href="{{ $contacts->facebook }}" target="_blank"><img src="{{ url('/')
                            }}/img/facebook.svg" alt=""></a></li>
                            <li><a href="{{ $contacts->tiktok }}" target="_blank"><img src="{{ url('/')
                            }}/img/tiktok.svg" alt=""></a></li>
                            <li><a href="https://wa.me/{{ $contacts->whatsapp }}" target="_blank"><img src="{{ url('/')
                            }}/img/whatsapp.svg" alt=""></a></li>
                            <li><a href="{{ $contacts->telegram }}" target="_blank"><img src="{{ url('/')
                            }}/img/telegram.svg" alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Все права защищены &copy; {{date('Y')}} WonWoo Auction</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="search">
    <form action="{{ route('search') }}">
        <input type="text" placeholder="Поиск..." name="search">
    </form>
</div>

<script src="{{route('index')}}/js/scripts.min.js"></script>

@livewireScripts

</body>

</html>
