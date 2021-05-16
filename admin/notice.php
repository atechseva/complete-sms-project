<?php
session_start();
include("../database/db.php");
error_reporting(0);
if ((!isset($_SESSION['admin_email'])) && (!isset($_SESSION['admin_password']))) {
  header('Location: ../admin-login.php');
}
include("db.php");
error_reporting(0);
if (isset($_REQUEST['add_notice'])) {
  $msg = "";
  $cource = $_REQUEST['cource'];
  $notice_title = $_REQUEST['notice_title'];
  $notice_description = $_REQUEST['notice_description'];
  $address = $_REQUEST['address'];
  $query = "insert into notice(`cource`,`notice_title`,`notice_description`) values('$cource','$notice_title','$notice_description')";
  $result = mysqli_query($conn, $query);
  if ($result) {
   
    $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
                <strong>Success!</strong> New Notice Added
              </div>';
  } else {

    $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
                <strong>Failed!</strong> Error Something Went Erong
              </div>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
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
            <h1 class="m-0">Notice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Notice</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#myModal" style="float: right;">
      Add New
    </button>
    <?php echo $msg; ?>
    <?php echo $dlt_notice; ?>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-md">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add New Notice</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form action="" method="post" style="padding-top: 30px; padding-bottom: 30px;" class="animate__animated animate__fadeIn">
              <div class="form-group">
                <label>Cource</label>
                <select name="cource" class="form-control">
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
              </div>
              <div class="form-group">
                <label>Title</label>
                <input type="text" name="notice_title" class="form-control">
              </div>

              <div class="form-group">
                <label>Description</label>
                <input type="text" name="notice_description" class="form-control">
              </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">

            <button class="btn btn-primary" type="submit" name="add_notice"><i class="fas fa-user-plus"></i> Add Notice</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


          </div>
          </form>
        </div>
      </div>
    </div>

    <section class="pt-5 pb-5">
      <div class="container">
        <table class="table table-bordered" align="center" id="example">
          <thead>
            <th>Cource</th>
            <th>Notice Title</th>
            <th>Notice Description</th>
            <th>Date</th>
            <th>Delete</th>
            <?php
            $query = "select * from notice";
            $sel = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($sel)) {
              $id = $row['notice_id'];
              $cource = $row['cource'];
              $notice_title = $row['notice_title'];
              $notice_description = $row['notice_description'];
              $date = $row['date'];

            ?>
              <tr>
                <td>
                  <?php echo $cource; ?>
                </td>
                <td>
                  <?php echo $notice_title; ?>
                </td>
                <td>
                  <?php echo $notice_description; ?>
                </td>
                <td><?php  echo $row['date']; ?></td>
                <td><a href="delete-notice.php?noticeid=<?php echo $id; ?>">Delete</a></td>
              </tr>
            <?php
            }
            ?>
        </table>
      </div>
    </section>
























    <!-- -------------content end------------------ -->
    <?php include('includes/footer.php'); ?>