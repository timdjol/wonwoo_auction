<table>
    <tbody>
        <tr>
            <td>ФИО покупателя</td>
            <td>{{ $auction->name }}</td>
        </tr>
        <tr>
            <td>Номер телефона</td>
            <td><a href="tel:{{ $auction->phone }}">{{ $auction->phone }}</a></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><a href="mailto:{{ $auction->email }}">{{ $auction->email }}</a></td>
        </tr>
        <tr>
            <td>Сообщение</td>
            <td>{{ $auction->message }}</td>
        </tr>
    </tbody>
</table>