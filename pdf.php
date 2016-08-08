<?php 
session_start();
	if(!isset($_config)) include('include/config.php');
	if(isset($SUSER)){
		if(!in_array(3,$RIGHTS)){
			echo "'<script type=\"text/javascript\">window.top.alertBox('You Have No Access, Please Contact to Main User!')</script>";
			exit();		
		}
	}
	
	switch($_REQUEST['pg']){
		case'case':
			if(is_numeric($_REQUEST['ascase'])){
				$asData = getCheck(0,0,$_REQUEST['ascase']);
				$id   = $_REQUEST['ascase'];
				$TPRM="&ascase=$id";
			}else if(is_numeric($_REQUEST['case'])){
				$id = 0;
				$asData['v_id'] = $_REQUEST['case'];
				$TPRM="&case=$_REQUEST[case]";
			}else{ 
				echo "'<script type=\"text/javascript\">window.top.alertBox('You Have No Access!')</script>";	
				exit();
			}
			$data = getVerdata($asData['v_id']);
			$pid  = $asData['v_id']; 
			$name = $data['v_name'];
			$ePara="&width=1";
			
			$page="case_report_new.php";
		break;
		case'search':
			if(!is_numeric($_REQUEST['id'])){
				echo "'<script type=\"text/javascript\">window.top.alertBox('You Have No Access!')</script>";	
				 exit();
			}
			$data = geCrmlInfo($_REQUEST['id']);
			$id   = $_REQUEST['id'];
			$pid  = $_SESSION['user_id'];
			$name = $data['FullName'];
			$ePara ="";		
			$page="search_pdf.php";
		break;	
		case 'certificate':
		case 'certificate_ed':
			if(!is_numeric($_REQUEST['id'])){
				echo "'<script type=\"text/javascript\">window.top.alertBox('You Have No Access!')</script>";	
				 exit();
			}
			$id   = $_REQUEST['id'];
			$pid  = $_SESSION['user_id'];
			$name = $_REQUEST['name'];
			$ePara ="&orientation=1";		
			$page=$_REQUEST['pg'].".php";
		break;	
		default;
			echo "'<script type=\"text/javascript\">window.top.alertBox('You Have No Access!')</script>";	
			exit();
	}

	$name = preg_replace('/[^a-zA-Z0-9\-_]/', '_',$name);
	$param = "id=$id&plogid=$pid&name=$name&ftr=mis$ePara&showhf=1&rp_cic=".$_REQUEST['rp_cic'];
	

	//$url  = "http://184.107.222.178/getPDF/?url=".SURL."$page?$param";
	$url  = "http://198.23.193.178/getPDF/?url=http://backcheck.io/verify/$page?$param";
	 //$url  = "http://pdf.xcluesiv.com/getPDF/?url=".SURL."$page?$param";
	 
	//echo $url;die;
	$path = "pdf_files/$name.pdf";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	file_put_contents($path, $data);

	if($LEVEL==2 || $LEVEL==4){	
		if(isset($_REQUEST['ascase'])){
			if($LEVEL==2) $where="as_mdnld=1"; else $where="as_cdnld=1";
			updateCheck($_REQUEST['ascase'],$where,'Report Downloaded');
		}else if(isset($_REQUEST['case'])){
			if($LEVEL==2) $where="v_mdnld=1"; else $where="v_cdnld=1";
			updateData($_REQUEST['case'],$where,'Report Downloaded');
		}
	}
		
	echo '<meta http-equiv="refresh" content="0;url=download.php?path='.$name.'.pdf'.$TPRM.'" >';
	exit();
?>

