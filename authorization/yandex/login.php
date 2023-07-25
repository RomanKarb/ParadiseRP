<?php
// Установка параметров
$clientId = 'ae43a399109e4957a3c6fa129a67c561';
$clientSecret = '66474b61b09f446c87dc1a903cf3d122';
$redirectUri = 'http://www.izuminka.com/authorization/yandex/login.php';

// Проверка, был ли отправлен запрос на авторизацию
if (isset($_GET['code'])) {
    // Параметры запроса на получение токена
    $params = [
        'grant_type' => 'authorization_code',
        'code' => $_GET['code'],
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'redirect_uri' => $redirectUri,
    ];

    // Отправка запроса на получение токена
    $url = 'https://oauth.yandex.ru/token';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    $responseData = json_decode($response, true);
    curl_close($curl);

    // Получение данных о пользователе
    $url = 'https://login.yandex.ru/info?format=json';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $responseData['access_token'],
    ]);
    $response = curl_exec($curl);
    $userData = json_decode($response, true);
    curl_close($curl);

    // Вывод данных о пользователе
    echo 'Никнейм: ' . $userData['login'] . '<br>';
    echo 'Почта: ' . $userData['default_email'] . '<br>';
    echo 'Аватар: <img src="' . $userData['default_avatar_id'] . '">';
} else {
    // Перенаправление на страницу авторизации Яндекс ID
    $url = 'https://oauth.yandex.ru/authorize?response_type=code&client_id=' . $clientId . '&redirect_uri=' . urlencode($redirectUri);
    header('Location: ' . $url);
    exit;
}
?>