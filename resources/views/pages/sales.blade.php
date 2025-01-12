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
                    <div class="page auction listing">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
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
                                        <div class="table-wrap">
                                            <h3>Список участвующих автомобилей</h3>
                                            <table>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Название</th>
                                                    <th>Двигатель</th>
                                                    <th>Коробка</th>
                                                    <th>Год выпуска</th>
                                                    <th># лота</th>
                                                    <th></th>
                                                </tr>
                                                @foreach($cars as $car)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $car->title }}</td>
                                                        <td>{{ $car->engine }}</td>
                                                        <td>{{ $car->transmission }}</td>
                                                        <td>{{ $car->year }}</td>
                                                        <td>{{ $car->lot }}</td>
                                                        <td><a class="more" href="{{ route('product', [isset($category) ? $category->code :
                                    $car->category->code, $car->code])
         }}">Подробнее</a></td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                    @php
                                        $timezone = \Illuminate\Support\Facades\Auth::user()->timezone;
                                    @endphp
                                    <script type="text/javascript">
                                        const timer = document.querySelector("#timer");
                                        const days = document.querySelector("#days");
                                        const hours = document.querySelector("#hours");
                                        const minutes = document.querySelector("#minutes");
                                        const seconds = document.querySelector("#seconds");

                                        // Устанавливаем дату и время, до которого хотим посчитать разницу
                                        let countDownDate = new Date("{{ $date->setTimezone($timezone) }}").getTime();

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
                @elseif($date >= $date->addHour(2) && ($date <= $now))
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
                                <div class="col-md-4">
                                    <style>
                                        #tab-1, #tab-2, #tab-3, #tab-4, #tab-5, #tab-6, #tab-7, #tab-8, #tab-9 {
                                            display: none !important;
                                        }
                                    </style>
                                    @foreach($cars as $car)
                                        @if($loop->iteration == 1)
                                            @if (Request::fullUrl() == route('sales'))
                                                @livewire('count-down')
                                                <style>
                                                    #tab-1 {
                                                        display: block !important;
                                                        position: relative !important;
                                                        top: auto !important;
                                                        left: auto !important;
                                                    }
                                                </style>
                                            @endif
                                        @endif
                                        @if (Request::fullUrl() == route('sales') . '?tab=tab-'.$loop->iteration
                                        .'?product_id='.$car->id)
                                            @livewire('count-down{{ $loop->iteration }}')
                                            <style>
                                                #tab-{{ $loop->iteration }}  {
                                                    display: block !important;
                                                    position: relative !important;
                                                    top: auto !important;
                                                    left: auto !important;
                                                }
                                            </style>
                                        @endif
                                    @endforeach

                                    @if (Request::fullUrl() == route('sales') . '?tab=tab-2')
                                        @livewire('count-down2')
                                        <style>
                                            #tab-2 {
                                                display: block !important;
                                                position: relative !important;
                                                top: auto !important;
                                                left: auto !important;
                                            }
                                        </style>
                                    @endif

                                    @if (Request::fullUrl() == route('sales') . '?tab=tab-3')
                                        @livewire('count-down3')
                                        <style>
                                            #tab-3 {
                                                display: block !important;
                                                position: relative !important;
                                                top: auto !important;
                                                left: auto !important;
                                            }
                                        </style>
                                    @endif
                                    @if (Request::fullUrl() == route('sales') . '?tab=tab-4')
                                        @livewire('count-down4')
                                        <style>
                                            #tab-4 {
                                                display: block !important;
                                                position: relative !important;
                                                top: auto !important;
                                                left: auto !important;
                                            }
                                        </style>
                                    @endif
                                    @if (Request::fullUrl() == route('sales') . '?tab=tab-5')
                                        @livewire('count-down5')
                                        <style>
                                            #tab-5 {
                                                display: block !important;
                                                position: relative !important;
                                                top: auto !important;
                                                left: auto !important;
                                            }
                                        </style>
                                    @endif
                                    @if (Request::fullUrl() == route('sales') . '?tab=tab-6')
                                        @livewire('count-down6')
                                        <style>
                                            #tab-6 {
                                                display: block !important;
                                                position: relative !important;
                                                top: auto !important;
                                                left: auto !important;
                                            }
                                        </style>
                                    @endif
                                    @if (Request::fullUrl() == route('sales') . '?tab=tab-7')
                                        @livewire('count-down7')
                                        <style>
                                            #tab-7 {
                                                display: block !important;
                                                position: relative !important;
                                                top: auto !important;
                                                left: auto !important;
                                            }
                                        </style>
                                    @endif
                                    @if (Request::fullUrl() == route('sales') . '?tab=tab-8')
                                        @livewire('count-down8')
                                        <style>
                                            #tab-8 {
                                                display: block !important;
                                                position: relative !important;
                                                top: auto !important;
                                                left: auto !important;
                                            }
                                        </style>
                                    @endif
                                    @if (Request::fullUrl() == route('sales') . '?tab=tab-9')
                                        @livewire('count-down9')
                                        <style>
                                            #tab-9 {
                                                display: block !important;
                                                position: relative !important;
                                                top: auto !important;
                                                left: auto !important;
                                            }
                                        </style>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="alert alert-info">Количество участвующих
                                        авто: {{ $cars->count() }}</div>
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
                            <div class="alert alert-danger">Необходимо пополнить <a href="{{ route('deposit') }}">депозит</a>!
                            </div>
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



