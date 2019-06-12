<?php
/*echo "<pre>";
print_r($_SESSION);
echo "</pre>";
echo $_SESSION['user']['uid'];*/

$shquery="select * from tbl_dates";
$shq_query=mysqli_query($con,$shquery);
$shfetch=mysqli_fetch_array($shq_query,MYSQLI_ASSOC);
//for Daily
if(date('d')!=$shfetch['today_date'])
{
	$update=mysqli_query($con,"update tbl_dates set today_date='".date('d')."'");
	$update_points=mysqli_query($con,"update tblpoints set current_point_no=0 WHERE routine_num_change=1");
	$update_departments=mysqli_query($con,"update tbltestdepartments set CatSeqNo=0 WHERE routine_num_change=1");
}
//for Monthly
if(date('m')!=$shfetch['today_month'])
{
	$update=mysqli_query($con,"update tbl_dates set today_month='".date('m')."'");
	$update_points=mysqli_query($con,"update tblpoints set current_point_no=0 WHERE routine_num_change=2");
	$update_departments=mysqli_query($con,"update tbltestdepartments set CatSeqNo=0 WHERE routine_num_change=2");
}
//for quaterearly
$tm=mktime(0, 0, 0, date("n"),date("j"),date("Y"));
$quater= ceil(date("m", $tm)/3);
if($quater !=$shfetch['today_quater'])
{
	$update=mysqli_query($con,"update tbl_dates set today_quater=$quater");
	$update_points=mysqli_query($con,"update tblpoints set current_point_no=0 WHERE routine_num_change=3");
	$update_departments=mysqli_query($con,"update tbltestdepartments set CatSeqNo=0 WHERE routine_num_change=3");
}
//for Yearly
if(date('y')!=$shfetch['today_year'])
{
	$update=mysqli_query($con,"update tbl_dates set today_year='".date('Y')."'");
	$update_points=mysqli_query($con,"update tblpoints set current_point_no=0 WHERE routine_num_change=4");
	$update_departments=mysqli_query($con,"update tbltestdepartments set CatSeqNo=0 WHERE routine_num_change=4");
}

?>
<div class="container">
        <div class="left_sidebar">
            <div class="widget">
                  <div class="widget_title">Recipt Actions</div>
                  <div class="widget_content">
                      <ul>
                          <li><img src="<?php echo $ru;?>images/savebutton.png" />
                              <h3><a class="nav-bar-links" href="#" data-reveal-id="creatrecipt">Create Receipts</a></h3>
                          </li>
                          <li><img src="<?php echo $ru;?>images/file.png" /><h3>New Receipts</h3></li> 
                          <li><img src="<?php echo $ru;?>images/keys.png" /><h3>All Receipts</h3></li> 
                          <li onclick="ajaxfuction('recenttests')">
                            <img src="<?php echo $ru;?>images/lock.png" />
                            <h3>Search Test</h3>
                          </li> 
                          <li><img src="<?php echo $ru;?>images/users.png" /><h3>Specimen Due</h3></li>
                          <li><img src="<?php echo $ru;?>images/home.png" /><h3>Patient Dues</h3></li> 
                          <li><img src="<?php echo $ru;?>images/close.png" /><h3>Test Statistics</h3></li> 
                      </ul>
                  </div>
            </div>
            
            <div class="widget">
                  <div class="widget_title">Report Actions</div>
                  <div class="widget_content">
                      <ul>
                          <li><img src="<?php echo $ru;?>images/savebutton.png" /><h3>Result Entry</h3></li>
                          <li><img src="<?php echo $ru;?>images/file.png" /><h3>Varify Results</h3></li> 
                          <li><img src="<?php echo $ru;?>images/keys.png" /><h3>Parcial Reports</h3></li> 
                          <li><img src="<?php echo $ru;?>images/lock.png" /><h3>Completed Reports</h3></li> 
                          <li><img src="<?php echo $ru;?>images/users.png" /><h3>Report Due in 1 hr</h3></li>
                          <li><img src="<?php echo $ru;?>images/home.png" /><h3>Report Delivery</h3></li> 
                      </ul>
                  </div>
            </div>
            
            <div class="widget">
                  <div class="widget_title">Recipt Actions</div>
                  <div class="widget_content">
                      <ul>
                          <li><img src="<?php echo $ru;?>images/savebutton.png" /><h3><a class="nav-bar-links" href="#" data-reveal-id="changepassword">Change Password</a></h3></li>
                          <li><img src="<?php echo $ru;?>images/file.png" /><h3>Lock Screen</h3></li> 
                          <li><img src="<?php echo $ru;?>images/keys.png" />
                                <h3 onclick="window.location.href='<?php echo $ru;?>process/logout.php'">Log Out</h3>
                          </li> 
                          <li><img src="<?php echo $ru;?>images/lock.png" /><h3><a href="javascript:closeWindow();">Exit Application</a></h3></li> 
                      </ul>
                  </div>
            </div>
        </div>
        <div class="right_content">
            <div class="welcome">Welcome to Citi Labs ManagmentSystem</div>
            <div class="content">
            	<a href="http://www.citilab.com.pk">
                	<img src="<?php echo $ru;?>images/logo.png" class="logoimage"/></div>
                </a>
            
        </div>
    </div>
</div>