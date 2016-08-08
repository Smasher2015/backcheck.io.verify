<?php 
	// For By Status Chart
	$closecas = countCases("(v_status='Close' AND v_sent=4) $comWhere");
	$Submitted = countCases("1=1 $comWhere");
	$balrt="v_rlevel='negative' OR v_rlevel='match found' OR v_rlevel='record found' OR v_rlevel='unable to verify' OR v_rlevel='discrepancy'";
	$balrt="(($balrt) AND (as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found' OR as_vstatus='unable to verify' OR as_vstatus='discrepancy'))";		
	$discrepancy = countCases("(v_status='Close' AND v_sent=4) AND $balrt $comWhere");
	$needatten = countCases("(v_status='Close' AND v_sent=4) AND vc.as_status='problem' $comWhere");
	$wipcas   = ($Submitted-$closecas);	
	
	
	// For By Status Chart Checks
	$discrepancy_checks 	= countChecks("as_vstatus='Discrepancy' $comWhere");
	$need_attention_checks 	= countChecks("as_status='problem' $comWhere");
	$submitted_checks 		= countChecks("1=1 $comWhere");
	$completed_checks 		= countChecks("as_status='Close' $comWhere");
	$wipchecks   			= ($submitted_checks-$completed_checks);	

	
	// For By Risk Chart By cases
	/*
	
	$selFilters = getFiltersBy('by_risk','v_cldate');
	$addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:'';
	
	$where = "v_status='Close'";
	if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){
		$where = "$where AND com_id=20";
	}elseif($LEVEL==4) $where = "$where AND com_id=$COMINF[id]";

	$cols = "(SELECT DATE_FORMAT(v_date, '%b-%y') mnth,COUNT(v_rlevel) cnt,
			IF((v_rlevel='verified' || v_rlevel='satisfactory' || v_rlevel='no match found'
			|| v_rlevel='no record found' || v_rlevel='positive match found'), 'green',
			IF((v_rlevel='negative' || v_rlevel='match found' || v_rlevel='record found'),'red',
			IF((v_rlevel='unable to verify' || v_rlevel='discrepancy'),'amber','na'))) sts,v_date FROM ver_data";
	$cols ="$cols WHERE $where AND v_isdlt=0 $addFilter GROUP BY mnth,sts ORDER BY v_date DESC LIMIT 36) DATA";
	$months = $db->select($cols,"*","1=1 ORDER BY v_date");

	$tData = array(); $mData = array();
	while($month = mysql_fetch_assoc($months)){
			if(!isset($tData[$month['mnth']]['red'])){
				$tData[$month['mnth']]['red']   = 0;
				$tData[$month['mnth']]['green'] = 0;
				$tData[$month['mnth']]['amber'] = 0;
				$mData[$month['mnth']] = 0;
			}
			$mData[$month['mnth']]          = $mData[$month['mnth']]+$month['cnt'];
			$tData[$month['mnth']][$month['sts']] = $month['cnt'];	 
	}
	$at=0; foreach($tData as $mon=>$val){ $at+=$val['amber'];}
	$rt=0; foreach($tData as $mon=>$val){ $rt+=$val['red'];}
	$gt=0; foreach($tData as $mon=>$val){ $gt+=$val['green'];}
	
	*/
	
		// For By Risk Chart by Checks
	
	
	$selFilters = getFiltersBy('by_risk','as_cldate',$company_id);
	$addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:'';
	
	$where = "v_status='Close'";
	if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){
		$where = "$where AND com_id=20";
	}elseif($LEVEL==4){ 
	
	$where = "$where AND com_id=$COMINF[id]"; 
	$uids = getUseridsLocation();
		if(!empty($uids)){
		$where = " $where AND v_uadd IN (".implode(",",$uids).") ";	
		}
	}

	$cols = "(SELECT DATE_FORMAT(v_date, '%b-%Y') mnth,COUNT(v_rlevel) cnt,
			IF((v_rlevel='verified' || v_rlevel='satisfactory' || v_rlevel='no match found'
			|| v_rlevel='no record found' || v_rlevel='positive match found'), 'green',
			IF((v_rlevel='negative' || v_rlevel='match found' || v_rlevel='record found'),'red',
			IF((v_rlevel='unable to verify' || v_rlevel='discrepancy'),'amber','na'))) sts,v_date FROM ver_data  inner join ver_checks on ver_checks.v_id=ver_data.v_id";
	$cols ="$cols WHERE $where AND v_isdlt=0  $addFilter $comWhere GROUP BY mnth,sts ORDER BY v_date DESC LIMIT 36) DATA";
	
	$months = $db->select($cols,"*","1=1 ORDER BY v_date");

	$tData = array(); $mData = array();
	while($month = mysql_fetch_assoc($months)){
			if(!isset($tData[$month['mnth']]['red'])){
				$tData[$month['mnth']]['red']   = 0;
				$tData[$month['mnth']]['green'] = 0;
				$tData[$month['mnth']]['amber'] = 0;
				$mData[$month['mnth']] = 0;
			}
			$mData[$month['mnth']]          = $mData[$month['mnth']]+$month['cnt'];
			$tData[$month['mnth']][$month['sts']] = $month['cnt'];	 
	}
	$at=0; foreach($tData as $mon=>$val){ $at+=$val['amber'];}
	$rt=0; foreach($tData as $mon=>$val){ $rt+=$val['red'];}
	$gt=0; foreach($tData as $mon=>$val){ $gt+=$val['green'];}
	
	
	/*$LastSixMonthOpenCheckTables = "
							`ver_checks` vc 
							LEFT JOIN `ver_data` vd ON vc.`v_id` = vd.`v_id`  
							LEFT JOIN `company` com ON vd.`com_id` = com.id 
							LEFT JOIN `checks` chk ON vc.checks_id = chk.checks_id 
							";
	$LastSixMonthOpenCheckCols		= "COUNT(vc.`as_status`) Applicant_Check_Status"; 
	$LastSixMonthOpenCheckWhere 	= "vc.as_addate >= DATE_FORMAT(CURDATE(), '%Y-%m-01') - INTERVAL 6 MONTH AND vd.com_id=96 AND vc.`as_status`='Open'";
	$LastSixMonthOpenCheckQuery 	= $db->select($LastSixMonthOpenCheckTables,$LastSixMonthOpenCheckCols,$LastSixMonthOpenCheckWhere);
	$LastSixMonthOpenCheckResult 	= mysql_fetch_assoc($LastSixMonthOpenCheckQuery);
	$LastSixMonthOpenCheck 			= $LastSixMonthOpenCheckResult['Applicant_Check_Status'];*/
	$LastSixMonthOpenCheck 		= lastSixMonthChecks('Open');
	$LastSixMonthCloseCheck 	= lastSixMonthChecks('Close');
	$LastSixMonthNegativeCheck 	= lastSixMonthChecks('Close','Negative');
	$LastSixMonthPositiveCheck 	= lastSixMonthChecks('Close','Positive Match Found');
	
	//echo 'LastSixMonthOpenCheck ==' . $LastSixMonthOpenCheck;
	//echo 'LastSixMonthCloseCheck ==' . $LastSixMonthCloseCheck;
	//echo 'LastSixMonthNegativeCheck ==' . $LastSixMonthNegativeCheck;
	//echo 'LastSixMonthPositiveCheck ==' . $LastSixMonthPositiveCheck;
	
	
	$first  = strtotime('first day this month');
	$alphaMonth = array();
	$numericMonth = array();
	$numericYear = array();

	for ($i = 6; $i >= 1; $i--) {
  		array_push($alphaMonth, date('M', strtotime("-$i month", $first)));
		array_push($numericMonth, date('m,Y', strtotime("-$i month", $first)));
		array_push($numericYear, date('Y', strtotime("-$i month", $first)));
	}
	

	$loopMonth = '';
	//echo 'Looooop';
	foreach($alphaMonth as $m_data){
			$loopMonth .= "'".$m_data." '" . ",";
			//echo $vcount . ',';

	}
	$loopMonth = rtrim($loopMonth,',');
	
	$loopMonthRec = array();
	
	foreach($numericMonth as $MonthRec){
			$MonthYear = explode(',', $MonthRec);
			$loopMonthRec[] = SingleMonthChecks('Open','',$MonthYear[0],$MonthYear[1]);
	}
	$openCheckMonthRec = implode(',', $loopMonthRec);
	
	
	
	$loopMonthCloseRec = array();
	foreach($numericMonth as $CloseRec){
			$MonthYear = explode(',', $CloseRec);
			$loopMonthCloseRec[] = SingleMonthChecks('Close','',$MonthYear[0],$MonthYear[1]);
	}
	$closeCheckMonthRec = implode(',', $loopMonthCloseRec);
	
	
	
	$loopMonthCloseNegRec = array();
	foreach($numericMonth as $NegRec){
			$MonthYear = explode(',', $NegRec);
			$loopMonthCloseNegRec[] = SingleMonthChecks('Close','Negative',$MonthYear[0],$MonthYear[1]);
	}
	$closeNegCheckMonthRec = implode(',', $loopMonthCloseNegRec);
	
	
	
	$loopMonthClosePosRec = array();
	foreach($numericMonth as $PosRec){
			$MonthYear = explode(',', $PosRec);
			$loopMonthClosePosRec[] = SingleMonthChecks('Close','Positive Match Found',$MonthYear[0],$MonthYear[1]);
	}
	$closePosCheckMonthRec = implode(',', $loopMonthClosePosRec);
	
	
 ?>
