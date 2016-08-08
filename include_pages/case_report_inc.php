<?php $_REQUEST['certi']=1;?>
<div class="pg">
<div class="ipg">
<div class="logo"><img src="img/header_img.jpg"  alt="BackgroundCheck365" /></div>
<div class="mbd">
<h1>RISK ASSESSMENT REPORT</h1>
<div class="tbl">
  <table width="890" border="0"  cellpadding="0" cellspacing="0">
    <tr class="tra">
      <td class="tda"><strong>Name of Employee</strong></td>
      <td class="tdb"><?php  echo $varData['v_name']; ?></td>
    </tr>
    
    <tr >
      <td class="tda"><strong>Employee ID</strong></td>
      <td class="tdb"><?php echo $varData['emp_id']; ?></td>
    </tr>
  <?php if(isset($_REQUEST['certi'])){?>  
    <tr>
      <td class="tda"><strong>Tracking #</strong></td>
      <td class="tdb"><?=bcplcode($varData['v_id'])?></td>
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
    <tr class="tra">
      <td class="tda"><strong>Reference ID</strong></td>
      <td class="tdb"><?=$varData['v_refid']?></td>
    </tr>
    <?php } ?>
    <tr>
      <td class="tda"><strong>Date of Report</strong></td>
      <td class="tdb"><?php echo date("j-F-Y",time()); ?></td>
    </tr>
    <tr >
      <td class="tda"><strong>Level of Screening</strong></td>
      <td class="tdb">
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
      <td class="tda"><strong>Client's Name</strong></td>
      <td class="tdb"><?=$comInfo['name']?> </td>
    </tr>
    <tr >
      <td class="tdc"><strong><span style="color:#F00;">Risk</span><span style="color:#333;"> Level</span></strong></td>
      <td class="tdd <?php
				if($ascase!=0) $vStatus = $asData['as_vstatus']; else $vStatus =$varData['v_rlevel']; 
				$vStatus = strtolower(trim($vStatus));
				$vSts = vs_Status($vStatus);
				echo $vSts;
				?>">
            <strong>
                    <span style="font-size:17px; font-weight:bold;color:#FFF">
                        <?php echo $vSts; ?>
                    </span>
            </strong>
      </td>
    </tr>
  </table>
<div class="clear"></div>
</div>

<div style="min-height:540px;">
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
                    <table width="890" border="0"  cellpadding="0" cellspacing="0">
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

<div class="ctxt">
  <p><span style="font-size:16px; font-weight:bold; color:#F00;">To verify the content of this report, please call (021) 111-92-92-92 or </span></p>
  <p>
    <span style="font-size:16px; font-weight:bold;">Email your enquiry to <a href="#">info@riskdiscovered.com </a></span></p>
</div>

<div class="ftxt">
  <p>RiskDiscovered™ is the brand name of BackgroundCheck Private Limited (formerly DataFlow Pakistan Pvt. Ltd), the largest and prestigious Primary Source Verification provider in Pakistan operating since 2007. For more information on our product and services, please refer to riskdiscovered.com/about/.   </p>
  <p> Disclaimer: This report only sets out information obtained from records searched by BackgroundCheck Private Limited. No opinion is provided in respect of the individuals who are the subject of the report. This report does not constitute recommendations as to what action should be taken in this matter. It is difficult to verify all aspects of the information obtained due to the nature of the enquires and the limitations of obtaining such information from private databases and public records. This whilst due care has been taken to ensure the accuracy of information contained in this report. All personal data supplied in this report is intended to be for the sole purpose of client's evaluation and is not intended for public dissemination.</p>
  <p> ©Copyright 2014 BackgroundCheck Private Limited. All rights reserved. No part of this publication may be reproduced, photo copied, stored on a retrieval system, or transmitted without the express prior consent of BackgroundCheck Private Limited. </p>
</div>


</div>

