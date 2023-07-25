<!DOCTYPE html>
<html lang="<?php echo $user_language ?>">
<head>
    <meta charset="utf-8">

</head>
<body>
<?php
    // $username = $_POST['username'];
    // $password_log = $_POST['password'];
// if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверка капчи
    // if(isset($_GET['redirect_url'])) {
    // $redirect_url = $_GET['redirect_url'];
    // $redirect_url1 = "?u=$username&p=$password_log&redirect_url=$redirect_url";
    // } else {
        // $redirect_url1 = "?u=$username&p=$password_log";
    // }
    
    // captcha
    
    // $captchaResponse = $_POST['g-recaptcha-response'];
    // $secretKey = '6LdGfSonAAAAAA8-kk3yxZnqdQ998-2b5iv-hz2g';
    // $ip = $_SERVER['REMOTE_ADDR'];


    // $url = 'https://www.google.com/recaptcha/api/siteverify';
    // $data = [
        // 'secret' => $secretKey,
        // 'response' => $captchaResponse,
        // 'remoteip' => $ip
    // ];

    // $options = [
        // 'http' => [
            // 'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            // 'method' => 'POST',
            // 'content' => http_build_query($data)
        // ]
    // ];

    // $context = stream_context_create($options);
    // $result = file_get_contents($url, false, $context);
    // $response = json_decode($result, true);

    // if ($response['success']) {

require_once('db_config.php');
require_once('detect_lang.php');

