<?php
 $get_client_ip = get_client_ip(); 
//echo $_SERVER['HTTP_CLIENT_IP'].' HTTP_CLIENT_IP';
$uID = $_SESSION['user_id'];
//print_r($COMINF);
 $com_id = $COMINF['id'];
//$com_id = 96;
$where = "com_id='".$com_id."' ";
					//$Q = $db->select("clients_checks","*",$where);
//$is_checks = mysql_num_rows($Q);
//$data = mysql_fetch_assoc($Q);
$Q = getInfo('company',"id=$com_id");
 //print_r($Q); 
$agreement_confg = $db->select("client_agreement_confg","*","comps_id='".$com_id."' and is_expired='0'");
 $data2 = mysql_fetch_assoc($agreement_confg);

  $ts1 = strtotime(date("Y-m-d h:i:s"));
 $ts2 = strtotime($data2['send_date']);

 $seconds_diff = $ts1 - $ts2;

 $days = floor($seconds_diff/3600/24);
 
 if($days > 10)
 {
	$poc_id = $data2['agr_poc2'];
	
	if($data2['agr_poc2_sent'] == 0)
	{
		$db->update("agr_poc2_sent='1',agr_receiver='$poc_id'","client_agreement_confg","comps_id='$com_id' and is_expired='0'");
		
	$user_info = getUserInfo($data2['agr_poc']);
	$email = $user_info['email'];
 	
	$comInfo = getcompany($com_id);
	$comInfo = @mysql_fetch_array($comInfo);
 		
	$user_info2 = getUserInfo($data2['agr_poc2']);
	$email2 = $user_info2['email'];

  			  		$table = '<table>
		 			<thead>
		 			<tr>
						<th>&nbsp;</th>
 					</tr>
					</thead>
					<tbody>
					 
					<tr>
						Welcome!
 					</tr> 
					<tr>
						'.$comInfo['name'].',
 					</tr> 
					<tr>
					We sent agreement information to ('.$email.') but did not get any response yet, please view the agreement for approval.
					
						I want to thank you for requesting my services, The background screening services - I hope you’re closer to breaking into risk free environment after accepting the agreement sent via this email.<br>
Receive your copy of agreement by clicking below link.<br>
<a href="'.SURL.'?action=agreement&atype=approval">Click Here</a><br>
The above link will take you to the page with The background check group agreement view.

 					</tr> 
 					</tbody>
				</table>';
				$fulname = $user_info2['first_name']." ".$user_info2['last_name'];
		  emailTmp($table,'Agreement Information',$email2,"","","","","$fulname","");

	}
	else
	{
		
	}
	
	}
 else{
	$poc_id = $data2['agr_poc'];
	}