<script type="text/javascript">
				// For By Status Chart
				var completed 				= <?=$completed_checks?>;
				var inprogress 				= <?=$wipchecks?>;
				var needattention 			= <?=$need_attention_checks?>;
				var discrepancy 			= <?=$discrepancy_checks?>;
				var lastSixMonthopenchecks 	= <?=$LastSixMonthOpenCheck?>;
				var lastSixMonthClosechecks = <?=$LastSixMonthCloseCheck?>;
				var lastSixMonthNegativeCheck = <?=$LastSixMonthNegativeCheck?>;
				var lastSixMonthPositiveCheck = <?=$LastSixMonthPositiveCheck?>;
				// For By Risk Chart
				var amber 		= <?=$at?>;
				var red 		= <?=$rt?>;
				var green 		= <?=$gt?>;
				$(document).ready(function(e) {
					//proton.dashboard.drawByStatus(completed,inprogress,needattention,discrepancy);
					proton.dashboard.drawByRisk(amber,red,green);
					//proton.dashboard.threemonthsdata(lastSixMonthopenchecks,lastSixMonthClosechecks,lastSixMonthNegativeCheck,lastSixMonthPositiveCheck);
						$(function () {	
								$('#threemonthsdata').highcharts({
							chart: {
								type: 'area'
							},
							title: {
								text: 'Last Six Months Checks'
							},
							//subtitle: {
							//	text: 'Source: Wikipedia.org'
							//},
						credits: {
							enabled: false
						},
							xAxis: {
								categories: [<?php echo $loopMonth;?>],
								tickmarkPlacement: 'on',
								title: {
									enabled: false
								}
							},
							yAxis: {
								title: {
									text: 'Percent'
								}
							},
							tooltip: {
								pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.percentage:.1f}%</b> ({point.y:,.0f} Check(s))<br/>',
								shared: true
							},
							plotOptions: {
								area: {
									stacking: 'percent',
									lineColor: '#ffffff',
									lineWidth: 1,
									marker: {
										lineWidth: 1,
										lineColor: '#ffffff'
									}
								}
							},
							series: [{
								name: 'Open',
								data: [<?php echo $openCheckMonthRec; ?>]
							}, {
								name: 'Close',
								data: [<?php echo $closeCheckMonthRec; ?>]
							}, {
								name: 'Negative',
								data: [<?php echo $closeNegCheckMonthRec; ?>]
							}, {
								name: 'Positive',
								data: [<?php echo $closePosCheckMonthRec; ?>]
							}]
						});
					});
				});
			


</script>