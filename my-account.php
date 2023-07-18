<?php include('includes/inc_docheader.php'); ?>

<?php include('includes/inc_header.php'); ?>

<?php include('includes/inc_mainnav.php'); ?>

<div id="mainbody">
	<div id="leftside">
		<h1><img src="images/ttl_myaccount.gif" alt="Register" /></h1>
		<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		?>
		<h2>My Model Runs</h2>
		<?php
		$q = "SELECT * FROM scenarios WHERE ((uID=".$uid.") AND (status=1)) ORDER BY dt DESC";
		$rs = query($q,array(),'s','Get Scenarios Query');
		// $rs = mysql_query($q, $link) OR die(err_log('QUERY: '.$q.' ERROR:'.mysql_error()));
		if (count($rs) > 0) {
			echo '<p>Below is a list of your saved model runs. <a href="model.php">Click here</a> to start a new run or click on the links below to view or edit a saved run.</p>
			<table id="modelruns">
			<tr>
				<th style="text-align:left;">Model Run <em style="font-weight:normal; color:#999;">(click to view)</em></th>
				<th>Run Date</th>
				<th>Copy/Remove</th>
			</tr>
			';
			foreach($rs as $var) {
				list($y,$m,$d) = explode("-", substr($var['dt'], 0, 10));
				echo '<tr>
					<td class="c1"><a href="model.php?sid='.$var['sID'].'">'.$var['name'].'</a></td>
					<td class="c2" style="font-size:12px;">'.$m.'/'.$d.'/'.$y.'</td>
					<td class="c3"><a href="handle_copyrun.php?sid='.$var['sID'].'" onclick="return confirm(\'Are you sure you want to create a copy of this model run?\')">Copy</a> | <a href="handle_removerun.php?sid='.$var['sID'].'" onclick="return confirm(\'Are you sure you want to remove this model run?\n\nThis action cannot be reversed.\')">Remove</a></td>
				</tr>
				';
			}
			echo '</table>
			';
		} else {
			echo '<p>*** You do not have any saved model runs. <a href="model.php">Click here</a> to run the model. ***</p>
			';
		}
		?>
	</div><!-- END: leftside -->
	<div id="rightside">
		<h2>Account Management</h2>
		<p class="lset">
			<a href="javascript:show('chgpass')">Change Password</a>
		</p>
		<div id="chgpass" class="hidden">
			<form action="handle_changepassword.php" method="post" id="chgPass">
			<label>New Password</label>
			<input type="password" name="pass1" /></p>
			<label>Confirm Password</label>
			<input type="password" name="pass2" /></p>
			<input type="submit" value="Update Password" />
			</form>
		</div>
	</div><!-- END: rightside -->
	<div class="clr"></div><!-- END: clearbar -->
</div><!-- END: mainbody -->

<?php include('includes/inc_footer.php'); ?>

</body>
</html>






















