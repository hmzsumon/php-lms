<?php
require_once "../dbcon.php";

if(isset($_GET['delete_book'])) {
  $id = base64_decode($_GET['delete_book']);
  mysqli_query($db_conn, "DELETE FROM `books` WHERE `id` = '$id' ");
  header('location: manage_books.php');
}

?>