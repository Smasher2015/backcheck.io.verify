		<!-- Page content -->
   <?php
 if($LEVEL == 4)
{
  $user_id = $_SESSION['user_id']; 
}
else
{
  $user_id =  $_REQUEST['whmcs_clid']; 
}

   
$USER = getUserInfo($user_id);
	$postfields["action"] = "gettickets";
	$postfields["limitstart"] = "0";
	$postfields["limitnum"] = "1000";
	$postfields["clientid"] = $USER['whmcs_clid'];
	$postfields["email"] = $USER['email'];
	$postfields["deptid"] = "1";

$xml1= whmcs_api(WHMCS_APIURL,$postfields);
 // $xml=validatelogin($email,$pass,$url);
 $arr1 = whmcsapi_xml_parser($xml1); 
 //$tickets=$arr1['WHMCSAPI']['TICKETS'];
 	$postfields2["action"] = "gettickets";
	$postfields2["clientid"] = $USER['whmcs_clid'];
	$postfields2["email"] = $USER['email'];
	$postfields2["deptid"] = "1";
	$postfields2["status"] = "Closed";

$xml2= whmcs_api(WHMCS_APIURL,$postfields2);
 // $xml=validatelogin($email,$pass,$url);
 $arr2 = whmcsapi_xml_parser($xml2);

 // FOR OPEN TICKETS
 
 	$postfields3["action"] = "gettickets";
	$postfields3["clientid"] = $USER['whmcs_clid'];
	$postfields3["email"] = $USER['email'];
	$postfields3["deptid"] = "1";
	$postfields3["status"] = "Open";

$open_xml= whmcs_api(WHMCS_APIURL,$postfields3);
 // $xml=validatelogin($email,$pass,$url);
 $arr_open = whmcsapi_xml_parser($open_xml);

 // FOR  Answered
 
 	$postfields4["action"] = "gettickets";
	$postfields4["clientid"] = $USER['whmcs_clid'];
	$postfields4["email"] = $USER['email'];
	$postfields4["deptid"] = "1";
	$postfields4["status"] = "Answered";

$answered_xml= whmcs_api(WHMCS_APIURL,$postfields4);
 // $xml=validatelogin($email,$pass,$url);
 $arr_answered = whmcsapi_xml_parser($answered_xml);
 
?>
      
        
<script>
$(function() { 

// Grab first r and insert to the icon
    $(".table tr").each(function (i) {

        // Title
        var $title = $(this).find('.letter-icon-title'),
            letter = $title.eq(0).text().charAt(0).toUpperCase();

        // Icon
        var $icon = $(this).find('.letter-icon');
            $icon.eq(0).text(letter);
    });



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
                "status": "Open tickets",
                "icon": "<i class='status-mark border-blue-300 position-left'></i>",
                "value": <?=$arr_open['WHMCSAPI']['TOTALRESULTS']?>,
                "color": "#29B6F6"
            }, {
                "status": "Answered tickets",
                "icon": "<i class='status-mark border-success-300 position-left'></i>",
                "value": <?=$arr_answered['WHMCSAPI']['TOTALRESULTS']?>,
                "color": "#66BB6A"
            }, {
                "status": "Closed tickets",
                "icon": "<i class='status-mark border-danger-300 position-left'></i>",
                "value": <?=$arr2['WHMCSAPI']['TOTALRESULTS']?>,
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
                     "<li></li>"+
                "</ul>";
            })
//"<li>" + "Share: &nbsp;" + "<span class='text-semibold pull-right'>" + (100 / (sum / d.value)).toFixed(2) + "%" + "</span>" + "</li>"


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


<div class="page-header">
    <div class="page-header-content">
        <div class="page-title2">
        <h1>Tickets List</h1>
        </div>
        
    </div>
</div>

	<div class="content">
    
      <div class="panel panel-flat">               
       <div class="table-responsive">
									<table class="table table-xlg text-nowrap">
										<tbody>
											<tr>
												<td class="col-md-5">
													<div class="media-left media-middle">
														<div id="tickets-status"></div>
													</div>

													<div class="media-left">
														<h5 class="text-semibold no-margin"><?=$arr1['WHMCSAPI']['TOTALRESULTS']?> <!--<small class="text-success text-size-base"><i class="icon-arrow-up12"></i> (+2.9%)</small>--></h5>
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
													<a href="javascript:;" class="btn bg-success heading-btn" id="open_ticket"><i class="icon-ticket position-left"></i> New Ticket</a>
                                                    <?php } ?>
                                                    <!-- <div id="open_ticket_response2" class="modal fade" tabindex="-1"></div>-->

<!--<div id="opntkt_sub_response"></div>-->

												</td>
											 
											</tr>
										</tbody>
									</table>	
								</div> 
       
<div class="table-responsive">
 
  <?php


