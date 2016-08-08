<?php
	$_REQUEST['certificate']='1';
	
	if(isset($_POST['addbasic'])){
		$verCase = subBasic();
		
	}
	if(isset($_POST['apply_dd'])){
		apply_dd_sav();
		
	}

	if(isset($_POST['bulkupload'])){
		csvbulkupload();
	}
		
	if(isset($_REQUEST['register'])){
		register_();
	} 
	
	if(isset($_REQUEST['sentto'])){
		srChecks();
	}	

	if(isset($_REQUEST['assigncases']) || isset($_REQUEST['rassigncases'])){
		assignChecks();
	}
	
	if(isset($_REQUEST['opencasck']) || isset($_REQUEST['delecasck'])){
		removeOpenCs();
	}

	if(isset($_REQUEST['fedit'])){
		editFields();
	}
	
	if(isset($_REQUEST['assignSavvionChecks'])){
		assignSavvionChecks();
	}

	if(isset($_REQUEST['addchecks'])){			
		addChecks();	
	}
		
	if(isset($_REQUEST['checksub'])){
	
		adddata();
	}

	if(isset($_REQUEST['addProject'])){
		if($_SESSION['user_id']==83){
			msg('err',"You Dont have Permission to add Project!");
		}else{
			addProject();
		}		
	}
	
	if(isset($_POST['addctyctry'])){
		addctyctry();
	}
	
	if(isset($_REQUEST['sbremarks'])){
		if(!empty($_REQUEST['remarks'])){
			if($_REQUEST['vStatus']!=''){
				$uCols="as_remarks='$_REQUEST[remarks]',as_adcls=1,as_cldate=CURRENT_TIMESTAMP";
				if(updateCheck($_REQUEST['ascase'],$uCols)){
					addActivity('ascase','',$LEVEL,'',$_REQUEST['case'],$_REQUEST['ascase'],'remark');
				}
				$uCols="v_rlevel='$_REQUEST[vStatus]',v_cldate=CURRENT_TIMESTAMP";
				$tCnt = countChecks("vc.v_id=$_REQUEST[case] AND vc.as_isdlt=0");
				$cCnt = countChecks("vc.v_id=$_REQUEST[case] AND vc.as_adcls=1 AND vc.as_status='Close' AND vc.as_isdlt=0");
				if($tCnt==$cCnt) $tWh="$uCols,v_status='Close',v_int=0"; else $tWh="$uCols,v_int=0";
				if(updateData($_REQUEST['case'],$tWh)){
					if($tCnt==$cCnt) addActivity('case','',$LEVEL,'',$_REQUEST['case'],$_REQUEST['ascase'],'close');
				}
			}			
		}
	}
	
	if(isset($_REQUEST['ascase'])){
		if(isset($_REQUEST['vStatusN']) && !isset($_REQUEST['isMulty'])){
			vStatus($_REQUEST['ascase'],$_REQUEST['vStatusN']);	
		}	
	}
	
	if(isset($_REQUEST['nextface'])){
		if(isset($_REQUEST['vStatusN'])){
			vStatus($_REQUEST['ascase'],$_REQUEST['vStatusN']);	
		}
		npCheck($_REQUEST['ascase'],$pm='p');
	}
	
	if(isset($_REQUEST['prvsface'])){
		npCheck($_REQUEST['ascase'],$pm='n');
	}
	
	if(isset($_REQUEST['check_approve'])){
		
		UpdateCheckStatus($_REQUEST['as_id'],'Approved');
	}
	
	if(isset($_REQUEST['check_reject'])){
		
		UpdateCheckStatus($_REQUEST['as_id'],'Rejected');
	}
	if(isset($_REQUEST['check_sumb_qa'])){
		UpdateCheckStatus($_REQUEST['as_id'],$_REQUEST['chck_qa']);
	}
	
	


	
	if(isset($_REQUEST['closeCase'])){
		if(caseStatus($_REQUEST['ascase'],"Close")){
			addActivity('ascase','',$LEVEL,'',$_REQUEST['case'],$_REQUEST['ascase'],'close');	
		}
	}
	
	/* if(isset($_REQUEST['closeCase'])){
		if(closeCheckStatus($_REQUEST['ascase'],"Close")){
			addActivity('ascase','',$LEVEL,'',$_REQUEST['case'],$_REQUEST['ascase'],'close');	
		}
	} */
	
	if(isset($_REQUEST['submit_uniinfo'])){
		if($_SESSION['user_id']==83 || $_SESSION['user_id']==50){
			msg('err',"You Dont have Permission to add University!");
		}else{
			addUnie();
		}		
			
	}
	
	// START OF CODE BY ATA FOR ADD OR EDIT COMPANY LOCATIONS //
	
	
	if(isset($_REQUEST['submit_locinfo'])){
		managecomlocations();
	}
	// END OF CODE BY ATA FOR ADD OR EDIT COMPANY LOCATIONS //
	
	
	if(isset($_POST['addticket'])){
	
		addticket();
	}
	if(isset($_POST['addticketcomment'])){
		addticketcomment();
	}
	if(isset($_POST['updateticketstatus'])){
		updateticketstatus();
	}


	if(isset($_POST['subProblem'])){
		$_REQUEST['_id']=$_REQUEST['ascase'];
		addComments();	
	}
	if(isset($_POST['addreply'])){
		addreply();	
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

	if(isset($_REQUEST['daction'])){
		if($_REQUEST['daction']=='delete'){
			if(is_numeric($_REQUEST['datav'])){
				edData($_REQUEST['datav'],$_REQUEST['daction']);
			}
		}
	}	
	
	if(isset($_REQUEST['uploadFile'])){
		if(is_numeric($_POST['ascase'])){ 
			if(!isset($_FILES['file'])){
				$check = $db->select("ver_checks","*","as_id=$_POST[ascase]");
				if(mysql_num_rows($check)>0){
					$check = mysql_fetch_array($check);
					$flds = $db->select("fields_maping","*","checks_id=$check[checks_id] AND fl_key<>'file' AND in_id=5");
					if(mysql_num_rows($flds)>0){
						$flds = mysql_fetch_array($flds); 
						if((isset($_FILES[$flds['fl_key']]) && $_REQUEST['ftitle']!='')){
							insertFile($_REQUEST['case'],$_POST['ascase'],$_REQUEST['ftitle'],$flds['fl_key']);		
						}else{
						if((isset($_FILES[$flds['fl_key']]))){
						msg("err","Please select a file to upload!");
						}
						if($_REQUEST['ftitle']==''){
						msg("err","Please type attchment title!");	
						}	
						}	
					}
				}
			}else{
				if((isset($_FILES['file']) && $_REQUEST['ftitle']!='')){
					insertFile($_REQUEST['case'],$_POST['ascase'],$_REQUEST['ftitle'],'file');		
				}else{
					if((isset($_FILES['file']))){
					msg("err","Please select a file to upload!");
					}
					if($_REQUEST['ftitle']==''){
					msg("err","Please type proof\'s title");	
					}
				}
			}
		}		

	}
	
	
	// added by khl 
	
	if(isset($_REQUEST['json_param'])){
		$pm_where = base64_decode($_REQUEST['pm_where']);
		$pm_where2 = base64_decode($_REQUEST['pm_where2']);
		$m_orderby = $_REQUEST['m_orderby'];
		$isSearch = $_REQUEST['search'];
	
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
				
				$data = client_case_info($pm_where,$m_orderby,$isSearch);
				send_json($data,true);
			break;
			// by KHL
			case"client_case_info_serverside";
				
				$data = client_case_info_serverside($pm_where,$m_orderby,$isSearch);
				send_json($data,true);
			break;
			

			// BY ATA

			case"advance_search_case_info";
					//var_dump($pm_where); die; 
				$data = advance_search_case_info($pm_where.$pm_where2,$m_orderby);
			
				send_json($data,true);
			break;
			
			// BY KHL

			case"advance_search_casewise_info";
				
				$data = advance_search_casewise_info($pm_where,$m_orderby);
				//var_dump($data['data'][0]['v_name']); 
				send_json($data,true);
			break;




			case"qa_cases";
				$data = qa_case_info($pm_where,$m_orderby);
				send_json($data,true);
			break;

			case"dashboard";
			$notify['notify'] = array();
			$msgs['msgs'] = array();
				$q_msgs  = get_messages("com_type='case' AND is_read=0 AND ","",true);
				
				$q_notify = get_notifications("a_type='notification' AND is_break=0 AND","",true);
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
//by khl
if(isset($_REQUEST['addholiday'])){

		addholiday();

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


// by ata for advnc search
// download excel file
	if(isset($_POST['downloadxcl'])){
		
	$pmwhere = base64_decode($_REQUEST['pmwhere']);
	$pmorder = base64_decode($_POST['pmorder']);
		
	exportDataInExcel($pmwhere,$_POST['xcl_file_name'],$pmorder,$_POST['pmlimit']);
	
			
	}
	
	
	
	if(isset($_POST['save_search_resuts'])){
		
		save_search_resuts($_POST);
		
	}








//by khl
if(isset($_POST['skipCheck']) && $_POST['skipCheck']==1){

		skipCheck($_POST['is_skipped']);

	}
	
//by khl
if(isset($_POST['insuff_docs'])){

		insuff_docs($_POST['att_id']);

	}
	if(isset($_POST['sub_email_notify'])){
		sub_email_notify($_POST);	
	}
	if(isset($_POST['update_billing_contact'])){
		
		update_billing_contact($_POST);		
	}
if(isset($_GET['delatt'])){
	
	$att_id = (int) base64_decode($_REQUEST['att_id']);
	if($att_id!=0){
		del_attached($att_id);
	}
		

	}

if(isset($_REQUEST['confirm_check_suff']) && $_REQUEST['confirm_check_suff']==1){
	confirm_check_suff();
	}
//by ata
if(isset($_POST['checkapprovedqa'])){

		$savvion_check_id = $_REQUEST['savvion_check_id'];
		$cols = 'qa_status,bot_status,extra_qc_comments';
		$values = "2,1,'".$_REQUEST['extra_qc_comments']."'";
		$isAddEdit = $db->updateCol($cols,$values,'records',"primid=$savvion_check_id");		 
	}
//by ata
if(isset($_POST['checkrejectqa'])){
		$savvion_check_id = $_REQUEST['savvion_check_id'];
		$cols = 'qa_status,bot_status,extra_qc_comments';
		$values = "0,0,'".$_REQUEST['extra_qc_comments']."'";
		$isAddEdit = $db->updateCol($cols,$values,'records',"primid=$savvion_check_id");		 
		 
	}

//by ata
 	if(isset($_POST['suspended_agrement'])){
		$comid = $_REQUEST['comp_id'];
	$companies = $db->select("client_agreement_confg","*","comps_id = $comid");
					$companyx = mysql_fetch_array($companies);
					
			$agr_poc = $companyx['agr_poc'];
 			$comInfo = getcompany($comid);
			$comInfo = @mysql_fetch_array($comInfo);
 			$get_client_ip = get_client_ip(); 
 			$user_info = getUserInfo($agr_poc);
			$email = $user_info['email'];
			
					
					
			if($companyx['is_suspend_active'] != 1)
			{
			$db->update("is_suspend_active='1'","client_agreement_confg","comps_id='$comid'");
			
				 $table = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
 					<tr>
						 The Quotation have suspended by BCG for '.$comInfo['name'].'. For further information please contact.
 					</tr> 
					 
 					</tbody>
				</table>';
				$fulname = $user_info['first_name']." ".$user_info['last_name'];
		  emailTmp($table,'Quotation Suspended Information',$email,"","","","","$fulname","");
		  
		  		$table2 = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
 					<tr>
						 The Quotation have suspended for '.$comInfo['name'].' by '.$_SESSION['fname'].'. 
 					</tr> 
 					</tbody>
				</table>';
				 
		  emailTmp($table2,'Quotation Suspended Information',"atta@xcluesiv.com","","","","","Operation","");
			
				
	 echo 'Suspended';
			}
			else
			{
			$db->update("is_suspend_active='0'","client_agreement_confg","comps_id='$comid'");
			
							 $table = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
 					<tr>
						 The Quotation have activated now by BCG for '.$comInfo['name'].'. 
 					</tr> 
					 
 					</tbody>
				</table>';
				$fulname = $user_info['first_name']." ".$user_info['last_name'];
		  emailTmp($table,'Quotation Activation Information',$email,"","","","","$fulname","");
		  
		  		$table2 = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
 					<tr>
						 The Quotation have activated now for '.$comInfo['name'].' by '.$_SESSION['fname'].'. 
 					</tr> 
 					</tbody>
				</table>';
				 
		  emailTmp($table2,'Quotation Activation Information',"atta@xcluesiv.com","","","","","Operation","");
			

				
	 echo 'Active';
			}
		
	}
 


if(isset($_POST['addcheck_agreements'])){
	
		$user_id = $_SESSION['user_id'];

		$current_user_info = getUserInfo($user_id);
		$current_u_name = $current_user_info['first_name'].' '.$current_user_info['last_name'];

 		$random_num = generateRandomString(8);


		$comid = $_REQUEST['comid'];
		$date = date("Y-m-d h:i:s");
		$agr_email = $_REQUEST['cEmail'];

		//$db->update("is_expired='1'","client_agreement_confg","comps_id='$comid'");	
		//$db->update("is_expired='1'","client_agreement_confg","comps_id='$comid'");	
	$companiesagreement = $db->select("client_agreement_confg","*","comps_id = '$comid' and is_expired = '0'");
	//if(mysql_num_rows($companiesagreement))
 	//{
		$active_data = mysql_fetch_array($companiesagreement);
		
		$qoutation_num = $active_data['qoutation_num'];	



		$comInfo = getcompany($comid);
		$comInfo = @mysql_fetch_array($comInfo);

		$get_client_ip = get_client_ip();

		if(isset($_POST['newuseradd']) && ($_POST['newuseradd'] != ''))
		{ 
	$is_user_exists = 1;
		$agr_poc = $_REQUEST['agr_poc'];
		$agr_poc2 = $_REQUEST['agr_poc'];
		
    	$fulname = $_REQUEST['agr_poc'];
		
		$email = $_REQUEST['agr_poc'];
		
		if($agr_poc == '')
		{
			msg('err',"Please type user email address."); exit;
 		}

		}
		else
		{
$is_user_exists = 0;
		$agr_poc = $_REQUEST['agr_poc'];
		//$agr_poc2 = $_REQUEST['agr_poc2'];
		 $agr_poc2 = $_REQUEST['agr_poc'];
		
 
	$user_info = getUserInfo($agr_poc);
	$email = $user_info['email'];

	$user_info2 = getUserInfo($agr_poc2);
	$email2 = $user_info2['email'];
	
    $fulname = $user_info['first_name']." ".$user_info['last_name'];
 		}
 		
		
		
		
		
		
		if($_REQUEST['add'] == "yes")
		{
			
		$db->update("is_expired='1'","client_agreement_confg","comps_id='$comid'");	
		
		$db->update("is_agreed='0'","company","id='$comid'");	
	
			
	 $client_agreement = $db->select("client_agreement","*","com_id = '$comid' and is_expired = '0'");
	 $clients_checks = mysql_num_rows($client_agreement);
		
		
	 $clients_checks_all = $db->select("clients_checks","*","com_id = '$comid'");
	 $clients_checks_master = mysql_num_rows($clients_checks_all);
 		
		
		if($clients_checks > 0)
		{echo 'clientagreement';
			$existsres = mysql_fetch_array($client_agreement);
		echo	$qoutation_num_for_add = $existsres['qoutation_num'];
		}
		else if($clients_checks_master > 0)
		{echo 'clients_checks_master';
				$db->update("clt_active=0","clients_checks","com_id=$comid");


			while($checks_exists = mysql_fetch_array($clients_checks_all))
			{
			$checks_id = $checks_exists["checks_id"];
			$cost = $checks_exists["clt_cost"];
			$units = $checks_exists["clt_units"];
			$clt_currency = $checks_exists["clt_currency"];

					 $db->insert("user_id,clt_cost,clt_currency,com_id,checks_id,clt_units,is_expired,qoutation_num","$user_id,$cost,'$clt_currency',$comid,$checks_id,$units,'0','$random_num'","client_agreement");
			
			 
			}
		echo	$qoutation_num_for_add = $random_num;
			
		}
		else
		{echo 'elser';
			echo $qoutation_num_for_add = $random_num;
		}



			
			 $db->insert("comps_id,is_send,agr_poc,agr_poc2,agr_receiver,agr_status,add_date,send_date,sender_ip,qoutation_num","'$comid','1','$agr_poc','$agr_poc2','$agr_poc','1','$date','$date','$get_client_ip','$qoutation_num_for_add'","client_agreement_confg");
			 
			  		$table = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
					 
					<tr>
						Welcome!
 					</tr> 
					<tr>
						'.$comInfo['name'].',
 					</tr> 
					<tr>
						I want to thank you for requesting my services, The background screening services - I hope you’re closer to breaking into risk free environment after accepting the agreement sent via this email.<br>
Receive your copy of agreement by clicking below link.<br>
<a href="'.SURL.'qoutation_letter.php?qn='.$qoutation_num_for_add.'">Click Here</a><br>
The above link will take you to the page with The background check group agreement view.

 					</tr> 
 					</tbody>
				</table>';
		  emailTmp($table,'Agreement Information From BCG',"atta@xcluesiv.com","","","","","$fulname","");
		  
		  		$table2 = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
					 
					  
					<tr>
						Agreement sent to '.$comInfo['name'].' by '.$current_u_name.'.
 					</tr> 
					 
					 
					 
					</tbody>
				</table>';
				 
		  emailTmp($table2,'Agreement Information',"atta@xcluesiv.com","","","","","Operation","");

	
		}
		
		
		
		
		
		
		
 		else if($_REQUEST['edit'] == "yes")
		{
			if($comInfo['is_agreed'] == 1)
			{
				$agr_statusnn = 2;
				$app_rej_date = $active_data['app_rej_date'];
				$client_ip = $active_data['client_ip'];
			}
			else
			{
				$agr_statusnn = 1;
				$app_rej_date = '';
				$client_ip = '';
			}
		 
			
			$db->update("is_send='1',is_suspend_active='0',agr_poc='$agr_poc',agr_poc2='$agr_poc2',agr_receiver='$agr_poc',agr_status='$agr_statusnn',app_rej_date='$app_rej_date',send_date='$date',sender_ip='$get_client_ip',client_ip='$client_ip',is_user_exists='$is_user_exists'","client_agreement_confg","comps_id='$comid' and qoutation_num='$qoutation_num'");	
			
/*			 $db->insert("comps_id,is_send,agr_poc,agr_poc2,agr_receiver,agr_status,add_date,send_date,sender_ip,agr_version","'$comid','1','$agr_poc','$agr_poc2','$agr_poc','1','$date','$date','$get_client_ip','$random_num'","client_agreement_confg");
*/

			 		$table = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
					 
					<tr>
						Congratulations!
 					</tr> 
					 
					<tr>
						We heartedly greet you on modified agreement. Your needs are valuable to us!
Invest in yourself, of course!
<br>
Spend a tiny portion on intelligent screening services and protect yourself against adverse effects to business. We offer state-of-the-art report delivery structure which is backed by a personalized and focused customer service. We always go an extra mile to identify and complement our client\'s screening needs. We have a consultative approach with predictable pricing structure. We assure 100% state and FCRA compliance with innate applicant portal & manageable reporting.
<br>
Knowledge is an investment that has positive returns.
 					</tr> 
					<tr>
						I want to thank you for requesting my services, The background screening services - I hope you’re closer to breaking into risk free environment after accepting the agreement sent via this email.<br>
Receive your copy of agreement by clicking below link.<br>
<a href="'.SURL.'?action=agreement&atype=approval">Click Here</a><br>
The above link will take you to the page with The background check group Quotation view.

 					</tr> 
 					</tbody>
				</table>';
				//$fulname = $user_info['first_name']." ".$user_info['last_name'];
		  emailTmp($table,'Modifications/ Amendments to the Agreement',"atta@xcluesiv.com","","","","","$fulname","");
		  
		  		$table2 = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
					 
					  
					<tr>
						Modified Agreement Sent To '.$comInfo['name'].'  by '.$current_u_name.'.
 					</tr> 
					 
					 
					 
					</tbody>
				</table>';
				 
		  emailTmp($table2,'Modifications/ Amendments to the Agreement',"atta@xcluesiv.com","","","","","Operation","");

			
			
 		}
		
	//}
		//cEmail print_r($_REQUEST);
	}	
	
	

if(isset($_POST['sendfeedback_mang'])){
 
	 
	 
	 
 $uID = $_SESSION['user_id'];
 
		$comid = $_REQUEST['comid'];
 


 $feedback = $_POST['feedback_agreement'];

 		$agr_poc = $_REQUEST['agr_receiver'];
 		 
		 $get_client_ip = get_client_ip(); 

	$user_info = getUserInfo($agr_poc);
	$email = $user_info['email'];




 		$comInfo = getcompany($COMINF['id']);
					$comInfo = @mysql_fetch_array($comInfo);

				
  $get_client_ip = get_client_ip(); 	
					 
 
								$date = date("Y-m-d h:i:s");
				 

$db->insert("com_id,message,user_id,senddate","'$comid','$feedback','$uID','$date'","client_agreement_discussion");
  
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
 				$fulname = $user_info['first_name']." ".$user_info['last_name'];
		  emailTmp($table2,'Quotation Feedback',$email,"","","","","$fulname","");
 

 }

// by khl
if(isset($_POST['move_to_1st_step'])){

 moveCheckToFirstStep($_POST['ascase']);
	
}

	if(isset($_POST['download_letter'])){
	$ia_names = array();
	$letter_ref_num = array();
	$ddamount = array();
	$ddnumber = array();
	//var_dump($_POST['record_id']); die;
	foreach($_POST['record_id']  as $misID){ 
	$ia_names[] = $_POST['ia_name_'.$misID];
	$letter_ref_num[] = $_POST['letter_ref_num_'.$misID];
	$ddamount[] = $_POST['ddamount_'.$misID];
	$ddnumber[] = $_POST['ddnumber_'.$misID];
	$sent_date[] = $_POST['sent_date_'.$misID];
	}
	//die(var_dump($_POST['record_id']));
	if(count(@array_unique($ia_names))>1 || count(@array_unique($ia_names))==0){
		
		msg("err","Please select only one university.");
		
	}else if((!empty($letter_ref_num)) && (in_array('-',$letter_ref_num)) && (count(@array_unique($letter_ref_num))>1 || count(@array_unique($letter_ref_num))==0)){
		
		msg("err","Letter reference number is not correct.");
		
	} else if((!empty($ddamount)) && (in_array('-',$ddamount)) && (count(@array_unique($ddamount))>1 || count(@array_unique($ddamount))==0)){
		
		msg("err","DD Amount is not correct.");
		
	}else if((!empty($ddnumber)) && (in_array('-',$ddnumber)) && (count(@array_unique($ddnumber))>1 || count(@array_unique($ddnumber))==0)){
		
		msg("err","DD Number is not correct.");
		
	}else{
		
	$ia_name = @array_unique($ia_names);
	$letter_ref = @array_unique($letter_ref_num);
	$ddamnt = @array_unique($ddamount);
	$ddnum = @array_unique($ddnumber);
	$sentDate = @array_unique($sent_date);	
		
	if($ddnum[0]=='-' ||  $ddnum[0]==''){
		msg("err","DD Number is not correct.");
	}
	else if($ddamnt[0]=='' || $ddamnt[0]=='-'){
		msg("err","DD Amount is not correct.");
	}
	else{
		generateReferenceLetter($_POST,$ia_name,$letter_ref[0],$ddamnt,$ddnum,$sentDate);	
	}

	} 
	
	}
	
	// add / edit coupon code by khl
	if(isset($_REQUEST['add_coupon_code'])){
	add_coupon_code();
	}