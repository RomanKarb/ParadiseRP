<?php
// Устанавливаем параметры подключения RCON
$host = '127.0.0.1'; // Адрес сервера Minecraft
$port = 25636; // Порт RCON сервера Minecraft
$password = '280BE99A7C9CD689E8'; // Пароль RCON

// Получаем ник пользователя Minecraft из GET-запроса
$player = $_GET['player'];

// Формируем команду /ban
$command = '/ban ' . $player . ' 1d';

// Подключаемся к RCON серверу
$socket = @fsockopen($host, $port, $errno, $errstr, 2);
if (!$socket) {
    die('Не удалось подключиться к RCON серверу');
}

// Отправляем авторизационный запрос
fwrite($socket, pack('VV', 0, 3) . $password . "\x00\x00\x00\x00");

// Читаем ответ
$response = fread($socket, 4096);
if (substr($response, 8, 12) == pack('VV', 0, 2)) {
    // Отправляем команду /ban
    fwrite($socket, pack('VV', 0, 2) . $command . "\x00\x00\x00\x00");

    // Читаем ответ
    $response = fread($socket, 4096);
    if (substr($response, 8, 12) == pack('VV', 0, 2)) {
        echo 'Команда /ban успешно отправлена для игрока ' . $player;
    } else {
        echo 'Не удалось отправить команду /ban';
    }
} else {
    echo 'Ошибка авторизации RCON сервера';
}

// Закрываем соединение
fclose($socket);
?>