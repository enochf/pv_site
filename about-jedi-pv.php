<?php include('includes/inc_docheader.php'); ?>

<?php include('includes/inc_header.php'); ?>

<?php include('includes/inc_mainnav.php'); ?>

<div id="mainbody">
	<div id="leftside">
		<h1><img src="images/ttl_aboutjedipv.gif" alt="About JEDI PV" /></h1>
		<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		?>
		<p>The <strong>Jobs and Economic Development Impacts (JEDI) Photovoltaics (PV)</strong> model allows users to estimate economic development impacts from PV projects. JEDI PV has default information that can be utilized to run a generic impacts analysis assuming industry averages. Model users are encouraged to enter as much project-specific data as possible.</p>
		<p><a href="model.php">Run the JEDI PV Model</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="download-jedi-pv.php">Download the Spreadsheet Version of JEDI PV</a></p>
		<h2>About JEDI Models</h2>

		<p>The Jobs and Economic Development Impact (JEDI) models are user-friendly tools that estimate the economic impacts of constructing and operating power generation and biofuel plants at the local (usually state) level.</p>

		<p>Based on project-specific or default inputs (derived from industry norms), JEDI estimates the number of jobs and economic impacts to a local area that could reasonably be supported by a power generation project. For example, JEDI estimates the number of in-state construction jobs from a new wind farm.</p>

		<p>Jobs, earnings, and output are distributed across three categories:</p>

		<ul>
			<li>Project Development and Onsite Labor Impacts</li>
			<li>Local Revenue, Turbine, and Supply Chain Impacts</li>
			<li>Induced Impacts.</li>
		</ul>

		<p>JEDI model defaults are based on interviews with industry experts and project developers. Economic multipliers contained within the model are derived from Minnesota IMPLAN Group's IMPLAN Professional.</p>
		
		<h2>Who uses JEDI?</h2>

		<p>JEDI models are used by county and state decision-makers, public utility commissions, potential project owners and others interested in the economic impacts from new electricity generation projects.</p>

		<p>JEDI's user-friendly design allows novices to explore jobs and economic impacts from construction and operation of power plants. Advanced users can incorporate specific data to tailor model inputs and refine conclusions from model output.</p>
		
		<h2>How the Models Work</h2>

		<p>The JEDI models run in Excel. All JEDI models apply the same basic user interface. Users download the appropriate JEDI model and then enter basic information about a project, including the state, location, year of construction, and facility size. The model then estimates the project costs (i.e., specific expenditures), and the economic impacts in terms of jobs, earnings (i.e., wages and salary), and output (i.e., value of production) resulting from the project. To the extent that a user has and can incorporate project-specific data as well as the share of spending expected to occur locally, the results are more likely to better reflect the actual impacts from the specific project.</p>
		
		<h2>Project Data Inputs</h2>

		<p>The project-specific data include a bill of goods (costs associated with actual construction of the facility, roads, etc., as well as equipment costs, other services, and fees required), annual operating and maintenance costs, the portion of expenditures to be spent locally, financing terms, and local tax rates. While JEDI provides reasonable default values for each of the inputs and all of those necessary for the analysis, the user has the option to indicate project specific data for the following categories of inputs:</p>

		<ul>
			<li>Construction Costs</li>
			<li>Equipment Costs</li>
			<li>Annual Operating and Maintenance Costs</li>
			<li>Financing Parameters</li>
			<li>Other Costs</li>
		</ul>
		
		<p>In the event that project specific data is not available, the default values may be used to represent average costs and spending patterns derived from a number of sources (project-specific data contained in reports and studies).</p>

		<p>To conduct a more specific analysis, users should have project-specific values to use in place of the default values. No project will follow this exact default pattern for expenditures. Project size, location, financing arrangements, and numerous site-specific factors influence the construction and operating costs. Similarly, the availability of local resources, including labor and materials, and locally manufactured power plant components can have a significant effect on the costs and the economic impacts that accrue to the state or local region.</p>
	</div><!-- END: leftside -->
	<div id="rightside">
		<?php include("includes/inc_resources.php"); ?>
	</div><!-- END: rightside -->
	<div class="clr"></div><!-- END: clearbar -->
</div><!-- END: mainbody -->

<?php include('includes/inc_footer.php'); ?>

</body>
</html>






















