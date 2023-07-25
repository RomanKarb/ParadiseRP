<?php

// Получаем значение параметра player из GET-запроса
if(isset($_GET['player'])) {
    $player = $_GET['player'];

    // Подключаемся к базе данных MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "LocalUsersTest";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверяем соединение с базой данных
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ищем строку с данным никнеймом (player) в столбце nickname
    $sql = "SELECT * FROM users WHERE nickname = '$player'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Проверяем наличие поля my_referal_id
            if(isset($row['my_referal_id'])) {
                // Ищем строки, где connect_referal_user = my_referal_id
                $referalID = $row['my_referal_id'];
                $sql_referals = "SELECT * FROM users WHERE connect_referal_user = '$referalID' AND use_referal = 0";
                $result_referals = $conn->query($sql_referals);
                $total_referals = $result_referals->num_rows;

                // Подсчитываем количество активных рефералов (activate = 1)
                $sql_active_referals = "SELECT COUNT(*) AS active_referals FROM users WHERE connect_referal_user = '$referalID' AND activate = 1 AND use_referal = 0";
                $result_active_referals = $conn->query($sql_active_referals);
                $row_active_referals = $result_active_referals->fetch_assoc();
                $active_referals = $row_active_referals['active_referals'];

                echo "У вас: $total_referals рефералов, из них: $active_referals активированы и вы можете получить за них вознаграждения. Ваши рефералы: ";

                // Выводим никнеймы и состояние активации рефералов
                while($row_referals = $result_referals->fetch_assoc()) {
                    $nickname = ($row_referals['nickname'] != "") ? $row_referals['nickname'] : "User";
                    $activation_status = ($row_referals['activate'] == 1) ? "Активирован" : "Не активирован";
                    echo "{$nickname} ({$activation_status}), ";
                }

                $sql1_referals = "SELECT * FROM users WHERE connect_referal_user = '$referalID' AND use_referal = 1";
                $result1_referals = $conn->query($sql1_referals);
                while($row_referals1 = $result1_referals->fetch_assoc()) {
                    $nickname1 = ($row_referals1['nickname'] != "") ? $row_referals1['nickname'] : "User";
                    echo "{$nickname1} (Награда получена), ";
                }
            } else {
                echo "У вас нет реферального кода, наверное вы не состоите в реферальной программе, но вы можете попасть туда введя команду /paradiserp web referal_register";
            }
        }
    } else {
        echo "Вы не зарегистрированы на сайте, зарегестрироваться можно по на сайте, или же, у вас не привязан ваш игровой профиль к сайту, для привязки вы можете ввести команду /paradiserp set_nick (ваш логин от сайта) (ваш пароль от сайта), или через личный кабинет на сайте";
    }

    // Закрываем соединение с базой данных
    $conn->close();
}

?>