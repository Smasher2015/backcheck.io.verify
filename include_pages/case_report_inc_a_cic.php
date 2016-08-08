<div class="pg">
<div class="ipg">


<?php /*?>

<div class="sec-main-header">
	<div class="sec-pdf-left-sec">
    		<img src="img/rdaprdlogo.png" alt="Risk Discovered" />
    </div>
    <div class="sec-pdf-right-sec">
    	<div class="sec-logo_style_design_rgt_head">
            <img src="img/soc.png" alt="AICPA SOC" width="115" />
        </div>
        <div class="sec-logo_style_design_lf_head">
            <img src="img/picdss.png" alt="PCI DSS" width="120" />
         </div>
    </div>
    <div style="clear:both;"></div>
    <div class="sec-straigth-bar"></div>
</div>
<div class="mbd">
<h1>RISK ASSESSMENT REPORT</h1>
<div class="tbl">
  <table class="table_OddEven" width="890" border="0"  cellpadding="0" cellspacing="0">
    <tr>
      <td>Name of Employee</td>
      <td class="txt-bold"><?php  echo $varData['v_name']; ?></td>
    </tr>
    
    <tr >
      <td>Employee ID</td>
      <td class="txt-bold"><?php echo $varData['emp_id']; ?></td>
    </tr>
  <?php if(isset($_REQUEST['certi'])){?>  
    <tr>
      <td>Tracking #</td>
      <td class="txt-bold"><?=bcplcode($varData['v_id'])?></td>
    </tr>
    <!--<tr>
      <td class="tda">&nbsp;</td>
      <td class="tdb">
      Verification can be tracked here <a href="https://riskdiscovered.com" title="Track Here">www.riskdiscovered.com</a>
      </td>
    </tr>-->
  <?php }?>
     <?php
		$comInfo = $db->select("company","name,id","id=$varData[com_id]");
		$comInfo = mysql_fetch_array($comInfo);
	   if($comInfo['id']==37){?>
    <tr>
      <td>Reference ID</td>
      <td class="txt-bold"><?=$varData['v_refid']?></td>
    </tr>
    <?php } ?>
    <tr>
      <td>Date of Report</td>
      <td class="txt-bold"><?php echo date("j-F-Y",time()); ?></td>
    </tr>
    <tr >
      <td>Level of Screening</td>
      <td class="txt-bold">
				<?php 
				if(mysql_num_rows($asDatas)==1){
					$asData = mysql_fetch_array($asDatas);
					$ascase = $asData['as_id']; 	
				}else $asData = mysql_fetch_array($asDatas);
				if($ascase!=0){
					$check = getCheck($asData['checks_id']);
					echo $check['checks_title'];
				}else{
					echo 'LEVEL 1';
				}
				?>      
      </td>
    </tr>
<!--    <tr >
      <td class="tda"><strong>Work Order #</strong></td>
      <td class="tdb">&nbsp;</td>
    </tr >-->
    
    <tr >
      <td>Client's Name</td>
      <td class="txt-bold"><?=$comInfo['name']?> </td>
    </tr>
    <tr >
      <td><span style="color:#F00;">Risk</span> Level</td>
      <td class="<?php
				if($ascase!=0) $vStatus = $asData['as_vstatus']; else $vStatus =$varData['v_rlevel']; 
				$vStatus = strtolower(trim($vStatus));
				$vSts = vs_Status($vStatus);
				echo $vSts;
				?>">
            <strong>
                        <?php echo $vSts; ?>
            </strong>
      </td>
    </tr>
  </table>
<div class="clear"></div>
</div>

<div style="min-height:350px;">
<?php
	$asDatas = $db->select("ver_checks vc INNER JOIN checks ck ON vc.checks_id=ck.checks_id","DISTINCT *","$asWhere ORDER BY checks_title");
	$numChkes = mysql_num_rows($asDatas);
	$fnos = 1;
	$cnts = 0;
 	while($asData = mysql_fetch_array($asDatas)){ ?>
				<div class="headline">
                	<span style="margin-left:20px;">
                    	<?php if($ascase==0) echo "$fnos-"; echo $asData['checks_title'];?>
                    </span>
                 </div>
				<div class="tbl">
                    <table class="table_OddEven" width="890" border="0"  cellpadding="0" cellspacing="0">
                            <tr >
                             	<td class="tdc">
                                <strong>
									<?php 
                                        $data = getData($asData['as_id'],"dmain");
                                        if(mysql_num_rows($data)>0){
                                            $data = mysql_fetch_array($data);
                                            echo $data['d_value'];

                                        }else{
                                            $data = $db->select("fields_maping","fl_title","fl_key='dmain' AND checks_id=$asData[checks_id] AND t_id=-1");
                                            $data = mysql_fetch_array($data);
                                            echo $data['fl_title'];
                                        }
                                     ?>
                                </strong>
                                </td>
                              	<td class="tdd">
                                <p style="font-weight:bold; color:#030; font-size:18px;">
									<?php 
                                        $vStatus = strtolower(trim($asData['as_vstatus']));
                                        $vSts = vs_Status($vStatus);
                                    ?>
                                    <span class="<?php echo "f$vSts"; ?>"><?php echo $asData['as_vstatus']; ?></span>                                
                                </p>
								<?php  
                                        $nos=0;
                                        $proofs = getData($asData['as_id'],"file");
                                        $pNums = mysql_num_rows($proofs);
                                        if($pNums>0){ ?>                                
                                                <p>Please refer to 
                                                <a href="javascript:void(0);">
                                                    Annexure-[ 
                                                    <?php  while($proof = mysql_fetch_array($proofs)){
                                                                if($ascase==0){
                                                                    $tLbl = ($fnos).(($pNums>1)?froofLbl($nos):'');
                                                                }else $tLbl = ($fnos+$nos);
                                                                echo (($nos>0)?"-":"").$tLbl;
                                                                $FILES[$cnts]['proof'] = $proof['d_value'];
                                                                $FILES[$cnts]['title'] = $proof['d_stitle'];
                                                                $FILES[$cnts]['pno'] = $tLbl;
                                                                $nos=$nos+1;
                                                                $cnts = $cnts+1;
                                                            }
                                                    ?> ]                                
                                                </a> below.</p>
                                <?php   } ?>
                                </td>
                            </tr>
                    </table>            		
        			<div class="clear"></div>
                </div>
<?php if($fnos==3) break;
		$fnos=$fnos+1;			
} ?>
</div>

<!--
	<div class="ctxt">
  <p><span style="font-size:16px; font-weight:bold; color:#F00;">To verify the content of this report, please call (021) 111-92-92-92 or </span></p>
  <p>
    <span style="font-size:16px; font-weight:bold;">Email your enquiry to <a href="#">info@riskdiscovered.com </a></span></p>
</div>
	<div class="ftxt">
  <p>RiskDiscovered™ is the brand name of BackgroundCheck Private Limited (formerly DataFlow Pakistan Pvt. Ltd), the largest and prestigious Primary Source Verification provider in Pakistan operating since 2007. For more information on our product and services, please refer to riskdiscovered.com/about/.   </p>
  <p> Disclaimer: This report only sets out information obtained from records searched by BackgroundCheck Private Limited. No opinion is provided in respect of the individuals who are the subject of the report. This report does not constitute recommendations as to what action should be taken in this matter. It is difficult to verify all aspects of the information obtained due to the nature of the enquires and the limitations of obtaining such information from private databases and public records. This whilst due care has been taken to ensure the accuracy of information contained in this report. All personal data supplied in this report is intended to be for the sole purpose of client's evaluation and is not intended for public dissemination.</p>
  <p> ©Copyright 2014 BackgroundCheck Private Limited. All rights reserved. No part of this publication may be reproduced, photo copied, stored on a retrieval system, or transmitted without the express prior consent of BackgroundCheck Private Limited. </p>
</div>-->
<div class="sec-main-header">
	<div class="cnt-bgc-txt">
        <strong>BACKGROUND CHECK PVT LTD</strong><br />
        <span>	
            3rd Floor GSA House 19 Timber Pond,<br />
            East Wharf, Keamari, Karachi 75620,<br />
            Pakistan – 021 - 111929292
		</span>
        <a href="mailto:info@backcheckgroup.com">info@backcheckgroup.com</a><br />
        <a href="http://www.backcheckgoup.com/" target="_blank">www.backcheckgroup.com</a><br />
    </div>
    <div class="cnt-bgc-logo">
    	<div class="sec-logo_style_design_rgt">
            <img src="img/sgs.png" alt="Risk Discovered" width="250" />
        </div>
    	<div class="sec-logo_style_design_lf">
            <img src="img/NAPBS.png" alt="Risk Discovered" width="250" />
         </div>
    </div>
    <div style="clear:both;"></div>
    <div class="about-content">
    	<strong>Disclaimer</strong>
    	<p>This report sets out information obtained by Background Check Pvt Ltd (BCPL) from third-party sources as well as Background Check Pvt Ltd (BCPL) objective analysis of the same, and should in no way be construed as a recommendation as to what course of action the client should take, or a personal opinion of Background Check Pvt Ltd (BCPL) with respect to any of the corporate entities or individuals named in this report.  Background Check Pvt Ltd  (BCPL) takes all due care to ensure the accuracy of the information provided, but cannot guarantee with absolute finality the validity or accuracy of all sources of information.  All actions taken by the client subsequent to receiving our report shall be understood to be the result of its decision alone, and the client shall hold Background Check Pvt Ltd (BCPL) free and harmless from any and all liability to itself or to any other party as a result of said decision. All personal data supplied in this report is intended to be for the sole purpose of client’s evaluation and is not intended for public dissemination.</p><br />
        <p>Riskdiscovered.com is a secured technology platform to facilitate the verification process and to automate the workflow. Riskdiscovered.com is online verification workflow management system that is complied with international security and compliance standards such as 256-bit SSL encryption, SOC 2, PCI DDS and HIPPA.</p><br />
        <p>©<strong>Copyright 2007 - 2015 Background Check Pvt Ltd. All rights reserved.</strong> No part of this publication may be reproduced, photo copied, stored on a retrieval system, or transmitted without the express prior consent of Background Check Pvt Ltd.</p>
    </div>
    
</div>

</div>

<?php */?>


