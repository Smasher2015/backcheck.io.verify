<?php 
	
											// ATA CODE START HERE ///

function addsavvioncheck(){
	
	global $db,$COMINF,$LEVEL;
	$analyst_Id = $_SESSION['user_id'];
 
		if (preg_match('/ED/',$_REQUEST['subbarcode'])){
			$tab_value = 1;
			$init = "EDU_";
			$savv_checkId = $data['primid'];
		}
		if (preg_match('/EM/',$_REQUEST['subbarcode'])){
			$tab_value = 2;
			$init = "EMP_";
			$savv_checkId = $data['primid'];
		}
		if (preg_match('/HL/',$_REQUEST['subbarcode'])){
			$tab_value = 3;
			$init = "HLT_";
			$savv_checkId = $data['primid'];
		}	
	

	 
	 
	 
	 
switch ($init) {
    case "HLT_":
       include ('forhealth.php');
        break;
    case "EMP_":
       include ('foremply.php');
        break;
    case "EDU_":
       include ('foreducation.php');
        break;
}



	 
	$sentaddsavvioncheck = $_REQUEST['sentaddsavvioncheck'];
		if($sentaddsavvioncheck)
		{
		$Phraseology_Vals =	array('VT023','VT024','VT025','VT026','VT027','VT028','VT031','VT021','VT033','VT034','VT035','VT036','VT037','VT022','VT020','VT012','VT013','VT003','VT004','VT005','VT014','VT015','VT016','VT001','VT038','VT039','VT007','VT008','VT009','VT010','VT030','VT006','VT029','VT011','VT002');
			
			// by khl start
		$Phraseology      = $_REQUEST['Phraseology'];
 
		$Phras = array();
		foreach($Phraseology as $key => $Phraseo){
	  
		if(is_numeric($Phraseo) && $Phraseo==0){
	  
		}else{
		$Phras['phar']=$Phraseo; 
		}
		}
		$Phraseology2 = ($Phras['phar']!="")?$Phras['phar']:0;
			
			// by khl end
			
			
			$bitrixtid = $_REQUEST['bitrixtid'];
			if($_REQUEST['SpokeTo'] != '' && $_REQUEST['Designation'] != '' && $_REQUEST['ModeOfVerification'] != '' && $_REQUEST['ModeOfVerification'] != '0' && $Phraseology2 != '' && $Phraseology2 != '0' && $_REQUEST['VStatus'] != '' && $_REQUEST['VStatus'] != '0' && $_REQUEST['VStatus'] != 'Phraseology_Select' && strlen($_REQUEST['historynew']) > 5 )
			{
	//echo "it is working".$bitrixtid;
	
			$cols = 'qa_status';
			$values = '2';
			
			$cols2 = 'bot_status';
			$values2 = '1';
	
	
			$isAddEdit = $db->updateCol($cols,$values,'records',"bitrixtid=$bitrixtid");
			$isAddEdit = $db->updateCol($cols2,$values2,'records',"bitrixtid=$bitrixtid");
			msg("sec","Check Close And Send To Bot Successfully.");	
			?>
            <script>
			 alert("Check Close And Send To Bot Successfully.");
			</script>
            <?php
			}
			else
			{
				
				
				
			if($_REQUEST['SpokeTo'] == '')
			{
			msg('err',"Please Fill Spoke To.");
			?>
            <script>
			 alert("Please Fill Spoke To.");
			</script>
            <?php
			}
				
			if($_REQUEST['Designation'] == '')
			{
			msg('err',"Please Fill Designation.");
			?>
            <script>
			 alert("Please Fill Designation.");
			</script>
            <?php
			}
			
		 

			if($_REQUEST['ModeOfVerification'] == '' || $_REQUEST['ModeOfVerification'] == '0' )
			{
			msg('err',"Please Fill Mode Of Verification.");
			?>
            <script>
			 alert("Please Fill Mode Of Verification.");
			</script>
            <?php
			}
			if($Phraseology2 == '' || $Phraseology2 == '0' )
			{
			msg('err',"Please Select Phraseology.");
			?>
            <script>
			 alert("Please Select Phraseology.");
			</script>
            <?php
			}
			 
			if($_REQUEST['VStatus'] == '' || $_REQUEST['VStatus'] == '0' || $_REQUEST['VStatus'] == 'Phraseology_Select')
			{
			msg('err',"Please Select Verification Status.");
			?>
            <script>
			 alert("Please Select Verification Status.");
			</script>
            <?php
			}
			if(5 > strlen(trim($_REQUEST['historynew'])))
			{
			msg('err',"Please Type History Remarks.");
			?>
            <script>
			 alert("Please Type History Remarks.");
			</script>
            <?php
			}

			
			}
	
		}
	

	 
	 











	 
	//echo $analyst_Id, die;
//	$savvion_check_id  = $_REQUEST['savvion_check_id'];
//	//echo 'savvion_check_id'.$savvion_check_id;
//	$Barcode 				= urlencode($_REQUEST['Barcode']); 
//	$ApplicantName 			= $_REQUEST['ApplicantName'];
//	$SubBarcode 			= urlencode($_REQUEST['SubBarcode']); 
//	$ClientName 			= urlencode($_REQUEST['ClientName']); 
//	$ClientRefNo 			= urlencode($_REQUEST['ClientRefNo']); 
//	$DateOfBirth 			= $_REQUEST['DateOfBirth']; 
//	$PassportNo 			= urlencode($_REQUEST['PassportNo']); 
//	$AKAName 				= $_REQUEST['AKAName']; 
//	$Gender 				= $_REQUEST['Gender']; 
//	$Nationality 			= urlencode($_REQUEST['Nationality']); 
//	$ArabicName 			= urlencode($_REQUEST['ArabicName']); 
//	$_UNBOUND_textArea3 	= urlencode($_REQUEST['_UNBOUND_textArea3']); 
//	$HistoryRemarks 		= urlencode($_REQUEST['HistoryRemarks']); 
//	$_UNBOUND_historyNew 	= urlencode($_REQUEST['_UNBOUND_historyNew']); 
//	$CommentsForECT 		= urlencode($_REQUEST['CommentsForECT']); 
//	$is_error 				= urlencode($_REQUEST['is_error']); 
//	$is_duplicate 			= urlencode($_REQUEST['is_duplicate']); 
//
//	
//	
//	
//	$Education_UniversityName 		= urlencode($_REQUEST['Education_UniversityName']);
//	$Education_UniversityAddress 	= urlencode($_REQUEST['Education_UniversityAddress']);
//	$Education_City 				= urlencode($_REQUEST['Education_City']);
//	$Education_Country 				= urlencode($_REQUEST['Education_Country']);
//	$Education_Telephone 			= urlencode($_REQUEST['Education_Telephone']);
//	$IA_Name 						= urlencode($_REQUEST['IA_Name']);
//	$IA_Address 					= urlencode($_REQUEST['IA_Address']);
//	$IA_City 						= urlencode($_REQUEST['IA_City']);
//	$IA_Country 					= urlencode($_REQUEST['IA_Country']);
//	$IA_Fax 						= urlencode($_REQUEST['IA_Fax']);
//	$IA_Email 						= urlencode($_REQUEST['IA_Email']);
//	$IA_WebAddress 					= urlencode($_REQUEST['IA_WebAddress']);
//	$IA_IsFake 						= urlencode($_REQUEST['IA_IsFake']);
//	$IA_IsOnline 					= urlencode($_REQUEST['IA_IsOnline']);
//	$IA_Telephone 					= urlencode($_REQUEST['IA_Telephone']);
//	
//	
//	$Employment_CompanyName 		= urlencode($_REQUEST['Employment_CompanyName']);
//	$Employment_CompanyAddress 		= urlencode($_REQUEST['Employment_CompanyAddress']);
//	$Employment_City 				= urlencode($_REQUEST['Employment_City']);
//	$Employment_Country 			= urlencode($_REQUEST['Employment_Country']);
//	$Employment_Telephone 			= urlencode($_REQUEST['Employment_Telephone']);
//	$Employment_WebAddress 			= urlencode($_REQUEST['Employment_WebAddress']);
//	$IA_ContactPerson 				= urlencode($_REQUEST['IA_ContactPerson']);
//	$checkName 						= urlencode($_REQUEST['checkName']);
	
	//$IA_Name 						= $_REQUEST['IA_Name'];
	//$IA_Address 					= $_REQUEST['IA_Address'];
	//$IA_City 						= $_REQUEST['IA_City'];
	//$IA_Country 					= $_REQUEST['IA_Country'];
	//$IA_Telephone 					= $_REQUEST['IA_Telephone'];
	//$IA_Fax 						= $_REQUEST['IA_Fax'];
	//$IA_WebAddress 					= $_REQUEST['IA_WebAddress'];
	//$IA_Email 						= $_REQUEST['IA_Email'];
	
	
//	$HltLicense_AuthorityName 		= urlencode($_REQUEST['HltLicense_AuthorityName']);
//	$HltLicense_AuthorityAddress 	= urlencode($_REQUEST['HltLicense_AuthorityAddress']);
//	$HltLicense_City 				= urlencode($_REQUEST['HltLicense_City']);
//	$HltLicense_Country 			= urlencode($_REQUEST['HltLicense_Country']);
//	$HltLicense_Telephone 			= urlencode($_REQUEST['HltLicense_Telephone']);
//	$HltLicense_WebAddress 			= urlencode($_REQUEST['HltLicense_WebAddress']);
	//$IA_Name 						= $_REQUEST['IA_Name'];
	//$IA_Address 					= $_REQUEST['IA_Address'];
	//$IA_City 						= $_REQUEST['IA_City'];
	//$IA_Country 					= $_REQUEST['IA_Country'];
	//$IA_Telephone 					= $_REQUEST['IA_Telephone'];
	//$IA_Fax 						= $_REQUEST['IA_Fax'];
	//$IA_Email 						= $_REQUEST['IA_Email'];
	//$IA_WebAddress 					= $_REQUEST['IA_WebAddress'];
	
	
	
	
	//$sentaddsavvioncheck 					= $_REQUEST['sentaddsavvioncheck'];
	
	
	
	//$savvion_key 					= $_REQUEST['savvion_key'];
	//$savvion_value 					= $_REQUEST['savvion_value'];
	//print_r($savvion_key);
	//echo "<br> Vals:<br>";
	//print_r($savvion_value);die;
	//$array_combine 					= array_combine($savvion_key,$savvion_value);
	//echo 'savvion_key', print_r($savvion_key);
	//echo 'savvion_value', print_r($savvion_value);
	//echo 'array_combine', print_r($array_combine);
/*	if($savvion_check_id){
		$savvion_editkey 					= $_REQUEST['editkey'];
		$edit_array_combine = array_combine($savvion_key,$savvion_value);
		//print_r($edit_array_combine);die;

		$result = array();
		foreach ($savvion_editkey as $id => $key) {
			$result[$key] = array(
			'savvion_key'  => $savvion_key[$id],
			'savvion_value' => $savvion_value[$id],
			'savvion_editkey'    => $savvion_editkey[$id],
			);
		}

		
	}
*/	
	/* Attachment */ 
		/*$ids 							= $_REQUEST['ids'];
		$sp_attachment 					= $_FILES['sp_attachment'];
		//print_r($sp_attachment);die;		
		$result_att = array();
			foreach ($ids as $id => $key) {
				$result_att[$key] = array(
				'sp_attachment'    => 	$sp_attachment[$id],
				'name'    => 	$sp_attachment['name'][$id],
				'tmp_name'    => 	$sp_attachment['tmp_name'][$id],
				
				);
			}*/
		
	/* Attachment */
	
	
	//print_r($result);die;
	
//	$checksCode  = $db->select("checks_savvion","*","");
//	
//	while($rsc = mysql_fetch_assoc($checksCode)){
//	
//	if(strpos($SubBarcode,$rsc['short_title'])=== false){
//		
//	}else{
//		$selTL = $db->select("savvion_teamlead_checks","team_lead_id"," checks_id=$rsc[checks_id]");
//		$rsTL = mysql_fetch_assoc($selTL);
//		$team_lead_id = $rsTL['team_lead_id'];
//	}
//		
//	}
	//die(var_dump($team_lead_id));
	
	//if($SubBarcode == '') msg('err',"Please Enter Reference No!");
//	if($ClientName == '') msg('err',"Please Enter Client Name!");
//	if($ClientRefNo == '') msg('err',"Please Enter Client Reference No!");
//	if($DateOfBirth == '') msg('err',"Please Enter Date Of Birth!");
//	if($PassportNo == '') msg('err',"Please Enter Passport No!");
//	if($AKAName == '') msg('err',"Please Enter AKAName!");
//	if($Gender == '') msg('err',"Please Enter Gender!");
//	if($Nationality == '') msg('err',"Please Enter Nationality!");
//	if($ArabicName == '') msg('err',"Please Enter Arabic Name!");
//	if($_UNBOUND_textArea3 == '') msg('err',"Please Enter CRM Remarks!");
//	if($HistoryRemarks == '') msg('err',"Please Enter History Remarks!");
//	if($_UNBOUND_historyNew == '') msg('err',"Please Enter Notes Input Box!");
	
//	$SpokeTo 						= urlencode($_REQUEST['SpokeTo']);
//	$Designation 					= urlencode($_REQUEST['Designation']);
//	$Department 					= urlencode($_REQUEST['Department']);
//	$VStatus 						= urlencode($_REQUEST['VStatus']);
//	$Phraseology 					= urlencode($_REQUEST['Phraseology']);
//	$VerificationLanguage 			= urlencode($_REQUEST['VerificationLanguage']);
//	$ModeOfVerification 			= urlencode($_REQUEST['ModeOfVerification']);
//	$initiatedByName 				= urlencode($_REQUEST['initiatedByName']);
//	$VerificationFee 				= urlencode($_REQUEST['VerificationFee']);
//	$PaymentDate 					= urlencode($_REQUEST['PaymentDate']);
//	$PaymentApprovalDate 			= urlencode($_REQUEST['PaymentApprovalDate']);
//	$PaymentInFavourof 				= urlencode($_REQUEST['PaymentInFavourof']);
//	$TransactionID 					= urlencode($_REQUEST['TransactionID']);
//	$paymentModTypeID 				= urlencode($_REQUEST['paymentModTypeID']);
//	$otherCardNam 					= urlencode($_REQUEST['otherCardNam']);
//	$Currency 						= urlencode($_REQUEST['Currency']);
//	$transactionAmt 				= urlencode($_REQUEST['transactionAmt']);
//	$otherCardNumber 				= urlencode($_REQUEST['otherCardNumber']);
//	$checkCategory 					= urlencode($_REQUEST['checkCategory']);
//	$checkSubCategory 				= urlencode($_REQUEST['checkSubCategory']);
//	$VerificationComment 			= urlencode($_REQUEST['VerificationComment']);
//	$inDivPhraseology 				= urlencode($_REQUEST['inDivPhraseology']);
//	$InsufficiencyComment 			= urlencode($_REQUEST['InsufficiencyComment']);
//
//	
//	
//
//		$cols = "
//		Barcode,
//		ApplicantName,
//		SubBarcode,
//		ClientName,
//		ClientRefNo,
//		DateOfBirth,
//		PassportNo,
//		AKAName,
//		Gender,
//		Nationality,
//		ArabicName,
//		Education_UniversityName,
//		Education_UniversityAddress,
//		Education_City,
//		Education_Country,
//		Education_Telephone,
//		IA_Name,
//		IA_Address,
//		IA_City,
//		IA_Country,
//		IA_Fax,
//		IA_Email,
//		IA_WebAddress,
//		IA_IsFake,
//		IA_IsOnline,
//		Employment_CompanyName,
//		Employment_CompanyAddress,
//		Employment_City,
//		Employment_Country,
//		Employment_Telephone,
//		Employment_WebAddress,
//		IA_Telephone,
//		IA_ContactPerson,
//		HltLicense_AuthorityName,
//		HltLicense_AuthorityAddress,
//		HltLicense_City,
//		HltLicense_Country,
//		HltLicense_Telephone,
//		HltLicense_WebAddress,
//		_UNBOUND_textArea3,
//		HistoryRemarks,
//		_UNBOUND_historyNew,
//		CommentsForECT,
//		is_error,
//		team_lead_id,
//		SpokeTo,
//		Designation,
//		Department,
//		VStatus,
//		Phraseology,
//		VerificationLanguage,
//		ModeOfVerification ,
//		initiatedByName,
//		VerificationFee,
//		PaymentDate,
//		PaymentApprovalDate,
//		PaymentInFavourof,
//		TransactionID,
//		paymentModTypeID,
//		otherCardNam,
//		Currency,
//		transactionAmt,
//		otherCardNumber,
//		checkCategory,
//		checkSubCategory,
//		VerificationComment,
//		inDivPhraseology,
//		InsufficiencyComment,
//		is_duplicate
//		
//		";
//	$values = "
//		'$Barcode',
//		'$ApplicantName',
//		'$SubBarcode',
//		'$ClientName',
//		'$ClientRefNo',
//		'$DateOfBirth',
//		'$PassportNo',
//		'$AKAName',
//		'$Gender',
//		'$Nationality',
//		'$ArabicName',
//		'$Education_UniversityName',
//		'$Education_UniversityAddress',
//		'$Education_City',
//		'$Education_Country',
//		'$Education_Telephone',
//		'$IA_Name',
//		'$IA_Address',
//		'$IA_City',
//		'$IA_Country',
//		'$IA_Fax',
//		'$IA_Email',
//		'$IA_WebAddress',
//		'$IA_IsFake',
//		'$IA_IsOnline',
//		'$Employment_CompanyName',
//		'$Employment_CompanyAddress',
//		'$Employment_City',
//		'$Employment_Country',
//		'$Employment_Telephone',
//		'$Employment_WebAddress',
//		'$IA_Telephone',
//		'$IA_ContactPerson',
//		'$HltLicense_AuthorityName',
//		'$HltLicense_AuthorityAddress',
//		'$HltLicense_City',
//		'$HltLicense_Country',
//		'$HltLicense_Telephone',
//		'$HltLicense_WebAddress',
//		'$_UNBOUND_textArea3',
//		'$HistoryRemarks',
//		'$_UNBOUND_historyNew',
//		'$CommentsForECT',
//		'$is_error',
//		'$team_lead_id',
//		'$SpokeTo',
//		'$Designation',
//		'$Department',
//		'$VStatus',
//		'$Phraseology',
//		'$VerificationLanguage',
//		'$ModeOfVerification' ,
//		'$initiatedByName',
//		'$VerificationFee',
//		'$PaymentDate',
//		'$PaymentApprovalDate',
//		'$PaymentInFavourof',
//		'$TransactionID',
//		'$paymentModTypeID',
//		'$otherCardNam',
//		'$Currency',
//		'$transactionAmt',
//		'$otherCardNumber',
//		'$checkCategory',
//		'$checkSubCategory',
//		'$VerificationComment',
//		'$inDivPhraseology',
//		'$InsufficiencyComment',
//		'$is_duplicate'
//		";
//	
//			if($_REQUEST['ERR']==''){
//				
//					$data_table = 
//							'<table width="100%" border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">
//							<tr>
//								<th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Applicant Name</th>
//								<th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Sub Barcode</th>
//								<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Check Title</th>
//							</tr>';
//					$data_table .= 
//							'<tr>
//								<td width="30%" style="font-size:12px; padding:5px;">'.$ApplicantName.'</td>
//								<td width="30%" style="font-size:12px; padding:5px;">'.$SubBarcode.'</td>
//								<td width="25%" style="font-size:12px; padding:5px;">'.$checkName.'</td>
//							</tr>';
//					$data_table .= '</table>';
//					$email_title = 'New check has been created on Savvion. Sub Barcode ['.$SubBarcode.']';	
//
//
//					
//					$check_data = $db->select("savvion_check","*","SubBarcode = '$SubBarcode'");
//					//echo $savvion_check_id;die;
//					if(mysql_num_rows($check_data)>0 && $savvion_check_id==''){
//								msg('err',"SubBarcode is Already Exists!");
//					}else{
//			
//				if($savvion_check_id){
//						if($sentaddsavvioncheck){
//							$cols .= ',status,bot_status';
//							$values .= ',2,1';
//							$isAddEdit = $db->updateCol($cols,$values,'savvion_check',"id=$savvion_check_id");
//							foreach($result as $data){
//								$key = $data['savvion_key'];
//								$val = $data['savvion_value'];
//								$savvion_editkey = 	$data['savvion_editkey'];
//								$cols_ver = "savvion_key,savvion_value";
//								$value_ver = "'$key','$val'";
//								$isEditKey = $db->updateCol($cols_ver,$value_ver,'savvion_check_values',"savvion_check_id=$savvion_check_id and scv_id=$savvion_editkey");
//							}
//							foreach($result_att as $attach){
//								$attachment_name = 	getUniqueFilename($attach);
//								$cols_attach = "
//									sv_id,
//									at_attachment
//									";
//								$values_attach = "
//									'$savvion_check_id',
//									'$attachment_name'
//									";
//								if($attach['name']){
//										$target_dir = "files/savvionAttachments/";
//										$target_file = $target_dir . basename($attachment_name);
//										$uploadOk = 1;
//										$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//										// Check if image file is a actual image or fake image
//										$check = getimagesize($attach["tmp_name"]);
//											if($check !== false) {
//												//echo "File is an image - " . $check["mime"] . ".";
//												$uploadOk = 1;
//											} else {
//												 msg('err',"File is not an image!");
//												$error =1;
//												$uploadOk = 0;
//											}
//											// Check if file already exists
//											if (file_exists($target_file)) {
//												msg('err',"Sorry, file already exists!");
//												$uploadOk = 0;
//												$error =1;
//											}
//											// Check file size
//											if(isset($attachment_name["size"])){
//											if ($attachment_name["size"] > 500000) {
//												msg('err',"Sorry, your file is too large!");
//												$uploadOk = 0;
//												$error =1;
//											}}
//											// Allow certain file formats
//											if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
//												msg('err',"Sorry, only JPG, JPEG, PNG & GIF files are allowed!");
//												$uploadOk = 0;
//												$error =1;
//											}
//											// Check if $uploadOk is set to 0 by an error
//											if ($uploadOk == 0) {
//												msg('err',"Sorry, your file was not uploaded!");
//												$error =1;
//											// if everything is ok, try to upload file
//											} else {
//												if (move_uploaded_file($attach["tmp_name"], $target_file)) {
//													$attach_ins_values = $db->insert($cols_attach,$values_attach,'savvion_attach');
//													//msg('sec',"The file ". basename( $sp_attachment_name). " has been uploaded!");
//												} else {
//													echo '9';
//													msg('err',"Sorry, there was an error uploading your file!");
//													$error =1;
//												}
//											}	
//						
//									}
//							}
//							$_REQUEST['check'] = $savvion_check_id;
//							$_REQUEST['edit'] = 'edit';
//							msg('sec',"Record Updated Successfully and sent to QC...");
//						}else{
//							$cols .= ',bot_status';
//							$values .= ',0';
//							$isAddEdit = $db->updateCol($cols,$values,'savvion_check',"id=$savvion_check_id");
//							foreach($result as $data){
//								$key = $data['savvion_key'];
//								$val = $data['savvion_value'];
//								$savvion_editkey = 	$data['savvion_editkey'];
//								$cols_ver = "savvion_key,savvion_value";
//								$value_ver = "'$key','$val'";
//								$isEditKey = $db->updateCol($cols_ver,$value_ver,'savvion_check_values',"savvion_check_id=$savvion_check_id and scv_id=$savvion_editkey");
//							}
//							foreach($result_att as $attach){
//								$attachment_name = 	getUniqueFilename($attach);
//								$cols_attach = "
//									sv_id,
//									at_attachment
//									";
//								$values_attach = "
//									'$savvion_check_id',
//									'$attachment_name'
//									";
//								if($attach['name']){
//										$target_dir = "files/savvionAttachments/";
//										$target_file = $target_dir . basename($attachment_name);
//										$uploadOk = 1;
//										$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//										// Check if image file is a actual image or fake image
//										$check = getimagesize($attach["tmp_name"]);
//											if($check !== false) {
//												//echo "File is an image - " . $check["mime"] . ".";
//												$uploadOk = 1;
//											} else {
//												 msg('err',"File is not an image!");
//												$error =1;
//												$uploadOk = 0;
//											}
//											// Check if file already exists
//											if (file_exists($target_file)) {
//												msg('err',"Sorry, file already exists!");
//												$uploadOk = 0;
//												$error =1;
//											}
//											// Check file size
//											if(isset($attachment_name["size"])){
//											if ($attachment_name["size"] > 500000) {
//												msg('err',"Sorry, your file is too large!");
//												$uploadOk = 0;
//												$error =1;
//											}}
//											// Allow certain file formats
//											if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
//												msg('err',"Sorry, only JPG, JPEG, PNG & GIF files are allowed!");
//												$uploadOk = 0;
//												$error =1;
//											}
//											// Check if $uploadOk is set to 0 by an error
//											if ($uploadOk == 0) {
//												msg('err',"Sorry, your file was not uploaded!");
//												$error =1;
//											// if everything is ok, try to upload file
//											} else {
//												if (move_uploaded_file($attach["tmp_name"], $target_file)) {
//													$attach_ins_values = $db->insert($cols_attach,$values_attach,'savvion_attach');
//													//msg('sec',"The file ". basename( $sp_attachment_name). " has been uploaded!");
//												} else {
//													echo '9';
//													msg('err',"Sorry, there was an error uploading your file!");
//													$error =1;
//												}
//											}	
//						
//									}
//							}
//							$_REQUEST['check'] = $savvion_check_id;
//							$_REQUEST['edit'] = 'edit';
//							msg('sec',"Record Updated Successfully...");
//
//						}
//					}else{
//						
//						if($sentaddsavvioncheck){
//							$analyst_Id = ($team_lead_id!="")?$team_lead_id:$analyst_Id;
//							if($LEVEL==10 || $LEVEL==3){
//								$cols .= ',user_id';
//								$values .= ',$analyst_Id';
//							}
//
//							$cols .= ',status,bot_status';
//							$values .= ',2,1';
//							//print_r($savvion_key);
//							//print_r($savvion_value);
//							
//							 
//							
//							$ins = $db->insert($cols,$values,'savvion_check');
//							$_REQUEST['SubBarcode'] = $db->insertedID;
//							
//							$in_id = $db->insertedID;
//							foreach($array_combine as $key => $val){
//							$cols_ver = "savvion_check_id,savvion_key,savvion_value";
//							$value_ver = "$in_id,'$key','$val'";
//							
//							//echo "Insert into savvion_check_values ($cols_ver) VALUES ($value_ver) <br>";
//							
//							$ins_values = $db->insert($cols_ver,$value_ver,'savvion_check_values');
//							}
//							
//							/* Attachment */
//							foreach($result_att as $attach){
//								$attachment_name = 	getUniqueFilename($attach);
//								$cols_attach = "
//									sv_id,
//									at_attachment
//									";
//								$values_attach = "
//									'$in_id',
//									'$attachment_name'
//									";
//								if($attach['name']){
//										$target_dir = "files/savvionAttachments/";
//										$target_file = $target_dir . basename($attachment_name);
//										$uploadOk = 1;
//										$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//										// Check if image file is a actual image or fake image
//										$check = getimagesize($attach["tmp_name"]);
//											if($check !== false) {
//												//echo "File is an image - " . $check["mime"] . ".";
//												$uploadOk = 1;
//											} else {
//												 msg('err',"File is not an image!");
//												$error =1;
//												$uploadOk = 0;
//											}
//											// Check if file already exists
//											if (file_exists($target_file)) {
//												msg('err',"Sorry, file already exists!");
//												$uploadOk = 0;
//												$error =1;
//											}
//											// Check file size
//											if(isset($attachment_name["size"])){
//											if ($attachment_name["size"] > 500000) {
//												msg('err',"Sorry, your file is too large!");
//												$uploadOk = 0;
//												$error =1;
//											}}
//											// Allow certain file formats
//											if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
//												msg('err',"Sorry, only JPG, JPEG, PNG & GIF files are allowed!");
//												$uploadOk = 0;
//												$error =1;
//											}
//											// Check if $uploadOk is set to 0 by an error
//											if ($uploadOk == 0) {
//												msg('err',"Sorry, your file was not uploaded!");
//												$error =1;
//											// if everything is ok, try to upload file
//											} else {
//												if (move_uploaded_file($attach["tmp_name"], $target_file)) {
//													$attach_ins_values = $db->insert($cols_attach,$values_attach,'savvion_attach');
//													//msg('sec',"The file ". basename( $sp_attachment_name). " has been uploaded!");
//												} else {
//													echo '9';
//													msg('err',"Sorry, there was an error uploading your file!");
//													$error =1;
//												}
//											}	
//						
//									}
//							}
//							/* Attachment */
//							//emailTmp( $data_table, $email_title,'ceo@backcheckgroup.com','','erum@backcheckgroup.com','','','Danish');
//							msg('sec',"Record Inserted and sent to QC...");
//							
//						}else{
//							if($LEVEL==10 || $LEVEL==3){
//								$analyst_Id = ($team_lead_id!="")?$team_lead_id:$analyst_Id;
//								$cols .= ',user_id';
//								$values .= ','.$analyst_Id.'';
//							}
//							$ins = $db->insert($cols,$values,'savvion_check');
//							$_REQUEST['SubBarcode'] = $db->insertedID;
//							
//							$in_id = $db->insertedID;
//							foreach($array_combine as $key => $val){
//							$cols_ver = "savvion_check_id,savvion_key,savvion_value";
//							$value_ver = "$in_id,'$key','$val'";
//							//echo "Insert into savvion_check_values ($cols_ver) VALUES ($value_ver) <br>";
//							$ins_values = $db->insert($cols_ver,$value_ver,'savvion_check_values');
//							}
//							/* Attachment */
//							foreach($result_att as $attach){
//								$attachment_name = 	getUniqueFilename($attach);
//								$cols_attach = "
//									sv_id,
//									at_attachment
//									";
//								$values_attach = "
//									'$in_id',
//									'$attachment_name'
//									";
//								if($attach['name']){
//										$target_dir = "files/savvionAttachments/";
//										$target_file = $target_dir . basename($attachment_name);
//										$uploadOk = 1;
//										$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//										// Check if image file is a actual image or fake image
//										$check = getimagesize($attach["tmp_name"]);
//											if($check !== false) {
//												//echo "File is an image - " . $check["mime"] . ".";
//												$uploadOk = 1;
//											} else {
//												 msg('err',"File is not an image!");
//												$error =1;
//												$uploadOk = 0;
//											}
//											// Check if file already exists
//											if (file_exists($target_file)) {
//												msg('err',"Sorry, file already exists!");
//												$uploadOk = 0;
//												$error =1;
//											}
//											// Check file size
//											if(isset($attachment_name["size"])){
//											if ($attachment_name["size"] > 500000) {
//												msg('err',"Sorry, your file is too large!");
//												$uploadOk = 0;
//												$error =1;
//											}}
//											// Allow certain file formats
//											if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
//												msg('err',"Sorry, only JPG, JPEG, PNG & GIF files are allowed!");
//												$uploadOk = 0;
//												$error =1;
//											}
//											// Check if $uploadOk is set to 0 by an error
//											if ($uploadOk == 0) {
//												msg('err',"Sorry, your file was not uploaded!");
//												$error =1;
//											// if everything is ok, try to upload file
//											} else {
//												if (move_uploaded_file($attach["tmp_name"], $target_file)) {
//													$attach_ins_values = $db->insert($cols_attach,$values_attach,'savvion_attach');
//													//msg('sec',"The file ". basename( $sp_attachment_name). " has been uploaded!");
//												} else {
//													echo '9';
//													msg('err',"Sorry, there was an error uploading your file!");
//													$error =1;
//												}
//											}	
//						
//									}
//							}
//							/* Attachment */
//							//emailTmp( $data_table, $email_title,'ceo@backcheckgroup.com','','erum@backcheckgroup.com','','','Danish');
//							msg('sec',"Record Inserted Successfully...");
//						}
//		
//				}
//				}
//				
//			}
	
	}









											 
											// ATA CODE END HERE ///






	function deleteImage(){
		global $db;
		$at_id  = $_REQUEST['at_id'];
		$DelRecord = $db->select("savvion_attach","*","at_id=$at_id");
		$res = mysql_fetch_assoc($DelRecord);
		$re_at_id = $res['at_id'];
		if($re_at_id){
			$target_dir = "files/savvionAttachments/";
			$target_file = $target_dir . basename($res['at_attachment']);
			if (file_exists($target_file)) {
				$db->delete("savvion_attach","at_id=$re_at_id");
				@unlink($target_file);
				msg('sec',"Attachment Removed Successfully...");
				$_REQUEST['check'] = $res['sv_id'];
				$_REQUEST['edit'] = 'edit';

			}

		}
	}
	
	function getcheckname($checkID,$savv_check_id){
		global $db;
		
		//echo 	'savv_check_id' . $savv_check_id;
		if(is_numeric($savv_check_id)){
				$query = $db->select("records","*","primid=$savv_check_id");
				if(mysql_num_rows($query) >0){
				$data  =  mysql_fetch_assoc($query);
				}
				$_REQUEST['Education_UniversityName']		=$data['Education_UniversityName'];
				$_REQUEST['Education_UniversityAddress']	=$data['Education_UniversityAddress'];
				$_REQUEST['Education_City']					=$data['Education_City'];
				$_REQUEST['Education_Country']				=$data['Education_Country'];
				$_REQUEST['Education_Telephone']			=$data['Education_Telephone'];
				$_REQUEST['IA_Name']						=$data['IA_Name'];
				$_REQUEST['IA_Address']						=$data['IA_Address'];
				$_REQUEST['IA_City']						=$data['IA_City'];
				$_REQUEST['IA_Country']						=$data['IA_Country'];
				$_REQUEST['IA_Fax']							=$data['IA_Fax'];
				$_REQUEST['IA_Email']						=$data['IA_Email'];
				$_REQUEST['IA_WebAddress']					=$data['IA_WebAddress'];
				$_REQUEST['IA_IsFake']						=$data['IA_IsFake'];
				$_REQUEST['IA_IsOnline']					=$data['IA_IsOnline'];
				$_REQUEST['IA_Telephone']					=$data['IA_Telephone'];
				$_REQUEST['Employment_CompanyName']			=$data['Employment_CompanyName'];
				$_REQUEST['Employment_CompanyAddress']		=$data['Employment_CompanyAddress'];
				$_REQUEST['Employment_City']				=$data['Employment_City'];
				$_REQUEST['Employment_Country']				=$data['Employment_Country'];
				$_REQUEST['Employment_Telephone']			=$data['Employment_Telephone'];
				$_REQUEST['Employment_WebAddress']			=$data['Employment_WebAddress'];
				$_REQUEST['IA_ContactPerson']				=$data['IA_ContactPerson'];
				$_REQUEST['HltLicense_AuthorityName']		=$data['HltLicense_AuthorityName'];
				$_REQUEST['HltLicense_AuthorityAddress']	=$data['HltLicense_AuthorityAddress'];
				$_REQUEST['HltLicense_City']				=$data['HltLicense_City'];
				$_REQUEST['HltLicense_Country']				=$data['HltLicense_Country'];
				$_REQUEST['HltLicense_Telephone']			=$data['HltLicense_Telephone'];
				$_REQUEST['HltLicense_WebAddress']			=$data['HltLicense_WebAddress'];
				
	
				$editValues   = $db->select("savvion_check_values","*","savvion_check_id=$savv_check_id");
				$savvion_key_edit 		= array();
				$savvion_value_edit		= array();
				$index = 0;
				while($eVal = mysql_fetch_assoc($editValues)){
					$savvion_key_edit[$index] 		= $eVal['savvion_key'];
					$savvion_value_edit[$index]		= $eVal['savvion_value'];
					$savvion_value_id[$index]		= $eVal['scv_id'];
				$index++;
				}
				//$array_combine_edit 	= array_combine($savvion_key_edit,$savvion_value_edit);
				
				//print_r($savvion_key_edit);
				//print_r($savvion_value_edit);


		}
		
		$Qualification = $db->select("savvion_qualification","*"); 
	    $qua_options = '<option value="Select">Select</option>';
		$showHid_Div= 'display:none;';
		while($Qua =mysql_fetch_array($Qualification)){ 
			
			
			
			
			 $qua_options .= '<option  value="'.$Qua['sq_id'].'" ';
			 
			 
			 if(is_numeric(urldecode($data['EDU_QualificationSelect_Ver']))){
				
			if($data['EDU_QualificationSelect_Ver'] == $Qua['sq_id']){
				$qua_options .= 'selected="selected"';
				$showHid_Div = 'display:none;';
				$otherVal = "";
				$save_val_sel="EDU_QualificationSelect_Ver";
				$save_val_txt="";
			}
			}else{
			
			if($Qua['sq_id']==26){
				$qua_options .= 'selected="selected"';
				$showHid_Div ='display:block;';
				$otherVal = $data['EDU_Qualification_Ver'];
				$save_val_sel="";
				$save_val_txt="EDU_Qualification_Ver";
			}
			}
			 
			 $qua_options .= ' >'.ucwords($Qua['sq_name']).'</option>';
		}
		if(urldecode($data['EDU_DegreeType_Ver'])==""){
		$deg_options1 = (urldecode($data['EDU_Education_DegreeType']) == 'POST GRADUATE') ? 'selected="selected"':'';
		$deg_options2 = (urldecode($data['EDU_Education_DegreeType']) == 'PRE UNIVERSITY') ? 'selected="selected"':'';
		$deg_options3 = (urldecode($data['EDU_Education_DegreeType']) == 'PROFESSIONAL CERTIFICATE') ? 'selected="selected"':'';
		$deg_options4 = (urldecode($data['EDU_Education_DegreeType']) == 'UNIVERSITY') ? 'selected="selected"':'';	
		}else{
		$deg_options1 = (urldecode($data['EDU_DegreeType_Ver']) == 'POST GRADUATE') ? 'selected="selected"':'';
		$deg_options2 = (urldecode($data['EDU_DegreeType_Ver']) == 'PRE UNIVERSITY') ? 'selected="selected"':'';
		$deg_options3 = (urldecode($data['EDU_DegreeType_Ver']) == 'PROFESSIONAL CERTIFICATE') ? 'selected="selected"':'';
		$deg_options4 = (urldecode($data['EDU_DegreeType_Ver']) == 'UNIVERSITY') ? 'selected="selected"':'';
		}
				
		$deg_options = '
				<option value="Select" >Select</option>
				<option value="POST GRADUATE" '.$deg_options1.' >POST GRADUATE</option>
				<option value="PRE UNIVERSITY" '.$deg_options2.'>PRE UNIVERSITY</option>
				<option value="PROFESSIONAL CERTIFICATE" '.$deg_options3.'>PROFESSIONAL CERTIFICATE</option>
				<option value="UNIVERSITY" '.$deg_options4.'>UNIVERSITY</option>
		';
		if(urldecode($data['EDU_textField33']) ==""){
		$gra_options_value1 = (urldecode($data['EDU_Education_IsGraduate']) == 'yes') ? 'selected="selected"':'';
		$gra_options_value2 = (urldecode($data['EDU_Education_IsGraduate']) == 'no') ? 'selected="selected"':'';	
		}else{
		$gra_options_value1 = (urldecode($data['EDU_textField33']) == 'yes') ? 'selected="selected"':'';
		$gra_options_value2 = (urldecode($data['EDU_textField33']) == 'no') ? 'selected="selected"':'';	
		}
		$gra_options_key1 	= (urldecode($data['EDU_DegreeType_Ver']) == 'yes') ? 'selected="selected"':'';
		$gra_options_key2 	= (urldecode($data['EDU_DegreeType_Ver']) == 'no') ? 'selected="selected"':'';
		

		$gra_options_key = '												
				<option value="yes" '.$gra_options_key1.'>Yes</option>
				<option value="no" '.$gra_options_key2.'>No</option>
		';
		$gra_options_value = '												
		<option value="yes" '.$gra_options_value1.'>Yes</option>
		<option value="no" '.$gra_options_value2.'>No</option>
		';
		
		
		
		if(urldecode($data['EDU_textField35'])==""){
		$com_options_value1 = (urldecode($data['EDU_Education_LastYear']) == 1) ? 'selected="selected"':'';
		$com_options_value2 = (urldecode($data['EDU_Education_LastYear']) == 2) ? 'selected="selected"':'';
		$com_options_value3 = (urldecode($data['EDU_Education_LastYear']) == 3) ? 'selected="selected"':'';
		$com_options_value4 = (urldecode($data['EDU_Education_LastYear']) == 4) ? 'selected="selected"':'';
		}else{
		$com_options_value1 = (urldecode($data['EDU_textField35']) == 1) ? 'selected="selected"':'';
		$com_options_value2 = (urldecode($data['EDU_textField35']) == 2) ? 'selected="selected"':'';
		$com_options_value3 = (urldecode($data['EDU_textField35']) == 3) ? 'selected="selected"':'';
		$com_options_value4 = (urldecode($data['EDU_textField35']) == 4) ? 'selected="selected"':'';	
		}
		$com_options_key1 	= (urldecode($data['EDU_Education_LastYear']) == 1) ? 'selected="selected"':'';
		$com_options_key2 	= (urldecode($data['EDU_Education_LastYear']) == 2) ? 'selected="selected"':'';
		$com_options_key3 	= (urldecode($data['EDU_Education_LastYear']) == 3) ? 'selected="selected"':'';
		$com_options_key4 	= (urldecode($data['EDU_Education_LastYear']) == 4) ? 'selected="selected"':'';

		

		$com_options_key =			'
				<option value="">Select</option>
				<option value="1" '.$com_options_key1.'>1</option>
				<option value="2" '.$com_options_key2.'>2</option>
				<option value="3" '.$com_options_key3.'>3</option>
				<option value="4" '.$com_options_key4.'>4</option>';
		$com_options_value =			'
				<option value="" >Select</option>
				<option value="1" '.$com_options_value1.'>1</option>
				<option value="2" '.$com_options_value2.'>2</option>
				<option value="3" '.$com_options_value3.'>3</option>
				<option value="4" '.$com_options_value4.'>4</option>';
				
		if(urldecode($data['EDU_textField135'])==""){
		$time_options_value1 	= (urldecode($data['EDU_Education_Timing']) == 'full time') ? 'selected="selected"':'';
		$time_options_value2 	= (urldecode($data['EDU_Education_Timing']) == 'part time') ? 'selected="selected"':'';	
		}else{
		$time_options_value1 	= (urldecode($data['EDU_textField135']) == 'full time') ? 'selected="selected"':'';
		$time_options_value2 	= (urldecode($data['EDU_textField135']) == 'part time') ? 'selected="selected"':'';	
		}
		$time_options_key1 	= (urldecode($data['EDU_Education_Timing']) == 'full time') ? 'selected="selected"':'';
		$time_options_key2 	= (urldecode($data['EDU_Education_Timing']) == 'part time') ? 'selected="selected"':'';

		


		$time_options_key =		'	
				<option value="Select">Select</option>
				<option value="full time"  '.$time_options_key1.'>Full Time</option>
				<option value="part time"  '.$time_options_key2.'>Part Time</option>';
		$time_options_value =		'	
				<option value="Select">Select</option>
				<option value="full time" '.$time_options_value1.'>Full Time</option>
				<option value="part time" '.$time_options_value2.'>Part Time</option>';
				
				
				
				

		$education = '<div  id="eduction">
                                <div class="list-group-item">
                                <h4 class="section-title">Education</h4>
									<div class="savvion-eduction-box1">
                                	<h5 class="active">University Details as per Applicant <span>View Details</span></h5>
									<div class="savvion-eduction-box1-1">
									<input type="hidden" name="checkName" value="Education" />
									
                                    <div class="form-group">
                                    	<label for="Education_UniversityName">University Name: </label>
                                    	'.urldecode($data['EDU_universityname']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="Education_UniversityAddress">University Address:  </label>
                                    	'.urldecode($data['EDU_universityaddress']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="Education_City">City:  </label>
                                    	'.$data['EDU_city'].'
                                    </div>
                                    <div class="form-group">
                                    	<label for="Education_Country">Country:  </label>
                                    	'.$data['EDU_country'].'
                                    </div>
                                    <div class="form-group">
                                    	<label for="Education_Telephone">Telelphone:  </label>
                                    	'.$data['EDU_telephone'].'
                                    </div>
									<div class="clearfix"></div>
									</div>
									</div>
									<div class="savvion-eduction-box2">
									<h5>University Details as per Masters <span>View Details</span></h5>
									<div class="savvion-eduction-box2-1">
                                    <div class="form-group">
                                    	<label for="EDU_ia_name">University Name: </label>
                                    	'.urldecode($data['EDU_ia_name']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="EDU_ia_address">University Address:  </label>
                                    	'.urldecode($data['EDU_ia_address']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="EDU_ia_city">City:  </label>
                                    	'.urldecode($data['EDU_ia_city']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="EDU_ia_country">Country:  </label>
                                    	'.$data['EDU_ia_country'].'
                                    </div>
									<div class="form-group">
                                    	<label for="EDU_ia_telephone">Telephone:  </label>
                                    	'.urldecode($data['EDU_ia_telephone']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="EDU_ia_fax">Fax No:   </label>
                                    	'.urldecode($data['EDU_ia_fax']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="EDU_ia_email">Email ID:  </label>
                                    	'.urldecode($data['EDU_ia_email']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="EDU_ia_webaddress">Web Address:  </label>
                                    	'.urldecode($data['EDU_ia_webaddress']).'
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                        <div class="checker"><span><input disabled="disabled" name="EDU_ia_isfake" value="1"  type="checkbox"  '.(urldecode($data['EDU_ia_isfake'])==1?'checked':'').'></span></div>
                                        	Is Fake? 
                                        </label>
                                        <label class="checkbox-inline">
                                        <div class="checker"><span><input disabled="disabled" name="EDU_ia_isonline" value="1"  type="checkbox" '.(urldecode($data['EDU_ia_isonline'])==1?'checked':'').'></span></div>
                                        Is Online ?
                                        </label>
                                    </div>
									<div class="clearfix"></div>
									</div>
									</div>
									<div class="savvion-eduction-box3">
									<h5>Verify Details <span>View Details</span></h5>
									<div class="savvion-eduction-box3-1">
										<div class="form-group">
											<label></label>
											<div class="txt">To Verify</div>
											<div class="btn_move"></div>
											<div class="txt">Verification Values</div>
										</div>
										<div class="form-group">
											<label for="Name">Name:  </label>
											<input id="EDU_Education_ApplicantName" type="text" name="EDU_Education_ApplicantName" id="Name" value="'.urldecode($data['EDU_Education_ApplicantName']).'"  class="form-control" placeholder="Name" disabled="disabled">
											<div class="btn_move"></div>
											<input id="EDU_ApplicantName_Ver" type="text" name="EDU_ApplicantName_Ver"  value="';
											
										$education .=((urldecode($data['EDU_ApplicantName_Ver'])=="N/A") || ((urldecode($data['EDU_ApplicantName_Ver'])=="-") && ($data['is_edit_fields'])==0))?urldecode($data['EDU_Education_ApplicantName']):urldecode($data['EDU_ApplicantName_Ver']);
											
											$education .='"  class="form-control" placeholder="Name Value">
											
										</div>
										<div class="form-group">
											<label for="EDU_Education_Qualification">Qualification:  </label>
											<input type="text" name="EDU_Education_Qualification" id="EDU_Education_Qualification" value="'.urldecode($data['EDU_Education_Qualification']).'"  class="form-control" placeholder="Qualification" disabled="disabled">
											<div class="btn_move"></div>
										 <input class="form-control" id="" placeholder="Qualification" type="text" name="EDU_Qualification_Ver" value="';
										$education .=((urldecode($data['EDU_Qualification_Ver'])=="N/A") || ((urldecode($data['EDU_Qualification_Ver'])=="-") && (($data['is_edit_fields'])==0)))?urldecode($data['EDU_Education_Qualification']):urldecode($data['EDU_Qualification_Ver']);
										
										$education .='" /> 
											
											
										</div>
										
										<div class="form-group">
											<label for="EDU_Education_MajorSubject">Major Subject:  </label>
											<input type="text" name="EDU_Education_MajorSubject" id="EDU_Education_MajorSubject" value="'.urldecode($data['EDU_Education_MajorSubject']).'"  class="form-control" placeholder="Major Subject" disabled="disabled">
											<div class="btn_move"></div>
											<input type="text" name="EDU_MajorSubject_Ver" value="';
											
											$education .=((urldecode($data['EDU_MajorSubject_Ver'])=="N/A") || ((urldecode($data['EDU_MajorSubject_Ver'])=="-") && (($data['is_edit_fields'])==0)))?urldecode($data['EDU_Education_MajorSubject']):urldecode($data['EDU_MajorSubject_Ver']);
											
											$education .='"  class="form-control" placeholder="Major Subject Value">
											
										</div>
										<div class="form-group">
											<label for="EDU_Education_DegreeType">Degree Type:  </label>
											<input type="text" name="EDU_Education_DegreeType" id="EDU_Education_DegreeType" value="'.urldecode($data['EDU_Education_DegreeType']).'"  class="form-control" placeholder="Degree Type" disabled="disabled">
											<div class="btn_move"></div>
											<select class="form-control"  name="EDU_DegreeType_Ver">
												'.$deg_options.'
											</select>
											
										</div>
										<div class="form-group">
											<label for="EDU_Education_QualConferredDate">Conferred Date:  </label>
											<input type="text" name="EDU_Education_QualConferredDate" id="EDU_Education_QualConferredDate" value="'.urldecode($data['EDU_Education_QualConferredDate']).'"  class="datetimepicker-month form-control" placeholder="Conferred Date" disabled="disabled">
											<div class="btn_move"></div>
											<input type="text" name="EDU_TextField_dateTime1"  value="';
											
											$education .=((urldecode($data['EDU_TextField_dateTime1'])=="N/A") || ((urldecode($data['EDU_TextField_dateTime1'])=="-") && (($data['is_edit_fields'])==0)))?urldecode($data['EDU_Education_QualConferredDate']):urldecode($data['EDU_TextField_dateTime1']);
											
											
											$education .='"  class="datetimepicker-month form-control" placeholder="Conferred Date Value">
											
										</div>
										<div class="form-group">
											<label for="EDU_Education_AttendanceFrom">Attendance From:  </label>
											<input type="text" name="EDU_Education_AttendanceFrom" id="EDU_Education_AttendanceFrom" value="'.urldecode($data['EDU_Education_AttendanceFrom']).'"  class="datetimepicker-month form-control" placeholder="Attendance From" disabled="disabled">
											<div class="btn_move"></div>
											<input type="text" name="EDU_TextField_dateTime5" value="';
											
											
											$education .=((urldecode($data['EDU_TextField_dateTime5'])=="N/A") || ((urldecode($data['EDU_TextField_dateTime5'])=="-") && (($data['is_edit_fields'])==0)))?urldecode($data['EDU_Education_AttendanceFrom']):urldecode($data['EDU_TextField_dateTime5']);
											
											
											$education .='"  class="datetimepicker-month form-control" placeholder="Attendance From Value">
											
											
											
										</div>
										<div class="form-group">
											<label for="EDU_Education_AttendanceTo">Attendance To:  </label>
											<input type="text" name="EDU_Education_AttendanceTo" id="EDU_Education_AttendanceTo" value="'.urldecode($data['EDU_Education_AttendanceTo']).'"  class="datetimepicker-month form-control" placeholder="Attendance To" disabled="disabled">
											<div class="btn_move"></div>
											<input type="text" name="EDU_TextField_dateTime6" value="';
											
											$education .=((urldecode($data['EDU_TextField_dateTime6'])=="N/A") || ((urldecode($data['EDU_TextField_dateTime6'])=="-") && (($data['is_edit_fields'])==0)))?urldecode($data['EDU_Education_AttendanceTo']):urldecode($data['EDU_TextField_dateTime6']);
											
											$education .='"  class="datetimepicker-month form-control" placeholder="Attendance To Value">
											
										</div>
										<div class="form-group">
											<label for="EDU_Education_IsGraduate">Is Graduate:  </label>
											<select class="form-control" id="EDU_Education_IsGraduate" name="EDU_Education_IsGraduate" disabled="disabled">
												'.$gra_options_key.'
											</select>
											<div class="btn_move"></div>
											<select class="form-control" name="EDU_textField33">
												'.$gra_options_value.'
											</select>
											
										</div>
										<div class="form-group">
											<label for="EDU_Education_LastYear">If No, then Last Year Completed:  </label>
											<select class="form-control" id="EDU_Education_LastYear" name="EDU_Education_LastYear" disabled="disabled">
												'.$com_options_key.'
											</select>
											<div class="btn_move"></div>
											<select class="form-control" name="EDU_textField35">
												'.$com_options_value.'
											</select>
										
										</div>
										<div class="form-group">
											<label for="Timing">Timing:  </label>
											<select class="form-control" id="Timing" name="EDU_Education_Timing" disabled="disabled">
												'.$time_options_key.'
											</select>
											<div class="btn_move"></div>
											<select class="form-control" name="EDU_textField135">
												'.$time_options_value.'
											</select>
											
										</div>
										</div>
										<div class="clearfix"></div>
										</div>
                                </div>
                                </div>';
		 $emp_desig = urldecode($data['EMP_Designation_Ver']);
		 				
		if(is_numeric($emp_desig))
		{
			$where = "sd_id=$emp_desig";
		
						
		$Designation = $db->select("savvion_designation","*",$where); 
	     
		$Desig =mysql_fetch_array($Designation);
		$select_Desig = ucwords($Desig['sd_designation']);
		}
		else if($emp_desig != "-" && $emp_desig != "" && (!is_numeric($emp_desig)))
		{
			$select_Desig = urldecode($data['EMP_Designation_Ver']);
		}
		else if($emp_desig == "-" || $emp_desig == "")
		{
			$select_Desig = urldecode($data['EMP_Employment_Designation']);
		}
		else
		{$select_Desig = '';}		



/*		$Designation = $db->select("savvion_designation","*",$where); 
	    $Desig_options = '';
		while($Desig =mysql_fetch_array($Designation)){ 
			$select_Desig = (urldecode($data['EMP_Designation_Ver']) == $Desig['sd_id']) ? 'selected="selected"':'';
			 $Desig_options .= '<option  value="'.$Desig['sd_id'].'" '.$select_Desig.'>'.ucwords($Desig['sd_designation']).'</option>';
		}
*/

		$Relative_Owned_Business_key_1 	= (urldecode($data['EMP_Employment_IsEmpByFamily']) == 'yes') ? 'selected="selected"':'';
		$Relative_Owned_Business_key_2 	= (urldecode($data['EMP_Employment_IsEmpByFamily']) == 'no') ? 'selected="selected"':'';
		$Relative_Owned_Business_value_1 = (urldecode($data['EMP_IsEmpByFamily_Ver']) == 'yes') ? 'selected="selected"':'';
		$Relative_Owned_Business_value_2 = (urldecode($data['EMP_IsEmpByFamily_Ver']) == 'no') ? 'selected="selected"':'';

		$Relative_Owned_Business_key = '												
				<option value="yes" '.$Relative_Owned_Business_key_1.'>Yes</option>
				<option value="no" '.$Relative_Owned_Business_key_2.'>No</option>
		';
		$Relative_Owned_Business_value = '												
		<option value="yes" '.$Relative_Owned_Business_value_1.'>Yes</option>
		<option value="no" '.$Relative_Owned_Business_value_2.'>No</option>
		';
		
		
		$EMP_Salary_Ver = ((urldecode($data['EMP_Salary_Ver'])=="N/A") || ((urldecode($data['EMP_Salary_Ver'])=="-") && ($data['is_edit_fields'])==0)) ? urldecode($data['EMP_Employment_Salary']):urldecode($data['EMP_Salary_Ver']);

		$EMP_StartDate_Ver = ((urldecode($data['EMP_StartDate_Ver'])=="N/A") || ((urldecode($data['EMP_StartDate_Ver'])=="-") && ($data['is_edit_fields'])==0)) ? urldecode($data['EMP_Employment_StartDate']):urldecode($data['EMP_StartDate_Ver']);

		$EMP_EndDate_Ver = ((urldecode($data['EMP_EndDate_Ver'])=="N/A") || ((urldecode($data['EMP_EndDate_Ver'])=="-") && ($data['is_edit_fields'])==0)) ? urldecode($data['EMP_Employment_EndDate']):urldecode($data['EMP_EndDate_Ver']);

		$EMP_Tenure_Ver = ((urldecode($data['EMP_Tenure_Ver'])=="N/A") || ((urldecode($data['EMP_Tenure_Ver'])=="-") && ($data['is_edit_fields'])==0)) ? urldecode($data['EMP_Employment_Tenure']):urldecode($data['EMP_Tenure_Ver']);

		$EMP_Position_Ver = ((urldecode($data['EMP_Position_Ver'])=="N/A") || ((urldecode($data['EMP_Position_Ver'])=="-") && ($data['is_edit_fields'])==0)) ? urldecode($data['EMP_Employment_Position']):urldecode($data['EMP_Position_Ver']);

		$EMP_LastSalaryDrawn_Ver = ((urldecode($data['EMP_LastSalaryDrawn_Ver'])=="N/A") || ((urldecode($data['EMP_LastSalaryDrawn_Ver'])=="-") && ($data['is_edit_fields'])==0)) ? urldecode($data['EMP_Employment_LastSalaryDrawn']):urldecode($data['EMP_LastSalaryDrawn_Ver']);

		$EMP_Name_Ver = ((urldecode($data['EMP_Name_Ver'])=="N/A") || ((urldecode($data['EMP_Name_Ver'])=="-") && ($data['is_edit_fields'])==0)) ? urldecode($data['EMP_Employment_Name']):urldecode($data['EMP_Name_Ver']);

		$EMP_ContactNo_Ver = ((urldecode($data['EMP_ContactNo_Ver'])=="N/A") || ((urldecode($data['EMP_ContactNo_Ver'])=="-") && ($data['is_edit_fields'])==0)) ? urldecode($data['EMP_Employment_ContactNo']):urldecode($data['EMP_ContactNo_Ver']);

		$EMP_AgencyAddr_Ver = ((urldecode($data['EMP_AgencyAddr_Ver'])=="N/A") || ((urldecode($data['EMP_AgencyAddr_Ver'])=="-") && ($data['is_edit_fields'])==0)) ? urldecode($data['EMP_Employment_AgencyAddr']):urldecode($data['EMP_AgencyAddr_Ver']);

		$EMP_AgencyPhNo_Ver = ((urldecode($data['EMP_AgencyPhNo_Ver'])=="N/A") || ((urldecode($data['EMP_AgencyPhNo_Ver'])=="-") && ($data['is_edit_fields'])==0)) ? urldecode($data['EMP_Employment_AgencyPhNo']):urldecode($data['EMP_AgencyPhNo_Ver']);

 
		
		
		
		
		
		
		
		
		
		$preEmployment  = '<div  id="pre-employment">
                                <div class="list-group-item form-horizontal">
                                <h4 class="section-title preface-title">Pre Employment</h4>
								<div class="savvion-employment-box1">
                                <h5 class="active">Company Details as per Applicant <span>View Details</span></h5>
								<div class="savvion-employment-box1-1">
								<input type="hidden" name="checkName" value="Pre-Employment" />
								
                                    <div class="form-group">
                                        <label for="Employment_CompanyName">Company Name: </label>
                                        '.urldecode($data['EMP_CompanyName']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="Employment_CompanyAddress">Company Address:  </label>
                                    	'.urldecode($data['EMP_CompanyAddress']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="Employment_City">City:  </label>
                                    	'.urldecode($data['EMP_City']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="Employment_Country">Country:  </label>
                                    	'.urldecode($data['EMP_Country']).'
                                    </div>
      								<div class="form-group">
                                    	<label for="Employment_Telephone">Telephone:  </label>
                                    	'.urldecode($data['EMP_Telephone']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="Employment_WebAddress">Web Address: </label>
                                    	'.urldecode($data['EMP_WebAddress']).'
                                    </div>
									<div class="clearfix"></div>
									</div>
									</div>
									<div class="savvion-employment-box2">
                                <h5>Company Details as per Masters <span>View Details</span></h5>
								<div class="savvion-employment-box2-1">
                                    <div class="form-group">
                                        <label for="IA_Name">Company Name: </label>
                                        '.urldecode($data['EMP_IA_Name']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_Address">Company Address: </label>
                                    	'.urldecode($data['EMP_IA_Address']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_City">City:</label>
                                    	'.urldecode($data['EMP_IA_City']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_Country">Country: </label>
                                    	'.urldecode($data['EMP_IA_Country']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_Telephone">Telephone No: </label>
                                    	'.urldecode($data['EMP_IA_Telephone']).'
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_Fax">Fax No: </label>
                                    	'.urldecode($data['EMP_IA_Fax']).'
                                    </div>
                                    
                                    <div class="form-group">
                                    	<label for="IA_Email">Email ID:  </label>
                                    	'.$data['EMP_IA_Email'].'
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_ContactPerson">Contact Person: </label>
                                    	'.urldecode($data['EMP_IA_ContactPerson']).'
                                    </div>
									<div class="clearfix"></div>
									</div>
									</div>
									<div class="savvion-employment-box3">
									<h5>Verify Details <span>View Details</span></h5>
									<div class="savvion-employment-box3-1">
											<div class="form-group">
												<label></label>
												<div class="txt">To Verify</div>
												<div class="btn_move"></div>
												<div class="txt">Verification Values</div>
											</div>	
										<div class="form-group">
											<label for="Designation">Designation:   </label>
											<input type="text" name="EMP_Employment_Designation" id="Designation" value="'.urldecode($data['EMP_Employment_Designation']).'"  class="form-control" placeholder="Name" disabled="disabled"/>
											<div class="btn_move"></div>
											<input type="text" class="form-control" name="EMP_Designation_Ver" value="'.$select_Desig.'">
												
											 
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[0].'" />
										</div>
										<div class="form-group">
											<label for="Salary">Salary:    </label>
											<input type="text" name="EMP_Employment_Salary" id="Salary" value="'.urldecode($data['EMP_Employment_Salary']).'"  class="form-control" placeholder="Salary" disabled="disabled" />
											<div class="btn_move"></div>
											<input type="text" name="EMP_Salary_Ver"  value="'.$EMP_Salary_Ver.'"  class="form-control" placeholder="Salary Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[1].'" />
										</div>
										<div class="form-group">
											<label for="Start">Start Date:     </label>
											<input type="text" name="EMP_Employment_StartDate" id="Start" value="'.urldecode($data['EMP_Employment_StartDate']).'"  class="form-control" placeholder="Start Date"  disabled="disabled"/>
											<div class="btn_move"></div>
											<input type="text" name="EMP_StartDate_Ver"  value="'.$EMP_StartDate_Ver.'"  class="datetimepicker-month form-control" placeholder="Start Date Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[2].'" />
										</div>
										<div class="form-group">
											<label for="End">End Date:      </label>
											<input type="text" name="EMP_Employment_EndDate" id="End" value="'.urldecode($data['EMP_Employment_EndDate']).'"  class="form-control" placeholder="End Date" disabled="disabled" />
											<div class="btn_move"></div>
											<input  type="text" name="EMP_EndDate_Ver"  value="'.$EMP_EndDate_Ver.'"  class="datetimepicker-month form-control" placeholder="End Date Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[3].'" />
										</div>
										<div class="form-group">
											<label for="Employment">Employment Tenure:       </label>
											<input type="text" name="EMP_Employment_Tenure" id="Employment" value="'.urldecode($data['EMP_Employment_Tenure']).'"  class="form-control" placeholder="Employment Tenure"  disabled="disabled"/>
											<div class="btn_move"></div>
											<input type="text" name="EMP_Tenure_Ver"  value="'.$EMP_Tenure_Ver.'"  class="datetimepicker-month form-control" placeholder="Employment Tenure Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[4].'" />
										</div>
										<div class="form-group">
											<label for="Position">Position:       </label>
											<input type="text" name="EMP_Employment_Position" id="Position" value="'.urldecode($data['EMP_Employment_Position']).'"  class="form-control" placeholder="Position" disabled="disabled" />
											<div class="btn_move"></div>
											<input type="text" name="EMP_Position_Ver"  value="'.$EMP_Position_Ver.'"  class="form-control" placeholder="Position Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[5].'" />
										</div>
										<div class="form-group">
											<label for="Last">Last Salary Drawn:        </label>
											<input type="text" name="EMP_Employment_LastSalaryDrawn" id="Last" value="'.urldecode($data['EMP_Employment_LastSalaryDrawn']).'"  class="form-control" placeholder="Last Salary Drawn" disabled="disabled" />
											<div class="btn_move"></div>
											<input type="text" name="EMP_LastSalaryDrawn_Ver"  value="'.$EMP_LastSalaryDrawn_Ver.'"  class="form-control" placeholder="Last Salary Drawn Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[6].'" />
										</div>
										<div class="form-group">
											<label for="Supervisor">Supervisor Name:        </label>
											<input type="text" name="EMP_Employment_Name" id="Supervisor" value="'.urldecode($data['EMP_Employment_Name']).'"  class="form-control" placeholder="Supervisor Name" disabled="disabled" />
											<div class="btn_move"></div>
											<input type="text" name="EMP_Name_Ver"  value="'.$EMP_Name_Ver.'"  class="form-control" placeholder="Supervisor Name Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[7].'" />
										</div>
										<div class="form-group">
											<label for="Contact">Contact No:         </label>
											<input type="text" name="EMP_Employment_ContactNo" id="Contact" value="'.urldecode($data['EMP_Employment_ContactNo']).'"  class="form-control" placeholder="Contact No" disabled="disabled" />
											<div class="btn_move"></div>
											<input type="text" name="EMP_ContactNo_Ver"  value="'.$EMP_ContactNo_Ver.'"  class="form-control" placeholder="Contact No Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[8].'" />
										</div>
										<div class="form-group">
											<label for="Agency">Agency Address:         </label>
											<input type="text" name="EMP_Employment_AgencyAddr" id="Agency" value="'.urldecode($data['EMP_Employment_AgencyAddr']).'"  class="form-control" placeholder="Agency Address" disabled="disabled" />
											<div class="btn_move"></div>
											<input type="text" name="EMP_AgencyAddr_Ver"  value="'.$EMP_AgencyAddr_Ver.'"  class="form-control" placeholder="Agency Address Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[9].'" />
										</div>
										<div class="form-group">
											<label for="Phone">Agency Phone:          </label>
											<input type="text" name="EMP_Employment_AgencyPhNo" id="Phone" value="'.urldecode($data['EMP_Employment_AgencyPhNo']).'"  class="form-control" placeholder="Agency Phone" disabled="disabled" />
											<div class="btn_move"></div>
											<input  type="text" name="EMP_AgencyPhNo_Ver"  value="'.$EMP_AgencyPhNo_Ver.'"  class="form-control" placeholder="Agency Phone Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[10].'" />
										</div>
										<div class="form-group">
											<label for="Relative">Family/ Relative Owned Business?:</label>
											<select class="form-control" id="Relative" name="savvion_key[]" disabled="disabled">
											'.$Relative_Owned_Business_key.'
											</select>
											<div class="btn_move"></div>
											<select class="form-control" name="EMP_IsEmpByFamily_Ver">
											'.$Relative_Owned_Business_value.'
											</select>
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[11].'" />
										</div>
										<div class="clearfix"></div>
										</div>
										</div>
									

                                </div>
                                </div>';
		$Is_License_Issued_key_1 	= (urldecode($data['HLT_License_IsLicenseIssued']) == 'yes') ? 'selected="selected"':'';
		$Is_License_Issued_key_2 	= (urldecode($data['HLT_License_IsLicenseIssued']) == 'no') ? 'selected="selected"':'';
		$Is_License_Issued_value_1 = (urldecode($data['HltLicense_IsLicIssued_Ver']) == 'yes') ? 'selected="selected"':'';
		$Is_License_Issued_value_2 = (urldecode($data['HltLicense_IsLicIssued_Ver']) == 'no') ? 'selected="selected"':'';

		$Is_License_Issued_key = '												
				<option value="yes" '.$Is_License_Issued_key_1.'>Yes</option>
				<option value="no" '.$Is_License_Issued_key_2.'>No</option>
		';
		$Is_License_Issued_value = '												
		<option value="yes" '.$Is_License_Issued_value_1.'>Yes</option>
		<option value="no" '.$Is_License_Issued_value_2.'>No</option>
		';
 
		$Is_License_Valid_key_1 	= (urldecode($data['HLT_License_IsLicenseValid']) == 'yes') ? 'selected="selected"':'';
		$Is_License_Valid_key_2 	= (urldecode($data['HLT_License_IsLicenseValid']) == 'no') ? 'selected="selected"':'';
		$Is_License_Valid_value_1 = (urldecode($data['HltLicense_IsLicValid_Ver']) == 'yes') ? 'selected="selected"':'';
		$Is_License_Valid_value_2 = (urldecode($data['HltLicense_IsLicValid_Ver']) == 'no') ? 'selected="selected"':'';

		$Is_License_Valid_key = '												
				<option value="yes" '.$Is_License_Valid_key_1.'>Yes</option>
				<option value="no" '.$Is_License_Valid_key_2.'>No</option>
		';
		$Is_License_Valid_value = '												
		<option value="yes" '.$Is_License_Valid_value_1.'>Yes</option>
		<option value="no" '.$Is_License_Valid_value_2.'>No</option>
		';


		$HltLicense_Name_Ver = ((urldecode($data['HltLicense_Name_Ver'])=="N/A") || ((urldecode($data['HltLicense_Name_Ver'])=="-" && ($data['is_edit_fields'])==0))) ? urldecode($data['HLT_License_Name']):urldecode($data['HltLicense_Name_Ver']);

		$HltLicense_LicAttained_Ver = ((urldecode($data['HltLicense_LicAttained_Ver'])=="N/A") || ((urldecode($data['HltLicense_LicAttained_Ver'])=="-" && ($data['is_edit_fields'])==0))) ? urldecode($data['HLT_License_LicAttained']):urldecode($data['HltLicense_LicAttained_Ver']);

		$HltLicense_ConferredDate_Ver = ((urldecode($data['HltLicense_ConferredDate_Ver'])=="N/A") || ((urldecode($data['HltLicense_ConferredDate_Ver'])=="-" && ($data['is_edit_fields'])==0))) ? urldecode($data['HLT_License_ConferredDate']):urldecode($data['HltLicense_ConferredDate_Ver']);

		$HltLicense_LicenseType_Ver = ((urldecode($data['HltLicense_LicenseType_Ver'])=="N/A") || ((urldecode($data['HltLicense_LicenseType_Ver'])=="-" && ($data['is_edit_fields'])==0))) ? urldecode($data['HLT_License_LicenseType']):urldecode($data['HltLicense_LicenseType_Ver']);

		$HltLicense_LicenseNo_Ver = ((urldecode($data['HltLicense_LicenseNo_Ver'])=="N/A") || ((urldecode($data['HltLicense_LicenseNo_Ver'])=="-" && ($data['is_edit_fields'])==0))) ? urldecode($data['HLT_License_LicenseNo']):urldecode($data['HltLicense_LicenseNo_Ver']);

		$HltLicenseAttendfrmDate_Ver = ((urldecode($data['HltLicenseAttendfrmDate_Ver'])=="N/A") || ((urldecode($data['HltLicenseAttendfrmDate_Ver'])=="-" && ($data['is_edit_fields'])==0))) ? urldecode($data['HLT_LicenseAttendfrmDate']):urldecode($data['HltLicenseAttendfrmDate_Ver']);

		$HltLicenseAttendtoDate_Ver = ((urldecode($data['HltLicenseAttendtoDate_Ver'])=="N/A") || ((urldecode($data['HltLicenseAttendtoDate_Ver'])=="-" && ($data['is_edit_fields'])==0))) ? urldecode($data['HLT_LicenseAttendtoDate']):urldecode($data['HltLicenseAttendtoDate_Ver']);

	 



		$healthLegislation = '<div id="health-legislation">
                                <div class="list-group-item">
                                <h4 class="section-title preface-title">Health Legislation</h4>
								<div class="savvion-health-box1">
								<h5 class="active">Personal Details as per Applicant <span>View Details</span></h5>
								<div class="savvion-health-box1-1">
                                <input type="hidden" name="checkName" value="Health-Legislation" />
                                <div class="form-group">
                                <label for="HltLicense_AuthorityName">License Authority:  </label>
                                '.urldecode($data['HLT_authorityname']).'
                                </div>
                                <div class="form-group">
                                <label for="HltLicense_AuthorityAddress">Authority Address:  </label>
                                '.urldecode($data['HLT_authorityaddress']).'
                                </div>  
                                <div class="form-group">
                                <label for="HltLicense_City">City:  </label>
                                '.urldecode($data['HLT_city']).'
                                </div>
                                <div class="form-group">
                                <label for="HltLicense_Country">Country:  </label>
                               '.urldecode($data['HLT_country']).'
                                </div>                               
                                <div class="form-group">
                                <label for="HltLicense_Telephone">Telephone:   </label>
                               '.urldecode($data['HLT_telephone']).'
                                </div>
                                <div class="form-group">
                                <label for="HltLicense_WebAddress">Web Address:  </label>
                                '.urldecode($data['HLT_website']).'
                                </div>                               
                             <div class="clearfix"></div>
								</div>
								</div>
                                
                              <div class="savvion-health-box2">
								<h5 class="active">Personal Details as per Applicant <span>View Details</span></h5>
								<div class="savvion-health-box2-1">  
                                
                                <div class="form-group">
                                <label for="IA_Name">License Authority:  </label>
                                '.urldecode($data['HLT_ia_name']).'
                                </div>
                                <div class="form-group">
                                <label for="IA_Address">Authority Address  </label>
                                '.urldecode($data['HLT_ia_address']).'
                                </div>                               
                                 <div class="form-group">
                                <label for="IA_City">City:  </label>
                                '.urldecode($data['HLT_ia_city']).'
                                </div>                               
                                <div class="form-group">
                                <label for="IA_Country">Country:  </label>
                                '.urldecode($data['HLT_ia_country']).'
                                </div>                               
                                <div class="form-group">
                                <label for="IA_Telephone">Telephone No: </label>
                               '.urldecode($data['HLT_ia_telephone']).'
                                </div>                               
                                <div class="form-group">
                                <label for="IA_Fax">Fax No:  </label>
                                '.urldecode($data['HLT_ia_fax']).'
                                </div>                               
                                <div class="form-group">
                                <label for="IA_Email">Email ID:   </label>
                                '.urldecode($data['HLT_ia_email']).'
                                </div>                               
                                <div class="form-group">
                                <label for="IA_WebAddress">Web Address: </label>
                                '.urldecode($data['HLT_ia_webaddress']).'
                                </div>                               
								<div class="clearfix"></div>
								</div>
								</div>
								<div class="clearfix"></div>
								<div class="savvion-health-box2" style="width:100%">
									<h5>Verify Details  <span>View Details</span></h5>
									<div class="savvion-health-box2-1">
										<div class="form-group">
											<label></label>
											<div class="txt">To Verify</div>
											<div class="btn_move"></div>
											<div class="txt">Verification Values</div>
										</div>
										<div class="form-group">
											<label for="Name">Name:     </label>
											<input type="text" name="HLT_License_Name" id="Name" value="'.urldecode($data['HLT_License_Name']).'"  class="form-control" placeholder="Name"  disabled="disabled" />
											<div class="btn_move"></div>
											<input  type="text" name="HltLicense_Name_Ver"  value="'.$HltLicense_Name_Ver.'"  class="form-control" placeholder="Name Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[0].'" />
										</div>
										<div class="form-group">
											<label for="Attained">License Attained:      </label>
											<input type="text" name="HLT_License_LicAttained" id="Attained" value="'.urldecode($data['HLT_License_LicAttained']).'"  class="form-control" placeholder="License Attained"  disabled="disabled" />
											<div class="btn_move"></div>
											<input  type="text" name="HltLicense_LicAttained_Ver"  value="'.$HltLicense_LicAttained_Ver.'"  class="form-control" placeholder="License Attained Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[1].'" />
										</div>
									   <div class="form-group">
											<label for="Conferred">Conferred Date:      </label>
											<input type="text" name="HLT_License_ConferredDate" id="Conferred" value="'.urldecode($data['HLT_License_ConferredDate']).'"  class="form-control" placeholder="Conferred Date"  disabled="disabled" />
											<div class="btn_move"></div>
											<input type="text" name="HltLicense_ConferredDate_Ver"  value="'.$HltLicense_ConferredDate_Ver.'"  class="datetimepicker-month form-control" placeholder="Conferred Date Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[2].'" />
										</div>
										<div class="form-group">
											<label for="License">License Type:       </label>
											<input type="text" name="HLT_License_LicenseType" id="License" value="'.urldecode($data['HLT_License_LicenseType']).'"  class="form-control" placeholder="License Type"  disabled="disabled"/>
											<div class="btn_move"></div>
											<input type="text" name="HltLicense_LicenseType_Ver"  value="'.$HltLicense_LicenseType_Ver.'"  class="form-control" placeholder="License Type Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[3].'" />
										</div>
										<div class="form-group">
											<label for="No">License No:      </label>
											<input type="text" name="HLT_License_LicenseNo" id="No" value="'.urldecode($data['HLT_License_LicenseNo']).'"  class="form-control" placeholder="License No" disabled="disabled" />
											<div class="btn_move"></div>
											<input type="text" name="HltLicense_LicenseNo_Ver"  value="'.$HltLicense_LicenseNo_Ver.'"  class="form-control" placeholder="License No Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[4].'" />
										</div>
									   <div class="form-group">
											<label for="From">Attended From date:     </label>
											<input type="text" name="HLT_LicenseAttendfrmDate" id="From" value="'.urldecode($data['HLT_LicenseAttendfrmDate']).'"  class="form-control" placeholder="Attended From date"  disabled="disabled" />
											<div class="btn_move"></div>
											<input type="text" name="HltLicenseAttendfrmDate_Ver"  value="'.$HltLicenseAttendfrmDate_Ver.'"  class="datetimepicker-month form-control" placeholder="Attended From date Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[5].'" />
										</div>
									   <div class="form-group">
											<label for="To">Attended To Date:    </label>
											<input type="text" name="HLT_LicenseAttendtoDate" id="To" value="'.urldecode($data['HLT_LicenseAttendtoDate']).'"  class="form-control" placeholder="Attended To Date"  disabled="disabled"/>
											<div class="btn_move"></div>
											<input type="text" name="HltLicenseAttendtoDate_Ver"  value="'.$HltLicenseAttendtoDate_Ver.'"  class="datetimepicker-month form-control" placeholder="Attended To Date Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[6].'" />
										</div>
										
										<div class="form-group">
											<label for="Issued">Is License Issued to you?</label>
											<select class="form-control" id="Issued" name="HLT_License_IsLicenseIssued" disabled="disabled">
											'.$Is_License_Issued_key.'
											</select>
											<div class="btn_move"></div>
											<select class="form-control" name="HltLicense_IsLicIssued_Ver">
											'.$Is_License_Issued_value.'
											</select>
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[7].'" />
										</div>
                        				
										<div class="form-group">
											<label for="Valid">Is License Valid?</label>
											<select class="form-control" id="Valid" name="HLT_License_IsLicenseValid" disabled="disabled">
											'.$Is_License_Valid_key.'
											</select>
											<div class="btn_move"></div>
											<select class="form-control" name="HltLicense_IsLicValid_Ver">
											'.$Is_License_Valid_value.'
											</select>
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[8].'" />
										</div>
										<div class="clearfix"></div>
										</div>
										</div>

                                </div>
                                </div>';

		
		
		
		switch($checkID){
			case 1:;
			echo $education;
			break;
			case 2:;
			echo $preEmployment;
			break;
			case 3:;
			echo $healthLegislation;
			break;
			default :
			echo 'noe';
			
		}
		
		
echo '<script type="text/javascript" src="'.SITE_URL.'/js/datetimepicker/jquery-ui-timepicker-addon.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="'.SITE_URL.'/js/datetimepicker/jquery-ui-timepicker-addon.css" />

 
<script type="text/javascript">
	function hide_div(id)
		{
			if(id==26){document.getElementById(\'temp_div\').style.display="";
			jQuery(".quali").attr("name","");
			jQuery(".quali_cust").attr("name","savvion_value[]");
			
			}
			else{document.getElementById(\'temp_div\').style.display="none";
			jQuery(".quali").attr("name","savvion_value[]");
			jQuery(".quali_cust").attr("name","");
			}
	}	
jQuery(document).ready(function(){
	jQuery(".savvion-eduction-box1 h5 span").click(function(){
		jQuery(".savvion-eduction-box1-1").slideToggle(700);
		jQuery(".savvion-eduction-box1 h5").toggleClass("active");
	});
	jQuery(".savvion-eduction-box2 h5 span").click(function(){
		jQuery(".savvion-eduction-box2-1").slideToggle(700);
		jQuery(".savvion-eduction-box2 h5").toggleClass("active");
	});
	jQuery(".savvion-eduction-box3 h5 span").click(function(){
		jQuery(".savvion-eduction-box3-1").slideToggle(700);
		jQuery(".savvion-eduction-box3 h5").toggleClass("active");
	});
	jQuery(".savvion-employment-box1 h5 span").click(function(){
		jQuery(".savvion-employment-box1-1").slideToggle(700);
		jQuery(".savvion-employment-box1 h5").toggleClass("active");
	});
	jQuery(".savvion-employment-box2 h5 span").click(function(){
		jQuery(".savvion-employment-box2-1").slideToggle(700);
		jQuery(".savvion-employment-box2 h5").toggleClass("active");
	});
	jQuery(".savvion-employment-box3 h5 span").click(function(){
		jQuery(".savvion-employment-box3-1").slideToggle(700);
		jQuery(".savvion-employment-box3 h5").toggleClass("active");
	});
	jQuery(".savvion-health-box1 h5 span").click(function(){
		jQuery(".savvion-health-box1-1").slideToggle(700);
		jQuery(".savvion-health-box1 h5").toggleClass("active");
	});
	jQuery(".savvion-health-box2 h5 span").click(function(){
		jQuery(".savvion-health-box2-1").slideToggle(700);
		jQuery(".savvion-health-box2 h5").toggleClass("active");
	});
	jQuery(".btn_move").click(function(){
		 pts = jQuery(this).prev("input").val();
		 nts = jQuery(this).next("input").val(pts);
		 pts2 = jQuery(this).prev("select").val();
		 nts2 = jQuery(this).next("select").val(pts2);
	 }); 
});

  $(".datetimepicker-month").datetimepicker({
	controlType: "select",
	timeFormat: "hh:mmTT"
});
 
   

</script>





		

';
								
/*	$(function () {
	
	var d = new Date()
  
var hours = d.getHours();
var minsx = d.getMinutes();
var ampm = hours <= 12 ? " AM " : " PM ";
alert(ampm);
		$( ".datetimepicker-month").datepicker({
		dateFormat: "mm/dd/yy "+hours+":"+minsx+" PM "+ampm.toString(),
		changeMonth: true,
		changeYear: true,
		yearRange: "1990:2016"
		});
		});		
*/							
	}

	function postedSavvion(){
		global $db;
		
		$savvion_check_id  = $_REQUEST['savvion_posted_id'];
		
		$isAddEdit = $db->updateCol('status,bot_status','6,1','savvion_check',"id=$savvion_check_id");
		msg('sec',"Check Mark As Closed Successfully...");
	}
	
	function insufficientCheck(){
		global $db;
		
		$savvion_check_id  = $_REQUEST['ins_savvion_check_id'];
		
		$isAddEdit = $db->updateCol('`status`,bot_status','5,0','savvion_check',"id=$savvion_check_id");
		msg('sec',"Check Mark As Insufficient Successfully...");
	}
	
	function approvesavvioncheck(){
		global $db;
		
		$savvion_check_id  = $_REQUEST['appsavvion_check_id'];
		
		$isAddEdit = $db->updateCol('status,bot_status','3,1','savvion_check',"id=$savvion_check_id");
		msg('sec',"Check Approved Successfully...");
	}
	
	function rejectsavvion(){
		global $db;
		$rejsavvion_check_id  = $_REQUEST['rejsavvion_check_id'];
		$isAddEdit = $db->updateCol('status,bot_status','1,1','savvion_check',"id=$rejsavvion_check_id");
		msg('sec',"Check Rejected Successfully...");
	}
	
	function addAnalystToTeam(){
		
		global $db;
		$tl_id 					= (int)$_REQUEST['tl_id']; 
		$analyst_id 			= (int)$_REQUEST['analyst_id']; 
		$savvion_tl 			=  $_REQUEST['savvion_tl'];
		$tblName = ($savvion_tl=="yes")?"tl_savvion_analyst_relation":"tl_analyst_rel";
		if($tl_id == 0) msg('err',"Please Select Team Lead!");
		if($analyst_id == 0) msg('err',"Please Select Analyst!");
		
		$cols = "
			tl_id,
			analyst_id
			";
		$values = "
			'$tl_id',
			'$analyst_id'
			";
		if($_REQUEST['ERR']==''){
							$check_analyst = $db->select($tblName,"*","analyst_id = $analyst_id");
							if(mysql_num_rows($check_analyst)>0){
								msg('err',"Analyst is Already Exists!");
							}else{
								$ins = $db->insert($cols,$values,$tblName);
								$lastinsertedID = $db->insertedID;
								msg('sec',"Analyst added into Team Successfully...");	
							}
		
		}
		
	}
	
	function assignSavvionChecks(){
		global $db;
		$record 			= (int)$_REQUEST['record']; 
		$team_lead_id 		= (int)$_REQUEST['team_lead_id']; 
		if($record == 0) msg('err',"Please Select Check!");
		if($team_lead_id == 0) msg('err',"Please Select Team Lead!");
		if($_REQUEST['ERR']==''){
			foreach($_REQUEST['record'] as $term){
				$uCls = "team_lead_id=$team_lead_id";
				$isUpdate = $db->update($uCls,"savvion_check","id=$term");
					
			}
			$uInfo  = getUserInfo($team_lead_id);
			$user	= ucwords($uInfo['first_name']);
			msg('sec',"Check(s) Successfully assigned to ".$user);
		}
		//die;
	}
	function apply_dd_sav(){
		global $db;
		//print_r($_REQUEST);die;
		$subarcode=$_REQUEST['subbarcode'];
		$uni_dd=(int)$_REQUEST['uni_dd'];
		$dd_count=$db->select("dd_data","*","dd_bcode='".$subarcode."'  AND dd_status<>3");
		if(mysql_num_rows($dd_count)==0){
			$uni_info=$db->select("uni_info","*","uni_id='".$uni_dd."'");
			$uni_arr=mysql_fetch_array($uni_info);
			$isInserted = $db->insert("`dd_bcode`,`dd_dataflow`,`dd_user`,`dd_uni`,`dd_bene`,`dd_units`,`dd_fee`,`dd_cdate`,`dd_active`,`dd_status`","'".$subarcode."','1','3','".$uni_arr['uni_id']."','".mysql_real_escape_string($uni_arr['uni_ben'])."','1','".$uni_arr['uni_fee']."','".date("Y-m-d H:i:s")."','1','1'","dd_data");
			
			     $uCls = "dd_checked=1";
				$isUpdate = $db->update($uCls,"records","bitrixtid=".(int)$_REQUEST['bitrixtid']."");
			
		}	
	}	
	function delegateSavvionChecks(){
		global $db;
		$record 			= (int)$_REQUEST['record']; 
		$analyst_id 		= (int)$_REQUEST['analyst_id']; 
		if($record == 0) msg('err',"Please Select Check!");
		if($analyst_id == 0) msg('err',"Please Select analyst !");
		if($_REQUEST['ERR']==''){
			foreach($_REQUEST['record'] as $term){
				$uCls = "user_id=$analyst_id";
				$isUpdate = $db->update($uCls,"savvion_check","id=$term");
					
			}
			$uInfo  = getUserInfo($team_lead_id);
			$user	= ucwords($uInfo['first_name']);
			msg('sec',"Check(s) Successfully delegated to ".$user);
		}
		//die;
	}

