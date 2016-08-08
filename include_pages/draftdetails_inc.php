<?php if(is_numeric($_REQUEST['ddid'])){
                $tbls = "dd_data";
                $data = $db->select($tbls,"*","dd_active=1 AND dd_id=$_REQUEST[ddid]");
                $re = mysql_fetch_array($data);
	?>
 <section class="retracted scrollable">
        <div class="row">
        <div class="col-md-12">
        <div class="manager-report-sec">
          
                     
                     <div class="panel panel-default panel-block">
                     <div class="page-section-title">    


	<h2 class="box_head">Demand Draft Details</h2>	
 	</div>
  <?php
     if(mysql_num_rows($data) > 0)
	{
	?>    <div class="toggle_container">
    <div class="block">
          <div class="columns clearfix">
          	<div>
            	<h1>Submitted by: <?php
                            $userInfo = getUserInfo($re['dd_user']);
							echo "$userInfo[first_name] $userInfo[last_name]";
			?></h1>
            <?php if($re['dd_dataflow']==1){?>
                        <div class="section">                                 
                            <p><strong>Client Name:</strong> DataFlow</p>
                        </div>
            <?php }?>
            
            	<div class="col_33">
                        <div class="section">                                 
                            <p><strong>Request Date:</strong> <?=date("j-M-Y",strtotime($re['dd_cdate']))?></p>
                            <p><strong>Unit(s):</strong> <?=$re['dd_units']?></p>
                            <p><strong>Status:</strong> <?=getDDStatus($re['dd_status'])?></p>
                            <p><strong>Attachment-1:</strong> 
                            <?php if($re['dd_att1']!=''){?>
                            	<a target="_blank" href="<?=$re['dd_att1']?>"><?=$re['dd_tit1']?></a> 
                            <?php }?>
                            </p>
                        </div>
                 </div>
                 
            	<div class="col_33">
                        <div class="section">  
                            <p>&nbsp;</p>       
                        	<p><strong>Fee Amount:</strong> <?=$re['dd_fee']?></p>                               
                            <p><strong>Beneficiary:</strong> <?php
                            	$uni = $db->select("uni_info","*","uni_id=$re[dd_uni]");
								$uni =  mysql_fetch_assoc($uni);
								echo $uni['uni_Name'];
							?></p>
                            <p><strong>Attachment-2:</strong> 
                            <?php if($re['dd_att2']!=''){?>
                            	<a target="_blank" href="<?=$re['dd_att2']?>"><?=$re['dd_tit2']?></a> 
                            <?php }?>
                            </p>
                        </div>
                 </div>
         
                <div class="col_33">
                        <div class="section"> 
                            <p>&nbsp;</p> 
                        	<p><strong>Total Amount:</strong> <?=$re['dd_fee']*$re['dd_units']?></p>                                
                            <p><strong>Verifying Authoritys:</strong> <?=$re['dd_bene']?></p>
                            <p><strong>Attachment-3:</strong> 
                            <?php if($re['dd_att3']!=''){?>
                            	<a target="_blank" href="<?=$re['dd_att3']?>"><?=$re['dd_tit3']?></a> 
                            <?php }?>
                            </p>
                        </div>
                 </div>
            
            
            </div>  
            
            <div class="section grid_8">
            	
                <ul class="block content_accordion no_rearrange">
                                        <?php 				
										$tabls = "dd_checks dd INNER JOIN ver_checks vc ON dd.as_id=vc.as_id  INNER JOIN checks ck ON vc.checks_id=ck.checks_id INNER JOIN ver_data vd ON vd.v_id=vc.v_id";						
										
										$where = "dd.dc_active=1 AND dd.dd_id=$_REQUEST[ddid]";
                                        $checks = $db->select($tabls,"*",$where);
                                        while($check =mysql_fetch_array($checks)){
											$com = getcompany($check['com_id']);
											$com = mysql_fetch_assoc($com);?>
                                            <li>
												<?="#:$check[emp_id] ".$check['v_name']." ($com[name]) $check[checks_title]"?> 
                                            </li>
                                <?php	} ?> 
                     
               </ul>
           </div>
		</div>
       
          	<div class="button_bar clearfix">
            	<?php if($re['dd_status']!=2 || $LEVEL==6){?>
                <div class="list-group">
                <div class="list-group-item">
                <div>
                <form method="post" enctype="multipart/form-data" style="float:left; width:50%;">
                        	<input type="hidden" name="ddid" value="<?=$re['dd_id']?>" />
                            <?php if($re['dd_dataflow']==1){?>
                            	<input type="hidden" name="dataflow" value="1" />
                            <?php }?>
                            <select name="status" class="form-control" style="display:inline-block; width:55%;">
                                    <?php if($LEVEL==6){?>
                                    <option value="2" <?=($_POST['status']==2)?'selected="selected"':''?>>Paid</option>
                                    <option value="3" <?=($_POST['status']==3)?'selected="selected"':''?>>Rejected</option>
                                    <?php }else{ ?>
                                    <option value="0" <?=($_POST['status']==0)?'selected="selected"':''?>>Draft</option>
                                    <option value="1" <?=($_POST['status']==1)?'selected="selected"':''?>>Send to Finance</option>
									<?php }?>
                            </select>
                            
                        <button class=" btn btn-default"  type="submit" name="ddChange" style="margin:0 20px;" >
                        <span>Update Status</span>
                    	</button>
                    
                </form>   
               
            	<form action="?action=demanddraft&atype=add&edit=<?=$re['dd_id']?>" method="post" enctype="multipart/form-data">
                    <button class="btn btn-success "  type="submit" name="vedit" >
                        <span>Edit</span>
                    </button>  
                </form>
               </div>
               </div>
               </div>
                <?php } ?>
             </div>
		</div>
 	</div>
    
 <?php }
				else
				{
					echo "<h2 style='text-align: center;'>No Record Found</h2>";
				}
	?>    
    
    
   </div>
   </div>
   </div>
   </div>
  
   </section> 
    

<?php }?>