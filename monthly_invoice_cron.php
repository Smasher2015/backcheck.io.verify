<?php include ('/home/backglob/public_html/verify/include/config.php');
// 

$today = date("Y-m-d");
$firstDayOfMonth = date("Y-m-01");
$lastDayOfMonth = date("Y-m-t");

$localDate = date("D, M d, Y H:i:s A");

if(strtotime($lastDayOfMonth)==strtotime($today)){

global $db;
$ids="";
$selClients = $db->select("ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id INNER JOIN company com ON vd.com_id=com.id","com.id","v_isdlt=0 AND as_isdlt=0 AND  DATE(as_addate) 
BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth' AND com.is_active=1 GROUP BY vd.com_id");
while($rs = mysql_fetch_assoc($selClients)){
echo generateMonthlyInvoices($rs['id']);
$ids .= "Com Id:".$rs['id']."<br>";
}
//echo $ids;
//emailTmp($ids,"testing email $localDate ",'khalique@xcluesiv.com','','','','','Khl');
}


?>