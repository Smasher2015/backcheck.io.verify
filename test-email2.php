<?php
require_once("include/config.php");

$table =" Kidly see this eamil. ";
$title ="test eamil";
$sEmail="atta@xcluesiv.com";

echo emailTmp123($table,$title,$sEmail);


function emailTmp123($table,$title,$sEmail,$fEmial='',$cMail='',$bccMail='',$user_id='',$recipient_name='',$heading=''){
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
  
  $username = '<p style="color: #27abc9; font-size:29px;">Hi '.$username.'!</p>';
 
  }
  else {
	 $username = '<p style="color: #27abc9; font-size:29px;"> '.($heading!='')?$heading:$title.' </p>';
	 }

   
  $message .= '<tr>
  	<td align="left" width="100%" colspan="3" style="padding: 0px 28px;font-size: 17px;line-height: 19px;">
	'.$username.' <p>Welcome to Background Check Group!</p></td>
  </tr>';
  
 $message .= '<tr>
  	<td style="font-size: 13px;line-height: 21px;padding: 0 28px;text-align: left;color: #7e8385;">'.$table.'<p>Have any questions? Just shoot an email! We’re always here to help you.</p>

<p>Cheerfully yours, <br>
Background Check Team</p> 
     </td>
  </tr>
   <tr>
  	<td align="center" width="100%" colspan="3" bgcolor="#FFFFFF"><p style="padding:17px 17px; color: #54565c; font-size:13px;"><a href="#" style="color: #fff;background: #27abc9;text-decoration: none;padding: 15px 41px;font-size: 13px;text-transform: uppercase; border-radius:68px;">have any questions ?</a></p></td>
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




?>