?>
 
		<link rel="stylesheet" type="text/css" href="<?php echo SURL; ?>flipper/new/jquery.jscrollpane.custom.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo SURL; ?>flipper/new/bookblock.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo SURL; ?>flipper/new/custom.css" />
	       <?php
	   if($_SESSION['user_id'] == $poc_id)
	   {
	   
       if($data2['is_suspend_active'] != 1)
	   {
		   
	   ?>
		<?php
				 
		
        if($data2['agr_status'] == 1 && $data2['is_send'] == 1)
		{
			$image_path = "pend.jpg";
		}
        else if($data2['agr_status'] == 2 && $data2['is_send'] == 1)
		{
			$image_path = "approv.jpg";
		}
        else if($data2['agr_status'] == 3 && $data2['is_send'] == 1)
		{
			$image_path = "rej.jpg";
		}
		else{$image_path = '';}
		
		if($image_path != '')
		{
		?>	 
        <?php /*?> <div class="agreement_stamp">
         <img src="images/<?=$image_path?>" width="100" height="60" />
         </div><?php */?>
         <?php
		}
		 ?>
         <div class="content">
         <!-- Button trigger modal -->
 


<style>
/* CSS used here will be applied after bootstrap.css */
.modal-content {
  height:250px;
  overflow:auto;
}</style>
         </div>
         
         
         <div class="content">
         <table width="100%">
         	<thead>
            <tr>
            <th>Versions</th>
            <th>Sent Date</th>
            <th>Approve/ Reject Date</th>
            <th>Status</th>
            <th>Active/ Expired</th>
            </tr>
            </thead>
            <tbody>
            <?php
			$ver = 1;
            $agreement_confg_all = $db->select("client_agreement_confg","*","comps_id='".$com_id."' ");
			while($alldata = mysql_fetch_assoc($agreement_confg_all))
			{
			if($alldata['agr_status'] == 1 && $alldata['is_send'] == 1)
			{	
			$status = 'Pending'; 
			}
			else if($alldata['agr_status'] == 2 && $alldata['is_send'] == 1)
			{	
			$status = 'Approved'; 
			}
			else if($alldata['agr_status'] == 3 && $alldata['is_send'] == 1)
			{	
			$status = 'Rejected'; 
			}
			else if($alldata['agr_status'] == 0 && $alldata['is_send'] == 0)
			{	
			$status = 'Nothing'; 
			}
			
			
			if($alldata['is_expired'] == 1)
			{	
			$act_exp = 'Expired'; 
			}
			else
			{	
			$act_exp = 'Active'; 
			}
			?>
            <tr>
            	<td>Version <?=$ver?></td>
                <td><?=date("d F, Y",strtotime($alldata['send_date']))?></td>
                <td><?php if($alldata['app_rej_date'] != '' && $alldata['app_rej_date'] != '0000-00-00 00:00:00'){echo date("d F, Y",strtotime($alldata['app_rej_date']));}else{echo '-';}?></td>
                <td><?=$status?></td>
                <td><?=$act_exp?></td>
                <td><a href="javascript:void(0)"  data-toggle="modal" data-target="#version_<?=$alldata['agrID']?>">View Detail</a> </td>
 			</tr>
            
            
            
            <!-- Modal -->
<div class="modal fade" id="version_<?=$alldata['agrID']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Version <?=$ver?></h4>
      </div>
      <div class="modal-body">
        <div class="scroller">
        <h2>Acceptence Detail</h2>
        <p>Signed: <?=$data2['sender_ip']?> ON Background Check Pte Ltd, Date: <?=date("l jS \of F, Y",strtotime($data2['send_date']))?> </p>
         <p>Name: Khalid Siddiqui, Title: CEO    Email:   kks@backcheckgroup.com</p>
        <p>For and on behalf of Background Check Pte Ltd</p>
        <p>Signed: <?=$data2['client_ip']?> ON <?=$comInfo['name']?>, Date:  <?php if($data2['app_rej_date'] != ''){echo date("l jS \of F, Y",strtotime($data2['app_rej_date']));}else {echo '-';}?> </p>
        <p>Name: Authorize Person, Title: CEO    Email: <?=$comInfo['email']?> </p>
        <p>For and on behalf of <?=$comInfo['name']?> </p>
        <p>Effective Date: <?=date("l jS \of F, Y",strtotime($comInfo['agsdate']))?> </p>
        <!--<p>Deployment Date: Tuesday, April 12, 2016</p>-->
        <p>BY PRESSING THE SUBMIT BUTTON, I HEREBY ACKNOWLEDGE THAT I HAVE READ AND UNDERSTOOD THE INFORMATION PRESENTED ABOVE AND AGREE TO THE TERMS AND CONDITIONS SET FORTH HEREIN</p>
         <h3>Backcheck.io/BackCheckGroup.com</h3>
         </div>
        
 		<?php 
		$tabl = "client_agreement as ca INNER JOIN checks as ch ON ca.checks_id=ch.checks_id";
		$companies = $db->select($tabl,"ca.clt_cost as ccost, ch.checks_title as checks_titlex, ca.clt_currency as curr","ca.com_id='$com_id' and ca.qoutation_num = '$alldata[qoutation_num]' ORDER BY ca.agrID ");
			
 			while($alldata = mysql_fetch_array($companies))
			{
				echo '<div>'.$alldata['checks_titlex'].'</div><br>';
				echo '<div>'.$alldata['ccost'].'</div><br>';
				echo '<div>'.$alldata['curr'].'</div><br>';
			}
		?>   
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         
      </div>
    </div>
  </div>
</div>


 
            
            
            
            <?php
			$ver++;
			}
			?>
            </tbody>
         </table>
         </div> 	 
  
<div id="container2" class="container2 content" style="display:none">	

						<div class="bb-custom-wrapper">
				<div id="bb-bookblock" class="bb-bookblock">
					<div class="bb-item" id="item1">
						<div class="content">
							<div class="scroller">
								<h2>MASTER SERVICES AGREEMENT BACKCHECKGROUP.COM</h2>
								<p>Agreement for <b>the Supply of Employee Background Screening Services</b> (“Master Agreement”) is entered into as of the date signed below (the “<?=$Q['agsdate']?>”) by the company identified below (“<?=$COMINF['name']?>”) and <b>BACKGROUND CHECK PRIVATE LIMITED,</b>  hereafter referred to as service provider (“SERVICE PROVIDER”).</p>


								<h3 class="text-center text-semibold"><u>Witness:</u></h3>
   

<p>CLIENT may be a requestor of certain employment and income verification reports from Service Provider pursuant to the terms and conditions of an Addendum entered into between CLIENT and SERVICE PROVIDER; and/or</p>
<p>CLIENT may be a furnisher of certain information who desires to provide SERVICE PROVIDER with certain data including but not limited to income and employment verification information relating to current and/or former employees and to have the SERVICE PROVIDER collect, administer and retain the data strictly on behalf of the Furnisher.</p>
<p>CLIENT wishes to obtain these services from SERVICE PROVIDER, and SERVICE PROVIDER desires to provide to CLIENT such services as further described in Section 1 below;</p>
<p>NOW, THEREFORE, CLIENT and SERVICE PROVIDER agree as follows:</p>

		<ul class="list" style="list-style-type:decimal">
	<li><b><u>Designation of Services.</u></b>
    	<ul class="list" style="list-style-type:lower-alpha">
        	<li><b><u>Form of Service Addendum.</u></b>
            	<p>All services provided to CLIENT by SERVICE PROVIDER pursuant to this Master Agreement will be provided in accordance with, and will be governed by, this Master Agreement and the addendum(s) designated pursuant to Section 1(b) below (individually and collectively, “Service Addendum”). Accordingly, the Service Addendum shall include:</p>
                <ul>
               		<li>i. The effective date of the Services described under the Service Addendum and, if applicable, the term or period of time during which SERVICE PROVIDER will provide services or resources to CLIENT pursuant to the Service Addendum; and</li>
               
                <li>ii.	The description of the services or resources to be provided by SERVICE PROVIDER to CLIENT</li>
                </ul>
            
            </li>
                       <li><b><u>Election of Services.</u></b> SERVICE PROVIDER shall provide the following services as provided in the following Service Addendum:
Requestor Service Addendum
</li>
        
        </ul>
    
    </li>
    
    <li><b><u>Term.</u></b><br />
This Master Agreement will become effective on the Effective Date and will continue in full force and effect until the expiration of all Service Addendums. The term of each Service Addendum will commence on the Effective Date and will terminate on such date, if any, specified in the applicable Service Addendum (“Termination Date”). Notwithstanding the termination of a Service Addendum the terms and conditions of this Master Agreement will remain in full force and effect. In the event this Master Agreement is terminated, then all the Service Addendums shall be terminated as well. CLIENT is liable for all agreed fees and expenses incurred up to and including the date that the termination is communicated in writing to SERVICE PROVIDER.
</li>

<li><b><u>Service Fee; Invoicing.</u></b><br />
In consideration for the services provided pursuant to a Service Addendum, CLIENT shall pay to SERVICE PROVIDER such amounts as set forth in the applicable Service Addendum as may be mutually agreed between the parties.
Taxes as applicable will be charged at actual and will be borne by CLIENT.
</li>

<li><b><u>Conflicts.</u></b><br />
In the event of a conflict between the provisions of a Service Addendum and this Master Agreement, the provisions of this Master Agreement will control; provided, however, that the provisions of this Master Agreement will be so construed to give effect to the applicable provisions of the Service Addendum to the fullest extent possible. </li>
    
    <li><b><u>DISCLAIMER OF CONDITIONS AND WARRANTIES.</u></b><br />
ALL GOODS AND SERVICES ARE PROVIDED “AS IS”. EXCEPT AS EXPRESSLY PROVIDED IN AN APPLICABLE SERVICE ADDENDUM, SERVICE PROVIDER AND ITS AFFILIATES MAKE NO AND DISCLAIM ANY AND ALL CONDITIONS, WARRANTIES AND REPRESENTATIONS WITH RESPECT TO THE GOODS OR SERVICES, PROVIDED PURSUANT TO THIS MASTER AGREEMENT AND THE SERVICE ADDENDUMS, WHETHER SUCH CONDITIONS, WARRANTIES AND REPRESENTATIONS ARE EXPRESS OR IMPLIED IN FACT OR BY OPERATION OF LAW OR OTHERWISE, CONTAINED IN OR DERIVED FROM THIS MASTER AGREEMENT, ANY SERVICE ADDENDUM, ANY OTHER DOCUMENTS REFERENCED IN THIS MASTER AGREEMENT OR ANY SERVICE ADDENDUM, OR ANY OTHER MATERIALS OR COMMUNICATIONS WHETHER ORAL OR WRITTEN, INCLUDING WITHOUT LIMITATION IMPLIED CONDITIONS AND WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE AND IMPLIED CONDITIONS AND WARRANTIES ARISING FROM THE COURSE OF DEALING OR A COURSE OF PERFORMANCE WITH RESPECT TO THE ACCURACY, VALIDITY, OR COMPLETENESS OF ANY SERVICE OR REPORT, FURTHERMORE, SERVICE PROVIDER AND ITS AFFILIATES EXPRESSLY DISCLAIM THAT THE GOODS OR SERVICES WILL MEET CLIENT’S NEEDS, OR THAT SERVICES WILL BE PROVIDED ON AN UNINTERRUPTED BASIS, AND SERVICE PROVIDER AND ITS AFFILIATES EXPRESSLY DISCLAIMS ALL SUCH REPRESENTATIONS, CONDITIONS AND WARRANTIES.
</li>

<li><b><u>Limitation of Liability.</u></b><br />
Except as expressly provided in an applicable Service Addendum, SERVICE PROVIDER and its affiliates shall not be liable for any indirect, incidental, contingent, consequential, punitive, exemplary, special or similar damages, including but not limited to, loss of profits, loss of opportunity or loss of data, whether incurred as a result of negligence or otherwise, irrespective of whether service provider has been advised of the possibility of the incurrence by CLIENT of any such damages. Notwithstanding anything stated elsewhere in this Master Agreement or any Service Addendums SERVICE PROVIDER’s liability damages incurred in connection with services provided pursuant to this Master Agreement or any Service Addendum, including as a result of any negligence on the part of the SERVICE PROVIDER or its affiliates, shall not exceed three times the amount paid by client to SERVICE PROVIDER for the particular service giving rise to such damages. Further, SERVICE PROVIDER will have no liability for any cause of action against CLIENT which became known to CLIENT, or should have been known by CLIENT with reasonable investigation, within six months from the expiration or termination of this Master Agreement or applicable Service Addendum.
</li>

<li><b><u>Early Termination.</u></b><br />
SERVICE PROVIDER may terminate or suspend, upon reasonable notice, this Master Agreement and/or any and all Service Addendums or CLIENT’s right to receive any or all services under this Master Agreement and/or any Service Addendum if CLIENT fails to comply with the terms and conditions of this Master Agreement and/or Service Addendum. SERVICE PROVIDER may terminate or immediately suspend this Master Agreement and/or any and all Service Addendums or CLIENT’s right to receive any or all services under this Master Agreement and/or any Service Addendum if CLIENT fails to comply with any law applicable to the services provided to CLIENT pursuant to this Master Agreement and/or any and all Service Addendums.
</li>

<li><b><u>Binding Nature and Assignment.</u></b><br />
CLIENT may not assign or transfer this Master Agreement or any rights or obligations under this Master Agreement or any Service Addendum without the prior written consent of SERVICE PROVIDER, which may be withheld in the sole and unfettered discretion of SERVICE PROVIDER. This Master Agreement and each Service Addendum will bind and inure to the benefit of the parties and their respective successors and permitted assigns.
</li>

<li><b><u>Relationship of Parties; Affiliates.</u></b><br />
SERVICE PROVIDER is acting only as an independent contractor. Neither party shall act nor represent itself, directly or by implication, as an agent of the other. Each party shall be responsible for the direction and control of its employees, subcontractors, and/or consultants and nothing under this Master Agreement or Service Addendum shall create any relationship between the employees, subcontractors and/or consultants of SERVICE PROVIDER and CLIENT respectively. Each party shall ensure that each of its affiliates accepts and complies with all of the terms and conditions of this Master Agreement and each Service Addendum as if each such affiliate were a party to this Master Agreement and each Service Addendum.</li>

<li><b><u>Additional Documents.</u></b><br />
The parties hereto agree to execute any additional documents reasonably required to effectuate the terms, provisions and purposes of this Master Agreement and each Service Addendum.
</li>

<li><b><u>Representation of Authority; Authorization and Corporate Consents.</u></b><br />
CLIENT hereby represents and warrants to SERVICE PROVIDER that this Master Agreement and each Service Addendum has been duly executed and delivered by CLIENT and that this Master Agreement and each Service Addendum constitutes a legal, valid and binding obligation of CLIENT, enforceable against CLIENT in accordance with its terms. The signatories to this Master Agreement are duly authorized to do so by the respective parties and have all necessary corporate or legal consents to enter into this Master Agreement.
</li>
<li><b><u>Force Majeure.</u></b><br />
The SERVICE PROVIDER will not be liable to the CLIENT for any delay or non-performance of its obligations under this Master Agreement arising form an act of God, governmental act, war, fire, flood, explosion or civil commotion. Subject to the SERVICE PROVIDER notifying the CLIENT of the cause and likely duration of the cause, the performance of the SERVICE PROVIDER’s obligations, to the extent affected by the cause, shall be suspended during the period that the cause persists provided that if performance is not resumed within 30 days after that notice the CLIENT may by notice in writing terminate this Master Agreement.
</li>

<li><b><u>Entire Agreement.</u></b><br />
This Master Agreement, Service Addendums and the exhibits attached hereto and thereto constitute the final, entire, and exclusive agreement between the parties with respect to the subject matter contained herein and therein. There are no representations, warranties, understandings or agreements among the parties with respect to the subject matter contained herein and therein, which are not fully expressed in the Master Agreement, Service Addendums and the exhibits attached hereto and thereto. This Master Agreement, the Service Addendums, and the exhibits attached hereto and thereto supersede all prior agreements and understandings between the parties with respect to such subject matter.
</li>

<li><b><u>Validity.</u></b><br />
If any provision of this Master Agreement or any Service Addendum is held to be unenforceable, the remaining provisions shall be unaffected. Each provision of this Master Agreement and each Service Addendum, which provides for a limitation of liability, disclaimer of warranties, or exclusion of remedies is severable from and independent of any other provision.
</li>
<li><b><u>Choice of Law and Jurisdiction.</u></b><br />
This Master Agreement is subject to the laws and the exclusive jurisdiction of courts of the country where the SERVICE PROVIDER’s address set forth in the first paragraph is located.
</li>

</ul>						 

								 
							</div>
						</div>
					</div>
					<div class="bb-item" id="item2">
						<div class="content">
							<div class="scroller">
								<h2>Acceptence Detail</h2>
								<p>Signed: <?=$data2['sender_ip']?> ON Background Check Pte Ltd, Date: <?=date("l jS \of F, Y",strtotime($data2['send_date']))?> </p>

<p>Name: Khalid Siddiqui, Title: CEO    Email:   kks@backcheckgroup.com</p>
<p>For and on behalf of Background Check Pte Ltd</p>
<p>Signed: <?=$data2['client_ip']?> ON <?=$COMINF['name']?>, Date:  <?php if($data2['app_rej_date'] != ''){echo date("l jS \of F, Y",strtotime($data2['app_rej_date']));}else {echo '-';}?> </p>
<p>Name: Authorize Person, Title: CEO    Email: <?=$COMINF['email']?> </p>
<p>For and on behalf of <?=$COMINF['name']?> </p>
<p>Effective Date: <?=date("l jS \of F, Y",strtotime($Q['agsdate']))?> </p>
<!--<p>Deployment Date: Tuesday, April 12, 2016</p>-->
<p>BY PRESSING THE SUBMIT BUTTON, I HEREBY ACKNOWLEDGE THAT I HAVE READ AND UNDERSTOOD THE INFORMATION PRESENTED ABOVE AND AGREE TO THE TERMS AND CONDITIONS SET FORTH HEREIN</p>

<h3>Backcheck.io/BackCheckGroup.com</h3>
 



							</div>
						</div>
					</div>
					<div class="bb-item" id="item3">
						<div class="content">
							<div class="scroller">
								<h2>REQUESTOR SERVICE ADDENDUM</h2>
								<p>This Data Requestor Service Addendum to the Verify Direct Master Services Agreement (the “Addendum”) is effective as of the acceptance date signed below by the Service Provider. Client is identified in the BackcheckGroup.com Master Services Agreement which is dated Tuesday, April 12, 2016 (“Master Agreement’) and is herein after referred to as requestor ("<?=$COMINF['name']?>") and agrees to enter into this Addendum with <b>Background Check Pte LTd,</b> (“Service Provider”) for a web-based service designed to provide employment and income verification services ("Verification Services").</p>


<ul>
<li>
<b><u>Purpose, Scope of Services & Fees</u></b><br />
Requestor may order employment and income verification reports<b>(“Reports”)</b> from Service Provider pursuant to the terms and conditions of this Addendum.


<p>The Reports will contain information, as furnished to Service Provider by employers <b>(“Furnishers”)</b> relating to the employment and/or income verification information and other relevant data (“Verification Data”) related to the subject of the Report <b>(the “Applicant”).</b> Service Provider may modify this scope of services at any time effective upon notice to Requestor. </p>
<p>The Report will not be released to the Requestor until the authorization to disclose the Service Provider receives the Report. Each Applicant will be provided a confidential password to access and transmit the required authorization to Service Provider. </p>
<p>Requestor agrees as compensation for the Verification Services performed under this Addendum to pay to the Service Provider such sums as set forth in Annexure A attached hereto as may be amended from time to time</p>
</li>



	<li><b>Requestor Obligations</b>
		<ul>
			<li>i. Requestor acknowledges that it will comply with applicable laws, rules and regulations when using Reports provided pursuant to this Addendum.
</li>
<li>ii.	Requestor certifies that it will order and use the Reports for the purpose which was approved by the Applicant for each order and for no other purpose (“).</li>
<li>iii.	Requestor certifies it shall base its related decisions or action on its lawful policies and procedures and all local laws, statutes and regulations.</li>
<li>iv.	Requestor acknowledges and agrees that the Verification Data provided by Furnisher may be maintained and stored by Service Provider in other jurisdictions or countries. The Requestor acknowledges that the Report and any information contained therein, including the Verification Data is in the nature of confidential information. Requestor certifies that it shall hold the Report in strict confidence and not disclose the Report or any information contained therein, including the Verification Data, to any party not involved in the transaction for which the information is requested.</li>
<li>v.	Requestor certifies that it shall obtain the online consent of the Applicant prior to ordering any Report from Service Provider.</li>
<li>vi.	Requestor agrees that each time it orders a Report, the order constitutes Requestor’s reaffirmation of its certifications in Annexure C “Access Security Requirements” with respect to such Report.</li>
		</ul>
       
       
       
        
    
	</li>
    
    <li>
    <b>Other Obligations</b>
    <ul>
    <li>i. Requestor agrees it is the end-user of all Reports, and will not resell, sub-license, deliver, display, or otherwise distribute any Report, or provide any information in any Report, to any third party, except to the Applicant or as otherwise required under law. Requestor agrees that it will be responsible and liable for any actions or inactions of its agent or representative acting on its behalf with respect to requesting and obtaining the Report or accessing and/or viewing the Reports in the Service Provider system and/or using the Report or any information contained therein.</li>
    <li>ii. Requestor shall not use the data from the Report supplied by Service Provider to directly or indirectly compile, store, or maintain the data to develop its own source or database of Reports. Requestor agrees not to market the Reports through the Internet or in any other manner.</li>
    <li>iii. Service Provider may impose additional requirements in connection with Requestor orders and use of Reports in order to comply with changes in laws, to better protect the security and privacy of the information Service Provider provide or as Service Provider otherwise reasonably believes to be prudent or as required under the circumstances. Requestor agrees to comply with all such additional requirements after Requestor has received notice of them.</li>
    <li>iv. Service Provider acknowledges that it will comply with applicable laws, rules and regulations when providing and using the data provided pursuant to this Agreement.</li>
    </ul>
    </li>
    
    <li><b><u>Indemnification</u></b><br />
    Requestor shall indemnify, defend and hold harmless Service Provider and its affiliates from and against any and all claims, suits, proceedings, damages, costs, expenses (including, without limitation, reasonable attorneys’ fees and court costs) brought against, or suffered by, any third party arising or resulting from, or otherwise in connection with Requestor’s: i) use of the Reports, ii) breach of any of its representations, warranties, or agreements as stated herein, iii) NEGLIGENCE or WILLFUL misconduct and/or iv) if applicable the administration of Requestor’s hiring criteria or company policies or procedures.</li>
    
    <li><b><u>Termination</u></b><br />
     This Addendum will become effective on the date entered below by Service Provider and will continue in full force and effect until terminated by BackcheckGroup.com Notwithstanding the termination of this Service Addendum the terms and conditions of this Master Agreement will remain in full force and effect. In the event this Master Agreement is terminated, then all the Service Addendum including this Addendum shall be terminated as well. Requestor is liable for all agreed fees and expenses incurred up to and including the date that the termination is communicated in writing to Service Provider.</li>
    
    <li><b><u>Force Majeure.</u></b><br />
     The Service Provider will not be liable to the Furnisher for any delay or non-performance of its obligations under this Addendum arising form an act of God, governmental act, war, fire, flood, explosion or civil commotion. Subject to the Service Provider notifying the Furnisher of the cause and likely duration of the cause, the performance of the Service Provider’s obligations, to the extent affected by the cause, shall be suspended during the period that the cause persists provided that if performance is not resumed within 30 days after that notice the Furnisher may by notice in writing terminate this Addendum.</li>
   
    <li><b><u>Exhibits (“Annexure”):</u></b><br />
     The following exhibits are attached hereto and incorporated by reference herein.</li>
   
   <p><b>Exhibit B – Requestor Certification</b></p>
   <p><b>Exhibit C – Access Security</b></p>
   
  <p>BY PRESSING THE SUBMIT BUTTON, I HEREBY ACKNOWLEDGE THAT I HAVE READ AND UNDERSTOOD THE INFORMATION PRESENTED ABOVE AND AGREE TO THE TERMS AND CONDITIONS SET FORTH HEREIN.</p>
  
  <p>ANNEXURE A – FEES, SET UP AND IMPLEMENTATION</p>
  
  <p>ANNEXURE A –FEES</p>
  <p><b>Fees:</b></p> 
  
  <h3>Backcheck.io / Backcheckgroup.com</h3>
  <p><b>[ Note:</b> Draw a Table like This, with All Services, as soon as we Add Services it will be added into the Agreement ]</p> 
    
    
