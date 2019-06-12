<?php
session_start();
require('../config/config.php');
require('../connection/connection.php');

foreach ($_POST as $k => $v) 
  {
	  $$k = $v;
  }
if(isset($_POST['patient_form_autofil']))
  {
	  $query=mysqli_query($con,"select 
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
							 tblpatientreciept.Remarks,
							 tblpatientreciept.PanelId,
							 tblpatientreciept.RefId,
							 tblpatientreciept.ReceiptId,
							 tblpatientreciept.ClinicalDiagnosis,
							 tblpatientreciept.refletterNo,
							 tblpatientreciept.Priority,
							 
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
							 tblpatienttestdetails.Specimenid,
							 
							 tblpoints.lCode
							 
							 from tblpatientreciept
							 INNER JOIN 
							 tblpatienttestdetails
							 ON tblpatientreciept.PatientTestsId = tblpatienttestdetails.patientTestsId
							 INNER JOIN
							 tblpoints
							 ON tblpatientreciept.PointId = tblpoints.PointId
							 
							 where tblpatienttestdetails.patientTestsId=$patienttestid");
	  $role=mysqli_fetch_array($query,MYSQLI_ASSOC);
	  
	   
                		$querytest="select * from tblpatient where PatientId='".$role['PatientId']."'";
						$quer4=mysqli_query($con,$querytest);
						$Patient=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
						
						$querytest="select Name as testname, tstDepartId, tstNameId from tbltest where tstNameId='".$role['tstNameId']."'";
						$quer4=mysqli_query($con,$querytest);
						$Testname=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
				?>
	  
    <h1 class="patienth1"><?php echo $Patient['Name']?> Patient Reciept</h1>
        <div class="upperwrapperdiv">
            <div class="uperleft">
                <div class="uperleftinner1">
                    <input type="radio" name="panel_or_nopanel"  value="panel" onchange="eanbleselect()" <?php if($role['PanelId']!=0){?> checked="checked" <?php }?>/>Panel
                    <input type="radio" name="panel_or_nopanel"  value="nonpanel" <?php if($role['PanelId']==0){?> checked="checked" <?php }?> onchange="disabledselect()" />
                    Non Panel<br />
                    <input type="radio" name="panel_or_nopanel"  value="medicle" onchange="disabledselect()" />Medicle
                    <button id="p_list">P-List</button><br />
                    <select name="panel_list" class="panellist2" onblur="disabled()" disabled="disabled">
                        <option>--Select Panel--</option>
                        <?php
                            $query_panel_list = "SELECT * FROM tblpaneldetails";
                            $result_panel_list = mysqli_query($con,$query_panel_list);
                            while ($record_panel_list = mysqli_fetch_array($result_panel_list,MYSQLI_ASSOC))
                            {
                                ?>
                                        <option value="<?php echo $record_panel_list['PanelId']; ?>" <?php if($role['PanelId']==$record_panel_list['PanelId']){?> selected="selected" <?php }?>>
                                            <?php echo $record_panel_list['Name']; ?>
                                        </option>
                                <?php
                            }
                        ?>
                    </select><br />
                    Ref letter #<br />
                    <input type="text" class="refletterno2" value="<?php echo $role['refletterNo'];?>"/>
                </div>
              <div class="uperleftinner1">
                    <input type="radio" name="normalurgent" value="normal" <?php if($role['Priority']!=1){?> checked="checked" <?php }?> />
                  Normal &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="normalurgent" value="urgent" <?php if($role['Priority']==1){?> checked="checked" <?php }?> />
                    Urgent
              </div>
                <div class="uperleftinner1">
                    Refferd By<br />
                    <input type="radio" name="refferdbyradio" value="doctor" />Doctor &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="refferdbyradio" value="lab"/>Lab <br />
                    <input type="radio" name="refferdbyradio" value="hospetal"/>Hospital &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="refferdbyradio" value="mics"/>Mics
                    <br />
                    
                    <select name="refferdby_doctor" class="refferdby2" >
                        <?php
                            $query_refdoctor_list = "SELECT * FROM tblreferreddoctor";
                            $result_refdoctor_list = mysqli_query($con,$query_refdoctor_list);
                            while ($record_refdoctor_list = mysqli_fetch_array($result_refdoctor_list,MYSQLI_ASSOC))
                            {
                                ?>
                                        <option value="<?php echo $record_refdoctor_list['refId']; ?>" <?php if($role['RefId']==$record_refdoctor_list['refId']){?> selected="selected" <?php }?>>
                                            <?php echo $record_refdoctor_list['Name']; ?>
                                        </option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="uperleftinner1">
                    Mode of Payment<br />
                    <input type="radio" name="m_o_p"  value="CA"  checked="checked"/>Cash &nbsp;&nbsp;&nbsp;<br />
                    <input type="radio" name="m_o_p"  value="Check"/>Check <br />
                    <input type="radio" name="m_o_p"  value="C_C"/>Cridet Card &nbsp;&nbsp;&nbsp;
                    
                    <br />
                    <input type="text" class="refferdby2" name="refferdby" />
                </div>
            </div>
            <div class="uperright">
                <table>
                    <tr>
                        <td>Title</td><td>Phone</td><td>Age</td><td>Gender</td>
                        <?php
                        $gooddate = new DateTime($role['testDate']);
						$formattedgooddate = date_format($gooddate, 'd-M-Y');
						$formattedgooddate_day=date_format($gooddate, 'D');
						$formattedgooddate_time=date_format($gooddate, 'h:i:A');
						?>
                        <td rowspan="2"><input class="current_point_no2" name="current_point_no" value="<?php echo $role['ReceiptId'];?>" type="hidden">
                        <div id="c_p_n_h1">
                            <h1> <?php echo $role['ReceiptId'].'/'.$role['lCode'];?> </h1>
                            <br />
                            <?php echo $formattedgooddate_day;echo " ".$formattedgooddate;echo " ".$formattedgooddate_time?>
                        </div></td>
                    </tr>
                    <tr>
                        <td>
                            <select name="title" class="title2" onchange="changegender(this.value);" disabled="disabled">
                                <?php $que= mysqli_query($con,"select * from tblgender");
                                while($gender=mysqli_fetch_array($que,MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $gender['Type'];?>" <?php if($gender['Type']==$Patient['Sex']){ ?> selected="selected" <?php }?> ><?php echo $gender['Gender'];?></option>
                                <?php  } ?>
                            </select>
                        </td>
                        <td><input type="text" name="phone" value="<?php echo $Patient['PhoneNo']?>" class="phone_number2" disabled="disabled"/></td>
                        
                        <td>
                            <input type="text" name="age" class="age2" value="<?php echo $Patient['Age']?>" disabled="disabled"/> 
                            <select name="agetype" class="agetype2" disabled="disabled">
                              <option value="year" <?php if($Patient['AgeType']=='year'){?> selected="selected"<?php }?>>year</option>
                              <option value="month" <?php if($Patient['AgeType']=='month'){?> selected="selected"<?php }?>>Month</option>
                              <option value="day" <?php if($Patient['AgeType']=='day'){?> selected="selected"<?php }?>>Day</option>
                            </select>
                        </td>
                        <td><select name="gender" class="gender2" disabled="disabled">
                        <option value="1" <?php if($Patient['Sex']=='1'){?> selected="selected"<?php }?>>Male</option>
                        <option value="2" <?php if($Patient['Sex']=='2'){?> selected="selected"<?php }?>>Female</option>
                        <option value="3" <?php if($Patient['Sex']=='3'){?> selected="selected"<?php }?>>MC</option>
                        <option value="4" <?php if($Patient['Sex']=='4'){?> selected="selected"<?php }?>>FC</option>
                        </select></td>
                    </tr>
                </table>
                <?php if($role['PanelId']==0){?> 
                <table>
                    <tr>
                        <td>Name</td><td>S/O,D/O,W/O</td><td>Address / Email</td><td>NIC / Passport</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="name" class="name2" value="<?php echo $Patient['Name']?>" disabled="disabled" />
                        </td>
                        <td><input type="text" name="sodowo" class="sodowo2" value="<?php echo $Patient['GuardianName']?>" disabled="disabled"/></td>
                        <td><input type="text" name="address" value="<?php echo $Patient['Address']?>" disabled="disabled"/></td>
                        <td><input type="text" name="nic_passport" value="<?php echo $Patient['NIC']?>" disabled="disabled"/></td>
                    </tr>
                </table>
                 <?php }else{?>
                 <table>
                    <tr>
                        <td>PatientName</td><td>EmployeeName</td><td>Department</td><td>Designation</td><td>Rel-with-Emp</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="name" id="name" value="<?php echo $Patient['Name']?>" disabled="disabled" />
                        </td>
                        <td><input type="text" name="sodowo" id="sodowo" value="<?php echo $Patient['GuardianName']?>" disabled="disabled"/></td>
                        <td><input type="text" name="departments" class="departmenttextfield2" value="<?php echo $Patient['departments']?>" disabled="disabled"/></td>
                        <td><input type="text" class="designationtextfield2" name="designations" value="<?php echo $Patient['designations']?>" disabled="disabled"/></td>
                        <td><input type="text" name="relationwithemp" value="<?php echo $Patient['relationwithemp']?>" disabled="disabled"/></td>
                    </tr>
                </table>
                <?php }?>
                <h5 class="test">Test</h5>
                <table class="contenttable">
                    <tr>
                        <td>Descreption</td><td>Price</td><td>LabRefId</td>
                        <td>Delivry Date</td><td>Hour</td><td>Min</td><td>AM/PM</td><td>Due</td><td>Urgent</td>
                    </tr>
                    <?php 
					$yui="select * from tblpatienttestdetails where patientTestsId = '".$role['PatientTestsId']."'";
					$rty=mysqli_query($con,$yui);
					while($alltests=mysqli_fetch_array($rty,MYSQLI_ASSOC)){
						?>
                    <tr>
                        <td>
                            
                            <select name="description" class="description21"  disabled="disabled">
                                <?php $que= mysqli_query($con,"select tstNameId, Name from tbltest order by Name ASC");
                                 while($testna=mysqli_fetch_array($que,MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $testna['tstNameId'];?>" <?php if($testna['tstNameId']==$alltests['tstNameId']){?> selected="selected" <?php }?>>
									<?php echo $testna['Name'];?>
                                </option>
                                <?php  } ?>
                            </select>
                        </td>
                        <td><input type="text" class="price" name="testprice" disabled="disabled" value="<?php echo $alltests['TestRate']; ?>" /></td>
                        <input type="hidden" name="testpricehidden" id="testpricehidden" />
                        <td><input type="text" class="labrefclass" name="labrefid" value="<?php echo $alltests['labRefText']?>" disabled="disabled"/></td>
                        <td>
                        <input type="text" name="delivrydate" class="delivrydate2" class="datepicker" value="<?php echo $alltests['deliveryDate']?>" disabled="disabled"/>
                        </td>
                       <?php $delivrytime=explode(':',$alltests['deliveryTime'])?>
                        <td><input type="text" class="hour2" name="hours" value="<?php echo $delivrytime[0];?>" disabled="disabled"/></td>
                        <td><input type="text" class="minut2" name="minuts"  value="<?php echo $delivrytime[1];?>" disabled="disabled"/></td>
                        <td><select name="ampm" class="ampm2" disabled="disabled">
                            <option <?php if($delivrytime[2]=='AM'){?> selected="selected" <?php }?>>AM</option>
                            <option <?php if($delivrytime[2]=='PM'){?> selected="selected" <?php }?>>PM</option>
                        </select></td>
                        <td><input type="checkbox" name="due" value="1" <?php if($alltests['SpecimenDue']==1){?> checked="checked" <?php }?>/></td>
                        <td><input type="checkbox" name="urgent" value="1" <?php if($alltests['ReqUrgent']==1){?> checked="checked" <?php }?>/></td>
                    </tr>
					<?php } ?>
                </table>
                <?php
					if($role['IsCanceled']==1)
					{
						echo "<img src='$ru/images/cancle.jpg'>";
					}
					?>
            </div>
        </div>
        
        <div class="lowerwrapperdiv">
            <div class="specimen">
                Speciman
                <div class="specimaninner2">
                    <?php
                    $qu="select tblspecimens.SpecimenId, tblspecimens.SpecimenName,
					tblpatienttestdetails.Specimenid
				   from tblpatienttestdetails
				   INNER JOIN tblspecimens
				   ON tblspecimens.SpecimenId=tblpatienttestdetails.Specimenid
				   where tblpatienttestdetails.patientTestsId = '".$role['PatientTestsId']."'";
					//echo $qu;
					$qs=mysqli_query($con,$qu);
					if(mysql_num_rows($qs)>0)
					{
						while($que=mysqli_fetch_array($qs,MYSQLI_ASSOC))
						{
					?>
                              <input type="checkbox" name="speciman" value="<?php echo $que['SpecimenId']?>" checked="checked" disabled="disabled"/>
                              &nbsp; <?php echo $que['SpecimenName']?><br />
                    <?php }
					}?>
                </div>
            </div>
            <div class="out">
                <h4 class="outh4">Out</h4>
                <div style="clear:both"></div>
                <div class="outinner2">
                    <?php
                    $qu="select tblspecimens.SpecimenId, tblspecimens.SpecimenName,
						 tblpatienttestdetails.Specimenid,
						 tblpatienttestdetails.TestLocal
						 from tblpatienttestdetails
						 INNER JOIN tblspecimens
						 ON tblspecimens.SpecimenId=tblpatienttestdetails.Specimenid
						 where tblpatienttestdetails.patientTestsId = '".$role['PatientTestsId']."'";
					//echo $qu;
					$qs=mysqli_query($con,$qu);
					if(mysql_num_rows($qs)>0)
					{
						while($que=mysqli_fetch_array($qs,MYSQLI_ASSOC))
						{
					?>
                              <input type="checkbox" name="speciman_out" value="<?php echo $que['SpecimenId']?>" <?php if($que['TestLocal']==0){?> checked="checked" <?php } ?> disabled="disabled"/>
                              <br />
                    <?php }
					}?>
                </div>
            </div>
            <div class="finaldiv">
                <table>
                    <tr id="ghjk1">
                        <td>Total Amount</td><td>Discount</td><td>Net Amount</td><td>Clinical Diagnosis</td><td>Coments</td>
                    </tr>
                    <tr>
                        <td>
                        <input type="text" class="totalamount2" name="totalamount" onKeyUp="dicountFunction()" disabled="disabled" value="<?php echo $role['totalBill'];?>"/>
                        </td>
                        <td><input type="text" class="discount2" name="discount" onKeyUp="dicountFunction()" value="<?php echo $role['Discount'];?>" disabled="disabled"/></td>
                        <td><input class="netamount2" name="netamount" type="text" value="<?php echo $role['netBill'];?>" disabled="disabled"></td>
                        <td rowspan="3"><textarea id="gentextarea" disabled="disabled"> <?php echo $role['ClinicalDiagnosis'];?></textarea></td>
                        <td rowspan="3"><textarea  name="remarks" id="gentextarea" disabled="disabled"><?php echo $role['Remarks'];?></textarea></td>
                    </tr>
                    <tr id="ghjk2">
                        <td>Recieved</td><td>Balance</td><td>Discount Allowed By</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="recieved" class="recieved2" onblur="balancefinder()" value="<?php echo $role['Received'];?>" disabled="disabled"/></td>
                        <td><input type="text" name="balance" class="balance2" onblur="balancefinder()" value="<?php echo $role['Balance'];?>" disabled="disabled"/></td>
                        <td><input class="discountallowedby2" name="discountallowedby" type="text" value="<?php echo $role['discountBy'];?>" disabled="disabled"></td>
                    </tr>
                </table>
                <button type="submit" name="savenewreciept" disabled="disabled">Save</button>
                <button type="reset" onclick="ReciptCancelfuction('<?php echo $patienttestid;?>')" <?php if($role['IsCanceled']==1){?> disabled="disabled" <?php }?>> 
                	Cancel Reciept
                </button>
                <button onclick="window.open('<?php echo $ru;?>print/<?php echo $patienttestid;?>','_newtab');">Print Preview</button>
                <button onclick="window.location.href='<?php echo $ru;?>printauto/<?php echo $patienttestid;?>'">Print</button>
                <button>Label Print Preview</button>
            </div>
            
        </div>
             
	  <?php
  }
if(isset($_POST['employee_form_autofil']))
  {
	  $query=mysqli_query($con,"SELECT tblemployee.name, tblemployee.EmployeeId, tblemployee.telephone, tblemployee.mobile, tblemployee.EmpDepartId, tblemployee.PointId,
	  										  tblemployee.login, tblemployee.password,
											  tblemployee.address,
											  tblemployee.designation,
											  tblemployee.DOB,
											  tblemployee.isActive,
											  tblemployee.IsLeave,
											  tblemployee.LeavingDate,
											  
											  tblemployee.dateCreated,
											  tblemployee.TotSalary,
											  tblemployee.AdvanceBalance,
											  tblemployee.designation,
											  tblemployee.currentLoginDate,
											  tblemployee.CurrentSalary,
											  tblemployee.email,
											  tblemployee.lastLoginDate, tblemployee.Qualification, tblemployee.JoiningDate, 
											  tblemployee.Experience, tblemployee.EmergencyContact, tblemployee.LeavingDate, tblemployee.IsRejoining,
											  tblemployee.LeavingDate, tblemployee.RejoiningDate, tbltestdepartments.Name
											   FROM tblemployee INNER JOIN tbltestdepartments
											   ON tblemployee.EmpDepartId=tbltestdepartments.tstDepartId
											where tblemployee.EmployeeId=$employeeid");
	  $role=mysqli_fetch_array($query,MYSQLI_ASSOC);
	  ?>
	  
    
   <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    <h1 class="patienth1"><?php echo $role['name']?> Employee</h1>
    <table>
        <tr>
          <td width="120">Point</td>
          <td><select name="point_newemployee" id="point_newemployee" style="width:138px;">
          <option>--SELECT--</option>
          <?php $newquery="select * from tblpoints";
                $myquery=mysqli_query($con,$newquery);
                while($myfetch = mysqli_fetch_array($myquery,MYSQLI_ASSOC))
                {
          ?>     
                    <option value="<?php echo $myfetch['PointId']?>" <?php if($role['PointId']==$myfetch['PointId']){?> selected="selected"<?php }?>><?php echo $myfetch['location']?></option> 
          <?php } ?>
          </select>
          </td>
           <td width="120">Department</td>
          <td><select name="department" id="department" style="width:138px;">
                    <option>--SELECT--</option>
          <?php $newquery="select * from tbltestdepartments";
                $myquery=mysqli_query($con,$newquery);
                while($myfetch = mysqli_fetch_array($myquery,MYSQLI_ASSOC))
                {
          ?>     
                    <option value="<?php echo $myfetch['tstDepartId']?>" <?php if($role['EmpDepartId']==$myfetch['tstDepartId']){?> selected="selected"<?php }?>><?php echo $myfetch['Name']?></option> 
          <?php } ?>
          </select>
          </td>
        </tr>
        <tr>
        <td width="120">Login</td><td><input type="text" name="login" value="<?php echo $role['login']; ?>" /></td><td>Password</td><td><input type="text" name="password" id="password"  value="<?php echo $role['password'];?>" > </td>
        </tr>
        <tr>
        <td width="120">Name</td><td><input type="text" name="name"  style="width:138px;" value="<?php echo $role['name']; ?>"/></td>
        <td>Confirm Password</td><td><input type="text" name="confirm_password" id="confirm_password" value="<?php echo $role['password']; ?>" ></td>
        </tr>
        <tr>
          <td width="120">Address</td><td colspan="3"><input type="text" name="address" style="width:100%;" value="<?php echo $role['address']; ?>"/></td>
        </tr>
        <tr>
        <td width="120">Telephone</td><td><input type="text" name="telephone" value="<?php echo $role['telephone']; ?>"/></td>
        <td>Mobile</td><td><input type="text" name="mobile" id="mobile" value="<?php echo $role['mobile']; ?>"/></td>
        </tr>
        <tr>
        <td width="120">Email</td><td><input type="text" name="email"  value="<?php echo $role['email']; ?>"  /></td>
        <td>Designation</td>
        <td><input type="text" name="designation" id="designation" value="<?php echo $role['designation']; ?>" /></td>
        </tr>
        <tr>
        <td width="120">Date Of Birth</td><td><input type="text" name="dateofbirth"  class="datepicker" value="<?php echo $role['DOB']; ?>"/></td>
        <td>Date Created</td><td><input type="text" name="datecreated" id="datecreated" class="datepicker" value="<?php echo $role['dateCreated']; ?>" /></td>
        </tr>
        <tr>
        <td width="120">Total Salary</td><td><input type="text" name="totalsalary"  value="<?php echo $role['TotSalary']; ?>" /></td>
        <td>Advance Balance</td><td><input type="text" name="advancebalance" id="advancebalance"  value="<?php echo $role['AdvanceBalance']; ?>" /></td>
        </tr>
        <tr>
            <td width="120">Current Salary</td><td><input type="text" name="currentsalery"  value="<?php echo $role['CurrentSalary']; ?>"/></td>
            <td>Last login Date</td><td><input type="text" name="lastlogindate" class="datepicker" value="<?php echo $role['lastLoginDate']; ?>"/></td>
        </tr>
        <tr>
            <td width="120">Curentlogindate</td><td><input type="text" name="currentlogindat"  class="datepicker" value="<?php echo $role['currentLoginDate']; ?>"/></td>
            <td>joiningdate</td><td><input type="text" name="joiningdate" class="datepicker" value="<?php echo $role['JoiningDate']; ?>"/></td>
        </tr>
        <tr>
            <td width="120">Qualification</td><td><input type="text" name="qualification" value="<?php echo $role['Qualification']; ?>"/></td>
            <td>Emergency Contact</td><td><input type="text" name="emergency" value="<?php echo $role['EmergencyContact']; ?>"/></td>
        </tr>
        <tr>
        <tr>
          <td width="120">Experience</td><td><input type="text" name="experience" value="<?php echo $role['Experience']; ?>"/></td>
          <td>Active</td>
          <td><input type="checkbox" name="active" <?php if($role['isActive']==1){?> checked="checked"<?php }?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes</td>
        </tr>
        
        
        <tr>
          <td width="120"><input type="checkbox" name="leavingdatecheckbox" <?php if($role['IsLeave']==1){?> checked="checked"<?php }?> />&nbsp;Leavingdate</td>
          <td width="120"><input type="text" name="leavingdatetextbox" class="datepicker" value="<?php echo $role['LeavingDate']; ?>" /></td>
          <td width="120"><input type="checkbox" name="rejoiningdatecheckbox" id="rejoiningdatecheckbox" <?php if($role['IsRejoining']==1){?> checked="checked"<?php }?> />
          	&nbsp;&nbsp;Rejoing Date&nbsp;
          </td>
          <td><input type="text" name="rejoiningdatetextbox" class="datepicker" value="<?php echo $role['RejoiningDate']; ?>"/></td>
        </tr>
       </table>
        
        <div style="height:150px; overflow:auto; float:left; width:300px; background:#fff; margin:0 30px 0 0;">
          
          	<table border="1">
            	<tr><td colspan="3" style="text-align:center;">Employee Roles</td></tr>
                <tr><td>Name</td><td>Status</td><td>Assigned Date</td></tr>
                <?php
                  $query="SELECT * from tblroles; ";
                    //$query="select * from tbltestrates";
                    $query_my = mysqli_query($con,$query);
                    while($fetchq = mysqli_fetch_array($query_my,MYSQLI_ASSOC))
                        {
            	?>
                          <tr><td><?php echo $fetchq['Name'] ?></td>
                          <?php
                            	$query4="SELECT * from tblemproles where RoleId='".$fetchq['RoleId']."' and EmployeeId='".$role['EmployeeId']."'";
								//$query="select * from tbltestrates";
								$query_my4 = mysqli_query($con,$query4);
								$num4 = mysql_num_rows($query_my4);
							?>
                          <td><input type="checkbox" name="rolestatus[]" value="<?php echo $fetchq['RoleId'];?>" <?php if($num4>0){?> checked="checked" <?php }?>/></td>
                          <td>&nbsp;</td></tr>
                <?php   }?>
            </table>
          </div>
          <div style="height:150px; overflow:auto; float:left; width:300px;background:#fff;">
          	<table border="1">
            	<tr><td colspan="3" style="text-align:center">Employee Rights</td></tr>
                <tr><td>Name</td><td>Status</td><td>Assigned Date</td></tr>
                <?php
                  $query="SELECT * from tblrights; ";
                    //$query="select * from tbltestrates";
                    $query_my = mysqli_query($con,$query);
                    while($fetchq = mysqli_fetch_array($query_my,MYSQLI_ASSOC))
                        {
            	?>
                          <tr>
                            <td><?php echo $fetchq['RightName'] ?></td>
                            <?php
                            	$query5="SELECT * from tblemprights where RightId='".$fetchq['RightId']."' and EmployeeId='".$role['EmployeeId']."'";
								//$query="select * from tbltestrates";
								$query_my5 = mysqli_query($con,$query5);
								$num5 = mysql_num_rows($query_my5);
							?>
                            <td><input type="checkbox" name="rightstatus[]" value="<?php echo $fetchq['RightId'] ?>" <?php if($num5>0){?> checked="checked" <?php }?> /></td>
                            <td>&nbsp;</td>
                          </tr>
                <?php   }?>
            </table>
           </div>
    <div style="clear:both;"></div>
	<input type="hidden" name="employeehiddenid" value="<?php echo $role['EmployeeId']; ?>">
    <div><input type="submit" value="Save" name="update_employee"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
  </div>
             
	  <?php
  }
if(isset($_POST['patient_form_varify']))
  {
	  $query=mysqli_query($con,"select 
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
							 tblpatientreciept.Remarks,
							 tblpatientreciept.PanelId,
							 tblpatientreciept.RefId,
							 tblpatientreciept.ReceiptId,
							 tblpatientreciept.ClinicalDiagnosis,
							 tblpatientreciept.refletterNo,
							 tblpatientreciept.Priority,
							 
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
							 tblpatienttestdetails.Specimenid,
							 
							 tblpoints.lCode
							 
							 from tblpatientreciept
							 INNER JOIN 
							 tblpatienttestdetails
							 ON tblpatientreciept.PatientTestsId = tblpatienttestdetails.patientTestsId
							 INNER JOIN
							 tblpoints
							 ON tblpatientreciept.PointId = tblpoints.PointId
							 
							 where tblpatienttestdetails.patientTestsId=$patienttestid");
	  $role=mysqli_fetch_array($query,MYSQLI_ASSOC);
	  
	   
                		$querytest="select * from tblpatient where PatientId='".$role['PatientId']."'";
						$quer4=mysqli_query($con,$querytest);
						$Patient=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
						
						$querytest="select Name as testname, tstDepartId, tstNameId from tbltest where tstNameId='".$role['tstNameId']."'";
						$quer4=mysqli_query($con,$querytest);
						$Testname=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
				?>
	  
    <h1 class="patienth1"><?php echo $Patient['Name']?> Varify Reciept</h1>
        <div class="upperwrapperdiv">
            <div class="uperleft">
                <div class="uperleftinner1">
                    <input type="radio" name="panel_or_nopanel"  value="panel" onchange="eanbleselect()" <?php if($role['PanelId']!=0){?> checked="checked" <?php }?>/>Panel
                    <input type="radio" name="panel_or_nopanel"  value="nonpanel" <?php if($role['PanelId']==0){?> checked="checked" <?php }?> onchange="disabledselect()" />
                    Non Panel<br />
                    <input type="radio" name="panel_or_nopanel"  value="medicle" onchange="disabledselect()" />Medicle
                    <button id="p_list">P-List</button><br />
                    <select name="panel_list" class="panellist2" onblur="disabled()" disabled="disabled">
                        <option>--Select Panel--</option>
                        <?php
                            $query_panel_list = "SELECT * FROM tblpaneldetails";
                            $result_panel_list = mysqli_query($con,$query_panel_list);
                            while ($record_panel_list = mysqli_fetch_array($result_panel_list,MYSQLI_ASSOC))
                            {
                                ?>
                                        <option value="<?php echo $record_panel_list['PanelId']; ?>" <?php if($role['PanelId']==$record_panel_list['PanelId']){?> selected="selected" <?php }?>>
                                            <?php echo $record_panel_list['Name']; ?>
                                        </option>
                                <?php
                            }
                        ?>
                    </select><br />
                    Ref letter #<br />
                    <input type="text" class="refletterno2" value="<?php echo $role['refletterNo'];?>"/>
                </div>
              <div class="uperleftinner1">
                    <input type="radio" name="normalurgent" value="normal" <?php if($role['Priority']!=1){?> checked="checked" <?php }?> />
                  Normal &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="normalurgent" value="urgent" <?php if($role['Priority']==1){?> checked="checked" <?php }?> />
                    Urgent
              </div>
                <div class="uperleftinner1">
                    Refferd By<br />
                    <input type="radio" name="refferdbyradio" value="doctor" />Doctor &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="refferdbyradio" value="lab"/>Lab <br />
                    <input type="radio" name="refferdbyradio" value="hospetal"/>Hospital &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="refferdbyradio" value="mics"/>Mics
                    <br />
                    
                    <select name="refferdby_doctor" class="refferdby2" >
                        <?php
                            $query_refdoctor_list = "SELECT * FROM tblreferreddoctor";
                            $result_refdoctor_list = mysqli_query($con,$query_refdoctor_list);
                            while ($record_refdoctor_list = mysqli_fetch_array($result_refdoctor_list,MYSQLI_ASSOC))
                            {
                                ?>
                                        <option value="<?php echo $record_refdoctor_list['refId']; ?>" <?php if($role['RefId']==$record_refdoctor_list['refId']){?> selected="selected" <?php }?>>
                                            <?php echo $record_refdoctor_list['Name']; ?>
                                        </option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="uperleftinner1">
                    Mode of Payment<br />
                    <input type="radio" name="m_o_p"  value="CA"  checked="checked"/>Cash &nbsp;&nbsp;&nbsp;<br />
                    <input type="radio" name="m_o_p"  value="Check"/>Check <br />
                    <input type="radio" name="m_o_p"  value="C_C"/>Cridet Card &nbsp;&nbsp;&nbsp;
                    
                    <br />
                    <input type="text" class="refferdby2" name="refferdby" />
                </div>
            </div>
            <div class="uperright">
                <table>
                    <tr>
                        <td>Title</td><td>Phone</td><td>Age</td><td>Gender</td>
                        <?php
                        $gooddate = new DateTime($role['testDate']);
						$formattedgooddate = date_format($gooddate, 'd-M-Y');
						$formattedgooddate_day=date_format($gooddate, 'D');
						$formattedgooddate_time=date_format($gooddate, 'h:i:A');
						?>
                        <td rowspan="2"><input class="current_point_no2" name="current_point_no" value="<?php echo $role['ReceiptId'];?>" type="hidden">
                        <div id="c_p_n_h1">
                            <h1> <?php echo $role['ReceiptId'].'/'.$role['lCode'];?> </h1>
                            <br />
                            <?php echo $formattedgooddate_day;echo " ".$formattedgooddate;echo " ".$formattedgooddate_time?>
                        </div></td>
                    </tr>
                    <tr>
                        <td>
                            <select name="title" class="title2" onchange="changegender(this.value);" disabled="disabled">
                                <?php $que= mysqli_query($con,"select * from tblgender");
                                while($gender=mysqli_fetch_array($que,MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $gender['Type'];?>" <?php if($gender['Type']==$Patient['Sex']){ ?> selected="selected" <?php }?> ><?php echo $gender['Gender'];?></option>
                                <?php  } ?>
                            </select>
                        </td>
                        <td><input type="text" name="phone" value="<?php echo $Patient['PhoneNo']?>" class="phone_number2" disabled="disabled"/></td>
                        
                        <td>
                            <input type="text" name="age" class="age2" value="<?php echo $Patient['Age']?>" disabled="disabled"/> 
                            <select name="agetype" class="agetype2" disabled="disabled">
                              <option value="year" <?php if($Patient['AgeType']=='year'){?> selected="selected"<?php }?>>year</option>
                              <option value="month" <?php if($Patient['AgeType']=='month'){?> selected="selected"<?php }?>>Month</option>
                              <option value="day" <?php if($Patient['AgeType']=='day'){?> selected="selected"<?php }?>>Day</option>
                            </select>
                        </td>
                        <td><select name="gender" class="gender2" disabled="disabled">
                        <option value="1" <?php if($Patient['Sex']=='1'){?> selected="selected"<?php }?>>Male</option>
                        <option value="2" <?php if($Patient['Sex']=='2'){?> selected="selected"<?php }?>>Female</option>
                        <option value="3" <?php if($Patient['Sex']=='3'){?> selected="selected"<?php }?>>MC</option>
                        <option value="4" <?php if($Patient['Sex']=='4'){?> selected="selected"<?php }?>>FC</option>
                        </select></td>
                    </tr>
                </table>
                <?php if($role['PanelId']==0){?> 
                <table>
                    <tr>
                        <td>Name</td><td>S/O,D/O,W/O</td><td>Address / Email</td><td>NIC / Passport</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="name" class="name2" value="<?php echo $Patient['Name']?>" disabled="disabled" />
                        </td>
                        <td><input type="text" name="sodowo" class="sodowo2" value="<?php echo $Patient['GuardianName']?>" disabled="disabled"/></td>
                        <td><input type="text" name="address" value="<?php echo $Patient['Address']?>" disabled="disabled"/></td>
                        <td><input type="text" name="nic_passport" value="<?php echo $Patient['NIC']?>" disabled="disabled"/></td>
                    </tr>
                </table>
                 <?php }else{?>
                 <table>
                    <tr>
                        <td>PatientName</td><td>EmployeeName</td><td>Department</td><td>Designation</td><td>Rel-with-Emp</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="name" id="name" value="<?php echo $Patient['Name']?>" disabled="disabled" />
                        </td>
                        <td><input type="text" name="sodowo" id="sodowo" value="<?php echo $Patient['GuardianName']?>" disabled="disabled"/></td>
                        <td><input type="text" name="departments" class="departmenttextfield2" value="<?php echo $Patient['departments']?>" disabled="disabled"/></td>
                        <td><input type="text" class="designationtextfield2" name="designations" value="<?php echo $Patient['designations']?>" disabled="disabled"/></td>
                        <td><input type="text" name="relationwithemp" value="<?php echo $Patient['relationwithemp']?>" disabled="disabled"/></td>
                    </tr>
                </table>
                <?php }?>
                <h5 class="test">Test</h5>
                <table class="contenttable">
                    <tr>
                        <td>Descreption</td><td>Price</td><td>LabRefId</td>
                        <td>Delivry Date</td><td>Hour</td><td>Min</td><td>AM/PM</td><td>Due</td><td>Urgent</td>
                    </tr>
                    <?php 
					$yui="select * from tblpatienttestdetails where patientTestsId = '".$role['PatientTestsId']."'";
					$rty=mysqli_query($con,$yui);
					while($alltests=mysqli_fetch_array($rty,MYSQLI_ASSOC)){
						?>
                    <tr>
                        <td>
                            
                            <select name="description" class="description21"  disabled="disabled">
                                <?php $que= mysqli_query($con,"select tstNameId, Name from tbltest order by Name ASC");
                                 while($testna=mysqli_fetch_array($que,MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $testna['tstNameId'];?>" <?php if($testna['tstNameId']==$alltests['tstNameId']){?> selected="selected" <?php }?>>
									<?php echo $testna['Name'];?>
                                </option>
                                <?php  } ?>
                            </select>
                        </td>
                        <td><input type="text" class="price" name="testprice" disabled="disabled" value="<?php echo $alltests['TestRate']; ?>" /></td>
                        <input type="hidden" name="testpricehidden" id="testpricehidden" />
                        <td><input type="text" class="labrefclass" name="labrefid" value="<?php echo $alltests['labRefText']?>" disabled="disabled"/></td>
                        <td>
                        <input type="text" name="delivrydate" class="delivrydate2" class="datepicker" value="<?php echo $alltests['deliveryDate']?>" disabled="disabled"/>
                        </td>
                       <?php $delivrytime=explode(':',$alltests['deliveryTime'])?>
                        <td><input type="text" class="hour2" name="hours" value="<?php echo $delivrytime[0];?>" disabled="disabled"/></td>
                        <td><input type="text" class="minut2" name="minuts"  value="<?php echo $delivrytime[1];?>" disabled="disabled"/></td>
                        <td><select name="ampm" class="ampm2" disabled="disabled">
                            <option <?php if($delivrytime[2]=='AM'){?> selected="selected" <?php }?>>AM</option>
                            <option <?php if($delivrytime[2]=='PM'){?> selected="selected" <?php }?>>PM</option>
                        </select></td>
                        <td><input type="checkbox" name="due" value="1" <?php if($alltests['SpecimenDue']==1){?> checked="checked" <?php }?>/></td>
                        <td><input type="checkbox" name="urgent" value="1" <?php if($alltests['ReqUrgent']==1){?> checked="checked" <?php }?>/></td>
                    </tr>
					<?php } ?>
                </table>
                <?php
					if($role['IsCanceled']==1)
					{
						echo "<img src='$ru/images/cancle.jpg'>";
					}
					?>
            </div>
        </div>
        
        <div class="lowerwrapperdiv">
            <div class="specimen">
                Speciman
                <div class="specimaninner2">
                    <?php
                    $qu="select tblspecimens.SpecimenId, tblspecimens.SpecimenName,
					tblpatienttestdetails.Specimenid
				   from tblpatienttestdetails
				   INNER JOIN tblspecimens
				   ON tblspecimens.SpecimenId=tblpatienttestdetails.Specimenid
				   where tblpatienttestdetails.patientTestsId = '".$role['PatientTestsId']."'";
					//echo $qu;
					$qs=mysqli_query($con,$qu);
					if(mysql_num_rows($qs)>0)
					{
						while($que=mysqli_fetch_array($qs,MYSQLI_ASSOC))
						{
					?>
                              <input type="checkbox" name="speciman" value="<?php echo $que['SpecimenId']?>" checked="checked" disabled="disabled"/>
                              &nbsp; <?php echo $que['SpecimenName']?><br />
                    <?php }
					}?>
                </div>
            </div>
            <div class="out">
                <h4 class="outh4">Out</h4>
                <div style="clear:both"></div>
                <div class="outinner2">
                    <?php
                    $qu="select tblspecimens.SpecimenId, tblspecimens.SpecimenName,
						 tblpatienttestdetails.Specimenid,
						 tblpatienttestdetails.TestLocal
						 from tblpatienttestdetails
						 INNER JOIN tblspecimens
						 ON tblspecimens.SpecimenId=tblpatienttestdetails.Specimenid
						 where tblpatienttestdetails.patientTestsId = '".$role['PatientTestsId']."'";
					//echo $qu;
					$qs=mysqli_query($con,$qu);
					if(mysql_num_rows($qs)>0)
					{
						while($que=mysqli_fetch_array($qs,MYSQLI_ASSOC))
						{
					?>
                              <input type="checkbox" name="speciman_out" value="<?php echo $que['SpecimenId']?>" <?php if($que['TestLocal']==0){?> checked="checked" <?php } ?> disabled="disabled"/>
                              <br />
                    <?php }
					}?>
                </div>
            </div>
            <form  method="post" name="myform" class="myform">
            <div class="finaldiv">
                <table border="1">
                    <tr>
                    	<th colspan="4">Bottles</th>
                    </tr>
                    <tr id="ghjk1">
                        <td width="100"><b style="text-align:center">Bottles</b></td>
                        <td><b style="text-align:center">Qty</b></td>
                        <td><b style="text-align:center">LabRefN</b></td>
                        <td><b style="text-align:center">RecieptN</b></td>
                    </tr>
                    <tr>
                        <td>
                        	<select name="bottle[0]" style="width:100px;">
                                <?php $que= mysqli_query($con,"select * from tblspecimenbottles");
                                 while($Bottle=mysqli_fetch_array($que,MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $Bottle['ContainerId'];?>" >
									<?php echo $Bottle['ContainerName'];?>
                                </option>
                                <?php  } ?>
                            </select>
                        </td>
                        <td><input type="text" name="quantity[0]"/></td>
                        <td><input type="checkbox" name="labrefname[0]" checked="checked" /></td>
                        <td><input type="checkbox" name="recieptno[0]" checked="checked" /></td>
                    </tr>
               </table>
                <div id="apendeddivbottle"></div>
                <div id="anotherdivbottle"><style>#anothertest{display:none;}</style></div>
                <a href="#" id="anotherbottle">Add Another Bottle</a>
                <script type="text/javascript" language="javascript">
				  var counter2 = 1;
				  $('#anotherbottle').click(function(){
					  $('#apendeddivbottle').append('<table border="1"><tr><td><select name="bottle['+counter2+']" style="width:100px;"><?php $que= mysqli_query($con,"select * from tblspecimenbottles");while($Bottle=mysqli_fetch_array($que,MYSQLI_ASSOC)) { ?><option value="<?php echo $Bottle['ContainerId'];?>" ><?php echo $Bottle['ContainerName'];?></option><?php  } ?></select></td><td><input type="text" name="quantity['+counter2+']"/></td><td><input type="checkbox" name="labrefname['+counter2+']" checked="checked" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="checkbox" name="recieptno['+counter2+']" checked="checked" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>');
					  counter2++;
					});
				</script>
                <input type="hidden" name="varifyspeciman_patienttestid" value="<?php echo $patienttestid;?>" />
                <button type="submit" name="varifyspeciman" >Varify Speciman</button>
                <button type="reset" onclick="ReciptCancelfuction('<?php echo $patienttestid;?>')" <?php if($role['IsCanceled']==1){?> disabled="disabled" <?php }?>> 
                	Cancel Reciept
                </button>
                
            </div>
            </form>
            <script>
				  $('.myform').submit(function() {  
				  $(this).serialize(); 
				  //alert(sss);// check to show that all form data is being submitted
				  $.post("<?php echo $ru;?>process/process_ajax.php",$(this).serialize(),function(data){
					 // alert(data); //check to show that the calculation was successful    
					 alert('Speciman Varified Succussfully');                    
				  });
				  return false; // return false to stop the page submitting. You could have the form action set to the same PHP page so if people dont have JS on they can still use the form
				  });
          </script>
        </div>
             
	  <?php
  }
if(isset($_POST['varifyspeciman_patienttestid']))
  {
	$queryupdatpoint="update tblpatienttestdetails set isVerified=1, verifyBy='".$_SESSION['user']['uid']."' where patientTestsId='".$_POST['varifyspeciman_patienttestid']."'";	
			//echo $queryupdatpoint;exit;
			mysqli_query($con,$queryupdatpoint); //echo "sanaullah";
		}
if(isset($_POST['clearpatientdues']))
  {
	  $query=mysqli_query($con,"select * from tblpatientreciept
	  						where patientTestsId=$patienttestid");
	  $role=mysqli_fetch_array($query,MYSQLI_ASSOC);
				?>
	  
    <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>Patient Dues</h1>
        <table>
        	<tr>
            	<td>Reciept Id</td><td><input type="text" name="ReceiptId" style="width:340px;" value="<?php echo $role['ReceiptId'];?>" /></td>
            
            	<td>Test Date</td><td><input type="text" name="testDate" style="width:340px;" value="<?php echo $role['testDate'];?>" /></td>
            </tr>
            <tr>
            	<td>Net Bill</td><td><input type="text" name="netBill" style="width:340px;" value="<?php echo $role['netBill'];?>" /></td>
            
            	<td>Total Bill</td><td><input type="text" name="totalBill" style="width:340px;" value="<?php echo $role['totalBill'];?>" /></td>
            </tr>
            <tr>
            	<td>Discount</td><td><input type="text" name="Discount" style="width:340px;" value="<?php echo $role['Discount'];?>" /></td>
            
            	<td>Discount By</td><td><input type="text" name="discountBy" style="width:340px;" value="<?php echo $role['discountBy'];?>" /></td>
            </tr>
            <tr>
            	<td>Recieved</td><td><input type="text" name="Received" style="width:340px;" value="<?php echo $role['Received'];?>" /></td>
            
            	<td>Balance</td><td><input type="text" name="Balance" style="width:340px;" value="<?php echo $role['Balance'];?>" /></td>
            </tr>
            <tr>
            	<td>Due Discount</td><td><input type="text" name="duediscount" style="width:340px;" value="0"/></td>
            
            	<td>Clear Dues</td><td><input type="text" name="cleardues" style="width:340px;" value="<?php echo $role['Balance'];?>"/></td>
            </tr>
            <tr>
            	<td>Remarks</td><td colspan="3"><textarea cols="93" name="remarks" value="<?php echo $role['ReceiptId'];?>"></textarea></td>
            </tr>
        </table>
        <input type="hidden" name="PatientTestsId" value="<?php echo $role['PatientTestsId'];?>" />
        <div><input type="submit" value="Save" name="ClearPatientDues"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
        <?php
  }
if(isset($_POST['priceautofil']))
  {
		$rty="select * from tbltestrates WHERE `panelId` ='".$_POST['panel_list']."' and `tstNameId` =$tbltestid";
		//echo $rty;
		$nquer =mysqli_query($con,$rty);
		$fet=mysqli_fetch_array($nquer,MYSQLI_ASSOC);
		echo $fet['Rate'];
  }
if(isset($_POST['ReciptCancel']))
  {
		$rty="update tblpatientreciept SET IsCanceled=1 WHERE `PatientTestsId` ='".$_POST['patienttestid']."'";
		//echo $rty;
		$nquer =mysqli_query($con,$rty);
		echo "<img src='$ru/images/cancle.jpg'>";
  }
if(isset($_POST['specimanautofil']))
  {
			$quyt="select tbltestsspecimen.tstNameId, tbltestsspecimen.SpecimenId, tblspecimens.SpecimenName
			 from tbltestsspecimen
			 INNER JOIN tblspecimens
			 ON tbltestsspecimen.SpecimenId=tblspecimens.SpecimenId
			  WHERE tbltestsspecimen.tstNameId=$tbltestid";
			  //echo $quyt;
			$nquer =mysqli_query($con,$quyt);
			$fet=mysqli_fetch_array($nquer,MYSQLI_ASSOC);
			?>
			<input type="checkbox" name="speciman[<?php echo $counter;?>]" value="<?php echo $fet['SpecimenId'];?>" />
			<?php
			echo $fet['SpecimenName'].'<br>';
  }
if(isset($_POST['out_autofil']))
  {
			$quyt="select tbltestsspecimen.tstNameId, tbltestsspecimen.SpecimenId, tblspecimens.SpecimenName
			 from tbltestsspecimen
			 INNER JOIN tblspecimens
			 ON tbltestsspecimen.SpecimenId=tblspecimens.SpecimenId
			  WHERE tbltestsspecimen.tstNameId=$tbltestid";
			  //echo $quyt;
			$nquer =mysqli_query($con,$quyt);
			$fet=mysqli_fetch_array($nquer,MYSQLI_ASSOC);
			?>
			<input type="checkbox" name="speciman_out[<?php echo $counter;?>]" value="<?php echo $fet['SpecimenId'];?>" /><br />
			<?php
  }
if(isset($_POST['labrefid_autofil']))
  {
			$quyt="select tbltestdepartments.Code, tbltestdepartments.CatSeqNo, tbltestdepartments.isstaticdeptcode, tbltest.tstNameId
			 from tbltestdepartments
			 INNER JOIN tbltest
			 ON tbltestdepartments.tstDepartId=tbltest.tstDepartId
			  WHERE tbltest.tstNameId=$tbltestid";
			  //echo $quyt;
			$nquer =mysqli_query($con,$quyt);
			$fet=mysqli_fetch_array($nquer,MYSQLI_ASSOC);
			
			
			
			if (in_array($fet['tstNameId'], $_SESSION['test_ids']) && $fet['isstaticdeptcode']== 1) 
			{
				$CatSeqNo=$fet['CatSeqNo'];
			}
			else
			{
				$CatSeqNo=$fet['CatSeqNo']+1;
			}
			$queryupdaseq="update tbltestdepartments set CatSeqNo=$CatSeqNo where Code='".$fet['Code']."'";	
			mysqli_query($con,$queryupdaseq);
			
			$labrefid=$fet['Code'].'-'.$CatSeqNo;
			
			array_push($_SESSION['test_ids'],$tbltestid);
			//print_r($_SESSION['test_ids']);
			
			echo $labrefid;
  }
if(isset($_POST['filpatientid']))
  {
		$query="select tblpatient.Name as patient_Name,
							 tblpatient.PatientId as ptient_id,
							 tblpatient.Age  as patient_Age,
							 tblpatient.AgeType as patient_AgeType,
							 tblpatient.Sex as patient_Sex,
							 tblpatient.PhoneNo as patient_PhoneNo,
							 tblpatient.NIC as patient_NIC,
							 tblpatient.GuardianName as GuardianName,
							 
							 tblpatient.designations as designations,
							 tblpatient.departments as departments,
							 tblpatient.relationwithemp as relationwithemp,
							 tblpatient.Address as patient_Address
							 FROM tblpatient where PatientId = '".$_POST['filpatientid']."'";
	  //echo $query;
	  $exquery=mysqli_query($con,$query);
	  $role=mysqli_fetch_array($exquery,MYSQLI_ASSOC);
	  
	  ?>
	  <script>
		 var myJson = <?php echo json_encode($role) ?>;
	  </script>
	  <?php
		//echo $role['patient_PhoneNo'];	
		}
if(isset($_POST['patientsearch']))
  {
	  ?>
      <div class="welcome">Patient Search   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="divhide()">X</a></div>
      <div>
      <table border="1">
            <tr>
                <th>Open</th>
                <th style="background:#999"><?php echo 'Name';?></th>
                <th style="background:#999"><?php echo 'Age';?></th>
                <th style="background:#999"><?php echo 'Agetype';?></th>
                <th style="background:#999"><?php echo 'Gender';?></th>
                <th style="background:#999"><?php echo 'Phone';?></th>
                <th style="background:#999"><?php echo 'Address';?></th>
                <th style="background:#999"><?php echo 'NIC';?></th>
                <th style="background:#999"><?php echo 'Department';?></th>
            </tr>
	  <?php
	  $query="select 
							 tblpatientreciept.PatientId,
							  
							 tblpatienttestdetails.tstNameId,
							 
							 tblpatient.Name as patient_Name,
							 tblpatient.Age  as patient_Age,
							 tblpatient.AgeType as patient_AgeType,
							 tblpatient.Sex as patient_Sex,
							 tblpatient.PhoneNo as patient_PhoneNo,
							 tblpatient.NIC as patient_NIC,
							 tblpatient.Address as patient_Address
							 
							 from tblpatientreciept
							 INNER JOIN 
							 tblpatienttestdetails
							 ON tblpatientreciept.PatientTestsId = tblpatienttestdetails.patientTestsId
							 INNER JOIN
							 tblpatient
							 ON tblpatientreciept.PatientId = tblpatient.PatientId";
							 if($_POST['text_field']=='phone')
							 {
								 $query.=" WHERE tblpatient.PhoneNo like '%".$_POST['phone']."%'";
							 }
							 else if($_POST['text_field']=='name')
							 {
								 $query.=" WHERE tblpatient.Name like '%".$_POST['name']."%'";
							 }
							// echo $query;
							 $exquery=mysqli_query($con,$query);
							 if(mysql_num_rows($exquery)==0)
							 {
								 echo "<tr><td colspan='9' style='text-align:center'><h1>No Results found</h1></td></tr>";
							 }
							 else
							 {
	  while($role=mysqli_fetch_array($exquery,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td>
                	<a href="#"  onclick="filpatientdetials('<?php echo $role['PatientId']?>')">
                    Fill
                    </a>
                </td>
                
                <td><?php echo $role['patient_Name']?></td>
                <td><?php echo $role['patient_Age']?></td>
                <td><?php echo $role['patient_AgeType']?></td>
                <td><?php echo $role['patient_Sex']?></td>
                <td><?php echo $role['patient_PhoneNo'];?></td>
                <td><?php echo $role['patient_NIC']?></td>
                <td><?php echo $role['patient_Address']?></td>
                 <?php
                		$querytest="select Name as testname, tstDepartId from tbltest where tstNameId='".$role['tstNameId']."'";
						$quer4=mysqli_query($con,$querytest);
						$Testname=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
				
                		$querytest="select Name, isstaticdeptcode from tbltestdepartments where tstDepartId='".$Testname['tstDepartId']."'";
						$quer4=mysqli_query($con,$querytest);
						$Department=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
				?>
                <td><?php echo $Department['Name']?></td>
            </tr>
            <div  id="creatrecipt<?php echo $role['PatientTestsId']?>" class="reveal-modal">
            	<?php //echo $role['PatientTestsId']?>
            </div>
			<?php
		}
			 }
		?></table></div><?php
  }
if(isset($_POST['updatepanel']))
  {
      $neque="select * from tblpaneldetails where PanelId ='".$_POST['PanelId']."'";
	  $my2query=mysqli_query($con,$neque);
      $mypanel = mysqli_fetch_array($my2query,MYSQLI_ASSOC);
	  ?>
    <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    <h1>Update Panel</h1>
    <table>
        <tr>
          <td width="140">Point</td>
          <td><select name="point">
          			<option>--SELECT--</option>
                <?php $newquery="select * from tblpoints";
                      $myquery=mysqli_query($con,$newquery);
                      while($myfetch = mysqli_fetch_array($myquery,MYSQLI_ASSOC))
                      {
                ?>     
                <option value="<?php echo $myfetch['PointId']?>" <?php if($myfetch['PointId']==$mypanel['PointId']){?> selected="selected" <?php }?>><?php echo $myfetch['location']?></option> 
                <?php } ?>
          </select>
          </td>
          <td>Panel Code</td><td><input type="text" name="panelcode" value="<?php echo $mypanel['PanelCode'];?>"/></td>
        <tr>
        <tr>
          <td width="120">Panel Name</td><td colspan="3"><input type="text" name="panelname" value="<?php echo $mypanel['Name'];?>" style="width:100%;" /></td>
        <tr>
        <tr>
          <td width="120">Address</td><td colspan="3"><input type="text" name="address" value="<?php echo $mypanel['Address'];?>" style="width:100%;" /></td>
        <tr>
        <tr>
          <td width="120">Phone</td><td><input type="text" name="phone" value="<?php echo $mypanel['Phone'];?>" /></td><td>Mobile</td><td><input type="text" name="mobile" value="<?php echo $mypanel['Mobile'];?>" /></td>
        <tr>
        <tr>
          <td width="120">Fax</td><td><input type="text" name="fax" value="<?php echo $mypanel['Fax'];?>" /></td><td>EMail</td><td><input type="email" name="eamil" value="<?php echo $mypanel['Email'];?>" /></td>
        <tr>
        <tr>
          <td width="120">Create Date</td><td><input type="text" name="createdate"  value="<?php echo $mypanel['CreatedDate'];?>"/></td><td>Contact person</td><td><input type="text" name="Contact_person"  value="<?php echo $mypanel['Contact_person'];?>"/></td>
        <tr>
       
        <tr>
          <td width="120">Is Active</td><td><input type="checkbox" name="isactive" <?php if($mypanel['isActive']==1){?> checked="checked" <?php }?> />&nbsp;Yes</td>
          <td>Show Price</td><td><input type="checkbox" name="showprice" <?php if($mypanel['showPrice']==1){?> checked="checked" <?php }?> />&nbsp;Yes</td>
        <tr>
        <tr>
          <td width="120">Remarks</td><td colspan="3"><input type="text" name="remarks" style="width:100%;"  value="<?php echo $mypanel['Description'];?>"/></td>
        <tr>
        
         <tr>
          <td width="120">% Discount</td><td><input type="text" name="dicount_rate" id="dicount_rate" />%</td>
          <td>
          <select name="discount_city_rate" id="discount_city_rate" onchange="discountrates(this.value)">
                <option value="0">--Select--</option>
                <option value="5">--Rawalpind Rates--</option>
                <option value="102">--Islamabd Rates--</option>
          </select>
          </td>
         
        <tr>
        <tr>
          <td width="120">Copy Rates From</td><td colspan="2">
          <select name="copyratefrom" style="width:100%;" onchange="copyratesfrom(this.value)" >
          <option>--SELECT--</option>
          <?php $newquery="select * from tblpaneldetails";
                $myquery=mysqli_query($con,$newquery);
                while($myfetch = mysqli_fetch_array($myquery,MYSQLI_ASSOC))
                {
          ?>     
                    <option value="<?php echo $myfetch['PanelId']?>" <?php if($myfetch['PanelCode']==$mypanel['PanelCode']){?> selected="selected" <?php }?>><?php echo $myfetch['Name']?></option> 
          <?php } ?>
          </select>
          </td>
        <tr>
         <!--<tr>
          <td width="120">Search Test</td>
          <td colspan="3">
          <input type="text" name="search" />
          <button>Search</button>    <button>Clear Search</button>    <button>Export to file</button>   <button>Print Grid</button>
          </td>
        <tr>-->
    </table>
    <div style="overflow:auto; height:200px;" class="copyrates">
        <table class="testrates">
            <tr>
                <th style="width:280px;">Test Name</th>
                <th style="width:280px;">Rate</th>
                
            </tr>
            <?php
                  $query="SELECT * from tbltest order by Name ASC";
                    //$query="select * from tbltestrates";
                    $query_my = mysqli_query($con,$query);
                    while($fetchq = mysqli_fetch_array($query_my,MYSQLI_ASSOC))
                        {
            ?>
                          <tr>
                              <td><?php echo $fetchq['Name'];?></td>
                               <?php 
							   $query2="SELECT * from tbltestrates WHERE panelId='".$_POST['PanelId']."' AND tstNameId='".$fetchq['tstNameId']."'";
							   //echo $query2;
								$query_rate = mysqli_query($con,$query2);
								$rows=mysql_num_rows($query_rate);
								if($rows>0)
								{
								$fetrate = mysqli_fetch_array($query_rate,MYSQLI_ASSOC);
								?>
                              <td><input type="text" name="<?php echo $fetchq['tstNameId'];?>" value="<?php echo $fetrate['Rate'];?>"/></td>
                              <?php }else{?>
                              <td><input type="text" name="<?php echo $fetchq['tstNameId'];?>" /></td>
                              <?php }?>
                              
                          </tr>
            <?php 		} ?>
        </table>
    </div>
    <input type="hidden"  name="update_panel_id" value="<?php echo $_POST['PanelId'];?>"/>
    <div><input type="submit" value="Update" name="update_panel"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    
  </div>
  <?php
  }
if(isset($_POST['updateDepartment']))
  {
      $neque="select * from tbltestdepartments where tstDepartId ='".$_POST['DepartmentlId']."'";
	  $my2query=mysqli_query($con,$neque);
      $myDepartment = mysqli_fetch_array($my2query,MYSQLI_ASSOC);
	  ?>
    <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    <h1>Update Test Department</h1>
    <table>
        <tr>
        	<td>Department Code</td>
            <td colspan="2">
            	<input type="text" style="width:100%" name="departmentcode" value="<?php echo $myDepartment['Code'];?>" />
            </td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Department Name</td>
            <td colspan="3">
            	<input type="text" style="width:100%" name="departmentname"  value="<?php echo $myDepartment['Name'];?>" />
            </td>
        </tr>
        
        <tr>
            <td>Is Active</td>
            <td><input type="checkbox" name="Active" value="1" <?php if($myDepartment['isActive']==1){?> checked="checked"<?php }?>/>&nbsp;Yes</td>
            <td><input type="checkbox" name="samenoinrecipt" value="1"  <?php if($myDepartment['isstaticdeptcode']==1){?> checked="checked"<?php }?>/></td>
            <td>Same No. in one reciept</td>
        </tr>
        
        <tr>
            	<td>Routine Number</td>
                <td>
                	<select name="routine_number">
                   <?php 
							$nquery=mysqli_query($con,"select * from tblroutinenumber");
							while($routinumber=mysqli_fetch_array($nquery,MYSQLI_ASSOC))
							{
				  ?>
				  <option value="<?php echo $routinumber['routine_id'];?>" <?php if($routinumber['routine_id']==$myDepartment['routine_num_change']) {?> selected="selected" <?php }?> >
				  <?php echo $routinumber['routine_name'];?>
				  </option>
				  <?php
							}
				  ?>
                    </select>
                </td>
            </tr>
        
        <tr>
            <td>Remarks</td>
            <td colspan="3">
            	<textarea name="remarks"> <?php echo $myDepartment['Description'];?></textarea>
            </td>
        </tr>
    </table>
    <input type="hidden" name="tstDepartId" value="<?php echo $myDepartment['tstDepartId'];?>" />
    <div><input type="submit" value="Update" name="update_testdepartment"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <a class="close-reveal-modal">&#215;</a>
  </div>
  <?php
  }
if(isset($_POST['updatetest']))
  {
      $neque="select * from tbltest where tstNameId ='".$_POST['testid']."'";
	  $my2query=mysqli_query($con,$neque);
      $myTest = mysqli_fetch_array($my2query,MYSQLI_ASSOC);
	  ?>
    <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<div style="float:left; width:500px; height:306px;">
        	<h1><?php echo $myTest['Name'];?> Test</h1>
            <table>
            	<tr>
                	<td>Test Name</td><td><input type="text" name="testname" value="<?php echo $myTest['Name']; ?>" /></td>
                    <td>Test Type</td>
                    <td>
                    <select name="testtype">
                        <?php $ssquery="select * from reporttype";
							  $don=mysqli_query($con,$ssquery);
							  while($donfetch=mysqli_fetch_array($don,MYSQLI_ASSOC))
							  	{
						?>
								<option value="<?php echo $donfetch['id'];?>" <?php if($donfetch['id']==$myTest['TestReportType']){?> selected="selected" <?php }?>>
									<?php echo $donfetch['ReportType'];?>
                                </option>
						<?php	
								}
						?>
                        </select></td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                </tr>
                <tr>
                	<td>Test Code</td><td><input type="text" name="testcode" value="<?php echo $myTest['Code']; ?>"/></td>
                </tr>
                <tr>
                	<td>Test Department</td>
                    <td>
                    	<select name="departments">
                        <?php $ssquery="select * from tbltestdepartments";
							  $don=mysqli_query($con,$ssquery);
							  while($donfetch=mysqli_fetch_array($don,MYSQLI_ASSOC))
							  	{
						?>
								<option value="<?php echo $donfetch['tstDepartId'];?>" <?php if($donfetch['tstDepartId']==$myTest['tstDepartId']){?> selected="selected" <?php }?>>
									<?php echo $donfetch['Name'];?>
                                </option>
						<?php	
								}
						?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td>Test Header</td><td><input type="text" name="testheader" value="<?php echo $myTest['Heading']; ?>"/></td>
                </tr>
                <tr>
                	<td>Chemical used</td><td><input type="text" name="chemicalused" value="<?php echo $myTest['chemicalUsed']; ?>"/></td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Perform Time</td><td><input type="text" name="performtime" class="datepicker" value="<?php echo $myTest['tstPerformTime']; ?>"/> </td>
                    <td>Heading 1</td><td><input type="text" name="heading1" value="<?php echo $myTest['Column1']; ?>"/></td>
                </tr>
                <tr>
                     <td>Is Active</td><td><input type="checkbox" name="isactive" <?php if($myTest['isActive']==1){?> checked="checked" <?php }?> />&nbsp;Yes</td>
                     <td>Heading 2</td><td><input type="text"  name="heading2" value="<?php echo $myTest['Column2']; ?>"/></td>
                </tr>
                
                <tr>
                	<td>Text Only</td><td><input type="checkbox" name="textonly" <?php if($myTest['IsTextOnly']==1){?> checked="checked" <?php }?>/>&nbsp;Yes</td>
                </tr>
                <tr>
                       <td>Test Not Required</td><td><input type="checkbox" name="testnotrequired" <?php if($myTest['IsAvailable']==1){?> checked="checked" <?php }?> />&nbsp;Yes</td>
                       <td>Heading 3</td><td><input type="text"  name="heading3" value="<?php echo $myTest['Column3']; ?>"/></td>
                </tr>
                
                <tr>
                	<td>Remarks</td><td colspan="3"><input type="text" style="width:100%;" name="remarks" value="<?php echo $myTest['Remarks']; ?>"/></td>
                </tr>
            </table>
        </div>
        <div style="width:150px; float:left; height:306px;">
        	Specific Bottle
            <div style="background:#fff; overflow:auto; width:150px; height:100px;">
            	<?php $ssquery="select * from tblspecimenbottles ORDER BY ContainerName ASC";
							  $don=mysqli_query($con,$ssquery);
							  while($donfetch=mysqli_fetch_array($don,MYSQLI_ASSOC))
							  	{
						?>
                        			<?php
                                      		$ssquery2="select * from tbltestsspbottles where SpBottleId='".$donfetch['ContainerId']."' AND TestId='".$myTest['tstNameId']."'";
											$don2	 	=	mysqli_query($con,$ssquery2);
											$rows	=	mysql_num_rows($don2);
									  ?>
  									<input type="checkbox" name="bottles[]" value="<?php echo $donfetch['ContainerId']?>" <?php if($rows>0){?> checked="checked" <?php }?>/> 
                                    &nbsp;<?php echo $donfetch['ContainerName']?><br />
						<?php	
								}
						?>
            </div>
            Speciman
            <div style="background:#fff; overflow:auto; width:150px; height:100px;">
                 <?php $ssquery="select * from tblspecimens ORDER BY SpecimenName ASC";
							  $don=mysqli_query($con,$ssquery);
							  while($donfetch=mysqli_fetch_array($don,MYSQLI_ASSOC))
							  	{
						?>
                                      <?php
                                      		$ssquery2="select * from tbltestsspecimen where SpecimenId='".$donfetch['SpecimenId']."' AND tstNameId='".$myTest['tstNameId']."'";
											$don2	 	=	mysqli_query($con,$ssquery2);
											$rows	=	mysql_num_rows($don2);
									  ?>
                                      <input type="checkbox" name="speciman[]" <?php if($rows>0){?> checked="checked" <?php }?> value="<?php echo $donfetch['SpecimenId']?>"/> 
                                      &nbsp;<?php echo $donfetch['SpecimenName']?><br />
						<?php	
								}
						?>
            </div>
            <div style="overflow:hidden; width:150px; height:100px;">
            	<table>
                	<tr>
                    	<td>Show Machine</td><td><input type="checkbox" name="showmachine" <?php if($myTest['ShowMachineDetails']==1){?> checked="checked" <?php }?> />&nbsp;Yes</td>
                    </tr>
                    <tr>
                    	<td>Show Graph</td><td><input type="checkbox" name="showgraph" <?php if($myTest['ShowGraph']==1){?> checked="checked" <?php }?>  />&nbsp;Yes</td>
                    </tr>
                    <tr>
                    	<td colspan="2">Create Date<input type="text" style="width:75px;" class="datepicker" name="creatdate" value="<?php echo $myTest['startDate']?>"/></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="apendprardiv2">
       		 <p style="text-align:center;">Parameter List</p>
             <table border="1">
                    	<?php 
						$parmeter="SELECT * FROM tbltestparameters WHERE tstNameId = '".$myTest['tstNameId']."'";
						//echo $parmeter;
						$par=mysqli_query($con,$parmeter);
						$rows=mysql_num_rows($par);
						?>
                        <tr>
                        	<th colspan="2"> Name</th>
                            <th>Heading</th>
                            <th>SequenceN</th>
                            <th>Unit</th>
                            <th>IsCalculate</th>
                            <th>Option</th>
                            <th width="100">DefaultResult</th>
                            <th>Remark</th>
                            
                            
                        </tr>
                        <?php
                        
						while($ParFetch=mysqli_fetch_array($par,MYSQLI_ASSOC))
						{ 
						  ?>
						<tr>
                        	<td><a href="#" onclick="togglerefrencevalues('<?php echo $ParFetch['tstParaId'];?>')"><b>+</b></a></td>
                            <td><?php echo $ParFetch['Name'];?></td>
                            <td>
                            <?php echo $ParFetch['Heading'];?>
                            </td>
                            <td>
                            <?php echo $ParFetch['SequenceNo'];?>
                            </td>
                            <td><?php echo $ParFetch['Unit'];?></td>
                            <td>
							<input type="checkbox" name="iscalculated" <?php if( $ParFetch['IsCalculated']!=0){?> checked="checked" <?php }?> />
                            </td>
                            
                            <td><input type="checkbox" name="iscalculated" <?php if( $ParFetch['Optional']!=0){?> checked="checked" <?php }?> /></td>
                            <td><?php echo $ParFetch['DefaultResult'];?></td>
                            <td><?php echo $ParFetch['Remarks'];?></td>
                            
                        </tr>
                        <tr id="<?php echo $ParFetch['tstParaId'];?>" style="display:none;">
                        	<td colspan="8">
							<?php
								$refvalue="select * from tblreferencevalues where tstParaId='".$ParFetch['tstParaId']."'";
								$refvaluequ=mysqli_query($con,$refvalue);
								$refvaluefe=mysqli_fetch_array($refvaluequ,MYSQLI_ASSOC);
								
							 ?>
                             	<table border="1">
                                	<tr>
                                    	<td>Maximum</td><td>Minimum</td><td>Unit</td><td>Description</td><td>Rule</td><td>MachineName</td>
                                    </tr>
                                    <tr>
                                    	<td><?php echo $refvaluefe['Maximum']; ?></td>
                                        <td><?php echo $refvaluefe['Minimum']; ?></td>
                                        <td><?php echo $refvaluefe['Unit']; ?></td>
                                        <td><input value="<?php echo $refvaluefe['Description']; ?>" /></td>
                                        
                                        <?php
											$rerule="select * from tblreferencerule where recid='".$refvaluefe['ReferenceRuleId']."'";
											$rerulequ=mysqli_query($con,$rerule);
											$rerulefe=mysqli_fetch_array($rerulequ,MYSQLI_ASSOC);
											
										 ?>
                                        <td><?php echo $rerulefe['RuleName']; ?></td>
                                        <?php
											$rerule2="select * from tblmachinedetails where machineId='".$refvaluefe['machineId']."'";
											$rerulequ2=mysqli_query($con,$rerule2);
											$rerulefe2=mysqli_fetch_array($rerulequ2,MYSQLI_ASSOC);
											
										 ?>
                                        <td><?php echo $rerulefe2['machineName']; ?></td>
                                    </tr>
                                    
                                </table>
                             </td>
                        </tr>
						<?php 
						}
						?>
                    </table>
                    
        </div>
        <br /><br />
                    <a href="#" id="anotherparameter2">Add Parameter</a>
                    <br /><br />
        <script type="text/javascript" language="javascript">
				  $('#anotherparameter2').click(function(){
					  $('.apendprardiv2').append('<table border="1"><tr><th colspan="2"> Name</th><th>Heading</th><th>SequenceN</th><th>Unit</th><th>IsCalculate</th><th>option</th><th width="100">DefaultResult</th><th>Remark</th></tr><tr><td><a href="#"><b>+</b></a></td><td><input type="text"  class=""></td><td><input type="text"  class="parainput"></td><td><input type="text"  class="parainput"></td><td><input type="input"  class="parainput"></td><td><input type="checkbox"  class="parainput"></td><td><input type="checkbox"  class="parainput"></td><td><input type="text"  class="parainput"></td><td><input type="text"  class="parainput"></td></tr></table>');
					});
					
					$('.datepicker').each(function(){
						$(this).datepicker({ dateFormat: 'yy-mm-dd'});
					});
 				 </script>
        <div>
        <input type="hidden" name="testidhidden" value="<?php echo $myTest['tstNameId']; ?>" />
        <input type="submit" value="Save" name="updatethistest"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
   		</div>
        
  <?php
  }
if(isset($_POST['updatespeciman']))
  {
	  $neque="select * from tblspecimens where SpecimenId ='".$_POST['specimanid']."'";
	  $my2query=mysqli_query($con,$neque);
      $mySpeciman = mysqli_fetch_array($my2query,MYSQLI_ASSOC);
	  ?>
      <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1><?php echo $mySpeciman['SpecimenName'];?> Speciman</h1>
        <table>
        	<tr>
            	<td>Speciman Code</td><td><input type="text" name="specimancode" value="<?php echo $mySpeciman['SpecimenCode'];?>"/></td>
            </tr>
            <tr>
            	<td>Speciman Name</td><td><input type="text" name="specimanname"  value="<?php echo $mySpeciman['SpecimenName'];?>"/></td>
            </tr>
            <tr>
            	<td rowspan="2">Remarks</td><td rowspan="2"><textarea name="ramarks"> <?php echo $mySpeciman['Remarks'];?></textarea></td>
            </tr>
        </table>
        <div>
        <input type="hidden" name="specimanidHidden" value="<?php echo $mySpeciman['SpecimenId'];?>" />
        <input type="submit" value="Save" name="Editespeciman"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
	<?php
  }
if(isset($_POST['updateantibiotec']))
  {
	$neque="select * from tblantibiotics where AntId ='".$_POST['antibiotecid']."'";
	  $my2query=mysqli_query($con,$neque);
      $myAntibiotec = mysqli_fetch_array($my2query,MYSQLI_ASSOC);
	  ?>
      <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1> <?php echo $myAntibiotec['Name'];?></h1>
        <table>
        	<tr>
            	<td>Name</td><td><input type="text" name="name" value="<?php echo $myAntibiotec['Name'];?>" /></td>
            </tr>
            <tr>
            	<td>Code</td><td><input type="text" name="code" value="<?php echo $myAntibiotec['Code'];?>"/></td>
            </tr>
            <tr>
            	<td rowspan="2">Remarks</td><td rowspan="2"><textarea name="ramarks"><?php echo $myAntibiotec['Remarks'];?></textarea></td>
            </tr>
        </table>
        <input type="hidden" name="antibiotecidHidden" value="<?php echo $myAntibiotec['AntId'];?>" />
        <div><input type="submit" value="Save" name="Editantibiotec"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
      <?php }
if(isset($_POST['updatetestnote']))
  {
	$neque="select * from tbltestnotes where NoteId ='".$_POST['testnoteid']."'";
	  $my2query=mysqli_query($con,$neque);
      $myTestnote = mysqli_fetch_array($my2query,MYSQLI_ASSOC);
	  ?>
      <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>New Test Note</h1>
        <table>
        	<tr>
            	<td>Name</td><td><input type="text" name="name" value="<?php echo $myTestnote['NoteName'];?>"/></td>
            </tr>
            <tr>
            	<td>Heading</td><td><input type="text" name="heading"  value="<?php echo $myTestnote['NoteName'];?>"/></td>
            </tr>
            <tr>
            	<td rowspan="2">Note</td><td rowspan="2"><textarea name="note"> <?php echo $myTestnote['NoteName'];?></textarea></td>
            </tr>
        </table>
        <input type="hidden" name="testnotehiddenid" value="<?php echo $myTestnote['NoteId'];?>" />
        <div><input type="submit" value="Save" name="updatetestnote"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
      <?php }
if(isset($_POST['updatePoint']))
  {
      $neque="select * from tblpoints where PointId ='".$_POST['PointId']."'";
	  $my2query=mysqli_query($con,$neque);
      $myPoint = mysqli_fetch_array($my2query,MYSQLI_ASSOC);
	  ?>
    <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>Update Point</h1>
        <table>
        	<tr>
            	<td>Location</td>
                <td>
                <input type="text" name="location" value="<?php echo $myPoint['location'];?>" />
                </td>
                <td>Location Code</td>
                <td>
                <input type="text" name="locationcode"  value="<?php echo $myPoint['lCode'];?>"/>
                </td>
            </tr>
            <tr>
            	<td>Address</td><td colspan="3"><input type="text" name="address" style="width:100%;"  value="<?php echo $myPoint['Address'];?>"/></td>
            </tr>
            <tr>
            	<td>Phone</td><td><input type="text" name="phone"  value="<?php echo $myPoint['PhoneNo'];?>"/></td>
                <td>Fax</td><td><input type="text" name="fax"  value="<?php echo $myPoint['Fax'];?>"/></td>
            </tr>
            <tr>
            	<td>Email</td><td><input type="text" name="email" value="<?php echo $myPoint['Email'];?>"></td>
            </tr>
            <tr>
            	<td>Routine Number</td>
                <td>
                	<select name="routine_number">
                   <?php 
							$nquery=mysqli_query($con,"select * from tblroutinenumber");
							while($routinumber=mysqli_fetch_array($nquery,MYSQLI_ASSOC))
							{
				  ?>
				  <option value="<?php echo $routinumber['routine_id'];?>" <?php if($routinumber['routine_id']==$myPoint['routine_num_change']) {?> selected="selected" <?php }?> >
				  <?php echo $routinumber['routine_name'];?>
				  </option>
				  <?php
							}
				  ?>
                    </select>
                </td>
            </tr>
            <tr>
            	<td>Is Active</td><td><input type="checkbox" name="isactive" <?php if($myPoint['isActive']==1){ ?> checked="checked" <?php }?> /></td>
            </tr>
            <tr>
            	<td>Remarks</td><td colspan="3" rowspan="3"><textarea name="remarks" cols="50" rows="10"> <?php echo $myPoint['Remarks'];?></textarea></td>
            </tr>
           <input type="hidden" value="<?php echo $myPoint['PointId']?>" name="PointId"  />
        </table>
        <div><input type="submit" value="Update" name="update_point"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
  <?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='recenttests')
  {
	  ?>
      <div class="welcome">All Patient Tests</div>
      <div class="content">
       <div>
      <select name="searchby" id="searchby" onchange="checkdatechange(this.value)">
        <option value="Phone">Phone</option>
        <option value="LabrefText">LabrefText</option>
        <option value="Name">Name</option>
        <option value="Date">Date</option>
        <option value="DelivryTime">DelivryTime</option>
        <option value="DelivryTimeStart">Delivry time Start</option>
        <option value="Department">Department</option>
        <option value="TestName">TestName</option>
      </select>
      
      <input type="text" name="searchcat" id="searchcat" /> &nbsp;<input type="text" name="enddate" id="enddate" disabled="disabled" />
      
      <button onclick="searchcat('tblpatienttestdetails')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      </div>
          <div class="searchresults">
            <table border="1">
                <tr>
                    <th>Open</th>
                    <th style="background:#999"><?php echo 'Date';?></th>
                    <th style="background:#999"><?php echo 'Name';?></th>
                    <th style="background:#999"><?php echo 'Age';?></th>
                    <th style="background:#999"><?php echo 'Agetype';?></th>
                    <th style="background:#999"><?php echo 'Gender';?></th>
                    <th style="background:#999"><?php echo 'No';?></th>
                    <th style="background:#999"><?php echo 'Leb-Ref';?></th>
                    <th style="background:#999"><?php echo 'TestName';?></th>
                    <th style="background:#999"><?php echo 'Department';?></th>
                    <th style="background:#999"><?php echo 'Delivery';?></th>
                    <th style="background:#999"><?php echo 'Time';?></th>
                    <th style="background:#999"><?php echo 'Reciept';?></th>
                    <th style="background:#999"><?php echo 'TestStatus';?></th>
                    <th style="background:#999"><?php echo 'TotalBil';?></th>
                    <th style="background:#999"><?php echo 'NetBil';?></th>
                    <th style="background:#999"><?php echo 'Employee';?></th>
                    <th style="background:#999"><?php echo 'Location';?></th>
                    <th style="background:#999"><?php echo 'SpecimanDep';?></th>
                    <th style="background:#999"><?php echo 'Phone';?></th>
                    <th style="background:#999"><?php echo 'IsCancled';?></th>
                    <th style="background:#999"><?php echo 'IsStaticDepCode';?></th>
                </tr>
          <?php
          $query=mysqli_query($con,"select 
                                 tblpatientreciept.PatientId,
                                 tblpatientreciept.PatientTestsId,
                                 tblpatientreciept.totalBill,
                                 tblpatientreciept.netBill,
                                 tblpatientreciept.EmployeeId,
                                 tblpatientreciept.IsCanceled,
                                 tblpatientreciept.testDate,
                                 tblpatientreciept.PointId,
                                 tblpatienttestdetails.tstNameId,
                                 tblpatienttestdetails.deliveryDate,
                                 tblpatienttestdetails.deliveryTime,
                                 tblpatienttestdetails.testStatus,
                                 tblpatienttestdetails.SpecimenDue,
                                 tblpatienttestdetails.labRefId,
                                 tblpatienttestdetails.pTestDetailsId,
                                 tblpatienttestdetails.isVerified,
                                 tblpatientreciept.Balance
                                 
                                 
                                 from tblpatientreciept
                                 INNER JOIN 
                                 tblpatienttestdetails
                                 ON tblpatientreciept.PatientTestsId = tblpatienttestdetails.patientTestsId
                                 ORDER BY tblpatientreciept.testDate DESC
                                 LIMIT 0 , 30");
          while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
            {
                ?>
                <tr <?php if($role['Balance']!=0 && $role['isVerified']==0){?> style="background:#f5f5dc;" <?php } else if($role['Balance']!=0){?>style="background:#f5fffa;" <?php } else if($role['isVerified']==0){?>style="background:f5fffa;" <?php } else { ?> style="background:#fff5ee;" <?php }?>>
                    <td>
                        <a href="#" data-reveal-id="creatrecipt_fill" onclick="patientajax('<?php echo $role['PatientTestsId']?>')">
                        Open
                        </a>
                        <br />
                        <a href="#" data-reveal-id="enterresultsdiv" onclick="enterresultsajax('<?php echo $role['PatientTestsId']?>')">
                        EnterResults
                        </a>
                        <?php if($role['isVerified']==0)
                                {
                                    ?>
                                    <br /><a href="#" data-reveal-id="creatrecipt_fill" onclick="varifyajax('<?php echo $role['PatientTestsId']?>')">Varify</a>
                                    <?php
                                }
                        ?>
                        <?php if($role['Balance']!=0)
                                {
                                    ?>
                                    <br /><a href="#" data-reveal-id="patientdue" onclick="clearPatientdues('<?php echo $role['PatientTestsId']?>')">ClearDues</a>
                                    <?php
                                }
                        ?>
                        
                    </td>
                    <td><?php echo $role['testDate']?></td>
                    <?php
                            $querytest="select tblpatient.Name, tblpatient.Age, tblpatient.AgeType,
                                 tblpatient.Sex, tblpatient.PhoneNo from tblpatient where PatientId='".$role['PatientId']."'";
                            $quer4=mysqli_query($con,$querytest);
                            $Patient=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
                    ?>
                    <td><?php echo $Patient['Name']?></td>
                    <td><?php echo $Patient['Age']?></td>
                    <td><?php echo $Patient['AgeType']?></td>
                    <td><?php echo $Patient['Sex']?></td>
                    <td><?php echo "2";?></td>
                    <td><?php echo $role['labRefId']?></td>
                     <?php
                            $querytest="select Name as testname, tstDepartId from tbltest where tstNameId='".$role['tstNameId']."'";
                            $quer4=mysqli_query($con,$querytest);
                            $Testname=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
                    ?>
                    <td><?php echo $Testname['testname'];?></td>
                    <?php
                            $querytest="select Name, isstaticdeptcode from tbltestdepartments where tstDepartId='".$Testname['tstDepartId']."'";
                            $quer4=mysqli_query($con,$querytest);
                            $Department=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
                    ?>
                    <td><?php echo $Department['Name']?></td>
                    
                    <td><?php echo $role['deliveryDate']?></td>
                    <td><?php echo $role['deliveryTime']?></td>
                    <td><?php echo "New"?></td>
                    <td><?php if($role['testStatus']==1){echo "InProgress";}else{echo "Completed";}?></td>
                    <td><?php echo $role['totalBill']?></td>
                    <td><?php echo $role['netBill']?></td>
                     <?php
                            $querytest="select * from tblemployee where EmployeeId='".$role['EmployeeId']."'";
                            $quer4=mysqli_query($con,$querytest);
                            $Employee=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
                    ?>
                    <td><?php echo $Employee['login']?></td>
                    <?php
                            $querytest="select * from tblpoints where PointId='".$role['PointId']."'";
                            $quer4=mysqli_query($con,$querytest);
                            $Location=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
                    ?>
                    <td><?php echo $Location['location']?></td>
                    <td><input type="checkbox" <?php if($role['SpecimenDue']==1){?> checked="checked"<?php }?> /></td>
                    <td><?php echo $Patient['PhoneNo']?></td>
                    <td><input type="checkbox" <?php if($role['IsCanceled']==1){?> checked="checked"<?php }?> /></td>
                    <td><input type="checkbox" <?php if($Department['isstaticdeptcode']==1){?> checked="checked"<?php }?> /></td>
                </tr>
                
                <?php
            }
            ?></table>
          </div>
        </div><?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='tblroles')
  {
	  ?>
      <div class="welcome">All Roles</div>
      <div class="content">
      <div>
      <a class="nav-bar-links" href="#" data-reveal-id="newrole"><button>New</button></a>&nbsp;&nbsp;
      <select name="searchby" id="searchby">
        <option value="SpecimenName">Name</option>
      </select>
      
      <input type="text" name="searchcat" id="searchcat" /> 
      <input type="hidden" name="enddate" id="enddate" /> 
      <button onclick="searchcat('tblroles')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      <button onclick="ajaxfuction('tblroles')">Clear Search</button>
      </div>
      <div class="searchresults">
      <table border="1">
	  <?php
	  $query=mysqli_query($con,"select * from tblroles ORDER BY `Name` DESC");
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
                <th style="background:#999"><?php echo 'Role Name';?></th>
                <th style="background:#999" colspan="2"><?php echo 'Remarks';?></th>
            </tr>
            <tr>
            	<td style="color:blue;"><?php echo $role['Name']?></td>
                <td style="color:blue;"><?php echo $role['Remarks']?></td>
                <td style="color:blue;"><a href="#" data-reveal-id="updateeverytable" onclick="updateeverytable('tblroles','<?php echo $role['RoleId']?>')">Update</a></td>
            </tr>
            <tr>
                <td colspan="2">
                  <table border="1" style="padding:0 0 0 20px;">
                  	<tr>
                        <th style="background:#999"><?php echo 'Role Name';?></th>
                        <th style="background:#999"><?php echo 'Remarks';?></th>
                    </tr>
                  <?php $query2=mysqli_query($con,"SELECT tblrights.RightId, tblrights.RightName, tblrights.Remarks
											 FROM tblrights INNER JOIN tblrolesrights
											 ON tblrights.RightId=tblrolesrights.RightId
											 where tblrolesrights.RoleId = '".$role['RoleId']."'"); 
                          while($role2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                              {
                                  ?>
                                <tr><td><?php echo $role2['RightName'];?></td><td><?php echo $role2['Remarks'];?></td></tr>
								  <?php
                              }
                  ?>
                  </table>
                </td>
            </tr>
			<?php
		}
		?>
      </table>
      </div>
      </div>
	  <?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='tblrights')
  {
	  ?>
      <div class="welcome">All Rights</div>
      <div class="content">
          <div>
              <select name="searchby" id="searchby">
                <option value="SpecimenName">Name</option>
              </select>
              
              <input type="text" name="searchcat" id="searchcat" /> 
              <input type="hidden" name="enddate" id="enddate" /> 
              <button onclick="searchcat('tblrights')">Search</button>
              <button onclick="PrintElem('.content')">Print Grid</button>
              <button onclick="ajaxfuction('tblrights')">Clear Search</button>
          </div>
      <div class="searchresults">
      <table border="1">
            <tr>
                <th style="background:#999"><?php echo 'Rights';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
            </tr>
	  <?php
	  $query=mysqli_query($con,"select * from tblrights ORDER BY `RightName` DESC");
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['RightName']?></td><td><?php echo $role['Remarks']?></td>
            </tr>
			<?php
		}
		?></table></div></div><?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='tblexpensetype')
  {
	  ?>
      <div class="welcome">Expense Types</div>
            <div class="content">
            <div>
              <select name="searchby" id="searchby">
                <option value="SpecimenName">Name</option>
              </select>
              
              <input type="text" name="searchcat" id="searchcat" /> 
              <input type="hidden" name="enddate" id="enddate" /> 
              <button onclick="searchcat('tblexpensetype')">Search</button>
              <button onclick="PrintElem('.content')">Print Grid</button>
              <button onclick="ajaxfuction('tblexpensetype')">Clear Search</button>
          </div>
      <div class="searchresults">
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Type';?></th>
                <th style="background:#999"><?php echo 'Details';?></th>
                <th style="background:#999"><?php echo 'IsActive';?></th>
                <th style="background:#999"><?php echo 'LastUpdateDate';?></th>
                <th style="background:#999"><?php echo 'Updated By';?></th>
        </tr>
	  <?php
	  $query=mysqli_query($con,"SELECT tblexpensetype.Type, tblexpensetype.Details, tblexpensetype.IsActive, 
	  					  tblexpensetype.LastUpdateDate, tblemployee.login
                          FROM tblexpensetype INNER JOIN tblemployee
                          ON tblexpensetype.UpdateBy=tblemployee.EmployeeId
                          ORDER BY tblexpensetype.Type DESC");
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['Type']?></td>
                <td><?php echo $role['Details']?></td>
                <td><?php echo $role['IsActive']?></td>
                <td><?php echo $role['LastUpdateDate']?></td>
                <td><?php echo $role['login']?></td>
            </tr>
			<?php
		}
		?>
		</table>
        </div>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='tblspecimenbottles')
  {
	  ?>
      <div class="welcome">All Speciman Bottles</div>
            <div class="content">
      <div>
      <a class="nav-bar-links" href="#" data-reveal-id="newbottle"><button>New</button></a>&nbsp;&nbsp;
      <select name="searchby" id="searchby">
        <option value="SpecimenName">Name</option>
      </select>
      
      <input type="text" name="searchcat" id="searchcat" /> 
      <input type="hidden" name="enddate" id="enddate" /> 
      <button onclick="searchcat('tblspecimenbottles')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      <button onclick="ajaxfuction('tblspecimenbottles')">Clear Search</button>
      </div>
      <div class="searchresults">
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Bootle';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
                <th style="background:#999"><?php echo 'Update';?></th>
                
        </tr>
	  <?php
	  $query=mysqli_query($con,"SELECT * from tblspecimenbottles");
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['ContainerName']?></td>
                <td><?php echo $role['Remarks']?></td>
                <td><a href="#" data-reveal-id="updateeverytable" onclick="updateeverytable('tblspecimenbottles','<?php echo $role['ContainerId']?>')">Update</a></td>
            </tr>
			<?php
		}
		?>
		</table>
        </div>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='DepSequnceNo')
  {
	  ?>
      <div class="welcome">Department Squence Numbers</div>
            <div class="content">
      <button onclick="PrintElem('.content')">Print Grid</button>
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Code';?></th>
                <th style="background:#999"><?php echo 'Department Name';?></th>
                <th style="background:#999"><?php echo 'Current Sequence Number';?></th>
                <th style="background:#999"><?php echo 'Update';?></th>
        </tr>
	  <?php
	  $query=mysqli_query($con,"SELECT * from tbltestdepartments order by Name DESC");
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['Code']?></td>
                <td><?php echo $role['Name']?></td>
                <td><?php echo $role['CatSeqNo']?></td>
                <td><a href="#" data-reveal-id="updateeverytable" onclick="updateeverytable('DepSequnceNo','<?php echo $role['tstDepartId']?>')">Update</a></td>
            </tr>
			<?php
		}
		?>
		</table>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='add_book_cat')
  {
	  ?>
      <div class="welcome">All Address Book Categories</div>
      <div class="content">
      <div>
      <a class="nav-bar-links" href="#" data-reveal-id="new_ab_category"><button>New</button></a>&nbsp;&nbsp;
      <select name="searchby" id="searchby">
        <option value="SpecimenName">Name</option>
      </select>
      
      <input type="text" name="searchcat" id="searchcat" /> 
      <input type="hidden" name="enddate" id="enddate" /> 
      <button onclick="searchcat('add_book_cat')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      <button onclick="ajaxfuction('add_book_cat')">Clear Search</button>
      </div>
      <div class="searchresults">
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Name';?></th>
                <th style="background:#999"><?php echo 'Description';?></th>
                <th style="background:#999"><?php echo 'Update';?></th>
        </tr>
	  <?php
	  $query=mysqli_query($con,"SELECT * from tblabcategory order by CName DESC");
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['CName']?></td>
                <td><?php echo $role['Description']?></td>
                <td><a href="#" data-reveal-id="updateeverytable" onclick="updateeverytable('add_book_cat','<?php echo $role['CategoryId']?>')">Update</a></td>
            </tr>
			<?php
		}
		?>
		</table>
        </div>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='all_items')
  {
	  ?>
      <div class="welcome">All Items</div>
     <div class="content">
      <div>
      <a class="nav-bar-links" href="#" data-reveal-id="addnewitem"><button>New</button></a>&nbsp;&nbsp;
      <input name="searchby" id="searchby" type="hidden">
      start:<input type="text" name="searchcat" id="searchcat" class="datepicker" value="<?php echo date('Y-m-d');?>" /> 
      end:<input type="text" class="datepicker" name="enddate" id="enddate"  value="<?php echo date('Y-m-d');?>"/> 
      <button onclick="searchcat('all_items')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      <button onclick="ajaxfuction('all_items')">Clear Search</button>
      </div>
      <div class="searchresults">
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Update';?></th>
                <th style="background:#999"><?php echo 'Item';?></th>
                <th style="background:#999"><?php echo 'Paksize';?></th>
                <th style="background:#999"><?php echo 'Supplier';?></th>
                <th style="background:#999"><?php echo 'Borderline';?></th>
                <th style="background:#999"><?php echo 'Total Quantity';?></th>
                <th style="background:#999"><?php echo 'Prev Price';?></th>
                <th style="background:#999"><?php echo 'Current Price';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
        </tr>
	  <?php
	  $query=mysqli_query($con,"SELECT tblitems.Name as table1Name,tblitems.ItemId, tblitems.PackSize as PackSize, tblitems.borderLine as borderLine,
								tblitems.TotQuantity as TotQuantity, tblitems.previousPrice as previousPrice,tblitems.currentPrice as currentPrice,
											 tblitems.Remarks as Remarks, tblSuppliers.Name as table2Name 
											 FROM tblitems INNER JOIN tblSuppliers
											 ON tblitems.suplierId=tblSuppliers.suplierId");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><a href="#" data-reveal-id="updateeverytable" onclick="updateeverytable('all_items','<?php echo $role['ItemId']?>')">Update</a></td>
                <td><?php echo $role['table1Name']?></td>
                <td><?php echo $role['PackSize']?></td>
                <td><?php echo $role['table2Name']?></td>
                <td><?php echo $role['borderLine']?></td>
                <td><?php echo $role['TotQuantity']?></td>
                <td><?php echo $role['previousPrice']?></td>
                <td><?php echo $role['currentPrice']?></td>
                <td><?php echo $role['Remarks']?></td>
            </tr>
			<?php
		}
		?>
		</table>
        <script>
        jQuery( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd',
			changeMonth: true,
            changeYear: true });
        </script>
        </div>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='suppliers')
  {
	  ?>
      <div class="welcome">All Suppliers</div>
            <div class="content">
      <button onclick="PrintElem('.content')">Print Grid</button>
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Name';?></th>
                <th style="background:#999"><?php echo 'Address';?></th>
                <th style="background:#999"><?php echo 'Phone';?></th>
                <th style="background:#999"><?php echo 'Fax';?></th>
                <th style="background:#999"><?php echo 'Email';?></th>
                <th style="background:#999"><?php echo 'Amount Due';?></th>
                <th style="background:#999"><?php echo 'Date';?></th>
                <th style="background:#999"><?php echo 'IsActive';?></th>
                <th style="background:#999"><?php echo 'Supplier Contact Person';?></th>
                <th style="background:#999"><?php echo 'Supplier Contact Person Mobile';?></th>
                <th style="background:#999"><?php echo 'Supplier Deal With Company';?></th>
                <th style="background:#999"><?php echo 'Company Mobile';?></th>
        </tr>
	  <?php
	  $query=mysqli_query($con,"SELECT tblsuppliers.Name as supplierName, tblsuppliers.Address as Address, tblsuppliers.Phone as Phone,
								tblsuppliers.Fax as Fax, tblsuppliers.Email as Email,
								tblsuppliers.TotAmountDue as TotAmountDue,tblsuppliers.CreatedDate as CreatedDate,
								tblsuppliers.isActive as isActive,
								tblcontacts.Mobile as Mobile,tblcontacts.Name as contactName, tblcontacts.Type as Type,
								tblcontacts.ContactType as ContactType 
											 FROM tblsuppliers left OUTER JOIN tblcontacts
											 ON tblsuppliers.suplierId=tblcontacts.AssociationID");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['supplierName']?></td>
                <td><?php echo $role['Address']?></td>
                <td><?php echo $role['Phone']?></td>
                <td><?php echo $role['Fax']?></td>
                <td><?php echo $role['Email']?></td>
                <td><?php echo $role['TotAmountDue']?></td>
                <td><?php echo $role['CreatedDate']?></td>
                <td><?php echo $role['isActive']?></td>
                <td><?php if($role['Type']=='1' && $role['ContactType']=='3'){echo $role['contactName'];}?></td>
                <td><?php if($role['Type']=='1' && $role['ContactType']=='3'){echo $role['Mobile'];}?></td>
                <td><?php if($role['Type']=='1' && $role['ContactType']=='5'){echo $role['contactName'];}?></td>
                <td><?php if($role['Type']=='1' && $role['ContactType']=='5'){echo $role['Mobile'];}?></td>
            </tr>
			<?php
		}
		?>
		</table>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='companies')
  {
	  ?>
      <div class="welcome">All Companies</div>
      <div class="content">
      <button onclick="PrintElem('.content')">Print Grid</button>
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Company Name';?></th>
                <th style="background:#999"><?php echo 'Company Phone';?></th>
                <th style="background:#999"><?php echo 'Address';?></th>
                <th style="background:#999"><?php echo 'Fax';?></th>
                <th style="background:#999"><?php echo 'Email';?></th>
                <th style="background:#999"><?php echo 'Company Contact Person';?></th>
                <th style="background:#999"><?php echo 'Company Contact Person Mobile';?></th>
                <th style="background:#999"><?php echo 'Company Engineer';?></th>
                <th style="background:#999"><?php echo 'Company Engineer Mobile';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT tblcompany.Name AS companyName, tblcompany.Address AS Address, tblcompany.Phone AS Phone, 
				  tblcompany.Fax AS Fax, tblcompany.Email AS Email, tblcontacts.Mobile AS Mobile, tblcontacts.Name AS contactName,
				  tblcontacts.Type AS Type, tblcontacts.ContactType as ContactType 
				  FROM tblcompany
				  LEFT OUTER JOIN tblcontacts ON tblcompany.CompanyId = tblcontacts.AssociationID");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['companyName']?></td>
                <td><?php echo $role['Phone']?></td>
                <td><?php echo $role['Address']?></td>
                <td><?php echo $role['Fax']?></td>
                <td><?php echo $role['Email']?></td>
                
                <td><?php if($role['Type']=='2' && $role['ContactType']=='3'){echo $role['contactName'];}?></td>
                <td><?php if($role['Type']=='2' && $role['ContactType']=='3'){echo $role['Mobile'];}?></td>
                
                <td><?php if($role['Type']=='2' && $role['ContactType']=='4'){echo $role['contactName'];}?></td>
                <td><?php if($role['Type']=='2' && $role['ContactType']=='4'){echo $role['Mobile'];}?></td>
            </tr>
			<?php
		}
		?>
		</table>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='alldailyexpence')
  {
	  ?>
      <div class="welcome">All Daily Expences</div>
      <div class="content">
      <button onclick="PrintElem('.content')">Print Grid</button>
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'PaidMode';?></th>
                <th style="background:#999"><?php echo 'Expense type';?></th>
                <th style="background:#999"><?php echo 'Amount';?></th>
                <th style="background:#999"><?php echo 'Expense Date';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT tbldailyexpenses.Amount AS Amount, tbldailyexpenses.Expensedate AS Expensedate, 
				  tbldailyexpenses.Remarks AS Remarks, tbldailyexpenses.PaidMode AS PaidMode,
				  tblexpensetype.Type AS Type
				  FROM tbldailyexpenses
				  LEFT OUTER JOIN tblexpensetype ON tbldailyexpenses.ExpenseTypeID = tblexpensetype.ExpenseTypeID LIMIT 0 , 300");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['PaidMode']?></td>
                <td><?php echo $role['Type']?></td>
                <td><?php echo $role['Amount']?></td>
                <td><?php echo $role['Expensedate']?></td>
                <td><?php echo $role['Remarks']?></td>
            </tr>
			<?php
		}
		?>
		</table>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='tblpaneldetails')
  {
	  ?>
      <div class="welcome">All Panels</div>
      <div class="content">
      <div>
      <a class="nav-bar-links" href="#" data-reveal-id="paneldiv"><button>New</button></a>&nbsp;&nbsp;
      <select name="searchby" id="searchby">
        <option value="SpecimenName">Name</option>
      </select>
      
      <input type="text" name="searchcat" id="searchcat" /> 
      <input type="hidden" name="enddate" id="enddate" /> 
      <button onclick="searchcat('tblpaneldetails')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      <button onclick="ajaxfuction('tblpaneldetails')">Clear Search</button>
      </div>
      <div class="searchresults">
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Update';?></th>
                <th style="background:#999"><?php echo 'Report';?></th>
                <th style="background:#999"><?php echo 'Panel Code';?></th>
                <th style="background:#999"><?php echo 'Panel Name';?></th>
                <th style="background:#999"><?php echo 'Address';?></th>
                <th style="background:#999"><?php echo 'Phone';?></th>
                <th style="background:#999"><?php echo 'Mobile';?></th>
                <th style="background:#999"><?php echo 'Show Price';?></th>
                <th style="background:#999"><?php echo 'Email';?></th>
                <th style="background:#999"><?php echo 'isActive';?></th>
                <th style="background:#999"><?php echo 'Created Date';?></th>
                <th style="background:#999"><?php echo 'Contact_person';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
                <th style="background:#999"><?php echo 'PanelListOnly';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT * FROM `tblpaneldetails`");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><a href="#" data-reveal-id="updatepanel" onclick="updatepanel('<?php echo $role['PanelId']?>')">Update</a></td>
                <td><a href="#" onclick="viewPanelReport('<?php echo $role['PanelId']?>')">VeiwReport</a></td>
                <td><?php echo $role['PanelCode']?></td>
                <td><?php echo $role['Name']?></td>
                <td><?php echo $role['Address']?></td>
                <td><?php echo $role['Phone']?></td>
                <td><?php echo $role['Mobile']?></td>
                <td><input type="checkbox" <?php if($role['showPrice']=="1"){ ?> checked="checked"<?php }?>  /></td>
                <td><?php echo $role['Email']?></td>
                <td><input type="checkbox" <?php if($role['isActive']=="1"){ ?> checked="checked"<?php }?>  /></td>
                <td><?php echo $role['CreatedDate']?></td>
                <td><?php echo $role['Contact_person']?></td>
                <td><?php echo $role['Description']?></td>
                <td><input type="checkbox" <?php if($role['PanelListOnly']=="1"){ ?> checked="checked"<?php }?>  /></td>
            </tr>
			<?php
		}
		?>
		</table>
        </div>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='tblreferreddoctor')
  {
	  ?>
      <div class="welcome">All Reffered Doctors</div>
      <div class="content">
      <div>
      <a class="nav-bar-links" href="#" data-reveal-id="refferedby"><button>New</button></a>&nbsp;&nbsp;
      <select name="searchby" id="searchby">
        <option value="SpecimenName">Name</option>
      </select>
      
      <input type="text" name="searchcat" id="searchcat" /> 
      <input type="hidden" name="enddate" id="enddate" /> 
      <button onclick="searchcat('tblreferredby')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      <button onclick="ajaxfuction('tblreferredby')">Clear Search</button>
      </div>
      <div class="searchresults">
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Location';?></th>
                <th style="background:#999"><?php echo 'Name';?></th>
                <th style="background:#999"><?php echo 'Clinic Name';?></th>
                <th style="background:#999"><?php echo 'Mobile';?></th>
                <th style="background:#999"><?php echo 'Clinic Address';?></th>
                <th style="background:#999"><?php echo 'Clinic Phone';?></th>
                <th style="background:#999"><?php echo 'Discount';?></th>
                <th style="background:#999"><?php echo 'Payable Amount';?></th>
                <th style="background:#999"><?php echo 'Paid Amount';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
                <th style="background:#999"><?php echo 'update';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT tblreferreddoctor.Name, tblreferreddoctor.clinicName, tblreferreddoctor.Mobile, tblreferreddoctor.refId,
	  					  tblreferreddoctor.cAddress, tblreferreddoctor.cPhone,
						  tblreferreddoctor.Discount, tblreferreddoctor.Remarks,
						  tblreferreddoctor.commission, tblpoints.location
                          FROM tblreferreddoctor INNER JOIN tblpoints
                          ON tblreferreddoctor.PointId=tblpoints.PointId");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['location']?></td>
                <td><?php echo $role['Name']?></td>
                <td><?php echo $role['clinicName']?></td>
                <td><?php echo $role['Mobile']?></td>
                <td><?php echo $role['cAddress']?></td>
                <td><?php echo $role['cPhone']?></td>
                <td><?php echo $role['Discount']?></td>
                <td><?php echo "";?></td>
                <td><?php echo "";?></td>
                <td><?php echo $role['Remarks']?></td>
                <td><a href="#" data-reveal-id="updateeverytable" onclick="updateeverytable('tblreferreddoctor','<?php echo $role['refId']?>')">Update</a></td>
            </tr>
			<?php
		}
		?>
		</table>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='tblmachinedetails')
  {
	  ?>
      <div class="welcome">Machines</div>
      <div class="content">
      <div>
      <a class="nav-bar-links" href="#" data-reveal-id="new_ab_category"><button>New</button></a>&nbsp;&nbsp;
      <select name="searchby" id="searchby">
        <option value="SpecimenName">Name</option>
      </select>
      
      <input type="text" name="searchcat" id="searchcat" /> 
      <input type="hidden" name="enddate" id="enddate" /> 
      <button onclick="searchcat('tblmachinedetails')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      <button onclick="ajaxfuction('tblmachinedetails')">Clear Search</button>
      </div>
      <div class="searchresults">
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Point Location';?></th>
                <th style="background:#999"><?php echo 'Machine Name';?></th>
                <th style="background:#999"><?php echo 'Method';?></th>
                <th style="background:#999"><?php echo 'Company';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
                <th style="background:#999"><?php echo 'Update';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT tblmachinedetails.machineName, tblmachinedetails.Method, tblmachinedetails.Company, 
	  					  tblmachinedetails.Remarks, tblmachinedetails.machineId,
						  tblpoints.location
                          FROM tblmachinedetails INNER JOIN tblpoints
                          ON tblmachinedetails.PointId=tblpoints.PointId");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['location']?></td>
                <td><?php echo $role['machineName']?></td>
                <td><?php echo $role['Method']?></td>
                <td><?php echo $role['Company']?></td>
                <td><?php echo $role['Remarks']?></td>
                <td><a href="#" data-reveal-id="updateeverytable" onclick="updateeverytable('tblmachinedetails','<?php echo $role['machineId']?>')">Update</a></td>
            </tr>
			<?php
		}
		?>
		</table>
      </div>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='tbltestnotes')
  {
	  ?>
      <div class="welcome">All Test Notes</div>
      <div class="content">
      <div>
      <a class="nav-bar-links" href="#" data-reveal-id="newtestnote"><button>New</button></a>&nbsp;&nbsp;
      <select name="searchby" id="searchby">
        <option value="SpecimenName">Name</option>
      </select>
      
      <input type="text" name="searchcat" id="searchcat" /> 
      <input type="hidden" name="enddate" id="enddate" /> 
      <button onclick="searchcat('tbltestnotes')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      <button onclick="ajaxfuction('tbltestnotes')">Clear Search</button>
      </div>
      <div class="searchresults">
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Note Name';?></th>
                <th style="background:#999"><?php echo 'Note Heading';?></th>
                <th style="background:#999"><?php echo 'Note';?></th>
                <th style="background:#999"><?php echo 'Update';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT * from tbltestnotes");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['NoteName']?></td>
                <td><?php echo $role['NoteHeading']?></td>
                <td><?php echo $role['Note']?></td>
                <td><a href="#" data-reveal-id="updatetestnote" onclick="updatetestnote('<?php echo $role['NoteId']?>')">Update</a></td>
            </tr>
			<?php
		}
		?>
		</table>
        </div>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='tblAntibiotics')
  {
	  ?>
      <div class="welcome">All Antibiotecs</div>
      <div class="content">
      <div>
      <a class="nav-bar-links" href="#" data-reveal-id="newantibiotec"><button>New</button></a>&nbsp;&nbsp;
      <select name="searchby" id="searchby">
        <option value="SpecimenName">Name</option>
      </select>
      
      <input type="text" name="searchcat" id="searchcat" /> 
      <input type="hidden" name="enddate" id="enddate" /> 
      <button onclick="searchcat('tblantibiotics')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      <button onclick="ajaxfuction('tblAntibiotics')">Clear Search</button>
      </div>
      <div class="searchresults">
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Code';?></th>
                <th style="background:#999"><?php echo 'Name';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
                <th style="background:#999"><?php echo 'Update';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT * from tblantibiotics");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['Code']?></td>
                <td><?php echo $role['Name']?></td>
                <td><?php echo $role['Remarks']?></td>
                <td><a href="#" data-reveal-id="updateantibiotec" onclick="updateantibiotec('<?php echo $role['AntId']?>')">Update</a></td>
            </tr>
			<?php
		}
		?>
		</table>
        </div>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='tblorganisms')
  {
	  ?>
      <div class="welcome">All Organisms</div>
      <div class="content">
      <div>
      <a class="nav-bar-links" href="#" data-reveal-id="neworganism"><button>New</button></a>&nbsp;&nbsp;
      <select name="searchby" id="searchby">
        <option value="SpecimenName">Name</option>
      </select>
      
      <input type="text" name="searchcat" id="searchcat" /> 
      <input type="hidden" name="enddate" id="enddate" /> 
      <button onclick="searchcat('tblorganisms')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      <button onclick="ajaxfuction('tblorganisms')">Clear Search</button>
      </div>
      <div class="searchresults">
      <table border="1">
	  	<tr>
            	
                <th style="background:#999"><?php echo 'Name';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT * from tblorganisms");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	
                <td><?php echo $role['Name']?></td>
                <td><?php echo $role['Remarks']?></td>
            </tr>
			<?php
		}
		?>
		</table>
        </div>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='tblspecimens')
  {
	  ?>
      <div class="welcome">All Specimans</div>
      <div class="content">
       <div>
       <a class="nav-bar-links" href="#" data-reveal-id="newspecimen"><button>New</button></a>&nbsp;&nbsp;
      <select name="searchby" id="searchby">
        <option value="SpecimenName">Name</option>
        <option value="SpecimenCode">Code</option>
      </select>
      
      <input type="text" name="searchcat" id="searchcat" /> 
      <input type="hidden" name="enddate" id="enddate" /> 
      <button onclick="searchcat('tblspecimens')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      </div>
      <div class="searchresults">
      <table border="1">
	  	<tr>
            	
                <th style="background:#999"><?php echo 'Speciman Code';?></th>
                <th style="background:#999"><?php echo 'SpecimanName';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
                <th style="background:#999"><?php echo 'Update';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT * from tblspecimens");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['SpecimenCode']?></td>
                <td><?php echo $role['SpecimenName']?></td>
                <td><?php echo $role['Remarks']?></td>
                <td><a href="#" data-reveal-id="updatespeciman" onclick="updatespeciman('<?php echo $role['SpecimenId']?>')">Update</a></td>
            </tr>
			<?php
		}
		?>
		</table>
      </div>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='tbltestdepartments')
  {
	  ?>
      <div class="welcome">TestDapartments</div>
      <div class="content">
       <div>
       <a class="nav-bar-links" href="#" data-reveal-id="testdepartment"><button>New</button></a>&nbsp;&nbsp;
      <select name="searchby" id="searchby">
        <option value="Name">Name</option>
        <option value="Code">Code</option>
      </select>
      
      <input type="text" name="searchcat" id="searchcat" /> 
      <input type="hidden" name="enddate" id="enddate" /> 
      <button onclick="searchcat('tbltestdepartments')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      <button onclick="ajaxfuction('tbltestdepartments')">Clear Search</button>
      </div>
      <div class="searchresults">
      <table border="1">
	  	<tr>       	
                <th style="background:#999"><?php echo 'Department Name';?></th>
                <th style="background:#999"><?php echo 'Code';?></th>
                <th style="background:#999"><?php echo 'Description';?></th>
                <th style="background:#999"><?php echo 'isActive';?></th>
                <th style="background:#999"><?php echo 'Same No. in one reciept';?></th>
                <th style="background:#999"><?php echo 'Udate';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT * from tbltestdepartments");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['Name']?></td>
                <td><?php echo $role['Code']?></td>
                <td><?php echo $role['Description']?></td>
                <td><input type="checkbox" <?php if($role['isActive']=="1"){ ?> checked="checked"<?php }?>  /></td>
                <td><input type="checkbox" <?php if($role['isstaticdeptcode']=="1"){ ?> checked="checked"<?php }?>  /></td>
                <td><a href="#" data-reveal-id="updateDepartment" onclick="updateDepartment('<?php echo $role['tstDepartId']?>')">Update</a></td>
            </tr>
			<?php
		}
		?>
		</table>
      </div>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='tblemployee')
  {
	  ?>
      <div class="welcome">All Employees</div>
     <div class="content">
            <div>
            <a class="nav-bar-links" href="#" data-reveal-id="newemployee"><button>New</button></a>&nbsp;&nbsp;
            <input type="text" name="searchcat2" id="searchcat" />
            
            <button onclick="searchcat2_employee('tblemployee')">Search</button>
            <button onclick="PrintElem('.content')">Print Grid</button>
            <button onclick="ajaxfuction('tblemployee')">Clear Search</button>
            </div>
            <div class="searchresults">
            <table border="1">
           	 <tr>       	
                    <th style="background:#999">
                        Open
                    </th>
                    <th style="background:#999"><?php echo 'Location';?></th>
                    <th style="background:#999"><?php echo 'Name';?></th>
                    <th style="background:#999"><?php echo 'Department';?></th>
                    <th style="background:#999"><?php echo 'Phone';?></th>
                    <th style="background:#999"><?php echo 'Mobile';?></th>
                    <th style="background:#999"><?php echo 'Last Login Date';?></th>
                    <th style="background:#999"><?php echo 'Qualification';?></th>
                    <th style="background:#999"><?php echo 'Joining Date';?></th>
                    <th style="background:#999"><?php echo 'Experience';?></th>
                    <th style="background:#999"><?php echo 'EmergencyConatct';?></th>
                    
                    <th style="background:#999"><?php echo 'Leaving Date';?></th>
                    <th style="background:#999"><?php echo 'Rejoining Date';?></th>
                    <th style="background:#999"><?php echo 'Rejoined';?></th>
            </tr>
          <?php
                  $query=mysqli_query($con,"SELECT tblemployee.name, tblemployee.EmployeeId, tblemployee.telephone, tblemployee.mobile, tblemployee.PointId,
                                                  tblemployee.lastLoginDate, tblemployee.Qualification, tblemployee.JoiningDate, tblemployee.LeavingDate,
                                                  tblemployee.Experience, tblemployee.EmergencyContact,  tblemployee.IsRejoining,
                                                  tblemployee.LeavingDate, tblemployee.RejoiningDate, tbltestdepartments.Name
                                                   FROM tblemployee INNER JOIN tbltestdepartments
                                                   ON tblemployee.EmpDepartId=tbltestdepartments.tstDepartId");
        
          while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
            {
                ?>
                <tr>
                    <td>
                        <a href="#" data-reveal-id="employee_fill" onclick="employeeajax('<?php echo $role['EmployeeId']?>')">
                                Open
                        </a>
                    </td>
                    <td><?php /*echo $role['PointId'];*/
					$rtt="select * from tblpoints where PointId='".$role['PointId']."'";
					$query2=mysqli_query($con,$rtt);
        			$role2=mysqli_fetch_array($query2,MYSQLI_ASSOC);
					 echo $role2['location'];?></td>
                    <td><?php echo $role['name']?></td>
                    <td><?php echo $role['Name']?></td>
                    <td><?php echo $role['telephone']?></td>
                    <td><?php echo $role['mobile']?></td>
                    <td><?php echo $role['lastLoginDate']?></td>
                    <td><?php echo $role['Qualification']?></td>
                    <td><?php echo $role['JoiningDate']?></td>
                    <td><?php echo $role['Experience']?></td>
                    <td><?php echo $role['EmergencyContact']?></td>
                    <td><?php echo $role['LeavingDate']?></td>
                    <td><?php echo $role['RejoiningDate']?></td>
                    <td><input type="checkbox" <?php if($role['IsRejoining']=="1"){ ?> checked="checked"<?php }?>  /></td>
                </tr>
                <?php
            }
            ?>
            </table>
            </div>
      </div>
	<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='tblcategories')
  {
	  ?>
      <div class="welcome">All Categories</div>
      <div class="content">
      <div>
      <a class="nav-bar-links" href="#" data-reveal-id="newcategory2"><button>New</button></a>&nbsp;&nbsp;
      <select name="searchby" id="searchby">
        <option value="Category">Category</option>
        <option value="TypeID">Type</option>
      </select>
      
      <input type="text" name="searchcat" id="searchcat" /> 
      <input type="hidden" name="enddate" id="enddate" /> 
      <button onclick="searchcat('tblcategories')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      <button onclick="ajaxfuction('tblcategories')" >Clear Search</button>
      </div>
      <div class="searchresults">
      <table border="1">
	  	<tr>       	
                <th style="background:#999"><?php echo 'Category';?></th>
                <th style="background:#999"><?php echo 'ParentCategory';?></th>
                <th style="background:#999"><?php echo 'Type';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT * from tblcategories");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['Category'];?></td>
                <?php $new=mysqli_query($con,"select * from tblcategories where CategoryID ='".$role['ParentCategoryID']."'");
					  $newfetch=mysqli_fetch_array($new,MYSQLI_ASSOC);
				?>
                <td><?php echo $newfetch['Category']?></td>
                <?php $new2=mysqli_query($con,"select * from tbltypes where TypeID ='".$role['TypeID']."'");
					  $newfetch2=mysqli_fetch_array($new2,MYSQLI_ASSOC);
				?>
                <td><?php echo $newfetch2['Type']?></td>
            </tr>
			<?php
		}
		?>
		</table>
        </div>
        </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='salesreport')
  {
	  ?>
      <div class="welcome"><?php echo $_SESSION['user']['username'];?> Sales Report</div>
     <div class="content">
     <button onclick="PrintElem('.content')">Print Grid</button>
     <h1 style="text-align:center;"><?php echo $_SESSION['user']['username'];?> Sales Report</h1>
     <P><?php echo date("D, d-M-Y")?></P>
      <table border="1">
	  	<tr>       	
                <th style="background:#999" width="200">Reciept No</th>
                <th style="background:#999" width="200">Total Bill</th>
                <th style="background:#999" width="200">Discount</th>
                <th style="background:#999" width="200">Net Bill</th>
                <th style="background:#999" width="200">Recieved</th>
                <th style="background:#999" width="200">Balance</th>
        </tr>
	  <?php
			  $qu="SELECT * from tblpatientreciept WHERE EmployeeId='".$_SESSION['user']['uid']."' AND testDate like '".date("Y-m-d")."%'";
			  //echo $qu;
			  $query=mysqli_query($con,$qu);
			  $grand_totalBill=0;
			  $grand_Discount=0;
			  $grand_netBill=0;
			  $grand_Received=0;
			  $grand_Balance=0;
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['ReceiptId'];?></td>
                <td><?php echo $role['totalBill']?></td>
                <td><?php echo $role['Discount']?></td>
                <td><?php echo $role['netBill'];?></td>
                <td><?php echo $role['Received']?></td>
                <td><?php echo $role['Balance']?></td>
            </tr>
			<?php
			$grand_totalBill=$grand_totalBill+$role['totalBill'];
			  $grand_Discount=$grand_Discount+$role['Discount'];
			  $grand_netBill=$grand_netBill+$role['netBill'];
			  $grand_Received=$grand_Received+$role['Received'];
			  $grand_Balance=$grand_Balance+$role['Balance'];
		}
		?>
        <tr>
            	<td>&nbsp;</td>
                <td><b><?php echo $grand_totalBill;?></b></td>
                <td><b><?php echo $grand_Discount;?></b></td>
                <td><b><?php echo $grand_netBill;?></b></td>
                <td><b><?php echo $grand_Received;?></b></td>
                <td><b><?php echo $grand_Balance;?></b></td>
            </tr>
            <tr>
            	<td colspan="4"><b>Total (Amount Recieved)</b></td>
                <td colspan="2"><b><?php echo $grand_Received;?></b></td>
            </tr>
            <tr style="text-align:right;">
            	<td colspan="6"><b>Grand Total (Amount Recieved) &nbsp;&nbsp;&nbsp;&nbsp;</b><?php echo $grand_Received;?></td>
            </tr>
		</table>
        
      </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='incomeReport')
  {
	  ?>
      <div class="welcome"><?php echo $_SESSION['user']['username'];?> Daily Income Report</div>
     <div class="content">
     <button onclick="PrintElem('.content')">Print Grid</button>
     <h1 style="text-align:center;"><?php echo $_SESSION['user']['username'];?> Daily Income Report</h1>
     <P><?php echo date("D, d-M-Y")?></P>
      <table border="1">
	  	<tr>       	
                <th style="background:#999" width="350">Income From</th>
                <th style="background:#999" width="200">Point Name</th>
                <th style="background:#999" width="200">Reciveied</th>
                <th style="background:#999" width="200">Remarks</th>
        </tr>
	  <?php
			  $qu="SELECT tblshiftincome.TotalAmount, tblshiftincome.Remarks,
			  tblpoints.location, tblincometypes.IncomeType
			   from tblshiftincome
			   INNER JOIN
			   tblpoints ON  tblshiftincome.PointId=tblpoints.PointId
			   INNER JOIN
			   tblincometypes ON  tblshiftincome.IncomeId=tblincometypes.IncomeId
			   
			   WHERE FromUser='".$_SESSION['user']['uid']."' AND Shiftdate like '".date("Y-m-d")."%'";
			  //echo $qu;
			  $query=mysqli_query($con,$qu);
			  $grand_totalBill=0;
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['IncomeType'];?></td>
                <td><?php echo $role['location']?></td>
                <td><?php echo $role['TotalAmount']?></td>
                <td><?php echo $role['Remarks'];?></td>
            </tr>
			<?php
			$grand_totalBill=$grand_totalBill+$role['TotalAmount'];
		}
		?>
        <tr>
            	<td colspan="2"><b>Total Amount</b></td>
                <td colspan="2"><b><?php echo $grand_totalBill;?></b></td>
            </tr>
            
            <tr style="text-align:right;">
            	<td colspan="4"><b>Grand Total Amount  &nbsp;&nbsp;&nbsp;&nbsp;</b><?php echo $grand_totalBill;?></td>
            </tr>
		</table>
        
      </div>
		<?php
  }
