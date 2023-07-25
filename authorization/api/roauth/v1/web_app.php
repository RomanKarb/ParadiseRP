<?php require_once('detect_lang.php') ?>
<!DOCTYPE html>
<html lang="<?php echo $user_language ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo $translations['Authorization in the application'] ?></title>
 <style>
        body {
            background: linear-gradient(to bottom right, #3498db, #2c3e50);
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        form {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            border-radius: 25px;
            padding: 60px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.25);
        }
        h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
   text-align: center;
        }
        label {
            font-size: 16px;
            margin-bottom: 10px;
            display: block;
        }
        input[type=text] {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 3px;
            border: 1px solid #CCCCCC;
            margin-bottom: 10px;
            width: calc(100% - 42px);
            background-color: #f2f2f2;
            border-radius: 10px;
        }
        button[type=submit] {
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
		        button[type=submit] {
            background-color: #2c3e50;
            color: #fff;
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 10px;
        }
        button[type=submit]:hover {
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
 <?php
 $client_id = $_GET['client_id'];
 $redirect = $_GET['redirect'];
 if (empty($client_id)) {
  #echo "<h2 style=\"color: red; text-align: center;\">Ошибка: нет client_id в запросе.</h2>";
  #header("Location: http://base.roservers.com/authorization/messages.php/messages.php?message=Ошибка: нет client_id в запросе&color=red&color_form=white&title=Нет client_id в запросе");
  $url1 = 'http://base.roservers.com/errors/404_space_1.css';
  $content1 = file_get_contents($url1);
  echo "<style>" . $content1 . "</style>";
  #echo "Не передан параметр client_id";
  echo "<title>400 - Ошибка выполнения кода</title>";
  $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
  $address = $_SERVER['SERVER_NAME'];
  $port = $_SERVER['SERVER_PORT'] !== '80' ? ":{$_SERVER['SERVER_PORT']}" : "";
  $path = $_SERVER['REQUEST_URI'];
  $fullUrl = "{$protocol}://{$address}{$port}{$path}";
  $url = 'http://base.roservers.com/errors/400_space_1.php?url=' . urlencode($fullUrl) . '&error=' . urlencode("Не передан параметр client_id");
  $content = file_get_contents($url);
  echo $content;
  #header("Location: messages.php?message=Не передан параметр client_id!&color=red&color_form=white&title=Не передан параметр client_id!");
 } else {
//получаем данные из MySql
$conn = new mysqli('localhost', 'root', '', 'LocalUsersTest');

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Формируем запрос к базе данных
$sql = "SELECT name, email, domain FROM apps_roauth WHERE client_id = '$client_id'";
$result = $conn->query($sql);

// Если запрос выполнен успешно
if ($result->num_rows > 0) {
    // Выводим данные о приложении
    while($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $email = $row["email"];
        $domain = $row["domain"];
    }
} else {
    // Если нет данных по указанному client_id
    echo "<h2 style=\"color: red; text-align: center;\">Ошибка: нет данных по указанному client_id.</h2>";
	header("Location: http://base.roservers.com/authorization/messages.php?message=Ошибка: нет данных по указанному client_id \"$client_id\"&color=red&color_form=white&title=Нет данных по client_id");
}

$conn->close(); // Закрываем соединение с базой данных
  echo "<form method=\"POST\" action=\"http://base.roservers.com/authorization/pre_login?app_client_id=$client_id&redirect_url=$redirect\">
    <h2>" . $translations['For the application:'] . "<span style=\"color: blue;\"></span> <a href=\"app_info?client_id=$client_id\" style=\"color: blue; text-decoration: none;\" title=\"" . $translations['Open data about'] . " $name\">$name</a> " . $translations['access will be granted to:'] . " <a href=\"app_info?client_id=$client_id\" style=\"color: blue; text-decoration: none;\" title=\"" . $translations['Domain name'] . "\"> $domain</a></h2>
 <div style=\"display: flex; justify-content: space-between;\">
   <button type=\"submit\" >Вход</button>
   <button type=\"button\" class=\"cancel-btn\" onclick=\"window.opener=null;window.close();\">Отмена</button>
</div>
</form>";
 }
 ?>

</body>
</html>