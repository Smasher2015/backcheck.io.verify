<?php
if(isset($_REQUEST['acase'])){
	switch($_REQUEST['acase']){
		case'adcheck':
			if(isset($_REQUEST['aci'])) $ac='in'; else $ac='';
			echo addDCheck($_REQUEST['pkg'],$_REQUEST['chk'],$ac);
		break;
	}
}
?>