<?php
require_once('detect_lang.php');
  
  echo "<button>" . $translations['Test Language'] . ": " . $translations['Current_INI_Lang']  . "</button>";
  // загрузка ini-файла

// вывод параметров на экран
foreach($translations as $key => $value) {
  echo "<br><br><h>$key: $value</h>";
}
  ?>
  <title><?php echo $translations['Test Language'] ?>