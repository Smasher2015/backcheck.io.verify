 <?php
 include ('/home/backglob/public_html/verify/include/config.php');
	//AND bitrixlid IS NULL	
		global $db;
		//SELECT vd.v_id,com_id,as_bcode,v_bcode,as_addate FROM WHERE  as_isdlt=0 AND v_isdlt=0 AND v_bcode IS NULL ORDER BY as_id  DESC LIMIT 200;
		$cols = "v_id,com_id,v_bcode";
		$tbls = "ver_data";
		$where = "v_isdlt=0 AND v_bcode IS NULL limit 1";
		$sel = $db->select($tbls,$cols,$where);
		
		while($rs = mysql_fetch_assoc($sel)){
		$v_bcode = cBCode($rs[com_id],$rs[v_id]);	
		$sell = $db->select("ver_checks","as_id,as_bcode,checks_id","v_id=$rs[v_id]");
		echo "Update ver_data set v_bcode='$v_bcode' where v_id=$rs[v_id]; <br>";
		if($db->update("v_bcode='$v_bcode'","ver_data","v_id=$rs[v_id]")){
		while($rss = mysql_fetch_assoc($sell)){
		//$bcode = cBCode(0,0,$rs[v_id],$rss[checks_id]);
		echo "Bcode: $v_bcode".$rss[as_bcode]."<br>";
		$bcode = $v_bcode.$rss[as_bcode];
		echo "Update ver_data set as_bcode='$bcode' where as_id=$rss[as_id]; <br><br>";	
		$db->update("as_bcode='$bcode'","ver_checks","as_id=$rss[as_id]");
		}
		
		
		//echo $bcode."<br>";
		}
		}
		
	
	?>