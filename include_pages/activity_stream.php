<style>
.counts-reports span{font-size:21px;}
.counts-reports span.heading-text{font-size:13px;}
.counts-reports hr{width: 88px;}
</style>

				<div class="panel panel-flat counts-reports">
                	<div class="panel-heading">
									<h5 class="panel-title">Back Check in Action Globally</h5>
									<div class="heading-elements">
										<span class="heading-text"><i class="icon-history text-warning position-left"></i> <?php echo date("d-M-Y");?></span>
									</div>
								</div>
                     <!-- Numbers -->
								<div class="panel-body">
                                	<ul class="media-list">
                                    	<li class="media">
                                        	<div class="media-left media-middle">
                                            	<span class="text-warning">2,345</span>
                                            </div>
                                            <div class="media-left media-middle"><hr></div>
                                            <div class="media-body media-middle">New Checks Today Worldwide</div>
                                        </li>
                                        <li class="media">
                                        	<div class="media-left media-middle">
                                            	<span class="text-danger">3,568</span>
                                            </div>
                                            <div class="media-left media-middle"><hr></div>
                                            <div class="media-body media-middle">Overall Report Download Today</div>
                                        </li>
                                        <li class="media">
                                        	<div class="media-left media-middle">
                                            	<span class="text-success">3,269</span>
                                            </div>
                                            <div class="media-left media-middle"><hr></div>
                                            <div class="media-body media-middle">Support Ticket Anwsered Today</div>
                                        </li>
                                        
                                    </ul>
                                
                                </div>
                                
								<!-- /numbers -->
                                
                </div>		

<!--activity-->
								<!-- My messages -->
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h5 class="panel-title">Live Updates</h5>
									<div class="heading-elements">
										<span class="label bg-success heading-text">Online</span>
									</div>
								</div>

								
								<!-- Area chart -->
								<div id="server-load"></div>
								<!-- /area chart -->


								<!-- Tabs -->
			                	<ul class="nav nav-lg nav-tabs nav-justified no-margin no-border-radius bg-blue-c border-top border-top-indigo-300">
									<li class="active">
										<a href="#messages1" class="text-size-small text-uppercase" data-toggle="tab">
											

											<?php
											$dates = array();
											$dated1 = date("Y-m-d");
											$datedNum = date("N",strtotime($dated1));
											
											if($datedNum==6){
											$dated1 = date("Y-m-d",strtotime($dated1."-1 day"));	
											}
											if($datedNum==7){
											$dated1 = date("Y-m-d",strtotime($dated1."-2 day"));	
											}
																						
											$dayName1 = getDayName($dated1);
											$dates['date_1'] = $dated1;
											$dates['dayName_1'] = $dayName1;
											echo $dayName1;
											?>
										</a>
									</li>

									<li>
										<a href="#messages2" class="text-size-small text-uppercase" data-toggle="tab">
											<?php 
											$yesterday = work_days_from_date(1,'',$dated1);
											$dated2 = $yesterday['dated'];
											$dayName2 = $yesterday['dayname'];
											$dates['date_2'] = $dated2;
											$dates['dayName_2'] = $dayName2;
											echo $dayName2;
											?>
										</a>
									</li>

									<li>
										<a href="#messages3" class="text-size-small text-uppercase" data-toggle="tab">
											<?php 
											$beforeyesterday = work_days_from_date(1,'',$dated2);
											$dated3 = $beforeyesterday['dated'];
											$dayName3 = $beforeyesterday['dayname'];
											$dates['date_3'] = $dated3;
											$dates['dayName_3'] = $dayName3;
											echo $dayName3;
											?>
										</a>
									</li>
								</ul>
								<!-- /tabs -->

					<?php ?>
								<!-- Tabs content -->
								<div class="tab-content" id="datascrol" >
								<!-- activity 1 -->
								
								<?php 
								for($i=1; $i<=3; $i++){
								if($i==1){
								$activ = "active in";	
								}else{
								$activ = "";		
								}?>
									
								
								
								
								<div class="tab-pane <?php echo $activ;?> fade has-padding case_activity content" id="messages<?php echo $i; ?>" style="height:450px; overflow:auto">
								 <div class="" >
								 <input type="hidden" id="dt_<?php echo $i; ?>" value="<?php echo $dates['date_'.$i];?>">
								 <input type="hidden" id="dtn_<?php echo $i; ?>" value="<?php echo $dates['dayName_'.$i];?>">
							 <img src="http://www.broadwaybalancesamerica.com/images/ajax-loader.gif" id="loadingimage<?php echo $i; ?>2" style="display:none"/>
                               	
                            
								  <?php  echo getLiveUpdates($company_id,$dates['date_'.$i],$dates['dayName_'.$i],$i); ?>
                                  
                                  
                   
							            
                                
                                
                                <div class="media-body" id="no-more-rec<?php echo $i; ?>" style="display:none;">
                                    
                                    <span class="display-block text-muted">No More Records</span>
                                </div>
                            
                            
                            <img src="http://www.broadwaybalancesamerica.com/images/ajax-loader.gif" id="loadingimage<?php echo $i; ?>" style="display:none"/>
                            <div id="lastPostsLoader<?php echo $i; ?>"></div>          
                            </div>
								
								</div>
								<?php } ?>
								
								</div>
								
								<!-- /tabs content -->

							</div>
							<!-- /my messages -->
						<!--activity--->

















						
						
						
						
