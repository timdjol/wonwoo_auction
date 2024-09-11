<form action="{{ route('stock') }}">
    <div class="form-group">
        <label for="">Категория</label>
        <select name="category" id="">
            <option value="">Выбрать</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">Цена от</label>
                <input type="text" name="price_from">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">Цена до</label>
                <input type="text" name="price_to">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="year">Год выпуска</label>
        <select name="year" id="year">
            <option value="">Выбрать</option>
            <option value="2024">2024</option>
            <option value="2023">2023</option>
            <option value="2022">2022</option>
            <option value="2021">2021</option>
            <option value="2020">2020</option>
            <option value="2019">2019</option>
            <option value="2018">2018</option>
            <option value="2017">2017</option>
            <option value="2016">2016</option>
            <option value="2015">2015</option>
        </select>
    </div>
    <div class="form-group">
        <label for="oil">Вид топлива</label>
        <select name="oil" id="oil">
            <option value="">Выбрать</option>
            <option value="Бензин">Бензин</option>
            <option value="Дизель">Дизель</option>
            <option value="Гибрид">Гибрид</option>
            <option value="Электро">Электро</option>
        </select>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">Объем от</label>
                <input type="text" name="volume_from">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">Объем до</label>
                <input type="text" name="volume_to">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="steer">Расположение руля</label>
        <select name="steer" id="steer">
            <option value="">Выбрать</option>
            <option value="Слева">Слева</option>
            <option value="Справа">Справа</option>
        </select>
    </div>
    <div class="form-group">
        <label for="drive">Привод</label>
        <select name="drive" id="drive">
            <option value="">Выбрать</option>
            <option value="Передний">Передний</option>
            <option value="Задний">Задний</option>
            <option value="Полный">Полный</option>
        </select>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">Пробег от</label>
                <input type="text" name="mile_from">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">Пробег до</label>
                <input type="text" name="mile_to">
            </div>
        </div>
    </div>
    <div class="btn-wrap">
        <button class="more">Показать</button>
        <a href="{{ route('stock') }}" class="reset">Сброс</a>
    </div>
</form>