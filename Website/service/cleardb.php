<?php

include_once('db.php');

$sql = "TRUNCATE TABLE attendance";

$conn->query($sql) or die("Error has occured!");