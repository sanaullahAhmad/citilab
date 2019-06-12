<?php
session_start();
ob_start();
include("connection/connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>.::&nbsp;City Labs&nbsp;|&nbsp;Admin&nbsp;::.</title>
		<link rel="stylesheet" href="css/style (2).css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/invalid.css" type="text/css" media="screen" />
</head>

<body id="login">
		
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
			
				<h1>Citi Lab</h1>
				<!-- Logo (221px width) -->
				<img id="logo" src="images/logo_login.png" alt="Airline Connect" />

			</div> <!-- End #logn-top -->
			
			<div id="login-content">
				
					<form name="signin" method="post" action="process/process_login.php">
				<?php if(isset($_GET['msg'])) { ?>
                <div class="notification error png_bg">
                      <div>
                           Enter Valid User Name OR Password
                      </div>
                </div>
                <?php } else { ?>
					<div class="notification information png_bg">
						<div>
							Enter Username and Password To Login
						</div>
					</div>
				<?php } ?>	
					<p>

						<label>Username</label>
						<input class="text-input" name="login" id="email" type="text" />
					</p>
					<div class="clear"></div>
					<p>
						<label>Password</label>
						<input class="text-input"  name="password" id="password" type="password" />
					</p>

					<div class="clear"></div>
					<p>

						<label style="width:88px;">Point</label>
                        <select name="point" class="text-input" style="width:212px;">
                        	<?php $query="select * from  tblpoints";
								  //$sqlq=mysqli_query($con,$query);
								  $result=mysqli_query($con,$query);

									// Numeric array
									//$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
									//printf ("%s (%s)\n",$row[0],$row[1]);
								  while($fet=mysqli_fetch_array($result,MYSQLI_ASSOC))
								  	{
							?>
                            			<option value="<?php echo $fet['PointId']?>"><?php echo $fet['location']?></option>
                              <?php }?>
                        </select>
						
					</p>
					<div class="clear"></div>
                    <div class="clear"></div>
					<p>
						<input class="button" type="submit" name="login_submit" onClick="return login_submit();" value="Sign In" />
					</p>
					
				</form>

			</div> <!-- End #login-content -->
			
		</div> <!-- End #login-wrapper -->
		
  </body>
</html>