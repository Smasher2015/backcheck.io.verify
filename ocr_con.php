<?php
if(isset($_REQUEST['submit'])){

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 20000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
  
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "docs/" . $_FILES["file"]["name"]);
   //   echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
  }
  // 1. Send image to Cloud OCR SDK using processImage call
  // 2.	Get response as xml
  // 3.	Read taskId from xml

 // !!! Please provide your application id and password and remove this line !!!
  // To create an application and obtain a password,
  // register at http://cloud.ocrsdk.com/Account/Register
  // More info on getting your application id and password at
  // http://ocrsdk.com/documentation/faq/#faq3
  // Name of application you created
  $applicationId = 'ID Card Parsing';
  // Password should be sent to your e-mail after application was created
  $password = 'oaHp+ctcl8Vr9I1xcaZQ3VFq';
  $fileName = $_FILES["file"]["name"];

  // Get path to file that we are going to recognize
  $local_directory=dirname(__FILE__).'/docs';
  $filePath = $local_directory.'/'.$fileName; 
  if(!file_exists($filePath))
  {
    die('File '.$filePath.' not found.');
  }
  if(!is_readable($filePath) )
  {
     die('Access to file '.$filePath.' denied.');
  }

  // Recognizing with English language to rtf
  // You can use combination of languages like ?language=english,russian or
  // ?language=english,french,dutch
  // For details, see API reference for processImage method
  $url='http://cloud.ocrsdk.com/processImage?language=english&exportFormat=txt';
  
  // Send HTTP POST request and ret xml response
  $curlHandle = curl_init();
  curl_setopt($curlHandle, CURLOPT_URL, $url);
  curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curlHandle, CURLOPT_USERPWD, "$applicationId:$password");
  curl_setopt($curlHandle, CURLOPT_POST, 1);
  curl_setopt($curlHandle, CURLOPT_USERAGENT, "PHP Cloud OCR SDK Sample");
  curl_setopt($curlHandle, CURLOPT_FAILONERROR, true);
  $post_array = array();
  if((version_compare(PHP_VERSION, '5.5') >= 0)) {
    $post_array["my_file"] = new CURLFile($filePath);
  } else {
    $post_array["my_file"] = "@".$filePath;
  }
  curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $post_array); 
  $response = curl_exec($curlHandle);
  if($response == FALSE) {
    $errorText = curl_error($curlHandle);
    curl_close($curlHandle);
    die($errorText);
  }
  $httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
  curl_close($curlHandle);

  // Parse xml response
  $xml = simplexml_load_string($response);
  if($httpCode != 200) {
    if(property_exists($xml, "message")) {
       die($xml->message);
    }
    die("unexpected response ".$response);
  }

  $arr = $xml->task[0]->attributes();
  $taskStatus = $arr["status"];
  if($taskStatus != "Queued") {
    die("Unexpected task status ".$taskStatus);
  }
  
  // Task id
  $taskid = $arr["id"];  
  
  // 4. Get task information in a loop until task processing finishes
  // 5. If response contains "Completed" staus - extract url with result
  // 6. Download recognition result (text) and display it

  $url = 'http://cloud.ocrsdk.com/getTaskStatus';
  $qry_str = "?taskid=$taskid";

  // Check task status in a loop until it is finished

  // Note: it's recommended that your application waits
  // at least 2 seconds before making the first getTaskStatus request
  // and also between such requests for the same task.
  // Making requests more often will not improve your application performance.
  // Note: if your application queues several files and waits for them
  // it's recommended that you use listFinishedTasks instead (which is described
  // at http://ocrsdk.com/documentation/apireference/listFinishedTasks/).
  while(true)
  {
    sleep(5);
    $curlHandle = curl_init();
    curl_setopt($curlHandle, CURLOPT_URL, $url.$qry_str);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlHandle, CURLOPT_USERPWD, "$applicationId:$password");
    curl_setopt($curlHandle, CURLOPT_USERAGENT, "PHP Cloud OCR SDK Sample");
    curl_setopt($curlHandle, CURLOPT_FAILONERROR, true);
    $response = curl_exec($curlHandle);
    $httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
    curl_close($curlHandle);
  
    // parse xml
    $xml = simplexml_load_string($response);
	//print_r($xml);die;
    if($httpCode != 200) {
      if(property_exists($xml, "message")) {
        die($xml->message);
      }
      die("Unexpected response ".$response);
    }
    $arr = $xml->task[0]->attributes();
    $taskStatus = $arr["status"];
    if($taskStatus == "Queued" || $taskStatus == "InProgress") {
      // continue waiting
      continue;
    }
    if($taskStatus == "Completed") {
      // exit this loop and proceed to handling the result
      break;
    }
    if($taskStatus == "ProcessingFailed") {
      die("Task processing failed: ".$arr["error"]);
    }
    die("Unexpected task status ".$taskStatus);
  }

  // Result is ready. Download it

  $url = $arr["resultUrl"];   
  $curlHandle = curl_init();
  curl_setopt($curlHandle, CURLOPT_URL, $url);
  curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
  // Warning! This is for easier out-of-the box usage of the sample only.
  // The URL to the result has https:// prefix, so SSL is required to
  // download from it. For whatever reason PHP runtime fails to perform
  // a request unless SSL certificate verification is off.
  curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
  $response = curl_exec($curlHandle);
  curl_close($curlHandle);
 
  // Let user donwload rtf result
  header('Content-Type: text/html; charset=utf-8');
  echo $response;
}
?>
<form  method="post" enctype="multipart/form-data">
    Please upload image:
    <input type="file" name="file" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
