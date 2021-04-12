<?php 
include("db.php");
error_reporting(0);
ob_start();
session_start();
if((!isset($_SESSION['email'])) && (!isset($_SESSION['password']))){
header('Location: student-login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard</title>
  <?php include('includes/links.php');?>
  <link href="css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
  <style type="text/css">
    .dash [class^="icofont-"] {
      font-size: 100px;
      color: white;
    }

    .dash a {
      color: #292C2D;
    }

    .card {
      border: 10px white solid !important;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <?php include('student_includes/sidebar.php');?>
    <div class="main-panel">

      <?php include('includes/nav.php');?>
      <section class="dash container">
        <div class="card-group">

          <div class="card" style="background: greenyellow;">
            <div class="card-body text-center">
              <a href="student-profile.php">
                <i class="icofont-eye-alt"></i>
                <h4>Profile</h4>
              </a>
            </div>
          </div>
          <div class="card" style="background: aquamarine;">
            <div class="card-body text-center">
              <a href="edit-student-profile.php">
                <i class="icofont-contact-add"></i>
                <h4>Edit Profile</h4>
              </a>
            </div>
          </div>
          <div class="card bg-primary">
            <div class="card-body text-center">
              <a href="" href="#" data-toggle="modal" data-target="#resultModal">
                <i class="icofont-bullseye"></i>
                <h4>Result</h4>
              </a>
            </div>
          </div>
          
        </div>

      </section>

      <section class="dash container">
        <div class="card-group">

          

          <div class="card" style="background: #bb3461;">
            <div class="card-body text-center">
              <a href="view-notice.php">
                <i class="icofont-notification"></i>
                <h4>Notice</h4>
              </a>
            </div>
          </div>

          <div class="card" style="background: coral;">
            <div class="card-body text-center">
              <a href="student-study-material.php">
                <i class="icofont-book"></i>
                <h4>Study Material</h4>
              </a>
            </div>
          </div>
        </div>
      </section>
      <?php include('includes/footer.php');?>
</body>

</html>