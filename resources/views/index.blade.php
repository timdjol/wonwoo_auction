@extends('layouts.master')

@section('title', 'Главная страница')

@section('content')

    @php
        $contacts = \App\Models\Contact::first();
        $date_auc = Carbon\Carbon::parse($contacts->date_auc);
        $now = Carbon\Carbon::parse(Carbon\Carbon::now());
    @endphp

{{--    @if($date_auc < $now->addMinute(2))--}}
{{--        @php--}}
{{--            $contacts->update([--}}
{{--                'date_auc' => $date_auc->addDays(7)->format('Y-m-d H:i')--}}
{{--            ]);--}}
{{--        @endphp--}}
{{--    @endif--}}

    <div class="slider">
        <div class="owl-carousel owl-slider">
            @foreach($sliders as $slider)
                <div class="slider-item" style="background-image: url({{ Storage::url($slider->image)  }})">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-wrap">
                                    <h2 data-aos="fade-right" data-aos-duration="2000">{{ $slider->title }}</h2>
                                    <div class="btn-wrap">
                                        <a href="{{ $slider->link }}" class="more">Подробнее</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>



    <div class="type_status">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @php
                        $prodc = \App\Models\Product::count();
                    @endphp
                    <h3 data-aos="fade-up" data-aos-duration="2000">Статус аукциона</h3>
                    <h5>Ожидаемое количество лотов: {{ $prodc }} единиц</h5>
                    <ul>
                        <li>
                            <a href="{{ route('catalog') }}">
                                <img src="{{ url('/') }}/img/all.png" alt="">
                                <div class="title">Все</div>
                                <span class="count">{{  \App\Models\Product::count() }}</span>
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('category', $category->code) }}">
                                    <img src="{{ Storage::url($category->image) }}" alt="{{ $category->title }}">
                                    <div class="title">{{ $category->title }}</div>
                                    @php
                                        $count = \App\Models\Product::where('category_id', $category->id)->get();
                                    @endphp
                                    <div class="count">{{$count->count()}}</div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="auct">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-wrap">
                        <h1>Аукцион начался</h1>
                        <div class="btn-wrap">
                            <a href="{{ route('sales') }}" class="more">Зайти на аукцион</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="cars">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 data-aos="fade-up" data-aos-duration="2000">Список аукционов</h2>
                </div>
            </div>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="2000">
                        @include('layouts.card')
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="categories">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="banner" data-aos="fade-right" data-aos-duration="2000">
                        <div class="overlay"></div>
                        <img src="{{ url('/') }}/img/logo.svg">
                    </div>
                </div>
                <div class="col-md-9">
                    <h2 data-aos="fade-up" data-aos-duration="2000">Аукцион поддержанных авто</h2>
                    <ul class="tabs">
                        <li class="tab-link current" data-tab="tab-1">Марки</li>
                        <li class="tab-link" data-tab="tab-2">Модели</li>
                        <li class="tab-link" data-tab="tab-3">Категории</li>
                        <li class="tab-link" data-tab="tab-4">Избранное</li>

                    </ul>
                    <div class="tab-content current" id="tab-1">
                        <ul>
                            @foreach($brands as $brand)
                                <li><a href="{{ route('brand', $brand->code) }}">{{ $brand->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-content" id="tab-2">
                        <ul>
                            @foreach($models as $model)
                                <li><a href="{{ route('model', $model->code) }}">{{ $model->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-content" id="tab-3">
                        <ul>
                            @foreach($categories as $category)
                                <li><a href="{{ route('category', $category->code) }}">{{ $category->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-content" id="tab-4">
                            <ul>
                               @foreach($wishlists as $wishlist)
                                   @php
                                   $prod = \App\Models\Product::where('id', $wishlist->product_id)->first();
                                   @endphp
                                    <li><a href="{{ route('wishlist') }}">{{ $prod->title }}</a></li>
                               @endforeach
                            </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-12">
                    <h2 data-aos="fade-up" data-aos-duration="2000">Что представляет собой аукцион WonWoo?</h2>
                    <p>Аукцион WonWoo — мировой лидер онлайн-аукционов по продаже б/у, поврежденных, списанных авто, а также транспортных средств с чистыми сертификатами. Мы упрощаем поиск, участие в торгах и выигрыш классических авто, лодок, авто, изъятых за неуплату, квадроциклов, экзотических авто, мотоциклов и многих других категорий транспортных средств.</p>
                    <!-- <p>Покупатели подержанных или битых авто, авторазборщики, дилеры, авторемонтные мастерские и частные лица — все могут найти что-то для себя на аукционе WonWoo. У нас даже есть авто, не требующие лицензию на ведение коммерческой деятельности, доступные в разделе No License Required (не требуют лицензии). Каждый будний день мы предлагаем авто с чистыми сертификатами, битые авто, грузовики, внедорожники, мотоциклы, тяжелое оборудование и многое другое.</p> -->
                    <p>Будучи глобальным лидером по продаже подержанных авто через онлайн-аукцион, WonWoo предлагает всем желающим делать ставки и выигрывать. Станьте участником плана «Базовый» или «Премьер» и начинайте размещать ставки и выигрывать на аукционе подержанных авто.</p>
                    <div class="btn-wrap">
                        <a href="{{ route('register') }}" class="more">Станьте участником</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about community">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Сообщество</h2>
                    <p>Это площадка для набора минимального количества участников на экскурсию или поиска попутчиков
                        для путешествия.
                        WonWoo лишь предоставляет путешественникам удобное онлайн-пространство для обмена информацией,
                        но не гарантирует брокерские услуги или бронирование.
                        В целях обеспечения безопасного и приятного общения на доске объявлений запрещается незаконная предпринимательская деятельность, реклама и невежливое поведение, а такие сообщения могут удаляться без предупреждения.</p>
                    <div class="btn-wrap">
                        <a href="{{ route('register') }}" class="more">Станьте участником</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="popup-wrapper" onclick="closeFunction()">
        <div id="popup" class="popup">
            <div class="close">
                <img src="{{ url('/') }}/img/close.svg" alt="">
            </div>
            <div class="text-wrap">
                <img src="{{ url('/') }}/img/logo.svg" alt="">
                <p>"Wonwoo Korea" поставляет различные автомобили, которые продавцы из Кыргызстана выставили на продажу, по более низким ценам через аукцион для наших клиентов. Wonwoo Korea (Auction) управляет участием в аукционе на основе членства.</p>
                <p>Аукцион начинается каждую неделю. Список выставленных автомобилей можно просмотреть на нашем сайте. В списке указаны марка автомобиля, год выпуска, пробег, цвет и отчеты об оценке. Найдите автомобиль, который вы хотите приобрести, в списке и участвуйте в аукционе, подключившись к Wonwoo Korea через ПК и используя программу для подачи ставок. С каждым кликом цена увеличивается на 3000 сомов, и участник, предложивший наивысшую цену, выигрывает автомобиль.</p>
                <h4>Участие в аукционе</h4>
                <h5>Победа на интернет-аукционе</h5>
                <p>Вы можете выиграть автомобиль, выставленный на сайте WONWOOKOREA. После регистрации для участия в аукционе вы должны внести депозит в Wonwoo Korea. Депозит рассчитывается в зависимости от стоимости выставленного автомобиля (указать конкретные суммы). При каждом клике в программе цена увеличивается на 3000 сомов, и автомобиль будет продан участнику, предложившему самую высокую цену. Если цена не достигает запрашиваемой продавцом суммы, автомобиль снимается с торгов.</p>
                <h4>Победа через переговоры</h4>
                <p>Автомобиль, не проданный на аукционе, можно приобрести по согласованной цене с разрешения продавца. После подачи заявки на переговоры и достижения соглашения с продавцом сделка будет завершена по той же процедуре, что и на аукционе.</p>
                <h4>Система произвольного выигрыша</h4>
                <p>Обычно автомобили продаются по цене, указанной продавцом, но система произвольного выигрыша позволяет продавать автомобиль даже по более низкой цене, если этого пожелает продавец. Это минимизирует убытки продавца в случае снятия автомобиля с торгов, а для покупателя создает возможность приобрести автомобиль по более низкой цене.</p>
                <br>
                <h4>Создание категории объявлений</h4>
                <h5>Вопрос: Как стать участником аукциона? </h5>
                <p>Ответ: Любой может зарегистрироваться на аукционе Wonwoo Korea. Чтобы участвовать в аукционе, необходимо внести депозит в Wonwoo Korea. Если имя плательщика совпадает с именем, указанным при регистрации, и депозит подтвержден, доступ к участию в аукционе будет предоставлен. Депозит составляет 10% от начальной стоимости выставленного автомобиля (требуется уточнение суммы). Право на участие в аукционе действительно до возврата депозита, однако участие в торгах на автомобили с начальной ценой, превышающей депозит, может быть ограничено.</p>
                <h5>Вопрос: Как изменить информацию о членстве? </h5>
                <p>Ответ: Изменить пароль можно после входа на сайт через раздел "Редактирование профиля" в верхней части сайта.</p>
                <h5>Вопрос: Как подать претензию на автомобиль, выигранный на аукционе?
                </h5>
                <p>Ответ: 1. Претензии могут быть поданы только по основаниям, указанным в правилах аукциона.</p>
                <p>2. Отчет о проверке автомобиля, предоставляемый в день аукциона, является справочным, и рекомендуется провести личную проверку автомобиля.
                </p>
                <p>3. Сроки и виды претензий различаются в зависимости от статьи 37 правил аукциона.
                </p>
                <p>4. Претензии может подать только победитель аукциона, и заявление должно быть подано в офисе Wonwoo Korea в установленной форме.
                </p>
                <h5>Вопрос: Что такое произвольный выигрыш?
                </h5>
                <p>Ответ: Принципиально автомобили продаются по цене, указанной продавцом. Однако в случае снятия с торгов Wonwoo Korea сообщает продавцу максимальную предложенную цену, и если продавец соглашается продать по этой цене, автомобиль может быть продан по системе произвольного выигрыша.
                </p>
                <h5>Вопрос: Есть ли комиссия за выставление автомобиля?
                </h5>
                <p>Ответ: При выставлении автомобиля на аукцион Wonwoo Korea взимается следующая комиссия:
                </p>
                <p>Комиссия за выставление: 3000 сомов за первую и повторную подачу автомобиля. Однако если сделка не завершена по причине отказа продавца, может быть применена санкция.
                </p>
                <p>В случае успешной сделки с продавца взимается комиссия в размере 2,2% от цены продажи."
                </p>


            </div>
        </div>
        <script>
            function PopUp(hideOrshow) {
                if (hideOrshow == 'hide') document.getElementById('popup-wrapper').style.display = "none";
                else document.getElementById('popup-wrapper').removeAttribute('style');
            }


            function closeFunction() {
                document.getElementById("popup-wrapper").style.display = "none";
            }
        </script>
    </div>
@endsection

