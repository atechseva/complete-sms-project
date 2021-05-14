<?php 
include("../database/db.php");
error_reporting(0);
ob_start();
session_start();
if((!isset($_SESSION['admin_email'])) && (!isset($_SESSION['admin_password']))){
header('Location: admin-login.php');
}
$no_of_students=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(*) FROM `studentregister`"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Student | Admin</title>
  <script type="text/javascript" charset="utf8"
    src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  <script>
    $(function () {
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
   
        <table class="table table-bordered table-responsive animate__animated animate__fadeIn" align="center"
          id="search">
          <thead>
            <th>Support Id</th>
            <th>Query</th>
            <th>Student Email</th>

            <th>Action</th>
            
          </thead>
          <?php
  $query="select * from support";
  $sel=mysqli_query($conn,$query);
  while($row=mysqli_fetch_array($sel))
  {
    $support_id=$row['support_id'];
    $support=$row['support'];
    $student_email=$row['student_email'];
   
?>

          <tr>

            <td>
              <?php echo $support_id; ?>
            </td>
            <td>
              <?php echo $support; ?>
            </td>
            <td>
              <?php echo $student_email; ?>
            </td>
           
            <td><a style="color: green" href="delete-support.php?supportid=<?php echo $row['support_id']; ?>"><i
                  class="fas fa-trash-alt"></i></a>
            </td>
          </tr>

          <?php
            } ?>
        </table>
      </div>

     


    <?php include('includes/footer.php');  ?>