<!--<div class="footer">
<div class="fta">Copyright 2014 BackgroundCheck Private Limited (formerly DataFlow Pakistan Pvt. Ltd) – All Rights Reserved</div>
<div class="ftb"><a href="http://www.riskdiscovered.com" >www.riskdiscovered.com</a></div>
</div>-->
	<div class="report-cover-section">
    	<div class="report-basic-info">
        <?php $asDatas = $db->select("ver_checks vc INNER JOIN checks ck ON vc.checks_id=ck.checks_id","DISTINCT *","$asWhere ORDER BY checks_title");
				$asData = mysql_fetch_array($asDatas);?>
        	<h2>CRIMINAL INTELLIGENCE CHECK<?php // echo $asData['checks_title']; ?></h2>
            <span class="light-dark-color"> 
            <?php
				
				echo $asData['as_vstatus'] . ' | ';?>
    		</span><span class="light-dark-color"><?php   echo $varData['v_name']; ?></span><br />
            <span class="dark-blue-color"><?php echo  date("l, M d, Y"); ?></span>
        </div>
        <?php if($asData['as_vstatus']=='Verified'){ ?>
        <div class="right-check-logo"></div>
        <?php }?>
        <div class="global-bg"></div>
        <div class="clear"></div>
        <div class="mid-sec">
        	<div class="middle-image-section"></div>
            <div class="mid-logo"></div>
        </div>
        <div class="background-image">
        	<div class="sec-main-header">
        <div class="cnt-bgc-txt">
            <strong>BACKGROUND CHECK PVT LTD</strong><br />
            <span>	
                3rd Floor GSA House 19 Timber Pond,<br />
                East Wharf, Keamari, Karachi 75620,<br />
                Pakistan – 021 - 111929292
            </span>
            <a href="mailto:info@backcheckgroup.com">info@backcheckgroup.com</a><br />
            <a href="http://www.backcheckgoup.com/" target="_blank">www.backcheckgroup.com</a><br />
        </div>
        <div class="cnt-bgc-logo">
            <div class="sec-logo_style_design_rgt">
                <img src="img/sgs.png" alt="Risk Discovered" width="250" />
            </div>
            <div class="sec-logo_style_design_lf">
                <img src="img/NAPBS.png" alt="Risk Discovered" width="250" />
             </div>
        </div>
        <div style="clear:both;"></div>
        <div class="about-content">
            <b>Disclaimer</b>
            <p>This report sets out information obtained by Background Check Pvt Ltd (BCPL) from third-party sources as well as Background Check Pvt Ltd (BCPL) objective analysis of the same, and should in no way be construed as a recommendation as to what course of action the client should take, or a personal opinion of Background Check Pvt Ltd (BCPL) with respect to any of the corporate entities or individuals named in this report.  Background Check Pvt Ltd  (BCPL) takes all due care to ensure the accuracy of the information provided, but cannot guarantee with absolute finality the validity or accuracy of all sources of information.  All actions taken by the client subsequent to receiving our report shall be understood to be the result of its decision alone, and the client shall hold Background Check Pvt Ltd (BCPL) free and harmless from any and all liability to itself or to any other party as a result of said decision. All personal data supplied in this report is intended to be for the sole purpose of client’s evaluation and is not intended for public dissemination.</p><br />
            <p>Riskdiscovered.com is a secured technology platform to facilitate the verification process and to automate the workflow. Riskdiscovered.com is online verification workflow management system that is complied with international security and compliance standards such as 256-bit SSL encryption, SOC 2, PCI DDS and HIPPA.</p><br />
            <p>©<strong>Copyright 2007 - 2015 Background Check Pvt Ltd. All rights reserved.</strong> No part of this publication may be reproduced, photo copied, stored on a retrieval system, or transmitted without the express prior consent of Background Check Pvt Ltd.</p>
        </div>
        
    </div>
    	</div> 
    </div>
    
    
