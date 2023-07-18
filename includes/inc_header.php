<?php
echo '<!--stopindex--><div id="appheader"> 
  <a href="#content" class="hidden">Skip to content</a> 
  <img src="images/header1.gif" width="1000" height="64" border="0" usemap="#Map" alt="" id="retrofitsheader" /> 
  <map name="Map" id="Map"> 
    <area shape="rect" coords="6,5,665,60" alt="Jobs and Economic Development Impacts Photovoltaics Model (JEDI PV)" /> 
    <area shape="rect" coords="676,4,990,60" href="http://www.nrel.gov" alt="National Renewable Energy Laboratory" /> 
  </map> 
</div><!-- END: appheader --><!--startindex-->
<div id="header">
	<div id="socialmedia">
	    <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Flocalhost%2Fsteptool%2Findex.php&amp;send=false&amp;layout=button_count&amp;width=50&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=verdana&amp;height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:20px;" allowTransparency="true"></iframe>
	  	<a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	</div>
	<div id="stn_container">
		<script type="text/javascript">var stnOpen = "bottom_left";</script>
		<script src="http://en.openei.org/apps/STN/st_navigator.js"></script>
	</div>
	<a href="model.php" id="run"><span class="hidden">Return to Model</span></a>
	<div id="topnav">
	';
	if ($_SESSION['uID']) {
		echo '<div>Welcome '.$_SESSION['fName'].' '.$_SESSION['lName'].'</div>
		<a href="my-account.php"><span>&#187;</span> My Account</a>
		<a href="handle_logout.php"><span>&#187;</span> Logout</a>
		';
	} else {
		echo '<a href="login.php"><span>&#187;</span> Login</a>
		<a href="register.php"><span>&#187;</span> Register</a>
		';
	}
	echo '</div><!-- END: topnav -->
</div><!-- END: header -->
';
?>