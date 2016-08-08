<head>
    <link href="https://backcheck.io/verify/dashboard/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		    <script type="text/javascript" src="https://backcheck.io/verify/scripts/jquery-latest.js"></script>

	<script type="text/javascript" src="https://backcheck.io/verify/dashboard/assets/js/core/libraries/bootstrap.min.js"></script>
    <title>Quotation Approval</title>
	<style>
 
#asdasd {
  height:450px;
  overflow:auto;
}</style>

  <link href="<?php echo SURL; ?>dashboard/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/components.min.css?v1=1.1" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/colors.min.css" rel="stylesheet" type="text/css">
	
    </head>
	
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">
		
		<div class="content-wrapper">
		
		<div class="content">
		
		<div class="panel panel-flat">
		
		<div class="panel-body">
<?php
 require_once("include/config.php");
 include ('include/config_client.php');
  

$qout_num = $_GET['qn'];

	$companies = $db->select("client_agreement_confg","*","qoutation_num = '$qout_num'");
	if(mysql_num_rows($companies))
	{
		$data2 = mysql_fetch_array($companies);
		 
	?>
     
  
  <div class="modal fade" id="agreement_reject_feedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Reason Of Rejection</h4>
      </div>
      <div class="modal-body">
        <textarea name="reject_feedback"></textarea>
         <input type="hidden" name="comid" value="<?=$data2['comps_id']?>" />
		  <input type="hidden" name="Quotation_num" value="<?=$data2['Quotation_num']?>" />
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-default" name="sendfeedbackx" value="Send" > 
         
      </div>
    </div>
  </div>
  </form>
</div>
 
    <button class="btn bgc-success btn-xs "  id="forfeedbacks" data-toggle="modal" data-target="#agreement_reject_feedback" style="display:none" ></button>
    

<form method="post"> 
	<?php 
	
 	if($data2['is_send'] == 1 )
		{

 	if($data2['is_suspend_active'] != 1 && $data2['is_expired'] != 1)
		{
	$user_id = $data2['agr_receiver'];
		
			
 	// fOR USER EXISTS
	if($data2['is_user_exists'] == 0)
		{
 		$userx = $db->select("users","*","user_id = $user_id");
		if(mysql_num_rows($userx))
		{
			 
		
		
		
		$user_detail = mysql_fetch_array($userx);
		$user_name = $user_detail['first_name'].' '.$user_detail['last_name'];
		
		$user_email = $user_detail['email'];
		
		echo "Dear ".$user_name.",<br><br><p>Please review the Quotation.";
		}
		
 
		}
 	// END fOR USER EXISTS
		
 	// fOR USER NOT EXISTS
		else
		{
			$user_email = $user_id;
			$user_name = $user_id;
			echo "Dear ".$user_id." ,<br><br><p>Please review the Quotation.";
			?>
            <input type="hidden" name="newuser_add" value="yes" />
            <input type="hidden" name="uemail" value="<?=$user_id?>"  />
            <input type="hidden" name="username" value="<?=$user_id?>" />
            
             
            <?php
			
		}
 	// END fOR USER NOT EXISTS
		
 	
	$comInfo = getcompany($data2['comps_id']);
	$comInfo = @mysql_fetch_array($comInfo);

		 
		
	?> 

     <input type="hidden" name="agr_version" value="<?=$data2['agr_version']?>" />
     <input type="hidden" name="qoutation_num" value="<?=$data2['qoutation_num']?>" />
    

        <?php /*?><div class="scroller">
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
         </div><?php */?>
       <div id="asdasd">
      <h1> Agreement for the Supply of Employee Background Screening Services</h1>
       THIS AGREEMENT is made at Singapore on this __<?=date("d",strtotime($data2['send_date']))?>__ day of ____<?=date("F",strtotime($data2['send_date']))?>____, 2016:<br>
       <h2>BETWEEN</h2>
<br><b>M/s. Background Check Pte Limited</b>, a company incorporated under the laws of Singapore, having its principal place of business at 30 CECIL STREET # 19-08, Prudential Tower, Singapore (049712) (hereinafter referred to as the "Service Provider" which expression wherever the context so permits shall include its parent, subsidiaries, successors, affiliates, and permitted assigns) of the one part.<br>

<b><?=$comInfo['name']?></b>., a company incorporated under the laws of Pakistan and having its registered offices/principal place of business at <b><?=$comInfo['address']?></b>(hereinafter referred to as the "Client" which expression wherever the context so permits shall include its successors in interest and assign) of the other part; <br>
<br>
The parties to this Agreement are hereinafter individually referred to as a "Party" and collectively as "Parties"
<br><b>WHEREAS</b>
<br>
<b>WHEREAS</b>, Background Check Pte Limited is engaged in the business of, and possesses expertise in, gathering national and international data and records (the "Information Products and Services") in order for CLIENT, to have employment screening services and due diligence services performed on employees, applicants and businesses who reside both within Pakistan and internationally; and 
<br>
<b>WHEREAS</b>, Background Check Pvt Limited is the local subsidy of the service provider in Pakistan, who is authorized to collect the payments. This is to facilitate and enable the client to pay in local currency and meet all the legal and regularity obligations while paying for a service obtained in Pakistan. However, if the client decides to pay online or directly to Background Check Pte Ltd then this provision will be treated as not applicable 
<br><b>WHEREAS</b>, CLIENT has a need for national/international employment screening and due diligence services to be performed on its employees, applicants and third parties and desires to purchase research based Information Products and Services from Background Check Pte. Limited. 
<br>
<b>NOW THEREFORE</b> in consideration of the foregoing, and for other good and valuable consideration, the receipt and sufficiency of which are hereby acknowledged, the parties agree as follows:<br>
<h2>1.0 AGREEMENT</h2><br>
This Agreement shall apply to all services (as defined in Schedule "A" to this Agreement) performed during the term of this agreement, unless the parties expressively agree otherwise by a written modification of this agreement, signed by an authorized representative of both the parties.
<br><h2>2.0 SERVICES</h2><br>
I.	The Service Provider has adequate resources, expertise and is engaged in the business of providing services more specifically stated in the proposal which was shared with the Client earlier. <br>
II.	Client is desirous of availing the Services from the Service Provider and details of such Services are given in the Scope of Work prescribed in the Schedule "A" to this Agreement.<br>
III.	The Service Provider has offered to provide the Services to Client as per the Scope of Work and Client has accepted the said offer of the Service Provider on the terms and conditions as given in this Agreement.<br>
<h2>3.0 PRICING</h2><br>
The description and price for the Services is shown on the Schedule A and is denoted in USD and is subject to change with one month's notice in written in advance by the service provider to the client. All rates are exclusive of all applicable taxes. Monthly invoices will be made on the basis of order received during the month. In case the invoices are required to be raised by a local entity in local currency then the conversions from USD to local currency will be performed on the basis of standard web services based conversation rates that will be mentioned on the invoices with source. All payments will be made in the name of the local subsidy / authorised entity to collect the payments. In full consideration for provision of the Services, and of the fulfilment of other obligations under this Agreement, Client shall, subject to the provisions of this Agreement, pay or cause to be paid to the Service Provider the charges in accordance with the rates stated in Schedule "A" attached hereto. The charges/rates for the Services shall be as per the Schedule A with effect from the date of agreement of this agreement unless otherwise mutually agreed in writing by both the parties. 
<br>
<h2>4.0 TERM AND TERMINATION OF THIS AGREEMENT</h2><br>
The term of this Agreement begins as of the Effective Date and continues until either party may terminate the contract by giving one-month advance notice to the other party. Upon termination, this Agreement will continue to govern the parties' rights and obligations with respect to the Information Products/services performed prior to termination.
<br>
<h2>4ADDITIONAL TERMS AND CONDITIONS</h2>4
<br>
<h2>45.0	BUSINESS INTEGRITY</h2>4
<br>
The Service Provider shall act in accordance with the applicable laws, regulations, and provisions of this Agreement, rules and policies of Client and shall:
<br>
5.1 Perform in accordance with the highest standards of care and diligence normally practiced in performing the Services of a similar nature; and
5.2 Conduct its business in an ethical manner.<br>
<h2>6.0 RETENTION OF DATA /SENSITIVE INFORMATION</h2> <br>
Service Provider will send all the hard copy data along with monthly invoices to the designated personnel of the client,  client is required to confirm the name and contact details of designated representative who will receive all the hard copies on behalf of client from the service provider.
An official authorization letter shall be provided to the Service Provider for the same. All the soft data will be accessible via our online portal for a period of two years, unless a different period is required by the law of the country or the jurisdiction from where the data originates.
<br>
<h2>7.0 ACCESS SECURITY</h2> <br>
 CLIENT agrees to have reasonable procedures for the fair and equitable use of private personal information and to secure the confidentiality of private information of their existing or prospecting employees/clients/vendors. CLIENT agrees to take precautionary measures to protect the security and dissemination of all report information available on Service Provider portal or which is shared with the client soft copy or hard copy, including for example, restricting terminal access, utilizing passwords to restrict access to terminal devices, and securing access to, dissemination and destruction of electronic and hard copies of reports. CLIENT agrees to abide by Schedule B attached hereto, which is incorporated into as a part of this Agreement.  
 <br>
<h2> 8.0 CLIENT AND APPLICANT/DATA SCREENING POLICY AND SUBJECT AUTHORIZATION/CONSENT </h2>  <br>
CLIENT certifies that they already have detailed employment background check policy in effect and fully authorized by the stakeholders and that the client is having full understanding of the relevant local laws and the provision of the action provided by such laws in handling of the matters where a document was found forged or an individual was identified having past criminal record or any sort of misleading or false information being provided to the client for the purpose of employment. The service provider is providing a services based on known facts and will not express any opinion whatsoever. If the client currently not maintaining any employment background checks policy in accordance with the local laws then the Service provider can offer this service separately on a nominal fees. <br>
 
CLIENT certifies that, prior to requesting employment screening services from Service Provider, CLIENT will provide authorization letter to Service Provider as per the standard employment background checks policy, whereby authorizing the Service Provider to conduct the background screening services on behalf of the Client on client`s employees/applicant/data subject. CLIENT will also provide authorization letter to Service Provider for each Employee/ Applicant/Data Subject with a written notice statement, advising the Data Subject of their rights (in accordance with relevant International Data Privacy Protection) and that his or her personal data will be used to enable Service Provider to provide the Background Screening Services to CLIENT. CLIENT further certifies that, prior to requesting Service Provider to provide any employment screening services CLIENT will obtain written consent (which is given voluntarily and has not been withdrawn) from each employee/applicant/Data Subject for transferring, exporting and processing of his or her personal information.  Service Provider will not be able to begin the national/international search process until it has received the required confirmation and a copy of current background checks policy, authorization and consent letters. Service Provider reserves the right to decline service requests based upon judicial, legislative, and statutory restrictions within the origination jurisdiction for any data.  
 <br>
<h2>9.0 WARRANTY AND WARRANTY DISCLAIMERS</h2>  <br>
Service Provider warrants that it shall use commercially reasonable efforts to (a) comply with all applicable laws, regulations, rules and standards of all governing jurisdictions in the gathering and retrieval of the Information Products/services, and (b) provide the Information Products/services in a workmanlike manner according to industry standards.  However, CLIENT understands Service Provider does not provide legal advice in the provision of its services and CLIENT acknowledges it is not obtaining from Service Provider, nor relying on Service Provider for legal advice of any type.  CLIENT further understands that Service Provider obtains the data within the Information Products/services from various third-party sources on an "AS IS," basis and therefore is providing the Information Products/services to CLIENT "AS IS."  CLIENT ACKNOWLEDGES AND AGREES THAT, EXCEPT AS EXPRESSLY PROVIDED IN THIS SECTION, Service Provider MAKES NO REPRESENTATION OR WARRANTY WHATSOEVER, EITHER EXPRESS OR IMPLIED (INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY OR FITNESS FOR PARTICULAR PURPOSE, NOR IMPLIED WARRANTIES ARISING FROM THE COURSE OF DEALING OR A COURSE OF PERFORMANCE) WITH RESPECT TO THE ACCURACY, VALIDITY, COMPLETENESS,  OR SUITABILITY OF THE INFORMATION PRODUCTS/SERVICES  FOR CLIENT'S NEEDS AND ISS HEREBY EXPRESSLY DISCLAIMS ALL SUCH REPRESENTATIONS AND WARRANTIES. CLIENT understands and agrees that compliance with all applicable laws regarding the use of the Information Products/SERVICES by CLIENT is the sole responsibility of CLIENT, and that such compliance obligations are not lessened or changed by the performance of Service Provider under this Agreement. 

<h2>10.0 INDEMNIFICATION BY CLIENT </h2> <br>
CLIENT agrees to indemnify, defend and hold harmless Service Provider with respect to any suit, claim, or proceeding ("Claim(s)"), brought against Service Provider relating to or arising out of the conduct of CLIENT relating to its use of the Information Products/Services, including but not limited to any and all claims made by an Applicant/ Data Subject. CLIENT shall pay all costs of litigation including any reasonable attorneys' fees incurred by Service Provider in connection with defending the Claim(s), and all settlement payments and damages awarded therein. Service Provider agrees to provide CLIENT with written notice within thirty (30) days of the date any such Claim(s) are brought to Service Provider's attention. Service Provider agrees to assist and cooperate with CLIENT in the defense of any Claim(s).  <br>  

<h2>11.0 LIMITATION OF LIABILITY </h2><br>  
Service Provider is not liable for CLIENT's obligations/responsibilities related to International Fair Information Handling Practices including but not limited to CLIENT'S collecting, transferring, processing, or securing applicant data. Notwithstanding any other provision of this Agreement, if a court or other authority of competent jurisdiction determines that CLIENT is entitled to damages against Service Provider pursuant to any claim arising (directly or indirectly) in respect of this Agreement, any information, product or service provided by Service Provider under this Agreement or otherwise, the total amount of such damages shall be limited as follows: <br>  (i) if such damages are related to any  Information Product/Services, the amount of such damages shall not exceed the aggregate amount of all fees, charges or other payments paid to Service Provider by CLIENT in respect of such  Information Product/Services , or<br>   (ii) if such damages are in respect of any other breach of any duty or obligation arising under or in respect to this Agreement by Service Provider, the amount of such damages shall not exceed the aggregate amount of all charges which were paid by CLIENT to Service Provider in respect of this Agreement during the 12 month period prior to such breach.  IN NO EVENT AND UNDER NO CIRCUMSTANCES SHALL EITHER PARTY HAVE ANY LIABILITY TO THE OTHER PARTY OR ANY OTHER PERSON OR ENTITY FOR INDIRECT, INCIDENTAL, CONSEQUENTIAL, PUNITIVE, EXEMPLARY, OR OTHER SPECIAL DAMAGES OF ANY KIND (INCLUDING WITHOUT LIMITATION DAMAGES FOR LOST PROFITS), REGARDLESS OF WHETHER THE LEGAL BASIS FOR DAMAGES CLAIM IS UNDER THE LAW OF CONTRACTS, TORTS, NEGLIGENCE OR ANY OTHER LAW, EVEN IF SUCH PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.  CLIENT shall be solely responsible for their own use or misuse of the Information Products/SERVICES and for their own compliance with all laws and regulations applicable to such products and services.    

<h2>12.0 RELATIONSHIP BETWEEN THE PARTIES</h2><br>
In performing their respective duties under this Agreement, the relationship between the parties is of Service Provider and Client.  Nothing contained herein will constitute or give rise to any association, partnership or joint venture between the parties hereto, or be construed to evidence the intention of the parties to establish any such relationship.  Neither party will have the power to bind the other party or incur obligations on the other party's behalf without the other party's prior written consent.
<br>
<h2>13.0 CONFIDENTIALITY</h2><br>
Each Party to this Agreement acknowledges and agrees that the confidential information received by it from the other Party shall be kept strictly confidential and shall not be disclosed or revealed to any other person other than those employees of such Party who needs to know the confidential information for the purpose of performing their respective obligations under this Agreement and such employees shall take appropriate steps to keep secret all information provided to them. <br>
In the course of negotiation of and carrying out its obligations under this Agreement, a party may disclose to the other party certain Confidential Information.  As used herein, the term "Confidential Information" means:<br> (a) information regarding a party's financial condition, present or future workforce expansion or reduction plans, information systems, employees,  applicants, data subjects, business operations, geographical expansion plans and/or strategies, hiring policies and/or practices, product information, and marketing and distribution plans, summarized in writing as confidential prior to or promptly after disclosure to the other party;<br> (c) any and all related summaries, research and/or reports; <br>(d) any and all designs, ideas, concepts, and technology embodied therein; and <br>(e) the provisions of this Agreement.  By way of example and not limitation, CLIENT acknowledges and agrees that the Information Products/Services constitute Confidential Information of Service Provider.  The term "Confidential Information" excludes any information that the receiving party can demonstrate: <br>(i) is or becomes available to the public other than by a breach of this Agreement; <br>(ii) was previously known to the receiving party without any obligation to hold it in confidence; <br>(iii) was received from a third party free to disclose such information without restriction; <br>(iv) is or was independently developed by the receiving party without the use of the other party's Confidential Information; or <br>(v) the other party has consented in writing to disclosure of such information, but only to the extent of such consent.  Each party will use the other party's Confidential Information only for the limited purpose of and as necessary to carry out its obligations under this Agreement and applicable law, and will not alter, copy, misappropriate, use or misuse, transfer, sell, deliver, or divulge Confidential Information for any other purpose whatsoever, unless required to do so by applicable law.  Each party will treat the other party's Confidential Information as the other's trade secrets and will not disclose it to any third party without the other party's prior written consent, unless required to do so under applicable law.  Each party will disclose Confidential Information only to those of its employees and agents whose duties require access to such information and then only for the purposes contemplated by this Agreement.  Each party's Confidential Information is and will remain its sole property.  Neither party obtains any ownership or license interest in any of the other's Confidential Information by virtue of its disclosure under this Agreement.  All Confidential Information is provided "AS IS" and without any warranty, express, implied, or otherwise, regarding such Confidential Information's accuracy or performance. Each party will return to the other or destroy, at the disclosing party's option, and retaining only such copies as are required to comply with applicable legal, accounting, record-keeping requirements, all of the other's Confidential Information in its possession or control, within thirty (30) days after: <br>(i) termination of this Agreement, or <br>(ii) the other party's request at any other time.  The parties acknowledge that the harm caused by the wrongful disclosure of Confidential Information will be difficult, if not impossible, to assess on a monetary basis alone, and that legal damages may not be sufficient compensation for such wrongful disclosure. 
<br>
<h2>14.0 GOVERNING LAW AND ATTORNEY FEES  </h2><br>
This Agreement shall be governed in all respects by the laws of the Singapore.  Each party irrevocably consents to the exclusive personal jurisdiction of the Courts located in Singapore, as applicable, for any matter arising out of or relating to this Agreement. If any dispute arises between the parties with respect to the matters covered by this Agreement which leads to a proceeding to resolve such dispute, the prevailing party in such proceeding shall be entitled to receive such prevailing party's reasonable attorney's fees, expert witness fees, and out-of-pocket costs incurred in connection with such proceeding, in addition to any other relief to which such prevailing party may be entitled.<br> 

<h2>15.0 ENTIRE AGREEMENT, WAIVER MODIFICATION</h2><br>
This Agreement represents the complete and exclusive statement of the Agreement between the parties and supersedes all prior agreements and representations between them concerning the subject matter of the Agreement. No term, provision or breach of this Agreement will be considered waived by Service Provider, unless such waiver or consent is in writing signed by Service Provider.  The waiver by Service Provider of any breach of the Agreement by CLIENT shall not operate or be construed as a waiver of, consent to, or excuse of any other or subsequent breach by CLIENT.  This Agreement may only be amended by mutual written agreement of the parties. In the event of any conflict between the provisions of any Statement of Work and this Agreement, the terms and conditions of this Agreement shall control.  <br>
<h2>16.0 INJUNCTIVE RELIEF  </h2><br>
A breach of any of the promises or agreements contained herein will result in irreparable and continuing damage to Service Provider for which there will be no adequate remedy at law, and Service Provider shall be entitled to injunctive relief and/or a decree for specific performance, and such other relief as may be proper (including monetary damages if appropriate).  <br>

<h2>17.0 FORCE MAJEURE</h2><br> 
Neither party will be responsible for failure or delay in performance under this Agreement if the failure or delay is due to force majeure events, labor disputes or strikes, government actions or omissions, fire, riot, war, floods, strikes, civil disturbance, terrorism, acts of God or nature, labor disputes or power, communications, satellite or network failures or failure of third party suppliers or licensors or any other causes beyond the reasonable control of the non-performing party

<br>

<h2>18.0 STANDARD OPERATING PROCEDURES </h2><br> 
Service Provider standard operational procedures are part of this Agreement and attached hereto as Schedule B. 
<br>
19.0 NOTICES <br>
	a.	All notices and other communications to be sent by either Party to the other shall be duly communicated if delivered to the other Party at its address stated above in writing provided that either Party may any time designate a different address to which notices or other communications are thenceforth to be sent.<br>
	b.	Any notice, documents or other writing required by this Agreement to be given or sent shall be deemed to have been duly given or sent if it is delivered in person to the addressee or sent by telex or facsimile or e-mail and received by the addressee.<br>

<h2>COUNTERPARTS </h2><br>  
This Agreement may be executed in counterparts, but each of these counterparts shall, for all purposes, be deemed to be an original, and both counterparts shall constitute one and the same instrument.                     
        <br>
IN WITNESS WHEREOF, the parties have executed this Agreement effective on the day month and year as above written.

 
		
		
 <br> <br>
<b>Signed</b>: <?php if($data2['client_ip']){echo $data2['client_ip'];}else{echo ' - ';}?> ON <?=$comInfo['name']?>, Date: <?=date("l jS \of F, Y",strtotime($data2['send_date']))?> <br>
<b>Name:</b> <?=$user_name?>, <b>Title:</b> CEO    <b>Email:</b>  <?=$user_email?> <br>
 For and on behalf of <?=$comInfo['name']?> <br> 
<b>Effective Date:</b> <?=date("l jS \of F, Y",strtotime($comInfo['agsdate']))?>  <br>
 <br> <br>

<h2>1. 	Date of the Agreement</h2><br>  
	Commencement Date: <?=date("d",strtotime($data2['send_date']))?> day of <?=date("F",strtotime($data2['send_date']))?> 2016

<h2>2.	Scope of Work</h2><br>  
 
 
 
    <table class="table table-striped table-bordered">
    	<thead>
        		<th><b>Components</b></th>
                <th><b>Description (All rates are exclusive of taxes)</b></th>
                <th><b>Jurisdiction</b></th>
                <th><b>Cost Per Check (USD)</b></th>
                
        </thead>
        
        <tbody>
            	<!--<tr>
              
                	<td align="center" colspan="8">A)	FOR NEW HIRING</td>
                
                </tr>	-->
                <?php $compids = $data2['comps_id'];
				 $clients_checks = $db->select("client_agreement","*","com_id=$compids and qoutation_num = '$qout_num'");
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

 
 
 
 *The qualification issuing authority may charge anything other than their own fee for verification of documents. All such charges are additional to the verification service charge and will be borne by the client. The charge, if any, would be communicated to the client accordingly<br>  
<h2> 3.	Mandatory Documents for Education Check</h2><br>  
-	Degree certificate copy<br>  
- 	Mark sheet/Transcript of last qualification <br>  
-	Other pre-requisites as per the mandatory requirements of educational institutes / universities<br>  
-	Full Name, Father's name and complete address<br>  
-	National ID / Passport <br>  

<h2>4.	Unaccredited Educational Institutions</h2><br>  

Service Provider will try and verify the accreditation of universities prior to verification of the qualifications. Service Provider will use a combination of known negative & positive lists available to assess the credibility of the university / institution from which the degree / certificate has been obtained.
If the university / institute appear does not appear on the accreditation body's positive list, the Service Provider will mark that university / institute as unaccredited. Service Provider will also refer to the international list of accredited universities and/or institutes where applicable. 
In such case the service provider is submitted with an unaccredited degree / diploma and that the service provider performs due diligence to protect its reputation, the client will be liable to pay the full fees of that check as there will be comprehensive University Research Report submitted to the Client for their information and records.
If the client wants to submit any other degree or diploma of the same employee / candidate who was identified holding a degree issued by an unaccredited institute, then the client may request the same however that check cannot be treated as a replacement rather it will be treated as a new order. 

 <h2>5.	Timeliness</h2><br>  
All verifications are subject to the confirmation of qualification by the issuing authority, hence, a definite processing time or TAT cannot be guaranteed. However, we aim to process all such requests at our earliest, once a confirmation is received from the awarding body.
However, the TAT trends of Qualification Verification usually completed within 20 to 30 business days since written confirmations from Universities may take time. Other than educational and qualification checks, other verifications usually take 10 to 12 business days to complete. 
Turnaround Time (TAT) may be adversely affected by:<br>
-	Unresponsiveness from outside parties<br>
-	Court, employer or educational institution procedure in certain jurisdiction<br>
-	Natural disaster<br>
-	Depend on law and order situation<br>

Extended holiday periods such as summer and winter vacations, enrolments & admissions, examinations, festive occasions such as Eid, Christmas and Diwali may also affect the turnaround time (the records department of many universities are closed for several days over the summer). 
<br>There will be a specific timeline for cases /checks received in quantity above 100 checks in a month together as a batch. In the event of a delay due to third parties being unavailable or uncooperative, a supplementary report will be provided once these enquiries are completed
<h2 align="center">Special Terms and Conditions<br>
& <br>
Operational Procedure
</h2><br>
 <h2>Client Obligation</h2>
 <br>
Client will ensure that the Candidate/Subject particulars uploaded on the portal are scrutinized by its HR representative to ensure compliance and complete pre-requisite/supporting documents are attached / uploaded.
<br>
As soon as the other Insufficiencies and other than previously communicated requirements of the Issuing / qualification awarding Authority are raised through the SERVICE PROVIDER it will be communicated to Client HR-POC via email / phone call, the Client will ensure that these are cleared within a week.
<br>
Client will agree that the 'go-ahead' instructions for Current checks are sent to SERVICE PROVIDER once the check / order has been submitted through online portal. If there is a need to cancel such submitted request or any modification is required, then the Client will have time till 12 noon / mid day of the next working day from the date of submission. If the Service provider POC was not informed about the cancelation before the end of the set timeline, the check will be considered as initiated and any cancel or withdrawn request cannot be processed hence the check will pass through the entire verification process and will remain billable. 
<br>
Client will review issues pending approval or closure from their side on a weekly basis to prevent any further delays.
<br>
Client will inform SERVICE PROVIDER via written letter/email authorizing Clients HR-POC to receive hard copies of all the degrees/certificates and employment letters on behalf of client on monthly basis.
<br>
Client will ensure the proper handling, confidentiality and security of all the verification documents received from SERVICE PROVIDER either in soft copy or hard copy form.
<br>
 
 <h2> Timelines </h2>
<br>
The Turn Around Time (TAT) is calculated only after the Candidate/Subject Consent Letter and complete pre-requisite/ supporting documents are sent to SERVICE PROVIDER.
<br>
Whenever a delay is envisaged, these will be intimated to Client for an extension of TAT, with clear information on the reason for the delay.
<br>
 
 <h2>Submission</h2>
<br>
CLIENT will upload a list of candidates/employees/subject for whom the verification needs to be carried out identifying the verifications required for each individual on SERVICE PROVIDER on line portal with the candidate / employee / subject National ID / Passport number and Employee Code/ID as assigned by CLIENT. Credentials required for verification will be shared by CLIENT via Service Provider's online portal in the form of scanned copies of all pre-requisite and verification documents.  
If the uploaded details and scanned copies of all pre-requisites are incomplete and do not have all the necessary documents, and/or the scanned copies are not clear, etc. the application will not be accepted and the Client will be requested to ensure all the requirements are met prior to submission.
<br>The cases will be initiated by Service Provider within 24 working hours from the time the applications are received, subject to all mandatory documents are provided and there are no insufficiencies. If we receive cancellation request from client after processing the check / case, we will close it as "Cancelled but processed" and it will be charged as per the agreed rates.

 <h2>SVerification Application Form, Authorization and Consent Letter </h2> 
<br>
CLIENT will provide the Service Provider with a copy of the Verification Form a sample is available on the SERVICE PROVIDER online portal. CLIENT certifies that, prior to requesting employment screening services from Service Provider, CLIENT will provide authorization letter to Service Provider, whereby authorizing the Service Provider to conduct the background screening services on behalf of the Client on client`s employees/applicant/data subject. CLIENT will also provide authorization letter to Service Provider for each Employee/ Applicant/Data Subject with a written notice statement, advising the Data Subject of their rights (in accordance with relevant International Data Privacy Protection) and that his or her personal data will be used to enable Service Provider to provide the Background Screening Services to CLIENT. CLIENT further certifies that, prior to requesting Service Provider to provide any employment screening services CLIENT will obtain written consent (which is given voluntarily and has not been withdrawn) from each employee/applicant/Data Subject for transferring, exporting and processing of his or her personal information.  Service Provider will not be able to begin the national/international search process until it has received the required authorization and consent letters. Service Provider reserves the right to decline service requests based upon judicial, legislative, and statutory restrictions within the origination jurisdiction for any data.
<br>
  <h2>Illegible and incomplete information </h2>
<br>
All the insufficient checks will be reverting back to client via system where there is insufficiency such as unreadable copy of documents or any other nature, it will be returned to Client as insufficient check. The TAT for checks with insufficiency will be calculated from the date the insufficiency is fulfilled that will be recorded by the system audit logs.   
<br>
 
 <h2>Number of Attempts</h2> 
<br>
It is recognized that there is a trade-off between the turnaround time and completing the verification. It is unacceptable to all parties in the process if verifications are left open for many months in the hope that it can be completed. A defined number of attempts to complete each verification will thus be adhered to:<br>
The process would be as follows: 
-	Service Provider will attempt to contact each university and/or educational institute and/or employer a maximum of four (4) times over a period of 15 calendar days. 
- 	Service Provider will ensure the verification attempts are made on different days and at different times and using a variety of methods (phone, email, fax, etc.). <br> 
- 	If after those four (4) attempts the verification has not been completed, Service Provider will mark the status of the check as "No response from source".  <br>
All open checks aging 45 calendar days either for any reason will be closed. We will charge the client if it is closed because of the reason that client is unable to provide additional information required by the source where the SERVICE PROVIDER submitted the fees and completed all formalities required for that verification. However, if client wishes to pursue such checks, the check will be considered as new request and turnaround time will commenced from the date of re-initiation - there will be no additional charges if the Issuing Authority accepts our request for reinitiating the check on the grounds of updated information. <br> 
If Service Provider receives verification after a check has already been classified as "No response from source", the Service Provider will update the status of the check and accordingly resubmit the report to CLIENT.
<br>
 
<h2> Common Problems</h2>
<br>
Some universities / Colleges / Educational institutes / Employers are non-cooperative, some are located in "problem states" e.g. Some areas currently facing problems with insurgency, some require longer processing times due to poor infrastructure, and some institutes demand unusually high and unreasonable fees for verification etc. 
"Problem states", for the purposes of this program are any states where there is an impending conflict, or lies in a war torn region, is undergoing civil unrest, has a very undeveloped communications infrastructure, etc. CLIENT will be informed of these states which fall under this category in the monthly report.<br>
It should be recognized that the Service Provider has no control over these institutions and other third parties and cannot compel them to cooperate with the program in a timely manner, or even at all. It should also be recognized that institutions do, very occasionally, provide false results to us due to poor or wrong filing, the age of records, the archiving of records, the amalgamation of institutions, and movement of staff or human error. The Service Provider cannot be held responsible for such errors.<br>
Large application lots or bulk requests – The turnaround time can be maintained by Service Provider when the volume is received daily as per projections. In the event of bulk request being sent or sudden increase in volume the Turnaround time will be impacted therefore all such bulk requests should be informed to the service provider in advance and that batch will be having a separate timeline understanding based on the service provider and the clients mutual agreement on case to case basis. <br>

 
<h2> Locating Contact Information for Verifications</h2>
<br>
Service Provider will independently attempt to locate the contact information of universities, colleges, educational institutions and employers.
Service Provider will do so by referencing internal databases, searching online telephone directories, conducting a web search, etc. However, if independent research does not provide any results and the details provided by the Applicant are incorrect or all attempts to contact the university, college, educational institute, employers etc. fail, then Service Provider will close these checks as "No response from source". 
<br>
 
 <h2>Verification Details</h2>
<br>
Service Provider will attempt to verify the authenticity of the documents as submitted by the Client. 
Any material discrepancy in the applicant's claims and the actual findings will be flagged as "Red" e.g. discrepancy in meeting requirements such as internship, training, dissertation etc. which prevents a person from receiving the said qualification, title and/or certificate as highlighted by the institution will also cause the case to be classified as "Red".
Service Provider's Document Verification System uses a robust "Duplication Tracker" to identify duplicate applications by the same individual. This in-built logic helps the associates to identify and highlight repeat applicants. When a new application is entered into the system, the system automatically cross-checks against all the existing records in the system for a duplicate record. If the new application has the same Date of Birth and National ID / Passport Number as any existing record - this information is immediately highlighted on the system. Further, in case of a duplicate record being highlighted, the case would go through an enhanced quality check process and would get flagged appropriately to CLIENT
<br>
 
  <h2>Verification Result </h2>
<br>
Service Provider will receive verifications from universities, employer, regulatory authorizes, internal / external sources etc. in either verbal or written format.<br> 
Service Provider will endeavor to provide the contact details of the verifier. The following information of the verifier will be captured. 
-	Name<br>
-	Title/Designation<br>
-	Department<br>
-	Contact Number<br>
The verification results will be categorized into three color codes:
<br>
 
 Green
Amber  
Red  
<br>
 The report for each case will be in PDF format and sent via email to the designated CLIENT personnel.
The verification report only sets out information obtained from records searched by the service provider. No opinion will be provided in respect of the individuals who are the subject of the report. The verification report does not constitute recommendations as to what action should be taken in this matter. It is difficult to verify all aspects of the information obtained due to the nature of the enquires and the limitations of obtaining such information from private databases and public records. This whilst due care has been taken to ensure the accuracy of information contained in such report. All personal data supplied in such reports is intended to be for the sole purpose of client evaluation and will not intended for public dissemination.
<br>
   <h2>Information Security  </h2>
<br>
Quality, Data Security and Compliance: 
All the research and verification facilities participated in the verification are ISO 9001:2008 Certified and have developed and maintains a Quality Management System (QMS) in accordance with ISO Standards to deliver quality products and services as well as maintaining an environment that fosters customer satisfaction and continual improvement. 
<br>
Confidentiality is ensured by following guidelines below:<br>
-	Controlled and role based access to users (Need to Know basis).<br>
-	Signing of Non-Disclosure Agreement (NDA) and Intellectual Property Agreement (IPA)<br>
-	Complex Password Policy is maintained with a validity period.<br>

<h2> Incoming Volume</h2>
<br>
In order to assist in planning resources, it is recommended that CLIENT makes all reasonable attempts to notify Service Provider of any particularly increase in the anticipated volume of checks that is above 90 checks as a batch in one go. 
<br>
<h2> Third Party Documentation</h2>
<br>
Service Provider cannot rely on third party documentation e.g. notarized copies, attested copies, etc. Service Provider will conduct independent, direct checks with the source of the documentation without referring to the above said documents.
<br>
 <h2>Discrepancies in application form and attached documents</h2>
<br>
There are sometimes discrepancies between the information that applicants provide on their verification form and the information provided on the attached documents.<br>
CLIENT should ensure that the documents collected are relevant or match the information provided in the verification form. However, should there be occasions where Service Provider receives applications with discrepancies via CLIENT; Service Provider will proceed with the verification of the attached documents.
E.g. If the applicant has mentioned his qualification attained as Degree in Mechanical Engineering in the application form and the document attached is of Bachelor of Science in Mechanical Engineering, the Service Provider will proceed with the check and when closing the check will enter the qualification attained as verified by the university which would be Bachelor of Science in Mechanical Engineering in the example being assumed.
<br>
 
 <h2>Information to law entities and/or authorities </h2>
<br>
Service Provider will ensure all information with respect to the applicant and the subsequent verification results are safeguarded with highest level of security / confidentiality. However, if we are legally compelled to provide such information to any government or judicial bodies we will be bound to comply and would keep CLIENT informed of any such requests (unless legally prohibited from doing so).
 <br>
<h2> Original document handling</h2>
<br>
There are exceptional cases where the issuing authorities require original degrees to be produced before them. As a group policy Service Provider does not take responsibility of original documents because in the event produced original degree is found forged, the issuing authority ceases / retains / discard / cancels out the document and original degree can't be returned to the applicant. To facilitate the verification of original degrees, Service Provider shall nominate its representative that will facilitate and accommodate CLIENT's representative throughout the verification process.
<br>

<h2>General Provisions</h2>
<br>
Services are provided to the Client solely as part of the Client's background screening, enhanced due diligence, anti-money laundering/corruption and/or fraud prevention under Know your customer, Know your third party and Know your employees programs, and should not be exclusively relied upon by the Client to make decisions, whether about entering into any form of business relationship with the subject of any Service or any related parties, or otherwise. The Client must always use and retain the information in a lawful and proper manner.
<br>








 
       </div>
         <br /><br /><br />
         <div> <?php //print_r($_REQUEST); ?>
         
<script type="text/javascript" src="scripts/jquery-latest.js"></script>
<script type="text/javascript">$(document).ready(function(){
 <?php
 		 if($_REQUEST['rejectagreement'] == 'Yes')
		 {

 ?>
 
  $('#forfeedbacks').trigger('click');

 <?php
 }
 ?>});
 function valueChanged(){
    if($('.coupon_question').is(":checked"))   
       { 
	   $("#approved").removeClass('disabled');
	   $("#reject").removeClass('disabled');
	   }  
    else {
       // alert("Please accept term and conditions.");
	   $("#approved").addClass('disabled');
	   $("#reject").addClass('disabled');

	}
 }
</script>
<style>
a.disabled {
   pointer-events: none;
   cursor: default;
}
</style>
         <?php 
         $getClUser = getUserInfo($data2['agr_receiver']);
		  
if($data2['agr_status'] == 1)
{
	
	if($data2['is_user_exists'] == 1)
		{
?>

<input type="text" name="fname" value="" placeholder="First Name" />
  <input type="text" name="lname" value=""  placeholder="Last Name" />
<?php
		}
?>
<input class="coupon_question" type="checkbox" name="coupon_question" value="1" onchange="valueChanged()"/>
		 I read this Quotation.
                 <div id="buttonssec">
                    <a href="#" class="btn bg-success heading-btn disabled " id="approved" data-toggle="modal" data-target="#agreement_accept" onclick="check_checked();"> <span>Accept Quotation</span></a>
                     <a href="#" class="btn bg-success heading-btn disabled"  id="reject"  data-toggle="modal" data-target="#agreement_reject" onclick="check_checked();">         <span>Reject Quotation</span></a>
                     </div>
<?php
}
else{
	if($data2['agr_status'] == 2)
	{
		echo "You have Approved Quotation.";
	}
	else if($data2['agr_status'] == 3)
	{
		echo "You have Reject Quotation.";
		if($data2['reject_fback'] != '')
		{
			echo "<br>Reason :<br><b>".$data2['reject_fback']."</b>";
		}
	}
}
?>					 
                  <!-- </form>-->
 <div class="modal fade in" id="agreement_accept" role="dialog" >
    <div class="modal-dialog">
       <div class="modal-content">
        <div class="modal-body">
          <div class="form-group" style="font-size:14px;">
                   Are you sure you want to approve this Quotation?
            </div>
         </div>
        <div class="modal-footer">
           
                   <input type="hidden" name="comid" value="<?=$comInfo['id']?>" />
                  <input type="submit" name="acceptgreement" class="btn bgc-success btn-xs "  value="Yes" />
                    
        </div>
      </div>
     </div>
  </div> 
 <div class="modal fade in" id="agreement_reject" role="dialog" >
    <div class="modal-dialog">
       <div class="modal-content">
        <div class="modal-body">
          <div class="form-group" style="font-size:14px;">
                   Are you sure you want to Reject this Quotation?
            </div>
         </div>
        <div class="modal-footer">
           
                   <input type="hidden" name="comid" value="<?=$comInfo['id']?>" />
                   <input type="submit" name="rejectagreement" class="btn bgc-red btn-xs mr-5"  value="Yes" /> 
                 
        </div>
      </div>
     </div>
  </div> 
                  
                  </div>   
                  </form>
    <?php	
		
		
		 
 		}
		else
		{
			echo 'Quotation have expired/ suspended. Please contact to BCG.';
		}
		
		}
		else
		{}
		


	}

 
	else
	{
		echo 'No Record Found.';
	}

?>
</div>

</div>

</div>
</div>
</div>

</div>