<script type="text/javascript">
	
	$(document).ready(function(){
	var pgr = 0;
	
	for(var i=1; i<=3; i++){
    $("#messages"+i).bind('scroll', function()
	  {
		if($(this).scrollTop() + $(this).innerHeight()>=$(this)[0].scrollHeight)
		{
		var todate = $("#dt_"+i).val();
		var DayName = $("#dtn_"+i).val();
		 pgr = parseInt(pgr)+7;
		 var pagination = pgr+',7';
		 lastAddedLiveFunc(pagination,'apnd',todate,DayName,i);

		
		}
     });
	}
	/* $(".case_activity").scroll(function(){
	var elmnt = document.getElementById("datascroll");
    var x = elmnt.scrollLeft;
    var y = elmnt.scrollTop; 
	
 	if(y == 200 )
	{ var pagination = '7,14';  }
 	else if(y > 500 && 1000 < y)
	{ var pagination = '14,21'; }
	 
	if(y == 200){  lastAddedLiveFunc(pagination,'apnd');}
	// console.log(y);
 
	}); */
   
   
   
    function lastAddedLiveFunc(pagination,apd,todate,DayName,cnt)
    {
	
	if(apd=='apnd'){
	$('#loadingimage'+cnt).show();
	}else{
	//$('#loadingimage2').show();
	}
	  $.ajax({
	  type: 'POST',
	  url: 'actions.php',
	  data: 'ePage=add_rating&dashactstream=yes&comid=<?=($LEVEL==4)?$COMINF['id']:$company_id?>&paginations='+pagination+'&apd='+apd+'&todate='+todate+'&dayname='+DayName+'&cnt='+cnt,
		
	   
	  success: function (response) 	
	{ 	
	//no-more
	
	if(apd=='apnd'){
	 $('#loadingimage'+cnt).hide();
	 if(response!='1'){
	$(response).hide().appendTo(".items"+cnt).fadeIn("slow");
	//$( ".items" ).append(response).fadeIn( 3000 );	 	  
	 
	 }else{
	$("#no-more-rec"+cnt).show();
	
	 }
	
	}else{
	 //$('#loadingimage2').hide();
	  if(response!='1'){
	$(response).hide().prependTo(".items"+cnt).fadeIn("slow");
	//$( ".items" ).prepend(response).fadeIn( 3000 );	
	  }
	}
	}
	
	});
	};
	setInterval( function() { lastAddedLiveFunc(10,'prepnd','<?php echo $dates['date_1']?>','<?php echo $dates['dayName_1']?>',1); }, 5000 );
	

	
	});

</script>                    