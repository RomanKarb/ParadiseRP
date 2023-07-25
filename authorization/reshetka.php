<?php

// Получаем текущий URL-адрес
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// Отделяем часть после символа '#'
$anchor = strstr($url, '#');

// Если якорь найден, выводим его значение
if (!empty($anchor)) {
   echo "Якорь: " . substr($anchor, 1);
}

// Отделяем часть перед символом '?'
$path = strstr($url, '?', true);

// Если путь не пустой, выводим его значение
if (!empty($path)) {
   echo "Путь: " . substr($path, strlen('http://' . $_SERVER['HTTP_HOST']));
}

// Получаем массив параметров из строки запроса
$params = $_GET;

// Если параметры найдены, выводим их значения
if (!empty($params)) {
   echo "Параметры: ";
   foreach ($params as $key => $value) {
     echo $key . " = " . $value . "; ";
   }
}

?>