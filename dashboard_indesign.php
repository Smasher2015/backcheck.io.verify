

             <section class="widget-group myDashboard">
           	<div class="rightBar">
            	
  <div class="rightWidget">
  <div class="myCharts">
 
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
						$percentage_check		= $per_subs_check / $submitted_checks;
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
						$percentage = $per_subs / $total;
						$percentage = ceil($percentage);
						//echo $div;

						?>
  	<div class="greenchecks">
    <i class="icon-coffee"></i>
    <span>Compeleted checks</span>
    <h1><?php echo $completed_checks; ?></h1>
    </div>
	 <div class="orangechecks">
     <i class="icon-time"></i>
    <span>Pending checks</span>
    <h1><?php echo $pending_check; ?></h1>
    </div>
	  <div class="totalchecks">
      <i class="icon-suitcase"></i>
    <span>Total checks</span>
    <h1><?php echo $submitted_checks;?></h1>
    </div>

 </div>
 </div>
 
 <?php  include("progresbar_tk.php"); ?>

 
  <div class="rightWidget">
  <h2>Stacked Progress Bars</h2>
  <?php
  $topcase = client_case_info($twhere="v_status!='Not Assign'",$torder="v_date DESC LIMIT 5");
  var_dump($topcase);
  exit();
  
  
  ?>
  <div class="form-group">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" style="width: 33%">
                                        <span class="sr-only">33% Complete (success)</span>
                                        </div>
                                        <div class="progress-bar progress-bar-warning" style="width: 25%">
                                        <span class="sr-only">25% Complete (warning)</span>
                                        </div>
                                        <div class="progress-bar progress-bar-danger" style="width: 4%">
                                        <span class="sr-only">4% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div></div>
  <div class="rightWidget">
  	
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
                            <span>Messages</span>
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
                            <i class="icon-sort"></i>
                            <span>Work in Progress</span>
                            <i class="icon-cog toggle-widget-setup"></i>
                        </div>
                        <div>
                            <ul class="list-group pending work_in_progress">
                            	<?php
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
                            <span>Ready for Download</span>
                           <i class="icon-cog toggle-widget-setup"></i>
                        </div>
                        <div>
                            <ul class="list-group pending readyfordownload">
                                <?php
							
								
								$addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:''; 
								//echo $addFilter;
								$data = client_checks_info("as_sent=4 AND as_cdnld=0 AND as_status='Close' $addFilter","LIMIT 4");
								
								if($data){
									  while($row = mysql_fetch_assoc($data)){ ?>                            
                                            <li class="list-group-item" onclick="downloadPDF('pdf.php?pg=case&ascase=<?=$row['as_id']?>')">
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
                                                     <?=time_ago(strtotime($row['as_stdate']))?>
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
                            <span>Progress Overview</span>
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
						$percentage_check		= $per_subs_check / $submitted_checks;
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
						$percentage = $per_subs / $total;
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
                            <span>By Status</span>
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
                            <span>By Risk</span>
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
			
			
			
			
			
			
			
			</script>