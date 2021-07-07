<?php

$servername ="localhost";
$username = "*****";
$password ="*****";
$dbname = "indevtec_attendance";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
  die("Connection Failed: " . $conn -> connect_error);
} 