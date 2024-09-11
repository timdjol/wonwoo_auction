@extends('auth.layouts.master')

@section('title', 'Платежи')

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
                    <h2>Платежи</h2>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ФИО</th>
                            <th>Телефон</th>
                            <th>Email</th>
                            <th>Сумма</th>
                            <th>Действия</th>
                        </tr>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->name }}</td>
                                <td><a href="tel:{{ $payment->phone }}">{{ $payment->phone }}</a></td>
                                <td><a href="mailto:{{ $payment->email }}">{{ $payment->email }}</a></td>
                                <td>{{ number_format($payment->sum) }} сом</td>
                                <td>
                                    <form action="{{ route('payments.destroy', $payment) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn delete" onclick="return confirm('Вы уверены, что хотите удалить?')">Удалить</button>
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

@endsection
