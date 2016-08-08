<script>
$(function() { 

// Tickets status donut chart
    // ------------------------------

    // Initialize chart
    ticketStatusDonut("#tickets-status", 42);

function ticketStatusDonut(element, size) {


        // Basic setup
        // ------------------------------

        // Add data set
        var data = [
            {
                "status": "Pending tickets",
                "icon": "<i class='status-mark border-blue-300 position-left'></i>",
                "value": 295,
                "color": "#29B6F6"
            }, {
                "status": "Resolved tickets",
                "icon": "<i class='status-mark border-success-300 position-left'></i>",
                "value": 189,
                "color": "#66BB6A"
            }, {
                "status": "Closed tickets",
                "icon": "<i class='status-mark border-danger-300 position-left'></i>",
                "value": 277,
                "color": "#EF5350"
            }
        ];

        // Main variables
        var d3Container = d3.select(element),
            distance = 2, // reserve 2px space for mouseover arc moving
            radius = (size/2) - distance,
            sum = d3.sum(data, function(d) { return d.value; })



        // Tooltip
        // ------------------------------

        var tip = d3.tip()
            .attr('class', 'd3-tip')
            .offset([-10, 0])
            .direction('e')
            .html(function (d) {
                return "<ul class='list-unstyled mb-5'>" +
                    "<li>" + "<div class='text-size-base mb-5 mt-5'>" + d.data.icon + d.data.status + "</div>" + "</li>" +
                    "<li>" + "Total: &nbsp;" + "<span class='text-semibold pull-right'>" + d.value + "</span>" + "</li>" +
                    "<li>" + "Share: &nbsp;" + "<span class='text-semibold pull-right'>" + (100 / (sum / d.value)).toFixed(2) + "%" + "</span>" + "</li>" +
                "</ul>";
            })



        // Create chart
        // ------------------------------

        // Add svg element
        var container = d3Container.append("svg").call(tip);
        
        // Add SVG group
        var svg = container
            .attr("width", size)
            .attr("height", size)
            .append("g")
                .attr("transform", "translate(" + (size / 2) + "," + (size / 2) + ")");  



        // Construct chart layout
        // ------------------------------

        // Pie
        var pie = d3.layout.pie()
            .sort(null)
            .startAngle(Math.PI)
            .endAngle(3 * Math.PI)
            .value(function (d) { 
                return d.value;
            }); 

        // Arc
        var arc = d3.svg.arc()
            .outerRadius(radius)
            .innerRadius(radius / 2);



        //
        // Append chart elements
        //

        // Group chart elements
        var arcGroup = svg.selectAll(".d3-arc")
            .data(pie(data))
            .enter()
            .append("g") 
                .attr("class", "d3-arc")
                .style('stroke', '#fff')
                .style('cursor', 'pointer');
        
        // Append path
        var arcPath = arcGroup
            .append("path")
            .style("fill", function (d) { return d.data.color; });

        // Add tooltip
        arcPath
            .on('mouseover', function (d, i) {

                // Transition on mouseover
                d3.select(this)
                .transition()
                    .duration(500)
                    .ease('elastic')
                    .attr('transform', function (d) {
                        d.midAngle = ((d.endAngle - d.startAngle) / 2) + d.startAngle;
                        var x = Math.sin(d.midAngle) * distance;
                        var y = -Math.cos(d.midAngle) * distance;
                        return 'translate(' + x + ',' + y + ')';
                    });
            })

            .on("mousemove", function (d) {
                
                // Show tooltip on mousemove
                tip.show(d)
                    .style("top", (d3.event.pageY - 40) + "px")
                    .style("left", (d3.event.pageX + 30) + "px");
            })

            .on('mouseout', function (d, i) {

                // Mouseout transition
                d3.select(this)
                .transition()
                    .duration(500)
                    .ease('bounce')
                    .attr('transform', 'translate(0,0)');

                // Hide tooltip
                tip.hide(d);
            });

        // Animate chart on load
        arcPath
            .transition()
                .delay(function(d, i) { return i * 500; })
                .duration(500)
                .attrTween("d", function(d) {
                    var interpolate = d3.interpolate(d.startAngle,d.endAngle);
                    return function(t) {
                        d.endAngle = interpolate(t);
                        return arc(d);  
                    }; 
                });
    }

});

</script>

<div>
                    	<!-- Support tickets -->
							<div class="panel panel-flat">
								<!--<div class="panel-heading">
									<h5 class="panel-title">Support tickets</h5>
									<div class="heading-elements">
										<button type="button" class="btn btn-link heading-btn text-semibold" onclick="document.location='?action=tickets&atype=view';">
											<i class="icon-droplet position-left"></i> <span>View all</span>
										</button>
				                	</div>
								</div>-->
<?php
$USER = getUserInfo($_SESSION['user_id']);
	$postfields["action"] = "gettickets";
	$postfields["limitstart"] = "0";
	$postfields["limitnum"] = "1000";
	$postfields["clientid"] = $USER['whmcs_clid'];
	$postfields["email"] = $USER['email'];
	$postfields["deptid"] = "1";

