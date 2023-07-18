<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);
session_start();
include('includes/inc_connection.php');
include('includes/inc_functions.php');
checkSession();
$uid = $_SESSION['uID'];
$name = $_POST['name'];
$inputs = json_encode($_SESSION['tmp'][0]);
$q = "INSERT INTO scenarios VALUES('0',?,?,?,NOW(),'','1')";
$vars = array($uid,$name,$inputs);
$newID = query($q,$vars,'i','Save Model Run');
$sha1 = sha1($newID.'pvjed1');
$q = "UPDATE scenarios SET runkey=? WHERE sID=?";
query($q,array($sha1,$newID),'u','Add Key');
header("Location:".$_SERVER['HTTP_REFERER']."?sid=".$newID);
exit;
?>