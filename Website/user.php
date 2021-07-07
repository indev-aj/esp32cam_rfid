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
      <p>Student List</p>
      <button class="add" id="button">Add Student</button>
    </div>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>RFID Tag</th>
          <th>Name</th>
          <th>Face ID</th>
        </tr>
      </thead>
      <tbody>
        <?php

        include_once('service/db.php');
        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<td>" . $row['id'] . "</td>" . "</td><td class='rfid'>" . $row['rfid'] . "</td><td>" . $row['name'] . "</td><td>" . $row['face_id'] .
              "</td></tr>";
          }
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Modal -->
  <div class="bg-modal">
    <div class="modal-contents">
      <div class="close">+</div>
      <p>Add Student</p>

      <form action="./service/add-student.php" method="POST" id="form1">
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="rfid" placeholder="RFID">
        <input type="number" name="face_id" placeholder="Face ID">
        <!-- <button class="add">Submit</button> -->
      </form>
      <button type="submit" form="form1" value="Submit" class="add">Submit</button>
    </div>
  </div>

  <script type="text/javascript" src="asset/script.js"></script>
</body>

</html>