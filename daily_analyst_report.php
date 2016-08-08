<?php include ('include/config.php');

//$_REQUEST['date']="2015-09-16";

$_REQUEST['date']=date("Y-m-d");
$Yesterday = date("Y-m-d",strtotime("-1 day"));
$MisYesterday = date("D, M d, Y",strtotime($Yesterday));

$from1 = 0; $to1=10;
$from2 = 11; $to2=20;
$from3 = 21; $to3=30;
$from4 = 31; $to4=60;
$from5 = 61; $to5=1000;
$ranges = array($from1=>$to1,$from2=>$to2,$from3=>$to3,$from4=>$to4,$from5=>$to5);
$localDate = date("D, M d, Y");
//date("D, M d, Y h:i:s");
//$localDate = "Wed, Sep 16, 2015";
$dys = (isset($_REQUEST['morethandays']))?$_REQUEST['morethandays']:60;
$dys2 = (isset($_REQUEST['between_days']))?$_REQUEST['between_days']:90;
$mnth = (isset($_REQUEST['mnth']))?$_REQUEST['mnth']:date("m");
$yrs = (isset($_REQUEST['yrs']))?$_REQUEST['yrs']:array(date("Y"));

if($_GET['send']==1){
$selected = (in_array("2015",$yrs))?'selected':'';
$selected2 = (in_array("2016",$yrs))?'selected':'';


$table = '<table  border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">';
				$table .= '
				<tr>
				<td align="center" width="100%" colspan="10" style="border:none;">&nbsp;</td>
				</tr>
				<tr>
				<td align="center" width="100%" colspan="10" style="border:none;">
				<form method="post" action="daily_analyst_report.php?send=1">
				<input type="hidden" name="export_data" value="1">
				
				<input type="submit" value="Export XLS FILE" >
				</form>
				
				</td>
				</tr>
				<tr>
				<td align="center" width="100%" colspan="10" style="border:none;">
				<form method="post" action="uni-wise-checks.php?send=1">
				Enter Min Days: <input type="number" name="morethandays" value="'.$dys.'"> Enter Max Days<input type="number" name="between_days" value="'.$dys2.'">
				
				<input type="submit" value="Submit" >
				</form>
				
				</td>
				</tr>
				
				
				<tr>
				<td align="center" width="100%" colspan="10" style="border:none;">&nbsp;</td>
				</tr>
				<tr>
				<th width="5%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">#</th>
				<th width="5%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Sys IDS</th>
				<th width="15%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Applicant</th>
            	<th width="15%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">EMP ID</th>
				<th width="15%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Checks</th>
				<th width="5%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Done</th>
                <th width="20%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Client</th>
                <th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Analyst</th>
                <th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Uni Name</th>
                <th width="5%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Progress Status</th>
				
				<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Submit Date</th>
				<th width="5%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">TAT(Days)</th>
            
							     </tr>';
								 
								 
					
		 
								 
								 
			$cols = "DATE(as_cldate), vc.user_id,vc.bitrixtid,vd.com_id,as_id,vc.v_id,vc.as_addate as add_date,DATE(as_pdate) as as_pdate, as_status,checks_title,vd.v_name AS 'Applicant',vd.emp_id AS 'EMP ID', c.name AS 'Client', CONCAT(u.first_name,' ',u.last_name) 
			AS 'Analyst', ui.uni_Name AS 'Uni Name',as_vstatus AS 'Progress Status', DATE(as_addate) AS 'Submit Date'"; 
			$tbls = "ver_checks vc 
			INNER JOIN ver_data vd ON vc.v_id=vd.v_id 
			INNER JOIN users u ON vc.user_id=u.user_id 
			INNER JOIN company c ON c.id=vd.com_id 
			INNER JOIN checks cc ON cc.checks_id=vc.checks_id
			LEFT JOIN uni_info ui ON ui.uni_id=vc.`as_uni`"	;
			$WHERE = "vc.user_id NOT IN (239,250) AND as_isdlt=0 AND v_isdlt=0 AND DATE(as_addate) BETWEEN '".date('Y-m-d',strtotime('-6 month'))."' AND '".date('Y-m-d')."'";
								// echo "SELECT $cols FROM $tbls WHERE $WHERE";
						$see=0;	
						$see2=0;						
		$analyst= $db->select($tbls,$cols,$WHERE);
		$datas = array();
        if(mysql_num_rows($analyst)>0){
			$bitids="";
			$usersCount= array();
			$yesTerdayChecks= array();
			$exclued_user_ids=array();
        while($analyst_arr = mysql_fetch_array($analyst)){
			
			 $tnt = countChecks("vc.v_id=$analyst_arr[v_id] AND as_isdlt=0");
             $cnt = countChecks("vc.as_status='Close' AND vc.v_id=$analyst_arr[v_id] AND as_isdlt=0");
             $pbr = @($cnt/($tnt))*100;
			$today = date("Y-m-j H:i:s");
			$as_status = ($analyst_arr['as_status']!='Open')?" [$analyst_arr[as_status]]":"";
			$asDate = ($analyst_arr['as_status']=='Close')?$analyst_arr['as_cldate']:$analyst_arr['add_date'];
			if($analyst_arr['as_status']!='Close'){
			
			}else{
			//$days  = getDaysFromDates($analyst_arr['as_cldate'],$analyst_arr['add_date'],$analyst_arr['com_id']);		
			}
			$days  = getDaysFromDates($today,$analyst_arr['add_date'],$analyst_arr['com_id']);	
			
			
			$levelid = $analyst_arr['level_id'];
			if($levelid==2) $Title = "(Manager)"; else if($levelid==6) $Title = "(Finance)"; else if($levelid==12) $Title = "(Team Lead)"; else  $Title = "(VT)";  
			$check_url = SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81';
			foreach($ranges as $keys=>$vals){
			$_frm = date('Y-m-d',strtotime(date('Y-m-d')."-$keys days"));
			$_to = date('Y-m-d',strtotime($_frm." - $vals days"));
			
			$_frm_strtotime = strtotime($_frm);
			$_to_strtotime = strtotime($_to);
			$_adddate_strtotime = strtotime($analyst_arr['Submit Date']);
			
			//echo "From ($keys): $_frm To ($vals): $_to <br><br>";
			if($_adddate_strtotime>=$_to_strtotime && $_adddate_strtotime<=$_frm_strtotime){
				
				$users = $db->select('users','user_id,concat(first_name,\' \',last_name) as fullname',"user_id='$analyst_arr[user_id]' AND is_active=1");
			
			while($rsUsers = @mysql_fetch_assoc($users)){
			$user_id =	$rsUsers['user_id'];
			$fullname =	$rsUsers['fullname'];
			
			$usersCount[$vals]['Not Init'][$fullname]	+= countChecks("vc.user_id='$rsUsers[user_id]' AND as_id='$analyst_arr[as_id]' AND vd.v_id='$rsUsers[user_id]' AND  as_status = 'Open' AND as_vstatus='Not Initiated' AND as_isdlt=0");
			$usersCount[$vals]['Insufficient'][$fullname]	+= countChecks("vc.user_id=$rsUsers[user_id] AND as_id='$analyst_arr[as_id]' AND  as_status = 'Insufficient' AND as_vstatus='Not Initiated' AND as_isdlt=0");
			$usersCount[$vals]['WIP'][$fullname]	+= countChecks("vc.user_id='$rsUsers[user_id]'  AND as_id='$analyst_arr[as_id]' AND as_status = 'Open' AND as_vstatus!='Not Initiated' AND as_isdlt=0 AND as_cldate IS NULL ");
			$usersCount[$vals]['Closed'][$fullname]	+= countChecks("vc.user_id='$rsUsers[user_id]'  AND as_id='$analyst_arr[as_id]' AND as_status = 'Close' AND as_qastatus!='Rejected' AND as_isdlt=0 ");
			
				
			} 
			
			
				$bitids.=$analyst_arr[bitrixtid].',';
				
				$datas[] = array(
				'Applicant' => $analyst_arr['Applicant'],
				'EMP ID' => $analyst_arr['EMP ID'],
				'Checks Title' => $analyst_arr['checks_title'],
				'Client' => $analyst_arr['Client'],
				'Analyst' => $analyst_arr['Analyst'],
				'Uni Name' => $analyst_arr['Uni Name'],
				'Progress Status' => $analyst_arr['Progress Status'],
				'Submit Date' => $analyst_arr['Submit Date'],
				'Days' => $days,
				);
				
				$see++;
				
				$table .= ' <tr>
				<td width="" style="font-size:12px; padding:5px;">'.$see.'</td>
				<td width="" style="font-size:12px; padding:5px;">ASID:'.$analyst_arr['as_id'].'<br> VID:'.$analyst_arr['v_id'].'</td>
                <td width="" style="font-size:12px; padding:5px;">'.$analyst_arr['Applicant'].'</td>
                <td width="" style="font-size:14px; padding:5px;">'.$analyst_arr['EMP ID'].'</td>
				<td width="" style="font-size:14px; padding:5px;">'.$analyst_arr['checks_title'].'</td>
				<td width="" style="font-size:14px; padding:5px;">'.$cnt .'&nbsp; of &nbsp;'. $tnt.'</td>
				<td width="" style="font-size:14px; padding:5px;">'.$analyst_arr['Client'].'</td>
                <td width="" style="font-size:14px; padding:5px;">'.$analyst_arr['Analyst'].'</td>
                <td width="" style="font-size:14px; padding:5px;">'.$analyst_arr['Uni Name'].'</td>
                <td width="" style="font-size:14px; padding:5px;">'.$analyst_arr['Progress Status'].'</td>
				
				<td width="" style="font-size:14px; padding:5px;">'.$analyst_arr['Submit Date'].'</td>
				<td width="" style="font-size:14px; padding:5px;">'.$days.'</td>
				
                
            </tr>	    '; 	
			
		
		
		//$db->update("delayed_reported=1","ver_checks","as_id=".$analyst_arr['as_id']);
		
		}	
		}
		
		
		
		$see2++;		
		}}
		
				$table .= "</table>";
				$subject="Opened Checks Details (".$localDate.") more than $dys days";
				$to_email="khalique@xcluesiv.com";
				$fEmial="Verification Team";

			
			$yesTerdayChecks= array();
			$exclued_user_ids=array();

			$users2 = $db->select("users","user_id,concat(first_name,' ',last_name) as fullname","user_id NOT IN (239,250,211,180,23,22,179,338) AND (level_id=3) AND is_active=1");
			while($rsUsers2 = @mysql_fetch_assoc($users2)){
			// echo "SELECT $cols FROM $tbls WHERE $WHERE";
						$see=0;	
						$see2=0;						
		$analyst2= $db->select($tbls,$cols,$WHERE);
		$datas = array();
       
			
        
			
			
			$user_id =	$rsUsers2['user_id'];
			$fullname =	$rsUsers2['fullname'];
					
			$exclued_user_ids[] = $user_id;
			//echo $fullname."<br>".$analyst_arr['Submit Date'];
			$yesTerdayChecks[abc]['Not Init'][$fullname] = countChecks("vc.user_id='$rsUsers2[user_id]'  AND  as_status = 'Open' AND as_vstatus='Not Initiated' AND as_isdlt=0 and v_isdlt=0 AND (DATE(as_addate)='".$Yesterday."' OR DATE(as_pdate)='".$Yesterday."')");
			$yesTerdayChecks[abc]['Insufficient'][$fullname]	= countChecks("vc.user_id='$rsUsers2[user_id]'  AND  as_status = 'Insufficient' AND as_vstatus='Not Initiated' AND as_isdlt=0 and v_isdlt=0 AND (DATE(as_addate)='".$Yesterday."' OR DATE(as_pdate)='".$Yesterday."')");
			$yesTerdayChecks[abc]['WIP'][$fullname]	= countChecks("vc.user_id='$rsUsers2[user_id]' AND as_status = 'Open' AND as_vstatus!='Not Initiated' AND as_isdlt=0 and v_isdlt=0 AND as_cldate IS NULL AND (DATE(as_addate)='".$Yesterday."' OR DATE(as_pdate)='".$Yesterday."')");
			$yesTerdayChecks[abc]['Closed'][$fullname]	= countChecks("vc.user_id='$rsUsers2[user_id]' AND as_status = 'Close' AND as_qastatus!='Rejected' AND as_isdlt=0 and v_isdlt=0 AND (DATE(as_cldate)='".$Yesterday."' OR DATE(as_pdate)='".$Yesterday."' OR DATE(as_addate)='".$Yesterday."')");
			
			
			
			
			


			
			
			}
			
			
				
			/* $ussr = $db->select("users","user_id,concat(first_name,' ',last_name) as fullname","user_id NOT IN (239,250,211,180,23,22,179,338) AND user_id NOT IN (".implode(",",$exclued_user_ids).") AND level_id=3 AND is_active=1");
				
			while($rsUsers2 = @mysql_fetch_assoc($ussr)){
			$user_id =	$rsUsers2['user_id'];
			$fullname =	$rsUsers2['fullname'];
			//echo $fullname.'<br>';
			$yesTerdayChecks[abc]['Not Init'][$fullname]	+= 0;
			$yesTerdayChecks[abc]['Insufficient'][$fullname]	+= 0;
			$yesTerdayChecks[abc]['WIP'][$fullname]	+= 0;
			$yesTerdayChecks[abc]['Closed'][$fullname]	+= 0;	
			} */
			
			
			
			
			
			
			
			
			
			
			
				//$cMail="hzafar2010@gmail.com";
				//echo $bitids;
		//echo $table;	
//var_dump($usersCount);

$emailData = '<table  border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">
				
				<tr><td>';
				//var_dump($yesTerdayChecks[abc]);
if(!empty($yesTerdayChecks[abc])){

$totalarr = array();
foreach($yesTerdayChecks[abc] as $status => $value){
	$total = 0;
$not_initiated1="<td><table><tr><h3>Analyst</h3></tr>";
foreach($value as $fullname => $val){
$not_initiated1 .= '<tr><td>'.$fullname.'</td></tr>';

}
$not_initiated1 = $not_initiated1.'</table></td>';

}


$not_initiated="<table cellpadding='5' cellspacing='5'><tr><th align='center' colspan='10'><h2>Analyst MIS Report Of $MisYesterday</h2></th></tr><tr>$not_initiated1";

$totalarr = array();
foreach($yesTerdayChecks[abc] as $status => $value){
	$total = 0;
$not_initiated .= '<td><table><tr><td colspan="3"><h3>'.$status.'</h3></td></tr>';
foreach($value as $fullname => $val){
$not_initiated .= '<tr><td><a href="'.SURL.'?action=advance&atype=search&vtrport=1&fullnam='.urlencode($fullname).'&status='.urlencode($status).'&dt='.urlencode($Yesterday).'" >'.$val.'</a></td></tr>';
$totalarr[$fullname] += $val;
}
$not_initiated .='</table></td>';	
}
$totaltable = "<td><table><tr><h3>Total</h3></tr>";
foreach($totalarr as $tot){
$totaltable .= "<tr><td>".$tot."</td></tr>";	
}
$totaltable = $totaltable."</table>";
$emailData .= $not_initiated.$totaltable.'</tr></table>';
	
}

$emailData .= "<br><br>";

if(!empty($usersCount[$to1])){

$totalarr = array();
foreach($usersCount[$to1] as $status => $value){
	$total = 0;
$not_initiated1="<td><table><tr><h3>Analyst</h3></tr>";
foreach($value as $fullname => $val){
$not_initiated1 .= '<tr><td>'.$fullname.'</td></tr>';

}
$not_initiated1 = $not_initiated1.'</table></td>';

}


$not_initiated="<table cellpadding='5' cellspacing='5'><tr><th align='center' colspan='10'><h2>Days From $from1 to $to1 </h2></th></tr><tr>$not_initiated1";

$totalarr = array();
foreach($usersCount[$to1] as $status => $value){
	$total = 0;
$not_initiated .= '<td><table><tr><td colspan="3"><h3>'.$status.'</h3></td></tr>';
foreach($value as $fullname => $val){
$not_initiated .= '<tr><td><a href="'.SURL.'?action=advance&atype=search&vtrport=1&fullnam='.urlencode($fullname).'&status='.urlencode($status).'&frm='.urlencode($from1).'&to='.$to1.'" >'.$val.'</a></td></tr>';
$totalarr[$fullname] += $val;
}
$not_initiated .='</table></td>';	
}
$totaltable = "<td><table><tr><h3>Total</h3></tr>";
foreach($totalarr as $tot){
$totaltable .= "<tr><td>".$tot."</td></tr>";	
}
$totaltable = $totaltable."</table>";
$emailData .= $not_initiated.$totaltable.'</tr></table>';
	
}
//echo $emailData;


$emailData .= "<br><br>";

if(!empty($usersCount[$to2])){

$totalarr = array();
foreach($usersCount[$to2] as $status => $value){
	$total = 0;
$not_initiated1="<td><table><tr><h3>Analyst</h3></tr>";
foreach($value as $fullname => $val){
$not_initiated1 .= '<tr><td>'.$fullname.'</td></tr>';

}
$not_initiated1 = $not_initiated1.'</table></td>';

}


$not_initiated="<table cellpadding='5' cellspacing='5'><tr><th align='center'  colspan='10'><h2>Days From $from2 to $to2 </h2></th></tr><tr>$not_initiated1";

$totalarr = array();
foreach($usersCount[$to2] as $status => $value){
	$total = 0;
$not_initiated .= '<td><table><tr><td colspan="3"><h3>'.$status.'</h3></td></tr>';
foreach($value as $fullname => $val){
$not_initiated .= '<tr><td><a href="'.SURL.'?action=advance&atype=search&vtrport=1&fullnam='.urlencode($fullname).'&status='.urlencode($status).'&frm='.urlencode($from2).'&to='.$to2.'" >'.$val.'</a></td></tr>';
$totalarr[$fullname] += $val;
}
$not_initiated .='</table></td>';	
}
$totaltable = "<td><table><tr><h3>Total</h3></tr>";
foreach($totalarr as $tot){
$totaltable .= "<tr><td>".$tot."</td></tr>";	
}
$totaltable = $totaltable."</table>";
$emailData .= $not_initiated.$totaltable.'</tr></table>';	
}

$emailData .= "<br><br>";

if(!empty($usersCount[$to3])){

$totalarr = array();
foreach($usersCount[$to3] as $status => $value){
	$total = 0;
$not_initiated1="<td><table><tr><h3>Analyst</h3></tr>";
foreach($value as $fullname => $val){
$not_initiated1 .= '<tr><td>'.$fullname.'</td></tr>';

}
$not_initiated1 = $not_initiated1.'</table></td>';

}


$not_initiated="<table cellpadding='5' cellspacing='5'><tr><th align='center' colspan='10'><h2>Days From $from3 to $to3 </h2></th></tr><tr>$not_initiated1";

$totalarr = array();
foreach($usersCount[$to3] as $status => $value){
	$total = 0;
$not_initiated .= '<td><table><tr><td colspan="3"><h3>'.$status.'</h3></td></tr>';
foreach($value as $fullname => $val){
$not_initiated .= '<tr><td><a href="'.SURL.'?action=advance&atype=search&vtrport=1&fullnam='.urlencode($fullname).'&status='.urlencode($status).'&frm='.urlencode($from3).'&to='.$to3.'" >'.$val.'</a></td></tr>';
$totalarr[$fullname] += $val;
}
$not_initiated .='</table></td>';	
}
$totaltable = "<td><table><tr><h3>Total</h3></tr>";
foreach($totalarr as $tot){
$totaltable .= "<tr><td>".$tot."</td></tr>";	
}
$totaltable = $totaltable."</table>";
$emailData .= $not_initiated.$totaltable.'</tr></table>';	
}

$emailData .= "<br><br>";
//echo $emailData;
if(!empty($usersCount[$to4])){

$totalarr = array();
foreach($usersCount[$to4] as $status => $value){
	$total = 0;
$not_initiated1="<td><table><tr><h3>Analyst</h3></tr>";
foreach($value as $fullname => $val){
$not_initiated1 .= '<tr><td>'.$fullname.'</td></tr>';

}
$not_initiated1 = $not_initiated1.'</table></td>';

}


$not_initiated="<table cellpadding='5' cellspacing='5'><tr><th align='center' colspan='10'><h2>Days From $from4 to $to4 </h2></th></tr><tr>$not_initiated1";

$totalarr = array();
foreach($usersCount[$to4] as $status => $value){
	$total = 0;
$not_initiated .= '<td><table><tr><td colspan="3"><h3>'.$status.'</h3></td></tr>';
foreach($value as $fullname => $val){
$not_initiated .= '<tr><td><a href="'.SURL.'?action=advance&atype=search&vtrport=1&fullnam='.urlencode($fullname).'&status='.urlencode($status).'&frm='.urlencode($from4).'&to='.$to4.'" >'.$val.'</a></td></tr>';
$totalarr[$fullname] += $val;
}
$not_initiated .='</table></td>';	
}
$totaltable = "<td><table><tr><h3>Total</h3></tr>";
foreach($totalarr as $tot){
$totaltable .= "<tr><td>".$tot."</td></tr>";	
}
$totaltable = $totaltable."</table>";
$emailData .= $not_initiated.$totaltable.'</tr></table>';	
}

$emailData .= "<br><br>";

if(!empty($usersCount[$to5])){

$totalarr = array();
foreach($usersCount[$to5] as $status => $value){
	$total = 0;
$not_initiated1="<td><table><tr><h3>Analyst</h3></tr>";
foreach($value as $fullname => $val){
$not_initiated1 .= '<tr><td>'.$fullname.'</td></tr>';

}
$not_initiated1 = $not_initiated1.'</table></td>';

}


$not_initiated="<table cellpadding='5' cellspacing='5'><tr><th align='center' colspan='10'><h2>Days Greater Than 60 </h2></th></tr><tr>$not_initiated1";

$totalarr = array();
foreach($usersCount[$to5] as $status => $value){
	$total = 0;
$not_initiated .= '<td><table><tr><td colspan="3"><h3>'.$status.'</h3></td></tr>';
foreach($value as $fullname => $val){
$not_initiated .= '<tr><td><a href="'.SURL.'?action=advance&atype=search&vtrport=1&fullnam='.urlencode($fullname).'&status='.urlencode($status).'&frm=$from5&to=1000" >'.$val.'</a></td></tr>';
$totalarr[$fullname] += $val;
}
$not_initiated .='</table></td>';	
}
$totaltable = "<td><table><tr><h3>Total</h3></tr>";
foreach($totalarr as $tot){
$totaltable .= "<tr><td>".$tot."</td></tr>";	
}
$totaltable = $totaltable."</table>";
$emailData .= $not_initiated.$totaltable.'</tr></table>';	
}




//var_dump($yesTerdayChecks);



$emailBody = $emailData.'</td></tr></table>';

echo $emailBody;



$subject = "Daily update of all analyst $MisYesterday";
emailTmp($emailBody,$subject,$to_email,'','','','',"Khalique");
emailTmp($emailData,$subject,'mis@backcheckgroup.com','','','','',"Team");






//emailTmp($table,$subject,'ceo@backcheckgroup.com','','','','',"CEO");
//emailTmp($table,$subject,'danish@xcluesiv.com','','','','',"Danish");
//emailTmp($table,$subject,'hassan@xcluesiv.com','','','','',"Hassan");    
//emailTmp($table,$subject,'erum@backcheckgroup.com','','','','',"Erum Hanif");
//emailTmp($table,$subject,'athar@backcheckgroup.com','','','','',"Athar Khan");
//emailTmp($table,$subject,'saima@backcheckgroup.com','','','','',"Saima Qaiser");
//emailTmp($table,$subject,'sarfaraz@backcheckgroup.com','','','','',"Sarfaraz Ahmed");

}
//var_dump(array_keys($datas[0]));

