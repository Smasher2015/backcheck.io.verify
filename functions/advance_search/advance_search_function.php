<?php 

/* function advance_search_case_info($twhere='',$torder='',$isSearch=''){
	global $db,$COMINF;
	global $LEVEL;	
	$data['data'] = array();
	
	$excludeComs = " AND vd.com_id NOT IN (20,81,82,92) ";
	$excludeUsers = " AND vc.user_id NOT IN (210,211,212,201,3,23,50) ";
	
	$requestData = $_REQUEST;
	$_days = (int) $_REQUEST['_days'];
	$check_status = $_REQUEST['check_status'];
	
	if($check_status == "close")
	{
		$if_status_close = "AND vc.invoiced = 0";
	}
	else
	{
		$if_status_close = "";
	}
	
	$check_date = ($check_status=='all' || $check_status=='open')?'vc.as_addate':'vc.as_cldate';
	$today = date("Y-m-d");

	//$daysCol = ", (DATEDIFF('$today', DATE($check_date))-((WEEK($check_date) - WEEK('$today')) * 2) - (CASE WHEN WEEKDAY($check_date) = 6 THEN 1 ELSE 0 END) - (CASE WHEN WEEKDAY('$today') = 5 THEN 1 ELSE 0 END)) as dayss ";
	
	//$having = " HAVING (DATEDIFF('$today', DATE($check_date))-((WEEK($check_date) - WEEK('$today')) * 2) - (CASE WHEN WEEKDAY($check_date) = 6 THEN 1 ELSE 0 END) - (CASE WHEN WEEKDAY('$today') = 5 THEN 1 ELSE 0 END)) >= $_days "; 


	
	if($twhere != ''){ $twhere = "$twhere AND"; } else{ $twhere = '';}
	if($torder != ''){ $torder = "$torder"; } else{ $torder = 'd.v_id DESC';}
	$order = "$torder";
	$columns1 = array("");
	if($LEVEL != 4)
	{
		$columns1[1] = "co.name";
		$comma = ",";
	}
	else
	{
		
		$comma = "";
	}
	//$columns = array("","co.name","v_name","v_ftname","v_date","v_status");
	$columns2 = array("vd.emp_id","v_name","cc.checks_title","u.first_name","ndate","","","v_status");
	$columns = array_merge($columns1,$columns2);
	//var_dump($columns);
	
	// For Search records 
	if($columns[$requestData[order][0][column]]){
	$orderBy = $columns[$requestData[order][0][column]]." ".$requestData[order][0][dir];
	}else{
	$orderBy = 	" v_name ASC ";
	}
	
	
	if($isSearch == 'yes'){
		
		if($LEVEL==3 && $action!='assign') $wh= " c.user_id=$_SESSION[user_id] AND";
		$where=" $wh $twhere v_isdlt=0";
		
		
	}else{
		if($LEVEL==1 || $LEVEL==2) $wh= " AND vd.com_id NOT IN (96) "; else $wh= "AND vd.com_id=$COMINF[id]";
		$where="$twhere v_isdlt=0 $wh";
	
	}
	
	$Holidays_Except_WeekEnds = getHolidays_Except_WeekEnds(0,'holidays',true);
	
	
	$cols = "COUNT(vd.v_id) AS cnt,DATE_FORMAT(as_addate,'%d-%b-%Y') AS ndate,vd.v_crd,vd.v_stdate,vd.v_date,vd.v_cldate,vd.emp_id, DATE(vc.as_addate) as add_date, vd.com_id, vc.as_cldate, vc.as_addate,vc.as_status $daysCol ";

	//$cols ="$cols,vd.v_id,  vd.v_name,vd.v_nic,vd.com_id,vd.v_ftname,vd.v_status,vd.v_rlevel,vd.v_sent,v_bmk,v_refid,co.name as com_name";
	

	// ata work
	$cols ="$cols,vd.v_id,  vd.v_name,vd.v_nic,vd.emp_id,vc.as_id,vc.as_vstatus,vd.com_id,vd.v_ftname,vd.v_status,vd.v_rlevel,vd.v_sent,v_bmk,v_refid,co.name as com_name, cc.checks_title,concat(u.first_name,' ',u.last_name) as fullname";
// end ata work
	
	
	$tbls = "ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id INNER JOIN company co ON vd.com_id=co.id INNER JOIN checks cc ON vc.checks_id=cc.checks_id INNER JOIN users u ON vc.user_id=u.user_id"; 
	
	$where = "$where $excludeComs $excludeUsers $if_status_close";
	
	if( !empty($requestData['search']['value']) ) {
		$where = "$where AND ( v_name LIKE '".$requestData['search']['value']."%' OR v_ftname LIKE '".$requestData['search']['value']."%'  OR co.name LIKE '".$requestData['search']['value']."%' OR v_status LIKE '".$requestData['search']['value']."%' OR DATE_FORMAT(v_date,'%d-%b-%Y') LIKE '".$requestData['search']['value']."%')";
		$selFiltered = $db->select($tbls,"vd.v_id,vc.as_cldate, vc.as_addate,vd.com_id,as_status","$where GROUP BY  vc.as_id  $having ");
		
		$totalFiltered = @mysql_num_rows($selFiltered);
		if($_days>0){
		
		$totalFiltered=0;
		while($resFiltered = @mysql_fetch_assoc($selFiltered)) {
		if($resFiltered['as_status'] != 'Close'){
		$days  = getDaysFromDates($today,$resFiltered['as_addate'],$resFiltered['com_id']);
		}else{
		$days  = getDaysFromDates($resFiltered['as_cldate'],$resFiltered['as_addate'],$resFiltered['com_id']);
		
		}
		if($days>=$_days){
		$totalFiltered++;	
		}
		}
		}
						
		
	}else{
		$selFiltered = $db->select($tbls,"vd.v_id,vc.as_cldate, vc.as_addate,vd.com_id,as_status","$where GROUP BY  vc.as_id  $having ");
		$totalFiltered = @mysql_num_rows($selFiltered);
		if($_days>0){
		$totalFiltered=0;
		while($resFiltered = @mysql_fetch_assoc($selFiltered)) {
		if($resFiltered['as_status'] != 'Close'){
		$days  = getDaysFromDates($today,$resFiltered['as_addate'],$resFiltered['com_id']);
		}else{
		$days  = getDaysFromDates($resFiltered['as_cldate'],$resFiltered['as_addate'],$resFiltered['com_id']);
		
		}
		if($days>=$_days){
		$totalFiltered++;	
		}
		}
		}
		
	}
		$seltotal = $db->select($tbls,"vd.v_id,vc.as_cldate, vc.as_addate,vd.com_id,as_status","$where GROUP BY  vc.as_id  $having ");
		
		$total = @mysql_num_rows($seltotal);
		if($_days>0){
		$total=0;
		while($resTotal = @mysql_fetch_assoc($seltotal)){
		if($resTotal['as_status'] != 'Close'){
		$days  = getDaysFromDates($today,$resTotal['as_addate'],$resTotal['com_id']);
		}else{
		$days  = getDaysFromDates($resTotal['as_cldate'],$resTotal['as_addate'],$resTotal['com_id']);
		
		}
		if($days>=$_days){
		$total++;	
		}
		}
		}
		
		
		
		if($_days>0){
			$pageData = ($requestData['length']+$requestData['start']);
		$limit = "";	
		}else{
		$limit = "LIMIT ".$requestData['start']." ,".$requestData['length'];
		}
		
		$cases = $db->select($tbls,$cols,"$where GROUP BY vc.as_id $having ORDER BY $orderBy $limit");
		
		//echo "select  $cols  from $tbls  where $where GROUP BY vc.as_id $having ORDER BY $orderBy  LIMIT ".$requestData['start']." ,".$requestData['length'].""; exit;
		$dCount = @mysql_num_rows($cases);
		
		
		$data=array('draw'=> intval($_REQUEST[draw]),'recordsTotal' => intval($total), 'recordsFiltered' => intval($totalFiltered) );
	
		$count = -1;
		$c=0;
		$cc=0;
		while($re = mysql_fetch_assoc($cases)) { 
		
						$due_date = getdatedifference($re['as_addate'], TAT,$re['com_id']);
						if($re['as_status'] != 'Close'){
						$days  = getDaysFromDates($today,$re['as_addate'],$re['com_id']);
						}else{
						$days  = getDaysFromDates($re['as_cldate'],$re['as_addate'],$re['com_id']);
						
						}
						if($days>=$_days){
						if($_days>0){
						$c++;
						
						//var_dump($pageData);
						if($c<=$pageData)	{
						
						$classs = "";
							
						$closed_date = ($re['as_cldate'])?date("d-M-Y",strtotime($re['as_cldate'])):date("d-M-Y",strtotime($re['as_pdate']));
						$newDays = $re['dayss'];
						
						
						if($days<=11){
						$classs = "green_cheks";
							
						} if ( $days>11 && $days<15){
						$classs = "orange_cheks";	
						} if ( $days>14){
						$classs = "red_cheks";	
						}
									
						if($days<=16){
						$daytitle = ($days>1)?' days':' day';
						$classs = "green_cheks";
						$closed_title = "Closed in ".$days.$daytitle."";	
						}
						if ( $days>16){
						$classs = "red_cheks";
						$closed_title = "Closed in ".$days." days ";					
						}else{
							$classs="";
						}
							
							
						
						
						
						
						
						$check_count = countChecks("$twhere vc.v_id=$re[v_id] ");
						
						if($check_count > 0 ){
										
						$count = $count+1;
						
						$data['data'][$count] = $re;
						
						
						// FOR CHANGE OPEN CHECK'S STATUS //
						 //if($re['v_status'] == "Open"){$vstatus = "WIP";}else{$vstatus = $re['v_status'];}
						
						$data['data'][$count]['modify_status'] = replacestatus($re['as_status']);
						// END HERE 
						
							
						$tnt = countChecks("vc.v_id=$re[v_id] AND as_isdlt=0");

						$cnt = countChecks("vc.as_status='close' AND vc.v_id=$re[v_id] AND as_isdlt=0");
						
						$asd = ($checkInf['as_status'] == 'Close')?$closed_title:$days;
						
						$data['data'][$count]['progress'] = @($cnt/($tnt))*100;
						
						$data['data'][$count]['dudatex'] = $due_date;
						$data['data'][$count]['daysx'] = $days;

						$data['data'][$count]['daysnew'] = '<div class="'.$classs.'">'.$days.'</div>';
 
						 



						
						$red = "(as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found')";

						$red = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $red AND as_isdlt=0");
						$red =	mysql_fetch_assoc($red);
						
						$data['data'][$count]['red'] = $red['cnt'];
						
						$disp="(as_vstatus='unable to verify' OR as_vstatus='discrepancy' OR as_vstatus='original required')";

						$disp = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $disp AND as_isdlt=0");
						$disp = mysql_fetch_assoc($disp);
						
						$data['data'][$count]['discrepancy'] = $disp['cnt'];
						
						
						}
						break;
						}
						}
						} //if for days
						
			
		} // end while
		if(empty($data['data'])){
		$data['data'][0] = array('v_ftname'=>'No Data Found');	
		}
		//var_dump($data);
		return $data;
} */


