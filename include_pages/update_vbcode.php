 <?php
 include ('/home/backglob/public_html/verify/include/config.php');
	//AND bitrixlid IS NULL	
		global $db;
		//SELECT vd.v_id,com_id,as_bcode,v_bcode,as_addate FROM WHERE  as_isdlt=0 AND v_isdlt=0 AND v_bcode IS NULL ORDER BY as_id  DESC LIMIT 200;
		$cols = "vd.v_id,com_id,as_bcode,v_bcode,as_addate";
		$tbls = "ver_checks vc INNER JOIN ver_data vd  ON vc.v_id=vd.v_id";
		$where = "as_isdlt=0 AND v_isdlt=0 AND v_bcode IS NULL";
		$sel = $db->select($tbls,$cols,$where);
		
		while($rs = mysql_fetch_assoc($sel)){
		$bcode = cBCode($rs[com_id],$rs[v_id]);	
		echo $bcode."<br>";
		}
		
	
	?>