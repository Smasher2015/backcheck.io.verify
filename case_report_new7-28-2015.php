<?php 
include('include/config.php');

if(is_numeric($_REQUEST['id']) && is_numeric($_REQUEST['plogid'])){
	$case = 	$_REQUEST['plogid'];
	$ascase = $_REQUEST['id'];
	$access=true;
}else if($_REQUEST['id']=="" && is_numeric($_REQUEST['plogid'])){
	$case = 	$_REQUEST['plogid'];
	$ascase = "";
	$access=true;
}else $access=false;

if($access){
	$db = new DB();
	$varData = $db->select("ver_data","*","v_id=$case");
	if($ascase!=0){
		$asWhere = "v_id=$case AND as_id=$ascase AND as_status='Close'";
	}else{
		$asWhere = "v_id=$case AND as_status='Close' AND as_isdlt=0";
	}
	$asDatas = $db->select("ver_checks","*",$asWhere);
	if((mysql_num_rows($varData)>0) && (mysql_num_rows($asDatas)>0)){
		$varData = mysql_fetch_array($varData);
		$_REQUEST['show_a']=1;
		$rp_cic = $_REQUEST['rp_cic'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>View Report</title>
	<link rel="stylesheet" type="text/css" href="css/reportcss_new.css">
    <link rel="stylesheet" type="text/css" href="css/cic_check_css.css">
</head>

<body>
	<?php if(!isset($_REQUEST['newa'])) include("include_pages/case_report_inc_a.php"); ?>
	<?php if(!isset($_REQUEST['newb'])) include("include_pages/case_report_inc_new.php"); ?>
</body>
</html>

<?php }
}else{ ?>
	<div class="norc">
		<h1 style="margin-top:10%" align="center">No Record Found</h1>
	</div>		
<?php } ?>