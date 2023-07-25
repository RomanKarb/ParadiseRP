<!DOCTYPE html>
<html>
<head>
 <title>Выбор пользователя</title>
 <meta charset="UTF-8">
 <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'rel='stylesheet' type='text/css'>
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
<?php
session_start();

$redirect = $_GET['redirect_url'];
if(isset($_COOKIE['login_log_roshkam']) && isset($_COOKIE['password_log_roshkam'])) {
    $login = $_COOKIE['login_log_roshkam'];
    $password = $_COOKIE['password_log_roshkam'];
	$redirect = $_GET['redirect_url'];
	echo "<form>
	<h2>Войти как: $login<h2>
	<div style=\"display: flex; justify-content: space-between;\">
   <button type=\"button\" class=\"button\" onclick=\"window.location.href='http://base.roservers.com/authorization/login?redirect_url=$redirect'\">Вход</button>
   <button type=\"button\" class=\"cancel-btn\" onclick=\"window.location.href='http://base.roservers.com/authorization/login?clear_sessions=1&redirect_url=$redirect'\">Сменить</button>
   </div>
</form>";
} else {
	header("Location: http://base.roservers.com/authorization/login?redirect_url=$redirect");
}
   ?>