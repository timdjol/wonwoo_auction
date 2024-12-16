@extends('layouts.master')

@section('title', 'Аукцион')

@section('content')

    @auth
        @if(\Illuminate\Support\Facades\Auth::user()->status == 1)
            @php
                $now = Carbon\Carbon::parse(Carbon\Carbon::now());
                $date = Carbon\Carbon::parse($contacts->date_auc);
            @endphp
            @if($cars->isEmpty())
                <div class="page">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-warning">Автомобили на аукцион не выставлены</div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            @if($date >= $now)
                <div class="page auction">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2 col-md-12">
                                <div class="auction-info-item-value clearfix" style="margin-bottom: 20px">
                                    <h4>Аукцион начнется через:</h4>
                                    <div class="timer" id="timer">
                                        <span id="timeDiff">
                                            <span class="timer-item timer-dd">
                                                <span class="timer-value" id="days">00</span>
                                                <span class="timer-word">Дн.</span>
                                            </span>
                                            <span class="timer-item timer-hh">
                                                <span class="timer-value" id="hours">00</span>
                                                <span class="timer-word">Час.</span>
                                            </span>
                                            <span class="timer-item timer-mm">
                                                <span class="timer-value" id="minutes">00</span>
                                                <span class="timer-word">Мин.</span>
                                            </span>
                                            <span class="timer-item timer-ss">
                                                <span class="timer-value" id="seconds">00</span>
                                                <span class="timer-word">Сек.</span>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    const timer = document.querySelector("#timer");
                                    const days = document.querySelector("#days");
                                    const hours = document.querySelector("#hours");
                                    const minutes = document.querySelector("#minutes");
                                    const seconds = document.querySelector("#seconds");

                                    // Устанавливаем дату и время, до которого хотим посчитать разницу
                                    let countDownDate = new Date("{{ $date }}").getTime();

                                    let updateTimer = setInterval(function () {
                                        // Получаем текущее дату и время
                                        let now = new Date().getTime();
                                        // Находим разницу между текущим временем и заданным
                                        let difference = countDownDate - now;

                                        // Рассчитываем дни, часы, минуты и секунды
                                        let daysDif = Math.floor(difference / (1000 * 60 * 60 * 24));
                                        let hoursDif = Math.floor(
                                            (difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
                                        );
                                        let minutesDif = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                                        let secondsDif = Math.floor((difference % (1000 * 60)) / 1000);

                                        // Вставляем значения в таймер
                                        days.innerHTML = daysDif;
                                        hours.innerHTML = hoursDif;
                                        minutes.innerHTML = minutesDif;
                                        seconds.innerHTML = secondsDif;

                                        // Когда таймер дойдет до заданной даты и времени
                                        if (difference < 0) {
                                            window.location.reload(1);
                                        }
                                        // Обновляем функцию с интервалом 1 секунда
                                    }, 1000);
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($date >= $date->addHour(6) && ($date <= $now))
                <div class="page">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger">Аукцион не начался!</div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                    <div class="page sales" id="example-two">
                        <div class="container">
                            <div class="row" style="margin-bottom: 10px">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="alert alert-info">Количество участвующих авто: {{ $cars->count() }}</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="alert alert-info">Количество активных участников: {{ $users->count()
                                }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @livewire('price-update')
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @else
            <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Пополните баланс</h1>
                            <ul class="breadcrumbs">
                                <li><a href="{{ route('index') }}">Главная</a></li>
                                <li>/</li>
                                <li>Пополните баланс</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">Необходимо пополнить <a href="{{ route('deposit') }}">депозит</a>!</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Авторизация</h1>
                        <ul class="breadcrumbs">
                            <li><a href="{{ route('index') }}">Главная</a></li>
                            <li>/</li>
                            <li>Авторизация</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">Необходимо пройти <a href="{{ route('login')
                        }}">авторизацию</a></div>
                    </div>
                </div>
            </div>
        </div>

    @endauth
@endsection



