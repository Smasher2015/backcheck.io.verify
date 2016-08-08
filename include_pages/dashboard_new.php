            <!--<link rel="stylesheet" href="styles/vendor/select2/select2.css">-->
            
            <!--<script src="scripts/vendor/modernizr.js"></script>-->
            <!--<script src="scripts/vendor/jquery.cookie.js"></script>-->

<?php
function checkcaseforactivity($datacollect)
{ 
	$time_diff = time_ago(strtotime($datacollect['a_date']));

	$userdetail = getUserInfo($_SESSION['user_id']);
	$username = $userdetail['first_name']." ".$userdetail['last_name'];

	if($datacollect['a_type'] == "login")
			{
			$description = $userdetail['first_name']." ".$userdetail['last_name']." Login At ".$time_diff;
			}
	else if($datacollect['a_type'] == "ascase")
			{
				if($datacollect['v_id'] > 0)
				{
				 $description = $datacollect['a_info'];
				}
				/*else if(empty($datacollect['v_id']) || $datacollect['v_id'] == 0 && empty($datacollect['ext_id']) || 			$datacollect['ext_id'] == 0 )
				{
					$description = $datacollect['a_info'];
				}*/
			 
			}
	else if($datacollect['a_type'] == "case")
			{
			$description = '';
			}
	else if($datacollect['a_type'] == "check")
			{
			$description = '';
			}
	else if($datacollect['a_type'] == "notification")
			{
				if($datacollect['v_id'] > 0)
				{
				$verdata = getVerdata($datacollect['v_id']);
 				$newinfo = str_replace("id ".$datacollect['v_id'],$verdata['v_name'],$datacollect['a_info']);
 				$description = $newinfo;
				}
				else if(empty($datacollect['v_id']) || $datacollect['v_id'] == 0 && empty($datacollect['ext_id']) || $datacollect['ext_id'] == 0 )
				{
					$description = $datacollect['a_info'];
				}
 			}
	else if($datacollect['a_type'] == "pdf")
			{
				if($datacollect['v_id'] > 0)
				{
				$verdata = getVerdata($datacollect['v_id']);
				if($datacollect['a_info'] != "")
				{
				$description = $datacollect['a_info'];
				}
				else
				{
				$description = "PDF Download For Case ".$verdata['v_name'];
				}
				
				}
			
			}
			  
 	$data = array("username" => $username,"description" => $description, "timediff" => $time_diff);
	return($data);

}

?>


            <div class="container">
  <!-- Trigger the modal with a button -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Training Video</h4>
        </div>
        <div class="modal-body">
          <iframe src="https://player.vimeo.com/video/139456068" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

             <!--<section class="widget-group">-->
             <section>

             <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title2">
                            <h2>Dashboard</h2>
                        </div>
                        <div class="heading-elements">
                        	<?php 
				 $whmcsurl = "http://backcheckgroup.com/support/dologin.php";
					$autoauthkey = "abcXYZ123";
					$timestamp = time();
					$email = $_SESSION['email'];
					$hash = sha1($email.$timestamp.$autoauthkey);
				?>
 <form action="http://backcheckgroup.com/support/dologin.php" target="_blank" method="post">
 <input type="hidden" value="<?=$email?>" name="email">
 <input type="hidden" value="<?=$timestamp?>" name="timestamp">
 <input type="hidden" value="<?=$hash?>" name="hash">
 <input type="submit" class="btn btn-primary" value="Support Center"></form>
                        </div>
                </div>
                </div>
                <div class="row">
               	<div style="max-width:100%; margin:0 20px;">
                	<div class="panel panel-default panel-block"> 
                    	<div class="panel-body">
                        	<div class="table-responsive">
									<table class="table text-nowrap">
										<thead>
											<tr>
												<th style="width: 50px">Due</th>
												<th style="width: 300px;">User</th>
												<th>Description</th>
												<!--<th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>-->
											</tr>
										</thead>
										<tbody>
										<?php // AND a_type != 'login' 
										$where = "(user_id='".$_SESSION['user_id']."' OR ext_id='".$_SESSION['user_id']."') ORDER BY a_id DESC LIMIT 0,4";
										$activity = $db->select("activity","*",$where);
										while($res = mysql_fetch_array($activity))
										{
										$getdata = checkcaseforactivity($res); //print_r($getdata);
										?>
											<tr>
												<td class="text-center">
													<h6 class="no-margin"><?=$getdata['timediff']?></h6>
												</td>
												<td>
													<!--<div class="media-left media-middle">
														<a href="#" class="btn bg-teal-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</a>
													</div>-->

													<div class="media-body">
														<a href="#" class="display-inline-block text-default text-semibold letter-icon-title"><?=$getdata['username']?></a>
														 
													</div>
												</td>
												<td>
													<a href="#" class="text-default display-inline-block">
														<span class="text-semibold"><?=$getdata['description']?></span>
														<!--<span class="display-block text-muted">Chrome fixed the bug several versions ago, thus rendering this...</span>-->
													</a>
												</td>
												<!--<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
																<li><a href="#"><i class="icon-history"></i> Full history</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-checkmark3 text-success"></i> Resolve issue</a></li>
																<li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
															</ul>
														</li>
													</ul>
												</td>-->
											</tr>
                                            <?php
                                            
										} // Main while close here //
										
											?>
                                            
                                            
