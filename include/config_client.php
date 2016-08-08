<?php

if($LEVEL==5){
	$cas_no=$db->select("ver_data","v_id","v_uadd=$_SESSION[user_id]");	
	if(mysql_num_rows($cas_no)){
		$cas_number=mysql_fetch_array($cas_no);
		$_REQUEST['case']=$cas_number['v_id'];
	}
	
	if(isset($_POST['addAttach'])){
		foreach($_REQUEST['casev'] as $ascase){
			$tAry = explode('|',$ascase);
			$case = trim($tAry[0]);
			$flKey  = trim($tAry[1]);
			if(is_numeric($case)){
				if(isset($_FILES[$flKey.$case])){
					$_REQUEST['ascase']=$case;
					$_FILES[$flKey]  = $_FILES[$flKey.$case];
					insertFile($_REQUEST['case'],$_REQUEST['ascase'],$_REQUEST['stitle'.$case],$flKey,'');
				}
			}
		}
	}
	
	if(isset($_REQUEST['register'])){
		register_();
	} 
}

if(isset($_REQUEST['json_param'])){
		$pm_where = base64_decode($_REQUEST['pm_where']);
		$m_orderby = $_REQUEST['m_orderby'];

	
		//if(!empty($pm_where)){ $pm_where_s = "as_status='".$pm_where."'"; } else{ $pm_where_s = ''; }
		switch($_REQUEST['json_call']){
			case"ready_for_download";
				$data = client_checks_info("v_sent=4 AND v_cdnld=0 AND v_status='Close'","LIMIT 4");
				send_json($data);
			break;
			
			case"all_cases";
				$data = client_case_info();
				send_json($data,true);
			break;
			case"custom_cases";
				
				$data = client_case_info($pm_where,$m_orderby);
				//var_dump($data['data'][0]['v_name']); 
				send_json($data,true);
			break;
			
			case"client_case_info_serverside";
				
				$data = client_case_info_serverside($pm_where,$m_orderby,$isSearch);
				send_json($data,true);
			break;
			
			case"advance_search_case_info";
				
				$data = advance_search_case_info($pm_where,$m_orderby);
				//var_dump($data['data'][0]['v_name']); 
				send_json($data,true);
			break;
			
			case"applicant_cases";
				$data = applicant_case_info();
				
				send_json($data,true);
			break;
			case"applicant_insufficient_case_info";
				$data = applicant_insufficient_case_info($pm_where,$m_orderby);
				
				send_json($data,true);
			break;
			case"invited_applicant";
				$data = invited_applicant($pm_where,$m_orderby);
				
				send_json($data,true);
			break;
			case"dashboard";
			$notify['notify'] = array();
			$msgs['msgs'] = array();
				$q_msgs  = get_messages("com_type='case' AND is_read=0 AND ","",true);
				
				$q_notify = get_notifications("a_type='notification' AND is_break=0 AND ","",true);
				if($q_msgs){
				while($row = mysql_fetch_assoc($q_msgs)){
					
					
					$msgs[] = $row;
					
				}
				}
				if($q_notify){
				while($row = mysql_fetch_assoc($q_notify)){
					$user_info=getUserInfo($row['user_id']);
					$row['notify_sender'] = $user_info['first_name']. " " .$user_info['last_name'];
					
					$notify[] = $row;
					
				}
				}
				$data['msgs'] = $msgs;
				$data['notify'] = $notify;
				
				//var_dump($msg); die();
				send_json($data,true);
			break;						
		}
}
	// single case upload not check by KHL
	if(isset($_REQUEST['upload_case_only'])){
			
		upload_case_only();
	}
	// bulk case upload not check by KHL
	if(isset($_REQUEST['bulkupload_case_only'])){
		
		bulkupload_case_only();
	}


