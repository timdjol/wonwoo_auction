@extends('layouts.master')

@section('title', 'Авто в наличии')

@section('content')

    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 data-aos="fade-up" data-aos-duration="2000">Список авто</h1>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('index') }}">Главная</a></li>
                        <li>/</li>
                        <li>Список авто</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="page cars catalog">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Двигатель</th>
                            <th>Коробка</th>
                            <th>Год выпуска</th>
                        </tr>
                        @php
$i=1; @endphp
                        @foreach($cars as $car)

                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $car->title }}</td>
                                <td>{{ $car->engine }}</td>
                                <td>{{ $car->transmission }}</td>
                                <td>{{ $car->year }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection

