@extends('auth.layouts.master')

@isset($brand)
    @section('title', 'Редактировать бренд ' . $brand->name)
@else
    @section('title', 'Создать бренд')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @isset($brand)
                        <h1>Редактировать бренд {{ $brand->title }}</h1>
                    @else
                        <h1>Создать бренд</h1>
                    @endisset
                    <form method="post" enctype="multipart/form-data"
                          @isset($brand)
                              action="{{ route('brands.update', $brand) }}"
                          @else
                              action="{{ route('brands.store') }}"
                            @endisset
                    >
                        @isset($brand)
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
                            <input type="text" name="title" value="{{ old('title', isset($brand) ? $brand->title :
                             null) }}">
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