if(isset($_REQUEST['submit_bulk'])){
	
	if($_REQUEST['addmore']==1){
		
		addMoreChecks();
		
	}else if($_REQUEST['addmore_attachments']==1){
		
		
		
		addMoreAttachments();
		
	}else{
	if($_REQUEST['ajaxupload']==1){
		// by khl
	clientBulkUploadAjax();
	
		
	}else if($_REQUEST['ajaxupload2']==1){
		// by khl
		clientBulkUploadAjax2();
		
		
		
		
		
	}else{
	 clientulkupload();
	 }
	}
}


if(isset($_REQUEST['subinvitation'])){
	addinvitation();	
}

if(isset($_POST['sendToApplicant']) && $_POST['sendToApplicant']==1){
	
	sendNewLinkToApplicant($_POST['uid']);	
}


if($LEVEL==4){
	
	if(isset($_REQUEST['eduser'])){
		if(is_numeric($_REQUEST['uid'])){
			enabdisb("users","user_id=$_REQUEST[uid]","[ $_REQUEST[msg] ]");
		}
	}
	
	if(isset($_POST['subProblem'])){
		$_REQUEST['_id']=$_REQUEST['ascase'];
		addComments();	
	}
	if(isset($_POST['quickInvitation'])){
		if(isset($SUSER)){
			if(in_array(2,$RIGHTS)){
				quickInvitation();
			}else msg('err',"You Have No Access, Please Contact to Main User!");
		}else{
			quickInvitation();
		}
	}
	if(isset($_POST['addreply'])){
		addreply();	
	}
	if(isset($_POST['sendmsgs'])){

		add_message();	
	}
	if(isset($_POST['updateMsgStatus'])){

		updateMsgStatus();	
	}
	
	if(isset($_POST['subArchive'])){
		subArchive();	
	}
	
	if(isset($_POST['ordCertif'])){
		ordCertif();	
	}
	
	if(isset($_POST['edit_package'])){
		editPackage();	
	}
	if(isset($_POST['edit_profile'])){
		editProfile();	
	}
	
	if(isset($_POST['bookmark'])){
		bookmark();
	}
	if(isset($_POST['addticket'])){
	
		addticket();
	}
	if(isset($_POST['addticketcomment'])){
		addticketcomment();
	}


	
	
	if(isset($_REQUEST['uploadFile'])){
		if(is_numeric($_POST['ascase'])){ 
			$check = $db->select("ver_checks","*","as_id=$_POST[ascase]");
			if(mysql_num_rows($check)>0){
				$check = mysql_fetch_array($check);
				$flds = $db->select("fields_maping","*","checks_id=$check[checks_id] AND fl_key<>'file' AND in_id=5");
				if(mysql_num_rows($flds)>0){
					$flds = mysql_fetch_array($flds); 
					if((isset($_FILES[$flds['fl_key']]) && $_REQUEST['ftitle']!='')){
						insertFile($_REQUEST['case'],$_POST['ascase'],$_REQUEST['ftitle'],$flds['fl_key']);		
					}	
				}
			}
		}	
	}
			
	if(isset($_REQUEST['addsubuser'])){
		if(isset($SUSER)){
			msg('err',"You Have No Right to Add Sub Users!");
		}else{
			addsubuser_();
		}
	} 
	
	if(isset($_REQUEST['create_pkg'])){
		if(isset($SUSER)){
			if(in_array(6,$RIGHTS)){
				create_pkg();
			}else msg('err',"You Have No Access, Please Contact to Main User!");
		}else{
				create_pkg();
		}
	}
	
	if(isset($_POST['caseWizard'])){
		if(isset($SUSER)){
			if(in_array(1,$RIGHTS)){
				caseWizard();
			}else msg('err',"You Have No Access, Please Contact to Main User!");
		}else{
			caseWizard();
		}
	}
	
	
	// by khl
	
	if(isset($_POST['addcasebyclient'])){
		
		$verCase = addCaseByClient();
		
	}
	
	if(isset($_POST['addattachedfile'])){
		
		addAttachedFile();
		
	}
	
	
	if(isset($_POST['removeattachedfile'])){
		
		$verCase = removeAttachedFile();
		
	}
	// download excel file
	if(isset($_POST['downloadxcl'])){
		
	$pmwhere = base64_decode($_REQUEST['pmwhere']);
	$pmorder = base64_decode($_POST['pmorder']);
		
	exportDataInExcel($pmwhere,$_POST['xcl_file_name'],$pmorder,$_POST['pmlimit']);
	
			
	}
	
		if(isset($_POST['save_search_resuts'])){
		
		save_search_resuts($_POST);
		
	}

	
	
	// by khl end

	// By Ayaz

if(isset($_REQUEST['inviteApplicantVerify'])){
		$inviteApplicantVerify =  inviteApplicantVerify();
	}
	if(isset($_REQUEST['addApplicantVerify'])){
		
		$UserDataEmail =  addApplicantVerify();
		return $UserDataEmail;
		//print_r($UserDataEmail);exit;
	}
	if(isset($_REQUEST['verifyApplicants'])){
		  verifyApplicants();
	}
	
}

	

