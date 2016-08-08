<?php 
if(!is_numeric($_REQUEST['case'])) exit;

$iware = getPage();
$pm_where = (base64_decode($_REQUEST['pm_where']))?base64_decode($_REQUEST['pm_where']):'';
if($iware['m_where']!='') $where=$iware['m_where']; else $iware['m_where']=''; 

$where =  ($pm_where)?$pm_where:$iware['m_where'];


if($where=="as_status='Close' AND as_rating=0" || $where=="as_status='Close' AND as_rating!=0") {
	$prgresTh = "<th>Rating</th>";
	
}else if($where=="as_sent=4 AND as_cdnld=0 AND as_status='Close'"){
	$prgresTh = "<th>Download</th>";
	
} else {
	$prgres = "";
	$prgresTD = "";
}
?>
<div style="border-bottom:#EF3C42 solid 5px;">
<table style="width:100%" class="static">
	<thead>
        <tr>
        <th>&nbsp;</th>
<?php   $isSho = (($action=='assign' && $LEVEL==3) || ($LEVEL==2 && ($iware['m_action']=='assign' || $iware['m_action']=='assigned' || $iware['m_atype']=='send' || $iware['m_atype']=='ready' || $iware['m_action']=='problem')));
		if($isSho){ ?>
        	<th>&nbsp;</th>
<?php   }?>
            <th >Check Title</th>
            <th>Analyst Name</th>
             <th>Progress</th>
            
           <?php /*?> <th >Verification Status</th>
			<?php echo $prgresTh;?><?php */?>
            <th >QA Status</th>
        </tr>
    </thead>
    <tbody>
	<?php 
        $checks = QAreportCheckDetails($_REQUEST['case'],"","$where");
        if(mysql_num_rows($checks)>0){
            while($checkInf = mysql_fetch_array($checks)){ 
				if($LEVEL==4){
					$onClick ="javascript:void(0);";
				}else{
					$onClick ="?action=start&ascase=$checkInf[as_id]&_pid=$iware[m_id]";					
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
						<a href="<?=$onClick?>"><?=$checkInf['checks_title']?></a>
                    </td>
                    <td ><?php
                        if($checkInf['user_id']!=''){
                            $userInfo = getUserInfo($checkInf['user_id']);
                            echo trim($userInfo['first_name'].' '.$userInfo['last_name']);
                        }else{
                            echo "Not Assigned";
                        }
                    ?></td>
					
                    <td>
                    	<div class="progress">
                        	<div style="width:<?=check_progress($checkInf)?>%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar">
                            	<span class="sr-only"></span>
                           </div>
                        </div>
                    </td> 
                                 
                    <?php /*?><td >
						<span class="f<?=vs_Status(strtolower($checkInf['as_vstatus']))?>">
							<?=$checkInf['as_vstatus']?> [ <?=$checkInf['as_status'].notifiMsgs($checkInf)?> ]     
                        </span>
                    </td><?php */?>
					
					
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
					else if($where=="as_sent=4 AND as_cdnld=0 AND as_status='Close'") {
					$pdfClick = "downloadPDF('pdf.php?pg=case&ascase=$checkInf[as_id]')";
					$prgresTD = '<td >					
						<button type="button" class="btn btn-success" onclick="'.$pdfClick.'"><i class="icon-cloud-download"></i> Download Report</button>
                    </td>';
					echo $prgresTD;
					}
					?>
                    
                    <td >
						<span>
							<?=$checkInf['as_qastatus']?>      
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