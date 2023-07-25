<?php

$clientId = '51696476';
$clientSecret = 'LrDLg05USfqEHRgrXyTg';
$redirectUrl = 'http://www.izuminka.com/authorization/vk/auth.php';

// Проверяем, был ли пользователь авторизован ранее
if (!isset($_GET['code'])) {
    // Перенаправляем пользователя на страницу авторизации VK
    $authUrl = 'https://oauth.vk.com/authorize?' . http_build_query([
        'client_id' => $clientId,
        'redirect_uri' => $redirectUrl,
        'response_type' => 'code',
        'v' => '5.130', // Версия API VK
        'scope' => 'email' // Запрашиваем доступ к email
    ]);
    header('Location: ' . $authUrl);
    exit;
}

// Получаем код авторизации от VK
$code = $_GET['code'];

// Запрашиваем access_token у VK
$tokenUrl = 'https://oauth.vk.com/access_token';
$tokenParams = [
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'redirect_uri' => $redirectUrl,
    'code' => $code
];
$tokenResponse = json_decode(file_get_contents($tokenUrl . '?' . http_build_query($tokenParams)), true);

// Проверяем, получен ли access_token
if (isset($tokenResponse['access_token'])) {
    // Получаем информацию о пользователе
    $userInfoUrl = 'https://api.vk.com/method/users.get?' . http_build_query([
        'access_token' => $tokenResponse['access_token'],
        'v' => '5.130', // Версия API VK
        'fields' => 'screen_name,email' // Запрашиваем имя пользователя и email
    ]);
    $userInfoResponse = json_decode(file_get_contents($userInfoUrl), true);

    // Проверяем, удалось ли получить информацию о пользователе
    if (isset($userInfoResponse['response'][0])) {
        $user = $userInfoResponse['response'][0];

        // Выполняем необходимые действия с информацией о пользователе
        echo "Имя пользователя: " . $user['first_name'] . "<br>";
        echo "Фамилия пользователя: " . $user['last_name'] . "<br>";
        echo "Username пользователя: " . $user['screen_name'] . "<br>";
        echo "Email пользователя: " . $user['email'] . "<br>";
    } else {
        echo "Не удалось получить информацию о пользователе";
    }
} else {
    echo "Не удалось получить access_token";
}

?>