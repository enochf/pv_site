<?php
session_start();
include('includes/inc_connection.php');
include('includes/inc_functions.php');
checkSession();
$uid = $_SESSION['uID'];
$sid = cleanVar($_GET['sid']);
$q = "SELECT * FROM scenarios WHERE ((sID=?) AND (uID=?))";
$rs = query($q,array($sid,$uid),'s','Get Scenario Info for Copy');
$q = "INSERT INTO scenarios VALUES('',?,?,?,NOW(),'',1)";
$newID = query($q,array($uid,$rs[0]['name'].' - (Copy)',$rs[0]['vals']),'i','Create Copy of Scenario');
$sha1 = sha1($newID.'pvjed1');
$q = "UPDATE scenarios SET runkey=? WHERE sID=?";
query($q,array($sha1,$newID),'u','Add Key');
$_SESSION['message'] = '<div id="message">Your model run has been copied successfully.</div>';
header("Location:model.php?sid=".$newID);
exit;
?>