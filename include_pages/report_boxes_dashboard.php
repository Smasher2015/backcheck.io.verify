
<style>
	.heading-text .select2-container{width: 100px !important;margin-top: -5px;}
	.has-fixed-height2{height:380px !important}
	#expenses-widget .panel-heading{padding-bottom:0;}
	#expenses-widget .form-group{margin:0;}
	#expenses-widget .heading-text{margin-top: 14px;}

</style>

					 <!------------------Progress Overview Bigin --------------->
                <?php /*?>	<div class="col-lg-7">
                                <div id="task-completion-widget" class="proton-widget task-completion">
                    
                    <div class="panel panel-flat">
                       <?php /*?> <div class="panel-heading">
                            <h5 class="panel-title"><span data-step='4' data-intro="On this section client can view all the check's status like how many checks are completed and pending checks." data-position='right'>Progress Overview (<?php echo $Fmonth.', '.$yr; ?>)</span></h5>
                       
                        </div><?php */?>
						
 <?php 					$selMonth = ($mnth!="")?" AND MONTH(as_addate)='".$mnth."'":" AND MONTH(as_addate)='".date("m")."'";
						$selYear = ($yr!="")?" AND YEAR(as_addate)='".$yr."'":" AND YEAR(as_addate)='".date("Y")."'";
						// For By Status Chart Checks
						$discrepancy_checks 	= countChecks("as_vstatus='Discrepancy'  $selMonth $selYear $comWhere");
						$need_attention_checks 	= countChecks("as_status='problem' $selMonth $selYear $comWhere");
						$submitted_checks 		= countChecks("1=1 $selMonth  $selYear $comWhere");
						$completed_checks 		= countChecks("as_status='Close' $selMonth $selYear $comWhere");
						$wipchecks   			= ($submitted_checks-$completed_checks);	
						$pending_check  		= $submitted_checks - $completed_checks;
						$per_subs_check 		= $completed_checks * 100;
						if($submitted_checks > 0){
						$percentage_check		= $per_subs_check / $submitted_checks;
						}else{
						$percentage_check = 0;	
						}
						$percentage_check 			= ceil($percentage_check);
					
						
						?>
						<script type="text/javascript">
	$(function() {    


    // Switchery toggles
    // ------------------------------

    var switches = Array.prototype.slice.call(document.querySelectorAll('.switch'));
    switches.forEach(function(html) {
        var switchery = new Switchery(html, {color: '#4CAF50'});
    });
	var completed_checks = <?php  echo $completed_checks; ?>;
	var pending_check = <?php echo $pending_check; ?>;
	var submitted_checks = <?php echo $submitted_checks; ?>;

	 progressCounter('#complete_checks', 38, 2, "#66bb6a", completed_checks, "icon-shield-check text-success-400", 'Completed checks')
    progressCounter('#pending_checks', 38, 2, "#FFA726", pending_check, "icon-stack-check text-orange-400", 'Pending checks')
	progressCounter('#total_checks', 38, 2, "#5C6BC0", submitted_checks, "icon-meter-fast text-indigo-400", 'Total checks')
	
	
    // Chart setup
    function progressCounter(element, radius, border, color, end, iconClass, textTitle, textAverage) {


        // Basic setup
        // ------------------------------

        // Main variables
        var d3Container = d3.select(element),
            startPercent = 0,
            iconSize = 32,
            endPercent = end,
            twoPi = Math.PI * 2,
            formatPercent = d3.format('0'),
            boxSize = radius * 2;

        // Values count
        var count = Math.abs((endPercent - startPercent));

        // Values step
        var step = endPercent < startPercent ? -1 : 1;



        // Create chart
        // ------------------------------

        // Add SVG element
        var container = d3Container.append('svg');

        // Add SVG group
        var svg = container
            .attr('width', boxSize)
            .attr('height', boxSize)
            .append('g')
                .attr('transform', 'translate(' + (boxSize / 2) + ',' + (boxSize / 2) + ')');



        // Construct chart layout
        // ------------------------------

        // Arc
        var arc = d3.svg.arc()
            .startAngle(0)
            .innerRadius(radius)
            .outerRadius(radius - border);



        //
        // Append chart elements
        //

        // Paths
        // ------------------------------

        // Background path
        svg.append('path')
            .attr('class', 'd3-progress-background')
            .attr('d', arc.endAngle(twoPi))
            .style('fill', '#eee');

        // Foreground path
        var foreground = svg.append('path')
            .attr('class', 'd3-progress-foreground')
            .attr('filter', 'url(#blur)')
            .style('fill', color)
            .style('stroke', color);

        // Front path
        var front = svg.append('path')
            .attr('class', 'd3-progress-front')
            .style('fill', color)
            .style('fill-opacity', 1);



        // Text
        // ------------------------------

        // Percentage text value
        var numberText = d3.select(element)
            .append('h2')
                .attr('class', 'mt-15 mb-5')

        // Icon
        d3.select(element)
            .append("i")
                .attr("class", iconClass + " counter-icon")
                .attr('style', 'top: ' + ((boxSize - iconSize) / 2) + 'px');

        // Title
        d3.select(element)
            .append('div')
                .text(textTitle);

        // Subtitle
        d3.select(element)
            .append('div')
                .attr('class', 'text-size-small text-muted')
                .text(textAverage);



        // Animation
        // ------------------------------

        // Animate path
        function updateProgress(progress) {
            foreground.attr('d', arc.endAngle(twoPi * progress));
            front.attr('d', arc.endAngle(twoPi * progress));
            numberText.text(formatPercent(progress));
        }

        // Animate text
        var progress = startPercent;
        (function loops() {
            updateProgress(progress);
            if (count > 0) {
                count--;
                progress += step;
                setTimeout(loops, 1);
            }
        })();
    }



});


