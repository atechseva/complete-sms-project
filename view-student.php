<?php 
include("db.php");
error_reporting(0);
ob_start();
session_start();
if((!isset($_SESSION['email'])) && (!isset($_SESSION['password']))){
header('Location: admin-login.php');
}
$no_of_students=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(*) FROM `studentregister`"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Student | Admin</title>
  <?php include('includes/links.php');?>
  <link href="css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
  <script type="text/javascript" charset="utf8"
    src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" charset="utf8"
    src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  <script>
    $(function () {
      $("#search").dataTable();
    })
  </script>
  <style>
    .dataTables_filter {
      right: : 0 !important;
      padding: 10px;
    }
  </style>

</head>

<body>
  <div class="wrapper">
    <?php include('includes/sidebar.php');?>
    <div class="main-panel">

      <?php include('includes/nav.php');?>

      <div class="container">
        <?php
 echo '<p style="font-weight: bold;" class="pt-2">Number of Students : '.$no_of_students[0].'</p>';
 ?>
        <table class="table table-bordered table-responsive animate__animated animate__fadeIn" align="center"
          id="search">
          <thead>
            <th>Roll No.</th>
            <th>Name</th>
            <th>Father Name</th>
            <th>Mother name</th>
            <th>Cource</th>
            <th>Email</th>
            <th>Phone</th>
            <th>DOB</th>
            <th>GENDER</th>
            <th>Image</th>
            <th>Address</th>
            <th>Operations</th>
          </thead>
          <?php
  $query="select * from studentregister";
  $sel=mysqli_query($conn,$query);
  while($row=mysqli_fetch_array($sel))
  {
    $std_reg_id=$row['std_reg_id'];
    $name=$row['name'];
    $fathername=$row['fathername'];
    $mothername=$row['mothername'];
    $cource=$row['cource'];
    $email=$row['email'];
    $phone=$row['phone'];
    $dob=$row['dob'];
    $gender=$row['gender'];
    $img=$row['img'];
    $address=$row['address'];
?>

          <tr>

            <td>
              <?php echo $std_reg_id; ?>
            </td>
            <td>
              <?php echo $name; ?>
            </td>
            <td>
              <?php echo $fathername; ?>
            </td>
            <td>
              <?php echo $mothername; ?>
            </td>
            <td>
              <?php echo $cource; ?>
            </td>
            <td>
              <?php echo $email; ?>
            </td>
            <td>
              <?php echo $phone; ?>
            </td>
            <td>
              <?php echo $dob; ?>
            </td>
            <td>
              <?php echo $gender; ?>
            </td>

            <td><img src="upload/<?php echo $img; ?>" width="100" height="100" /></td>
            <td>
              <?php echo $address; ?>
            </td>
            <td><a style="color: green" href="delete-student.php?dlt_stud=<?php echo $row["std_reg_id"]; ?>"><i
                  class="fas fa-trash-alt"></i></a>
            </td>
          </tr>

          <?php
            } ?>
        </table>
      </div>

      <?php include('includes/footer.php');?>
</body>

</html>