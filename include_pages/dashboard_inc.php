<?php

	switch($LEVEL){
		case 1:
		case 2:
		case 3:
			include("include_pages/dashboard_op_inc.php");
		break;
		case 4:
			include("include_pages/dashboard_new.php");
			
		break;
		case 5:
			include("include_pages/dashboard_applicant.php");
		break;		
		case 6:
			include("include_pages/dashboard_finance.php");
		break;
		case 9:
			$IPAGE['m_where'] = "AND dd_status=0";
			$IPAGE['m_actitle'] = 'Draftted';
			include("include_pages/demanddraftlist.php");
			
			
			$IPAGE['m_where'] = "AND dd_status=2";
			$IPAGE['m_actitle'] = 'Paid';
			include("include_pages/demanddraftlist.php");
		break;						
	}
?>