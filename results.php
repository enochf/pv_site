<?php include('includes/inc_docheader2.php'); ?>

<?php
require("includes/inc_arrays2.php");
require("includes/inc_functions_financial.php");
require("includes/inc_calculations_8.php");
// echo 'Q234: -'.$cell['Multipliers']['Q234'].'-<br />';
// echo 'E10: -'.$cell['UserAddInLocation']['E10'].'-<br />';
// echo 'B10: -'.$cell['UserAddInLocation']['B10'].'-<br />';
// echo 'AD3: -'.$cell['HouseholdExp']['AD3'].'-<br />';
// echo 'E1: -'.$cell['Calculations']['E1'].'-<br />';
// echo 'B12: -'.$cell['ProjectData']['B12'].'-<br /><br />';

// echo 'I71: -'.$cell['Calculations']['I71'].'-<br />';
// echo 'J71: -'.$cell['Calculations']['J71'].'-<br />';
// echo 'F71: -'.$cell['Calculations']['F71'].'-<br />';
// echo 'G71: -'.$cell['Calculations']['G71'].'-<br />';
// echo 'G72: -'.$cell['Calculations']['G72'].'-<br />';
// echo 'G69: -'.$cell['Calculations']['G69'].'-<br />';
// echo 'G73: -'.$cell['Calculations']['G73'].'-<br />';
// echo 'G78: -'.$cell['Calculations']['G78'].'-<br />';
// echo 'F121: '.$cell['Calculations']['F121'].'<br />';
// echo 'H143: '.$cell['Calculations']['H143'].'<br />';
// echo 'P143: '.$cell['Calculations']['P143'].'<br />';
// echo 'P145: '.$cell['Calculations']['P145'].'<br />';
echo 'D77: '.$cell['Calculations']['D77'].'<br />';
echo 'D78: '.$cell['Calculations']['D78'].'<br />';
echo 'G78: '.$cell['Calculations']['G78'].'<br />';
echo 'G73: '.$cell['Calculations']['G73'].'<br />';
echo 'G69: '.$cell['Calculations']['G69'].'<br />';
echo 'G71: '.$cell['Calculations']['G71'].'<br />';
// print_r($cell['Multipliers']);

/* // GET USER CHANGED VALUES FOR SCENARIO
$allVals = getMyVals();
$vals = $allVals[0];
// GET BASE DATA FROM DATABASE
$x = getBaseData();
// GET DEFAULT SCENARIO DATA
$d = getDefaultData();
// SET USER DEFINED VALUES FROM DATABASE
foreach($vals as $k => $v) {
	if (substr($k,0,2) == "d_") {
		list($calc,$ds,$num) = explode("_", $k);
		$d[$ds][$num] = $v;
	}
}
$pv = new pvj($vals,$d,$x,$systemApp,$solarMat,$systemTrack,$link);
$pv->t1(); */
// ========================================================================= Get Tool Tips //
$q = "SELECT * FROM tooltips";
foreach(query($q,array(),'s','Get Tool Tips') as $t) {
	$tip[$t['tID']] = $t['tip'];
}
?>

<?php include('includes/inc_header.php'); ?>

