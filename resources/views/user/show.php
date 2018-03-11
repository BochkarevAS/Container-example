<table id="tbl" style="display: none;">
    <thead>
        <th><a href="javascript:void(0)" id="message">Сообщение</a></th>
        <th><a href="javascript:void(0)" id="email">Email</a></th>
        <th><a href="javascript:void(0)" id="date">Дата</a></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </thead>
    <tbody id="tbody"></tbody>
</table>

<form action="" method="POST" id="tf">
    <input type="submit" value="Предварительный просмотр">
</form>

<hr>

<form action="/message/add" method="POST">
    <table>
        <tbody>
            <tr>
                <td>Сообщение:</td>
                <td><textarea type="text" name="message"></textarea></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit" value="Отправить">
                </td>
            </tr>
        </tbody>
    </table>
</form>
