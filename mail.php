<?php
	require_once('functions/class.phpmailer.php');
   $mail             = new PHPMailer();
   $body             = eregi_replace("[\]",'',"daadad da dad ad ad a da da d d");
   $mail->IsSMTP(); // telling the class to use SMTP
   $mail->SMTPAuth   = true;                  // enable SMTP authentication
   $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
   $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
   $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
   $mail->Username   = "noreply@backgroundcheck365.com";  // GMAIL username
   $mail->Password   = "&rd8V6tL";            // GMAIL password
   $mail->SetFrom("noreply@backgroundcheck365.com");
   //$mail->AddBCC("tadil@dataflowgroup.com");
   //momorders@dataflowgroup.net
   $mail->Subject    = "Work Pass Application,Singapore";
   $mail->MsgHTML($body);
   $address = "rizwan@xcluesiv.com" ;
   
   $mail->AddAddress($address);
   // if($pay['marksheet']!=''){
   //  $mail->AddAttachment($pay['marksheet']);
   //}
   //$mail->AddAttachment($pay['degree']); // attachment
   //$mail->AddAttachment($pay['letter']);
   
   $mail->Send();
?>