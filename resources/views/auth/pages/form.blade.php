@extends('auth.layouts.master')

@isset($page)
    @section('title', 'Редактировать страницу' . $page->name)
@else
    @section('title', 'Создать страницу')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @isset($page)
                        <h1>Редактировать страницу {{ $page->title }}</h1>
                    @else
                        <h1>Создать страницу</h1>
                    @endisset
                    <form method="post" enctype="multipart/form-data"
                          @isset($page)
                              action="{{ route('pages.update', $page) }}"
                          @else
                              action="{{ route('pages.store') }}"
                            @endisset
                    >
                        @isset($page)
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
                            <input type="text" name="title" value="{{ old('title', isset($page) ? $page->title :
                             null) }}">
                        </div>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Описание</label>
                            <textarea name="description" id="editor" rows="3">{{ old('description', isset
                            ($page) ?
                            $page->description : null) }}</textarea>
                        </div>
                        <script src="https://cdn.tiny.cloud/1/yxonqgmruy7kchzsv4uizqanbapq2uta96cs0p4y91ov9iod/tinymce/6/tinymce.min.js"
                                referrerpolicy="origin"></script>
                        <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#editor'))
                                .catch(error => {
                                    console.error(error);
                                });
                        </script>
                        @csrf
                        <button class="more">Отправить</button>
                        <a href="{{url()->previous()}}" class="btn delete cancel">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
