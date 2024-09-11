@extends('layouts.master')

@section('title', 'Авто в наличии')

@section('content')

    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Form</h1>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('index') }}">Главная</a></li>
                        <li>/</li>
                        <li>Авто в наличии</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="page cars catalog">
        <div class="container">
            <div class="row">
                <div class="col-md-6">

                    <form id="contactForm" action="{{ route('contact-form', $product) }}" method="post">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" id="name">
                        </div>

                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Enter Email" id="email">
                        </div>

                        <div class="form-group">
                            <input type="text" name="phone" class="form-control" placeholder="Enter Mobile
                                    Number" id="phone">
                        </div>

                        <input type="hidden" name="status" value="process">
                        <input type="hidden" name="user_id" value="1">
                        <input type="hidden" name="sum" value="10000">


                        <div class="form-group">
                            <button class="btn btn-success" id="submit">Submit</button>
                        </div>
                    </form>

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>


                </div>
            </div>
        </div>
    </div>


@endsection

