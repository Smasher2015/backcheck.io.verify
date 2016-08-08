<?php include("include/config.php");

$toDate=date("Y-M-d");
$mydate = date($toDate,strtotime("-6 days"));
//$fromDate = date_format($toDate,"Y-M-d");

$fromDate = date("Y-M-d", strtotime($toDate . "-6 day"));

//echo "todate: ".$toDate." mydate: ".$mydate;

 

if($_REQUEST['send']=="yes"){
	$bccEmails = "cfo@backcheckgroup.com,ceo@backcheckgroup.com,erum@backcheckgroup.com";
	$groupEmail = "mis@backcheckgroup.com";
	//$groupEmail = "hassan@xcluesiv.com";
$recent_week = weekly_checks_data('GROUP BY com_ids');

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
    while($recent_wk= mysql_fetch_assoc($recent_week)){
		
		$com_id = $recent_wk['com_ids'];
		$com_name = $recent_wk['com_name'];
		if(in_array($com_id,$comIDS)){
				$notinArr[]= $com_id;
				//echo $com_id."<br>";
					}
		//echo "<h2>Client #: ".$cc++."  Company Name: $com_name </h2><br>";
		$com_email = $recent_wk['com_email'];
		$com_person_name = $recent_wk['com_pname'];
		$email_arr = array();
		$user_names = array();
		$user_info = $db->select("users ","*","com_id=$com_id and level_id=4 and is_active=1");     
		if(mysql_num_rows($user_info)>0){
							while($uemail = mysql_fetch_assoc($user_info)){
								
								$email_arr[]  =  $uemail['email'];
								 
								$user_names[] = $uemail['first_name']." ". $uemail['last_name'];
							}
						}else{
							
							$email_arr[]  =  $com_email;
							$user_names[] = $com_person_name;
						}
       		
			$recent_wk = weekly_checks_data();
			$data_table = 
					'<table width="100%" border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">
					<tr>
					<td align="center" width="100%" colspan="8" style="border:none;">&nbsp;</td>
				  </tr>
				  
					<tr>
					<td align="center" width="100%" colspan="8" style="border:none;"><h2 style="color:#465059; padding:20px 0 0 0; margin:0;">'.$com_name.'</h2></td>
				  </tr>
				  <tr>
					<td align="center" width="100%" colspan="8" style="border:none; color:#54565c;"><br>Please review the weekly update on '.$com_name.'\'s  checks.<br><br><br></td>
				  </tr>
					<tr>
						<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Name</th>
						<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Employee Code</th>
						<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Check Title</th>
						<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Followups</th>
						<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Verification Status</th>
						<th width="15%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Submited On</th>
						
						<th width="15%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Updated On</th>
						<th width="10%" align="center" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Action</th>
					</tr>';
					
			while($rwk = mysql_fetch_assoc($recent_wk)){
				if($com_id==$rwk['com_ids']){
					$followSel = $db->select("add_data ","d_id","d_type'followup' AND as_id=$rwk[as_id]"); 
					
					$countFolowups = @mysql_num_rows($followSel);
					
						$case_id = $rwk['v_id'];
												
						
										
						$clink =  '<a href="'.SURL.'?action=details&case='.$case_id.'" style="color:#8EC537">View Details</a>';
						              
							
						$data_table .= '<tr>
												<td width="20%" style="font-size:12px; padding:5px;">'.$rwk['v_name'].'</td>
												<td width="10%" style="font-size:12px; padding:5px;">'.$rwk['emp_id'].'</td>
												<td width="20%" style="font-size:12px; padding:5px;">'.$rwk['checks_title'].'</td>
												<td width="10%" style="font-size:12px; padding:5px;">'.$countFolowups.'</td>
												<td width="10%" style="font-size:12px; padding:5px;">'.$rwk['as_vstatus'].'</td>
												<td width="15%" style="font-size:12px; padding:5px;">'.date("Y-m-d",strtotime($rwk['as_addate'])).'</td>
												<td width="15%" style="font-size:12px; padding:5px;">'.date("Y-m-d",strtotime($rwk['as_pdate'])).'</td>
												<td width="10%" align="center" style="font-size:12px; padding:5px;">'.$clink.'</td>
											</tr>';
						
					
						
			
				}
				
			}
			
			$data_table .= '
					</table>
					
					<table width="600" border="0" cellpadding="5" style="margin:0 auto; border-spacing: 0px; border-radius: 10px 10px 0 0; overflow: hidden; font-family:Verdana, Geneva, sans-serif; color:#54565c;" bgcolor="#f6f6f7" ><tr>
					<td align="left" width="100%" colspan="8" style="border:none;"><br><br>Thanks for using Background Check Group\'s Services.</td>
					</tr>
					<tr>
					<td align="left" width="100%" colspan="8" style="border:none;">Sincerely,<br><br>Client Support Team,<br>Background Check Group.</td>
					</tr>				
					</table>';
			$email_title = 'Weekly Checks Update of '.$com_name.' - '.$fromDate.' to '.$toDate;
			
			$ccEmails = implode(',',$email_arr);
			
			
			$myData = array_merge($email_arr,$user_names);
			foreach($email_arr as  $key => $email){
				$c++;
				
			echo "<h2>Email #: ".$c."  Company Name: $com_name </h2> <br /> User Name: $user_names[$key] <br /> User Email: $email <br /> <br />".$data_table;	
			
			$userEmails = strtolower($email);
			emailTmp( $data_table, $email_title,$userEmails,'',$groupEmail,'','',$user_names[$key]);
			//emailTmp( $data_table, $email_title,'khalique@xcluesiv.com','',$groupEmail,'','',$user_names[$key]);
			//emailTmp( $data_table, $email_title,$groupEmail,'','','','',$user_names[$key]);
				
			}
			
			
			$index++; 
			
			$wholedata .= $data_table;
		// delay for 10 seconds
		sleep(5);	
	  }
	  
	 $selCom2 = $db->select("company ","id,email,pname,name"," disabled_id=0 AND is_active=1 and id NOT IN (20,81,82,92,96) group by id");
	
	  while($rsComIDS = mysql_fetch_assoc($selCom2)){
		 $com_id = $rsComIDS['id'];
		  if(is_array($notinArr) && (!empty($notinArr))){
		  if(!in_array($com_id,$notinArr)){
			 //echo "id='".$com_id."' <br>";
			
			$com_name = $rsComIDS['name'];
			$com_email = $rsComIDS['email'];
		$com_person_name = $rsComIDS['pname'];
		$email_arr = array();
		$user_names = array();
		$user_info = $db->select("users ","*","com_id=$com_id and level_id=4 and is_active=1");     
		if(mysql_num_rows($user_info)>0){
							while($uemail = mysql_fetch_assoc($user_info)){
								
								$email_arr[]  =  $uemail['email'];
								 
								$user_names[] = $uemail['first_name']." ". $uemail['last_name'];
							}
						}else{
							
							$email_arr[]  =  $com_email;
							$user_names[] = $com_person_name;
						}
			
			
			$data_table ='<table width="100%" border="0" style="background-color:#f6f6f7;">
			<tr>
			<td align="center" width="100%" colspan="8" style="border:none;">&nbsp;</td>
		  </tr>
		  
			<tr>
			<td align="center" width="100%" colspan="8" style="border:none;"><h2 style="color:#465059; padding:20px 0 0 0; margin:0; font-family:Verdana, Geneva, sans-serif;">'.$com_name.'</h2></td>
		  </tr>
		  <tr>
			<td align="center" width="100%" colspan="8" style="border:none;">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center" width="100%" colspan="8" style="border:none; color:#54565c; font-family:Verdana, Geneva, sans-serif;">No checks updated in this week.</td>
		  </tr>
		  <tr>
			<td align="center" width="100%" colspan="8" style="border:none;">&nbsp;</td>
		  </tr>
		  </table>
		  
		  <table width="600" border="0" cellpadding="5" style="margin:0 auto; border-spacing: 0px;  overflow: hidden; font-family:Verdana, Geneva, sans-serif; color:#54565c;" bgcolor="#f6f6f7" ><tr>
					<td align="left" width="100%" colspan="8" style="border:none;"><br><br>Thanks for using Background Check Group\'s Services.</td>
					</tr>
					<tr>
					<td align="left" width="100%" colspan="8" style="border:none;">Sincerely,<br><br>Client Support Team,<br>Background Check Group.</td>
					</tr>				
					</table>
		  ';
			
			$email_title = 'Weekly Checks Update of '.$com_name.' - '.$fromDate.' to '.$toDate;
			
			$ccEmails = implode(',',$email_arr);
			
			
			$myData = array_merge($email_arr,$user_names);
			foreach($email_arr as  $key => $email){
				$c++;
				
			echo "<h2>Email #: ".$c."  Company Name: $com_name </h2> <br /> User Name: $user_names[$key] <br /> User Email: $email <br /> <br />".$data_table;	
			
			$userEmails = strtolower($email);
			emailTmp( $data_table, $email_title,$userEmails,'',$groupEmail,'','',$user_names[$key]);
			//emailTmp( $data_table, $email_title,$userEmails,'','','','',$user_names[$key]);
			//emailTmp( $data_table, $email_title,$groupEmail,'','','','',$user_names[$key]);
			//sleep(5);		
			}
			
			 $wholedata .= $data_table;
			 
			 
		  }
	  }
		
				
		  
	  }
	  
	  //echo  $wholedata;
	  
	
	  
	// $bccEmails = "cfo@backcheckgroup.com,erum@backcheckgroup.com";
	  //$bccEmails = "khalique.ahmed3@gmail.com,ayaz@xcluesiv.com,hassan@xcluesiv.com";
	emailTmp( $wholedata, $email_title,'hassan@xcluesiv.com');
	//emailTmp( $wholedata, $email_title,'hassan@xcluesiv.com');
	  
}
	  
    ?>
