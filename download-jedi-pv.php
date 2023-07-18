<?php include('includes/inc_docheader.php'); ?>

<?php include('includes/inc_header.php'); ?>

<?php include('includes/inc_mainnav.php'); ?>

<div id="mainbody">
	<div id="leftside">
		<h1><img src="images/ttl_downloadspreadsheet.gif" alt="Download Spreadsheet" /></h1>
		<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		?>
		<?php
		if ($_SESSION['uID']) {
			echo '<div id="download" class="dropdown" style="display:block;">
				<div id="dl" style="float:left; margin-right:20px;">
					<a href="handle_model.php"><img src="images/download_model.gif" alt="Download JEDI PV Model" /></a>
				</div>
				<p>&nbsp;</p>
				<p>Click on the link to the left to download the latest version of the spreadsheet JEDI PV model.</p>
				<div class="clr"></div>	
			</div>
			';
		} else {
			echo '<p>To download the model, you will be required to register and create an account. <a href="register.php">Click here</a> to register.</p>
			';
		}
		?>
	</div><!-- END: leftside -->
	<div id="rightside">
		<?php include("includes/inc_resources.php"); ?>
	</div><!-- END: rightside -->
	<div class="clr"></div><!-- END: clearbar -->
</div><!-- END: mainbody -->

<?php include('includes/inc_footer.php'); ?>

</body>
</html>






















