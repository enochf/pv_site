<?php
session_start();
include("includes/inc_connection.php");
include("includes/inc_functions.php");
$uid = cleanVar($_SESSION['uID']);
$sid = cleanVar($_GET['sid']);
if ($sid AND $sid != 'unsaved') {
	$q = "UPDATE scenarios SET vals='' WHERE ((sid=?) AND (uid=?))";
	query($q,array($sid,$uid),'u','Reset Scenario Defaults');
} else {
	unset($_SESSION['inputs']);
}
header("Location:".$_SERVER['HTTP_REFERER']);
exit;
?>