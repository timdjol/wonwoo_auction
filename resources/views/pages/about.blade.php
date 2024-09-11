@extends('layouts.master')

@section('title', 'О сервисе')

@section('content')

    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $page->title }}</h1>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('index') }}">Главная</a></li>
                        <li>/</li>
                        <li>{{ $page->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="page about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-12">
                    {!! $page->description !!}
                    <div class="btn-wrap">
                        <a href="#callback" class="more">Стать участником</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection