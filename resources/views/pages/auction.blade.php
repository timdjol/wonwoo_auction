@extends('layouts.master')

@section('title', 'Аукцион')

@section('content')



    <div class="pagetitle" style="background-image: url({{ route('index') }}/img/slide1.jpg)">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $product->firstOrFail()->title }}</h1>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('index') }}">Главная</a></li>
                        <li>/</li>
                        <li>{{ $product->firstOrFail()->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @php
    $contacts = \App\Models\Contact::first();
     @endphp

    <div class="page about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-12">
                    <form class="form-callback" id="callback" action="{{ route('auctions.store') }}" method="post">
                        <div class="wrong">
                            <h5>Аукцион закончен</h5>
                        </div>
                        <h3>Участие в аукционе</h3>
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="name" value="{{ Auth()->user()->name }}">
                        <input type="hidden" name="email" value="{{ Auth()->user()->email }}">
                        <input type="hidden" name="phone" value="{{ Auth()->user()->phone }}">
                        <input type="hidden" name="product_id" value="{{ $product->firstOrFail()->id }}">
                        <input type="hidden" name="sum" id="sum" value="1">
                        <img loading="lazy" src="{{ Storage::url($product->firstOrFail()->image) }}" alt="">
                        <h5>Ваша ставка: <a><span id="clicks">{{ number_format($product->firstOrFail()->price) }}</span> сом</h5>
                        <script>
                            let clicks = {{ $product->firstOrFail()->price }};
                            function onClick() {
                                clicks += {{ $contacts->sum_auc }};
                                document.getElementById("clicks").innerHTML = clicks;
                                $('#sum').val(clicks);
                            };
                            setTimeout(function(){
                                $('.wrong').addClass('active');
                            }, 30000);
                        </script>
                        <a class="more" onClick="onClick()">Добавить +</a>
                        <button>Отправить заявку</button>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

<script>
    window.setTimeout(function(){
        window.location.href = "{{ route('index') }}";
    }, {{ $contacts->time_auc }});
</script>
