<?php
error_reporting(E_ALL & ~E_WARNING);
require_once 'Rcon.php';
use Thedudeguy\Rcon;
try {

$code = $_GET["code"];
$nick = $_GET["player"];

// echo "Код: $code ";
// echo "User: $player";

if(isset($_GET["code"]) && $_GET["code"] !== "") {
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
        $sql_referals = "SELECT * FROM users WHERE connect_referal_user = '$my_referal_id' AND use_referal = 0 AND activate = 1";
        $result_referals = $conn->query($sql_referals);

        if ($result_referals->num_rows > 0) {
            $result_referals_count = $result_referals->num_rows;

            // echo "Команда: $command_diamond";
            // Устанавливаем параметры подключения RCON
            $host = '127.0.0.1'; // Адрес сервера Minecraft
            $port = 25636; // Порт RCON сервера Minecraft
            $password_rcon = '280BE99A7C9CD689E8'; // Пароль RCON

            

            $con = new Rcon($host, $port, $password_rcon, 3); // Создаем новое соединение, где 3 - таймаут соединения в секундах

            if ($con->connect()) {
// Если найдены строки с приглашенными пользователями

// Замена значения 'use_referal' на 1 в найденных строках
$sql_update = "UPDATE users SET use_referal = 1 WHERE connect_referal_user = '$my_referal_id' AND use_referal = 0 AND activate = 1";
$conn->query($sql_update);

// Расчет количества замененных строк
$count_give = $result_referals->num_rows * 10;

// Составление команды
$command_diamond = "give $nick diamond $count_give";

// echo "Количество замененных строк: " . $result_referals->num_rows . "<br>";
echo "Сейчас вам будет выдано вознаграждение (алмазы) в количестве: $count_give, за количество приглашенных и активированных людей: " . $result_referals_count;

                $con->sendCommand($command_diamond); // Отправляем команду на сервер
                $response = $con->getResponse(); // Получаем ответ от сервера
                $con->disconnect(); // Закрываем соединение с сервером
                $uniq = uniqid() . "_";
                $uniq = uniqid("$uniq", true);
                $sql_update = "UPDATE users SET get_prize = DEFAULT WHERE nickname = '$nick'";
                $conn->query($sql_update);
                echo ' Вознаграждение успешно выдано для: ' . $nick;
            } else {
                echo"Ошибка подключения, пожалуйста обратитесь к администрации и предоставьте им ваш код: '$code'";
            }
        } else {
            // Если не найдены строки с приглашенными пользователями
            echo "У вас нет приглашенных пользователей, или вы уже получили награду";
        }
    } else {
        // Если не найден 'my_referal_id'
        echo "У вас нет реферального кода";
    }
} else {
    // Если не найдена строка с указанным кодом в столбце 'get_prize'
    echo "Не верно указан код: '$code', если код указан верно, то попробуйте обновить его на сайте";
}

// Закрытие соединения с базой данных
$conn->close();
} else {
    echo "Ошибка, был отправлен пустой запрос, если вы не шли против системы, то обратитесь к администрации сервера";
}
} catch (Throwable $e) {
}
?>