<?php

switch($_REQUEST['filter_what']){
	
	case"ready_download";
			$selFilters = getFiltersBy('ready_download','as_cldate');
			$addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:''; 
			
			$data = client_checks_info("as_sent=4 AND as_cdnld=0 AND as_status='Close' $addFilter ","LIMIT 4");
			if($data){
									  while($row = mysql_fetch_assoc($data)){ 
									  $pdfClick = "downloadPDF('pdf.php?pg=case&ascase=$row[as_id]')";
									    $pdfClickFullCase = "downloadPDF('pdf.php?pg=case&case=$row[v_id]')"; ?>                            
                                            <li class="list-group-item readydownload">
                                                <i><img src="<?=$row['image']?>" alt="<?=$row['v_name']?>"></i>
                                                <div class="text-holder">
                                                    <span class="title-text">
                                                         <?=$row['v_name']?>
                                                    </span>
                                                    <span class="description-text">
                                                       <?=time_ago(strtotime($row['as_stdate']))?>
                                                    </span>
                                                </div>
                                               
                                                    <div class="stat-value">
                                                     <a class="" title="Download Single Check Report" href="javascript:;" onclick="<?=$pdfClick?>"><i class="icon-cloud-download"  style="font-size:20px; color:#D4212B;"></i></a>
			  &nbsp;&nbsp;&nbsp;
			  
			  <a title="Download Full Case Report" href="javascript:;"  onclick="<?=$pdfClickFullCase?>"><i class="icon-cloud-download" style="font-size:20px; color:green;"></i></a>
                                                </div>
                                                
                                            </li>
                                 <?php }
								}else {
									?>
									<li class="list-group-item">No Record available !</li>
								<?php }
			
	break;
	case"progress_overview":
			$selFilters = getFiltersBy('progress_overview','as_cldate');
			$selAll = getFiltersBy('progress_overview','as_addate');
			$addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:''; 
			$addFilter_all = str_replace('AND','',$selAll['filter_where']);
			
						
						//echo $addFilter;
						// For By Status Chart Checks
						$discrepancy_checks 	= countChecks("as_vstatus='Discrepancy' $addFilter");
						$need_attention_checks 	= countChecks("as_status='problem' $addFilter");
						
						$submitted_checks 		= countChecks($addFilter_all);
						$completed_checks 		= countChecks("as_status='Close' $addFilter");
						
						$wipchecks   			= ($submitted_checks-$completed_checks);	
						$pending_check  		= $submitted_checks - $completed_checks;
						$per_subs_check 		= $completed_checks * 100;
						if($submitted_checks > 0){
						$percentage_check		= $per_subs_check / $submitted_checks;
						}else{
						$percentage_check = 0;	
						}
						$percentage_check 			= ceil($percentage_check);
						
						
						
						$closecas = countCases("(v_status='Close' AND v_sent=4 $addFilter)");
						//For Progress
						$user_id = $_SESSION['user_id'];
						$user_info = getUserInfo($user_id);
						$user_com_id = $user_info['com_id'];
						$total = countCases("as_isdlt = 0 $addFilter");
						//$pending = $total - $closecas;
						$pending = $total - $closecas;
						$per_subs = $closecas * 100;
						if($total>0){
						$percentage = $per_subs / $total;
						}else{
						$percentage =0;	
						}
						$percentage = ceil($percentage);
						//echo $div;

						?>
                            <li class="sub-list">
                                <ul>
                                    <li class="list-group-item">
                                        <span class="title-text">
                                            Compeleted checks
                                        </span>
                                        <span class="processed-value">
                                           <?php echo $completed_checks; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="title-text">
                                            Pending checks
                                        </span>
                                        <span class="processed-value">
                                             <?php echo $pending_check; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="title-text">
                                           Total checks
                                        </span>
                                        <span class="processed-value">
                                           <?php echo $submitted_checks;?>
                                        </span>
                                    </li>
                                </ul>
                            </li>
                            <li class="widget-progress-bar">
                                <div class="form-group">
                                    <label>Processed checks: <?php  echo $percentage_check; ?>%</label>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php  echo $percentage_check; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php  echo $percentage_check; ?>%">
                                            <span class="sr-only"><?php  echo $percentage_check; ?>% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                 
						<?php
		break;
		case"work_in_progress":	

			$selFilters = getFiltersBy('work_in_progress','as_pdate');
			$addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:''; 
								//echo $addFilter;
								$data = client_checks_info("as_status!='close' AND as_sent!=4 AND v_isdlt=0 And c.as_pdate IS NOT NULL $addFilter","LIMIT 4");
								if($data){
									  while($row = mysql_fetch_assoc($data)){ 
									  ?> 
                                            <li class="list-group-item" onclick="goto_case(<?=$row['v_id']?>,false)">
                                            <i><img src="<?=$row['image']?>" alt="<?=$row['v_name']?>"></i>
                                            <div class="text-holder">
                                            <span class="title-text">
                                            	 <?=$row['v_name']?>
                                            </span>
                                            <span class="description-text">
                                            Check: <?=$row['checks_title']?>
                                            </span>
                                            </div>
                                            <span class="stat-value">
                                             <?=time_ago(strtotime($row['as_pdate']))?>
                                            </span>
                                            </li>
                                <?php }
								}else { ?>
								<li class="list-group-item">No record available !</li>
								<?php } 
		break;
		
		case"by_risk":
				
				$selFilters = getFiltersBy('by_risk','as_cldate');
				$addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:'';
				
				$where = "as_status='Close'";
				if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){
					$where = "$where AND com_id=20";
				}elseif($LEVEL==4) $where = "$where AND com_id=$COMINF[id]";

				$cols = "(SELECT DATE_FORMAT(as_date, '%b-%y') mnth,COUNT(as_vstatus) cnt,
						IF((as_vstatus='verified' || as_vstatus='satisfactory' || as_vstatus='no match found'
						|| as_vstatus='no record found' || as_vstatus='positive match found'), 'green',
						IF((as_vstatus='negative' || as_vstatus='match found' || as_vstatus='record found'),'red',
						IF((as_vstatus='unable to verify' || as_vstatus='discrepancy'),'amber','na'))) sts,as_date FROM ver_checks inner join ver_data on ver_checks.v_id=ver_data.v_id ";
				$cols ="$cols WHERE  $where AND as_isdlt=0 AND as_date!='0000-00-00 00:00:00' $addFilter  GROUP BY mnth,sts ORDER BY as_date DESC LIMIT 36) DATA";
				//echo $cols;
				$months = $db->select($cols,"*","1=1 ORDER BY as_date");

				$tData = array(); $mData = array();
				while($month = mysql_fetch_assoc($months)){
					if(!isset($tData[$month['mnth']]['red'])){
						$tData[$month['mnth']]['red']   = 0;
						$tData[$month['mnth']]['green'] = 0;
						$tData[$month['mnth']]['amber'] = 0;
						$mData[$month['mnth']] = 0;
					}
					$mData[$month['mnth']]          = $mData[$month['mnth']]+$month['cnt'];
					$tData[$month['mnth']][$month['sts']] = $month['cnt'];	 
				}
				$at=0; foreach($tData as $mon=>$val){ $at+=$val['amber'];}
				$rt=0; foreach($tData as $mon=>$val){ $rt+=$val['red'];}
				$gt=0; foreach($tData as $mon=>$val){ $gt+=$val['green'];}
				
				
				echo $at.';'.$rt.';'.$gt; exit;
		
		
		
		break;
		
		Case"by_status":
		
	$selFilters = getFiltersBy('by_status','as_addate');
	$selClose = getFiltersBy('by_status','as_cldate');
	$addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:'';
	$addClose = ($selClose['filter_where'])?$selClose['filter_where']:'';
	$addFilter_all = str_replace('AND','',$addFilter);
	// For By Status Chart Checks
	$discrepancy_checks 	= countChecks("as_vstatus='Discrepancy' $addFilter");
	$need_attention_checks 	= countChecks("as_status='problem' $addFilter");
	$submitted_checks 		= countChecks($addFilter_all);
	$completed_checks 		= countChecks("as_status='Close' $addClose" );
	$wipchecks   			= ($submitted_checks-$completed_checks);	

?>
<!--Browser Version	Total Market Share-->

Completed 	<?php echo $completed_checks; ?>%
In Progress 	<?php echo $wipchecks; ?>%
Need Attention 	<?php echo $need_attention_checks; ?>%
Discrepancy 	<?php echo $discrepancy_checks; ?>%
	
  <?php                   
}

?>
