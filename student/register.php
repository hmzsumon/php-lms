<?php 
require_once "../dbcon.php";
session_start();
if(isset($_SESSION['student_login'])) {
    header('location: index.php');
}

if(isset($_POST['std_register'])) {

    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $email = $_POST['email'];
    $std_username = $_POST['username'];
    $password = $_POST['password'];
    $roll = $_POST['roll'];
    $reg = $_POST['reg'];
    $phone = $_POST['phone'];

    // student image
    $image_name = $_FILES['std_image']['name'];
    $post_image = explode('.', $image_name);
    $image_ext = end($post_image);
    $std_image =  $std_username.'.'.$image_ext;

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
    if(empty($std_username)) {
        $input_errors['username'] = "Username field is required";
    }
    if(empty($password)) {
        $input_errors['password'] = "Password field is required";
    }
    if(empty($roll)) {
        $input_errors['roll'] = "Roll Number field is required";
    }
   
    if(empty($reg)) {
        $input_errors['reg'] = "Reg. Number field is required";
    }
    if(empty($phone)) {
        $input_errors['phone'] = "Phone Number field is required";
    }

    $err_count = count($input_errors);

    if($err_count === 0) {

        $email_check = mysqli_query($db_conn, "SELECT * FROM `students` WHERE `email` = '$email'");
        $find_email = mysqli_num_rows($email_check);

        if($find_email === 0) {
            
            $user_check = mysqli_query($db_conn, "SELECT * FROM `students` WHERE `username` = '$std_username'");
            $find_user = mysqli_num_rows($user_check);

            if($find_user === 0) {

                if(strlen($std_username) >= 6) {
                    
                    if(strlen($password) >= 6) {
                        

                        // insert query
                        $result = mysqli_query($db_conn, " INSERT INTO `students`(`f_name`, `l_name`, `roll`, `reg`, `email`, `username`, `password`, `phone`, `std_image`, `status`) VALUES ('$f_name', '$l_name', '$roll', '$reg', '$email', '$std_username', '$hash_pass', '$phone', '$std_image', '0') ");

                        if($result) {
                          move_uploaded_file($_FILES['std_image']['tmp_name'], '../images/students/'.$std_image);
                            $success = "Registration Successful";
                            
                            $f_name = '';
                            $l_name = '';
                            $email = '';
                            $std_username = '';
                            $password = '';
                            $roll = '';
                            $reg = '';
                            $phone = '';
                        } else {
                            $reg_error = "Registration Error Occurred";
                        }



                    } else {
                        $pass_length_err = "Password more than 6 characters or equal.";
                    }
                    
                } else {
                    $user_length_err = "Username more than 6 characters or equal.";
                }
                
            } else {   
                $user_check_err = "The Username already exists.";
            }
        } else {
            $email_check_err = "The email address already exists.";
        }
        
    }


   



    // echo "<pre>";
    // print_r($_POST);
}

?>



<!doctype html>
<html lang="en" class="fixed accounts sign-in">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>LMS Student Registration</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <!--BASIC css-->
  <!-- ========================================================= -->
  <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendor/animate.css/animate.css">
  <!--SECTION css-->
  <!-- ========================================================= -->
  <!--TEMPLATE css-->
  <!-- ========================================================= -->
  <link rel="stylesheet" href="../assets/stylesheets/css/style.css">
</head>

<body>
  <div class="wrap">
    <!-- page BODY -->
    <div class="page-body animated slideInDown">

      <!--LOGO-->
      <div class="logo">
        <h1 class="text-center">LMS</h1>

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
        <!--SIGN IN FORM-->
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
                    value="<?= isset($email) ? $email : null; ?>">
                  <i class="fa fa-envelope"></i>
                </span>
                <span class="error"><?= isset($input_errors['email']) ? $input_errors['email'] : null; ?>
              </div>

              <div class="form-group mt-md">
                <span class="input-with-icon">
                  <input type="text" class="form-control" name="username" placeholder="Username"
                    value="<?= isset($std_username) ? $std_username : null; ?>">
                  <i class="fa fa-user"></i>
                </span>
                <span class="error"><?= isset($input_errors['username']) ? $input_errors['username'] : null; ?>
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
                  <input type="text" class="form-control" name="roll" placeholder="Roll No." pattern="[0-9]{6}"
                    value="<?= isset($roll) ? $roll : null; ?>">
                  <i class="fa fa-id-card"></i>
                </span>
                <span class="error"><?= isset($input_errors['roll']) ? $input_errors['roll'] : null; ?>
              </div>

              <div class="form-group mt-md">
                <span class="input-with-icon">
                  <input type="text" class="form-control" name="reg" placeholder="Reg. No." pattern="[0-9]{6}"
                    value="<?= isset($reg) ? $reg : null; ?>">
                  <i class="fa fa-registered"></i>
                </span>
                <span class="error"><?= isset($input_errors['reg']) ? $input_errors['reg'] : null; ?>
              </div>

              <div class="form-group mt-md">
                <span class="input-with-icon">
                  <input type="text" class="form-control" name="phone" placeholder="01xxxxxxxx"
                    value="<?= isset($phone) ? $phone : null; ?>">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                </span>
                <span class="error"><?= isset($input_errors['phone']) ? $input_errors['phone'] : null; ?>
              </div>

              <!-- image -->
              <div class="form-group mt-md">
                <div class="student_image_file">
                  <input type="file" id="std_image" name="std_image" required="">
                  <label class="label_img btn btn-info btn btn-info btn-block" for="std_image" id="label"><i
                      class="fa fa-upload" aria-hidden="true"></i> <span id="tmp_content">Upload a Profile
                      Picture</span>
                  </label>
                </div>
              </div>



              <div class="form-group">
                <input class="btn btn-primary btn-block" type="submit" name="std_register" value="Register">
              </div>
              <div class="form-group text-center">
                Have an account?, <a href="sign_in.php">Sign In</a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
  </div>
  <!--BASIC scripts-->
  <!-- ========================================================= -->
  <script src="../assets/vendor/jquery/jquery-1.12.3.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/vendor/nano-scroller/nano-scroller.js"></script>
  <!--TEMPLATE scripts-->
  <!-- ========================================================= -->
  <script src="../assets/javascripts/template-script.min.js"></script>
  <script src="../assets/javascripts/template-init.min.js"></script>
  <script src="../assets/javascripts/app.js"></script>
  <!-- SECTION script and examples-->
  <!-- ========================================================= -->
</body>

</html>