$xml= whmcs_api(WHMCS_APIURL,$postfields);
 // $xml=validatelogin($email,$pass,$url);
 $arr = whmcsapi_xml_parser($xml); 
 $tickets=$arr['WHMCSAPI']['TICKETS'];
 	$postfields["action"] = "gettickets";
	$postfields["clientid"] = $USER['whmcs_clid'];
	$postfields["email"] = $USER['email'];
	$postfields["deptid"] = "1";
	$postfields["status"] = "Closed";

$xml2= whmcs_api(WHMCS_APIURL,$postfields);
 // $xml=validatelogin($email,$pass,$url);
 $arr2 = whmcsapi_xml_parser($xml2);
 //print_r($tickets);
// if($arr['WHMCSAPI']['TOTALRESULTS']>0);

?>
								<div class="table-responsive">
									<table class="table table-xlg text-nowrap">
										<tbody>
											<tr>
												<td class="col-md-5">
													<div class="media-left media-middle">
														<div id="tickets-status"></div>
													</div>

													<div class="media-left">
														<h5 class="text-semibold no-margin"><?=$arr['WHMCSAPI']['TOTALRESULTS']?> <!--<small class="text-success text-size-base"><i class="icon-arrow-up12"></i> (+2.9%)</small>--></h5>
														<span class="text-muted"><span class="status-mark border-success position-left"></span> Total Tickets</span>
													</div>
												</td>

												<td class="col-md-5">
													<div class="media-left media-middle">
														<a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-xs btn-icon"><i class="icon-alarm-add"></i></a>
													</div>

													<div class="media-left">
														<h5 class="text-semibold no-margin">
															<?=$arr2['WHMCSAPI']['TOTALRESULTS']?> <small class="display-block no-margin">resolve tickets</small>
														</h5>
													</div>
												</td>												

												<td class="text-right col-md-2">
                                                <?php if($LEVEL==4 || $LEVEL==5){?>
													<a href="javascript:void(0)" id="open_ticket" class="btn bg-success"><i class="icon-lifebuoy position-left"></i> Open new</a>
                                                    <?php } ?>
                                                     <div id="open_ticket_response" class="modal fade" tabindex="-1"></div>

<div id="opntkt_sub_response"></div>

												</td>
											</tr>
										</tbody>
									</table>	
								</div>

								<div class="table-responsive">
									<table class="table text-nowrap">
										<thead>
											<tr>
												<th style="width: 50px">Due</th>
												<th style="width: 300px;">User</th>
												<th>Description</th>
												<th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
											</tr>
										</thead>
										<tbody>
											<tr class="active border-double">
												<td colspan="3">Your tickets</td>
												<td class="text-right">
													<span class="badge bg-blue"><?=$arr['WHMCSAPI']['TOTALRESULTS']?></span>
												</td>
											</tr>
											<?php
											if($arr['WHMCSAPI']['TOTALRESULTS']>0){
											$inc = 1;	
											foreach($tickets as $val)
											{
												$time_diff = time_ago(strtotime($val['DATE']));
												$tick_id = $val['ID'];
  
											?>			
											<tr>
												<td class="text-center">
													<h6 class="no-margin">12 <small class="display-block text-size-small no-margin">hours</small></h6>
												</td>
												<td>
													<div class="media-left media-middle">
														<a href="#" class="btn bg-teal-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</a>
													</div>

													<div class="media-body">
														<a href="#" class="display-inline-block text-default text-semibold letter-icon-title"><?=$val['NAME']?></a>
														<div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> <?=$val['STATUS']?></div>
													</div>
												</td>
												<td>
													<a href="#" class="text-default display-inline-block">
														<span class="text-semibold"><?=$val['SUBJECT']?></span>
														<span class="display-block text-muted"><!--Chrome fixed the bug several versions ago, thus rendering this...--></span>
													</a>
												</td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#" data-toggle="modal" data-target="#exampleModal<?=$tick_id?>"><i class="icon-undo"></i> Quick reply</a></li>
																<!--<li><a href="#"><i class="icon-history"></i> Full history</a></li>-->
																
															</ul>
														</li>
													</ul>
												</td>
											</tr>
                                            
                                            
<div class="modal fade" id="exampleModal<?=$tick_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Reply To <?=$val['NAME']?></h4>
      </div>
      <div class="modal-body">
        <form method="post">
           <input type="hidden" class="form-control" name="ticketid" value="<?=$tick_id?>" >
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" name="replymessage" id="message-text"></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="submitreply" class="btn bg-info-400" value="Send message"> 
      </div>
        </form>
         
      </div>
     
    </div>
  </div>
</div>                                            
                                            
											<?php
                                            }
											}
                                            ?>
 										</tbody>
									</table>
								</div>
							</div>
							<!-- /support tickets -->
                    
                    </div>