// подключаем файл с настройками базы данных
if(isset($_COOKIE['login_pre_reg'])) {






if (isset($_GET['register'])) {

    if (isset($_GET['head-check'])) {
        if(isset($_GET['n'])) {
            $n = $_GET['n'];
        echo '<title>' . $translations['Finish register'] . ' - ParadiseRP</title>';
        require_once('theme.php');
        include 'css/reg.php';
        include 'header.php';

        $image_path = '/authorization/heads/' . $n . '.png';
        echo '<form action="reg?register=true&sucssecsful_register=true" method="POST">
        <h2>' . $n . '</h2>
        <img src="' . $image_path . '">
        <button type="submit">' . $translations['Confirm'] . '</button>';
        } else {
            echo "error";
        }
    }

    if (isset($_GET['sn'])) {
         require_once('theme.php');
         include 'css/reg.php';
         include 'header.php';
        if (isset($_GET['egh'])) {
            $egh = "<h3>" . $_COOKIE['minecraft_nickname'] . $translations[': Player not found'] . "</h3>";
        } else {
            $egh = "";
        }

        
        echo '<title>' . $translations['Finish register'] . ' - ParadiseRP</title>';
        
echo '<form action="reg.php?register=true&check_skin=true" method="POST">
' . $egh .
'<h2>' . $translations['Enter your nickname from Minecraft'] . '</h2>
<input type="text1" name="nick" required></input>
<button type="submit" name="check_skin">' . $translations['Check'] . '</button>
<button type="submit" name="NOT_NICK">' . $translations['Continue without checking'] . '</button>';
    }
// 
    if (isset($_GET['check_skin'])) {

        $nickname = $_POST['nick'];
        session_start();
        $_SESSION['minecraft_nickname'] = $nickname;
		echo <<<JS
<script>
var name = "minecraft_nickname";
var text = "{$nickname}";
var time = 10000; // время в секундах

var date = new Date();
date.setTime(date.getTime() + (time * 1000 * 1000)); // умножаем на 1000 для преобразования в миллисекунды
var expires = "expires=" + date.toUTCString();

document.cookie = name + "=" + text + ";" + expires + ";path=/";
</script>
JS;
        setcookie("minecraft_nickname", $nickname, time()+10000);

        if (!isset($_POST['NOT_NICK'])) {
$url = 'https://api.mojang.com/users/profiles/minecraft/' . $nickname;

$response = @file_get_contents($url);
sleep(1); // задержка в 1 секунду
if ($response) {
  $data = json_decode($response);
  if (isset($data->id)) {



    // Функция для получения UUID по никнейму
    function getUUID($nickname) {
        $url = "https://api.ashcon.app/mojang/v2/user/" . urlencode($nickname);
        $data = file_get_contents($url);
        $data = json_decode($data, true);
        return $data["uuid"];
    }
    
    // Функция для сохранения головы в файл
    function saveHeadToFile($uuid, $filename) {
        // $url = "https://crafatar.com/renders/head/" . $uuid . "?default=MHF_Steve?default=MHF_Steve&overlay=";
        $url = "https://crafatar.com/avatars/" . $uuid . "?default=MHF_Steve?default=MHF_Steve&overlay=";
        $imageData = file_get_contents($url);
        file_put_contents($filename, $imageData);
    }
    
    // Получаем UUID игрока
    $uuid = getUUID($nickname);
			echo <<<JS
<script>
var name = "minecraft_UUID";
var text = "{$uuid}";
var time = 10000; // время в секундах

var date = new Date();
date.setTime(date.getTime() + (time * 1000 * 1000)); // умножаем на 1000 для преобразования в миллисекунды
var expires = "expires=" + date.toUTCString();

document.cookie = name + "=" + text + ";" + expires + ";path=/";
</script>
JS;
    setcookie("minecraft_UUID", $uuid, time()+10000);
    
    // Сохраняем голову в файл
    $filename = "heads/" . $nickname . ".png";
    saveHeadToFile($uuid, $filename);
    echo "<script>window.location.href = \"reg?register=true&head-check=true&n=$nickname\";</script>";



  } else {
    echo $data;
    $url = 'https://api.mojang.com/users/profiles/minecraft/' . $nickname;

$response = @file_get_contents($url);
sleep(1); // задержка в 1 секунду
if ($response) {
  $data = json_decode($response);
  if (isset($data->id)) {



    // Функция для получения UUID по никнейму
    function getUUID($nickname) {
        $url = "https://api.ashcon.app/mojang/v2/user/" . urlencode($nickname);
        $data = file_get_contents($url);
        $data = json_decode($data, true);
        return $data["uuid"];
    }
    
    // Функция для сохранения головы в файл
    function saveHeadToFile($uuid, $filename) {
        // $url = "https://crafatar.com/renders/head/" . $uuid . "?default=MHF_Steve?default=MHF_Steve&overlay=";
        $url = "https://crafatar.com/avatars/" . $uuid . "?default=MHF_Steve?default=MHF_Steve&overlay=";
        $imageData = file_get_contents($url);
        file_put_contents($filename, $imageData);
    }
    
    // Получаем UUID игрока
    $uuid = getUUID($nickname);
	echo <<<JS
<script>
var name = "minecraft_UUID";
var text = "{$uuid}";
var time = 10000; // время в секундах

var date = new Date();
date.setTime(date.getTime() + (time * 1000 * 1000)); // умножаем на 1000 для преобразования в миллисекунды
var expires = "expires=" + date.toUTCString();

document.cookie = name + "=" + text + ";" + expires + ";path=/";
</script>
JS;
    setcookie("minecraft_UUID", $uuid, time()+100000);
    
    // Сохраняем голову в файл
    $filename = "heads/" . $nickname . ".png";
    saveHeadToFile($uuid, $filename);
    echo "<script>window.location.href = \"reg?register=true&head-check=true&n=$nickname\";</script>";



  } else {
    echo $data;
    header("Location: reg?register=true&sn=true&egh=true&error=$data");
  }
} else {
    echo $data;
    header("Location: reg?register=true&sn=true&egh=true&error=$data");
}
  }
} else {
    echo $data;
    $url = 'https://api.mojang.com/users/profiles/minecraft/' . $nickname;

$response = @file_get_contents($url);
sleep(1); // задержка в 1 секунду
if ($response) {
  $data = json_decode($response);
  if (isset($data->id)) {



    // Функция для получения UUID по никнейму
    function getUUID($nickname) {
        $url = "https://api.ashcon.app/mojang/v2/user/" . urlencode($nickname);
        $data = file_get_contents($url);
        $data = json_decode($data, true);
        return $data["uuid"];
    }
    
    // Функция для сохранения головы в файл
    function saveHeadToFile($uuid, $filename) {
        // $url = "https://crafatar.com/renders/head/" . $uuid . "?default=MHF_Steve?default=MHF_Steve&overlay=";
        $url = "https://crafatar.com/avatars/" . $uuid . "?default=MHF_Steve?default=MHF_Steve&overlay=";
        $imageData = file_get_contents($url);
        file_put_contents($filename, $imageData);
    }
    
    // Получаем UUID игрока
    $uuid = getUUID($nickname);
	echo <<<JS
<script>
var name = "minecraft_UUID";
var text = "{$uuid}";
var time = 10000; // время в секундах

var date = new Date();
date.setTime(date.getTime() + (time * 1000 * 1000)); // умножаем на 1000 для преобразования в миллисекунды
var expires = "expires=" + date.toUTCString();

document.cookie = name + "=" + text + ";" + expires + ";path=/";
</script>
JS;
    setcookie("minecraft_UUID", $uuid, time()+100000);
    
    // Сохраняем голову в файл
    $filename = "heads/" . $nickname . ".png";
    saveHeadToFile($uuid, $filename);
    echo "<script>window.location.href = \"reg?register=true&head-check=true&n=$nickname\";</script>";



  } else {
    echo $data;
    header("Location: reg?register=true&sn=true&egh=true&error=$data");
	echo "<script>window.location.href = \"reg?register=true&sn=true&egh=true&error=$data\";</script>";
  }
} else {
    echo $data;
    header("Location: reg?register=true&sn=true&egh=true&error=$data");
	echo "<script>window.location.href = \"reg?register=true&sn=true&egh=true&error=$data\";</script>";
}
}

    } else {
        header("Location: reg?register=true&sucssecsful_register=true");
		echo "<script>window.location.href = \"reg?register=true&sn=true&egh=true&error=$data\";</script>";
    }
} 
// 


$username = $_COOKIE['login_pre_reg'];
$email = $_COOKIE['email_pre_reg'];
$f_name = $_COOKIE['first_name_pre_reg'];
$s_name = $_COOKIE['last_name_pre_reg'];
$password = $_COOKIE['password_pre_reg'];
$reset_key = uniqid();
$reset_key_used = "0";
$logo = "sys_files/---default_logo---.png";
$open_id = rand(10000000, 99999999);
$UUID = $_COOKIE['minecraft_UUID'];
$level_admin = "0";

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
    
    echo <<<JS
<script>
var name = "minecraft_UUID";
var text = "";
var time = -100000; // время в секундах

var date = new Date();
date.setTime(date.getTime() + (-100000000000)); // умножаем на 1000 для преобразования в миллисекунды
var expires = "expires=" + date.toUTCString();

document.cookie = name + "=" + text + ";" + expires + ";path=/";
</script>
JS;
    echo <<<JS
<script>
var name = "code_pre_reg";
var text = "";
var time = -3600; // время в секундах

var date = new Date();
date.setTime(date.getTime() + (time * 1000 * 1000)); // умножаем на 1000 для преобразования в миллисекунды
var expires = "expires=" + date.toUTCString();

document.cookie = name + "=" + text + ";" + expires + ";path=/";
</script>
JS;
echo <<<JS
<script>
var name = "password_pre_reg";
var text = "";
var time = -3600; // время в секундах

var date = new Date();
date.setTime(date.getTime() + (-3600000000)); // умножаем на 1000 для преобразования в миллисекунды
var expires = "expires=" + date.toUTCString();

document.cookie = name + "=" + text + ";" + expires + ";path=/";
</script>
JS;
echo <<<JS
<script>
var name = "last_name_pre_reg";
var text = "";
var time = -100000; // время в секундах

var date = new Date();
date.setTime(date.getTime() + (-3600000000)); // умножаем на 1000 для преобразования в миллисекунды
var expires = "expires=" + date.toUTCString();

document.cookie = name + "=" + text + ";" + expires + ";path=/";
</script>
JS;
echo <<<JS
<script>
var name = "first_name_pre_reg";
var text = "";
var time = -100000; // время в секундах

var date = new Date();
date.setTime(date.getTime() + (-3600000000)); // умножаем на 1000 для преобразования в миллисекунды
var expires = "expires=" + date.toUTCString();

document.cookie = name + "=" + text + ";" + expires + ";path=/";
</script>
JS;

    echo "<script>window.location.href = \"reg.php?sur=true&username=$username\";</script>";
        // header("Location: reg?sur=true&username=$username");
        // exit();

    }
}




    
if (isset($_GET['confirm'])) {
    // проверяем код
    if ($_POST['code'] != $_COOKIE['code_pre_reg']) {
        header("Location: messages.php?message=Не верный код&color=red&color_form=white&title=Не верный код");
        die();
    }

    $username = $_COOKIE['login_pre_reg'];
    $email = $_COOKIE['email_pre_reg'];
    $f_name = $_COOKIE['first_name_pre_reg'];
    $s_name = $_COOKIE['last_name_pre_reg'];
    $password = $_COOKIE['password_pre_reg'];
    $reset_key = uniqid();
	$reset_key_used = "0";
	$logo = "sys_files/---default_logo---.png";
	$open_id = rand(10000000, 99999999);
	
		// проверяем, что username не существует в базе данных
	
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    header("Location: messages.php?message=Пользователь с таким логином уже существует&color=red&color_form=white&title=Пользователь с таким логином уже существует");
    die();
}

	// проверяем, что email не существует в базе данных
	
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    header("Location: messages.php?message=Пользователь с такой почтой уже существует&color=red&color_form=white&title=Пользователь с такой почтой уже существует");
    die();
}


