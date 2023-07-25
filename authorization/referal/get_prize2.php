<?php

$code = $_GET["code"];
$nick = $_GET["player"];

// echo "Код: $code ";
// echo "User: $player";

// Подключение к базе данных MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LocalUsersTest";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения к базе данных
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Поиск строки с соответствующим кодом в столбце 'get_prize'
$sql = "SELECT * FROM users WHERE get_prize = '$code'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Если найдена строка с указанным кодом

    // Поиск значения 'my_referal_id' в найденной строке
    while ($row = $result->fetch_assoc()) {
        $my_referal_id = $row['my_referal_id'];
    }

    // Если найден 'my_referal_id'
    if (isset($my_referal_id)) {
        // Поиск строк с соответствующим 'connect_referal_user' и 'use_referal' значениями
        $sql_referals = "SELECT * FROM users WHERE connect_referal_user = '$my_referal_id' AND use_referal = 0";
        $result_referals = $conn->query($sql_referals);

        if ($result_referals->num_rows > 0) {
            $result_referals_count = $result_referals->num_rows;

            // echo "Команда: $command_diamond";
            // Устанавливаем параметры подключения RCON
            $host = '127.0.0.1'; // Адрес сервера Minecraft
            $port = 25636; // Порт RCON сервера Minecraft
            $password_rcon = '280BE99A7C9CD689E8'; // Пароль RCON

            
            $socket = @fsockopen($host, $port, $errno, $errstr, 2);
            if (!$socket) {
                echo "Не удалось подключиться к RCON серверу, пожалуйста обратитесь к администрации и предоставьте им ваш код: $code";
            }

            // Отправляем авторизационный запрос
            fwrite($socket, pack('VV', 0, 3) . $password_rcon . "\x00\x00\x00\x00");

            // Читаем ответ
            $response = fread($socket, 4096);
            if (substr($response, 8, 12) == pack('VV', 0, 2)) {
// Составление команды
$command_diamond = "give $nick diamond $count_give";
                    // Отправляем команду /ban
                       fwrite($socket, pack('VV', 0, 2) . $command_diamond . "\x00\x00\x00\x00");
                           // Читаем ответ
    $response = fread($socket, 4096);
    if (substr($response, 8, 12) == pack('VV', 0, 2)) {

// Замена значения 'use_referal' на 1 в найденных строках
$sql_update = "UPDATE users SET use_referal = 1 WHERE connect_referal_user = '$my_referal_id' AND use_referal = 0";
$conn->query($sql_update);

// Расчет количества замененных строк
$count_give = $result_referals->num_rows * 10;

// echo "Количество замененных строк: " . $result_referals->num_rows . "<br>";
echo "Сейчас вам будет выдано вознаграждение (алмазы) в количестве: $count_give, за количество приглашенных людей: " . $result_referals_count;
echo ' Вознаграждение успешно выдано для: ' . $nick;

            } else {
                echo "Ошибка подключения, пожалуйста обратитесь к администрации и предоставьте им ваш код: $code";
            }
        } else {
            echo "Ошибка авторизации RCON сервера, пожалуйста обратитесь к администрации и предоставьте им ваш код: $code";
        }
        } else {
            // Если не найдены строки с приглашенными пользователями
            echo "У вас нет приглашенных пользователей";
        }
    } else {
        // Если не найден 'my_referal_id'
        echo "У вас нет реферального кода";
    }
} else {
    // Если не найдена строка с указанным кодом в столбце 'get_prize'
    echo "Не верный код";
}

// Закрытие соединения с базой данных
$conn->close();
?>