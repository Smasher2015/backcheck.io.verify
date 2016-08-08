<ul class="chosen-results"> 
<?php
	
	$nVal = strtolower(trim($_GET['input']));
	if($nVal!='' && isset($_SESSION['user_id'])){
		if(is_numeric($nVal)) $where="vd.emp_id=$nVal"; else  $where="(vd.v_name LIKE '%$nVal%' OR vd.v_bcode='$nVal' OR vc.as_bcode='$nVal' OR vd.v_refid='$nVal')";
		$ddchecks = "";
		$tabls = "ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id INNER JOIN checks ck ON vc.checks_id=ck.checks_id";
		$where = "$where AND ck.checks_show=1 AND vd.v_isdlt=0 AND vc.as_isdlt=0 AND vc.as_update=0";
		
		if($_GET['checks']){
			$tchecks = explode(',',$_GET['checks']);
			foreach($tchecks as $ddcheck){
				if(is_numeric($ddcheck)) $ddchecks = ($ddchecks=='')?$ddcheck:"$ddchecks,$ddcheck";
			}
		}	
		
		
		
		if($ddchecks!='') $where = "$where AND vc.as_id NOT IN ($ddchecks)";
		
		
		
		$cases = $db->select($tabls,"*","$where LIMIT 10");
		
	
		if(mysql_num_rows($cases)>0){
		while($check=mysql_fetch_assoc($cases)){ 
		
				$com = getcompany($check['com_id']);
				$com = mysql_fetch_assoc($com); ?>
			<li class="active-result" onclick="addsearch(this,'<?=$check['as_id']?>')">
                <?="#:$check[emp_id] ".$check['v_name']." ($com[name]) $check[checks_title]"?>
            </li>
	<?php	}
		}else{ ?>
			<li class="active-result" >
                No Record Found
            </li>
	<?php	}
	}
?>
</ul>