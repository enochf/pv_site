<?php
// =================== GENERAL ARRAYS =================== //
$states = array('AL'=>'Alabama','AK'=>'Alaska','AZ'=>'Arizona','AR'=>'Arkansas','CA'=>'California','CO'=>'Colorado','CT'=>'Connecticut','DE'=>'Delaware','DC'=>'District Of Columbia','FL'=>'Florida','GA'=>'Georgia','HI'=>'Hawaii','ID'=>'Idaho','IL'=>'Illinois','IN'=>'Indiana','IA'=>'Iowa','KS'=>'Kansas','KY'=>'Kentucky','LA'=>'Louisiana','ME'=>'Maine','MD'=>'Maryland','MA'=>'Massachusetts','MI'=>'Michigan','MN'=>'Minnesota','MS'=>'Mississippi','MO'=>'Missouri','MT'=>'Montana','NE'=>'Nebraska','NV'=>'Nevada','NH'=>'New Hampshire','NJ'=>'New Jersey','NM'=>'New Mexico','NY'=>'New York','NC'=>'North Carolina','ND'=>'North Dakota','OH'=>'Ohio','OK'=>'Oklahoma','OR'=>'Oregon','PA'=>'Pennsylvania','RI'=>'Rhode Island','SC'=>'South Carolina','SD'=>'South Dakota','TN'=>'Tennessee','TX'=>'Texas','UT'=>'Utah','VT'=>'Vermont','VA'=>'Virginia','WA'=>'Washington','WV'=>'West Virginia','WI'=>'Wisconsin','WY'=>'Wyoming');
$regions = array('Region1'=>'Region 1 - Northeast','Region2'=>'Region 2 - Mid-Atlantic North','Region3'=>'Region 3 - Mid-Atlantic South','Region4'=>'Region 4 - Southeast','Region5'=>'Region 5 - Midwest','Region6'=>'Region 6 - Southern','Region7'=>'Region 7 - Western','Region8'=>'Region 8 - California &amp; Hawaii');
$months = array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
// =================== DATASET ARRAYS =================== //
$systemApp = array('RN'=>'Residential New Construction','RR'=>'Residential Retrofit','SC'=>'Small Commercial','LC'=>'Large Commercial','UT'=>'Utility');
$solarMat = array('TF'=>'Thin Film','CS'=>'Crystalline Silicon');
$systemTrack = array('FM'=>'Fixed Mount','SA'=>'Single Axis');
$sectors = array('Ag, Forestry, Fish & Hunting','Mining','Construction','Construction/Installations - Non Residential','Construction/Installation Residential','Manufacturing','Fabricated Metals','Machinery','Electrical Equip','Battery Manufacturing','Energy Wire Manufacturing','Wholesale Trade','Retail trade','TCPU','Insurance and Real Estate','Finance','Other Professional Services','Office Services','Architectural and Engineering Services','Other services','Government','Semiconductor (solar cell/module) manufacturing');
// =================== BASE DATA ARRAYS =================== //
function getMyVals() {
	global $link,$uid,$sid,$key;
	if ($sid) {
		$vals = array();
		$q = "SELECT vals FROM scenarios WHERE ((sID=?) AND (uID=?))";
		$var = query($q,array($sid,$uid),'s','Get Vals 1');
		if ($var[0]['vals'] != '') {
			$jsonArray = json_decode($var[0]['vals']);
			foreach($jsonArray as $k => $v) {
				$vals[$k] = $v;
				$hl[$k] = 'highlight';
			}
		}
	} else if ($key) {
		$vals = array();
		$q = "SELECT vals FROM scenarios WHERE (runkey='?')";
		$var = query($q,array($key),'s','Get Vals 2');
		if ($var[0]['vals'] != '') {
			$jsonArray = json_decode($var[0]['vals']);
			foreach($jsonArray as $k => $v) {
				$_SESSION['tmp'][0][$k] = $v;
				$_SESSION['tmp'][1][$k] = 'highlight';
			}
		}
		$vals = $_SESSION['tmp'][0];
		$hl = $_SESSION['tmp'][1];
		$_SESSION['message'] = '<div id="message10">This is a shared model run. Please login to save it.</div>';
	} else {
		if (!$_SESSION['tmp']) {
			$_SESSION['tmp'] = array(array(),array());
		}
		$vals = $_SESSION['tmp'][0];
		$hl = $_SESSION['tmp'][1];
	}
	return $allVals = array($vals,$hl);
}
function getBaseData() {
	global $link,$states;
	// x_dd1

	$q = "SELECT * FROM x_dd1";
	foreach(query($q,array(),'s','DD1') as $var) {
		for($i = 1; $i <= 23; $i++) {
			$x['dd1'][$var['id']]['v'.$i] = $var['v'.$i];
		}
	}
	// x_dd2
	$q = "SELECT * FROM x_dd2";
	foreach(query($q,array(),'s','DD2') as $var) {
		for($i = 1; $i <= 23; $i++) {
			$x['dd2'][$var['id']]['v'.$i] = $var['v'.$i];
		}
	}
	// x_dd3
	$q = "SELECT * FROM x_dd3";
	foreach(query($q,array(),'s','DD3') as $var) {
		$x_dd3[$var['itemID']]['desc'] = $var['desc'];
		foreach($states as $k => $v) {
			$x['dd3'][$var['itemID']][$k] = $var[$k];
		}
	}
	// x_df1
	$q = "SELECT * FROM x_df1";
	foreach(query($q,array(),'s','DF1') as $var) {
		for($i = 1996; $i <= 2031; $i++) {
			$x['df1'][$var['id']][$i] = $var[$i];
		}
	}
	// x_he1
	$q = "SELECT * FROM x_he1";
	foreach(query($q,array(),'s','HE1') as $var) {
		$x_he1[$var['itemID']]['desc'] = $var['desc'];
		foreach($states as $k => $v) {
			$x['he1'][$var['itemID']][$k] = $var[$k];
		}
	}
	// x_mu1
	$q = "SELECT * FROM x_mu1";
	foreach(query($q,array(),'s','MU1') as $var) {
		$x_mu1[$var['itemID']]['desc'] = $var['desc'];
		foreach($states as $k => $v) {
			$x['mu1'][$var['itemID']][$k] = $var[$k];
		}
	}
	// x_mu2
	$q = "SELECT * FROM x_mu2";
	foreach(query($q,array(),'s','MU2') as $var) {
		$x_mu2[$var['itemID']]['desc'] = $var['desc'];
		foreach($states as $k => $v) {
			$x['mu2'][$var['itemID']][$k] = $var[$k];
		}
	}
	// x_mu3
	$q = "SELECT * FROM x_mu3";
	foreach(query($q,array(),'s','MU3') as $var) {
		$x_mu3[$var['itemID']]['desc'] = $var['desc'];
		foreach($states as $k => $v) {
			$x['mu3'][$var['itemID']][$k] = $var[$k];
		}
	}
	// x_mu4
	$q = "SELECT * FROM x_mu4";
	foreach(query($q,array(),'s','MU4') as $var) {
		$x_mu4[$var['itemID']]['desc'] = $var['desc'];
		foreach($states as $k => $v) {
			$x['mu4'][$var['itemID']][$k] = $var[$k];
		}
	}
	// x_mu5
	$q = "SELECT * FROM x_mu5";
	foreach(query($q,array(),'s','MU5') as $var) {
		$x_mu5[$var['itemID']]['desc'] = $var['desc'];
		foreach($states as $k => $v) {
			$x['mu5'][$var['itemID']][$k] = $var[$k];
		}
	}
	// x_mu6
	$q = "SELECT * FROM x_mu6";
	foreach(query($q,$vars,'s','MU6') as $var) {
		$x_mu6[$var['itemID']]['desc'] = $var['desc'];
		foreach($states as $k => $v) {
			$x['mu6'][$var['itemID']][$k] = $var[$k];
		}
	}
	// x_mu7
	$q = "SELECT * FROM x_mu7";
	foreach(query($q,array(),'s','MU7') as $var) {
		$x_mu7[$var['itemID']]['desc'] = $var['desc'];
		foreach($states as $k => $v) {
			$x['mu7'][$var['itemID']][$k] = $var[$k];
		}
	}
	// x_mu8
	$q = "SELECT * FROM x_mu8";
	foreach(query($q,array(),'s','MU8') as $var) {
		$x_mu8[$var['itemID']]['desc'] = $var['desc'];
		foreach($states as $k => $v) {
			$x['mu8'][$var['itemID']][$k] = $var[$k];
		}
	}
	// x_mu9
	$q = "SELECT * FROM x_mu9";
	foreach(query($q,array(),'s','MU9') as $var) {
		$x_mu9[$var['itemID']]['desc'] = $var['desc'];
		foreach($states as $k => $v) {
			$x['mu9'][$var['itemID']][$k] = $var[$k];
		}
	}
	return $x;
}
// =================== DEFAULT DATA ARRAYS =================== //
function getDefaultData() {
	// Values are numbered based on the next occurance of a default value in the data set top to bottom and then column by column.
	$d['ds1'] = array(
		1 => 'AZ',
		2 => '',
		3 => 2011,
		4 => 'Residential New Construction',
		5 => 'Crystalline Silicon',
		6 => 'Fixed Mount',
		// 7 => 2.5, This value became t1c['ds1'][1] because it is actually references another cell
		8 => 2010,
		9 => 'Y'
	);
	// ds6 through ds15
	for($y = 6; $y <= 15; $y++) {
		for($i = 1; $i <= 44; $i++) {
			$d['ds'.$y][$i] = 0;
		}
	}
	$d['ds17'] = array(
		1 => 1,
		2 => 1,
		3 => 1,
		4 => 1,
		5 => 1,
		6 => 1,
		7 => 1,
		8 => 1,
		
		9 => 30000,
		10 => 0,
		11 => 0,
		12 => 0,
		13 => 0,
		14 => .1,
		15 => 1,
		16 => 0,
		17 => 0,
		
		18 => 100000,
		19 => 1,
		20 => 1,
		21 => 1,
		22 => 1,
		23 => .1,
		24 => 1,
		25 => 1,
		26 => 1,
		
		27 => 300000,
		28 => 1,
		29 => 1,
		30 => 1,
		31 => 1,
		32 => .5,
		33 => 1,
		34 => 1,
		35 => 1,
		
		36 => 400000,
		37 => 1,
		38 => 1,
		39 => .5,
		40 => 1,
		41 => 1,
		42 => 1,
	);
	$d['ds18'] = array(
		1 => 1,
		2 => 1,
		3 => 1,
		
		4 => 1,
		5 => 0,
		6 => 0,
		
		7 => 1,
		8 => 1,
		9 => 1,
		
		10 => 1,
		11 => 1,
		12 => 1,
		
		13 => 1,
		14 => 1,
		15 => 1,
	);
	$d['ds19'] = array(
		1 => .8,
		2 => 10,
		3 => .1,
		4 => 0,
		5 => 0,
		6 => 0,
		
		7 => 0,
		8 => 1,
		9 => 1,
		10 => 1,
		
		11 => 23951776.0227276,
		12 => 486225444.068377,
	);
	$d['ds20'] = array(
		1 => 'N',
		2 => 'N',
		3 => 'N',
		4 => 'N',
		5 => 'N',
	);
	$d['ds21'] = array(
		1 => 0,
		2 => 10,
		3 => 100,
		4 => 500,
		5 => 10,
		6 => 100,
		7 => 500,
	);
	$d['ds22'] = array(
		1 => 8.20632239382239,
		2 => 7.87333333333333,
		3 => 7.32718146718147,
		4 => 7.2,
		
		5 => 2,
		6 => 5,
		7 => 10,
		8 => 30,
		9 => 100,
		10 => 250,
		11 => 500,
		12 => 750,
		
		13 => 9.9,
		14 => 8.2,
		15 => 7.6,
		16 => 7.5,
		17 => 7.9,
		18 => 7.9,
		19 => 6.9,
		20 => 6.6,
		21 => 7.1,
	);
	// UPDATED VALUES FOR CELLS 1 - 4
	if ($d['ds1'][4] != "Utility") {
		$ds23_1234 = .8;
	}
	$d['ds23'] = array(
		1 => $ds23_1234,
		2 => $ds23_1234,
		3 => $ds23_1234,
		4 => $ds23_1234,
		5 => .0711869455141161,
		6 => .304874156968704,
	);
	$d['ds24'] = array(
		1 => 27.49,
		2 => 25,
	);
	$d['ds27'] = array(
		1 => .572536092930382,
	);
	$d['ds29'] = array(
		1 => 0,
		2 => 0,
		3 => 0,
		4 => 0,
		5 => 0,
		6 => 0,
		7 => 0,
		8 => 0,
		9 => 0,
		
		10 => 0,
		11 => 0,
		12 => 0,
		13 => 0,
		14 => 0,
		15 => 0,
		16 => 0,
		17 => 0,
		18 => 0,
		
		19 => 0,
		20 => 0,
		21 => 0,
		22 => 0,
		23 => 0,
		24 => 0,
		25 => 0,
		26 => 0,
		27 => 0,
	);
	$d['ds30'] = array(
		1 => 0,
	);
	$d['ds34'] = array(
		1 => 0,
		2 => 0,
		3 => 0,
		4 => 0,
		5 => 0,
		6 => 0,
		7 => 0,
		8 => 0,
		9 => 0,
		10 => 0,
		11 => 0,
		12 => 0,
		13 => 0,
		14 => 0,
		15 => 0,
		16 => 0,
		17 => 0,
		
		18 => 0,
		19 => 0,
		20 => 0,
		21 => 0,
		22 => 0,
		23 => 0,
		24 => 0,
		25 => 0,
	);
	$d['ds44'] = array(
		1 => 0.0279268916155419,
		
		2 => 2007,
		3 => 2,
		
		4 => 2008,
		5 => 4,
		
		6 => 2009,
		7 => 6,
		
		8 => 2010,
		9 => 8,
		
		10 => 2011,
		11 => 10,
		
		12 => 2012,
		13 => 12,
		
		14 => 2013,
		15 => 14,
		
		16 => 2014,
		17 => 16,
		
		18 => 2015,
		19 => 18,
	);
	$d['ds47'] = array(
		1 => 2008
	);
	return $d;
}
/*



















*/
?>