if(isset($_POST['var_name']) && $_POST['var_name']=='tblpoints')
  {
	  ?>
      <div class="welcome">LABs (Pick up Point List)</div>
      <div class="content">
     <div>
      <a class="nav-bar-links" href="#" data-reveal-id="refferedby"><button>New</button></a>&nbsp;&nbsp;
      <select name="searchby" id="searchby">
        <option value="Location">Location</option>
      </select>
      
      <input type="text" name="searchcat" id="searchcat" /> 
      <input type="hidden" name="enddate" id="enddate" /> 
      <button onclick="searchcat('tblpoints')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      <button onclick="ajaxfuction('tblpoints')">Clear Search</button>
      </div>
      <div class="searchresults">
      <table border="1">
	  	<tr>       	
                <th style="background:#999"><?php echo 'Update';?></th>
                <th style="background:#999"><?php echo 'PointId';?></th>
                <th style="background:#999"><?php echo 'Location';?></th>
                <th style="background:#999"><?php echo 'ICode';?></th>
                <th style="background:#999"><?php echo 'Current Point Number';?></th>
                <th style="background:#999" width="500"><?php echo 'Address';?></th>
                <th style="background:#999"><?php echo 'PhoneNo.';?></th>
                <th style="background:#999"><?php echo 'Fax';?></th>
                <th style="background:#999"><?php echo 'Email';?></th>
                <th style="background:#999"><?php echo 'isActive.';?></th>
                <th style="background:#999"><?php echo 'CreateDate';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT * from tblpoints");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><a href="#" data-reveal-id="updatepoint" onclick="updatepoint('<?php echo $role['PointId']?>')">Update</a></td>
                <td><?php echo $role['PointId'];?></td>
                <td><?php echo $role['location'];?></td>
                <td><?php echo $role['lCode'];?></td>
                <td><?php echo $role['current_point_no'];?></td>
                <td style="width:600px;"><?php echo $role['Address'];?></td>
                <td><?php echo $role['PhoneNo'];?></td>
                <td><?php echo $role['Fax'];?></td>
                <td><?php echo $role['Email'];?></td>
                <td><input type="checkbox" <?php if($role['isActive']=="1"){ ?> checked="checked"<?php }?>  /></td>
                <td><?php echo $role['Createddate'];?></td>
                <td><?php echo $role['Remarks'];?></td>
            </tr>
			<?php
		}
		?>
		</table>
        </div>
        </div>
		<?php
  }
  
  
