<?php
include("../database/db.php");
error_reporting(0);
$delete = "delete from cource WHERE cource_id='" . $_GET["courceid"] . "' ";
$result = mysqli_query($conn,$delete);
if($result) {
	header('location:cource.php');
}
else 
{
header('location:branch.php');
}
?>







