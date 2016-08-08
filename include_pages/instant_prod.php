<?php 
 
// FUNCTIONS END HERE
if(isset($_POST['submitselect']))
{
	print_r($_REQUEST);
}

   	   $maxposts = 1;

 function forgetcompletedata($conditions='',$pagination_start=1){

	 $maxposts = 1;
/*	echo $url = 'https://backcheckgroup.com/marketplace/wc-api/v3/products?'.$conditions.'consumer_key=ck_23ca78a75706c2c0c70c4ebe93a3a6070ca2030c&consumer_secret=cs_33b7f9dfab370fee9dcd5e543130b0e5fc9ebb26';
*/ 
	$url = 'https://backcheck.io/wc-api/v3/products?'.$conditions.'filter[offset]='.$pagination_start.'&filter[limit]='.$maxposts.'&consumer_key=ck_d7566c3cb11c8689752fc643405057022278a989&consumer_secret=cs_514a2a27e3a52b2e064709c82201daf37b1afe21';


 $ch = curl_init();
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_URL,$url);
 $result=curl_exec($ch);
 curl_close($ch);
  $asd =  json_decode($result);
	return $asd;
 }

 function for_all_products_count($searches){

    if($searches != "")

   {

	   $searches_data = $searches;

	  }

	  else

	  {

	   $searches_data = "";

		 }

 
	$url = "https://backcheck.io/wc-api/v3/products/count?".$searches_data."consumer_key=ck_d7566c3cb11c8689752fc643405057022278a989&consumer_secret=cs_514a2a27e3a52b2e064709c82201daf37b1afe21";
 
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_URL,$url);

	$result=curl_exec($ch);

	curl_close($ch);

	$asd =  json_decode($result);

	$xx = $asd->count;

	return $xx;

 }

	

 if($_REQUEST['forcats']){

	 $searches = "filter[category]=".$_REQUEST['forcats']."&";
 }else{

	$searches = "";

}

 


if(isset($_REQUEST['submit_ssn'])){
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
 file_put_contents('last.log',$data,true);
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

 <?php


/*$Welcom = 'Welcome to BackGround Check Group';
$verify =$xml->Order->OrderDetail['ServiceCode'];
$footer = ' 2007 - 2015 Background Check Pvt. Ltd.';
$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('only-logo-white.png',1,10,60); $pdf->Ln(); $pdf->Ln(); $pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(180,10,$Welcom,0,0,'C'); 
$pdf->Ln();
$pdf->Cell(180,10,$verify,0,0,'C');
$pdf->Ln();$pdf->Ln();
$pdf->SetFont('times','B',10);$pdf->Ln();
$pdf->Cell(60,10,"Reference Number :");
$pdf->Cell(60,10,$xml->ReferenceNumber);$pdf->Ln();
$pdf->Cell(60,10,"Order Status :");
$pdf->Cell(10,10,$xml->Status);$pdf->Ln();
$pdf->Cell(60,10,"FirstName :");
$pdf->Cell(10,10,$xml->Order->Subject->FirstName);$pdf->Ln();
$pdf->Cell(60,10,"MiddleName :");
$pdf->Cell(10,10,$xml->Order->Subject->MiddleName);$pdf->Ln();
$pdf->Cell(60,10,"LastName :");
$pdf->Cell(10,10,$xml->Order->Subject->LastName);$pdf->Ln();
$pdf->Cell(60,10,"Suffix :");
$pdf->Cell(10,10,$xml->Order->Subject->Suffix);$pdf->Ln();
$pdf->Cell(60,10,"DOB :");
$pdf->Cell(10,10,$xml->Order->Subject->DOB);$pdf->Ln();
$pdf->Cell(60,10,"SSN :");
$pdf->Cell(10,10,$xml->Order->Subject->SSN);$pdf->Ln();
$pdf->Cell(60,10,"Order Detail");$pdf->Ln();
$pdf->Cell(60,10,"OrderId :");
$pdf->Cell(10,10,$xml->Order->OrderDetail['OrderId']);$pdf->Ln();
$pdf->Cell(60,10,"Search ID :");
$pdf->Cell(10,10,$xml->Order->OrderDetail['CRAorderId']);$pdf->Ln();
$pdf->Cell(60,10,"Record Status :");
$pdf->Cell(10,10,$xml->Order->OrderDetail->Status);$pdf->Ln();


if($_POST['service']=='SSNTrace'){
$pdf->Cell(60,10,"Address :");
$pdf->Cell(10,10,$xml->Order->OrderDetail->Result->AddressCount);$pdf->Ln();
$pdf->Cell(60,10,"No of Records :");
$pdf->Cell(10,10,$xml->Order->OrderDetail->Result->AddressCount);$pdf->Ln();
$pdf->Cell(60,10,"Verification Result");$pdf->Ln();
$pdf->Cell(60,10,"Valid :");
$pdf->Cell(10,10,$xml->Order->OrderDetail->Result->Summary->isValid);$pdf->Ln();
$pdf->Cell(60,10,"Issued :");
$pdf->Cell(10,10,$xml->Order->OrderDetail->Result->Summary->isIssued);$pdf->Ln();
$pdf->Cell(60,10,"State Issued :");
$pdf->Cell(10,10,$xml->Order->OrderDetail->Result->Summary->StateName);$pdf->Ln();
$pdf->Cell(60,10,"Year Issued :");
$pdf->Cell(10,10,$xml->Order->OrderDetail->Result->Summary->YearIssued);$pdf->Ln();
$pdf->Cell(60,10,"On Death Index :");
$pdf->Cell(10,10,$xml->Order->OrderDetail->Result->Summary->DeathIndex);$pdf->Ln();
$pdf->Cell(60,10,"Date of Death :");
$dateof=($xml->Order->OrderDetail->Result->Summary->DeathIndex=='No'?"N/A":$xml->Order->OrderDetail->Result->Summary->DeathIndex);
$pdf->Cell(10,10,$dateof);$pdf->Ln();
}
 $pdf->SetY(266);

$pdf->Cell( 0, 10, 'Page No: ' . $pdf->PageNo(), 0, 0, 'R' ); 
$pdf->Cell(-180,0,iconv("UTF-8", "ISO-8859-1", "$footer"),0,0,'C'); 
$pdf->Output();*/
/*echo $text = "<table>	
<tr><td>ReferenceNumber :</td><td>".$xml->ReferenceNumber."</td></tr>

<tr><td>Status :</td><td>".$xml->Status."</td></tr>
<tr><td>FirstName :</td><td>".$xml->Order->Subject->FirstName."</td></tr>
<tr><td>MiddleName :</td><td>".$xml->Order->Subject->MiddleName."</td></tr>
<tr><td>LastName :</td><td>".$xml->Order->Subject->LastName."</td></tr>
<tr><td>Suffix :</td><td>".$xml->Order->Subject->Suffix."</td></tr>
<tr><td>DOB :</td><td>".$xml->Order->Subject->DOB."</td></tr>
<tr><td>SSN :</td><td>".$xml->Order->Subject->SSN."</td></tr>
<tr><td>ReportLink :</td><td>".$xml->Order->ReportLink."</td></tr>
<tr><td><h3>Order Detail</h3></td></tr>
<tr><td>OrderId :</td><td>".$xml->Order->OrderDetail['OrderId']."</td></tr>
<tr><td>CRAorderId :</td><td>".$xml->Order->OrderDetail['CRAorderId']."</td></tr>
<tr><td>Order Status :</td><td>".$xml->Order->OrderDetail->Status."</td></tr>
</table>
";
die;
if(curl_errno($ch))
    print curl_error($ch);
else
	echo $data;*/
}
 