if(isset($_POST['updateeverytable']) && $_POST['tablename']=='tblmachinedetails')
  {
	  $neque="select * from tblmachinedetails where machineId ='".$_POST['recordid']."'";
	  $my2query=mysqli_query($con,$neque);
      $myMachine = mysqli_fetch_array($my2query,MYSQLI_ASSOC);
	  ?>
	  <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1><?php echo $myMachine['machineName'];?></h1>
        <table>
        	<tr>
            	<td>Point</td>
                <td>
                <select name="point">
                	<?php $query=mysqli_query($con,"select * from tblpoints");
						  while($fetchqn=mysqli_fetch_array($query,MYSQLI_ASSOC))
						  	{
					?>
                    			<option value="<?php echo $fetchqn['PointId'];?>" <?php if($myMachine['PointId']==$fetchqn['PointId']){?> selected="selected" <?php }?>>
								<?php echo $fetchqn['location'];?></option>
                      <?php }?>
                </select>
                </td>
            </tr>
            <tr>
            	<td>Name</td><td><input type="text" name="name" value="<?php echo $myMachine['machineName'];?>" /></td>
            </tr>
            <tr>
            	<td>Method</td><td><input type="text" name="method"  value="<?php echo $myMachine['Method'];?>"/></td>
            </tr>
            <tr>
            	<td>Company</td><td><input type="text" name="company"  value="<?php echo $myMachine['Company'];?>"/></td>
            </tr>
            <tr>
            	<td rowspan="2">Remarks</td><td rowspan="2"><textarea name="remarks"> <?php echo $myMachine['Remarks'];?></textarea></td>
            </tr>
        </table>
        <input type="hidden" name="machinehiddenid"  value="<?php echo $myMachine['machineId'];?>" />
        <div><input type="submit" value="Save" name="editmachine"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
	  <?php
  }
