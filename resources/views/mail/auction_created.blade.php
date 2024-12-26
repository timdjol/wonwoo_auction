<h3>🎉 Поздравляем вы выиграли! 🎊</h3>
<h5>Уважаемый Покупатель,</h5>
<h5>Поздравляем вас с успешным выигрышем автомобиля на аукционе WONWOO AUCTION!</h5>
<table>
    <tbody>
    <tr>
        <td>Автомобиль</td>
        <td>{{ $auction->product_title }}</td>
    </tr>
    <tr>
        <td>Стоимость</td>
        <td>{{ number_format($auction->sum) }} сом</td>
    </tr>
    <tr>
        <td>ФИО покупателя</td>
        <td>{{ $auction->name }}</td>
    </tr>
    <tr>
        <td>Ваш номер телефона</td>
        <td><a href="tel:{{ $auction->phone }}">{{ $auction->phone }}</a></td>
    </tr>
    <tr>
        <td>Ссылка на выигранный автомобиль</td>
        <td>
            @php
                $car = \App\Models\Product::where('id', $auction->product_id)->first();
            @endphp
            <a class="more" href="{{ route('product', [isset($category) ? $category->code :
                                    $car->category->code, $car->code])
         }}">Перейти по ссылке</a>
        </td>
    </tr>
    </tbody>
</table>
<p>Мы благодарим вас за участие в нашем аукционе. Для завершения процесса покупки и передачи права собственности,
    пожалуйста, ознакомьтесь с инструкцией ниже.</p>
<h4>Пошаговая инструкция по завершению сделки</h4>
<h5>1. Оплата стоимости автомобиля</h5>
<ul>
    <li>Сумма выигрыша: {{ number_format($auction->sum) }} сом</li>
    <li>Пожалуйста, оплатите полную стоимость автомобиля, включая комиссионные сборы, в течение 3 рабочих дней с момента
        завершения аукциона.
    </li>
    <li>Реквизиты для оплаты
        <ul>
            <li>Банк: [название банка]</li>
            <li>Счёт: [номер счёта]</li>
            <li>Получатель: WONWOO AUCTION</li>
        </ul>
    </li>
</ul>
<h5>2. Вывоз автомобиля</h5>
<ul>
    <li>После подтверждения оплаты мы выдадим вам подтверждение выигрыша</li>
    <li>Вывоз автомобиля должен быть осуществлён в течение 3 рабочих дней с момента завершения аукциона. В этот период
        хранение бесплатное. После истечения срока взимается плата за стоянку (сумма: 90 сом в день).
    </li>
</ul>
<h5>3. Регистрация права собственности</h5>
<ul>
    <li>Вы обязаны завершить процесс передачи права собственности на автомобиль в течение 15 дней с момента завершения
        аукциона.
    </li>
    <li>Необходимые документы:
        <ul>
            <li>Свидетельство о регистрации автомобиля</li>
            <li>Справка об уплате местных налогов</li>
            <li>Доверенность на передачу права собственности</li>
            <li>Справка о печати (или эквивалент для юридических лиц)</li>
        </ul>
    </li>
    <li>• После завершения регистрации отправьте подтверждающие документы в WONWOO AUCTION почтой, факсом или другим
        удобным способом.
    </li>
</ul>
<h5>4. Инспекция автомобиля при получении</h5>
<ul>
    <li>Вы несёте ответственность за проверку состояния автомобиля при получении. Если проверка делегируется третьему
        лицу, вся ответственность остаётся на вас.
    </li>
</ul>
<h4>Контактная информация</h4>
<p>Если у вас возникнут вопросы или потребуется дополнительная информация, пожалуйста, свяжитесь с нами:</p>
<ul>
    <li>Телефон: <a href="tel:+996503434433">+996503434433</a></li>
    <li>Электронная почта: <a href="mailto:info@wonwookorea.com">info@wonwookorea.com</a></li>
    <li>Часы работы: 10:00-16:00</li>
</ul>
<h5>Мы благодарим вас за доверие и участие в аукционе WONWOO AUCTION. Желаем вам успешного завершения сделки и приятного
    использования автомобиля!</h5>
<p>С уважением, <br>
    <b>Команда WONWOO AUCTION</b>
</p>
<style>
    h4 {
        font-size: 22px;
    }

    h5 {
        font-size: 19px;
    }

    p, li {
        font-size: 16px;
    }

    table {
        width: 100%;
    }

    table td {
        padding: 10px 5px;
        border-bottom: 1px solid #ddd;
    }
</style>