<!--
											<tr>
												<td class="text-center">
													<h6 class="no-margin">16 <small class="display-block text-size-small no-margin">hours</small></h6>
												</td>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt=""></a>
													</div>

													<div class="media-body">
														<a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Chris Macintyre</a>
														<div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> Notification</div>
													</div>
												</td>
												<td>
													<a href="#" class="text-default display-inline-block">
														<span class="text-semibold">[#1249] Vertically center carousel controls</span>
														<span class="display-block text-muted">Try any carousel control and reduce the screen width below...</span>
													</a>
												</td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
																<li><a href="#"><i class="icon-history"></i> Full history</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-checkmark3 text-success"></i> Resolve issue</a></li>
																<li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>

											<tr>
												<td class="text-center">
													<h6 class="no-margin">20 <small class="display-block text-size-small no-margin">hours</small></h6>
												</td>
												<td>
													<div class="media-left media-middle">
														<a href="#" class="btn bg-blue btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</a>
													</div>

													<div class="media-body">
														<a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Robert Hauber</a>
														<div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> Follow up</div>
													</div>
												</td>
												<td>
													<a href="#" class="text-default display-inline-block">
														<span class="text-semibold">[#1254] Inaccurate small pagination height</span>
														<span class="display-block text-muted">The height of pagination elements is not consistent with...</span>
													</a>
												</td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
																<li><a href="#"><i class="icon-history"></i> Full history</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-checkmark3 text-success"></i> Resolve issue</a></li>
																<li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>

											<tr>
												<td class="text-center">
													<h6 class="no-margin">40 <small class="display-block text-size-small no-margin">hours</small></h6>
												</td>
												<td>
													<div class="media-left media-middle">
														<a href="#" class="btn bg-warning-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</a>
													</div>

													<div class="media-body">
														<a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Dex Sponheim</a>
														<div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> Inbox</div>
													</div>
												</td>
												<td>
													<a href="#" class="text-default display-inline-block">
														<span class="text-semibold">[#1184] Round grid column gutter operations</span>
														<span class="display-block text-muted">Left rounds up, right rounds down. should keep everything...</span>
													</a>
												</td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
																<li><a href="#"><i class="icon-history"></i> Full history</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-checkmark3 text-success"></i> Resolve issue</a></li>
																<li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>

-->											

										</tbody>
									</table>
								</div>
                        
                        </div>
                    </div>
                    </div>
                    </div>
				
                   <?php if($LEVEL==4){ 
				if($COMINF['id']==87 || $COMINF['id']==96){ 
				$userInf = getUserInfo($_SESSION['user_id']); 
				if($userInf['is_subuser']==0){?>
				 	<div class="row">
               	<div style="max-width:960px; margin:auto;"><div class="panel panel-default panel-block"> 
             		<div class="list-group">
            		<div class="list-group-item">
                     <div class="form-group">
                <div class="row">
              
                  
				 
                  <div class="col-md-6">
				  
				  <form name="frm_loc" id="frm_loc" method="post">
				  <div class="col-md-4">
                   
            
                    Select Location:
					  
                     
                    
                  </div>
				  
             <select name="loc_id" class="form-control select_box full_width" onchange="setLocation(this.value);">
            <option value="">Main Account</option>
           <?php 
			
		$where = " com_id=$COMINF[id] AND status=0 ORDER BY location ASC";
			
		$getuLocations = $db->select("users_locations","*",$where);
			
			while($rsLocations =	mysql_fetch_array($getuLocations)){ ?>
		
		<option value='<?=$rsLocations['loc_id']?>' <?php if ($_SESSION['loc_id']==$rsLocations['loc_id']){ echo " selected='selected'"; } ?> >
		<?php echo $rsLocations['location'];?>
		</option>
			
		<?php } ?>
            </select>
			<input type="hidden" name="selLoc" value="1">
			</form>
                  </div>
				  
				  
				  
				  
				   </div>
				</div>
             		</div>
                    </div>
             </div></div>
             </div>
				<?php 
				}
				}
				} ?>
             		
				
				
				
				
             	<div class="">
               	<div class="row">
               	<div style="max-width:100%; margin:0 20px;">
                <div class="panel panel-default panel-block"> 
             		<div class="list-group">
            		<div class="list-group-item">
                    <div id="threemonthsdata" style="width:80%; margin:auto;"></div>
             		</div>
                    </div>
             </div></div>
             </div>
			</div>
                <div id="messages-widget" class="proton-widget messages">
                 <?php /*?>
                    <div class="panel panel-default back">
                       <div class="panel-heading">
                            <i class="icon-cog"></i>
                            <span>Settings</span>
                            <div class="toggle-widget-setup">
                                <i class="icon-ok"></i>
                                <span>DONE</span>
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Location</label>
                                    <div>
                                        <select class="select2">
                                            <option selected="" value="Any">Any</option>
                                            <option value="Europe">Europe</option>
                                            <option value="Asia">Asia</option>
                                            <option value="North America">North America</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Time</label>
                                    <div>
                                        <select class="select2">
                                            <option>Any</option>
                                            <option>Last Hour</option>
                                            <option>Today</option>
                                            <option selected="">This Week</option>
                                            <option>This Month</option>
                                            <option>This Year</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
					<?php */?>
                    <div class="panel panel-success front">
                        <div class="panel-heading">
                            <i class="icon-envelope-alt"></i>
                            <span data-step='1' data-intro="These are messages from the manager's, you can click and read message details" data-position='right'>Messages</span>
                            <!--<i class="icon-cog toggle-widget-setup"></i>-->
                        </div>
                        <div>
                            <ul class="list-group pending">
							<?php $messages = get_messages("com_type='case' AND","LIMIT 4"); 
                                        if($messages){
                                            while($message = mysql_fetch_assoc($messages)){
                                                if(trim($message['uimg'])=='') $message['uimg'] = "images/default.png";?>                            
                                            <li class="list-group-item" onclick="goto_case(<?=$message['v_id']?>,true)">
                                                <i><img src="<?=$message['uimg']?>" title="<?="$message[first_name] $message[last_name]"?>"></i>
                                                <div class="text-holder">
                                                    <span class="title-text"> <?=$message['com_title']?>  </span>
                                                    <span class="description-text"> <?=$message['com_text']?> </span>
                                                </div>
                                                <span class="stat-value"><?=time_ago(strtotime($message['com_date']))?></span>
                                            </li>
							   <?php 	}
                                    }?>
                            </ul>
                        </div>
                    </div>
                </div>

				<!------------------Work in Progress Bigin --------------->
				<div id="general-stats-widget" class="proton-widget messages">
                    <div class="panel panel-default back">
                        <div class="panel-heading">
                            <i class="icon-cog"></i>
                            <span>Settings</span>
                            <div class="toggle-widget-setup" onclick="saveFilter('work_in_progress',document.getElementById('filter_by_time_work_in_progress').value,'work_in_progress');">
                                <i class="icon-ok"></i>
                                <span>DONE</span>
                            </div>
                        </div>
                        <ul class="list-group">
                           <?php /*?> <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Location</label>
                                    <div>
                                        <select class="select2">
                                            <option selected="" value="Any">Any</option>
                                            <option value="Europe">Europe</option>
                                            <option value="Asia">Asia</option>
                                            <option value="North America">North America</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </li><?php */
							
							
                            $selFilters = getFiltersBy('work_in_progress','as_pdate');
						 
							?>
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Time</label>
                                    <div>
                                    <select class="select2" id="filter_by_time_work_in_progress" name="filter_by_time_work_in_progress">
                                    <option value="all">All</option>
                                    <option value="today" <?php echo ($selFilters['filter_by']=='today')?'selected="selected"':'';?>>Today</option>
                                    <option value="this_week" <?php echo ($selFilters['filter_by']=='this_week')?'selected="selected"':'';?>>This Week</option>
                                    <option value="this_month" <?php echo ($selFilters['filter_by']=='this_month')?'selected="selected"':'';?>>This Month</option>
                                    <option value="this_year" <?php echo ($selFilters['filter_by']=='this_year')?'selected="selected"':'';?>>This Year</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="panel panel-success front">
                        <div class="panel-heading">
                            <i class="icon-sort" ></i>
                            <span data-step='2' data-intro="Here you can view the in progress check's, you can view details by click on check." data-position='right'>Work in Progress</span>
                            <i class="icon-cog toggle-widget-setup"></i>
                        </div>
                        <div>
                            <ul class="list-group pending work_in_progress">
                            	<?php
								$addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:''; 
								//echo $addFilter;
								$data = client_checks_info("as_status!='close' AND as_sent!=4 AND v_isdlt=0 $addFilter","LIMIT 4");
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
                                              <?=(isset($row['as_pdate']))?time_ago(strtotime($row['as_pdate'])):time_ago(strtotime($row['as_date']))?>
                                            </span>
                                            </li>
                                <?php }
								}else { ?>
								<li class="list-group-item">No record available !</li>
								<?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!------------------Work in Progress End --------------->
				
				
				
				<!------------------Ready for Download Bigin --------------->
				
				<div id="messages-widget" class="proton-widget messages">
                   <div class="panel panel-default back">
                        <div class="panel-heading">
                            <i class="icon-cog"></i>
                            <span>Settings</span>
                            <div class="toggle-widget-setup" onclick="saveFilter('ready_download',document.getElementById('filter_by_time_ready_download').value,'readyfordownload');">
                                <i class="icon-ok"></i>
                                <span>DONE</span>
                            </div>
                        </div>
                        <ul class="list-group">
                            <?php /* <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Checks</label>
                                    <div>
                                        <select class="select2">
                                            <option value="All">All</option>
                                            <?php $checks = sort_checks_info();
												  while($check = mysql_fetch_assoc($checks)){ ?>
													<option value="<?=$check['checks_id']?>"><?=$check['checks_title']?></option>  
											<?php
												  }
											?>
                                        </select>
                                    </div>
                                </div>
                            </li> */
							$selFilters = getFiltersBy('ready_download','as_cldate');
						 
							?>
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Time</label>
                                    <div>
                                    <select class="select2" id="filter_by_time_ready_download" name="filter_by_time_ready_download">
                                    <option value="all">All</option>
                                    <option value="today" <?php echo ($selFilters['filter_by']=='today')?'selected="selected"':'';?>>Today</option>
                                    <option value="this_week" <?php echo ($selFilters['filter_by']=='this_week')?'selected="selected"':'';?>>This Week</option>
                                    <option value="this_month" <?php echo ($selFilters['filter_by']=='this_month')?'selected="selected"':'';?>>This Month</option>
                                    <option value="this_year" <?php echo ($selFilters['filter_by']=='this_year')?'selected="selected"':'';?>>This Year</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="panel panel-success front">
                        <div class="panel-heading">
                            <i class="icon-download-alt"></i>
                            <span data-step='3' data-intro="On this section you can view the completed checks and able to download the reports" data-position='right'>Ready for Download</span>
                           <i class="icon-cog toggle-widget-setup"></i>
                        </div>
                        <div>
                            <ul class="list-group pending readyfordownload">
                                <?php
							
								
								$addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:''; 
								//echo $addFilter;
								$data = client_checks_info("as_sent=4 AND as_cdnld=0 AND as_status='Close' AND as_qastatus = 'Approved' $addFilter","LIMIT 4");
								
								if($data){
									  while($row = mysql_fetch_assoc($data)){
										$pdfClick = "downloadPDF('pdf.php?pg=case&ascase=$row[as_id]')";
									    $pdfClickFullCase = "downloadPDF('pdf.php?pg=case&case=$row[v_id]')";
											?>                            
                                            <li class="list-group-item readydownload">
                                                <i><img src="<?=$row['image']?>" alt="<?=$row['v_name']?>"></i>
                                                <div class="text-holder">
                                                    <span class="title-text" title="Check: <?=$row['checks_title']?>">
                                                        <?=$row['v_name']?>
                                                    </span>
                                                    <span class="description-text">
                                                      
                                                     <?=time_ago(strtotime($row['as_stdate']))?>
                                                
                                                    </span>
                                                </div>
                                                <div class="stat-value">
                                                     <a class="" title="Download Single Check Report" href="javascript:;" onclick="<?=$pdfClick?>"><i class="icon-cloud-download" style="font-size:20px; color:#D4212B;"></i></a>
			  &nbsp;&nbsp;&nbsp;
			  
			  <a title="Download Full Case Report" href="javascript:;"  onclick="<?=$pdfClickFullCase?>"><i class="icon-cloud-download" style="font-size:20px; color:green;"></i></a>
                                                </div>
                                            </li>
                                <?php }
								}else { ?>
								<li class="list-group-item">No record available !</li>
								<?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!------------------Ready for Download End --------------->
				
				 <!------------------Progress Overview Bigin --------------->
                <div id="task-completion-widget" class="proton-widget task-completion">
                    <div class="panel panel-default back">
                        <div class="panel-heading">
                            <i class="icon-cog"></i>
                            <span>Settings</span>
                            <div class="toggle-widget-setup" onclick="saveFilter('progress_overview',document.getElementById('filter_by_time_progress_overview').value,'progress_overview');">
                                <i class="icon-ok"></i>
                                <span>DONE</span>
                            </div>
                        </div>
                        <ul class="list-group">
                           <?php /* ?> <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Origin</label>
                                    <div>
                                        <select class="select2">
                                            <option value="Any">Any</option>
                                            <option value="Europe">Europe</option>
                                            <option value="Asia">Asia</option>
                                            <option selected="" value="North America">North America</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </li> <?php */
							$selFilters = getFiltersBy('progress_overview','as_cldate');
							$selAll = getFiltersBy('progress_overview','as_addate');
						 
							?>
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Time</label>
                                    <div>
                                    <select class="select2" id="filter_by_time_progress_overview" name="filter_by_time_progress_overview">
                                    <option value="all">All</option>
                                    <option value="today" <?php echo ($selFilters['filter_by']=='today')?'selected="selected"':'';?>>Today</option>
                                    <option value="this_week" <?php echo ($selFilters['filter_by']=='this_week')?'selected="selected"':'';?>>This Week</option>
                                    <option value="this_month" <?php echo ($selFilters['filter_by']=='this_month')?'selected="selected"':'';?>>This Month</option>
                                    <option value="this_year" <?php echo ($selFilters['filter_by']=='this_year')?'selected="selected"':'';?>>This Year</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                    <div class="panel panel-info front">
                        <div class="panel-heading">
                            <i class="icon-ok"></i>
                            <span data-step='4' data-intro="On this section client can view all the check's status like how many checks are completed and pending checks." data-position='right'>Progress Overview</span>
                            <i class="icon-cog toggle-widget-setup"></i>
                        </div>
                        <ul class="list-group progress_overview">
                        <?php 
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
                        </ul>
                    </div>
                </div>
				 <!------------------Progress Overview End --------------->
				 
				 
				 <!------------------By Status Start --------------->

                <div id="sales-income-widget" class="proton-widget">
                    <div class="panel panel-default back">
                        <div class="panel-heading">
                            <i class="icon-cog"></i>
                            <span>Settings</span>
                            <div class="toggle-widget-setup" onclick="saveFilter('by_status',document.getElementById('filter_by_time_by_status').value,'container_st');">
                                <i class="icon-ok"></i>
                                <span>DONE</span>
                            </div>
                        </div>
                        <ul class="list-group">
                           <?php /*?> <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Products</label>
                                    <div>
                                        <select class="select2">
                                            <option>All</option>
                                            <option selected="">Digital Media</option>
                                            <option>Books</option>
                                            <option>Shopping Carts</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Origin</label>
                                    <div>
                                        <select class="select2">
                                            <option value="Any">Any</option>
                                            <option value="Europe">Europe</option>
                                            <option value="Asia">Asia</option>
                                            <option selected="" value="North America">North America</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </li><?php */
                            
							$selFilters = getFiltersBy('by_status','as_cldate');
							$selAll = getFiltersBy('by_status','as_addate');
						 
							?>
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Time</label>
                                    <div>
                                    <select class="select2" id="filter_by_time_by_status" name="filter_by_time_by_status">
                                    <option value="all">All</option>
                                    <option value="today" <?php echo ($selFilters['filter_by']=='today')?'selected="selected"':'';?>>Today</option>
                                    <option value="this_week" <?php echo ($selFilters['filter_by']=='this_week')?'selected="selected"':'';?>>This Week</option>
                                    <option value="this_month" <?php echo ($selFilters['filter_by']=='this_month')?'selected="selected"':'';?>>This Month</option>
                                    <option value="this_year" <?php echo ($selFilters['filter_by']=='this_year')?'selected="selected"':'';?>>This Year</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
							
							
							
                        </ul>
                    </div>
                    <div class="panel panel-warning front">
                        <div class="panel-heading">
                            <i class="icon-shopping-cart"></i>
                            <span data-step='5' data-intro='By Status' data-position='right'>By Status</span>
                            <i class="icon-cog toggle-widget-setup"></i>
                        </div>
                        <div>
                            <div class="form-group">
                                <!--<div id="hero-bar" class="graph" style="height: 225px;"></div>-->
                                <?php include("include_pages/dash_bystatus_chart_inc.php");?>
                            </div>
                        </div>
                    </div>
                </div>
				 <!------------------By Status END --------------->
				 
				 
				 
				  <!------------------By Risk Start --------------->

                <div id="expenses-widget" class="proton-widget">
                   <div class="panel panel-default back">
                        <div class="panel-heading">
                            <i class="icon-cog"></i>
                            <span>Settings</span>
                            <div class="toggle-widget-setup" onclick="saveFilter('by_risk',document.getElementById('filter_by_time_by_risk').value,'by_risk');">
                                <i class="icon-ok"></i>
                                <span>DONE</span>
                            </div>
                        </div>
                        <ul class="list-group">
                            <?php /*?> <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Division</label>
                                    <div>
                                        <select class="select2">
                                            <option selected="" value="All">All Divisions</option>
                                            <option value="RnD">R&amp;D</option>
                                            <option value="Production">Production</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Sales">Sales</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
							
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Products</label>
                                    <div>
                                        <select class="select2">
                                            <option selected="">All</option>
                                            <option>Digital Media</option>
                                            <option>Books</option>
                                            <option>Shopping Carts</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
							<?php */
							
							$selFilters = getFiltersBy('by_risk','as_cldate');
							
						 
							?>
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Time</label>
                                    <div>
                                    <select class="select2" id="filter_by_time_by_risk" name="filter_by_time_by_risk">
                                    <option value="all">All</option>
                                    <option value="today" <?php echo ($selFilters['filter_by']=='today')?'selected="selected"':'';?>>Today</option>
                                    <option value="this_week" <?php echo ($selFilters['filter_by']=='this_week')?'selected="selected"':'';?>>This Week</option>
                                    <option value="this_month" <?php echo ($selFilters['filter_by']=='this_month')?'selected="selected"':'';?>>This Month</option>
                                    <option value="this_year" <?php echo ($selFilters['filter_by']=='this_year')?'selected="selected"':'';?>>This Year</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="panel panel-danger front">
                        <div class="panel-heading">
                            <i class="icon-chevron-sign-down"></i>
                            <span data-step='6' data-intro='By Risk' data-position='right'>By Risk</span>
                            <i class="icon-cog toggle-widget-setup"></i>
                        </div>
                        <div>
                            <div class="form-group">
                                <div id="hero-donut" class="graph" style="margin-top: 10px; height: 185px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
				 <!------------------By Risk END --------------->
            </section>
            <?php include('include_pages/dash_charts_inc.php'); ?>
            <?php /*?><?php
				// For By Status Chart
				$closecas = countCases("(v_status='Close' AND v_sent=4)");
				$Submitted = countCases();
				$balrt="v_rlevel='negative' OR v_rlevel='match found' OR v_rlevel='record found' OR v_rlevel='unable to verify' OR v_rlevel='discrepancy'";
				$balrt="(($balrt) AND (as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found' OR as_vstatus='unable to verify' OR as_vstatus='discrepancy'))";		
				$discrepancy = countCases("(v_status='Close' AND v_sent=4) AND $balrt");
				$needatten = countCases("(v_status='Close' AND v_sent=4) AND vc.as_status='problem'");
				$wipcas   = ($Submitted-$closecas);	
				
				//For Progress
				$total = countCases("com_id = 33 AND as_isdlt = 0");
				$pending = $total - $closecas;
				$min = $closecas - $pending;
				$div = $min / $pending * 1000; 
				//echo $div;
				
				
				// For By Risk Chart
				$where = "v_status='Close'";
				if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){
					$where = "$where AND com_id=20";
				}elseif($LEVEL==4) $where = "$where AND com_id=$COMINF[id]";
		
				$cols = "(SELECT DATE_FORMAT(v_date, '%b-%y') mnth,COUNT(v_rlevel) cnt,
						IF((v_rlevel='verified' || v_rlevel='satisfactory' || v_rlevel='no match found'
						|| v_rlevel='no record found' || v_rlevel='positive match found'), 'green',
						IF((v_rlevel='negative' || v_rlevel='match found' || v_rlevel='record found'),'red',
						IF((v_rlevel='unable to verify' || v_rlevel='discrepancy'),'amber','na'))) sts,v_date FROM ver_data";
				$cols ="$cols WHERE $where AND v_isdlt=0 GROUP BY mnth,sts ORDER BY v_date DESC LIMIT 36) DATA";
				$months = $db->select($cols,"*","1=1 ORDER BY v_date");
		
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
 				
			?>
            <script type="text/javascript">
				// For By Status Chart
				var completed 		= <?=$closecas?>;
				var inprogress 		= <?=$wipcas?>;
				var needattention 	= <?=$needatten?>;
				var discrepancy 	= <?=$discrepancy?>;
				// For By Risk Chart
				var amber 		= <?=$at?>;
				var red 		= <?=$rt?>;
				var green 		= <?=$gt?>;
				$(document).ready(function(e) {
					proton.dashboard.drawByStatus(completed,inprogress,needattention,discrepancy);
					proton.dashboard.drawByRisk(amber,red,green);
				});
            </script><?php */?>
            <div>
            	 <div class="page-section-title2"><div class="cpl_inner"><h2>Our Compliance</h2>
                        <ul class="cplLogos">
                            <li><img src="images/footer-icons/aicpa.png"  title="AICPA" /></li>
                            <li><img src="images/footer-icons/napbs.png"  title="NAPBS" /></li>
                            <li><img src="images/footer-icons/sgcukas.png"  title="ISO" /></li>
                            <li><img src="images/footer-icons/pcidss.png"  title="PCIDSS" /></li>
                            <div class="clearfix"></div>
                        </ul>
                        </div>
                        </div>
            </div>
            
            
			<script type="text/javascript">
			
			function saveFilter(filter_what,filter_by,div_class){
				//alert(id);
				//images/spinners/3.gif
				 $("."+div_class).html('<li><img align="center" src="images/spinners/3.gif" /></li>');
				$.ajax({
	url: "actions.php",
	data:'ePage=add_rating&filter_what='+filter_what+'&filter_by='+filter_by,
	type: "POST",
	success: function(res){
    if(res=='inserted' || res=='updated'){
		
	$.ajax({
	url: "actions.php",
	data:'ePage=filtered_data&filter_what='+filter_what,
	type: "POST",
	success: function(rs){
	
	if(filter_what=='by_risk'){
		var myarr = rs.split(";");
		
		var amber 		= myarr[0];
		var red 		=  myarr[1];
		var green 		= myarr[2];
						
	proton.dashboard.drawByRisk(amber,red,green);

	}else if(filter_what=='by_status'){
		$("."+div_class).html(rs);
		//var dt = $("."+div_class).html();
		//console.log(dt);
		 //Highcharts.data(dt);
		 
		 Highcharts.data({
        csv: $("."+div_class).html(),
        itemDelimiter: '\t',
        parsed: function (columns) {

            var brands = {},
                brandsData = [],
                versions = {},
                drilldownSeries = [];

            // Parse percentage strings
            columns[1] = $.map(columns[1], function (value) {
                if (value.indexOf('%') === value.length - 1) {
                    value = parseInt(value);
                }
                return value;
            });

            $.each(columns[0], function (i, name) {
                var brand,
                    version;

                if (i > 0) {
					
                    // Remove special edition notes
                    name = name.split(' -')[0];

                    // Split into brand and version
                    version = name.match(/([0-9]+[\.0-9x]*)/);
                    if (version) {
                        version = version[0];
                    }
                    brand = name.replace(version, '');
					
                    // Create the main data
                    if (!brands[brand]) {
                        brands[brand] = columns[1][i];
                    } else {
                        brands[brand] += columns[1][i];
                    }

                    // Create the version data
                    if (version !== null) {
                        if (!versions[brand]) {
                            versions[brand] = [];
                        }
                        versions[brand].push(['v' + version, columns[1][i]]);
                    }
					
                }

            });

            $.each(brands, function (name, y) {
                brandsData.push({
                    name: name,
                    y: y,
                    drilldown: versions[name] ? name : null
                });
            });
            $.each(versions, function (key, value) {
                drilldownSeries.push({
                    name: key,
                    id: key,
                    data:  parseInt(value)

					
                });
            });

            // Create the chart
            $('#container_st').highcharts({
				credits: {
      				enabled: false
	  			},
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
					allowDecimals: false,
                    type: 'category'
                },
                yAxis: {
					allowDecimals: false,
                    title: {
                        text: ''
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },
				colors: [
					'#00b9f7',
					'#8DC655',
					'#FFC943',
					'#e8511a'
				],

                tooltip: {
                    headerFormat: '<span style="font-size:11px"><b>{point.y:.0f}</b> {series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>'
                },

                series: [{
					
                    name: 'Check(s)',
                    colorByPoint: true,
                    data: brandsData
                }],
                drilldown: {
                    series: drilldownSeries
                }
            });
        }
    });
		 
		 
		 
		 
		 
		
	}else{
	$("."+div_class).html(rs);	
	}	
		
	
	
	}
	
	
	});
	
	
	
	
	
	
		
	}else{
		$("."+div_class).html('');
		alert(res);
		
	}
	},
	error: function(){
    alert('failed to load request');
	}
	
	
	});
				
				
			}
			
			
			
			
			function setLocation(){
				
				document.frm_loc.submit();
				
			}
			
			
			</script>
            <!-- Intro JS -->
            <!-- https://github.com/usablica/intro.js -->
            <script src="scripts/vendor/intro.min.js"></script>

            <!-- jsTree -->
            <script src="scripts/vendor/jquery.jstree.js"></script>
            


            