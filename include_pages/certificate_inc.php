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
					<li class="phone">+92 (021) 111-92-92-92</li>
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