</ul>
							</div>
						</div>
					</div>
					<div class="bb-item" id="item4">
						<div class="content">
							<div class="scroller">
								<h2>Checks Detail</h2>
								<div class="table"><!--table start-->
	
    <table border="1" width="100%">
    	<thead>
        		<th><b>Components</b></th>
                <th><b>Description (All rates are exclusive of taxes)</b></th>
                <th><b>Jurisdiction</b></th>
                <th><b>Cost Per Check (Rupees)</b></th>
                
        </thead>
        
        <tbody>
            	<!--<tr>
              
                	<td align="center" colspan="8">A)	FOR NEW HIRING</td>
                
                </tr>	-->
                <?php
				 $clients_checks = $db->select("clients_checks","*",$where);
                while($res = mysql_fetch_array($clients_checks))
				{
					$checks = getCheck($res['checks_id']); 
				//print_r($checks);
				?>
                <tr>
                	<td><b><?=$checks['checks_title']?></b></td>
                    <td><?=$checks['checks_desc']?></td>
                    <td><?=$res['clt_currency']?></td>
                    <td><?=$res['clt_cost']?></td>
               
               </tr>
               <?php
				}
			   ?>
                 
                	
        </tbody>
        
    </table>

</div><!--table end-->



							</div>
						</div>
					</div>
					<div class="bb-item" id="item5">
						<div class="content">
							<div class="scroller">
								<h2>Commencing practice</h2>
									<p>Note – I am aware that the pricing may change any moment without any notice and I agree to comply with the revised pricing prevailing at the time of placing the order.</p>
    <p>BY PRESSING THE SUBMIT BUTTON, I HEREBY ACKNOWLEDGE THAT I HAVE READ AND UNDERSTOOD THE INFORMATION PRESENTED ABOVE AND AGREE TO THE TERMS AND CONDITIONS SET FORTH HEREIN.</p>
   <span class="text-center"><h3>ANNEXURE B – REQUESTOR CERTIFICATION</h3></span>
    <span class="text-center"><h3>REQUESTOR CERTIFICATION</h3></span>
    <p>As a condition to ordering and obtaining Reports from Service Provider, Requestor agrees as follows:</p>
    
    <ul>
    	<li>You certify to Service Provider that with respect to each Report ordered from Service Provider:</li>
        <li>a.	a. You will use such Report solely for the purpose as approved by the employee. The subject of the report includes any employee who is a current employee, potential employee or ex-employee (the “Applicant”). You understand and agree that the Service Provider is not responsible for the accuracy of the content of the Report;</li>
        <li>b.	Prior to ordering the Report, or causing the Report to be ordered:
i.	You have obtained the Applicant’s authorization to obtain the Report
</li>
    </ul>
    
    
    <ul>
    	<li>You agree that all certifications and agreements herein are of a continuing nature and are intended to apply to an applicant and/or Employee Report that you order from Service Provider.</li>
    </ul>
    
    <h3>I, ON BEHALF OF THE COMPANY/I (in case of an individual Requestor) , HEREBY AGREE TO COMPLY WITH THE REQUESTOR CERTIFICATION NOTED HEREIN. I FURTHER CERTIFY THAT I HAVE DIRECT KNOWLEDGE OF THE FACTS CERTIFIED HEREIN AND AM AUTHORIZED BY THE COMPANY (in case of a company) TO AGREE TO THESE ITEMS HEREIN ON ITS BEHALF.</h3>
    
    <p>BY PRESSING THE SUBMIT BUTTON, I HEREBY ACKNOWLEDGE THAT I HAVE READ AND UNDERSTOOD THE INFORMATION PRESENTED ABOVE AND AGREE TO THE TERMS AND CONDITIONS SET FORTH HEREIN.</p>


<span class="text-center"><h3>ANNEXURE C – ACCESS SECURITY REQUIREMENTS</h3></span>
<span class="text-center"><h3>ACCESS SECURITY REQUIREMENTS</h3></span>

