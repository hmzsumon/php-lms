<?php
require_once "../dbcon.php";
$id = base64_decode($_GET['id']);

$result = mysqli_query($db_conn, "UPDATE students SET status='0' WHERE id = $id");
if($result) {
  header('location: students.php');
}

// $sql = "UPDATE students SET status='0' WHERE id = $id";

// if ($db_conn->query($sql) === TRUE) {
//   echo "Record updated successfully";
//   header('location: students.php');
// } else {
//   echo "Error updating record: " . $db_conn->error;
// }

$db_conn->close();

?>