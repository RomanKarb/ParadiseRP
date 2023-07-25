<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// отправляем письмо с кодом на почту
        require $_SERVER['DOCUMENT_ROOT'].'/authorization/PHPMailer/Exception.php';
        require $_SERVER['DOCUMENT_ROOT'].'/authorization/PHPMailer/PHPMailer.php';
        require $_SERVER['DOCUMENT_ROOT'].'/authorization/PHPMailer/SMTP.php';
		require $_SERVER['DOCUMENT_ROOT'].'/authorization/PHPMailer/DSNConfigurator.php';
		require $_SERVER['DOCUMENT_ROOT'].'/authorization/PHPMailer/POP3.php';
		
    $mail = new PHPMailer;
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
    $code = rand(100000, 999999);
	$mail->isHTML(true);
    $mail->Subject = 'Код подтверждения';
    $mail->Body = "<!DOCTYPE html>
    <html>
    <head>
        <meta charset=\"utf-8\">
        <title>Почтовое письмо</title>
        <style>
            body {
                background-image: url(http://c9242780.beget.tech/backround.png);
                background-repeat: no-repeat;
                background-size: cover;
                font-family: Arial, sans-serif;
                max-height: 700px;
                align-items: center;
                border-radius: 20px;
            }
            
            .container {
                text-align: center;
                margin: 0 auto;
                font-size: 25px;
            }
            
            h2 {
                font-size: 50px;
                color: rgba(0, 0, 0, 0.75);
            }

            h3 {
                font-size: 50px;
                text-align: center;
                margin-bottom: 200px;
                color: rgba(0, 0, 0, 0.75);
            }
    
            .footer {
                text-align: center;
                font-size: 16px;
                margin-top: 200px;
            }

            p {
                font-size: 30px;
                text-align: center;
                color: rgba(0, 0, 0, 0.75); 
            }

            form {

                margin-left: calc(50% - 335px);
    width: 900px;
    max-width: 670px;
    background: white;
    border-radius: 25px;
    padding: 60px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.75);
}
        </style>
    </head>
    <body>
        <h3>ParadiseRP</h3>
        <!-- <form> -->
        <div class=\"container\">
            <h1>Введите этот код на сайте:</h1>
            <h2>Код: $code</h2>
        </div>
    <!-- </form> -->
        <div class=\"footer\">
            <p>Сайт: www.ParadiseRP.fun, все права принадлежат \"Snr_RoSHkam\" и \"SnrKryak\"</p>
        </div>
    </body>
    </html>";
    if (!$mail->send()) {
        echo "Ошибка при отправке письма: " . $mail->ErrorInfo;
		header("Location: messages.php?message=Ошибка при отправке письма: . $mail->ErrorInfo &color=red&color_form=white&title=Ошибка при отправке письма");
        die();
    }
	
	$password_safe = password_hash($password, PASSWORD_DEFAULT);
    // сохраняем данные в сессии;
    session_start();
    setcookie("login_pre_reg", $login, time()+3600);
    setcookie("email_pre_reg", $email, time()+3600);
    setcookie("first_name_pre_reg", $first_name, time()+3600);
    setcookie("last_name_pre_reg", $last_name, time()+3600);
    setcookie("password_pre_reg", $password_safe, time()+3600);
    setcookie("code_pre_reg", $code, time()+3600);

    // перенаправляем на страницу ввода кода
    header('Location: enter_code.php');
    exit;
    ?>