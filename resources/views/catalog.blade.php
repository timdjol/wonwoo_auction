@extends('layouts.master')

@section('title', 'Каталог')

@section('content')

    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 data-aos="fade-up" data-aos-duration="2000">Cписок аукционов</h1>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('index') }}">Главная</a></li>
                        <li>/</li>
                        <li>Cписок аукционов</li>
                    </ul>
                </div>
            </div>
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
                                <img src="http://127.0.0.1:8000/storage/categories/AUwjh9VKGjTxWxZk0wDtfz299gpi4zQnnuNgxf8G.png" alt="">
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

    <div class="page cars catalog">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="filter-wrap">
                        <h3>Фильтр</h3>
                        @include('layouts.filter')
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        @if($products->isNotEmpty())
                            @foreach($products as $product)
                                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="2000">
                                    @include('layouts.card')
                                </div>
                            @endforeach
                        @else
                        <h3>Не найдено!</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

