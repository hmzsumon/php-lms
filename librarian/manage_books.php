<?php 
require_once "header.php";
require_once "../function.php";

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
        <li><a href="javascript:avoid()">Manage Books</a></li>
      </ul>
    </div>
  </div>

  <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
  <div class="row animated fadeInUp">
    <div class="row animated fadeInUp">
      <div class="col-sm-12">
        <h4 class="section-subtitle"><b>All Books</b></h4>
        <div class="panel">
          <div class="panel-content">
            <div class="table-responsive">
              <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0"
                width="100%">
                <thead>
                  <tr>
                    <th>Book Name</th>
                    <th>Book Image</th>
                    <th>Publication Name</th>
                    <th>Author Name</th>
                    <th>Purchase Date</th>
                    <th>Book Price</th>
                    <th>Book Quantity</th>
                    <th>Avaiable Quantity</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
              $result = mysqli_query($db_conn, "SELECT * FROM `books` ");
              while($book = mysqli_fetch_assoc($result)) : ?>
                  <tr>
                    <td><?= ucwords($book['book_name']); ?></td>
                    <td><img class="img-thumbnail" src="../images/books/<?= $book['book_image']; ?>"
                        alt="<?= $book['book_name']; ?>" style="width: 100px; height:120px;">
                    </td>
                    <td><?= $book['book_publication_name']; ?></td>
                    <td><?= $book['author_name']; ?></td>
                    <td><?= date('d-M-y', strtotime($book['purchase_date'])); ?></td>
                    <td>BDT<?= $book['book_price']; ?></td>
                    <td><?= $book['book_qty']; ?></td>
                    <td><?= $book['available_qty']; ?></td>
                    <td>

                      <a href="" class="btn btn-info" data-toggle="modal" data-target="#info-<?= $book['id']; ?>"><i
                          class="fa fa-eye"></i></a>
                      <a href="" class="btn btn-warning" data-toggle="modal"
                        data-target="#book_update-<?= $book['id']; ?>"><i class="fa fa-pencil"></i></a>
                      <a href="delete.php?delete_book=<?= base64_encode($book['id']); ?>" class="btn btn-danger"
                        onclick="return confirm('Are You sure delete this book?')"><i class="fa fa-trash-o"></i></a>
                    </td>
                  </tr>
                  <?php endwhile; ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
</div>

<!-- Modal -->
<!-- Bokks Model -->

<?php $result = mysqli_query($db_conn, "SELECT * FROM `books` ");
 while($book = mysqli_fetch_assoc($result)) : ?>

<div class="modal fade" id="info-<?= $book['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header state modal-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i><?= $book['book_name']; ?></h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <th></th>
          <td><img class="img-thumbnail" src="../images/books/<?= $book['book_image']; ?>"
              alt="<?= $book['book_name']; ?>" style="width: 100px; height:120px;">
          </td>
          <tr>
            <th>Book Name</th>
            <td><strong>:</strong> <?= ucwords($book['book_name']); ?></td>
          </tr>
          <tr>
          </tr>
          <tr>
            <th>Publication Name</th>
            <td> <strong>:</strong> <?= $book['book_publication_name']; ?></td>
          </tr>
          <tr>
            <th>Author Name</th>
            <td> <strong>:</strong> <?= $book['author_name']; ?></td>
          </tr>
          <tr>
            <th>Purchase Date</th>
            <td> <strong>:</strong> <?= date('d-M-y', strtotime($book['purchase_date'])); ?></td>
          </tr>
          <tr>
            <th>Book Price</th>
            <td> <strong>:</strong> BDT<?= $book['book_price']; ?></td>
          </tr>
          <tr>
            <th>Book Quantity</th>
            <td> <strong>:</strong> <?= $book['book_qty']; ?></td>
          </tr>
          <tr>
            <th>Avaiable Quantity</th>
            <td> <strong>:</strong> <?= $book['available_qty']; ?></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>


</div>
<?php endwhile; ?>

<!-- Update section -->
<?php $result = mysqli_query($db_conn, "SELECT * FROM `books` ");
 while($book = mysqli_fetch_assoc($result)) : 
 $id = $book['id'];
 $book_date = mysqli_query($db_conn, "SELECT * FROM `books` WHERE `id` = '$id'");
 $book_info = mysqli_fetch_assoc($book_date);

