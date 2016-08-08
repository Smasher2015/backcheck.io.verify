<?php
 //include("http://backgroundcheck.global/verify/functions/functions.php");
$data =$_GET;
$fields = count($data['fields']);

//foreach($data as $posts)
for($i=0; $fields > $i; $i++)
{
	//print_r($posts);
	//echo $data['fields'][$i]['label'].' label';
	//echo $data['fields'][$i]['field_type'].' field_type';
	//updateChecklabel($data['fields'][$i]['label'],1);
	
	//$db = new DB();
 	//	$isInsUpd = $db->update("fl_title='$label'","fields_maping","fl_id=$mapid");
}


// print_r($_REQUEST);

/*$asd = json_encode($_GET);
print_r(json_decode($asd));
*/

//echo $_GET['fields'][0]['field_type'];
?>