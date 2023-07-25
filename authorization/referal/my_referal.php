<?php
// Получение значения GET-параметра "player"
$player = $_GET['player'];

// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LocalUsersTest";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Поиск строки в таблице по значению player
$sql = "SELECT * FROM users WHERE nickname = '$player'";
$result = $conn->query($sql);

// Проверка наличия строки с указанным player
if ($result->num_rows == 0) {
    echo "Вы не зарегистрированы на сайте, зарегистрироваться можно написав команду /paradiserp web register";
} else {
    // Получение данных строки
    $row = $result->fetch_assoc();

    // Поиск значения my_referal_id
    if ($row['my_referal_id'] == null) {
        echo "У вас нет реферального кода, наверное вы не состоите в реферальной программе, но вы можете попасть туда введя команду /paradiserp web referal_register";
    } else {
        // Поиск значения get_prize
        if ($row['get_prize'] == null) {
            echo "Ваш реферальный код: " . $row['my_referal_id'] . ", а чтобы получать вознаграждения, введите команду /paradiserp web give_prize";
        } else {
            echo "Ваш реферальный код: " . $row['my_referal_id'] . ", и ваш код для получения награды: для безопасности код скрыт, но вы можете посмотреть его на сайте серез команду /paradiserp web give_prize";
            //  . $row['get_prize'];
        }
    }
}

$conn->close();
?>