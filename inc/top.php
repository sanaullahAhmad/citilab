<?php if(!isset($_SESSION['user']))
					{
						header('location:login.php');	
						exit();
					}
		$_SESSION['test_ids']=array();
		date_default_timezone_set("Asia/Karachi");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="stylista" />
    <link type="text/css" rel="stylesheet" href="<?php echo $ru;?>css/style.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo $ru;?>css/superfish.css" />
	<script type="text/javascript" src="<?php echo $ru;?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $ru;?>js/plugins-min.js"></script>
    <script type="text/javascript" src="<?php echo $ru;?>js/jquery.reveal.js"></script>
    
    <script src="<?php echo $ru;?>js/jquery_ui.js"></script>
    <link rel="stylesheet" href="<?php echo $ru;?>css/jquery_ui.css">
    <link rel="stylesheet" href="<?php echo $ru;?>css/reveal.css" />
    <title>Citi Lab</title>
     <script>
	$(document).ready(function(){
		//Code for capitaliz first letter starts
		$('input[type="text"]').keyup(function(evt){
			var txt = $(this).val();
			$(this).val(txt.replace(/^(.)|\s(.)/g, function($1){ return $1.toUpperCase( ); }));
		});
		//Code for capitaliz first letter ends
		
		
		$(".urgentcheckbox").focus(function(event){
				$('#anothertest').trigger('click');	
		});
		


		$("#phone_number").keydown(function(){
		  var phone_number = $("#phone_number").val().length;
			  if(phone_number==11)
				  {
					  jQuery('#cutomer_phone_button').trigger('click');
				  }
		});
		$("#phone_number").keyup(function(){
		  var phone_number = $("#phone_number").val().length;
			  if(phone_number==11)
				  {
					  jQuery('#cutomer_phone_button').trigger('click');
				  }
		});
	});
	 function checkdatechange(checkdate)
	 {
		 if(checkdate === 'Date' || checkdate === 'DelivryTime')
		 {
		 	 document.getElementById('enddate').disabled=false;
			 $("#searchcat").addClass("datepicker");
			 $("#enddate").addClass("datepicker");
			 $('.datepicker').each(function(){
					$(this).datepicker({ dateFormat: 'yy-mm-dd'});
			 });
		 }
		 else 
		 {
		 	 document.getElementById('enddate').disabled=true;
			 $("#searchcat").datepicker("destroy");
		 }
	 }
	 
	 function dicountFunction()
     {
		 var totalamount = document.getElementById('totalamount').value;
		 var discount = document.getElementById('discount').value;
		 document.getElementById('netamount').value=totalamount-discount;
     }
	 function balancefinder()
	 {
		 var recieved = document.getElementById('recieved').value;
		 var netamount = document.getElementById('netamount').value;
		 document.getElementById('balance').value=netamount-recieved;
	 }
	 function disabledselect()
	 {
		 document.getElementById('panellist').disabled='disabled';
		  $(".panelinfotable").html('<tr><td>Name&nbsp;&nbsp;&nbsp;<a href="#" id="cutomerdescription" onclick="customerdescription(&#39;name&#39;)">&nbsp;...&nbsp;</a></td><td>S/O,D/O,W/O</td><td>Address / Email</td><td>NIC / Passport</td></tr><tr><td><input type="text" name="name" id="name" required/></td><td><input type="text" name="sodowo" id="sodowo" /></td><td><input type="text" name="address" id="patient_address" /></td><td><input type="text" name="nic_passport" id="nic_passport" /></td></tr><input type="text" name="designation" id="designationtextfield" style="visibility:hidden"><input type="text" name="designation" id="departmenttextfield" style="visibility:hidden">');
		  $(".paneldisplay").css("display","block");
		  $(".uperleftinner2").css("display","none");
		  $(".uperleftinner3").css("display","none");
	 }
	 function eanbleselect()
	 {
		  document.getElementById('panellist').disabled=false; 
		  //$(".paneldisplay").hide(); 
		  $(".paneldisplay").css("display","none");
		  $(".uperleftinner2").css("display","block");
		  $(".uperleftinner3").css("display","block");
		  
		  
		  $('.panelinfotable').html('<tr><td>PatientName<a href="#" id="cutomerdescription" onclick="customerdescription(&#39;name&#39;)">&nbsp;...&nbsp;</a></td><td>EmployeeName</td><td>Department</td><td>Designation</td><td>Rel-with-Emp</td></tr><tr><td><input type="text" name="name" id="name" required></td><td><input type="text" name="sodowo" id="sodowo" ></td><td><input type="text" name="department" id="departmenttextfield"></td><td><input type="text" name="designation" id="designationtextfield"></td><td><select name="relationwithemp" id="relationwithemp"><option value="Self">Self</option><option value="Father">Father</option><option value="Mother">Mother</option><option value="Son">Son</option><option value="Daughter">Daughter</option><option value="Wife">Wife</option></select><input type="text" name="patient_address" id="patient_address" style="display:none;"><input type="text" name="nic_passport" id="nic_passport" style="display:none;"></td></tr>');
	 }
	 function changegender(gendervalue)
	 {
		var newgv=document.getElementById('title').value;
		 $('#gender').val(newgv);
	 }
	 function price_auto_fill(testid, count1, count2, count3, count4)
	 {
			$("#anotherdiv").html('<style>#anothertest{display:block;}</style>');
			var x=document.getElementById('panellist').value;
			var fg=$('input[name=panel_or_nopanel]:checked').val();
			
			if(fg=="panel" && x=="--Select Panel--")
								{
								  alert("Select a Panel first in right sidebar");
								  return false;
								}
			else
								{
								var panelvalue=$('input[name=panel_or_nopanel]:checked').val();
								if(panelvalue=='panel')
									  {
										  var formdata =
											{
											  tbltestid: testid,
											  panel_list:document.getElementById('panellist').value,
											  current_point_no:document.getElementById('current_point_no').value,
											  priceautofil: 'second'
											};
									  }
								else
									  {
										  var formdata =
											{
											  tbltestid: testid,
											  panel_list:'5',
											  current_point_no:document.getElementById('current_point_no').value,
											  priceautofil: 'second'
											};
									  }
								
								$.ajax({
								  url: "<?php echo $ru;?>process/process_ajax.php",
								  type: 'POST',
								  data: formdata,
								  success: function(msg){
									  $("#"+count2).val(msg);
									  $("#"+count3).val(msg);
									  var sum = 0;
										  $('.price').each(function() {
											  sum += Number($(this).val());
										  });
									  $("#totalamount").val(sum);
									  $("#totalamounthidden").val(sum);
									  $("#netamount").val(sum);
									  $("#recieved").val(sum);
									  }
								  })
								  
								  //for speciman checkbox
								  
								  var formdata =
									{
									  tbltestid: testid,
									  specimanautofil: 'second',
									  counter:counter
									};
								$.ajax({
								  url: "<?php echo $ru;?>process/process_ajax.php",
								  type: 'POST',
								  data: formdata,
								  success: function(msg){
									  $(".specimaninner").append(msg);
									  }
								  })
								  
								  //for out checkbox
								  var formdata =
									{
									  tbltestid: testid,
									  out_autofil: 'second',
									  counter:counter
									};
								$.ajax({
								  url: "<?php echo $ru;?>process/process_ajax.php",
								  type: 'POST',
								  data: formdata,
								  success: function(msg){
									  $(".outinner").append(msg);
									  }
								  })
								  //for for labrefid
								  var formdata =
									{
									  tbltestid: testid,
									  labrefid_autofil: 'second'
									};
									$.ajax({
									  url: "<?php echo $ru;?>process/process_ajax.php",
									  type: 'POST',
									  data: formdata,
									  success: function(msg){
										  $("#"+count4).val(msg);
										  }
									  })
								   return false;
								}
		}
     jQuery(function()
	 {
		jQuery( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd',
			changeMonth: true,
            changeYear: true });
			$('#loadingDiv')
			.hide()  // hide it initially
			.ajaxStart(function() {
				$(this).show();
				$("#updatepanel").hide();
			})
			.ajaxStop(function() {
				$(this).hide();
				$("#updatepanel").show();
			});
    });
	 function validateForm()
	 {
	  var x=document.getElementById('panellist').value;
	  var fg = document.getElementsByName('panel_or_nopanel').value;
	 // alert(fg);
	  if(fg=="panel" && x=="--Select Panel--")
		{
		  alert("Select a Panel first in right sidebar");
		  return false;
		}
	  var newgv=document.getElementById('title').value;
		 if(newgv=='sel')
		 {
			 alert('Select Gender First');
			 return false;
		 }
	}
	 function ajaxfuction(va_nam)
	 {
	  var formdata =
		  {
			var_name: va_nam,
			sec_var: 'second'
		  };
	  $.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			$(".right_content").html(msg);
			}
		})
		return false;
	}
	 function ReciptCancelfuction(patienttestid)
	 {
	  var formdata =
		  {
			patienttestid: patienttestid,
			ReciptCancel: 'second'
		  };
	  $.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			$(".contenttable").append(msg);
			}
		})
		return false;
	}
	 function firstletter(first_charecter, table_name)
	 {
	  var formdata =
		  {
			first_char: first_charecter,
			tbl_name: table_name,
		  };
	  $.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			$(".right_content").html(msg);
			}
		})
		return false;
	}
	 function searchcat2_employee(tablenameemp)
	 {
		   //alert('searchcat_employee');
		   var searchtext2=document.getElementById('searchcat').value;
		   var formdata =
			{
			  searchtext2: searchtext2,
			  searchtableemp: 'tblemployee2',
			  searchtable:'sana'
			};
		$.ajax({
		  url: "<?php echo $ru;?>process/process_ajax.php",
		  type: 'POST',
		  data: formdata,
		  success: function(msg){
			  $(".searchresults").html(msg);
			  }
		  })
		  return false;
	  }
	 function searchcat(tablename)
	 {
		   //alert('sana');
		   var searchtext=document.getElementById('searchcat').value;
		   var enddate=document.getElementById('enddate').value;
		   var searchby=document.getElementById('searchby').value;
		   var formdata =
			{
			  searchtext: searchtext,
			  searchby: searchby,
			  searchtable: tablename,
			  enddate:enddate
			};
		$.ajax({
		  url: "<?php echo $ru;?>process/process_ajax.php",
		  type: 'POST',
		  data: formdata,
		  success: function(msg){
			  $(".searchresults").html(msg);
			  }
		  })
		  return false;
	  }
	 function patientajax(testid)
	 {
		//alert(testid);
		var formdata =
			{
			  patienttestid: testid,
			  patient_form_autofil: 'second'
			};
		$.ajax({
		  url: "<?php echo $ru;?>process/process_ajax.php",
		  type: 'POST',
		  data: formdata,
		  success: function(msg){
			  $(".creatreciep_fill_inner").html(msg);
			  }
		  })
		  return false;
	}
	 function employeeajax(employeeid)
	 {
		//alert(testid);
		var formdata =
			{
			  employeeid: employeeid,
			  employee_form_autofil: 'second'
			};
		$.ajax({
		  url: "<?php echo $ru;?>process/process_ajax.php",
		  type: 'POST',
		  data: formdata,
		  success: function(msg){
			  $(".employee_fill_inner").html(msg);
			  }
		  })
		  return false;
	}
	 function varifyajax(testid)
	 {
		//alert(testid);
		var formdata =
			{
			  patienttestid: testid,
			  patient_form_varify: 'second'
			};
		$.ajax({
		  url: "<?php echo $ru;?>process/process_ajax.php",
		  type: 'POST',
		  data: formdata,
		  success: function(msg){
			  $(".creatreciep_fill_inner").html(msg);
			  }
		  })
		  return false;
	}
	 function clearPatientdues(testid)
	 {
		//alert(testid);
		var formdata =
			{
			  patienttestid: testid,
			  clearpatientdues: 'second'
			};
		$.ajax({
		  url: "<?php echo $ru;?>process/process_ajax.php",
		  type: 'POST',
		  data: formdata,
		  success: function(msg){
			  $(".patientdueinner").html(msg);
			  }
		  })
		  return false;
	}
	 function enterresultsajax(pTestDetailsId)
	 {
		//alert(testid);
		var formdata =
			{
			  pTestDetailsId: pTestDetailsId,
			  enterresults: 'second'
			};
		$.ajax({
		  url: "<?php echo $ru;?>process/process_ajax.php",
		  type: 'POST',
		  data: formdata,
		  success: function(msg){
			  $(".enterresultsinner").html(msg);
			  }
		  })
		  return false;
	}
	
	 
	 function customerdescription(textfield)
	 {
		var patientname=document.getElementById('name').value;
		var patient_phonenumber=document.getElementById('phone_number').value;
		var formdata =
		  {
			patientsearch: 'first',
			text_field:textfield,
			name:patientname,
			phone:patient_phonenumber
		  };
	  $.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			$( ".searchpatient" ).show();
			$(".searchpatient").html(msg);
			}
		})
		return false;
	}
	 function divhide()
	 {
		$( ".searchpatient" ).hide();
	}
	 function filpatientdetials(patientid)
	 {
		var formdata =
		  {
			filpatientid: patientid,
			patient_name: 'second'
		  };
	  $.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			//alert(msg);
			$( ".searchpatient" ).hide();
			$(".searchpatient").html(msg);
			document.getElementById('name').value=myJson.patient_Name;
			document.getElementById('phone_number').value=myJson.patient_PhoneNo;
			document.getElementById('sodowo').value=myJson.GuardianName;
			document.getElementById('age').value=myJson.patient_Age;
			document.getElementById('previous_customer').value=myJson.ptient_id;
			var newgv=myJson.patient_Sex;
			
			document.getElementById('patient_address').value=myJson.patient_Address;
			document.getElementById('nic_passport').value=myJson.patient_NIC;
			document.getElementById('designationtextfield').value=myJson.designations;
			document.getElementById('departmenttextfield').value=myJson.departments;
			$('#relationwithemp').val(myJson.relationwithemp);
			//alert(newgv);
			 if(newgv=='Male')
			 {
				 var val = 1;
				$('#gender').val(val);
				$('#title').val(val);
			 }
			 else if(newgv=='Female')
			 {
				 var val = 2;
				$('#gender').val(val);
				$('#title').val(val);
			 }
			 else if(newgv=='FC')
			 {
				 var val = 3;
				$('#gender').val(val);
				$('#title').val(val);
			 }
			 else if(newgv=='MC')
			 {
				 var val = 4;
				$('#gender').val(val);
				$('#title').val(val);
			 }
				}
			})
			return false;
	}
	 function copyratesfrom(panelid)
	 {
		var formdata =
		  {
			panelid: panelid,
			copyrates: 'second'
		  };
	  $.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			//alert(msg);
			$(".copyrates").html(msg);
			}
			})
			return false;
	}
	 function discountrates(panelid)
	 {
		var dicount_rate=document.getElementById('dicount_rate').value;
		var formdata =
		  {
			panelid: panelid,
			discount: 'second',
			dicount_rate:dicount_rate
		  };
	  $.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			//alert(msg);
			$(".copyrates").html(msg);
			}
			})
			return false;
	}
	
	//Print the div
	function PrintElem(elem)
    {
        Popup($(elem).html());
    }
    function Popup(data) 
    {
        var mywindow = window.open('', 'Print div', 'height=600,width=800');
        mywindow.document.write('<html><head><title>Print Preview</title>');
        /*optional stylesheet*/ mywindow.document.write('<link rel="stylesheet" href="<?php  echo $ru;?>css/reveal.css" type="text/css" />');
		mywindow.document.write('<link rel="stylesheet" href="<?php  echo $ru;?>css/style.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }
	
	function updatepanel(PanelId)
	{
		 var formdata =
		  {
			PanelId: PanelId,
			updatepanel: 'second'
		  };
	  $.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			$(".updatepanel_inner").html(msg);
			}
		})
		return false;
	}
	function updateDepartment(DepartmentlId)
	{
		 //alert(DepartmentlId);
		 var formdata =
		  {
			DepartmentlId: DepartmentlId,
			updateDepartment: 'second'
		  };
	  $.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			$("#updateDepartment").html(msg);
			}
		})
		return false;
	}
	function updatetest(testid)
	{
		
		 //alert(DepartmentlId);
		 var formdata =
		  {
			testid: testid,
			updatetest: 'second'
		  };
	  $.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			$(".updatetestinnder").html(msg);
			}
		})
		return false;
		
	
	}
	function updatespeciman(specimanid)
	{
		//alert(DepartmentlId);
		 var formdata =
		  {
			specimanid: specimanid,
			updatespeciman: 'second'
		  };
	  $.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			$(".updatespecimaninner").html(msg);
			}
		})
		return false;
	}
	function updateantibiotec(antibiotecid)
	{
		//alert(DepartmentlId);
		 var formdata =
		  {
			antibiotecid: antibiotecid,
			updateantibiotec: 'second'
		  };
	  $.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			$(".updateantibiotecinner").html(msg);
			}
		})
		return false;
	}
	function updatetestnote(testnoteid)
	{
		//alert(DepartmentlId);
		 var formdata =
		  {
			testnoteid: testnoteid,
			updatetestnote: 'second'
		  };
	  $.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			$(".updatetestnoteinner").html(msg);
			}
		})
		return false;
	}
	function updateeverytable(tablename,recordid)
	{
		//alert(DepartmentlId);
		 var formdata =
		  {
			recordid: recordid,
			tablename: tablename,
			updateeverytable: 'second'
		  };
	  $.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			$(".updateeverytableinner").html(msg);
			}
		})
		return false;
	}
	
	
	function updatepoint(PointId)
	{
		 //alert(DepartmentlId);
		 var formdata =
		  {
			PointId: PointId,
			updatePoint: 'second'
		  };
	  $.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			$("#updatepoint").html(msg);
			}
		})
		return false;
	}
	function viewPanelReport(PanelId)
	{
		 var formdata =
		  {
			PanelId: PanelId,
			veiwPanelReport: 'second'
		  };
	  $.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			$(".right_content").html(msg);
			jQuery( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd',
			changeMonth: true,
            changeYear: true });
			}
		})
		return false;
	}
	function datePanelReport(PanelId)
	{
		var startdate=document.getElementById('panel_startdate').value;
		var enddate=document.getElementById('panel_enddate').value;
		var formdata =
			{
			  PanelId:PanelId,
			  startdate: startdate,
			  enddate: enddate,
			  datePanelReport: 'second'
			};
		$.ajax({
		url: "<?php echo $ru;?>process/process_ajax.php",
		type: 'POST',
		data: formdata,
		success: function(msg){
			$(".right_content").html(msg);
			}
		})
		  return false;
	}
	function showhidepricewithpanel()
	{
			var fg=$('select[name=panel_list]:selected').val();
			var conceptName = $('#panellist').find(":selected").attr("class");
			
			$(".paneldisplay").css("display",conceptName);
			$(".paneldisplaystyle").html('<style>.paneldisplay{display:'+conceptName+'}</style>');
				
	}
	function togglerefrencevalues(idref)
	{
		$("#"+idref).toggle();
	}
   </script>
     </head>
 <body>
    <div class="wrapper">