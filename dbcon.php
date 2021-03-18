<?php 
// $db_conn = mysqli_connect('localhost', 'root', '', 'lms');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms";

// Create connection
$db_conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($db_conn,'SET CHARACTER SET utf8');
mysqli_query($db_conn,"SET SESSION collation_connection ='utf8_general_ci'");
// Check connection
if ($db_conn->connect_error) {
  die("Connection failed: " . $db_conn->connect_error);
}

?>