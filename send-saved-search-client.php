<?php include ('include/config.php');
// we have set this cron file time at morning 8 am (KHL)
$_REQUEST['date']=date("Y-m-d");

$localDate = date("D, M d, Y");
 
if($_GET['send']==1){



$table = '<table  border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">';
				$table .= '
				<tr>
				<td align="center" width="100%" colspan="10" style="border:none;">&nbsp;</td>
				</tr>
				
				<tr>
				<td align="center" width="100%" colspan="10" style="border:none;">The following are the checks results which you have requested.</td>
				</tr>
				<tr>
				<td align="center" width="100%" colspan="10" style="border:none;">&nbsp;</td>
				</tr>
				<tr>				
				<th width="5%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">#</th>
				<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">CHECK TITLE</th>
            	<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">APPLICANTS NAME</th>
                <th width="12%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">RECIEVED DATE</th>
                <th width="12%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">CLOSED DATE</th>
                
			
				<th width="8%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">PROGRESS</th>
            
							     </tr>';
							 
						 
				$selSaved = $db->select("users us INNER JOIN company co ON us.com_id = co.id INNER JOIN clients_saved_search css ON co.id = css.com_id","*","css.com_id=co.id and css.user_id=us.user_id and co.is_active=1 AND us.is_send_searched= 1 AND  us.is_active=1");

				//$selSaved = $db->select("clients_saved_search","*","level_id=4 AND send_weekly_update=1 AND status=1");
				//echo "users us INNER JOIN company co ON us.com_id = co.id INNER JOIN clients_saved_search css ON co.id = css.com_id","*","css.com_id=co.id and css.user_id=us.user_id and co.is_active=1 AND us.is_send_searched= 1 AND  us.is_active=1";
			 
			 
		$clientdata = array();
 		 
			 
			 
			 while($rsSaved = mysql_fetch_assoc($selSaved)){
			 
			 /*$clients_saved_search = $db->select("clients_saved_search","*","user_id = $rsSaveddata[user_id] and com_id = $rsSaveddata[id] and send_weekly_update = 1");
				echo "select * from clients_saved_search where (user_id = $rsSaveddata[user_id] and com_id = $rsSaveddata[id] and send_weekly_update = 1)";*/
			/* if(mysql_num_rows($rsSaved) > 0)
			 {
				 echo "mil gaya";
			 break;
			 }
			 else
			 {
				 echo "ni mil rha";
			 }*/
			  //$rsSaved = mysql_fetch_assoc($clients_saved_search);
				
				//print_r($rsSaved)."asdasdsad<br><br><br><br>";
				 
	$from_dt  		= $rsSaved['from_dt'];
	$to_dt  		= $rsSaved['to_dt'];
	$check_status  	= $rsSaved['check_status'];
	$name_id  		= $rsSaved['candidate_name_id'];
	$s_checks_id  	= $rsSaved['s_checks_id'];
	$user_id  		= $rsSaved['user_id'];
	$client_id  	= $rsSaved['com_id'];
	$loc_id  		= (int) $rsSaved['loc_id'];
	$_days  		= (int) $rsSaved['_days'];
					
	$whDates="";
	$clientWhere="";
	$userWhere="";
	$name_idWhere="";
	
	if($from_dt && $to_dt){
	$whDates = " BETWEEN '".$from_dt."' AND '".$to_dt."'";
	}
	switch($check_status){
		case 'no_risk':
		$pm_where = "as_status = 'Close' AND as_qastatus!='Rejected' AND  as_sent=4 AND as_isdlt=0 AND as_vstatus IN ('verified', 'satisfactory', 'no match found', 'no record found') ";
		$asDate = "as_cldate";
		break;
		case 'low_risk':
		$pm_where = "as_status = 'Close' AND as_qastatus!='Rejected' AND as_sent=4 AND as_isdlt=0 AND as_vstatus IN ('unable to verify', 'discrepancy' , 'processed but cancelled by client', 'objection by source', 'addition information not provided by client','partially verified','original required','not verified by source') ";
		$asDate = "as_cldate";
		break;
		case 'high_risk':
		$pm_where = "as_sent=4 AND as_status='Close' AND as_qastatus!='Rejected' AND as_isdlt=0 AND (as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found' OR as_vstatus='unsatisfactory' OR as_vstatus='positive match found') ";
		$asDate = "as_cldate";
		break;
		case 'all':
		$pm_where = " as_isdlt=0  ";
		$asDate = "as_addate";
		break;
		case 'no_risk':
		$pm_where = "as_status = 'Close' AND as_qastatus!='Rejected' AND  as_sent=4 AND as_isdlt=0 AND as_vstatus NOT IN ('negative', 'match found', 'record found') ";
		$asDate = "as_cldate";
		break;
		case 'not_initiated':
		$pm_where = "as_status = 'Open' AND as_vstatus='Not Initiated' AND as_isdlt=0  ";
		$asDate = "as_addate";
		break;
		case 'insufficient':
		$pm_where = "as_status = 'Insufficient' AND as_vstatus='Not Initiated' AND as_isdlt=0  ";
		$asDate = "as_addate";
		break;
		case 'open':
		$pm_where = "as_status = 'Open' AND as_vstatus!='Not Initiated' AND as_isdlt=0 AND as_cldate IS NULL ";
		$asDate = "as_addate";
		break;
		case 'close':
		$pm_where = "as_status = 'Close' AND as_qastatus!='Rejected' AND as_isdlt=0  ";
		$asDate = "as_cldate";
		break;
		case 'invoiced':
		$pm_where = "invoiced=1 AND as_status = 'Close' AND as_qastatus!='Rejected' AND as_sent=4 AND v_status='Close' AND as_isdlt=0  ";
		$asDate = "as_cldate";
		break;
	}
	//AND DATE_FORMAT(as_cldate, '%Y-%m-%d')
	
	if($from_dt && $to_dt){
	$whDates = " AND DATE_FORMAT($asDate, '%Y-%m-%d')".$whDates;
	}
	
	if(!empty($client_id)){
	$client_ids = implode(",",$client_id);
	$clientWhere =	" AND vd.com_id IN ($client_ids) ";
		
	}
	if(!empty($user_id)){
	$user_ids = implode(",",$user_id);
	$userWhere =	" AND vc.user_id IN ($user_ids) ";
		
	}
	
	if(!empty($name_id) ){
	
	$name_idWhere =	" AND ( vd.v_name LIKE '%".$name_id."%' OR vd.emp_id = '".$name_id."' ) ";
		
	}
	if(!empty($s_checks_id)){
	$s_checks_ids = implode(",",$s_checks_id);	
	$s_checks_idWhere =	" AND  vc.checks_id  IN ($s_checks_ids)  ";
		
	}
	
	if(is_numeric($loc_id) && $loc_id!=0 && $client_id!=0){
	$uids =	getUseridsByLocationId($loc_id,$client_id);
	$locationInf = getInfo("users_locations","loc_id=$loc_id AND com_id=$client_id");
	if(!empty($uids)){
	$v_uadd_checks_idWhere =	" AND v_uadd IN (".implode(",",$uids).") AND as_uadd IN (".implode(",",$uids).")  ";
	}else{
	msg("err","No users in $locationInf[location] location!");
	}
	
	}
	
	
	$pm_where = $pm_where.$whDates.$clientWhere.$userWhere.$name_idWhere.$s_checks_idWhere.$v_uadd_checks_idWhere;
	//echo  $pm_where;
	
	
	$check_date = ($check_status=='all' || $check_status=='open' || $check_status=='not_initiated' || $check_status=='insufficient')?'vc.as_addate':'vc.as_cldate';
	$today = date("Y-m-d");
	if($_days>0){
	
	$today = date('Y-m-d',strtotime($today."-$_days days"));
	
	$daysWhere = " AND DATE($check_date) < '$today' ";
	}
	$daysCol = ", (DATEDIFF('$today', DATE($check_date))-((WEEK($check_date) - WEEK('$today')) * 2) - (CASE WHEN WEEKDAY($check_date) = 6 THEN 1 ELSE 0 END) - (CASE WHEN WEEKDAY('$today') = 5 THEN 1 ELSE 0 END)) as dayss ";
	
	$having = " HAVING (dayss >=$_days OR dayss IS NOT NULL) "; 
	
	$excludeComs = " AND vd.com_id NOT IN (20,81,82,92) ";
	$excludeUsers = " AND vc.user_id NOT IN (210,211,212,201,3,23,50) ";
				
								 
	$cols = "COUNT(vd.v_id) AS cnt,DATE_FORMAT(as_addate,'%d-%b-%Y') AS ndate,vd.v_crd,vd.v_stdate,vd.v_date,vd.v_cldate,vd.emp_id, DATE(vc.as_addate) as add_date, vd.com_id, DATE(vc.as_cldate) as as_cldate , vc.as_addate, c.checks_title,as_status,as_vstatus $daysCol ";

	$cols ="$cols,vd.v_id,  vd.v_name,vd.v_nic,vd.com_id,vd.v_ftname,vd.v_status,vd.v_rlevel,vd.v_sent,v_bmk,v_refid,co.name as com_name";

	$tbls = "ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id INNER JOIN checks c ON c.checks_id=vc.checks_id INNER JOIN company co ON vd.com_id=co.id"; 
	
	$where = " $where $excludeComs $excludeUsers";
									
							$WHERE = " $pm_where $where $daysWhere GROUP BY vc.as_id ORDER BY v_name ASC  ";
							// echo "SELECT $cols FROM $tbls WHERE $WHERE";
						$see=0;		 
		$data= $db->select($tbls,$cols,$WHERE);
        if(@mysql_num_rows($data)>0){
        while($data_arr = mysql_fetch_array($data)){
		$today = date("Y-m-j H:i:s");
		
		$days  = getDaysFromDates($today,$data_arr['add_date']);
		$newDays = $data_arr['dayss'];
		
			if($data_arr['as_status']=='Close'){
			$clsCol = 	$data_arr['as_cldate'];
			}else{
			$clsCol = 	"Not Closed Yet";	
			}
			if((is_numeric($_days)) && $_days!=0){
			if($days>=$_days){
				$see++;
				
				$table .= ' <tr>
				<td width="" style="font-size:12px; padding:5px;">'.$see.'</td>
               
                <td width="" style="font-size:14px; padding:5px;">'.$data_arr['v_name'].'</td>
				<td width="" style="font-size:12px; padding:5px;">'.$data_arr['checks_title'].'</td>
                <td width="" style="font-size:14px; padding:5px;">'.$data_arr['add_date'].'</td>
                
                <td width="" style="font-size:14px; padding:5px;">'.$clsCol.'</td>
				<td width="" style="font-size:14px; padding:5px;">'.$data_arr['as_vstatus'].'</td>
                
            </tr>'; 	
			
		//$db->update("delayed_reported=1","ver_checks","as_id=".$data_arr['as_id']);
		
			}	
			}else{
				$see++;
				
				$table .= ' <tr>
				<td width="" style="font-size:12px; padding:5px;">'.$see.'</td>
               
                <td width="" style="font-size:14px; padding:5px;">'.$data_arr['v_name'].'</td>
				<td width="" style="font-size:12px; padding:5px;">'.$data_arr['checks_title'].'</td>
                <td width="" style="font-size:14px; padding:5px;">'.$data_arr['add_date'].'</td>
                
                <td width="" style="font-size:14px; padding:5px;">'.$clsCol.'</td>
				<td width="" style="font-size:14px; padding:5px;">'.$data_arr['as_vstatus'].'</td>
                
            </tr>'; 	
			}			
		}
		
		}
		
		$fullname = $rsSaved['first_name'].' '.$rsSaved['last_name'];
		$to_email = $rsSaved['email'];
		$clientdata[] = array("fulname" => $fullname,"email" => $to_email,'com_name' => $rsSaved['name']);

		 
		
		//$to_email .="khalique@xcluesiv.com";
		
		
}
				$table .= "</table>";
				
				/*$to_email="khalique@xcluesiv.com";
				$fEmial="Verification Team";*/
				//$cMail="hzafar2010@gmail.com";
		echo $table;		

 



		$subject="Daily Search Result Updates (".$localDate.")";
		//$fullName = $rsSaved['first_name'].' '.$rsSaved['last_name'];
		//$to_email = $rsSaved['email'];
		//$to_email="khalique@xcluesiv.com";
		if($see!=0){ 
		foreach($clientdata as $userlist)
		{
			
			$email_to = $userlist['email'];
			emailTmp($table,$subject,"khalique@xcluesiv.com",'','','','',$userlist['fulname']." ($userlist[com_name])");
			emailTmp($table,$subject,"mis@backcheckgroup.com",'','','','',$userlist['fulname']." ($userlist[com_name])");
			emailTmp($table,$subject,$email_to,'','','','',$userlist['fulname']." ($userlist[com_name])");
		}
		}
		



if($see!=0){
	
	
	
	$clUsers = getClUser($client_id);
	$userInfo = getUserInfo($user_id);
	
		//var_dump($userInfo['email']);
		
		
	if($clUsers){

		while($clUser = mysql_fetch_assoc($clUsers)){
			$fullName = $clUser['first_name'].' '.$clUser['last_name'];
			
			
			// emailTmp($table,$subject,$to_email,'','','','',"Khalique");

			//echo $clUser['email']."<br />";

		}

	}
	
//emailTmp($table,$subject,$to_email,'','','','',"Khalique");
//emailTmp($table,$subject,'ceo@backcheckgroup.com','','','','',"CEO");
//emailTmp($table,$subject,'danish@xcluesiv.com','','','','',"Danish");
//emailTmp($table,$subject,'hassan@xcluesiv.com','','','','',"Hassan");    
//emailTmp($table,$subject,'erum@backcheckgroup.com','','','','',"Erum Hanif");
//emailTmp($table,$subject,'athar@backcheckgroup.com','','','','',"Athar Khan");
//emailTmp($table,$subject,'saima@backcheckgroup.com','','','','',"Saima Qaiser");
//emailTmp($table,$subject,'sarfaraz@backcheckgroup.com','','','','',"Sarfaraz Ahmed");
}
}



?>