@extends('layouts.master')

@section('title', 'Политика конфиденциальности')

@section('content')

    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $page->title }}</h1>
                    <div >
                        <ul class="breadcrumbs">
                            <li><a href="{{ route('index') }}">@lang('main.home')</a></li>
                            <li>/</li>
                            <li>{{ $page->title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page cooperation pt0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    {!! $page->description !!}
                </div>
            </div>
        </div>
    </div>

@endsection
