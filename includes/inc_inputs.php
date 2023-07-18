<?php
if ($f != 1) {
	session_start();
	include('inc_connection.php');
	require("inc_functions.php");
	$uid = $_SESSION['uID'];
	$sid = cleanVar($_GET['sid']);
	if ($sid AND !is_numeric($sid)) {
		$_SESSION['message'] = '<div id="message">You do not have access to the selected model run</div>';
		unset($sid);
	}
	// $start = elapseTime();
	require("inc_arrays.php");
	require("class_calculations.php");
} else {
	// $start = elapseTime();
	require("includes/inc_arrays.php");
	require("includes/class_calculations.php");
}
// GET USER CHANGED VALUES FOR SCENARIO
$allVals = getMyVals();
$vals = $allVals[0];
$hl = $allVals[1];
// GET BASE DATA FROM DATABASE
$x = getBaseData();
// GET DEFAULT SCENARIO DATA
$d = getDefaultData();
// CHECK FOR RESET DATA REQUEST
// if ($_POST['reset'] == 1) {
	// $_SESSION['inputs'] = getDefaultData();
// }
if ($id = $_GET['id']) {
	// CHECK FOR SAVED 
	$val = str_replace(",", "", $_GET['val']);
	if ($id != '') {
		$vals[$id] = $val;
		$hl[$id] = 'highlight';
		if ($id == "d_ds1_5") {
			if ($val == "Thin Film") {
				$vals['d_ds1_6'] = "Fixed Mount";
			}
		}
	} else {
		unset($vals[$id],$hl[$id]);
	}
	if ($sid) {
		$q = "UPDATE scenarios SET vals=? WHERE ((sid=?) AND (uid=?))";
		query($q,array(json_encode($vals),$sid,$uid),'u','Update Scenario Inputs');
	} else {
		$_SESSION['tmp'][0] = $vals;
		$_SESSION['tmp'][1] = $hl;
	}
}
foreach($vals as $k => $v) {
	if (substr($k,0,2) == "d_") {
		list($calc,$ds,$num) = explode("_", $k);
		$d[$ds][$num] = $v;
	}
}
$pv = new pvj($vals,$d,$x,$systemApp,$solarMat,$systemTrack,$link);
$pv->t1();
if ($sid) {
	$q = "SELECT * FROM scenarios WHERE ((sID=?) AND (uID=?))";
	$var = query($q,array($sid,$uid),'s','Get Scenario Info');
} else {
	if ($uid) {
		$var[0]['name'] = '<span id="unsaved"><img src="images/unsaved.gif" alt="unsaved" style="vertical-align:-1px;" /> Unsaved - <a href="javascript:show(\'saverun\')">Click to save</a></span>';
	} else {
		$var[0]['name'] = '<span id="unsaved"><img src="images/unsaved.gif" alt="unsaved" style="vertical-align:-1px;" /> Unsaved - <a href="login.php?url=model.php">login to save</a></span>';
	}
}
if ($sid) {
	echo '<p class="email fr" style="padding:15px 10px 0px 0px;">
		<a href="handle_copyrun.php?sid='.$sid.'" onclick="return confirm(\'Are you sure you want to create a copy of this model run?\')"><img src="images/icon_copy.gif" alt="Copy Model Run" />&nbsp;Copy Model Run</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="mailto:?Subject=JEDI%20PV%20Model%20Run&Body=http://jedi.nrel.gov/model.php?key='.sha1($sid.'pvjed1').'"><img src="images/icon_email.gif" alt="email this" />&nbsp;Share This Model Run</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="my-account.php"><img src="images/icon_runlist.gif" alt="Saved Lists" />&nbsp;Saved Model Runs</a>
	</p>
	';
}
echo '<h1><img src="images/ttl_projectdescdata.gif" alt="Project Descriptive Data" />';
if ($sid) {
	echo '<img src="images/saved.gif" alt="saved" id="saved1" class="saved" />';
}
echo $_SESSION['message'];
unset($_SESSION['message']);
// ========================================================================= Get Tool Tips //
$q = "SELECT * FROM tooltips";
foreach(query($q,array(),'s','Get Tool Tips') as $t) {
	$tip[$t['tID']] = $t['tip'];
}
// ========================================================================= Save Current Model Run //
echo '<img src="images/loading.gif" alt="loading" id="load1" class="load" /></h1>
<div id="saverun" class="dropdown"'.($_SESSION['openname']==1 ? ' style="display:block;"' : '').'>
	<a href="javascript:hide(\'saverun\')"><img src="images/drop_close.gif" alt="close" class="fr" /></a>
	<h2>Save Model Run</h2>
	<form action="handle_saverun.php" method="post">
	<label>Model Run Name:</label>
	<input type="text" name="name" value="" class="txt" />
	<div class="clr"></div>
	<label>&nbsp;</label>
	<input type="submit" value="Save Run" class="btn" />
	<div class="clr"></div>
	</form>
</div>
';
unset($_SESSION['openname']);


// ================================================================= DEBUGGING ======//
// if ($_SESSION['uID'] == 1) {
	// $ds = "ds23";
	// if ($f != 1) {
		// require("inc_debug.php");
	// } else {
		// require("includes/inc_debug.php");
	// }
	// echo $pv->t7c['ds25'][10].'<br />'.$pv->t7c['ds25'][11].'<br />'.$pv->t6c['ds26'][212].'<br /><br />';
	// echo '<br /><br /><strong>									  ds23: </strong><br />'; 
	// echo '<br /><br /><strong>default: </strong>';print_r($pv->d['ds23']);
	// echo '<br /><br /><strong>t1c: </strong>';  print_r($pv->t1c['ds23']);
	// echo '<br /><br /><strong>t2c: </strong>';  print_r($pv->t2c['ds23']);
	// echo '<br /><br /><strong>t3c: </strong>';  print_r($pv->t3c['ds23']);
	// echo '<br /><br /><strong>t4c: </strong>';  print_r($pv->t4c['ds23']);
	// echo '<br /><br /><strong>t5c: </strong>';  print_r($pv->t5c['ds23']);
	// echo '<br /><br /><strong>t6c: </strong>';  print_r($pv->t6c['ds23']);
	// echo '<br /><br /><strong>t7c: </strong>';  print_r($pv->t7c['ds23']);
	// echo '<br /><br /><strong>Vals: </strong>';  
	// print_r($pv->vals);
	// echo '<br /><br /><strong>Session: </strong>';  
	// print_r($_SESSION);
	// echo '<br /><br /><strong>Tips: </strong>';  
	// print_r($tip);
