<?php
if(isset($_GET['lang'])) {
    $user_language = $_GET['lang'];
} else {
$user_language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}

$lang_file = $user_language . ".lang";
if (file_exists($lang_file)) {

} else {
    #echo "Language Error";
    echo "<script>alert('Перевод для языка \"$user_language\" не найден, будет использован Русский язык - \"ru\"')</script>";
    $user_language = "ru";
    $translations = parse_ini_file("ru.lang");
}

if ($user_language == "ru") {
    $translations = parse_ini_file('ru.lang');
  } elseif ($user_language == "en") {
    $translations = parse_ini_file('en.lang');
  } elseif ($user_language == "zh") {
    $translations = parse_ini_file('zh.lang');
  } elseif ($user_language == "de") {
    $translations = parse_ini_file('de.lang');
	} elseif ($user_language == "ja") {
    $translations = parse_ini_file('ja.lang');
	} elseif ($user_language == "uk") {
    $translations = parse_ini_file('uk.lang');
  } else {
    $translations = parse_ini_file('ru.lang');
  }

  $config_ini = $translations['Current_INI_Lang'];
  ?>