<?php

include_once('db.php');

$rfid = $_GET["rfid"];
$face_id = $_POST["face_id"];
// $img = $_POST["img"];

$status = "OK";
$img_url = "localhost/attendance/img/$rfid.jpg";

// $select_sql = "SELECT (name, face_id) FROM user WHERE rfid='$rfid'";
$select_sql = "SELECT * FROM user WHERE rfid='$rfid'";
echo $rfid;

$result = $conn->query($select_sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $name = $row['name'];
    echo "name: " . $name;

    // Check if the face_id taken from Camera equivalent to the rightful owner
    // if ($face_id != $row['face_id'])
    //   $status = "ERROR";
  }
}

$sql = "INSERT INTO attendance (rfid, name, status, img_url) VALUES ('$rfid', '$name', '$status', '$img_url')";
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
