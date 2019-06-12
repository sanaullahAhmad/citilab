<?php
session_start();
require('../config/config.php');
require('../connection/connection.php');


foreach ($_POST as $k => $v) {
    $$k = $v;
}

if(isset($_POST['change_password']))
		{
	$sql="update tblemployee set password = '$newpassword' where EmployeeId= '".$_SESSION['user']['uid']."'";
	//echo $sql; exit;
	$sql2=mysqli_query($con,$sql);
	header("Location:".$ru); }
if(isset($_POST['savenewreciept']))
		{
			//echo $_POST['refferdby_doctor'] ;exit;
			if(empty($_POST['previous_customer']))
			{
				$query= "insert into `tblpatient` SET 
											  `Name`='$name',
											  `PointId`='1',
											  `GuardianName`='$sodowo',
											  `Age`='$age',
											  `PhoneNo`='$phone',
											  `AgeType`='$agetype',
											  `Title`='$title'";
				if($_POST['panel_or_nopanel']=='panel')
				{
					$query.=",`PanelId`='$panel_list'";
				}
				if(isset($_POST['address']))
				{
					$query.=",`Address`='$address'";
				}
				if(isset($_POST['nic_passport']))
				{
					$query.=",`NIC`='$nic_passport'";
				}
				if(isset($_POST['department']))
				{
					$query.=",`departments`='$department'";
				}
				if(isset($_POST['designation']))
				{
					$query.=",`designations`='$designation'";
				}
				if(isset($_POST['relationwithemp']))
				{
					$query.=",`relationwithemp`='$relationwithemp'";
				}
				if($_POST['title']=='1')
				{
					$query.=",`Sex`='Male'";
				}
				else if($_POST['title']=='2')
				{
					$query.=",`Sex`='Female'";
				}
				else if($_POST['title']=='3')
				{
					$query.=",`Sex`='MC'";
				}
				else if($_POST['title']=='4')
				{
					$query.=",`Sex`='FC'";
				}
				//echo $query;exit;
				mysqli_query($con,$query);
				$insertid=mysql_insert_id();
			}
			else
			{
				$query= "update `tblpatient` SET 
											  `Name`='$name',
											  `PointId`='1',
											  `GuardianName`='$sodowo',
											  `Age`='$age',
											  `PhoneNo`='$phone',
											  `AgeType`='$agetype',
											  `Title`='$title'";
				if($_POST['panel_or_nopanel']=='panel')
				{
					$query.=",`PanelId`='$panel_list'";
				}
				if(isset($_POST['address']))
				{
					$query.=",`Address`='$address'";
				}
				if(isset($_POST['nic_passport']))
				{
					$query.=",`NIC`='$nic_passport'";
				}
				if(isset($_POST['department']))
				{
					$query.=",`departments`='$department'";
				}
				if(isset($_POST['designation']))
				{
					$query.=",`designations`='$designation'";
				}
				if(isset($_POST['relationwithemp']))
				{
					$query.=",`relationwithemp`='$relationwithemp'";
				}
				if($_POST['title']=='1')
				{
					$query.=",`Sex`='Male'";
				}
				else if($_POST['title']=='2')
				{
					$query.=",`Sex`='Female'";
				}
				else if($_POST['title']=='3')
				{
					$query.=",`Sex`='MC'";
				}
				else if($_POST['title']=='4')
				{
					$query.=",`Sex`='FC'";
				}
				$query.=" where PatientId='".$_POST['previous_customer']."'";
				//echo $query;exit;
				mysqli_query($con,$query);
				$insertid=$_POST['previous_customer'];
			}
			$uid = $_SESSION['user']['uid'];
			$query_test= "insert into `tblpatientreciept` SET 
										  `PatientId`=$insertid,
										  `PointId`='".$_SESSION['user']['point_id']."',
										  `EmployeeId`='$uid',
										  `ReceiptId`='$current_point_no',
										  `testDate`=Now(),
										  `totalBill`=$totalamounthidden,
										  `Discount`='$discount',
										  `netBill`='$netamount',
										  `Received`='$recieved',
										  `RefId`='$refferdby_doctor',
										  `Balance`='$balance',
										  `discountBy`='$discountallowedby',
										  
										  `ModeofPayment`='$m_o_p',
										  `Remarks`='$remarks',
										  `ClinicalDiagnosis`='$ClinicalDiagnosis',
										   
										  
										  `atotalbill`=$totalamounthidden,
										  `adiscount`=$discount,
										  `anetbill`=$netamount,
										  `areceived`=$recieved,
										  `abalance`=$balance";
										  /*`verifiedBy`=[value-16],
										  `verifyDate`=[value-17],
										  `ReceiptFullId`=[value-18],*/
			if($_POST['panel_or_nopanel']=='panel')
			{
				$query_test.=",`PanelId`='$panel_list'";
			}
			if(isset($_POST['department']))
				{
					$query_test.=",`PanelReffDepartment`='$department'";
				}
			if(isset($_POST['designation']))
				{
					$query_test.=",`PanelReffDesignation`='$designation'";
				}
			if(isset($_POST['refletterNo']))
				{
					$query_test.=",`refletterNo`='$refletterNo'";
				}
			
			
			if($_POST['normalurgent']=="urgent")
			{
				$query_test.=",`Priority`=1";
			}
			//echo $query_test;exit;
			mysqli_query($con,$query_test);
			$patientRecipId=mysql_insert_id();
			$count=0;
			foreach($_POST['description'] as $des)
				{
					$newref=explode('-',$labrefid[$count]);
					if($ampm[$count]=='PM')
					{
						$hours[$count]=$hours[$count]+12;
					}
					$query3="INSERT INTO `tblpatienttestdetails` SET
																	  `patientTestsId`=$patientRecipId,
																	  `tstNameId`=$description[$count],
																	  `TestRate`='$testpricehidden[$count]',
																	  `deliveryDate`='$delivrydate[$count]',
																	  `deliveryTime`='$hours[$count]:$minuts[$count]:00',
																	  `labRefText`='$labrefid[$count]',
																	  `labRefId`='$newref[1]',
																	  
																	  `testStatus`='In Process',
																	  `ReportPrinted`=0,
																	  `NoteId`=0,
																	  `Remarks`='$remarks',
																	  `SpecimenUpdate`='',
																	  `IsReportReceived`='1',
																	  `ReceivedDate`='',
																	  `ReceivedEmpId`='',
																	  `IsReportDelivered`='',
																	  `DeliveredDate`='',
																	  `DeliveredEmpId`='',
																	  `VerifyDate`='$delivrydate',
																	  `ResultCulture`='',
																	  `TCONLYDATE`=Now(),
																	  `CreatedDate`=Now()";
					if(isset($urgent[$count]))
					{
						$query3.=",`ReqUrgent`=1";
					}
					if(isset($speciman[$count+1]))
					{
						$newcount=$count+1;
						$query3.=",`Specimenid`=$speciman[$newcount]";
					}
					if(isset($speciman_out[$count+1]))
					{
						$query3.=",`TestLocal`='0'";
					}
					if(isset($due[$count]))
					{
						$query3.=",`SpecimenDue`=1";
					}
					//echo $query3;exit;
					mysqli_query($con,$query3);
					$count++;
				}
			$queryupdatpoint="update tblpoints set current_point_no=$current_point_no where PointId='".$_SESSION['user']['point_id']."'";	
			mysqli_query($con,$queryupdatpoint);
			header("location:" . $ru."print");
    exit;
		}
 /*this code is now run by process ajax.php as this fucntion is done through ajax now
 if(isset($_POST['varifyspeciman']))
		{
			$queryupdatpoint="update tblpatienttestdetails set isVerified=1, verifyBy='".$_SESSION['user']['uid']."' where patientTestsId='".$_POST['patienttestid']."'";	
			//echo $queryupdatpoint;exit;
			mysqli_query($con,$queryupdatpoint);
			header("location:" . $ru);
    exit;
		} */