</script>
                    	<!--<div class="panel-body" style="padding-top:0;">   -->
                       <?php /*?> <div class="col-md-4">

									<!-- Available hours -->
									<div class="panel text-center" style="background:#f1ffff;height:208px;">
										<div class="panel-body">

						                	<!-- Progress counter -->
											<div class="content-group-sm svg-center position-relative" id="complete_checks"></div>
											<!-- /progress counter -->


									</div>
									<!-- /available hours -->

								</div>                       
                    	</div>
                        
                         <div class="col-md-4">

									<!-- Available hours -->
									<div class="panel text-center" style="background:#f1ffff;height:208px;">
										<div class="panel-body">

						                	<!-- Progress counter -->
											<div class="content-group-sm svg-center position-relative" id="pending_checks"></div>
											<!-- /progress counter -->


									</div>
									<!-- /available hours -->

								</div>                       
                    	</div>
                        
                         <div class="col-md-4">

									<!-- Available hours -->
									<div class="panel text-center" style="background:#f1ffff;height:208px;">
										<div class="panel-body">

						                	<!-- Progress counter -->
											<div class="content-group-sm svg-center position-relative" id="total_checks"></div>
											<!-- /progress counter -->


									</div>
									<!-- /available hours -->

								</div>                       
                    	</div>
                        
                        <div class="row">
								
                                <div class="col-md-12">
                                <h6 class="text-semibold text-center">Total Progress</h6>
								
								<div class="progress progress-lg">
									<div class="progress-bar progress-bar-blue progress-bar-striped active" style="width: <?php echo $percentage_check;?>%">
										<span><?php echo $percentage_check;?>% Complete</span>
									</div>
								</div>
							</div>
                        </div>
						
						<?php */?>
                        
                         <?php /*?><ul class="progress_overview">
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
                        </ul><?php */?>
               <!--     </div>
                </div>
                </div>
                    
				 </div>-->
                   <!------------------By Risk Start --------------->
                  <div class="col-lg-12">
                <div id="expenses-widget" class="proton-widget">
                    <div class="panel panel-flat front">
                        <div class="panel-heading">
                            <h5 class="panel-title"><span data-step='6' data-intro='By Risk' data-position='right'>By Risk</span></h5>
                            <div class="heading-elements">
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
							
							$selFilters = getFiltersBy('by_risk','as_cldate',$company_id);
							
						 
							?>
                             <span class="heading-text">
                                 <select class="select select-xs" onChange="saveFilter('by_risk',document.getElementById('filter_by_time_by_risk').value,'by_risk');" id="filter_by_time_by_risk" name="filter_by_time_by_risk">
                                    <option value="all">All</option>
                                    <option value="today" <?php echo ($selFilters['filter_by']=='today')?'selected="selected"':'';?>>Today</option>
                                    <option value="this_week" <?php echo ($selFilters['filter_by']=='this_week')?'selected="selected"':'';?>>This Week</option>
                                    <option value="this_month" <?php echo ($selFilters['filter_by']=='this_month')?'selected="selected"':'';?>>This Month</option>
                                    <option value="this_year" <?php echo ($selFilters['filter_by']=='this_year')?'selected="selected"':'';?>>This Year</option>
                                        </select>
                                   
                            </span>
                            
                            </div>
                            
                        </div>
                        <div class="panel-body" style="padding:0;">
                            <div class="form-group">
                                <div id="hero-donut" class="graph" style="margin-top: 0px; height: 185px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
				 <!------------------By Risk END --------------->
                 
                 <!------------------Progress Overview End --------------->
				 <!--<div class="col-lg-6">
                 	<div class="panel panel-flat bgc-success insuficent_box">
                    	<div class="panel-body text-center">
                            <h6><i class="icon-stats-decline"></i></h6>
                            <div class="text-muted">234</div>
                            <h5>Reported insufficieny</h5>
                            <a href="#" class="btn btn-xs border-white text-white">view all</a>
                        </div>
                    </div>
                 </div>-->
                 
                <!-- <div class="col-lg-6">
                 	<div class="panel panel-flat insuficent_box">
                    	
                    	<div class="panel-body text-center">
                            <h6><i class="icon-headset"></i></h6>
                            <div class="text-muted" style="color:#999;">Support</div>
                            <h5>If offline send email</h5>
                            <a href="#" class="btn btn-xs border-grey-700 text-grey-700">lets chat</a>
                    </div>
                    </div>
                 </div>-->
                 
				
				 
                 
                 <div class="col-lg-12">
                 	<!------------------By Status Start --------------->
				
                <?php /*?><div id="sales-income-widget" class="proton-widget">
                    <div class="panel panel-flat front">
                        <div class="panel-heading">
                            <h5 class="panel-title"><span data-step='5' data-intro='By Status' data-position='right'>By Status</span></h5>
                            
                            <div class="heading-elements">
                        	  <li class="list-group-item">
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
                            
							 /*?>$selFilters = getFiltersBy('by_status','as_cldate',$company_id);
							$selAll = getFiltersBy('by_status','as_addate',$company_id);
						 
							?>
                        <span class="heading-text">
                        	  <select class="select select-xs" onChange="saveFilter('by_status',document.getElementById('filter_by_time_by_status').value,'container_st');" id="filter_by_time_by_status" name="filter_by_time_by_status">
                                    <option value="all">All</option>
                                    <option value="today" <?php echo ($selFilters['filter_by']=='today')?'selected="selected"':'';?>>Today</option>
                                    <option value="this_week" <?php echo ($selFilters['filter_by']=='this_week')?'selected="selected"':'';?>>This Week</option>
                                    <option value="this_month" <?php echo ($selFilters['filter_by']=='this_month')?'selected="selected"':'';?>>This Month</option>
                                    <option value="this_year" <?php echo ($selFilters['filter_by']=='this_year')?'selected="selected"':'';?>>This Year</option>
                                        </select>
                        </span>
                        
                        </div>
                        </div>
                        
                        
                        <div>
                            <div class="panel-body">
                                <!--<div id="hero-bar" class="graph" style="height: 225px;"></div>-->
                                <?php include("include_pages/dash_bystatus_chart_inc.php");?>
                            </div>
                        </div>
                    </div>
                </div><?php */?>
               
				 <!------------------By Status END --------------->
                 </div>
				 
				 
				 
				 
					<?php include('include_pages/dash_charts_inc.php'); ?>
					
					
					