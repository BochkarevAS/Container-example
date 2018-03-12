<table id="tbl">
    <thead>
        <th><a href="/admin/show/3">Сообщение</a></th>
        <th><a href="/admin/show/2">Email</a></th>
        <th><a href="/admin/show/1">Дата</a></th>
        <th>Редактировать</th>
        <th>Изображения</th>
        <th>Подтверждения</th>
        <th>Удалить</th>
    </thead>
    <tbody>
        <?php foreach ($list as $item) : ?>
            <tr>
                <td><input form="fu_<?= $item['id'] ?>" type="text" name="message" value="<?= $item['message'] ?>"></td>
                <td><?= $item['email'] ?></td>
                <td><?= $item['dt'] ?></td>
                <td>
                    <form id="fu_<?= $item['id'] ?>" action="/admin/update" method="POST">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <input type="submit" name="submit" value="Редактировать">
                    </form>
                </td>
                <td>
                    <?php if (!isset($item['img'])) : ?>
                        <form action="/admin/addImage/<?= $item['id'] ?>" enctype="multipart/form-data" method="POST">
                            <input type="file" name="file">
                            <input type="submit" name="submit" value="Залить">
                        </form>
                    <?php else : ?>
                        <img src="/UploadedFiles/<?= $item['img'] ?>" width="100" height="100">
                    <?php endif; ?>
                </td>
                <td>
                    <?php if (empty($item['isadmin'])) : ?>
                        <form action="/admin/isAdmin" method="POST">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <input type="submit" name="submit" value="Принять">
                        </form>
                    <?php else : ?>
                        <span>Заявка принята</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/admin/delete/<?= $item['id'] ?>">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
