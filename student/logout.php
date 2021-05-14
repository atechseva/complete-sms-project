<?php
session_start();
include("../database/db.php");
unset($_SESSION['student_email']);
session_destroy();
header("location:../index.php?logout successfully.");

?>