<div class="footer">
<div class="fta">Copyright 2014 BackgroundCheck Private Limited (formerly DataFlow Pakistan Pvt. Ltd) – All Rights Reserved</div>
<div class="ftb"><a href="http://www.riskdiscovered.com" >www.riskdiscovered.com</a></div>
</div>

</div>
</div>

<?php if($numChkes>3){ $fnos=$fnos+1;?>
	<div class="pg">
		<div class="ipg">
<?php 		while($asData = mysql_fetch_array($asDatas)){ ?>
				<div class="headline">
                	<span style="margin-left:20px;">
                    	<?php if($ascase==0) echo "$fnos-"; echo $asData['checks_title'];?>
                    </span>
                 </div>
				<div class="tbl">
                    <table width="890" border="0"  cellpadding="0" cellspacing="0">
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
                                <a href="#">
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
                                <?php } ?>
                                </td>
                            </tr>
                    </table>            		
        			<div class="clear"></div>
                </div>
<?php  			$fnos=$fnos+1;
			} ?>
		</div>
	</div>			
<?php } ?>

<?php

$asDatas = $db->select("ver_checks vc INNER JOIN checks ck ON vc.checks_id=ck.checks_id","DISTINCT *","$asWhere ORDER BY checks_title");
$fnos = 1;
while($asData = mysql_fetch_array($asDatas)){?>
    <div class="pg">
        <div class="ipg">
              <div class="headline">
                <span style="margin-left:20px;">
                <?php 
                    if($ascase==0) echo "$fnos-";
                    echo $asData['checks_title']; 
                ?>
                </span>
             </div>       
				<div class="tbl">
				<table width="890" border="0"  cellpadding="0" cellspacing="0">
				<?php 
                        $vStatus = strtolower(trim($asData['as_vstatus']));
                        $vSts = vs_Status($vStatus);
                 ?>
            <tr>
                <td class="tda">Verification Status:</td>
                <td class="tdb <?="f$vSts"?>">
                    <?=$asData['as_vstatus']?>
                 </td>
            </tr>
            <tr>
                <td class="tda">Manager Remarks:</td>
                <td class="tdb"><?=$asData['as_remarks']?></td>
            </tr>
        <?php
            $pCheck = getcheckP($asData[checks_id]);
            $titles = $db->select("titles","t_id,t_title,t_show","checks_id=$pCheck AND is_dsp=1 ORDER BY t_pos");
            if(mysql_num_rows($titles)>0){
                while($title = mysql_fetch_array($titles)){
                    $fDatas = $db->select("fields_maping","fl_title,fl_key,fl_algn,is_multy","checks_id=$pCheck AND t_id=$title[t_id] AND fl_type='s' AND fl_show=1 ORDER BY fl_ord");
                    if($title['t_show']==1){ ?>
                    <tr class="shead">
                        <th colspan="2">
                            <?php  echo $title['t_title']; ?>
                        </th>
                    </tr> 
        <?php			} 
                while($fData = mysql_fetch_array($fDatas)){ 
                    $datas = getData($asData['as_id'],$fData['fl_key']);
                    if($fData['fl_key']=='multy'){?>
                    <tr>
                        <td colspan="2" style="margin:0;padding:0">
                            <table cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr  class="shead">
                                        <th>Information Title</th>
                                        <th>Information Provided</th>
                                        <th>Information Verified</th>
                                    </tr>
                                </thead>
                                <tbody>
                				<?php while($data = mysql_fetch_array($datas)){ ?>                        
                                <tr>
                                    <td class="tda"><?=$data['d_mtitle'];?>:</td>
                                    <td class="tdy"><?=$data['d_stitle'];?></td>
                                    <td class="tdz"><?=$data['d_value'];?></td>
                                </tr>
                				<?php  } ?>     
                			</tbody>                    
                            </table>
                        </td>
                    </tr>
              <?php }else if($fData['fl_key']!='file'){ ?>
                        <tr>	
                            <td class="tda">
                                <?=$fData['fl_title']?>:
                            </td>
                            <td class="tdb">
                            <ul class="<?=($fData['is_multy']==1)?'mt':'nt'?>" >
                        <?php	
                            if(mysql_num_rows($datas)>0){
                                while($data = mysql_fetch_array($datas)){ ?>
                                   <li>
                                    <?php if($fData['fl_key']=='followup'){?>
                                    [ <?=date("j-F-Y",strtotime($data['data_date']))?> ] 
                                    <?php }?>
                                    <?=change_url_in_text(trim($data['d_value']))?>
                                   </li>  
                         <?php 	}
                             }else echo '<li class="nt">---</li>';
                              ?>
                            </ul>
                            </td>
                        </tr>	
        <?php }}}
            }
        ?>
        </table>
        		</div>
			<?php 
			if($asData['checks_sveri']==1){
                $analystInf = $db->select("users","*","user_id=$asData[user_id]");
                $analystInf = mysql_fetch_array($analystInf); ?>
				<div class="headline">
                	<span style="margin-left:20px;">Verifier Information</span>
             	</div>            
				<div class="tbl">
				<table width="890" border="0"  cellpadding="0" cellspacing="0">            
                    <tr>
                        <td class="tda">Name:</td>
                        <td class="tdb"><?=trim($analystInf['first_name']." ".$analystInf['middle_name']." ".$analystInf['last_name']);?></td>
                    </tr>  
                    <tr>
                        <td class="tda">Email:</td>
                        <td class="tdb"><a href="mailto:<?=$analystInf['email']?>"><?=$analystInf['email']?></a></td>
                    </tr>   
                    <tr>
                        <td class="tdc">Contact #</td>
                        <td class="tdd"><?=$analystInf['fone_no']?></td>
                    </tr>
            </table>
            	</div>
      <?php } ?>
<div class="sdisclaimer">
 <?php 
	  if($asData['checks_scomt']==1 && isset($_REQUEST['t'])){?>
		<div class="ftxt" style="margin-bottom:15px;"><?=$asData['checks_commt']?></div> 
        <p>&nbsp;</p>    
<?php } 
	    
	  if($asData['checks_sdisc']==1 && isset($_REQUEST['t'])){?>
		<div class="ftxt"><strong>Disclaimer: </strong> <?=$asData['checks_discl']?></div>     
<?php } ?>
</div>
        </div>
    </div>
<?php 
$fnos=$fnos + 1;
} ?>

