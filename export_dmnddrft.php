<?php 
 include ('include/config.php');  

if(isset($_REQUEST['exportfile_dd'])){
 	
  
 $m_where = $_REQUEST['m_where'];
	


if(isset($_REQUEST['bbcode']) && $_REQUEST['bbcode']!=""){
$bbcode  = urldecode($_REQUEST['bbcode']);
$where = ($where!="")?" $where AND dd_bcode='$bbcode'":" dd_bcode='$bbcode' ";
}

if(isset($_REQUEST['dd_bene']) && $_REQUEST['dd_bene']!="" ){
$dd_bene  = urldecode($_REQUEST['dd_bene']);
$where = ($where!="")?" $where AND dd_bene LIKE '%$dd_bene%'":" dd_bene LIKE '%$dd_bene%' ";
}

if(isset($_REQUEST['from_date']) && $_REQUEST['to_date']!="" ){
 
$from_date = date('Y-m-d H:i:s' ,strtotime($_REQUEST['from_date']));
$to_date =  date('Y-m-d H:i:s' ,strtotime($_REQUEST['to_date']));


// $where = ($where!="")?" $where AND dd_cdate >= '".$from_date."' and dd_cdate <= '".$to_date."'":" dd_cdate >= '".$from_date."' and dd_cdate <= '".$to_date."'";
 
 $where = ($where!="")?" $where AND  DATE(dd_cdate) BETWEEN DATE('".$from_date."') AND DATE('".$to_date."')":"  DATE(dd_cdate) BETWEEN DATE('".$from_date."') AND DATE('".$to_date."')";

}
 	

if(isset($_REQUEST['paid_from_date']) && ($_REQUEST['paid_from_date']!="") && isset($_REQUEST['paid_to_date']) && ($_REQUEST['paid_to_date']!="") ){
 
$from_date = date('Y-m-d H:i:s' ,strtotime($_REQUEST['paid_from_date']));
$to_date =  date('Y-m-d H:i:s' ,strtotime($_REQUEST['paid_to_date']));


  $where = ($where!="")?" $where AND  DATE(dd_pdate) BETWEEN DATE('".$from_date."') AND DATE('".$to_date."')":"  DATE(dd_pdate) BETWEEN DATE('".$from_date."') AND DATE('".$to_date."')";

}
 	






	 	 
							$tbls = "dd_data";
							$wheres = ($where!="")?" $m_where AND $where":"$m_where";
							//$cols = "d.image,d.v_name,d.v_ftname,ck.checks_title,c.as_stdate,d.v_id,c.as_id,c.as_status,c.as_vstatus,c.as_remarks,c.as_pdate,c.as_date,c.as_addate,c.as_cldate,c.invoice_number,c.is_tax,ck.checks_id";
							//$query_arr = mysql_query("select * from $tbls where (1=1 $where)") or die(mysql_error());
							//$query_arr = mysql_query("select * from $tbls where (1=1 $where)") or die(mysql_error());
							$query_arr = $db->select($tbls,"*","dd_active=1 $wheres  ORDER BY dd_id DESC");
							//echo "select * from $tbls where (1=1 $where)";exit;
							// print_r(mysql_fetch_array($query_arr));die;
							header('Content-Type: text/csv; charset=utf-8');
							header('Content-Disposition: attachment; filename=logs_'.date("Y-m-d").'.csv');
							// create a file pointer connected to the output stream
						// if($as_status=='invoiced'){
							$array[] = array('Sr.#','Barcode','Submitted by','Request Date','Beneficiary / Name of Verifying Authority','Unit(s)','Fee','Total Amount','Status');
						// }else{$array[] = array('Check Id','Name','Checks Title','Amount','Uni Name','Uni Fee');}
						
						 while($re=mysql_fetch_array($query_arr)){
							
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
							
$array[] = array($dd_id,$bacode,$username,date("j-M-Y",strtotime($re['dd_cdate'])),$benificary,$re['dd_units'],$re['dd_fee'],($re['dd_units']*$re['dd_fee']),getDDStatus($re['dd_status']));							
							
							
							  
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
