<?php
	$source=$db->select("activity","a_id,a_date","user_id=$_SESSION[user_id] AND a_date=(SELECT MAX(a_date) FROM activity WHERE user_id=$_SESSION[user_id] AND a_type='login')");
	if(mysql_num_rows($source)>0){
		$source=mysql_fetch_array($source);
		if($_REQUEST['break']==1){
			$cols="is_break=1";
			if(isset($_REQUEST['time'])) $cols="$cols,a_sion='$_REQUEST[time]'";
		}else $cols="is_break=0,a_sion='$_REQUEST[time]'";
		echo "$cols,a_date='$source[a_date]'","activity","a_id=$source[a_id]"; 
		$db->update("$cols,a_date='$source[a_date]'","activity","a_id=$source[a_id]");
	}
?>