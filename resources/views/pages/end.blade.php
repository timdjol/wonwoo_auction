@extends('layouts.master')

@section('title', 'Аукцион завершился!
')

@section('content')

    @auth
    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Аукцион завершился</h1>
                    <div>
                        <ul class="breadcrumbs">
                            <li><a href="{{ route('index') }}">Главная</a></li>
                            <li>/</li>
                            <li>Аукцион завершился</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.js"></script>

                        <script>
                            var sound = new Howl({
                                src: ['music/audio.mp3'],
                                <!-- Можно, например выставить громкость -->
                                volume: 0.5,
                                <!-- Включить зацикливание проигрывания файла -->
                                autoplay: true,
                                loop: false,
                            });

                            sound.once('load', function(){
                                sound.play();
                            });
                        </script>


                        <div class="alert alert-success">Аукцион завершился!</div>
                        <div class="btn-wrap">
                            <a href="{{ route('index') }}" class="more">Перейти на главную страницу</a>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .page .btn-wrap{
            text-align: center;
            margin-top: 30px;
        }

    </style>
    @else
        <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Авторизация</h1>
                        <div>
                            <ul class="breadcrumbs">
                                <li><a href="{{ route('index') }}">Главная</a></li>
                                <li>/</li>
                                <li>Авторизация</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">Пройдите <a href="{{ route('login') }}">авторизацию</a></div>
                    </div>
                </div>
            </div>
        </div>
    @endauth

@endsection
