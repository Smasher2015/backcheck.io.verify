<?php 
 include ('include/config.php');  

if(isset($_REQUEST['reportgenerate'])){
	
	$m_where = $_REQUEST['m_where'];
	$r_to_date = $_REQUEST['r_to_date'];
	$r_from_date = $_REQUEST['r_from_date'];
	
 	 
	//$where = "$where1 dd_cdate >= '".$r_from_date."' and dd_cdate <= '".$r_to_date."'";
if(isset($_REQUEST['r_from_date']) && $_REQUEST['r_to_date']!="" ){
	$where = "DATE(dd_pdate) BETWEEN DATE('".$r_from_date."') AND DATE('".$r_to_date."')";
}
  	
 							
							
							if($where != '')
							{$wheres = "$m_where AND $where";}else{$wheres = "$m_where";}
							$query_arr = $db->select("dd_data","SUM(dd_units*dd_fee) as totalamountx,dd_id,dd_bcode,dd_user,dd_bene,dd_uni,dd_cdate,dd_status,dd_pdate","dd_active=1 $wheres group by dd_bene ORDER BY dd_id DESC");
							//echo "select * from $tbls where (1=1 $where)";exit;
 							header('Content-Type: text/csv; charset=utf-8');
							header('Content-Disposition: attachment; filename=paid_list_'.date("Y-m-d").'.csv');
 							$array[] = array('Sr.#','Barcode','Submitted by','Request Date','Paid Date','Name of Verifying Authority','Unit(s)','Fee','Total Amount','Status');
 						if(mysql_num_rows($query_arr)>0)
						{
						 while($re=mysql_fetch_array($query_arr)){
							//print_r($re);echo "<br><br><br><br>";
							$uni = mysql_query("select * from uni_info where uni_id=$re[dd_uni]");
								//$uni = $db->select("uni_info","*","uni_id=$re[dd_uni]");
								
								$uni = mysql_fetch_assoc($uni);							
							
					// 1
					if($re['dd_id']<100){
							if($re['dd_id']<10) $dd_id = (string)"00$re[dd_id]"; else $dd_id = (string)"0$re[dd_id]";
						}else{
							$dd_id = $re['dd_id'];
						}
					// 2
					if($re['dd_bcode']!=""){$bacode = $re['dd_bcode'];}else{$bacode = "--";}
					
					// 3
							$userInfo = getUserInfo($re['dd_user']);
							if($userInfo != ""){$username =  "$userInfo[first_name] $userInfo[last_name]";}					
							else {$username =  "";}					
					
					
					// 5
				 	$benificary = "$re[dd_bene]";
					
					
				//echo	$totalamount = $re['dd_fee']*$re['dd_units'].'totalamount<br><br><br><br>';
					
					
/*  $asd = mysql_query("select  SUM(dd_units*dd_fee) as totalamountx from dd_data where ( dd_cdate >= '".$r_from_date."' and dd_cdate <= '".$r_to_date."') group by dd_bene");					
					
		$amount = mysql_fetch_array($asd);			
*/				//echo $amount['totalamountx'];	
					
					
					
					
							
$array[] = array($dd_id,$bacode,$username,date("j-M-Y",strtotime($re['dd_cdate'])),date("j-M-Y",strtotime($re['dd_pdate'])),$benificary,$re['dd_units'],$re['dd_fee'],$re['totalamountx'],getDDStatus($re['dd_status']));							
							
							
							  
							}
							}
							else
							{
$array[] = array('-','-','-','-','-','-','-','-','-');							
							}
							function outputCSV($data) {
								$outstream = fopen('php://output', 'w');
								function __outputCSV(&$vals, $key, $filehandler) {
									@fputcsv($filehandler, $vals); // add parameters if you want
								}
								array_walk($data, "__outputCSV", $outstream);
								fclose($outstream);
							}
							 outputCSV($array);
	}

?>
