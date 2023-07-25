<?php
require_once 'Rcon.php';

$host = '127.0.0.1';
$port = 25636;
$password = '280BE99A7C9CD689E8';

$player = $_GET['player'];
$time = $_GET['time'];
$reason = $_GET['reason'];

$command = 'tempban ' . $player . ' ' . $time . ' ' . $reason;

use Thedudeguy\Rcon;

$con = new Rcon($host, $port, $password, 3); // Создаем новое соединение, где 3 - таймаут соединения в секундах

if ($con->connect()) {
    $con->sendCommand($command); // Отправляем команду на сервер
    $response = $con->getResponse(); // Получаем ответ от сервера
    $con->disconnect(); // Закрываем соединение с сервером
} else {
    die('Unable to connect to Rcon server');
}
?>