if(isset($_POST['updatethistest']))
		{
			$bottles = implode(",",$_POST['bottles']);
			$speciman = implode(",",$_POST['speciman']);
			$query= "update `tbltest` SET 
										  `Name`='$testname',
										  `Code`='$testcode',
										  `tstDepartId`='$departments',
										  `TestHeading`='$testheader',
										  `chemicalUsed`='$chemicalused',
										  `tstPerformTime`='$performtime',
										  `Column1`='$heading1',
										  `Column2`='$heading2',
										  `Column3`='$heading3',
										  `Remarks`='$remarks',
										  `specBottle`='$bottles',
										  `SpecimenId`='$speciman',
										  `startDate` ='$creatdate'
										  ";
			
			if(isset($_POST['isactive']))
			{
				$query.=",`isActive`=1";
			}	
			if(isset($_POST['textonly']))
			{
				$query.=",`IsTextOnly`=1";
			}
			if(isset($_POST['testnotrequired']))
			{
				$query.=",`IsAvailable`=1";
			}
			if(isset($_POST['showmachine']))
			{
				$query.=",`ShowMachineDetails`=1";
			}
			if(isset($_POST['showgraph']))
			{
				$query.=",`ShowGraph`=1";
			}
			$query.=" where tstNameId = $testidhidden";
			//echo $query;exit;
			mysqli_query($con,$query);
			
			header("location:" . $ru);
    		exit;
		 
		}
