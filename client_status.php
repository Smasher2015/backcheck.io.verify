<?php include("include/config.php");




if($_GET['upd']==1){
	
	$bccEmails = "cfo@backcheckgroup.com,ceo@backcheckgroup.com,erum@backcheckgroup.com";
	
	$before_3_days='before_3_days';
	$on_due_date='on_due_date';
	$next_3_days='next_3_days';
	$after_7_days='after_7_days';
	$after_8_days='after_8_days';
	$general='general';
	
							
							
							$selInvoice = $db->select("ver_checks","DISTINCT(invoice_number)"," invoice_number <> '' AND invoiced=1 ORDER BY invoiced_date DESC ");
							
                            if(mysql_num_rows($selInvoice)>0){
								$index = 0;
                                while($re = mysql_fetch_array($selInvoice)) {
							
							$cols = " co.name as com_name , co.email as com_email , co.pname as com_person_name, co.disabled_id as com_status, co.id as com_id, co.pymterm, invoiced_date,invoice_number, vc.paid as paid_status";
							$tbls = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id INNER JOIN company co ON vd.com_id=co.id";
							$whre = " invoice_number='".$re['invoice_number']."' ";
							$sel = $db->select($tbls,$cols,"$whre");
							$rs = mysql_fetch_assoc($sel);
							$invoiced_date = date("Y-M-d",strtotime($rs['invoiced_date']));
							preg_match('/(\d+)/', $rs['pymterm'], $m);
							$pymterm = ($m[1]!="")?(int)$m[1]:30;
							
							$dueDate = date("Y-M-d",strtotime($rs['invoiced_date'] . "+$pymterm day"));
							
							$now = strtotime(date("Y-M-d")); // or your date as well
							$your_date = strtotime($dueDate);
							$datediff =  $your_date-$now;
							$datediff =  floor($datediff/(60*60*24));
							
							
							// 3 days reminder
							if($datediff==3 && $rs['paid_status']==0){
							
							$inv_num = $rs['invoice_number'];
							$inv_amount = getInvoiceAmount($rs['invoice_number']);
							
							$email_subject = "The Invoice # $inv_num about to overdue soon";
							$email_Heading = "3 days remaining to settle your invoice # $inv_num";
							$com_name = $rs['com_name'];
							
							$userCols = "email, CONCAT(first_name ,' ', last_name) as full_name";
							$userWhr = "com_id=$rs[com_id] AND level_id=4 AND is_active=1";
							$selUsers = $db->select("users",$userCols,$userWhr);
							if(mysql_num_rows($selUsers)>0){
							while($rsUsers = mysql_fetch_assoc($selUsers)){
							
							$fullName = ($rsUsers['full_name']!="")?$rsUsers['full_name']:getUsernameFromEmail($rsUsers['email']);
							$UserEmail = strtolower($rsUsers['email']);
												
							$emailTxt = getRemindingContent($fullName,$inv_num,$invoiced_date,$dueDate,$inv_amount,$general);
												
							$data_table = getInvoiceEmailTemplate($com_name,$emailTxt);
							
							echo '<h2>3 Days before overdue.</h2> com_name: '.$com_name.' fullName: '.$fullName.' UserEmail:'.$UserEmail.'<br><br> emailTxt: '.$emailTxt.' <br><br><br>'; 
							
							emailTmp( $data_table, $email_subject,'khalique@xcluesiv.com','',$bccEmails,'','','no',$email_Heading);
							//emailTmp( $data_table, $email_subject,'ceo@backcheckgroup.com','',$bccEmails,'','','no',$email_Heading);
								
							}
							
							}else{
							$fullName = ($rs['com_person_name']!="")?$rs['com_person_name']:getUsernameFromEmail($rs['com_email']);	
							$UserEmail = strtolower($rs['com_email']);
							$emailTxt = getRemindingContent($fullName,$inv_num,$invoiced_date,$dueDate,$inv_amount,$general);
							
							$data_table = getInvoiceEmailTemplate($com_name,$emailTxt);
							
							echo '<h2>10 Days before overdue.</h2> com_name: '.$com_name.' fullName: '.$fullName.' UserEmail:'.$UserEmail.'<br><br> emailTxt: '.$emailTxt.' <br><br><br>'; 
							
							emailTmp( $data_table, $email_subject,'khalique@xcluesiv.com','',$bccEmails,'','','no',$email_Heading);
							//emailTmp( $data_table, $email_subject,'ceo@backcheckgroup.com','',$bccEmails,'','','no',$email_Heading);
							
								
							}
								}
							
							// On Due Date
							
							if($datediff==0 && $rs['paid_status']==0){
							
							$inv_num = $rs['invoice_number'];
							$inv_amount = getInvoiceAmount($rs['invoice_number']);
							$email_subject = "The Invoice # $inv_num is overdue today";
							$email_Heading = "Today is the last day to pay your invoice # $inv_num";
							$com_name = $rs['com_name'];
							
							$userCols = "email, CONCAT(first_name ,' ', last_name) as full_name";
							$userWhr = "com_id=$rs[com_id] AND level_id=4 AND is_active=1";
							$selUsers = $db->select("users",$userCols,$userWhr);
							if(mysql_num_rows($selUsers)>0){
							while($rsUsers = mysql_fetch_assoc($selUsers)){
							
							$fullName = ($rsUsers['full_name']!="")?$rsUsers['full_name']:getUsernameFromEmail($rsUsers['email']);
							$UserEmail = strtolower($rsUsers['email']);
							
							$emailTxt = getRemindingContent($fullName,$inv_num,$invoiced_date,$dueDate,$inv_amount,$general);
							
							$data_table = getInvoiceEmailTemplate($com_name,$emailTxt);
							
							echo '<h2>On Due Day  overdue.</h2>com_id=: '.$rs[com_id].' com_name: '.$com_name.' fullName: '.$fullName.' UserEmail:'.$UserEmail.'<br><br> emailTxt: '.$emailTxt.' <br><br><br>'; 
							
							emailTmp( $data_table, $email_subject,'khalique@xcluesiv.com','',$bccEmails,'','','no',$email_Heading);
							//emailTmp( $data_table, $email_subject,'ceo@backcheckgroup.com','',$bccEmails,'','','no',$email_Heading);
								
							}
							
							}else{
								
							$fullName = ($rs['com_person_name']!="")?$rs['com_person_name']:getUsernameFromEmail($rs['com_email']);	
							$UserEmail = strtolower($rs['com_email']);
							$emailTxt = getRemindingContent($fullName,$inv_num,$invoiced_date,$dueDate,$inv_amount,$general);
							
							$data_table = getInvoiceEmailTemplate($com_name,$emailTxt);
							
							echo '<h2>On Due day overdue.</h2>com_id=: '.$rs[com_id].'  com_name: '.$com_name.' fullName: '.$fullName.' UserEmail:'.$UserEmail.'<br><br> emailTxt: '.$emailTxt.' <br><br><br>'; 
							
							emailTmp( $data_table, $email_subject,'khalique@xcluesiv.com','',$bccEmails,'','','no',$email_Heading);
							//emailTmp( $data_table, $email_subject,'ceo@backcheckgroup.com','',$bccEmails,'','','no',$email_Heading);
							
								
							}
								}
							
							
							
							
							
							//  Next 3 days
							
							if($datediff > 0 && $datediff <= 3 && $rs['paid_status']==0){
							
							$inv_num = $rs['invoice_number'];
							$inv_amount = getInvoiceAmount($rs['invoice_number']);
							$email_subject = "The Invoice # $inv_num is overdue";
							$email_Heading = "Your Invoice is overdue please pay the invoice # $inv_num to continue using our services ";
							$com_name = $rs['com_name'];
							
							$userCols = "email, CONCAT(first_name ,' ', last_name) as full_name";
							$userWhr = "com_id=$rs[com_id] AND level_id=4 AND is_active=1";
							$selUsers = $db->select("users",$userCols,$userWhr);
							if(mysql_num_rows($selUsers)>0){
							while($rsUsers = mysql_fetch_assoc($selUsers)){
							
							$fullName = ($rsUsers['full_name']!="")?$rsUsers['full_name']:getUsernameFromEmail($rsUsers['email']);
							$UserEmail = strtolower($rsUsers['email']);
							
							$emailTxt = getRemindingContent($fullName,$inv_num,$invoiced_date,$dueDate,$inv_amount,$general);
							
							$data_table = getInvoiceEmailTemplate($com_name,$emailTxt);
							
							echo '<h2>Next 3 days.</h2>com_id=: '.$rs[com_id].' com_name: '.$com_name.' fullName: '.$fullName.' UserEmail:'.$UserEmail.'<br><br> emailTxt: '.$emailTxt.' <br><br><br>'; 
							
							emailTmp( $data_table, $email_subject,'khalique@xcluesiv.com','',$bccEmails,'','','no',$email_Heading);
							//emailTmp( $data_table, $email_subject,'ceo@backcheckgroup.com','',$bccEmails,'','','no',$email_Heading);
								
							}
							
							}else{
								
							$fullName = ($rs['com_person_name']!="")?$rs['com_person_name']:getUsernameFromEmail($rs['com_email']);	
							$UserEmail = strtolower($rs['com_email']);
							$emailTxt = getRemindingContent($fullName,$inv_num,$invoiced_date,$dueDate,$inv_amount,$general);
							
							$data_table = getInvoiceEmailTemplate($com_name,$emailTxt);
							
							echo '<h2>1 Day before overdue.</h2>com_id=: '.$rs[com_id].'  com_name: '.$com_name.' fullName: '.$fullName.' UserEmail:'.$UserEmail.'<br><br> emailTxt: '.$emailTxt.' <br><br><br>'; 
							
							emailTmp( $data_table, $email_subject,'khalique@xcluesiv.com','',$bccEmails,'','','no',$email_Heading);
							//emailTmp( $data_table, $email_subject,'ceo@backcheckgroup.com','',$bccEmails,'','','no',$email_Heading);
							
								
							}
								}
							
							
							
							
							
							//  7th day System Suspension Notice 
							
							if($datediff=='-7' && $rs['paid_status']==0 && $rs['com_status']==0){
							
							$suspendDate = date("Y-M-d",strtotime(date("Y-M-d") . "+1 day"));
							$inv_num = $rs['invoice_number'];
							$inv_amount = getInvoiceAmount($rs['invoice_number']);
							$email_subject = "Require your attention for invoice # $inv_num ";
							$email_Heading = "<span style='color:#ff0000;'>Your account will be suspended due to non payment on $suspendDate</span>";
							
							$com_name = $rs['com_name'];
							
							$userCols = "email, CONCAT(first_name ,' ', last_name) as full_name";
							$userWhr = "com_id=$rs[com_id] AND level_id=4 AND is_active=1";
							$selUsers = $db->select("users",$userCols,$userWhr);
							if(mysql_num_rows($selUsers)>0){
							while($rsUsers = mysql_fetch_assoc($selUsers)){
							
							$fullName = ($rsUsers['full_name']!="")?$rsUsers['full_name']:getUsernameFromEmail($rsUsers['email']);
							$UserEmail = $rsUsers['email'];
							$dueDate = "<span style='color:#ff0000;'>".$dueDate."</span>";
							$emailTxt = getRemindingContent($fullName,$inv_num,$invoiced_date,$dueDate,$inv_amount,$general);
							
							$data_table = getInvoiceEmailTemplate($com_name,$emailTxt);
							
							echo '<h2>7th day</h2> com_name: '.$com_name.' fullName: '.$fullName.' UserEmail:'.$UserEmail.'<br><br> emailTxt: '.$emailTxt.' <br><br><br>'; 
							
							emailTmp( $data_table, $email_subject,'khalique@xcluesiv.com','',$bccEmails,'','','no',$email_Heading);
							//emailTmp( $data_table, $email_subject,'ceo@backcheckgroup.com','',$bccEmails,'','','no',$email_Heading);
								
							}
							
							}else{
								
							$fullName = ($rs['com_person_name']!="")?$rs['com_person_name']:getUsernameFromEmail($rs['com_email']);	
							$UserEmail = strtolower($rs['com_email']);
							
							$emailTxt = getRemindingContent($fullName,$inv_num,$invoiced_date,$dueDate,$inv_amount,$general);
							
							$data_table = getInvoiceEmailTemplate($com_name,$emailTxt);
							
							echo '<h2>7th day</h2> com_name: '.$com_name.' fullName: '.$fullName.' UserEmail:'.$UserEmail.'<br><br> emailTxt: '.$emailTxt.' <br><br><br>'; 
							
							emailTmp( $data_table, $email_subject,'khalique@xcluesiv.com','',$bccEmails,'','','no',$email_Heading);
							//emailTmp( $data_table, $email_subject,'ceo@backcheckgroup.com','',$bccEmails,'','','no',$email_Heading);
							
								
							} 
							// disable the client
							
							}
							
							
							
							
							
							//  8th day System Suspension Notice 
							
							if($datediff=='-8' && $rs['paid_status']==0 && $rs['com_status']==0){
							
							
							$inv_num = $rs['invoice_number'];
							$inv_amount = getInvoiceAmount($rs['invoice_number']);
							$email_subject = "Account suspended due to non payment invoice";
							$email_Heading = "<span style='color:#ff0000;'>Sorry to inform you that your account has been suspended due to non payment. <br> Please pay your pending invoice to continue using Background Check Services.</span>";
							
							$com_name = $rs['com_name'];
							
							$userCols = "email, CONCAT(first_name ,' ', last_name) as full_name";
							$userWhr = "com_id=$rs[com_id] AND level_id=4 AND is_active=1";
							$selUsers = $db->select("users",$userCols,$userWhr);
							if(mysql_num_rows($selUsers)>0){
							while($rsUsers = mysql_fetch_assoc($selUsers)){
							
							$fullName = ($rsUsers['full_name']!="")?$rsUsers['full_name']:getUsernameFromEmail($rsUsers['email']);
							$UserEmail = $rsUsers['email'];
							$dueDate = "<span style='color:#ff0000;'>".$dueDate."</span>";
							$emailTxt = getRemindingContent($fullName,$inv_num,$invoiced_date,$dueDate,$inv_amount,$general);
							
							$data_table = getInvoiceEmailTemplate($com_name,$emailTxt);
							
							echo '<h2>8th day</h2> com_name: '.$com_name.' fullName: '.$fullName.' UserEmail:'.$UserEmail.'<br><br> emailTxt: '.$emailTxt.' <br><br><br>'; 
							
							emailTmp( $data_table, $email_subject,'khalique@xcluesiv.com','',$bccEmails,'','','no',$email_Heading);
							//emailTmp( $data_table, $email_subject,'ceo@backcheckgroup.com','',$bccEmails,'','','no',$email_Heading);
								
							}
							
							}else{
								
							$fullName = ($rs['com_person_name']!="")?$rs['com_person_name']:getUsernameFromEmail($rs['com_email']);	
							$UserEmail = strtolower($rs['com_email']);
							
							$emailTxt = getRemindingContent($fullName,$inv_num,$invoiced_date,$dueDate,$inv_amount,$general);
							
							$data_table = getInvoiceEmailTemplate($com_name,$emailTxt);
							
							echo '<h2>8th day </h2> com_name: '.$com_name.' fullName: '.$fullName.' UserEmail:'.$UserEmail.'<br><br> emailTxt: '.$emailTxt.' <br><br><br>'; 
							
							emailTmp( $data_table, $email_subject,'khalique@xcluesiv.com','',$bccEmails,'','','no',$email_Heading);
							//emailTmp( $data_table, $email_subject,'ceo@backcheckgroup.com','',$bccEmails,'','','no',$email_Heading);
							
								
							} 
							// disable the client
							//enableDisableClient($rs['com_id'],1);
							}
								
						   echo "<br><br>";
									$index = $index+1;
									//sleep(5);	
								} 
								
								}
	
}

