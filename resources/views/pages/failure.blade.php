@extends('layouts.master')

@section('title', 'Ошибка')

@section('content')

    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Произошла ошибка</h1>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('index') }}">Главная</a></li>
                            <li>/</li>
                            <li>Произошла ошибка</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page pt0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <h1>Ошибка! Что-то пошло не так!</h1>
                    <a href="{{ route('index') }}">Перейти на главную страницу</a>
                </div>
            </div>
        </div>
    </div>

@endsection
