<?php
	include("include/config.php");
	$vID=$_REQUEST['vid'];
	$uVl=$_REQUEST['uvl'];
	$url="http://mis.dataflowgroup.net/readData.php?vid=$vID&uvl=$uVl";
	$XMLDom = new DOMDocument();
	$XMLDom->load($url);
	$Candidates = $XMLDom->getElementsByTagName('Candidate');
	$Candidate = $Candidates->item(0);

	$error = trim($Candidate->getElementsByTagName('err')->item(0)->nodeValue);
if($error=='ok'){
	$cols="emp_id,v_name,v_nic,v_ftname,v_dob,v_date,v_status,v_sent,v_rlevel,v_cdnld,v_mdnld,v_uadd,com_id,v_stdate, v_cldate,imp, tv_id,v_batch";
	$total = trim($Candidate->getElementsByTagName('total')->item(0)->nodeValue);
	$update = trim($Candidate->getElementsByTagName('Update')->item(0)->nodeValue);
	$emp_id= trim($Candidate->getElementsByTagName('emp_id')->item(0)->nodeValue); 
	$emp_name= trim($Candidate->getElementsByTagName('emp_name')->item(0)->nodeValue); 
	$emp_nic= trim($Candidate->getElementsByTagName('emp_nic')->item(0)->nodeValue); 
	$emp_degree_type= trim($Candidate->getElementsByTagName('emp_degree_type')->item(0)->nodeValue); 
	$emp_last_degree= trim($Candidate->getElementsByTagName('emp_last_degree')->item(0)->nodeValue); 
	$emp_uni= trim($Candidate->getElementsByTagName('emp_uni')->item(0)->nodeValue); 
	$emp_edu_year= trim($Candidate->getElementsByTagName('emp_edu_year')->item(0)->nodeValue); 
	$emp_edu_dur= trim($Candidate->getElementsByTagName('emp_edu_dur')->item(0)->nodeValue); 
	$emp_fa_name= trim($Candidate->getElementsByTagName('emp_fa_name')->item(0)->nodeValue); 
	$emp_status_cmt= trim($Candidate->getElementsByTagName('emp_status_cmt')->item(0)->nodeValue); 
	$emp_rec_date= trim($Candidate->getElementsByTagName('emp_rec_date')->item(0)->nodeValue); 
	$emp_sub_date= trim($Candidate->getElementsByTagName('emp_sub_date')->item(0)->nodeValue); 
	$emp_dob= trim($Candidate->getElementsByTagName('emp_dob')->item(0)->nodeValue); 
	$emp_ap= trim($Candidate->getElementsByTagName('emp_ap')->item(0)->nodeValue);   
	$var_id= trim($Candidate->getElementsByTagName('var_id')->item(0)->nodeValue); 
	$emp_cat= trim($Candidate->getElementsByTagName('emp_cat')->item(0)->nodeValue); 
	$status= trim($Candidate->getElementsByTagName('status')->item(0)->nodeValue); 
	
	$vStatus='Close';
	$status='Close';
	$tcheck=5;
				
	$emp_date= trim($Candidate->getElementsByTagName('emp_date')->item(0)->nodeValue); 
	$process= trim($Candidate->getElementsByTagName('process')->item(0)->nodeValue); 
	$sent=4;
	$adcls=1;
	$ddp= trim($Candidate->getElementsByTagName('ddp')->item(0)->nodeValue); 
	$dpo= trim($Candidate->getElementsByTagName('dpo')->item(0)->nodeValue); 
	$ul= trim($Candidate->getElementsByTagName('ul')->item(0)->nodeValue); 
	$unp= trim($Candidate->getElementsByTagName('unp')->item(0)->nodeValue); 
	$rdd= trim($Candidate->getElementsByTagName('rdd')->item(0)->nodeValue); 
	$cpsc= trim($Candidate->getElementsByTagName('cpsc')->item(0)->nodeValue); 
	$problem_message= trim($Candidate->getElementsByTagName('problem_message')->item(0)->nodeValue); 
	$batch= trim($Candidate->getElementsByTagName('batch')->item(0)->nodeValue); 
	$stepa_date= trim($Candidate->getElementsByTagName('stepa_date')->item(0)->nodeValue); 
	$stepb_date= trim($Candidate->getElementsByTagName('stepb_date')->item(0)->nodeValue); 
	$stepc_date= trim($Candidate->getElementsByTagName('stepc_date')->item(0)->nodeValue); 
	$website= trim($Candidate->getElementsByTagName('website')->item(0)->nodeValue); 
	$information= trim($Candidate->getElementsByTagName('information')->item(0)->nodeValue); 
	$vs= trim($Candidate->getElementsByTagName('vs')->item(0)->nodeValue); 
	$asg_date= trim($Candidate->getElementsByTagName('asg_date')->item(0)->nodeValue); 
	$user_id= trim($Candidate->getElementsByTagName('user_id')->item(0)->nodeValue); 
	$lbl_1= trim($Candidate->getElementsByTagName('lbl_1')->item(0)->nodeValue); 
	$lbl_2= trim($Candidate->getElementsByTagName('lbl_2')->item(0)->nodeValue); 
	$lbl_3= trim($Candidate->getElementsByTagName('lbl_3')->item(0)->nodeValue); 
	$lbl_4= trim($Candidate->getElementsByTagName('lbl_4')->item(0)->nodeValue); 
	$lbl_5= trim($Candidate->getElementsByTagName('lbl_5')->item(0)->nodeValue); 
	$lblv_1= trim($Candidate->getElementsByTagName('lblv_1')->item(0)->nodeValue); 
	$lblv_2= trim($Candidate->getElementsByTagName('lblv_2')->item(0)->nodeValue); 
	$lblv_3= trim($Candidate->getElementsByTagName('lblv_3')->item(0)->nodeValue); 
	$lblv_4= trim($Candidate->getElementsByTagName('lblv_4')->item(0)->nodeValue); 
	$lblv_5= trim($Candidate->getElementsByTagName('lblv_5')->item(0)->nodeValue); 
	$remarks= trim($Candidate->getElementsByTagName('remarks')->item(0)->nodeValue); 
	$remarks_date= trim($Candidate->getElementsByTagName('remarks_date')->item(0)->nodeValue); 
	$lblvv_1= trim($Candidate->getElementsByTagName('lblvv_1')->item(0)->nodeValue); 
	$lblvv_2= trim($Candidate->getElementsByTagName('lblvv_2')->item(0)->nodeValue); 
	$lblvv_3= trim($Candidate->getElementsByTagName('lblvv_3')->item(0)->nodeValue); 
	$lblvv_4= trim($Candidate->getElementsByTagName('lblvv_4')->item(0)->nodeValue); 
	$lblvv_5= trim($Candidate->getElementsByTagName('lblvv_5')->item(0)->nodeValue); 
	$pdf= trim($Candidate->getElementsByTagName('pdf')->item(0)->nodeValue); 
	$pdf_date= trim($Candidate->getElementsByTagName('pdf_date')->item(0)->nodeValue); 
	$vname= trim($Candidate->getElementsByTagName('vname')->item(0)->nodeValue); 
	$vemail= trim($Candidate->getElementsByTagName('vemail')->item(0)->nodeValue); 
	$vtitle= trim($Candidate->getElementsByTagName('vtitle')->item(0)->nodeValue); 
	$vdept= trim($Candidate->getElementsByTagName('vdept')->item(0)->nodeValue); 
	$vfone= trim($Candidate->getElementsByTagName('vfone')->item(0)->nodeValue); 
	$prof= trim($Candidate->getElementsByTagName('prof')->item(0)->nodeValue); 
	$prof1= trim($Candidate->getElementsByTagName('prof1')->item(0)->nodeValue); 
	$byemail= trim($Candidate->getElementsByTagName('byemail')->item(0)->nodeValue); 
	$degree= trim($Candidate->getElementsByTagName('degree')->item(0)->nodeValue); 
	$othar_info= trim($Candidate->getElementsByTagName('othar_info')->item(0)->nodeValue); 
	$online= trim($Candidate->getElementsByTagName('online')->item(0)->nodeValue); 
	$uni_id= trim($Candidate->getElementsByTagName('uni_id')->item(0)->nodeValue); 
	$sent_date= trim($Candidate->getElementsByTagName('sent_date')->item(0)->nodeValue); 
	$pmc_code= trim($Candidate->getElementsByTagName('pmc_code')->item(0)->nodeValue); 
	$values="$emp_id,'$emp_name','$emp_nic','$emp_fa_name','$emp_dob','$emp_date','$status',$sent,'$vs',0,$pdf,3,1,'$sent_date','$stepc_date',1,$var_id,$batch";
	$isIns = $db->insert($cols,$values,"tver_data");
	if($isIns){
		$vid = $db->insertedID;
		$cols="v_id,checks_id,t_check,user_id,as_status,as_vstatus,as_remarks,as_sent,as_adcls,as_cdnld,as_uadd,as_mdnld,as_date,as_addate,as_stdate,as_cldate,imp";
		$values="$vid,1,$tcheck,$user_id,'$status','$vs','$remarks',$sent,$adcls,0,3,$pdf,'$asg_date','$emp_date','$sent_date','$pdf_date',1";
		$isIns = $db->insert($cols,$values,"tver_checks");
		if($isIns){
			echo "$var_id|$total|$update|1";
		}else{
			echo "$var_id|$total|$update|-2";
		}
	}else{
		echo "$var_id|$total|$update|-1";
	}
}else echo $error;
exit();
?>