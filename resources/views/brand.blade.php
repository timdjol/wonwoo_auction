@extends('layouts.master')

@section('title', $brand->title)

@section('content')

    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 data-aos="fade-up" data-aos-duration="2000">{{$brand->title}}</h1>
                    {{--                    <p>{!! $category->__('description') !!}</p>--}}
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('index') }}">Главная</a></li>
                        <li>/</li>
                        <li>{{$brand->title}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="page cars category">
        <div class="container">
            <div class="row">
                @if($brand->products->isNotEmpty())
                    @foreach($brand->products->sortByDesc('created_at') as $product)
                        <div class="col-lg-3 col-md-6">
                            @include('layouts.card', compact('product'))
                        </div>
                    @endforeach
                @else
                    <h2>Не найдeно!</h2>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="pagination">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
