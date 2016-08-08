<?php  include('include/config.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<style type="text/css">
	.page{ 
	
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
	width:100%;
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
	
	.pinfor{ width:60%; margin:auto; font-style:italic; color:#666666; font-size:22px; border-top:2px solid #ccc; border-bottom:2px solid #ccc; padding-top:10px; padding-bottom:10px;}
	.pinfor table tr td{ padding-bottom:10px;}
	img.seal{ position:absolute; right:15px; bottom:75px;}
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
<?php if(isset($_REQUEST['code'])){
	
	$code =  explode('-',$_REQUEST['code']);
	$pCode = ''; $sCode = '';
	if(count($code)>1){
			$pCode = strtolower(trim($code[0]));
		 	$sCode = intval(trim($code[1]));
	}

	if(is_numeric($sCode) && $pCode=='bcpl'){
	
	$db = new DB();
	$varData = $db->select("ver_data","*","v_id='$sCode'");
	if(mysql_num_rows($varData)>0){
			$varData = mysql_fetch_array($varData);
			if(strtolower($varData['v_status'])=='close'){
			$vSts = vs_Status(strtolower($varData['v_rlevel']));
			if(strtolower($vSts) == 'green'){ ?>

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
			<div class="certifytxt" style="margin-top:15px;">RiskDiscovered has completed the </div>
            <div class="certifybag">background verification</div>
            <div class="certifytxt"> of </div>
			<div class="certifynam"> <?=$varData['v_name']?> </div>
            <div class="certifytxt" style="margin-bottom:15px;"> and found clear for:</div>
			
		   <div class="pinfor">
		   <table border="0" cellpadding="0" cellspacing="0" width="100%">
			   <?php 		
					$asWhere = "v_id=$varData[v_id] AND as_status='Close' AND as_isdlt=0 GROUP BY checks_title";
					$checks = $db->select("ver_checks vc INNER JOIN checks ck ON ck.checks_id=vc.checks_id","checks_title,count(checks_title) counts",$asWhere);
					while($check = mysql_fetch_assoc($checks)){ 
						for($ind=0;$ind<$check['counts'];$ind++){?>
                            <tr>
                                <td><?=$check['checks_title'].(($check['counts']>1)?"-".($ind+1):'')?>:</td>   
                                <td><img src="images/tick.png" /></td>   
                            </tr>
				<?php 	}
					}
				?>
		   </table>
		   </div> 
		   <div><img src="images/rd-seal.png" class="seal" />
		   <!-- /body section -->
		   
		   <!-- /footer section -->
		   <div class="repfooter">
				<ul>
					<li class="phone">(+92) 3530 99 33</li>
					<li class="email">info@riskdiscovered.com</li>
					<li class="web">To verify this certificate please visit <span>http://www.riskdiscovered.com</span></li>
				</ul>
		   </div>
		</div>
		</div>
<?php 
			}else{ ?>
            	<div style="text-align:center;">
                <div style=" clear:both; font-family:'Open Sans', Helvetica, sans-serif; font-weight:bold; font-size:48px; margin-top:100px;">The BCPL issues the certificate only for positive case</div>
                </div>
<?php			}
		}else{ ?>
        	<div style="text-align:center;">
			<div style=" clear:both; font-family:'Open Sans', Helvetica, sans-serif; font-weight:bold; font-size:48px; margin-top:100px;">Verification is under processing...</div>		
            </div>
<?php		}
	}
	}else{?>
    <div style="text-align:center;">
    <div style=" clear:both; font-family:'Open Sans', Helvetica, sans-serif; font-weight:bold; font-size:48px; margin-top:100px;">The certificate does not exist. </div>
    <h5 style="margin-top:25px;">Please contact your employer or email at <a href="mailto:info@riskdiscovered.com">info@riskdiscovered.com</a></h5>
    </div>
	<?php
	}
}?>
</body>
</html>
