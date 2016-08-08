<?php
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header ("Pragma: no-cache"); // HTTP/1.0
	header("Content-Type: application/json");
	
	$nVal = strtolower(trim($_GET['input']));
	
	$arr = array();
	if($nVal!='' && isset($_SESSION['user_id'])){
		$VID = explode("-",$nVal);
		if(count($VID)>1) $VID[1] = intval($VID[1]);
		if(strtoupper($VID[0])=="BCPL" && count($VID)>1){
			 $where="vd.v_id=".$VID[1];
		}else{
			if(is_numeric($nVal)) $where="vd.emp_id=$nVal"; else  $where="(vd.v_name LIKE '%$nVal%' OR v_bcode='$nVal' OR as_bcode='$nVal' OR v_refid='$nVal')";
		}
		switch($LEVEL){
			case 2:
				if($_SESSION['user_id']==83){
					$where="$where AND vd.com_id=20";
				}else $where="$where";				
			break;
			case 3:
				$where="$where AND vc.user_id=$_SESSION[user_id]";
			break;
			case 4:
				$where="$where AND vd.com_id=$COMINF[id]";
			break;
			default:
				$where="1<>1";
			break;				
		}
			
		$tbls="ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id";
		$cases = $db->select($tbls,"DISTINCT vd.v_id,vd.v_name","$where LIMIT 5");
		
		while($case=mysql_fetch_assoc($cases)){
			$arr[] = "{\"id\": \"".$case['v_id']."\", \"value\": \"".$case['v_name']."\", \"info\": \"\"}";
		}
	}
	echo "{\"results\": [";
	echo implode(",", $arr);
	echo "]}";
	?>