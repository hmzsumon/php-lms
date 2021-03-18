<?php
require_once "../dbcon.php";



?>

<div class="book-info">
  <?php 
  $result = mysqli_query($db_conn, "SELECT * FROM `books` ");
  while($row = mysqli_fetch_assoc($result)) : ?>
  <div>
    <img class="img-responsive img-thumbnail" src="../images/books/<?= $row['book_image'];?>" alt="">
    <div class="item-content">
      <h4 class="highlight"><?= ucwords($row['book_name']); ?></h4>
      <b>Available: <span class="highlight"><?= $row['available_qty'];?></span></b>
    </div>
  </div>
  <?php endwhile; ?>
</div>