if(isset($_COOKIE['referal_pre_reg'])) {
    $referal_pre_reg = $_COOKIE['referal_pre_reg'];
    $sql = "UPDATE users SET connect_referal_user='$referal_pre_reg' WHERE username='$username'";

    if ($conn->query($sql) === TRUE) {
        echo "Данные в столбце bio для пользователя $username успешно обновлены";
        #header("Location: dashboard.php?username=$username");
        } else {
        echo "Ошибка при обновлении данных в столбце bio: " . $conn->error;
        }

   if ($stmt->error) {
       echo "Ошибка: " . $stmt->error;
   } else {
       #header("Location: dashboard.php?username=$username");
   }
}
$conn->close();
echo "1";
echo '<script>window.location.href = "reg?register=true&sn=true&ALARM=PLEASE-DONT-CHANGE-URL-BECAUSE-REGISTER-PROCESS-CRASH";</script>';
        header("Location: /authorization/reg?register=true&sn=true&ALARM=PLEASE-DONT-CHANGE-URL-BECAUSE-REGISTER-PROCESS-CRASH");
#$data = 'set_nickname';

#$options = array(
#    'http' => array(
#        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
#        'method'  => 'POST',
#        'content' => $data,
#    ),
#);

#$context  = stream_context_create($options);
#$result = file_get_contents($url, false, $context);

