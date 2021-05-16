<?php
session_start();
include("../database/db.php");
error_reporting(0);
if((!isset($_SESSION['student_email'])) && (!isset($_SESSION['student_password']))){
header('Location: ../student-login.php');
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Material</title>
    
    <?php include('includes/header.php');  ?>

<?php include('includes/nav.php');  ?>
<?php include('includes/sidebar.php');  ?>
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

 <div class="container">
<table class="table table-bordered pt-5" align="center" id="example" >
    <thead>
    <th align="center">Cource</th>
     <th align="center">Decription</th>
     <th align="center">Download PDF</th>
</thead>
    <?php
    
    $query="SELECT * FROM studymaterial JOIN studentregister ON studentregister.cource=studymaterial.cource";

    $sel=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($sel))
    {
        $study_mat_id=$row['study_mat_id'];
    ?>
   <tr>
    <td><?php echo $row['cource']; ?></td>
    <td><?php echo $row['description']; ?></td>
    <td><a href="upload/<?php echo $pdf; ?>" download="<?php echo $row['cource']; ?>">Click Here<i class="icofont-file-pdf"></i></a></td>
      
    </tr>
  <?php
  }
  ?>  
    
    </table>
    </div>   
 
    <?php include('includes/footer.php');  ?>