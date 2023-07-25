<!DOCTYPE html>
<html>
<head>
 <title>Профиль пользователя</title>
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
 </style>
</head>
<body>
 <?php
  // Подключение к базе данных
  $host = 'localhost';
  $user = 'root';
  $password = '';
  $db_name = 'LocalUsersTest';
  $link = mysqli_connect($host, $user, $password, $db_name);
  
  $username = "No Name";
  
  // Получение данных пользователя из базы данных
  $username = mysqli_real_escape_string($link, $_GET['username']);
  $query = "SELECT f_name, s_name FROM users WHERE username='$username'";
  $result = mysqli_query($link, $query);
  
  if (mysqli_num_rows($result) > 0) {
   while ($row = mysqli_fetch_assoc($result)) {
	header("Location: dashboard.php?username=$username");
   }
  } else {
   echo "<p>Error</p>";
  }
  
  mysqli_close($link);
 ?>
 <h2 style="text-align:center;">Пользователь: "<?php echo $username ?>" не найден</h2>
</body>
</html>