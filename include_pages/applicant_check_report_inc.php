
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<style type="text/css" class="init">

td.details-control {
	background: url('images/details_open.png') no-repeat center center;
}

tr.shown td.details-control {
	background: url('images/details_close.png') no-repeat center center;
}

td.details-control, td.details-show {
	cursor: pointer;
}
.highcharts-button {
	display:none !important;
}
.rating-checks {
	width: auto;
	border-spacing: initial;
	margin: 0;
	word-break: break-word;
	table-layout: auto;
	line-height: 1.8em;
	color: #333;
    float: none;
   text-align: inherit;
  position: relative;
}
.rating-checks ul {
  margin-left: -50px;
}
.rating-checks ul li {
 
  color:#999999;
}
</style>

<?php 

	if($IPAGE['m_where']!='') {
		$pm_where = $IPAGE['m_where'];
	}else{
		$pm_where = '';	
	}
	if($IPAGE['m_orderby']!='') {
		$m_orderby = $IPAGE['m_orderby'];
	}else{
		$m_orderby = '';	
	}
	
	
	
	
	
	
	
	
			//echo countInsuff_applicant($COMINF['id'],$_SESSION['user_id']).' xxxxxxx';

	
	
	
	
	
	
?>
<script type="text/javascript" language="javascript" src="scripts/jquery.dataTables.js"></script>
        <section class="retracted scrollable">
           
            <div class="row">
            		<?php  
		if($LEVEL==4 || $LEVEL==5){
		$com_id = $COMINF['id'];	
		}else{
		$com_id = ($_REQUEST['comid']!="")?$_REQUEST['comid']:1;
		}
		$sel = countInsuff_applicant($COMINF['id'],$_SESSION['user_id'],true);
		if(@mysql_num_rows($sel)>0){
			
                      while($re = @mysql_fetch_array($sel)) { //print_r($re); ?>
                   		<div class="col-md-6">
									<div class="panel border-left-lg border-left-info">
										<div class="panel-body">
											<div class="row">
												<div class="col-md-8">
													<h6 class="no-margin-top"><?=$re['checks_title']?></h6>
													<p class="mb-15"><?php if($re['att_comments'] != ""){echo $re['att_comments'];}else{echo '-';}?></p>
								                	
												</div>

												<div class="col-md-4">
													<ul class="list task-details">
														<li><?=date("j-M-Y",strtotime($re['att_insuff_date']))?></li>
														<li><a href="?action=details&case=<?=$re['v_id']?>&_pid=81#check_tab_<?=$re['as_id']?>" class="btn btn-xs bg-danger">Upload New Attachment</a></li>
													</ul>
												</div>
											</div>
										</div>

										<div class="panel-footer">
											<ul>
												<li>Candidate Name: <a href="?action=details&case=<?=$re['v_id']?>" class="text-blue"><?=$re['v_name']?></a></li>
											</ul>											
										</div>
									</div>
								</div>
                                
                                
                                
                                 
                                  <?php } 
		}else{ ?>
		
		<div class="panel panel-flat"><div class="panel-heading"><h6 class="panel-title text-center">No Insufficient Checks</h6></div></div>
		
		<?php } ?>     
            </div>
 
	
            
           
		   
	
	
	
	
	
	
	
	
        </section>
        
        
        
        
        
      

        <!-- Page-specific scripts: -->
        <!--<script src="scripts/proton/graphsStats.js"></script>-->
        <!-- Page-specific scripts: -->
        <script src="scripts/proton/tables.js"></script>
		<script src="js/rate.js"></script>

