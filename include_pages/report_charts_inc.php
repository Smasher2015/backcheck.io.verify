<?php 
	// For By Status Chart Cases
	$closecas = countCases("(v_status='Close' AND v_sent=4)");
	$Submitted = countCases();
	$balrt="v_rlevel='negative' OR v_rlevel='match found' OR v_rlevel='record found' OR v_rlevel='unable to verify' OR v_rlevel='discrepancy'";
	$balrt="(($balrt) AND (as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found' OR as_vstatus='unable to verify' OR as_vstatus='discrepancy'))";		
	$discrepancy = countCases("(v_status='Close' AND v_sent=4) AND $balrt");
	$needatten = countCases("(v_status='Close' AND v_sent=4) AND vc.as_status='problem'");
	$wipcas   = ($Submitted-$closecas);	
	
	// For By Status Chart Checks
	$discrepancy_checks 	= countChecks("as_vstatus='Discrepancy'");
	$need_attention_checks 	= countChecks("as_status='problem'");
	$submitted_checks 		= countChecks();
	$completed_checks 		= countChecks("as_status='Close'");
	$wipchecks   			= ($submitted_checks-$completed_checks);	
	
	// For By Risk Chart
	$where = "v_status='Close'";
	if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){
		$where = "$where AND com_id=20";
	}elseif($LEVEL==4) $where = "$where AND com_id=$COMINF[id]";

	$cols = "(SELECT DATE_FORMAT(v_date, '%b-%Y') mnth,COUNT(v_rlevel) cnt,
			IF((v_rlevel='verified' || v_rlevel='satisfactory' || v_rlevel='no match found'
			|| v_rlevel='no record found' || v_rlevel='positive match found'), 'green',
			IF((v_rlevel='negative' || v_rlevel='match found' || v_rlevel='record found'),'red',
			IF((v_rlevel='unable to verify' || v_rlevel='discrepancy'),'amber','na'))) sts,v_date FROM ver_data";
	$cols ="$cols WHERE $where AND v_isdlt=0 GROUP BY mnth,sts ORDER BY v_date DESC LIMIT 36) DATA";
	
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
	 $LoopD = '';
	 foreach($tData as $mon=>$val){ 
			$amber 	= 	$val['amber'];
			$red 	=  	$val['red'];
			$green 	= 	$val['green'];
			$str 	= 	substr($mon, 4);
			$LoopD  .= "{period: '$str', amber: $amber, red: $red, green:$green},";
			
	
	}
	
	
	
	$vcols = "COUNT(as_id) AS nums ,DATE_FORMAT(as_addate,'%Y-%m') AS mmyy, DATE_FORMAT(as_addate,'%m-%y') AS addate ";
	$vtble = "`ver_data` AS vd INNER JOIN `ver_checks` AS vc ON vd.v_id = vc.v_id";
	$volume_data = $db->select($vtble ,$vcols,"vd.com_id=1 AND vc.as_isdlt = 0 AND vd.v_isdlt = 0 GROUP BY addate ORDER BY as_addate ASC");
	$loopV = '';
	while($v_data = mysql_fetch_assoc($volume_data)){
		
		$vdate = $v_data['mmyy'];
		$vcount = $v_data['nums'];
		$loopV  .= "{ year: '$vdate', value: $vcount },";
	}
	$LoopD .= rtrim($LoopD,',');
	$loopV .= rtrim($loopV,',');
	
 ?>

<script type="text/javascript">
				// For By Status Chart
				var completed 		= <?=$completed_checks?>;
				var inprogress 		= <?=$wipchecks?>;
				var needattention 	= <?=$need_attention_checks?>;
				var discrepancy 	= <?=$discrepancy_checks?>;
				// For By Risk Chart
				var amber 		= <?=$at?>;
				var red 		= <?=$rt?>;
				var green 		= <?=$gt?>;
				// For By Month Chart;
				var jsonL 		= "[<?=$LoopD?>]";
				var loopV 		= "[<?=$loopV?>]";
				
				$(document).ready(function(e) {					
					proton.dashboard.drawByStatusReport(completed,inprogress,needattention,discrepancy);
					proton.dashboard.drawByRiskReport(amber,red,green);
					//proton.dashboard.drawHeroArea();
					proton.dashboard.drawHeroArea(jsonL);
					proton.dashboard.drawBasicChart(loopV);

					
				});

</script>