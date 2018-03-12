<html>

<head>
    <link rel="stylesheet" type="text/css" href="/resources/css/show.css">
    <script src="/resources/js/show.js"></script>
</head>

<body>

    <?php if (isset($_SESSION['user']) || isset($_SESSION['admin'])) : ?>
        <a href="/security/logout">Выход</a>
    <?php else : ?>
        <a href="/security/registration">Регестрация</a>
        <a href="/security/login">Вход</a>
    <?php endif; ?>

    <hr>

    <?php if (isset($content)) : ?>
        <?= $content ?>
    <?php endif; ?>

</body>
</html>