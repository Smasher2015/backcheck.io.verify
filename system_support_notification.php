<?php 
	include ('include/config.php');
	$_REQUEST['date']=date("Y-m-d");
	$localDate = date("D, M d, Y");
		$table = '<table  border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">';
				$table .= '
				<tr>
				<td align="center" width="100%" colspan="10" style="border:none;">&nbsp;</td>
				</tr>
				<tr>
				<td align="center" width="100%" colspan="10" style="border:none;">Following are the Tickets which are not closed yet.<br /><strong>'.$localDate.'</strong> </td>
				</tr>
				<tr>
				<td align="center" width="100%" colspan="10" style="border:none;">&nbsp;</td>
				</tr>
				<tr>
				<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Ticket Number</th>
				<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Ticket Title</th>
 				<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Ticket Priorty</th>
				<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Ticket Status</th>
           
				</tr>';
		$cols = "*"; 
		$tbls = "system_support AS sp 
				LEFT JOIN `support_chat` AS sc ON sp.sp_id=sc.sp_id";
		$WHERE = "sp.sp_add_date > (NOW()-INTERVAL 1 DAY)  AND sp.sp_status='Open' AND ISNULL(sc.sp_id)";
		$see=0;		 
		$analyst= $db->select($tbls,$cols,$WHERE);
        if(mysql_num_rows($analyst)>0){
       	 	while($analyst_arr = mysql_fetch_array($analyst)){
				$see++;
				$table .= ' 
					<tr>
						<td width="" style="font-size:12px; padding:5px;">'.$analyst_arr['sp_ticker_number'].'</td>
						<td width="" style="font-size:12px; padding:5px;">'.$analyst_arr['sp_title'].'</td>
						<td width="" style="font-size:12px; padding:5px;">'.$analyst_arr['sp_priorty'].'</td>
						<td width="" style="font-size:12px; padding:5px;">'.$analyst_arr['sp_status'].'</td>

            		</tr>'; 	
			
				$check_last_record = $db->select("support_chat","*","sp_id = ".$analyst_arr['sp_id']." ORDER BY sp_id  DESC");
				$check_last_data = mysql_fetch_array($check_last_record);
				$check_user = $db->select("users","*","user_id = ".$check_last_data['user_id']);
				$check_user_data = mysql_fetch_array($check_user);
				$level_id = $check_user_data['level_id'];
				/*if($level_id!=2){
					$table .= "</table>";
					$subject="Tickets Details (".$localDate.")";
					$to_email="ayaz@xcluesiv.com";
					echo $table;
					emailTmp($table,$subject,$to_email,'','','','',"Ayaz");
				}*/
			}
		}
		
		$cols_isR = "*"; 
		$tbls_isR = "system_support AS sp 
					LEFT JOIN `support_chat` AS sc ON sp.sp_id=sc.sp_id";
		$WHERE_isR = "sp.sp_add_date > (NOW()-INTERVAL 1 DAY)  AND sp.sp_status='Open' AND !ISNULL(sc.sp_id)";
		$see_isR=0;		 
		$analyst_isR= $db->select($tbls_isR,$cols_isR,$WHERE_isR);
		//echo "SELECT $cols_isR FROM $tbls_isR WHERE $WHERE_isR";
		
        if(mysql_num_rows($analyst_isR)>0){
       	 	while($analyst_arr_isR = mysql_fetch_array($analyst_isR)){
				$see_isR++;
				$check_last_record = $db->select("support_chat","*","sp_id = ".$analyst_arr_isR['sp_id']." ORDER BY sc_id DESC LIMIT 0,1");
				$check_last_data = mysql_fetch_array($check_last_record);
				$check_user = $db->select("users","*","user_id = ".$check_last_data['user_id']);
				$check_user_data = mysql_fetch_array($check_user);
				$level_id = $check_user_data['level_id'];
				if($level_id!=2){
				$table .= ' 
					<tr>
						<td width="" style="font-size:12px; padding:5px;">'.$analyst_arr_isR['sp_ticker_number'].'</td>
						<td width="" style="font-size:12px; padding:5px;">'.$analyst_arr_isR['sp_title'].'</td>
						<td width="" style="font-size:12px; padding:5px;">'.$analyst_arr_isR['sp_priorty'].'</td>
						<td width="" style="font-size:12px; padding:5px;">'.$analyst_arr_isR['sp_status'].'</td>

            		</tr>'; 	
				}
			}
		}

				$table .= "</table>";
				$subject="Tickets Details (".$localDate.")";
				$to_email="ayaz@xcluesiv.com";
				echo $table;		

if($see!=0){
	emailTmp($table,$subject,$to_email,'','','','',"Ayaz");
}
if($see_isR!=0){
	emailTmp($table,$subject,$to_email,'','','','',"Ayaz");
}
?>