<?php include('includes/inc_mainnav.php'); ?>
<div id="mainbody">
	<div id="fullside">
		<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		if ($sid) {
			echo '<a href="model.php?sid='.$sid.'" class="return fr"><span class="hidden">Return to Model</span></a>
			';
		} else {
			if ($_SESSION['uID']) {
				// ========================================================================= Save Current Model Run //
				echo '<div id="saverun" class="dropdown"'.($_SESSION['openname']==1 ? ' style="display:block;"' : '').'>
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
			}
			echo '<a href="model.php" class="return fr"><span class="hidden">Return to Model</span></a>
			';
		}
		?>
		<h1><img src="images/ttl_resultssummary.gif" alt="Results Summary" /></h1>
		<div id="results">
			<?php
			if ($sid) {
				$q = "SELECT name FROM scenarios WHERE ((sID=?) AND (uID=?))";
				$var = query($q,array($sid,$uid),'s','Get Scenario Info');
			} else {
				if ($uid) {
					$var[0]['name'] = '<span id="unsaved"><img src="images/unsaved.gif" alt="unsaved" style="vertical-align:-1px;" /> Unsaved - <a href="javascript:show(\'saverun\')">Click to save</a></span>';
				} else {
					$var[0]['name'] = '<span id="unsaved"><img src="images/unsaved.gif" alt="unsaved" style="vertical-align:-1px;" /> Unsaved - <a href="login.php?url=results.php">login to save</a></span>';
				}
			}
			echo '<h2 id="current" style="border:none;">
			';
				if ($_SESSION['uID']) {
					echo '<a href="my-account.php" class="fr" style="margin-right:10px; font-size:12px;"><strong><span style="color:#00345E; font-size:16px;">&#187;</span> My Saved Model Runs</strong></a>
					';
				}
				echo '<strong>Current Model Run:</strong> <em>'.$var[0]['name'].'</em>
			</h2>
			';
			?>
			<h2>Photovoltaic - Project Data Summary</h2>
			<table>
				<tr>
					<td width="380">Project Location</td>
					<td class="highlight"><?php echo $cell['SummaryResults']['C2']; ?></td>
				</tr>
				<tr>
					<td>Year of Construction or Installation</td>
					<td class="highlight"><?php echo $cell['SummaryResults']['C3']; ?></td>
				</tr>
				<tr>
					<td>Average System Size - DC Nameplate Capacity (KW)</td>
					<td class="highlight"><?php echo $cell['SummaryResults']['C4']; ?></td>
				</tr>
				<tr>
					<td>Number of Systems Installed</td>
					<td class="highlight"><?php echo $cell['SummaryResults']['C5']; ?></td>
				</tr>
				<tr>
					<td>Project Size - DC Nameplate Capacity (KW)</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['C6'],1); ?></td>
				</tr>
				<tr>
					<td>System Application</td>
					<td class="highlight"><?php echo $cell['SummaryResults']['C7']; ?></td>
				</tr>
				<tr>
					<td>Solar Cell/Module Material</td>
					<td class="highlight"><?php echo $cell['SummaryResults']['C8']; ?></td>
				</tr>
				<tr>
					<td>System Tracking</td>
					<td class="highlight"><?php echo $cell['SummaryResults']['C9']; ?></td>
				</tr>
				<tr>
					<td>Total System Base Cost ($/KWDC) <?php echo tip('rs1_1'); ?></td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['C10'],0); ?></td>
				</tr>
				<tr>
					<td>Annual Direct Operations and Maintenance Cost ($/kW)</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['C11'],2); ?></td>
				</tr>
				<tr>
					<td>Money Value - Current or Constant (Dollar Year) </td>
					<td class="highlight"><?php echo $cell['SummaryResults']['C12']; ?></td>
				</tr>
				<tr>
					<td>Project Construction or Installation Cost <?php echo tip('rs1_2'); ?></td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['C13'],0); ?></td>
				</tr>
				<tr>
					<td class="ind1">Local Spending</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['C14'],0); ?></td>
				</tr>
				<tr>
					<td>Total Annual Operational Expenses</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['C15'],0); ?></td>
				</tr>
				<tr>
					<td class="ind1">Direct Operating and Maintenance Costs</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['C16'],0); ?></td>
				</tr>
				<tr>
					<td class="ind2">Local Spending</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['C17'],0); ?></td>
				</tr>
				<tr>
					<td class="ind1">Other Annual Costs</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['C18'],0); ?></td>
				</tr>
				<tr>
					<td class="ind2">Local Spending</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['C19'],0); ?></td>
				</tr>
				<tr>
					<td class="ind3">Debt Payments</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['C20'],0); ?></td>
				</tr>
				<tr>
					<td class="ind3">Property Taxes</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['C21'],0); ?></td>
				</tr>
			</table><br /><br />
			
			<h2>Local Economic Impacts - Summary Results</h2>
			<table>
				<tr>
					<td width="380">During construction and installation period</td>
					<td class="highlight">Jobs</td>
					<td>Earnings<br />(<?php echo $cell['SummaryResults']['C26']; ?>)</td>
					<td class="highlight">Output<br />(<?php echo $cell['SummaryResults']['D26']; ?>)</td>
				</tr>
				<tr>
					<td class="ind1">Project Development and Onsite Labor Impacts <?php echo tip('rs2_1'); ?></td>
					<td class="highlight"></td>
					<td></td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td class="ind2">Construction and Installation Labor</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B28'],1); ?></td>
					<td>$<?php echo number_format($cell['SummaryResults']['C28'],2); ?></td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td class="ind2">Construction and Installation Related Services <?php echo tip('rs2_2'); ?></td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B29'],1); ?></td>
					<td>$<?php echo number_format($cell['SummaryResults']['C29'],2); ?></td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td class="ind2">Subtotal</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B30'],1); ?></td>
					<td>$<?php echo number_format($cell['SummaryResults']['C30'],2); ?></td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['D30'],2); ?></td>
				</tr>
				<tr>
					<td class="ind1">Module and Supply Chain Impacts <?php echo tip('rs2_3'); ?></td>
					<td class="highlight"></td>
					<td></td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td class="ind2">Manufacturing Impacts</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B32'],1); ?></td>
					<td>$<?php echo number_format($cell['SummaryResults']['C32'],2); ?></td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['D32'],2); ?></td>
				</tr>
				<tr>
					<td class="ind2">Trade (Wholesale and Retail)</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B33'],1); ?></td>
					<td>$<?php echo number_format($cell['SummaryResults']['C33'],2); ?></td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['D33'],2); ?></td>
				</tr>
				<tr>
					<td class="ind2">Finance, Insurance and Real Estate</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B34'],1); ?></td>
					<td>$<?php echo number_format($cell['SummaryResults']['C34'],2); ?></td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['D34'],2); ?></td>
				</tr>
				<tr>
					<td class="ind2">Professional Services</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B35'],1); ?></td>
					<td>$<?php echo number_format($cell['SummaryResults']['C35'],2); ?></td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['D35'],2); ?></td>
				</tr>
				<tr>
					<td class="ind2">Other Services</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B36'],1); ?></td>
					<td>$<?php echo number_format($cell['SummaryResults']['C36'],2); ?></td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['D36'],2); ?></td>
				</tr>
				<tr>
					<td class="ind2">Other Sectors</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B37'],1); ?></td>
					<td>$<?php echo number_format($cell['SummaryResults']['C37'],2); ?></td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['D37'],2); ?></td>
				</tr>
				<tr>
					<td class="ind2">Subtotal</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B38'],1); ?></td>
					<td>$<?php echo number_format($cell['SummaryResults']['C38'],2); ?></td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['D38'],2); ?></td>
				</tr>
				<tr>
					<td class="ind2">Induced Impacts <?php echo tip('rs2_4'); ?></td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B39'],1); ?></td>
					<td>$<?php echo number_format($cell['SummaryResults']['C39'],2); ?></td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['D39'],2); ?></td>
				</tr>
				<tr class="bld">
					<td>Total Impacts</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B40'],1); ?></td>
					<td>$<?php echo number_format($cell['SummaryResults']['C40'],2); ?></td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['D40'],2); ?></td>
				</tr>
				<tr>
					<td width="380">&nbsp;</td>
					<td class="highlight">&nbsp;</td>
					<td>&nbsp;</td>
					<td class="highlight">&nbsp;</td>
				</tr>
				<tr>
					<td>During operating years</td>
					<td class="highlight">Annual Jobs</td>
					<td>Annual Earnings<br />(<?php echo $cell['SummaryResults']['C44']; ?>)</td>
					<td class="highlight">Annual Output<br />(<?php echo $cell['SummaryResults']['D44']; ?>)</td>
				</tr>
				<tr>
					<td class="ind1">Onsite Labor Impacts <?php echo tip('rs2_5'); ?></td>
					<td class="highlight"></td>
					<td></td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td class="ind2">PV Project Labor Only <?php echo tip('rs2_6'); ?></td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B46'],1); ?></td>
					<td>$<?php echo number_format($cell['SummaryResults']['C46'],2); ?></td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['D46'],2); ?></td>
				</tr>
				<tr>
					<td class="ind1">Local Revenue and Supply Chain Impacts <?php echo tip('rs2_7'); ?></td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B47'],1); ?></td>
					<td>$<?php echo number_format($cell['SummaryResults']['C47'],2); ?></td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['D47'],2); ?></td>
				</tr>
				<tr>
					<td class="ind1">Induced Impacts <?php echo tip('rs2_8'); ?></td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B48'],1); ?></td>
					<td>$<?php echo number_format($cell['SummaryResults']['C48'],2); ?></td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['D48'],2); ?></td>
				</tr>
				<tr class="bld">
					<td>Total Impacts</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B49'],1); ?></td>
					<td>$<?php echo number_format($cell['SummaryResults']['C49'],2); ?></td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['D49'],2); ?></td>
				</tr>
				<tr>
					<td colspan="4" class="note">
					Notes:  Earnings and Output values are thousands of dollars in year <?php echo $pv->sr1c['sr1'][11]; ?> dollars.  Construction and operating period jobs are full-time equivalent for one year (1 FTE = 2,080 hours).  Economic impacts "During 
