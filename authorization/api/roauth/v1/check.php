<?php 
session_start();
if(isset($_COOKIE['login_log_roshkam']) && isset($_COOKIE['password_log_roshkam'])) {
    $redirect_url = $_GET['redirect_url'];
    $login = $_COOKIE['login_log_roshkam'];
    $password = $_COOKIE['password_log_roshkam'];
header("Location: http://base.roservers.com/authorization/login.php?redirect_url=$redirect_url");
}
else {
    $redirect_url = urlencode($_GET['redirect_url']);
    header("Location: http://base.roservers.com/authorization/login.php?redirect_url=$redirect_url");
}
?>