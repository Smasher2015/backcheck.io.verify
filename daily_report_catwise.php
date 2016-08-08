<?php include("include/config.php");
//echo date("Y-m-d H:i:s"); exit; #6AA84F
$toDayDate = date("Y-m-d");
$localDate = date("D, M d, Y");

	$cc=0;
	$bodyTbl =  '<table border="1" cellspacing="0" cellpadding="5" style="color:#000000;">
      <tr>
        <td nowrap="nowrap" rowspan="2" valign="middle"><div>
          <p align="center"><strong>Date<u></u><u></u></strong></p>
        </div></td>
        <td nowrap="nowrap" colspan="3" valign="bottom" style="background-color:#EEECE1;"><p align="center"><strong>Education<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" colspan="3" valign="bottom" style="background-color:#DCE6F1;"><p align="center"><strong>Employment<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" colspan="3" valign="bottom" style="background-color:#FDE9D9;"><p align="center"><strong>Database<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" colspan="3" valign="bottom" style="background-color:#EEECE1;"><p align="center"><strong>Total<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" rowspan="2" valign="middle" style="background-color:#DCE6F1;"><div>
          <p align="center"><strong>Awaiting QC<u></u><u></u></strong></p>
        </div></td>
		
      </tr>
      <tr>
        <td nowrap="nowrap" valign="bottom" style="background-color:#DCE6F1;"><p align="center"><strong>Received<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#FDE9D9;"><p align="center"><strong>Closed<u></u><u></u></strong></p></td>
		<td nowrap="nowrap" valign="bottom" style="background-color:#F2DCDB;"><p align="center"><strong>Rejected<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#DCE6F1;"><p align="center"><strong>Received<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#FDE9D9;"><p align="center"><strong>Closed<u></u><u></u></strong></p></td>
		 <td nowrap="nowrap" valign="bottom" style="background-color:#F2DCDB;"><p align="center"><strong>Rejected<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#DCE6F1;"><p align="center"><strong>Received<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#FDE9D9;"><p align="center"><strong>Closed<u></u><u></u></strong></p></td>
		<td nowrap="nowrap" valign="bottom" style="background-color:#F2DCDB;"><p align="center"><strong>Rejected<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#72af4c;"><p align="center"><strong>Received<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#72af4c;"><p align="center"><strong>Closed<u></u><u></u></strong></p></td>
		<td nowrap="nowrap" valign="bottom" style="background-color:#72af4c;"><p align="center"><strong>Rejected<u></u><u></u></strong></p></td>
      </tr>';

	
	$datess = getDatesOneMonth();
	//var_dump($datess);
	$count = count($datess);
	$c1=0;$c2=0;$c3=0;$c4=0;$c5=0;$c6=0;$c7=0;$c8=0;$c9=0;$c10=0;$Rejj1=0;$Rejj2=0;$Rejj3=0;
	
	$arr = array();
	$Month = date("m");
	$Year = date("Y");
	
	
	$tbls = "ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id INNER JOIN qa_logs qa ON qa.as_id=vc.as_id";
	$cols = "SUM(as_rej_count) as cnt";
	
	$where = "as_isdlt=0 AND v_isdlt=0 AND (MONTH(qa.submit_date)='$Month' AND YEAR(qa.submit_date)='$Year') AND as_rej_count>0";
	$sel = $db->select($tbls,$cols,$where);
	$rs = @mysql_fetch_assoc($sel);
	$cc11 = (int) $rs[cnt];
	
	
		
	
	
	 foreach($datess as $key => $dated){
	$monthYear = $dated;
		 $zeroD = ($count<10)?'0':'';
	$dt= $dated.'-'.$zeroD.$count;
	
	$where = "as_isdlt=0 AND v_isdlt=0 AND DATE(qa.submit_date)='$dt' AND as_rej_count>0";
	
	$sel = $db->select($tbls,$cols,$where);
	$rs = @mysql_fetch_assoc($sel);
	$cc10 = (int) $rs[cnt];
	
	
	
	
	$where = "checks_id IN (1)  AND as_isdlt=0 AND v_isdlt=0 AND DATE(qa.submit_date)='$dt' AND as_rej_count>0";
	
	$sel = $db->select($tbls,$cols,$where);
	$rs = @mysql_fetch_assoc($sel);
	$Rej1 = (int) $rs[cnt];
	
	$where = "checks_id IN (2)  AND as_isdlt=0 AND v_isdlt=0 AND DATE(qa.submit_date)='$dt' AND as_rej_count>0";
	$sel = $db->select($tbls,$cols,$where);
	$rs = @mysql_fetch_assoc($sel);
	$Rej2 = (int) $rs[cnt];
	
	$where = "checks_id NOT IN (1,2)  AND as_isdlt=0 AND v_isdlt=0 AND DATE(qa.submit_date)='$dt' AND as_rej_count>0";
	$sel = $db->select($tbls,$cols,$where);
	$rs = @mysql_fetch_assoc($sel);
	$Rej3 = (int) $rs[cnt];
	
	
	
	
	
	
	
	
	if($dt==$toDayDate){
	$style = 'style="font-size:21px;"';	
	$clr1 = 'style="background-color:#EEECE1"';	
	$clr2 = 'style="background-color:#F2DCDB"';	
	$clr3 = 'style="background-color:#CFE2F3"';	
	$clr4 = 'style="background-color:#F2DCDB;"';
	$clr5 = 'style="background-color:#EEECE1;"';
	//$cc11 = $cc11;
	//$ccc11=$cc11-$cc10;
	
	$arr[cc10][0]=$cc11;
	$arr[cc10][1] = $ccc11;
	$keeey1 = 1;
	
	}else{
	
	$arr[cc10][$keeey1++] = $ccc11;
	$ccc11 = $ccc11-$cc10;
	
	$style = '';
	$clr1 = '';	
	$clr2 = '';	
	$clr3 = 'style="background-color:#CFE2F3"';	
	$clr4 = 'style="background-color:#6AA84F;"';
	$clr5 = 'style="background-color:#6AA84F;"';
	}
	$anchorColor='style="color:#444444;"';
	
	
	//echo "checks_id=1 AND date(as_addate)='$dt' AND as_isdlt=0";
	$cc1 = countChecks("checks_id=1 AND  date(as_addate)='$dt' ");
	$cc2 = countChecks("checks_id=1 AND as_status='Close' AND as_qastatus!='Rejected' AND date(as_cldate)='$dt' ");
	$cc3 = countChecks("checks_id=2 AND  date(as_addate)='$dt' ");
	$cc4 = countChecks("checks_id=2 AND as_status='Close' AND as_qastatus!='Rejected' AND date(as_cldate)='$dt' ");
	$cc5 = countChecks("checks_id NOT IN(1,2) AND date(as_addate)='$dt' ");
	$cc6 = countChecks("checks_id NOT IN(1,2) AND as_status='Close' AND as_qastatus!='Rejected' AND date(as_cldate)='$dt' ");
	$cc7 = countChecks("date(as_addate)='$dt' ");
	$cc8 = countChecks("date(as_cldate)='$dt' AND as_status='Close' AND as_qastatus!='Rejected' ");
	$cc9 = countChecks("date(as_qcdate)='$dt' AND (as_qastatus='QA' OR as_qastatus='Rejected') ");
	
	$cc11 = $arr[cc10][$key];
	
		$bodyTbl .= '<tr '.$style.'>
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong>'.$dt.'</strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#DCE6F1;"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$dt.'&to_dt='.$dt.'&search_status=1&s_checks_id[]=1&check_status=all">'.$cc1.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#FDE9D9;"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$dt.'&to_dt='.$dt.'&search_status=1&s_checks_id[]=1&check_status=close">'.$cc2.'</a></strong></p></td>
		
		<td nowrap="nowrap" valign="bottom" style="background-color:#F2DCDB;"><p align="center"><strong>'.$Rej1.'</strong></p></td>
		
        <td nowrap="nowrap" valign="bottom" style="background-color:#DCE6F1;"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$dt.'&to_dt='.$dt.'&search_status=1&s_checks_id[]=2&check_status=all">'.$cc3.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#FDE9D9;"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$dt.'&to_dt='.$dt.'&search_status=1&s_checks_id[]=2&check_status=close">'.$cc4.'</a></strong></p></td>
		
		<td nowrap="nowrap" valign="bottom" style="background-color:#F2DCDB;"><p align="center"><strong>'.$Rej2.'</strong></p></td>
		
        <td nowrap="nowrap" valign="bottom" style="background-color:#DCE6F1;"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$dt.'&to_dt='.$dt.'&search_status=1&xclude_s_checks_id[]=1,2&check_status=all">'.$cc5.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#FDE9D9;"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$dt.'&to_dt='.$dt.'&search_status=1&xclude_s_checks_id[]=1,2&check_status=close">'.$cc6.'</a></strong></p></td>
		
		<td nowrap="nowrap" valign="bottom" style="background-color:#F2DCDB;"><p align="center"><strong>'.$Rej3.'</strong></p></td>
		
        <td nowrap="nowrap" valign="bottom" style="background-color:#72af4c;"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$dt.'&to_dt='.$dt.'&search_status=1&check_status=all">'.$cc7.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#72af4c;"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$dt.'&to_dt='.$dt.'&search_status=1&check_status=close">'.$cc8.'</a></strong></p></td>
		<td nowrap="nowrap" valign="bottom" style="background-color:#72af4c;"><p align="center"><strong>'.$cc10.'</strong></p></td>
        <td nowrap="nowrap" valign="bottom" '.$clr3.'><p align="center"><strong>'.$cc9.'</strong></p></td>
		
      </tr>';
	  $count--;
	  $c1+=$cc1;$c2+=$cc2;$c3+=$cc3;$c4+=$cc4;$c5=+$cc5;$c6+=$cc6;$c7+=$cc7;$c8+=$cc8;$c9+=$cc9;$c10+=$cc10;$Rejj1+=$Rej1;$Rejj2+=$Rej2;$Rejj3+=$Rej3;
	 }
		
	