</div>
</div>

<div class="pg " style="border:none;">
			<div class="ipg" style="width:950px;margin:0;border:none;">
          
            <div class="map-main-header">
            <h2 class="h2-txt">BACKGROUND CHECK<span class="for-blue-text"> GROUP OF COMPANIES</span></h2>
            <div class="txt-container">
            <div class="left-cont">
            <div class="left-cont-txt-box">
                <strong>BACKGROUND CHECK SINGAPORE</strong><br />
                <span>30 Cecil Street, #19-08 Prudential Tower, <br />
                Singapore 049712<br />
                Phone: +65 3108 0343</span>
            </div>
            <div class="left-cont-txt-box">
                <strong>BACKGROUND CHECK CANADA</strong><br />
                <span>3380, Sunlight Street, Mississauga, Canada  <br />
               Postal Code L5M 0G9<br />
                Phone: +1 647 849 0983</span>
            </div>
            <div class="left-cont-txt-box">
                <strong>BACKGROUND CHECK ROMANIA</strong><br />
                <span>Povernei 20, 4th floor, Interphone 9, Bucharest, <br />
                District 1, 106444, Romania</span>
            </div>
            </div>
            <div class="right-cont">
            <div class="right-cont-txt-box">
                <strong>BACKGROUND CHECK PAKISTAN</strong><br />
                <span>
                    3rd Floor GSA House 19 Timber Pond, East<br /> Wharf, Keamari, Karachi 75620, Pakistan<br />
                    Phone: +21 111-92-92-92 <br />
                    +92-21-32863920 – 30 Fax: +92-21-3-2863931 
                </span>
            </div>
            <div class="right-cont-txt-box">
                <strong>BACKGROUND CHECK USA</strong><br />
                <span>
                    3901 Kimberly Drive, Flower Mound, <br /> TX, 75022 <br />
                    Toll Free: +1 888 983 0869<br />
                    Phone: +1 469 628 0432 
                </span>
            </div>
            <div class="right-cont-txt-box">
                <strong>BACKGROUND CHECK MALAYSIA</strong><br />
                <span>
                    Lot A020, Level 1, Podium Level, Financial Park, <br />
                     JalanMerdeka, 87000 Labuan F.T. Malaysia.
                </span>
            </div>
            </div>
            <div style="clear:both;"></div>
            <h2 class="h2-txt">GLOBAL REACH, <span class="for-blue-text">LOCAL INSIGHT</span></h2>
             <h3>NOW COVERING OVER <span class="for-blue-text">215 COUNTRIES</span> ACROSS THE WORLD</h3>
             
             <div class="support-cont"></div>
             
            <!--<h4 class="who-weare">WHO <span class="for-blue-text">WE ARE</span></h4>-->
            
            <div style="clear:both;"></div>
            </div>
            <!--<div class="blue-cont">
            <div class="blue-left-cont">
            <p>Background Check Group is a group of <b>technology driven</b> companies providing <b>Risk Mitigation, Compliance</b> and <b>Critical HR management</b> solutions to the clients in more than <b>200 countries</b>, covering from frontier to emerging markets.As the trusted partner <b>of hundreds of organizations worldwide</b>, we at Background Check Group provide to the point and <b>easy-to-understand</b> reports so you can <b>confidently make decisions</b> about prospective <b>employees, vendors and partners</b>. Not only does this <b>safeguard your brand</b>, but you also arrive at <b>dramatically better background insights</b> –<span class="orange-txt">INSIGHTS YOU CAN RELY ON</span>. It’s time to partner with Background Check Group</p>
            </div>
            <div class="blue-right-cont">
            <img src="img/logo12.png" alt="Risk Discovered" width="250" />
            </div>
            <div style="clear:both;"></div>
            </div>-->
			<div style="clear:both;"></div>
            </div>
            </div>
 </div>
 
 <div class="pg">