if(isset($_REQUEST['submit_credit']))
{
	//print_r($_REQUEST);die;
		$response=createsession();
		$countryCode=$response->countryCode;
		$createdAt=$response->createdAt;
		$customerID=$response->customerID;
		$sessionID=$response->sessionID;
		$userID=$response->userID;
		$xml='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service/">
		<soapenv:Header/>
		<soapenv:Body>
		<ser:generateReport>
		<reportId>eReportOnline</reportId>
		<crefo>'.$_REQUEST['crefoID'].'</crefo>
		<langid>EN</langid>
		<format>xml</format>
		<sessionId>'.$sessionID.'</sessionId>
		<refnr1>'.$_REQUEST['ref_number_1'].'</refnr1>
		<refnr2>'.$_REQUEST['ref_number_2'].'</refnr2>
		<comment>'.$_REQUEST['Note'].'</comment>
		<providerCountryCode>1000</providerCountryCode>
		<attachedDocumentData>cid:12344</attachedDocumentData>
		</ser:generateReport>
		</soapenv:Body>
		</soapenv:Envelope>';
		$response=doXMLCurl("http://www.crefoport.co.uk/manager/cxf/ManagerService?wsdl",$xml);
		
		//$xml = new SimpleXMLElement($response);
  //$mypix = simplexml_load_string($response);
  
  $doc = new DOMDocument('1.0', 'utf-8');
  $doc->loadXML( $response );
  $XMLresults     = $doc->getElementsByTagName("return");
  $output = $XMLresults->item(0)->nodeValue;
  $ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
	  $output);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$xml = curl_exec($ch);
curl_close($ch);
  $mypix = simplexml_load_string($xml);
