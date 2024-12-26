@extends('auth.layouts.master')

@section('title', 'Контакты')

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
                    <div class="row">
                        <div class="col-md-7">
                            <h1>Контакты</h1>
                        </div>
                    </div>
                    <div class="table-wrap">
                        <table class="table">
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>Номер телефона</td>
                                    <td>{{ $contact->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Номер телефона #2</td>
                                    <td>{{ $contact->phone2 }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $contact->email }}</td>
                                </tr>
                                <tr>
                                    <td>Адрес</td>
                                    <td>{{ $contact->address }}</td>
                                </tr>
                                <tr>
                                    <td>WhatsApp</td>
                                    <td>{{ $contact->whatsapp }}</td>
                                </tr>
                                <tr>
                                    <td>Instagram</td>
                                    <td>{{ $contact->instagram }}</td>
                                </tr>
                                <tr>
                                    <td>Facebook</td>
                                    <td>{{ $contact->facebook }}</td>
                                </tr>
                                <tr>
                                    <td>Tiktok</td>
                                    <td>{{ $contact->tiktok}}</td>
                                </tr>
                                <tr>
                                    <td>Telegram</td>
                                    <td>{{ $contact->telegram }}</td>
                                </tr>
                                <tr>
                                    <td>Время начала</td>
                                    <td>{{ $contact->date_auc }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <ul>
                                            <li><a class="btn view" href="{{ route('contacts.edit', $contact)
                                            }}">Редактировать</a></li>
                                        </ul>
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
