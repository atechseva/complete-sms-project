<?php
session_start();
include("db.php");
error_reporting(0);
if ((!isset($_SESSION['email'])) && (!isset($_SESSION['password']))) {
    header('Location: student-login.php');
}
if (isset($_REQUEST['submit'])) {
    $msg = "";
    $name = $_REQUEST['name'];
    $fathername = $_REQUEST['fathername'];
    $mothername = $_REQUEST['mothername'];

    $img = $_FILES['img']['name'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $hpassword = password_hash($password, PASSWORD_BCRYPT);
    $phone = $_REQUEST['phone'];
    $dob = $_REQUEST['dob'];
    $gender = $_REQUEST['gender'];
    $address = $_REQUEST['address'];
    copy($_FILES['img']['tmp_name'], $location);
    if ($img == "") {
        $query = "UPDATE studentregister SET name='$name', fathername='$fathername', mothername='$mothername',email='$email', password='$hpassword', phone='$phone', dob='$dob', gender ='$gender', address='$address' WHERE  email='$_SESSION[email]'";
    } 
    
    if($hpassword=$_SESSION['password'] OR $password=$_SESSION['password']){
        $query = "UPDATE studentregister SET name='$name', fathername='$fathername', mothername='$mothername',email='$email', phone='$phone', dob='$dob', gender ='$gender', address='$address' WHERE  email='$_SESSION[email]'";
    }
   
    
    else {
        $location = "upload/" . $img;
        copy($_FILES['img']['tmp_name'], $location);
        $query = "UPDATE studentregister SET name='$name', fathername='$fathername', mothername='$mothername', img='$img', email='$email', password='$hpassword', phone='$phone', dob='$dob' gender ='$gender', address='$address' WHERE  email='$_SESSION[email]'";
    }
    $result = mysqli_query($conn, $query);
    if ($result) {
        $msg = '<div class="alert alert-success">Information Edit Successfully! </div>';
    } else {
        $msg = '<div class="alert alert-danger">Failed to edit </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student | Admin</title>
    <?php include('includes/links.php'); ?>
    <link href="css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <style>
        .pass_show {
            position: relative;
         
        }

        .pass_show .ptxt {
            position: absolute;
            top: 50%;
            right: 60px;
            z-index: 1;
            color: red;
            margin-top: -10px;
            cursor: pointer;
            transition: all .4s ease-in-out;
        }

        .pass_show .ptxt:hover {
            color: #333333;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include('student_includes/sidebar.php'); ?>
        <div class="main-panel">

            <?php include('includes/nav.php'); ?>
            <div class="container">

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">EDIT PROFILE</legend>
                    <form action="" method="post" enctype="multipart/form-data" class="pt-1 pb-5 animate__animated animate__fadeIn">

                        <?php echo $msg; ?>
                        <table align="center" class="table-responsive" cellpadding="12" style="background-color:#dce8ff; padding:20px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);font-weight: bold;">
                            <?php
                            $fetchdata = "SELECT * FROM studentregister WHERE email='$_SESSION[email]'";
                            $records = mysqli_query($conn, $fetchdata);
                           
                            while ($data = mysqli_fetch_array($records, MYSQLI_ASSOC)) {
                            ?>
                                <tr>
                                    <td>Name:</td>
                                    <td><input type="text" name="name" value="<?php echo $data["name"]; ?>"></td>
                                    <td>Father's Name:</td>
                                    <td><input type="text" name="fathername" value="<?php echo $data["fathername"]; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Mother's Name:</td>
                                    <td><input type="text" name="mothername" value="<?php echo $data["mothername"]; ?>"></td>
                                    <td>Cource</td>
                                    <td><input type="text" name="cource" value="<?php echo $data["cource"]; ?>" disabled></td>
                                </tr>
                                <tr>
                                    <td>Student Image</td>
                                    <td><input type="file" name="img"></td>
                                    <td> <img src="upload/<?php echo $data["img"]; ?>" style=" width: 200px; border-radius:
                                50%; height: 200px;">
                                </tr>
                                <td>Email:</td>
                                <td><input type="email" name="email" value="<?php echo $data["email"]; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td  class="pass_show"><input type="password" name="password" value="<?php echo $data["password"]; ?>"></td>
                                    <td>Phone</td>
                                    <td><input type="text" name="phone" value="<?php echo $data["phone"]; ?>"></td>
                                </tr>
                                <tr>
                                    <td>D.O.B</td>
                                    <td><input type="date" name="dob" value="<?php echo $data["dob"]; ?>"></td>
                                    <td><input type="radio" name="gender" value="Male" <?php if ($data["gender"] == "Male") {
                                                                                            echo "checked";
                                                                                        }; ?> /><label>Male &nbsp;</label><input type="radio" name="gender" value="Female" <?php if ($data["gender"] == "Female") {
                                                                                                                                                                                echo "checked";
                                                                                                                                                                            }; ?> /><label> Female</label></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><textarea name="address" cols="25" rows="3" value="<?php echo $data["address"]; ?>"><?php echo $data["address"]; ?></textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><input type="checkbox" required>&nbsp;&nbsp;I agree to the Terms and
                                        Conditions
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td colspan="1"><input type="submit" value="Submit" name="submit"></td>
                                    <td colspan="1"><input type="reset" value="Reset"></td>
                                </tr>
                        </table>
                </fieldset>
                </form>
                </fieldset>
            </div>
        <?php
                            }
        ?>
        <?php include('includes/footer.php'); ?>

        <script>
            $(document).ready(function() {
                $('.pass_show').append('<span class="ptxt">Show</span>');
            });
            $(document).on('click', '.pass_show .ptxt', function() {
                $(this).text($(this).text() == "Show" ? "Hide" : "Show");
                $(this).prev().attr('type', function(index, attr) {
                    return attr == 'password' ? 'text' : 'password';
                });
            });
        </script>
</body>

</html>