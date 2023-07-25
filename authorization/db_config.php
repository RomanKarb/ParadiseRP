<?php
// Соединение с базой данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LocalUsersTest";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Проверка соединения
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>