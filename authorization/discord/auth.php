<meta charset="utf-8">
<style>
            body {
            background-image: url('/backround.png');
            background-repeat: no-repeat;
            background-size:cover;
            position: relative;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            z-index: -100;
            overflow-y: scroll;
        }
        body::-webkit-scrollbar {
      width: 10px;
      background: #bfad0d;
      z-index: -100000;
    }

    body::-webkit-scrollbar-thumb {
      background: white;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    body::-webkit-scrollbar-track {
      background: transparent;
      z-index: -100000; /* Добавляем этот стиль для задания z-index для фона полосы прокрутки */
    }
    form {
    width: 45vh;
    max-width: 550px;
    background: linear-gradient(to bottom right, #d6d6d6d2, #ffffffd2);
    border-radius: 25px;
    padding: 60px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.25);
}
h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 10px;
            margin-top: 10px;
            text-align: center;
        }
        button[type=submit] {
        font-size: 16px;
        padding: 10px 100px;
        border-radius: 3px;
        border: none;
        margin-bottom: 10px;
        width: 100%;
        background-color: #273748;
        color: #fff;
        transition: all 0.3s ease;
        cursor: pointer;
		border-radius: 10px;
        margin-top: 1px;
    }
    button[type=submit]:hover {
        background-color: black;
    }
    .header {
    left: 0px;
    position: fixed;
    top: 0;
    width: 100%;
    height: 60px;
    background-color: rgba(0, 0, 0, 0.7);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    z-index: 1000;
  }

  .header-content {
    margin-right: 25px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0px 5px;
    color: white;
    
  }
  .logo {
    margin-top: 5px;
    width: 70px;
    height: 50px;
    background-image: url('/logo.png');
    background-repeat: no-repeat;
    background-size:contain;
    cursor: pointer; /* добавляем стиль указателя при наведении */
  }

  h4 {
    left: 80px;
    position: absolute;
    font-size: 30px;
    font-family: Arial, Helvetica, sans-serif;
    cursor: pointer;
  }

  .buttons-head {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    width: calc(100% - 50px);
  }

  .button-head {
margin-left: 20px;
padding: 5px 30px;
border-radius: 30px;
border: 1px solid white;
background-color: transparent;
font-weight: bold;
text-decoration: none;
font-size: 16px;
background-image: linear-gradient(to right, lightgray, white);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
  }
  
  .button-head:hover {
    font-size: 19px;
  }
    </style>
<?php
$client_id = "1125801651459072110";
$client_secret = "Iyexn8iEDYCV6bOMX7ESc4qOX7SXQnyQ";
$redirect_uri = "http://www.izuminka.com/authorization/discord/auth.php";

$code = $_GET["code"];

// Запрос на обмен кода авторизации на токен
$url = "https://discord.com/api/oauth2/token";
$postData = array(
    "client_id" => $client_id,
    "client_secret" => $client_secret,
    "grant_type" => "authorization_code",
    "code" => $code,
    "redirect_uri" => $redirect_uri,
    "scope" => "identify"
);

$options = array(
    "http" => array(
        "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
        "method" => "POST",
        "content" => http_build_query($postData)
    )
);
$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

$result = json_decode($response, true);

// Обработка полученного токена
$access_token = $result["access_token"];

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'https://discord.com/api/v6/users/@me',
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer $access_token"
    ],
    CURLOPT_RETURNTRANSFER => true
]);

$response = curl_exec($ch);
$userData = json_decode($response, true);
curl_close($ch);

$username = $userData["username"];
$discriminator = $userData["discriminator"];
$email = $userData["email"];
$avatar = $userData["avatar"];
$userID = $userData["id"];
$nick = "$username#$discriminator";

// echo "Пользователь $username#$discriminator авторизован! Email: $email<br>";
// echo "Аватар: <img src='https://cdn.discordapp.com/avatars/$userID/$avatar' alt='Аватар'>";

// Подключение к базе данных MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LocalUsersTest";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Запрос для поиска строки
if ($nick != "#") {
    $sql = "SELECT * FROM users WHERE discord_nick = '$nick' OR discord_email = '$email'";
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Найдено совпадение
    while ($row = $result->fetch_assoc()) {
        echo "Найдена строка: " . $row["discord_nick"] . ", " . $row["discord_email"];
        $auth = $row["email"];
        echo $auth;

        setcookie("username_log_roshkam", $row['username'], time()+432000, '/');
        setcookie("id_log_roshkam", $row['id'], time()+432000, '/');
		setcookie("login_log_roshkam", $row["username"], time()+432000, '/');
		setcookie("password_log_roshkam", $row["password"], time()+432000, '/');
        header("Location: /authorization/login.php");
        // if(isset($_GET['redirect_url']) && !empty($_GET['redirect_url'])) {
            // $redirect_url = $_GET['redirect_url'];
            // $_SESSION['login_log_roshkam'] = $_COOKIE['login_log_roshkam'];
            // $_SESSION['password_log_roshkam'] = $_COOKIE['password_log_roshkam'];
            // header("Location: /authorization/login.php?redirect_url=$redirect_url");
        // } else {
            // $_SESSION['login_log_roshkam'] = $_COOKIE['login_log_roshkam'];
            // $_SESSION['password_log_roshkam'] = $_COOKIE['password_log_roshkam'];
            // header("Location: /authorization/dashboard.php");
        // }
    }
} else {
    echo '<form action="/authorization/login">
    <h2>Профиль не был найден, но вы можете зарегистрироваться через Discord или привязать его в своем личном кабинете</h2>
    <button type="submit">Войти</button>
    </form>';
    
    setcookie("username_log_roshkam", $row['username'], time()-432000);
    setcookie("id_log_roshkam", $row['id'], time()-432000);
    setcookie("login_log_roshkam", $row["username"], time()-432000);
    setcookie("password_log_roshkam", $row["password"], time()-432000);
}

$conn->close();
} else {
header('Location: /authorization/login');
}
?>
<div class="header">
    <div class="header-content">
      <div class="logo"></div>
      <h4>ParadiseRP</h4>
      <div class="buttons-head">
        <a href="#" class="button-head">Донат</a>
        <a href="#" class="button-head">Информация</a>
        <!-- <a href="javascript:history.back()" class="button-head">Вернуться</a> -->
      </div>
    </div>
  </div>
  <script>
    document.querySelector('.logo').addEventListener('click', function() {
      location.href = '/index.php'; // перенаправление на site copy.php при клике на логотип
    });
    document.querySelector('h4').addEventListener('click', function() {
      location.href = '/index.php'; // перенаправление на site copy.php при клике на логотип
    });
  </script>