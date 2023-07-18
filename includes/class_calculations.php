<?php
/***********************************************
				Class Structure
				
	the pvj class is set up by passing in
	various arrays set up with the two 
	functions: getBaseData() and getDefaultData().
	
	The class is then started by a call to the
	function t1() which will then begin the
	chain of functions, each one calling the
	next tier of calculations, until the final
	results are output in the sr1() function.
	
		Function Sequence
			__construct()
			t1() ->
			t2() ->
			t3() ->
			t4() ->
			t5() ->
			t6() ->
			t7() ->
			sr1()
	
***********************************************/
class pvj {
	function __construct($vals,$d,$x,$systemApp,$solarMat,$systemTrack) {
		$this->vals = $vals;
		$this->d = $d;
		$this->x = $x;
		$this->sa = $systemApp;
		$this->sm = $solarMat;
		$this->st = $systemTrack;
		// forces the precision for calculations in excel financial functions
		ini_set('precision', '14');
	}
	function t1() {
// DATA SET 1 - (ProjectData! Project Descriptive Data)
		foreach($this->sa as $k => $v) {
			if ($v == $this->d['ds1'][4]) {
				$sysApp = $k;
				break;
			}
		}
		foreach($this->sm as $k => $v) {
			if ($v == $this->d['ds1'][5]) {
				$solMat = $k;
				break;
			}
		}
		foreach($this->st as $k => $v) {
			if ($v == $this->d['ds1'][6]) {
				$sysTrk = $k;
				break;
			}
		}
		// the following value was formerly $d['ds1'][7] from the Default Data Array
		if ($this->vals['t1c_ds1_1']) {
			$this->t1c['ds1'][1] = $this->vals['t1c_ds1_1'];
		} else {
			$this->t1c['ds1'][1] = $this->x['dd1'][$sysApp.$solMat.$sysTrk]['v2'];
		}
		// ========== GET NEW VALUE FOR $this->d['ds24'][1]
		if ($this->t1c['ds1'][1] < $this->d['ds21'][2]) {
			$this->t1c['ds21'][3] = 2;
		} else if ($this->t1c['ds21'][2] < $this->d['ds21'][3]) {
			$this->t1c['ds21'][3] = 3;
		} else {
			$this->t1c['ds21'][3] = 4;
		}
		$this->t1c['ds21'][4] = $this->x['dd3'][$this->t1c['ds21'][3]-1][$this->d['ds1'][1]];
		if ($this->t1c['ds21'][4] == 0) {
			$this->d['ds24'][1] = 27.49;
		} else {
			$this->d['ds24'][1] = 27.49 * $this->t1c['ds21'][4];
		}
		// ========== END NEW VALUE
		
		
// DATA SET 2 - (ProjectData! Project Cost Data, PV System Annual Operating and Maintenance Costs, Other Parameters)
		for ($i = 1; $i <= 6; $i++) {
			if ($this->vals['t1c_ds2_'.$i]) {
				if ($i != 2) {
					$this->t1c['ds2'][$i] = $this->vals['t1c_ds2_'.$i] / 100;
				} else {
					$this->t1c['ds2'][$i] = $this->vals['t1c_ds2_'.$i];
				}
			} else {
				$this->t1c['ds2'][$i] = $this->d['ds19'][$i];
			}
		}
		if ($this->vals['t1c_ds2_7']) {
			$this->t1c['ds2'][7] = $this->vals['t1c_ds2_7'];
		} else {
			$this->t1c['ds2'][7] = $this->d['ds24'][1];
		}
		if ($this->vals['t1c_ds2_8']) {
			$this->t1c['ds2'][8] = $this->vals['t1c_ds2_8'];
		} else {
			$this->t1c['ds2'][8] = $this->d['ds24'][2];
		}
		for($i = 9; $i <= 11; $i++) {
			if ($this->vals['t1c_ds2_'.$i]) {
				$this->t1c['ds2'][$i] = $this->vals['t1c_ds2_'.$i] / 100;
			} else {
				$this->t1c['ds2'][$i] = $this->d['ds19'][$i-2];
			}
		}
		for($i = 12; $i <= 16; $i++) {
			if ($this->vals['t1c_ds2_'.$i]) {
				$this->t1c['ds2'][$i] = $this->vals['t1c_ds2_'.$i];
			} else {
				$this->t1c['ds2'][$i] = $this->d['ds20'][$i-11];
			}
		}
// DATA SET 3 - (ProjectData! Misc. Calculations)
		$this->t1c['ds3'][1] = $this->d['ds19'][1];
		$this->t1c['ds3'][2] = $this->d['ds19'][2];
		$this->t1c['ds3'][3] = $this->d['ds19'][3];
		$this->t1c['ds3'][4] = $this->d['ds19'][4];
		$this->t1c['ds3'][5] = $this->d['ds19'][5];
		$this->t1c['ds3'][6] = $this->d['ds19'][6];
		$this->t1c['ds3'][7] = $this->d['ds19'][7];
		$this->t1c['ds3'][8] = $this->d['ds19'][8];
		$this->t1c['ds3'][9] = $this->d['ds19'][9];
		$this->t1c['ds3'][10] = $this->d['ds20'][1];
		$this->t1c['ds3'][11] = $this->d['ds20'][2];
		$this->t1c['ds3'][12] = $this->d['ds20'][3];
		$this->t1c['ds3'][13] = $this->d['ds20'][4];
		$this->t1c['ds3'][14] = $this->d['ds20'][5];
// DATA SET 16 - (DefaultData! Misc. Calculations)
		$this->t1c['ds16'][1] = $this->d['ds1'][4];
		$this->t1c['ds16'][2] = $this->t1c['ds1'][1];
		if ($this->t1c['ds16'][1] == 'Residential New Construction' OR $this->t1c['ds16'][1] == 'Residential Retrofit') {
			$this->t1c['ds16'][3] = 1;
		} else {
			$this->t1c['ds16'][3] = 2;
		}
// DATA SET 17 - (DefaultData! Project Data)
		$this->t1c['ds17'][1] = $this->d['ds17'][1];
		$this->t1c['ds17'][2] = $this->d['ds17'][2];
		$this->t1c['ds17'][3] = $this->d['ds1'][2];
		$this->t1c['ds17'][4] = ($this->t1c['ds17'][3] - $this->d['ds17'][9]) / ($this->d['ds17'][18] - $this->d['ds17'][9]);
		$this->t1c['ds17'][5] = ($this->t1c['ds17'][3] - $this->d['ds17'][9]) / ($this->d['ds17'][18] - $this->d['ds17'][9]);
		$this->t1c['ds17'][6] = ($this->t1c['ds17'][3] - $this->d['ds17'][9]) / ($this->d['ds17'][18] - $this->d['ds17'][9]);
		$this->t1c['ds17'][7] = ($this->t1c['ds17'][3] - $this->d['ds17'][9]) / ($this->d['ds17'][18] - $this->d['ds17'][9]);
		$this->t1c['ds17'][8] = ($this->t1c['ds17'][3] - $this->d['ds17'][9]) / ($this->d['ds17'][18] - $this->d['ds17'][9]);
		$this->t1c['ds17'][9] = ($this->t1c['ds17'][3] - $this->d['ds17'][9]) / ($this->d['ds17'][18] - $this->d['ds17'][9]);
		$this->t1c['ds17'][10] = ($this->t1c['ds17'][3] - $this->d['ds17'][9]) / ($this->d['ds17'][18] - $this->d['ds17'][9]);
		$this->t1c['ds17'][11] = ($this->t1c['ds17'][3] - $this->d['ds17'][9]) / ($this->d['ds17'][18] - $this->d['ds17'][9]);
		$this->t1c['ds17'][12] = $this->d['ds17'][19] - $this->d['ds17'][10];
		$this->t1c['ds17'][13] = $this->d['ds17'][20] - $this->d['ds17'][11];
		$this->t1c['ds17'][14] = $this->d['ds17'][21] - $this->d['ds17'][12];
		$this->t1c['ds17'][15] = $this->d['ds17'][22] - $this->d['ds17'][13];
		$this->t1c['ds17'][16] = $this->d['ds17'][23] - $this->d['ds17'][14];
		$this->t1c['ds17'][17] = $this->d['ds17'][24] - $this->d['ds17'][15];
		$this->t1c['ds17'][18] = $this->d['ds17'][25] - $this->d['ds17'][16];
		$this->t1c['ds17'][19] = $this->d['ds17'][26] - $this->d['ds17'][17];
		$this->t1c['ds17'][20] = $this->d['ds17'][10] + ($this->t1c['ds17'][12] * $this->t1c['ds17'][4]);
		$this->t1c['ds17'][21] = $this->d['ds17'][11] + ($this->t1c['ds17'][13] * $this->t1c['ds17'][5]);
		$this->t1c['ds17'][22] = $this->d['ds17'][12] + ($this->t1c['ds17'][14] * $this->t1c['ds17'][6]);
		$this->t1c['ds17'][23] = $this->d['ds17'][13] + ($this->t1c['ds17'][15] * $this->t1c['ds17'][7]);
		$this->t1c['ds17'][24] = $this->d['ds17'][14] + ($this->t1c['ds17'][16] * $this->t1c['ds17'][8]);
		$this->t1c['ds17'][25] = $this->d['ds17'][15] + ($this->t1c['ds17'][17] * $this->t1c['ds17'][9]);
		$this->t1c['ds17'][26] = $this->d['ds17'][16] + ($this->t1c['ds17'][18] * $this->t1c['ds17'][10]);
		$this->t1c['ds17'][27] = $this->d['ds17'][17] + ($this->t1c['ds17'][19] * $this->t1c['ds17'][11]);
		$this->t1c['ds17'][28] = ($this->t1c['ds17'][3] - $this->d['ds17'][18]) / ($this->d['ds17'][27] - $this->d['ds17'][18]);
		$this->t1c['ds17'][29] = ($this->t1c['ds17'][3] - $this->d['ds17'][18]) / ($this->d['ds17'][27] - $this->d['ds17'][18]);
		$this->t1c['ds17'][30] = ($this->t1c['ds17'][3] - $this->d['ds17'][18]) / ($this->d['ds17'][27] - $this->d['ds17'][18]);
		$this->t1c['ds17'][31] = ($this->t1c['ds17'][3] - $this->d['ds17'][18]) / ($this->d['ds17'][27] - $this->d['ds17'][18]);
		$this->t1c['ds17'][32] = ($this->t1c['ds17'][3] - $this->d['ds17'][18]) / ($this->d['ds17'][27] - $this->d['ds17'][18]);
		$this->t1c['ds17'][33] = ($this->t1c['ds17'][3] - $this->d['ds17'][18]) / ($this->d['ds17'][27] - $this->d['ds17'][18]);
		$this->t1c['ds17'][34] = ($this->t1c['ds17'][3] - $this->d['ds17'][18]) / ($this->d['ds17'][27] - $this->d['ds17'][18]);
		$this->t1c['ds17'][35] = ($this->t1c['ds17'][3] - $this->d['ds17'][18]) / ($this->d['ds17'][27] - $this->d['ds17'][18]);
		$this->t1c['ds17'][36] = $this->d['ds17'][28] - $this->d['ds17'][19];
		$this->t1c['ds17'][37] = $this->d['ds17'][29] - $this->d['ds17'][20];
		$this->t1c['ds17'][38] = $this->d['ds17'][30] - $this->d['ds17'][21];
		$this->t1c['ds17'][39] = $this->d['ds17'][31] - $this->d['ds17'][22];
		$this->t1c['ds17'][40] = $this->d['ds17'][32] - $this->d['ds17'][23];
		$this->t1c['ds17'][41] = $this->d['ds17'][33] - $this->d['ds17'][24];
		$this->t1c['ds17'][42] = $this->d['ds17'][34] - $this->d['ds17'][25];
		$this->t1c['ds17'][43] = $this->d['ds17'][35] - $this->d['ds17'][26];
		$this->t1c['ds17'][44] = $this->d['ds17'][19] + ($this->t1c['ds17'][28] * $this->t1c['ds17'][36]);
		$this->t1c['ds17'][45] = $this->d['ds17'][20] + ($this->t1c['ds17'][29] * $this->t1c['ds17'][37]);
		$this->t1c['ds17'][46] = $this->d['ds17'][21] + ($this->t1c['ds17'][30] * $this->t1c['ds17'][38]);
		$this->t1c['ds17'][47] = $this->d['ds17'][22] + ($this->t1c['ds17'][31] * $this->t1c['ds17'][39]);
		$this->t1c['ds17'][48] = $this->d['ds17'][23] + ($this->t1c['ds17'][32] * $this->t1c['ds17'][40]);
		$this->t1c['ds17'][49] = $this->d['ds17'][24] + ($this->t1c['ds17'][33] * $this->t1c['ds17'][41]);
		$this->t1c['ds17'][50] = $this->d['ds17'][25] + ($this->t1c['ds17'][34] * $this->t1c['ds17'][42]);
		$this->t1c['ds17'][51] = $this->d['ds17'][26] + ($this->t1c['ds17'][35] * $this->t1c['ds17'][43]);
		if ((($this->t1c['ds17'][3] - $this->d['ds17'][27])/($this->d['ds17'][36] - $this->d['ds17'][27])) > 1) {
			$val = 1;
		} else {
			$val = (($this->t1c['ds17'][3] - $this->d['ds17'][27])/($this->d['ds17'][36] - $this->d['ds17'][27]));
		}
		$this->t1c['ds17'][52] = $val;
		$this->t1c['ds17'][53] = $val;
		$this->t1c['ds17'][54] = $val;
		$this->t1c['ds17'][55] = $val;
		$this->t1c['ds17'][56] = $val;
		$this->t1c['ds17'][57] = $val;
		$this->t1c['ds17'][58] = $val;
		$this->t1c['ds17'][59] = $val;
		$this->t1c['ds17'][60] = $this->t1c['ds17'][1] - $this->d['ds17'][28];
		$this->t1c['ds17'][61] = $this->t1c['ds17'][2] - $this->d['ds17'][29];
		$this->t1c['ds17'][62] = $this->d['ds17'][37] - $this->d['ds17'][30];
		$this->t1c['ds17'][63] = $this->d['ds17'][38] - $this->d['ds17'][31];
		$this->t1c['ds17'][64] = $this->d['ds17'][39] - $this->d['ds17'][32];
		$this->t1c['ds17'][65] = $this->d['ds17'][40] - $this->d['ds17'][33];
		$this->t1c['ds17'][66] = $this->d['ds17'][41] - $this->d['ds17'][34];
		$this->t1c['ds17'][67] = $this->d['ds17'][42] - $this->d['ds17'][35];
		$this->t1c['ds17'][68] = $this->d['ds17'][28] + ($this->t1c['ds17'][52] * $this->t1c['ds17'][60]);
		$this->t1c['ds17'][69] = $this->d['ds17'][29] + ($this->t1c['ds17'][53] * $this->t1c['ds17'][61]);
		$this->t1c['ds17'][70] = $this->d['ds17'][30] + ($this->t1c['ds17'][54] * $this->t1c['ds17'][62]);
		$this->t1c['ds17'][71] = $this->d['ds17'][31] + ($this->t1c['ds17'][55] * $this->t1c['ds17'][63]);
		$this->t1c['ds17'][72] = $this->d['ds17'][32] + ($this->t1c['ds17'][56] * $this->t1c['ds17'][64]);
		$this->t1c['ds17'][73] = $this->d['ds17'][33] + ($this->t1c['ds17'][57] * $this->t1c['ds17'][65]);
		$this->t1c['ds17'][74] = $this->d['ds17'][34] + ($this->t1c['ds17'][58] * $this->t1c['ds17'][66]);
		$this->t1c['ds17'][75] = $this->d['ds17'][35] + ($this->t1c['ds17'][59] * $this->t1c['ds17'][67]);
// DATA SET 19 - (DefaultData! Other Parameters)
		$this->t1c['ds19'][1] = $this->d['ds19'][11] / $this->d['ds19'][12];
// DATA SET 20
		foreach($this->sa as $k => $v) {
			if ($v == $this->d['ds1'][4]) {
				$sysApp = $k;
				break;
			}
		}
		foreach($this->sm as $k => $v) {
			if ($v == $this->d['ds1'][5]) {
				$solMat = $k;
				break;
			}
		}
		foreach($this->st as $k => $v) {
			if ($v == $this->d['ds1'][6]) {
				$sysTrk = $k;
				break;
			}
		}
		$this->t1c['ds20'][1] = $sysApp.$solMat.$sysTrk;
		for($i = 1; $i <= 23; $i++) {
			$this->t1c['ds20'][$i+1] = $this->x['dd1'][$this->t1c['ds20'][1]]['v'.$i];
		}
		$this->t1c['ds20'][25] = $this->x['dd1']['RRTFFM']['v17'] / $this->x['dd1']['RNCSFM']['v17'];
// DATA SET 21 - (DefaultData! Misc. Calculations)
		$this->t1c['ds21'][1] = $this->d['ds1'][1];
		$this->t1c['ds21'][2] = $this->t1c['ds1'][1];
		// if ($this->t1c['ds21'][2] > $this->d['ds21'][4]) { CHANGED FROM 5/25/11 VERSION
			// $this->t1c['ds21'][3] = 5;
		// } else if ($this->t1c['ds21'][2] > $this->d['ds21'][3]) {
			// $this->t1c['ds21'][3] = 4;
		// } else if ($this->t1c['ds21'][2] > $this->d['ds21'][2]) {
			// $this->t1c['ds21'][3] = 3;
		// } else {
			// $this->t1c['ds21'][3] = 2;
		// }
		if ($this->t1c['ds21'][2] < $this->d['ds21'][2]) {
			$this->t1c['ds21'][3] = 2;
		} else if ($this->t1c['ds21'][2] < $this->d['ds21'][3]) {
			$this->t1c['ds21'][3] = 3;
		} else {
			$this->t1c['ds21'][3] = 4;
		}
		// $this->t1c['ds21'][4] = $this->x['dd3'][$this->t1c['ds21'][3]-1][$this->t1c['ds21'][1]] * 1000; CHANGED FROM 5/25/11 VERSION
		$this->t1c['ds21'][4] = $this->x['dd3'][$this->t1c['ds21'][3]-1][$this->t1c['ds21'][1]];
		if ($this->t1c['ds21'][2] < 10) {
			$this->t1c['ds21'][5] = 17;
		} else if ($this->t1c['ds21'][2] < 100) {
			$this->t1c['ds21'][5] = 18;
		} else {
			$this->t1c['ds21'][5] = 19;
		}
		if ($this->t1c['ds21'][4] < 10) {
			$this->t1c['ds21'][6] = 15;
		} else {
			$this->t1c['ds21'][6] = 16;
		}
		if ($this->t1c['ds21'][2] < 10) {
			$this->t1c['ds21'][7] = 25;
		} else if ($this->t1c['ds21'][2] < 100) {
			$this->t1c['ds21'][7] = 26;
		} else {
			$this->t1c['ds21'][7] = 27;
		}
		if ($this->t1c['ds21'][2] > $this->d['ds21'][4]) {
			$this->t1c['ds21'][8] = $this->d['ds22'][4] * 1000;
		} else if ($this->t1c['ds21'][2] > $this->d['ds21'][3]) {
			$this->t1c['ds21'][8] = $this->d['ds22'][3] * 1000;
		} else if ($this->t1c['ds21'][2] > $this->d['ds21'][2]) {
			$this->t1c['ds21'][8] = $this->d['ds22'][2] * 1000;
		} else {
			$this->t1c['ds21'][8] = $this->d['ds22'][1] * 1000;
		}
// DATA SET 22 - (DefaultData! Misc. Calculations)
		if ($this->t1c['ds21'][2] < $this->d['ds22'][5]) {
			$this->t1c['ds22'][1] = $this->d['ds22'][13] * 1000;
		} else if ($this->t1c['ds21'][2] < $this->d['ds22'][6]) {
			$this->t1c['ds22'][1] = $this->d['ds22'][14] * 1000;
		} else if ($this->t1c['ds21'][2] < $this->d['ds22'][7]) {
			$this->t1c['ds22'][1] = $this->d['ds22'][15] * 1000;
		} else if ($this->t1c['ds21'][2] < $this->d['ds22'][8]) {
			$this->t1c['ds22'][1] = $this->d['ds22'][16] * 1000;
		} else if ($this->t1c['ds21'][2] < $this->d['ds22'][9]) {
			$this->t1c['ds22'][1] = $this->d['ds22'][17] * 1000;
		} else if ($this->t1c['ds21'][2] < $this->d['ds22'][10]) {
			$this->t1c['ds22'][1] = $this->d['ds22'][18] * 1000;
		} else if ($this->t1c['ds21'][2] < $this->d['ds22'][11]) {
			$this->t1c['ds22'][1] = $this->d['ds22'][19] * 1000;
		} else if ($this->t1c['ds21'][2] < $this->d['ds22'][12]) {
			$this->t1c['ds22'][1] = $this->d['ds22'][20] * 1000;
		}
// DATA SET 23 - (Calculations! Project Construction Costs)
		if ($this->d['ds1'][9] == 'Y') {
			$this->t1c['ds23'][1] = $this->d['ds19'][9];
		} else {
			$this->t1c['ds23'][1] = $this->t1c['ds2'][11];
		}
		if ($this->d['ds1'][9] == 'Y') {
			$this->t1c['ds23'][2] = $this->d['ds20'][1];
			$this->t1c['ds23'][3] = $this->d['ds20'][2];
			$this->t1c['ds23'][4] = $this->d['ds20'][3];
			$this->t1c['ds23'][5] = $this->d['ds20'][4];
		} else {
			$this->t1c['ds23'][2] = $this->t1c['ds2'][12];
			$this->t1c['ds23'][3] = $this->t1c['ds2'][13];
			$this->t1c['ds23'][4] = $this->t1c['ds2'][14];
			$this->t1c['ds23'][5] = $this->t1c['ds2'][15];
		}
		$this->t1c['ds23'][6] = $this->d['ds23'][5] + $this->d['ds23'][6];
// DATA SET 24 - (Calculations! Payroll Paremeters)
		$this->t1c['ds24'][1] = $this->t1c['ds23'][6];
		$this->t1c['ds24'][2] = $this->t1c['ds23'][6];
		$this->t1c['ds24'][3] = $this->t1c['ds2'][7];
		$this->t1c['ds24'][4] = $this->t1c['ds2'][8];
// DATA SET 25 - (Calculations! Misc. Calculations)
		$this->t1c['ds25'][1] = $this->d['ds1'][8];
// DATA SET 26 - (Calculations! Installation Costs Local Demand - Margined)
		$this->t1c['ds26'][1] = $this->t1c['ds25'][1];
// DATA SET 27 - (Calculations! PV System Annual Operating and Maintenance Costs)
		if ($this->d['ds1'][9] == "Y") {
			$this->t1c['ds27'][1] = $this->d['ds20'][5];
		} else {
			$this->t1c['ds27'][1] = $this->d['ds2'][16];
		}
// DATA SET 30 - (Calculations! Plant Employees)
		if ($this->d['ds1'][1] == "MyCounty") {
			$this->t1c['ds30'][1] = 0;
		} else {
			if ($this->d['ds1'][1] == "MyRegion") {
				$this->t1c['ds30'][1] = 0;
			} else {
				$this->t1c['ds30'][1] = 1;
			}
		}
// DATA SET 31 - (Calculations! Without Plant Employees)
		$this->t1c['ds31'][1] = $this->t1c['ds26'][1];
// DATA SET 33
		$this->t1c['ds33'][1] = $this->t1c['ds31'][1];
// DATA SET 38
		if ($this->d['ds1'][1] == "MyCounty") {
			$this->t1c['ds38'][1] = $this->d['ds4'][1];
		} else {
			if ($this->d['ds1'][1] == "MyRegion") {
				$this->t1c['ds38'][1] = $this->d['ds4'][2];
			} else {
				$this->t1c['ds38'][1] = $this->d['ds1'][1];
			}
		}
		$this->t1c['ds38'][2] = $this->t1c['ds23'][1];
		$this->t1c['ds38'][3] = $this->t1c['ds23'][2];
		$this->t1c['ds38'][4] = $this->t1c['ds23'][3];
		$this->t1c['ds38'][5] = $this->t1c['ds23'][4];
		$this->t1c['ds38'][6] = $this->t1c['ds23'][5];
		$this->t1c['ds38'][7] = $this->t1c['ds27'][1];
// DATA SET 39
		$this->t1c['ds39'][1] = $this->t1c['ds27'][1];
// DATA SET 40
		for ($i = 1; $i <= 6; $i++) {
			if ($this->d['ds1'][9] == "Y") {
				$this->t1c['ds40'][$i] = $this->d['ds19'][$i];
			} else {
				$this->t1c['ds40'][$i] = $this->d['ds2'][$i];
			}
		}
		for ($i = 7; $i <= 9; $i++) {
			if ($this->d['ds1'][9] == "Y") {
				$this->t1c['ds40'][$i] = $this->d['ds19'][$i];
			} else {
				$this->t1c['ds40'][$i] = $this->d['ds2'][$i+2];
			}
		}
// DATA SET 42
		if ($this->d['ds1'][1] == "MyCounty") {
			$this->t1c['ds42'][1] = $this->d['ds5'][1];
		} else {
			if ($this->d['ds1'][1] == "MyRegion") {
				$this->t1c['ds42'][1] = $this->d['ds5'][2];
			} else {
				$this->t1c['ds42'][1] = $this->d['ds47'][1];
			}
		}
		$this->t1c['ds42'][2] = $this->d['ds1'][8];
		$this->t1c['ds42'][3] = $this->d['ds1'][1];
// DATA SET 44
		$this->t1c['ds44'][1] = $this->d['ds44'][3] + 1;
		$this->t1c['ds44'][2] = $this->d['ds44'][5] + 1;
		$this->t1c['ds44'][3] = $this->d['ds44'][7] + 1;
		$this->t1c['ds44'][4] = $this->d['ds44'][9] + 1;
		$this->t1c['ds44'][5] = $this->d['ds44'][11] + 1;
		$this->t1c['ds44'][6] = $this->d['ds44'][13] + 1;
		$this->t1c['ds44'][7] = $this->d['ds44'][15] + 1;
		$this->t1c['ds44'][8] = $this->d['ds44'][17] + 1;
		$this->t1c['ds44'][9] = $this->d['ds44'][19] + 1;
// DATA SET 47
		for($i = 1; $i <= 44; $i++) {
			$this->t1c['ds47'][$i] = $this->d['ds15'][$i]; 
		}
		ksort($this->t1c['ds47']);
// DATA SET 48 THROUGH 56
		for($y = 48; $y <= 56; $y++) {
			for($i = 1; $i <= 44; $i++) {
				$this->t1c['ds'.$y][$i] = $this->d['ds'.$y-42][$i]; 
			}
			ksort($this->t1c['ds'.$y]);
		}
// DATA SET 57
		if ($this->d['ds1'][1] == "MyCounty" OR $this->d['ds1'][1] == "MyRegion") {
			if ($this->d['ds1'][1] == "MyRegion") {
				$num = 22;
			}
			for($i = 1; $i <= 22; $i++) {
				$this->t1c['ds57'][$i] = $this->d['ds6'][$i+$num];
				$this->t1c['ds57'][$i+22] = $this->d['ds7'][$i+$num];
				$this->t1c['ds57'][$i+44] = $this->d['ds8'][$i+$num];
				$this->t1c['ds57'][$i+66] = $this->t1c['ds57'][$i] + $this->t1c['ds57'][$i+22] + $this->t1c['ds57'][$i+44];
				$this->t1c['ds57'][$i+88] = $this->d['ds9'][$i+$num];
				$this->t1c['ds57'][$i+110] = $this->d['ds10'][$i+$num];
				$this->t1c['ds57'][$i+132] = $this->d['ds11'][$i+$num];
				$this->t1c['ds57'][$i+154] = $this->t1c['ds57'][$i+88] + $this->t1c['ds57'][$i+110] + $this->t1c['ds57'][$i+132];
				$this->t1c['ds57'][$i+176] = $this->d['ds12'][$i+$num];
				$this->t1c['ds57'][$i+198] = $this->d['ds13'][$i+$num];
				$this->t1c['ds57'][$i+220] = $this->d['ds14'][$i+$num];
				$this->t1c['ds57'][$i+242] = $this->t1c['ds57'][$i+176] + $this->t1c['ds57'][$i+198] + $this->t1c['ds57'][$i+220];
				$this->t1c['ds57'][$i+264] = $this->d['ds15'][$i+$num];
			}
		} else {
			for($i = 1; $i <= 22; $i++) {
				$this->t1c['ds57'][$i] = $this->x['mu1'][$i][$this->d['ds1'][1]];
				$this->t1c['ds57'][$i+22] = $this->x['mu2'][$i][$this->d['ds1'][1]];
				$this->t1c['ds57'][$i+44] = $this->x['mu3'][$i][$this->d['ds1'][1]];
				$this->t1c['ds57'][$i+66] = $this->t1c['ds57'][$i] + $this->t1c['ds57'][$i+22] + $this->t1c['ds57'][$i+44];
				$this->t1c['ds57'][$i+88] = $this->x['mu4'][$i][$this->d['ds1'][1]];
				$this->t1c['ds57'][$i+110] = $this->x['mu5'][$i][$this->d['ds1'][1]];
				$this->t1c['ds57'][$i+132] = $this->x['mu6'][$i][$this->d['ds1'][1]];
				$this->t1c['ds57'][$i+154] = $this->t1c['ds57'][$i+88] + $this->t1c['ds57'][$i+110] + $this->t1c['ds57'][$i+132];
				$this->t1c['ds57'][$i+176] = $this->x['mu7'][$i][$this->d['ds1'][1]];
				$this->t1c['ds57'][$i+198] = $this->x['mu8'][$i][$this->d['ds1'][1]];
				$this->t1c['ds57'][$i+220] = $this->x['mu9'][$i][$this->d['ds1'][1]];
				$this->t1c['ds57'][$i+242] = $this->t1c['ds57'][$i+176] + $this->t1c['ds57'][$i+198] + $this->t1c['ds57'][$i+220];
				$this->t1c['ds57'][$i+264] = $this->x['he1'][$i][$this->d['ds1'][1]];
			}
		}
		ksort($this->t1c['ds57']);
		$this->t2();
	}
	function t2() {
// DATA SET 1
		if ($this->vals['t2c_ds1_1']) {
			$this->t2c['ds1'][1] = $this->vals['t2c_ds1_1'];
		} else {
			$this->t2c['ds1'][1] = 1;
		}
		$this->t2c['ds1'][2] = $this->t1c['ds1'][1] * $this->t2c['ds1'][1];
		// START OUT OF ORDER
		// if ($this->t1c['ds21'][4] > 0) { CHANGED AFTER 5/25/11 VERSION
			// if (substr($this->t1c['ds20'][1],2) == "RR") {
				// $this->t2c['ds21'][1] = $this->t1c['ds21'][4] * 0;
			// } else {
				// $this->t2c['ds21'][1] = $this->t1c['ds21'][4];
			// }
		// } else {
			// if (substr($this->t1c['ds20'][1],2) == "RR") {
				// $this->t2c['ds21'][1] = $this->t1c['ds22'][1] * 0;
			// } else {
				// $this->t2c['ds21'][1] = $this->t1c['ds22'][1];
			// }
		// }
		if ($this->t1c['ds21'][4] == 0) {
			$this->t2c['ds21'][1] = $this->t1c['ds20'][18] * 1000;
		} else {
			$this->t2c['ds21'][1] = ($this->t1c['ds20'][18] * $this->t1c['ds21'][4]) * 1000;
		}
		// END OUT OF ORDER		
		// if ($this->vals['t2c_ds1_3']) { CHANGED AFTER 5/25/11 VERSION
			// $this->t2c['ds1'][3] = $this->vals['t2c_ds1_3'];
		// } else {
			// $this->t2c['ds1'][3] = $this->t1c['ds20'][18];
		// }
		if ($this->vals['t2c_ds1_3']) {
			$this->t2c['ds1'][3] = $this->vals['t2c_ds1_3'];
		} else {
			$this->t2c['ds1'][3] = $this->t2c['ds21'][1];
		}
		if ($this->vals['t2c_ds1_4']) {
			$this->t2c['ds1'][4] = $this->vals['t2c_ds1_4'];
		} else {
			$this->t2c['ds1'][4] = $this->t1c['ds20'][24];
		}
// DATA SET 2
		if ($this->vals['t2c_ds2_1']) {
			$this->t2c['ds2'][1] = $this->vals['t2c_ds2_1'] / 100;
		} else {
			$this->t2c['ds2'][1] = $this->t1c['ds23'][6];
		}
		if ($this->vals['t2c_ds2_2']) {
			$this->t2c['ds2'][2] = $this->vals['t2c_ds2_2'] / 100;
		} else {
			$this->t2c['ds2'][2] = $this->t1c['ds23'][6];
		}
// DATA SET 3
		if ($this->d['ds1'][1] == "MyCounty") {
			if ($this->d['ds1'][2] == "") {
				$this->t2c['ds3'][1] = 2;
			} else {
				$this->t2c['ds3'][1] = 1;
			}
		} else {
			if ($this->d['ds1'][1] == "MyRegion") {
				if ($this->d['ds1'][2] == "") {
					$this->t2c['ds3'][1] = 2;
				} else {
					$this->t2c['ds3'][1] = 1;
				}
			} else {
				$this->t2c['ds3'][1] = 0;
			}
		}
		$num = 0;
		for ($i = 2; $i <= 10; $i++) {
			if ($i != 6) {
				if ($this->t2c['ds3'][1] == 0) {
					$this->t2c['ds3'][$i] = $this->d['ds17'][$i-1-$num];
				} else {
					if ($this->t2c['ds3'][1] == 2) {
						$this->t2c['ds3'][$i] = 'Pop. Data Missing';
					} else {
						if ($this->d['ds1'][2] < $this->d['ds17'][9]) {
							$this->t2c['ds3'][$i] = $this->d['ds17'][$i+8-$num];
						} else {
							if ($this->d['ds1'][2] < $this->d['ds17'][18]) {
								$this->t2c['ds3'][$i] = $this->t1c['ds17'][$i+18-$num];
							} else {
								if ($this->d['ds1'][2] < $this->d['ds17'][27]) {
									$this->t2c['ds3'][$i] = $this->t1c['ds17'][$i+42-$num];
								} else {
									$this->t2c['ds3'][$i] = $this->t1c['ds17'][$i+66-$num];
								}
							}
						}
					}
				}
			} else {
				$this->t2c['ds3'][$i] = $this->t2c['ds3'][$i-1];
				$num = 1;
			}
		}
		$this->t2c['ds3'][11] = $this->t1c['ds2'][11];
		// ==================================================================================================================== USES MISSING DATA
		for ($i = 12; $i <= 14; $i++) {
			if ($this->t2c['ds3'][1] == 0) {
				$this->t2c['ds3'][$i] = $this->d['ds18'][$i-11];
			} else {
				if ($this->t2c['ds3'][1] == 2) {
					$this->t2c['ds3'][$i] = 'Pop. Data Missing';
				} else {
					if ($this->d['ds1'][2] < $this->d['ds17'][9]) {
						$this->t2c['ds3'][$i] = $this->d['ds18'][$i-8];
					} else {
						if ($this->d['ds1'][2] < $this->d['ds17'][18]) {
							$this->t2c['ds3'][$i] = 0; // Missing Field DefaultData!N35
						} else {
							if ($this->d['ds1'][2] < $this->d['ds17'][27]) {
								$this->t2c['ds3'][$i] = 0; // Missing Field DefaultData!Q35
							} else {
								$this->t2c['ds3'][$i] = 0; // Missing Field DefaultData!T35
							}
						}
					}
				}
			}
		}
		// ==================================================================================================================== END USES MISSING DATA
		$this->t2c['ds3'][15] = $this->d['ds19'][10];
		$this->t2c['ds3'][16] = $this->d['ds24'][1];
		$this->t2c['ds3'][17] = $this->d['ds24'][2];
		$this->t2c['ds3'][18] = $this->t1c['ds23'][6];
		for ($i = 19; $i <= 30; $i++) {
			$this->t2c['ds3'][$i] = $this->t2c['ds3'][$i-17];
		}
// DATA SET 16
		$this->t2c['ds16'][1] = $this->t2c['ds1'][1];
		$this->t2c['ds16'][2] = $this->t2c['ds1'][3];
		// switched the order of 3 and 4 because three uses 4
		$this->t2c['ds16'][4] = $this->t1c['ds16'][2] * $this->t2c['ds16'][1];
		$this->t2c['ds16'][3] = $this->t2c['ds16'][2] * $this->t2c['ds16'][4];
		$this->t2c['ds16'][5] = $this->t2c['ds1'][4];
		ksort($this->t2c['ds16']);
// DATA SET 17
		$this->t2c['ds17'][1] = $this->t1c['ds20'][5];
		$this->t2c['ds17'][2] = $this->t1c['ds20'][6];
		$this->t2c['ds17'][3] = $this->t1c['ds20'][7];
		$this->t2c['ds17'][4] = $this->t1c['ds20'][8];
		$this->t2c['ds17'][5] = $this->t2c['ds17'][1] + $this->t2c['ds17'][2] + $this->t2c['ds17'][3] + $this->t2c['ds17'][4];
		$this->t2c['ds17'][6] = $this->t1c['ds20'][10];
		$this->t2c['ds17'][7] = $this->t2c['ds17'][6];
		$this->t2c['ds17'][8] = $this->t2c['ds17'][7] + $this->t2c['ds17'][5];
		$this->t2c['ds17'][9] = $this->t1c['ds20'][13];
		$this->t2c['ds17'][10] = $this->t1c['ds20'][14];
		$this->t2c['ds17'][11] = $this->t1c['ds20'][15];
		$this->t2c['ds17'][12] = $this->t2c['ds17'][9] + $this->t2c['ds17'][10] + $this->t2c['ds17'][11];
		$this->t2c['ds17'][13] = $this->t2c['ds17'][12] + $this->t2c['ds17'][8];
// DATA SET 18
		$this->t2c['ds18'][1] = $this->t1c['ds20'][19];
		$this->t2c['ds18'][2] = $this->t2c['ds18'][1];
		$this->t2c['ds18'][3] = $this->t1c['ds20'][21];
		// ==================================================================================================================== STILL NOT COMPLETE
		$this->t2c['ds18'][4] = 0; // the formula calls for a blank cell AH39
		$this->t2c['ds18'][5] = $this->t2c['ds18'][3] + $this->t2c['ds18'][4];
		// ==================================================================================================================== END STILL NOT COMPLETE
		$this->t2c['ds18'][6] = $this->t2c['ds18'][5] + $this->t2c['ds18'][2];
// DATA SET 21
		// t2c_ds21_1 executed in t2_ds1
		$this->t2c['ds21'][2] = $this->x['dd3'][7][$this->d['ds1'][1]];
		$this->t2c['ds21'][3] = $this->x['dd3'][6][$this->d['ds1'][1]];
		$this->t2c['ds21'][4] = $this->x['dd3'][10][$this->d['ds1'][1]];
		$this->t2c['ds21'][5] = 1 - $this->t2c['ds21'][2];
		$this->t2c['ds21'][6] = 1 - $this->t2c['ds21'][4];
// DATA SET 23
		$this->t2c['ds23'][1] = ($this->d['ds23'][5] / $this->t1c['ds23'][6]) * $this->t2c['ds2'][1];
		$this->t2c['ds23'][2] = ($this->d['ds23'][6] / $this->t1c['ds23'][6]) * $this->t2c['ds2'][1];
		$this->t2c['ds23'][3] = $this->t2c['ds23'][1] + $this->t2c['ds23'][2];
// DATA SET 24
		$this->t2c['ds24'][1] = $this->d['ds24'][1] * $this->t1c['ds24'][1];
		$this->t2c['ds24'][2] = $this->d['ds24'][2] * $this->t1c['ds24'][2];
		if ($this->t1c['ds21'][4] == 0) {
			$this->t2c['ds24'][3] = 27.49;
		} else {
			$this->t2c['ds24'][3] = $this->t1c['ds21'][4] * 27.49;
		}
// DATA SET 26
		$this->t2c['ds26'][1] = $this->t1c['ds42'][1];
// DATA SET 28
		$this->t2c['ds28'][1] = $this->t2c['ds26'][1];
// DATA SET 30
		if ($this->d['ds1'][9] == "Y") {
			$this->t2c['ds30'][1] = $this->d['ds23'][5];
		} else {
			$this->t2c['ds30'][1] = $this->t2c['ds23'][1];
		}
		if ($this->d['ds1'][9] == "Y") {
			$this->t2c['ds30'][2] = $this->d['ds23'][6];
		} else {
			$this->t2c['ds30'][2] = $this->t2c['ds23'][2];
		}
// DATA SET 32
		$this->t2c['ds32'][1] = $this->t2c['ds28'][1];
// DATA SET 35
		$this->t2c['ds35'][1] = $this->t1c['ds33'][1];
// =========== ds44 purposely out of order because it closely relates to ds42 and ds43 //
// DATA SET 44
		foreach($this->d['ds44'] as $k => $v) {
			if ($v == $this->t1c['ds42'][1]) {
				$this->t2c['ds44'][1] = $this->d['ds44'][$k+1] + 1;
			}
		}
		foreach($this->d['ds44'] as $k => $v) {
			if ($v == $this->t1c['ds42'][1]) {
				$this->t2c['ds44'][2] = $this->d['ds44'][$k+1];
			}
		}
		$this->t3();
	}
	function t3() {
// DATA SET 2
		$num = 0;
		for($i = 1; $i <= 13; $i++) {
			if ($i == 5) {
				$num = 1;
			}
			if ($this->vals['t3c_ds2_'.$i]) {
				$this->t3c['ds2'][$i] = $this->vals['t3c_ds2_'.$i] / 100;
			} else {
				$this->t3c['ds2'][$i] = $this->t2c['ds3'][$i+1+$num];
			}
		}
// DATA SET 17
		for($i = 1; $i <= 4; $i++) {
			$this->t3c['ds17'][$i] = $this->t2c['ds16'][3] * $this->t2c['ds17'][$i];
			$this->t3c['ds17'][5] = $this->t3c['ds17'][5] + $this->t3c['ds17'][$i];
		}
		$this->t3c['ds17'][6] = $this->t2c['ds16'][3] * $this->t2c['ds17'][6];
		$this->t3c['ds17'][7] = $this->t3c['ds17'][6];
		$this->t3c['ds17'][8] = $this->t3c['ds17'][7] + $this->t3c['ds17'][5];
		for($i = 9; $i <= 11; $i++) {
			$this->t3c['ds17'][$i] = $this->t2c['ds16'][3] * $this->t2c['ds17'][$i];
			$this->t3c['ds17'][12] = $this->t3c['ds17'][12] + $this->t3c['ds17'][$i];
		}
		$this->t3c['ds17'][13] = $this->t3c['ds17'][8] + $this->t3c['ds17'][12];
		for($i = 14; $i <= 17; $i++) {
			$this->t3c['ds17'][$i] = $this->t3c['ds17'][$i-13] / $this->t2c['ds16'][4];
			$this->t3c['ds17'][18] = $this->t3c['ds17'][18] + $this->t3c['ds17'][$i];
		}
		$this->t3c['ds17'][19] = $this->t3c['ds17'][6] / $this->t2c['ds16'][4];
		$this->t3c['ds17'][20] = $this->t3c['ds17'][19];
		$this->t3c['ds17'][21] = $this->t3c['ds17'][19] + $this->t3c['ds17'][18];
		for($i = 22; $i <= 24; $i++) {
			$this->t3c['ds17'][$i] = $this->t3c['ds17'][$i-13] / $this->t2c['ds16'][4];
			$this->t3c['ds17'][25] = $this->t3c['ds17'][25] + $this->t3c['ds17'][$i];
		}
		$this->t3c['ds17'][26] = $this->t3c['ds17'][25] + $this->t3c['ds17'][21];
		ksort($this->t3c['ds17']);
// DATA SET 18
		$this->t3c['ds18'][1] = number_format($this->t2c['ds18'][1] * $this->t2c['ds16'][5],14);
		$this->t3c['ds18'][2] = $this->t3c['ds18'][1];
		$this->t3c['ds18'][3] = $this->t2c['ds18'][3] * $this->t2c['ds16'][5];
		$this->t3c['ds18'][4] = $this->t2c['ds18'][4] * $this->t2c['ds16'][5];
		$this->t3c['ds18'][5] = $this->t3c['ds18'][3] + $this->t3c['ds18'][4];
		$this->t3c['ds18'][6] = 0 * $this->t2c['ds16'][5];
		$this->t3c['ds18'][7] = $this->t3c['ds18'][2] + $this->t3c['ds18'][5] + $this->t3c['ds18'][6];
// DATA SET 19
		$this->t3c['ds19'][1] = $this->t3c['ds17'][13] * $this->d['ds19'][5] * $this->d['ds19'][6];
		$this->t3c['ds19'][2] = $this->t2c['ds21'][2];
		$this->t3c['ds19'][3] = $this->d['ds19'][4] * $this->t3c['ds19'][1] * (1 - $this->t3c['ds19'][2]);
		$this->t3c['ds19'][4] = $this->t2c['ds21'][3];
		$this->t3c['ds19'][5] = $this->t2c['ds21'][4];
// DATA SET 23
		$num = 0;
		for($i = 1; $i <= 8; $i++) {
			if ($i == 5) {
				$num = 1;
			}
			if ($this->d['ds1'][9] == "Y") {
				$this->t3c['ds23'][$i] = $this->t2c['ds3'][$i+1+$num];
			} else {
				$this->t3c['ds23'][$i] = $this->t3c['ds2'][$i];
			}
		}
// DATA SET 24
		$this->t3c['ds24'][1] = $this->d['ds24'][1] + $this->t2c['ds24'][1];
		$this->t3c['ds24'][2] = $this->d['ds24'][2] + $this->t2c['ds24'][2];
		$this->t3c['ds24'][3] = $this->t3c['ds24'][1] * 52 * 40;
		$this->t3c['ds24'][4] = $this->t3c['ds24'][2] * 52 * 40;
		$this->t3c['ds24'][5] = $this->t2c['ds2'][1];
		$this->t3c['ds24'][6] = $this->t2c['ds2'][2];
// DATA SET 27
		for($i = 1; $i <= 3; $i++) {
			if ($this->d['ds1'][9] == "Y") {
				$this->t3c['ds27'][$i] = $this->t2c['ds3'][$i+11];
			} else {
				$this->t3c['ds27'][$i] = $this->t3c['ds2'][$i+9];
			}
		}
		if ($this->d['ds1'][9] == "Y") {
			$this->t3c['ds27'][4] = $this->t2c['ds3'][15];
		} else {
			$this->t3c['ds27'][4] = $this->t1c['ds2'][11];
		}
		if ($this->d['ds1'][9] == "Y") {
			$this->t3c['ds27'][5] = $this->d['ds19'][7];
		} else {
			$this->t3c['ds27'][5] = $this->t1c['ds2'][9];
		}
		if ($this->d['ds1'][9] == "Y") {
			$this->t3c['ds27'][6] = $this->d['ds19'][8];
		} else {
			$this->t3c['ds27'][6] = $this->t1c['ds2'][10];
		}
// DATA SET 36
		$total = $this->t3c['ds17'][13] * $this->d['ds19'][1];
		$n_amount = $total / $this->d['ds19'][2];
		$total = $total - $n_amount;
		for($i = 1; $i <= 30; $i++) {
			if ($i < $this->d['ds19'][2]) {
				$this->t3c['ds36'][$i] = $total * $this->d['ds19'][3];
				$total = $total - $n_amount;
				$this->t3c['ds36'][31]+= $this->t3c['ds36'][$i];
			} else {
				$this->t3c['ds36'][$i] = 0;
			}
		}
		$this->t3c['ds36'][32] = $this->t3c['ds36'][31] / $this->d['ds19'][2];
		for($i = 1; $i <= 30; $i++) {
			if ($i <= $this->d['ds19'][2]) {
				$this->t3c['ds36'][$i+32] = abs($this->PPMT($this->d['ds19'][3], $i, $this->d['ds19'][2], $this->t3c['ds17'][13] * $this->d['ds19'][1]));
			} else {
				$this->t3c['ds36'][$i+32] = 0;
			}
			$this->t3c['ds36'][63]+= $this->t3c['ds36'][$i+32];
		}
		$this->t3c['ds36'][64] = $this->t3c['ds36'][63] / $this->d['ds19'][2];
		for($i = 1; $i <= 32; $i++) {
			$this->t3c['ds36'][$i+64] = $this->t3c['ds36'][$i] + $this->t3c['ds36'][$i+32];
		}
		ksort($this->t3c['ds36']);
// DATA SET 38
		for($i = 1; $i <= 8; $i++) {
			$this->t3c['ds38'][$i] = $this->t3c['ds23'][$i];
		}
// DATA SET 42
		// $n = 0;
		// for($i = 1996; $i <= ($this->t1c['ds42'][2]-1); $i++) {
			// $n+= 9;
		// }
		// $this->t3c['ds42'][1] = $this->t1c['ds43'][(($this->t2c['ds44'][1] - 1) / 2)+$n];
		// $this->t3c['ds42'][1] = $this->x['df1']['200'.((($this->t2c['ds44'][1] - 1) / 2) + 1).'$b'][$this->t1c['ds42'][2]]; // UPDATED FORMULAS FOR t3c_ds42_1 AND t3c_ds42_2 BELOW
		// $this->t3c['ds42'][2] = $this->x['df1']['200'.(($this->t2c['ds44'][2] / 2) + 1).'$'][$this->t1c['ds42'][2]];
		$this->t3c['ds42'][1] = $this->x['df1'][$this->t1c['ds42'][1].'$b'][$this->t1c['ds42'][2]];
		$this->t3c['ds42'][2] = $this->x['df1'][$this->t1c['ds42'][1].'$'][$this->t1c['ds42'][2]];
		$this->t4();
	}
	function t4() {
// DATA SET 2
		if ($this->vals['t4c_ds2_1']) {
			$this->t4c['ds2'][1] = $this->vals['t4c_ds2_1'] / 100;
		} else {
			$this->t4c['ds2'][1] = $this->t3c['ds19'][2];
		}
		if ($this->vals['t4c_ds2_2']) {
			$this->t4c['ds2'][2] = $this->vals['t4c_ds2_2'] / 100;
		} else {
			$this->t4c['ds2'][2] = $this->t3c['ds19'][4];
		}
		if ($this->vals['t4c_ds2_3']) {
			$this->t4c['ds2'][3] = $this->vals['t4c_ds2_3'] / 100;
		} else {
			$this->t4c['ds2'][3] = $this->t3c['ds19'][5];
		}
		if ($this->vals['t4c_ds2_4']) {
			$this->t4c['ds2'][4] = $this->vals['t4c_ds2_4'];
		} else {
			$this->t4c['ds2'][4] = $this->t3c['ds17'][14];
		}
		if ($this->vals['t4c_ds2_5']) {
			$this->t4c['ds2'][5] = $this->vals['t4c_ds2_5'];
		} else {
			$this->t4c['ds2'][5] = $this->t3c['ds17'][15];
		}
		if ($this->vals['t4c_ds2_6']) {
			$this->t4c['ds2'][6] = $this->vals['t4c_ds2_6'];
		} else {
			$this->t4c['ds2'][6] = $this->t3c['ds17'][16];
		}
		if ($this->vals['t4c_ds2_7']) {
			$this->t4c['ds2'][7] = $this->vals['t4c_ds2_7'];
		} else {
			$this->t4c['ds2'][7] = $this->t3c['ds17'][17];
		}
		$this->t4c['ds2'][8] = $this->t4c['ds2'][4] + $this->t4c['ds2'][5] + $this->t4c['ds2'][6] + $this->t4c['ds2'][7];
		if ($this->vals['t4c_ds2_9']) {
			$this->t4c['ds2'][9] = $this->vals['t4c_ds2_9'];
		} else {
			$this->t4c['ds2'][9] = $this->t3c['ds17'][19];
		}
		$this->t4c['ds2'][10] = $this->t4c['ds2'][9];
		$this->t4c['ds2'][11] = $this->t4c['ds2'][8] + $this->t4c['ds2'][10];
		if ($this->vals['t4c_ds2_12']) {
			$this->t4c['ds2'][12] = $this->vals['t4c_ds2_12'];
		} else {
			$this->t4c['ds2'][12] = $this->t3c['ds17'][22];
		}
		if ($this->vals['t4c_ds2_13']) {
			$this->t4c['ds2'][13] = $this->vals['t4c_ds2_13'];
		} else {
			$this->t4c['ds2'][13] = $this->t3c['ds17'][23];
		}
		if ($this->vals['t4c_ds2_14']) {
			$this->t4c['ds2'][14] = $this->vals['t4c_ds2_14'];
		} else {
			$this->t4c['ds2'][14] = $this->t3c['ds17'][24];
		}
		$this->t4c['ds2'][15] = $this->t4c['ds2'][12] + $this->t4c['ds2'][13] + $this->t4c['ds2'][14];
		$this->t4c['ds2'][16] = $this->t4c['ds2'][11] + $this->t4c['ds2'][15];
		if ($this->vals['t4c_ds2_17']) {
			$this->t4c['ds2'][17] = $this->vals['t4c_ds2_17'];
		} else {
			$this->t4c['ds2'][17] = $this->t3c['ds18'][1];
		}
		$this->t4c['ds2'][18] = $this->t4c['ds2'][17];
		if ($this->vals['t4c_ds2_19']) {
			$this->t4c['ds2'][19] = $this->vals['t4c_ds2_19'];
		} else {
			$this->t4c['ds2'][19] = $this->t3c['ds18'][3];
		}
		if ($this->vals['t4c_ds2_20']) {
			$this->t4c['ds2'][20] = $this->vals['t4c_ds2_20'];
		} else {
			$this->t4c['ds2'][20] = $this->t3c['ds18'][4];
		}
		$this->t4c['ds2'][21] = $this->t4c['ds2'][19] + $this->t4c['ds2'][20];
// DATA SET 3
		$this->t4c['ds3'][1] = $this->t3c['ds19'][2];
		$this->t4c['ds3'][2] = $this->t3c['ds19'][4];
		$this->t4c['ds3'][3] = $this->t3c['ds19'][5];
		$this->t4c['ds3'][4] = $this->t3c['ds17'][14];
		$this->t4c['ds3'][5] = $this->t3c['ds17'][15];
		$this->t4c['ds3'][6] = $this->t3c['ds17'][16];
		$this->t4c['ds3'][7] = $this->t3c['ds17'][17];
		$this->t4c['ds3'][8] = $this->t4c['ds3'][4] + $this->t4c['ds3'][5] + $this->t4c['ds3'][6] + $this->t4c['ds3'][7];
		$this->t4c['ds3'][9] = $this->t3c['ds17'][19];
		$this->t4c['ds3'][10] = $this->t4c['ds3'][9];
		$this->t4c['ds3'][11] = $this->t4c['ds3'][8] + $this->t4c['ds3'][10];
		$this->t4c['ds3'][12] = $this->t3c['ds17'][22];
		$this->t4c['ds3'][13] = $this->t3c['ds17'][23];
		$this->t4c['ds3'][14] = $this->t3c['ds17'][24];
		$this->t4c['ds3'][15] = $this->t4c['ds3'][12] + $this->t4c['ds3'][13] + $this->t4c['ds3'][14];
		$this->t4c['ds3'][16] = $this->t4c['ds3'][11] + $this->t4c['ds3'][15];
		$this->t4c['ds3'][17] = $this->t3c['ds18'][1];
		$this->t4c['ds3'][18] = $this->t4c['ds3'][17];
		$this->t4c['ds3'][19] = $this->t3c['ds18'][3];
		$this->t4c['ds3'][20] = $this->t3c['ds18'][4];
		$this->t4c['ds3'][21] = $this->t4c['ds3'][19] + $this->t4c['ds3'][20];
		$this->t4c['ds3'][22] = $this->t4c['ds3'][18] + $this->t4c['ds3'][21];
// DATA SET 17
		$this->t4c['ds17'][1] = $this->t3c['ds17'][5] * ($this->t3c['ds19'][4] * (1 - $this->t3c['ds19'][5]));
		$this->t4c['ds17'][2] = $this->t4c['ds17'][1] + $this->t3c['ds17'][13];
		$this->t4c['ds17'][3] = $this->t4c['ds17'][1] / $this->t2c['ds16'][4];
		$this->t4c['ds17'][4] = $this->t4c['ds17'][3] + $this->t3c['ds17'][26];
// DATA SET 18
		$this->t4c['ds18'][1] = $this->t3c['ds18'][1] * $this->t2c['ds1'][2];
		$this->t4c['ds18'][2] = $this->t4c['ds18'][1];
		$this->t4c['ds18'][3] = $this->t3c['ds18'][3] * $this->t2c['ds1'][2];
		$this->t4c['ds18'][4] = $this->t3c['ds18'][4] * $this->t2c['ds1'][2];
		$this->t4c['ds18'][5] = $this->t4c['ds18'][3] + $this->t4c['ds18'][4];
		$this->t4c['ds18'][6] = $this->t4c['ds18'][3] * ($this->t3c['ds19'][4] * (1 - $this->t3c['ds19'][5]));
		$this->t4c['ds18'][7] = $this->t4c['ds18'][2] + $this->t4c['ds18'][5] + $this->t4c['ds18'][6];
// DATA SET 19
		$this->t4c['ds19'][1] = $this->t3c['ds36'][96];
// DATA SET 24
		$this->t4c['ds24'][1] = $this->t1c['ds24'][3] * $this->t3c['ds24'][5];
		$this->t4c['ds24'][2] = $this->t1c['ds24'][4] * $this->t3c['ds24'][6];
// DATA SET 25
		$this->t4c['ds25'][1] = $this->t3c['ds42'][1];
// DATA SET 26
		$this->t4c['ds26'][1] = $this->t3c['ds42'][2];
// DATA SET 39
		for($i = 1; $i <= 6; $i++) {
			$this->t4c['ds39'][$i] = $this->t3c['ds27'][$i];
		}
// DATA SET 40
		if ($this->d['ds1'][9] == "Y") {
			$this->t4c['ds40'][1] = $this->t3c['ds19'][2];
		} else {
			$this->t4c['ds40'][1] = $this->t4c['ds2'][1];
		}
		if ($this->d['ds1'][9] == "Y") {
			$this->t4c['ds40'][2] = $this->t3c['ds19'][4];
		} else {
			$this->t4c['ds40'][2] = $this->t4c['ds2'][2];
		}
		if ($this->d['ds1'][9] == "Y") {
			$this->t4c['ds40'][3] = $this->t3c['ds19'][5];
		} else {
			$this->t4c['ds40'][3] = $this->t4c['ds2'][3];
		}
		$this->t5();
	}
	function t5() {
// DATA SET 2
		for($i = 1; $i <= 4; $i++) {
			$this->t5c['ds2'][$i] = $this->t4c['ds2'][$i+3] * $this->t2c['ds1'][2];
			$this->t5c['ds2'][5]+= $this->t5c['ds2'][$i];
		}
		$this->t5c['ds2'][6] = $this->t4c['ds2'][9] * $this->t2c['ds1'][2];
		$this->t5c['ds2'][7] = $this->t5c['ds2'][6];
		$this->t5c['ds2'][8] = $this->t5c['ds2'][7] + $this->t5c['ds2'][5];
		for($i = 9; $i <= 11; $i++) {
			$this->t5c['ds2'][$i] = $this->t4c['ds2'][$i+3] * $this->t2c['ds1'][2];
			$this->t5c['ds2'][12]+= $this->t5c['ds2'][$i];
		}
		$this->t5c['ds2'][13] = $this->t5c['ds2'][8] + $this->t5c['ds2'][12];
		if ($this->vals['t5c_ds2_14']) {
			$this->t5c['ds2'][14] = $this->vals['t5c_ds2_14'];
		} else {
			$this->t5c['ds2'][14] = $this->t5c['ds2'][5] * ($this->t4c['ds2'][2] * (1 - $this->t4c['ds2'][3]));
		}
		$this->t5c['ds2'][15] = $this->t5c['ds2'][13] + $this->t5c['ds2'][14];
		$this->t5c['ds2'][16] = $this->t4c['ds2'][17] * $this->t2c['ds1'][2];
		$this->t5c['ds2'][17] = $this->t5c['ds2'][16];
		$this->t5c['ds2'][18] = $this->t4c['ds2'][19] * $this->t2c['ds1'][2];
		$this->t5c['ds2'][19] = $this->t4c['ds2'][20] * $this->t2c['ds1'][2];
		$this->t5c['ds2'][20] = $this->t5c['ds2'][18] + $this->t5c['ds2'][19];
		if ($this->vals['t5c_ds2_21']) {
			$this->t5c['ds2'][21] = $this->vals['t5c_ds2_21'];
		} else {
			$this->t5c['ds2'][21] = $this->t5c['ds2'][18] * ($this->t4c['ds2'][2] * (1 - $this->t4c['ds2'][3]));
		}
		$this->t5c['ds2'][22] = $this->t5c['ds2'][17] + $this->t5c['ds2'][20] + $this->t5c['ds2'][21];
		if ($this->vals['t5c_ds2_23']) {
			$this->t5c['ds2'][23] = $this->vals['t5c_ds2_23'];
		} else {
			$this->t5c['ds2'][23] = $this->t1c['ds2'][6] * $this->t1c['ds2'][5] * $this->t5c['ds2'][13];
		}
		if ($this->vals['t5c_ds2_24']) {
			$this->t5c['ds2'][24] = $this->vals['t5c_ds2_24'];
		} else {
			$this->t5c['ds2'][24] = $this->t5c['ds2'][23] * $this->t1c['ds2'][4] * (1 - $this->t4c['ds2'][1]);
		}
		$this->t5c['ds2'][25] = $this->t5c['ds2'][14] / $this->t2c['ds1'][2];
		$this->t5c['ds2'][26] = $this->t5c['ds2'][15] / $this->t2c['ds1'][2];
		$this->t5c['ds2'][27] = $this->t5c['ds2'][21] / $this->t2c['ds1'][2];
		$this->t5c['ds2'][28] = $this->t5c['ds2'][22] / $this->t2c['ds1'][2];
		for($i = 29; $i <= 32; $i++) {
			$this->t5c['ds2'][$i] = $this->t5c['ds2'][$i-28] / $this->t5c['ds2'][15];
			$this->t5c['ds2'][33]+= $this->t5c['ds2'][$i];
			
		}
		$this->t5c['ds2'][34] = $this->t5c['ds2'][6] / $this->t5c['ds2'][15];
		$this->t5c['ds2'][35] = $this->t5c['ds2'][34];
		$this->t5c['ds2'][36] = $this->t5c['ds2'][33] + $this->t5c['ds2'][35];
		for($i = 37; $i <= 40; $i++) {
			$this->t5c['ds2'][$i] = $this->t5c['ds2'][$i-28] / $this->t5c['ds2'][15];
			
		}
		$this->t5c['ds2'][41] = $this->t5c['ds2'][36] + $this->t5c['ds2'][40];
		$this->t5c['ds2'][42] = $this->t5c['ds2'][14] / $this->t5c['ds2'][15];
		$this->t5c['ds2'][43] = $this->t5c['ds2'][42] + $this->t5c['ds2'][41];
		$this->t5c['ds2'][44] = $this->t5c['ds2'][16] / $this->t5c['ds2'][22];
		$this->t5c['ds2'][45] = $this->t5c['ds2'][44];
		$this->t5c['ds2'][46] = $this->t5c['ds2'][18] / $this->t5c['ds2'][22];
		$this->t5c['ds2'][47] = $this->t5c['ds2'][19] / $this->t5c['ds2'][22];
		$this->t5c['ds2'][48] = $this->t5c['ds2'][46] + $this->t5c['ds2'][47];
		$this->t5c['ds2'][49] = $this->t5c['ds2'][21] / $this->t5c['ds2'][22];
		$this->t5c['ds2'][50] = $this->t5c['ds2'][45] + $this->t5c['ds2'][48] + $this->t5c['ds2'][49];
		ksort($this->t5c['ds2']);
// DATA SET 3
		for($i = 1; $i <= 4; $i++) {
			$this->t5c['ds3'][$i] = $this->t4c['ds3'][$i+3] * $this->t2c['ds1'][2];
			$this->t5c['ds3'][5]+= $this->t5c['ds3'][$i];
		}
		$this->t5c['ds3'][6] = $this->t4c['ds3'][9] * $this->t2c['ds1'][2];
		$this->t5c['ds3'][7] = $this->t5c['ds3'][6];
		$this->t5c['ds3'][8] = $this->t5c['ds3'][5] + $this->t5c['ds3'][6];
		for($i = 9; $i <= 11; $i++) {
			$this->t5c['ds3'][$i] = $this->t4c['ds3'][$i+3] * $this->t2c['ds1'][2];
			$this->t5c['ds3'][12]+= $this->t5c['ds3'][$i];
		}
		$this->t5c['ds3'][13] = $this->t5c['ds3'][8] + $this->t5c['ds3'][12];
		$this->t5c['ds3'][14] = $this->t5c['ds3'][5] * $this->t4c['ds3'][2] * (1 - $this->t4c['ds3'][3]);
		$this->t5c['ds3'][15] = $this->t4c['ds3'][17] * $this->t2c['ds1'][2];
		$this->t5c['ds3'][16] = $this->t5c['ds3'][15];
		$this->t5c['ds3'][17] = $this->t4c['ds3'][19] * $this->t2c['ds1'][2];
		$this->t5c['ds3'][18] = $this->t4c['ds3'][20] * $this->t2c['ds1'][2];
		$this->t5c['ds3'][19] = $this->t5c['ds3'][17] + $this->t5c['ds3'][18];
		$this->t5c['ds3'][20] = $this->t5c['ds3'][17] * $this->t4c['ds3'][2] * (1 - $this->t4c['ds3'][3]);
		$this->t5c['ds3'][21] = $this->t5c['ds3'][16] + $this->t5c['ds3'][19];
		$this->t5c['ds3'][22] = $this->t1c['ds3'][5] + $this->t1c['ds3'][6] + $this->t5c['ds3'][13];
		$this->t5c['ds3'][23] = $this->t5c['ds3'][22] * $this->t1c['ds3'][4] * (1 - $this->t4c['ds3'][1]);
		$this->t5c['ds3'][24] = $this->t4c['ds17'][3];
		for($i = 25; $i <= 28; $i++) {
			$this->t5c['ds3'][$i] = $this->t5c['ds3'][$i-24] / $this->t5c['ds3'][13];
			$this->t5c['ds3'][29]+= $this->t5c['ds3'][$i];
		}
		$this->t5c['ds3'][30] = $this->t5c['ds3'][6] / $this->t5c['ds3'][13];
		$this->t5c['ds3'][31] = $this->t5c['ds3'][30];
		$this->t5c['ds3'][32] = $this->t5c['ds3'][29] + $this->t5c['ds3'][31];
		for($i = 33; $i <= 38; $i++) {
			$this->t5c['ds3'][$i] = $this->t5c['ds3'][$i-24] / $this->t5c['ds3'][13];
		}
		$this->t5c['ds3'][39] = $this->t5c['ds3'][15] / $this->t5c['ds3'][21];
		$this->t5c['ds3'][40] = $this->t5c['ds3'][39];
		$this->t5c['ds3'][41] = $this->t5c['ds3'][17] / $this->t5c['ds3'][21];
		$this->t5c['ds3'][42] = $this->t5c['ds3'][18] / $this->t5c['ds3'][21];
		$this->t5c['ds3'][43] = $this->t5c['ds3'][41] + $this->t5c['ds3'][42];
		$this->t5c['ds3'][44] = $this->t5c['ds3'][40] + $this->t5c['ds3'][43];
		ksort($this->t5c['ds3']);
// DATA SET 23
		for($i = 1; $i <= 4; $i++) {
			if ($this->d['ds1'][9] == "Y") {
				$this->t5c['ds23'][$i] = $this->t3c['ds17'][$i];
			} else {
				$this->t5c['ds23'][$i] = $this->t5c['ds2'][$i];
			}
			$this->t5c['ds23'][5]+= $this->t5c['ds23'][$i];
		}
		if ($this->d['ds1'][9] == "Y") {
			$this->t5c['ds23'][6] = $this->t3c['ds17'][6];
		} else {
			$this->t5c['ds23'][6] = $this->t5c['ds2'][6];
		}
		$this->t5c['ds23'][7] = $this->t5c['ds23'][6];
		$this->t5c['ds23'][8] = $this->t5c['ds23'][5] + $this->t5c['ds23'][7];
		for($i = 9; $i <= 13; $i++) {
			if ($this->d['ds1'][9] == "Y") {
				$this->t5c['ds23'][$i] = $this->t3c['ds17'][$i];
			} else {
				$this->t5c['ds23'][$i] = $this->t5c['ds2'][$i];
			}
		}
		if ($this->d['ds1'][9] == "Y") {
			$this->t5c['ds23'][14] = $this->t4c['ds17'][1];
		} else {
			$this->t5c['ds23'][14] = $this->t5c['ds2'][14];
		}
		$this->t5c['ds23'][15] = $this->t5c['ds23'][13] + $this->t5c['ds23'][14];
		$this->t5c['ds23'][16] = $this->t5c['ds23'][13] / $this->t2c['ds16'][4];
		// switched the order of 31 - 40 because there are used by 17 - 20
		for($i = 1; $i <= 4; $i++) {
			if ($this->d['ds1'][4] != "Utility") {
				if ($this->t1c['ds23'][$i+1] == "N") {
					$this->t5c['ds23'][$i+30] = $this->t5c['ds23'][$i] * $this->t3c['ds23'][$i] * (1 - $this->d['ds23'][$i]);
				} else {
					$this->t5c['ds23'][$i+30] = 0;
				}
			} else {
				$this->t5c['ds23'][$i+30] = 0;
			}
			$this->t5c['ds23'][35]+= $this->t5c['ds23'][$i+30];
		}
		for($i = 1; $i <= 4; $i++) {
			if ($this->t1c['ds23'][$i+1] == "Y") {
				$this->t5c['ds23'][$i+35] = $this->t5c['ds23'][$i] * $this->t3c['ds23'][$i];
			} else {
				$this->t5c['ds23'][$i+35] = 0;
			}
			$this->t5c['ds23'][40]+= $this->t5c['ds23'][$i+35];
		}
		// end out of order
		for($i = 1; $i <= 4; $i++) {
			if ($this->t1c['ds23'][$i+1] == "Y") {
				$this->t5c['ds23'][$i+16] = $this->t5c['ds23'][$i+35];
			} else {
				$this->t5c['ds23'][$i+16] = $this->t5c['ds23'][$i+30];
			}
			$this->t5c['ds23'][21]+= $this->t5c['ds23'][$i+16];
		}
		$this->t5c['ds23'][22] = $this->t3c['ds23'][5] * $this->t5c['ds23'][6];
		$this->t5c['ds23'][23] = $this->t5c['ds23'][22];
		// $this->t5c['ds23'][24] = $this->t5c['ds23'][23]; CHANGED ON 5/25/11 VERSION
		$this->t5c['ds23'][24] = $this->t5c['ds23'][23] + $this->t5c['ds23'][21];
		$this->t5c['ds23'][25] = $this->t3c['ds23'][6] * $this->t5c['ds23'][9];
		$this->t5c['ds23'][26] = $this->t3c['ds23'][7] * $this->t5c['ds23'][10];
		$this->t5c['ds23'][27] = $this->t3c['ds23'][8] * $this->t5c['ds23'][11];
		$this->t5c['ds23'][28] = $this->t5c['ds23'][25] + $this->t5c['ds23'][26] + $this->t5c['ds23'][27];
		$this->t5c['ds23'][29] = $this->t5c['ds23'][21] + $this->t5c['ds23'][24] + $this->t5c['ds23'][28];
		$this->t5c['ds23'][30] = $this->t1c['ds23'][1] * $this->t5c['ds23'][14];
		ksort($this->t5c['ds23']);
// DATA SET 24
		$this->t5c['ds24'][1] = $this->t5c['ds23'][22] / ($this->t3c['ds24'][1] * (52 * 40));
		// begin out of order
		$this->t5c['ds24'][4] = $this->t1c['ds24'][3] + $this->t4c['ds24'][1];
		$this->t5c['ds24'][5] = $this->t1c['ds24'][4] + $this->t4c['ds24'][2];
		// end out of order
		$this->t5c['ds24'][2] = ($this->t5c['ds2'][6] * $this->t3c['ds2'][5]) / ($this->t5c['ds24'][4] * 40 * 52);
		if ($this->d['ds1'][9] == "Y") {
			$this->t5c['ds24'][3] = $this->t5c['ds24'][1];
		} else {
			$this->t5c['ds24'][3] = $this->t5c['ds24'][2];
		}
		$this->t5c['ds24'][6] = $this->t5c['ds24'][4] * 52 * 40;
		$this->t5c['ds24'][7] = $this->t5c['ds24'][5] * 52 * 40;
		ksort($this->t5c['ds24']);
// DATA SET 27
		if ($this->d['ds1'][9] == "Y") {
			$this->t5c['ds27'][1] = $this->t4c['ds18'][1];
		} else {
			$this->t5c['ds27'][1] = $this->t5c['ds2'][16];
		}
		$this->t5c['ds27'][2] = $this->t5c['ds27'][1];
		if ($this->d['ds1'][9] == "Y") {
			$this->t5c['ds27'][3] = $this->t4c['ds18'][3];
		} else {
			$this->t5c['ds27'][3] = $this->t5c['ds2'][18];
		}
		if ($this->d['ds1'][9] == "Y") {
			$this->t5c['ds27'][4] = $this->t4c['ds18'][4];
		} else {
			$this->t5c['ds27'][4] = $this->t5c['ds2'][19];
		}
		$this->t5c['ds27'][5] = $this->t5c['ds27'][3] + $this->t5c['ds27'][4];
		if ($this->d['ds1'][9] == "Y") {
			$this->t5c['ds27'][6] = $this->t4c['ds18'][6];
		} else {
			$this->t5c['ds27'][6] = $this->t5c['ds2'][21];
		}
		if ($this->d['ds1'][9] == "Y") {
			$this->t5c['ds27'][7] = $this->t3c['ds19'][3];
		} else {
			$this->t5c['ds27'][7] = $this->t5c['ds2'][24];
		}
		$this->t5c['ds27'][8] = $this->t5c['ds27'][2] + $this->t5c['ds27'][5];
		$this->t5c['ds27'][9] = $this->t5c['ds27'][8] / ($this->t1c['ds1'][1] * 1000);
		$this->t5c['ds27'][10] = $this->t5c['ds27'][1] * $this->t3c['ds27'][1];
		$this->t5c['ds27'][11] = $this->t5c['ds27'][10];
		// start out of order
		if ($this->t1c['ds27'][1] == "N") {
			$this->t5c['ds27'][19] = $this->t5c['ds27'][3] * $this->t3c['ds27'][2] * (1 - $this->d['ds27'][1]);
		} else {
			$this->t5c['ds27'][19] = 0;
		}
		if ($this->t1c['ds27'][1] == "Y") {
			$this->t5c['ds27'][20] = $this->t5c['ds27'][3] * $this->t3c['ds27'][2];
		} else {
			$this->t5c['ds27'][20] = 0;
		}
		// end out of order
		if ($this->t1c['ds27'][1] == "Y") {
			$this->t5c['ds27'][12] = $this->t5c['ds27'][20];
		} else {
			$this->t5c['ds27'][12] = $this->t5c['ds27'][19];
		}
		$this->t5c['ds27'][13] = $this->t5c['ds27'][4] * $this->t3c['ds27'][3];
		$this->t5c['ds27'][14] = $this->t5c['ds27'][12] + $this->t5c['ds27'][13];
		$this->t5c['ds27'][15] = $this->t5c['ds27'][6] * $this->t3c['ds27'][4];
		$this->t5c['ds27'][16] = $this->t5c['ds27'][7] * $this->t3c['ds27'][6];
		$this->t5c['ds27'][17] = $this->t5c['ds27'][11] + $this->t5c['ds27'][14];
		ksort($this->t5c['ds27']);
// DATA SET 30
		$this->t5c['ds30'][1] = $this->t5c['ds27'][10];
		$this->t5c['ds30'][2] = $this->t5c['ds30'][1] * $this->t2c['ds30'][1];
		$this->t5c['ds30'][3] = $this->t5c['ds30'][1] * $this->t2c['ds30'][2];
		$this->t5c['ds30'][4] = $this->t5c['ds30'][1] - $this->t5c['ds30'][2] - $this->t5c['ds30'][3];
		$this->t5c['ds30'][5] = $this->t5c['ds30'][1] * $this->t4c['ds25'][1] / pow(10,6);
// DATA SET 32
		for($i = 1; $i <= 22; $i++) {
			if ($i == 15) {
				$this->t5c['ds32'][$i] = $this->t5c['ds30'][4] * $this->t1c['ds57'][$i+264] + ($this->t5c['ds30'][3] * $this->t1c['ds30'][1]);
			} else if ($i == 21) {
				$this->t5c['ds32'][$i] = $this->t5c['ds30'][4] * $this->t1c['ds57'][$i+264] + ($this->t5c['ds30'][2] * $this->d['ds30'][1]);
			} else {
				$this->t5c['ds32'][$i] = $this->t5c['ds30'][4] * $this->t1c['ds57'][$i+264];
			}
			$this->t5c['ds32'][23]+= $this->t5c['ds32'][$i];
		}
		for($i = 1; $i <= 22; $i++) {
			$this->t5c['ds32'][$i+23]+= $this->t5c['ds32'][$i] * $this->t4c['ds25'][1] / pow(10,6);
			$this->t5c['ds32'][46]+= $this->t5c['ds32'][$i+23];
		}
		ksort($this->t5c['ds32']);
// DATA SET 33
		for($i = 1; $i <= 22; $i++) {
			$this->t5c['ds33'][$i] = $this->t5c['ds32'][$i+23] * $this->t1c['ds57'][$i+22];
			$this->t5c['ds33'][23]+= $this->t5c['ds33'][$i];
		}
		for($i = 1; $i <= 22; $i++) {
			$this->t5c['ds33'][$i+23] = $this->t5c['ds32'][$i+23] * $this->t1c['ds57'][$i+44];
			$this->t5c['ds33'][46]+= $this->t5c['ds33'][$i+23];
		}
		for($i = 1; $i <= 22; $i++) {
			$this->t5c['ds33'][$i+46] = $this->t5c['ds33'][$i] + $this->t5c['ds33'][$i+23];
			$this->t5c['ds33'][69]+= $this->t5c['ds33'][$i+46];
		}
		$this->t5c['ds33'][70] = $this->t5c['ds32'][46];
		$this->t5c['ds33'][71] = $this->t5c['ds33'][70] * $this->t4c['ds26'][1];
		for($i = 1; $i <= 22; $i++) {
			$this->t5c['ds33'][$i+71] = $this->t5c['ds32'][$i+23] * $this->t1c['ds57'][$i+110];
			$this->t5c['ds33'][94]+= $this->t5c['ds33'][$i+71];
		}
		$this->t5c['ds33'][95] = $this->t5c['ds33'][94] * $this->t4c['ds26'][1];
		for($i = 1; $i <= 22; $i++) {
			$this->t5c['ds33'][$i+95] = $this->t5c['ds32'][$i+23] * $this->t1c['ds57'][$i+132];
			$this->t5c['ds33'][118]+= $this->t5c['ds33'][$i+95];
		}
		$this->t5c['ds33'][119] = $this->t5c['ds33'][118] * $this->t4c['ds26'][1];
		for($i = 1; $i <= 22; $i++) {
			$this->t5c['ds33'][$i+119] = $this->t5c['ds33'][$i+71] + $this->t5c['ds33'][$i+95];
			$this->t5c['ds33'][142]+= $this->t5c['ds33'][$i+119];
		}
		$this->t5c['ds33'][143] = $this->t5c['ds33'][142] * $this->t4c['ds26'][1];
		for($i = 1; $i <= 22; $i++) {
			$this->t5c['ds33'][$i+143] = $this->t5c['ds32'][$i+23] * $this->t1c['ds57'][$i+176];
			$this->t5c['ds33'][166]+= $this->t5c['ds33'][$i+143];
		}
		$this->t5c['ds33'][167] = $this->t5c['ds33'][166] * $this->t4c['ds26'][1];
		for($i = 1; $i <= 22; $i++) {
			$this->t5c['ds33'][$i+167] = $this->t5c['ds32'][$i+23] * $this->t1c['ds57'][$i+198];
			$this->t5c['ds33'][190]+= $this->t5c['ds33'][$i+167];
		}
		$this->t5c['ds33'][191] = $this->t5c['ds33'][190] * $this->t4c['ds26'][1];
		for($i = 1; $i <= 22; $i++) {
			$this->t5c['ds33'][$i+191] = $this->t5c['ds32'][$i+23] * $this->t1c['ds57'][$i+220];
			$this->t5c['ds33'][214]+= $this->t5c['ds33'][$i+191];
		}
		$this->t5c['ds33'][215] = $this->t5c['ds33'][214] * $this->t4c['ds26'][1];
		for($i = 1; $i <= 22; $i++) {
			$this->t5c['ds33'][$i+215] = $this->t5c['ds33'][$i+167] + $this->t5c['ds33'][$i+191];
			$this->t5c['ds33'][238]+= $this->t5c['ds33'][$i+215];
		}
		$this->t5c['ds33'][239] = $this->t5c['ds33'][238] * $this->t4c['ds26'][1];
		ksort($this->t5c['ds33']);
// DATA SET 34
		$this->t5c['ds34'][1] = $this->t5c['ds27'][20];
		$this->t5c['ds34'][2] = $this->t5c['ds27'][19];
		$this->t5c['ds34'][3] = $this->t5c['ds27'][13];
		$this->t5c['ds34'][4] = $this->t5c['ds27'][15] + $this->t5c['ds27'][16];
		if ($this->t1c['ds16'][3] == 2) {
			$this->t5c['ds34'][5] = $this->t5c['ds23'][22];
		} else {
			$this->t5c['ds34'][5] = 0;
		}
		if ($this->t1c['ds16'][3] == 1) {
			$this->t5c['ds34'][6] = $this->t5c['ds23'][22];
		} else {
			$this->t5c['ds34'][6] = 0;
		}
		// $this->t5c['ds34'][7] = $this->t5c['ds23'][38]; CHANGED ON 5/25/11 VERSION
		$this->t5c['ds34'][7] = 0;
		$this->t5c['ds34'][8] = $this->t5c['ds23'][36];
		$this->t5c['ds34'][9] = $this->t5c['ds23'][39];
		$this->t5c['ds34'][10] = $this->t5c['ds23'][38];
		$this->t5c['ds34'][11] = $this->t5c['ds23'][31] + $this->t5c['ds23'][32] + $this->t5c['ds23'][33] + $this->t5c['ds23'][34];
		// $this->t5c['ds34'][12] = $this->t5c['ds23'][25] * .8; CHANGED ON 5/25/11 VERSION
		$this->t5c['ds34'][12] = 0;
		// $this->t5c['ds34'][13] = ($this->t5c['ds23'][25] - $this->t5c['ds34'][12]) + $this->t5c['ds23'][30]; CHANGED ON 5/25/11 VERSION
		$this->t5c['ds34'][13] = 0;
		$this->t5c['ds34'][14] = ($this->t5c['ds23'][26] + $this->t5c['ds23'][27]) * .5;
		$this->t5c['ds34'][15] = $this->t5c['ds23'][25] * .8;
		$this->t5c['ds34'][16] = ($this->t5c['ds23'][26] + $this->t5c['ds23'][27]) - $this->t5c['ds34'][14];
		$this->t5c['ds34'][17] = ($this->t5c['ds23'][25] - $this->t5c['ds34'][15]) + $this->t5c['ds23'][30];
		$this->t5c['ds34'][18] = $this->t5c['ds23'][37];
		for ($i = 18; $i <= 25; $i++) {
			$this->t5c['ds34'][19]+= $this->d['ds34'][$i];
		}
		for ($i = 5; $i <= 18; $i++) {
			$this->t5c['ds34'][19]+= $this->t5c['ds34'][$i];
		}
// DATA SET 37
		$total = $this->t5c['ds2'][13] * $this->t1c['ds2'][1];
		$n_amount = $total / $this->t1c['ds2'][2];
		$total = $total - $n_amount;
		for($i = 1; $i <= 30; $i++) {
			if ($i < $this->t1c['ds2'][2]) {
				$this->t5c['ds37'][$i] = $total * $this->d['ds19'][3];
				$total = $total - $n_amount;
				$this->t5c['ds37'][31]+= $this->t5c['ds37'][$i];
			} else {
				$this->t5c['ds37'][$i] = 0;
			}
		}
		$this->t5c['ds37'][32] = $this->t5c['ds37'][31] / $this->t1c['ds2'][2];
		for($i = 1; $i <= 30; $i++) {
			if ($i <= $this->t1c['ds2'][2]) {
				$this->t5c['ds37'][$i+32] = abs($this->PPMT($this->t1c['ds2'][3], $i, $this->t1c['ds2'][2], $this->t5c['ds2'][13] * $this->t1c['ds2'][1]));
			} else {
				$this->t5c['ds37'][$i+32] = 0;
			}
			$this->t5c['ds37'][63]+= $this->t5c['ds37'][$i+32];
		}
		$this->t5c['ds37'][64] = $this->t5c['ds37'][63] / $this->t1c['ds2'][2];
		for($i = 1; $i <= 32; $i++) {
			$this->t5c['ds37'][$i+64] = $this->t5c['ds37'][$i] + $this->t5c['ds37'][$i+32];
		}
		ksort($this->t5c['ds37']);
// DATA SET 38
		for ($i = 1; $i <= 12; $i++) {
			$this->t5c['ds38'][$i] = $this->t5c['ds23'][$i];
		}
		$this->t5c['ds38'][13] = $this->t5c['ds38'][8] + $this->t5c['ds38'][12];
		$this->t5c['ds38'][14] = $this->t5c['ds23'][14];
		$this->t5c['ds38'][15] = $this->t5c['ds38'][13] + $this->t5c['ds38'][14];
// DATA SET 39
		for ($i = 1; $i <= 7; $i++) {
			$this->t5c['ds39'][$i] = $this->t5c['ds27'][$i];
		}
// DATA SET 40
		if ($this->d['ds1'][9] == "Y") {
			$this->t5c['ds40'][1] = $this->t3c['ds19'][1];
		} else {
			$this->t5c['ds40'][1] = $this->t5c['ds2'][23];
		}
		if ($this->d['ds1'][9] == "Y") {
			$this->t5c['ds40'][2] = $this->t3c['ds19'][3];
		} else {
			$this->t5c['ds40'][2] = $this->t5c['ds2'][24];
		}
		$this->t6();
	}
	function t6() {
// DATA SET 24
		$this->t6c['ds24'][1] = $this->t5c['ds27'][11] / ($this->t3c['ds24'][2] * (52 * 40));
		$this->t6c['ds24'][2] = ($this->t5c['ds2'][17] * $this->t3c['ds2'][10]) / ($this->t5c['ds24'][5] * (52 * 40));
		if ($this->d['ds1'][9] == "Y") {
			$this->t6c['ds24'][3] = $this->t6c['ds24'][1];
		} else {
			$this->t6c['ds24'][3] = $this->t6c['ds24'][2];
		}	
// DATA SET 26
		for ($i = 1; $i <= 22; $i++) {
			$this->t6c['ds26'][$i] = 
				$this->d['ds34'][18] * 
				$this->x['dd2'][1]['v'.$i] + 
				$this->d['ds34'][19] * 
				$this->x['dd2'][2]['v'.$i] + 
				$this->d['ds34'][20] * 
				$this->x['dd2'][3]['v'.$i] + 
				$this->t5c['ds34'][5] * 
				$this->x['dd2'][4]['v'.$i] + 
				$this->t5c['ds34'][6] * 
				$this->x['dd2'][5]['v'.$i] + 
				$this->t5c['ds34'][7] * 
				$this->x['dd2'][6]['v'.$i] + 
				$this->t5c['ds34'][8] * 
				$this->x['dd2'][7]['v'.$i] + 
				$this->d['ds34'][21] * 
				$this->x['dd2'][8]['v'.$i] + 
				$this->t5c['ds34'][9] * 
				$this->x['dd2'][9]['v'.$i] + 
				$this->d['ds34'][22] * 
				$this->x['dd2'][10]['v'.$i] + 
				$this->t5c['ds34'][10] * 
				$this->x['dd2'][11]['v'.$i] + 
				$this->t5c['ds34'][11] * 
				$this->x['dd2'][12]['v'.$i] + 
				$this->t5c['ds34'][12] * 
				$this->x['dd2'][13]['v'.$i] + 
				$this->t5c['ds34'][13] * 
				$this->x['dd2'][14]['v'.$i] + 
				$this->d['ds34'][23] * 
				$this->x['dd2'][15]['v'.$i] + 
				$this->d['ds34'][24] * 
				$this->x['dd2'][16]['v'.$i] + 
				$this->d['ds34'][25] * 
				$this->x['dd2'][17]['v'.$i] + 
				$this->t5c['ds34'][14] * 
				$this->x['dd2'][18]['v'.$i] + 
				$this->t5c['ds34'][15] * 
				$this->x['dd2'][19]['v'.$i] + 
				$this->t5c['ds34'][16] * 
				$this->x['dd2'][20]['v'.$i] + 
				$this->t5c['ds34'][17] * 
				$this->x['dd2'][21]['v'.$i] + 
				$this->t5c['ds34'][18] * 
				$this->x['dd2'][22]['v'.$i]
			;
			$this->t6c['ds26'][23]+= $this->t6c['ds26'][$i];
		}
		for ($i = 1; $i <= 23; $i++) {
			$this->t6c['ds26'][$i+23]+= $this->t6c['ds26'][$i];
		}
		for ($i = 1; $i <= 22; $i++) {
			$this->t6c['ds26'][$i+46] = $this->t6c['ds26'][$i+23] * $this->t4c['ds25'][1] / pow(10,6);
			$this->t6c['ds26'][69]+= $this->t6c['ds26'][$i+46];
		}
		$this->t6c['ds26'][70] = $this->t5c['ds23'][22] * $this->t4c['ds25'][1] / pow(10,6);
		$this->t6c['ds26'][71] =$this->t6c['ds26'][50] - $this->t6c['ds26'][70];
		$this->t6c['ds26'][72] =$this->t6c['ds26'][51] - $this->t6c['ds26'][70];
		for ($i = 1; $i <= 22; $i++) {
			if ($i == 4 OR $i == 5) {
				if ($this->t6c['ds26'][$i+41] > 0) {
					$this->t6c['ds26'][$i+72] = ($this->t6c['ds26'][$i+70] * $this->t1c['ds57'][$i]) + $this->t5c['ds24'][3];
				} else {
					$this->t6c['ds26'][$i+72] = 0;
				}
			} else {
				$this->t6c['ds26'][$i+72] = $this->t6c['ds26'][$i+46] * $this->t1c['ds57'][$i];
			}
			$this->t6c['ds26'][95]+= $this->t6c['ds26'][$i+72];
		}
		for ($i = 1; $i <= 22; $i++) {
			$this->t6c['ds26'][$i+95] = $this->t6c['ds26'][$i+46] * $this->t1c['ds57'][$i+22];
			$this->t6c['ds26'][118]+= $this->t6c['ds26'][$i+95];
		}
		for ($i = 1; $i <= 22; $i++) {
			$this->t6c['ds26'][$i+118] = $this->t6c['ds26'][$i+46] * $this->t1c['ds57'][$i+44];
			$this->t6c['ds26'][141]+= $this->t6c['ds26'][$i+118];
		}
		for ($i = 1; $i <= 22; $i++) {
			$this->t6c['ds26'][$i+141] = $this->t6c['ds26'][$i+72] + $this->t6c['ds26'][$i+95] + $this->t6c['ds26'][$i+118];
			$this->t6c['ds26'][164]+= $this->t6c['ds26'][$i+141];
		}
		for ($i = 1; $i <= 22; $i++) {
			if ($i == 4 OR $i == 5) {
				if ($this->t6c['ds26'][$i+41] > 0) {
					$this->t6c['ds26'][$i+164] = $this->t6c['ds26'][70] + ($this->t6c['ds26'][$i+70] * $this->t1c['ds57'][$i+88]);
				} else {
					$this->t6c['ds26'][$i+164] = 0;
				}
			} else {
				$this->t6c['ds26'][$i+164] = $this->t6c['ds26'][$i+46] * $this->t1c['ds57'][$i+88];
			}
			$this->t6c['ds26'][187]+= $this->t6c['ds26'][$i+164];
		}
		$this->t6c['ds26'][188]+= $this->t4c['ds26'][1] * $this->t6c['ds26'][187];
		for ($i = 1; $i <= 22; $i++) {
			$this->t6c['ds26'][$i+188] = $this->t6c['ds26'][$i+46] * $this->t1c['ds57'][$i+110];
			$this->t6c['ds26'][211]+= $this->t6c['ds26'][$i+188];
		}
		$this->t6c['ds26'][212]+= $this->t4c['ds26'][1] * $this->t6c['ds26'][211];
		for ($i = 1; $i <= 22; $i++) {
			$this->t6c['ds26'][$i+212] = $this->t6c['ds26'][$i+46] * $this->t1c['ds57'][$i+132];
			$this->t6c['ds26'][235]+= $this->t6c['ds26'][$i+212];
		}
		$this->t6c['ds26'][236]+= $this->t4c['ds26'][1] * $this->t6c['ds26'][235];
		for ($i = 1; $i <= 22; $i++) {
			$this->t6c['ds26'][$i+236] = $this->t6c['ds26'][$i+164] + $this->t6c['ds26'][$i+188] + $this->t6c['ds26'][$i+212];
			$this->t6c['ds26'][259]+= $this->t6c['ds26'][$i+236];
		}
		$this->t6c['ds26'][260]+= $this->t4c['ds26'][1] * $this->t6c['ds26'][259];
		for ($i = 1; $i <= 22; $i++) {
			$this->t6c['ds26'][$i+260] = $this->t6c['ds26'][$i+46] * $this->t1c['ds57'][$i+176];
			$this->t6c['ds26'][283]+= $this->t6c['ds26'][$i+260];
		}
		$this->t6c['ds26'][284]+= $this->t4c['ds26'][1] * $this->t6c['ds26'][283];
		for ($i = 1; $i <= 22; $i++) {
			$this->t6c['ds26'][$i+284] = $this->t6c['ds26'][$i+46] * $this->t1c['ds57'][$i+198];
			$this->t6c['ds26'][307]+= $this->t6c['ds26'][$i+284];
		}
		$this->t6c['ds26'][308]+= $this->t4c['ds26'][1] * $this->t6c['ds26'][307];
		for ($i = 1; $i <= 22; $i++) {
			$this->t6c['ds26'][$i+308] = $this->t6c['ds26'][$i+46] * $this->t1c['ds57'][$i+220];
			$this->t6c['ds26'][331]+= $this->t6c['ds26'][$i+308];
		}
		$this->t6c['ds26'][332]+= $this->t4c['ds26'][1] * $this->t6c['ds26'][331];
		for ($i = 1; $i <= 22; $i++) {
			$this->t6c['ds26'][$i+332] = $this->t6c['ds26'][$i+260] + $this->t6c['ds26'][$i+284] + $this->t6c['ds26'][$i+308];
			$this->t6c['ds26'][355]+= $this->t6c['ds26'][$i+332];
		}
		$this->t6c['ds26'][356]+= $this->t4c['ds26'][1] * $this->t6c['ds26'][355];
		ksort($this->t6c['ds26']);
// DATA SET 27
		if ($this->d['ds1'][9] == "Y") {
			$this->t6c['ds27'][1] = $this->t3c['ds36'][96];
		} else {
			$this->t6c['ds27'][1] = $this->t5c['ds37'][96];
		}
		$this->t6c['ds27'][2] = $this->t5c['ds27'][2] + $this->t5c['ds27'][5] + $this->t5c['ds27'][6] + $this->t6c['ds27'][1] + $this->t5c['ds27'][7];
		$this->t6c['ds27'][3] = $this->t6c['ds27'][2] - $this->t5c['ds27'][8];
		$this->t6c['ds27'][4] = $this->t6c['ds27'][1] * $this->t3c['ds27'][5];
		$this->t6c['ds27'][5] = $this->t5c['ds27'][11] + $this->t5c['ds27'][14] + $this->t5c['ds27'][15] + $this->t6c['ds27'][4] + $this->t5c['ds27'][16];
		if ($this->d['ds1'][9] == "Y") {
			$this->t6c['ds27'][6] = $this->t3c['ds36'][96] * $this->t3c['ds27'][5];
		} else {
			$this->t6c['ds27'][6] = $this->t5c['ds37'][96] * $this->t3c['ds27'][5];
		}
		$this->t6c['ds27'][7] = $this->t6c['ds27'][5] - $this->t5c['ds27'][17];
// DATA SET 30
		if ($this->d['ds1'][9] == "Y") {
			$this->t6c['ds30'][1] = $this->t6c['ds24'][1];
		} else {
			$this->t6c['ds30'][1] = $this->t6c['ds24'][2];
		}
		$this->t6c['ds30'][2] = $this->t6c['ds30'][1];
// DATA SET 34
		$this->t6c['ds34'][1] = $this->t6c['ds27'][6];
		for($i = 1; $i <= 17; $i++) {
			$this->t6c['ds34'][2]+= $this->d['ds34'][$i];
		}
		for($i = 1; $i <= 4; $i++) {
			$this->t6c['ds34'][2]+= $this->t5c['ds34'][$i];
		}
		$this->t6c['ds34'][2]+= $this->t6c['ds34'][1];
// DATA SET 39
		$this->t6c['ds39'][1] = $this->t6c['ds27'][1];
		$this->t6c['ds39'][2] = $this->t6c['ds27'][2];
		$this->t7();
	}
	function t7() {
// DATA SET 39
		$this->t7c['ds25'][1] = $this->t6c['ds26'][89] + $this->t6c['ds26'][90] + $this->t6c['ds26'][91];
		// start out of order
		$this->t7c['ds25'][3] = $this->t6c['ds26'][78] + $this->t6c['ds26'][79] + $this->t6c['ds26'][80] + $this->t6c['ds26'][81] + $this->t6c['ds26'][82] + $this->t6c['ds26'][83] + $this->t6c['ds26'][94];
		$this->t7c['ds25'][4] = $this->t6c['ds26'][75] + $this->t6c['ds26'][76] + $this->t6c['ds26'][77];
		// end out of order
		// $this->t7c['ds25'][2] = $this->t6c['ds26'][95] - $this->t6c['ds26'][75] - $this->t7c['ds25'][3] - $this->t7c['ds25'][1]; CHANGED AFTER VERSION 4/7/11
		$this->t7c['ds25'][2] = $this->t6c['ds26'][95] - $this->t7c['ds25'][4] - $this->t7c['ds25'][3] - $this->t7c['ds25'][1];
		$this->t7c['ds25'][5] = $this->t6c['ds26'][112] + $this->t6c['ds26'][113] + $this->t6c['ds26'][114];
		// start out of order
		$this->t7c['ds25'][7] = $this->t6c['ds26'][101] + $this->t6c['ds26'][102] + $this->t6c['ds26'][103] + $this->t6c['ds26'][104] + $this->t6c['ds26'][105] + $this->t6c['ds26'][106] + $this->t6c['ds26'][117];
		// end out of order
		$this->t7c['ds25'][6] = $this->t6c['ds26'][118] - $this->t6c['ds26'][98] - $this->t7c['ds25'][7] - $this->t7c['ds25'][5];
		$this->t7c['ds25'][8] = $this->t6c['ds26'][98] + $this->t6c['ds26'][99] + $this->t6c['ds26'][100];
		$this->t7c['ds25'][9] = ($this->t6c['ds26'][181] + $this->t6c['ds26'][182] + $this->t6c['ds26'][183]) * $this->t4c['ds26'][1];
		// start out of order
		$this->t7c['ds25'][11] = ($this->t6c['ds26'][170] + $this->t6c['ds26'][171] + $this->t6c['ds26'][172] + $this->t6c['ds26'][173] + $this->t6c['ds26'][174] + $this->t6c['ds26'][175]) * $this->t4c['ds26'][1];
		$this->t7c['ds25'][12] = $this->t6c['ds26'][167] + $this->t6c['ds26'][168] + $this->t6c['ds26'][169];
		// end out of order
		// $this->t7c['ds25'][10] = (($this->t6c['ds26'][187] - $this->t6c['ds26'][167]) * $this->t4c['ds26'][1]) - $this->t7c['ds25'][11] - $this->t7c['ds25'][9]; CHANGED AFTER VERSION 4/7/11
		$this->t7c['ds25'][10] = (($this->t6c['ds26'][187] - $this->t7c['ds25'][12]) * $this->t4c['ds26'][1]) - $this->t7c['ds25'][11] - $this->t7c['ds25'][9];
		$this->t7c['ds25'][13] = $this->t6c['ds26'][168] + $this->t6c['ds26'][169] + $this->t6c['ds26'][170] + $this->t6c['ds26'][171];
		$this->t7c['ds25'][14] = $this->t6c['ds26'][167] - $this->t6c['ds26'][70];
		$this->t7c['ds25'][15] = ($this->t6c['ds26'][194] + $this->t6c['ds26'][195] + $this->t6c['ds26'][196] + $this->t6c['ds26'][197] + $this->t6c['ds26'][198] + $this->t6c['ds26'][199]) * $this->t4c['ds26'][1];
		$this->t7c['ds25'][16] = ($this->t6c['ds26'][277] + $this->t6c['ds26'][278] + $this->t6c['ds26'][279]) * $this->t4c['ds26'][1];
		// start out of order
		$this->t7c['ds25'][18] = ($this->t6c['ds26'][266] + $this->t6c['ds26'][267] + $this->t6c['ds26'][268] + $this->t6c['ds26'][269] + $this->t6c['ds26'][270] + $this->t6c['ds26'][271]) * $this->t4c['ds26'][1];
		$this->t7c['ds25'][19] = $this->t6c['ds26'][263] + $this->t6c['ds26'][264] + $this->t6c['ds26'][265];
		// end out of order
		// $this->t7c['ds25'][17] = (($this->t6c['ds26'][283] - $this->t6c['ds26'][263]) * $this->t4c['ds26'][1]) - $this->t7c['ds25'][18] - $this->t7c['ds25'][16]; CHANGED AFTER VERSION 4/7/11
		$this->t7c['ds25'][17] = (($this->t6c['ds26'][283] - $this->t7c['ds25'][19]) * $this->t4c['ds26'][1]) - $this->t7c['ds25'][18] - $this->t7c['ds25'][16];
		$this->t7c['ds25'][20] = ($this->t6c['ds26'][283] - $this->t6c['ds26'][263] - $this->t7c['ds25'][16]) * $this->t4c['ds26'][1];
		$this->t7c['ds25'][21] = $this->t6c['ds26'][290] + $this->t6c['ds26'][291] + $this->t6c['ds26'][292] + $this->t6c['ds26'][293] + $this->t6c['ds26'][294] + $this->t6c['ds26'][295];
		ksort($this->t7c['ds25']);
// DATA SET 28
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds28'][$i] = 
				$this->d['ds34'][1] * 
				$this->x['dd2'][1]['v'.$i] + 
				$this->d['ds34'][2] * 
				$this->x['dd2'][2]['v'.$i] + 
				$this->d['ds34'][3] * 
				$this->x['dd2'][3]['v'.$i] + 
				$this->d['ds34'][4] * 
				$this->x['dd2'][4]['v'.$i] + 
				$this->d['ds34'][5] * 
				$this->x['dd2'][5]['v'.$i] + 
				$this->d['ds34'][6] * 
				$this->x['dd2'][6]['v'.$i] + 
				$this->d['ds34'][7] * 
				$this->x['dd2'][7]['v'.$i] + 
				$this->d['ds34'][8] * 
				$this->x['dd2'][8]['v'.$i] + 
				$this->t5c['ds34'][1] * 
				$this->x['dd2'][9]['v'.$i] + 
				$this->d['ds34'][9] * 
				$this->x['dd2'][10]['v'.$i] + 
				$this->d['ds34'][10] * 
				$this->x['dd2'][11]['v'.$i] + 
				$this->t5c['ds34'][2] * 
				$this->x['dd2'][12]['v'.$i] + 
				$this->d['ds34'][11] * 
				$this->x['dd2'][13]['v'.$i] + 
				$this->d['ds34'][12] * 
				$this->x['dd2'][14]['v'.$i] + 
				$this->d['ds34'][13] * 
				$this->x['dd2'][15]['v'.$i] + 
				$this->t2c['ds34'][1] * 
				$this->x['dd2'][16]['v'.$i] + 
				$this->d['ds34'][14] * 
				$this->x['dd2'][17]['v'.$i] + 
				$this->t5c['ds34'][3] * 
				$this->x['dd2'][18]['v'.$i] + 
				$this->d['ds34'][15] * 
				$this->x['dd2'][19]['v'.$i] + 
				$this->d['ds34'][16] * 
				$this->x['dd2'][20]['v'.$i] + 
				$this->t5c['ds34'][4] * 
				$this->x['dd2'][21]['v'.$i] + 
				$this->d['ds34'][17] * 
				$this->x['dd2'][22]['v'.$i]
			;
			$this->t7c['ds28'][23]+= $this->t7c['ds28'][$i];
		}
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds28'][$i+23]+= $this->t7c['ds28'][$i];
			$this->t7c['ds28'][46]+= $this->t7c['ds28'][$i+23];
		}
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds28'][$i+46]+= $this->t7c['ds28'][$i+23] * $this->t4c['ds25'][1] / pow(10,6);
			$this->t7c['ds28'][69]+= $this->t7c['ds28'][$i+46];
		}
		ksort($this->t7c['ds28']);
