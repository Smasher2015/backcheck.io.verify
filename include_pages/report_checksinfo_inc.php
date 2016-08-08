<?php 
if(!is_numeric($_REQUEST['case'])) exit;
$riskwise = $_REQUEST['riskwise'];
$iware = getPage();
$pm_where = (base64_decode($_REQUEST['pm_where']))?base64_decode($_REQUEST['pm_where']):'';
if($iware['m_where']!='') $where=$iware['m_where']; else $iware['m_where']=''; 

$where =  ($pm_where)?$pm_where:$iware['m_where'];

//echo $where;
if($where=="as_status='Close' AND as_rating=0" || $where=="as_status='Close' AND as_rating!=0") {
	$prgresTh = "<th>Rating</th>";
	
}else if($where=="as_sent=4 AND as_status='Close' AND as_qastatus = 'Approved'" || $where=="as_sent=4 AND as_cdnld=1 AND as_status='Close'" || $where=="as_sent=4 AND as_status='Close' AND (as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found')" || $where=="as_status = 'Close' AND as_sent=4 AND as_vstatus NOT IN ('negative', 'match found', 'record found')" || $riskwise==1){
	$prgresTh = "<th>Download</th>";
	
} else {
	$prgres = "";
	$prgresTD = "";
}
//echo str_replace(" ","",strtolower($where));
?>
<div>
<table style="width:100%" class="static table datatable-basic dataTable no-footer tbl-inner">
	<thead>
        <tr class="danger">
        <th>&nbsp;</th>
