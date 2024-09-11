@extends('auth.layouts.master')

@section('title', 'Контакты')

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth/layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @if(session()->has('success'))
                        <p class="alert alert-success">{{ session()->get('success') }}</p>
                    @endif
                    @if(session()->has('warning'))
                        <p class="alert alert-warning">{{ session()->get('warning') }}</p>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                        <div class="col-md-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection