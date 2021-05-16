<?php
session_start();
unset($_SESSION['student_email']);
unset($_SESSION['student_password']);
session_destroy();
header("location:../student-login.php?logout successfully.");

?>


