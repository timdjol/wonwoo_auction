@extends('layouts.master')

@section('title', 'Депозит')

@section('content')



    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>В процессе обработки</h1>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('index') }}">Главная</a></li>
                        <li>/</li>
                        <li>В процессе обработки</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="page about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-12">
                    {{ $_GET['sum']}}

                </div>
            </div>
        </div>
    </div>

@endsection

{{--<script>--}}
{{--    window.setTimeout(function(){--}}
{{--        window.location.href = "{{ route('index') }}";--}}
{{--    }, 31000);--}}
{{--</script>--}}
