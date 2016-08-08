<?php  include("include/config.php");
 
if(isset($_POST['submit']))
{
 //print_r($_POST);

 	$companyID = $_POST['companyID'];
	
	$message .= "<table width=\"600\" border=\"0\" cellpadding=\"5\" style=\"margin:0 auto; border-spacing: 0px; border-radius: 10px 10px 0 0; overflow: hidden; font-family:Verdana, Geneva, sans-serif\" bgcolor=\"#f6f6f7\">  
  
  <tr>
    <td align=\"left\" style=\"padding:13px;\" bgcolor=\"#747D7D\"><img src=\"".SURL."images/logo_email.png\" /></td>
    <td align=\"left\" width=\"36%\" style=\"padding:20px;\" bgcolor=\"#747D7D\"><a href=\"".SURL."\" style=\"text-decoration:none; background-color: #444; padding: 8px 12px; line-height: 1; color: #fff; font-size: 14px; margin: 0; border-radius: 4px; text-align: center;\">Verification System</a></td>
  </tr>
 
  <tr>
  	<td align=\"center\" width=\"100%\" colspan=\"3\"><h3 style=\"color:#465059; padding:20px 0 0 0; margin:0;\">Previous Employment Response</h3></td>
  </tr> <tr>
  	<td align=\"center\" width=\"100%\" colspan=\"3\"><h3 style=\"font-weight:normal; color:#70bff3;\">Dear BCG ,</h3></td>
  </tr>
  <tr>
  <th>Field</th><th>Detail</th><th>Response</th>
  </tr>
  ";
  

	$totalfields = count($_POST);
	for($i = 1; $totalfields > $i; $i++)
	{ 
	 $fieldname = $_POST['fieldname_'.$i];
	 $modifyname = str_replace("_"," ",$fieldname);
	 
 	 $fieldvalue = $_POST['fieldvalue_'.$i];
	echo $yesorno = $_POST['YesNo_'.$i];
	$reason = $_POST['reasons_'.$i];
echo	$d_id = $_POST['d_id_'.$i];
	 
		//$db->update("d_id=".$d_id."","add_data","d_value=".$yesorno."");
	 	mysql_query("UPDATE add_data SET d_value='".$yesorno."' WHERE d_id=".$d_id."");
	 
	 
	 if($yesorno == "yes")
	 {
		 $setaction = 'True';
	 }
	 else if($yesorno == "no" )
		{
		 $setaction = $reason;
		}
	 else
		{
		 $setaction = '';
		}
		
	if($fieldname == 'select_company')
	{
		$data = $db->select("comp_info","*","id = ".$companyID."");
		$companyinfo = mysql_fetch_array($data);
		$fieldvalue = $companyinfo['cname'];
		$modifyname = "company name";
	}	
		
$message.="<tr>
  	<td >".ucwords($modifyname)." </td>
	<td > ".$fieldvalue."</td>
	<td >".$setaction." </td>
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
	  
	  
	  
	</table>";
	

//   $mail             = new PHPMailer();
//   $mail->IsSMTP(); // telling the class to use SMTP
//   $mail->SMTPAuth   = true;                  // enable SMTP authentication
//   $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
//   $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
//   $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
//   $mail->Username   = "noreply@backcheckgroup.com";  // GMAIL username
//   $mail->Password   = "kashif123";              // GMAIL password
//   $mail->SetFrom('noreply@riskdiscovered.com');
   
   
  /* if($bccMail!=''){
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
   */
//   $mail->Subject    = "Previous Employment Response";
//   $mail->MsgHTML($message);
//  //echo $message.'<br>'; exit;
//   $mail->AddAddress("ata@backgroundcheck.email");
//   $mail->Send();


	
	
	
	
	echo '<h1>Thanks For Coprate With <a href="backcheckgroup.com">BCG</a> For This Verification</h1>';
 
}

?>
