<?php 
require_once "header.php";
session_start();
if(!isset($_SESSION['student_login'])) {
  header('location: sign_in.php');
}
$sdt_email = $_SESSION['student_login'];
$result = mysqli_query($db_conn, "SELECT * FROM `students` WHERE `email` = '$sdt_email' ");
$row = mysqli_fetch_assoc($result);
$std_name = $row['f_name'].' '.$row['l_name'];
$std_image = $row['std_image'];
$std_contact = $row['phone'];
$std_id = $row['id'];
$std_username = $row['username'];
$std_roll = $row['roll'];
$std_reg = $row['reg'];
$std_reg_date = $row['date_time'];
 

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
    <div class="col-sm-12">
      <h4 class="section-subtitle"><b>User Profile</b></h4>
      <div class="row">
        <div class="col-md-6 col-lg-4">
          <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
          <!--PROFILE-->
          <div>
            <div class="profile-photo">
              <img alt="User photo" src="../images/students/<?= $std_image ? $std_image :'std7.jpg'; ?>">
            </div>
            <div class="user-header-info">
              <h2 class="user-name"><?= ucwords($std_name); ?></h2>
              <h5 class="user-position">UI Designer</h5>
              <div class="user-social-media">
                <span class="text-lg"><a href="#" class="fa fa-twitter-square"></a> <a href="#"
                    class="fa fa-facebook-square"></a> <a href="#" class="fa fa-linkedin-square"></a> <a href="#"
                    class="fa fa-google-plus-square"></a></span>
              </div>
            </div>
          </div>
          <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

          <!-- GANARA INFO-->
          <div class="panel bg-scale-0 b-primary bt-sm mt-xl">
            <div class="panel-content">
              <h4 class="text-center"><b>General information</b></h4>
              <table class="table">
                <tr>
                  <td><b class="color-primary">Id: </b></td>
                  <td><?= ucwords($std_id); ?></td>
                </tr>
                <tr>
                  <td><b class="color-primary">Name: </b></td>
                  <td><?= ucwords($std_name); ?></td>
                </tr>
                <tr>
                  <td><b class="color-primary">Username: </b></td>
                  <td><?= $std_username; ?></td>
                </tr>
                <tr>
                  <td><b class="color-primary">Roll No: </b></td>
                  <td><?= $std_roll; ?></td>
                </tr>
                <tr>
                  <td><b class="color-primary">Reg. No: </b></td>
                  <td><?= $std_reg; ?></td>
                </tr>
                <tr>
                  <td><b class="color-primary">Reg. Date: </b></td>
                  <td><?= $std_reg_date; ?></td>
                </tr>
              </table>

            </div>
          </div>

          <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
          <!--CONTACT INFO-->
          <div class="panel bg-scale-0 b-primary bt-sm mt-xl">
            <div class="panel-content">
              <h4 class=""><b>Contact Information</b></h4>
              <ul class="user-contact-info ph-sm">
                <li><b><i class="color-primary mr-sm fa fa-envelope"></i></b><?= $sdt_email; ?></li>
                <li><b><i class="color-primary mr-sm fa fa-phone"></i></b> (+88) <?= $std_contact; ?></li>
                <li><b><i class="color-primary mr-sm fa fa-globe"></i></b> Helsinki, Finland</li>
              </ul>
            </div>
          </div>
          <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->


        </div>
        <div class="col-md-6 col-lg-8">
          <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
          <!--TIMELINE-->
          <div class="timeline animated fadeInUp">
            <div class="timeline-box">
              <div class="timeline-icon bg-primary">
                <i class="fa fa-phone"></i>
              </div>
              <div class="timeline-content">
                <h4 class="tl-title">Ello impedit iusto</h4> Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Consequatur distinctio illo impedit iusto minima nisi quo tempora ut!
              </div>
              <div class="timeline-footer">
                <span>Today. 14:25</span>
              </div>
            </div>
            <div class="timeline-box">
              <div class="timeline-icon bg-primary">
                <i class="fa fa-tasks"></i>
              </div>
              <div class="timeline-content">
                <h4 class="tl-title">consectetur adipisicing </h4> Lorem ipsum dolor sit amet. Consequatur distinctio
                illo impedit iusto minima nisi quo tempora ut!
              </div>
              <div class="timeline-footer">
                <span>Today. 10:55</span>
              </div>
            </div>
            <div class="timeline-box">
              <div class="timeline-icon bg-primary">
                <i class="fa fa-file"></i>
              </div>
              <div class="timeline-content">
                <h4 class="tl-title">Impedit iusto minima nisi</h4> Lorem ipsum dolor sit amet, consectetur adipisicing
                elit. Consequatur distinctio illo impedit iusto minima nisi quo tempora ut!
              </div>
              <div class="timeline-footer">
                <span>Today. 9:20</span>
              </div>
            </div>
            <div class="timeline-box">
              <div class="timeline-icon bg-primary">
                <i class="fa fa-check"></i>
              </div>
              <div class="timeline-content">
                <h4 class="tl-title">Lorem ipsum dolor sit</h4> Lorem ipsum dolor sit amet Consequatur distinctio illo
                impedit iusto minima nisi quo tempora ut!
              </div>
              <div class="timeline-footer">
                <span>Yesteday. 16:30</span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
</div>

<?php require_once "footer.php";?>