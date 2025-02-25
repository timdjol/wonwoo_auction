@extends('auth.layouts.master')

@section('title', 'Пользователи')

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
                            <h1>Пользователи</h1>
                        </div>
                        <div class="col-md-5">
                            <div class="btn-wrap">
                                <a href="{{ route('users.create') }}" class="btn add">Добавить</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-wrap">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>ФИО</th>
                                <th>Телефон</th>
                                <th>Email</th>
                                <th>Статус</th>
                                <th>Роль</th>
                                <th>Действия</th>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td><a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></td>
                                    <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                    <td>
                                        @if($user->status === 1)
                                            <div class="alert alert-success">
                                                @isset($user->payments->first()->sum)
                                                    Внес депозит {{ number_format($user->payments->first()->sum) }} сом
                                                @else
                                                    Внес депозит
                                                @endisset
                                            </div>
                                        @else
                                            <div class="alert alert-danger">Отключен</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->is_admin === 1)
                                            Администратор
                                        @else
                                            Пользователь
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('users.destroy', $user) }}" method="post">
                                            <ul>
                                                <li><a class="btn view" href="{{ route('users.show', $user)
                                            }}">Открыть</a></li>
                                                <li><a class="btn edit" href="{{ route('users.edit', $user)
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
                </div>
            </div>
        </div>
    </div>

@endsection
