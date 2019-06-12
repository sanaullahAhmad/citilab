<?php

require('../config/config.php');
session_start();
unset($_SESSION['user']);
header('location:' . $ru);
exit;
?>