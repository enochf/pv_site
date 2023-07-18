<?php
session_start();
include('includes/inc_connection.php');
include('includes/inc_functions.php');
checkSession();
$uid = $_SESSION['uID'];
$sid = cleanVar($_GET['sid']);
$q = "UPDATE scenarios SET status='2' WHERE ((sID=?) AND (uID=?))";
// mysql_query($q) OR die(err_log('REMOVE SCENARIO: '.$q.' ERROR:'.mysql_error()));
query($q,array($sid,$uid),'u','Delete Scenario');
$_SESSION['message'] = '<div id="message">Your model run has been removed.</div>';
header("Location:my-account.php");
exit;
?>