//print_r($mypix);
?>
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
	<h1 class="fl h5">
		  <?php 
		  foreach ($mypix->names->name as $pixinfo):
		  if($pixinfo['nameTypeCode']=='AN'){ echo $pixinfo['name'];}
		  endforeach;
		  ?>
		  <span class="comp-no">Company No.: <?=$mypix['crefoid']?></span>
	 </h1>
	 
	 <?php foreach ($mypix->addresses as $pixinfo): ?>
		  Address: <span class="add_rep">Address: <?=$pixinfo->address['door']." ".$pixinfo->address['street']." ".$pixinfo->address['city']?></span>
	 <?php endforeach; ?>
	  
	  <section class="col-12">
	  <div class="accrd">
		  <h5>Company Identification   <span class="pull-right">Date Ordered: <time datetime="2012-10-20"><?=date("d-M-Y")?></time></span></h5>
		  
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
			   <li class="col-6"><span>Zipcode: </span><?=$mypix->addresses->address[0]['zipCode']?></li>
			   <li class="col-6 pull-right"><span>Website: </span><?=($website!=''?$website:'-')?></li>
			   <li class="col-6"><span>Country: </span><?=$mypix->addresses->address[0]['countryText']?></li>
			   <li class="col-6 pull-right"><span>Fax: </span><?=($fax!=''?$fax:'-')?></li>
			   <li class="col-6"><span>Foundation:</span> <?=$mypix->registrations->registration[0]['registrationDate']?></li>
			   <li class="col-6 pull-right"><span>Telephone: </span><?=($telephone!=''?$telephone:'-')?></li>
			   <li class="col-6"><span>Company Number: </span><?=$mypix['crefoid']?></li>
			   <li class="col-6 pull-right"><span>Status: </span> <?=$mypix['status']?></li>
			  </ul>
			  <div style="clear:both;"></div>
				<div class="check-if-no">
				<label><input type="checkbox" class="push--right js--mark" data-htid="77777774"> <b>Mark as OK.</b>
					  (Select this if information will not affect your hiring decision.)
					  <span class="js--reviewed-by additional push-half--top"></span></label></div>
		  </div>
	  
	  </div>
	  
  
  </section>
  
	  <section class="col-12">
		  <div class="accrd">
		  <h5>Solvency index</h5>			  
		  <div class="accrd_inner">
			  <p>
		  
			  
			  </p>
			  <?php if((int)$mypix->rates['rate']!=0){?>
			  <div class="solvency_in">
			  <?php				$title = "";				$rating = "0%";		
			if($mypix->rates['rate'] >= 100  && $mypix->rates['rate'] <= 149)					{						
			$title = "Excellent Solvency";						
			$rating = "98%";					}					
			// very good solvency 150 - 200 					
			 if($mypix->rates['rate'] >= 150 && $mypix->rates['rate'] <= 200 )				
			 	{						
				$title = "Very Good Solvency";
				$rating = "88%";	
				}			
			
				// good solvency		
				if($mypix->rates['rate'] >= 201 && $mypix->rates['rate'] <= 250 ){	
				$title = "Good Solvency";	
				$rating = "78%";}		
							// medium solvency			
				 if($mypix->rates['rate'] >= 251 && $mypix->rates['rate'] <= 300 ){	
				 	$title = "Medium Solvency";	$rating = "68%";
										}// weak solvency	
					 if($mypix->rates['rate'] >= 301 && $mypix->rates['rate'] <= 350 ){	
					 $title = "Weak Solvency";$rating = "58%";}		
					 			// insufficient solvency
					if($mypix->rates['rate'] >= 351 && $mypix->rates['rate'] <= 499 ){		
					$title = "Insufficient Solvency";$rating = "48%";}	
					// business connections rejected
					if($mypix->rates['rate'] >= 500 && $mypix->rates['rate'] <= 600){	
						$title = "Business Connections Rejected";$rating = "38%";}		
									// insolvency	
							if($mypix->rates['rate'] >= 600 ){		
							$title = "Insolvency";$rating = "28%";}?>
			  <span style="left:<?=$rating?>" title="<?php echo $title; ?> (<?php echo $mypix->rates['rate'];?>)"> <?php echo $title; ?> </span>
			  <img src="<?=SURL?>/images/solvience.jpg" />
			  </div>				<?php } ?>
			  <p class="color-dark"><?php echo $mypix->rates['shortDescription']; ?></p>
			  <p> <?php echo $mypix->rates['fullDescription']; ?>.</p>
		  </div>
	  
	  </div>
	  </section>
	  
	  
	  <section class="col-12">
		  <div class="accrd">
		  <h5>Main indices</h5>			  
		  <div class="accrd_inner">
			  <ul>
				  <li><h6>Payment experience and credit opinion</h6></li>
				  <li><span>Credit Limit:</span> <?=$mypix->economicSituation->creditLimit['currency']." ".$mypix->economicSituation->creditLimit['limit']?></li>
			  </ul>
			  <p>
			  <?php  foreach ($mypix->freetexts->chapter as $pixinfo): ?>
			  <?=$pixinfo['text']?>
			  <?php foreach($pixinfo->paragraph as $pixinfo1): ?>
			  <?=$pixinfo1['text']?>
			  <?php endforeach;  ?>
			  <?php endforeach; ?>
		  </p>
		  </div>
	  
	  </div>
	  </section>
	  </div>
	  <div class="report-page" id="exPDF">
	  <h1 class="fl h5">
		  <?php 
		  foreach ($mypix->names->name as $pixinfo):
		  if($pixinfo['nameTypeCode']=='AN'){ echo $pixinfo['name'];}
		  endforeach;
		  ?>
		  
		  <span class="comp-no">Company No.: <?=$mypix['crefoid']?></span>
		</h1>
		  
		  <section class="col-12">
			  <div class="accrd">
			  <h5>Basic information</h5>			  
			  
			  <div class="accrd_inner">
			  <ul>
				  <li><span>Legal form: </span> <?=$mypix['legalFormText']?></li>
				  <li><span>Foundation: </span>  <?=$mypix->registrations->registration['registrationDate']?></li>
				  <li><span>Company No.:</span>  <?=$mypix['registrationNr']?></li>
				  <li><span> Previous Names:</span> <?php foreach ($mypix->names->name as $pixinfo):
		  if($pixinfo['nameTypeCode']=='PN'){ echo $pixinfo['name']."(".$pixinfo['validUntil'].")";}
		  endforeach;?></li>
				  <li><span>Other Known Addresses: <br /></span>  <?php foreach ($mypix->addresses->address as $pixinfo): 
			  if($pixinfo['typeCode']=='O'){
		  echo $pixinfo['longAddress']; }
		  endforeach;?></li>
		  
		  
			  </ul>
		  </div>
			  
			  </div>	                
		  </section>
		  
		   <section class="col-12">
			  <div class="accrd">
			  <h5>Shareholders</h5>			  
			  
			  <div class="accrd_inner">
			  <table class="table-report" width="100%" cellpadding="0" cellspacing="0">
				  <thead>
				  <th>Name</th>
				  <th>Number of Shares</th>
				  <th>Nominal value</th>                    	
				  </thead>
					  <tbody>
				  <?php foreach ($mypix->owners->owner as $pixinfo):
		  echo "<tr><td>".$pixinfo['name']."</td>"."<td>".$pixinfo['shareValue']."</td>"."<td>".$pixinfo['nominalValue']."</td></tr>";
		  endforeach;?>
		  <tbody>
			  </table>
			  </div>
			  
			  </div>	                
		  </section>
		  
		   <section class="col-12">
			  <div class="accrd">
			  <h5>Management Directors</h5>			  
			  
			  <div class="accrd_inner">
			  <table class="table-report" width="100%" cellpadding="0" cellspacing="0">		
				 <thead>                   		
					 <th>Name</th>
					 <th>Date of Birth</th>
					 <th>Address</th>
					 <th>Nationality</th>
					 <th>Appointment Date</th>
					 <th>Position</th>
				 </thead>
				 
				 <tbody>
				  <?php foreach ($mypix->leaders->leader as $pixinfo):
		  echo "<tr> <td>".$pixinfo['name']."</td>"."<td>".$pixinfo['birthDate']."</td>"."<td>".$pixinfo['address']."</td>"."<td>".$pixinfo['nationality']."</td>"."<td>".$pixinfo['appointmentDate']."</td>"."<td>".$pixinfo['typeText']."</td></tr>";
		  endforeach;?>
		  </tbody>
			  </table>
			  </div>
			  
			  </div>	                
		  </section>
		  
		   <section class="col-12">
			  <div class="accrd">
			  <h5>Business activities / Main activity</h5>			  
			  
			  <div class="accrd_inner">
			  <table class="table-report" width="100%" cellpadding="0" cellspacing="0">		
				  <thead>
					  <th>Activity</tH>
					  <th>Description</th>
				  </thead>    
				  <tbody>
				  <?php foreach ($mypix->activities->activity as $pixinfo): 
		  echo "<tr><td>".$pixinfo['activityClass']." </td>"."<td>". $pixinfo['description']."</td></tr>";
		  endforeach;?>
			  </tbody>
			  </table>
			  </div>
			  
			  </div>	                
		  </section>
		
		  <section class="col-12">
			  <div class="accrd">
			  <h5>Economic data Turnover and Employees</h5>			  
			  
			  <div class="accrd_inner">
			  <table class="table-report" width="100%" cellpadding="0" cellspacing="0">		
				  <thead>
					  <th>Date of Accounts</tH>
					  <th>Turnover</th>
					  <th>Employees</th>
				  </thead>    
				  <tbody>
				  <?php foreach ($mypix->turnovers->turnover as $pixinfo): 
				  echo "<tr><td>".$pixinfo['date']."</td><td>". $pixinfo['currency']."</td> <td>".$pixinfo['value']."</td></tr>";
				  endforeach;?>
			  </tbody>
			  </table>
			  </div>
			  
			  </div>	                
		  </section>
		  
		  
			  <section class="col-12">
			  <div class="accrd">
			  <h5>Events</h5>			  
			  
			  <div class="accrd_inner">
			  <table class="table-report" width="100%" cellpadding="0" cellspacing="0">		
				  <thead>
					  <th>Date</tH>
					  <th>Action</th>
				  </thead>    
				  <tbody>
				  <?php foreach ($mypix->events->event as $pixinfo): 
		  echo "<tr><td>".$pixinfo['eventDate']."</td> <td>". $pixinfo['actDescription']."</td></tr>";
		  endforeach;?>
			  </tbody>
			  </table>
			  </div>
			  
			  </div>	                
		  </section>
  
  
  </div>
  
