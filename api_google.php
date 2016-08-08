<?php
	define("HOST",'localhost');
	define("DB",'verifbck_db');
	define("USER",'verifbck_workdat');
	define("PASS",')lECZ-L@W%Ba');
mysql_connect(HOST,USER,PASS);	
mysql_select_db(DB);
$sql=mysql_query("SELECT * FROM `ver_data` WHERE com_id=33 AND `api`=0 limit 50");

include_once("google-sheets.php");
	function dateDiff($d1,$d2)
	{
		return round(abs(strtotime($d1)-strtotime($d2))/(60*60*24))+1;
	} // ends
					$doc = new googlesheet();
					$doc->authenticate("hassan@xcluesiv.com","zindagi123");
					$doc->settitleSpreadsheet('Burj Bank Data Analysis');
					$doc->settitleWorksheet("data_Burj_Bank.csv");
					//$posted_data=array("userid" => "6", "name" => "Shabo");
					while ($row=mysql_fetch_array($sql)){
						$sdate=date('Y-m-d', strtotime($row['v_date'])); 
						$rdate=date('Y-m-d', strtotime($row['v_recdate']));
						$idate=date('Y-m-d', strtotime($row['v_itdate']));
						$rsdate=date('Y-m-d', strtotime($row['v_stdate']));
						$fdate=date('Y-m-d', strtotime($row['v_fdate']));
						$cdate=date('Y-m-d', strtotime($row['v_cldate']));
						if($row['v_recdate']!='' && $row['v_recdate']!='0000-00-00'){
						$dfcaserecieved=dateDiff($rdate - $sdate);	
						}else{
						$dfcaserecieved="Data Not Available";	
						}
						if($row['v_itdate']!=''){
						$dfcasei=dateDiff($idate,$sdate);
						}else{
						$dfcasei="Data Not Available";	
						}
						if($row['v_stdate']!=''){
							//echo $rsdate;
							//echo $sdate;
						$dfrs=dateDiff($rsdate,$sdate);
						//$dfrs=(int)$rsdate-$sdate;
						}else{
						$dfrs="Data Not Available";	
						}
						if($row['v_fdate']!=''){
						$dflf=dateDiff($fdate,$sdate);		
						}else{
						$dflf="Data Not Available";	
						}
						if($row['v_cldate']!=''){
						$dfcd=dateDiff($cdate,$sdate);		
						}else{
						$dfcd="Data Not Available";	
						}
						$drsdate=@explode("-",$sdate);
					//	print_r($row);
						//die;
						$my_data['v_refid']=$row['v_refid'];
						$my_data['v_bcode']=$row['v_bcode'];
						$my_data['v_name']=$row['v_name'];
						$my_data['v_nic']=$row['v_nic'];
						$my_data['v_ftname']=$row['v_ftname'];
						$my_data['v_dob']=$row['v_dob'];
						$my_data['Check System Added Date']=$row['v_date'];
						$my_data['Case received']=$row['v_recdate'];
						$my_data['Initiate date']=$row['v_itdate'];
						$my_data['Report send']=$row['v_stdate'];
						$my_data['last follow up date']=$row['v_fdate'];
						$my_data['closing date']=$row['v_cldate'];
						$my_data['Combined Data']=$drsdate[0].(int)$drsdate[1];
						$my_data['Year']=$drsdate[0];
						$my_data['Month']=(int)$drsdate[1];
						$my_data['Diff: Case Recieved']=$dfcaserecieved;
						$my_data['Diff: Initiate Date']=$dfcasei;
						$my_data['Diff: Report Send']=$dfrs;
						$my_data['Diff: Last Follow Up']=$dflf;
						$my_data['Diff: Closing Date']=$dfcd;
						$doc->add_row($my_data);
						mysql_query("update ver_data set `api`=1 where v_id=".$row['v_id']."");
						//die;
					}
					foreach ( $posted_data as $key => $value ) {
						// exclude the default wpcf7 fields in object
						if ( strpos($key, '_wpcf7') !== false || strpos($key, '_wpnonce') !== false ) {
							// do nothing
						} else {
							// handle strings and array elements
							if (is_array($value)) {
								$my_data[$key] = implode(', ', $value);
							} else {
								$my_data[$key] = $value;
							}					
						}
					}	

?>