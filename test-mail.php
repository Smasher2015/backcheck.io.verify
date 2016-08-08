<?php
require_once("/home/backglob/public_html/verify/functions/class.phpmailer.php");
define("SURL","http://riskdiscovered.com/verify/");

function emailTmp($table,$title,$sEmail,$fEmial='',$cMail='',$bccMail='',$user_id='',$recipient_name=''){
$username 	= "Rafiq Ghanchi";
  	if($fEmial=='') $fEmial="khalique@xcluesiv.com";

	$message="<body style=\"background: #e6ebef;\"><table width=\"600\" border=\"0\" cellpadding=\"5\" style=\"margin:0 auto; border-spacing: 0px; overflow: hidden; font-family:Arial, Helvetica, sans-serif\">
		<tr>
    <td align=\"left\" style=\"padding:13px;\"><img src=\"".SURL."images/logo_email.png\" /></td>
    <td align=\"right\" width=\"36%\" style=\"padding:20px;\"><a href=\"".SURL."\" style=\"text-decoration:none; background-color: #444; padding: 8px 12px; line-height: 1; color: #fff; font-size: 14px; margin: 0; border-radius: 4px; text-align: center;\">Verification System</a></td>
  </tr>
	</table>
	
	
	<table width=\"600\" border=\"0\" cellpadding=\"5\" style=\"margin:0 auto; border-spacing: 0px; border-radius: 5px; overflow: hidden; font-family:Arial, Helvetica, sans-serif\" bgcolor=\"#fff\">  
  
  
  <tr>
  	<td align=\"left\" width=\"100%\" colspan=\"3\" style=\"padding: 0 34px;\"><h2 style=\"color:#848b90; padding:20px 0 0 0; margin:0;\">".$title."</h2></td>
  </tr>
  
  
  
  <tr>
  	<td align=\"left\" width=\"100%\" colspan=\"3\" style=\"padding: 0 34px;\"><h3 style=\"font-weight:normal; color:#70bff3;\">Dear ".$username."</h3></td>
  </tr>
 
 	
  <tr>
  	<td align=\"left\" width=\"100%\" colspan=\"3\" style=\"padding:0 34px; color:#848b90;\">
		<table border=\"1\" cellpadding=\"10\" cellspacing=\"0\" width=\"100%\" bordercolor=\"#eee\">
			<tr>
				<td>username</td>
				<td>Rafiq</td>
			</tr>
			<tr>
				<td>username</td>
				<td>Rafiq</td>
			</tr>
		
		</table>
	
	</td>
  </tr>
  
  
  
  <tr>
  	<td align=\"left\" width=\"100%\" colspan=\"3\" style=\"padding:0 15px;\"><p style=\"padding:5px 20px; color: #848b90; font-size:13px;\">If you need help or have any questions, please visit our <a href=\"".SURL."?action=adsupport&atype=support\" style=\"color:#fd4f00\"><span>Support</span></a>.</p></td>
  </tr>
  
  
  
  
  
</table> <table width=\"600\" border=\"0\" cellpadding=\"5\" style=\"margin:0 auto; border-spacing: 0px; overflow: hidden; font-family:Arial, Helvetica, sans-serif\">
		 <tr>
  	<td align=\"left\" width=\"100%\" colspan=\"3\"><p style=\"padding:5px 20px; color: #848b90; font-size:13px;\"> &copy; 2007 - 2015 - All rights reserved | Powered by <a href=\"".COPYRIGHT_URL."\" style=\"color:#c01c23; text-decoration: none;\">Background Check Pvt Ltd.</a> 
</td>
  </tr> 
	</table> </body>";



								   $mail             = new PHPMailer();
								   $mail->IsSMTP(); // telling the class to use SMTP
								   $mail->SMTPAuth   = true;                  // enable SMTP authentication
								   $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
								   $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
								   $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
								   $mail->Username   = "hassan@xcluesiv.com";  // GMAIL username
								   $mail->Password   = "Smasher2010";              // GMAIL password
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
  // echo $sEmail.'<br>'; exit;
   $mail->AddAddress($sEmail);
   $mail->Send();
  
}
$table =" Kidly see this eamil. ";
$title ="test eamil";
$sEmail="hassan@xcluesiv.com";

echo emailTmp($table,$title,$sEmail);

?>