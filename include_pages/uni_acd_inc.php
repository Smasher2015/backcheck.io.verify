<?php
	if($_REQUEST['uni']!=''){
		//echo "SELECT * FROM uni_info WHERE uni_Name LIKE '$_REQUEST[uni]';";
		$uniInfo = $db->select("uni_info","*","uni_Name LIKE '$_REQUEST[uni]'");
		if(mysql_num_rows($uniInfo)==1){
			$uniInfo = mysql_fetch_assoc($uniInfo);
			
			if(isset($_REQUEST['cid']) && is_numeric($_REQUEST['cid'])){
				$check = $db->select("ver_checks","*","as_id=$_REQUEST[cid] AND as_update=0");
				if(mysql_num_rows($check)==1){
					$db->update("as_uni=$uniInfo[uni_id]","ver_checks","as_id=$_REQUEST[cid] AND as_update=0");
				}
			}
		
		
		echo "$uniInfo[uni_url]||$uniInfo[uni_var] $uniInfo[uni_ac_url]";
		exit();
		}
	}
	echo 'NA';
?>