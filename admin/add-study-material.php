<?php 
include("db.php");
error_reporting(0);
ob_start();
session_start();
if((!isset($_SESSION['email'])) && (!isset($_SESSION['password']))){
header('Location: admin-login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Study Material | Admin</title>
  <?php include('includes/links.php');?>
  <link href="css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
  
</head>

<body>
  <div class="wrapper">
    <?php include('includes/sidebar.php');?>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include('includes/nav.php');?>
      <!-- End Navbar -->
      <?php
if(isset($_REQUEST['addstudymaterial']))
{
$cource=$_REQUEST['cource'];
$description=$_REQUEST['description'];
$pdf=$_FILES['pdf']['name'];
$location="upload/".$pdf;
copy($_FILES['pdf']['tmp_name'], $location);
$query="insert into studymaterial(`cource`,`description`,`pdf`) values('$cource','$description','$pdf')";
$result = mysqli_query($conn, $query);
if($result){
  echo '<div class="alert alert-success" style="margin-bottom: 0;"><img src="img/thankyou.gif" width="50" align="center">
   <strong>Success!</strong> New Material Added
 </div>';
}
else {
  echo '<div class="alert alert-danger">
  <strong>Failed!</strong> Something Went Wrong.
</div>';
}
}
?>
      <!-- ---------------view study material-------------- -->
      <?php
if(isset($_POST['viewstudymaterial']))
{   
    ?>
      <div class="container">
        <table class="table table-bordered pt-5" id="example">
          <thead>
            <th align="center">Cource</th>
            <th align="center">Decription</th>
            <th align="center">Download PDF</th>
            <th align="center">Operation</th>
          </thead>
          <?php
           $query="select * from studymaterial";
           $sel=mysqli_query($conn,$query);
           while($row=mysqli_fetch_array($sel))
           {
            $study_mat_id=$row['study_mat_id'];
            $pdf=$row['pdf'];
           ?>

          <tr>
            <td>
              <?php echo $row['cource']; ?>
            </td>
            <td>
              <?php echo $row['description']; ?>
            </td>
            <td><a href="upload/<?php echo $pdf; ?>" download="<?php echo $row['cource']; ?>">Click Here<i
                  class="icofont-file-pdf"></i></a></td>
            <td><a href="delete-study-material.php?delid=<?php echo $study_mat_id; ?>">Delete</a></td>
          </tr>
          <?php
  } ?>
        </table>
      </div>
      <?php
  } ?>

      <div class="container">
      <fieldset class="scheduler-border">
    <legend class="scheduler-border">Study Material</legend> <h3>
              <?php echo'<form action="" method="post" align="right"><input type="submit"  value="View Study Material" name="viewstudymaterial" style="font-size: 15px; margin-bottom: 30px;position: absolute;float: right; right: 20px;background: greenyellow;border: none;padding: 10px;">
    </form> '; ?>
            </h3>
    <form enctype="multipart/form-data" class="pt-5 pb-5" method="post" class="animate__animated animate__fadeIn">
          <table cellpadding="20" align="center">
           
            <tr>
              <td>Class</td>
              <td>
                <select name="cource">
                  <?php
      $seclect="select * from cource";
      $sel=mysqli_query($conn,$seclect);
      while($row=mysqli_fetch_array($sel))
      {
        $id=$row['cource_id'];
        $cource=$row['cource'];
      ?>
                  <option value="<?php echo $cource; ?>">
                    <?php echo $cource; ?>
                  </option>
                  <?php 
      }
      ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Description</td>
              <td><textarea name="description" id="" cols="20" rows="5"></textarea></td>
            </tr>
            <tr>
              <td>PDF</td>
              <td><input type="file" name="pdf" id=""></td>
            </tr>
            <tr>
              <td></td>
              <td><input class="submit_color" type="submit" name="addstudymaterial" id="" value="Add Study Material">
              </td>
            </tr>
          </table>
        </form>
      </fieldset>
        
      </div>
      <!-- -------------content end------------------ -->
      <?php include('includes/footer.php');?>
</body>

</html>