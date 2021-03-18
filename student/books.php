<?php require_once "header.php"; ?>
<div class="content">
  <!-- content HEADER -->
  <!-- ========================================================= -->
  <div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
      <ul class="breadcrumbs">
        <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
        <li></i><a href="javascript:avoid()">Books</a></li>
      </ul>
    </div>
  </div>

  <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
  <div class="row animated fadeInUp">
    <div class="col-sm-12">
      <!-- start search box -->
      <div class="panel">
        <div class="panel-content">
          <form class="" action="" method="POST">
            <div class="row pt-md">
              <div class="form-group col-sm-9 col-lg-10">
                <span class="input-with-icon">
                  <input type="text" class="form-control" name="result" id="lefticon" placeholder="Search">
                  <i class="fa fa-search"></i>
                </span>
              </div>
              <div class="form-group col-sm-3  col-lg-2 ">
                <button type="submit" name="books" class="btn btn-primary btn-block">Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- end search box -->

      <!-- start sho book info panel -->
      <div class="panel">
        <div class="panel-content">

          <?php 
        if(isset($_POST['books'])) : 
          $search_result = $_POST['result'];
          $result = mysqli_query($db_conn, "SELECT * FROM `books` WHERE `book_name` LIKE '%$search_result%' ");
          $temp_result = mysqli_num_rows($result);
          
           if($temp_result > 0) : ?>
          <div class="book-info">
            <?php while($row = mysqli_fetch_assoc($result)) : ?>
            <div>
              <img class="img-responsive img-thumbnail" src="../images/books/<?= $row['book_image'];?>" alt="">
              <div class="item-content">
                <h4 class="highlight"><?= ucwords($row['book_name']); ?></h4>
                <b>Available: <span class="highlight"><?= $row['available_qty'];?></span></b>
              </div>
            </div>
            <?php endwhile; ?>
          </div>

          <?php 
          else : ?>
          <h1 class="text-center text-danger">Book Not Found!</h1>
          <?php
          endif;
        
        else : ?>

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

          <?php 
        endif; ?>


          <!-- Page navigation -->
          <nav aria-label="Page navigation">
            <ul class="pagination">
              <li>
                <a href="#" aria-label="Previous">
                  <i class="fa fa-caret-left"></i>
                </a>
              </li>
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li>
                <a href="#" aria-label="Next">
                  <i class="fa fa-caret-right"></i>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- end sho book info panel -->
    </div>
  </div>