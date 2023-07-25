<meta charset="utf-8">
<?php
$client_id = "1125801651459072110";
$client_secret = "Iyexn8iEDYCV6bOMX7ESc4qOX7SXQnyQ";
$redirect_uri = "http://www.izuminka.com/discord.php";

$code = $_GET["code"];

// Запрос на обмен кода авторизации на токен
$url = "https://discord.com/api/oauth2/token";
$postData = array(
    "client_id" => $client_id,
    "client_secret" => $client_secret,
    "grant_type" => "authorization_code",
    "code" => $code,
    "redirect_uri" => $redirect_uri,
    "scope" => "identify"
);

$options = array(
    "http" => array(
        "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
        "method" => "POST",
        "content" => http_build_query($postData)
    )
);
$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

$result = json_decode($response, true);

// Обработка полученного токена
$access_token = $result["access_token"];

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'https://discord.com/api/v6/users/@me',
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer $access_token"
    ],
    CURLOPT_RETURNTRANSFER => true
]);

$response = curl_exec($ch);
$userData = json_decode($response, true);
curl_close($ch);

$username = $userData["username"];
$discriminator = $userData["discriminator"];
$email = $userData["email"];
$avatar = $userData["avatar"];
$userID = $userData["id"];

echo "Пользователь $username#$discriminator авторизован! Email: $email<br>";
echo "Аватар: <img src='https://cdn.discordapp.com/avatars/$userID/$avatar' alt='Аватар'>";
?>