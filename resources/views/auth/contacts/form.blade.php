@extends('auth.layouts.master')

@isset($contact)
    @section('title', 'Контакты')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-5">
                    @if(session()->has('success'))
                        <p class="alert alert-success">{{ session()->get('success') }}</p>
                    @endif
                    @if(session()->has('warning'))
                        <p class="alert alert-warning">{{ session()->get('warning') }}</p>
                    @endif
                    <h1>Контакты</h1>
                    <form method="post" action="{{ route('contacts.update', $contact) }}">
                        @isset($contact)
                            @method('PUT')
                        @endisset
                        @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Номер телефона</label>
                            <input type="text" name="phone" value="{{ old('phone', isset($contact) ?
                            $contact->phone : null) }}">
                        </div>
                        @error('phone2')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Номер телефона №2</label>
                            <input type="text" name="phone2" value="{{ old('phone2', isset($contact) ?
                            $contact->phone2 : null) }}">
                        </div>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" value="{{ old('email', isset($contact) ?
                            $contact->email : null) }}">
                        </div>
                        @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Адрес</label>
                            <input type="text" name="address" value="{{ old('address', isset($contact) ?
                                $contact->address : null) }}">
                        </div>
                        @error('instagram')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Instagram</label>
                            <input type="text" name="instagram" value="{{ old('instagram', isset($contact) ?
                                $contact->instagram : null) }}">
                        </div>
                        @error('facebook')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Facebook</label>
                            <input type="text" name="facebook" value="{{ old('facebook', isset($contact) ?
                                $contact->facebook : null) }}">
                        </div>
                        @error('tiktok')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Tiktok</label>
                            <input type="text" name="tiktok" value="{{ old('tiktok', isset($contact) ?
                                $contact->tiktok : null) }}">
                        </div>
                        @error('whatsapp')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Whatsapp</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp', isset($contact) ?
                                $contact->whatsapp : null) }}">
                        </div>
                        @error('telegram')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Telegram</label>
                            <input type="text" name="telegram" value="{{ old('telegram', isset($contact) ?
                                $contact->telegram : null) }}">
                        </div>
                            <h5>Настройки аукциона</h5>
                        <div class="form-group">
                            @error('date_auc')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="">Дата начала аукциона</label>
                            <input type="datetime-local" name="date_auc" value="{{ old('date_auc', isset($contact) ?
                                $contact->date_auc : null) }}">
                        </div>
                            <div class="form-group">
                                @error('date_auc')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="">Шаговая стоимость (в сомах)</label>
                                <input type="number" name="sum_auc" value="{{ old('sum_auc', isset($contact) ?
                                $contact->sum_auc : null) }}">
                            </div>
                            <div class="form-group">
                                @error('time_auc')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="">Время события (в милисекундах)</label>
                                <input type="number" name="time_auc" value="{{ old('time_auc', isset($contact) ?
                                $contact->time_auc : null) }}">
                            </div>
                        @csrf
                        <button class="more">Сохранить</button>
                        <a href="{{url()->previous()}}" class="btn delete cancel">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
