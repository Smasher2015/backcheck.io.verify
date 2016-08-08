<?php /*?><div class="pg">

<div class="ipg">





<!--<div class="footer">

<div class="fta">Copyright 2014 BackgroundCheck Private Limited (formerly DataFlow Pakistan Pvt. Ltd) – All Rights Reserved</div>

<div class="ftb"><a href="http://www.riskdiscovered.com" >www.riskdiscovered.com</a></div>

</div>-->

	<div class="report-cover-section">

    	<div class="report-basic-info global-bg">

        	<div class="rp-head-cont">

        <?php $asDatas = $db->select("ver_checks vc INNER JOIN checks ck ON vc.checks_id=ck.checks_id","DISTINCT *","$asWhere ORDER BY checks_title");

				$asData = mysql_fetch_array($asDatas);?>

        		<h2><?php  

				if($rp_cic==1){

					echo 'CRIMINAL INTELLIGENCE CHECK ';

					}else{

					echo $asData['checks_title'];

				}?></h2>

            <span class="light-dark-color"> 

            <?php

				

				echo $asData['as_vstatus'] . ' | ';?>

    		</span><span class="light-dark-color"><?php   echo $varData['v_name']; ?></span><br />

            <span class="dark-blue-color"><?php echo  date("l, M d, Y"); ?></span>

            </div>

			<?php //if($asData['as_vstatus']=='Verified'){ ?>

            	<div class="right-check-logo"></div>

            <?php //}?>



        </div>

        <!--<div class="global-bg"></div>-->

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

            <i>Disclaimer</i>

            <p>This report sets out information obtained by Background Check Pvt Ltd (BCPL) from third-party sources as well as Background Check Pvt Ltd (BCPL) objective analysis of the same, and should in no way be construed as a recommendation as to what course of action the client should take, or a personal opinion of Background Check Pvt Ltd (BCPL) with respect to any of the corporate entities or individuals named in this report.  Background Check Pvt Ltd  (BCPL) takes all due care to ensure the accuracy of the information provided, but cannot guarantee with absolute finality the validity or accuracy of all sources of information.  All actions taken by the client subsequent to receiving our report shall be understood to be the result of its decision alone, and the client shall hold Background Check Pvt Ltd (BCPL) free and harmless from any and all liability to itself or to any other party as a result of said decision. All personal data supplied in this report is intended to be for the sole purpose of client’s evaluation and is not intended for public dissemination.</p><br />

            <p>Riskdiscovered.com is a secured technology platform to facilitate the verification process and to automate the workflow. Riskdiscovered.com is online verification workflow management system that is complied with international security and compliance standards such as 256-bit SSL encryption, SOC 2, PCI DDS and HIPPA.</p><br />

            <p>©<strong>Copyright 2007 - 2015 Background Check Pvt Ltd. All rights reserved.</strong> No part of this publication may be reproduced, photo copied, stored on a retrieval system, or transmitted without the express prior consent of Background Check Pvt Ltd.</p>

        </div>

        

    </div>

    	</div> 

    </div>

    

</div>

</div>
<?php */?>
<!--nnnnne--->

<?php /*?><div class="pg " style="border:none;">

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

           

			<div style="clear:both;"></div>

            </div>

            </div>

 </div><?php */?>

 <!--coment nnn-->
 
 <div class="pg " style="border:none;">

			<div class="ipg" style="width:950px;margin:0;border:none;">
            
            <div class="bg">
    	<div class="sec_header">
        	<div class="logo_main">
            	<img src="img/logo2_pdf.png" alt="logo">
            </div>

        </div>
        
        <div class="firstpag_left">
       
        	
        	
        	
            <div class="appli_name">
			 <?php $asDatas = $db->select("ver_checks vc INNER JOIN checks ck ON vc.checks_id=ck.checks_id","DISTINCT *","$asWhere ORDER BY checks_title");

				$asData = mysql_fetch_array($asDatas);?>

        		<h1><?php  
				if($rp_cic==1){

					echo 'CRIMINAL INTELLIGENCE CHECK ';

					}else{
			       if(is_numeric($_REQUEST['id']) && $_REQUEST['id']>0){
					echo $asData['checks_title'];
				   }else{echo "Full Case Report";}

				}?></h1>
			
			<h3><?php  echo $varData['v_name']; ?></h3></div>