<div class="ipg">
 
 <div class="sec-main-header">
	<div class="sec-pdf-left-sec">
    		<img src="img/rdlogo_final.png" alt="Risk Discovered" />
    </div>
    <div class="sec-pdf-right-sec">
    	<div class="sec-logo_style_design_rgt_head">
            <img src="img/SOC_n.png" alt="AICPA SOC" width="115" />
        </div>
        <div class="sec-logo_style_design_lf_head">
            <img src="img/pci_n.png" alt="PCI DSS" width="113" />
         </div>
    </div>
    <div style="clear:both;"></div>
    <div class="sec-straigth-bar"></div>
</div>
<div class="mbd">
<!--<h1>RISK ASSESSMENT REPORT</h1>-->
<h1><?php $check = getCheck($asData['checks_id']);
		echo $check['checks_title'];?></h1>
<div class="tbl">
  <?php /*?><table class="table_OddEven" width="890" border="0"  cellpadding="0" cellspacing="0">
    <tr>
      <td>Name of Employee</td>
      <td class="txt-bold"><?php  echo $varData['v_name']; ?></td>
    </tr>
    
    <tr >
      <td>Employee ID</td>
      <td class="txt-bold"><?php echo $varData['emp_id']; ?></td>
    </tr>
  <?php if(isset($_REQUEST['certi'])){?>  
    <tr>
      <td>Tracking #</td>
      <td class="txt-bold"><?=bcplcode($varData['v_id'])?></td>
    </tr>
    <!--<tr>
      <td class="tda">&nbsp;</td>
      <td class="tdb">
      Verification can be tracked here <a href="https://riskdiscovered.com" title="Track Here">www.riskdiscovered.com</a>
      </td>
    </tr>-->
  <?php }?>
     <?php
		$comInfo = $db->select("company","name,id","id=$varData[com_id]");
		$comInfo = mysql_fetch_array($comInfo);
	   if($comInfo['id']==37){?>
    <tr>
      <td>Reference ID</td>
      <td class="txt-bold"><?=$varData['v_refid']?></td>
    </tr>
    <?php } ?>
    <tr>
      <td>Date of Report</td>
      <td class="txt-bold"><?php echo date("j-F-Y",time()); ?></td>
    </tr>
    <tr >
      <td>Level of Screening</td>
      <td class="txt-bold">
				<?php 
				if(mysql_num_rows($asDatas)==1){
					$asData = mysql_fetch_array($asDatas);
					$ascase = $asData['as_id']; 	
				}else $asData = mysql_fetch_array($asDatas);
				if($ascase!=0){
					$check = getCheck($asData['checks_id']);
					echo $check['checks_title'];
				}else{
					echo 'LEVEL 1';
				}
				?>      
      </td>
    </tr>
<!--    <tr >
      <td class="tda"><strong>Work Order #</strong></td>
      <td class="tdb">&nbsp;</td>
    </tr >-->
    
    <tr >
      <td>Client's Name</td>
      <td class="txt-bold"><?=$comInfo['name']?> </td>
    </tr>
    <tr >
      <td><span style="color:#F00;">Risk</span> Level</td>
      <td class="<?php
				if($ascase!=0) $vStatus = $asData['as_vstatus']; else $vStatus =$varData['v_rlevel']; 
				$vStatus = strtolower(trim($vStatus));
				$vSts = vs_Status($vStatus);
				echo $vSts;
				?>">
            <strong>
                        <?php echo $vSts; ?>
            </strong>
      </td>
    </tr>
  </table><?php */?>
  
  <div class="reportWrapper">
