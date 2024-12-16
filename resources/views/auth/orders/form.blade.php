@extends('auth.layouts.master')

@isset($order)
    @section('title', 'Редактировать  ' . $order->name)
@else
    @section('title', 'Создать заказ')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @isset($order)
                        <h1>Редактировать заказ {{ $order->title }}</h1>
                    @else
                        <h1>Создать заказ</h1>
                    @endisset
                    <form method="post" enctype="multipart/form-data"
                          @isset($order)
                              action="{{ route('orders.update', $order) }}"
                          @else
                              action="{{ route('orders.store') }}"
                            @endisset
                    >
                        @isset($order)
                            @method('PUT')
                        @endisset
                        @include('auth.layouts.error', ['fieldname' => 'name'])
                            @php
                                $product = \App\Models\Product::where('id',$order->product_id)->firstOrFail();
                            @endphp
                            <div class="form-group">
                                <label for="">Авто</label>
                                <input type="hidden" name="product_id" value="{{ $product->id }}"
                                       readonly>
                                <input type="text" name="product" value="{{ $product->title }}"
                                       readonly>
                            </div>
                        <div class="form-group">
                            <label for="">ФИО</label>
                            <input type="text" name="name" value="{{ old('name', isset($order) ? $order->name :
                             null) }}" readonly>
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'phone'])
                        <div class="form-group">
                            <label for="">Номер телефона</label>
                            <input type="text" name="phone" readonly value="{{ old('phone', isset($order) ?
                            $order->phone :
                             null) }}">
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'email'])
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" value="{{ old('email', isset($order) ?
                                $order->email : null) }}" readonly>
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'sum'])
                            <div class="form-group">
                                <label for="">Сумма (сом)</label>
                                <input type="hidden" name="sum" value="{{$order->sum}}">
                                <input type="text" name="s" value="{{ number_format($order->sum) }}" readonly>
                            </div>
                            @include('auth.layouts.error', ['fieldname' => 'label'])
                            <div class="form-group">
                                <label for="">Статус</label>
                                <select name="status">
                                    @if($order->status == 0)
                                        <option value="{{ $order->status }}">В процессе</option>
                                        <option value="1">{{ $order->label }}Продан</option>
                                    @else
                                        <option value="1">Продан</option>
                                        <option value="0">В процессе</option>
                                    @endif
                                </select>
                            </div>
                        @csrf
                        <button class="more">Отправить</button>
                        <a href="{{url()->previous()}}" class="btn delete cancel">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