<div class="report-page" id="exPDF">
	  <h1 class="fl h5">
		  <?php 
		  foreach ($mypix->names->name as $pixinfo):
		  if($pixinfo['nameTypeCode']=='AN'){ echo $pixinfo['name'];}
		  endforeach;
		  ?>
		  
		  <span class="comp-no">Company No.: <?=$mypix['crefoid']?></span>
		</h1>
		
		<h3>Accounts</h3>
		
		<section class="col-12">
			  <div class="accrd">
			  <h5>Profit & Loss</h5>			  
			  
			  <div class="accrd_inner">
			  <table class="table-report" width="100%" cellpadding="0" cellspacing="0">		
				  
				  <tbody>
				  <?php foreach ($mypix->leaders->leader as $pixinfo):
		  echo "<tr><td>".$pixinfo['name']."</td> <td>".$pixinfo['birthDate']."</td> "." <td>".$pixinfo['address']."</td> <td>".$pixinfo['nationality']."</td> <td>".$pixinfo['appointmentDate']."</td> <td>".$pixinfo['typeText']."</td><tr>";
		  endforeach;?>
			  </tbody>
			  </table>
			  </div>
			  
			  </div>	                
		  </section>
		  
			<section class="col-12">
			  <div class="accrd">
			  <h5>Financial Ratios</h5>			  
			  <div class="accrd_inner">
			  
			  <table class="table-report fff" width="100%" cellpadding="0" cellspacing="0">
			  <tbody>
			  <tr>
			<?php $inc = 1; foreach ($mypix->financialRatios->ratioSet as $pixinfo):
			 echo "<td>";
			if($inc == 1){
			  echo '<br /> <br /> <br /> <br /> <br /> ';
				  foreach ($pixinfo->ratio  as $pixinfo1):?>
								<?php /*?><table> <tr><td><?=$pixinfo1['valueText']?></td></tr></table><?php */?>
								<div><?=$pixinfo1['text']?></div><br /> <br /> 
						  <?php //endforeach; ?>	
						 <?php endforeach;  
			   
			   }
			   else{ }
				echo "<td>";
		  echo "<td>&nbsp;</td><td><b>".$pixinfo['endDate']." ".$pixinfo['numberOfWeeks']." "." ".$pixinfo['currency']." ".$pixinfo['consolidated']."</b>";
		   
		  //  foreach ($mypix->financials->financialSet as $pixinfo): 
						  foreach ($pixinfo->ratio  as $pixinfo1):?>
							  <table> <tr><td><?=$pixinfo1['value']?></td> </tr></table>
						  <?php //endforeach; ?>	
						 <?php endforeach; ?>
		  <?php echo '</td></b>'; 
		  $inc++; endforeach;?></tr>
		  </tbody>
				  
					   <?php /*?>  <?php foreach ($mypix->financials->financialSet as $pixinfo): 
						  foreach ($pixinfo->finrow  as $pixinfo1):?>
							  <tr><td><?=$pixinfo1['valueText']?></td><td><?=$pixinfo1['financialValue']?></td> </tr>
						  <?php endforeach; ?>	
						 <?php endforeach; ?><?php */?>
				 
		  </table>
			  </div>
			  
			  </div>	                
		  </section>
		
		
		  <section class="footer_rep">
			  <p style="font-size: 12px;text-align: center;">All BackGround Check services are fully Compliant.</p>
		  </section>
		
		</div>
