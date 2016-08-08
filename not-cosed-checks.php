<?php include ('include/config.php');

//$_REQUEST['date']="2015-09-16";

$_REQUEST['date']=date("Y-m-d");

$localDate = date("D, M d, Y");
//date("D, M d, Y h:i:s");
//$localDate = "Wed, Sep 16, 2015";

if($_GET['send']==1){

$table12 = '';
$table22 = '';
$table31 = '';
$table40 = '';

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
				<th width="10%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">University Name</th>
                <th width="5%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Client</th>
                <th width="5%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Add Date</th>
                <th width="15%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Progress Date</th>
                <th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Total Days</th>
				<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Check Status</th>
				<th width="25%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Action Taken</th>
            
							     </tr>';
								 
								 
					$previous_year = date("Y")-1;
$table12 .= $table;
$table22 .= $table;
$table31 .= $table;
$table40 .= $table;
								 
$table12_count = 0;
$table22_count = 0;
$table31_count = 0;
$table40_count = 0;

 
							$cols = "vd.v_id,vc.as_id,as_vstatus,as_status,checks_title,co.name AS 'client_name', CONCAT(first_name,' ',last_name) AS 'analyst_name', univ.uni_Name as 'uni_name', DATE(as_addate) as 'add_date', DATE(as_pdate) as 'progress_date' 
									,level_id,vd.com_id"; 
							$tbls = "ver_data vd 
									INNER JOIN ver_checks vc ON vd.v_id=vc.v_id 
									INNER JOIN checks c ON c.checks_id=vc.checks_id  
									INNER JOIN company co ON vd.com_id=co.id
									INNER JOIN users u ON u.user_id=vc.user_id
									INNER JOIN uni_info univ ON univ.uni_id=vc.as_uni"	;
							$WHERE = "(as_status='Open' OR as_status='Problem' OR as_status='Not Assign')
									and as_isdlt=0 
									and v_isdlt=0 
									and vd.com_id NOT IN (20,81,82,92)
									and (YEAR(as_addate)='".date('Y')."' OR YEAR(as_addate)='".$previous_year."') 
									and level_id IN (2,3,6) 
									and u.user_id NOT IN (210,211,212,201,3,23,50) 
									ORDER BY as_addate DESC ";
								// echo "SELECT $cols FROM $tbls WHERE $WHERE";
						$see=0;		 
$analyst= $db->select($tbls,$cols,$WHERE);
        if(mysql_num_rows($analyst)>0){
        while($analyst_arr = mysql_fetch_array($analyst)){
			$today = date("Y-m-j H:i:s");
			$days  = getDaysFromDates($today,$analyst_arr['add_date'],$analyst_arr['com_id']);
			$levelid = $analyst_arr['level_id'];
			if($levelid==2) $Title = "(Manager)"; else if($levelid==6) $Title = "(Finance)"; else if($levelid==12) $Title = ""; else  $Title = "";  
			
			
			 
			
			
			if($days == 12){
				$see++;
				$table12_count++;
				$table .= ' <tr>
				<td width="" style="font-size:12px; padding:5px;">'.$see.'</td>
                <td width="" style="font-size:12px; padding:5px;">'.$analyst_arr['analyst_name'].' '.$Title.'</td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['checks_title'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['uni_name'].'</a></td>
				 <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['client_name'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['add_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['progress_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$days.'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_status'].'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_vstatus'].'</a></td>
                
            </tr>	    '; 	 
				  
		$table12 .= ' <tr>
				<td width="" style="font-size:12px; padding:5px;">'.$see.'</td>
                <td width="" style="font-size:12px; padding:5px;">'.$analyst_arr['analyst_name'].' '.$Title.'</td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['checks_title'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['uni_name'].'</a></td>
				 <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['client_name'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['add_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['progress_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$days.'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_status'].'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_vstatus'].'</a></td>
                
            </tr>	    ';
		
		$db->update("delayed_reported=1","ver_checks","as_id=".$analyst_arr['as_id']);
		 
		}
		   
		if($table12_count == 0)
 		{
			$table12notrec = ' <tr>
				<td width="" colspan="10" style="text-align:center; font-size:18px;  padding:5px;">No Records In 12 Days</td>
                 </tr>';
 		}
		else
		{
			$table12notrec  = '';
		}
		
			
			  if($days == 22){
				$see++;
				$table22_count++;

				$table .= ' <tr>
				<td width="" style="font-size:12px; padding:5px;">'.$see.'</td>
                <td width="" style="font-size:12px; padding:5px;">'.$analyst_arr['analyst_name'].' '.$Title.'</td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['checks_title'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['uni_name'].'</a></td>
				 <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['client_name'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['add_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['progress_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$days.'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_status'].'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_vstatus'].'</a></td>
                
            </tr>	    '; 	
			
				  
		$table22 .= ' <tr>
				<td width="" style="font-size:12px; padding:5px;">'.$see.'</td>
                <td width="" style="font-size:12px; padding:5px;">'.$analyst_arr['analyst_name'].' '.$Title.'</td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['checks_title'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['uni_name'].'</a></td>
				 <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['client_name'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['add_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['progress_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$days.'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_status'].'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_vstatus'].'</a></td>
                
            </tr>	    ';
				 
		$db->update("delayed_reported=1","ver_checks","as_id=".$analyst_arr['as_id']);
		
		 
		}
		 if($table22_count == 0)
 		{
			$table22notrec = ' <tr>
				<td width="" colspan="10" style="text-align:center; font-size:18px; padding:5px;">No Records In 22 Days</td>
                 </tr>';
 		}
		else
		{
			$table22notrec  = '';
		}
		
		
			
			  if($days == 31){
				$see++;
				$table31_count++;				 
 				
				$table .= ' <tr>
				<td width="" style="font-size:12px; padding:5px;">'.$see.'</td>
                <td width="" style="font-size:12px; padding:5px;">'.$analyst_arr['analyst_name'].' '.$Title.'</td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['checks_title'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['uni_name'].'</a></td>
				 <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['client_name'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['add_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['progress_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$days.'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_status'].'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_vstatus'].'</a></td>
                
            </tr>	    '; 	
				 
		$table31 .= ' <tr>
				<td width="" style="font-size:12px; padding:5px;">'.$see.'</td>
                <td width="" style="font-size:12px; padding:5px;">'.$analyst_arr['analyst_name'].' '.$Title.'</td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['checks_title'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['uni_name'].'</a></td>
				 <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['client_name'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['add_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['progress_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$days.'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_status'].'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_vstatus'].'</a></td>
                
            </tr>	    ';
				 
		$db->update("delayed_reported=1","ver_checks","as_id=".$analyst_arr['as_id']);
		
		 
		}
		 
		 if($table31_count == 0)
 		{
			$table31notrec = ' <tr>
				<td width="" colspan="10" style="text-align:center; font-size:18px; padding:5px;">No Records In 31 Days</td>
                 </tr>';
 		}
		else
		{
			$table31notrec  = '';
		}
		
			
			  if($days == 40){
				$see++;
				 $table40_count++;
				$table .= ' <tr>
				<td width="" style="font-size:12px; padding:5px;">'.$see.'</td>
                <td width="" style="font-size:12px; padding:5px;">'.$analyst_arr['analyst_name'].' '.$Title.'</td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['checks_title'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['uni_name'].'</a></td>
				 <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['client_name'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['add_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['progress_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$days.'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_status'].'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_vstatus'].'</a></td>
                
            </tr>	    '; 	
				  
				$table40 .= ' <tr>
				<td width="" style="font-size:12px; padding:5px;">'.$see.'</td>
                <td width="" style="font-size:12px; padding:5px;">'.$analyst_arr['analyst_name'].' '.$Title.'</td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['checks_title'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['uni_name'].'</a></td>
				 <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['client_name'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['add_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['progress_date'].'</a></td>
                <td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$days.'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_status'].'</a></td>
				<td width="" style="font-size:14px; padding:5px;"><a href="'.SURL.'?action=details&case='.$analyst_arr['v_id'].'&_pid=81" target="_blank">'.$analyst_arr['as_vstatus'].'</a></td>
                
            </tr>';
				 
		 
		$db->update("delayed_reported=1","ver_checks","as_id=".$analyst_arr['as_id']);
		}  
		if($table40_count == 0)
 		{
			$table40notrec  = ' <tr>
				<td width="" colspan="10" style="text-align:center; font-size:18px; padding:5px;">No Records In 40 Days</td>
                 </tr>';
 		}
		else
		{
			$table40notrec = '';
		}
		 
		
	  
		
					
		}}  
		
 		
		
				$table .= "</table>";
				$table12 .= $table12notrec;
				$table22 .= $table22notrec;
				$table31 .= $table31notrec;
				$table40 .= $table40notrec;

				$table12 .= "</table>";
				$table22 .= "</table>";
				$table31 .= "</table>";
				$table40 .= "</table>";
				//$table40 .= $table40notrec;
				
				$subjects12 = "Opened Checks Details For 12 Days, (".$localDate.")";
				$subjects22 = "Opened Checks Details For 22 Days, (".$localDate.")";
				$subjects31 = "Opened Checks Details For 31 Days, (".$localDate.")";
				$subjects40 = "Opened Checks Details For 40 Days, (".$localDate.")";


				$to_email="khalique@xcluesiv.com";
				$fEmial="Verification Team";
				//$cMail="hzafar2010@gmail.com";
				$groupEmail = "mis@backcheckgroup.com";
				 //$groupEmail = "ata_inside110@hotmail.com";
				 
		 
		echo $table12."<br><br><br> ";			
		echo $table22."<br><br><br> ";				
		echo $table31."<br><br><br> ";				
		echo $table40."<br><br><br>";			

if($see!=0){

// 12 DAYS EMAIL //	
 emailTmp($table12,$subjects12,$to_email,'','','','',"Khalique");
emailTmp($table12,$subjects12,$groupEmail,'','','','',"Team");

 
// 22 DAYS EMAIL //	
 emailTmp($table22,$subjects22,$to_email,'','','','',"Khalique");
emailTmp($table22,$subjects22,$groupEmail,'','','','',"Team");


// 31 DAYS EMAIL //	
 emailTmp($table31,$subjects31,$to_email,'','','','',"Khalique");
emailTmp($table31,$subjects31,$groupEmail,'','','','',"Team");


// 40 DAYS EMAIL //	
 emailTmp($table40,$subjects40,$to_email,'','','','',"Khalique");
emailTmp($table40,$subjects40,$groupEmail,'','','','',"Team");


 }
}
 

?>