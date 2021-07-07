<?php

// Telegram function which you can call
function telegram($msg)
{
        global $telegrambot, $telegramchatid;
        $url = 'https://api.telegram.org/bot' . $telegrambot . '/sendMessage';
        $data = array('chat_id' => $telegramchatid, 'text' => $msg);
        $options = array('http' => array('method' => 'POST', 'header' => "Content-Type:application/x-www-form-urlencoded\r\n", 'content' => http_build_query($data),),);
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
}

function sendPhoto($img_url)
{
        global $telegrambot, $telegramchatid;
        define('BOTAPI', 'https://api.telegram.org/bot' . $telegrambot . '/');

        $cfile = new CURLFile(realpath($img_url), 'image/jpg', 'image.jpg'); //first parameter is YOUR IMAGE path
        $data = [
                'chat_id' => $telegramchatid,
                'photo' => $cfile,
                'caption' => 'Alert!!Unauthorized User Detected!!'
        ];

        $ch = curl_init(BOTAPI . 'sendPhoto');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
}

// Set your Bot ID and Chat ID.
$telegrambot = '1881958818:AAGKhZVkH7MWRhatPhIfFL2DC1kItQUAU6A';
$telegramchatid = 400946997;

$img_url = "/uploads/2021.06.30_20:24:43_esp32-cam.jpg";

// Function call with your own text or variable
sendPhoto($img_url);
// telegram("Alert!!");
