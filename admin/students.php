<?php
session_start();
include("../database/db.php");
error_reporting(0);
if ((!isset($_SESSION['admin_email'])) && (!isset($_SESSION['admin_password']))) {
  header('Location: ../admin-login.php');
}
if (isset($_REQUEST['register'])) {
  $ermsg = "";
  $msg = "";
  $student_name = $_REQUEST['student_name'];
  $cource = $_REQUEST['cource'];
  $student_password = $_REQUEST['student_password'];
  $passwordlength = strlen($student_password);
  $hpassword = password_hash($student_password, PASSWORD_BCRYPT);
  $phone = $_REQUEST['phone'];
  $dob = $_REQUEST['dob'];
  $gender = $_REQUEST['gender'];
  $student_email = mysqli_real_escape_string($conn, $_POST['student_email']);
  $sql = "SELECT * FROM studentregister WHERE student_email = '$student_email'";
  $execute = mysqli_query($conn, $sql);

  if (!filter_var($student_email, FILTER_VALIDATE_EMAIL)) {

    $ermsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
      </button>
              <strong>opps!</strong> Email in not valid try again
            </div>';
  } else if ($execute->num_rows == 1) {
    $ermsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
      </button>
              <strong>Opps!</strong> Email Already Exist
            </div>';
  } else if ($passwordlength < 6) {

    $ermsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
      </button>
              <strong>Success!</strong> Invalid password. Password must be at least 6 characters
            </div>';
  } else {
    $query = "insert into studentregister(`student_name`,`cource`,`student_email`,`student_password`,`phone`,`dob`,`gender`) 
        values('$student_name','$cource','$student_email','$hpassword','$phone','$dob','$gender')";

    $result = mysqli_query($conn, $query);
    if ($result == true) {

      $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
                <strong>Success!</strong> Account has been created successfully
              </div>';
    } else {

      $ermsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
</button>
        <strong>Opps!</strong> You are not Registred..Please Try again
      </div>';
    }
  }
}
$no_of_students = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM `studentregister`"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Student | Admin</title>
  <?php include('includes/header.php');  ?>

  <?php include('includes/nav.php');  ?>
  <?php include('includes/sidebar.php');  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Students</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Students</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- -------------content start------------------ -->

    <?php

    echo $ermsg;

    ?>
    <?php

    echo $msg;

    ?>

    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#myModal" style="float: right;">
      Add New
    </button>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add Student</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
              <input type="text" id="user-name" class="form-control" placeholder="Full name" name="student_name" autofocus="">
              <input type="email" id="user-email" class="form-control" placeholder="Email address" name="student_email" required autofocus="">
              <input type="password" id="user-pass" class="form-control" placeholder="Password" name="student_password" required autofocus="">

              <select name="cource" class="form-control">
                <option>Select Course</option>
                <?php
                $seclect = "select * from cource";
                $sel = mysqli_query($conn, $seclect);
                while ($row = mysqli_fetch_array($sel)) {
                  $cource_id = $row['cource_id'];
                  $cource = $row['cource'];
                ?>

                  <option value="<?php echo $cource; ?>">
                    <?php echo $cource; ?>
                  </option>
                <?php
                }
                ?>
              </select>

              <p>Gender : <label class="radio-inline">
                  <input type="radio" name="gender" value="male" checked="checked"> Male
                </label>
                <label class="radio-inline">
                  <input type="radio" name="gender" value="female"> Female
                </label>
              </p>

              <div class="form-group">
                <label for="dob">
                  <p>DOB :</p>
                </label>
                <input type="date" name="dob" class="form-control">
              </div>



            
            
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
          <button class="btn btn-primary" type="submit" name="register"><i class="fas fa-user-plus"></i> Add Student</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


          </div>
          </form>
        </div>
      </div>
    </div>

 
    <div class="container">
      <?php
      echo '<p style="font-weight: bold;" class="pt-2">Number of Students : ' . $no_of_students[0] . '</p>';
      ?>
      <table class="table table-bordered table-responsive animate__animated animate__fadeIn" align="center" id="search">
        <thead>
          <th>Roll No.</th>
          <th>Name</th>
          <th>Father Name</th>
          <th>Mother name</th>
          <th>Cource</th>
          <th>Email</th>
          <th>Phone</th>
          <th>DOB</th>
          <th>GENDER</th>
          <th>Image</th>
          <th>Address</th>
          <th>Operations</th>
        </thead>

        <?php

        $query = "SELECT * FROM studentregister ";
        $query_run = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($query_run)) {
$img=$row['img'];
        ?>

          <tr>

            <td>

              <?php echo $row['std_reg_id']; ?>
            </td>
            <td>

              <?php echo $row['student_name']; ?>
            </td>
            <td>
              <?php echo $row['fathername']; ?>
            </td>
            <td>

              <?php echo $row['mothername']; ?>
            </td>
            <td>

              <?php echo $row['cource']; ?>
            </td>
            <td>

              <?php echo $row['student_email']; ?>
            </td>
            <td>

              <?php echo $row['phone']; ?>
             

            </td>
            <td>

              <?php echo $row['dob']; ?>
            </td>
            <td>

              <?php echo $row['gender']; ?>
            </td>

            <td><img src="upload/<?php echo $img; ?>" width="100" height="100" /></td>
            <td>
              <?php echo $address; ?>
            </td>
            <td><a style="color: green" href="delete-student.php?dlt_stud=<?php echo $row["std_reg_id"]; ?>"><i class="fas fa-trash-alt"></i></a>
            </td>
          </tr>

        <?php
        } ?>
      </table>
    </div>
    <!-- -------------content end------------------ -->



    <?php include('includes/footer.php');  ?>