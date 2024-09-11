@extends('layouts.master')

@section('title', 'Успешно оплачено')

@section('content')

    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Успешно оплачено</h1>
                    <div>
                        <ul class="breadcrumbs">
                            <li><a href="{{ route('index') }}">@lang('main.home')</a></li>
                            <li>/</li>
                            <li>Успешно оплачено</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page pt0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <h1>Поздравляем! Заказ успешно оплачен!</h1>
                    @php
                        $name =  $_GET['pg_description'];
                        $email = $_GET['pg_user_contact_email'];
                        $phone = $_GET['pg_user_phone'];
                        $sum = $_GET['pg_amount'];
                        $user_id = $_GET['pg_param1'];

                        $auth = \App\Models\Payment::where('user_id', $user_id)->first();

                        if($auth == null){
                            \App\Models\Payment::where('user_id', $user_id)->create(
                                [
                                    'name' => $name,
                                    'email' => $email,
                                    'phone' => $phone,
                                    'sum' => $sum,
                                    'user_id' => $user_id,
                                ]
                            );
                        } else {
                            \App\Models\Payment::where('user_id', $user_id)->update(
                                [
                                    'name' => $name,
                                    'email' => $email,
                                    'phone' => $phone,
                                    'sum' => $sum + $auth->sum,
                                ]
                            );
                        }

                        \App\Models\User::where('id', $user_id)->update(['status' => 1]);

                    @endphp
                    <a href="{{ route('index') }}">Перейти на главную страницу</a>
                </div>
            </div>
        </div>
    </div>

@endsection
