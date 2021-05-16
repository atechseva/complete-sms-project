<?php
session_start();
include("../database/db.php");
error_reporting(0);
if ((!isset($_SESSION['student_email'])) && (!isset($_SESSION['student_password']))) {
    header('Location: ../student-login.php');
}
if (isset($_REQUEST['submitsupport'])) {
    $msg = "";

    $student_email = $_REQUEST['student_email'];
    $support = $_REQUEST['support'];
    $query = "insert into support(`support`,`student_email`) 
    values('$support','$student_email')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
      </button>
        <strong>Success!</strong> Our Team will reply you soon !
      </div>';
        } else {
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
      </button>
  <strong>Failed!</strong> Something Went Wrong.
</div>';
        }
    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include('includes/header.php');  ?>

    <?php include('includes/nav.php');  ?>
    <?php include('includes/sidebar.php');  ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Support</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>



        <?php echo $msg; ?>

        <div class="container">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">

                    <input type="hidden" name="student_email" value="<?php echo $_SESSION['student_email'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">

                    <input type="text" name="support" placeholder="write your query here..." class="form-control">
                </div>


                <input type="submit" value="Submit" name="submitsupport" class="btn btn-primary">

            </form>
            </div>


            <?php

$query = "SELECT * FROM support_answer JOIN support ON support_answer.support_id = support.support_id ORDER BY support_answer.answer_id DESC ";
$query_run = mysqli_query($conn, $query);
$i = 1;


while ($row = mysqli_fetch_assoc($query_run)) {

?>
<div class="container">
    <table class="table table-bordered  table-hover animate__animated animate__fadeIn mt-5">
                <thead class="thead-light">
                    <tr>
                        <th>Date</th>
                        <th>Your Query</th>

                        <th>Answer</th>
                        <th>Status</th>
                       
                      
                    </tr>
                </thead>
    <tr>
       <td><?php echo $row['date']; ?></td>
       <td><?php echo $row['support']; ?></td>

        <td><?php echo $row['answer']; ?></td>
        <td class="text-success">Done</td>

    </tr>
    </table>
</div>
    <?php } ?>










            <?php include('includes/footer.php');  ?>