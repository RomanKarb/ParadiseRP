<?php
// Подключаем файл для определения языка пользователя
require_once('detect_lang.php');
?>

<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $lang['login']; ?></title>
</head>
<body>
    <ul>
        <li><a href="#"><?php echo $lang['login']; ?></a></li>
        <li><a href="#"><?php echo $lang['register']; ?></a></li>
    </ul>
</body>
</html>