<?php
if(isset($_GET['lang'])) {
    $user_language = $_GET['lang'];
} else {
$user_language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}

$lang_file = "../../../lang/" . $user_language . ".lang";
if (file_exists($lang_file)) {

} else {
    #echo "Language Error";
    echo "<script>alert('Перевод для языка \"$user_language\" не найден, будет использован Русский язык - \"ru\"')</script>";
    $user_language = "ru";
    $translations = parse_ini_file("../../../lang/ru.lang");
}

if ($user_language == "ru") {
    $translations = parse_ini_file('../../../lang/ru.lang');
  } elseif ($user_language == "en") {
    $translations = parse_ini_file('../../../lang/en.lang');
  } elseif ($user_language == "de") {
    $translations = parse_ini_file('../../../lang/de.lang');
  } else {
    $translations = parse_ini_file('../../../lang/ru.lang');
  }

  $config_ini = $translations['Current_INI_Lang'];
  ?>