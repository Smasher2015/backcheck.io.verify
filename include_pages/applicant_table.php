<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Recently Updated Checks</h6>
									<div class="heading-elements">
										<span class="label bg-success heading-text"><?php echo count_Checks_By_Client($company_id,"as_status='Open'");?> active checks</span>
				                	</div>
								</div>

								<div class="table-responsive">
									<table class="table table-lg text-nowrap">
										<tbody>
											<tr>
												<td class="col-md-5">
													<div class="media-left">
														<div id="campaigns-donut"></div>
													</div>
												
													<div class="media-left">
														<h5 class="text-semibold no-margin"><?php echo count_Case_By_Client($company_id);?> <small class="text-success text-size-base"><i class="icon-arrow-up12"></i><!-- (+16.2%) --></small></h5>
														<ul class="list-inline list-inline-condensed no-margin">
															<li>
																<span class="status-mark border-success"></span>
															</li>
															<li>
																<span class="text-muted">total applicants</span>
															</li>
														</ul>
													</div>
												</td>

												<td class="col-md-5">
													<div class="media-left">
														<div id="campaign-status-pie"></div>
													</div>

													<div class="media-left">
														<h5 class="text-semibold no-margin"><?php echo count_Case_By_Client($company_id,"v_status!='Close'");?> <small class="text-danger text-size-base"><i class="icon-arrow-down12"></i><!-- (- 4.9%)--></small></h5>
														<ul class="list-inline list-inline-condensed no-margin">
															<li>
																<span class="status-mark border-danger"></span>
															</li>
															<li>
																<span class="text-muted">pendding applicants</span>
															</li>
														</ul>
													</div>
												</td>

												<td class="text-right col-md-2">
													<a href="?action=overall&atype=checks" class="btn bgc-success"><i class="icon-file-text2 position-left"></i> View detail</a>
												</td>
											</tr>
										</tbody>
									</table>	
								</div>

								<div class="table-responsive">
								
								
									<table class="table text-nowrap">
										<thead>
											<tr>
												<th>Applicant</th>
												<th class="col-md-2">Issuing Athority</th>
												<th class="col-md-2">Progress</th>
												<th class="col-md-2">Last Update</th>
												<th class="col-md-2">Status</th>
												<th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
											</tr>
										</thead>
										<tbody>
											<tr class="active border-double">
												<td colspan="5">Education</td>
												<td class="text-right">
													<span class="progress-meter" id="today-progress" data-progress="30"></span>
												</td>
											</tr>
											
								<?php  // latest 2 education checks
								$table = "ver_checks vc INNER JOIN ver_data  vd ON vc.v_id=vd.v_id LEFT JOIN uni_info uni ON vc.as_uni=uni.uni_id ";
								$where = "com_id = '$company_id' AND as_isdlt=0 AND v_isdlt=0 AND as_pdate IS NOT NULL AND checks_id=1 ORDER BY as_pdate DESC LIMIT 2";
								//echo "SELECT * FROM $table WHERE $where";
								$selChecks = $db->select($table,"*",$where);
								
											if(@mysql_num_rows($selChecks)>0){
											while($res = @mysql_fetch_assoc($selChecks)){
											$today = date("Y-m-j H:i:s");							
											$days  = getDaysFromDates($today,$res['as_addate'],'',$res['as_id']);
											$statuss = replacestatus($res['as_status']);
											
											$closed_days  = getDaysFromDates($res['as_cldate'],$res['as_addate'],'',$res['as_id']);
											if($res['as_status']=='Close'){ $days=$closed_days; }
											if($days>TAT){
											$progClass1 = "text-danger";
											$progClass2 = "icon-stats-decline2";												
											}else{
											$progClass1 = "text-success-600";
											$progClass2 = "icon-stats-growth2";		
											}
											
											$CheckProgress = get_check_progress($res);
											
											if($CheckProgress==25){
												$clr = '<span class="'.$progClass1.'"><i class="'.$progClass2.' position-left"></i> '.$CheckProgress.' %</span>';
											}else if($CheckProgress==100){
												$clr = '<span class="'.$progClass1.'"><i class="'.$progClass2.' position-left"></i> '.$CheckProgress.' %</span>';
											}
											else if($CheckProgress==75){
												$clr = '<span class="'.$progClass1.'"><i class="'.$progClass2.' position-left"></i> '.$CheckProgress.' %</span>';
											}else if($CheckProgress==50){
												$clr = '<span class="'.$progClass1.'"><i class="'.$progClass2.' position-left"></i> '.$CheckProgress.' %</span>';
											}
											$details_link = "?action=details&case=$res[v_id]&_pid=81#check_tab_$res[as_id]";
											$download_link = "downloadPDF('pdf.php?pg=case&ascase=$res[as_id]')";
											
											if($res['as_status']=='Close'){
											$clss = "bg-success-400";
											}else{
											$clss = "bg-blue";
											}
				
											?>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="<?php echo  $details_link; ?>" class="btn bg-primary-400 btn-rounded btn-icon btn-xs" title="<?php echo $res['v_name'];?>">
															<span class="letter-icon"></span>
														</a>
													</div>
													<div class="media-left">
														<div class=""><a href="<?php echo  $details_link; ?>" class="text-white text-semibold letter-icon-title" title="<?php echo $res['v_name'];?>"><?php echo $res['v_name'];?></a></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-blue position-left"></span>
															<?php echo date("d M Y",strtotime($res['as_addate']));?>
														</div>
													</div>
												</td>
												<td><span class="" title="<?php echo $res['uni_Name'];?>"><?php
													$uniName = (strlen($res['uni_Name'])>12)?substr($res['uni_Name'],0,12).'...':$res['uni_Name'];
													echo ($uniName!='')?$uniName:'N/A';?></span></td>
												<td><?php echo $clr;?></td>
												<td><?php echo date("d M Y",strtotime($res['as_pdate']));?></td>
												<td><span class="label <?php echo $clss;?>" title="<?php echo $statuss?>"><?php echo ($statuss=='Work In Progress')?'WIP':$statuss;?></span></td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="<?php echo  $details_link; ?>"><i class="icon-file-media"></i> View detail</a></li>
																<?php if($res['as_status']=='Close' && $res['as_sent']==4){?>
																<li><a href="javascript:;" onclick="<?php echo  $download_link; ?>"><i class="icon-file-stats"></i> Report download</a></li>
																<?php } ?>
															</ul>
														</li>
													</ul>
												</td>
											</tr>
											<?php }
											} ?>
											
											

											<tr class="active border-double">
												<td colspan="5">Previous Employment</td>
												<td class="text-right">
													<span class="progress-meter" id="yesterday-progress" data-progress="65"></span>
												</td>
											</tr>
											
											<?php  // latest 2 employment checks
								$table = "ver_checks vc INNER JOIN ver_data  vd ON vc.v_id=vd.v_id LEFT JOIN add_data ad ON ad.as_id=vc.as_id  ";
								$where = "com_id = '$company_id' AND as_isdlt=0 AND v_isdlt=0 AND d_type='dmain' AND as_pdate IS NOT NULL AND checks_id=2 ORDER BY as_pdate DESC LIMIT 2";
								//echo "SELECT * FROM $table WHERE $where";
								$selChecks = $db->select($table,"*",$where);
								
											if(@mysql_num_rows($selChecks)>0){
											while($res = @mysql_fetch_assoc($selChecks)){
											$today = date("Y-m-j H:i:s");							
											$days  = getDaysFromDates($today,$res['as_addate'],'',$res['as_id']);
											$statuss = replacestatus($res['as_status']);
											
											$closed_days  = getDaysFromDates($res['as_cldate'],$res['as_addate'],'',$res['as_id']);
											if($res['as_status']=='Close'){ $days=$closed_days; }
											if($days>TAT){
											$progClass1 = "text-danger";
											$progClass2 = "icon-stats-decline2";												
											}else{
											$progClass1 = "text-success-600";
											$progClass2 = "icon-stats-growth2";		
											}
											
											$CheckProgress = get_check_progress($res);
											
											if($CheckProgress==25){
												$clr = '<span class="'.$progClass1.'"><i class="'.$progClass2.' position-left"></i> '.$CheckProgress.' %</span>';
											}else if($CheckProgress==100){
												$clr = '<span class="'.$progClass1.'"><i class="'.$progClass2.' position-left"></i> '.$CheckProgress.' %</span>';
											}
											else if($CheckProgress==75){
												$clr = '<span class="'.$progClass1.'"><i class="'.$progClass2.' position-left"></i> '.$CheckProgress.' %</span>';
											}else if($CheckProgress==50){
												$clr = '<span class="'.$progClass1.'"><i class="'.$progClass2.' position-left"></i> '.$CheckProgress.' %</span>';
											}
											$details_link = "?action=details&case=$res[v_id]&_pid=81#check_tab_$res[as_id]";
											$download_link = "downloadPDF('pdf.php?pg=case&ascase=$res[as_id]')";
											
											if($res['as_status']=='Close'){
											$clss = "bg-success-400";
											}else{
											$clss = "bg-blue";
											}
											?>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="<?php echo  $details_link; ?>" class="btn bg-primary-400 btn-rounded btn-icon btn-xs" title="<?php echo $res['v_name'];?>">
															<span class="letter-icon"></span>
														</a>
													</div>
													<div class="media-left">
														<div class=""><a href="<?php echo  $details_link; ?>" class="text-white text-semibold letter-icon-title" title="<?php echo $res['v_name'];?>"><?php echo $res['v_name'];?></a></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-blue position-left"></span>
															<?php echo date("d M Y",strtotime($res['as_addate']));?>
														</div>
													</div>
												</td>
												<td><span class="" title="<?php echo $res['d_value'];?>"><?php
													$uniName = (strlen($res['d_value'])>12)?substr($res['d_value'],0,12).'...':$res['d_value'];
													echo ($uniName!='')?$uniName:'N/A';?></span></td>
												<td><?php echo $clr;?></td>
												<td><?php echo date("d M Y",strtotime($res['as_pdate']));?></td>
												<td><span class="label <?php echo $clss;?>" title="<?php echo $statuss;?>">
												<?php echo ($statuss=='Work In Progress')?'WIP':$statuss;?></span></td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="<?php echo  $details_link; ?>"><i class="icon-file-media"></i> View detail</a></li>
																<?php if($res['as_status']=='Close' && $res['as_sent']==4){?>
																<li><a href="javascript:;" onclick="<?php echo  $download_link; ?>"><i class="icon-file-stats"></i> Report download</a></li>
																<?php } ?>
															</ul>
														</li>
													</ul>
												</td>
											</tr>
											<?php }
											} ?>
											
											
											
											
											
											
											
											
											
										</tbody>
									</table>
								</div>
							</div>
