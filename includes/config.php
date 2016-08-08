<?php 
	session_start();
	$FPATH =$_SERVER['DOCUMENT_ROOT']."/dashboard/";
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
	include_once($CNPTH."global_config.php");
	require_once($CNPTH."db_class.php");
	include_once($FPATH."functions/functions.php");
	
	require_once($CNPTH.'paginator.class.php');
	$db = new DB();
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
	
	function checkParms(){
			$db = new DB();
			if(trim($_REQUEST['user'])!="" && $_REQUEST['emp'] && $_REQUEST['repor']){
				$uInfo = $db->select("users","*","username='$_REQUEST[user]'");
				if(mysql_num_rows($uInfo)==1){
					$uInfo = mysql_fetch_array($uInfo);
					$case = $db->select("ver_data","*","emp_id=$_REQUEST[emp] AND v_id=$_REQUEST[repor] AND com_id=$uInfo[com_id]");
					if(mysql_num_rows($case)==1) return $uInfo['user_id'];
				}
			}
			return false;
	}
	
	if(($action=='download')){
			$PTITLE= "Download Your Report";
			$tuser = checkParms();
			if($tuser){
				if(isset($_SESSION['user_id'])){
					if($_SESSION['user_id']==$tuser){
						
					}else{
						include('include_pages/noacces_inc.php');
					}
				}else{
					include('include_pages/dowreport_inc.php');
				}
			}else{
				include('include_pages/noacces_inc.php');
			}
			exit();
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
	
	if(isset($_REQUEST['invitation'])){
		logout();
		$PTITLE= "Register";$action = 'invitation';
		include('include_pages/account_inc.php');
		exit();
	}	

		
	if(!check_login()){
		if(($PAGE!='case_report.php') && ($PAGE!='_validate_user_.php')){	
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
		$USERID = $_SESSION['user_id'];
		if($LEVEL==4){
			if($USER['is_subuser']==1){
				$SUSER = true;
				$RIGHTS = explode('|',$USER['no_rights']);
			}
			$COMINF = companyInfo($_SESSION['user_id']);	
		}		
	}
	
	if(isset($_POST['ascase'])) $_REQUEST['ascase']	= $_POST['ascase'];	
	if(isset($_POST['case'])) $_REQUEST['case']     = $_POST['case'];
	if(isset($_REQUEST['ascase'])){
		if(is_numeric($_REQUEST['ascase'])){
			$dCheck = getCheck(0,0,$_REQUEST['ascase']);
			if($dCheck){
				$_REQUEST['case'] = $dCheck['v_id'];
				$_REQUEST['check'] = $dCheck['checks_id'];
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
	
	if(!isset($_SESSION['BR'])) $_SESSION['BR'] = browserInf();
	include_once($FPATH."functions/detect.php");
?>