<?php
if(isset($_GET['theme'])) {
    $user_theme = $_GET['theme'];
} else {
    if(isset($_COOKIE['theme_roauth_full'])) {
        $user_theme = $_COOKIE['theme_roauth_full'];
    } else {
        $user_theme = "light";
    }
}

$theme_file = "theme/" . $user_theme . ".theme";
if (file_exists($theme_file)) {
    $used_theme = parse_ini_file('theme/' . $user_theme . '.theme');
} else {
    #echo "Language Error";
    #echo "<script>alert('Перевод для языка \"$user_language\" не найден, будет использован Русский язык - \"ru\"')</script>";
    #$user_language = "ru";
    $used_theme = parse_ini_file('theme/' . $user_theme . '.theme');
    #$translations = parse_ini_file("../theme/ru.lang");
}

$theme_config_ini = $used_theme['Theme-Path'];
    ?>