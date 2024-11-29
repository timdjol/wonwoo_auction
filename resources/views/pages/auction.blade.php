@extends('layouts.master')

@section('title', 'Аукцион')

@section('content')

    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $product->firstOrFail()->title }}</h1>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('index') }}">Главная</a></li>
                        <li>/</li>
                        <li>{{ $product->firstOrFail()->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @if(\Illuminate\Support\Facades\Auth::check())
        <script>
            setTimeout(function(){
                window.location.reload(1);
            }, 2000);
        </script>
    @php
        $contacts = \App\Models\Contact::first();
        $date_auc = Carbon\Carbon::parse($contacts->date_auc);
        $now = Carbon\Carbon::parse(Carbon\Carbon::now());
        $date = strtotime($date_auc->addSecond(59)) - strtotime($now);
    @endphp

{{--    @if(date_diff($now, $date_auc)->days > 1)--}}
    @if($date_auc <= $now)
        <div class="page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="auction-info-item-value clearfix">
                            <div class="alert alert-danger">Аукцион закончился</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "{{ route('index') }}"
            }, 3000);
        </script>
    @else
        <div class="page auction">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 col-md-12">
                        <div class="auction-info-item-value clearfix" style="margin-bottom: 20px">
                            <h4>Аукцион закончится через:</h4>
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
                            let countDownDate = new Date("{{ $date_auc }}").getTime();

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
                                    clearInterval(updateTimer);
                                    if (window.location.href.substr(-2) !== '?r') {
                                        window.location = window.location.href + '?r';
                                    }
                                    timer.innerHTML = "<h2 class='alert alert-danger'>Аукцион завершен</h2>";
                                }
                                // Обновляем функцию с интервалом 1 секунда
                            }, 1000);
                        </script>

                        <form class="form-callback" id="callback" action="{{ route('auctions.store') }}"
                              method="post">
                            <h3>Участие в аукционе</h3>
                            <div class="click">Одна заявка = +{{ $contacts->sum_auc }} сом</div>
                            @csrf
                            @php
                                $csum = \App\Models\Order::where('product_id', $product->firstOrFail()->id)->orderBy('sum', 'desc')->first();
                            @endphp
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <input type="hidden" name="name" value="{{ Auth()->user()->name }}">
                            <input type="hidden" name="email" value="{{ Auth()->user()->email }}">
                            <input type="hidden" name="phone" value="{{ Auth()->user()->phone }}">
                            <input type="hidden" name="product_id" value="{{ $product->firstOrFail()->id }}">
                            <input type="hidden" name="product_title" value="{{ $product->firstOrFail()->title }}">
                            @if($csum != null)
                                <input type="hidden" name="sum" id="sum" value="{{ $csum->sum + $contacts->sum_auc ?? $product->firstOrFail()
                            ->price + $contacts->sum_auc }}">
                            @else
                                <input type="hidden" name="sum" id="sum" value="0">
                            @endif
                            <img src="{{ Storage::url($product->firstOrFail()->image) }}" alt="">
                            <h5>Ваша ставка: <a><span
                                            id="clicks">
                                        @if($csum != null)
                                            {{ number_format($csum->sum + $contacts->sum_auc) ?? number_format(
                                            $product->firstOrFail()->price + $contacts->sum_auc) }}
                                        @else
                                            {{ number_format($product->firstOrFail()->price + $contacts->sum_auc)}}
                                        @endif
                                    </span>
                                    сом</h5>
{{--                            <script>--}}
{{--                                let clicks = {{ $csum->sum ?? $product->firstOrFail()->price }};--}}
{{--                                function onClick() {--}}
{{--                                    clicks += {{ $contacts->sum_auc }};--}}
{{--                                    document.getElementById("clicks").innerHTML = clicks;--}}
{{--                                    $('#sum').val(clicks);--}}
{{--                                }--}}
{{--                            </script>--}}
{{--                            <a class="more" onClick="onClick()">Добавить +</a>--}}
                            <button class="more">Отправить заявку</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @else


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
    @endif


@endsection



<style>
    body, html{
        transition: all .7s ease;
    }
</style>