operating years" represent impacts that occur from system/plant operations/expenditures.  Totals may not add up due to independent rounding.
					</td>
				</tr>
			</table><br /><br />
			
			<h2>Detailed PV Project Data Costs</h2>
			<table>
				<tr>
					<td width="380">Installation Costs</td>
					<td class="highlight">Cost</td>
					<td>Purchased Locally (%)</td>
					<td class="highlight">Manufactured Locally (Y or N)</td>
				</tr>
				<tr>
					<th colspan="4">Materials &amp; Equipment</td>
				</tr>
				<tr>
					<td class="ind1">Mounting (rails, clamps, fittings, etc.)</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B59'],0); ?></td>
					<td><?php echo number_format($cell['SummaryResults']['C59'] * 100,0); ?>%</td>
					<td class="highlight"><?php echo $cell['SummaryResults']['D59']; ?></td>
				</tr>
				<tr>
					<td class="ind1">Modules</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B60'],0); ?></td>
					<td><?php echo number_format($cell['SummaryResults']['C60'] * 100,0); ?>%</td>
					<td class="highlight"><?php echo $cell['SummaryResults']['D60']; ?></td>
				</tr>
				<tr>
					<td class="ind1">Electrical (wire, connectors, breakers, etc.)</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B61'],0); ?></td>
					<td><?php echo number_format($cell['SummaryResults']['C61'] * 100,0); ?>%</td>
					<td class="highlight"><?php echo $cell['SummaryResults']['D61']; ?></td>
				</tr>
				<tr>
					<td class="ind1">Inverter</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B62'],0); ?></td>
					<td><?php echo number_format($cell['SummaryResults']['C62'] * 100,0); ?>%</td>
					<td class="highlight"><?php echo $cell['SummaryResults']['D62']; ?></td>
				</tr>
				<tr>
					<td class="ind1">Subtotal</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B63'],0); ?></td>
					<td></td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<th colspan="4">Labor</td>
				</tr>
				<tr>
					<td class="ind1">Installation</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B65'],0); ?></td>
					<td><?php echo number_format($cell['SummaryResults']['C65'] * 100,0); ?>%</td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td class="ind1">Subtotal</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B66'],0); ?></td>
					<td></td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td>Subtotal</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B67'],0); ?></td>
					<td></td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<th colspan="4">Other Costs</td>
				</tr>
				<tr>
					<td class="ind1">Permitting</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B69'],0); ?></td>
					<td><?php echo number_format($cell['SummaryResults']['C69'] * 100,0); ?>%</td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td class="ind1">Other Costs</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B70'],0); ?></td>
					<td><?php echo number_format($cell['SummaryResults']['C70'] * 100,0); ?>%</td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td class="ind1">Business Overhead</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B71'],0); ?></td>
					<td><?php echo number_format($cell['SummaryResults']['C71'] * 100,0); ?>%</td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td class="ind1">Subtotal</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B72'],0); ?></td>
					<td></td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td>Subtotal</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B73'],0); ?></td>
					<td></td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td>Sales Tax (Materials &amp; Equipment Purchases)</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B74'],0); ?></td>
					<td><?php echo number_format($cell['SummaryResults']['C74'] * 100,0); ?>%</td>
					<td class="highlight"></td>
				</tr>
				<tr class="bld">
					<td>Total</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B75'],0); ?></td>
					<td></td>
					<td class="highlight"></td>
				</tr>
			</table><br /><br />
			
			<h2>PV System Annual Operating and Maintenance Costs</h2>
			<table>
				<tr>
					<td width="380">Labor</td>
					<td class="highlight">Cost</td>
					<td>Local Share</td>
					<td class="highlight">Manufactured Locally (Y or N)</td>
				</tr>
				<tr>
					<td class="ind1">Technicians</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B80'],0); ?></td>
					<td><?php echo number_format($cell['SummaryResults']['C80'] * 100,0); ?>%</td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td class="ind1">Subtotal</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B81'],0); ?></td>
					<td></td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<th colspan="4">Materials and Services</td>
				</tr>
				<tr>
					<td class="ind1">Materials &amp; Equipment</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B83'],0); ?></td>
					<td><?php echo number_format($cell['SummaryResults']['C83'] * 100,0); ?>%</td>
					<td class="highlight"><?php echo $cell['SummaryResults']['D83']; ?></td>
				</tr>
				<tr>
					<td class="ind1">Services</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B84'],0); ?></td>
					<td><?php echo number_format($cell['SummaryResults']['C84'] * 100,0); ?>%</td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td class="ind1">Subtotal</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B85'],0); ?></td>
					<td></td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td>Sales Tax (Materials &amp; Equipment Purchases)</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B86'],0); ?></td>
					<td><?php echo number_format($cell['SummaryResults']['C86'] * 100,0); ?>%</td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td>Average Annual Payment (Interest and Principal)</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B87'],0); ?></td>
					<td><?php echo number_format($cell['SummaryResults']['C87'] * 100,0); ?>%</td>
					<td class="highlight"></td>
				</tr>
				<tr>
					<td>Property Taxes</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B88'],0); ?></td>
					<td><?php echo number_format($cell['SummaryResults']['C88'] * 100,0); ?>%</td>
					<td class="highlight"></td>
				</tr>
				<tr class="bld">
					<td>Total</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B89'],0); ?></td>
					<td></td>
					<td class="highlight"></td>
				</tr>
			</table><br /><br />
			
			<h2>Other Parameters</h2>
			<table>
				<tr>
					<th colspan="3">Financial Parameters</td>
				</tr>
				<tr>
					<th colspan="3">Debt Financing</td>
				</tr>
				<tr>
					<td width="380" class="ind1">Percentage financed</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B94'] * 100,0); ?>%</td>
					<td><?php echo number_format($cell['SummaryResults']['C94'] * 100,0); ?>%</td>
				</tr>
				<tr>
					<td class="ind1">Years financed (term)</td>
					<td class="highlight"><?php echo $cell['SummaryResults']['B95']; ?></td>
					<td></td>
				</tr>
				<tr>
					<td class="ind1">Interest rate</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B96'] * 100,0); ?>%</td>
					<td></td>
				</tr>
				<tr>
					<th colspan="3">Tax Parameters</td>
				</tr>
				<tr>
					<td class="ind1">Local Property Tax (percent of taxable value)</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B98'] * 100,0); ?>%</td>
					<td></td>
				</tr>
				<tr>
					<td class="ind1">Assessed Value (percent of construction cost)</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B99'] * 100,0); ?>%</td>
					<td></td>
				</tr>
				<tr>
					<td class="ind1">Taxable Value (percent of assessed value)</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B100'] * 100,0); ?>%</td>
					<td></td>
				</tr>
				<tr>
					<td class="ind1">Taxable Value</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B101'],0); ?></td>
					<td></td>
				</tr>
				<tr>
					<td class="ind1">Property Tax Exemption (percent of local taxes)</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B102'] * 100,0); ?>%</td>
					<td></td>
				</tr>
				<tr>
					<td class="ind1">Local Property Taxes</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B103'],0); ?></td>
					<td><?php echo number_format($cell['SummaryResults']['C103'] * 100,0); ?>%</td>
				</tr>
				<tr>
					<td class="ind1">Local Sales Tax Rate</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B104'] * 100,2); ?>%</td>
					<td><?php echo number_format($cell['SummaryResults']['C104'] * 100,0); ?>%</td>
				</tr>
				<tr>
					<td class="ind1">Sales Tax Exemption (percent of local taxes)</td>
					<td class="highlight"><?php echo number_format($cell['SummaryResults']['B105'] * 100,0); ?>%</td>
					<td></td>
				</tr>
				<tr>
					<th>Payroll Parameters</th>
					<th class="highlight">Wage per hour</th>
					<th>Employer Payroll Overhead</th>
				</tr>
				<tr>
					<th colspan="3">Construction and Installation Labor</th>
				</tr>
				<tr>
					<td class="ind1">Construction Workers / Installers</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B108'],2); ?></td>
					<td><?php echo number_format(($cell['SummaryResults']['C108'] * 100),1); ?>%</td>
				</tr>
				<tr>
					<th colspan="3">O&amp;M Labor</th>
				</tr>
				<tr>
					<td class="ind1">Technicians</td>
					<td class="highlight">$<?php echo number_format($cell['SummaryResults']['B110'],2); ?></td>
					<td><?php echo number_format(($cell['SummaryResults']['C110'] * 100),1); ?>%</td>
				</tr>
			</table><br /><br />

		</div><!-- END: results -->
		<p>&nbsp;</p>
		<p>
		<?php
		if ($sid) {
			echo '<a href="model.php?sid='.$sid.'" class="return" style="margin:0px auto;"><span class="hidden">Return to Model</span></a>
			';
		} else {
			echo '<a href="model.php" class="return" style="margin:0px auto;"><span class="hidden">Return to Model</span></a>
			';
		}
		?>
		</p>
		<div class="clr"></div>
	</div><!-- END: fullside -->
</div><!-- END: mainbody -->

<?php include('includes/inc_footer.php'); ?>

</body>
</html>






















