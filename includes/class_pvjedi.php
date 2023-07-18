<?php
// ========================================= PV JEDI CLASS === //
/*
Naming Structure for worksheets and cells
	$pd_    =   ProjectData
	$sr_    =   SummaryResults
	$ua_    =   User Add-in Location
	$dd_    =   DefaultData
	$cc_    =   Calculations
	$df_    =   Deflators
*/
class pvj {

	// ----------------------------------------------------- //
	// ---------------- PROJECT DATA FIELDS ---------------- //
	// ----------------------------------------------------- //
	
	public $pd_b13 = 'AZ'; // Project Location
	public $pd_b14 = ''; // Population (only required for County/Region analysis)
	public $pd_b15 = ''; // Year of Construction or Installation
	public $pd_b18 = ''; // Number of Systems Installed
	public $pd_b23 = ''; // Money Value - Current or Constant (Dollar Year)
	public $pd_t12 = ''; // Random "0"
	
	// ------------------------------------------------------------- //
	// ---------------- USER ADD-IN LOCATION FIELDS ---------------- //
	// ------------------------------------------------------------- //

	public $ua_b3 = ''; // MyCounty (name)
	public $ua_b4 = ''; // MyRegion (includes)
	public $ua_b5 = ''; // Sales Tax Rate (%)
	public $ua_b6 = ''; // Property Tax Exemption (%)
	
	public $ua_d3 = ''; // Year of Data
	public $ua_d4 = ''; // Year of Data
	
	// -- Personal Consumption Expenditures (PCE) -- //
	public $ua_e10 = ''; // Agriculture
	public $ua_e11 = ''; // Mining
	public $ua_e12 = ''; // Construction
	public $ua_e13 = ''; // Manufacturing
	public $ua_e14 = ''; // Fabricated Metals
	public $ua_e15 = ''; // Machinery
	public $ua_e16 = ''; // Electrical Equipment
	public $ua_e17 = ''; // TCPU
	public $ua_e18 = ''; // Wholesale Trade
	public $ua_e19 = ''; // Retail Trade
	public $ua_e20 = ''; // FIRE
	public $ua_e21 = ''; // Misc. Services
	public $ua_e22 = ''; // Professional Services
	public $ua_e23 = ''; // Government
	
	public $ua_f10 = ''; // Agriculture
	public $ua_f11 = ''; // Mining
	public $ua_f12 = ''; // Construction
	public $ua_f13 = ''; // Manufacturing
	public $ua_f14 = ''; // Fabricated Metals
	public $ua_f15 = ''; // Machinery
	public $ua_f16 = ''; // Electrical Equipment
	public $ua_f17 = ''; // TCPU
	public $ua_f18 = ''; // Wholesale Trade
	public $ua_f19 = ''; // Retail Trade
	public $ua_f20 = ''; // FIRE
	public $ua_f21 = ''; // Misc. Services
	public $ua_f22 = ''; // Professional Services
	public $ua_f23 = ''; // Government
	
	// -- Jobs Direct Multipliers -- //
	public $ua_b10 = ''; // Agriculture
	public $ua_b11 = ''; // Mining
	public $ua_b12 = ''; // Construction
	public $ua_b13 = ''; // Manufacturing
	public $ua_b14 = ''; // Fabricated Metals
	public $ua_b15 = ''; // Machinery
	public $ua_b16 = ''; // Electrical Equipment
	public $ua_b17 = ''; // TCPU
	public $ua_b18 = ''; // Wholesale Trade
	public $ua_b19 = ''; // Retail Trade
	public $ua_b20 = ''; // FIRE
	public $ua_b21 = ''; // Misc. Services
	public $ua_b22 = ''; // Professional Services
	public $ua_b23 = ''; // Government
	
	public $ua_c10 = ''; // Agriculture
	public $ua_c11 = ''; // Mining
	public $ua_c12 = ''; // Construction
	public $ua_c13 = ''; // Manufacturing
	public $ua_c14 = ''; // Fabricated Metals
	public $ua_c15 = ''; // Machinery
	public $ua_c16 = ''; // Electrical Equipment
	public $ua_c17 = ''; // TCPU
	public $ua_c18 = ''; // Wholesale Trade
	public $ua_c19 = ''; // Retail Trade
	public $ua_c20 = ''; // FIRE
	public $ua_c21 = ''; // Misc. Services
	public $ua_c22 = ''; // Professional Services
	public $ua_c23 = ''; // Government
	
	// -- Jobs Indirect Multipliers -- //
	public $ua_b27 = ''; // Agriculture
	public $ua_b28 = ''; // Mining
	public $ua_b29 = ''; // Construction
	public $ua_b30 = ''; // Manufacturing
	public $ua_b31 = ''; // Fabricated Metals
	public $ua_b32 = ''; // Machinery
	public $ua_b33 = ''; // Electrical Equipment
	public $ua_b34 = ''; // TCPU
	public $ua_b35 = ''; // Wholesale Trade
	public $ua_b36 = ''; // Retail Trade
	public $ua_b37 = ''; // FIRE
	public $ua_b38 = ''; // Misc. Services
	public $ua_b39 = ''; // Professional Services
	public $ua_b40 = ''; // Government
	
	public $ua_c27 = ''; // Agriculture
	public $ua_c28 = ''; // Mining
	public $ua_c29 = ''; // Construction
	public $ua_c30 = ''; // Manufacturing
	public $ua_c31 = ''; // Fabricated Metals
	public $ua_c32 = ''; // Machinery
	public $ua_c33 = ''; // Electrical Equipment
	public $ua_c34 = ''; // TCPU
	public $ua_c35 = ''; // Wholesale Trade
	public $ua_c36 = ''; // Retail Trade
	public $ua_c37 = ''; // FIRE
	public $ua_c38 = ''; // Misc. Services
	public $ua_c39 = ''; // Professional Services
	public $ua_c40 = ''; // Government
	
	// -- Jobs Induced Multipliers -- //
	public $ua_b44 = ''; // Agriculture
	public $ua_b45 = ''; // Mining
	public $ua_b46 = ''; // Construction
	public $ua_b47 = ''; // Manufacturing
	public $ua_b48 = ''; // Fabricated Metals
	public $ua_b49 = ''; // Machinery
	public $ua_b50 = ''; // Electrical Equipment
	public $ua_b51 = ''; // TCPU
	public $ua_b52 = ''; // Wholesale Trade
	public $ua_b53 = ''; // Retail Trade
	public $ua_b54 = ''; // FIRE
	public $ua_b55 = ''; // Misc. Services
	public $ua_b56 = ''; // Professional Services
	public $ua_b57 = ''; // Government
	           
	public $ua_c44 = ''; // Agriculture
	public $ua_c45 = ''; // Mining
	public $ua_c46 = ''; // Construction
	public $ua_c47 = ''; // Manufacturing
	public $ua_c48 = ''; // Fabricated Metals
	public $ua_c49 = ''; // Machinery
	public $ua_c50 = ''; // Electrical Equipment
	public $ua_c51 = ''; // TCPU
	public $ua_c52 = ''; // Wholesale Trade
	public $ua_c53 = ''; // Retail Trade
	public $ua_c54 = ''; // FIRE
	public $ua_c55 = ''; // Misc. Services
	public $ua_c56 = ''; // Professional Services
	public $ua_c57 = ''; // Government
	
	// -- Earnings Direct Multipliers -- //
	public $ua_b61 = ''; // Agriculture
	public $ua_b62 = ''; // Mining
	public $ua_b63 = ''; // Construction
	public $ua_b64 = ''; // Manufacturing
	public $ua_b65 = ''; // Fabricated Metals
	public $ua_b66 = ''; // Machinery
	public $ua_b67 = ''; // Electrical Equipment
	public $ua_b68 = ''; // TCPU
	public $ua_b69 = ''; // Wholesale Trade
	public $ua_b70 = ''; // Retail Trade
	public $ua_b71 = ''; // FIRE
	public $ua_b72 = ''; // Misc. Services
	public $ua_b73 = ''; // Professional Services
	public $ua_b74 = ''; // Government
	           
	public $ua_c61 = ''; // Agriculture
	public $ua_c62 = ''; // Mining
	public $ua_c63 = ''; // Construction
	public $ua_c64 = ''; // Manufacturing
	public $ua_c65 = ''; // Fabricated Metals
	public $ua_c66 = ''; // Machinery
	public $ua_c67 = ''; // Electrical Equipment
	public $ua_c68 = ''; // TCPU
	public $ua_c69 = ''; // Wholesale Trade
	public $ua_c70 = ''; // Retail Trade
	public $ua_c71 = ''; // FIRE
	public $ua_c72 = ''; // Misc. Services
	public $ua_c73 = ''; // Professional Services
	public $ua_c74 = ''; // Government
	
	// -- Earnings Indirect Multipliers -- //
	public $ua_b78 = ''; // Agriculture
	public $ua_b79 = ''; // Mining
	public $ua_b80 = ''; // Construction
	public $ua_b81 = ''; // Manufacturing
	public $ua_b82 = ''; // Fabricated Metals
	public $ua_b83 = ''; // Machinery
	public $ua_b84 = ''; // Electrical Equipment
	public $ua_b85 = ''; // TCPU
	public $ua_b86 = ''; // Wholesale Trade
	public $ua_b87 = ''; // Retail Trade
	public $ua_b88 = ''; // FIRE
	public $ua_b89 = ''; // Misc. Services
	public $ua_b90 = ''; // Professional Services
	public $ua_b91 = ''; // Government
	           
	public $ua_c78 = ''; // Agriculture
	public $ua_c79 = ''; // Mining
	public $ua_c80 = ''; // Construction
	public $ua_c81 = ''; // Manufacturing
	public $ua_c82 = ''; // Fabricated Metals
	public $ua_c83 = ''; // Machinery
	public $ua_c84 = ''; // Electrical Equipment
	public $ua_c85 = ''; // TCPU
	public $ua_c86 = ''; // Wholesale Trade
	public $ua_c87 = ''; // Retail Trade
	public $ua_c88 = ''; // FIRE
	public $ua_c89 = ''; // Misc. Services
	public $ua_c90 = ''; // Professional Services
	public $ua_c91 = ''; // Government
	
	// -- Earnings Induced Multipliers -- //
	public $ua_b95 = ''; // Agriculture
	public $ua_b96 = ''; // Mining
	public $ua_b97 = ''; // Construction
	public $ua_b98 = ''; // Manufacturing
	public $ua_b99 = ''; // Fabricated Metals
	public $ua_b100 = ''; // Machinery
	public $ua_b101 = ''; // Electrical Equipment
	public $ua_b102 = ''; // TCPU
	public $ua_b103 = ''; // Wholesale Trade
	public $ua_b104 = ''; // Retail Trade
	public $ua_b105 = ''; // FIRE
	public $ua_b106 = ''; // Misc. Services
	public $ua_b107 = ''; // Professional Services
	public $ua_b108 = ''; // Government
	           