if(isset($_POST['savepanel']))
		{
			$query= "insert into `tblpaneldetails` SET 
										  `PointId`='$point',
										  `PanelCode`='$panelcode',
										  `Name`='$panelname',
										  `Address`='$address',
										  `Phone`='$phone',
										  `Mobile`='$mobile',
										  `Fax`='$fax',
										  `Email`='$eamil',
										  `CreatedDate`='$createdate',
										  `TotAmountDue`='$amountdue',
										  `Description`='$remarks'";
			if(!isset($_POST['isactive']))
			{
				$query.=",`isActive`=0";
			}
			mysqli_query($con,$query);
			$newpanelid=mysql_insert_id();
			foreach ($_POST as $name => $value) 
			  {
				  if(is_int($name))
				  {
					  $query= "insert into `tbltestrates` SET 
											`tstNameId`=$name,
											`panelId`=$newpanelid,
											`Rate`=$value,
											`postingDate`=Now()";
					 //echo $query;exit;
					 mysqli_query($con,$query);
				  }
			  }
			//echo $query;exit;
			header("location:" . $ru);
    exit;
			}
if(isset($_POST['save_newemployee']))
		{
			$query= "insert into `tblemployee` SET 
										  `PointId`='$point_newemployee',
										  `EmpDepartId`='$department',
										  `login`='$login',
										  `password`='$password',
										  `name`='$name',
										  `address`='$address',
										  `telephone`='$telephone',
										  `mobile`='$mobile',
										  `email`='$email',
										  `DOB`='$dateofbirth',
										  `dateCreated`='$datecreated',
										  `TotSalary`='$totalsalary',
										  `AdvanceBalance`='$advancebalance',
										  `CurrentSalary`='$currentsalery',
										  `lastLoginDate`='$lastlogindate',
										  `currentLoginDate`='$currentlogindat',
										  `JoiningDate`='$joiningdate',
										  
										  `Qualification`='$qualification',
										  `EmergencyContact`='$emergency',
										  `Experience`='$experience'";
										  
			if(isset($_POST['isActive']))
			{
				$query.=",`isactive`=1";
			}					  
			if(isset($_POST['leavingdatecheckbox']))
			{
				$query.=",`LeavingDate`='$leavingdatetextbox', IsLeave=1";
			}
			if(isset($_POST['rejoiningdatecheckbox']))
			{
				$query.=",`RejoiningDate`='$rejoiningdatetextbox', IsRejoining=1";
			}
			mysqli_query($con,$query);
			$rolinsertid=mysql_insert_id();
			//$rolestatus = implode(",",$_POST['rolestatus']);
			//echo '<pre>'; print_r($rolestatus);echo '</pre>';exit;
			foreach($_POST['rolestatus'] as $status)
				{
					$NNQU="insert into tblemproles(EmployeeId,RoleId,DateAssigned) values('$rolinsertid','$status',Now())";
					//echo $NNQU;exit;
					$insetquery=mysqli_query($con,$NNQU);
				}
			$rightstatus = implode(",",$_POST['rightstatus']);
			foreach($_POST['rightstatus'] as $status)
				{
					$insetquery=mysqli_query($con,"insert into tblemprights(EmployeeId,RightId,DateAssigned) values('$rolinsertid','$status',Now())");
				}
			
			//echo $query;exit;
			header("location:" . $ru);
    		exit;
			}
