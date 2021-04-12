
<?php
   session_start();
   include("db.php");
  if (isset($_POST['signup'])) {
      $errorMsg = "";
      $email   = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $hpassword = password_hash($password, PASSWORD_BCRYPT);
      $sql = "SELECT * FROM adminlogin WHERE email = '$email'";
      $execute = mysqli_query($conn, $sql);
        
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $errorMsg = "Email in not valid try again";
      }else if($execute->num_rows == 1){
          $errorMsg = "This Email is already exists";
      }
      else{
          $query= "INSERT INTO adminlogin (email,password) 
                  VALUES('$email','$hpassword')";
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
  <title>Admin Page</title>
  <?php include('includes/links.php'); ?>
</head>

<body>
  <?php include('includes/navbar.php'); ?>
  <div class="top">
    <center>
      <h2 class="pt-5">ADMIN REGISTER</h2>
    </center>
  </div>
  <div class="container pt-5 pb-5">
    <div class="row justify-content-center">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div class="panel-border">
          <h5 class="panel-success"><strong>Sign Up Here</strong></h5>
          <form method="post" action="" height=500px;>
            <div class="form-group">
              <label class="control-label" for="username">Username</label>
              <input type="text" class="form-control" name="email" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
              <label class="control-label" for="password">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
            </div>
            <?php
            if (isset($errorMsg)) { echo "<div class='alert alert-danger alert-dismissible'> <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        $errorMsg
            </div>";
            } ?>
            <div class="checkbox">
              <label class="control-label" for="rememberMe">
                <input type="checkbox" name="rememberMe" id="rememberMe" value="1">
                Remember me</label>
            </div>

            <div class="row">
              <div class="col-sm-offset-3 col-sm-6">
                <input class="btn btn-primary  btn-block" type="submit" value="Sign Upn" name="signup"
                  class="btn btn-success btn-labeled pull-right">
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-4">

      </div>
    </div>
  </div>
  <?php include('includes/main-footer.php'); ?>
</body>

</html>