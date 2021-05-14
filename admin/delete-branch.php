
<?php
include("../database/db.php");
error_reporting(0);
$del=$_GET['branchid'];
$delete = "delete from branch where branch_id = $del";
$result = mysqli_query($conn,$delete);
if($result) {
header('location:branch.php');
}
else 
{
echo "Error in deletion";
}
?>









