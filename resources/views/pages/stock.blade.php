@extends('layouts.master')

@section('title', 'Авто в наличии')

@section('content')

    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 data-aos="fade-up" data-aos-duration="2000">Авто в наличии</h1>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('index') }}">Главная</a></li>
                        <li>/</li>
                        <li>Авто в наличии</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="page cars catalog">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="filter-wrap">
                        <h3>Фильтр</h3>
                        @include('layouts.filter_stock')
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="2000">
                                @include('layouts.card')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

