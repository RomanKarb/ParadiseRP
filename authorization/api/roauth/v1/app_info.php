<?php
require_once('detect_lang.php');
// устанавливаем соединение с базой данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LocalUsersTest";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// проверяем, что передан параметр client_id
if(isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];
    
    // выполняем запрос к базе данных
    $sql = "SELECT name, autor, email, description, domain, site FROM apps_roauth WHERE client_id = '$client_id'";
    $result = mysqli_query($conn, $sql);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
    // отображаем информацию из базы данных
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="<?php echo $user_language ?>">
<head>
 <title><?php echo $translations['Information about the application'] ?></title>
 <style>
        body {
            background: linear-gradient(to bottom right, #3498db, #2c3e50);
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
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
            margin-bottom: 0px;
            text-align: center;
        }
a {
            color: grey;
			text-decoration: none;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
 <form>
 <h2><?php echo $translations['Application name:'] ?></h2> 
 <a title="<?php echo $translations['Application name:'] ?>"><?php echo $row['name']; ?></a>
 <h2><?php echo $translations['Author of the application:'] ?></h2> 
 <a title="<?php echo $translations['Open profile:'] ?> <?php echo $row['autor']; ?>" href="http://base.roservers.com/authorization/dashboard.php?username=<?php echo $row['autor']; ?>"><?php echo $row['autor']; ?></a>
 <h2><?php echo $translations['Author email:'] ?></h2>
 <a title="<?php echo $translations['Write:'] ?> <?php echo $row['email']; ?>" href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a>
 <h2><?php echo $translations['Description:'] ?></h2>
 <a title="<?php echo $translations['Description:'] ?>"><?php echo $row['description']; ?></a>
 <h2><?php echo $translations['Domain name:'] ?></h2>
 <a title="<?php echo $translations['Domain name:'] ?>" ><?php echo $row['domain']; ?></a>
 <h2><?php echo $translations['Author website:'] ?></h2>
 <a title="<?php echo $translations['Author website:'] ?>" href="<?php         // проверяем, что URL является валидным
        if(filter_var($row['site'], FILTER_VALIDATE_URL)) {
            $url_components = parse_url($redirect_url);
            $query_string = isset($url_components['query']) ? $url_components['query'] : '';
            $redirect_url = $url_components['scheme'] . '://' . $url_components['host'] . $url_components['path'];
		    echo $redirect_url;
		}		?>"><?php echo $row['site']; ?></a>
 </form>
</body>
</html>
<?php
    } else {
        echo "Клиент с таким ID не найден";
		header("Location: messages.php?message=client_id \"$client_id\" не найден!&color=red&color_form=white&title=client_id не найден!");
    }
} else {
    $url1 = 'http://base.roservers.com/errors/404_space_1.css';
    $content1 = file_get_contents($url1);
    echo "<style>" . $content1 . "</style>";
    #echo "Не передан параметр client_id";
    echo "<title>400 - Ошибка выполнения кода</title>";
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $address = $_SERVER['SERVER_NAME'];
    $port = $_SERVER['SERVER_PORT'] !== '80' ? ":{$_SERVER['SERVER_PORT']}" : "";
    $path = $_SERVER['REQUEST_URI'];
    $fullUrl = "{$protocol}://{$address}{$port}{$path}";
    $url = 'http://base.roservers.com/errors/400_space_1.php?url=' . urlencode($fullUrl) . '&error=' . urlencode("Не передан параметр client_id");
    $content = file_get_contents($url);
    echo $content;
	#header("Location: messages.php?message=Не передан параметр client_id!&color=red&color_form=white&title=Не передан параметр client_id!");
}

mysqli_close($conn);
?>