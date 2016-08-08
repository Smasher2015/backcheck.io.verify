<?php


function closeCheckStatus($asCase,$CaseStatus){

	$db = new DB();
	$uID = (int) $_SESSION['user_id'];
	if($CaseStatus == 'Close'){
		$isInsUpd = $db->update("as_status='$CaseStatus',as_qastatus='Approved'","ver_checks","as_id=$asCase");
		$db->insert("as_id,user_id,qa_status","$asCase,$uID,'Approved'",'qa_logs');
	}
	if($isInsUpd){
	sentToClient($asCase);
	addRemarks($asCase,$CaseStatus);
	}
	return $isInsUpd;

}
function sentToClient($as_id){
$db = new DB();
	$sVal=4;

			$isUpdate = $db->update("as_sent=$sVal,as_stdate=CURRENT_TIMESTAMP","ver_checks","as_id=$as_id AND as_status='Close'");

			if($isUpdate){

					if($sVal==4){

						$vCheck = getCheck(0,0,$as_id);

						$tCheck = getCheck($vCheck['checks_id'],0,0);

						$vData  = getVerdata($vCheck['v_id']);

						$comInfo = getcompany($vData['com_id']);
						
						

						$comInfo = mysql_fetch_array($comInfo);

						if($comInfo['sentmail']==1){

							$vData['logo']=$comInfo['logo'];

							$vData['checks_title']=$tCheck['checks_title'];

							$vData['as_id']=$as_id;

							$clUsers = getClUser($vData['com_id']);

								if($clUsers){

								while($clUser = mysql_fetch_assoc($clUsers)){
									$fullName = $clUser['first_name'].' '.$clUser['last_name'];
									$check_added_by = $vCheck['as_uadd'];
									$user_info = getUserInfo($check_added_by);
									$loc_id = $user_info['loc_id'];
									if($loc_id==0){
											// to all users
									sentCheckEmail($vData,false,$clUser['username'],$clUser['email'],$fullName);
									
									}else{
										if($loc_id==$clUser['loc_id'] && $clUser['puser_id']!=0 && $clUser['is_subuser']!=0){
											// to sub user
									sentCheckEmail($vData,false,$clUser['username'],$clUser['email'],$fullName);
																		
										}else if($clUser['puser_id']==0 && $clUser['is_subuser']==0){
											// to parent user
									sentCheckEmail($vData,false,$clUser['username'],$clUser['email'],$fullName);
									
										}
									}
								
										

								} // end while

							}

						}

					}				 

			}else{

				msg('err',"Check Sending Error!");

			}

		

}
function addRemarks($as_id,$as_status='',$remarks=''){
	$db = new DB();
	global $LEVEL;
	$vCheck = getCheck(0,0,$as_id);
		
			if($as_status!=''){
				$uCols="as_adcls=1,as_remarks='$remarks',as_cldate=CURRENT_TIMESTAMP";
				if(updateCheck($as_id,$uCols)){
					addActivity('ascase','',$LEVEL,'',$vCheck[v_id],$as_id,'remark');
				}
				
				$tCnt = countChecks("vc.v_id=$vCheck[v_id] AND vc.as_isdlt=0");
				$cCnt = countChecks("vc.v_id=$vCheck[v_id] AND vc.as_adcls=1 AND vc.as_status='Close'  AND vc.as_isdlt=0");
				if($tCnt==$cCnt) { 
				$v_rlevel = get_v_rlevel_FromVID($vCheck['v_id']);
				$uCols="v_rlevel='$v_rlevel', v_status='Close', v_cldate=CURRENT_TIMESTAMP";
				$tWh="$uCols , v_int=0"; 
				//echo $tWh; // v_rlevel='Negative',v_status='Close,v_cldate=CURRENT_TIMESTAMP , v_int=0

				} else { 
				$tWh="v_int=0"; 
				}
				if(updateData($vCheck['v_id'],$tWh)){
					if($tCnt==$cCnt) addActivity('case','',$LEVEL,'',$vCheck[v_id],$as_id,'close');
				}
			}			
		
	
}


?>