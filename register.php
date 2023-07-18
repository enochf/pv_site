<?php include('includes/inc_docheader.php'); ?>

<?php include('includes/inc_header.php'); ?>

<?php include('includes/inc_mainnav.php'); ?>

<div id="mainbody">
	<div id="leftside">
		<h1><img src="images/ttl_register.gif" alt="Register" /></h1>
		<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		?>
		<p>All Fields Required</p>
		<form action="handle_register.php" method="post" id="reg">
			<label>First Name</label>
			<input type="text" name="fName" value="<?php echo $_SESSION['fName']; ?>" class="txt" />
			<div class="clr"></div>
			
			<label>Last Name</label>
			<input type="text" name="lName" value="<?php echo $_SESSION['lName']; ?>" class="txt" />
			<div class="clr"></div>
			
			<label>Email</label>
			<input type="text" name="email" value="<?php echo $_SESSION['email']; ?>" class="txt" />
			<div class="clr"></div>
			
			<label>Password</label>
			<input type="password" name="pass1" value="" class="txt" />
			<div class="clr"></div>
			
			<label>Confirm Password</label>
			<input type="password" name="pass2" value="" class="txt" />
			<div class="clr"></div>
			
			<label>&nbsp;</label>
			<input type="submit" value="Register" class="btn" />
			<div class="clr"></div>
		</form>
		<p>Already registered? <a href="login.php">Click here</a> to login.</p>
	</div><!-- END: leftside -->
	<div id="rightside">
		<?php include("includes/inc_resources.php"); ?>
	</div><!-- END: rightside -->
	<div class="clr"></div><!-- END: clearbar -->
</div><!-- END: mainbody -->

<?php include('includes/inc_footer.php'); ?>

</body>
</html>






