<!--            <h5>Countries Researched for Directorship Profiles: </h5>
            <ul>
                <li>FINLAND</li>
                <li>SWEDEN</li>
            </ul>
            
            
-->          

		  	<div class="report-down">
                <h4>Report Downloaded</h4>
                <p>Date: <span><?php echo  date("l, M d, Y"); ?></span></p>
                <!--<p>RESEARCH COMPLETED: <span>31/10/2015</span></p>-->
			</div>
            
            
        </div>
    		
            <div class="disclaimer">
            	<h5>Disclaimer</h5>
                    <p>This report sets out information obtained by Background Check Pte Ltd (BCP) from third-party sources as well as BCP objective analysis of the same, and should in no way be construed as a recommendation as to what course of action the client should take, or a personal opinion of BCP with respect to any of the corporate entities or individuals named in this report</p>

                    <p>BCP takes all due care to ensure the accuracy of the information provided, but cannot guarantee with absolute finality the validity or accuracy of all sources of information.</p>

                    <p>All actions taken by the client subsequent to receiving our report shall be understood to be the result of its decision alone, and the client shall hold BCP free and harmless from any and all liability to itself or to any other party as a result of said decision. All personal data supplied in this report is intended to be for the sole purpose of client's evaluation and is not intended for public dissemination.</p>

                    <p>Copyright 2007 - 2015 Background Check Pte Ltd. All rights reserved. No part of this publication may be reproduced, photo copied, stored on a retrieval system, or transmitted without the express prior consent of Background Check Pte Ltd.</p>
                
            
            </div>
            
            
            
    	</div>
            
            
            </div>
            
            </div>

 <div class="pg">

<div class="ipg">

 		

 <?php /*?><div class="sec-main-header">

	<div class="sec-pdf-left-sec">

    		<img src="img/logoreport.png" alt="Risk Discovered" />

    </div>

    <div class="sec-pdf-right-sec">
<?php 
// if loccation not pakistan
if($com_location!=171){?>
    	<h1>BACKGROUND CHECK PTE LTD (HEAD OFFICE)</h1>
        <p>30 CECIL STREET, #19-08 PRUDENTIAL TOWER,<br />
SINGAPORE 049712<br />  +65 31080343 | F: +65 67228310 <br />
 www.backcheckgroup.com<br />
<a href="mailto:info@backcheckgroup.com">info@backcheckgroup.com</a>
</p>
<?php }else{ ?>
	<h1>BACKGROUND CHECK PVT LTD (OPERATIONS HUB)</h1>
			<p>3RD FLOOR GSA HOUSE 19 TIMBER POND,<br />
	EAST WHARF, KARACHI, PAKISTAN<br />  021-111-92-92-92 | +92-21-32863920 – 30 <br />
	 FAX: +92-21-3286-3931<br />
	<a href="mailto:info@backcheckgroup.com">info@backcheckgroup.com</a>
	</p>

<?php } ?>










    </div>

    <div style="clear:both;"></div>

    </div><?php */?>
    
    <div class="sec-main-header">

	<div class="sec-pdf-left-sec">
    	<img src="img/logo3.png" alt="BackcheckGroup" />
        <div class="logo_in">
        <?php 
// if loccation not pakistan
if($com_location!=171){?>
    	<strong>Background Check Pte Ltd (HEAD OFFICE)</strong><br>
        30 Cecil Street, #19-08 Prudential Tower, Singapore 049712<br />
        Phone: +65 3108 0343 | Fax: +65 6722 8310
</p>
<?php }else{ ?>
	<strong>Background Check Pvt Ltd (OPERATIONS HUB)</strong>
    3rd Floor GSA House 19 Timber Pond, East WHARF, Karachi, Pakistan<br />  021-111-92-92-92 | +92-21-32863920 - 30 <br />
    FAX: +92-21-3286-3931

<?php } ?>
      </div>
        
    </div>

    <div class="sec-pdf-right-sec">
