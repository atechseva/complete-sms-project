<?php
session_start();
include("database/db.php");
if (isset($_POST['submit'])) {
$errorMsg = "";
$admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
$admin_password = mysqli_real_escape_string($conn, $_POST['admin_password']); 
if (!empty($admin_email) || !empty($admin_password)) {
    $query  = "SELECT * FROM adminlogin WHERE admin_email = '$admin_email'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 1){
      while ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($admin_password, $row['admin_password'])) {
          $_SESSION['admin_password'] = $row['admin_password'];
           
            $_SESSION['admin_email'] = $row['admin_email'];
            header("location:admin/admin-dashboard.php?login successful");
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
  <title>Admin Page</title>
  <?php include('include/links.php'); ?>
  <style>
  header{
    position: absolute;
    width: 100%;
    background: #dc3545;
    z-index: 9;
    top: 0;
    padding: 0;
    margin: 0;
  }
  #admin-login{
    margin-top: 200px;
    margin-bottom: 60px;
  }
  </style>
</head>

<body>
  <?php include('include/top-bar.php'); ?>
 


  <div class="container h-100" id="admin-login">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="images/s2.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
			<form action="" method="post">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="admin_email" class="form-control input_user"placeholder="username">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="admin_password" class="form-control input_pass"  placeholder="password">
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Remember me</label>
							</div>
						</div>
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="submit" class="btn login_btn">Login</button>
				   </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Don't have an account? <a href="#" class="ml-2 text-dark">Sign Up</a>
					</div>
					<div class="d-flex justify-content-center links">
						<a href="#" class="text-white">Forgot your password?</a>
					</div>
				</div>
			</div>
		</div>
	</div>


















  <?php include('include/footer.php'); ?>
</body>

</html>