<h1>CRIMNAL INTELLIGENCE <span>CHECK</span></h1>
<div class="tableHeading">Salse Order #</div>
<div class="tableWrapper">

<table cellpadding="0" cellspacing="0">
<tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
	<td>NAME OF EMPLOYEE</td>
    <td><?php  echo $varData['v_name']; ?></td>
</tr>
<tr>
	<td>DATE OF INITIATION</td>
    <td><?php  echo date("j-F-Y",strtotime($varData['v_itdate'])); ?></td>
</tr>
<tr>
	<td>DATE OF REPORT</td>
    <td><?php echo date("j-F-Y",time()); ?></td>
</tr>
<tr>
	<td>TURNAROUND TIME</td>
    <td>4WD</td>
</tr>
<tr>
	<td>Work Order #</td>
    <td>&nbsp;</td>
</tr>
<tr>
	<td>EMPLOYEE ID</td>
    <td><?php echo $varData['emp_id']; ?></td>
</tr>
<tr>
	<td>Tracking #</td>
    <td><?=bcplcode($varData['v_id'])?></td>
</tr>
<tr>
	<td>CLIENT’S NAME</td>
    <td><?=$comInfo['name']?></td>
</tr>
<tr>
	<td>CHECK DETAILS</td>
    <td><div>CRIMINALITY, CREDIT AND LITIGATION CHECKS – FOCUSED COUNTRY PAKISTAN</div>
    		<ul class="subPoints">
            	<li>NATIONAL ID VERIFICATION</li>
                <li>PAKISTAN CRIMINALITY, TERRORISM & FRAUD SEARCH</li>
                <li>CIVIL AND CRIMINAL LITIGATION SEARCH</li>
                <li>NATIONAL ID VERIFICATION</li>
                <li>PAKISTAN CREDIT AND BANKRUPTCY SEARCH</li>
            </ul>
    </td>
