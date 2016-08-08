<?php
		/* Developed by KHL */

		//sendSurveyFormToHR();
		function sendSurveyFormToHR($as_id,$company_name){
			global $db;
			//echo "sendSurveyFormToHR function working";
			$vCheck = getCheck(0,0,$as_id);
			$vData  = getVerdata($vCheck['v_id']);
			$comInfo = getInfo("company","id=$vData[com_id]");
			$VTInfo = getUserInfo($vCheck[user_id]);
			$vt_email = $VTInfo['email'];
			$vt_fullname = $userInfo['first_name']." ".$userInfo['last_name'];
			$group_email = 'mis@backcheckgroup.com';
			$sel = getData($as_id,'dmain');
			$rs = @mysql_fetch_assoc($sel);
			$CompanyName = $rs[d_value];
			//return true;
			$selComp = $db->select("comp_info2","*","cname LIKE '".$company_name."' LIMIT 1");
			$selData = $db->select("add_data","*","as_id = ".$as_id." and d_type='multy'");
			$resComp = @mysql_fetch_assoc($selComp);
			if((@mysql_num_rows($selComp)>0) && (@mysql_num_rows($selData)>0)){
			if($resComp[pocemail] != "" && $resComp[pocemail] != 'N/A')
			{
			
			$db->insert("as_id,is_send,CURRENT_TIMESTAMP","$as_id,1,dated","emp_survey_draft");	
				
				
			$emailBody = '<table cellpadding="0" cellspacing="0" border="0"><tr><td>We are contacting you on behalf of our client <strong>'.$comInfo[name].'</strong>, to request you to provide us with the verification of the <strong>'.$vData[v_name].'</strong>,  as a part of pre-employment screening process. We would appreciate if you could take a few minutes out of your schedule to confirm his employment at  <strong>'.$CompanyName.'</strong>. as your input is greatly valued. </p></td></tr>
			<tr><td>Please click below button/link to see the required information for cross check your record.</td></tr>
			<tr><td align="center" width="100%" colspan="3" bgcolor="#FFFFFF"><p style="padding:17px 17px;color:#54565c;font-size:13px">
			<a href="'.SURL.'/preemp_verification_inc.php?id='.base64_encode($as_id).'&em='.base64_encode($resComp[pocemail_clean]).'" style="color:#fff;background: #4caf50;text-decoration:none;padding: 10px 30px;font-size:13px;text-transform:uppercase;border-radius:68px;" target="_blank">Click Here</a></p></td></tr></table>';
			
			$subjectForVT = "A pre-employment survey email sent at $CompanyName";
			$subjectForHr = "Request for urgent Verification of antecedent - $vData[v_name]";
			
			$poc_emails = explode(',',$resComp[pocemail_clean]);
			foreach($poc_emails as $email){
			//emailTmp($emailBody,$subjectForHr,'khalique@xcluesiv.com','',$VTInfo,$group_email,'','Sir/Madam','');	
			
			
			//emailTmp($emailBody,$subjectForHr,'atta@xcluesiv.com','','','','',$resComp[pocname],'');	
			}
			
			$emailBody2 = '<table cellpadding="0" cellspacing="0" border="0"><tr><td>Pre-Employment verification email sent to <strong>'.$company_name.'</strong></td></tr></table>';
			
			$subjectForVT = "Pre-Employment verification email sent to <strong>".$company_name."</strong>";
 			//emailTmp($emailBody2,$subjectForVT."khalique@xcluesiv.com",'atta@xcluesiv.com','',$group_email,'','',$vt_fullname,'');	


			}
			else
			{
			$emailBody = '<table cellpadding="0" cellspacing="0" border="0"><tr><td>Company (<strong>'.$company_name.'</strong>) is found but email is not available. Please Contact Manually.</p></td></tr></table>';
			
			$subjectForVT = "Company (".$company_name.") Not Found. ";
 			//emailTmp($emailBody,$subjectForVT."khalique@xcluesiv.com",'atta@xcluesiv.com','',$group_email,'','','Sir/Madam','');	
			}
			
			// echo "sendSurveyFormToHR iffff form is working";
			 }
			else
			{
//echo "sendSurveyFormToHR else form is working";
			$emailBody = '<table cellpadding="0" cellspacing="0" border="0"><tr><td>Company (<strong>'.$company_name.'</strong>) is not found in our database. Please Contact Manually.</p></td></tr></table>';
			
			$subjectForVT = "Company (".$company_name.") Not Found. ";
			//$subjectForHr = "Request for urgent Verification of antecedent - $vData[v_name]";
			
			//$poc_emails = explode(',',$resComp[pocemail_clean]);
			//foreach($poc_emails as $email){
			//emailTmp($emailBody,$subjectForHr,'khalique@xcluesiv.com','',$VTInfo,$group_email,'','Sir/Madam','');	
			//emailTmp($emailBody,$subjectForVT."khalique@xcluesiv.com",'atta@xcluesiv.com','',$group_email,'','','Sir/Madam','');	
			//}
			
			
			}
			
			
			}
			
		// move a check to 1st step for insufficiency by khl
		function moveCheckToFirstStep($as_id){
		global $db;
		$isupd = $db->update("t_check=0,is_sufficient=0,sufficient_date=NULL","ver_checks","as_id=$as_id");
			if($isupd){
			addActivity('check_step',"Check move to first step for insufficieny.",2,'','',$as_id,'backtostep1');
			msg("sec","Check moved to first step successfully.");
		}else{
			msg("err","Problem occured while moving check back to 1st step.");
		}
		
		}
		
		// get company ids which can uncheck any component from thier package
		function getComidsCustomOrder(){
			 global $db;
			$selComids = $db->select("company","id","is_active=1 AND allow_custom_order=1");
			$comids_allow_uncheck = array();
			while($rsComids = @mysql_fetch_assoc($selComids)){
			$comids_allow_uncheck[] = 	$rsComids[id]; 
			}
			return $comids_allow_uncheck;
		 }
	 
	 
		// only single case upload v3
	 	function upload_case_only(){
			
			global $db,$COMINF,$LEVEL; 
			$uID = $_SESSION['user_id'];
				
			$order_typ = ((isset($_REQUEST['ord_typ'])))?$_REQUEST['ord_typ']:'';
					
			$any_error = false;
			$is_duplicat = (isset($_REQUEST['is_duplicat']))?true:false;
			if($LEVEL!=4){
				$company_id = (isset($COMINF['id']))?$COMINF['id']:$_REQUEST['clntid'];
				$lev = getLevel($LEVEL);
				$info_title = (isset($COMINF['name']))?$COMINF['name']:$lev['level_name'];
				$how_rec_checks = $_REQUEST['how_rec_checks'];
			}else{
				$company_id = $COMINF['id'];
				$info_title = $COMINF['name'];
				$how_rec_checks = "by_client";
				
				if(in_array($company_id,unserialize(CHECK_COMIDS))){
								
				$getUserInf = getUserInfo($uID);
				if($getUserInf['puser_id']==0 && $getUserInf['is_subuser']==0){
				$uID = (int) $_REQUEST['user_id'];	
				}
				}
			}
			
			$recdate = date("Y-m-d");
						
			if($_REQUEST['ERR']==''){
				$nums = 1;
				while(isset($_REQUEST['ename'.$nums])){
					if(isset($_REQUEST['case'.$nums])){
					$country = (int) (isset($_REQUEST['country']))?$_REQUEST['country']:171;
					if($country!=171){
					$AssignedToSys = 249; // user_id	Sadia=20 249=Sharjeel
					$AssignedToBitrix = 529; // bitrix user_id Sadia=480 529=Sharjeel
					$Work_Group_id = 18;
					$workgroupInfo = array(
					'AssignedToSys'=> $AssignedToSys,
					'AssignedToBitrix'=> $AssignedToBitrix,
					'Work_Group_id'=> $Work_Group_id
					);
					}
				
					$ename = addslashes($_REQUEST['ename'.$nums]);	
					$fname 	= (addslashes($_REQUEST['fname'.$nums])=='')?'N/A':addslashes($_REQUEST['fname'.$nums]);
					$empcode = addslashes($_REQUEST['empcode'.$nums]);
					$cnic = addslashes($_REQUEST['cnic'.$nums]);
					$comments = addslashes($_REQUEST['comments'.$nums]);
					$image='images/default.png';
					$thum= 'images/default.png';				
					if(isset($_REQUEST['image'.$nums])){
					$image = addslashes($_REQUEST['image'.$nums]);
					$thum = addslashes($_REQUEST['thum'.$nums]);
					}
					
					if($ename == ''){
					$errMsg = "Please type Applicant Name!";
					
					$any_error = true;
					}
					if($cnic == ''){
					$errMsg = "Please type ".ID_CARD_NUM."!";
					
					$any_error = true;
					}
					if($empcode == ''){
					$errMsg = "Please type ".CLIENT_REF_NUM."!";
					
					$any_error = true;
					}
						
					$checkEmpId = checkEmpId($empcode,1,$company_id);
					if($checkEmpId != 'not-found'){
					$errMsg = "Employee Code already exists ! $empcode";
					
					$any_error = true;
					}
					if(!$is_duplicat){
														
					$checkCnic = checkCnic($cnic,1,$company_id);
					
					if($checkCnic != 'not-found'){
					$errMsg = ID_CARD_NUM." already exists ! <br /> $cnic"; exit;
							
					$any_error = true;
					}
					}
					
					if($any_error) { 
					msg('err',$errMsg); 
					
					}
					
					if(!$any_error){
																
					$cols="thum,image,v_country,v_name,v_ftname,v_nic,v_comments,com_id,v_recdate,v_uadd, emp_id,blank_case";
					$values="'$thum','$image','$country','$ename','$fname','$cnic','$comments',$company_id,'$recdate',$uID, '".$empcode."',1";
					//echo "cols: ".$cols." values: ".$values; exit;
									
					$isInserted=$db->insert($cols,$values,"ver_data");
					
					// if case inserted successfully
					if($isInserted){
					$VID=$db->insertedID;
					$bCode = cBCode($company_id,$VID);
									
					// send to bitrix
					$lead_array=array();
					$lead_array['name']='Case For '.$ename ." - $bCode - ($info_title)";
					$lead_array['comment']="Gender : $gender
					Father Name : $fname
					NIC : $cnic
					Date of Birth : $dob
					Received Date : $recdate";
					$lead_array['user_id']='1';
					$lead_array['BIRTHDATE']=$dob;
					$lead_array['erpid']=$empcode;
					$lead_array['country_id']=$country;
					$bitrixlid=insertleads2($lead_array);
					$db->update("bitrixlid='$bitrixlid',v_bcode='$bCode'","ver_data","v_id=$VID");
								
					$any_error = false;
								
					// add attachments case wise
						
						$attachments=array();
						for($count=100;$count<=120;$count++){
										if(is_array($_REQUEST['docxs'.$nums.$count.$nums.'_1'])){
											foreach($_REQUEST['docxs'.$nums.$count.$nums.'_1'] as $key=>$docxs){
					
												$att_file_name 	= $_REQUEST['docxs_name'.$nums.$count.$nums.'_1'][$key]; 
												$att_file_path 	= $docxs; 
												
												$cols = "case_id,att_file_path,att_file_name";
												$values = "$VID,'$att_file_path','$att_file_name'";
												$attachments[]="Attachment Link : $att_file_path";
												$db->insert($cols,$values,'attachments');
											}
										}
									}
					
					}else{
						 msg('err',"Case [$ename] insertion error!");
					}
						$nums++;
					}
					}
				}
				
					
					 
					if(!$any_error && $_REQUEST['ERR']==''){
					msg("sec","Records added successfully...");	
					// insert notificaification to manager about new cases
					$a_info = ($_REQUEST['is_bulk']==1) ? "New Cases added with Bulk Uploaded by ".$_SESSION['fname']." ( $info_title ) " : "New Case Added by ".$_SESSION['fname']." ( $info_title ) ";
					 
					$notify = createNotifications(4,$a_info,$VID,'','','','');
					
					}
					
				}
		}
		
		// get last reopened check date 
		function getReopenedDate($as_id,$v_id=''){
			global $db; 
			if($v_id!=''){
			$sel = $db->select("activity","date(a_date) as reopened_date","v_id=$v_id AND a_type='case' AND a_actn='Opened' ORDER BY a_id");	
			}else{
			$sel = $db->select("activity","date(a_date) as reopened_date","ext_id=$as_id AND a_type='check' AND a_actn='Opened' ORDER BY a_id");
			}
			$rs = @mysql_fetch_assoc($sel);
			$reopened_date = ($rs['reopened_date']!='')?$rs['reopened_date']:'N/A';
			return $reopened_date;
		}
	 
	 function generateReferenceLetter($posted,$ia_name,$letter_ref_num='',$ddamnt=array(),$ddnum=array(),$sentDate=array()){
		global $db; 
		
	$indx = time().strtoupper(get_rand_val(10)).rand(10,99);
	$fileName = 'MIS_'.$indx.'.doc';	
	$getUniInfo = getInfo("uni_info","uni_Name='$ia_name[0]'");
	$is_uniDDR = $getUniInfo['uni_nfe'];
	$letter_to_sent = $getUniInfo['letter_to_add'];
	
	$sentDate = ((!empty($sentDate[0])) && $sentDate[0]!='-')?$sentDate[0]:date("Y-m-d H:i:s");
	
	$letter_ref_num = (($letter_ref_num!='') && $letter_ref_num!='-')?$letter_ref_num:generateRefNum();
	
	
	@header("Content-type: application/vnd.ms-word");
	@header("Content-Disposition: attachment; Filename=$fileName");
	
	?>
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reference Letter</title>
	</head>

	<body>
	<p>Dated: <?php echo date("Y-m-d",strtotime($sentDate));?>                                                                                          Ref.  No. 
	<?php echo $letter_ref_num;?> </p>
	<p>To,</p>
	<p><?php echo ($letter_to_sent!='' && $letter_to_sent!='-' && $letter_to_sent!='N/A')?$letter_to_sent:'The Controller of Examinations';?>,<br />
	  <?php echo  $ia_name[0];?> </p>
	<p><strong>Subject:          <u>Verification of Educational  Qualifications</u></strong></p>
	<p>Dear Respected,<br />
	  I am contacting you  to request verification of an educational qualification granted by your institution  to the attached certificate(s) holder(s) as a part of the immigration screening  process that we are conducting on behalf of our client. </p>
	<table border="1" cellspacing="0" cellpadding="0" width="642">
	  <tr>
	  <td width="54"><p align="center"><strong>Sr. #</strong></p></td>
		<td width="155"><p align="center"><strong>Name of Candidate</strong></p></td>
		<td width="111"><p align="center"><strong>Qualification</strong></p></td>
	  <?php if(count($posted['record_id'])>1){?>
		<td width="54"><p align="center"><strong>Sr. #</strong></p></td>
		<td width="155"><p align="center"><strong>Name of Candidate</strong></p></td>
		<td width="111"><p align="center"><strong>Qualification</strong></p></td>
	  <?php } ?>
	  
	  </tr>
	  <tr>
	  <?php 
	  $c=0;
	  $cc=0;
	  foreach($posted['record_id']  as $misID){ 
	  $c++;
	  $cc++;
	   $selRec = $db->select("mis_management_system","*","misID=$misID");
	  // echo "select * from mis_management_system where  misID=$misID"; exit;
	    $db->update("letter_ref_num='$letter_ref_num',sent_date='$sentDate',status='WIP'","mis_management_system","misID=$misID");
	   $rsRec = @mysql_fetch_assoc($selRec);
			?>
	  
		<td width="54"><p align="center"><?php echo $c;?></p></td>
		<td width="155"><p align="center"><?php echo urldecode($rsRec['candidateName']);?></p></td>
		<td width="111"><p align="center"><?php echo urldecode($rsRec['qualification_detail']);?></p></td>
	   <?php 
	   if($cc==2){
			echo "</tr><tr>";
			$cc=0;	
			} 
	   ?>
	  
	  
	  <?php

	  }?>
	 
	  </tr>
	</table>
	<p>I would be most  grateful if you could take few minutes to verify the enclosed copy(s) of  Certificate(s) and courier your inputs to us.</p>
	<p><strong>Please contact me if you have any queries</strong><strong>. </strong>Thank you in anticipation of your assistance.<strong></strong></p>
	<p>&nbsp;</p>
	<p>Regards,</p>
	<p><strong>&nbsp;</strong></p>
	<p><strong>&nbsp;</strong></p>
	<p>Faisal Khan | Global Operations<br />
	  <em><strong>Background Check Group</strong></em><em><strong> </strong></em></p>
	<p>E-mail:   <a href="mailto:faisal@backcheckgroup.com">faisal@backcheckgroup.com</a></p>
	<?php if($is_uniDDR==1){?>
	<p><strong><u>Enclosed: </u></strong><br />
	  Demand  Draft(s) number ( <strong><u><?php echo $ddnum[0]; ?></u></strong>) sum  of Rs. (<strong><?php echo number_format($ddamnt[0])?>/-</strong>).</p>
	<?php } ?>
	
	</body>
	</html>
	
	<?
	
	 } 
	 
	 
	 
	 
	 // add / edit coupon code by khl
	 
	 function add_coupon_code(){
		$db = new DB();
		
		
		$usr_email_add = trim($_REQUEST['usr_email_add']);
		
		$selec_prod = implode(",",$_REQUEST['selec_prod']);
		$date_ = date("Y-m-d");
		//print_r($selec_prod);exit;
		if(trim($_REQUEST['coupon_code'])=='') msg('err',"Please input coupon code!");
		if(trim($_REQUEST['coupon_type'])=='discount') { 
		if(trim($_REQUEST['price'])=='') { 
		msg('err',"Please input Discount Percent!");
		}
		}
		if(trim($_REQUEST['max_count_use'])=='') msg('err',"Please input max number of attempts!");
		if(trim($_REQUEST['valid_from'])=='') msg('err',"Please input valid from!");
		if(trim($_REQUEST['valid_to'])=='') msg('err',"Please input valid to!");
		
		
		

		if($_REQUEST['ERR']==''){	

		if(is_numeric($_REQUEST['couponid'])){
			$lID = $_REQUEST['couponid'];
			
						 
				$para = "coupon_code='$_REQUEST[coupon_code]',description='$_REQUEST[description]',coupon_type='$_REQUEST[coupon_type]',price='$_REQUEST[price]',`max_count_use`='$_REQUEST[max_count_use]',valid_from='$_REQUEST[valid_from]',valid_to='$_REQUEST[valid_to]',status='$_REQUEST[status]',selected_prod='$selec_prod',usr_email_add='$usr_email_add'";
				
				//echo "update coupon_code set $para where id=$_REQUEST[couponid]";
				$isIncUp = $db->update($para,"coupon_code","id=$_REQUEST[couponid]");
				msg('sec',"Coupon Code updated successfully!");
					
				$typ = 'Updat';			

		}
		// for add
		else{
			
			
				//,'$selec_prod' ,selected_prod
			$coupons = $db->select("coupon_code","id","coupon_code LIKE '$_REQUEST[coupon_code]'");
			if(@mysql_num_rows($coupons)==0){
				$values = "'$_REQUEST[coupon_code]','$_REQUEST[coupon_type]','$_REQUEST[price]','$_REQUEST[max_count_use]','$_REQUEST[valid_from]','$_REQUEST[valid_to]','$_REQUEST[description]','$_REQUEST[status]','$selec_prod','$usr_email_add'";
				
				$cols   = "coupon_code,coupon_type,price,max_count_use,valid_from,valid_to,description,status,selected_prod,usr_email_add";
				//echo "INSERT INTO coupon_code ".$cols." values(".$values.") ";
				$isIncUp = $db->insert($cols,$values,"coupon_code");
				$lID = $db->insertedID;
				$_POST = array();
				$_REQUEST = array();
				msg('sec',"New Coupon Code inserted successfully!");
				$typ = 'insert';
			}else{
				msg('err',"Coupon Code [$_REQUEST[coupon_code]] already exist!");
				return false;			
			}
		}
					
			}
		}

 	 
	 function selBitrixTasks(){
		 $ch = curl_init();
	
	$query_string="action=sel_statuses";
	//echo $query_string; die;
    curl_setopt($ch,CURLOPT_URL, BITRIX_URL);
    // Set a referer
   curl_setopt($ch, CURLOPT_HEADER, FALSE);
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
    // Download the given URL, and return output
    $output = curl_exec($ch);
	$info=json_decode($output);
   $msg=$info->data;
	//$db->update("bitrix_id='$bitrixuid'","users","user_id=".(int)$user_arr['user_id']."");
    // Close the cURL resource, and free system resources
	
  curl_close($ch);
  
   return  $msg;
	 }
	 
	 	 
