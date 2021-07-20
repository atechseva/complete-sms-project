<?php
session_start();
error_reporting(0);

include("database/db.php");
if (isset($_POST['signin'])) {

  $errormsg = "";
  $student_email = mysqli_real_escape_string($conn, $_POST['student_email']);
  $student_password = mysqli_real_escape_string($conn, $_POST['student_password']);

  if (!empty($student_email) || !empty($student_password)) {
    $query  = "SELECT * FROM studentregister WHERE student_email = '$student_email' and status='active' ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
      while ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($student_password, $row['student_password'])) {
          $_SESSION['student_email'] = $row['student_email'];
          $_SESSION['student_password'] = $row['student_password'];
          header("Location:student/student-dashboard.php");
        } else {

          $errormsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
            <strong>Opps!</strong> Email or Password is invalid
          </div>';
        }
      }
    } else {

      $errormsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
      </button>
        <strong>Opps!</strong> No user found on this email
      </div>';
    }
  } else {

    $errormsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
      <strong>Opps!</strong> Email and Password is required
    </div>';
  }
}

?>




<?php
session_start();

if (isset($_POST['register'])) {

  $errormsg = "";
  $msg = "";
  $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
  $student_email = mysqli_real_escape_string($conn, $_POST['student_email']);
  $student_password = mysqli_real_escape_string($conn, $_POST['student_password']);
  $cource = mysqli_real_escape_string($conn, $_POST['cource']);
  $gender = mysqli_real_escape_string($conn, $_POST['gender']);
  $dob = mysqli_real_escape_string($conn, $_POST['dob']);
  $password = password_hash($student_password, PASSWORD_BCRYPT);
  $token = bin2hex(random_bytes(15));
  $sql = "SELECT * FROM studentregister WHERE student_email = '$student_email'";
  $execute = mysqli_query($conn, $sql);

  if (!filter_var($student_email, FILTER_VALIDATE_EMAIL)) {

    $errormsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
      <strong>Opps!</strong> Email in not valid try again
    </div>';
  } else if (strlen($student_password) < 6) {
    $errormsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
      <strong>Opps!</strong> Password should be six digits
    </div>';
  } else if ($execute->num_rows == 1) {

    $errormsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
      <strong>Opps!</strong> This Email is already exists
    </div>';
  } else {

    $query = "INSERT INTO studentregister(`student_name`,`student_email`,`student_password`,`cource`,`gender`,`dob`,`token`,`status`) 
                   VALUES('$student_name','$student_email','$password','$cource','$gender','$dob','$token','inactive')";
    $result = mysqli_query($conn, $query);
    if ($result == true) {
      $subject = "Account Activation";
      $body = "Hi , $student_email Click Here to Activate your Email
      https://www.atechseva.com/demo-projects/sms/activate.php?token=$token";

      $sender_email = "From: dashingsagar2@gmail.com";
      $smsg="";
      if (mail($student_email, $subject, $body, $sender_email)) {
        $smsg="";
        $smsg= '<div class="alert alert-primary alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
          <strong>Success!</strong> Check your E-mail to Activate your account. <span class="text-warning">If Email Not Found then check it in spam.</span>
        </div>';
      } else {

        $errormsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
          <strong>Opps!</strong> Email Sending failed
        </div>';
      }
      
    } else {

      $errormsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
      </button>
        <strong>Opps!</strong> You are not Registred..Please Try again
      </div>';
    }
  }
}

?>
<!-- -----------------------recover email---------------------- -->
<?php

  error_reporting(0);
  if (isset($_POST['recover_email'])) {
      
      $errormsg = "";
       
      $emailerr="";
      $student_email = mysqli_real_escape_string($conn, $_POST['student_email']);
      $token = mysqli_real_escape_string($conn, $_POST['token']);
      
      
      $sql = "SELECT * FROM studentregister WHERE student_email = '$student_email' ";
      
       $query = mysqli_query($conn,$sql);
       $emailcount = mysqli_num_rows($query);
      if($emailcount)
       {
         $userdata = mysqli_fetch_array($query);
         $token=$userdata['token'];
           
         $subject = "Password Reset | Atechseva";
         $body = "Hi , $email Click Here to Reset your password  https://www.atechseva.com/demo-projects/sms/reset-pass.php?token=$token";
        
        $sender_email = "From: dashingsagar2@gmail.com"; 
        $smsg="";
        if(mail($student_email, $subject, $body, $sender_email))
        {
         
            $smsg = '<div class="alert alert-primary alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
              Reset Link Has been Send to your '.$student_email.' <span class="text-warning">If Email Not Found then check it in spam.</span>
            </div>';
            
        }
        else{
          
          $emailerr = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
              <strong>Opps!</strong> Email Sending Failedtr
            </div>';
        }
   
       }
       else{
        
        $emailerr = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
          <strong>Opps!</strong> No Email Found
        </div>';
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
      <?php echo $errormsg; ?>
      <?php echo $msg; ?>
      <?php echo $smsg; ?>
      <?php echo $_SESSION['msg']; ?>
      <?php echo $emailerr;?>

      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="student_email" autofocus="">
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="student_password" required="">

      <button class="btn btn-success btn-block" type="submit" name="signin"><i class="fas fa-sign-in-alt"></i> Sign in</button>
      <a href="#" id="forgot_pswd">Forgot password?</a>
      <hr>
      <!-- <p>Don't have an account!</p>  -->
      <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</button>
    </form>

    <form action="" class="form-reset" method="POST">
      <input type="email" id="resetEmail" class="form-control" placeholder="Email address" name="student_email" autofocus="">
      <button class="btn btn-primary btn-block" type="submit" name="recover_email">Reset Password</button>
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