<?php 
// if loccation not pakistan
if($com_location!=171){?>
    	<strong>Customer Care</strong><br>
support@backcheckgroup.com<br>
Toll Free +1 888 983 0869<br>
<span class="text-red">CONFIDENTIAL</span>

<?php }else{ ?>
	<strong>Customer Care</strong><br>
support@backcheckgroup.com<br>
Toll Free +1 888 983 0869<br>
<span class="text-red">CONFIDENTIAL</span>
	

<?php } ?>










    </div>

    <div style="clear:both;"></div>

    </div>
    
    
<?php $asDatas = $db->select("ver_checks vc INNER JOIN checks ck ON vc.checks_id=ck.checks_id","DISTINCT *","$asWhere ORDER BY checks_title");

                            $asData = mysql_fetch_array($asDatas);?>
<?php /*?><div class="report-basic-info" >

        	<div class="rp-head-cont-second">

            <div style="width:40%; height:auto; float:left; padding-left: 15px;">

					

                <span class="<?php echo ($asData['as_vstatus']=='Verified') ? 'verified-color' : 'light-dark-color';  ?>"> 

                <?php echo $asData['as_vstatus'] . ' | ';?>

                </span><span class="light-dark-color"><?php   echo $varData['v_name']; ?></span>

            </div>

            <div style="width:40%; height:auto; float:right; text-align:right; padding-right: 15px;">

            	<span class="dark-blue-color" ><?php echo  date("l, M d, Y"); ?></span>

            </div>

             <div style="clear:both;"></div>

            </div>



        </div><?php */?>

<div class="mbd">

<!--<h1>RISK ASSESSMENT REPORT</h1>-->

<?php /*?><h1><?php $check = getCheck($asData['checks_id']);

		echo $check['checks_title'];?></h1><?php */?>

        

<div class="tbl">

  
<h1><?php  echo $varData['v_name']; ?> <span><?=bcplcode($varData['v_id'])?></span></h1>
  

  <div class="reportWrapper">

<?php /*?><h1>

<?php //$check = getCheck($asData['checks_id']);

		//if($rp_cic==1){?>

			CRIMNAL INTELLIGENCE <span>CHECK</span>

		<?php //}else{

		//	echo $check['checks_title'];

		//}?>

</h1><?php */?>
<h3>Report Summary</h3>
<!--<div class="tableHeading">Salse Order #</div>-->

<div class="tableWrapper">



<table cellpadding="0" cellspacing="0">

<tr>

	<td>Tracking #</td>

    <td class="font-bold"><?=bcplcode($varData['v_id'])?></td>

</tr>

<tr>

	<td>NAME OF EMPLOYEE</td>

    <td class="font-bold"><?php  echo $varData['v_name']; ?></td>

</tr>

<tr>

	<td>DATE OF INITIATION</td>

    <td class="font-bold"><?php  echo date("j-F-Y",strtotime($varData['v_itdate'])); ?></td>

</tr>

<tr>

	<td>DATE OF REPORT</td>

    <td class="font-bold"><?php echo date("j-F-Y",time()); ?></td>

</tr>

<tr>

	<td>TURNAROUND TIME</td>
	<?php if($varData['v_status']=='Close'){
	$days = getDaysFromDates($varData['v_cldate'],$varData['v_date'],$varData['com_id']);	
	}else if(is_numeric($_REQUEST['id']) && $_REQUEST['id']>0){
	$days = getDaysFromDates($asData['as_cldate'],$asData['as_addate'],$varData['com_id']);	
	}?>
    <td class="font-bold"><?php echo ($days>0)?$days.'WD':'4WD';?></td>

</tr>

<tr>

	<td>Work Order #</td>

    <td class="font-bold"><?php  echo $varData['v_bcode']; ?></td>

</tr>

<tr>

	<td>EMPLOYEE ID</td>

    <td class="font-bold"><?php echo $varData['emp_id']; ?></td>

</tr>



