<?php

$servername ="localhost";
$username = "indevtec_indevtec";
$password ="120478Aj_Zer0";
$dbname = "indevtec_attendance";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
  die("Connection Failed: " . $conn -> connect_error);
} else {
//   echo "Connection Successful!";
}

// Select data
// $sql = "SELECT * FROM attendance";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//   while($row = $result -> fetch_assoc()) {
//     $img = $row['img_url'];
//     echo "name" . $row['name'] . "IMG";
//     echo "<img src='$img'>";
//   }
// } else {
//   echo "0 results";
// }

// $conn -> close();