//  update data
if(isset($_POST['update_book'])) {

  $book_id = $_POST['book_id'];
  $book_name = $_POST['book_name'];
  $author_name = $_POST['author_name'];
  $book_publication_name = $_POST['book_publication_name'];
  $purchase_date = $_POST['purchase_date'];
  $book_price = $_POST['book_price'];
  $book_qty = $_POST['book_qty'];
  $available_qty = $_POST['available_qty'];

  // librarian_username from $_SESSION
  $librarian_username = $_SESSION['librarian_username'];
  
  // $image_name = $_FILES['book_image']['name'];
  // $post_image = explode('.', $image_name);
  // $image_ext = end($post_image);
  // $image = 'book'.date('ymdis.').$image_ext;
 
  $sql = mysqli_query($db_conn, " UPDATE `books` SET `book_name`='$book_name',`author_name`='$author_name',`book_publication_name`='$book_publication_name',`purchase_date`='$purchase_date',`book_price`='$book_price',`book_qty`='$book_qty',`available_qty`='$available_qty',`librarian_username`='$librarian_username' WHERE `id` = '$book_id' ");

  if($sql){
    alert("Data Update Successful");
    go_back();
    
  } else {
    alert("Data Update Error Occurred");
  }
  // header('location: manage_books.php?');
}
    
// `book_image`='$image',
 ?>

<div class="modal fade" id="book_update-<?= $book['id']; ?>" tabindex="-1" role="dialog"
  aria-labelledby="modal-info-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header state modal-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i><?= $book['book_name']; ?> Update This
        </h4>
      </div>
      <div class="modal-body">
        <!-- form for update -->

        <div class="row">
          <div class="col-md-12">
            <form id="inline-validation" class="" novalidate="novalidate" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="book_name" class="control-label">Book Name<span class="required"
                    aria-required="true">*</span></label>
                <div>
                  <input type="text" class="form-control" id="book_name" name="book_name" required=""
                    aria-required="true" value="<?= ucwords($book_info['book_name']); ?>">
                  <input type="hidden" class="form-control" name="book_id" required="" aria-required="true"
                    value="<?= $book_info['id']; ?>">
                </div>
              </div>

              <!-- <div class="form-group">
                <label for="book_image" class=" control-label">Book Image</label>
                <div class="">
                  <img style="width: 100px; height: 120px;" class="img-thumbnail"
                    src="../images/books/" alt="">
                  <input type="file" class="form-control" id="book_image" name="book_image">
                </div>
              </div> -->


              <div class="form-group">
                <label for="book_publication_name" class=" control-label">Publication Name<span class="required"
                    aria-required="true">*</span></label>
                <div class="">
                  <input type="text" class="form-control" id="book_publication_name" name="book_publication_name"
                    required="" aria-required="true" value="<?= $book_info['book_publication_name']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="author_name" class=" control-label">Author Name<span class="required"
                    aria-required="true">*</span></label>
                <div class="">
                  <input type="text" class="form-control" id="author_name" name="author_name" required=""
                    aria-required="true" value="<?= $book_info['author_name']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="purchase_date" class=" control-label">Purchase Date<span class="required"
                    aria-required="true">*</span></label>
                <div class="">
                  <input type="date" class="form-control" id="purchase_date" name="purchase_date" required=""
                    aria-required="true" value="<?= $book_info['purchase_date']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="book_price" class=" control-label">Book Price<span class="required"
                    aria-required="true">*</span></label>
                <div class="">
                  <input type="number" class="form-control" id="book_price" name="book_price" required=""
                    aria-required="true" value="<?= $book_info['book_price']; ?>">
                </div>
              </div>


              <div class="form-group">
                <label for="book_qty" class=" control-label">Book Quantity<span class="required"
                    aria-required="true">*</span></label>
                <div class="">
                  <input type="number" class="form-control" id="book_qty" name="book_qty" required=""
                    aria-required="true" value="<?= $book_info['book_qty']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="available_qty" class=" control-label">Available Quantity<span class="required"
                    aria-required="true">*</span></label>
                <div class="">
                  <input type="number" class="form-control" id="available_qty" name="available_qty" required=""
                    aria-required="true" value="<?= $book_info['available_qty']; ?>">
                </div>
              </div>

              <div class="form-group">
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary" name="update_book"><i class="fa fa-save"></i>
                    Update</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endwhile; ?>

<?php require_once "footer.php";?>