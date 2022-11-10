<?php
$host = "localhost";
$user = "root";
$pass = "";
$db="nicejob";
//creating database connection
$conn = mysqli_connect($host,$user,$pass,$db);
//check database connection
if (!$conn) {
    # code...
    die("Connection Failed: ". mysqli_connect_error());
  }
// else {
//     echo "Connected successfully";
// }

?>