// }
// echo '<br /><br />';
// ================================================================= END DEBUGGING ==//


// ========================================================================= User Add-In Data //
if ($pv->d['ds1'][1] == "MyCounty" OR $pv->d['ds1'][1] == "MyRegion") {
	if ($pv->d['ds1'][1] == "MyCounty" AND $pv->d['ds6'][1] != 0) {
		$hide = "hidden";
	} else if ($pv->d['ds1'][1] == "MyRegion" AND $pv->d['ds6'][23] != 0) {
		$hide = "hidden";
	}
	echo '<div id="addin" class="dropdown" style="display:block;">
		<form action="handle_upload.php" method="post" id="uploadmulitipliers" enctype="multipart/form-data" class="'.$hide.'">
		<div id="dltemp">
			<a href="handle_template.php"><img src="images/download_multipliers.gif" alt="Download Multipliers Template" /></a>
		</div>
		<h2>Multipliers For Economic Input/Output Analysis</h2>
		<p>Upload the <strong>multipliers_template.csv</strong> file after you have added your own multipliers for your county or region.</p>
		<input type="hidden" name="sid" value="'.$sid.'" />
		<input type="hidden" name="type" value="'.$pv->d['ds1'][1].'" />
		<label>Add-In Data File:</label>
		<input type="file" name="addins" value="" />
		<div class="clr"></div>
		<label>&nbsp;</label>
		<input type="submit" value="Upload File" class="btn" />
		<div class="clr"></div>
		</form>
		';
		if ($hide == "hidden") {
			echo '<p id="mymulitpliers" style="margin-bottom:0px;">Multipliers for your county or region have been successfully uploaded. <a href="javascript:show(\'uploadmulitipliers\'); hide(\'mymulitpliers\')">Upload new multipliers</a></p>
			';
		}
	echo '</div>
	';
}
// ========================================================================= Project Descriptive Data //
echo '<div id="pdd">
	<h2 class="current">
	';
		if ($_SESSION['uID']) {
			echo '<a href="my-account.php" class="fr" style="margin-right:10px; font-size:12px;"><strong><span style="color:#00345E; font-size:16px;">&#187;</span> My Saved Model Runs</strong></a>
			';
		}
		echo '<strong>Current Model Run:</strong> <em>'.$var[0]['name'].'</em>
	</h2>
	<div id="results" class="fr">
		<h2>Would you like to add custom Project Cost Data?</h2>
		';
		if ($pv->d['ds1'][9] != "Y") {
			echo '<p class="fr" style="padding:7px 70px 0px 0px;">(edit cost data below)</p>
			';
		}
		echo '<select name="d_ds1_9" id="d_ds1_9" class="'.$hl['d_ds1_9'].'">
		';
		if ($pv->d['ds1'][9] == "Y") {
			echo '<option value="Y" selected="selected">No</option>
			<option value="N" onclick="scrollWin(\'costdata\')">Yes</option>
			';
			$yes = 1;
		} else {
			echo '<option value="Y">No</option>
			<option value="N" selected="selected">Yes</option>
			';
			$yes = 0;
		}
		echo '</select><br /><br />
		<div id="viewresults">
			<img src="images/arrow_lg.png" alt="" />
			';
			if ($sid) {
				echo '<a href="results.php?sid='.$sid.'"><span class="hidden">View Results Summary</span></a>
				';
			} else {
				echo '<a href="results.php"><span class="hidden">View Results Summary</span></a>
				';
			}
		echo '</div>
		<p>Click on the button below to restore the default data fields.</p>
		<p><a href="handle_reset.php?sid='.$sid.'" id="reset" onclick="return confirm(\'Are you sure you want to restore the default values?\n\nYour current data will be lost.\')"><span class="hidden">Reset Default Values</span></a></p>
		';
		// echo '<p>Total Calculation Count: '.number_format((count($d, COUNT_RECURSIVE) + count($x, COUNT_RECURSIVE) + count($pv->t1c, COUNT_RECURSIVE) + count($pv->t2c, COUNT_RECURSIVE) + count($pv->t3c, COUNT_RECURSIVE) + count($pv->t4c, COUNT_RECURSIVE) + count($pv->t5c, COUNT_RECURSIVE) + count($pv->t6c, COUNT_RECURSIVE) + count($pv->t7c, COUNT_RECURSIVE) + count($pv->sr1c, COUNT_RECURSIVE))).'</p>
		// ';
	echo '</div>
	<form action="results.php" method="post">
	<label>
		<select name="d_ds1_1" id="d_ds1_1" class="'.$hl['d_ds1_1'].'">
		<optgroup label="Custom Model Run">
			';
			if ($pv->d['ds1'][1] == "MyCounty" OR $pv->d['ds1'][1] == "MyRegion") {
				if ($pv->d['ds1'][1] == "MyCounty") {
					echo '<option value="MyCounty" selected="selected" onclick="scrollWin(\'addin\');">My County</option>
					<option value="MyRegion" onclick="scrollWin(\'addin\');">My Region</option>
					';
				} else if ($pv->d['ds1'][1] == "MyRegion") {
					echo '<option value="MyCounty" onclick="scrollWin(\'addin\');">My County</option>
					<option value="MyRegion" selected="selected" onclick="scrollWin(\'addin\');">My Region</option>
					';
				}
			} else {
				echo '<option value="MyCounty" onclick="scrollWin(\'addin\');">My County</option>
				<option value="MyRegion" onclick="scrollWin(\'addin\');">My Region</option>
				';
			}
		echo '</optgroup>
		<optgroup label="Statewide Model Run">
		';
		foreach($states as $k => $v) {
			if ($k == $pv->d['ds1'][1]) {
				echo '<option value="'.$k.'" selected="selected">'.$v.'</option>
				';
			} else {
				echo '<option value="'.$k.'">'.$v.'</option>
				';
			}
		}
		echo '</optgroup>
		<optgroup label="Predefined Model Run">
		';
		foreach($regions as $k => $v) {
			if ($k == $pv->d['ds1'][1]) {
				echo '<option value="'.$k.'" selected="selected">'.$v.'</option>
				';
			} else {
				echo '<option value="'.$k.'">'.$v.'</option>
				';
			}
		}
		echo '</optgroup>
		</select>
		Project Location '.tip('pdd_1').'
	</label>
	';
	// -------------------------------------------------------------------------------- My County / My Region Info ----------- //
	if ($pv->d['ds1'][1] == "MyCounty" OR $pv->d['ds1'][1] == "MyRegion") {
		echo '<div id="addinextras">
			';
			if ($pv->d['ds1'][1] == "MyCounty") {
				echo '<label>
					<input type="text" name="d_ds4_1" id="d_ds4_1" value="'.$pv->d['ds4'][1].'" size="" class="'.$hl['d_ds4_1'].'" />
					My County Name
				</label>
				<label>
					<input type="text" name="d_ds5_1" id="d_ds5_1" value="'.$pv->d['ds5'][1].'" size="" class="int '.$hl['d_ds5_1'].'" />
					Year of Data (required)
				</label>
				';
			} else {
				echo '<label>
					<input type="text" name="d_ds4_2" id="d_ds4_2" value="'.$pv->d['ds4'][2].'" size="" class="'.$hl['d_ds4_2'].'" />
					My Region Name
				</label>
				<label>
					<input type="text" name="d_ds5_2" id="d_ds5_2" value="'.$pv->d['ds5'][2].'" size="" class="int '.$hl['d_ds5_2'].'" />
					Year of Data (required)
				</label>
				';
			}
			echo '<label>
				<input type="text" name="d_ds1_2" id="d_ds1_2" value="'.$pv->d['ds1'][2].'" size="" class="int '.$hl['d_ds1_2'].'" />
				Population (required) '.tip('pdd_2').'
			</label>
			<label>
				<input type="text" name="d_ds4_3" id="d_ds4_3" value="'.$pv->d['ds4'][3].'" size="" class="int '.$hl['d_ds4_3'].'" />
				Sales Tax Rate %
			</label>
			<label>
				<input type="text" name="d_ds4_4" id="d_ds4_4" value="'.$pv->d['ds4'][4].'" size="" class="int '.$hl['d_ds4_4'].'" />
				Sales Tax Exemption %
			</label>
			<label>
				<input type="text" name="d_ds4_5" id="d_ds4_5" value="'.$pv->d['ds4'][5].'" size="" class="int '.$hl['d_ds4_5'].'" />
				Property Tax Exemption %
			</label>
		</div>
		';
	}
	// --------------------------------------------------------------------------------  END My County / My Region Info ----------- //
	echo '<label>
		<input type="text" name="d_ds1_3" id="d_ds1_3" value="'.$pv->d['ds1'][3].'" size="" class="int '.$hl['d_ds1_3'].'" />
		Year of Construction or Installation '.tip('pdd_3').'
	</label>
	<label>
		<select name="d_ds1_4" id="d_ds1_4" class="'.$hl['d_ds1_4'].'">
		';
		foreach($systemApp as $k => $v) {
			if ($v == $pv->d['ds1'][4]) {
				echo '<option value="'.$v.'" selected="selected">'.$v.'</option>
				';
			} else {
				echo '<option value="'.$v.'">'.$v.'</option>
				';
			}
		}
		echo '</select>
		System Application
	</label>
	<label>
		<select name="d_ds1_5" id="d_ds1_5" class="'.$hl['d_ds1_5'].'">
		';
		foreach($solarMat as $k => $v) {
			if ($v == $pv->d['ds1'][5]) {
				echo '<option value="'.$v.'" selected="selected">'.$v.'</option>
				';
			} else {
				echo '<option value="'.$v.'">'.$v.'</option>
				';
			}
		}
		echo '</select>
		Solar Cell/Module Material
	</label>
	<label>
		';
		if ($pv->d['ds1'][5] == "Thin Film") {
			echo '<select name="d_ds1_6" id="d_ds1_6" disabled="disabled">
			';
			foreach($systemTrack as $k => $v) {
				if ($v == "Fixed Mount") {
					echo '<option value="'.$v.'" selected="selected">'.$v.'</option>
					';
				} else {
					echo '<option value="'.$v.'">'.$v.'</option>
					';
				}
			}
		} else {
			echo '<select name="d_ds1_6" id="d_ds1_6" class="'.$hl['d_ds1_6'].'">
			';
			foreach($systemTrack as $k => $v) {
				if ($v == $pv->d['ds1'][6]) {
					echo '<option value="'.$v.'" selected="selected">'.$v.'</option>
					';
				} else {
					echo '<option value="'.$v.'">'.$v.'</option>
					';
				}
			}
		}
		echo '</select>
		System Tracking
	</label>
	<label><input type="text" name="t1c_ds1_1" id="t1c_ds1_1" value="'.number_format($pv->t1c['ds1'][1],1).'" size="" class="int '.$hl['t1c_ds1_1'].'" />
		Average System Size - DC Nameplate Capacity (KW) '.tip('pdd_4').'
	</label>
	<label>
		<input type="text" name="t2c_ds1_1" id="t2c_ds1_1" value="'.number_format($pv->t2c['ds1'][1],1).'" size="" class="int '.$hl['t2c_ds1_1'].'" />
		Number of Systems Installed
	</label>
	<label>
		<input type="text" name="t2c_ds1_2" id="t2c_ds1_2" value="'.number_format($pv->t2c['ds1'][2],1).'" size="" class="readonly" readonly="readonly" />
		Total Project Size - DC Nameplate Capacity (KW) '.tip('pdd_5').'
	</label>
	<label>
		<input type="text" name="t2c_ds1_3" id="t2c_ds1_3" value="'.number_format($pv->t2c['ds1'][3],0).'" size="" class="int '.$hl['t2c_ds1_3'].'" />
		Base Installed System Cost ($/KWDC) '.tip('pdd_6').'
	</label>
	<label>
		<input type="text" name="t2c_ds1_4" id="t2c_ds1_4" value="'.number_format($pv->t2c['ds1'][4],2).'" size="" class="int '.$hl['t2c_ds1_4'].'" />
		Annual Direct Operations and Maintenance Cost ($/kW) '.tip('pdd_7').'
	</label>
	<label>
		<input type="text" name="d_ds1_8" id="d_ds1_8" value="'.$pv->d['ds1'][8].'" size="" class="int '.$hl['d_ds1_8'].'" />
		Money Value - Current or Constant (Dollar Year) '.tip('pdd_8').'
	</label>
	</form>
