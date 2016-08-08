<section class="retracted scrollable">
<div class="row">
  <div class="col-md-12">
    <div class="report-sec">
    	<div class="page-header">
            <div class="page-header-content">
                <div class="page-title3">
                	<h2>Ticket Details</h2>
        </div></div></div>
      <div class="panel panel-default panel-block">
        
        <div class="panel-body">
			<div>
                    <div>
                          			<div class="ticket-details">
									<?php	
									$ticket_id =  $_REQUEST['ticket'];

                                    $system_support = $db->select("system_support","*","sp_id = $ticket_id");
                                    if(mysql_num_rows($system_support)>0){
										$ticket = mysql_fetch_array($system_support);
										$username = getUserInfo($ticket['user_id']);
									?>
                                            <div class="list-group-item button-demo" id="twelve-column-grid">
                                            	<h4 class="section-title"><?=ucwords($ticket['sp_title'])?></h4>
                                            	<p><?=ucwords($ticket['sp_description'])?></p>
                                                <div style="width:100%; height:45px;">
                                                		<div style="width:200px; height:45px; float:left;">
                                                        <p><span>Ticket Status: </span><strong><?=ucwords($ticket['sp_status'])?></strong></p>
														 <p> <span>Department: </span><strong><?=strtoupper($ticket['sp_department'])?></strong></p>
														
														
														
														
														
														
														
														
														 
                                                        <?php if($LEVEL == 2 && $ticket['sp_status'] == 'open'){?>
															<form class="cstm" action="" name="" method="post" >
                                                                <fieldset class="form-group">
                                                                    <button type="submit" class=" btn btn-success dropdown-toggle" style="float:right;" name="updateticketstatus"  > 
                                                                    <span>Close Ticket</span> 
                                                                   </button>
                                                                   <input type="hidden" name="sp_status" value="close"  />
                                                                   <input type="hidden" name="sp_id" value="<?=$ticket['sp_id']?>"  />
                                                                </fieldset>
                        									</form>   
                                                        <?php }
															$as_id 			= $ticket['as_id'];
														 	$check_detail 	= $db->select("system_support sp LEFT JOIN `ver_checks` vc ON sp.`as_id`=vc.as_id","*","sp.`as_id` = $as_id");
															
																$check = mysql_fetch_array($check_detail);
																if($check['v_id'] != 0){?>
                                                                <a href="<?php echo SURL.'?action=details&case='.$check['v_id']; ?>">Check Details</a>
														<?php }?>   
                                                                                                          
                        								</div>
                                                		<div style="width:auto; height:45px; float:right;">
                                                        	<?php if(!empty($ticket['sp_attachment'])){ ?>
                                                        	<a style=" font-size:36px; float:left; margin-right:4px; margin-top:-6px;" href="<?php echo SURL.'files/ticketsupport/'.$ticket['sp_attachment']; ?>" download="<?php echo $ticket['sp_attachment']; ?>" title="<?=ucwords($ticket['sp_title'])?>"><i class="icon-picture"></i></a>
                                            				<?php }?>
                                                            <?php if(!empty($ticket['sp_snapshot'])){ ?>
                                                        	<a style=" font-size:36px; float:left; margin-right:4px; margin-top:-6px;" href="<?php echo SURL.'files/ticketsupport/snapshot'.$ticket['sp_snapshot']; ?>" download="<?php echo $ticket['sp_snapshot']; ?>" title="<?=ucwords($ticket['sp_title'])?>"><i class="icon-picture"></i></a>
                                            				<?php }?>
															<span style="font-size:12px;">Reported By <?php echo ucwords($username['first_name']) .' <br /> '. date('d M Y',strtotime($ticket['sp_add_date']))?></span>
                                                        </div>
                                                </div>
                                            </div>
                                           
										<?php 
									}else{ 
										echo header("Location: ".SURL."?action=supportlist&atype=support");
									} ?>
                                </div>
                    </div>
        		</div>
                
                <div class="ticket-comment-section">
                				<?php 	
									$comments = $db->select("system_support sp LEFT JOIN  support_chat sc ON sp.sp_id=sc.sp_id","*","sc.sp_id = $ticket_id");
									if(mysql_num_rows($comments)>0){ ?>
                                        
                                       <ul>
                                        <?php 
											
											while($comment = mysql_fetch_assoc($comments) ){
												$ComUInfo = getUserInfo($comment['user_id']);	
												if(trim($ComUInfo['uimg'])=='') $ComUInfo['uimg'] = "images/default.png";
											if($ComUInfo['level_id']==4){
												if($comment['sp_IsDepartment']!=1){?>
												<li>
													<div class="ticket-comment-data-sec left_side_c">
														<div class="ticket-comment-left-data-sec">
															<img src="<?=$ComUInfo['uimg']?>" title="<?="$ComUInfo[first_name] $ComUInfo[last_name]"?>">
															<strong><?php echo ucwords($ComUInfo['first_name']); ?></strong>
														</div>
														<div class="ticket-comment-right-data-sec" style="text-align:justify;">
															<p><?php echo $comment['sc_comment']; ?></p>
															<div style="width:100%; height:45px;">
															<div style="width:auto; height:45px; float:right;">
																<?php if(!empty($comment['sc_attachment'])){ ?>
																<a style=" font-size:36px; float:left; margin-right:4px; margin-top:-6px;" href="<?php echo SURL.'files/ticketsupport/'.$comment['sc_attachment']; ?>" download="<?php echo $ticket['sc_attachment']; ?>" title="<?=ucwords($ticket['sc_attachment'])?>"><i class="icon-picture"></i></a>
																<?php }?>
																<span style="font-size:12px;">Posted by <?php echo ucwords($ComUInfo['first_name']) .' <br /> '. time_ago(strtotime($comment['sc_add_date']));?></span>
															</div>
															</div>
															<?php /*?><span><?php echo ($comment['user_id'] != 0) ? 'Posted by '.  trim($ComUInfo['first_name'].' '.$ComUInfo['last_name']) : '';?> <?php echo time_ago(strtotime($comment['sc_add_date'])); ?></span><?php */?>
														</div>
														<div class="clearFix"></div>
													</div>
												<div class="clearFix"></div>
												</li>
												<?php 	}
											}else{?>
                                                <li>
													<div class="ticket-comment-data-sec right_side_c">
														<div class="ticket-comment-left-data-sec">
															<img src="<?=$ComUInfo['uimg']?>" title="<?="$ComUInfo[first_name] $ComUInfo[last_name]"?>">
															<strong><?php echo ucwords($ComUInfo['first_name']); ?></strong>
														</div>
														<div class="ticket-comment-right-data-sec" style="text-align:justify;">
															<p><?php echo $comment['sc_comment']; ?></p>
															<div style="width:100%; height:45px;">
															<div style="width:auto; height:45px; float:right;">
																<?php if(!empty($comment['sc_attachment'])){ ?>
																<a style=" font-size:36px; float:left; margin-right:4px; margin-top:-6px;" href="<?php echo SURL.'files/ticketsupport/'.$comment['sc_attachment']; ?>" download="<?php echo $ticket['sc_attachment']; ?>" title="<?=ucwords($ticket['sc_attachment'])?>"><i class="icon-picture"></i></a>
																<?php }?>
																<span style="font-size:12px;">Posted by <?php echo ucwords($ComUInfo['first_name']) .' <br /> '. time_ago(strtotime($comment['sc_add_date']));?></span>
															</div>
															</div>
															<?php /*?><span><?php echo ($comment['user_id'] != 0) ? 'Posted by '.  trim($ComUInfo['first_name'].' '.$ComUInfo['last_name']) : '';?> <?php echo time_ago(strtotime($comment['sc_add_date'])); ?></span><?php */?>
														</div>
														<div class="clearFix"></div>
													</div>
												<div class="clearFix"></div>
												</li>

											
												<?php }
											}
											?>
                                      </ul>
                                    <?php }?>
                </div>
                <div>
                	<form class="cstm" action="" name="" method="post" enctype="multipart/form-data" >
                    		<?php if($LEVEL==2 || $LEVEL==6){ ?>
                            	<div class="form-group">
                                    <label class="checkbox-inline">
                                        <div class="checker"><span><input type="checkbox" id="isFaq" name="isfaq" value="1" <?php if($_REQUEST['isfaq']){ echo 'checked="checked"';} ?>></span></div>
                                        Is Faq? 
                                    </label>
                                </div>
                                <div class="form-group" id="question">
                                	<label>Question <span class="text-danger">*</span></label>
                                	<input type="text" name="sf_question"  class="form-control parsley-validated" placeholder="Question" data-parsley-required="true" value="<?php echo $_REQUEST['sf_question']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Forward To :</label>
                                    <select class="form-control" id="sp_department" name="forward_sp_department">
                                    <option value="">Please Select</option>
                                    <?php $ops = $db->select("system_support sp LEFT JOIN  support_chat sc ON sp.sp_id=sc.sp_id","*","sp.sp_id = $ticket_id");
									if(mysql_num_rows($ops)>0){
										$option = mysql_fetch_assoc($ops);
										//print_r($option);
										$operation = ($option['sp_department']=='operation')?'disabled':'';
										$it = ($option['sp_department']=='it')?'disabled':'';
										$finance = ($option['sp_department']=='finance')?'disabled':'';
										//$hr = ($option['sp_department']=='hr')?'disabled':'';
										
										?>
                                    
                                    	<option value="operation" <?=$operation?>>Operation</option>
                                    	<option value="it" <?=$it?>>IT</option>
                                    	<option value="finance" <?=$finance?>>Finance</option>
                                    	<?php /*?><option value="hr" <?=$hr?>>HR</option><?php */?>
                                    <?php }?>
                                    
                                    </select>
                                </div>
                                <input type="hidden" name="sp_title" value="<?php echo $option['sp_title']; ?>">
                                 <input type="hidden" name="sp_department" value="<?php echo $option['sp_department']; ?>">
                                  <input type="hidden" name="sp_priorty" value="<?php echo $option['sp_priorty']; ?>">
                            <?php }?>
                            
                            <div class="form-group">
                                <label for="sc_comment">Comments </label>
                                <textarea name="sc_comment" class="form-control parsley-validated" rows="4" data-parsley-minwords="4" data-parsley-required="true" placeholder="Notes Input Box"><?php echo $_REQUEST['sc_comment']; ?> </textarea>
                            </div>
                            <div class="form-group">
                                <label>Attachment</label>
                                <div>
                                    <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
                                      <div class="input-group">
                                        <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                        <span class="input-group-addon btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="sc_attachment" ></span>
                                        <a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <button type="submit" class=" btn btn-success dropdown-toggle" style="float:right;" name="addticketcomment"  > 
                                <span>Send</span> 
                               </button>
                               <input type="hidden" name="sp_id" value="<?=$ticket['sp_id']?>"  />
                            </fieldset>
                        </form>
                
                </div>
        </div>
       
        
      </div>
    </div>
   
    
        

    
  </div>
</div> 

<script>
var request_id = <?php echo ($_REQUEST['isfaq']!=0)?$_REQUEST['isfaq']:0; ?>;
$(document).ready(function() {
	 $('#question').hide();
	 $('#isFaq').change(function () {
        if (this.checked){ 
           $('#question').show('slow');
		}
        else{ 
            $('#question').hide('slow');
		}
    });
	if(request_id!=0){
		$('#question').show('slow');
	}
	
});
</script>