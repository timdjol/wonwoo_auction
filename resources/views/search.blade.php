@extends('layouts.master')

@section('title', 'Поиск')

@section('content')

    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Поиск</h1>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('index') }}">Главная</a></li>
                        <li>/</li>
                        <li>Поиск</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="page cars search">
        <div class="container">
            <div class="row">
                @if($search)
                    @foreach($search as $product)
                        <div class="col-lg-3 col-md-6">
                            @include('layouts.card')
                        </div>
                    @endforeach
                @else
                    <h2>Продукции не найдены</h2>
                @endif
            </div>
        </div>
    </div>

@endsection
