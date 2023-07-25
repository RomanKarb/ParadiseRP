<?php
$message = $_GET['message'];
$message2 = $_GET['message2'];
$color = $_GET['color'];
$color_form = $_GET['color_form'];
$title = $_GET['title'];
$button_text = $_GET['button_text'];
$action = $_GET['action'];
$action2 = $_GET['action2'];
if(isset($_GET['action2'])) {
$action_q = "?";
}

  if(isset($_GET['button'])) {
    $button = $_GET['button'];
  } else {
    $button = "hidden";
  }
  
    if(isset($_GET['message2'])) {
    $message2 = $_GET['message2'];
  } else {
    $message2 = "hidden";

  }

  require_once('theme.php');
  include 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
 <title><?php echo $title ?></title>
 <meta charset="UTF-8">
 <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'rel='stylesheet' type='text/css'>
 <style>
        body {
            background-image: url('/backround.png');
            background-repeat: no-repeat;
            background-size:cover;
            position: relative;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            z-index: -100;
            overflow-y: scroll;
        }
        body::-webkit-scrollbar {
      width: 10px;
      background: #bfad0d;
      z-index: -100000;
    }

    body::-webkit-scrollbar-thumb {
      background: white;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    body::-webkit-scrollbar-track {
      background: transparent;
      z-index: -100000; /* Добавляем этот стиль для задания z-index для фона полосы прокрутки */
    }
        form {
    width: 45vh;
    max-width: 550px;
    background: <?php echo $used_theme['form-background'] ?>;
    border-radius: 25px;
    padding: 60px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.25);
}
        h2 {
            color: <?php echo $color ?>;
            font-size: 24px;
            margin-bottom: 20px;
			text-align: center;
        }
    input[type=text] {
        font-size: 22px;
        padding: 10px 20px;
        border-radius: 3px;
        border: 1px solid #ddd; /* добавляем серую рамку */
        margin-bottom: 10px;
        width: calc(100% - 42px); /* вычитаем размер кнопки */
        background-color: #f2f2f2;
		border-radius: 10px;
    }
    input[type=submit] {
        font-size: 16px;
        padding: 10px 100px;
        border-radius: 3px;
        border: none;
        margin-bottom: 10px;
        width: 100%;
        background-color: #2c3e50;
        color: #fff;
        transition: all 0.3s ease;
        cursor: pointer;
		border-radius: 10px;
    }
    input[type=submit]:hover {
        background-color: #3498db;
    }
 </style>
    <script>
    function copyToClipboard(element) {
      element.select();
      document.execCommand("copy");
    }
  </script>
</head>
<body>
<form method="post" action="<?php echo $action;?><?php echo $action_q;?><?php echo $action2;?>">
	<h2><?php echo $message ?></h2>
	<input <?php echo $message2 ?> readonly onclick="copyToClipboard(this)" type="text"  value="<?php echo $message2 ?>"></input>
	<input <?php echo $button ?> type="submit" value="<?php echo $button_text ?>"></input>
</form>
</body>