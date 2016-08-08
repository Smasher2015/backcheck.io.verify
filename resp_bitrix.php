<?php
include ('include/config.php');
define("sav_table","dataflow");
define("pak_table","ver_checks");
	switch($_REQUEST['action']){
		case "check_status":
		check_status();
		break;
		case "checks_loop":
		checks_loop();
		break;
		case "checkapproved":
		checks_approved();
		break;
		case "checkrejected":
		checks_rejected();
		break;
		default:
		exit;
	}
	
	
//by ata
function checks_approved(){
	global $db;
  $savvion_check_id = (int)$_REQUEST['bitrixtid'];
  $cols = 'qa_status,bot_status';
  $values = "2,1";
   $isAddEdit = $db->updateCol($cols,$values,'records',"bitrixtid=$savvion_check_id"); 
   if($isAddEdit){
	   $arr = array('true');
	 echo json_encode($arr); exit; 
	   }else{
		    $arr = array('false');
		echo json_encode($arr); exit;    
		   }
   
 }
//by ata
function checks_rejected(){
	global $db;
  $savvion_check_id = (int)$_REQUEST['bitrixtid'];
  $cols = 'qa_status,bot_status';
  $values = "0,1";
  $isAddEdit = $db->updateCol($cols,$values,'records',"bitrixtid=$savvion_check_id");   
   if($isAddEdit){
	   $arr = array('true');
	 echo json_encode($arr); exit; 
	   }else{
		    $arr = array('false');
		echo json_encode($arr); exit;    
		   } 
 }	
	
	
	
	
	
	
function check_status(){
	$task_id=(int)$_REQUEST['task_id'];
	$type=$_REQUEST['type'];
	if($type=='sav'){
	$qastatus=mysql_fetch_array(mysql_query("select qa_status from ".sav_table." where bitrixtid=".$task_id.""));
	echo $qastatus['qa_status'];
	}
	if($type=='pak'){
	$qastatus=mysql_fetch_array(mysql_query("select as_qastatus from ".pak_table." where bitrixtid=".$task_id.""));
	echo $qastatus['as_qastatus'];
	}
}
function checks_loop(){
	$checks=mysql_query("SELECT checks_title,checks_id FROM checks WHERE is_active=1");
	while($check=mysql_fetch_array($checks)){
		$json_encode[]=$check;
	}
	print_r(json_encode($json_encode));
}
?>