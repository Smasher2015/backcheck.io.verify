<?php include("include/config.php");

$toDate=date("Y-M-d");
//$toDate="2016-06-02";
//$fromDate = date_format($toDate,"Y-M-d");
$MisYesterday = date("D, M d, Y",strtotime($toDate));
 

if($_REQUEST['send']=="yes"){
	$bccEmails = "cfo@backcheckgroup.com,ceo@backcheckgroup.com,erum@backcheckgroup.com";
	$groupEmail = "mis@backcheckgroup.com";

	$tbls = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.`v_id` INNER JOIN attachments att ON att.checks_id=vc.`as_id` INNER JOIN checks c ON c.checks_id=vc.`checks_id` INNER JOIN company cc ON cc.id=vd.`com_id`";
	$cols = "cc.name,v_uadd,vd.com_id,v_name,emp_id,checks_title,att_comments,vc.as_id,vc.v_id";
	$where = "as_isdlt=0 AND v_isdlt=0 AND as_status='Insufficient' AND att_insuff=1 AND DATE(att.att_insuff_date)='$toDate' GROUP BY vd.com_id";
	//echo "SELECT $cols FROM $tbls WHERE $where";
	$sel = $db->select($tbls,$cols,$where);
if(@mysql_num_rows($sel)>0){
$wholedata = "";

	$index = 0;
	$c = 0;
	$cc = 0;
	
	$selCom = $db->select("company ","id"," disabled_id=0 AND is_active=1 and id NOT IN (20,81,82,92,96) group by id");
	$comIDS = array();
	while($rsComIDS = mysql_fetch_assoc($selCom)){
		$comIDS[]=$rsComIDS['id'];
	}
	$notinArr=array();
	//die(var_dump($comIDS));
    while($recent_wk= mysql_fetch_assoc($sel)){
			
		
		$com_id = $recent_wk['com_id'];
		$com_name = $recent_wk['name'];
		if(in_array($com_id,$comIDS)){
				$notinArr[]= $com_id;
				//echo $com_id."<br>";
					}
	//	echo "<h2>Client #: ".$cc++."  Company Name: $com_name </h2><br>";
		
		$email_arr = array();
		$user_names = array();
		$user_info = $db->select("users ","*","com_id=$com_id and level_id=4 and is_active=1");     
		if(mysql_num_rows($user_info)>0){
							while($uemail = mysql_fetch_assoc($user_info)){
								if($uemail['is_insuff_notify_digest']==1){
								$email_arr[]  =  $uemail['email'];
								 
								$user_names[] = $uemail['first_name']." ". $uemail['last_name'];
							}
							
							}
						}
       		$where2 = "vd.com_id='$com_id' AND as_isdlt=0 AND v_isdlt=0 AND as_status='Insufficient' AND att_insuff=1 AND DATE(att.att_insuff_date)='$toDate' GROUP BY vc.as_id";
			$recent_wk =  $db->select($tbls,$cols,$where2);
			$data_table = 
					'<table width="100%" border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">
					<tr>
					<td align="center" width="100%" colspan="8" style="border:none;">&nbsp;</td>
				  </tr>
				  
					<tr>
					<td align="center" width="100%" colspan="8" style="border:none;"><h2 style="color:#465059; padding:20px 0 0 0; margin:0;">'.$com_name.'</h2></td>
				  </tr>
				  <tr>
					<td align="center" width="100%" colspan="8" style="border:none; color:#54565c;"><br>Daily Insuffcient checks list '.$com_name.'\'s  checks.<br><br><br></td>
				  </tr>
					<tr>
					<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Applicant Name</th>
					<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Employee Code</th>
					<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Check Title</th>
					<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Reason</th>
					<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Link</th>
					</tr>';
					
			while($rwk = mysql_fetch_assoc($recent_wk)){
				if($com_id==$rwk['com_id']){
				$com_name = $rwk['name'];
				$case_id = $rwk['v_id'];
				$as_id = $rwk['as_id'];
										
						$clink =  '<a href="'.SURL.'?action=details&case='.$case_id.'#'.$as_id.'" style="color:#8EC537">View Details</a>';
						              
							
						$data_table .= '<tr>
						<td width="20%" style="font-size:12px; padding:5px;"><a href="'.SURL.'?action=details&case='.$case_id.'#'.$as_id.'" style="color:#8EC537">'.$rwk['v_name'].'</a></td>
						<td width="10%" style="font-size:12px; padding:5px;">'.$rwk['emp_id'].'</td>
						<td width="20%" style="font-size:12px; padding:5px;">'.$rwk['checks_title'].'</td>
						<td width="10%" style="font-size:12px; padding:5px;">'.$rwk['att_comments'].'</td>
						<td width="10%" align="center" style="font-size:12px; padding:5px;">'.$clink.'</td>
											</tr>';
						
					
						
			
				}
				
			}
			
			$data_table .= '</table>';
			$email_title = 'Daily Insuffcient checks list of '.$com_name.' - '.$MisYesterday;
			
			$ccEmails = implode(',',$email_arr);
			
			
			$myData = array_merge($email_arr,$user_names);
			foreach($email_arr as  $key => $email){
				$c++;
				
				
			echo "<h2>Email #: ".$c."  Company Name: $com_name </h2> <br /> User Name: $user_names[$key] <br /> User Email: $email <br /> <br />".$data_table;	
			
			$userEmails = strtolower($email);
			//emailTmp( $data_table, $email_title,$userEmails,'',$groupEmail,'','',$user_names[$key]);
			emailTmp( $data_table, $email_title,'khalique@xcluesiv.com','','','','',$user_names[$key]);
			emailTmp( $data_table, $email_title,$groupEmail,'','','','',$user_names[$key]);
				
			}
			
			
			$index++; 
			
			$wholedata .= $data_table;
		// delay for 10 seconds
		sleep(5);	
	  }
	//echo  $wholedata;
	  
	
	  
	// $bccEmails = "cfo@backcheckgroup.com,erum@backcheckgroup.com";
	  //$bccEmails = "khalique.ahmed3@gmail.com,ayaz@xcluesiv.com,hassan@xcluesiv.com";
	
}
	  
}
	  
    ?>
