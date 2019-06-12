<?php
//$nno = $_SESSION['user']['uid'];
//echo $nno.'sanaullah';
//exit;
//$query_select = "SELECT * FROM `tbl_user` WHERE `pk_user_id`= $nno";
//echo $query_select;
//exit;
//$query_res = mysqli_query($con,$query_select);
//$query_row = mysql_fetch_assoc($query_res);
//print_r($query_res);
//exit;
?>
<script type="text/javascript">
function passwordmathch()
	{
		var a = document.getElementById('con_password').value;
		var b = document.getElementById('password').value;
		if( a == b)
			{
				
				return true;
			}
		else
			{
				alert("Password Deos not Match");
				return false;
			}
	
	}
</script>
<?php
include("left.php");
?>

<div id="items">
    <div id="items-in">
<h1>You Are Not Signed in <br />Please sign in first</h1>
        
       
       <div style="padding:0 20px;">
       
       
       </div>
       
        
      </div>
</div>

<?php
include("right.php");
?>
<!-------------------------
User Forms
--------------------------->

            <!---------------
            Login form
            ----------------->
            