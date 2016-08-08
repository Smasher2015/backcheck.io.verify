<?php  //echo "employer ccheck";
 //  print_r($_REQUEST); 
global $db,$COMINF,$LEVEL;
//echo "<br><br><br><br>";
  

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

 
$EMP_Designation_Ver = urlencode($_REQUEST['EMP_Designation_Ver']);
$EMP_Salary_Ver = urlencode($_REQUEST['EMP_Salary_Ver']);
$EMP_StartDate_Ver = urlencode($_REQUEST['EMP_StartDate_Ver']);
$EMP_EndDate_Ver = urlencode($_REQUEST['EMP_EndDate_Ver']);
$EMP_Tenure_Ver = urlencode($_REQUEST['EMP_Tenure_Ver']);
$EMP_Position_Ver = urlencode($_REQUEST['EMP_Position_Ver']);
$EMP_LastSalaryDrawn_Ver = urlencode($_REQUEST['EMP_LastSalaryDrawn_Ver']);
$EMP_Name_Ver = urlencode($_REQUEST['EMP_Name_Ver']);
$EMP_ContactNo_Ver = urlencode($_REQUEST['EMP_ContactNo_Ver']);
$EMP_AgencyAddr_Ver = urlencode($_REQUEST['EMP_AgencyAddr_Ver']);
$EMP_AgencyPhNo_Ver = urlencode($_REQUEST['EMP_AgencyPhNo_Ver']);
$EMP_IsEmpByFamily_Ver = urlencode($_REQUEST['EMP_IsEmpByFamily_Ver']);
 

$historynew =  urlencode($_REQUEST['historynew']);
$CommentsForECT =  urlencode($_REQUEST['CommentsForECT']);
$IsError =  urlencode($_REQUEST['IsError']);
$SpokeTo =  urlencode($_REQUEST['SpokeTo']);
$Designation =  urlencode($_REQUEST['Designation']);
$Department =  urlencode($_REQUEST['Department']);
$VStatus =  urlencode($_REQUEST['VStatus']);
$VerificationLanguage =  urlencode($_REQUEST['VerificationLanguage']);
$ModeOfVerification =  urlencode($_REQUEST['ModeOfVerification']);
$initiatedByName =  urlencode($_REQUEST['initiatedByName']);
$InsufficiencyComment =  urlencode($_REQUEST['InsufficiencyComment']);
$VerificationComment =  urlencode($_REQUEST['VerificationComment']);
$IA_CommunicationMode =  urlencode($_REQUEST['IA_CommunicationMode']);
$ClientDiscrepancy =  urlencode($_REQUEST['ClientDiscrepancy']);
$MandatoryRequirements =  urlencode($_REQUEST['MandatoryRequirements']);
$SpecialInstructions =  urlencode($_REQUEST['SpecialInstructions']);
$QC2Comment =  urlencode($_REQUEST['QC2Comment']);
$QC3Comment =  urlencode($_REQUEST['QC3Comment']);

$EMP_Category = urlencode($_REQUEST['checkCategory']);
$EMP_Sub_Category = urlencode($_REQUEST['checkSubCategory']);
$EMP_Category_Comments = urlencode($_REQUEST['Category_Comments']);


