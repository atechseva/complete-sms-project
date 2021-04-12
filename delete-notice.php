<?php
include("db.php");
error_reporting(0);
$delete = "delete from notice WHERE notice_id='" . $_GET["noticeid"] . "' ";
$result = mysqli_query($conn,$delete);
if($result) {
	header('location:add-notice.php');
}
else 
{
header('location:branch.php');
}
?>







