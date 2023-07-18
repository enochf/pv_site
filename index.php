<?php include('includes/inc_docheader.php'); ?>

<?php include('includes/inc_header.php'); ?>

<?php include('includes/inc_mainnav.php'); ?>

<div id="mainbody">
	<div id="leftside">
		<h1><img src="images/ttl_whatisjedipv.gif" alt="What is JEDI PV?" /></h1>
		<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		?>
		<p>The <strong>Jobs and Economic Development Impact (JEDI) Photovoltaics (PV)</strong> model is a user-friendly tool that estimates the economic impacts of constructing and operating photovoltaic power generation at the local and state levels.</p>
		<p>On this site, you can download the model for free, learn more about how JEDI works, understand the output, and get answers to questions about using the model.</p>
		<p>Click here for more information on JEDI PV including some of the source data used.</p>
	</div><!-- END: leftside -->
	<div id="rightside">
		<?php include("includes/inc_resources.php"); ?>
	</div><!-- END: rightside -->
	<div class="clr"></div><!-- END: clearbar -->
</div><!-- END: mainbody -->

<?php include('includes/inc_footer.php'); ?>

</body>
</html>






