	public $ua_c95 = ''; // Agriculture
	public $ua_c96 = ''; // Mining
	public $ua_c97 = ''; // Construction
	public $ua_c98 = ''; // Manufacturing
	public $ua_c99 = ''; // Fabricated Metals
	public $ua_c100 = ''; // Machinery
	public $ua_c101 = ''; // Electrical Equipment
	public $ua_c102 = ''; // TCPU
	public $ua_c103 = ''; // Wholesale Trade
	public $ua_c104 = ''; // Retail Trade
	public $ua_c105 = ''; // FIRE
	public $ua_c106 = ''; // Misc. Services
	public $ua_c107 = ''; // Professional Services
	public $ua_c108 = ''; // Government
	
	// -- Output Direct Multipliers -- //
	public $ua_b112 = ''; // Agriculture
	public $ua_b113 = ''; // Mining
	public $ua_b114 = ''; // Construction
	public $ua_b115 = ''; // Manufacturing
	public $ua_b116 = ''; // Fabricated Metals
	public $ua_b117 = ''; // Machinery
	public $ua_b118 = ''; // Electrical Equipment
	public $ua_b119 = ''; // TCPU
	public $ua_b120 = ''; // Wholesale Trade
	public $ua_b121 = ''; // Retail Trade
	public $ua_b122 = ''; // FIRE
	public $ua_b123 = ''; // Misc. Services
	public $ua_b124 = ''; // Professional Services
	public $ua_b125 = ''; // Government
	           
	public $ua_c112 = ''; // Agriculture
	public $ua_c113 = ''; // Mining
	public $ua_c114 = ''; // Construction
	public $ua_c115 = ''; // Manufacturing
	public $ua_c116 = ''; // Fabricated Metals
	public $ua_c117 = ''; // Machinery
	public $ua_c118 = ''; // Electrical Equipment
	public $ua_c119 = ''; // TCPU
	public $ua_c120 = ''; // Wholesale Trade
	public $ua_c121 = ''; // Retail Trade
	public $ua_c122 = ''; // FIRE
	public $ua_c123 = ''; // Misc. Services
	public $ua_c124 = ''; // Professional Services
	public $ua_c125 = ''; // Government
	
	// -- Output Indirect Multipliers -- //
	public $ua_b129 = ''; // Agriculture
	public $ua_b130 = ''; // Mining
	public $ua_b131 = ''; // Construction
	public $ua_b132 = ''; // Manufacturing
	public $ua_b133 = ''; // Fabricated Metals
	public $ua_b134 = ''; // Machinery
	public $ua_b135 = ''; // Electrical Equipment
	public $ua_b136 = ''; // TCPU
	public $ua_b137 = ''; // Wholesale Trade
	public $ua_b138 = ''; // Retail Trade
	public $ua_b139 = ''; // FIRE
	public $ua_b140 = ''; // Misc. Services
	public $ua_b141 = ''; // Professional Services
	public $ua_b142 = ''; // Government
	           
	public $ua_c129 = ''; // Agriculture
	public $ua_c130 = ''; // Mining
	public $ua_c131 = ''; // Construction
	public $ua_c132 = ''; // Manufacturing
	public $ua_c133 = ''; // Fabricated Metals
	public $ua_c134 = ''; // Machinery
	public $ua_c135 = ''; // Electrical Equipment
	public $ua_c136 = ''; // TCPU
	public $ua_c137 = ''; // Wholesale Trade
	public $ua_c138 = ''; // Retail Trade
	public $ua_c139 = ''; // FIRE
	public $ua_c140 = ''; // Misc. Services
	public $ua_c141 = ''; // Professional Services
	public $ua_c142 = ''; // Government
	
	// -- Output Induced Multipliers -- //
	public $ua_b146 = ''; // Agriculture
	public $ua_b147 = ''; // Mining
	public $ua_b148 = ''; // Construction
	public $ua_b149 = ''; // Manufacturing
	public $ua_b150 = ''; // Fabricated Metals
	public $ua_b151 = ''; // Machinery
	public $ua_b152 = ''; // Electrical Equipment
	public $ua_b153 = ''; // TCPU
	public $ua_b154 = ''; // Wholesale Trade
	public $ua_b155 = ''; // Retail Trade
	public $ua_b156 = ''; // FIRE
	public $ua_b157 = ''; // Misc. Services
	public $ua_b158 = ''; // Professional Services
	public $ua_b159 = ''; // Government
	           
	public $ua_c146 = ''; // Agriculture
	public $ua_c147 = ''; // Mining
	public $ua_c148 = ''; // Construction
	public $ua_c149 = ''; // Manufacturing
	public $ua_c150 = ''; // Fabricated Metals
	public $ua_c151 = ''; // Machinery
	public $ua_c152 = ''; // Electrical Equipment
	public $ua_c153 = ''; // TCPU
	public $ua_c154 = ''; // Wholesale Trade
	public $ua_c155 = ''; // Retail Trade
	public $ua_c156 = ''; // FIRE
	public $ua_c157 = ''; // Misc. Services
	public $ua_c158 = ''; // Professional Services
	public $ua_c159 = ''; // Government

	// ----------------------------------------------------- //
	// ---------------- DEFAULT DATA FIELDS ---------------- //
	// ----------------------------------------------------- //
	
	public $dd_f16 = 1; // Mounting (rails, clamps, fittings, etc.)
	public $dd_f17 = 1; // Modules
	public $dd_f18 = 1; // Electrical (wire, connectors, breakers, etc.)
	public $dd_f19 = 1; // Inverter
	public $dd_f22 = 1; // Installation
	public $dd_f26 = 1; // Permitting
	public $dd_f27 = 1; // Other Costs
	public $dd_f28 = 1; // Business Overhead
	
	public $dd_g16 = 0; // Mounting (rails, clamps, fittings, etc.)
	public $dd_g17 = 0; // Modules
	public $dd_g18 = 0; // Electrical (wire, connectors, breakers, etc.)
	public $dd_g19 = 0; // Inverter
	public $dd_g22 = 1; // Installation
	public $dd_g26 = 1; // Permitting
	public $dd_g27 = 0; // Other Costs
	public $dd_g28 = 0; // Business Overhead
	           
	public $dd_h16 = 1; // Mounting (rails, clamps, fittings, etc.)
	public $dd_h17 = 1; // Modules
	public $dd_h18 = 1; // Electrical (wire, connectors, breakers, etc.)
	public $dd_h19 = 1; // Inverter
	public $dd_h22 = 1; // Installation
	public $dd_h26 = 1; // Permitting
	public $dd_h27 = 1; // Other Costs
	public $dd_h28 = 1; // Business Overhead
	           
	public $dd_i16 = 1; // Mounting (rails, clamps, fittings, etc.)
	public $dd_i17 = 1; // Modules
	public $dd_i18 = 1; // Electrical (wire, connectors, breakers, etc.)
	public $dd_i19 = 1; // Inverter
	public $dd_i22 = 1; // Installation
	public $dd_i26 = 1; // Permitting
	public $dd_i27 = 1; // Other Costs
	public $dd_i28 = 1; // Business Overhead
	
	public $dd_n14 = 30000; // Random number
	public $dd_n15 = 100000; // Random number
	
	public $dd_q15 = 300000; // Random number

	public $dd_t15 = 400000; // Random number

	public $dd_f35 = 1; // Technicians
	public $dd_f38 = 1; // Materials & Equipment
	public $dd_f39 = 1; // Services

	public $dd_g35 = 1; // Technicians
	public $dd_g38 = 0; // Materials & Equipment
	public $dd_g39 = 0; // Services

	public $dd_h35 = 1; // Technicians
	public $dd_h38 = 1; // Materials & Equipment
	public $dd_h39 = 1; // Services

	public $dd_i35 = 1; // Technicians
	public $dd_i38 = 1; // Materials & Equipment
	public $dd_i39 = 1; // Services

	public $dd_j35 = 1; // Technicians
	public $dd_j38 = 1; // Materials & Equipment
	public $dd_j39 = 1; // Services

	public $dd_g44 = 23951776.0227276; // Local Share
	public $dd_g45 = 486225444.068377; // Local Share

	public $dd_c46 = .8; // Percentage financed
	public $dd_c47 = 10; // Years financed (term)
	public $dd_c48 = .1; // Interest rate
	public $dd_c51 = .01; // Local Property Tax (percent of taxable value)
	public $dd_c52 = 1; // Assessed Value (percent of construction cost)
	public $dd_c53 = 1; // Taxable Value (percent of assessed value)

	public $dd_e46 = .0; // Random Percentage

	public $dd_e56 = 1; // Local Property Taxes
	public $dd_e57 = 1; // Local Sales Tax Rate

	public $dd_c61 = 0.583669; // Agriculture
	public $dd_c62 = 0; // Mining
	public $dd_c63 = 0; // Construction
	public $dd_c64 = 0; // Manufacturing
	public $dd_c65 = 0; // Fabricated Metals
	public $dd_c66 = 0; // MachineryElectrical
	public $dd_c67 = 0; // Electrical Equipment
	public $dd_c68 = 0; // TCPU
	public $dd_c69 = 0; // Wholesale Trade
	public $dd_c70 = 0; // Retail Trade
	public $dd_c71 = 0; // FIRE
	public $dd_c72 = 0; // Misc. Services
	public $dd_c73 = 0; // Professional Services
	public $dd_c74 = 0; // Government

	public $dd_d61 = 0; // Agriculture
	public $dd_d62 = 0.362051; // Mining
	public $dd_d63 = 0; // Construction
	public $dd_d64 = 0; // Manufacturing
	public $dd_d65 = 0; // Fabricated Metals
	public $dd_d66 = 0; // MachineryElectrical
	public $dd_d67 = 0; // Electrical Equipment
	public $dd_d68 = 0; // TCPU
	public $dd_d69 = 0; // Wholesale Trade
	public $dd_d70 = 0; // Retail Trade
	public $dd_d71 = 0; // FIRE
	public $dd_d72 = 0; // Misc. Services
	public $dd_d73 = 0; // Professional Services
	public $dd_d74 = 0; // Government

	public $dd_e61 = 0; // Agriculture
	public $dd_e62 = 0; // Mining
	public $dd_e63 = 1; // Construction
	public $dd_e64 = 0; // Manufacturing
	public $dd_e65 = 0; // Fabricated Metals
	public $dd_e66 = 0; // MachineryElectrical
	public $dd_e67 = 0; // Electrical Equipment
	public $dd_e68 = 0; // TCPU
	public $dd_e69 = 0; // Wholesale Trade
	public $dd_e70 = 0; // Retail Trade
	public $dd_e71 = 0; // FIRE
	public $dd_e72 = 0; // Misc. Services
	public $dd_e73 = 0; // Professional Services
	public $dd_e74 = 0; // Government

