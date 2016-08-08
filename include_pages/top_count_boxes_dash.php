 <div class="row">                    	
                        	
                            <div class="col-md-3 column-panel-sortable">
                            	<div class="panel panel-white bgc-gray">
                                	
                                    	<div class="bgc-gray panel-heading">
									<h6 class="panel-title text-semibold">HIGH RISK CASE</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><i class="icon-alert"></i></li>
					                	</ul>
				                	</div>
								<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                                   
								<div class="panel-body text-center" style="padding: 0;padding-top: 25px;padding-bottom: 47px;">
									
													<div class="media-left no-padding">
														<h1 class="no-margin" style="font-size: 65px;line-height: 85px;">
									<?php 
									$today = date("Y-m-d");
									$before15Days = date("Y-m-d", strtotime($today . "-2 week"));
									$before30Days = date("Y-m-d", strtotime($before15Days . "-2 week"));
								
									
									$cntHighRisk15 = str_replace(",","",count_Checks_By_Client($company_id,"as_sent=4 AND as_status='Close' AND as_qastatus!='Rejected' AND (as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found' OR as_vstatus='unsatisfactory' OR as_vstatus='positive match found') AND DATE(as_cldate) BETWEEN '$before15Days' AND '$today'"));
									
									$cntHighRisk30 = str_replace(",","",count_Checks_By_Client($company_id,"as_sent=4 AND as_status='Close' AND as_qastatus!='Rejected' AND (as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found' OR as_vstatus='unsatisfactory' OR as_vstatus='positive match found') AND DATE(as_cldate) BETWEEN '$before30Days' AND '$before15Days'"));
									
									$cntInfo = getCountInfo($cntHighRisk15,$cntHighRisk30);
									
														
														?>
														<?php echo  $cntInfo['total'];?>
														
														</h1>
													</div>

													<div class="media-left no-padding">
														
														<ul class="list-inline-condensed no-margin text-left" style="list-style:none;padding-left: 10px;padding-top: 9px;">
														<li> <h5 class="no-margin <?php echo  $cntInfo['cls1'];?>" style="font-size: 34px;line-height: 25px;"><small class="<?php echo  $cntInfo['cls1'];?> text-size-base>" style="width:100%; float:left;"><i class="<?php echo  $cntInfo['cls2'];?>" style="font-size: 29px;"></i></small><?php echo  $cntInfo['per'];?>%</h5> </li>
															<li>
																<span class="text-muted">This Month</span>
															</li>
														</ul>
													</div>


													<div class="position-botton" style="position: absolute;bottom: 10px;right: 10px;"><button class="btn btn-xs btn-default">View Detail</button></div>
												

								</div>

                                </div>

                            </div>

                            <div class="col-md-3 column-panel-sortable">
                            	<div class="panel panel-white bgc-gray">
                                	
                                    	<div class="bgc-gray panel-heading">
									<h6 class="panel-title text-semibold">COMPLETED CHECKS</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><i class="icon-pie-chart6"></i></li>
					                	</ul>
				                	</div>
								<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                                   
								<div class="panel-body text-center" style="padding: 0; padding-top: 25px; padding-bottom: 47px;">
									
													<div class="media-left no-padding">
														<h1 class="no-margin" style="font-size: 65px;line-height: 85px;">
								<?php 
								$cntComplete15 = str_replace(",","",count_Checks_By_Client($company_id,"as_sent=4 AND as_status='Close' 
								AND as_qastatus!='Rejected' AND DATE(as_cldate) BETWEEN '$before15Days' AND '$today'"));
									
								$cntComplete30 = str_replace(",","",count_Checks_By_Client($company_id,"as_sent=4 AND as_status='Close' 
								AND DATE(as_cldate) BETWEEN '$before30Days' AND '$before15Days'"));
									
									$cntInfo = getCountInfo($cntComplete15,$cntComplete30); 
									var_dump('cntComplete15:'.$cntComplete15.', cntComplete30:'.$cntComplete30);
									?>
														
													
														
														
														<?php echo  $cntInfo['total'];?></h1>
													</div>

													<div class="media-left no-padding">
														
														<ul class="list-inline-condensed no-margin text-left" style="list-style:none;padding-left: 10px;padding-top: 9px;">
														<li> <h5 class="no-margin <?php echo  $cntInfo['cls1'];?>" style="font-size: 34px;line-height: 25px;"><small class="<?php echo  $cntInfo['cls1'];?> text-size-base" style="width:100%; float:left;"><i class="<?php echo  $cntInfo['cls2'];?>" style="font-size: 29px;"></i></small>
														<?php echo  $cntInfo['per'];?>%</h5> </li>
															<li>
																<span class="text-muted">This Month</span>
															</li>
														</ul>
													</div>


													<div class="position-botton" style="position: absolute;bottom: 10px;right: 10px;"><button class="btn btn-xs btn-default">View Detail</button></div>
												

								</div>

                                </div>

                            </div>
                            
                            <div class="col-md-3 column-panel-sortable">
                            	<div class="panel panel-white bgc-gray">
                                	
                                    	<div class="bgc-gray panel-heading">
									<h6 class="panel-title text-semibold">DELAYED CHECKS</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><i class="icon-hour-glass2"></i></li>
					                	</ul>
				                	</div>
								<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                                   
								<div class="panel-body text-center" style="padding: 0;
    padding-top: 25px;
    padding-bottom: 47px;">
									
													<div class="media-left no-padding">
														<h1 class="no-margin" style="font-size: 65px;line-height: 85px;">10</h1>
													</div>

													<div class="media-left no-padding">
														
														<ul class="list-inline-condensed no-margin text-left" style="list-style:none;padding-left: 10px;padding-top: 9px;">
														<li> <h5 class="no-margin text-success-600" style="font-size: 34px;line-height: 25px;"><small class="text-success-600 text-size-base" style="width:100%; float:left;"><i class="icon-stats-growth2" style="font-size: 29px;"></i></small>55%</h5> </li>
															<li>
																<span class="text-muted">This Week</span>
															</li>
														</ul>
													</div>


													<div class="position-botton" style="position: absolute;bottom: 10px;right: 10px;"><button class="btn btn-xs btn-default">View Detail</button></div>
												

								</div>

                                </div>

                            </div>
                            
                             <div class="col-md-3 column-panel-sortable">
                            	<div class="panel panel-white bgc-gray">
                                	
                                    	<div class="bgc-gray panel-heading">
									<h6 class="panel-title text-semibold">HAPPY CHECKS</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><i class="icon-thumbs-up3"></i></li>
					                	</ul>
				                	</div>
								<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                                   
								<div class="panel-body text-center" style="padding: 0;
    padding-top: 25px;
    padding-bottom: 47px;">
									
													<div class="media-left no-padding">
														<h1 class="no-margin" style="font-size: 65px;line-height: 85px;">80</h1>
													</div>

													<div class="media-left no-padding">
														
														<ul class="list-inline-condensed no-margin text-left" style="list-style:none;padding-left: 10px;padding-top: 9px;">
														<li><h5 class="no-margin text-success-600" style="font-size: 34px;line-height: 25px;"><small class="text-success-600 text-size-base" style="width:100%; float:left;"><i class="icon-stats-growth2" style="font-size: 29px;"></i></small>55%</h5> </li>
															<li>
																<span class="text-muted">This Week</span>
															</li>
														</ul>
													</div>


													<div class="position-botton" style="position: absolute;bottom: 10px;right: 10px;"><button class="btn btn-xs btn-default">View Detail</button></div>
												

								</div>

                                </div>

                            </div>
   
                    </div>
                    
                 <div class="row">                    	
                        	
                            <div class="col-md-3 column-panel-sortable">
                            	<div class="panel panel-white bgc-gray">
                                	
                                    	<div class="bgc-gray panel-heading">
									<h6 class="panel-title text-semibold">SEND REMINDER</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><i class="icon-alarm"></i></li>
					                	</ul>
				                	</div>
								<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                                   
								<div class="panel-body text-center" style="padding: 0;padding-top: 25px;padding-bottom: 47px;">
									
													<div class="media-left no-padding">
														<h1 class="no-margin" style="font-size: 65px;line-height: 85px;">20</h1>
													</div>

													<div class="media-left no-padding">
														
														<ul class="list-inline-condensed no-margin text-left" style="list-style:none;padding-left: 10px;padding-top: 9px;">
														<li> <h5 class="no-margin text-danger" style="font-size: 34px;line-height: 25px;"><small class="text-danger text-size-base" style="width:100%; float:left;"><i class="icon-stats-decline2" style="font-size: 29px;"></i></small>55%</h5> </li>
															<li>

																<span class="text-muted">Pending  <a href="javascript:;" class="text-grey-300" id="destroy-popover-method-target" data-popup="popover" data-placement="top" data-content="Action Pending by Applicants" data-container="body"><i class="icon-info22 position-right"></i></a></span>
															</li>
														</ul>
                                                        
													</div>

												<div class="position-botton" style="position: absolute;bottom: 10px;right: 10px;"><button class="btn btn-xs btn-default">View Detail</button></div>
												

								</div>

                                </div>

                            </div>
							 
                            
                            <div class="col-md-3 column-panel-sortable">
                            	<div class="panel panel-white bgc-gray">
                                	
                                    	<div class="bgc-gray panel-heading">
									<h6 class="panel-title text-semibold">INVITE APPLICANTS</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><i class="icon-user"></i></li>
					                	</ul>
				                	</div>
								<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                                   
								<div class="panel-body text-center" style="padding: 0;
    padding-top: 25px;
    padding-bottom: 47px;">
									
													<div class="media-left no-padding">
														<h1 class="no-margin" style="font-size: 65px;line-height: 85px;">0</h1>
													</div>

													<div class="media-left no-padding">
														
														<ul class="list-inline-condensed no-margin text-left" style="list-style:none;padding-left: 10px;padding-top: 9px;">
														<li> <h5 class="no-margin" style="font-size: 34px;line-height: 25px;"><small class="text-size-base" style="width:100%; float:left;"><i class="icon-stats-growth2" style="font-size: 29px;"></i></small>0%</h5> </li>
															<li>
																<span class="text-muted">Successful <a href="javascript:;" class="text-grey-300" id="destroy-popover-method-target" data-popup="popover" data-placement="top" data-content="Successful Applications Submitted on time" data-container="body"><i class="icon-info22 position-right"></i></a></span>
															</li>
														</ul>
													</div>


													<div class="position-botton" style="position: absolute;bottom: 10px;right: 10px;"><button class="btn btn-xs btn-default">View Detail</button></div>
												

								</div>

                                </div>

                            </div>
                            
                            <div class="col-md-3 column-panel-sortable">
                            	<div class="panel panel-white bgc-gray">
                                	
                                    	<div class="bgc-gray panel-heading">
									<h6 class="panel-title text-semibold">DROP OR RE-INVITE</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><i class="icon-x"></i> </li>
					                	</ul>
				                	</div>
								<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                                   
								<div class="panel-body text-center" style="padding: 0;
    padding-top: 25px;
    padding-bottom: 47px;">
									
													<div class="media-left no-padding">
														<h1 class="no-margin" style="font-size: 65px;line-height: 85px;">40</h1>
													</div>

													<div class="media-left no-padding">
														
														<ul class="list-inline-condensed no-margin text-left" style="list-style:none;padding-left: 10px;padding-top: 9px;">
														<li> <h5 class="no-margin text-success-600" style="font-size: 34px;line-height: 25px;"><small class="text-success-600 text-size-base" style="width:100%; float:left;"><i class="icon-stats-growth2" style="font-size: 29px;"></i></small>55%</h5> </li>
															<li>
																<span class="text-muted">Over due <a href="javascript:;" class="text-grey-300" id="destroy-popover-method-target" data-popup="popover" data-placement="top" data-content="Over due Applicants not responding" data-container="body"><i class="icon-info22 position-right"></i></a></span>
															</li>
														</ul>
													</div>


													<div class="position-botton" style="position: absolute;bottom: 10px;right: 10px;"><button class="btn btn-xs btn-default">View Detail</button></div>
												

								</div>

                                </div>

                            </div>
                            
                             <div class="col-md-3 column-panel-sortable">
                            	<div class="panel panel-white bgc-gray">
                                	
                                    	<div class="bgc-gray panel-heading">
									<h6 class="panel-title text-semibold">INVITE APPLICANTS</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><i class="icon-user"></i></li>
					                	</ul>
				                	</div>
								<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                                   
								<div class="panel-body text-center" style="padding: 0;
    padding-top: 25px;
    padding-bottom: 47px;">
									
													<div class="media-left no-padding">
														<h1 class="no-margin" style="font-size: 65px;line-height: 85px;">97</h1>
													</div>

													<div class="media-left no-padding">
														
														<ul class="list-inline-condensed no-margin text-left" style="list-style:none;padding-left: 10px;padding-top: 9px;">
														<li> <h5 class="no-margin text-success-600" style="font-size: 34px;line-height: 25px;"><small class="text-success-600 text-size-base" style="width:100%; float:left;"><i class="icon-stats-growth2" style="font-size: 29px;"></i></small>45%</h5> </li>
															<li>
																<span class="text-muted">IN SLA <a href="javascript:;" class="text-grey-300" id="destroy-popover-method-target" data-popup="popover" data-placement="top" data-content="Application completed with IN SLA" data-container="body"><i class="icon-info22 position-right"></i></a></span>
															</li>
														</ul>
													</div>


													<div class="position-botton" style="position: absolute;bottom: 10px;right: 10px;"><button class="btn btn-xs btn-default">View Detail</button></div>
												

								</div>

                                </div>

                            </div>
   
                    </div>