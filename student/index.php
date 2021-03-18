<?php 
require_once "header.php";

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
        <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
      </ul>
    </div>
  </div>

  <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
  <div class="row animated fadeInUp">
    <div class="col-sm-12">
      <h4 class="section-subtitle"><b>All Issue Books</b></h4>
      <div class="panel">
        <div class="panel-content">
          <div class="table-responsive">
            <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0"
              width="100%">
              <thead>
                <tr>
                  <th> Book Name</th>
                  <th>Book Image</th>
                  <th>Book Issue Date</th>
                </tr>
              </thead>
              <tbody>

                <?php 
                $student_id = $_SESSION['student_id'];
                $issue_books_qry = mysqli_query($db_conn, " SELECT `issue_books`.`book_issue_date`, `books`.`book_name`, `books`.`book_image` FROM `books` INNER JOIN `issue_books` ON `issue_books`.`book_id`=`books`.`id` WHERE `issue_books`.`student_id` = '$student_id'");
                while($issue_books = mysqli_fetch_assoc($issue_books_qry)) : ?>

                <tr>
                  <td><?= ucwords($issue_books['book_name']);?></td>
                  <td><img style="width: 100px; height: 120px;" class=" img-thumbnail"
                      src="../images/books/<?= $issue_books['book_image']; ?>" alt=""></td>
                  <td><?= $issue_books['book_issue_date']?></td>
                </tr>

                <?php  endwhile;
                
                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
</div>

<?php require_once "footer.php";?>