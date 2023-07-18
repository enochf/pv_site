<?php include('includes/inc_docheader2.php'); ?>

<?php include('includes/inc_header.php'); ?>

<?php include('includes/inc_mainnav.php'); ?>

<div id="mainbody">
	<div id="fullside">
		<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		?>
		<div id="inputs" class="tblr10 block">
			<?php include("includes/inc_inputs2.php"); ?>
		</div><!-- END: inputs -->
	</div><!-- END: fullside -->
</div><!-- END: mainbody -->

<?php include('includes/inc_footer.php'); ?>

</body>
</html>