<?php
include("../database/db.php");
error_reporting(0);
ob_start();
session_start();
if ((!isset($_SESSION['student_email'])) && (!isset($_SESSION['student_password']))) {
    header('Location: student-login.php');
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
                        <h1 class="m-0">Profile</h1>
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



        <section class="pt-5 pb-5">
            <div class="container">
                <table class="table table-bordered" align="center" id="example">
                    <thead>
                        <th>Cource</th>
                        <th>Notice Title</th>
                        <th>Notice Description</th>
                        <th>Date</th>


                        <?php
                        $query = "SELECT * FROM notice WHERE cource = '$cource'";

                        $sel = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($sel)) {
                            $id = $row['notice_id'];
                            $cource = $row['cource'];
                            $notice_title = $row['notice_title'];
                            $notice_description = $row['notice_description'];
                            $date = $row['date'];
                        ?>
                            <tr>
                                <td><?php echo $cource; ?> <span style="background: yellow; padding: 2px 10px;border: 1px red dashed;color: red; font-size: 10px;">NEW</span></td>
                                <td><?php echo $notice_title; ?></td>
                                <td><?php echo $notice_description; ?></td>
                                <td><?php echo $row['date']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                </table>
            </div>
        </section>
        <?php include('includes/footer.php');  ?>