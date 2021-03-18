<?php 
require_once "header.php";
session_start();
if(!isset($_SESSION['librarian_login'])) {
  header('location: login.php');
  
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
        <li><a href="javascript:avoid()">Students</a></li>
      </ul>
    </div>
  </div>

  <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
  <div class="row animated fadeInUp">
    <div class="col-sm-12">
      <h4 class="section-subtitle"><b>All Student</b></h4>
      <div class="panel">
        <div class="panel-content">
          <div class="table-responsive">
            <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0"
              width="100%">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Roll</th>
                  <th>Reg. No</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
              $result = mysqli_query($db_conn, "SELECT * FROM `students` ");
              while($student = mysqli_fetch_assoc($result)) : ?>
                <tr>
                  <td><?= ucwords($student['f_name'].' '.$student['l_name']); ?></td>
                  <td><?= $student['username']; ?></td>
                  <td><?= $student['roll']; ?></td>
                  <td><?= $student['reg']; ?></td>
                  <td><?= $student['email']; ?></td>
                  <td><?= $student['phone']; ?></td>
                  <td><img class="std_image img-thumbnail text-center"
                      src="../images/students/<?= $student['std_image']; ?>"
                      alt="<?= ucwords($student['f_name'].' '.$student['l_name']); ?>">
                  </td>
                  <td><?= $student['status'] == 1 ? 'Active' : 'Inactive'; ?></td>
                  <td>
                    <?php if($student['status'] == 1) { 
                      ?>
                    <a href="status_inactive.php?id=<?= base64_encode($student['id']); ?>" class="btn btn-primary"><i
                        class="fa fa-arrow-up"></i></a>
                    <?php } else { 
                      ?>
                    <a href="status_active .php?id=<?= base64_encode($student['id']); ?>" class="btn btn-warning"><i
                        class="fa fa-arrow-down"></i></a>
                    <?php }; ?>


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
  <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
</div>

<?php require_once "footer.php";?>