//var_dump(count(array_keys($datas[0])));
//echo exportData($datas);
if($_POST['export_data']==1){
	echo exportData($datas); exit;
}
	
function exportData($datas){
	global $db,$COMINF;
	global $LEVEL;
	
	if(count($datas)>0){
		
		

	$setCounter = 0; 
	$setExcelName = "open_checks_".date('Y_m_d');
	
	$setCounter = array_keys($datas[0]); 
	
	for ($i = 0; $i < count($setCounter); $i++) { 
	if((!is_numeric($setCounter[$i]))){
	$setMainHeader .= $setCounter[$i]."\t"; 
	}
	} 
	//var_dump($datas); exit;
	foreach($datas as $rec) {

			//$days  = getDaysFromDates($today,$rec['add_date'],$rec['com_id']);
			  
		///echo var_dump($rec['add_date']); exit;	
	$rowLine = ''; 
	foreach($rec as $value) { 
	
	if(!isset($value) || $value == "") { 
	$value = "\t"; 
	} 
	else 
	{ 
	//It escape all the special charactor, quotes from the data. 
	$value = strip_tags(str_replace('"', '""', $value)); 
	$value = '"' . $value . '"' . "\t"; 
	} 
	$rowLine .= $value; 
	}
		
	$setData .= trim($rowLine)."\n"; 
	
	}
	//echo $setData; exit;	
	//$setData = str_replace("r", "", $setData); 
	if ($setData == "") 
	{ 
	$setData = "No matching records found"; 
	} 

	//echo ucwords($setData); exit;
	//This Header is used to make data download instead of display the data 
	@header("Content-type: application/octet-stream"); 
	 @header("Content-Disposition: attachment; filename=".$setExcelName."_checks_list.xls");
	 @header("Pragma: no-cache"); header("Expires: 0"); //It will print all the Table row as Excel file row with selected column name as header. 
	echo ucwords($setMainHeader)."\n".$setData."\n"; exit;

		
	}else{
		return false;	
	}
}






?>