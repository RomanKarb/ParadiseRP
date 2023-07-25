<?php
  if (isset($_POST['submit'])) { // если форма отправлена
    $user_input = $_POST['input-text'];
    setcookie("user_input1", $user_input, time()+10); // сохраняем данные в cookie на 1 час
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Cookie</title>
  </head>
  <body>
    <?php if (isset($_COOKIE['user_input1'])) { // если cookie существует ?>
      <p>Данные из cookie1: <?php echo $_COOKIE['user_input1']; ?></p>
    <?php } ?>
    <form method="post">
      <label for="input-text">Введите данные:</label>
      <input type="text" name="input-text">
      <input type="submit" name="submit" value="Сохранить">
    </form>
  </body>
</html>