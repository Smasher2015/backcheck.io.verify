<?php include ('include/config.php');


$today = date("Y-m-d");
$localDate = date("D, M d, Y");

// QC was started on in May 2016
		
		$bodyTable = '<table  border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">
				<tr>
				<th colspan="5" align="center" bgcolor="#ffffff" style="padding:5px;"><h2>Total rejected count of all analyst.</h2></th>
				</tr>
				<tr>
				<th width="5%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">#</th>
			
				<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Analyst</th>
				<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Total Checks</th>
            	<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Total Rejected</th>
				</tr>';
		
		
		$colss = "SUM(as_rej_count) AS reject_count,COUNT(vc.as_id) AS checkscount,  CONCAT(u.first_name,' ',last_name) AS 'Analyst'";
		
		$tblss = "ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id 
					INNER JOIN checks c ON c.checks_id=vc.checks_id 
					INNER JOIN users u ON u.user_id=vc.user_id 
					INNER JOIN `company` cc ON cc.id=vd.com_id";
		$wheres = "as_isdlt=0  AND v_isdlt=0 AND u.is_active=1 AND vc.user_id NOT IN (210,211,212,201,3,23,50) GROUP BY u.user_id HAVING reject_count>0 
	ORDER BY SUM(as_rej_count) DESC";
		
		
		$seL = $db->select($tblss,$colss,$wheres);
		$see=0;
		while($rs = @mysql_fetch_assoc($seL)){
					
					$see++;
				
				$bodyTable .= '
				<tr>
				<td width="" style="font-size:12px; padding:5px;">'.$see.'</td>
				<td width="" style="font-size:12px; padding:5px;"><a href="'.SURL.'?action=advance&atype=search&vtrport=1&fullnam='.urlencode($rs['Analyst']).'&status=all">'.$rs['Analyst'].'</a></td>
				<td width="" style="font-size:14px; padding:5px;">'.$rs['checkscount'].'</td>
             	<td width="" style="font-size:14px; padding:5px;">'.$rs['reject_count'].'</td>
				</tr>'; 	
					
				}
				
				$bodyTable .= "</table><br/><br/>";
				
				
		
		$cols = "vc.as_id,vc.v_id,v_name AS Applicant, cc.name AS 'Client', c.checks_title AS 'Check Title', concat(u.first_name,' ',last_name) AS 'Analyst', DATE(as_addate) AS Submitted, 
		as_qastatus AS 'Final QC Status',as_rej_count AS 'Reject Count'";
		$tbls = "ver_data vd 
		INNER JOIN ver_checks vc ON vd.v_id=vc.v_id 
		INNER JOIN checks c ON c.checks_id=vc.checks_id 
		INNER JOIN users u ON u.user_id=vc.user_id 
		INNER JOIN `company` cc ON cc.id=vd.com_id ";
		$where = "as_rej_count>0 AND DATE(as_pdate)>'2016-05-01' AND as_isdlt=0  AND v_isdlt=0 GROUP BY vc.as_id ORDER BY v_name";
		$see=0;
		$sel = $db->select($tbls,$cols,$where);
		$table = '<table  border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">';
				$table .= '
				
				<tr>
				<th colspan="9" align="center" bgcolor="#ffffff" style="padding:5px;"><h2>Daily QC Report.</h2></th>
				</tr>
				<tr>
				<th width="5%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">#</th>
			
				<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Applicant</th>
				<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Client</th>
            	<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Checks  Title</th>
				<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Analyst</th>

				
                <th width="5%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Reject Count</th>
                <th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Reason</th>
                <th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">QC checked in 24hrs</th>
				
				<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">VT rectified QC error on time</th>
				
            
							     </tr>';
				while($rs = @mysql_fetch_assoc($sel)){
					
					$see++;
				
				$table .= ' <tr>
				<td width="" style="font-size:12px; padding:5px;">'.$see.'</td>
				<td width="" style="font-size:12px; padding:5px;"><a href="'.SURL.'?action=details&case='.$rs['v_id'].'&_pid=53#check_tab_'.$rs['as_id'].'">'.$rs['Applicant'].'</a></td>
				<td width="" style="font-size:14px; padding:5px;">'.$rs['Client'].'</td>
             	<td width="" style="font-size:14px; padding:5px;">'.$rs['Check Title'].'</td>
				<td width="" style="font-size:14px; padding:5px;">'.$rs['Analyst'].'</td>
				<td width="" style="font-size:14px; padding:5px;">'.$rs['Reject Count'].'</td>
				<td width="" style="font-size:14px; padding:5px;">'; 
				//echo "select com_text,com_date from comments where _id=$rs[as_id] AND com_type='qa'";
				$selC = $db->select("comments c INNER JOIN qa_logs q 
				ON c._id=q.as_id","com_text ,DATE(com_date) AS com_date,qa_status,DATE(submit_date) AS submit_date","_id=$rs[as_id] AND com_type='qa' AND DATE(submit_date)=DATE(com_date) AND qa_status='Rejected' GROUP BY q.id");
				while($rsC = @mysql_fetch_assoc($selC)){
				$com_text =	($rsC[com_text]!='')?$rsC[com_text]:'No Comments';
				$table .= '['.$rsC[com_date].']  '.$com_text.' <br>';	
				}
				
				$table .='</td>
				<td width="" style="font-size:14px; padding:5px;">';
				
				//echo "select MAX(CASE WHEN (qa_status = 'QA' ) THEN DATE(submit_date) END) QA, MAX(CASE WHEN (qa_status = 'Rejected' ) THEN DATE(submit_date) END) Rejected, MAX(CASE WHEN (qa_status = 'Approved' ) THEN DATE(submit_date) END) Approved ,DATE(as_cldate) AS as_cldate from qa_logs q INNER JOIN ver_checks vc ON vc.as_id=q.as_id where q.as_id=$rs[as_id] <br>";
				
				$selQ = $db->select("qa_logs q INNER JOIN ver_checks vc ON vc.as_id=q.as_id","MAX(CASE WHEN (qa_status = 'QA' ) THEN DATE(submit_date) END) QA,
				MAX(CASE WHEN (qa_status = 'Rejected' ) THEN DATE(submit_date) END) Rejected,
				MAX(CASE WHEN (qa_status = 'Approved' ) THEN DATE(submit_date) END) Approved ,DATE(as_cldate) AS as_cldate,as_qastatus","q.as_id=$rs[as_id]");
				$rsQ = @mysql_fetch_assoc($selQ);
				
				$qaDate = ($rsQ[QA]!='')?$rsQ[QA]:$rsQ[as_pdate];	
				$rejDate = $rsQ[Rejected];	
				$appDate = $rsQ[Approved];	
				$as_qastatus = $rsQ[as_qastatus];	
				
				$endDate = ($rejDate!="")?$rejDate:$appDate;
				$days = getDaysFromDates($endDate,$qaDate);
				$days = ($days>1)?$days.' days':'Yes';
				
				$table .= $days;	
				
				
				
				
				$table .='</td>
				
				<td width="" style="font-size:14px; padding:5px;">';
				
				if(strtotime($qaDate) > strtotime($rejDate)){
				$rejDate = 	$qaDate;
				}else{
				$rejDate = $rsQ[Rejected];		
				}
				
				$appDate = $rsQ[Approved];	
				if($appDate=="" && $as_qastatus=="Rejected"){
					
				$days = getDaysFromDates($today,$rejDate);
				$days = ($days>1)?'<span style="color:#ff0000; font-weight:bold;">Not rectified <span style="font-weight:bold; font-size:18px; color:#000000;">'.$days.'</span> days elapsed</span>':'Yes';
				//$days = "Still No Approved $days days elapsed";	
				}else{
					
				$days = getDaysFromDates($appDate,$rejDate);
				$endDate = ($rejDate!="")?$rejDate:$appDate;
				$days = ($days>1)?'<span style="color:#4caf50; font-weight:bold;">Rectified in <span style="font-weight:bold; font-size:18px; color:#000000;">'.$days.'</span> days</span>':'Yes';
				$days = $days;		
				}
				
				
				
				
				$table .= $days;	
				
				
					
				
				
				$table .='</td>
				
				
			
				
                
            </tr>	    '; 	
					
				}
					
				
				$table .= '</table>';
				
				$table = $bodyTable.$table;
				
				
				
		if($_GET['send']==1){		
				
				$subject="Daily QC Report and Overall Rejected Count (".$localDate.") ";
				$to_email="khalique@xcluesiv.com";
				$fEmial="Verification Team";
				
				emailTmp($table,$subject,$to_email,'','hassan@xcluesiv.com','','',"Khalique");
				emailTmp($table,$subject,'mis@backcheckgroup.com','','','','',"BCG Team");

				//emailTmp($table,$subject,$to_email,'','','','',$fEmial);

				//$cMail="hzafar2010@gmail.com";
				//echo $bitids;
		}else{
			echo $table;
		}
				
				
				
				
				
				
				
				
				
?>