<?php   $isSho = (($action=='assign' && $LEVEL==3) || ($LEVEL==2 && ($iware['m_action']=='assign' || $iware['m_action']=='assigned' || $iware['m_atype']=='send' || $iware['m_atype']=='ready' || $iware['m_action']=='problem')));
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
			<?php echo $prgresTh;?>
        </tr>
    </thead>
    <tbody>
	<?php 
        $checks = reportCheckDetails($_REQUEST['case'],"","$where");
        if(mysql_num_rows($checks)>0){
            while($checkInf = mysql_fetch_array($checks)){ 
				if($LEVEL==4){
					$onClick ="<a href='?action=details&case=$checkInf[v_id]&_pid=81#check_tab_$checkInf[as_id]'>".$checkInf['checks_title']."</a>";
				}else{
					$onClick ="<a href='?action=start&ascase=$checkInf[as_id]&_pid=$iware[m_id]'>".$checkInf['checks_title']."</a>";					
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
				$due_date = getdatedifference($checkInf['as_addate'], TAT,$checkInf['com_id']);
				$today = date("Y-m-j H:i:s");
				$days  = getDaysFromDates($today,$checkInf['as_addate'],$checkInf['com_id'],$checkInf['as_id']);
				
				$closed_days  = getDaysFromDates($checkInf['as_cldate'],$checkInf['as_addate'],$checkInf['com_id'],$checkInf['as_id']);
			
				if($checkInf['as_status'] != 'Close'){
				if($days<=11){
				$classs = "text-success";
					
				}else if ( $days>11 && $days<15){
				$classs = "text-yellow";	
				}else if ( $days>14){
				$classs = "text-red";	
				}
				}else{
					$classs = "";
					$closed_date = ($checkInf['as_cldate'])?date("d-M-Y",strtotime($checkInf['as_cldate'])):date("d-M-Y",strtotime($checkInf['as_pdate']));
					if($closed_days<=16){
				$daytitle = ($closed_days>1)?' days':' day';
				$classs = "text-success";
				$closed_title = "Closed in ".$closed_days.$daytitle."";	
				}else if ( $closed_days>16){
				$classs = "text-red";
				$closed_title = "Closed in ".$closed_days." days ";					
				}else{
					$classs="";
				}
					
					
				}
				
				?>
                <tr class="odd shown">
                	<td></td>
				<?php  if($isSho){ ?>
                	<td style="text-align:center;">
				<?php		if($checkInf['user_id']=='' || $iware['m_action']=='assigned' || $iware['m_atype']=='send' || $iware['m_atype']=='ready' || $iware['m_action']=='problem'){?>
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
					<td><span class="text-center <?php echo $classs;?>"><?php 
					echo ($checkInf['as_status'] == 'Close')?$closed_title:$days;
					?></span></td>
					
					
					
                    <?php /* <td>
                    	<div class="progress">
                        	<div style="width:<?=check_progress($checkInf)?>%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar">
                            	<span class="sr-only"></span>
                           </div>
                        </div>
                    </td>  */?>
					
					
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
						
						<a href="javascript:;" data-popup="tooltip" title="<?=get_check_progress($checkInf)?>% <?=($checkInf['as_qastatus']=='QA')?$checkInf['as_qastatus']: $checkInf['as_vstatus'] .$notifymsg;?>" data-placement="top"> 
						<div class="progress">
                                        <div class="progress-bar <?php echo $clr;?>" role="progressbar" aria-valuenow="<?=get_check_progress($checkInf)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=get_check_progress($checkInf)?>%;" data-original-title="" title="">
                                            <span class="sr-only"> </span>
                                        </div>
                                    </div>
                                    <?php
                                   // if($checkInf['as_status'] == "Open")
									//{$astatus = 'WIP';}else{$astatus = $checkInf['as_status'];}
									
									$notifi_Msgs = notifiMsgs($checkInf);
									if($notifi_Msgs != '' && $notifi_Msgs != '-'.$checkInf['as_vstatus'])
									{
										$notifymsg = " [".$notifi_Msgs."]";
									}
									else
									{
										$notifymsg = "";
									}
									
									?>
									</a>
						
								
						
                    </td>
					
					
                     
                    <?php 
						if($checkInf['as_qastatus'] == 'Rejected' ||  $checkInf['as_qastatus'] =='QA'){
					?>  
                    <td >
						<span class="label bg-grey-300">
							QC [In Progress]    
                        </span>
                    </td>
                    <?php }else{ ?>           
                    <td >
						<span class="label <?php $color = vs_Status(strtolower($checkInf['as_vstatus']));
						
						echo getColorClass($color);?>">
							<?php echo $checkInf['as_vstatus'].$notifymsg; ?>  
							<?php /* echo printableStatus($checkInf['as_status'],$checkInf['as_vstatus']) */?> 							
                        </span>
                    </td>
					<?php }?>
					
					<?php 
					if($where=="as_status='Close' AND as_rating=0"|| $where=="as_status='Close' AND as_rating!=0") {
					$prgresTD ='<td >
						<span class="">
						<div class="rating-div rating-checks">
						 <div id="rating-'.$checkInf['as_id'].'">
                <input type="hidden" name="rating" id="rating" value="'.$checkInf["as_rating"].'" />
                    <ul onMouseOut="resetRating('.$checkInf['as_id'].');">';
						
                        for($i=1;$i<=5;$i++) {
                        $selected = "";
							if(!empty($checkInf["as_rating"]) && $i<=$checkInf["as_rating"]) {
							$selected = "selected";
							}
                        
                        	$prgresTD .= '<li class="'.$selected.'" onmouseover="highlightStar(this,'.$checkInf['as_id'].');" onmouseout="removeHighlight('.$checkInf['as_id'].');" onClick="addRatingOnChecks(this,'.$checkInf['as_id'].');">&#9733;</li>';
                         }  
                   $prgresTD .= ' </ul>
                </div>
							  </div>
                        </span>
                    </td>';
					
					echo $prgresTD;
					}
					else if($where=="as_sent=4 AND as_status='Close' AND as_qastatus = 'Approved'" || $where=="as_sent=4 AND as_cdnld=1 AND as_status='Close'" || $where=="as_sent=4 AND as_status='Close' AND (as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found')" || $where=="as_status = 'Close' AND as_sent=4 AND as_vstatus NOT IN ('negative', 'match found', 'record found')" || $riskwise==1) {
					if($checkInf['as_status']=='Close'){
					$color = vs_Status(strtolower($checkInf['as_vstatus']));
					$clorClass = str_replace('bg','text',getColorClass($color));
					$pdfClick = "downloadPDF('pdf.php?pg=case&ascase=$checkInf[as_id]')";
					$pdfClickFullCase = "downloadPDF('pdf.php?pg=case&case=$checkInf[v_id]')";
					$prgresTD = '<td > <ul class="icons-list text-center"><li><a class="'.$clorClass.'" href="javascript:void(0);" onclick="'.$pdfClick.'" title="Download Single Check Report"  data-popup="tooltip" data-placement="top" data-container="body" data-trigger="hover"><i class="icon-file-download2"></i></a></li></ul>';
					}else{
						$prgresTD = '<td ><a class="ctooltips" href="javascript:void(0);">					
						<button type="button" class="btn btn-grey" disabled><i class="icon-cloud-download text-default"></i></button><span>Not ready for download</span></a>';
					}
					/* if($checkInf['v_status']=='Close'){
					$prgresTD .='<br /><br />
						
						<a class="ctooltips" href="javascript:void(0);">					
						<button type="button" class="btn btn-success" onclick="'.$pdfClickFullCase.'"><i class="icon-cloud-download"></i> Full Report</button><span>Download Full Case Report</span></a>';
					} */
						
                    $prgresTD .= '</td>';
					echo $prgresTD;
					}
					?>
                    
                    
                    
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