<p><b>It is a requirement that all end users take precautions to secure any system or device used to access Applicant credit information. To that end, the following requirements have been established:</b></p>

<p><b>Your user ID and password must be protected in such a way that this sensitive information is known only to key personnel. Under no circumstances should unauthorized persons have knowledge of your password. The information should not be posted in any manner within your facility.</b></p>

<p><b>Any system access software you may use, whether developed by your company or purchased from a third party vendor, must have your user ID and password “hidden” or embedded so that the password is known only to supervisory personnel. Each user of your system access software must then be assigned unique log-on passwords.</b></p>

<p><b>Your user ID and passwords are not to be discussed by telephone to any unknown caller, even if the caller claims to be an employee.</b>
</p>

<p><b>The ability to obtain credit information must be restricted to a few key personnel.</b></p>   
<p><b>Any terminal devices used to obtain credit information should be placed in a secure location within your facility. Access to the devices should be difficult for unauthorized persons.</b></p>  

<p><b>Any devices/systems used to obtain Applicant reports should be turned off and locked after normal business hours, when unattended by your key personnel.</b></p>    

<p><b>Hard copies and electronic files of Applicant reports are to be secured within your facility and protected against release or disclosure to unauthorized persons.</b></p>   

<p><b>Hard copy Applicant reports are to be shredded or destroyed, rendered unreadable, when no longer needed and when it is permitted to do so by applicable regulations(s).</b></p>

