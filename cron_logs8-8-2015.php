<?php include 'include/config_index.php';
$_REQUEST['date']=date("d-m-Y");
function count_checks_total($user_id,$status){
	global $db;
	switch($status){
		case "received":
		$where="`as_addate` LIKE '%".date('Y-m-d')."%' AND user_id=$user_id";
		break;
		case "closed":
		$where="`as_status`='CLOSE' AND user_id=$user_id AND `as_pdate` LIKE '%".$_REQUEST['date']."%'";
		break;
		case "open":
		$where="`as_status`='OPEN' AND user_id=$user_id AND `as_pdate` LIKE '%".$_REQUEST['date']."%'";
		break;
		case "insufficient":
		$where="`as_vstatus`='Insufficient' AND user_id=$user_id AND `as_pdate` LIKE '%".$_REQUEST['date']."%'";
		break;
		case "initiated":;	
		$where="`as_vstatus`='Initiated' AND user_id=$user_id AND `as_pdate` LIKE '%".$_REQUEST['date']."%'";
		break;
		case "originally_required":
		$where="`as_vstatus`='Original Required' AND user_id=$user_id AND `as_pdate` LIKE '%".$_REQUEST['date']."%'";
		break;
		case "followup":
		$where="`as_vstatus`='Followup' AND user_id=$user_id AND `as_pdate` LIKE '%".$_REQUEST['date']."%'";
		break;
		default:
		return "N/A";
}
	$log_info=$db->select("ver_checks","count(as_id) as count_return",$where);
	//echo "select count(as_id) as count_return from ver_checks where $where";
	$log_info=mysql_fetch_array($log_info);
	return $log_info['count_return'];
}
$table = '<table  border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">';
				$table .= '<tr>
				<th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Analyst Name</th>
            	<th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Recieved</th>
                <th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Closed</th>
                <th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Open</th>
                <th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Insufficient</th>
                <th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Original Required</th>
                <th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Initiated</th>
                <th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Follow Up</th>
							     </tr>';
$analyst= $db->select("users","first_name,last_name,user_id","is_active=1 and level_id=3");
        if(mysql_num_rows($analyst)>0){
        while($analyst_arr = mysql_fetch_array($analyst)){
				$table .= ' <tr>
                <td width="30%" style="font-size:12px; padding:5px;">'.$analyst_arr['first_name'].' '.$analyst_arr['last_name'].'</td>
                <td width="30%" style="font-size:12px; padding:5px;"><a href="'.SURL.'?action=logdetail&atype=checks&uid='.$analyst_arr['user_id'].'&status=received" target="_blank">'.count_checks_total($analyst_arr['user_id'],"received").'</a></td>
                <td width="30%" style="font-size:12px; padding:5px;"><a href="'.SURL.'?action=logdetail&atype=checks&uid='.$analyst_arr['user_id'].'&status=closed" target="_blank">'.count_checks_total($analyst_arr['user_id'],"closed").'</a></td>
                <td width="30%" style="font-size:12px; padding:5px;"><a href="'.SURL.'?action=logdetail&atype=checks&uid='.$analyst_arr['user_id'].'&status=open" target="_blank">'.count_checks_total($analyst_arr['user_id'],"open").'</a></td>
                <td width="30%" style="font-size:12px; padding:5px;"><a href="'.SURL.'?action=logdetail&atype=checks&uid='.$analyst_arr['user_id'].'&status=insufficient" target="_blank">'.count_checks_total($analyst_arr['user_id'],"insufficient").'</a></td>
                <td width="30%" style="font-size:12px; padding:5px;"><a href="'.SURL.'?action=logdetail&atype=checks&uid='.$analyst_arr['user_id'].'&status=originally_required" target="_blank">'.count_checks_total($analyst_arr['user_id'],"originally_required").'</a></td>
                <td width="30%" style="font-size:12px; padding:5px;"><a href="'.SURL.'?action=logdetail&atype=checks&uid='.$analyst_arr['user_id'].'&status=initiated" target="_blank">'.count_checks_total($analyst_arr['user_id'],"initiated").'</a></td>
                <td width="30%" style="font-size:12px; padding:5px;"><a href="'.SURL.'?action=logdetail&atype=checks&uid='.$analyst_arr['user_id'].'&status=followup" target="_blank">'.count_checks_total($analyst_arr['user_id'],"followup").'</a></td>
            </tr>	    '; 			
		}}
				$table .= "</table>";
				$subject="Today Logs (".$_REQUEST['date'].")";
				$to_email="hassan@xcluesiv.com";
				$fEmial="Verification Team";
				$cMail="hzafar2010@gmail.com";
emailTmp($table,$subject,$to_email,$fEmial,$cMail);
?>