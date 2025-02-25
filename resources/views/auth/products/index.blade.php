@extends('auth.layouts.master')

@section('title', 'Продукции')

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @if(session()->has('success'))
                        <p class="alert alert-success">{{ session()->get('success') }}</p>
                    @endif
                    @if(session()->has('warning'))
                        <p class="alert alert-warning">{{ session()->get('warning') }}</p>
                    @endif
                    <div class="row aic">
                        <div class="col-md-7">
                            <h1>Автомобили</h1>
                            <small>Кол-во авто: {{ $products->count() }}</small>
                        </div>
                        <div class="col-md-5">
                            <div class="btn-wrap">
                                <a href="{{ route('products.create') }}" class="btn add">Добавить</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-wrap">
                        <table class="table">
                            <thead>
                            <tr>
                                <th># лота</th>
                                <th>Изображение</th>
                                <th>Название</th>
                                <th>Категория</th>
                                <th>Стоимость</th>
                                <th>Дата лота</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->lot }}</td>
                                    <td><img src="{{ Storage::url($product->image) }}" alt=""></td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->category->title }}</td>
                                    <td>{{ number_format($product->price) }} сом</td>
                                    <td>{{ \Carbon\Carbon::parse($product->dateLot)->format('d.m.y')  }}</td>
                                    <td>
                                        <form action="{{ route('products.destroy', $product) }}" method="post">
                                            <ul>
                                                <li><a class="btn edit" href="{{ route('products.edit', $product)
                                            }}">Редактировать</a></li>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn delete"
                                                        onclick="return confirm('Вы уверены, что хотите удалить?')">
                                                    Удалить
                                                </button>
                                            </ul>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection

<style>
    .admin table img {
        max-width: 100px !important;
    }

    .admin form .delete {
        padding: 8px 10px !important;
    }
</style>