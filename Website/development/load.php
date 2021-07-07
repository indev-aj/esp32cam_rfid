<?php

include_once('../service/db.php');

$dir_path = "uploads/";
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