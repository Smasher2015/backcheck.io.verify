<?php 
	define("HOST",'localhost');	
	define("DB",'backglob_db');
	define("USER",'backglob_db');
	define("PASS",'4KrqZ--rPZ2Q');
mysql_connect(HOST,USER,PASS) or die(mysql_error());
mysql_select_db(DB) or die(mysql_error());
$today = date("Y-m-d");
$pastMonth = strtotime("-1 month");
$one_month = date("Y-m-d",$pastMonth);
$clntid 	= ($_REQUEST['clntid'])?$_POST['clntid']:'';
	$checks_id 	= ($_POST['as_id'])?$_POST['as_id']:'';
	$from_dt 	= ($_POST['from_dt'])?$_POST['from_dt']:$one_month;
	$to_dt 		= ($_POST['to_dt'])?$_POST['to_dt']:$today;
	$as_status 		= ($_POST['as_status'])?$_POST['as_status']:$today;
	if(isset($_REQUEST['export_csv'])){
	if($as_status=='invoiced'){
								$dweher = "as_status='Close' AND invoiced=1";
								
							}else{
								$dweher = "as_status='".$as_status."' AND invoiced !=1";
							}
							switch($as_status){
								case "Close":
								$date_column="as_cldate";
								$date_column_label="Close Date";
								break;
								case "Not Assign":
								$date_column="as_addate";
								$date_column_label="Submitted Date";
								break;
								case "Open":
								$date_column="as_addate";
								$date_column_label="Submitted Date";
								break;
								case "Problem":
								$date_column="as_addate";
								$date_column_label="Submitted Date";
								break;
								case "invoiced":
								$date_column="invoiced_date";
								$date_column_label="Invoiced Date";
								break;
								default:
								$date_column="as_addate";
								$date_column_label="Submitted Date";
								break;
							}

							if($checks_id!=''){
								$ewhere1="AND checks_id=".$checks_id."";
							}else{$ewhere1='';}
							if($clntid!=''){
								$ewhere="AND com_id=".$clntid."";
							}else{$ewhere='';}	
							$where = " $dweher $ewhere   AND DATE_FORMAT($date_column, '%Y-%m-%d') BETWEEN '".$from_dt."' AND '".$to_dt."'   ";
							$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN checks ck ON c.checks_id=ck.checks_id";
							$cols = "d.image,d.v_name,d.v_ftname,ck.checks_title,c.as_stdate,d.v_id,c.as_id,c.as_status,c.as_vstatus,c.as_remarks,c.as_pdate,c.as_date,c.as_addate,c.as_cldate,c.invoice_number,c.is_tax,ck.checks_id";
							$query_arr = mysql_query("select $cols from $tbls where $where ORDER BY c.as_id DESC") or die(mysql_error());
							// print_r(mysql_fetch_array($query_arr));die;
							header('Content-Type: text/csv; charset=utf-8');
							header('Content-Disposition: attachment; filename=logs_'.date("Y-m-d").'.csv');
							// create a file pointer connected to the output stream
						 if($as_status=='invoiced'){
							$array[] = array('Invoice #','Check Id','Name','Checks Title','Amount','Uni Name','Uni Fee');
						 }else{$array[] = array('Check Id','Name','Checks Title','Amount','Uni Name','Uni Fee');}
						
						 while($data1=mysql_fetch_array($query_arr)){
							 $selCot = mysql_query("select clt_cost from clients_checks where com_id=".$clntid." AND checks_id='".$data1['checks_id']."'");
							  $rsCost = mysql_fetch_assoc($selCot);
							   $selUniName = mysql_query("select d_value from add_data where as_id='".$data1['as_id']."' AND d_type='vuni'");
							  $rsUni = mysql_fetch_assoc($selUniName);
							   $uniName=($rsUni['d_value']!=""?$rsUni['d_value']:'');
							  $selUniCost = mysql_query("select uni_fee from uni_info where uni_name='".$uniName."'");
							  $rsUniFee = mysql_fetch_array($selUniCost);
							  $rsUniFee=($rsUniFee['uni_fee']!=""?$rsUniFee['uni_fee']:'');
							 if($as_status=='invoiced'){
							$array[]=array($data1['invoice_number'],$data1['as_id'],$data1['v_name'],$data1['checks_title'],$rsCost['clt_cost'],$uniName,$rsUniFee);
							 }else{
								 $array[]=array($data1['as_id'],$data1['v_name'],$data1['checks_title'],$rsCost['clt_cost'],$uniName,$rsUniFee);
								}
							}
							function outputCSV($data) {
								$outstream = fopen('php://output', 'w');
								function __outputCSV($vals, $key, $filehandler) {
									fputcsv($filehandler, $vals); // add parameters if you want
								}
								array_walk($data, "__outputCSV", $outstream);
								fclose($outstream);
							}
							outputCSV($array);
	}

?>
