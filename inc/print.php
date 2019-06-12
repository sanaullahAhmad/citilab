<?php
unset($_SESSION['test_ids']);
if(empty($_GET['s']))
{
	$q = "select MAX(patientTestsId) as maxid from tblpatienttestdetails";
	//echo $q;
	$result = mysqli_query($con,$q);
	$data = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$test_id=$data['maxid'];
	
}
else
{
	$test_id=$_GET['s'];
}
$uquery="select 
							 tblpatientreciept.PatientId,
							 tblpatientreciept.PatientTestsId,
							 tblpatientreciept.totalBill,
							 tblpatientreciept.Discount,
							 tblpatientreciept.Received,
							 tblpatientreciept.Balance,
							 tblpatientreciept.discountBy,
							 tblpatientreciept.netBill,
							 tblpatientreciept.EmployeeId,
							 tblpatientreciept.IsCanceled,
							 tblpatientreciept.testDate,
							 tblpatientreciept.PointId,
							 tblpatientreciept.PanelId,
							 tblpatientreciept.RefId,
							 tblpatientreciept.ReceiptId,
							 
							 tblpatientreciept.Balance,
							 tblpatientreciept.Remarks,
							 
							 tblpatienttestdetails.tstNameId,
							 tblpatienttestdetails.deliveryDate,
							 tblpatienttestdetails.deliveryTime,
							 tblpatienttestdetails.testStatus,
							 tblpatienttestdetails.SpecimenDue,
							 tblpatienttestdetails.labRefId,
							 tblpatienttestdetails.TestRate,
							 tblpatienttestdetails.labRefText,
							 tblpatienttestdetails.deliveryTime,
							 tblpatienttestdetails.deliveryDate,
							 tblpatienttestdetails.Specimenid
							 
							 from tblpatientreciept
							 INNER JOIN 
							 tblpatienttestdetails
							 ON tblpatientreciept.PatientTestsId = tblpatienttestdetails.patientTestsId
							 where tblpatienttestdetails.patientTestsId='".$test_id."'";
						$query=mysqli_query($con,$uquery);
							  $role=mysqli_fetch_array($query,MYSQLI_ASSOC);
							  //echo $uquery; exit;
	  
	   
                		$querytest="select * from tblpatient where PatientId='".$role['PatientId']."'";
						$quer4=mysqli_query($con,$querytest);
						$Patient=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
						
						$querytest="select Name as testname, tstDepartId, tstNameId from tbltest where tstNameId='".$role['tstNameId']."'";
						$quer4=mysqli_query($con,$querytest);
						$Testname=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
						
						$query_ref="select * from tblreferreddoctor where refId='".$role['RefId']."'";
						$quer5=mysqli_query($con,$query_ref);
						$Ref_name=mysqli_fetch_array($quer5,MYSQLI_ASSOC);
						
						
						
						
