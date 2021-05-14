<?php
include("../database/db.php");
error_reporting(0);
$delete = "delete from notice WHERE notice_id='" . $_GET["noticeid"] . "' ";
$result = mysqli_query($conn,$delete);
if($result) {
	$dlt_notice="";
	$dlt_notice= '<div class="alert alert-warning alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
	</button>
			<strong>Success!</strong> Notice Deleted
		  </div>';
	header('location:notice.php');
	
	
}
else 
{
header('location:branch.php');
}
?>