	public $dd_f61 = 0; // Agriculture
	public $dd_f62 = 0; // Mining
	public $dd_f63 = 0; // Construction
	public $dd_f64 = 0.558412; // Manufacturing
	public $dd_f65 = 0; // Fabricated Metals
	public $dd_f66 = 0; // MachineryElectrical
	public $dd_f67 = 0; // Electrical Equipment
	public $dd_f68 = 0; // TCPU
	public $dd_f69 = 0; // Wholesale Trade
	public $dd_f70 = 0; // Retail Trade
	public $dd_f71 = 0; // FIRE
	public $dd_f72 = 0; // Misc. Services
	public $dd_f73 = 0; // Professional Services
	public $dd_f74 = 0; // Government

	public $dd_g61 = 0; // Agriculture
	public $dd_g62 = 0; // Mining
	public $dd_g63 = 0; // Construction
	public $dd_g64 = 0; // Manufacturing
	public $dd_g65 = 1; // Fabricated Metals
	public $dd_g66 = 0; // MachineryElectrical
	public $dd_g67 = 0; // Electrical Equipment
	public $dd_g68 = 0; // TCPU
	public $dd_g69 = 0; // Wholesale Trade
	public $dd_g70 = 0; // Retail Trade
	public $dd_g71 = 0; // FIRE
	public $dd_g72 = 0; // Misc. Services
	public $dd_g73 = 0; // Professional Services
	public $dd_g74 = 0; // Government
	
	public $dd_h61 = 0; // Agriculture
	public $dd_h62 = 0; // Mining
	public $dd_h63 = 0; // Construction
	public $dd_h64 = 0; // Manufacturing
	public $dd_h65 = 0; // Fabricated Metals
	public $dd_h66 = 0.631251; // MachineryElectrical
	public $dd_h67 = 0; // Electrical Equipment
	public $dd_h68 = 0; // TCPU
	public $dd_h69 = 0; // Wholesale Trade
	public $dd_h70 = 0; // Retail Trade
	public $dd_h71 = 0; // FIRE
	public $dd_h72 = 0; // Misc. Services
	public $dd_h73 = 0; // Professional Services
	public $dd_h74 = 0; // Government

	public $dd_i61 = 0; // Agriculture
	public $dd_i62 = 0; // Mining
	public $dd_i63 = 0; // Construction
	public $dd_i64 = 0; // Manufacturing
	public $dd_i65 = 0; // Fabricated Metals
	public $dd_i66 = 0; // MachineryElectrical
	public $dd_i67 = 0.512774; // Electrical Equipment
	public $dd_i68 = 0; // TCPU
	public $dd_i69 = 0; // Wholesale Trade
	public $dd_i70 = 0; // Retail Trade
	public $dd_i71 = 0; // FIRE
	public $dd_i72 = 0; // Misc. Services
	public $dd_i73 = 0; // Professional Services
	public $dd_i74 = 0; // Government

	public $dd_j61 = 0.051572; // Agriculture
	public $dd_j62 = 0.630549; // Mining ** (0.284423+0.346126) ** 
	public $dd_j63 = 0; // Construction
	public $dd_j64 = 0.023014; // Manufacturing
	public $dd_j65 = 0; // Fabricated Metals
	public $dd_j66 = 0.000889; // MachineryElectrical
	public $dd_j67 = 0.012136; // Electrical Equipment
	public $dd_j68 = 1; // TCPU
	public $dd_j69 = 0; // Wholesale Trade
	public $dd_j70 = 0; // Retail Trade
	public $dd_j71 = 0; // FIRE
	public $dd_j72 = 0.042428; // Misc. Services
	public $dd_j73 = 0; // Professional Services
	public $dd_j74 = 0; // Government
	
	public $dd_k61 = 0.07245; // Agriculture
	public $dd_k62 = 0.0074; // Mining
	public $dd_k63 = 0; // Construction
	public $dd_k64 = 0.418573; // Manufacturing ** (0.080398+0.338175) ** 
	public $dd_k65 = 0; // Fabricated Metals
	public $dd_k66 = 0.367859; // MachineryElectrical ** (0.1018+0.266059) ** 
	public $dd_k67 = 0.47509; // Electrical Equipment ** (0.075345+0.399745) **
	public $dd_k68 = 0; // TCPU
	public $dd_k69 = 1; // Wholesale Trade
	
	public $dd_k71 = 0; // FIRE
	public $dd_k72 = 0.092083; // Misc. Services
	public $dd_k73 = 0; // Professional Services
	public $dd_k74 = 0; // Government
	
	public $dd_l61 = 0.292309; // Agriculture
	public $dd_l62 = 0; // Mining
	public $dd_l63 = 0; // Construction
	public $dd_l64 = 0; // Manufacturing
	public $dd_l65 = 0; // Fabricated Metals
	public $dd_l66 = 0; // MachineryElectrical
	public $dd_l67 = 0; // Electrical Equipment
	public $dd_l68 = 0; // TCPU
	public $dd_l69 = 0; // Wholesale Trade
	public $dd_l70 = 0.311286; // Retail Trade
	public $dd_l71 = 0; // FIRE
	public $dd_l72 = 0.361097; // Misc. Services
	public $dd_l73 = 0; // Professional Services
	public $dd_l74 = 0; // Government
	
	public $dd_m61 = 0; // Agriculture
	public $dd_m62 = 0; // Mining
	public $dd_m63 = 0; // Construction
	public $dd_m64 = 0; // Manufacturing
	public $dd_m65 = 0; // Fabricated Metals
	public $dd_m66 = 0; // MachineryElectrical
	public $dd_m67 = 0; // Electrical Equipment
	public $dd_m68 = 0; // TCPU
	public $dd_m69 = 0; // Wholesale Trade
	public $dd_m70 = 0; // Retail Trade
	public $dd_m71 = 1; // FIRE
	public $dd_m72 = 0; // Misc. Services
	public $dd_m73 = 0; // Professional Services
	public $dd_m74 = 0; // Government
	
	public $dd_n61 = 0; // Agriculture
	public $dd_n62 = 0; // Mining
	public $dd_n63 = 0; // Construction
	public $dd_n64 = 0; // Manufacturing
	public $dd_n65 = 0; // Fabricated Metals
	public $dd_n66 = 0; // MachineryElectrical
	public $dd_n67 = 0; // Electrical Equipment
	public $dd_n68 = 0; // TCPU
	public $dd_n69 = 0; // Wholesale Trade
	public $dd_n70 = 0; // Retail Trade
	public $dd_n71 = 0; // FIRE
	public $dd_n72 = 0.504392; // Misc. Services
	public $dd_n73 = 0; // Professional Services
	public $dd_n74 = 0; // Government
	
	public $dd_o61 = 0; // Agriculture
	public $dd_o62 = 0; // Mining
	public $dd_o63 = 0; // Construction
	public $dd_o64 = 0; // Manufacturing
	public $dd_o65 = 0; // Fabricated Metals
	public $dd_o66 = 0; // MachineryElectrical
	public $dd_o67 = 0; // Electrical Equipment
	public $dd_o68 = 0; // TCPU
	public $dd_o69 = 0; // Wholesale Trade
	public $dd_o70 = 0; // Retail Trade
	public $dd_o71 = 0; // FIRE
	public $dd_o72 = 0; // Misc. Services
	public $dd_o73 = 1; // Professional Services
	public $dd_o74 = 0; // Government
	
	public $dd_p61 = 0; // Agriculture
	public $dd_p62 = 0; // Mining
	public $dd_p63 = 0; // Construction
	public $dd_p64 = 0; // Manufacturing
	public $dd_p65 = 0; // Fabricated Metals
	public $dd_p66 = 0; // MachineryElectrical
	public $dd_p67 = 0; // Electrical Equipment
	public $dd_p68 = 0; // TCPU
	public $dd_p69 = 0; // Wholesale Trade
	public $dd_p70 = 0; // Retail Trade
	public $dd_p71 = 0; // FIRE
	public $dd_p72 = 0; // Misc. Services
	public $dd_p73 = 0; // Professional Services
	public $dd_p74 = 1; // Government

	public $dd_ag17 = 'N'; // Manufactured locally
	public $dd_ag18 = 'N'; // Manufactured locally
	public $dd_ag19 = 'N'; // Manufactured locally
	public $dd_ag20 = 'N'; // Manufactured locally

	public $dd_ag38 = 'N'; // Manufactured locally

	public $dd_ai13 = 2; // New construction
	public $dd_ai14 = 3; // New construction
	public $dd_ai15 = 4; // New construction
	public $dd_ai16 = 5; // New construction
	public $dd_ai17 = 6; // New construction
	public $dd_ai18 = 7; // New construction
	public $dd_ai19 = 8; // New construction
	public $dd_ai20 = 9; // New construction
	public $dd_ai21 = 10; // New construction
	public $dd_ai22 = 11; // New construction
	public $dd_ai23 = 12; // New construction
	public $dd_ai24 = 13; // New construction
	public $dd_ai25 = 14; // New construction
	public $dd_ai26 = 15; // New construction
	public $dd_ai27 = 16; // New construction
	public $dd_ai28 = 17; // New construction
	public $dd_ai29 = 18; // New construction
	public $dd_ai30 = 19; // New construction
	public $dd_ai31 = 20; // New construction
	public $dd_ai32 = 21; // New construction
	public $dd_ai33 = 22; // New construction
	public $dd_ai34 = 23; // New construction
	public $dd_ai35 = 24; // New construction
	public $dd_ai36 = 25; // New construction
	public $dd_ai37 = 26; // New construction
	public $dd_ai38 = 27; // New construction
	public $dd_ai39 = 28; // New construction
	public $dd_ai40 = 29; // New construction
	public $dd_ai41 = 30; // New construction
	public $dd_ai42 = 31; // New construction

	public $dd_aj12 = 1; // Random number

	public $dd_aj15 = 2.5; // Residential New Construction
	public $dd_aj16 = 100; // Residential New Construction
	public $dd_aj17 = .01; // Residential New Construction
	public $dd_aj18 = .45; // Residential New Construction
	public $dd_aj19 = .01; // Residential New Construction
	public $dd_aj20 = .05; // Residential New Construction
	public $dd_aj21 = .52; // Residential New Construction

	public $dd_aj23 = .05; // Residential New Construction
	public $dd_aj24 = .05; // Residential New Construction
	public $dd_aj25 = .57; // Residential New Construction

	public $dd_aj27 = .01; // Residential New Construction
	public $dd_aj28 = .1; // Residential New Construction
	public $dd_aj29 = .32; // Residential New Construction
	public $dd_aj30 = .43; // Residential New Construction
	public $dd_aj31 = 1; // Residential New Construction
	public $dd_aj32 = 7400; // Residential New Construction

	public $dd_aj35 = 0.546666666666667; // Residential New Construction
	public $dd_aj36 = 0.546666666666667; // Residential New Construction
	
	public $dd_aj38 = 0.453333333333333; // Residential New Construction

	public $dd_aj40 = 0.453333333333333; // Residential New Construction
	public $dd_aj41 = 1; // Residential New Construction
	public $dd_aj42 = 10; // Residential New Construction

	public $dd_ak12 = 2; // Random number

