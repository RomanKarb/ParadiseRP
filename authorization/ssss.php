<?php
$nickname = $_GET['nick'];

$url = 'https://api.mojang.com/users/profiles/minecraft/' . $nickname;

$response = @file_get_contents($url);

if ($response) {
  $data = json_decode($response);
  if (isset($data->id)) {
    echo "super";
  } else {
    echo "fail";
  }
} else {
  echo "fail";
}
?>