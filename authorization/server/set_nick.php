<?php
error_reporting(E_ALL & ~E_WARNING);
try {
    error_reporting(E_ALL & ~E_WARNING);
if(isset($_GET['username']) & isset($_GET['password'])) {
    $user = $_GET['username'];
    $pass = $_GET['password'];
    $player = $_GET['player'];
    
    // Подключаемся к базе данных MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "LocalUsersTest";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ищем строку с данным никнеймом (player) в столбце nickname
    $sql = "SELECT * FROM users WHERE username = '$user' OR email = '$user'";
    $result = $conn->query($sql);
    // echo "Проверка...";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Проверяем наличие поля my_referal_id
            if(isset($row['password'])) {
                $hash = $row['password'];
                if (password_verify($pass, $hash)) {
                    $randomNumber = mt_rand(100000, 999999);
                    echo "Для подтвержения, введите команду /paradiserp apply_nick $randomNumber, а для отмены введите /paradiserp discard_nick $randomNumber, также вы можете ввести этот код: $randomNumber на сайте";
                    $sql_update = "UPDATE users SET apply_nick = '$randomNumber', temp_nick = '$player' WHERE username = '$user'";
                    $conn->query($sql_update);

                } else {
                    echo "Пароль или логин неверный!";
                }
            } else {
                echo "Пароль или логин неверный!";
            }
        }
    } else {
        echo "Пароль или логин неверный!";
    }
} else if(isset($_GET['apply'])) {
    
        if(isset($_GET['code'])) {
            $code = $_GET['code'];
            if (strlen($code) < 6) {
                echo "Вы ввели не шестизначное число";
            } elseif (strlen($code) > 6) {
                echo "Вы ввели больше 6 цифр";
            } elseif (!is_numeric($code)) {
                echo "Вы ввели не верный код";
            } else {
                if(isset($_GET['player'])) {
                    $nick = $_GET['player'];
                // Подключаемся к базе данных MySQL
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "LocalUsersTest";
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Ищем строку с данным никнеймом (player) в столбце nickname
                $sql = "SELECT * FROM users WHERE temp_nick = '$nick' AND apply_nick = '$code'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    $username = $row['username'];
                    $sql_update = "UPDATE users SET nickname = '$nick', apply_nick = '', temp_nick = '', UUID = '', activate = 1 WHERE temp_nick = '$nick' AND apply_nick = '$code'";
                    $conn->query($sql_update);
                    $nickname = $nick;
                    // 
                    // 
                    // 
                    // 
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
                        
                        // Сохраняем голову в файл
                        $filename = "../heads/" . $nickname . ".png";
                        saveHeadToFile($uuid, $filename);
                        echo "Успешная смена никнейма на: $nick, в профиле: $username, а также ваш аккаунт активирован!";
                        $sql_update1 = "UPDATE users SET UUID = '$uuid' WHERE username = '$username' AND nickname = '$nick'";
                        $conn->query($sql_update1);
                    
                      } else {
                        // echo $data;
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
                        
                        // Сохраняем голову в файл
                        $filename = "../heads/" . $nickname . ".png";
                        saveHeadToFile($uuid, $filename);
                        echo "Успешная смена никнейма на: $nick, в профиле: $username, а также ваш аккаунт активирован!";
                        $sql_update1 = "UPDATE users SET UUID = '$uuid' WHERE username = '$username' AND nickname = '$nick'";
                        $conn->query($sql_update1);
                      } else {
                        // echo $data;
                        echo "Успешная смена никнейма на: $nick, в профиле: $username, а также ваш аккаунт активирован!";
                      }
                    } else {
                        // echo $data;
                        echo "Успешная смена никнейма на: $nick, в профиле: $username, а также ваш аккаунт активирован!";
                    }
                      }
                    } else {
                        // echo $data;
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
                        setcookie("minecraft_UUID", $uuid, time()+100000);
                        
                        // Сохраняем голову в файл
                        $filename = "../heads/" . $nickname . ".png";
                        saveHeadToFile($uuid, $filename);
                        echo "Успешная смена никнейма на: $nick, в профиле: $username, а также ваш аккаунт активирован!";
                        $sql_update1 = "UPDATE users SET UUID = '$uuid' WHERE username = '$username' AND nickname = '$nick'";
                        $conn->query($sql_update1);            
                    
                      } else {
                        // echo $data;
                        echo "Успешная смена никнейма на: $nick, в профиле: $username, а также ваш аккаунт активирован!";
                      }
                    } else {
                        // echo $data;
                        echo "Успешная смена никнейма на: $nick, в профиле: $username, а также ваш аккаунт активирован!";
                    }
                    }
                }
                    // 
                    // 
                    // 
                    // 
                } else {
                    echo "Не верный код, или никнейм игрока!";
                }
            } else {
                echo "Не верный никнейм игрока!";
            }
            }
        } else {
            echo "Нет кода!";
        }
    } else if(isset($_GET['discard'])) {
    
        if(isset($_GET['code'])) {
            $code = $_GET['code'];
            if (strlen($code) < 6) {
                echo "Вы ввели не шестизначное число";
            } elseif (strlen($code) > 6) {
                echo "Вы ввели больше 6 цифр";
            } elseif (!is_numeric($code)) {
                echo "Вы ввели не верный код";
            } else {
                if(isset($_GET['player'])) {
                    $nick = $_GET['player'];
                // Подключаемся к базе данных MySQL
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "LocalUsersTest";
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Ищем строку с данным никнеймом (player) в столбце nickname
                $sql = "SELECT * FROM users WHERE temp_nick = '$nick' AND apply_nick = '$code'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    $sql_update = "UPDATE users SET apply_nick = '', temp_nick = '' WHERE temp_nick = '$nick' AND apply_nick = '$code'";
                    $conn->query($sql_update);
                    echo "Запрос успешно отклонен!";
                    }
                } else {
                    echo "Код или никнейм игрока не верный!";
                }
            } else {
                echo "Никнейм игрока отсутствует!";
            }
        }
    } else {
        echo "Код отсутствует!";
    }
} else {
    echo "Пустой запрос!";
}

} catch (Throwable $e) {
}
$conn->close(); 
?>