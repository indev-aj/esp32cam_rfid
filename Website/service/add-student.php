<?php

include_once('db.php');

$name = $_POST["name"];
$rfid = $_POST["rfid"];
$face_id = $_POST["face_id"];

$sql = "INSERT INTO user (name, rfid, face_id) VALUES ('$name', '$rfid', '$face_id')";
if ($conn->query($sql) === TRUE) {
  echo "New student successfully added!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

header('Location: https://attendance.indevtechnology.com/user.php');

$conn->close();