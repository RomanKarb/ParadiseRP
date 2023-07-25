<?php
if(isset($_GET['lang'])) {
    $user_language = $_GET['lang'];
} else {
$user_language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}

$lang_file = $user_language . ".lang";
if (file_exists($lang_file)) {
$translations = parse_ini_file($user_language . '.lang');
} else {
    #echo "Language Error";
    echo "<script>alert('Перевод для языка \"$user_language\" не найден, будет использован Русский язык - \"ru\"')</script>";
    $user_language = "ru";
    $translations = parse_ini_file("ru.lang");
}

  $config_ini = $translations['Current_INI_Lang'];
  ?>