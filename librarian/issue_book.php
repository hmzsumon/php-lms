<?php 
require_once "header.php";
require_once "../function.php";

if(isset($_POST['issue_book'])) {
  $student_id = $_POST['student_id'];
  $book_id = $_POST['book_id'];
  $book_issue_date = $_POST['book_issue_date'];

  $books_query = mysqli_query($db_conn, "SELECT * FROM `books` WHERE `id` = '$book_id' ");
  $book = mysqli_fetch_assoc($books_query);

  $issue_query = mysqli_query($db_conn, " INSERT INTO `issue_books`( `student_id`, `book_id`, `book_issue_date`) VALUES ('$student_id', '$book_id', '$book_issue_date') ");

  if($issue_query) {
    mysqli_query($db_conn, " UPDATE books SET available_qty = available_qty -1 WHERE id = '$book_id' ");
    alert("Book Issue Successfully");
  } else {
    alert("Book Issue Error Occurred");
  }
  
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
        <li><a href="javascript:avoid()">Issue Book</a></li>
      </ul>
    </div>
  </div>

  <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
  <div class="row animated fadeInUp">
    <div class="col-sm-6 col-sm-offset-3">
      <h4 class="section-subtitle text-center"><b>Book</b> Issue by Student</h4>
      <div class="panel">
        <div class="panel-content">
          <div class="row">
            <div class="col-md-12">
              <div class="col-sm-8 col-sm-offset-2">
                <form class="form-inline" method="POST" action="">
                  <div class="form-group">
                    <select class="form-control" name="student_id">
                      <option value="">Select</option>
                      <?php
                      $student_query = mysqli_query($db_conn, "SELECT * FROM `students` WHERE `status` = '1' ");
                      while($student = mysqli_fetch_assoc( $student_query)) : 
                      $student_name = $student['f_name'].' '.$student['l_name']; ?>
                      <option value="<?= $student['id']; ?>">
                        <?= ucwords($student_name.' - '.'('.$student['roll'].')'); ?>
                      </option>
                      <?php  endwhile; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <button type="submit" name="search" class="btn btn-primary">Search</button>
                  </div>
                </form>
              </div>

              <?php 
              if(isset($_POST['search'])) :
                $id = $_POST['student_id'];
                $student_query = mysqli_query($db_conn, "SELECT * FROM `students` WHERE `id` = '$id' AND `status` = '1' ");
                $student = mysqli_fetch_assoc($student_query); 
                $std_full_anme = $student['f_name'].' '.$student['l_name'];
                ?>

              <!-- book issue form -->
              <div class="row">
                <div class="col-md-12">
                  <form action="" method="POST">
                    <div class="form-group">
                      <label for="name">Student Name</label>
                      <input type="text" class="form-control" id="name" name="name" readonly
                        value="<?= $std_full_anme; ?>">
                      <input type="hidden" class="form-control" id="name" name="student_id" readonly
                        value="<?= $student['id']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="password">Book Name</label>
                      <!-- Select Book -->
                      <select class="form-control" name="book_id">
                        <option value="">Select</option>
                        <?php
                      $books_query = mysqli_query($db_conn, "SELECT * FROM `books` WHERE `available_qty` > 0");
                      while($book = mysqli_fetch_assoc( $books_query)) : ?>

                        <option value="<?= $book['id']; ?>">
                          <?= ucwords($book['book_name']); ?>
                        </option>
                        <?php  endwhile; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="book_issue_date">Book Issue Date</label>
                      <input class="form-control" type="text" name="book_issue_date" value="<?= date('d M Y'); ?>"
                        readonly>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary" name="issue_book">Save Book Issue</button>
                    </div>

                  </form>
                </div>
              </div>

              <!--end book issue form -->
              <?php  endif;
              
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
</div>

<?php require_once "footer.php";?>