#if ($result === false) {
#    echo 'Ошибка при отправке запроса';
#} else {
#    echo 'Запрос успешно отправлен';
#}

    $stmt->close();

}
#echo "klk";


} elseif (isset($_GET['setting'])) {
	echo '
	<form>
	<h2>Завершите регистрацию</h2>
	<p>Введите код из письма</p>
	<input type="text" name="logo">
	<p>Описание</p>
	<textarea type="text" name="bio" maxlength="1000"></textarea>
	<button type="submit1" name="next">Пропустить</button>
	<button type="submit" name="finish">Завершить</button>
</form>';


} elseif (isset($_GET['next'])) {
	$username = $_COOKIE['login_pre_reg'];
	header("Location: dashboard.php?username=$username");
	#
	
	#
	
	#
	
	#ниже обработка формы завершения регистрации
	
} elseif (isset($_GET['finish'])) {
	$username = $_COOKIE['login_pre_reg'];
	$logo = $_GET['logo'];
	$bio = $_GET['bio'];
	
    // обновить данные в столбце logo для пользователя $username
	if (isset($_GET['logo'])) {
    $sql = "UPDATE users SET logo='$logo' WHERE username='$username'";
	if ($conn->query($sql) === TRUE) {
  echo "Данные в столбце logo для пользователя $username успешно обновлены";
  #header("Location: dashboard.php?username=$username");
} else {
  echo "Ошибка при обновлении данных в столбце logo: " . $conn->error;
}
	}
	if (isset($_GET['bio'])) {
		echo "Данные в столбце logo для пользователя $username успешно обновлены";
		 $sql = "UPDATE users SET logo='$bio' WHERE username='$username'";
	     if ($conn->query($sql) === TRUE) {
         echo "Данные в столбце bio для пользователя $username успешно обновлены";
         #header("Location: dashboard.php?username=$username");
         } else {
         echo "Ошибка при обновлении данных в столбце bio: " . $conn->error;
         }

    if ($stmt->error) {
        echo "Ошибка: " . $stmt->error;
    } else {
        #header("Location: dashboard.php?username=$username");
    }
}
    $conn->close();
	

} elseif (isset($_GET['sur'])) {
    $username = isset($_GET['username']) ? $_GET['username'] : '';
	echo '<title>' . $translations['Redirection...'] . ' - ParadiseRP</title>';
    echo '<style>
        h2 {
            margin-top: 200px;
            font-family: Arial, sans-serif;
            text-align: center;
        }
    </style>
    <h2>' . $translations['You are successfully registered, the transition will take place in'] . ' 3 ' . $translations['seconds'] . '</h2>';
    echo '<script>
        setTimeout(function(){
            document.querySelector("h2").innerHTML = "' . $translations['You are successfully registered, the transition will take place in'] . ' 2 ' . $translations['seconds'] . '";
            setTimeout(function(){
                document.querySelector("h2").innerHTML = "' . $translations['You are successfully registered, the transition will take place in'] . ' 1 ' . $translations['seconds'] . '";
                setTimeout(function(){
                    document.querySelector("h2").innerHTML = "' . $translations['Redirection...'] . '";
                    setTimeout(function(){
                        window.location.href = "login?username=' . $username . '";
                    }, 1000);
                }, 1000);
            }, 1000);
        }, 1000);
    </script>';
} else {
    echo "<title>400 - Ошибка выполнения кода</title>";
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $address = $_SERVER['SERVER_NAME'];
    $port = $_SERVER['SERVER_PORT'] !== '80' ? ":{$_SERVER['SERVER_PORT']}" : "";
    $path = $_SERVER['REQUEST_URI'];
    $fullUrl = "{$protocol}://{$address}{$port}{$path}";
    $url = 'http://base.roservers.com/errors/400_space_1.php?url=' . urlencode($fullUrl) . '&error=' . urlencode("Пустой запрос, попробуйте пройти регистрацию сначала");
    $content = file_get_contents($url);
    echo $content;
}
} elseif (isset($_GET['sur'])) {
    $username = isset($_GET['username']) ? $_GET['username'] : '';
	echo '<title>' . $translations['Redirection...'] . ' - ParadiseRP</title>';
    echo '<style>
        h2 {
            margin-top: 200px;
            font-family: Arial, sans-serif;
            text-align: center;
        }
    </style>
    <h2>' . $translations['You are successfully registered, the transition will take place in'] . ' 3 ' . $translations['seconds'] . '</h2>';
    echo '<script>
        setTimeout(function(){
            document.querySelector("h2").innerHTML = "' . $translations['You are successfully registered, the transition will take place in'] . ' 2 ' . $translations['seconds'] . '";
            setTimeout(function(){
                document.querySelector("h2").innerHTML = "' . $translations['You are successfully registered, the transition will take place in'] . ' 1 ' . $translations['seconds'] . '";
                setTimeout(function(){
                    document.querySelector("h2").innerHTML = "' . $translations['Redirection...'] . '";
                    setTimeout(function(){
                        window.location.href = "login?username=' . $username . '";
                    }, 1000);
                }, 1000);
            }, 1000);
        }, 1000);
    </script>';
} else {
    echo "<title>400 - Ошибка выполнения кода</title>";
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $address = $_SERVER['SERVER_NAME'];
    $port = $_SERVER['SERVER_PORT'] !== '80' ? ":{$_SERVER['SERVER_PORT']}" : "";
    $path = $_SERVER['REQUEST_URI'];
    $fullUrl = "{$protocol}://{$address}{$port}{$path}";
    $url = 'http://base.roservers.com/errors/400_space_1.php?url=' . urlencode($fullUrl) . '&error=' . urlencode("if(isset(\$_COOKIE[login_pre_reg])) поэтому попробуте перезапустить браузер, затем пройти регистрацию заново");
    $content = file_get_contents($url);
    echo $content;
}
// } else {
    // Капча не прошла проверку, открытие login.php с POST параметром "Captcha error"
    // $post_data = [
        // 'error' => 'Captcha error'
    // ];
    // $login_url = 'login.php?' . http_build_query($post_data);
    // header('Location: ' . $login_url);
// }
// }
?>
</html>
