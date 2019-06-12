<?php
	session_start();
	require('config/config.php');
	require_once('connection/connection.php');
	require('inc/top.php');
	require('inc/header.php');
	if (isset($_REQUEST['page']))
	{
		$file = $_REQUEST['page'] . ".php";
		if (file_exists('inc/' . $file))
		{
			include('inc/' . $file);
		}
		else
		{
			include('inc/home.php');
		}
	}
	//require('inc/event.php');
	require('inc/footer.php');
?>