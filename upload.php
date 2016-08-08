<?php //print_r($_REQUEST);exit;

if($_FILES['file']['name'] == "")
{
	echo "File Not Found."; exit;
}
 include("class.filetotext.php");
 	function getRecordById($url_query,$param)
	{
		 $ch = curl_init();
//echo $url_query."?".$param."<br />"; die;
	curl_setopt($ch, CURLOPT_URL,$url_query);
    // Set a referer
  // curl_setopt($ch, CURLOPT_HEADER, FALSE);
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Download the given URL, and return output
 $output = curl_exec($ch);
		return $output;
	
	}
function curlCall( $url, $query="" )
	{
		 //echo $url."?".$query; die;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER,'Content-Type: application/xml');
		if($query!="") curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
		$response = curl_exec($ch); 
		curl_close($ch);
		return $response;
	} // ends
	
	
$target_dir = getcwd()."/upload/resume/";
 $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
 
	/*function extracttext($filename) {
        //Check for extension
        $ext = end(explode('.', $filename));
     if($ext == 'docx'){
    $dataFile = "word/document.xml";
    //else it must be odt file
	}
    else if($ext == 'doc'){
    $dataFile = "word/document.xml";
    //else it must be odt file
	}
	
    else
    {$dataFile = "content.xml";     
	}
    //Create a new ZIP archive object
    $zip = new ZipArchive;
     if (true === $zip->open($filename)) {
         if (($index = $zip->locateName($dataFile)) !== false) {
             $text = $zip->getFromIndex($index);
             $xml = DOMDocument::loadXML($text, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
 			return strip_tags($xml->saveXML(),"<w:t>,</w:t>");
        }
         $zip->close();
    }
     // In case of failure return a message
    return "File not found";
}*/
 
	
	
	
	define("FILE_TYPES_ALLOWED","docx,doc,pdf,txt");
	
$authToken ="e00fac174c4e4e0edfc8dc4fc2d0f8c1";
$country ="USA";
$zohoApiURL = "https://recruit.zoho.com/recruit/private/xml/Candidates/uploadDocument";

$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);


    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error']; exit;
    }
	else if(!in_array($ext,explode(',',FILE_TYPES_ALLOWED))){
		echo "Invalid file type ".$ext; exit;
	}
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], getcwd().'/upload/resume/'.$_FILES['file']['name']);
		
		// include("class.filetotext.php");


	$Filetotext = new Filetotext(getcwd()."/upload/resume/".$_FILES['file']['name']);
	
	if($ext == "docx")
	{
		$xmlinitial = $Filetotext->read_docx();
		//$document_extens = read_docx();
	}
	else if($ext == "doc")
	{
		$xmlinitial = $Filetotext->read_doc();
	}
	else if($ext == "pdf")
	{
		//$xmlinitial = $sssssss->read_docx();
		$asd = $Filetotext->decodePDF();
		$xmlinitial = $Filetotext->output();
	}
	else if($ext == "txt")
	{
		$xmlinitial = $Filetotext->read_docx();
	}
	else
	{
		$xmlinitial = "";
	}
//echo $xmlinitial;
//echo "asdasdasd";exit;
	
	if($xmlinitial == "")
	{
		echo "Invalid file type ".$ext; exit;
	}
//echo $document_extens.' ==== xmlinitial';
	  
	 // $xmlinitial=extracttext(getcwd()."/zoho-atauploads/".$_FILES["fileToUpload"]["name"]);

		
	//echo $xmlinitial;exit;
			 $xmlinitial = htmlentities($xmlinitial);  
		$documentData2 = base64_encode($xmlinitial);
	// echo $documentData2; exit;
	$queryString = "authtoken=$authToken&scope=recruitapi&version=2&fileName=".$_FILES['file']['name']."&documentData=".$documentData2."";
	//echo $documentData2; exit;
	 $curlCall = curlCall($zohoApiURL,$queryString);
	 $xml = simplexml_load_string($curlCall);
	$candidate_id=$xml->result->recorddetail->FL; 

 
 	$url2="https://recruit.zoho.com/recruit/private/xml/Candidates/getRecordById";
	$param="authtoken=".$authToken."&scope=recruitapi&id=".$candidate_id."&version=2&newFormat=2&selectColumns=Candidates(First Name,Last Name,Email,Current Employer,Source,Phone,Current Employer,Current Job Title,Skill Set)";
$getresponse = getRecordById($url2,$param);
	  $xmlxxxx=simplexml_load_string($getresponse);
 

  echo '    <div id="existingdatas">  
                                   <div id="xxxxxxxs"><h1></h1></div><div class="form-group">
                                            <div class="row">         
';
foreach($xmlxxxx->result->Candidates->row->FL as $key => $val)
{
	$asd = $val['val'];
	// $asdasd[] = array($asd => $val);
	
	?>
    
    
												
													
        
    
    <?php
	/*if($asd == "CANDIDATEID")
	{
		echo '<div class="col-sm-6"><label>'.$asd.'</label><input type="text" name="FirstName" value="'.$val.'"  class="form-control" /></div>';
 	}*/
	if($asd == "First Name")
	{
		echo '<div class="col-sm-6"><label>'.$asd.'</label><input type="text" name="FirstName" value="'.$val.'"  class="form-control" /></div>';
	}
	if($asd == "Last Name")
	{
		echo '<div class="col-sm-6"><label>'.$asd.'</label><input type="text" name="LastName" value="'.$val.'"  class="form-control" /></div>';
	}
	if($asd == "Email")
	{
		echo '<div class="col-sm-6"><label>'.$asd.'</label><input type="text" name="emailadd" value="'.$val.'"  class="form-control" /></div>';
	}
	if($asd == "Phone")
	{
		echo '<div class="col-sm-6"><label>'.$asd.'</label><input type="text" name="phone" value="'.$val.'"  class="form-control" /></div>';
	}
	if($asd == "Current Employer")
	{
		echo '<div class="col-sm-6"><label>'.$asd.'</label><input type="text" name="'.$asd.'" value="'.$val.'"  class="form-control" /></div>';
	}
	
	if($asd == "Current Job Title")
	{
		if($val!=''){
		echo '<div class="col-sm-6"><label>'.$asd.'</label><input type="text" name="'.$asd.'" value="'.$val.'"  class="form-control" /></div>';
		}
	}
	if($asd == "Skill Set")
	{
		if($val!=''){
		echo '<div class="col-sm-6"><label>'.$asd.'</label><input type="text" name="'.$asd.'" value="'.$val.'"  class="form-control" /></div>';
		}
	}
//echo '<<<< '.$asd.' >>>';

}
echo '	  </div></div></div>';
	//$asd = $val['val'];	?>
    
    <?php	
		
		
    }
	
	
/*	$handle = fopen('uploads/' . $_FILES['file']['name'], "r");
	$data = fread($handle, filesize('uploads/'. $_FILES['file']['name']));
	$documentData = base64_encode($data);
	//echo $documentData = base64_encode($data);die;
	
	$fileName = "/home/backglob/public_html/verify/zoho-khl/uploads/".$_FILES['file']['name'];
	//var_dump(file_get_contents($fileName)); die;
	
	if($ext=='pdf'){
	$documentData1 = file_get_contents($fileName);
	@header('Content-type: application/pdf');
	@header('Content-Disposition: attachment; filename=filename.pdf');	
	}else{
	$documentData1 = file_get_contents($fileName);	
	}
	*/
	
	
    // Close the cURL resource, and free system resources
   
	

?>