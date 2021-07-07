<?php

include_once('db.php');

$dir_path = "../uploads/";
$arr = array();

if (is_dir($dir_path)) {
  $files = opendir($dir_path); {
    if ($files) {
      while (($file_name = readdir($files)) !== FALSE) {
        array_push($arr, $file_name);
      }
    }
  }
  echo end($arr);
}

// Telegram function which you can call
function sendMessage($msg)
{
  global $telegrambot, $telegramchatid;
  $url = 'https://api.telegram.org/bot' . $telegrambot . '/sendMessage';
  $data = array('chat_id' => $telegramchatid, 'text' => $msg);
  $options = array('http' => array('method' => 'POST', 'header' => "Content-Type:application/x-www-form-urlencoded\r\n", 'content' => http_build_query($data),),);
  $context = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  return $result;
}

function sendPhoto($img_url, $name)
{
  global $telegrambot, $telegramchatid;
  define('BOTAPI', 'https://api.telegram.org/bot' . $telegrambot . '/');

  $cfile = new CURLFile(realpath($img_url), 'image/jpg', 'image.jpg'); //first parameter is YOUR IMAGE path
  $data = [
    'chat_id' => $telegramchatid,
    'photo' => $cfile,
    'caption' => "Alert!! Unauthorized User Detected!!\nName: $name"
  ];

  $ch = curl_init(BOTAPI . 'sendPhoto');
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  curl_close($ch);

  return $result;
}

// Set your Bot ID and Chat ID.
$telegrambot = '1881958818:AAGKhZVkH7MWRhatPhIfFL2DC1kItQUAU6A';
$telegramchatid = 400946997;

$rfid = $_POST["rfid"];
$face_id = $_POST["face_id"];
$img_url = '../uploads/' . end($arr);
$status = "OK";

// $select_sql = "SELECT (name, face_id) FROM user WHERE rfid='$rfid'";
$select_sql = "SELECT * FROM user WHERE rfid='$rfid'";
echo $rfid;

$result = $conn->query($select_sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $name = $row['name'];
    echo "name: " . $name;

    // Check if the face_id taken from Camera equivalent to the rightful owner
    if ($face_id != $row['face_id']) {
      $status = "ERROR";
      sendPhoto($img_url, $name);
    }
  }
}

$sql = "INSERT INTO attendance (rfid, name, status, img_url) VALUES ('$rfid', '$name', '$status', '$img_url')";
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
