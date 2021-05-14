<?php
  session_start();
  include("../database/db.php");
error_reporting(0);
if((!isset($_SESSION['admin_email'])) && (!isset($_SESSION['admin_password']))){
    header('Location: ../admin-login.php');
    }
  $no_of_students = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM `studentregister`"));
  $no_of_cource = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM `cource`"));
  $no_of_sm = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM `studymaterial`"));

  $no_of_notice = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM `notice`"));

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>

  <?php include('includes/header.php');  ?>

  <?php include('includes/nav.php');  ?>
  <?php include('includes/sidebar.php');  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $no_of_cource[0]; ?></h3>

                <p>Cource</p>
              </div>
              <div class="icon">
                <i class="fas fa-graduation-cap"></i>
              </div>
              <a href="cource.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $no_of_students[0]; ?></h3>

                <p>Students</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="students.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <h3><?php echo $no_of_notice[0]; ?></h3>

                <p>Notice</p>
              </div>
              <div class="icon">
                <i class="fas fa-bell"></i>
              </div>
              <a href="notice.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>

          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $no_of_sm[0]; ?></h3>

                <p>Study Material</p>
              </div>
              <div class="icon">
                <i class="fas fa-book"></i>
              </div>
              <a href="study-material.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

      </div></section>

    


    <?php include('includes/footer.php');  ?>