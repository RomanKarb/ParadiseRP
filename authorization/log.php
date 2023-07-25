<head>
<meta charset="utf-8">
</head>
<?php
    // $username = $_POST['username'];
    // $password_log = $_POST['password'];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверка капчи
    // if(isset($_GET['redirect_url'])) {
    // $redirect_url = $_GET['redirect_url'];
    // $redirect_url1 = "?u=$username&p=$password_log&redirect_url=$redirect_url";
    // } else {
        // $redirect_url1 = "?u=$username&p=$password_log";
    // }
    $captchaResponse = $_POST['g-recaptcha-response'];
    $secretKey = '6LdGfSonAAAAAA8-kk3yxZnqdQ998-2b5iv-hz2g';
    $ip = $_SERVER['REMOTE_ADDR'];


    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $secretKey,
        'response' => $captchaResponse,
        'remoteip' => $ip
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);

    if ($response['success']) {
        // Капча успешно проверена, выполнение входа пользователя
        // Ваш код для выполнения входа
        // header("Location: login.php$redirect_url1");
        session_start();
// Устанавливаем соединение с базой данных
require_once('db_config.php');

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $passord_log = $_POST['password'];
    $password_hash = password_hash($passord_log, PASSWORD_DEFAULT);
    $_SESSION['login_log_roshkam'] = $_COOKIE['login_log_roshkam'];
    $_SESSION['password_log_roshkam'] = $_COOKIE['password_log_roshkam'];

    $sql = "SELECT * FROM users WHERE username='$username' OR email='$username'";
    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
		$row = $result->fetch_assoc();
        $hash = $row["password"];
        $get_openid = $row["open_id"];
        $ip_user = $_SERVER['REMOTE_ADDR'];
        
        if (password_verify($passord_log, $hash)) {
		session_start();

        $sql1 = "SELECT * FROM active_seans WHERE ip='$ip_user'";
        $result1 = $conn->query($sql1);
    
        if (mysqli_num_rows($result1) > 0) {
            $sql2 = "DELETE FROM active_seans WHERE ip='$ip_user'";
            $result2 = $conn->query($sql2);            

        // 

        $uni0= uniqid('_auth_');
        $uni2= uniqid('token');
        $uni3= uniqid('_0_-_');
        $uni = $uni0 . $uni2 . $uni3;
        $encodedString0 = base64_encode($uni);
        $encodedString = base64_encode($encodedString0);
        echo $encodedString; // Выводит "SGVsbG8sIFdvcmxkIQ=="
        $sql1 = "INSERT INTO active_seans (password, openid, user, token, ip) VALUES ('$passord_log', '$get_openid', '$username', '$encodedString', '$ip_user')";

        // Выполняем запрос
if ($conn->query($sql1) === TRUE) {
    echo "Новая запись успешно добавлена в таблицу active_seans.";
	$expiryTime = time() + 259200;
	echo <<<JS
<script>
var name = "auth_token";
var text = "{$encodedString}";
var time = 259200; // время в секундах

var date = new Date();
date.setTime(date.getTime() + (time * 1000 * 1000)); // умножаем на 1000 для преобразования в миллисекунды
var expires = "expires=" + date.toUTCString();

document.cookie = name + "=" + text + ";" + expires + ";path=/";
</script>
JS;
    // setcookie("auth_token", $encodedString, $expiryTime);
	setcookie("auth_token", $encodedString, time()+3600);
} else {
    echo "Ошибка выполнения запроса: " . $conn->error;
}
        } else {
            $uni0= uniqid('_auth_');
            $uni2= uniqid('token');
            $uni3= uniqid('_0_-_');
            $uni = $uni0 . $uni2 . $uni3;
            $encodedString0 = base64_encode($uni);
            $encodedString = base64_encode($encodedString0);
            echo $encodedString; // Выводит "SGVsbG8sIFdvcmxkIQ=="
            $sql1 = "INSERT INTO active_seans (password, openid, user, token, ip) VALUES ('$passord_log', '$get_openid', '$username', '$encodedString', '$ip_user')";
    
            // Выполняем запрос
    if ($conn->query($sql1) === TRUE) {
        echo "Новая запись успешно добавлена в таблицу active_seans.";
		$expiryTime = time() + 259200;
		// setcookie("auth_token", $login, time()+3600);
		echo <<<JS
<script>
var name = "auth_token";
var text = "{$encodedString}";
var time = 259200; // время в секундах

var date = new Date();
date.setTime(date.getTime() + (time * 1000 * 1000)); // умножаем на 1000 для преобразования в миллисекунды
var expires = "expires=" + date.toUTCString();

document.cookie = name + "=" + text + ";" + expires + ";path=/";
</script>
JS;
        setcookie("auth_token", $encodedString, time()+3600);
    } else {
        echo "Ошибка выполнения запроса: " . $conn->error;
    }
        }

		// 

if(isset($_GET['redirect_url']) && !empty($_GET['redirect_url'])) {
    $redirect_url = $_GET['redirect_url'];
    $_SESSION['login_log_roshkam'] = $_COOKIE['login_log_roshkam'];
    $_SESSION['password_log_roshkam'] = $_COOKIE['password_log_roshkam'];
    header("Location: login.php?redirect_url=$redirect_url");
	echo "<script>window.location.href = \"login.php?redirect_url=$redirect_url\";</script>";
} else {
    $_SESSION['login_log_roshkam'] = $_COOKIE['login_log_roshkam'];
    $_SESSION['password_log_roshkam'] = $_COOKIE['password_log_roshkam'];
    header("Location: dashboard.php");
	echo "<script>window.location.href = \"dashboard.php\";</script>";
}
        } else {
            echo "<div class='alert alert-danger'>Не верный логин или пароль!</div>";
            // echo "hash: " . $hash . " just: " . $passord_log;
            header("Location: messages.php?message=Не верный логин или пароль!&color=red&color_form=white&title=Не верный логин или пароль!");
        }
    } else {
        echo "<div class='alert alert-danger'>Не верный логин или пароль!</div>";
		header("Location: messages.php?message=Не верный логин или пароль!&color=red&color_form=white&title=Не верный логин или пароль!");
    }
}
    } else {
        // Капча не прошла проверку, открытие login.php с POST параметром "Captcha error"
        $post_data = [
            'error' => 'Captcha error'
        ];
        $login_url = 'login.php?' . http_build_query($post_data);
        header('Location: ' . $login_url);
		setcookie("auth_token", $encodedString, time()+3600);
		echo "<script>window.location.href = \"$login_url\";</script>";
    }
}
?>