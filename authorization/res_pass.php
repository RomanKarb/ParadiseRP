<!DOCTYPE html>
<html>
<head>
 <title>Регистрация</title>
 <meta charset="UTF-8">
 <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'rel='stylesheet' type='text/css'>
 <style>
    body {
        background: linear-gradient(to bottom right, #3498db, #2c3e50);
        font-family: Arial, sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        margin: 0;
        color: #000000;
    }
    form {
        width: 100%;
        max-width: 400px;
        background-color: #fff;
        border-radius: 25px;
        padding: 60px;
        box-shadow: 0px 0px 10px rgba(0,0,0,0.25);
    }
        h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
			text-align: center;
        }
    input[type=text] {
        font-size: 12px;
        padding: 10px 20px;
        border-radius: 3px;
        border: 1px solid #ddd; /* добавляем серую рамку */
        margin-bottom: 10px;
        width: calc(100% - 42px); /* вычитаем размер кнопки */
        background-color: #f2f2f2;
		border-radius: 10px;
    }
    input[type=password],
    input[type=email] {
        display: block;
        width: calc(100% - 42px); /* вычитаем размер кнопки */
        padding: 10px 20px;
        font-size: 16px;
        color: #555;
        border: 1px solid #ddd;
        border-radius: 3px;
        margin-bottom: 10px;
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
</head>
<body>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

	if(isset($_GET['redirect_url'])) {
		$redirect_url = $_GET['redirect_url'];
        $on_red_url = "&redirect_url=$redirect_url";
	echo "&redirect_url=" . $redirect_url; }
		
// подключаем файл с настройками базы данных
require_once('db_config.php');

if (isset($_POST['reset_password'])) {
    $email = $_POST['email'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Генерация уникального ключа для восстановления пароля
        $key = uniqid();
        $sql = "UPDATE users SET reset_key='$key', reset_key_used=0 WHERE email='$email'";
        mysqli_query($conn, $sql);

        // Отправка письма на указанный email со ссылкой на скрипт восстановления
        $message = "Для восстановления пароля перейдите по ссылке: http://base.roservers.com/authorization/new_password.php?key=$key&email=$email";
		
        require $_SERVER['DOCUMENT_ROOT'].'/authorization/PHPMailer/Exception.php';
        require $_SERVER['DOCUMENT_ROOT'].'/authorization/PHPMailer/PHPMailer.php';
        require $_SERVER['DOCUMENT_ROOT'].'/authorization/PHPMailer/SMTP.php';
		require $_SERVER['DOCUMENT_ROOT'].'/authorization/PHPMailer/DSNConfigurator.php';
		require $_SERVER['DOCUMENT_ROOT'].'/authorization/PHPMailer/POP3.php';
		
        $mail = new PHPMailer(true);

        try {
            //Настройки SMTP-сервера Yandex
			$mail->CharSet = "UTF-8";
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.yandex.ru';
            $mail->SMTPAuth = true;
            $mail->Username = 'roshkamun@yandex.ru';
            $mail->Password = 'gakcnnxsxkrhgfxj';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            //Отправка письма
            $mail->setFrom('roshkamun@yandex.ru', 'Поддержка Basedata');
            $mail->addAddress($email); //email получателя
            $mail->isHTML(true);
            $mail->Subject = 'Восстановление пароля';
            $mail->Body = "<!DOCTYPE html>
<html>
<head>
 <title>HTML Email</title>
 <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'rel='stylesheet' type='text/css'>
 <style>
  body {
   margin: 0;
   padding: 0;
   background: linear-gradient(to bottom, #4CC2E4, #0B4E92);
  }

  .container {
   width: 100%;
   max-width: 600px;
   margin: 0 auto;
   padding: 40px 20px;
   text-align: center;
  }
      form {
        width: 100%;
        max-width: 400px;
        background-color: #fff;
        border-radius: 25px;
        padding: 60px;
        box-shadow: 0px 0px 10px rgba(0,0,0,0.25);
    }
	
	        button[type=submit] {
            background-color: #2c3e50;
            color: #fff;
            transition: all 0.3s ease;
            cursor: pointer;
			        border-radius: 10px;
        }
        button[type=submit]:hover {
            background-color: #3498db;
        }

  h1, p {
   color: #fff;
   margin: 0;
   padding: 0;
  }

  h1 {
   font-size: 36px;
   margin-bottom: 20px;
  }
    A, p {
   color: #FFEFBA;
   margin: 0;
   padding: 0;
   text-decoration: none
  }

  A {
   font-size: 30px;
   margin-bottom: 20px;
   text-decoration: none
  }

  p {
   font-size: 18px;
   margin-bottom: 40px;
   color: white;
  }
 </style>
</head>
<body>
 <div class=container>
 <form>
  <h1>Для восстановления пароля перейдите по ссылке: </h1>
  <A HREF = http://base.roservers.com/authorization/new_password.php?key=$key&email=$email>ПЕРЕЙТИ</A>
  </form>
 </div>
</body>
</html>";
            $mail->send();

            echo "<form>
			<h2>Письмо с инструкцией отправлено на указанную почту!</h2>
			</form>";
			header("Location: messages.php?message=Письмо с инструкцией отправлено на указанную почту&button=&button_text=Войти&color_form=white&title=Письмо с инструкцией отправлено&action=login.php?username=$email" . $on_red_url);
        } catch (Exception $e) {
            echo "<form>
			<h2>Ошибка при отправке письма: {$mail->ErrorInfo}</h2>
			</form>";
			# echo $message;
        }
    } else {
	header("Location: messages.php?message=Пользователь с почтой: $email не найден!&color=red&color_form=white&title=Пользователь не найден!"); }
	
}
?>