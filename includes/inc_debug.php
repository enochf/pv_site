<?php
switch($ds) {
	case "ds23":
		echo '<strong>ds34:</strong><br />
		- - - - - - - - - - - - - - - - - - - - - - - - Column 1<br />
		';
		for ($i = 1; $i <= 16; $i++) {
			echo $pv->t5c['ds23'][$i].'<br />
			';
		}
		echo '- - - - - - - - - - - - - - - - - - - - - - - - Column 2<br />
		';
		for ($i = 1; $i <= 8; $i++) {
			echo $pv->t3c['ds23'][$i].'<br />
			';
		}
		echo $pv->t1c['ds23'][1].'<br />
		- - - - - - - - - - - - - - - - - - - - - - - - Column 3<br />
		';
		for ($i = 2; $i <= 5; $i++) {
			echo $pv->t1c['ds23'][$i].'<br />
			';
		}
		echo '- - - - - - - - - - - - - - - - - - - - - - - - Column 4<br />
		';
		for ($i = 17; $i <= 30; $i++) {
			echo $pv->t5c['ds23'][$i].'<br />
			';
		}
		echo '- - - - - - - - - - - - - - - - - - - - - - - - Column 5<br />
		';
		for ($i = 1; $i <= 4; $i++) {
			echo $pv->d['ds23'][$i].'<br />
			';
		}
		echo '- - - - - - - - - - - - - - - - - - - - - - - - Column 6<br />
		';
		for ($i = 31; $i <= 35; $i++) {
			echo $pv->t5c['ds23'][$i].'<br />
			';
		}
		echo '- - - - - - - - - - - - - - - - - - - - - - - - Column 7<br />
		';
		for ($i = 36; $i <= 40; $i++) {
			echo $pv->t5c['ds23'][$i].'<br />
			';
		}
		echo '- - - - - - - - - - - - - - - - - - - - - - - - Column 8<br />
		';
		echo $pv->d['ds23'][5].'<br />
		'.$pv->d['ds23'][6].'<br />
		'.$pv->t1c['ds23'][6].'<br />
		- - - - - - - - - - - - - - - - - - - - - - - - Column 9<br />
		';
		for ($i = 1; $i <= 3; $i++) {
			echo $pv->t2c['ds23'][$i].'<br />
			';
		}
		echo '- - - - - - - - - - - - - - - - - - - - - - - - End<br /><br />
		';
		break;
	case "ds34":
		echo '<strong>ds34:</strong><br />
		- - - - - - - - - - - - - - - - - - - - - - - - Column 1<br />
		'.$pv->d['ds34'][1].'<br />
		'.$pv->d['ds34'][2].'<br />
		'.$pv->d['ds34'][3].'<br />
		'.$pv->d['ds34'][4].'<br />
		'.$pv->d['ds34'][5].'<br />
		'.$pv->d['ds34'][6].'<br />
		'.$pv->d['ds34'][7].'<br />
		'.$pv->d['ds34'][8].'<br />
		'.$pv->t5c['ds34'][1].'<br />
		'.$pv->d['ds34'][9].'<br />
		'.$pv->d['ds34'][10].'<br />
		'.$pv->t5c['ds34'][2].'<br />
		'.$pv->d['ds34'][11].'<br />
		'.$pv->d['ds34'][12].'<br />
		'.$pv->d['ds34'][13].'<br />
		'.$pv->t6c['ds34'][1].'<br />
		'.$pv->d['ds34'][14].'<br />
		'.$pv->t5c['ds34'][3].'<br />
		'.$pv->d['ds34'][15].'<br />
		'.$pv->d['ds34'][16].'<br />
		'.$pv->t5c['ds34'][4].'<br />
		'.$pv->d['ds34'][17].'<br />
		'.$pv->t6c['ds34'][2].'<br />
		- - - - - - - - - - - - - - - - - - - - - - - - Column 2<br />
		'.$pv->d['ds34'][18].'<br />
		'.$pv->d['ds34'][19].'<br />
		'.$pv->d['ds34'][20].'<br />
		'.$pv->t5c['ds34'][5].'<br />
		'.$pv->t5c['ds34'][6].'<br />
		'.$pv->t5c['ds34'][7].'<br />
		'.$pv->t5c['ds34'][8].'<br />
		'.$pv->d['ds34'][21].'<br />
		'.$pv->t5c['ds34'][9].'<br />
		'.$pv->d['ds34'][22].'<br />
		'.$pv->t5c['ds34'][10].'<br />
		'.$pv->t5c['ds34'][11].'<br />
		'.$pv->t5c['ds34'][12].'<br />
		'.$pv->t5c['ds34'][13].'<br />
		'.$pv->d['ds34'][23].'<br />
		'.$pv->d['ds34'][24].'<br />
		'.$pv->d['ds34'][25].'<br />
		'.$pv->t5c['ds34'][14].'<br />
		'.$pv->t5c['ds34'][15].'<br />
		'.$pv->t5c['ds34'][16].'<br />
		'.$pv->t5c['ds34'][17].'<br />
		'.$pv->t5c['ds34'][18].'<br />
		'.$pv->t5c['ds34'][19].'<br />
		- - - - - - - - - - - - - - - - - - - - - - - - End<br /><br />
		';
		break;
	default:
		echo 'This isn\'t working<br />';
		break;
}
?>