if(isset($_POST['submitreply']))
{
	$tid = $_POST['ticketid'];
	$replymessage = $_POST['replymessage'];
 	
 $postfields["action"] = "addticketreply"; 
 $postfields["ticketid"] = $tid;
 $postfields["adminusername"] = "Auto-Response";
 $postfields["message"] = $replymessage;
  
 
$xml= whmcs_api(WHMCS_APIURL,$postfields);
 // $xml=validatelogin($email,$pass,$url);
 $arrx = whmcsapi_xml_parser($xml); 
 //print_r($arrx);
	if($arrx['WHMCSAPI']['RESULT'] == "success")
	{
		echo '<div class="alert alert-success"><strong>Success!</strong> Reply Send Successfully.</div>';
	}	
 }

 
 
/* function totaltickets($userid='')
	{
 	$postfields["action"] = "gettickets";
	 if($userid != "")
	 {
	  $getUserInfo = getUserInfo($userid); 
		$postfields["clientid"] = $getUserInfo['whmcs_clid'];
		$postfields["email"] = $getUserInfo['email'];
	 }
	$postfields["deptid"] = "1";
$xml= whmcs_api(WHMCS_APIURL,$postfields);
  $arr = whmcsapi_xml_parser($xml); 
  $tickets=$arr['WHMCSAPI']['TICKETS'];
 return $arr['WHMCSAPI']['TOTALRESULTS'];
	}
 
  echo totaltickets();echo 'xxx';
*/ 
 ?>
 <div id="opntkt_sub_response2"></div>
   
   		<table class="table text-nowrap table-striped" id="myTable" cellpadding="0" cellspacing="0">							<thead>
								<tr>
									<th style="width:10%;">Latest update</th>
					                <th>Subject</th>
                                    <th>Priority</th>
					                <th>Status</th>					                 
									<th class="text-center text-muted" style="width: 30px;"><i class="icon-checkmark3"></i></th>
					            </tr>
							</thead>
							<tbody id="loadmoreresponse">

		<!--<tr class="active border-double"><td colspan="8" class="text-semibold">Yesterday</td></tr>-->
<?php
 if($LEVEL == 2)
{
	?>
<form  method="post" id="addCheckFrm"  data-parsley-namespace="data-parsley-" >

<div class="row">
                  <div class="col-md-3">
                    <label>Select Client:</label>
                  </div>
                  <div class="col-md-9">
                    <select id="whmcs_clid" name="whmcs_clid" class="form-control" onchange="document.getElementById('addCheckFrm').submit();">
                      <option value=""> --------Select Client-------- </option>
                      <?php 	$db = new DB();
                                                $dWhere="1=1 and level_id=4 order by first_name asc";							
                                                $coms = $db->select("users","*",$dWhere);
                                              //   echo "select * from company where $dWhere";
                                                $coid = (isset($_REQUEST['userid']))?$_REQUEST['userid']:0;
                                                while($com =mysql_fetch_array($coms)){  ?>
                      <option value="<?=$com['user_id']?>" <?php echo ($com['user_id']==$_REQUEST['whmcs_clid'])?'selected="selected"':'';?>>
                      <?=$com['first_name'].' '.$com['last_name']?>
                      </option>
                      <?php	} ?>
                    </select>
                  </div>
                </div>

</form>
<?php
}
 
