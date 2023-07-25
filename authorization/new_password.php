<?php
if (isset($_GET['key']) && isset($_GET['email'])) {
    echo '
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Новый пароль</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href=\'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800\'rel=\'stylesheet\' type=\'text/css\'>
    <style>
        body {
            background: linear-gradient(to bottom right, #3498db 30%, #2c3e50);
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #f8f9fa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 400px;
        }

        .card-header {
            background-color: #3498db;
            color: #fff;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #2c3e50;
            border-color: #2c3e50;
        }

        .btn-primary:hover {
            background-color: #34495e
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Новый пароль
            </div>
            <div class="card-body">
            '; 
                    // подключаем файл с настройками базы данных
                    require_once('db_config.php');

                    // Код только здесь пошел
                    if (isset($_GET['key']) && isset($_GET['email'])) {
                        $key = $_GET['key'];
                        $email = $_GET['email'];

                        $sql = "SELECT * FROM users WHERE email='$email' AND reset_key='$key'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $user = mysqli_fetch_assoc($result);
                            if ($user['reset_key_used'] == 0) {
                                echo '<form action="" method="post">
                                        <div class="form-group">
                                            <label for="password">Новый пароль:</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">Подтвердите пароль:</label>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="change_password">Изменить пароль</button>
                                    </form>';
                            } else {
                                echo "<div class='alert alert-danger text-center'>Ссылка на восстановление пароля уже использована!</div>";
								header("Location: messages.php?message=Ссылка на восстановление пароля уже использована&color=red&color_form=white&title=Ссылка уже использована");
                            }
                        } else {
                            echo "<div class='alert alert-danger text-center'>Ссылка для восстановления пароля указана не верна!</div>";
							header("Location: messages.php?message=Ссылка для восстановления пароля указана не верна&color=red&color_form=white&title=Ссылка не верна");
                        }
                    }

                    // после изменения пароля обновляем значение reset_key_used
                    if (isset($_POST['change_password'])) {
                        // проверяем, что ссылка еще не использована 
                        $key = $_GET['key'];
                        $email = $_GET['email'];
    $sql = "SELECT * FROM users WHERE email='$email' AND reset_key='$key' AND reset_key_used=0";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password != $confirm_password) {
            echo "<div class='alert alert-danger'>Пароли не совпадают!</div>";
			header("Location: messages.php?message=Пароли не совпадают&color=red&color_form=white&title=Пароли не совпадают");
        } else {
			$password_safe = md5 ($password);
			$key_new = uniqid();
            $sql = "UPDATE users SET password='$password_safe', reset_key='$key_new', reset_key_used=1 WHERE email='$email'";
            mysqli_query($conn, $sql);
            echo "<div class='alert alert-success'>Пароль успешно изменен!</div>";
			header("Location: messages.php?message=Пароль успешно изменен&action=login.php?username=$email&color=green&color_form=white&button=1&button_text=Войти&title=Пароль успешно изменен");
        }
    } else {
        #echo "Ссылка на восстановление пароля уже использована!";
		header("Location: messages.php?message=Ссылка на восстановление пароля уже использована&color=red&color_form=white&title=Ссылка уже использована");
    }
}
} else {
    echo "<title>400 - Ошибка выполнения кода</title>";
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $address = $_SERVER['SERVER_NAME'];
    $port = $_SERVER['SERVER_PORT'] !== '80' ? ":{$_SERVER['SERVER_PORT']}" : "";
    $path = $_SERVER['REQUEST_URI'];
    $fullUrl = "{$protocol}://{$address}{$port}{$path}";
    $url = 'http://base.roservers.com/errors/400_space_1.php?url=' . urlencode($fullUrl) . '&error=' . urlencode("if (isset(\$_GET['key']) && isset(\$_GET['email']))  поэтому попробуте повторно сбросить пароль");
$content = file_get_contents($url);
echo $content;
}

?>