<?php
session_start();

include("database/db.php");
if(isset($_GET['token']))
{
    $token =$_GET['token'];
    $updatequery = "update studentregister set status='active' where token='$token'";

$query= mysqli_query($conn,$updatequery);
if($query)
{
    if(isset($_SESSION['msg'])){
      
        $_SESSION['msg']= '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
      <strong>Account Updated Successfully</strong> "
    </div>';
        header('location:student-login.php');
    }
    else{
       
        $_SESSION['msg']= '<div class="alert alert-warning alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
          <strong>You Are Logged out! Please Verify again...</strong> "
        </div>';
        header('location:student-login.php');
    }
    
}
else{
    $_SESSION['msg']= '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
      <strong>Account Not Updated</strong> "
    </div>';
header('location:student-login.php');
}
}

?>