$check_id = $_REQUEST['savvion_check_id']; 
  
		  $cols = "
		EMP_Designation_Ver,
		EMP_Salary_Ver,
		EMP_StartDate_Ver,
		EMP_EndDate_Ver,
		EMP_Tenure_Ver,
		EMP_Position_Ver,
		EMP_LastSalaryDrawn_Ver ,
		EMP_Name_Ver,
		EMP_ContactNo_Ver,
		EMP_AgencyAddr_Ver,
		EMP_AgencyPhNo_Ver,
		EMP_IsEmpByFamily_Ver,
		EMP_historynew,
		EMP_CommentsForECT,
		EMP_IsError,
		EMP_SpokeTo,
		EMP_Designation,
		EMP_Department,
		EMP_Status,
		EMP_Phraseology,
		EMP_VerificationLanguage,
		EMP_ModeOfVerification,
		EMP_initiatedByName,
		InsufficiencyComment,
		EMP_VerificationComment,
		EMP_Category,	
		EMP_Sub_Category,	
		EMP_Category_Comments,	
		bot_status,
		is_edit_fields	
 		";
		
  
		  $values = "
		'$EMP_Designation_Ver',
		'$EMP_Salary_Ver',
		'$EMP_StartDate_Ver',
		'$EMP_EndDate_Ver',
		'$EMP_Tenure_Ver',
		'$EMP_Position_Ver',
		'$EMP_LastSalaryDrawn_Ver',
		'$EMP_Name_Ver',
		'$EMP_ContactNo_Ver',
		'$EMP_AgencyAddr_Ver',
		'$EMP_AgencyPhNo_Ver',
		'$EMP_IsEmpByFamily_Ver',
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
		'$EMP_Category',
		'$EMP_Sub_Category',
		'$EMP_Category_Comments',
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
										//echo $imageFileType; exit;
										// Check if image file is a actual image or fake image
										$check = getimagesize($attach["tmp_name"]);
											if($check !== false) {
												//echo "File is an image - " . $check["mime"] . ".";
												$uploadOk = 1;
											} else {
												//echo "File is not an image!"; exit;
												// msg('err',"File is not an image!");
												//$error =1;
												//$uploadOk = 0;
												$uploadOk = 1;
											}
											// Check if file already exists
											if (file_exists($target_file)) {
												//echo "Sorry, file already exists!"; exit;
												msg('err',"Sorry, file already exists!");
												$uploadOk = 0;
												$error =1;
											}
											// Check file size
											if(isset($attachment_name["size"])){
											if ($attachment_name["size"] > 500000) {
												//echo "Sorry, your file is too large!"; exit;
												msg('err',"Sorry, your file is too large!");
												$uploadOk = 0;
												$error =1;
											}}
											// Allow certain file formats
											/*if($imageFileType != "msg" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
												//echo "Sorry, only JPG, JPEG, PNG, MSG & GIF files are allowed!"; exit;
												
												msg('err',"Sorry, only JPG, JPEG, MSG, PNG & GIF files are allowed!");
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
												//echo "Sorry, your file was not uploaded!"; exit;
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
													//echo "Sorry, there was an error uploading your file!"; exit;
													msg('err',"Sorry, there was an error uploading your file!");
													$error =1;
												}
											}	
						
									}
							}
  
 
 
 
 
 
 /*
 
 		  $cols = "
		EMP_Designation_Ver,
		EMP_Salary_Ver,
		EMP_StartDate_Ver,
		EMP_EndDate_Ver,
		EMP_Tenure_Ver,
		EMP_Position_Ver,
		EMP_LastSalaryDrawn_Ver ,
		EMP_Name_Ver,
		EMP_ContactNo_Ver,
		EMP_AgencyAddr_Ver,
		EMP_AgencyPhNo_Ver,
		EMP_IsEmpByFamily_Ver,
		EMP_historynew,
		EMP_CommentsForECT,
		EMP_IsError,
		EMP_SpokeTo,
		EMP_Designation,
		EMP_Department,
		EMP_Status,
		EMP_Phraseology,
		EMP_VerificationLanguage,
		EMP_ModeOfVerification,
		EMP_initiatedByName,
		InsufficiencyComment,
		EMP_VerificationComment,
		EMP_IA_CommunicationMode,
		EMP_ClientDiscrepancy,
		EMP_MandatoryRequirements,
		EMP_IA_Instructions,
		EMP_QC2Comment,
		EMP_QC3Comment
		";
		
  
		  $values = "
		'$EMP_Designation_Ver',
		'$EMP_Salary_Ver',
		'$EMP_StartDate_Ver',
		'$EMP_EndDate_Ver',
		'$EMP_Tenure_Ver',
		'$EMP_Position_Ver',
		'$EMP_LastSalaryDrawn_Ver',
		'$EMP_Name_Ver',
		'$EMP_ContactNo_Ver',
		'$EMP_AgencyAddr_Ver',
		'$EMP_AgencyPhNo_Ver',
		'$EMP_IsEmpByFamily_Ver',
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
		'$IA_CommunicationMode',
		'$ClientDiscrepancy',
		'$MandatoryRequirements',
		'$SpecialInstructions',
		'$QC2Comment',
		'$QC3Comment'
		";
 
 */
 
 ?>