</div><!-- END: pdd -->
';
// ========================================================================= Project Cost Data //
if ($pv->d['ds1'][9] == "Y") {
	echo '<a id="costdata"></a>
	<div class="fr changed">Changed Fields <img src="images/changedfield.gif" alt="changed field" /></div>
	<h1><img src="images/ttl_projectcostdata.gif" alt="Project Cost Data" /></h1>
	<div id="pcd">
		<p><strong>You are currently using the default Project Cost Data.</strong></p>
		<p>If you would like to be able to add your own cost data figures then simply answer "Yes" to the question in the section above.<p>
	</div>
	';
} else {
	echo '<div class="fr changed">Changed Fields <img src="images/changedfield.gif" alt="changed field" /></div>
	<h1><img src="images/ttl_projectcostdata.gif" alt="Project Cost Data" /></h1>
	<div id="pcd">
		<h2>Installation Costs '.tip('pcd_1');
		if ($sid) {
			echo '<img src="images/saved_gray.gif" alt="saved" id="saved2" class="saved" />';
		}
		echo '<img src="images/loading_gray.gif" alt="loading" id="load2" class="load" /></h2>
		<table>
			<tr>
				<td></td>
				<td class="highlight">Cost</td>
				<td>Cost<br />Per KW</td>
				<td class="highlight">Percent of<br />Total Cost</td>
				<td>Purchased<br />Locally (%) '.tip('pcd_2').'</td>
				<td class="highlight">Manufactured<br />Locally (%)</td>
			</tr>
			<tr>
				<th colspan="6">Materials &amp; Equipment</td>
			</tr>
			<tr>
				<td class="ind1">Mounting (Rails, Clamps, Fittings, etc.)</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][1]).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['t4c_ds2_4'].'" name="t4c_ds2_4" id="t4c_ds2_4" value="'.number_format($pv->t4c['ds2'][4]).'" /></td>
					';
				} else {
					echo '<td>$'.number_format($pv->t4c['ds2'][4]).'</td>
					';
				}
				echo '<td class="highlight">'.number_format(($pv->t5c['ds2'][29] * 100),1).'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['t3c_ds2_1'].'" name="t3c_ds2_1" id="t3c_ds2_1" value="'.number_format(($pv->t3c['ds2'][1] * 100),0).'" />%</td>
					';
				} else {
					echo '<td>'.number_format(($pv->t3c['ds2'][1] * 100),0).'%</td>
					';
				}
				if ($yes == 0) {
					echo '<td class="highlight">
					<select name="t1c_ds2_12" id="t1c_ds2_12" class="'.$hl['t1c_ds2_12'].'">
					';
					if ($pv->t1c['ds2'][12] == "Y") {
						echo '<option value="Y" selected="selected">Yes</option>
						<option value="N">No</option>
						';
					} else {
						echo '<option value="Y">Yes</option>
						<option value="N" selected="selected">No</option>
						';
					}
					echo '</select>
					</td>
					';
				} else {
					echo '<td class="highlight">'.$pv->t1c['ds2'][12].'</td>
					';
				}
			echo '</tr>
			<tr>
				<td class="ind1">Modules</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][2]).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['t4c_ds2_5'].'" name="t4c_ds2_5" id="t4c_ds2_5" value="'.number_format($pv->t4c['ds2'][5]).'" /></td>
					';
				} else {
					echo '<td>$'.number_format($pv->t4c['ds2'][5]).'</td>
					';
				}
				echo '<td class="highlight">'.number_format(($pv->t5c['ds2'][30] * 100),1).'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['t3c_ds2_2'].'" name="t3c_ds2_2" id="t3c_ds2_2" value="'.number_format(($pv->t3c['ds2'][2] * 100),0).'" />%</td>
					';
				} else {
					echo '<td>'.number_format(($pv->t3c['ds2'][2] * 100),0).'%</td>
					';
				}
				if ($yes == 0) {
					echo '<td class="highlight">
					<select name="t1c_ds2_13" id="t1c_ds2_13" class="'.$hl['t1c_ds2_13'].'">
					';
					if ($pv->t1c['ds2'][13] == "Y") {
						echo '<option value="Y" selected="selected">Yes</option>
						<option value="N">No</option>
						';
					} else {
						echo '<option value="Y">Yes</option>
						<option value="N" selected="selected">No</option>
						';
					}
					echo '</select>
					</td>
					';
				} else {
					echo '<td class="highlight">'.$pv->t1c['ds2'][13].'</td>
					';
				}
			echo '</tr>
			<tr>
				<td class="ind1">Electrical (Wire, Connectors, Breakers, etc.)</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][3]).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['t4c_ds2_6'].'" name="t4c_ds2_6" id="t4c_ds2_6" value="'.number_format($pv->t4c['ds2'][6]).'" /></td>
					';
				} else {
					echo '<td>$'.number_format($pv->t4c['ds2'][6]).'</td>
					';
				}
				echo '<td class="highlight">'.number_format(($pv->t5c['ds2'][31] * 100),1).'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['t3c_ds2_3'].'" name="t3c_ds2_3" id="t3c_ds2_3" value="'.number_format(($pv->t3c['ds2'][3] * 100),0).'" />%</td>
					';
				} else {
					echo '<td>'.number_format(($pv->t3c['ds2'][3] * 100),0).'%</td>
					';
				}
				if ($yes == 0) {
					echo '<td class="highlight">
					<select name="t1c_ds2_14" id="t1c_ds2_14" class="'.$hl['t1c_ds2_14'].'">
					';
					if ($pv->t1c['ds2'][14] == "Y") {
						echo '<option value="Y" selected="selected">Yes</option>
						<option value="N">No</option>
						';
					} else {
						echo '<option value="Y">Yes</option>
						<option value="N" selected="selected">No</option>
						';
					}
					echo '</select>
					</td>
					';
				} else {
					echo '<td class="highlight">'.$pv->t1c['ds2'][14].'</td>
					';
				}
			echo '</tr>
			<tr>
				<td class="ind1">Inverter</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][4]).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['t4c_ds2_7'].'" name="t4c_ds2_7" id="t4c_ds2_7" value="'.number_format($pv->t4c['ds2'][7]).'" /></td>
					';
				} else {
					echo '<td>$'.number_format($pv->t4c['ds2'][7]).'</td>
					';
				}
				echo '<td class="highlight">'.number_format(($pv->t5c['ds2'][32] * 100),1).'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['t3c_ds2_4'].'" name="t3c_ds2_4" id="t3c_ds2_4" value="'.number_format(($pv->t3c['ds2'][4] * 100),0).'" />%</td>
					';
				} else {
					echo '<td>'.number_format(($pv->t3c['ds2'][4] * 100),0).'%</td>
					';
				}
				if ($yes == 0) {
					echo '<td class="highlight">
					<select name="t1c_ds2_15" id="t1c_ds2_15" class="'.$hl['t1c_ds2_15'].'">
					';
					if ($pv->t1c['ds2'][15] == "Y") {
						echo '<option value="Y" selected="selected">Yes</option>
						<option value="N">No</option>
						';
					} else {
						echo '<option value="Y">Yes</option>
						<option value="N" selected="selected">No</option>
						';
					}
					echo '</select>
					</td>
					';
				} else {
					echo '<td class="highlight">'.$pv->t1c['ds2'][15].'</td>
					';
				}
			echo '</tr>
			<tr>
				<td class="ind1">Subtotal</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][5]).'</td>
				<td>$'.number_format($pv->t4c['ds2'][8]).'</td>
				<td class="highlight">'.number_format(($pv->t5c['ds2'][33] * 100),1).'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>
			<tr>
				<th colspan="6">Labor</td>
			</tr>
			<tr>
				<td class="ind1">Installation</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][6]).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['t4c_ds2_9'].'" name="t4c_ds2_9" id="t4c_ds2_9" value="'.number_format($pv->t4c['ds2'][9]).'" /></td>
					';
				} else {
					echo '<td>$'.number_format($pv->t4c['ds2'][9]).'</td>
					';
				}
				echo '<td class="highlight">'.number_format(($pv->t5c['ds2'][34] * 100),1).'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['t3c_ds2_5'].'" name="t3c_ds2_5" id="t3c_ds2_5" value="'.number_format(($pv->t3c['ds2'][5] * 100),0).'" />%</td>
					';
				} else {
					echo '<td>'.number_format(($pv->t3c['ds2'][5] * 100),0).'%</td>
					';
				}
				echo '<td class="highlight"></td>
			</tr>
			<tr>
				<td class="ind1">Subtotal</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][7]).'</td>
				<td>$'.number_format($pv->t4c['ds2'][10]).'</td>
				<td class="highlight">'.number_format(($pv->t5c['ds2'][35] * 100),1).'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>
			<tr class="bld">
				<td>Total</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][8]).'</td>
				<td>$'.number_format($pv->t4c['ds2'][11]).'</td>
				<td class="highlight">'.number_format(($pv->t5c['ds2'][36] * 100),1).'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>
			<tr>
				<th colspan="6">Other Costs</td>
			</tr>
			<tr>
				<td class="ind1">Permitting</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][9]).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['t4c_ds2_12'].'" name="t4c_ds2_12" id="t4c_ds2_12" value="'.number_format($pv->t4c['ds2'][12]).'" /></td>
					';
				} else {
					echo '<td>$'.number_format($pv->t4c['ds2'][12]).'</td>
					';
				}
				echo '<td class="highlight">'.number_format(($pv->t5c['ds2'][37] * 100),1).'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['t3c_ds2_6'].'" name="t3c_ds2_6" id="t3c_ds2_6" value="'.number_format(($pv->t3c['ds2'][6] * 100),0).'" />%</td>
					';
				} else {
					echo '<td>'.number_format(($pv->t3c['ds2'][6] * 100),0).'%</td>
					';
				}
				echo '<td class="highlight"></td>
			</tr>
			<tr>
				<td class="ind1">Other Costs '.tip('pcd_3').'</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][10]).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['t4c_ds2_13'].'" name="t4c_ds2_13" id="t4c_ds2_13" value="'.number_format($pv->t4c['ds2'][13]).'" /></td>
					';
				} else {
					echo '<td>$'.number_format($pv->t4c['ds2'][13]).'</td>
					';
				}
				echo '<td class="highlight">'.number_format(($pv->t5c['ds2'][38] * 100),1).'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['t3c_ds2_7'].'" name="t3c_ds2_7" id="t3c_ds2_7" value="'.number_format(($pv->t3c['ds2'][7] * 100),0).'" />%</td>
					';
				} else {
					echo '<td>'.number_format(($pv->t3c['ds2'][7] * 100),0).'%</td>
					';
				}
				echo '<td class="highlight"></td>
			</tr>
			<tr>
				<td class="ind1">Business Overhead '.tip('pcd_4').'</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][11]).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['t4c_ds2_14'].'" name="t4c_ds2_14" id="t4c_ds2_14" value="'.number_format($pv->t4c['ds2'][14]).'" /></td>
					';
				} else {
					echo '<td>$'.number_format($pv->t4c['ds2'][14]).'</td>
					';
				}
				echo '<td class="highlight">'.number_format(($pv->t5c['ds2'][39] * 100),1).'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['t3c_ds2_8'].'" name="t3c_ds2_8" id="t3c_ds2_8" value="'.number_format(($pv->t3c['ds2'][8] * 100),0).'" />%</td>
					';
				} else {
					echo '<td>'.number_format(($pv->t3c['ds2'][8] * 100),0).'%</td>
					';
				}
				echo '<td class="highlight"></td>
			</tr>
			<tr>
				<td class="ind1">Subtotal</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][12]).'</td>
				<td>$'.number_format($pv->t4c['ds2'][15]).'</td>
				<td class="highlight">'.number_format(($pv->t5c['ds2'][40] * 100),1).'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>
			<tr>
				<td>Subtotal</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][13]).'</td>
				<td>$'.number_format($pv->t4c['ds2'][16]).'</td>
				<td class="highlight">'.number_format(($pv->t5c['ds2'][41] * 100),1).'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>
			<tr>
				<td>Sales Tax (Materials, &amp; Equipment Purchases) '.tip('pcd_5').'</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight">$<input type="text" class="cost int '.$hl['t5c_ds2_14'].'" name="t5c_ds2_14" id="t5c_ds2_14" value="'.number_format($pv->t5c['ds2'][14]).'" /></td>
					';
				} else {
					echo '<td class="highlight">$'.number_format($pv->t5c['ds2'][14]).'</td>
					';
				}
				echo '<td>$'.number_format($pv->t5c['ds2'][25]).'</td>
				<td class="highlight">'.number_format(($pv->t5c['ds2'][42] * 100),1).'%</td>
				<td>'.number_format(($pv->t3c['ds2'][9] * 100),0).'% '.tip('pcd_6').'</td>
				<td class="highlight"></td>
			</tr>
			<tr class="bld">
				<td>Total</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][15]).'</td>
				<td>$'.number_format($pv->t5c['ds2'][26]).'</td>
				<td class="highlight">'.number_format(($pv->t5c['ds2'][43] * 100),1).'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>
		</table><br /><br />
		';
		// ========================================================================= PV System Annual Operating and Maintenance Costs //
		echo '<h2>PV System Annual Operating and Maintenance Costs';
		if ($sid) {
			echo '<img src="images/saved_gray.gif" alt="saved" id="saved3" class="saved" />';
		}
		echo '<img src="images/loading_gray.gif" alt="loading" id="load3" class="load" /></h2>
		<table>
			<tr>
				<td></td>
				<td class="highlight">Cost</td>
				<td>Cost<br />Per KW</td>
				<td class="highlight">Percent of<br />Total Cost '.tip('pcd_8').'</td>
				<td>Local Share (%) '.tip('pcd_9').'</td>
				<td class="highlight"></td>
			</tr>
			<tr>
				<th colspan="6">Labor '.tip('pcd_7').'</td>
			</tr>
			<tr>
				<td class="ind1">Technicians</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][16]).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['t4c_ds2_17'].'" name="t4c_ds2_17" id="t4c_ds2_17" value="'.number_format($pv->t4c['ds2'][17],2).'" /></td>
					';
				} else {
					echo '<td>$'.number_format($pv->t4c['ds2'][17],2).'</td>
					';
				}
				echo '<td class="highlight">'.number_format(($pv->t5c['ds2'][44] * 100),1).'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['t3c_ds2_10'].'" name="t3c_ds2_10" id="t3c_ds2_10" value="'.number_format(($pv->t3c['ds2'][10] * 100),0).'" />%</td>
					';
				} else {
					echo '<td>'.number_format(($pv->t3c['ds2'][10] * 100),0).'%</td>
					';
				}
				echo '<td class="highlight"></td>
			</tr>
			<tr>
				<td class="ind1">Subtotal</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][17]).'</td>
				<td>$'.number_format($pv->t4c['ds2'][18],2).'</td>
				<td class="highlight">'.number_format(($pv->t5c['ds2'][45] * 100),1).'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>
			<tr>
				<td></td>
				<td class="highlight"></td>
				<td></td>
				<td class="highlight"></td>
				<td>Purchased<br />Locally (%) '.tip('pcd_10').'</td>
				<td class="highlight">Manufactured<br />Localy (Y or N)</td>
			</tr>
			<tr>
				<th colspan="6">Materials &amp; Services</td>
			</tr>
			<tr>
				<td class="ind1">Materials &amp; Equipment</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][18]).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['t4c_ds2_19'].'" name="t4c_ds2_19" id="t4c_ds2_19" value="'.number_format($pv->t4c['ds2'][19],2).'" /></td>
					';
				} else {
					echo '<td>$'.number_format($pv->t4c['ds2'][19],2).'</td>
					';
				}
				echo '<td class="highlight">'.number_format(($pv->t5c['ds2'][46] * 100),1).'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['t3c_ds2_11'].'" name="t3c_ds2_11" id="t3c_ds2_11" value="'.number_format(($pv->t3c['ds2'][11] * 100),0).'" />%</td>
					';
				} else {
					echo '<td>'.number_format(($pv->t3c['ds2'][11] * 100),0).'%</td>
					';
				}
				if ($yes == 0) {
					echo '<td class="highlight">
					<select name="t1c_ds2_16" id="t1c_ds2_16" class="'.$hl['t1c_ds2_16'].'">
					';
					if ($pv->t1c['ds2'][16] == "Y") {
						echo '<option value="Y" selected="selected">Yes</option>
						<option value="N">No</option>
						';
					} else {
						echo '<option value="Y">Yes</option>
						<option value="N" selected="selected">No</option>
						';
					}
					echo '</select>
					</td>
					';
				} else {
					echo '<td class="highlight">'.$pv->t1c['ds2'][16].'</td>
					';
				}
				echo '</tr>
			<tr>
				<td class="ind1">Services</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][19]).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['t4c_ds2_20'].'" name="t4c_ds2_20" id="t4c_ds2_20" value="'.number_format($pv->t4c['ds2'][20],2).'" /></td>
					';
				} else {
					echo '<td>$'.number_format($pv->t4c['ds2'][20],2).'</td>
					';
				}
				echo '<td class="highlight">'.number_format(($pv->t5c['ds2'][47] * 100),1).'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['t3c_ds2_12'].'" name="t3c_ds2_12" id="t3c_ds2_12" value="'.number_format(($pv->t3c['ds2'][12] * 100),0).'" />%</td>
					';
				} else {
					echo '<td>'.number_format(($pv->t3c['ds2'][12] * 100),0).'%</td>
					';
				}
				echo '<td class="highlight"></td>
			</tr>
			<tr>
				<td class="ind1">Subtotal</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][20]).'</td>
				<td>$'.number_format($pv->t4c['ds2'][21],2).'</td>
				<td class="highlight">'.number_format(($pv->t5c['ds2'][48] * 100),1).'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>
			<tr>
				<td>Sales Tax (Materials &amp; Equipment Purchases '.tip('pcd_11').'</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight">$<input type="text" class="cost int '.$hl['t5c_ds2_21'].'" name="t5c_ds2_21" id="t5c_ds2_21" value="'.number_format($pv->t5c['ds2'][21]).'" /></td>
					';
				} else {
					echo '<td class="highlight">$'.number_format($pv->t5c['ds2'][21]).'</td>
					';
				}
				echo '<td>$'.number_format($pv->t5c['ds2'][27],2).'</td>
				<td class="highlight">'.number_format(($pv->t5c['ds2'][49] * 100),1).'%</td>
				<td>'.number_format(($pv->t3c['ds2'][13] * 100),0).'% '.tip('pcd_12').'</td>
				<td class="highlight"></td>
			</tr>
			<tr class="bld">
				<td>Total '.tip('pcd_13').'</td>
				<td class="highlight">$'.number_format($pv->t5c['ds2'][22]).'</td>
				<td>$'.number_format($pv->t5c['ds2'][28],2).'</td>
				<td class="highlight">'.number_format(($pv->t5c['ds2'][50] * 100),1).'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>	
		</table><br /><br />
		';
		// ========================================================================= Other Parameters //
		echo '<h2>Other Parameters';
		if ($sid) {
			echo '<img src="images/saved_gray.gif" alt="saved" id="saved4" class="saved" />';
		}
		echo '<img src="images/loading_gray.gif" alt="loading" id="load4" class="load" /></h2>
		<table>
			<tr>
				<td>Financial Parameters</td>
				<td class="highlight"></td>
				<td>Local Share</td>
			</tr>
			<tr>
				<th colspan="3">Debt Financing</td>
			</tr>
			<tr>
				<td class="ind1">Percentage Financed '.tip('pcd_14').'</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight"><input type="text" class="cost int pct '.$hl['t1c_ds2_1'].'" name="t1c_ds2_1" id="t1c_ds2_1" value="'.number_format(($pv->t1c['ds2'][1] * 100)).'" />%</td>
					';
				} else {
					echo '<td class="highlight">'.number_format(($pv->t1c['ds2'][1] * 100)).'%</td>
					';
				}
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['t1c_ds2_9'].'" name="t1c_ds2_9" id="t1c_ds2_9" value="'.number_format(($pv->t1c['ds2'][9] * 100)).'" />%</td>
					';
				} else {
					echo '<td>'.number_format(($pv->t1c['ds2'][9] * 100)).'%</td>
					';
				}
			echo '</tr>
			<tr>
				<td class="ind1">Years Financed (Term)</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight"><input type="text" class="cost int '.$hl['t1c_ds2_2'].'" name="t1c_ds2_2" id="t1c_ds2_2" value="'.$pv->t1c['ds2'][2].'" /></td>
					';
				} else {
					echo '<td class="highlight">'.$pv->t1c['ds2'][2].'</td>
					';
				}
				echo '<td></td>
			</tr>
			<tr>
				<td class="ind1">Interest Rate</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight"><input type="text" class="cost int pct '.$hl['t1c_ds2_3'].'" name="t1c_ds2_3" id="t1c_ds2_3" value="'.number_format(($pv->t1c['ds2'][3] * 100)).'" />%</td>
					';
				} else {
					echo '<td class="highlight">'.number_format(($pv->t1c['ds2'][3] * 100)).'%</td>
					';
				}
				echo '<td></td>
			</tr>
			<tr>
				<th colspan="6">Tax Parameters</td>
			</tr>
			<tr>
				<td class="ind1">Local Property Tax (Pecent of taxable value) '.tip('pcd_15').'</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight"><input type="text" class="cost int pct '.$hl['t1c_ds2_4'].'" name="t1c_ds2_4" id="t1c_ds2_4" value="'.number_format(($pv->t1c['ds2'][4] * 100),1).'" />%</td>
					';
				} else {
					echo '<td class="highlight">'.number_format(($pv->t1c['ds2'][4] * 100),1).'%</td>
					';
				}
				echo '<td></td>
			</tr>
			<tr>
				<td class="ind1">Assessed Value (Percent of construction cost)</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight"><input type="text" class="cost int pct '.$hl['t1c_ds2_5'].'" name="t1c_ds2_5" id="t1c_ds2_5" value="'.number_format(($pv->t1c['ds2'][5] * 100),1).'" />%</td>
					';
				} else {
					echo '<td class="highlight">'.number_format(($pv->t1c['ds2'][5] * 100),1).'%</td>
					';
				}
				echo '<td></td>
			</tr>
			<tr>
				<td class="ind1">Taxable Value (Percent of assessed value)</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight"><input type="text" class="cost int pct '.$hl['t1c_ds2_6'].'" name="t1c_ds2_6" id="t1c_ds2_6" value="'.number_format(($pv->t1c['ds2'][6] * 100),1).'" />%</td>
					';
				} else {
					echo '<td class="highlight">'.number_format(($pv->t1c['ds2'][6] * 100),1).'%</td>
					';
				}
				echo '<td></td>
			</tr>
			<tr>
				<td class="ind1">Taxable Value</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight">$<input type="text" class="cost int '.$hl['t5c_ds2_23'].'" name="t5c_ds2_23" id="t5c_ds2_23" value="'.number_format($pv->t5c['ds2'][23]).'" /></td>
					';
				} else {
					echo '<td class="highlight">$'.number_format($pv->t5c['ds2'][23]).'</td>
					';
				}
				echo '<td></td>
			</tr>
			<tr>
				<td class="ind1">Property Tax Exemption (Percent of local taxes) '.tip('pcd_16').'</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight"><input type="text" class="cost int pct '.$hl['t4c_ds2_1'].'" name="t4c_ds2_1" id="t4c_ds2_1" value="'.number_format(($pv->t4c['ds2'][1] * 100)).'" />%</td>
					';
				} else {
					echo '<td class="highlight">'.number_format(($pv->t4c['ds2'][1] * 100)).'%</td>
					';
				}
				echo '<td></td>
			</tr>
			<tr>
				<td class="ind1">Local Property Taxes</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight">$<input type="text" class="cost int '.$hl['t5c_ds2_24'].'" name="t5c_ds2_24" id="t5c_ds2_24" value="'.number_format($pv->t5c['ds2'][24]).'" /></td>
					';
				} else {
					echo '<td class="highlight">$'.number_format($pv->t5c['ds2'][24]).'</td>
					';
				}
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['t5c_ds2_24'].'" name="t1c_ds2_10" id="t5c_ds2_24" value="'.number_format(($pv->t1c['ds2'][10] * 100)).'" />%</td>
					';
				} else {
					echo '<td>'.number_format(($pv->t1c['ds2'][10] * 100)).'%</td>
					';
				}
			echo '</tr>
			<tr>
				<td class="ind1">Local Sales Tax Rate '.tip('pcd_17').'</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight"><input type="text" class="cost int pct '.$hl['t4c_ds2_2'].'" name="t4c_ds2_2" id="t4c_ds2_2" value="'.number_format(($pv->t4c['ds2'][2] * 100),2).'" />%</td>
					';
				} else {
					echo '<td class="highlight">'.number_format(($pv->t4c['ds2'][2] * 100),2).'%</td>
					';
				}
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['t1c_ds2_11'].'" name="t1c_ds2_11" id="t1c_ds2_11" value="'.number_format(($pv->t1c['ds2'][11] * 100)).'" />%</td>
					';
				} else {
					echo '<td>'.number_format(($pv->t1c['ds2'][11] * 100)).'%</td>
					';
				}
			echo '</tr>
			<tr>
				<td class="ind1">Sales Tax Exemption (Percent of local taxes) '.tip('pcd_18').'</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight"><input type="text" class="cost int pct '.$hl['t4c_ds2_3'].'" name="t4c_ds2_3" id="t4c_ds2_3" value="'.number_format(($pv->t4c['ds2'][3] * 100)).'" />%</td>
					';
				} else {
					echo '<td class="highlight">'.number_format(($pv->t4c['ds2'][3] * 100)).'%</td>
					';
				}
				echo '<td></td>
			</tr>
			<tr>
				<th>Payroll Parameters</td>
				<th class="highlight">Wage Per Hour '.tip('pcd_19').'</th>
				<th>Employer Payroll Overhead '.tip('pcd_20').'</th>
			</tr>
			<tr>
				<th colspan="3">Construction &amp; Installation Labor</th>
			</tr>
			<tr>
				<td class="ind1">Construction Workers / Installers</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight">$<input type="text" class="cost int '.$hl['t1c_ds2_7'].'" name="t1c_ds2_7" id="t1c_ds2_7" value="'.number_format($pv->t1c['ds2'][7],2).'" /></td>
					';
				} else {
					echo '<td class="highlight">$'.number_format($pv->t1c['ds2'][7],2).'</td>
					';
				}
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['t2c_ds2_1'].'" name="t2c_ds2_1" id="t2c_ds2_1" value="'.number_format(($pv->t2c['ds2'][1] * 100),1).'" />%</td>
					';
				} else {
					echo '<td>'.number_format(($pv->t2c['ds2'][1] * 100),1).'%</td>
					';
				}
			echo '</tr>
			<tr>
				<th colspan="3">O&amp;M Labor</td>
			</tr>
			<tr>
				<td class="ind1">Technicians</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight">$<input type="text" class="cost int '.$hl['t1c_ds2_8'].'" name="t1c_ds2_8" id="t1c_ds2_8" value="'.number_format($pv->t1c['ds2'][8],2).'" /></td>
					';
				} else {
					echo '<td class="highlight">$'.number_format($pv->t1c['ds2'][8],2).'</td>
					';
				}
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['t2c_ds2_2'].'" name="t2c_ds2_2" id="t2c_ds2_2" value="'.number_format(($pv->t2c['ds2'][2] * 100),1).'" />%</td>
					';
				} else {
					echo '<td>'.number_format(($pv->t2c['ds2'][2] * 100),1).'%</td>
					';
				}
			echo '</tr>
		</table>
	</div><!-- END: pcd -->
	<div id="btmbutton">
		<a href="results.php"><span class="hidden">View Results Summary</span></a>
	</div><!-- END: btmbutton -->
	';
}
// print_r($pv->t2c['ds21']);
// $time = elapseTime($start);
// echo $time;
/*



















*/
?>
