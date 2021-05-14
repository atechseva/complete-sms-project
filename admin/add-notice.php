<?php
ob_start();
session_start();
if((!isset($_SESSION['email'])) && (!isset($_SESSION['password']))){
header('Location: admin-login.php');
}
include("db.php");
error_reporting(0);
if(isset($_REQUEST['add_notice']))
{
  $cource=$_REQUEST['cource'];
  $notice_title=$_REQUEST['notice_title'];
  $notice_description=$_REQUEST['notice_description'];
  $address=$_REQUEST['address'];
  $query="insert into notice(`cource`,`notice_title`,`notice_description`) values('$cource','$notice_title','$notice_description')";
  $result = mysqli_query($conn,$query);
  if($result)
      {
        echo '<div class="alert alert-success">Notice Added Successfully</div>';
        
      }
      else{
        echo '<div class="alert alert-danger">Error Something Went Erong</div>';
      }
  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
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
if(isset($_POST['viewnotice']))
{?>

      <section class="pt-5 pb-5" style="background-color: lightblue;">
        <div class="container">
          <table class="table table-bordered" align="center" id="example">
            <thead>
              <th>Cource</th>
              <th>Notice Title</th>
              <th>Notice Description</th>
              <th>Date</th>
              <th>Delete</th>
              <?php
      $query="select * from notice";
      $sel=mysqli_query($conn,$query);
      while($row=mysqli_fetch_array($sel))
        {
      $id=$row['notice_id'];
      $cource=$row['cource'];
      $notice_title=$row['notice_title'];
      $notice_description=$row['notice_description'];
      ?>
              <tr>
                <td>
                  <?php echo $cource; ?>
                </td>
                <td>
                  <?php echo $notice_title; ?>
                </td>
                <td>
                  <?php echo $notice_description; ?>
                </td>
                <td>current_timestamp()</td>
                <td><a href="delete-notice.php?noticeid=<?php echo $id; ?>">Delete</a></td>
              </tr>
              <?php
  }     
  ?>
          </table>
        </div>
      </section>
      <?php
}
?>
      <div class="container">
        <form method="post" class="pb-5">
          <table align="center" cellpadding="12"
            style="background-color:white;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <h3 class="text-center">Add Notice
              <?php echo'<form action="" method="post" align="right"><input type="submit"  value="View Notice" name="viewnotice" style="font-size: 15px; margin-bottom: 30px;position: absolute;float: right; right: 20px;background: greenyellow;border: none;padding: 10px;">
    </form> '; ?>
            </h3>
            <tr>
              <td>Cource</td>
              <td><select name="cource">
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
              <td>Notice Title</td>
              <td><input type="text" name="notice_title"></td>
            </tr>
            <tr>
              <td>Description</td>
              <td><textarea name="notice_description"></textarea></td>
            </tr>
            <tr align="center">
              <td colspan="1"><input type="submit" value="Submit" name="add_notice"
                  style="background: skyblue;border: none;padding: 5px 20px;border-radius: 10px;"></td>
              <td colspan="1"><input type="reset" value="Reset"
                  style="background: #fb0426; border: none;padding: 5px 20px;border-radius: 10px; color: white;"></td>
            </tr>
          </table>

        </form>
      </div>
      <!-- -------------content end------------------ -->
      <?php include('includes/footer.php');?>
</body>

</html>