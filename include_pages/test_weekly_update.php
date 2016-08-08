<?php 
/*$recent_week = $db->select("ver_checks AS vc 
INNER JOIN `ver_data` AS vd ON vc.v_id=vd.v_id 
INNER JOIN `company` AS cmp ON vd.com_id=cmp.id",
"vc.as_id,cmp.id AS com_ids","vc.as_pdate >= CURDATE() - INTERVAL DAYOFWEEK(CURDATE())+6 DAY
AND vc.as_pdate < CURDATE() - INTERVAL DAYOFWEEK(CURDATE())-1 DAY GROUP BY com_ids"
);*/
$recent_week = weekly_checks_data('GROUP BY com_ids');

?>

<div class="manager-report-sec" style="background:#FFFFFF;">

	<?php /*?><table border="1">
	<thead>
    	<tr>
        	<th>ID</th>
            <th>Company ID</th>
            <th>Email</th>
          
        </tr>
    </thead>
    <tbody>

	<?php 
    while($recent_wk= mysql_fetch_assoc($recent_week)){
		$com_id = $recent_wk['com_ids'];
		$user_info = $db->select("users ","*","com_id=$com_id");
		$user_email = mysql_fetch_assoc($user_info);
	?>
    	<tr>
        	<td><?=$recent_wk['as_id']?></td>
            <td><?=$recent_wk['com_ids']?></td>
            <td><?=$user_email['email']?></td>
            
        </tr>
   <?php  }
    ?>
	</tbody>
</table>

<?php */?>



	<?php 
	$index = 0;
    while($recent_wk= mysql_fetch_assoc($recent_week)){
		$com_id = $recent_wk['com_ids'];
		$user_info = $db->select("users ","*","com_id=$com_id and level_id=4");        	
       		//echo  'company id = '.$recent_wk['com_ids'].'<br />';
			$recent_wk = weekly_checks_data();
			$data_table = 
					'<table width="100%" border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">
					<tr>
						<th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Name</th>
						<th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Employee Code</th>
						<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Check Title</th>
						<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Check Status</th>
						<th width="20%" align="center" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Action</th>
					</tr>';
			while($rwk = mysql_fetch_assoc($recent_wk)){
				if($com_id==$rwk['com_ids']){
						$case_id = $rwk['v_id'];
						$email_arr = array();
							while($uemail = mysql_fetch_assoc($user_info)){
								$email_arr[] = $uemail['email'];
							}
						$to 	= implode(';',$email_arr);
						//echo 'Case ID'.$case_id;
						echo 	$to;
						//echo   'check id = '.$rwk['as_id'].'<br />';
						//echo   'check id = '.$rwk['as_id'].'<br />';
						echo 'Applicant Name 	= '.$rwk['v_name'];
						echo 'Check Title 		= '.$rwk['checks_title'];
						echo 'Check Status 		= '.$rwk['as_status'];
						echo '<a href="'.SURL.'?action=details&case='.$case_id.'" target="_blank">Details</a><br />';
						$clink =  '<a href="'.SURL.'?action=details&case='.$case_id.'" style="color:#8EC537">View Details</a>';
						
						
                        /*$data_table .= '	<table border="1">
                            	<thead>
                                	<tr>
                                        <th>Name :</th>
                                        <th>Check Title</th>
                                        <th>Check Status</th>
                                        <th>Details</th>
                                        <th>Client Emails (For Testing)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<tr>
                                    	<td>'.$rwk['v_name'].'</td>
                                        <td>'.$rwk['checks_title'].'</td>
                                        <td>'.$rwk['as_status'].'</td>
                                        <td>'.$clink.'</td>
                                        <td>'.$to.'</td>
                                    </tr>
                                </tbody>
                            </table>';
							*/
							
							$data_table .= '<tr>
												<td width="30%" style="font-size:12px; padding:5px;">'.$rwk['v_name'].'</td>
												<td width="30%" style="font-size:12px; padding:5px;">'.$rwk['emp_id'].'</td>
												<td width="25%" style="font-size:12px; padding:5px;">'.$rwk['checks_title'].'</td>
												<td width="25%" style="font-size:12px; padding:5px;">'.$rwk['as_status'].'</td>
												<td width="20%" align="center" style="font-size:12px; padding:5px;">'.$clink.'</td>
											</tr>';
						
					
						
			
				}
				
			}
			$data_table .= '</table>';
			$email_title = 'Weekly Update '.$index;
			emailTmp( $data_table, $email_title,'ayaz@xcluesiv.com');
			$index++; 
			echo '<br />';
	  }
	  
    ?>
</div>