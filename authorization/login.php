<script>
console.log('DEBUGGER MODE - ON');
fetch('_DEBUGGER_.php');
</script>
<?php
session_start();
require_once('detect_lang.php');
require_once('theme.php');
echo "<script>
console.log(\"%cЕСЛИ ВЫ ГДЕ-ТО УСЛЫШАЛИ ЧТО САЙТ МОЖНО ВЗЛОМАТЬ... ЭТО ЗВИЗДЕШЬ, Я ROSHKAM, ЛИЧНО ДЕЛАЮ САЙТ 3 МЕСЯЦА\", \"font-size: 50px\");
</script>";

if(isset($_GET['username'])) {
    $value = 'value="' . $_GET['username'] . '"';
} else {
    if(isset($_GET['login'])) {
        $value = 'value="' . $_GET['login'] . '"';
    }
}

if(isset($_GET['password'])) {
    $value_pass = 'value="' . $_GET['password'] . '"';
} else {
    if(isset($_POST['password'])) {
        $value_pass = 'value="' . $_POST['password'] . '"';
    }
}

if(isset($_GET['clear_sessions'])) {
    if(isset($_GET['redirect_url'])) {
        $red_url = $_GET['redirect_url'];
        $redirect_url = "?redirect_url=$red_url";
    } else {
        $redirect_url = "";
    }
    session_start();
    unset($_SESSION['login_log_roshkam']);
    setcookie("username_log_roshkam", $row['username'], time()-432000, '/');
    setcookie("id_log_roshkam", $row['id'], time()-432000, '/');
    setcookie("login_log_roshkam", $username, time()-432000, '/');
    setcookie("password_log_roshkam", $password, time()-432000, '/');
    unset($_SESSION['password_log_roshkam']);
	header("Location: login.php$redirect_url"); 

} else { 
    if(isset($_COOKIE['login_log_roshkam']) && isset($_COOKIE['password_log_roshkam'])) {
    $_SESSION['login_log_roshkam'] = $_COOKIE['login_log_roshkam'];
    $_SESSION['password_log_roshkam'] = $_COOKIE['password_log_roshkam'];
    $login = $_COOKIE['login_log_roshkam'];
    $password = $_COOKIE['password_log_roshkam'];
	
	    // выполним запрос MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "LocalUsersTest";

    // Создание соединения
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Выполним запрос, чтобы получить open_id пользователя по его логину
    $sql = "SELECT open_id FROM users WHERE username = '$login'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Если пользователь найден, добавляем open_id в URL
        $row = $result->fetch_assoc();
        $open_id = $row["open_id"];
    } else {
        echo "Пользователь не найден";
		header("Location: messages.php?message=Пользователь \"$login\" не найден!&color=red&color_form=white&title=Пользователь не найден!");
        $conn->close();
        exit();
    }
    


    if(isset($_GET['redirect_url'])) {
        $_SESSION['login_log_roshkam'] = $_COOKIE['login_log_roshkam'];
        $_SESSION['password_log_roshkam'] = $_COOKIE['password_log_roshkam'];
        $redirect_url_1 = $_GET['redirect_url'];
		$redirect_url = $_GET['redirect_url'];

        // проверяем, что URL является валидным
        if(filter_var($redirect_url, FILTER_VALIDATE_URL)) {
            $url_components = parse_url($redirect_url);
            $query_string = isset($url_components['query']) ? $url_components['query'] : '';
            $redirect_url = $url_components['scheme'] . '://' . $url_components['host'] . $url_components['path'];

if(isset($_GET['disable_auth'])) {
} else {
// добавляем логин и open_id к запросу
if(!empty($query_string)) {
    $query_string .= '&login=' . urlencode($login) . '&open_id=' . urlencode($open_id);
} else {
    $query_string = 'login=' . urlencode($login) . '&open_id=' . urlencode($open_id);
}
}

            // отправляем GET запрос
            $_SESSION['login_log_roshkam'] = $_COOKIE['login_log_roshkam'];
            $_SESSION['password_log_roshkam'] = $_COOKIE['password_log_roshkam'];
            header('Location: ' . $redirect_url . '?' . $query_string);
        } else {
            $_SESSION['login_log_roshkam'] = $_COOKIE['login_log_roshkam'];
            $_SESSION['password_log_roshkam'] = $_COOKIE['password_log_roshkam'];
            echo 'Неправильный URL';
			header("Location: messages.php?message=Неправильный Redirect URL \"$redirect_url\"&color=red&color_form=white&title=Неправильный URL");
        }
    } else {
        $_SESSION['login_log_roshkam'] = $_COOKIE['login_log_roshkam'];
        $_SESSION['password_log_roshkam'] = $_COOKIE['password_log_roshkam'];
        header('Location: dashboard.php');
    }
}
} #else {
    // перенаправляем на страницу входа
    #$redirect_url = isset($_GET['redirect_url']) ? $_GET['redirect_url'] : '';
    #header('Location: http://base.roservers.com/authorization/login.php?redirect_url=' . urlencode($redirect_url));
#}