	public $dd_ak15 = 4; // Residential Retrofit
	public $dd_ak16 = 50; // Residential Retrofit 
	public $dd_ak17 = 0.0450507555923017; // Residential Retrofit 
	public $dd_ak18 = 0.482432232917971; // Residential Retrofit 
	public $dd_ak19 = 0.0276809910956252; // Residential Retrofit 
	public $dd_ak20 = 0.0673300655524715; // Residential Retrofit 
	public $dd_ak21 = 0.622494045158369; // Residential Retrofit 
     
	public $dd_ak23 = 0.087590306895805; // Residential Retrofit 
	public $dd_ak24 = 0.087590306895805; // Residential Retrofit 
	public $dd_ak25 = 0.710084352054174; // Residential Retrofit 
     
	public $dd_ak27 = 0.0185631935011844; // Residential Retrofit 
	public $dd_ak28 = 0.0487804878048781; // Residential Retrofit 
	public $dd_ak29 = 0.222571966639763; // Residential Retrofit 
	public $dd_ak30 = 0.289915647945826; // Residential Retrofit 
	public $dd_ak31 = 1; // Residential Retrofit 
	public $dd_ak32 = 8700; // Residential Retrofit 
     
	public $dd_ak35 = 0.546666666666667; // Residential Retrofit 
	public $dd_ak36 = 0.546666666666667; // Residential Retrofit 
	 
	public $dd_ak38 = 0.453333333333333; // Residential Retrofit 
     
	public $dd_ak40 = 0.453333333333333; // Residential Retrofit 
	public $dd_ak41 = 1; // Residential Retrofit 
	public $dd_ak42 = 10; // Residential Retrofit 

	public $dd_al12 = 3; // Random number

	public $dd_al15 = 25; // Small Commercial
	public $dd_al16 = 25; // Small Commercial
	public $dd_al17 = 0.0682330165020848; // Small Commercial
	public $dd_al18 = 0.519817370911956; // Small Commercial
	public $dd_al19 = 0.0439052977071139; // Small Commercial
	public $dd_al20 = 0.0714122263347237; // Small Commercial
	public $dd_al21 = 0.703367911455878; // Small Commercial
    
	public $dd_al23 = 0.094684258760652; // Small Commercial
	public $dd_al24 = 0.094684258760652; // Small Commercial
	public $dd_al25 = 0.79805217021653; // Small Commercial
    
	public $dd_al27 = 0.0192605549657881; // Small Commercial
	public $dd_al28 = 0.0252033972499845; // Small Commercial
	public $dd_al29 = 0.157483877567697; // Small Commercial
	public $dd_al30 = 0.20194782978347; // Small Commercial
	public $dd_al31 = 1; // Small Commercial
    
	public $dd_al35 = 0.546666666666667; // Small Commercial
	public $dd_al36 = 0.546666666666667; // Small Commercial
	
	public $dd_al38 = 0.453333333333333; // Small Commercial
    
	public $dd_al40 = 0.453333333333333; // Small Commercial
	public $dd_al41 = 1; // Small Commercial
	public $dd_al42 = 12; // Small Commercial

	public $dd_am12 = 4; // Random number

	public $dd_am15 = 500; // Large Commercial
	public $dd_am16 = 15; // Large Commercial
	public $dd_am17 = 0.0621165165534506; // Large Commercial
	public $dd_am18 = 0.523402145865479; // Large Commercial
	public $dd_am19 = 0.0435586645545511; // Large Commercial
	public $dd_am20 = 0.0595708152067973; // Large Commercial
	public $dd_am21 = 0.688648142180278; // Large Commercial
    
	public $dd_am23 = 0.0995554046397638; // Large Commercial
	public $dd_am24 = 0.0995554046397638; // Large Commercial
	public $dd_am25 = 0.788203546820041; // Large Commercial
    
	public $dd_am27 = 0.0158784654036363; // Large Commercial
	public $dd_am28 = 0.0436812372168703; // Large Commercial
	public $dd_am29 = 0.152236750559452; // Large Commercial
	public $dd_am30 = 0.211796453179958; // Large Commercial
	public $dd_am31 = 1; // Large Commercial
    
	public $dd_am35 = .6; // Large Commercial
	public $dd_am36 = .6; // Large Commercial
	
	public $dd_am38 = .4; // Large Commercial
    
	public $dd_am40 = .4; // Large Commercial
	public $dd_am41 = 1; // Large Commercial
	public $dd_am42 = 12; // Large Commercial

	public $dd_an12 = 5; // Random number

	public $dd_an15 = 1000; // Utility
	public $dd_an16 = 2; // Utility
	public $dd_an17 = 0.0553052917232022; // Utility
	public $dd_an18 = 0.538385345997286; // Utility
	public $dd_an19 = 0.0630574400723655; // Utility
	public $dd_an20 = 0.0518950701040253; // Utility
	public $dd_an21 = 0.708643147896879; // Utility
    
	public $dd_an23 = 0.0957349615558571; // Utility
	public $dd_an24 = 0.0957349615558571; // Utility
	public $dd_an25 = 0.804378109452737; // Utility
    
	public $dd_an27 = 0.0152148349163275; // Utility
	public $dd_an28 = 0.0249382716049383; // Utility
	public $dd_an29 = 0.155468784025998; // Utility
	public $dd_an30 = 0.195621890547264; // Utility
	public $dd_an31 = 1; // Utility
    
	public $dd_an35 = 0.633333333333333; // Utility
	public $dd_an36 = 0.633333333333333; // Utility
	
	public $dd_an38 = 0.366666666666667; // Utility
    
	public $dd_an40 = 0.366666666666667; // Utility
	public $dd_an41 = 1; // Utility
	public $dd_an42 = 12; // Utility
	
	public $dd_ao12 = 6; // Random number
	
	public $dd_ao15 = 1000; //

	public $dd_ao17 = 0.0553052917232022; //
	public $dd_ao18 = 0.538385345997286; //
	public $dd_ao19 = 0.0630574400723655; //
	public $dd_ao20 = 0.0518950701040253; //
	public $dd_ao21 = 0.708643147896879; //
    
	public $dd_ao23 = 0.0957349615558571; //
	public $dd_ao24 = 0.0957349615558571; //
	public $dd_ao25 = 0.804378109452737; //
    
	public $dd_ao27 = 0.0152148349163275; //
	public $dd_ao28 = 0.0249382716049383; //
	public $dd_ao29 = 0.155468784025998; //
	public $dd_ao30 = 0.195621890547264; //
	public $dd_ao31 = 1; //
    
	public $dd_ao35 = 0.633333333333333; //
	public $dd_ao36 = 0.546666666666667; //
	
	public $dd_ao38 = 0.453333333333333; //
    
	public $dd_ao40 = 0.453333333333333; //
	public $dd_ao41 = 1; //
	public $dd_ao42 = 12; //

	public $dd_ae50 = 0; // Random Number
	public $dd_ae51 = 10; // Random Number
	public $dd_ae52 = 100; // Random Number
	public $dd_ae53 = 500; // Random Number

	public $dd_af50 = 10; // Random Number
	public $dd_af51 = 100; // Random Number
	public $dd_af52 = 500; // Random Number

	public $dd_ag50 = 2; // Random number
	public $dd_ag51 = 3; // Random number
	public $dd_ag52 = 4; // Random number
	public $dd_ag53 = 5; // Random number
	public $dd_ag54 = 6; // Random number
	public $dd_ag55 = 7; // Random number
	public $dd_ag56 = 8; // Random number
	public $dd_ag57 = 9; // Random number
	public $dd_ag58 = 10; // Random number
	public $dd_ag59 = 11; // Random number
	public $dd_ag60 = 12; // Random number
	public $dd_ag61 = 13; // Random number
	public $dd_ag62 = 14; // Random number
	public $dd_ag63 = 15; // Random number
	public $dd_ag64 = 16; // Random number
	public $dd_ag65 = 17; // Random number
	public $dd_ag66 = 18; // Random number

	public $dd_ai50 = 0; // Alabama
	public $dd_ai51 = 0; // Alabama
	public $dd_ai52 = 0; // Alabama
	public $dd_ai53 = 0; // Alabama
	public $dd_ai63 = 0.0815; // Alabama
	public $dd_ai64 = 0.0815; // Alabama

	public $dd_aj50 = 0; // Alaska
	public $dd_aj51 = 0; // Alaska
	public $dd_aj52 = 0; // Alaska
	public $dd_aj53 = 0; // Alaska
	public $dd_aj63 = 0.0150; // Alaska
	public $dd_aj64 = 0.0150; // Alaska

	public $dd_ak50 = 7.3; // Arizona
	public $dd_ak51 = 6.8; // Arizona
	public $dd_ak52 = 6.2; // Arizona
	public $dd_ak53 = 0; // Arizona
	public $dd_ak63 = 0.0715; // Arizona
	public $dd_ak64 = 0.0715; // Arizona

	public $dd_ak65 = 1; // Arizona
	public $dd_ak66 = 1; // Arizona

	public $dd_al50 = 0; // Arkansas
	public $dd_al51 = 0; // Arkansas
	public $dd_al52 = 0; // Arkansas
	public $dd_al53 = 0; // Arkansas
	public $dd_al63 = 0.0825; // Arkansas
	public $dd_al64 = 0.0825; // Arkansas

	public $dd_am50 = 7.82442748091603; // California
	public $dd_am51 = 7.82442748091603; // California
	public $dd_am52 = 7.06106870229008; // California
	public $dd_am53 = 6.39312977099237; // California
	public $dd_am63 = 0.0915; // California
	public $dd_am64 = 0.0915; // California

	public $dd_am65 = 1; // California
	public $dd_am66 = 1; // California

	public $dd_an50 = 8.3; // Colorado
	public $dd_an51 = 0; // Colorado
	public $dd_an52 = 0; // Colorado
	public $dd_an53 = 0; // Colorado
	public $dd_an63 = 0.0640; // Colorado
	public $dd_an64 = 0.0640; // Colorado

	public $dd_ao50 = 8.3011583011583; // Connecticut
	public $dd_ao51 = 8.3011583011583; // Connecticut
	public $dd_ao52 = 7.33590733590734; // Connecticut
	public $dd_ao53 = 0; // Connecticut
	public $dd_ao63 = 0.0600; // Connecticut
	public $dd_ao64 = 0.0600; // Connecticut

	public $dd_ao65 = 1; // Connecticut
	public $dd_ao66 = 1; // Connecticut

	public $dd_ap50 = 0; // Deleware
	public $dd_ap51 = 0; // Deleware
	public $dd_ap52 = 0; // Deleware
	public $dd_ap53 = 0; // Deleware
	public $dd_ap63 = 0; // Deleware
	public $dd_ap64 = 0; // Deleware

	public $dd_aq50 = 0; // District of Columbia
	public $dd_aq51 = 0; // District of Columbia
	public $dd_aq52 = 0; // District of Columbia
	public $dd_aq53 = 0; // District of Columbia
	public $dd_aq63 = 0.0600; // District of Columbia
	public $dd_aq64 = 0.0600; // District of Columbia

