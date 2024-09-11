<table>
    <tbody>
        <tr>
            <td>Автомобиль</td>
            <td>{{ $auction->product_title }}</td>
        </tr>
        <tr>
            <td>Стоимость</td>
            <td>{{ $auction->product_price }} сом</td>
        </tr>
        <tr>
            <td>ФИО покупателя</td>
            <td>{{ $auction->name }}</td>
        </tr>
        <tr>
            <td>Номер телефона</td>
            <td><a href="tel:{{ $auction->phone }}">{{ $auction->phone }}</a></td>
        </tr>
    </tbody>
</table>