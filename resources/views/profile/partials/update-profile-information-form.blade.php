<h2>Профиль</h2>
{{--<form id="send-verification" method="post" action="{{ route('verification.send') }}">--}}
{{--    @csrf--}}
{{--    <button class="more">Отправить</button>--}}
{{--</form>--}}

<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')
    <div class="form-group">
        @error ('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="">Ваше имя</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}">
    </div>
    <div class="form-group">
        @error ('phone')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="">Номер телефона</label>
        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
    </div>
    <div class="form-group">
        <label for="">Часовой пояс</label>
        <select name="timezone" id="">
            @foreach(timezone_identifiers_list() as $timezone))
                <option @isset($user->timezone)
                            @if($user->timezone == $timezone)
                                selected
                        @endif @endisset value="{{ $timezone }}">{{ $timezone }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        @error ('passport_inn')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="">ИНН</label>
        <input type="number" name="passport_inn" value="{{ old('passport_inn', $user->passport_inn) }}">
    </div>
    <div class="form-group">
        @error ('passport_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="">ID паспорт</label>
        <input type="text" name="passport_id" value="{{ old('passport_id', $user->passport_id) }}">
    </div>
    <div class="form-group">
        @error ('bank')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="">Название банка</label>
        <input type="text" name="bank" value="{{ old('bank', $user->bank) }}">
    </div>
    <div class="form-group">
        @error ('bik')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="">БИК</label>
        <input type="number" name="bik" value="{{ old('bik', $user->bik) }}">
    </div>
    <div class="form-group">
        @error ('account')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="">Р/с</label>
        <input type="text" name="account" value="{{ old('account', $user->account) }}">
    </div>
    <div class="form-group">
        @error ('country')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="">Страна</label>
        <select id="country_id" name="country" class="form-control">
            @foreach ($countries as $country)
                <option value="{{$country->id}}"
                        @isset($user->country)
                            @if($user->country == $country->id)
                                selected
                        @endif
                        @endisset
                >{{$country->title}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Регион</label>
        <select name="region" id="region_id">
            @isset($user->region)
                <option value="{{ $user->region }}">{{ $user->region }}</option>
            @endisset
        </select>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#country_id').on('change', function () {
                    let idCountry = this.value;
                    $("#region_id").html('');
                    $.ajax({
                        url: "{{url('api/fetch-states')}}",
                        type: "POST",
                        data: {
                            country_id: idCountry,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',
                        success: function (result) {
                            $('#region_id').html('<option value="">Выберите область</option>');
                            $.each(result.states, function (key, value) {
                                $("#region_id").append('<option value="' + value.title + '">' +
                                    value
                                        .title + '</option>');
                            });
                        }
                    });
                });
            });
        </script>
    </div>
    <div class="form-group">
        @error ('address')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="">Адрес</label>
        <input type="text" name="address" value="{{ old('address', $user->address) }}">
    </div>
    <div class="form-group">
        @error ('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="">Email</label>
        <input type="text" name="email" value="{{ old('name', $user->email) }}">
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif
    </div>
    @php
        $admin = \Illuminate\Support\Facades\Auth::id();
    @endphp
    @if($admin === 1)
        <div class="form-group">
            @error ('status')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="">Статус</label>
            <select name="status" id="status">
                @isset($user)
                    @if($user->status == 1)
                        <option value="{{ $user->status }}" selected>Активен</option>
                    @else
                        <option value="0">Отключен</option>
                    @endif
                @else
                    <option value="">Выбрать</option>
                @endisset
                <option value="1" @if(old('status') == 'Активен') selected @endif>Активен
                </option>
                <option value="0" @if(old('status') == 'Отключен') selected @endif>Отключен
                </option>
            </select>
        </div>
    @endif
    <button class="more">Сохранить</button>
    @if (session('status') === 'profile-updated')
        <p>Сохранено</p>
    @endif
</form>

<div class="deposit">
    <h4>Депозит</h4>
    @php
        $payment = \App\Models\Payment::where('user_id', $user->id)->first();
    @endphp
    @isset($payment)
        <div class="alert alert-success">
            Ваш депозит составляет: {{ number_format($payment->sum) }} сом
        </div>
    @endisset
    <div class="btn-wrap">
        <a href="{{ route('deposit') }}" target="_blank" class="more">Пополнить</a>
    </div>

</div>