<?
$url = "http://backcheckgroup.com/support/includes/api.php";
$email="atta@xcluesiv.com";
$pass="zindagi123";
function sendcurlrequest($postfields,$url){
 $query_string = "";
 foreach ($postfields AS $k=>$v) $query_string .= "$k=".urlencode($v)."&";

 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_TIMEOUT, 30);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $xml = curl_exec($ch);
  curl_close($ch);
  return $xml;
 }
 function whmcsapi_xml_parser($rawxml) {
 	$xml_parser = xml_parser_create();
 	xml_parse_into_struct($xml_parser, $rawxml, $vals, $index);
 	xml_parser_free($xml_parser);
 	$params = array();
 	$level = array();
 	$alreadyused = array();
 	$x=0;
 	foreach ($vals as $xml_elem) {
 	  if ($xml_elem['type'] == 'open') {
 		 if (in_array($xml_elem['tag'],$alreadyused)) {
 		 	$x++;
 		 	$xml_elem['tag'] = $xml_elem['tag'].$x;
 		 }
 		 $level[$xml_elem['level']] = $xml_elem['tag'];
 		 $alreadyused[] = $xml_elem['tag'];
 	  }
 	  if ($xml_elem['type'] == 'complete') {
 	   $start_level = 1;
 	   $php_stmt = '$params';
 	   while($start_level < $xml_elem['level']) {
 		 $php_stmt .= '[$level['.$start_level.']]';
 		 $start_level++;
 	   }
 	   $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
 	   @eval($php_stmt);
 	  }
 	}
 	return ($params);
 }
function validatelogin($email,$pass,$url){
 $username = "danish"; 
 $password = "Bcpl~123"; 
 $postfields = array();
 $postfields["username"] = $username;
 $postfields["password"] = md5($password);
 $postfields["action"] = "validatelogin";
 $postfields["email"] = $email;
 $postfields["password2"]=$pass;
 $postfields["responsetype"] = "xml";
 return sendcurlrequest($postfields,$url);
 }
 function whmcs_api($url,$postfields){
 $username = "danish"; 
 $password = "Bcpl~123"; 
 $postfields["username"] = $username;
 $postfields["password"] = md5($password);
 $postfields["responsetype"] = "xml";
 return sendcurlrequest($postfields,$url);
 }
 function addclient($email,$pass,$url,$infoarr){
 $username = "danish"; 
 $password = "Bcpl~123"; 
 $postfields = array();
  $postfields["action"] = "addclient"; 
   $postfields["username"] =  $username;
 $postfields["password"] = md5($password);
 $postfields["firstname"] = $infoarr['firstname'];
 $postfields["lastname"] = $infoarr['lastname'];
 $postfields["companyname"] = $infoarr['companyname'];
 $postfields["email"] = $email;
 $postfields["address1"] = $infoarr['address1'];
 $postfields["city"] = $infoarr['city'];
 $postfields["state"] = $infoarr['state'];
 $postfields["postcode"] = $infoarr['postcode'];
 $postfields["country"] = $infoarr['country'];
 $postfields["phonenumber"] =$infoarr['phonenumber'];
 $postfields["password2"] = $pass;
 $postfields["responsetype"] = "xml";
 $postfields["currency"] = $infoarr['currency'];
 return sendcurlrequest($postfields,$url);
 }
 $postfields["clientid"] = "11";
 $postfields["email"] = "talha@xcluesiv.com";
 $postfields["deptid"] = "1";
 $postfields["action"] = "gettickets";
$xml= whmcs_api($url,$postfields);
 // $xml=validatelogin($email,$pass,$url);
 $arr = whmcsapi_xml_parser($xml); 
 $tickets=$arr['WHMCSAPI']['TICKETS'];
if(count($tickets)>0){?>
<h3>My Support Tickets</h3>
<table>
<thead>
<tr>
<td>Department</td><td>Subject</td><td>Status</td><td>Last Updated</td>
</tr>
</thead>
<tbody>
<?php
if($tickets){
foreach($tickets as $val){?>
<tr>
<td>Help Desk</td><td><?=$val['SUBJECT']?></td><td><?=$val['STATUS']?></td><td><?=date("dd",strtotime($val['LASTREPLY']))?></td>
</tr>
<?php
}
}}
?></tbody></table>
<?php
//$postfields["action"] = "getannouncements";
//$postfields["limitstart"] = "0";
//$postfields["limitnum"] = "3";
//$xml=whmcs_api($url,$postfields);
//$arr=whmcsapi_xml_parser($xml);
//print_r($arr);
//$postdata = array(
  //  'action' => 'OpenTicket',
    //'clientid' => '11',
    //'deptid' => '1',is not working properly',
    //'message' => 'please work properly',
    //'priority' => 'High',
//);
//$xml=whmcs_api($url,$postdata);
//$arr = whmcsapi_xml_parser($xml);
//print_r($arr);

//Get Products
$postdata = array(
 'action' => 'getproducts',
);
$xml=whmcs_api($url,$postdata);
$arr = whmcsapi_xml_parser($xml);
print_r($arr);
//Get Client Orders

?>
