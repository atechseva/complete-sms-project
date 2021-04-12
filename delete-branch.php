<?php
include("db.php");
error_reporting(0);
$delete = "delete from branch WHERE branch_id='" . $_GET["branchid"] . "' ";
$result = mysqli_query($conn,$delete);
if($result) {
	header('location:branch.php');
}
else 
{
header('location:branch.php');
}
?>