if(isset($_REQUEST['woocom_applicant'])){
	
	
	
WoocomApplicantUpload();
	
	
}

//by khl
if(isset($_GET['comid']) && isset($_GET['sts'])){
	
		$com_id = base64_decode($_GET['comid']);
		$com_id = explode("-",$com_id);
		
		$com_id = (int) $com_id[1];
		$status = (int) base64_decode($_GET['sts']);
		
		//echo 'com_id: '.$com_id.' status: '.$status; exit;
		disable_enable_downloading($com_id,$status);

	}
	if(isset($_POST['save_search_resuts'])){
		
		save_search_resuts($_POST);
		
	}
	
	if(isset($_REQUEST['selLoc']) && $_REQUEST['selLoc']==1){
	
	checkUseridsLocation($_REQUEST['loc_id']);
	
	
	}

// by khl
if(isset($_POST['sub_email_notify'])){
		sub_email_notify($_POST);	
	}
// by khl
if(isset($_POST['update_billing_contact'])){
		
		update_billing_contact($_POST);		
	}
	
if(isset($_POST['acceptgreement']))
{//echo 'asdasd';print_r($_REQUEST);exit;
	accept_agreement();
	 
 }

if(isset($_POST['rejectagreement']))
{//echo 'asdasd';print_r($_REQUEST);//exit;
	reject_agreement();
	
}


if(isset($_POST['sendfeedbackx']))
{ 
	 rejection_feedbackx();	
}

function rejection_feedbackx()
{
	global $db;
	
	$comid = $_REQUEST['comid'];
	$reject_feedback = $_REQUEST['reject_feedback'];
	$qoutation_num = $_REQUEST['qoutation_num'];
	
	 $db->update("reject_fback='$reject_feedback'","client_agreement_confg","comps_id=$comid AND qoutation_num='$qoutation_num'");
}