// DATA SET 29
		for ($i = 1; $i <= 22; $i++) {
			if ($i <= 13) {
				$this->t7c['ds29'][$i] = $this->t7c['ds28'][$i+46] * $this->t1c['ds57'][$i];
				$this->t7c['ds29'][14]+= $this->t7c['ds29'][$i];
			} else {
				$this->t7c['ds29'][14]+= $this->d['ds29'][$i-13];
			}
		}
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds29'][$i+14] = $this->t7c['ds28'][$i+46] * $this->t1c['ds57'][$i+22];
			$this->t7c['ds29'][37]+= $this->t7c['ds29'][$i+14];
		}
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds29'][$i+37] = $this->t7c['ds28'][$i+46] * $this->t1c['ds57'][$i+44];
			$this->t7c['ds29'][60]+= $this->t7c['ds29'][$i+37];
		}
		for ($i = 1; $i <= 22; $i++) {
			if ($i <= 13) {
				$this->t7c['ds29'][$i+60] = $this->t7c['ds29'][$i] + $this->t7c['ds29'][$i+14] + $this->t7c['ds29'][$i+37];
			} else {
				$this->t7c['ds29'][$i+60] = $this->d['ds29'][$i-13] + $this->t7c['ds29'][$i+14] + $this->t7c['ds29'][$i+37];
			}
			$this->t7c['ds29'][83]+= $this->t7c['ds29'][$i+60];
		}
		for ($i = 1; $i <= 22; $i++) {
			if ($i <= 13) {
				$this->t7c['ds29'][$i+83] = $this->t7c['ds28'][$i+46] * $this->t1c['ds57'][$i+88];
				$this->t7c['ds29'][97]+= $this->t7c['ds29'][$i+83];
			} else {
				$this->t7c['ds29'][97]+= $this->d['ds29'][$i-4];
			}
		}
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds29'][$i+97] = $this->t7c['ds28'][$i+46] * $this->t1c['ds57'][$i+110];
			$this->t7c['ds29'][120]+= $this->t7c['ds29'][$i+97];
		}
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds29'][$i+120] = $this->t7c['ds28'][$i+46] * $this->t1c['ds57'][$i+132];
			$this->t7c['ds29'][143]+= $this->t7c['ds29'][$i+120];
		}
		for ($i = 1; $i <= 22; $i++) {
			if ($i <= 13) {
				$this->t7c['ds29'][$i+143] = $this->t7c['ds29'][$i+83] + $this->t7c['ds29'][$i+97] + $this->t7c['ds29'][$i+120];
			} else {
				$this->t7c['ds29'][$i+143] = $this->d['ds29'][$i-4] + $this->t7c['ds29'][$i+97] + $this->t7c['ds29'][$i+120];
			}
			$this->t7c['ds29'][166]+= $this->t7c['ds29'][$i+143];
		}
		for ($i = 1; $i <= 22; $i++) {
			if ($i <= 13) {
				$this->t7c['ds29'][$i+166] = $this->t7c['ds28'][$i+46] * $this->t1c['ds57'][$i+176];
				$this->t7c['ds29'][180]+= $this->t7c['ds29'][$i+166];
			} else {
				$this->t7c['ds29'][180]+= $this->d['ds29'][$i+5];
			}
		}
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds29'][$i+180] = $this->t7c['ds28'][$i+46] * $this->t1c['ds57'][$i+198];
			$this->t7c['ds29'][203]+= $this->t7c['ds29'][$i+180];
		}
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds29'][$i+203] = $this->t7c['ds28'][$i+46] * $this->t1c['ds57'][$i+220];
			$this->t7c['ds29'][226]+= $this->t7c['ds29'][$i+203];
		}
		for ($i = 1; $i <= 22; $i++) {
			if ($i <= 13) {
				$this->t7c['ds29'][$i+226] = $this->t7c['ds29'][$i+166] + $this->t7c['ds29'][$i+180] + $this->t7c['ds29'][$i+203];
			} else {
				$this->t7c['ds29'][$i+226] = $this->d['ds29'][$i+5] + $this->t7c['ds29'][$i+180] + $this->t7c['ds29'][$i+203];
			}
			$this->t7c['ds29'][249]+= $this->t7c['ds29'][$i+226];
		}
		ksort($this->t7c['ds29']);
		// ======= Data Sets 31, 33, and 35 are vary interdpendtent because of a few cells ================================================================ //
		// ======= For this reason, parts of each will be completed in an order that will allow completion without furthur calculation tiers ============== //