// FUNCTION FOR GET OCCRP api's data by ATA (START)	 
	 
	 
	function occrp_details($id,$page=''){
	$ch = curl_init();//echo 'ataaaa';

									//	echo "https://data.occrp.org/api/1/query?q=".$fullname;
										//$query_string="limit=30&offset=0&q=".$fullname;
										if($page != "") 
										{$pages = $page;}
										else
										{$pages =  '1';}
										//echo "https://data.occrp.org/api/1/documents/".$id."/pages/".$pages;
						 curl_setopt($ch, CURLOPT_URL,"https://data.occrp.org/api/1/documents/".$id."/pages/".$pages);
											// Set a referer
										   curl_setopt($ch, CURLOPT_HEADER, FALSE);
											// Should cURL return or print out the data? (true = return, false = print)
											curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
											//curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
											// Download the given URL, and return output
											$output = curl_exec($ch);
											//print_r(json_encode($output));
										$r = mb_convert_encoding($output,'ISO-8859-1','utf-8');
										$more_details=json_decode($output);
									//	print_r($arr);
									return $more_details;
										// Close the cURL resource, and free system resources
											curl_close($ch);
					}						
											
		
	function get_occrp_data_api($fullname,$limit=5,$offset=0)
	{
	//echo "https://data.occrp.org/api/1/query?limit=".$limit."&offset=".$offset."&q=".urlencode($fullname);
	$ch = curl_init();
 	$query_string="q=".$fullname;
	curl_setopt($ch, CURLOPT_URL,"https://data.occrp.org/api/1/query?limit=".$limit."&offset=".$offset."&q=".urlencode($fullname));
 	curl_setopt($ch, CURLOPT_HEADER, FALSE);
 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 	$output = curl_exec($ch);
 	$r = mb_convert_encoding($output,'ISO-8859-1','utf-8');
	$arr=json_decode($output);
 	curl_close($ch);
	return $arr;
 
	}		

