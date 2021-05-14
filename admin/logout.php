<?php
session_start();
include("../database/db.php");
unset($_SESSION['admin_email']);
session_destroy();
header("location:../index.php?logout successfully.");

?>


