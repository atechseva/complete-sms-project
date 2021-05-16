<?php
session_start();
unset($_SESSION['admin_email']);
unset($_SESSION['admin_password']);

session_destroy();
header("location:../admin-login.php?logout successfully.");

?>


