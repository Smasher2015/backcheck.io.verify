<?php
if($action=='') $action='assign';
$cWhere='';

if($LEVEL==2){	
	switch($action){
		case'assign':
			$where="(ISNULL(user_id) OR as_status='Not Assign')";
		break;
		case'notin':
			$where="(as_vstatus='Not Initiated' AND as_status='open')";
		break;		
		case'wip':
			$where="(as_status<>'Close' AND as_vstatus<>'Not Initiated' AND user_id IS NOT NULL)";
		break;		
		case'assigned':
			$where="user_id IS NOT NULL";
		break;
		default:
			$where="as_status='$action'";
			if($action=='close'){
				switch($aType){
					case'send':
						$tWH="AND as_sent=4 AND as_adcls=1";
					break;
					case'ready':
						$tWH=" AND as_sent=0 AND as_adcls=1";
					break;
					case'remark':
						$tWH=" AND as_adcls=0";
					break;										
				}
				$where="$where $tWH";
			}
		break;		
	}
}

if($LEVEL==3){
	$where = "user_id=$_SESSION[user_id]";
	switch($action){
		case'wip':
			$where="as_status<>'Close' AND as_vstatus<>'Not Initiated' AND $where";
		break;
		case'notin':
			$where="as_vstatus='Not Initiated' AND $where";
		break;				
		case'assigned':
			$where="$where";
		break;
		default:
			$where="as_status='$action' AND $where";
		break;		
	}
}

if($LEVEL==4){
	if(!$COMINF) $COMINF['id']=0;
	$where = "com_id=$COMINF[id] AND (v_sent=4 OR v_sent=2)";
	switch($action){
		case 'alert':
			$balrt="v_rlevel='negative' OR v_rlevel='match found' OR v_rlevel='record found' OR v_rlevel='unable to verify' OR v_rlevel='discrepancy'";
			$balrt="(($balrt) AND (as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found' OR as_vstatus='unable to verify' OR as_vstatus='discrepancy'))";
			$aWhere="$balrt AND as_sent=4 AND $where";
		break;
		case 'notyet':
			$aWhere="as_vstatus='Not Initiated' AND com_id=$COMINF[id]";
		break;
		case 'attention':
			$aWhere="as_status='problem' AND com_id=$COMINF[id]";
		break;
		case 'close':
			$aWhere="as_status='Close' AND as_sent=4 AND $where";
		break;
		default:
			$aWhere="com_id=$COMINF[id] AND v_status<>'close'";
		break;	
	}
	switch($aType){
		case'ready':
			$where="($aWhere) AND v_cdnld=0";
		break;		
		case'history':
		case'archived':
			$where="($aWhere) AND v_cdnld=1";	
		break;
		default:
			$where="$aWhere";
		break;		
	}	
}


	
?>