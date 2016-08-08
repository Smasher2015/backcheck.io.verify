<?php 
	// -------------------------- by khl Start ------------------------
	function get_user_info_by_bitrixid($bit_u_id){
		$bit_u_id = (int) $bit_u_id;
				$getInfo = getInfo("users","bitrix_id=$bit_u_id");
				if(!empty($getInfo)){
				return $getInfo;
				}else{
				return false;
				}
			}
	function get_checks_info_by_bitrixid($bitrixtid){
				$bitrixtid = (int) $bitrixtid;
				$bitcheckInfo = getInfo("ver_checks","bitrixtid=$bitrixtid");
				if(!empty($bitcheckInfo)){
				return $bitcheckInfo;
				}else{
				return false;
				}
				
			}
			
	function get_savvion_records_by_bitrixid($bitrixtid){
				$bitrixtid = (int) $bitrixtid;
				$bitcheckInfo = getInfo("dataflow","bitrixtid=$bitrixtid");
				if(!empty($bitcheckInfo)){
				return $bitcheckInfo;
				}else{
				return false;
				}
	}
	// -------------------------- by khl End ------------------------- 
?>