	public $dd_ar50 = 0; // Florda
	public $dd_ar51 = 0; // Florda
	public $dd_ar52 = 0; // Florda
	public $dd_ar53 = 0; // Florda
	public $dd_ar63 = 0; // Florda
	public $dd_ar64 = 0; // Florda
	
	public $dd_ar65 = 1; // Florda
	public $dd_ar66 = 1; // Florda
	
	public $dd_as50 = 0; // Georgia
	public $dd_as51 = 0; // Georgia
	public $dd_as52 = 0; // Georgia
	public $dd_as53 = 0; // Georgia
	public $dd_as63 = 0.0690; // Georgia
	public $dd_as64 = 0.0690; // Georgia
	
	public $dd_at50 = 0; // Hawaii
	public $dd_at51 = 0; // Hawaii
	public $dd_at52 = 0; // Hawaii
	public $dd_at53 = 0; // Hawaii
	public $dd_at63 = 0.044; // Hawaii
	public $dd_at64 = 0.044; // Hawaii
	
	public $dd_au50 = 0; // Idaho
	public $dd_au51 = 0; // Idaho
	public $dd_au52 = 0; // Idaho
	public $dd_au53 = 0; // Idaho
	public $dd_au63 = 0.0605; // Idaho
	public $dd_au64 = 0.0605; // Idaho
	
	public $dd_av50 = 9.32977913175933; // Illinois
	public $dd_av51 = 9.32977913175933; // Illinois
	public $dd_av52 = 0; // Illinois
	public $dd_av53 = 0; // Illinois
	public $dd_av63 = 0.084; // Illinois
	public $dd_av64 = 0.084; // Illinois
	
	public $dd_aw50 = 0; // Indiana
	public $dd_aw51 = 0; // Indiana
	public $dd_aw52 = 0; // Indiana
	public $dd_aw53 = 0; // Indiana
	public $dd_aw63 = 0.07; // Indiana
	public $dd_aw64 = 0.07; // Indiana
	
	public $dd_ax50 = 0; // Iowa
	public $dd_ax51 = 0; // Iowa
	public $dd_ax52 = 0; // Iowa
	public $dd_ax53 = 0; // Iowa
	public $dd_ax63 = 0.0685; // Iowa
	public $dd_ax64 = 0.0685; // Iowa
	
	public $dd_ax65 = 1; // Iowa
	public $dd_ax66 = 1; // Iowa
	
	public $dd_ay50 = 0; // Kansas
	public $dd_ay51 = 0; // Kansas
	public $dd_ay52 = 0; // Kansas
	public $dd_ay53 = 0; // Kansas
	public $dd_ay63 = 0.0705; // Kansas
	public $dd_ay64 = 0.0705; // Kansas
	
	public $dd_ay65 = 1; // Kansas
	public $dd_ay66 = 1; // Kansas
	
	public $dd_az50 = 0; // Kentucky
	public $dd_az51 = 0; // Kentucky
	public $dd_az52 = 0; // Kentucky
	public $dd_az53 = 0; // Kentucky
	public $dd_az63 = 0.06; // Kentucky
	public $dd_az64 = 0.06; // Kentucky
	
	public $dd_ba50 = 0; // Louisiana
	public $dd_ba51 = 0; // Louisiana
	public $dd_ba52 = 0; // Louisiana
	public $dd_ba53 = 0; // Louisiana
	public $dd_ba63 = 0.0875; // Louisiana
	public $dd_ba64 = 0.0875; // Louisiana
	
	public $dd_ba65 = 1; // Louisiana
	public $dd_ba66 = 1; // Louisiana
	
	public $dd_bb50 = 0; // Maine
	public $dd_bb51 = 0; // Maine
	public $dd_bb52 = 0; // Maine
	public $dd_bb53 = 0; // Maine
	public $dd_bb63 = 0.05; // Maine
	public $dd_bb64 = 0.05; // Maine
	
	public $dd_bc50 = 8.97683397683397; // Maryland
	public $dd_bc51 = 8.97683397683397; // Maryland
	public $dd_bc52 = 0; // Maryland
	public $dd_bc53 = 0; // Maryland
	public $dd_bc63 = 0.06; // Maryland
	public $dd_bc64 = 0.06; // Maryland
	
	public $dd_bc65 = 1; // Maryland
	public $dd_bc66 = 1; // Maryland
	
	public $dd_bd50 = 8.7; // Massachusetts
	public $dd_bd51 = 8.7; // Massachusetts
	public $dd_bd52 = 7.4; // Massachusetts
	public $dd_bd53 = 0; // Massachusetts
	public $dd_bd63 = 0.0625; // Massachusetts
	public $dd_bd64 = 0.0625; // Massachusetts
	
	public $dd_bd65 = 1; // Massachusetts
	public $dd_bd66 = 1; // Massachusetts
	
	public $dd_be50 = 0; // Michigan
	public $dd_be51 = 0; // Michigan
	public $dd_be52 = 0; // Michigan
	public $dd_be53 = 0; // Michigan
	public $dd_be63 = 0.06; // Michigan
	public $dd_be64 = 0.06; // Michigan
	
	public $dd_be65 = 1; // Michigan
	public $dd_be66 = 1; // Michigan
	
	public $dd_bf50 = 9.6; // Minnesota
	public $dd_bf51 = 8.1; // Minnesota
	public $dd_bf52 = 0; // Minnesota
	public $dd_bf53 = 0; // Minnesota
	public $dd_bf63 = 0.072; // Minnesota
	public $dd_bf64 = 0.072; // Minnesota
	
	public $dd_bf65 = 1; // Minnesota
	public $dd_bf66 = 1; // Minnesota
	
	public $dd_bg50 = 0; // Mississippi
	public $dd_bg51 = 0; // Mississippi
	public $dd_bg52 = 0; // Mississippi
	public $dd_bg53 = 0; // Mississippi
	public $dd_bg63 = 0.07; // Mississippi
	public $dd_bg64 = 0.07; // Mississippi
	
	public $dd_bh50 = 0; // Missouri
	public $dd_bh51 = 0; // Missouri
	public $dd_bh52 = 0; // Missouri
	public $dd_bh53 = 0; // Missouri
	public $dd_bh63 = 0.071; // Missouri
	public $dd_bh64 = 0.071; // Missouri
	
	public $dd_bi50 = 0; // Montana
	public $dd_bi51 = 0; // Montana
	public $dd_bi52 = 0; // Montana
	public $dd_bi53 = 0; // Montana
	public $dd_bi63 = 0; // Montana
	public $dd_bi64 = 0; // Montana
	
	public $dd_bi65 = 1; // Montana
	public $dd_bi66 = 1; // Montana
	
	public $dd_bj50 = 0; // My Country
	public $dd_bj51 = 0; // My Country
	public $dd_bj52 = 0; // My Country
	public $dd_bj53 = 0; // My Country
	
	public $dd_bk50 = 0; // My Region
	public $dd_bk51 = 0; // My Region
	public $dd_bk52 = 0; // My Region
	public $dd_bk53 = 0; // My Region
	
	public $dd_bl50 = 0; // Nebraska
	public $dd_bl51 = 0; // Nebraska
	public $dd_bl52 = 0; // Nebraska
	public $dd_bl53 = 0; // Nebraska
	public $dd_bl63 = 0.06; // Nebraska
	public $dd_bl64 = 0.06; // Nebraska
	
	public $dd_bm50 = 9.2; // Nevada
	public $dd_bm51 = 7.1; // Nevada
	public $dd_bm52 = 0; // Nevada
	public $dd_bm53 = 0; // Nevada
	public $dd_bm63 = 0.0785; // Nevada
	public $dd_bm64 = 0.0785; // Nevada
	
	public $dd_bm65 = 1; // Nevada
	public $dd_bm66 = 1; // Nevada
	
	public $dd_bn50 = 0; // New Hampshire
	public $dd_bn51 = 0; // New Hampshire
	public $dd_bn52 = 0; // New Hampshire
	public $dd_bn53 = 0; // New Hampshire
	public $dd_bn63 = 0; // New Hampshire
	public $dd_bn64 = 0; // New Hampshire
	
	public $dd_bo50 = 8.7; // New Jersey
	public $dd_bo51 = 8.3; // New Jersey
	public $dd_bo52 = 7.2; // New Jersey
	public $dd_bo53 = 6.9; // New Jersey
	public $dd_bo63 = 0.07; // New Jersey
	public $dd_bo64 = 0.07; // New Jersey
	
	public $dd_bo65 = 1; // New Jersey
	public $dd_bo66 = 1; // New Jersey
	
	public $dd_bp50 = 0; // New Mexico
	public $dd_bp51 = 0; // New Mexico
	public $dd_bp52 = 0; // New Mexico
	public $dd_bp53 = 0; // New Mexico
	public $dd_bp63 = 0.064; // New Mexico
	public $dd_bp64 = 0.064; // New Mexico
	
	public $dd_bq50 = 8.7; // New York
	public $dd_bq51 = 8.8; // New York
	public $dd_bq52 = 0; // New York
	public $dd_bq53 = 0; // New York
	public $dd_bq63 = 0.0845; // New York
	public $dd_bq64 = 0.0845; // New York
	
	public $dd_bq65 = 1; // New York
	public $dd_bq66 = 1; // New York
	
	public $dd_br50 = 0; // North Carolina
	public $dd_br51 = 0; // North Carolina
	public $dd_br52 = 0; // North Carolina
	public $dd_br53 = 0; // North Carolina
	public $dd_br63 = 0.078; // North Carolina
	public $dd_br64 = 0.078; // North Carolina
	
	public $dd_br65 = .8; // North Carolina
	public $dd_br66 = .8; // North Carolina
	
	public $dd_bs50 = 0; // North Dakota
	public $dd_bs51 = 0; // North Dakota
	public $dd_bs52 = 0; // North Dakota
	public $dd_bs53 = 0; // North Dakota
	public $dd_bs63 = 0.058; // North Dakota
	public $dd_bs64 = 0.058; // North Dakota
	
	public $dd_bs65 = 1; // North Dakota
	public $dd_bs66 = 1; // North Dakota
	
	public $dd_bt50 = 9.9; // Ohio
	public $dd_bt51 = 9; // Ohio
	public $dd_bt52 = 9.2; // Ohio
	public $dd_bt53 = 0; // Ohio
	public $dd_bt63 = 0.068; // Ohio
	public $dd_bt64 = 0.068; // Ohio
	
	public $dd_bt65 = 1; // Ohio
	public $dd_bt66 = 1; // Ohio
	
	public $dd_bu50 = 0; // Oklahoma
	public $dd_bu51 = 0; // Oklahoma
	public $dd_bu52 = 0; // Oklahoma
	public $dd_bu53 = 0; // Oklahoma
	public $dd_bu63 = 0.0815; // Oklahoma
	public $dd_bu64 = 0.0815; // Oklahoma
	
