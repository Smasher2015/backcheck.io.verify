    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title2">
	            <h4><i class="icon-arrow-left52 position-left"></i> Insufficiency List</h4>
            </div>
        </div>
    </div>
                    
       <div class="content">                
                   <div class="row">
                                          <tbody>
		<?php 	
		if($LEVEL==4){
		$com_id = $COMINF['id'];	
		}else{
		$com_id = ($_REQUEST['comid']!="")?$_REQUEST['comid']:1;
		}
		$mnth = $_REQUEST['mnth'];
		$yr = $_REQUEST['yr'];
		
		$sel = countInsuffDocsByClient($com_id,'',true);
		if(@mysql_num_rows($sel)>0){
                     while($re = mysql_fetch_array($sel)) { 
					 ?>
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
		
		<div class="panel panel-flat"><div class="panel-heading"><h6 class="panel-title text-center">No Insufficient</h6></div></div>
		
		
		<?php } ?>
                   
                   </div>
                   
                   
            </div>

<script src="scripts/proton/tables.js"></script>