<p><b>Electronic files containing Applicant report data and/or information will be completely erased or rendered unreadable when no longer needed and when destruction is permitted by applicable regulation(s).</b></p>
            <p><b>Software cannot be copied. Software is issued explicitly to you solely to access reports for permissible purposes.</b></p>
            
            <p><b>Your employees will be forbidden to attempt to obtain credit reports on themselves, associates or any other persons, except in the exercise of their official duties.</b></p>
            
            <p>I, ON BEHALF OF THE COMPANY, HEREBY AGREE TO COMPLY WITH THE ACCESS SECURITY REQUIREMENTS NOTED HEREIN. I FURTHER CERTIFY THAT I HAVE DIRECT KNOWLEDGE OF THE FACTS CERTIFIED HEREIN AND AM AUTHORIZED BY THE COMPANY TO AGREE TO THESE ITEMS HEREIN ON ITS BEHALF.</p>
            <p>BY PRESSING THE SUBMIT BUTTON, I HEREBY ACKNOWLEDGE THAT I HAVE READ AND UNDERSTOOD THE INFORMATION PRESENTED ABOVE AND AGREE TO THE TERMS AND CONDITIONS SET FORTH HEREIN</p>
            
            
							</div>
						</div>
					</div>
                    
                    
                                 <?php
                $agreement_discussion = $db->select("client_agreement_discussion","*","com_id='".$com_id."' ");
