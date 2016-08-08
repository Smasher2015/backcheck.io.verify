<?php
$cWhere='';
if($LEVEL==4){
	if(!$COMINF) $COMINF['id']=0;
	$where = "com_id=$COMINF[id] AND v_sent=4";
	switch($action){
		case 'alert':
			$balrt="v_rlevel='negative' OR v_rlevel='match found' OR v_rlevel='record found' OR v_rlevel='unable to verify' OR v_rlevel='discrepancy'";
			$aWhere="($balrt) AND v_status='close' AND  $where";
		break;
		case 'no':
			$bno="v_rlevel='verified' OR v_rlevel='satisfactory' OR v_rlevel='no match found' OR v_rlevel='no record found' OR v_rlevel='positive match found'";
			$aWhere="($bno) AND v_status='close' AND $where";
		break;
		case 'high':
			$bhig="v_rlevel='negative' OR v_rlevel='match found' OR v_rlevel='record found'";
			$aWhere="($bhig) AND v_status='close' AND $where";
		break;				
		case 'notyet':
			$aWhere="as_vstatus='Not Initiated' AND com_id=$COMINF[id]";
		break;
		case 'order':
			$pSts = "as_vstatus='verified' OR as_vstatus='satisfactory' OR as_vstatus='no match found' OR as_vstatus='no record found' OR as_vstatus='positive match found'";
			$aWhere="$where AND ($pSts)";
		break;		
		case 'attention':
			$aWhere="as_status='problem' AND com_id=$COMINF[id]";
		break;
		case 'book':
			$aWhere="com_id=$COMINF[id] AND v_bmk=1";
		break;		
		case 'close':
		case 'dashboard':
			$SPDF=true;
			$aWhere="as_status='Close' AND as_sent=4 AND v_cdnld=0 AND $where";
		break;
		case 'downloaded':
			$SPDF=true;
			$aWhere="as_status='Close' AND as_sent=4 AND v_cdnld=1 AND $where";
		break;		
		case 'report':
		case 'date':
			if(isset($_POST['sdate']) && isset($_POST['edate'])){
				$sdate=changDate($_POST['sdate']);
				$edate=changDate($_POST['edate'],1);
				$betw=" AND v_date between '$sdate' AND '$edate'";
			}else $betw='';
			$aWhere="com_id=$COMINF[id] $betw";
		break;
		case 'risk':
		if(isset($_POST['sdate']) && isset($_POST['edate'])){
			$sdate=changDate($_POST['sdate']);
			$edate=changDate($_POST['edate'],1);
			$betw=" AND v_date between '$sdate' AND '$edate'";
			}else $betw='';
		$aWhere="com_id=$COMINF[id] $betw";
		break;
		case 'component':
			if(is_numeric($_REQUEST['com_check'])){
				$chk="AND c.checks_id=$_REQUEST[com_check]";	
			}else $chk="";
		$aWhere="$where $chk";
		break;
		default:
			$aWhere="com_id=$COMINF[id] AND v_status<>'close'";
		break;	
	}
	switch($aType){
		case'ready':
		case'completed':
			$where="$aWhere";
		break;		
		case'history':
			$where="($aWhere) AND v_archvi=1";	
		break;
		case'archived':
			$where="($aWhere) AND v_archvi=1";	
		break;

		default:
			$where="$aWhere";
		break;		
	}

	if(isset($_REQUEST['advance_search'])) {
		if(trim($_REQUEST['v_dob'])!=''){		$montharray = array (
					'01' => 'Jan',
					'02' => 'Feb',
					'03' => 'Mar',
					'04' => 'Apr',
					'05' => 'May',
					'06' => 'Jun',
					'07' => 'Jul',
					'08' => 'Aug',
					'09' => 'Sep',
					'10' => 'Oct',
					'11' => 'Nov',
					'12' => 'Dec' );
				$explode = explode(' ',$_REQUEST['v_dob']);
	
				foreach($montharray as $key => $val){
					if(strtolower($explode[1]) == strtolower($val)){
						$explode[1] = $key; 
						break;
					}
				}	
				
			if(strlen($explode[0])==1)
			$explode[0] = '0'.$explode[0];
			$_REQUEST['v_dob'] = $explode[2].'-'.$explode[1].'-'.$explode[0];	
		}
				if(!empty($_REQUEST['v_name']) && !empty($_REQUEST['v_bcode']) && !empty($_REQUEST['v_dob'])){
					$where = " d.v_name like '%$_REQUEST[v_name]%' AND d.v_bcode like '%$_REQUEST[v_bcode]%' AND d.v_dob like '%$_REQUEST[v_dob]%' ";
					
				} elseif(!empty($_REQUEST['v_name']) && !empty($_REQUEST['v_bcode']) && empty($_REQUEST['v_dob'])){
					$where = " d.v_name like '%$_REQUEST[v_name]%' AND d.v_bcode like '%$_REQUEST[v_bcode]%' ";
					
				} elseif(!empty($_REQUEST['v_name']) && !empty($_REQUEST['v_dob']) && empty($_REQUEST['v_bcode'])){
					$where = " d.v_name like '%$_REQUEST[v_name]%' AND d.v_dob like '%$_REQUEST[v_dob]%' ";
					
				} elseif(!empty($_REQUEST['v_bcode']) && !empty($_REQUEST['v_dob']) && empty($_REQUEST['v_name'])){
					$where = " d.v_bcode like '%$_REQUEST[v_bcode]%' AND d.v_dob like '%$_REQUEST[v_dob]%' ";
					
				} elseif(!empty($_REQUEST['v_name']) && empty($_REQUEST['v_bcode']) && empty($_REQUEST['v_dob'])){
					$where = " d.v_name like '%$_REQUEST[v_name]%' ";
					
				} elseif(empty($_REQUEST['v_name']) && !empty($_REQUEST['v_dob']) && empty($_REQUEST['v_bcode'])){
					$where = " d.v_dob like '%$_REQUEST[v_dob]%' ";
					
				} elseif(!empty($_REQUEST['v_bcode']) && empty($_REQUEST['v_dob']) && empty($_REQUEST['v_name'])){
					
					$where = " d.v_bcode like '%$_REQUEST[v_bcode]%' ";
				}
				
				
			}	
											
}

	
?>