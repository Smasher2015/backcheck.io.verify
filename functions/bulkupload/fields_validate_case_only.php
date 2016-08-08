<?php 
		/* Developed by KHL */
					
					
		while(isset($_REQUEST['ename'.$nums2])){
			
		if($_REQUEST['skip_case'][$nums2]!=$nums2){
								
		// GENERAL FIELDS
		$ename 		= 	addslashes($_REQUEST['ename'.$nums2]);
		$fname 		= 	addslashes($_REQUEST['fname'.$nums2]);
		$empcode 	= 	addslashes($_REQUEST['empcode'.$nums2]);
		$cnic 		= 	addslashes($_REQUEST['cnic'.$nums2]);
		
		// IMAGES IF UPLOADED				
		$image='images/default.png';
		$thum= 'images/default.png';
		if(isset($_REQUEST['image'.$nums2])){
			$image = addslashes($_REQUEST['image'.$nums2]);
			$thum = addslashes($_REQUEST['thum'.$nums2]);
		}
		
		if($ename==''){
			
		echo "Please type applicant name !"; exit;
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