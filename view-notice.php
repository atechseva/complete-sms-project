<?php 
ob_start();
session_start();
if((!isset($_SESSION['email'])) && (!isset($_SESSION['password']))){
header('Location: student-login.php');
}
include("db.php");
error_reporting(0);
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include('includes/links.php');?>
    <link href="css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
</head>
<body>
    <div class="wrapper">
         <?php include('student_includes/sidebar.php');?>
        <div class="main-panel">
          <?php include('includes/nav.php');?>
            

<section class="pt-5 pb-5" style="background-color: lightblue;">
  <div class="container">
<table class="table table-bordered" align="center" id="example" >
    <thead>
     <th>Cource</th>
     <th>Notice Title</th>
     <th>Notice Description</th>
      <th>Date</th>
      

    <?php
  $query="select * from notice WHERE cource = '$cource'";
 
  $sel=mysqli_query($conn,$query);
  while($row=mysqli_fetch_array($sel))
  {
    $id=$row['notice_id'];
    $cource=$row['cource'];
    $notice_title=$row['notice_title'];
    $notice_description=$row['notice_description'];
    $date=$row['date'];
    ?>
    <tr>
      <td><?php echo $cource; ?> <span style="background: yellow; padding: 2px 10px;border: 1px red dashed;color: red; font-size: 10px;">NEW</span></td>
        <td><?php echo $notice_title; ?></td>
        <td><?php echo $notice_description; ?></td>
        <td><?php  echo $row['date']; ?></td>
      </tr>
  <?php
  }     
  ?>
</table>   
</div>
</section>
<?php include('includes/footer.php');?>
</body>
</html>