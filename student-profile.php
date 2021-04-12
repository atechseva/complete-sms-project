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
    <title>Student Profile</title>
    <?php include('includes/links.php');?>
    <link href="css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <?php include('student_includes/sidebar.php');?>
        <div class="main-panel">

            <?php include('includes/nav.php');?>


            <?php

    $select="select * from studentregister where email = '$_SESSION[email]'";

    $adminresult=mysqli_query($conn,$select);
            while ($row = mysqli_fetch_assoc($adminresult)) 
            { ?>




<div class="container">
<div class="row d-flex justify-content-center align-items-center">
                   
<div class="col-md-4">
    <img src="upload/<?php echo  $row['img']?>" width="200px;">
</div>
    <div class="col-md-4">
        
        <table align="center">
            <tr>
                <td>
                    <b>Roll No:</b>
                </td>
                <td>
                    <input type="text" name="std_reg_id" value="<?php echo $row['std_reg_id']?>" disabled>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Name:</b>
                </td>
                <td>
                    <input type="text" name="name" value="<?php echo $row['name']?>" disabled>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Father's Name:</b>
                </td>
                <td>
                    <input type="text" name="fathername" value="<?php echo $row['fathername']?>" disabled>
                </td>
            </tr>
            <tr>
            <tr>
                <td>
                    <b>Mother's Name:</b>
                </td>
                <td>
                    <input type="text" name="mothername" value="<?php echo $row['mothername']?>" disabled>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Class:</b>
                </td>
                <td>
                    <input type="text" name="class" value="<?php echo $row['cource']?>" disabled>
                </td>
            </tr>
            
            <tr>
                <td>
                    <b>Email:</b>
                </td>
                <td>
                    <input type="text" name="email" value="<?php echo $row['email']?>" disabled>
                </td>
            </tr>
            <tr>
                
            </tr>
            <tr>
                <td>
                    <b>Phone:</b>
                </td>
                <td>
                    <input type="text" name="phone" value="<?php echo $row['phone']?>" disabled>
                </td>
            </tr>

            <tr>
                <td>
                    <b>D.O.B</b>
                </td>
                <td>
                    <input type="text" name="dob" value="<?php echo $row['dob']?>" disabled>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Gender:</b>
                </td>
                <td>
                    <input type="text" name="gender" value="<?php echo $row['gender']?>" disabled>
                </td>
            </tr>

            <tr>
                <td>
                    <b>Address:</b>
                </td>
                <td>
                    <textarea rows="3" cols="40" name="address" disabled><?php echo $row['address']?></textarea>
                </td>
            </tr><br>

        </table>
    </div>
</div>
</div>















            <?php
                }


        ?>
            <!-- -------------content end------------------ -->
            <?php include('includes/footer.php');?>
</body>

</html>