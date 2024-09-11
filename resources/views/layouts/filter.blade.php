<form action="{{ route('catalog') }}">
    <div class="form-group">
        <label for="">Категория</label>
        <select name="category" id="">
            <option value="">Выбрать</option>
            @foreach($categories as $category)
                <option @if(isset($_GET['category']))@if($_GET['category']
                        == $category->id) selected @endif @endif value="{{ $category->id }}">{{ $category->title
                        }}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">Цена от</label>
                <input type="text" name="price_from" value="{{ request()->price_from }}">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">Цена до</label>
                <input type="text" name="price_to" {{ request()->price_to }}>
            </div>
        </div>
    </div>
{{--    <div class="form-group">--}}
{{--        <label for="year">Год выпуска</label>--}}
{{--        <select name="year" id="year">--}}
{{--            <option value="">Выбрать</option>--}}
{{--            <option value="2024">2024</option>--}}
{{--            <option value="2023">2023</option>--}}
{{--            <option value="2022">2022</option>--}}
{{--            <option value="2021">2021</option>--}}
{{--            <option value="2020">2020</option>--}}
{{--            <option value="2019">2019</option>--}}
{{--            <option value="2018">2018</option>--}}
{{--            <option value="2017">2017</option>--}}
{{--            <option value="2016">2016</option>--}}
{{--            <option value="2015">2015</option>--}}
{{--        </select>--}}
{{--    </div>--}}
    <div class="form-group">
        <label for="oil">Вид топлива</label>
        <select name="oil" id="oil">
            <option value="">Выбрать</option>
            <option value="Бензин" @if(isset($_GET['oil']))@if($_GET['oil']
                        == 'Бензин') selected @endif @endif>Бензин</option>
            <option value="Дизель">Дизель</option>
            <option value="Гибрид">Гибрид</option>
            <option value="Электро">Электро</option>
        </select>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">Объем от</label>
                <input type="number" name="volume_from" value="{{ request()->volume_from }}">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">Объем до</label>
                <input type="number" name="volume_to" value="{{ request()->volume_to }}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="steer">Расположение руля</label>
        <select name="steer" id="steer">
            <option value="">Выбрать</option>
            <option value="Слева" @if(isset($_GET['steer']))@if($_GET['steer']
                        == 'Слева') selected @endif @endif>Слева</option>
            <option value="Справа">Справа</option>
        </select>
    </div>
    <div class="form-group">
        <label for="drive">Привод</label>
        <select name="drive" id="drive">
            <option value="">Выбрать</option>
            <option value="Передний" @if(isset($_GET['drive']))@if($_GET['drive']
                        == 'Передний') selected @endif @endif>Передний</option>
            <option value="Задний" @if(isset($_GET['drive']))@if($_GET['drive']
                        == 'Задний') selected @endif @endif>Задний</option>
            <option value="Полный" @if(isset($_GET['drive']))@if($_GET['drive']
                        == 'Полный') selected @endif @endif>Полный</option>
        </select>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">Пробег от</label>
                <input type="number" name="mile_from" value="{{ request()->mile_from }}">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">Пробег до</label>
                <input type="number" name="mile_to" value="{{ request()->mile_to }}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="class">Класс</label>
        <select name="class" id="drive">
            <option value="">Выбрать</option>
            <option value="A" @if(isset($_GET['drive']))@if($_GET['drive']
                        == 'A') selected @endif @endif>A</option>
            <option value="B" @if(isset($_GET['drive']))@if($_GET['drive']
                        == 'B') selected @endif @endif>B</option>
            <option value="C" @if(isset($_GET['drive']))@if($_GET['drive']
                        == 'C') selected @endif @endif>C</option>
        </select>
    </div>
    <div class="btn-wrap">
        <button class="more">Показать</button>
        <a href="{{ route('catalog') }}" class="reset">Сброс</a>
    </div>
</form>