if(isset($_POST['update_employee']))
		{
			$query= "update `tblemployee` SET 
										  `PointId`='$point_newemployee',
										  `EmpDepartId`='$department',
										  `login`='$login',
										  `password`='$password',
										  `name`='$name',
										  `address`='$address',
										  `telephone`='$telephone',
										  `mobile`='$mobile',
										  `email`='$email',
										  `DOB`='$dateofbirth',
										  `dateCreated`='$datecreated',
										  `TotSalary`='$totalsalary',
										  `AdvanceBalance`='$advancebalance',
										  `CurrentSalary`='$currentsalery',
										  `lastLoginDate`='$lastlogindate',
										  `currentLoginDate`='$currentlogindat',
										  `JoiningDate`='$joiningdate',
										  
										  `Qualification`='$qualification',
										  `EmergencyContact`='$emergency',
										  `Experience`='$experience'";
										  
			if(isset($_POST['isActive']))
			{
				$query.=",`isactive`=1";
			}					  
			if(isset($_POST['leavingdatecheckbox']))
			{
				$query.=",`LeavingDate`='$leavingdatetextbox', IsLeave=1";
			}
			if(isset($_POST['rejoiningdatecheckbox']))
			{
				$query.=",`RejoiningDate`='$rejoiningdatetextbox', `IsRejoining`=1";
			}
			$query.=" where `EmployeeId` = $employeehiddenid";
			//echo $query;exit;
			mysqli_query($con,$query);
			$rolinsertid=$employeehiddenid;
			//$rolestatus = implode(",",$_POST['rolestatus']);
			//echo '<pre>'; print_r($rolestatus);echo '</pre>';exit;
			$delete="delete from tblemproles where EmployeeId = '$rolinsertid'";
			$delquery=mysqli_query($con,$delete);
			foreach($_POST['rolestatus'] as $status)
				{
					$NNQU="insert into tblemproles(EmployeeId,RoleId,DateAssigned) values('$rolinsertid','$status',Now())";
					$insetquery=mysqli_query($con,$NNQU);
				}
			//$rightstatus = implode(",",$_POST['rightstatus']);
			$delete="delete from tblemprights where EmployeeId = '$rolinsertid'";
			$delquery=mysqli_query($con,$delete);
			foreach($_POST['rightstatus'] as $status)
				{
					$insetquery=mysqli_query($con,"insert into tblemprights(EmployeeId,RightId,DateAssigned) values('$rolinsertid','$status',Now())");
				}
			
			//echo $query;exit;
			header("location:" . $ru);
    		exit;
			}

if(isset($_POST['add_categories']))
		{
			$query= "insert into `tblcategories` SET 
										  `TypeID`='$type',
										  `Category`='$category',
										  `LongText`='$longtext',
										  `ParentCategoryID`='$parentcategory',
										  `DisplayOrder`='$display_order'";
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['add_shift_income']))
		{
			$query= "insert into `tblshiftincome` SET 
										  `PointId`='$point',
										  `IncomeId`='$icometype',
										  `FromUser`='$userid',
										  `AmountRecieved`='$amountRecieved',
										  
										  `TotalAmount`='$amountRecieved',
										  `Shiftdate`='$shiftdate',
										  `ToUser`='$userid',
										  `Remarks`='$remarks'";
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }

