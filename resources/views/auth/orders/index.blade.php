@extends('auth/layouts.master')

@section('title', 'Аукционы')

@section('content')

    <div class="page admin order">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    @include('auth/layouts.sidebar')
                </div>
                <div class="col-md-10">
                    @if(session()->has('success'))
                        <p class="alert alert-success">{{ session()->get('success') }}</p>
                    @endif
                    @if(session()->has('warning'))
                        <p class="alert alert-warning">{{ session()->get('warning') }}</p>
                    @endif
                    <div class="row aic">
                        <div class="col-md-6">
                            @admin
                                <h6>Кол-во авто на аукционе: {{ $cars->count() }}</h6>
                                <h6>Дата cлед аукциона: {{ $contacts->date_auc }}</h6>
                                <h3>Аукционы на сегодня</h3>
                            @else
                                <h1>Аукционы</h1>
                            @endadmin
                        </div>
                        <div class="col-md-6">
                            @admin
                                <div class="btn-wrap">
                                    <a href="{{ route('sendemail') }}" class="btn add">Отправить уведомление</a>
                                </div>
                            @endadmin
                        </div>
                    </div>
                        @php
                            $pay = \App\Models\Payment::where('user_id', \Illuminate\Support\Facades\Auth::id())
                            ->first();
                        @endphp
{{--                        <div class="alert alert-success">Баланс: {{ $pay->sum }} сом</div>--}}
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Авто</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Email</th>
                            <th>Дата</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                            @admin
                                <th>Действия</th>
                            @endadmin
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    @php
                                        $product = \App\Models\Product::where('id', $order->product_id)->firstOrFail();
                                    @endphp
                                    {{ $product->title }}
                                </td>
                                <td>{{ $order->name }}</td>
                                <td><a href="tel:{{ $order->phone }}">{{ $order->phone }}</a></td>
                                <td><a href="mailto:{{ $order->email }}">{{ $order->email }}</a></td>
                                <td>{{ $order->showDate() }}</td>
                                <td>{{ number_format($order->sum) }} сом</td>
                                <td>
                                    @if($order->status == 0)
                                        <span class="process">В процессе</span>
                                    @else
                                        <span class="ready">Продан</span>
                                    @endif
                                </td>
                                @admin
                                    <td>
                                        <ul>
                                            <li><a class="btn edit" href="{{ route('orders.edit', $order)
                                                }}">Редактировать</a></li>
                                            <form action="{{ route('orders.destroy', $order) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn delete" onclick="return confirm('Вы уверены, что хотите удалить?')">Удалить</button>
                                            </form>
                                        </ul>
                                    </td>
                                @endadmin
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        @admin
                    <h3>Прошедшие аукционы</h3>
                        <table class="table">
                            <tbody>
                            @foreach($last as $order)
                                <tr>
                                    <td>
                                        @php
                                            $product = \App\Models\Product::where('id', $order->product_id)->firstOrFail();
                                        @endphp
                                        {{ $product->title }}
                                    </td>
                                    <td>{{ $order->name }}</td>
                                    <td><a href="tel:{{ $order->phone }}">{{ $order->phone }}</a></td>
                                    <td>{{ $order->showDate() }}</td>
                                    <td>{{ number_format($order->sum) }} сом</td>
                                    <td>
                                        @if($order->status == 0)
                                            <span class="process">В процессе</span>
                                        @else
                                            <span class="ready">Продан</span>
                                        @endif
                                    </td>
                                    @admin
                                    <td>
                                        <ul>
                                            <li><a class="btn edit" href="{{ route('orders.edit', $order)
                                                }}">Редактировать</a></li>
                                            <form action="{{ route('orders.destroy', $order) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn delete" onclick="return confirm('Вы уверены, что хотите удалить?')">Удалить</button>
                                            </form>
                                        </ul>
                                    </td>
                                    @endadmin
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endadmin
                </div>
            </div>
        </div>
    </div>

    <style>
        .process {
            color: orange;
            background-color: rgb(255 232 191);
            padding: 5px 15px;
            font-size: 12px;
            border-radius: 2px;
        }

        .ready {
            color: green;
            background-color: rgb(202 255 202);
            padding: 5px 15px;
            font-size: 12px;
            border-radius: 2px;
        }

        table td, table th {
            font-size: 14px;
            padding: 10px 5px;
        }

        .admin form .delete, .admin table ul li a.btn {
            font-size: 12px;
            border-radius: 5px;
        }
    </style>

@endsection