function getInvoiceEmailTemplate($com_name,$emailTxt){
	
	$body ='<table width="100%" border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">
			<tr>
			<td align="center" width="100%" colspan="7" style="border:none;">&nbsp;</td>
			</tr>
 			<tr>
			<td align="center" width="100%" colspan="7" style="border:none;"><h2 style="color:#465059; padding:20px 0 0 0; margin:0;">'.$com_name.'</h2></td>
			</tr>
			<tr>
			<td align="center" width="100%" colspan="7" style="border:none;">&nbsp;</td>
			</tr>
			<tr>
			<td align="left" width="100%" colspan="7"  style="border:none;padding:10px;">'.$emailTxt.'</td>
			</tr>
  			<tr>
			<td align="center" width="100%" colspan="7" style="border:none;">&nbsp;</td>
			</tr>
			<tr>
			<td align="center" width="100%" colspan="7" style="border:none;">&nbsp;</td>
			</tr>
			</table>';
  
  return $body;
	
}


function getRemindingContent($ClientName,$inv_num,$inv_date,$inv_due_date,$inv_amount=0,$days=""){
	

		$Content="";
	if($days=='before_3_days'){
	$Content = '<table width="100%" border="0" cellpadding="10" style="">
			<tr>
			<td align="" width="100%" colspan=""  >Dear '.$ClientName.',</td>
			</tr>
			<tr>
			<td align="" width="100%" colspan=""  >We  thank and appreciate  for doing business with us.</td>
			</tr>
			<tr>
			<td align="" width="100%" colspan=""  >This is a friendly reminder to let you know that the following invoice number will be due for payment on <strong>'.$inv_due_date.'</strong>. Should you have any query about this invoice, please contact us as soon as possible.</td>
			</tr>
			
			<tr>
			<td align="" width="100%" colspan=""  ><strong>Invoice Number : '.$inv_num.'
			</strong></td>
			</tr>
			<tr>
			<td align="" width="100%" colspan=""  ><strong>Invoice Date : '.$inv_date.'
			</strong></td>
			</tr>
			<tr>
			<td align="" width="100%" colspan=""  ><strong>Invoice Due Date : '.$inv_due_date.'</strong></td>
			</tr>
			<tr>
			<td align="" width="100%" colspan=""  >We would appreciate receiving of our payment within due date. Hope to continue our services and further strengthen of our  congenial business relationship in future.</td>
			</tr>
			<tr>
			<td align="" width="100%" colspan=""  >
			<br />Best Regards
			<br />Client Relations 
			<br />Background Check Group
			</td>
			</tr>
			</table>';
	
	}
	if($days=='after_7_days'){


	$Content = '<table width="100%" border="0" cellpadding="10" style="">
			<tr>
			<td align="" width="100%" colspan=""  >Dear '.$ClientName.',</td>
			</tr>
			
			<tr>
			<td align="" width="100%" colspan=""  >We write to inform you that we have not yet received payment against the following invoice(s). We realize you must have been busy and therefore  overlooked it.By sending this email may we  ask  you to expedite this matter and clearance of our payment at the earliest. If you have already sent the payment, please ignore this message. </td>
			</tr>
			<tr>
			<td align="" width="100%" colspan=""  ><strong>Invoice Number : '.$inv_num.'
			</strong></td>
			</tr>
			<tr>
			<td align="" width="100%" colspan=""  ><strong>Invoice Date : '.$inv_date.'</strong></td>
			</tr>
			
			<tr>
			<td align="" width="100%" colspan=""  >We remind you again and again just to make our services available to you 24/7, which will be difficult for us to continue if your invoice(s) remain unpaid after 10 days of due date, because your portal access will automatically blocked due to the policy implemented by the invoicing system. </td>
			</tr>
			
			<tr>
			<td align="" width="100%" colspan=""  >Thank you for your support and doing business with us . We assure you our best services at all times.</td>
			</tr>
			<tr>
			<td align="" width="100%" colspan=""  ><br />Best Regards</td>
			</tr>
			</table>';
	
	}
	
	if($days=='on_due_date'){
	
		
	$Content = '<table width="100%" border="0" cellpadding="10" style="">
			<tr>
			<td align="" width="100%" colspan=""  >Dear '.$ClientName.',</td>
			</tr>
			
			<tr>
			<td align="" width="100%" colspan=""  >This is a friendly reminder to let you know that following invoice is due today for payment. If you have already sent the payment, please ignore this message. If not, we would appreciate your prompt attention to this matter.</td>
			</tr>
			<tr>
			<td align="" width="100%" colspan=""  ><strong>Invoice Number : '.$inv_num.'</strong></td>
			</tr>
			<tr>
			<td align="" width="100%" colspan=""  ><strong>Invoice Date : '.$inv_date.'</strong></td>
			</tr>
			
			 
			<tr>
			<td align="" width="100%" colspan=""  >Thank you for doing business with us.</td>
			</tr>
			<tr>
			<td align="" width="100%" colspan=""  ><br />Best Regards</td>
			</tr>
			</table>';
			
	
	}
	
	if($days=='general'){
	
		
	$Content = '<table width="100%" border="0" cellpadding="10" style="">
			<tr>
			<td align="" width="100%" colspan=""  >Dear '.$ClientName.',</td>
			</tr>
			
			<tr>
			<td align="" width="100%" colspan=""  >This is a friendly reminder to let you know that following invoice is due for payment. If you have already sent the payment, please ignore this message. If not, we would appreciate your prompt attention to this matter.</td>
			</tr>
			<tr>
			<td align="" width="100%" colspan=""  ><strong>Invoice Number : '.$inv_num.'
			</strong></td>
			</tr>
			<tr>
			<td align="" width="100%" colspan=""  ><strong>Invoice Date : '.$inv_date.'
			</strong></td>
			</tr>
			<tr>
			<td align="" width="100%" colspan=""  ><strong>Invoice Due Date : '.$inv_due_date.'</strong></td>
			</tr>
			
			 
			<tr>
			<td align="" width="100%" colspan=""  >Thank you for doing business with us.</td>
			</tr>
			<tr>
			<td align="" width="100%" colspan=""  >
			<br />Best Regards,
			<br /><br />Client Relations 
			<br />Background Check Group
			</td>
			</tr>
			</table>';
			
	
	}
	
	return $Content;
}
function getInvoiceAmount($inv_num){
	global $db;
	$selAmount = $db->select("invoice_total_amount","total_amount"," invoice_number ='$inv_num' ");
	if(mysql_num_rows($selAmount)>0){
	$rsAmount = mysql_fetch_assoc($selAmount);
	
	return $rsAmount['total_amount'];
	}else{
	return 0;
	}
}

function getUsernameFromEmail($email=""){
	if($email!=""){
	$parts = explode("@", $email);
	$username = ucfirst($parts[0]);
	return $username;
	}else{
		return "Client";
	}
}

?>