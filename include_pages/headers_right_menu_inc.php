<?php
	if(isset($_POST['submitprods']))
	{
			   	
									$tabl = "coupon_code cc INNER JOIN users u ON cc.usr_email_add=u.email ";

	 
		$agreement_confg = $db->select($tabl,"cc.coupon_code,cc.coupon_type,cc.max_count_use,cc.use_count,cc.valid_from,cc.valid_to","u.email='".$_SESSION['email']."' and cc.max_count_use <> 0 and cc.max_count_use > cc.use_count ");
			if(mysql_num_rows($agreement_confg) > 0)
			{
				$alldata = mysql_fetch_assoc($agreement_confg);
				$use_count  = $alldata['use_count']+1;
				$coupon_id  = $alldata['id'];
				
				 
				//print_r($_POST);
			$com_id = $COMINF['id'];
			$user_id = $_SESSION['user_id'];
			$prod_name = $_POST['product'];
			
			$isUpdate = $db->update("use_count='$use_count'","coupon_code","id=$coupon_id");
			
			
				 $cols="comp_id,user_id,check_id,check_name";
				 
				 $values="'$com_id',$user_id,'','$prod_name' ";
				
				  $db->insert($cols,$values,"user_coupon_detail");
				
				
				
				
				
				
				
				
				
				

	//require('forpdfs/fpdf.php');	
$url = "https://secure.datadirectnow.com/webservice/default.cfm";
$post_string='REQUEST=<?xml version="1.0" encoding="UTF-8"?>
<OrderXML><Method>SEND ORDER</Method><Authentication><Username>DThanvi</Username><TestMode>YES</TestMode><Password>Risk2015</Password> 
</Authentication><ReturnResultURL>https://backcheckgroup.com/tery_api/api_tery.php</ReturnResultURL>
<OrderingUser></OrderingUser><Order><BillingReferenceCode>
</BillingReferenceCode><Count></Count><Subject><FirstName>'.$_REQUEST['FirstName'].'</FirstName><MiddleName>'.$_REQUEST['MiddleName'].'</MiddleName>
<LastName>'.$_REQUEST['LastName'].'</LastName><Generation></Generation><DOB>'.$_REQUEST['DOB'].'</DOB><SSN>'.$_REQUEST['SSN'] .'</SSN>
</Subject> 
<OrderDetail ServiceCode="SSNTrace" OrderId="'.rand(0,5191525418941515648).'">
</OrderDetail>
</Order></OrderXML>';
$header  = "POST HTTP/1.0 \r\n";
$header .= "Content-type: text/xml \r\n";
$header .= "Content-length: ".strlen($post_string)." \r\n";
$header .= "Content-transfer-encoding: text \r\n";
$header .= "Connection: close \r\n\r\n"; 
$header .= $post_string;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
//curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
 $data = curl_exec($ch);
 file_put_contents('lasttest.log',$data,true);
//$mypix = new SimpleXMLElement($data);
 //print_r($xml);die;
 $xml = new SimpleXMLElement($data);

    $mypix = simplexml_load_string($data);
$status = $xml->Status;
$ReferenceNumber = $xml->ReferenceNumber;
$FirstName = $xml->Order->Subject->FirstName;
$MiddleName = $xml->Order->Subject->MiddleName;
$LastName = $xml->Order->Subject->LastName;
$DOB = $xml->Order->Subject->DOB;
$SSN = $xml->Order->Subject->SSN;
$ServiceCode = $xml->Order->OrderDetail['ServiceCode'];
$CRAorderId = $xml->Order->OrderDetail['CRAorderId'];
$repStatus = $xml->Order->OrderDetail->Status;
$order_status = $xml->Order->OrderDetail->Status;
$AddressCount = $xml->Order->OrderDetail->Result->AddressCount;
$isvalid  = $xml->Order->OrderDetail->Result->Summary->isValid;
$StateName = $xml->Order->OrderDetail->Result->Summary->StateName;
$YearIssued = $xml->Order->OrderDetail->Result->Summary->YearIssued;
$DeathIndex = $xml->Order->OrderDetail->Result->Summary->DeathIndex;
$dateof=($xml->Order->OrderDetail->Result->Summary->DeathIndex=='No'?"N/A":$xml->Order->OrderDetail->Result->Summary->DeathIndex);

 ?>
 <a href="javascript:;" class="btn btn-link btn-float has-text" data-toggle="modal" data-target="#getstarted"><i class="icon-ticket text-primary"></i> <span>See Report</span></a>
                              
                <div class="modal fade in" id="getstarted" role="dialog" >
                    <div class="modal-dialog">
                       <div class="modal-content">
                        <div class="modal-body">

 <div class="modal-body">
 <div class="report-page" id="exPDF">
<!--[if lte IE 8]>
		<p class="iemessage">We noticed that you are using old version of  Internet Explorer. BackCheckGroup is designed to work best with Internet Explorer 9 and higher.<br />We recommend you visit the <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie"> Internet Explorer website</a> to upgrade to a newer version of the browser.</p>
		<![endif]-->
  <header class="head_logo">
	  <div class="logo"><img src="<?=SURL?>img/logo3.png" alt="BackCheckGroup" width="74px"> 
		  <div class="logo_in"><strong> Background Check Pte Ltd</strong><br>
				  30 Cecil Street, #19-08 Prudential
				  Tower, Singapore 049712<br>
				  Phone: +65 3108 0343</div>
	  </div>
	  <div class="col-6 pull-right text-right right-customer">
		  <strong>Customer Care</strong><br>
support@backcheckgroup.com<br>
Toll Free +1 888 983 0869<br>
<span class="text-red">CONFIDENTIAL</span>
	  </div>
  </header>
	 <?php /*?> <h1 class="fl h5">
		  <?php 
		  foreach ($mypix->names->name as $pixinfo):
		  if($pixinfo['nameTypeCode']=='AN'){ echo $pixinfo['name'];}
		  endforeach;
		  ?>
		<span class="comp-no">Company No.: <?=$mypix['crefoid']?></span>
	 </h1><?php */?>
	 
	 
	  
	  <section class="col-12">
	  <div class="accrd">
		  <h5>Verification Summary<span class="pull-right">Date Ordered: <time datetime="2012-10-20"><?=date("d-M-Y")?></time></span></h5>
		  
		  <div class="accrd_inner">
			  <ul>
					 <li class="col-12"> 	<?php 
						  foreach ($mypix->contacts->contact as $pixinfo):
						  if($pixinfo['contactTypeCode']=='T'){ $telephone=$pixinfo['name'];}
						  if($pixinfo['contactTypeCode']=='W'){ $website=$pixinfo['name'];}
						  if($pixinfo['contactTypeCode']=='F'){ $fax=$pixinfo['name'];}
						  endforeach;
		  foreach ($mypix->names->name as $pixinfo):
		  if($pixinfo['nameTypeCode']=='AN'){ echo "<span>".$pixinfo['name']."</span>";}
		  endforeach;
		  ?></li>
			  <?php /*?><?php foreach ($mypix->addresses->address as $pixinfo): ?>
				  <li><span>Zipcode:</span>  <?=$pixinfo['zipCode']?></li>
				  <li><span>Country:</span> <?=$pixinfo['countryText']?></li>
									 
			  <?php print_r($pixinfo);  endforeach; ?><?php */?>
			   <li class="col-6"><span>Service: </span><?=$ServiceCode?></li>
			   <li class="col-6 pull-right"><span>Report ID : </span><?=($ReferenceNumber!=''?$ReferenceNumber:'-')?></li>
			   <li class="col-6"><span>Search ID: </span><?=$CRAorderId?></li>
			   <li class="col-6 pull-right"><span> Status
: </span><?=($repStatus!=''?$repStatus:'-')?></li>
			  
			   <li class="col-6"><span>FirstName: </span><?=$FirstName?></li>
			   <li class="col-6 pull-right"><span>MiddleName: </span><?=($MiddleName!=''?$MiddleName:'-')?></li>
			   <li class="col-6"><span>LastName: </span><?=$LastName?></li>
			   <li class="col-6 pull-right"><span> DOB: </span><?=($DOB!=''?$DOB:'-')?></li>
			   <li class="col-6"><span> SSN:</span> <?=$SSN?></li>
			   <li class="col-6 pull-right"><span> Is Valid: </span><?=($isvalid!=''?$isvalid:'-')?></li>
			   <li class="col-6"><span> StateName: </span><?=$StateName?></li>
			   <li class="col-6 pull-right"><span> Year Issued: </span> <?=$YearIssued?></li>
			   <li class="col-6"><span> On Death Index : </span><?=$DeathIndex?></li>
			   <li class="col-6 pull-right"><span>Date of Death: </span> <?=$dateof?></li>
			  </ul>
			  
			  <div style="clear:both;"></div>
				 
		  </div>
	  
	  </div>
	  </section>
	  
		  <?php $array=array(); $i=0; $try=2; 
					 foreach($xml->Order->OrderDetail->Result->Individual as $info){ ?>
	  <?php
	   
		   if(in_array($info->FirstName.$info->LastName.$info->MiddleName,$array)){}else{ $array[]=$info->FirstName.$info->LastName.$info->MiddleName;  ?>
<section class="col-12 <?=$i?>">
	  <div class="accrd">
		  <h5><?php echo $info->LastName.",".$info->FirstName." ".$info->MiddleName."<span class='pull-right'>"." Date of Birth ".$DOB."</span>"; ?></h5>     <div class="accrd_inner">
	  <ul>  <h6>Addresses on File</h6>       <?php } ?>
			
					  <li  class="col-6"><?=$info->Address."<br>".$info->City.",".$info->State." ".$info->ZipCode?>
					  <?php if($info->County!=''){echo "County of Residence: ".$info->County;} ?>
						  <br />
						  <?php if($info->StartDate->Month!=''){ ?>
						  Dates Reported: from <?=$info->StartDate->Month?>/<?=$info->StartDate->Year?> to <?=$info->EndDate->Month?>/<?=$info->EndDate->Year?> 
						  <?php } else{ echo "<b class='text-red'>RESIDENCE DATES NOT REPORTED</b>";}?>
					  </li>
					  
				  <?php  if(in_array($info->FirstName.$info->LastName.$info->MiddleName,$array)){}else{ ?>
			  </ul>
	  
	  </div> </div>
  </section><?php  } ?>
  
  
	   <?php $i++;  }
					?>
	  
		  <section class="footer_rep">
			  <p style="font-size: 12px;text-align: center;">All BackGround Check services are fully Compliant.</p>
		  </section>
	   
	  </div>
         
      </div>

                         </div>
                         
                      </div>
                     </div>
                  </div>                              

 
 

 <?php

 				
				
				
				
				
			
			}
		//print_r($_POST);
	}
	
