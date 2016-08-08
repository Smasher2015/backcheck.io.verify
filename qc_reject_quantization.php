<?php include("include/config.php");
//echo date("Y-m-d H:i:s"); exit; #6AA84F
$toDayDate = date("Y-m-d");
$localDate = date("D, M d, Y");


if($_GET['send']==1) {
	$cc=0;
	$bodyTbl =  '<table border="1" cellspacing="0" cellpadding="5" style="color:#000000;">
      <tr>
        <td nowrap="nowrap" rowspan="2" valign="middle"><div>
          <p align="center"><strong>Date<u></u><u></u></strong></p>
        </div></td>
        <td nowrap="nowrap" colspan="3" valign="bottom" style="background-color:#DCE6F1;"><p align="center"><strong>Daily Closing<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" colspan="3" valign="bottom" style="background-color:#DCE6F1;"><p align="center"><strong>Daily Rejection<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" colspan="3" valign="bottom" style="background-color:#FDE9D9;"><p align="center"><strong>Monthly Closing<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" colspan="3" valign="bottom" style="background-color:#FDE9D9;"><p align="center"><strong>Monthly Rejection<u></u><u></u></strong></p></td>
       
      </tr>
      <tr>
        <td nowrap="nowrap" valign="bottom" style="background-color:#DCE6F1;"><p align="center"><strong>EDU<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#DCE6F1;"><p align="center"><strong>EMP<u></u><u></u></strong></p></td>
		 <td nowrap="nowrap" valign="bottom" style="background-color:#DCE6F1;"><p align="center"><strong>DB<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#DCE6F1;"><p align="center"><strong>EDU<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#DCE6F1;"><p align="center"><strong>EMP<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#DCE6F1;"><p align="center"><strong>DB<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#FDE9D9;"><p align="center"><strong>EDU<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#FDE9D9;"><p align="center"><strong>EMP<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#FDE9D9;"><p align="center"><strong>DB<u></u><u></u></strong></p></td>
		 <td nowrap="nowrap" valign="bottom" style="background-color:#FDE9D9;"><p align="center"><strong>EDU<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#FDE9D9;"><p align="center"><strong>EMP<u></u><u></u></strong></p></td>
        <td nowrap="nowrap" valign="bottom" style="background-color:#FDE9D9;"><p align="center"><strong>DB<u></u><u></u></strong></p></td>
      </tr>';

	
	$datess = getDatesOneMonth();
	
	$count = count($datess);
	$count2 = count($datess);
	$cccc=0;
	$c1=0;$c2=0;$c3=0;$c4=0;$c5=0;$c6=0;$c7=0;$c8=0;$c9=0;$c=10;$c=11;$c=12;
	
	$arr = array();
	$Month = date("m");
	$Year = date("Y");
		
	$tbls = "ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id INNER JOIN qa_logs qa ON qa.as_id=vc.as_id";
	$cols = "SUM(as_rej_count) as cnt";
	
	$where = "checks_id IN (1)  AND as_isdlt=0 AND v_isdlt=0 AND (MONTH(qa.submit_date)='$Month' AND YEAR(qa.submit_date)='$Year') AND as_rej_count>0";
	$sel = $db->select($tbls,$cols,$where);
	$rs = @mysql_fetch_assoc($sel);
	$cc10 = (int) $rs[cnt];
	
	$where = "checks_id IN (2)  AND as_isdlt=0 AND v_isdlt=0 AND (MONTH(qa.submit_date)='$Month' AND YEAR(qa.submit_date)='$Year') AND as_rej_count>0";
	$sel = $db->select($tbls,$cols,$where);
	$rs = @mysql_fetch_assoc($sel);
	$cc11 = (int) $rs[cnt];
	
	$where = "checks_id NOT IN (1,2)  AND as_isdlt=0 AND v_isdlt=0 AND (MONTH(qa.submit_date)='$Month' AND YEAR(qa.submit_date)='$Year') AND as_rej_count>0";
	$sel = $db->select($tbls,$cols,$where);
	$rs = @mysql_fetch_assoc($sel);
	$cc12 = (int) $rs[cnt];
	
	$cc7 = countChecks("checks_id=1 AND  as_status='Close' AND as_qastatus!='Rejected' AND  (MONTH(as_cldate)='$Month' AND YEAR(as_cldate)='$Year') ");
	$cc8 = countChecks("checks_id=2 AND as_status='Close' AND as_qastatus!='Rejected' AND (MONTH(as_cldate)='$Month' AND YEAR(as_cldate)='$Year') ");
	$cc9 = countChecks("checks_id NOT IN (1,2) AND as_status='Close' AND as_qastatus!='Rejected' AND (MONTH(as_cldate)='$Month' AND YEAR(as_cldate)='$Year') ");
	
	
	
	$abc = 0;
	
	 foreach($datess as $key => $dated){
	$cccc++;
	$monthYear = $dated;
	$zeroD = ($count<10)?'0':'';
	$zeroD2 = ($cccc<10)?'0':'';
	$dt= $dated.'-'.$zeroD.$count;
	$dt2= $dated.'-'.$zeroD2.($cccc);
	
	//echo "SELECT count(*) as cnt FROM ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id  WHERE  checks_id=1 AND  as_status='Close' AND date(as_cldate)='$dt' <br>";
		
	$cc1 = countChecks("checks_id=1 AND  as_status='Close' AND as_qastatus!='Rejected' AND date(as_cldate)='$dt' ");
	$cc2 = countChecks("checks_id=2 AND as_status='Close' AND as_qastatus!='Rejected' AND date(as_cldate)='$dt' ");
	$cc3 = countChecks("checks_id NOT IN (1,2) AND as_status='Close' AND as_qastatus!='Rejected' AND date(as_cldate)='$dt' ");
		
	$where = "checks_id IN (1)  AND as_isdlt=0 AND v_isdlt=0 AND DATE(qa.submit_date)='$dt' AND as_rej_count>0";
	
	$sel = $db->select($tbls,$cols,$where);
	$rs = @mysql_fetch_assoc($sel);
	$cc4 = (int) $rs[cnt];
	
	$where = "checks_id IN (2)  AND as_isdlt=0 AND v_isdlt=0 AND DATE(qa.submit_date)='$dt' AND as_rej_count>0";
	$sel = $db->select($tbls,$cols,$where);
	$rs = @mysql_fetch_assoc($sel);
	$cc5 = (int) $rs[cnt];
	
	$where = "checks_id NOT IN (1,2)  AND as_isdlt=0 AND v_isdlt=0 AND DATE(qa.submit_date)='$dt' AND as_rej_count>0";
	$sel = $db->select($tbls,$cols,$where);
	$rs = @mysql_fetch_assoc($sel);
	$cc6 = (int) $rs[cnt];
	
	
	if($dt==$toDayDate){
	$cc10 = $cc10;
	$cc11 = $cc11;
	$cc12 = $cc12;
	$ccc10=$cc10-$cc4;
	$ccc11=$cc11-$cc5;
	$ccc12=$cc12-$cc6;
	
	$cc7 = $cc7;
	$cc8 = $cc8;
	$cc9 = $cc9;
	$ccc7=$cc7-$cc1;
	$ccc8=$cc8-$cc2;
	$ccc9=$cc9-$cc3;
	
	$arr[cc4][0]=$cc10;
	$arr[cc4][1] = $ccc10;
	
	$arr[cc5][0]=$cc11;
	$arr[cc5][1] = $ccc11;
	
	$arr[cc6][0]=$cc12;
	$arr[cc6][1] = $ccc12;
	
	$arr[cc1][0]=$cc7;
	$arr[cc1][1] = $ccc7;
	
	$arr[cc2][0]=$cc8;
	$arr[cc2][1] = $ccc8;
	
	$arr[cc3][0]=$cc9;
	$arr[cc3][1] = $ccc9;
	
	
	$keeey1 = 1;
	$keeey2 = 1;
	$keeey3 = 1;
	$keeey4 = 1;
	$keeey5 = 1;
	$keeey6 = 1;
	
	$style = 'style="font-size:21px;"';	
	$clr1 = 'style="background-color:#DCE6F1"';	
	$clr2 = 'style="background-color:#DCE6F1"';	
	$clr3 = 'style="background-color:#FDE9D9"';	
	$clr4 = 'style="background-color:#F2DCDB;"';
	$clr5 = 'style="background-color:#EEECE1;"';
	}else{
	//echo $cc123."<br>";
	$keeey++;
	//echo $keeey.'<br>';
	$arr[cc1][$keeey1++] = $ccc7;
	$arr[cc2][$keeey2++] = $ccc8;	
	$arr[cc3][$keeey3++] = $ccc9;	
	$arr[cc4][$keeey4++] = $ccc10;
	$arr[cc5][$keeey5++] = $ccc11;	
	$arr[cc6][$keeey6++] = $ccc12;	
	
	
	$style = '';
	$clr1 = '';	
	$clr2 = '';	
	$clr3 = 'style="background-color:#6AA84F"';	
	$clr4 = 'style="background-color:#6AA84F;"';
	$clr5 = 'style="background-color:#6AA84F;"';
	$ccc7 = $ccc7-$cc1;
	$ccc8 = $ccc8-$cc2;
	$ccc9 = $ccc9-$cc3;
	$ccc10 = $ccc10-$cc4;
	$ccc11 = $ccc11-$cc5;
	$ccc12 = $ccc12-$cc6;
	}
	
	$anchorColor='style="color:#444444;"';
	
	//echo $cc10.' - cc4:'.$arr[cc4][$key].'  cc5:'.$arr[cc5][$key].' cc6:'.$arr[cc6][$key].'<br>';	

	$cc10 = $arr[cc4][$key];
	$cc11 = $arr[cc5][$key];
	$cc12 = $arr[cc6][$key];
	$cc7 = $arr[cc1][$key];
	$cc8 = $arr[cc2][$key];
	$cc9 = $arr[cc3][$key];
	
	
	
	//echo "checks_id=1 AND date(as_addate)='$dt' AND as_isdlt=0";
	
	//$cc4 = countChecks("checks_id=1 AND  as_rej_count>0 AND date(as_cldate)='$dt' ");
	//$cc5 = countChecks("checks_id=2 AND as_status='Close' AND date(as_cldate)='$dt' ");
	//$cc6 = countChecks("checks_id NOT IN (1,2) AND as_status='Close' AND date(as_cldate)='$dt' ");
	
	
		$bodyTbl .= '<tr '.$style.'>
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong>'.$dt.'</strong></p></td>
        <td nowrap="nowrap" valign="bottom" '.$clr1.'><p align="center"><strong>'.$cc1.'</strong></p></td>
        <td nowrap="nowrap" valign="bottom" '.$clr1.'><p align="center"><strong>'.$cc2.'</strong></p></td>
        <td nowrap="nowrap" valign="bottom" '.$clr1.'><p align="center"><strong>'.$cc3.'</strong></p></td>
        <td nowrap="nowrap" valign="bottom" '.$clr2.'><p align="center"><strong>'.$cc4.'</strong></p></td>
        <td nowrap="nowrap" valign="bottom" '.$clr2.'><p align="center"><strong>'.$cc5.'</strong></p></td>
        <td nowrap="nowrap" valign="bottom" '.$clr2.'><p align="center"><strong>'.$cc6.'</strong></p></td>
        <td nowrap="nowrap" valign="bottom" '.$clr3.'><p align="center"><strong>'.$cc7.'</strong></p></td>
        <td nowrap="nowrap" valign="bottom" '.$clr3.'><p align="center"><strong>'.$cc8.'</strong></p></td>
        <td nowrap="nowrap" valign="bottom" '.$clr3.'><p align="center"><strong>'.$cc9.'</strong></p></td>
		
		
		<td nowrap="nowrap" valign="bottom" '.$clr3.'><p align="center"><strong>';
		
		$bodyTbl .= $cc10;
		
		
		
		
		$bodyTbl .= '</strong></p></td>
        <td nowrap="nowrap" valign="bottom" '.$clr3.'><p align="center"><strong>';
		//if($cccc!=$count2){
		$bodyTbl .= $cc11; 
		//}
		$bodyTbl .= '</strong></p></td>
        <td nowrap="nowrap" valign="bottom" '.$clr3.'><p align="center"><strong>';
		//if($cccc!=$count2){
		$bodyTbl .= $cc12; 
		//}
		
		$bodyTbl .= '</strong></p></td>
      </tr>';
	  $count--;
	  $c1+=$cc1;$c2+=$cc2;$c3+=$cc3;$c4+=$cc4;$c5=+$cc5;$c6+=$cc6;$c7+=$cc7;$c8+=$cc8;$c9+=$cc9;$c10+=$cc10;$c11+=$cc11;$c12+=$cc12;
	 }
		
	

/*  $bodyTbl .= '<tr style="background-color:#FFFF99; font-size:21px;">
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong>Total</strong></p></td>
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&s_checks_id[]=1&check_status=all">'.$c1.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&s_checks_id[]=1&check_status=close">'.$c2.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&s_checks_id[]=2&check_status=all">'.$c3.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&s_checks_id[]=2&check_status=close">'.$c4.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&xclude_s_checks_id[]=1,2&check_status=all">'.$c5.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&xclude_s_checks_id[]=1,2&check_status=close">'.$c6.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom" ><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&check_status=all">'.$c7.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom" ><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&check_status=close">'.$c8.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong>'.$c9.'</strong></p></td>
		
		<td nowrap="nowrap" valign="bottom" ><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&check_status=all">'.$c10.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom" ><p align="center"><strong><a '.$anchorColor.' href="'.SURL.'?action=advance&atype=search&from_dt='.$monthYear.'-01&to_dt='.$toDayDate.'&search_status=1&check_status=close">'.$c11.'</a></strong></p></td>
        <td nowrap="nowrap" valign="bottom"><p align="center"><strong>'.$c12.'</strong></p></td>
      </tr>'; */
	  
	  $bodyTbl .= '</table>';
	  
	  
				$subject="Monthly Advance Portal Report With Rejected Count (".$localDate.") ";
				$to_email="khalique@xcluesiv.com";
				$fEmial="Verification System";
				
				//emailTmp($bodyTbl,$subject,$to_email,'','hassan@xcluesiv.com','','',"Khalique");
				//emailTmp($bodyTbl,$subject,'mis@backcheckgroup.com','','','','',"BCG Team");
	  
//echo $bodyTbl;
}






	  
    ?>