if(isset($_POST['updateeverytable']) && $_POST['tablename']=='tblreferreddoctor')
  {
	  $neque="select * from tblreferreddoctor where refId ='".$_POST['recordid']."'";
	  $my2query=mysqli_query($con,$neque);
      $myRefDoctor = mysqli_fetch_array($my2query,MYSQLI_ASSOC);
	  ?>
	  <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1><?php echo $myRefDoctor['Name']?></h1>
        <table>
        	<tr>
            	<td>Point</td>
                <td>
                <select name="point">
                	<?php $query=mysqli_query($con,"select * from tblpoints");
						  while($fetchqn=mysqli_fetch_array($query,MYSQLI_ASSOC))
						  	{
					?>
                    			<option value="<?php echo $fetchqn['PointId'];?>" <?php if($myRefDoctor['PointId']==$fetchqn['PointId']){?> selected="selected" <?php }?>>
								<?php echo $fetchqn['location'];?></option>
                      <?php }?>
                </select>
                </td>
                <td>refferdby</td>
                <td>
                <select name="refType">
                	<?php $query=mysqli_query($con,"select * from tblreferredby");
						  while($fetchqn=mysqli_fetch_array($query,MYSQLI_ASSOC))
						  	{
					?>
                    			<option value="<?php echo $fetchqn['refType'];?>" <?php if($myRefDoctor['refType']==$fetchqn['refType']){?> selected="selected" <?php }?>>
								<?php echo $fetchqn['RefferdBy'];?></option>
                      <?php }?>
                </select>
                </td>
            </tr>
            <tr>
            	<td>Name</td><td><input type="text" name="name" value="<?php echo $myRefDoctor['Name']?>" /></td>
                <td>Clinic Name</td><td><input type="text" name="clinicname" value="<?php echo $myRefDoctor['clinicName']?>"/></td>
            </tr>
            <tr>
            	<td>Home Address</td><td><input type="text" name="homeaddress" value="<?php echo $myRefDoctor['hAddress']?>"/></td>
                <td>Home Phone</td><td><input type="text" name="homephone" value="<?php echo $myRefDoctor['hPhone']?>"/></td>
            </tr>
            <tr>
            	<td>Mobile</td><td><input type="text" name="mobile" value="<?php echo $myRefDoctor['Mobile']?>"/></td>
                <td>Fax</td><td><input type="text" name="fax" value="<?php echo $myRefDoctor['Fax']?>"/></td>
            </tr>
            <tr>
            	<td>Email</td><td><input type="text" name="email" value="<?php echo $myRefDoctor['Email']?>"/></td>
                <td>Clinic Address</td><td><input type="text" name="clinicaddress" value="<?php echo $myRefDoctor['cAddress']?>"/></td>
            </tr>
            <tr>
            	<td>Clinic Phone</td><td><input type="text" name="clinicphone" value="<?php echo $myRefDoctor['cPhone']?>"/></td>
                <td>Discount</td><td><input type="text" name="discount" value="<?php echo $myRefDoctor['Discount']?>"/></td>
            </tr>
            <tr>
            	<td>Commision</td><td><input type="text" name="commision"  value="<?php echo $myRefDoctor['commission']?>"/></td>
                <td>Date</td><td><input type="text" name="date" class="datepicker" value="<?php echo $myRefDoctor['Createddate']?>"/></td>
            </tr>
            <tr>
            	<td>Is Active</td><td><input type="checkbox" name="isactive" value="<?php echo $myRefDoctor['isActive']?>" <?php if($myRefDoctor['isActive']!=0){?> checked="checked" <?php }?>/></td>
                
            </tr>
            <tr>
            	<td>Remarks</td><td colspan="3" rowspan="2"><textarea name="remarks"><?php echo $myRefDoctor['Remarks']?></textarea></td>
            </tr>
        </table>
        <input type="hidden" name="refdoctorhiddenid" value="<?php echo $myRefDoctor['refId']?>" />
        <div><input type="submit" value="Save" name="updaterefferedbyrecord"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
	  <?php
  }