if(isset($_POST['sendfeedback']))
{
	feedback_agreement();
	
}


 function feedback_agreement()
{
	
	global $db,$COMINF;
	 
 $uID = $_SESSION['user_id'];
 
$com_id= $COMINF['id'];
 $feedback = $_POST['feedback_agreement'];

$poc_email = $_POST['poc_email'];

 		$comInfo = getcompany($COMINF['id']);
					$comInfo = @mysql_fetch_array($comInfo);

				
  $get_client_ip = get_client_ip(); 	
					 
 
								$date = date("Y-m-d h:i:s");
				 

$db->insert("com_id,message,user_id,senddate","'$com_id','$feedback','$uID','$date'","client_agreement_discussion");
  
			$table2 = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
					 <tr>'.$comInfo['name'].' Sent a message on agreement.
					 </tr>
					 <tr>
						 <h2>Message</h2><br>
						 '.$feedback.' 
 					</tr> 
  					</tbody>
				</table>';
		  emailTmp($table2,'Agreement Feedback',"atta@xcluesiv.com","","","","","Operations","");
		  
 

 }






 function accept_agreement()
{global $db;
 
 //$uID = $_SESSION['user_id'];
$com_id= $_REQUEST['comid'];


$newuser_add= $_REQUEST['newuser_add'];
 
 $comInfo = getcompany($com_id);
			$comInfo = @mysql_fetch_array($comInfo);
 
 $qoutation_num = $_POST['qoutation_num'];
 
$clientip = get_client_ip();

$poc_email = $_POST['poc_email'];

$where = "comps_id='".$com_id."' and qoutation_num = '$qoutation_num' ";
$tabl = 'client_agreement_confg';
					$Q = $db->select($tabl,"*",$where);
					
			//newuser_add		 
if(mysql_num_rows($Q))
{					
$res = mysql_fetch_array($Q);

if($res['is_suspend_active'] != 1 && $res['is_send'] == 1)
{
	
$where_chk = "com_id='".$com_id."' and qoutation_num = '$qoutation_num'  ";
$tabl_checks = 'client_agreement';

$client_agreement = $db->select($tabl_checks,"*",$where_chk);
if(mysql_num_rows($client_agreement))
{
	$getUserInfo2 = getUserInfo($res['agr_receiver']);
	$poc_email = $getUserInfo2['email'];
	
	$where = "comps_id = '".$com_id."'  and qoutation_num = '$qoutation_num'  ";
				//$db->delete($tabl,$where);
								$date = date("Y-m-d h:i:s");
	
	if(isset($newuser_add) )
	{  
	 if($newuser_add == 'yes')
	 {
		 $salt = get_rand_val(8);
		$password = "abc123";
		 
				$pass = md5(md5($password).md5($salt));
		$_POST['uemail'] = addslashes($_POST['uemail']);

			$_POST['country'] = "Pakistan";

			if($_POST['fname'] == NULL) msg('err',"Please Enter First Name!");

			

			if($_POST['lname'] == NULL) msg('err',"Please Enter Last Name!");	

			if($_POST['country'] == NULL) msg('err',"Please Enter Country!");	
			
			$cols ="country,first_name,last_name,email,username,password,salt,level_id,puser_id,com_id,u_type";
			$vals = "'$_POST[country]','$_POST[fname]','$_POST[lname]','$_POST[uemail]','$_POST[uemail]','$pass','$salt',4,'',$com_id,1";
			
			if($_POST['fname'] != "" && $_POST['uemail'] != "" && $_POST['lname'] != "" && $_POST['country'] != "")
			{
			$isRegister = $db->insert($cols,$vals,'users');
			 $user_insert_id=mysql_insert_id();
		 while($res = mysql_fetch_array($client_agreement))
	{
 		$checks_id = $res['checks_id'];
		$clt_cost = $res['clt_cost'];
		$clt_units = $res['clt_units'];
		$clt_currency = $res['clt_currency'];
		$clt_adate = $res['clt_adate'];
		
		 //$db->update("is_accept=1,is_send_master=1","client_agreement","com_id=$com_id AND checks_id=$checks_id and qoutation_num = '$qoutation_num'  ");

 $record = $db->select("clients_checks","*","com_id=$com_id AND checks_id=$checks_id");
			if(mysql_num_rows($record)>0){
				//$db->update("clt_active=1,clt_cost=$clt_cost,clt_currency='$clt_currency',clt_units=$clt_units","clients_checks","com_id=$com_id AND checks_id=$checks_id");
				
			}else{
				//$db->insert("clt_active,clt_cost,clt_currency,com_id,checks_id,clt_units","'1',$clt_cost,'$clt_currency',$com_id,$checks_id,$clt_units","clients_checks");
				
			}
		
		
			
	}					

	 
			$asd =  $db->update("agr_status='2',agr_poc='$user_insert_id',agr_poc2='$user_insert_id',agr_receiver='$user_insert_id',is_user_exists='0',is_user_login='1',app_rej_date='$date',client_ip='$clientip'",$tabl,$where);	
 			
			
 					$table = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
					 <tr>
						<h2>Congratulations!</h2>
						We heartedly greet you on accepting the Qoutation sent. You are now towards the path of risk free environment.<br>
						Invest in yourself, of course!<br>
						Spend a tiny portion on intelligent screening services and protect yourself against adverse effects to business. We offer state-of-the-art report delivery structure which is backed by a personalized and focused customer service. We always go an extra mile to identify and complement our client\'s screening needs. We have a consultative approach with predictable pricing structure. We assure 100% state and FCRA compliance with innate applicant portal & manageable reporting.<br>
						Knowledge is an investment that has positive returns.
 					</tr> 
					<tr>
					<td>'.$_POST['uemail'].'</td><td>'.$password.'</td>
					</tr>
 					</tbody>
				</table>';
				$name = $_POST['fname'].' '.$_POST['lname'];
		  emailTmp($table,'Qoutation Approval Notification',$_POST['uemail'],"","","","","$name");
 		  					$table2 = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
					 <tr>
						<h2>Congratulations!</h2>
						 '.$comInfo['name'].' has accepted Qoutation.
 					</tr> 
  					</tbody>
				</table>';
		  emailTmp($table2,'Qoutation Approval Notification',"atta@xcluesiv.com","","","","","Operations",""); 
		  }}
		  else
		  {
			  
		  }
 }
 else
 {
	 	 while($res = mysql_fetch_array($client_agreement))
	{
 		$checks_id = $res['checks_id'];
		$clt_cost = $res['clt_cost'];
		$clt_units = $res['clt_units'];
		$clt_currency = $res['clt_currency'];
		$clt_adate = $res['clt_adate'];
		
		 $db->update("is_accept=1,is_send_master=1","client_agreement","com_id=$com_id AND checks_id=$checks_id and qoutation_num = '$qoutation_num'  ");

 $record = $db->select("clients_checks","*","com_id=$com_id AND checks_id=$checks_id");
			if(mysql_num_rows($record)>0){
				$db->update("clt_active=1,clt_cost=$clt_cost,clt_currency='$clt_currency',clt_units=$clt_units","clients_checks","com_id=$com_id AND checks_id=$checks_id");
				
			}else{
				$db->insert("clt_active,clt_cost,clt_currency,com_id,checks_id,clt_units","'1',$clt_cost,'$clt_currency',$com_id,$checks_id,$clt_units","clients_checks");
				
			}
		
		
			
	}					

	 
	 
	 $asd =  $db->update("agr_status='2',app_rej_date='$date',client_ip='$clientip'",$tabl,$where);	
 			
			
 					$table = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
					 <tr>
						<h2>Congratulations!</h2>
						We heartedly greet you on accepting the Qoutation sent. You are now towards the path of risk free environment.<br>
						Invest in yourself, of course!<br>
						Spend a tiny portion on intelligent screening services and protect yourself against adverse effects to business. We offer state-of-the-art report delivery structure which is backed by a personalized and focused customer service. We always go an extra mile to identify and complement our client\'s screening needs. We have a consultative approach with predictable pricing structure. We assure 100% state and FCRA compliance with innate applicant portal & manageable reporting.<br>
						Knowledge is an investment that has positive returns.
 					</tr> 
 					</tbody>
				</table>';
		  emailTmp($table,'Qoutation Approval Notification',$poc_email,"","","","","");
 		  					$table2 = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
					 <tr>
						<h2>Congratulations!</h2>
						 '.$comInfo['name'].' has accepted Qoutation.
 					</tr> 
  					</tbody>
				</table>';
		  emailTmp($table2,'Qoutation Approval Notification',"atta@xcluesiv.com","","","","","Operations","");
 }
	
	
 				
 }				
		  
}
}

 }

 function reject_agreement()
{global $db ;

 $com_id= $_REQUEST['comid'];
 
$clientip = get_client_ip();
 $comInfo = getcompany($com_id);
			$comInfo = @mysql_fetch_array($comInfo);
$poc_email = $_POST['poc_email'];

$qoutation_num = $_POST['qoutation_num'];


$where = "comps_id='".$com_id."' and qoutation_num = '$qoutation_num' ";
$tabl = 'client_agreement_confg';
 $Q = $db->select($tabl,"*",$where);
					
					 
if(mysql_num_rows($Q))
{					
$res = mysql_fetch_array($Q);

if($res['is_suspend_active'] != 1 && $res['is_send'] == 1)
{
	
$where_chk = "com_id='".$com_id."' and qoutation_num = '$qoutation_num'";
$tabl_checks = 'client_agreement';
$client_agreement = $db->select($tabl_checks,"*",$where_chk);
if(mysql_num_rows($client_agreement))
{
	while($res = mysql_fetch_array($client_agreement))
	{
 		$checks_id = $res['checks_id'];
		$clt_cost = $res['clt_cost'];
		$clt_units = $res['clt_units'];
		$clt_currency = $res['clt_currency'];
		$clt_adate = $res['clt_adate'];
		
		 $db->update("is_accept=2,is_send_master=0","client_agreement","com_id=$com_id AND checks_id=$checks_id and qoutation_num = '$qoutation_num'");

/* $record = $db->select("clients_checks","*","com_id=$com_id AND checks_id=$checks_id");
			if(mysql_num_rows($record)>0){
				$db->update("clt_active=1,clt_cost=$clt_cost,clt_currency='$clt_currency',clt_units=$clt_units","clients_checks","com_id=$com_id AND checks_id=$checks_id");
				
			}else{
				$db->insert("clt_active,clt_cost,clt_currency,com_id,checks_id,clt_units","'1',$clt_cost,'$clt_currency',$com_id,$checks_id,$clt_units","clients_checks");
				
			}
*/		
		
			
	}					
}

 //while($res = mysql_fetch_array($Q))
			//{//$where = "com_id='".$com_id."' ";
 				$where = "comps_id = '".$com_id."' and qoutation_num = '$qoutation_num' ";
				//$db->delete($tabl,$where);
				$date = date("Y-m-d h:i:s");
				$asd =  $db->update("agr_status='3',app_rej_date='$date',client_ip='$clientip'",$tabl,$where);	
				 
 			//}
 			
					$table = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
					 <tr>
					 Hi '.$comInfo['name'].',<br>
					 It’s really saddened to see the rejection of Qoutation by you. It will be a pleasure to have word on before locking it. We always go an extra mile to identify and complement our client\'s screening needs.
					 <br>
					 Looking forward for a positive response, we assure our 100% efforts to make this Qoutation worth to you.<br>
					 </tr>
 					</tbody>
				</table>';
		  emailTmp($table,'Qoutation Rejection Notification',"atta@xcluesiv.com","","","","","$_SESSION[fname]","");
 		   		   $table2 = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
					 <tr>
						<h2>Rejection of Qoutation</h2>
						 '.$comInfo['name'].' Rejected your purposal.
 					</tr> 
  					</tbody>
				</table>';
		  emailTmp($table2,'Qoutation Rejection Notification',"atta@xcluesiv.com","","","","","Operations","");

		  
}
}

 }

 
 if(isset($_POST['agr_accptnc']))
{ global $db,$COMINF;
$comid = $COMINF['id'];
 
if($_REQUEST['coupon_question'] == 'on')
{ 
	$asd =  $db->update("is_agreed='1'","company","id = $comid");	
				 
 }
 
 
 }
 
 
 
 
 
 
 
 
?>