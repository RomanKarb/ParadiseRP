<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Устанавливаем соединение с базой данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LocalUsersTest";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['reset_password'])) {
    $email = $_POST['email'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Генерация уникального ключа для восстановления пароля
        $key = uniqid();
        $sql = "UPDATE users SET reset_key='$key' WHERE email='$email'";
        mysqli_query($conn, $sql);

        // Отправка письма на указанный email со ссылкой на скрипт восстановления
        $message = "Для восстановления пароля перейдите по ссылке: example.com/example_script.php?key=$key&email=$email";
		
        require $_SERVER['DOCUMENT_ROOT'].'/authorization/PHPMailer/Exception.php';
        require $_SERVER['DOCUMENT_ROOT'].'/authorization/PHPMailer/PHPMailer.php';
        require $_SERVER['DOCUMENT_ROOT'].'/authorization/PHPMailer/SMTP.php';
		require $_SERVER['DOCUMENT_ROOT'].'/authorization/PHPMailer/DSNConfigurator.php';
		require $_SERVER['DOCUMENT_ROOT'].'/authorization/PHPMailer/POP3.php';
		
        $mail = new PHPMailer(true);

        try {
            //Настройки SMTP-сервера Gmail
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'romainkarbushev2007@gmail.com';
            $mail->Password = 'MamaPapa14';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Отправка письма
            $mail->setFrom('romainkarbushev2007@gmail.com', 'Роман Карбушев');
            $mail->addAddress($email); //email получателя
            $mail->isHTML(true);
            $mail->Subject = 'Восстановление пароля';
            $mail->Body = "Для восстановления пароля перейдите по ссылке: example.com/example_script.php?key=$key&email=$email";
            $mail->send();

            echo "<div class='alert alert-success'>Письмо с инструкциями отправлено на указанный email!</div>";
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Ошибка при отправке письма: {$mail->ErrorInfo}</div>";
        }
    }
}
?>