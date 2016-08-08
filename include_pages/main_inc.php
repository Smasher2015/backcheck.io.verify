<?php include('include_pages/header_inc.php'); 
	if($action=='') $action='index';
?> 
    <div class="content bradius <?php if($action=='index') echo 'contentBg';?>" id="content">
<?php
        switch($action){
					case 'screening':	
						include('include_pages/screening_inc.php');
					break;
					case 'package':
						include('include_pages/package_inc.php');
					break;
					case 'index':
						include('include_pages/index_inc.php');
					break;
					case 'profile':
						include('include_pages/profile_inc.php');
					break;		
					case 'orders':
					case 'close':
						include('include_pages/cases_cl_inc.php');
					break;	
					case 'billing':
						include('include_pages/billing_inc.php');
					break;												
					default:
						include('include_pages/access_inc.php');
					break;					
		}
?>
		<div class="clear"></div>
    </div>
<div class="clear"></div>
<?php include('include_pages/footer_inc.php'); ?>