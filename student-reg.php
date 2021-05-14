<?php
session_start();

include("db.php");
error_reporting(0);

if (isset($_REQUEST['register'])) {
  $errorMsg = "";
  $name = $_REQUEST['name'];
  $fathername = $_REQUEST['fathername'];
  $mothername = $_REQUEST['mothername'];
  $cource = $_REQUEST['cource'];
  $password = $_REQUEST['password'];
  $passwordlength = strlen($password);
  $hpassword = password_hash($password, PASSWORD_BCRYPT);
  $phone = $_REQUEST['phone'];
  $img = $_FILES['img']['name'];
  $location = "upload/" . $img;
  copy($_FILES['img']['tmp_name'], $location);
  $dob = $_REQUEST['dob'];
  $gender = $_REQUEST['gender'];
  $address = $_REQUEST['address'];
  $email   = mysqli_real_escape_string($conn, $_POST['email']);
  $sql = "SELECT * FROM studentregister WHERE email = '$email'";
  $execute = mysqli_query($conn, $sql);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMsg = "Email in not valid try again";
  } else if ($execute->num_rows == 1) {
    $errorMsg = "This Email is already exists";
  } else if ($passwordlength < 6) {
    $errorMsg = "<br><redtext> Invalid password. Password must be at least 6 characters</redtext>";
  } else {
    $query = "insert into studentregister(`name`,`fathername`,`mothername`,`cource`,`img`,`email`,`password`,`phone`,`dob`,`gender`,`address`) 
        values('$name','$fathername','$mothername','$cource','$img','$email','$hpassword','$phone','$dob','$gender','$address')";

    $result = mysqli_query($conn, $query);
    if ($result == true) {
      echo '<div class="alert alert-success">Account has been created successfully</div>';
    } else {
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
  <title>Student Registration</title>
  <?php include('includes/links.php'); ?>
</head>

<body>
  <?php include('includes/navbar.php'); ?>
  <section style="background-color: lavender;">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
        
          <fieldset class="scheduler-border" style="background:white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <legend class="scheduler-border" >STUDENT REGISTRATION FORM</legend>
            <?php
          if (isset($errorMsg)) {
            echo "<div class='alert alert-danger alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            $errorMsg
          </div>";
          }
          ?>
            <form action="" method="post" enctype="multipart/form-data" class="pt-1 pb-5 animate__animated animate__fadeIn">
            <table align="center" class="table-striped table-responsive" cellpadding="12" style="padding:20px;">

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
                  <td><select name="cource">
                      <option>Select</option>
                      <?php
                      $seclect = "select * from cource";
                      $sel = mysqli_query($conn, $seclect);
                      while ($row = mysqli_fetch_array($sel)) {
                        $cource_id = $row['cource_id'];
                        $cource = $row['cource'];
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
                  <td><input type="radio" name="gender" value="male" checked="checked">Male &nbsp;<input type="radio" name="gender" value="female">Female</td>
                </tr>

                <tr>
                  <td>Address</td>
                  <td><textarea name="address"></textarea></td>
                </tr>
                <tr>
                  <td colspan="4"><input type="checkbox" required>&nbsp;&nbsp;I agree to the Terms and Conditions
                  </td>
                </tr>

                <tr align="center">
                  <td colspan="1"><input type="submit" value="Submit" name="register" class="btn btn-outline-primary"></td>
                  <td colspan="1"><input type="reset" value="Reset" class="btn btn-outline-warning"></td>
                </tr>
              </table>
            </form>
          </fieldset>
           
        </div>
        <div class="col-md-4"><img src="img/1.webp" class="pt-5" alt="" style=" width:100%; height:80%; "></div>
      </div>
    </div>
  </section>
  <?php include('includes/main-footer.php'); ?>
</body>

</html>