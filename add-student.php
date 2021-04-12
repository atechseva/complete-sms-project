<?php
  session_start();
  include("db.php");
error_reporting(0);
if((!isset($_SESSION['email'])) && (!isset($_SESSION['password']))){
    header('Location: admin-login.php');
    }
if(isset($_REQUEST['register']))
{
  $errorMsg = "";
  $name=$_REQUEST['name'];
  $fathername=$_REQUEST['fathername'];
  $mothername=$_REQUEST['mothername'];
  $cource=$_REQUEST['cource'];
  $password=$_REQUEST['password'];
  $passwordlength= strlen($password);
  $hpassword = password_hash($password, PASSWORD_BCRYPT);
  $phone=$_REQUEST['phone'];
  $img=$_FILES['img']['name'];
  $location="upload/".$img;
  copy($_FILES['img']['tmp_name'],$location);
  $dob=$_REQUEST['dob'];
  $gender=$_REQUEST['gender'];
  $address=$_REQUEST['address'];
  $email   = mysqli_real_escape_string($conn, $_POST['email']);
   
  $sql = "SELECT * FROM studentregister WHERE email = '$email'";
  $execute = mysqli_query($conn, $sql);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $errorMsg = "Email in not valid try again";
      }else if($execute->num_rows == 1){
          $errorMsg = "This Email is already exists";
      }else if ($passwordlength < 6){
        $errorMsg= "<br><redtext> Invalid password. Password must be at least 6 characters</redtext>";
        }
     else{
        $query="insert into studentregister(`name`,`fathername`,`mothername`,`cource`,`img`,`email`,`password`,`phone`,`dob`,`gender`,`address`) 
        values('$name','$fathername','$mothername','$cource','$img','$email','$hpassword','$phone','$dob','$gender','$address')";
        $result = mysqli_query($conn, $query);
      if ($result == true) {
        echo '<div class="alert alert-success">Account has been created successfully</div>';

      }else{
          $errorMsg  = "You are not Registred..Please Try again";
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student | Admin</title>
    <?php include('includes/links.php');?>
    <link href="css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <?php include('includes/sidebar.php');?>
        <div class="main-panel">

            <?php include('includes/nav.php');?>
            <!-- -------------content start------------------ -->

            <?php
if (isset($errorMsg)) { echo "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button>
    $errorMsg
    </div>";}
?>
            <div class="container">
            <fieldset class="scheduler-border">
    <legend class="scheduler-border">ADD STUDENT</legend>
    <form action="" method="post" enctype="multipart/form-data" class="pt-5 pb-5">
                   
                    <table>

                        <tr>
                            <td>Name:</td>
                            <td><input type="text" name="name">

                            </td>

                            <td>Father's Name:</td>
                            <td><input type="text" name="fathername"></td>
                        </tr>

                        <tr>
                            <td>Mother's Name:</td>
                            <td><input type="text" name="mothername"></td>
                            <td>Cource</td>
                            <td><select name="cource" required="required">
                                    <option>Select</option>
                                    <?php
                                    $seclect="select * from cource";
                                    $sel=mysqli_query($conn,$seclect);
                                    while($row=mysqli_fetch_array($sel))
                                    {
                                      $cource_id=$row['cource_id'];
                                      $cource=$row['cource'];
      
      
                                     ?>

                                    <option value="<?php echo $cource; ?>">
                                        <?php echo $cource; ?>
                                    </option>
                                    <?php 
                                      }
                                      ?>
                                </select></td>

                        </tr>
                        <tr>
                            <td>Student Image</td>
                            <td><input type="file" name="img"></td>
                            <td>Email:</td>
                            <td><input type="email" name="email"></td>
                        </tr>

                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="password"></td>
                            <td>Phone</td>
                            <td><input type="text" name="phone"></td>
                        </tr>


                        <tr>
                            <td>D.O.B</td>
                            <td><input type="date" name="dob"></td>
                            <td>Gender</td>
                            <td><input type="radio" name="gender" value="male" checked="checked">Male &nbsp;<input
                                    type="radio" name="gender" value="female">Female</td>
                        </tr>

                        <tr>
                            <td>Address</td>
                            <td><textarea name="address"></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="4"><input type="checkbox" required>&nbsp;&nbsp;I agree to the Terms and
                                Conditions
                            </td>
                        </tr>

                        <tr align="center">
                            <td colspan="1"><input type="submit" value="Submit" name="register" class="btn btn-primary"></td>
                            <td colspan="1"><input type="reset" value="Reset" class="btn btn-warning"></td>
                        </tr>
                    </table>
                    </fieldset>
                </form>
            </fieldset>
                
            </div>
            <!-- -------------content end------------------ -->
            <?php include('includes/footer.php');?>
</body>

</html>