if(isset($_POST['updateeverytable']) && $_POST['tablename']=='tblspecimenbottles')
  {
	  $neque="select * from tblspecimenbottles where ContainerId ='".$_POST['recordid']."'";
	  $my2query=mysqli_query($con,$neque);
      $myBottle = mysqli_fetch_array($my2query,MYSQLI_ASSOC);
	  ?>
	  <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1><?php echo $myBottle['ContainerName'];?></h1>
        <table>
        	<tr>
            	<td>Name</td><td colspan="3"><input type="text" name="name" value="<?php echo $myBottle['ContainerName'];?>" style="width:340px;" /></td>
            </tr>
            
            <tr>
            	<td rowspan="2">Remarks</td><td rowspan="2" colspan="3"><textarea name="remarks" style="width:100%;height:100px;"><?php echo $myBottle['Remarks'];?></textarea></td>
            </tr>
        </table>
        <input type="hidden" name="containeridhidden" value="<?php echo $myBottle['ContainerId'];?>" />
        <div><input type="submit" value="Save" name="updatenewbottle"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
	  <?php
  }
if(isset($_POST['updateeverytable']) && $_POST['tablename']=='tblroles')
  {
	  $neque="select * from tblroles where RoleId ='".$_POST['recordid']."'";
	  $my2query=mysqli_query($con,$neque);
      $myRole = mysqli_fetch_array($my2query,MYSQLI_ASSOC);
	  ?>
	  <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1><?php echo $myRole['Name'];?></h1>
        <table>
        	<tr>
            	<td>Roles</td><td colspan="3"><input type="text" name="rol_es" style="width:340px;" value="<?php echo $myRole['Name'];?>" /></td>
            </tr>
            
            <tr>
            	<td rowspan="2">Remarks</td>
                <td rowspan="2" colspan="3"><textarea name="role_remarks" style="width:100%; height:100px;"><?php echo $myRole['Remarks'];?></textarea></td>
            </tr>
        </table>
        <div style="height:250px; overflow:auto; background:#fff;">
          <table border="1">
              <tr>
                  <th>Right Name</th><th>Status</th><th>Date Assigned</th><th>Remarks</th>
              </tr>
              <?php $query=mysqli_query($con,"select * from tblrights");
                    while($fetchqn=mysqli_fetch_array($query,MYSQLI_ASSOC))
                      {
              ?>
                         <tr>
                            <td><?php echo $fetchqn['RightName'];?></td>
                            <?php 
								  $query2=mysqli_query($con,"select * from tblrolesrights where RoleId='".$myRole['RoleId']."' AND RightId='".$fetchqn['RightId']."'");
								  $rows=mysql_num_rows($query2)
							  ?>
                            <td><input type="checkbox" name="right_status[]" <?php if($rows>0){?> checked="checked" <?php }?> value="<?php echo $fetchqn['RightId'];?>" /></td>
                            <td><input type="text" name="dateassgigd_<?php echo $fetchqn['RightId'];?>" class="datepicker" /></td>
                            <td><input type="text" name="rightremarks_<?php echo $fetchqn['RightId'];?>" /></td>
                        </tr>
                <?php }?>
          </table>
        </div>
        <input type="hidden" name="roleidhidden" value="<?php echo $myRole['RoleId']?>" />
        <div><input type="submit" value="Save" name="updatenewrole"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
	  <?php
  }
if(isset($_POST['updateeverytable']) && $_POST['tablename']=='DepSequnceNo')
  {
	  $neque="select * from tbltestdepartments where tstDepartId ='".$_POST['recordid']."'";
	  $my2query=mysqli_query($con,$neque);
      $mySeqNo = mysqli_fetch_array($my2query,MYSQLI_ASSOC);
	  ?>
	  <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1><?php echo $mySeqNo['Name'];?></h1>
        <table>
        	<tr>
            	<td>Code</td><td colspan="3"><input type="text" name="Name" value="<?php echo $mySeqNo['Name'];?>" style="width:340px;" disabled="disabled" /></td>
            </tr>
            <tr>
            	<td>Name</td><td colspan="3"><input type="text" name="Code" value="<?php echo $mySeqNo['Code'];?>" style="width:340px;" disabled="disabled" /></td>
            </tr>
            
            <tr>
            	<td>CatSeqNo</td><td colspan="3"><input type="text" name="CatSeqNo" value="<?php echo $mySeqNo['CatSeqNo'];?>" style="width:340px;" /></td>
            </tr>
        </table>
        <input type="hidden" name="CatSeqNohiddenId" value="<?php echo $mySeqNo['tstDepartId'];?>" />
        <div><input type="submit" value="Save" name="updatemySeqNo"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
	  <?php
  }