?>


<div class="heading-elements">

							<div class="heading-btn-group">
                            <?php
							
                            if($LEVEL==4)
       {
		    
       $com_id = $COMINF['id'];
       $where = "comps_id='".$com_id."' ";
       $agreement_confg = $db->select("client_agreement_confg","*","comps_id='".$com_id."' and is_expired='0' ");
       $data2 = mysql_fetch_array($agreement_confg);
       //print_r($data2);
	   
	     $ts1 = strtotime(date("Y-m-d h:i:s"));
 $ts2 = strtotime($data2['send_date']);

 $seconds_diff = $ts1 - $ts2;

 $days = floor($seconds_diff/3600/24);
 
 if($days > 10)
 {
	$poc_id = $data2['agr_poc2'];
	
	if($data2['agr_poc2_sent'] == 0)
	{
		$db->update("agr_poc2_sent='1',agr_receiver='$poc_id'","client_agreement_confg","comps_id='$com_id'");
		
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

	    if($_SESSION['user_id'] == $poc_id)
	   {
	   
        if($data2['is_suspend_active'] == 1 && $data2['is_send'] == 1)
        {
			
       ?>
        <a href="#" class="btn btn-link btn-float has-text " data-toggle="modal" data-target="#agreement_suspended"><i class="icon-gear text-primary"></i><span>Agreement</span></a>
 
<div class="modal fade in" id="agreement_suspended" role="dialog" >
    <div class="modal-dialog">
       <div class="modal-content">
        <div class="modal-body">
          <div class="form-group" style="font-size:14px;">
                    Agreement Suspended by BCG.
            </div>
         </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
        </div>
      </div>
     </div>
  </div> 
  <?php
        }
        else if($data2['is_suspend_active'] != 1 && $data2['is_send'] == 1)
        {
        ?>
        <a href="?action=agreement&atype=approval" class="btn btn-link btn-float has-text  "><i class="icon-gear text-primary"></i><span>Agreement</span></a>
                             <?php
       }
       else{}
        }
		
		
		 }
		
		 if($_REQUEST['action'] == "dashboard")
		 {
       ?>                                  
                            <a href="javascript:;" class="btn btn-link btn-float has-text sidebar-control sidebar-secondary-hide hidden-xs"><i class="icon-gear text-primary"></i><span>Setting</span></a>
         <?php
		 }
		$all_pages = array("needattention","readyfordownload","allopenedchecks","recentlysubmitted","allinsufficient","allqachecks","allhighrisk","allnorisk");
		   
		if (in_array($_REQUEST['action'], $all_pages)) {
		 ?>
                            <a href="javascript:;" class="btn btn-link btn-float has-text" id="graphtog"><i class="icon-stats-dots text-info"></i><span>Checks Chart</span></a>
					         
                             <?php
		}
		if($_REQUEST['action'] == "details")
		 {
			 // allow only for managers and analyst to add more checks              openticket
			  if($LEVEL == 2 || $LEVEL == 3)
			{
		?>
        <a href="javascript:;" class="btn btn-link btn-float has-text sidebar-control sidebar-secondary-hide hidden-xs" id="graphtog"><i class=" icon-stack-plus text-primary"></i><span>Add More Checks</span></a>
        <?php
		}
		 }
                             if($LEVEL == 4 || $LEVEL == 5)
							 {
							 ?>
                             <!-- <a href="javascript:;" class="btn btn-link btn-float has-text" data-toggle="modal" data-target="#open_ticket"><i class="icon-ticket text-primary"></i> <span>New Support</span></a>-->
                              <a href="javascript:;"  class="btn btn-link btn-float has-text" id="open_ticket"><i class="icon-ticket text-primary"></i> <span>New Ticket</span></a>
                              
                              
                               <a href="javascript:;" class="btn btn-link btn-float has-text LiveHelpButton" id="LiveHelpStatusDefault" name="LiveHelpStatusDefault"><i class="icon-bubbles6 text-primary LiveHelpStatus" id="LiveHelpStatusDefault"></i><span>Live chat</span></a>
                             <?php
							 }
							 
 							 if($_SESSION['user_id'] == 441)
							 {
							$tabl = "coupon_code cc INNER JOIN users u ON cc.usr_email_add=u.email ";
								 
							$agreement_confg = $db->select($tabl,"cc.coupon_code,cc.coupon_type,cc.max_count_use,cc.use_count,cc.valid_from,cc.valid_to","u.email='".$_SESSION['email']."' and cc.max_count_use <> 0 and cc.max_count_use > cc.use_count ");
		  					if(mysql_num_rows($agreement_confg) > 0)
							{
							 $data2 = mysql_fetch_assoc($agreement_confg);
								// print_r($data2);
								 ?>
                              <a href="javascript:;" class="btn btn-link btn-float has-text" data-toggle="modal" data-target="#getstarted"><i class="icon-ticket text-primary"></i> <span>Market Place</span></a>
                              
                <div class="modal fade in" id="getstarted" role="dialog" >
                    <div class="modal-dialog">
                       <div class="modal-content">
                        <div class="modal-body">

 <div class="modal-body">
        <form method="post">
           <div class="form-group">
            <label for="message-text" class="control-label">First Name:</label>
            <input type="text" class="form-control" name="FirstName" id="message-text" /> 
          </div>


           <div class="form-group">
            <label for="message-text" class="control-label">Middle Name:</label>
            <input type="text" class="form-control" name="MiddleName" id="message-text" /> 
          </div>


           <div class="form-group">
            <label for="message-text" class="control-label">Last Name:</label>
            <input type="text" class="form-control" name="LastName" id="message-text" /> 
          </div>

           <div class="form-group">
            <label for="message-text" class="control-label">DOB:</label>
            <input type="text" class="form-control" name="DOB" id="message-text" /> 
          </div>

           <div class="form-group">
            <label for="message-text" class="control-label">SSN # :</label>
            <input type="text" class="form-control" name="SSN" id="message-text" /> 
          </div>


          <div class="form-group">
            <label for="message-text" class="control-label">Select Product:</label>
            
            <select name="product" id="product" class="form-control">
                <option value="SSNTrace">
                    SSNTrace
                </option>
                
            </select>            
            
            
          </div>
           <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="submitprods" class="btn btn-primary" value="Search"> 
      </div>
        </form>
         
      </div>

                         </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                        </div>
                      </div>
                     </div>
                  </div>                              
                                 <?php
							}
							
							 }
							 ?>
                                                              
							</div>
						</div>