<?php 
if(isset($_REQUEST['submit'])){
	require('forpdfs/fpdf.php');	
$url = "https://secure.datadirectnow.com/webservice/default.cfm";
$post_string='REQUEST=<?xml version="1.0" encoding="UTF-8"?>
<OrderXML><Method>SEND ORDER</Method><Authentication><Username>DThanvi</Username><TestMode>YES</TestMode><Password>Risk2015</Password> 
</Authentication><ReturnResultURL>https://backcheckgroup.com/tery_api/api_tery.php</ReturnResultURL>
<OrderingUser></OrderingUser><Order><BillingReferenceCode>
</BillingReferenceCode><Count></Count><Subject><FirstName>'.$_REQUEST['FirstName'].'</FirstName><MiddleName>'.$_REQUEST['MiddleName'].'</MiddleName>
<LastName>'.$_REQUEST['LastName'].'</LastName><Generation></Generation><DOB>'.$_REQUEST['DOB'].'</DOB><SSN>'.$_REQUEST['SSN'] .'</SSN>
</Subject> 
<OrderDetail ServiceCode="'.$_POST['service'].'" OrderId="'.rand(0,5191525418941515648).'">
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
$xml = new SimpleXMLElement($data);
//print_r($xml);die;
$Welcom = 'Welcome to BackGround Check Group';
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
$pdf->Output();
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
";*/
die;
if(curl_errno($ch))
    print curl_error($ch);
else
	echo $data;
}
//  curl_close($ch);
?>


	<form action="" method="post" class="smart-green">
    <h1>Data Direct Now - SSN Verification 

        <span>Please fill all the texts in the fields.</span>

    </h1>

    <label>
        <span>First Name :</span>
        <input id="name" type="text" name="FirstName" placeholder="Your First Name" required  value = "<?php If(!empty($_POST['FirstName'])) {echo $_POST['FirstName'];}?>" />
    </label>
     <label>
        <span>Middle Name :</span>
        <input id="mname" type="text" name="MiddleName" placeholder="Your Middle Name"/>
    </label>
    <label>
        <span>Last Name :</span>
        <input id="lname" type="text" name="LastName" placeholder="Your Last Name" required/>
    </label>
      <label>
        <span>DOB :</span>
        <input id="dob" type="text" name="DOB" value="04/23/1989" placeholder="Your Date Of Birth e.g. 04/23/1989" required/>
    </label>
	 <label>
        <span>Select Product :</span>
		 <select name = 'service' required>
		  <option value=""><--------------------Select--------------------></option>
		  <option value="SSNTrace">SSNTrace</option>
		  <option value="natcrim">Multi-State Criminal History</option>
		  <option value="State Instant">Instant Statewide</option>
		  <option value="CountyCrim">County Criminal Search</option>
		 </select>
    </label>
   <label>
        <span>SSN :</span>
        <input id="SSN" type="text" name="SSN" value="212-04-8139" placeholder="Your SSN e.g. 111-11-1111" required />
    </label>
	<label>
        <span>&nbsp;</span> 
        <input type="submit" class="button" value="Submit " name="submit" formtarget="_blank" /> 
    </label>    
</form>