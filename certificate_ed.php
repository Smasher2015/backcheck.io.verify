<?php  include('include/config.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
	.page{ 
		 
		width:1105px;
		min-height:770px; 
		
		background:url('images/rd-certificate-BG.png') no-repeat center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
  
		border:1px solid #ccc;
		
		font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
		position:relative;
	}
	.clear{ clear:both;}
	.alignright{ text-align:right;}
		/* top bar*/
	.green, .lightgreen, .red, .lightred{ height:15px; float:left;}
	 ul.topbar{ padding:0; margin:0;}
	 ul.topbar li{ margin:0; display:inline-block; width:25%;} 
	.green{ background-color:#00713d;}
	.lightgreen{background-color:#118a61;}
	.red{background-color:#8c0b05;}
	.lightred{background-color:#e41b23;}
	ul.rd-ref li{ list-style:none;}
	ul.rd-ref li span{ color:#666; }
	ul.rd-ref li:first-child{ margin-bottom:15px;}
	/* top bar*/
	
	/* header section*/
	.rep-logo{background:url('images/rd-report-logo.png');}
	.halfwidth{ width:48%; margin-right:1%; float:left;}
	.largheading{ font-size:48px; color:#ffffff; background:#000; text-align:center;}
	/* header section*/
	/* body section*/
	.certifytxt{ 
	text-align:center;
	font-size:20px;
	color:#666666;
	font-family:Arial, 'Helvetica', sans-serif;
	 }
	 .certifynam{
	width:100%;
	text-align:center;
	font-size:32px;
	color:#006633;	
	font-family:Arial, 'Helvetica', sans-serif;
	}
	
	.certifybag{
	width:100%;
	text-align:center;
	font-size:32px;
	color:#000000;	
	font-family:Arial, 'Helvetica', sans-serif;
	}
	
	.certifytxt span{ color:#000000;}
	
	/* body section*/
	
	.pinfor{ width:60%; margin:auto; font-style:italic; color:#666666; font-size:16px; border-top:2px solid #ccc; border-bottom:2px solid #ccc; padding-top:10px; padding-bottom:10px;}
	.pinfor table tr td{ padding-bottom:10px;}
	img.seal{ width: 200px;}
	/*footer area*/
	.repfooter{ background:#8c0b05; position:absolute; bottom:0; width:100%;}
	.repfooter ul{ padding:0; margin:0;}
	.repfooter li{ float:left; list-style:none; font-size:14px; text-align:center; color:#ffffff; padding:10px 5px;} 
	.phone{ width:20%;}
	.email{ width:25%; }
	.web{ width:50%;}
	.web span{}
</style>
</head>

<body>

<?php
$case=false;
if(is_numeric($_REQUEST['id'])){
	$case = 	$_REQUEST['id'];
} 

if($case){
	$db = new DB();
	$varData = $db->select("ver_data","*","v_id=$case");
	if(mysql_num_rows($varData)>0){
			$varData = mysql_fetch_array($varData); 
			if(strtolower($varData['v_status'])=='close'){
			$vSts = vs_Status(strtolower($varData['v_rlevel']));
			if(strtolower($vSts) == 'green'){?>
		<div class="page">
			<!-- top bar -->
			<ul class="topbar">
				<li class="green"></li>
				<li class="lightgreen"></li>
				<li class="red"></li>
				<li class="lightred"></li>
			</ul>
			<div class="clear"></div>
			<!-- /top bar -->
			
			<!-- /header section -->
			<div class="report-hd">
				<div class="halfwidth"><img src="images/rd-report-logo.png" width="153" /></div>
				<div class="halfwidth alignright">
					<ul class="rd-ref">
						<li>Verification Code:<span>  <?=bcplcode($varData['v_id'])?></span></li>
						<li>Certification Date:<span> <?php
                        	if($varData['v_stdate']!=""){
								$varData['v_stdate'] = date("j-M-Y",strtotime($varData['v_stdate']));
							}else{
								$varData['v_stdate'] = date("j-M-Y",time());
							}
							echo $varData['v_stdate'];
							?></span></li>
						<li>Expiry Date: <span><?php
						$month = date("m",strtotime($varData['v_stdate']));
						$day = date("j",strtotime($varData['v_stdate']));
						$year = date("Y",strtotime($varData['v_stdate']));
						$timestamp = mktime(0, 0, 0, $month, $day, $year+1);
						echo date("j-M-Y",$timestamp)?></span></li>
					</ul>
				</div>
				 <div class="clear"></div>
			</div>
			<div class="clear"></div>
            
			<div class="largheading">Certificate of Verification</div>
			<!-- /header section -->
			<!-- body section -->
            <?php

			    $asWhere = "v_id=$varData[v_id] AND vc.checks_id=1 AND as_status='Close' AND vc.as_isdlt=0";
			    $check = $db->select("ver_checks vc INNER JOIN checks ck ON ck.checks_id=vc.checks_id","*",$asWhere);
			if(mysql_num_rows($check)>0){
				$check = mysql_fetch_assoc($check);
				
            	$vuni = $db->select("add_data","*","as_id=$check[as_id] AND d_type='vuni' AND d_isdlt=0");
				$vuni = mysql_fetch_array($vuni); 
				
				$dmain = $db->select("add_data","*","as_id=$check[as_id] AND d_type='dmain' AND d_isdlt=0");
				$dmain = mysql_fetch_array($dmain);
			?>
			
            <div class="certifytxt" style="margin-top:15px;">RiskDiscovered has completed the </div>
            <div class="certifybag">background verification</div>
            <div class="certifytxt"> of </div>
			<div class="certifynam"> <?=$varData['v_name']?> </div>
            <div class="certifytxt" style="margin-bottom:15px;"> and found clear for:</div>
            
            
			
		   <div class="pinfor">
               <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td width="30%">Name of Candidate:</td>   	<td><?=$varData['v_name']?></td> 
                        </tr>
                         <tr>
                            <td  width="30%">Father's Name:</td>   		<td><?=$varData['v_ftname']?></td> 
                        </tr>
                        <tr> 
                            <td  width="30%">Name of Institute:</td>   	<td><?=$vuni['d_value']?></td>
                        </tr> 
                        <tr> 
                            <td  width="30%">Qualification:</td>   		<td><?=$dmain['d_value']?></td>   
                        </tr>
                        
               </table>
		   </div> 
           
           <?php }?>
           
           <style>
           	.napbs{
				bottom: 75px;
				position: absolute;
				right: 60px;
			}
			.disclaimer{
			   	float: left;
				font-size: 9px;
				margin-left: 40px;
				margin-top: 87px;
				text-align: justify;
				width: 70%;
			}
           </style>
           
		   <div>
           <div>
           
           	<div class="disclaimer">
            	
               <strong> Disclaimer:</strong> This certificate only sets out information obtained from records examined by Background Check Pvt. Ltd. No opinion whatsoever is provided with respect to the individuals who are the subject of the report. It does not constitute recommendations as to what action should be taken. Due care has been exercised to ensure the accurateness of information herein. All personal data provided in this report is intended to be for the sole purpose of client's evaluation and not intended for public dissemination. No part of this publication may be reproduced, photo-copied, stored on a retrieval system, or transmitted without the express written consent from Background Check Pvt. Ltd.
                
            </div>
           	<div class="napbs">
           <img src="images/napbs-logo.png" class="seal" />
           </div>
           
           </div>
		   <!-- /body section -->
		   
		   <!-- /footer section -->
		   <div class="repfooter">
				<ul>
					<li class="phone"> +92 (021) 111-92-92-92 </li>
					<li class="email">info@riskdiscovered.com</li>
					<li class="web">To verify this certificate please visit <span>http://www.riskdiscovered.com</span></li>
				</ul>
		   </div>
		</div>
		</div>
	<?php 
			}else{
				echo "<h1>The BCPL issues this certificate only for positive case</h1>";
			}
		}else{
			echo "<h1>Verification is under processing...</h1>";		
		}
	}
}?>

</body>
</html>
