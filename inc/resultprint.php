<?php
unset($_SESSION['test_ids']);
$test_id=$_GET['s'];
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
							 tblpatienttestdetails.pTestDetailsId,
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
            
              
               <?php
                  $yui="select * from tblpatienttestdetails where patientTestsId = '".$role['PatientTestsId']."'";
				  $rty=mysqli_query($con,$yui);
				  while($alltests=mysqli_fetch_array($rty,MYSQLI_ASSOC))
				  {
                      ?>
                        <div id="printpreview<?php echo $alltests['pTestDetailsId'];?>">
                            <div style="height:100px;"></div>
                            <div>
                                  <div style="float:left; width:400px">
                                      <h3><?php echo $Patient['Name'];?></h3>  
                                      <?php echo $Patient['Age']." "; echo $Patient['AgeType'];?> (<?php echo $Patient['Sex']?>) 
                                      <br /> <b>Ref By: <?php echo $Ref_name['Name']?></b>
                                  </div>
                                  <div style="float:right; width:400px">
                                      <?php 
                                              $yui2="select * from tblpoints where PointId = '".$role['PointId']."'";
                                              $rty2=mysqli_query($con,$yui2);
                                              $point=mysqli_fetch_array($rty2,MYSQLI_ASSOC);
                                          ?>
                                          <h1> <?php echo $role['ReceiptId'];?>/<?php echo $point['lCode'];?> </h1>
                                          <br />
                                          <?php echo date('D, d F, Y ', strtotime($role['testDate']));//echo date("D");echo " ".date("d-M-Y");echo " ".date("h:i:A")?>
                                  </div>
                              </div>
                            <div style="clear:both;"></div>
                            <?php 
                                    $que= mysqli_query($con,"select tstNameId, Name from tbltest where tstNameId='".$alltests['tstNameId']."'");
                                    $testna=mysqli_fetch_array($que,MYSQLI_ASSOC);
                                    echo  '<h2>'.$testna['Name'].'</h2>';?>
                            <table border="1" cellspacing="0" style="font-size:11px;">
                                <tr>
                                    <th width="200">Test</th>
                                    <th width="200">Patient value</th>
                                    <th width="200">Refrence Values</th>
                                </tr>
                                <?php
                                $parmeter="SELECT * FROM tbltestparameters WHERE tstNameId = '".$alltests['tstNameId']."'";
                                      $par=mysqli_query($con,$parmeter);
                                while($ParFetch=mysqli_fetch_array($par,MYSQLI_ASSOC)){
                                      ?>
                                  <tr>
                                    <td><?php echo $ParFetch['Name'];?></td>
                                    <?php 
                                              $querycomp="select * from tbltestresults where pTestDetailsId='".$alltests['pTestDetailsId']."'  AND tstParaId='".$ParFetch['tstParaId']."'";
                                              $rty2=mysqli_query($con,$querycomp);
                                              $fetchcompl=mysqli_fetch_array($rty2,MYSQLI_ASSOC);
                                        ?>
                                      <td><?php echo $fetchcompl['Result']; ?></td>
                                    
                                    <?php
                                              $refvalue="select * from tblreferencevalues where tstParaId='".$ParFetch['tstParaId']."'";
                                              $refvaluequ=mysqli_query($con,$refvalue);
                                              $refvaluefe=mysqli_fetch_array($refvaluequ,MYSQLI_ASSOC);
                                              
                                           ?>
                                    <td><?php echo $refvaluefe['Description']; ?></td>
                                </tr>
                                  <?php }?>
                                
                            </table>
                       </div> 
                      <button  onclick="PrintElem('#printpreview<?php echo $alltests['pTestDetailsId'];?>')">Result Print</button>
              <?php }?>
</div>