<?php
 
 
}
//  curl_close($ch);
?>














<script>
//
//function selectproducts(prodid)
//{
///*	var asd = $("#product_"+prodid).val();	
//alert(asd);	
//*/var asd = $("#product_"+prodid).val();	
//
//
//  $('#product_'+prodid).change(function(){
//        if(this.checked)
//		{
//			
//			
//			
//         $.ajax({
//				type: 'POST',
//				url: "actions.php",
//				data: 'ePage=add_rating&select_prods=yes&selected=yes&prodid='+prodid,
//				success: function(response){
// 				console.log(response);          
//				// $("#response_msg").show();	
//				// $("#response_msg").html(response);	
// 			 }
// 
//	});
//	
//	
//	
//	
//	
//	
//		}
//		else
//		{
//
//
//			
//         $.ajax({
//				type: 'POST',
//				url: "actions.php",
//				data: 'ePage=add_rating&select_prods=yes&selected=no&prodid='+prodid,
//				success: function(response){
// 				console.log(response);          
//				// $("#response_msg").show();	
//				// $("#response_msg").html(response);	
// 			 }
// 
//	});
//	
//	
//
//
//
//
//		}
//    });
//	//alert(changex);
//	
//			   
//
//
//}

function mainfunction()
	{ 
		var compname = $("#compname").val();
	
 if(compname.length > 4)
 {
		   $.ajax({
				type: 'POST',
				url: "actions.php",
				data: 'ePage=add_rating&companysuggest=yes&compname='+compname,
				success: function(response){
				//if(response.err == '')
				//{	   
				console.log(response);          
				 $("#response_msg").show();	
				 $("#response_msg").html(response);	
 				//}
				 
					 
			 }




	});
	
 }
	}
	
	
function addhiddenfields(ids)
{
	$("#crefoID").val(ids);
	$("#response_msg").hide();	
				 
}	 



</script>
                  
  