if(isset($_POST['updateeverytable']) && $_POST['tablename']=='add_book_cat')
  {
	  $neque="select * from tblabcategory where CategoryId ='".$_POST['recordid']."'";
	  $my2query=mysqli_query($con,$neque);
      $myAbCategory = mysqli_fetch_array($my2query,MYSQLI_ASSOC);
	  ?>
	  <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1><?php echo $myAbCategory['CName'];?></h1>
        <table>
        	<tr>
            	<td>Category</td><td colspan="3"><input type="text" name="category" style="width:340px;" value="<?php echo $myAbCategory['CName'];?>" /></td>
            </tr>
            
            <tr>
            	<td rowspan="2">Remarks</td><td rowspan="2" colspan="3"><textarea name="remarks" style="width:100%; height:100px;"><?php echo $myAbCategory['Description'];?></textarea></td>
            </tr>
        </table>
        <input type="hidden" name="abcathidden" value="<?php echo $myAbCategory['CategoryId'];?>" />
        <div><input type="submit" value="Save" name="update_ab_catergoy"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
	  <?php
  }
if(isset($_POST['updateeverytable']) && $_POST['tablename']=='tbladdressbook')
  {
	  $neque="select * from tbladdressbook where ContactId ='".$_POST['recordid']."'";
	  $my2query=mysqli_query($con,$neque);
      $myAddressbook = mysqli_fetch_array($my2query,MYSQLI_ASSOC);
	  ?>
	  <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1><?php echo $myAddressbook['Name'];?></h1>
        <table>
        	<tr>
            	<td>Name</td>
                <td>
                <input type="text" name="Name" value="<?php echo $myAddressbook['Name'];?>" />
                </td>
                <td>&nbsp;</td>
                <td>
                <select name="CategoryId">
                	<?php $query=mysqli_query($con,"select * from tblabcategory");
						  while($fetchqn=mysqli_fetch_array($query,MYSQLI_ASSOC))
						  	{
					?>
                    		<option value="<?php echo $fetchqn['CategoryId'];?>" <?php if($fetchqn['CategoryId']==$myAddressbook['CategoryId']){ ?> selected="selected" <?php }?>>
								<?php echo $fetchqn['CName'];?>
                            </option>
                      <?php }?>
                </select>
                </td>
            </tr>
            <tr><td colspan="4"><h3>Work Details</h3></td></tr>
            <tr>
            	<td>Job Title</td><td colspan="3"><input type="text" name="JobTitle" style="width:100%;"  value="<?php echo $myAddressbook['JobTitle'];?>" /></td>
            </tr>
            <tr>
            	<td>Department</td><td colspan="3"><input type="text" name="Department" style="width:100%;" value="<?php echo $myAddressbook['Department'];?>"  /></td>
            </tr>
            <tr>
            	<td>Company</td><td colspan="3"><input type="text" name="Company" style="width:100%;"  value="<?php echo $myAddressbook['Company'];?>" /></td>
            </tr>
            <tr>
            	<td>Address</td><td colspan="3"><input type="text" name="CAddress" style="width:100%;" value="<?php echo $myAddressbook['CAddress'];?>"  /></td>
            </tr>
            <tr>
            	<td>Telephone</td><td><input type="text" name="CTelNo"  value="<?php echo $myAddressbook['CTelNo'];?>" /></td>
                <td>Fax</td><td><input type="text" name="CFax"  value="<?php echo $myAddressbook['CFax'];?>" /></td>
            </tr>
            <tr>
            	<td rowspan="3">Business Deatils</td><td colspan="3" rowspan="3">
                	<textarea name="BusinessDetails" style="width:100%;" > <?php echo $myAddressbook['BusinessDetails'];?> </textarea>
                </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td colspan="4"><h3>Personal Details</h3></td></tr>
            <tr>
            	<td>Address</td><td colspan="3"><input type="text" name="HAddress" style="width:100%;" value="<?php echo $myAddressbook['HAddress'];?>"  /></td>
            </tr>
            <tr>
            	<td>Mailing Address</td><td colspan="3"><input type="text" name="MailingAddress" style="width:100%;"  value="<?php echo $myAddressbook['MailingAddress'];?>" /></td>
            </tr>
            <tr>
            	<td>Telephone</td><td><input type="text" name="HTelNo"  value="<?php echo $myAddressbook['HTelNo'];?>" /></td>
                <td>Mobile</td><td><input type="text" name="Mobile"  value="<?php echo $myAddressbook['Mobile'];?>" /></td>
            </tr>
            <tr>
            	<td>Email</td><td><input type="text" name="Email"  value="<?php echo $myAddressbook['Email'];?>" /></td>
                <td>Website</td><td><input type="text" name="WebSite"  value="<?php echo $myAddressbook['WebSite'];?>" /></td>
            </tr>
             <tr>
            	<td rowspan="3">Remarks</td><td colspan="3" rowspan="3"><textarea name="Remarks" style="width:100%;" > <?php echo $myAddressbook['Remarks'];?> </textarea></td>
            </tr>
        </table>
        <input type="hidden"  value="<?php echo $myAddressbook['ContactId'];?>" name="hiddenaddresbookid" />
        <div><input type="submit" value="Save" name="update_contact"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
	  <?php
  }
if(isset($_POST['updateeverytable']) && $_POST['tablename']=='all_items')
  {
	  $neque="select * from tblitems where ItemId ='".$_POST['recordid']."'";
	  $my2query=mysqli_query($con,$neque);
      $myItem = mysqli_fetch_array($my2query,MYSQLI_ASSOC);
	  ?>
	  <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1><?php echo $myItem['Name'];?></h1>
        <table>
        	<tr>
            	<td>Name</td><td colspan="2"><input type="text" name="name" style="width:340px;" value="<?php echo $myItem['Name'];?>" /></td>
            </tr>
            <tr>
            	<td>Category No.</td><td colspan="2"><input type="text" name="category_no" style="width:340px;"  value="<?php echo $myItem['CateNo'];?>"/></td>
            </tr>
            <tr>
            	<td>Pake Size</td><td colspan="2"><input type="text" name="Pak_size" style="width:340px;"  value="<?php echo $myItem['PackSize'];?>"/></td>
            </tr>
            <tr>
            	<td>Supplier</td><td colspan="2">
                <select name="supplier" id="supplier" style="width:340px;">
                      <?php $newquery="select * from tblsuppliers";
                            $myquery=mysqli_query($con,$newquery);
                            while($myfetch = mysqli_fetch_array($myquery,MYSQLI_ASSOC))
                            {
                      ?>     
                                <option value="<?php echo $myfetch['suplierId']?>" <?php if($myfetch['suplierId']==$myItem['suplierId']){ ?> selected="selected" <?php }?>>
									<?php echo $myfetch['Name']?>
                                </option> 
                      <?php } ?>
                </select>
            </tr>
            <tr>
            	<td>Manufacturer</td><td colspan="2">
                	<select name="manufacturer" id="manufacturer" style="width:340px;">
                      <?php $newquery="select * from tblcompany";
                            $myquery=mysqli_query($con,$newquery);
                            while($myfetch = mysqli_fetch_array($myquery,MYSQLI_ASSOC))
                            {
                      ?>     
                                <option value="<?php echo $myfetch['CompanyId']?>" <?php if($myfetch['CompanyId']==$myItem['CompanyId']){ ?> selected="selected" <?php }?>>
									<?php echo $myfetch['Name']?>
                                </option> 
                      <?php } ?>
                      </select>
                </td>
            </tr>
            <tr>
            	<td>Prev Price</td><td colspan="2"><input type="text" name="prev_price" style="width:340px;"  value="<?php echo $myItem['previousPrice'];?>"/></td>
            </tr>
            <tr>
            	<td>Current Price</td><td colspan="2"><input type="text" name="current_price" style="width:340px;"  value="<?php echo $myItem['currentPrice'];?>"/></td>
            </tr>
            <tr>
            	<td>Border Line</td><td><input type="text" name="border_line" style="width:340px;"  value="<?php echo $myItem['borderLine'];?>"/></td>
            </tr>
            
            <tr>
            	<td rowspan="2">Remarks</td><td rowspan="2" colspan="3"><textarea name="remarks" style="width:100%; height:100px;"> <?php echo $myItem['Remarks'];?></textarea></td>
            </tr>
        </table>
        <input type="hidden" name="itemidhidden" value="<?php echo $myItem['ItemId'];?>" />
        <div><input type="submit" value="Save" name="updatenewitem"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
	  <?php
  }
  
if(isset($_POST['first_char']) && $_POST['tbl_name']=='tbladdressbook')
  {
	  ?>
      <div class="welcome">Address Book</div>
      <div class="content">
      <div>
      <a class="nav-bar-links" href="#" data-reveal-id="newContact"><button>New</button></a>&nbsp;&nbsp;
      <input type="text" name="searchcat" id="searchcat" />
      <input type="hidden" name="enddate" id="enddate" />
      <select name="searchby" id="searchby">
      	<option value="Name">Name</option>
        <option value="Mobile">Mobile</option>
        <option value="HomeNo">HomeNo</option>
        <option value="OfficeNo">OfficeNo</option>
      </select>
      <button onclick="searchcat('tbladdressbook')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      <button onclick="firstletter('a','tbladdressbook')">Clear Search</button>
      </div>
      <div> Search By First Letter</div>
      <div class="letters">
      	<span onclick="firstletter('a','tbladdressbook')">A</span>
        <span onclick="firstletter('b','tbladdressbook')">B</span>
        <span onclick="firstletter('c','tbladdressbook')">C</span>
        <span onclick="firstletter('d','tbladdressbook')">D</span>
        <span onclick="firstletter('e','tbladdressbook')">E</span>
        <span onclick="firstletter('f','tbladdressbook')">F</span>
        <span onclick="firstletter('g','tbladdressbook')">G</span>
        <span onclick="firstletter('h','tbladdressbook')">H</span>
        <span onclick="firstletter('i','tbladdressbook')">I</span>
        <span onclick="firstletter('j','tbladdressbook')">J</span>
        <span onclick="firstletter('k','tbladdressbook')">K</span>
        <span onclick="firstletter('l','tbladdressbook')">L</span>
        <span onclick="firstletter('m','tbladdressbook')">M</span>
        <span onclick="firstletter('n','tbladdressbook')">N</span>
        <span onclick="firstletter('o','tbladdressbook')">O</span>
        <span onclick="firstletter('p','tbladdressbook')">P</span>
        <span onclick="firstletter('q','tbladdressbook')">Q</span>
        <span onclick="firstletter('r','tbladdressbook')">R</span>
        <span onclick="firstletter('s','tbladdressbook')">S</span>
        <span onclick="firstletter('t','tbladdressbook')">T</span>
        <span onclick="firstletter('u','tbladdressbook')">U</span>
        <span onclick="firstletter('v','tbladdressbook')">V</span>
        <span onclick="firstletter('w','tbladdressbook')">W</span>
        <span onclick="firstletter('x','tbladdressbook')">X</span>
        <span onclick="firstletter('y','tbladdressbook')">Y</span>
        <span onclick="firstletter('z','tbladdressbook')">Z</span>
      </div>
      
      <div class="searchresults">
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Update';?></th>
                <th style="background:#999"><?php echo 'Name';?></th>
                <th style="background:#999"><?php echo 'Office Telephone No.';?></th>
                <th style="background:#999"><?php echo 'Mobile';?></th>
                <th style="background:#999"><?php echo 'Home Tel No.';?></th>
                <th style="background:#999"><?php echo 'Job Title';?></th>
                <th style="background:#999"><?php echo 'Category';?></th>
                <th style="background:#999"><?php echo 'Department';?></th>
                <th style="background:#999"><?php echo 'Company';?></th>
                <th style="background:#999"><?php echo 'Office Fax';?></th>
                <th style="background:#999"><?php echo 'Email';?></th>
                <th style="background:#999"><?php echo 'Creation Date';?></th>
        </tr>
	  <?php
	  $query=mysqli_query($con,"SELECT tbladdressbook.Name,tbladdressbook.ContactId, tbladdressbook.CTelNo, tbladdressbook.CTelNo,
											tbladdressbook.HTelNo, tbladdressbook.JobTitle,tbladdressbook.Department, 
											tbladdressbook.Company, tbladdressbook.CFax,tbladdressbook.CFax, 
											tbladdressbook.Email, tbladdressbook.creationdate, tblabcategory.CName
											 FROM tbladdressbook INNER JOIN tblabcategory
											 ON tbladdressbook.CategoryId=tblabcategory.CategoryId
											 WHERE SUBSTR(tbladdressbook.Name,1,1) = '".$first_char."'");
	  
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><a href="#" data-reveal-id="updateeverytable" onclick="updateeverytable('tbladdressbook','<?php echo $role['ContactId']?>')">Update</a></td>
                <td><?php echo $role['Name']?></td>
                <td><?php echo $role['CTelNo']?></td>
                <td><?php echo $role['CTelNo']?></td>
                <td><?php echo $role['HTelNo']?></td>
                <td><?php echo $role['JobTitle']?></td>
                <td><?php echo $role['CName']?></td>
                <td><?php echo $role['Department']?></td>
                <td><?php echo $role['Company']?></td>
                <td><?php echo $role['CFax']?></td>
                <td><?php echo $role['Email']?></td>
                <td><?php echo $role['creationdate']?></td>
            </tr>
			<?php
		}
		?>
		</table>
        </div>
        </div>
		<?php
  }
if(isset($_POST['first_char']) && $_POST['tbl_name']=='tbltest')
  {
	  ?>
       <div class="welcome">Tests</div>
       <div class="content">
       <div>
       
       <a class="nav-bar-links" href="#" data-reveal-id="newtest"><button>New</button></a>&nbsp;&nbsp;
      <input type="text" name="searchcat" id="searchcat" />
      <input type="hidden" name="enddate" id="enddate" />
      <select name="searchby" id="searchby">
      	<option value="Name">Name</option>
        <option value="Code">Code</option>
      </select>
      <button onclick="searchcat('tbltest')">Search</button>
      <button onclick="PrintElem('.content')">Print Grid</button>
      </div>
      <div> Search By First Letter</div>
      <div class="letters">
      	<span onclick="firstletter('a','tbltest')">A</span>
        <span onclick="firstletter('b','tbltest')">B</span>
        <span onclick="firstletter('c','tbltest')">C</span>
        <span onclick="firstletter('d','tbltest')">D</span>
        <span onclick="firstletter('e','tbltest')">E</span>
        <span onclick="firstletter('f','tbltest')">F</span>
        <span onclick="firstletter('g','tbltest')">G</span>
        <span onclick="firstletter('h','tbltest')">H</span>
        <span onclick="firstletter('i','tbltest')">I</span>
        <span onclick="firstletter('j','tbltest')">J</span>
        <span onclick="firstletter('k','tbltest')">K</span>
        <span onclick="firstletter('l','tbltest')">L</span>
        <span onclick="firstletter('m','tbltest')">M</span>
        <span onclick="firstletter('n','tbltest')">M</span>
        <span onclick="firstletter('o','tbltest')">O</span>
        <span onclick="firstletter('p','tbltest')">P</span>
        <span onclick="firstletter('q','tbltest')">Q</span>
        <span onclick="firstletter('r','tbltest')">R</span>
        <span onclick="firstletter('s','tbltest')">S</span>
        <span onclick="firstletter('t','tbltest')">T</span>
        <span onclick="firstletter('u','tbltest')">U</span>
        <span onclick="firstletter('v','tbltest')">V</span>
        <span onclick="firstletter('w','tbltest')">W</span>
        <span onclick="firstletter('x','tbltest')">X</span>
        <span onclick="firstletter('y','tbltest')">Y</span>
        <span onclick="firstletter('z','tbltest')">Z</span>
      </div>
      <div class="searchresults">
    	  <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Code';?></th>
                <th style="background:#999"><?php echo 'Name';?></th>
                <th style="background:#999"><?php echo 'Heading';?></th>
                <th style="background:#999"><?php echo 'Perform Time';?></th>
                <th style="background:#999"><?php echo 'Chemical Used';?></th>
                <th style="background:#999"><?php echo 'Available';?></th>
                <th style="background:#999"><?php echo 'Active';?></th>
                <th style="background:#999"><?php echo 'IsTextOnly';?></th>
                <th style="background:#999"><?php echo 'Machine';?></th>
                <th style="background:#999"><?php echo 'ShowGraph';?></th>
                <th style="background:#999"><?php echo 'TestNote';?></th>
                <th style="background:#999"><?php echo 'TestReportType';?></th>
                <th style="background:#999"><?php echo 'tstDepartId';?></th>
                <th style="background:#999"><?php echo 'Update';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT tbltest.Code, tbltest.Name as testname, tbltest.Heading, tbltest.tstNameId, 
											tbltest.tstPerformTime, tbltest.chemicalUsed, tbltest.IsAvailable, 
											tbltest.isActive, tbltest.IsTextOnly, tbltest.ShowMachineDetails, 
											tbltest.ShowGraph, tbltest.TestNote, tbltest.TestReportType,
											 tbltestdepartments.Name
											 FROM tbltest LEFT OUTER JOIN tbltestdepartments
											 ON tbltest.tstDepartId=tbltestdepartments.tstDepartId
											 WHERE SUBSTR(tbltest.Name,1,1) = '".$first_char."'");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['Code']?></td>
                <td><?php echo $role['testname']?></td>
                <td><?php echo $role['Heading']?></td>
                <td><?php echo $role['tstPerformTime']?></td>
                <td><?php echo $role['chemicalUsed']?></td>
                <td><input type="checkbox" <?php if($role['IsAvailable']=="1"){ ?> checked="checked"<?php }?>  /></td>
                <td><input type="checkbox" <?php if($role['isActive']=="1"){ ?> checked="checked"<?php }?>  /></td>
                <td><input type="checkbox" <?php if($role['IsTextOnly']=="1"){ ?> checked="checked"<?php }?>  /></td>
                <td><input type="checkbox" <?php if($role['ShowMachineDetails']=="1"){ ?> checked="checked"<?php }?>  /></td>
                <td><input type="checkbox" <?php if($role['ShowGraph']=="1"){ ?> checked="checked"<?php }?>  /></td>
                <td><input type="checkbox" <?php if($role['TestNote']=="1"){ ?> checked="checked"<?php }?>  /></td>
               
                <td><?php //echo $role['TestReportType']?>
                	<?php if($role['TestReportType']==2)
							{
								echo "TwoColumn";
							}
						  else if($role['TestReportType']==3)
						    {
								echo "ThreeColumn";
							}
						  else if($role['TestReportType']==4)
						    {
								echo "BigReports";
							}
						  else if($role['TestReportType']==5)
						    {
								echo "Culture";
							}
						  else if($role['TestReportType']==6)
						    {
								echo "TwoResults";
							}
						  else if($role['TestReportType']==7)
						    {
								echo "TextOnly";
							}
						  else if($role['TestReportType']==8)
						    {
								echo "TwoColumnGrou";
							}
					?>
                </td>
                <td><td><a href="#" data-reveal-id="updatetest" onclick="updatetest('<?php echo $role['tstNameId']?>')">Update</a></td></td>
            </tr>
			<?php
		}
		?>
		</table>
      </div>
     </div>
<?php
  }
  
if(isset($_POST['searchtext2']))
  {
	  ?>
      
      <table border="1">
	  	<tr>       	
                <th style="background:#999">
                	Open
                </th>
                <th style="background:#999"><?php echo 'Location';?></th>
                <th style="background:#999"><?php echo 'Name';?></th>
                <th style="background:#999"><?php echo 'Department';?></th>
                <th style="background:#999"><?php echo 'Phone';?></th>
                <th style="background:#999"><?php echo 'Mobile';?></th>
                <th style="background:#999"><?php echo 'Last Login Date';?></th>
                <th style="background:#999"><?php echo 'Qualification';?></th>
                <th style="background:#999"><?php echo 'Joining Date';?></th>
                <th style="background:#999"><?php echo 'Experience';?></th>
                <th style="background:#999"><?php echo 'EmergencyConatct';?></th>
                
                <th style="background:#999"><?php echo 'Leaving Date';?></th>
                <th style="background:#999"><?php echo 'Rejoining Date';?></th>
                <th style="background:#999"><?php echo 'Rejoined';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT tblemployee.name, tblemployee.EmployeeId, tblemployee.telephone, tblemployee.mobile, tblemployee.PointId,
											  tblemployee.lastLoginDate, tblemployee.Qualification, tblemployee.JoiningDate, 
											  tblemployee.Experience, tblemployee.EmergencyContact, tblemployee.LeavingDate,
											  tblemployee.Experience, tblemployee.EmergencyContact,  tblemployee.IsRejoining,
											  tblemployee.LeavingDate, tblemployee.RejoiningDate, tbltestdepartments.Name
											   FROM tblemployee INNER JOIN tbltestdepartments
											   ON tblemployee.EmpDepartId=tbltestdepartments.tstDepartId
											   where tblemployee.name like '%".$searchtext2."%'");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td>
                    <a href="#" data-reveal-id="employee_fill" onclick="employeeajax('<?php echo $role['EmployeeId']?>')">
                            Open
                    </a>
                </td>
            	<td><?php /*echo $role['PointId'];*/ $rtt="select * from tblpoints where PointId='".$role['PointId']."'";
					$query2=mysqli_query($con,$rtt);
        			$role2=mysqli_fetch_array($query2,MYSQLI_ASSOC); echo $role2['location'];?></td>
                <td><?php echo $role['name']?></td>
                <td><?php echo $role['Name']?></td>
                <td><?php echo $role['telephone']?></td>
                <td><?php echo $role['mobile']?></td>
                <td><?php echo $role['lastLoginDate']?></td>
                <td><?php echo $role['Qualification']?></td>
                <td><?php echo $role['JoiningDate']?></td>
                <td><?php echo $role['Experience']?></td>
                <td><?php echo $role['EmergencyContact']?></td>
                <td><?php echo $role['LeavingDate']?></td>
                <td><?php echo $role['RejoiningDate']?></td>
                <td><input type="checkbox" <?php if($role['IsRejoining']=="1"){ ?> checked="checked"<?php }?>  /></td>
            </tr>
			<?php
		}
		?>
		</table>
		<?php
  }
if(isset($_POST['searchtext']) && $_POST['searchtable']=="tbladdressbook")
  {
	  ?>
      
		<table border="1">
		  <tr>
				  <th style="background:#999"><?php echo 'Name';?></th>
				  <th style="background:#999"><?php echo 'Office Telephone No.';?></th>
				  <th style="background:#999"><?php echo 'Mobile';?></th>
				  <th style="background:#999"><?php echo 'Home Tel No.';?></th>
				  <th style="background:#999"><?php echo 'Job Title';?></th>
				  <th style="background:#999"><?php echo 'Category';?></th>
				  <th style="background:#999"><?php echo 'Department';?></th>
				  <th style="background:#999"><?php echo 'Company';?></th>
				  <th style="background:#999"><?php echo 'Office Fax';?></th>
				  <th style="background:#999"><?php echo 'Email';?></th>
				  <th style="background:#999"><?php echo 'Creation Date';?></th>
		  </tr>
		<?php
		$query="SELECT tbladdressbook.Name, tbladdressbook.CTelNo, tbladdressbook.CTelNo,
											  tbladdressbook.HTelNo, tbladdressbook.JobTitle,tbladdressbook.Department, 
											  tbladdressbook.Company, tbladdressbook.CFax,tbladdressbook.CFax, 
											  tbladdressbook.Email, tbladdressbook.creationdate, tblabcategory.CName
											   FROM tbladdressbook INNER JOIN tblabcategory
											   ON tbladdressbook.CategoryId=tblabcategory.CategoryId";
		
		if(isset($_POST['searchby']) && $_POST['searchby']=='Name')
		{
			$query.=" WHERE tbladdressbook.Name like '%".$searchtext."%'";
		}
		if(isset($_POST['searchby']) && $_POST['searchby']=='Mobile')
		{
			$query.=" WHERE tbladdressbook.Mobile like '%".$searchtext."%'";
		}
		if(isset($_POST['searchby']) && $_POST['searchby']=='HomeNo')
		{
			$query.=" WHERE tbladdressbook.HTelNo like '%".$searchtext."%'";
		}
		if(isset($_POST['searchby']) && $_POST['searchby']=='OfficeNo')
		{
			$query.=" WHERE tbladdressbook.CTelNo like '%".$searchtext."%'";
		}
		$mid=mysqli_query($con,$query);
		while($role=mysqli_fetch_array($mid,MYSQLI_ASSOC))
		  {
			  ?>
			  <tr>
				  <td><?php echo $role['Name']?></td>
				  <td><?php echo $role['CTelNo']?></td>
				  <td><?php echo $role['CTelNo']?></td>
				  <td><?php echo $role['HTelNo']?></td>
				  <td><?php echo $role['JobTitle']?></td>
				  <td><?php echo $role['CName']?></td>
				  <td><?php echo $role['Department']?></td>
				  <td><?php echo $role['Company']?></td>
				  <td><?php echo $role['CFax']?></td>
				  <td><?php echo $role['Email']?></td>
				  <td><?php echo $role['creationdate']?></td>
			  </tr>
			  <?php
		  }
		  ?>
		  </table>
		  <?php }
if(isset($_POST['searchtext']) && $_POST['searchtable']=="tblpoints")
  {
	  ?>
		<table border="1">
	  	<tr>       	
                <th style="background:#999"><?php echo 'Update';?></th>
                <th style="background:#999"><?php echo 'PointId';?></th>
                <th style="background:#999"><?php echo 'Location';?></th>
                <th style="background:#999"><?php echo 'ICode';?></th>
                <th style="background:#999"><?php echo 'Current Point Number';?></th>
                <th style="background:#999" width="500"><?php echo 'Address';?></th>
                <th style="background:#999"><?php echo 'PhoneNo.';?></th>
                <th style="background:#999"><?php echo 'Fax';?></th>
                <th style="background:#999"><?php echo 'Email';?></th>
                <th style="background:#999"><?php echo 'isActive.';?></th>
                <th style="background:#999"><?php echo 'CreateDate';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT * from tblpoints where location like '%".$_POST['searchtext']."%'");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><a href="#" data-reveal-id="updatepoint" onclick="updatepoint('<?php echo $role['PointId']?>')">Update</a></td>
                <td><?php echo $role['PointId'];?></td>
                <td><?php echo $role['location'];?></td>
                <td><?php echo $role['lCode'];?></td>
                <td><?php echo $role['current_point_no'];?></td>
                <td style="width:600px;"><?php echo $role['Address'];?></td>
                <td><?php echo $role['PhoneNo'];?></td>
                <td><?php echo $role['Fax'];?></td>
                <td><?php echo $role['Email'];?></td>
                <td><input type="checkbox" <?php if($role['isActive']=="1"){ ?> checked="checked"<?php }?>  /></td>
                <td><?php echo $role['Createddate'];?></td>
                <td><?php echo $role['Remarks'];?></td>
            </tr>
			<?php
		}
		?>
		</table>
		<?php }
