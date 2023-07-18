<?php include('includes/inc_docheader.php'); ?>

<?php include('includes/inc_header.php'); ?>

<?php include('includes/inc_mainnav.php'); ?>

<div id="mainbody">
	<div id="leftside">
		<h1><img src="images/ttl_faq.gif" alt="Frequently Asked Questions" /></h1>
		<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		?>
		<p class="lset">
			<a href="#q1">How do I run a county or regional level analysis?</a>
			<a href="#q2">Where can I get county or regional level data to upload to the model to run a county or region specific analysis?</a>
			<a href="#q3">How do I add in county or regional level multipliers and the personal consumption expenditure data?</a>
			<a href="#q4">What does the "local share" refer to?</a>
			<a href="#q5">I want to make my analysis as accurate as possible, where can I get information to adjust the default "local share" values for my state or county?</a>
			<a href="#q6">I want to make my property tax estimates as accurate as possible, where can I get information to modify the tax rates in the ProjectData worksheet for my state or county?</a>
			<a href="#q7">I am interested in viewing and possibly editting internal formulas within the model, how do I access them?</a>
			<a href="#q8">I noticed defined regions in the list of locations to analyze, which states are included in each region?</a>
			<a href="#q9">Is additional technical support available?</a>
		</p>
		<!--<h2 style="font-weight:bold;">How can I determine which version of the JEDI model I have?</h2>
		<p class="answer">The version (release number) of the model you are currently using is listed in the "About JEDI" worksheet contained in this model.  </p><p><a href="#">Return to Top</a></p><br />-->

		<!--<h2 style="font-weight:bold;">When I open up the model I receive a security alert message stating "the macros in the file have been disabled," how do I change the security setting so I can run the model with the macros enabled?  </h2>
		<p class="answer">The message you are receiving is related to the level of security you have chosen in your Excel&trade; set up.  To change the setting for opening files, click the Microsoft Office Button (on the top left of the toolbar), click on "Excel Options," then "Trust Center," then "Trust Center Settings," then "Macros Settings."  Reset the security level  to "Enable" or "Disable with notification."  The reset method may vary with different versions of Excel&trade;.  Alternately, the model can be successfully run with the macros disabled.  If you choose this option, the print and save results buttons will not function.  Similarly, you will need to navigate using the worksheet tabs rather than buttons.</p><p><a href="#">Return to Top</a></p><br />-->
		
		<a name="q1"></a>
		<h2 style="font-weight:bold;">How do I run a county or regional level analysis?</h2>
		<p class="answer">Running a county or regional level analysis is similar to running a state level analysis, although there are two key differences users must keep in mind.  First, the model does not contain county or regional level multipliers, thus users must obtain these and upload them into the model. (See FAQ on obtaining county or regional level multipliers and how to add in the data)  Second, to run a county or regional level analysis users must choose "My County" or "My Region" as the location in the Project Description section and then enter the county or regional population. The population provides a reference for the model to automatically insert "local share" defaults for the analysis.  As with other defaults, these can be adjusted by the user.</p><p><a href="#">Return to Top</a></p><br />

		<a name="q2"></a>
		<h2 style="font-weight:bold;">Where can I get county or regional level data to upload to the model to run a county or region specific analysis?</h2>
		<p class="answer">County level multipliers and personal consumption expenditure patterns are available from a number of sources.  Users familiar with IMPLAN or input-output modeling can purchase the raw county level data and derive the multipliers themselves, purchase them from someone familiar with input-output modeling, purchase them directly from  IMPLAN (www.implan.com), or contact MRG &amp; Associates (mrgassociates@earthlink.net), the model developer.</p><p><a href="#">Return to Top</a></p><br />

		<a name="q3"></a>
		<h2 style="font-weight:bold;">How do I add in county or regional level multipliers and the personal consumption expenditure data?</h2>
		<p class="answer">Adding-in county or regional level multipliers and personal consumption expenditure data involves downloading the <a href="handle_template.php">Multipliers Template</a> (.csv format) and cutting and pasting the data into their respective locations.  The personal consumption expenditures reflect each industries share of the total.  The sum must equal 1.00 (100 percent).  For example, if spending in the retail sector accounts for 20 percent of personal spending, enter 0.20.  Once you've added all of the multipliers and personal consumption data and saved the file you can upload it in the section provided after choosing "My County" or "My Region" as the Project Location. With the data uploaded it is also necessary to insert the county or region name and the year of the data in the Project Description section.</p><p><a href="#">Return to Top</a></p><br />

		<a name="q4"></a>
		<h2 style="font-weight:bold;">What does the "local share" refer to?</h2>
		<p class="answer">The "local share" refers to the percentage of each expenditure that is actually spent locally (i.e., in the state, county or region being analyzed).  For example, if $1 million is going to be spent on construction materials and half ($500,000) of this total will be purchased from local suppliers, we say the "local share" is 50 percent.</p><p><a href="#">Return to Top</a></p><br />

		<a name="q5"></a>
		<h2 style="font-weight:bold;">I want to make my analysis as accurate as possible, where can I get information to adjust the default "local share" values for my state or county?</h2>
		<p class="answer">Since the "local share" is directly related to the availability of local businesses and services and their ability to meet the construction and annual operating demands of the project, it is important to have an accurate picture of these local resources.  This can be obtained in a number of ways: contacting experienced and knowlegeable persons in the area, contacting local business and contractor organizations and/or the local chamber of commerce, among others.</p><p><a href="#">Return to Top</a></p><br />

		<a name="q6"></a>
		<h2 style="font-weight:bold;">I want to make my property tax estimates as accurate as possible, where can I get information to modify the tax rates in the ProjectData worksheet for my state or county?</h2>
		<p class="answer">Calculating annual property taxes is different in every state and typically a complex formula.  The default methodology used in the model incorporates a generic formula that derives the taxes from the product of the assessed value (percentage of construction cost), the taxable value (percentage of assessed value) and the tax rate (percentage of taxable value).  Alternately, users may input a known tax payment.  Information on tax rates and formulas for calculating property taxes can often be found by contacting the state Dept. of Revenue or Taxation, or the local taxation authority.</p><p><a href="#">Return to Top</a></p><br />

		<a name="q7"></a>
		<h2 style="font-weight:bold;">I am interested in viewing and possibly editting internal formulas within the model, how do I access them?</h2>
		<p class="answer">The online version of the JEDI model cannot be alterred except for the input values specifically designated for user input. The spreadsheet version of the JEDI model contains several intermediate worksheets that are an integral part of the model analysis. These worksheets are not designed to be changed by users. Several of these worksheets, including default data, calculations, and deflators may be viewed by merely clicking on the respective worksheet and scrolling to the right. Although these sheets may be viewed by users they are protected and can not be editted.  The model contains two additional worksheets: multipliers and household expenditures.  These worksheets are hidden to protect proprietary data derived from IMPLAN (Minnesota Implan Group).</p><p><a href="#">Return to Top</a></p><br />

		<a name="q8"></a>
		<h2 style="font-weight:bold;">I noticed defined regions in the list of locations to analyze, which states are included in each region?</h2>  
		<ul class="answer">
			<li><strong>Region 1</strong> includes Connecticut, Maine, Massachusetts, New Hampshire, New York, Rhode Island, and Vermont.</li>
			<li><strong>Region 2</strong> includes Delaware, New Jersey, Pennsylvania, and West Virginia.</li>
			<li><strong>Region 3</strong> includes District of Columbia, Maryland, North Carolina, South Carolina, and Virginia.</li>
			<li><strong>Region 4</strong> includes Alabama, Florida, Georgia, Kentucky, Mississippi, and Tennessee.</li>
			<li><strong>Region 5</strong> includes Illinois, Indiana, Iowa, Michigan, Minnesota, Ohio, and Wisconsin.</li>
			<li><strong>Region 6</strong> includes Arkansas, Louisiana, Missouri, New Mexico, Oklahoma, and Texas.</li>
			<li><strong>Region 7</strong> includes Alaska, Arizona, Colorado, Idaho, Kansas, Montana, Nebraska, Nevada, North Dakota, Oregon, South Dakota, Utah, Washington, and Wyoming.</li>
			<li><strong>Region 8</strong> includes California and Hawaii.</li>
		</ul><br />

		<a name="q9"></a>
		<h2 style="font-weight:bold;">Is additional technical support available?</h2>
		<p class="answer">Yes, technical support is available by contacting Barry Friedman, program technical monitor at the National Renewable Energy Laboratory.  Send questions or comments by email to jedisupport@nrel.gov.</p><p><a href="#">Return to Top</a></p><br />
	</div><!-- END: leftside -->
	<div id="rightside">
		<?php include("includes/inc_resources.php"); ?>
	</div><!-- END: rightside -->
	<div class="clr"></div><!-- END: clearbar -->
</div><!-- END: mainbody -->

<?php include('includes/inc_footer.php'); ?>

</body>
</html>






