if(isset($_POST['testdepartment']))
		{
			$query= "insert into `tbltestdepartments` SET 
										  `Code`='$departmentcode',
										  `Name`='$departmentname',
										  `routine_num_change`='$routine_number',
										  `Description`='$remarks'
										  ";
			
			if(isset($_POST['Active']))
			{
				$query.=",`isActive`=1";
			}	
			if(isset($_POST['samenoinrecipt']))
			{
				$query.=",`isstaticdeptcode`=1";
			}		
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['addnewtest']))
		{
			$bottles = implode(",",$_POST['bottles']);
			$speciman = implode(",",$_POST['speciman']);
			$query= "insert into `tbltest` SET 
										  `Name`='$testname',
										  `Code`='$testcode',
										  `tstDepartId`='$departments',
										  `TestHeading`='$testheader',
										  `chemicalUsed`='$chemicalused',
										  `tstPerformTime`='$performtime',
										  `Column1`='$heading1',
										  `Column2`='$heading2',
										  `Column3`='$heading3',
										  `Remarks`='$remarks',
										  `specBottle`='$bottles',
										  `SpecimenId`='$speciman',
										  `startDate` ='$creatdate'
										  ";
			
			if(isset($_POST['isactive']))
			{
				$query.=",`isActive`=1";
			}	
			if(isset($_POST['textonly']))
			{
				$query.=",`IsTextOnly`=1";
			}
			if(isset($_POST['testnotrequired']))
			{
				$query.=",`IsAvailable`=1";
			}
			if(isset($_POST['showmachine']))
			{
				$query.=",`ShowMachineDetails`=1";
			}
			if(isset($_POST['showgraph']))
			{
				$query.=",`ShowGraph`=1";
			}
			//echo $query;exit;
			mysqli_query($con,$query);
			
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['addspeciman']))
		{
			$query= "insert into `tblspecimens` SET 
										  `SpecimenCode`='$specimancode',
										  `SpecimenName`='$specimanname',
										  `Remarks`='$ramarks'";
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['Editespeciman']))
		{
	$query= "update `tblspecimens` SET 
										  `SpecimenCode`='$specimancode',
										  `SpecimenName`='$specimanname',
										  `Remarks`='$ramarks'
										  where SpecimenId='".$_POST['specimanidHidden']."'";
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit; }
if(isset($_POST['neworganism']))
		{
			$query= "insert into `tblorganisms` SET 
										  `Name`='$name',
										  `Remarks`='$ramarks'";
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['addantibiotec']))
		{
			$query= "insert into `tblantibiotics` SET 
										  `Name`='$name',
										  `Code`='$code',
										  `Remarks`='$ramarks'";
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['Editantibiotec']))
		{
			$query= "update `tblantibiotics` SET 
										  `Name`='$name',
										  `Code`='$code',
										  `Remarks`='$ramarks'
										  where AntId='".$_POST['antibiotecidHidden']."'";
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['addtestnote']))
		{
			$query= "insert into `tbltestnotes` SET 
										  `NoteName`='$name',
										  `NoteHeading`='$heading',
										  `Note`='$note'";
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['updatetestnote']))
		{
			$query= "update `tbltestnotes` SET 
										  `NoteName`='$name',
										  `NoteHeading`='$heading',
										  `Note`='$note'
										  where NoteId='".$_POST['testnotehiddenid']."'";
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['addmachine']))
		{
			$query= "insert into `tblmachinedetails` SET 
										  `PointId`='$point',
										  `machineName`='$name',
										  `Method`='$method',
										  `Company`='$company',
										  `Remarks`='$remarks'";
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['editmachine']))
		{
			$query= "update `tblmachinedetails` SET 
										  `PointId`='$point',
										  `machineName`='$name',
										  `Method`='$method',
										  `Company`='$company',
										  `Remarks`='$remarks'
										  where machineId='".$_POST['machinehiddenid']."'";
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['newrefferedby']))
		{
			$query= "insert into `tblreferreddoctor` SET 
										  `PointId`='$point',
										  `refType`='$refType',
										  `Name`='$name',
										  `clinicName`='$clinicname',
										  `hAddress`='$homeaddress',
										   `hPhone`='$homephone',
										  `Mobile`='$mobile',
										  `Fax`='$fax',
										  `Email`='$email',
										  `cAddress`='$clinicaddress',
										  `cPhone`='$clinicphone',
										  `Discount`='$discount',
										  `Createddate`='$date',
										  `commission`='$commision',
										  `Remarks`='$remarks'";
										  			//echo $query;exit;
			if(isset($_POST['isactive']))
			{
				$query.=",`isActive`=1";
			}	
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['updaterefferedbyrecord']))
		{
			$query= "update `tblreferreddoctor` SET 
										  `PointId`='$point',
										  `refType`='$refType',
										  `Name`='$name',
										  `clinicName`='$clinicname',
										  `hAddress`='$homeaddress',
										   `hPhone`='$homephone',
										  `Mobile`='$mobile',
										  `Fax`='$fax',
										  `Email`='$email',
										  `cAddress`='$clinicaddress',
										  `cPhone`='$clinicphone',
										  `Discount`='$discount',
										  `Createddate`='$date',
										  `commission`='$commision',
										  `Remarks`='$remarks'";
										  			
			if(isset($_POST['isactive']))
			{
				$query.=",`isActive`=1";
			}	
			$query.=" where refId = '".$refdoctorhiddenid."'";
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }

if(isset($_POST['addpoint']))
		{
			$query= "insert into `tblpoints` SET 
										  `location`='$location',
										  `lCode`='$locationcode',
										  `Address`='$address',
										  `PhoneNo`='$phone',
										  `Fax`='$fax',
										   `Email`='$email',
										  `routine_num_change`='$routine_number',
										  `Createddate`='$datecreated',
										  `Remarks`='$remarks'";
										  			
			if(isset($_POST['isactive']))
			{
				$query.=",`isActive`=1";
			}	
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['update_point']))
		{
			$query= "update `tblpoints` SET 
										  `location`='$location',
										  `lCode`='$locationcode',
										  `Address`='$address',
										  `PhoneNo`='$phone',
										  `Fax`='$fax',
										  `Email`='$email',
										  `routine_num_change`='$routine_number',
										  `Remarks`='$remarks'";
										  			
			if(isset($_POST['isactive']))
			{
				$query.=",`isActive`=1";
			}	
			$query.=" where PointId='".$_POST['PointId']."'";
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }

if(isset($_POST['addnewrole']))
		{
			$query= "insert into `tblroles` SET 
										  `Name`='$rol_es',
										  `Remarks`='$role_remarks'";
			mysqli_query($con,$query);
			$newroleid=mysql_insert_id();
			$roleidarray=array();
			foreach($_POST['right_status'] as $rightid)
			{
				array_push($roleidarray, $rightid);		
			}	
			//print_r($roleidarray);exit;
			foreach ($_POST as $name => $value) 
			  {
				  $nameexp = explode('_', $name);
				  //print_r($nameexp);exit;
				  if (in_array($nameexp[1], $roleidarray)) 
					  {
						  if($nameexp[0]=='dateassgigd')
						  {
							  $newquery="insert into tblrolesrights SET 
										  `RoleId`='$newroleid',
										  `RightId`='$nameexp[1]',
										  `DateAssigned`='$value',
										  `Remarks`=''";
										  //echo $newquery.'<br>';
										  mysqli_query($con,$newquery);
						  }
					  }
			  }
			//exit;
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['updatenewrole']))
		{
			$query= "update `tblroles` SET 
										  `Name`='$rol_es',
										  `Remarks`='$role_remarks' where RoleId = '".$roleidhidden."'";
			mysqli_query($con,$query);
			$newroleid=$roleidhidden;
			
			$newqu="delete from tblrolesrights where RoleId='".$roleidhidden."'";
			mysqli_query($con,$newqu);
			
			$roleidarray=array();
			foreach($_POST['right_status'] as $rightid)
			{
				array_push($roleidarray, $rightid);		
			}	
			//print_r($roleidarray);exit;
			foreach ($_POST as $name => $value) 
			  {
				  $nameexp = explode('_', $name);
				  //print_r($nameexp);exit;
				  if (in_array($nameexp[1], $roleidarray)) 
					  {
						  if($nameexp[0]=='dateassgigd')
						  {
							  $newquery="insert into tblrolesrights SET 
										  `RoleId`='$newroleid',
										  `RightId`='$nameexp[1]',
										  `DateAssigned`='$value',
										  `Remarks`=''";
										  //echo $newquery.'<br>';
										  mysqli_query($con,$newquery);
						  }
					  }
			  }
			//exit;
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['addnewbottle']))
		{
			$query= "insert into `tblspecimenbottles` SET 
										  `ContainerName`='$name',
										  `Remarks`='$remarks'";
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['updatenewbottle']))
		{
			$query= "update `tblspecimenbottles` SET 
										  `ContainerName`='$name',
										  `Remarks`='$remarks' where ContainerId = $containeridhidden";
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
		 
if(isset($_POST['updatemySeqNo']))
		{
			$query= "update `tbltestdepartments` SET 
										  `CatSeqNo`='$CatSeqNo'
										   where tstDepartId = $CatSeqNohiddenId";
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['addnew_ab_catergoy']))
		{
			$query= "insert into `tblabcategory` SET 
										  `CName`='$category',
										  `Description`='$remarks'";
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['update_ab_catergoy']))
		{
			$query= "update `tblabcategory` SET 
										  `CName`='$category',
										  `Description`='$remarks' where CategoryId= $abcathidden";
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }

if(isset($_POST['new_contact']))
		{
			$query= "insert into `tbladdressbook` SET 
													`Name`				='$Name',
													`JobTitle`			='$JobTitle',
													`Department`		='$Department',
													`Company`			='$Company',
													`CAddress`			='$CAddress',
													`CTelNo`			='$CTelNo',
													`CFax`				='$CFax',
													`BusinessDetails`	='$BusinessDetails',
													`HAddress`			='$HAddress',
													`HTelNo`			='$HTelNo',
													`MailingAddress`	='$MailingAddress',
													`Mobile`			='$Mobile',
													`Email`				='$Email',
													`WebSite`			='$WebSite',
													`Remarks`			='$Remarks',
													`CategoryId`		='$CategoryId',
													`creationdate`		=Now()";
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['update_contact']))
		{
			$query= "update `tbladdressbook` SET 
													`Name`				='$Name',
													`JobTitle`			='$JobTitle',
													`Department`		='$Department',
													`Company`			='$Company',
													`CAddress`			='$CAddress',
													`CTelNo`			='$CTelNo',
													`CFax`				='$CFax',
													`BusinessDetails`	='$BusinessDetails',
													`HAddress`			='$HAddress',
													`HTelNo`			='$HTelNo',
													`MailingAddress`	='$MailingAddress',
													`Mobile`			='$Mobile',
													`Email`				='$Email',
													`WebSite`			='$WebSite',
													`Remarks`			='$Remarks',
													`CategoryId`		='$CategoryId'
													where ContactId = $hiddenaddresbookid";
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['addnewitem']))
		{
			$query= "insert into `tblitems` SET 
										  `Name`='$name',
										  `EmployeeId`='".$_SESSION['user']['uid']."',
										  
										  `CateNo`='$category_no',
										  `PackSize`='$Pak_size',
										  `suplierId`='$supplier',
										  `CompanyId`='$manufacturer',
										  `previousPrice`='$prev_price',
										  `currentPrice`='$current_price',
										  `borderLine`='$border_line',
										  `ItemDate`=NOW(),
										  `Remarks`='$remarks'";
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['updatenewitem']))
		{
			$query= "update `tblitems` SET 
										  `Name`='$name',
										  `EmployeeId`='".$_SESSION['user']['uid']."',
										  `CateNo`='$category_no',
										  `PackSize`='$Pak_size',
										  `suplierId`='$supplier',
										  `CompanyId`='$manufacturer',
										  `previousPrice`='$prev_price',
										  `currentPrice`='$current_price',
										  `borderLine`='$border_line',
										  `ItemDate`=NOW(),
										  `Remarks`='$remarks'
										  where ItemId=$itemidhidden";
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['addnewsupplier']))
		{
			$query= "insert into `tblsuppliers` SET 
										  `Name`='$name',
										  `EmployeeId`='".$_SESSION['user']['uid']."',
										  `Address`='$address',
										  `Phone`='$phone',
										  `Email`='$email',
										  `Fax`='$fax',
										  `CreatedDate`=NOW(),
										  `Description`='$remarks'";
			if(isset($_POST['isactive']))
			{
				$query.=",`isActive`=1";
			}
			mysqli_query($con,$query);
			$newsupplierid=mysql_insert_id();
			$newquery= "insert into `tblcontacts` SET 
										  `AssociationID`='$newsupplierid',
										  `Name`='$contactpersonname',
										  `Mobile`='$contactpersonmobile',
										  `Type`='1',
										  `ContactType`='3'";
			mysqli_query($con,$newquery);
			$newquery2= "insert into `tblcontacts` SET 
										  `AssociationID`='$newsupplierid',
										  `Name`='$contactcompanyname',
										  `Mobile`='$contactcompanymobile',
										  `Type`='1',
										  `ContactType`='5'";
			mysqli_query($con,$newquery2);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['addnewcompany']))
		{
			$query= "insert into `tblcompany` SET 
										  `Name`='$name',
										  `EmployeeId`='".$_SESSION['user']['uid']."',
										  `Address`='$address',
										  `Phone`='$phone',
										  `Email`='$email',
										  `Fax`='$fax',
										  `CreatedDate`=NOW(),
										  `Description`='$remarks'";
			if(isset($_POST['isactive']))
			{
				$query.=",`isActive`=1";
			}
			mysqli_query($con,$query);
			$newsupplierid=mysql_insert_id();
			$newquery= "insert into `tblcontacts` SET 
										  `AssociationID`='$newsupplierid',
										  `Name`='$personname',
										  `Mobile`='$personmobile',
										  `Type`='2',
										  `ContactType`='3'";
			//$newqueryinserid=mysql_insert_id();
			mysqli_query($con,$newquery);
			$newquery2= "insert into `tblcontacts` SET 
										  `AssociationID`='$newsupplierid',
										  `Name`='$engineername',
										  `Mobile`='$engineermobile',
										  `Type`='2',
										  `ContactType`='4'";
			mysqli_query($con,$newquery2);
			header("location:" . $ru);
    		exit;
		 }

