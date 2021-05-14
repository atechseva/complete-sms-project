<div class="sidebar">

    <div class="sidebar-wrapper" style="background: black;">
        <div class="logo">
            <a href="http://www.atechseva.com" class="simple-text">
                Welcome
                <?php echo $_SESSION['name']; ?>
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item active">
                <a class="nav-link" href="student-dashboard.php">
                    <i class="icofont-dashboard"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="student-profile.php">
                    <i class="icofont-eye-alt"></i>
                    <p>Student Profile</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="edit-student-profile.php">
                    <i class="icofont-edit"></i>
                    <p>Edit Profile</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="view-notice.php">
                    <i class="icofont-notification"></i>
                    <p>Notice</p>
                </a>
            </li>
            
            
            <li>
                <a class="nav-link" href="student-study-material.php">
                    <i class="icofont-book"></i>
                    <p>Study Material</p>
                </a>
            </li>

            
        </ul>
    </div>
</div>
<!-- ---------------------------Result Modal--------------------- -->
<div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Check Result</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="seeresult.php">
                    <table style="border-collapse: separate;">
                        <tr>
                            <td style="height: 50px;">Roll-No:</td>
                            <td><input type="text" name="std_reg_id"></td>
                        </tr>
                        <tr>
                            <td style="height: 50px;">Course/Class</td>
                            <td><select name="course">
                                    <?php
            $seclect="select * from cource";
            $sel=mysqli_query($conn,$seclect);
            while($row=mysqli_fetch_array($sel))
            {
                $id=$row['cource_id'];
                $cource=$row['cource'];
            ?>
                                    <option value="<?php echo $id; ?>">
                                        <?php echo $cource; ?>
                                    </option>
                                    <?php 
            }
            ?>
                                </select></td>
                        </tr>
                        <tr>
                    </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" name="check_result" value="Check" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST['check_result']))
{
   
    $std_reg_id=$_REQUEST['std_reg_id'];
    $cource=$_REQUEST['cource'];
    $select="select * from result where std_reg_id='$std_reg_id' and cource='$cource'";
    $query=mysqli_query($conn,$select) or die(mysqli_error());
    $result=mysqli_fetch_array($query);
    
    if($result)
    {
     
    header("location:seeresult.php");
    }
    else
    {
        echo "Invalid Details";
    }
    
      
    }
    ?>