	public $dd_bv50 = 8.7; // Oregon
	public $dd_bv51 = 9.4; // Oregon
	public $dd_bv52 = 8.2; // Oregon
	public $dd_bv53 = 7.8; // Oregon
	public $dd_bv63 = 0; // Oregon
	public $dd_bv64 = 0; // Oregon
	
	public $dd_bv65 = 1; // Oregon
	public $dd_bv66 = 1; // Oregon
	
	public $dd_bw50 = 9.54216867469879; // Pennsylvania
	public $dd_bw51 = 9.54216867469879; // Pennsylvania
	public $dd_bw52 = 0; // Pennsylvania
	public $dd_bw53 = 0; // Pennsylvania
	public $dd_bw63 = 0.064; // Pennsylvania
	public $dd_bw64 = 0.064; // Pennsylvania
	
	public $dd_bx50 = 0; // Rhode Island
	public $dd_bx51 = 0; // Rhode Island
	public $dd_bx52 = 0; // Rhode Island
	public $dd_bx53 = 0; // Rhode Island
	public $dd_bx63 = 0.07; // Rhode Island
	public $dd_bx64 = 0.07; // Rhode Island
	
	public $dd_by50 = 0; // South Caralina
	public $dd_by51 = 0; // South Caralina
	public $dd_by52 = 0; // South Caralina
	public $dd_by53 = 0; // South Caralina
	public $dd_by63 = 0.0705; // South Caralina
	public $dd_by64 = 0.0705; // South Caralina
	
	public $dd_bz50 = 0; // South Dakota
	public $dd_bz51 = 0; // South Dakota
	public $dd_bz52 = 0; // South Dakota
	public $dd_bz53 = 0; // South Dakota
	public $dd_bz63 = 0.055; // South Dakota
	public $dd_bz64 = 0.055; // South Dakota
	
	public $dd_bz65 = 1; // South Dakota
	public $dd_bz66 = .5; // South Dakota
	
	public $dd_ca50 = 0; // Tennessee
	public $dd_ca51 = 0; // Tennessee
	public $dd_ca52 = 0; // Tennessee
	public $dd_ca53 = 0; // Tennessee
	public $dd_ca63 = 0.0945; // Tennessee
	public $dd_ca64 = 0.0945; // Tennessee
	
	public $dd_cb50 = 0; // Texas
	public $dd_cb51 = 0; // Texas
	public $dd_cb52 = 0; // Texas
	public $dd_cb53 = 0; // Texas
	public $dd_cb63 = 0.0805; // Texas
	public $dd_cb64 = 0.0805; // Texas
	
	public $dd_cb65 = 1; // Texas
	
	public $dd_cc50 = 0; // Utah
	public $dd_cc51 = 0; // Utah
	public $dd_cc52 = 0; // Utah
	public $dd_cc53 = 0; // Utah
	public $dd_cc63 = 0.067; // Utah
	public $dd_cc64 = 0.067; // Utah
	
	public $dd_cd50 = 9.4; // Vermont
	public $dd_cd51 = 8.8; // Vermont
	public $dd_cd52 = 0; // Vermont
	public $dd_cd53 = 0; // Vermont
	public $dd_cd63 = 0.0605; // Vermont
	public $dd_cd64 = 0.0605; // Vermont
	
	public $dd_ce50 = 0; // Virginia
	public $dd_ce51 = 0; // Virginia
	public $dd_ce52 = 0; // Virginia
	public $dd_ce53 = 0; // Virginia
	public $dd_ce63 = 0.05; // Virginia
	public $dd_ce64 = 0.05; // Virginia
	
	public $dd_cf50 = 8.9; // Washington
	public $dd_cf51 = 0; // Washington
	public $dd_cf52 = 0; // Washington
	public $dd_cf53 = 0; // Washington
	public $dd_cf63 = 0.0875; // Washington
	public $dd_cf64 = 0.0875; // Washington
	
	public $dd_cg50 = 0; // West Virginia
	public $dd_cg51 = 0; // West Virginia
	public $dd_cg52 = 0; // West Virginia
	public $dd_cg53 = 0; // West Virginia
	public $dd_cg63 = 0.06; // West Virginia
	public $dd_cg64 = 0.06; // West Virginia
	
	public $dd_ch50 = 9.10499806276637; // Wisconsin
	public $dd_ch51 = 9.10499806276637; // Wisconsin
	public $dd_ch52 = 0; // Wisconsin
	public $dd_ch53 = 0; // Wisconsin
	public $dd_ch63 = 0.0545; // Wisconsin
	public $dd_ch64 = 0.0545; // Wisconsin
	
	public $dd_ch65 = 1; // Wisconsin
	
	public $dd_ci50 = 0; // Wyoming
	public $dd_ci51 = 0; // Wyoming
	public $dd_ci52 = 0; // Wyoming
	public $dd_ci53 = 0; // Wyoming
	public $dd_ci63 = 0.0525; // Wyoming
	public $dd_ci64 = 0.0525; // Wyoming
	
	public $dd_cj50 = 8.85172738989017; // Averages
	public $dd_cj51 = 8.53862437520885; // Averages
	public $dd_cj52 = 7.51385371974249; // Averages
	public $dd_cj53 = 7.03104325699746; // Averages
	
	public $dd_cl50 = 2; // Random numbers
	public $dd_cl51 = 5; // Random numbers
	public $dd_cl52 = 10; // Random numbers
	public $dd_cl53 = 30; // Random numbers
	public $dd_cl54 = 100; // Random numbers
	public $dd_cl55 = 250; // Random numbers
	public $dd_cl56 = 500; // Random numbers
	public $dd_cl57 = 750; // Random numbers
	
	public $dd_cm50 = 9.2; // Simple Average
	public $dd_cm51 = 8.4; // Simple Average
	public $dd_cm52 = 8; // Simple Average
	public $dd_cm53 = 7.9; // Simple Average
	public $dd_cm54 = 8; // Simple Average
	public $dd_cm55 = 7.8; // Simple Average
	public $dd_cm56 = 6.9; // Simple Average
	public $dd_cm57 = 6.6; // Simple Average
	public $dd_cm58 = 7.1; // Simple Average
	
	public $dd_n2 = 1; // Random number
	public $dd_n3 = 1; // Random number
	
	public $dd_o2 = 2; // Random number
	public $dd_o3 = 2; // Random number
	
	public $dd_p2 = 3; // Random number
	public $dd_p3 = 3; // Random number
	
	public $dd_q2 = 4; // Random number
	public $dd_q3 = 4; // Random number
	
	public $dd_r2 = 5; // Random number
	public $dd_r3 = 5; // Random number
	
	public $dd_s2 = 6; // Random number
	public $dd_s3 = 6; // Random number

	// ----------------------------------------------------- //
	// ---------------- CALCULATIONS FIELDS ---------------- //
	// ----------------------------------------------------- //

	public $cc_e27 = 27.49; // Construction workers / Installers
	
	public $cc_e29 = 25; // Technicians
	
	public $cc_h7 = .572536092930382; // Mounting (rails, clamps, fittings, etc.)
	public $cc_h8 = .474071478626489; // Modules
	public $cc_h9 = .572536092930382; // Electrical (wire, connectors, breakers, etc.)
	public $cc_h10 = .474071478626489; // Inverter
	
	public $cc_i6 = 'N'; // Manufactured Locally
	
	public $cc_j6 = 'Y'; // Manufactured Locally
	
	public $cc_q36 = 1999; // Random dollar amount
	
	public $cc_m52 = 0; // Government
	
	public $cc_i59 = 'N'; // Manufactured Locally
	
	public $cc_j59 = 'Y'; // Manufactured Locally
	
	public $cc_e75 = 1; // Local Share
	
	public $cc_f75 = .5; // Local Share
	
	public $cc_h96 = 0; // Random Percentage
	
	public $cc_p92 = 0; // Government
	
	public $cc_t92 = 0; // Government
	
	public $cc_d122 = 0; // Agriculture
	public $cc_d123 = 0; // Mining
	public $cc_d124 = 0; // Construction
	public $cc_d125 = 0; // Manufacturing
	public $cc_d126 = 0; // Fabricated Metals
	public $cc_d127 = 0; // Machinery
	
	public $cc_d129 = 0; // TCPU
	
	public $cc_d131 = 0; // Retail Trade
	
	public $cc_d134 = 0; // Professional Services
	
	public $cc_e122 = 0; // Agriculture
	public $cc_e123 = 0; // Mining
	
	public $cc_e127 = 0; // Machinery
	
	public $cc_e129 = 0; // TCPU
	
	public $cc_e131 = 0; // Retail Trade
	public $cc_e132 = 0; // FIRE

	public $cc_c147 = 1; // Year
	public $cc_c148 = 2; // Year
	public $cc_c149 = 3; // Year
	public $cc_c150 = 4; // Year
	public $cc_c151 = 5; // Year
	public $cc_c152 = 6; // Year
	public $cc_c153 = 7; // Year
	public $cc_c154 = 8; // Year
	public $cc_c155 = 9; // Year
	public $cc_c156 = 10; // Year
	public $cc_c157 = 11; // Year
	public $cc_c158 = 12; // Year
	public $cc_c159 = 13; // Year
	public $cc_c160 = 14; // Year
	public $cc_c161 = 15; // Year
	public $cc_c162 = 16; // Year
	public $cc_c163 = 17; // Year
	public $cc_c164 = 18; // Year
	public $cc_c165 = 19; // Year
	public $cc_c166 = 20; // Year
	public $cc_c167 = 21; // Year
	public $cc_c168 = 22; // Year
	public $cc_c169 = 23; // Year
	public $cc_c170 = 24; // Year
	public $cc_c171 = 25; // Year
	public $cc_c172 = 26; // Year
	public $cc_c173 = 27; // Year
	public $cc_c174 = 28; // Year
	public $cc_c175 = 29; // Year
	public $cc_c176 = 30; // Year
	
	public $cc_c183 = 1; // Year
	public $cc_c184 = 2; // Year
	public $cc_c185 = 3; // Year
	public $cc_c186 = 4; // Year
	public $cc_c187 = 5; // Year
	public $cc_c188 = 6; // Year
	public $cc_c189 = 7; // Year
	public $cc_c190 = 8; // Year
	public $cc_c191 = 9; // Year
	public $cc_c192 = 10; // Year
	public $cc_c193 = 11; // Year
	public $cc_c194 = 12; // Year
	public $cc_c195 = 13; // Year
	public $cc_c196 = 14; // Year
	public $cc_c197 = 15; // Year
	public $cc_c198 = 16; // Year
	public $cc_c199 = 17; // Year
	public $cc_c200 = 18; // Year
	public $cc_c201 = 19; // Year
	public $cc_c202 = 20; // Year
	public $cc_c203 = 21; // Year
	public $cc_c204 = 22; // Year
	public $cc_c205 = 23; // Year
	public $cc_c206 = 24; // Year
	public $cc_c207 = 25; // Year
	public $cc_c208 = 26; // Year
	public $cc_c209 = 27; // Year
	public $cc_c210 = 28; // Year
	public $cc_c211 = 29; // Year
	public $cc_c212 = 30; // Year

