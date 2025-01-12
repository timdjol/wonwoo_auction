@extends('auth/layouts.master')

@section('title', 'Аукционы')

@section('content')

    <div class="page admin">
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
                    @if($auctions->isNotEmpty())
                        @php
                            $pay = \App\Models\Payment::where('user_id', \Illuminate\Support\Facades\Auth::id())
                            ->first();
                        @endphp
                        {{--                        <div class="alert alert-success">Баланс: {{ $pay->sum }} сом</div>--}}
                        <div class="table-wrap">
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
                                @foreach($auctions as $auction)
                                    <tr>
                                        <td>
                                            @php
                                                $product = \App\Models\Product::where('id', $auction->product_id)->firstOrFail();
                                            @endphp
                                            {{ $product->title }}
                                        </td>
                                        <td>{{ $auction->name }}</td>
                                        <td><a href="tel:{{ $auction->phone }}">{{ $auction->phone }}</a></td>
                                        <td><a href="mailto:{{ $auction->email }}">{{ $auction->email }}</a></td>
                                        <td>{{ $auction->showDate() }}</td>
                                        <td>{{ number_format($auction->sum) }} сом</td>
                                        <td>
                                            @if($auction->status == 0)
                                                <span class="process">В процессе</span>
                                            @else
                                                <span class="ready">Продан</span>
                                            @endif
                                        </td>
                                        @admin
                                        <td>
                                            <ul>
                                                <li><a class="btn view" href="{{ route('auctions.show', $auction)
                                                }}">Открыть</a></li>
                                                <li><a class="btn edit" href="{{ route('auctions.edit', $auction)
                                                }}">Редактировать</a></li>
                                                <form action="{{ route('auctions.destroy', $auction) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn delete"
                                                            onclick="return confirm('Вы уверены, что хотите удалить?')">
                                                        Удалить
                                                    </button>
                                                </form>
                                            </ul>
                                        </td>
                                        @endadmin
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-danger">Аукционы не найдены</div>
                    @endif
                    @admin
                    <h3>Прошедшие аукционы</h3>
                    @if($last->isNotEmpty())
                        <div class="table-wrap">
                            <table class="table">
                                <tbody>
                                @foreach($last as $auction)
                                    <tr>
                                        <td>
                                            @php
                                                $product = \App\Models\Product::where('id', $auction->product_id)->firstOrFail();
                                            @endphp
                                            {{ $product->title }}
                                        </td>
                                        <td>{{ $auction->name }}</td>
                                        <td><a href="tel:{{ $auction->phone }}">{{ $auction->phone }}</a></td>
                                        <td>{{ $auction->showDate() }}</td>
                                        <td>{{ number_format($auction->sum) }} сом</td>
                                        <td>
                                            @if($auction->status == 0)
                                                <span class="process">В процессе</span>
                                            @else
                                                <span class="ready">Продан</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul>
                                                <li><a class="btn edit" href="{{ route('auctions.edit', $auction)
                                                }}">Редактировать</a></li>
                                                <form action="{{ route('auctions.destroy', $auction) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn delete"
                                                            onclick="return confirm('Вы уверены, что хотите удалить?')">
                                                        Удалить
                                                    </button>
                                                </form>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-danger">Прошедшие аукционы не найдены</div>
                    @endif
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
            bauction-radius: 2px;
        }

        .ready {
            color: green;
            background-color: rgb(202 255 202);
            padding: 5px 15px;
            font-size: 12px;
            bauction-radius: 2px;
        }

        table td, table th {
            font-size: 14px;
            padding: 10px 5px;
        }

        .admin form .delete, .admin table ul li a.btn {
            font-size: 12px;
            bauction-radius: 5px;
        }
    </style>

@endsection
