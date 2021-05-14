<?php 
ob_start();
session_start();
if((!isset($_SESSION['email'])) && (!isset($_SESSION['password']))){
header('Location: admin-login.php');
}
include("db.php");
error_reporting(0);
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include('includes/links.php');?>
    <link href="css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <style type="text/css">
        .dash [class^="icofont-"]{font-size: 100px;
            color: white;}
        .dash a{color: #292C2D;}
        .card{border: 10px white solid !important;
        }    
    </style>
</head>
<body>
    <div class="wrapper">
         <?php include('includes/sidebar.php');?>
        <div class="main-panel">
            <!-- Navbar -->
            <?php include('includes/nav.php');?>
            <!-- End Navbar -->
            

<!-- -------------content start------------------ -->
<section class="dash container"><div class="card-group">
  <div class="card" style="background: greenyellow;">
    <div class="card-body text-center">
     <a href="view-student.php"> 
     <i class="icofont-eye-alt"></i>
     <h4>View Student</h4>
     </a>  
    </div>
  </div>
  <div class="card" style="background: aquamarine;">
   <div class="card-body text-center">
    <a href="add-student.php"> 
    <i class="icofont-contact-add"></i>
     <h4>Add Student</h4>
    </a>
    </div>
  </div>
  <div class="card" style="background: coral;">
<div class="card-body text-center">
      <a href="search-student.php"> 
     <i class="icofont-search-user"></i>
     <h4>Search Student</h4>
     </a>
    </div>  </div>
 
</div>

</section>

<section class="dash container"><div class="card-group">
  
  
  <div class="card bg-success">
<div class="card-body text-center">
    <a href="branch.php"> 
    <i class="icofont-people"></i>
     <h4>Branch</h4>
    </a>
    </div>  </div>
    <div class="card bg-danger">
<div class="card-body text-center">
    <a href="delete-student-by-roll.php"> 
    <i class="icofont-people"></i>
     <h4>Delete Student</h4>
    </a>
    </div>  </div>
  
</div>

</section>

<section class="dash container">
    <div class="card-group">

    <div class="card" style="background: coral;">
    <div class="card-body text-center">
    <a href="add-study-material.php"> 
     <i class="icofont-book"></i>
     <h4>Study Material</h4>
     </a>
    </div>
    </div>
    <div class="card" style="background: #bb3461;">
    <div class="card-body text-center">
    <a href="add-notice.php"> 
     <i class="icofont-notification"></i>
     <h4>Add Notice</h4>
     </a>
    </div>
</div>
   
</div>
</section>





<!-- -------------content end------------------ -->
<?php include('includes/footer.php');?>
</body>
</html>