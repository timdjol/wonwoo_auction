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

    <div class="page cars catalog listing">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap">
                        <h3>Список участвующих автомобилей</h3>
                        @if($cars->isEmpty())
                            <div class="alert alert-danger">Автомобили на аукцион пока не выставлены</div>
                        @else
                            <table>
                                <tr>
                                    <th>#</th>
                                    <th>Название</th>
                                    <th>Двигатель</th>
                                    <th>Коробка</th>
                                    <th>Год выпуска</th>
                                    <th># лота</th>
                                    <th></th>
                                </tr>
                                @foreach($cars as $car)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $car->title }}</td>
                                        <td>{{ $car->engine }}</td>
                                        <td>{{ $car->transmission }}</td>
                                        <td>{{ $car->year }}</td>
                                        <td>{{ $car->lot }}</td>
                                        <td><a class="more" href="{{ route('product', [isset($category) ? $category->code :
                                    $car->category->code, $car->code])
         }}">Подробнее</a></td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

