<?php 
require_once "header.php";
session_start();
if(!isset($_SESSION['librarian_login'])) {
  header('location: login.php');
  
}

?>

<!-- CONTENT -->
<!-- ========================================================= -->
<div class="content">
  <!-- content HEADER -->
  <!-- ========================================================= -->
  <div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
      <ul class="breadcrumbs">
        <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
        <li><a href="javascript:avoid()">Return Issue Book</a></li>
      </ul>
    </div>
  </div>

  <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
  <div class="row animated fadeInUp">
    <div class="col-sm-12">
      <h4 class="section-subtitle"><b>All Student</b></h4>
      <div class="panel">
        <div class="panel-content">
          <div class="table-responsive">
            <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0"
              width="100%">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Roll</th>
                  <th>Phone</th>
                  <th>Book Name</th>
                  <th>Book Image</th>
                  <th>Book Issue Date</th>

                </tr>
              </thead>
              <tbody>
                <?php 
              $result = mysqli_query($db_conn, " SELECT `students`.`f_name`, `students`.`l_name`, `students`.`roll`, `students`.`phone`, `books`.`book_name`, `books`.`book_image`, `issue_books`.`id`, `issue_books`.`book_id`, `issue_books`.`book_issue_date` FROM `issue_books` INNER JOIN `books` ON `books`.`id` = `issue_books`.`book_id` INNER JOIN `students` ON `students`.`id` = `issue_books`.`student_id` WHERE `issue_books`.`book_return_date` = '' ");
              while($row = mysqli_fetch_assoc($result)) : ?>

                <tr>
                  <td><?= ucwords($row['f_name'].' '.$row['l_name']); ?></td>
                  <td><?= $row['roll']; ?></td>
                  <td><?= $row['phone']; ?></td>
                  <td><?= $row['book_name']; ?></td>
                  <td><img style="width: 100px; height: 120px;" class=" img-thumbnail"
                      src="../images/books/<?= $row['book_image']; ?>" alt=""></td>
                  <td><?= $row['book_issue_date']; ?></td>
                  <td><a class="btn btn-info"
                      href="return_issue_book.php?id=<?= base64_encode($row['id']); ?>&bookid=<?= base64_encode($row['book_id']); ?>">Return
                      Book</a></td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
</div>

<?php
  if(isset($_GET['id'])) {
  $id = base64_decode($_GET['id']);
  $book_id = base64_decode($_GET['bookid']);
  $date = date('d-M-Y');
  $result = mysqli_query($db_conn, "UPDATE `issue_books` SET `book_return_date` = '$date' WHERE `id` = '$id' ");
  if($result) {
    mysqli_query($db_conn, " UPDATE books SET available_qty = available_qty + 1 WHERE id = '$book_id' ");
    alert("Book Return Successful");
    go_back();
  }else {
    alert("Book Return Error Occurred");
  }
  }
?>


<?php require_once "footer.php";?>