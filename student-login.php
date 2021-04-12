<?php
  session_start();
  include("db.php");
  if (isset($_POST['submit'])) {
      $errorMsg = "";
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']); 
      $name = mysqli_real_escape_string($conn, $_POST['name']); 
     
  if (!empty($email) || !empty($password)) {
        $query  = "SELECT * FROM studentregister WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 1){
          while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
              $_SESSION['password'] = $row['password'];
              $_SESSION['name'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                header("location:student-dashboard.php?login successful");
            }else{
                $errormsg = "Email or Password is invalid";
                
            }    
            
          }
        }else{
          $errorMsg = "No user found on this email";
        } 
    }else{
      $errorMsg = "Email and Password is required";
    }
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Login</title>

  <?php include('includes/links.php'); ?>
</head>

<body>
  <?php include('includes/navbar.php'); ?>
  <div class="top">
    <center>
      <h2 class="pt-5">STUDENT LOGIN</h2>
    </center>
  </div>
  <div class="container pt-5 pb-5">
    <div class="row justify-content-center">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div class="panel-border">
          <h5 class="panel-success"><strong>Sign In Here</strong></h5>

          <form method="post" action="" height=500px;>
            <div class="form-group">
              <label class="control-label" for="username">Username</label>
              <input type="text" class="form-control" required name="email" id="" placeholder="Enter Email">
            </div>
            <div class="form-group">
              <label class="control-label" for="password">Password</label>
              <input type="password" class="form-control" name="password" id="" placeholder="Enter Password">
              <?php
            if (isset($errorMsg)) {
                echo "<div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        $errorMsg
                      </div>";
            }
        ?>
              <span class="help-block">Forgot your password? <a href="">Click here</a></span>
            </div>
            <div class="checkbox">
              <label class="control-label" for="rememberMe">
                <input type="checkbox" name="rememberMe" id="rememberMe" value="1">
                Remember me</label>
            </div>

            <div class="row">
              <div class="col-sm-offset-3 col-sm-6">
                <input class="btn btn-primary  btn-block" type="submit" value="Sign In" name="submit"
                  class="btn btn-success btn-labeled pull-right">

              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>
  <?php include('includes/main-footer.php'); ?>
</body>

</html>