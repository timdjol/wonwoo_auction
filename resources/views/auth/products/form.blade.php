@extends('auth.layouts.master')

@isset($product)
    @section('title', 'Редактировать  ' . $product->title)
@else
    @section('title', 'Добавить авто')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @isset($product)
                        <h1>Редактировать продукцию {{ $product->title }}</h1>
                    @else
                        <h1>Добавить авто</h1>
                    @endisset
                    <form method="post" enctype="multipart/form-data"
                          @isset($product)
                              action="{{ route('products.update', $product) }}"
                          @else
                              action="{{ route('products.store') }}"
                            @endisset
                    >
                        @isset($product)
                            @method('PUT')
                        @endisset
                        @include('auth.layouts.error', ['fieldname' => 'title'])
                        <div class="form-group">
                            <label for="">Заголовок</label>
                            <input type="text" name="title" value="{{ old('title', isset($product) ? $product->title :
                             null) }}">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Характеристики авто</h5>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'category_id'])
                                <div class="form-group">
                                    <label for="category">Категория</label>
                                    <select name="category_id" id="category">
                                        <option value="">Выбрать</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                    @if(old('category_id') == $category->id)
                                                        selected
                                                    @endif
                                                    @isset($product)
                                                        @if($product->category_id == $category->id)
                                                            selected
                                                    @endif
                                                    @endisset
                                            >{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @include('auth.layouts.error', ['fieldname' => 'brand_id'])
                                    <label for="brand">Бренд</label>
                                    <select name="brand_id" id="brand">
                                        <option value="">Выбрать</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                    @if(old('brand_id') == $brand->id)
                                                        selected
                                                    @endif
                                                    @isset($product)
                                                        @if($product->brand_id == $brand->id)
                                                            selected
                                                    @endif
                                                    @endisset
                                            >{{ $brand->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @include('auth.layouts.error', ['fieldname' => 'models_id'])
                                    <label for="model">Модель</label>
                                    <select name="models_id" id="model">
                                        <option value="">Выбрать</option>
                                        @foreach($models as $model)
                                            <option value="{{ $model->id }}"
                                                    @if(old('models_id') == $model->id)
                                                        selected
                                                    @endif
                                                    @isset($product)
                                                        @if($product->models_id == $model->id)
                                                            selected
                                                    @endif
                                                    @endisset
                                            >{{ $model->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'year'])
                                <div class="form-group">
                                    <label for="year">Год выпуска</label>
                                    <select name="year" id="year">
                                        @isset($product)
                                            <option value="{{ $product->year }}" selected>{{ $product->year }}</option>
                                        @else
                                            <option value="">Выбрать</option>
                                        @endisset
                                        <option value="2024" @if(old('year') == 2024)
                                            selected
                                                @endif>2024
                                        </option>
                                        <option value="2023" @if(old('year') == 2023)
                                            selected
                                                @endif>2023
                                        </option>
                                        <option value="2022" @if(old('year') == 2022)
                                            selected
                                                @endif>2022
                                        </option>
                                        <option value="2021" @if(old('year') == 2021)
                                            selected
                                                @endif>2021
                                        </option>
                                        <option value="2020" @if(old('year') == 2020)
                                            selected
                                                @endif>2020
                                        </option>
                                        <option value="2019" @if(old('year') == 2019)
                                            selected
                                                @endif>2019
                                        </option>
                                        <option value="2018" @if(old('year') == 2018)
                                            selected
                                                @endif>2018
                                        </option>
                                        <option value="2017" @if(old('year') == 201)
                                            selected
                                                @endif>2017
                                        </option>
                                        7
                                        <option value="2016" @if(old('year') == 2016)
                                            selected
                                                @endif>2016
                                        </option>
                                        <option value="2015" @if(old('year') == 2015)
                                            selected
                                                @endif>2015
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'engine'])
                                <div class="form-group">
                                    <label for="engine">Двигатель</label>
                                    <input type="text" id="engine" name="engine" value="{{ old('engine', isset
                                    ($product) ?
                                $product->engine :
                             null) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'transmission'])
                                <div class="form-group">
                                    <label for="transmission">Коробка</label>
                                    <select name="transmission" id="transmission">
                                        @isset($product)
                                            <option value="{{ $product->transmission }}" selected>{{
                                            $product->transmission }}</option>
                                        @else
                                            <option value="">Выбрать</option>
                                        @endisset
                                        <option value="Автомат" @if(old('transmission') == 'Автомат')
                                            selected
                                                @endif>Автомат
                                        </option>
                                        <option value="Механика" @if(old('transmission') == 'Механика')
                                            selected
                                                @endif>Механика
                                        </option>
                                        <option value="Робот" @if(old('transmission') == 'Робот')
                                            selected
                                                @endif>Робот
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'oil'])
                                <div class="form-group">
                                    <label for="oil">Вид топлива</label>
                                    <select name="oil" id="oil">
                                        @isset($product)
                                            <option value="{{ $product->oil }}" selected>{{ $product->oil }}</option>
                                        @else
                                            <option value="">Выбрать</option>
                                        @endisset
                                        <option value="Бензин" @if(old('oil') == 'Бензин')
                                            selected
                                                @endif>Бензин
                                        </option>
                                        <option value="Дизель" @if(old('oil') == 'Дизель')
                                            selected
                                                @endif>Дизель
                                        </option>
                                        <option value="Гибрид" @if(old('oil') == 'Гибрид')
                                            selected
                                                @endif>Гибрид
                                        </option>
                                        <option value="Электро" @if(old('oil') == 'Газ')
                                            selected
                                                @endif>Газ
                                        </option>
                                        <option value="Электро" @if(old('oil') == 'Электро')
                                            selected
                                                @endif>Электро
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'color'])
                                <div class="form-group">
                                    <label for="color">Цвет</label>
                                    <select name="color" id="color">
                                        @isset($product)
                                            <option value="{{ $product->color }}" selected>{{ $product->color
                                            }}</option>
                                        @else
                                            <option value="">Выбрать</option>
                                        @endisset
                                        <option value="Белый" @if(old('color') == 'Белый') selected @endif>Белый
                                        </option>
                                        <option value="Серый" @if(old('color') == 'Серый') selected
                                                @endif>Серый
                                        </option>
                                        <option value="Серебристый" @if(old('color') == 'Серебристый') selected
                                                @endif>Серебристый
                                        </option>
                                        <option value="Черный" @if(old('color') == 'Черный') selected
                                                @endif>Черный
                                        </option>
                                        <option value="Синий" @if(old('color') == 'Синий') selected
                                                @endif>Синий
                                        </option>
                                        <option value="Зеленый" @if(old('color') == 'Зеленый') selected
                                                @endif>Зеленый
                                        </option>
                                        <option value="Оранжевый" @if(old('color') == 'Оранжевый') selected
                                                @endif>Оранжевый
                                        </option>
                                        <option value="Желтый" @if(old('color') == 'Желтый') selected
                                                @endif>Желтый
                                        </option>
                                        <option value="Красный" @if(old('color') == 'Красный') selected
                                                @endif>Красный
                                        </option>
                                        <option value="Коричневый" @if(old('color') == 'Коричневый') selected
                                                @endif>Коричневый
                                        </option>
                                        <option value="Голубой" @if(old('color') == 'Голубой') selected
                                                @endif>Голубой
                                        </option>
                                        <option value="Темно-синий" @if(old('color') == 'Темно-синий') selected
                                                @endif>Темно-синий
                                        </option>
                                        <option value="Перламутовый"
                                                @if(old('color') == 'Перламутовый') selected @endif>Перламутовый
                                        </option>
                                        <option value="Брызги шампанского"
                                                @if(old('color') == 'Брызги шампанского') selected @endif>Брызги
                                            шампанского
                                        </option>
                                        <option value="Смарагд" @if(old('color') == 'Смарагд') selected
                                                @endif>Смарагд
                                        </option>
                                        <option value="Бирюзовый" @if(old('color') == 'Бирюзовый') selected
                                                @endif>Бирюзовый
                                        </option>
                                        <option value="Мокрый асфальт"
                                                @if(old('color') == 'Мокрый асфальт') selected @endif>Мокрый асфальт
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'drive'])
                                <div class="form-group">
                                    <label for="drive">Привод</label>
                                    <select name="drive" id="drive">
                                        @isset($product)
                                            <option value="{{ $product->drive }}" selected>{{ $product->drive
                                            }}</option>
                                        @else
                                            <option value="">Выбрать</option>
                                        @endisset
                                        <option value="Передний" @if(old('drive') == 'Передний')
                                            selected
                                                @endif>Передний
                                        </option>
                                        <option value="Задний" @if(old('drive') == 'Задний')
                                            selected
                                                @endif>Задний
                                        </option>
                                        <option value="Полный" @if(old('drive') == 'Полный')
                                            selected
                                                @endif>Полный
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'steer'])
                                <div class="form-group">
                                    <label for="steer">Расположение руля</label>
                                    <select name="steer" id="steer">
                                        @isset($product)
                                            <option value="{{ $product->steer }}" selected>{{ $product->steer
                                            }}</option>
                                        @else
                                            <option value="">Выбрать</option>
                                        @endisset
                                        <option value="Слева" @if(old('steer') == 'Слева')
                                            selected
                                                @endif>Слева
                                        </option>
                                        <option value="Справа" @if(old('steer') == 'Справа')
                                            selected
                                                @endif>Справа
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'volume'])
                                <div class="form-group">
                                    <label for="volume">Объем</label>
                                    <select name="volume" id="volume">
                                        @isset($product)
                                            <option value="{{ $product->volume }}" selected>{{ $product->volume
                                            }}</option>
                                        @else
                                            <option value="">Выбрать</option>
                                        @endisset
                                        <option value="1.3" @if(old('volume') == '1.3') selected @endif>1.3</option>
                                        <option value="1.4" @if(old('volume') == '1.4') selected @endif>1.4</option>
                                        <option value="1.5" @if(old('volume') == '1.5') selected @endif>1.5</option>
                                        <option value="1.6" @if(old('volume') == '1.6') selected @endif>1.6</option>
                                        <option value="1.7" @if(old('volume') == '1.7') selected @endif>1.7</option>
                                        <option value="1.8" @if(old('volume') == '1.8') selected @endif>1.8</option>
                                        <option value="1.9" @if(old('volume') == '1.9') selected @endif>1.9</option>
                                        <option value="2.0" @if(old('volume') == '2.0') selected @endif>2.0
                                        </option>
                                        <option value="2.1" @if(old('volume') == '2.1') selected @endif>2.1</option>
                                        <option value="2.2" @if(old('volume') == '2.2') selected @endif>2.2</option>
                                        <option value="2.3" @if(old('volume') == '2.3') selected @endif>2.3</option>
                                        <option value="2.4" @if(old('volume') == '2.4') selected @endif>2.4</option>
                                        <option value="2.5" @if(old('volume') == '2.5') selected @endif>2.5</option>
                                        <option value="2.6" @if(old('volume') == '2.6') selected @endif>2.6</option>
                                        <option value="2.7" @if(old('volume') == '2.7') selected @endif>2.7</option>
                                        <option value="2.8" @if(old('volume') == '2.8') selected @endif>2.8</option>
                                        <option value="2.9" @if(old('volume') == '2.9') selected @endif>2.9</option>
                                        <option value="3.0" @if(old('volume') == '3.0') selected @endif>3.0</option>
                                        <option value="3.1" @if(old('volume') == '3.1') selected @endif>>3.1</option>
                                        <option value="3.2" @if(old('volume') == '3.2') selected @endif>3.2</option>
                                        <option value="3.3" @if(old('volume') == '3.3') selected @endif>3.3</option>
                                        <option value="3.4" @if(old('volume') == '3.4') selected @endif>3.4</option>
                                        <option value="3.5" @if(old('volume') == '3.5') selected @endif>3.5</option>
                                        <option value="3.6" @if(old('volume') == '3.6') selected @endif>3.6</option>
                                        <option value="3.7" @if(old('volume') == '3.7') selected @endif>3.7</option>
                                        <option value="3.8" @if(old('volume') == '3.8') selected @endif>3.8</option>
                                        <option value="3.9" @if(old('volume') == '3.9') selected @endif>3.9</option>
                                        <option value="4.0" @if(old('volume') == '4.0') selected @endif>4.0</option>
                                        <option value="4.1" @if(old('volume') == '4.1') selected @endif>4.1</option>
                                        <option value="4.2" @if(old('volume') == '4.2') selected @endif>4.2</option>
                                        <option value="4.3" @if(old('volume') == '4.3') selected @endif>4.3</option>
                                        <option value="4.4" @if(old('volume') == '4.4') selected @endif>4.4</option>
                                        <option value="4.5" @if(old('volume') == '4.5') selected @endif>4.5</option>
                                        <option value="4.6" @if(old('volume') == '4.6') selected @endif>4.6</option>
                                        <option value="4.7" @if(old('volume') == '4.7') selected @endif>4.7</option>
                                        <option value="4.8" @if(old('volume') == '4.8') selected @endif>4.8</option>
                                        <option value="4.9" @if(old('volume') == '4.9') selected @endif>4.9</option>
                                        <option value="5.0" @if(old('volume') == '5.0') selected @endif>5.0</option>
                                        <option value="5.1" @if(old('volume') == '5.1') selected @endif>5.1</option>
                                        <option value="5.2" @if(old('volume') == '5.2') selected @endif>5.2</option>
                                        <option value="5.3" @if(old('volume') == '5.3') selected @endif>5.3</option>
                                        <option value="5.4" @if(old('volume') == '5.4') selected @endif>5.4</option>
                                        <option value="5.5" @if(old('volume') == '5.5') selected @endif>5.5</option>
                                        <option value="5.6" @if(old('volume') == '5.6') selected @endif>5.6</option>
                                        <option value="5.7" @if(old('volume') == '5.7') selected @endif>5.7</option>
                                        <option value="5.8" @if(old('volume') == '5.8') selected @endif>5.8</option>
                                        <option value="5.9" @if(old('volume') == '5.9') selected @endif>5.9</option>
                                        <option value="6.0" @if(old('volume') == '6.0') selected @endif>6.0</option>
                                        <option value="6.1" @if(old('volume') == '6.1') selected @endif>6.1</option>
                                        <option value="6.2" @if(old('volume') == '6.2') selected @endif>6.2</option>
                                        <option value="6.3" @if(old('volume') == '6.3') selected @endif>6.3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'power'])
                                <div class="form-group">
                                    <label for="power">Мощность</label>
                                    <input type="number" name="power" id="power" value="{{ old('power', isset
                                    ($product) ?
                                $product->power :
                             null) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'markup'])
                                <div class="form-group">
                                    <label for="markup">Номер авто</label>
                                    <input type="text" name="markup" id="markup" value="{{ old('markup', isset
                                    ($product) ?
                                $product->markup :
                             null) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'parking'])
                                <div class="form-group">
                                    <label for="parking">Номер паркинга</label>
                                    <input type="text" name="parking" id="parking" value="{{ old('parking', isset
                                    ($product) ?
                                $product->parking :
                             null) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'state'])
                                <div class="form-group">
                                    <label for="state">Состояние авто</label>
                                    <select name="state" id="state">
                                        @isset($product)
                                            <option value="{{ $product->state }}" selected>{{ $product->state
                                            }}</option>
                                        @else
                                            <option value="">Выбрать</option>
                                        @endisset
                                        <option value="1" @if(old('state') == 1)
                                            selected
                                                @endif>1
                                        </option>
                                        <option value="2" @if(old('state') == 2)
                                            selected
                                                @endif>2
                                        </option>
                                        <option value="3" @if(old('state') == 3)
                                            selected
                                                @endif>3
                                        </option>
                                        <option value="4" @if(old('state') == 4)
                                            selected
                                                @endif>4
                                        </option>
                                        <option value="5" @if(old('state') == 5)
                                            selected
                                                @endif>5
                                        </option>
                                        <option value="6" @if(old('state') == 6)
                                            selected
                                                @endif>6
                                        </option>
                                        <option value="7" @if(old('state') == 7)
                                            selected
                                                @endif>7
                                        </option>
                                        <option value="8" @if(old('state') == 8)
                                            selected
                                                @endif>8
                                        </option>
                                        <option value="9" @if(old('state') == 9)
                                            selected
                                                @endif>9
                                        </option>
                                        <option value="10" @if(old('state') == 10)
                                            selected
                                                @endif>10
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'vin'])
                                <div class="form-group">
                                    <label for="vin">VIN</label>
                                    <input type="text" name="vin" id="vin" value="{{ old('vin', isset($product) ?
                                $product->vin :
                             null) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'mile'])
                                <div class="form-group">
                                    <label for="mile">Пробег</label>
                                    <input type="number" name="mile" id="mile" value="{{ old('mile', isset($product) ?
                                $product->mile :
                             null) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'type_own'])
                                <div class="form-group">
                                    <label for="own">Тип владения</label>
                                    <select name="type_own" id="own">
                                        @isset($product)
                                            <option value="{{ $product->type_own }}" selected>{{ $product->type_own
                                            }}</option>
                                        @else
                                            <option value="">Выбрать</option>
                                        @endisset
                                        <option value="Собственник" @if(old('type_own') == 'Собственник')
                                            selected
                                                @endif>Собственник
                                        </option>
                                        <option value="Юридическое лицо" @if(old('type_own') == 'Юридическое лицо')
                                            selected
                                                @endif>Юридическое лицо
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'size'])
                                <div class="form-group">
                                    <label for="size">Размер колес</label>
                                    <select name="size" id="size">
                                        @isset($product)
                                            <option value="{{ $product->size }}" selected>{{ $product->size
                                            }}</option>
                                        @else
                                            <option value="">Выбрать</option>
                                        @endisset
                                        <option value="15" @if(old('size') == '15')
                                            selected
                                                @endif>15
                                        </option>
                                        <option value="16" @if(old('size') == '16')
                                            selected
                                                @endif>16
                                        </option>
                                        <option value="17" @if(old('size') == '17')
                                            selected
                                                @endif>17
                                        </option>
                                        <option value="18" @if(old('size') == '18')
                                            selected
                                                @endif>18
                                        </option>
                                        <option value="19" @if(old('size') == '19')
                                            selected
                                                @endif>19
                                        </option>
                                        <option value="20" @if(old('size') == '20')
                                            selected
                                                @endif>20
                                        </option>
                                        <option value="21" @if(old('size') == '21')
                                            selected
                                                @endif>21
                                        </option>
                                        <option value="22" @if(old('size') == '22')
                                            selected
                                                @endif>22
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'type_wheel'])
                                <div class="form-group">
                                    <label for="type_wheel">Тип шины</label>
                                    <select name="type_wheel" id="type_wheel">
                                        @isset($product)
                                            <option value="{{ $product->type_wheel }}" selected>{{ $product->type_wheel
                                            }}</option>
                                        @else
                                            <option value="">Выбрать</option>
                                        @endisset
                                        <option value="Летние" @if(old('type_wheel') == 'Летние')
                                            selected
                                                @endif>Летние
                                        </option>
                                        <option value="Зимние" @if(old('type_wheel') == 'Зимние')
                                            selected
                                                @endif>Зимние
                                        </option>
                                        <option value="Всесезонные" @if(old('type_wheel') == 'Всесезонные')
                                            selected
                                                @endif>Всесезонные
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'salon_material'])
                                <div class="form-group">
                                    <label for="salon_material">Материал салона</label>
                                    <select name="salon_material" id="salon_material">
                                        @isset($product)
                                            <option value="{{ $product->salon_material }}" selected>{{ $product->salon_material
                                            }}</option>
                                        @else
                                            <option value="">Выбрать</option>
                                        @endisset
                                        <option value="Натуральная кожа"
                                                @if(old('salon_material') == 'Натуральная кожа')
                                                    selected
                                                @endif>Натуральная кожа
                                        </option>
                                        <option value="Искусственная кожа"
                                                @if(old('salon_material') == 'Искусственная кожа')
                                                    selected
                                                @endif>Искусственная кожа
                                        </option>
                                        <option value="Велюр" @if(old('salon_material') == 'Велюр')
                                            selected
                                                @endif>Велюр
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'salon_color'])
                                <div class="form-group">
                                    <label for="salon_color">Цвет салона</label>
                                    <select name="salon_color" id="salon_color">
                                        @isset($product)
                                            <option value="{{ $product->salon_color }}" selected>{{
                                            $product->salon_color }}</option>
                                        @else
                                            <option value="">Выбрать</option>
                                        @endisset
                                        <option value="Белый" @if(old('salon_color') == 'Белый')
                                            selected
                                                @endif>Белый
                                        </option>
                                        <option value="Серый" @if(old('salon_color') == 'Серый')
                                            selected
                                                @endif>Серый
                                        </option>
                                        <option value="Серебристый" @if(old('salon_color') == 'Серебристый')
                                            selected
                                                @endif>Серебристый
                                        </option>
                                        <option value="Черный" @if(old('salon_color') == 'Черный')
                                            selected
                                                @endif>Черный
                                        </option>
                                        <option value="Синий" @if(old('salon_color') == 'Синий')
                                            selected
                                                @endif>Синий
                                        </option>
                                        <option value="Зеленый" @if(old('salon_color') == 'Зеленый')
                                            selected
                                                @endif>Зеленый
                                        </option>
                                        <option value="Оранжевый" @if(old('salon_color') == 'Оранжевый')
                                            selected
                                                @endif>Оранжевый
                                        </option>
                                        <option value="Желтый" @if(old('salon_color') == 'Желтый')
                                            selected
                                                @endif>Желтый
                                        </option>
                                        <option value="Красный" @if(old('salon_color') == 'Красный')
                                            selected
                                                @endif>Красный
                                        </option>
                                        <option value="Коричневый" @if(old('salon_color') == 'Коричневый')
                                            selected
                                                @endif>Коричневый
                                        </option>
                                        <option value="Голубой" @if(old('salon_color') == 'Голубой')
                                            selected
                                                @endif>Голубой
                                        </option>
                                        <option value="Темно-синий" @if(old('salon_color') == 'Темно-синий')
                                            selected
                                                @endif>Темно-синий
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'count_place'])
                                <div class="form-group">
                                    <label for="count_place">Количество мест</label>
                                    <select name="count_place" id="сount_place">
                                        @isset($product)
                                            <option value="{{ $product->count_place }}" selected>{{
                                            $product->count_place
                                            }}</option>
                                        @else
                                            <option value="">Выбрать</option>
                                        @endisset
                                        <option value="1" @if(old('count_place') == 1)
                                            selected
                                                @endif>1
                                        </option>
                                        <option value="2" @if(old('count_place') == 2)
                                            selected
                                                @endif>2
                                        </option>
                                        <option value="3" @if(old('count_place') == 3)
                                            selected
                                                @endif>3
                                        </option>
                                        <option value="4" @if(old('count_place') == 4)
                                            selected
                                                @endif>4
                                        </option>
                                        <option value="5" @if(old('count_place') == 5)
                                            selected
                                                @endif>5
                                        </option>
                                        <option value="6" @if(old('count_place') == 6)
                                            selected
                                                @endif>6
                                        </option>
                                        <option value="7" @if(old('count_place') == 7)
                                            selected
                                                @endif>7
                                        </option>
                                        <option value="8" @if(old('count_place') == 8)
                                            selected
                                                @endif>8
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'price_sale'])
                                <div class="form-group">
                                    <label for="">Цена продажи</label>
                                    <input type="number" name="price_sale" value="{{ old('price_sale', isset
                                    ($product) ? $product->price_sale : null) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Комплектация</h5>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group complex">
                                    <input id="complex1" type="checkbox" name="complex[]"
                                           value="Навигация"
                                    @isset($product)
                                        {{ in_array('Навигация', $complex) ? 'checked' : '' }}
                                            @endisset>
                                    <label for="complex1">Навигация</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group complex">
                                    <input id="complex2" type="checkbox" name="complex[]"
                                           value="Монитор на панели"
                                    @isset($product)
                                        {{ in_array('Монитор на панели', $complex) ? 'checked' : '' }}
                                            @endisset>
                                    <label for="complex2">Монитор на панели</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group complex">
                                    <input id="complex3" type="checkbox" name="complex[]"
                                           value="Смарт ключ"
                                    @isset($product)
                                        {{ in_array('Смарт ключ', $complex) ? 'checked' : '' }}
                                            @endisset>
                                    <label for="complex3">Смарт ключ</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group complex">
                                    <input id="complex4" type="checkbox" name="complex[]"
                                           value="Комфортный доступ"
                                    @isset($product)
                                        {{ in_array('Комфортный доступ', $complex) ? 'checked' : '' }}
                                            @endisset>
                                    <label for="complex4">Комфортный доступ</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group complex">
                                    <input id="complex5" type="checkbox" name="complex[]"
                                           value="HID светодиодный"
                                    @isset($product)
                                        {{ in_array('HID светодиодный', $complex) ? 'checked' : '' }}
                                            @endisset>
                                    <label for="complex5">HID светодиодный</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group complex">
                                    <input id="complex6" type="checkbox" name="complex[]"
                                           value="Обзор 360"
                                    @isset($product)
                                        {{ in_array('Обзор 360', $complex) ? 'checked' : '' }}
                                            @endisset>
                                    <label for="complex6">Обзор 360</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group complex">
                                    <input id="complex7" type="checkbox" name="complex[]"
                                           value="Круиз контроль"
                                    @isset($product)
                                        {{ in_array('Круиз контроль', $complex) ? 'checked' : '' }}
                                            @endisset>
                                    <label for="complex7">Круиз контроль</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group complex">
                                    <input id="complex8" type="checkbox" name="complex[]"
                                           value="Электропакет"
                                    @isset($product)
                                        {{ in_array('Электропакет', $complex) ? 'checked' : '' }}
                                            @endisset>
                                    <label for="complex8">Электропакет</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group complex">
                                    <input id="complex9" type="checkbox" name="complex[]"
                                           value="Панорама"
                                    @isset($product)
                                        {{ in_array('Панорама', $complex) ? 'checked' : '' }}
                                            @endisset>
                                    <label for="complex9">Панорама</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group complex">
                                    <input id="complex11" type="checkbox" name="complex[]"
                                           value="Сигнализация"
                                    @isset($product)
                                        {{ in_array('Сигнализация', $complex) ? 'checked' : '' }}
                                            @endisset>
                                    <label for="complex11">Сигнализация</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group complex">
                                    <input id="complex10" type="checkbox" name="complex[]"
                                           value="Подогрев сидений"
                                    @isset($product)
                                        {{ in_array('Подогрев сидений', $complex) ? 'checked' : '' }}
                                            @endisset>
                                    <label for="complex10">Подогрев сидений</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h5>Видео</h5>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'youtube'])
                                <div class="form-group">
                                    <label for="">Ссылка с Youtube #1</label>
                                    <input type="text" name="youtube" value="{{ old('youtube', isset($product) ?
                                $product->youtube : null) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'youtube2'])
                                <div class="form-group">
                                    <label for="">Ссылка с Youtube #2</label>
                                    <input type="text" name="youtube2" value="{{ old('youtube2', isset($product) ?
                                $product->youtube2 :
                             null) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h5>Данные аукциона</h5>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'lot'])
                                <div class="form-group">
                                    <label for="">Номер лота</label>
                                    <input type="text" name="lot" value="{{ old('lot', isset($product) ?
                                $product->lot :
                             null) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'price'])
                                <div class="form-group">
                                    <label for="">Цена</label>
                                    <input type="number" name="price" value="{{ old('price', isset($product) ?
                                $product->price :
                             null) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'dateLot'])
                                <div class="form-group">
                                    <label for="">Дата аукиона</label>
                                    <input type="date" name="dateLot" value="{{ old('dateLot', isset($product) ?
                                $product->dateLot :
                             null) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'class'])
                                <div class="form-group">
                                    <label for="class">Класс</label>
                                    <select name="class" id="class">
                                        @isset($product)
                                            <option value="{{ $product->class }}" selected>{{ $product->class
                                            }}</option>
                                        @else
                                            <option value="""">Выбрать</option>
                                        @endisset
                                        <option value="A" @if(old('class') == 'A')
                                            selected
                                                @endif>A
                                        </option>
                                        <option value="B" @if(old('class') == 'B')
                                            selected
                                                @endif>B
                                        </option>
                                        <option value="C" @if(old('class') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('auth.layouts.error', ['fieldname' => 'stick'])
                                <div class="form-group">
                                    <label for="sticker">Статус аукциона</label>
                                    <select name="stick" id="sticker">
                                        @isset($product)
                                            <option value="{{ $product->stick }}" selected>{{ $product->stick
                                            }}</option>
                                        @else
                                            <option value="">Выбрать</option>
                                        @endisset
                                        <option value="Продажа" @if(old('stick') == 'Продажа')
                                            selected
                                                @endif>Продажа
                                        </option>
                                        <option value="Продано" @if(old('stick') == 'Продано')
                                            selected
                                                @endif>Продано
                                        </option>
                                        <option value="На рассмотрении" @if(old('stick') == 'На рассмотрении')
                                            selected
                                                @endif>На рассмотрении
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h5>Состояние</h5>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Переднее левое крыло</label>
                                    <select name="plk" id="">
                                        @isset($product->plk)
                                            <option value="{{ $product->plk }}" selected>{{ $product->plk
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('plk') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('plk') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('plk') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('plk') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('plk') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('plk') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Передняя левая дверь</label>
                                    <select name="pld" id="">
                                        @isset($product->pld)
                                            <option value="{{ $product->pld }}" selected>{{ $product->pld
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('pld') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('pld') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('pld') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('pld') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('pld') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('pld') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Задняя левая дверь</label>
                                    <select name="zld" id="">
                                        @isset($product->zld)
                                            <option value="{{ $product->zld }}" selected>{{ $product->zld
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('zld') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('zld') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('zld') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('zld') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('zld') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('zld') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Заднее левое крыло</label>
                                    <select name="zlk" id="">
                                        @isset($product->zlk)
                                            <option value="{{ $product->zlk }}" selected>{{ $product->zlk
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('zlk') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('zlk') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('zlk') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('zlk') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('zlk') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('zlk') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Передний телевизор</label>
                                    <select name="pt" id="">
                                        @isset($product->pt)
                                            <option value="{{ $product->pt }}" selected>{{ $product->pt
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('pt') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('pt') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('pt') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('pt') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('pt') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('pt') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Передний левый лонжерон</label>
                                    <select name="pll" id="">
                                        @isset($product->pll)
                                            <option value="{{ $product->pll }}" selected>{{ $product->pll
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('pll') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('pll') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('pll') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('pll') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('pll') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('pll') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Передний правый лонжерон</label>
                                    <select name="ppl" id="">
                                        @isset($product->pll)
                                            <option value="{{ $product->ppl }}" selected>{{ $product->ppl
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('ppl') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('ppl') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('ppl') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('ppl') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('ppl') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('ppl') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Передний капот</label>
                                    <select name="pk" id="">
                                        @isset($product->pk)
                                            <option value="{{ $product->pk }}" selected>{{ $product->pk
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('pk') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('pk') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('pk') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('pk') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('pk') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('pk') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Крыша</label>
                                    <select name="k" id="">
                                        @isset($product->k)
                                            <option value="{{ $product->k }}" selected>{{ $product->k
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('k') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('k') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('k') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('k') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('k') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('k') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Задний капот</label>
                                    <select name="zk" id="">
                                        @isset($product->pk)
                                            <option value="{{ $product->zk }}" selected>{{ $product->zk
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('zk') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('zk') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('zk') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('zk') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('zk') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('zk') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Задний левый лонжерон</label>
                                    <select name="zll" id="">
                                        @isset($product->zll)
                                            <option value="{{ $product->zll }}" selected>{{ $product->zll
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('zll') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('zll') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('zll') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('zll') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('zll') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('zll') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Задний правый лонжерон</label>
                                    <select name="zpl" id="">
                                        @isset($product->zll)
                                            <option value="{{ $product->zpl }}" selected>{{ $product->zpl
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('zpl') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('zpl') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('zpl') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('zpl') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('zpl') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('zpl') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Задний телевизор</label>
                                    <select name="zt" id="">
                                        @isset($product->zt)
                                            <option value="{{ $product->zt }}" selected>{{ $product->zt
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('zt') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('zt') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('zt') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('zt') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('zt') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('zt') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Переднее правое крыло</label>
                                    <select name="ppk" id="">
                                        @isset($product->ppk)
                                            <option value="{{ $product->ppk }}" selected>{{ $product->ppk
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('ppk') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('ppk') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('ppk') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('ppk') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('ppk') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('ppk') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Передняя правая дверь</label>
                                    <select name="ppd" id="">
                                        @isset($product->ppd)
                                            <option value="{{ $product->ppd }}" selected>{{ $product->ppd
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('ppd') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('ppd') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('ppd') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('ppd') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('ppd') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('ppd') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Задняя правая дверь</label>
                                    <select name="zpd" id="">
                                        @isset($product->zpd)
                                            <option value="{{ $product->zpd }}" selected>{{ $product->zpd
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('zpd') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('zpd') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('zpd') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('zpd') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('zpd') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('zpd') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Заднее правое крыло</label>
                                    <select name="zpk" id="">
                                        @isset($product->zpk)
                                            <option value="{{ $product->zpk }}" selected>{{ $product->zpk
                                            }}</option>
                                        @endisset
                                        <option value="">Выбрать</option>
                                        <option value="K" @if(old('zpk') == 'K')
                                            selected
                                                @endif>K
                                        </option>
                                        <option value="З" @if(old('zpk') == 'З')
                                            selected
                                                @endif>З
                                        </option>
                                        <option value="Ш" @if(old('zpk') == 'Ш')
                                            selected
                                                @endif>Ш
                                        </option>
                                        <option value="Ц" @if(old('zpk') == 'Ц')
                                            selected
                                                @endif>Ц
                                        </option>
                                        <option value="C" @if(old('zpk') == 'C')
                                            selected
                                                @endif>C
                                        </option>
                                        <option value="X" @if(old('zpk') == 'X')
                                            selected
                                                @endif>X
                                        </option>
                                    </select>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Протокол осмотра</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @include('auth.layouts.error', ['fieldname' => 'tengine'])
                                    <label for="">Двигатель</label>
                                    <select name="tengine" id="">
                                        @isset($product)
                                            <option value="{{ $product->tengine }}" selected>{{ $product->tengine
                                            }}</option>
                                        @else
                                            <option>Выбрать</option>
                                        @endisset
                                        <option value="Отличное состояние" @if(old('tengine') == 'Отличное состояние')
                                            selected
                                                @endif>Отличное состояние
                                        </option>
                                        <option value="Хорошее состояние" @if(old('tengine') == 'Хорошее состояние')
                                            selected
                                                @endif>Хорошее состояние
                                        </option>
                                        <option value="Требуется вложение" @if(old('tengine') == 'Требуется вложение')
                                            selected
                                                @endif>Требуется вложение
                                        </option>
                                        <option value="Требуется замена" @if(old('tengine') == 'Требуется замена')
                                            selected
                                                @endif>Требуется замена
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @isset($engines)
                                        <label for="">Изображения двигателя</label>
                                        @foreach($engines as $engine)
                                            <img src="{{ Storage::url($engine->image) }}" alt="">
                                        @endforeach
                                    @endisset
                                    <input type="file" name="engines[]" multiple="true">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    @include('auth.layouts.error', ['fieldname' => 'ttransmission'])
                                    <label for="ttransmission">Трансмиссия</label>
                                    <select name="ttransmission" id="ttransmission">
                                        @isset($product)
                                            <option value="{{ $product->ttransmission }}" selected>{{
                                            $product->ttransmission }}</option>
                                        @else
                                            <option>Выбрать</option>
                                        @endisset
                                        <option value="Отличное состояние" @if(old('ttransmission') == 'Отличное
                                            состояние')
                                            selected
                                                @endif>Отличное состояние
                                        </option>
                                        <option value="Хорошее состояние" @if(old('ttransmission') == 'Хорошее
                                            состояние')
                                            selected
                                                @endif>Хорошее состояние
                                        </option>
                                        <option value="Требуется вложение" @if(old('ttransmission') == 'Требуется
                                            вложение')
                                            selected
                                                @endif>Требуется вложение
                                        </option>
                                        <option value="Требуется замена" @if(old('ttransmission') == 'Требуется
                                            замена')
                                            selected
                                                @endif>Требуется замена
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @isset($transmissions)
                                        <label for="">Изображения трансмиссии</label>
                                        @foreach($transmissions as $transmission)
                                            <img src="{{ Storage::url($transmission->image) }}" alt="">
                                        @endforeach
                                    @endisset
                                    <input type="file" name="transmissions[]" multiple="true">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    @include('auth.layouts.error', ['fieldname' => 'tsuspension'])
                                    <label for="tsuspension">Подвеска</label>
                                    <select name="tsuspension" id="tsuspension">
                                        @isset($product)
                                            <option value="{{ $product->tsuspension }}" selected>{{
                                            $product->tsuspension
                                            }}</option>
                                        @else
                                            <option>Выбрать</option>
                                        @endisset
                                        <option value="Отличное состояние" @if(old('tsuspension') == 'Отличное
                                            состояние')
                                            selected
                                                @endif>Отличное состояние
                                        </option>
                                        <option value="Хорошее состояние" @if(old('tsuspension') == 'Хорошее
                                            состояние')
                                            selected
                                                @endif>Хорошее состояние
                                        </option>
                                        <option value="Требуется вложение" @if(old('tsuspension') == 'Требуется
                                            вложение')
                                            selected
                                                @endif>Требуется вложение
                                        </option>
                                        <option value="Требуется замена" @if(old('tsuspension') == 'Требуется
                                            замена')
                                            selected
                                                @endif>Требуется замена
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @isset($suspensions)
                                        <label for="">Изображения подвески</label>
                                        @foreach($suspensions as $suspension)
                                            <img src="{{ Storage::url($suspension->image) }}" alt="">
                                        @endforeach
                                    @endisset
                                    <input type="file" name="suspensions[]" multiple="true">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    @include('auth.layouts.error', ['fieldname' => 'tbrake'])
                                    <label for="tbrake">Тормозная система</label>
                                    <select name="tbrake" id="tbrake">
                                        @isset($product)
                                            <option value="{{ $product->tbrake }}" selected>{{ $product->tbrake
                                            }}</option>
                                        @else
                                            <option>Выбрать</option>
                                        @endisset
                                        <option value="Отличное состояние" @if(old('tbrake') == 'Отличное
                                            состояние')
                                            selected
                                                @endif>Отличное состояние
                                        </option>
                                        <option value="Хорошее состояние" @if(old('tbrake') == 'Хорошее состояние')
                                            selected
                                                @endif>Хорошее состояние
                                        </option>
                                        <option value="Требуется вложение" @if(old('tbrake') == 'Требуется
                                            вложение')
                                            selected
                                                @endif>Требуется вложение
                                        </option>
                                        <option value="Требуется замена" @if(old('tbrake') == 'Требуется замена')
                                            selected
                                                @endif>Требуется замена
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @isset($brakes)
                                        <label for="">Изображения тормозной системы</label>
                                        @foreach($brakes as $brake)
                                            <img src="{{ Storage::url($brake->image) }}" alt="">
                                        @endforeach
                                    @endisset
                                    <input type="file" name="brakes[]" multiple="true">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    @include('auth.layouts.error', ['fieldname' => 'tsalon'])
                                    <label for="">Салон</label>
                                    <select name="tsalon" id="">
                                        @isset($product)
                                            <option value="{{ $product->tsalon }}" selected>{{ $product->tsalon
                                            }}</option>
                                        @else
                                            <option>Выбрать</option>
                                        @endisset
                                        <option value="Отличное состояние" @if(old('tsalon') == 'Отличное
                                            состояние')
                                            selected
                                                @endif>Отличное состояние
                                        </option>
                                        <option value="Хорошее состояние" @if(old('tsalon') == 'Хорошее состояние')
                                            selected
                                                @endif>Хорошее состояние
                                        </option>
                                        <option value="Требуется вложение" @if(old('tsalon') == 'Требуется
                                            вложение')
                                            selected
                                                @endif>Требуется вложение
                                        </option>
                                        <option value="Требуется замена" @if(old('tsalon') == 'Требуется замена')
                                            selected
                                                @endif>Требуется замена
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @isset($salons)
                                        <label for="">Изображения салона</label>
                                        @foreach($salons as $salon)
                                            <img src="{{ Storage::url($salon->image) }}" alt="">
                                        @endforeach
                                    @endisset
                                    <input type="file" name="salons[]" multiple="true">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    @include('auth.layouts.error', ['fieldname' => 'tbody'])
                                    <label for="">Кузовные элементы</label>
                                    <select name="tbody" id="">
                                        @isset($product)
                                            <option value="{{ $product->tbody }}" selected>{{ $product->tbody
                                            }}</option>
                                        @else
                                            <option>Выбрать</option>
                                        @endisset
                                        <option value="Отличное состояние" @if(old('tbody') == 'Отличное состояние')
                                            selected
                                                @endif>Отличное состояние
                                        </option>
                                        <option value="Хорошее состояние" @if(old('tbody') == 'Хорошее состояние')
                                            selected
                                                @endif>Хорошее состояние
                                        </option>
                                        <option value="Требуется вложение" @if(old('tbody') == 'Требуется вложение')
                                            selected
                                                @endif>Требуется вложение
                                        </option>
                                        <option value="Требуется замена" @if(old('tbody') == 'Требуется замена')
                                            selected
                                                @endif>Требуется замена
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @isset($bodies)
                                        <label for="">Изображения кузовных элементов</label>
                                        @foreach($bodies as $body)
                                            <img src="{{ Storage::url($body->image) }}" alt="">
                                        @endforeach
                                    @endisset
                                    <input type="file" name="bodies[]" multiple="true">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    @include('auth.layouts.error', ['fieldname' => 'comment'])
                                    <label for="comment">Комментарий СТО</label>
                                    <textarea name="comment" id="comment" rows="6">{{ old('comment', isset($product) ?
                                $product->comment : null) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Изображение</label>
                            @isset($product)
                                <img src="{{ Storage::url($product->image) }}" alt="">
                            @endisset
                            <input type="file" name="image">
                        </div>

                        <div class="form-group">
                            <label for="">Доп изображения</label>
                            @isset($images)
                                @foreach($images as $image)
                                    <img src="{{ Storage::url($image->image) }}" alt="">
                                @endforeach
                            @endisset
                            <input type="file" name="images[]" multiple="true">
                        </div>

                        <div class="form-group">
                            <label for="">Статус</label>
                            <select name="status">
                                <option value="1">Включено</option>
                                <option value="0">Отключено</option>
                            </select>
                        </div>
                        @csrf
                        <button class="more">Отправить</button>
                        <a href="{{ url()->previous() }}" class="btn delete cancel">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        h5 {
            margin-top: 30px;
            display: block;
        }
    </style>

@endsection