</tr>
<tr>
	<td>OUTCOME</td>
    <td><p>POSITIVE MATCHES FOUND</p><p>PLEASE REFER TO ANNEXURES BELOW.</p></td>
    
</tr>
<tr>
	<td>&nbsp;</td>
    
    <td>&nbsp;</td>
</tr>

</table>


<div class="resultdiv">
<ul>
	
    	<?php
				if($ascase!=0) $vStatus = $asData['as_vstatus']; else $vStatus =$varData['v_rlevel']; 
				$vStatus = strtolower(trim($vStatus));
				$vSts = vs_Status($vStatus);
				//echo $vSts;
				$status_vSts = strtolower($vSts); 
				?>
            
      <?php if($status_vSts == 'red'){?>
    		<li><img src="/img/alert_icon.png" width="64" /></li><li><h3>HIGH RISK</h3>
    	<?php }elseif($status_vSts == 'green'){?><li><h3>NO RISK</h3>
		<?php }else {?> <strong><?php echo $vSts; ?></strong><?php }?>
    </li>
</ul></div>
</div>
<div style="clear:both;"></div>
<div class="resultBox">	PLEASE REFER TO ANNEXURE BELOW</div>
</div>
<div class="clear"></div>
</div>

<div style="min-height:350px;">
<?php
	$asDatas = $db->select("ver_checks vc INNER JOIN checks ck ON vc.checks_id=ck.checks_id","DISTINCT *","$asWhere ORDER BY checks_title");
	$numChkes = mysql_num_rows($asDatas);
	$fnos = 1;
	$cnts = 0;
 	while($asData = mysql_fetch_array($asDatas)){ ?>
    	<?php	//if($asData['checks_id']==39){ echo 'This check has different format';}else{?>
				<div class="headline">
                	<span style="margin-left:20px;">
                    	<?php if($ascase==0) echo "$fnos-"; echo $asData['checks_title'];?>
                    </span>
                 </div>
				<div class="tbl">
                    <table class="table_OddEven" width="890" border="0"  cellpadding="0" cellspacing="0">
                            <tr >
                             	<td class="tdc">
                                <strong>
									<?php 
                                        $data = getData($asData['as_id'],"dmain");
                                        if(mysql_num_rows($data)>0){
                                            $data = mysql_fetch_array($data);
                                            echo $data['d_value'];

                                        }else{
                                            $data = $db->select("fields_maping","fl_title","fl_key='dmain' AND checks_id=$asData[checks_id] AND t_id=-1");
                                            $data = mysql_fetch_array($data);
                                            echo $data['fl_title'];
                                        }
                                     ?>
                                </strong>
                                </td>
                              	<td class="tdd">
                                <p style="font-weight:bold; color:#030; font-size:18px;">
									<?php 
                                        $vStatus = strtolower(trim($asData['as_vstatus']));
                                        $vSts = vs_Status($vStatus);
                                    ?>
                                    <span class="<?php echo "f$vSts"; ?>"><?php echo $asData['as_vstatus']; ?></span>                                
                                </p>
								<?php  
                                        $nos=0;
                                        $proofs = getData($asData['as_id'],"file");
                                        $pNums = mysql_num_rows($proofs);
                                        if($pNums>0){ ?>                                
                                                <p>Please refer to 
                                                <a href="javascript:void(0);">
                                                    Annexure-[ 
                                                    <?php  while($proof = mysql_fetch_array($proofs)){
                                                                if($ascase==0){
                                                                    $tLbl = ($fnos).(($pNums>1)?froofLbl($nos):'');
                                                                }else $tLbl = ($fnos+$nos);
                                                                echo (($nos>0)?"-":"").$tLbl;
                                                                $FILES[$cnts]['proof'] = $proof['d_value'];
                                                                $FILES[$cnts]['title'] = $proof['d_stitle'];
                                                                $FILES[$cnts]['pno'] = $tLbl;
                                                                $nos=$nos+1;
                                                                $cnts = $cnts+1;
                                                            }
                                                    ?> ]                                
                                                </a> below.</p>
                                <?php   } ?>
                                </td>
                            </tr>
                    </table>            		
        			<div class="clear"></div>
                </div>
		<?php if($fnos==3) break;
		$fnos=$fnos+1;		
		//}
		?>	
<?php }//end while  ?>
</div>

