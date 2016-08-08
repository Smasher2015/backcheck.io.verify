<?php include ('include/config.php');

//$_REQUEST['date']="2015-09-16";

$_REQUEST['date']=date("Y-m-d");

$localDate = date("D, M d, Y");
//date("D, M d, Y h:i:s");
//$localDate = "Wed, Sep 16, 2015";

if($_GET['send']==1){


$table = '<table  border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">';
				$table .= '
				<tr>
				<td align="center" width="100%" colspan="10" style="border:none;">&nbsp;</td>
				</tr>
				<tr>
				<td align="center" width="100%" colspan="10" style="border:none;">Following are the Opened,Problem and Not Assign checks list which are not closed yet.<br /><strong>'.$localDate.'</strong> </td>
				</tr>
				<tr>
				<td align="center" width="100%" colspan="10" style="border:none;">&nbsp;</td>
				</tr>
				<tr>
				<th width="5%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">#</th>
				<th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Analyst Name</th>
            	<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Checks Title</th>
                <th width="5%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Client</th>
                <th width="5%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Add Date</th>
                <th width="15%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Progress Date</th>
                <th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Total Days</th>
				<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Check Status</th>
				<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Progress Status</th>
            
							     </tr>';
								 
								 
					
			 
								 
								 
							$cols = "vd.v_id,vc.as_id,as_vstatus,as_status,checks_title,co.name AS 'client_name', CONCAT(first_name,' ',last_name) AS 'analyst_name', DATE(as_addate) as 'add_date', DATE(as_pdate) as 'progress_date' 
									,level_id,vd.com_id"; 
							$tbls = "ver_data vd 
									INNER JOIN ver_checks vc ON vd.v_id=vc.v_id 
									INNER JOIN checks c ON c.checks_id=vc.checks_id  
									INNER JOIN company co ON vd.com_id=co.id
									INNER JOIN users u ON u.user_id=vc.user_id"	;
							$WHERE = "(as_status='Open' OR as_status='Problem' OR as_status='Not Assign')
									and as_isdlt=0 
									and v_isdlt=0 
									
									and vd.com_id NOT IN (20,81,82,92,96)
									and YEAR(as_addate)='".date('Y')."' 
									and level_id IN (2,3,6) 
									and u.user_id NOT IN (210,211,212,201,3,23,50) 
									ORDER BY as_addate DESC ";
								 //echo "SELECT $cols FROM $tbls WHERE $WHERE";
						$see=0;		 
$analyst= $db->select($tbls,$cols,$WHERE);
        if(mysql_num_rows($analyst)>0){
        while($analyst_arr = mysql_fetch_array($analyst)){
			$today = date("Y-m-j H:i:s");
			$days  = getDaysFromDates($today,$analyst_arr['add_date'],$analyst_arr['com_id']);
			$levelid = $analyst_arr['level_id'];
			if($levelid==2) $Title = "(Manager)"; else if($levelid==6) $Title = "(Finance)"; else if($levelid==12) $Title = ""; else  $Title = "";  
			if($days>30){
				$see++;
				
				$table .= ' <tr>
				<td width="" style="font-size:12px; padding:5px;">'.$see.'</td>
                <td width="" style="font-size:12px; padding:5px;">'.$analyst_arr['analyst_name'].' '.$Title.'</td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['checks_title'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['client_name'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['add_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['progress_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$days.'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_status'].'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_vstatus'].'</a></td>
                
            </tr>	    '; 	
			
		
		
		//$db->update("delayed_reported=1","ver_checks","as_id=".$analyst_arr['as_id']);
		
		}			
		}}
				$table .= "</table>";
				$subject="Opened Checks Details (".$localDate.")";
				$to_email="khalique@xcluesiv.com";
				$fEmial="Verification Team";
				//$cMail="hzafar2010@gmail.com";
		echo $table;		

if($see!=0){
	
//emailTmp($table,$subject,$to_email,'','','','',"Khalique");
//emailTmp($table,$subject,'ceo@backcheckgroup.com','','','','',"CEO");
//emailTmp($table,$subject,'danish@xcluesiv.com','','','','',"Danish");
//emailTmp($table,$subject,'hassan@xcluesiv.com','','','','',"Hassan");    
//emailTmp($table,$subject,'erum@backcheckgroup.com','','','','',"Erum Hanif");
//emailTmp($table,$subject,'athar@backcheckgroup.com','','','','',"Athar Khan");
//emailTmp($table,$subject,'saima@backcheckgroup.com','','','','',"Saima Qaiser");
//emailTmp($table,$subject,'sarfaraz@backcheckgroup.com','','','','',"Sarfaraz Ahmed");
}
}

function exportData($owhere='',$fileName='Open_Above_30_Days',$ORDER='',$limit='',$bycase=false){
	global $db,$COMINF;
	global $LEVEL;
	$today = date("Y-m-j H:i:s");
	
	$cols = "as_vstatus as 'Progress Status',checks_title as 'Checks Title',co.name AS 'Client', CONCAT(first_name,' ',last_name) AS 'Analyst Name', DATE(as_addate) as 'Add Date', DATE(as_pdate) as 'Progress Date' 
									,vd.com_id"; 
							$tbls = "ver_data vd 
									INNER JOIN ver_checks vc ON vd.v_id=vc.v_id 
									INNER JOIN checks c ON c.checks_id=vc.checks_id  
									INNER JOIN company co ON vd.com_id=co.id
									INNER JOIN users u ON u.user_id=vc.user_id"	;
							$WHERE = "as_status='Open' 
									and as_isdlt=0 
									and v_isdlt=0 
									and delayed_reported=0
									and vd.com_id NOT IN (20,81,82,92,96)
									and YEAR(as_addate)='".date('Y')."' 
									and level_id IN (2,3,6) 
									and u.user_id NOT IN (210,211,212,201,3,23,50) 
									ORDER BY as_addate DESC ";
									
	//echo "SELECT $cols FROM $tbls WHERE $where ORDER BY c.as_id DESC $limit"; exit;
	
	
	$setRec = $db->select($tbls,$cols,$WHERE);
	if(mysql_num_rows($setRec)>0){
		
		

	$setCounter = 0; 
	$setExcelName = $fileName;
	
	//var_dump($setRec); exit;
	$setCounter = mysql_num_fields($setRec); 
	for ($i = 0; $i < $setCounter; $i++) { 
	$setMainHeader .= mysql_field_name($setRec, $i)."\t"; 
	} 
	while($rec = mysql_fetch_row($setRec)) {

			$days  = getDaysFromDates($today,$rec['add_date'],$rec['com_id']);
			  
			if($days>30)	{
	$rowLine = ''; 
	foreach($rec as $value) { 
	if(!isset($value) || $value == "") { 
	$value = "\t"; 
	} 
	else 
	{ 
	//It escape all the special charactor, quotes from the data. 
	$value = strip_tags(str_replace('"', '""', $value)); 
	$value = '"' . $value . '"' . "\t"; } $rowLine .= $value; 
	}
	}	
	$setData .= trim($rowLine)."\n"; 
	
	} 
	$setData = str_replace("r", "", $setData); 
	if ($setData == "") 
	{ 
	$setData = "No matching records found"; 
	} 
	$setCounter = mysql_num_fields($setRec); 
	//This Header is used to make data download instead of display the data 
	header("Content-type: application/octet-stream"); 
	header("Content-Disposition: attachment; filename=".$setExcelName."_checks_list.xls");
	header("Pragma: no-cache"); header("Expires: 0"); //It will print all the Table row as Excel file row with selected column name as header. 
	echo ucwords($setMainHeader)."\n".$setData."\n"; exit;

		
	}else{
		return false;	
	}
}




?>