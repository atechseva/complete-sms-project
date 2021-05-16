<?php
session_start();
include("../database/db.php");
error_reporting(0);
if ((!isset($_SESSION['admin_email'])) && (!isset($_SESSION['admin_password']))) {
  header('Location: ../admin-login.php');
}
?>
<?php
if (isset($_REQUEST['addstudymaterial'])) {
  $msg="";
  $cource = $_REQUEST['cource'];
  $description = $_REQUEST['description'];
  $pdf = $_FILES['pdf']['name'];
  $location = "upload/" . $pdf;
  copy($_FILES['pdf']['tmp_name'], $location);
  $query = "insert into studymaterial(`cource`,`description`,`pdf`) values('$cource','$description','$pdf')";
  $result = mysqli_query($conn, $query);
  if ($result) {
  
 $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
        <strong>Success!</strong> New Material Added
              </div>';
  } else {
  
$msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
        <strong>Failed!</strong> Something Went Wrong.
              </div>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Study Material | Admin</title>
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
            <h1 class="m-0">Study Material</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Study Material</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>









    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#myModal" style="float: right;">
      Add New
    </button>
    <?php echo $msg; ?>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-md">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add Study Material</h4>
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
                    $id = $row['cource_id'];
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
                <label>PDF</label>
                <input type="file" name="pdf" class="form-control">
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
              </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">

            <button class="btn btn-primary" type="submit" name="addstudymaterial"><i class="fas fa-user-plus"></i> Add Now</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


          </div>
          </form>
        </div>
      </div>
    </div>


    <div class="container">
      <table class="table table-bordered pt-5" id="search">
        <thead>
          <th align="center">Cource</th>
          <th align="center">Decription</th>
          <th align="center">Download PDF</th>
          <th align="center">Operation</th>
        </thead>
        <?php
        $query = "select * from studymaterial";
        $sel = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($sel)) {
          $study_mat_id = $row['study_mat_id'];
          $pdf = $row['pdf'];
        ?>

          <tr>
            <td>
              <?php echo $row['cource']; ?>
            </td>
            <td>
              <?php echo $row['description']; ?>
            </td>
            <td><a href="upload/<?php echo $pdf; ?>" download="<?php echo $row['cource']; ?>">Click Here<i class="icofont-file-pdf"></i></a></td>
            <td><a href="delete-study-material.php?delid=<?php echo $study_mat_id; ?>">Delete</a></td>
          </tr>
        <?php
        } ?>
      </table>
    </div>




    <!-- -------------content end------------------ -->
    <?php include('includes/footer.php'); ?>