// FUNCTION FOR GET OCCRP api's data by ATA (END)	 
											

	 function getInsuffComments($as_id,$att_id=''){
		global $db;
		$InsuffComments = "";
		 $whereBy = ($att_id!='')?' att.att_id='.$att_id:' vc.as_id='.$as_id;
		 $cols = "att_comments,date(att_insuff_date) as att_insuff_date";
		 $where = " $whereBy AND (as_status='Insufficient' AND att_insuff=1) AND as_isdlt=0  AND v_isdlt=0 GROUP BY vc.as_id";
		 $tbl = "ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id INNER JOIN checks c ON c.checks_id=vc.checks_id LEFT JOIN `attachments` att ON att.checks_id=vc.as_id ";
		 $sel = $db->select($tbl,$cols, $where);
		 if(@mysql_num_rows( $sel)>0){
		 while($rs = @mysql_fetch_assoc($sel)){
			$InsuffComments .= "[$rs[att_insuff_date]] $rs[att_comments]";
		 }
			 
		 }
		 
		 
		 return $InsuffComments;		 
		
	 }
	 
	 
	 function getDatesOneMonth($current_month='',$current_year=''){
	$dates = array();
	$today = date("d");
	$thisMonth = date("m");
	$lastDay = date("t");
	
	

	
	$current_month = (!empty($current_month))?$current_month:date("m");
	$current_year = (!empty($current_year))?$current_year:date("Y");
	//$zeroM = ($current_month<10)?'0':'';
	//echo $current_month;
	$lastDay = date("t", strtotime($current_year.'-'.$current_month.'-1'));
	
	if($thisMonth>$current_month){
	$dayss = $lastDay;
	}else{
	$dayss = $today;	
	}
	for($i=1; $i<=$dayss; $i++){
	$dates[] = 	$current_year.'-'.$current_month;
	}
	
	return $dates;
}
	
	function generateRefNum($lastGenerated=0){
		global $db;
		// format BCG-OPS-073016-1
		$letter_ref_number = "BCG-OPS-".date('dmy')."-".time();
		$sel = $db->select("mis_management_system","letter_ref_num"," letter_ref_num is not null AND  letter_ref_num LIKE 'BCG-OPS%' order by misID desc limit 1");
		$rs = @mysql_fetch_assoc($sel);
		$letter_ref_num_arr = explode('-',$rs['letter_ref_num']);
		$letter_ref_num = (int)$letter_ref_num_arr[3];
		$lastGenerated = ($lastGenerated!=0)?$lastGenerated:($letter_ref_num!=0)?$letter_ref_num+1:0;
		if(is_numeric($lastGenerated) && $lastGenerated>0){
		$letter_ref_number = "BCG-OPS-".date('dmy')."-".$lastGenerated;
		}
		
		return $letter_ref_number;
		
		
	}
	
	
	// by khl
	function getAllSavvionIANames(){
	global $db;
	$ia_names = array();
	$sel1 = $db->select("records","DISTINCT(EDU_ia_name) AS ia_name","EDU_ia_name <> ''");
	while($rs = @mysql_fetch_assoc($sel1)){
	$ia_names[] = 	urldecode(convertUCWords(utf8_encode(addslashes(trim($rs['ia_name'])))));
	}
	$sel2 = $db->select("records","DISTINCT(EMP_ia_name) AS ia_name","EDU_ia_name <> ''");
	while($rs = @mysql_fetch_assoc($sel2)){
	$ia_names[] = 	urldecode(convertUCWords(utf8_encode(addslashes(trim($rs['ia_name'])))));
	}
	$sel3 = $db->select("records","DISTINCT(HTL_ia_name) AS ia_name","EDU_ia_name <> ''");
	while($rs = @mysql_fetch_assoc($sel3)){
	$ia_names[] = 	urldecode(convertUCWords(utf8_encode(addslashes(trim($rs['ia_name'])))));
	}
	
	return $ia_names;
}