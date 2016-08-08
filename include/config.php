<?php 
	session_start();
	date_default_timezone_set("Asia/Karachi");
	
	// added by khl
	
	$HTTP_USER_AGENT = strtolower($_SERVER['HTTP_USER_AGENT']);
	
	if (preg_match('/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/', $HTTP_USER_AGENT, $matches))
        {
            $browser_version = intval($matches[1]);
        } else
        {
            $browser_version = 'unknown';
        }
	if (preg_match('/msie/', $HTTP_USER_AGENT))
        {
            $browser_name = 'msie';
        }
	$FPATH =$_SERVER['DOCUMENT_ROOT']."/verify/";
	$PAGE=basename($_SERVER['SCRIPT_FILENAME']);
	$action = isset($_REQUEST['action'])?$_REQUEST['action']:'';
	$aType=isset($_REQUEST['atype'])?$_REQUEST['atype']:'';
	$ACTION = isset($_REQUEST['action'])?$_REQUEST['action']:'';
	$ATYPE  =isset($_REQUEST['atype'])?$_REQUEST['atype']:'';
	foreach($_POST as $pKey=>$parm){
		$_REQUEST[$pKey] = str_replace("'","`",$_POST[$pKey]);
		$_POST[$pKey]    = str_replace("'","`",$_POST[$pKey]);
	}
	$CNPTH = $FPATH."include/";
	include_once("/home/backglob/public_html/verify/include/global_config.php");
	require_once("/home/backglob/public_html/verify/include/db_class.php");
	include_once("/home/backglob/public_html/verify/functions/functions.php");
	require_once("/home/backglob/public_html/verify/functions/class.phpmailer.php");
	$_REQUEST['certificate']='1';
	require_once('/home/backglob/public_html/verify/include/paginator.class.php');
	$db = new DB();
	$db->open();
	mysql_query('SET @@session.time_zone = "+00:00"');
	if($action=='logout'){
		logout();
		header("location:".SURL."?action=login");
		exit();
	}

	if(isset($_REQUEST['subremail'])){
		resetPass();	
	}
   
	if(isset($_POST['subchgps'])){
		changePass();	
	}
	
	if(isset($_POST['subdologin'])){
		$isLogin = doLogin();
		if($isLogin!==true){
			$erMsg = $isLogin; 
		}
	}
		if(($action=='api_savion')){
			 $barcode=$_REQUEST['barcode'];
			 $tabl="savvion_check";
			 $cols="count(id) as 'exist'";
			 $where="`SubBarcode`='".$barcode."'";
			$count = $db->select($tabl,$cols,"$where");
			$row=mysql_fetch_array($count);
			if($row['exist']>0){echo "true";}else{echo "false";}
			exit;
		}
		if(isset($_REQUEST['submit_uniinfo'])){
		if($_SESSION['user_id']==83 || $_SESSION['user_id']==50){
			msg('err',"You Dont have Permission to add University!");
		}else{
			addUnie();
		}		
			
	}
	if(($action=='download')){
			$PTITLE= "Download Your Report";
			$tuser = checkParms();
			if($tuser){
				if(isset($_SESSION['user_id'])){
					if($_SESSION['user_id']==$tuser){
						$_REQUEST['pg']='case';
						if(isset($_REQUEST['check'])){
							$_REQUEST['ascase']=$_REQUEST['check'];
						}else{
							$_REQUEST['case']=$_REQUEST['report'];
						}
						$_config = true;
						include('pdf.php');
						exit();
					}else{
						logout();
					}
				}
				include('include_pages/dowreport_inc.php');
			}else{
				include('include_pages/noacces_inc.php');
			}
			exit();
	}
	
	if(isset($_POST['uploadUFile'])){
		echo fileUpload($_POST['key'],'',$_POST['path'],$_POST['name'],false);
	}
	
	if(($action=='login')){
		if(isset($_SESSION['user_id'])){
			header("location:".SURL."?action=dashboard");	
			exit();
		}else{
			$PTITLE= "Login";
			include('include_pages/login_inc.php');
			exit();	
		}
	}
	
	if($action=='contactus'){
		if(isset($_POST['subcontactus'])){
			 subcontactus();
		}		
		$PTITLE= "Contact Us";
		include('include_pages/account_inc.php');
		exit();
	}
	
	if($action=='userinfo'){
			
		$PTITLE= "Upload Documents";
		include('include_pages/woocom_applicant_inc.php');
		exit();
	}
	
	
	
	if(isset($_REQUEST['invitation'])){
		logout();
		$PTITLE= "Register";$action = 'invitation';
		include('include_pages/account_inc.php');
		exit();
	}	

		
	if(!check_login()){
		
		
		
		if(isset($_GET['hash'])){
	
		$selUID = $db->select("check_date","user_id","cd_hash='$_GET[hash]'");
		if(mysql_num_rows($selUID)>0){
			$rsU = mysql_fetch_assoc($selUID);
			
			$userInf = getUserInfo($rsU['user_id']);
			$_POST['username']= $userInf['email'];
			$_POST['pwd']= $userInf['password'];
			
			if(doLogin()){

				header("location:".SURL."?action=dashboard");

				exit();

			}
			
		}else{
			
		logout();
		header("location:".SURL."?action=login");
		exit();
		}
		
		
	}
		
		
		
		
		
			
		if( ($PAGE!='qc_reject_quantization.php') && ($PAGE!='daily_report_catwise.php') && ($PAGE!='add_savvion_check_bitrix.php') && ($PAGE!='daily_digest_insuff.php') && ($PAGE!='qc_report.php') && ($PAGE!='preemp_verification_inc.php') && ($PAGE!='update_vbcode.php') && ($PAGE!='daily_analyst_report.php') &&  ($PAGE!='not-cosed-checks-all.php')  &&  ($PAGE!='sendunitobitrix.php') && ($PAGE!='monthly_invoice_cron.php') && ($PAGE!='auto_addtasks_to_bitrix2.php') && ($PAGE!='bit_closed_checks.php') && ($PAGE!='bit_sent_to_client.php') && ($PAGE!='bt_edit_savvion_check.php') && ($PAGE!='automate_dd.php') && ($PAGE!='dds_notcreated.php') && ($PAGE!='resp_bitrix.php') && ($PAGE!='bitrix_sav_check.php') && ($PAGE!='autmate_script.php') && ($PAGE!='bt_edit_check.php') && ($PAGE!='not-cosed-checks.php') && ($PAGE!='cron_logs.php') && ($PAGE!='client_status.php') && ($PAGE!='weekly_update.php') && ($PAGE!='weekly_update_client_wise_users_in_cc.php') && ($PAGE!='case_report_new.php') && ($PAGE!='case_report.php') && ($PAGE!='_validate_user_.php') && $PAGE!='certificate_ed.php' && $PAGE!='certificate.php' && $PAGE!='certificate_search.php' && $PAGE!='system_support_notification.php'  && $PAGE!='test.php' && $PAGE!='bitrix_sav_check.php' && $PAGE!='send-saved-search-client.php' && $PAGE!='followups_check.php' && $PAGE!='qoutation_letter.php' && $PAGE!='apisignup.php' && $PAGE!='pre_emp_send_and_repsone_cron.php'){	
			if(isset($AJAX)) echo 'noAccess'; else {
				$action = 'login';
				$PTITLE= "Login";
				include('include_pages/login_inc.php');
			}
			exit();
		}
	}else{
		$USER = getUserInfo($_SESSION['user_id']);
		$UNAME = ucwords(trim($USER['first_name'].' '.$USER['last_name']));
		$LEVEL = $USER['level_id'];
		if($LEVEL==12){
		$LEVEL=3;	
		$LEVEL_TL=12;
		}
		$USERID = $_SESSION['user_id'];
		if($LEVEL==4 || $LEVEL==5){
			
			if($USER['is_subuser']==1){
				$SUSER = true;
				$RIGHTS = explode('|',$USER['no_rights']);
			}
			$COMINF = companyInfo($_SESSION['user_id']);	
		}		
	}
	
	
	if(isset($_POST['adddemanddraft'])){
		adddemanddraft();
	}	
	
	if(isset($_POST['ascase'])) $_REQUEST['ascase']	= $_POST['ascase'];	
	if(isset($_POST['case'])) $_REQUEST['case']     = $_POST['case'];
	
	// for bitrix integration in iframe
	if(isset($_REQUEST['bitiframe']) && is_numeric($_REQUEST['bitiframe']) ){
		$bitrixtid = (int) $_REQUEST['bitrixtid'];
		$bit_u_id = (int) $_REQUEST['bit_u_id'];
		$issavvion = (int) $_REQUEST['issavvion'];
		$act = $_REQUEST['act'];
		$userInfo 		= get_user_info_by_bitrixid($bit_u_id);
		
	
		if($issavvion==1){
		$bitcheckInfosavion 	= get_savvion_records_by_bitrixid($bitrixtid);	
		}else if($act!=""){
			switch($act){
				case 'bit_sent_to_client':
				$LEVEL = 2; // Level Manager = 2  User_id = 18 (Saima)
				$user_id = (!empty($userInfo['user_id']))?$userInfo['user_id']:18;
				$_SESSION['user_id'] = 18;
				$_SESSION['username'] = 'saima@riskdiscovered.com';
				$_SESSION['actual_user_id'] =  $user_id;
				break;
			}
			
		}else{
		$bitcheckInfo 	= get_checks_info_by_bitrixid($bitrixtid);
		}
		
		
		
	if(!empty($bitcheckInfosavion)){
	$_REQUEST['check'] = (int) $bitcheckInfosavion['primid'];	
	$_REQUEST['subbarcode'] =  $bitcheckInfosavion['subbarcode'];	
	$LEVEL = 2; // Level Manager = 2  User_id = 18 (Saima)
	$user_id = (!empty($userInfo['user_id']))?$userInfo['user_id']:18;
	$_SESSION['user_id'] = 18;
	$_SESSION['username'] = 'saima@riskdiscovered.com';
	$_SESSION['actual_user_id'] =  'abc';
		
	}
	
	if(!empty($bitcheckInfo)){
	$_REQUEST['ascase'] = (int) $bitcheckInfo['as_id'];	
	$LEVEL = 2; // Level Manager = 2  User_id = 18 (Saima)
	$user_id = (!empty($userInfo['user_id']))?$userInfo['user_id']:18;
	$_SESSION['user_id'] = 18;
	$_SESSION['username'] = 'saima@riskdiscovered.com';
	$_SESSION['actual_user_id'] =  'abc';
	
	}
	
	}else{
	//echo "actual_user_id".$_SESSION['actual_user_id'];
/*	if(isset($_SESSION['actual_user_id'])){
	logout();
	$_SESSION['actual_user_id']="";
	@header("location:".SURL."?action=login");
	exit();
	}*/
	}
	
	
	
	
	if(isset($_REQUEST['ascase'])){
		
		if(is_numeric($_REQUEST['ascase'])){
			
			$dCheck = getCheck(0,0,$_REQUEST['ascase']);
			
			if($dCheck){
				
				$_REQUEST['case'] = $dCheck['v_id'];
				$_REQUEST['check'] = $dCheck['checks_id'];
				$_REQUEST['ascase'] = $_REQUEST['ascase'];
				
				}else{
				unset($_REQUEST);
				unset($_POST);
				$action="noAccess";	
				$ACTION="noAccess";		
			}
		}else{
			$action="noAccess";
			$ACTION="noAccess";	
		}
	}
	
	function getCompnent($packge){
			$db = new DB;
			$where = "cmp_active=1 AND cmp_id=$packge";
			$compnent = $db->select("compnents","*",$where);
			return mysql_fetch_array($compnent);	
	}
	
	function getPrice($compnt,$pakg,$checks){
			$db = new DB;
			$where = "prc_active=1 AND pkg_id=$pakg AND cmp_id=$compnt AND ((prc_max>=$checks AND prc_min<=$checks) OR (prc_max=0 AND prc_min<$checks))";
			$pricing = $db->select("pkg_pricing","*",$where);
			
			return mysql_fetch_array($pricing);	
	}
	
	if($action=="showRates"){
		if(is_numeric($_POST['client']) && is_numeric($_POST['compnt']) && is_numeric($_POST['packge']) && trim($_POST['monyer'])!=''){
                            $tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id";
                            $wher = "c.as_isdlt=0 AND d.v_isdlt=0 AND com_id=$_POST[client] AND c.as_date LIKE '$_POST[monyer]%'";
                            $checks = $db->select($tbls,"COUNT(c.as_date) as `cnt`",$wher);
                            $checks =  mysql_fetch_array($checks);
                            $checks = $checks['cnt'];
												
							$cmp_price = 0;
							if($_POST['packge']!=1){
                           		$compnent = getCompnent($_POST['compnt']);
								$price = getPrice($_POST['compnt'],1,$checks);
								if($price['prc_disc']!=0){
									  $cmp_price = ($compnent['cmp_price'] - (($compnent['cmp_price']*$price['prc_disc'])/100));
								}else $cmp_price = $compnent['cmp_price'];
							}
	
							$compnent = getCompnent($_POST['compnt']);
							if($cmp_price!= 0)  $compnent['cmp_price'] = $cmp_price;
							$price = getPrice($_POST['compnt'],$_POST['packge'],$checks);
							
							if($price['prc_disc']!=0){
								  $num = ($compnent['cmp_price'] - (($compnent['cmp_price']*$price['prc_disc'])/100));
							}else $num = $compnent['cmp_price'];
							$tnums = number_format($num);
							echo "<fieldset class=\"label_side\">
                                		<label>&nbsp;</label>
                                		<div>
											<input type=\"hidden\" name=\"checks\" value=\"$checks\" >
											<input type=\"hidden\" name=\"nums\" value=\"$num\" >
                                    		<h2>Total number of checks $checks = $tnums</h2>	
                                		</div>
                            	   </fieldset>";
								
		}
		exit();
	}

	if(isset($_REQUEST['case'])){
		if(!case_access($LEVEL)){
				unset($_REQUEST);
				unset($_POST);
				$action="noAccess";
				$ACTION="noAccess";	
		} 
	}

	if(isset($_REQUEST['addCompany'])){
		if($_SESSION['user_id']==83){
			msg('err',"You Dont have Permission to add Company!");
		}else{
			add_Company();
		}
	}
	
	if(isset($_REQUEST['addvendor'])){
		addvendor();
	}
	
	if(isset($_POST['vdid']) && isset($_POST['delete'])){
		vendorDelete();
	}
	
	if(isset($_POST['ddid']) && isset($_POST['delete'])){
		ddDelete();
	}
	
	if(isset($_POST['ddid']) && isset($_POST['ddChange'])){
		ddChange();
	}
	
	
	if($action=='get_orderchecks'){
		get_orderchecks();
		exit();
	}	

	if(isset($_REQUEST['drequestDD'])){
		requestddraft();
	}
	
	if(isset($_REQUEST['dskipDD'])){
		dskipDD();
	}
	if(isset($_REQUEST['addanalysttolead'])){
		addAnalystToTeam();
	}
	
	
	if($action=='get_orderid'){
		echo get_case_id();
		exit();
	}
	if(isset($_REQUEST['addsavvioncheck'])){			
			addsavvioncheck();	
	}
	if(isset($_REQUEST['sentaddsavvioncheck'])){			
			addsavvioncheck();	
	}
	if(isset($_REQUEST['approvesavvion'])){	
			approvesavvioncheck();	
	}
	if(isset($_REQUEST['insufficientCheck'])){	
			insufficientCheck();	
	}
	if(isset($_REQUEST['deleteImage'])){	
			deleteImage();	
	}
	if(isset($_REQUEST['postedSavvion'])){	
			postedSavvion();	
	}
	if(isset($_REQUEST['rejectsavvion'])){	
			rejectsavvion();	
	}
	if(isset($_REQUEST['delegateSavvionChecks'])){	
			delegateSavvionChecks();	
	}
	/*if(isset($_POST['addticket'])){
		addticket();
	}*/
	
	// by khl 
	
	
	
	
	
	if(!isset($_SESSION['BR'])) $_SESSION['BR'] = browserInf();
	include_once($FPATH."functions/detect.php");
	
	
	
	
?>
