<?php
	if($LEVEL==2){
		if(!isset($nAsgchk)) $nAsgchk = countChecks("ISNULL(user_id) OR as_status='Not Assign'",false);
		if(!isset($ckTosnt)) $ckTosnt = countChecks("as_status='Close' AND as_sent=0 AND as_adcls=1 AND v_int=0",false);
		if(!isset($cksntdd)) $cksntdd = countChecks("as_status='Close' AND as_sent=4",false);
		if(!isset($admrmks)) $admrmks = countChecks("as_status='Close' AND as_adcls=0",false);
		if(!isset($clSentcas)) $clSentcas = countCases("v_status='Close' AND v_sent=4");
		if(!isset($clSentchk)) $clSentchk = countChecks("as_sent=4 AND as_adcls=1");
		$cmCnts = $db->select("company","COUNT(id) cnt");
		$cmCnts = mysql_fetch_array($cmCnts);
		$cmCnts = $cmCnts['cnt'];
		
		$cpCnts = $db->select("projects","COUNT(com_id) cnt");
		$cpCnts = mysql_fetch_array($cpCnts);
		$cpCnts = $cpCnts['cnt'];
	}
			
	if($LEVEL==4){	
		$closecas = countCases("((v_status='Close' AND v_sent=4) OR v_sent=2) AND v_archvi=1");
		$download = countCases("((v_status='Close' AND v_sent=4) OR v_sent=2) AND v_cdnld=1");
		$redyecas = countCases("((v_status='Close' AND v_sent=4) OR v_sent=2) AND v_archvi=0");
		$wipcas   = countCases("v_status<>'Close'");	
				
		$notyets = countChecks("vc.as_vstatus='Not Initiated'");
		
		$nattent = countChecks("vc.as_status='problem'");

		$tbalt="(v_rlevel='negative' OR v_rlevel='match found' OR v_rlevel='record found' OR v_rlevel='unable to verify' OR v_rlevel='discrepancy')";
					
		$balrte = countCases($tbalt);
		
		$closechk = countChecks("(vc.as_status='Close' AND vc.as_sent=4)");
		$redyechk = countChecks("(vc.as_status='Close' AND vc.as_sent=4) AND vc.as_cdnld=0");
		$wipchk = countChecks("vc.as_sent<>4");
		
	}
	
    if($LEVEL==2 || $LEVEL==3){	
		$cntunies = $db->select("uni_info","COUNT(uni_city) cnt");
		$cntunies = mysql_fetch_array($cntunies);
		$cntunies = $cntunies['cnt'];
		$savecass = $db->select("ver_data","COUNT(v_id) cnt","v_status<>'Close'");
		$savecass = mysql_fetch_array($savecass);
		$savecass = $savecass['cnt'];	
		$asWhere = ($LEVEL==2)?"user_id IS NOT NULL":"";
		if(!isset($asgnchk)) $asgnchk = countChecks($asWhere);	
		if(isset($CaseShow)){	
			if(!isset($nAsgcas)) $nAsgcas  = countCases("v_status='Not Assign'",false);
			if(!isset($asgncas)) $asgncas  = countCases("v_status<>'Not Assign'");
			if(!isset($closecas)) $closecas = countCases("v_status='Close'");
			if(!isset($pendgcas)) $pendgcas = ($asgncas-$closecas);
		}
			if(!isset($probchk)) $probchk = countChecks("as_status='problem'");
			if(!isset($notinst)) $notinst = countChecks("as_vstatus='Not Initiated'");
			if(!isset($closechk)) $closechk = countChecks("as_status='close'");
			if(!isset($pendgchk)) $pendgchk = countChecks("as_status<>'close' AND as_vstatus<>'Not Initiated'");
    }
	
?>


