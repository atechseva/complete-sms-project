<?php
session_start();
include("../database/db.php");
error_reporting(0);
if ((!isset($_SESSION['admin_email'])) && (!isset($_SESSION['admin_password']))) {
  header('Location: ../admin-login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Branch | Admin</title>
  <?php include('includes/links.php'); ?>
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
            <h1 class="m-0">Branch</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Branch</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <?php
    if (isset($_REQUEST['addbranch'])) {
      $branch = $_REQUEST['branch'];
      $address = $_REQUEST['address'];
      $detail = $_REQUEST['detail'];
      $query = "insert into branch(`branch`,`address`,`detail`) values('$branch','$address','$detail')";
      $result = mysqli_query($conn, $query);
      if ($result) {
        echo '<script>alert("success");</script>';
      } else {
        echo '<script>alert("Something Went Wrong");</script>';
      }
    }
    ?>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#myModal" style="float: right;">
      Add New
    </button>
    <?php echo $msg; ?>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-md">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add Branch</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form action="" method="post" style="padding-top: 30px; padding-bottom: 30px;" class="animate__animated animate__fadeIn">

              <div class="form-group">
                <label>Branch</label>
                <input type="text" name="branch" class="form-control">
              </div>
              <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <label>Detail</label>
                <textarea name="detail" class="form-control"></textarea>
              </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button class="btn btn-primary" type="submit" name="addbranch"><i class="fas fa-user-plus"></i> Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <div class="container">
      <table class="table table-bordered table-responsive animate__animated animate__fadeIn" align="center" id="example" cellpadding="20" align="center">
        <thead>
          <th>Branch ID</th>
          <th>Branch Name</th>
          <th>Address</th>
          <th>Details</th>
          <th>Operation</th>
        </thead>
        <?php
        $query = "select * from branch";
        $sel = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($sel)) {
          $branch_id = $row['branch_id'];
          $branch = $row['branch'];
          $address = $row['address'];
          $detail = $row['detail'];
        ?>
          <tr>
            <td><?php echo $branch_id; ?></td>
            <td><?php echo $branch; ?></td>
            <td><?php echo $address; ?></td>
            <td><?php echo $detail; ?></td>
            <td><a style="color: red" href="delete-branch.php?branchid=<?php echo $row["branch_id"]; ?>"><i class="fas fa-trash-alt"></i></a>
              <a style="color: green" href="edit-student.php?edid=<?php echo $std_reg_id; ?>"><i class="fas fa-edit"></i></a>
            </td>
          </tr>
        <?php } ?>
      </table>
    </div>
    <!-- -------------content end------------------ -->
    <?php include('includes/footer.php'); ?>