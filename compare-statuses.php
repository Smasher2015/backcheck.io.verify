<?php include("include/config.php");
//echo date("Y-m-d H:i:s"); exit;

$selBitrixTasks = selBitrixTasks();
//var_dump($selBitrixTasks); die;
	$cc=0;
	$bodyTbl = "<table cellpadding='5' cellspacing='0' border='1' >
	<tr><td>#</td><td>Applicant</td><td>Client</td><td>QC Status at Portal</td> <td>Status at Bitrix</td> <td>Closed</td> <td>Added On</td><td>Bitrix URL</td><td>Portal URL</td></tr>";
foreach($selBitrixTasks as $key => $rst){
	
 $tbls = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.`v_id` INNER JOIN checks c ON c.checks_id=vc.`checks_id` INNER JOIN company cc ON cc.id=vd.`com_id`";
	$cols = "vc.v_id,v_name,cc.name as com_name,emp_id,checks_title,date(v_date) as v_date,as_status,as_qastatus";
	$where = "as_isdlt=0 AND v_isdlt=0 AND bitrixtid =".$selBitrixTasks[$key]->ID." ";
	//$where = "as_isdlt=0 AND v_isdlt=0 AND bitrixtid IN(".implode(",",$selBitrixTasks['ID']).")";
	//echo "SELECT $cols FROM $tbls WHERE $where <br><br><br>";
	
	$sel = @mysql_query("SELECT $cols FROM $tbls WHERE $where");
	//$sel = $db->select($tbls,$cols,$where);

	$rs  = @mysql_fetch_assoc($sel);
	//var_dump($rs); die;
		$tnt = countChecks("vc.v_id=$rs[v_id] AND as_isdlt=0");
        $cnt = countChecks("vc.as_status='Close' AND vc.v_id=$rs[v_id] AND as_isdlt=0");
		//var_dump($selBitrixTasks[$key]->sts); echo "<br>";
		if($tnt==$cnt){
		if($rs['as_qastatus']=='QA' && $selBitrixTasks[$key]->sts=='Completed'){
		 if($rs['as_qastatus']=='QA' && $selBitrixTasks[$key]->sts=='Completed'){ 
		$bgColor = "style='background-color:#ff0000;'"; 
		}else{
		$bgColor = ""; 	
		} 
		$cc++;
			
		$bitrixURL = "http://my.backcheck.io/search/index.php?q=".urlencode($rs[v_name])."";
		$portalURL = SURL."?action=details&case=$rs[v_id]&_pid=183";
		//$bgColor='';
		
		$bodyTbl .= "<tr  $bgColor ><td>$cc.</td><td>$rs[v_name]</td><td>$rs[com_name]</td><td>$rs[as_qastatus]</td><td>".$selBitrixTasks[$key]->sts."</td> <td>$cnt of $tnt</td> <td>$rs[v_date]</td><td><a href='$bitrixURL' target='_blank'>View Bitrix</a></td><td><a href='$portalURL' target='_blank'>View Portal</a></td></tr>";
		}
		}  
	
}
if($cc==0){
	$bodyTbl .= "<tr style='background-color:#28A33D; color:#ffffff;' align='center'><td colspan='10'>No case found without verification status selected.</td></tr>";
}
$bodyTbl .= "</table>";
echo $bodyTbl;
exit;


	  
    ?>
