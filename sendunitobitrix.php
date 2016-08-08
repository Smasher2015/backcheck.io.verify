<?php include ('/home/backglob/public_html/verify/include/config.php');
	//AND bitrixlid IS NULL	
global $db;
$crawl3=mysql_query("SELECT * FROM contactv WHERE leadid=0 limit 5");
while($crawl_arr3=mysql_fetch_array($crawl3)){
	//print_r($crawl_arr3);
$fullname=$crawl_arr3['fullname'];
$phone=$crawl_arr3['phone'];
$email=$crawl_arr3['email'];
$chatcontent=$crawl_arr3['chatcontent'];
//if($fullname!='' && $email!='' && $chatcontent!='' && $phone!=''){
	$ch = curl_init();
// bitrix admin: 480=Sadia 507=Saima 529=Sharjeel
if($crawl_arr3['bcg']==1){
$bitrix_admin_id = 575; 
$source = "BCG";
}else{
$bitrix_admin_id = 575; $source = "Xcluesiv";
}
 $query_string="action=lead_add&pams[CREATED_BY_ID]=".$bitrix_admin_id."&pams[ASSIGNED_BY_ID]=".$bitrix_admin_id."&pams[TITLE]=".urlencode($fullname)."&pams[NAME]=".urlencode($fullname)."&pams[COMMENTS]=".urlencode($chatcontent)."&pams[EMAIL_WORK]=".$email."&pams[PHONE_WORK]=".$phone."&pams[SOURCE_ID]=".urlencode($source)."";
//  echo BITRIX_URL."?".$query_string."<br />"; die;
	curl_setopt($ch, CURLOPT_URL,BITRIX_URL);
    // Set a referer
   curl_setopt($ch, CURLOPT_HEADER, FALSE);
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Download the given URL, and return output
   $output = curl_exec($ch);
// print_r(curl_close($ch));
//  die;
	$insertedleadid=json_decode($output);
	//var_dump($insertedleadid); die;	
	 $leadid=$insertedleadid->leadinserted_id;
	 
	  
@mysql_query("update contactv set  leadid='".$leadid."' where `id`=".(int)$crawl_arr3['id']."");
}		
		
	// Update Uni on Bitrix
	$crawl=mysql_query("SELECT vc.`bitrixtid`,uni.`uni_Name`,vc.as_id FROM ver_checks vc INNER JOIN uni_info uni ON vc.`as_uni`=uni.`uni_id` WHERE vc.`checks_id`=1 AND vc.`as_isdlt`=0
AND vc.`as_uni`>0 AND vc.`post_uni`=0 AND bitrixtid>0 limit 25");
while($crawl_arr=mysql_fetch_array($crawl)){
		$ch = curl_init();
		//print_r($crawl_arr);
  $query_string="action=updatelocalchecks&bitrixtid=".$crawl_arr['bitrixtid']."&uniname=".$crawl_arr['uni_Name'];
    curl_setopt($ch, CURLOPT_URL,BITRIX_URL);
    // Set a referer
   curl_setopt($ch, CURLOPT_HEADER, FALSE);
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Download the given URL, and return output
    $output = curl_exec($ch);
    // Close the cURL resource, and free system resources
    curl_close($ch);
	@mysql_query("update ver_checks set  post_uni='1' where `as_id`=".(int)$crawl_arr['as_id']."");
}

$crawl2=mysql_query("SELECT * FROM ver_checks WHERE bitrixtid>0 AND post_tag=0 limit 50");
while($crawl_arr2=mysql_fetch_array($crawl2)){
	//print_r($crawl_arr2);die;
	$bitrixtid=$crawl_arr2['bitrixtid'];
	$ch = curl_init();
	if($crawl_arr2['as_qastatus']=='QA' || $crawl_arr2['as_qastatus']=='Rejected'){
		$tag=$crawl_arr2['as_qastatus'];
	}else{
		$tag=$crawl_arr2['as_status'];
	}
	$query_string="action=updatetasktags&task_id=".$bitrixtid."&tags=".$tag;
    curl_setopt($ch, CURLOPT_URL,BITRIX_URL);
    // Set a referer
   curl_setopt($ch, CURLOPT_HEADER, FALSE);
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
    // Download the given URL, and return output
    $output = curl_exec($ch);
    // Close the cURL resource, and free system resources
    curl_close($ch);
	@mysql_query("update ver_checks set  post_tag='1' where `as_id`=".(int)$crawl_arr2['as_id']."");
}

	
?>
