<?php
if ($f != 1) {
	ini_set('memory_limit','256M');
	session_start();
	require('inc_connection.php');
	require("inc_functions2.php");
	$uid = $_SESSION['uID'];
	$sid = cleanVar($_GET['sid']);
	if ($sid AND !is_numeric($sid) AND $sid != 'unsaved') {
		$_SESSION['message'] = '<div id="message">You do not have access to the selected model run 3</div>';
		unset($sid);
	}
	if ($sid == '') {
		$sid = 'unsaved';
	}
} else {
	$path = 'includes/';
}
if (!$_SESSION['inputs']) {
	$_SESSION['inputs']['unsaved'] = array();
} else {
	// CLEAR OUT INPUTS SESSION
	foreach($_SESSION['inputs'] as $k => $v) {
		if ($k != $sid AND $k != 'unsaved') {
			unset($_SESSION['inputs'][$k]);
		}
	}
}
$myVals = getMyVals();
require($path."inc_arrays2.php");
require($path."inc_functions_financial.php");
require($path."inc_calculations_8.php");
// ASSIGN CELL VALUES TO INPUTS ARRAY
foreach($inputs as $k => $v) {
	list($s,$c) = explode("_",$v);
	$inputs[$k] = $cell[$s][$c];
	if ($_SESSION['inputs'][$sid][$s][$c]) {
		$hl[$k] = ' highlight';
	}
}
// GET STATES ARRAY
for($i = 758; $i <= 808; $i++) {
	$states[] = $cell['ProjectData']['O'.$i];
}
// print_r($_SESSION);
// echo '<br /><br />';
// print_r($inputs);
if (is_numeric($sid)) {
	$q = "SELECT * FROM scenarios WHERE ((sID=?) AND (uID=?))";
	$var = query($q,array($sid,$uid),'s','Get Scenario Info');
} else {
	if ($uid) {
		$var[0]['name'] = '<span id="unsaved"><img src="images/unsaved.gif" alt="unsaved" style="vertical-align:-1px;" /> Unsaved - <a href="javascript:show(\'saverun\')">Click to save</a></span>';
	} else {
		$var[0]['name'] = '<span id="unsaved"><img src="images/unsaved.gif" alt="unsaved" style="vertical-align:-1px;" /> Unsaved - <a href="login.php?url=model.php">login to save</a></span>';
	}
}
if (is_numeric($sid)) {
	echo '<p class="email fr" style="padding:15px 10px 0px 0px;">
		<a href="handle_copyrun.php?sid='.$sid.'" onclick="return confirm(\'Are you sure you want to create a copy of this model run?\')"><img src="images/icon_copy.gif" alt="Copy Model Run" />&nbsp;Copy Model Run</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="mailto:?Subject=JEDI%20PV%20Model%20Run&Body=http://jedi.nrel.gov/model.php?key='.sha1($sid.'pvjed1').'"><img src="images/icon_email.gif" alt="email this" />&nbsp;Share This Model Run</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="my-account.php"><img src="images/icon_runlist.gif" alt="Saved Lists" />&nbsp;Saved Model Runs</a>
	</p>
	';
}
// echo 'SID: '.$sid.'<br />';
// echo 'UNSAVED ARRAY<br />';
// print_r($_SESSION['inputs']);
// echo '<br /><br />HIGHLIGHTS<br />';
// print_r($hl);
// echo '<br /><br />';
// print_r($cell['ProjectData']);
echo '<h1><img src="images/ttl_projectdescdata.gif" alt="Project Descriptive Data" />';
if (is_numeric($sid)) {
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
if ($inputs['pdd_project_location'] == "MYCOUNTY" OR $inputs['pdd_project_location'] == "MYREGION") {
	if ($inputs['pdd_project_location'] == "MYCOUNTY" AND $cell['UserAddInLocation']['B11'] != 0) {
		$hide = "hidden";
	} else if ($inputs['pdd_project_location'] == "MYREGION" AND $cell['UserAddInLocation']['C11'] != 0) {
		$hide = "hidden";
	}
	echo '<div id="addin" class="dropdown" style="display:block;">
		<form action="handle_upload2.php" method="post" id="uploadmulitipliers" enctype="multipart/form-data" class="'.$hide.'">
		<div id="dltemp">
			<a href="handle_template.php"><img src="images/download_multipliers.gif" alt="Download Multipliers Template" /></a>
		</div>
		<h2>Multipliers For Economic Input/Output Analysis</h2>
		<p>Upload the <strong>multipliers_template.csv</strong> file after you have added your own multipliers for your county or region.</p>
		<input type="hidden" name="sid" value="'.$sid.'" />
		<input type="hidden" name="type" value="'.$inputs['pdd_project_location'].'" />
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
		<strong>Current Model Run:</strong> <em>'.$var[0]['name'].'</em>
	</h2>
	<div id="results" class="fr">
		<h2>Would you like to add custom Project Cost Data?</h2>
		';
		if ($inputs['pdd_custom_cost_data'] != "Y") {
			echo '<p class="fr" style="padding:7px 70px 0px 0px;">(edit cost data below)</p>
			';
		}
		echo '<select name="pdd_custom_cost_data" id="pdd_custom_cost_data" class="'.$hl['pdd_custom_cost_data'].'">
		';
		if ($inputs['pdd_custom_cost_data'] == "Y") {
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
		// echo '<p>Total Calculation Count: '.formatNum(count($d, COUNT_RECURSIVE) + count($x, COUNT_RECURSIVE) + count($pv->t1c, COUNT_RECURSIVE) + count($pv->t2c, COUNT_RECURSIVE) + count($pv->t3c, COUNT_RECURSIVE) + count($pv->t4c, COUNT_RECURSIVE) + count($pv->t5c, COUNT_RECURSIVE) + count($pv->t6c, COUNT_RECURSIVE) + count($pv->t7c, COUNT_RECURSIVE) + count($pv->sr1c, COUNT_RECURSIVE))).'</p>
		// ';
	echo '</div>
	<form action="results.php" method="post">
	<label>
		<select name="pdd_project_location" id="pdd_project_location" class="'.$hl['pdd_project_location'].'">
		<optgroup label="Custom Model Run">
			';
			if ($inputs['pdd_project_location'] == "MYCOUNTY" OR $inputs['pdd_project_location'] == "MYREGION") {
				if ($inputs['pdd_project_location'] == "MYCOUNTY") {
					echo '<option value="MYCOUNTY" selected="selected" onclick="scrollWin(\'addin\');">My County</option>
					<option value="MYREGION" onclick="scrollWin(\'addin\');">My Region</option>
					';
				} else if ($inputs['pdd_project_location'] == "MYREGION") {
					echo '<option value="MYCOUNTY" onclick="scrollWin(\'addin\');">My County</option>
					<option value="MYREGION" selected="selected" onclick="scrollWin(\'addin\');">My Region</option>
					';
				}
			} else {
				echo '<option value="MYCOUNTY" onclick="scrollWin(\'addin\');">My County</option>
				<option value="MYREGION" onclick="scrollWin(\'addin\');">My Region</option>
				';
			}
		echo '</optgroup>
		<optgroup label="Statewide Model Run">
		';
		foreach($states as $k => $v) {
			if (strtolower($v) == strtolower($inputs['pdd_project_location'])) {
				echo '<option value="'.$v.'" selected="selected">'.ucwords(strtolower($v)).'</option>
				';
			} else {
				echo '<option value="'.$v.'">'.ucwords(strtolower($v)).'</option>
				';
			}
		}
		echo '</optgroup>
		<optgroup label="Predefined Model Run">
		';
		foreach($regions as $k => $v) {
			if (strtolower($k) == strtolower($inputs['pdd_project_location'])) {
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
	if ($inputs['pdd_project_location'] == "MYCOUNTY" OR $inputs['pdd_project_location'] == "MYREGION") {
		echo '<div id="addinextras">
			';
			if ($inputs['pdd_project_location'] == "MYCOUNTY") {
				echo '<label>
					<input type="text" name="addin_my_county_name" id="addin_my_county_name" value="'.$inputs['addin_my_county_name'].'" size="" class="'.$hl['addin_my_county_name'].'" />
					My County Name : '.$inputs['addin_my_county_name'].' : '.$cell['UserAddInLocation']['B3'].'
				</label>
				<label>
					<input type="text" name="addin_mycounty_year_of_data" id="addin_mycounty_year_of_data" value="'.$inputs['addin_mycounty_year_of_data'].'" size="" class="int '.$hl['addin_mycounty_year_of_data'].'" />
					Year of Data (required)
				</label>
				';
			} else {
				echo '<label>
					<input type="text" name="addin_my_region_name" id="addin_my_region_name" value="'.$inputs['addin_my_region_name'].'" size="" class="'.$hl['addin_my_region_name'].'" />
					My Region Name
				</label>
				<label>
					<input type="text" name="addin_myregion_year_of_data" id="addin_myregion_year_of_data" value="'.$inputs['addin_myregion_year_of_data'].'" size="" class="int '.$hl['addin_myregion_year_of_data'].'" />
					Year of Data (required)
				</label>
				';
			}
			echo '<label>
				<input type="text" name="pdd_population" id="pdd_population" value="'.$inputs['pdd_population'].'" size="" class="int '.$hl['pdd_population'].'" />
				Population (required) '.tip('pdd_2').'
			</label>
			<label>
				<input type="text" name="addin_sales_tax_rate" id="addin_sales_tax_rate" value="'.formatNum($inputs['addin_sales_tax_rate'],'pct').'" size="" class="int pct '.$hl['addin_sales_tax_rate'].'" />
				Sales Tax Rate %
			</label>
			<label>
				<input type="text" name="addin_sales_tax_exemption" id="addin_sales_tax_exemption" value="'.formatNum($inputs['addin_sales_tax_exemption'],'pct').'" size="" class="int pct '.$hl['addin_sales_tax_exemption'].'" />
				Sales Tax Exemption %
			</label>
			<label>
				<input type="text" name="addin_property_tax_exemption" id="addin_property_tax_exemption" value="'.formatNum($inputs['addin_property_tax_exemption'],'pct').'" size="" class="int pct '.$hl['addin_property_tax_exemption'].'" />
				Property Tax Exemption %
			</label>
		</div>
		';
	}
	// --------------------------------------------------------------------------------  END My County / My Region Info ----------- //
	echo '<label>
		<input type="text" name="pdd_year_construction_installation" id="pdd_year_construction_installation" value="'.$inputs['pdd_year_construction_installation'].'" size="" class="int '.$hl['pdd_year_construction_installation'].'" />
		Year of Construction or Installation '.tip('pdd_3').'
	</label>
	<label>
		<select name="pdd_system_application" id="pdd_system_application" class="'.$hl['pdd_system_application'].'">
		';
		foreach($systemApp as $k => $v) {
			if ($v == $inputs['pdd_system_application']) {
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
		<select name="pdd_solar_cell_module_material" id="pdd_solar_cell_module_material" class="'.$hl['pdd_solar_cell_module_material'].'">
		';
		foreach($solarMat as $k => $v) {
			if ($v == $inputs['pdd_solar_cell_module_material']) {
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
		if ($inputs['pdd_system_application'] == "Thin Film") {
			echo '<select name="pdd_system_tracking" id="pdd_system_tracking" disabled="disabled">
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
			echo '<select name="pdd_system_tracking" id="pdd_system_tracking" class="'.$hl['pdd_system_tracking'].'">
			';
			foreach($systemTrack as $k => $v) {
				if ($v == $inputs['pdd_system_tracking']) {
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
	<label><input type="text" name="pdd_average_system_size" id="pdd_average_system_size" value="'.formatNum($inputs['pdd_average_system_size'],'dec1').'" size="" class="int '.$hl['pdd_average_system_size'].'" />
		Average System Size - DC Nameplate Capacity (KW) '.tip('pdd_4').'
	</label>
	<label>
		<input type="text" name="pdd_number_systems_installed" id="pdd_number_systems_installed" value="'.formatNum($inputs['pdd_number_systems_installed'],'dec1').'" size="" class="int '.$hl['pdd_number_systems_installed'].'" />
		Number of Systems Installed
	</label>
	<label>
		<input type="text" name="t2c_ds1_2" id="t2c_ds1_2" value="'.formatNum($cell['ProjectData']['B20'],'dec1').'" size="" class="readonly" readonly="readonly" />
		Total Project Size - DC Nameplate Capacity (KW) '.tip('pdd_5').'
	</label>
	<label>
		<input type="text" name="pdd_base_installed_system_cost" id="pdd_base_installed_system_cost" value="'.formatNum($inputs['pdd_base_installed_system_cost'],'dec1').'" size="" class="int '.$hl['pdd_base_installed_system_cost'].'" />
		Base Installed System Cost ($/KWDC) '.tip('pdd_6').'
	</label>
	<label>
		<input type="text" name="pdd_annual_direct_operations_maintenance_cost" id="pdd_annual_direct_operations_maintenance_cost" value="'.formatNum($inputs['pdd_annual_direct_operations_maintenance_cost'],'dec2').'" size="" class="int '.$hl['pdd_annual_direct_operations_maintenance_cost'].'" />
		Annual Direct Operations and Maintenance Cost ($/kW) '.tip('pdd_7').'
	</label>
	<label>
		<input type="text" name="pdd_money_value" id="pdd_money_value" value="'.$inputs['pdd_money_value'].'" size="" class="int '.$hl['pdd_money_value'].'" />
		Money Value - Current or Constant (Dollar Year) '.tip('pdd_8').'
	</label>
	</form>
</div><!-- END: pdd -->
';
// ========================================================================= Project Cost Data //
if ($inputs['pdd_custom_cost_data'] == "Y") {
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
				<td class="highlight">$'.formatNum($cell['ProjectData']['B33']).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['pcd_me_mounting_r2'].'" name="pcd_me_mounting_r2" id="pcd_me_mounting_r2" value="'.formatNum($inputs['pcd_me_mounting_r2']).'" /></td>
					';
				} else {
					echo '<td>$'.formatNum($inputs['pcd_me_mounting_r2']).'</td>
					';
				}
				echo '<td class="highlight">'.formatNum($cell['ProjectData']['D33'],'pct1').'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['pcd_me_mounting_r4'].'" name="pcd_me_mounting_r4" id="pcd_me_mounting_r4" value="'.formatNum($inputs['pcd_me_mounting_r4'],'pct').'" />%</td>
					';
				} else {
					echo '<td>'.formatNum($inputs['pcd_me_mounting_r4'],'pct').'%</td>
					';
				}
				if ($yes == 0) {
					echo '<td class="highlight">
					<select name="pcd_me_mounting_r5" id="pcd_me_mounting_r5" class="'.$hl['pcd_me_mounting_r5'].'">
					';
					if ($inputs['pcd_me_mounting_r5'] == "Y") {
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
					echo '<td class="highlight">'.$inputs['pcd_me_mounting_r5'].'</td>
					';
				}
			echo '</tr>
			<tr>
				<td class="ind1">Modules</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B34']).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['pcd_me_modules_r2'].'" name="pcd_me_modules_r2" id="pcd_me_modules_r2" value="'.formatNum($inputs['pcd_me_modules_r2']).'" /></td>
					';
				} else {
					echo '<td>$'.formatNum($inputs['pcd_me_modules_r2']).'</td>
					';
				}
				echo '<td class="highlight">'.formatNum($cell['ProjectData']['D34'],'pct1').'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['pcd_me_modules_r4'].'" name="pcd_me_modules_r4" id="pcd_me_modules_r4" value="'.formatNum($inputs['pcd_me_modules_r4'],'pct').'" />%</td>
					';
				} else {
					echo '<td>'.formatNum($inputs['pcd_me_modules_r4'],'pct').'%</td>
					';
				}
				if ($yes == 0) {
					echo '<td class="highlight">
					<select name="pcd_me_modules_r5" id="pcd_me_modules_r5" class="'.$hl['pcd_me_modules_r5'].'">
					';
					if ($inputs['pcd_me_modules_r5'] == "Y") {
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
					echo '<td class="highlight">'.$inputs['pcd_me_modules_r5'].'</td>
					';
				}
			echo '</tr>
			<tr>
				<td class="ind1">Electrical (Wire, Connectors, Breakers, etc.)</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B35']).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['pcd_me_Electrical_r2'].'" name="pcd_me_Electrical_r2" id="pcd_me_Electrical_r2" value="'.formatNum($inputs['pcd_me_Electrical_r2']).'" /></td>
					';
				} else {
					echo '<td>$'.formatNum($inputs['pcd_me_Electrical_r2']).'</td>
					';
				}
				echo '<td class="highlight">'.formatNum($cell['ProjectData']['D35'],'pct1').'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['pcd_me_Electrical_r4'].'" name="pcd_me_Electrical_r4" id="pcd_me_Electrical_r4" value="'.formatNum($inputs['pcd_me_Electrical_r4'],'pct').'" />%</td>
					';
				} else {
					echo '<td>'.formatNum($inputs['pcd_me_Electrical_r4'],'pct').'%</td>
					';
				}
				if ($yes == 0) {
					echo '<td class="highlight">
					<select name="pcd_me_Electrical_r5" id="pcd_me_Electrical_r5" class="'.$hl['pcd_me_Electrical_r5'].'">
					';
					if ($inputs['pcd_me_Electrical_r5'] == "Y") {
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
					echo '<td class="highlight">'.$inputs['pcd_me_Electrical_r5'].'</td>
					';
				}
			echo '</tr>
			<tr>
				<td class="ind1">Inverter</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B36']).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['pcd_me_inverter_r2'].'" name="pcd_me_inverter_r2" id="pcd_me_inverter_r2" value="'.formatNum($inputs['pcd_me_inverter_r2']).'" /></td>
					';
				} else {
					echo '<td>$'.formatNum($inputs['pcd_me_inverter_r2']).'</td>
					';
				}
				echo '<td class="highlight">'.formatNum($cell['ProjectData']['D36'],'pct1').'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['pcd_me_inverter_r4'].'" name="pcd_me_inverter_r4" id="pcd_me_inverter_r4" value="'.formatNum($inputs['pcd_me_inverter_r4'],'pct').'" />%</td>
					';
				} else {
					echo '<td>'.formatNum($inputs['pcd_me_inverter_r4'],'pct').'%</td>
					';
				}
				if ($yes == 0) {
					echo '<td class="highlight">
					<select name="pcd_me_inverter_r5" id="pcd_me_inverter_r5" class="'.$hl['pcd_me_inverter_r5'].'">
					';
					if ($inputs['pcd_me_inverter_r5'] == "Y") {
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
					echo '<td class="highlight">'.$inputs['pcd_me_inverter_r5'].'</td>
					';
				}
			echo '</tr>
			<tr>
				<td class="ind1">Subtotal</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B37']).'</td>
				<td>$'.formatNum($cell['ProjectData']['C37']).'</td>
				<td class="highlight">'.formatNum($cell['ProjectData']['D37'],'pct1').'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>
			<tr>
				<th colspan="6">Labor</td>
			</tr>
			<tr>
				<td class="ind1">Installation</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B39']).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['pcd_oc_installation_r2'].'" name="pcd_oc_installation_r2" id="pcd_oc_installation_r2" value="'.formatNum($inputs['pcd_oc_installation_r2']).'" /></td>
					';
				} else {
					echo '<td>$'.formatNum($inputs['pcd_oc_installation_r2']).'</td>
					';
				}
				echo '<td class="highlight">'.formatNum($cell['ProjectData']['D39'],'pct1').'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['pcd_oc_installation_r4'].'" name="pcd_oc_installation_r4" id="pcd_oc_installation_r4" value="'.formatNum($inputs['pcd_oc_installation_r4'],'pct').'" />%</td>
					';
				} else {
					echo '<td>'.formatNum($inputs['pcd_oc_installation_r4'],'pct').'%</td>
					';
				}
				echo '<td class="highlight"></td>
			</tr>
			<tr>
				<td class="ind1">Subtotal</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B40']).'</td>
				<td>$'.formatNum($cell['ProjectData']['C40']).'</td>
				<td class="highlight">'.formatNum($cell['ProjectData']['D40'],'pct1').'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>
			<tr class="bld">
				<td>Total</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B41']).'</td>
				<td>$'.formatNum($cell['ProjectData']['C41']).'</td>
				<td class="highlight">'.formatNum($cell['ProjectData']['D41'],'pct1').'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>
			<tr>
				<th colspan="6">Other Costs</td>
			</tr>
			<tr>
				<td class="ind1">Permitting</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B43']).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['pcd_oc_permitting_r2'].'" name="pcd_oc_permitting_r2" id="pcd_oc_permitting_r2" value="'.formatNum($inputs['pcd_oc_permitting_r2']).'" /></td>
					';
				} else {
					echo '<td>$'.formatNum($inputs['pcd_oc_permitting_r2']).'</td>
					';
				}
				echo '<td class="highlight">'.formatNum($cell['ProjectData']['D43'],'pct1').'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['pcd_oc_permitting_r4'].'" name="pcd_oc_permitting_r4" id="pcd_oc_permitting_r4" value="'.formatNum($inputs['pcd_oc_permitting_r4'],'pct').'" />%</td>
					';
				} else {
					echo '<td>'.formatNum($inputs['pcd_oc_permitting_r4'],'pct').'%</td>
					';
				}
				echo '<td class="highlight"></td>
			</tr>
			<tr>
				<td class="ind1">Other Costs '.tip('pcd_3').'</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B44']).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['pcd_oc_other_costs_r2'].'" name="pcd_oc_other_costs_r2" id="pcd_oc_other_costs_r2" value="'.formatNum($inputs['pcd_oc_other_costs_r2']).'" /></td>
					';
				} else {
					echo '<td>$'.formatNum($inputs['pcd_oc_other_costs_r2']).'</td>
					';
				}
				echo '<td class="highlight">'.formatNum($cell['ProjectData']['D44'],'pct1').'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['pcd_oc_other_costs_r4'].'" name="pcd_oc_other_costs_r4" id="pcd_oc_other_costs_r4" value="'.formatNum($inputs['pcd_oc_other_costs_r4'],'pct').'" />%</td>
					';
				} else {
					echo '<td>'.formatNum($inputs['pcd_oc_other_costs_r4'],'pct').'%</td>
					';
				}
				echo '<td class="highlight"></td>
			</tr>
			<tr>
				<td class="ind1">Business Overhead '.tip('pcd_4').'</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B45']).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['pcd_oc_business_overhead_r2'].'" name="pcd_oc_business_overhead_r2" id="pcd_oc_business_overhead_r2" value="'.formatNum($inputs['pcd_oc_business_overhead_r2']).'" /></td>
					';
				} else {
					echo '<td>$'.formatNum($inputs['pcd_oc_business_overhead_r2']).'</td>
					';
				}
				echo '<td class="highlight">'.formatNum($cell['ProjectData']['D45'],'pct1').'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['pcd_oc_business_overhead_r4'].'" name="pcd_oc_business_overhead_r4" id="pcd_oc_business_overhead_r4" value="'.formatNum($inputs['pcd_oc_business_overhead_r4'],'pct').'" />%</td>
					';
				} else {
					echo '<td>'.formatNum($inputs['pcd_oc_business_overhead_r4'],'pct').'%</td>
					';
				}
				echo '<td class="highlight"></td>
			</tr>
			<tr>
				<td class="ind1">Subtotal</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B46']).'</td>
				<td>$'.formatNum($cell['ProjectData']['C46']).'</td>
				<td class="highlight">'.formatNum($cell['ProjectData']['D46'],'pct1').'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>
			<tr>
				<td>Subtotal</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B47']).'</td>
				<td>$'.formatNum($cell['ProjectData']['C47']).'</td>
				<td class="highlight">'.formatNum($cell['ProjectData']['D47'],'pct1').'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>
			<tr>
				<td>Sales Tax (Materials, &amp; Equipment Purchases) '.tip('pcd_5').$inputs['pcd_sales_tax'].'</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight">$<input type="text" class="cost int '.$hl['pcd_sales_tax'].'" name="pcd_sales_tax" id="pcd_sales_tax" value="'.formatNum($inputs['pcd_sales_tax']).'" /></td>
					';
				} else {
					echo '<td class="highlight">$'.formatNum($inputs['pcd_sales_tax']).'</td>
					';
				}
				echo '<td>$'.formatNum($cell['ProjectData']['C48']).'</td>
				<td class="highlight">'.formatNum($cell['ProjectData']['D48'],'pct1').'%</td>
				<td>'.formatNum($cell['ProjectData']['E48'],'pct').'% '.tip('pcd_6').'</td>
				<td class="highlight"></td>
			</tr>
			<tr class="bld">
				<td>Total</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B49']).'</td>
				<td>$'.formatNum($cell['ProjectData']['C49']).'</td>
				<td class="highlight">'.formatNum($cell['ProjectData']['D49'],'pct1').'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>
		</table><br /><br />
		';
		// ========================================================================= PV System Annual Operating and Maintenance Costs //
		echo '<h2>PV System Annual Operating and Maintenance Costs';
		if (is_numeric($sid)) {
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
				<td class="highlight">$'.formatNum($cell['ProjectData']['B54']).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['pvsaomc_l_technicians_r2'].'" name="pvsaomc_l_technicians_r2" id="pvsaomc_l_technicians_r2" value="'.formatNum($inputs['pvsaomc_l_technicians_r2'],'dec2').'" /></td>
					';
				} else {
					echo '<td>$'.formatNum($inputs['pvsaomc_l_technicians_r2'],'dec2').'</td>
					';
				}
				echo '<td class="highlight">'.formatNum($cell['ProjectData']['D54'],'pct1').'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['pvsaomc_l_technicians_r4'].'" name="pvsaomc_l_technicians_r4" id="pvsaomc_l_technicians_r4" value="'.formatNum($inputs['pvsaomc_l_technicians_r4'],'pct').'" />%</td>
					';
				} else {
					echo '<td>'.formatNum($inputs['pvsaomc_l_technicians_r4'],'pct').'%</td>
					';
				}
				echo '<td class="highlight"></td>
			</tr>
			<tr>
				<td class="ind1">Subtotal</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B55']).'</td>
				<td>$'.formatNum($cell['ProjectData']['C55'],'dec2').'</td>
				<td class="highlight">'.formatNum($cell['ProjectData']['D55'],'pct1').'%</td>
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
				<td class="highlight">$'.formatNum($cell['ProjectData']['B58']).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['pvsaomc_ms_materials_equipment_r2'].'" name="pvsaomc_ms_materials_equipment_r2" id="pvsaomc_ms_materials_equipment_r2" value="'.formatNum($inputs['pvsaomc_ms_materials_equipment_r2'],'dec2').'" /></td>
					';
				} else {
					echo '<td>$'.formatNum($inputs['pvsaomc_ms_materials_equipment_r2'],'dec2').'</td>
					';
				}
				echo '<td class="highlight">'.formatNum($cell['ProjectData']['D58'],'pct1').'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['pvsaomc_ms_materials_equipment_r4'].'" name="pvsaomc_ms_materials_equipment_r4" id="pvsaomc_ms_materials_equipment_r4" value="'.formatNum($inputs['pvsaomc_ms_materials_equipment_r4'],'pct').'" />%</td>
					';
				} else {
					echo '<td>'.formatNum($inputs['pvsaomc_ms_materials_equipment_r4'],'pct').'%</td>
					';
				}
				if ($yes == 0) {
					echo '<td class="highlight">
					<select name="pvsaomc_ms_materials_equipment_r5" id="pvsaomc_ms_materials_equipment_r5" class="'.$hl['pvsaomc_ms_materials_equipment_r5'].'">
					';
					if ($inputs['pvsaomc_ms_materials_equipment_r5'] == "Y") {
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
					echo '<td class="highlight">'.$inputs['pvsaomc_ms_materials_equipment_r5'].'</td>
					';
				}
				echo '</tr>
			<tr>
				<td class="ind1">Services</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B59']).'</td>
				';
				if ($yes == 0) {
					echo '<td>$<input type="text" class="cost int '.$hl['pvsaomc_ms_services_r2'].'" name="pvsaomc_ms_services_r2" id="pvsaomc_ms_services_r2" value="'.formatNum($inputs['pvsaomc_ms_services_r2'],'dec2').'" /></td>
					';
				} else {
					echo '<td>$'.formatNum($inputs['pvsaomc_ms_services_r2'],'dec2').'</td>
					';
				}
				echo '<td class="highlight">'.formatNum($cell['ProjectData']['D59'],'pct1').'%</td>
				';
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['pvsaomc_ms_services_r4'].'" name="pvsaomc_ms_services_r4" id="pvsaomc_ms_services_r4" value="'.formatNum($inputs['pvsaomc_ms_services_r4'],'pct').'" />%</td>
					';
				} else {
					echo '<td>'.formatNum($inputs['pvsaomc_ms_services_r4'],'pct').'%</td>
					';
				}
				echo '<td class="highlight"></td>
			</tr>
			<tr>
				<td class="ind1">Subtotal</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B60']).'</td>
				<td>$'.formatNum($cell['ProjectData']['C60'],'dec2').'</td>
				<td class="highlight">'.formatNum($cell['ProjectData']['D60'],'pct1').'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>
			<tr>
				<td>Sales Tax (Materials &amp; Equipment Purchases '.tip('pcd_11').'</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight">$<input type="text" class="cost int '.$hl['pvsaomc_sales_tax'].'" name="pvsaomc_sales_tax" id="pvsaomc_sales_tax" value="'.formatNum($inputs['pvsaomc_sales_tax']).'" /></td>
					';
				} else {
					echo '<td class="highlight">$'.formatNum($inputs['pvsaomc_sales_tax']).'</td>
					';
				}
				echo '<td>$'.formatNum($cell['ProjectData']['C61'],'dec2').'</td>
				<td class="highlight">'.formatNum($cell['ProjectData']['D61'],'pct1').'%</td>
				<td>'.formatNum($cell['ProjectData']['E61'],'pct').'% '.tip('pcd_12').'</td>
				<td class="highlight"></td>
			</tr>
			<tr class="bld">
				<td>Total '.tip('pcd_13').'</td>
				<td class="highlight">$'.formatNum($cell['ProjectData']['B62']).'</td>
				<td>$'.formatNum($cell['ProjectData']['C62'],'dec2').'</td>
				<td class="highlight">'.formatNum($cell['ProjectData']['D62'],'pct1').'%</td>
				<td></td>
				<td class="highlight"></td>
			</tr>	
		</table><br /><br />
		';
		// ========================================================================= Other Parameters //
		echo '<h2>Other Parameters';
		if (is_numeric($sid)) {
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
					echo '<td class="highlight"><input type="text" class="cost int pct '.$hl['op_df_percentage_financed_r1'].'" name="op_df_percentage_financed_r1" id="op_df_percentage_financed_r1" value="'.formatNum($inputs['op_df_percentage_financed_r1'],'pct').'" />%</td>
					';
				} else {
					echo '<td class="highlight">'.formatNum($inputs['op_df_percentage_financed_r1'],'pct').'%</td>
					';
				}
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['op_df_percentage_financed_r3'].'" name="op_df_percentage_financed_r3" id="op_df_percentage_financed_r3" value="'.formatNum($inputs['op_df_percentage_financed_r3'],'pct').'" />%</td>
					';
				} else {
					echo '<td>'.formatNum($inputs['op_df_percentage_financed_r3'],'pct').'%</td>
					';
				}
			echo '</tr>
			<tr>
				<td class="ind1">Years Financed (Term)</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight"><input type="text" class="cost int '.$hl['op_df_years_financed_r1'].'" name="op_df_years_financed_r1" id="op_df_years_financed_r1" value="'.$inputs['op_df_years_financed_r1'].'" /></td>
					';
				} else {
					echo '<td class="highlight">'.$inputs['op_df_years_financed_r1'].'</td>
					';
				}
				echo '<td></td>
			</tr>
			<tr>
				<td class="ind1">Interest Rate</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight"><input type="text" class="cost int pct '.$hl['op_df_interest_rate_r1'].'" name="op_df_interest_rate_r1" id="op_df_interest_rate_r1" value="'.formatNum($inputs['op_df_interest_rate_r1'],'pct').'" />%</td>
					';
				} else {
					echo '<td class="highlight">'.formatNum($inputs['op_df_interest_rate_r1'],'pct').'%</td>
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
					echo '<td class="highlight"><input type="text" class="cost int pct '.$hl['op_tp_local_property_tax_percent_r1'].'" name="op_tp_local_property_tax_percent_r1" id="op_tp_local_property_tax_percent_r1" value="'.formatNum($inputs['op_tp_local_property_tax_percent_r1'],'pct1').'" />%</td>
					';
				} else {
					echo '<td class="highlight">'.formatNum($inputs['op_tp_local_property_tax_percent_r1'],'pct1').'%</td>
					';
				}
				echo '<td></td>
			</tr>
			<tr>
				<td class="ind1">Assessed Value (Percent of construction cost)</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight"><input type="text" class="cost int pct '.$hl['op_tp_assessed_value_r1'].'" name="op_tp_assessed_value_r1" id="op_tp_assessed_value_r1" value="'.formatNum($inputs['op_tp_assessed_value_r1'],'pct1').'" />%</td>
					';
				} else {
					echo '<td class="highlight">'.formatNum($inputs['op_tp_assessed_value_r1'],'pct1').'%</td>
					';
				}
				echo '<td></td>
			</tr>
			<tr>
				<td class="ind1">Taxable Value (Percent of assessed value)</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight"><input type="text" class="cost int pct '.$hl['op_tp_taxable_value_percent_r1'].'" name="op_tp_taxable_value_percent_r1" id="op_tp_taxable_value_percent_r1" value="'.formatNum($inputs['op_tp_taxable_value_percent_r1'],'pct1').'" />%</td>
					';
				} else {
					echo '<td class="highlight">'.formatNum($inputs['op_tp_taxable_value_percent_r1'],'pct1').'%</td>
					';
				}
				echo '<td></td>
			</tr>
			<tr>
				<td class="ind1">Taxable Value</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight">$<input type="text" class="cost int '.$hl['op_tp_taxable_value_r1'].'" name="op_tp_taxable_value_r1" id="op_tp_taxable_value_r1" value="'.formatNum($inputs['op_tp_taxable_value_r1']).'" /></td>
					';
				} else {
					echo '<td class="highlight">$'.formatNum($inputs['op_tp_taxable_value_r1']).'</td>
					';
				}
				echo '<td></td>
			</tr>
			<tr>
				<td class="ind1">Property Tax Exemption (Percent of local taxes) '.tip('pcd_16').'</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight"><input type="text" class="cost int pct '.$hl['op_tp_property_tax_exemption_r1'].'" name="op_tp_property_tax_exemption_r1" id="op_tp_property_tax_exemption_r1" value="'.formatNum($inputs['op_tp_property_tax_exemption_r1'],'pct').'" />%</td>
					';
				} else {
					echo '<td class="highlight">'.formatNum($inputs['op_tp_property_tax_exemption_r1'],'pct').'%</td>
					';
				}
				echo '<td></td>
			</tr>
			<tr>
				<td class="ind1">Local Property Taxes</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight">$<input type="text" class="cost int '.$hl['op_tp_local_property_tax_r1'].'" name="op_tp_local_property_tax_r1" id="op_tp_local_property_tax_r1" value="'.formatNum($inputs['op_tp_local_property_tax_r1']).'" /></td>
					';
				} else {
					echo '<td class="highlight">$'.formatNum($inputs['op_tp_local_property_tax_r1']).'</td>
					';
				}
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['op_tp_local_property_tax_r3'].'" name="op_tp_local_property_tax_r3" id="op_tp_local_property_tax_r3" value="'.formatNum($inputs['op_tp_local_property_tax_r3'],'pct').'" />%</td>
					';
				} else {
					echo '<td>'.formatNum($inputs['op_tp_local_property_tax_r3'],'pct').'%</td>
					';
				}
			echo '</tr>
			<tr>
				<td class="ind1">Local Sales Tax Rate '.tip('pcd_17').'</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight"><input type="text" class="cost int pct '.$hl['op_tp_local_sales_tax_rate_r1'].'" name="op_tp_local_sales_tax_rate_r1" id="op_tp_local_sales_tax_rate_r1" value="'.formatNum($inputs['op_tp_local_sales_tax_rate_r1'],'pct2').'" />%</td>
					';
				} else {
					echo '<td class="highlight">'.formatNum($cell['ProjectData']['B77'],'pct2').'%</td>
					';
				}
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['op_tp_local_sales_tax_rate_r3'].'" name="op_tp_local_sales_tax_rate_r3" id="op_tp_local_sales_tax_rate_r3" value="'.formatNum($inputs['op_tp_local_sales_tax_rate_r3'],'pct').'" />%</td>
					';
				} else {
					echo '<td>'.formatNum($inputs['op_tp_local_sales_tax_rate_r3'],'pct').'%</td>
					';
				}
			echo '</tr>
			<tr>
				<td class="ind1">Sales Tax Exemption (Percent of local taxes) '.tip('pcd_18').'</td>
				';
				if ($yes == 0) {
					echo '<td class="highlight"><input type="text" class="cost int pct '.$hl['op_tp_sales_tax_exemption_r1'].'" name="op_tp_sales_tax_exemption_r1" id="op_tp_sales_tax_exemption_r1" value="'.formatNum($inputs['op_tp_sales_tax_exemption_r1'],'pct').'" />%</td>
					';
				} else {
					echo '<td class="highlight">'.formatNum($inputs['op_tp_sales_tax_exemption_r1'],'pct').'%</td>
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
					echo '<td class="highlight">$<input type="text" class="cost int '.$hl['op_pp_contstruction_workers_installers_r1'].'" name="op_pp_contstruction_workers_installers_r1" id="op_pp_contstruction_workers_installers_r1" value="'.formatNum($inputs['op_pp_contstruction_workers_installers_r1'],'dec2').'" /></td>
					';
				} else {
					echo '<td class="highlight">$'.formatNum($inputs['op_pp_contstruction_workers_installers_r1'],'dec2').'</td>
					';
				}
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['op_pp_contstruction_workers_installers_r3'].'" name="op_pp_contstruction_workers_installers_r3" id="op_pp_contstruction_workers_installers_r3" value="'.formatNum($inputs['op_pp_contstruction_workers_installers_r3'],'pct1').'" />%</td>
					';
				} else {
					echo '<td>'.formatNum($inputs['op_pp_contstruction_workers_installers_r3'],'pct1').'%</td>
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
					echo '<td class="highlight">$<input type="text" class="cost int '.$hl['op_pp_technicians_r1'].'" name="op_pp_technicians_r1" id="op_pp_technicians_r1" value="'.formatNum($inputs['op_pp_technicians_r1'],'dec2').'" /></td>
					';
				} else {
					echo '<td class="highlight">$'.formatNum($inputs['op_pp_technicians_r1'],'dec2').'</td>
					';
				}
				if ($yes == 0) {
					echo '<td><input type="text" class="cost int pct '.$hl['op_pp_technicians_r3'].'" name="op_pp_technicians_r3" id="op_pp_technicians_r3" value="'.formatNum($inputs['op_pp_technicians_r3'],'pct1').'" />%</td>
					';
				} else {
					echo '<td>'.formatNum($inputs['op_pp_technicians_r3'],'pct1').'%</td>
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
