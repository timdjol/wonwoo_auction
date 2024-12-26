@extends('auth.layouts.master')

@section('title', 'Категории')

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
                            <h1>Категории</h1>
                        </div>
                        <div class="col-md-5">
                            <div class="btn-wrap">
                                <a class="btn add" href="{{ route('categories.create') }}">Добавить</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-wrap">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Изображение</th>
                                <th>Название</th>
                                <th>Сортировка</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td><img src="{{ Storage::url($category->image) }}" width="100"></td>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->sort }}</td>
                                    <td>
                                        <form action="{{ route('categories.destroy', $category) }}" method="post">
                                            <ul>
                                                <li><a class="btn edit" href="{{ route('categories.edit', $category)
                                            }}">Редактировать</a></li>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn delete" onclick="return confirm('Вы уверены, что хотите удалить?')">Удалить</button>
                                            </ul>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $categories->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection
