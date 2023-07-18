<?php include('includes/inc_docheader.php'); ?>

<?php include('includes/inc_header.php'); ?>

<?php include('includes/inc_mainnav.php'); ?>

<div id="mainbody">
	<div id="leftside">
		<h1><img src="images/ttl_login.gif" alt="Register" /></h1>
		<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		?>
		<p>All Fields Required</p>
		<form action="handle_login.php" method="post" id="reg">
			<input type="hidden" name="url" value="<?php echo $_GET['url']; ?>" />
			<label>Email</label>
			<input type="text" name="email" value="<?php echo $_SESSION['email']; ?>" class="txt" />
			<div class="clr"></div>
			
			<label>Password</label>
			<input type="password" name="pass" value="" class="txt" />
			<div class="clr"></div>
			
			<label>&nbsp;</label>
			<input type="submit" value="Login" class="btn" />
			<div class="clr"></div>
		</form>
		<p>Not registered yet? <a href="register.php">Click here</a></p>
	</div><!-- END: leftside -->
	<div id="rightside">
		<?php include("includes/inc_resources.php"); ?>
	</div><!-- END: rightside -->
	<div class="clr"></div><!-- END: clearbar -->
</div><!-- END: mainbody -->

<?php include('includes/inc_footer.php'); ?>

</body>
</html>






















