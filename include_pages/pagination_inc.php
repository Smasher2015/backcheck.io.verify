<?php
if(!isset($_REQUEST['sort'])) $_REQUEST['sort']=''; 
switch($_REQUEST['sort']){
		case 'emp':
			if($_REQUEST['o']=='d'){
				$sort = "ORDER BY d.emp_id DESC";
			}else{
				$sort = "ORDER BY d.emp_id";	
			}
		break;
		case 'enm':
			if($_REQUEST['o']=='d'){
				$sort = "ORDER BY d.v_name DESC";
			}else{
				$sort = "ORDER BY d.v_name";	
			}
		break;																							
		case 'nic':
			if($_REQUEST['o']=='d'){
				$sort = "ORDER BY d.v_nic DESC";
			}else{
				$sort = "ORDER BY d.v_nic";	
			}											
		break;		
		case 'fnm':
			if($_REQUEST['o']=='d'){
				$sort = "ORDER BY d.v_ftname DESC";
			}else{
				$sort = "ORDER BY d.v_ftname";	
			}											
		break;
		case 'vst':
			if($_REQUEST['o']=='d'){
				$sort = "ORDER BY d.v_rlevel DESC";
			}else{
				$sort = "ORDER BY d.v_rlevel";	
			}											
		break;
		case 'cln':
			if($_REQUEST['o']=='d'){
				$sort = "ORDER BY p.name DESC";
			}else{
				$sort = "ORDER BY p.name";	
			}											
		break;
		case 'uni':
			if($_REQUEST['o']=='d'){
				$sort = "ORDER BY uni_Name DESC";
			}else{
				$sort = "ORDER BY uni_Name";	
			}											
		break;
		case 'rgn':
			if($_REQUEST['o']=='d'){
				$sort = "ORDER BY uni_region DESC";
			}else{
				$sort = "ORDER BY uni_region";	
			}											
		break;
		case 'cit':
			if($_REQUEST['o']=='d'){
				$sort = "ORDER BY uni_city DESC";
			}else{
				$sort = "ORDER BY uni_city";	
			}											
		break;
		case 'rdate':
			if($_REQUEST['o']=='d'){
				$sort = "ORDER BY v_date DESC";
			}else{
				$sort = "ORDER BY v_date";	
			}											
		break;	
		case 'cdate':
			if($_REQUEST['o']=='d'){
				$sort = "ORDER BY v_cldate DESC";
			}else{
				$sort = "ORDER BY v_cldate";	
			}											
		break;
		case 'sdate':
			if($_REQUEST['o']=='d'){
				$sort = "ORDER BY v_stdate DESC";
			}else{
				$sort = "ORDER BY v_stdate";	
			}											
		break;														
}
			
$pages = new Paginator;
$pages->items_total = $db_count;
$pages->mid_range = 7;
$pages->paginate();
$pages->limit;
?>