<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('detect_lang.php');

if (isset($_POST['register'])) {
    // получаем данные из формы
    $login = $_POST['login'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];

    // проверяем, что пароли совпадают
    if ($password != $password_confirmation) {
        echo "Пароли не совпадают";
		header("Location: messages.php?message=Пароли не совпадают!&color=red&color_form=white&title=Пароли не совпадают");
        die();
    } else {

    if(isset($_COOKIE['email_pre_reg'])){
        $login_pre_reg = $_COOKIE['email_pre_reg'];
        if($login_pre_reg === $email){
            $password_safe = password_hash($password, PASSWORD_DEFAULT);
            // сохраняем данные в сессии;
            session_start();
            setcookie("login_pre_reg", $login, time()+3600);
            setcookie("email_pre_reg", $email, time()+3600);
            setcookie("first_name_pre_reg", $first_name, time()+3600);
            setcookie("last_name_pre_reg", $last_name, time()+3600);
            setcookie("password_pre_reg", $password_safe, time()+3600);
            setcookie("code_pre_reg", $code, time()+3600);
        
            // перенаправляем на страницу ввода кода
            header('Location: enter_code.php');
            exit;
        } else {
require_once('send_mail.php');
} 
} else {
    require_once('send_mail.php');
} 
    }
} else {
    echo "<title>400 - Ошибка выполнения кода</title>";
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $address = $_SERVER['SERVER_NAME'];
    $port = $_SERVER['SERVER_PORT'] !== '80' ? ":{$_SERVER['SERVER_PORT']}" : "";
    $path = $_SERVER['REQUEST_URI'];
    $fullUrl = "{$protocol}://{$address}{$port}{$path}";
    $url = 'http://www.izuminka.com/errors/400_space_1.php?url=' . urlencode($fullUrl) . '&error=' . urlencode("if(isset(\$_COOKIE[login_pre_reg])) " . $translations['therefore, try restarting the browser, then register again'] . "");
$content = file_get_contents($url);
echo $content;
}
?>