<!--
	<div class="ctxt">
  <p><span style="font-size:16px; font-weight:bold; color:#F00;">To verify the content of this report, please call (021) 111-92-92-92 or </span></p>
  <p>
    <span style="font-size:16px; font-weight:bold;">Email your enquiry to <a href="#">info@riskdiscovered.com </a></span></p>
</div>
	<div class="ftxt">
  <p>RiskDiscovered™ is the brand name of BackgroundCheck Private Limited (formerly DataFlow Pakistan Pvt. Ltd), the largest and prestigious Primary Source Verification provider in Pakistan operating since 2007. For more information on our product and services, please refer to riskdiscovered.com/about/.   </p>
  <p> Disclaimer: This report only sets out information obtained from records searched by BackgroundCheck Private Limited. No opinion is provided in respect of the individuals who are the subject of the report. This report does not constitute recommendations as to what action should be taken in this matter. It is difficult to verify all aspects of the information obtained due to the nature of the enquires and the limitations of obtaining such information from private databases and public records. This whilst due care has been taken to ensure the accuracy of information contained in this report. All personal data supplied in this report is intended to be for the sole purpose of client's evaluation and is not intended for public dissemination.</p>
  <p> ©Copyright 2014 BackgroundCheck Private Limited. All rights reserved. No part of this publication may be reproduced, photo copied, stored on a retrieval system, or transmitted without the express prior consent of BackgroundCheck Private Limited. </p>
