@extends('auth.layouts.master')

@isset($model)
    @section('title', 'Редактировать модель ' . $model->name)
@else
    @section('title', 'Создать модель')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @isset($model)
                        <h1>Редактировать модель {{ $model->title }}</h1>
                    @else
                        <h1>Создать модель</h1>
                    @endisset
                    <form method="post" enctype="multipart/form-data"
                          @isset($model)
                              action="{{ route('models.update', $model) }}"
                          @else
                              action="{{ route('models.store') }}"
                            @endisset
                    >
                        @isset($model)
                            @method('PUT')
                        @endisset
                        @error('code')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Заголовок</label>
                            <input type="text" name="title" value="{{ old('title', isset($model) ? $model->title :
                             null) }}">
                        </div>
                        @error('brand_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Заголовок</label>
                            <select name="brand_id" required>
                                <option value="">Выбрать</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                            @isset($model)
                                                @if($model->brand_id == $brand->id)
                                                    selected
                                            @endif
                                            @endisset
                                    >{{ $brand->title }}</option>
                                @endforeach
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
