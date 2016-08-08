<?php
	define("HOST",'localhost');	
	define("DB",'backglob_db');
	define("USER",'backglob_db');
	define("PASS",'4KrqZ--rPZ2Q');
	define("BITRIX_URL",'https://my.backcheck.io/rest_api.php');
		$ch = curl_init();
 $query_string="action=updatetaskmark";
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
	function insertleads2($comp_arr){
$ch = curl_init();
 $query_string="action=lead_add&pams[CREATED_BY_ID]=520&pams[ASSIGNED_BY_ID]=520&pams[TITLE]=".urlencode($comp_arr['name'])."&pams[NAME]=".urlencode($comp_arr['name'])."&pams[COMMENTS]=".urlencode($comp_arr['comment'])."&pams[EMAIL_WORK]=".$comp_arr['email']."&pams[PHONE_WORK]=".$comp_arr['phone']."&pams[SOURCE_ID]=".urlencode("Verification System")."&pams[Erp Id]=".$comp_arr['erpid']."";
    curl_setopt($ch, CURLOPT_URL,BITRIX_URL);
    // Set a referer
   curl_setopt($ch, CURLOPT_HEADER, FALSE);
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Download the given URL, and return output
    $output = curl_exec($ch);
	$insertedleadid=json_decode($output);
	$leadid=$insertedleadid->leadinserted_id;
    // Close the cURL resource, and free system resources
    curl_close($ch);
	return $leadid;
}
function getdatedifference($startdate, $days,$com_id=0)
	{
		global $db;
		$skipDates1 = array();
		$skipDates2 = array();
		$skipDates3 = array();
		
		
		if($com_id!=0){
			//$selNonPaymentDays = $db->select("non_payment_clients_dates","*"," com_id=$com_id");
			$selNonPaymentDays=mysql_query("select * from non_payment_clients_dates where  com_id=$com_id");
			while($rsNPD =	mysql_fetch_array($selNonPaymentDays)){
				$disable_date = ($rsNPD['disable_date']!="")?$rsNPD['disable_date']:date("Y-m-d");
				$enable_date = ($rsNPD['enable_date']!="")?$rsNPD['enable_date']:date("Y-m-d");
				$now = strtotime($disable_date); // or your date as well
				$your_date = strtotime($enable_date);
				$datediff =  $your_date - $now;
				$datediff =  floor($datediff/(60*60*24));
				//var_dump($now , $your_date,  $datediff);
				if($datediff>0){
					for($x=0; $x<=$datediff; $x++){
					$dd = 	date("Y-m-d", strtotime($disable_date . "+$x day"));	
					$skipDates3[] = $dd;
					
					}
				}
				$skipDates1[] = $disable_date;	
			}
			
		}
		
		$selholydays=mysql_query("select * from holiday_master");
		//$selholydays = $db->select("holiday_master","*","");
			while($holydays =	mysql_fetch_array($selholydays)){
				$hol_sdate = $holydays['hol_sdate'];
				$hol_edate = $holydays['hol_edate'];
				$now = strtotime($hol_sdate); // or your date as well
				$your_date = strtotime($hol_edate);
				$datediff =  $your_date-$now;
				$datediff =  floor($datediff/(60*60*24));
				//var_dump($now , $your_date,  $datediff);
				if($datediff>0){
					for($x=0; $x<=$datediff; $x++){
					$dd = 	date("Y-m-d", strtotime($hol_sdate . "+$x day"));
					$skipDates2[] = $dd;
					}
				}
				$skipDates1[] = $hol_sdate;
			}
		
		
		$d = new DateTime($startdate);
		$t = $d->getTimestamp();
		$j=0;
		// loop for X days
		for($i=0; $i<$days; $i++)
		{
			// add 1 day to timestamp
			$addDay = 86400;
			// get what day it is next day
			if($j==0){
				$nextDate= date('Y-m-d', ($t));
				$nextDay = date('w', ($t));
			}else{
				$nextDate= date('Y-m-d', ($t));
				$nextDay = date('w', ($t));
			}
			//echo $nextDate;
			// if it's Saturday or Sunday get $i-1
			
			if($nextDay == 0 || $nextDay == 6 || in_array($nextDate,$skipDates1) || in_array($nextDate,$skipDates2) || in_array($nextDate,$skipDates3))
			{
				//echo $nextDay."<br>";
				$i--;
			}else{ 
				//echo  $j.$nextDate; echo "<br>";
			} 
				// modify timestamp, add 1 day
			$t = $t+$addDay;
			$j++;
		} // for ends
		$t--;
		
		
		$nextDay = date('w', ($t));
		if($nextDay == 0 ){
			$t=$t+$addDay; 
			$d->setTimestamp($t);		  
		}
		if($nextDay == 6 ){
			$t=$t+$addDay;   
			$d->setTimestamp($t);
		}
		
		
		$d->setTimestamp($t);
		
		return $d->format( 'd-M-Y' );
	}
