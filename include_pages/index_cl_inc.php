<?php include("include_pages/boxex_inc.php"); ?>
<div id="header">
	<?php include("include_pages/menues_inc.php"); ?>
</div>
<div class="breadCrumb">
	<?php include("include_pages/search_frm_inc.php"); ?>
</div>
<div id="page-wrap">
	<div id="right-sidebar">
		<?php include("include_pages/right-boxes_inc.php"); ?>
	</div>
	<div id="main-content">
			<?php include("include_pages/menu_boxs_inc.php"); ?>
	<?php switch($action){
					case'search':
						include("include_pages/searches_inc.php");
					break;
					case'details':
						include("include_pages/search_detail_inc.php");
					break;
					case'profile':
						include("include_pages/profile_inc.php");
					break;	
					case'billing':
						include("include_pages/billing_inc.php");
					break;								
					case'support':
						include("include_pages/support_inc.php");
					break;	
					case'alerts':
						include("include_pages/alerts_inc.php");
					break;
					case'screening':
						include("include_pages/screening_inc.php");
					break;		
					case'orderacase':
						include("include_pages/orderacase_inc.php");
					break;																																		
					case'orderhistory':
					case'ordercloses':
					case'saveorders':
					include('include_pages/cases_cl_inc.php');
					break;	
					case'dashboard':
						include("include_pages/dashboard_inc.php");
					break;
					case'orderquotes':
						include("include_pages/quotes_cl_inc.php");
					break;						
					case'noAccess':
						include("include_pages/access_inc.php");
					break;												
					default:
						include("include_pages/index_inc.php");
					break;			
			} ?>
	</div>
	<div class="clear"></div>
</div>
<?php include('include_pages/user_tools_inc.php'); ?>
<div class="clear"></div>