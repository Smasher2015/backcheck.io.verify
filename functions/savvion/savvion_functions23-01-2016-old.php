<?php 
	
	// by Ayaz
	
	function addsavvioncheck(){
	
	global $db,$COMINF,$LEVEL;
	$analyst_Id = $_SESSION['user_id'];
	
	//echo $analyst_Id, die;
	$savvion_check_id  = $_REQUEST['savvion_check_id'];
	//echo 'savvion_check_id'.$savvion_check_id;
	$Barcode 				= urlencode($_REQUEST['Barcode']); 
	$ApplicantName 			= $_REQUEST['ApplicantName'];
	$SubBarcode 			= urlencode($_REQUEST['SubBarcode']); 
	$ClientName 			= urlencode($_REQUEST['ClientName']); 
	$ClientRefNo 			= urlencode($_REQUEST['ClientRefNo']); 
	$DateOfBirth 			= $_REQUEST['DateOfBirth']; 
	$PassportNo 			= urlencode($_REQUEST['PassportNo']); 
	$AKAName 				= $_REQUEST['AKAName']; 
	$Gender 				= $_REQUEST['Gender']; 
	$Nationality 			= urlencode($_REQUEST['Nationality']); 
	$ArabicName 			= urlencode($_REQUEST['ArabicName']); 
	$_UNBOUND_textArea3 	= urlencode($_REQUEST['_UNBOUND_textArea3']); 
	$HistoryRemarks 		= urlencode($_REQUEST['HistoryRemarks']); 
	$_UNBOUND_historyNew 	= urlencode($_REQUEST['_UNBOUND_historyNew']); 
	$CommentsForECT 		= urlencode($_REQUEST['CommentsForECT']); 
	$is_error 				= urlencode($_REQUEST['is_error']); 
	$is_duplicate 			= urlencode($_REQUEST['is_duplicate']); 

	
	
	
	$Education_UniversityName 		= urlencode($_REQUEST['Education_UniversityName']);
	$Education_UniversityAddress 	= urlencode($_REQUEST['Education_UniversityAddress']);
	$Education_City 				= urlencode($_REQUEST['Education_City']);
	$Education_Country 				= urlencode($_REQUEST['Education_Country']);
	$Education_Telephone 			= urlencode($_REQUEST['Education_Telephone']);
	$IA_Name 						= urlencode($_REQUEST['IA_Name']);
	$IA_Address 					= urlencode($_REQUEST['IA_Address']);
	$IA_City 						= urlencode($_REQUEST['IA_City']);
	$IA_Country 					= urlencode($_REQUEST['IA_Country']);
	$IA_Fax 						= urlencode($_REQUEST['IA_Fax']);
	$IA_Email 						= urlencode($_REQUEST['IA_Email']);
	$IA_WebAddress 					= urlencode($_REQUEST['IA_WebAddress']);
	$IA_IsFake 						= urlencode($_REQUEST['IA_IsFake']);
	$IA_IsOnline 					= urlencode($_REQUEST['IA_IsOnline']);
	$IA_Telephone 					= urlencode($_REQUEST['IA_Telephone']);
	
	
	$Employment_CompanyName 		= urlencode($_REQUEST['Employment_CompanyName']);
	$Employment_CompanyAddress 		= urlencode($_REQUEST['Employment_CompanyAddress']);
	$Employment_City 				= urlencode($_REQUEST['Employment_City']);
	$Employment_Country 			= urlencode($_REQUEST['Employment_Country']);
	$Employment_Telephone 			= urlencode($_REQUEST['Employment_Telephone']);
	$Employment_WebAddress 			= urlencode($_REQUEST['Employment_WebAddress']);
	$IA_ContactPerson 				= urlencode($_REQUEST['IA_ContactPerson']);
	$checkName 						= urlencode($_REQUEST['checkName']);
	
	//$IA_Name 						= $_REQUEST['IA_Name'];
	//$IA_Address 					= $_REQUEST['IA_Address'];
	//$IA_City 						= $_REQUEST['IA_City'];
	//$IA_Country 					= $_REQUEST['IA_Country'];
	//$IA_Telephone 					= $_REQUEST['IA_Telephone'];
	//$IA_Fax 						= $_REQUEST['IA_Fax'];
	//$IA_WebAddress 					= $_REQUEST['IA_WebAddress'];
	//$IA_Email 						= $_REQUEST['IA_Email'];
	
	
	$HltLicense_AuthorityName 		= urlencode($_REQUEST['HltLicense_AuthorityName']);
	$HltLicense_AuthorityAddress 	= urlencode($_REQUEST['HltLicense_AuthorityAddress']);
	$HltLicense_City 				= urlencode($_REQUEST['HltLicense_City']);
	$HltLicense_Country 			= urlencode($_REQUEST['HltLicense_Country']);
	$HltLicense_Telephone 			= urlencode($_REQUEST['HltLicense_Telephone']);
	$HltLicense_WebAddress 			= urlencode($_REQUEST['HltLicense_WebAddress']);
	//$IA_Name 						= $_REQUEST['IA_Name'];
	//$IA_Address 					= $_REQUEST['IA_Address'];
	//$IA_City 						= $_REQUEST['IA_City'];
	//$IA_Country 					= $_REQUEST['IA_Country'];
	//$IA_Telephone 					= $_REQUEST['IA_Telephone'];
	//$IA_Fax 						= $_REQUEST['IA_Fax'];
	//$IA_Email 						= $_REQUEST['IA_Email'];
	//$IA_WebAddress 					= $_REQUEST['IA_WebAddress'];
	
	
	
	
	$sentaddsavvioncheck 					= $_REQUEST['sentaddsavvioncheck'];
	
	
	
	$savvion_key 					= $_REQUEST['savvion_key'];
	$savvion_value 					= $_REQUEST['savvion_value'];
	//print_r($savvion_key);
	//echo "<br> Vals:<br>";
	//print_r($savvion_value);die;
	$array_combine 					= array_combine($savvion_key,$savvion_value);
	//echo 'savvion_key', print_r($savvion_key);
	//echo 'savvion_value', print_r($savvion_value);
	//echo 'array_combine', print_r($array_combine);
	if($savvion_check_id){
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
	
	/* Attachment */ 
		$ids 							= $_REQUEST['ids'];
		$sp_attachment 					= $_FILES['sp_attachment'];
		//print_r($sp_attachment);die;		
		$result_att = array();
			foreach ($ids as $id => $key) {
				$result_att[$key] = array(
				'sp_attachment'    => 	$sp_attachment[$id],
				'name'    => 	$sp_attachment['name'][$id],
				'tmp_name'    => 	$sp_attachment['tmp_name'][$id],
				
				);
			}
		
	/* Attachment */
	
	
	//print_r($result);die;
	
	$checksCode  = $db->select("checks_savvion","*","");
	
	while($rsc = mysql_fetch_assoc($checksCode)){
	
	if(strpos($SubBarcode,$rsc['short_title'])=== false){
		
	}else{
		$selTL = $db->select("savvion_teamlead_checks","team_lead_id"," checks_id=$rsc[checks_id]");
		$rsTL = mysql_fetch_assoc($selTL);
		$team_lead_id = $rsTL['team_lead_id'];
	}
		
	}
	//die(var_dump($team_lead_id));
	
	/*if($SubBarcode == '') msg('err',"Please Enter Reference No!");
	if($ClientName == '') msg('err',"Please Enter Client Name!");
	if($ClientRefNo == '') msg('err',"Please Enter Client Reference No!");
	if($DateOfBirth == '') msg('err',"Please Enter Date Of Birth!");
	if($PassportNo == '') msg('err',"Please Enter Passport No!");
	if($AKAName == '') msg('err',"Please Enter AKAName!");
	if($Gender == '') msg('err',"Please Enter Gender!");
	if($Nationality == '') msg('err',"Please Enter Nationality!");
	if($ArabicName == '') msg('err',"Please Enter Arabic Name!");
	if($_UNBOUND_textArea3 == '') msg('err',"Please Enter CRM Remarks!");
	if($HistoryRemarks == '') msg('err',"Please Enter History Remarks!");
	if($_UNBOUND_historyNew == '') msg('err',"Please Enter Notes Input Box!");*/
	
	$SpokeTo 						= urlencode($_REQUEST['SpokeTo']);
	$Designation 					= urlencode($_REQUEST['Designation']);
	$Department 					= urlencode($_REQUEST['Department']);
	$VStatus 						= urlencode($_REQUEST['VStatus']);
	$Phraseology 					= urlencode($_REQUEST['Phraseology']);
	$VerificationLanguage 			= urlencode($_REQUEST['VerificationLanguage']);
	$ModeOfVerification 			= urlencode($_REQUEST['ModeOfVerification']);
	$initiatedByName 				= urlencode($_REQUEST['initiatedByName']);
	$VerificationFee 				= urlencode($_REQUEST['VerificationFee']);
	$PaymentDate 					= urlencode($_REQUEST['PaymentDate']);
	$PaymentApprovalDate 			= urlencode($_REQUEST['PaymentApprovalDate']);
	$PaymentInFavourof 				= urlencode($_REQUEST['PaymentInFavourof']);
	$TransactionID 					= urlencode($_REQUEST['TransactionID']);
	$paymentModTypeID 				= urlencode($_REQUEST['paymentModTypeID']);
	$otherCardNam 					= urlencode($_REQUEST['otherCardNam']);
	$Currency 						= urlencode($_REQUEST['Currency']);
	$transactionAmt 				= urlencode($_REQUEST['transactionAmt']);
	$otherCardNumber 				= urlencode($_REQUEST['otherCardNumber']);
	$checkCategory 					= urlencode($_REQUEST['checkCategory']);
	$checkSubCategory 				= urlencode($_REQUEST['checkSubCategory']);
	$VerificationComment 			= urlencode($_REQUEST['VerificationComment']);
	$inDivPhraseology 				= urlencode($_REQUEST['inDivPhraseology']);
	$InsufficiencyComment 			= urlencode($_REQUEST['InsufficiencyComment']);

	
	
	//$cols = "SubBarcode,ClientName,ClientRefNo,DateOfBirth,PassportNo,AKAName,Gender,Nationality,ArabicName,Education_UniversityName,Education_UniversityAddress,Education_City,Education_Country,Education_Telephone,IA_Name,IA_Address,IA_City,IA_Country,IA_Fax,IA_Email,IA_WebAddress,IA_IsFake,IA_IsOnline,Employment_CompanyName,Employment_CompanyAddress,Employment_City,Employment_Country,Employment_Telephone,Employment_WebAddress,IA_Telephone,IA_ContactPerson,HltLicense_AuthorityName,HltLicense_AuthorityAddress,HltLicense_City,HltLicense_Country,HltLicense_Telephone,HltLicense_WebAddress,_UNBOUND_textArea3,HistoryRemarks,_UNBOUND_historyNew";
	//$values = "$SubBarcode,$ClientName,$ClientRefNo,$DateOfBirth,$PassportNo,$AKAName,$Gender,$Nationality,$ArabicName,$Education_UniversityName,$Education_UniversityAddress,$Education_City,$case_id,$Education_Country,$Education_Telephone,$IA_Name,$IA_Address,$IA_City,$IA_Country,$IA_Fax,$IA_Email,$IA_WebAddress,$IA_IsFake,$IA_IsOnline,$Employment_CompanyName,$Employment_CompanyAddress,$Employment_City,$Employment_Country,$Employment_Telephone,$Employment_WebAddress,$IA_Telephone,$IA_ContactPerson,$HltLicense_AuthorityName,$HltLicense_AuthorityAddress,$HltLicense_City,$HltLicense_Country,$HltLicense_Telephone,$HltLicense_WebAddress,$_UNBOUND_textArea3,$HistoryRemarks,$_UNBOUND_historyNew";
		$cols = "
		Barcode,
		ApplicantName,
		SubBarcode,
		ClientName,
		ClientRefNo,
		DateOfBirth,
		PassportNo,
		AKAName,
		Gender,
		Nationality,
		ArabicName,
		Education_UniversityName,
		Education_UniversityAddress,
		Education_City,
		Education_Country,
		Education_Telephone,
		IA_Name,
		IA_Address,
		IA_City,
		IA_Country,
		IA_Fax,
		IA_Email,
		IA_WebAddress,
		IA_IsFake,
		IA_IsOnline,
		Employment_CompanyName,
		Employment_CompanyAddress,
		Employment_City,
		Employment_Country,
		Employment_Telephone,
		Employment_WebAddress,
		IA_Telephone,
		IA_ContactPerson,
		HltLicense_AuthorityName,
		HltLicense_AuthorityAddress,
		HltLicense_City,
		HltLicense_Country,
		HltLicense_Telephone,
		HltLicense_WebAddress,
		_UNBOUND_textArea3,
		HistoryRemarks,
		_UNBOUND_historyNew,
		CommentsForECT,
		is_error,
		team_lead_id,
		SpokeTo,
		Designation,
		Department,
		VStatus,
		Phraseology,
		VerificationLanguage,
		ModeOfVerification ,
		initiatedByName,
		VerificationFee,
		PaymentDate,
		PaymentApprovalDate,
		PaymentInFavourof,
		TransactionID,
		paymentModTypeID,
		otherCardNam,
		Currency,
		transactionAmt,
		otherCardNumber,
		checkCategory,
		checkSubCategory,
		VerificationComment,
		inDivPhraseology,
		InsufficiencyComment,
		is_duplicate
		
		";
	$values = "
		'$Barcode',
		'$ApplicantName',
		'$SubBarcode',
		'$ClientName',
		'$ClientRefNo',
		'$DateOfBirth',
		'$PassportNo',
		'$AKAName',
		'$Gender',
		'$Nationality',
		'$ArabicName',
		'$Education_UniversityName',
		'$Education_UniversityAddress',
		'$Education_City',
		'$Education_Country',
		'$Education_Telephone',
		'$IA_Name',
		'$IA_Address',
		'$IA_City',
		'$IA_Country',
		'$IA_Fax',
		'$IA_Email',
		'$IA_WebAddress',
		'$IA_IsFake',
		'$IA_IsOnline',
		'$Employment_CompanyName',
		'$Employment_CompanyAddress',
		'$Employment_City',
		'$Employment_Country',
		'$Employment_Telephone',
		'$Employment_WebAddress',
		'$IA_Telephone',
		'$IA_ContactPerson',
		'$HltLicense_AuthorityName',
		'$HltLicense_AuthorityAddress',
		'$HltLicense_City',
		'$HltLicense_Country',
		'$HltLicense_Telephone',
		'$HltLicense_WebAddress',
		'$_UNBOUND_textArea3',
		'$HistoryRemarks',
		'$_UNBOUND_historyNew',
		'$CommentsForECT',
		'$is_error',
		'$team_lead_id',
		'$SpokeTo',
		'$Designation',
		'$Department',
		'$VStatus',
		'$Phraseology',
		'$VerificationLanguage',
		'$ModeOfVerification' ,
		'$initiatedByName',
		'$VerificationFee',
		'$PaymentDate',
		'$PaymentApprovalDate',
		'$PaymentInFavourof',
		'$TransactionID',
		'$paymentModTypeID',
		'$otherCardNam',
		'$Currency',
		'$transactionAmt',
		'$otherCardNumber',
		'$checkCategory',
		'$checkSubCategory',
		'$VerificationComment',
		'$inDivPhraseology',
		'$InsufficiencyComment',
		'$is_duplicate'
		";
	
			if($_REQUEST['ERR']==''){
				
					$data_table = 
							'<table width="100%" border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">
							<tr>
								<th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Applicant Name</th>
								<th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Sub Barcode</th>
								<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Check Title</th>
							</tr>';
					$data_table .= 
							'<tr>
								<td width="30%" style="font-size:12px; padding:5px;">'.$ApplicantName.'</td>
								<td width="30%" style="font-size:12px; padding:5px;">'.$SubBarcode.'</td>
								<td width="25%" style="font-size:12px; padding:5px;">'.$checkName.'</td>
							</tr>';
					$data_table .= '</table>';
					$email_title = 'New check has been created on Savvion. Sub Barcode ['.$SubBarcode.']';	


					
					$check_data = $db->select("savvion_check","*","SubBarcode = '$SubBarcode'");
					//echo $savvion_check_id;die;
					if(mysql_num_rows($check_data)>0 && $savvion_check_id==''){
								msg('err',"SubBarcode is Already Exists!");
					}else{
			
				if($savvion_check_id){
						if($sentaddsavvioncheck){
							$cols .= ',status,bot_status';
							$values .= ',2,1';
							$isAddEdit = $db->updateCol($cols,$values,'savvion_check',"id=$savvion_check_id");
							foreach($result as $data){
								$key = $data['savvion_key'];
								$val = $data['savvion_value'];
								$savvion_editkey = 	$data['savvion_editkey'];
								$cols_ver = "savvion_key,savvion_value";
								$value_ver = "'$key','$val'";
								$isEditKey = $db->updateCol($cols_ver,$value_ver,'savvion_check_values',"savvion_check_id=$savvion_check_id and scv_id=$savvion_editkey");
							}
							foreach($result_att as $attach){
								$attachment_name = 	getUniqueFilename($attach);
								$cols_attach = "
									sv_id,
									at_attachment
									";
								$values_attach = "
									'$savvion_check_id',
									'$attachment_name'
									";
								if($attach['name']){
										$target_dir = "files/savvionAttachments/";
										$target_file = $target_dir . basename($attachment_name);
										$uploadOk = 1;
										$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
										// Check if image file is a actual image or fake image
										$check = getimagesize($attach["tmp_name"]);
											if($check !== false) {
												//echo "File is an image - " . $check["mime"] . ".";
												$uploadOk = 1;
											} else {
												 msg('err',"File is not an image!");
												$error =1;
												$uploadOk = 0;
											}
											// Check if file already exists
											if (file_exists($target_file)) {
												msg('err',"Sorry, file already exists!");
												$uploadOk = 0;
												$error =1;
											}
											// Check file size
											if(isset($attachment_name["size"])){
											if ($attachment_name["size"] > 500000) {
												msg('err',"Sorry, your file is too large!");
												$uploadOk = 0;
												$error =1;
											}}
											// Allow certain file formats
											if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
												msg('err',"Sorry, only JPG, JPEG, PNG & GIF files are allowed!");
												$uploadOk = 0;
												$error =1;
											}
											// Check if $uploadOk is set to 0 by an error
											if ($uploadOk == 0) {
												msg('err',"Sorry, your file was not uploaded!");
												$error =1;
											// if everything is ok, try to upload file
											} else {
												if (move_uploaded_file($attach["tmp_name"], $target_file)) {
													$attach_ins_values = $db->insert($cols_attach,$values_attach,'savvion_attach');
													//msg('sec',"The file ". basename( $sp_attachment_name). " has been uploaded!");
												} else {
													echo '9';
													msg('err',"Sorry, there was an error uploading your file!");
													$error =1;
												}
											}	
						
									}
							}
							$_REQUEST['check'] = $savvion_check_id;
							$_REQUEST['edit'] = 'edit';
							msg('sec',"Record Updated Successfully and sent to QC...");
						}else{
							$cols .= ',bot_status';
							$values .= ',0';
							$isAddEdit = $db->updateCol($cols,$values,'savvion_check',"id=$savvion_check_id");
							foreach($result as $data){
								$key = $data['savvion_key'];
								$val = $data['savvion_value'];
								$savvion_editkey = 	$data['savvion_editkey'];
								$cols_ver = "savvion_key,savvion_value";
								$value_ver = "'$key','$val'";
								$isEditKey = $db->updateCol($cols_ver,$value_ver,'savvion_check_values',"savvion_check_id=$savvion_check_id and scv_id=$savvion_editkey");
							}
							foreach($result_att as $attach){
								$attachment_name = 	getUniqueFilename($attach);
								$cols_attach = "
									sv_id,
									at_attachment
									";
								$values_attach = "
									'$savvion_check_id',
									'$attachment_name'
									";
								if($attach['name']){
										$target_dir = "files/savvionAttachments/";
										$target_file = $target_dir . basename($attachment_name);
										$uploadOk = 1;
										$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
										// Check if image file is a actual image or fake image
										$check = getimagesize($attach["tmp_name"]);
											if($check !== false) {
												//echo "File is an image - " . $check["mime"] . ".";
												$uploadOk = 1;
											} else {
												 msg('err',"File is not an image!");
												$error =1;
												$uploadOk = 0;
											}
											// Check if file already exists
											if (file_exists($target_file)) {
												msg('err',"Sorry, file already exists!");
												$uploadOk = 0;
												$error =1;
											}
											// Check file size
											if(isset($attachment_name["size"])){
											if ($attachment_name["size"] > 500000) {
												msg('err',"Sorry, your file is too large!");
												$uploadOk = 0;
												$error =1;
											}}
											// Allow certain file formats
											if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
												msg('err',"Sorry, only JPG, JPEG, PNG & GIF files are allowed!");
												$uploadOk = 0;
												$error =1;
											}
											// Check if $uploadOk is set to 0 by an error
											if ($uploadOk == 0) {
												msg('err',"Sorry, your file was not uploaded!");
												$error =1;
											// if everything is ok, try to upload file
											} else {
												if (move_uploaded_file($attach["tmp_name"], $target_file)) {
													$attach_ins_values = $db->insert($cols_attach,$values_attach,'savvion_attach');
													//msg('sec',"The file ". basename( $sp_attachment_name). " has been uploaded!");
												} else {
													echo '9';
													msg('err',"Sorry, there was an error uploading your file!");
													$error =1;
												}
											}	
						
									}
							}
							$_REQUEST['check'] = $savvion_check_id;
							$_REQUEST['edit'] = 'edit';
							msg('sec',"Record Updated Successfully...");

						}
					}else{
						
						if($sentaddsavvioncheck){
							$analyst_Id = ($team_lead_id!="")?$team_lead_id:$analyst_Id;
							if($LEVEL==10 || $LEVEL==3){
								$cols .= ',user_id';
								$values .= ',$analyst_Id';
							}

							$cols .= ',status,bot_status';
							$values .= ',2,1';
							//print_r($savvion_key);
							//print_r($savvion_value);
							
							 
							
							$ins = $db->insert($cols,$values,'savvion_check');
							$_REQUEST['SubBarcode'] = $db->insertedID;
							
							$in_id = $db->insertedID;
							foreach($array_combine as $key => $val){
							$cols_ver = "savvion_check_id,savvion_key,savvion_value";
							$value_ver = "$in_id,'$key','$val'";
							
							//echo "Insert into savvion_check_values ($cols_ver) VALUES ($value_ver) <br>";
							
							$ins_values = $db->insert($cols_ver,$value_ver,'savvion_check_values');
							}
							
							/* Attachment */
							foreach($result_att as $attach){
								$attachment_name = 	getUniqueFilename($attach);
								$cols_attach = "
									sv_id,
									at_attachment
									";
								$values_attach = "
									'$in_id',
									'$attachment_name'
									";
								if($attach['name']){
										$target_dir = "files/savvionAttachments/";
										$target_file = $target_dir . basename($attachment_name);
										$uploadOk = 1;
										$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
										// Check if image file is a actual image or fake image
										$check = getimagesize($attach["tmp_name"]);
											if($check !== false) {
												//echo "File is an image - " . $check["mime"] . ".";
												$uploadOk = 1;
											} else {
												 msg('err',"File is not an image!");
												$error =1;
												$uploadOk = 0;
											}
											// Check if file already exists
											if (file_exists($target_file)) {
												msg('err',"Sorry, file already exists!");
												$uploadOk = 0;
												$error =1;
											}
											// Check file size
											if(isset($attachment_name["size"])){
											if ($attachment_name["size"] > 500000) {
												msg('err',"Sorry, your file is too large!");
												$uploadOk = 0;
												$error =1;
											}}
											// Allow certain file formats
											if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
												msg('err',"Sorry, only JPG, JPEG, PNG & GIF files are allowed!");
												$uploadOk = 0;
												$error =1;
											}
											// Check if $uploadOk is set to 0 by an error
											if ($uploadOk == 0) {
												msg('err',"Sorry, your file was not uploaded!");
												$error =1;
											// if everything is ok, try to upload file
											} else {
												if (move_uploaded_file($attach["tmp_name"], $target_file)) {
													$attach_ins_values = $db->insert($cols_attach,$values_attach,'savvion_attach');
													//msg('sec',"The file ". basename( $sp_attachment_name). " has been uploaded!");
												} else {
													echo '9';
													msg('err',"Sorry, there was an error uploading your file!");
													$error =1;
												}
											}	
						
									}
							}
							/* Attachment */
							//emailTmp( $data_table, $email_title,'ceo@backcheckgroup.com','','erum@backcheckgroup.com','','','Danish');
							msg('sec',"Record Inserted and sent to QC...");
							
						}else{
							if($LEVEL==10 || $LEVEL==3){
								$analyst_Id = ($team_lead_id!="")?$team_lead_id:$analyst_Id;
								$cols .= ',user_id';
								$values .= ','.$analyst_Id.'';
							}
							$ins = $db->insert($cols,$values,'savvion_check');
							$_REQUEST['SubBarcode'] = $db->insertedID;
							
							$in_id = $db->insertedID;
							foreach($array_combine as $key => $val){
							$cols_ver = "savvion_check_id,savvion_key,savvion_value";
							$value_ver = "$in_id,'$key','$val'";
							//echo "Insert into savvion_check_values ($cols_ver) VALUES ($value_ver) <br>";
							$ins_values = $db->insert($cols_ver,$value_ver,'savvion_check_values');
							}
							/* Attachment */
							foreach($result_att as $attach){
								$attachment_name = 	getUniqueFilename($attach);
								$cols_attach = "
									sv_id,
									at_attachment
									";
								$values_attach = "
									'$in_id',
									'$attachment_name'
									";
								if($attach['name']){
										$target_dir = "files/savvionAttachments/";
										$target_file = $target_dir . basename($attachment_name);
										$uploadOk = 1;
										$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
										// Check if image file is a actual image or fake image
										$check = getimagesize($attach["tmp_name"]);
											if($check !== false) {
												//echo "File is an image - " . $check["mime"] . ".";
												$uploadOk = 1;
											} else {
												 msg('err',"File is not an image!");
												$error =1;
												$uploadOk = 0;
											}
											// Check if file already exists
											if (file_exists($target_file)) {
												msg('err',"Sorry, file already exists!");
												$uploadOk = 0;
												$error =1;
											}
											// Check file size
											if(isset($attachment_name["size"])){
											if ($attachment_name["size"] > 500000) {
												msg('err',"Sorry, your file is too large!");
												$uploadOk = 0;
												$error =1;
											}}
											// Allow certain file formats
											if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
												msg('err',"Sorry, only JPG, JPEG, PNG & GIF files are allowed!");
												$uploadOk = 0;
												$error =1;
											}
											// Check if $uploadOk is set to 0 by an error
											if ($uploadOk == 0) {
												msg('err',"Sorry, your file was not uploaded!");
												$error =1;
											// if everything is ok, try to upload file
											} else {
												if (move_uploaded_file($attach["tmp_name"], $target_file)) {
													$attach_ins_values = $db->insert($cols_attach,$values_attach,'savvion_attach');
													//msg('sec',"The file ". basename( $sp_attachment_name). " has been uploaded!");
												} else {
													echo '9';
													msg('err',"Sorry, there was an error uploading your file!");
													$error =1;
												}
											}	
						
									}
							}
							/* Attachment */
							//emailTmp( $data_table, $email_title,'ceo@backcheckgroup.com','','erum@backcheckgroup.com','','','Danish');
							msg('sec',"Record Inserted Successfully...");
						}
		
				}
				}
				
			}
	
	}
	
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
				$query = $db->select("savvion_check","*","id=$savv_check_id");
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
	    $qua_options = '';
		$showHid_Div= 'display:none;';
		while($Qua =mysql_fetch_array($Qualification)){ 
			
			
			
			
			 $qua_options .= '<option  value="'.$Qua['sq_id'].'" ';
			 
			 
			 if(is_numeric($savvion_value_edit[1])){
				
			if($savvion_value_edit[1] == $Qua['sq_id']){
				$qua_options .= 'selected="selected"';
				$showHid_Div = 'display:none;';
				$otherVal = "";
				$save_val_sel="savvion_value[]";
				$save_val_txt="";
			}
			}else{
			
			if($Qua['sq_id']==26){
				$qua_options .= 'selected="selected"';
				$showHid_Div ='display:block;';
				$otherVal = $savvion_value_edit[1];
				$save_val_sel="";
				$save_val_txt="savvion_value[]";
			}
			}
			 
			 $qua_options .= ' >'.ucwords($Qua['sq_name']).'</option>';
		}
	
		$deg_options1 = ($savvion_value_edit[3] == 'POST GRADUATE') ? 'selected="selected"':'';
		$deg_options2 = ($savvion_value_edit[3] == 'PRE UNIVERSITY') ? 'selected="selected"':'';
		$deg_options3 = ($savvion_value_edit[3] == 'PROFESSIONAL CERTIFICATE') ? 'selected="selected"':'';
		$deg_options4 = ($savvion_value_edit[3] == 'UNIVERSITY') ? 'selected="selected"':'';
				
		$deg_options = '
				<option value="POST GRADUATE" '.$deg_options1.' >POST GRADUATE</option>
				<option value="PRE UNIVERSITY" '.$deg_options2.'>PRE UNIVERSITY</option>
				<option value="PROFESSIONAL CERTIFICATE" '.$deg_options3.'>PROFESSIONAL CERTIFICATE</option>
				<option value="UNIVERSITY" '.$deg_options4.'>UNIVERSITY</option>
		';
		
		$gra_options_key1 	= ($savvion_key_edit[7] == 'yes') ? 'selected="selected"':'';
		$gra_options_key2 	= ($savvion_key_edit[7] == 'no') ? 'selected="selected"':'';
		$gra_options_value1 = ($savvion_value_edit[7] == 'yes') ? 'selected="selected"':'';
		$gra_options_value2 = ($savvion_value_edit[7] == 'no') ? 'selected="selected"':'';

		$gra_options_key = '												
				<option value="yes" '.$gra_options_key1.'>Yes</option>
				<option value="no" '.$gra_options_key2.'>No</option>
		';
		$gra_options_value = '												
		<option value="yes" '.$gra_options_value1.'>Yes</option>
		<option value="no" '.$gra_options_value2.'>No</option>
		';
		$com_options_key1 	= ($savvion_key_edit[8] == 1) ? 'selected="selected"':'';
		$com_options_key2 	= ($savvion_key_edit[8] == 2) ? 'selected="selected"':'';
		$com_options_key3 	= ($savvion_key_edit[8] == 3) ? 'selected="selected"':'';
		$com_options_key4 	= ($savvion_key_edit[8] == 4) ? 'selected="selected"':'';

		$com_options_value1 = ($savvion_value_edit[8] == 1) ? 'selected="selected"':'';
		$com_options_value2 = ($savvion_value_edit[8] == 2) ? 'selected="selected"':'';
		$com_options_value3 = ($savvion_value_edit[8] == 3) ? 'selected="selected"':'';
		$com_options_value4 = ($savvion_value_edit[8] == 4) ? 'selected="selected"':'';

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
		
		$time_options_key1 	= ($savvion_key_edit[9] == 'full time') ? 'selected="selected"':'';
		$time_options_key2 	= ($savvion_key_edit[9] == 'part time') ? 'selected="selected"':'';

		$time_options_value1 	= ($savvion_value_edit[9] == 'full time') ? 'selected="selected"':'';
		$time_options_value2 	= ($savvion_value_edit[9] == 'part time') ? 'selected="selected"':'';


		$time_options_key =		'	
				<option value="">Select</option>
				<option value="full time"  '.$time_options_key1.'>Full Time</option>
				<option value="part time"  '.$time_options_key2.'>Part Time</option>';
		$time_options_value =		'	
				<option value="">Select</option>
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
                                    	<textarea name="Education_UniversityName" class="form-control parsley-validated" rows="4" data-parsley-minwords="4" data-parsley-required="true" placeholder="University Name">'.$data['Education_UniversityName'].'</textarea>
                                    </div>
                                    <div class="form-group">
                                    	<label for="Education_UniversityAddress">University Address:  </label>
                                    	<input type="text" name="Education_UniversityAddress" id="Education_UniversityAddress" value="'.$data['Education_UniversityAddress'].'" class="datetimepicker-month form-control" placeholder="University Address">
                                    </div>
                                    <div class="form-group">
                                    	<label for="Education_City">City:  </label>
                                    	<input type="text" name="Education_City" id="Education_City" value="'.$data['Education_City'].'" class="datetimepicker-month form-control" placeholder="City">
                                    </div>
                                    <div class="form-group">
                                    	<label for="Education_Country">Country:  </label>
                                    	<input  type="text"name="Education_Country" value="'.$data['Education_Country'].'" id="Education_Country" class="datetimepicker-month form-control" placeholder="Country">
                                    </div>
                                    <div class="form-group">
                                    	<label for="Education_Telephone">Telelphone:  </label>
                                    	<input type="text" name="Education_Telephone" value="'.$data['Education_Telephone'].'" id="Education_Telephone" class="datetimepicker-month form-control" placeholder="Telelphone">
                                    </div>
									<div class="clearfix"></div>
									</div>
									</div>
									<div class="savvion-eduction-box2">
									<h5>University Details as per Masters <span>View Details</span></h5>
									<div class="savvion-eduction-box2-1">
                                    <div class="form-group">
                                    	<label for="IA_Name">University Name: </label>
                                    	<textarea name="IA_Name" value="'.$data['IA_Name'].'" class="form-control parsley-validated" rows="4" data-parsley-minwords="4" data-parsley-required="true" placeholder="University Name"></textarea>
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_Address">University Address:  </label>
                                    	<input type="text" name="IA_Address" value="'.$data['IA_Address'].'" id="IA_Address" class="datetimepicker-month form-control" placeholder="University Address">
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_City">City:  </label>
                                    	<input type="text" name="IA_City" id="IA_City" value="'.$data['IA_City'].'" class="datetimepicker-month form-control" placeholder="City">
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_Country">Country:  </label>
                                    	<input type="text" name="IA_Country" id="IA_Country" value="'.$data['IA_Country'].'"  class="datetimepicker-month form-control" placeholder="Country">
                                    </div>
									<div class="form-group">
                                    	<label for="IA_Telephone">Telephone:  </label>
                                    	<input type="text" name="IA_Telephone" id="IA_Telephone" value="'.$data['IA_Telephone'].'"  class="datetimepicker-month form-control" placeholder="Telephone">
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_Fax">Fax No:   </label>
                                    	<input type="text" name="IA_Fax" id="IA_Fax" value="'.$data['IA_Fax'].'"  class="datetimepicker-month form-control" placeholder="Fax No">
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_Email">Email ID:  </label>
                                    	<input type="text" name="IA_Email" id="IA_Email" value="'.$data['IA_Email'].'"  class="datetimepicker-month form-control" placeholder="Email ID">
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_WebAddress">Web Address:  </label>
                                    	<input type="text" name="IA_WebAddress" id="IA_WebAddress" value="'.$data['IA_WebAddress'].'"  class="datetimepicker-month form-control" placeholder="Web Address">
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                        <div class="checker"><span><input name="IA_IsFake" value="1"  type="checkbox"  '.($data['IA_IsFake']==1?'checked':'').'></span></div>
                                        	Is Fake? 
                                        </label>
                                        <label class="checkbox-inline">
                                        <div class="checker"><span><input name="IA_IsOnline" value="1"  type="checkbox" '.($data['IA_IsOnline']==1?'checked':'').'></span></div>
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
											<input id="eduction_box1_1" type="text" name="savvion_key[]" id="Name" value="'.$savvion_key_edit[0].'"  class="datetimepicker-month form-control" placeholder="Name">
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input id="eduction_box1_2" type="text" name="savvion_value[]"  value="'.$savvion_value_edit[0].'"  class="datetimepicker-month form-control" placeholder="Name Value">
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[0].'" />
										</div>
										<div class="form-group">
											<label for="Qualification">Qualification:  </label>
											<input type="text" name="savvion_key[]" id="Qualification" value="'.$savvion_key_edit[1].'"  class="datetimepicker-month form-control" placeholder="Qualification">
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<select id="color" class="form-control quali" name="'.$save_val_sel.'" onchange="hide_div(this.value)">
												'.$qua_options.'
											</select>
										<div id="temp_div" style="width: 100%; float: left; margin-left:707px;  '.$showHid_Div.' "><input class="datetimepicker-month form-control quali_cust" id="temp_qua" placeholder="Other Qualification" type="text" name="'.$save_val_txt.'" value="'.$otherVal.'" /></div>
											
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[1].'" />
											
										</div>
										
										<div class="form-group">
											<label for="Major-Subject">Major Subject:  </label>
											<input type="text" name="savvion_key[]" id="Major-Subject" value="'.$savvion_key_edit[2].'"  class="datetimepicker-month form-control" placeholder="Major Subject">
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="text" name="savvion_value[]" value="'.$savvion_value_edit[2].'"  class="datetimepicker-month form-control" placeholder="Major Subject Value">
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[2].'" />
										</div>
										<div class="form-group">
											<label for="Degree-Type">Degree Type:  </label>
											<input type="text" name="savvion_key[]" id="Degree-Type" value="'.$savvion_key_edit[3].'"  class="datetimepicker-month form-control" placeholder="Degree Type">
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<select class="form-control"  name="savvion_value[]">
												'.$deg_options.'
											</select>
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[3].'" />
										</div>
										<div class="form-group">
											<label for="Conferred-Date">Conferred Date:  </label>
											<input type="date" name="savvion_key[]" id="Conferred-Date" value="'.$savvion_key_edit[4].'"  class="datetimepicker-month form-control" placeholder="Conferred Date">
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="date" name="savvion_value[]"  value="'.$savvion_value_edit[4].'"  class="datetimepicker-month form-control" placeholder="Conferred Date Value">
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[4].'" />
										</div>
										<div class="form-group">
											<label for="Attendance-From">Attendance From:  </label>
											<input type="date" name="savvion_key[]" id="Attendance-From" value="'.$savvion_key_edit[5].'"  class="datetimepicker-month form-control" placeholder="Attendance From">
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="date" name="savvion_value[]" value="'.$savvion_value_edit[5].'"  class="datetimepicker-month form-control" placeholder="Attendance From Value">
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[5].'" />
										</div>
										<div class="form-group">
											<label for="Attendance-To">Attendance To:  </label>
											<input type="date" name="savvion_key[]" id="Attendance-To" value="'.$savvion_key_edit[6].'"  class="datetimepicker-month form-control" placeholder="Attendance To">
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="date" name="savvion_value[]" value="'.$savvion_value_edit[6].'"  class="datetimepicker-month form-control" placeholder="Attendance To Value">
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[6].'" />
										</div>
										<div class="form-group">
											<label for="Is-Graduate">Is Graduate:  </label>
											<select class="form-control" id="Is-Graduate" name="savvion_key[]">
												'.$gra_options_key.'
											</select>
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<select class="form-control" name="savvion_value[]">
												'.$gra_options_value.'
											</select>
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[7].'" />
										</div>
										<div class="form-group">
											<label for="then-Last-Year-Completed">If No, then Last Year Completed:  </label>
											<select class="form-control" id="then-Last-Year-Completed" name="savvion_key[]">
												'.$com_options_key.'
											</select>
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<select class="form-control" name="savvion_value[]">
												'.$com_options_value.'
											</select>
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[8].'" />
										</div>
										<div class="form-group">
											<label for="Timing">Timing:  </label>
											<select class="form-control" id="Timing" name="savvion_key[]">
												'.$time_options_key.'
											</select>
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<select class="form-control" name="savvion_value[]">
												'.$time_options_value.'
											</select>
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[9].'" />
										</div>
										</div>
										<div class="clearfix"></div>
										</div>
                                </div>
                                </div>';
		$Designation = $db->select("savvion_designation","*"); 
	    $Desig_options = '';
		while($Desig =mysql_fetch_array($Designation)){ 
			$select_Desig = ($savvion_value_edit[0] == $Desig['sd_id']) ? 'selected="selected"':'';
			 $Desig_options .= '<option  value="'.$Desig['sd_id'].'" '.$select_Desig.'>'.ucwords($Desig['sd_designation']).'</option>';
		}

		$Relative_Owned_Business_key_1 	= ($savvion_key_edit[11] == 'yes') ? 'selected="selected"':'';
		$Relative_Owned_Business_key_2 	= ($savvion_key_edit[11] == 'no') ? 'selected="selected"':'';
		$Relative_Owned_Business_value_1 = ($savvion_value_edit[11] == 'yes') ? 'selected="selected"':'';
		$Relative_Owned_Business_value_2 = ($savvion_value_edit[11] == 'no') ? 'selected="selected"':'';

		$Relative_Owned_Business_key = '												
				<option value="yes" '.$Relative_Owned_Business_key_1.'>Yes</option>
				<option value="no" '.$Relative_Owned_Business_key_2.'>No</option>
		';
		$Relative_Owned_Business_value = '												
		<option value="yes" '.$Relative_Owned_Business_value_1.'>Yes</option>
		<option value="no" '.$Relative_Owned_Business_value_2.'>No</option>
		';
		$preEmployment  = '<div  id="pre-employment">
                                <div class="list-group-item form-horizontal">
                                <h4 class="section-title preface-title">Pre Employment</h4>
								<div class="savvion-employment-box1">
                                <h5 class="active">Company Details as per Applicant <span>View Details</span></h5>
								<div class="savvion-employment-box1-1">
								<input type="hidden" name="checkName" value="Pre-Employment" />
								
                                    <div class="form-group">
                                        <label for="Employment_CompanyName">Company Name: </label>
                                        <textarea name="Employment_CompanyName" class="form-control parsley-validated" rows="4" data-parsley-minwords="4" data-parsley-required="true" placeholder="Company Name">'.$data['Employment_CompanyName'].'</textarea>
                                    </div>
                                    <div class="form-group">
                                    	<label for="Employment_CompanyAddress">Company Address:  </label>
                                    	<input type="text" name="Employment_CompanyAddress" value="'.$data['Employment_CompanyAddress'].'" id="Employment_CompanyAddress" class="datetimepicker-month form-control" placeholder="Company Address">
                                    </div>
                                    <div class="form-group">
                                    	<label for="Employment_City">City:  </label>
                                    	<input type="text" name="Employment_City" value="'.$data['Employment_City'].'" id="Employment_City" class="datetimepicker-month form-control" placeholder="City">
                                    </div>
                                    <div class="form-group">
                                    	<label for="Employment_Country">Country:  </label>
                                    	<input type="text" name="Employment_Country" value="'.$data['Employment_Country'].'"  id="Employment_Country" class="datetimepicker-month form-control" placeholder="Country">
                                    </div>
      								<div class="form-group">
                                    	<label for="Employment_Telephone">Telephone:  </label>
                                    	<input type="text" name="Employment_Telephone" value="'.$data['Employment_Telephone'].'" id="Employment_Telephone" class="datetimepicker-month form-control" placeholder="Telephone">
                                    </div>
                                    <div class="form-group">
                                    	<label for="Employment_WebAddress">Web Address: </label>
                                    	<input type="text" name="Employment_WebAddress" value="'.$data['Employment_WebAddress'].'" id="Employment_WebAddress" class="datetimepicker-month form-control" placeholder="Web Address">
                                    </div>
									<div class="clearfix"></div>
									</div>
									</div>
									<div class="savvion-employment-box2">
                                <h5>Company Details as per Masters <span>View Details</span></h5>
								<div class="savvion-employment-box2-1">
                                    <div class="form-group">
                                        <label for="IA_Name">Company Name: </label>
                                        <textarea name="IA_Name" class="form-control parsley-validated" rows="4" data-parsley-minwords="4" data-parsley-required="true" placeholder="Company Name">'.$data['IA_Name'].'</textarea>
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_Address">Company Address: </label>
                                    	<input type="text" name="IA_Address" id="IA_Address" value="'.$data['IA_Address'].'" class="datetimepicker-month form-control" placeholder="Company Address">
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_City">City:</label>
                                    	<input type="text" name="IA_City" id="IA_City" value="'.$data['IA_City'].'" class="datetimepicker-month form-control" placeholder="City">
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_Country">Country: </label>
                                    	<input type="text" name="IA_Country" id="IA_Country" value="'.$data['IA_Country'].'" class="datetimepicker-month form-control" placeholder="Country">
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_Telephone">Telephone No: </label>
                                    	<input type="text" name="IA_Telephone" id="IA_Telephone" value="'.$data['IA_Telephone'].'" class="datetimepicker-month form-control" placeholder="Telephone No">
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_Fax">Fax No: </label>
                                    	<input type="text" name="IA_Fax" id="IA_Fax" value="'.$data['IA_Fax'].'" class="datetimepicker-month form-control" placeholder="Fax No">
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_WebAddress">Web Address: </label>
                                    	<input type="text" name="IA_WebAddress" id="IA_WebAddress" value="'.$data['IA_WebAddress'].'" class="datetimepicker-month form-control" placeholder="Web Address">
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_Email">Email ID:  </label>
                                    	<input type="text" name="IA_Email" id="IA_Email" value="'.$data['IA_Email'].'" class="datetimepicker-month form-control" placeholder="Email ID">
                                    </div>
                                    <div class="form-group">
                                    	<label for="IA_ContactPerson">Contact Person: </label>
                                    	<input type="text" name="IA_ContactPerson" id="IA_ContactPerson" value="'.$data['IA_ContactPerson'].'" class="datetimepicker-month form-control" placeholder="Contact Person">
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
											<input type="text" name="savvion_key[]" id="Designation" value="'.$savvion_key_edit[0].'"  class="datetimepicker-month form-control" placeholder="Name" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<select class="form-control" name="savvion_value[]">
												'.$Desig_options.'
											</select>
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[0].'" />
										</div>
										<div class="form-group">
											<label for="Salary">Salary:    </label>
											<input type="text" name="savvion_key[]" id="Salary" value="'.$savvion_key_edit[1].'"  class="datetimepicker-month form-control" placeholder="Salary" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="text" name="savvion_value[]"  value="'.$savvion_value_edit[1].'"  class="datetimepicker-month form-control" placeholder="Salary Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[1].'" />
										</div>
										<div class="form-group">
											<label for="Start">Start Date:     </label>
											<input type="date" name="savvion_key[]" id="Start" value="'.$savvion_key_edit[2].'"  class="datetimepicker-month form-control" placeholder="Start Date" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="date" name="savvion_value[]"  value="'.$savvion_value_edit[2].'"  class="datetimepicker-month form-control" placeholder="Start Date Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[2].'" />
										</div>
										<div class="form-group">
											<label for="End">End Date:      </label>
											<input type="date" name="savvion_key[]" id="End" value="'.$savvion_key_edit[3].'"  class="datetimepicker-month form-control" placeholder="End Date" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input  type="date" name="savvion_value[]"  value="'.$savvion_value_edit[3].'"  class="datetimepicker-month form-control" placeholder="End Date Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[3].'" />
										</div>
										<div class="form-group">
											<label for="Employment">Employment Tenure:       </label>
											<input type="text" name="savvion_key[]" id="Employment" value="'.$savvion_key_edit[4].'"  class="datetimepicker-month form-control" placeholder="Employment Tenure" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="text" name="savvion_value[]"  value="'.$savvion_value_edit[4].'"  class="datetimepicker-month form-control" placeholder="Employment Tenure Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[4].'" />
										</div>
										<div class="form-group">
											<label for="Position">Position:       </label>
											<input type="text" name="savvion_key[]" id="Position" value="'.$savvion_key_edit[5].'"  class="datetimepicker-month form-control" placeholder="Position" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="text" name="savvion_value[]"  value="'.$savvion_value_edit[5].'"  class="datetimepicker-month form-control" placeholder="Position Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[5].'" />
										</div>
										<div class="form-group">
											<label for="Last">Last Salary Drawn:        </label>
											<input type="text" name="savvion_key[]" id="Last" value="'.$savvion_key_edit[6].'"  class="datetimepicker-month form-control" placeholder="Last Salary Drawn" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="text" name="savvion_value[]"  value="'.$savvion_value_edit[6].'"  class="datetimepicker-month form-control" placeholder="Last Salary Drawn Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[6].'" />
										</div>
										<div class="form-group">
											<label for="Supervisor">Supervisor Name:        </label>
											<input type="text" name="savvion_key[]" id="Supervisor" value="'.$savvion_key_edit[7].'"  class="datetimepicker-month form-control" placeholder="Supervisor Name" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="text" name="savvion_value[]"  value="'.$savvion_value_edit[7].'"  class="datetimepicker-month form-control" placeholder="Supervisor Name Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[7].'" />
										</div>
										<div class="form-group">
											<label for="Contact">Contact No:         </label>
											<input type="text" name="savvion_key[]" id="Contact" value="'.$savvion_key_edit[8].'"  class="datetimepicker-month form-control" placeholder="Contact No" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="text" name="savvion_value[]"  value="'.$savvion_value_edit[8].'"  class="datetimepicker-month form-control" placeholder="Contact No Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[8].'" />
										</div>
										<div class="form-group">
											<label for="Agency">Agency Address:         </label>
											<input type="text" name="savvion_key[]" id="Agency" value="'.$savvion_key_edit[9].'"  class="datetimepicker-month form-control" placeholder="Agency Address" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="text" name="savvion_value[]"  value="'.$savvion_value_edit[9].'"  class="datetimepicker-month form-control" placeholder="Agency Address Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[9].'" />
										</div>
										<div class="form-group">
											<label for="Phone">Agency Phone:          </label>
											<input type="text" name="savvion_key[]" id="Phone" value="'.$savvion_key_edit[10].'"  class="datetimepicker-month form-control" placeholder="Agency Phone" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input  type="text" name="savvion_value[]"  value="'.$savvion_value_edit[10].'"  class="datetimepicker-month form-control" placeholder="Agency Phone Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[10].'" />
										</div>
										<div class="form-group">
											<label for="Relative">Family/ Relative Owned Business?:</label>
											<select class="form-control" id="Relative" name="savvion_key[]">
											'.$Relative_Owned_Business_key.'
											</select>
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<select class="form-control" name="savvion_value[]">
											'.$Relative_Owned_Business_value.'
											</select>
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[11].'" />
										</div>
										<div class="clearfix"></div>
										</div>
										</div>
									

                                </div>
                                </div>';
		$Is_License_Issued_key_1 	= ($savvion_key_edit[7] == 'yes') ? 'selected="selected"':'';
		$Is_License_Issued_key_2 	= ($savvion_key_edit[7] == 'no') ? 'selected="selected"':'';
		$Is_License_Issued_value_1 = ($savvion_value_edit[7] == 'yes') ? 'selected="selected"':'';
		$Is_License_Issued_value_2 = ($savvion_value_edit[7] == 'no') ? 'selected="selected"':'';

		$Is_License_Issued_key = '												
				<option value="yes" '.$Is_License_Issued_key_1.'>Yes</option>
				<option value="no" '.$Is_License_Issued_key_2.'>No</option>
		';
		$Is_License_Issued_value = '												
		<option value="yes" '.$Is_License_Issued_value_1.'>Yes</option>
		<option value="no" '.$Is_License_Issued_value_2.'>No</option>
		';


		$Is_License_Valid_key_1 	= ($savvion_key_edit[8] == 'yes') ? 'selected="selected"':'';
		$Is_License_Valid_key_2 	= ($savvion_key_edit[8] == 'no') ? 'selected="selected"':'';
		$Is_License_Valid_value_1 = ($savvion_value_edit[8] == 'yes') ? 'selected="selected"':'';
		$Is_License_Valid_value_2 = ($savvion_value_edit[8] == 'no') ? 'selected="selected"':'';

		$Is_License_Valid_key = '												
				<option value="yes" '.$Is_License_Valid_key_1.'>Yes</option>
				<option value="no" '.$Is_License_Valid_key_2.'>No</option>
		';
		$Is_License_Valid_value = '												
		<option value="yes" '.$Is_License_Valid_value_1.'>Yes</option>
		<option value="no" '.$Is_License_Valid_value_2.'>No</option>
		';


		$healthLegislation = '<div id="health-legislation">
                                <div class="list-group-item">
                                <h4 class="section-title preface-title">Health Legislation</h4>
								<div class="savvion-health-box1">
								<h5 class="active">Personal Details as per Applicant <span>View Details</span></h5>
								<div class="savvion-health-box1-1">
                                <input type="hidden" name="checkName" value="Health-Legislation" />
                                <div class="form-group">
                                <label for="HltLicense_AuthorityName">License Authority:  </label>
                                <input type="text" name="HltLicense_AuthorityName"  value="'.$data['HltLicense_AuthorityName'].'" id="HltLicense_AuthorityName" class="datetimepicker-month form-control" placeholder="License Authority">
                                </div>
                                <div class="form-group">
                                <label for="HltLicense_AuthorityAddress">Authority Address:  </label>
                                <input  type="text"name="HltLicense_AuthorityAddress"  value="'.$data['HltLicense_AuthorityAddress'].'" id="HltLicense_AuthorityAddress" class="datetimepicker-month form-control" placeholder="Authority Address">
                                </div>  
                                <div class="form-group">
                                <label for="HltLicense_City">City:  </label>
                                <input type="text" name="HltLicense_City"  value="'.$data['HltLicense_City'].'" id="HltLicense_City" class="datetimepicker-month form-control" placeholder="City">
                                </div>
                                <div class="form-group">
                                <label for="HltLicense_Country">Country:  </label>
                                <input type="text" name="HltLicense_Country"  value="'.$data['HltLicense_Country'].'" id="HltLicense_Country" class="datetimepicker-month form-control" placeholder="Country">
                                </div>                               
                                <div class="form-group">
                                <label for="HltLicense_Telephone">Telephone:   </label>
                                <input type="text" name="HltLicense_Telephone"  value="'.$data['HltLicense_Telephone'].'" id="HltLicense_Telephone" class="datetimepicker-month form-control" placeholder="Telephone">
                                </div>
                                <div class="form-group">
                                <label for="HltLicense_WebAddress">Web Address:  </label>
                                <input type="text" name="HltLicense_WebAddress"  value="'.$data['HltLicense_WebAddress'].'" id="HltLicense_WebAddress" class="datetimepicker-month form-control" placeholder="Web Address">
                                </div>                               
                                <div class="form-group">
                                <label for="IA_Name">Authority Name  </label>
                                <input type="text" name="IA_Name" id="IA_Name"  value="'.$data['IA_Name'].'" class="datetimepicker-month form-control" placeholder="Authority Name">
                                </div>
                                <div class="form-group">
                                <label for="IA_Address">Authority Address  </label>
                                <input type="text" name="IA_Address" id="IA_Address"  value="'.$data['IA_Address'].'" class="datetimepicker-month form-control" placeholder="Authority Address">
                                </div>                               
                                 <div class="form-group">
                                <label for="IA_City">City:  </label>
                                <input type="text" name="IA_City" id="IA_City"  value="'.$data['IA_City'].'" class="datetimepicker-month form-control" placeholder="City">
                                </div>                               
                                <div class="form-group">
                                <label for="IA_Country">Country:  </label>
                                <input type="text" name="IA_Country" id="IA_Country"  value="'.$data['IA_Country'].'" class="datetimepicker-month form-control" placeholder="Country">
                                </div>                               
                                <div class="form-group">
                                <label for="IA_Telephone">Telephone No: </label>
                                <input type="text" name="IA_Telephone" id="IA_Telephone"  value="'.$data['IA_Telephone'].'" class="datetimepicker-month form-control" placeholder="Telephone No">
                                </div>                               
                                <div class="form-group">
                                <label for="IA_Fax">Fax No:  </label>
                                <input type="text" name="IA_Fax" id="IA_Fax"  value="'.$data['IA_Fax'].'" class="datetimepicker-month form-control" placeholder="Fax No">
                                </div>                               
                                <div class="form-group">
                                <label for="IA_Email">Email ID:   </label>
                                <input type="text" name="IA_Email" id="IA_Email"  value="'.$data['IA_Email'].'" class="datetimepicker-month form-control" placeholder="Email ID">
                                </div>                               
                                <div class="form-group">
                                <label for="IA_WebAddress">Web Address: </label>
                                <input type="text" name="IA_WebAddress" id="IA_WebAddress"  value="'.$data['IA_WebAddress'].'" class="datetimepicker-month form-control" placeholder="Web Address:">
                                </div>                               
								<div class="clearfix"></div>
								</div>
								</div>
								
								<div class="savvion-health-box2">
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
											<input type="text" name="savvion_key[]" id="Name" value="'.$savvion_key_edit[0].'"  class="datetimepicker-month form-control" placeholder="Name" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input  type="text" name="savvion_value[]"  value="'.$savvion_value_edit[0].'"  class="datetimepicker-month form-control" placeholder="Name Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[0].'" />
										</div>
										<div class="form-group">
											<label for="Attained">License Attained:      </label>
											<input type="text" name="savvion_key[]" id="Attained" value="'.$savvion_key_edit[1].'"  class="datetimepicker-month form-control" placeholder="License Attained" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input  type="text" name="savvion_value[]"  value="'.$savvion_value_edit[1].'"  class="datetimepicker-month form-control" placeholder="License Attained Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[1].'" />
										</div>
									   <div class="form-group">
											<label for="Conferred">Conferred Date:      </label>
											<input type="date" name="savvion_key[]" id="Conferred" value="'.$savvion_key_edit[2].'"  class="datetimepicker-month form-control" placeholder="Conferred Date" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="date" name="savvion_value[]"  value="'.$savvion_value_edit[2].'"  class="datetimepicker-month form-control" placeholder="Conferred Date Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[2].'" />
										</div>
										<div class="form-group">
											<label for="License">License Type:       </label>
											<input type="text" name="savvion_key[]" id="License" value="'.$savvion_key_edit[3].'"  class="datetimepicker-month form-control" placeholder="License Type" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="text" name="savvion_value[]"  value="'.$savvion_value_edit[3].'"  class="datetimepicker-month form-control" placeholder="License Type Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[3].'" />
										</div>
										<div class="form-group">
											<label for="No">License No:      </label>
											<input type="text" name="savvion_key[]" id="No" value="'.$savvion_key_edit[4].'"  class="datetimepicker-month form-control" placeholder="License No" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="text" name="savvion_value[]"  value="'.$savvion_value_edit[4].'"  class="datetimepicker-month form-control" placeholder="License No Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[4].'" />
										</div>
									   <div class="form-group">
											<label for="From">Attended From date:     </label>
											<input type="date" name="savvion_key[]" id="From" value="'.$savvion_key_edit[5].'"  class="datetimepicker-month form-control" placeholder="Attended From date" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="date" name="savvion_value[]"  value="'.$savvion_value_edit[5].'"  class="datetimepicker-month form-control" placeholder="Attended From date Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[5].'" />
										</div>
									   <div class="form-group">
											<label for="To">Attended To Date:    </label>
											<input type="date" name="savvion_key[]" id="To" value="'.$savvion_key_edit[6].'"  class="datetimepicker-month form-control" placeholder="Attended To Date" />
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<input type="date" name="savvion_value[]"  value="'.$savvion_value_edit[6].'"  class="datetimepicker-month form-control" placeholder="Attended To Date Value" />
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[6].'" />
										</div>
										
										<div class="form-group">
											<label for="Issued">Is License Issued to you?</label>
											<select class="form-control" id="Issued" name="savvion_key[]">
											'.$Is_License_Issued_key.'
											</select>
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<select class="form-control" name="savvion_value[]">
											'.$Is_License_Issued_value.'
											</select>
											<input type="hidden" name="editkey[]" value="'.$savvion_value_id[7].'" />
										</div>
                        				
										<div class="form-group">
											<label for="Valid">Is License Valid?</label>
											<select class="form-control" id="Valid" name="savvion_key[]">
											'.$Is_License_Valid_key.'
											</select>
											<div class="btn_move"><i class="icon-share-alt"></i></div>
											<select class="form-control" name="savvion_value[]">
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
		
		
echo '<script type="text/javascript">
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


</script>';
								
								
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

