<?php include ('include/config.php');
	$query=mysql_query("select * from auto_dd where dd_cron=0  limit 1") or die(mysql_error());
	while($dd=mysql_fetch_array($query)){
		$uniname=$dd['uni_name'];
		$uniinfo=mysql_query("SELECT * FROM uni_info uni_mas INNER JOIN `uni_var` `uni_chi` ON uni_mas.`uni_id`=uni_chi.`uni_id`
WHERE uni_mas.`uni_Name`='".mysql_real_escape_string($uniname)."' OR uni_chi.`ver_name`='".mysql_real_escape_string($uniname)."' AND 
uni_mas.uni_ddr=1 AND uni_mas.uni_fee>0 GROUP BY uni_mas.uni_id")  or die(mysql_error());
		//$uniinfo=mysql_query("SELECT * FROM uni_info WHERE uni_Name = '".mysql_real_escape_string($uniname)."' and uni_ddr=1 and //uni_fee>0 limit 1")  or die(mysql_error());
		$dd_count=mysql_query("SELECT * FROM dd_data WHERE dd_bcode='".$dd['subbarcode']."' AND dd_status!=3");
		if(mysql_num_rows($uniinfo)>0 && mysql_num_rows($dd_count)==0){
			$uniinfo=mysql_fetch_array($uniinfo);
			
			mysql_query("INSERT INTO `dd_data`(`dd_bcode`,`dd_dataflow`,`dd_user`,`dd_uni`,`dd_bene`,`dd_units`,`dd_fee`,`dd_cdate`,`dd_active`,`dd_status`)
			VALUES ('".$dd['subbarcode']."','1','3','".$uniinfo['uni_id']."','".mysql_real_escape_string($uniinfo['uni_ben'])."','1','".$uniinfo['uni_fee']."','".date("Y-m-d H:i:s")."','1','1')") or die(mysql_error());
			 mysql_query("update auto_dd set `dd_cron`=1,`dd_status`=1,`dd_updatedate`='".date("Y-m-d H:i:s")."' where id='".$dd['id']."'") or die(mysql_error());
		}else{
			 mysql_query("update auto_dd set `dd_cron`=1,`dd_updatedate`='".date("Y-m-d H:i:s")."' where id='".$dd['id']."'")  or die(mysql_error());
		}
		
}
 if(date("H:i a") == '15:00 pm')
 {
							// FUNCTION START FOR CRON RUN AND STATUS ALSO 1 // 
	$cron_and_status_fine = '';
	$title = "Demand Draft Send Successfully For " . date("d-m-Y");
	$query=mysql_query("SELECT * FROM auto_dd WHERE dd_cron=1 AND dd_status=1 AND is_email=0");
	$i=1;
	while($dd=mysql_fetch_array($query))
	{
		$cron_and_status_fine .= "<tr><td>".$i."</td><td>".$dd["uni_name"]."</td><td>".$dd["subbarcode"]."</td></tr>";
		mysql_query("update auto_dd set `is_email`=1 where id='".$dd['id']."'");
		$i++;
	}
							// FUNCTION END FOR CRON RUN AND STATUS ALSO 1 // 
							// FUNCTION START FOR CRON RUN BUT STATUS 0 // 
	$cron_and_status_not = '';
	$title2 = "Demand Draft Not Send Successfully For " . date("d-m-Y");
	$query=mysql_query("select * from auto_dd where dd_cron=1 and dd_status=0 AND is_email=0");
	$j=1;
	while($dd=mysql_fetch_array($query))
	{
		$cron_and_status_not .= "<tr><td>".$j."</td><td>".$dd["uni_name"]."</td><td>".$dd["subbarcode"]."</td></tr>";
		mysql_query("update auto_dd set `is_email`=1 where id='".$dd['id']."'");
		$j++;
	}
							// FUNCTION START FOR CRON RUN BUT STATUS 0 // 
							// EMAIL TEMP FOR 1 AND 1 //


	$message .= "<table width=\"600\" border=\"0\" cellpadding=\"5\" style=\"margin:0 auto; border-spacing: 0px; border-radius: 10px 10px 0 0; overflow: hidden; font-family:Verdana, Geneva, sans-serif\" bgcolor=\"#f6f6f7\">  
  
  <tr>
    <td align=\"left\" style=\"padding:13px;\" bgcolor=\"#747D7D\"><img src=\"".SURL."images/logo_email.png\" /></td>
    <td align=\"left\" width=\"36%\" style=\"padding:20px;\" bgcolor=\"#747D7D\"><a href=\"".SURL."\" style=\"text-decoration:none; background-color: #444; padding: 8px 12px; line-height: 1; color: #fff; font-size: 14px; margin: 0; border-radius: 4px; text-align: center;\">Verification System</a></td>
  </tr>
  <tr>
  	<td align=\"center\" width=\"100%\" colspan=\"3\"><h3 style=\"color:#465059; padding:20px 0 0 0; margin:0;\">".$title."</h3></td>
  </tr>
  <tr>
  <td colspan=\"3\">
  <table width=\"93%\" cellpadding=\"5px\" cellspacing=\"0\" border=\"1px\" bordercolor=\"#EEEEEE\" style=\"text-align: center;margin: 0 auto;font-size: 12px;border-color: #eee;\"><thead><th>S.No.</th><th>University</th><th>Bar Code</th></thead>
  <tbody>".$cron_and_status_fine."</tbody>
  </table>
  </td>
  </tr>
  ";
  
 
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
 								   $mail             = new PHPMailer();
								   $mail->IsSMTP(); // telling the class to use SMTP
								   $mail->SMTPAuth   = true;                  // enable SMTP authentication
								   $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
								   $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
								   $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
								   $mail->Username   = "noreply@backcheckgroup.com";  // GMAIL username
								   $mail->Password   = "kashif123";              // GMAIL password
								   $mail->SetFrom('noreply@riskdiscovered.com');
/*    if($bccMail!=''){
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
	}*/
   
   $mail->Subject    = $title;
   $mail->MsgHTML($message);
  //echo $message.'<br>'; exit;mis@backcheckgroup.com
   $mail->AddAddress("mis@backcheckgroup.com");
   $mail->Send();
  
 

// END 1 AND 1 //



// 1 AND 0 //



	$message2 .= "<table width=\"600\" border=\"0\" cellpadding=\"5\" style=\"margin:0 auto; border-spacing: 0px; border-radius: 10px 10px 0 0; overflow: hidden; font-family:Verdana, Geneva, sans-serif\" bgcolor=\"#f6f6f7\">  
  
  <tr>
    <td align=\"left\" style=\"padding:13px;\" bgcolor=\"#747D7D\"><img src=\"".SURL."images/logo_email.png\" /></td>
    <td align=\"left\" width=\"36%\" style=\"padding:20px;\" bgcolor=\"#747D7D\"><a href=\"".SURL."\" style=\"text-decoration:none; background-color: #444; padding: 8px 12px; line-height: 1; color: #fff; font-size: 14px; margin: 0; border-radius: 4px; text-align: center;\">Verification System</a></td>
  </tr>
 
  <tr>
  	<td align=\"center\" width=\"100%\" colspan=\"3\"><h3 style=\"color:#465059; padding:20px 0 0 0; margin:0;\">".$title2."</h3></td>
  </tr>
  
  <tr>
   <td colspan=\"3\">
  <table width=\"93%\" cellpadding=\"5px\" cellspacing=\"0\" border=\"1px\" bordercolor=\"#EEEEEE\" style=\"text-align: center;margin: 0 auto;font-size: 12px;border-color: #eee;\"><thead><th>S.No.</th><th>University</th><th>Bar Code</th></thead>
  <tbody>
  ".$cron_and_status_not."
  </tbody>
  </table>
  </td>
  </tr>
  ";
  
 
 $message2 .= " <tr>
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
 								   $mail             = new PHPMailer();
								   $mail->IsSMTP(); // telling the class to use SMTP
								   $mail->SMTPAuth   = true;                  // enable SMTP authentication
								   $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
								   $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
								   $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
								   $mail->Username   = "noreply@backcheckgroup.com";  // GMAIL username
								   $mail->Password   = "kashif123";              // GMAIL password
								   $mail->SetFrom('noreply@riskdiscovered.com');
/*    if($bccMail!=''){
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
	}*/
   
   $mail->Subject    = $title2;
   $mail->MsgHTML($message2);
  //echo $message.'<br>'; exit;
   $mail->AddAddress("mis@backcheckgroup.com");
   $mail->Send();
// 1 AND 0


 }

?>