<tr>

	<td>CLIENT'S NAME</td>

    <td class="font-bold"><?php 

		$comInfo = $db->select("company","name,id","id=$varData[com_id]");

		$comInfo = mysql_fetch_array($comInfo);

	echo $comInfo['name'];

	?>

    </td>

</tr>

<tr>

	<td>CHECK DETAILS</td> <td class="font-bold">
<?php if($asData['checks_id']=='38' || $asData['checks_id']=='39' || $asData['checks_id']=='40' || $asData['checks_id']=='41'){ ?>
   <div>CRIMINALITY, CREDIT AND LITIGATION CHECKS – FOCUSED COUNTRY PAKISTAN</div>
<?php } ?>
    		<ul class="subPoints">

			<?php 

			$asChecks = $db->select("ver_checks vc INNER JOIN checks ck ON vc.checks_id=ck.checks_id","DISTINCT *","$asWhere ORDER BY checks_title");
			$c = array(); 
			$count_checks = 0;
			while($asCheck = mysql_fetch_array($asChecks)){ ?>
		
						<li><?php  echo $asCheck['checks_title'];?></li>
		
			<?php 
			$count_checks++;		
			} 
			 $count_checks;
			?>

               

            </ul>

    </td>

</tr>

<tr>

	<td>OUTCOME</td>

    <td class="font-bold"><p><?php echo $asData['as_vstatus'];?></p></td>

    

</tr>

<tr>

	<td>&nbsp;</td>

    

    <td>&nbsp;</td>

</tr>



</table>





<div class="resultdiv">

<ul>

	

    	<?php

				if($ascase!=0){ $vStatus = $asData['as_vstatus'];  $v_id=0;} else { $vStatus =$varData['v_rlevel']; $v_id=$varData['v_id']; }

				$vStatus = strtolower(trim($vStatus));

				$vSts = vs_Status($vStatus,$v_id);

				//echo $vSts;

				$status_vSts = strtolower($vSts); 

				?>

            

      <?php if($status_vSts!=''){ 
	  
	  if($status_vSts == 'red'){?>

    		<li style="background-color:#fc0000; color:#fff;"><h3>HIGH RISK</h3></li>

    	<?php }elseif($status_vSts == 'green'){?><li style="background-color:#92c83e; color:#000;"><h3>NO RISK</h3></li>
		<?php }elseif($status_vSts == 'amber' || $status_vSts == 'yellow'){?><li style="background-color:#ff9900; color:#fff;"><h3>POTENTIAL RISK</h3></li>
		<?php }else {?><li style="background-color:none; color:#000;"><h3>POTENTIAL RISK</h3></li><?php } 
		
		}?>

    

</ul></div>

<div style="clear:both;"></div>
<div class="resultBox">	PLEASE REFER TO ANNEXURE BELOW</div>

<div class="clear"></div>

    <div class="diclaimer-first-cont">

		<p>Disclaimer: This service does not constitute legal or other professional advice. Every reasonable care has been taken to ensure that the information gathered from the relevant authorities databases and sources are accurate and up-to-date, however, we cannot accept responsibility for any consequences whatsoever arising out of reliance upon or usage of such public information as aforesaid.</p>    
<div style="clear:both;"></div>


    </div>


</div> <!--tablewrapper--->





</div>






</div>




</div>


<div class="sec-main-footer1">

        

        <div class="cnt-bgc-logo">

          <!--  <div class="sec-logo_style_design_rgt">

                <img src="img/footernbp_1.png" alt="Risk Discovered" width="184" />

            </div>

            <div class="sec-logo_style_design_lf">

                <img src="img/footernbp_2.png" alt="Risk Discovered" width="162" />

             </div>-->


			 <div style="clear:both;"></div>
		<div class="pdf-left-sec-ft">
    	<ul>
            <li><strong>Singapore</strong></li>
            <li>Canada</li>
            <li>Malaysia</li>
            <li>Pakistan</li>
            <li>Romania</li>
            <li>USA</li>
        </ul>
    </div>
        </div>
        
        
        <div class="cnt-bgc-txt">

           <!-- <strong>BACKGROUND CHECK PTE LTD (HEAD OFFICE)</strong><br />

            <span>	

                30 CECIL STREET, #19-08 PRUDENTIAL TOWER,<br /> SINGAPORE 049712<br />
