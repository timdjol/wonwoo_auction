@extends('layouts.master')

@section('title', 'Избранные')

@section('content')

    <div class="page cart basket wishlist">
        <div class="container">
            <div class="row">
{{--                @php--}}
{{--                $products = Product::where('id', $prod_ids)->get();--}}

{{--                @endphp--}}
                @if($prod_ids)
                    <div class="col-md-12">
                        <h1>Избранные</h1>
                        <table>
                            <tr>
                                <td>Наименование</td>
                                <td>Стоимость</td>
                                <td>Действие</td>
                            </tr>
                            @foreach($prod_ids as $product)
                                <tr>
                                    <td>
                                        @php
                                            $name = \App\Models\Product::where('id', $product->product_id)
                                            ->firstOrFail();
                                        @endphp
                                        <a href="{{ route('product', [isset($category) ? $category->code :
                                        $name->category->code, $name->code])
         }}">
                                            <img width="140" src="{{ Storage::url($name->image) }}" alt="{{ $name->title
                                        }}">

                                        {{ $name->title }}
                                        </a>
                                    </td>
                                    <td>{{ number_format($name->price) }} сом</td>
                                    <td>
                                        <form action="{{ route('wishlist-remove', $name->id) }}" method="post">
                                            <button type="submit" class="btn btn-danger">Удалить</button>
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="btn-wrap">
                                    <a href="{{ route('catalog') }}" class="more">Продолжить</a>
                                </div>
                            </div>
{{--                            <div class="col-md-4">--}}
{{--                                <div class="btn-wrap">--}}
{{--                                    <a href="{{ route('wishlist-reset') }}" class="more">Очистить</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <h2>Избранные не найдены</h2>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
