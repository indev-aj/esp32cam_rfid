<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="asset/style.css">
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
    <div class="container">
      <p>Activity Log</p>
      <button class="add" onclick="clearPrompt()">Clear</button>
    </div>
    <table>
      <thead>
        <tr>
          <th>Date and Time</th>
          <th>RFID Tag</th>
          <th>Name</th>
          <th>Status</th>
          <th>Image Captured</th>
        </tr>
      </thead>
      <tbody>
        <?php

        include_once('service/db.php');
        $sql = "SELECT * FROM attendance";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['timestamp'] . "</td><td class='rfid'>" . $row['rfid'] . "</td><td>" . $row['name'] . "</td><td>" . $row['status']
              . "</td><td>" ?>

            <img src="<?php echo $row['img_url'] ?>" alt="Captured Image of <?php echo $row['name'] ?>">
            <!-- <button class="btn" id="button">view</button> -->
        <? "</td></tr>";
          }
        }
        ?>
      </tbody>
    </table>
  </div>

  <script>
    function clearPrompt() {
      if (confirm("Are you sure you want to clear database?")) {
        var xml = new XMLHttpRequest;
        xml.open("POST", "/service/cleardb.php");
        xml.send();

        location.reload();
      } else {
        location.reload();
      }
    }
  </script>
</body>

</html>