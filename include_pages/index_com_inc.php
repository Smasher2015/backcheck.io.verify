<section role="main">
	<div>
		<?php include("widget.php"); ?>
        <?php include("include_pages/search_inc.php");?>
       	<div class="clear"></div>
    </div>
	<?php
	$_REQUEST['status'] = $action;
	switch($action){	
		case'dashboard':
			include("include_pages/dashboard_com_inc.php");
		break;
		case'wip':		
		case'close':
		case'attention':
		case'alert':
		case'notyet':
			include("include_pages/assign_cases_inc.php");				
		break;
		case'details':
			include("include_pages/details_inc.php");
		break;
		case'start':
			include("include_pages/start_inc.php");
		break;																				
		default:
			include("include_pages/access_inc.php");		
		break;
	}
	?>
</section>
<?php include("right.php"); ?>