<?php
if($_REQUEST['submit_credit'] == "" && $_REQUEST['submit_ssn'] == "")
{
	

	 ?>

<div id="modal_form_vertical" class="modal fade in">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">×</button>
									<h5 class="modal-title">SSN Verification form</h5>
								</div>

								<form action=""  method="post" >
									<div class="modal-body">
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6">
													<label>First name</label>
        <input id="name" type="text" name="FirstName" placeholder="First Name" required  value = "" class="form-control"/>
												</div>
                                                
                                                
                                                <div class="col-sm-6">
													<label>Middle name</label>
        <input id="mname" type="text" name="MiddleName" class="form-control" placeholder="Your Middle Name"/>
												</div>
                                                
                                                
                                                <div class="col-sm-6">
													<label>Last name</label>
        <input id="lname" type="text" name="LastName" class="form-control" placeholder="Your Last Name" required/>
												</div>
                                                
                                                
                                                <div class="col-sm-6">
													<label>DOB</label>
        <input id="dob" type="text" name="DOB" class="form-control" value="04/23/1989" placeholder="Your Date Of Birth e.g. 04/23/1989" required/>
												</div>
                                                
                                                
                                                <div class="col-sm-6">
													<label>SSN #</label>
        <input id="SSN" type="text" name="SSN" class="form-control" value="212-04-8139" placeholder="Your SSN e.g. 111-11-1111" required />
												</div>

												 
											</div>
										</div>

										 

										 

										 
									</div>

									<div class="modal-footer">
										<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
										<!--<button type="submit" class="btn btn-primary">Submit form</button>-->
        <input type="submit" class="button btn btn-primary" value="Submit " name="submit_ssn" formtarget="_blank" /> 
									</div>
								</form>
							</div>
						</div>
					</div>


<div id="modal_form_credit" class="modal fade in">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">×</button>
									<h5 class="modal-title">Credit Reform Form</h5>
								</div>

								<form action=""  method="post" >
                                <input type="hidden" name="crefoID" value="" id="crefoID" />
									<div class="modal-body">
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6">
													<label>Company name</label>
        <input id="compname" type="text" name="cname" autocomplete="off" placeholder="Company name" onkeypress="mainfunction()" required    class="form-control"/>
        <div id="response_msg"></div>
												</div>
                                                
                                                
                                                <div class="col-sm-6">
													<label>Reference Number 1</label>
        <input id="mname" type="text" name="ref_number_1" class="form-control" placeholder="Reference Number 2"/>
												</div>
                                                
                                                
                                                <div class="col-sm-6">
													<label>Reference Number 2</label>
        <input id="lname" type="text" name="ref_number_2" class="form-control" placeholder="Reference Number 2" required/>
												</div>
                                                
                                                
                                                <div class="col-sm-6">
													<label>Note</label>
      <textarea class="form-control" name="Note" required></textarea>
												</div>
                                                
                                                
                                                

												 
											</div>
										</div>

										 

										 

										 
									</div>

									<div class="modal-footer">
										<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
										<!--<button type="submit" class="btn btn-primary">Submit form</button>formtarget="_blank"-->
        <input type="submit" class="button btn btn-primary" value="Submit " name="submit_credit"  /> 
									</div>
								</form>
							</div>
						</div>
					</div>

                    
 <div class="content-wrapper">
  
  
  <section class="instanat">
  
  	 <div class="page-header">
        <div class="page-header-content">
            <div class="page-title2">
                <h2>Dashboard  </h2>
            </div>
        </div>             
     </div>	
 
  <div class="profile-cover">
					<div class="profile-cover-img" style="background-image: url(<?=SURL?>img/dashbord_blur.jpg)"></div>
					<div class="media">
						<ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">
								<li><a href="#" class="btn btn-lg bg-info-400"><i class="icon-checkmark position-left"></i> Start a new Check</a></li>
						</ul>					

					</div>
				</div>
  
  
  </section>
            
 </div>											  
 
 <?php
}
else
{
?>
<script>
 window.onload = function(){
  jQuery("#asdasdsad").trigger('click');
};

</script>
<input type="button" value="Print this page" id="asdasdsad" onClick="window.print()">




<style>
	@font-face {
    font-family: 'robotoregular';
    src: url('fonts/roboto-regular-webfont.eot');
    src: url('fonts/roboto-regular-webfont.eot?#iefix') format('embedded-opentype'),
         url('fonts/roboto-regular-webfont.woff2') format('woff2'),
         url('fonts/roboto-regular-webfont.woff') format('woff'),
         url('fonts/roboto-regular-webfont.ttf') format('truetype'),
         url('fonts/roboto-regular-webfont.svg#robotoregular') format('svg');
    font-weight: normal;
    font-style: normal;

}
.header .inputs-txt {
	display: inline-block;
	width: 95%;
}
.header .inputs-txt input {
	width: 100% !important;
}
.header .inputs-img {
	display: inline-block;
}
.dash-pages input[type="image"] {
	width: 24px;
	display: inline-block;
}
.dash-pages .header {
	background: #FFF;
	padding: 10px;
}
ul.companyinfo li {
	display: table;
	font-size: 14px;
	line-height: 22px;
	margin-bottom: 14px;
}
.sideInputs {
	margin-bottom: 10px;
}
.love-count h1 {
	margin: 0;
	padding: 0;
}
.submit-button-container input[type="submit"]:disabled {
	background: #dddddd;
}
.inputs-img {
	width: 36px;
	height: 36px;
	background: url("/wp-content/themes/taskrocket/images/sprite.png");
	background-position: -1009px 0px;
	background-size: cover;
	-moz-transform: scaleX(-1);
	-o-transform: scaleX(-1);
	-webkit-transform: scaleX(-1);
	transform: scaleX(-1);
	filter: FlipH;
	-ms-filter: "FlipH";
	display: none;
}
.inputs-img input {
	background: none !important;
}
.search_overly {
	position: fixed;
	background: rgba(250,250,250,.9);
	left: 0;
	right: 0;
	top: 0;
	bottom: 0;
	z-index: 1000;
	display: none;
}
.search_overly .close_btn {
	position: absolute;
	right: 37px;
    top: 24px;
    /* width: 50px; */
    /* height: 50px; */
    /* font-size: 36px; */
    color: #b2b2b2;
}
.solvency_in{position:relative;}
.solvency_in img{width:100%; height:auto;}
.solvency_in span{    position: absolute;
    color: #333;
    font-weight: 700;
    font-size: 17px;
    top: -15px;}
.solvency_in span:after{    width: 1px;
    height: 36px;
    background: #fff;
    display: inline-block;
    content: "";
    position: absolute;
    top: 16px;
    left: 13px;}
.search_overly .close_btn i{font-size: 65px;}
.searchForms {
	/*width: 50%;
	max-height: 250px;
	margin: auto;
	position:absolute;
	left: 0;
	right: 0;
	top: 0;
	bottom: 0;
	*/
}
.searchForms{
	text-align:center;
	height: 100%;
	}
.search_overly .inputs-txt {
	font-size: 24px;
}
.search_overly .inputs-txt input {position: relative;z-index: 20;background-color: transparent;font-size: 40px;border: 0;-webkit-appearance: none;font-weight: 700;}

.search_overly .inputs-txt.w-select select{position: relative;float: left;width: 386px;height: 60px;border: none;margin-right: 40px;font-size: 40px;border: 0;background-color: transparent;-webkit-appearance: none;font-weight: 700;background-image: url("https://backcheckgroup.com/dashboard/wp-content/themes/taskrocket/images/downarrow.png");background-size: 34px;background-repeat: no-repeat;background-position: right 15px;}
.search_overly .inputs-txt.w-select select option{font-size:15px;}
.search_overly .inputs-txt.w-select input{width: auto;float: left;}

.slider .flex-direction-nav {
	display: none;
}
.flexslider-controls{
	margin-top:25px;
	}
ul.nav-tab li{
	text-align:center; 
	paddding:20px;
	display:inline-block;
	border-right: 1px solid #cccccc;	
	}
.searchForms ul.tabs{position: absolute;top: 24px;right: 100px;padding: 20px;z-index: 80;}
.searchForms .content_area{max-width: 1440px;padding: 30px;margin: 0 auto;vertical-align: middle;position: relative;top: 50%;-webkit-transform: translateY(-50%);-ms-transform: translateY(-50%);transform: translateY(-50%);transition: top 250ms ease-out,-webkit-transform 250ms ease-out;transition: top 250ms ease-out,transform 250ms ease-out;transition: top 250ms ease-out,transform 250ms ease-out,-webkit-transform 250ms ease-out;}
.searchForms ul.tabs li{display: inline;font-size: 22px;color: #a4afba;font-weight: 400;margin-right: 6px;cursor: pointer;}
.searchForms ul.tabs li:hover{color: #414042;}
.searchForms ul.tabs li.current{color: #414042;font-weight: 700;cursor: default;font-family: RobotoMedium;}
.searchForms .progressbar{ background:#ccc; width:100%; height:15px;}
.searchForms .progress{ background:#399; height:20px; width:0;}	
.searchForms .tab_content{ display:none;}
.searchForms .current{ display:inline-block !important;}
.searchForms .tab_content.current{display:block !important;}
.tab_content .searchform{width: 100%;text-align: left;}
.tab_content .searchform #s{width: 93.5%;font-size: 40px; padding:10px 0;}

.tab_content .searchform .advanced-cats {width: 95%;padding: 37px 18px 18px 18px;background: transparent;position: absolute;top: 50px;left: -21px;z-index: 20;border: 0;box-shadow: none;}
.tab_content .searchform .advanced-cats label{display: inline-block;font-size: 18px;font-weight: 700;padding: 5px 64px 4px 12px;}
.tab_content .searchform .advanced-cats .sep{display:inline-block;}
.tab_content .searchform .advanced-cats label:before{width: 12px;height: 12px;left: -6px;top: 8px;}
.tab_content .searchform .advanced-cats label.active:before{background-position: -60px 0;}
.tab_content .searchform #s:focus{background:transparent;}

.header .inputs-txt{
	display:inline-block;
	width:90%;
	}
.header .inputs-img{
	display:inline-block;
	}	

		
.dash-pages input[type="image"]{ width:24px; display:inline-block;}	
.dash-pages .header{
	background:#FFF;
	padding:10px;
	}
ul.companyinfo li{
	    display: table;
    font-size: 14px;
    line-height: 22px;
    margin-bottom: 14px;
	}
.sideInputs{ margin-bottom:10px;}
.love-count h1{ margin:0; padding:0;}
.submit-button-container input[type="submit"]:disabled {
    background: #dddddd;
}
.rpot-list .author{background: #358c8a;height: 40px;width: 40px;border-radius: 60%;color: #fff;font-size: 18px;text-align: center;vertical-align: middle;line-height: 40px;font-weight: 700;top: 27px;}
.rpot-list a{cursor:pointer;}

.report-page{width:100%;position:relative;font-size:12px; padding:13px; background:#fff; float:left;}
.report-page .head_logo{/*background: #f2f4f6;*/border-bottom: 4px solid #4e67c8;width: 100%;float: left;}
.report-page h1{font-weight: 400;font-size: 23px;color: #fff;background: #4e67c8;padding: 10px;float: left;width: 100%;margin-top: 20px;}
.report-page .add_rep{font-size:13px;color: #333;float: right;margin-bottom: 35px;vertical-align: middle;padding-top: 13px;width:100%; margin-top:0;}
.report-page .col-6{width:49%; float:left;}
.report-page .comp-no{float: right;padding-top: 6px;}
.report-page .pull-right{float:right;}
.report-page .logo{margin-left: 0;padding-top: 8px;width:316px;float:left;}
.report-page .logo img{float:left;width:74px;}
.report-page .accrd{border:1px solid #ccc; margin-bottom:20px;}
.report-page .accrd h5{    margin: 0;
    padding: 10px 25px;
    background: #f2f4f6;
    font-size: 15px;
    font-weight: 400;
    margin-bottom: 20px;
    border-bottom: 1px solid #4e67c8;color: #333;}
.report-page .accrd_inner{padding:0px 24px 10px;display:inline-block;}
.report-page .accrd_inner ul{margin: 0;padding: 0;font-size: 13px;list-style: none;font-weight: 400;color: #7e8385; display:inline-block;}
.report-page .accrd_inner ul li{background: transparent;border: none;font-size: 14px;padding: 0;padding-bottom: 10px;line-height: 24px; }
.report-page .accrd_inner ul li span{width: 198px;display:inline-block;}
.report-page .col-12{width:100%; float:left;}
.report-page .accrd_inner p{color: #7e8385;line-height: 18px;font-size: 12px;margin: 10px 0;}
.report-page .accrd_inner p.color-dark{color:#333 !important;font-size: 15px;}
.report-page .report-page .cover{background:url(../images/cover.png); height:100%;float:left;}
.report-page .logo_in{width: 242px;float: left;color: #808083;font-size: 12px;font-family: Arial, sans-serif;line-height: 16px;padding-top: 10px;}
.text-right{text-align:right;}
.report-page .right-customer{font-size: 14px;line-height: 17px;padding-top: 17px;color: #808083;}
.text-red{color:#c31e24;}
.foter_bot{width: 100%;float: left;font-size: 11px;color: #808083;font-weight: 700;position: absolute;bottom: 0;}
.report-page .table-report th{padding: 10px; text-align:left;font-size: 14px;}
.report-page .table-report tr td{padding: 10px;background: #f1f1f1;border-bottom: 1px solid #ddd;font-size: 13px;}
.report-page .table-report{margin-bottom: 10px;}
.check-if-no{margin-top:20px;}

.header .inputs-txt{
	display:inline-block;
	width:90%;
	}
.header .inputs-img{
	display:inline-block;
	}	

		
.dash-pages input[type="image"]{ width:24px; display:inline-block;}	
.dash-pages .header{
	background:#FFF;
	padding:10px;
	}
ul.companyinfo li{
	    display: table;
    font-size: 14px;
    line-height: 22px;
    margin-bottom: 14px;
	}
.sideInputs{ margin-bottom:10px;}
.love-count h1{ margin:0; padding:0;}
.submit-button-container input[type="submit"]:disabled {
    background: #dddddd;
}		
/*p{
	margin-bottom:20px;
	font-size:18px;
	background-color:#CCC;

}
*/
.circle_detail{
	width:85px;
	height:85px;
	border-radius:100%;
	-webkit-border-radius:100%;
	-moz-border-radius:100%;
	border:1px solid #000;
	font-size:36px;
	text-align:center;
	position:relative;
	padding-top:2%;
	}
.user-pane{width:39%;}
.user-content{width:60%;}
.user-pane, .user-content{ display:inline-block; float:left;}
.user-content{ padding:10px;}	
.user-pane .no-photo {
    width: 300px;
    height: 300px;
    display: block;
    background: rgba(72,87,119,0.1) url("<?php echo get_stylesheet_directory_uri(); ?>/images/default-user.png") no-repeat bottom center;
    border-radius: 2px;
    margin: 0 0 25px 0;
}

.width-100{width:100% !important;}
.clear{ clear:both;}
p.sumery{font-size: 14px;background-color: transparent;line-height: 23px;}
.mb-15{margin-bottom:15px;}
.social-facebook_photo{ display:inline-block; float:left; position:relative; width:160px;}
.social-content{ 
	float: left;
    display: inline-table;
    width: 80%;
    padding:2%;
}
.social-facebook_photo span{ position:absolute; right:1px; bottom:0; z-index:1;color: #fff;}
.clear{ clear:both;}
.social-facebook_photo a{position:relative;}
.social-content ul.userinfo li{font-size: 13px;display: inline-block;width: 32%;padding: 0;line-height: 24px;font-weight: 400 !important;}
.social-content ul.userinfo li span{display:block;font-family: RobotoLtRegular;}
.social-content  ul.user_photos li{display:inline-block; padding:0;width: 90px;height: 90px;overflow: hidden;}
.social-content  ul.user_photos li img{vertical-align:middle;}
.user-profile .social-content{padding-top:0;}
.user-profile .social-content .user_name h1{margin: 0;font-size: 28px;text-transform: uppercase;}
.user-profile .social-content .user_name span{font-size: 13px;color: #666;}
.user-profile .social-content h6{margin: 20px 0 15px;font-size: 18px;color: #43bce9;}
.user-profile .social-content .user-add{font-size: 13px;}
.user-profile .social-facebook_photo.bioo{font-size: 1.4em;color: #43bce9;text-align: left;}
.user-profile .social-content p.description{font-size: 13px;line-height: 22px;text-transform: none;font-family: RobotoLtRegular;margin-bottom: 8px;}
.social_links ul li{font-size: 14px;padding: 0 0 17px;}
.social_links ul li a i{font-size:14px;width: 30px; text-align:left;}
.pages-nav a{text-transform:capitalize;}
.spinner-wrapper::before{-webkit-animation: none;animation: none;}
.task-detail-field div{font-size: 1em;}

@media print{

.report-page{width:100%; margin:0 auto; float:none;}	
.content{padding: 0 !important;}
.main-nav, body:before, body:after, html:before, html:after{display:none !important;}


}


</style>





<?php	
}
 ?>