<head>
<meta charset="utf-8">
</head>
<?php
require_once('db_config.php');
if(isset($_GET['sucssecsful_register'])) {
    $sql = "INSERT INTO users (username, email, f_name, s_name, password, reset_key, reset_key_used, logo, open_id, nickname, UUID, level_admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssss", $username, $email, $f_name, $s_name, $password, $reset_key, $reset_key_used, $logo, $open_id, $_COOKIE['minecraft_nickname'], $UUID, $level_admin);
    $stmt->execute();

    if ($stmt->error) {
        echo "Ошибка: " . $stmt->error;
    } else {
#referal
        if(isset($_COOKIE['referal_pre_reg'])) {
            $referal_pre_reg = $_COOKIE['referal_pre_reg'];
            $sql = "UPDATE users SET connect_referal_user='$referal_pre_reg' WHERE username='$username'";
    
            if ($conn->query($sql) === TRUE) {
                // echo "Данные в столбце bio для пользователя $username успешно обновлены";
                #header("Location: dashboard.php?username=$username");
                } else {
                echo "Ошибка при обновлении данных: " . $conn->error;
                }
       
           if ($stmt->error) {
               echo "Ошибка: " . $stmt->error;
           } else {
               #header("Location: dashboard.php?username=$username");
           }
        }
                    // удаляем данные из сессии
                    echo "<style>
                    h2 {
                        text-align: center;
                    }
                    </style>
                    <h2></h2>";

                    unset($_SESSION['email']);
                    unset($_SESSION['f_name']);
                    unset($_SESSION['s_name']);
                    unset($_SESSION['password']);
                    unset($_SESSION['code']);
    
    setcookie("referal_pre_reg", "", time()-6600);
    setcookie("email_pre_reg", "", time()-3600);
    setcookie("login_pre_reg", "", time()-3600);
    setcookie("first_name_pre_reg", "", time()-3600);
    setcookie("last_name_pre_reg", "", time()-3600);
    setcookie("password_pre_reg", "", time()-3600);
    setcookie("code_pre_reg", "", time()-3600);
    setcookie("minecraft_UUID", "", time()-100000);

    echo "<script>window.location.href = \"reg.php?sur=true&username=$username\";</script>";
        header("Location: reg.php?sur=true&username=$username");
        // exit();

    }
} else {
    echo "Попробуйте зарегистрироваться заново";
}
?>