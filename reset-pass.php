<?php
session_start();

include("database/db.php");
error_reporting(0);
if (isset($_POST['reset'])) {
    if (isset($_GET['token'])) {
        $passmsg = "";
        $itoken = $_GET['token'];
        $student_password = mysqli_real_escape_string($conn, $_POST['student_password']);
        $password = password_hash($student_password, PASSWORD_BCRYPT);
        $updatequery = " update studentregister set student_password='$password' where token='$itoken' ";
        $execute = mysqli_query($conn, $updatequery);
        if ($execute) {
            $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
              <strong>Success!</strong> Your Password Has Been Updated
            </div>';
            header('location:student-login.php');
        } else {
            $_SESSION['passmsg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
              <strong>Failed!</strong> Your Password Is not updated
            </div>';
            header('location:reset-pass.php');
        }
    } else {
        echo "Something Went Wrong";
    }
}
?>
<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container" style="margin-top:50px">
        <h4 class="text-center">RESET PASSWORD</h4>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">

                <?php
                if (isset($_SESSION['passmsg'])) {
                    echo $_SESSION['passmsg'];
                } else {
                    echo $_SESSION['passmsg'] = "";
                }
                ?>


                <form action="" method="POST">

                    <div class="form-group">
                        <input type="password" class="form-control" name="student_password" placeholder="Password" required="">

                    </div>

                    <input type="submit" class="btn btn-primary btn btn-block" name="reset" value="Reset">
                </form>
            </div>
        </div>
    </div>

</body>

</html>