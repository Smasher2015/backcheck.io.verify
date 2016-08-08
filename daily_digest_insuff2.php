<?php include("include/config.php");



$toDate=date("Y-M-d");
$toDate="2016-06-02";
$mydate = date($toDate,strtotime("-6 days"));
//$fromDate = date_format($toDate,"Y-M-d");
$MisYesterday = date("D, M d, Y",strtotime($toDate));

$fromDate = date("Y-M-d", strtotime($toDate . "-6 day"));

//echo "todate: ".$toDate." mydate: ".$mydate;


$tbls = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.`v_id` INNER JOIN checks c ON c.checks_id=vc.`checks_id` INNER JOIN company cc ON cc.id=vd.`com_id`";
	$cols = "vc.v_id,v_uadd,vd.com_id,v_name,emp_id,checks_title,date(v_date) as v_date";
	$where = "as_isdlt=0 AND v_isdlt=0 AND v_rlevel='N/A' GROUP BY vc.v_id order by v_date asc";
	//echo "SELECT $cols FROM $tbls WHERE $where";
	$sel = $db->select($tbls,$cols,$where);
	$cc=0;
	$bodyTbl = "<table cellpadding='5' cellspacing='0' border='1' >
	<tr><td>#</td><td>Applicant</td><td>Closed</td> <td>Added On</td><td>Bitrix URL</td><td>Portal URL</td></tr>";
	while($rs  = @mysql_fetch_assoc($sel)){
		$tnt = countChecks("vc.v_id=$rs[v_id] AND as_isdlt=0");
        $cnt = countChecks("vc.as_status='Close' AND vc.v_id=$rs[v_id] AND as_isdlt=0");
		if($tnt==$cnt){
			$cc++;
			
			$bitrixURL = "http://my.backcheck.io/search/index.php?q=".urlencode($rs[v_name])."";
			$portalURL = SURL."?action=details&case=$rs[v_id]&_pid=183";
		$bodyTbl .= "<tr><td>$cc.</td><td>$rs[v_name]</td> <td>$cnt of $tnt</td> <td>$rs[v_date]</td><td><a href='$bitrixURL' target='_blank'>View</a></td><td><a href='$portalURL' target='_blank'>View</a></td></tr>";
		}
                
	}
$bodyTbl .= "</table>";
echo $bodyTbl;
exit;

 

if($_REQUEST['send']=="yes"){
	
	$groupEmail = "mis@backcheckgroup.com";
	
	$selCom = $db->select("company ","id,name"," disabled_id=0 AND is_active=1 and id NOT IN (20,81,82,92,96) group by id");
	$comIDS = array();
	$data_table = '';
	while($rsComIDS = @mysql_fetch_assoc($selCom)){
		
	
	
	
	$tbls = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.`v_id` INNER JOIN attachments att ON att.checks_id=vc.`as_id` INNER JOIN checks c ON c.checks_id=vc.`checks_id` INNER JOIN company cc ON cc.id=vd.`com_id`";
	$cols = "cc.name,v_uadd,vd.com_id,v_name,emp_id,checks_title,att_comments,vc.as_id,vc.v_id";
	$where = "vd.com_id=$rsComIDS[id] AND as_isdlt=0 AND v_isdlt=0 AND as_status='Insufficient' AND att_insuff=1 AND DATE(att.att_insuff_date)='$toDate' GROUP BY vc.as_id";
	//echo "SELECT $cols FROM $tbls WHERE $where";
	$sel = $db->select($tbls,$cols,$where);
	
	if(@mysql_num_rows($sel)>0){
	$clientID = $rsComIDS['id'];
	$com_name = $rsComIDS['id'];
	$comIDS[]=$rsComIDS['id'];
	$data_table .= '<table width="100%" border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">
					<tr>
					<td align="center" width="100%" colspan="8" style="border:none;">&nbsp;</td>
					</tr>
					<tr>
					<td align="center" width="100%" colspan="8" style="border:none;"><h3>'.$com_name.'</h3></td>
					</tr>
					<tr>
					<td align="center" width="100%" colspan="8" style="border:none;">The following checks marked as insufficient</td>
					</tr>
					<tr>
					<td align="center" width="100%" colspan="8" style="border:none;">&nbsp;</td>
					</tr>
					<tr>
					<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Applicant Name</th>
					<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Employee Code</th>
					<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Check Title</th>
					<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Reason</th>
					<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Link</th>									
					</tr>';
					
	while($rs = @mysql_fetch_assoc($sel)){
	$com_name = $rs['name'];
	$case_id = $rs['v_id'];
	$as_id = $rs['as_id'];
					
	$clink =  '<a href="'.SURL.'?action=details&case='.$case_id.'#'.$as_id.'" style="color:#8EC537">View Details</a>';
						              
							
	$data_table .= '<tr>
						<td width="20%" style="font-size:12px; padding:5px;"><a href="'.SURL.'?action=details&case='.$case_id.'#'.$as_id.'" style="color:#8EC537">'.$rs['v_name'].'</a></td>
						<td width="10%" style="font-size:12px; padding:5px;">'.$rs['emp_id'].'</td>
						<td width="20%" style="font-size:12px; padding:5px;">'.$rs['checks_title'].'</td>
						<td width="10%" style="font-size:12px; padding:5px;">'.$rs['att_comments'].'</td>
						<td width="10%" align="center" style="font-size:12px; padding:5px;">'.$clink.'</td>
					</tr>';
						
	$clUsers = getClUser($clientID);	
	if($clUsers){

	while($clUser = @mysql_fetch_assoc($clUsers)){
	if($clUser[com_id]==$clientID){
		
	}	
	}
	}
	
	}
	
	
	

	$data_table .= '</table>'; 
	
	$clUsers = getClUser($clientID);
	$subject = 'Insuffcient checks report '.$com_name.' - '.$MisYesterday;

	if($clUsers){

		while($clUser = @mysql_fetch_assoc($clUsers)){
			
			
			// to all parent users
			if($clUser['is_subuser']==0){	
			$fullName = $clUser['first_name'].' '.$clUser['last_name'];
			$userEmails = $clUser['email'];
			$user_names = $fullName;
			//emailTmp( $data_table, $subject,$userEmails,'',$groupEmail,'','',$user_names);
			//emailTmp( $data_table, $subject,'khalique@xcluesiv.com','','','','',$user_names);
			}
			
			
			
			

				

		}

	}
	
	}
	}
	
	
	echo $data_table;
	
	
}

	  
    ?>
