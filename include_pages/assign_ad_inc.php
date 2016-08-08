<?php 
if(isset($_REQUEST['sentto'])){
	if(isset($_REQUEST['record'])){
		$db = new DB();
		foreach($_REQUEST['record'] as $term){				
			if($_REQUEST['acType']=='Client') $uCols="v_sent=4"; else $uCols="v_save=0";
			$isUpdate = $db->update($uCols,"ver_data","v_id=$term");
			if(!$isUpdate){
				echo msg('err',"Record updation Error!");
			}
		}
	}else{
		 echo msg('err',"Please Checkout Any Case/Cases to Sent");	
	}
}

	$page ="?action=$_REQUEST[action]&"; 
	if($_REQUEST['o'] == 'a') $o = 'd'; else $o='a';
?>

<?php include("include_pages/assign_cases_inc.php"); ?>


