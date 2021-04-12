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
    <title>Branch | Admin</title>
    <?php include('includes/links.php');?>
    <link href="css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
</head>
<body>
    <div class="wrapper">
         <?php include('includes/sidebar.php');?>
        <div class="main-panel">
        <?php include('includes/nav.php');?>
<!--------Branch------>
<?php
if(isset($_REQUEST['addbranch']))
{
$branch=$_REQUEST['branch'];
$address=$_REQUEST['address'];
$detail=$_REQUEST['detail'];
$query="insert into branch(`branch`,`address`,`detail`) values('$branch','$address','$detail')";
$result = mysqli_query($conn,$query);
if($result){
    echo '<script>alert("success");</script>';
}
else {
    echo '<script>alert("Something Went Wrong");</script>';
}
}
?>
<?php
if(isset($_POST['addnewbranch']))
{
?>
<div class="container">
<fieldset class="scheduler-border">
    <legend class="scheduler-border">ADD BRANCH</legend>
    <form action=""  method="post" style="padding-top: 30px; padding-bottom: 30px;" class="animate__animated animate__fadeIn">
               
               <table class="table-responsive">
                 <tr>
                 <td>Branch</td>
                 <td><input type="text" value="" name="branch" placeholder="Branch Name"></td>
                 </tr>
                 <tr>
                 <td>Address</td>
                 <td><textarea name="address" id="" cols="20" rows="3" placeholder="Enter Branch Address here..."></textarea></td>
                 </tr>
                 <tr>
                 <td>Detail</td>
                 <td><textarea name="detail" id="" cols="20" rows="3" placeholder="Enter Details here..."></textarea></td>
                 </tr>
                 <tr>
                 <td><input type="submit" value="Add branch" name="addbranch" class="btn btn-primary"></td>
                 </tr>
                 </table>
                 </form>  
</fieldset>

  </div>
<?php
}
?>
<div class="container">              
<table class="table table-bordered table-responsive animate__animated animate__fadeIn" align="center" id="example" cellpadding="20" align="center">

    <h1>Branch
     <?php echo'<form action="" method="post" align="right"><input type="submit"  value="Add branch" name="addnewbranch" style="font-size: 15px; margin-bottom: 30px;position: absolute;float: right; right: 20px;top: 110px;background: greenyellow;border: none;padding: 10px;">
    </form> '; ?> 
    </h1>
    <thead>
     <th>Branch ID</th>
     <th>Branch Name</th>
     <th>Address</th>
     <th>Details</th>
     <th>Operation</th>
    </thead>
    <?php
  $query="select * from branch";
  $sel=mysqli_query($conn,$query);
  while($row=mysqli_fetch_array($sel))
  {
    $branch_id=$row['branch_id'];
    $branch=$row['branch'];
    $address=$row['address'];
    $detail=$row['detail'];
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
<?php include('includes/footer.php');?>
</body>
</html>