// DATA SET 35
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds35'][$i+24] = $this->t7c['ds29'][$i+14] + $this->t5c['ds33'][$i];
			$this->t7c['ds35'][47]+= $this->t7c['ds35'][$i+24];
		}
// DATA SET 33
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds33'][2]+= $this->t7c['ds35'][$i+24];
		}
		if ($this->t7c['ds33'][2] == 0) {
			$this->t7c['ds33'][1] = 0;
		} else {
			$this->t7c['ds33'][1] = $this->t6c['ds30'][2];
		}
		ksort($this->t7c['ds33']);
// DATA SET 31
		$this->t7c['ds31'][1] = $this->t7c['ds29'][14];
		$this->t7c['ds31'][2] = $this->t7c['ds31'][1] + $this->t7c['ds33'][1];
		$this->t7c['ds31'][3] = $this->t7c['ds29'][37];
		$this->t7c['ds31'][4] = $this->t7c['ds31'][3] + $this->t5c['ds33'][23];
		$this->t7c['ds31'][5] = $this->t7c['ds29'][60];
		$this->t7c['ds31'][6] = $this->t7c['ds31'][5] + $this->t5c['ds33'][46];
		$this->t7c['ds31'][7] = $this->t7c['ds29'][83];
		$this->t7c['ds31'][8] = $this->t7c['ds31'][7] + $this->t5c['ds33'][69];
		$this->t7c['ds31'][9] = $this->t7c['ds29'][97] * $this->t4c['ds26'][1];
		$this->t7c['ds31'][10] = ($this->t7c['ds29'][97] + $this->t5c['ds33'][70]) * $this->t4c['ds26'][1];
		$this->t7c['ds31'][11] = $this->t7c['ds29'][120] * $this->t4c['ds26'][1];
		$this->t7c['ds31'][12] = ($this->t7c['ds29'][120] + $this->t5c['ds33'][94]) * $this->t4c['ds26'][1];
		$this->t7c['ds31'][13] = $this->t7c['ds29'][143] * $this->t4c['ds26'][1];
		$this->t7c['ds31'][14] = ($this->t7c['ds29'][143] + $this->t5c['ds33'][118]) * $this->t4c['ds26'][1];
		$this->t7c['ds31'][15] = $this->t7c['ds31'][9] + $this->t7c['ds31'][11] + $this->t7c['ds31'][13];
		$this->t7c['ds31'][16] = $this->t7c['ds31'][10] + $this->t7c['ds31'][12] + $this->t7c['ds31'][14];
		$this->t7c['ds31'][17] = $this->t7c['ds29'][180] * $this->t4c['ds26'][1];
		$this->t7c['ds31'][18] = ($this->t7c['ds29'][180] + $this->t5c['ds33'][166]) * $this->t4c['ds26'][1];
		$this->t7c['ds31'][19] = $this->t7c['ds29'][203] * $this->t4c['ds26'][1];
		$this->t7c['ds31'][20] = ($this->t7c['ds29'][203] + $this->t5c['ds33'][190]) * $this->t4c['ds26'][1];
		$this->t7c['ds31'][21] = $this->t7c['ds29'][226] * $this->t4c['ds26'][1];
		$this->t7c['ds31'][22] = ($this->t7c['ds29'][226] + $this->t5c['ds33'][214]) * $this->t4c['ds26'][1];
		$this->t7c['ds31'][23] = $this->t7c['ds31'][17] + $this->t7c['ds31'][19] + $this->t7c['ds31'][21];
		$this->t7c['ds31'][24] = $this->t7c['ds31'][18] + $this->t7c['ds31'][20] + $this->t7c['ds31'][22];