if(isset($_POST['update_panel']))
		{
			$query= "update `tblpaneldetails` SET 
										  `PanelCode`='$panelcode',
										  `PointId`='$point',
										  
										  `Name`='$panelname',
										  `Address`='$address',
										  `Phone`='$phone',
										  `Mobile`='$mobile',
										  `Fax`='$fax',
										  `Email`='$eamil',
										  `CreatedDate`='$createdate',
										  `Contact_person`='$Contact_person',
										  `Description`='$remarks'";
			if(!isset($_POST['isactive']))
			{
				$query.=",`isActive`=0";
			}
			$query.=" where PanelId='".$_POST['update_panel_id']."'";
			mysqli_query($con,$query);
			foreach ($_POST as $name => $value) 
			  {
				  if(is_int($name))
				  {
					  $query= "update `tbltestrates` SET 
											`Rate`=$value
											where `tstNameId`=$name AND `panelId`='".$_POST['update_panel_id']."'";
					 //echo $query;exit;
					 mysqli_query($con,$query);
				  }
			  }
			//echo $query;exit;
			header("location:" . $ru);
    exit;
			}
if(isset($_POST['update_testdepartment']))
		{
			$query= "update `tbltestdepartments` SET 
										  `Code`='$departmentcode',
										  `Name`='$departmentname',
										  `routine_num_change`='$routine_number',
										  `Description`='$remarks'";
			
			if(isset($_POST['Active']))
			{
				$query.=",`isActive`=1";
			}
			else
			{
				$query.=",`isActive`=0";
			}	
			
			if(isset($_POST['samenoinrecipt']))
			{
				$query.=",`isstaticdeptcode`=1";
			}	
			 else
			{
				$query.=",`isstaticdeptcode`=0";
			}	
			$query.="  where tstDepartId='".$_POST['tstDepartId']."'";	
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
if(isset($_POST['ClearPatientDues']))
		{
			$newBalance=$Balance-($cleardues+$duediscount);
			$query= "update `tblpatientreciept` SET 
										  `Balance`='$newBalance'
										   where PatientTestsId='".$_POST['PatientTestsId']."'";	
			//echo $query;exit;
			mysqli_query($con,$query);
			header("location:" . $ru);
    		exit;
		 }
/* this is now reploaced with ajax fucntion which is working in process_ajax.php
if(isset($_POST['submitresults']))
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
		 }
this is now reploaced with ajax fucntion which is working in process_ajax.php*/
?>
