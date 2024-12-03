<h3>🎉 Поздравляем вы выиграли! 🎊</h3>
<table>
    <tbody>
        <tr>
            <td>Автомобиль</td>
            <td>{{ $auction->product_title }}</td>
        </tr>
        <tr>
            <td>Стоимость</td>
            <td>{{ $auction->sum }} сом</td>
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

<style>
    table{
        width: 100%;
    }
    table td{
        padding: 10px 5px;
        border-bottom: 1px solid #ddd;
    }
</style>