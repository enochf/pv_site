<?php
session_start();
include("includes/inc_connection.php");
include("includes/inc_functions2.php");
$pass1 = cleanVar($_POST['pass1']);
$pass2 = cleanVar($_POST['pass2']);
if (!$pass1) {
	$_SESSION['message'] = '<div id="message">Please fill in all required fields.</div>';
	header("Location:my-account.php");
	exit;
}
if ($pass1 != $pass2) {
	$_SESSION['message'] = '<div id="message">Please confirm your new password.</div>';
	header("Location:my-account.php");
	exit;
}
if ($_SESSION['uID']) {
	$q = "UPDATE users SET pass=? WHERE uID=?";
	$vars = array(hashPass($pass1),$_SESSION['uID']);
	query($q,$vars,'u','Update Password');
	$_SESSION['message'] = '<div id="message">Your password has been updated successfully.</div>';
	header("Location:my-account.php");
} else {
	$_SESSION['message'] = '<div id="message">Please login to access your account.</div>';
	header("Location:login.php");
	exit;
}
?>