<?php 
if(!is_numeric($_REQUEST['case'])) exit;

$iware = getPage();
//var_dump($iware);
$pm_where = (base64_decode($_REQUEST['pm_where']))?base64_decode($_REQUEST['pm_where']):'';
if($iware['m_where']!='') $where=$iware['m_where']; else $iware['m_where']=''; 

if($LEVEL==3 || $LEVEL==12) $where = "$where AND vc.user_id=$_SESSION[user_id]";
//echo $where;
$clss = (!isset($_REQUEST['buid']))?'static':'';

//$where =  ($pm_where)?$pm_where:$iware['m_where'];?>
<div style="border-bottom:#EF3C42 solid 5px;">
<table style="width:100%" class="<?php echo $clss;?>">
	<thead>
        <tr>
        
<?php   $isSho = ( ($action=='notin' && $LEVEL==2 && $_SESSION['user_id']==293) || ($action=='assign' && $LEVEL==1) || ($action=='assign' && $LEVEL==3) || ($LEVEL==2 && ($iware['m_action']=='assign' || $iware['m_action']=='assigned' || $iware['m_atype']=='send' || $iware['m_atype']=='ready' || $iware['m_action']=='problem')));
		if($isSho){ ?>
        	<th>&nbsp;</th>
<?php   }?>

            <th >Check Title</th>
            <th>Analyst Name</th>
			<th>Recieved Date</th>
			<th>Due Date</th>
			<th>Closed Date</th>
			<th>Days</th>
			
             <th>Progress</th>
            
            <th >Verification Status</th>
        </tr>
    </thead>
    <tbody>
	<?php 
        $checks = checkDetails($_REQUEST['case'],"","$where");
        if(mysql_num_rows($checks)>0){
            while($checkInf = mysql_fetch_array($checks)){ 
				if($LEVEL==4 || isset($_REQUEST['buid'])){
					$onClick = (!isset($_REQUEST['buid']))?"<a href='".SITE_URL."?action=details&case=$checkInf[v_id]&_pid=81#check_tab_".$checkInf['as_id']."' target='_blank'>".$checkInf['checks_title']."</a>":"<a href='http://my.backcheck.io/company/personal/user/$_REQUEST[buid]/tasks/task/view/$checkInf[bitrixtid]/' target='_blank'>".$checkInf['checks_title']."</a>";
					
					
				}else{
					$onClick ="<a href='".SITE_URL."?action=start&ascase=$checkInf[as_id]&_pid=$iware[m_id]' target='_blank'>".$checkInf['checks_title']."</a>";					
				}
				$pdfClick = "downloadPDF('pdf.php?pg=case&ascase=$checkInf[as_id]')"; 

				$acPdf = $db->select("activity","COUNT(a_type) cnt","a_type='pdf' AND user_id=$USERID AND ext_id=$checkInf[as_id]");
				$acPdf = mysql_fetch_array($acPdf);
				if($acPdf['cnt']>0) $PdfIcon="PDF_download_icn.png"; else $PdfIcon="PDF_download_icn.png"; 
				$csSts = strtolower($checkInf['as_status']); 
				if($LEVEL==4){
						if($checkInf['as_sent']!=4){
							$csSts='open';
						}
				}
				
				// by khl
				$receive_date = date("d-M-Y",strtotime($checkInf['as_addate']));
				$due_date = getdatedifference($checkInf['as_addate'], TAT);
				$today = date("Y-m-j H:i:s");
				$days  = getDaysFromDates($today,$checkInf['as_addate'],'',$checkInf['as_id']);
				
				$closed_days  = getDaysFromDates($checkInf['as_cldate'],$checkInf['as_addate'],'',$checkInf['as_id']);
			
				if($checkInf['as_status'] != 'Close'){
				if($days<=11){
				$classs = "green_cheks";
					
				}else if ( $days>11 && $days<15){
				$classs = "orange_cheks";	
				}else if ( $days>14){
				$classs = "red_cheks";	
				}
				}else{
					$classs = "";
					$closed_date = ($checkInf['as_cldate'])?date("d-M-Y",strtotime($checkInf['as_cldate'])):date("d-M-Y",strtotime($checkInf['as_pdate']));
					if($closed_days<=16){
				$daytitle = ($closed_days>1)?' days':' day';
				$classs = "green_cheks";
				$closed_title = "Closed in ".$closed_days.$daytitle;	
				}else if ( $closed_days>16){
					
				$classs = "red_cheks";
				$closed_title = "Closed in ".$closed_days." days ";					
				}else{
					$classs="";
				}
					
					
				}
				
				?>
                <tr>
                	
				<?php  if($isSho){ ?>
                	<td style="text-align:center;">
				<?php	


				if(($iware['m_action']=='notin' && $LEVEL==2 && $_SESSION['user_id']==293) || $checkInf['user_id']=='' || $iware['m_action']=='assigned' || $iware['m_atype']=='send' || $iware['m_atype']=='ready' || $iware['m_action']=='problem'){?>
                            	<input style="margin-bottom:2px;" type="checkbox" name="vchecks[]" value="<?=$checkInf['as_id']?>">
                <?php 		}else{ ?>
								<img src="img/tick.png" width="20px"  />		
				<?php    	} ?>
					 </td>
				<?php	}?>                    
                    <td >
						<?=$onClick?>
                    </td>
                    <td ><?php
                        if($checkInf['user_id']!=''){
                            $userInfo = getUserInfo($checkInf['user_id']);
                            echo trim($userInfo['first_name'].' '.$userInfo['last_name']);
                        }else{
                            echo "Not Assigned";
                        }
                    ?></td>
					<td><?php 
					
					echo $receive_date;
					?></td>
					<td><?php
					
					
					echo $due_date;
					?></td>
					<td ><?php 
					echo ($checkInf['as_status'] == 'Close')?$closed_date:" Not Closed Yet";
					
					
					?></td>
					<td class="<?php echo $classs;?>"><?php 
					echo ($checkInf['as_status'] == 'Close')?$closed_title:$days;
					?></td>
					
					
                    <td>
                    	<?php $CheckProgress = get_check_progress($checkInf);
						if($CheckProgress==25){
							$clr = 'progress-bar-info';
						}else if($checkInf['as_status']=='Close'){
							$clr = 'progress-bar-success';
						}
						else if($CheckProgress==75){
							$clr = 'progress-bar-warning';
						}else if($CheckProgress==50){
							$clr = '';
						}
						?>
						
						<a class="ctooltips" href="#"> 
						<div class="progress progress-striped">
                                        <div class="progress-bar <?php echo $clr;?>" role="progressbar" aria-valuenow="<?=get_check_progress($checkInf)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=get_check_progress($checkInf)?>%;" data-original-title="" title="">
                                            <span class="sr-only"> </span>
                                        </div>
                                    </div>
									<span><?=get_check_progress($checkInf)?>% <?=($checkInf['as_qastatus']=='QA')?$checkInf['as_qastatus']: $checkInf['as_vstatus'] .' [ '.$checkInf['as_status'].notifiMsgs($checkInf).' ]'?></span>
									</a>
						
						
						
						
						
						
						
						
                    </td> 
                                 
                    <td >
						<span class="label <?php $color = vs_Status(strtolower($checkInf['as_vstatus'])); 
						echo getColorClass($color);?>">
							<?=$checkInf['as_vstatus']?> [ <?=$checkInf['as_status'].notifiMsgs($checkInf)?> ]     
                        </span>
                    </td>
                    
                    
                    
                </tr>	
    <?php	}}else{ ?>
        <tr>
            <td colspan="<?=($isSho)?'6':'5'?>" >
                <h2 align="center">No Check</h2>
            </td>
        </tr>
    <?php	} ?>
    </tbody>
</table>
</div>