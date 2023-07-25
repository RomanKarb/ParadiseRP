<?php
if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $reason = $_POST['reason'];

    $command = '/ban ' . $username;
    if(!empty($reason)) {
        $command = '/ban ' . $username . ' ' . $reason;
    }

    // Отправка команды на сервер Minecraft
    $socket = fsockopen('localhost', 25636, $errorNo, $errorStr, 5);
    if ($socket !== false) {
        fwrite($socket, $command);
        fclose($socket);
        echo "Команда отправлена на сервер Minecraft.";
    } else {
        echo "Ошибка подключения к серверу Minecraft.";
    }
}
?>