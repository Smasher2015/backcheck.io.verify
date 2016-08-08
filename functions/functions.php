<?php 
$_REQUEST['ERR']='';
$_REQUEST['SCS']='';
$_REQUEST['CNT']=0;

$_REQUEST['TERR']=array();
$_REQUEST['TSCS']=array();

define("SUDONYMS",getRandSdoNms());   

//ini_set('display_errors', 0);
//ini_set('log_errors', 1);
//Hasan Working Start
function insertleads2($comp_arr){
$ch = curl_init();
// bitrix admin: 480=Sadia 507=Saima 529=Sharjeel
$bitrix_admin_id = ($comp_arr['country_id']!=171)?529:591; 

 $query_string="action=lead_add&pams[CREATED_BY_ID]=".$bitrix_admin_id."&pams[ASSIGNED_BY_ID]=".$bitrix_admin_id."&pams[TITLE]=".urlencode($comp_arr['name'])."&pams[NAME]=".urlencode($comp_arr['name'])."&pams[COMMENTS]=".urlencode($comp_arr['comment'])."&pams[EMAIL_WORK]=".$comp_arr['email']."&pams[PHONE_WORK]=".$comp_arr['phone']."&pams[SOURCE_ID]=".urlencode("Verification System")."&pams[Erp Id]=".$comp_arr['erpid']."";
    //echo $query_string."<br />"; 
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
	//var_dump($insertedleadid); die;
	$leadid=$insertedleadid->leadinserted_id;
    // Close the cURL resource, and free system resources
    curl_close($ch);
	return $leadid;
}
function add_task($task_arr,$parent_id=0){
 $ch = curl_init();
 // bitrix admin: 480=Sadia 507=Saima 529=Sharjeel
 $bitrix_admin_id = ($task_arr['country_id']!=171)?529:591;

 $enddateplan=getdatedifference(date("Y-m-d"),8);
 $deadline=getdatedifference(date("Y-m-d"),TAT);
 $remainderdate=getdatedifference(date("Y-m-d"),2);
 $query_string="action=task_add&CREATED_BY=".$bitrix_admin_id."&task_name=".$task_arr['task_name']."&desc=".$task_arr['task_desc']."&time_estimate=2&PARENT_ID=$parent_id&user_id=".$task_arr['user_id']."&group_id=".$task_arr['group_id']."&START_DATE_PLAN=".date("Y-m-d")."&END_DATE_PLAN=".$enddateplan."&DEADLINE=$deadline&remainderdate=$remainderdate";
//echo $query_string;die;
    curl_setopt($ch,CURLOPT_URL, BITRIX_URL);
    // Set a referer
   curl_setopt($ch, CURLOPT_HEADER, FALSE);
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
    // Download the given URL, and return output
    $output = curl_exec($ch);
	$insertedtaskid=json_decode($output);
   $bitrixtid=$insertedtaskid->insertedtaskid;
	//$db->update("bitrix_id='$bitrixuid'","users","user_id=".(int)$user_arr['user_id']."");
    // Close the cURL resource, and free system resources
  curl_close($ch);
   return  $bitrixtid;
}
// delete task from bitrix
function task_del($task_id){
	 	 
	 $ch = curl_init();
	
	$query_string="action=task_del&task_id=".$task_id;
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
   $msg=$info->deleted;
	//$db->update("bitrix_id='$bitrixuid'","users","user_id=".(int)$user_arr['user_id']."");
    // Close the cURL resource, and free system resources
  curl_close($ch);
   return  $msg;
}
function getworkgroup(){
	$ch = curl_init();
    $query_string="action=getgroups";
    curl_setopt($ch, CURLOPT_URL,BITRIX_URL);
    // Set a referer
   curl_setopt($ch, CURLOPT_HEADER, FALSE);
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
    // Download the given URL, and return output
    $output = curl_exec($ch);
	$groups=json_decode($output);
	return $groups;
    // Close the cURL resource, and free system resources
    curl_close($ch);
}
//Hasan Working End

// Start By KHL //

/* $MESS["TASKS_STATUS_1"] = "New";
$MESS["TASKS_STATUS_2"] = "Pending";
$MESS["TASKS_STATUS_3"] = "In Progress";
$MESS["TASKS_STATUS_4"] = "Supposedly completed";
$MESS["TASKS_STATUS_5"] = "Completed";
$MESS["TASKS_STATUS_6"] = "Deferred";
$MESS["TASKS_STATUS_7"] = "Declined";
$MESS["TASKS_PRIORITY"] = "Priority";
$MESS["TASKS_PRIORITY_0"] = "Low";
$MESS["TASKS_PRIORITY_1"] = "Normal";
$MESS["TASKS_PRIORITY_2"] = "High"; */

function edit_get_task_status($task_id,$status=0,$is_update=false){
 $ch = curl_init();
 if($is_update){
	$query_string="action=set_task_status&st=$status&task_id=".$task_id;
 }else{
	$query_string="action=get_task_status&task_id=".$task_id;	 
 }
 
 
    curl_setopt($ch,CURLOPT_URL, BITRIX_URL);
    // Set a referer
   curl_setopt($ch, CURLOPT_HEADER, FALSE);
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
    // Download the given URL, and return output
    $output = curl_exec($ch);
	$insertedtaskid=json_decode($output);
   $task_status=$insertedtaskid->task_status;
	//$db->update("bitrix_id='$bitrixuid'","users","user_id=".(int)$user_arr['user_id']."");
    // Close the cURL resource, and free system resources
  curl_close($ch);
   return  $task_status;
}
// end by khl //






function clientulkupload(){
			global $db,$COMINF,$LEVEL; //print_r($_REQUEST);  exit;
			$uID = $_SESSION['user_id'];
			// CIC checks 9,39,40,41
			$cic_check_needed = ((isset($_REQUEST['cic_check_needed'])) && $_REQUEST['cic_check_needed'] == 'cic_req')?'cic_selected':'';
			$order_typ = ((isset($_REQUEST['ord_typ'])))?$_REQUEST['ord_typ']:'';
			
			
			$any_error = false;
			$is_duplicat = (isset($_REQUEST['is_duplicat']))?true:false;
			//echo 'is_duplicat: '.$is_duplicat; exit;
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
			if(count($_REQUEST['checks1'])==0) msg('err',"You don't have check(s) in your package, please contact system admin!");
			$is_order_id = ChecksAmount($_REQUEST,$company_id);
			if($is_order_id){
			if($_REQUEST['ERR']==''){
				$nums = 1;
				while(isset($_REQUEST['ename'.$nums])){
					if(isset($_REQUEST['case'.$nums])){
						
					
					
					//add new fields
					$etitle = addslashes($_REQUEST['etitle'.$nums]);

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

					$gender = addslashes($_REQUEST['gender'.$nums]);
					$first_ename = addslashes($_REQUEST['ename'.$nums]);	
					$last_ename = addslashes($_REQUEST['last_ename'.$nums]);
					$fullName = ($first_ename!="" && $last_ename!="")?$first_ename." ".$last_ename:"";
					$ename = ($fullName!="")?$fullName:$first_ename;
					$fname 	= addslashes($_REQUEST['fname'.$nums]);
					$empcode = addslashes($_REQUEST['empcode'.$nums]);
					$cnic = addslashes($_REQUEST['cnic'.$nums]);
					$dob = addslashes($_REQUEST['dob'.$nums]);
					$v_address = addslashes($_REQUEST['v_address'.$nums]);
					$image='images/default.png';
					$thum= 'images/default.png';				
					if(isset($_REQUEST['image'.$nums])){
						$image = addslashes($_REQUEST['image'.$nums]);
						$thum = addslashes($_REQUEST['thum'.$nums]);
					}
					$checkEmpId = checkEmpId($empcode,1,$company_id);
					if($checkEmpId != 'not-found'){
					$errMsg = "Employee Code already exists ! ";
					
					//msg('err',"Employee Code already exists ! $empcode");
					//header("location:".SURL."?action=add&atype=newcase&err=1&msg=".$errMsg);
					//exit;
					}
					
					if(!$is_duplicat){
					/* if($cnic=='' || strlen($cnic) < 13){
					$errMsg = "Please enter valid ID Card Number. <br> It must be greater than or equal to 13 number";
					msg('err',$errMsg);	
					$any_error = true;
					} */
										
					$checkCnic = checkCnic($cnic,1,$company_id);
					
					if($checkCnic != 'not-found'){
					$errMsg = ID_CARD_NUM." already exists ! <br /> $cnic"; //exit;
						
					msg('err',$errMsg);
					$any_error = true;
					}
					}
				//echo " $any_error Developer Mode On $empcode $fname $empcode $cnic cnic $is_duplicat";	exit;
					if(!$any_error){
						
					//--------------------If candidate id found then add checks against that ID Begin---------------//
					$checkEmpId = checkEmpId($empcode,1,$company_id);
					
					if($checkEmpId != 'not-found'){
						
					$where = "emp_id='".$empcode."' AND com_id='".$company_id."' ";
					$Q = $db->select("ver_data","v_id",$where); 
					$rsVData = mysql_fetch_assoc($Q);
					$VID=$rsVData['v_id'];
					$isInserted=true;
					if($cnic!=""){
					$Sel_v_nic = $db->select("ver_data","v_nic",$where); 
					$rsV_nic = mysql_fetch_assoc($Sel_v_nic);
					if($rsV_nic['v_nic'] == ''){
					$col_v_nic = "v_nic='$cnic'";
					}
					}
					if($dob!=""){
					$coma =	($col_v_nic!="")?",":"";
					$col_v_dob = "$coma v_dob='$dob'";	
					}
					//$db->update("$col_v_nic $col_v_dob","ver_data","v_id=$VID");
					//$db->update("v_id=$VID","client_invoices","id=$order_id");
					//echo "Employee Code already exists ! <br /> $empcode"; exit;
					//$isErr = 1;
					}else{
					
					$cols="thum,image,v_country,v_title,v_gender, v_first_name,v_last_name,v_name, v_ftname,v_nic,v_dob,v_address,com_id,v_recdate,v_uadd, emp_id";
					$values="'$thum','$image','$country','$etitle','$gender','$first_ename','$last_ename','$ename','$fname','$cnic','$dob','$v_address',$company_id,'$recdate',$uID, '".$empcode."'";
					//echo "cols: ".$cols." values: ".$values; exit; caddress
					
					
					$isInserted=$db->insert($cols,$values,"ver_data");
					$VID=$db->insertedID;
					$bCode = cBCode($company_id,$VID);
					//echo "v_bcode='$bCode'"; die;
					
					if($cic_check_needed=='cic_selected'){
					if(in_array(9,$_REQUEST['ischeck'.$nums])){
					$checkCount = count($_REQUEST['ischeck'.$nums])+3;
									
					}else{
						
					$checkCount = count($_REQUEST['ischeck'.$nums])+4;
										
					}
					}else{
					$checkCount = count($_REQUEST['ischeck'.$nums]);
					}
					// send to bitrix
					$lead_array=array();
					$lead_array['name']='Case For '.$ename ." - $bCode - Total Checks: ".$checkCount;
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
					$order_id = ChecksAmount($_REQUEST,$company_id,false,true,$VID);
					//$db->update("v_id=$VID","client_invoices","id=$order_id");
					}
					//--------------------If candidate id found then add checks against that ID End---------------//
					$any_error = false;
					if($isInserted){
					$cc=0;	
					$check_array = array();
							// if optional cic check selected 
							if($cic_check_needed=='cic_selected'){
							addCICCheckInCase($_REQUEST['checks'.$nums],$VID,$company_id,$country,$workgroupInfo,$uID,$task_array['comment'],$ename);
							}
								
							foreach($_REQUEST['checks'.$nums] as $check){
								
								$chkk = explode("_",$check);
								$chk = $chkk[0];
								$check_array[] = $chk;
								// check if last counter arraived
								
								if(is_array($_REQUEST['ischeck'.$nums]) && in_array($check,$_REQUEST['ischeck'.$nums])){
								$bCode = cBCode(0,0,$VID,$chk);
								$as_cost2 = getCheckAmount($company_id,$chk);
					// khl	//		
								$tabl = "analyst_roles ar INNER JOIN checks c ON ar.checks_id=c.checks_id ";
								$cols = "ar.analyst_id,c.checks_title,c.group_id as group_id";
								$selRoles = $db->select($tabl,$cols," ar.checks_id='".$chk."'");
								$resRoles = mysql_fetch_assoc($selRoles);
								$tabl = "`teamlead_checks` tc INNER JOIN users uc ON uc.`user_id`=tc.`team_lead_id`";
								$cols = "uc.`bitrix_id` AS `bitrix_uid`,uc.`user_id` AS `user_id`";
								$selbitrixusr = $db->select($tabl,$cols,"tc.checks_id='".$resRoles['group_id']."'");
								$bitrixuserid=mysql_fetch_assoc($selbitrixusr);
								$bitrixuserid2=($country!=171)?$AssignedToBitrix:$bitrixuserid['bitrix_uid'];
								$userid2=($country!=171)?$AssignedToSys:$bitrixuserid['user_id'];
								$analyst_id = ($resRoles['analyst_id'])?$resRoles['analyst_id']:'';
								$checks_title = ($resRoles['checks_title'])?$resRoles['checks_title']:'';
									//echo "SELECT $cols FROM $tabl WHERE checks_id='".$check."'"; die();
					// khl //	
					//--------------------- auto assign checks removed -------------------------//
								//$cols="as_bcode,v_id,checks_id,as_uadd,user_id,as_status, as_addate, as_date, how_rec_checks";
								//$values="'$bCode',$VID,$chk,$uID,'$analyst_id','Open', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP,'$how_rec_checks'";
								//$uInfo  = getUserInfo($analyst_id);
								// send notification to analyst		
								//$vData  = getVerdata($VID);
								//addActivity('ascase',"$vData[v_name] Assigned to [ $uInfo[first_name] ]",$LEVEL,'',$VID,'','assign');
								//$isUpdate = $db->update("v_status='Open'","ver_data","v_id=$VID");
					//--------------------- auto assign checks removed -------------------------//
								
								// assign education checks to Sarfaraz
								//----------------- Temporary Commented --------------------//
								$assign_cols = "";
								$assign_values = "";
								$assign_cols = "user_id,as_status, ";
								$assign_values = "'".$userid2."','Open', ";
								$db->update("v_status='Open'","ver_data","v_id=$VID");
								//----------------- Temporary Commented --------------------//	
								$cols="as_bcode,v_id,checks_id, $assign_cols as_uadd , as_addate, as_date, how_rec_checks,as_cost2";
								$values="'$bCode',$VID,'$chk', $assign_values '$uID', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP,'$how_rec_checks','$as_cost2'";
								if($db->insert($cols,$values,"ver_checks")){
								$CID=$db->insertedID;
							
							
							
							
					if($chk == 1){
						$chknumber = $chkk[1];
					$colsAddata = " (as_id,d_type,d_mtitle,d_stitle,d_num,user_id) ";
					$valsAddata = " ($CID,'multy','University Name','".$_REQUEST['uni_name1'."_".$chknumber]."',1,$uID),
					($CID,'multy','Registration Number','".$_REQUEST['reg_num1'."_".$chknumber]."',2,$uID),
					($CID,'multy','Degree Title','".$_REQUEST['degree1'."_".$chknumber]."',3,$uID),
					($CID,'multy','Remarks','".$_REQUEST['remarks1'."_".$chknumber]."',4,$uID),
					($CID,'multy','Passing Year','".$_REQUEST['pass_year1'."_".$chknumber]."',5,$uID),
					($CID,'multy','Serial No','".$_REQUEST['serial_no1'."_".$chknumber]."',6,$uID)";
					//insertSet
					
					
					
					$db->insertMulti($colsAddata,$valsAddata,'add_data');
					}
							
							
							
					if($chk == 2){ $chknumber = $chkk[1];
					$colsAddata = " (as_id,d_type,d_mtitle,d_stitle,d_num,user_id) ";
					$valsAddata = "($CID,'multy','Company Name','".$_REQUEST['company_name1'."_".$chknumber]."',1,$uID),
									($CID,'multy','Date of Joining','".$_REQUEST['date_of_join1'."_".$chknumber]."',2,$uID),
									($CID,'multy','Employement Status','".$_REQUEST['emp_status1'."_".$chknumber]."',3,$uID),
									($CID,'multy','Last Working Day','".$_REQUEST['last_work_day1'."_".$chknumber]."',4,$uID),
									($CID,'multy','Last Designation','".$_REQUEST['last_designation1'."_".$chknumber]."',5,$uID),
									($CID,'multy','Last Place of Posting','".$_REQUEST['last_place_posted1'."_".$chknumber]."',6,$uID)
									,
									($CID,'multy','Last Drawn Salary','".$_REQUEST['last_drawn_salary1'."_".$chknumber]."',7,$uID)";	
					$company_name = $_REQUEST['company_name1'."_".$chknumber];
					 
					$db->insertMulti($colsAddata,$valsAddata,'add_data');
					sendSurveyFormToHR($CID,$company_name);
					}		
							
								
/*							if($chk == 1)
							{	
							$chknumber = $chkk[1];
 							 
								$cols="as_id,d_type,d_mtitle, d_stitle, d_num, user_id, d_isdlt";
								$values="'$CID','multy','University Name', '".$_REQUEST['uni_name1'."_".$chknumber]."', '1', '".$_SESSION['user_id']."', '0'";
								$db->insert($cols,$values,"add_data");

								$cols="as_id,d_type,d_mtitle, d_stitle, d_num, user_id, d_isdlt";
								$values="'$CID','multy','Registration Number', '".$_REQUEST['reg_num1'."_".$chknumber]."', '1', '".$_SESSION['user_id']."', '0'";
								$db->insert($cols,$values,"add_data");

								$cols="as_id,d_type,d_mtitle, d_stitle, d_num, user_id, d_isdlt";
								$values="'$CID','multy','Degree Title', '".$_REQUEST['degree1'."_".$chknumber]."', '1', '".$_SESSION['user_id']."', '0'";
								$db->insert($cols,$values,"add_data");

								$cols="as_id,d_type,d_mtitle, d_stitle, d_num, user_id, d_isdlt";
								$values="'$CID','multy','Remarks', '".$_REQUEST['remarks1'."_".$chknumber]."', '1', '".$_SESSION['user_id']."', '0'";
								$db->insert($cols,$values,"add_data");

								$cols="as_id,d_type,d_mtitle, d_stitle, d_num, user_id, d_isdlt";
								$values="'$CID','multy','Passing Year', '".$_REQUEST['pass_year1'."_".$chknumber]."', '1', '".$_SESSION['user_id']."', '0'";
								$db->insert($cols,$values,"add_data");

								$cols="as_id,d_type,d_mtitle, d_stitle, d_num, user_id, d_isdlt";
								$values="'$CID','multy','Serial No', '".$_REQUEST['serial_no1'."_".$chknumber]."', '1', '".$_SESSION['user_id']."', '0'";
								$db->insert($cols,$values,"add_data");
							 
 							}

								
							if($chk == 2)
							{	
							$chknumber = $chkk[1];
 							 
								$cols="as_id,d_type,d_mtitle, d_stitle, d_num, user_id, d_isdlt";
								$values="'$CID','multy','Company Name', '".$_REQUEST['company_name1'."_".$chknumber]."', '1', '".$_SESSION['user_id']."', '0'";
								$db->insert($cols,$values,"add_data");

								$cols="as_id,d_type,d_mtitle, d_stitle, d_num, user_id, d_isdlt";
								$values="'$CID','multy','Date of Joining', '".$_REQUEST['date_of_join1'."_".$chknumber]."', '1', '".$_SESSION['user_id']."', '0'";
								$db->insert($cols,$values,"add_data");

								$cols="as_id,d_type,d_mtitle, d_stitle, d_num, user_id, d_isdlt";
								$values="'$CID','multy','Employement Status', '".$_REQUEST['emp_status1'."_".$chknumber]."', '1', '".$_SESSION['user_id']."', '0'";
								$db->insert($cols,$values,"add_data");

								$cols="as_id,d_type,d_mtitle, d_stitle, d_num, user_id, d_isdlt";
								$values="'$CID','multy','Last Working Day', '".$_REQUEST['last_work_day1'."_".$chknumber]."', '1', '".$_SESSION['user_id']."', '0'";
								$db->insert($cols,$values,"add_data");

								$cols="as_id,d_type,d_mtitle, d_stitle, d_num, user_id, d_isdlt";
								$values="'$CID','multy','Last Designation', '".$_REQUEST['last_designation1'."_".$chknumber]."', '1', '".$_SESSION['user_id']."', '0'";
								$db->insert($cols,$values,"add_data");

								$cols="as_id,d_type,d_mtitle, d_stitle, d_num, user_id, d_isdlt";
								$values="'$CID','multy','Last Place of Posting', '".$_REQUEST['last_place_posted1'."_".$chknumber]."', '1', '".$_SESSION['user_id']."', '0'";
								$db->insert($cols,$values,"add_data");
							 
 							}
*/
								
								
					//$a_info = "A new $checks_title check assigned from ".$_SESSION['fname']." ( $COMINF[name] ) " ;
					//createNotifications(4,$a_info,'',$analyst_id);
									$attachments=array();
									for($count=100;$count<=120;$count++){
										if(is_array($_REQUEST['docxs'.$nums.$count.$check])){
											foreach($_REQUEST['docxs'.$nums.$count.$check] as $key=>$docxs){
												$att_file_name 	= $_REQUEST['docxs_name'.$nums.$count.$check][$key]; 
												$att_file_path 	= $docxs; 
												$cols = "case_id,checks_id,att_file_path,att_file_name";
												$values = "$VID,$CID,'$att_file_path','$att_file_name'";
												$attachments[]="Attachment Link : $att_file_path";
												$db->insert($cols,$values,'attachments');
											}
										}
									}
									$task_array=array();
								$task_array['task_name']='Check For '.$ename ." - $bCode";
								$task_array['task_desc']="Gender : $gender
								Father Name : $fname
								NIC : $cnic
								Date of Birth : $dob
								Received Date : $recdate
								Attachments :
								".implode(",",$attachments)."";
								$task_array['user_id']=($country!=171)?$AssignedToBitrix:$bitrixuserid2;
								$task_array['group_id']=($country!=171)?$Work_Group_id:$resRoles['group_id'];
								$task_array['country_id']=$country;
								//print_r($task_array);die;
								$bitrixctid=add_task($task_array,$bitrixlid);
								$db->update("bitrixtid=$bitrixctid","ver_checks","as_id=$CID");
								}else{
									 msg('err',"Check insertion error!");
									$any_error = true;
								}
								}
							}	
							
					}else{
						 msg('err',"Case [$ename] insertion error!");
					}
						$nums++;
					}
					
					else
					
					{
						msg('err',"Error Occured !");
						//echo "Error Occured Here"; exit;
						$any_error = true;
					}
					
					}
				}
				
					
					 
					if(!$any_error && $_REQUEST['ERR']==''){
					msg("sec","Records added successfully...");	
					// insert notificaification to manager about new cases
					$a_info = ($_REQUEST['is_bulk']==1) ? "New Cases added with Bulk Uploaded by ".$_SESSION['fname']." ( $info_title ) " : "New Case Added by ".$_SESSION['fname']." ( $info_title ) ";
					 
					$notify = createNotifications(4,$a_info,$VID,'','','',$CID);
					if($LEVEL == 5)
					{
						$db->update("is_responed=1","users","user_id=$uID");
						
						

// email sent to applicant's invited by

				$data_table = 
					'
					<table width="100%" border="0" style="border-collapse: collapse; color:#999;  ">
						<tr>
						<td width="25%" style="font-size:14px; padding:5px;" colspan="3"><strong>'.$_SESSION['fname'].'</strong> have submitted the details.</td>
						</tr>
						 
						<tr>
						<td width="25%" style="font-size:14px; padding:5px;" colspan="3">&nbsp;</td>
						</tr>
					</table>
 					 ';

				$email_title = $_SESSION['fname'].' have submitted the details.';
				
				$QS = $db->select("check_date","*","user_id = $uID"); 				
				$invdetail = mysql_fetch_array($QS);
				$userInfo2 = getUserInfo($invdetail['invited_by']);
				$toEmail = $userInfo2['email'];
				
				$fullName = $userInfo2['first_name']." ".$userInfo2['last_name'];
				
				  emailTmp( $data_table, $email_title,$toEmail,'','','','',$fullName);

// email sent to... end here //
						
						
						
						
						
						
					}
					}
					
										
					
					
		
			}
	}
	}
	// by khl old
		function clientBulkUploadAjax(){
		
			global $db,$COMINF,$LEVEL;
			
			$nadrabulk= $_REQUEST['nadrabulk'];
			
			if($LEVEL!=4){
				$company_id = $_REQUEST['clntid'];
				$lev = getLevel($LEVEL);
				$info_title = $lev['level_name'];
				$how_rec_checks = ($nadrabulk==1)?'nadra_bulk':$_REQUEST['how_rec_checks'];
				
			if($company_id=="" || (!is_numeric($company_id))){
				
			echo "Please select a client !"; exit;
			}
			if($how_rec_checks==""){
				
			echo "Please select how do you receive checks ?"; exit;
			}
			}else{
				$company_id = $COMINF['id'];
				$info_title = $COMINF['name'];
				$how_rec_checks = ($nadrabulk==1)?'nadra_bulk':"by_client";
			}			
			
			
			$uID = $_SESSION['user_id'];
			$recdate = date("Y-m-d");
			
			if(count($_REQUEST['checks1'])==0) msg('err',"You don't have check(s) in your package, please contact system admin!");
			if($_REQUEST['ERR']==''){
				
				$nums = 1;
				$nums2 = 1;
				$isErr = 0;
				$ErrMsg = array();
				$listOfCnic= array();
				$listOfEmp= array();
				
				while(isset($_REQUEST['ename'.$nums2])){
					
					if(isset($_REQUEST['case'.$nums2])){
					
					$ename = addslashes($_REQUEST['ename'.$nums2]);
					$fname 	= addslashes($_REQUEST['fname'.$nums2]);
					$empcode = addslashes($_REQUEST['empcode'.$nums2]);
					$cnic = addslashes($_REQUEST['cnic'.$nums2]);
					$dob = addslashes($_REQUEST['dob'.$nums2]);
					$image='images/default.png';
					$thum= 'images/default.png';				
					if(isset($_REQUEST['image'.$nums2])){
						$image = addslashes($_REQUEST['image'.$nums2]);
						$thum = addslashes($_REQUEST['thum'.$nums2]);
					}
					if($ename==''){
						
					echo "Please type candidate name !"; exit;
					$isErr = 1;
					}
					if($fname==''){
					echo "Please type candidate's father name !"; exit;
					$isErr = 1;
					}
					if($cnic!=''){
						
					if(!is_numeric($cnic)){	
					echo "Please type only numeric values  for CNIC !"; exit;
					$isErr = 1;
					}
					
					if(strlen($cnic) != 13 ){	
					echo "Please type 13 digits of CNIC !"; exit;
					$isErr = 1;
					}
					
					
					$checkCnic = checkCnic($cnic,1,$company_id);
					
					if($checkCnic != 'not-found'){
					echo "CNIC already exists ! <br /> $cnic"; exit;
					$isErr = 1;
					
					}
					}
					
					
					
					if($empcode==''){					
					echo "Please type employee code !"; exit;
					$isErr = 1;
						
					}	
					if(!is_numeric($empcode) ){	
					echo "Please type only numeric values for employee code!"; exit;
					$isErr = 1;
					}	
					
					/* $checkEmpId = checkEmpId($empcode,1,$company_id);
					if($checkEmpId != 'not-found'){
					echo "Employee Code already exists ! <br /> $empcode"; exit;
					$isErr = 1;
					} */
					
					if($cnic!='') $listOfCnic[]=$cnic;
					if($empcode!='') $listOfEmp[]=$empcode;
					
					
								$valid = true;	
								$isCheck = 0;
								$isAttach = 0;
								$err_msg = "";								
							foreach($_REQUEST['checks'.$nums2] as $check){
								
								$chkk = explode("_",$check);
								$chk = $chkk[0];
								if(is_array($_REQUEST['ischeck'.$nums2]) && in_array($check,$_REQUEST['ischeck'.$nums2])){
									$isCheck++;
								
								$bCode = cBCode(0,0,$VID,$chk);																
								
								
								
										
					//$a_info = "A new $checks_title check assigned from ".$_SESSION['fname']." ( $COMINF[name] ) " ;
					//createNotifications(4,$a_info,'',$analyst_id);
									
									for($count=100;$count<=120;$count++){
										if(is_array($_REQUEST['docxs'.$nums2.$count.$check])){
											$isAttach++;
											foreach($_REQUEST['docxs'.$nums2.$count.$check] as $key=>$docxs){
												$att_file_name 	= $_REQUEST['docxs_name'.$nums2.$count.$check][$key]; 
												$att_file_path 	= $docxs; 
												if($nadrabulk!=1){
												if($att_file_name==""){
													$err_msg = "Please attach a file to each selected check !";
													$valid=false;
													$isErr = 1;
												}
												}
												
												
												
											}
										}
									}
								}
								}
								
								
							
							
					}else{
						 echo "Case [$ename] insertion error!";  exit;
						 $isErr = 1;
					}
						$nums2++;
						
					
						if($valid==false){
									echo $err_msg; exit;
									$isErr = 1;
								}
								if($nadrabulk!=1){
								if($isAttach==0){
									echo "Please attach a file to each selected check !"; exit;
								}
								}
								if($isCheck==0){
									echo "Check insertion error! You must select at least one check !"; exit;
								}
								
					
					}
					
					
					
					
					$duplicatesCnic = find_duplicates2($listOfCnic,'CNIC');
					$duplicatesEmp = find_duplicates2($listOfEmp,'Employee Code');	
																								
					if($duplicatesCnic){
							
					echo $duplicatesCnic; exit;						
					$isErr == 1;					
					}					
					if($duplicatesEmp){	
									
					echo $duplicatesEmp; exit;						
					$isErr == 1;					
					}					
				
				if($isErr == 0){
				
				
				while(isset($_REQUEST['ename'.$nums])){
					
					if(isset($_REQUEST['case'.$nums])){
					
					$ename = addslashes($_REQUEST['ename'.$nums]);
					$fname 	= addslashes($_REQUEST['fname'.$nums]);
					$empcode = addslashes($_REQUEST['empcode'.$nums]);
					$cnic = addslashes($_REQUEST['cnic'.$nums]);
					$dob = addslashes($_REQUEST['dob'.$nums]);
					$image='images/default.png';
					$thum= 'images/default.png';				
					if(isset($_REQUEST['image'.$nums])){
						$image = addslashes($_REQUEST['image'.$nums]);
						$thum = addslashes($_REQUEST['thum'.$nums]);
						
						
					}
					
					//--------------------If candidate id found then add checks against that ID Begin---------------//
					
					$checkEmpId = checkEmpId($empcode,1,$company_id);
					if($checkEmpId != 'not-found'){
					$where = "emp_id='".$empcode."' AND com_id='".$company_id."' ";
					$Q = $db->select("ver_data","v_id",$where); 
					$rsVData = mysql_fetch_assoc($Q);
					$VID=$rsVData['v_id'];
					$isInserted=true;
					if($cnic!=""){
					$Sel_v_nic = $db->select("ver_data","v_nic",$where); 
					$rsV_nic = mysql_fetch_assoc($Sel_v_nic);
					if($rsV_nic['v_nic'] == ''){
					$col_v_nic = "v_nic='$cnic'";
					}
					}
					if($dob!=""){
					$coma =	($col_v_nic!="")?",":"";
					$col_v_dob = "$coma v_dob='$dob'";	
					}
					
					
					$db->update("$col_v_nic $col_v_dob","ver_data","v_id=$VID");
					//echo "Employee Code already exists ! <br /> $empcode"; exit;
					//$isErr = 1;
					}else{
					
					$bCode = cBCode($company_id,'01');
					$cols="thum,image,v_name,v_ftname,v_nic,v_dob,com_id,v_recdate,v_bcode,v_uadd, emp_id";
					$values="'$thum','$image','$ename','$fname','$cnic','$dob',$company_id,'$recdate','$bCode',$uID, '".$empcode."'";
					$isInserted = $db->insert($cols,$values,"ver_data");
					$VID=$db->insertedID;

					
					}
					//--------------------If candidate id found then add checks against that ID End---------------//
					
					
					
					
					$any_error = false;
					if($isInserted){					
							foreach($_REQUEST['checks'.$nums] as $check){
								$chkk = explode("_",$check);
								$chk = $chkk[0];
								if(is_array($_REQUEST['ischeck'.$nums]) && in_array($check,$_REQUEST['ischeck'.$nums])){
								$bCode = cBCode(0,0,$VID,$chk);
								
								
								
					// khl	//		
								$tabl = "analyst_roles ar INNER JOIN checks c ON ar.checks_id=c.checks_id ";
								$cols = "ar.analyst_id,c.checks_title";
								$selRoles = $db->select($tabl,$cols," ar.checks_id='".$chk."'");
								$resRoles = mysql_fetch_assoc($selRoles);
								$analyst_id = ($resRoles['analyst_id'])?$resRoles['analyst_id']:'';
								$checks_title = ($resRoles['checks_title'])?$resRoles['checks_title']:'';
								
									//echo "SELECT $cols FROM $tabl WHERE checks_id='".$check."'"; die();
					// khl //	
							//--------------------- auto assign checks removed -------------------------//
								//$cols="as_bcode,v_id,checks_id,as_uadd,user_id,as_status, as_addate, as_date";
								//$values="'$bCode',$VID,$chk,$uID,'$analyst_id','Open', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP";
								
								//$uInfo  = getUserInfo($analyst_id);
								// send notification to analyst		
								//$vData  = getVerdata($VID);
								//addActivity('ascase',"$vData[v_name] Assigned to [ $uInfo[first_name] ]",$LEVEL,'',$VID,'','assign');
								//$isUpdate = $db->update("v_status='Open'","ver_data","v_id=$VID");
							//--------------------- auto assign checks removed -------------------------//
							
							// 262 is the special analyst id of jameel Qazi
							if($nadrabulk==1){
								$assign_cols = "user_id,as_status, ";
								$assign_values = "262,'Open', ";
								$db->update("v_status='Open'","ver_data","v_id=$VID");
							}else{
								$assign_cols = "";
								$assign_values = "";
							}
							
							//----------------- Auto assign education checks to sarfaraz  --------------------//
							//----------------- Temporary Commented --------------------//
							$assign_values = "";
							$assign_cols = "";
							/* if($chk==1){
								$assign_cols = "user_id,as_status, ";
								$assign_values = "250,'Open', ";
								$db->update("v_status='Open'","ver_data","v_id=$VID");
							}else{
								$assign_cols = "";
								$assign_values = "";
							} */
							//----------------- Temporary Commented --------------------//
							
							
								$cols="as_bcode,v_id,checks_id,as_uadd, $assign_cols as_addate, as_date, how_rec_checks";
								$values="'$bCode',$VID,$chk,$uID, $assign_values CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '$how_rec_checks'";
							
								if($db->insert($cols,$values,"ver_checks")){
								$CID=$db->insertedID;
					
					
										
					//$a_info = "A new $checks_title check assigned from ".$_SESSION['fname']." ( $COMINF[name] ) " ;
					//createNotifications(4,$a_info,'',$analyst_id);
									
									for($count=100;$count<=120;$count++){
										if(is_array($_REQUEST['docxs'.$nums.$count.$check])){
											foreach($_REQUEST['docxs'.$nums.$count.$check] as $key=>$docxs){
					
												$att_file_name 	= $_REQUEST['docxs_name'.$nums.$count.$check][$key]; 
												$att_file_path 	= $docxs; 
												
												$cols = "case_id,checks_id,att_file_path,att_file_name";
												$values = "$VID,$CID,'$att_file_path','$att_file_name'";
												$db->insert($cols,$values,'attachments');
											}
										}
									}
								}else{
									
									  echo "Check insertion error!"; exit;
									$any_error = true;
								}
								}
							}	
							
					}else{
						 echo "Case [$ename] insertion error!"; exit;
					}
						$nums++;
					}
				}
				
					// insert notificaification to manager about new cases
					$a_info = ($_REQUEST['is_bulk']==1) ? "New Cases added with Bulk Uploaded by ".$_SESSION['fname']." ( $info_title ) " : "New Case Added by ".$_SESSION['fname']." ( $info_title ) ";
					
					$notify = createNotifications(4,$a_info,$VID,'','','',$CID);
					
					if(!$any_error && $_REQUEST['ERR']=='') echo "added"; exit;			
				}
			}
	}

	
	// ajax bulk upload new
	
	include("bulkupload/bulkupload_functions.php");
	
	
	
	
	
	
	
	function find_duplicates2($arr,$title='') {
		$title = ($title)?"of $title ":'';
		$trig = 0;
		$new_array = array();
	   foreach ($arr as $key => $value) {
    if(isset($new_array[$value]))
    	$new_array[$value] += 1;
    else
    	$new_array[$value] = 1;
	}	
	$msg = "Duplicate entries $title : <br />";
	foreach ($new_array as $rec => $n) {
		
		if($n > 1){
			
			$msg .= $rec. " ($n) <br />";
			$trig = 1;
		}
	}
	return ($trig==1) ? $msg : 0; exit;

		}


		
		
		
		
	function mark_insuff_docs($as_id,$att_id,$comments){
	 
	$db = new DB();
	
	$vCheck = getCheck(0,0,$as_id);
	$tCheck = getCheck($vCheck['checks_id'],0,0);
	$vData  = getVerdata($vCheck['v_id']);
	$comInfo = getInfo("company","id=".$vData['com_id']);
	$att_insuff_status = 1;
	$insuff_title = 'insufficient';
	$insuffReason = $comments;
	$att_upd_date_col = 'att_insuff_date';
	
	$bodyText .= "$tCheck[checks_title] check  $insuffReason";
	
	$db->update("att_insuff='$att_insuff_status', $att_upd_date_col=CURRENT_TIMESTAMP,att_comments='$insuffReason'","attachments","att_id=$att_id");

	//var_dump($countInsuff); die;
		
	$att_comments = (!empty($insuffReason))?'<br> Insuffciency Reason:<br>'.$insuffReason.'':'';
	$Att = 'Attachment';
	
	//$a_info = "$Att marked as insufficient by analyst (".SUDONYMS.") of Check:$tCheck[checks_title] (Client: $comInfo[name] and Candidate: <a href=\"".SURL."?action=details&case=$vData[v_id]&_pid=81#check_tab_$as_id\">$vData[v_name]</a>) $att_comments";
	
	
	$a_info = "<strong>URGENT ACTION REQUIRED: <a href=\"".SURL."?action=details&case=$vData[v_id]&_pid=81\">$vData[v_id]</a></strong> <br/><br/>With reference to your submitted verification of <strong><a href=\"".SURL."?action=details&case=$vData[v_id]&_pid=81#check_tab_$as_id\">$vData[v_name]</a></strong>, please note that an attachment has  been <strong>marked as insufficient</strong> <br/><br/>$bodyText<br/>";
	
	
	 $db->update("as_status='Insufficient'","ver_checks","as_id=$as_id");
	$localDate = date("D, M d, Y");
	$subject = "$comInfo[name], Insufficient Alert - $vData[v_name] ($localDate)";	 
	
	 $notify = createNotifications(4,$a_info,$v_id,$vCheck[user_id],'','insufficient',$as_id,'client',$subject);
			   
	
	msg('sec',"Selected attachments marked as sufficient/insufficient !");
	
	
	
		
	}	
		
		
		
		
		
		
		
		
		
		
		
		



// new by khl
function addMoreChecks(){
	
		global $db,$COMINF,$LEVEL;
		
		$uID = $_SESSION['user_id'];
		$recdate = date("Y-m-d");
		
		if(count($_REQUEST['checks1'])==0) msg('err',"You don't have check(s) in your package, please contact system admin!");
		if($_REQUEST['ERR']==''){
	
			$nums = 1;
			
				if(isset($_REQUEST['case_id'])){
								
				$VID= (int) $_REQUEST['case_id'];
				$any_error = false;
				if($VID){	
					$vInfo = getVerdata($VID);
					$company_id = (int) $vInfo['com_id'];
					$comInfo = getcompany($company_id);
					$comInfo = @mysql_fetch_array($comInfo);
					$country = (int) (isset($vInfo['v_country']))?$vInfo['v_country']:171;
					if($country!=171){
					$AssignedToSys = 249; // user_id	
					$AssignedToBitrix = 529; // bitrix user_id
					$Work_Group_id = 18;
					}
					
					$uptorderAmount = 0;
					$CCC=-1;
					
						foreach($_REQUEST['checks1'] as $check){
							$CCC++;
							$chkk = explode("_",$check);
							$chk = (int) $chkk[0];
							if(is_array($_REQUEST['ischeck1']) && in_array($check,$_REQUEST['ischeck1'])){
							$bCode = cBCode(0,0,$VID,$chk);
							$as_cost2 = (int) getCheckAmount($company_id,$chk);
							$uptorderAmount += $as_cost2;
							
							
							// khl	//		
								$tabl = "analyst_roles ar INNER JOIN checks c ON ar.checks_id=c.checks_id ";
								$cols = "ar.analyst_id,c.checks_title,c.group_id as group_id";
								$selRoles = $db->select($tabl,$cols," ar.checks_id='".$chk."'");
								$resRoles = mysql_fetch_assoc($selRoles);
								$tabl = "`teamlead_checks` tc INNER JOIN users uc ON uc.`user_id`=tc.`team_lead_id`";
								$cols = "uc.`bitrix_id` AS `bitrix_uid`,uc.`user_id` AS `user_id`";
								$selbitrixusr = $db->select($tabl,$cols,"tc.checks_id='".$resRoles['group_id']."'");
								$bitrixuserid=mysql_fetch_assoc($selbitrixusr);
								$bitrixuserid2=($country!=171)?$AssignedToBitrix:$bitrixuserid['bitrix_uid'];
								$userid2=($country!=171)?$AssignedToSys:$bitrixuserid['user_id'];
								$analyst_id = ($resRoles['analyst_id'])?$resRoles['analyst_id']:'';
								$checks_title = ($resRoles['checks_title'])?$resRoles['checks_title']:'';
							// khl //
							
							//--------------------- auto assign checks removed -------------------------//
								//$cols="as_bcode,v_id,checks_id,as_uadd,user_id,as_status, as_addate, as_date";
								//$values="'$bCode',$VID,$chk,$uID,$analyst_id,'Open', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP";
								
								//$uInfo  = getUserInfo($analyst_id);
								// send notification to analyst		

								//addActivity('ascase',"$ename Assigned to [ $uInfo[first_name] ]",$LEVEL,'',$VID,'','assign');
								//$isUpdate = $db->update("v_status='Open'","ver_data","v_id=$VID");
								
								
								
							//--------------------- auto assign checks removed -------------------------//
							//----------------- Temporary Commented --------------------//
								$assign_cols = "";
								$assign_values = "";
								$assign_cols = "user_id,as_status, ";
								$assign_values = "'".$userid2."','Open', ";
								$db->update("v_status='Open'","ver_data","v_id=$VID");
								$db->update("checks_added=1","ver_data","blank_case=1 AND v_id=$VID");
								//----------------- Temporary Commented --------------------//	
							
							$cols="as_bcode,v_id,checks_id, $assign_cols as_uadd,as_addate, as_date, as_cost2";
							$values="'$bCode',$VID,$chk, $assign_values $uID,CURRENT_TIMESTAMP, CURRENT_TIMESTAMP,'$as_cost2'";
							if($db->insert($cols,$values,"ver_checks")){
							
								$CID=$db->insertedID;
								
				
				// info privided
				if($chk == 1){
						$chknumber = $chkk[1];
					$colsAddata = " (as_id,d_type,d_mtitle,d_stitle,d_num,user_id) ";
					$valsAddata = " ($CID,'multy','University Name','".$_REQUEST['uni_name1'."_".$chknumber]."',1,$uID),
					($CID,'multy','Registration Number','".$_REQUEST['reg_num1'."_".$chknumber]."',2,$uID),
					($CID,'multy','Degree Title','".$_REQUEST['degree1'."_".$chknumber]."',3,$uID),
					($CID,'multy','Remarks','".$_REQUEST['remarks1'."_".$chknumber]."',4,$uID),
					($CID,'multy','Passing Year','".$_REQUEST['pass_year1'."_".$chknumber]."',5,$uID),
					($CID,'multy','Serial No','".$_REQUEST['serial_no1'."_".$chknumber]."',6,$uID)";
					//insertSet
					
					
					
					$db->insertMulti($colsAddata,$valsAddata,'add_data');
					}
							
							
							
					if($chk == 2){ $chknumber = $chkk[1];
					$colsAddata = " (as_id,d_type,d_mtitle,d_stitle,d_num,user_id) ";
					$valsAddata = "($CID,'multy','Company Name','".$_REQUEST['company_name1'."_".$chknumber]."',1,$uID),
									($CID,'multy','Date of Joining','".$_REQUEST['date_of_join1'."_".$chknumber]."',2,$uID),
									($CID,'multy','Employement Status','".$_REQUEST['emp_status1'."_".$chknumber]."',3,$uID),
									($CID,'multy','Last Working Day','".$_REQUEST['last_work_day1'."_".$chknumber]."',4,$uID),
									($CID,'multy','Last Designation','".$_REQUEST['last_designation1'."_".$chknumber]."',5,$uID),
									($CID,'multy','Last Place of Posting','".$_REQUEST['last_place_posted1'."_".$chknumber]."',6,$uID)
									,
									($CID,'multy','Last Drawn Salary','".$_REQUEST['last_drawn_salary1'."_".$chknumber]."',7,$uID)";	
					$company_name = $_REQUEST['company_name1'."_".$chknumber];
					//sendSurveyFormToHR($CID,$company_name);
					$db->insertMulti($colsAddata,$valsAddata,'add_data');
					}
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				// send notification to analyst						
				//$a_info = "A new $checks_title check assigned from ".$_SESSION['fname']." ( $COMINF[name] ) " ;
				//createNotifications(4,$a_info,'',$analyst_id);
				$isDocUpload = 0;
								$attachments=array();
								for($count=100;$count<=120;$count++){
									
									if(is_array($_REQUEST['docxs1'.$count.$check])){
										foreach($_REQUEST['docxs1'.$count.$check] as $key=>$docxs){
											$isDocUpload++;
											$att_file_name 	= $_REQUEST['docxs_name1'.$count.$check][$key]; 
											$att_file_path 	= $docxs; 
											
											$cols = "case_id,checks_id,att_file_path,att_file_name";
											$values = "$VID,$CID,'$att_file_path','$att_file_name'";
											$attachments[]="Attachment Link : $att_file_path";
											$db->insert($cols,$values,'attachments');
											$att_id=$db->insertedID;
											
											if(isset($_REQUEST["isinsuff_$check"]) && $_REQUEST["isinsuff_$check"]==1){
											$insuffReason = $_REQUEST["insuff_reason_$check"];
											mark_insuff_docs($CID,$att_id,$insuffReason);
											}
											
										}
									}
								}
								
								
				if($isDocUpload==0){
				if(isset($_REQUEST["isinsuff_$check"]) && $_REQUEST["isinsuff_$check"]==1){
				$att_file_name 	= 'No File Attached'; 
				$att_file_path 	= SURL.'images/no-file.jpg'; 	
				$cols = "case_id,checks_id,att_file_path,att_file_name";
				$values = "$VID,$CID,'$att_file_path','$att_file_name'";
				$db->insert($cols,$values,'attachments');
				$att_id=$db->insertedID;
				
				$insuffReason = $_REQUEST["insuff_reason_$check"];
				mark_insuff_docs($CID,$att_id,$insuffReason);
				}
				}
								
								
								
								
								$gender = $vInfo['v_gender'];
								$ename = $vInfo['v_name'];
								$fname 	= $vInfo['v_ftname'];
								$empcode = $vInfo['emp_id'];
								$cnic = $vInfo['v_nic'];
								$dob = $vInfo['v_dob'];
								$task_array=array();
								$task_array['task_name']='Check For '.$ename ." - $bCode";
								$task_array['task_desc']="Gender : $gender
								Father Name : $fname
								NIC : $cnic
								Date of Birth : $dob
								Received Date : $recdate
								Attachments :
								".implode(",",$attachments)."";
								$task_array['user_id']=($country!=171)?$AssignedToBitrix:$bitrixuserid2;
								$task_array['group_id']=($country!=171)?$Work_Group_id:$resRoles['group_id'];
								$task_array['country_id']=$country;
								//print_r($task_array);die;
								$bitrixctid=add_task($task_array,$bitrixlid);
								$db->update("bitrixtid=$bitrixctid","ver_checks","as_id=$CID");
							}else{
								 msg('err',"Check insertion error!");
								$any_error = true;
							}
							}
						}
						
					// if new checks added then update the total amount of order
					$orerInfo = getInfo("client_invoices","v_id=$VID");
					$ord_cost = (int)$orerInfo['cost'];
					$total_cost = ($ord_cost + $uptorderAmount);
					if($orerInfo['invoiced']==0){
					$db->update("cost=$total_cost","client_invoices","v_id=$VID");
					}else{
					addClientInvoice($company_id,$uptorderAmount,$VID);
					}
						
				}else{
					 msg('err',"Case [$ename] insertion error!");
				}
					
				}
				
				
				if(!$any_error && $_REQUEST['ERR']=='') { 
				
				
				
				// insert notificaification to manager about new cases
				$a_info = "Checks added by ".$_SESSION['fname']."  against applicant <strong><a href='".SURL."?action=details&case=$VID&_pid=81' >$vInfo[v_name]</a></strong> ";
				
				$localDate = date("D, M d, Y");
				$subject = "$comInfo[name], Checks added against applicant $vInfo[v_name] ($localDate)";	
								
				$notify = createNotifications(4,$a_info,$VID,'','','morechecks','','client',$subject);
				
				//$notify = createNotifications(4,$a_info,$VID);
				
				
				$iware = getPage();
				
				msg("sec","Record added successfully...");
				
				header("location:".SURL."?action=details&case=$VID&_pid=".$iware['m_id']."&added=1");
				}			
		}
}


// new by khl
function addMoreAttachments(){
		global $db,$COMINF,$LEVEL;
		
		$uID = $_SESSION['user_id'];
		$recdate = date("Y-m-d");
		
		if(count($_REQUEST['check_id'])==0) msg('err',"You don't have check(s) in your package, please contact system admin!");
		if($_REQUEST['ERR']==''){
	
			$nums = 1;
			
				if(isset($_REQUEST['case_id'])){
								
				$VID=$_REQUEST['case_id'];
				$any_error = false;
				if($VID){
				$vInfo = getVerdata($VID);
				$company_id = (int) $vInfo['com_id'];
				$comInfo = getcompany($company_id);
				$comInfo = @mysql_fetch_array($comInfo);
						
												
							
								$CID=$_REQUEST['check_id'];
								
									
									if(is_array($_REQUEST['docxs1'.$_REQUEST['check_id'].$_REQUEST['check_id'].'_1'])){
										foreach($_REQUEST['docxs1'.$_REQUEST['check_id'].$_REQUEST['check_id'].'_1'] as $key=>$docxs){
				
											$att_file_name 	= $_REQUEST['docxs_name1'.$_REQUEST['check_id'].$_REQUEST['check_id'].'_1'][$key]; 
											$att_file_path 	= $docxs; 
											
											$cols = "case_id,checks_id,att_file_path,att_file_name";
											$values = "$VID,$CID,'$att_file_path','$att_file_name'";
											$db->insert($cols,$values,'attachments');
										}
									}else{
										 msg('err',"File not selected ");
									}
								
							
						
				}else{
					 msg('err',"Attachment insertion error!");
				}
					
				}
				
				
				if(!$any_error && $_REQUEST['ERR']=='') { 
				
				
				// insert notificaification to manager about new cases
				$userName = ($_SESSION['fname']!='')?$_SESSION['fname']:SUDONYMS;
				$a_info = "More attachments added by ".$userName." ( $comInfo[name] ) against applicant <a href=\"".SURL."?action=details&case=".$VID."&_pid=81#check_tab_".$CID."\">".$vInfo[v_name]."</a> ";
				$toWhome = ($LEVEL!=4)?'client':'ops';
				$vCheck = getCheck(0,0,$CID);
				$toEmail="";
				if((!empty($vCheck['user_id'])) && $vCheck['user_id']!=0){
				$userInfo = getUserInfo($vCheck['user_id']);
				$toEmail = $userInfo['email'];
				}
				//echo "To Email: ".$toEmail;
				$notify = createNotifications(4,$a_info,$VID,'',$toEmail,"More attachments added by ".$userName."",$CID,$toWhome);
				
				$iware = getPage();
				
				msg("sec","Attachment added successfully...");
				
				//@header("location:".SURL."?action=details&case=$VID&_pid=".$iware['m_id']."&att_added=1");
				}			
		}
}





//com_type='case'
function get_messages($ewhere="com_type='case' AND is_read=0 AND ",$limit="",$isupdate=false){

	global $db,$COMINF;
	global $LEVEL;

	$where="$ewhere vd.v_isdlt=0 AND vc.as_isdlt=0";
	if($LEVEL==4){
		$where= "$where AND vd.com_id=$COMINF[id] AND is_show=1";
		$uids = getUseridsLocation();
		if(!empty($uids)){
		$where = " $where  AND v_uadd IN (".implode(",",$uids).") ";	
		}
	}
	$tabl = "comments cm INNER JOIN ver_checks vc ON vc.as_id=cm._id INNER JOIN ver_data vd ON vd.v_id=vc.v_id INNER JOIN users ur ON ur.user_id=cm.user_id";
	$cols = "cm.com_title,cm.com_text,cm.com_date,ur.uimg,ur.first_name,ur.last_name,cm._id,vd.v_id";
	$comnts = $db->select($tabl,$cols,"$where ORDER BY com_date DESC $limit");
	if(mysql_num_rows($comnts)>0){
	    if($isupdate) $db->update("is_read=1",$tabl,$where);	 
		return $comnts;	 
	}

	return false;

}

function client_checks_info($owhere,$limit='',$bycase=false){
	global $db,$COMINF;
	global $LEVEL;
	
	$where = "$owhere AND v_isdlt=0";
	if($LEVEL==4){
		$where = "$owhere AND v_isdlt=0 AND com_id=$COMINF[id]";
		$uids = getUseridsLocation();
		if(!empty($uids)){
		$where = " $where  AND v_uadd IN (".implode(",",$uids).") ";	
		}
	}
	
	$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN checks ck ON c.checks_id=ck.checks_id";
	if($bycase) $GROUPBY = "GROUP BY d.v_id"; else $GROUPBY="GROUP BY c.as_id";
	$cols = "d.image,d.v_name,ck.checks_title,c.as_stdate,d.v_id,c.as_id,c.as_status,c.as_vstatus,c.as_remarks,c.as_pdate,c.as_date,v_status,thum";
	//echo "SELECT $cols FROM $tbls WHERE $where ORDER BY c.as_id DESC $limit";
	$data = $db->select($tbls,$cols,"$where $GROUPBY ORDER BY c.as_id DESC $limit");	
	if(mysql_num_rows($data)>0){
		
		return $data;	
	}else{
		return false;	
	}
}	


function check_progress($check){
		$check['as_status'] = strtolower($check['as_status']);
		if($check['as_status']=="close"){
			if($check['as_sent']==4) return 100;
			if($check['as_sent']==0 && $check['as_remarks']!="")  return 80;
			if($check['as_sent']==0) return 60;
		}else{
			if(is_numeric($check['user_id']) && $check['as_vstatus']!="")  return 50;
			if(is_numeric($check['user_id']) && $check['as_pdate']!="")  return 40;
			if(is_numeric($check['user_id'])) return 20;			
		}
		return 0;
}

// by khl
function get_check_progress($check){
	
		$check['as_status'] = strtolower($check['as_status']);
		$check['as_qastatus'] = strtolower($check['as_qastatus']);
		
		if($check['as_qastatus']=="qa"){
			return 75;
		}else if($check['as_status']=="close"){
			if($check['as_sent']==4) return 100;
			if($check['as_sent']==0 && $check['as_remarks']!="")  return 80;
			if($check['as_sent']==0) return 60;
		}else if($check['as_status']=="open"){
			if($check['as_vstatus']=="Not Initiated"){
				 
				 return 25;
			
			}else{
				
				return 50; 
			 }
			
	}else if($check['as_status']=="not assign"){
			return 25;
	}else if($check['as_status']=="Insufficient"){
			return 25;
			
			
	}else{
	
	/* if(is_numeric($check['user_id']) && $check['as_vstatus']!="")  return 50;
			if(is_numeric($check['user_id']) && $check['as_pdate']!="")  return 40;
			if(is_numeric($check['user_id'])) return 20; */	
		return 0;
	}
}
function client_case_info($twhere='',$torder='',$isSearch=''){
	global $db,$COMINF;
	global $LEVEL;	
	$data['data'] = array();
	
	if($twhere != ''){ $twhere = "$twhere AND"; } else{ $twhere = '';}
	if($torder != ''){ $torder = "$torder"; } else{ $torder = 'd.v_id DESC';}
	$order = "$torder";
	
	if (preg_match('/limit/',strtolower($order))){
	$order = "$torder";	
	}else{
	$order = "$torder LIMIT 1000";	
	}
	
	//print_r($order);die;
	// For Search records 
	if($isSearch == 'yes'){
		
		if($LEVEL==3 && $action!='assign') $wh= " c.user_id=$_SESSION[user_id] AND";
		$where=" $wh $twhere v_isdlt=0";
		
		
	}else{
		if($LEVEL!=4 && $LEVEL!=3 ) $wh= ""; else $wh= " AND com_id=$COMINF[id]";
		$where=" $twhere v_isdlt=0 $wh";
	
	}
	
	if($LEVEL==4){
	$uids = getUseridsLocation();
	if(!empty($uids)){
	$where = " $where AND v_uadd IN (".implode(",",$uids).")";	
	}
	
	}
	
	
	
	$cols = "COUNT(d.v_id) AS cnt,DATE_FORMAT(v_date,'%d-%b-%Y') AS ndate,d.v_crd,d.v_stdate,d.v_date,d.v_cldate,d.emp_id";

	$cols ="$cols,d.v_id,.d.v_name,d.v_nic,d.com_id,d.v_ftname,c.as_vstatus,d.v_status,d.v_rlevel,d.v_sent,v_bmk,v_refid,co.name";

	$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN company co ON d.com_id=co.id"; 
	
	//echo "select  $cols  from $tbls where $where GROUP BY d.v_id ORDER BY $order";
		$cases = $db->select($tbls,$cols,"$where GROUP BY d.v_id ORDER BY $order");

		$dCount = mysql_num_rows($cases); 
		$count = 0;
		while($re = mysql_fetch_assoc($cases)) { 
		
						/*if($twhere == "as_status='Problem'" ){
							$check_count = countChecks("vc.v_id=$cinfo[v_id]");
							if($check_count > 0 ){
							}
						}else{}*/
						
						$check_count = countChecks("$twhere vc.v_id=$re[v_id] ");
						//var_dump($check_count);
						if($check_count > 0 ){
							

						$data['data'][$count] = $re;
						
						
						// FOR CHANGE OPEN CHECK'S STATUS //
						//if($re['v_status'] == "Open"){$vstatus = "WIP";}else{$vstatus = $re['v_status'];}
						$pdfClickFullCase = "downloadPDF('pdf.php?pg=case&case=$re[v_id]')";
						
						//$color = vs_Status(strtolower($checkInf['as_vstatus']));
						
						///echo getColorClass($color);
						if($re['v_status']=='Close'){
						$color = vs_Status(strtolower($re['v_rlevel']));
						$clorClass = getColorClass($color);
						$downloadReport = 	'<a class="ctooltips" href="javascript:void(0);">					
						<button type="button" class="btn '.$clorClass.'" onclick="'.$pdfClickFullCase.'"><i class="icon-cloud-download"></i></button><span>Download Complete Case Report</span></a>';
						}else{
						$downloadReport = '';	
						}
						
						
						$data['data'][$count]['modify_status'] = replacestatus($re['v_status'])."  &nbsp; &nbsp; &nbsp;".$downloadReport;
						// END HERE 
						
						$tnt = countChecks("vc.v_id=$re[v_id] AND as_isdlt=0");

						$cnt = countChecks("vc.as_status='close' AND vc.v_id=$re[v_id] AND as_isdlt=0");
						
						$data['data'][$count]['done_checks'] = "$cnt of $tnt";
						$data['data'][$count]['progress'] = @($cnt/($tnt))*100;
						
						$red = "(as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found')";

						$red = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $red AND as_isdlt=0");
						$red =	mysql_fetch_assoc($red);
						
						$data['data'][$count]['red'] = $red['cnt'];
						
						$disp="(as_vstatus='unable to verify' OR as_vstatus='discrepancy' OR as_vstatus='original required')";

						$disp = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $disp AND as_isdlt=0");
						$disp = mysql_fetch_assoc($disp);
						
						$data['data'][$count]['discrepancy'] = $disp['cnt'];
								
						$count = $count+1;	
						
						}
		}
		
		return $data;
}



function client_case_info_serverside($twhere='',$torder='',$isSearch=''){
	global $db,$COMINF,$LEVEL;
	
	$requestData = $_REQUEST;
	
	$data['data'] = array();
	$columns1 = array("");
	if($LEVEL != 4)
	{
		$columns1[1] = "co.name";
		
	}
	
	$columns2 = array("v_name","emp_id","v_ftname","ndate","v_status");
	$columns = array_merge($columns1,$columns2);
	
	// For Search records 
	if($columns[$requestData[order][0][column]]){
	$orderBy = $columns[$requestData[order][0][column]]." ".$requestData[order][0][dir];
	}else{
	$orderBy = 	" v_name ASC ";
	}
	if($twhere != ''){ $twhere = "$twhere AND"; } else{ $twhere = '';}
	if($torder != ''){ $torder = "$torder"; } else{ $torder = 'd.v_id DESC';}
	$order = "$torder";
	
	if (preg_match('/limit/',strtolower($order))){
	$order = "$torder";	
	}else{
	$order = "$torder LIMIT 1000";	
	}
	
	//print_r($order);die;
	// For Search records 
	if($isSearch == 'yes'){
		
		if($LEVEL==3 && $action!='assign') $wh= " c.user_id=$_SESSION[user_id] AND";
		$where=" $wh $twhere v_isdlt=0";
		
		
	}else{
		if($LEVEL!=4 && $LEVEL!=3 ) $wh= ""; else $wh= " AND com_id=$COMINF[id]";
		$where=" $twhere v_isdlt=0 $wh";
	
	}
	
	if($LEVEL==4){
	$uids = getUseridsLocation();
	if(!empty($uids)){
	$where = " $where AND v_uadd IN (".implode(",",$uids).")";	
	}
	
	}
	
	
	
	
	
	$cols = "COUNT(d.v_id) AS cnt,DATE_FORMAT(v_date,'%d-%b-%Y') AS ndate,d.v_crd,d.v_stdate,d.v_date,d.v_cldate,d.emp_id,co.name as com_name";

	$cols ="$cols,d.v_id,.d.v_name,d.v_nic,d.com_id,d.v_ftname,c.as_vstatus,d.v_status,d.v_rlevel,d.v_sent,v_bmk,v_refid,co.name";

	$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN company co ON d.com_id=co.id"; 
	
	
	// Serverside integration start
	if( !empty($requestData['search']['value']) ) {
		$where = "$where AND ( v_name LIKE '".$requestData['search']['value']."%' OR v_ftname LIKE '".$requestData['search']['value']."%'  OR co.name LIKE '".$requestData['search']['value']."%' OR v_status LIKE '".$requestData['search']['value']."%' OR DATE_FORMAT(v_date,'%d-%b-%Y') LIKE '".$requestData['search']['value']."%' OR emp_id LIKE '".$requestData['search']['value']."%')";
		
		$totalFiltered = @mysql_num_rows($db->select($tbls,"d.v_id,DATE(c.as_cldate), c.as_addate ","$where GROUP BY  d.v_id  "));
		
	}else{
		$totalFiltered = @mysql_num_rows($db->select($tbls,"d.v_id,DATE(c.as_cldate), c.as_addate ","$where GROUP BY  d.v_id  "));
		
	}
	
	$total = @mysql_num_rows($db->select($tbls,"d.v_id,DATE(c.as_cldate), c.as_addate ","$where GROUP BY  d.v_id "));
	
	
	$data=array('draw'=> intval($_REQUEST[draw]),'recordsTotal' => intval($total), 'recordsFiltered' => intval($totalFiltered) );
	
	// Serverside integration end
	
	
	
	
	
	
	
	
	
	
	//echo "select  $cols  from $tbls where $where GROUP BY d.v_id ORDER BY $orderBy LIMIT ".$requestData['start']." ,".$requestData['length']; exit;

		$cases = $db->select($tbls,$cols,"$where GROUP BY d.v_id ORDER BY $orderBy LIMIT ".$requestData['start']." ,".$requestData['length']);

		$dCount = mysql_num_rows($cases); 
		$count = 0;
		while($re = mysql_fetch_assoc($cases)) { 
		
						/*if($twhere == "as_status='Problem'" ){
							$check_count = countChecks("vc.v_id=$cinfo[v_id]");
							if($check_count > 0 ){
							}
						}else{}*/
						
						$check_count = countChecks("$twhere vc.v_id=$re[v_id] ");
						//var_dump($check_count);
						if($check_count > 0 ){
							

						$data['data'][$count] = $re;
						
						
						// FOR CHANGE OPEN CHECK'S STATUS //
						//if($re['v_status'] == "Open"){$vstatus = "WIP";}else{$vstatus = $re['v_status'];}
						$pdfClickFullCase = "downloadPDF('pdf.php?pg=case&case=$re[v_id]')";
						$downloadReport = ($re['v_status']=='Close')?'<a class="ctooltips" href="javascript:void(0);">					
						<button type="button" class="btn btn-success" onclick="'.$pdfClickFullCase.'"><i class="icon-cloud-download"></i></button><span>Download Complete Case Report</span></a>':'';
						$data['data'][$count]['modify_status'] = replacestatus($re['v_status'])."  &nbsp; &nbsp; &nbsp;".$downloadReport;
						// END HERE 
						
						$tnt = countChecks("vc.v_id=$re[v_id] AND as_isdlt=0");

						$cnt = countChecks("vc.as_status='close' AND vc.v_id=$re[v_id] AND as_isdlt=0");
						
						$data['data'][$count]['progress'] = @($cnt/($tnt))*100;
						
						$red = "(as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found')";

						$red = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $red AND as_isdlt=0");
						$red =	mysql_fetch_assoc($red);
						
						$data['data'][$count]['red'] = $red['cnt'];
						
						$disp="(as_vstatus='unable to verify' OR as_vstatus='discrepancy' OR as_vstatus='original required')";

						$disp = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $disp AND as_isdlt=0");
						$disp = mysql_fetch_assoc($disp);
						
						$data['data'][$count]['discrepancy'] = $disp['cnt'];
								
						$count = $count+1;	
						
						}
		}
		
		return $data;
}


// FUNCTION FOR ADV SEARCH
include("advance_search/advance_search_function.php");
// FUNCTION FOR ADV SEARCH


function replacestatus($status)
{
	if($status == "Open"){$vstatus = "Work In Progress";}else{$vstatus = $status;}
	return $vstatus;
}



function invited_applicant($twhere='',$torder='',$isSearch=''){
	global $db,$COMINF;
	global $LEVEL;
	
	$UserID = $_SESSION['user_id'];
	$today = date("Y-m-d");

	$data['data'] = array();
	
	$order = " $torder";
	
	$cols ="*,DATE(reg_date) AS reg_date,DATE(cd_date) AS cd_date,DATE(cd_exp_date) AS cd_exp_date";

	$tbls = "users u INNER JOIN check_date cd ON u.user_id=cd.user_id"; 
	//echo "select $cols from $tbls where $twhere.$order";
	$applicants = $db->select($tbls,$cols,$twhere.$order);
		

		
		$dCount = mysql_num_rows($applicants); 
		
		$count = 0;
		while($re = mysql_fetch_assoc($applicants)){ 
						
						
						
						$data['data'][$count] = $re;
						$data['data'][$count]['v_name']	 = $re['first_name'].' '.$re['last_name'];
						$data['data'][$count]['invited'] = ($re['invited']==1)?'Yes':'Pending';
						$data['data'][$count]['is_responed'] = ($re['is_responed']==1)?'Yes':'No';
						if($re['is_responed']==1){
						$data['data'][$count]['statuss'] = '<a href="#">View Case</a>';	
						}else{
						$expDate = $re['cd_exp_date'];	
						if(strtotime($today)>strtotime($expDate)){
						$data['data'][$count]['statuss'] = '<span class="label bg-danger">Link Expired</span> <a href="javascript:sendNewLinkToApplicant(\'frm_'.$count.'\');">Send New Link</a><form method="post" id="frm_'.$count.'" name="frm_'.$count.'"><input type="hidden" name="uid" value="'.$re[user_id].'"><input type="hidden" name="sendToApplicant" value="1"></form>';
						}else{
						$data['data'][$count]['statuss'] = '<span class="label bg-success">Link will expire on '.$expDate.'</span>';	
						}
						}
					//	$data['data'][$count]['reg_date'] = date('Y-m-d',strtotitme($re['reg_date']));
						
						$count = $count+1;	
						
						
		}
		return $data;
}







function applicant_insufficient_case_info($twhere='',$torder='',$isSearch=''){
	global $db,$COMINF;
	global $LEVEL,$LEVEL_TL;	
	$UserID = $_SESSION['user_id'];
	$data['data'] = array();
	
	if($twhere != ''){ $twhere = "$twhere AND"; } else{ $twhere = '';}
	if($torder != ''){ $torder = "$torder"; } else{ $torder = 'd.v_id DESC';}
	$order = "$torder";
	
	//print_r($order);die;
	// For Search records 
	if($isSearch == 'yes'){
		
		// ...... added by khl 
		if($LEVEL_TL==12 ) $setCol = "team_lead_id"; else $setCol = "user_id";
		// ......
		
		if($LEVEL==3 && $action!='assign') $wh= " c.$setCol=$_SESSION[user_id] AND";
		$where=" $wh $twhere v_isdlt=0";
		
		
	}else{
		$where="$twhere v_isdlt=0 AND com_id=$COMINF[id]";
	
	}
	$cols = "COUNT(d.v_id) AS cnt,DATE_FORMAT(v_date,'%d-%b-%Y') AS ndate,d.v_crd,d.v_stdate,d.v_date,d.v_cldate,d.emp_id";

	$cols ="$cols,d.v_id,.d.v_name,d.v_nic,d.com_id,d.v_ftname,d.v_status,d.v_rlevel,d.v_sent,v_bmk,v_refid,co.name";

	$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN company co ON d.com_id=co.id"; 
	
	//echo "select  $cols  from $tbls  $where AND c.as_uadd=$UserID GROUP BY d.v_id ORDER BY $order";
		$cases = $db->select($tbls,$cols,"$where AND c.as_uadd=$UserID GROUP BY d.v_id ORDER BY $order");

		$dCount = mysql_num_rows($cases); 
		$count = 0;
		while($re = mysql_fetch_assoc($cases)) { 
		
						/*if($twhere == "as_status='Problem'" ){
							$check_count = countChecks("vc.v_id=$cinfo[v_id]");
							if($check_count > 0 ){
							}
						}else{}*/
						
						$check_count = countChecks("$twhere vc.v_id=$re[v_id] ");
						//var_dump($check_count);
						if($check_count > 0 ){
							

						$data['data'][$count] = $re;
						 
						$tnt = countChecks("vc.v_id=$re[v_id] AND as_isdlt=0");

						$cnt = countChecks("vc.as_status='close' AND vc.v_id=$re[v_id] AND as_isdlt=0");
						
						$data['data'][$count]['progress'] = @($cnt/($tnt))*100;
						
						$red = "(as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found')";

						$red = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $red AND as_isdlt=0");
						$red =	mysql_fetch_assoc($red);
						
						$data['data'][$count]['red'] = $red['cnt'];
						
						$disp="(as_vstatus='unable to verify' OR as_vstatus='discrepancy' OR as_vstatus='original required')";

						$disp = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $disp AND as_isdlt=0");
						$disp = mysql_fetch_assoc($disp);
						
						$data['data'][$count]['discrepancy'] = $disp['cnt'];
								
						$count = $count+1;	
						
						}
		}
		return $data;
}

function applicant_case_info($twhere='',$torder='',$isSearch=''){
	global $db,$COMINF;
	global $LEVEL;	
	$UserID = $_SESSION['user_id'];
	
	$uInfo = $db->select("users","*","user_id=$UserID");
	$userInfo = mysql_fetch_assoc($uInfo);
	$data['data'] = array();
	
	if($twhere != ''){ $twhere = "$twhere AND"; } else{ $twhere = '';}
	if($torder != ''){ $torder = "$torder"; } else{ $torder = 'd.v_id DESC';}
	$order = "$torder";
	
	//print_r($order);die;
	// For Search records 
	if($isSearch == 'yes'){
		
		if($LEVEL==3 && $action!='assign') $wh= " c.user_id=$_SESSION[user_id] AND";
		$where=" $wh $twhere v_isdlt=0";
		
		
	}else{
		$where="$twhere v_isdlt=0 AND com_id=$COMINF[id]";
	
	}
	$cols = "COUNT(d.v_id) AS cnt,DATE_FORMAT(v_date,'%d-%b-%Y') AS ndate,d.v_crd,d.v_stdate,d.v_date,d.v_cldate,d.emp_id";

	$cols ="$cols,d.v_id,.d.v_name,d.v_nic,d.com_id,d.v_ftname,d.v_status,d.v_rlevel,d.v_sent,v_bmk,v_refid,co.name";

	$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN company co ON d.com_id=co.id"; 
	
	
		

		$cases = $db->select($tbls,$cols,"$where AND c.as_uadd=$UserID GROUP BY d.v_id ORDER BY $order");
		$dCount = mysql_num_rows($cases); 
		//echo "select  $cols  from $tbls  $where AND c.as_uadd=$UserID  GROUP BY d.v_id ORDER BY $order";
		//exit;
		//echo 'Khalique wa';
		$count = 0;
		while($re = mysql_fetch_assoc($cases)){ 
						/*if($twhere == "as_status='Problem'" ){
							$check_count = countChecks("vc.v_id=$cinfo[v_id]");
							if($check_count > 0 ){
							}
						}else{}*/
						$check_count = countChecks("$twhere vc.v_id=$re[v_id] ");
						//var_dump($check_count);
						if($check_count > 0 ){
							

						$data['data'][$count] = $re;
						 
						$tnt = countChecks("vc.v_id=$re[v_id] AND as_isdlt=0");

						$cnt = countChecks("vc.as_status='close' AND vc.v_id=$re[v_id] AND as_isdlt=0");
						
						$data['data'][$count]['progress'] = @($cnt/($tnt))*100;
						
						$red = "(as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found')";

						$red = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $red AND as_isdlt=0");
						$red =	mysql_fetch_assoc($red);
						
						$data['data'][$count]['red'] = $red['cnt'];
						
						$disp="(as_vstatus='unable to verify' OR as_vstatus='discrepancy' OR as_vstatus='original required')";

						$disp = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $disp AND as_isdlt=0");
						$disp = mysql_fetch_assoc($disp);
						
						$data['data'][$count]['discrepancy'] = $disp['cnt'];
								
						$count = $count+1;	
						
						}
		}
		return $data;
}


function qa_case_info($twhere='',$torder=''){
	global $db,$COMINF;
	global $LEVEL;	
	$data['data'] = array();
	$requestData = $_REQUEST;
	
	if($twhere != ''){ $twhere = "$twhere AND"; } else{ $twhere = '';}
	if($torder != ''){ $torder = "$torder"; } else{ $torder = 'd.v_id DESC';}
	$order = "$torder";
	
	$columns = array("","v_name","v_ftname","v_date","v_status");
	
	
	// For Search records 
	if($columns[$requestData[order][0][column]]){
	$orderBy = $columns[$requestData[order][0][column]]." ".$requestData[order][0][dir];
	}else{
	$orderBy = 	$order;
	}
	
	//print_r($order);die;
	$where="$twhere v_isdlt=0";
	
	$cols = "COUNT(d.v_id) AS cnt,DATE_FORMAT(v_date,'%d-%b-%Y') AS ndate,d.v_crd,d.v_stdate,d.v_date,d.v_cldate,d.emp_id";

	$cols ="$cols,d.v_id,.d.v_name,d.v_nic,d.com_id,d.v_ftname,d.v_status,d.v_rlevel,d.v_sent,v_bmk,v_refid";

	$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id"; 
	
	
	if( !empty($requestData['search']['value']) ) {
		$where = "$where AND ( v_name LIKE '".$requestData['search']['value']."%' OR v_ftname LIKE '".$requestData['search']['value']."%' OR v_status LIKE '".$requestData['search']['value']."%' OR DATE_FORMAT(v_date,'%d-%b-%Y') LIKE '".$requestData['search']['value']."%')";
		
		$totalFiltered = @mysql_num_rows($db->select($tbls,"d.v_id,c.as_cldate, c.as_addate","$where GROUP BY d.v_id   "));
		
	}else{
		$totalFiltered = @mysql_num_rows($db->select($tbls,"d.v_id,c.as_cldate, c.as_addate","$where GROUP BY  d.v_id   "));
		
	}
	
	
	
	
	
	
		$total = $db->select($tbls,$cols,"$where GROUP BY d.v_id ORDER BY $orderBy");

		$dCount = mysql_num_rows($total); 
		$count = 0;
		
		$data=array('draw'=> intval($_REQUEST[draw]),'recordsTotal' => intval($dCount), 'recordsFiltered' => intval($totalFiltered) );
		
		$cases = $db->select($tbls,$cols,"$where GROUP BY d.v_id ORDER BY $orderBy LIMIT ".$requestData['start']." ,".$requestData['length']);
		//echo "select  $cols  from $tbls  $where GROUP BY d.v_id ORDER BY $order LIMIT ".$requestData[start]." ,".$requestData[length];
		while($re = mysql_fetch_assoc($cases)) { 
		
						/*if($twhere == "as_status='Problem'" ){
							$check_count = countChecks("vc.v_id=$cinfo[v_id]");
							if($check_count > 0 ){
							}
						}else{}*/
						
						$check_count = countChecks("$twhere vc.v_id=$re[v_id] ");
						//var_dump($check_count);
						if($check_count > 0 ){
							

						$data['data'][$count] = $re;
						 
						$tnt = countChecks("vc.v_id=$re[v_id] AND as_isdlt=0");

						$cnt = countChecks("vc.as_status='close' AND vc.v_id=$re[v_id] AND as_isdlt=0");
						
						$data['data'][$count]['progress'] = @($cnt/($tnt))*100;
						
						$red = "(as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found')";

						$red = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $red AND as_isdlt=0");
						$red =	mysql_fetch_assoc($red);
						
						$data['data'][$count]['red'] = $red['cnt'];
						
						$disp="(as_vstatus='unable to verify' OR as_vstatus='discrepancy' OR as_vstatus='original required')";

						$disp = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $disp AND as_isdlt=0");
						$disp = mysql_fetch_assoc($disp);
						
						$data['data'][$count]['discrepancy'] = $disp['cnt'];
								
						$count = $count+1;	
						
						}
		}
		return $data;
}

function send_json($data,$is_array=false) {
	        @header( 'Content-Type: application/json; charset=UTF-8');
	        $response['data']='';
			if(!$is_array){
				$count = 0;
				while($row = mysql_fetch_assoc($data)){
					$response['data'][$count]= mysql_real_escape_string($row);
					$count++;
				}	
			}else $response=$data;
			
			
			echo json_encode( $response );
	        die;
}
	
function encode_json(){
	
	
	json_encode($data);
}
// By Ayaz
function weekly_checks_data($groupBy=""){

	global $db;
	global $LEVEL;
	

	$recent_week_data = $db->select("ver_checks AS vc 
	INNER JOIN `ver_data` AS vd ON vc.v_id=vd.v_id 
	INNER JOIN `company` AS cmp ON vd.com_id=cmp.id
	INNER JOIN `checks` AS chk ON vc.checks_id=chk.checks_id",
	"vc.as_id,vc.v_id,cmp.id AS com_ids,cmp.name AS com_name,cmp.pname AS com_pname, cmp.email AS com_email, chk.checks_title,vd.v_name, vc.as_status, vc.as_vstatus,  vc.as_pdate, vc.as_addate, vd.emp_id ","vc.as_pdate >= CURDATE() - INTERVAL DAYOFWEEK(CURDATE())+4 DAY
	AND vc.as_pdate < CURDATE() - INTERVAL DAYOFWEEK(CURDATE())-2 DAY AND cmp.disabled_id=0 AND cmp.is_active=1 AND cmp.id NOT IN (20,81,82,92,96) $groupBy"
	); 
	
	
	/* $recent_week_data = $db->select("ver_checks AS vc 
	INNER JOIN `ver_data` AS vd ON vc.v_id=vd.v_id 
	INNER JOIN `company` AS cmp ON vd.com_id=cmp.id
	INNER JOIN `checks` AS chk ON vc.checks_id=chk.checks_id",
	"vc.as_id,vc.v_id,cmp.id AS com_ids,cmp.name AS com_name,cmp.pname AS com_pname, cmp.email AS com_email, chk.checks_title,vd.v_name, vc.as_status, vc.as_pdate, vc.as_addate, vd.emp_id "," cmp.disabled_id=0 AND cmp.is_active=1 and cmp.id NOT IN (20,81,82,92,96) $groupBy"); */
	
	if(mysql_num_rows($recent_week_data)>0){
		return $recent_week_data;
	}
	return false;

}
	function UpdateCheckStatus($asid,$checkStatus){

	$db = new DB();
	$vCheck = getCheck(0,0,$asid);
	$bitrixtid = (int) $vCheck['bitrixtid'];
	//$vData  = getVerdata($vCheck['v_id']);
	
	if($checkStatus =='Rejected'){
		$comments = $_REQUEST['app_comments'];
		if(!empty($comments)){
			$sel = $db->select("ver_checks","as_rej_count","as_id=$asid");
			$rs = mysql_fetch_assoc($sel);
			$as_rej_count = $rs['as_rej_count']+1;
			$isInsUpd = $db->update("post_tag=1,as_qastatus='$checkStatus',as_vstatus='Work In Progress',as_status='Open',t_check=0,as_rej_count='$as_rej_count'","ver_checks","as_id=$asid");
			$db->update("v_status='Open',v_rlevel='N/A'","ver_data","v_id=$vCheck[v_id]");
			addActivity('qastatus',"Check has been rejected by QC manager.",0,'',$_REQUEST['case'],$_REQUEST['ascase'],'rejected');
			$uID = $_SESSION['user_id']; 
			
			$cols = "p_id,_id,com_text,com_type,user_id,clent_id";
			
			$vals = "0,$asid,'$comments','qa',$uID,$_REQUEST[analyst_id]";
			
			$isInc = $db->insert($cols,$vals,'comments');
			// insert qa logs
			$db->insert("as_id,user_id,qa_status","$asid,$uID,'$checkStatus'",'qa_logs');
			//return $isInsUpd;
			if($bitrixtid>0){
			edit_get_task_status($bitrixtid,2,true);
			}
			msg("sec","Check has been rejected!");
		}else{
			msg('err',"QC comments must have some value!");
		}
		
	}
	if($checkStatus =='Approved'){
		$comments = $_REQUEST['app_comments'];
		if(!empty($comments)){
			$isInsUpd = $db->update("post_tag=1,as_qastatus='$checkStatus'","ver_checks","as_id=$asid");
			
			addActivity('qastatus',"Check has been approved by QC manager.",0,'',$_REQUEST['case'],$_REQUEST['ascase'],'approved');
			
			$uID = $_SESSION['user_id']; 
			
			$cols = "p_id,_id,com_text,com_type,user_id,clent_id";
			
			$vals = "0,$asid,'$comments','qa',$uID,$_REQUEST[analyst_id]";
			
			$isInc = $db->insert($cols,$vals,'comments');
			// insert qa logs
			$db->insert("as_id,user_id,qa_status","$asid,$uID,'$checkStatus'",'qa_logs');
			//return $isInsUpd;
			if($isInsUpd){
			addRemarks($asid,'Close',$comments);
			sentToClient($asid);
			
			if($bitrixtid>0){
			edit_get_task_status($bitrixtid,5,true);
			}
			
			msg("sec","Check has been approved and sent to client!");
			}else{
			msg('err',"Status updation error!");	
			}
		}else{
			msg('err',"QC comments must have some value!");
		}
	
	}
	if($checkStatus =='QA'){
			$isInsUpd = $db->update("post_tag=1,as_qastatus='$checkStatus'","ver_checks","as_id=$asid");
			
			addActivity('qastatus',"Check has been submit for QC!",0,'',$_REQUEST['case'],$_REQUEST['ascase'],'submitforqa');

			$uID = $_SESSION['user_id']; 
			
			$cols = "p_id,_id,com_text,com_type,user_id,clent_id";
			
			$vals = "0,$asid,'$_REQUEST[qa_comments]','qa',$uID,$_REQUEST[analyst_id]";
			
			$isInc = $db->insert($cols,$vals,'comments');
			// insert qa logs
			$db->insert("as_id,user_id,qa_status","$asid,$uID,'QA'",'qa_logs');
			//return $isInsUpd;
			msg("sec","Check has been submit for QC!");
	}
}
	
function sort_checks_info(){
	global $db,$COMINF;
	$where = "v_isdlt=0 AND com_id=$COMINF[id]";
	$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN checks ck ON c.checks_id=ck.checks_id";
	$cols = "DISTINCT ck.checks_id,ck.checks_title";
	$data = $db->select($tbls,$cols,"$where ORDER BY ck.checks_title DESC");	
	if(mysql_num_rows($data)>0){
		return $data;	
	}else{
		return false;	
	}
}	
function  add_message(){
		global $db,$COMINF;
		if($_REQUEST['sendmsgs']){
			$subject = $_REQUEST['subject'];
			$message = $_REQUEST['message'];
			$to_msg  = $_REQUEST['to_msg'];
			$user_id = $_SESSION['user_id'];
			
			if(!empty($to_msg) && !empty($subject) && !empty($message) ){
				$cols = "user_id,from_id,msg_subject,msg_message,msg_isread,msg_date";
				$vals = "$to_msg,$user_id,'$subject','$message',0,CURRENT_TIMESTAMP";
				//echo "INSERT INTO message ($cols) VALUES($vals)";die;
				//die(var_dump($vals));
				$isInsrt = $db->insert($cols,$vals,'message');
				
				if($isInsrt){
					$table = '<table>
		 			<thead>
		 			<tr>
						<th>Message</th>
						
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>'.$message.'</td>
						
					</tr>
					</tbody>
				</table>';
				$fEmial= "";
				$cMail = $_REQUEST['cc_email'];
				$userInfo = getUserInfo($to_msg);
				$to_email = $userInfo['email']; // $to_msg;
				
				//var_dump($table,$subject,$to_email,$fEmial,$cMail); die();
				
					emailTmp($table,$subject,$to_email,$fEmial,$cMail);

					msg("sec","Message has been sent!");
					
				}else{
					
					msg("err","Error occured while sending messages!");
				}
				
			}else{
					msg("err","Please fill the message form!");
				}
		}
}
function dateTimeExe($time){
	
	$orgDate = $time;
		
	$time = strtotime($time);
	
    $time = time() - $time; // to get the time since that moment

    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );
 	if ($time>86400) {
        return date('d M Y',strtotime($orgDate));
    }else{
		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'').' ago';
		}
	}


}

function updateMsgStatus(){
	global $db,$COMINF;
	$id = $_REQUEST['id'];
	$wcols = "msg_id=$id";
	$db->update("msg_isread=1","message",$wcols);
	}
//end new
					
function getDDStatus($status){
		global $LEVEL;
		switch($status){
		case 0:
			return 'Drafted';
		case 1:
			if($LEVEL==6)return "Pending"; return 'Send to Finance';
		case 2:
			return 'Paid';
		case 3:
			return 'Rejected';			
		}
}


function ddChange(){
	
	if(is_numeric($_POST['ddid']) && is_numeric($_POST['status'])){
		$db = new DB();
		$uCls = "dd_status=$_POST[status]";
		if($db->update($uCls,"dd_data","dd_id=$_POST[ddid]")){
			sentDDEmail();
			msg("sec","Status Updated successfully...");
		}else{
			msg('err',"DD Updation error, please try again!");
		}
	}
}


function ddDelete(){
	
	if(is_numeric($_POST['ddid'])){
		$db = new DB();
		$uCls = "dd_active=0";
		if($db->update($uCls,"dd_data","dd_id=$_POST[ddid]")){
			msg("sec","DD delete successfully...");
		}else{
			msg('err',"DD deletion error, please try again!");
		}
	}
}

function vendorDelete(){
	
	if(is_numeric($_POST['vdid'])){
		$db = new DB();
		$uCls = "vd_active=0";
		if($db->update($uCls,"vendors","vd_id=$_POST[vdid]")){
			msg("sec","Vendor delete successfully...");
		}else{
			msg('err',"Vendor deletion error, please try again!");
		}
	}
}

function addvendor(){
		$db = new DB();
	
		if(trim($_POST['company'])=="") msg('err',"Please input name!");
		if(!is_numeric($_POST['vfee'])) msg('err',"Please input valid fee amount!");
	
		$uID = $_SESSION['user_id'];
		
		if($_REQUEST['ERR']==''){				
				
			if(isset($_POST['edit'])){
				
			$uCls ="vd_fee=$_POST[vfee],vd_name='$_POST[company]',vd_email='$_POST[cemail]',vd_adress='$_POST[address]',vd_cperson='$_POST[cperson]'";
				$uCls ="$uCls,vd_contact='$_POST[cphone]',vd_mobile='$_POST[cmobile]',vd_uuser=$uID";
								
				$uCls ="$uCls,vd_bankname='$_POST[vdbankname]',vd_acctitle='$_POST[vdacctitle]',vd_accnumber='$_POST[vdaccnumber]'";
				$uCls = "$uCls,vd_branchname='$_POST[vdbranchname]',vd_branchcode='$_POST[vdbranchcode]',vd_swiftcode='$_POST[vdswiftcode]'";
				
				$uCls ="$uCls,vd_cnicnumber='$_POST[cnicnumber]',vd_remarks='$_POST[vdremarks]',vd_area='$_POST[carea]'";
				$uCls = "$uCls,vd_city='$_POST[ccity]',vd_udate=CURRENT_TIMESTAMP";
								
				if($db->update($uCls,"vendors","vd_id=$_POST[edit]")){
					msg("sec","Vendor Updated successfully...");
				}else{
					msg('err',"Vendor updation error, please try again!");
				}			
			}else{
				
				$cols ="vd_fee,vd_name,vd_email,vd_adress,vd_cperson,vd_contact,vd_mobile,vd_cuser";
				$cols ="$cols,vd_bankname,vd_acctitle,vd_accnumber,vd_branchname,vd_branchcode";
				$cols ="$cols,vd_swiftcode,vd_cnicnumber,vd_remarks,vd_area,vd_city,vd_cdate";
				
				$vals = "$_POST[vfee],'$_POST[company]','$_POST[cemail]','$_POST[address]','$_POST[cperson]','$_POST[cphone]','$_POST[cmobile]',$uID";
				
				$vals = "$vals,'$_POST[vdbankname]','$_POST[vdacctitle]','$_POST[vdaccnumber]','$_POST[vdbranchname]','$_POST[vdbranchcode]'";
				
				$vals = "$vals,'$_POST[vdswiftcode]','$_POST[cnicnumber]','$_POST[vdremarks]','$_POST[carea]','$_POST[ccity]',CURRENT_TIMESTAMP";
				
				if($db->insert($cols,$vals,'vendors')){
					msg("sec","Vendor added successfully...");
				}else{
					msg('err',"Vendor adding error, please try again!");
				}
			}
		}				
}
	
function setPost($parys,$table,$where){
		$db = new DB();
		$data = $db->select($table,"*",$where);
		//echo $db->query;
		if(mysql_num_rows($data)>0){
			$tdata = mysql_fetch_assoc($data);
			foreach($parys as $key=>$value){
				$_POST[$value] = $tdata[$key];
			}
		}else{
			foreach($parys as $key=>$value){
				$_POST[$value] = "";
			}				
		}
		return false;
}

function ddChecks($DDID){
		$db = new DB();
		$db->update("dc_active=0","dd_checks","dd_id=$DDID");
		if(isset($_REQUEST['tcheck'])){
			foreach($_REQUEST['tcheck'] as $check){
				if(is_numeric($check)){
					$ddcheck = $db->select("dd_checks","*","dd_id=$DDID AND as_id=$check");
					if(mysql_num_rows($ddcheck)>0){
						$db->update("dc_active=1","dd_checks","dd_id=$DDID AND as_id=$check");
					}else{
						$cols="dd_id,as_id,dc_cdate";
						$values="$DDID,$check,CURRENT_TIMESTAMP";
						if(!$db->insert($cols,$values,"dd_checks")) msg('err',"Check insertion error!, please try again");
					}
					$db->update("as_update=1","ver_checks","as_id=$check");	
				}
			}	
			
			$ddchecks = $db->select("dd_checks","*","dd_id=$DDID AND dc_active=0");
			while($ddcheck = mysql_fetch_assoc($ddchecks)){
					$db->update("as_update=0","ver_checks","as_id=$ddcheck[as_id]");
			}
		}
}

				
function sentDDEmail(){
	$db = new DB();
	                   
	$DDID = $_REQUEST['ddid'];
	$sEmail="";
	switch($_REQUEST['status']){
		case 1:
			$sEmail="jawaid@riskdiscovered.com";
			if(isset($_REQUEST['dataflow'])){
				$cMail="hassan@riskdiscovered.com";
			}else{
				$cMail="saima@riskdiscovered.com,sadia@riskdiscovered.com,mursaleen@riskdiscovered.com";
			}
		break;
		case 2:
		case 3:
			if(isset($_REQUEST['dataflow'])){
				$sEmail="hassan@riskdiscovered.com";
				$cMail="jawaid@riskdiscovered.com";
			}else{
				$sEmail="mursaleen@riskdiscovered.com";
				$cMail="saima@riskdiscovered.com,sadia@riskdiscovered.com,jawaid@riskdiscovered.com";
			}
		break;		
	}
	if(is_numeric($DDID) && $sEmail!=''){
		       
                $tbls = "dd_data";
                $data = $db->select($tbls,"*","dd_active=1 AND dd_id=$DDID");
                $re = mysql_fetch_array($data);
				$userInfo = getUserInfo($re['dd_user']);
				$total = $re['dd_fee']*$re['dd_units'];
				
				$status = getDDStatus($re['dd_status']);
				
				$uni = $db->select("uni_info","*","uni_id=$re[dd_uni]");
				$uni =  mysql_fetch_assoc($uni);
								
				$table = "<table style=\"width:100%\">";
				$table = "$table<tr><td colspan=\"2\"><h1>Submitted by: $userInfo[first_name] $userInfo[last_name]</h1></td></tr>";
				$table = "$table<tr>
									<td><strong>Unit(s):</strong></td>
									<td>$re[dd_units]</td>
							     </tr>";

				$table = "$table<tr>
									<td><strong>Fee Amount:</strong></td>
									<td>$re[dd_fee]</td>
							     </tr>";
				$table = "$table<tr>
									<td><strong>Total Amount:</strong></td>
									<td>$total</td>
							     </tr>";							 				
				$table = "$table<tr>
									<td><strong>Status:</strong></td>
									<td>$status</td>
							     </tr>";				

				$table = "$table<tr>
									<td><strong>Verifying Authoritys,Beneficiary:</strong></td>
									<td>$uni[uni_Name],$re[dd_bene]</td>
							     </tr>";

				$table = "$table<tr>
									<td><strong>Detail Page:</strong></td>
									<td><a href=\"https://backgroundcheck365.com/dashboard/?action=demanddraft&atype=details&ddid=$DDID\">Detail</a></td>
							     </tr>";
								 		 				
				$table = "$table</table>";
				$title = "#00$DDID DD Request ($status)";
				$fEmial = "";

				emailTmp($table,$title,$sEmail,$fEmial,$cMail);
	
	}
}

function dskipDD(){
	if(isset($_REQUEST['checks']) && is_array($_REQUEST['checks'])){
		$db = new DB();
		foreach($_REQUEST['checks'] as $check){
			    $success = true;
				$db->update("as_update=1","ver_checks","as_id=$check");	
		}
	}else{
		 msg('err','Please select any check to skip!');	
	}	
	if(isset($success)) msg('sec',"Demand draft skip successfully...");
}

function count_pending_dd(){
				$dWhere = "";
				$db = new DB();
				global $LEVEL;
				if($LEVEL==3) $dWhere = "c.user_id=$_SESSION[user_id] AND ";

                $tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN uni_info u ON u.uni_id=c.as_uni";
                $DCOUNT = $db->select($tbls,"COUNT(c.as_id) cnt","$dWhere c.as_update=0 AND d.v_isdlt=0 AND c.as_isdlt=0 AND c.as_uni<>0 AND c.checks_id=1 AND c.as_status<>'Problem' AND c.as_status<>'Close' AND u.uni_ddr=1 AND u.uni_nfe=0 AND u.uni_region!='' AND u.uni_city!=''");
				$DCOUNT = mysql_fetch_assoc($DCOUNT);
				
				return $DCOUNT['cnt'];
}

function requestddraft(){
	if(isset($_REQUEST['checks']) && is_array($_REQUEST['checks'])){
		$db = new DB();
		$uID = $_SESSION['user_id'];
		$srn = 1;
		$trs='';
		$dupl=0;
		$bbCode=array();
		foreach($_REQUEST['checks'] as $check){
			if(is_numeric($_REQUEST["cost$check"])){
				$fee = $_REQUEST["cost$check"];
				$uni = $_REQUEST["uni$check"];
				$ben = $_REQUEST["benf$check"];
				$as_bcode = $_REQUEST["as_bcode$check"];
				$attch='';
				$fname='';
				$vcost=0;
				if ($_FILES["file$check"]["error"] <= 0){
					$fname = $_FILES["file$check"]["name"];
					$attch = fileUpload("file$check",'ddrequest','dd/');
				}

						
				$cols = "dd_bcode,dd_vdcost,dd_uni,dd_bene,dd_fee,dd_units,dd_cdate,dd_status,dd_user,dd_att1,dd_tit1,dd_dataflow";
				$vals = "'$as_bcode',$vcost,$uni,'$ben',$fee,1,CURRENT_TIMESTAMP,1,$uID,'$attch','$fname','".(int)$_REQUEST['dataflow']."'";
				
				
				$selBBCode = $db->select("dd_data","dd_id","dd_bcode='$as_bcode' and dd_active=1");
	$numRows = mysql_num_rows($selBBCode);
	
	if($numRows>0){
		//store barcodes in a variable to display error
			$bbCode[] = $as_bcode;
			
	}else{
		
		$isInsrt = $db->insert($cols,$vals,'dd_data');
	}
				
	
				
	
				$DDID=$db->insertedID;						
				if($isInsrt){
					$user_info=getUserInfo($uID);
					$success= true;
					$sdate = date("j-M-Y",time());
					$benf = $_REQUEST["benf$check"];
					$unm = $_REQUEST["unm$check"];
					$cnm = $_REQUEST["cnm$check"];
					$tfee = $fee+$vcost;
					$trs .= "<tr>
						<td>$srn</td>
						<td>$user_info[first_name] $user_info[last_name]</td>	
						<td>$sdate</td>
						<td>$benf / $unm</td>
						<td>1</td>
						<td>$tfee</td>
						<td>$tfee</td>
						<td>$cnm</td>
					</tr>";
					$srn++;
					$ddcheck = $db->select("dd_checks","*","dd_id=$DDID AND as_id=$check");
					if(mysql_num_rows($ddcheck)>0){
						$db->update("dc_active=1","dd_checks","dd_id=$DDID AND as_id=$check");
					}else{
						$cols="dd_id,as_id,dc_cdate";
						$values="$DDID,$check,CURRENT_TIMESTAMP";
						$db->insert($cols,$values,"dd_checks");
					}
					$db->update("as_update=1","ver_checks","as_id=$check");	
					
					//$_REQUEST['ddid'] = $DDID;
					//sentDDEmail();
						
				}else{
					msg('err',"Demand draft sending error!");
				}
			
			}else{
				 msg('err','Please input valid fee amount');	
			}
		}
	}else{
		 msg('err','Please select any check for DD request');	
	}	
	
	if(isset($success)){
		
		if(!empty($bbCode)){
			msg('err',"$bbCode barcodes already exists !");
		}
		 msg('sec',"Demand draft request sent successfully...");
		 
		 $msg = "<table>
		 			<thead>
		 			<tr>
						<th>Sr #</th>
						<th>Submitted by</th>	
						<th>Request Date</th>
						<th>Beneficiary Name/ Name of Verifying Authority</th>
						<th>Units</th>
						<th>Fees</th>
						<th>Total Amount</th>
						<th>Client Name</th>
					</tr>
					</thead>
					<tbody>
					$trs
					</tbody>
				</table>";
		 
		 	$sEmail="jawaid@riskdiscovered.com";
			$cMail="saima@riskdiscovered.com,sadia@riskdiscovered.com,mursaleen@riskdiscovered.com";
			$title = "#00$DDID DD Request ($status)";
			$fEmial = "";
			emailTmp($msg,$title,$sEmail,$fEmial,$cMail);
				
				
	}
	
}


function adddemanddraft(){
	$db = new DB();
	if(trim($_POST['bcode'])=='')  msg('err','Please input Barcode First');
	if(strlen($_POST['bcode'])>22) msg('err','Barcode must be 22 characters long'); 
	if(!preg_match('/^[a-z0-9\-]+$/i', $_POST['bcode'])){
	 msg('err','Wrong  Barcode entered! Only letters, numbers and dash is allowed.');
	
	}
	$selBBCode = $db->select("dd_data","dd_id","dd_bcode='$_POST[bcode]' and dd_active=1");
	$numRows = mysql_num_rows($selBBCode);
	//echo $numRows;  exit;
	if($numRows>0 && 	!(isset($_POST['edit']))){
			 msg('err','This '.$_POST['bcode'].' barcode already exists !');
	}
	
	
	if(!is_numeric($_POST['verifying']))  msg('err','Please input verifying authoritys');	
	if(!is_numeric($_POST['units']))  msg('err','Please input unit(s)');
	if(!is_numeric($_POST['famount']))  msg('err','Please input fee amount');
	if(!is_numeric($_POST['vdcost'])) $_POST['vdcost']=0;
	
	$uID = $_SESSION['user_id'];
	
	if($_REQUEST['ERR']==''){
		if(isset($_POST['edit'])){
			$uCls = "dd_vdcost=$_POST[vdcost],dd_bcode='$_POST[bcode]',dd_uni=$_POST[verifying],dd_bene='$_POST[beneficiary]',dd_fee=$_POST[famount]";
			$uCls = "$uCls,dd_units=$_POST[units],dd_cdate=CURRENT_TIMESTAMP,dd_status=$_POST[status],dd_user=$uID";


			if ($_FILES["att1"]["error"] <= 0){
				$att1 = fileUpload('att1','ddrequest','dd/');
				if($att1){
						$name = $_FILES["att1"]["name"];
						$uCls = "$uCls,dd_att1='$att1',dd_tit1='$name'";	
				}
			}
	
			if ($_FILES["att2"]["error"] <= 0){
				$att2 = fileUpload('att2','ddrequest','dd/');
				if($att2){
						$name = $_FILES["att2"]["name"];
						$uCls = "$uCls,dd_att2='$att2',dd_tit2='$name'";	
				}
			}			

			if ($_FILES["att3"]["error"] <= 0){
				$att3 = fileUpload('att3','ddrequest','dd/');
				if($att3){
						$name = $_FILES["att3"]["name"];
						$uCls = "$uCls,dd_att3='$att3',dd_tit3='$name'";	
				}
			}	
						
			if($db->update($uCls,"dd_data","dd_id=$_POST[edit]")){
				ddChecks($_POST['edit']);
				$_REQUEST['ddid'] = $_POST['edit'];
				sentDDEmail();
				msg("sec","Demand draft updated successfully...");
			}else{
				msg('err',"Demand draft updation error, please try again!");
			}
							
		}else{
			$cols = "dd_vdcost,dd_bcode,dd_uni,dd_bene,dd_fee,dd_units,dd_cdate,dd_status,dd_user";
			$vals = "$_POST[vdcost],'$_POST[bcode]',$_POST[verifying],'$_POST[beneficiary]',$_POST[famount]";
			$vals = "$vals,$_POST[units],CURRENT_TIMESTAMP,$_POST[status],$uID";
			
			if ($_FILES["att1"]["error"] <= 0){
				$att1 = fileUpload('att1','ddrequest','dd/');
				if($att1){
						$name = $_FILES["att1"]["name"];
						$cols = "$cols,dd_att1,dd_tit1";
						$vals = "$vals,'$att1','$name'";	
				}
			}
	
			if ($_FILES["att2"]["error"] <= 0){
				$att2 = fileUpload('att2','ddrequest','dd/');
				if($att2){
						$name = $_FILES["att2"]["name"];
						$cols = "$cols,dd_att2,dd_tit2";
						$vals = "$vals,'$att2','$name'";	
				}
			}
			
			
			if ($_FILES["att3"]["error"] <= 0){
				$att3 = fileUpload('att3','ddrequest','dd/');
				if($att3){
						$name = $_FILES["att3"]["name"];
						$cols = "$cols,dd_att3,dd_tit3";
						$vals = "$vals,'$att3','$name'";	
				}
			}
			
			if(isset($_POST['dataflow'])){
				$cols = "$cols,dd_dataflow";
				$vals = "$vals,".(int)$_REQUEST['dataflow']."";
			}
			
			$isInsrt = $db->insert($cols,$vals,'dd_data');
			$DDID=$db->insertedID;						
			if($isInsrt){
				ddChecks($DDID);
				$_REQUEST['ddid'] = $DDID;
				sentDDEmail();
				msg('sec',"Demand Draft Added Successfully...");	
			}else{
				msg('err',"Demand Draft Adding Error!");
			}	
		}
	} 
}

function update_str($cols,$vals){
		$str = '';
		$cols = explode(',',$cols);
		$vals = explode(',',$vals);
		foreach($cols as $key=>$col){
			$str .=	(($str!='')?',':'').$col.'='.$vals[$key];
		}
		return 	$str;		
}
	
function csvbulkupload(){
	
	$db = new DB();
	if(isset($_FILES['bulk'])){
		$uID = $_SESSION['user_id'];
		$recdate = $_POST['rcyear'].'-'.$_POST['rcmonth'].'-'.$_POST['rcday'];
		if(!is_numeric($_REQUEST['comId'])) msg('err',"Please select client name!");

		if(count($_REQUEST['checks'])==0) msg('err',"Please select/add check(s)!");
		if($_REQUEST['ERR']==''){
		if ($_FILES["bulk"]["error"] <= 0){
				if($cid!='0'){
				$len = strlen($_FILES["bulk"]["name"]);
				$ext = strtolower(substr($_FILES["bulk"]["name"],($len-3)));
				if($ext=='csv'){
		
			$fp = fopen($_FILES["bulk"]["tmp_name"],'r');
			
			$err_msg='';
			$alRedy='';
			$lCount = 0;
			while($csv_line = fgetcsv($fp,1024)) {
				$values='';
				$lCount = $lCount+1;
				if($lCount==1) continue;
				for ($i = 0, $j = 3; $i <= $j; $i++) {
					$csv_line[$i] = addslashes($csv_line[$i]);
					$values .= (($values!='')?',':'')."'".trim($csv_line[$i])."'";
				}
				
				if(is_numeric($csv_line[0])){
					$data = $db->select("ver_data","emp_id","emp_id='$csv_line[0]' AND com_id=$_REQUEST[comId]");
					
					if(mysql_num_rows($data)==0){
						$bCode = cBCode($_REQUEST['comId'],'01');
						$cols="emp_id,v_name,v_ftname,v_nic,com_id,v_recdate,v_bcode,v_uadd";
						$values="'$csv_line[0]','$csv_line[1]','$csv_line[2]','$csv_line[3]',$_REQUEST[comId],'$recdate','$bCode',$uID";
						$isInserted = $db->insert($cols,$values,"ver_data");
						$VID=$db->insertedID;
						if($isInserted){					
								foreach($_REQUEST['checks'] as $check){
									$bCode = cBCode(0,0,$VID,$check);
									$cols="as_bcode,v_id,checks_id,as_uadd,as_addate";
									$values="'$bCode',$VID,$check,$uID,CURRENT_TIMESTAMP";
									if(!$db->insert($cols,$values,"ver_checks")) msg('err',"Check insertion error! record ID [ $csv_line[0] ]!");
								}	
						}else{
							 msg('err',"Insertion error! record ID [ $csv_line[0] ]!");
							 
						}
					}else{
						msg('err',"Record is already exist [ $csv_line[0] ]!");
					}

				}else{
					msg('err',"Insertion frror! record ID [ ".$csv_line[0]." ]");
				}
				}
			fclose($fp);
			if(isset($isInserted)){
				if($isInserted) msg('sec',"File uploaded successfully...");
			}
				
			}else{ 
				msg('err',"Invalid file type please upload correct file!");
			}
				}else{
					msg('err',"Please select company name!");
				}
		}else{
			msg('err',"Please select a csv file to upload!");
		}
		}
	}

}

function getExts($type='',$bth=0){
	$db  = new DB();
	$exs = array();
	if(isset($_REQUEST['fFile'])){
		$exs[0] = $_REQUEST['fFile'];
	}else{
		if($type!='') $where="fil_type='$type'"; else $where='';
		$extensions = $db->select("extension","*",$where);
		while($extension = mysql_fetch_assoc($extensions)){
			if($bth==0) $imgs="$extension[fil_edoc]$extension[file_eimg]"; 
			elseif($bth==1) $imgs=$extension['fil_edoc']; else $imgs=$extension['file_eimg']; 
			$tar = explode(',',$imgs);
			if(count($tar)>0) $exs = array_merge($tar,$exs);
		}
	}
	return $exs;	
}

function fileUpload($key,$exs,$path='',$sname='',$exnm=true){
	$fName=$_FILES[$key]['name'];
	$fary  = explode('.',$fName);
	if($sname==''){
		$sname = preg_replace('/[^a-zA-Z0-9\-_]/','',ucwords(strtolower($fary[0])));
	}
	if(count($fary)>0) $ex = $fary[count($fary)-1]; else $ex = 'NA';
	$exs = getExts($exs,0);
	if(in_array($ex,$exs)){
		$indx=strtoupper(get_rand_val(6));
		if($exnm){
			 $fPath = $path."$sname-$indx.$ex";
		}else{
			 $fPath = $path."$sname.$ex";
		}
		if(move_uploaded_file($_FILES[$key]['tmp_name'],$fPath)){
			return $fPath;
		}
	}else{
		$exs = implode(',',$exs);
		msg('err',"$ex File type is not allowed!, Please Upload the following types [ $exs ] !");
	}
	return false;
}

function getClUser($clientID){

	$db = new DB();

	$cInfo = $db->select("users","*","com_id=$clientID AND is_active=1 AND level_id=4");

	if(mysql_num_rows($cInfo)>0){

		return $cInfo;

	}

	return false;

}



function srChecks(){

	global $aType;

	if($aType=='ready') $sVal=4; else $sVal=0;

	$db = new DB();

	if(isset($_REQUEST['record'])){

		foreach($_REQUEST['record'] as $term){

				$uCls = "v_sent=$sVal,v_cdnld=0,v_stdate=CURRENT_TIMESTAMP";

				$isUpdate = $db->update($uCls,"ver_data","v_id=$term AND v_status='Close'");

				if($isUpdate){

					$isUpdate = $db->update("as_sent=$sVal,as_stdate=CURRENT_TIMESTAMP","ver_checks","v_id=$term AND as_status='Close'");

					if($sVal==4){

						//$vCheck = getCheck(0,0,$vcheck);

						//$tCheck = getCheck($vCheck['checks_id'],0,0);

					

						$vData  = getVerdata($term);

						$comInfo = getcompany($vData['com_id']);

						$comInfo = mysql_fetch_array($comInfo);

						if($comInfo['sentmail']==1){

							$vData['logo']=$comInfo['logo'];

							$clUsers = getClUser($vData['com_id']);

							if($clUsers){

								while($clUser = mysql_fetch_assoc($clUsers)){
									$fullName = $clUser['first_name'].' '.$clUser['last_name'];
									
									$check_added_by = $vData['v_uadd'];
									$user_info = getUserInfo($check_added_by);
									$loc_id = $user_info['loc_id'];
									if($loc_id==0){
											// to all users
									if($clUser['is_subuser']==0){									
									sentEmail($vData,true,$clUser['username'],$clUser['email'],$fullName);
									}
									}else{
										if($loc_id==$clUser['loc_id'] && $clUser['puser_id']!=0 && $clUser['is_subuser']!=0){
											// to sub user
									sentEmail($vData,true,$clUser['username'],$clUser['email'],$fullName);
																		
										}else if($clUser['puser_id']==0 && $clUser['is_subuser']==0){
											// to parent user
									sentEmail($vData,true,$clUser['username'],$clUser['email'],$fullName);
									
										}
									}
									
									
									

										

								}

							}

						}

					}

				}

				if(!$isUpdate) msg('err',"Case Sending Error!");

		}

	}else if(isset($_REQUEST['vchecks'])){

		foreach($_REQUEST['vchecks'] as $term){

			$isUpdate = $db->update("as_sent=$sVal,as_stdate=CURRENT_TIMESTAMP","ver_checks","as_id=$term AND as_status='Close'");

			if($isUpdate){

					if($sVal==4){

						$vCheck = getCheck(0,0,$term);

						$tCheck = getCheck($vCheck['checks_id'],0,0);

						$vData  = getVerdata($vCheck['v_id']);

						$comInfo = getcompany($vData['com_id']);

						$comInfo = mysql_fetch_array($comInfo);

						if($comInfo['sentmail']==1){

							$vData['logo']=$comInfo['logo'];

							$vData['checks_title']=$tCheck['checks_title'];

							$vData['as_id']=$term;

							$clUsers = getClUser($vData['com_id']);

								if($clUsers){

								while($clUser = mysql_fetch_assoc($clUsers)){
									$fullName = $clUser['first_name'].' '.$clUser['last_name'];
									$check_added_by = $vCheck['as_uadd'];
									$user_info = getUserInfo($check_added_by);
									$loc_id = $user_info['loc_id'];
									if($loc_id==0){
											// to all users
									if($clUser['is_subuser']==0){
									sentCheckEmail($vData,false,$clUser['username'],$clUser['email'],$fullName);
									}
									
									}else{
										if($loc_id==$clUser['loc_id'] && $clUser['puser_id']!=0 && $clUser['is_subuser']!=0){
											// to sub user 
											//echo $clUser['email']." sub users <br>";
									sentCheckEmail($vData,false,$clUser['username'],$clUser['email'],$fullName);
																		
										}else if($clUser['puser_id']==0 && $clUser['is_subuser']==0){
											// to parent user
											//echo $clUser['email']." parent users <br>";
									sentCheckEmail($vData,false,$clUser['username'],$clUser['email'],$fullName);
									
										}
									}
								
										

								} // end while

							}

						}

					}				 

			}else{

				msg('err',"Check Sending Error!");

			}

		}

	}else{

		msg('err',"Please Checkout any Case/check to Sent");

	}	

}



function sentCheckEmail($verData,$report,$userName,$toEamil,$fullName=""){
	$db = new DB();
	$dLink = "?action=download&emp=$verData[emp_id]&user=$userName";

	if($report){

		$dLink = "$dLink&report=$verData[v_id]";

		$title = "Report";

	}else{
		$dLink = "$dLink&report=$verData[v_id]";
		//$dLink = "$dLink&check=$verData[as_id]";
		$title = "Report";
		//$title = $verData['checks_title']." Report";

	}
	$esub = "The $title on #$verData[emp_id] $verData[v_name] has been completed";
	//$esub = "$verData[v_name]";

	$etxt = "<table><tr><td style=\"vertical-align:middle\">The $title for the #$verData[emp_id] $verData[v_name] has been completed on the system and is ready for download.</td>

	<td></td></tr>

	<tr><td colspan=\"2\">

	<br/><br/><div style=\"text-align:center;\">Please <a href=\"".SURL."$dLink\"

	style=\"background-color: #e31c23;	

    background-image: -webkit-gradient(linear, left top, left bottom, from(#e31c23), to(#b40911)); /* Saf4+, Chrome */

	background-image: -webkit-linear-gradient(top, #e31c23, #b40911); /* Chrome 10+, Saf5.1+, iOS 5+ */

	background-image:    -moz-linear-gradient(top, #e31c23, #b40911); /* FF3.6 */

	background-image:     -ms-linear-gradient(top, #e31c23, #b40911); /* IE10 */

	background-image:      -o-linear-gradient(top, #e31c23, #b40911); /* Opera 11.10+ */

	background-image:         linear-gradient(top, #e31c23, #b40911);

	border-radius:6px;

    -moz-border-radius:6px;

    -webkit-border-radius:6px;

    -o-border-radius:6px;

	font-weight:bold;

	border-color: #b40911;

	color: white;

	border: 1px solid #000;

	text-shadow: 0 1px 0 #000;

	padding:5px 10px;

    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3);

    transition: background 5000ms ease-in;\"

	>download</a>.</div></td></tr></table>";

		
	// check all status are closed
	$countStatus = $db->select("ver_checks"," as_id "," v_id=$verData[v_id]  AND as_isdlt=0 AND  as_sent=4 AND as_status='Close'");
	
	$countChecks = $db->select("ver_checks"," as_id "," v_id=$verData[v_id]  AND as_isdlt=0 ");
		
	if(@mysql_num_rows($countStatus)==@mysql_num_rows($countChecks)){
	emailTmp($etxt,$esub,$toEamil,'','','','',$fullName);
	}

}

function sentEmail($verData,$report,$userName,$toEamil,$fullName=""){
	$db = new DB();
	$dLink = "?action=download&emp=$verData[emp_id]&user=$userName";

	if($report){

		$dLink = "$dLink&report=$verData[v_id]";

		$title = "Report";

	}else{

		$dLink = "$dLink&check=$verData[as_id]";

		$title = $verData['checks_title'];

	}

	$esub = "The $title on #$verData[emp_id] $verData[v_name] has been completed";

	$etxt = "<table><tr><td style=\"vertical-align:middle\">The $title for the #$verData[emp_id] $verData[v_name] has been completed on the system and is ready for download.</td>

	<td><img src=\"".SURL."$verData[logo]\" width=\"200px\" /></td></tr>

	<tr><td colspan=\"2\">

	<br/><br/><div style=\"text-align:center;\">Please <a href=\"".SURL."$dLink\"

	style=\"background-color: #e31c23;	

    background-image: -webkit-gradient(linear, left top, left bottom, from(#e31c23), to(#b40911)); /* Saf4+, Chrome */

	background-image: -webkit-linear-gradient(top, #e31c23, #b40911); /* Chrome 10+, Saf5.1+, iOS 5+ */

	background-image:    -moz-linear-gradient(top, #e31c23, #b40911); /* FF3.6 */

	background-image:     -ms-linear-gradient(top, #e31c23, #b40911); /* IE10 */

	background-image:      -o-linear-gradient(top, #e31c23, #b40911); /* Opera 11.10+ */

	background-image:         linear-gradient(top, #e31c23, #b40911);

	border-radius:6px;

    -moz-border-radius:6px;

    -webkit-border-radius:6px;

    -o-border-radius:6px;

	font-weight:bold;

	border-color: #b40911;

	color: white;

	border: 1px solid #000;

	text-shadow: 0 1px 0 #000;

	padding:5px 10px;

    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3);

    transition: background 5000ms ease-in;\"

	>download</a> report.</div></td></tr></table>";

	
	
	emailTmp($etxt,$esub,$toEamil,'','','','',$fullName);	

}



function checkParms(){

		$db = new DB();

		if(trim($_REQUEST['user'])!="" && is_numeric($_REQUEST['emp']) && (is_numeric($_REQUEST['report']) || is_numeric($_REQUEST['check']))){

			$uInfo = $db->select("users","*","username='$_REQUEST[user]'");

			if(mysql_num_rows($uInfo)==1){

				$uInfo = mysql_fetch_array($uInfo);

				if(is_numeric($_REQUEST['check'])){

					$where = "vd.emp_id='$_REQUEST[emp]' AND vc.as_id=$_REQUEST[check] AND vd.com_id=$uInfo[com_id]";

				}else{

					$where = "vd.emp_id='$_REQUEST[emp]' AND vd.v_id=$_REQUEST[report] AND vd.com_id=$uInfo[com_id]";

				}

				$case = $db->select("ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id","*",$where);

				if(mysql_num_rows($case)>0) return $uInfo['user_id'];

			}

		}

		return false;

}

	

function editFields(){

	$_REQUEST['val'] = str_replace('||','&',$_REQUEST['val']);

	$iVal = htmlspecialchars(trim($_REQUEST['val']));

	$cols="$_REQUEST[key]='$iVal'";



	switch($_REQUEST['typ']){

		case 'date':

			$eVal = date("j-F-Y",strtotime($iVal));

		break;

		case 'multy':

			$_REQUEST['mtt1'] = str_replace('||','&',$_REQUEST['mtt1']);

			$_REQUEST['stt1'] = str_replace('||','&',$_REQUEST['stt1']);

			$mtt1 = htmlspecialchars(trim($_REQUEST['mtt1']));

			$stt1 = htmlspecialchars(trim($_REQUEST['stt1']));

			$cols=$cols.",d_stitle='$stt1',d_mtitle='$mtt1'";

			$eVal = "$mtt1||$stt1||$iVal";

		break;	

		default:

			$eVal= $iVal;

		break;

	}



	if(isset($_REQUEST['data'])){

		if(edData($_REQUEST['data'],'edit',$cols)){

			echo $eVal;

		}else echo "u error";

		exit();		

	}else if(isset($_REQUEST['ascase'])){

		if(updateCheck($_REQUEST['ascase'],$cols)){

			echo $eVal;

		}else echo "u error";

		exit();		

	}else if(isset($_REQUEST['case'])){

		if(updateData($_REQUEST['case'],$cols)){

			echo $eVal;

		}else echo "u error";

		exit();		

	}	

} 



function changePass(){

	if(!isset($_SESSION[user_id])) return false;

	if((($_POST['npass']!='') && ($_POST['cpass']!='')) && ($_POST['npass']==$_POST['cpass'])){

		$db = new DB();

		$uInfo = $db->select("users","*","user_id=$_SESSION[user_id]");

		$uInfo = mysql_fetch_array($uInfo);

		$oPass = md5(md5($_POST['opass']).md5($uInfo['salt']));

		if($oPass==$uInfo['password']){

			$nPass = md5(md5($_POST['npass']).md5($uInfo['salt']));

			$isInup = $db->update("password='$nPass'","users","user_id=$_SESSION[user_id]");

			if($isInup){
				
				$client_agreement = $db->select("client_agreement_confg","*","agr_receiver = $_SESSION[user_id] AND is_expired = '0' AND is_user_login = '1'");
if(mysql_num_rows($client_agreement))
{
	
	$isInup = $db->update("is_user_login='0'","client_agreement_confg","agr_receiver = $_SESSION[user_id] AND is_expired = '0'");
	
}
				
				
				 msg('sec',"Password Updated Successfully...");

			}else msg('err','Password rest Error!, Plase try Again');

		}else msg('err',"Please Input a Valid Password!");

	}

}



function resetPass(){

	if(validateEmail($_POST['email'])){

		$db = new DB();

		$uinfo = $db->select("users","*","email='$_POST[email]'");

		if(mysql_num_rows($uinfo)==1){

			$uinfo = mysql_fetch_assoc($uinfo);

			$sysps = get_rand_val(8);	  			

			$pass = md5(md5($sysps).md5($uinfo['salt']));	

			$isUpdate = $db->update("password='$pass'","users","user_id=$uinfo[user_id]");

			if($isUpdate){

				msg('sec',"Your Password have been reset Successfully, Please Check Your Email");

				$message="$uinfo[first_name] $uinfo[last_name]"."\r\n";

				$message.="<table>

							<tr>

								<td>User Name:</td>

								<td>$uinfo[username]</td>

							</tr>

							<tr>

								<td>Password:</td>

								<td>$sysps</td>

							</tr>

							<tr>

								<td>Login URL:</td>

								<td><a href=\"".SURL."?action=login\"".">".PORTAL."</a></td>

							</tr>												

				</table>";



				emailTmp($message, "Login Detail",$uinfo['email']);
/*				$mail             = new PHPMailer();
				$mail->IsSMTP(); // telling the class to use SMTP
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
				$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
				$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
				$mail->Username   = "noreply@riskdiscovered.com";  // GMAIL username
				$mail->Password   = "risk123456789";              // GMAIL password
				$mail->SetFrom('noreply@riskdiscovered.com');
	
			  
			   
			   $mail->Subject    = "Login Detail";
			   $mail->MsgHTML($message);
			   $mail->AddAddress($uinfo['email']);
			   $mail->Send();
*/

				return true;

			}else msg('err','Password reset Error!, Plase try Again');

		}

	}

		 msg('err','Please Input Valid Email Address!');	

}



function subcontactus(){

	$db = new DB();

	if($_POST['name']=='')  msg('err','Please Input Full Name');	

	if(!validateEmail($_POST['email'])) msg('err','Please Input Valid Email Address!');

	if($_POST['comtit']=='')  msg('err','Please Input Subject!');	

	if($_POST['comtxt']=='')  msg('err','Please Input Message');

	

	if($_REQUEST['ERR']==''){

		$package = $db->select("contactus","*","cnp_email='$_POST[email]' AND cnp_title LIKE '$_POST[comtit]'");

		if(mysql_num_rows($package)==0){

			$uid = (isset($_SESSION['user_id']))?$_SESSION['user_id']:0;

			$cols = "cnp_name,cnp_email,cnp_title,cnp_msg,user_id";

			$vals = "'$_POST[name]','$_POST[email]','$_POST[comtit]','$_POST[comtxt]',$uid";

			$isInsrt = $db->insert($cols,$vals,'contactus');

			if($isInsrt){

				msg('sec',"Contact Detail [ $_POST[comtit] ] is Sent Successfully...");	

			}else{

				msg('err',"Contact Detail [ $_POST[comtit] ] Sending Error!");

			}			

		}else{

			msg('err',"Contact Detail [ $_POST[comtit] ] is Already Sent!");

		}

	} 

}



function caseWizard(){

	$db = new DB();

	if(is_numeric($_POST['pkg'])){

		$package = $db->select("packages","*","pkg_id=$_POST[pkg]");

		if(mysql_num_rows($package)>0) $_POST['step']=2; else{

			 msg('err',"Please Select Valid Package!");

			 $_POST['step']=1;

		}

		$_POST['step']=2;

		if(isset($_POST['type_data'])){

			$_POST['step']=3;

		}

		if(isset($_POST['uoptn'])){

			switch($_POST['uoptn']){

				case 'applicant':

					quickInvitation();

				return 0;

				case 'upload':

					subinvitation();

				return 0;

				case 'bulk':

					bulkUpload();

				return 0;									

			}				

		}

	} else{

		msg('err',"Please Select a Package!");

		$_POST['step']=1;

	}

}



function addinvitation(){

	$db = new DB();

	$iinfo = $db->select("invitation","*","(inv_hash='$_REQUEST[invitation]')");

	if(mysql_num_rows($iinfo)>0){

		$iinfo = mysql_fetch_assoc($iinfo);

		global $COMINF;

		$COMINF['id']     = $iinfo['com_id'];

		$_POST['v_name']  = $iinfo['name'];

		$_POST['inv_id']  = $iinfo['inv_id'];

		$_POST['inv_hash']  = $iinfo['inv_hash'];

		$_POST['email'] = $iinfo['email'];

		$_POST['pkg']     = $iinfo['pkg_id'];

		if($iinfo['inv_status']==0){

			addApplicant();

		}else{

			subinvitation();

		}

	}

}



function addApplicant(){

	$db = new DB();global $COMINF;

	if($_POST['passa']==$_POST['passb']){

		if($_POST['passa']=='')   msg('err','Please Input Password!');	

	}else{

		 msg('err','Password Mismatch, Please Input Correct Passwords!');	

	}

	

	if($_REQUEST['ERR']==''){		

		$uinfo = $db->select("users","*","username='$_POST[email]'");

		if(mysql_num_rows($uinfo)==0){

			$name = explode(" ", $_POST['v_name']);

			$fname = $name[0];

			$lname='';

			for($i=1;$i<count($name);$i++){

				$lname = trim("$lname $name[$i]");

			}

			$salt = get_rand_val(8);	  			

			$pass = md5(md5($_POST['passa']).md5($salt));

			$cols ="first_name,last_name,email,username,password,salt,level_id,validation,address,com_id,pass,is_active";

			$vals = "'$fname','$lname','$_POST[email]','$_POST[email]','$pass','$salt',5,'$_POST[inv_hash]','$_POST[address]'";

			$vals = "$vals,$COMINF[id],'$_POST[passa]',0";

			$isRegister = $db->insert($cols,$vals,'users');

			if($isRegister){

				msg('sec',"$_POST[v_name] Registered Successfully...");

				$isUpdate = $db->update("inv_status=1","invitation","inv_id=$_POST[inv_id]");

				return true;

			}else{

				msg('err','Registration Error!');	

			}

		}			

	}

	return false;			

}



function subinvitation(){

	$db = new DB();

	global $COMINF;

	if($_POST['v_ftname']=='') msg('err','Please Input Candidate Fathers Name');

	if($_POST['v_dob']=='')    msg('err','Please Input Candidate Date Of Birth');	

	if($_POST['v_nic']=='')    msg('err','Please Input Candidate NIC');	

	

	if($_REQUEST['ERR']==''){

		$case=$db->select("ver_data","com_id","com_id=$COMINF[id] AND v_nic='$_POST[v_nic]'");

		if(mysql_num_rows($case)>0) {

				$_POST['step']=3;

				msg('err',"Candidate NIC [ $_POST[v_nic] ] is Already Exist!");

				return false;

		}

		$dCols = 'v_name,v_nic,v_ftname,v_dob,v_save,qt_id,com_id,v_uadd';

		$uid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;

		if(is_numeric($_POST['inv_id'])){

			$where = "validation='$_POST[inv_hash]' AND level_id=5";

			$uinfo = $db->select("users","*",$where);

			if(mysql_num_rows($uinfo)>0){

				$uinfo = mysql_fetch_assoc($uinfo);

				$uid = $uinfo['user_id'];

			}

		}		

		$vdate=changDate($_POST['v_dob']);

		$dVals="'$_POST[v_name]','$_POST[v_nic]','$_POST[v_ftname]','$vdate','0',$_POST[pkg],$COMINF[id],$uid";

		$isInsUp = $db->insert($dCols,$dVals,"ver_data");

		

		if($isInsUp){

			$lID=$db->insertedID;

			$_REQUEST['case'] = $lID;

		

			$bcode = cBCode($COMINF['id'],'01',$lID);

			$db->update("v_bcode='$bcode'","ver_data","v_id=$lID");



			$checks=$db->select("package_items","checks_id","pkg_id=$_POST[pkg]");

			while($check=mysql_fetch_array($checks)){

				$cudp = $db->insert("v_id,checks_id,as_uadd","$lID,$check[checks_id],$uid","ver_checks");

				if($cudp){

					$CID=$db->insertedID;

					$ccode = cBCode($COMINF['id'],'01',$lID,$CID);	

					$db->update("as_bcode='$ccode'","ver_checks","as_id=$CID");

				}

			}

		}else{

			msg('err','Case Insertion Error!');

			return false;

		}

		

		if(is_numeric($_POST['inv_id'])){

			$where = "validation='$_POST[inv_hash]' AND level_id=5";

			$uinfo = $db->select("users","*",$where);

			$isUpdate = $db->update("is_active=1","users",$where);

			$uinfo = mysql_fetch_assoc($uinfo);

			$_POST['username'] = $uinfo['username']; 

			$_POST['password'] = $uinfo['pass'];

			$message="$uinfo[first_name] $uinfo[last_name]"."\r\n";

			$message.="<table>

						<tr>

							<td>User Name:</td>

							<td>$uinfo[username]</td>

						</tr>

						<tr>

							<td>Password:</td>

							<td>$uinfo[pass]</td>

						</tr>

						<tr>

							<td>Login URL:</td>

							<td><a href=\"".SURL."?action=login\"".">".PORTAL."</a></td>

						</tr>												

			</table>";



								   $mail             = new PHPMailer();
								   $mail->IsSMTP(); // telling the class to use SMTP
								   $mail->SMTPAuth   = true;                  // enable SMTP authentication
								   $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
								   $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
								   $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
								   $mail->Username   = "noreply@backcheckgroup.com";  // GMAIL username
								   $mail->Password   = "kashif123";              // GMAIL password
								   $mail->SetFrom('noreply@riskdiscovered.com');
		   
		   
		   $mail->Subject    = "Login Detail";
		   $mail->MsgHTML($message);
		   $mail->AddAddress($uinfo['email']);
		   $mail->Send();
   

			if(doLogin()){

				header("location:".SURL."?action=dashboard");

				exit();

			}

		}

		$_POST['step']=4;

	}

		

}



function quickInvitation(){

	$db = new DB();

	global $COMINF;

		if(is_numeric($_POST['pkg'])){

			for($i=0;$i<=count($_POST['email']);$i++){

				$email=$_POST['email'][$i];

				$name =$_POST['name'][$i];

				if($email!='' && $name!=''){

					if(validateEmail($email)){

						$iinfo = $db->select("users","*","email='$email'");

						if(mysql_num_rows($iinfo)==0){	

							$iinfo = $db->select("invitation","*","email='$email' AND com_id=$COMINF[id]");

							if(mysql_num_rows($iinfo)==0){

							$hash = md5(md5($email).md5($COMINF['id']));

							$cols = "name,com_id,user_id,email,pkg_id,inv_hash";

							$vals = "'$name',$COMINF[id],$_SESSION[user_id],'$email',$_POST[pkg],'$hash'";

							$isInvite = $db->insert($cols,$vals,'invitation');

							if($isInvite){

							   	   $message=$name."\r\n";

							   	$message.="Invitation URl: ".SURL."?invitation=$hash";

								   $mail             = new PHPMailer();
								   $mail->IsSMTP(); // telling the class to use SMTP
								   $mail->SMTPAuth   = true;                  // enable SMTP authentication
								   $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
								   $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
								   $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
								   $mail->Username   = "noreply@backcheckgroup.com";  // GMAIL username
								   $mail->Password   = "kashif123";              // GMAIL password
								   $mail->SetFrom('noreply@riskdiscovered.com');
								   
								   
								   $mail->Subject    = "Invitation URL";
								   $mail->MsgHTML($message);
								   $mail->AddAddress($email);
								   $mail->Send();
		   						

								msg('sec',"Invitation Sent Successfully to [ $email ] ...");

							}else{

								msg('err',"Invitation Sending Error [ $email ]!");							

							}

						}else{

							msg('err',"Invitation to [ $email ] is Already Sent!");

						}

						}else{

							msg('err',"Eamil $email is Already in Use!");	

						}

					}else{

						msg('err',"Please type valid email address [ $email ]!");	

					}

				}

			}

			$_POST['step']=4;

		}else{

			msg('err',"Please Select a  Package!");	

		}

}



function bulkUpload(){

	$db = new DB();

	global $COMINF;

	if(isset($_FILES["bulkfile"])){

		if ($_FILES["bulkfile"]["error"] <= 0){

			$fName = $_FILES["bulkfile"]["name"];

			$len = strlen($fName);

			$ext = strtolower(substr($_FILES["bulkfile"]["name"],($len-3)));

			if($ext=='zip'){

				$indx=rand(100,999).strtoupper(get_rand_val(10)).rand(100,999);

				$fPath = "upload/$indx.zip";

				if(move_uploaded_file($_FILES["bulkfile"]["tmp_name"], $fPath)){

					$db->insert("bulk_name,bulk_path,com_id,user_id","'$fName','$fPath',$COMINF[id],$_SESSION[user_id]","bulk_upload");

					$to="kzahid@dataflowgroup.com,mtalal16@yahoo.com";

					$subject="File Upload";

					$message.="File Path: ".SURL.$fPath;

					$headers = "From:noreply@backgroundcheck365.com\r\n";

					$headers .= "Content-type: text/html\r\n";

					//mail($to, $subject, $message, $headers);	

				}

			}else{

				msg('err',"Only zip File is allowed! [ $fName ]"); 

				return false;	

			}

		}

	}else{

		msg('err',"Please Upload zip File!");	

		return false;

	}

	$_POST['step']=4;

}



function docStatus($vid){

	$docs = array();

	$docs['tdcs'] = 0;

	$docs['docs'] = 0;

	$db = new DB();

	$checks = $db->select("ver_checks","*","v_id=$vid");

	if(mysql_num_rows($checks)>0){

		while($check = mysql_fetch_array($checks)){

			$flds = $db->select("fields_maping","*","checks_id=$check[checks_id] AND fl_key<>'file' AND in_id=5");

			while($fld = mysql_fetch_array($flds)){

				$docs['tdcs']=$docs['tdcs']+1;

				$doc = $db->select("add_data","*","as_id=$check[as_id] AND d_type='$fld[fl_key]' AND d_isdlt=0");

				if(mysql_num_rows($doc)>0) $docs['docs']=$docs['docs']+1;

			}

		}

	}

	return $docs;

}



function addctyctry(){

	$db = new DB();
 
	if(is_numeric($_REQUEST['ascase']) && is_numeric($_POST['country']) && (is_numeric($_POST['city']) || $_POST['city']==0)){
		
		$cityState = ($_POST['city']==0)?"":", citystate_id=$_POST[city]";

		$isUpdate = $db->update("country_id=$_POST[country] $cityState","ver_checks","as_id=$_REQUEST[ascase]");
		 
		 
		  addActivity('data',"Progress updated by ".SUDONYMS,0,'',$_REQUEST['case'],$_REQUEST['ascase'],'edit');
		if(!$isUpdate){

			msg('err',"Information Updation Error!");	

		}

	}else{

			msg('err',"Please Input Valid Information!");		

	}

}



function bookmark(){

	$db = new DB();

	if(is_numeric($_REQUEST['case'])){

		$info = $db->select("ver_data","v_bmk","v_id=$_REQUEST[case]");

		$info = mysql_fetch_array($info);

		if($info['v_bmk']==0) $info['v_bmk']=1; else $info['v_bmk']=0; 

		$isIncUp = $db->update("v_bmk=$info[v_bmk]","ver_data","v_id=$_REQUEST[case]"); 

		if($isIncUp){

			if($info['v_bmk']==1){

				echo 'bmarked';	

			}else{

				 echo 'umarked';

			}	

		}

	}

}



function changDate($date,$dif=0){

	$montharray = array (

        '01' => 'Jan',

        '02' => 'Feb',

        '03' => 'Mar',

        '04' => 'Apr',

        '05' => 'May',

        '06' => 'Jun',

        '07' => 'Jul',

        '08' => 'Aug',

        '09' => 'Sep',

        '10' => 'Oct',

        '11' => 'Nov',

        '12' => 'Dec' );

	$explode = explode(' ',$date);

	foreach($montharray as $key => $val){

		if(strtolower($explode[1]) == strtolower($val)){

			$explode[1] = $key; 

			break;

		}

	}	

	if(strlen($explode[0])==1) $explode[0] = '0'.$explode[0];

	$date = $explode[2].'-'.$explode[1].'-'.$explode[0];

	

	$date=strtotime($date)+(86400*$dif);

	$date = date("Y-m-d",$date);

	return $date;

}	



function editProfile(){

$db = new DB();

$para = "name='$_REQUEST[name]',email='$_REQUEST[email]',title='$_REQUEST[title]',address='$_REQUEST[address]',pagetitle='$_REQUEST[pagetitle]',pagesolgan='$_REQUEST[pagesolgan]',pagedesc='$_REQUEST[pagedesc]'

,agreement='$_REQUEST[agreement]'";

$isIncUp = $db->update($para,"company","id=$_REQUEST[id]");

if(isset($_FILES['logo']) && $_FILES['logo']['name']!=''){	

			$FPATH =$_SERVER['DOCUMENT_ROOT']."/";

			$fileName =$_FILES['logo']['name'];

			$ext = explode('.',$fileName);

			$ext = strtolower($ext[(count($ext)-1)]);

			$extIAy = array('jpg','gif','png');

			if(in_array($ext,$extIAy)){

				$time = date("j-M-y_H:i:s",time());

				$rval = rand(100,999);

				$fPath = "logos/$fileName-$time.$ext";

				$tID = $_REQUEST['task'];

				if(move_uploaded_file($_FILES["logo"]["tmp_name"],$fPath)){

					$isIncUp = $db->update("logo='$fPath'","company","id=$_REQUEST[id]");

					if(!$isIncUp) msg('err',"File Uploading Error !");					

				}else 	msg('err',"File Uploading Error !");	

							

			}else msg('err',"$ext File Type is not Allowed [ $fileName ]"); 	

		}

if($isIncUp){

				msg('sec',"Profile Edited Successfully...");					

				return true;	

			} 	msg('err',"Profile Editing Error !");



}



function editPackage(){

	$db = new DB();

	$db->delete("package_items","pkg_id=$_REQUEST[pkg_id]");

	if(is_array($_POST['checks'])){

		$error='No';

	foreach($_POST['checks'] as $checks)

		{

			$isInsUp = $db->insert('pkg_id,checks_id',"$_REQUEST[pkg_id],$checks","package_items");

			if($isInsUp ){

				$success='Package Edited Successfully';

				}

		}

	}else{

			$error='Please select at least one check';

			}

	

}

function search($TABLE,$FIELDS){

	$SSTR='';

	global $action;

	if(isset($_REQUEST['search_str'])){

		if($_REQUEST['search_str']!=''){

				$FIELDS = explode(',',$FIELDS);

				foreach($FIELDS as $FIELD){

					$SSTR = (($SSTR!='')?"$SSTR OR ":'')." $FIELD LIKE '%$_REQUEST[search_str]%'";

				}

				if($SSTR!='') $SSTR = "AND ($SSTR)";

		}

	}	

	return $SSTR;

}



function create_pkg(){

		$db = new DB();

	$error='No';

	$cols='pk_name,pkg_type,user_id';

	$values="'$_POST[pname]',1,$_SESSION[user_id]";

	if($_POST['pname']!=''){

	$isInsUp = $db->insert($cols,$values,"packages");

	$insert_id=mysql_insert_id();

	if(is_array($_POST['checks'])){

	foreach($_POST['checks'] as $checks)

		{

			$isInsUp = $db->insert('pkg_id,checks_id',"$insert_id,$checks","package_items");

			

		}

		

	$_POST['pkg']=$insert_id;

		}else{

		//$error='Please select at least one check';

		 msg('err',"Please select at least one check!");	

		}

	}

	else{

		 // $error = "Please Insert Package name"; 

		  msg('err',"Please Insert Package name!");	

		}

	

}



function register_(){

		$db = new DB();
		
		// if applicant update profile
		if($_POST['ulevel'] == 'applicant') $_POST['ulevel']=5;

		if($_POST['passa'] != $_POST['passb']){

			msg('err',"You have to type the same password for control!");			

		}else{

			$_POST['email'] = addslashes($_POST['email']);

			

			if($_POST['fname'] == NULL) msg('err',"Please Enter First Name!");

			

			if($_POST['lname'] == NULL) msg('err',"Please Enter Last Name!");		

			

			if($_POST['ulevel'] == 4){

					if($_POST['com_id'] == NULL || $_POST['com_id'] == 0) msg('err',"Please Select Company!");

			}else{

				if($_POST['ulevel'] == NULL || $_POST['ulevel'] == 0 ) msg('err',"Please Select User Level!");

			}

			

			if(!validateEmail($_POST['email'])){

				msg('err',"Please Enter Valid Email!");

			}else{

				$_POST['email'] = addslashes($_POST['email']);

				if(!isset($_POST['uid'])){

					$userInfo = $db->select('users','user_id',"username='$_POST[email]'");	

					if(mysql_num_rows($userInfo) > 0) msg('err',"This email account is already registered!");					

				}

			}
			// if analyst (3) or team lead (12)
			if($_POST['ulevel'] == 12 || $_POST['ulevel'] == 3){

			if($_POST['kpi'] == NULL) msg('err',"Please Enter KPI Value!");
			
			if(!is_numeric($_POST['kpi'])) msg('err',"KPI value should be numeric !");
			
			}
			if($_POST['changepass']==1){
				
			if($_POST['passa'] == NULL) msg('err',"Please Enter Password!");
			
			}

			if($_POST['ulevel']== 0) msg('err',"Please Select User Level!");

									

			if($_REQUEST['ERR']==''){
				
				$salt = get_rand_val(8);

				$pass = md5(md5($_POST['passa']).md5($salt));
				
				if($_POST['changepass']==1){				
			
			$passField = "password,salt,";
			$passVal = "'$pass','$salt',";
			}else{
			$passField = "";
			$passVal = "";
			}

				$cols ="first_name,last_name,email,username, $passField level_id,kpi,puser_id,loc_id";

				if(isset($_POST['com_id'])) $cols ="$cols,com_id,u_type";
				if(isset($_POST['puser_id']) && $_POST['puser_id']!=0 ) $cols ="$cols,is_subuser ";
				
				
				
				
				

				$vals = "'$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[email]', $passVal $_POST[ulevel],'$_POST[kpi]','$_POST[puser_id]','$_POST[loc_id]'";

				if(isset($_POST['com_id'])) $vals ="$vals,$_POST[com_id],1";
				if(isset($_POST['puser_id']) && $_POST['puser_id']!=0 ) $vals ="$vals,1";

				if(isset($_POST['uid'])){

					$isRegister = $db->updateCol($cols,$vals,'users',"user_id=$_POST[uid]");

					$title="Edited";

				}else{

					$isRegister = $db->insert($cols,$vals,'users');

					$title="Registered";

				}

				if($isRegister){

					msg('sec',"User $title [ $_POST[fname] $_POST[lname] ] Successfully...");					

					return true;	

				}else{

					msg('err',"User $title [ $_POST[fname] $_POST[lname] ] Error!");					 

					return false;

				} 						 

			}

		} return false;	

}







function addsubuser_(){

		$db = new DB();

		if($_POST['passa'] != $_POST['passb']){

			msg('err',"You have to type the same password for control!");			

		}else{

			$_POST['email'] = addslashes($_POST['email']);

			

			if($_POST['fname'] == NULL) msg('err',"Please Enter First Name!");

			

			if($_POST['lname'] == NULL) msg('err',"Please Enter Last Name!");	

			if($_POST['country'] == NULL) msg('err',"Please Enter Country!");		

			

			

			if(!validateEmail($_POST['email'])){

				msg('err',"Please Enter Valid Email!");

			}else{

				$_POST['email'] = addslashes($_POST['email']);

				if(!isset($_POST['uid'])){

					$userInfo = $db->select('users','user_id',"username='$_POST[email]'");	

					if(mysql_num_rows($userInfo) > 0) msg('err',"This email account is already registered!");					

				}

			}

			

			if($_POST['passa'] == NULL){

				if(!isset($_POST['uid'])){

				 		msg('err',"Please Enter Password!");

				}

			}

					

			if($_REQUEST['ERR']==''){

				$cols ="country,first_name,last_name,email,username,level_id,is_subuser,no_rights,puser_id,com_id,u_type";

				if(isset($_POST['comid'])) $cols ="$cols,com_id";

				

				$salt = get_rand_val(8);

				$pass = md5(md5($_POST['passa']).md5($salt));

				

				if(isset($_POST['no_rights'])) $no_rights = implode('|',$_POST['no_rights']); else $no_rights='';

				$no_rights .= (($no_rights!='')?'|':'').'48';

				$comInfo = companyInfo($_SESSION['user_id']);

				$uID = $comInfo['id'];							

				$vals = "'$_POST[country]','$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[email]',4,1,'$no_rights',$_SESSION[user_id],$uID,1";

				if(isset($_POST['comid'])) $vals ="$vals,$_POST[comid]";

				if(isset($_POST['uid'])){

					if($_POST['passa'] != NULL){

						$cols ="$cols,password,salt";

						$vals = "$vals,'$pass','$salt'";

					}

					$isRegister = $db->updateCol($cols,$vals,'users',"user_id=$_POST[uid]");

					$title="Edited";

				}else{

					$cols ="$cols,password,salt";

					$vals = "$vals,'$pass','$salt'";

					$isRegister = $db->insert($cols,$vals,'users');

					$title="Registered";

				}

				if($isRegister){

					msg('sec',"User $title [ $_POST[fname] $_POST[lname] ] Successfully...!");					

					return true;	

				}else{

					msg('err',"User $title [ $_POST[fname] $_POST[lname] ] Error!");					 

					return false;

				} 						 

			}

		} return false;	

}





function enabdisb($tbl,$where,$msg=''){

		global $db;

		$data = $db->select($tbl,'is_active',$where);

		if(mysql_num_rows($data)>0){

			$data = mysql_fetch_assoc($data);

			if($data['is_active']==1){

				$tx = "Disabl";

				$uVal=0;

			}else{

				$tx = "Enabl";

				$uVal=1;

			}

			$isUpdate = $db->update("is_active=$uVal",$tbl,$where);

			if($isUpdate){

				msg('sec',$tx."ed $msg Successfully...");	

			}else{

				msg('err',$tx."ing $msg Error!");

			}

		}

}



function bindArray($dataAry,$c=0){

	$data= array();$row=0;

	if(is_array($c)){ $row=count($c); $data= $c; }

	if(mysql_num_rows($dataAry)>0){

		while($darys = mysql_fetch_assoc($dataAry)){

				foreach($darys as $key=>$m){

					$data[$row][$key] = $darys[$key];

				} $row=$row+1;

		} return $data;

	} if($c!=0) return $c; else return false;	

}



function shortLinks(){

	global $db; global $LEVEL; global $CPAGE; global $IPAGE;	

	$sLinkAry= array(); $cnt=0;

	$mLink = $db->select("menus2","*","m_id=$IPAGE[m_id]");

	if(mysql_num_rows($mLink)==1){

		$slAry = bindArray($mLink);

		if($slAry){

			$isP = $slAry[0]['m_pid'];

			while($isP!=0){

				$mLink = $db->select("menus2","*","m_id=$isP");

					$slAry = bindArray($mLink,$slAry);

				if(!$slAry) $isP=0;else $isP = $slAry[(count($slAry)-1)]['m_pid'];

				if($cnt>10) return false;

				$cnt=$cnt+1;

			} 

			$CPAGE=$slAry[(count($slAry)-1)]['m_id'];

		}

	}

	if($slAry){

		if(is_numeric($_REQUEST['_pid'])){

			$mLink = $db->select("menus2","*","m_id=$_REQUEST[_pid]");

			$slAry = bindArray($mLink,$slAry);

		}

	}

	return $slAry;

}





function addpage(){

	global $db;	

	$uID = $_SESSION['user_id'];

	if(is_numeric($_POST['pid'])){

		$dCunt=0;

	}else{

		$data= $db->select("menus2","*","m_action LIKE '$_POST[aname]' AND m_atype LIKE '$_POST[actyp]'");

		$dCunt = mysql_num_rows($data);

	}

	if(!is_numeric($_POST['search'])) $_POST['search']=0;

	if($dCunt==0){

	 $cols="s_id,m_action,m_atype,m_actitle,m_attitle,m_include,m_mdesc,m_mkeyw,m_img,m_lrb,m_pid,m_odr,user_id";

			$vals="$_POST[search],'$_POST[aname]','$_POST[actyp]','$_POST[atitl]','$_POST[ttitl]','$_POST[ifile]'";

			$vals="$vals,'$_POST[mdisc]','$_POST[mkeyw]','$_POST[m_img]',$_POST[doptn],$_POST[ppage],$_POST[dodr],$uID";

			if(is_numeric($_POST['pid'])){

				$isAddEdit = $db->updateCol($cols,$vals,'menus2',"m_id=$_POST[pid]");

				$title='Edit';

			}else{

				$isAddEdit = $db->insert($cols,$vals,'menus2');

				$title='Add';

			}

			if($isAddEdit){

				msg('sec',"Page [ $_POST[atitl] ] ".$title."ed Successfully...");					

				return true;	

			} 	msg('err',"Page [ $_POST[atitl] ] ".$title."ing Error !");

	}else{

		msg('err',"Page [ $_POST[atitl] ] is Already Added !");				

	} return false;

}



function addsearch(){

	global $db;	

	$uID = $_SESSION['user_id'];

	if(is_numeric($_POST['s_id'])){

		$dCunt=0;

	}else{

		$data= $db->select("search","*","s_table LIKE '$_POST[s_table]' AND s_fields LIKE '$_POST[s_fields]'");

		$dCunt = mysql_num_rows($data);

	}

	if($dCunt==0){

			$cols="s_table,s_fields,s_title";

			$vals="'$_POST[s_table]','$_POST[s_fields]','$_POST[s_title]'";

			if(is_numeric($_POST['s_id'])){

				$isAddEdit = $db->updateCol($cols,$vals,'search',"s_id=$_POST[s_id]");

				$title='Edit';

			}else{

				$isAddEdit = $db->insert($cols,$vals,'search');

				$title='Add';

			}

			if($isAddEdit){

				msg('sec',"Page [ $_POST[s_table] ] ".$title."ed Successfully...");					

				return true;	

			} 	msg('err',"Page [ $_POST[s_table] ] ".$title."ing Error !");

	}else{

		msg('err',"Page [ $_POST[s_table] ] is Already Added !");				

	} return false;

}





function adUpRights(){

	global $db;

	$ids = explode('|',$_REQUEST['right']);

	if(is_numeric($ids[0]) && is_numeric($ids[1])){

		$data= $db->select("access2","level_id","level_id=$ids[1] AND m_id=$ids[0]");

		if(mysql_num_rows($data)==0){

			$cols="level_id,m_id";

			$vals="$ids[1],$ids[0]";

			$isAddEdit = $db->insert($cols,$vals,'access2');

			$title='Add';

		}else{

			$isAddEdit = $db->delete('access2',"level_id=$ids[1] AND m_id=$ids[0]");

			$title='Delet';	

		}

		

		if($isAddEdit){

			msg('sec',"Right ".$title."ed Successfully...");

		}else{

			msg('err',"Right ".$title."ing Error !");

		}		

	}

}



function getRrights(){

	global $LEVEL;global $USER;

	//$rrights= array(26);

	$ewhere='';

	if($LEVEL==4){

		if($USER['is_subuser']==1){

			$USER['no_rights']= str_replace('|',',',$USER['no_rights']);

			//$surght = $db->select("subuser_rights","m_id","sr_id IN($USER[no_rights]) AND m_id<>0");

			$ewhere = "AND mn.m_id NOT IN($USER[no_rights])";

		}	

	}	

	return $ewhere;

}



function getSubMenus($id){

	global $db; global $LEVEL;

	$aMenu= array();$row=0;	

	global $USERID;

	 

	 

	$tbl="menus2 mn INNER JOIN access2 ac ON mn.m_id=ac.m_id";

	$where="(ac.level_id=$LEVEL OR ac.user_id=$USERID) AND mn.m_lrb<>-1 AND mn.m_pid=$id";

	$menues = $db->select($tbl,"DISTINCT *","$where ORDER BY mn.m_odr ASC");

	if(mysql_num_rows($menues)>0){

		return $menues;

	}

	return false;

}



function getMenus(){

	global $db; global $LEVEL;

	global $USERID;

	$aMenu= array();$row=0;

	$tbl="menus2 mn INNER JOIN access2 ac ON mn.m_id=ac.m_id";

	$where="(ac.level_id=$LEVEL OR ac.user_id=$USERID) AND mn.m_lrb<>-1 AND mn.m_pid=0";

	$menues = $db->select($tbl,"DISTINCT *","$where ORDER BY mn.m_odr ASC");

	return bindArray($menues);

}



function getPage(){

	global $db;

	global $ACTION; global $ATYPE; global $LEVEL;

	global $USERID;

	

	$tbl="menus2 mn INNER JOIN access2 ac ON mn.m_id=ac.m_id";

	$where= "m_action='$ACTION' AND (m_atype='$ATYPE' OR m_atype IS NULL) AND (ac.level_id=$LEVEL OR ac.user_id=$USERID) $ewhere";	
	//echo "select DISTINCT * from $tbl where $where";
	$iPage = $db->select($tbl,"DISTINCT *",$where);

	if(mysql_num_rows($iPage)>0){

		$iPage = mysql_fetch_assoc($iPage);

		if(file_exists("include_pages/$iPage[m_include]")) return $iPage;

	} return false;

}



function getSrch($sID){

	if(is_numeric($sID)){ 

		global $db;

		$tbl = "search sr INNER JOIN menus2 mn ON sr.s_id=mn.s_id";

		$cls = "mn.m_action,mn.m_atype,sr.s_fields,sr.s_title";

		$iSrch = $db->select($tbl,$cls,"sr.s_id=$sID");

		if(mysql_num_rows($iSrch)>0) return mysql_fetch_assoc($iSrch);

	} return false;

}



function subArchive(){

	$db = new DB();

	if(isset($_POST['acase'])){

		foreach($_POST['acase'] as $case){

			if(is_numeric($case)){

				$isUpdate = $db->update("v_archvi=1","ver_data","v_id=$case");

			}

		}

	}else{

		msg('err',"Please Select Any Case to Archived!");

			

	}

}



function ordCertif(){

	$db = new DB();

	if(isset($_POST['acase'])){

		foreach($_POST['acase'] as $case){

			if(is_numeric($case)){

				$isUpdate = $db->update("is_certif=1","ver_data","v_id=$case");

			}

		}

		msg('sec',"Certificate Ordered Succefully...");

	}else{

		msg('err',"Please Select Any Case to Order Certificate!");

			

	}

}

			

function bcplcode($num){

	for($ind=strlen($num);$ind<5;$ind++){

		$num = '0'.$num;

	}

	return 'BCPL-'.$num;

}


function orderCode($comID){

		global $db;
		if(is_numeric($comID)){
			$sname = $db->select("company","id","id=$comID");
			$sname = mysql_fetch_assoc($sname);
			$sname = $sname['id'];
			if(strlen($sname)==1) $sname = "0$sname";
			$orders = $db->select("ver_data","COUNT(v_id) cnt","com_id=$comID AND  YEAR(v_date)=YEAR(CURDATE())");
			$orders = mysql_fetch_assoc($orders);
			$cnt = ($orders['cnt']==0)?1:$orders['cnt']+1;		

			if($cnt<100){
				if($cnt<10) $cnt = (string)"00$cnt"; else $cnt = (string)"0$cnt";
			}

			return "$sname".date("my")."$cnt";

		}
}

function cBCode($comID,$prj,$vID='',$cID=''){

		global $db;

		if(is_numeric($vID) && is_numeric($cID)){

			$cBcode = $db->select("ver_data","v_bcode","v_id=$vID");

			$cBcode = mysql_fetch_assoc($cBcode);

			$cBcode = $cBcode['v_bcode'];

			

			$CName = $db->select("checks","checks_sname","checks_id=$cID");

			$CName = mysql_fetch_assoc($CName);	

			$CName = $CName['checks_sname'];			

			

			$cnt = $db->select("ver_checks","COUNT(as_id) cnt","checks_id=$cID AND v_id=$vID");
			
			$cnt = mysql_fetch_assoc($cnt);

			$cnt = ($cnt['cnt']==0)?1:$cnt['cnt']+1;

			

			if($cnt<100){

				if($cnt<10) $cnt = (string)"00$cnt"; else $cnt = (string)"0$cnt";

			}
			return "$cBcode-"."$CName".$cnt;

		}

		

		$comSname = $db->select("company","sname","id=$comID");

		$comSname = mysql_fetch_assoc($comSname);

		$comSname = $comSname['sname'];

		$sDate = date("Y-m",time());

		$cnt = $db->select("ver_data","COUNT(com_id) cnt","com_id=$comID AND v_date LIKE '$sDate%'");

		$cnt = mysql_fetch_assoc($cnt);

		$cnt = ($cnt['cnt']==0)?1:$cnt['cnt'];

		if($cnt<100){

			if($cnt<10) $cnt = (string)"00$cnt"; else $cnt = (string)"0$cnt";

		}
		
		return "$comSname$prj-".date("my",strtotime($sDate))."-$cnt";	

}

	

function result_link($out){

    $pr = array('">', '<img', '"', ',', ';', ')');

    $pa = array('', '', '', '', '', '');

    foreach ($out as $out){

        foreach ($out as $out){

            if ($out == 'http://'){

            }else{

                $a[] = str_replace($pr, $pa, $out);

            }

        }

    }

    if (is_array($a)){

        return array_unique($a);

    }

}



function get_filter_link($a, $text){

    foreach ($a as $b){

        $ree = array("<br>", "<Br>", "<Br />", " ");

        $url = str_replace($ree, "", $b);

        if ($url == 'http://' or $url == 'https://' or $url == 'www.'){

        }else{

            if (strlen($b) > 55)

                $b = substr($b, 0, 55) . "...";

            $olda = "#((https?://)[^\s]+)#i";

            if (preg_match($olda, $url)){

                $text = str_replace($url, "<a href=\"$url\" target=\"_blank\" title=\"$url\">$b</a>", $text);

            }else{

                $text = str_replace($url, "<a href=\"http://$url\" target=\"_blank\" title=\"$url\">$b</a>", $text);

            }

        }

    }

    return $text;

}



function change_url_in_text($text){

    if(validateEmail($text)){

		return '<a href="mailto:'.$text.'">'.$text.'</a>';

	}

	

	if (preg_match("/href=/i", $text)){

        return $text;

    }else{

        $old = "#((https?://|www.)[^\s]+)#i";

        if (preg_match($old, $text)){

            preg_match_all($old, $text, $out);

            $a = result_link($out);

            return get_filter_link($a, $text);

        }else{

            return $text;

        }

    }

}



function notifiMsgs($verCheck){

	global $LEVEL;

	$csSts = strtolower($verCheck['as_status']);

	if($LEVEL==2){

		switch($csSts){

			case'close':

				$eNot=($verCheck['as_adcls']==1)?(($verCheck['as_sent']==4)?'Sent':'Ready for Send'):"Ready for Remark";

				return "-".$eNot;

			default:

				return "-".$verCheck['as_vstatus'];

		}

	}

	return '';

}



function addUnie(){

	$db = new DB();
 
	$uID = $_SESSION['user_id'];
	if(!is_numeric($_POST['ufee'])) msg('err',"Please input valid fee amount!");
	$rgn = htmlspecialchars(trim($_REQUEST['rgn']));

	$cty = htmlspecialchars(trim($_REQUEST['cty']));

	$uni = htmlspecialchars(trim($_REQUEST['uni']));
	
	$beneficiary = htmlspecialchars(trim($_REQUEST['beneficiary']));

	$url = trim($_REQUEST['url']);

	$uni_req = trim($_REQUEST['uni_req']);

	$letter_to_add = trim($_REQUEST['letter_to_add']);


	$vendor = htmlspecialchars(trim($_REQUEST['vendor']));
	$charges = is_numeric(trim($_REQUEST['charges']))?trim($_REQUEST['charges']):0;
	
	$acd = trim($_REQUEST['acd']);
	$ddreq = (isset($_REQUEST['ddreq']))?1:0;
	$nfee = (isset($_REQUEST['nfee']))?1:0;
	
	$inf = htmlspecialchars(trim($_REQUEST['inf']));	
	if(is_numeric($_POST['ufee'])){
	if(!isset($_REQUEST['id'])){

		$values = "'$beneficiary',$_POST[ufee],'$rgn','$cty','$uni','$url','$acd','$inf',$uID,CURRENT_TIMESTAMP,'$vendor',$charges,$ddreq,$nfee,'$uni_req','$letter_to_add'";	
 
		$cols="uni_ben,uni_fee,uni_region,uni_city,uni_Name,uni_url,uni_ac_url,uni_var,uni_uadd,uni_addate,uni_vendor,uni_vchar,uni_ddr,uni_nfe,uni_req,letter_to_add";

		$uniInfo = $db->select("uni_info","uni_id,uni_Name","uni_Name LIKE '$uni'");		
		
		
		if(mysql_num_rows($uniInfo) == 0){

			$isInsUp = $db->insert($cols,$values,"uni_info");	
			
			if($isInsUp){

				addActivity('uni',"$uni",$LEVEL,'','',$db->insertedID,'add');

				msg('sec',"Inseted Successfully  [ $uni ]...");

			}else{

				msg('err',"Insertion Error  [ $uni ]!");

			}

		}else{

			msg('err',"$uni is already there");

			$uniInfo = mysql_fetch_array($uniInfo);

			$_REQUEST['id']	= $uniInfo['uni_id'];

		}		

	}else{

		if($uni!=''){

			$id = $_REQUEST['id'];

			$values ="uni_ben='$beneficiary',uni_fee=$_POST[ufee],uni_region='$rgn',uni_city='$cty',uni_Name='$uni',";

			$values .="uni_url='$url',uni_ac_url='$acd',uni_var='$inf',";
			
			$values .="uni_vendor='$vendor',uni_vchar=$charges,uni_ddr=$ddreq,uni_nfe=$nfee,uni_req='$uni_req',letter_to_add='$letter_to_add'";

			$isUpdate = $db->update($values,"uni_info","uni_id=$id");

			if($isUpdate){

				addActivity('uni',"$uni",$LEVEL,'','',$id,'edit');

				msg('sec',"Updated Successfully  [ $uni ]...");	

			}else{

				msg('err',"Updatation Error [ $uni ]!");	

			}

		}else{

				msg('err',"Please Input/Select Required Fields!");	

		}

	}
	}

}



function removeOpenCs(){

	if(isset($_REQUEST['opencasck']) || isset($_REQUEST['delecasck'])){

		global $LEVEL;$db = new DB();
		$uid = $_SESSION['user_id'];
		if(isset($_REQUEST['delecasck'])) $atype="Remov"; else $atype="Open";

		if(isset($_REQUEST['vchecks'])){

			foreach($_REQUEST['vchecks'] as $vcheck){

				$vCheck = getCheck(0,0,$vcheck);

				$vData  = getVerdata($vCheck['v_id']);

				$tCheck = getCheck($vCheck['checks_id'],0,0);

				if(isset($_REQUEST['delecasck'])){

					$uCols="as_isdlt=1";
					
					
				}else{

					$uCols="as_status='Open',as_sent=0,as_adcls=0,as_cdnld=0";

				}

				$isUpdate = $db->update($uCols,"ver_checks","as_id=$vcheck");

				if($isUpdate){
					
					if(isset($_REQUEST['delecasck'])){

					$db->insert("as_id,deleted_by","$vcheck,$uid","deleted_cases_check_logs");
					if(is_numeric($vCheck['bitrixtid']) && $vCheck['bitrixtid']!=0){
					task_del($vCheck['bitrixtid']);
					}
					
				}else{

					$db->update("v_rlevel='N/A',v_status='Open',v_sent=0,v_cdnld=0","ver_data","v_id=$vCheck[v_id]");
					//$db->insert("v_id,opened_by","$vCheck[v_id],$uid","reopened_cases_check_logs");

				}

					addActivity('check',"",$LEVEL,'',$vCheck['v_id'],$vcheck,$atype.'ed');

					 msg('sec',"$tCheck[checks_title] ".$atype."ed Successfully...");

				}else{

					 msg('err',"$tCheck[checks_title] ".$atype."ing Error!");

				}

			}

		}elseif(isset($_REQUEST['record'])){ 

			foreach($_REQUEST['record'] as $term){

				$vData  = getVerdata($term);

				$uInfo = getUserInfo($uID);	

				if(isset($_REQUEST['delecasck'])){

					$uCols="v_isdlt=1";

				}else{

					$uCols="v_rlevel='N/A',v_status='Open',v_sent=0,v_mdnld=0,v_cdnld=0";

				}							

				$isUpdate = $db->update($uCols,"ver_data","v_id=$term");

				if($isUpdate){
					
					
					if(isset($_REQUEST['delecasck'])){

					$db->insert("v_id,deleted_by","'$vCheck[v_id]','$uid'","deleted_cases_check_logs");
					
					}

					addActivity('case',"",$LEVEL,'',$term,'',$atype.'ed');

					msg('sec',"$vData[v_name] ".$atype."ed Successfully ...");

				}else{

					msg('err',"$vData[v_name] ".$atype."ing Error!");

				}

			}

		}else{

			 msg('err',"Please Checkout any Case / Check to $atype");

		}	

	}

}


// assignChecks
function assignChecks(){

	$uID  = $_REQUEST['uid']; global $LEVEL;

	$db = new DB();

	if($uID!='0'){

		if(isset($_REQUEST['rassigncases'])){

			$uWhere="";

			$acTp ='reassign';

		}else{

			$uWhere="AND ISNULL(user_id)";

			$acTp ='assign';

		}

		

		if(isset($_REQUEST['vchecks'])){

			foreach($_REQUEST['vchecks'] as $vcheck){

				$vCheck = getCheck(0,0,$vcheck);

				$vData  = getVerdata($vCheck['v_id']);

				$tCheck = getCheck($vCheck['checks_id'],0,0);

				$uInfo  = getUserInfo($uID);

				$uCols="user_id=$uID,as_status='Open',as_date=CURRENT_TIMESTAMP,as_pdate=CURRENT_TIMESTAMP";

				$isUpdate = $db->update($uCols,"ver_checks","as_id=$vcheck $uWhere");

				if($isUpdate){

					addActivity('check',"$vData[v_name] Assigned to [ $uInfo[first_name] ]",$LEVEL,'',$vCheck['v_id'],$vcheck,$acTp);

					$isUpdate = $db->update("v_status='Open'","ver_data","v_id=$vCheck[v_id]");

					 msg('sec',"$tCheck[checks_title] on $vData[v_name] Assigned to [ $uInfo[first_name] ] Successfully ...");

				}else{

					msg('err',"$tCheck[checks_title] on $vData[v_name] Assigning Error! to [ $uInfo[first_name] ]");

				}

			}

		}else if(isset($_REQUEST['record'])){ 

			foreach($_REQUEST['record'] as $term){

				$vData  = getVerdata($term);

				$uInfo = getUserInfo($uID);				

				$isUpdate = $db->update("user_id=$uID,as_status='Open',as_date=CURRENT_TIMESTAMP","ver_checks","v_id=$term $uWhere");

				if($isUpdate){

					addActivity('case',"$vData[v_name] Assigned to [ $uInfo[first_name] ]",$LEVEL,'',$term,'',$acTp);

					$isUpdate = $db->update("v_status='Open'","ver_data","v_id=$term");

					msg('sec',"Check(s) on $vData[v_name] Assigned to [ $uInfo[first_name] ] Successfully ...");

				}else{

					msg('err',"Check(s) on $vData[v_name] Assigning Error! to [ $uInfo[first_name] ]");

				}

			}

			

		}else{

			 msg('err',"Please Checkout Any Case to Assign");

			 

		}

	}else{

		 msg('err',"Please Select Any User to Assign Case(s)");

		 

	}

}



/* function vs_Status($vStatus){

		switch($vStatus){

			case 'verified':

			case 'satisfactory':

			case 'no match found':

			case 'no record found':

			case 'positive match found':

				$vSts = 'Green';	

			break;

			case 'negative':

			case 'match found':

			case 'record found':

			case 'unsatisfactory':

				$vSts = 'Red';

			break;

			case 'insufficient':					

				$vSts = 'Yellow';	

			break;

			case 'unable to verify':

			case 'discrepancy':

			case 'original required':

				$vSts = 'Amber';

			break;							

		}	

		return $vSts;

}

 */
 
 
  // added by khl
 
 
 function vs_Status($vStatus,$v_id=0){
	global $db;
	
		switch($vStatus){

			case 'verified':
			case 'satisfactory':
			case 'no match found':
			case 'no record found':
			case 'positive match found':
			

				$vSts = 'Green';	

			break;

			case 'negative':
			case 'match found':
			case 'record found':
			case 'unsatisfactory':
			case 'negative match found':
					
				$vSts = 'Red';

			break;

			case 'insufficient':					

				$vSts = 'Yellow';	

			break;

			case 'discrepancy':
			case 'processed but cancelled by client':
			case 'objection by source':
			case 'addition information not provided by client':

				$vSts = 'Amber';

			break;	

			case 'partially verified':
			case 'unable to verify':
			case 'original required':
			case 'not verified by source':

				$vSts = '';

			break;		

		}	
		if($v_id!=0){
		return getRiskLevel($v_id);
		}else{
		return $vSts;
		}

}
	// by khl
	function getColorClass($clr=''){
		$clr = ($clr=='')?'grey':$clr;
		
	switch(strtolower($clr)){
		case 'red':
		$cls = 'bg-red';
		break;
		case 'green':
		$cls = 'bg-success';
		break;
		case 'amber':
		case 'yellow':
		$cls = 'bg-yellow';
		break;
		case 'grey':
		$cls = 'bg-grey-300';
		break;
		
		default:
		$cls = 'bg-grey-300';
		break;
	
		
	}
	return $cls;
	}
	
 function get_v_rlevel_FromVID($v_id=0){
	global $db;
	$vsst = array();
	$Green = array('verified','satisfactory','no match found','no record found');
	$Red = array('negative','match found','record found','unsatisfactory','positive match found');
	$Amber = array('discrepancy','processed but cancelled by client','objection by source','addition information not provided by client');
	$nocolor = array('partially verified','unable to verify','original required','not verified by source');
	$Yellow = array('insufficient');
	
	 if($v_id!=0){
		$sel = $db->select("ver_checks","as_vstatus"," v_id=$v_id AND as_status='Close' AND as_isdlt=0");
		
		while($res = @mysql_fetch_assoc($sel)){
			$vsst[] = strtolower($res['as_vstatus']);
		
		}
		
		
		foreach($Red as $rd){
		if(in_array($rd,$vsst)){
			return ucwords($rd);
		}	
		}
		
		foreach($Amber as $amb){
		if(in_array($amb,$vsst)){
			return ucwords($amb);
		}	
		}
		
		foreach($nocolor as $noco){
		if(in_array($noco,$vsst)){
			return ucwords($noco);
		}	
		}
		
		foreach($Yellow as $Yel){
		if(in_array($Yel,$vsst)){
			return ucwords($Yel);
		}	
		}
		
		foreach($Green as $gr){
		if(in_array($gr,$vsst)){
			return ucwords($gr);
		}	
		}
		
	}else{
		
		return false;
	}
		

}


function getRiskLevel($v_id){
	global $db;
	 if($v_id!=0){
		$sel = $db->select("ver_checks","as_vstatus"," v_id=$v_id AND as_status='Close' AND as_isdlt=0");
		$vsst = array();
		while($res = @mysql_fetch_assoc($sel)){
			$vsst[] = vs_Status(strtolower($res['as_vstatus']));
		}
				
		if(in_array('Red',$vsst)){
			return 'Red';
		}else if(in_array('Amber',$vsst)){
			return 'Amber';
		}else if(in_array('Green',$vsst)){
			return 'Green';
		}else{
			return '';
		}
	}
 }


function countChecks($where='',$lvl=true,$page="",$order_by=""){

	$db = new DB();

	global $LEVEL, $ATYPE;
	$order_by = ($order_by!='')?$order_by:'';
	
	if($LEVEL==4){

		global $COMINF;

		$where.=(($where!='')?' AND ':'')."vd.com_id=$COMINF[id]";
		$uids = getUseridsLocation();
		if(!empty($uids)){
		$where = " $where AND vd.v_uadd IN (".implode(",",$uids).") ";	
		}
		

	}else if($LEVEL==3 ){

		if($page!='assign'){

			$where.=(($where!='')?' AND ':'')."vc.user_id=$_SESSION[user_id]";

		}

	}

	if($_SESSION['user_id']==83){

		$where.=(($where!='')?' AND ':'')."vd.com_id=20";

	}	

	if($where=='') $where=" vc.as_isdlt=0 AND vd.v_isdlt=0 "; else $where=" $where AND vc.as_isdlt=0 AND vd.v_isdlt=0 ";

	$cCnt = $db->select("ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id","COUNT(DISTINCT vc.as_id) cnt",$where);
	if($order_by=='case_wise'){
	$cCnt = $db->select("ver_data","COUNT(v_id) cnt"," v_isdlt=0 AND blank_case=1 AND checks_added=0 AND com_id NOT IN (20,81,82,92) ");	
	}
	
	//echo 'select COUNT(DISTINCT vc.as_id) cnt from ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id where '.$where;
	if($cCnt && mysql_num_rows($cCnt)>0){
		$cCnt = mysql_fetch_array($cCnt);
	}else{
		$cCnt['cnt'] = 0;	
	}
//echo "SELECT COUNT(DISTINCT vc.as_id) cnt FROM ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id where $where ";
	return $cCnt['cnt'];

}


function countSavvionChecks($where=''){

	$db = new DB();

	global $LEVEL, $ATYPE;
	if($LEVEL == 10 || $LEVEL == 3){
	$where .=(($where!='')?' AND ':'')." user_id=$_SESSION[user_id]";
	
	}
	if($LEVEL == 13){
	$where .=(($where!='')?' AND ':'')." team_lead_id=$_SESSION[user_id]";
	
	}
	
	$cCnt = $db->select("savvion_check","COUNT(*) as cnt"," $where ORDER BY id DESC");

	
	
	//echo 'select COUNT(*) as cnt from savvion_check   where '.$where;
	if($cCnt && mysql_num_rows($cCnt)>0){
		$cCnt = mysql_fetch_array($cCnt);
	}else{
		$cCnt['cnt'] = 0;	
	}
//echo "SELECT COUNT(DISTINCT vc.as_id) cnt FROM ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id $where ";
	return $cCnt['cnt'];

}


function countCases($where='',$lvl=true,$atype=''){

	$db = new DB();

	global $LEVEL;

	if($atype=='ddrequest'){
		return count_pending_dd();
	}
	
	if($LEVEL==4){

		global $COMINF;

		$where.=(($where!='')?' AND ':'')."vd.com_id=$COMINF[id]";
		$uids = getUseridsLocation();
		if(!empty($uids)){
		$where = " $where AND vd.v_uadd IN (".implode(",",$uids).") ";	
		}

	}else if($LEVEL==3){

		$where.=(($where!='')?' AND ':'')."vc.user_id=$_SESSION[user_id]";

	}

	

	if($_SESSION['user_id']==83){

		$where.=(($where!='')?' AND ':'')."vd.com_id=20";

	}

		

	if($where=='') $where="vd.v_isdlt=0"; else $where="$where AND vd.v_isdlt=0";

	$qCnt = $db->select("ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id","COUNT(DISTINCT vd.v_id) cnt",$where);

	//echo $db->query;

	$qCnt = mysql_fetch_array($qCnt);

	return $qCnt['cnt'];

}



function checkQuote($where){

	$db = new DB();

	$cCnt = $db->select("quotes","COUNT(qt_id) cnt",$where);

	$cCnt = mysql_fetch_array($cCnt);

	return $cCnt['cnt'];

}



function froofLbl($nos){

	switch($nos){

		case 0:

			return 'a';	

		case 1:

			return 'b';

		case 2:

			return 'c';

		case 3:

			return 'd';

		case 4:

			return 'e';

		case 5:

			return 'f';

		case 6:

			return 'g';																		

	}	

}





function addQPrice(){

	if(is_numeric($_REQUEST['price'])){

		$db = new DB();

		$isIncUp = $db->update("qt_price=$_REQUEST[price],qt_sent=1","quotes","qt_id=$_REQUEST[qId]");

		if($isIncUp){

			echo msg('sec',"Ouote price submitted Successfully...");

		}else{

			echo msg('err',"Ouote price submittion Error!");	

		}

	}else{

		echo msg('err',"Invalid price, please input number only !");	

	}	

}





function subPackage(){

	$db = new DB();

	$comInfo = companyInfo($_SESSION['user_id']);

	$uID = $comInfo['id'];

	$values= "$_REQUEST[screening],$uID";

	$isIncUp = $db->insert("sc_id,com_id",$values,"quotes");

	$qID = $db->insertedID;

	if($isIncUp){

		foreach($_REQUEST['checks'] as $check){

			if(is_numeric($check)){

				$values = "$check,$qID";

				$isIncUp = $db->insert("checks_id,qt_id",$values,"qt_maping");

				$cInf = getCheck($check);

				if($isIncUp){

					echo msg('sec',"Check[ $cInf[checks_title] ] added Successfully...");

				}else{

					echo msg('err',"Check[ $cInf[checks_title] ] added Error!");

				}

			}

		}

	}

	return $isIncUp;

}





function browserInf(){

	$browser = strtolower($_SERVER['HTTP_USER_AGENT']);

	if(strpos($browser,'firefox') !== false) define('BR','FF');

	if(strpos($browser,'safari') !== false) define('BR','SF');

	if(strpos($browser,'chrome') !== false) define('BR','GC');

	if(strpos($browser,'msie') !== false){

		$brInfo = explode(';',$browser);

		foreach($brInfo as $inf){

			$inf = trim($inf);

			if(strpos($inf,'msie') !== false){

					$vr = explode(' ',$inf);

					define('VRT',$vr[1]);

					$vr  = (int)$vr[1];

					define('VR',$vr);

			}

		}

		define('BR','IE');

	} 

	if(strpos($browser,'opera') !== false) define('BR','OP');

	return BR;	

}

function addreply(){

	$db = new DB();
	global $LEVEL,$COMINF;

	$_REQUEST['reply'] = ($_REQUEST['reply']);
	$_REQUEST['typ'] = ($_REQUEST['typ']);	
	$levelInfo = getLevel($LEVEL);
	$comnts = $db->select("comments","com_id","_id=$_REQUEST[comID] AND com_text LIKE '$_REQUEST[reply]'");

	if(mysql_num_rows($comnts)==0){
		
		if(is_numeric($_REQUEST['comID'])){ 
		if($LEVEL==4){
		$Pcomments = getInfo("comments","com_id=$_REQUEST[comID]");
		}else{
		$Pcomments = getInfo("comments","p_id=$_REQUEST[comID] AND user_id!=$_SESSION[user_id]");	
		}
		$Puser_id = $Pcomments['user_id'];
		if(is_numeric($Puser_id)){
		$PuserInfo = getInfo("users","user_id=$Puser_id");
		}
		}

		$uID = $_SESSION['user_id']; 
		$com_typ = (isset($_REQUEST['typ']))?",'$_REQUEST[typ]'":"";
		$com_typ_col = (isset($_REQUEST['typ']))?",com_type":"";
		$cols = "p_id,com_text,user_id".$com_typ_col;

		$vals = "$_REQUEST[comID],'$_REQUEST[reply]',$uID".$com_typ;

		$isInc = $db->insert($cols,$vals,'comments');

		if($isInc){
			
			if($LEVEL==4){
			$a_info = "New comments received from $_SESSION[first_name] $_SESSION[last_name] Client: $COMINF[name] ";
			createNotifications(4,$a_info,'',$Puser_id,$PuserInfo['email']);
			}else{
			$a_info = "New comments sent by $_SESSION[first_name] $_SESSION[last_name] (".$levelInfo['level_name'].") ";	
			createNotifications($LEVEL,$a_info,'',$Puser_id,$PuserInfo['email']);
			}
			
			

			msg('sec',"Reply inserted Successfully...");

			

		}else{

			msg('err',"Reply insertion Error!");

			

		}	

	}

}





function addProject(){

	$db = new DB();

	if(is_numeric($_REQUEST['com_id'])){

		if(trim($_REQUEST['prname'])!=''){	

				$pCnts = $db->select("projects","COUNT(com_id) cnt","com_id=$_REQUEST[com_id]");

				$pCnts = mysql_fetch_assoc($pCnts);

				$pCnts = $pCnts['cnt']+1;

				if($pCnts<10) $pCnts = (string)"0$pCnts"; else $pCnts = (string)"$pCnts";				

				$project = $db->select("projects","com_id","com_id=$_REQUEST[com_id] AND pro_name='$_REQUEST[prname]'");

				if(mysql_num_rows($project)==0){

					$cols   ="com_id,pro_lid,pro_name,pro_cperson,pro_contact,pro_panlst,pro_sanlst,pro_note";

					$values = "$_REQUEST[com_id],'$pCnts','$_REQUEST[prname]','$_REQUEST[poname]','$_REQUEST[pocont]'";

					$values = "$values,'$_REQUEST[priran]','$_REQUEST[secran]','$_REQUEST[notes]'";

					$isIncUp = $db->insert($cols,$values,"projects");

					if($isIncUp){		

						msg('sec',"Projects [$_REQUEST[prname]] Added Successfully...");

						

						return true;			

					}else{

						msg('err',"Projects Adding Error!");

									

						return false;

					}					

				}else{

					msg('err',"Projects [$_REQUEST[prname]] is Already Added...");

						

					return false;			

				}	

		}

	}else{

		msg('err',"Please Select Company Name!");

				

	}

}



function add_client_checks($clid){
	$db = new DB();
	if($clid == 96)
	{
		
		$comInfo = getcompany($clid);
		$comInfox = @mysql_fetch_array($comInfo);
		$user_id = $_SESSION['user_id'];
		$user_info2 = getUserInfo($user_id);
		$fullName = $user_info2['first_name']." ".$user_info2['last_name'];
	
		
 	if(isset($_POST['checks']) && is_array($_POST['checks'])){
		
 			$record1 = $db->select("clients_checks","*","com_id=$clid");
			//if(mysql_num_rows($record1)>0){
				$clients_checks = mysql_num_rows($record1);
			// for agreement modification
	if($clients_checks > 0)
	{
        $db->update("clt_active=0","clients_checks","com_id=$clid");
 		foreach($_POST['checks'] as $key=>$check){
		$cost = trim($_POST["cost$check"]);
		$units = trim($_POST["units$check"]);
		$clt_currency = trim(strtoupper($_POST["clt_currency$check"]));
		
		if(is_numeric($check)){
			if(!is_numeric($cost)) $cost=0;
			if(!is_numeric($units)) $units=1;
			
			$record = $db->select("clients_checks","*","com_id=$clid AND checks_id=$check");
			if(mysql_num_rows($record)>0){
				$db->update("clt_active=1,clt_cost=$cost,clt_currency='$clt_currency',clt_units=$units","clients_checks","com_id=$clid AND checks_id=$check");
				
			}else{
				$db->insert("clt_cost,clt_currency,com_id,checks_id,clt_units","$cost,'$clt_currency',$clid,$check,$units","clients_checks");
				
			}
		}
	}
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
		 emailTmp($table,'Modifications/ Amendments In Agreement',"atta@xcluesiv.com","","","","",$comInfox['name'],"");
 		  		$table2 = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
 					<tr>
						 '.$comInfox['name'].' agreement modified by '.$fullName.'.
 					</tr> 
 					</tbody>
				</table>';
 		  emailTmp($table2,'Modifications/ Amendments In Agreement',"atta@xcluesiv.com","","","","","Operation","");

 	
	
	// edit mood end here
	}	
	else
	{
	 // add mood start here

		$qoutation_num = generateRandomString(8);

 		foreach($_POST['checks'] as $key=>$check){
		$cost = trim($_POST["cost$check"]);
		$units = trim($_POST["units$check"]);
		$clt_currency = trim(strtoupper($_POST["clt_currency$check"]));
		
		if(is_numeric($check)){
			if(!is_numeric($cost)) $cost=0;
			if(!is_numeric($units)) $units=1;
			
			 
				 $db->insert("user_id,clt_cost,clt_currency,com_id,checks_id,clt_units,is_expired,qoutation_num","$user_id,$cost,'$clt_currency',$clid,$check,$units,'0','$qoutation_num'","client_agreement");
				
			 
		}
 		}
 		 // $db->insert("comps_id,is_send,agr_poc,agr_poc2,agr_receiver,agr_status,add_date,send_date,sender_ip,qoutation_num","'$clid','0','','','','0','','','','$qoutation_num'","client_agreement_confg");



$table2 = '<table>
		 	<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
 					<tr>
						Checks added against '.$comInfox['name'].' by '.$fullName.'. Please review and send agreement to '.$comInfox['name'].'.
 					</tr> 
 					</tbody>
				</table>';
 				 
		  emailTmp($table2,'Client ('.$comInfox['name'].') Added, Review and send agreement',"atta@xcluesiv.com","","","","","Operation","");


	}	
	
 	

 	
 
	
	}
 	}
	else
	{
	$db->update("clt_active=0","clients_checks","com_id=$clid");
	
	if(isset($_POST['checks']) && is_array($_POST['checks'])){
		foreach($_POST['checks'] as $key=>$check){
		$cost = trim($_POST["cost$check"]);
		$units = trim($_POST["units$check"]);
		$clt_currency = trim(strtoupper($_POST["clt_currency$check"]));
		
		if(is_numeric($check)){
			if(!is_numeric($cost)) $cost=0;
			if(!is_numeric($units)) $units=1;
			
			$record = $db->select("clients_checks","*","com_id=$clid AND checks_id=$check");
			if(mysql_num_rows($record)>0){
				$db->update("clt_active=1,clt_cost=$cost,clt_currency='$clt_currency',clt_units=$units","clients_checks","com_id=$clid AND checks_id=$check");
				
			}else{
				$db->insert("clt_cost,clt_currency,com_id,checks_id,clt_units","$cost,'$clt_currency',$clid,$check,$units","clients_checks");
				
			}
		}
	}
	}

	}

}


/*
function add_client_checks($clid){
	$db = new DB();
	 $user_id = $_SESSION['user_id'];

	//$db->update("clt_active=0","clients_checks","com_id=$clid");
	
	if(isset($_POST['checks']) && is_array($_POST['checks'])){
		
			
			// for agreement modification
			
	 $user_id = $_SESSION['user_id'];
	$user_info = getUserInfo($user_id);
	$fullName = $user_info['first_name']." ".$user_info['last_name'];

				$comInfo = getcompany($clid);
				$comInfox = @mysql_fetch_array($comInfo);

			$agreement_confg = $db->update("is_send='0',agr_status='0'","client_agreement_confg","comps_id=$clid");
			
			$record1 = $db->select("client_agreement_confg","*","comps_id=$clid");
			//if(mysql_num_rows($record1)>0){
				$agreement_confg1 = mysql_fetch_array($record1);
				$receiver_id = $agreement_confg1['agr_receiver'];
			//}
	$user_info2 = getUserInfo($receiver_id);
	$fullName2 = $user_info2['first_name']." ".$user_info2['last_name'];
	$client_email = $user_info2['email'];
			
			
 								$table = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
 					<tr>
						'.$fullName.' Update Checks For '.$comInfox['name'].'. Agreement is in pending so please review it and send again to client. 
 					</tr> 
 					</tbody>
				</table>';
		  emailTmp($table,'Agreement Modify For '.$comInfox['name'].' ',"atta@xcluesiv.com","","","","","Operation","");

 								$table2 = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
 					<tr>
						BCG modify agreement for '.$comInfox['name'].', please review it need your approval. 
 					</tr> 
					<tr>
					Receive your copy of agreement by clicking below link.<br>
<a href="'.SURL.'?action=agreement&atype=approval">Click Here</a><br>
The above link will take you to the page with The background check group agreement view.
					</tr>
 					</tbody>
				</table>';
		  emailTmp($table2,'Agreement Modify From BCG',$client_email,"","","","","$fullName2","");
	  		
				// for agreement modification end

			
		
		
		
		
		
		
		
		
		foreach($_POST['checks'] as $key=>$check){
		$cost = trim($_POST["cost$check"]);
		$units = trim($_POST["units$check"]);
		$clt_currency = trim(strtoupper($_POST["clt_currency$check"]));
		
		if(is_numeric($check)){
			if(!is_numeric($cost)) $cost=0;
			if(!is_numeric($units)) $units=1;
			
			$record = $db->select("clients_checks","*","com_id=$clid AND checks_id=$check");
			
			
			$record2 = $db->select("client_agreement","*","com_id=$clid AND checks_id=$check");
			//if(mysql_num_rows($record2)>0){
							// $db->update("user_id=$user_id,clt_cost=$cost,clt_currency='$clt_currency',clt_units=$units","client_agreement","com_id=$clid AND checks_id=$check");
			//}
			
			
			if(mysql_num_rows($record)>0){

			 }
			 
			 else if(mysql_num_rows($record2)>0){
				//$db-> insert("clt_cost,clt_currency,com_id,checks_id,clt_units","$cost,'$clt_currency',$clid,$check,$units","clients_checks");
				
								 $db->update("clt_cost=$cost,clt_currency='$clt_currency',clt_units=$units","client_agreement","com_id=$clid AND checks_id=$check");
			}
			else
			{
				
				 $db->insert("user_id,clt_cost,clt_currency,com_id,checks_id,clt_units","$user_id,$cost,'$clt_currency',$clid,$check,$units","client_agreement");
				
			}
		}
	}
	}
}
*/


function add_Company(){
		$db = new DB();
		 
		$date_ = date("Y-m-d");
		
		$poc_clos = "poc_name,poc_designation,poc_email,poc_phone";
		// POC OPERATION
		
		
		$poc_op_name = $_REQUEST['pname'];
		$poc_op_email = $_REQUEST['cEmail'];
		$poc_op_phone = $_REQUEST['phone'];
		
		$poc_finance_name = $_REQUEST['poc_finance_name'];
		$poc_finance_email = $_REQUEST['poc_finance_email'];
		$poc_finance_phone = $_REQUEST['poc_finance_phone'];
		
		$poc_sales_name = $_REQUEST['poc_sales_name'];
		$poc_sales_email = $_REQUEST['poc_sales_email'];
		$poc_sales_phone = $_REQUEST['poc_sales_phone'];
		
		
		$poc_operation = "'$poc_op_name','operation','$poc_op_email','$poc_op_phone'";
		$poc_finance = "'$poc_finance_name','finance','$poc_finance_email','$poc_finance_phone'";
		$poc_sales = "'$poc_sales_name','sales','$poc_sales_email','$poc_sales_phone'";
		
		
		if(trim($_REQUEST['cName'])=='') msg('err',"Please input company name!");
		if(trim($_REQUEST['cerp'])=='') msg('err',"Please input client ERP ID!");
		
		
		$can_download_reports = (isset($_REQUEST[can_download_reports]))?$_REQUEST[can_download_reports]:0;
		$location_wise = (isset($_REQUEST[location_wise]))?$_REQUEST[location_wise]:0;
		$allow_custom_order = (isset($_REQUEST[allow_custom_order]))?$_REQUEST[allow_custom_order]:0;
		$credits =  (isset($_REQUEST[credits]))?$_REQUEST[credits]:0;
		$monthly_credits_allowed =  (isset($_REQUEST[monthly_credits_allowed]))?$_REQUEST[monthly_credits_allowed]:0;
		$state_province_id =  (isset($_REQUEST[city]))?$_REQUEST[city]:0;
		
		$paid = 1;
		if(trim($_REQUEST['cType'])=='Test' && isset($_REQUEST['paid'])){
			$paid = $_REQUEST['paid'];
		}
		if(trim($_REQUEST['cType'])=='Individual') $_REQUEST['ind'] = 0;
		if(isset($_REQUEST['disabled_id']) && $_REQUEST['disabled_id']==1){
			$disabled_id= 1;
		}else{
			$disabled_id= 0;
		}
	if($_REQUEST['ERR']==''){	
	foreach ($_FILES["attch"]["error"] as $key => $error) {
	   if ($error == UPLOAD_ERR_OK){
			$ext = pathinfo($_FILES["attch"]["name"][$key], PATHINFO_EXTENSION);	
			$extAry =array('doc','docx','xls','xlsx','pdf','jpg','jpeg','png','bmp');
			if(in_array($ext,$extAry)){
				$indx = time().strtoupper(get_rand_val(10)).rand(10,99);
				$fPath = "attach/$indx.$ext";
				if(move_uploaded_file($_FILES["attch"]['tmp_name'][$key],$fPath)){
					$attachs['title'][]	= $_POST['title'][$key];
					$attachs['names'][] = $_FILES['attch']['name'][$key];
					$attachs['paths'][] = $fPath;
				}
			}else{
				msg('err',"$ext File type is not Allowed [ $fileName ]");
				return false;
			}
	   }
	}
		if(is_numeric($_REQUEST['comid'])){
			$lID = $_REQUEST['comid'];
			
			
			
			$sel =  $db->select("non_payment_clients_dates","id,enable_date,disable_date","com_id = $_REQUEST[comid] ORDER BY id DESC");
			$rs = mysql_fetch_assoc($sel);
			$tody = strtotime($date_);
			$enable_time = strtotime($rs['enable_date']);
			$disable_time = strtotime($rs['disable_date']);
			//echo "today: ".$tody." enable_time: ".$enable_time; exit;

				
				
				$para = "name='$_REQUEST[cName]',email='$_REQUEST[cEmail]',ind_id=$_REQUEST[ind],paid=$paid,`disabled_id`=$disabled_id";
				
				$para = "$para,type='$_REQUEST[cType]',location=$_REQUEST[location],address='$_REQUEST[address]',erpid='$_REQUEST[cerp]'";
				
				$para = "$para,pname='$_REQUEST[pname]',phone='$_REQUEST[phone]',pymterm='$_REQUEST[pterm]',slab_id='$_REQUEST[slab_id]',comment='$_REQUEST[comments]',credits='$credits',mode_of_payment='$_REQUEST[mode_of_payment]',account_type='$_REQUEST[account_type]',is_check_wise_pay='$_REQUEST[is_check_wise_pay]',can_download_reports='$can_download_reports',location_wise='$location_wise',allow_custom_order='$allow_custom_order',monthly_credits_allowed='$monthly_credits_allowed',state_province_id='$state_province_id'";

				
				if(trim($_REQUEST['sdate'])!='') $para = "$para,agsdate='$_REQUEST[sdate]'";
				if(trim($_REQUEST['edate'])!='') $para = "$para,agedate='$_REQUEST[edate]'";
				if(isset($attachs['title'])){
					foreach($attachs['title'] as $key=>$attach){
						$title = $attachs['title'][$key];
						$name =$attachs['names'][$key];
						$path =$attachs['paths'][$key];
						$para = "$para,title$key='$title',attach$key='$path',file$key='$name'";
					}
				}
					
					
				//echo "update company set $para where id=$_REQUEST[comid]";
				$isIncUp = $db->update($para,"company","id=$_REQUEST[comid]");
				
				if(mysql_num_rows($db->select("clients_poc","com_id","com_id=$_REQUEST[comid]")) == 0){
				$poc_clos = "com_id,".$poc_clos;
				$poc_operation = "$_REQUEST[comid],".$poc_operation;
				$poc_finance = "$_REQUEST[comid],".$poc_finance;
				$poc_sales = "$_REQUEST[comid],".$poc_sales;
				$db->insert($poc_clos,$poc_operation,"clients_poc");	
				$db->insert($poc_clos,$poc_finance,"clients_poc");	
				$db->insert($poc_clos,$poc_sales,"clients_poc");	
				}else{
				$poc_op_id = mysql_fetch_assoc($db->select("clients_poc","poc_id","com_id=$_REQUEST[comid] AND poc_designation='operation'"));
				$poc_finance_id = mysql_fetch_assoc($db->select("clients_poc","poc_id","com_id=$_REQUEST[comid] AND poc_designation='finance'"));
				$poc_sales_id = mysql_fetch_assoc($db->select("clients_poc","poc_id","com_id=$_REQUEST[comid] AND poc_designation='sales'"));
				
				$db->updateCol($poc_clos,$poc_operation,"clients_poc","poc_id=$poc_op_id[poc_id]");	
				$db->updateCol($poc_clos,$poc_finance,"clients_poc","poc_id=$poc_finance_id[poc_id]");	
				$db->updateCol($poc_clos,$poc_sales,"clients_poc","poc_id=$poc_sales_id[poc_id]");	
					
				}
				
				if($isIncUp && $disabled_id==0){
					$company = $db->select("company","*","id=$_REQUEST[comid]");
					$cominfo=mysql_fetch_array($company);
					$userEmails=$cominfo['email'];
					$user_names=$cominfo['pname'];
					$groupEmail="mis@backcheckgroup.com";
					$data_table ='<table width="100%" border="0" style="background-color:#f6f6f7;">
			<tr>
			<td align="center" width="100%" colspan="8" style="border:none;">&nbsp;</td>
		  </tr>
		  
			<tr>
			<td align="center" width="100%" colspan="8" style="border:none;">Your account of Background Check`s Services has been reactivated today.</td>
		  </tr>
		  <tr>
			<td align="center" width="100%" colspan="8" style="border:none;">Welcome Back!</td>
		  </tr>
		   <tr>
			<td align="center" width="100%" colspan="8" style="border:none;">We assure you that you made a right choice of doing business with Background Check Group.</td>
		  </tr>
		   <tr>
			<td align="center" width="100%" colspan="8" style="border:none;">Enjoy our services with no more disruptions.</td>
		  </tr>
		  <tr>
			<td align="center" width="100%" colspan="8" style="border:none;">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center" width="100%" colspan="8" style="border:none; color:#54565c; font-family:Verdana, Geneva, sans-serif;"></td>
		  </tr>
		  </table>
		  <table width="600" border="0" cellpadding="5" style="margin:0 auto; border-spacing: 0px;  overflow: hidden; font-family:Verdana, Geneva, sans-serif; color:#54565c;" bgcolor="#f6f6f7" >
					<tr>
					<td align="left" width="100%" colspan="8" style="border:none;">Sincerely,<br><br>BCG Support Team</td>
					</tr>				
					</table>';
			
			$email_title = 'Account Reactivation For '.$cominfo['name'];
					$email_arr = array();
		$user_names = array();
		$user_info = $db->select("users ","*","com_id=$_REQUEST[comid] and level_id=4 and is_active=1");     
		if(mysql_num_rows($user_info)>0){
							while($uemail = mysql_fetch_assoc($user_info)){
								$cond1=1;
								$email_arr[]  =  $uemail['email'];
								$user_names[] = $uemail['first_name']." ". $uemail['last_name'];
								
							}
						}else{
							$cond1=2;
							$email_arr[]  = $userEmails;
							$user_names[] = $user_names;
							
						}
					//	print_r($user_names);die;
					
			if(isset($_REQUEST['updateclient_status'])){
			if($_REQUEST['disabled_id']==0) {		
			
			foreach($email_arr as  $key => $email){
			$c++;
			$userEmails = strtolower($email);
			emailTmp( $data_table, $email_title,$userEmails,'',$groupEmail,'','',$user_names[$key]);
			
			//emailTmp( $data_table, $email_title,'khalique@xcluesiv.com','','','','',$user_names[$key]);
			
			
			} // foreach
			} // if
			} // if
			
				}
				add_client_checks($_REQUEST['comid']);
				
				
				if(isset($_REQUEST['updateclient_status'])){
				if($_REQUEST['disabled_id']==1){
				// insert enable date
				

				if($rs['enable_date'] && $rs['disable_date']==""){
				//echo "enable_date: ".$rs['enable_date']."id: $rs[id]"; exit;
				//echo "UPDATE non_payment_clients_dates SET disable_date='".$date_."'"; exit;
				$db->update("disable_date='".$date_."'","non_payment_clients_dates"," id=$rs[id]");
				// update all Open Checks to On Hold Non payment
				$tblss = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id ";
				$db->update("as_status='On Hold Non payment'","$tblss","vd.com_id=$lID AND vc.as_status='Open'");
				
				}else{
					
				if($disable_time!=$tody){	
				$db->insert("com_id,disable_date","$lID,'".$date_."'","non_payment_clients_dates");	
				}
				$tblss = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id ";
				$db->update("as_status='On Hold Non payment'","$tblss","vd.com_id=$lID AND vc.as_status='Open'");
				}
				}else{
					
				if($rs['disable_date'] || $rs['enable_date']){	
				
				$db->update("enable_date='".$date_."'","non_payment_clients_dates"," id=$rs[id]");
				// update all On Hold Non payment Checks to Open
				$tblss = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id ";
				$db->update("as_status='Open'","$tblss","vd.com_id=$lID AND vc.as_status='On Hold Non payment'");
				
				}else{
				if($enable_time!=$tody){		
				$db->insert("com_id,enable_date","$lID,'".$date_."'","non_payment_clients_dates");	
				}
				$tblss = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id ";
				$db->update("as_status='Open'","$tblss","vd.com_id=$lID AND vc.as_status='On Hold Non payment'");
				}
				}
				}
				
				
				$typ = 'Updat';			

		}
		// for add
		else{
			
			
				
			$company = $db->select("company","id","name LIKE '$_REQUEST[cName]'");
			if(mysql_num_rows($company)==0){
				$values = "'$_REQUEST[cName]','$_REQUEST[cEmail]',$_REQUEST[ind],'$_REQUEST[cType]',$_REQUEST[location],'$_REQUEST[address]'";
				$values = "$values, '$_REQUEST[pterm]','$_REQUEST[comments]','$_REQUEST[pname]','$_REQUEST[phone]','$_REQUEST[cerp]',$paid,'$credits','$_REQUEST[mode_of_payment]','$_REQUEST[account_type]','$_REQUEST[is_check_wise_pay]','$can_download_reports','$location_wise','$allow_custom_order','$monthly_credits_allowed','$state_province_id'";
				$cols   = "name,email,ind_id,type,location,address,pymterm,comment,pname,phone,erpid,paid,credits,mode_of_payment,account_type,is_check_wise_pay,can_download_reports,location_wise,allow_custom_order,monthly_credits_allowed,state_province_id";
				if(trim($_REQUEST['sdate'])!='') $values = "$values,'$_REQUEST[sdate]'";
				if(trim($_REQUEST['edate'])!='') $values = "$values,'$_REQUEST[edate]'";
				if(trim($_REQUEST['sdate'])!='') $cols = "$cols,agsdate";
				if(trim($_REQUEST['edate'])!='') $cols = "$cols,agedate";
				if(isset($attachs['title'])){
					foreach($attachs['title'] as $key=>$attach){
						$title = $attachs['title'][$key];
						$name =$attachs['names'][$key];
						$path =$attachs['paths'][$key];
						$values = "$values,'$title','$path','$name'";
						$cols = "$cols,title$key,attach$key,file$key";
					}
				}
				$sname='';
				$nameary = explode(' ',$_REQUEST['cName']);
				if(count($nameary)>1){
					foreach($nameary as $key=>$tname){
						if($key<3) $sname = $sname.strtoupper($tname[0]);
						if(count($nameary)==2 && strlen($sname)==1) $sname = $sname.strtoupper($tname[1]);
					}
				}else{
					if(strlen($_REQUEST['cName'])<=3) $sname =strtoupper($_REQUEST['cName']); else{
						$sname = strtoupper($_REQUEST['cName'][0].$_REQUEST['cName'][1].$_REQUEST['cName'][2]);
					}
				}
				$cols = "$cols,sname,`disabled_id`";
				$values = "$values,'$sname',$disabled_id";
				$isIncUp = $db->insert($cols,$values,"company");
				$lID = $db->insertedID;
				
				$agree_col = 'comps_id';
				$agree_val = '$lID';
					
				// $db->insert("is_send='0',agr_status='0'","client_agreement_confg","comps_id=$lID");
				$db->insert($agree_col,$agree_val,"client_agreement_confg");	
					
							
			// for agreement modification
			
/*	 $user_id = $_SESSION['user_id'];
	$user_info = getUserInfo($user_id);
	$fullName = $UserInfo['first_name']." ".$UserInfo['last_name'];

							$comInfo = getcompany($lID);
				$comInfox = @mysql_fetch_array($comInfo);

			$agreement_confg = $db->update("is_send='0',agr_status='0'","client_agreement_confg","comps_id=$_REQUEST[comid]");
 								$table = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
					 
					<tr>
						'.$fullName.' add new client '.$comInfox['name'].'. 
 					</tr> 
					 
					 
					</tbody>
				</table>';
		  emailTmp($table,'Agreement Modify For '.$comInfox['name'].' ',"atta@xcluesiv.com","","","","","");
			*/
			
				// for agreement modification end

	
					
					
								
				$poc_clos = "com_id,".$poc_clos;
				$poc_operation = "$lID,".$poc_operation;
				$poc_finance = "$lID,".$poc_finance;
				$poc_sales = "$lID,".$poc_sales;
				$db->insert($poc_clos,$poc_operation,"clients_poc");	
				$db->insert($poc_clos,$poc_finance,"clients_poc");	
				$db->insert($poc_clos,$poc_sales,"clients_poc");	
				
				
				
				
				
				
				//addeditcompany($_REQUEST);
				
				if($isIncUp) add_client_checks($lID);
				if($lID){
				if(isset($_REQUEST['updateclient_status'])){
				if($_REQUEST['disabled_id']==1){
				// insert enable date
				

				if($rs['enable_date']){
				
				
				$db->update("disable_date='".$date_."'","non_payment_clients_dates"," id=$rs[id]");
				// update all Open Checks to On Hold Non payment
				$tblss = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id ";
				$db->update("as_status='On Hold Non payment'","$tblss","vd.com_id=$lID AND vc.as_status='Open'");
				
				}else{
					
				$db->insert("com_id,disable_date","$lID,'".$date_."'","non_payment_clients_dates");	
				
				}
				}else{
					
				if($rs['disable_date']){	
				
				$db->update("enable_date='".$date_."'","non_payment_clients_dates"," id=$rs[id]");
				// update all On Hold Non payment Checks to Open
				$tblss = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id ";
				$db->update("as_status='Open'","$tblss","vd.com_id=$lID AND vc.as_status='On Hold Non payment'");
				
				}else{
					
				$db->insert("com_id,enable_date","$lID,'".$date_."'","non_payment_clients_dates");	
				}
				}
				}
				} //if lID
				$typ = 'insert';
			}else{
				msg('err',"Client [$_REQUEST[cName]] already exist!");
				return false;			
			}
}
		if($isIncUp){

			$DirNm = preg_replace('/[^a-zA-Z0-9\-_]/', '',$_REQUEST['cName']);

			if(is_dir("attach/$DirNm")) $DirNm="$DirNm-".rand(1,9);

			if(@mkdir("attach/$DirNm",0777)){	

				if(@mkdir("attach/$DirNm/proof",0777)){
					$isIncUp = $db->update("path='attach/$DirNm/'","company","id=$lID");
				}
			}			
			$typ=$typ.'ed';
			msg('sec',"Client [$_REQUEST[cName]] $typ Successfully...");
			return $lID;
		}else{
			$typ=$typ.'ion';
			msg('err',"Company $typ Error!");
			return false;
		}	
	}
}
function insertleads($com_id){
	$db = new DB();
	$ch = curl_init();
	$query_string="action=lead_add&pams[CREATED_BY_ID]=1&pams[TITLE]=".urlencode($_REQUEST['cName'])."&pams[NAME]=".urlencode($_REQUEST['cName'])."&pams[COMMENTS]=".urlencode($_REQUEST['comments'])."&pams[EMAIL_WORK]=".$_REQUEST['cEmail']."&pams[PHONE_WORK]=".$_REQUEST['phone']."&pams[SOURCE_ID]=".urlencode("Verification System")."&pams[Erp Id]=".$_REQUEST['cerp']."";
    curl_setopt($ch, CURLOPT_URL, BITRIX_URL);
    // Set a referer
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
    // Download the given URL, and return output
    $output = curl_exec($ch);
	$insertedleadid=json_decode($output);
	$leadid=$insertedleadid->leadinserted_id;
	$db->update("bitrix_id='$leadid'","company","id=".(int)$com_id."");
    // Close the cURL resource, and free system resources
    curl_close($ch);
}
function add_Check(){
	$db = new DB();
	if($_REQUEST['isattach'] == "on"){$isattach = 0;}else{$isattach = 1;}
	
   if(trim($_REQUEST['cktl'])!=''){
	if(is_numeric($_REQUEST['group_id'])){	

		if(isset($_REQUEST['check'])){

			if(is_numeric($_REQUEST['check'])){

				$para = "checks_title='$_REQUEST[cktl]',checks_desc='$_REQUEST[ckds]',checks_amt=$_REQUEST[amnt],checks_wdays='$_REQUEST[wdays]',group_id='$_REQUEST[group_id]',is_attachment='$isattach'";

				$isIncUp = $db->update($para,"checks","checks_id=$_REQUEST[check]");

				$typ = 'Updat';

			}

		}else{	

			$checks = $db->select("checks","checks_id","checks_title LIKE '$_REQUEST[cktl]'");

			if(mysql_num_rows($checks)==0){

				$values = "'$_REQUEST[cktl]','$_REQUEST[ckds]',$_SESSION[user_id],$_REQUEST[amnt],'$_REQUEST[wdays]','$_REQUEST[group_id]','$isattach'";

				$isIncUp = $db->insert("checks_title,checks_desc,checks_owner,checks_amt,checks_wdays,group_id,is_attachment",$values,"checks");

				$lID = $db->insertedID;

 

			   	$cols="checks_id,t_check,t_title,t_btn,t_name, t_pos, t_key, is_dsp, t_show ";
				
			   	$values="'".$lID."','0','Testing Title For Button','Testing Button Name', 'checksub','1','N/A','1','0' ";
				 
				     $db->insert($cols,$values,"titles");
				     $titles_insertedID=$db->insertedID;



 					 
 				$cols="t_id,checks_id,in_id,fl_op,fl_title, fl_desc, fl_algn, fl_dval, fl_key, fl_type
				, fl_cls, fl_date, fl_ord, fl_face, is_multy, is_req, fl_show ";
				
			 	$values="'$titles_insertedID','".$lID."','8','3', 'Verification Result','','algleft','','as_vstatus','p','','','100','0','0','0','1'";
				 
				     $db->insert($cols,$values,"fields_maping");
				     $CID=$db->insertedID;

 				$cols="t_id,checks_id,in_id,fl_op,fl_title, fl_desc, fl_algn, fl_dval, fl_key, fl_type
				, fl_cls, fl_date, fl_ord, fl_face, is_multy, is_req, fl_show ";
				
			 	$values="'$titles_insertedID','".$lID."','5','1', 'Proof(s)','','algleft','','file','s','','','102','0','0','0','1'";
				 
				     $db->insert($cols,$values,"fields_maping");
				     $CID=$db->insertedID;

 
 
  
 
 
 


				$typ = 'insert';

			}else{

				msg('err',"Check [$_REQUEST[cktl]] already there...");

					

				return false;			

			}

		}

		if($isIncUp){

			$typ=$typ.'ed';

			msg('sec',"Check [$_REQUEST[cktl]] $typ Successfully...");

						

			return $lID;

		}else{

			$typ=$typ.'ion';

			msg('err',"Check $typ Error!");

						

			return false;

		}	

	}else{
		msg('err',"Please Select Bitrix WorkGroup First!");

				

	}
	}
	else{
		msg('err',"Please Input Check's Title!");

				

	}

}



function addComments($cType="case",$cID=0){

	$db = new DB();

	$_REQUEST['comTit'] = trim($_REQUEST['comTit']);

	$_REQUEST['comTxt'] = trim($_REQUEST['comTxt']);

	if($_REQUEST['comTxt']!='' &&  $_REQUEST['comTit']!=''){

		$where="com_title LIKE '$_REQUEST[comTit]' AND com_text LIKE '$_REQUEST[comTxt]' AND com_type='$cType' AND clent_id=$cID";	

		$comnts = $db->select("comments","_id",$where);

		if(mysql_num_rows($comnts)==0){

			if(isset($_SESSION['user_id'])){

				$uID = $_SESSION['user_id']; 

			}else $uID = 0;

			$case = $db->select("ver_checks","*","as_id=$_REQUEST[_id]");

			$case = mysql_fetch_assoc($case);

			$case = $case['v_id'];

			$cols = "_mid,_id,com_title,com_text,user_id,com_type,clent_id";

			$vals = "$case,$_REQUEST[_id],'$_REQUEST[comTit]','$_REQUEST[comTxt]',$uID,'$cType',$cID";

			if(isset($_REQUEST['email'])){

				$cols = "$cols,com_email";

				$_REQUEST['email'] = ($_REQUEST['email']);

				$vals = "$vals,'$_REQUEST[email]'";

			}

			$isInc = $db->insert($cols,$vals,'comments');

			if($isInc){

				msg('sec',"Comments inserted Successfully [ $_REQUEST[comTit] ]...");

					

				if(isset($_REQUEST['adprob'])){

					caseStatus($_REQUEST['ascase'],"Problem");

				}

			}else{

				msg('err',"Comments insertion Error! [ $_REQUEST[comTit] ]");

				

			}	

		}

	}else{

				msg('err',"Please Input Comments!");

						

	}

}



function getComments($comPID,$asID,$orderby = '', $com_type =''){

	$db = new DB();
	$orderby = (!empty($orderby)) ? $orderby : 'DESC';
	$com_type = (!empty($com_type)) ? $com_type : "com_type = 'case'";
	if($comPID!=0) $where = "p_id=$comPID"; else $where="_id=$asID";
	
	$comnts = $db->select("comments","*","$where AND $com_type ORDER BY com_date $orderby");

	if(mysql_num_rows($comnts)>0) return $comnts;

	return false;

}



function data_uri($file, $mime) {  

  $contents = file_get_contents($file);

  $base64   = base64_encode($contents); 

  return ('data:' . $mime . ';base64,' . $base64);

}





function addCategory(){

	$db = new DB();

	if($_REQUEST['category']!=''){

		$isThere = $db->select("categorys","*","cat_name LIKE '$_REQUEST[category]'");

		if(mysql_num_rows($isThere)==0){

			$isInc = $db->insert('cat_name',"'$_REQUEST[category]'",'categorys');

			if($isInc) echo msg('sec',"Category Added Successfully [ $_REQUEST[category] ]..."); 

			else echo msg('err',"Category Adding Error! [ $_REQUEST[category] ]");

		}

	}		

}



function getScreening($scr=''){

	$db = new DB();

	if(is_numeric($scr)){

		$screening = $db->select("screenings","*","sc_id=$scr");

		return mysql_fetch_array($screening);

	}

	return  $db->select("screenings","*");

}



function addScreening(){

	$db = new DB();

	$scr  = $_REQUEST['screening'];

	$desc = $_REQUEST['scdesc'];

	if(isset($_REQUEST['scid'])){

		$isIncUp = $db->update("sc_name='$scr',sc_desc='$desc'","screenings","sc_id=".$_REQUEST['scid']);

		if($isIncUp){

			echo msg('sec',"Screening Edited Successfully [ $scr ]..."); 

			return $_REQUEST['scid'];

		}else echo msg('err',"Screening Editing Error! [ $scr ]");		

	}else{

		$cols="sc_name,sc_desc";

		$isThere = $db->select("screenings","*","sc_name LIKE '$scr'");

		if(mysql_num_rows($isThere)==0){

			$vals="'$scr','$desc'";

			$isInc = $db->insert($cols,$vals,'screenings');

			$lID = $db->insertedID;

			if($isInc){

				echo msg('sec',"Screening Added Successfully [ $scr ]..."); 

				return $lID;

			}else echo msg('err',"Screening Adding Error! [ $scr ]");

		}

	}

	return false;

}



function addPackage(){

	$db = new DB();

	$cols="sc_id,checks_id";

	$scr = $_REQUEST['screening'];

	$chk = $_REQUEST['check'];

	if(is_numeric($scr) && is_numeric($chk)){

		$isThere = $db->select("packages","*","sc_id=$scr AND checks_id=$chk");

		if(mysql_num_rows($isThere)==0){

			$vals="$scr,$chk";

			$isInc = $db->insert($cols,$vals,'packages');

			if($isInc) echo msg('sec',"Package Added Successfully ..."); 

			else echo msg('err',"Package Adding Error!");

		}

	}

}



function getPackage($scr=0){

	$db = new DB();

	if($scr!=0){

	 	 	$where="sc_id=$scr";

	} else  $where="";

	$tQury="packages pkg INNER JOIN checks chk ON pkg.checks_id= chk.checks_id INNER JOIN screenings sc ON pkg.sc_id= sc.sc_id ORDER BY sc.sc_name,chk.checks_title";

	$packages = $db->select($tQury,"*",$where);

	if(mysql_num_rows($packages)>0){

		return $packages;

	}

	return false;

}





function addPCheck(){

	$db = new DB();

	$cols="pkg_id,checks_id";

	$pkg = $_REQUEST['pkg'];

	$scr = $_REQUEST['scr'];

	$cols="pkg_id,sc_id,checks_id";

	foreach($_REQUEST['checks'] as $check){

		if(is_numeric($check)){

			$isThere = $db->select("pkg_items","*","(pkg_id=$pkg AND sc_id=$scr)  AND checks_id=$check");

			if(mysql_num_rows($isThere)==0){

				$chechInfo = getCheck($check);

				$vals="$pkg,$scr,$check";

				$isInc = $db->insert($cols,$vals,'pkg_items');

				if($isInc) echo msg('sec',"Check Added Successfully [ $chechInfo[checks_title] ]..."); 

				else echo msg('err',"Check Adding Error! [ $chechInfo[checks_title] ]");

			}

		}

	}

}



function addDCheck($pID,$cID,$action){

	$db = new DB();

	$uID = $_SESSION['user_id'];

	$isThere = $db->select("default_pkg","*","user_id=$uID AND pkg_id=$pID AND checks_id=$cID");

	$chechInfo = getCheck($cID);

	if(mysql_num_rows($isThere)==0 && $action=='in'){

		$cols="user_id,pkg_id,checks_id";

		$vals="$uID,$pID,$cID";		

		$isInc = $db->insert($cols,$vals,'default_pkg');

		if($isInc){

			echo msg('sec',"Check Added Successfully [ $chechInfo[checks_title] ]...");

		}else{

			echo msg('err',"Check Adding Error! [ $chechInfo[checks_title] ]");

		}

	}else{

		$isdlt = $db->delete('default_pkg',"user_id=$uID AND pkg_id=$pID AND checks_id=$cID");

		if($isdlt){

			echo msg('sec',"Check Removed Successfully [ $chechInfo[checks_title] ]...");

		}else{

			echo msg('err',"Check Removing Error! [ $chechInfo[checks_title] ]");

		}

	}

}



function getTitle($cID,$type=''){

	$db = new DB();

	if($type!='') $type = " AND t_key='$type'";

	return $db->select("add_data","*","checks_id=$cID AND d_isdlt=0 $type");

}



function getData($asID,$type='',$eCol=''){

	$db = new DB();

	if($type!='') $type = " AND d_type='$type'";

	return $db->select("add_data","*","as_id=$asID AND d_isdlt=0 $type$eCol");

}



function getVerdata($vID){

	$db = new DB();

	$verData = $db->select("ver_data","*","v_id=$vID");

	if(mysql_num_rows($verData)>0) return mysql_fetch_array($verData);

	return false;

}



function checkAcs($action){

		$db = new DB();

		if(!isset($action) || $action=='') return true;

		$isAcs = $db->select("access2","COUNT(acs_name) cnt","acs_key='$action' AND is_active=1");

		$isAcs = mysql_fetch_array($isAcs);

		if($isAcs['cnt']>0) return true;

		return false;

}



function time_ago($date,$granularity=2) {

    $difference = time() - $date;

	$periods = array('decade' => 315360000,

        'year' => 31536000,

        'month' => 2628000,

        'week' => 604800, 

        'day' => 86400,

        'hour' => 3600,

        'minute' => 60,

        'second' => 1);

    foreach ($periods as $key => $value) {

		if ($difference >= $value) {

            $time = floor($difference/$value);

            $difference %= $value;

            $retval .= ($retval ? ' ' : '').$time.' ';

            $retval .= (($time > 1) ? $key.'s' : $key);

            $granularity--;

        }

		

        if ($granularity == '0') break;

    }

	if(!isset($retval) || ($retval=='')) $retval = '1 second';

    return '  '.$retval.' ago';      

}



function getActivity($level){

	if(isset($_SESSION['user_id'])){

		$db = new DB();

		$uID = $_SESSION['user_id'];

		$activity = $db->select("activity","*","user_id=$uID AND level=$level ORDER BY a_id DESC");

		return $activity; 

	}

	return false;

}



function check_entity($name){

	$db = new DB();

	$entitys = $db->select("medicalstaff","COUNT(Company) cnt","Company='$name'");

	$entitys = mysql_fetch_array($entitys);

	return $entitys['cnt'];

}



function geCrmlInfo($cID='',$cRN=''){

	$db = new DB();

	if($cRN!=''){

		$crmlInfo = $db->select("medicalstaff","*","CRN='$cRN'");

		return $crmlInfo;

	}else if($cID!=''){

		$crmlInfo = $db->select("medicalstaff","*","id=$cID");

		if(mysql_num_rows($crmlInfo)>0) 

		return mysql_fetch_array($crmlInfo);

	}

	return false;

}



function information(){

	$db = new DB();

	$cols="user_id,pkg_id,sc_id,at_title,at_desc";

	$uID = $_SESSION['user_id'];

	$vals="$uID,'$_POST[package]','$_POST[screening]','$_POST[ititl]','$_POST[idesc]'";

	$isInc = $db->insert($cols,$vals,'attachments');

	$id = $db->insertedID;

	if($isInc){

		$filUpMsg = addFile($id);

		$msg=msg('sec',"Information Inserted Successfully...");

		if($filUpMsg!==true) $msg.=$filUpMsg;

		return $msg;

	}else{

		return msg('err',"Information Insertion Error!");

	}

}



function addFile($id){

	$path = "attach/temp/";

	$uID = $_SESSION['user_id'];

	$filesErr='';

	$db = new DB();

	foreach ($_FILES["files"]["error"] as $key => $error) {

	   if ($error == UPLOAD_ERR_OK){

			$len = strlen($_FILES["files"]["name"][$key]);

			$ext = strtolower(substr($_FILES["files"]["name"][$key],($len-3)));

			$extAry =array('doc','docx','xls','xlsx','pdf','jpg');

			if(in_array($ext,$extAry)){

				$indx=rand(10,99).strtoupper(get_rand_val(10)).rand(10,99);

				$fPath = $path."$uID-$indx.$ext";

				$fileName =$_FILES['files']['name'][$key];

				if(move_uploaded_file($_FILES["files"]["tmp_name"][$key],$fPath)){

					$isInc = $db->insert("at_id,file_name,file_path","$id,'$fileName','$fPath'",'files');

					if(!$isInc) $filesErr.=(($filesErr!='')?'<br/>':'')."File Uploading Error";

				}else{

					$filesErr.=(($filesErr!='')?'<br/>':'')."File Uploading Error [ $fileName ]";   

				}				

			}else{

				$filesErr.=(($filesErr!='')?'<br/>':'')."$ext File Type is not Allowed [ $fileName ]"; 

			}			

	   }

	}	

	return ($filesErr!='')?msg('err',$filesErr):true;	

}



function getInvoice($uID=''){

	$db = new DB();

	if($uID=='') $uID = $_SESSION['user_id'];

	$invoice = $db->select("invoice","*","user_id=$uID");

	return mysql_fetch_array($invoice);

}





function updateProfile(){

	$db = new DB();

	$uID = $_SESSION['user_id'];

	$mail = addslashes($_POST['email']); 

	$cols="first_name='$_POST[fname]', last_name='$_POST[lname]',username='$mail', email='$mail',address='$_POST[adrs]'";

	$cols.=",city='$_POST[city]',cell_no='$_POST[mfon]',fone_no='$_POST[sfon]',designation='$_POST[desig]'";

	

	$isInup = $db->update($cols,"users","user_id=$uID");				

	if($isInup){

			updateComp();

			return msg('sec',"Profile Updated Successfully...");	

	}else{

			return msg('err',"Profile Updation Error!");

	}

}



function updateComp(){

	$db = new DB();

	$uID = $_SESSION['user_id'];

	if($_POST['comp']!=''){

		$comp = $db->select("company","*","user_id=$uID");

		if(mysql_num_rows($comp)==0){

			$path="attach/".strtolower(str_replace(' ','_',$_POST['comp']));

			if(!is_dir($path)) mkdir($path);

			if(!is_dir($path.'/proof')) mkdir($path.'/proof');

			if(!is_dir($path.'/files')) mkdir($path.'/files');

			$cols="user_id,`name`,address,path";

			$vals="$uID,'$_POST[comp]','$_POST[adrs]','$path'";

			$isInup = $db->insert($cols,$vals,'company');		

		}else{

			$cols="`name`='$_POST[comp]',address='$_POST[adrs]'";

			$isInup = $db->update($cols,"company","user_id=$uID");			

		}

		

		if($isInup)	return true; else return false;

	}

}



function updateInvoice(){

	$db = new DB();

	$uID = $_SESSION['user_id'];

	$invoice = $db->select("invoice","*","user_id=$uID");

	if(mysql_num_rows($invoice)==0){

		$cols="user_id,inv_fname,inv_lname,inv_email,inv_comp,inv_adrs,inv_twn,inv_fax,inv_mbl,inv_fon,inv_zcod";

		$vals="$uID,'$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[comp]','$_POST[adrs]','$_POST[town]','$_POST[fax]'";

		$vals.=",'$_POST[mfon]','$_POST[sfon]','$_POST[zcod]'";

		$isInup = $db->insert($cols,$vals,'invoice');		

	}else{

		$cols="inv_fname='$_POST[fname]',inv_lname='$_POST[lname]',inv_email='$_POST[email]'";

		$cols.=",inv_comp='$_POST[comp]',inv_adrs='$_POST[adrs]',inv_twn='$_POST[town]'";

		$cols.=",inv_fax='$_POST[fax]',inv_mbl='$_POST[mfon]',inv_fon='$_POST[sfon]',inv_zcod='$_POST[zcod]'";

		$isInup = $db->update($cols,"invoice","user_id=$uID");			

	}

	

	if($isInup){

			return msg('sec',"Invoice Updated Successfully...");	

	}else{

			return msg('err',"Invoice Updation Error!");

	}

}



function tCecks(){

	$db = new DB();

	$checks = $db->select("checks","COUNT(checks_id) cnt");

	$checks = mysql_fetch_array($checks);

	return $checks['cnt'];

}





function subBsEdt(){

	$db = new DB();

	$date = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];

	$recdate = $_POST['rcyear'].'-'.$_POST['rcmonth'].'-'.$_POST['rcday'];

	$uCols="v_recdate='$recdate',emp_id='$_POST[vid]',v_name='$_POST[vname]',v_nic='$_POST[vnic]',v_ftname='$_POST[vfname]'";

	$uCols.=",v_dob='$date',com_id=$_REQUEST[comId],v_refid='$_POST[refid]',v_imp=$_REQUEST[imp]";	

	$isUps = $db->update($uCols,"ver_data","v_id=$_POST[id]");

	if($isUps){

		addActivity('case',"$_POST[vname]",$LEVEL,'',$_POST['id'],'','edit');

		msg('sec',"Updated [ $_POST[vname] ] Successfully...");

		return true;	

	}

	 msg('err',"Upddation [ $_POST[vname] ] Error!");

		

	return false;

}

function get_orderchecks(){
		if(isset($_REQUEST['cid']) && is_numeric($_REQUEST['cid'])){
			$db = new DB();
			$checks = $db->select("checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id","*","cc.com_id=$_REQUEST[cid] AND ck.is_active=1");?>
			
          <div class="">
						<ul class="block content_accordion ui-accordion ui-widget ui-helper-reset" style="opacity:1">
			<?php
                if(mysql_num_rows($checks)>0){
                    while($check = mysql_fetch_assoc($checks)){ ?>
						<li class="ui-accordion-li-fix">
                            <h3 class="bar ui-accordion-header ui-helper-reset ui-state-active ui-corner-top">
                                <input type="checkbox" name="checks[]" value="<?=$check['checks_id']?>" checked="checked" />
                                <input class="input" type="hidden" name="cost<?=$check['checks_id']?>" value="<?=$check['clt_cost']?>" />
                                <?=$check['checks_title']?>
                            </h3>
                            <?php if($check['checks_id']==1){?>
                            	<div  style="padding:2px;">
                               <div>
                                    <fieldset class="label_side">
        
                                        <label>Insufficient:</label>
        
                                        <div><input type="checkbox" name="status<?=$check['checks_id']?>" /></div>
        
                                    </fieldset>
                                    
                                    <fieldset class="label_side">
                                            <label>University:</label>
                                            <div>
                                                <select name="univ" class="select_box etitle" title="Select university">
                                                    <option value="0" >--Select University--</option>
													<?php							
                                                    $unies = $db->select("uni_info","*","1=1 ORDER BY uni_Name"); 
                                                    if(!isset($_REQUEST['univ'])) $_REQUEST['univ']='';          
                                                    while($uni =mysql_fetch_array($unies)){ ?>
                                                        <option value="<?=$uni['uni_id']?>" <?=($_REQUEST['univ']==$uni['uni_id'])?'selected="selected"':''?>>
                                                        <?=trim($uni['uni_Name'])?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </fieldset>                                                           
                               		
                               		
                               </div>
                              
                            </div>
                            <?php }?>
                        </li>          
              <?php }
                }else{ ?>
                    <li>
                    	<h3 class="bar">No Component Found</h3>
                   </li>
			 <?php	} ?>
  						</ul>
            </div>
			<?php
		}
}
function get_client_orderchecks($com_id){
		if($com_id != 0 && is_numeric($com_id)){
			$db = new DB();
			$checks = $db->select("checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id","*","cc.com_id=$com_id AND ck.is_active=1");?>
			
			<?php
                if(mysql_num_rows($checks)>0){
					$cc=-1;
                    while($check = mysql_fetch_assoc($checks)){ 
					$cc++; ?>
                    <!--- Components  Start---->
                    <div class="progress-bar-parent">
                             	<h4 class="section-title"><?=$check['checks_title']?> 
                                

                                </h4>
                             	
									
								<?php /* <div class="form-group">
                                  
                                    <div>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                          <div class="input-group">
                                            <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                            <span class="input-group-addon btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>
                                            <a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                          </div>
                                        </div>
                                    </div>
                                </div> */?>
								
								
								<div class="container">

								<span class="btn btn-success fileinput-button">
									<i class="glyphicon glyphicon-plus"></i>
									<span>Add files...</span>
									<!-- The file input field used as target for the file upload widget -->
									<input id="inputFile_<?=$cc?>" class="fileupload" type="file" name="files[]" multiple >
									<input id="checks_id_<?=$cc?>" value="<?=$check['checks_id']?>" type="hidden" >
									
								</span>
								<br>
								<br>
								<!-- The global progress bar -->
								<div id="progress_<?=$cc?>" class="progress">
									<div class="progress-bar progress-bar-success custom_cls_<?=$cc?>"></div>
								</div>
								<!-- The container for the uploaded files -->
								<div id="files_<?=$cc?>" class="files"></div>
								<br>
								
							</div>

									
									
									
									
									
									
									
                             	
                             	
                             		
                                <div class="clearFix"></div>
                                <?php /*?><?php if($check['checks_id']==1){?>
                            	<div  style="padding:2px;">
                               <div>
                                    <fieldset class="label_side">
        
                                        <label>Insufficient:</label>
        
                                        <div><input type="checkbox" name="status<?=$check['checks_id']?>" /></div>
        
                                    </fieldset>
                                    
                                    <fieldset class="label_side">
                                            <label>University:</label>
                                            <div>
                                                <select name="univ" class="select_box etitle" title="Select university">
                                                    <option value="0" >--Select University--</option>
													<?php							
                                                    $unies = $db->select("uni_info","*","1=1 ORDER BY uni_Name"); 
                                                    if(!isset($_REQUEST['univ'])) $_REQUEST['univ']='';          
                                                    while($uni =mysql_fetch_array($unies)){ ?>
                                                        <option value="<?=$uni['uni_id']?>" <?=($_REQUEST['univ']==$uni['uni_id'])?'selected="selected"':''?>>
                                                        <?=trim($uni['uni_Name'])?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </fieldset>                                                           
                               		
                               		
                               </div>
                              
                            </div>
                            <?php }?><?php */?>
                      </div>
                      <!--- Components End---->
						          
              <?php }
                }else{ ?>
                   <div class="progress-bar-parent">
                   		<span>No Component Found!</span>
                   	<div class="clearFix"></div>
                   </div>
			 <?php	} ?>
			<?php
		}
}

function get_case_id(){
	if(isset($_REQUEST['cid']) && is_numeric($_REQUEST['cid'])){
		return  orderCode($_REQUEST['cid'],'01');
	}
}

function add_check_case($VID){
	$db = new DB();
	$uID = $_SESSION['user_id'];
	if(isset($_REQUEST['checks']) && is_array($_REQUEST['checks'])){
		foreach($_REQUEST['checks'] as $check){
			if(is_numeric($check)){
				$cost = (isset($_REQUEST["cost$check"]))?trim($_REQUEST["cost$check"]):0;
				if(!is_numeric($cost)) $cost = 0;
				$location = (isset($_REQUEST["location$check"]))?trim($_REQUEST["location$check"]):171; 
				if(!is_numeric($location)) $location = 171;
				
				$bCode = cBCode(0,0,$VID,$check);
				$cols  ="as_bcode,v_id,checks_id,as_uadd,as_addate,as_cost,country_id";
				$values="'$bCode',$VID,$check,$uID,CURRENT_TIMESTAMP,$cost,$location";
				
				if($check==1){
					if(isset($_REQUEST["status$check"])){
						$cols  ="$cols,as_status";
						$values="$values,'Problem'";
					}
					
					if(is_numeric($_REQUEST["univ"])){
						$cols  ="$cols,as_uni";
						$values="$values,$_REQUEST[univ]";
					}
				}
				if(!$db->insert($cols,$values,"ver_checks")) msg('err',"Check insertion error!");
				
			}
		}
	}
									
}

function subBasic(){
	
	$db = new DB();

	$uID = $_SESSION['user_id'];
	
	$_REQUEST['imp'] = isset($_REQUEST['imp'])?1:0;
	
	if(is_numeric($_REQUEST['comId'])){

		if(is_numeric($_REQUEST['id'])){

			return subBsEdt();

		}

		if(!is_numeric($_REQUEST['vid'])){
			 msg('err',"Please input valid employ ID!");
			return false;
		}		

		$comID = $_REQUEST['comId'];

		$_POST['vnic'] = trim($_POST['vnic']);

		if($_POST['vnic']=='' || $_POST['vnic']=='NA' || $_POST['vnic']=='N/A'){ 
			$where = "com_id=$comID AND emp_id='$_POST[vid]'";
		}else{
			$where = "com_id=$comID AND (v_nic='$_POST[vnic]' OR emp_id='$_POST[vid]')";
		}

		$uInfo = $db->select("ver_data","COUNT(v_id) cnt",$where);

		$uInfo = mysql_fetch_array($uInfo);

		if($uInfo['cnt']==0){

			$date = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];

			$recdate = $_POST['rcyear'].'-'.$_POST['rcmonth'].'-'.$_POST['rcday'];

			$_POST['vid'] = ($_POST['vid']=='')?'(NULL)':$_POST['vid'];

			$cols="v_recdate,v_bcode,emp_id,v_name,v_nic,v_ftname,v_dob,com_id,v_uadd,v_refid,v_imp";

			$bCode = orderCode($comID);

			$vals="'$recdate','$bCode','$_POST[vid]','$_POST[vname]','$_POST[vnic]','$_POST[vfname]','$date',$comID,$uID,'$_POST[refid]',$_REQUEST[imp]";

			$isIns = $db->insert($cols,$vals,'ver_data');

			if($isIns){

				global $LEVEL;

				$vID = $db->insertedID;
				
				add_check_case($vID);
				
				msg('sec',"Case added [ $_POST[vname] ] Successfully...");

				addActivity('case',"$_POST[vname]",$LEVEL,'',$vID,'','add');
				
				header("location:".SURL."?action=case&atype=add/edit&case=$vID");
				exit();
				return $vID;

			}else{

				 msg('err',"Case adding [ $_POST[vname] ] Error!");

				

			}

		}else{

			 msg('err',"This candidate is already exist [ $_POST[vname] ]!");

			

		}

	}else{

		 msg('err',"Please Select a Company Name !");

		

	}

	return false;

}


// added by khl
function addCaseByClient(){
	$db = new DB();

	$uID = $_SESSION['user_id'];
	$user_id = $_SESSION['user_id'];
	$user_info = getUserInfo($user_id);
	$com_id = $user_info['com_id'];
	
	$_REQUEST['imp'] = isset($_REQUEST['imp'])?1:0;
	
	if(is_numeric($com_id)){

		if(is_numeric($_REQUEST['id'])){

			return subBsEdt();

		}

			

		$comID = $com_id;

		$_POST['vnic'] = trim($_POST['vnic']);

		if($_POST['vnic']!='' || $_POST['vnic']!='NA' || $_POST['vnic']!='N/A'){ 
		 $where = "com_id=$comID AND v_nic='$_POST[vnic]'";
		}

		$uInfo = $db->select("ver_data","COUNT(v_id) cnt",$where);

		$uInfo = mysql_fetch_array($uInfo);

		if($uInfo['cnt']==0){

			$date = ($_POST['v_dob'])?$_POST['v_dob']:$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];

			$recdate = $_POST['rcyear'].'-'.$_POST['rcmonth'].'-'.$_POST['rcday'];
		
			
			

			$cols="v_recdate,v_bcode,v_name,v_nic,v_ftname,v_dob,com_id,v_uadd,v_imp";

			$bCode = orderCode($comID);

			$vals="'$recdate','$bCode','$_POST[vname]','$_POST[vnic]','$_POST[vfname]','$date',$comID,$uID,$_REQUEST[imp]";

			$isIns = $db->insert($cols,$vals,'ver_data');

			if($isIns){

				global $LEVEL;

				$vID = $db->insertedID;
				
				add_check_case($vID);
				
				
				
				$temp = explode(".",$_FILES["v_image"]["name"]);
				$fPath = 'files/candidates/';
				$newfilename = rand(1,99999) ."_". $vID . '_candidate.'.end($temp);
				
				$fullPath = $fPath . $newfilename;
			
				if(move_uploaded_file($_FILES["v_image"]["tmp_name"], $fullPath)){							
					
					$uCols = "image='".$fullPath."'";
					$db->update($uCols,"ver_data","v_id=".$vID);
					
				}
				
				
				
				
				msg('sec',"Case added [ $_POST[vname] ] Successfully...");

				addActivity('case',"$_POST[vname]",$LEVEL,'',$vID,'','add');
				
				header("location:".SURL."?action=add&atype=newcase&case=$vID");
				exit();
				return $vID;

			}else{

				 msg('err',"Case adding [ $_POST[vname] ] Error!");

				

			}

		}else{

			 msg('err',"This candidate is already exist [ $_POST[vname] ]!");

			

		}

	}else{

		 msg('err',"Please Select a Company Name !");

		

	}

	return false;

}





function addActivity($aType,$aInfo,$level,$aURL='',$vID='',$asID='',$action=''){

	if(isset($_SESSION['user_id'])){

		$db = new DB();

		$aInfo = addslashes($aInfo);

		$uID = $_SESSION['user_id'];

		$cols = 'user_id,a_type,a_info,level,a_actn';

		$vals = "$uID,'$aType','$aInfo',$level,'$action'";

		if($aURL!='') {$cols = $cols.',a_url';  $vals="$vals,'$aURL'";}

		if($vID!='') {$cols = $cols.',v_id';  $vals="$vals,$vID";}

		if($asID!=''){$cols = $cols.',ext_id'; $vals="$vals,$asID";}

		$db->insert($cols,$vals,'activity');

	}

}



function logout(){

	if(isset($_SESSION['user_id'])){

		$db = new DB();

		$uID = $_SESSION['user_id'];

		$db->insert('user_id,type',"$uID,'logout'",'activity');

		session_destroy();

	}

}



function case_access($level){

	$db = new DB();

	if(is_numeric($_REQUEST['case'])){

		$tbl = "ver_checks";

		switch($level){
			
			case 1:

				if(!isset($_REQUEST['ascase'])) $tbl = "ver_data";

				$where = "v_id=$_REQUEST[case]";	

			break;

			case 2:

				if(!isset($_REQUEST['ascase'])) $tbl = "ver_data";

				$where = "v_id=$_REQUEST[case]";	

			break;

			case 3:

				$where = "(v_id=$_REQUEST[case] AND user_id=$_SESSION[user_id]) AND user_id IS NOT NULL";

				if($_REQUEST['action']=='case' || $_REQUEST['ePage']=='addchecks'){

					$where = "v_id=$_REQUEST[case]";

					$tbl = "ver_data";

				}

			break;

			case 4:

				$coInfo = companyInfo($_SESSION['user_id']);

				$where = "(v_id=$_REQUEST[case] AND com_id=$coInfo[id])";

				$tbl = "ver_data";

			break;
			case 10:

				$coInfo = companyInfo($_SESSION['user_id']);

				$where = "(v_id=$_REQUEST[case])";

				$tbl = "ver_data";

			break;


			case 5:

				$cas_no=$db->select("ver_data","v_id","v_uadd=$_SESSION[user_id]");	

				$cas_number=mysql_fetch_array($cas_no);

				if($cas_number['v_id']==$_REQUEST['case']){

					$where = "v_id=$_REQUEST[case]";

					$tbl = "ver_data";

				}else return false;

			break;			

		}

		

		

		if(isset($where)){

			$verChecks = $db->select($tbl,"COUNT(v_id) cnt",$where);

			$verChecks = mysql_fetch_array($verChecks);

			if($verChecks['cnt']>0) return true;

		}

	}

	return false;

}



function  edData($verData,$action,$uCols=''){

	$db = new DB();	

	$data = $db->select("add_data","*","d_id=$verData AND d_isdlt=0");

	$data = mysql_fetch_array($data);

	if($data['d_stitle']!='') $title=$data['d_stitle']; else $title=$data['d_mtitle'];

	switch($action){

		case 'delete':

				$isdlt = $db->update("d_isdlt=1","add_data","d_id=$verData AND d_isdlt=0");

		 		if($isdlt){

					if(isFile($data['d_type'])){

						msg('sec',"File Deleted [ $title ] Successfully...");

						

					}else{

						msg('sec',"Field Deleted Successfully...");

						

					}

					addActivity('data',$title,0,'',$verData,$data['as_id'],'delete');

				}else{

					msg('sec',"Field Deleted Successfully...");	

					

				}

		return $isdlt;

		case 'edit':

				if($uCols!=''){

					$uVals="d_mtitle='$data[d_mtitle]',d_stitle='$data[d_stitle]',d_value='$data[d_value]'";

					$isUp =  $db->update($uCols,"add_data","d_id=$verData AND d_isdlt=0");

					if($isUp){

						addActivity('data',$uVals,0,'',$verData,$data['as_id'],'edit');

						msg('sec',"Field Updated Successfully...");	

											

					}

					return $isUp;

				}

		break;		

	}

}



function isFile($key){

	$db = new DB();

	$data = $db->select("fields_maping","in_id","fl_key='$key'");

	$data = mysql_fetch_array($data);

	if($data['in_id']==5){

		return true;	

	}

	return false;

}



function updateCheck($verID,$uCols,$typ='Updated'){

	$db = new DB();
	global $COMINF,$LEVEL;
	
	if(isset($_SESSION['user_id'])){
	$uID = $_SESSION['user_id'];
	$UserInfo = getUserInfo($uID);
	$fullName = $UserInfo['first_name']." ".$UserInfo['last_name'];
	}else{
	$lev = getLevel($LEVEL);
	$fullName = $lev['level_name'];
	}

	$isUp =  $db->update($uCols,"ver_checks","as_id=$verID");
	$asInfo = getCheck(0,0,$verID);
	$vInfo = getVerdata($asInfo['v_id']);
	$company_id = (int) $vInfo['com_id'];
	$comInfo = getcompany($company_id);
	$comInfo = @mysql_fetch_array($comInfo);
	if(!$isUp){

		msg('err',"Updation Error!");

		

		return false;	

	}
	
	$a_info = "Check $typ  by ".$fullName." ( $comInfo[name] ) of candidate <a href=\"".SURL."?action=details&case=$asInfo[v_id]&_pid=81#check_tab_$verID\">$vInfo[v_name]</a>";
	$notify = createNotifications(4,$a_info,$asInfo['v_id'],'','','',$verID);

	

	return true;	

}



function updateData($vID,$uCols,$typ="Updated"){
	global $LEVEL;
	$db = new DB();
	
	if(isset($_SESSION['user_id'])){
	$uID = $_SESSION['user_id'];
	$UserInfo = getUserInfo($uID);
	$fullName = $UserInfo['first_name']." ".$UserInfo['last_name'];
	}else{
	$lev = getLevel($LEVEL);
	$fullName = $lev['level_name'];
	}
	
	$isUp = $db->update($uCols,"ver_data","v_id=$vID");
	$vInfo = getVerdata($vID);
	$company_id = (int) $vInfo['com_id'];
	$comInfo = getcompany($company_id);
	$comInfo = @mysql_fetch_array($comInfo);
	if(!$isUp){

		$_REQUEST['ERR']= msg('err',"Updation Error!");

		

		return false;	

	}

	$a_info = "Case $typ  by ".$fullName." ( $comInfo[name] ) of candidate <a href=\"".SURL."?action=details&case=$vID&_pid=81\">$vInfo[v_name]</a>";
	$notify = createNotifications(4,$a_info,$vID);

	return true;

}





function insertFile($vid,$asid,$stitle,$aType,$sdir='proof/'){

	if ($_FILES[$aType]["error"] <= 0){

		$len = strlen($_FILES[$aType]["name"]);
		
		$ext = strtolower(substr($_FILES[$aType]["name"],($len-4)));
		//msg('err',"Your file type is $ext");
		$fName = $_FILES[$aType]["name"];
		if($ext=='.jpg' || $ext=='jpeg'){

			$db = new DB();

			$comid = $db->select("ver_data","com_id","v_id=$vid");

			$comid = mysql_fetch_array($comid);

			$comid = $comid['com_id'];

			$path = $db->select("company","path","id=$comid");

			$path = mysql_fetch_array($path);

			$path = $path['path'];

			$indx=rand(10,99).strtoupper(get_rand_val(10)).rand(10,99);

			$fPath = $path.$sdir.$vid."-$indx.jpg";

			$fName = $_FILES[$aType]["name"];

			if(move_uploaded_file($_FILES[$aType]["tmp_name"], $fPath)){

				if(attachment($asid,$fName,$stitle,$aType,$fPath)){

					msg('sec',"File Uploaded Successfully [ $fName ]...");

					return true;

				}

			}

		}else{

			msg('err',"Only jpg or jpeg File is allowed! [ $fName ]");

			return false;	

		}

	}

}



function attachment($asid,$fname,$stitle,$aType,$path){

	$db = new DB();

	$uID = $_SESSION['user_id'];

	$stitle = htmlspecialchars(trim($stitle));

	return $db->insert("as_id,d_mtitle,d_stitle,d_type,d_value,user_id","$asid,'$fname','$stitle','$aType','$path',$uID","add_data");

}



function vStatus($asCase,$vstatus){

	$db = new DB();

	$isInsUpd = $db->update("as_vstatus='$vstatus'","ver_checks","as_id=$asCase");

}



function caseStatus($asCase,$CaseStatus){

	$db = new DB();
	$uID = (int) $_SESSION['user_id'];
	if($CaseStatus == 'Close'){
		$isInsUpd = $db->update("post_tag=1,as_status='$CaseStatus',as_qastatus='QA',as_qcdate=CURRENT_TIMESTAMP","ver_checks","as_id=$asCase");
		$db->insert("as_id,user_id,qa_status","$asCase,$uID,'QA'",'qa_logs');
	}else{
		$isInsUpd = $db->update("post_tag=1,as_status='$CaseStatus'","ver_checks","as_id=$asCase");
		}

	return $isInsUpd;

}



function check_login(){

	$db = new DB();

	if(isset($_SESSION['user_id'])){

		$where = "user_id=".$_SESSION['user_id'];

		$UserLevel= $db->select("users","*",$where);

		if(mysql_num_rows($UserLevel)>0){

			return true;

		}

	}

	return false;

}



function get_level(){

	if(isset($_SESSION['user_id'])){

		$db = new DB();

		$UserLevel= $db->select("users","level_id","user_id=".$_SESSION['user_id']);

		$UserLevel = mysql_fetch_array($UserLevel);

		return $UserLevel['level_id'];

	}

	return false;

}



function adddata($face=0,$nStp=true,$sdir=''){

	$db = new DB();
 
	$isInsUpd=false;
	$reqatt=0;

	$uID = $_SESSION['user_id'];

	$checkInf = getCheck(0,0,$_REQUEST['ascase']);

	if(is_array($checkInf)){

		$tcheck = checkAction($checkInf['t_check']);
		
		if(is_array($tcheck)){

			if($face!=0) $tcheck['t_id']='';

			$fields = actionFields($tcheck['t_id'],$_REQUEST['check'],$face);	
			$error=0;$j=0;
			while($field1 = mysql_fetch_array($fields)){
					if($field1['is_req']==1 && $field1['is_multy']==0 && $field1['in_id']==1){
						if(trim($_REQUEST[$field1['fl_key']])==''){msg('err','Please Provide Info For  [ '.$field1['fl_title'].' ]!'); $error=1;}
					}
					if($checkInf['checks_id']==1 && $tcheck['t_check']==0  && $_REQUEST['byonline']!='Yes' && $j==1 && $_FILES['refer_letter']['name']==''){
						msg('err','Please Attach Reference Letter!'); //$error=1;
						$reqatt=1;
						
					}
					$j++;
			}$fields = actionFields($tcheck['t_id'],$_REQUEST['check'],$face);
			if(mysql_num_rows($fields)>0){

				 $db->update("v_itdate=CURRENT_TIMESTAMP","ver_data","v_id=$_REQUEST[case] AND v_itdate IS NULL");
					//$dataforemail = '';
					
					 addActivity('data',"Progress updated by ".SUDONYMS,0,'',$_REQUEST['case'],$_REQUEST['ascase'],'edit');
					
					//addActivity($aType,$aInfo,$level,$aURL='',$vID='',$asID='',$action=''){

					$i=1;
				while($field = mysql_fetch_array($fields)){	
				if($error==0){
					if($checkInf['checks_id']==1 && $tcheck['t_check']==0 && $i==1 && $_REQUEST['byonline']!='Yes'){
							$ch = curl_init();
					   $query_string="roll_num=".$_REQUEST['roll_num']."&uni_Name=".$_REQUEST['vuni']."&pass_year=".$_REQUEST['pass_year']."
					   &pass_year=".$_REQUEST['pass_year']." &checkid=".$_REQUEST['ascase']."&_pid=".$_REQUEST['_pid']."";
						curl_setopt($ch, CURLOPT_URL,"http://one.backcheckgroup.com/edu_api/edu_api.php");
						// Set a referer
					   curl_setopt($ch, CURLOPT_HEADER, FALSE);
						// Should cURL return or print out the data? (true = return, false = print)
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
						// Download the given URL, and return output
						$output = curl_exec($ch);
						// Close the cURL resource, and free system resources
						curl_close($ch);			
								$uniname=$_REQUEST['vuni'];
							$uninfo_arr = $db->select("uni_info","*","uni_Name = '".mysql_real_escape_string($uniname)."' AND uni_ddr=1 AND uni_fee>0 LIMIT 1");
							
							if(mysql_num_rows($uninfo_arr)>0){
							$uniinfo=mysql_fetch_array($uninfo_arr);
							$dd_code=mysql_query("select *  from  dd_data where dd_bcode='".$checkInf['as_bcode']."'");
							if(mysql_num_rows($dd_code)>0){
							$db->update("`dd_uni`='".$uniinfo['uni_id']."',`dd_bene`='".mysql_real_escape_string($uniinfo['uni_ben'])."',`dd_fee`
							='".$uniinfo['uni_fee']."'","dd_data","dd_bcode='".$checkInf['as_bcode']."'");
							}else{
							$db->insert("`dd_bcode`,`dd_dataflow`,`dd_user`,`dd_uni`,`dd_bene`,`dd_units`,`dd_fee`,`dd_cdate`,`dd_active`,`dd_status`","'".$checkInf['as_bcode']."','0','3','".$uniinfo['uni_id']."','".mysql_real_escape_string($uniinfo['uni_ben'])."','1','".$uniinfo['uni_fee']."','".date("Y-m-d H:i:s")."','1','1'","dd_data");
							}
							}else{
								$db->delete("dd_data","dd_bcode='".$checkInf['as_bcode']."'");
							}
							msg('sec','DD Generated');
							}

					if(strtolower($field['fl_key'])=="followup") $db->update("v_fdate=CURRENT_TIMESTAMP","ver_data","v_id=$_REQUEST[case] AND v_fdate IS NULL");

					

					if($field['fl_key']=='multy'){

						for($i=1;$i<=8;$i++){

							$ida="val$i";

							$idb="mtt$i";

							$idc="stt$i";

							$_REQUEST[$ida] = htmlspecialchars(trim($_REQUEST[$ida]));

							$_REQUEST[$idb] = htmlspecialchars(trim($_REQUEST[$idb]));

							$_REQUEST[$idc] = htmlspecialchars(trim($_REQUEST[$idc]));

							if(isset($_REQUEST[$idb])){

								if($_REQUEST[$idb]!=''){

									$where = "as_id=$checkInf[as_id] AND d_type='$field[fl_key]' AND d_num=$i";

									$data = $db->select("add_data","*","$where AND d_isdlt=0");

									if(mysql_num_rows($data)>0){

										$data = mysql_fetch_array($data);

										$uCols = "d_value='$_REQUEST[$ida]',d_mtitle='$_REQUEST[$idb]',d_stitle='$_REQUEST[$idc]'";
										
										$isInsUpd = $db->update($uCols,"add_data","$where AND d_isdlt=0");

										if($isInsUpd){

											$uVals="d_mtitle='$data[d_mtitle]',d_stitle='$data[d_stitle]',d_value='$data[d_value]'";

											addActivity('data',$uVals,0,'',$verData,$data['as_id'],'edit');

										}

										if(!$isInsUpd){

											msg('err','Updation Error [ $_REQUEST[val$i] ]!');

											

										}else $next=true;

									}else{

										$cols = "as_id,d_type,d_mtitle,d_stitle,d_value,d_num,user_id";

										$vals = "$checkInf[as_id],'$field[fl_key]','$_REQUEST[$idb]','$_REQUEST[$idc]','$_REQUEST[$ida]',$i,$uID";
										
										$isInsUpd = $db->insert($cols,$vals,"add_data");

										if(!$isInsUpd){

											msg('err','Insertion Error [ $_REQUEST[$ida] ]!');

											

										}

										$next=$isInsUpd;

									}

								}

							}

						}

					}

					

					if($field['in_id']==5){

						if(isset($_FILES[$field['fl_key']])){

							$_REQUEST['stitle']=isset($_REQUEST['stitle'])?$_REQUEST['stitle']:$field['fl_title'];

							insertFile($_REQUEST['case'],$checkInf['as_id'],"$_REQUEST[stitle]",$field['fl_key'],$sdir);

						}

					}

					

					if(isset($_REQUEST[$field['fl_key']])){

						$value =  htmlspecialchars(trim($_REQUEST[$field['fl_key']]));

						if($value!=''){

							$dCnt=0;

							if($field['fl_type']=='s'){

							if($field['is_multy']==0){

								$where = "as_id=$checkInf[as_id] AND d_type='$field[fl_key]'";

								$data = $db->select("add_data","*","$where AND d_isdlt=0");	

								$dCnt = mysql_num_rows($data);

								if($dCnt>0){

									$data = mysql_fetch_array($data);
									

									$isInsUpd = $db->update("d_value='$value'","add_data","$where AND d_isdlt=0");

									if($isInsUpd){
										$uVals="d_mtitle='$data[d_mtitle]',d_stitle='$data[d_stitle]',d_value='$data[d_value]'";

										addActivity('data',$uVals,0,'',$verData,$data['as_id'],'edit');

									}

									if(!$isInsUpd){

										msg('err','Updation Error [ $value ]!');

										

									}else $next=true;							

								}

							}

							if($dCnt == 0){						
								if($field['fl_key']=='followup'){
							$isInsUpd = $db->insert("as_id,d_type,d_value,user_id,d_mtitle","$checkInf[as_id],'$field[fl_key]','$value',$uID,'".$_REQUEST['followuptype']."'","add_data");
						}else{
								$isInsUpd = $db->insert("as_id,d_type,d_value,user_id","$checkInf[as_id],'$field[fl_key]','$value',$uID","add_data");
						}
$lastinsertedID_foremail = $checkInf['as_id'];


 $fvalues = $value;


/*if($field['fl_key'] == 'select_company')
	{
		$data = $db->select("comp_info","*","id = ".$value."");
		$companyinfo = mysql_fetch_array($data);
		 
		 
		$fvalues = $companyinfo['cname'];
	}	
	
 $dataforemail .= "<tr>
  	<td align=\"left\" width=\"40%\" colspan=\"3\">".$field['fl_title']." : ".$fvalues."</td>
  </tr>";*/
 
								if(!$isInsUpd){

									msg('err','Insertion Error! [ $checkInf[as_id] ]');

									

								}else{

									if($field['is_multy']==0) $next=true; else $next=false;

								}

							}

						}else{

							$isInsUpd = $db->update("$field[fl_key]='$value'","ver_checks","as_id=$checkInf[as_id]");	
							if(!$next && ($value=="No Record Found" || $value=="No Match Found")){
								$next=true;
							}
						}

						}

					}
					
				$i++;
				}
				}

				
//if($_REQUEST['check'] == 47)
//{    
//
// 
// 	$message .= "<table width=\"600\" border=\"0\" cellpadding=\"5\" style=\"margin:0 auto; border-spacing: 0px; border-radius: 10px 10px 0 0; overflow: hidden; font-family:Verdana, Geneva, sans-serif\" bgcolor=\"#f6f6f7\">  
//  
//  <tr>
//    <td align=\"left\" style=\"padding:13px;\" bgcolor=\"#747D7D\"><img src=\"".SURL."images/logo_email.png\" /></td>
//    <td align=\"left\" width=\"36%\" style=\"padding:20px;\" bgcolor=\"#747D7D\"><a href=\"".SURL."\" style=\"text-decoration:none; background-color: #444; padding: 8px 12px; line-height: 1; color: #fff; font-size: 14px; margin: 0; border-radius: 4px; text-align: center;\">Verification System</a></td>
//  </tr>
// 
//  <tr>
//  	<td align=\"center\" width=\"100%\" colspan=\"3\"><h3 style=\"color:#465059; padding:20px 0 0 0; margin:0;\">asdsadsadsad</h3></td>
//  </tr>";
//  
// // if($username!=""){
//  
//  
//  $message .= "<tr>
//  	<td align=\"center\" width=\"100%\" colspan=\"3\"><h3 style=\"font-weight:normal; color:#70bff3;\">Dear ata asd ,</h3></td>
//  </tr>";
// $message .= $dataforemail;
//  //}
//  $message .= "<tr>
//  	<td align=\"left\" width=\"40%\" colspan=\"3\">Please verify this information <a href=".SURL."preemp_verification_inc.php?id=".base64_encode($lastinsertedID_foremail).">Click Here</a></td>
//  </tr>";
// $message .= " <tr>
//  	<td bgcolor=\"#f6f6f7\" align=\"center\" width=\"100%\" colspan=\"3\" style=\"padding:20px 10px 50px 10px;\">$table</td>
//  </tr>
//  
//  <tr>
//  	<td align=\"center\" width=\"100%\" colspan=\"3\" bgcolor=\"#FFFFFF\"><p style=\"padding:5px 20px; color: #54565c; font-size:13px;\">If you need help or have any questions, please visit our <a href=\"".SURL."?action=adsupport&atype=support\" style=\"color:#fd4f00\"><span>Support</span></a>.</p></td>
//  </tr>
//  
//   <tr>
//  	<td align=\"center\" width=\"100%\" colspan=\"3\" bgcolor=\"#747D7D\"><p style=\"padding:5px 20px; color: #ffffff; font-size:13px;\"> &copy; 2007 - 2015 - All rights reserved | Powered by <a href=\"".COPYRIGHT_URL."\" style=\"color:#ffffff\">Background Check Pvt Ltd.</a> 
//	</td>
//	  </tr> 
//	  
//	  
//	  
//	</table>";
//$dataforemail.='';
//
//
//								   $mail             = new PHPMailer();
//								   $mail->IsSMTP(); // telling the class to use SMTP
//								   $mail->SMTPAuth   = true;                  // enable SMTP authentication
//								   $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
//								   $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
//								   $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
//								   $mail->Username   = "noreply@backcheckgroup.com";  // GMAIL username
//								   $mail->Password   = "kashif123";              // GMAIL password
//								   $mail->SetFrom('noreply@riskdiscovered.com');
//   
//   
//  /* if($bccMail!=''){
//	    $cces = explode(',',$bccMail);
//		if(count($cces)>0){
//		foreach($cces as $cc){
//			$mail->AddBCC($cc);
//			//echo "<br>bcc Mails:".$cc."<br>";
//		}
//		}else{
//			$mail->AddBCC($cces);
//		}
//	}
//	
//	if($cMail!=''){
//	    $cces = explode(',',$cMail);
//		if(count($cces)>0){
//		foreach($cces as $cc){
//			$mail->AddCC($cc);
//			//echo "<br>cc Mails:".$cc."<br>";
//		}
//		}else{
//			$mail->AddCC($cces);
//		}
//	} 
//   */
//   $mail->Subject    = $title;
//   $mail->MsgHTML($message);
//  //echo $message.'<br>'; exit;
//   $mail->AddAddress("ata@backgroundcheck.email");
//   $mail->Send();
//
//
//
////////////////////////////////
//
//
//}
//

				if($isInsUpd && $next && $nStp && $reqatt==0){

					npCheck($checkInf['as_id']);

				}

			}

		}

	}

}



function npCheck($asid,$pm='p'){

	$db = new DB();

	$tchk = getCheck(0,0,$asid);

	$tchk['t_check'] = ($pm=='p')?($tchk['t_check']+1):($tchk['t_check']-1);

	$isInsUpd = $db->update("t_check=$tchk[t_check],as_pdate=CURRENT_TIMESTAMP","ver_checks","as_id=$asid");

	return $isInsUpd;

}



function addExtCols($asID,$cols,$colAry,$eCols='',$eVals=''){

	$db = new DB();

	$isInserted = false;

	if($eVals!='') $eVals = ','.htmlspecialchars(trim($eVals));

	if($eCols!='') $eCols = ','.$eCols;

	$cols  = explode(',',$cols);

	foreach($cols as $col){

		$value = htmlspecialchars(trim($colAry[$col]));

		if($value!=''){

			$isInserted = $db->insert("as_id,d_type,d_value $eCols","$asID,'$col','$value' $eVals","add_data"); 

		}

	}

	return $isInserted;

}



function renderEdit($asId,$did){

	

}



function renderFields($field,$asID=''){

		$db = new DB();

		$input = $db->select("inputs","*","in_id=$field[in_id]" );

		$isReq = ($field['is_req']!=0)?" req $field[fl_cls]":'';

		if(mysql_num_rows($input)>0){

			$input = mysql_fetch_array($input);

			$chd='';

			if($field['is_multy']==0){

				if($field['fl_key']=='as_vstatus'){

					$data = getCheck(0,0,$_REQUEST['ascase']); $col='as_vstatus';	

				}else{				

					$data = getData($_REQUEST['ascase'],$field['fl_key']); $col='d_value';

					$data = mysql_fetch_array($data);

				}

				if($data[$col]!=''){

					$field['fl_dval']=$data[$col];

					if($input['in_type']=='checkbox'){

						//$chd='checked="checked"';

						return false;

					}

				}

			}

			if($input['in_type']=='checkbox'){

						//$chd='checked="checked"';
						$form_control = "chbox";

						

					}else{
						$form_control = "form-control";
					}

	if($input['in_type'] == "radio")
				{
				$options = $db->select("fldoptions","*","fl_key='$field[fl_key]' AND fl_op=$field[fl_op]" );
							//echo "fl_key='$field[fl_key]' AND fl_op=$field[fl_op]";
 							$radio = '';
							while($option = mysql_fetch_array($options)){
 								$sld='';
 								if($field['fl_dval']==$option['op_val']) $sld= 'selected="selected"';
 								$radio .="<input type=\"radio\" name=\"$option[fl_key]\" value=\"$option[op_val]\" $sld />$option[op_val] ";		
 							}		
 					return $radio;	 
 				}

			switch($input['in_name']){

				case'input':

					return "<input title=\"$field[fl_title]\" class=\"uniform $form_control $isReq\" type=\"$input[in_type]\" name=\"$field[fl_key]$asID\" value=\"$field[fl_dval]\" $chd />";

				case'textarea':

					$return='';
					if($field['fl_key']=='followup'){
						$return= '<div class="form-group"><select name="followuptype" class="select"><option value="Email">Email</option><option value="Call">Call</option><option value="Online">Online</option><option value="Courier">Courier</option><option value="Fax">Fax</option></select></div>';
			   }
					$return.= "<textarea title=\"$field[fl_title]\" rows=\"5\" class=\"input form-control $isReq\" name=\"$field[fl_key]$asID\">$field[fl_dval]</textarea>";
				return $return;

				case'select':

						$clkOp='';
						
						if($field['fl_op']==5){
							if(!isset($_REQUEST['ascase'])) $_REQUEST['ascase']=0;
							$options = $db->select("uni_info ORDER BY op_val","uni_Name op_val,uni_ac_url,uni_var,uni_url");
							$clkOp="onchange=\"showAdCheck(this,$_REQUEST[ascase])\"";
						}
								else if($field['fl_op']==6){
							//if(!isset($_REQUEST['ascase'])) $_REQUEST['ascase']=0;
							//$options = $db->select("comp_info ORDER BY id","cname,id");
						$options = $db->select("comp_info","cname op_val" );
							//$clkOp="onchange=\"showAdCheck(this,$_REQUEST[ascase])\"";
						}else{

							$options = $db->select("fldoptions","*","fl_key='$field[fl_key]' AND fl_op=$field[fl_op]" );
							//echo "fl_key='$field[fl_key]' AND fl_op=$field[fl_op]";
						}

						$select = "<select $clkOp title=\"$field[fl_title]\" class=\"select input form-control $isReq\" name=\"$field[fl_key]$asID\" >";

								$select .="<option value=\"0\" >--Select $field[fl_title]--</option>";

							while($option = mysql_fetch_array($options)){
								$sld='';
								if($field['fl_dval']==$option['op_val']) $sld= 'selected="selected"';
								if($option[op_val]=='Unable to Verify' || $option[op_val]=='Not Verified By Source' ){
									
								}else{
								$select .="<option value=\"$option[op_val]\" $sld >$option[op_val]</option>";	
								}
							}		
						$select .= "</select>";
					return $select;
			}	

		}

		return false;

}



function actionFields($tid='',$checkid,$face=0){

	$db = new DB();

	$checkid = getcheckP($checkid);

	if($tid!=''){

		$where = "(checks_id=$checkid AND t_id=$tid) AND fl_face=$face ORDER BY fl_ord";

	}else{

		$where = "(checks_id=$checkid AND fl_face=$face) ORDER BY fl_ord";		

	}
	//echo "select * from fields_maping where $where";
	$Fields = $db->select("fields_maping","*",$where);

	return $Fields;

}



function getcheckP($check){

	$tchInfo = getCheck($check,0,0);

	if($tchInfo['checks_pid']!=0){

		return $tchInfo['checks_pid'];

	}	

	return $check;

}



function checkAction($tcheck){

	$db = new DB();

	$check = getcheckP($_REQUEST['check']);
	$checkAction = $db->select("titles","*","checks_id=$check AND t_check=$tcheck");

	if(mysql_num_rows($checkAction)>0){

		return mysql_fetch_array($checkAction);		

	}

	return false;

}



function checkDetails($vid,$checkid='',$exCol=''){

	$db = new DB();

	$where='';

	if($checkid!=''){

		$where= "(checks_id=$checkid AND v_id=$vid)";

	}else{

		$where= "vd.v_id=$vid";

	}

	if($exCol!='') $where .= (($where!='')?" AND ":"").$exCol;

	$tbls="ver_checks vc INNER JOIN checks ck ON ck.checks_id=vc.checks_id INNER JOIN ver_data vd ON vd.v_id=vc.v_id";
//echo "$where AND as_isdlt=0 ORDER BY checks_title"; 
	$checksInfo = $db->select($tbls,"DISTINCT *","$where AND as_isdlt=0 ORDER BY checks_title");
	return $checksInfo;

}


function reportCheckDetails($vid,$checkid='',$exCol=''){
	global $COMINF,$LEVEL;
	$db = new DB();
	if($COMINF['id']){
		$col_com_id = " AND vd.com_id=$COMINF[id] ";
	}else{
		$col_com_id = "";
	}
	$where='';

	if($checkid!=''){

		$where= "(checks_id=$checkid AND v_id=$vid)";

	}else{

		$where= "vd.v_id=$vid";

	}

	if($exCol!='') $where .= (($where!='')?" AND ":"").$exCol;

	$tbls="ver_checks vc INNER JOIN checks ck ON ck.checks_id=vc.checks_id INNER JOIN ver_data vd ON vd.v_id=vc.v_id";

	$checksInfo = $db->select($tbls,"DISTINCT *","$where AND as_isdlt=0 $col_com_id ORDER BY checks_title");
	//echo "SELECT $tbls WHERE $where AND  as_isdlt=0 AND vd.com_id=$COMINF[id] ORDER BY checks_title <br />";
	return $checksInfo;

}

function searchCheckDetails($vid,$checkid='',$exCol=''){
	global $COMINF,$LEVEL;
	
	$db = new DB();
	if($COMINF['id']){
		$com_id = "AND vd.com_id=$COMINF[id]";
	}else{
		$com_id = "";
	}
	$where='';

	if($checkid!=''){

		$where= "(checks_id=$checkid AND v_id=$vid)";

	}else{

		$where= "vd.v_id=$vid";

	}

	if($exCol!='') $where .= (($where!='')?" AND ":"").$exCol;

	$tbls="ver_checks vc INNER JOIN checks ck ON ck.checks_id=vc.checks_id INNER JOIN ver_data vd ON vd.v_id=vc.v_id";

	$checksInfo = $db->select($tbls,"DISTINCT *","$where AND as_isdlt=0 ORDER BY checks_title");
	//echo "SELECT $tbls WHERE $where AND  as_isdlt=0 $com_id  ORDER BY checks_title <br />";
	return $checksInfo;

}
function QAreportCheckDetails($vid,$checkid='',$exCol=''){
	global $COMINF;
	$db = new DB();

	$where='';

	if($checkid!=''){

		$where= "(checks_id=$checkid AND v_id=$vid)";

	}else{

		$where= "vd.v_id=$vid";

	}

	if($exCol!='') $where .= (($where!='')?" AND ":"").$exCol;

	$tbls="ver_checks vc INNER JOIN checks ck ON ck.checks_id=vc.checks_id INNER JOIN ver_data vd ON vd.v_id=vc.v_id";

	$checksInfo = $db->select($tbls,"DISTINCT *","$where AND as_isdlt=0  ORDER BY checks_title");
	//echo "SELECT $tbls WHERE $where AND  as_isdlt=0 AND vd.com_id=$COMINF[id] ORDER BY checks_title <br />";
	return $checksInfo;

}



function mkValues($colAry,$cols){

	$vals[0]='';

	$vals[1]='';

	$cols  = explode(',',$cols);

	foreach($cols as $col){

		if($colAry[$col]!=''){

			$vals[0] .= (($vals[0]!='')?',':'')."'".$colAry[$col]."'";

			$vals[1] .= (($vals[1]!='')?',':'').$col;

		}

	}

	return $vals;

}



function addChecks($level=''){

	$db = new DB();

	$uID = $_SESSION['user_id'];

	$vid = $_REQUEST['case'];



		$cols="v_id,as_uadd,as_addate,checks_id";

		$vals="$vid,$uID,CURRENT_TIMESTAMP,";

		if(is_numeric($_REQUEST['uid']) && $_REQUEST['uid']!=0){

			$isThere = $db->select("ver_data","v_status","v_id=$vid AND v_status='Not Assign'");

			if(mysql_num_rows($isThere)>0){

				$cols= "user_id,as_date,$cols";

				$vals= "$_REQUEST[uid],CURRENT_TIMESTAMP,$vals";	

				$isInsUpd = $db->update("v_status='Open'","ver_data","v_id=$vid");			

			}else{

				$cols= "user_id,as_status,as_date,$cols";

				$vals= "$_REQUEST[uid],'Open',CURRENT_TIMESTAMP,$vals";

			}

		}

		foreach($_REQUEST['checks'] as $check){

			$checkInfo = getCheck($check);

			if($checkInfo['is_multi']==0){

				$isThere = $db->select("ver_checks","COUNT(checks_id) cnt","checks_id=$check AND v_id=$vid");

				$isThere = mysql_fetch_array($isThere);

			} else{

				 unset($isThere);

				 $isThere['cnt'] = 0;

			}

			if($isThere['cnt']<=0){

				$bCode = cBCode(0,0,$vid,$check);

				$isInserted = $db->insert("as_bcode,$cols","'$bCode',$vals".$check,"ver_checks");

				if($isInserted ){

					$isInsUpd = $db->update("v_sent=2","ver_data","v_id=$vid AND v_status='Close'");

					msg('sec',"Checks Inserted [ $checkInfo[checks_title] ] Successfully...");

				}else{

					msg('err',"Check Insertion Error! [ $checkInfo[checks_title] ]");

				} 

			}else{

					msg('err',"The Check [ $checkInfo[checks_title] ] is already added to this case!");

			}

		}	

}



function isMcheck($cID){

	$db = new DB();

	$check = $db->select("checks","is_multi","checks_id=$cID");

	$check = mysql_fetch_array($check);

	if($check['is_multi']==1) return true;

	return false;

}



function counChecks($vid){

	$db = new DB();

	$counChecks = $db->select("ver_checks","COUNT(checks_id) cnt","v_id=$vid");

	$counCheck = mysql_fetch_array($counChecks);

	return $counCheck['cnt'];

}



function getFields($checkID,$vid){

		$db = new DB();

		$tbls= "fields_maping fm INNER JOIN `fields` fl ON fm.fl_id=fl.fl_id";

		$cols = "fl.fl_key,fl.fl_title,fl.fl_fcs";

		$fieldsInfo = $db->select($tbls,$cols,"checks_id=$checkID");

		$cols='';

		if(mysql_num_rows($fieldsInfo)>0){

			while($field = mysql_fetch_array($fieldsInfo)){	

				$cols.=(($fields!='')?',':'').$field['fl_key'];

				

			}

			$data = $db->select("ver_data",$cols,"v_id=$vid");

			$data = mysql_fetch_array($data);

		echo $data;

		die;				

		}	

}



function getCheck($checkID=0,$vid=0,$asID=0){

		$db = new DB();

		if($asID!=0){

			$verChecks = $db->select("ver_checks","*","as_id=$asID");

			if(mysql_num_rows($verChecks)>0){

				return	mysql_fetch_array($verChecks);

			}

		}else if($vid!=0 && $checkID!=0){

			$verChecks = $db->select("ver_checks","*","v_id=$vid AND checks_id=$checkID");

			if(mysql_num_rows($verChecks)>0){

				return	$verChecks;

			}

		}else if($vid!=0){

			$verChecks = $db->select("ver_checks","*","v_id=$vid AND as_isdlt=0");

			if(mysql_num_rows($verChecks)>0){

				return	$verChecks;

			}

		}else if(is_numeric($checkID)){

			$check = $db->select('checks','*',"checks_id=$checkID");

			if(mysql_num_rows($check)>0){

				return	mysql_fetch_array($check);

			}

		}

		return false;

}
function sendcurlrequest($postfields,$url){
 $query_string = "";
 foreach ($postfields AS $k=>$v) $query_string .= "$k=".urlencode($v)."&";

 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_TIMEOUT, 30);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $xml = curl_exec($ch);
  curl_close($ch);
  return $xml;
 }
 function whmcsapi_xml_parser($rawxml) {
 	$xml_parser = xml_parser_create();
 	xml_parse_into_struct($xml_parser, $rawxml, $vals, $index);
 	xml_parser_free($xml_parser);
 	$params = array();
 	$level = array();
 	$alreadyused = array();
 	$x=0;
 	foreach ($vals as $xml_elem) {
 	  if ($xml_elem['type'] == 'open') {
 		 if (in_array($xml_elem['tag'],$alreadyused)) {
 		 	$x++;
 		 	$xml_elem['tag'] = $xml_elem['tag'].$x;
 		 }
 		 $level[$xml_elem['level']] = $xml_elem['tag'];
 		 $alreadyused[] = $xml_elem['tag'];
 	  }
 	  if ($xml_elem['type'] == 'complete') {
 	   $start_level = 1;
 	   $php_stmt = '$params';
 	   while($start_level < $xml_elem['level']) {
 		 $php_stmt .= '[$level['.$start_level.']]';
 		 $start_level++;
 	   }
 	   $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
 	   @eval($php_stmt);
 	  }
 	}
 	return ($params);
 }
function validatelogin($email,$pass,$url){
 $username = "danish"; 
 $password = "Bcpl~123"; 
 $postfields = array();
 $postfields["username"] = $username;
 $postfields["password"] = md5($password);
 $postfields["action"] = "validatelogin";
 $postfields["email"] = $email;
 $postfields["password2"]=$pass;
 $postfields["responsetype"] = "xml";
 return sendcurlrequest($postfields,$url);
 }
 function addclient($email,$pass,$url,$infoarr){
 $username = "danish"; 
 $password = "Bcpl~123"; 
 $postfields = array();
  $postfields["action"] = "addclient"; 
   $postfields["username"] =  $username;
 $postfields["password"] = md5($password);
 $postfields["firstname"] = $infoarr['firstname'];
 $postfields["lastname"] = $infoarr['lastname'];
 $postfields["companyname"] = $infoarr['companyname'];
 $postfields["email"] = $email;
 $postfields["address1"] = $infoarr['address1'];
 $postfields["city"] = $infoarr['city'];
 $postfields["state"] = $infoarr['state'];
 $postfields["postcode"] = $infoarr['postcode'];
 $postfields["country"] = $infoarr['country'];
 $postfields["phonenumber"] =$infoarr['phonenumber'];
 $postfields["password2"] = $pass;
 $postfields["responsetype"] = "xml";
 $postfields["currency"] = $infoarr['currency'];
 return sendcurlrequest($postfields,$url);
 }


function doLogin(){

		$db = new DB();

		$user = addslashes($_POST['username']); 

		$pass = md5(md5($_POST['password'])); 

		

		$salt = $db->select('users','salt', "username='".$user."'");
 
		$salt = mysql_fetch_array($salt);
//echo $salt['salt']; die();
		$pass = md5(md5($_POST['password']).md5($salt['salt'])); 
		
		//echo "select * from users where username='".$user."' AND password='".$pass."'"; die();
		
		if(isset($_POST['pwd'])) $pass=$_POST['pwd']; else $pass=$pass;
		
		

		$userInfo = $db->select('users','*', "username='".$user."' AND password='".$pass."'");
		
		if(mysql_num_rows($userInfo) > 0){

			$userInfo = mysql_fetch_array($userInfo);

				if($userInfo['is_active'] == 1){ 
					if(is_numeric($userInfo['com_id'])){
						$clientInfo = $db->select('company','*', "id='".$userInfo['com_id']."'");
						$clientInfo=mysql_fetch_array($clientInfo);
						if($clientInfo['disabled_id']==1){
							return msg('err','System access temporary disabled due to non payment!');
						}
						$url = "https://backcheckgroup.com/support/includes/api.php";
						if($userInfo['level_id']==4){
							$xml=validatelogin($user,trim($_POST['password']),$url);
							 $arr = whmcsapi_xml_parser($xml); 
							 $apidata=$arr['WHMCSAPI'];
							 
							 if(trim($apidata['RESULT'])=='error'){
							 	    $infoarr['firstname']=$userInfo[first_name];
									$infoarr['lastname']=$userInfo[last_name];
									$infoarr['companyname']=$clientInfo['name'];								
									$infoarr['address1']="Karachi";
									$infoarr['city']='karachi';
									$infoarr['state']='Sindh';
									$infoarr['postcode']='12345';
									$infoarr['country']='PK';
									$infoarr['phonenumber']="923360321068";
									$infoarr['currency']='1';
								   $xml=addclient($user,trim($_POST['password']),$url,$infoarr);
								 $arr = whmcsapi_xml_parser($xml);
								 $apidata=$arr['WHMCSAPI'];		
								 if($apidata['RESULT']=='success'){
								  $db->updateCol('`whmcs_clid`',"".$apidata['CLIENTID']."",'users',"user_id=$userInfo[user_id]");
								 }						  
							 }
						}
					}
					$_SESSION['username'] = $userInfo['username'];

					$_SESSION['user_id'] = $userInfo['user_id'];

					$_SESSION['email'] = $userInfo['email'];

					$_SESSION['first_name'] = $userInfo['first_name'];

					$_SESSION['fname'] = $userInfo['first_name']." ".$userInfo['middle_name']." ".$userInfo['last_name'];

					$db->insert('user_id,a_type',"$userInfo[user_id],'login'",'activity');

					return true;

				}else{

					return msg('err','Your Account Has Been Blocked, Please Contact Admin!');	

				} 				

		}else{

			return msg('err','Invalid User Name or Password!');

		}

		return false;

}



function aplRegister(){

		$db = new DB();

		

		if($_POST['date'] == NULL){

			msg('err',"Please Enter Your Date of Birth!");

			

		}

		

		if($_POST['name'] == NULL){

			msg('err',"Please Enter Your Full Name!");

			

		}else{

			$name = explode($_POST['name']);

			$_POST['fname'] = $name[0];

			$_POST['lname'] = '';

			for($i=1;$i<count($name);$i++){$_POST['lname'] = trim("$_POST[lname] $name[$i]");}

		}

		

		if(!validateEmail($_POST['email'])){

			msg('err',"Please Enter Valid Email!");

			

		}else{

			$_POST['email'] = addslashes($_POST['email']);

			$userInfo = $db->select('users','user_id',"username='$_POST[email]'");	

			if(mysql_num_rows($userInfo) > 0){

				msg('err',"This email account is already registered!");

									

			}

		}

				



		if($_POST['address'] == NULL){

				$_POST['address']='';

		}



		if($_POST['nic'] == NULL){

				$_POST['nic']='';

		}			

			

			

		if($_REQUEST['ERR']==''){

			$cols ="first_name,last_name,email,username,password,salt,level_id,dofb,address";

			$_POST['passa'] = get_rand_val(8);

			$salt = get_rand_val(8);

			$pass = md5(md5($_POST['passa']).md5($salt));

			$vals = "'$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[email]','$pass','$salt',6,'$_POST[date]','$_POST[address]','$_POST[nic]'";

			$isRegister = $db->insert($cols,$vals,'users');

			if($isRegister){

				msg('sec',"User Registered [ $_POST[fname] $_POST[lname] ] Successfully...!");

									

				 return true;	

			}else{

				msg('err',"User Registration [ $_POST[fname] $_POST[lname] ] Error!");

									 

				return false;

			} 						 

		}

		return false;	

}





function doRegister(){

		$db = new DB();

		if($_POST['passa'] != $_POST['passb']){

			msg('err',"You have to type the same password for control!");

						

		}else{

			$_POST['email'] = addslashes($_POST['email']);

			

			if($_POST['fname'] == NULL){

				msg('err',"Please Enter First Name!");

				

			}

			

			if($_POST['lname'] == NULL){

				msg('err',"Please Enter Last Name!");

				

			}			

			

			if(!validateEmail($_POST['email'])){

				msg('err',"Please Enter Valid Email!");

				

			}else{

				$_POST['email'] = addslashes($_POST['email']);

				$userInfo = $db->select('users','user_id',"username='$_POST[email]'");	

				if(mysql_num_rows($userInfo) > 0){

					msg('err',"This email account is already registered!");

										

				}

			}

			

			if($_POST['passa'] == NULL){

					msg('err',"Please Enter Password!");

					

			}

			

			if($_POST['ulevel']== 0){

					msg('err',"Please Select User Level!");

					

			}

			$eCols=""; $eVals="";

			if($_POST['ulevel'] == 4){

				if($_POST['utype']== 0){

						msg('err',"Please Select Client Type!");

						

				}	

				if($_POST['com_id']== 0){

						msg('err',"Please Select Company!");

						

				}

				$eCols=",com_id,u_type";

				$eVals=",$_POST[com_id],$_POST[utype]";							

			}

			

			if($_REQUEST['ERR']==''){

				$cols ="first_name,last_name,email,username,password,salt,level_id$eCols";

				$salt = get_rand_val(8);

				$pass = md5(md5($_POST['passa']).md5($salt));

				$vals = "'$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[email]','$pass','$salt',$_POST[ulevel]$eVals";

				$isRegister = $db->insert($cols,$vals,'users');

				if($isRegister){

					msg('sec',"User Registered [ $_POST[fname] $_POST[lname] ] Successfully...!");

										

					 return true;	

				}else{

					msg('err',"User Registration [ $_POST[fname] $_POST[lname] ] Error!");

										 

					return false;

				} 						 

			}

		}

		return false;	

}



function getInfo($table,$where){

	$db = new DB();

	$data= $db->select($table,"*",$where);

	if(mysql_num_rows($data) >0){

			return mysql_fetch_array($data);

	}

	return false;

}



function getUserInfo($id='',$sec=''){

	$db = new DB();

	if($id!=''){

		$where = "user_id=$id";

	}else if($sec!=''){

		$where = "validation='$sec'";	

	}

	

	if(isset($where)){

		$user= $db->select("users","*",$where);

		if(mysql_num_rows($user) >0){

			return mysql_fetch_array($user);

		}

	}

	return false;

}



function addlevel(){

	global $db;	

	$uID = $_SESSION['user_id'];

	if(is_numeric($_POST['lid'])){

		$dCunt=0;

	}else{

		$data= $db->select("levels","*","level_name LIKE '$_POST[level]'");

		$dCunt = mysql_num_rows($data);

	}

	if($dCunt==0){

		if($_POST['level']!=''){

			$cols="level_name,level_desc,create_date,user_id";

			$vals="'$_POST[level]','$_POST[desc]',CURRENT_TIMESTAMP,$uID";

			if(is_numeric($_POST['lid'])){

				$isAddEdit = $db->updateCol($cols,$vals,'levels',"level_id=$_POST[lid]");

				$title='Edit';

			}else{

				$isAddEdit = $db->insert($cols,$vals,'levels');

				$title='Add';

			}

			if($isAddEdit){

				msg('sec',"Level [ $_POST[level] ] ".$title."ed Successfully...");					

				return true;	

			} 	msg('err',"Level [ $_POST[level] ] ".$title."ing Error !");

		}else{

			msg('err',"Please Input a Level Name !");				

		}

	}else{

		msg('err',"Level [ $_POST[level] ] is Already Added !");				

	} return false;

}



function getLevel($id){

	global $db;	

	$data= $db->select("levels","*","level_id=$id");

	if(mysql_num_rows($data) >0){

		return mysql_fetch_array($data);

	}	return false;	

}



function getLevelInfo($id){

	$db = new DB();

	$db->open();

	$user= $db->select("levels","*","level_id=$id");

	$user_info=mysql_fetch_assoc($user);

	return $user_info;

	

}





function msg($type,$strMsg){

	$msg='';

	switch($type){

		case 'sec':

			$msg .= '<div class="notification success">';

			$msg .= '<a class="close-notification" href="javascript:void(0)" onclick="closeMsg(this)" >x</a>';

			$msg .= '<p>'.$strMsg.'</p></div>';

			$_REQUEST['TSCS'][count($_REQUEST['TSCS'])]=$strMsg;

			$_REQUEST['SCS']=$_REQUEST['SCS'].$msg;

			$_REQUEST['CNT']=$_REQUEST['CNT']+1;

		break;

		case 'err':

			$msg .= '<div class="notification error">';

			$msg .= '<a class="close-notification" href="javascript:void(0)" onclick="closeMsg(this)">x</a>';

			$msg .= '<p>'.$strMsg.'</p></div>';

			$_REQUEST['TERR'][count($_REQUEST['TERR'])]=$strMsg;

			$_REQUEST['ERR']=$_REQUEST['ERR'].$msg;

			$_REQUEST['CNT']=$_REQUEST['CNT']+1;

		break;		

	}

}



function companyInfo($id){

		$db = new DB();

		$uInfo = $db->select("users","*","user_id=$id");

		if(mysql_num_rows($uInfo)>0){

			$uInfo = mysql_fetch_array($uInfo);

			if($uInfo['u_type']==1){

				$comInfo = getcompany($uInfo['com_id']);

				if(mysql_num_rows($comInfo)>0){

					return mysql_fetch_array($comInfo);

				}

			}else if($uInfo['u_type']==2){

					$uInfo['name']= trim("$uInfo[first_name] $uInfo[last_name]");

					$uInfo['id']= $uInfo['user_id'];

					return $uInfo;		

			}

		}

		return "N/A";

}



function getcompany($id){

	if($id == 0 or $id == NULL ){

		return 'N/A';

	}else{

		$db = new DB();

		$db->open();

		$com = $db->select("company","*","id=$id");

		return  $com;

	}

}



/*function emailTmp($table,$title,$sEmail,$fEmial='',$cMail=''){

  	if($fEmial=='') $fEmial=DEMAIL;

	$message="<div>

    <div style=\"width:600px;font-size:12px;font-family:Arial;color:#4a4a4a; padding-top:20px;\">

			 <div style=\"background:#ffffff;border:1px solid #999; margin:auto; width:600px;margin-top:10px;text-align:left;\">

				<div style=\"border-bottom:solid #e11b22 3px\"> 

					 <div style=\"border-bottom:15px solid #026f3c; padding-bottom:4px;\">  

					  <table width=\"100%\">

						<tr><td>

					  <div style=\"float:left; \">

						  <a href=\"".SURL."\">

							  <img src=\"".SURL."/images/adminica_logo_red-trans.png\" border=\"0\" />

						  </a>

					  </div>

					  </td><td>

					  <div style=\"float:right;font-weight:bold; padding:0px 15px 0px 0px;margin-top:15px;\">
						".SITENM. " <br/>A fully automated Background Verification system.
					 </div>
					 </td></tr>
					 </table>
						 <div style=\"clear:both;\"></div>
					</div>
				</div>
				<div style=\"border-radius:5px;width:90%;margin-left:10px;background:#efefef;padding:10px;clear:both;margin-top:15px;height:auto;border-top:1px solid #dedede;border-bottom:1px solid #dedede;\">$title</div>
				<div style=\"margin:15px;clear:both;border-bottom:1px dashed #cccccc;\">
					<p style=\"margin:8px auto;\">$table</p>
				</div>
			 </div>
		 <div style=\"clear:both;\"></div>
		</div>
	  </div>";



								   $mail             = new PHPMailer();
								   $mail->IsSMTP(); // telling the class to use SMTP
								   $mail->SMTPAuth   = true;                  // enable SMTP authentication
								   $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
								   $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
								   $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
								   $mail->Username   = "noreply@backcheckgroup.com";  // GMAIL username
								   $mail->Password   = "noreply-786";              // GMAIL password
								   $mail->SetFrom('noreply@riskdiscovered.com');
   
   
   if($cMail!=''){
	    $cces = explode(',',$cMail);
		foreach($cces as $cc){
			$mail->AddBCC($cc);
		}
	}
   
   $mail->Subject    = $title;
   $mail->MsgHTML($message);
   $mail->AddAddress($sEmail);
   $mail->Send();
  
}*/


function emailTmp($table,$title,$sEmail,$fEmial='',$cMail='',$bccMail='',$user_id='',$recipient_name='',$heading=''){
	$message = "";
	 if($user_id!=''){
	    $ids = explode(',',$user_id);
		foreach($ids as $uid){
			
			
	$userInfo 	= getUserInfo($uid);
	$username 	= $userInfo['first_name'] . ' ' . $userInfo['last_name'];
		}
	}else{
	$uid 		= $_SESSION['user_id'];	
	$userInfo 	= getUserInfo($uid);
	$username 	= $userInfo['first_name'] . ' ' . $userInfo['last_name'];
	}
	
	if($recipient_name!='') {
		$username = (strtolower($recipient_name) == "no")?"":$recipient_name; 
		}
	
	
	
	
  	if($fEmial=='') { $fEmial=DEMAIL; }

/*	$message .= "<table width=\"600\" border=\"0\" cellpadding=\"5\" style=\"margin:0 auto; border-spacing: 0px; border-radius: 10px 10px 0 0; overflow: hidden; font-family:Verdana, Geneva, sans-serif\" bgcolor=\"#f6f6f7\">  
  
  <tr>
    <td align=\"left\" style=\"padding:13px;\" bgcolor=\"#747D7D\"><img src=\"".SURL."images/logo_email.png\" /></td>
    <td align=\"left\" width=\"36%\" style=\"padding:20px;\" bgcolor=\"#747D7D\"><a href=\"".SURL."\" style=\"text-decoration:none; background-color: #444; padding: 8px 12px; line-height: 1; color: #fff; font-size: 14px; margin: 0; border-radius: 4px; text-align: center;\">Verification System</a></td>
  </tr>
 
  <tr>
  	<td align=\"center\" width=\"100%\" colspan=\"3\"><h3 style=\"color:#465059; padding:20px 0 0 0; margin:0;\">".(($heading!='')?$heading:$title)."</h3></td>
  </tr>";
  
  if($username!=""){
  
  
  $message .= "<tr>
  	<td align=\"center\" width=\"100%\" colspan=\"3\"><h3 style=\"font-weight:normal; color:#70bff3;\">Dear ".$username.",</h3></td>
  </tr>";
 
  }
 $message .= " <tr>
  	<td bgcolor=\"#f6f6f7\" align=\"center\" width=\"100%\" colspan=\"3\" style=\"padding:20px 10px 50px 10px;\">$table</td>
  </tr>
  
  <tr>
  	<td align=\"center\" width=\"100%\" colspan=\"3\" bgcolor=\"#FFFFFF\"><p style=\"padding:5px 20px; color: #54565c; font-size:13px;\">If you need help or have any questions, please visit our <a href=\"".SURL."?action=adsupport&atype=support\" style=\"color:#fd4f00\"><span>Support</span></a>.</p></td>
  </tr>
  
   <tr>
  	<td align=\"center\" width=\"100%\" colspan=\"3\" bgcolor=\"#747D7D\"><p style=\"padding:5px 20px; color: #ffffff; font-size:13px;\"> &copy; 2007 - 2015 - All rights reserved | Powered by <a href=\"".COPYRIGHT_URL."\" style=\"color:#ffffff\">Background Check Pvt Ltd.</a> 
	</td>
	  </tr> 
	  
	  
	  
	</table>";*/
	if($heading!='')
	{$heading2 = $heading;
		}
		else
		{
			$heading2 = $title;}

	$message .= '
 <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
 <style>
img{vertical-align:middle;}
</style>
 
 <div style="background:url('.SURL.'images/emails/Letterhead_Page1.png) no-repeat -195px bottom; width:100%; display:inline-block;width:1000px;">
 <table width="600" border="0" cellpadding="5" style="margin:34px auto 34px; border-spacing: 0px; border-radius:0; overflow: hidden; border-top:5px solid #27abc9;" bgcolor="#fff">  
    <tr>
   	<td colspan="5" style="padding:19px 28px 19px 20px;background: #f2f4f6;"><div style="text-align:left; width:100%; display:inline-block; margin:5px 0 0px 0;"><img src="'.SURL.'images/emails/logo2.png" alt="" style="width: 195px;height: auto;"> <span style="float:right; margin-top:20px;color:#7e8385; font-size:14px;">'.date("d F Y").'</span></div> </td>
   </tr>';
     if($username!=""){
  //".(($heading!='')?$heading:$title)."
  
  $username = '<p style="color: #27abc9; font-size:29px;">Hello '.$username.'!</p>';
 
  }
  else {
	 $username = '<p style="color: #27abc9; font-size:29px;"> '.($heading!='')?$heading:$title.' </p>';
	 }

   
  $message .= '<tr>
  	<td align="left" width="100%" colspan="3" style="padding: 0px 28px;font-size: 17px;line-height: 19px;">
	'.$username.' <p>'.$heading2.'</p></td>
  </tr>';
  
 $message .= '<tr>
  	<td style="font-size: 13px;line-height: 21px;padding: 0 28px;text-align: left;color: #7e8385;">'.$table.'<p>Have any questions? <br />Just shoot an email! We&#39;re always here to help you.</p>

<p>Cheerfully yours, <br>
Background Check Team</p> 
     </td>
  </tr>
   <tr>
  	<td align="center" width="100%" colspan="3" bgcolor="#FFFFFF"><p style="padding:17px 17px; color: #54565c; font-size:13px;"><a href="mailto:support@backcheckgroup.com" style="color: #fff;background: #27abc9;text-decoration: none;padding: 15px 41px;font-size: 13px;text-transform: uppercase; border-radius:68px;"><img src="'.SURL.'images/spemail.png" style="vertical-align:middle; margin-right: 10px;">have any questions ?</a></p></td>
  </tr>
    <tr>
  	<td align="center" width="100%" colspan="3" bgcolor="#333333">
    <p style="margin:0; padding:10px 0 10px;">
    <a href="#" style="margin:0 20px 0 0;"><img src="'.SURL.'images/emails/fb_icon.png"></a>
    <a href="#" style="margin:0 20px 0 0;"><img src="'.SURL.'images/emails/twitter_icon.png"></a>
    <a href="#" style="margin:0 20px 0 0;"><img src="'.SURL.'images/emails/link_icon.png"></a>
    <a href="#" style="margin:0 20px 0 0;"><img src="'.SURL.'images/emails/gplus_icon.png"></a></p>
    <p style="padding:0px 10px; color: #ffffff; font-size:12px; margin-top:0;"> &copy; '.date('Y').' - All rights reserved | Powered by <a href="#" style="color:#ffffff; text-decoration:none;">Background Check Pvt Ltd.</a> </p>
</td>
  </tr> 
 </table>
 </div>
 
';	



								   $mail             = new PHPMailer();
								   $mail->IsSMTP(); // telling the class to use SMTP
								   $mail->SMTPAuth   = true;                  // enable SMTP authentication
								   $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
								   $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
								   $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
								   $mail->Username   = "noreply@backcheckgroup.com";  // GMAIL username
								   $mail->Password   = "kashif123";              // GMAIL password
								   $mail->SetFrom('noreply@riskdiscovered.com');
   
   
   if($bccMail!=''){
	    $cces = explode(',',$bccMail);
		if(count($cces)>0){
		foreach($cces as $cc){
			$mail->AddBCC($cc);
			//echo "<br>bcc Mails:".$cc."<br>";
		}
		}else{
			$mail->AddBCC($cces);
		}
	}
	
	if($cMail!=''){
	    $cces = explode(',',$cMail);
		if(count($cces)>0){
		foreach($cces as $cc){
			$mail->AddCC($cc);
			//echo "<br>cc Mails:".$cc."<br>";
		}
		}else{
			$mail->AddCC($cces);
		}
	}
   
   $mail->Subject    = $title;
   $mail->MsgHTML($message);
  //echo $message.'<br>'; exit;
   $mail->AddAddress($sEmail);
   $mail->Send();
  
}



function time_dif( $start, $end ){

    $uts['start']      =    strtotime( $start );

    $uts['end']        =    strtotime( $end );

    if( $uts['start']!==-1 && $uts['end']!==-1 ){

        if( $uts['end'] >= $uts['start'] ){

            $diff    =    $uts['end'] - $uts['start'];

            if( $days=intval((floor($diff/86400))) )

                $diff = $diff % 86400;

            if( $hours=intval((floor($diff/3600))) )

                $diff = $diff % 3600;

            if( $minutes=intval((floor($diff/60))) )

                $diff = $diff % 60;

            $diff    =    intval( $diff );      

			if($hours<9) $hours = "0".$hours;

			if($minutes<9) $minutes = "0".$minutes;

			if($diff<9) $diff = "0".$diff;

				   

            return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );

        }else{

            trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );

        }

    }else{

        trigger_error( "Invalid date/time data detected", E_USER_WARNING );

    }

    return( false );

}	



function validateEmail($email){

    // First, we check that there's one @ symbol,

    // and that the lengths are right.

    if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)){

        // Email invalid because wrong number of characters

        // in one section or wrong number of @ symbols.

        return false;

    }

    // Split it into sections to make life easier

    $email_array = explode("@", $email);

    $local_array = explode(".", $email_array[0]);

    for ($i = 0; $i < sizeof($local_array); $i++){

        if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])){

            return false;

        }

    }

    // Check if domain is IP. If not,

    // it should be valid domain name

    if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])){

        $domain_array = explode(".", $email_array[1]);

        if (sizeof($domain_array) < 2){

            return false; // Not enough parts to domain

        }

        for ($i = 0; $i < sizeof($domain_array); $i++){

            if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])){

                return false;

            }

        }

    }

    return true;

}



function get_rand_val($length){

  if($length>0){ 

  $rand_id="";

   for($i=1; $i<=$length; $i++){

   mt_srand((double)microtime() * 1000000);

   $num = mt_rand(1,8);

	   switch($num) {

			case "1":

			  	$rand_id.= "a";

			break;

			case "2":

			 	$rand_id.= "b";

			break;

			case "3":

			 	$rand_id.= "c";

			break;

			case "4":

			 	$rand_id.= "d";

			break;

			case "5":

			 	$rand_id.= "e";

			break;

			case "6":

			 	$rand_id.= "f";

			break;

			case "7":

			 	$rand_id.= "g";

			break;

			case "8":

			 	$rand_id.= "h";

			break;

	  }

   }

  }

return $rand_id;

}


 // by khl
	function removeAttachedFile() {
	
	global $db;
	 
	$att_id 	= $_REQUEST['att_id']; 
	$file_url 	= $_REQUEST['file_url']; 
	$tmpURL = DEV_BASE_URL.'files/'.$file_url;
	
	 if(file_exists($tmpURL)){
	
	@unlink(DEV_BASE_URL.'files/'.$file_url);	
		
	$del = "att_id=".$att_id;
	//echo $del; exit;
	$db->delete("attachments",$del);
	echo "deleted"; exit;
	}else{
	echo "file not found !"; exit;	
	} 
		 
	}
	
	 // by khl
	function addAttachedFile() {
	
	global $db;
	
	$case_id 	= $_REQUEST['case_id']; 
	$checks_id 	= $_REQUEST['checks_id']; 
	$att_file_name 	= $_REQUEST['file_name']; 
	$att_file_path 	= 'files/'.$att_file_name; 
	
	$cols = "case_id,checks_id,att_file_path,att_file_name";
	$values = "$case_id,$checks_id,'".$att_file_path."','".$att_file_name."'";
		
	$ins = $db->insert($cols,$values,'attachments');
	$lastinsertedID = $db->insertedID;	
	echo $lastinsertedID; exit;
	
	}
	
	// by khl
	
	
	//com_type='case'
	function get_notifications($ewhere="a_type='notification' AND is_break=0 AND ",$limit="",$isupdate=false){

	global $db,$COMINF;
	global $LEVEL;

	$where="$ewhere ext_id=".$_SESSION['user_id'];
	if($LEVEL==4){
		$where= "$where AND `level`=2";
	}else{
		$where= "$ewhere `level`=4";
	}
	
	
	$tabl = "activity";
	$cols = "*";
	//echo "$tabl $cols, $where ORDER BY a_date DESC $limit"; //exit;
	$comnts = $db->select($tabl,$cols,"$where ORDER BY a_date DESC $limit");
	if(mysql_num_rows($comnts)>0){
	    if($isupdate) $db->update("is_break=1",$tabl,$where);	 
		return $comnts;	 
	}

	return false;

	}
	
	// by khl add rarting
	
	function addRating($id,$rate=0){
		global $db,$COMINF;
		$uID = $_SESSION['user_id'];
		if($id){
			
		$tabl = "ver_data";
		$where = "`v_id`=$id";
		$db->update("rating=$rate",$tabl,$where);	
		
		$a_info = "Rating added by ".$_SESSION['fname']." ( $COMINF[name] )  against case id  $id";
		$notify = createNotifications(4,$a_info,$id);
		
		return true;
		}else{
		return false;	
		}
		
	}
	// by khl add rarting on checks
	function addRatingOnCheck($id,$rate=0){
		global $db,$COMINF;
		$uID = $_SESSION['user_id'];
		if($id){
			
		$tabl = "ver_checks";
		$where = "`as_id`=$id";
		$db->update("as_rating=$rate",$tabl,$where);	
		
		
		
		$a_info = "Rating added by ".$_SESSION['fname']." ( $COMINF[name] ) against check id  $id";
		$notify = createNotifications(4,$a_info);
			
		return true;
		}else{
		return false;	
		}
		
	}
	
	// by khl get Attachments
	
	function getAttachments($where=""){
		global $db;
		
		$Attachments = $db->select("attachments","*",$where); 
		
		if(mysql_num_rows($Attachments)>0){
		
			return $Attachments;
			
		}else{
			return false;	
		}
		
		
	}
	
	function downloadAttachedFile($file="")
	{
		$filepath = SURL.$file;
	
		if (file_exists($filepath)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($filepath));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filepath));
		readfile($filepath);
		exit;
			}
	
	}
	
	
	function checkCnic($cnic,$echo=0,$company_id=0){
		
		global $db,$COMINF;
		
		$com_id = ($LEVEL!=4)?$company_id:$COMINF['id'];
		
		$where = "v_nic='".$cnic."' AND com_id='".$com_id."' AND v_isdlt=0 ";
		$Q = $db->select("ver_data","v_id,v_name",$where); 
		$r = @mysql_num_rows($Q);
		
		if($r>0){
			$rs = @mysql_fetch_assoc($Q);
			
			$msg =  "This ".ID_CARD_NUM." already exists.<p class='text-default'><a href='?action=add&atype=newcase&case=$rs[v_id]' target='_blank' >Click here</a> to add a new case for <a href='?action=details&case=$rs[v_id]&_pid=20' target='_blank' >$rs[v_name]</a></p>";
		}else{
			$msg =  "not-found"; 
		}
		
		if($echo==0){ 
		echo $msg; exit; 
		} else { 
		return  $msg; 
		} 
		
	
	}
	
	
	
	function checkEmpId($emp_id,$echo=0,$company_id=0){
		
		global $db,$COMINF,$LEVEL;
		
		$com_id = ($LEVEL!=4)?$company_id:$COMINF['id'];

		$where = "emp_id='".$emp_id."' AND com_id='".$com_id."' AND v_isdlt=0 ";
		//echo $where; exit;
		
		$Q = $db->select("ver_data","v_id,v_name",$where); 
		$r = mysql_num_rows($Q);
		
		if($r>0){
			$rs = mysql_fetch_assoc($Q);
			//$msg =  "This ".CLIENT_REF_NUM." already exists <a href='?action=details&case=$rs[v_id]&_pid=20' target='_blank' >$rs[v_name]</a>"; 
			
			$msg =  "This ".CLIENT_REF_NUM." already exists.<p class='text-default'><a href='?action=add&atype=newcase&case=$rs[v_id]' target='_blank' >Click here</a> to add a new case for <a href='?action=details&case=$rs[v_id]&_pid=20' target='_blank' >$rs[v_name]</a></p>";
			
		}else{
			$msg = "not-found"; 
		}
		
		if($echo==0){ 
		echo $msg; exit; 
		} else { 
		return  $msg; 
		} 
	
	}
	
	function saveFilter($filter_what,$filter_by,$company_id=null){
		global $db,$COMINF,$LEVEL;
		$where_com_id = ($LEVEL!=4)?" AND com_id='".$company_id."'":" AND com_id='".$COMINF['id']."'";
		$uID = $_SESSION['user_id'];
		$where = "filter_what='".$filter_what."' $where_com_id AND user_id=".$uID."";
		$Q = $db->select("dashboard_filters","id",$where); 
		$rows = mysql_num_rows($Q);
		if($rows>=1){
			
			
				$values="filter_by='$filter_by'";
				$updated = $db->update($values,"dashboard_filters",$where);
				if($updated){
				echo "updated"; exit;	
				}else{
				echo "Error in updation"; exit;		
				}
		}else{
			
				$cols="com_id,user_id,filter_what,filter_by";
				$values="$company_id,$uID ,'$filter_what','$filter_by'";
				$isInserted = $db->insert($cols,$values,"dashboard_filters");
				if($isInserted){
				echo "inserted"; exit;	
				}else{
				echo "Error in insertion"; exit;		
				}
			
			
		}
		
		
	}
	
	function getFiltersBy($filter_what, $cols_date = '',$company_id=null){
		global $db,$COMINF,$LEVEL;
		$where_com_id = ($LEVEL!=4)?" AND com_id='".$company_id."'":" AND com_id='".$COMINF['id']."'";
		
		$uID = $_SESSION['user_id'];
		$data = array();
		$data['filter_by'] = '';
		$data['filter_where'] = '';
		$where = "filter_what='".$filter_what."' $where_com_id AND user_id=".$uID."";
		$Q = $db->select("dashboard_filters","filter_by",$where); 
		$start_past = strtotime("this week"); 
		$end_past = strtotime("+6 day",$start_past);
		$today = date("Y-m-d");
		$this_week = " BETWEEN '" . date("Y-m-d",$start_past) . "' AND '" . date("Y-m-d",$end_past)."'" ;
		$this_month =  date("Y-m");
		$this_year =  date("Y");
		
		
		$rows = mysql_num_rows($Q);
		
		if($rows){
			$rs = mysql_fetch_assoc($Q);
			if($rs['filter_by']=='today') $filter_where = " AND DATE_FORMAT($cols_date, '%Y-%m-%d') = ' ".$today." ' ";
			if($rs['filter_by']=='this_week') $filter_where = " AND DATE_FORMAT($cols_date, '%Y-%m-%d') ".$this_week." ";
			if($rs['filter_by']=='this_month') $filter_where = " AND DATE_FORMAT($cols_date, '%Y-%m') = '".$this_month."' ";
			if($rs['filter_by']=='this_year') $filter_where = " AND DATE_FORMAT($cols_date, '%Y') = '".$this_year."' ";
			if($rs['filter_by']=='all') $filter_where = "";
			$data['filter_by'] = $rs['filter_by'];
			$data['filter_where'] = $filter_where;
		
		}
		
		return $data;
		
		
		
	}
	
	// create notifications
	// added by khl 
	
	function createNotifications($level_id,$a_info="",$v_id='',$notify_to='',$to_email='',$a_type='notification',$as_id='',$toWhome='',$new_subject=''){
		
		global $db,$COMINF, $LEVEL;
		
		$uID = $_SESSION['user_id'];
		
		switch($toWhome){
			case 'client':
			$ver_data = getVerdata($v_id);
			$com_users = getClUser($ver_data['com_id']);
			$opsUser = "";
			break;
			case 'ops':
			$ver_data = NULL;
			$com_users = NULL;
			$opsUser = "saimab@riskdiscovered.com";
			break;
			
		}
		
		
		$ext_id = ($as_id!='')?$as_id:$notify_to;
		
		$notifyCols = "user_id,v_id,ext_id,a_info,a_type,level";
		$notifyVals = "$uID,'".$v_id."','".$ext_id."','".$a_info."','".$a_type."','".$level_id."'";
		//echo "Cols($notifyCols) <br> Values($notifyVals)";
		$note = $db->insert($notifyCols,$notifyVals,"activity");
		
		if($note){
			$subj = ($a_type!='notification')?ucwords($a_type)." Notification":"New ".ucwords($a_type);
			//$localDate = date("D, M d, Y H:i:s A");
			$localDate="";
			$subject = ($new_subject!='')?$new_subject:$subj.' '.$localDate;
			
				$table = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
						
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>'.$a_info.'</td>
						
					</tr>
					</tbody>
				</table>';
				
				//$cMail = $_REQUEST['cc_email'];
				// Send message to manager
				//$userInfo = getUserInfo($to_msg);
				//echo  $to_email;
				$to_email = ($to_email!="")?$to_email:'khalique@xcluesiv.com'; // Manager only;
				
				// for now only to manager 11-06-2015
				//if($LEVEL==4){ 
				if($notify_to!=""){
				$user_id = (int) $notify_to;
				$userInfo = getUserInfo($user_id);
				$toFullName = $userInfo['first_name']." ".$userInfo['last_name'];
				$to_email = $userInfo['email'];
				}else{
				if($LEVEL!=4){
				$toFullName = "Client";
				
				}else{
				$toFullName = "Team";
				}	
				}
				
				// if notification to client and level id also client then
				$getInfo = getInfo("users","email='$to_email'");
				if($getInfo['level_id']){
				$toFullName = $getInfo['first_name']." ".$getInfo['last_name'];;	
				}
				
				$toFullName = ($toFullName!='')?$toFullName:"Team";
				
				// send to all users of client
				
				if(!empty($com_users)){
					

								while($clUser = @mysql_fetch_assoc($com_users)){
									$fullName = $clUser['first_name'].' '.$clUser['last_name'];
									
									$check_added_by = $ver_data['v_uadd'];
									$user_info = getUserInfo($check_added_by);
									$loc_id = $user_info['loc_id'];
									// notification settings // insufficient morechecks
						if(($clUser['is_insuff_notify']==1 && $a_type=='insufficient') || ($clUser['is_checks_added_notify']==1 && $a_type=='morechecks')){
							if($loc_id==0){
											// to all users
											//var_dump($com_users); die;
									if($clUser['is_subuser']==0){
									emailTmp($table,$subject,$clUser['email'],"","ops@backcheckgroup.com","","","Valued Customer");
									//emailTmp($table,$subject,'khalique@xcluesiv.com',"","","","","Valued Customer");
									}
									}else{
										if($loc_id==$clUser['loc_id'] && $clUser['puser_id']!=0 && $clUser['is_subuser']!=0){
											// to sub user
									emailTmp($table,$subject,$clUser['email'],"","ops@backcheckgroup.com","","","Valued Customer");
									//emailTmp($table,$subject,'khalique@xcluesiv.com',"","","","","Valued Customer");
																		
										}else if($clUser['puser_id']==0 && $clUser['is_subuser']==0){
											// to parent user
									emailTmp($table,$subject,$clUser['email'],"","ops@backcheckgroup.com","","","Valued Customer");
									//emailTmp($table,$subject,'khalique@xcluesiv.com',"","","","","Valued Customer");
										}
									}
									
									
									}

										

								}
								if($notify_to!=""){
								emailTmp($table,$subject,$to_email,"","zubair@backcheckgroup.com","","",$toFullName);	
								}

							}else{
								//echo "Name:$toFullName"."Email:$to_email";
				emailTmp($table,$subject,'khalique@xcluesiv.com',"","","","",$toFullName);
				if($opsUser!=""){
				emailTmp($table,$subject,$opsUser,"","zubair@backcheckgroup.com","","","Team");	
				}
				
							}
				//}
			return true;
		}else{
			
			return false;
		}
		
	}
	
	// added by talha qazi
	
	function getlogo()
 {
  global $db,$COMINF,$LEVEL; 
  
	  $tabl="company";
	  $cols="logo";
	  if($LEVEL==4 || $LEVEL==5){
	  $logo=$db->select($tabl,$cols," id=$COMINF[id]");
	  $rs= mysql_fetch_assoc($logo);
	 if($rs['logo'])
	 {
	return $rs['logo'];
	 }
	 else{
	return "images/xcluesiv-logo.png";
	}
	}
	else{
	return "images/xcluesiv-logo.png";
	}
 }

	// addInvoiceNumbers add by khl
	
	function addInvoiceNumbers($checks=array(),$cost=array(),$invoice_number,$is_tax=0,$invoice_date=''){
		global $db,$LEVEL;
		
		if(count($checks)==0){
			
			echo "Please select checks first ! "; 
			exit;
		}else if($invoice_number==""){
			
			echo "Please type invoice number ! "; 
			exit;
			
		}else{
			
			$selInv = $db->select('ver_checks','as_id'," invoice_number='".$invoice_number."'");
			//echo "select count(as_id) from ver_checks where invoice_number='".$invoice_number."'";
			
			if(mysql_num_rows($selInv)>0){
			echo "This invoice number '".$invoice_number."' already exists ! "; 
			exit;	
			}else{
			$qr = ($invoice_date=='')?"invoiced_date=CURRENT_TIMESTAMP , ":"invoiced_date='$invoice_date', ";
			
			foreach ($checks as $check){
				$vCheck = getCheck(0,0,$check);
				$vData  = getVerdata($vCheck['v_id']);
				$com_id = $vData['com_id'];
				$TaxAmount = ($com_id!=0 && $com_id!='')?(getCompanyTax($com_id)):getTax();
				$where = "as_id=".$check;				
				$values="invoiced=1,invoice_number='".$invoice_number."', check_cost='".$cost[$check]."', $qr 
				is_tax=".$is_tax.", tax='".$TaxAmount."'";
				//echo "update ver_checks set $values where $where"."<br>"; 
				$updated = $db->update($values,"ver_checks",$where);
				
			}
			
			echo "success"; 
			exit;
			}
			
		}
		
		
		
	}
	
	// get Tax by khl
	
	function getTax($id=1,$country_id=0,$state_province_id=0){
		global $db;
		$wher = ($country_id!=0)?"country_id=$country_id":($state_province_id!=0)?"state_province_id=$state_province_id":"id=$id";
		$Qur = $db->select("checks_tax","tax", $wher);
		$rsTax = mysql_fetch_assoc($Qur);
		if($rsTax['tax']){
		return $rsTax['tax'];
		}else{
		return 0;	
		}
	}
	
	function cicReportCourtsTitle($title){
		
		$court_titles = strtolower($title);
		
						switch($court_titles){
							case "high court sindh":
							echo 'High Court Sindh';
							break;
							case "high court lahore":
							echo 'High Court Lahore';
							break;
							case "high court quetta":
							echo 'High Court Quetta';
							break;
							case "high court peshawar":
							echo 'High Court Peshawar';
							break;
							case "high court islamabad":
							echo 'High Court Islamabad';
							break;
							
						}
		
		
	}
	
	
	function getCountry($cID=0){
	$db = new DB();
	if((is_numeric($cID)) && $cID!=0){
		$country = $db->select("country","*","country_id=$cID");
		return mysql_fetch_assoc($country);
	}else{
		//$array=array();
		$country = $db->select("country","*"," printable_name <> '' ORDER BY printable_name ASC");
		
		while($countri = mysql_fetch_assoc($country)){
		$array[] = array(
		'country_id' => $countri['country_id'],
		'printable_name' => $countri['printable_name'],
		);
		}
		return $array;
	}
	return false;
	}
	
	function getSateProvice($cID=0){
	$db = new DB();
	if((is_numeric($cID)) && $cID!=0){
		$statescity = $db->select("statescity","*","citystate_id=$cID");
		return mysql_fetch_assoc($statescity);
	}else{
		//$array=array();
		$statescity = $db->select("statescity","*"," citystats <> '' ORDER BY citystats ASC");
		
		while($statescit = mysql_fetch_assoc($statescity)){
		$array[] = array(
		'citystate_id' => $statescit['citystate_id'],
		'citystats' => $statescit['citystats'],
		);
		}
		return $array;
	}
	return false;
	}
	
	function getHoliday($id){
	global $db;	
	$data= $db->select("holiday_master","*","hol_id=$id");
	if(mysql_num_rows($data) >0){
		return mysql_fetch_array($data);
	}	return false;	
	}
	
	
	function addholiday(){
	
		global $db;
		$uID = $_SESSION['user_id'];
		if(!is_numeric($_POST['country_id'])) $_POST['country_id']=0;
		if($_POST['hol_holiday']=='') msg('err',"Please Input Holiday!");
		if($_POST['sdate']=='') msg('err',"Please Select Start Date!");
		if($_POST['edate']=='') msg('err',"Please Select End Date!");
		if(isset($_POST['yrly'])) $_POST['yrly']=1; else $_POST['yrly']=0;
			
		if($_REQUEST['ERR']==''){
			$sdate=$_POST['sdate'];
			$edate=$_POST['edate'];
			
			if(isset($_POST['hid'])){
					$uCols = "country_id=$_POST[country_id],hol_holiday='$_POST[hol_holiday]',hol_desc='$_POST[hol_desc]',hol_sdate='$sdate'";
					$uCols ="$uCols,hol_edate='$edate',hol_mdf=$uID,hol_mdf_time=CURRENT_TIMESTAMP,hol_yrly=$_POST[yrly]";
					$isIncUp = $db->update($uCols,'holiday_master',"hol_id=$_POST[hid]");
					if($isIncUp){
						msg('sec',"$_POST[hol_holiday] Updated Successfully...");
					}else{
						msg('err',"$_POST[hol_holiday] Updation Error!");
					}
			}else{
					
					$holiday = $db->select("holiday_master","*","hol_holiday LIKE '$_POST[hol_holiday]' AND hol_sdate='$sdate'");
					if(mysql_num_rows($holiday)==0){
						$cols = "country_id,hol_holiday,hol_desc,hol_sdate,hol_edate,hol_crt,hol_mdf,hol_crt_time,hol_mdf_time,hol_yrly";
						$values = "$_POST[country_id],'$_POST[hol_holiday]','$_POST[hol_desc]','$sdate','$edate',$uID,$uID";
						$values = "$values,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,$_POST[yrly]";
						$isIncUp = $db->insert($cols,$values,"holiday_master");
						if($isIncUp){
							msg('sec',"$_POST[hol_holiday] Inserted Successfully...");
						}else{
							msg('err',"$_POST[hol_holiday] Insertion Error!");
						}
					}else msg('err',"$_POST[hol_holiday] is already  exist!");
			}
		}
}

	function selCountry(){
		global $db;$str='';
		if(is_numeric($_POST['cid'])){
			$country = $db->select("tmp_country","*","country_id=$_POST[cid]");
			if(mysql_num_rows($country)>0){
				$country =	mysql_fetch_array($country);
				foreach($country as $key=>$val){
					$str= "$str|$key=$val";
				}
			}
		}
		return $str;
	}

	
	// Get working days by khl 
	function getdatedifference($startdate, $days,$com_id=0)
	{
		global $db;
		$skipDates1 = array();
		$skipDates2 = array();
		$skipDates3 = array();
		
		
		if($com_id!=0){
			$selNonPaymentDays = $db->select("non_payment_clients_dates","*"," com_id=$com_id");
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
		
		
		$selholydays = $db->select("holiday_master","*","");
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

	function getDaysFromDates($as_cldate,$as_addate,$com_id=0,$as_id=0){
	
	
	global $db;
		$skipDates1 = array();
		$skipDates2 = array();
		$skipDates3 = array();
		$skipDates4 = array();
		
		$addate = strtotime($as_addate); // or your date as well
		$cldate = strtotime($as_cldate);
		$rdays = $cldate - $addate;
		$rdays =  floor($rdays/(60*60*24));
		$dayss = (int)$rdays;
		
		if($com_id!=0){
			$selNonPaymentDays = $db->select("non_payment_clients_dates","*"," com_id=$com_id");
			while($rsNPD =	mysql_fetch_assoc($selNonPaymentDays)){
				$disable_date = ($rsNPD['disable_date']!="")?$rsNPD['disable_date']:date("Y-m-d");
				$enable_date = ($rsNPD['enable_date']!="")?$rsNPD['enable_date']:date("Y-m-d");
				$now = strtotime($disable_date); // or your date as well
				$your_date = strtotime($enable_date);
				$datediff =   $your_date - $now;
				$datediff =  floor($datediff/(60*60*24));
				
				if($datediff>0){
					for($x=0; $x<=$datediff; $x++){
					$dd = 	date("Y-m-d", strtotime($disable_date . "+$x day"));	
					$skipDates3[] = $dd;
					}
				}
				$skipDates1[] = $disable_date;	
				
				//var_dump($enable_date);
			}
			
		}

		// exclude isufficient and qa in process date  
		if($as_id!=0){
		$selInsuffAtt = $db->select("attachments","att_insuff_date,att_suff_date"," checks_id=$as_id");
		
		if(@mysql_num_rows($selInsuffAtt)>0){
		while($rsInsuffAtt =	@mysql_fetch_assoc($selInsuffAtt)){
			if($rsInsuffAtt['att_insuff_date']!=""){
				
				$disable_date = ($rsInsuffAtt['att_insuff_date']!="")?$rsInsuffAtt['att_insuff_date']:date("Y-m-d");
				$enable_date = ($rsInsuffAtt['att_suff_date']!="" && $rsInsuffAtt['att_suff_date']!='0000-00-00 00:00:00')?$rsInsuffAtt['att_suff_date']:date("Y-m-d");
				$now = strtotime($disable_date); // or your date as well
				$your_date = strtotime($enable_date);
				$datediff =   $your_date - $now;
				$datediff =  floor($datediff/(60*60*24));
				//echo "count: ".$enable_date."<br />";
				if($datediff>0){
					for($x=0; $x<=$datediff; $x++){
					$dd = 	date("Y-m-d", strtotime($disable_date . "+$x day"));	
					$skipDates4[] = $dd;
					}
				}
				$skipDates1[] = $disable_date;
		}
		}
		//var_dump($skipDates4); echo "Here";
		}
		
		$selqa_logs = $db->select("qa_logs","submit_date"," as_id=$as_id AND (qa_status='QA' OR qa_status='Approved')");
		if(@mysql_num_rows($selqa_logs)>0){
		while($rsqa_logs =	@mysql_fetch_assoc($selqa_logs)){
		
				$disable_date = ($rsqa_logs['qa_status']=='QA')?$rsqa_logs['submit_date']:date("Y-m-d");
				$enable_date = ($rsqa_logs['qa_status']=='Approved')?$rsqa_logs['submit_date']:date("Y-m-d");
				
				$now = 	strtotime($disable_date); // or your date as well
				$your_date = strtotime($enable_date);
				$datediff =   $your_date - $now;
				$datediff =  floor($datediff/(60*60*24));
				
				if($datediff>0){
					for($x=0; $x<=$datediff; $x++){
					$dd = 	date("Y-m-d", strtotime($disable_date . "+$x day"));	
					$skipDates4[] = $dd;
					}
				}
				$skipDates1[] = $disable_date;
		}
		}
		
		
		}











		
		$selholydays = $db->select("holiday_master","*","");
			while($holydays =	mysql_fetch_array($selholydays)){
				$hol_sdate = $holydays['hol_sdate'];
				$hol_edate = $holydays['hol_edate'];
				$now = strtotime($hol_sdate); // or your date as well
				$your_date = strtotime($hol_edate);
				$datediff = $now - $your_date;
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
		$d = new DateTime($as_addate);
		$t = $d->getTimestamp();
		
		
		$j=0;
		$cc=1;
		// loop for X days
		for($i=0; $i<$dayss; $i++)
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
			
			if($nextDay == 0 || $nextDay == 6 || in_array($nextDate,$skipDates1) || in_array($nextDate,$skipDates2) || in_array($nextDate,$skipDates3) || in_array($nextDate,$skipDates4))
			{
				//echo $nextDay."<br>";
				$i=$i--;
				
			}else{
				$cc++;
				//echo  $j.$nextDate; echo "<br>";
			} 
				
			$t = $t+$addDay;
			$j++;
		} // for ends
		$t--;
		
		
			return abs($cc);
				
	}
	
	// by khl
	
	
	function updatePaid($inv_id,$com_id,$paid=0){
	global $db;	
	$com_status = ($paid==0)?1:0;
	
	if($inv_id){
		
	if($db->update("paid=$paid,as_paid_date=CURRENT_TIMESTAMP","ver_checks","invoice_number='$inv_id'")){
		
		
		enableDisableClient($com_id,$com_status);
		
	echo "Updated";	exit;	
	}else{
		
	echo "Updation Error"; exit;		
	}
	
	}else{
		
	echo "Invoice error"; exit;		
	}
		
		
	}
		
	// by khl
	function updateClientStatus($com_id,$com_status=0){
	global $db;	
	if($com_id){
		
		
	if($db->update("disabled_id=$com_status","company","id='$com_id'")){
	echo "Updated";	exit;	
	}else{
		
	echo "Updation Error"; exit;		
	}
	
	}else{
		
	echo "Company id error"; exit;		
	}
		
		
	}
	
	
	function enableDisableClient($com_id,$disabled_id){
			global $db;
			

			$sel =  $db->select("non_payment_clients_dates","id,enable_date,disable_date","com_id = $com_id ORDER BY id DESC");
			$rs = mysql_fetch_assoc($sel);
			$date_ = date("Y-m-d");
			$tody = strtotime($date_);
			$enable_time = strtotime($rs['enable_date']);
			$disable_time = strtotime($rs['disable_date']);
			if($disabled_id==0) $st = "Enabled"; else $st = "Disabled";
			
			
			$db->update("disabled_id=$disabled_id","company","id='$com_id'");
			
			
			
			$uinfo = $db->select("users","email,CONCAT('first_name',' ','last_name') as fullname,level_id ","is_active AND level_id=2 AND level_id=6");
			$cinfo = getcompany($com_id);
			$rscInfo = mysql_fetch_assoc($cinfo);
			$com_name = $rscInfo['name'];
			$NotificationSubject = "A client [$com_name] has been $st from verify system";
			$NotificationText = "This is to inform you that a client [$com_name] has been $st from verify system.";
			
			
			while($rsuInfo=mysql_fetch_assoc($uinfo)){
			$userEmails = $rsuInfo['email'];
			$userNames = $rsuInfo['fullname'];
			$lev = ($rsuInfo['level_id']==2)?"Manager":"Finance";
			
			emailTmp( $NotificationText,$NotificationSubject,'khalique@xcluesiv.com','','','','',$userNames."[$lev]");
			}
			//emailTmp( $NotificationText,$NotificationSubject,$userEmails,'','','','',$userNames."[$lev]");
			
			
			
			
			
			
				if($disabled_id==1){
				// insert enable date
				

				if($rs['enable_date'] && $rs['disable_date']==""){
				
				
				$db->update("disable_date='".$date_."'","non_payment_clients_dates"," id=$rs[id]");
			
				$tblss = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id ";
				$db->update("as_status='On Hold Non payment'","$tblss","vd.com_id=$com_id AND vc.as_status='Open'");
				
				}else{
					
				if($disable_time!=$tody){	
				$db->insert("com_id,disable_date","$com_id,'".$date_."'","non_payment_clients_dates");	
				}
				$tblss = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id ";
				$db->update("as_status='On Hold Non payment'","$tblss","vd.com_id=$com_id AND vc.as_status='Open'");
				}
				return true;
				}else{
					
				if($rs['disable_date'] || $rs['enable_date']){	
				
				$db->update("enable_date='".$date_."'","non_payment_clients_dates"," id=$rs[id]");
				// update all On Hold Non payment Checks to Open
				$tblss = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id ";
				$db->update("as_status='Open'","$tblss","vd.com_id=$com_id AND vc.as_status='On Hold Non payment'");
				
				}else{
				if($enable_time!=$tody){		
				$db->insert("com_id,enable_date","$com_id,'".$date_."'","non_payment_clients_dates");	
				}
				$tblss = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id ";
				$db->update("as_status='Open'","$tblss","vd.com_id=$com_id AND vc.as_status='On Hold Non payment'");
				}
				return true;
				}
				
				return false;
				

	}
	
	
	
	
	
	
	
	
	function addticket(){
		global $db,$COMINF;
		$itDepartEmails = "hassan@xcluesiv.com,khalique@xcluesiv.com";	
		$CEOEmail = "ceo@backcheckgroup.com";			
		$sp_id  = $_REQUEST['sp_id'];
				
		$randomString = substr(str_shuffle(md5(time())),0,6);
		$sp_ticker_number = 'VR-'.$COMINF['sname'].'-'.strtoupper($randomString);
		
		$user_id 			= $_SESSION['user_id']; 
		$as_id 				= (int)$_REQUEST['as_id']; 
		$sp_title 			= $_REQUEST['sp_title'];
		$sp_description 	= $_REQUEST['sp_description']; 
		$sp_attachment 		= $_FILES["sp_attachment"]; 
		$sp_department 		= $_REQUEST['sp_department']; 
		$sp_priorty 		= $_REQUEST['sp_priorty'];
		if (isset($_REQUEST['img_val'])) {
			$img = $_REQUEST['img_val'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$file = generateRandomString() . '.png';
			$success = file_put_contents('files/ticketsupport/snapshot/'.$file, $data);
		}
		 
		
		$sp_attachment_name = $filen = 	getUniqueFilename($sp_attachment);
		$cols = "
		user_id,
		as_id,
		sp_ticker_number,
		sp_title,
		sp_description,
		sp_attachment,
		sp_department,
		sp_priorty,
		sp_snapshot
		";
	$values = "
		'$user_id',
		'$as_id',
		'$sp_ticker_number',
		'$sp_title',
		'$sp_description',
		'$sp_attachment_name',
		'$sp_department',
		'$sp_priorty',
		'$file'
		";
		if($sp_title == '') msg('err',"Please Enter Subject!");
		if($sp_description == '') msg('err',"Please Enter Message!");
		
		if($_REQUEST['ERR']==''){	
				$error = 0;
				if($sp_attachment['name']){
					$target_dir = "files/ticketsupport/";
					$target_file = $target_dir . basename($sp_attachment_name);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($sp_attachment["tmp_name"]);
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
						if ($sp_attachment_name["size"] > 500000) {
							msg('err',"Sorry, your file is too large!");
							$uploadOk = 0;
							$error =1;
						}
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
							if (move_uploaded_file($sp_attachment["tmp_name"], $target_file)) {
								//msg('sec',"The file ". basename( $sp_attachment_name). " has been uploaded!");
							} else {
								msg('err',"Sorry, there was an error uploading your file!");
								$error =1;
							}
						}	
	
				}
				if($error==0){
							$ins = $db->insert($cols,$values,'system_support');
							$lastinsertedID = $db->insertedID;
							msg('sec',"Ticket Added Successfully...");
								
							$data_table = 
										'<table width="100%" border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">
										<tr>
											<th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Ticket Tile</th>
											<th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Department</th>
											<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Priorty</th>
											<th width="20%" align="center" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Action</th>
										</tr>';
							$clink =  '<a href="'.SURL.'?action=supportdetails&atype=support&ticket='.$lastinsertedID.'" style="color:#8EC537">View Details</a>';
							$data_table .= '<tr>
												<td width="30%" style="font-size:12px; padding:5px;">'.$sp_title.'</td>
												<td width="30%" style="font-size:12px; padding:5px;">'.$sp_department.'</td>
												<td width="25%" style="font-size:12px; padding:5px;">'.$sp_priorty.'</td>
												<td width="20%" align="center" style="font-size:12px; padding:5px;">'.$clink.'</td>
											</tr>';
							$data_table .= '</table>';
							
							$email_title = '[#'.$lastinsertedID.'] New Ticket Added By '.ucwords($COMINF['name']) . ' ' . date('d M Y');
							$managers = $db->select("users","email","level_id = 2 AND is_active = 1");
							$manager_Cmail = '';
							
							if(mysql_num_rows($managers)>0){
								$cc = 0;
								
								while($manager = mysql_fetch_assoc($managers)){
									$cc++;
									if($cc==1){
										$manager_first = $manager['email'];
									}else{
										$manager_Cmail .= $manager['email'].',';
									}
								}
								$manager_Cmail = rtrim($manager_Cmail,',');
							}
							if($sp_department=="it"){
							emailTmp( $data_table, $email_title,$CEOEmail,'',$itDepartEmails);	
							}else{
							emailTmp( $data_table, $email_title,$manager_first,'',$manager_Cmail);
							}
							
					
				}
			}
	}
	
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function getUniqueFilename($file){
		if(!empty($file['name']))
		{
			$file = $file['name'];
			// getting file extension
			$fnarr 			= explode(".",$file);
			$file_extension = strtolower($fnarr[count($fnarr)-1]);
			
			// getting unique file name
			//$file_name = substr(md5($file.time()), 5, 15).".".$file_extension;
			$file_name = substr(md5($file.time()), 5, 15).".".$file_extension;
			return $file_name;
		} // ends for is_array check
		else
		{
			return '';
			
		} // else ends
		
	} // Function ends
	
	function addticketcomment(){
		global $db,$COMINF;
		$user_id 				= $_SESSION['user_id']; 
		$sp_id 					= (int)$_REQUEST['sp_id']; 
		$sc_comment 			= $_REQUEST['sc_comment']; 
		$isfaq 					= (int)$_REQUEST['isfaq']; 
		$sf_question 			= $_REQUEST['sf_question']; 
		$sc_attachment 			= $_FILES["sc_attachment"]; 
		$sc_attachment_name 	= getUniqueFilename($sc_attachment);
		$forward_sp_department 	= $_REQUEST['forward_sp_department']; 
		$sp_title				= $_REQUEST['sp_title'];
		$sp_department			= $_REQUEST['sp_department'];
		$sp_priorty				= $_REQUEST['sp_priorty'];
		
		$cols = "
			user_id,
			sp_id,
			sc_comment,
			sc_attachment
		";
		$values = "
			'$user_id',
			'$sp_id',
			'$sc_comment',
			'$sc_attachment_name'
		";
		$cols_faq = "
			sf_question,
			sf_answer,
			sf_active
		";
		$values_faq = "
			'$sf_question',
			'$sc_comment',
			'1'
		";
		
		$cols_for = "
			sp_department
		";
		$values_for = "
			'$forward_sp_department'
		";

		if($sc_comment == '') msg('err',"Please Enter Comment!");
		
		if($isfaq!=0 && $sf_question== '' ) msg('err',"Please Enter Question!");
		if($_REQUEST['ERR']==''){	
				$error = 0;
				if($sc_attachment['name']){
					$target_dir = "files/ticketsupport/";
					$target_file = $target_dir . basename($sc_attachment_name);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($sc_attachment["tmp_name"]);
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
						if ($sc_attachment_name["size"] > 500000) {
							msg('err',"Sorry, your file is too large!");
							$uploadOk = 0;
							$error =1;
						}
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
							if (move_uploaded_file($sc_attachment["tmp_name"], $target_file)) {
								//msg('sec',"The file ". basename( $sp_attachment_name). " has been uploaded!");
							} else {
								msg('err',"Sorry, there was an error uploading your file!");
								$error =1;
							}
						}	
	
				}
				if($error==0){
								if($forward_sp_department){
									$cols .= ",sp_IsDepartment";
									$values .= ",1";
								}
								$ins = $db->insert($cols,$values,'support_chat');
								$lastinsertedID = $db->insertedID;
								msg('sec',"Comment Inserted Successfully...");
								if($sf_question){
									$ins = $db->insert($cols_faq,$values_faq,'system_faqs');
									msg('sec',"Faqs Inserted Successfully...");
								}
								if($forward_sp_department){
									$isforwardt = $db->updateCol($cols_for,$values_for,'system_support',"sp_id=$sp_id");
									msg('sec',"Ticket Successfully Forward to [".ucwords($forward_sp_department)."]");
									$managers = $db->select("users","email","level_id = 2 AND is_active = 1");
									$manager_Cmail = '';
									if(mysql_num_rows($managers)>0){
										$cc = 0;
									
										while($manager = mysql_fetch_assoc($managers)){
											$cc++;
											if($cc==1){
												$manager_first = $manager['email'];
											}else{
												$manager_Cmail .= $manager['email'].',';
											}
										}
										$manager_Cmail = rtrim($manager_Cmail,',');
									}
									switch ($forward_sp_department) {
										case 'operation':
											$ToEmail = $manager_first;
											$CCEmail = $manager_Cmail;
										break;
										case 'it':
											$ToEmail = 'atta@xcluesiv.com';
											$CCEmail = 'khalique@xcluesiv.com,hassan@xcluesiv.com';
										break;
										case 'finance':
											$ToEmail = 'cfo@backcheckgroup.com';
											$CCEmail = 'finance@xcluesiv.com';
										break;
										/*case 'hr':
											$ToEmail = 'erum@backcheckgroup.com';
											$CCEmail = '';
										break;*/
									}
									$data_table = 
										'<table width="100%" border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">
										<tr>
											<th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Ticket Tile</th>
											<th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Department</th>
											<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Priorty</th>
											<th width="20%" align="center" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Action</th>
										</tr>';
									$clink =  '<a href="'.SURL.'?action=supportdetails&atype=support&ticket='.$sp_id.'" style="color:#8EC537">View Details</a>';
									$clinkSecond =  '<a href="'.SURL.'?action=supportdetails&atype=support&ticket='.$sp_id.'" style="color:#8EC537">Link</a>';
									$data_table .= '<tr>
												<td width="30%" style="font-size:12px; padding:5px;">'.$sp_title.'</td>
												<td width="30%" style="font-size:12px; padding:5px;">'.$forward_sp_department.'</td>
												<td width="25%" style="font-size:12px; padding:5px;">'.$sp_priorty.'</td>
												<td width="20%" align="center" style="font-size:12px; padding:5px;">'.$clink.'</td>
											</tr>';
									$data_table .= '
										</table>
										<div>
											<strong>Comment: </strong><p>'.$sc_comment.'</p><br><p>For reply click on this '.$clinkSecond.'</p>
										</div>
									';
									//emailTmp( $data_table, $email_title,$manager_first,'',$manager_Cmail);
									$email_title = ucwords($_SESSION['fname']).' has Forwarded [#'.$sp_id.'] Ticket to you ' . date('d M Y');
									
									emailTmp( $data_table, $email_title,$ToEmail,'',$CCEmail);
								}
								//

				}
			}
	
	
	}

	function updateticketstatus(){
		global $db;
		$sp_status 		= $_REQUEST['sp_status']; 
		$sp_id 			= $_REQUEST['sp_id']; 
		
		$cols = "sp_status";
		$values = "'$sp_status'";
		$isAddEdit = $db->updateCol($cols,$values,'system_support',"sp_id=$sp_id");
		msg('sec',"Ticket Closed Successfully...");					

	
	}
	
	
	// by khl
	//--------------For Janib-----------//
	include("savvion/savvion_functions.php");
	//----------For Janib--------------//




	
	function lastSixMonthChecks($checkStatus='', $verificationStatus=''){
		global $db,$COMINF,$LEVEL,$company_id;
		$com_id = ($LEVEL!=4)?$company_id:$COMINF['id'];
			$LastSixMonthOpenCheckTables = "
								`ver_checks` vc 
								LEFT JOIN `ver_data` vd ON vc.`v_id` = vd.`v_id`  
								LEFT JOIN `company` com ON vd.`com_id` = com.id 
								LEFT JOIN `checks` chk ON vc.checks_id = chk.checks_id 
								";
		$LastSixMonthOpenCheckCols		= "COUNT(vc.`as_status`) Applicant_Check_Status"; 
		if($verificationStatus!=''){
			$LastSixMonthOpenCheckWhere 	= "vc.as_addate >= DATE_FORMAT(CURDATE(), '%Y-%m-01') - INTERVAL 6 MONTH AND vd.com_id=$com_id AND vc.`as_status`='$checkStatus' AND  vc.`as_vstatus`='$verificationStatus'";
		}else{
			$LastSixMonthOpenCheckWhere 	= "vc.as_addate >= DATE_FORMAT(CURDATE(), '%Y-%m-01') - INTERVAL 6 MONTH AND vd.com_id=$com_id AND vc.`as_status`='$checkStatus' ";
		}
		
		if($LEVEL==4){ 
		$uids = getUseridsLocation();
		if(!empty($uids)){
		$LastSixMonthOpenCheckWhere = " $LastSixMonthOpenCheckWhere AND vd.v_uadd IN (".implode(",",$uids).") ";	
		}
		}
		$LastSixMonthOpenCheckQuery 	= $db->select($LastSixMonthOpenCheckTables,$LastSixMonthOpenCheckCols,$LastSixMonthOpenCheckWhere);
		$LastSixMonthOpenCheckResult 	= mysql_fetch_assoc($LastSixMonthOpenCheckQuery);
		$LastSixMonthOpenCheck 			= $LastSixMonthOpenCheckResult['Applicant_Check_Status'];
		
		return $LastSixMonthOpenCheck;	
	
	}
	
	function SingleMonthChecks($checkStatus='', $verificationStatus='',$month=0, $year=0){
		global $db,$COMINF,$LEVEL,$company_id;
		$com_id = ($LEVEL!=4)?$company_id:$COMINF['id'];
			$LastSixMonthOpenCheckTables = "
								`ver_checks` vc 
								LEFT JOIN `ver_data` vd ON vc.`v_id` = vd.`v_id`  
								LEFT JOIN `company` com ON vd.`com_id` = com.id 
								LEFT JOIN `checks` chk ON vc.checks_id = chk.checks_id 
								";
		$LastSixMonthOpenCheckCols		= "COUNT(vc.`as_status`) Applicant_Check_Status"; 
		if($verificationStatus!=''){
			$LastSixMonthOpenCheckWhere 	= "MONTH(vc.as_addate) = $month AND YEAR(vc.as_addate) = $year  AND vd.com_id=$com_id AND vc.`as_status`='$checkStatus' AND  vc.`as_vstatus`='$verificationStatus'";
		}else{
			$LastSixMonthOpenCheckWhere 	= "MONTH(vc.as_addate) = $month AND YEAR(vc.as_addate) = $year  AND vd.com_id=$com_id AND vc.`as_status`='$checkStatus' ";
		}
		
		if($LEVEL==4){ 
		$uids = getUseridsLocation();
		if(!empty($uids)){
		$LastSixMonthOpenCheckWhere = "$LastSixMonthOpenCheckWhere AND vd.v_uadd IN (".implode(",",$uids).") ";	
		}
		}
		$LastSixMonthOpenCheckQuery 	= $db->select($LastSixMonthOpenCheckTables,$LastSixMonthOpenCheckCols,$LastSixMonthOpenCheckWhere);
		$LastSixMonthOpenCheckResult 	= mysql_fetch_assoc($LastSixMonthOpenCheckQuery);
		$LastSixMonthOpenCheck 			= $LastSixMonthOpenCheckResult['Applicant_Check_Status'];
		
		return $LastSixMonthOpenCheck;	
	
	}
	
	
	
	
	// download excel file by khl

	
	/* function exportDataInExcel($owhere='',$fileName='',$ORDER='v_name ASC',$limit='',$bycase=false){
	global $db,$COMINF;
	global $LEVEL;
	$_days = $_REQUEST['cal_days'];   
	 if ($_REQUEST['xcl_file_name'] == 'invoiced')
	 	{
			$ifinvoice_select = ", vc.invoiced_date AS 'Invoiced Date', vc.check_cost AS 'Check Cost', vc.invoice_number  AS 'Invoiced Number'";
		}
		else
		{
			$ifinvoice_select = "";
		}
	 
	//$excludeComs = " AND vd.com_id NOT IN (20,81,82,92) ";
	//$excludeUsers = " AND vc.user_id NOT IN (210,211,212,201,3,23,50) ";
	
	$check_status = strtolower($fileName);
	$check_date = ($check_status=='all' || $check_status=='open')?'vc.as_addate':'vc.as_cldate';
	$today = date("Y-m-d");
	if((is_numeric($_days)) && $_days!=0){
	$daysCol = ", (DATEDIFF('$today', DATE($check_date))-((WEEK($check_date) - WEEK('$today')) * 2) - (CASE WHEN WEEKDAY($check_date) = 6 THEN 1 ELSE 0 END) - (CASE WHEN WEEKDAY('$check_date') = 5 THEN 1 ELSE 0 END)) as days ";
	$having = " HAVING (DATEDIFF('$today', DATE($check_date))-((WEEK($check_date) - WEEK('$today')) * 2) - (CASE WHEN WEEKDAY($check_date) = 6 THEN 1 ELSE 0 END) - (CASE WHEN WEEKDAY('$check_date') = 5 THEN 1 ELSE 0 END)) >= $_days ";
	
	}else{
	$having="";
	$daysCol= "";
	
	}
	} */
	
	function exportDataInExcel($owhere='',$fileName='',$ORDER='v_name ASC',$limit='',$bycase=false){
	global $db,$COMINF;
	global $LEVEL;
	$_days = (int) $_REQUEST['cal_days'];   
	$check_status = explode("-",$fileName);
	//var_dump($owhere); exit;
	 if (in_array('invoiced',$check_status))
	 	{
			$ifinvoice_select = ", vc.invoiced_date AS 'Invoiced Date', vc.check_cost AS 'Check Cost', vc.invoice_number  AS 'Invoiced Number'";
		}
		else
		{
			$ifinvoice_select = "";
		}
	 
	$excludeComs = " AND vd.com_id NOT IN (20,81,82,92) ";
	$excludeUsers = " AND vc.user_id NOT IN (210,211,212,201,3,23,50) ";
	
	
		
	
	if(in_array('low_risk',$check_status)){
	$owhere = "$owhere AND as_vstatus IN ('unable to verify', 'discrepancy' , 'processed but cancelled by client', 'objection by source', 'addition information not provided by client','partially verified','original required','not verified by source')";	
	}
	$check_date = (in_array('all',$check_status) || in_array('open',$check_status) || in_array('not_initiated',$check_status) || in_array('insufficient',$check_status))?'vc.as_addate':'vc.as_cldate';
	
	
	$today = date("Y-m-d");
	if($_days>0){
	
	$today = date('Y-m-d',strtotime($today."-$_days days"));
	
	$daysWhere = " AND DATE($check_date) < '$today' ";
	}
	
	$daysCol = ", (DATEDIFF('$today', DATE($check_date))-((WEEK($check_date) - WEEK('$today')) * 2) - (CASE WHEN WEEKDAY($check_date) = 6 THEN 1 ELSE 0 END) - (CASE WHEN WEEKDAY('$today') = 5 THEN 1 ELSE 0 END)) as dayss ";
	
	$having = " HAVING (dayss >=$_days OR dayss IS NOT NULL) "; 
	
		
	
	
	
	if($LEVEL==4){ 
	$whr = " AND vd.com_id=$COMINF[id] ";
	
	$uids = getUseridsLocation();
	if(!empty($uids)){
	$whr = " $whr AND vd.v_uadd IN (".implode(",",$uids).") ";	
	}
	}
	
	
	$wwhr = ($owhere=="")?"":" $owhere AND ";
	$where = "$wwhr v_isdlt=0 $whr AND as_isdlt=0 AND v_isdlt=0 $excludeComs $excludeUsers";
	$tbls = "ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id INNER JOIN checks ck ON vc.checks_id=ck.checks_id INNER JOIN company co ON vd.com_id=co.id INNER JOIN users u ON vc.user_id=u.user_id LEFT JOIN uni_info uni ON vc.as_uni=uni.uni_id";
	if($bycase) $GROUPBY = "GROUP BY vd.v_id"; else $GROUPBY="GROUP BY vc.as_id";
	$cols = "co.name as Client, emp_id AS 'Employee ID',vd.v_name AS 'Candidate Name', ck.checks_title AS 'Check title',
			vc.as_status AS 'Working Status' ,vc.as_vstatus AS 'Verification Status' , DATE(vc.as_addate) AS 'Received On', DATE(vc.as_cldate) AS 'Closed On' ,vc.user_id AS 'Analyst Name', vc.as_addate , vc.as_cldate,  vd.com_id $daysCol , vc.as_id as Reopened , vc.as_id as 'Insufficient Reason' , v_nic as 'CNIC Number' ".$ifinvoice_select.",uni.uni_Name AS 'IA'";
	//echo "select $cols FROM $tbls WHERE $where $GROUPBY ORDER BY $ORDER  $limit"; exit;
	$setRec = $db->select($tbls,$cols,"$where $daysWhere $GROUPBY  ORDER BY $ORDER $limit");	
	if(mysql_num_rows($setRec)>0){
	$setCounter = 0; 
	$setExcelName = $fileName;
	//var_dump($setRec); exit;
	$setCounter = mysql_num_fields($setRec); 
	for ($i = 0; $i < $setCounter; $i++) {
		
	if(mysql_field_name($setRec, $i)!='as_cldate' && mysql_field_name($setRec, $i)!='as_addate' && mysql_field_name($setRec, $i)!='com_id' && mysql_field_name($setRec, $i)!='dayss' ){
	$setMainHeader .= mysql_field_name($setRec, $i)."\t"; 
	}
	}
	//$setMainHeader .= "Reopened\t"; 
	$c=0;
	while($rec = mysql_fetch_row($setRec)) { 
	
	$rowLine = ''; 
	foreach($rec as $key => $value) { 
	
	if(!isset($value) || $value == "") { 
	$value = "\t"; 
	} 
	else 
	{ 
	//It escape all the special charactor, quotes from the data. 
	$value = strip_tags(str_replace('"', '""', $value)); 
	$value = '"' . (string) $value . '"' . "\t"; }

	if($key == 8)
	{
		 
		$modvalue = str_replace('"', '', $value);
		 
		$getUserInf = getUserInfo((int)$modvalue);
		if(count($getUserInf) > 0)
		{
		$value = '"'.$getUserInf['first_name'].' '.$getUserInf['last_name'].'"'. "\t";
		}else{$asdasd = '';$value = '"'.$asdasd.'"'. "\t";}
	}
	

	

	if($key == 9)
	{    $modvalue = str_replace('"', '', $value);
		if($modvalue != '' && $modvalue != '0000-00-00 00:00:00')
		{
		$assign_date  =  $modvalue;

		}
		else
		{
		$assign_date  = $rec[11];
 		}
		// $value = '"'.$assign_date.'"'. "\t";
	}
	
 	if($key == 4)
	{   
		$modvalue1 = str_replace('"', '', trim($value));
		$modvalue2 = str_replace('\t', '', $modvalue1);
		$modvalue = str_replace(' ', '', $modvalue2);
		if($modvalue != '')
		{ 
		$replacestatus  =  replacestatus($modvalue);
		$value = '"'.$replacestatus.'"'."\t";
		}
		 
		 // echo $key.' in '.$value;
	}
	
	
	if($key == 13)
	{
		$modvalue = str_replace('"', '', $value);
		 
		$reopenedDate = getReopenedDate((int)$modvalue);

		$value = '"'.$reopenedDate.'"'."\t";
	}
	
	if($key == 14)
	{
		$modvalue = str_replace('"', '', $value);
		 
		$InsuffComments = getInsuffComments((int)$modvalue);

		$value = '"'.$InsuffComments.'"'."\t";
	}
	
	if($key!=9 && $key!=10  && $key!=11 && $key!=12 )
	{
		
	$rowLine .= (string) $value; 
	}  
	//}
	 
//	replacestatus($re['v_status']);
	
	} 
	$setData .= trim($rowLine)."\n"; 
	 
	}  
	// die;
	//$setData = str_replace("r", "", $setData); 
	if ($setData == "") 
	{ 
	$setData = "No matching records found"; 
	} 
	$setCounter = mysql_num_fields($setRec); 
	//echo $days  = getDaysFromDates($today,$rec['Daysx'],$rec['com_id']).' xxx';
	//This Header is used to make data download instead of display the data 
	 @header("Content-type: application/octet-stream"); 
	 @header("Content-Disposition: attachment; filename=".$setExcelName."_checks_list_".date("d-m-Y").".xls");
	 @header("Pragma: no-cache"); header("Expires: 0"); //It will print all the Table row as Excel file row with selected column name as header. 
	  echo ucwords($setMainHeader)."\n".$setData."\n";
	
	exit;
	}else{
		return false;	
	} 
 
}
	
	
	function save_search_resuts($posted){
	global $db,$LEVEL,$COMINF;
	
	$from_dt  		= $posted['from_dt'];
	$to_dt  		= $posted['to_dt'];
	$check_status  	= $posted['check_status'];
	$candidate_name_id  = $posted['name_id'];
	$s_checks_id  	= (!empty($posted['s_checks_id']))?$posted['s_checks_id']:array();
	$s_user_ids_vt  		= $posted['user_id'];
	$com_id  	=  ($LEVEL==4)?array($COMINF[id]):$posted['client_id'];
	$_days  		= (int) $posted['_days'];
	$send_weekly_update  = (isset($posted['send_weekly_update']))?1:0;
	$user_id=$_SESSION['user_id'];
	
	$s_checks_id = implode(",",$s_checks_id);
	$com_id = implode(",",$com_id);
	$s_user_ids_vt = implode(",",$s_user_ids_vt);
	$check_status = implode(",",$check_status);
 	
/*		if($LEVEL!=4) { 
	if(isset($user_id)){
	$whr = " AND user_id='$user_id'";
	}
	 } else { $whr = " AND send_weekly_update='$send_weekly_update' "; $user_id=$_SESSION['user_id']; }
	
$where = " from_dt='$from_dt' AND to_dt='$to_dt' AND check_status='$check_status' AND candidate_name_id='$candidate_name_id' AND s_checks_id='$s_checks_id' AND  com_id='$com_id' AND _days='$_days' $whr";
*/	
	$whr = " level_id='$LEVEL' AND  user_id='".$user_id."'";// 
	$check_com_id="";
	if($LEVEL==4){
	$check_com_id= " com_id='$com_id' AND ";
	}
	$where = " $check_com_id $whr";
	///echo  "select * FROm clients_saved_search where $where";
	$mySelRec = $db->select("clients_saved_search","id",$where);
	
	if(@mysql_num_rows($mySelRec) > 0){
	$res =	mysql_fetch_array($mySelRec);
		//echo $res[id];
	
	//var_dump($check_status);
 	$cols = "level_id,from_dt,to_dt,check_status,candidate_name_id,s_checks_id,com_id,_days,user_id, send_weekly_update";
	$vals = "$LEVEL,'$from_dt','$to_dt','$check_status','$candidate_name_id','$s_checks_id','$com_id','$_days','$user_id', $send_weekly_update";
	$cl_vl = "level_id='$LEVEL',from_dt='$from_dt',to_dt='$to_dt',check_status='$check_status',
	candidate_name_id='$candidate_name_id',s_checks_id='$s_checks_id',com_id='$com_id',_days='$_days',user_id='$user_id', send_weekly_update=$send_weekly_update ,s_user_ids_vt='$s_user_ids_vt'";
	//echo "Update clients_saved_search SET ".$cl_vl." where  id=$res[id]";
	 $db->update($cl_vl,"clients_saved_search","id=$res[id]");
	 $db->update("is_send_searched='$send_weekly_update'","users","user_id=$user_id");
	
	
	
	//$db->update($cols,$vals,"clients_saved_search");
	msg("sec","Search Update successfully.");
	
	
	}
	else
	{


	$cols = "level_id,from_dt,to_dt,check_status,candidate_name_id,s_checks_id,com_id,_days,user_id, send_weekly_update,s_user_ids_vt";
	$vals = "$LEVEL,'$from_dt','$to_dt','$check_status','$candidate_name_id','$s_checks_id','$com_id','$_days','$user_id', $send_weekly_update,'$s_user_ids_vt'";
	//echo 'cols: '.$cols.'<br> vals: '.$vals;
	
	 $db->insert($cols,$vals,"clients_saved_search");
	msg("sec","Search Saved successfully.");

	}

	
	}
	


	
	function getHolidays_Except_WeekEnds($com_id=0,$holidays='',$all=false){
		global $db,$LEVEL;
		$skipDates1 = array();
		$skipDates2 = array();
		$skipDates3 = array();
		
			if($com_id!=0){
			$selNonPaymentDays = $db->select("non_payment_clients_dates","*"," com_id=$com_id");
			while($rsNPD =	mysql_fetch_assoc($selNonPaymentDays)){
				$disable_date = ($rsNPD['disable_date']!="")?$rsNPD['disable_date']:date("Y-m-d");
				$enable_date = ($rsNPD['enable_date']!="")?$rsNPD['enable_date']:date("Y-m-d");
				$now = strtotime($disable_date); // or your date as well
				$your_date = strtotime($enable_date);
				$datediff =   $your_date - $now;
				$datediff =  floor($datediff/(60*60*24));
				
				if($datediff>0){
					for($x=0; $x<=$datediff; $x++){
					$dd = 	date("Y-m-d", strtotime($disable_date . "+$x day"));	
					$skipDates3[] = $dd;
					}
				}
				$skipDates1[] = $disable_date;	
				
				//var_dump($enable_date);
			}
			
			return $skipDates3;
			
		}
		
		if($holidays!=''){
		$selholydays = $db->select("holiday_master","*","");
			while($holydays =	mysql_fetch_array($selholydays)){
				$hol_sdate = $holydays['hol_sdate'];
				$hol_edate = $holydays['hol_edate'];
				$now = strtotime($hol_sdate); // or your date as well
				$your_date = strtotime($hol_edate);
				$datediff = $now - $your_date;
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
			
			return $skipDates2;
		}
		
		if($all){
			return $skipDates1;
		}
			
		
	}
	
	

	function getClUsersInDropDown(){
		global $db;
		$com_id = (int)$_REQUEST['com_id'];
		if(is_numeric($com_id) && $com_id!=0){
			
		$where = " com_id=$com_id AND is_subuser=0 AND is_active=1 ORDER BY first_name ASC";
		$getClUser = $db->select("users","*",$where);
		
		
		$data = "<option value='0'>--Select Parent User--</option>";
		
		
			while($rsUsers =	mysql_fetch_array($getClUser)){
		
		$data .= "<option value='".$rsUsers['user_id']."'>".$rsUsers['first_name']." ".$rsUsers['last_name']."</option>";
			
		}
		
		
		}else{
		$data = "<option value='0'>--No users for this client--</option>";	
		}
		echo $data; exit;
	}
	
	function getClLocationInDropDown(){
		global $db;
		$com_id = (int)$_REQUEST['com_id'];
		if(is_numeric($com_id) && $com_id!=0){
			
		$where = " com_id=$com_id AND status=0 ORDER BY location ASC";
		$getClLoc = $db->select("users_locations","*",$where);
		
		
		$data = "<option value='0'>--Select Location--</option>";
		
		
			while($rsCIL =	mysql_fetch_array($getClLoc)){
		
		$data .= "<option value='".$rsCIL['loc_id']."'>".$rsCIL['location']."</option>";
			
		}
		
		
		}else{
		$data = "<option value='0'>--No Location for this client--</option>";	
		}
		echo $data; exit;
	}
	
		function getUseridsLocation(){
		global $db,$LEVEL,$COMINF;
		$uid = $_SESSION['user_id'];
		$uids = array();
		$userInf = getUserInfo($uid);
		if(in_array($COMINF['id'],unserialize(CHECK_COMIDS))){
			
		if((is_numeric($userInf['loc_id']) && $userInf['loc_id']!=0) || $_SESSION['loc_id']!=""){
			
		$_SESSION['loc_id'] = (isset($_SESSION['loc_id']))?$_SESSION['loc_id']: $userInf['loc_id'];
		$selLocs = $db->select("users","user_id","com_id=$COMINF[id] AND loc_id=$_SESSION[loc_id]");
		//echo "SELECT user_id from users WHERE com_id=$COMINF[id] AND loc_id=$_SESSION[loc_id]";
		while($rsLocs = @mysql_fetch_assoc($selLocs)){
		$uids[]=$rsLocs['user_id'];
			}
		  }
		}
		
		
		return $uids;
	}
	
	function checkUseridsLocation($loc_id=0){
		global $db,$LEVEL,$COMINF;
		$uids = array();
	if($LEVEL==4){
	session_start();
	$_SESSION['loc_id']=$loc_id;
		$selLocs = $db->select("users","user_id","com_id=$COMINF[id] AND loc_id=$loc_id");
		
		while($rsLocs = @mysql_fetch_assoc($selLocs)){
		$uids[]=$rsLocs['user_id'];
			}
	}
	if(count($uids)==0) msg("err","No user available for this location"); else msg("inf","Location changed.");
		
	}

	function getUseridsByLocationId($loc_id,$com_id){
		global $db,$COMINF,$LEVEL;
		$comid = ($LEVEL==4)?$COMINF['id']:$com_id;
		$uids = array();
		
		$selLocs = $db->select("users","user_id","is_active=1 AND com_id=$comid AND loc_id=$loc_id");
		
		while($rsLocs = @mysql_fetch_assoc($selLocs)){
		$uids[]=$rsLocs['user_id'];
			}
				
		return $uids;
	}
	

	function inviteApplicantVerify(){
		global $db;
		$first_name 					= $_REQUEST['first_name'];
		$email 							= $_REQUEST['email'];
		$ids 							= $_REQUEST['ids'];
		

			
		$result = array();
			foreach ($ids as $id => $key) {
				$result[$key] = array(
				'email'    => 	$email[$id],
				'first_name'    => $first_name[$id],
				);
			}
			//print_r($result);
		//die;
		
		$arrayCount = count($result);
		$usersEmail = array();
		$error = 0;
		$fname = '';
		$q = 0;
		foreach($result as $rec){
			$first_name 			= $rec['first_name'];
			$email 			= $rec['email'];
			if($first_name=='') 	{msg('err',"Please Enter First Name!");$error = 1;}
			if($email=='') 	{msg('err',"Please Enter Email!");$error = 1;}
			//if($checkEmployeeCode!='not-found') {msg('err',"[".ucwords($first_name)."] Employee Code already exists!");$error = 1;}
			//echo checkUser($email,$first_name,$last_name);
			if($error==0){	
				//$checkEmployeeCode = checkEmployeeCode($employeCode);
					$usersEmail[] = checkUser($email,$first_name);
				
			}else{
				$error.=1;
			}
			
		}
		//$usersEmail = json_encode($usersEmail);
		//print_r($usersEmail);
		//die;
		if($error==0){	
				$c =0;
				foreach($usersEmail as $singleData){
				$data_table = 
					'<table width="100%" border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">
					<tr>
						<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Email</th>
						<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Password</th>
						<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Action</th>
					</tr>';
					$clink =  '<a href="'.SURL.'?action=login" style="color:#8EC537">View Details</a>';
					$pwd_history = ($singleData['password']!='') ? strtolower($singleData['password']) : 'Use your password';
					$data_table .= 
					'<tr>
						<td width="25%" style="font-size:12px; padding:5px;">'.$singleData['email'].'</td>
						<td width="25%" style="font-size:12px; padding:5px;">'.$pwd_history.'</td>
						<td width="25%" style="font-size:12px; padding:5px;">'.$clink.'</td>
					</tr>';
						
				$data_table .= '</table>';

				$email_title = 'Invitation '.$c;
				//echo $singleData['email']; exit;
				
				emailTmp( $data_table, $email_title,$singleData['email'],'','','','',$singleData['userFirstName']);
			$c++;
			}
				//die;
				msg('sec',"Invitation Successfylly Sent To Candidate(s)");
				//return $usersEmail;
				
		}

		
			
		
	}
	
	function addApplicantVerify(){
		global $db;
		
		$first_name 					= $_REQUEST['first_name'];
		$last_name 						= $_REQUEST['last_name'];
		$email 							= $_REQUEST['email'];
		$ids 							= $_REQUEST['ids'];
		$employeCode 					= $_REQUEST['employeCode'];
		

			
		$result = array();
			foreach ($ids as $id => $key) {
				$result[$key] = array(
				'first_name'  => $first_name[$id],
				'last_name' => $last_name[$id],
				'email'    => $email[$id],
				'employeCode'    => $employeCode[$id],
				);
			}
			//print_r($result);
		//die;
		
		$arrayCount = count($result);
		$usersEmail = array();
		$error = 0;
		$fname = '';
		$uemail = '';
		$q = 0;
		$q2 = 0;
		foreach($result as $rec){
			$email 			= $rec['email'];
			$first_name 	= $rec['first_name'];
			$last_name 		= $rec['last_name'];
			$employeCode 	= $rec['employeCode'];
			
			if($first_name=='') { msg('err',"Please Enter First Name!"); $error = 1;}
			if($last_name=='') {msg('err',"Please Enter Last Name!");$error = 1;}
			if($email=='') 	{msg('err',"Please Enter Email!");$error = 1;}
			if($employeCode=='') {msg('err',"Please Enter Employee Code!");$error = 1;}
			//if($checkEmployeeCode!='not-found') {msg('err',"[".ucwords($first_name)."] Employee Code already exists!");$error = 1;}
			//echo checkUser($email,$first_name,$last_name);
			if($error==0){	
				$checkEmployeeCode = checkEmployeeCode($employeCode);
				if($checkEmployeeCode=='not-found'){
					$usersEmail[] = checkUser($email,$first_name,$last_name,$employeCode);
					//var_dump($usersEmail[0]['error']); exit;
					if($usersEmail[0]['error']=='email_found'){
					$q2 = 1;
					$uemail .= $email.',';
					}
					
				}else{
					if($arrayCount==1 && $checkEmployeeCode!='not-found'){
						$q = 1;
						$fname .= ucwords($first_name).',';
					}else{
						$fname .= ucwords($first_name).',';
					}
				}
				
			}else{
				$error.=1;
			}
			
		}
		//$usersEmail = json_encode($usersEmail);
		//print_r($usersEmail);
		//die;
		if($error==0){	
			if($q==1){
				msg('err',"[".rtrim(ucwords($fname),",")."] Employee Code already exists. Please Try Again after completion of this process!");
			}else if($q2==1){
				msg('err',"[".rtrim(ucwords($uemail),",")."] Email address already exists. Please Try Again after completion of this process!");
			}else{
				if($fname!='') {msg('err',"[".rtrim(ucwords($fname),",")."] Employee Code already exists.!");}
				if($uemail!='') {msg('err',"[".rtrim($uemail,",")."] Email address already exists.!");}
				msg('sec',"Candidate(s) Successfully Added...");
			}
			return $usersEmail;
		}

		
			
		
	}
	

	function checkUser($email,$first_name,$last_name='',$employeCode=''){
		global $db,$COMINF;
		//echo $email,die;
		$company_id = $COMINF['id'];
		$f_name = strtolower($first_name);
		$salt = get_rand_val(8);
		$pass = md5(md5($f_name).md5($salt));	
		$checkUser = $db->select("users","*","email = '$email' ");
		if(mysql_num_rows($checkUser)>0){
				$userData  =  mysql_fetch_assoc($checkUser);
				//echo  $userData['email'];
		if($userData['invited']==0){
		$upAtt = $db->updateCol("first_name,last_name,emp_code","'$first_name','$last_name','$employeCode'","users","email = '$email'  AND level_id=5 AND com_id='$company_id'");	
		}

				return  array(	
								'user_id' 		=> $userData['user_id'],
								'first_name' 	=> $userData['first_name'],
								'password'		=> $userData['first_name'],
								'email' 		=> $userData['email'],
								'employeCode'	=> $employeCode,
								);
				
				
				
				/* return  array(
						'error' 		=> 'email_found',
						); */
		}else{
				
				$cols = "
					first_name,
					last_name,
					email,
					username,
					com_id,
					password,
					salt,
					emp_code,
					level_id,
					u_type
				";
				$values = "
					'$first_name',
					'$last_name',
					'$email',
					'$email',
					'$company_id',
					'$pass',
					'$salt',
					'$employeCode',
					5,
					1
				";
				
				$ins = $db->insert($cols,$values,'users');
				$lastinsertedID = $db->insertedID;
				
				if($lastinsertedID){
					$checkUserR = $db->select("users","*","user_id = $lastinsertedID and com_id=$company_id");
					if(mysql_num_rows($checkUserR)>0){
						$userDataR  =  mysql_fetch_assoc($checkUserR);
						return  array(	
								'user_id' 		=> $userDataR['user_id'],
								'first_name' 	=> $userDataR['first_name'],
								'password'		=> $userDataR['first_name'],
								'email' 		=> $userDataR['email'],
								'employeCode'	=> $employeCode,
								);
					
					}
				}
		}		
		
		
			
	
	}
	
	function verifyApplicants(){
		global $db,$COMINF;
		$selectedUsers 			= $_REQUEST['selectedUsers'];
		$selectedChecks 		= $_REQUEST['selectedChecks'];
		$userPass 				= $_REQUEST['userPass'];
		$userEmail 				= $_REQUEST['userEmail'];
		$userFirstName			= $_REQUEST['userFirstName'];
		$employeCodes			= $_REQUEST['employeCodes'];
		$number_of_checks		= $_REQUEST['number_of_checks'];
		$is_cic					= $_REQUEST['is_cic'];
		
		
		
			//print_r($userPass);
			//print_r($selectedUsers );
			//var_dump($selectedChecks); die();
			//foreach($selectedChecks as $sCheck){
			//	print_r($sCheck);
			//}
			//die;
			
			
			
			
			$result = array();
			$cnt = 0;
			foreach ($selectedUsers as $id) {
				$result[$cnt] = array(
				'userid'			=> $id,
				'selectedChecks'  	=> $selectedChecks[$id],
				'userPass' 			=> $userPass[$cnt],
				'userEmail' 		=> $userEmail[$cnt],
				'userFirstName' 	=> $userFirstName[$cnt],
				'employeCodes' 		=> $employeCodes[$cnt],
				'number_of_checks' 	=> $number_of_checks[$id],
				'is_cic' 			=> (isset($is_cic[$id]))?1:0,
				);
				$cnt++;
			}
			
			
			$c =0;
			foreach($result as $singleData){
				
				$check_ids = array();
				foreach($singleData['selectedChecks'] as $checksIds){
					
						$check_ids[] = 'check_ids[]='.$checksIds.'&';
				}
				//print_r($check_ids);
				$url = '';
				foreach($check_ids as $subId){
					$url .= $subId;
				}
				$length = 20;
				$cd_hash = substr(str_shuffle(md5(time().$singleData['userFirstName'])),0,$length);
				$cd_date = date('Y-m-d H:i:s');
				$cd_exp_date =date('Y-m-d', strtotime('+2 day'));
				$cd_employee_code = $singleData['employeCodes'];
				$cd_is_cic = $singleData['is_cic'];
				$xpDate =  date('d M Y', strtotime('+2 day'));
				$checks_ids =  implode(',',$singleData['selectedChecks']);
				$checks_qtys =  implode(',',$singleData['number_of_checks']);
				$userid =  $singleData['userid'];
				$selChkDate = $db->select("check_date","cd_id","user_id=$userid");
				$rsCheckDate = @mysql_fetch_assoc($selChkDate);
				$invited_by =  $_SESSION['user_id'];
				
				$cols = "
					cd_hash,
					cd_date,
					cd_exp_date,
					cd_employee_code,
					user_id,
					checks_ids,
					checks_qtys,
					is_cic,
					invited_by
				";
				$values = "
					'$cd_hash',
					'$cd_date',
					'$cd_exp_date',
					'$cd_employee_code',
					'$userid',
					'$checks_ids',
					'$checks_qtys',
					'$cd_is_cic',
					'$invited_by'
					
				";
			//echo "INSERT INTO check_date ($cols) VALUES($values)"; exit;
				
				if(@mysql_num_rows($selChkDate)>0){
				$update = $db->updateCol($cols,$values,"check_date","cd_id=$rsCheckDate[cd_id]");
				}else{
				$ins = $db->insert($cols,$values,'check_date');
				$in_id = $db->insertedID;	
				}
								
				$upd = $db->update("invited=1","users","user_id='$userid'");
				$url =  rtrim($url, "&");
				$furl = $url.'&emp_code='.$singleData['employeCodes'].'&hash='.$cd_hash;
				$data_table = 
					'
					<table width="100%" border="0" style="border-collapse: collapse; color:#999;  ">
						<tr>
						<td width="25%" style="font-size:14px; padding:5px;" colspan="3"><strong>'.$COMINF['name'].'</strong> have asked us to perform a background check as part of their screening process. In order to proceed, you need to complete the following online form.</td>
						</tr>
						<tr>
						<td width="25%" style="font-size:14px; padding:5px;" colspan="3">What do I need to do? </td>
						</tr>
						<tr>
						<td width="25%" style="font-size:14px; padding:5px;" colspan="3">Please enter your details by visiting the following secure link:</td>
						</tr>
						<tr>
						<td width="25%" style="font-size:14px; padding:5px;" colspan="3">We recommend completing the form on a computer or tablet for the best experience</td>
						</tr>
						<tr>
						<td width="25%" style="font-size:14px; padding:5px;" colspan="3">&nbsp;</td>
						</tr>
					</table>
					
					<table width="100%" border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">
					
					<tr>
						<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Email</th>
						<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Password</th>
						<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Action</th>
					</tr>';
					$clink =  '<a href="'.SURL.'?action=addappcase&atype=checks&'.$furl.'" style="color:#8EC537">Click here to start your background check</a>';
					$pwd_history = ($singleData['userPass']!='') ? strtolower($singleData['userPass']) : 'Use your password';
					$data_table .= 
					'<tr>
						<td width="25%" style="font-size:12px; padding:5px;">'.$singleData['userEmail'].'</td>
						<td width="25%" style="font-size:12px; padding:5px;">'.$pwd_history.'</td>
						<td width="25%" style="font-size:12px; padding:5px;">'.$clink.'</td>
					</tr>';
						
				$data_table .= '</table><br><b>Please Note:</b><p>The required Information must be submit before '.$xpDate.' </p>';

				$email_title = $COMINF['name'].' have requested a background check on you.';
				$emailSender = $singleData['userEmail'];
				//echo $singleData['userEmail']; exit;
				//echo 'yes';
				//echo emailTmp( $data_table, $email_title,'atta@xcluesiv.com');
				//echo emailTmp( $data_table, $email_title,$emailSender);
				echo emailTmp( $data_table, $email_title,$singleData['userEmail'],'','','','',$singleData['userFirstName']);
			$c++;
			}
			//die;
			msg('sec',"Request Successfylly Sent To Candidate(s)");
	}
	
	function checkEmployeeCode($empCode){
		global $db,$COMINF;
		
		$com_id = $COMINF['id'];

		$where = "emp_id='".$empCode."' AND com_id='".$com_id."' ";
		$Q = $db->select("ver_data","v_id",$where); 
		$r = mysql_num_rows($Q);
		
		if($r>0){						
			$msg =  "This Employee Code already exists"; 
		}else{
			$whereS = "cd_employee_code='".$empCode."'";
			$QS = $db->select("check_date","cd_id",$whereS); 
			$rS = mysql_num_rows($QS);
			if($rS>0){
				$msg =  "This Employee Code already exists"; 
			}else{
				$msg = "not-found"; 
			}
		}
		

		return  $msg; 

	}
	
	// skip a check for nadra checks bk khl
	
	function skipCheck(){
		global $db,$COMINF;
		$uID = $_SESSION['user_id'];
		$as_id = $_REQUEST['as_id'];
		$is_skipped = $_REQUEST['is_skipped'];
		
		$QS = $db->select("skipped_checks","id","as_id=$as_id"); 
		$rS = mysql_num_rows($QS);
			if($rS>0){
			$isTrig = $db->update("is_skipped=$is_skipped,user_id=$uID,update_date=CURRENT_TIMESTAMP","skipped_checks","as_id=$as_id");	
			$db->update("is_skipped=$is_skipped","ver_checks","as_id=$as_id");
			}else{
			$isTrig = $db->insert("user_id,as_id,is_skipped","$uID,$as_id,$is_skipped","skipped_checks");	
			$db->update("is_skipped=$is_skipped","ver_checks","as_id=$as_id");
			}
			if($isTrig){ return true; } else { return false; }
	}
	
	function autoSaveApplicant($post=array()){
		global $db,$COMINF;
		$draftTable = "app_drafts";
		$uID = $_SESSION['user_id'];
		$company_id = (isset($COMINF['id']))?$COMINF['id']:$_REQUEST['clntid'];
		//var_dump($_REQUEST); exit;
		$nums=1;
		$sel = $db->select($draftTable,"draft_id","user_id=$uID"); 
		while(isset($_REQUEST['ename'.$nums])){
					
					if(isset($_REQUEST['case'.$nums])){
						
					//add new fields
					$etitle = addslashes($_REQUEST['etitle'.$nums]);
					$gender = addslashes($_REQUEST['gender'.$nums]);
					$first_ename = addslashes($_REQUEST['ename'.$nums]);	
					$last_ename = addslashes($_REQUEST['last_ename'.$nums]);
					$fullName = ($first_ename!="" || $last_ename!="")?$first_ename." ".$last_ename:"";
					$ename = ($fullName!="")?$fullName:$first_ename;
					
					$fname 	= addslashes($_REQUEST['fname'.$nums]);
					$empcode = addslashes($_REQUEST['empcode'.$nums]);
					$cnic = addslashes($_REQUEST['cnic'.$nums]);
					$dob = addslashes($_REQUEST['dob'.$nums]);
					$image='images/default.png';
					$ischeck = $_REQUEST['ischeck'.$nums];
					$ischeck = (!empty($ischeck))?implode(",",$ischeck):"";
									
					if(isset($_REQUEST['image'.$nums])){
						$image = addslashes($_REQUEST['image'.$nums]);
						
					}
					
				$cols="user_id,title,gender, first_name,last_name, father_name,cnic,dob,com_id,emp_id,checks_ids";
				$values="'$uID','$etitle','$gender','$first_ename','$last_ename','$fname','$cnic','$dob',$company_id, '".$empcode."', '".$ischeck."'";
					//echo "cols: ".$cols." values: ".$values; exit;
					if(mysql_num_rows($sel)>0){
						if($etitle || $first_ename){
					$update = $db->updateCol($cols.",update_date",$values.", CURRENT_TIMESTAMP",$draftTable,"user_id=$uID");
					echo "Update success"; exit;
					}else{
					
						  $get_autosave = $db->select($draftTable,"*","user_id=$uID"); ;
						
						while ($gt_v = mysql_fetch_assoc($get_autosave)) {
							
							echo json_encode(array(
							'title' => $gt_v['title'], 
							'first_name' => $gt_v['first_name'], 
							'last_name' => $gt_v['last_name'], 
							'gender' => $gt_v['gender'], 
							'father_name' => $gt_v['father_name'], 
							'cnic' => $gt_v['cnic'], 
							'dob' => $gt_v['dob'], 
							'emp_id' => $gt_v['emp_id'], 
							'v_image' => $gt_v['v_image'], 
							'checks_ids' => $gt_v['checks_ids'], 
							'attach' => $gt_v['attach'],
							
							)
							); exit;
						}
						
					}
					
					}else{
						
					$isInserted = $db->insert($cols,$values,$draftTable);	
					echo "Insert success"; exit;
					}
			}
			
			
		}
		
		return false;
		
		
	}
	
	
	
	
	/* -------------------------------- New Functionality for credit system Start ------------------------------ */
	
	function get_currency($from_Currency, $to_Currency, $amount) {
    $amount = urlencode($amount);
    $from_Currency = urlencode($from_Currency);
    $to_Currency = urlencode($to_Currency);
	
	// https://currency-api.appspot.com/public/api/USD/PKR.json?amount=1.00 <---- (We have this api too)
    
	$url = "http://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";

    $ch = curl_init();
    $timeout = 0;
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt ($ch, CURLOPT_USERAGENT,
    "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $rawdata = curl_exec($ch);
    curl_close($ch);
    $data = explode('bld>', $rawdata);
    $data = explode($to_Currency, $data[1]);

    return round($data[0], 2);
	}
	
	
	// by khl
	
	function getCredits($com_id=""){
		global $db,$COMINF,$LEVEL;
		
		if($LEVEL==4){
		return (int) $COMINF['credits'];
		}else{
		
		$com = @mysql_fetch_assoc($db->select("company","credits","id = $com_id"));
		return (int) $com['credits'];
		}
	}
	
	
	// by khl
	function getCheckAmount($com_id,$checks_id){
		global $db;
		
		$com = @mysql_fetch_assoc($db->select("clients_checks","clt_cost,clt_currency","com_id = $com_id AND checks_id=$checks_id  "));
		
		if($com['clt_currency']=="PKR"){
		$check_amount = (int) $com['clt_cost'];	
		}else{
		// api integration needed for USD to PKR
		$check_amount = get_currency($com['clt_currency'], 'PKR', $com['clt_cost']);
		
		}
		
		return $check_amount;
		
		
	}
	
	function getMasterCheckAmount($checks_id){
		global $db;
		
		$com = @mysql_fetch_assoc($db->select("checks","checks_amt","checks_id=$checks_id  "));
				
		$check_amount = (int) $com['checks_amt'];	
				
		return $check_amount;
		
		
	}
	
	// by khl
	function ChecksAmount($data,$com_id,$isBulk=false,$addOrder=false,$VID=0){

	global $db,$LEVEL;
	$comInfo = getcompany($com_id);
	$COMINF = @mysql_fetch_array($comInfo);
	$nums=1;
	$totalAmount=0;
	
	// if single check uploaded
	if(!$isBulk){
	while(isset($data['ename'.$nums])){
	if(isset($data['case'.$nums])){
	foreach($data['checks'.$nums] as $key => $check){
		
	$chkk = explode("_",$check);
	$chk = $chkk[0];
	
		if(is_array($data['ischeck'.$nums]) && in_array($check,$data['ischeck'.$nums])){
		
		
			$check_amount = getCheckAmount($com_id,$chk);
			$totalAmount = $totalAmount+$check_amount;
		
		}
		
	
	} // foreach
	} // if
	$nums++;
	}	// while
	}else{
	
	while(isset($data['first_name'.$nums])){
	if($data['skip_case'][$nums]!=$nums){
	foreach($data['checks'] as $key => $check){
					
	$check_amount = getCheckAmount($com_id,$check);
	
	$totalAmount = $totalAmount+$check_amount;
		
	
	} // foreach
	} // if
	$nums++;
	}	// while	
	}	
	
	//echo $totalAmount; die;
	$clientCredits = getCredits($com_id);
	
	$remainingCredits = $clientCredits-$totalAmount;
	if(!$addOrder){
	if($totalAmount < $clientCredits){
	return true;	
	}else{
	if($COMINF['account_type']==1){
	if(!$isBulk){
	msg('err',"Your order amount $totalAmount exceeded  from your bucket $clientCredits. Please contact support team. ");
	}else{
	echo  "Your order amount $totalAmount exceeded  from your bucket $clientCredits. Please contact support team. "; exit;	
	}
	}
	}	
	}else{
	if($totalAmount < $clientCredits){
	if($COMINF['account_type']==1){	
	$db->update("credits=$remainingCredits","company","id=$com_id");
	}
	// add order
	$inserted_id = addClientInvoice($com_id,$totalAmount,$VID);
	if(!($inserted_id)){
	if(!$isBulk){
	msg('err',"Order can not be placed due to insertion error. Please try again. ");
	}else{
		
	echo "Order can not be placed due to insertion error. Please try again. "; exit;	
	
	}	
	}else{
	return 	$inserted_id;
	}
	
	
	}else{
	if($COMINF['account_type']==1){
	if(!$isBulk){
	msg('err',"Your order amount $totalAmount exceeded  from your bucket $clientCredits. Please contact support team. ");
	}else{
	echo  "Your order amount $totalAmount exceeded  from your bucket $clientCredits. Please contact support team. "; exit;	
	}
	}
	}
	}
	//die;
	}
	
	
	function addClientInvoice($com_id,$cost=0,$v_id=0){
		
	global $db,$LEVEL;
	
	$startDate = date("Y-m-d H:i:s");
	$dueDate = getdatedifference($startDate,15);
	$dueDate = 	date("Y-m-d", strtotime($dueDate));
	if($v_id!=0){
	$vcol = ",v_id";	
	$vval = ",$v_id";	
	}
	$cols = "com_id,cost,due_date".$vcol;
	$values = "$com_id,$cost,'$dueDate'".$vval;
	
	
	$ins = $db->insert($cols,$values,"client_invoices");
	if($ins){
	$in_id = $db->insertedID;
	$comInfo = mysql_fetch_assoc(getcompany($com_id));
	$user_info=getUserInfo($_SESSION['user_id']);
	$userName = $user_info['first_name']." ".$user_info['last_name'];
	$lev = getLevel($LEVEL);
	
	$a_info = "New check order submitted by $userName ($lev[level_name]) for $comInfo[name] ";
					
	$notify = createNotifications(4,$a_info);
		
	return $in_id;
	}else{
	return false;	
	}
	
	}
	 // by khl
	function insuff_docs($att_ids){
	 
	$db = new DB();
	//ia_before_init
	$as_id = (int)$_POST['as_id'];
	$ia_before_init = (int)$_POST['unilists'];
	if($ia_before_init!='' && $ia_before_init!=0){
	$getUniInfo = getUniInfo($ia_before_init);
	$IA_Name = '('.$getUniInfo['uni_Name'].')';
	}
	$v_id = (int)$_POST['v_id'];
	$vCheck = getCheck(0,0,$as_id);
	$tCheck = getCheck($vCheck['checks_id'],0,0);
	$vData  = getVerdata($vCheck['v_id']);
	$insuffReason = array();
	$countInsuff = 0;
	$bodyText="";
	if(count($att_ids)>0){
		foreach($att_ids as $att_id){
		if(is_numeric($att_id)){
			
		$att_insuff_status = $_POST['att_insuff'.$att_id];
		
		
		if ($att_insuff_status==1){
		$countInsuff++;
		$insuff_title = 'insufficient';
		$att_upd_date_col = 'att_insuff_date';
		$insuf_comment_val = addslashes($_POST['insuf_comm_'.$att_id]);
		$insuffReason[] = $insuf_comment_val;
		$bodyText .= "$tCheck[checks_title] check $IA_Name: $insuf_comment_val <br/>";
		}else{
		$insuff_title = 'sufficient';
		$att_upd_date_col = 'att_suff_date';
		$insuf_comment_val = '';
		}
		$db->update("att_insuff='$att_insuff_status', $att_upd_date_col=CURRENT_TIMESTAMP,att_comments='$insuf_comment_val'","attachments","att_id=$att_id");
		}
		}  
	//var_dump($countInsuff); die;
	if($countInsuff>0){
	$att_comments = (!empty($insuffReason))?'<br> Insuffciency Reason:<br>'.implode('<br>',$insuffReason):'';
	$Att = ($countInsuff>1)?'Attachments have':'Attachment has';
	
	// new text format provided by Boss
	$a_info = "<strong>URGENT ACTION REQUIRED: <a href=\"".SURL."?action=details&case=$vData[v_id]&_pid=81\">$vData[v_id]</a></strong> <br/><br/>With reference to your submitted verification of <strong><a href=\"".SURL."?action=details&case=$vData[v_id]&_pid=81#check_tab_$as_id\">$vData[v_name]</a></strong>, please note that $countInsuff $Att been <strong>marked as insufficient</strong> <br/><br/>$bodyText<br/>";
	
	// old text format by khl
	//$a_info = "$countInsuff $Att marked as insufficient by analyst (".SUDONYMS.") of Check:$_POST[chk_name] (Client: $_POST[com_name] and Candidate: ) $att_comments";
	$localDate = date("D, M d, Y");
	$subject = "$_POST[com_name], Insufficient Alert - $vData[v_name] ($localDate)";
	
	 $db->update("as_status='Insufficient'","ver_checks","as_id=$as_id");				
	 $notify = createNotifications(4,$a_info,$v_id,'','','insufficient',$as_id,'client',$subject);
	}
	$db->update("ia_before_init='$ia_before_init'","ver_checks","as_id=$as_id");
	
	msg('sec',"Selected attachments marked as sufficient/insufficient !");
	
	}else{
	msg('err',"No attachment selected to update!");
	}
	
		
	}
	
	// by khl
	function confirm_check_suff(){
	 global $db,$LEVEL;
	
	$as_id = (int)$_POST['as_id'];
	$v_id = (int)$_POST['v_id'];
	$vCheck = getCheck(0,0,$as_id);
	$tCheck = getCheck($vCheck['checks_id'],0,0);
	$vData  = getVerdata($vCheck['v_id']);
	
	if($as_id){
	$chkAtt =  getAttachments("checks_id=$as_id");
	
	
	
		
		
	$att = getAttachments("checks_id=$as_id AND att_insuff=1");
	
	if(@mysql_num_rows($att)==0){
	if(($vCheck['checks_id']==1 || $vCheck['checks_id']==2) && @mysql_num_rows($chkAtt)==0){
	
	msg('err',"No attachment found in this $tCheck[checks_title] check!");		
	
	}else{ 
	$upAtt = $db->updateCol("is_sufficient,sufficient_date,as_status","1,CURRENT_TIMESTAMP,'Open'","ver_checks","as_id=".$as_id);	
	
	}
	if($upAtt){
	
	$a_info = "$_POST[chk_name] Check marked as sufficient by analyst (".SUDONYMS.") of Candidate <a href=\"".SURL."?action=details&case=$vData[v_id]&_pid=81#check_tab_$as_id\">$vData[v_name]</a>";
					
	 $notify = createNotifications(4,$a_info,$v_id,'','','sufficient',$as_id,'client');
		
	msg('sec',"Check marked as sufficient.");
	}else{
	msg('err',"Updation Error!");	
	}
	}else{
	msg('err',"It seems insufficiency not cleared yet!");
	}
	}else{
	msg('err',"Updation Error!");
	}
		
	}
	
	
	function is_check_sufficiency($as_id){
		 global $db,$LEVEL;
		 $sel = $db->select("ver_checks","as_id","is_sufficient=1 AND as_id=$as_id");
		 if(@mysql_num_rows($sel)==1){
		 return true;	 
		 }else{
		 return false;	 
		 }
		 
	}
	
	// by khl
	function chk_or_sel($data1,$data2,$case){
		
		switch($case){
			case 'selected':
			$ret = 'selected="selected"';
			break;
			case 'checked':
			$ret = 'checked="checked"';
			break;
		}
		
		if($data1==$data2){
			return $ret;
		}else{
			return false;
		}
		
	}
	function del_attached($att_id){
		$db = new DB();
		if(is_numeric($att_id) && $att_id!=0){
		if($db->delete("attachments","att_id=$att_id")){
		msg('sec',"Attachment deleted successfully.");
		}else{
		msg('err',"Error occured while deleting attachment !");
		}
	}else{
		msg('err',"Invalid try to delete attachment !");
	}
	}
	/*
	ATA ABBAS CODE START HERE
	
	*/
	function getInputs(){
 		$db = new DB();
 		$getInputs = $db->select("inputs","*","in_id <> 0");
		while($result = mysql_fetch_array($getInputs))
		{
  		return $result; 
		}
	}

	function getCheckfields($chechid){
 		$db = new DB();
			$tabl = "fields_maping as fm INNER JOIN inputs as inp ON fm.in_id=inp.in_id";
	//$cols = "cm.com_title,cm.com_text,cm.com_date,ur.uimg,ur.first_name,ur.last_name,cm._id,vd.v_id";
	$comnts = $db->select($tabl,$cols,"$where ORDER BY com_date DESC $limit");

		
 		$getInputs = $db->select($tabl,"*","fm.checks_id = ".$chechid."");
		
 		//while($result = mysql_fetch_array($getInputs))
		//{
  		return $getInputs; 
		//}
	}


	function updateChecklabel($label,$mapid){
 		$db = new DB();
 		$isInsUpd = $db->update("fl_title='$label'","fields_maping","fl_id=$mapid");
   		//return $getInputs; 
		 
	}





function addeditcompany($comp_arr){
$ch = curl_init();
 $query_string="action=add_company&pams[TITLE]=".trim($comp_arr['cName'])."&pams[email]=".$comp_arr['cEmail']."&pams[phone]=".$comp_arr['phone']."&pams[comp_type]=2
 &pams[comments]=".$comp_arr['comments'];
 //echo $query_string;die;
    curl_setopt($ch, CURLOPT_URL, BITRIX_URL);
    // Set a referer
   curl_setopt($ch, CURLOPT_HEADER, FALSE);
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
    // Download the given URL, and return output
  echo  $output = curl_exec($ch);
	$inserteduserid=json_decode($output);
   $compinserted_id=$inserteduserid->compinserted_id;
	//$db->update("bitrixcomp_id='$compinserted_id'","comp_info","id=".(int)$comp_arr['id']."");
    // Close the cURL resource, and free system resources
    curl_close($ch);
	
	
	}





	
	
	
	
	
	
	
	
	
	
	
	// Function by ata start from here for manage company location //

 				 
		function managecomlocations()
			{
				global $db;
				
 				if($_REQUEST['addeditsec'] == "editsec" && $_REQUEST['locid'] != "" && $_REQUEST['com_id'] != 0) // FOR UPDATE
				{
					
				$db->update("location='".$_REQUEST['location']."',com_id='".$_REQUEST['com_id']."'","users_locations","loc_id='".$_REQUEST['locid']."'");	msg("sec","Location Updated successfully.");				
				}
				
 				else if($_REQUEST['addeditsec'] == "addsec" && $_REQUEST['com_id'] != 0) // FOR INSERT
				{
					if($_REQUEST['locid'] == "")
					{
					$cols = "com_id,location,status";
					$vals = "$_REQUEST[com_id],'$_REQUEST[location]','0'";
					$db->insert($cols,$vals,'users_locations');
					msg("sec","Location added successfully.");
					}
				}
				else
				{
					$msgs = ($_REQUEST['addeditsec']=='addsec')?'Adding':'Updating';
					msg("err"," Error occured while $msgs Location !");	
				}
				
			}
		
	// Function by ata end here for manage company location //
	
	 function whmcs_api($url,$postfields){
	$username = "danish"; 
	$password = "Bcpl~123"; 
	 $postfields["username"] = $username;
	 $postfields["password"] = md5($password);
	 $postfields["responsetype"] = "xml";
	 return sendcurlrequest($postfields,$url);
	 }
 
	
	/*
	
	ATA ABBAS CODE END HERE
	*/
	
	
	
	// by khl
	function getRandSdoNms(){
		
	// Create an array and push on the names
	$friends=array("Marcus Rothkowitz", "Ondrej", "Robert Bruce", "Barry Allen", "Bart Allen", "Peter Wiggin","Eion Morgan","Tamina");
	array_push($friends, "Michel Cole", "William Regal", "Daniel","Gilbert Bourgeaud","Isaac Blank","Issa Bell","Stephen","Michel Raptis");
	// Sort the list
	sort($friends);
	
	$winner = array_rand($friends, 1);
	return  $friends[$winner];

		
	}
	
	function getQCCheckList($checks_id){
					global $db;
					$data = array();
						//echo "SELECT * from check_list_of_checks where checks_id=$checks_id AND is_active=1";
					$sel = $db->select("check_list_of_checks","id,check_list","checks_id=$checks_id AND is_active=1 ");
					//echo @mysql_num_rows($sel);
					if(@mysql_num_rows($sel)>0){
					while($res = @mysql_fetch_array($sel)){
					$data[] = $res;	
					}
					return $data;
					}else{
					return $data;	
					}
				  }
	
	
	function getLocationByUserID($user_id){
	global $db;
	$getUserInf = getUserInfo($user_id);
	if($getUserInf['loc_id']!=0){
	$orerInfo = getInfo("users_locations","loc_id=$getUserInf[loc_id]");
	return $orerInfo['location'];
	}else{
	return 'Head Office';	
	}
	
} 

 function isLocationWise($com_id){
	global $db;
	$comInfo = getcompany($com_id);
	$comInfo = @mysql_fetch_array($comInfo);
	if($comInfo['location_wise']==1){
	return true;
	}else{
	return false;	
	}
	
}
	
	
	
	function getFileIcon($ext){
		
				 switch($ext){
					 
					 case 'pdf':
					 $return = '<i class="icon-file-pdf"></i>';
					 break;
					 case 'docx':
					 case 'doc':
					 case 'txt':
					 $return = '<i class="icon-file-word"></i>';
					 break;
					 case 'xls':
					 case 'csv':
					 $return = '<i class="icon-file-excel"></i>';
					 break;
					
					default :
					 $return = '<i class="icon-file-word"></i>';
					break;
					
					 
				 }
				 return $return;
				 }
	
	function getSize($file){
				$bytes = filesize($file);
				if($bytes!=0){
				$s = array('b', 'Kb', 'Mb', 'Gb');
				$e = floor(log($bytes)/log(1024));
				return sprintf('%d '.$s[$e], ($bytes/pow(1024, ceil($e))));
				}
				}
	
	
	
	
	function getPercentage($total,$cnt){
			$RemainedPer=0;
			if($total!=0 && $cnt!=0){
			$RemainedPer = floor(($cnt/$total)*100);	
			}
			return $RemainedPer;
			
		}
	
	function getApplicants($com_id=0,$whr=""){
			global $db;
			$com_id = (int)($com_id);
			$whr = ($whr!="")?" AND $whr":"";
			$where = ($com_id!=0)?" AND com_id='$com_id' $whr ":"$whr";
			$selApp = $db->select("users","*","level_id=5 AND is_active=1 $where"); 
			$data=array();
			if(@mysql_num_rows($selApp)>0){
			
			while($rs = @mysql_fetch_assoc($selApp)){
			$data[] = $rs;	
			}	
			}
			
			return $data;
			 
		 }
	
	function getAllOpenChecks($whr=""){
			  global $db;
			  $data=array();
			  $whr = ($whr!="")?" AND $whr":"";
			  $sel = $db->select("ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id","*","as_status = 'Open' AND as_vstatus!='Not Initiated' AND as_isdlt=0 AND as_cldate IS NULL  $whr");
			  //echo "SELECT * FROM ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id WHERE as_status = 'Open' AND as_vstatus!='Not Initiated' AND as_isdlt=0 AND as_cldate IS NULL  $whr";
			  while($rs = @mysql_fetch_assoc($sel)){
			  $data[] =$rs; 
			  }
			  return $data;
			  
		  }
	function getAllClosedChecks($whr=""){
			  global $db;
			  $data=array();
			  $whr = ($whr!="")?" AND $whr":"";
			  $sel = $db->select("ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id","*","as_status = 'Close' AND as_qastatus!='Rejected' AND as_isdlt=0  $whr");
			  while($rs = @mysql_fetch_assoc($sel)){
			  $data[] =$rs; 
			  }
			  return $data;
			  
		  }
	function getUniInfo($uni_id){
		  global $db;
		   $sel = $db->select("uni_info","*","uni_id=$uni_id");
		   $rs=array();
		   if(@mysql_num_rows($sel)){
			$rs = @mysql_fetch_array($sel);   
		   }
		   return $rs;
	}
	
	function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
	
	
	function convertUCWords($title){
		$title = strtolower($title);
		$title = ucwords($title);
		return $title;
	}
	
	function sub_email_notify($posted){
		global $db;
		$user_id = $_SESSION['user_id'];
		$is_other_notify = (isset($posted['is_other_notify']))?$posted['is_other_notify']:0;
		$is_weekly_updates = (isset($posted['is_weekly_updates']))?$posted['is_weekly_updates']:0;
		$is_send_searched = (isset($posted['is_send_searched']))?$posted['is_send_searched']:0;
		$is_insuff_notify = (isset($posted['is_insuff_notify']))?$posted['is_insuff_notify']:0;
		$is_insuff_notify_digest = (isset($posted['is_insuff_notify_digest']))?$posted['is_insuff_notify_digest']:0;
		$is_checks_added_notify = (isset($posted['is_checks_added_notify']))?$posted['is_checks_added_notify']:0;
		$res = $db->update("is_other_notify=$is_other_notify,is_weekly_updates=$is_weekly_updates,is_send_searched=$is_send_searched,is_insuff_notify=$is_insuff_notify,is_insuff_notify_digest=$is_insuff_notify_digest,is_checks_added_notify=$is_checks_added_notify","users","user_id=$user_id");
		if($res){
		msg("sec","Notification settings updated successfully.");	
		}else{
		msg("err","Updation error occured!");		
		}
		}
	
	function update_billing_contact($posted){
		global $db,$COMINF;
		$poc_name = $posted['poc_name'];
		$poc_email = $posted['poc_email'];
		$poc_phone = $posted['poc_phone'];
		$isUpd = $db->update("poc_name='$poc_name',poc_email='$poc_email',poc_phone='$poc_phone'","clients_poc","com_id=$COMINF[id] AND poc_designation='finance'");
		if($isUpd){
		msg("sec","Billing contact updated successfully.");	
		}else{
		msg("err","Updation error occured.");		
		}
			
		}
	
	
	
	
	function getClientPkgChecks($com_id){
			global $db;
			$data = array();
			
			$where = "cc.com_id=$com_id AND ck.is_active=1 AND cc.clt_active=1 order by ck.checks_id";
			$tabls = "checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id";
			$checks = $db->select($tabls,"*",$where);
			if(mysql_num_rows($checks)>0){
				
				while($check = mysql_fetch_assoc($checks)){
				$data['client_checks'][] = $check;
				$data['checks_ids'][] = $check['checks_id'];
				
				}
				return $data;
		}
		}
	
	function addCICCheckInCase($checks,$VID,$company_id,$country,$workgroupInfo=array(),$uID,$task_desc,$ename){
		global $db;
		//$data = array();
		$check_array = array();
		foreach($checks as $check){
		$chkk = explode("_",$check);
		$chk = $chkk[0];
		$check_array[] = $chk;
		}
		
		// balance cic check fixed amount 6000
	
		if(in_array(9,$check_array)){
		$data = array(39=>2000,40=>2000,41=>2000);
		//$checks_prices['checks_price'] = array(2000,2000,2000);
		$nadraCheck=false;	
		}else{
		$data = array(9=>300,39=>1900,40=>1900,41=>1900);
		//$checks_prices['checks_price'] = array(300,1900,1900,1900);
		
		$nadraCheck=true;		
		}
		//$data = array_merge($checks_ids,$checks_prices);
		if(!empty($data)){
			
			foreach($data as $check=>$price){
				//var_dump('In:',$data);
				$bCode = cBCode(0,0,$VID,$check);
				$as_cost2 = $price;
				$chk = $check;	
				// khl	//
				
				if($country!=171){	
				$AssignedToSys = $workgroupInfo['AssignedToSys']; // user_id	Sadia=20 249=Sharjeel
				$AssignedToBitrix = $workgroupInfo['AssignedToBitrix'];  // bitrix user_id Sadia=480 529=Sharjeel
				$Work_Group_id = $workgroupInfo['Work_Group_id'];
				}
							
				$tabl = "analyst_roles ar INNER JOIN checks c ON ar.checks_id=c.checks_id ";
				$cols = "ar.analyst_id,c.checks_title,c.group_id as group_id";
				$selRoles = $db->select($tabl,$cols," ar.checks_id='".$chk."'");
				$resRoles = mysql_fetch_assoc($selRoles);
				$tabl = "`teamlead_checks` tc INNER JOIN users uc ON uc.`user_id`=tc.`team_lead_id`";
				$cols = "uc.`bitrix_id` AS `bitrix_uid`,uc.`user_id` AS `user_id`";
				$selbitrixusr = $db->select($tabl,$cols,"tc.checks_id='".$resRoles['group_id']."'");
				$bitrixuserid=mysql_fetch_assoc($selbitrixusr);
				$bitrixuserid2=($country!=171)?$AssignedToBitrix:$bitrixuserid['bitrix_uid'];
				$userid2=($country!=171)?$AssignedToSys:$bitrixuserid['user_id'];
				$analyst_id = ($resRoles['analyst_id'])?$resRoles['analyst_id']:'';
				$checks_title = ($resRoles['checks_title'])?$resRoles['checks_title']:'';
					
				//----------------- Temporary Commented --------------------//
				$assign_cols = "";
				$assign_values = "";
				$assign_cols = "user_id,as_status, ";
				$assign_values = "'".$userid2."','Open', ";
				$db->update("v_status='Open'","ver_data","v_id=$VID");
				//----------------- Temporary Commented --------------------//	
				$cols="as_bcode,v_id,checks_id, $assign_cols as_uadd , as_addate, as_date, how_rec_checks,as_cost2";
				$values="'$bCode',$VID,'$chk', $assign_values '$uID',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP,'by_client','$as_cost2'";
				//echo "Insert into ver_checks ($cols), VALUES($values)";
				if($db->insert($cols,$values,"ver_checks")){
				$CID=$db->insertedID;
					
				// add to bitrix	
				$task_array=array();
				$task_array['task_name']='Check For '.$ename ." - $bCode";
				$task_array['task_desc']=$task_desc."Attachments : No Attachment";
				
				$task_array['user_id']=($country!=171)?$AssignedToBitrix:$bitrixuserid2;
				$task_array['group_id']=($country!=171)?$Work_Group_id:$resRoles['group_id'];
				$task_array['country_id']=$country;
				//print_r($task_array);die;
				$bitrixctid=add_task($task_array,$bitrixlid);
				$db->update("bitrixtid=$bitrixctid","ver_checks","as_id=$CID");
				}else{
					 //msg('err',"Check insertion error!");
					$any_error = true;
				}
				}
		}
		
		return true;
	
	}
	
	
	function sendNewLinkToApplicant($user_id){


		global $db,$COMINF;
		
		$UserInfo = getUserInfo($user_id);
		$today = date("Y-m-d");
		$userPass 				= $UserInfo['first_name'];
		$userEmail 				= $UserInfo['email'];
		$userFirstName			= $UserInfo['first_name'];
		$check_date_info        = $db->select("check_date","*","user_id=$user_id");	
		$rsCheckDate 			= @mysql_fetch_assoc($check_date_info);
			
			$c =0;
		if(strtotime($today)>strtotime($rsCheckDate['cd_exp_date'])){
				
				$check_ids = array();
				$selectedChecks = explode(",",$rsCheckDate['checks_ids']);
				foreach($selectedChecks as $checksIds){
					
						$check_ids[] = 'check_ids[]='.$checksIds.'&';
				}
				//print_r($check_ids);
				$url = '';
				foreach($check_ids as $subId){
					$url .= $subId;
				}
				$length = 20;
				$cd_hash = substr(str_shuffle(md5(time().$userFirstName)),0,$length);
				$cd_date = date('Y-m-d H:i:s');
				$cd_exp_date =date('Y-m-d', strtotime('+2 day'));
				
				$xpDate =  date('d M Y', strtotime('+2 day'));
								
				$cols = "
					cd_hash,
					cd_date,
					cd_exp_date
					";
				$values = "
					'$cd_hash',
					'$cd_date',
					'$cd_exp_date'
					";
			//echo "INSERT INTO check_date ($cols) VALUES($values)"; exit;
				$cols2 = 'cd_id,cd_hash,sent_on,expired_on';
				$values2 = "'$rsCheckDate[cd_id]','$rsCheckDate[cd_hash]','$rsCheckDate[cd_date]','$rsCheckDate[cd_exp_date]'";
				
			
				$update = $db->updateCol($cols,$values,"check_date","user_id='$user_id'");
				$ins = $db->insert($cols2,$values2,"applicant_links_logs");
							
				$url =  rtrim($url, "&");
				$furl = $url.'&emp_code='.$rsCheckDate['cd_employee_code'].'&hash='.$cd_hash;
				$data_table = 
					'
					<table width="100%" border="0" style="border-collapse: collapse; color:#999;  ">
						<tr>
						<td width="25%" style="font-size:14px; padding:5px;" colspan="3"><strong>'.$COMINF['name'].'</strong> have asked us to perform a background check as part of their screening process. In order to proceed, you need to complete the following online form.</td>
						</tr>
						<tr>
						<td width="25%" style="font-size:14px; padding:5px;" colspan="3">What do I need to do? </td>
						</tr>
						<tr>
						<td width="25%" style="font-size:14px; padding:5px;" colspan="3">Please enter your details by visiting the following secure link:</td>
						</tr>
						<tr>
						<td width="25%" style="font-size:14px; padding:5px;" colspan="3">We recommend completing the form on a computer or tablet for the best experience</td>
						</tr>
						<tr>
						<td width="25%" style="font-size:14px; padding:5px;" colspan="3">&nbsp;</td>
						</tr>
					</table>
					
					<table width="100%" border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">
					
					<tr>
						<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Email</th>
						<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Password</th>
						<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Action</th>
					</tr>';
					$clink =  '<a href="'.SURL.'?action=addappcase&atype=checks&'.$furl.'" style="color:#8EC537">Click here to start your background check</a>';
					$pwd_history = ($userPass!='') ? strtolower($userPass) : 'Use your password';
					$data_table .= 
					'<tr>
						<td width="25%" style="font-size:12px; padding:5px;">'.$userEmail.'</td>
						<td width="25%" style="font-size:12px; padding:5px;">'.$pwd_history.'</td>
						<td width="25%" style="font-size:12px; padding:5px;">'.$clink.'</td>
					</tr>';
						
				$data_table .= '</table><br><b>Please Note:</b><p>The required Information must be submit before '.$xpDate.' </p>';

				$email_title = $COMINF['name'].' have requested a background check on you.';
				$emailSender = $userEmail;
				//echo $data_table;
				emailTmp( $data_table, $email_title,$userEmail,'','','','',$userFirstName);
			$c++;
			
			//die;
			msg('sec',"Link successfylly sent to applicant ($userFirstName)");
	}else{
		
		//msg('sec',"Link is not expired yet.");
	}
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	include("credits/credits_functions.php");

	
	
	/* --------------------------------- New Functionality for credit system End ----------------------------  */
	
	
	/* --------------------------------- New Functionality for bitrix integration Start ----------------------------  */
	
	include("bitrix/bitrix_functions.php");
	
	/* --------------------------------- New Functionality for bitrix integration END ----------------------------  */
	
	
	/* --------------------------------- New Functionality  For Dashboard Start ----------------------------  */
	
	include("dashboard/dashboard_functions.php");
	
	/* --------------------------------- New Functionality For Dashboard END ----------------------------  */
	
	
	/* --------------Manager Remarks, QC Step, Sent to Client Steps Skipped START-----------------  */
	include("advance_search/skip_check_steps.php");
	/* --------------Manager Remarks, QC Step, Sent to Client Steps Skipped END ------------------ */
	
	
	/* ---------------- Pre-Emp Automate Send Survey Form To HR ------------- */
	include("others/other_functions.php");
	/* ---------------- Pre-Emp Automate Send Survey Form To HR ------------- */
	
?>