<?php if(isset($FILES)){  
		foreach($FILES as $no=>$FILE){?>
		<div class="pg">
			<div class="ipg">
                    <div class="headline" style="margin-bottom:0">
                        <span style="margin-left:20px;">Annexure-<?=$FILE['pno']?></span>
                    </div>
                    <div style="text-align:center;margin-bottom:10px;padding:5px;" class="shead">
						<?=$FILE['title']?>
                    </div>                           
					<div class="main" align="center">
						<img style="width:700px;" src="<?php echo $FILE['proof'];  ?>"  />
					</div>
			</div>
	   	</div>                    
<?php }
	} ?>

<?php if(isset($_REQUEST['certi']) && $vSts=='Green' && $varData['v_sent']==4){?>
		<div class="clear"></div>
 		<style type="text/css">
	.page{ 
		
		min-height:950px; 
		
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
	
	.rotate{
    -ms-transform: rotate(270deg); /* IE 9 */
    -webkit-transform: rotate(270deg); /* Chrome, Safari, Opera */
    transform: rotate(270deg);
	margin-top:190px;
} 

</style>
        <div class="pg " style="border:none;">
			<div class="ipg" style="width:950px;margin:0;border:none;">
            	<div class="clear"></div>
                <div class="rotate">
            	<?php 
				$_REQUEST['id'] = $varData['v_id'];
				include("include_pages/certificate_inc.php")?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
<?php }?>