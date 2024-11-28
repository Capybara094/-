<?php

$servername = "localhost";

$dbname = "database";

$dbUsername = "root";

$dbPassword = "";

try {

  $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

  // echo "成功連線!";

  }

catch(Exception $e) {

  echo '無法連線:$e->getMessage()';

}

?>