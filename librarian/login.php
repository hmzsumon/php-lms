<?php
require_once "../dbcon.php";
session_start();
if(isset($_SESSION['librarian_login'])) {
    header('location: index.php');
}

if(isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result= mysqli_query($db_conn, " SELECT * FROM `librarian` WHERE `email` = '$email' OR `username` = '$email' ");
    if(mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
         
        if($row['password'] === $password) {
          $_SESSION['librarian_login'] = $email;
          $_SESSION['librarian_username'] = $row['username'];
          header('location: index.php');
          
        } else {
            $loging_err = "Incorrect Password ";
        }
    }else {
        $loging_err = "Email or Username Incorrect";
    }
    


  
}

?>

<!doctype html>
<html lang="en" class="fixed accounts sign-in">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>LMS</title>

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
    <!-- ========================================================= -->
    <div class="page-body animated slideInDown">
      <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
      <!--LOGO-->
      <div class="logo">
        <h1 class="text-center">LMS</h1>
        <!-- Log in Error Message  -->
        <?php  if(isset($loging_err)) : ?>
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <span><?= $loging_err; ?></span>
        </div>
        <?php endif; ?>
      </div>
      <div class="box">
        <!--SIGN IN FORM-->
        <div class="panel mb-none">
          <div class="panel-content bg-scale-0">
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
              <div class="form-group mt-md">
                <span class="input-with-icon">
                  <input type="text" class="form-control" name="email" placeholder="Email" value="librarian@gmail.com">
                  <i class="fa fa-envelope"></i>
                </span>
              </div>
              <div class="form-group">
                <span class="input-with-icon">
                  <input type="password" class="form-control" name="password" placeholder="Password" value="123456">
                  <i class="fa fa-key"></i>
                </span>
              </div>

              <div class="form-group">
                <div class="checkbox-custom checkbox-primary">
                  <input type="checkbox" id="remember-me" value="option1" checked>
                  <label class="check" for="remember-me">Remember me</label>
                </div>
              </div>

              <div class="form-group">
                <input class="btn btn-primary btn-block" type="submit" name="login" value="Sign In">
              </div>

              <div class="form-group text-center">
                <a href="pages_forgot-password.html">Forgot password?</a>
                <!-- <hr />
                <span>Don't have an account?</span>
                <a href="register.php" class="btn btn-block mt-sm">Register</a> -->
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
  <!-- SECTION script and examples-->
  <!-- ========================================================= -->
</body>

</html>