if(isset($_POST['searchtext']) && $_POST['searchtable']=="tblspecimenbottles")
  {
	  ?>
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Bootle';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
        </tr>
	  <?php
	  $query=mysqli_query($con,"SELECT * from tblspecimenbottles where ContainerName like '%".$_POST['searchtext']."%'");
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['ContainerName']?></td>
                <td><?php echo $role['Remarks']?></td>
            </tr>
			<?php
		}
		?>
		</table> 
		<?php }
if(isset($_POST['searchtext']) && $_POST['searchtable']=="tblroles")
  {
	  ?>
		<table border="1">
	  <?php
	  $query=mysqli_query($con,"select * from tblroles where Name like '%".$_POST['searchtext']."%' ORDER BY `Name` DESC");
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
                <th style="background:#999"><?php echo 'Role Name';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
            </tr>
            <tr>
            	<td style="color:blue;"><?php echo $role['Name']?></td><td style="color:blue;"><?php echo $role['Remarks']?></td>
            </tr>
            <tr>
                <td colspan="2">
                  <table border="1" style="padding:0 0 0 20px;">
                  	<tr>
                        <th style="background:#999"><?php echo 'Role Name';?></th>
                        <th style="background:#999"><?php echo 'Remarks';?></th>
                    </tr>
                  <?php $query2=mysqli_query($con,"SELECT tblrights.RightId, tblrights.RightName, tblrights.Remarks
											 FROM tblrights INNER JOIN tblrolesrights
											 ON tblrights.RightId=tblrolesrights.RightId
											 where tblrolesrights.RoleId = '".$role['RoleId']."'"); 
                          while($role2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                              {
                                  ?>
                                <tr><td><?php echo $role2['RightName'];?></td><td><?php echo $role2['Remarks'];?></td></tr>
								  <?php
                              }
                  ?>
                  </table>
                </td>
            </tr>
			<?php
		}
		?>
      </table>
		<?php }	
if(isset($_POST['searchtext']) && $_POST['searchtable']=="tblrights")
  {
	  ?>
		<table border="1">
            <tr>
                <th style="background:#999"><?php echo 'Rights';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
            </tr>
	  <?php
	  $query=mysqli_query($con,"select * from tblrights where RightName like '%".$_POST['searchtext']."%' ORDER BY `RightName` DESC");
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['RightName']?></td><td><?php echo $role['Remarks']?></td>
            </tr>
			<?php
		}
		?></table>
		<?php }
if(isset($_POST['searchtext']) && $_POST['searchtable']=="tblexpensetype")
  { ?>
<table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Type';?></th>
                <th style="background:#999"><?php echo 'Details';?></th>
                <th style="background:#999"><?php echo 'IsActive';?></th>
                <th style="background:#999"><?php echo 'LastUpdateDate';?></th>
                <th style="background:#999"><?php echo 'Updated By';?></th>
        </tr>
	  <?php
	  $query=mysqli_query($con,"SELECT tblexpensetype.Type, tblexpensetype.Details, tblexpensetype.IsActive, 
	  					  tblexpensetype.LastUpdateDate, tblemployee.login
                          FROM tblexpensetype INNER JOIN tblemployee
                          ON tblexpensetype.UpdateBy=tblemployee.EmployeeId
						  where tblexpensetype.Type like '%".$_POST['searchtext']."%'
                          ORDER BY tblexpensetype.Type DESC");
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['Type']?></td>
                <td><?php echo $role['Details']?></td>
                <td><?php echo $role['IsActive']?></td>
                <td><?php echo $role['LastUpdateDate']?></td>
                <td><?php echo $role['login']?></td>
            </tr>
			<?php
		}
		?>
		</table>
        <?php }
if(isset($_POST['searchtext']) && $_POST['searchtable']=="tblpaneldetails")
  {
	  ?>
		<table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Update';?></th>
                <th style="background:#999"><?php echo 'Report';?></th>
                <th style="background:#999"><?php echo 'Panel Code';?></th>
                <th style="background:#999"><?php echo 'Panel Name';?></th>
                <th style="background:#999"><?php echo 'Address';?></th>
                <th style="background:#999"><?php echo 'Phone';?></th>
                <th style="background:#999"><?php echo 'Mobile';?></th>
                <th style="background:#999"><?php echo 'Show Price';?></th>
                <th style="background:#999"><?php echo 'Email';?></th>
                <th style="background:#999"><?php echo 'isActive';?></th>
                <th style="background:#999"><?php echo 'Created Date';?></th>
                <th style="background:#999"><?php echo 'Contact_person';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
                <th style="background:#999"><?php echo 'PanelListOnly';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT * FROM `tblpaneldetails` where Name like '%".$searchtext."%'");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><a href="#" data-reveal-id="updatepanel" onclick="updatepanel('<?php echo $role['PanelId']?>')">Update</a></td>
                <td><a href="#" onclick="viewPanelReport('<?php echo $role['PanelId']?>')">VeiwReport</a></td>
                <td><?php echo $role['PanelCode']?></td>
                <td><?php echo $role['Name']?></td>
                <td><?php echo $role['Address']?></td>
                <td><?php echo $role['Phone']?></td>
                <td><?php echo $role['Mobile']?></td>
                <td><input type="checkbox" <?php if($role['showPrice']=="1"){ ?> checked="checked"<?php }?>  /></td>
                <td><?php echo $role['Email']?></td>
                <td><input type="checkbox" <?php if($role['isActive']=="1"){ ?> checked="checked"<?php }?>  /></td>
                <td><?php echo $role['CreatedDate']?></td>
                <td><?php echo $role['Contact_person']?></td>
                <td><?php echo $role['Description']?></td>
                <td><input type="checkbox" <?php if($role['PanelListOnly']=="1"){ ?> checked="checked"<?php }?>  /></td>
            </tr>
			<?php
		}
		?>
		</table>
		
		  <?php }
if(isset($_POST['searchtext']) && $_POST['searchtable']=="add_book_cat")
  {
	  ?>
		<table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Name';?></th>
                <th style="background:#999"><?php echo 'Description';?></th>
                <th style="background:#999"><?php echo 'Update';?></th>
        </tr>
	  <?php
	  $query=mysqli_query($con,"SELECT * from tblabcategory where CName like '%".$_POST['searchtext']."%' order by CName DESC");
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['CName']?></td>
                <td><?php echo $role['Description']?></td>
                <td><a href="#" data-reveal-id="updateeverytable" onclick="updateeverytable('add_book_cat','<?php echo $role['CategoryId']?>')">Update</a></td>
            </tr>
			<?php
		}
		?>
		</table>
		<?php }

if(isset($_POST['searchtext']) && $_POST['searchtable']=="tbltest")
  {
	  ?>
		
		<table border="1">
		  <tr>
				  <th style="background:#999"><?php echo 'Code';?></th>
                <th style="background:#999"><?php echo 'Name';?></th>
                <th style="background:#999"><?php echo 'Heading';?></th>
                <th style="background:#999"><?php echo 'Perform Time';?></th>
                <th style="background:#999"><?php echo 'Chemical Used';?></th>
                <th style="background:#999"><?php echo 'Available';?></th>
                <th style="background:#999"><?php echo 'Active';?></th>
                <th style="background:#999"><?php echo 'IsTextOnly';?></th>
                <th style="background:#999"><?php echo 'Machine';?></th>
                <th style="background:#999"><?php echo 'ShowGraph';?></th>
                <th style="background:#999"><?php echo 'TestNote';?></th>
                <th style="background:#999"><?php echo 'TestReportType';?></th>
                <th style="background:#999"><?php echo 'tstDepartId';?></th>
                <th style="background:#999"><?php echo 'Update';?></th>
		  </tr>
		<?php
		$query="SELECT tbltest.Code, tbltest.Name as testname, tbltest.Heading,
											tbltest.tstPerformTime, tbltest.chemicalUsed, tbltest.IsAvailable, 
											tbltest.isActive, tbltest.IsTextOnly, tbltest.ShowMachineDetails, 
											tbltest.ShowGraph, tbltest.TestNote, tbltest.TestReportType,
											 tbltestdepartments.Name
											 FROM tbltest INNER JOIN tbltestdepartments
											 ON tbltest.tstDepartId=tbltestdepartments.tstDepartId";
		
		if(isset($_POST['searchby']) && $_POST['searchby']=='Name')
		{
			$query.=" WHERE tbltest.Name like '%".$searchtext."%'";
		}
		if(isset($_POST['searchby']) && $_POST['searchby']=='Code')
		{
			$query.=" WHERE tbltest.Code like '%".$searchtext."%'";
		}
		
		$mid=mysqli_query($con,$query);
		while($role=mysqli_fetch_array($mid,MYSQLI_ASSOC))
		  {
			  ?>
			  <tr>
				  <td><?php echo $role['Code']?></td>
                <td><?php echo $role['testname']?></td>
                <td><?php echo $role['Heading']?></td>
                <td><?php echo $role['tstPerformTime']?></td>
                <td><?php echo $role['chemicalUsed']?></td>
                <td><?php echo $role['IsAvailable']?></td>
                <td><?php echo $role['isActive']?></td>
                <td><?php echo $role['IsTextOnly']?></td>
                <td><?php echo $role['ShowMachineDetails']?></td>
                <td><?php echo $role['ShowGraph']?></td>
                <td><?php echo $role['TestNote']?></td>
                <td><?php echo $role['TestReportType']?></td>
                <td><?php echo $role['Name']?></td>
                <td><a href="#" data-reveal-id="updatetest" onclick="updatetest('<?php echo $role['tstNameId']?>')">Update</a></td>
			  </tr>
			  <?php
		  }
		  ?>
		  </table>
		  <?php }
if(isset($_POST['searchtext']) && $_POST['searchtable']=="tblcategories")
  {
	  ?>
		<table border="1">
	  	<tr>       	
                <th style="background:#999"><?php echo 'Category';?></th>
                <th style="background:#999"><?php echo 'ParentCategory';?></th>
                <th style="background:#999"><?php echo 'Type';?></th>
        </tr>
	  <?php
			  $query="SELECT * from tblcategories";
	if(isset($_POST['searchby']) && $_POST['searchby']=='Category')
		{
			$query.=" WHERE Category like '%".$searchtext."%'";
		}
		if(isset($_POST['searchby']) && $_POST['searchby']=='TypeID')
		{
			$query="SELECT tblcategories.ParentCategoryID, tblcategories.TypeID , tblcategories.Category,
											tbltypes.Type
											 FROM tblcategories 
											 INNER JOIN tbltypes
											 ON tblcategories.TypeID=tbltypes.TypeID
											 WHERE tbltypes.Type like '%".$searchtext."%'";
		}
		$qh=mysqli_query($con,$query);
	  while($role=mysqli_fetch_array($qh,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['Category'];?></td>
                <?php $new=mysqli_query($con,"select * from tblcategories where CategoryID ='".$role['ParentCategoryID']."'");
					  $newfetch=mysqli_fetch_array($new,MYSQLI_ASSOC);
				?>
                <td><?php echo $newfetch['Category']?></td>
                <?php $new2=mysqli_query($con,"select * from tbltypes where TypeID ='".$role['TypeID']."'");
					  $newfetch2=mysqli_fetch_array($new2,MYSQLI_ASSOC);
				?>
                <td><?php echo $newfetch2['Type']?></td>
            </tr>
			<?php
		}
		?>
		</table>
		
		  <?php }
if(isset($_POST['searchtext']) && $_POST['searchtable']=="tblspecimens")
  {
	  ?>
		<table border="1">
	  	<tr>
            	
                <th style="background:#999"><?php echo 'Speciman Code';?></th>
                <th style="background:#999"><?php echo 'SpecimanName';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
        </tr>
	  <?php
			  $query="SELECT * from tblspecimens";
			  if(isset($_POST['searchby']) && $_POST['searchby']=='SpecimenName')
			  {
				  $query.=" WHERE SpecimenName like '%".$searchtext."%'";
			  }
			  if(isset($_POST['searchby']) && $_POST['searchby']=='SpecimenCode')
			  {
				  $query.=" WHERE SpecimenCode like '%".$searchtext."%'";
			  }
			  $query2=mysqli_query($con,$query);
	  while($role=mysqli_fetch_array($query2,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['SpecimenCode']?></td>
                <td><?php echo $role['SpecimenName']?></td>
                <td><?php echo $role['Remarks']?></td>
            </tr>
			<?php
		}
		?>
		</table>
<?php }
if(isset($_POST['searchtext']) && $_POST['searchtable']=="tblantibiotics")
  {
	  ?>
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Code';?></th>
                <th style="background:#999"><?php echo 'Name';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
                <th style="background:#999"><?php echo 'Update';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT * from tblantibiotics where Name like '%".$searchtext."%'");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['Code']?></td>
                <td><?php echo $role['Name']?></td>
                <td><?php echo $role['Remarks']?></td>
                <td><a href="#" data-reveal-id="updateantibiotec" onclick="updateantibiotec('<?php echo $role['AntId']?>')">Update</a></td>
            </tr>
			<?php
		}
		?>
		</table>
        <?php }

if(isset($_POST['searchtext']) && $_POST['searchtable']=="tbltestnotes")
  {
	  ?>
      
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Note Name';?></th>
                <th style="background:#999"><?php echo 'Note Heading';?></th>
                <th style="background:#999"><?php echo 'Note';?></th>
                <th style="background:#999"><?php echo 'update';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT * from tbltestnotes where NoteName like '%".$searchtext."%'");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['NoteName']?></td>
                <td><?php echo $role['NoteHeading']?></td>
                <td><?php echo $role['Note']?></td>
                <td><a href="#" data-reveal-id="updatetestnote" onclick="updatetestnote('<?php echo $role['NoteId']?>')">Update</a></td>
            </tr>
			<?php
		}
		?>
		</table>
        <?php }
if(isset($_POST['searchtext']) && $_POST['searchtable']=="tblorganisms")
  {
	  ?>
  <table border="1">
	  	<tr>
            	
                <th style="background:#999"><?php echo 'Name';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT * from tblorganisms  WHERE Name like '%".$searchtext."%'");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	
                <td><?php echo $role['Name']?></td>
                <td><?php echo $role['Remarks']?></td>
            </tr>
			<?php
		}
		?>
		</table>
        <?php }
if(isset($_POST['searchtext']) && $_POST['searchtable']=="tblmachinedetails")
  {
	  ?>
  <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Point Location';?></th>
                <th style="background:#999"><?php echo 'Machine Name';?></th>
                <th style="background:#999"><?php echo 'Method';?></th>
                <th style="background:#999"><?php echo 'Company';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
                <th style="background:#999"><?php echo 'Update';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT tblmachinedetails.machineName, tblmachinedetails.Method, tblmachinedetails.Company, 
	  					  tblmachinedetails.Remarks, 
						  tblpoints.location
                          FROM tblmachinedetails INNER JOIN tblpoints
                          ON tblmachinedetails.PointId=tblpoints.PointId
						  WHERE machineName like '%".$searchtext."%'");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['location']?></td>
                <td><?php echo $role['machineName']?></td>
                <td><?php echo $role['Method']?></td>
                <td><?php echo $role['Company']?></td>
                <td><?php echo $role['Remarks']?></td>
                <td><a href="#" data-reveal-id="updateeverytable" onclick="updateeverytable('tblmachinedetails','<?php echo $role['machineId']?>')">Update</a></td>
            </tr>
			<?php
		}
		?>
		</table>
        <?php }
if(isset($_POST['searchtext']) && $_POST['searchtable']=="all_items")
  {
	  ?>
  		<table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Update';?></th>
            	<th style="background:#999"><?php echo 'Item';?></th>
                <th style="background:#999"><?php echo 'Paksize';?></th>
                <th style="background:#999"><?php echo 'Supplier';?></th>
                <th style="background:#999"><?php echo 'Borderline';?></th>
                <th style="background:#999"><?php echo 'Total Quantity';?></th>
                <th style="background:#999"><?php echo 'Prev Price';?></th>
                <th style="background:#999"><?php echo 'Current Price';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
        </tr>
	  <?php
	  $qutiy="SELECT tblitems.Name as table1Name, tblitems.PackSize as PackSize, tblitems.borderLine as borderLine,
								tblitems.TotQuantity as TotQuantity, tblitems.previousPrice as previousPrice,tblitems.currentPrice as currentPrice,
											 tblitems.Remarks as Remarks, tblSuppliers.Name as table2Name 
											 FROM tblitems INNER JOIN tblSuppliers
											 ON tblitems.suplierId=tblSuppliers.suplierId
											 where tblitems.ItemDate between '".$_POST['searchtext']."' AND '".$_POST['enddate']."'";
	  //echo $qutiy;
	  $query=mysqli_query($con,$qutiy);
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><a href="#" data-reveal-id="updateeverytable" onclick="updateeverytable('all_items','<?php echo $role['ItemId']?>')">Update</a></td>
                <td><?php echo $role['table1Name']?></td>
                <td><?php echo $role['PackSize']?></td>
                <td><?php echo $role['table2Name']?></td>
                <td><?php echo $role['borderLine']?></td>
                <td><?php echo $role['TotQuantity']?></td>
                <td><?php echo $role['previousPrice']?></td>
                <td><?php echo $role['currentPrice']?></td>
                <td><?php echo $role['Remarks']?></td>
            </tr>
			<?php
		}
		?>
		</table>
        
        <?php }

if(isset($_POST['searchtext']) && $_POST['searchtable']=="tblreferredby")
  {
	  ?>
      <table border="1">
	  	<tr>
            	<th style="background:#999"><?php echo 'Location';?></th>
                <th style="background:#999"><?php echo 'Name';?></th>
                <th style="background:#999"><?php echo 'Clinic Name';?></th>
                <th style="background:#999"><?php echo 'Mobile';?></th>
                <th style="background:#999"><?php echo 'Clinic Address';?></th>
                <th style="background:#999"><?php echo 'Clinic Phone';?></th>
                <th style="background:#999"><?php echo 'Discount';?></th>
                <th style="background:#999"><?php echo 'Payable Amount';?></th>
                <th style="background:#999"><?php echo 'Paid Amount';?></th>
                <th style="background:#999"><?php echo 'Remarks';?></th>
                <th style="background:#999"><?php echo 'update';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT tblreferreddoctor.Name,tblreferreddoctor.refId, tblreferreddoctor.clinicName, tblreferreddoctor.Mobile, 
	  					  tblreferreddoctor.cAddress, tblreferreddoctor.cPhone,
						  tblreferreddoctor.Discount, tblreferreddoctor.Remarks,
						  tblreferreddoctor.commission, tblpoints.location
                          FROM tblreferreddoctor INNER JOIN tblpoints
                          ON tblreferreddoctor.PointId=tblpoints.PointId where tblreferreddoctor.Name like '%".$_POST['searchtext']."%'");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['location']?></td>
                <td><?php echo $role['Name']?></td>
                <td><?php echo $role['clinicName']?></td>
                <td><?php echo $role['Mobile']?></td>
                <td><?php echo $role['cAddress']?></td>
                <td><?php echo $role['cPhone']?></td>
                <td><?php echo $role['Discount']?></td>
                <td><?php echo "";?></td>
                <td><?php echo "";?></td>
                <td><?php echo $role['Remarks']?></td>
                <td><a href="#" data-reveal-id="updateeverytable" onclick="updateeverytable('tblreferreddoctor','<?php echo $role['refId']?>')">Update</a></td>
            </tr>
			<?php
		}
		?>
		</table>
        <?php }
if(isset($_POST['searchtext']) && $_POST['searchtable']=="tbltestdepartments")
  {
	  ?>
		
        <table border="1">
	  	<tr>       	
                <th style="background:#999"><?php echo 'Department Name';?></th>
                <th style="background:#999"><?php echo 'Code';?></th>
                <th style="background:#999"><?php echo 'Description';?></th>
                <th style="background:#999"><?php echo 'isActive';?></th>
                <th style="background:#999"><?php echo 'Same No. in one reciept';?></th>
                <th style="background:#999"><?php echo 'Udate';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT * from tbltestdepartments where $searchby like '%".$searchtext."%'");
	
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	<td><?php echo $role['Name']?></td>
                <td><?php echo $role['Code']?></td>
                <td><?php echo $role['Description']?></td>
                <td><input type="checkbox" <?php if($role['isActive']=="1"){ ?> checked="checked"<?php }?>  /></td>
                <td><input type="checkbox" <?php if($role['isstaticdeptcode']=="1"){ ?> checked="checked"<?php }?>  /></td>
                <td><a href="#" data-reveal-id="updateDepartment" onclick="updateDepartment('<?php echo $role['tstDepartId']?>')">Update</a></td>
            </tr>
			<?php
		}
		?>
		</table>
<?php }
if(isset($_POST['searchtext']) && $_POST['searchtable']=="tblpatienttestdetails")
  {
	  ?>
      
      <table border="1">
            <tr>
                <th>Open</th>
                <th style="background:#999"><?php echo 'Date';?></th>
                <th style="background:#999"><?php echo 'Name';?></th>
                <th style="background:#999"><?php echo 'Age';?></th>
                <th style="background:#999"><?php echo 'Agetype';?></th>
                <th style="background:#999"><?php echo 'Gender';?></th>
                <th style="background:#999"><?php echo 'No';?></th>
                <th style="background:#999"><?php echo 'Leb-Ref';?></th>
                <th style="background:#999"><?php echo 'TestName';?></th>
                <th style="background:#999"><?php echo 'Department';?></th>
                <th style="background:#999"><?php echo 'Delivery';?></th>
                <th style="background:#999"><?php echo 'Time';?></th>
                <th style="background:#999"><?php echo 'Reciept';?></th>
                <th style="background:#999"><?php echo 'TestStatus';?></th>
                <th style="background:#999"><?php echo 'TotalBil';?></th>
                <th style="background:#999"><?php echo 'NetBil';?></th>
                <th style="background:#999"><?php echo 'Employee';?></th>
                <th style="background:#999"><?php echo 'Location';?></th>
                <th style="background:#999"><?php echo 'SpecimanDep';?></th>
                <th style="background:#999"><?php echo 'Phone';?></th>
                <th style="background:#999"><?php echo 'IsCancled';?></th>
                <th style="background:#999"><?php echo 'IsStaticDepCode';?></th>
            </tr>
	  <?php
	  //$today1 = mktime(0,0,0,date("Y"),date("m"),date("d"));
	  //$today=date("Y-m-d", $today1);
	  $today=date("Y-m-d");
	   
	  $currenttime=date("H");
	  //echo $currenttime;exit;
	  $query="select 
							 tblpatientreciept.PatientId,
							 tblpatientreciept.PatientTestsId,
							 tblpatientreciept.totalBill,
							 tblpatientreciept.netBill,
							 tblpatientreciept.EmployeeId,
							 tblpatientreciept.IsCanceled,
							 tblpatientreciept.testDate,
							 tblpatientreciept.PointId,
							 tblpatientreciept.Balance,
							 
							 tblpatienttestdetails.isVerified,
							 tblpatienttestdetails.tstNameId,
							 tblpatienttestdetails.pTestDetailsId,
							 tblpatienttestdetails.deliveryDate,
							 tblpatienttestdetails.deliveryTime,
							 tblpatienttestdetails.testStatus,
							 tblpatienttestdetails.SpecimenDue,
							 tblpatienttestdetails.labRefId
							 
							 from tblpatientreciept
							 INNER JOIN 
							 tblpatienttestdetails
							 ON tblpatientreciept.PatientTestsId = tblpatienttestdetails.patientTestsId
							 ";
	  /*if(isset($_POST['searchby']) && $_POST['searchby']=='No')
		{
			$query.=" WHERE tblpatienttestdetails.No like '%".$searchtext."%'";
		}*/
	 if(isset($_POST['searchby']) && $_POST['searchby']=='Phone')
		{
			$query.=" LEFT OUTER JOIN tblpatient ON tblpatientreciept.PatientId = tblpatient.PatientId WHERE tblpatient.PhoneNo like '%".$searchtext."%'";
		}
	 if(isset($_POST['searchby']) && $_POST['searchby']=='LabrefText')
		{
			$query.=" WHERE tblpatienttestdetails.labRefText like '%".$searchtext."%'";
		}
	 if(isset($_POST['searchby']) && $_POST['searchby']=='Name')
		{
			$query.=" LEFT OUTER JOIN tblpatient ON tblpatientreciept.PatientId = tblpatient.PatientId WHERE tblpatient.Name like '%".$searchtext."%'";
		}
	 if(isset($_POST['searchby']) && $_POST['searchby']=='Date')
		{
			$query.=" WHERE tblpatienttestdetails.CreatedDate BETWEEN  '".$searchtext."' AND '".$_POST['enddate']."'";
		}
	 if(isset($_POST['searchby']) && $_POST['searchby']=='DelivryTime')
		{
			$query.=" WHERE tblpatienttestdetails.deliveryDate BETWEEN '".$searchtext."' AND  '".$_POST['enddate']."'";
		}
	 if(isset($_POST['searchby']) && $_POST['searchby']=='DelivryTimeStart')
		{
			$query.=" WHERE HOUR(tblpatienttestdetails.deliveryTime) BETWEEN $searchtext AND $currenttime";
		}
	 if(isset($_POST['searchby']) && $_POST['searchby']=='Department')
		{
			$query.=" LEFT OUTER JOIN tbltest ON tblpatienttestdetails.tstNameId = tbltest.tstNameId
			LEFT OUTER JOIN tbltestdepartments ON tbltestdepartments.tstDepartId = tbltest.tstDepartId
			 WHERE tbltestdepartments.Name like '%".$searchtext."%'";
		}
	 if(isset($_POST['searchby']) && $_POST['searchby']=='TestName')
		{
			$query.=" LEFT OUTER JOIN tbltest ON tblpatienttestdetails.tstNameId = tbltest.tstNameId WHERE tbltest.Name like '%".$searchtext."%'";
		}
		//echo $query;exit;
	  $myquery=mysqli_query($con,$query);
	  while($role=mysqli_fetch_array($myquery,MYSQLI_ASSOC))
		{
			?>
			<?php /*?><tr <?php if($role['Balance']!=0 && $role['isVerified']==0){?> style="background:red;" <?php } else if($role['Balance']!=0){?>style="background:green;" <?php } else if($role['isVerified']==0){?>style="background:blue;" <?php }?>><?php */?>
            <tr <?php if($role['Balance']!=0 && $role['isVerified']==0){?> style="background:#f5f5dc;" <?php } else if($role['Balance']!=0){?>style="background:#f5fffa;" <?php } else if($role['isVerified']==0){?>style="background:f5fffa;" <?php } else { ?> style="background:#fff5ee;" <?php }?>>
            	<td>
                	<a href="#" data-reveal-id="creatrecipt_fill" onclick="patientajax('<?php echo $role['PatientTestsId']?>')">
                    Open
                    </a>
                    <br />
                    <a href="#" data-reveal-id="enterresultsdiv" onclick="enterresultsajax('<?php echo $role['PatientTestsId']?>')">
                    EnterResults
                    </a>
                    <?php if($role['isVerified']==0)
							{
								?>
								<br /><a href="#" data-reveal-id="creatrecipt_fill" onclick="varifyajax('<?php echo $role['PatientTestsId']?>')">Varify</a>
								<?php
							}
					?>
                    <?php if($role['Balance']!=0)
							{
								?>
								<br /><a href="#" data-reveal-id="patientdue" onclick="clearPatientdues('<?php echo $role['PatientTestsId']?>')">ClearDues</a>
								<?php
							}
					?>
                    
                </td>
                <td><?php echo $role['testDate']?></td>
                <?php
                		$querytest="select tblpatient.Name, tblpatient.Age, tblpatient.AgeType,
							 tblpatient.Sex, tblpatient.PhoneNo from tblpatient where PatientId='".$role['PatientId']."'";
						$quer4=mysqli_query($con,$querytest);
						$Patient=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
				?>
                <td><?php echo $Patient['Name']?></td>
                <td><?php echo $Patient['Age']?></td>
                <td><?php echo $Patient['AgeType']?></td>
                <td><?php echo $Patient['Sex']?></td>
                <td><?php echo "2";?></td>
                <td><?php echo $role['labRefId']?></td>
                 <?php
                		$querytest="select Name as testname, tstDepartId from tbltest where tstNameId='".$role['tstNameId']."'";
						$quer4=mysqli_query($con,$querytest);
						$Testname=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
				?>
                <td><?php echo $Testname['testname'];?></td>
                <?php
                		$querytest="select Name, isstaticdeptcode from tbltestdepartments where tstDepartId='".$Testname['tstDepartId']."'";
						$quer4=mysqli_query($con,$querytest);
						$Department=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
				?>
                <td><?php echo $Department['Name']?></td>
                
                <td><?php echo $role['deliveryDate']?></td>
                <td><?php echo $role['deliveryTime']?></td>
                <td><?php echo "New"?></td>
                <td><?php if($role['testStatus']==1){echo "InProgress";}else{echo "Completed";}?></td>
                <td><?php echo $role['totalBill']?></td>
                <td><?php echo $role['netBill']?></td>
                 <?php
                		$querytest="select * from tblemployee where EmployeeId='".$role['EmployeeId']."'";
						$quer4=mysqli_query($con,$querytest);
						$Employee=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
				?>
                <td><?php echo $Employee['login']?></td>
                <?php
                		$querytest="select * from tblpoints where PointId='".$role['PointId']."'";
						$quer4=mysqli_query($con,$querytest);
						$Location=mysqli_fetch_array($quer4,MYSQLI_ASSOC);
				?>
                <td><?php echo $Location['location']?></td>
                <td><input type="checkbox" <?php if($role['SpecimenDue']==1){?> checked="checked"<?php }?> /></td>
                <td><?php echo $Patient['PhoneNo']?></td>
                <td><input type="checkbox" <?php if($role['IsCanceled']==1){?> checked="checked"<?php }?> /></td>
                <td><input type="checkbox" <?php if($Department['isstaticdeptcode']==1){?> checked="checked"<?php }?> /></td>
            </tr>
            <div  id="creatrecipt<?php echo $role['PatientTestsId']?>" class="reveal-modal">
            	<?php //echo $role['PatientTestsId']?>
            </div>
			<?php
		}
		?></table>
 <?php
  }
