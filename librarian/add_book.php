<?php require_once "header.php"; 


if(isset($_POST['save_book'])) {

  $book_name = $_POST['book_name'];
  $author_name = $_POST['author_name'];
  $book_publication_name = $_POST['book_publication_name'];
  $purchase_date = $_POST['purchase_date'];
  $book_price = $_POST['book_price'];
  $book_qty = $_POST['book_qty'];
  $available_qty = $_POST['available_qty'];

  // librarian_username from $_SESSION
  $librarian_username = $_SESSION['librarian_username'];
  
  $image_name = $_FILES['book_image']['name'];
  $post_image = explode('.', $image_name);
  $image_ext = end($post_image);
  $image = 'book'.date('ymdis.').$image_ext;
 
  $sql = mysqli_query($db_conn, " INSERT INTO `books`(`book_name`, `book_image`, `author_name`, `book_publication_name`, `purchase_date`, `book_price`, `book_qty`, `available_qty`, `librarian_username`) VALUES ('$book_name', '$image', '$author_name', '$book_publication_name', '$purchase_date', '$book_price', '$book_qty', '$available_qty', '$librarian_username' ) ");

  if($sql){
    move_uploaded_file($_FILES['book_image']['tmp_name'], '../images/books/'.$image);
    $success = "The Book Data Insert Successfully";
  } else {
    $error = "Data Insert Error Occurred";
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
        <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
        <li><a href="javascript:avoid()">Add Book</a></li>
      </ul>
    </div>
  </div>



  <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
  <div class="row animated fadeInUp">
    <div class="col-sm-12 col-md-8 col-md-offset-2">
      <h4 class="section-subtitle"><b>Add Book</b></h4>
      <!-- Success Message   -->
      <?php  if(isset($success)) : ?>
      <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span class="text-center"><?= $success; ?></span>
      </div>
      <?php endif; ?>

      <!-- Error Message   -->
      <?php  if(isset($error)) : ?>
      <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span class="text-center"><?= $error; ?></span>
      </div>
      <?php endif; ?>

      <div class="panel">
        <div class="panel-content">
          <div class="row">
            <div class="col-md-12">
              <form id="inline-validation" class="form-horizontal form-stripe" novalidate="novalidate" method="POST"
                enctype="multipart/form-data">
                <div class="form-group">
                  <label for="book_name" class="col-sm-3 control-label">Book Name<span class="required"
                      aria-required="true">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="book_name" name="book_name" required=""
                      aria-required="true" placeholder="Book Name">
                  </div>
                </div>

                <div class="form-group">
                  <label for="book_image" class="col-sm-3 control-label">Book Image<span class="required"
                      aria-required="true">*</span></label>
                  <div class="col-sm-9">
                    <input type="file" class="form-control" id="book_image" name="book_image" required=""
                      aria-required="true">
                  </div>
                </div>

                <div class="form-group">
                  <label for="book_publication_name" class="col-sm-3 control-label">Publication Name<span
                      class="required" aria-required="true">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="book_publication_name" name="book_publication_name"
                      required="" aria-required="true" placeholder="Publication Name">
                  </div>
                </div>

                <div class="form-group">
                  <label for="author_name" class="col-sm-3 control-label">Author Name<span class="required"
                      aria-required="true">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="author_name" name="author_name" required=""
                      aria-required="true" placeholder="Author Name">
                  </div>
                </div>

                <div class="form-group">
                  <label for="purchase_date" class="col-sm-3 control-label">Purchase Date<span class="required"
                      aria-required="true">*</span></label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" id="purchase_date" name="purchase_date" required=""
                      aria-required="true">
                  </div>
                </div>

                <div class="form-group">
                  <label for="book_price" class="col-sm-3 control-label">Book Price<span class="required"
                      aria-required="true">*</span></label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" id="book_price" name="book_price" required=""
                      aria-required="true" placeholder="Book Price">
                  </div>
                </div>


                <div class="form-group">
                  <label for="book_qty" class="col-sm-3 control-label">Book Quantity<span class="required"
                      aria-required="true">*</span></label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" id="book_qty" name="book_qty" required=""
                      aria-required="true" placeholder="Book Quantity">
                  </div>
                </div>

                <div class="form-group">
                  <label for="available_qty" class="col-sm-3 control-label">Available Quantity<span class="required"
                      aria-required="true">*</span></label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" id="available_qty" name="available_qty" required=""
                      aria-required="true" placeholder="Available Quantity">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary" name="save_book">Save</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
</div>

<?php require_once "footer.php";?>