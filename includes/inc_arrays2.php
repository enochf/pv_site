<?php
// =================== GENERAL ARRAYS =================== //
// $states = array('AL'=>'Alabama','AK'=>'Alaska','AZ'=>'Arizona','AR'=>'Arkansas','CA'=>'California','CO'=>'Colorado','CT'=>'Connecticut','DE'=>'Delaware','DC'=>'District Of Columbia','FL'=>'Florida','GA'=>'Georgia','HI'=>'Hawaii','ID'=>'Idaho','IL'=>'Illinois','IN'=>'Indiana','IA'=>'Iowa','KS'=>'Kansas','KY'=>'Kentucky','LA'=>'Louisiana','ME'=>'Maine','MD'=>'Maryland','MA'=>'Massachusetts','MI'=>'Michigan','MN'=>'Minnesota','MS'=>'Mississippi','MO'=>'Missouri','MT'=>'Montana','NE'=>'Nebraska','NV'=>'Nevada','NH'=>'New Hampshire','NJ'=>'New Jersey','NM'=>'New Mexico','NY'=>'New York','NC'=>'North Carolina','ND'=>'North Dakota','OH'=>'Ohio','OK'=>'Oklahoma','OR'=>'Oregon','PA'=>'Pennsylvania','RI'=>'Rhode Island','SC'=>'South Carolina','SD'=>'South Dakota','TN'=>'Tennessee','TX'=>'Texas','UT'=>'Utah','VT'=>'Vermont','VA'=>'Virginia','WA'=>'Washington','WV'=>'West Virginia','WI'=>'Wisconsin','WY'=>'Wyoming');
$regions = array('REGION1'=>'Region 1 - Northeast','REGION2'=>'Region 2 - Mid-Atlantic North','REGION3'=>'Region 3 - Mid-Atlantic South','REGION4'=>'Region 4 - Southeast','REGION5'=>'Region 5 - Midwest','REGION6'=>'Region 6 - Southern','REGION7'=>'Region 7 - Western','REGION8'=>'Region 8 - California &amp; Hawaii');
$months = array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
$letters = array(
	'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
	'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ',
	'BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ',
	'CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ',
	'DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ',
	'EA','EB','EC','ED','EE','EF','EG','EH','EI','EJ','EK','EL','EM','EN','EO','EP','EQ','ER','ES','ET','EU','EV','EW','EX','EY','EZ',
	'FA','FB','FC','FD','FE','FF','FG','FH','FI','FJ','FK','FL','FM','FN','FO','FP','FQ','FR','FS','FT','FU','FV','FW','FX','FY','FZ',
	'GA','GB','GC','GD','GE','GF','GG','GH','GI','GJ','GK','GL','GM','GN','GO','GP','GQ','GR','GS','GT','GU','GV','GW','GX','GY','GZ',
	'HA','HB','HC','HD','HE','HF','HG','HH','HI','HJ','HK','HL','HM','HN','HO','HP','HQ','HR','HS','HT','HU','HV','HW','HX','HY','HZ',
	'IA','IB','IC','ID','IE','IF','IG','IH','II','IJ','IK','IL','IM','IN','IO','IP','IQ','IR','IS','IT','IU','IV','IW','IX','IY','IZ',
	'JA','JB','JC','JD','JE','JF','JG','JH','JI','JJ','JK','JL','JM','JN','JO','JP','JQ','JR','JS','JT','JU','JV','JW','JX','JY','JZ',
	'KA','KB','KC','KD','KE','KF','KG','KH','KI','KJ','KK','KL','KM','KN','KO','KP','KQ','KR','KS','KT','KU','KV','KW','KX','KY','KZ',
	'LA','LB','LC','LD','LE','LF','LG','LH','LI','LJ','LK','LL','LM','LN','LO','LP','LQ','LR','LS','LT','LU','LV','LW','LX','LY','LZ',
	'MA','MB','MC','MD','ME','MF','MG','MH','MI','MJ','MK','ML','MM','MN','MO','MP','MQ','MR','MS','MT','MU','MV','MW','MX','MY','MZ',
	'NA','NB','NC','ND','NE','NF','NG','NH','NI','NJ','NK','NL','NM','NN','NO','NP','NQ','NR','NS','NT','NU','NV','NW','NX','NY','NZ',
	'OA','OB','OC','OD','OE','OF','OG','OH','OI','OJ','OK','OL','OM','ON','OO','OP','OQ','OR','OS','OT','OU','OV','OW','OX','OY','OZ',
	'PA','PB','PC','PD','PE','PF','PG','PH','PI','PJ','PK','PL','PM','PN','PO','PP','PQ','PR','PS','PT','PU','PV','PW','PX','PY','PZ',
	'QA','QB','QC','QD','QE','QF','QG','QH','QI','QJ','QK','QL','QM','QN','QO','QP','QQ','QR','QS','QT','QU','QV','QW','QX','QY','QZ',
	'RA','RB','RC','RD','RE','RF','RG','RH','RI','RJ','RK','RL','RM','RN','RO','RP','RQ','RR','RS','RT','RU','RV','RW','RX','RY','RZ',
	'SA','SB','SC','SD','SE','SF','SG','SH','SI','SJ','SK','SL','SM','SN','SO','SP','SQ','SR','SS','ST','SU','SV','SW','SX','SY','SZ',
	'TA','TB','TC','TD','TE','TF','TG','TH','TI','TJ','TK','TL','TM','TN','TO','TP','TQ','TR','TS','TT','TU','TV','TW','TX','TY','TZ',
	'UA','UB','UC','UD','UE','UF','UG','UH','UI','UJ','UK','UL','UM','UN','UO','UP','UQ','UR','US','UT','UU','UV','UW','UX','UY','UZ',
	'VA','VB','VC','VD','VE','VF','VG','VH','VI','VJ','VK','VL','VM','VN','VO','VP','VQ','VR','VS','VT','VU','VV','VW','VX','VY','VZ',
	'WA','WB','WC','WD','WE','WF','WG','WH','WI','WJ','WK','WL','WM','WN','WO','WP','WQ','WR','WS','WT','WU','WV','WW','WX','WY','WZ',
	'XA','XB','XC','XD','XE','XF','XG','XH','XI','XJ','XK','XL','XM','XN','XO','XP','XQ','XR','XS','XT','XU','XV','XW','XX','XY','XZ',
	'YA','YB','YC','YD','YE','YF','YG','YH','YI','YJ','YK','YL','YM','YN','YO','YP','YQ','YR','YS','YT','YU','YV','YW','YX','YY','YZ',
	'ZA','ZB','ZC','ZD','ZE','ZF','ZG','ZH','ZI','ZJ','ZK','ZL','ZM','ZN','ZO','ZP','ZQ','ZR','ZS','ZT','ZU','ZV','ZW','ZX','ZY','ZZ'
);
$operators = array('+','-','*','/','<=','>=','=','<','>',);
// =================== DATASET ARRAYS =================== //
$systemApp = array('RN'=>'Residential New Construction','RR'=>'Residential Retrofit','SC'=>'Small Commercial','LC'=>'Large Commercial','UT'=>'Utility');
$solarMat = array('TF'=>'Thin Film','CS'=>'Crystalline Silicon');
$systemTrack = array('FM'=>'Fixed Mount','SA'=>'Single Axis');
$sectors = array('Ag, Forestry, Fish & Hunting','Mining','Construction','Construction/Installations - Non Residential','Construction/Installation Residential','Manufacturing','Fabricated Metals','Machinery','Electrical Equip','Battery Manufacturing','Energy Wire Manufacturing','Wholesale Trade','Retail trade','TCPU','Insurance and Real Estate','Finance','Other Professional Services','Office Services','Architectural and Engineering Services','Other services','Government','Semiconductor (solar cell/module) manufacturing');
// =================== INPUTS/OUTPUTS ARRAYS =================== //
$inputs = array(
	'pdd_project_location' 							=> 'ProjectData_B12',
	'pdd_population'	 							=> 'ProjectData_B13',
	'pdd_year_construction_installation'			=> 'ProjectData_B14',
	'pdd_system_application'						=> 'ProjectData_B15',
	'pdd_solar_cell_module_material'				=> 'ProjectData_B16',
	'pdd_system_tracking'							=> 'ProjectData_B17',
	'pdd_average_system_size'						=> 'ProjectData_B18',
	'pdd_number_systems_installed'					=> 'ProjectData_B19',
	'pdd_base_installed_system_cost'				=> 'ProjectData_B22',
	'pdd_annual_direct_operations_maintenance_cost'	=> 'ProjectData_B23',
	'pdd_money_value'								=> 'ProjectData_B24',
	'pdd_custom_cost_data'							=> 'ProjectData_B26',
	'pcd_me_mounting_r2'							=> 'ProjectData_C33',
	'pcd_me_mounting_r4'							=> 'ProjectData_E33',
	'pcd_me_mounting_r5'							=> 'ProjectData_F33',
	'pcd_me_modules_r2'								=> 'ProjectData_C34',
	'pcd_me_modules_r4'								=> 'ProjectData_E34',
	'pcd_me_modules_r5'								=> 'ProjectData_F34',
	'pcd_me_Electrical_r2'							=> 'ProjectData_C35',
	'pcd_me_Electrical_r4'							=> 'ProjectData_E35',
	'pcd_me_Electrical_r5'							=> 'ProjectData_F35',
	'pcd_me_inverter_r2'							=> 'ProjectData_C36',
	'pcd_me_inverter_r4'							=> 'ProjectData_E36',
	'pcd_me_inverter_r5'							=> 'ProjectData_F36',
	'pcd_oc_installation_r2'						=> 'ProjectData_C39',
	'pcd_oc_installation_r4'						=> 'ProjectData_E39',
	'pcd_oc_permitting_r2'							=> 'ProjectData_C43',
	'pcd_oc_permitting_r4'							=> 'ProjectData_E43',
	'pcd_oc_other_costs_r2'							=> 'ProjectData_C44',
	'pcd_oc_other_costs_r4'							=> 'ProjectData_E44',
	'pcd_oc_business_overhead_r2'					=> 'ProjectData_C45',
	'pcd_oc_business_overhead_r4'					=> 'ProjectData_E45',
	'pcd_sales_tax'									=> 'ProjectData_B48',
	'pvsaomc_l_technicians_r2'						=> 'ProjectData_C54',
	'pvsaomc_l_technicians_r4'						=> 'ProjectData_E54',
	'pvsaomc_ms_materials_equipment_r2'				=> 'ProjectData_C58',
	'pvsaomc_ms_materials_equipment_r4'				=> 'ProjectData_E58',
	'pvsaomc_ms_materials_equipment_r5'				=> 'ProjectData_F58',
	'pvsaomc_ms_services_r2'						=> 'ProjectData_C59',
	'pvsaomc_ms_services_r4'						=> 'ProjectData_E59',
	'pvsaomc_sales_tax'								=> 'ProjectData_B61',
	'op_df_percentage_financed_r1'					=> 'ProjectData_B67',
	'op_df_percentage_financed_r3'					=> 'ProjectData_D67',
	'op_df_years_financed_r1'						=> 'ProjectData_B68',
	'op_df_interest_rate_r1'						=> 'ProjectData_B69',
	'op_tp_local_property_tax_percent_r1'			=> 'ProjectData_B71',
	'op_tp_assessed_value_r1'						=> 'ProjectData_B72',
	'op_tp_taxable_value_percent_r1'				=> 'ProjectData_B73',
	'op_tp_taxable_value_r1'						=> 'ProjectData_B74',
	'op_tp_property_tax_exemption_r1'				=> 'ProjectData_B75',
	'op_tp_local_property_tax_r1'					=> 'ProjectData_B76',
	'op_tp_local_property_tax_r3'					=> 'ProjectData_D76',
	'op_tp_local_sales_tax_rate_r1'					=> 'ProjectData_B77',
	'op_tp_local_sales_tax_rate_r3'					=> 'ProjectData_D77',
	'op_tp_sales_tax_exemption_r1'					=> 'ProjectData_B78',
	'op_pp_contstruction_workers_installers_r1'		=> 'ProjectData_B81',
	'op_pp_contstruction_workers_installers_r3'		=> 'ProjectData_D81',
	'op_pp_technicians_r1'							=> 'ProjectData_B83',
	'op_pp_technicians_r3'							=> 'ProjectData_D83',
	'addin_my_county_name'							=> 'UserAddInLocation_B3',
	'addin_my_region_name'							=> 'UserAddInLocation_B4',
	'addin_sales_tax_rate'							=> 'UserAddInLocation_B5',
	'addin_sales_tax_exemption'						=> 'UserAddInLocation_B6',
	'addin_property_tax_exemption'					=> 'UserAddInLocation_B7',
	'addin_mycounty_year_of_data'					=> 'UserAddInLocation_D3',
	'addin_myregion_year_of_data'					=> 'UserAddInLocation_D4'
)
























?>