<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="style.css">
  <title>Attendance System</title>
</head>

<body>
  <!-- Navigation Bar -->
  <nav>
    <a href="user.php">Student List</a>
    <a href="index.php">Activity Log</a>
  </nav>

  <!-- Body -->
  <div class="wrapper">
    <p>Activity Log</p>
    <table>
      <thead>
        <tr>
          <th>Date and Time</th>
          <th>RFID Tag</th>
          <th>Name</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php

        include_once('db.php');
        $sql = "SELECT * FROM attendance";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $img = $row['img_url'];
            echo "<tr><td>" . $row['timestamp'] . "</td><td class='rfid'>" . $row['rfid'] . "</td><td>" . $row['name'] . "</td><td>" . $row['status']
              . "</td><td>" ?>

            <button class="btn">view</button>
        <? "</td></tr>";
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>