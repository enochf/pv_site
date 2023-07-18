<?php
session_start();
include("includes/inc_connection.php");
include("includes/inc_arrays2.php");
include("includes/inc_functions2.php");
$sid = $_GET['sid'];
if ($sid == '') {
	$sid = 'unsaved';
}
$id = $_GET['id'];
$val = $_GET['val'];
list($sheet,$cell) = explode("_",$inputs[$id]);
$_SESSION['inputs'][$sid][$sheet][$cell] = $val;
// ================= CONDITIONAL EXCEPTIONS ================= //
if($id == 'pdd_solar_cell_module_material' AND $val == 'Thin Film') {
	$_SESSION['inputs'][$sid][$sheet]['B17'] = 'Fixed Mount';
}
// =============== END CONDITIONAL EXCEPTIONS =============== //
if($sid != 0 AND $_SESSION['uID']) {
	$q = "UPDATE scenarios SET vals=? WHERE sID=? AND uID=?";
	$arrays = array(serialize($_SESSION['inputs'][$sid]),$sid,$_SESSION['uID']);
	query($q,$arrays,'u','Update User Values');
}
?>