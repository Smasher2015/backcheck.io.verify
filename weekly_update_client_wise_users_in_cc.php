<?php include("include/config.php");

$recent_week = weekly_checks_data('GROUP BY com_ids');

$wholedata = "";

	$index = 0;
	$c=0;
    while($recent_wk= mysql_fetch_assoc($recent_week)){
		$c++;
		
		$com_id = $recent_wk['com_ids'];
		$com_name = $recent_wk['com_name'];
		$com_email = $recent_wk['com_email'];
		$com_person_name = $recent_wk['com_pname'];
		$email_arr = array();
		$user_ids = array();
		$user_info = $db->select("users ","*","com_id=$com_id and level_id=4 and is_active=1");     
		if(mysql_num_rows($user_info)>0){
							while($uemail = mysql_fetch_assoc($user_info)){
								//echo $com_id. "ComName: $com_name <br> Com email ";
								//echo ($uemail['email']!="")?$uemail['email']:$com_email;
								//echo " <br> <br>";
								$email_arr[]  =  $uemail['email'];
								 
								$user_names[] = $uemail['first_name']." ". $uemail['last_name'];
							}
						}else{
							
							$email_arr[]  =  $com_email;
							$user_names[] = $com_person_name;
						}
       		//echo  'company id = '.$recent_wk['com_ids'].'<br />';
			$recent_wk = weekly_checks_data();
			$data_table = 
	'<table width="100%" border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">
	<tr>
  	<td align="center" width="100%" colspan="7" style="border:none;">&nbsp;</td>
  </tr>
  
	<tr>
  	<td align="center" width="100%" colspan="7" style="border:none;"><h2 style="color:#465059; padding:20px 0 0 0; margin:0;">'.$com_name.'</h2></td>
  </tr>
  <tr>
  	<td align="center" width="100%" colspan="7" style="border:none;">&nbsp;</td>
  </tr>
					<tr>
						<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Name</th>
						<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Employee Code</th>
						<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Check Title</th>
						<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Check Status</th>
						<th width="15%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Submited On</th>
						
						<th width="15%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Updated On</th>
						<th width="10%" align="center" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Action</th>
					</tr>';
					
			while($rwk = mysql_fetch_assoc($recent_wk)){
				if($com_id==$rwk['com_ids']){
					
					
						$case_id = $rwk['v_id'];
												
						
										
						$clink =  '<a href="'.SURL.'?action=details&case='.$case_id.'" style="color:#8EC537">View Details</a>';
						              
							
						$data_table .= '<tr>
												<td width="20%" style="font-size:12px; padding:5px;">'.$rwk['v_name'].'</td>
												<td width="10%" style="font-size:12px; padding:5px;">'.$rwk['emp_id'].'</td>
												<td width="20%" style="font-size:12px; padding:5px;">'.$rwk['checks_title'].'</td>
												<td width="10%" style="font-size:12px; padding:5px;">'.$rwk['as_status'].'</td>
												<td width="15%" style="font-size:12px; padding:5px;">'.date("Y-m-d",strtotime($rwk['as_addate'])).'</td>
												<td width="15%" style="font-size:12px; padding:5px;">'.date("Y-m-d",strtotime($rwk['as_pdate'])).'</td>
												<td width="10%" align="center" style="font-size:12px; padding:5px;">'.$clink.'</td>
											</tr>';
						
					
						
			
				}
				
			}
			
			$data_table .= '</table>';
			$email_title = 'Weekly Update';
			
			$ccEmails = implode(',',$email_arr);
			$user_names_arr = implode(',',$user_names);
			//echo $com_id. "ComName: $com_name <br> Emails: $ttttt <br>";
			if($com_id==1){
			//$ccEmails = "khalique.ahmed3@gmail.com,ayaz@xcluesiv.com,hassan@xcluesiv.com";
			}
			if($com_id==99){
			//$ccEmails = "khalique.ahmed.khan@gmail.com";
			}
			echo "<h2>Email #: ".$c."  Company Name: $com_name </h2> <br /> User Names: $user_names_arr <br /> User Email: $ccEmails <br /> <br />";	
			emailTmp( $data_table, $email_title,'hassan@xcluesiv.com','','','',''," Client ($com_name)");
			
			$index++; 
			
			$wholedata .= $data_table;
			
	  }
	 //$bccEmails = "cfo@backcheckgroup.com,ceo@backcheckgroup.com,erum@backcheckgroup.com";
	  $bccEmails = "khalique.ahmed3@gmail.com,ayaz@xcluesiv.com,hassan@xcluesiv.com";
	  //emailTmp( $wholedata, $email_title,'khalique@xcluesiv.com','',$bccEmails);
	  //echo $wholedata;
	  
	  
    ?>
