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
            <h1 class="m-0">Cource</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cource</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <?php
    if (isset($_REQUEST['addcource'])) {
      $msg="";
      $cource = $_REQUEST['cource'];

      $query = "insert into cource(`cource`) values('$cource')";
      $result = mysqli_query($conn, $query);
      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
                <strong>Success!</strong> New Cource Added
              </div>';
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
                <strong>Failed!</strong> Something Went Wrong
              </div>';
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
            <h4 class="modal-title">Add New Cource</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form action="" method="post" style="padding-top: 30px; padding-bottom: 30px;" class="animate__animated animate__fadeIn">
              <div class="form-group">
                <label>Cource</label>
                <input type="password" name="cource" class="form-control">
              </div>

              

              </div>

          <!-- Modal footer -->
          <div class="modal-footer">
           
            <button class="btn btn-primary" type="submit" name="addcource"><i class="fas fa-user-plus"></i> Add Cource</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


          </div>
          </form>
        </div>
      </div>
    </div>











    <div class="container">
      <table class="table table-bordered table-responsive animate__animated animate__fadeIn" align="center" id="example" cellpadding="20" align="center">

        <thead>
          <th>Cource ID</th>
          <th>Cource Name</th>
          <th>Action</th>
        </thead>
        <?php
        $query = "select * from cource";
        $sel = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($sel)) {
          $cource_id = $row['cource_id'];
          $cource = $row['cource'];

        ?>
          <tr>
            <td><?php echo $cource_id; ?></td>
            <td><?php echo $cource; ?></td>

            <td><a style="color: red" href="delete-cource.php?courceid=<?php echo $row["cource_id"]; ?>"><i class="fas fa-trash-alt"></i></a>
              <a style="color: green" href="edit-student.php?edid=<?php echo $std_reg_id; ?>"><i class="fas fa-edit"></i></a>
            </td>
          </tr>
        <?php } ?>
      </table>
    </div>
    <!-- -------------content end------------------ -->
    <?php include('includes/footer.php'); ?>
    </body>

</html>