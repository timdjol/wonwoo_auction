@extends('layouts.master')

@section('title', 'Депозит')

@section('content')



    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Внесение депозита</h1>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('index') }}">Главная</a></li>
                        <li>/</li>
                        <li>Внесение депозита</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="page about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-12">
                    <h2>Внесите оплату</h2>
                    <form class="form-callback" id="callback" action="{{ route('paybox') }}" method="get">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="name" value="{{ Auth()->user()->name }}">
                        <input type="hidden" name="email" value="{{ Auth()->user()->email }}">
                        <input type="hidden" name="phone" value="{{ Auth()->user()->phone }}">
                        <div class="form-group">
                            <label for="">Внесение суммы (в сомах)</label>
                            <input type="text" name="sum" id="sum" value="100000">
                        </div>
                        <button class="more">Отправить</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

<script>
    window.setTimeout(function(){
        window.location.href = "{{ route('index') }}";
    }, 31000);
</script>
