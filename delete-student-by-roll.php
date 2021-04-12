<?php 
ob_start();
session_start();
include("db.php");
error_reporting(0);

if((!isset($_SESSION['email'])) && (!isset($_SESSION['password']))){
header('Location: admin-login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Student| Admin</title>
  <?php include('includes/links.php');?>
  <style>

  </style>
  <link href="css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
</head>

<body>
  <div class="wrapper">
    <?php include('includes/sidebar.php');?>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include('includes/nav.php');?>
      <!-- End Navbar -->


      <!-- -------------content start------------------ -->
      <form action="" height=500px; method="post" style="padding-top: 30px; padding-bottom: 30px;"
        class="animate__animated animate__fadeIn">
        <table style=" border: cornflowerblue 1px solid; border-width: 8px" cellpadding="20" align="center">
          <tr>
            <td><strong>Enter Roll No.</strong></td>
            <td><input type="text" name="std_reg_id"></td>
          </tr>
          <tr>
            <td colspan="2" style="text-align: center;"><a
                style="background-color: greenyellow;font-weight: bold;border: none;border-radius: 5px; padding: 5px 20px 5px 20px; color: black;"
                href="" data-toggle="modal" data-target="#deleteModal">Delete</a></td>
          </tr>
        </table>
      </form>
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete this student !</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-footer">
              <form method="post" action="">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" name="delete_now" value="Delete Now" class="btn btn-primary">
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php
 if(isset($_POST['delete_now'])) {

$query = "delete from studentregister WHERE std_reg_id = $_POST[std_reg_id]";
$query_run = mysqli_query($conn,$query);
if($query_run)
{
  echo '<div class="alert alert-success">Student Deleted Successfully</div>';
}
else{
  echo '<div class="alert alert-danger">Error In Deletion</div>';
}
}
?>
      <!-- -------------content end------------------ -->
<?php include('includes/footer.php');?>
</body>

</html>