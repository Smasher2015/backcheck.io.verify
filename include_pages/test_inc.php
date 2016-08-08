<?php
	$test[] = array();
	//mysql_connect("datapro.corpserver.net","datapro_datapro","dataflow~123");
	//mysql_select_db("datapro_datapro");
$users=mysql_query("select v_name as fullname,v_id as id from ver_data where com_id=$COMINF[id]");
	while($user_info=mysql_fetch_assoc($users)){
		//$levelname=getuserlevel($user_info['level']);
		$aUsers[$user_info['id']] = $user_info['fullname'];
	}

	//print_r($usersarr);

	$input = strtolower( $_GET['input'] );
	 $len = strlen($input);
	$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 0;
	$aResults = array();
	$count = 0;
	
	if ($len)
	{
		foreach($aUsers as $key=>$auser)
		{
			// had to use utf_decode, here
			// not necessary if the results are coming from mysql
			//
			 $i = $key;
			if (strtolower(substr(utf8_decode($auser),0,$len)) == $input)
			{
				$count++;
				$aResults[] = array( "id"=>($i) ,"value"=>htmlspecialchars($auser), "info"=>htmlspecialchars($aInfo) );
			}
			
			if ($limit && $count==$limit)
				break;
		}
	}
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header ("Pragma: no-cache"); // HTTP/1.0
	if (isset($_REQUEST['json']))
	{
		header("Content-Type: application/json");
	
		echo "{\"results\": [";
		$arr = array();
		for ($i=0;$i<count($aResults);$i++)
		{
			$arr[] = "{\"id\": \"".$aResults[$i]['id']."\", \"value\": \"".$aResults[$i]['value']."\", \"info\": \"\"}";
		}
		echo implode(", ", $arr);
		echo "]}";
	}
	else
	{
		header("Content-Type: text/xml");

		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?><results>";
		for ($i=0;$i<count($aResults);$i++)
		{
			echo "<rs id=\"".$aResults[$i]['id']."\" info=\"".$aResults[$i]['info']."\">".$aResults[$i]['value']."</rs>";
		}
		echo "</results>";
	}
	?>
