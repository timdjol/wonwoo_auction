@extends('auth/layouts.master')

@section('title', 'Заказ # ' . $order->id)

@section('content')

    <div class="page admin order">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth/layouts.sidebar')
                </div>
                <div class="col-md-9">
                    <h1>Заказ #{{ $order->id }}</h1>
                    <p><b>Покупатель:</b> {{$order->name}}</p>
                    <p><b>Телефон:</b> <a href="tel:{{$order->phone}}">{{$order->phone}}</a></p>
                    <p><b>Email:</b> <a href="mailto:{{$order->email}}">{{$order->email}}</a></p>
                    <p><b>Авто:</b> {{ $order->product_title }}</p>
                    <p><b>Стоимость:</b> {{ number_format($order->sum) }} сом</p>
                </div>
            </div>
        </div>
    </div>

@endsection
