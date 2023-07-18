<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);
$f = 1;
function query($query,$vars,$type) {
	global $dbh;
	$stmt = $dbh->prepare($query);
	if($stmt->execute($vars)) {
		if ($type == 'i') {
			return $dbh->lastInsertId();
		} else if ($type == 's') {
			return $stmt->fetchALL(PDO::FETCH_ASSOC);
		} else if ($type == 'u') {
			return true;
		} else if ($type == 'd') {
			return true;
		}
	} else {
		err_log('QUERY: '.$query.' ERROR:'.mysql_error());
	}
}
function checkSession() {
	if (!$_SESSION['uID']) {
		$_SESSION['message'] = '<div id="message">Please login to access your account. 4</div>';
		header("Location:/login.php");
		exit;
	}
}
function err_log($error) {
	$dt = date("ymdHis");
	// $msg = htmlentities($error);
	$msg = htmlentities($error.' IN FILE: '.$_SERVER['PHP_SELF'].' :: '.$_SERVER['REQUEST_URI']);
	// $newpqry = new mysqli($_SERVER['DB_HOST_000'], $_SERVER['DB_USER_000'], $_SERVER['DB_PASS_000'], $_SERVER['DB_NAME_000']);
	$newpqry = new mysqli('localhost', 'pvjedi', 'EFd4A22Bff', 'pvjedi');
	$query = "INSERT INTO errors (msg, dtAdded) VALUES (?,?)";
	$pqry = $newpqry->prepare($query);
	$pqry->bind_param("ss", $msg, $dt);
	$pqry->execute();
	$pqry->close();
	if (defined('debug')) {
		return $msg;
	}
	return "Requested page is temporarily unavailable, please try again later.";
}
function cleanVar($var) {
	return str_replace('%','&#37;',str_replace('_','&#95;',mysql_real_escape_string($var)));
}
function isEmail($email) {
	if (preg_match("/^(\w+((-\w+)|(\w.\w+))*)\@(\w+((\.|-)\w+)*\.\w+$)/",$email)) {
		return true;
	} else {
		return false;
	}
}
function hashPass($pwd) {
	// $hash = sha1($pwd.$_SERVER['SALT_000']);
	$hash = sha1($pwd.'salt');
	return $hash;
}
function fingerprint() {
	$string = $_SERVER['HTTP_USER_AGENT'];
	// $string.= $_SERVER['SALT_000'];
	$string.= 'salt';
	$fp = sha1($string);
	return $fp;
}
function validEmail($email) {
	// FROM http://www.linuxjournal.com/article/9585
	$isValid = true;
	$atIndex = strrpos($email, "@");
	if (is_bool($atIndex) && !$atIndex) {
		$isValid = false;
	} else {
		$domain = substr($email, $atIndex+1);
		$local = substr($email, 0, $atIndex);
		$localLen = strlen($local);
		$domainLen = strlen($domain);
		if ($localLen < 1 || $localLen > 64) {
			$isValid = false;
		} else if ($domainLen < 1 || $domainLen > 255) {
			$isValid = false;
		} else if ($local[0] == '.' || $local[$localLen-1] == '.') {
			$isValid = false;
		} else if (preg_match('/\\.\\./', $local)) {
			$isValid = false;
		} else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
			$isValid = false;
		} else if (preg_match('/\\.\\./', $domain)) {
			$isValid = false;
		} else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local))) {
			if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local))) {
				$isValid = false;
			}
		}
		if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
			$isValid = false;
		}
	}
	return $isValid;
}
function validDt($dt) {
	if($dt == '' || $dt == '--' || !$dt) {
		return '1970-01-01';
	}
	$date_format = 'Y-m-d';
	$dt = trim($dt);
	$time = strtotime($dt);
	$valid = date($date_format, $time) == $dt;
	return ($valid ? true : false);
}
function getAge($bDate) {
	list($bYear,$bMonth,$bDay) = explode("-", $bDate);
	$YearDiff = date("Y") - $bYear;
	$MonthDiff = date("m") - $bMonth;
	$DayDiff = date("d") - $bDay;
	if ($MonthDiff < 0) {
		$YearDiff--;
		return $YearDiff;
	}
	if ($DayDiff < 0) {
		if ($MonthDiff == 0) {
			$YearDiff--;
			return $YearDiff;
		}
	}
	return $YearDiff;
}
function getTime() { 
    $a = explode (' ',microtime()); 
    return(double) $a[0] + $a[1]; 
} 
function elapseTime($start = 0) {
	/* EXAMPLE
		$start = elapseTime();
			//code
		$time = elapseTime($start);
	*/
	global $link;
	switch($start) {
		case 0:
			$start = getTime();
			return $start;
			break;
		default:
			$end = getTime();
			$time = number_format(($end - $start),2);
			err_log("elapseTime = ".$time." secs");
			return $time;
	}
}
function tip($id) {
	global $tip;
	// return '<img src="images/info.png" alt="" class="hastip" title="'.$tip[$id].'" />';
	return '<span class="help" onmouseover="showTip(\'tip_'.$id.'\')" onmouseout="hideTip(\'tip_'.$id.'\')">[?]<div id="tip_'.$id.'" class="tip tipright">'.$tip[$id].'</div></span>';
}
function getMyVals() {
	global $link,$uid,$sid,$key;
	if ($sid) {
		$q = "SELECT vals FROM scenarios WHERE ((sID=?) AND (uID=?))";
		$var = query($q,array($sid,$uid),'s','Get Vals 1');
		if ($var[0]['vals'] != '') {
			$_SESSION['inputs'][$sid] = unserialize($var[0]['vals']);
			// $jsonArray = json_decode($var[0]['vals']);
			// foreach($jsonArray as $k => $v) {
				// $vals[$k] = $v;
				// $hl[$k] = 'highlight';
			// }
		}
	} else if ($key) {
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
function formatNum($num,$type) {
	$num = str_replace(',','',$num);
	switch($type) {
		case 'dec1':
			$num = number_format($num,1);
			break;
		case 'dec2':
			$num = number_format($num,2);
			break;
		case 'pct':
			$num = number_format($num*100);
			break;
		case 'pct1':
			$num = number_format($num*100,1);
			break;
		case 'pct2':
			$num = number_format($num*100,2);
			break;
		default:
			$num = number_format($num);
			break;
	}
	return $num;
}
/*



















*/
?>