	// ----------------------------------------------------- //
	// ---------------- DEFLATORS FIELDS ---------------- //
	// ----------------------------------------------------- //
	
	public $df_b12 = 2002; // Year
	public $df_b14 = 2003; // Year
	public $df_b16 = 2004; // Year
	public $df_b18 = 2005; // Year
	public $df_b20 = 2006; // Year
	public $df_b22 = 2007; // Year
	public $df_b24 = 2008; // Year
	public $df_b26 = 2009; // Year
	public $df_b28 = 2010; // Year
	
	public $df_c11 = 1996; // Year
	public $df_c12 = 0.900594325153374; // Value
	public $df_c14 = 0.882739828995584; // Value
	public $df_c16 = 0.860505587103865; // Value
	public $df_c18 = 0.835036885610168; // Value
	public $df_c20 = 0.810053457492671; // Value
	public $df_c22 = 0.790026908846283; // Value
	public $df_c24 = 0.771346469622332; // Value
	public $df_c26 = 0.754194428835193; // Value
	public $df_c28 = 0.738252396668238; // Value
	
	public $df_d11 = 1997; // Year
	public $df_d12 = 0.91631518404908; // Value
	public $df_d14 = 0.898149018133985; // Value
	public $df_d16 = 0.875526653233193; // Value
	public $df_d18 = 0.849613367700649; // Value
	public $df_d20 = 0.824193826521814; // Value
	public $df_d22 = 0.803817692566431; // Value
	public $df_d24 = 0.784811165845649; // Value
	public $df_d26 = 0.767359717427952; // Value
	public $df_d28 = 0.751139399654251; // Value

	public $df_e11 = 1998; // Year
	public $df_e12 = 0.92743481595092; // Value
	public $df_e14 = 0.909048200695293; // Value
	public $df_e16 = 0.886151309763693; // Value
	public $df_e18 = 0.859923562350013; // Value
	public $df_e20 = 0.834195550957062; // Value
	public $df_e22 = 0.813572149344097; // Value
	public $df_e24 = 0.794334975369458; // Value
	public $df_e26 = 0.776671750822831; // Value
	public $df_e28 = 0.76025459688826; // Value
	
	public $df_f11 = 1999; // Year
	public $df_f12 = 0.939608895705522; // Value
	public $df_f14 = 0.920980926430518; // Value
	public $df_f16 = 0.897783476827258; // Value
	public $df_f18 = 0.8712114478713; // Value
	public $df_f20 = 0.84514571477841; // Value
	public $df_f22 = 0.824251597712748; // Value
	public $df_f24 = 0.804761904761905; // Value
	public $df_f26 = 0.786866821867223; // Value
	public $df_f28 = 0.77023416627377; // Value
	
	public $df_g11 = 2000; // Year
	public $df_g12 = 0.958588957055215; // Value
	public $df_g14 = 0.939584703561026; // Value
	public $df_g16 = 0.915918666422422; // Value
	public $df_g18 = 0.888809883565905; // Value
	public $df_g20 = 0.862217623728229; // Value
	public $df_g22 = 0.840901446350488; // Value
	public $df_g24 = 0.821018062397373; // Value
	public $df_g26 = 0.802761499558481; // Value
	public $df_g28 = 0.785792865000786; // Value
	
	public $df_h11 = 2001; // Year
	public $df_h12 = 0.981211656441718; // Value
	public $df_h14 = 0.961758902565066; // Value
	public $df_h16 = 0.937534346949991; // Value
	public $df_h18 = 0.909785796818061; // Value
	public $df_h20 = 0.882565959648215; // Value
	public $df_h22 = 0.860746720484359; // Value
	public $df_h24 = 0.840394088669951; // Value
	public $df_h26 = 0.821706670948061; // Value
	public $df_h28 = 0.804337576614804; // Value
	
	public $df_i11 = 2002; // Year
	public $df_i12 = 1; // Value
	public $df_i14 = 0.980174762754862; // Value
	public $df_i16 = 0.95548635281187; // Value
	public $df_i18 = 0.927206470535952; // Value
	public $df_i20 = 0.899465425073288; // Value
	public $df_i22 = 0.877228388832829; // Value
	public $df_i24 = 0.856486042692939; // Value
	public $df_i26 = 0.837440796339407; // Value
	public $df_i28 = 0.81973911676882; // Value
	
	public $df_j11 = 2003; // Year
	public $df_j12 = 1.02022622699387; // Value
	public $df_j14 = 1; // Value
	public $df_j16 = 0.974812236673383; // Value
	public $df_j18 = 0.945960359079193; // Value
	public $df_j20 = 0.917658216933954; // Value
	public $df_j22 = 0.894971409350824; // Value
	public $df_j24 = 0.873809523809524; // Value
	public $df_j26 = 0.854379063980092; // Value
	public $df_j28 = 0.836319346220336; // Value
	
	public $df_k11 = 2004; // Year
	public $df_k12 = 1.04658742331288; // Value
	public $df_k14 = 1.02583857934793; // Value
	public $df_k16 = 1; // Value
	public $df_k18 = 0.970402630877255; // Value
	public $df_k20 = 0.941369201586481; // Value
	public $df_k22 = 0.918096199125463; // Value
	public $df_k24 = 0.896387520525452; // Value
	public $df_k26 = 0.87645500521795; // Value
	public $df_k28 = 0.857928650007858; // Value
	              
	public $df_l11 = 2005; // Year
	public $df_l12 = 1.07850843558282; // Value
	public $df_l14 = 1.05712674997651; // Value
	public $df_l16 = 1.03050009159187; // Value
	public $df_l18 = 1; // Value
	public $df_l20 = 0.97008104845663; // Value
	public $df_l22 = 0.946098217288934; // Value
	public $df_l24 = 0.923727422003284; // Value
	public $df_l26 = 0.903186963153247; // Value
	public $df_l28 = 0.884095552412384; // Value
	              
	public $df_m11 = 2006; // Year
	public $df_m12 = 1.11177147239264; // Value
	public $df_m14 = 1.08973033919008; // Value
	public $df_m16 = 1.06228246931672; // Value
	public $df_m18 = 1.03084170295974; // Value
	public $df_m20 = 1; // Value
	public $df_m22 = 0.975277497477296; // Value
	public $df_m24 = 0.952216748768473; // Value
	public $df_m26 = 0.931042787187926; // Value
	public $df_m28 = 0.911362564827911; // Value
	              
	public $df_n11 = 2007; // Year
	public $df_n12 = 1.13995398773006; // Value
	public $df_n14 = 1.11735412947477; // Value
	public $df_n16 = 1.08921047810954; // Value
	public $df_n18 = 1.05697271353657; // Value
	public $df_n20 = 1.02534919813761; // Value
	public $df_n22 = 1; // Value
	public $df_n24 = 0.976354679802956; // Value
	public $df_n26 = 0.954643975274946; // Value
	public $df_n28 = 0.934464875058934; // Value
	
	public $df_o11 = 2008; // Year
	public $df_o12 = 1.16756134969325; // Value
	public $df_o14 = 1.14441416893733; // Value
	public $df_o16 = 1.11558893570251; // Value
	public $df_o18 = 1.08257043818327; // Value
	public $df_o20 = 1.05018106570098; // Value
	public $df_o22 = 1.02421796165489; // Value
	public $df_o24 = 1; // Value
	public $df_o26 = 0.97776350646223; // Value
	public $df_o28 = 0.957095709570957; // Value
	              
	public $df_p11 = 2009; // Year
	public $df_p12 = 1.19411426380368; // Value
	public $df_p14 = 1.17044066522597; // Value
	public $df_p16 = 1.14095988276241; // Value
	public $df_p18 = 1.10719047195805; // Value
	public $df_p20 = 1.07406449387825; // Value
	public $df_p22 = 1.0475109317188; // Value
	public $df_p24 = 1.02274220032841; // Value
	public $df_p26 = 1; // Value
	public $df_p28 = 0.978862171931479; // Value
	              
	public $df_q11 = 2010; // Year
	public $df_q12 = 1.21990030674847; // Value
	public $df_q14 = 1.19571549375176; // Value
	public $df_q16 = 1.16559809488917; // Value
	public $df_q18 = 1.13109945782597; // Value
	public $df_q20 = 1.09725814795654; // Value
	public $df_q22 = 1.07013118062563; // Value
	public $df_q24 = 1.0448275862069; // Value
	public $df_q26 = 1.02159428433812; // Value
	public $df_q28 = 1; // Value
	              
	public $df_r11 = 2011; // Year
	public $df_r12 = 1.24501533742331; // Value
	public $df_r14 = 1.22033261298506; // Value
	public $df_r16 = 1.18959516394944; // Value
	public $df_r18 = 1.1543862767754; // Value
	public $df_r20 = 1.11984824969822; // Value
	public $df_r22 = 1.09216279852001; // Value
	public $df_r24 = 1.06633825944171; // Value
	public $df_r26 = 1.04262663562656; // Value
	public $df_r28 = 1.02058777306302; // Value
	
	public $df_s11 = 2012; // Year
	public $df_s12 = 1.26984279141104; // Value
	public $df_s14 = 1.24466785680729; // Value
	public $df_s16 = 1.21331745740978; // Value
	public $df_s18 = 1.17740645275975; // Value
	public $df_s20 = 1.14217968615279; // Value
	public $df_s22 = 1.11394214598049; // Value
	public $df_s24 = 1.0876026272578; // Value
	public $df_s26 = 1.06341815846512; // Value
	public $df_s28 = 1.04093980826654; // Value
	              
	public $df_t11 = 2013; // Year
	public $df_t12 = 1.30530555341556; // Value
	public $df_t14 = 1.2794275611417; // Value
	public $df_t16 = 1.24720164253811; // Value
	public $df_t18 = 1.21028775515342; // Value
	public $df_t20 = 1.17407721445345; // Value
	public $df_t22 = 1.14505108755727; // Value
	public $df_t24 = 1.11797598795001; // Value
	public $df_t26 = 1.09311612211857; // Value
	public $df_t28 = 1.0700100214703; // Value
	              
	public $df_u11 = 2014; // Year
	public $df_u12 = 1.34175868013096; // Value
	public $df_u14 = 1.31515799597164; // Value
	public $df_u16 = 1.282032107632; // Value
	public $df_u18 = 1.2440873301152; // Value
	public $df_u20 = 1.20686554156977; // Value
	public $df_u22 = 1.17702880517374; // Value
	public $df_u24 = 1.14919758219427; // Value
	public $df_u26 = 1.12364345758418; // Value
	public $df_u28 = 1.09989207536745; // Value
	              
