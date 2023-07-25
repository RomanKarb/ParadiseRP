<head>
<meta charset="utf-8">
</head>
 <?php
   if(isset($_GET['redirect_url'])) {
    $redirect_url = $_GET['redirect_url'];
  } else {
    $redirect_url = "/authorization/login";
  }

  if(isset($_GET['username'])) {
    $username_get = $_GET['username'];
    $hidden = "hidden";

      // Подключение к базе данных
require_once('db_config.php');
  $link = mysqli_connect($servername, $username, $password, $dbname);
  
  // Получение данных пользователя из базы данных
  $username = mysqli_real_escape_string($link, $username_get);
  $query = "SELECT f_name, s_name, username FROM users WHERE username='$username' OR email='$username'";
  $result = mysqli_query($link, $query);
  
  if (mysqli_num_rows($result) > 0) {
   while ($row = mysqli_fetch_assoc($result)) {
    echo "<p>Имя: " . $row['f_name'] . " Фамилия: " . $row['s_name'] . "</p>";
	$user_name = $row['username'];
	$f_name = $row['f_name'];
	$s_name = $row['s_name'];
   }
  } else {
   echo "<p>Данные о пользователе не найдены</p>";
   header("Location: messages.php?message=Данные о пользователе не найдены&color=red&color_form=white&title=Данные о пользователе не найдены");
  }
  
  mysqli_close($link);


  } else {
    if(isset($_COOKIE['auth_token'])) {
        $username_get = $_COOKIE['auth_token'];
		echo $username_get;

          // Подключение к базе данных
  $host = 'localhost';
  $user = 'root';
  $password = '';
  $db_name = 'LocalUsersTest';
  require_once('db_config.php');
  $link = mysqli_connect($servername, $username, $password, $dbname);
  
  // Получение данных пользователя из базы данных
  // $username = mysqli_real_escape_string($link, $username_get);
  $query = "SELECT openid FROM active_seans WHERE token='$username_get'";
  $result = mysqli_query($link, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $openid = $row['openid'];
  $query1 = "SELECT f_name, s_name, username FROM users WHERE open_id='$openid'";
  $result1 = mysqli_query($link, $query1);
    }
  if (mysqli_num_rows($result1) > 0) {
   while ($row = mysqli_fetch_assoc($result1)) {
    echo "<p>Имя: " . $row['f_name'] . " Фамилия: " . $row['s_name'] . "</p>";
	$user_name = $row['username'];
	$f_name = $row['f_name'];
	$s_name = $row['s_name'];
   }
  } else {
   echo "<p>Данные о пользователе не найдены</p>";
   header("Location: messages.php?message=Данные о пользователе не найдены&color=red&color_form=white&title=Данные о пользователе не найдены");
  }
} else {
  echo "<p>Данные о пользователе не найдены</p>";
  header("Location: messages.php?message=Данные о пользователе не найдены&color=red&color_form=white&title=Данные о пользователе не найдены");
 }
  
  mysqli_close($link);


    } else {
		echo "<p>Отсутствуют данные для поиска профиля, можете войти для отображения своего профиля</p>";
        header("Location: messages.php?message=Отсутствуют данные для поиска профиля, можете войти для отображения своего профиля&color=red&color_form=white&title=Отсутствуют данные для поиска профиля&button=1&button_text=Войти&action=http://base.roservers.com/authorization/login?redirect_url=$redirect_url");
    }
  }
  if(isset($_GET['redirect_url'])) {
    $redirect_url_have1 = $_GET['redirect_url'];
    $redirect_url_have = "&redirect_url=$redirect_url_have1";
  } else {
    $redirect_url_have = "";
  }
 ?>
<!DOCTYPE html>
<html>
<head>
 <title>Профиль пользователя: <?php echo $user_name; ?></title>
 <style>
  body {
   background-color: #F8F8F8;
   font-family: Arial, sans-serif;
  }
  h1 {
   font-size: 36px;
   text-align: center;
   margin-top: 50px;
  }
  p {
   font-size: 24px;
   margin-left: 50px;
   margin-top: 30px;
  }
  button[type=button] {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 3px;
            border: none;
            margin-bottom: 10px;
            width: 40%;
            background-color: #2c3e50;
            color: #fff;
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 10px;
        }
		        .button {
            background-color: #2c3e50;
            color: #fff;
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 10px;
        }
        .button:hover {
            background-color: #3498db;
        }
  .cancel-btn {
   font-size: 16px;
   padding: 10px 40px;
            border-radius: 3px;
            border: none;
            margin-bottom: 10px;
   background-color: grey;
   color: #fff;
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 10px;
  }
  .cancel-btn:hover {
   background-color: darkred;
  }
 </style>
</head>
<body>
 <h1>Профиль пользователя: <?php echo $user_name; ?></h1>
 <h1>Имя: <?php echo $f_name; ?></h1>
 <h1>Фамилия: <?php echo $s_name; ?></h1>
 <button <?php echo $hidden ?> type="button" class="cancel-btn" onclick="window.location.href='/authorization/login?clear_sessions=1<?php echo $redirect_url_have ?>'">Выйти</button>
</body>
</html>