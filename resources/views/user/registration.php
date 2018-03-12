<?php if (!isset($_SESSION['user'])) : ?>

    <?= isset($error) ? $error : '' ?>

    <form action="/security/registration" method="POST">
        <table>
            <tbody>
                <tr>
                    <td>email:</td>
                    <td><input type="" name="email"></td>
                </tr>
                <tr>
                    <td>Пароль:</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="Регестрация">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

<?php endif; ?>