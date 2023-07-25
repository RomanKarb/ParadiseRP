<?
$connection = mysqli_connect('localhost', 'root', '', 'LocalUsersTest') or die(mysqli_error($connection)); // Подключаемся к базе данных

// Подключаем библиотеку Я.Кассы
require __DIR__ . '/lib/autoload.php';

use YooKassa\Client;
$client = new Client();
$client->setAuth('228687', 'test_HL2yFdOJdK1HZe7zhoJ-yWPe5hOhwLQq-kq6kdVlhhg');

// Проверяем статус оплаты
$pay_status = mysqli_query($connection, "SELECT * FROM `pay` WHERE `pay_status` = 'pending'");

// Получаем список платежей циклом
while ($row = mysqli_fetch_assoc($pay_status)) {
	
  $paymentId = $row['pay_key']; // Получаем ключ платежа
  $payment = $client->getPaymentInfo($paymentId); // Получаем информацию о платеже
  $pay_check = $payment->getstatus(); // Получаем статус оплаты

// Если платеж прошел, то обновляем статус платежа
	if ($pay_check == 'waiting_for_capture' or $pay_check == 'succeeded') {

// Обновляем статус платежа
  		mysqli_query($connection, "UPDATE pay SET pay_status = '".$pay_check."'  WHERE pay_key = '".$row['pay_key']."'");	

// Обновляем баланс пользователя (настраивайте под свои нужды)
  		mysqli_query($connection, "UPDATE users SET balance = + '".$row['pay_sum']."'  WHERE username = '".$row['user_id']."'");	
	}  
}
?>