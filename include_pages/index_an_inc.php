<section role="main">
	<div style="min-height:170px;">
		<?php include("widget.php"); ?>
        <?php include("include_pages/search_inc.php");?>
       	<div class="clear"></div>
    </div>
	<?php
	if($_REQUEST['CNT']==1){
		if($_REQUEST['ERR']!='') echo $_REQUEST['ERR'];
		if($_REQUEST['SCS']!='') echo $_REQUEST['SCS'];
	}
	$_REQUEST['status'] = $action;
	switch($action){	
		case'details':
			include("include_pages/details_inc.php");
		break;
		case'company':
			include("include_pages/company_ad_inc.php");
		break;
		case'project':
			include("include_pages/project_inc.php");
		break;		
		case'start':
			include("include_pages/start_inc.php");
		break;
		case'case':
			include("include_pages/add_case_inc.php");
		break;	
		case'unies':
			include("include_pages/add_unies_inc.php");
		break;		
		case'dashboard':
			include("include_pages/dashboard_op_inc.php");
		break;		
		case'noAccess':
			include("include_pages/access_inc.php");
		break;													
		default:
			include("include_pages/assign_cases_inc.php");			
		break;
	}
	?>
</section>
<?php include("right.php"); ?>