if(isset($_POST['copyrates']))
  {
	  ?><table class="testrates">
            <tr>
                <th style="width:280px;">Test Name</th>
                <th style="width:280px;">Rate</th>
                
            </tr>
            <?php
                  $query="SELECT tbltest.tstNameId, tbltest.Name, tbltestrates.Rate from tbltest 
				  LEFT JOIN tbltestrates ON tbltest.tstNameId=tbltestrates.tstNameId
				   where tbltestrates.panelId='".$_POST['panelid']."' ORDER BY tbltest.Name ASC; ";
                    //$query="select * from tbltestrates";
                    $query_my = mysqli_query($con,$query);
                    while($fetchq = mysqli_fetch_array($query_my,MYSQLI_ASSOC))
                        {
            ?>
                          <tr>
                              <td><?php echo $fetchq['Name'];?></td>
                              <td><input type="text" name="<?php echo $fetchq['tstNameId'];?>" value="<?php echo $fetchq['Rate'];?>"/></td>
                              
                          </tr>
            <?php 		} ?>
        </table> <?php }		  
if(isset($_POST['dicount_rate']))
  {
	  ?><table class="testrates">
            <tr>
                <th style="width:280px;">Test Name</th>
                <th style="width:280px;">Rate</th>
                
            </tr>
            <?php
                  $query="SELECT tbltest.tstNameId, tbltest.Name, tbltestrates.Rate from tbltest 
				  LEFT JOIN tbltestrates ON tbltest.tstNameId=tbltestrates.tstNameId
				   where tbltestrates.panelId='".$_POST['panelid']."' ORDER BY tbltest.Name ASC; ";
                    //$query="select * from tbltestrates";
                    $query_my = mysqli_query($con,$query);
                    while($fetchq = mysqli_fetch_array($query_my,MYSQLI_ASSOC))
                        {
            ?>
                          <tr>
                              <td><?php echo $fetchq['Name'];?></td>
                              <td><input type="text" name="<?php echo $fetchq['tstNameId'];?>" value="<?php echo round($fetchq['Rate']-($fetchq['Rate']*$_POST['dicount_rate']/100));?>"/></td>
                              
                          </tr>
            <?php 		} ?>
        </table> <?php }  
if(isset($_POST['veiwPanelReport']))
  {
	  ?>
      <?php $new22=mysqli_query($con,"select * from tblpaneldetails where PanelId ='".$_POST['PanelId']."'");
					  $newfetch22=mysqli_fetch_array($new22,MYSQLI_ASSOC);
				?>
      <div class="welcome">(<?php echo $newfetch22['Name'];?> )Panel Report</div>
      <div class="content">
      <div>
      Start Date<input type="text" class="datepicker" name="startdate" value="<?php echo date("Y-m-d");?>" id="panel_startdate" />
      End Date<input type="text" class="datepicker" name="enddate" id="panel_enddate"/>
      <button onclick="datePanelReport('<?php echo $_POST['PanelId']?>')">Search</button>
      </div>
      <table border="1">
	  	<tr>       	
                <th style="background:#999"><?php echo 'Patient Name';?></th>
                <th style="background:#999"><?php echo 'Employee Name';?></th>
                <th style="background:#999"><?php echo 'Relation with Employee';?></th>
                <th style="background:#999"><?php echo 'Department';?></th>
                <th style="background:#999"><?php echo 'Designation';?></th>
                <th style="background:#999; width:500px;"><?php echo 'Patient Tests';?></th>
                <th style="background:#999"><?php echo 'Test Rates';?></th>
                <th style="background:#999"><?php echo 'PatientBill';?></th>
        </tr>
	  <?php
			  $query=mysqli_query($con,"SELECT * from tblpatientreciept where PanelId='".$_POST['PanelId']."' ORDER BY testDate DESC LIMIT 0 , 30");
			$totalbill=0;
	  while($role=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	
                <?php $new=mysqli_query($con,"select * from tblpatient where PatientId ='".$role['PatientId']."'");
					  $newfetch=mysqli_fetch_array($new,MYSQLI_ASSOC);
				?>
                <td><?php echo $newfetch['Name'];?></td>
                <td><?php echo $newfetch['GuardianName'];?></td>
                <td><?php echo $newfetch['relationwithemp'];?></td>
                <td><?php echo $newfetch['departments'];?></td>
                <td><?php echo $newfetch['designations'];?></td>
                
                <td>
				<?php
                	$yui="select * from tblpatienttestdetails where patientTestsId = '".$role['PatientTestsId']."'";
					$rty=mysqli_query($con,$yui);
					while($alltests=mysqli_fetch_array($rty,MYSQLI_ASSOC))
					{
						$que= mysqli_query($con,"select tstNameId, Name from tbltest where tstNameId='".$alltests['tstNameId']."'");
                        $testna=mysqli_fetch_array($que,MYSQLI_ASSOC);
                 echo $testna['Name'].',<br>';?>
                <?php }?>
                </td>
                <td>
				<?php
                	$yui="select * from tblpatienttestdetails where patientTestsId = '".$role['PatientTestsId']."'";
					$rty=mysqli_query($con,$yui);
					while($alltests=mysqli_fetch_array($rty,MYSQLI_ASSOC))
					{
                 echo $alltests['TestRate'].'<br>';?>
                <?php }?>
                </td>
                
                <td><?php echo $role['netBill'];?></td>
            </tr>
			<?php
			$totalbill=$totalbill+$role['netBill'];
		}
		?>
       		 <tr>
            	<td><b>Total Bill</b></td>
                <td><?php echo $totalbill;?></td>
            </tr>
		</table>
        </div>
		<?php
  }
if(isset($_POST['datePanelReport']))
  {
	  ?>
      <?php $new22=mysqli_query($con,"select * from tblpaneldetails where PanelId ='".$_POST['PanelId']."'");
					  $newfetch22=mysqli_fetch_array($new22,MYSQLI_ASSOC);
				?>
      <div class="welcome">(<?php echo $newfetch22['Name'];?> )Panel Report</div>
      <div class="content">
      <div>
      Start Date<input type="text" class="datepicker" name="startdate" value="<?php echo date("Y-m-d");?>" id="panel_startdate" />
      End Date<input type="text" class="datepicker" name="enddate" id="panel_enddate"/>
      <button onclick="datePanelReport('<?php echo $_POST['PanelId']?>')">Search</button>
      </div>
      <table border="1">
	  	<tr>       	
                 <th style="background:#999"><?php echo 'Patient Name';?></th>
                <th style="background:#999"><?php echo 'Employee Name';?></th>
                <th style="background:#999"><?php echo 'Relation with Employee';?></th>
                <th style="background:#999"><?php echo 'Department';?></th>
                <th style="background:#999"><?php echo 'Designation';?></th>
                <th style="background:#999; width:500px;"><?php echo 'Patient Tests';?></th>
                <th style="background:#999"><?php echo 'Test Rates';?></th>
                <th style="background:#999"><?php echo 'PatientBill';?></th>
        </tr>
	  <?php
			 $query="SELECT * from tblpatientreciept where PanelId='".$_POST['PanelId']."' 
			  AND testDate BETWEEN '".$_POST['enddate']."' AND '".$_POST['startdate']."'
			  ORDER BY testDate DESC LIMIT 0 , 30";
			  $query2=mysqli_query($con,$query);
			  //echo $query;exit;
			$totalbill=0;
	  while($role=mysqli_fetch_array($query2,MYSQLI_ASSOC))
		{
			?>
			<tr>
            	
                <?php $new=mysqli_query($con,"select * from tblpatient where PatientId ='".$role['PatientId']."'");
					  $newfetch=mysqli_fetch_array($new,MYSQLI_ASSOC);
				?>
                <td><?php echo $newfetch['Name'];?></td>
                <td><?php echo $newfetch['GuardianName'];?></td>
                <td><?php echo $newfetch['relationwithemp'];?></td>
                <td><?php echo $newfetch['departments'];?></td>
                <td><?php echo $newfetch['designations'];?></td>
                
                <td>
				<?php
                	$yui="select * from tblpatienttestdetails where patientTestsId = '".$role['PatientTestsId']."'";
					$rty=mysqli_query($con,$yui);
					while($alltests=mysqli_fetch_array($rty,MYSQLI_ASSOC))
					{
						$que= mysqli_query($con,"select tstNameId, Name from tbltest where tstNameId='".$alltests['tstNameId']."'");
                        $testna=mysqli_fetch_array($que,MYSQLI_ASSOC);
                 echo $testna['Name'].',<br>';?>
                <?php }?>
                </td>
                <td>
				<?php
                	$yui="select * from tblpatienttestdetails where patientTestsId = '".$role['PatientTestsId']."'";
					$rty=mysqli_query($con,$yui);
					while($alltests=mysqli_fetch_array($rty,MYSQLI_ASSOC))
					{
                 echo $alltests['TestRate'].'<br>';?>
                <?php }?>
                </td>
                
                <td><?php echo $role['netBill'];?></td>
            </tr>
            
			<?php
			$totalbill=$totalbill+$role['netBill'];
		}
		?>
       		 <tr>
            	<td><b>Total Bill</b></td>
                <td><?php echo $totalbill;?></td>
            </tr>
		</table>
        </div>
		<?php
  }
if(isset($_POST['enterresults']))
  { 
	  $sa22="select 
							 tblpatientreciept.PatientId,
							 tblpatientreciept.PatientTestsId,
							 tblpatientreciept.totalBill,
							 tblpatientreciept.netBill,
							 tblpatientreciept.EmployeeId,
							 tblpatientreciept.IsCanceled,
							 tblpatientreciept.testDate,
							 tblpatientreciept.PointId,
							 tblpatientreciept.Balance,
							 tblpatientreciept.ClinicalDiagnosis,
							 tblpatientreciept.ReceiptId,
							 
							 tblpatienttestdetails.isVerified,
							 tblpatienttestdetails.tstNameId,
							 tblpatienttestdetails.pTestDetailsId,
							 tblpatienttestdetails.deliveryDate,
							 tblpatienttestdetails.deliveryTime,
							 tblpatienttestdetails.testStatus,
							 tblpatienttestdetails.SpecimenDue,
							 tblpatienttestdetails.labRefId,
							 tblpatienttestdetails.labRefText,
							 tblpatienttestdetails.ReqUrgent,
							 tblpatienttestdetails.ResultCulture,
							 tblpatienttestdetails.testStatus,
							 
							 tblpatient.Name,
							 tblpatient.Age,
							 tblpatient.Sex,
							 tblpatient.AgeType,
							 
							 tbltest.Name as testname,
							 tbltest.tstNameId
							 
							 from tblpatientreciept
							 INNER JOIN 
							 tblpatienttestdetails
							 ON tblpatientreciept.PatientTestsId = tblpatienttestdetails.patientTestsId 
							 INNER JOIN 
							 tblpatient
							 ON tblpatientreciept.PatientId = tblpatient.PatientId
							 INNER JOIN 
							 tbltest
							 ON tblpatienttestdetails.tstNameId = tbltest.tstNameId
							 where tblpatientreciept.PatientTestsId ='".$_POST['pTestDetailsId']."'";
							 //echo $sa22;
	  $new22=mysqli_query($con,$sa22);
					  $newfetch22=mysqli_fetch_array($new22,MYSQLI_ASSOC);
				?>
      <div class="welcome">Test Result Entry</div>
      <form method="post" action="<?php echo $ru;?>process/process_newrecipt.php" class="myform">
          Patient Name<input type="text" name="Patient" value="<?php echo $newfetch22['Name'];?>" style="width:100px;" />
          Reffered By<input type="text" name="referedby" value="<?php echo $newfetch22['labRefId'];?>" style="width:100px;" />
          Age<input type="text" name="age" value="<?php echo $newfetch22['Age'];?>" style="width:30px;"/>
          <input type="text" name="agetype" value="<?php echo $newfetch22['AgeType'];?>" style="width:40px;" />
          Sex<input type="text" name="sex" value="<?php echo $newfetch22['Sex'];?>" style="width:50px;" />
          <br />
          Clinical Diagnosis<input type="text" name="clinicaldiagnosis" value="<?php echo $newfetch22['ClinicalDiagnosis'];?>" style="width:100px;" />
          Reciept Number<input type="text" name="recieptid" value="<?php echo $newfetch22['ReceiptId'];?>" style="width:50px;" />
      
      </div>
      
      <table border="1">
      	<tr>
        	<th>Test Name</th>  <th>Is Varified</th>  <th>Deleivry Date</th>  <th>Delivry Time</th>
            <th>LabReft</th> <th> ResultCulture</th><th>Urgent</th>  <th>Status</th>    
        </tr>
        <tr>
        	<?php $ttt	 =	mysqli_query($con,$sa22);
				  while($slltests=	mysqli_fetch_array($ttt,MYSQLI_ASSOC))
		    {
			?>
            <tr style="background:pink;">
                <td><?php echo $slltests['testname'];?></td>  <td><input type="checkbox" <?php if($slltests['isVerified']==1){?> checked="checked"<?php }?> /></td>
                <td><?php echo $slltests['deliveryDate'];?></td><td><?php echo $slltests['deliveryTime'];?></td> <td><?php echo $slltests['labRefText'];?></td>  
                <td><?php echo $slltests['ResultCulture'];?></td>
                <td><input type="checkbox" <?php if($slltests['ReqUrgent']==0){?> checked="checked"<?php }?> /></td>  <td><?php echo $slltests['testStatus'];?></td> 
           </tr>
           <tr>
           		<td>&nbsp;</td>
                <td colspan="7">
                	<table border="1">
                    	<?php 
						$parmeter="SELECT * FROM tbltestparameters WHERE tstNameId = '".$slltests['tstNameId']."'";
						//echo $parmeter;
						$par=mysqli_query($con,$parmeter);
						$rows=mysql_num_rows($par);
						?>
                        <tr>
                        	<th colspan="2">Parameter Name</th>
                            <th>Result</th>
                            <th>Repeated</th>
                            <th>Result2</th>
                            <th>Entered By</th>
                            <th>Machine</th>
                            <th>Unit</th>
                            <th>Remarks</th>
                            <th>Optional</th>
                        </tr>
                        <?php
                        
						while($ParFetch=mysqli_fetch_array($par,MYSQLI_ASSOC))
						{ 
							if($slltests['testStatus']=='Completed')
							{
								$querycomp="select * from tbltestresults where pTestDetailsId='".$slltests['pTestDetailsId']."'  AND tstParaId='".$ParFetch['tstParaId']."'";
								$rty=mysqli_query($con,$querycomp);
								$fetchcompl=mysqli_fetch_array($rty,MYSQLI_ASSOC);
						  ?>
						<tr>
                        	<th><a href="#" onclick="togglerefrencevalues('<?php echo $ParFetch['tstParaId'];?>')"><b>+</b></a></th>
                            <th><?php echo $ParFetch['Name'];?></th>
                            <th>
                            <input type="text"  name="result[<?php echo $slltests['pTestDetailsId'];?>_<?php echo $ParFetch['tstParaId'];?>]" value="<?php echo $fetchcompl['Result'];?>"/>
                            </th>
                            <th><input type="checkbox" <?php if($fetchcompl['IsRepeated']!=0){?> checked="checked"<?php }?> name="isrepeated[<?php echo $slltests['pTestDetailsId'];?>_<?php echo $ParFetch['tstParaId'];?>]" /></th>
                            <th><input type="text" name="result2[<?php echo $slltests['pTestDetailsId'];?>_<?php echo $ParFetch['tstParaId'];?>]" value="<?php echo $fetchcompl['Result2'];?>"  style="width:50px;"/></th>
                            <th>
							<?php 
							$newq=mysqli_fetch_array(mysqli_query($con,"select * from tblemployee where EmployeeId='".$fetchcompl['resEnterBy']."'"),MYSQLI_ASSOC);
							echo $newq['login'];?>
                            </th>
                            <th><select name="machine[<?php echo $slltests['pTestDetailsId'];?>_<?php echo $ParFetch['tstParaId'];?>]" style="width:100px;">
                            	<?php $machq="select * from tblmachinedetails";
									  $quma=mysqli_query($con,$machq);
									  while($machin=mysqli_fetch_array($quma,MYSQLI_ASSOC))
									  {
								?>
                                <option value="<?php echo $machin['machineId'];?>" <?php if($machin['machineId']==$fetchcompl['machineId']){?> selected="selected"<?php }?> >
									<?php echo $machin['machineName'];?></option>
                                <?php }?>
                            </select></th>
                            <th><?php echo $ParFetch['Unit'];?></th>
                            <th><?php echo $ParFetch['Remarks'];?></th>
                            <th><input type="checkbox" <?php if($ParFetch['Optional']==1){?> checked="checked"<?php }?> /></th>
                        </tr>
                        <tr id="<?php echo $ParFetch['tstParaId'];?>" style="display:none;">
                        	<td colspan="2">
							<?php
								$refvalue="select * from tblreferencevalues where tstParaId='".$ParFetch['tstParaId']."'";
								$refvaluequ=mysqli_query($con,$refvalue);
								$refvaluefe=mysqli_fetch_array($refvaluequ,MYSQLI_ASSOC);
								
							 ?>
                             	<table border="0">
                                	<tr>
                                    	<?php
											$rerule="select * from tblreferencerule where recid='".$refvaluefe['ReferenceRuleId']."'";
											$rerulequ=mysqli_query($con,$rerule);
											$rerulefe=mysqli_fetch_array($rerulequ,MYSQLI_ASSOC);
											
										 ?>
                                        <td>Rule</td><td><?php echo $rerulefe['RuleName']; ?></td>
                                    </tr>
                                    <?php 
										if(!empty($refvaluefe['Minimum']))
										{
									?>
                                    <tr>
                                    	<td>Minimum</td><td><?php echo $refvaluefe['Minimum']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Maximum</td><td><?php echo $refvaluefe['Maximum']; ?></td>
                                    </tr>
                                    <?php
										}else{
									?>
                                    <tr>
                                    	<td>Description</td><td><input type="text" value="<?php echo $refvaluefe['Description']; ?>"></td>
                                    </tr>
                                    <?php }?>
                                </table>
                             </td>
                        </tr>
                        <input type="hidden" name="updatevalue" />
						<?php
							}
							else
							{
						?>
						<tr>
                        	<th><a href="#" onclick="togglerefrencevalues('<?php echo $ParFetch['tstParaId'];?>')"><b>+</b></a></th>
                            <th><?php echo $ParFetch['Name'];?></th>
                            <th>
                            <input type="text"  name="result[<?php echo $slltests['pTestDetailsId'];?>_<?php echo $ParFetch['tstParaId'];?>]" value="<?php echo $ParFetch['DefaultResult'];?>"/>
                            </th>
                            <th><input type="checkbox" name="isrepeated[<?php echo $slltests['pTestDetailsId'];?>_<?php echo $ParFetch['tstParaId'];?>]" /></th>
                            <th><input type="text" name="result2[<?php echo $slltests['pTestDetailsId'];?>_<?php echo $ParFetch['tstParaId'];?>]" value="<?php echo $ParFetch['DefaultResult'];?>"  style="width:50px;"/></th>
                            <th><?php echo $_SESSION['user']['username'];?></th>
                            <th><select name="machine[<?php echo $slltests['pTestDetailsId'];?>_<?php echo $ParFetch['tstParaId'];?>]" style="width:100px;">
                            	<?php $machq="select * from tblmachinedetails";
									  $quma=mysqli_query($con,$machq);
									  while($machin=mysqli_fetch_array($quma,MYSQLI_ASSOC))
									  {
								?>
                                <option value="<?php echo $machin['machineId'];?>"><?php echo $machin['machineName'];?></option>
                                <?php }?>
                            </select></th>
                            <th><?php echo $ParFetch['Unit'];?></th>
                            <th><?php echo $ParFetch['Remarks'];?></th>
                            <th><input type="checkbox" <?php if($ParFetch['Optional']==1){?> checked="checked"<?php }?> /></th>
                        </tr>
                        <tr id="<?php echo $ParFetch['tstParaId'];?>" style="display:none;">
                        	<td colspan="2">
							<?php
								$refvalue="select * from tblreferencevalues where tstParaId='".$ParFetch['tstParaId']."'";
								$refvaluequ=mysqli_query($con,$refvalue);
								$refvaluefe=mysqli_fetch_array($refvaluequ,MYSQLI_ASSOC);
								
							 ?>
                             	<table border="0">
                                	<tr>
                                    	<?php
											$rerule="select * from tblreferencerule where recid='".$refvaluefe['ReferenceRuleId']."'";
											$rerulequ=mysqli_query($con,$rerule);
											$rerulefe=mysqli_fetch_array($rerulequ,MYSQLI_ASSOC);
											
										 ?>
                                        <td>Rule</td><td><?php echo $rerulefe['RuleName']; ?></td>
                                    </tr>
                                    <?php 
										if(!empty($refvaluefe['Minimum']))
										{
									?>
                                    <tr>
                                    	<td>Minimum</td><td><?php echo $refvaluefe['Minimum']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Maximum</td><td><?php echo $refvaluefe['Maximum']; ?></td>
                                    </tr>
                                    <?php
										}else{
									?>
                                    <tr>
                                    	<td>Description</td><td><input type="text" value="<?php echo $refvaluefe['Description']; ?>"></td>
                                    </tr>
                                    <?php }?>
                                </table>
                             </td>
                        </tr>
                        <input type="hidden" name="insertvalue" />
						<?php }
						}
						?>
                    </table>
                </td>
           </tr>
           
            <?php 
			}
			?>   
        </tr>
      </table>
      <input type="hidden" name="patienttestid" value="<?php echo $newfetch22['PatientTestsId']?>" />
      <input type="hidden" name="submitresulthidden" value="<?php echo $newfetch22['PatientTestsId']?>" />
      <input type="submit" value="Submit Results" name="submitresults" />
      <input type="button" value="Print Results" name="submitresults2"  onclick="window.open('<?php echo $ru;?>resultprint/<?php echo $newfetch22['PatientTestsId'];?>','_newtab');"/>
      </form>
      <script>
	  	$('.myform').submit(function() {  
		$(this).serialize(); // check to show that all form data is being submitted
		$.post("<?php echo $ru;?>process/process_ajax.php",$(this).serialize(),function(data){
			//alert(data); //check to show that the calculation was successful                        
		});
		return false; // return false to stop the page submitting. You could have the form action set to the same PHP page so if people dont have JS on they can still use the form
		});
	  </script>
     </div>
		<?php
  }

if(isset($_POST['submitresulthidden']))
  {
	  
			if(isset($_POST['insertvalue']))
			{
			//echo '<pre>';print_r($_POST);echo '</pre>';exit;
			foreach ($_POST['result'] as $name => $value) 
			  {
				  $exp=explode('_', $name);
					  $query= "insert into `tbltestresults` SET 
											`pTestDetailsId`=$exp[0],
											`tstParaId`=$exp[1],
											`Result`='$value',
											`Result2`='$result2[$name]',
											`machineId`=$machine[$name],
											`resEnterBy`='".$_SESSION['user']['uid']."',
											`CreatedDate`=Now()
											";
					 if(isset($isrepeated[$name]))
							{
									$query.=", `IsRepeated`=1";
							}
					// echo $query;exit;
					 mysqli_query($con,$query);
			  }
			}
			if(isset($_POST['updatevalue']))
			{
			//echo '<pre>';print_r($_POST);echo '</pre>';exit;
			foreach ($_POST['result'] as $name => $value) 
			  {
				  $exp=explode('_', $name);
					  $query= "update  `tbltestresults` SET 
											`Result`='$value',
											`Result2`='$result2[$name]',
											`machineId`=$machine[$name],
											`UpdatedBy`='".$_SESSION['user']['uid']."',
											`UpdateDate`=Now()";
						if(isset($isrepeated[$name]))
							{
									$query.=", `IsRepeated`=1";
							}
									$query.=" where pTestDetailsId=$exp[0] and tstParaId=$exp[1]";
					 //echo $query;exit;
					 mysqli_query($con,$query);
			  }
			}
			$nquery="update tblpatienttestdetails set testStatus = 'Completed' where patientTestsId= $patienttestid";
			 mysqli_query($con,$nquery);
			header("location:" . $ru);
    		exit;
		 
	  echo 'sanaullah';
  }
?>