// check wise results by khl

function advance_search_case_info($twhere='',$torder='',$isSearch=''){
	global $db,$COMINF;
	global $LEVEL;	
	$data['data'] = array();
	
	
	$excludeComs = " AND vd.com_id NOT IN (20,81,82,92) ";
	$excludeUsers = " AND vc.user_id NOT IN (210,211,212,201,3,23,50) ";
	
	$requestData = $_REQUEST;
	//print_r($requestData);
	$_days = (int) $_REQUEST['_days'];
	
	if(isset($_REQUEST['check_status'])){
	$check_status = explode("-",$_REQUEST['check_status']);
	}
	
	
	if(in_array('low_risk',$check_status)){
	$twhere = "$twhere AND as_vstatus IN ('unable to verify', 'discrepancy' , 'processed but cancelled by client', 'objection by source', 'addition information not provided by client','partially verified','original required','not verified by source')";	
	}
	
	
	$check_date = (in_array('all',$check_status) || in_array('open',$check_status) || in_array('not_initiated',$check_status) || in_array('insufficient',$check_status))?'vc.as_addate':'vc.as_cldate';
	
	$today = date("Y-m-d");
	
	if($_days>0){
	
	$today = date('Y-m-d',strtotime($today."-$_days days"));
	
	$daysWhere = " AND DATE($check_date) < '$today' ";
	}

	$daysCol = ", (DATEDIFF('$today', DATE($check_date))-((WEEK($check_date) - WEEK('$today')) * 2) - (CASE WHEN WEEKDAY($check_date) = 6 THEN 1 ELSE 0 END) - (CASE WHEN WEEKDAY('$today') = 5 THEN 1 ELSE 0 END)) as dayss ";
	
	$having = " HAVING (dayss >=$_days OR dayss IS NOT NULL) "; 


	
	if($twhere != ''){ $twhere = "$twhere AND "; } else{ $twhere = '';}
	if($torder != ''){ $torder = "$torder"; } else{ $torder = 'd.v_id DESC';}
	$order = "$torder";
	$columns1 = array("");
	if($LEVEL != 4)
	{
		$columns1[1] = "co.name";
		$comma = ",";
	}
	else
	{
		
		$comma = "";
	$uids = getUseridsLocation();
	
	if(!empty($uids)){
	$twhere = ($twhere!='')?" $twhere AND vd.v_uadd IN (".implode(",",$uids).") ":" vd.v_uadd IN (".implode(",",$uids).") AND ";
	
	}
	//if($twhere != ''){ $twhere = "$twhere AND $whr "; } else{ $twhere = " vd.v_uadd IN (".implode(",",$uids).") AND ";}
	}
	
	
	//$columns = array("","co.name","v_name","v_ftname","v_date","v_status");
	$columns2 = array("vd.emp_id","v_name","cc.checks_title","","u.first_name","as_addate","as_cldate","as_vstatus");
	$columns = array_merge($columns1,$columns2);
	//var_dump($columns);
	
	// For Search records 
	if($columns[$requestData[order][0][column]]){
	$orderBy = $columns[$requestData[order][0][column]]." ".$requestData[order][0][dir];
	}else{
	$orderBy = 	" v_name ASC ";
	}
	
	
	if($isSearch == 'yes'){
		
		if($LEVEL==3 && $action!='assign') $wh= " c.user_id=$_SESSION[user_id] AND";
		$where=" $wh $twhere v_isdlt=0 ";
		
		
	}else{
		if($LEVEL!=4 && $LEVEL!=3 ) $wh= " "; else $wh= " AND vd.com_id=$COMINF[id] ";
		$where=" $twhere v_isdlt=0 $wh ";
	
	}
	
	$Holidays_Except_WeekEnds = getHolidays_Except_WeekEnds(0,'holidays',true);
	
	
	$cols = "COUNT(vd.v_id) AS cnt,DATE_FORMAT(as_addate,'%d-%b-%Y') AS ndate,vd.v_crd,vd.v_stdate,vd.v_date,vd.v_cldate,vd.emp_id, DATE(vc.as_addate) as add_date, vd.com_id, DATE(vc.as_cldate) as as_cldate, DATE(vc.as_addate) as as_addate  $daysCol";

	/*	$cols ="$cols,vd.v_id,  vd.v_name,vd.v_nic,vd.com_id,vd.v_ftname,vd.v_status,vd.v_rlevel,vd.v_sent,v_bmk,v_refid,co.name as com_name";
	*/

	// ata work
	$cols ="$cols,vd.v_id,  vd.v_name,vd.v_nic,vd.emp_id,vc.as_id,vc.checks_id,vc.as_vstatus,vc.as_status,as_uadd,vd.com_id,vd.v_ftname,vd.v_status,vd.v_rlevel,vd.v_sent,v_bmk,v_refid,co.name as com_name, cc.checks_title,concat(u.first_name,' ',u.last_name) as fullname";
// end ata work
	
	
	$tbls = "ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id INNER JOIN company co ON vd.com_id=co.id INNER JOIN checks cc ON vc.checks_id=cc.checks_id INNER JOIN users u ON vc.user_id=u.user_id LEFT JOIN uni_info uni ON vc.as_uni=uni.uni_id"; 
	
	$where = "$where AND as_isdlt=0 AND v_isdlt=0 $excludeComs $excludeUsers $if_status_close";
	
	if( !empty($requestData['search']['value']) ) {
		$where = "$where AND ( v_name LIKE '".$requestData['search']['value']."%' OR v_ftname LIKE '".$requestData['search']['value']."%'  OR co.name LIKE '".$requestData['search']['value']."%' OR v_status LIKE '".$requestData['search']['value']."%' OR DATE_FORMAT(v_date,'%d-%b-%Y') LIKE '".$requestData['search']['value']."%')";
		
		$totalFiltered = @mysql_num_rows($db->select($tbls,"vd.v_id,DATE(vc.as_cldate), vc.as_addate $daysCol","$where   $daysWhere GROUP BY  vc.as_id  "));
		
	}else{
		$totalFiltered = @mysql_num_rows($db->select($tbls,"vd.v_id,DATE(vc.as_cldate), vc.as_addate $daysCol","$where $daysWhere GROUP BY  vc.as_id "));
		
	}
	
		
		$total = @mysql_num_rows($db->select($tbls,"vd.v_id,DATE(vc.as_cldate), vc.as_addate $daysCol","$where $daysWhere GROUP BY  vc.as_id  "));
		
		
		$cases = $db->select($tbls,$cols,"$where $daysWhere GROUP BY vc.as_id  ORDER BY $orderBy  LIMIT ".$requestData['start']." ,".$requestData['length']);
		


		$dCount = @mysql_num_rows($cases);
		
		//$queryy = "select  $cols  from $tbls  where $where $daysWhere GROUP BY vc.as_id  ORDER BY $orderBy  LIMIT ".$requestData['start']." ,".$requestData['length'].""; 
		//$twhere222 = $twhere;
		$data=array('draw'=> intval($_REQUEST[draw]),'recordsTotal' => intval($total), 'recordsFiltered' => intval($totalFiltered),'qryyy'=> $queryy, 'twhere'=> $twhere222);
		
		//$data['data']['twhere']= $twhere;
		$count = -1;
		$c=0;
		$cc=0;
		while($re = mysql_fetch_assoc($cases)) { 
		
						$due_date = getdatedifference($re['as_addate'], TAT,$re['com_id']);
						$days  = getDaysFromDates($today,$re['as_addate'],$re['com_id']);
						$newDays = $re['dayss'];
						$closed_days  = getDaysFromDates($re['as_cldate'],$re['as_addate'],$re['com_id']);
					
						if($re['as_status'] != 'Close'){
						if($days<=11){
						$classs = "green_cheks";
							
						}else if ( $days>11 && $days<15){
						$classs = "orange_cheks";	
						}else if ( $days>14){
						$classs = "red_cheks";	
						}
						}else{
							$classs = "";
							$closed_date = ($re['as_cldate'])?date("d-M-Y",strtotime($re['as_cldate'])):date("d-M-Y",strtotime($re['as_pdate']));
							if($closed_days<=16){
						$daytitle = ($closed_days>1)?' days':' day';
						$classs = "green_cheks";
						$closed_title = "Closed in ".$closed_days.$daytitle."";	
						}else if ( $closed_days>16){
						$classs = "red_cheks";
						$closed_title = "Closed in ".$closed_days." days ";					
						}else{
							$classs="";
						}
							
							
						}
						
						
						
						//var_dump("$twhere vc.v_id=$re[v_id] ");
						//$check_count = countChecks("$where $daysWhere vc.v_id=$re[v_id] ");
						
						//if($check_count > 0 ){
										
						$count = $count+1;
						
						$data['data'][$count] = $re;
						
						
						// FOR CHANGE OPEN CHECK'S STATUS //
						//if($re['as_vstatus'] == "Not Initiated"){$vstatus = "WIP";}else{$vstatus = $re['as_vstatus'];}
						$as_statuss =($re['as_status']=='Open')?'':' ['.$re['as_status'].']';
						$as_vstatuss = ($re['as_vstatus'] == "Not Initiated")?($re['as_status']=='Insufficient')?$re['as_vstatus'].$as_statuss:$re['as_vstatus']:$re['as_vstatus'].$as_statuss;
						$data['data'][$count]['modify_status'] = $as_vstatuss;
						$followupchecks=array("1","2","11","15");
					if(in_array($re['checks_id'],$followupchecks)){
					$followSel = $db->select("add_data ","d_id","d_type='followup' AND as_id=$re[as_id]");
					$countFolowups = @mysql_num_rows($followSel);
					}else{
						$countFolowups="Follow Up Not Required";
					}
						$data['data'][$count]['followups'] = $countFolowups;
						// END HERE 
						
							
						$tnt = countChecks("vc.v_id=$re[v_id] AND as_isdlt=0");

						$cnt = countChecks("vc.as_status='close' AND vc.v_id=$re[v_id] AND as_isdlt=0");
						
						$asd = ($re['as_status'] == 'Close')?$closed_title:$days;
						
						$data['data'][$count]['progress'] = @($cnt/($tnt))*100;
						
						$data['data'][$count]['dudatexx'] = $due_date;
						$data['data'][$count]['daysx'] = $newDays;
						$data['data'][$count]['closeddate'] = ($re['as_status'] == 'Close')?date("d-M-Y",strtotime($re['as_cldate'])):'Not Closed';
						$data['data'][$count]['reopened'] = (getReopenedDate($re['as_id'])!='')?getReopenedDate($re['as_id']):'N/A';

						$data['data'][$count]['daysnew'] = '<div class="'.$classs.'">'.$asd.'</div>';
						$locationTitle = (!isLocationWise($re['com_id']))?'':'<br>(<i class="icon-paperplane" title="Location:'.getLocationByUserID($re['as_uadd']).'"></i> '.getLocationByUserID($re['as_uadd']).')';
						$data['data'][$count]['v_name'] = $re['v_name'].$locationTitle;
 
						 



						
						$red = "(as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found')";

						$red = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $red AND as_isdlt=0");
						$red =	mysql_fetch_assoc($red);
						
						$data['data'][$count]['red'] = $red['cnt'];
						
						$disp="(as_vstatus='unable to verify' OR as_vstatus='discrepancy' OR as_vstatus='original required')";

						$disp = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $disp AND as_isdlt=0");
						$disp = mysql_fetch_assoc($disp);
						
						$data['data'][$count]['discrepancy'] = $disp['cnt'];
						
						
						//}
			
		} // end while
		if(empty($data['data'])){
		$data['data'][0] = array('v_name'=>'No Data Found');	
		}
		//var_dump($data);
		return $data;
}




