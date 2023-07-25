<?php
session_start();
// Устанавливаем соединение с базой данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LocalUsersTest";
$redirect_url = $_GET['redirect_url'];

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['login'])) {
    $username = $_GET['username'];
    $passord_log = $_GET['password'];
    $password_hash = password_hash($passord_log, PASSWORD_DEFAULT);
    $_SESSION['login_log_roshkam'] = $_COOKIE['login_log_roshkam'];
    $_SESSION['password_log_roshkam'] = $_COOKIE['password_log_roshkam'];

    $sql = "SELECT * FROM users WHERE username='$username' OR email='$username'";
    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
		$row = $result->fetch_assoc();
        $hash = $row["password"];
        
        if (password_verify($passord_log, $hash)) {
		session_start();
        setcookie("username_log_roshkam", $row['username'], time()+432000, '/');
        setcookie("id_log_roshkam", $row['id'], time()+432000, '/');
		setcookie("login_log_roshkam", $username, time()+432000, '/');
		setcookie("password_log_roshkam", $password, time()+432000, '/');
        $_SESSION['login_log_roshkam'] = $_COOKIE['login_log_roshkam'];
        $_SESSION['password_log_roshkam'] = $_COOKIE['password_log_roshkam'];
		
if(isset($_GET['redirect_url']) && !empty($_GET['redirect_url'])) {
    $redirect_url = $_GET['redirect_url'];
    $_SESSION['login_log_roshkam'] = $_COOKIE['login_log_roshkam'];
    $_SESSION['password_log_roshkam'] = $_COOKIE['password_log_roshkam'];
    header("Location: login.php?redirect_url=$redirect_url");
} else {
    $_SESSION['login_log_roshkam'] = $_COOKIE['login_log_roshkam'];
    $_SESSION['password_log_roshkam'] = $_COOKIE['password_log_roshkam'];
    header("Location: dashboard.php");
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
?>