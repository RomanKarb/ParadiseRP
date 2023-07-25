<?php
// Подключение к базе данных MySQL
$servername = "localhost";
$username = "пользователь";
$password = "пароль";
$dbname = "имя_базы_данных";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Получение хэша пароля из базы данных
$user_id = 1; // Идентификатор пользователя
$sql = "SELECT password FROM users WHERE id = $user_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hash = $row["password"];
} else {
    echo "Пользователь не найден!";
    exit;
}

// Сравнение хэша пароля с обычным паролем
$password = "пароль"; // Обычный не хэшированный пароль
$password_hashed = password_hash($password, PASSWORD_DEFAULT); // Получение хэша пароля

if (password_verify($password, $hash)) {
    echo "Пароль верный!";
} else {
    echo "Пароль неверный!";
}

$conn->close();
?>