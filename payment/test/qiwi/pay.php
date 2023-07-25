<?php
// Подключение к API Qiwi
define('QIWI_TOKEN', 'fac0fe040d5fa876513a12da2961570d'); // Заменить на свой токен Qiwi

// Функция для создания платежа и получения ссылки для оплаты
function createQiwiPayment($amount) {
    // Получение текущего времени
    $currentTime = time();

    // Форматирование суммы в нужный формат
    $formattedAmount = number_format($amount, 2, '.', '');

    // Создание объекта платежа
    $paymentData = array(
        'amount' => array(
            'value' => $formattedAmount,
            'currency' => 'RUB'
        ),
        'expirationDateTime' => date('Y-m-d\TH:i:sP', $currentTime + 3600), // Платеж должен быть оплачен в течение 1 часа
        'comment' => 'Оплата на сайте',
        'customer' => array(
            'phone' => 'твой_номер_телефона' // Заменить на свой номер телефона в формате +79991234567
        )
    );

    // Отправка запроса на создание платежа
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.qiwi.com/partner/bill/v1/bills',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => json_encode($paymentData),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . QIWI_TOKEN,
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    // Обработка ответа
    $responseData = json_decode($response, true);

    // Если платеж успешно создан, получаем ссылку для оплаты
    if ($responseData && isset($responseData['payUrl'])) {
        return $responseData['payUrl'];
    }

    // Возвращаем null в случае ошибки
    return null;
}

// Пример использования функции
$paymentUrl = createQiwiPayment(100); // Заменить 100 на нужную сумму для оплаты
if ($paymentUrl) {
    echo 'Перейдите по ссылке для оплаты: <a href="' . $paymentUrl . '">Оплатить через Qiwi</a>';
} else {
    echo 'Ошибка при создании платежа';
}