function add_task($task_arr,$parent_id=0){
 $ch = curl_init();
 $enddateplan=getdatedifference(date("Y-m-d"),8);
 $deadline=getdatedifference(date("Y-m-d"),10);
 $remainderdate=getdatedifference(date("Y-m-d"),2);
 switch($task_arr['crawltype']){
	 case "1":
	 $tag="New";
	 break;
	  case "2":
	 $tag="Work In Progress";
	 break;
	  case "3":
	 $tag="QC Reject";
	 break;
	  case "4":
	 $tag="Insufficiency QC Reject";
	 break;
	  case "5":
	 $tag="Insufficiency Notification Reject";
	 break;
	  case "6":
	 $tag="CRM Reject";
	 break;
	  case "7":
	 $tag="CRM Complete";
	 break;
 }
 
 $query_string="action=task_add&CREATED_BY=1&task_name=".$task_arr['task_name']."&desc=".$task_arr['task_desc']."&time_estimate=2&PARENT_ID=$parent_id&user_id=".$task_arr['user_id']."&tags=".$tag."&primid=".$task_arr['primid']."&subbarcode=".$task_arr['subbarcode']."&barcode=".$task_arr['barcode']."&applicantname=".$task_arr['applicantname']."&clientname=".$task_arr['clientname']."&EDU_ia_name=".$task_arr['EDU_ia_name']."&EMP_IA_Name=".$task_arr['EMP_IA_Name']."&HLT_ia_name=".$task_arr['HLT_ia_name']."&group_id=".$task_arr['group_id']."&START_DATE_PLAN=".date("Y-m-d")."&END_DATE_PLAN=".$enddateplan."&DEADLINE=$deadline&remainderdate=$remainderdate";
 //echo  $query_string;die;
    curl_setopt($ch,CURLOPT_URL, BITRIX_URL);
    // Set a referer
   curl_setopt($ch, CURLOPT_HEADER, FALSE);
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Download the given URL, and return output
    $output = curl_exec($ch);
	$insertedtaskid=json_decode($output);
   $bitrixtid=$insertedtaskid->insertedtaskid;
	//$db->update("bitrix_id='$bitrixuid'","users","user_id=".(int)$user_arr['user_id']."");
    // Close the cURL resource, and free system resources
  curl_close($ch);
   return  $bitrixtid;
}
mysql_connect(HOST,USER,PASS) or die(mysql_error());
mysql_select_db(DB) or die(mysql_error());
$row=mysql_query("select * from dataflow where bitrixtid=0 limit 1");
while($check=mysql_fetch_array($row)){
	//print_r($check);die;
	//Check if lead already exist
	$checklead=mysql_query("select lead_id from savvion_lead_case where barcode='".mysql_real_escape_string($check['barcode'])."'");
	if(mysql_num_rows($checklead)>0){
		//Existing lead
		$leadarray=mysql_fetch_array($checklead);
		$leadid=$leadarray['lead_id'];
	}else{
		//Adding lead
					$lead_array=array();
					$lead_array['name']=urldecode($check['applicantname']).urldecode($check['barcode']);
					$lead_array['comment']="Applicant Name : ".urldecode($check['applicantname'])."
					Client Name : ".urldecode($check['clientname'])."
					Issuing Authority : ".urldecode($check['issuingauthor'])."";
					$lead_array['user_id']='567';
					//print_r($lead_array);die;
					$leadid=insertleads2($lead_array);
					$cols="barcode,lead_id";
					$values="'".$check['barcode']."','".$leadid."'";
					mysql_query("insert into savvion_lead_case ($cols) VALUES ($values)");
	}
	//Adding Education Task
	if($check['component']=='education' || $check['component']=='EDU'){
					$task_array=array();
					$task_array['task_name']='DF-'.urldecode($check['subbarcode']).'-'.urldecode($check['EDU_ia_name']);
					$task_array['task_desc']="Applicant Name : ".urldecode($check['applicantname'])."
					Client Name : ".urldecode($check['clientname'])."
					Assign Date : ".urldecode($check['assigndate'])."
					Due Date : ".urldecode($check['duedate'])."
					Issuing Authority : ".urldecode($check['issuingauthor'])."
					Total Attachments : ".urldecode($check['attachments'])."
					Folder Name : ".urldecode($check['foldername'])."
					Client Reference No : ".urldecode($check['EDU_clientrefno'])."
					Date Of Birth : ".urldecode($check['EDU_dateofbirth'])."
					Passport No : ".urldecode($check['EDU_passportno'])."
					AKAName : ".urldecode($check['EDU_akaname'])."
					Nationality : ".urldecode($check['EDU_nationality'])."
					Gender : ".urldecode($check['EDU_gender'])."
					University Name : ".urldecode($check['EDU_universityname'])."
					Univeristy Address : ".urldecode($check['EDU_universityaddress'])."
					City : ".urldecode($check['EDU_city'])."
					Country : ".urldecode($check['EDU_country'])."
					Telephone : ".urldecode($check['EDU_telephone'])."
					University Name As Per Masters: ".urldecode($check['EDU_ia_name'])."
					Univeristy Address As Per Masters: ".urldecode($check['EDU_ia_address'])."
					City As Per Masters: ".urldecode($check['EDU_ia_city'])."
					Country As Per Masters: ".urldecode($check['EDU_ia_country'])."
					Telephone As Per Masters: ".urldecode($check['EDU_ia_telephone'])."
					Fax No: ".urldecode($check['EDU_ia_fax'])."
					Email ID: ".urldecode($check['EDU_ia_email'])."
					Web Address: ".urldecode($check['EDU_ia_webaddress'])."
					Is Fake? ".urldecode($check['EDU_ia_isfake'])."
					Is Online ? ".urldecode($check['EDU_ia_isonline'])."";
					$task_array['user_id']=567;
					$task_array['group_id']=42;
					$task_array['crawltype']=$check['crawltype'];
					$task_array['primid']=$check['primid'];
					$task_array['subbarcode']=$check['subbarcode'];
					$task_array['barcode']=$check['barcode'];
					$task_array['applicantname']=$check['applicantname'];
					$task_array['clientname']=$check['clientname'];
					$task_array['EDU_ia_name']=$check['EDU_ia_name'];
					$task_array['EMP_IA_Name']=$check['EMP_IA_Name'];
					$task_array['HLT_ia_name']=$check['HLT_ia_name'];
					//print_r($task_array);die;
					$bitrixctid=add_task($task_array,$leadid);
					mysql_query("update dataflow set bitrixtid=$bitrixctid where primid=".$check['primid']."");
				//	$db->update("bitrixtid=$bitrixctid","dataflow","primid=".$check['primid']."");		
	}
	// Adding Employment Task
	if($check['component']=='employment'){
					$task_array=array();
					$task_array['task_name']='DF-'.urldecode($check['subbarcode']).'-'.urldecode($check['EMP_IA_Name']);
					$task_array['task_desc']="Applicant Name : ".urldecode($check['applicantname'])."
					Client Name : ".urldecode($check['clientname'])."
					Assign Date : ".urldecode($check['assigndate'])."
					Due Date : ".urldecode($check['duedate'])."
					Issuing Authority : ".urldecode($check['issuingauthor'])."
					Total Attachments : ".urldecode($check['attachments'])."
					Folder Name : ".urldecode($check['foldername'])."
					Client Reference No : ".urldecode($check['EMP_clientrefno'])."
					Date Of Birth : ".urldecode($check['EMP_dateofbirth'])."
					Passport No : ".urldecode($check['EMP_passportno'])."
					AKAName : ".urldecode($check['EMP_akaname'])."
					Gender : ".urldecode($check['EMP_gender'])."
					Nationality : ".urldecode($check['EMP_nationality'])."
					Company Name : ".urldecode($check['EMP_CompanyName'])."
					Company Address : ".urldecode($check['EMP_CompanyAddress'])."
					City : ".urldecode($check['EMP_City'])."
					Country : ".urldecode($check['EMP_Country'])."
					Telephone : ".urldecode($check['EMP_Telephone'])."
					Web Address: ".urldecode($check['EMP_WebAddress'])."
					Company Name As Per Masters: ".urldecode($check['EMP_IA_Name'])."
					Company Address As Per Masters: ".urldecode($check['EMP_IA_Address'])."
					City As Per Masters: ".urldecode($check['EMP_IA_City'])."
					Country As Per Masters: ".urldecode($check['EMP_IA_Country'])."
					Telephone As Per Masters: ".urldecode($check['EMP_IA_Telephone'])."
					Fax No: ".urldecode($check['EMP_IA_Fax'])."
					Email ID: ".urldecode($check['EMP_IA_Email'])."";
					$task_array['user_id']=567;
					$task_array['group_id']=42;
					$task_array['crawltype']=$check['crawltype'];
					$task_array['primid']=$check['primid'];
					$task_array['subbarcode']=$check['subbarcode'];
					$task_array['barcode']=$check['barcode'];
					$task_array['applicantname']=$check['applicantname'];
					$task_array['clientname']=$check['clientname'];
					$task_array['EDU_ia_name']=$check['EDU_ia_name'];
					$task_array['EMP_IA_Name']=$check['EMP_IA_Name'];
					$task_array['HLT_ia_name']=$check['HLT_ia_name'];
					//print_r($task_array);die;
					$bitrixctid=add_task($task_array,$leadid);
					mysql_query("update dataflow set bitrixtid=$bitrixctid where primid=".$check['primid']."");
				//	$db->update("bitrixtid=$bitrixctid","dataflow","primid=".$check['primid']."");		
	}
	// Adding Health License Task
	if($check['component']=='healthlicense'){
					$task_array=array();
					$task_array['task_name']='DF-'.urldecode($check['subbarcode']).'-'.urldecode($check['HLT_ia_name']);
					$task_array['task_desc']="Applicant Name : ".urldecode($check['applicantname'])."
					Client Name : ".urldecode($check['clientname'])."
					Assign Date : ".urldecode($check['assigndate'])."
					Due Date : ".urldecode($check['duedate'])."
					Issuing Authority : ".urldecode($check['issuingauthor'])."
					Total Attachments : ".urldecode($check['attachments'])."
					Folder Name : ".urldecode($check['foldername'])."
					Client Reference No : ".urldecode($check['HLT_clientrefno'])."
					Date Of Birth : ".urldecode($check['HLT_dateofbirth'])."
					Passport No : ".urldecode($check['HLT_passportno'])."
					AKAName : ".urldecode($check['HLT_akaname'])."
					Gender : ".urldecode($check['HLT_gender'])."
					Nationality : ".urldecode($check['HLT_nationality'])."
					Authority Name : ".urldecode($check['HLT_authorityname'])."
					Authority Address : ".urldecode($check['HLT_authorityaddress'])."
					City : ".urldecode($check['HLT_city'])."
					Country : ".urldecode($check['HLT_country'])."
					Telephone : ".urldecode($check['HLT_telephone'])."
					Web Address: ".urldecode($check['HLT_website'])."
					Authority Name As Per Masters: ".urldecode($check['HLT_ia_name'])."
					Authority Address As Per Masters: ".urldecode($check['HLT_ia_address'])."
					City As Per Masters: ".urldecode($check['HLT_ia_city'])."
					Country As Per Masters: ".urldecode($check['HLT_ia_country'])."
					Telephone As Per Masters: ".urldecode($check['HLT_ia_telephone'])."
					Fax No: ".urldecode($check['HLT_ia_fax'])."
					Email ID: ".urldecode($check['HLT_ia_email'])."
					Web Address As Per Masters: ".urldecode($check['HLT_ia_webaddress'])."";
					$task_array['crawltype']=$check['crawltype'];
					$task_array['primid']=$check['primid'];
					$task_array['subbarcode']=$check['subbarcode'];
					$task_array['barcode']=$check['barcode'];
					$task_array['applicantname']=$check['applicantname'];
					$task_array['clientname']=$check['clientname'];
					$task_array['EDU_ia_name']=$check['EDU_ia_name'];
					$task_array['EMP_IA_Name']=$check['EMP_IA_Name'];
					$task_array['HLT_ia_name']=$check['HLT_ia_name'];
					$task_array['user_id']=567;
					$task_array['group_id']=42;
					//print_r($task_array);die;
					$bitrixctid=add_task($task_array,$leadid);
					mysql_query("update dataflow set bitrixtid=$bitrixctid where primid=".$check['primid']."");
				//	$db->update("bitrixtid=$bitrixctid","dataflow","primid=".$check['primid']."");		
	}
}
$crawl=mysql_query("select * from dataflow where crawl_status='1' and bitrixtid!=0");
while($crawl_arr=mysql_fetch_array($crawl)){
	 switch($crawl_arr['crawltype']){
	 case "1":
	 $tag="New";
	 break;
	  case "2":
	 $tag="Work In Progress";
	 break;
	  case "3":
	 $tag="QC Reject";
	 break;
	  case "4":
	 $tag="Insufficiency QC Reject";
	 break;
	  case "5":
	 $tag="Insufficiency Notification Reject";
	 break;
	  case "6":
	 $tag="CRM Reject";
	 break;
	  case "7":
	 $tag="CRM Complete";
	 break;
 }
		$ch = curl_init();
		if($crawl_arr['qa_status']==0){
			$where="&taskupdate=1";
		}
 $query_string="action=updatetasktags&task_id=".$crawl_arr['bitrixtid']."&tags=".$tag.$where;
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
	@mysql_query("update dataflow set  crawl_status='0' where `bitrixtid`=".(int)$crawl_arr['bitrixtid']."");
}
?>