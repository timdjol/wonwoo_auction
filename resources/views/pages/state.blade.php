@extends('layouts.master')

@section('title', 'Проверка')

@section('content')

    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $page->title }}</h1>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('index') }}">Главная</a></li>
                            <li>/</li>
                            <li>{{ $page->title }}</li>
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
                    <h1>State</h1>
                </div>
            </div>
        </div>
    </div>

@endsection
