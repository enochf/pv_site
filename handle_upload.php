<?php
session_start();
include("includes/inc_connection.php");
include("includes/inc_functions.php");
include("includes/inc_arrays.php");
// checkSession();
set_time_limit(0);
$sid = cleanVar($_POST['sid']);
$uid = $_SESSION['uID'];
$type = cleanVar($_POST['type']);
$addins = $_FILES['addins']['tmp_name'];
if ($addins) {
	$allVals = getMyVals();
	$vals = $allVals[0];
	$file = fopen($addins, "r") or exit("Unable to open addins.xls file!");
	$n = 0;
	while(!feof($file)) {
		$cells[$n] = explode(",", fgets($file));
		$n++;
	}
	if ($cells[0][0] != "Multipliers and PCE For JEDI PV Model Analysis" OR $cells[4][2] != "MyCounty" OR $cells[4][3] != "MyRegion") {
		$_SESSION['message'] = '<div id="message15">The information in your file was not formatted properly.<br />Please use the <strong>multipliers_template.csv</strong> to add custom multipliers.</div>';
		header("Location:model.php?sid=".$sid);
		exit;
	}
	if ($type == "MyCounty") {
		$kn = 2;
	} else {
		$kn = 3;
		$region = 22; // USER FOR ADDING 22 TO THE CELL NUMBER
	}
	$k = 4;
	for ($i = 6; $i <= 14; $i++) {
		for ($x = 1; $x <= 22; $x++) {
			if (is_numeric($cells[$k + $x][$kn])) {
				$vals['d_ds'.$i.'_'.($x + $region)] = $cells[$k + $x][$kn];
			} else {
				$_SESSION['message'] = '<div id="message15">The information in your file was not formatted properly.<br />Please download the template file and make sure that only numeric values are used for the multipliers</div>';
				header("Location:model.php?sid=".$sid);
				exit;
			}
		}
		$k = $k + 25;
	}
	for ($i = 1; $i <= 22; $i++) {
		if (is_numeric($cells[$i + 4][$kn + 3])) {
			$vals['d_ds15_'.($i + $region)] = $cells[$i + 4][$kn + 3];
		} else {
			$_SESSION['message'] = '<div id="message15">The information in your file was not formatted properly.<br />Please download the template file and make sure that only numeric values are used for the multipliers</div>';
			header("Location:model.php?sid=".$sid);
			exit;
		}
	}
	if ($sid AND $_SESSION['uID']) {
		$q = "UPDATE scenarios SET vals=? WHERE ((sid=?) AND (uid=?))";
		query($q,array(json_encode($vals),$sid,$uid),'u','Update Scenario Vals from Upload');
	} else {
		$_SESSION['tmp'][0] = $vals;
	}
	$_SESSION['message'] = '<div id="message">Your custom multipliers have been uploaded successfully.</div>';
	header("Location:model.php?sid=".$sid);
	exit;
} else {
	$_SESSION['message'] = '<div id="message">Please select a file to upload.</div>';
	header("Location:model.php?sid=".$sid);
	exit;
}
?>