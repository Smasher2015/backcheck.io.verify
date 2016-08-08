<?php 	
		/* Developed by KHL */		
		
		// bulkupload case and checks both v2
		function clientBulkUploadAjax2(){
				
					global $db,$COMINF,$LEVEL;
					
					$nadrabulk= $_REQUEST['nadrabulk'];
					$eduCheckID = 1;
					$empCheckID = 2;
					$uID = $_SESSION['user_id'];
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
						if(in_array($company_id,unserialize(CHECK_COMIDS))){
										
						$getUserInf = getUserInfo($uID);
						if($getUserInf['puser_id']==0 && $getUserInf['is_subuser']==0){
						$uID = (int) $_REQUEST['user_id'];	
						}
						}
					}			
					
					
					
					$recdate = date("Y-m-d");
					
					if(count($_REQUEST['checks1'])==0){ echo "Please select at least one check from given list!"; exit; }
					
					$is_order_id = ChecksAmount($_REQUEST,$company_id,true);
					
					if($is_order_id){
						
					if($_REQUEST['ERR']==''){
						
						$nums = 1;
						$nums2 = 1;
						$isErr = 0;
						$ErrMsg = array();
						$listOfCnic= array();
						$listOfEmp= array();
						
						include("fields_validate.php");				
						
						if($isErr == 0){
						$isSkiped=0;
						$isRecords=0;
						
						while(isset($_REQUEST['first_name'.$nums])){
							if($_REQUEST['skip_case'][$nums]!=$nums){
							$isRecords++;
								
										
							// GENERAL FIELDS
							$first_name = addslashes($_REQUEST['first_name'.$nums]);
							$last_name 	= addslashes($_REQUEST['last_name'.$nums]);
							$ename 	= $first_name." ".$last_name;
							$fname 	= addslashes($_REQUEST['fname'.$nums]);
							$empcode = addslashes($_REQUEST['empcode'.$nums]);
							$cnic = addslashes($_REQUEST['cnic'.$nums]);
							$dob = addslashes($_REQUEST['dob'.$nums]);
							
							// EDUCATION FIELDS
							$uni_name = addslashes($_REQUEST['uni_name'.$nums]);
							$reg_num = addslashes($_REQUEST['reg_num'.$nums]);
							$degree = addslashes($_REQUEST['degree'.$nums]);
							$remarks = addslashes($_REQUEST['remarks'.$nums]);
							$pass_year = addslashes($_REQUEST['pass_year'.$nums]);
							$serial_no = addslashes($_REQUEST['serial_no'.$nums]);
							
							// COMPANY FIELDS
							$company_name = addslashes($_REQUEST['company_name'.$nums]);
							$date_of_join = addslashes($_REQUEST['date_of_join'.$nums]);
							$emp_status = addslashes($_REQUEST['emp_status'.$nums]);
							$last_work_day = addslashes($_REQUEST['last_work_day'.$nums]);
							$last_designation = addslashes($_REQUEST['last_designation'.$nums]);
							$last_place_posted = addslashes($_REQUEST['last_place_posted'.$nums]);

							// IMAGES IF UPLOADED				
							$image='images/default.png';
							$thum= 'images/default.png';
							if(isset($_REQUEST['image'.$nums])){
							$image = addslashes($_REQUEST['image'.$nums]);
							$thum = addslashes($_REQUEST['thum'.$nums]);
							}
							$country = (int) (isset($_REQUEST['country'.$nums]))?$_REQUEST['country'.$nums]:171;
							
							if($country!=171){
							$AssignedToSys = 249; // user_id	Sadia=20 249=Sharjeel
							$AssignedToBitrix = 529; // bitrix user_id Sadia=480 529=Sharjeel
							$Work_Group_id = 18;
							}
							//--------------------If candidate id found then add checks against that ID Begin---------------//
												// temp disabled
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
							//by khl (Creating Probelm on auto adding checks if emo code found)
							//$db->update("$col_v_nic $col_v_dob","ver_data","v_id=$VID");
							//$db->update("v_id=$VID","client_invoices","id=$order_id");
							
							
							//echo "UPDATE ver_data SET $col_v_nic $col_v_dob WHERE v_id=$VID <br>";
							//$db->update("$col_v_nic $col_v_dob","ver_data","v_id=$VID");
							echo "Employee Code already exists ! <br /> $empcode"; exit;
							$isErr = 1;
							}else{
						
							$bCode = cBCode($company_id,'01');
							$cols="thum,image,v_country,v_first_name,v_last_name,v_name,v_ftname,v_nic,v_dob,com_id,v_recdate,v_bcode,v_uadd, emp_id";
							$values="'$thum','$image','$country','$first_name','$last_name','$ename','$fname','$cnic','$dob',$company_id,'$recdate','$bCode',$uID, '".$empcode."'";
							
							//Add to Bitrix Leads START By Hassan
							$lead_array=array();
							$lead_array['name']='Case For '.$ename ." - $bCode - Total Checks: ".count($_REQUEST['checks'.$nums]);
							$lead_array['comment']="Gender : $gender
							Father Name : $fname
							NIC : $cnic
							Date of Birth : $dob
							Received Date : $recdate";
							$lead_array['user_id']='1';
							$lead_array['BIRTHDATE']=$dob;
							$lead_array['erpid']=$empcode;
							$lead_array['country_id']=$country;
							//Add to Bitrix Leads END
							
							
							
							$isInserted = $db->insert($cols,$values,"ver_data");
							$VID=$db->insertedID;
							$bitrixlid=insertleads2($lead_array);
							$db->update("bitrixlid=$bitrixlid","ver_data","v_id=$VID");
							//echo "UPDATE client_invoices SET v_id=$VID WHERE id=$order_id"; 
							$order_id = ChecksAmount($_REQUEST,$company_id,true,true,$VID);
							//$db->update("v_id=$VID","client_invoices","id=$order_id");

							
							}
								//echo "in case"; exit;
							//--------------------If candidate id found then add checks against that ID End---------------//
							
							
							
							
							$any_error = false;
							if($isInserted){					
									foreach($_REQUEST['checks'.$nums] as $check){
										
										
										$bCode = cBCode(0,0,$VID,$check);
										$as_cost2 = getCheckAmount($company_id,$check);
										
										
							// khl	//		
										$tabl = "analyst_roles ar INNER JOIN checks c ON ar.checks_id=c.checks_id ";
										$cols = "ar.analyst_id,c.checks_title,c.group_id as group_id";
										$selRoles = $db->select($tabl,$cols," ar.checks_id='".$check."'");
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
										//$cols="as_bcode,v_id,checks_id,as_uadd,user_id,as_status, as_addate, as_date";
										//$values="'$bCode',$VID,$check,$uID,'$analyst_id','Open', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP";
										
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
										$assign_cols = "";
										$assign_values = "";
										$assign_cols = "user_id,as_status, ";
										$assign_values = "'".$userid2."','Open', ";
										$db->update("v_status='Open'","ver_data","v_id=$VID");
									//----------------- Temporary Commented --------------------//	
									
									
										$cols="as_bcode,v_id,checks_id,as_uadd, $assign_cols as_addate, as_date, how_rec_checks,as_cost2";
										$values="'$bCode','$VID','$check','$uID', $assign_values CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '$how_rec_checks','$as_cost2'";
									//echo "INsert into ver_checks ($cols) VALUES($values)"; exit;
										if($db->insert($cols,$values,"ver_checks")){
										$CID=$db->insertedID;
							
							// IF EDUCATION CHECK AVAILABLE checks_id=1
							if(in_array($eduCheckID,$_REQUEST['checks'.$nums])){
							if($check==$eduCheckID){
							$colsAddata = " (as_id,d_type,d_mtitle,d_stitle,d_num,user_id) ";
							$valsAddata = " ($CID,'multy','University Name','$uni_name',1,$uID),($CID,'multy','Registration Number','$reg_num',2,$uID),($CID,'multy','Degree Title','$degree',3,$uID),($CID,'multy','Remarks','$remarks',4,$uID),($CID,'multy','Passing Year','$pass_year',5,$uID),($CID,'multy','Serial No','$serial_no',6,$uID)";
							//insertSet
							
							
							
							$db->insertMulti($colsAddata,$valsAddata,'add_data');
							}
							}
							
							// IF PREVIOUS EMPLOYEMENT AVAILABLE checks_id=2
							if(in_array($empCheckID,$_REQUEST['checks'.$nums])){
							if($check==$empCheckID){
							$colsAddata = " (as_id,d_type,d_mtitle,d_stitle,d_num,user_id) ";
							$valsAddata = " ($CID,'multy','Company Name','$company_name',1,$uID),($CID,'multy','Date of Joining','$date_of_join',2,$uID),($CID,'multy','Employement Status','$emp_status',3,$uID),($CID,'multy','Last Working Day','$last_work_day',4,$uID),($CID,'multy','Last Designation','$last_designation',5,$uID),($CID,'multy','Last Place of Posting','$last_place_posted',6,$uID)";	
							
							
							$db->insertMulti($colsAddata,$valsAddata,'add_data');
							}
							}
							
							
							
							
							
							
							
							
							
										// Add Bitrix Task Start By Hassan
										$task_array=array();
										$task_array['task_name']='Check For '.$ename ." - $bCode";
										$task_array['task_desc']="Gender : $gender
										Father Name : $fname
										NIC : $cnic
										Date of Birth : $dob
										Received Date : $recdate
										";
										$task_array['user_id']=($country!=171)?$AssignedToBitrix:$bitrixuserid2;
										$task_array['group_id']=($country!=171)?$Work_Group_id:$resRoles['group_id'];
										$task_array['country_id']=$country;
										
										//print_r($task_array);die;
										$bitrixctid=add_task($task_array,$bitrixlid);
										$db->update("bitrixtid=$bitrixctid","ver_checks","as_id=$CID");
										// Add Bitrix Task End
												
							
							
							
							
							//$a_info = "A new $checks_title check assigned from ".$_SESSION['fname']." ( $COMINF[name] ) " ;
							//createNotifications(4,$a_info,'',$analyst_id);
											
											
										}else{
											
											  echo "Check insertion error!"; exit;
											$any_error = true;
										}
										
									}

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
								 echo "Case [$ename] insertion error!"; exit;
							}
							}else{
							$isSkiped++;
							}
								$nums++;
							
						}
							if($isRecords==0) { echo "All records are skipped!"; exit; }
							// insert notificaification to manager about new cases
							$a_info = ($_REQUEST['is_bulk']==1) ? "New Cases added with Bulk Uploaded by ".$_SESSION['fname']." ( $info_title ) " : "New Case Added by ".$_SESSION['fname']." ( $info_title ) ";
							
							$notify = createNotifications(4,$a_info);
							
							if(!$any_error && $_REQUEST['ERR']=='') echo "added"; exit;			
						}
					}
				}
			}

			
		// only case bulkupload function by khl v3
		function bulkupload_case_only(){
						
					global $db,$COMINF,$LEVEL;
					
					$nadrabulk= $_REQUEST['nadrabulk'];
					
					$uID = $_SESSION['user_id'];
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
						$nums2 = 1;
						$isErr = 0;
						$ErrMsg = array();
						$listOfCnic= array();
						$listOfEmp= array();
						
						include("fields_validate_case_only.php");				
						
						if($isErr == 0){
						$isSkiped=0;
						$isRecords=0;
						
						while(isset($_REQUEST['ename'.$nums])){
							if($_REQUEST['skip_case'][$nums]!=$nums){
							$isRecords++;
								
										
							// GENERAL FIELDS
							$ename = addslashes($_REQUEST['ename'.$nums]);
							$fname 	= addslashes($_REQUEST['fname'.$nums]);
							$empcode = addslashes($_REQUEST['empcode'.$nums]);
							$cnic = addslashes($_REQUEST['cnic'.$nums]);
							$comments = addslashes($_REQUEST['comments'.$nums]);
							
							// IMAGES IF UPLOADED				
							$image='images/default.png';
							$thum= 'images/default.png';
							if(isset($_REQUEST['image'.$nums])){
							$image = addslashes($_REQUEST['image'.$nums]);
							$thum = addslashes($_REQUEST['thum'.$nums]);
							}
							$country = (int) (isset($_REQUEST['country'.$nums]))?$_REQUEST['country'.$nums]:171;
							
							if($country!=171){
							$AssignedToSys = 249; // user_id	Sadia=20 249=Sharjeel
							$AssignedToBitrix = 529; // bitrix user_id Sadia=480 529=Sharjeel
							$Work_Group_id = 18;
							}
							
						
							$bCode = cBCode($company_id,'01');
							$cols="thum,image,v_country,v_name,v_ftname,v_nic,v_comments,com_id,v_recdate,v_bcode,v_uadd, emp_id,blank_case";
							$values="'$thum','$image','$country','$ename','$fname','$cnic','$comments',$company_id,'$recdate','$bCode',$uID, '".$empcode."',1";
							
							//Add to Bitrix Leads START By Hassan
							$lead_array=array();
							$lead_array['name']='Case For '.$ename ." - $bCode - ($info_title)";
							$lead_array['comment']="Father Name : $fname
							NIC : $cnic
							Received Date : $recdate";
							$lead_array['user_id']='1';
							$lead_array['erpid']=$empcode;
							$lead_array['country_id']=$country;
							//Add to Bitrix Leads END
																	
							$isInserted = $db->insert($cols,$values,"ver_data");
							if($isInserted){	
							$VID=$db->insertedID;
							$bitrixlid=insertleads2($lead_array);
							$db->update("bitrixlid=$bitrixlid","ver_data","v_id=$VID");
										
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
								 echo "Case [$ename] insertion error!"; exit;
							}
							}else{
							$isSkiped++;
							}
								$nums++;
							
						}
							if($isRecords==0) { echo "All records are skipped!"; exit; }
							// insert notificaification to manager about new cases
							$a_info = ($_REQUEST['is_bulk']==1) ? "New Cases added with Bulk Uploaded by ".$_SESSION['fname']." ( $info_title ) " : "New Case Added by ".$_SESSION['fname']." ( $info_title ) ";
							
							$notify = createNotifications(4,$a_info);
							
							if(!$any_error && $_REQUEST['ERR']=='') echo "added"; exit;			
						}
					}
				
			

			}
			
?>