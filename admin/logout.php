<?php
session_start();
include("db.php");
unset($_SESSION['email']);
session_destroy();
header("location:index.php?logout successfully.");
?> 

