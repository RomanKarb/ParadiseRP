<?php
// Никнейм игрока Minecraft
$nickname = "SnrKryak";

// Функция для получения UUID по никнейму
function getUUID($nickname) {
    $url = "https://api.ashcon.app/mojang/v2/user/" . urlencode($nickname);
    $data = file_get_contents($url);
    $data = json_decode($data, true);
    return $data["uuid"];
}

// Функция для сохранения головы в файл
function saveHeadToFile($uuid, $filename) {
    $url = "https://crafatar.com/renders/head/" . $uuid;
    $imageData = file_get_contents($url);
    file_put_contents($filename, $imageData);
}

// Получаем UUID игрока
$uuid = getUUID($nickname);

// Сохраняем голову в файл
$filename = $nickname . ".png";
saveHeadToFile($uuid, $filename);
?>