<?php 
// print_r($_REQUEST);
global $db,$COMINF,$LEVEL;
 

$Phraseology      = $_REQUEST['Phraseology'];
 
 $Phras = array();
 foreach($Phraseology as $key => $Phraseo){
  
  if(is_numeric($Phraseo) && $Phraseo==0){
  
  }else{
  $Phras['phar']=$Phraseo; 
  }
 }
 $Phraseology2 = ($Phras['phar']!="")?$Phras['phar']:0;
//echo $Phraseology;




					$barcode							=	$_REQUEST['Barcode'];
					$subbarcode 						= ($_REQUEST['SubBarcode']); 
					$clientname 						= ($_REQUEST['ClientName']); 
					$applicantname 						= $_REQUEST['ApplicantName'];
					$EDU_clientrefno					=	$_REQUEST['ClientRefNo'];
					$EDU_dateofbirth					=	$_REQUEST['DateOfBirth'];
					$EDU_passportno						=	$_REQUEST['PassportNo'];
					$EDU_akaname						=	$_REQUEST['AKAName'];
					$EDU_gender							=	$_REQUEST['Gender'];
					$EDU_nationality					=	$_REQUEST['Nationality'];
					$EDU_arabicname						=	$_REQUEST['ArabicName'];
					$EDU_universityname					=	$_REQUEST['Education_UniversityName'];
					$EDU_universityaddress				=	$_REQUEST['Education_UniversityAddress'];
					$EDU_city							=	$_REQUEST['Education_City'];
					$EDU_country						=	$_REQUEST['Education_Country'];
					$EDU_telephone						=	$_REQUEST['Education_Telephone'];
					
					$EDU_ia_name							=	$_REQUEST['IA_Name'];
					$EDU_ia_address							=	$_REQUEST['IA_Address'];
					$EDU_ia_city							=	$_REQUEST['IA_City'];
					$EDU_ia_country							=	$_REQUEST['IA_Country'];
					$EDU_ia_telephone						=	$_REQUEST['IA_Telephone'];
					$EDU_ia_fax								=	$_REQUEST['IA_Fax'];
					$EDU_ia_email							=	$_REQUEST['IA_Email'];
					$EDU_ia_webaddress						=	$_REQUEST['IA_WebAddress'];
					$EDU_ia_isfake						=	$_REQUEST['EDU_ia_isfake'];
					$EDU_ia_isonline					=	$_REQUEST['EDU_ia_isonline'];
								
					$EDU_textarea3						=	$_REQUEST['_UNBOUND_textArea3'];
					$EDU_history						=	$_REQUEST['HistoryRemarks'];
					$EDU_historynew						=	$_REQUEST['_UNBOUND_historyNew'];
					$EDU_Education_ApplicantName		=	$_REQUEST['EDU_Education_ApplicantName'];
					$EDU_Education_Qualification		=	$_REQUEST['EDU_Education_Qualification'];
					$EDU_Education_MajorSubject			=	$_REQUEST['EDU_Education_MajorSubject'];
					$EDU_Education_DegreeType			=	$_REQUEST['EDU_Education_DegreeType'];
					$EDU_Education_QualConferredDate	=	$_REQUEST['EDU_Education_QualConferredDate'];
					$EDU_Education_AttendanceFrom		=	$_REQUEST['EDU_Education_AttendanceFrom'];
					$EDU_Education_AttendanceTo			=	$_REQUEST['EDU_Education_AttendanceTo'];
					$EDU_Education_IsGraduate			=	$_REQUEST['EDU_Education_IsGraduate'];
					$EDU_Education_LastYear				=	$_REQUEST['EDU_Education_LastYear'];
					$EDU_Education_Timing				=	$_REQUEST['EDU_Education_Timing'];
					$is_duplicate						=	$_REQUEST['is_duplicate'];
					$is_error							=	$_REQUEST['is_error'];
					
					$SpokeTo						=	$_REQUEST['SpokeTo'];
					$Designation					=	$_REQUEST['Designation'];
					$Department						=	$_REQUEST['Department'];
					$VStatus							=	$_REQUEST['VStatus'];
					
					$VerificationLanguage			=	$_REQUEST['VerificationLanguage'];
					$ModeOfVerification				=	$_REQUEST['ModeOfVerification'];
					$EDU_initiatedByName				=	$_REQUEST['initiatedByName'];
					$VerificationComment			=	$_REQUEST['VerificationComment'];
					$IsError						=	$_REQUEST['IsError'];
					$EDU_CommentsForECT					=	$_REQUEST['CommentsForECT'];
					$EDU_CommentsForECT					=	$_REQUEST['CommentsForECT'];
					$EDU_IA_CommunicationMode			=	$_REQUEST['IA_CommunicationMode'];
					$EDU_MandatoryRequirements			=	$_REQUEST['MandatoryRequirements'];
					$EDU_ClientDiscrepancy				=	$_REQUEST['ClientDiscrepancy'];
					$EDU_IA_Instructions				=	$_REQUEST['IA_Instructions'];
					$EDU_QC2Comment						=	$_REQUEST['QC2Comment'];
					$EDU_QC3Comment						=	$_REQUEST['QC3Comment'];
					$EDU_crawltype						=	$_REQUEST['crawltype'];
					$EDU_ApplicantName_Ver				=	$_REQUEST['EDU_ApplicantName_Ver'];
					$EDU_QualificationSelect_Ver		=	$_REQUEST['EDU_QualificationSelect_Ver'];
					$EDU_Qualification_Ver				=	$_REQUEST['EDU_Qualification_Ver'];
					$EDU_MajorSubject_Ver				=	$_REQUEST['EDU_MajorSubject_Ver'];
					$EDU_DegreeType_Ver					=	$_REQUEST['EDU_DegreeType_Ver'];
					$EDU_TextField_dateTime1			=	$_REQUEST['EDU_TextField_dateTime1'];
					$EDU_TextField_dateTime5			=	$_REQUEST['EDU_TextField_dateTime5'];
					$EDU_TextField_dateTime6			=	$_REQUEST['EDU_TextField_dateTime6'];
					$EDU_textField33					=	$_REQUEST['EDU_textField33'];
					$EDU_textField35					=	$_REQUEST['EDU_textField35'];
					$EDU_textField135					=	$_REQUEST['EDU_textField135'];
					$EDU_Category						=	$_REQUEST['checkCategory'];
					$EDU_Sub_Category					=	$_REQUEST['checkSubCategory'];
					$EDU_Category_Comments				=	$_REQUEST['VerificationComment'];
					
					