	public $df_v11 = 2015; // Year
	public $df_v12 = 1.37922982936519; // Value
	public $df_v14 = 1.35188627078245; // Value
	public $df_v16 = 1.31783527934948; // Value
	public $df_v18 = 1.2788308221436; // Value
	public $df_v20 = 1.24056954474372; // Value
	public $df_v22 = 1.2098995610442; // Value
	public $df_v24 = 1.18129109851705; // Value
	public $df_v26 = 1.15502332663865; // Value
	public $df_v28 = 1.13060864214503; // Value
	
	public $df_w11 = 2016; // Year
	public $df_w12 = 1.41774743132279; // Value
	public $df_w14 = 1.38964025214313; // Value
	public $df_w16 = 1.35463832236301; // Value
	public $df_w18 = 1.31454459190822; // Value
	public $df_w20 = 1.27521479596132; // Value
	public $df_w22 = 1.24368829495117; // Value
	public $df_w24 = 1.21428088699174; // Value
	public $df_w26 = 1.18727953789511; // Value
	public $df_w28 = 1.16218302715381; // Value
	              
	public $df_x11 = 2017; // Year
	public $df_x12 = 1.45734071017556; // Value
	public $df_x14 = 1.42844858484933; // Value
	public $df_x16 = 1.3924691599699; // Value
	public $df_x18 = 1.35125573625024; // Value
	public $df_x20 = 1.31082758135467; // Value
	public $df_x22 = 1.27842064316779; // Value
	public $df_x24 = 1.24819197771358; // Value
	public $df_x26 = 1.22043656486726; // Value
	public $df_x28 = 1.19463918659056; // Value
	              
	public $df_y11 = 2018; // Year
	public $df_y12 = 1.49803970623555; // Value
	public $df_y14 = 1.46834071365679; // Value
	public $df_y16 = 1.43135649527837; // Value
	public $df_y18 = 1.38899210874138; // Value
	public $df_y20 = 1.34743492114582; // Value
	public $df_y22 = 1.31412295790861; // Value
	public $df_y24 = 1.28305009979058; // Value
	public $df_y26 = 1.25451956453795; // Value
	public $df_y28 = 1.22800174567415; // Value
	              
	public $df_z11 = 2019; // Year
	public $df_z12 = 1.53987529874736; // Value
	public $df_z14 = 1.50934690562177; // Value
	public $df_z16 = 1.47132983298521; // Value
	public $df_z18 = 1.42778234081704; // Value
	public $df_z20 = 1.38506459014766; // Value
	public $df_z22 = 1.35082232732362; // Value
	public $df_z24 = 1.31888170086474; // Value
	public $df_z26 = 1.28955439644638; // Value
	public $df_z28 = 1.26229601732929; // Value
	
	public $df_aa11 = 2020; // Year
	public $df_aa12 = 1.58287922931693; // Value
	public $df_aa14 = 1.55149827306532; // Value
	public $df_aa16 = 1.5124195017617; // Value
	public $df_aa18 = 1.46765586349962; // Value
	public $df_aa20 = 1.42374513883723; // Value
	public $df_aa22 = 1.38854659605064; // Value
	public $df_aa24 = 1.35571396717851; // Value
	public $df_aa26 = 1.32556764230828; // Value
	public $df_aa28 = 1.29754802139197; // Value
	               
	public $df_ab11 = 2021; // Year
	public $df_ab12 = 1.62708412599456; // Value
	public $df_ab14 = 1.59482679717892; // Value
	public $df_ab16 = 1.55465667726463; // Value
	public $df_ab18 = 1.50864292972849; // Value
	public $df_ab20 = 1.4635059150177; // Value
	public $df_ab22 = 1.42732438634168; // Value
	public $df_ab24 = 1.39357484420158; // Value
	public $df_ab26 = 1.36258662618409; // Value
	public $df_ab28 = 1.33378450435135; // Value
	               
	public $df_ac11 = 2022; // Year
	public $df_ac12 = 1.67252352803058; // Value
	public $df_ac14 = 1.6393653522893; // Value
	public $df_ac16 = 1.59807340578998; // Value
	public $df_ac18 = 1.55077463731357; // Value
	public $df_ac20 = 1.5043770860851; // Value
	public $df_ac22 = 1.46718511977926; // Value
	public $df_ac24 = 1.43249305783374; // Value
	public $df_ac26 = 1.40063943521032; // Value
	public $df_ac28 = 1.37103295964286; // Value
	               
	public $df_ad11 = 2023; // Year
	public $df_ad12 = 1.71923191132233; // Value
	public $df_ad14 = 1.68514773080095; // Value
	public $df_ad16 = 1.64270262858716; // Value
	public $df_ad18 = 1.59408295252996; // Value
	public $df_ad20 = 1.5463896619171; // Value
	public $df_ad22 = 1.50815903959927; // Value
	public $df_ad24 = 1.47249813619988; // Value
	public $df_ad26 = 1.4397549409099; // Value
	public $df_ad28 = 1.40932164850814; // Value
	
	public $df_ae11 = 2024; // Year
	public $df_ae12 = 1.76724471457181; // Value
	public $df_ae14 = 1.73220866883521; // Value
	public $df_ae16 = 1.68857820685227; // Value
	public $df_ae18 = 1.63860073437145; // Value
	public $df_ae20 = 1.58957551840086; // Value
	public $df_ae22 = 1.55027723363716; // Value
	public $df_ae24 = 1.51362043205362; // Value
	public $df_ae26 = 1.47996282109763; // Value
	public $df_ae28 = 1.44867962143746; // Value
	               
	public $df_af11 = 2025; // Year
	public $df_af12 = 1.8165983661738; // Value
	public $df_af14 = 1.78058387258527; // Value
	public $df_af16 = 1.7357349474194; // Value
	public $df_af18 = 1.68436175948138; // Value
	public $df_af20 = 1.63396742161796; // Value
	public $df_af22 = 1.59357165791499; // Value
	public $df_af24 = 1.55589114580665; // Value
	public $df_af26 = 1.52129358239745; // Value
	public $df_af28 = 1.48913674021099; // Value
	               
	public $df_ag11 = 2026; // Year
	public $df_ag12 = 1.8673303118549; // Value
	public $df_ag14 = 1.83031004540734; // Value
	public $df_ag16 = 1.78420862916929; // Value
	public $df_ag18 = 1.73140074777978; // Value
	public $df_ag20 = 1.67959905270481; // Value
	public $df_ag22 = 1.63807516088718; // Value
	public $df_ag24 = 1.59934234920118; // Value
	public $df_ag26 = 1.56377858338848; // Value
	public $df_ag28 = 1.53072370055558; // Value
	               
	public $df_ah11 = 2027; // Year
	public $df_ah12 = 1.91947904308449; // Value
	public $df_ah14 = 1.88142491566827; // Value
	public $df_ah16 = 1.83403603017562; // Value
	public $df_ah18 = 1.7797533888061; // Value
	public $df_ah20 = 1.72650503340726; // Value
	public $df_ah22 = 1.68382150836339; // Value
	public $df_ah24 = 1.64400700964347; // Value
	public $df_ah26 = 1.60745005839748; // Value
	public $df_ah28 = 1.57347205543434; // Value
	
	public $df_ai11 = 2028; // Year
	public $df_ai12 = 1.97308412627902; // Value
	public $df_ai14 = 1.93396726537092; // Value
	public $df_ai16 = 1.88525495560933; // Value
	public $df_ai18 = 1.82945636879768; // Value
	public $df_ai20 = 1.77472095234891; // Value
	public $df_ai22 = 1.73084540912737; // Value
	public $df_ai24 = 1.68991901521697; // Value
	public $df_ai26 = 1.65234114195574; // Value
	public $df_ai28 = 1.61741423898654; // Value
	               
	public $df_aj11 = 2029; // Year
	public $df_aj12 = 2.02818623282196; // Value
	public $df_aj14 = 1.98797695957894; // Value
	public $df_aj16 = 1.9379042664223; // Value
	public $df_aj18 = 1.88054739852446; // Value
	public $df_aj20 = 1.82428339203299; // Value
	public $df_aj22 = 1.77918254127133; // Value
	public $df_aj24 = 1.73711320039398; // Value
	public $df_aj26 = 1.69848589393904; // Value
	public $df_aj28 = 1.66258359113615; // Value
	
	public $df_ak11 = 2030; // Year
	public $df_ak12 = 2.08482716992211; // Value
	public $df_ak14 = 2.0434949766633; // Value
	public $df_ak16 = 1.99202390883197; // Value
	public $df_ak18 = 1.93306524190094; // Value
	public $df_ak20 = 1.87522995659833; // Value
	public $df_ak22 = 1.82886957926568; // Value
	public $df_ak24 = 1.78562537246531; // Value
	public $df_ak26 = 1.74591932540961; // Value
	public $df_ak28 = 1.70901438288759; // Value
	
	public $df_al11 = 2031; // Year
	public $df_al12 = 2.14304991233366; // Value
	public $df_al14 = 2.10056343939348; // Value
	public $df_al16 = 2.04765494462949; // Value
	public $df_al18 = 1.98704974539728; // Value
	public $df_al20 = 1.92759930035047; // Value
	public $df_al22 = 1.87994422178479; // Value
	public $df_al24 = 1.83549233870811; // Value
	public $df_al26 = 1.7946774251798; // Value
	public $df_al28 = 1.75674184232789; // Value
	
	public $df_b39 = .0279268916155419; // Random Percentage
	
	public $df_d41 = 2002; // Random numbers
	public $df_d42 = 2; // Random numbers
	public $df_d43 = 3; // Random numbers
	
	public $df_e41 = 2003; // Random numbers
	public $df_e42 = 4; // Random numbers
	public $df_e43 = 5; // Random numbers
	
	public $df_f41 = 2004; // Random numbers
	public $df_f42 = 6; // Random numbers
	public $df_f43 = 7; // Random numbers
	
	public $df_g41 = 2005; // Random numbers
	public $df_g42 = 8; // Random numbers
	public $df_g43 = 9; // Random numbers
	
	public $df_h41 = 2006; // Random numbers
	public $df_h42 = 10; // Random numbers
	public $df_h43 = 11; // Random numbers
	
	public $df_i41 = 2007; // Random numbers
	public $df_i42 = 12; // Random numbers
	public $df_i43 = 13; // Random numbers
	
	public $df_j41 = 2008; // Random numbers
	public $df_j42 = 14; // Random numbers
	public $df_j43 = 15; // Random numbers
	
	public $df_k41 = 2009; // Random numbers
	public $df_k42 = 16; // Random numbers
	public $df_k43 = 17; // Random numbers
	
	public $df_l41 = 2010; // Random numbers
	public $df_l42 = 18; // Random numbers
	public $df_l43 = 19; // Random numbers
}
class ProjectData extends pvj {
	public function test() {
		$pd_b17 = $this->dd_ah15;
		echo $pd_b17.'<br />';
		echo 'This is df_j42: '.$this->df_j42.'<br />';
		$newVal = $this->df_j42 + $this->df_k42;
		return $newVal;
	}
}
$pvj = new pvj();
$pd = new ProjectData();
echo $pvj->pd_b13.'<br />';
echo $pd->test();
?>



















