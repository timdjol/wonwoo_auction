@extends('layouts.master')

@section('title', 'Главная страница')

@section('content')

    <div class="slider">
        <div class="owl-carousel owl-slider">
            @foreach($sliders as $slider)
                <div class="slider-item" style="background-image: url({{ Storage::url($slider->image)  }})">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-wrap">
                                    <h2>{{ $slider->title }}</h2>
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
                    <h3>Статус аукциона</h3>
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

    <div class="cars">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Список аукционов</h2>
                </div>
            </div>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-6">
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
                    <div class="banner">
                        <div class="overlay"></div>
                        <img src="{{ url('/') }}/img/logo.svg">
                    </div>
                </div>
                <div class="col-md-9">
                    <h2>Аукцион поддержанных авто</h2>
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
                            <li><a href="brands.html">Sonata</a></li>
                            <li><a href="brands.html">Elantra</a></li>
                            <li><a href="brands.html">LX570</a></li>
                            <li><a href="brands.html">LX600</a></li>
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
                    <h2>Что представляет собой аукцион WonWoo?</h2>
                    <p>Аукцион WonWoo — мировой лидер онлайн-аукционов по продаже б/у, поврежденных, списанных авто, а также транспортных средств с чистыми сертификатами. Мы упрощаем поиск, участие в торгах и выигрыш классических авто, лодок, авто, изъятых за неуплату, квадроциклов, экзотических авто, мотоциклов и многих других категорий транспортных средств.</p>
                    <!-- <p>Покупатели подержанных или битых авто, авторазборщики, дилеры, авторемонтные мастерские и частные лица — все могут найти что-то для себя на аукционе WonWoo. У нас даже есть авто, не требующие лицензию на ведение коммерческой деятельности, доступные в разделе No License Required (не требуют лицензии). Каждый будний день мы предлагаем авто с чистыми сертификатами, битые авто, грузовики, внедорожники, мотоциклы, тяжелое оборудование и многое другое.</p> -->
                    <p>Будучи глобальным лидером по продаже подержанных авто через онлайн-аукцион, WonWoo предлагает всем желающим делать ставки и выигрывать. Станьте участником плана «Базовый» или «Премьер» и начинайте размещать ставки и выигрывать на аукционе подержанных авто.</p>
                    <div class="btn-wrap">
                        <a href="#callback" class="more">Станьте участником</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
