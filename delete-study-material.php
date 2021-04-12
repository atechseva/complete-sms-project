
<?php
include("db.php");
error_reporting(0);
$del=$_GET['delid'];
$delete = "delete from studymaterial where study_mat_id = $del";
$result = mysqli_query($conn,$delete);
if($result) {
header("add-study-material.php?deleted");
}
else 
{
header("add-study-material.php");
}
?>







