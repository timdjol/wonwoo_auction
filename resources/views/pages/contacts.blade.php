@extends('layouts.master')

@section('title', 'Контакты')

@section('content')

    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Контакты</h1>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('index') }}">Главная</a></li>
                        <li>/</li>
                        <li>Контакты</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="page contacts">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <script src="https://maps.api.2gis.ru/2.0/loader.js"></script>
                    <div id="map" style="width: 100%; height: 550px;"></div>
                    <script>
                        DG.then(function () {
                            var map = DG.map('map', {
                                center: [42.829681, 74.555191],
                                zoom: 15
                            });

                            DG.marker([42.829681, 74.555191], { scrollWheelZoom: false })
                                .addTo(map)
                                .bindLabel('Auction WonWoo', {
                                    static: true
                                });
                        });
                    </script>
                </div>
                <div class="col-lg-4 col-md-4">
                    <form action="{{ route('contactform') }}" method="post">
                        <h3>Оставить заявку</h3>
                        <div class="row">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Ваше имя" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" id="phone" name="phone" placeholder="Номер телефона" required>
                                <div id="output"></div>
                            </div>
                            <div class="form-group">
                                <textarea name="message" rows="4" placeholder="Ваше сообщение"></textarea>

                            </div>
                            @csrf
                            <button class="more" id="send">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
