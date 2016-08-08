<?php 

	// by khl Charts Data functions
	function getWeeklyCreditsConsumptionData($com_id,$mnth="",$yr=""){
	global $db,$LEVEL;
	$com_id = $com_id;
	$today = date("Y-m-d");
	$thisMonth = date("Y-m-01");
	$selMonth = ($mnth!="")?" AND MONTH(as_addate)='".$mnth."'":" AND MONTH(as_addate)='".date("m")."'";
	$selYear = ($yr!="")?" AND YEAR(as_addate)='".$yr."'":" AND YEAR(as_addate)='".date("Y")."'";
	$selCom = getcompany($com_id);
	$rsCom = @mysql_fetch_assoc($selCom);
	$monthly_credits_allowed = (int) $rsCom['monthly_credits_allowed'];
	$citbls= "ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id";
	$cols = "v_name AS  'Applicant', vc.as_cost2 AS cost,  v_name,as_addate,as_status";
	if($LEVEL==4){
		$uids = getUseridsLocation();
		if(!empty($uids)){
		$whre = " AND v_uadd IN (".implode(",",$uids).") ";	
		}
	}
	$whr = " DATE_FORMAT(as_addate, '%Y-%m-%d') >= DATE_SUB(as_addate, INTERVAL 1 MONTH) $selMonth $selYear AND vd.com_id=$com_id  AND vd.v_isdlt=0 AND vc.as_isdlt=0 $whre GROUP BY  vd.v_id";
	//echo "SELECT $cols FROM $citbls WHERE $whr";
	$rst = $db->select($citbls,$cols,$whr);
	$total=0;
	$fisrtWeek_total = 0;
	$secondWeek_total = 0;
	$thirdWeek_total = 0;
	$fourthWeek_total = 0;
	$closed1 = 0; 
	$closed2 = 0; 
	$closed3 = 0; 
	$closed4 = 0;
	while($rsc = @mysql_fetch_assoc($rst)) { 
		
		//$checks = $db->select("ver_checks","*","v_id=$rs[v_id]  AND as_isdlt=0");
	
		
		//while($rsc = @mysql_fetch_assoc($checks)){
			$c++;
			$firstDay = date("Y-m-1", strtotime($rsc['as_addate']));
			$lastDay = date("Y-m-t", strtotime($rsc['as_addate']));
			$fisrtWeek = date('Y-m-d', strtotime($firstDay. '+1 Week'));
			$secondWeek = date('Y-m-d', strtotime($fisrtWeek. '+1 Week'));
			$thirdWeek = date('Y-m-d', strtotime($secondWeek. '+1 Week'));
			$fourthWeek = date('Y-m-d', strtotime($thirdWeek. '+1 Week'));
			$as_addate = date('Y-m-d', strtotime($rsc['as_addate']));
				
			if(strtotime($as_addate) <= strtotime($fisrtWeek)){
			//$fisrtWeek_total = $fisrtWeek_total+$rsc['as_cost2'];
			$fisrtWeek_total++;
			
			if($rsc['as_status']=='Close'){
		
			$closed1++;	
			}
			}
			
			if(strtotime($fisrtWeek) <= strtotime($secondWeek) AND strtotime($as_addate) > strtotime($fisrtWeek)){
			//$secondWeek_total = $secondWeek_total+$rsc['as_cost2'];	
			$secondWeek_total++;
			if($rsc['as_status']=='Close'){
			
			$closed2++;		
			}
			}
			
			if(strtotime($secondWeek) <= strtotime($thirdWeek) AND strtotime($as_addate) > strtotime($secondWeek)){
			//$thirdWeek_total = $thirdWeek_total+$rsc['as_cost2'];	
			$thirdWeek_total++;
			if($rsc['as_status']=='Close'){
				
			$closed3++;		
			}
			}
			
			if(strtotime($thirdWeek) <= strtotime($lastDay)  AND strtotime($as_addate) > strtotime($thirdWeek)){
			//$fourthWeek_total = $fourthWeek_total+$rsc['as_cost2'];	
			$fourthWeek_total++;
			if($rsc['as_status']=='Close'){
			
			$closed4++;	
			}
			}
		//}	
			
			
		}
	$weeksTotal = array();
	//echo $fisrtWeek_total."<br>".$secondWeek_total."<br>".$thirdWeek_total."<br>".$fourthWeek_total."<br>";
	$weeksTotal['weeks_total'] = array('-'.$fourthWeek_total,'-'.$thirdWeek_total,'-'.$secondWeek_total,'-'.$fisrtWeek_total);
	
	$remainingAmount1 = (int) $monthly_credits_allowed-$fisrtWeek_total;
	$remainingAmount2 = (int) $remainingAmount1-$secondWeek_total;
	$remainingAmount3 = (int) $remainingAmount2-$thirdWeek_total;
	$remainingAmount4 = (int) $remainingAmount3-$fourthWeek_total;
	//$weeksTotal['remaining_exp'] = array($remainingAmount4,$remainingAmount3,$remainingAmount2,$remainingAmount1);
	$weeksTotal['remaining_exp'] = array($closed4,$closed3,$closed2,$closed1);
	//var_dump($weeksTotal['remaining_exp']);
	return $weeksTotal;
 }
	
	
	
	
	
	// by khl get month drop down
	function getMonthsDropDown($selMon=""){
		
		$monthNum = ($selMon!="")?$selMon:date("m");
		
		$montharray = array (

        '01' => 'January',

        '02' => 'February',

        '03' => 'March',

        '04' => 'April',

        '05' => 'May',

        '06' => 'June',

        '07' => 'July',

        '08' => 'August',

        '09' => 'September',

        '10' => 'October',

        '11' => 'November',

        '12' => 'December' );

	
	$data = "";
	foreach($montharray as $key => $val){

		$data .= "<option value=".$key." ".chk_or_sel($key,$monthNum,'selected').">".$val."</option>";

	}
	return $data;
	}
	
	// by khl get month drop down
	function getYearsDropDown($prev_rang=2000,$next_rang="",$selYear=""){
		
	$selYear = ($selYear!="")?$selYear:date("Y");	
	
	$next_rang = ($next_rang!="")?$next_rang:date("Y");
	$data = "";
	for($prev_rang;$prev_rang<=$next_rang;$prev_rang++){

		$data .= "<option value=".$prev_rang." ".chk_or_sel($prev_rang,$selYear,'selected').">".$prev_rang."</option>";

	}
	return $data;
	}
	
	
	
	// by khl Count for Insufficient Docs
	function countInsuffDocs($com_id,$mnth="",$yr="",$arr=false){
		global	$db,$LEVEL;
		
		$selMonth = ($mnth!="")?" AND MONTH(att_insuff_date)='".$mnth."'":"";
		$selYear = ($yr!="")?" AND YEAR(att_insuff_date)='".$yr."'":"";
		
		$tbls = "ver_data vd INNER JOIN attachments att ON vd.v_id=att.case_id ";
		$cols = "*";
		$whr = "com_id=$com_id AND  att_insuff=1 $selMonth $selYear ";
		
		if($LEVEL==4){
		$uids = getUseridsLocation();
		if(!empty($uids)){
		$whr = " $whr  AND v_uadd IN (".implode(",",$uids).") ";	
		}
		}
		$sel = $db->select($tbls,$cols,$whr);
		
		$cnt = @mysql_num_rows($sel);
		if($arr){
		return 	$sel;
		}else{
		return $cnt;	
		}
		
	}
	
	
	// by khl Count for Insufficient Docs
	function countInsuffDocsByClient($com_id,$whr="",$arr=false){
		global	$db,$LEVEL;
		
		$whr = ($whr!="")?" AND $whr":"";
		$tbls = "ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id INNER JOIN attachments att ON vc.as_id=att.checks_id";
		$cols = "*";
		$whr = "v_isdlt=0 AND as_isdlt=0 AND com_id='$com_id' AND  att_insuff=1 AND as_status='Insufficient' AND  as_vstatus='Not Initiated' $whr ";
		
		if($LEVEL==4){
		$uids = getUseridsLocation();
		if(!empty($uids)){
		$whr = " $whr  AND v_uadd IN (".implode(",",$uids).") ";	
		}
		}
		$sel = $db->select($tbls,$cols,$whr);
		
		$cnt = @mysql_num_rows($sel);
		if($arr){
		return 	$sel;
		}else{
		return $cnt;	
		}
		
	}
	
	
	
	
	// by khl Count Read for download
	function countReady4Download($com_id,$mnth="",$yr=""){
		global	$db,$LEVEL;
		
		$selMonth = ($mnth!="")?" AND MONTH(as_addate)='".$mnth."'":"";
		$selYear = ($yr!="")?" AND YEAR(as_addate)='".$yr."'":"";
		
		$tbls = "ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id";
		$cols = "vc.as_id";
		$whr = "as_sent=4 AND as_cdnld=0 AND as_status='Close' AND as_qastatus = 'Approved' AND com_id=$com_id $selMonth $selYear";
		
		if($LEVEL==4){
		$uids = getUseridsLocation();
		if(!empty($uids)){
		$whr = " $whr  AND v_uadd IN (".implode(",",$uids).") ";	
		}
		}
		//echo "SELECT $cols $tbls WHERE $whr";
		$sel = $db->select($tbls,$cols,$whr);
		$cnt = @mysql_num_rows($sel);
		return $cnt;
	}
	
	// By Ata Get Count Of Tickets
	 function totaltickets($userid='')
	 {
	  $postfields["action"] = "gettickets";
	  if($userid != "")
	  {
	   $getUserInfo = getUserInfo($userid); 
	  $postfields["clientid"] = $getUserInfo['whmcs_clid'];
	  $postfields["email"] = $getUserInfo['email'];
	  }
	 $postfields["deptid"] = "1";
	$xml= whmcs_api(WHMCS_APIURL,$postfields);
	  $arr = whmcsapi_xml_parser($xml); 
	  $tickets=$arr['WHMCSAPI']['TICKETS'];
	 return $arr['WHMCSAPI']['TOTALRESULTS'];
	 } 

	// by khl Get Live Updates on dashboard
	 function getLiveUpdates($com_id,$todate,$dayName="",$count=0,$pagination='',$apd='apnd'){
						global $db,$LEVEL;
						
						$pagination = ($pagination!='')?$pagination:'0,7';
						$whr2 = ($apd=='apnd')?'':' AND act.is_read=0 ';
						$data = '<ul class="media-list items'.$count.'" id="result_para_'.$count.'">';	
                    
						$forclient = "vd.com_id=$com_id AND ";
						
						$tbls = "activity as act INNER JOIN ver_data as vd ON act.v_id=vd.v_id INNER JOIN ver_checks as vc ON act.v_id=vc.v_id";
						$cols = "*";
						if($LEVEL==4){
						$uids = getUseridsLocation();
						if(!empty($uids)){
						$whre = " AND v_uadd IN (".implode(",",$uids).") ";	
						}
						}
						$whr = " $forclient vd.v_isdlt=0 AND vc.as_isdlt=0 AND DATE(act.a_date)='$todate' AND (act.a_actn = 'close' OR act.a_actn IS NULL ) AND act.a_type IN ('ascase','case','pdf','notification','qastatus','insufficient') $whr2 $whre GROUP BY act.a_id  order by act.a_date DESC LIMIT $pagination ";
						
						$activityquery = $db->select($tbls,$cols,$whr);
						//echo "SELECT * FROM $tbls WHERE $whr";
						if(@mysql_num_rows($activityquery)>0){
                        while($rec = @mysql_fetch_array($activityquery))
                        {  
					  $act_count = @mysql_num_rows($db->select("activity","a_id","a_id=$rec[a_id] AND is_read=0"));
					  if( $act_count>0){
					  $db->update("is_read=1","activity","a_id=$rec[a_id]");
					  }
                      $getVerdata = getVerdata($rec['v_id']);
                      $getCheck = getCheck('',$rec['v_id'],$rec['ext_id']); 
                       if($rec['ext_id']){
                        $checks = $db->select("checks","*","checks_id = $getCheck[checks_id]");
                        $check =  @mysql_fetch_assoc($checks);	
                        $checkName = $check['checks_title'];
                            //checks_id 
					if($rec['a_actn'] == 'remark')
					{
						//$detail = "Manager Remarks On ".$checkName.".";
						//$class = "icon-user-tie";
					}
					else if($rec['a_actn'] == 'close')
					{
						if($rec['a_type'] == 'case')
						{
							$detail = $getVerdata['v_name']." Case Close.";
						}
						else
						{
							$detail = $checkName." check Close.";
						}
								$icon_class = "icon-user-tie";
								$icon_class_bg = "border-success-400 text-success-400";
					}
					else if($rec['a_actn'] == 'edit')
					{
						//$detail = $checkName." Work in progress.";
						//$class = "icon-info3";
					}
					else if($rec['a_type'] == 'pdf')
					{
						$detail = $checkName." Case Report Download.";
								$icon_class = "icon-file-pdf";
								$icon_class_bg = "border-teal-400 text-teal-400";
					}
					else if($rec['a_type'] == 'notification')
					{
						$detail =  str_replace("id ".$rec['v_id'],$getVerdata['v_name'],$rec['a_info']);
								$icon_class = "icon-googleplus5";
								$icon_class_bg = "border-brown-400 text-brown-400";
					}
					else if($rec['a_type'] == 'qastatus')
					{
						$detail = $rec['a_info'];
								$icon_class = "icon-search4";
								$icon_class_bg = "border-pink text-pink";
					} 
					else if($rec['a_type'] == 'insufficient')
					{
						$detail = $rec['a_info'];
								$icon_class = "icon-search4";
								$icon_class_bg = "border-warning-400 text-warning-400";
					} 
					else
					{ 
						$detail = "";
						$class = "icon-checkmark4";
					}

                     
                          $time_diff = time_ago(strtotime($rec['a_date']));                       
                        
                          $data .='  <li class="media">                
                                <div class="media-left media-middle">
                                    <a href="?action=details&case='.$rec['v_id'].'&_pid=81#check_tab_'.$rec['ext_id'].'"><i class="icon-arrow-right13"></i></a>
                                </div>
                                
                                <div class="media-body">
                                    '.$detail.'
                                </div>
								
                          </li>';
                        
                       
                        }
						} // while
                 
                           $data .= '</ul>';
						   }else{
							if($apd!='apnd') { $noRec=1; } else { $noRec=0; }
							//$data .= '<li class="media">No updates on '.$dayName.'</li>';
						
							$data.='<div class="live_nofound text-center"><h3>No Update Found.</h3> 
                                  <div class="form-group"><a href="'.SURL.'?action=activities&atype=view" class=" btn btn-xs bg-success">View All Activity</a></div>
                                  </div>'; 
						   }
							        
	
						if($noRec==1){
						return $noRec;	
						}else{
						return  $data;
						}
	
						} 
	 
	 
		// returned $date Y/m/d
		function work_days_from_date($days, $forward, $date=NULL) 
		{
			$data = array();
			if(!$date)
			{
				$date = date('Y-m-d'); // if no date given, use todays date
			}

			while ($days != 0) 
			{
				$forward == 1 ? $day = strtotime($date.' +1 day') : $day = strtotime($date.' -1 day');
				$date = date('Y-m-d',$day);
				if( date('N', strtotime($date)) <= 5) // if it's a weekday
				{
				  $days--;
				}
			}
			
			$data['dayname'] = getDayName($date);
			$data['dated'] = $date;
			
			return $data;
			

		}

		function getDayName($date){
			
			$DaysArray1 = array(1=>"Monday",2=>"Tuesday",3=>"Wednesday",4=>"Thursday",5=>"Friday");
			$DaysArray2 = array(1=>1,2=>2,3=>3,4=>4,5=>5);
			$dayNum 	= date("N",strtotime($date));
			$DaysArray1[$dayNum];
			return $DaysArray1[$dayNum];
		}
	 
	 
	 
	 
	 
	 	
	function countInsuff_applicant($com_id,$userid,$arr=false){
		global	$db,$LEVEL;
		
		$tbls = "ver_data vd INNER JOIN attachments att ON vd.v_id=att.case_id ";
		$cols = "*";
		$whr = "com_id=$com_id AND v_uadd=$userid AND  att_insuff=1";
		
		$sel = $db->select($tbls,$cols,$whr);
		
		$cnt = @mysql_num_rows($sel);
		if($arr){
		return 	$sel;
		}else{
		return $cnt;	
		}
		
	}	
	
	
	function count_Case_By_Client($com_id,$whr=""){
		global $db;
		
		$whr = (!empty($whr))?" AND $whr ":"";
		if($LEVEL==4){
		$uids = getUseridsLocation();
		if(!empty($uids)){
		$whr = " $whr  AND v_uadd IN (".implode(",",$uids).") ";	
		}
		}
		//echo "SELECT vd.v_id from ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id where com_id='$com_id' AND as_isdlt=0 AND v_isdlt=0 ".$whr." GROUP BY vd.v_id"; 
		$cnt = (int) @mysql_num_rows($db->select("ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id","vd.v_id"," com_id='$com_id' AND as_isdlt=0 AND v_isdlt=0 ".$whr." GROUP BY vd.v_id"));
		
		return number_format($cnt);
			
		}
	function count_Checks_By_Client($com_id,$whr=""){
		
		global $db;
		$whr = (!empty($whr))?" AND $whr ":"";
		if($LEVEL==4){
		$uids = getUseridsLocation();
		if(!empty($uids)){
		$whr = " $whr  AND v_uadd IN (".implode(",",$uids).") ";	
		}
		}
		$cnt = (int) @mysql_num_rows($db->select("ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id","as_id"," com_id='$com_id' AND as_isdlt=0 AND v_isdlt=0 ".$whr));
		//echo "select as_id from ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id where com_id='$com_id' AND as_isdlt=0 AND v_isdlt=0 $whr";
		//echo @mysql_num_rows($db->select("ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id","as_id"," com_id='$com_id' AND as_isdlt=0 AND v_isdlt=0 ".$whr));
		return number_format($cnt);

	}
												
	
	function getCountInfo($cntHighRisk15,$cntHighRisk30)	{
		$data = array();
		$per=0;
		$total = $cntHighRisk15+$cntHighRisk30;
		if($cntHighRisk15>$cntHighRisk30){
		$cls1 = 'text-success-600';
		$cls2 = 'icon-stats-growth2';
		}else if($cntHighRisk15==$cntHighRisk30){
		$cls1 = '';	
		$cls2 = 'icon-stats-growth2';	
		}else{
		$cls1 = 'text-danger';	
		$cls2 = 'icon-stats-decline2';	
		}
			
		
		if($total!=0 && $cntHighRisk30!=0){
		$per = 	(($total*$cntHighRisk30)/100);
		}
		$data['cls1'] = $cls1;
		$data['cls2'] = $cls2;
		$data['per'] = $per;
		$data['total'] = $total;
		
		return $data;
	}
	
	// dashboard section recent applicant
	function campaignDonut($company_id){
	$data = array();
	$eduCheks = str_replace(',','',count_Checks_By_Client($company_id,$whr="checks_id=1"));
	$empCheks = str_replace(',','',count_Checks_By_Client($company_id,$whr="checks_id=2"));
	$dbCheks = str_replace(',','',count_Checks_By_Client($company_id,$whr="checks_id NOT IN (1,2)"));
	$opnCase = str_replace(',','',count_Case_By_Client($company_id,$whr="v_status!='Close'"));
	$cmpCase = str_replace(',','',count_Case_By_Client($company_id,$whr="v_status='Close'"));
	//$empChekscls = str_replace(',','',count_Checks_By_Client($company_id,$whr="checks_id=2 AND as_status='Close'"));
	//$dbChekscls = str_replace(',','',count_Checks_By_Client($company_id,$whr="checks_id NOT IN (1,2) AND as_status='Close'"));
	$data['ttl'][] = array(
	
                "browser"=> "Education Checks",
                "icon" => "<i class='icon-database-check position-left'></i>",
                "value" => $eduCheks,
                "color" => "#66BB6A"
				);
	$data['ttl'][] = array(
	
                "browser" => "Employment Checks",
                "icon" => "<i class='icon-database-check position-left'></i>",
                "value" => $empCheks,
                "color" => "#9575CD"
				);
	$data['ttl'][] = array(
	
                "browser" => "Database Checks",
                "icon" => "<i class='icon-database-check position-left'></i>",
                "value" => $dbCheks,
                "color" => "#FF7043"
				);
				
	$data['dif'][] = array(
	            "status" => "Pending Applicants",
                "icon" => "<span class='status-mark border-blue-300 position-left'></span>",
                "value" => $opnCase,
                "color" => "#29B6F6"
				);
				
	$data['dif'][] = array(
	
                "status" => "Completed Applicants",
                "icon" => "<span class='status-mark border-blue-300 position-left'></span>",
                "value" => $cmpCase,
                "color" => "#81C784"
				);	
               
           	
	echo  json_encode($data); exit;
	}
	

	// dashboard timline in ajax
	
	function loadmore_timeline_dash(){
		global $db;
		
		$dateRange = urldecode($_REQUEST['dateRange']);
		$dateRange = str_replace("`","'",$dateRange);
		$company_id = $_REQUEST['company_id'];
		$LIMIT = $_REQUEST['limit_pg'];
	
		if($LEVEL==4){
			
			$uids = getUseridsLocation();
			if(!empty($uids)){
			$location_users = " AND v_uadd IN (".implode(",",$uids).") ";	
			}
		}
	
			$tbls = "ver_checks vc 
			INNER JOIN ver_data vd ON vc.v_id=vd.v_id 
			INNER JOIN checks c ON vc.checks_id=c.checks_id ";
			$cols = "vc.v_id,v_date,v_name,vc.as_id,as_uadd,DATE(as_addate) AS as_addate,DATE(as_cldate) AS as_cldate,as_status,as_vstatus,as_uni,v_status,vc.user_id,DATE(as_pdate) AS as_pdate,checks_title,thum,vc.checks_id";
			$whr = "v_isdlt=0 AND as_isdlt=0 AND com_id='$company_id' AND vc.checks_id IN (1,2) $dateRange $location_users ORDER BY v_date DESC LIMIT $LIMIT";
			//echo "SELECT $cols FROM $tbls WHERE  $whr"; exit;
			$latestCases = $db->select($tbls,$cols,$whr);
			$c=0;
			$cn=0;
			if(@mysql_num_rows($latestCases)){
			while($rsCase = @mysql_fetch_assoc($latestCases)){
				$cn++;
				//echo $cn.'. '.$rsCase[v_name]."<br>";
			$Att = $db->select("attachments","att_insuff,DATE(att_insuff_date) AS att_insuff_date","checks_id=$rsCase[as_id] AND att_active=1 AND att_insuff=1 ORDER BY att_insuff_date ASC");
			$InsuffCount = @mysql_num_rows($Att);
			while($rsAtt = @mysql_fetch_assoc($Att)){
			$InsuffDate = $rsAtt['att_insuff_date'];
			}	
			$add_data = $db->select("add_data","*","as_id=$rsCase[as_id] AND d_isdlt=0");
			$add_data_cnt = @mysql_num_rows($add_data);
			$clss2 = ($rsCase['as_status']=='Close')?"bg-success":"bg-red";
			$clss1 = "";
			$c++;
			if($c==2){
			$c=0;
			}
			if($c==0){
			$clss1 = "post-even";
			$clss2 = ($rsCase['as_status']=='Close')?"bg-success":"bg-info-400";
			}
			$download_check='';
			$download_case='';
			
			if($rsCase['as_status']=='Close' &&  $rsCase['as_status']!='Rejected'){
			$download_check = "onclick=\"downloadPDF('pdf.php?pg=case&ascase=$rsCase[as_id]');\"";
			if($rsCase['v_status']=='Close'){
			$download_case = "onclick=\"downloadPDF('pdf.php?pg=case&case=$rsCase[v_id]');\"";	
			}			
			}
			$view_case = SURL."?action=details&case=$rsCase[v_id]&_pid=183";
			$view_check = SURL."?action=details&case=$rsCase[v_id]&_pid=183&#check_tab_$rsCase[as_id]";
			
			?>
							<div class="timeline-row <?php echo $clss1;?>">
								<div class="timeline-icon">
								<?php if($rsCase['thum']=='images/default.png'){?>
								<div class="<?php echo $clss2;?>"><i class="letter-icon"></i></div>
								<?php }else{ ?>
								<a href="<?php echo $view_case;?>">
										<img src="<?php echo $rsCase['thum']; ?>"><i class="letter-icon" style="display:none;"></i>
									</a>
								
								<?php } ?>
									
								</div>

								<div class="timeline-time">
									<a href="<?php echo $view_case;?>" target="_blank"><?php echo $rsCase['v_name'];?></a> 
									<span class="text-muted"><?php echo dateTimeExe($rsCase['v_date']);?></span>
								</div>
								<div class="timeline-content">
                               
                             
								
								<div class="panel border-left-lg border-left-danger invoice-grid">
									<div class="panel-heading">
										<h6 class="text-semibold no-margin-top"><a href="<?php echo $view_check;?>" target="_blank"><?php echo $rsCase['checks_title'];?></a></h6>
										<div class="heading-elements">
											<span class="heading-text"  data-popup="tooltip" title="" data-placement="top" data-original-title="Added"><i class="icon-checkmark-circle position-left text-success"></i><?php echo dateTimeExe($rsCase['as_addate']);?></span>
						<?php
						if($rsCase['as_status']=='Open'){
						$statusTitle = 'WORK IN PROGRESS';	
						$closeClas = 'bg-grey-300';
						}else if($rsCase['as_status']=='Close'){
						$statusTitle = $rsCase['as_vstatus'];
						$color = vs_Status(strtolower($statusTitle)); 
						$closeClas = getColorClass($color);						
						}else{
						$statusTitle = $rsCase['as_status'];	
						if($statusTitle=='Insufficient'){
						$closeClas = 'bg-red';
						}else{
						$closeClas = 'bg-grey-300';	
						}
						}
						
						?>
                                           <span class="heading-text ml-10"><span class="label <?php echo $closeClas;?>"><?php echo $statusTitle;?></span></span>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a><a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>

									<div class="panel-body">
										<?php 
											$workedBy = getUserInfo($rsCase[user_id]);
											$addedBy = getUserInfo($rsCase[as_uadd]);
											$addedByfullname = $addedBy[first_name].' '.$addedBy[last_name];
											$workedByfullname = $workedBy[first_name].' '.$workedBy[last_name];
											$addedByfullnameLink = "<a href='#' >$addedByfullname</a>";
											$workedByfullnameLnik = "<a href='#' >$workedByfullname</a>";
											
											?><p class="content-group">
											<i class="icon-user-plus position-left text-success"></i>
											Check added by <?php echo $addedByfullnameLink; ?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($rsCase['as_addate']);?></span>
										</p>
										<?php
										if($rsCase['as_status']=='Insufficient'){
				
										$Insuf_Init = "Check marked as Insufficient.";	
										$totalInsuff = $InsuffCount;
										$Insuf_Init_Date = $InsuffDate;
										?> <p class="content-group">
											<i class="position-left text-danger icon-flag4"></i>
											<?php echo $Insuf_Init;?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($Insuf_Init_Date);?></span>
										</p>
										<?php 								
										}
										else if($rsCase['as_vstatus']=='Not Initiated'){
			
										$Insuf_Init = "Check not initiated yet.";
										$Insuf_Init_Date = $rsCase['as_addate'];
										
										?>	<p class="content-group">
											<i class="position-left text-teal icon-pause2"></i>
											<?php echo $Insuf_Init;?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($Insuf_Init_Date);?></span>
										</p>
									
										<?php 
										}else if($rsCase['as_vstatus']!='Not Initiated'){
										$cF =0;
										$cFPHONE =0;
										while($rsAddata = @mysql_fetch_assoc($add_data)){
										$checks_id = $rsCase['checks_id'];
										
										if($checks_id==2){
										if($rsAddata[as_id]==$rsCase[as_id]){
										if($rsAddata['d_type']=='dmain'){
										$uniTitle = $rsAddata['d_value'];
										$data_date = $rsAddata['data_date'];	
										$Insuf_Init_Date = $data_date;
										$uniTitle = substr($uniTitle,0,50);
										$uniTitle = (strlen($rsAddata['d_value'])>50)?$uniTitle.'...':$rsAddata['d_value'];
										$Unilinks = "<a href='#' data-popup='tooltip' data-placement='top' data-original-title='$rsAddata[d_value]' >$uniTitle</a>";
										$Insuf_Init = "Check initiated.";	
										
										?>	<p class="content-group">
											<i class="position-left text-purpal icon-play4"></i>
											<?php echo $Insuf_Init;?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($Insuf_Init_Date);?></span>
											</p>
											<p class="content-group">
											<i class="position-left text-yellow icon-paperplane"></i>
											<?php echo "Send to $Unilinks.";?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($Insuf_Init_Date);?></span>
											</p>
										<?
										}
										}
										}
										if($checks_id==1){
										if($rsAddata[as_id]==$rsCase[as_id]){
										if($rsAddata['d_type']=='vuni'){
										$uniTitle = $rsAddata['d_value'];
										$data_date = $rsAddata['data_date'];	
										$Insuf_Init_Date = $data_date;
										$uniTitle = substr($uniTitle,0,50);
										$uniTitle = (strlen($rsAddata['d_value'])>50)?$uniTitle.'...':$rsAddata['d_value'];
										$Unilinks = "<a href='#' data-popup='tooltip' data-placement='top' data-original-title='$rsAddata[d_value]' >$uniTitle</a>";
										$Insuf_Init = "Check initiated.";	
										
										?>	<p class="content-group">
											<i class="position-left text-purpal icon-play4"></i>
											<?php echo $Insuf_Init;?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($Insuf_Init_Date);?></span>
											</p>
											<p class="content-group">
											<i class="position-left text-yellow icon-paperplane"></i>
											<?php echo "Send to $Unilinks.";?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($Insuf_Init_Date);?></span>
											</p>
										<?
										}										
										}
										}
										if($rsAddata['d_type']=='followup'){
											
										$followupByUser = getUserInfo($rsAddata[user_id]);
										$followupByfullname = $followupByUser[first_name];
										$followupByfullnameLnik = "<a href='#' >$followupByfullname</a>";
										if($rsAddata['d_mtitle']=='Call'){
										$followBy='Call';	
										$followIcon='icon-phone2';
										}
										if($rsAddata['d_mtitle']=='Email' || $rsAddata['d_mtitle']==''){
										$followBy='Email';
										$followIcon='icon-envelop';
										}
										if($rsAddata['d_mtitle']=='Fax'){
										$followBy='Email';
										$followIcon='icon-printer2';
										}
										if($rsAddata['d_mtitle']=='Online'){
										$followBy='Email';
										$followIcon='icon-station';
										}
										if($rsAddata['d_mtitle']=='Courier'){
										$followBy='Email';
										$followIcon='icon-mailbox';
										}
										
										$cF++;
										$data_date = $rsAddata['data_date'];
										$Insuf_Init = 'Followup by '.$followupByfullnameLnik.' via '.$followBy.'';	
										$Insuf_Init_Date = $data_date;
																	
										?>	<p class="content-group">
											<i class="position-left text-primary <?php echo $followIcon;?>"></i>
											<?php echo $Insuf_Init;?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($Insuf_Init_Date);?></span>
											</p> 
											<?php
										}
										}
										}
										if($rsCase['as_status']=='Close' &&  $rsCase['as_status']!='Rejected'){
										$step1 = 3;
										$Insuf_Init = "Check has been closed and ready for <a href='javascript:;' $download_check><i class='icon-file-download2'></i> Download</a>.";	
										$Insuf_Init_Date = $rsCase['as_cldate'];
										$color = vs_Status(strtolower($rsCase['as_vstatus'])); 
										$closeClas = str_replace('bg-','text-',getColorClass($color));
										
										?>	<p class="content-group">
											<i class="<?php echo $closeClas;?> icon-checkmark-circle position-left" data-popup='tooltip' data-placement='top' data-original-title='<?php echo $rsCase[as_vstatus];?>'></i>
											<?php echo $Insuf_Init;?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($Insuf_Init_Date);?></span>
											</p>
										<?php 
										}
										?>
										 
                                       

										
									</div>

									<div class="panel-footer">
											<ul> 
											<?php 
											if($rsCase['as_status']=='Close' &&  $rsCase['as_status']!='Rejected'){ 
											$Upd_title="Closed:";
											$Upd_date = $rsCase['as_cldate'];
											$Upd_clr = "border-success";
											
											}else{
											$Upd_title="Updated:";
											$Upd_date = ($rsCase['as_pdate']!='')?$rsCase['as_pdate']:$rsCase['as_addate'];
											$Upd_clr = "border-danger";	
											} ?>
												<li><span class="status-mark <?php echo $Upd_clr;?> position-left"></span> 
												<?php echo $Upd_title;?> <span class="text-semibold"><?php echo dateTimeExe($Upd_date);?></span></li>
											</ul>

											<ul class="pull-right">
												
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
													<ul class="dropdown-menu dropdown-menu-right">
														<li><a href="<?php echo $view_case;?>"><i class="icon-eye2"></i> View Case Details</a></li>
														<li><a href="<?php echo $view_check;?>"><i class="icon-eye2"></i> View Check Details</a></li>
														<?php echo ($download_case!="")?'<li><a href="javascript:;" '.$download_case.'><i class="icon-file-download2 text-info"></i>Download Case Report</a></li>':'';
														
														echo ($download_check!="")?'<li><a href="javascript:;" '.$download_check.'><i class="icon-file-download2 text-info"></i>Download Check Report</a></li>':'';
														?>
														
													</ul>
												</li>
											</ul>
										</div>
                                    
								</div>
								
								
                                </div>
							</div>
			<?php 
			
		
			
			} 
	}else{
	
	echo 'No More Records';
	}	
	}
	
	
	

	 
	 ?>