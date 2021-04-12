<?php 
include("db.php");
error_reporting(0);
ob_start();
session_start();
if((!isset($_SESSION['email'])) && (!isset($_SESSION['password']))){
header('Location: student-login.php');
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Material</title>
    <?php include('includes/links.php');?>
    <link href="css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
</head>
<body>
    <div class="wrapper">
         <?php include('student_includes/sidebar.php');?>
        <div class="main-panel">
            <!-- Navbar -->
            <?php include('includes/nav.php');?>
            <!-- End Navbar -->
            

<!-- -------------content start------------------ -->

 <div class="container">
<table class="table table-bordered pt-5" align="center" id="example" >
    <thead>
    <th align="center">Cource</th>
     <th align="center">Decription</th>
     <th align="center">Download PDF</th>
</thead>
    <?php
    $query="select * from studymaterial WHERE cource = '$cource'";
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
 
<?php include('includes/footer.php');?>
</body>
</html>