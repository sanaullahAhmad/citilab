<?php
require('../config/config.php');
require('../connection/connection.php');
session_start();



foreach ($_POST as $k => $v) {
    $$k = $v;
}

if(isset($_POST['login_submit']))
{
$quuuu ="select * from tblemployee where login ='".$_POST['login']."' and password='".$_POST['password']."'";
//$query=mysqli_query($con,$quuuu);
$query=mysqli_query($con,$quuuu);
	$count_rows=mysqli_num_rows($query);
	if($count_rows==0)
		{
		
			 $m="Enter Valid User Name OR Password";
			header("location:" . $ru."login.php?msg=this");
			exit;
			
		
		}
	else
		{
			$login_row=mysqli_fetch_array($result,MYSQLI_ASSOC);
			//$login_row=mysqli_fetch_array($query,MYSQLI_ASSOC);
			$_SESSION['user']['username']=$login_row['login'];
			$_SESSION['user']['point_id']=$_POST['point'];
			$_SESSION['user']['uid']=$login_row['EmployeeId'];
			//echo $_SESSION['user']['point_id'];exit;
			header("location:" . $ru);
			exit;
		}
	  }
	
	
else
{
	header("location:" . $ru);
    exit;
}
?>