//print_r($_REQUEST);
if($LEVEL == 4)
{
  $user_id = $_SESSION['user_id']; 
}
else
{
  $user_id =  $_REQUEST['whmcs_clid']; 
}
 
 if($user_id != "" && $user_id != 0)
 {
  $getUserInfo = getUserInfo($user_id); 

/*$postfields["action"] = "getannouncements";
$xml=whmcs_api(WHMCS_APIURL,$postfields);
$arr=whmcsapi_xml_parser($xml);
*///if($arr['WHMCSAPI']['TOTALRESULTS']>0){
	//include("include_pages/pagination_inc.php");
	
	$postfields["action"] = "gettickets";
	$postfields["limitstart"] = "0";
	$postfields["limitnum"] = "10";
	$postfields["clientid"] = $getUserInfo['whmcs_clid'];
	$postfields["email"] = $getUserInfo['email'];
	$postfields["deptid"] = "1";

$xml3= whmcs_api(WHMCS_APIURL,$postfields);
 // $xml=validatelogin($email,$pass,$url);
 $arr3 = whmcsapi_xml_parser($xml3);  
 $tickets=$arr3['WHMCSAPI']['TICKETS'];
 if($arr3['WHMCSAPI']['TOTALRESULTS']>0){
foreach($tickets as $val){ 
//print_r($tickets); 
$time_diff = dateTimeExe($val['DATE']);
     
	 
	 $tick_id = $val['ID'];
	 
	 
	 
/*	$postfields2["action"] = "getticket";
	$postfields2["ticketid"] = $tick_id;
	 
	$postfields2["deptid"] = "1";

$xml2= whmcs_api(WHMCS_APIURL,$postfields2);
 // $xml=validatelogin($email,$pass,$url);
 $arr2 = whmcsapi_xml_parser($xml2); 
*/// $ticketslink=$arr['WHMCSAPI']['TICKETS'];
	 
	/* echo $arr['WHMCSAPI']['C'];echo "<br>";
	 echo $arr['WHMCSAPI']['TID'];*/
?>  
<?php /*?><a href="http://backcheckgroup.com/support/viewticket.php?tid=<?=$arr['WHMCSAPI']['TID']?>&c=<?=$arr['WHMCSAPI']['C']?>" target="_blank">ASDASD</a><?php */?>
                            
								<tr>
									<td class="text-center"><h6 class="no-margin"><?=date("d",strtotime($time_diff)).'<small class="display-block text-size-small no-margin">'.date("F Y",strtotime($time_diff)).'</small>'?></h6></td>
					                <td>
                                        <div class="media-left media-middle">
                                         <?php 
												 
												if($val['STATUS'] == 'Answered'){
														$staus_color = 'bg-red';
												}elseif($val['STATUS'] == 'Open'){
													$staus_color = 'bg-info-400';
												}else{
													$staus_color = 'bg-success';
												}
												?>         
                                            <a href="#" class="btn <?php echo $staus_color ?> btn-rounded btn-icon btn-xs">
                                            <span class="letter-icon"><?=substr($val['NAME'],0,1)?></span>
                                            </a>
                                        </div>
					                	<div class="media-right media-middle no-padding"> 
                                        	<a href="?action=singleticket&atype=view&ticketID=<?=$tick_id?>" class="display-inline-block text-default text-semibold letter-icon-title" target="_blank"><?=$val['SUBJECT']?></a>
                                      </div>
                                     
					                 
					                </td>
                                    <td>
					                	<div class="text-muted"><?=$val['PRIORITY']?></div>
				                	</td>
					                <td>
					                	 
					                	<div class="btn-group">
                                         <?php 
												
												if($val['STATUS'] == 'Answered'){
														$staus_color = 'bg-red';
												}elseif($val['STATUS'] == 'Open'){
													$staus_color = 'bg-info-400';
												}else{
													$staus_color = 'bg-success';
												}
												?>                                                
                                                <span class="label <?php echo $staus_color ?>"><?= $val['STATUS']?></span>
										</div>
					                </td>
					                
					                 
					                
					               
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu9"></i></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"  data-toggle="modal" data-target="#exampleModal<?=$tick_id?>" ><i class="icon-undo"></i> Quick reply</a></li>
												</ul>
											</li>
										</ul>
                                        
                                        
                                        
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
            <textarea class="form-control" name="replymessage" required id="message-text"></textarea>
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
                                        
									</td>
					            </tr>

 <?php
}
}
else
{echo "<tr><td align='center' colspan='4'>No Record Found</td></tr>";}


}
else
{echo "<tr><td align='center' colspan='4'>No Record Found</td></tr>";}





//}
?>

							</tbody><div class="items"></div>
						</table>
					
					<!-- /task manager table -->
                    
                    <div class="form-group mt-20 p-20">
<?php  if($arr3['WHMCSAPI']['TOTALRESULTS']>10){ ?>
<button type="button" class="btn btn-success btn-lg" id="load_more"><i class="icon-rotate-cw3 position-left"></i> Load More</button><?php } ?>
<div id="nomoreres" style="display:none">No More Result</div>
<?php
 if($LEVEL == 4){
	 ?>
<!--<a href="javascript:;" class="btn bg-danger-600 heading-btn" id="open_ticket"><i class="icon-ticket position-left"></i> New Ticket</a>
-->
<?php
 }
 ?>

</div>
 <!--<div id="open_ticket_response" class="modal fade" tabindex="-1"></div>-->
                    


</div> 

 </div>
	
	</div>    
    <!-- /page container -->  
    <script type="text/javascript">
	var cur_index=10;
	cur_index=parseInt(cur_index)+10;
	var screen_height = $('body').height();
	var cury = $(window).scrollTop();
	var screen = $(window).height();
	$('#load_more').click(function(){
      // make an ajax call to your server and fetch the next 100, then update
      //some vars
        $.ajax({
			type: 'POST',
            url: "actions.php",
            data: 'ePage=add_rating&ticket_list=yes&limit='+cur_index+'&userid='+<?=$user_id?>,
            success: function(result){
				console.log(result);
				
                cur_index +=10;
                screen_height = $('body').height();
				
                $( "#loadmoreresponse" ).fadeIn( 400 ).append(result);
				if(result == '')
				{
					$('#nomoreres').show();$('#load_more').hide(); 
				}
            }
        });
});












/*$(document).ready(function(){ var $modal = $('#open_ticket_response'); $('#open_ticket').on('click', function(){ $modal.load('load.php',{'id1': '1', 'id2': '2'}, function(){ $modal.modal('show'); }); }); });  
*/




	</script>
