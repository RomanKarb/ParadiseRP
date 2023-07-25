<?php
// Получаем язык браузера пользователя
if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $lang_detect = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}

// Получаем язык по умолчанию (например, если язык пользователя не определен)
$lang_default = 'en';

// Определение языка пользователя
switch ($lang_detect) {
    case 'ru':
        $lang_use = 'ru';
        break;
    case 'de':
        $lang_use = 'de';
        break;
    default:
        $lang_use = $lang_default;
        break;
}

// Подключаем файл с переводами
require_once('lang/'.$lang_use.'.lang');
?>