</div>-->
<!--<div class="sec-main-header">
	<div class="cnt-bgc-txt">
        <strong>BACKGROUND CHECK PVT LTD</strong><br />
        <span>	
            3rd Floor GSA House 19 Timber Pond,<br />
            East Wharf, Keamari, Karachi 75620,<br />
            Pakistan – 021 - 111929292
		</span>
        <a href="mailto:info@backcheckgroup.com">info@backcheckgroup.com</a><br />
        <a href="http://www.backcheckgoup.com/" target="_blank">www.backcheckgroup.com</a><br />
    </div>
    <div class="cnt-bgc-logo">
    	<div class="sec-logo_style_design_rgt">
            <img src="img/sgs.png" alt="Risk Discovered" width="250" />
        </div>
    	<div class="sec-logo_style_design_lf">
            <img src="img/NAPBS.png" alt="Risk Discovered" width="250" />
         </div>
    </div>
    <div style="clear:both;"></div>
    <div class="about-content">
    	<strong>Disclaimer</strong>
    	<p>This report sets out information obtained by Background Check Pvt Ltd (BCPL) from third-party sources as well as Background Check Pvt Ltd (BCPL) objective analysis of the same, and should in no way be construed as a recommendation as to what course of action the client should take, or a personal opinion of Background Check Pvt Ltd (BCPL) with respect to any of the corporate entities or individuals named in this report.  Background Check Pvt Ltd  (BCPL) takes all due care to ensure the accuracy of the information provided, but cannot guarantee with absolute finality the validity or accuracy of all sources of information.  All actions taken by the client subsequent to receiving our report shall be understood to be the result of its decision alone, and the client shall hold Background Check Pvt Ltd (BCPL) free and harmless from any and all liability to itself or to any other party as a result of said decision. All personal data supplied in this report is intended to be for the sole purpose of client’s evaluation and is not intended for public dissemination.</p><br />
        <p>Riskdiscovered.com is a secured technology platform to facilitate the verification process and to automate the workflow. Riskdiscovered.com is online verification workflow management system that is complied with international security and compliance standards such as 256-bit SSL encryption, SOC 2, PCI DDS and HIPPA.</p><br />
        <p>©<strong>Copyright 2007 - 2015 Background Check Pvt Ltd. All rights reserved.</strong> No part of this publication may be reproduced, photo copied, stored on a retrieval system, or transmitted without the express prior consent of Background Check Pvt Ltd.</p>
    </div>
    
</div>-->

</div>
</div>
</div>

