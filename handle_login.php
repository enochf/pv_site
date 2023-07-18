<?php
session_start();
include("includes/inc_connection.php");
include("includes/inc_functions.php");
$email = cleanVar($_POST['email']);
$pass = cleanVar($_POST['pass']);
$url = cleanVar($_POST['url']);
$_SESSION['email'] = $email;

if (!$email OR !$pass) {
	$_SESSION['message'] = '<div id="message">Please fill in all required fields.</div>';
	header("Location:login.php");
	exit;
}
$q = "SELECT uID,fName,lName FROM users WHERE ((email=?) AND (pass=?) AND (status=1))";
$rs = query($q,array($email,hashPass($pass)),'s','Login User Query');
if (!$rs) {
	$_SESSION['message'] = '<div id="message">Invalid login information. Please try again.</div>';
	header("Location:login.php");
	exit;
} else {
	$_SESSION['uID'] = $rs[0]['uID'];
	$_SESSION['fName'] = $rs[0]['fName'];
	$_SESSION['lName'] = $rs[0]['lName'];
	$_SESSION['message'] = '<div id="message">You are now logged in.</div>';
	if ($url) {
		header("Location:".$url);
	} else {
		header("Location:my-account.php");
	}
	exit;
}
?>