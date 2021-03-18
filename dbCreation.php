<?php
$servername = "localhost";
$username = "id16407850_users_info_db";
$password = "8i+Q60+D>Cxj>R5y";
$dbname = "id16407850_users_info";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>