<?php 
require_once "header.php";

require_once "../function.php";

// session_start();
if(!isset($_SESSION['student_login'])) {
  header('location: sign_in.php');
}
$sdt_email = $_SESSION['student_login'];
$result = mysqli_query($db_conn, "SELECT * FROM `students` WHERE `email` = '$sdt_email' ");
$row = mysqli_fetch_assoc($result);
$f_name = $row['f_name']; 
$l_name = $row['l_name'];
$std_image = $row['std_image'];
$std_contact = $row['phone'];
$std_id = $row['id'];
$std_username = $row['username'];
$std_roll = $row['roll'];
$std_reg = $row['reg'];
$std_reg_date = $row['date_time'];


if(isset($_POST['update'])) {

  $f_name = $_POST['f_name'];
  $l_name = $_POST['l_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $phone = $_POST['phone'];

  // student image
  $image_name = $_FILES['std_image']['name'];
  $post_image = explode('.', $image_name);
  $image_ext = end($post_image);
  $std_image_name =  $std_username.'.'.$image_ext;

  $hash_pass = password_hash($password, PASSWORD_DEFAULT);


  $input_errors = array();

  if(empty($f_name)) {
      $input_errors['f_name'] = "First Name field is required";
  }
  if(empty($l_name)) {
      $input_errors['l_name'] = "Last Name field is required";
  }
  if(empty($email)) {
      $input_errors['email'] = "Email field is required";
  }
 
  if(empty($password)) {
      $input_errors['password'] = "Password field is required";
  }
 
  if(empty($phone)) {
      $input_errors['phone'] = "Phone Number field is required";
  }

  $err_count = count($input_errors);

  if($err_count === 0) {

      
        
        if(strlen($password) >= 6) {
            
           if($_FILES['std_image']['tmp_name'] != '') {
             
             move_uploaded_file($_FILES['std_image']['tmp_name'], '../images/students/'.$std_image_name);
             $s_update = "UPDATE students SET f_name = '$f_name', l_name = '$l_name', email = '$email', password ='$password', phone = '$phone', std_image = '$std_image_name' WHERE email = '$sdt_email' ";
             
           } else {
             
            $s_update = "UPDATE students SET f_name = '$f_name', l_name = '$l_name', email = '$email', password ='$password', phone = '$phone' WHERE email = '$sdt_email' ";
           }
           
           $run_update = mysqli_query($db_conn, $s_update);
           if($run_update) {
              alert("Update Successful");
              go_back();
           } else {
              alert("Update Error Occurred");
           }

        } else {
            $pass_length_err = "Password more than 6 characters or equal.";
        }
                          
      
      
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
        <li><a href="javascript:avoid()">Profile</a></li>
      </ul>
    </div>
  </div>

  <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
  <div class="row animated fadeInUp">
    <div class="col-sm-6 col-sm-offset-3">

      <div class="wrap">
        <!-- page BODY -->
        <div class="page-body animated slideInDown">

          <!--LOGO-->
          <div class="logo">
            <h1 class="text-center">Update Student Profile</h1>

            <!-- Success Message   -->
            <?php  if(isset($success)) : ?>
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <span class="text-center"><?= $success; ?></span>
            </div>
            <?php endif; ?>

            <!-- Error Message   -->
            <?php  if(isset($reg_error)) : ?>
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <span class="text-center"><?= $reg_error; ?></span>
            </div>
            <?php endif; ?>

            <!-- Email Check Error Message  -->
            <?php  if(isset($email_check_err)) : ?>
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <span class="text-center"><?= $email_check_err; ?></span>
            </div>
            <?php endif; ?>

            <!-- User Check Error Message  -->
            <?php  if(isset($user_check_err)) : ?>
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <span class="text-center"><?= $user_check_err; ?></span>
            </div>
            <?php endif; ?>

            <!-- User Length Error Message  -->
            <?php  if(isset($user_length_err)) : ?>
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <span class="text-center"><?= $user_length_err; ?></span>
            </div>
            <?php endif; ?>

            <!-- Password Length Error Message  -->
            <?php  if(isset($pass_length_err)) : ?>
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <span class="text-center"><?= $pass_length_err; ?></span>
            </div>
            <?php endif; ?>

          </div>



          <div class="box">
            <!--update FORM-->
            <div class="panel mb-none">
              <div class="panel-content bg-scale-0">
                <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

                  <div class="form-group mt-md">
                    <span class="input-with-icon">
                      <input type="text" class="form-control" name="f_name" placeholder="First Name"
                        value="<?= isset($f_name) ? $f_name : null; ?>">
                      <i class="fa fa-user"></i>
                    </span>
                    <span class="error"><?= isset($input_errors['f_name']) ? $input_errors['f_name'] : null; ?>
                    </span>
                  </div>

                  <div class="form-group mt-md">
                    <span class="input-with-icon">
                      <input type="text" class="form-control" name="l_name" placeholder="Last Name"
                        value="<?= isset($l_name) ? $l_name : null; ?>">
                      <i class="fa fa-user"></i>
                    </span>
                    <span class="error"><?= isset($input_errors['l_name']) ? $input_errors['l_name'] : null; ?>
                  </div>

                  <div class="form-group mt-md">
                    <span class="input-with-icon">
                      <input type="email" class="form-control" name="email" placeholder="Email"
                        value="<?= isset($sdt_email ) ? $sdt_email : null; ?>">
                      <i class="fa fa-envelope"></i>
                    </span>
                    <span class="error"><?= isset($input_errors['email']) ? $input_errors['email'] : null; ?>
                  </div>


                  <div class="form-group">
                    <span class="input-with-icon">
                      <input type="password" class="form-control" name="password" placeholder="Password"
                        value="<?= isset($password) ? $password : null; ?>">
                      <i class="fa fa-key"></i>
                    </span>
                    <span class="error"><?= isset($input_errors['password']) ? $input_errors['password'] : null; ?>
                  </div>


                  <div class="form-group mt-md">
                    <span class="input-with-icon">
                      <input type="text" class="form-control" name="phone" placeholder="01xxxxxxxx"
                        value="<?= isset($std_contact) ? $std_contact : null; ?>">
                      <i class="fa fa-phone" aria-hidden="true"></i>
                    </span>
                    <span class="error"><?= isset($input_errors['phone']) ? $input_errors['phone'] : null; ?>
                  </div>

                  <!-- image -->

                  <div class="upd_image">
                    <img class=" img-thumbnail" src="../images/students/<?= $std_image ? $std_image : 'std7.jpg';?>"
                      alt="">
                  </div>

                  <div class="form-group mt-md">
                    <div class="student_image_file">
                      <input type="file" id="std_image" name="std_image">
                      <label class="label_img btn btn-info btn btn-info btn-block" for="std_image" id="label"><i
                          class="fa fa-upload" aria-hidden="true"></i> <span id="tmp_content">Upload a Profile
                          Picture</span>
                      </label>
                    </div>
                  </div>



                  <div class="form-group">
                    <input class="btn btn-primary btn-block" type="submit" name="update" value="Update">
                  </div>

                </form>
              </div>
            </div>
          </div>
          <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        </div>
      </div>

    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
  </div>

  <?php require_once "footer.php";?>