?>
<div class="container">
        <div class="newdiv">
            <div id="printpreview">
              <div style="height:100px;"></div>
                  <?php if($role['PanelId']!=0) {
					  $query_panel="select * from tblpaneldetails where PanelId='".$role['PanelId']."'";
						$quer6=mysqli_query($con,$query_panel);
						$Panel=mysqli_fetch_array($quer6,MYSQLI_ASSOC);
					  ?>
               <table border="1" cellspacing="0"  style="font-size:11px;">
                  <tr>
                  	<th width="150">Panel Name</th>
                    <th width="150">Panel Code</th>
                    <th width="150">Employee name</th>
                    <th width="100">Department</th>
                    <th width="117">Designation</th>
                  </tr>
                  <tr>
                  	<td><?php echo $Panel['Name']?></td>
                    <td><?php echo $Panel['PanelCode']?></td>
                    <td><?php echo $Patient['GuardianName']?></td>
                    <td><?php echo $Patient['departments']?></td>
                    <td><?php echo $Patient['designations']?></td>
                  </tr>
              </table>
              <div style="height:10px"></div>
              
                  <?php }?>
               <table border="1" cellspacing="0" style="font-size:11px;">
                  <tr>
                      <td width="160"><b>Contact No</b></td>
                      <td width="160"><?php echo $Patient['PhoneNo']?></td>
                      <td width="220" rowspan="3"><h3><?php echo $Patient['Name'];?></h3>  <?php echo $Patient['Age']." "; echo $Patient['AgeType'];?> (<?php echo $Patient['Sex']?>) <br /> <b>Ref By: <?php echo $Ref_name['Name']?></b></td>
                      <td width="150" rowspan="3">
                      	<div id="c_p_n_h1" style="width:150px;">
                        	<?php 
								$yui="select * from tblpoints where PointId = '".$role['PointId']."'";
								$rty=mysqli_query($con,$yui);
								$point=mysqli_fetch_array($rty,MYSQLI_ASSOC);
							?>
                            <h1> <?php echo $role['ReceiptId'];?>/<?php echo $point['lCode'];?> </h1>
                            <br />
                            <?php echo date('D d-F-Y h:m A', strtotime($role['testDate']));
							 //echo $role['testDate'];//echo date("D");echo " ".date("d-M-Y");echo " ".date("h:i:A")?>
                        </div>
                      </td>
                  </tr>
                  <?php if($role['PanelId']==0) { ?>
                  <tr>
                      <td width="120"><b>Address / E-mail</b></td>
                      <td width="120"><?php echo $Patient['Address']?></td>
                  </tr>
                  <?php }else{?>
                  <tr>
                      <td width="120"><b>Relationship With Employee</b></td>
                      <td width="120"><?php echo $Patient['relationwithemp']?></td>
                  </tr>
                  <?php }?>
              </table>
              <div style="height:10px"></div>
              <table border="1" cellspacing="0" style="font-size:11px;">
                  <tr>
                      <th width="305">Test</th>
                      <?php if($role['PanelId']!=0 && $Panel['showPrice']=='1'){?>
                      	<th width="70">Price</th>
                      <?php } else if($role['PanelId']==0){?>
					  	<th width="70">Price</th>
					  <?php }?>
                      <th width="100">Lab Ref.</th>
                      <th width="200" colspan="2">Date & Time of Report</th>
                  </tr>
                  <?php
                  $yui="select * from tblpatienttestdetails where patientTestsId = '".$role['PatientTestsId']."'";
					$rty=mysqli_query($con,$yui);
				  while($alltests=mysqli_fetch_array($rty,MYSQLI_ASSOC)){
						?>
                    <tr>
                      <?php
                      $que= mysqli_query($con,"select tstNameId, Name from tbltest where tstNameId='".$alltests['tstNameId']."'");
                      $testna=mysqli_fetch_array($que,MYSQLI_ASSOC);
					  ?>
                      <td><?php echo $testna['Name'];?></td>
                      <?php if($role['PanelId']!=0 && $Panel['showPrice']=='1'){?>
                      	<td><?php echo $alltests['TestRate']; ?></td>
					 <?php } else if($role['PanelId']==0){?>
                     	<td><?php echo $alltests['TestRate']; ?></td>
                      <?php }?>
                      <td><b><?php echo $alltests['labRefText']?></b></td>
                      <td><?php echo $alltests['deliveryDate'];?></td>
                      <td><?php echo $alltests['deliveryTime'];?></td>
                  </tr>
                    <?php }?>
                  
              </table>
              <div style="height:10px"></div>
              <div style="float:left; width:310px;">
              	<table style="font-size:11px;">
                	<tr>
                    	<td><b>Specimen</b></td><td>&nbsp;</td>
                    </tr>
                    <tr>
                    	<td><?php
                    $qu="select tbltestsspecimen.tstNameId, tbltestsspecimen.SpecimenId, tblspecimens.SpecimenName
			 from tbltestsspecimen
			 INNER JOIN tblspecimens
			 ON tbltestsspecimen.SpecimenId=tblspecimens.SpecimenId
			  WHERE tbltestsspecimen.tstNameId= '".$Testname['tstNameId']."'";
					//echo $qu;
					$qs=mysqli_query($con,$qu);
					$que=mysqli_fetch_array($qs,MYSQLI_ASSOC);
					if(mysql_num_rows($qs)>0)
					{
						echo $que['SpecimenName']?>
                    <?php }?>
                    </td><td>&nbsp;</td>
                    </tr>
                    <tr>
                    	<td><b>Comments</b></td><td><?php echo $role['Remarks'];?></td>
                    </tr>
                    <tr>
                    	<?php 
						$que= mysqli_query($con,"select name from tblemployee where EmployeeId='".$role['EmployeeId']."'");
                     	$testna=mysqli_fetch_array($que,MYSQLI_ASSOC); 
					  	?>
                        <td><b><?php echo $testna['name']?>---Cash</b></td><td>&nbsp;</td>
                    </tr>
                </table>
              </div>
              <div style="float:left; width:100px;">
              	<table border="1" cellspacing="0" style="font-size:11px;">
                	<?php if($role['PanelId']!=0 && $Panel['showPrice']=='1'){?>
                    <tr>
                    	<td width="70">Total<br /><h3 style="text-align:right;"><?php echo $role['totalBill'];?></h3></td>
                    </tr>
                    <tr>
                    	<td>Recieved <h3 style="text-align:right;"><?php echo $role['Received'];?></h3></td>
                    </tr>
                    <?php } else if($role['PanelId']==0){?>
                    <tr>
                    	<td width="70">Total<br /><h3 style="text-align:right;"><?php echo $role['totalBill'];?></h3></td>
                    </tr>
                    <tr>
                    	<td>Recieved <h3 style="text-align:right;"><?php echo $role['Received'];?></h3></td>
                    </tr>
                    <?php }?>
                    
                </table>
                
              </div>
              <div style="float:left; width:300px">
			 	 <?php if($role['Balance']!=0){?> <h1>DUES</h1><br />Balance= <?php echo $role['Balance']; ?><br /> <img src="<?php echo $ru;?>images/dues.jpg" />
				 <?php }else{ ?>
                 <h1>Paid</h1>
                 <?php }?>
              </div>
              <div style="clear:both"></div>
      </div>
       </div>
</div>
    
              <button  onclick="PrintElem('#printpreview')">Reciept Print</button>
    <div id="all_label_print" style="width:170px;">
    <?php
	$yui2="select * from tblpatienttestdetails where patientTestsId = '".$role['PatientTestsId']."'";
					$rty2=mysqli_query($con,$yui2);
    while($alltests2=mysqli_fetch_array($rty2,MYSQLI_ASSOC)){
	?>
    
      <div id="label_print_preview<?php echo $count;?>" style="width:170px; height:62px; margin:23px 0 0 0;">
          <b><?php echo $Patient['Name'];?></b><br />
          <?php echo date("D");echo " ".date("d-M-Y");echo " ".date("h:i:A")?><br />
          <?php echo $Patient['Age']." ".$Patient['AgeType']." / "; echo $Patient['Sex'];?>
          <b>(<?php echo $alltests2['labRefText']?><br /><?php echo $role['ReceiptId'];?>/<?php echo $point['lCode'];?>)</b>
      </div>
    
    <?php }?>
    </div>
    <button  onclick="PrintElem('#all_label_print')">Label Print</button>
</div>