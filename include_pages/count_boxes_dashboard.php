	<?php if($LEVEL==4){
		$user__id = $_SESSION['user_id'];
		$url_ = "?action=insufficient&atype=list";
		$filteredurl_ = "?action=insufficient&atype=list&mnth=$mnth&yr=$yr";
	}else{
		$url_ = "?action=insufficient&atype=list&comid=$company_id";
		$filteredurl_ = "?action=insufficient&atype=list&comid=$company_id&mnth=$mnth&yr=$yr";
		$user__id = '';
	}?>
	<script src="<?php echo SURL; ?>js/jquery.validate.min.js"></script>
<style>
.modal-body .error {color:#FF0000;}
/*.count_boxe1 .panel{background: #9b9b9b;border-color: #9b9b9b;}
.count_boxe2 .panel{background: #d03636;border-color: #d03636;}
.count_boxe3 .panel{background: #000;border-color: #000;}
*/
</style>
	<div class="col-lg-4 count_boxes count_boxe1">

									<!-- Members online -->
									<div class="panel bgc-blue">
										<div class="panel-body">
											<div class="heading-elements">
												<span class="heading-text"><i class="icon-arrow-left16 position-left"></i> <?php //echo $Fmonth.', '.$yr; ?></span>
											</div>
											
											<h1 class="no-margin" onclick="document.location='<?php echo $filteredurl_;?>'"><?php echo countInsuffDocs($company_id,$mnth,$yr);?></h1>
											Action Pending by you
                                            
                                             <div class="progress">
									<div class="progress-bar" style="width: 50%; background:#5bc0eb;">
										<span class="sr-only">50% Complete</span>
									</div>
								</div>
                                            
											<?php /*?><div class="text-muted text-size-small" onclick="document.location='<?php echo $url_;?>'">View All (<?php echo countInsuffDocs($company_id);?>)</div><?php */?>
										</div>

									</div>
									<!-- /members online -->

								</div>

								<div class="col-lg-4 count_boxes count_boxe2">

									<!-- Current server load -->
									<div class="panel bgc-red">
										<div class="panel-body">
											
											<div class="heading-elements">
												<span class="heading-text"><i class="icon-clipboard5 position-left"></i><?php //echo $Fmonth.', '.$yr; ?></span>
											</div>
											
											
											<h1 class="no-margin" onclick="document.location='?action=readyfordownload&atype=checks&mnth=<?php echo  $mnth?>&yr=<?php echo  $yr?>'"><?php echo countReady4Download($company_id,$mnth,$yr);?></h1>
											Suport ticket awaiting action
                                            <div class="progress">
									<div class="progress-bar" style="width: 50%">
										<span class="sr-only">50% Complete</span>
									</div>
								</div>
                                            
											<?php /*?><div class="text-muted text-size-small" onclick="document.location='?action=readyfordownload&atype=checks'">View All (<?php echo countReady4Download($company_id);?>)</div><?php */?>
										</div>
										
										
									</div>
									<!-- /current server load -->

								</div>

								<div class="col-lg-4 count_boxes count_boxe3">
									<!-- Today's revenue -->
									<div class="panel bgc-dargreen">
										<div class="panel-body">
											<div class="heading-elements">
												 <span class="heading-text"><i class="icon-shield-check position-left"></i></span>
												<?php /*?><?php
												if($LEVEL == 4)
												{
												?>
                                                <ul class="icons-list">
							                		<li><a href="javascript:void(0)" id="open_ticket" >New Ticket</a></li>
							                	</ul>
												<?php
												}
												?><?php */?>
						                	</div>
											<h1 class="no-margin" onclick="document.location='?action=tickets&atype=view'"><?php 										
											//echo totaltickets($user__id);?>1234</h1>
                                            Report pending download
                                             <div class="progress">
									<div class="progress-bar" style="width: 50%">
										<span class="sr-only">50% Complete</span>
									</div>
								</div>
                                            
											<div>
                            </div>

										</div>

									<!-- /today's revenue -->
                                    </div>

								</div>
						