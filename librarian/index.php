<?php 
require_once "header.php";

// Librarian
$librarian_qry = mysqli_query($db_conn, "SELECT * FROM `librarian`");
$total_librarian = mysqli_num_rows($librarian_qry);

// Books
$books_qry = mysqli_query($db_conn, "SELECT * FROM `books`");
$total_books = mysqli_num_rows($books_qry);
//Total Qty
$books_qty_qry = mysqli_query($db_conn, " SELECT SUM(`book_qty`) AS total FROM `books` ");
$qty = mysqli_fetch_assoc($books_qty_qry);
// Available Qty
$available_qty_qry = mysqli_query($db_conn, " SELECT SUM(`available_qty`) AS total FROM `books` ");
$qty_a = mysqli_fetch_assoc($available_qty_qry);

// Students
$students_qry = mysqli_query($db_conn, "SELECT * FROM `students`");
$total_students = mysqli_num_rows($students_qry);

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
    <div class="row">
      <!--Librarians-->
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="panel widgetbox wbox-2 bg-darker-1">
          <a href="#">
            <div class="panel-content">
              <div class="row">
                <div class="col-xs-4">
                  <span class="icon fa fa-users color-lighter-1"></span>
                </div>
                <div class="col-xs-8">
                  <h4 class="subtitle color-lighter-1">Librarians</h4>
                  <h1 class="title color-light"><?= $total_librarian; ?></h1>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <!--Books-->
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="panel widgetbox wbox-2 bg-darker-2 color-light">
          <a href="#">
            <div class="panel-content">
              <div class="row">
                <div class="col-xs-4">
                  <span class="icon fa fa-book color-lighter-1"></span>
                </div>
                <div class="col-xs-8">
                  <h4 class="subtitle color-lighter-1">Total Books</h4>
                  <h1 class="title color-light"><?= $total_books.' ('. $qty['total'] .' - ' .$qty_a['total'] .')';?>
                  </h1>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <!--Students-->
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="panel widgetbox wbox-2 bg-lighter-2 color-light">
          <a href="#">
            <div class="panel-content">
              <div class="row">
                <div class="col-xs-4">
                  <span class="icon fa fa-user color-darker-2"></span>
                </div>
                <div class="col-xs-8">
                  <h4 class="subtitle color-darker-2">All Students</h4>
                  <h1 class="title color-w"><?= $total_students; ?></h1>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <!--BOX Style 2-->
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="panel widgetbox wbox-2 bg-light color-darker-2">
          <a href="#">
            <div class="panel-content">
              <div class="row">
                <div class="col-xs-4">
                  <span class="icon fa fa-dollar color-darker-2"></span>
                </div>
                <div class="col-xs-8">
                  <h4 class="subtitle">Total</h4>
                  <h1 class="title"> 14.550,00</h1>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
</div>

<?php require_once "footer.php";?>