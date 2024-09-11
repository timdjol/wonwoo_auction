@extends('auth/layouts.master')

@section('title', 'Аукционы')

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
                    <h1>Аукционы</h1>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Авто</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Дата</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                            <th>Действия</th>
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
                                <td>{{ $order->showDate() }}</td>
                                <td>{{ number_format($order->sum) }} сом</td>
                                <td>
                                    @if($order->status == 0)
                                        <span class="process">В процессе</span>
                                    @else
                                        <span class="ready">Продан</span>
                                    @endif
                                </td>
                                <td>
                                    <ul>
                                        {{--                                        <li>--}}
                                        {{--                                            <a class="btn add" href="--}}
                                        {{--                                            @admin--}}
                                        {{--                                                {{ route('orders.show', $order) }}--}}
                                        {{--                                            @else--}}
                                        {{--                                                {{ route('person.orders.show', $order) }}--}}
                                        {{--                                            @endadmin">--}}
                                        {{--                                                Открыть--}}
                                        {{--                                            </a>--}}
                                        {{--                                        </li>--}}
                                        @admin
                                        <li><a class="btn edit" href="{{ route('orders.edit', $order)
                                            }}">Редактировать</a></li>
                                        <form action="{{ route('orders.destroy', $order) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn delete" onclick="return confirm('Вы уверены, что хотите удалить?')">Удалить</button>
                                        </form>
                                        @endadmin
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
