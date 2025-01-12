@extends('auth/layouts.master')

@section('title', 'Заказ # ' . $auction->id)

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth/layouts.sidebar')
                </div>
                <div class="col-md-9">
                    <h1>Заказ #{{ $auction->id }}</h1>
                    <p></p>
                    <table>
                        <tr>
                            <td><b>Покупатель:</b> </td>
                            <td>{{$auction->name}}</td>
                        </tr>
                        <tr>
                            <td><b>Телефон:</b></td>
                            <td><a href="tel:{{$auction->phone}}">{{$auction->phone}}</a></td>
                        </tr>
                        <tr>
                            <td><b>Email:</b></td>
                            <td><a href="mailto:{{$auction->email}}">{{$auction->email}}</a></td>
                        </tr>
                        <tr>
                            <td><b>Авто:</b></td>
                            <td>{{ $auction->product_title }}</td>
                        </tr>
                        <tr>
                            <td><b>Стоимость:</b></td>
                            <td>{{ number_format($auction->sum) }} сом</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