#$lang = $_GET['lang'];
#if($lang == 'en'){
#    include('en.lang.php');
#}else{
#    include('ru.lang.php');
#}
// if(isset($_GET['redirect_url'])) {
    // $redirect_discord_url = $_GET['redirect_url'];
    // $redirect_discord = "https://discord.com/api/oauth2/authorize?client_id=1125801651459072110&redirect_uri=http://www.izuminka.com/authorization/discord/auth.php?redirect_url=$redirect_discord_url&response_type=code&scope=identify%20email%20connections";
// } else {
    // $redirect_discord = "https://discord.com/api/oauth2/authorize?client_id=1125801651459072110&redirect_uri=http://www.izuminka.com/authorization/discord/auth.php&response_type=code&scope=identify%20email%20connections";
// }
?>
<!DOCTYPE html>
<html lang="<?php echo $user_language ?>">
<head>
    <meta charset="utf-8">
    <title><?php echo $translations['login'] ?> - ParadiseRP</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'rel='stylesheet' type='text/css'>
    <?php include 'css/login-password.php'; ?>
    <script>
        function openFile() {
            window.location.href = "register<?php 
    if(isset($_GET['redirect_url'])) {
      $redirect_url = $_GET['redirect_url'];
    echo "?redirect_url=" . $redirect_url; }
    ?>";
        }
    </script>
    <!-- У shield.land -->
    <meta data-n-head="ssr" name="viewport" content="width=device-width, initial-scale=0.5">
    <meta data-n-head="ssr" data-hid="og:title" property="og:title" content="ParadiseRP">
    <meta data-n-head="ssr" data-hid="og:image" property="og:image" content="https://media.shield.land/other/og_image.png">
    <meta data-n-head="ssr" data-hid="description" name="description" content="ParadiseRP, это уникальный сервер Minecraft, посвященный Minecraft и сделан всего-лишь двумя лучшими друзьями">
    <meta data-n-head="ssr" data-hid="og:description" property="og:description" content="ParadiseRP, это уникальный сервер Minecraft, посвященный Minecraft и сделан всего-лишь двумя лучшими друзьями">
    <meta data-n-head="ssr" name="format-detection" content="telephone=no">
    <link data-n-head="ssr" rel="icon" type="image/x-icon" href="/logo.png">
    <link rel="shortcut icon" href="/logo.png" type="image/png">
	<!-- <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script> -->
</head>
<body>
    <?php include 'header.php'; ?>
    <form action="log.php?redirect_url=<?php echo $_GET['redirect_url']; ?>" method="post" onsubmit="return validateCaptcha()">
        <h2><?php echo $translations['login'] ?></h2>
        <div class="form-group">
            <p for="username"><?php echo $translations['Username, email'] ?>:</p>
            <input type="text" <?php echo $value ?> id="username" name="username" placeholder="<?php echo $translations['Username, email'] ?>" required>
        </div>
        <div class="form-group-1">
            <p for="password"><?php echo $translations['Password'] ?>:</p>
            <input type="password" <?php echo $value_pass ?> id="password" name="password" placeholder="<?php echo $translations['Password'] ?>" required>
        </div>
        <div class="form-group">
            <a href="reset_password<?php 
            if(isset($_GET['redirect_url'])) {
                $redirect_url = $_GET['redirect_url'];
                echo "?redirect_url=" . $redirect_url;
            }
            ?>"><?php echo $translations['Forgot password'] ?></a>
        </div>
        <button type="submit" name="login" id="loginButton"><?php echo $translations['Log in'] ?></button>
        <div class="g-recaptcha" data-sitekey="6LdGfSonAAAAAHkhqSolPi5Bp34MyyjW-7Xyn-OZ"></div>
        <div class="div-discord-group" style="cursor: pointer;">
            <div class="div-discord" onclick="location.href = '<?php #echo $redirect_discord; ?>https://discord.com/api/oauth2/authorize?client_id=1125801651459072110&redirect_uri=http://www.izuminka.com/authorization/discord/auth.php&response_type=code&scope=identify%20email%20connections'" style="cursor: pointer;">
                <img src="/img/discord-icon.png" alt="Discord icon" class="discord-icon">
                <span class="span-discord"><?php echo $translations['Log in via'] ?> Discord</span>
            </div>
        </div>
        <div class="div-discord-group" style="cursor: pointer;">
            <div class="div-discord" onclick="location.href = '<?php #echo $redirect_discord; ?>/authorization/vk/auth.php'" style="cursor: pointer;">
                <img src="/img/vk-icon.png" alt="VK ID icon" class="vk-icon">
                <span class="span-discord"><?php echo $translations['Log in via'] ?> VK ID</span>
            </div>
        </div>
        <div class="form-group">
            <div class="centered-div">
                <h5><?php echo $translations['Not registered yet?'] ?></h5>
                <h6 onclick="openFile()"><?php echo $translations['Registration'] ?></h6>
            </div>
        </div>
    </form>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function validateCaptcha() {
            if (grecaptcha.getResponse().length === 0) {
                alert('<?php echo $translations['Enter captcha'] ?>.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>