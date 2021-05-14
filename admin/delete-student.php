<?php
include("../database/db.php");
error_reporting(0);
$del=$_GET['dlt_stud'];
$delete = "delete from studentregister where std_reg_id = $del";
$result = mysqli_query($conn,$delete);
if($result) {
header('location:students.php');
}
else 
{
echo "Error in deletion";
}
?>

