<div  id="creatrecipt" class="reveal-modal">
  <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post" onsubmit="return validateForm()">
    <h1>New Patient Reciept</h1>
        <div class="upperwrapperdiv">
            <div class="uperleft">
                <div class="uperleftinner1">
                    <input type="radio" name="panel_or_nopanel" id="panel" value="panel" onchange="eanbleselect()" />Panel
                    <input type="radio" name="panel_or_nopanel" id="panel" value="nonpanel" checked="checked" onchange="disabledselect()" />
                    Non Panel<br />
                    <input type="radio" name="panel_or_nopanel" id="panel" value="medicle" onchange="disabledselect()" />Medicle
                    <button id="p_list">P-List</button><br />
                    <select name="panel_list" id="panellist" onchange="showhidepricewithpanel()" disabled="disabled">
                        <option>--Select Panel--</option>
                        <?php
                            $query_panel_list = "SELECT * FROM tblpaneldetails";
                            $result_panel_list = mysqli_query($con,$query_panel_list);
                            while ($record_panel_list = mysqli_fetch_array($result_panel_list,MYSQLI_ASSOC)
                        )
                            {
                                ?>
                                        <option value="<?php echo $record_panel_list['PanelId']; ?>" <?php if($record_panel_list['showPrice']==1){ ?> class="block" style="color:#fff; background:green;" <?php }else{?> class="none" <?php }?>>
                                            <?php echo $record_panel_list['Name']; ?>
                                        </option>
                                <?php
                            }
                        ?>
                    </select><br />
                    Ref letter #<br />
                    <input type="text" name="refletterNo" id="refletterno" />
                </div>
              <div class="uperleftinner1">
                    <input type="radio" name="normalurgent" id="normal" value="normal" />
                  Normal &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="normalurgent" id="urgent" value="urgent" />
                    Urgent
              </div>
                <div class="uperleftinner3">
                    Refferd By<br />
                    <input type="radio" name="refferdbyradio" id="normal" value="doctor" />Doctor &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="refferdbyradio" id="normal" value="lab"/>Lab <br />
                    <input type="radio" name="refferdbyradio" id="normal" value="hospetal"/>Hospital &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="refferdbyradio" id="normal" value="mics"/>Mics
                    <br />
                    <select name="refferdby_doctor" id="refferdby" >
                        <?php
                            $query_panel_list = "SELECT * FROM tblreferreddoctor";
                            $result_panel_list = mysqli_query($con,$query_panel_list);
                            while ($record_panel_list = mysqli_fetch_array($result_panel_list,MYSQLI_ASSOC))
                            {
                                ?>
                                        <option value="<?php echo $record_panel_list['refId']; ?>">
                                            <?php echo $record_panel_list['Name']; ?>
                                        </option>
                                <?php
                            }
                        ?>
                    </select><br />
                </div>
                <div class="uperleftinner2">
                    Mode of Payment<br />
                    <input type="radio" name="m_o_p" id="normal" value="CA"  checked="checked"/>Cash &nbsp;&nbsp;&nbsp;<br />
                    <input type="radio" name="m_o_p" id="normal" value="Check"/>Check <br />
                    <input type="radio" name="m_o_p" id="normal" value="C_C"/>Credit Card &nbsp;&nbsp;&nbsp;
                    
                    <br />
                    <input type="text" id="refferdby" name="refferdby" />
                </div>
            </div>
            <div class="uperright">
                <table>
                    <tr>
                        <td>Title</td>
                        <td>Phone &nbsp;&nbsp;&nbsp;<a href="#" id="cutomer_phone_button" onclick="customerdescription('phone')">&nbsp;...&nbsp;</a></td>
                        
                        <td>Age</td>
                        <td>Gender</td>
                        <?php $que= "select current_point_no, lCode  from tblpoints where PointId='".$_SESSION['user']['point_id']."'"; 
								//echo $que;
								$err=mysqli_query($con,$que);
                                $point=mysqli_fetch_array($err,MYSQLI_ASSOC);
								$current_point_no=$point['current_point_no']+1;
								$_SESSION['current_point_no']=$current_point_no;
								?>
                        <td rowspan="2"><input id="current_point_no" name="current_point_no" value="<?php echo $current_point_no;?>" type="hidden">
                        <div id="c_p_n_h1"><h1> <?php echo $current_point_no.'/'.$point['lCode'];?> </h1><br /><?php echo date("D");echo " ".date("d-M-Y");echo " ".date("h:i:A")?></div></td>
                    </tr>
                    <tr>
                        <input type="hidden" name="previous_customer" id="previous_customer" value=""/>
                        <td>
                            <select name="title" id="title" onchange="changegender(this.value);">
                                <option value="sel" selected="selected">select</option>
								<?php $que= mysqli_query($con,"select * from tblgender"); 
                                while($gender=mysqli_fetch_array($que,MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $gender['Type'];?>"><?php echo $gender['Gender'];?></option>
                                <?php  } ?>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="phone" id="phone_number" required/>
                        </td>
                        
                        <td>
                            <input type="text" name="age" id="age" required/> 
                            <select name="agetype" id="agetype">
                              <option value="year">year</option>
                              <option value="month">Month</option>
                              <option value="day">Day</option>
                            </select>
                        </td>
                        <td><select name="gender" id="gender" disabled="disabled">
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                        <option value="3">MC</option>
                        <option value="4">FC</option>
                        </select></td>
                    </tr>
                </table>
                
                <table class="panelinfotable">
                    <tr>
                        <td>Name&nbsp;&nbsp;&nbsp;<a href="#" id="cutomerdescription" onclick="customerdescription('name')">&nbsp;...&nbsp;</a></td>
                        <td>S/O,D/O,W/O</td>
                        <td>Address / Email</td>
                        <td>NIC / Passport</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="name" id="name" required/></td>
                        <td><input type="text" name="sodowo" id="sodowo" /></td>
                        <td><input type="text" name="address" id="patient_address" /></td>
                        <td><input type="text" name="nic_passport" id="nic_passport" />
                        <input type="hidden" name="designation" id="designationtextfield" ><input type="hidden" name="designation" id="departmenttextfield" >
                        </td>
                    </tr>
                </table>
                <h5 class="test">Test</h5>
                <table class="contenttable">
                    <tr>
                        <td>TestName</td><td>Price</td><td>LabRefId</td>
                        <td>Delivery Date</td><td>Hour</td><td>Min</td><td>AM/PM</td><td>Due</td><td>Urgent</td>
                    </tr>
                    <tr>
                        <td>
                            
                            <select name="description[]" id="description21" onchange="price_auto_fill(this.value, 'description21', 'price', 'testpricehidden', 'labrefid')">
                                <?php $que= mysqli_query($con,"select tstNameId, Name from tbltest order by Name ASC");
                                 while($testna=mysqli_fetch_array($que,MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $testna['tstNameId'];?>"><?php echo $testna['Name'];?></option>
                                <?php  } ?>
                            </select>
                        </td>
                        <td><input type="text" id="price" name="testprice[]" disabled="disabled" class="price paneldisplay" required/></td>
                        
                        <input type="hidden" name="testpricehidden[]" id="testpricehidden" />
                        
                        <td><input type="text" id="labrefid" name="labrefid[]" required/></td>
                        <td><input type="text" id="delivrydate" name="delivrydate[]" value="<?php echo date("Y-m-d");?>" class="datepicker"/></td>
                        <td><select name="hours[]" id="hour">
                        		<option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                            </select>
                        </td>
                        <td><select name="minuts[]" id="minut"><option>00</option><option>30</option></select></td>
                        <td><select name="ampm[]" id="ampm"><option>AM</option><option>PM</option></select></td>
                        <td><input type="checkbox" name="due[0]" value="1"/></td>
                        <td><input type="checkbox" name="urgent[0]" value="1" class="urgentcheckbox" /></td>
                    </tr>
                </table>
                <div id="apendeddiv"></div>
                <div id="anotherdiv"><style>#anothertest{display:none;}</style></div>
                <a href="#" id="anothertest">Add Another Test</a>
                <script type="text/javascript" language="javascript">
				  var counter = 1;
				  $('#anothertest').click(function(){
					  var count1=Math.floor(Math.random()*101);
					  var count2=Math.floor(Math.random()*202);
					  var count3=Math.floor(Math.random()*303);
					  var count4=Math.floor(Math.random()*404);
					  $('#apendeddiv').append('<table class="contenttable"><tr><td><select name="description[]" id="'+count1+'" onchange="price_auto_fill(this.value, '+count1+', '+count2+', '+count3+', '+count4+')" class="description21"><?php $que= mysqli_query($con,"select tstNameId, Name from tbltest order by Name ASC");while($testna=mysqli_fetch_array($que,MYSQLI_ASSOC)) { ?><option value="<?php echo $testna["tstNameId"];?>"><?php echo $testna["Name"];?></option><?php  } ?></select></td><td width="30"><input type="text" id="'+count2+'" name="testprice[]" disabled="disabled" class="price paneldisplay"/></td><input type="hidden" name="testpricehidden[]" id="'+count3+'" /><td><input type="text" id="'+count4+'" name="labrefid[]" class="labrefclass" required /></td><td><input type="text" name="delivrydate[]" value="<?php echo date("Y-m-d");?>" class="datepicker2" id="chid'+count4+'"/></td><td><select name="hours[]" id="hour"><option>01</option><option>02</option><option>03</option><option>04</option><option>05</option><option>06</option><option>07</option><option>08</option><option>09</option><option>10</option><option>11</option><option>12</option></select></td><td><select name="minuts[]" id="minut"><option>00</option><option>30</option></select></td><td><select name="ampm[]" id="ampm"><option>AM</option><option>PM</option></select></td><td><input type="checkbox" name="due['+counter+']" value="1"/></td><td>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="urgent['+counter+']" value="1" class="urgentcheckbox" /></td></tr></table><style>');
					  counter++;
					$('.datepicker2').each(function(){
						$(this).datepicker({ dateFormat: 'yy-mm-dd'});
					});
					$("#anotherdiv").html('<style>#anothertest{display:none;}</style>');
					$(".urgentcheckbox").focus(function(event){
							$('#anothertest').trigger('click');	
					});
					});
					
				</script>
            </div>
        </div>
        
        <div class="lowerwrapperdiv">
            <div class="specimen">
                Speciman
                <div class="specimaninner">
                    
                </div>
            </div>
            <div class="out">
                <h4 class="outh4">Out</h4>
                <div style="clear:both"></div>
                <div class="outinner">
                    
                </div>
            </div>
            <div class="finaldiv">
                <table>
                    <tr id="ghjk1">
                        <td>Total Amount</td><td>Discount</td><td>Net Amount</td><td>Clinical Diagnosis</td>
                        <td>Comments</td>
                    </tr>
                    <tr>
                        <td><input type="text" id="totalamount" name="totalamount" class="paneldisplay" onKeyUp="dicountFunction()" disabled="disabled" required/></td>
                        <input type="hidden" name="totalamounthidden" id="totalamounthidden" />
                        <td><input type="text" id="discount" value="0" name="discount" class="paneldisplay" onKeyUp="dicountFunction()" required/></td>
                        <td><input id="netamount" name="netamount" class="paneldisplay" type="text" required></td>
                        <td rowspan="3"><textarea id="gentextarea" name="ClinicalDiagnosis"></textarea></td>
                        <td rowspan="3"><textarea id="gentextarea" name="remarks"></textarea></td>
                    </tr>
                    <tr id="ghjk2">
                        <td>Recieved</td><td>Balance</td><td>Discount Allowed By</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="recieved" id="recieved" class="paneldisplay" onblur="balancefinder()" required/></td>
                        <td><input type="text" name="balance" value="0" id="balance" class="paneldisplay" onblur="balancefinder()" required/></td>
                        <td><input id="discountallowedby" name="discountallowedby" type="text" class="paneldisplay" /></td>
                    </tr>
                </table>
                <button type="submit" name="savenewreciept">Save</button>
                <button type="reset">Cancel</button>
                <button disabled="disabled">Print Preview</button>
                <button disabled="disabled">Print</button>
                <button disabled="disabled">Label Print Preview</button>
                <button disabled="disabled">Label Print</button>
            </div>
            
        </div>
             <a class="close-reveal-modal" href="#">&#215;</a>
  </form>
</div>
<div id="newemployee" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    <h1>New Employee</h1>
    <table>
        <tr>
          <td width="120">Point</td>
          <td><select name="point_newemployee" id="point_newemployee" style="width:138px;" />
          <option>--SELECT--</option>
          <?php $newquery="select * from tblpoints";
                $myquery=mysqli_query($con,$newquery);
                while($myfetch = mysqli_fetch_array($myquery,MYSQLI_ASSOC))
                {
          ?>     
                    <option value="<?php echo $myfetch['PointId']?>"><?php echo $myfetch['location']?></option> 
          <?php } ?>
          </select>
          </td>
           <td width="120">Department</td>
          <td><select name="department" id="department" style="width:138px;"/>
                    <option>--SELECT--</option>
          <?php $newquery="select * from tbltestdepartments";
                $myquery=mysqli_query($con,$newquery);
                while($myfetch = mysqli_fetch_array($myquery,MYSQLI_ASSOC))
                {
          ?>     
                    <option value="<?php echo $myfetch['tstDepartId']?>"><?php echo $myfetch['Name']?></option> 
          <?php } ?>
          </select>
          </td>
        </tr>
        <tr>
        <td width="120">Login</td><td><input type="text" name="login" /></td><td>Password</td><td><input type="text" name="password" id="password" /></td>
        </tr>
        <tr>
        <td width="120">Name</td><td><input type="text" name="name"  style="width:138px;" /></td><td>Confirm Password</td><td><input type="text" name="confirm_password" id="confirm_password" /></td>
        </tr>
        <tr>
          <td width="120">Address</td><td colspan="3"><input type="text" name="address" style="width:100%;" /></td>
        </tr>
        <tr>
        <td width="120">Telephone</td><td><input type="text" name="telephone" /></td><td>Mobile</td><td><input type="text" name="mobile" id="mobile" /></td>
        </tr>
        <tr>
        <td width="120">Email</td><td><input type="text" name="email" /></td><td>Designation</td><td><input type="text" name="designation" id="designation" /></td>
        </tr>
        <tr>
        <td width="120">Date Of Birth</td><td><input type="text" name="dateofbirth"  class="datepicker"/></td><td>Date Created</td><td><input type="text" name="datecreated" id="datecreated" class="datepicker" /></td>
        </tr>
        <tr>
        <td width="120">Total Salary</td><td><input type="text" name="totalsalary" /></td><td>Advance Balance</td><td><input type="text" name="advancebalance" id="advancebalance" /></td>
        </tr>
        <tr>
            <td width="120">Current Salary</td><td><input type="text" name="currentsalery" /></td>
            <td>Last login Date</td><td><input type="text" name="lastlogindate" class="datepicker" /></td>
        </tr>
        <tr>
            <td width="120">Curentlogindate</td><td><input type="text" name="currentlogindat"  class="datepicker"/></td>
            <td>joiningdate</td><td><input type="text" name="joiningdate" class="datepicker" /></td>
        </tr>
        <tr>
            <td width="120">Qualification</td><td><input type="text" name="qualification" /></td>
            <td>Emergency Contact</td><td><input type="text" name="emergency" /></td>
        </tr>
        <tr>
        <tr>
          <td width="120">Experience</td><td><input type="text" name="experience" /></td>
          <td>Active</td><td><input type="checkbox" name="active" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes</td>
        </tr>
        
        
        <tr>
          <td width="120"><input type="checkbox" name="leavingdatecheckbox" />&nbsp;Leavingdate</td>
          <td width="120"><input type="text" name="leavingdatetextbox" class="datepicker"/></td>
          <td width="120"><input type="checkbox" name="rejoiningdatecheckbox" id="rejoiningdatecheckbox" />&nbsp;&nbsp;Rejoing Date&nbsp;</td>
          <td><input type="text" name="rejoiningdatetextbox" class="datepicker"/></td>
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
                          <td><input type="checkbox" name="rolestatus[]" value="<?php echo $fetchq['RoleId'];?>" /></td><td>&nbsp;</td></tr>
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
                            <td><input type="checkbox" name="rightstatus[]" value="<?php echo $fetchq['RightId'] ?>" /></td>
                            <td>&nbsp;</td>
                          </tr>
                <?php   }?>
            </table>
           </div>
    <div style="clear:both;"></div>

    <div><input type="submit" value="Save" name="save_newemployee"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div id="newcategory2" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    <h1>New Category</h1>
    <table>
        <tr>
        	<td>Type</td>
            <td>
            	<select name="type">
                	<?php $query=mysqli_query($con,"select * from tbltypes");
						  while($fetchqn=mysqli_fetch_array($query,MYSQLI_ASSOC))
						  	{
					?>
                    			<option value="<?php echo $fetchqn['TypeID'];?>"><?php echo $fetchqn['Type'];?></option>
                      <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Category</td>
            <td><input type="text" name="category" /></td>
        </tr>
        <tr>
            <td>Long text</td>
            <td><input type="text" name="longtext"/></td>
        </tr>
        <tr>
            <td>Parent Category</td>
            <td>
            	<select name="parentcategory">
                	<?php $query=mysqli_query($con,"select * from tblcategories");
						  while($fetchqn=mysqli_fetch_array($query,MYSQLI_ASSOC))
						  	{
					?>
                    			<option value="<?php echo $fetchqn['CategoryID'];?>"><?php echo $fetchqn['Category'];?></option>
                      <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Display Order</td>
            <td>
            	<select name="display_order">
                	<option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                </select>
            </td>
        </tr>
    </table>
    <div><input type="submit" value="Save" name="add_categories"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div id="new_shift_income" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    <h1>New Income</h1>
    <table>
        <tr>
        	<td>Point</td>
            <td>
            	<select name="point"  style="width:300px;">
                	<?php $query=mysqli_query($con,"select * from tblpoints");
						  while($fetchqn=mysqli_fetch_array($query,MYSQLI_ASSOC))
						  	{
					?>
                    			<option value="<?php echo $fetchqn['PointId'];?>" <?php if($fetchqn['PointId']==$_SESSION['user']['point_id']){?> selected="selected" <?php }?>>
								<?php echo $fetchqn['location'];?></option>
                      <?php }?>
                </select>
            </td>
        </tr>
        <tr>
        	<td>Income Types</td>
            <td>
            	<select name="icometype" style="width:300px;">
                	<?php $query=mysqli_query($con,"select * from tblincometypes");
						  while($fetchqn=mysqli_fetch_array($query,MYSQLI_ASSOC))
						  	{
					?>
                    			<option value="<?php echo $fetchqn['IncomeId'];?>"><?php echo $fetchqn['IncomeType'];?></option>
                      <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Amount Received</td>
            <td><input type="text" name="amountRecieved" style="width:300px;"></td><td><input type="checkbox" />Hand over Amount</td>
        </tr>
        <tr>
            <td>To User</td>
            <td><input type="text" name="user" value="<?php echo $_SESSION['user']['username'];?>" style="width:300px;" ></td>
            <input type="hidden" name="userid" value="<?php echo $_SESSION['user']['uid'];?>" >
        </tr>
        <tr>
            <td>Shift Date</td>
            <td><input type="text" name="shiftdate" class="datepicker" value="<?php echo date("Y-m-d");?>" style="width:300px;" /></td>
        </tr>
        <tr>
            <td>Remarks</td>
            <td>
            	<textarea name="remarks"  style="width:300px;"></textarea>
            </td>
        </tr>
    </table>
    <div><input type="submit" value="Save" name="add_shift_income"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div id="testdepartment" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    <h1>New Test Department</h1>
    <table>
        <tr>
        	<td>Department Code</td>
            <td colspan="2">
            	<input type="text" style="width:100%" name="departmentcode"/>
            </td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Department Name</td>
            <td colspan="3">
            	<input type="text" style="width:100%" name="departmentname" />
            </td>
        </tr>
        
        <tr>
            <td>Is Active</td>
            <td><input type="checkbox" name="Active" value="1"/>&nbsp;Yes</td>
            <td><input type="checkbox" name="samenoinrecipt" value="1"/></td>
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
				  <option value="<?php echo $routinumber['routine_id'];?>"  >
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
            	<textarea name="remarks"></textarea>
            </td>
        </tr>
    </table>
    <div><input type="submit" value="Save" name="testdepartment"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div  id="newtest" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<div style="float:left; width:500px">
        	<h1>Add New Test</h1>
            <table>
            	<tr>
                	<td>Test Name</td><td><input type="text" /></td><td>Test Type</td>
                    <td>
                    <select name="testtype">
                        <?php $ssquery="select * from reporttype";
							  $don=mysqli_query($con,$ssquery);
							  while($donfetch=mysqli_fetch_array($don,MYSQLI_ASSOC))
							  	{
						?>
								<option value="<?php echo $donfetch['id'];?>" >
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
                	<td>Test Code</td><td><input type="text" name="testcode" /></td>
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
									<option value="<?php echo $donfetch['tstDepartId'];?>"><?php echo $donfetch['Name'];?></option>
						<?php	
								}
						?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td>Test Header</td><td><input type="text" name="testheader"/></td>
                </tr>
                <tr>
                	<td>Chemical used</td><td><input type="text" name="chemicalused"/></td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Perform Time</td><td><input type="text" name="performtime" class="datepicker"/> </td>
                    <td>Heading 1</td><td><input type="text" name="heading1" /></td>
                </tr>
                <tr>
                     <td>Is Active</td><td><input type="checkbox" name="isactive" />&nbsp;Yes</td>
                     <td>Heading 2</td><td><input type="text"  name="heading2"/></td>
                </tr>
                
                <tr>
                	 <td>Text Only</td><td><input type="checkbox" name="textonly" />&nbsp;Yes</td>
                </tr>
                <tr>
                     <td>Test Not Required</td><td><input type="checkbox" name="testnotrequired" />&nbsp;Yes</td>
                     <td>Heading 3</td><td><input type="text"  name="heading3" /></td>
                </tr>
                
                <tr>
                	<td>Remarks</td><td colspan="3"><input type="text" style="width:100%;" name="remarks"/></td>
                </tr>
            </table>
        </div>
        <div style="width:150px; float:left;">
        	Specific Bottle
            <div style="background:#fff; overflow:auto; width:150px; height:100px;">
            	<?php $ssquery="select * from tblspecimenbottles";
							  $don=mysqli_query($con,$ssquery);
							  while($donfetch=mysqli_fetch_array($don,MYSQLI_ASSOC))
							  	{
						?>
                                    <input type="checkbox" name="bottles[]" value="<?php echo $donfetch['ContainerId']?>"/> 
                                    &nbsp;<?php echo $donfetch['ContainerName']?><br />
						<?php	
								}
						?>
            </div>
            Speciman
            <div style="background:#fff; overflow:auto; width:150px; height:100px;">
                 <?php $ssquery="select * from tblspecimens";
							  $don=mysqli_query($con,$ssquery);
							  while($donfetch=mysqli_fetch_array($don,MYSQLI_ASSOC))
							  	{
						?>
                                      <input type="checkbox" name="speciman[]" value="<?php echo $donfetch['SpecimenId']?>"/> 
                                      &nbsp;<?php echo $donfetch['SpecimenName']?><br />
						<?php	
								}
						?>
            </div>
            <div style="overflow:hidden; width:150px; height:100px;">
            	<table>
                	<tr>
                    	<td>Show Machine</td><td><input type="checkbox" name="showmachine" />&nbsp;Yes</td>
                    </tr>
                    <tr>
                    	<td>Show Graph</td><td><input type="checkbox" name="showgraph" />&nbsp;Yes</td>
                    </tr>
                    <tr>
                    	<td colspan="2">Create Date<input type="text" style="width:75px;" class="datepicker" name="creatdate"/></td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="apendprardiv" style="clear:both;">
       		 <p style="text-align:center;">Parameter List</p>
             <table border="1">
                    	
                    </table>
        </div>
        <a href="#" id="anotherparameter">Add Parameter</a>
        <br />
                <script type="text/javascript" language="javascript">
				  $('#anotherparameter').click(function(){
					  $('.apendprardiv').append('<table border="1"><tr><th colspan="2"> Name</th><th>Heading</th><th>SequenceN</th><th>Unit</th><th>IsCalculate</th><th>option</th><th width="100">DefaultResult</th><th>Remark</th></tr><tr><td><a href="#"><b>+</b></a></td><td><input type="text"  class=""></td><td><input type="text"  class="parainput"></td><td><input type="text"  class="parainput"></td><td><input type="input"  class="parainput"></td><td><input type="checkbox"  class="parainput"></td><td><input type="checkbox"  class="parainput"></td><td><input type="text"  class="parainput"></td><td><input type="text"  class="parainput"></td></tr></table>');
					});
					
				</script>
        <div><input type="submit" value="Save" name="addnewtest"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div  id="newspecimen" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>New Speciman</h1>
        <table>
        	<tr>
            	<td>Speciman Code</td><td><input type="text" name="specimancode" /></td>
            </tr>
            <tr>
            	<td>Speciman Name</td><td><input type="text" name="specimanname" /></td>
            </tr>
            <tr>
            	<td rowspan="2">Remarks</td><td rowspan="2"><textarea name="ramarks"></textarea></td>
            </tr>
        </table>
        <div><input type="submit" value="Save" name="addspeciman"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div  id="neworganism" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>New Organism</h1>
        <table>
        	<tr>
            	<td>Name</td><td><input type="text" name="name" /></td>
            </tr>
            
            <tr>
            	<td rowspan="2">Remarks</td><td rowspan="2"><textarea name="ramarks"></textarea></td>
            </tr>
        </table>
        <div><input type="submit" value="Save" name="neworganism"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div  id="newantibiotec" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>New Antibiotec</h1>
        <table>
        	<tr>
            	<td>Name</td><td><input type="text" name="name" /></td>
            </tr>
            <tr>
            	<td>Code</td><td><input type="text" name="code" /></td>
            </tr>
            <tr>
            	<td rowspan="2">Remarks</td><td rowspan="2"><textarea name="ramarks"></textarea></td>
            </tr>
        </table>
        <div><input type="submit" value="Save" name="addantibiotec"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div  id="newtestnote" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>New Test Note</h1>
        <table>
        	<tr>
            	<td>Name</td><td><input type="text" name="name" /></td>
            </tr>
            <tr>
            	<td>Heading</td><td><input type="text" name="heading" /></td>
            </tr>
            <tr>
            	<td rowspan="2">Note</td><td rowspan="2"><textarea name="note"></textarea></td>
            </tr>
        </table>
        <div><input type="submit" value="Save" name="addtestnote"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div  id="newmachine" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>New Machine</h1>
        <table>
        	<tr>
            	<td>Point</td>
                <td>
                <select name="point">
                	<?php $query=mysqli_query($con,"select * from tblpoints");
						  while($fetchqn=mysqli_fetch_array($query,MYSQLI_ASSOC))
						  	{
					?>
                    			<option value="<?php echo $fetchqn['PointId'];?>"><?php echo $fetchqn['location'];?></option>
                      <?php }?>
                </select>
                </td>
            </tr>
            <tr>
            	<td>Name</td><td><input type="text" name="name" /></td>
            </tr>
            <tr>
            	<td>Method</td><td><input type="text" name="method" /></td>
            </tr>
            <tr>
            	<td>Company</td><td><input type="text" name="company" /></td>
            </tr>
            <tr>
            	<td rowspan="2">Remarks</td><td rowspan="2"><textarea name="remarks"></textarea></td>
            </tr>
        </table>
        <div><input type="submit" value="Save" name="addmachine"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div  id="refferedby" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>Referd By</h1>
        <table>
        	<tr>
            	<td>Point</td>
                <td>
                <select name="point">
                	<?php $query=mysqli_query($con,"select * from tblpoints");
						  while($fetchqn=mysqli_fetch_array($query,MYSQLI_ASSOC))
						  	{
					?>
                    			<option value="<?php echo $fetchqn['PointId'];?>"><?php echo $fetchqn['location'];?></option>
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
                    			<option value="<?php echo $fetchqn['refType'];?>"><?php echo $fetchqn['RefferdBy'];?></option>
                      <?php }?>
                </select>
                </td>
            </tr>
            <tr>
            	<td>Name</td><td><input type="text" name="name" /></td>
                <td>Clinic Name</td><td><input type="text" name="clinicname" /></td>
            </tr>
            <tr>
            	<td>Home Address</td><td><input type="text" name="homeaddress" /></td>
                <td>Home Phone</td><td><input type="text" name="homephone" /></td>
            </tr>
            <tr>
            	<td>Mobile</td><td><input type="text" name="mobile" /></td>
                <td>Fax</td><td><input type="text" name="fax" /></td>
            </tr>
            <tr>
            	<td>Email</td><td><input type="text" name="email" /></td>
                <td>Clinic Address</td><td><input type="text" name="clinicaddress" /></td>
            </tr>
            <tr>
            	<td>Clinic Phone</td><td><input type="text" name="clinicphone" /></td>
                <td>Discount</td><td><input type="text" name="discount" /></td>
            </tr>
            <tr>
            	<td>Commision</td><td><input type="text" name="commision" /></td>
                <td>Date</td><td><input type="text" name="date" class="datepicker" /></td>
            </tr>
            <tr>
            	<td>Is Active</td><td><input type="checkbox" name="isactive" /></td>
                
            </tr>
            <tr>
            	<td>Remarks</td><td colspan="3" rowspan="2"><textarea name="remarks"></textarea></td>
            </tr>
        </table>
        <div><input type="submit" value="Save" name="newrefferedby"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div  id="newpoint" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>New Point</h1>
        <table>
        	<tr>
            	<td>Location</td>
                <td>
                <input type="text" name="location" />
                </td>
                <td>Location Code</td>
                <td>
                <input type="text" name="locationcode" />
                </td>
            </tr>
            <tr>
            	<td>Address</td><td colspan="3"><input type="text" name="address" style="width:100%;" /></td>
            </tr>
            <tr>
            	<td>Phone</td><td><input type="text" name="phone" /></td>
                <td>Fax</td><td><input type="text" name="fax" /></td>
            </tr>
            <tr>
            	<td>Email</td><td><input type="text" name="email"></td>
                <td>Date Created</td><td><input type="text" name="datecreated" /></td>
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
				  <option value="<?php echo $routinumber['routine_id'];?>"  >
				  <?php echo $routinumber['routine_name'];?>
				  </option>
				  <?php
							}
				  ?>
                    </select>
                </td>
            </tr>
            <tr>
            	<td>Is Active</td><td><input type="checkbox" name="isactive" /></td>
            </tr>
            <tr>
            	<td>Remarks</td><td colspan="3" rowspan="3"><textarea name="remarks" cols="50" rows="10"></textarea></td>
            </tr>
           
        </table>
        <div><input type="submit" value="Save" name="addpoint"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div  id="newrole" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>New Role</h1>
        <table>
        	<tr>
            	<td>Roles</td><td colspan="3"><input type="text" name="rol_es" style="width:340px;" /></td>
            </tr>
            
            <tr>
            	<td rowspan="2">Remarks</td><td rowspan="2" colspan="3"><textarea name="role_remarks" style="width:100%; height:100px;"></textarea></td>
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
                            <td><input type="checkbox" name="right_status[]" value="<?php echo $fetchqn['RightId'];?>" /></td>
                            <td><input type="text" name="dateassgigd_<?php echo $fetchqn['RightId'];?>" class="datepicker" /></td>
                            <td><input type="text" name="rightremarks_<?php echo $fetchqn['RightId'];?>" /></td>
                        </tr>
                <?php }?>
          </table>
        </div>
        <div><input type="submit" value="Save" name="addnewrole"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div  id="newbottle" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>New Bottle</h1>
        <table>
        	<tr>
            	<td>Name</td><td colspan="3"><input type="text" name="name" style="width:340px;" /></td>
            </tr>
            
            <tr>
            	<td rowspan="2">Remarks</td><td rowspan="2" colspan="3"><textarea name="remarks" style="width:100%; height:100px;"></textarea></td>
            </tr>
        </table>
        <div><input type="submit" value="Save" name="addnewbottle"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div  id="new_ab_category" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>New AddressBook Category</h1>
        <table>
        	<tr>
            	<td>Category</td><td colspan="3"><input type="text" name="category" style="width:340px;" /></td>
            </tr>
            
            <tr>
            	<td rowspan="2">Remarks</td><td rowspan="2" colspan="3"><textarea name="remarks" style="width:100%; height:100px;"></textarea></td>
            </tr>
        </table>
        <div><input type="submit" value="Save" name="addnew_ab_catergoy"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div  id="addnewitem" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>New Bottle</h1>
        <table>
        	<tr>
            	<td>Name</td><td colspan="2"><input type="text" name="name" style="width:340px;" /></td>
            </tr>
            <tr>
            	<td>Category No.</td><td colspan="2"><input type="text" name="category_no" style="width:340px;" /></td>
            </tr>
            <tr>
            	<td>Pake Size</td><td colspan="2"><input type="text" name="Pak_size" style="width:340px;" /></td>
            </tr>
            <tr>
            	<td>Supplier</td><td colspan="2">
                <select name="supplier" id="supplier" style="width:340px;"/>
                      <?php $newquery="select * from tblsuppliers";
                            $myquery=mysqli_query($con,$newquery);
                            while($myfetch = mysqli_fetch_array($myquery,MYSQLI_ASSOC))
                            {
                      ?>     
                                <option value="<?php echo $myfetch['suplierId']?>"><?php echo $myfetch['Name']?></option> 
                      <?php } ?>
                </select>
            </tr>
            <tr>
            	<td>Manufacturer</td><td colspan="2">
                	<select name="manufacturer" id="manufacturer" style="width:340px;"/>
                      <?php $newquery="select * from tblcompany";
                            $myquery=mysqli_query($con,$newquery);
                            while($myfetch = mysqli_fetch_array($myquery,MYSQLI_ASSOC))
                            {
                      ?>     
                                <option value="<?php echo $myfetch['CompanyId']?>"><?php echo $myfetch['Name']?></option> 
                      <?php } ?>
                      </select>
                </td>
            </tr>
            <tr>
            	<td>Prev Price</td><td colspan="2"><input type="text" name="prev_price" style="width:340px;" /></td>
            </tr>
            <tr>
            	<td>Current Price</td><td colspan="2"><input type="text" name="current_price" style="width:340px;" /></td>
            </tr>
            <tr>
            	<td>Border Line</td><td><input type="text" name="border_line" style="width:340px;" /></td>
            </tr>
            
            <tr>
            	<td rowspan="2">Remarks</td><td rowspan="2" colspan="3"><textarea name="remarks" style="width:100%; height:100px;"></textarea></td>
            </tr>
        </table>
        <div><input type="submit" value="Save" name="addnewitem"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div  id="newsupplier" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>New Suppleir</h1>
        <table>
        	<tr>
            	<td>Name</td><td><input type="text" name="name" style="width:140px;" /></td>
                <td>Address</td><td><input type="text" name="address" style="width:140px;" /></td>
            </tr>
            <tr>
            	<td>Fax</td><td><input type="text" name="fax" style="width:140px;" /></td>
                <td>Phone</td><td><input type="text" name="phone" style="width:140px;" /></td>
            </tr>
            <tr>
            	<td>Email</td><td><input type="text" name="email" style="width:140px;" /></td>
                <td>Is Active</td><td><input type="checkbox" name="isactive" /></td>
            </tr>
            <tr>
            	<td colspan="2">
                	<table border="1" style="background:#fff;">
                    	<tr>
                        	<td colspan="2" style="text-align:center;">Contact Person</td>
                        </tr>
                        <tr>
                        	<td>Name</td><td>Mobile</td>
                        </tr>
                        <tr>
                        	<td><input name="contactpersonname" type="text" /></td><td><input name="contactpersonmobile" type="text" /></td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                	<table border="1" style="background:#fff;">
                    	<tr>
                        	<td colspan="2"  style="text-align:center;">Companies in which deal</td>
                        </tr>
                        <tr>
                        	<td>Name</td><td>Mobile</td>
                        </tr>
                        <tr>
                        	<td><input name="contactcompanyname" type="text" /></td><td><input name="contactcompanymobile" type="text"/></td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr>
            	<td>Remarks</td><td colspan="3"><textarea name="remarks" style="width:100%; height:100px;"></textarea></td>
            </tr>
        </table>
        <div><input type="submit" value="Save" name="addnewsupplier"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div  id="newcompany" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>New Company</h1>
        <table>
        	<tr>
            	<td>Name</td><td><input type="text" name="name" style="width:140px;" /></td>
                <td>Address</td><td><input type="text" name="address" style="width:140px;" /></td>
            </tr>
            <tr>
            	<td>Fax</td><td><input type="text" name="fax" style="width:140px;" /></td>
                <td>Phone</td><td><input type="text" name="phone" style="width:140px;" /></td>
            </tr>
            <tr>
            	<td>Email</td><td><input type="text" name="email" style="width:140px;" /></td>
                <td>Is Active</td><td><input type="checkbox" name="isactive" /></td>
            </tr>
            <tr>
            	<td colspan="2">
                	<table border="1" style="background:#fff;">
                    	<tr>
                        	<td colspan="2" style="text-align:center;">Person</td>
                        </tr>
                        <tr>
                        	<td>Name</td><td>Mobile</td>
                        </tr>
                        <tr>
                        	<td><input name="personname" type="text" /></td><td><input name="personmobile" type="text" /></td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                	<table border="1" style="background:#fff;">
                    	<tr>
                        	<td colspan="2"  style="text-align:center;">Engineer</td>
                        </tr>
                        <tr>
                        	<td>Name</td><td>Mobile</td>
                        </tr>
                        <tr>
                        	<td><input name="engineername" type="text" /></td><td><input name="engineermobile" type="text"/></td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr>
            	<td>Remarks</td><td colspan="3"><textarea name="remarks" style="width:100%; height:100px;"></textarea></td>
            </tr>
        </table>
        <div><input type="submit" value="Save" name="addnewcompany"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div id="paneldiv" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    <h1>New Panel</h1>
    <table>
        <tr>
          <td width="140">Point</td>
          <td><select name="point" />
          <option>--SELECT--</option>
          <?php $newquery="select * from tblpoints";
                $myquery=mysqli_query($con,$newquery);
                while($myfetch = mysqli_fetch_array($myquery,MYSQLI_ASSOC))
                {
          ?>     
                    <option value="<?php echo $myfetch['PointId']?>"><?php echo $myfetch['location']?></option> 
          <?php } ?>
          </select>
          </td>
          <td>Panel Code</td><td><input type="text" name="panelcode" /></td>
        </tr>
        <tr>
          <td width="120">Panel Name</td><td colspan="3"><input type="text" name="panelname" style="width:100%;" /></td>
        </tr>
        <tr>
          <td width="120">Address</td><td colspan="3"><input type="text" name="address" style="width:100%;" /></td>
        </tr>
        <tr>
          <td width="120">Phone</td><td><input type="text" name="phone" /></td><td>Mobile</td><td><input type="text" name="mobile" /></td>
        </tr>
        <tr>
          <td width="120">Fax</td><td><input type="text" name="fax" /></td><td>EMail</td><td><input type="email" name="eamil" /></td>
        </tr>
        <tr>
          <td width="120">Create Date</td><td><input type="text" name="createdate" /></td><td>Contact Person</td><td><input type="text" name="Contact_person" /></td>
        </tr>
       
        <tr>
          <td width="120">Is Active</td><td><input type="checkbox" name="isactive" />&nbsp;Yes</td><td>Show Price</td><td><input type="checkbox" name="showprice" />&nbsp;Yes</td>
        </tr>
        <tr>
          <td width="120">Remarks</td><td colspan="3"><input type="text" name="remarks" style="width:100%;" /></td>
        </tr>
        <tr>
          <td width="120">% Discount</td><td><input type="text" name="dicount_rate" id="dicount_rate" />%</td>
          <td>
          <select name="discount_city_rate" id="discount_city_rate" onchange="discountrates(this.value)" />
                <option value="0">--Select--</option>
                <option value="5">--Rawalpind Rates--</option>
                <option value="102">--Islamabd Rates--</option>
          </select>
          </td>
         
        </tr>
        <tr>
          <td width="120">Copy Rates From</td><td colspan="2">
          <select name="copyratefrom" style="width:100%;" onchange="copyratesfrom(this.value)" />
          <option>--SELECT--</option>
          <?php $newquery="select * from tblpaneldetails";
                $myquery=mysqli_query($con,$newquery);
                while($myfetch = mysqli_fetch_array($myquery,MYSQLI_ASSOC))
                {
          ?>     
                    <option value="<?php echo $myfetch['PanelId']?>"><?php echo $myfetch['Name']?></option> 
          <?php } ?>
          </select>
          </td>
        </tr>
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
                  $query="SELECT tstNameId,Name from tbltest; ";
                    //$query="select * from tbltestrates";
                    $query_my = mysqli_query($con,$query);
                    while($fetchq = mysqli_fetch_array($query_my,MYSQLI_ASSOC))
                        {
            ?>
                          <tr>
                              <td><?php echo $fetchq['Name'];?></td>
                              <td><input type="text" name="<?php echo $fetchq['tstNameId'];?>" /></td>
                              
                          </tr>
            <?php 		} ?>
        </table>
    </div>
    <div><input type="submit" value="Save" name="savepanel"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div id="updatepanel" class="reveal-modal">
  <!--Ajax here-->
  <div class="updatepanel_inner"></div>
  <a class="close-reveal-modal">&#215;</a>
</div>
<div id="updateDepartment" class="reveal-modal">
<!--Ajax here-->
</div>
<div id="updatetest" class="reveal-modal">
<!--Ajax here-->
<div class="updatetestinnder"></div>
 <a class="close-reveal-modal">&#215;</a>
</div>
<div id="updateeverytable" class="reveal-modal">
  <div class="newdiv">
  	<div class="updateeverytableinner"><!--Ajax here--></div>
  </div>
 <a class="close-reveal-modal">&#215;</a>
</div>
<div id="updatetestnote" class="reveal-modal">
<!--Ajax here-->
<div class="updatetestnoteinner"></div>
 <a class="close-reveal-modal">&#215;</a>
</div>

<div  id="newContact" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    	<h1>New Contact</h1>
        <table>
        	<tr>
            	<td>Name</td>
                <td>
                <input type="text" name="Name" />
                </td>
                <td>&nbsp;</td>
                <td>
                <select name="CategoryId">
                	<?php $query=mysqli_query($con,"select * from tblabcategory");
						  while($fetchqn=mysqli_fetch_array($query,MYSQLI_ASSOC))
						  	{
					?>
                    			<option value="<?php echo $fetchqn['CategoryId'];?>"><?php echo $fetchqn['CName'];?></option>
                      <?php }?>
                </select>
                </td>
            </tr>
            <tr><td colspan="4"><h3>Work Details</h3></td></tr>
            <tr>
            	<td>Job Title</td><td colspan="3"><input type="text" name="JobTitle" style="width:100%;" /></td>
            </tr>
            <tr>
            	<td>Department</td><td colspan="3"><input type="text" name="Department" style="width:100%;" /></td>
            </tr>
            <tr>
            	<td>Company</td><td colspan="3"><input type="text" name="Company" style="width:100%;" /></td>
            </tr>
            <tr>
            	<td>Address</td><td colspan="3"><input type="text" name="CAddress" style="width:100%;" /></td>
            </tr>
            <tr>
            	<td>Telephone</td><td><input type="text" name="CTelNo" /></td>
                <td>Fax</td><td><input type="text" name="CFax" /></td>
            </tr>
            <tr>
            	<td rowspan="3">Business Deatils</td><td colspan="3" rowspan="3"><textarea name="BusinessDetails" style="width:100%;" ></textarea></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td colspan="4"><h3>Personal Details</h3></td></tr>
            <tr>
            	<td>Address</td><td colspan="3"><input type="text" name="HAddress" style="width:100%;" /></td>
            </tr>
            <tr>
            	<td>Mailing Address</td><td colspan="3"><input type="text" name="MailingAddress" style="width:100%;" /></td>
            </tr>
            <tr>
            	<td>Telephone</td><td><input type="text" name="HTelNo" /></td>
                <td>Mobile</td><td><input type="text" name="Mobile" /></td>
            </tr>
            <tr>
            	<td>Email</td><td><input type="text" name="Email" /></td>
                <td>Website</td><td><input type="text" name="WebSite" /></td>
            </tr>
             <tr>
            	<td rowspan="3">Remarks</td><td colspan="3" rowspan="3"><textarea name="Remarks" style="width:100%;" ></textarea></td>
            </tr>
        </table>
        <div><input type="submit" value="Save" name="new_contact"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <div style="clear:both;"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<div id="updatespeciman" class="reveal-modal">
<!--Ajax here-->
<div class="updatespecimaninner"></div>
 <a class="close-reveal-modal">&#215;</a>
</div>
<div id="updateantibiotec" class="reveal-modal">
<!--Ajax here-->
<div class="updateantibiotecinner"></div>
 <a class="close-reveal-modal">&#215;</a>
</div>
<div id="updatepoint" class="reveal-modal">
<!--Ajax here-->
</div>
<div  id="creatrecipt_fill" class="reveal-modal">
     <div class="creatreciep_fill_inner"></div>
     <a class="close-reveal-modal">&#215;</a>
</div>
<div  id="employee_fill" class="reveal-modal">
     <div class="employee_fill_inner"></div>
     <a class="close-reveal-modal">&#215;</a>
</div>
<div class="searchpatient"></div>
<div id="loadingDiv">
  Content is Loading<br />
  Please Wait!
</div>
<div class="paneldisplaystyle"></div>
<div  id="patientdue" class="reveal-modal">
  <div class="patientdueinner"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
<div  id="enterresultsdiv" class="reveal-modal">
  <div class="enterresultsinner"></div>
    <a class="close-reveal-modal">&#215;</a>
  </div>
<div id="changepassword" class="reveal-modal">
  <div class="newdiv">
    <form action="<?php echo $ru;?>process/process_newrecipt.php" method="post">
    <h1>Change Password</h1>
    <table>
        
        <tr>
            <td>Username</td>
            <td><input type="text" name="username" /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="Password"/></td>
        </tr>
        <tr>
            <td>New Password</td>
            <td><input type="password" name="newpassword"/></td>
        </tr>
        <tr>
            <td>Confirm Password</td>
            <td><input type="password" name="confirmpassword"/></td>
        </tr>
    </table>
    <div><input type="submit" value="Ok" name="change_password"/>&nbsp;<input type="reset" value="Cancel" /></div>
    </form>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
