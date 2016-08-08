<?php include ('/home/backglob/public_html/verify/include/config.php');
	//AND bitrixlid IS NULL	
		global $db;
		$cols = "vc.v_id,vc.as_id,bitrixlid,user_id,country_id,v_name,v_ftname,emp_id,v_dob,v_nic,as_bcode,as_addate,vc.checks_id,v_date";
		$tbls = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id ";
		$where = "as_isdlt=0 AND v_isdlt=0 AND as_status!='Close'   AND (bitrixtid=0 OR ISNULL(bitrixtid) )   LIMIT 1";
		$sel = $db->select($tbls,$cols,$where);
		$attachments=array();
		$task_array=array();
		$lead_array=array();
		while($rs = @mysql_fetch_assoc($sel)){
			//echo "v_id: ".$rs['v_id']." as_id: ".$rs['as_id']; exit;
		$country = (int) (isset($rs['country']))?$rs['country']:171;
		
		if(empty($rs[bitrixlid]) || $rs[bitrixlid]==""){
		$countChecks = countChecks("vc.v_id=$rs[v_id] AND v_isdlt=0");	
		$lead_array['name']='Case For '.$rs[v_name] ." - $rs[v_bcode] - Total Checks: ".$countChecks;
		$lead_array['comment']="
		Father Name : $rs[v_ftname]
		NIC : $rs[v_nic]
		Date of Birth : $rs[dob]
		Received Date : ".date("Y-m-d",strtotime($rs['v_date']));
		$lead_array['user_id']='1';
		$lead_array['BIRTHDATE']=$rs[dob];
		$lead_array['erpid']=$rs[emp_id];
		$lead_array['country_id']=$country;
		
		$bitrixlid=insertleads2($lead_array);
		if($db->update("bitrixlid=$bitrixlid","ver_data","v_id=$rs[v_id]")){
		echo "Lead added successfully on bitrix"; 
		}
		}else{
		$bitrixlid=$rs[bitrixlid];
		}	
		
		$add_date = date("Y-m-d",strtotime($rs['as_addate']));
		if($country!=171){
		$AssignedToSys = 249; // user_id	Sadia=20 249=Sharjeel
		$AssignedToBitrix = 529; // bitrix user_id Sadia=480 529=Sharjeel
		$Work_Group_id = 18;
		}
		$tabl = "analyst_roles ar INNER JOIN checks c ON ar.checks_id=c.checks_id ";
		$cols = "ar.analyst_id,c.checks_title,c.group_id as group_id";
		//echo "SELECT $cols FROM $tabl WHERE ar.checks_id='".$rs[checks_id]."'";
		$selRoles = $db->select($tabl,$cols," ar.checks_id='".$rs[checks_id]."'");
		$resRoles = mysql_fetch_assoc($selRoles);
		$tabl = "`teamlead_checks` tc INNER JOIN users uc ON uc.`user_id`=tc.`team_lead_id`";
		$cols = "uc.`bitrix_id` AS `bitrix_uid`,uc.`user_id` AS `user_id`";
		$selbitrixusr = $db->select($tabl,$cols,"tc.checks_id='".$resRoles['group_id']."'");
		$bitrixuserid=mysql_fetch_assoc($selbitrixusr);
		$bitrixuserid2=($country!=171)?$AssignedToBitrix:$bitrixuserid['bitrix_uid'];
		$userid2=($country!=171)?$AssignedToSys:$bitrixuserid['user_id'];
		$analyst_id = ($resRoles['analyst_id'])?$resRoles['analyst_id']:'';
		
		$selAt = $db->select("attachments",'att_file_path',"checks_id=$rs[as_id]");
		while($rsAt = @mysql_fetch_assoc($selAt)){
		$attachments[] = $rsAt['att_file_path'];
		}
		
		$task_array['task_name']='Check For '.$rs[v_name] ." - ".$rs[as_bcode];
		$task_array['task_desc']="
		Father Name : $rs[v_ftname]
		NIC : $rs[v_nic]
		Date of Birth : $rs[v_dob]
		Received Date : $add_date
		Attachments :
		".implode(",",$attachments)."";
		$task_array['user_id']=($country!=171)?$AssignedToBitrix:$bitrixuserid2;
		$task_array['group_id']=($country!=171)?$Work_Group_id:$resRoles['group_id'];
		$task_array['country_id']=$country;
		//var_dump($task_array); die;
		if(!empty($bitrixlid) || $bitrixlid!=0){
			//echo "add_date: $add_date"; exit;
		$bitrixctid=add_task22($task_array,$bitrixlid,$add_date);
		$userid_col = ($rs[user_id]==0 || $rs[user_id]=="")?" ,user_id='$userid2' , as_status='Open' ":"";
		
		if($db->update("bitrixtid=$bitrixctid $userid_col","ver_checks","as_id=$rs[as_id]")){
		echo "Task Added Successfuly to Bitrix <br>"; exit;
		}else{
		echo "Error: update ver_checks set bitrixtid=$bitrixctid $userid_col <br> as_id: $rs[as_id] <br>";
		}	
		}
		
		}
		//var_dump($task_array);
		//var_dump($lead_array);
		function add_task22($task_arr,$parent_id=0,$add_date=""){
		 $ch = curl_init();
		 // bitrix admin: 480=Sadia 507=Saima 529=sharjeel
		 $bitrix_admin_id = ($task_arr['country_id']!=171)?529:591;
		 $add_date = (isset($add_date))?$add_date:date("Y-m-d");
		 $enddateplan=getdatedifference($add_date,8);
		 $deadline=getdatedifference($add_date,TAT);
		 $remainderdate=getdatedifference($add_date,2);
		 $query_string="action=task_add&CREATED_BY=".$bitrix_admin_id."&task_name=".$task_arr['task_name']."&desc=".$task_arr['task_desc']."&time_estimate=2&PARENT_ID=$parent_id&user_id=".$task_arr['user_id']."&group_id=".$task_arr['group_id']."&START_DATE_PLAN=".$add_date."&END_DATE_PLAN=".$enddateplan."&DEADLINE=$deadline&remainderdate=$remainderdate";
		//echo $query_string;die;
			curl_setopt($ch,CURLOPT_URL, BITRIX_URL);
			// Set a referer
		   curl_setopt($ch, CURLOPT_HEADER, FALSE);
			// Should cURL return or print out the data? (true = return, false = print)
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
			// Download the given URL, and return output
			$output = curl_exec($ch);
			$insertedtaskid=json_decode($output);
		   $bitrixtid=$insertedtaskid->insertedtaskid;
			//$db->update("bitrix_id='$bitrixuid'","users","user_id=".(int)$user_arr['user_id']."");
			// Close the cURL resource, and free system resources
		  curl_close($ch);
		   return  $bitrixtid;
	}
	
		
		/* $sel2 = $db->select("ver_checks vc inner join ver_data vd on vc.v_id=vd.v_id","as_id,bitrixtid","1=1 AND as_isdlt=1 AND is_zombie='N' AND  bitrixtid IS NOT NULL AND bitrixtid<>0 ORDER BY bitrixtid DESC LIMIT 1");
		if(@mysql_num_rows($sel2)>0){
		while($rs2 = @mysql_fetch_assoc($sel2)){
			$task_id = $rs2['bitrixtid'];
			if(task_del($task_id)){
			$db->update("is_zombie='Y'","ver_checks","as_id='$rs2[as_id]' AND bitrixtid='$task_id'");
			}else{
			echo "<br> ERROR: UPDATE ver_checks SET is_zombie='Y' WHERE as_id='$rs2[as_id]' AND bitrixtid='$task_id' <br>";	
			}
		}
		}else{
			//echo "<br>  No records to delete from bitrix <br> ";
		} */
?>
