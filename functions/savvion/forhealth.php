<?php 
  // print_r($_REQUEST); die;
global $db,$COMINF,$LEVEL;
//echo "<br><br><br><br>";
  

$Phraseology      =  $_REQUEST['Phraseology'];
 
 $Phras = array();
 foreach($Phraseology as $key => $Phraseo){
  
  if(is_numeric($Phraseo) && $Phraseo==0){
  
  }else{
  $Phras['phar']=$Phraseo; 
  }
 }
 $Phraseology2 = ($Phras['phar']!="")?$Phras['phar']:0;
//echo $Phraseology;

 
$HltLicense_Name_Ver = urlencode($_REQUEST['HltLicense_Name_Ver']);
$HltLicense_LicAttained_Ver = urlencode($_REQUEST['HltLicense_LicAttained_Ver']);
$HltLicense_ConferredDate_Ver = urlencode($_REQUEST['HltLicense_ConferredDate_Ver']);
$HltLicense_LicenseType_Ver = urlencode($_REQUEST['HltLicense_LicenseType_Ver']);
$HltLicense_LicenseNo_Ver = urlencode($_REQUEST['HltLicense_LicenseNo_Ver']);
$HltLicenseAttendfrmDate_Ver = urlencode($_REQUEST['HltLicenseAttendfrmDate_Ver']);
$HltLicenseAttendtoDate_Ver = urlencode($_REQUEST['HltLicenseAttendtoDate_Ver']);
$HltLicense_IsLicIssued_Ver = urlencode($_REQUEST['HltLicense_IsLicIssued_Ver']);
$HltLicense_IsLicValid_Ver = urlencode($_REQUEST['HltLicense_IsLicValid_Ver']);


$historynew = urlencode($_REQUEST['historynew']);
$CommentsForECT = urlencode($_REQUEST['CommentsForECT']);
$IsError = urlencode($_REQUEST['IsError']);
$SpokeTo = urlencode($_REQUEST['SpokeTo']);
$Designation = urlencode($_REQUEST['Designation']);
$Department = urlencode($_REQUEST['Department']);
$VStatus = urlencode($_REQUEST['VStatus']);
$VerificationLanguage = urlencode($_REQUEST['VerificationLanguage']);
$ModeOfVerification = urlencode($_REQUEST['ModeOfVerification']);
$initiatedByName = urlencode($_REQUEST['initiatedByName']);
$InsufficiencyComment = urlencode($_REQUEST['InsufficiencyComment']);
$VerificationComment = urlencode($_REQUEST['VerificationComment']);
$IA_CommunicationMode = urlencode($_REQUEST['IA_CommunicationMode']);
$ClientDiscrepancy = urlencode($_REQUEST['ClientDiscrepancy']);
$MandatoryRequirements = urlencode($_REQUEST['MandatoryRequirements']);
$SpecialInstructions = urlencode($_REQUEST['SpecialInstructions']);
$QC2Comment = urlencode($_REQUEST['QC2Comment']);
$QC3Comment = urlencode($_REQUEST['QC3Comment']);

$Hlt_Category = urlencode($_REQUEST['checkCategory']);
$Hlt_Sub_Category = urlencode($_REQUEST['checkSubCategory']);
$Hlt_Category_Comments = urlencode($_REQUEST['Category_Comments']);


