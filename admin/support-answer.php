<?php
include("../database/db.php");
error_reporting(0);
ob_start();
session_start();
if ((!isset($_SESSION['admin_email'])) && (!isset($_SESSION['admin_password']))) {
  header('Location: admin-login.php');
}

if(isset($_REQUEST['submit']))
{
  $support_id = $_REQUEST['support_id'];
  $student_email = $_REQUEST['student_email'];
  $answer = $_REQUEST['answer'];

  $sql="INSERT INTO support_answer(`support_id`,`student_email`,`answer`) VALUES('$support_id','$student_email','$answer')";
 $result=mysqli_query($conn,$sql);
 if ($result) {
  
  $_SESSION['$msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
         </button>
         <strong>Success!</strong> Thanks For your Valuable Support
               </div>';
               header('location:support.php');
   } else {
   
 $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
         </button>
         <strong>Failed!</strong> Something Went Wrong.
               </div>';
   }
}

$answer = $_GET['support_answer'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Support Answer | Admin</title>
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  <script>
    $(function() {
      $("#search").dataTable();
    })
  </script>
  <style>
    .dataTables_filter {
      right: 0 !important;
      padding: 10px;
    }
  </style>

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
            <h1 class="m-0">Support</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->




    <div class="container">
      <form action="" method="post" enctype="multipart/form-data" class="pt-1 pb-5 animate__animated animate__fadeIn">

        <?php echo $msg; ?>
        <table align="center" class="table-responsive" cellpadding="12" style="background-color:#dce8ff; padding:20px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);font-weight: bold;">
          <?php
          $fetchdata = "SELECT * FROM support WHERE support_id=$answer";
          $records = mysqli_query($conn, $fetchdata);

          while ($data = mysqli_fetch_array($records, MYSQLI_ASSOC)) {
          ?>
           <tr>
              <td>Support ID:</td>
              <td><input type="text" name="support_id" value="<?php echo $data["support_id"]; ?>" readonly> </td>

            </tr>
            <tr>
              <td>Query:</td>
              <td><input type="text" name="support" value="<?php echo $data["support"]; ?>" readonly></td>

            </tr>
            <tr>
              <td>Student's Email:</td>
              <td><input type="text" name="student_email" value="<?php echo $data["student_email"]; ?>" readonly></td>
            </tr>
            <tr>
              <td>Answer:</td>
              <td> <textarea name="answer" class="form-control"></textarea> </td>
            </tr>
            <tr align="center">
              <td colspan="1"><input type="submit" value="DONE" name="submit" class="btn btn-primary"></td>
             </tr>
          <?php
          }
          ?>
        </table>

      </form>

    </div>

    <?php include('includes/footer.php');  ?>