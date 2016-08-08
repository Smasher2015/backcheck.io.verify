<style type="text/css">
.applicant_dashboard{ min-height:800px; position:relative;}
</style>
<?php 
 /* if($LEVEL==5){
 $che=$db->select("add_data","user_id","user_id=$_SESSION[user_id]");
 if(mysql_num_rows($che)==0){ ?>
 	<div class="block" >
       <div class="alert  alert_green">
         <img height="24" width="24" src="images/icons/small/white/alarm_bell.png">
         <a href="?action=upload&atype=documents" style="color:yellow">Click Here to Complete Your Documents Process</a>
       </div>
   </div>
     
   
<?php }				
 }?> 
<?php include("include_pages/details_new.php"); */


// by khl

$user_id = $_SESSION['user_id'];
	$uInfo = $db->select("users","*","user_id=$user_id");
	$userInfo = mysql_fetch_assoc($uInfo);
	
	$company_id = $userInfo['com_id'];

$hashInfo = $db->select("check_date","*","user_id='$user_id'");
if(mysql_num_rows($hashInfo)>0){
		$hInfo = mysql_fetch_assoc($hashInfo);
		$userHash = $hInfo['cd_hash'];
		$userHashDate = $hInfo['cd_date'];
		$userHashExpDate 	= $hInfo['cd_exp_date'];
		$checkIds =  $hInfo['check_ids'];
		$employeCode =  $hInfo['cd_employee_code'];
	}
 
$casInfo = $db->select("ver_data","*","v_uadd='$user_id' AND emp_id=".$employeCode." AND com_id=".$company_id);

if(mysql_num_rows($casInfo)>0){
	$Case = mysql_fetch_assoc($casInfo);
	$_REQUEST['case']=$Case['v_id'];
	include("include_pages/details_new.php");
	
}else{
	include("include_pages/add_applicant_case_via_ids_inc.php");
}











	
	
?>