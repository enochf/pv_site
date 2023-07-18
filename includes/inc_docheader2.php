<?php
ini_set('memory_limit','256M');
// ini_set('display_errors',1);
// error_reporting(E_ALL);
session_start();
$root = '';
include('includes/inc_connection.php');
require("includes/inc_functions2.php");
$uid = $_SESSION['uID'];
$sid = $_GET['sid'];
$key = $_GET['key'];
if ($sid AND !is_numeric($sid) AND $sid != 'unsaved') {
	$_SESSION['message'] = '<div id="message">You do not have access to the selected model run 1</div>';
	unset($sid);
}
if ($sid == '') {
	$sid = 'unsaved';
}
if ($key AND !ctype_alnum($key)) {
	$_SESSION['message'] = '<div id="message">You do not have access to view this model run. 2</div>';
	header("Location:model.php");
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html> 
<head> 
	<title>PV JEDI - Jobs and Economic Development Impacts (JEDI) Photovoltaics (PV)</title> 
	<meta http-equiv="content-type" content="text/html;charset=utf-8" /> 
	<meta http-equiv="Content-Style-Type" content="text/css" /> 
	<meta name="description" content="PV JEDI - Jobs and Economic Development Impacts (JEDI) Photovoltaics (PV)" /> 
	<meta name="title" content="PV JEDI - Jobs and Economic Development Impacts (JEDI) Photovoltaics (PV)" /> 
	<meta name="keywords" content="PV JEDI - Jobs and Economic Development Impacts (JEDI) Photovoltaics (PV)" /> 
	<link rel="stylesheet" href="css/reset.css" type="text/css" /> 
	<link rel="stylesheet" href="css/main.css" type="text/css" /> 
	<?php
	if ($_SERVER['PHP_SELF'] == '/index.php') {
		echo '<link rel="stylesheet" href="css/home.css" type="text/css" />
		';
	} else {
		echo '<link rel="stylesheet" href="css/t2.css" type="text/css" />
		';
	}
	switch($_SERVER['PHP_SELF']) {
		case $root.'/model.php':
			echo '<link rel="stylesheet" href="css/model.css" type="text/css" />
			';
			break;
		case $root.'/results.php':
			echo '<link rel="stylesheet" href="css/results.css" type="text/css" />
			';
			break;
		case $root.'/register.php':
		case $root.'/login.php':
			echo '<link rel="stylesheet" href="css/register.css" type="text/css" />
			';
			break;
		case $root.'/my-account.php':
			echo '<link rel="stylesheet" href="css/account.css" type="text/css" />
			';
			break;
	}
	?>
	<!--[if IE]>
		<link rel="stylesheet" href="css/ie.css" />
	<![endif]--> 
	<script type="text/javascript" src="js/jquery_1.4.2.js"></script> 
	<script type="text/javascript" src="js/jquery.livequery.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script> 
	<?php
	if ($_SERVER['PHP_SELF'] == $root.'/model.php') {
		echo '<script type="text/javascript">
			var cur;
			$(document).ready(function(){		
				$("#pdd input[type=\'text\'],#pcd input[type=\'text\'],#pdd select,#pcd select").livequery("focus", function(event) {
					cur = $(this).val();
				});
				$("#pdd input[type=\'text\'],#pcd input[type=\'text\'],#pdd select,#pcd select").livequery("change", function(event) {
					if ($(this).hasClass("int")) {
						var intRegex = /^(\d|,)*\.?\d*$/;
						if(!intRegex.test($(this).val())) {
							$(this).val(cur);
							alert("Please enter a positive number");
							return false;
						}
					}
					if ($(this).hasClass("pct")) {
						if ($(this).val() > 100) {
							$(this).val(cur);
							alert("Please enter a valid percentage between 0 and 100");
							return false;
						}
						newVal = $(this).val() / 100;
					} else {
						newVal = $(this).val();
					}
					
					$.get("handle_inputs.php?sid='.$sid.'&id=" + $(this).attr("id") + "&val=" + escape(newVal));
					$("#inputs").load("includes/inc_inputs2.php?sid='.$sid.'");
					$(".load").show(\'fast\');
				}); 
			});
		</script>
		';
	}
	?>
	<script type="text/javascript">
		$(document).ready(function(){		
			if ($("#message").is(":visible")) {
				t = setTimeout(function(){ 
					$("#message").slideUp("fast") 
				}, 4000); 
			}
			if ($("#message10").is(":visible")) {
				t = setTimeout(function(){ 
					$("#message10").slideUp("fast") 
				}, 10000); 
			}
			if ($("#message15").is(":visible")) {
				t = setTimeout(function(){ 
					$("#message15").slideUp("fast") 
				}, 15000); 
			}
		});
	</script>
	<?php
	if ($_SERVER['HTTP_HOST'] == 'jedi.nrel.gov') {
		echo '<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push([\'_setAccount\', \'UA-5561559-16\']);
			_gaq.push([\'_trackPageview\']);

			(function() {
				var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
				ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
				var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
		';
	}
	?>
</head> 
<body>