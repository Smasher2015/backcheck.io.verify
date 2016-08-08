<?php 
error_reporting(1);
include ('/home/backglob/public_html/verify/include/config.php');
//if($_REQUEST['send']=="yes"){
//$_REQUEST['date']="2015-09-16";

$_REQUEST['date']=date("Y-m-d");

$localDate = date("D, M d, Y");
//date("D, M d, Y h:i:s");
//$localDate = "Wed, Sep 16, 2015";




function count_checks_total($user_id,$status){
	global $db;
	switch($status){
		case "received":
		$where="`as_addate` LIKE '%".date('Y-m-d')."%' AND user_id=$user_id";
		break;
		case "closed":
		$where="`as_status`='Close' AND user_id=$user_id AND `as_pdate` LIKE '%".$_REQUEST['date']."%'";
		break;
		case "open":
		$where="`as_status`='Open' AND user_id=$user_id AND `as_pdate` LIKE '%".$_REQUEST['date']."%'";
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
	//echo "select count(as_id) as count_return from ver_checks where $where <br />";
	$log_info=mysql_fetch_array($log_info);
	return $log_info['count_return'];
}
$table = '<table  border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">';
				$table .= '
				<tr>
				<td align="center" width="100%" colspan="8" style="border:none;">&nbsp;</td>
				</tr>
				<tr>
				<td align="center" width="100%" colspan="8" style="border:none;">Following are the activity logs of operations team on <strong>'.$localDate.'</strong> </td>
				</tr>
				<tr>
				<td align="center" width="100%" colspan="8" style="border:none;">&nbsp;</td>
				</tr>
				<tr>
				<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Analyst Name</th>
            	<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Recieved</th>
                <th width="5%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Closed</th>
                <th width="5%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Open</th>
                <th width="15%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Insufficient</th>
                <th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Original Required</th>
                <th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Initiated</th>
                <th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Follow Up</th>
							     </tr>';
$analyst= $db->select("users","first_name,last_name,user_id,level_id","is_active=1 and level_id IN (2,3,6) and user_id NOT IN (210,211,212,201,3,23)");
        if(mysql_num_rows($analyst)>0){
        while($analyst_arr = mysql_fetch_array($analyst)){
			$levelid = $analyst_arr['level_id'];
			if($levelid==2) $Title = "(Manager)"; else if($levelid==6) $Title = "(Finance)"; else if($levelid==12) $Title = ""; else  $Title = "";  
				$table .= ' <tr>
                <td width="" style="font-size:12px; padding:5px;">'.$analyst_arr['first_name'].' '.$analyst_arr['last_name'].' '.$Title.'</td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=logdetail&atype=checks&uid='.$analyst_arr['user_id'].'&status=received" target="_blank">'.count_checks_total($analyst_arr['user_id'],"received").'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=logdetail&atype=checks&uid='.$analyst_arr['user_id'].'&status=closed" target="_blank">'.count_checks_total($analyst_arr['user_id'],"closed").'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=logdetail&atype=checks&uid='.$analyst_arr['user_id'].'&status=open" target="_blank">'.count_checks_total($analyst_arr['user_id'],"open").'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=logdetail&atype=checks&uid='.$analyst_arr['user_id'].'&status=insufficient" target="_blank">'.count_checks_total($analyst_arr['user_id'],"insufficient").'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=logdetail&atype=checks&uid='.$analyst_arr['user_id'].'&status=originally_required" target="_blank">'.count_checks_total($analyst_arr['user_id'],"originally_required").'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=logdetail&atype=checks&uid='.$analyst_arr['user_id'].'&status=initiated" target="_blank">'.count_checks_total($analyst_arr['user_id'],"initiated").'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=logdetail&atype=checks&uid='.$analyst_arr['user_id'].'&status=followup" target="_blank">'.count_checks_total($analyst_arr['user_id'],"followup").'</a></td>
            </tr>	    '; 			
		}}
				$table .= "</table>";
				$subject="Today Checks Logs (".$localDate.")";
				$to_email="khalique@xcluesiv.com";
				$fEmial="Verification Team";
				//$cMail="hzafar2010@gmail.com";
				$groupEmail = "mis@backcheckgroup.com";
		echo $table;		
		
		//emailTmp($table,$subject,$groupEmail,'','','','',"Team");
//emailTmp($table,$subject,'ceo@backcheckgroup.com','','','','',"CEO");
//emailTmp($table,$subject,'erum@backcheckgroup.com','','','','',"Erum Hanif");
//emailTmp($table,$subject,'athar@backcheckgroup.com','','','','',"Athar");
//emailTmp($table,$subject,'mis@backcheckgroup.com','','','','',"MIS");


emailTmp($table,$subject,$to_email,'','','','',"Khalique");
//emailTmp($table,$subject,'faraz@verztech.com','','','','',"Hassan");
//}




?>