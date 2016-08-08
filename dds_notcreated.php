<?php 
include ('include/config.php');
if($_REQUEST['date']!=''){
	$date=$_REQUEST['date'];
}else{$date=date("Y-m-d");}
$dds=mysql_query("select * from auto_dd where dd_cron=1 and dd_status=0 and DATE(dd_adddate)='".$date."'  AND subbarcode NOT LIKE '%EM%'");
?>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Demand Draft Not Generated</title>
<h3>Demand Draft Not Generated</h3>
<table cellpadding="5px" border="5px">
<thead>
<tr>
<td>S.No.</td><td>Barcode</td><td>IA Name</td><td>Date</td>
</tr>
</thead>
<tbody>
<?php
$i=1;
while($dds_array=mysql_fetch_array($dds)){?>
<tr><td><?=$i?></td><td><?=$dds_array['subbarcode']?></td><td><?=$dds_array['uni_name']?></td><td><?=date("d-m-Y",strtotime($dds_array['dd_adddate']))?></td></tr>
<?php $i++;	}
?></tbody></table>