if(mysql_num_rows($agreement_discussion))
{
			 ?>             

                    
                    <div class="bb-item" id="item6">
						<div class="content">
							<div class="scroller">
								<h2>Feedbacks</h2>
									 <table>
   <tr>
   <th>User</th><th>Message</th><th>Date</th>
   </tr>
   <?php
 while($rex = mysql_fetch_array($agreement_discussion))
	{
		$getClUser = getUserInfo($rex['user_id']);
		
	?>
    <tr>
   <td><?=$getClUser['first_name'].' '.$getClUser['last_name']?></td><td><?=$rex['message']?></td><td><?=date("Y-m-d",strtotime($rex['senddate']))?></td>
   </tr>

	<?php
	}


   ?>
   </table>
            
            
							</div>
						</div>
					</div>
                    
                  <?php
}
?>
  
				</div>
				
				<nav>
					<span id="bb-nav-prev">&larr;</span>
					<span id="bb-nav-next">&rarr;</span>
				</nav>

				<!--<span id="tblcontents" class="menu-button">Table of Contents</span>-->

			</div>
				
		</div>
        
        
 
     
                       <?php /*?><?php   
				 if(!empty($data2) && $data2['is_suspend_active'] != 1 && $data2['agr_status'] != 2 && $data2['agr_status'] != 3 && $data2['is_send'] == 1)
				 { 
				 $getClUser = getUserInfo($data2['agr_receiver']);
				 
				 ?>
                  <div>
                  <form method="post">
                  <textarea name="feedback_agreement"></textarea><br /><br />
                  <input type="hidden" name="comid" value="<?=$com_id?>" />
                  <input type="hidden" name="clientip" value="<?=$get_client_ip?>"  />
                  <input type="hidden" name="poc_email" value="<?=$getClUser['email']?>" />
                  	<input type="submit" name="sendfeedback" class="btn bgc-success btn-xs "  value="Send Feedback" /><br /><br />
                    <a href="#" class="btn bgc-success btn-xs" data-toggle="modal" data-target="#agreement_accept"> <span>Accept Agreement</span></a>

                    <a href="#" class="btn bgc-red btn-xs mr-5" data-toggle="modal" data-target="#agreement_reject">         <span>Reject Agreement</span></a>
                  	
                    
                  </form>
                  
  
<div class="modal fade in" id="agreement_accept" role="dialog" >
    <div class="modal-dialog">
       <div class="modal-content">
        <div class="modal-body">
          <div class="form-group" style="font-size:14px;">
                   Are you sure you want to approve this agreement?
            </div>
         </div>
        <div class="modal-footer">
           <form method="post">
                   <input type="hidden" name="comid" value="<?=$com_id?>" />
                  <input type="hidden" name="clientip" value="<?=$get_client_ip?>"  />
                  <input type="hidden" name="poc_email" value="<?=$getClUser['email']?>" />
                  <input type="submit" name="acceptgreement" class="btn bgc-success btn-xs "  value="Yes" />

                  </form>
        </div>
      </div>
     </div>
  </div> 
                  
                  
  
<div class="modal fade in" id="agreement_reject" role="dialog" >
    <div class="modal-dialog">
       <div class="modal-content">
        <div class="modal-body">
          <div class="form-group" style="font-size:14px;">
                   Are you sure you want to Reject this agreement?
            </div>
         </div>
        <div class="modal-footer">
           <form method="post">
                   <input type="hidden" name="comid" value="<?=$com_id?>" />
                  <input type="hidden" name="clientip" value="<?=$get_client_ip?>"  />
                  <input type="hidden" name="poc_email" value="<?=$getClUser['email']?>" />
                  	 <input type="submit" name="rejectagreement" class="btn bgc-red btn-xs mr-5"  value="Yes" /> 
                  </form>
        </div>
      </div>
     </div>
  </div> 
                  
                  </div>
        		<?php
				 }<?php */?>
                 <?php
				}
				else
				{
		echo "Qoutation have suspended by bcg.";
				}
				
		}		
	   else{
		echo "You Have No Access To See this agreement.";
		}  
				?>
  

 		<script src="<?php echo SURL; ?>flipper/new/jquery.mousewheel.js"></script>
		<script src="<?php echo SURL; ?>flipper/new/jquery.jscrollpane.min.js"></script>
		<script src="<?php echo SURL; ?>flipper/new/jquerypp.custom.js"></script>
		<script src="<?php echo SURL; ?>flipper/new/jquery.bookblock.js"></script>
		<script src="<?php echo SURL; ?>flipper/new/page.js"></script>
		<script>
			$(function() {

				Page.init();

			});
		</script>