// DATA SET 35
		for ($i = 1; $i <= 22; $i++) {
			if ($i <= 13) {
				$this->t7c['ds35'][$i] = $this->t7c['ds29'][$i];
			} else {
				$this->t7c['ds35'][$i] = $this->d['ds29'][$i-13];
			}
			$this->t7c['ds35'][24]+= $this->t7c['ds35'][$i];
		}
		$this->t7c['ds35'][23] = $this->t7c['ds33'][1];
		$this->t7c['ds35'][24]+= $this->t7c['ds35'][23];
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds35'][$i+47] = $this->t7c['ds29'][$i+37] + $this->t5c['ds33'][$i+23];
			$this->t7c['ds35'][70]+= $this->t7c['ds35'][$i+47];
		}
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds35'][$i+70] = $this->t7c['ds35'][$i] + $this->t7c['ds35'][$i+24] + $this->t7c['ds35'][$i+47];
			$this->t7c['ds35'][94]+= $this->t7c['ds35'][$i+70];
		}
		$this->t7c['ds35'][93] = $this->t7c['ds35'][23];
		$this->t7c['ds35'][94]+= $this->t7c['ds35'][93];
		for ($i = 1; $i <= 22; $i++) {
			if ($i <= 13) {
				$this->t7c['ds35'][$i+94] = $this->t7c['ds29'][$i+83];
			} else {
				$this->t7c['ds35'][$i+94] = $this->d['ds29'][$i-4];
			}
			$this->t7c['ds35'][118]+= $this->t7c['ds35'][$i+94];
		}
		$this->t7c['ds35'][117] = $this->t5c['ds33'][70];
		$this->t7c['ds35'][118]+= $this->t7c['ds35'][117];
		$this->t7c['ds35'][119] = $this->t7c['ds35'][118] * $this->t4c['ds26'][1];
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds35'][$i+119] = $this->t7c['ds29'][$i+97] + $this->t5c['ds33'][$i+71];
			$this->t7c['ds35'][142]+= $this->t7c['ds35'][$i+119];
		}
		$this->t7c['ds35'][143] = $this->t7c['ds35'][142] * $this->t4c['ds26'][1];
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds35'][$i+143] = $this->t7c['ds29'][$i+120] + $this->t5c['ds33'][$i+95];
			$this->t7c['ds35'][166]+= $this->t7c['ds35'][$i+143];
		}
		$this->t7c['ds35'][167] = $this->t7c['ds35'][166] * $this->t4c['ds26'][1];
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds35'][$i+167] = $this->t7c['ds35'][$i+94] + $this->t7c['ds35'][$i+119] + $this->t7c['ds35'][$i+143];
			$this->t7c['ds35'][191]+= $this->t7c['ds35'][$i+167];
		}
		$this->t7c['ds35'][190] = $this->t7c['ds35'][117];
		$this->t7c['ds35'][191]+= $this->t7c['ds35'][190];
		$this->t7c['ds35'][192] = $this->t7c['ds35'][191] * $this->t4c['ds26'][1];
		for ($i = 1; $i <= 22; $i++) {
			if ($i <= 13) {
				$this->t7c['ds35'][$i+192] = $this->t7c['ds29'][$i+166] + $this->t5c['ds33'][$i+143];
			} else {
				$this->t7c['ds35'][$i+192] = $this->d['ds29'][$i+5] + $this->t5c['ds33'][$i+143];
			}
			$this->t7c['ds35'][215]+= $this->t7c['ds35'][$i+192];
		}
		$this->t7c['ds35'][216] = $this->t7c['ds35'][215] * $this->t4c['ds26'][1];
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds35'][$i+216] = $this->t7c['ds29'][$i+180] + $this->t5c['ds33'][$i+167];
			$this->t7c['ds35'][239]+= $this->t7c['ds35'][$i+216];
		}
		$this->t7c['ds35'][240] = $this->t7c['ds35'][239] * $this->t4c['ds26'][1];
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds35'][$i+240] = $this->t7c['ds29'][$i+203] + $this->t5c['ds33'][$i+191];
			$this->t7c['ds35'][263]+= $this->t7c['ds35'][$i+240];
		}
		$this->t7c['ds35'][264] = $this->t7c['ds35'][263] * $this->t4c['ds26'][1];
		for ($i = 1; $i <= 22; $i++) {
			$this->t7c['ds35'][$i+264] = $this->t7c['ds35'][$i+192] + $this->t7c['ds35'][$i+216] + $this->t7c['ds35'][$i+240];
			$this->t7c['ds35'][288]+= $this->t7c['ds35'][$i+264];
		}
		$this->t7c['ds35'][287] = 0;
		$this->t7c['ds35'][288]+= $this->t7c['ds35'][287];
		$this->t7c['ds35'][289] = $this->t7c['ds35'][288] * $this->t4c['ds26'][1];
		ksort($this->t7c['ds35']);
