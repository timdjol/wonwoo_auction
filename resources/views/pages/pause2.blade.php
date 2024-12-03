@extends('layouts.master')

@section('title', 'Ожидание')

@section('content')
    @auth
    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                        <div class="alert alert-warning">Аукцион в ожидании!</div>
                    @if(Request::fullUrl() == route('pause2'))
                        @php
                            $contacts = \App\Models\Contact::first();
                            $now = Carbon\Carbon::parse(Carbon\Carbon::now());
                            $date_auc = Carbon\Carbon::parse($contacts->date_auc)->addSecond(110);
                        @endphp
                        @if($date_auc <= $now)
                            <script>
                                window.location.replace("{{ route('sales') }}?tab=tab-3");
                            </script>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.js"></script>
    <script>
        var sound = new Howl({
            src: ['music/ding.mp3'],
            volume: 0.5,
            autoplay: true,
            loop: false,
        });

        sound.once('load', function(){
            sound.play();
        });

        sound.on('end', function(){
            sound.stop();
        });

        setTimeout(function () {
            window.location.reload(1);
        }, 2000);
    </script>

    <style>
        *, body {
            transition: all 2s ease;
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
