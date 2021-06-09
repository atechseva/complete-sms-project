<?php
session_start();
include("database/db.php");
error_reporting(0);
if (isset($_POST['submit'])) {
  $errorMsg = "";
  $student_email = mysqli_real_escape_string($conn, $_POST['student_email']);
  $student_password = mysqli_real_escape_string($conn, $_POST['student_password']);
  $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);

  if (!empty($student_email) || !empty($student_password)) {
    $query  = "SELECT * FROM studentregister WHERE student_email = '$student_email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
      while ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($student_password, $row['student_password'])) {
          $_SESSION['student_password'] = $row['student_password'];
          $_SESSION['student_name'] = $row['student_name'];
          $_SESSION['student_email'] = $row['student_email'];
          header("location:student/student-dashboard.php?login successful");
        } else {
          $errormsg = "Email or Password is invalid";
        }
      }
    } else {
      $errorMsg = "No user found on this email";
    }
  } else {
    $errorMsg = "Email and Password is required";
  }
}
?>
<?php
if (isset($_REQUEST['register'])) {
  $errorMsg = "";
  $msg = "";
  $student_name = $_REQUEST['student_name'];
  $cource = $_REQUEST['cource'];
  $student_password = $_REQUEST['student_password'];
  $passwordlength = strlen($student_password);
  $hpassword = password_hash($student_password, PASSWORD_BCRYPT);
  $phone = $_REQUEST['phone'];
  $dob = $_REQUEST['dob'];
  $gender = $_REQUEST['gender'];
  $student_email = mysqli_real_escape_string($conn, $_POST['student_email']);
  $sql = "SELECT * FROM studentregister WHERE student_email = '$student_email'";
  $execute = mysqli_query($conn, $sql);
  if (!filter_var($student_email, FILTER_VALIDATE_EMAIL)) {
    $errorMsg = "Email in not valid try again";
  } else if ($execute->num_rows == 1) {
    $errorMsg = "This Email is already exists";
  } else if ($passwordlength < 6) {
    $errorMsg = "<br><redtext> Invalid password. Password must be at least 6 characters</redtext>";
  } else {
    $query = "insert into studentregister(`student_name`,`cource`,`student_email`,`student_password`,`phone`,`dob`,`gender`) 
        values('$student_name','$cource','$student_email','$hpassword','$phone','$dob','$gender')";
    $result = mysqli_query($conn, $query);
    if ($result == true) {
      $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
			</button>
		<strong>Success!</strong> Account has been created successfully
	  </div>';
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
  <title>Student Login</title>

  <?php include('include/links.php'); ?>
  <style>
    header {
      position: absolute;
      width: 100%;
      background: #dc3545;
      z-index: 9;
      top: 0;
      padding: 0;
      margin: 0;
    }

    #admin-login {
      margin-top: 200px;
      margin-bottom: 60px;
    }
  </style>
</head>

<body>
  <?php include('include/top-bar.php'); ?>


<div class="container">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">  <div id="logreg-forms">
    <form class="form-signin" method="post">
      <h1 class="h3 mb-3 font-weight-normal"> Sign in</h1>
      <div class="social-login">
        <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign in with Facebook</span> </button>
        <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign in with Google+</span> </button>
      </div>
      <p style="text-align:center"> OR </p>
      <?php echo $errorMsg; ?>
      <?php echo $msg; ?>

      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="student_email" autofocus="">
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="student_password" required="">

      <button class="btn btn-success btn-block" type="submit" name="submit"><i class="fas fa-sign-in-alt"></i> Sign in</button>
      <a href="#" id="forgot_pswd">Forgot password?</a>
      <hr>
      <!-- <p>Don't have an account!</p>  -->
      <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</button>
    </form>

    <form action="/reset/password/" class="form-reset">
      <input type="email" id="resetEmail" class="form-control" placeholder="Email address" required="" autofocus="">
      <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
      <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
    </form>

    <form action="" class="form-signup" method="post">
      <div class="social-login">
        <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign up with Facebook</span> </button>
      </div>
      <div class="social-login">
        <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign up with Google+</span> </button>
      </div>

      <p style="text-align:center">OR</p>
      <?php echo $errorMsg; ?>
      <input type="text" id="user-name" class="form-control" placeholder="Full name" name="student_name" autofocus="">
      <input type="email" id="user-email" class="form-control" placeholder="Email address" name="student_email" required autofocus="">
      <input type="password" id="user-pass" class="form-control" placeholder="Password" name="student_password" required autofocus="">

      <select name="cource" class="form-control">
        <option>Select Course</option>
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
      </select>

      <p>Gender : <label class="radio-inline">
          <input type="radio" name="gender" value="male" checked="checked"> Male
        </label>
        <label class="radio-inline">
          <input type="radio" name="gender" value="female"> Female
        </label>
      </p>

      <div class="form-group">
        <label for="dob">
          <p>DOB :</p>
        </label>
        <input type="date" name="dob" class="form-control">
      </div>
      <button class="btn btn-primary btn-block" type="submit" name="register"><i class="fas fa-user-plus"></i> Sign Up</button>
      <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
    </form>
    <br>

  </div>
</div>
<div class="col-md-3"></div>
</div>
</div>


  <?php include('include/footer.php'); ?>

  <script>
    function toggleResetPswd(e) {
      e.preventDefault();
      $('#logreg-forms .form-signin').toggle()
      $('#logreg-forms .form-reset').toggle()
    }

    function toggleSignUp(e) {
      e.preventDefault();
      $('#logreg-forms .form-signin').toggle();
      $('#logreg-forms .form-signup').toggle();
    }

    $(() => {

      $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
      $('#logreg-forms #cancel_reset').click(toggleResetPswd);
      $('#logreg-forms #btn-signup').click(toggleSignUp);
      $('#logreg-forms #cancel_signup').click(toggleSignUp);
    })
  </script>
</body>

</html>