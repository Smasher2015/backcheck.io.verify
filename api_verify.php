<?php 
include("include/config.php");
switch($_REQUEST['method']){
	case "getauth":
	get_auth();
	break;
	default:
	echo json_encode(array("Error: "=>"Unknown Method!"));exit;
}
function get_auth(){
	global $db;
	$email=$_REQUEST['email'];
	$pass=$_REQUEST['password'];
	if($email!='' && $pass!=''){
		$salt = $db->select('users','salt', "username='".$email."'");
		$salt = mysql_fetch_array($salt);
//echo $salt['salt']; die();
		$pass = md5(md5($pass).md5($salt['salt'])); 
		$user_info = $db->select("users","*","username='".$email."' and password='".$pass."' and is_active=1 and level_id=4");
		$userinfo=mysql_fetch_array($user_info);
        $token = md5(uniqid(mt_rand(), true));
		$db->insert('user_id,auth_token',"$userInfo[user_id],'".$token."'",'auth_token');
		echo json_encode(array("auth_token: "=>$token));exit;
	}else{
		echo json_encode(array("Error: "=>"Invalid Parameters!"));exit;
	}
}
$token=$_REQUEST['token'];
if($token!=''){
function token_access($token){
	global $db;
	//echo "select * from sites_allowed_dataset where token='".mysql_real_escape_string($token)."'";
	$token_info=$db->selectq("select * from sites_allowed_dataset where token='".mysql_real_escape_string($token)."'");
	if($token_info['is_active']==1){
	return $token_info;}else{return false;}
}
$tokeninfo=token_access($token);
if($tokeninfo){	
	}else{echo json_encode(array("Error: "=>"Invalid Token!"));exit;}
}else{echo json_encode(array("Error: "=>"Token Missing!"));exit;}
?>