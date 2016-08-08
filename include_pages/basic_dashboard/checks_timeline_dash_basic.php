<?php 
			$tbls = "ver_checks vc 
			INNER JOIN ver_data vd ON vc.v_id=vd.v_id 
			INNER JOIN checks c ON vc.checks_id=c.checks_id ";
			$cols = "vc.v_id,v_date,v_name,vc.as_id,as_uadd,DATE(as_addate) AS as_addate,DATE(as_cldate) AS as_cldate,as_status,as_vstatus,as_uni,v_status,vc.user_id,DATE(as_pdate) AS as_pdate,checks_title,thum,vc.checks_id";
			$whr = "v_isdlt=0 AND as_isdlt=0 AND com_id='$company_id' AND vc.checks_id IN (1,2) $dateRange $location_users ORDER BY v_date DESC LIMIT 0,20";
			//echo "SELECT $cols FROM $tbls WHERE  $whr";
			$latestCases = $db->select($tbls,$cols,$whr);
			if(@mysql_num_rows($latestCases)>0){
?>
<div class="timeline timeline-center content-group">
						<div class="timeline-container" id="loadmore_timeline_dash">
                        
                        	<!-- Messages -->
			<?php 
			
			$c=0;
			$cn=0;
			
			while($rsCase = @mysql_fetch_assoc($latestCases)){
				$cn++;
				//echo $cn.'. '.$rsCase[v_name]."<br>";
			$Att = $db->select("attachments","att_insuff,DATE(att_insuff_date) AS att_insuff_date","checks_id=$rsCase[as_id] AND att_active=1 AND att_insuff=1 ORDER BY att_insuff_date ASC");
			$InsuffCount = @mysql_num_rows($Att);
			while($rsAtt = @mysql_fetch_assoc($Att)){
			$InsuffDate = $rsAtt['att_insuff_date'];
			}	
			$add_data = $db->select("add_data","*","as_id=$rsCase[as_id] AND d_isdlt=0");
			$add_data_cnt = @mysql_num_rows($add_data);
			$clss2 = ($rsCase['as_status']=='Close')?"bg-success":"bg-red";
			$clss1 = "";
			$c++;
			if($c==2){
			$c=0;
			}
			if($c==0){
			$clss1 = "post-even";
			$clss2 = ($rsCase['as_status']=='Close')?"bg-success":"bg-info-400";
			}
			$download_check='';
			$download_case='';
			
			if($rsCase['as_status']=='Close' &&  $rsCase['as_status']!='Rejected'){
			$download_check = "onclick=\"downloadPDF('pdf.php?pg=case&ascase=$rsCase[as_id]');\"";
			if($rsCase['v_status']=='Close'){
			$download_case = "onclick=\"downloadPDF('pdf.php?pg=case&case=$rsCase[v_id]');\"";	
			}			
			}
			$view_case = SURL."?action=details&case=$rsCase[v_id]&_pid=183";
			$view_check = SURL."?action=details&case=$rsCase[v_id]&_pid=183&#check_tab_$rsCase[as_id]";
			
			?>
							<div class="timeline-row <?php echo $clss1;?>">
								<div class="timeline-icon">
								<?php if($rsCase['thum']=='images/default.png'){?>
								<div class="<?php echo $clss2;?>"><i class="letter-icon"></i></div>
								<?php }else{ ?>
								<a href="<?php echo $view_case;?>">
										<img src="<?php echo $rsCase['thum']; ?>"><i class="letter-icon" style="display:none;"></i>
									</a>
								
								<?php } ?>
									
								</div>

								<div class="timeline-time">
									<a href="<?php echo $view_case;?>" target="_blank"><?php echo $rsCase['v_name'];?></a> 
									<span class="text-muted"><?php echo dateTimeExe($rsCase['v_date']);?></span>
								</div>
								<div class="timeline-content">
                               
                             
								
								<div class="panel border-left-lg border-left-danger invoice-grid">
									<div class="panel-heading">
										<h6 class="text-semibold no-margin-top"><a href="<?php echo $view_check;?>" target="_blank"><?php echo $rsCase['checks_title'];?></a></h6>
										<div class="heading-elements">
											<span class="heading-text"  data-popup="tooltip" title="" data-placement="top" data-original-title="Added"><i class="icon-checkmark-circle position-left text-success"></i><?php echo dateTimeExe($rsCase['as_addate']);?></span>
						<?php
						if($rsCase['as_status']=='Open' && $rsCase['as_vstatus']=='Not Initiated'){
						$statusTitle = 'Not Initiated';	
						$closeClas = 'bg-grey-300';
						}else if($rsCase['as_status']=='Open'){
						$statusTitle = 'WORK IN PROGRESS';	
						$closeClas = 'bg-grey-300';
						}else if($rsCase['as_status']=='Close'){
						$statusTitle = $rsCase['as_vstatus'];
						$color = vs_Status(strtolower($statusTitle)); 
						$closeClas = getColorClass($color);						
						}else{
						$statusTitle = $rsCase['as_status'];	
						if($statusTitle=='Insufficient'){
						$closeClas = 'bg-red';
						}else{
						$closeClas = 'bg-grey-300';	
						}
						}
						
						?>
                                           <span class="heading-text ml-10"><span class="label <?php echo $closeClas;?>"><?php echo $statusTitle;?></span></span>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a><a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>

									<div class="panel-body">
										<?php 
											$workedBy = getUserInfo($rsCase[user_id]);
											$addedBy = getUserInfo($rsCase[as_uadd]);
											$addedByfullname = $addedBy[first_name].' '.$addedBy[last_name];
											$workedByfullname = $workedBy[first_name].' '.$workedBy[last_name];
											$addedByfullnameLink = "<a href='#' >$addedByfullname</a>";
											$workedByfullnameLnik = "<a href='#' >$workedByfullname</a>";
											
											?><p class="content-group">
											<i class="icon-user-plus position-left text-success"></i>
											Check added by <?php echo $addedByfullnameLink; ?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($rsCase['as_addate']);?></span>
										</p>
										<?php
										if($rsCase['as_status']=='Insufficient'){
				
										$Insuf_Init = "Check marked as Insufficient.";	
										$totalInsuff = $InsuffCount;
										$Insuf_Init_Date = $InsuffDate;
										?> <p class="content-group">
											<i class="position-left text-danger icon-flag4"></i>
											<?php echo $Insuf_Init;?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($Insuf_Init_Date);?></span>
										</p>
										<?php 								
										}
										else if($rsCase['as_vstatus']=='Not Initiated'){
			
										$Insuf_Init = "Check not initiated yet.";
										$Insuf_Init_Date = $rsCase['as_addate'];
										
										?>	<p class="content-group">
											<i class="position-left text-teal icon-pause2"></i>
											<?php echo $Insuf_Init;?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($Insuf_Init_Date);?></span>
										</p>
									
										<?php 
										}else if($rsCase['as_vstatus']!='Not Initiated'){
										$cF =0;
										$cFPHONE =0;
										while($rsAddata = @mysql_fetch_assoc($add_data)){
										$checks_id = $rsCase['checks_id'];
										
										if($checks_id==2){
										if($rsAddata[as_id]==$rsCase[as_id]){
										if($rsAddata['d_type']=='dmain'){
										$uniTitle = $rsAddata['d_value'];
										$data_date = $rsAddata['data_date'];	
										$Insuf_Init_Date = $data_date;
										$uniTitle = substr($uniTitle,0,50);
										$uniTitle = (strlen($rsAddata['d_value'])>50)?$uniTitle.'...':$rsAddata['d_value'];
										$Unilinks = "<a href='#' data-popup='tooltip' data-placement='top' data-original-title='$rsAddata[d_value]' >$uniTitle</a>";
										$Insuf_Init = "Check initiated.";	
										
										?>	<p class="content-group">
											<i class="position-left text-purpal icon-play4"></i>
											<?php echo $Insuf_Init;?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($Insuf_Init_Date);?></span>
											</p>
											<p class="content-group">
											<i class="position-left text-yellow icon-paperplane"></i>
											<?php echo "Send to $Unilinks.";?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($Insuf_Init_Date);?></span>
											</p>
										<?
										}
										}
										}
										if($checks_id==1){
										if($rsAddata[as_id]==$rsCase[as_id]){
										if($rsAddata['d_type']=='vuni'){
										$uniTitle = $rsAddata['d_value'];
										$data_date = $rsAddata['data_date'];	
										$Insuf_Init_Date = $data_date;
										$uniTitle = substr($uniTitle,0,50);
										$uniTitle = (strlen($rsAddata['d_value'])>50)?$uniTitle.'...':$rsAddata['d_value'];
										$Unilinks = "<a href='#' data-popup='tooltip' data-placement='top' data-original-title='$rsAddata[d_value]' >$uniTitle</a>";
										$Insuf_Init = "Check initiated.";	
										
										?>	<p class="content-group">
											<i class="position-left text-purpal icon-play4"></i>
											<?php echo $Insuf_Init;?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($Insuf_Init_Date);?></span>
											</p>
											<p class="content-group">
											<i class="position-left text-yellow icon-paperplane"></i>
											<?php echo "Send to $Unilinks.";?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($Insuf_Init_Date);?></span>
											</p>
										<?
										}										
										}
										}
										if($rsAddata['d_type']=='followup'){
											
										$followupByUser = getUserInfo($rsAddata[user_id]);
										$followupByfullname = $followupByUser[first_name];
										$followupByfullnameLnik = "<a href='#' >$followupByfullname</a>";
										if($rsAddata['d_mtitle']=='Call'){
										$followBy='Call';	
										$followIcon='icon-phone2';
										}
										if($rsAddata['d_mtitle']=='Email' || $rsAddata['d_mtitle']==''){
										$followBy='Email';
										$followIcon='icon-envelop';
										}
										if($rsAddata['d_mtitle']=='Fax'){
										$followBy='Email';
										$followIcon='icon-printer2';
										}
										if($rsAddata['d_mtitle']=='Online'){
										$followBy='Email';
										$followIcon='icon-station';
										}
										if($rsAddata['d_mtitle']=='Courier'){
										$followBy='Email';
										$followIcon='icon-mailbox';
										}
										
										$cF++;
										$data_date = $rsAddata['data_date'];
										$Insuf_Init = 'Followup by '.$followupByfullnameLnik.' via '.$followBy.'';	
										$Insuf_Init_Date = $data_date;
																	
										?>	<p class="content-group">
											<i class="position-left text-primary <?php echo $followIcon;?>"></i>
											<?php echo $Insuf_Init;?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($Insuf_Init_Date);?></span>
											</p> 
											<?php
										}
										}
										}
										if($rsCase['as_status']=='Close' &&  $rsCase['as_status']!='Rejected'){
										$step1 = 3;
										$Insuf_Init = "Check has been closed and ready for <a href='javascript:;' $download_check><i class='icon-file-download2'></i> Download</a>.";	
										$Insuf_Init_Date = $rsCase['as_cldate'];
										$color = vs_Status(strtolower($rsCase['as_vstatus'])); 
										$closeClas = str_replace('bg-','text-',getColorClass($color));
										
										?>	<p class="content-group">
											<i class="<?php echo $closeClas;?> icon-checkmark-circle position-left" data-popup='tooltip' data-placement='top' data-original-title='<?php echo $rsCase[as_vstatus];?>'></i>
											<?php echo $Insuf_Init;?>
											<span class="pull-right text-muted"><?php echo dateTimeExe($Insuf_Init_Date);?></span>
											</p>
										<?php 
										}
										?>
										 
                                       

										
									</div>

									<div class="panel-footer">
											<ul> 
											<?php 
											if($rsCase['as_status']=='Close' &&  $rsCase['as_status']!='Rejected'){ 
											$Upd_title="Closed:";
											$Upd_date = $rsCase['as_cldate'];
											$Upd_clr = "border-success";
											
											}else{
											$Upd_title="Updated:";
											$Upd_date = ($rsCase['as_pdate']!='')?$rsCase['as_pdate']:$rsCase['as_addate'];
											$Upd_clr = "border-danger";	
											} ?>
												<li><span class="status-mark <?php echo $Upd_clr;?> position-left"></span> 
												<?php echo $Upd_title;?> <span class="text-semibold"><?php echo dateTimeExe($Upd_date);?></span></li>
											</ul>

											<ul class="pull-right">
												
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
													<ul class="dropdown-menu dropdown-menu-right">
														<li><a href="<?php echo $view_case;?>"><i class="icon-eye2"></i> View Case Details</a></li>
														<li><a href="<?php echo $view_check;?>"><i class="icon-eye2"></i> View Check Details</a></li>
														<?php echo ($download_case!="")?'<li><a href="javascript:;" '.$download_case.'><i class="icon-file-download2 text-info"></i>Download Case Report</a></li>':'';
														
														echo ($download_check!="")?'<li><a href="javascript:;" '.$download_check.'><i class="icon-file-download2 text-info"></i>Download Check Report</a></li>':'';
														?>
														
													</ul>
												</li>
											</ul>
										</div>
                                    
								</div>
								
								
                                </div>
							</div>
			<?php 
			
		
			
			} 
			?>
							                    
							


							<!-- Schedule -->
							
							<!-- /schedule bg-info-400 panel   -->
		
						</div>
						
				    </div>
<div class="text-center timeline-row-full no-recordss" style="display:none;"><div class="panel-body"><span>No More records to load</span></div></div>
			<?php } 
			else
			{?>
			<div class="text-center timeline-row-full" ><div class="panel-body"><span>No records available</span></div></div>	
			<?php } ?>