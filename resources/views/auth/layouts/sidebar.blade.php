<div class="sidebar">
    <ul>
        @admin
        <li @routeactive(
        'dashboard')><a href="{{ route('dashboard')}}">Консоль</a></li>
        <li @routeactive(
        'categor*')><a href="{{ route('categories.index')}}">Категории</a></li>
        <li @routeactive(
        'brand*')><a href="{{ route('brands.index')}}">Марки</a></li>
        <li @routeactive(
        'model*')><a href="{{ route('models.index')}}">Модели</a></li>
        <li @routeactive(
        'prod*')><a href="{{ route('products.index')}}">Автомобили</a></li>
        <li @routeactive(
        'order*')><a href="{{ route('auctions.index')}}">Аукционы</a></li>
        <li @routeactive(
        'form*')><a href="{{ route('forms.index')}}">Заявки на покупку</a></li>
        <li @routeactive(
        'payment*')><a href="{{ route('payments.index')}}">Платежи</a></li>

        <li @routeactive(
        'page*')><a href="{{ route('pages.index')}}">Страницы</a></li>
        <li @routeactive(
        'user*')><a href="{{ route('users.index')}}">Пользователи</a></li>
        {{--            <li><a href="">История изменений</a></li>--}}
        <li @routeactive(
        'contact*')><a href="{{ route('contacts.index')}}">Контакты</a></li>
        <li @routeactive(
        'profil*')><a href="{{ route('profile.edit') }}">Профиль</a></li>
        @else
            {{--            <li @routeactive('person.orders.index')><a href="{{ route('person.orders.index')}}">Заказы</a></li>--}}
            <li @routeactive('person.auctions.index')><a href="{{ route('person.auctions.index')}}">Участие в
                аукционах</a></li>
            <li><a href="{{ route('profile.edit') }}">Профиль</a></li>
            @endadmin
    </ul>
</div>