$check_id = $_REQUEST['savvion_check_id']; 
/*$HLT_Qualification_Ver = $_REQUEST['HLT_Qualification_Ver'];
$HLT_MajorSubject_Ver = $_REQUEST['HLT_MajorSubject_Ver'];
$HLT_TextField_dateTime1 = $_REQUEST['HLT_TextField_dateTime1'];
$HLT_TextField_dateTime5 = $_REQUEST['HLT_TextField_dateTime5'];
$HLT_TextField_dateTime6 = $_REQUEST['HLT_TextField_dateTime6'];
$HLT_textField33 = $_REQUEST['HLT_textField33'];
$HLT_textField35 = $_REQUEST['HLT_textField35'];
$HLT_textField135 = $_REQUEST['HLT_textField135'];
$textarea3 = $_REQUEST['textarea3'];
$history = $_REQUEST['history'];
$historynew = $_REQUEST['historynew'];
$is_duplicate = $_REQUEST['is_duplicate'];
$CommentsForECT = $_REQUEST['CommentsForECT'];
$Phraseology = $_REQUEST['Phraseology'];
$VerificationLanguage = $_REQUEST['VerificationLanguage'];
$ModeOfVerification = $_REQUEST['ModeOfVerification'];
$initiatedByName = $_REQUEST['initiatedByName'];
$VerificationFee = $_REQUEST['VerificationFee'];
$PaymentDate = $_REQUEST['PaymentDate'];
$VerificationComment = $_REQUEST['VerificationComment'];
$InsufficiencyComment = $_REQUEST['InsufficiencyComment'];
$IA_CommunicationMode = $_REQUEST['IA_CommunicationMode'];

$inDivPhraseology = $_REQUEST['inDivPhraseology'];
$HLT_ia_isfake = $_REQUEST['HLT_ia_isfake'];
$HLT_ia_isonline = $_REQUEST['HLT_ia_isonline'];
$IsError = $_REQUEST['IsError'];
$HLT_DegreeType_Ver = $_REQUEST['HLT_DegreeType_Ver'];

$check_id = $_REQUEST['savvion_check_id'];*/
  
		  $cols = "
		HltLicense_Name_Ver,
		HltLicense_LicAttained_Ver,
		HltLicense_ConferredDate_Ver,
		HltLicense_LicenseType_Ver,
		HltLicense_LicenseNo_Ver,
		HltLicenseAttendfrmDate_Ver,
		HltLicenseAttendtoDate_Ver ,
		HltLicense_IsLicIssued_Ver,
		HltLicense_IsLicValid_Ver,
		HLT_historynew,
		HLT_CommentsForECT,
		HLT_IsError,
		HLT_SpokeTo,
		HLT_Designation,
		HLT_Department,
		HLT_Status,
		HLT_Phraseology,
		HLT_VerificationLanguage,
		HLT_ModeOfVerification,
		HLT_initiatedByName,
		InsufficiencyComment,
		HLT_VerificationComment,
		HLT_Category,	
		HLT_Sub_Category,	
		HLT_Category_Comments,	
		bot_status,
		is_edit_fields	
 		";
		
		
		/*,
		
		HLT_ClientDiscrepancy,
		HLT_QC2Comment,
		HLT_QC3Comment,
		HLT_ApplicantName_Ver,
		HLT_Qualification_Ver,
		HLT_MajorSubject_Ver,
		HLT_TextField_dateTime1,
		HLT_TextField_dateTime5,
		HLT_TextField_dateTime6,
		HLT_textField33,
		HLT_textField35,
		HLT_historynew,
		HLT_textField135 ,
		HLT_IA_CommunicationMode,
		HLT_CommentsForECT,
		HLT_IA_Instructions,
		InsufficiencyComment,
		HLT_DegreeType_Ver,
		HLT_Phraseology	
 		";*/
  
		  $values = "
		'$HltLicense_Name_Ver',
		'$HltLicense_LicAttained_Ver',
		'$HltLicense_ConferredDate_Ver',
		'$HltLicense_LicenseType_Ver',
		'$HltLicense_LicenseNo_Ver',
		'$HltLicenseAttendfrmDate_Ver',
		'$HltLicenseAttendtoDate_Ver',
		'$HltLicense_IsLicIssued_Ver',
		'$HltLicense_IsLicValid_Ver',
		'$historynew',
		'$CommentsForECT',
		'$IsError',
		'$SpokeTo',
		'$Designation',
		'$Department',
		'$VStatus',
		'$Phraseology2',
		'$VerificationLanguage',
		'$ModeOfVerification',
		'$initiatedByName',
		'$InsufficiencyComment',
		'$VerificationComment',
		'$Hlt_Category',
		'$Hlt_Sub_Category',
		'$Hlt_Category_Comments',
		'1',
		'1'
		";
 
 
			// HLT_Phraseology, '$Phraseology',
			
				
 /*	echo $cols."<br><br><br>";			
  echo $values;*/
   $isAddEdit = $db->updateCol($cols,$values,'dataflow',"primid=$check_id");
  //echo  "update dataflow set $cols values($values) where primid =$check_id";
  
   
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
			 
			
		foreach($result_att as $attach){
								$attachment_name = 	getUniqueFilename($attach);
								//$cols_attach = "
								//	sv_id,
								//	at_attachment
								//	";
								//$values_attach = "
								//	'$savvion_check_id',
								//	'$attachment_name'
								//	";
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
												// msg('err',"File is not an image!");
												//$error =1;
												$uploadOk = 1;
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
											/*// Allow certain file formats
											if($imageFileType != "msg" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
												msg('err',"Sorry, only JPG, JPEG, PNG & GIF files are allowed!");
												$uploadOk = 0;
												$error =1;
											}*/
											
										
											// Allow certain file formats
											$FILE_TYPES_ALLOWED = explode(",",FILE_TYPES_ALLOWED_SAVVION);
											if(!in_array(strtolower($imageFileType),$FILE_TYPES_ALLOWED)){
											msg('err',"Sorry, only ".FILE_TYPES_ALLOWED_SAVVION." files are allowed!");
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
													//$attach_ins_values = $db->insert($cols_attach,$values_attach,'savvion_attach');
													
													
 							 //$db->update("at_attachment = '".$attach['name']."'",'savvion_attach',"sv_id=$check_id");
							$cols = 'sv_id,at_attachment';
							$values = "$check_id,'".$attachment_name."'";
							//print_r($savvion_key);
							//print_r($savvion_value);
							
							 
							
							$ins = $db->insert($cols,$values,'savvion_attach');						
													
													//msg('sec',"The file ". basename( $sp_attachment_name). " has been uploaded!");
												} else {
													echo '9';
													msg('err',"Sorry, there was an error uploading your file!");
													$error =1;
												}
											}	
						
									}
							}
  
 
 
 ?>