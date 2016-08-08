<?php include("include/config.php");
//echo date("Y-m-d H:i:s"); exit; #6AA84F
$toDayDate = date("Y-m-d");
$localDate = date("D, M d, Y");
if($_GET['check']==1) {
	$cc=0;
	$bodyTbl =  '<table border="1" cellspacing="0" cellpadding="5" style="color:#000000;">
      <tr>
        <th>Case Name</th>
        <th>POC Name</th>
        <th>POC Email</th>
        <th>Send Date</th>
        <th>Status</th>
       </tr>';
 	
		//$selDt = $db->select("emp_survey_draft","*","1=1");
		$selDt = mysql_query("SELECT * FROM emp_survey_draft AS esd INNER JOIN add_data AS ad ON esd.`as_id` = ad.`as_id` INNER JOIN comp_info2 ci ON ad.`d_stitle` = ci.`cname`  INNER JOIN ver_checks AS vc ON vc.`as_id` = ad.`as_id`  WHERE esd.is_send = 1 and esd.is_confirmed = 0");
	if(mysql_num_rows($selDt))
	{
	$inc = 0;
 	 while($res = mysql_fetch_assoc($selDt)){ //print_r($res); 
  	 //echo $inc.' --';
	 $vData  = getVerdata($res['v_id']);
	 
	if($res['is_confirmed'] == 1)
	{
		$status = "Confirmed";
	}
	else if($res['is_drafted'] == 1)
	{
		$status = "Drafted";
	}
	else
	{
		$status = "Not Responding Yet";
	}
	 
	if($res['pocemail'] == 1)
	{
		$pocemail = $res['pocemail'];
	}
	else
	{
		$pocemail = "N/A";
	}
	 
	   
		$bodyTbl .= '<tr>
						<td><a href="'.SURL.'?action=details&case='.$res['v_id'].'&_pid=81#check_tab_'.$res['as_id'].'" target="_blank">'.$vData['v_name'].'</a></td>
						<td>'.$res['pocname'].'</td>
						<td>'.$pocemail.'</td>
						<td>'.date("d, F Y",strtotime($res['dated'])).'</td>
						<td>'.$status.'</td>
					</tr>';
	 $inc++;
	 }
  $bodyTbl .= '</table>';
	  //echo $bodyTbl;
 				$subject="Pre-Employment Checks In Pending (".$toDayDate.") ";
				$to_email="atta@xcluesiv.com";
				$cc_email="";
				$fEmial="Verification System";
				
				 emailTmp($bodyTbl,$subject,$to_email,'',$cc_email,'','',"Khalique");
				
				
				//emailTmp($bodyTbl,$subject,'mis@backcheckgroup.com','','','','',"BCG Team");
	  
//echo $bodyTbl;
	}
	else
	{
		$bodyTbl .= '<tr><td>No Data Found.</td></tr>';
		$bodyTbl .= '</table>';
	}
	
	echo $bodyTbl;

}



	  
    ?>
