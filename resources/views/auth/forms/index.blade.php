@extends('auth/layouts.master')

@section('title', 'Заявки на покупку')

@section('content')

    <div class="page admin order">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth/layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @if(session()->has('success'))
                        <p class="alert alert-success">{{ session()->get('success') }}</p>
                    @endif
                    @if(session()->has('warning'))
                        <p class="alert alert-warning">{{ session()->get('warning') }}</p>
                    @endif
                    <h1>Заявки на покупку</h1>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Авто</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Дата</th>
                            <th>Сумма</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->product_title }}</td>
                                <td>{{ $order->name }}</td>
                                <td><a href="tel:{{ $order->phone }}">{{ $order->phone }}</a></td>
                                <td>{{ $order->showDate() }}</td>
                                <td>{{ number_format($order->product_price) }} сом</td>
                                <td>
                                    <ul>
                                        <form action="{{ route('forms.destroy', $order) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn delete">Удалить</button>
                                        </form>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <style>
        .process{
            color: orange;
            background-color: rgb(255 232 191);
            padding: 5px 15px;
            font-size: 12px;
            border-radius: 2px;
        }
        .ready{
            color: green;
            background-color: rgb(202 255 202);
            padding: 5px 15px;
            font-size: 12px;
            border-radius: 2px;
        }
        table td, table th{
            font-size: 14px;
            padding: 10px 5px;
        }
        .admin form .delete, .admin table ul li a.btn{
            font-size: 12px;
            border-radius: 5px;
        }
    </style>

@endsection
