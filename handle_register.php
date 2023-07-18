<?php
session_start();
include("includes/inc_connection.php");
include("includes/inc_functions.php");
$fName = cleanVar($_POST['fName']);
$lName = cleanVar($_POST['lName']);
$email = cleanVar($_POST['email']);
$pass1 = cleanVar($_POST['pass1']);
$pass2 = cleanVar($_POST['pass2']);
$_SESSION['fName'] = $fName;
$_SESSION['lName'] = $lName;
$_SESSION['email'] = $email;
if (isEmail($email) == false) {
	$_SESSION['message'] = '<div id="message">Please enter a valid email address.</div>';
	header("Location:register.php");
	exit;
}
if ($pass1 != $pass2) {
	$_SESSION['message'] = '<div id="message">Please confirm your password.</div>';
	header("Location:register.php");
	exit;
}
if (!$fName OR !$lName OR !$email OR !$pass1) {
	$_SESSION['message'] = '<div id="message">Please fill in all required fields.</div>';
	header("Location:register.php");
	exit;
}
$q = "SELECT uID FROM users WHERE (email=?)";
$rs = query($q,array($email),'s','Check User Accounts');
if ($rs) {
	$_SESSION['message'] = '<div id="message">There is already an account with the email provided.</div>';
	header("Location:register.php");
	exit;
} else {
	$q = "INSERT INTO users VALUES('0','".$fName."','".$lName."','".$email."','".hashPass($pass1)."','1')";
	$_SESSION['uID'] = query($q,array($fName,$lName,$email,hashPass($pass1)),'i','Insert New Account Registration');
	$_SESSION['message'] = '<div id="message">Thank you for registering. You can now save and share scenarios.</div>';
	header("Location:model.php");
	exit;
}
?>