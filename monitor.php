<?php
$server_ip = "127.0.0.1";
$server_port = 25565;

$socket = @fsockopen($server_ip, $server_port, $errno, $errstr, 1);

if ($socket === false) {
    $onlinePlayers = "-";
    $maxPlayers = "-";
} else {
    fwrite($socket, "\xfe\x01");
    $data = fread($socket, 1024);
    fclose($socket);

    if ($data !== false && substr($data, 0, 1) == "\xff") {
        $result = substr($data, 3);
        $result = mb_convert_encoding($result, 'UTF-8', 'UTF-16BE');
        $result = explode("\x00", $result);
      
        $onlinePlayers = intval($result[4]);
        $maxPlayers = intval($result[5]);
    } else {
        $onlinePlayers = 0;
        $maxPlayers = 0;
    }
}

$response = array(
    "onlinePlayers" => $onlinePlayers,
    "maxPlayers" => $maxPlayers,
);
echo json_encode($response);
?>