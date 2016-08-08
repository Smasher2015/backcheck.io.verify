<?php
//echo getcwd();die;
$target_dir = getcwd()."/upload/resume/";
//print_r($_FILES);
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["cvparser"])) {
  

// Check if file already exists

// Check file size
//if ($_FILES["fileToUpload"]["size"] > 500000) {
  //  echo "Sorry, your file is too large.";
    //$uploadOk = 0;
//}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "doc" && $imageFileType != "docx" ) {
    echo "Sorry, only JPG, JPEG, PNG , doc & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	
	$data = file_get_contents($_FILES['fileToUpload']['tmp_name']);
		$data = base64_encode($data);
		global $zoho_model;
	$zoho_model->zoho_table = $zoho_table;
	$url="https://recruit.zoho.com/ats/private/xml/Candidates/uploadDocument";
	$query="authtoken=".$user_info['zoho_key']."&scope=recruitapi&country=ECONN_IN_KEY&fileName=".$_FILES["fileToUpload"]["name"]."&documentData=".$data."";
	//echo $url."?".$query;
	echo $zoho_model->curlCall( $url, $query);
	
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
	die;
}
}
?>
<form  method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" multiple>
    <input type="submit" value="Parse CV And Add Candidates" name="cvparser">
</form>