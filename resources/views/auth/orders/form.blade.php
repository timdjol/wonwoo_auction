@extends('auth.layouts.master')

@isset($auction)
    @section('title', 'Редактировать  ' . $auction->name)
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
                    @isset($auction)
                        <h1>Редактировать заказ {{ $auction->title }}</h1>
                    @else
                        <h1>Создать заказ</h1>
                    @endisset
                    <form method="post" enctype="multipart/form-data"
                          @isset($auction)
                              action="{{ route('auctions.update', $auction) }}"
                          @else
                              action="{{ route('auctions.store') }}"
                            @endisset
                    >
                        @isset($auction)
                            @method('PUT')
                        @endisset
                        @include('auth.layouts.error', ['fieldname' => 'name'])
                            @php
                                $product = \App\Models\Product::where('id',$auction->product_id)->firstOrFail();
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
                            <input type="text" name="name" value="{{ old('name', isset($auction) ? $auction->name :
                             null) }}" readonly>
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'phone'])
                        <div class="form-group">
                            <label for="">Номер телефона</label>
                            <input type="text" name="phone" readonly value="{{ old('phone', isset($auction) ?
                            $auction->phone :
                             null) }}">
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'email'])
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" value="{{ old('email', isset($auction) ?
                                $auction->email : null) }}" readonly>
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'sum'])
                            <div class="form-group">
                                <label for="">Сумма (сом)</label>
                                <input type="hidden" name="sum" value="{{$auction->sum}}">
                                <input type="text" name="s" value="{{ number_format($auction->sum) }}" readonly>
                            </div>
                            @include('auth.layouts.error', ['fieldname' => 'label'])
                            <div class="form-group">
                                <label for="">Статус</label>
                                <select name="status">
                                    @if($auction->status == 0)
                                        <option value="{{ $auction->status }}">В процессе</option>
                                        <option value="1">{{ $auction->label }}Продан</option>
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
