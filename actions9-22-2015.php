<?php
session_start();
$AJAX=true;
include('include/config.php');
if($action=="noAccess"){
	echo "noAccess";	
	exit();
}

if(isset($_REQUEST['ePage'])){
	$ePage = $_REQUEST['ePage'];
}else $ePage ='';


if($ePage!=''){
	if(file_exists('include_pages/'.$ePage.'_inc.php')){
		include('include_pages/'.$ePage.'_inc.php');
	}else echo 'noAccess';
	exit();
}

if(isset($_REQUEST['fedit'])){
	switch($LEVEL){
		case 1:
			$iPage="config_admin.php";
		break;
		case 2:
		case 3:
		case 6:
		case 10:
		case 11:
		case 12:
		
			$iPage="config_actions.php";
		break;
		case 4:
		case 5:
			$iPage="config_client.php"; 
		break;					
	}
	include("include/$iPage");
	if($_REQUEST['CNT']>0){
		if($_REQUEST['ERR']!='') echo $_REQUEST['ERR'];
		if($_REQUEST['SCS']!='') echo $_REQUEST['SCS'];
	}
	exit();
}

echo 'noAccess';
exit();
?>