// DATA SET 41
		// start out of order
		$this->t7c['ds41'][2] = $this->t7c['ds25'][4];
		$this->t7c['ds41'][3] = $this->t7c['ds25'][1];
		// end out of order
		$this->t7c['ds41'][1] = $this->t7c['ds41'][2] + $this->t7c['ds41'][3];
		$this->t7c['ds41'][4] = $this->t7c['ds25'][2] + $this->t7c['ds25'][3] + $this->t6c['ds26'][118];
		$this->t7c['ds41'][5] = $this->t7c['ds25'][3] + $this->t7c['ds25'][7];
		$this->t7c['ds41'][6] = $this->t7c['ds25'][2] + $this->t6c['ds26'][118] - $this->t7c['ds25'][7];
		$this->t7c['ds41'][7] = $this->t6c['ds26'][141];
		$this->t7c['ds41'][8] = $this->t7c['ds41'][1] + $this->t7c['ds41'][4] + $this->t7c['ds41'][7];
		$this->t7c['ds41'][9] = $this->t7c['ds33'][1];
		$this->t7c['ds41'][10] = ($this->t7c['ds35'][24] - $this->t7c['ds41'][9]) + $this->t7c['ds35'][47];
		$this->t7c['ds41'][11] = $this->t7c['ds35'][70];
		$this->t7c['ds41'][12] = $this->t7c['ds41'][9] + $this->t7c['ds41'][10] + $this->t7c['ds41'][11];
		
		// start out of order
		$this->t7c['ds41'][14] = $this->t7c['ds25'][12] * $this->t4c['ds26'][1] * 1000;
		$this->t7c['ds41'][15] = $this->t7c['ds25'][9] * 1000;
		// end out of order
		$this->t7c['ds41'][13] = $this->t7c['ds41'][14] + $this->t7c['ds41'][15];
		$this->t7c['ds41'][16] = ($this->t7c['ds25'][10] + $this->t7c['ds25'][11] + $this->t6c['ds26'][212]) * 1000;
		$this->t7c['ds41'][17] = ($this->t7c['ds25'][11] + $this->t7c['ds25'][15]) * 1000;
		$this->t7c['ds41'][18] = ($this->t7c['ds25'][10] + $this->t6c['ds26'][212] - $this->t7c['ds25'][15]) * 1000;
		$this->t7c['ds41'][19] = $this->t6c['ds26'][236] * 1000;
		$this->t7c['ds41'][20] = $this->t7c['ds41'][13] + $this->t7c['ds41'][16] + $this->t7c['ds41'][19];
		$this->t7c['ds41'][21] = $this->t5c['ds33'][71] * 1000;
		$this->t7c['ds41'][22] = (($this->t7c['ds35'][119] + $this->t7c['ds35'][143]) * 1000) - $this->t7c['ds41'][21];
		$this->t7c['ds41'][23] = $this->t7c['ds35'][167] * 1000;
		$this->t7c['ds41'][24] = $this->t7c['ds41'][21] + $this->t7c['ds41'][22] + $this->t7c['ds41'][23];
		
		// start out of order
		$this->t7c['ds41'][26] = $this->t7c['ds25'][19] * $this->t4c['ds26'][1] * 1000;
		$this->t7c['ds41'][27] = $this->t7c['ds25'][16] * 1000;
		// end out of order
		$this->t7c['ds41'][25] = $this->t7c['ds41'][26] + $this->t7c['ds41'][27];
		$this->t7c['ds41'][28] = ($this->t7c['ds25'][17] + $this->t7c['ds25'][18] + $this->t6c['ds26'][308]) * 1000;
		$this->t7c['ds41'][29] = ($this->t7c['ds25'][18] + $this->t7c['ds25'][21]) * 1000;
		$this->t7c['ds41'][30] = ($this->t7c['ds25'][17] + $this->t6c['ds26'][308] - $this->t7c['ds25'][21]) * 1000;
		$this->t7c['ds41'][31] = $this->t6c['ds26'][332] * 1000;
		$this->t7c['ds41'][32] = $this->t7c['ds41'][25] + $this->t7c['ds41'][28] + $this->t7c['ds41'][31];
		$this->t7c['ds41'][33] = $this->t5c['ds33'][167] * 1000;
		$this->t7c['ds41'][34] = (($this->t7c['ds35'][216] + $this->t7c['ds35'][240]) * 1000) - $this->t7c['ds41'][33];
		$this->t7c['ds41'][35] = $this->t7c['ds35'][264] * 1000;
		$this->t7c['ds41'][36] = $this->t7c['ds41'][33] + $this->t7c['ds41'][34] + $this->t7c['ds41'][35];
		ksort($this->t7c['ds41']);
		$this->sr1();
	}
	function sr1() {
// SUMMARY RESULTS 1
		if ($this->d['ds1'][1] == "My County") {
			$this->sr1c['sr1'][1] = $this->d['ds4'][1];
		} else {
			if ($this->d['ds1'][1] == "My Region") {
				$this->sr1c['sr1'][1] = $this->d['ds4'][2];
			} else {
				$this->sr1c['sr1'][1] = $this->d['ds1'][1];
			}
		}
		$this->sr1c['sr1'][2] = $this->d['ds1'][3];
		$this->sr1c['sr1'][3] = $this->t1c['ds1'][1];
		$this->sr1c['sr1'][4] = $this->t2c['ds1'][1];
		$this->sr1c['sr1'][5] = $this->t2c['ds1'][2];
		$this->sr1c['sr1'][6] = $this->d['ds1'][4];
		$this->sr1c['sr1'][7] = $this->d['ds1'][5];
		$this->sr1c['sr1'][8] = $this->d['ds1'][6];
		$this->sr1c['sr1'][11] = $this->d['ds1'][8];
		$this->sr1c['sr1'][12] = $this->t5c['ds23'][15];
		$this->sr1c['sr1'][9] = $this->sr1c['sr1'][12] / $this->sr1c['sr1'][5];
		$this->sr1c['sr1'][13] = $this->t6c['ds26'][46];
		$this->sr1c['sr1'][15] = $this->t5c['ds27'][8];
		$this->sr1c['sr1'][10] = $this->sr1c['sr1'][15] / $this->sr1c['sr1'][5];
		$this->sr1c['sr1'][16] = $this->t5c['ds27'][17];
		$this->sr1c['sr1'][17] = $this->t6c['ds27'][3];
		$this->sr1c['sr1'][14] = $this->sr1c['sr1'][15] + $this->sr1c['sr1'][17];
		$this->sr1c['sr1'][18] = $this->t6c['ds27'][7];
		$this->sr1c['sr1'][19] = $this->t6c['ds27'][4];
		$this->sr1c['sr1'][20] = $this->t5c['ds27'][16];
		ksort($this->sr1c['sr1']);
// SUMMARY RESULTS 2
		for($i = 1; $i <= 25; $i++) {
			$this->sr1c['sr2'][$i] = $this->t7c['ds41'][$i];
		}
		for($i = 26; $i <= 34; $i++) {
			$this->sr1c['sr2'][$i] = $this->t7c['ds41'][$i+2];
		}
// SUMMARY RESULTS 3
		$this->sr1c['sr3'][1] = $this->t1c['ds38'][1];
		for($i = 1; $i <= 15; $i++) {
			$this->sr1c['sr3'][$i+1] = $this->t5c['ds38'][$i];
		}
		for($i = 1; $i <= 8; $i++) {
			$this->sr1c['sr3'][$i+16] = $this->t3c['ds38'][$i];
		}
		for($i = 1; $i <= 5; $i++) {
			$this->sr1c['sr3'][$i+24] = $this->t1c['ds38'][$i+1];
		}
// SUMMARY RESULTS 4
		for($i = 1; $i <= 6; $i++) {
			$this->sr1c['sr4'][$i] = $this->t5c['ds39'][$i];
		}
		$this->sr1c['sr4'][7] = $this->t6c['ds39'][1];
		$this->sr1c['sr4'][8] = $this->t5c['ds39'][7];
		$this->sr1c['sr4'][9] = $this->t6c['ds39'][2];
		for($i = 1; $i <= 6; $i++) {
			$this->sr1c['sr4'][$i+9] = $this->t4c['ds39'][$i];
		}
		$this->sr1c['sr4'][16] = $this->t1c['ds39'][1];
// SUMMARY RESULTS 5
		for($i = 1; $i <= 6; $i++) {
			$this->sr1c['sr5'][$i] = $this->t1c['ds40'][$i];
		}
		$this->sr1c['sr5'][7] = $this->t5c['ds40'][1];
		$this->sr1c['sr5'][8] = $this->t4c['ds40'][1];
		$this->sr1c['sr5'][9] = $this->t5c['ds40'][2];
		$this->sr1c['sr5'][10] = $this->t4c['ds40'][2];
		$this->sr1c['sr5'][11] = $this->t4c['ds40'][3];
		$this->sr1c['sr5'][12] = $this->t1c['ds40'][7];
		$this->sr1c['sr5'][13] = $this->t1c['ds40'][8];
		$this->sr1c['sr5'][14] = $this->t1c['ds40'][9];	
// SUMMARY RESULTS 5
		for($i = 1; $i <= 6; $i++) {
			$this->sr1c['sr5'][$i] = $this->t1c['ds40'][$i];
		}
		$this->sr1c['sr5'][7] = $this->t5c['ds40'][1];
		$this->sr1c['sr5'][8] = $this->t4c['ds40'][1];
		$this->sr1c['sr5'][9] = $this->t5c['ds40'][2];
		$this->sr1c['sr5'][10] = $this->t4c['ds40'][2];
		$this->sr1c['sr5'][11] = $this->t4c['ds40'][3];
		$this->sr1c['sr5'][12] = $this->d['ds24'][1];
		$this->sr1c['sr5'][13] = $this->d['ds24'][2];
		$this->sr1c['sr5'][14] = $this->t1c['ds40'][7];
		$this->sr1c['sr5'][15] = $this->t1c['ds40'][8];
		$this->sr1c['sr5'][16] = $this->t1c['ds40'][9];
		$this->sr1c['sr5'][17] = $this->t1c['ds24'][1];
		$this->sr1c['sr5'][18] = $this->t1c['ds24'][2];
	}
	
	/******************************************************************************************************
	BEGIN FINANCIAL FUNCTIONS
	These function mimic the functions found in MS Excel for financial calculations
	******************************************************************************************************/
	
	/**
	* DATEADD
	* Returns a new Unix timestamp value based on adding an interval to the specified date.
	* @param  string  $datepart is the parameter that specifies on which part of the date to return a new value.
	* @param  integer $number   is the value used to increment datepart. If you specify a value that is not an integer, the fractional part of the value is discarded.
	* @param  integer $date     a Unix timestamp value.     
	* @return integer a Unix timestamp.
	*/
	function DATEADD($datepart, $number, $date)
	{
		$number = intval($number);
		switch (strtolower($datepart)) {
			case 'yy':
			case 'yyyy':
			case 'year':
				$d = getdate($date);
				$d['year'] += $number;
				if (($d['mday'] == 29) && ($d['mon'] == 2) && (date('L', mktime(0, 0, 0, 1, 1, $d['year'])) == 0)) $d['mday'] = 28;
				return mktime($d['hours'], $d['minutes'], $d['seconds'], $d['mon'], $d['mday'], $d['year']);
				break;
			case 'm':
			case 'mm':
			case 'month':
				$d = getdate($date);
				$d['mon'] += $number;
				while($d['mon'] > 12) {
					$d['mon'] -= 12;
					$d['year']++;
				}
				while($d['mon'] < 1) {
					$d['mon'] += 12;
					$d['year']--;
				}
				$l = date('t', mktime(0,0,0,$d['mon'],1,$d['year']));
				if ($d['mday'] > $l) $d['mday'] = $l;
				return mktime($d['hours'], $d['minutes'], $d['seconds'], $d['mon'], $d['mday'], $d['year']);
				break;
			case 'd':
			case 'dd':
			case 'day':
				return ($date + $number * 86400); 
				break;
			default:
				die("Unsupported operation");
		}
	}
	
	/**
	* DATEDIFF
	* Returns the number of date and time boundaries crossed between two specified dates.
	* @param  string  $datepart  is the parameter that specifies on which part of the date to calculate the difference.
	* @param  integer $startdate is the beginning date (Unix timestamp) for the calculation.
	* @param  integer $enddate   is the ending date (Unix timestamp) for the calculation.     
	* @return integer the number between the two dates.
	*/
	function DATEDIFF($datepart, $startdate, $enddate)
	{
		switch (strtolower($datepart)) {
			case 'yy':
			case 'yyyy':
			case 'year':
				$di = getdate($startdate);
				$df = getdate($enddate);
				return $df['year'] - $di['year'];
				break;
			case 'q':
			case 'qq':
			case 'quarter':
				die("Unsupported operation");
				break;
			case 'n':
			case 'mi':
			case 'minute':
				return ceil(($enddate - $startdate) / 60); 
				break;
			case 'hh':
			case 'hour':
				return ceil(($enddate - $startdate) / 3600); 
				break;
			case 'd':
			case 'dd':
			case 'day':
				return ceil(($enddate - $startdate) / 86400); 
				break;
			case 'wk':
			case 'ww':
			case 'week':
				return ceil(($enddate - $startdate) / 604800); 
				break;
			case 'm':
			case 'mm':
			case 'month':
				$di = getdate($startdate);
				$df = getdate($enddate);
				return ($df['year'] - $di['year']) * 12 + ($df['mon'] - $di['mon']);
				break;
			default:
				die("Unsupported operation");
		}
	}
	
	/**
	* Determine if the basis is valid
	* @param  integer $basis
	* @return bool
	*/
	function _is_valid_basis($basis)
	{
		return (($basis >= FINANCIAL_BASIS_MSRB_30_360) && ($basis <= FINANCIAL_BASIS_30Ep_360));
	}
	
	/**
	* Determine if the frequency is valid
	* @param  integer $frequency
	* @return bool
	*/
	function _is_valid_frequency($frequency)
	{
		return (($frequency == 1) || ($frequency == 2) || ($frequency == 4));
	}
	
	/**
	* DAYS360
	* Returns the number of days between two dates based on a 360-day year
	* (twelve 30-day months), which is used in some accounting calculations.
	* Use this function to help compute payments if your accounting system
	* is based on twelve 30-day months.
	* @param  integer $start_date is the beginning date (Unix timestamp) for the calculation.
	* @param  integer $end_date   is the ending date (Unix timestamp) for the calculation.
	* @param  bool    $method     is a logical value that specifies whether to use the U.S. or European method in the calculation.
	* @return integer the number of days between two dates based on a 360-day year
	*/
	function DAYS360($start_date, $end_date, $method = false)
	{
		if ($method) {
			return $this->Thirty360USdayCount($start_date, $end_date);
		} else {
			return $this->Thirty360EUdayCount($start_date, $end_date);
		}
	}
	
	/**
	* Thirty360USdayCount
	* Returns the number of days between two dates based on a 360-day year
	* (twelve 30-day months) using the US method.
	* @param  integer $startdate is the beginning date (Unix timestamp) for the calculation.
	* @param  integer $enddate   is the ending date (Unix timestamp) for the calculation.
	* @return integer the number of days between two dates
	*/
	function Thirty360USdayCount($startdate, $enddate)
	{
		$d1 = getdate($startdate);
		$d2 = getdate($enddate);
		$dd1 = $d1['mday']; $mm1 = $d1['mon']; $yy1 = $d1['year'];
		$dd2 = $d2['mday']; $mm2 = $d2['mon']; $yy2 = $d2['year'];
		
		if ($dd2 == 31 && $dd1 < 30) { $dd2 = 1; $mm2++; }
		
		return 360 * ($yy2 - $yy1) + 30 * ($mm2 - $mm1 - 1) + max(0, 30 - $dd1) + min(30, $dd2);
	}
	
	/**
	* Thirty360USyearFraction
	* Returns the period between two dates as a fraction of year.
	* @param  integer $startdate is the beginning date (Unix timestamp) for the calculation.
	* @param  integer $enddate   is the ending date (Unix timestamp) for the calculation.
	* @return float   the fraction of years between two dates
	*/
	function Thirty360USyearFraction($startdate, $enddate)
	{
		return $this->Thirty360USdayCount($startdate, $enddate) / 360.0;
	}
	
	/**
	* Thirty360EUdayCount
	* Returns the number of days between two dates based on a 360-day year
	* (twelve 30-day months) using the EUROPEAN method.
	* @param  integer $startdate is the beginning date (Unix timestamp) for the calculation.
	* @param  integer $enddate   is the ending date (Unix timestamp) for the calculation.
	* @return integer the number of days between two dates
	*/
	function Thirty360EUdayCount($startdate, $enddate)
	{
		$d1 = getdate($startdate);
		$d2 = getdate($enddate);
		$dd1 = $d1['mday']; $mm1 = $d1['mon']; $yy1 = $d1['year'];
		$dd2 = $d2['mday']; $mm2 = $d2['mon']; $yy2 = $d2['year'];
		
		return 360 * ($yy2 - $yy1) + 30 * ($mm2 - $mm1 - 1) + max(0, 30 - $dd1) + min(30, $dd2);
	}
	
	/**
	* Thirty360EUyearFraction
	* Returns the period between two dates as a fraction of year.
	* @param  integer $startdate is the beginning date (Unix timestamp) for the calculation.
	* @param  integer $enddate   is the ending date (Unix timestamp) for the calculation.
	* @return float   the fraction of years between two dates
	*/
	function Thirty360EUyearFraction($startdate, $enddate)
	{
		return $this->Thirty360EUdayCount($startdate, $enddate) / 360.0;
	}
	
	/**
	* ActualActualdayCount
	* Returns the number of days between two dates.
	* @param  integer $startdate is the beginning date (Unix timestamp) for the calculation.
	* @param  integer $enddate   is the ending date (Unix timestamp) for the calculation.
	* @return integer the number of days between two dates
	*/
	function ActualActualdayCount($startdate, $enddate)
	{
		return $this->DATEDIFF('day', $startdate, $enddate);
	}
	
	/**
	* ActualActualyearFraction
	* Returns the period between two dates as a fraction of year.
	* @param  integer $startdate is the beginning date (Unix timestamp) for the calculation.
	* @param  integer $enddate   is the ending date (Unix timestamp) for the calculation.
	* @param  date    $refPeriodStart is the reference beginning date (Unix timestamp) for the inner calculation.
	* @param  date    $refPeriodEnd   is the reference ending date (Unix timestamp) for the inner calculation.
	* @return float   the fraction of years between two dates
	*/
	function ActualActualyearFraction($startdate, $enddate, $refPeriodStart = null, $refPeriodEnd = null)
	{
		$t = time();
		if (!isset($refPeriodStart)) $refPeriodStart = $startdate;
		if (!isset($refPeriodEnd)) $refPeriodEnd = $enddate;
		
		/*
		if ($this->DATEDIFF('day', $startdate, $enddate) == 0) return 0.0;
		$d1 = getdate($startdate);
		$d2 = getdate($enddate);
		$dib1 = ((date('L', $startdate) == 1) ? 366.0 : 365.0);
		$dib2 = ((date('L', $enddate) == 1) ? 366.0 : 365.0);
		
		$sum = $d2['year'] - $d1['year'] - 1;
		$sum += $this->ActualActualdayCount($startdate, mktime(0,0,0,1,1,$d1['year'] + 1)) / $dib1;
		$sum += $this->ActualActualdayCount(mktime(0,0,0,1,1,$d2['year']), $enddate) / $dib2;
		return $sum;
		*/
		
		if ($this->DATEDIFF('day', $startdate, $enddate) == 0) return 0.0;
		
		if ($startdate > $enddate) die("Invalid dates");
		if (!($refPeriodStart != $t) && ($refPeriodEnd != $t) &&
			($refPeriodEnd > $refPeriodStart) && ($refPeriodEnd > $startdate)) die("Invalid reference period");
				
		$months = intval(0.5 + 12 * $this->DATEDIFF('day', $refPeriodStart, $refPeriodEnd) / 365);
		$period = $months / 12.0;
		if($months == 0) die("number of months does not divide 12 exactly");
		if ($enddate <= $refPeriodEnd) {
			// here refPeriodEnd is a future (notional?) payment date
			if ($startdate >= $refPeriodStart) {
				// here refPeriodStart is the last (maybe notional)
				// payment date.
				// refPeriodStart <= startdate <= enddate <= refPeriodEnd
				// [maybe the equality should be enforced, since
				// refPeriodStart < startdate <= enddate < refPeriodEnd
				// could give wrong results] ???
				return $period * $this->ActualActualdayCount($startdate, $enddate) /
					$this->ActualActualdayCount($refPeriodStart, $refPeriodEnd);
			} else {
				// here refPeriodStart is the next (maybe notional)
				// payment date and refPeriodEnd is the second next
				// (maybe notional) payment date.
				// startdate < refPeriodStart < refPeriodEnd
				// AND enddate <= refPeriodEnd
				// this case is long first coupon
				// the last notional payment date
				$previousRef = $this->DATEADD('month', -$months, $refPeriodStart);
				if ($enddate > $refPeriodStart)
					return $this->ActualActualyearFraction($startdate, $refPeriodStart, $previousRef,
								$refPeriodStart) +
							$this->ActualActualyearFraction($refPeriodStart, $enddate, $refPeriodStart,
								$refPeriodEnd);
				else
					return $this->ActualActualyearFraction($startdate,$enddate,$previousRef,$refPeriodStart);
			}
		} else {
			// here refPeriodEnd is the last (notional?) payment date
			// startdate < refPeriodEnd < enddate AND refPeriodStart < refPeriodEnd
			if ($refPeriodStart > $startdate) die("Invalid dates");
			
			// now it is: refPeriodStart <= startdate < refPeriodEnd < enddate
			
			// the part from startdate to refPeriodEnd
			$sum = $this->ActualActualyearFraction($startdate, $refPeriodEnd, $refPeriodStart, $refPeriodEnd);
			
			// the part from refPeriodEnd to enddate
			// count how many regular periods are in [refPeriodEnd, enddate],
			// then add the remaining time
			$i = 0;
			do {
				$newRefStart = $this->DATEADD('month', $months * $i, $refPeriodEnd);
				$newRefEnd   = $this->DATEADD('month', $months * ($i + 1), $refPeriodEnd);
				if ($enddate < $newRefEnd) {
					break;
				} else {
					$sum += $period;
					$i++;
				}
			} while (true);
			$sum += $this->ActualActualyearFraction($newRefStart, $newRefEnd, $newRefStart, $newRefEnd);
			return $sum;
		}
	}
	
	/**
	* Actual360dayCount
	* Returns the number of days between two dates.
	* @param  integer $startdate is the beginning date (Unix timestamp) for the calculation.
	* @param  integer $enddate   is the ending date (Unix timestamp) for the calculation.
	* @return integer the number of days between two dates
	*/
	function Actual360dayCount($startdate, $enddate)
	{
		return $this->DATEDIFF('day', $startdate, $enddate);
	}
	
	/**
	* Actual360yearFraction
	* Returns the period between two dates as a fraction of 360 days year.
	* @param  integer $startdate is the beginning date (Unix timestamp) for the calculation.
	* @param  integer $enddate   is the ending date (Unix timestamp) for the calculation.
	* @return float   the fraction of years between two dates
	*/
	function Actual360yearFraction($startdate, $enddate)
	{
		return $this->Actual360dayCount($startdate, $enddate) / 360.0;
	}
	
	/**
	* Actual365dayCount
	* Returns the number of days between two dates.
	* @param  integer $startdate is the beginning date (Unix timestamp) for the calculation.
	* @param  integer $enddate   is the ending date (Unix timestamp) for the calculation.
	* @return integer the number of days between two dates
	*/
	function Actual365dayCount($startdate, $enddate)
	{
		return $this->DATEDIFF('day', $startdate, $enddate);
	}
	
	/**
	* Actual365yearFraction
	* Returns the period between two dates as a fraction of 365 days year.
	* @param  integer $startdate is the beginning date (Unix timestamp) for the calculation.
	* @param  integer $enddate   is the ending date (Unix timestamp) for the calculation.
	* @return float   the fraction of years between two dates
	*/
	function Actual365yearFraction($startdate, $enddate)
	{
		return $this->Actual365dayCount($startdate, $enddate) / 365.0;
	}
	
	/**
	* DOLLARDE
	* Converts a dollar price expressed as a fraction into a dollar
	* price expressed as a decimal number. Use DOLLARDE to convert
	* fractional dollar numbers, such as securities prices, to decimal
	* numbers.
	* @param  float   $fractional_dollar is a number expressed as a fraction.
	* @param  integer $fraction          is the integer to use in the denominator of the fraction.
	* @return float   dollar price expressed as a decimal number.
	*/
	function DOLLARDE($fractional_dollar, $fraction)
	{
		$fraction = intval($fraction);
		$integer = intval($fractional_dollar);
		return $integer + 100 * ($fractional_dollar - $integer) / $fraction;
	}
	
	/**
	* DOLLARFR
	* Converts a dollar price expressed as a decimal number into a
	* dollar price expressed as a fraction. Use DOLLARFR to convert
	* decimal numbers to fractional dollar numbers, such as securities
	* prices.
	* @param  float   $decimal_dollar is a decimal number.
	* @param  integer $fraction       is the integer to use in the denominator of the fraction.
	* @return float   dollar price expressed as a fraction.
	*/
	function DOLLARFR($decimal_dollar, $fraction)
	{
		$fraction = intval($fraction);
		$integer = intval($decimal_dollar);
		return ($decimal_dollar - $integer) * $fraction / 100 + $integer;
	}
	
	/**
	* DDB
	* Returns the depreciation of an asset for a specified period using
	* the double-declining balance method or some other method you specify.
	* @param  float   $cost    is the initial cost of the asset.
	* @param  float   $salvage is the value at the end of the depreciation (sometimes called the salvage value of the asset).
	* @param  integer $life    is the number of periods over which the asset is being depreciated (sometimes called the useful life of the asset).
	* @param  integer $period  is the period for which you want to calculate the depreciation. Period must use the same units as life.
	* @param  float   $factor  is the rate at which the balance declines. If factor is omitted, it is assumed to be 2 (the double-declining balance method).
	* @return float   the depreciation of n periods.
	*/
	function DDB($cost, $salvage, $life, $period, $factor = 2)
	{
		$x = 0;
		$n = 0;
		$life   = intval($life);
		$period = intval($period);
		while ($period > $n) {
			$x = $factor * $cost / $life;
			if (($cost - $x) < $salvage) $x = $cost- $salvage;
			if ($x < 0) $x = 0;
			$cost -= $x;
			$n++;
		}
		return $x;
	}
	
	/**
	* SLN
	* Returns the straight-line depreciation of an asset for one period.
	* @param  float   $cost    is the initial cost of the asset.
	* @param  float   $salvage is the value at the end of the depreciation (sometimes called the salvage value of the asset).
	* @param  integer $life    is the number of periods over which the asset is being depreciated (sometimes called the useful life of the asset).
	* @return float   the depreciation allowance for each period.
	*/
	function SLN($cost, $salvage, $life)
	{
		$sln = ($cost - $salvage) / $life;
		return (is_finite($sln) ? $sln: null);
	}
	
	/**
	* SYD
	* Returns the sum-of-years' digits depreciation of an asset for
	* a specified period.
	* 
	*        (cost - salvage) * (life - per + 1) * 2
	* SYD = -----------------------------------------
	*                  life * (1 + life)
	*
	* @param  float   $cost    is the initial cost of the asset.
	* @param  float   $salvage is the value at the end of the depreciation (sometimes called the salvage value of the asset).
	* @param  integer $life    is the number of periods over which the asset is depreciated (sometimes called the useful life of the asset).
	* @param  integer $per     is the period and must use the same units as life.  
	*/
	function SYD($cost, $salvage, $life, $per)
	{
		$life = intval($life);
		$per  = intval($per);
		$syd  = (($cost - $salvage) * ($life - $per + 1) * 2) / ($life * (1 + $life));
		return (is_finite($syd) ? $syd: null);
	}
	
	/**
	* @param float $fWert
	* @param float $fRest
	* @param float $fDauer
	* @param float $fPeriode
	* @param float $fFaktor
	* @return float
	*/
	function _ScGetGDA($fWert, $fRest, $fDauer,$fPeriode, $fFaktor)
	{
		$fZins = $fFaktor / $fDauer;
		if ($fZins >= 1.0) {
			$fZins = 1.0;
			if ($fPeriode == 1.0)
				$fAlterWert = $fWert;
			else
				$fAlterWert = 0.0;
		} else
			$fAlterWert = $fWert * pow(1.0 - $fZins, $fPeriode - 1.0);
		
		$fNeuerWert = $fWert * pow(1.0 - $fZins, $fPeriode);
		
		if ($fNeuerWert < $fRest)
			$fGda = $fAlterWert - $fRest;
		else
			$fGda = $fAlterWert - $fNeuerWert;
		
		if ($fGda < 0.0) $fGda = 0.0;
		
		return $fGda;
	}
	
	/**
	* @param  float $cost
	* @param  float $salvage
	* @param  float $life
	* @param  float $life1
	* @param  float $period
	* @param  float $factor
	* @return float
	*/
	function _ScInterVDB($cost, $salvage, $life, $life1, $period, $factor)
	{
		$fVdb       = 0;
		$fIntEnd    = ceil($period);
		$nLoopEnd   = $fIntEnd;
		$fRestwert  = $cost - $salvage;
		$bNowLia    = false;
		
		$fLia = 0;
		for ($i = 1; $i <= $nLoopEnd; $i++) {
			if (!$bNowLia) {
				$fGda = $this->_ScGetGDA($cost, $salvage, $life, $i, $factor);
				$fLia = $fRestwert / ($life1 - (float)($i - 1));
				
				if ($fLia > $fGda) {
					$fTerm   = $fLia;
					$bNowLia = true;
				} else {
					$fTerm      = $fGda;
					$fRestwert -= $fGda;
				}
			} else
				$fTerm = fLia;
				
			if ($i == $nLoopEnd)
				$fTerm *= ($period + 1.0 - $fIntEnd);
			$fVdb += $fTerm;
		}
		return $fVdb;
	}

	/**
	* VDB
	* Returns the depreciation of an asset for any period you specify,
	* including partial periods, using the double-declining balance method
	* or some other method you specify. VDB stands for variable declining balance.
	* 
	* @param  float   $cost         is the initial cost of the asset.
	* @param  float   $salvage      is the value at the end of the depreciation (sometimes called the salvage value of the asset).
	* @param  integer $life         is the number of periods over which the asset is depreciated (sometimes called the useful life of the asset).
	* @param  integer $start_period is the starting period for which you want to calculate the depreciation. Start_period must use the same units as life.
	* @param  integer $end_period   is the ending period for which you want to calculate the depreciation. End_period must use the same units as life.
	* @param  float   $factor       is the rate at which the balance declines. If factor is omitted, it is assumed to be 2 (the double-declining balance method). Change factor if you do not want to use the double-declining balance method.
	* @param  bool    $no_switch    is a logical value specifying whether to switch to straight-line depreciation when depreciation is greater than the declining balance calculation.
	* @return float   the depreciation of an asset.
	*/
	function VDB($cost, $salvage, $life, $start_period, $end_period, $factor = 2.0, $no_switch = false)
	{
		// pre-validations
		if (($start_period < 0)
			|| ($end_period < $start_period)
			|| ($end_period > $life)
			|| ($cost < 0) || ($salvage > $cost)
			|| ($factor <= 0))
			return null;
		
		// this implementation is borrowed from OppenOffice 1.0,
		// 'sc/source/core/tool/interpr2.cxx' with a small changes
		// from me.
		$fVdb = 0.0;
		$fIntStart = floor($start_period);
		$fIntEnd = ceil($end_period);
		
		if ($no_switch) {
			$nLoopStart = (int) $fIntStart;
			$nLoopEnd = (int) $fIntEnd;
			
			for ($i = $nLoopStart + 1; $i <= $nLoopEnd; $i++) {
				$fTerm = $this->_ScGetGDA($cost, $salvage, $life, $i, $factor);
				if ($i == $nLoopStart + 1)
					$fTerm *= (min($end_period, $fIntStart + 1.0) - $start_period);
				elseif ($i == $nLoopEnd)
					$fTerm *= ($end_period + 1.0 - $fIntEnd);
				$fVdb += $fTerm;
			}
		} else {
			$life1 = $life;
			
			if ($start_period != $fIntStart)
				if ($factor > 1) {
					if ($start_period >= ($life / 2)) {
						$fPart        = $start_period - ($life / 2);
						$start_period = $life / 2;
						$end_period  -= $fPart;
						$life1       += 1;
					}
				}
			
			$cost -= $this->_ScInterVDB($cost, $salvage, $life, $life1, $start_period, $factor);
			$fVdb = $this->_ScInterVDB($cost, $salvage, $life, $life - $start_period, $end_period - $start_period, $factor);
		}
		
		return $fVdb;
	}
	
	/**
	* Present value interest factor
	*
	*                 nper
	* PVIF = (1 + rate)
	*
	* @param  float   $rate is the interest rate per period.
	* @param  integer $nper is the total number of periods.
	* @return float  the present value interest factor
	*/
	function _calculate_pvif ($rate, $nper)
	{
		return (pow(1 + $rate, $nper));
	}
	
	/**
	* Future value interest factor of annuities
	*
	*                   nper
	*          (1 + rate)    - 1
	* FVIFA = -------------------
	*               rate
	*
	* @param  float   $rate is the interest rate per period.
	* @param  integer $nper is the total number of periods.
	* @return float  the present value interest factor of annuities
	*/
	function _calculate_fvifa ($rate, $nper)
	{
		// Removable singularity at rate == 0
		if ($rate == 0)
			return $nper;
		else
			// FIXME: this sucks for very small rates
			return (pow(1 + $rate, $nper) - 1) / $rate;
	}
	
	function _calculate_interest_part ($pv, $pmt, $rate, $per)
	{
		return -($pv * pow(1 + $rate, $per) * $rate +
			$pmt * (pow(1 + $rate, $per) - 1));
	}
	
	function _calculate_pmt ($rate, $nper, $pv, $fv, $type)
	{
		// Calculate the PVIF and FVIFA
		$pvif = $this->_calculate_pvif ($rate, $nper);
		$fvifa = $this->_calculate_fvifa ($rate, $nper);
		
		return ((-$pv * $pvif - $fv ) / ((1.0 + $rate * $type) * $fvifa));
	}
	
	/**
	* PV
	* Returns the present value of an investment. The present value is
	* the total amount that a series of future payments is worth now.
	* For example, when you borrow money, the loan amount is the present
	* value to the lender.
	*  
	* If rate = 0:
	* PV = -(FV + PMT * nper)
	* 
	* Else
	*                                 /              nper \
	*                                 | 1 - (1 + rate)    |
	*       PMT * (1 + rate * type) * | ----------------- | - FV
	*                                 \        rate       /
	* PV = ------------------------------------------------------
	*                                nper
	*                       (1 + rate)
	*
	* @param  float   $rate is the interest rate per period.
	* @param  integer $nper is the total number of payment periods in an annuity.
	* @param  float   $pmt  is the payment made each period and cannot change over the life of the annuity.
	* @param  float   $fv   is the future value, or a cash balance you want to attain after the last payment is made.
	* @param  integer $type is the number 0 or 1 and indicates when payments are due.
	* @return float   the present value of an investment.
	*/
	function PV($rate, $nper, $pmt, $fv = 0.0, $type = 0)
	{
		// Calculate the PVIF and FVIFA
		$pvif  = $this->_calculate_pvif ($rate, $nper);
		$fvifa = $this->_calculate_fvifa ($rate, $nper);
		
		if ($pvif == 0)
			return null;
		$pv = ((-$fv - $pmt * (1.0 + $rate * $type) * $fvifa) / $pvif);
		return (is_finite($pv) ? $pv: null);
	}
	
	/**
	 * FV
	 * Returns the future value of an investment based on periodic,
	 * constant payments and a constant interest rate.
	 * 
	 * For a more complete description of the arguments in FV, see the PV function.
	 * 
	 * Rate: is the interest rate per period.
	 * Nper: is the total number of payment periods in an annuity.
	 * Pmt: is the payment made each period; it cannot change over the life of the
	 *  annuity. Typically, pmt contains principal and interest but no other fees
	 *  or taxes. If pmt is omitted, you must include the pv argument.
	 * Pv: is the present value, or the lump-sum amount that a series of future
	 *  payments is worth right now. If pv is omitted, it is assumed to be 0 (zero),
	 *  and you must include the pmt argument.
	 * Type: is the number 0 or 1 and indicates when payments are due. If type is
	 *  omitted, it is assumed to be 0.
	 *  0 or omitted, At the end of the period
	 *  1, At the beginning of the period
	 * 
	 * If rate = 0:
	 * FV = -(PV + PMT * nper)
	 * 
	 * Else
	 *                                  /             nper \
	 *                                 | 1 - (1 + rate)     |                 nper
	 * FV =  PMT * (1 + rate * type) * | ------------------ | - PV * (1 + rate)
	 *                                  \        rate      /
	 * 
	 **/
	function FV($rate, $nper, $pmt, $pv = 0.0, $type = 0)
	{
		$pvif = $this->_calculate_pvif ($rate, $nper);
		$fvifa = $this->_calculate_fvifa ($rate, $nper);
		
		$fv = (-(($pv * $pvif) + $pmt *
				(1.0 + $rate * $type) * $fvifa));
		
		return (is_finite($fv) ? $fv: null);
	}
	
	/**
	 * FVSCHEDULE
	 * Returns the future value of an initial principal after applying a series
	 * of compound interest rates. Use FVSCHEDULE to calculate the future value
	 * of an investment with a variable or adjustable rate.
	 * 
	 **/
	function FVSCHEDULE($principal, $schedule)
	{
		$n = count($schedule);
		for ($i = 0; $i < $n; $i++)
			$principal *= 1 + $schedule[$i];
		return $principal;
	}
	
	/**
	 * PMT
	 * Calculates the payment for a loan based on constant payments
	 * and a constant interest rate.
	 * 
	 * For a more complete description of the arguments in PMT, see the PV function.
	 * 
	 * Rate: is the interest rate for the loan.
	 * Nper: is the total number of payments for the loan.
	 * Pv: is the present value, or the total amount that a series of future payments
	 *  is worth now; also known as the principal.
	 * Fv: is the future value, or a cash balance you want to attain after the last
	 *  payment is made. If fv is omitted, it is assumed to be 0 (zero), that is,
	 *  the future value of a loan is 0.
	 * Type: is the number 0 (zero) or 1 and indicates when payments are due.
	 *  0 or omitted, At the end of the period
	 *  1, At the beginning of the period
	 * 
	 * If rate = 0:
	 *        -(FV + PV)
	 * PMT = ------------
	 *           nper
	 * 
	 * Else
	 * 
	 *                                      nper
	 *                   FV + PV * (1 + rate)
	 * PMT = --------------------------------------------
	 *                             /             nper \
	 *                            | 1 - (1 + rate)     |
	 *        (1 + rate * type) * | ------------------ |
	 *                             \        rate      /
	 * 
	 **/
	function PMT($rate, $nper, $pv, $fv = 0.0, $type = 0)
	{
		$pmt = $this->_calculate_pmt ($rate, $nper, $pv, $fv, $type);
		return (is_finite($pmt) ? $pmt: null);
	}
	
	/**
	 * IPMT
	 * Returns the interest payment for a given period for an investment based
	 * on periodic, constant payments and a constant interest rate.
	 * 
	 * For a more complete description of the arguments in IPMT, see the PV function.
	 * 
	 */
	function IPMT($rate, $per, $nper, $pv, $fv = 0.0, $type = 0)
	{
		if (($per < 1) || ($per >= ($nper + 1)))
			return null;
		else {
			$pmt = $this->_calculate_pmt ($rate, $nper, $pv, $fv, $type);
			$ipmt = $this->_calculate_interest_part ($pv, $pmt, $rate, $per - 1);
			return (is_finite($ipmt) ? $ipmt: null);
		}
	}
	
	/**
	 * PPMT
	 * Returns the payment on the principal for a given period for an
	 * investment based on periodic, constant payments and a constant
	 * interest rate.
	 * 
	 **/
	function PPMT($rate, $per, $nper, $pv, $fv = 0.0, $type = 0)
	{
		if (($per < 1) || ($per >= ($nper + 1)))
			return null;
		else {
			$pmt = $this->_calculate_pmt ($rate, $nper, $pv, $fv, $type);
			$ipmt = $this->_calculate_interest_part ($pv, $pmt, $rate, $per - 1);
			return ((is_finite($pmt) && is_finite($ipmt)) ? $pmt - $ipmt: null);
		}
	}
	
	/**
	 * NPER
	 * Returns the number of periods for an investment based on periodic,
	 * constant payments and a constant interest rate.
	 * 
	 * For a complete description of the arguments nper, pmt, pv, fv, and type, see PV.
	 * 
	 * Nper: is the total number of payment periods in an annuity.
	 * Pmt: is the payment made each period and cannot change over the life
	 *  of the annuity. Typically, pmt includes principal and interest but no
	 *  other fees or taxes. If pmt is omitted, you must include the fv argument.
	 * Pv: is the present value — the total amount that a series of future payments
	 *  is worth now.
	 * Fv: is the future value, or a cash balance you want to attain after the
	 *  last payment is made. If fv is omitted, it is assumed to be 0 (the future
	 *  value of a loan, for example, is 0).
	 * Type: is the number 0 or 1 and indicates when payments are due.
	 *  0 or omitted, At the end of the period
	 *  1, At the beginning of the period
	 * 
	 * If rate = 0:
	 *        -(FV + PV)
	 * nper = -----------
	 *           PMT
	 * 
	 * Else
	 *              / PMT * (1 + rate * type) - FV * rate \
	 *         log | ------------------------------------- |
	 *              \ PMT * (1 + rate * type) + PV * rate /
	 * nper = -----------------------------------------------
	 *                          log (1 + rate)
	 * 
	 **/
	function NPER($rate, $pmt, $pv, $fv = 0.0, $type = 0)
	{
		if (($rate == 0) && ($pmt != 0))
			$nper = (-($fv + $pv) / $pmt);
		elseif ($rate <= 0.0)
			return null;
		else {
			$tmp = ($pmt * (1.0 + $rate * $type) - $fv * $rate) /
					($pv * $rate + $pmt * (1.0 + $rate * $type));
			if ($tmp <= 0.0)
				return null;
			$nper = (log10($tmp) / log10(1.0 + $rate));
		}
		return (is_finite($nper) ? $nper: null);
	}
	
	/*
	 * EFFECT
	 * Returns the effective annual interest rate, given the nominal annual
	 * interest rate and the number of compounding periods per year.
	 * 
	 *           /     nominal_rate \ npery
	 * EFFECT = | 1 + -------------- |       - 1
	 *           \         npery    /
	 * 
	 **/
	function EFFECT($nominal_rate, $npery)
	{
		$npery = intval($npery);
		if (($nominal_rate <= 0) || ($npery < 1)) return null;
		$effect = pow(1 + $nominal_rate / $npery, $npery) - 1;
		return (is_finite($effect) ? $effect: null);
	}
	
	/**
	 * NOMINAL
	 * Returns the nominal annual interest rate, given the effective rate
	 * and the number of compounding periods per year.
	 * 
	 *                                   (1 / npery)
	 * NOMINAL = npery * (1 + effect_rate)           -  npery
	 * 
	 **/
	function NOMINAL($effect_rate, $npery)
	{
		$npery = intval($npery);
		if (($effect_rate <= 0) || ($npery < 1)) return null;
		$nominal = $npery * pow(1 + $effect_rate, 1 / $npery) - $npery;
		return (is_finite($nominal) ? $nominal: null);
	}
	
	/**
	 * DISC
	 * Returns the discount rate for a security.
	 * 
	 *             redemption - pr
	 * DISC = ---------------------------
	 *         redemption * yearfraction
	 * 
	 **/
	function DISC($settlement, $maturity, $pr, $redemption, $basis = FINANCIAL_BASIS_MSRB_30_360)
	{
		if (!$this->_is_valid_basis($basis)) return null;
		if (($pr <= 0) || ($redemption <= 0)) return null;
		if ($settlement >= $maturity) return null;
		
		switch ($basis) {
			case FINANCIAL_BASIS_MSRB_30_360: // US(NASD) 30/360
				$dsm = $this->Thirty360USyearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_ACT: // Actual days/actual days
				$dsm = $this->ActualActualyearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_360: // Actual days/360
				$dsm = $this->Actual360yearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_365: // Actual days/365
				$dsm = $this->Actual365yearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_30E_360: // European 30/360
				$dsm = $this->Thirty360EUyearFraction($settlement, $maturity);
				break;
		}
		$disc = ($redemption - $pr) / ($redemption * $dsm);
		return (is_finite($disc) ? $disc: null);
	}
	
	/**
	 * RECEIVED
	 * Returns the amount received at maturity for a fully invested security.
	 * 
	 *                      investment
	 * RECEIVED = -----------------------------
	 *             1 - discount * yearfraction
	 * 
	 **/
	function RECEIVED($settlement, $maturity, $investment, $discount, $basis = FINANCIAL_BASIS_MSRB_30_360)
	{
		if (!$this->_is_valid_basis($basis)) return null;
		if (($investment <= 0) || ($discount <= 0)) return null;
		if ($settlement >= $maturity) return null;
		
		switch ($basis) {
			case FINANCIAL_BASIS_MSRB_30_360: // US(NASD) 30/360
				$dsm = $this->Thirty360USyearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_ACT: // Actual/actual
				$dsm = $this->ActualActualyearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_360: // Actual/360
				$dsm = $this->Actual360yearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_365: // Actual/365
				$dsm = $this->Actual365yearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_30E_360: // European 30/360
				$dsm = $this->Thirty360EUyearFraction($settlement, $maturity);
				break;
		}
		$received = $investment / (1 - $discount * $dsm);
		return (is_finite($received) ? $received: null);
	}
	
	/**
	 * INTRATE
	 * Returns the interest rate for a fully invested security.
	 * 
	 *	           redemption - investment
	 * INTRATE = ---------------------------
	 *            investment * yearfraction
	 * 
	 **/
	function INTRATE($settlement, $maturity, $investment, $redemption, $basis = FINANCIAL_BASIS_MSRB_30_360)
	{
		if (!$this->_is_valid_basis($basis)) return null;
		if (($investment <= 0) || ($redemption <= 0)) return null;
		if ($settlement >= $maturity) return null;
		
		switch ($basis) {
			case FINANCIAL_BASIS_MSRB_30_360: // US(NASD) 30/360
				$dsm = $this->Thirty360USyearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_ACT: // Actual/actual
				$dsm = $this->ActualActualyearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_365: // Actual/360
				$dsm = $this->Actual360yearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_365: // Actual/365
				$dsm = $this->Actual365yearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_30E_360: // European 30/360
				$dsm = $this->Thirty360EUyearFraction($settlement, $maturity);
				break;
		}
		$intrate = ($redemption - $investment) / ($investment * $dsm);
		return (is_finite($intrate) ? $intrate: null);
	}
	
	/**
	 * NPV
	 * Calculates the net present value of an investment by using a
	 * discount rate and a series of future payments (negative values)
	 * and income (positive values).
	 * 
	 *        n   /   values(i)  \
	 * NPV = SUM | -------------- |
	 *       i=1 |            i   |
	 *            \  (1 + rate)  /
	 * 
	 **/
	function NPV($rate, $values)
	{
		if (!is_array($values)) return null;
		
		$npv = 0.0;
		for ($i = 0; $i < count($values); $i++)
		{
			$npv += $values[$i] / pow(1 + $rate, $i + 1);
		}
		return (is_finite($npv) ? $npv: null);
	}
	
	/**
	 * XNPV
	 * Returns the net present value for a schedule of cash flows that
	 * is not necessarily periodic. To calculate the net present value
	 * for a series of cash flows that is periodic, use the NPV function.
	 * 
	 *        n   /                values(i)               \
	 * NPV = SUM | ---------------------------------------- |
	 *       i=1 |           ((dates(i) - dates(1)) / 365)  |
	 *            \ (1 + rate)                             /
	 * 
	 **/
	function XNPV($rate, $values, $dates)
	{
		if ((!is_array($values)) || (!is_array($dates))) return null;
		if (count($values) != count($dates)) return null;
		
		$xnpv = 0.0;
		for ($i = 0; $i < count($values); $i++)
		{
			$xnpv += $values[$i] / pow(1 + $rate, $this->DATEDIFF('day', $dates[0], $dates[$i]) / 365);
		}
		return (is_finite($xnpv) ? $xnpv: null);
	}
	
	/*
	 * IRR
	 * Returns the internal rate of return for a series of cash flows
	 * represented by the numbers in values. These cash flows do not
	 * have to be even, as they would be for an annuity. However, the
	 * cash flows must occur at regular intervals, such as monthly or
	 * annually. The internal rate of return is the interest rate
	 * received for an investment consisting of payments (negative
	 * values) and income (positive values) that occur at regular periods.
	 * 
	 */
	function IRR($values, $guess = 0.1)
	{
		if (!is_array($values)) return null;
		
		// create an initial bracket, with a root somewhere between bot and top
		$x1 = 0.0;
		$x2 = $guess;
		$f1 = $this->NPV($x1, $values);
		$f2 = $this->NPV($x2, $values);
		for ($i = 0; $i < FINANCIAL_MAX_ITERATIONS; $i++)
		{
			if (($f1 * $f2) < 0.0) break;
			if (abs($f1) < abs($f2)) {
				$f1 = $this->NPV($x1 += 1.6 * ($x1 - $x2), $values);
			} else {
				$f2 = $this->NPV($x2 += 1.6 * ($x2 - $x1), $values);
			}
		}
		if (($f1 * $f2) > 0.0) return null;
		
		$f = $this->NPV($x1, $values);
		if ($f < 0.0) {
			$rtb = $x1;
			$dx = $x2 - $x1;
		} else {
			$rtb = $x2;
			$dx = $x1 - $x2;
		}
		
		for ($i = 0;  $i < FINANCIAL_MAX_ITERATIONS; $i++)
		{
			$dx *= 0.5;
			$x_mid = $rtb + $dx;
			$f_mid = $this->NPV($x_mid, $values);
			if ($f_mid <= 0.0) $rtb = $x_mid;
			if ((abs($f_mid) < FINANCIAL_ACCURACY) || (abs($dx) < FINANCIAL_ACCURACY)) return $x_mid;
		}
		return null;
	}
	
	/*
	 * MIRR
	 * Returns the modified internal rate of return for a series
	 * of periodic cash flows. MIRR considers both the cost of
	 * the investment and the interest received on reinvestment
	 * of cash.
	 * 
	 **/
	function MIRR($values, $finance_rate, $reinvert_rate)
	{
		$n = count($values);
		for ($i = 0, $npv_pos = $npv_neg = 0; $i < $n; $i++) {
			$v = $values[$i];
			if ($v >= 0)
				$npv_pos += $v / pow(1.0 + $reinvert_rate, $i);
			else
				$npv_neg += $v / pow(1.0 + $finance_rate, $i);
		}
		
		if (($npv_neg == 0) || ($npv_pos == 0) || ($reinvert_rate <= -1))
			return null;
		
		/*
		* I have my doubts about this formula, but it sort of looks like
		* the one Microsoft claims to use and it produces the results
		* that Excel does.  -- MW.
		*/
		$mirr = pow((-$npv_pos * pow(1 + $reinvert_rate, $n))
				/ ($npv_neg * (1 + $reinvert_rate)), (1.0 / ($n - 1))) - 1.0;
		return (is_finite($mirr) ? $mirr: null);
	}
	
	/*
	 * XIRR
	 * Returns the internal rate of return for a schedule of cash flows
	 * that is not necessarily periodic. To calculate the internal rate
	 * of return for a series of periodic cash flows, use the IRR function.
	 * 
	 * Adapted from routine in Numerical Recipes in C, and translated
	 * from the Bernt A Oedegaard algorithm in C
	 * 
	 **/
	function XIRR($values, $dates, $guess = 0.1)
	{
		if ((!is_array($values)) && (!is_array($dates))) return null;
		if (count($values) != count($dates)) return null;
		
		// create an initial bracket, with a root somewhere between bot and top
		$x1 = 0.0;
		$x2 = $guess;
		$f1 = $this->XNPV($x1, $values, $dates);
		$f2 = $this->XNPV($x2, $values, $dates);
		for ($i = 0; $i < FINANCIAL_MAX_ITERATIONS; $i++)
		{
			if (($f1 * $f2) < 0.0) break;
			if (abs($f1) < abs($f2)) {
				$f1 = $this->XNPV($x1 += 1.6 * ($x1 - $x2), $values, $dates);
			} else {
				$f2 = $this->XNPV($x2 += 1.6 * ($x2 - $x1), $values, $dates);
			}
		}
		if (($f1 * $f2) > 0.0) return null;
		
		$f = $this->XNPV($x1, $values, $dates);
		if ($f < 0.0) {
			$rtb = $x1;
			$dx = $x2 - $x1;
		} else {
			$rtb = $x2;
			$dx = $x1 - $x2;
		}
		
		for ($i = 0;  $i < FINANCIAL_MAX_ITERATIONS; $i++)
		{
			$dx *= 0.5;
			$x_mid = $rtb + $dx;
			$f_mid = $this->XNPV($x_mid, $values, $dates);
			if ($f_mid <= 0.0) $rtb = $x_mid;
			if ((abs($f_mid) < FINANCIAL_ACCURACY) || (abs($dx) < FINANCIAL_ACCURACY)) return $x_mid;
		}
		return null;
	}
	
	/**
	 * RATE
	 * 
	 **/
	function RATE($nper, $pmt, $pv, $fv = 0.0, $type = 0, $guess = 0.1)
	{
		$rate = $guess;
		$i  = 0;
		$x0 = 0;
		$x1 = $rate;
		
		if (abs($rate) < FINANCIAL_ACCURACY) {
			$y = $pv * (1 + $nper * $rate) + $pmt * (1 + $rate * $type) * $nper + $fv;
		} else {
			$f = exp($nper * log(1 + $rate));
			$y = $pv * $f + $pmt * (1 / $rate + $type) * ($f - 1) + $fv;
		}
		$y0 = $pv + $pmt * $nper + $fv;
		$y1 = $pv * $f + $pmt * (1 / $rate + $type) * ($f - 1) + $fv;
		
		// find root by secant method
		while ((abs($y0 - $y1) > FINANCIAL_ACCURACY) && ($i < FINANCIAL_MAX_ITERATIONS))
		{
			$rate = ($y1 * $x0 - $y0 * $x1) / ($y1 - $y0);
			$x0 = $x1;
			$x1 = $rate;
			
			if (abs($rate) < FINANCIAL_ACCURACY) {
				$y = $pv * (1 + $nper * $rate) + $pmt * (1 + $rate * $type) * $nper + $fv;
			} else {
				$f = exp($nper * log(1 + $rate));
				$y = $pv * $f + $pmt * (1 / $rate + $type) * ($f - 1) + $fv;
			}
			
			$y0 = $y1;
			$y1 = $y;
			$i++;
		}
		return $rate;
	}
	
	/**
	 * DELTA
	 * Tests whether two values are equal. Returns 1 if number1 = number2; returns 0 otherwise.
	 * Use this function to filter a set of values. For example, by summing several DELTA functions
	 * you calculate the count of equal pairs. This function is also known as the Kronecker Delta function.
	 */
	function DELTA($number1, $number2 = 0)
	{
		if (is_nan($number1) || is_nan($number2)) return null;
		if ($number1 == $number2) {
			return 1;
		} else {
			return 0;
		}
	}
	
	/*
	 * Returns the yield on a security that pays periodic interest.
	 * Use YIELD to calculate bond yield.
	 * 
	 * Settlement: is the security's settlement date. The security
	 *  settlement date is the date after the issue date when the
	 *  security is traded to the buyer.
	 * Maturity: is the security's maturity date. The maturity date
	 *  is the date when the security expires.
	 * Rate: is the security's annual coupon rate.
	 * Pr: is the security's price per $100 face value.
	 * Redemption: is the security's redemption value per $100 face value.
	 * Frequency: is the number of coupon payments per year. For annual
	 *  payments, frequency = 1; for semiannual, frequency = 2; for
	 *  quarterly, frequency = 4.
	 * Basis: is the type of day count basis to use.
	 *  0 or omitted US (NASD) 30/360
	 *  1 Actual/actual
	 *  2 Actual/360
	 *  3 Actual/365
	 *  4 European 30/360
	 *
	 */
	function YIELD($settlement, $maturity, $rate, $pr, $redemption, $frequency, $basis = FINANCIAL_BASIS_MSRB_30_360)
	{
		if (!$this->_is_valid_basis($basis)) return null;
		if (!$this->_is_valid_frequency($frequency)) return null;
		if ($rate < 0) return null;
		if (($pr <= 0) || ($redemption <= 0)) return null;
		if ($settlement >= $maturity) return null;
		
		// TODO: Not yet implemented
		return null;
	}
	
	/**
	 * PRICEDISC
	 * Returns the price per $100 face value of a discounted security.
	 **/
	function PRICEDISC($settlement, $maturity, $discount, $redemption, $basis = FINANCIAL_BASIS_MSRB_30_360)
	{
		if (!$this->_is_valid_basis($basis)) return null;
		if (($discount <= 0) || ($redemption <= 0)) return null;
		if ($settlement >= $maturity) return null;
		
		switch ($basis) {
			case FINANCIAL_BASIS_MSRB_30_360: // US(NASD) 30/360
				$dsm = $this->Thirty360USyearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_ACT: // Actual/actual
				$dsm = $this->ActualActualyearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_360: // Actual/360
				$dsm = $this->Actual360yearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_365: // Actual/365
				$dsm = $this->Actual365yearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_30E_360: // European 30/360
				$dsm = $this->Thirty360EUyearFraction($settlement, $maturity);
				break;
		}
		
		return $redemption - $discount * $redemption * $dsm;
	}
	
	/**
	 * YIELDDISC
	 * Returns the annual yield for a discounted security.
	 **/
	function YIELDDISC($settlement, $maturity, $pr, $redemption, $basis = FINANCIAL_BASIS_MSRB_30_360)
	{
		if (!$this->_is_valid_basis($basis)) return null;
		if (($pr <= 0) || ($redemption <= 0)) return null;
		if ($settlement >= $maturity) return null;
		
		switch ($basis) {
			case FINANCIAL_BASIS_MSRB_30_360: // US(NASD) 30/360
				$dsm = $this->Thirty360USyearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_ACT: // Actual/actual
				$dsm = $this->ActualActualyearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_360: // Actual/360
				$dsm = $this->Actual360yearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_365: // Actual/365
				$dsm = $this->Actual365yearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_30E_360: // European 30/360
				$dsm = $this->Thirty360EUyearFraction($settlement, $maturity);
				break;
		}
		
		return ($redemption - $pr) / ($pr * $dsm);
	}
	
	/**
	 * COUPNUM
	 * Returns the number of coupons payable between the settlement
	 * date and maturity date, rounded up to the nearest whole coupon.
	 *
	 */
	function COUPNUM($settlement, $maturity, $frequency, $basis = FINANCIAL_BASIS_MSRB_30_360)
	{
		if (!$this->_is_valid_basis($basis)) return null;
		if (!$this->_is_valid_frequency($frequency)) return null;
		if ($settlement >= $maturity) return null;
		
		switch ($basis) {
			case FINANCIAL_BASIS_MSRB_30_360: // US(NASD) 30/360
				$dsm = $this->Thirty360USdayCount($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_ACT: // Actual/actual
				$dsm = $this->ActualActualdayCount($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_360: // Actual/360
				$dsm = $this->Actual360dayCount($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_365: // Actual/365
				$dsm = $this->Actual365yearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_30E_360: // European 30/360
				$dsm = $this->Thirty360EUdayCount($settlement, $maturity);
				break;
		}
		
		switch ($frequency) {
			case 1: // anual payments
				return ceil($dsm / 360);
			case 2: // semiannual
				return ceil($dsm / 180);
			case 4: // quarterly
				return ceil($dsm / 90);
		}
		return null;
	}
	
	/**
	 * COUPDAYBS
	 * Returns the number of days in the coupon period that contains
	 * the settlement date.
	 *
	 */
	function COUPDAYBS($settlement, $maturity, $frequency, $basis = FINANCIAL_BASIS_MSRB_30_360)
	{
		if (!$this->_is_valid_basis($basis)) return null;
		if (!$this->_is_valid_frequency($frequency)) return null;
		if ($settlement >= $maturity) return null;
		
		switch ($basis) {
			case FINANCIAL_BASIS_MSRB_30_360: // US(NASD) 30/360
				$dsm = $this->Thirty360USdayCount($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_ACT: // Actual/actual
				$dsm = $this->ActualActualdayCount($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_360: // Actual/360
				$dsm = $this->Actual360dayCount($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_ACT_365: // Actual/365
				$dsm = $this->Actual365yearFraction($settlement, $maturity);
				break;
			case FINANCIAL_BASIS_30E_360: // European 30/360
				$dsm = $this->Thirty360EUdayCount($settlement, $maturity);
				break;
		}
		
		switch ($frequency) {
			case 1: // anual payments
				return 365 - ($dsm % 360);
			case 2: // semiannual
				return 365 - ($dsm % 360);
			case 4: // quarterly
				return $this->DATEDIFF('day', $this->DATEADD('day', -ceil($dsm / 90) * 90 - ($dsm % 90), $maturity), $settlement);
		}
		return null;
	}
}
?>