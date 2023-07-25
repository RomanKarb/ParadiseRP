<?php
$pay_date = date("Y-m-d H:i:s"); // Получаем дату и время
$pay_status = "pending"; // Устанавливаем стандартный статус платежа

$connection = mysqli_connect('localhost', 'root', '', 'LocalUsersTest') or die(mysqli_error($connection)); // Подключаемся к базе данных

require __DIR__ . '/lib/autoload.php';
use YooKassa\Client;
$client = new Client();
$client->setAuth('228687', 'test_HL2yFdOJdK1HZe7zhoJ-yWPe5hOhwLQq-kq6kdVlhhg');

// Создаем платеж
$idempotenceKey = uniqid('', true); // Генерируем ключ идемпотентности
$payment = $client->createPayment(
        array(
            "amount" => array(
                "value" => $_POST['sum'], // Сумма платежа
                "currency" => "RUB" // Валюта платежа
            ),
            "confirmation" => array(
                "type" => "redirect",
                "return_url" => "https://site.com/money" // Куда отправлять пользователя после оплаты
            ),
            "capture" => true, // Платеж в один этап
            "receipt" => array(
                "customer" => array(
       				"email" => $_POST['email'],
                ),
                "items" => array(
                    array(
                        "description" => "Описание услуги",
                        "quantity" => "1.00", // Количество
                        "amount" => array(
                            "value" => $_POST['sum'],
                            "currency" => "RUB"
                        ),
                        "tax_system_code" => "2", // Налогообложение 
                        "vat_code" => "2",
                        "payment_mode" => "full_prepayment", // Полный платеж
                        "payment_subject" => "service" // Услуга
                    )
                )
            )
        ),
        uniqid('', true)
    );

// Получаем ссылку на оплату
$confirmationUrl = $payment->getConfirmation()->getConfirmationUrl();

// Получаем платежный ключ
$pay_key = $payment->getid();

// Сохраняем данные платежа в базу
$status_pay = mysqli_query($connection, "INSERT INTO `pay` (`user_id`, `pay_sum`, `pay_date`, `pay_key`, `pay_status`) VALUES ('".$_POST['userid']."', '".$_POST['sum']."', '".$pay_date."', '".$pay_key."', '".$pay_status."')");

// Отправляем пользователя на страницу оплаты
header('Location: '.$confirmationUrl);