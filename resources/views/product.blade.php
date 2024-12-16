@extends('layouts.master')

@section('title', $product->title)

@section('content')

    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 data-aos="fade-up" data-aos-duration="2000">{{ $product->title }}</h1>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('index') }}">Главная</a></li>
                        <li>/</li>
                        <li><a href="{{ route('catalog') }}">Cписок аукционов</a></li>
                        <li>/</li>
                        <li>{{ $product->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="page single">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="fotorama" data-allowfullscreen="true" data-nav="thumbs" data-loop="true"
                         data-autoplay="3000">
                        <img loading="lazy" src="{{ Storage::url($product->image) }}" alt="">
                        @foreach($images as $image)
                            <img loading="lazy" src="{{ Storage::url($image->image) }}" alt="">
                        @endforeach
                    </div>

                    @php
                        $user = \Illuminate\Support\Facades\Auth::user();
                        $services = explode(', ', $product->complex);
                        $contacts = \App\Models\Contact::first();
                        $date_auc = Carbon\Carbon::parse($contacts->date_auc);
                        $now = Carbon\Carbon::parse(Carbon\Carbon::now());
                    @endphp

                    @if($user == null || $user->is_admin != 1)
                        @if($date_auc >= $now)
                            <div class="auction-info-item-value clearfix">
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
                                let countDownDate = new Date("{{ $contacts->date_auc }}").getTime();

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
                                        timer.innerHTML = "<h2 class='alert alert-success'>Аукцион начался</h2>";
                                    }
                                    // Обновляем функцию с интервалом 1 секунда
                                }, 1000);
                            </script>
                        @endif
                    @endif

                </div>
                <div class="col-lg-5 col-md-12">
                    <h3>Технические характеристики</h3>
                    <ul>
                        <li>Год выпуска: {{ $product->year }}</li>
                        <li>Двигатель: {{ $product->engine }}</li>
                        <li>Мощность: {{ $product->power }} л.с.</li>
                        <li>Объем: {{ $product->volume }}</li>
                        <li>Расположение руля: {{ $product->steer }}</li>
                        <li>Вид топлива: {{ $product->oil }}</li>
                        <li>Коробка: {{ $product->transmission }}</li>
                        <li>Цвет: {{ $product->color }}</li>
                        <li>Привод: {{ $product->drive }}</li>
                        <li>Шины: {{ $product->type_wheel }}</li>
                        <li>Размер колес: {{ $product->size }}</li>
                        <li>Материал салона: {{ $product->salon_material }}</li>
                        <li>Цвет салона: {{ $product->salon_color }}</li>
                        <li>Количество мест: {{ $product->count_place }}</li>
                        <li>VIN: {{ $product->vin }}</li>
                        <li>Пробег: {{ number_format($product->mile) }} км</li>
                        <li>Номер авто: {{ $product->markup }}</li>
                        <li>Номер паркинга: {{ $product->parking }}</li>
                        <li>Состояние: {{ $product->state }} из 10</li>
                        <li>Тип собственности: {{ $product->type_own }}</li>
                    </ul>
                    <ul class="tabs">
                        <li data-tab="tab-1" class="current">Аукцион</li>
                        <li data-tab="tab-2">Продажа</li>
                    </ul>
                    <div class="tab-content current" id="tab-1">
                        <h3>Статус лота</h3>
                        <ul>
                            <li>Номер лота: {{ $product->lot }}</li>
                            <li>Класс: {{ $product->class }}</li>
                            <li>Дата аукциона: {{ $product->dateLot }}</li>
                            <li>Статус торгов: {{ $product->stick }}</li>
                        </ul>
                        <div class="price"><b>Стартовая цена:</b> {{ number_format($product->price) }} сом</div>
                        <div class="btn-wrap">
                            @if(\Illuminate\Support\Facades\Auth::check())
                                @if($date_auc <= $now)
                                    @if($user->status === 1 )
                                        <a href="{{ route('sales') }}"
                                           class="more">Участвовать</a>
                                    @else
                                        <div class="alert alert-danger tt" style="margin-bottom: 20px">Для участия
                                            необходимо <a href="{{ route('deposit') }}">внести депозит</a>
                                        </div>
                                    @endif
                                @endif
                            @else
                                <div class="tt" style="margin-bottom: 20px">Для участия в аукционе необходимо <a href="{{
                            route('login') }}">войти в систему</a></div>
                            @endif
                            <a href="#protocol" class="more history">История авто</a>
                        </div>
                    </div>
                    <div class="tab-content" id="tab-2">
                        <div class="price"><b>Цена продажи:</b> {{ number_format($product->price_sale) }} сом</div>
                        <div class="btn-wrap">
                            <a href="#callback" class="more">Купить</a>
                        </div>
                        <div class="hidden">
                            <form action="{{ route('orderform') }}" id="callback" class="form-callback"
                                  method="post">
                                <button title="Close (Esc)" type="button" class="mfp-close">×</button>
                                @csrf
                                <input type="hidden" name="product_title" value="{{ $product->title}}">
                                <input type="hidden" name="product_price" value="{{ $product->price_sale}}">
                                <div class="img">
                                    <img src="{{ Storage::url($product->image) }}" alt="">
                                </div>
                                <h3>Купить {{ $product->title }}</h3>
                                <div class="form-group">
                                    <label for="">Ваше имя</label>
                                    <input type="text" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="">Номер телефона</label>
                                    <input type="number" id="phone" name="phone">
                                </div>
                                <button class="more" id="send">Отправить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="options">
        <div class="container">
            <row>
                <div class="col-md-12">
                    <table>
                        <tr>
                            <td>Комплектация</td>
                            <td>
                                <div class="row">
                                    <div class="row">
                                        @foreach($services as $service)
                                            <div class="col-md-4">
                                                <div class="item">
                                                    <input type="checkbox" checked>
                                                    <label for="">{{ $service }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </row>
        </div>
    </div>

    <div class="youtube">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $product->youtube
                    }}?si=IJzT9i7beuCUT0Yi"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <div class="col-md-6">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $product->youtube2
                    }}?si=IJzT9i7beuCUT0Yi"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <div class="warning">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-wrap">
                        <h2>Внимание!!!</h2>
                        <ul>
                            <li>Неметаллические или съемные и прикрепляемые детали исключаются из проверки, а из-за
                                характера подержанных автомобилей не указываются частичная окраска и незначительный
                                листовой металл.
                            </li>
                            <li>Из-за особенностей подержанных автомобилей, таких как сиденья и внутренняя отделка,
                                износ и царапины не указываются.
                            </li>
                            <li>Поперечина и опора радиатора не указаны.</li>
                            <li>Царапины на лобовом стекле и мелкие повреждения менее 1 см не указываются.</li>
                            <li>Изготовленные дополнительные детали не маркируются отдельно, а рабочее состояние не
                                подлежит проверке.
                            </li>
                            <li>Если фотография и проверка производительности различаются, фотография имеет приоритет.
                            </li>
                            <li>Требуется фактическая проверка транспортного средства] Для целевого транспортного
                                средства требуется проверка на месте.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="maket">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="plan">
                        @isset($product->plk)
                            <div class="title plk">{{$product->plk}}</div>
                        @endisset
                        @if($product->pld != '')
                            <div class="title pld">{{$product->pld}}</div>
                        @endisset
                        @if($product->zld != '')
                            <div class="title zld">{{$product->zld}}</div>
                        @endisset
                        @if($product->zlk != '')
                            <div class="title zlk">{{$product->zlk}}</div>
                        @endisset

                        @if($product->pt != '')
                            <div class="title pt">{{$product->pt}}</div>
                        @endisset
                        @isset($product->pll)
                            <div class="title pll">{{$product->pll}}</div>
                        @endisset
                        @isset($product->ppl)
                            <div class="title ppl">{{$product->ppl}}</div>
                        @endisset
                        @isset($product->pk)
                            <div class="title pk">{{$product->pk}}</div>
                        @endisset
                        @isset($product->k)
                            <div class="title k">{{$product->k}}</div>
                        @endisset
                        @isset($product->zk)
                            <div class="title zk">{{$product->zk}}</div>
                        @endisset
                        @isset($product->zll)
                            <div class="title zll">{{$product->zll}}</div>
                        @endisset
                        @isset($product->zpl)
                            <div class="title zpl">{{$product->zpl}}</div>
                        @endisset
                        @isset($product->zt)
                            <div class="title zt">{{$product->zt}}</div>
                        @endisset


                        @isset($product->ppk)
                            <div class="title ppk">{{$product->ppk}}</div>
                        @endisset
                        @isset($product->ppd)
                            <div class="title ppd">{{$product->ppd}}</div>
                        @endisset
                        @isset($product->zpd)
                            <div class="title zpd">{{$product->zpd}}</div>
                        @endisset
                        @isset($product->zpk)
                            <div class="title zpk">{{$product->zk}}</div>
                        @endisset

                        <svg width="736"
                             height="561">
                            <!--left -->
                            @isset($product->plk)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path" data-title="PLK"
                                        d="m 21.857273,94.942529 1.02456,-42.860746 4.952038,-5.464318 2.902919,-1.19532 23.906392,0.17076 8.196478,2.04912 11.099396,5.805838 7.001158,6.147358 2.561399,4.098238 1.53684,3.756719 3.244438,12.294716 11.440917,63.010416 2.732162,20.4912 0.8538,16.56371 -6.659641,2.5614 -14.173076,-1.87836 -15.539155,-1.02456 -16.392954,-0.34152 -17.075995,0.17076 v -11.61167 l 7.171918,-0.51228 8.196477,-2.39064 7.684198,-3.92748 6.659638,-6.31812 4.610518,-7.51344 2.390639,-8.87951 0.51228,-12.12396 -2.561399,-11.27016 -6.830398,-10.24559 -8.196477,-5.293562 -12.977756,-3.756719 -14.685355,-0.17076 h -2.561399 z"
                                        id="path1"/></path>
                            @endisset
                            @isset($product->pld)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path" data-title="PLD"
                                        d="m 32.977939,179.7568 29.463897,0.27031 19.192079,1.08124 14.596793,1.89218 1.621866,38.92478 1.892177,45.14194 0.540619,20.81394 -7.839016,-3.78435 -12.434305,-1.89218 -12.974927,-0.27031 -17.840524,0.81093 -15.948348,1.89218 z"
                                        id="path2"/>
                            @endisset
                            @isset($product->zld)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path ZLD"
                                        d="m 33.24825,285.44839 14.867104,-1.62186 11.353061,-0.54063 10.271817,-0.27031 9.190573,0.27031 12.704616,1.62187 8.10933,3.78435 46.223179,10.27182 -0.54062,21.62488 -3.78436,28.65296 -5.67653,22.70612 -6.48746,23.51706 -22.70612,7.02809 -11.623376,3.24373 -9.731195,-2.16249 -15.678037,-8.37964 V 384.1119 l -4.324975,-9.7312 -10.81244,-9.73119 -9.460884,-4.05467 -11.893683,-2.70311 z"
                                        id="path3"/>
                            @endisset
                            @isset($product->zlk)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path ZLK"
                                        d="m 69.740232,396.81651 14.326482,7.2984 10.542128,2.4328 33.788868,-9.7312 -11.35306,31.08577 -7.29839,15.94834 -1.62187,10.54213 -1.35155,25.40923 -15.40773,3.78436 -46.493488,4.59529 -7.839018,-0.81094 -4.595287,-3.51404 -5.406219,-51.89971 H 38.65447 l 10.271817,-2.16249 7.568707,-3.51404 6.757775,-7.02808 4.054664,-7.83902 2.70311,-7.83902 z"
                                        id="path4"/>
                            @endisset

                            <!--center -->
                            @isset($product->pt)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path PT"
                                        d="m 177.59431,1.0812439 164.34908,0.270311 2.16248,1.8921768 V 16.218659 l -2.16248,2.432798 -163.53814,0.270311 -3.51405,-2.703109 0.27031,-13.5155492 z"
                                        id="path5"/>
                            @endisset
                            @isset($product->pll)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path PLL"
                                        d="m 177.324,27.031098 46.49349,0.270311 2.16249,1.892177 v 9.190573 l -1.89218,1.892177 H 177.324 l -2.4328,-2.432799 v -9.460884 z"
                                        id="path6"/>
                            @endisset
                            @isset($product->prl)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path PRL"
                                        d="m 295.4499,27.301409 46.49349,0.270311 2.16248,1.892177 v 8.649951 l -1.89217,2.162488 h -45.41225 l -4.05466,-2.162488 0.27031,-9.190573 z"
                                        id="path7"/>
                            @endisset
                            @isset($product->pk)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path PK"
                                        d="m 171.37716,192.73173 v -40.27634 l 1.62187,-33.78887 2.97342,-26.760788 4.86559,-15.137414 7.83902,-11.623372 10.27182,-7.568708 10.81244,-5.135908 13.24524,-3.784354 15.40772,-2.973421 18.11084,-1.351555 20.54363,0.540622 19.7327,2.973421 17.29991,5.135909 12.70461,7.298396 4.8656,4.324976 4.59529,5.135908 5.40622,9.731195 3.78435,12.704616 1.89218,13.245237 1.62186,24.5983 0.81093,28.38265 0.54063,34.3295 -9.7312,-0.81094 -1.89218,-6.75777 -4.86559,-6.48746 -14.05617,-7.02809 -22.97644,-7.02808 -16.75928,-2.70311 -22.1655,-0.27032 -16.48897,1.62187 -22.70612,4.32498 -13.51555,4.05466 -12.16399,4.32498 -5.40622,2.4328 -2.70311,8.10932 -0.27031,5.13591 -7.83902,0.54062 z"
                                        id="path8"/>
                            @endisset
                            @isset($product->k)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path K"
                                        d="m 205.212,242.33045 19.08949,-2.12105 24.92239,-1.59079 23.3316,-0.53026 22.27107,1.06052 20.68028,2.12106 3.18158,54.61714 1.59079,44.54215 -0.53026,53.02635 -11.13554,5.30264 -19.08949,4.77237 -24.39212,2.12105 -23.86186,-2.12105 -16.43817,-2.12105 -16.96844,-6.36317 -5.30263,-3.71184 1.59079,-30.75529 0.53026,-32.34608 0.53026,-39.2395 z"
                                        id="path9"/>
                            @endisset
                            @isset($product->zk)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path ZK"
                                        d="m 194.07647,433.22534 17.4987,4.77237 14.84738,2.12106 19.61975,2.12105 h 23.3316 l 22.27107,-1.06053 18.02896,-2.12105 16.96843,-4.24211 5.30264,41.89082 -20.15002,5.30264 -24.92239,3.18158 -18.55922,1.06053 h -16.96844 l -13.25658,-0.53027 -12.72633,-1.59079 -17.4987,-2.12105 -13.25659,-3.71185 -6.36316,-3.71184 z"
                                        id="path10"/>
                            @endisset
                            @isset($product->zll)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path ZLL"
                                        d="m 178.37488,491.18407 46.07819,0.23751 1.90013,1.66262 v 9.26314 l -2.13765,1.90013 -45.84067,-0.47503 -2.61269,-2.13765 v -9.26314 z"
                                        id="path11"/>
                            @endisset
                            @isset($product->zpl)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path ZPL"
                                        d="m 296.76842,491.58828 46.07819,0.23751 1.90013,1.66262 v 9.26314 l -2.13765,1.90013 -45.84067,-0.47503 -2.61269,-2.13765 v -9.26314 z"
                                        id="path11-3"/>
                            @endisset
                            @isset($product->zt)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path ZT"
                                        d="m 177.89984,512.56055 163.41133,0.23752 2.61268,2.37516 0.23752,11.63831 -2.37516,3.56274 -164.59892,-0.47503 -2.13765,-1.90013 v -13.06341 z"
                                        id="path12"/>
                            @endisset

                            <!--right -->
                            @isset($product->ppk)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path PPK"
                                        d="m 501.77031,95.410916 -1.02456,-42.86075 -4.95204,-5.464318 -2.90292,-1.19532 -23.90639,0.17076 -8.19647,2.04912 -11.0994,5.805838 -7.00116,6.147358 -2.5614,4.098238 -1.53684,3.756719 -3.24444,12.294715 -11.44091,63.010414 -2.73217,20.4912 -0.85379,16.56371 6.65964,2.5614 14.17307,-1.87836 15.53916,-1.02456 16.39295,-0.34152 17.07599,0.17076 v -11.61167 l -7.17192,-0.51228 -8.19647,-2.39064 -7.6842,-3.92748 -6.65964,-6.31812 -4.61051,-7.51344 -2.39064,-8.87951 -0.51228,-12.12396 2.5614,-11.27016 6.83039,-10.24559 8.19648,-5.293556 12.97775,-3.756718 14.68536,-0.17076 h 2.5614 z"
                                        id="path1-2"/>
                            @endisset
                            @isset($product->ppd)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path PPD"
                                        d="m 489.95805,179.89991 -29.4639,0.27031 -19.19208,1.08124 -14.59679,1.89218 -1.62187,38.92478 -1.89217,45.14194 -0.54062,20.81394 7.83901,-3.78435 12.43431,-1.89218 12.97492,-0.27031 17.84053,0.81093 15.94835,1.89218 z"
                                        id="path2-0"/>
                            @endisset
                            @isset($product->zpd)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path ZPD"
                                        d="m 490.61521,285.92479 -14.8671,-1.62186 -11.35306,-0.54063 -10.27182,-0.27031 -9.19057,0.27031 -12.70462,1.62187 -8.10933,3.78435 -46.22318,10.27182 0.54062,21.62488 3.78436,28.65296 5.67653,22.70612 6.48746,23.51706 22.70612,7.02809 11.62338,3.24373 9.73119,-2.16249 15.67804,-8.37964 V 384.5883 l 4.32497,-9.7312 10.81244,-9.73119 9.46089,-4.05467 11.89368,-2.70311 z"
                                        id="path3-7"/>
                            @endisset
                            @isset($product->zpk)
                                <path
                                        style="fill:rgba(255,0,0,.15);" class="path ZPK"
                                        d="m 453.87472,397.19553 -14.32648,7.2984 -10.54213,2.4328 -33.78887,-9.7312 11.35306,31.08577 7.29839,15.94834 1.62187,10.54213 1.35155,25.40923 15.40773,3.78436 46.49349,4.59529 7.83901,-0.81094 4.59529,-3.51404 5.40622,-51.89971 h -11.62337 l -10.27182,-2.16249 -7.56871,-3.51404 -6.75777,-7.02808 -4.05466,-7.83902 -2.70311,-7.83902 z"
                                        id="path4-6"/>
                            @endisset

                            <img src="{{ route('index') }}/img/bg_car1.png" alt="" usemap="#map" id="image-map"
                                 class="map">

                        </svg>
                    </div>

                    <table>
                        <tr>
                            <th>Условный знак</th>
                            <th>Описание</th>
                        </tr>
                        <tr>
                            <td><b>K</b></td>
                            <td>Крашенная деталь</td>
                        </tr>
                        <tr>
                            <td><b>З</b></td>
                            <td>Деталь нужно заменить</td>
                        </tr>
                        <tr>
                            <td><b>Ш</b></td>
                            <td>Деталь была шпаклевана</td>
                        </tr>
                        <tr>
                            <td><b>С</b></td>
                            <td>Деталь была сварена</td>
                        </tr>
                        <tr>
                            <td><b>Ц</b></td>
                            <td>Деталь имеет царапины</td>
                        </tr>
                        <tr>
                            <td><b>X</b></td>
                            <td>Замененая деталь</td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="protocol" id="protocol">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Протокол осмотра</h2>
                    <table>
                        <tr>
                            <th>Наименование</th>
                            <th>Оценка</th>
                            <th>Изображения</th>
                        </tr>
                        <tr>
                            <td>Двигатель</td>
                            <td>
                                @if($product->tengine == 'Требуется замена')
                                    <span>{{ $product->tengine }}</span>
                                @elseif($product->tengine == 'Требуется вложение')
                                    <span style="color: orange">{{ $product->tengine }}</span>
                                @elseif($product->tengine == 'Отличное состояние')
                                    <span style="color: green">{{ $product->tengine }}</span>
                                @else
                                    {{ $product->tengine }}
                                @endif
                            </td>
                            <td class="gallery">
                                @foreach($engines as $image)
                                    <a href="{{ Storage::url($image->image) }}"><img loading="lazy"
                                                                                     src="{{ Storage::url($image->image) }}"
                                                                                     width="100px"></a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Коробка</td>
                            <td>
                                @if($product->ttransmission == 'Требуется замена')
                                    <span>{{ $product->ttransmission }}</span>
                                @elseif($product->ttransmission == 'Требуется вложение')
                                    <span style="color: orange">{{ $product->tengine }}</span>
                                @elseif($product->ttransmission == 'Отличное состояние')
                                    <span style="color: green">{{ $product->ttransmission }}</span>
                                @else
                                    {{ $product->ttransmission }}
                                @endif
                            </td>
                            <td class="gallery">
                                @foreach($transmissions as $image)
                                    <a href="{{ Storage::url($image->image) }}"><img loading="lazy"
                                                                                     src="{{ Storage::url($image->image) }}"
                                                                                     width="100px"></a>
                                @endforeach
                            </td>
                        </tr>
                        {{--                        <tr>--}}
                        {{--                            <td>Рулевое управление</td>--}}
                        {{--                            <td>{{ $product->ttransmission }}</td>--}}
                        {{--                        </tr>--}}
                        <tr>
                            <td>Подвеска</td>
                            <td>
                                @if($product->tsuspension == 'Требуется замена')
                                    <span>{{ $product->tsuspension }}</span>
                                @elseif($product->tsuspension == 'Требуется вложение')
                                    <span style="color: orange">{{ $product->tsuspension }}</span>
                                @elseif($product->tsuspension == 'Отличное состояние')
                                    <span style="color: green">{{ $product->tsuspension }}</span>
                                @else
                                    {{ $product->tsuspension }}
                                @endif
                            </td>
                            <td class="gallery">
                                @foreach($suspensions as $image)
                                    <a href="{{ Storage::url($image->image) }}"><img loading="lazy"
                                                                                     src="{{ Storage::url($image->image) }}"
                                                                                     width="100px"></a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Тормозная система</td>
                            <td>
                                @if($product->tbrake == 'Требуется замена')
                                    <span>{{ $product->tbrake }}</span>
                                @elseif($product->tbrake == 'Требуется вложение')
                                    <span style="color: orange">{{ $product->tbrake }}</span>
                                @elseif($product->tbrake == 'Отличное состояние')
                                    <span style="color: green">{{ $product->tbrake }}</span>
                                @else
                                    {{ $product->tbrake }}
                                @endif
                            </td>
                            <td class="gallery">
                                @foreach($brakes as $image)
                                    <a href="{{ Storage::url($image->image) }}"><img loading="lazy"
                                                                                     src="{{ Storage::url($image->image) }}"
                                                                                     width="100px"></a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Салон</td>
                            <td>
                                @if($product->tsalon == 'Требуется замена')
                                    <span>{{ $product->tsalon }}</span>
                                @elseif($product->tsalon == 'Требуется вложение')
                                    <span style="color: orange">{{ $product->tsalon }}</span>
                                @elseif($product->tsalon == 'Отличное состояние')
                                    <span style="color: green">{{ $product->tsalon }}</span>
                                @else
                                    {{ $product->tsalon }}
                                @endif
                            </td>
                            <td class="gallery">
                                @foreach($salons as $image)
                                    <a href="{{ Storage::url($image->image) }}"><img loading="lazy"
                                                                                     src="{{ Storage::url($image->image) }}"
                                                                                     width="100px"></a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Кузовные элементы</td>
                            <td>
                                @if($product->tbody == 'Требуется замена')
                                    <span>{{ $product->tbody }}</span>
                                @elseif($product->tbody == 'Требуется вложение')
                                    <span style="color: orange">{{ $product->tbody }}</span>
                                @elseif($product->tbody == 'Отличное состояние')
                                    <span style="color: green">{{ $product->tbody }}</span>
                                @else
                                    {{ $product->tbody }}
                                @endif
                            </td>
                            <td class="gallery">
                                @foreach($bodies as $image)
                                    <a href="{{ Storage::url($image->image) }}"><img loading="lazy"
                                                                                     src="{{ Storage::url($image->image) }}"
                                                                                     width="100px"></a>
                                @endforeach
                            </td>
                        </tr>

                    </table>
                    <h3>Комментарий СТО</h3>
                    {{ $product->comment }}
                </div>
            </div>
        </div>
    </div>


    <div class="cars">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 data-aos="fade-up" data-aos-duration="2000">Другие аукционы</h2>
                </div>
            </div>
            <div class="row">
                @foreach($related as $product)
                    <div class="col-lg-3 col-md-6">
                        @include('layouts.card')
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection



