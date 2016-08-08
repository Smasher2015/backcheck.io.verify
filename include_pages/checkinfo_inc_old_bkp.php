<?php
if(isset($cCheck)) $_REQUEST['ascase']=$cCheck;
if(is_numeric($_REQUEST['ascase'])){
	$check = $db->select("ver_checks","*","as_id=$_REQUEST[ascase]");
	$check = mysql_fetch_assoc($check);
	if(is_numeric($check['user_id'])){
		$userInfo = getUserInfo($check['user_id']);
		$analyst="$userInfo[first_name] $userInfo[last_name]";
	}else{
		$analyst="Not Assigned";
	}	
	?>
    <p><strong>Analyst : </strong> <?=$analyst?></p>
    <p><strong>Remarks: </strong> <?=$check['as_remarks']?></p>
    
    <p><strong>Status : </strong> <?=$check['as_vstatus']?> [ <?=$check['as_status']?> ] </p>
	<?php if($LEVEL==2 || $LEVEL==3){?>	
            <p><a href="<?="?action=start&ascase=$check[as_id]&_pid=$_REQUEST[_pid]"?>">Start Verification</a></p>
    <?php } ?>    
<?php } ?>