T: +65 31080343  |  F: +65 67228310<br />


            </span>

            <a href="www.backcheckgroup.com">www.backcheckgroup.com</a>-->

				<div class="cnt-bgc-txt-bt">© BACKGROUND CHECK GROUP - ALL RIGHTS RESERVED</div>


        </div>

        <div style="clear:both;"></div>
        

    </div>


</div>



</div>
<?php if($count_checks > 1){ ?>
<div class="pg">

<div class="ipg">

<div style="min-height:350px;">

<h1 class="for-large-heading">Report Summary</h1>

<?php

	$asDatas = $db->select("ver_checks vc INNER JOIN checks ck ON vc.checks_id=ck.checks_id","DISTINCT *","$asWhere ORDER BY checks_title");

	$numChkes = mysql_num_rows($asDatas);

	

	$fnos = 1;

	$cnts = 0;

 	while($asData = mysql_fetch_array($asDatas)){ ?>

    	<?php	//if($asData['checks_id']==39){ echo 'This check has different format';}else{?>

				<?php /*?><div class="headline">

                	<span style="margin-left:20px;">

                    	<?php if($ascase==0) echo "$fnos-"; echo $asData['checks_title'];?>

                    </span>

                 </div><?php */?>

				<div class="tbl">

                <div class="reportWrapper">
				
                	<h3><?php if($ascase==0) echo "$fnos-"; echo $asData['checks_title'];?></h3>                
                
				<div class="tableWrapper">


                    <table width="890" border="0"  cellpadding="0" cellspacing="0">

                            <tr>

                             	<td>

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

                              	<td>

                                <p style="font-weight:bold; color:#030; font-size:18px;">

									<?php 

                                        $vStatus = strtolower(trim($asData['as_vstatus']));

                                        $vSts = vs_Status($vStatus);

                                    ?>

                                    <span class="<?php echo "f$vSts"; ?>" style="color: #595959;"><?php echo $asData['as_vstatus']; ?></span>                                

                                </p>

								<?php  

                                        $nos=0;

										$counter=-1;

                                        for($i=-1; $i<12; $i++){

											

														if($i==0){

													  $proofs = getData($asData['as_id'],"file");	

														$abc="";

														}else{

															$counter=$i;

													  $proofs = getData($asData['as_id'],"file$i");	

													  if($asData['checks_id']==39){

														$abc="-A"; 

														

													  }

													  if($asData['checks_id']==41){

														$abc="-B";

																										

													  }

													  

													 

														}

                                        $pNums = mysql_num_rows($proofs);

                                        if($pNums>0){ ?>                                

                                                <p>Please refer to  

                                                <a href="javascript:void(0);">

                                                    Annexure-[ 

                                                    <?php  while($proof = mysql_fetch_array($proofs)){

														

                                                                if($ascase==0){

                                                                    $tLbl = ($fnos).(($pNums>1)?froofLbl($nos):'');

																	 if($asData['checks_id']==39 || $asData['checks_id']==41){

																	 $tLbl= $counter;

																 }

                                                                }else $tLbl = ($fnos+$nos);

																 if($asData['checks_id']==39 || $asData['checks_id']==41){

																	 $tLbl= $counter;

																 }

                                                                echo (($nos>0)?"-":"").$tLbl.$abc;

                                                                $FILES[$cnts]['proof'] = $proof['d_value'];

                                                                $FILES[$cnts]['title'] = $proof['d_stitle'];

                                                                $FILES[$cnts]['pno'] = $tLbl.$abc;

                                                                $nos=$nos+1;

                                                                $cnts = $cnts+1;

                                                            }

                                                    ?> ]                                

                                                </a> below.</p>

                                <?php   }

								} ?>

                                </td>

                            </tr>

                    </table>    

                  </div>

                  </div>        		

        			<div class="clear"></div>

                </div>

		<?php //if($fnos==3) break;

		$fnos=$fnos+1;		

		//}

		?>	

<?php }//end while  ?>

</div>







</div>

</div>
<?php }?>