// case wise results by khl

function advance_search_casewise_info($twhere='',$torder='',$isSearch=''){
	global $db,$COMINF;
	global $LEVEL;	
	$data['data'] = array();
	
	$excludeComs = " AND vd.com_id NOT IN (20,81,82,92) ";
	$excludeUsers = " AND vc.user_id NOT IN (210,211,212,201,3,23,50) ";
	
	$requestData = $_REQUEST;
	print_r($requestData);
	$_days = (int) $_REQUEST['_days'];
	$check_status = $_REQUEST['check_status'];
	
	if($check_status == "close")
	{
		$if_status_close = "AND vc.invoiced = 0";
	}
	else
	{
		$if_status_close = "";
	}
	
	$check_date = ($check_status=='all' || $check_status=='open')?'vd.v_recdate':'vd.v_cldate';
	$today = date("Y-m-d");

	$daysCol = ", (DATEDIFF('$today', DATE($check_date))-((WEEK($check_date) - WEEK('$today')) * 2) - (CASE WHEN WEEKDAY($check_date) = 6 THEN 1 ELSE 0 END) - (CASE WHEN WEEKDAY('$today') = 5 THEN 1 ELSE 0 END)) as dayss ";
	
	$having = " HAVING (DATEDIFF('$today', DATE($check_date))-((WEEK($check_date) - WEEK('$today')) * 2) - (CASE WHEN WEEKDAY($check_date) = 6 THEN 1 ELSE 0 END) - (CASE WHEN WEEKDAY('$today') = 5 THEN 1 ELSE 0 END)) >= $_days "; 


	
	if($twhere != ''){ $twhere = "$twhere AND"; } else{ $twhere = '';}
	if($torder != ''){ $torder = "$torder"; } else{ $torder = 'd.v_id DESC';}
	$order = "$torder";
	$columns1 = array("");
	if($LEVEL != 4)
	{
		$columns1[1] = "co.name";
		$comma = ",";
	}
	else
	{
		
		$comma = "";
	}
	//$columns = array("","co.name","v_name","v_ftname","v_date","v_status");
	$columns2 = array("vd.emp_id","v_name","cc.checks_title","ndate","v_status");
	$columns = array_merge($columns1,$columns2);
	//var_dump($columns);
	
	// For Search records 
	if($columns[$requestData[order][0][column]]){
	$orderBy = $columns[$requestData[order][0][column]]." ".$requestData[order][0][dir];
	}else{
	$orderBy = 	" v_name ASC ";
	}
	
	
	if($isSearch == 'yes'){
		
		if($LEVEL==3 && $action!='assign') $wh= " c.user_id=$_SESSION[user_id] AND";
		$where=" $wh $twhere v_isdlt=0";
		
		
	}else{
		if($LEVEL==1 || $LEVEL==2) $wh= " AND vd.com_id NOT IN (96) "; else $wh= "AND vd.com_id=$COMINF[id]";
		$where="$twhere v_isdlt=0 $wh";
	
	}
	
	$Holidays_Except_WeekEnds = getHolidays_Except_WeekEnds(0,'holidays',true);
	
	
	$cols = "COUNT(vd.v_id) AS cnt,DATE_FORMAT(v_recdate,'%d-%b-%Y') AS ndate,vd.v_crd,vd.v_stdate,vd.v_date,vd.v_cldate,vd.emp_id, DATE(vd.v_date) as v_date, vd.com_id, vd.v_cldate, vd.v_recdate $daysCol ";

	/*	$cols ="$cols,vd.v_id,  vd.v_name,vd.v_nic,vd.com_id,vd.v_ftname,vd.v_status,vd.v_rlevel,vd.v_sent,v_bmk,v_refid,co.name as com_name";
	*/

	// ata work
	$cols ="$cols,vd.v_id,  vd.v_name,vd.v_nic,vd.emp_id,vc.as_id,vc.as_vstatus,vd.com_id,vd.v_ftname,vd.v_status,vd.v_rlevel,vd.v_sent,v_bmk,v_refid,co.name as com_name, cc.checks_title,concat(u.first_name,' ',u.last_name) as fullname";
// end ata work
	
	
	$tbls = "ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id INNER JOIN company co ON vd.com_id=co.id INNER JOIN checks cc ON vc.checks_id=cc.checks_id INNER JOIN users u ON vc.user_id=u.user_id"; 
	
	$where = "$where $excludeComs $excludeUsers $if_status_close";
	
	if( !empty($requestData['search']['value']) ) {
		$where = "$where AND ( v_name LIKE '".$requestData['search']['value']."%' OR v_ftname LIKE '".$requestData['search']['value']."%'  OR co.name LIKE '".$requestData['search']['value']."%' OR v_status LIKE '".$requestData['search']['value']."%' OR DATE_FORMAT(v_recdate,'%d-%b-%Y') LIKE '".$requestData['search']['value']."%')";
		
		$totalFiltered = @mysql_num_rows($db->select($tbls,"vd.v_id,vd.v_cldate, vd.v_recdate","$where GROUP BY vc.v_id  $having "));
		
	}else{
		$totalFiltered = @mysql_num_rows($db->select($tbls,"vd.v_id,vd.v_cldate, vd.v_recdate","$where GROUP BY vc.v_id  $having "));
		
	}
	
		
		$total = @mysql_num_rows($db->select($tbls,"vd.v_id,vd.v_cldate, vd.v_recdate","$where GROUP BY vc.v_id  $having "));
		
		
		$cases = $db->select($tbls,$cols,"$where GROUP BY vc.v_id $having ORDER BY $orderBy  LIMIT ".$requestData['start']." ,".$requestData['length']);
		
		//echo "select  $cols  from $tbls  where $where GROUP BY vc.as_id $having ORDER BY $orderBy  LIMIT ".$requestData['start']." ,".$requestData['length'].""; exit;
		$dCount = @mysql_num_rows($cases);
		
		
		$data=array('draw'=> intval($_REQUEST[draw]),'recordsTotal' => intval($total), 'recordsFiltered' => intval($totalFiltered) );
	
		$count = -1;
		$c=0;
		$cc=0;
		while($re = mysql_fetch_assoc($cases)) { 
		
						$due_date = getdatedifference($re['v_recdate'], TAT,$re['com_id']);
						$days  = getDaysFromDates($today,$re['v_recdate'],$re['com_id']);
						$newDays = $re['dayss'];
						$closed_days  = getDaysFromDates($re['v_cldate'],$re['v_recdate'],$re['com_id']);
					
						if($re['as_status'] != 'Close'){
						if($days<=11){
						$classs = "green_cheks";
							
						}else if ( $days>11 && $days<15){
						$classs = "orange_cheks";	
						}else if ( $days>14){
						$classs = "red_cheks";	
						}
						}else{
							$classs = "";
							$closed_date = ($re['as_cldate'])?date("d-M-Y",strtotime($re['v_cldate'])):date("d-M-Y",strtotime($re['v_recdate']));
							if($closed_days<=16){
						$daytitle = ($closed_days>1)?' days':' day';
						$classs = "green_cheks";
						$closed_title = "Closed in ".$closed_days.$daytitle."";	
						}else if ( $closed_days>16){
						$classs = "red_cheks";
						$closed_title = "Closed in ".$closed_days." days ";					
						}else{
							$classs="";
						}
							
							
						}
						
						
						
						
						$check_count = countChecks("$twhere vc.v_id=$re[v_id] ");
						
						if($check_count > 0 ){
										
						$count = $count+1;
						
						$data['data'][$count] = $re;
						
						
						// FOR CHANGE OPEN CHECK'S STATUS //
						 //if($re['v_status'] == "Open"){$vstatus = "WIP";}else{$vstatus = $re['v_status'];}
						
						$data['data'][$count]['modify_status'] = replacestatus($re['v_status']);
						$data['data'][$count]['check_count'] = $check_count;
						// END HERE 
						
							
						$tnt = countChecks("vc.v_id=$re[v_id] AND as_isdlt=0");

						$cnt = countChecks("vc.as_status='close' AND vc.v_id=$re[v_id] AND as_isdlt=0");
						
						$asd = ($checkInf['as_status'] == 'Close')?$closed_title:$newDays;
						
						$data['data'][$count]['progress'] = @($cnt/($tnt))*100;
						
						$data['data'][$count]['dudatex'] = $due_date;
						$data['data'][$count]['daysx'] = $newDays;

						$data['data'][$count]['daysnew'] = '<div class="'.$classs.'">'.$asd.'</div>';
						
						$data['data'][$count]['reopened'] = (getReopenedDate($re['as_id'])!='')?getReopenedDate($re['as_id']):'N/A';
						
						$red = "(as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found')";

						$red = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $red AND as_isdlt=0");
						$red =	mysql_fetch_assoc($red);
						
						$data['data'][$count]['red'] = $red['cnt'];
						
						$disp="(as_vstatus='unable to verify' OR as_vstatus='discrepancy' OR as_vstatus='original required')";

						$disp = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $disp AND as_isdlt=0");
						$disp = mysql_fetch_assoc($disp);
						
						$data['data'][$count]['discrepancy'] = $disp['cnt'];
						
						
						}
			
		} // end while
		if(empty($data['data'])){
		$data['data'][0] = array('v_ftname'=>'No Data Found');	
		}
		//var_dump($data);
		return $data;
}
	 
	 
 
function printableStatus($as_status,$as_vstatus){
	//var_dump($as_vstatus);
	$as_statuss =($as_status=='Open')?'':' ['.$as_status.']';
	$as_vstatuss = ($as_vstatus == "Not Initiated")?($as_status=='Insufficient')?$as_vstatus.$as_statuss:$as_vstatus:$as_vstatus.$as_statuss;
	
	return $as_vstatuss;
}