if(isset($_REQUEST['EDU_Detail_Verified_Ver']))
{
$EDU_Detail_Verified_Ver = urlencode($_REQUEST['EDU_Detail_Verified_Ver']);
}
else
{
$EDU_Detail_Verified_Ver = "";
}
if(isset($_REQUEST['EDU_Mode_Study_Ver']))
{
$EDU_Mode_Study_Ver = urlencode($_REQUEST['EDU_Mode_Study_Ver']);
}
else
{
$EDU_Mode_Study_Ver = "";
}
 
 $check_id = $_REQUEST['savvion_check_id'];
  
		$cols = "
		`EDU_IsError`,
		`EDU_SpokeTo`,
		`EDU_Designation`,
		`EDU_Department`,
		`EDU_Status`,
		`EDU_VerificationLanguage`,
		`EDU_ModeOfVerification`,
		`EDU_VerificationComment`,
		`EDU_ApplicantName_Ver`,
		`EDU_Qualification_Ver`,
		`EDU_MajorSubject_Ver`,
		`EDU_TextField_dateTime1`,
		`EDU_TextField_dateTime5`,
		`EDU_TextField_dateTime6`,
		`EDU_textField33`,
		`EDU_textField35`,
		`EDU_historynew`,
		`EDU_textField135`,
		`EDU_IA_CommunicationMode`,
		`EDU_CommentsForECT`,
		`InsufficiencyComment`,
		`EDU_DegreeType_Ver`,
		`EDU_Phraseology`,	
		`EDU_Category`,	
		`EDU_Sub_Category`,	
		`EDU_Category_Comments`,
		`EDU_Detail_Verified`,
		`EDU_Mode_Study_Ver`,	
		`bot_status`,
		`is_edit_fields`	
 		";
  //EDU_Detail_Verified_Ver,	EDU_Mode_Study_Ver,	
		$values = "
		'$IsError',
		'$SpokeTo',
		'$Designation',
		'$Department',
		'$VStatus',
		'$VerificationLanguage',
		'$ModeOfVerification',
		'$VerificationComment',
		'$EDU_ApplicantName_Ver',
		'$EDU_Qualification_Ver',
		'$EDU_MajorSubject_Ver',
		'$EDU_TextField_dateTime1',
		'$EDU_TextField_dateTime5',
		'$EDU_TextField_dateTime6',
		'$EDU_textField33',
		'$EDU_textField35',
		'$historynew',
		'$EDU_textField135', 
		'$IA_CommunicationMode',
		'$CommentsForECT',
		'$InsufficiencyComment',
		'$EDU_DegreeType_Ver',
		'$Phraseology2',
		'$EDU_Category',	
		'$EDU_Sub_Category',	
		'$EDU_Category_Comments',
		'$EDU_Detail_Verified_Ver',
		'$EDU_Mode_Study_Ver',	
		'1',
		'1'
		";
	 		
			// EDU_Phraseology, '$Phraseology','$EDU_Detail_Verified_Ver',	 '$EDU_Mode_Study_Ver',	
			 $isAddEdit = $db->updateCol($cols,$values,'dataflow',"primid=$check_id");
			//die;//
		//	echo  "update records set $cols values($values) where primid =$check_id";die;	
	//echo $cols."<br><br><br>";			
 // echo $values;
  
  // echo $db->query;
 
  
  
  
  
  
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
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
/*		$cols = "
		EDU_ia_name,
		EDU_ia_address,
		EDU_ia_city,
		EDU_ia_country,
		EDU_ia_telephone,
		EDU_ia_fax,
		EDU_ia_email,
		EDU_ia_webaddress,
		EDU_ia_isfake,
		EDU_ia_isonline,
		EDU_IsError,
		EDU_SpokeTo,
		EDU_Designation,
		EDU_Department,
		EDU_Status,
		EDU_VerificationLanguage,
		EDU_ModeOfVerification ,
		EDU_VerificationComment,
		EDU_MandatoryRequirements,
		EDU_ClientDiscrepancy,
		EDU_QC2Comment,
		EDU_QC3Comment,
		EDU_ApplicantName_Ver,
		EDU_Qualification_Ver,
		EDU_MajorSubject_Ver,
		EDU_TextField_dateTime1,
		EDU_TextField_dateTime5,
		EDU_TextField_dateTime6,
		EDU_textField33,
		EDU_textField35,
		EDU_textarea3,
		EDU_history,
		EDU_historynew,
		EDU_textField135 ,
		EDU_IA_CommunicationMode,
		EDU_CommentsForECT,
		EDU_IA_Instructions,
		InsufficiencyComment	
 		";
  
		$values = "
		'$EDU_ia_name',
		'$EDU_ia_address',
		'$EDU_ia_city',
		'$EDU_ia_country',
		'$EDU_ia_telephone',
		'$EDU_ia_fax',
		'$EDU_ia_email',
		'$EDU_ia_webaddress',
		'$EDU_ia_isfake',
		'$EDU_ia_isonline',
		'$IsError',
		'$SpokeTo',
		'$Designation',
		'$Department',
		'$VStatus',
		'$VerificationLanguage',
		'$ModeOfVerification',
		'$VerificationComment',
		'$MandatoryRequirements',
		'$ClientDiscrepancy',
		'$QC2Comment',
		'$QC3Comment',
		'$EDU_ApplicantName_Ver',
		'$EDU_Qualification_Ver',
		'$EDU_MajorSubject_Ver',
		'$EDU_TextField_dateTime1',
		'$EDU_TextField_dateTime5',
		'$EDU_TextField_dateTime6',
		'$EDU_textField33',
		'$EDU_textField35',
		'$textarea3',
		'$history',
		'$historynew',
		'$EDU_textField135', 
		'$IA_CommunicationMode',
		'$CommentsForECT',
		'$SpecialInstructions',
		'$InsufficiencyComment'
 		";
*/	 		


 
 ?>