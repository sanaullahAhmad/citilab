<?php
	$host		=	$_SERVER['HTTP_HOST'];
	
	$host   	=   "localhost";
	$username	=	"root";
	$password	=	"";
	$db			=	"citilab2";
	//$db			=	"citilabag";
	
	/*$host		=	"citilab.db.12090245.hostedresource.com";
	$username	=	"citilab";
	$password	=	"am!rOze1";
	$db			=	"citilab";*/
	
	/*$host		=	"localhost";
	$username	=	"doctori4_citilab";
	$password	=	"Sana@123";
	$db			=	"doctori4_citilabs";*/
	
/*$link=mysql_connect($host,$username,$password);
mysql_select_db($db);*/
$con = mysqli_connect($host,$username,$password,$db);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>