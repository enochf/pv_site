<?php
session_start();
session_destroy();
session_start();
$_SESSION['message'] = '<div id="message">You are now logged out.</div>';
header("Location:index.php");
exit;
?>