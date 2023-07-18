<?php
switch($_SERVER['PHP_SELF']) {
	case '/index.php':
		$pos1 = ' style="background-position:0px 0px;"';
		break;
	case '/model.php':
	case '/results.php':
		$pos2 = ' style="background-position:-78px -37px;"';
		break;
	case '/about-jedi-pv.php':
		$pos3 = ' style="background-position:-203px -37px;"';
		break;
	case '/download-jedi-pv.php':
		$pos4 = ' style="background-position:-322px -37px;"';
		break;
	case '/faq.php':
		$pos5 = ' style="background-position:-533px -37px;"';
		break;
}
echo '<div id="navcontainer">
	<ul id="mainnav">
		<li id="version">Version 1.0 beta</li>
		<li><a href="index.php" id="tab1"'.$pos1.'><span class="hidden">Home</span></a></li>
		<li><a href="model.php" id="tab2"'.$pos2.'><span class="hidden">Run the Model</span></a></li>
		<li><a href="about-jedi-pv.php" id="tab3"'.$pos3.'><span class="hidden">About JEDI PV</span></a></li>
		<li><a href="download-jedi-pv.php" id="tab4"'.$pos4.'><span class="hidden">Download the Model</span></a></li>
		<li><a href="faq.php" id="tab5"'.$pos5.'><span class="hidden">Frequently Asked Questions</span></a></li>
	</ul>
</div>
';
?>