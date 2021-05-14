<?php
include("../database/db.php");
error_reporting(0);
$delete = "delete from support WHERE support_id='" . $_GET["supportid"] . "' ";
$result = mysqli_query($conn,$delete);
if($result) {
	header('location:support.php');
}
else 
{
header('location:branch.php');
}
?>







