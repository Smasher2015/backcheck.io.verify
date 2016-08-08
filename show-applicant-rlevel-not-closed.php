<?php include("include/config.php");
//echo date("Y-m-d H:i:s"); exit;

$tbls = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.`v_id` INNER JOIN checks c ON c.checks_id=vc.`checks_id` INNER JOIN company cc ON cc.id=vd.`com_id`";
	$cols = "vc.v_id,v_uadd,vd.com_id,v_name,cc.name as com_name,emp_id,checks_title,date(v_date) as v_date";
	$where = "as_isdlt=0 AND v_isdlt=0 AND v_rlevel='N/A' AND vd.com_id NOT IN (111) GROUP BY vc.v_id order by v_date asc";
	//echo "SELECT $cols FROM $tbls WHERE $where";
	$sel = $db->select($tbls,$cols,$where);
	$cc=0;
	$bodyTbl = "<table cellpadding='5' cellspacing='0' border='1' >
	<tr><td>#</td><td>Applicant</td><td>Client</td><td>Closed</td> <td>Added On</td><td>Bitrix URL</td><td>Portal URL</td></tr>";
	while($rs  = @mysql_fetch_assoc($sel)){
		$tnt = countChecks("vc.v_id=$rs[v_id] AND as_isdlt=0");
        $cnt = countChecks("vc.as_status='Close' AND vc.v_id=$rs[v_id] AND as_isdlt=0");
		if($tnt==$cnt){
			$cc++;
			
			$bitrixURL = "http://my.backcheck.io/search/index.php?q=".urlencode($rs[v_name])."";
			$portalURL = SURL."?action=details&case=$rs[v_id]&_pid=183";
		$bodyTbl .= "<tr><td>$cc.</td><td>$rs[v_name]</td><td>$rs[com_name]</td> <td>$cnt of $tnt</td> <td>$rs[v_date]</td><td><a href='$bitrixURL' target='_blank'>View Bitrix</a></td><td><a href='$portalURL' target='_blank'>View Portal</a></td></tr>";
		}
                
	}
$bodyTbl .= "</table>";
echo $bodyTbl;
exit;

 


	  
    ?>
