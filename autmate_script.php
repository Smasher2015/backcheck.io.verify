<?php
	
	$sbc	=	$_REQUEST['sbc'];
	$action		=	$_REQUEST['action'];

	//------------PORTAL DB----------------//
	$server		=	'localhost';
	$uid		=   'backglob_db';
	$pass		=	'4KrqZ--rPZ2Q';
	$maindb		=	'backglob_db';
	$portal_table	= 'savvion_records';
	
	
	
	$conn = mysqli_connect($server,$uid,$pass,$maindb);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  //------------PORTAL DB----------------//
	
	/* ------------------------------------------------------------------------------------------------------------------------  */
	
	//------------BOT DB----------------//
	$server2		=	'localhost';
	$uid2			=	'riskdisc_db15';
	$pass2		=	'2B}T~VTh(WRh';
	$maindb2		=	'riskdisc_db15';
	$bot_table	=	'records';
	//	Connect with database and table
	$conn2 = mysqli_connect($server2,$uid2,$pass2,$maindb2);

	// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//------------BOT DB----------------//
	
	/* ------------------------------------------------------------------------------------------------------------------------  */
	
	if ($action == 'post_data')
	{

		
		
		//	$actualcount	=	2 in all cases for temp reason
		//$actualcount 	=	2;
		//$actualcount 	=	iterator_count(new FilesystemIterator($foldername));
		
		// check if record exists; update if already exists otherwise add new record
		$sql			=	"SELECT * FROM `" . $bot_table . "` WHERE retry=1 AND poststatus=0 Order by primid desc limit 3";
		//echo $sql;
		$query			=	mysqli_query($conn2,$sql);
		$numrows 			=	mysqli_num_rows($query);
		$notInserted = array();
		$Inserted = array();
		if($numrows>0){
		while($res = mysqli_fetch_assoc($query)){
		echo "<h2>SUBBAR:".$res['subbarcode']."</h2><br> <h2>COMPONENT:".$res['component']."</h2><br>";
		$scrapdate		=	$res['scrapdate'];
		$barcode		=	$res['barcode'];
		$subbarcode		=	$res['subbarcode'];
		$applicantname	=	$res['applicantname'];
		$creator		=	$res['creator'];
		$priority		=	$res['priority'];
		$assigndate		=	$res['assigndate'];
		$duedate		=	$res['duedate'];
		$clientname		=	$res['clientname'];
		$component		=	strtolower($res['component']);
		$country		=	$res['country'];
		$issuingauthor	=	$res['issuingauthor'];
		$lastupdate		=	$res['lastupdate'];
		$attachments	=	$res['attachments'];
		$foldername		=	$res['foldername'];
		$subaction		=	$res['subaction'];
		$crawltype		=	$res['crawltype'];
		
		
			switch ($component)
			{
				
				
				case "education":
					$EDU_clientrefno					=	$res['EDU_clientrefno'];
					$EDU_dateofbirth					=	$res['EDU_dateofbirth'];
					$EDU_passportno						=	$res['EDU_passportno'];
					$EDU_akaname						=	$res['EDU_akaname'];
					$EDU_gender							=	$res['EDU_gender'];
					$EDU_nationality					=	$res['EDU_nationality'];
					$EDU_arabicname						=	$res['EDU_arabicname'];
					$EDU_universityname					=	$res['EDU_universityname'];
					$EDU_universityaddress				=	$res['EDU_universityaddress'];
					$EDU_city							=	$res['EDU_city'];
					$EDU_country						=	$res['EDU_country'];
					$EDU_telephone						=	$res['EDU_telephone'];
					$EDU_ia_name						=	$res['EDU_ia_name'];
					$EDU_ia_address						=	$res['EDU_ia_address'];
					$EDU_ia_city						=	$res['EDU_ia_city'];
					$EDU_ia_country						=	$res['EDU_ia_country'];
					$EDU_ia_telephone					=	$res['EDU_ia_telephone'];
					$EDU_ia_fax							=	$res['EDU_ia_fax'];
					$EDU_ia_email						=	$res['EDU_ia_email'];
					$EDU_ia_webaddress					=	$res['EDU_ia_webaddress'];
					$EDU_ia_isfake						=	$res['EDU_ia_isfake'];
					$EDU_ia_isonline					=	$res['EDU_ia_isonline'];
					$EDU_textarea3						=	$res['EDU_textarea3'];
					$EDU_history						=	$res['EDU_history'];
					$EDU_historynew						=	$res['EDU_historynew'];
					$EDU_Education_ApplicantName		=	$res['EDU_Education_ApplicantName'];
					$EDU_Education_Qualification		=	$res['EDU_Education_Qualification'];
					$EDU_Education_MajorSubject			=	$res['EDU_Education_MajorSubject'];
					$EDU_Education_DegreeType			=	$res['EDU_Education_DegreeType'];
					$EDU_Education_QualConferredDate	=	$res['EDU_Education_QualConferredDate'];
					$EDU_Education_AttendanceFrom		=	$res['EDU_Education_AttendanceFrom'];
					$EDU_Education_AttendanceTo			=	$res['EDU_Education_AttendanceTo'];
					$EDU_Education_IsGraduate			=	$res['EDU_Education_IsGraduate'];
					$EDU_Education_LastYear				=	$res['EDU_Education_LastYear'];
					$EDU_Education_Timing				=	$res['EDU_Education_Timing'];
					$EDU_SpokeTo						=	$res['EDU_SpokeTo'];
					$EDU_Designation					=	$res['EDU_Designation'];
					$EDU_Department						=	$res['EDU_Department'];
					$EDU_Status							=	$res['EDU_Status'];
					$EDU_Phraseology					=	$res['EDU_Phraseology'];
					$EDU_VerificationLanguage			=	$res['EDU_VerificationLanguage'];
					$EDU_ModeOfVerification				=	$res['EDU_ModeOfVerification'];
					$EDU_initiatedByName				=	$res['EDU_initiatedByName'];
					$EDU_VerificationComment			=	$res['EDU_VerificationComment'];
					$EDU_IsError						=	$res['EDU_IsError'];
					$EDU_CommentsForECT					=	$res['EDU_CommentsForECT'];
					$EDU_IA_CommunicationMode			=	$res['EDU_IA_CommunicationMode'];
					$EDU_MandatoryRequirements			=	$res['EDU_MandatoryRequirements'];
					$EDU_ClientDiscrepancy				=	$res['EDU_ClientDiscrepancy'];
					$EDU_IA_Instructions				=	$res['EDU_IA_Instructions'];
					$EDU_QC2Comment						=	$res['EDU_QC2Comment'];
					$EDU_QC3Comment						=	$res['EDU_QC3Comment'];
					$EDU_crawltype						=	$res['crawltype'];
					$EDU_ApplicantName_Ver				=	$res['EDU_ApplicantName_Ver'];
					$EDU_QualificationSelect_Ver		=	$res['EDU_QualificationSelect_Ver'];
					$EDU_Qualification_Ver				=	$res['EDU_Qualification_Ver'];
					$EDU_MajorSubject_Ver				=	$res['EDU_MajorSubject_Ver'];
					$EDU_DegreeType_Ver					=	$res['EDU_DegreeType_Ver'];
					$EDU_TextField_dateTime1			=	$res['EDU_TextField_dateTime1'];
					$EDU_TextField_dateTime5			=	$res['EDU_TextField_dateTime5'];
					$EDU_TextField_dateTime6			=	$res['EDU_TextField_dateTime6'];
					$EDU_textField33					=	$res['EDU_textField33'];
					$EDU_textField35					=	$res['EDU_textField35'];
					$EDU_textField135					=	$res['EDU_textField135'];
					$EDU_assignedDate					=	$res['assigndate'];
					$EDU_duedate						=	$res['duedate'];
					$EDU_dupstatus						=	$res['EDU_dupstatus'];

					//if ($EDU_crawltype == 1)
					
						//	Its a new record
						$ssql = "INSERT INTO ".$portal_table." (`retry`, `poststatus`, `scrapdate`, `subbarcode`, `barcode`, `applicantname`, `creator`, `priority`, `assigndate`, `duedate`, `clientname`, `component`, `country`, `issuingauthor`, `lastupdate`, `attachments`, `foldername`, `EDU_clientrefno`, `EDU_dateofbirth`, `EDU_passportno`, `EDU_akaname`, `EDU_gender`, `EDU_nationality`, `EDU_arabicname`, `EDU_universityname`, `EDU_universityaddress`, `EDU_city`, `EDU_country`, `EDU_telephone`, `EDU_ia_name`, `EDU_ia_address`, `EDU_ia_city`, `EDU_ia_country`, `EDU_ia_telephone`, `EDU_ia_fax`, `EDU_ia_email`, `EDU_ia_webaddress`, `EDU_ia_isfake`, `EDU_ia_isonline`, `EDU_textarea3`, `EDU_history`, `EDU_historynew`, `EDU_Education_ApplicantName`, `EDU_Education_Qualification`, `EDU_Education_MajorSubject`, `EDU_Education_DegreeType`, `EDU_Education_QualConferredDate`, `EDU_Education_AttendanceFrom`, `EDU_Education_AttendanceTo`, `EDU_Education_IsGraduate`, `EDU_Education_LastYear`, `EDU_Education_Timing`, `EDU_SpokeTo`, `EDU_Designation`, `EDU_Department`, `EDU_Status`, `EDU_Phraseology`, `EDU_VerificationLanguage`, `EDU_ModeOfVerification`, `EDU_initiatedByName`, `EDU_VerificationComment`, `EDU_IsError`, `EDU_CommentsForECT`, `EDU_IA_CommunicationMode`, `EDU_MandatoryRequirements`, `EDU_ClientDiscrepancy`, `EDU_IA_Instructions`, `EDU_QC2Comment`, `EDU_QC3Comment`, `crawltype`, `EDU_ApplicantName_Ver`, `EDU_QualificationSelect_Ver`, `EDU_Qualification_Ver`, `EDU_MajorSubject_Ver`, `EDU_DegreeType_Ver`, `EDU_TextField_dateTime1`, `EDU_TextField_dateTime5`, `EDU_TextField_dateTime6`, `EDU_textField33`, `EDU_textField35`, `EDU_textField135`, `duplicatest`) VALUES (1, 1, '". date('m.d.Y', strtotime('0 days')) . "','". $subbarcode. "','". $barcode. "','". $applicantname. "','". $creator. "','". $priority. "','". $EDU_assignedDate. "','". $EDU_duedate. "','". $clientname. "','". $component. "','". $country. "','". $issuingauthor. "','". date('m.d.Y', strtotime('0 days')) . "','". $attachments . "', '" . $foldername ."', '" . $EDU_clientrefno . "', '" . $EDU_dateofbirth . "', '" . $EDU_passportno . "', '" . $EDU_akaname . "', '" . $EDU_gender . "', '" . $EDU_nationality . "', '" . $EDU_arabicname . "', '" . $EDU_universityname . "', '" . $EDU_universityaddress . "', '" . $EDU_city . "', '" . $EDU_country . "', '" . $EDU_telephone . "', '" . $EDU_ia_name . "', '" . $EDU_ia_address . "', '" . $EDU_ia_city . "', '" . $EDU_ia_country . "', '" . $EDU_ia_telephone . "', '" . $EDU_ia_fax . "', '" . $EDU_ia_email . "', '" . $EDU_ia_webaddress . "', '" . $EDU_ia_isfake . "', '" . $EDU_ia_isonline . "', '" . $EDU_textarea3 . "', '" . $EDU_history . "', '" . $EDU_historynew . "', '" . $EDU_Education_ApplicantName . "', '" . $EDU_Education_Qualification . "', '" . $EDU_Education_MajorSubject . "', '" . $EDU_Education_DegreeType . "', '" . $EDU_Education_QualConferredDate . "', '" . $EDU_Education_AttendanceFrom . "', '" . $EDU_Education_AttendanceTo . "', '" . $EDU_Education_IsGraduate . "', '" . $EDU_Education_LastYear . "', '" . $EDU_Education_Timing . "', '" . $EDU_SpokeTo . "', '" . $EDU_Designation . "', '" . $EDU_Department . "', '" . $EDU_Status . "', '" . $EDU_Phraseology . "', '" . $EDU_VerificationLanguage . "', '" . $EDU_ModeOfVerification . "', '" . $EDU_initiatedByName . "', '" . $EDU_VerificationComment . "', '" . $EDU_IsError . "', '" . $EDU_CommentsForECT . "', '" . $EDU_IA_CommunicationMode . "', '" . $EDU_MandatoryRequirements . "', '" . $EDU_ClientDiscrepancy . "', '" . $EDU_IA_Instructions . "', '" . $EDU_QC2Comment . "', '" . $EDU_QC3Comment . "', '" . $EDU_crawltype . "', '" . $EDU_ApplicantName_Ver . "', '" . $EDU_QualificationSelect_Ver . "', '" . $EDU_Qualification_Ver . "', '" . $EDU_MajorSubject_Ver . "', '" . $EDU_DegreeType_Ver . "', '" . $EDU_TextField_dateTime1 . "', '" . $EDU_TextField_dateTime5 . "', '" . $EDU_TextField_dateTime6 . "', '" . $EDU_textField33 . "', '" . $EDU_textField35 . "', '" . $EDU_textField135 . "', '" . $EDU_dupstatus . "')";
					

					//	Print quert
					//print_r ($ssql);
					
					$squery 	=	mysqli_query($conn,$ssql) or die(mysqli_error());
					if($squery){
					$Inserted[] = 'Yes'; 
					mysqli_query($conn2,"UPDATE records SET  `poststatus` = 1 WHERE `subbarcode`='".$res['subbarcode']."' ") or die(mysqli_error());					
					}else{
					$notInserted[] = $res['subbarcode']; 	
					}
					//echo "<br><h2 id='results'>$component</h2><br><br>";
					break;

				case "employment":
					$EMP_clientrefno					=	$res['EMP_clientrefno'];
					$EMP_DateOfBirth					=	$res['EMP_DateOfBirth'];
					$EMP_PassportNo						=	$res['EMP_PassportNo'];
					$EMP_AKAName						=	$res['EMP_AKAName'];
					$EMP_Gender							=	$res['EMP_Gender'];
					$EMP_Nationality					=	$res['EMP_Nationality'];
					$EMP_ArabicName						=	$res['EMP_ArabicName'];
					$EMP_CompanyName					=	$res['EMP_CompanyName'];
					$EMP_CompanyAddress					=	$res['EMP_CompanyAddress'];
					$EMP_City							=	$res['EMP_City'];
					$EMP_Country						=	$res['EMP_Country'];
					$EMP_Telephone						=	$res['EMP_Telephone'];
					$EMP_WebAddress						=	$res['EMP_WebAddress'];
					$EMP_IA_Name						=	$res['EMP_IA_Name'];
					$EMP_IA_Address						=	$res['EMP_IA_Address'];
					$EMP_IA_City						=	$res['EMP_IA_City'];
					$EMP_IA_Country						=	$res['EMP_IA_Country'];
					$EMP_IA_Telephone					=	$res['EMP_IA_Telephone'];
					$EMP_IA_Fax							=	$res['EMP_IA_Fax'];
					$EMP_IA_Email						=	$res['EMP_IA_Email'];
					$EMP_IA_ContactPerson				=	$res['EMP_IA_ContactPerson'];
					$EMP_textarea3						=	$res['EMP_textarea3'];
					$EMP_history						=	$res['EMP_history'];
					$EMP_historynew						=	$res['EMP_historynew'];
					$EMP_Employment_Designation			=	$res['EMP_Employment_Designation'];
					$EMP_Employment_Salary				=	$res['EMP_Employment_Salary'];
					$EMP_Employment_StartDate			=	$res['EMP_Employment_StartDate'];
					$EMP_Employment_EndDate				=	$res['EMP_Employment_EndDate'];
					$EMP_Employment_Tenure				=	$res['EMP_Employment_Tenure'];
					$EMP_Employment_Position			=	$res['EMP_Employment_Position'];
					$EMP_Employment_LastSalaryDrawn		=	$res['EMP_Employment_LastSalaryDrawn'];
					$EMP_Employment_Name				=	$res['EMP_Employment_Name'];
					$EMP_Employment_ContactNo			=	$res['EMP_Employment_ContactNo'];
					$EMP_Employment_AgencyAddr			=	$res['EMP_Employment_AgencyAddr'];
					$EMP_Employment_AgencyPhNo			=	$res['EMP_Employment_AgencyPhNo'];
					$EMP_Employment_IsEmpByFamily		=	$res['EMP_Employment_IsEmpByFamily'];
					$EMP_SpokeTo						=	$res['EMP_SpokeTo'];
					$EMP_Designation					=	$res['EMP_Designation'];
					$EMP_Department						=	$res['EMP_Department'];
					$EMP_Status							=	$res['EMP_Status'];
					$EMP_Phraseology					=	$res['EMP_Phraseology'];
					$EMP_VerificationLanguage			=	$res['EMP_VerificationLanguage'];
					$EMP_ModeOfVerification				=	$res['EMP_ModeOfVerification'];
					$EMP_initiatedByName				=	$res['EMP_initiatedByName'];
					$EMP_VerificationComment			=	$res['EMP_VerificationComment'];
					$EMP_IsError						=	$res['EMP_IsError'];
					$EMP_CommentsForECT					=	$res['EMP_CommentsForECT'];
					$EMP_IA_CommunicationMode			=	$res['EMP_IA_CommunicationMode'];
					$EMP_MandatoryRequirements			=	$res['EMP_MandatoryRequirements'];
					$EMP_ClientDiscrepancy				=	$res['EMP_ClientDiscrepancy'];
					$EMP_IA_Instructions				=	$res['EMP_IA_Instructions'];
					$EMP_QC2Comment						=	$res['EMP_QC2Comment'];
					$EMP_QC3Comment						=	$res['EMP_QC3Comment'];
					$EMP_crawltype						=	$res['crawltype'];
					$EMP_DesignationSelect_Ver			=	$res['EMP_DesignationSelect_Ver'];
					$EMP_Designation_Ver				=	$res['EMP_Designation_Ver'];
					$EMP_Salary_Ver						=	$res['EMP_Salary_Ver'];
					$EMP_StartDate_Ver					=	$res['EMP_StartDate_Ver'];
					$EMP_EndDate_Ver					=	$res['EMP_EndDate_Ver'];
					$EMP_Tenure_Ver						=	$res['EMP_Tenure_Ver'];
					$EMP_Position_Ver					=	$res['EMP_Position_Ver'];
					$EMP_LastSalaryDrawn_Ver			=	$res['EMP_LastSalaryDrawn_Ver'];
					$EMP_Name_Ver						=	$res['EMP_Name_Ver'];
					$EMP_ContactNo_Ver					=	$res['EMP_ContactNo_Ver'];
					$EMP_AgencyAddr_Ver					=	$res['EMP_AgencyAddr_Ver'];
					$EMP_AgencyPhNo_Ver					=	$res['EMP_AgencyPhNo_Ver'];
					$EMP_IsEmpByFamily_Ver				=	$res['EMP_IsEmpByFamily_Ver'];
					$EMP_assignedDate					=	$res['assigndate'];
					$EMP_duedate						=	$res['duedate'];
					$EMP_dupstatus						=	$res['EMP_dupstatus'];
					
					
						//	Fresh record
						$ssql = "INSERT INTO ".$portal_table." (`retry`, `poststatus`, `gsheetupdate`, `scrapdate`, `subbarcode`, `barcode`, `applicantname`, `creator`, `priority`, `assigndate`, `duedate`, `clientname`, `component`, `country`, `issuingauthor`, `lastupdate`, `attachments`, `foldername`, `EMP_clientrefno`, `EMP_DateOfBirth`, `EMP_PassportNo`, `EMP_AKAName`, `EMP_Gender`, `EMP_Nationality`, `EMP_ArabicName`, `EMP_CompanyName`, `EMP_CompanyAddress`, `EMP_City`, `EMP_Country`, `EMP_Telephone`, `EMP_WebAddress`, `EMP_IA_Name`, `EMP_IA_Address`, `EMP_IA_City`, `EMP_IA_Country`, `EMP_IA_Telephone`, `EMP_IA_Fax`, `EMP_IA_Email`, `EMP_IA_ContactPerson`, `EMP_textarea3`, `EMP_history`, `EMP_historynew`, `EMP_Employment_Designation`, `EMP_Employment_Salary`, `EMP_Employment_StartDate`, `EMP_Employment_EndDate`, `EMP_Employment_Tenure`, `EMP_Employment_Position`, `EMP_Employment_LastSalaryDrawn`, `EMP_Employment_Name`, `EMP_Employment_ContactNo`, `EMP_Employment_AgencyAddr`, `EMP_Employment_AgencyPhNo`, `EMP_Employment_IsEmpByFamily`, `EMP_SpokeTo`, `EMP_Designation`, `EMP_Department`, `EMP_Status`, `EMP_Phraseology`, `EMP_VerificationLanguage`, `EMP_ModeOfVerification`, `EMP_initiatedByName`, `EMP_VerificationComment`, `EMP_IsError`, `EMP_CommentsForECT`, `EMP_IA_CommunicationMode`, `EMP_MandatoryRequirements`, `EMP_ClientDiscrepancy`, `EMP_IA_Instructions`, `EMP_QC2Comment`, `EMP_QC3Comment`, `crawltype`, `EMP_DesignationSelect_Ver`, `EMP_Designation_Ver`, `EMP_Salary_Ver`, `EMP_StartDate_Ver`, `EMP_EndDate_Ver`, `EMP_Tenure_Ver`, `EMP_Position_Ver`, `EMP_LastSalaryDrawn_Ver`, `EMP_Name_Ver`, `EMP_ContactNo_Ver`, `EMP_AgencyAddr_Ver`, `EMP_AgencyPhNo_Ver`, `EMP_IsEmpByFamily_Ver`, `duplicatest`) VALUES (1, 1, 0, '". date('m.d.Y', strtotime('0 days')) . "','". $subbarcode. "','". $barcode. "','". $applicantname. "','". $creator. "','". $priority. "','". $EMP_assignedDate. "','". $EMP_duedate. "','". $clientname. "','". $component. "','". $country. "','". $issuingauthor. "','" . date('m.d.Y', strtotime('0 days')) . "','". $attachments . "', '" . $foldername . "', '" . $EMP_clientrefno . "', '" . $EMP_DateOfBirth . "', '" . $EMP_PassportNo . "', '" . $EMP_AKAName . "', '" . $EMP_Gender . "', '" . $EMP_Nationality . "', '" . $EMP_ArabicName . "', '" . $EMP_CompanyName . "', '" . $EMP_CompanyAddress . "', '" . $EMP_City . "', '" . $EMP_Country . "', '" . $EMP_Telephone . "', '" . $EMP_WebAddress . "', '" . $EMP_IA_Name . "', '" . $EMP_IA_Address . "', '" . $EMP_IA_City . "', '" . $EMP_IA_Country . "', '" . $EMP_IA_Telephone . "', '" . $EMP_IA_Fax . "', '" . $EMP_IA_Email . "', '" . $EMP_IA_ContactPerson . "', '" . $EMP_textarea3 . "', '" . $EMP_history . "', '" . $EMP_historynew  . "', '" . $EMP_Employment_Designation . "', '" . $EMP_Employment_Salary . "', '" . $EMP_Employment_StartDate . "', '" . $EMP_Employment_EndDate . "', '" . $EMP_Employment_Tenure . "', '" . $EMP_Employment_Position . "', '" . $EMP_Employment_LastSalaryDrawn . "', '" . $EMP_Employment_Name . "', '" . $EMP_Employment_ContactNo . "', '" . $EMP_Employment_AgencyAddr . "', '" . $EMP_Employment_AgencyPhNo . "', '" . $EMP_Employment_IsEmpByFamily . "', '" . $EMP_SpokeTo . "', '" . $EMP_Designation . "', '" . $EMP_Department . "', '" . $EMP_Status . "', '" . $EMP_Phraseology . "', '" . $EMP_VerificationLanguage . "', '" . $EMP_ModeOfVerification . "', '" . $EMP_initiatedByName . "', '" . $EMP_VerificationComment . "', '" . $EMP_IsError . "', '" . $EMP_CommentsForECT . "', '" . $EMP_IA_CommunicationMode . "', '" . $EMP_MandatoryRequirements . "', '" . $EMP_ClientDiscrepancy . "', '" . $EMP_IA_Instructions . "', '" . $EMP_QC2Comment . "', '" . $EMP_QC3Comment . "', '" . $EMP_crawltype . "', '" . $EMP_DesignationSelect_Ver . "', '" . $EMP_Designation_Ver . "', '" . $EMP_Salary_Ver . "', '" . $EMP_StartDate_Ver . "', '" . $EMP_EndDate_Ver . "', '" . $EMP_Tenure_Ver . "', '" . $EMP_Position_Ver . "', '" . $EMP_LastSalaryDrawn_Ver . "', '" . $EMP_Name_Ver . "', '" . $EMP_ContactNo_Ver . "', '" . $EMP_AgencyAddr_Ver . "', '" . $EMP_AgencyPhNo_Ver . "', '" . $EMP_IsEmpByFamily_Ver . "', '" . $EMP_dupstatus . "')";
					

					//	Print quert
					//print_r ($ssql);
					
					$squery 	=	mysqli_query($conn,$ssql) or die(mysqli_error());
					if($squery){
					$Inserted[] = 'Yes';
					mysqli_query($conn2,"UPDATE records SET  `poststatus` = 1 WHERE `subbarcode`='".$res['subbarcode']."' ") or die(mysqli_error());					
					}else{
					$notInserted[] = $res['subbarcode']; 	
					}
					//echo "<br><h2 id='results'>$component</h2><br><br>";
					break;
					
				case 'healthlicense':
					$HLT_clientrefno				=	$res['HLT_clientrefno'];
					$HLT_dateofbirth				=	$res['HLT_dateofbirth'];
					$HLT_passportno					=	$res['HLT_passportno'];
					$HLT_akaname					=	$res['HLT_akaname'];
					$HLT_gender						=	$res['HLT_gender'];
					$HLT_nationality				=	$res['HLT_nationality'];
					$HLT_arabicname					=	$res['HLT_arabicname'];
					$HLT_authorityname				=	$res['HLT_authorityname'];
					$HLT_authorityaddress			=	$res['HLT_authorityaddress'];
					$HLT_city						=	$res['HLT_city'];
					$HLT_country					=	$res['HLT_country'];
					$HLT_telephone					=	$res['HLT_telephone'];
					$HLT_website					=	$res['HLT_website'];
					$HLT_ia_name					=	$res['HLT_ia_name'];
					$HLT_ia_address					=	$res['HLT_ia_address'];
					$HLT_ia_city					=	$res['HLT_ia_city'];
					$HLT_ia_country					=	$res['HLT_ia_country'];
					$HLT_ia_telephone				=	$res['HLT_ia_telephone'];
					$HLT_ia_fax						=	$res['HLT_ia_fax'];
					$HLT_ia_email					=	$res['HLT_ia_email'];
					$HLT_ia_webaddress				=	$res['HLT_ia_webaddress'];
					$HLT_textarea3					=	$res['HLT_textarea3'];
					$HLT_history					=	$res['HLT_history'];
					$HLT_historynew					=	$res['HLT_historynew'];
					$HLT_License_Name				=	$res['HLT_License_Name'];
					$HLT_License_LicAttained		=	$res['HLT_License_LicAttained'];
					$HLT_License_ConferredDate		=	$res['HLT_License_ConferredDate'];
					$HLT_License_LicenseType		=	$res['HLT_License_LicenseType'];
					$HLT_License_LicenseNo			=	$res['HLT_License_LicenseNo'];
					$HLT_LicenseAttendfrmDate		=	$res['HLT_LicenseAttendfrmDate'];
					$HLT_LicenseAttendtoDate		=	$res['HLT_LicenseAttendtoDate'];
					$HLT_License_IsLicenseValid		=	$res['HLT_License_IsLicenseValid'];
					$HLT_License_IsLicenseIssued	=	$res['HLT_License_IsLicenseIssued'];
					$HLT_SpokeTo					=	$res['HLT_SpokeTo'];
					$HLT_Designation				=	$res['HLT_Designation'];
					$HLT_Department					=	$res['HLT_Department'];
					$HLT_Status						=	$res['HLT_Status'];
					$HLT_Phraseology				=	$res['HLT_Phraseology'];
					$HLT_VerificationLanguage		=	$res['HLT_VerificationLanguage'];
					$HLT_ModeOfVerification			=	$res['HLT_ModeOfVerification'];
					$HLT_initiatedByName			=	$res['HLT_initiatedByName'];
					$HLT_VerificationComment		=	$res['HLT_VerificationComment'];
					$HLT_IsError					=	$res['HLT_IsError'];
					$HLT_CommentsForECT				=	$res['HLT_CommentsForECT'];
					$HLT_IA_CommunicationMode		=	$res['HLT_IA_CommunicationMode'];
					$HLT_MandatoryRequirements		=	$res['HLT_MandatoryRequirements'];
					$HLT_ClientDiscrepancy			=	$res['HLT_ClientDiscrepancy'];
					$HLT_IA_Instructions			=	$res['HLT_IA_Instructions'];
					$HLT_QC2Comment					=	$res['HLT_QC2Comment'];
					$HLT_QC3Comment					=	$res['HLT_QC3Comment'];
					$HLT_crawltype					=	$res['crawltype'];
					$HltLicense_Name_Ver			=	$res['HltLicense_Name_Ver'];
					$HltLicense_LicAttained_Ver		=	$res['HltLicense_LicAttained_Ver'];
					$HltLicense_ConferredDate_Ver	=	$res['HltLicense_ConferredDate_Ver'];
					$HltLicense_LicenseType_Ver		=	$res['HltLicense_LicenseType_Ver'];
					$HltLicense_LicenseNo_Ver		=	$res['HltLicense_LicenseNo_Ver'];
					$HltLicenseAttendfrmDate_Ver	=	$res['HltLicenseAttendfrmDate_Ver'];
					$HltLicenseAttendtoDate_Ver		=	$res['HltLicenseAttendtoDate_Ver'];
					$HltLicense_IsLicValid_Ver		=	$res['HltLicense_IsLicValid_Ver'];
					$HltLicense_IsLicIssued_Ver		=	$res['HltLicense_IsLicIssued_Ver'];
					$HLT_assignedDate				=	$res['assigndate'];
					$HLT_duedate					=	$res['duedate'];
					$HLT_dupstatus					=	$res['HLT_dupstatus'];
					
					
						//	Fresh record
						$ssql = "INSERT INTO ".$portal_table." (`retry`, `poststatus`, `scrapdate`, `subbarcode`, `barcode`, `applicantname`, `creator`, `priority`, `assigndate`, `duedate`, `clientname`, `component`, `country`, `issuingauthor`, `lastupdate`, `attachments`, `foldername`, `HLT_clientrefno`, `HLT_dateofbirth`, `HLT_passportno`, `HLT_akaname`, `HLT_gender`, `HLT_nationality`, `HLT_arabicname`, `HLT_authorityname`, `HLT_authorityaddress`, `HLT_city`, `HLT_country`, `HLT_telephone`, `HLT_website`, `HLT_ia_name`, `HLT_ia_address`, `HLT_ia_city`, `HLT_ia_country`, `HLT_ia_telephone`, `HLT_ia_fax`, `HLT_ia_email`, `HLT_ia_webaddress`, `HLT_textarea3`, `HLT_history`, `HLT_historynew`, `HLT_License_Name`, `HLT_License_LicAttained`, `HLT_License_ConferredDate`, `HLT_License_LicenseType`, `HLT_License_LicenseNo`, `HLT_LicenseAttendfrmDate`, `HLT_LicenseAttendtoDate`, `HLT_License_IsLicenseValid`, `HLT_License_IsLicenseIssued`, `HLT_SpokeTo`, `HLT_Designation`, `HLT_Department`, `HLT_Status`, `HLT_Phraseology`, `HLT_VerificationLanguage`, `HLT_ModeOfVerification`, `HLT_initiatedByName`, `HLT_VerificationComment`, `HLT_IsError`, `HLT_CommentsForECT`, `HLT_IA_CommunicationMode`, `HLT_MandatoryRequirements`, `HLT_ClientDiscrepancy`, `HLT_IA_Instructions`, `HLT_QC2Comment`, `HLT_QC3Comment`,`crawltype`, `HltLicense_Name_Ver`, `HltLicense_LicAttained_Ver`, `HltLicense_ConferredDate_Ver`, `HltLicense_LicenseType_Ver`, `HltLicense_LicenseNo_Ver`, `HltLicenseAttendfrmDate_Ver`, `HltLicenseAttendtoDate_Ver`, `HltLicense_IsLicValid_Ver`, `HltLicense_IsLicIssued_Ver`, `duplicatest`) VALUES (1, 1, '". date('m.d.Y', strtotime('0 days')) . "','". $subbarcode. "','". $barcode. "','". $applicantname. "','". $creator. "','". $priority. "','". $HLT_assignedDate. "','". $HLT_duedate. "','". $clientname. "','". $component. "','". $country. "','". $issuingauthor. "','". date('m.d.Y', strtotime('0 days')) . "','". $attachments . "', '" . $foldername ."', '" . $HLT_clientrefno . "','" . $HLT_dateofbirth . "','" . $HLT_passportno . "','" . $HLT_akaname . "','" . $HLT_gender . "','" . $HLT_nationality . "','" . $HLT_arabicname . "','" . $HLT_authorityname . "','" . $HLT_authorityaddress . "','" . $HLT_city . "','" . $HLT_country . "','" . $HLT_telephone . "','" . $HLT_website . "','" . $HLT_ia_name . "','" . $HLT_ia_address . "','" . $HLT_ia_city . "','" . $HLT_ia_country . "','" . $HLT_ia_telephone . "','" . $HLT_ia_fax . "','" . $HLT_ia_email . "','" . $HLT_ia_webaddress . "','" . $HLT_textarea3 . "','" . $HLT_history . "','" . $HLT_historynew . "', '" . $HLT_License_Name . "', '" . $HLT_License_LicAttained . "', '" . $HLT_License_ConferredDate . "', '" . $HLT_License_LicenseType . "', '" . $HLT_License_LicenseNo . "', '" . $HLT_LicenseAttendfrmDate . "', '" . $HLT_LicenseAttendtoDate . "', '" . $HLT_License_IsLicenseValid . "', '" . $HLT_License_IsLicenseIssued . "', '" . $HLT_SpokeTo . "', '" . $HLT_Designation . "', '" . $HLT_Department . "', '" . $HLT_Status . "', '" . $HLT_Phraseology . "', '" . $HLT_VerificationLanguage . "', '" . $HLT_ModeOfVerification . "', '" . $HLT_initiatedByName . "', '" . $HLT_VerificationComment . "', '" . $HLT_IsError . "', '" . $HLT_CommentsForECT . "', '" . $HLT_IA_CommunicationMode . "', '" . $HLT_MandatoryRequirements . "', '" . $HLT_ClientDiscrepancy . "', '" . $HLT_IA_Instructions . "', '" . $HLT_QC2Comment . "', '" . $HLT_QC3Comment . "', '" . $HLT_crawltype . "', '" . $HltLicense_Name_Ver . "', '" . $HltLicense_LicAttained_Ver . "', '" . $HltLicense_ConferredDate_Ver . "', '" . $HltLicense_LicenseType_Ver . "', '" . $HltLicense_LicenseNo_Ver . "', '" . $HltLicenseAttendfrmDate_Ver . "', '" . $HltLicenseAttendtoDate_Ver . "', '" . $HltLicense_IsLicValid_Ver . "', '" . $HltLicense_IsLicIssued_Ver . "', '" . $HLT_dupstatus . "')";
					

					//	Print quert
					//print_r ($ssql);
					
					$squery 	=	mysqli_query($conn,$ssql) or die(mysqli_error());
					if($squery){
					$Inserted[] = 'Yes'; 
					mysqli_query($conn2,"UPDATE records SET  `poststatus` = 1 WHERE `subbarcode`='".$res['subbarcode']."' ") or die(mysqli_error());
					}else{
					$notInserted[] = $res['subbarcode']; 	
					}
					//echo "<br><h2 id='results'>$component</h2><br><br>";
					break;
			}
		//}
		
	} //while
	
	echo "<h3>Total (".count($Inserted).") records inserted.</h3><br>";
	echo "<h3>These records not inserted (".implode(",",$notInserted).") records inserted.</h3><br>";
	
	}
	
	
	// phase 2
	
		$sql2 =	"SELECT * FROM ".$portal_table." WHERE bot_status=1 ";
		
		$query2			=	mysqli_query($conn,$sql2);
		$numrows2 			=	mysqli_num_rows($query2);
		if($numrows2>0){
		while($res2 = mysqli_fetch_assoc($query2)){
		
		$upd = "UPDATE $bot_table SET bot_status = '1' WHERE subbarcode='".$res2['subbarcode']."' ";
		mysqli_query($conn2,$upd);
		
		}
		mysqli_free_result($query);		
		
	}
	
	}
	
	
	
	//$sbc	=	$_REQUEST['post_subbarcode'];
	
	if(isset($sbc)  && $action=='updt_bstatus'){
	
		$upd = "UPDATE ".$portal_table." SET bot_status = 0 WHERE subbarcode='".$sbc."' ";
		mysqli_query($conn,$upd);	
		$upd2 = "UPDATE ".$bot_table." SET bot_status = 0 WHERE subbarcode='".$sbc."' ";
		mysqli_query($conn2,$upd2);
		
		echo "BOT AND PORTAL bot_status UPDATED";
		
	}
	
	

	
	
	mysqli_close($conn);
	mysqli_close($conn2);

?>
