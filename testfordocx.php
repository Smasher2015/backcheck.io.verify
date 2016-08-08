<?php include ('include/config.php');
//print_r($_GET);exit;
	
			$sel = $db->select("mis_management_system","*","misID=".$_GET['ids']." ");
			$res = mysql_fetch_array($sel);
	
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment; Filename=mis-data.doc");
	
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<title>Saves as a Word Doc</title>
</head>
<body>
<h1></h1>

Dear <?=$res['clientname']?>,
<ul>
<li>candidateName <?=$res['candidateName']?> </li>
<li>ddamount <?=$res['ddamount']?> </li>
<li>ddnum <?=$res['ddnum']?> </li>
 
</ul>
<p>
Regard,
Ata Abbas
</p>

</body>
</html>