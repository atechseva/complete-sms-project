<?php 
include("db.php");
error_reporting(0);
ob_start();
session_start();
if((!isset($_SESSION['email'])) && (!isset($_SESSION['password']))){
header('Location: admin-login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Student | Admin</title>
    <?php include('includes/links.php');?>
    <link href="css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <?php include('includes/sidebar.php');?>
        <div class="main-panel">

            <?php include('includes/nav.php');?>



            <form action="" height=500px; method="post" style="padding-top: 30px; padding-bottom: 30px;"
                class="animate__animated animate__fadeIn">

                <table style=" border: cornflowerblue 1px solid; border-width: 8px" cellpadding="20" align="center">
                    <tr>
                        <td><strong>Enter Roll No.</strong></td>
                        <td><input type="text" name="std_reg_id"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;"><input type="submit" name="search_by_roll_no"
                                value="Search Student"
                                style="background-color: greenyellow;font-weight: bold;border: none;border-radius: 5px;padding: 5px 20px 5px 20px;">
                        </td>
                    </tr>
                </table>

            </form>

            <?php
  
   if(isset($_POST['search_by_roll_no']))
   {
    $select = "select * from studentregister where std_reg_id = $_POST[std_reg_id]";
    $adminresult=mysqli_query($conn,$select);
    while ($row = mysqli_fetch_assoc($adminresult)) 
    {
    ?>
            <form action="" method="post" class="animate__animated animate__fadeIn">
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
                            <input type="text" name="cource" value="<?php echo $row['cource']?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Image:</b>
                        </td>
                        <td>
                        <img src="upload/<?php echo  $row['img']?>" width="200px;">
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
                        <td>
                            <b>Mobile:</b>
                        </td>
                        <td>
                            <input type="text" name="phone" value="<?php echo $row['phone']?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>DOB:</b>
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
                    <?php
            }
        }
           ?>
                </table>
            </form>
            <?php include('includes/footer.php');?>
</body>

</html>