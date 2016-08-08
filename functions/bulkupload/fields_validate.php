<?php 
			/* Developed by KHL */		
					
			while(isset($_REQUEST['first_name'.$nums2])){
				
			if($_REQUEST['skip_case'][$nums2]!=$nums2){
									
			// GENERAL FIELDS
			$first_name = addslashes($_REQUEST['first_name'.$nums2]);
			$last_name 	= addslashes($_REQUEST['last_name'.$nums2]);
			$fname 	= addslashes($_REQUEST['fname'.$nums2]);
			$empcode = addslashes($_REQUEST['empcode'.$nums2]);
			$cnic = addslashes($_REQUEST['cnic'.$nums2]);
			$dob = addslashes($_REQUEST['dob'.$nums2]);
			
			// EDUCATION FIELDS
			$uni_name = addslashes($_REQUEST['uni_name'.$nums2]);
			$reg_num = addslashes($_REQUEST['reg_num'.$nums2]);
			$degree = addslashes($_REQUEST['degree'.$nums2]);
			$remarks = addslashes($_REQUEST['remarks'.$nums2]);
			$pass_year = addslashes($_REQUEST['pass_year'.$nums2]);
			$serial_no = addslashes($_REQUEST['serial_no'.$nums2]);
			
			// COMPANY FIELDS
			$company_name = addslashes($_REQUEST['company_name'.$nums2]);
			$date_of_join = addslashes($_REQUEST['date_of_join'.$nums2]);
			$emp_status = addslashes($_REQUEST['emp_status'.$nums2]);
			$last_work_day = addslashes($_REQUEST['last_work_day'.$nums2]);
			$last_designation = addslashes($_REQUEST['last_designation'.$nums2]);
			$last_place_posted = addslashes($_REQUEST['last_place_posted'.$nums2]);
			
			// IMAGES IF UPLOADED				
			$image='images/default.png';
			$thum= 'images/default.png';
			if(isset($_REQUEST['image'.$nums2])){
				$image = addslashes($_REQUEST['image'.$nums2]);
				$thum = addslashes($_REQUEST['thum'.$nums2]);
			}
			
			if($first_name==''){
				
			echo "Please type first name !"; exit;
			$isErr = 1;
			}
			if($last_name==''){
			echo "Please type last name !"; exit;
			$isErr = 1;
			}
			
			if($fname==''){
			echo "Please type father name !"; exit;
			$isErr = 1;
			}
			
			
			if($cnic!=''){
				
			if(!is_numeric($cnic)){	
			echo "Please type only numeric values  for ID Card !"; exit;
			$isErr = 1;
			}
			
			if(strlen($cnic) > 50 ){	
			echo "Please type maximum 50 digits of ID Card !"; exit;
			$isErr = 1;
			}
			
			
			
			
			$checkCnic = checkCnic($cnic,1,$company_id);
			
			if($checkCnic != 'not-found'){
			echo "ID Card already exists ! <br /> $cnic"; exit;
			$isErr = 1;
			
			}
			}
								
			
			if($empcode==''){					
			echo "Please type employee code !"; exit;
			$isErr = 1;
				
			}	
			
			
			$checkEmpId = checkEmpId($empcode,1,$company_id);
			if($checkEmpId != 'not-found'){
			echo "Employee Code already exists ! <br /> $empcode"; exit;
			$isErr = 1;	
			}
			
			// IF EDUCATION CHECK AVAILABLE checks_id=1
			if(in_array($eduCheckID,$_REQUEST['checks'.$nums2])){
								
			if($uni_name==''){					
			//echo "Please type university name !"; exit;
			//$isErr = 1;
			}
			if($reg_num==''){					
			//echo "Please type registration number !"; exit;
			//$isErr = 1;
			}
			if($degree==''){					
			//echo "Please type degree title !"; exit;
			//$isErr = 1;
			}
			if($remarks==''){					
			//echo "Please type rematks (Pass/Fail) !"; exit;
			//$isErr = 1;
			}
			if($pass_year==''){					
			//echo "Please type passing year !"; exit;
			//$isErr = 1;
			}
			if($serial_no==''){					
			//echo "Please type serial number !"; exit;
			//$isErr = 1;
			}
				
			}
			
			// IF PREVIOUS EMPLOYEMENT AVAILABLE checks_id=2
			if(in_array($empCheckID,$_REQUEST['checks'.$nums2])){
			$company_name = addslashes($_REQUEST['company_name'.$nums2]);
			$date_of_join = addslashes($_REQUEST['date_of_join'.$nums2]);
			$emp_status = addslashes($_REQUEST['emp_status'.$nums2]);
			$last_work_day = addslashes($_REQUEST['last_work_day'.$nums2]);
			$last_designation = addslashes($_REQUEST['last_designation'.$nums2]);
			$last_place_posted = addslashes($_REQUEST['last_place_posted'.$nums2]);
			$last_drawn_salary = addslashes($_REQUEST['last_drawn_salary'.$nums2]);
			
			if($company_name==''){					
			//echo "Please type company name !"; exit;
			//$isErr = 1;
			}
			if($date_of_join==''){					
			//echo "Please type date of joining !"; exit;
			//$isErr = 1;
			}
			if($emp_status==''){					
			//echo "Please type employement status !"; exit;
			//$isErr = 1;
			}
			if($last_work_day==''){					
			//echo "Please type last working day !"; exit;
			//$isErr = 1;
			}
			if($last_designation==''){					
			//echo "Please type last designation !"; exit;
			//$isErr = 1;
			}
			if($last_place_posted==''){					
			//echo "Please type place posted !"; exit;
			//$isErr = 1;
			}
			if($last_drawn_salary==''){					
			//echo "Please last drawn salary !"; exit;
			//$isErr = 1;
			}
				
			}
			
			
			
			
			
			
			
			
			if($cnic!='') $listOfCnic[]=$cnic;
			if($empcode!='') $listOfEmp[]=$empcode;

						$valid = true;								
						$isAttach = 0;
						$err_msg = "";								
					
													
									
							for($count=100;$count<=120;$count++){
								if(is_array($_REQUEST['docxs'.$nums2.$count.$nums2.'_1'])){
									$isAttach++;
									foreach($_REQUEST['docxs'.$nums2.$count.$nums2.'_1'] as $key=>$docxs){
										$att_file_name 	= $_REQUEST['docxs_name'.$nums2.$count.$nums2.'_1'][$key]; 
										$att_file_path 	= $docxs; 
										if($nadrabulk!=1){
										if($att_file_name==""){
											$err_msg = "Please attach a file to each case !";
											$valid=false;
											$isErr = 1;
										}
										}
										
										
										
									}
								}
							}
						
						
						
						
					
					
			
				
				
			
				if($valid==false){
							echo $err_msg; exit;
							$isErr = 1;
						}
						if($nadrabulk!=1){
						if($isAttach==0){
							echo "Please attach a file to each case !"; exit;
						}
						}
						
						
			
			}
			$nums2++;
			} // while end
			
			
			
			
			$duplicatesCnic = find_duplicates2($listOfCnic,'ID Card');
			$duplicatesEmp = find_duplicates2($listOfEmp,'Reference Number.');	
																						
			if($duplicatesCnic){
					
			echo $duplicatesCnic; exit;						
			$isErr == 1;					
			}					
			if($duplicatesEmp){	
							
			echo $duplicatesEmp; exit;						
			$isErr == 1;					
			}
	

?>