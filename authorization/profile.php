<!DOCTYPE html>
<html lang="ru">
<html>
<head>
 <meta charset="UTF-8">
 <title>Профиль пользователя</title>
 <link href="css/style_users.css" media="screen" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'rel='stylesheet' type='text/css'>
</head>
<?php
// подключаем файл с настройками базы данных
require_once('db_config.php');

// Получение передаваемых данных из post запроса
$username = $_GET['username'];

// Выбор данных из базы данных
$sql = "SELECT f_name, s_name, username FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

// Проверка наличия результатов и вывод их
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        #echo "<p>Имя: " . $row["f_name"]. "</p><p>Фамилия: " . $row["s_name"]. "</p><p>Логин: " . $row["username"]. "</p>";
		$f_name = $row["f_name"];
        $s_name = $row["s_name"];
        $username_ = $row["username"];
    }
} else {
    echo "Результаты не найдены";
}

mysqli_close($conn);
?>
<body>
  <div class="container">
    <h1>Привет, это моя страница профиля!</h1>
    <p>Имя: <?php echo $f_name;?></p>
    <p>Фамилия: <?php echo $s_name ;?></p>
    <p>Логин: <?php echo $username_ ;?></p>
  </div>
</body>
</html>