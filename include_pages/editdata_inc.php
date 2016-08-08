<?php
$_REQUEST['val'] = str_replace('||','&',$_REQUEST['val']);
$iVal = htmlspecialchars(trim($_REQUEST['val']));
$cols="$_REQUEST[key]='$iVal'";

switch($_REQUEST['typ']){
	case 'date':
		$eVal = date("j-F-Y",strtotime($iVal));
	break;
	case 'multy':
		$_REQUEST['mtt1'] = str_replace('||','&',$_REQUEST['mtt1']);
		$_REQUEST['stt1'] = str_replace('||','&',$_REQUEST['stt1']);
		$mtt1 = htmlspecialchars(trim($_REQUEST['mtt1']));
		$stt1 = htmlspecialchars(trim($_REQUEST['stt1']));
		$cols=$cols.",d_stitle='$stt1',d_mtitle='$mtt1'";
		$eVal = "$mtt1||$stt1||$iVal";
	break;	
	default:
		$eVal= $iVal;
	break;
}

if(isset($_REQUEST['data'])){
	if(edData($_REQUEST['data'],'edit',$cols)){
		echo $eVal;
	}else echo "u error";
	exit();		
}else if(isset($_REQUEST['ascase'])){
	if(updateCheck($_REQUEST['ascase'],$cols)){
		echo $eVal;
	}else echo "u error";
	exit();		
}else if(isset($_REQUEST['case'])){
	if(updateData($_REQUEST['case'],$cols)){
		echo $eVal;
	}else echo "u error";
	exit();		
}
?>