<div wire:poll.1s>
    <ul class="nav whiskey-tabs">
        @foreach ($cars as $car)
            @if($loop->iteration==1)
                <li><a href="#tab-1" class="current">{{ $car->title }}</a></li>
            @else
                <li><a href="#tab-{{ $loop->iteration }}">{{ $car->title }}</a></li>
            @endif
        @endforeach
    </ul>
    <div class="list-wrap">
    @foreach($cars as $car)
            @php
                $csum = \App\Models\Order::where('product_id', $car->id)->orderBy('sum', 'desc')->first();
            @endphp
            @if($loop->iteration == 1)
                <div id="tab-{{$loop->iteration}}">
                    <div class="row sales-item">
                        <div class="col-md-9 order-xl-1 order-lg-1 order-md-2 order-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="parking">
                                        № лота: {{ $car->lot }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="indicator">
                                        <div class="dot green"></div>
                                        <div class="dot yellow"></div>
                                        <div class="dot red"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="price">
                                        @if($csum)
                                            {{ number_format($csum->sum)}} сом
                                        @else
                                            {{ number_format($car->price) }} сом
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px">
                                <div class="col-md-7">
                                    <h3>{{ $car->title }}</h3>
                                    <div class="block year">Год
                                        выпуска: {{ $car->year }}</div>
                                    <div class="block engine">
                                        Двигатель: {{ $car->engine }}</div>
                                    <div class="block steer">Расположение
                                        руля: {{ $car->steer }}</div>
                                    <div class="block transmission">
                                        Коробка: {{ $car->transmission }}</div>
                                </div>
                                <div class="col-md-5">
                                    <img src="{{ Storage::url($car->image) }}" alt="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="plan">
                                        @isset($car->plk)
                                            <div class="title plk">{{$car->plk}}</div>
                                        @endisset
                                        @if($car->pld != '')
                                            <div class="title pld">{{$car->pld}}</div>
                                        @endisset
                                        @if($car->zld != '')
                                            <div class="title zld">{{$car->zld}}</div>
                                        @endisset
                                        @if($car->zlk != '')
                                            <div class="title zlk">{{$car->zlk}}</div>
                                        @endisset

                                        @if($car->pt != '')
                                            <div class="title pt">{{$car->pt}}</div>
                                        @endisset
                                        @isset($car->pll)
                                            <div class="title pll">{{$car->pll}}</div>
                                        @endisset
                                        @isset($car->ppl)
                                            <div class="title ppl">{{$car->ppl}}</div>
                                        @endisset
                                        @isset($car->pk)
                                            <div class="title pk">{{$car->pk}}</div>
                                        @endisset
                                        @isset($car->k)
                                            <div class="title k">{{$car->k}}</div>
                                        @endisset
                                        @isset($car->zk)
                                            <div class="title zk">{{$car->zk}}</div>
                                        @endisset
                                        @isset($car->zll)
                                            <div class="title zll">{{$car->zll}}</div>
                                        @endisset
                                        @isset($car->zpl)
                                            <div class="title zpl">{{$car->zpl}}</div>
                                        @endisset
                                        @isset($car->zt)
                                            <div class="title zt">{{$car->zt}}</div>
                                        @endisset


                                        @isset($car->ppk)
                                            <div class="title ppk">{{$car->ppk}}</div>
                                        @endisset
                                        @isset($car->ppd)
                                            <div class="title ppd">{{$car->ppd}}</div>
                                        @endisset
                                        @isset($car->zpd)
                                            <div class="title zpd">{{$car->zpd}}</div>
                                        @endisset
                                        @isset($car->zpk)
                                            <div class="title zpk">{{$car->zk}}</div>
                                        @endisset

                                        <svg width="736"
                                             height="561">
                                            <!--left -->
                                            @isset($car->plk)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path"
                                                        data-title="PLK"
                                                        d="m 21.857273,94.942529 1.02456,-42.860746 4.952038,-5.464318 2.902919,-1.19532 23.906392,0.17076 8.196478,2.04912 11.099396,5.805838 7.001158,6.147358 2.561399,4.098238 1.53684,3.756719 3.244438,12.294716 11.440917,63.010416 2.732162,20.4912 0.8538,16.56371 -6.659641,2.5614 -14.173076,-1.87836 -15.539155,-1.02456 -16.392954,-0.34152 -17.075995,0.17076 v -11.61167 l 7.171918,-0.51228 8.196477,-2.39064 7.684198,-3.92748 6.659638,-6.31812 4.610518,-7.51344 2.390639,-8.87951 0.51228,-12.12396 -2.561399,-11.27016 -6.830398,-10.24559 -8.196477,-5.293562 -12.977756,-3.756719 -14.685355,-0.17076 h -2.561399 z"
                                                        id="path1"/></path>
                                            @endisset
                                            @isset($car->pld)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path"
                                                        data-title="PLD"
                                                        d="m 32.977939,179.7568 29.463897,0.27031 19.192079,1.08124 14.596793,1.89218 1.621866,38.92478 1.892177,45.14194 0.540619,20.81394 -7.839016,-3.78435 -12.434305,-1.89218 -12.974927,-0.27031 -17.840524,0.81093 -15.948348,1.89218 z"
                                                        id="path2"/>
                                            @endisset
                                            @isset($car->zld)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path ZLD"
                                                        d="m 33.24825,285.44839 14.867104,-1.62186 11.353061,-0.54063 10.271817,-0.27031 9.190573,0.27031 12.704616,1.62187 8.10933,3.78435 46.223179,10.27182 -0.54062,21.62488 -3.78436,28.65296 -5.67653,22.70612 -6.48746,23.51706 -22.70612,7.02809 -11.623376,3.24373 -9.731195,-2.16249 -15.678037,-8.37964 V 384.1119 l -4.324975,-9.7312 -10.81244,-9.73119 -9.460884,-4.05467 -11.893683,-2.70311 z"
                                                        id="path3"/>
                                            @endisset
                                            @isset($car->zlk)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path ZLK"
                                                        d="m 69.740232,396.81651 14.326482,7.2984 10.542128,2.4328 33.788868,-9.7312 -11.35306,31.08577 -7.29839,15.94834 -1.62187,10.54213 -1.35155,25.40923 -15.40773,3.78436 -46.493488,4.59529 -7.839018,-0.81094 -4.595287,-3.51404 -5.406219,-51.89971 H 38.65447 l 10.271817,-2.16249 7.568707,-3.51404 6.757775,-7.02808 4.054664,-7.83902 2.70311,-7.83902 z"
                                                        id="path4"/>
                                            @endisset

                                            <!--center -->
                                            @isset($car->pt)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path PT"
                                                        d="m 177.59431,1.0812439 164.34908,0.270311 2.16248,1.8921768 V 16.218659 l -2.16248,2.432798 -163.53814,0.270311 -3.51405,-2.703109 0.27031,-13.5155492 z"
                                                        id="path5"/>
                                            @endisset
                                            @isset($car->pll)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path PLL"
                                                        d="m 177.324,27.031098 46.49349,0.270311 2.16249,1.892177 v 9.190573 l -1.89218,1.892177 H 177.324 l -2.4328,-2.432799 v -9.460884 z"
                                                        id="path6"/>
                                            @endisset
                                            @isset($car->prl)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path PRL"
                                                        d="m 295.4499,27.301409 46.49349,0.270311 2.16248,1.892177 v 8.649951 l -1.89217,2.162488 h -45.41225 l -4.05466,-2.162488 0.27031,-9.190573 z"
                                                        id="path7"/>
                                            @endisset
                                            @isset($car->pk)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path PK"
                                                        d="m 171.37716,192.73173 v -40.27634 l 1.62187,-33.78887 2.97342,-26.760788 4.86559,-15.137414 7.83902,-11.623372 10.27182,-7.568708 10.81244,-5.135908 13.24524,-3.784354 15.40772,-2.973421 18.11084,-1.351555 20.54363,0.540622 19.7327,2.973421 17.29991,5.135909 12.70461,7.298396 4.8656,4.324976 4.59529,5.135908 5.40622,9.731195 3.78435,12.704616 1.89218,13.245237 1.62186,24.5983 0.81093,28.38265 0.54063,34.3295 -9.7312,-0.81094 -1.89218,-6.75777 -4.86559,-6.48746 -14.05617,-7.02809 -22.97644,-7.02808 -16.75928,-2.70311 -22.1655,-0.27032 -16.48897,1.62187 -22.70612,4.32498 -13.51555,4.05466 -12.16399,4.32498 -5.40622,2.4328 -2.70311,8.10932 -0.27031,5.13591 -7.83902,0.54062 z"
                                                        id="path8"/>
                                            @endisset
                                            @isset($car->k)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path K"
                                                        d="m 205.212,242.33045 19.08949,-2.12105 24.92239,-1.59079 23.3316,-0.53026 22.27107,1.06052 20.68028,2.12106 3.18158,54.61714 1.59079,44.54215 -0.53026,53.02635 -11.13554,5.30264 -19.08949,4.77237 -24.39212,2.12105 -23.86186,-2.12105 -16.43817,-2.12105 -16.96844,-6.36317 -5.30263,-3.71184 1.59079,-30.75529 0.53026,-32.34608 0.53026,-39.2395 z"
                                                        id="path9"/>
                                            @endisset
                                            @isset($car->zk)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path ZK"
                                                        d="m 194.07647,433.22534 17.4987,4.77237 14.84738,2.12106 19.61975,2.12105 h 23.3316 l 22.27107,-1.06053 18.02896,-2.12105 16.96843,-4.24211 5.30264,41.89082 -20.15002,5.30264 -24.92239,3.18158 -18.55922,1.06053 h -16.96844 l -13.25658,-0.53027 -12.72633,-1.59079 -17.4987,-2.12105 -13.25659,-3.71185 -6.36316,-3.71184 z"
                                                        id="path10"/>
                                            @endisset
                                            @isset($car->zll)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path ZLL"
                                                        d="m 178.37488,491.18407 46.07819,0.23751 1.90013,1.66262 v 9.26314 l -2.13765,1.90013 -45.84067,-0.47503 -2.61269,-2.13765 v -9.26314 z"
                                                        id="path11"/>
                                            @endisset
                                            @isset($car->zpl)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path ZPL"
                                                        d="m 296.76842,491.58828 46.07819,0.23751 1.90013,1.66262 v 9.26314 l -2.13765,1.90013 -45.84067,-0.47503 -2.61269,-2.13765 v -9.26314 z"
                                                        id="path11-3"/>
                                            @endisset
                                            @isset($car->zt)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path ZT"
                                                        d="m 177.89984,512.56055 163.41133,0.23752 2.61268,2.37516 0.23752,11.63831 -2.37516,3.56274 -164.59892,-0.47503 -2.13765,-1.90013 v -13.06341 z"
                                                        id="path12"/>
                                            @endisset

                                            <!--right -->
                                            @isset($car->ppk)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path PPK"
                                                        d="m 501.77031,95.410916 -1.02456,-42.86075 -4.95204,-5.464318 -2.90292,-1.19532 -23.90639,0.17076 -8.19647,2.04912 -11.0994,5.805838 -7.00116,6.147358 -2.5614,4.098238 -1.53684,3.756719 -3.24444,12.294715 -11.44091,63.010414 -2.73217,20.4912 -0.85379,16.56371 6.65964,2.5614 14.17307,-1.87836 15.53916,-1.02456 16.39295,-0.34152 17.07599,0.17076 v -11.61167 l -7.17192,-0.51228 -8.19647,-2.39064 -7.6842,-3.92748 -6.65964,-6.31812 -4.61051,-7.51344 -2.39064,-8.87951 -0.51228,-12.12396 2.5614,-11.27016 6.83039,-10.24559 8.19648,-5.293556 12.97775,-3.756718 14.68536,-0.17076 h 2.5614 z"
                                                        id="path1-2"/>
                                            @endisset
                                            @isset($car->ppd)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path PPD"
                                                        d="m 489.95805,179.89991 -29.4639,0.27031 -19.19208,1.08124 -14.59679,1.89218 -1.62187,38.92478 -1.89217,45.14194 -0.54062,20.81394 7.83901,-3.78435 12.43431,-1.89218 12.97492,-0.27031 17.84053,0.81093 15.94835,1.89218 z"
                                                        id="path2-0"/>
                                            @endisset
                                            @isset($car->zpd)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path ZPD"
                                                        d="m 490.61521,285.92479 -14.8671,-1.62186 -11.35306,-0.54063 -10.27182,-0.27031 -9.19057,0.27031 -12.70462,1.62187 -8.10933,3.78435 -46.22318,10.27182 0.54062,21.62488 3.78436,28.65296 5.67653,22.70612 6.48746,23.51706 22.70612,7.02809 11.62338,3.24373 9.73119,-2.16249 15.67804,-8.37964 V 384.5883 l 4.32497,-9.7312 10.81244,-9.73119 9.46089,-4.05467 11.89368,-2.70311 z"
                                                        id="path3-7"/>
                                            @endisset
                                            @isset($car->zpk)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path ZPK"
                                                        d="m 453.87472,397.19553 -14.32648,7.2984 -10.54213,2.4328 -33.78887,-9.7312 11.35306,31.08577 7.29839,15.94834 1.62187,10.54213 1.35155,25.40923 15.40773,3.78436 46.49349,4.59529 7.83901,-0.81094 4.59529,-3.51404 5.40622,-51.89971 h -11.62337 l -10.27182,-2.16249 -7.56871,-3.51404 -6.75777,-7.02808 -4.05466,-7.83902 -2.70311,-7.83902 z"
                                                        id="path4-6"/>
                                            @endisset

                                            <img src="{{ route('index') }}/img/bg_car1.png"
                                                 alt=""
                                                 usemap="#map"
                                                 id="image-map"
                                                 class="map">
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 order-xl-2 order-lg-2 order-md-1 order-1">
                            <ul class="tabs">
                                <li class="tab-link current" data-tab="tab-1">Характеристики
                                    авто
                                </li>
                                <li><a href="{{ route('listings') }}" target="_blank">Список
                                        авто</a></li>
                                <form action="{{ route('auctions.store') }}" method="post">
                                    <div class="click">Одна заявка =
                                        +{{ $contacts->sum_auc }} сом
                                    </div>
                                    @csrf
                                    <input type="hidden" name="date" value="{{ now() }}">
                                    <input type="hidden" name="user_id"
                                           value="{{ Auth::id() }}">
                                    <input type="hidden" name="name"
                                           value="{{ Auth()->user()->name }}">
                                    <input type="hidden" name="email"
                                           value="{{ Auth()->user()->email }}">
                                    <input type="hidden" name="phone"
                                           value="{{ Auth()->user()->phone }}">
                                    <input type="hidden" name="product_id"
                                           value="{{ $car->id }}">
                                    <input type="hidden" name="product_title"
                                           value="{{ $car->title }}">
                                    <input type="hidden" name="lot" value="{{ $car->lot }}">
                                    @if($csum != null)
                                        <input type="hidden" name="sum" id="sum" value="{{ $csum->sum +
                                                  $contacts->sum_auc ?? $car->price + $contacts->sum_auc }}">
                                    @else
                                        <input type="hidden" name="sum" id="sum"
                                               value="{{ $car->price + $contacts->sum_auc }}">
                                    @endif
                                    @empty($user_orders)
                                        <button class="more" id="send">Отправить
                                            заявку</button>
                                    @else
                                        @if($orders > $user_orders)
                                            <button class="more" id="send">Отправить
                                                заявку</button>
                                        @else
                                            <button disabled class="more"
                                                    id="send">Отправить заявку</button>
                                        @endif
                                    @endempty
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            @else
                <div id="tab-{{$loop->iteration}}" class="hide">
                    <div class="row sales-item">
                        <div class="col-md-9 order-xl-1 order-lg-1 order-md-2 order-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="parking">
                                        № паркинга: {{ $car->parking }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="indicator">
                                        <div class="dot green"></div>
                                        <div class="dot yellow"></div>
                                        <div class="dot red"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="price">
                                        @if($csum)
                                            {{ number_format($csum->sum)}} сом
                                        @else
                                            {{ number_format($car->price) }} сом
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px">
                                <div class="col-md-7">
                                    <h3>{{ $car->title }}</h3>
                                    <div class="block year">Год
                                        выпуска: {{ $car->year }}</div>
                                    <div class="block engine">
                                        Двигатель: {{ $car->engine }}</div>
                                    <div class="block steer">Расположение
                                        руля: {{ $car->steer }}</div>
                                    <div class="block transmission">
                                        Коробка: {{ $car->transmission }}</div>
                                </div>
                                <div class="col-md-5">
                                    <img src="{{ Storage::url($car->image) }}" alt="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="plan">
                                        @isset($car->plk)
                                            <div class="title plk">{{$car->plk}}</div>
                                        @endisset
                                        @if($car->pld != '')
                                            <div class="title pld">{{$car->pld}}</div>
                                        @endisset
                                        @if($car->zld != '')
                                            <div class="title zld">{{$car->zld}}</div>
                                        @endisset
                                        @if($car->zlk != '')
                                            <div class="title zlk">{{$car->zlk}}</div>
                                        @endisset

                                        @if($car->pt != '')
                                            <div class="title pt">{{$car->pt}}</div>
                                        @endisset
                                        @isset($car->pll)
                                            <div class="title pll">{{$car->pll}}</div>
                                        @endisset
                                        @isset($car->ppl)
                                            <div class="title ppl">{{$car->ppl}}</div>
                                        @endisset
                                        @isset($car->pk)
                                            <div class="title pk">{{$car->pk}}</div>
                                        @endisset
                                        @isset($car->k)
                                            <div class="title k">{{$car->k}}</div>
                                        @endisset
                                        @isset($car->zk)
                                            <div class="title zk">{{$car->zk}}</div>
                                        @endisset
                                        @isset($car->zll)
                                            <div class="title zll">{{$car->zll}}</div>
                                        @endisset
                                        @isset($car->zpl)
                                            <div class="title zpl">{{$car->zpl}}</div>
                                        @endisset
                                        @isset($car->zt)
                                            <div class="title zt">{{$car->zt}}</div>
                                        @endisset


                                        @isset($car->ppk)
                                            <div class="title ppk">{{$car->ppk}}</div>
                                        @endisset
                                        @isset($car->ppd)
                                            <div class="title ppd">{{$car->ppd}}</div>
                                        @endisset
                                        @isset($car->zpd)
                                            <div class="title zpd">{{$car->zpd}}</div>
                                        @endisset
                                        @isset($car->zpk)
                                            <div class="title zpk">{{$car->zk}}</div>
                                        @endisset

                                        <svg width="736"
                                             height="561">
                                            <!--left -->
                                            @isset($car->plk)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path"
                                                        data-title="PLK"
                                                        d="m 21.857273,94.942529 1.02456,-42.860746 4.952038,-5.464318 2.902919,-1.19532 23.906392,0.17076 8.196478,2.04912 11.099396,5.805838 7.001158,6.147358 2.561399,4.098238 1.53684,3.756719 3.244438,12.294716 11.440917,63.010416 2.732162,20.4912 0.8538,16.56371 -6.659641,2.5614 -14.173076,-1.87836 -15.539155,-1.02456 -16.392954,-0.34152 -17.075995,0.17076 v -11.61167 l 7.171918,-0.51228 8.196477,-2.39064 7.684198,-3.92748 6.659638,-6.31812 4.610518,-7.51344 2.390639,-8.87951 0.51228,-12.12396 -2.561399,-11.27016 -6.830398,-10.24559 -8.196477,-5.293562 -12.977756,-3.756719 -14.685355,-0.17076 h -2.561399 z"
                                                        id="path1"/></path>
                                            @endisset
                                            @isset($car->pld)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path"
                                                        data-title="PLD"
                                                        d="m 32.977939,179.7568 29.463897,0.27031 19.192079,1.08124 14.596793,1.89218 1.621866,38.92478 1.892177,45.14194 0.540619,20.81394 -7.839016,-3.78435 -12.434305,-1.89218 -12.974927,-0.27031 -17.840524,0.81093 -15.948348,1.89218 z"
                                                        id="path2"/>
                                            @endisset
                                            @isset($car->zld)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path ZLD"
                                                        d="m 33.24825,285.44839 14.867104,-1.62186 11.353061,-0.54063 10.271817,-0.27031 9.190573,0.27031 12.704616,1.62187 8.10933,3.78435 46.223179,10.27182 -0.54062,21.62488 -3.78436,28.65296 -5.67653,22.70612 -6.48746,23.51706 -22.70612,7.02809 -11.623376,3.24373 -9.731195,-2.16249 -15.678037,-8.37964 V 384.1119 l -4.324975,-9.7312 -10.81244,-9.73119 -9.460884,-4.05467 -11.893683,-2.70311 z"
                                                        id="path3"/>
                                            @endisset
                                            @isset($car->zlk)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path ZLK"
                                                        d="m 69.740232,396.81651 14.326482,7.2984 10.542128,2.4328 33.788868,-9.7312 -11.35306,31.08577 -7.29839,15.94834 -1.62187,10.54213 -1.35155,25.40923 -15.40773,3.78436 -46.493488,4.59529 -7.839018,-0.81094 -4.595287,-3.51404 -5.406219,-51.89971 H 38.65447 l 10.271817,-2.16249 7.568707,-3.51404 6.757775,-7.02808 4.054664,-7.83902 2.70311,-7.83902 z"
                                                        id="path4"/>
                                            @endisset

                                            <!--center -->
                                            @isset($car->pt)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path PT"
                                                        d="m 177.59431,1.0812439 164.34908,0.270311 2.16248,1.8921768 V 16.218659 l -2.16248,2.432798 -163.53814,0.270311 -3.51405,-2.703109 0.27031,-13.5155492 z"
                                                        id="path5"/>
                                            @endisset
                                            @isset($car->pll)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path PLL"
                                                        d="m 177.324,27.031098 46.49349,0.270311 2.16249,1.892177 v 9.190573 l -1.89218,1.892177 H 177.324 l -2.4328,-2.432799 v -9.460884 z"
                                                        id="path6"/>
                                            @endisset
                                            @isset($car->prl)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path PRL"
                                                        d="m 295.4499,27.301409 46.49349,0.270311 2.16248,1.892177 v 8.649951 l -1.89217,2.162488 h -45.41225 l -4.05466,-2.162488 0.27031,-9.190573 z"
                                                        id="path7"/>
                                            @endisset
                                            @isset($car->pk)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path PK"
                                                        d="m 171.37716,192.73173 v -40.27634 l 1.62187,-33.78887 2.97342,-26.760788 4.86559,-15.137414 7.83902,-11.623372 10.27182,-7.568708 10.81244,-5.135908 13.24524,-3.784354 15.40772,-2.973421 18.11084,-1.351555 20.54363,0.540622 19.7327,2.973421 17.29991,5.135909 12.70461,7.298396 4.8656,4.324976 4.59529,5.135908 5.40622,9.731195 3.78435,12.704616 1.89218,13.245237 1.62186,24.5983 0.81093,28.38265 0.54063,34.3295 -9.7312,-0.81094 -1.89218,-6.75777 -4.86559,-6.48746 -14.05617,-7.02809 -22.97644,-7.02808 -16.75928,-2.70311 -22.1655,-0.27032 -16.48897,1.62187 -22.70612,4.32498 -13.51555,4.05466 -12.16399,4.32498 -5.40622,2.4328 -2.70311,8.10932 -0.27031,5.13591 -7.83902,0.54062 z"
                                                        id="path8"/>
                                            @endisset
                                            @isset($car->k)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path K"
                                                        d="m 205.212,242.33045 19.08949,-2.12105 24.92239,-1.59079 23.3316,-0.53026 22.27107,1.06052 20.68028,2.12106 3.18158,54.61714 1.59079,44.54215 -0.53026,53.02635 -11.13554,5.30264 -19.08949,4.77237 -24.39212,2.12105 -23.86186,-2.12105 -16.43817,-2.12105 -16.96844,-6.36317 -5.30263,-3.71184 1.59079,-30.75529 0.53026,-32.34608 0.53026,-39.2395 z"
                                                        id="path9"/>
                                            @endisset
                                            @isset($car->zk)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path ZK"
                                                        d="m 194.07647,433.22534 17.4987,4.77237 14.84738,2.12106 19.61975,2.12105 h 23.3316 l 22.27107,-1.06053 18.02896,-2.12105 16.96843,-4.24211 5.30264,41.89082 -20.15002,5.30264 -24.92239,3.18158 -18.55922,1.06053 h -16.96844 l -13.25658,-0.53027 -12.72633,-1.59079 -17.4987,-2.12105 -13.25659,-3.71185 -6.36316,-3.71184 z"
                                                        id="path10"/>
                                            @endisset
                                            @isset($car->zll)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path ZLL"
                                                        d="m 178.37488,491.18407 46.07819,0.23751 1.90013,1.66262 v 9.26314 l -2.13765,1.90013 -45.84067,-0.47503 -2.61269,-2.13765 v -9.26314 z"
                                                        id="path11"/>
                                            @endisset
                                            @isset($car->zpl)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path ZPL"
                                                        d="m 296.76842,491.58828 46.07819,0.23751 1.90013,1.66262 v 9.26314 l -2.13765,1.90013 -45.84067,-0.47503 -2.61269,-2.13765 v -9.26314 z"
                                                        id="path11-3"/>
                                            @endisset
                                            @isset($car->zt)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path ZT"
                                                        d="m 177.89984,512.56055 163.41133,0.23752 2.61268,2.37516 0.23752,11.63831 -2.37516,3.56274 -164.59892,-0.47503 -2.13765,-1.90013 v -13.06341 z"
                                                        id="path12"/>
                                            @endisset

                                            <!--right -->
                                            @isset($car->ppk)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path PPK"
                                                        d="m 501.77031,95.410916 -1.02456,-42.86075 -4.95204,-5.464318 -2.90292,-1.19532 -23.90639,0.17076 -8.19647,2.04912 -11.0994,5.805838 -7.00116,6.147358 -2.5614,4.098238 -1.53684,3.756719 -3.24444,12.294715 -11.44091,63.010414 -2.73217,20.4912 -0.85379,16.56371 6.65964,2.5614 14.17307,-1.87836 15.53916,-1.02456 16.39295,-0.34152 17.07599,0.17076 v -11.61167 l -7.17192,-0.51228 -8.19647,-2.39064 -7.6842,-3.92748 -6.65964,-6.31812 -4.61051,-7.51344 -2.39064,-8.87951 -0.51228,-12.12396 2.5614,-11.27016 6.83039,-10.24559 8.19648,-5.293556 12.97775,-3.756718 14.68536,-0.17076 h 2.5614 z"
                                                        id="path1-2"/>
                                            @endisset
                                            @isset($car->ppd)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path PPD"
                                                        d="m 489.95805,179.89991 -29.4639,0.27031 -19.19208,1.08124 -14.59679,1.89218 -1.62187,38.92478 -1.89217,45.14194 -0.54062,20.81394 7.83901,-3.78435 12.43431,-1.89218 12.97492,-0.27031 17.84053,0.81093 15.94835,1.89218 z"
                                                        id="path2-0"/>
                                            @endisset
                                            @isset($car->zpd)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path ZPD"
                                                        d="m 490.61521,285.92479 -14.8671,-1.62186 -11.35306,-0.54063 -10.27182,-0.27031 -9.19057,0.27031 -12.70462,1.62187 -8.10933,3.78435 -46.22318,10.27182 0.54062,21.62488 3.78436,28.65296 5.67653,22.70612 6.48746,23.51706 22.70612,7.02809 11.62338,3.24373 9.73119,-2.16249 15.67804,-8.37964 V 384.5883 l 4.32497,-9.7312 10.81244,-9.73119 9.46089,-4.05467 11.89368,-2.70311 z"
                                                        id="path3-7"/>
                                            @endisset
                                            @isset($car->zpk)
                                                <path
                                                        style="fill:rgba(255,0,0,.15);"
                                                        class="path ZPK"
                                                        d="m 453.87472,397.19553 -14.32648,7.2984 -10.54213,2.4328 -33.78887,-9.7312 11.35306,31.08577 7.29839,15.94834 1.62187,10.54213 1.35155,25.40923 15.40773,3.78436 46.49349,4.59529 7.83901,-0.81094 4.59529,-3.51404 5.40622,-51.89971 h -11.62337 l -10.27182,-2.16249 -7.56871,-3.51404 -6.75777,-7.02808 -4.05466,-7.83902 -2.70311,-7.83902 z"
                                                        id="path4-6"/>
                                            @endisset

                                            <img src="{{ route('index') }}/img/bg_car1.png"
                                                 alt=""
                                                 usemap="#map"
                                                 id="image-map"
                                                 class="map">
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 order-xl-2 order-lg-2 order-md-1 order-1">
                            <ul class="tabs">
                                <li class="tab-link current" data-tab="tab-1">Характеристики авто</li>
                                <li><a href="{{ route('listings') }}" target="_blank">Список
                                        авто</a></li>
                                <form action="{{ route('auctions.store') }}" method="post">
                                    <div class="click">Одна заявка =
                                        +{{ $contacts->sum_auc }} сом
                                    </div>
                                    @csrf
                                    <input type="hidden" name="date" value="{{ now() }}">
                                    <input type="hidden" name="user_id"
                                           value="{{ Auth::id() }}">
                                    <input type="hidden" name="name"
                                           value="{{ Auth()->user()->name }}">
                                    <input type="hidden" name="email"
                                           value="{{ Auth()->user()->email }}">
                                    <input type="hidden" name="phone"
                                           value="{{ Auth()->user()->phone }}">
                                    <input type="hidden" name="product_id"
                                           value="{{ $car->id }}">
                                    <input type="hidden" name="product_title"
                                           value="{{ $car->title }}">
                                    <input type="hidden" name="lot"
                                           value="{{ $car->lot }}">
                                    @if($csum != null)
                                        <input type="hidden" name="sum" id="sum" value="{{ $csum->sum +
                                                  $contacts->sum_auc ?? $car->price + $contacts->sum_auc }}">
                                    @else
                                        <input type="hidden" name="sum" id="sum"
                                               value="{{ $car->price + $contacts->sum_auc }}">
                                    @endif
                                    @empty($user_orders)
                                        <button class="more" id="send">Отправить
                                            заявку</button>
                                    @else
                                        @if($orders > $user_orders)
                                            <button class="more" id="send">Отправить
                                                заявку</button>
                                        @else
                                            <button disabled class="more"
                                                    id="send">Отправить заявку</button>
                                        @endif
                                    @endempty
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>