$bodyTbl .= '<tr style="background-color:#FFFF99; font-size:21px;">
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong>Total</strong></p></td>
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&s_checks_id[]=1&check_status=all">'.$c1.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&s_checks_id[]=1&check_status=close">'.$c2.'</a></strong></p></td>
		
		<td nowrap="nowrap" valign="bottom"><p align="center"><strong>'.$Rejj1.'</strong></p></td>
		
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&s_checks_id[]=2&check_status=all">'.$c3.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&s_checks_id[]=2&check_status=close">'.$c4.'</a></strong></p></td>
		
		<td nowrap="nowrap" valign="bottom"><p align="center"><strong>'.$Rejj2.'</strong></p></td>
		
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&xclude_s_checks_id[]=1,2&check_status=all">'.$c5.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&xclude_s_checks_id[]=1,2&check_status=close">'.$c6.'</a></strong></p></td>
		
		  <td nowrap="nowrap" valign="bottom"><p align="center"><strong>'.$Rejj3.'</strong></p></td>
		
        <td nowrap="nowrap" valign="bottom" ><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&check_status=all">'.$c7.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom" ><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&check_status=close">'.$c8.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong>'.$c9.'</strong></p></td>
		 <td nowrap="nowrap" valign="bottom"><p align="center"><strong>'.$c10.'</strong></p></td>
      </tr></table>';
	  
if($_GET['send']==1) {	  
				$subject="Monthly Advance Portal Report With Rejected Count (".$localDate.") ";
				$to_email="khalique@xcluesiv.com";
				$fEmial="Verification System";
				
				
				emailTmp($bodyTbl,$subject,$to_email,'','hassan@xcluesiv.com','','',"Khalique");
				emailTmp($bodyTbl,$subject,'mis@backcheckgroup.com','','','','',"BCG Team");
	  

}else{
	echo $bodyTbl.'</br>';
	
	

}



	  
    ?>
