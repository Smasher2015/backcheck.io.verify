<?php  	include("include/config.php"); 
		if($action==''){
			header("location:".SURL."?action=dashboard");
		}
	
		if($action=="excel"){
			$efile = "include_pages/$_REQUEST[efile]_inc.php";
			if(file_exists($efile)){
				include('include/excel_cls.php');
				 $_POST['comname'] = $COMINF['name'];
				 $_POST['comid']   = $COMINF['id'];
				$exp=new ExportToExcel();
				$exp->exportWithPage($efile,"$_REQUEST[name].xls");
				exit();
			}
		}		
	   $endtime = microtime();
       $endarray = explode(" ", $endtime);
       $endtime = $endarray[1] + $endarray[0];
       $totaltime = $endtime - $starttime;
       $totaltime = round($totaltime,5);
	   if($_REQUEST['action'] != 'stats' and $_REQUEST['atype'] != 'list'){
			$statsid = add_stats($member_id,$username,$_SESSION['email'],$browsers,$version,$platform,$country,$region,$city,$_REQUEST['action'],$requestdata,$date,$ip,$time,$_SERVER['HTTP_REFERER'],get_url(),$cont_id,$record_country,$record_state,$record_city,$record_country_id,$is_search,$search_id,$is_record,$is_visit,$is_edit,$is_add,$totaltime,$strtime,$_REQUEST['atype']);   
	   }
		$CPAGE=0; $SSTR = '';
		$MENUS = getMenus();
		$IPAGE = getPage();
		if($IPAGE){
			$ISRCH = getSrch($IPAGE['s_id']);
			if($ISRCH) $SSTR = search($ISRCH['s_table'],$ISRCH['s_fields']);
			$PTITLE= "$IPAGE[m_actitle] $IPAGE[m_attitle]";
			$PTITLE = str_ireplace('/ Edit','',$PTITLE);
		}else{
			$ISRCH=false;
			$PTITLE= "No Access";
		}

	switch($LEVEL){
		case 1:
			$iPage="config_admin.php";
		break;
		case 2:
		case 3:
		case 6:
		case 12:
		case 14:
			$iPage="config_actions.php";
		break;
		case 4:
		case 5:
			$iPage="config_client.php";
		break;
		default:	
			$iPage="na";
		break;				
	}
	if(file_exists("include/$iPage")) include("include/$iPage");
?>