<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>

<script>
    (function ($) {
        // Define Plugin
        $.organicTabs = function (el, options) {

            // JavaScript native version of this
            var base = this;

            // jQuery version of this
            base.$el = $(el);

            // Navigation for current selector passed to plugin
            base.$nav = base.$el.find(".nav");

            // Runs once when plugin called
            base.init = function () {

                // Pull in arguments
                base.options = $.extend({}, $.organicTabs.defaultOptions, options);

                // Accessible hiding fix (hmmm, re-look at this, screen readers still run JS)
                $(".hide").addClass('remove').css({
                    "position": "relative",
                    "top": 0,
                    "left": 0,
                    "display": "none"
                });

                // When navigation tab is clicked...
                base.$nav.delegate("a", "click", function (e) {

                    // no hash links
                    e.preventDefault();

                    // Figure out current list via CSS class
                    var curList = base.$el.find("a.current").attr("href").substring(1),

                        // List moving to
                        $newList = $(this),

                        // Figure out ID of new list
                        listID = $newList.attr("href").substring(1),

                        // Set outer wrapper height to (static) height of current inner list
                        $allListWrap = base.$el.find(".list-wrap"),
                        curListHeight = $allListWrap.height();
                    $allListWrap.height(curListHeight);

                    if ((listID != curList) && (base.$el.find(":animated").length == 0)) {

                        // Fade out current list
                        base.$el.find("#" + curList).fadeOut(base.options.speed, function () {

                            // Fade in new list on callback
                            base.$el.find("#" + listID).fadeIn(base.options.speed);

                            // Adjust outer wrapper to fit new list snuggly
                            var newHeight = base.$el.find("#" + listID).height();
                            $allListWrap.animate({
                                height: newHeight
                            }, base.options.speed);

                            // Remove highlighting - Add to just-clicked tab
                            base.$el.find(".nav li a").removeClass("current");
                            $newList.addClass("current");

                            // Change window location to add URL params
                            if (window.history && history.pushState) {
                                // NOTE: doesn't take into account existing params
                                history.replaceState("", "", "?" + base.options.param + "=" + listID);
                            }
                        });

                    }

                });

                var queryString = {};
                window.location.href.replace(
                    new RegExp("([^?=&]+)(=([^&]*))?", "g"),
                    function ($0, $1, $2, $3) {
                        queryString[$1] = $3;
                    }
                );

                if (queryString[base.options.param]) {

                    var tab = $("a[href='#" + queryString[base.options.param] + "']");

                    tab
                        .closest(".nav")
                        .find("a")
                        .removeClass("current")
                        .end()
                        .next(".list-wrap")
                        .find("> div")
                        .hide();
                    tab.addClass("current");
                    $("#" + queryString[base.options.param]).show();

                }
            };
            base.init();
        };

        $.organicTabs.defaultOptions = {
            "speed": 300,
            "param": "tab"
        };

        $.fn.organicTabs = function (options) {
            return this.each(function () {
                (new $.organicTabs(this, options));
            });
        };

    })(jQuery);


    $("#example-two").organicTabs({
        "speed": 100,
        "param": "tab"
    });

    // setTimeout(function () {
    //     window.location.reload(1);
    // }, 2000);
</script>