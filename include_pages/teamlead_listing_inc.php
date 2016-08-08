<?php 
if($_REQUEST['an_id']){
	
	
	$an_id 	= ($_REQUEST['an_id'])?$_REQUEST['an_id']:0;
	$ta_id 	= ($_REQUEST['ta_id'])?$_REQUEST['ta_id']:0;
	
	$selRoles = $db->select("tl_analyst_rel","*"," ta_id=$ta_id and  analyst_id=$an_id");
	$rows = mysql_num_rows($selRoles);
	if($rows>0){
		$ColsVals = "analyst_id=0";
		$db->delete("tl_analyst_rel","ta_id=$ta_id and analyst_id=$an_id");
		msg('sec',"Analyst removed successfully from Team.");
	}else{
		//msg('err',"Please select Analyst!");
		}

}


?>

<section class="retracted scrollable">
<div class="row">
  <div class="col-md-12">
    <div class="manager-report-sec">
    
    	<div class="page-section-title">
                    <h2 class="box_head">Add Team Lead And Analyst</h2>
                </div>
                
      <div class="panel panel-default panel-block">
        <div class="list-group-item">

                    <div class="list-group-item">
                      <form action="" name="" method="post">
                      			<div class="form-group">
                                    <label>Team Lead :</label>
                                    <select class="form-control" id="source" name="tl_id">
                                    	<option value="">Please Select</option>
                                    <?php $team_lead = $db->select("users","*","level_id = 12 and is_active = 1");
											if(mysql_num_rows($team_lead)>0){
											while($tlead = mysql_fetch_array($team_lead)){ 
											?>
                                            <option value="<?=$tlead['user_id']?>"><?=ucwords($tlead['first_name'])?></option>
										<?php 	}
										}
									?>
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Analyst :</label>
                                    <select class="form-control" id="source" name="analyst_id">
                                    	<option value="">Please Select</option>
                                     <?php $analyst = $db->select("users","*","user_id NOT IN (SELECT analyst_id FROM `tl_analyst_rel`) AND level_id = 3 ");
											if(mysql_num_rows($analyst)>0){
											while($analystData = mysql_fetch_array($analyst)){ 
											?>
                                            <option value="<?=$analystData['user_id']?>"><?=ucwords($analystData['first_name'])?></option>
										<?php 	}
										}
									?>
                                    </select>
                                </div>
                                
								<button type="submit" class="btn filebtn btn-success check_cnic" name="addanalysttolead">Submit</button>
                      </form>
                            
                    </div>
        </div>
       
        
      </div>
    </div>
   
    
        

    
  </div>
</div>


<div class="row">
  <div class="col-md-12">
    <div class="manager-report-sec">
    
    	<div class="page-section-title">
                    <h2 class="box_head">Add Team Lead And Analyst</h2>
                </div>
                
      <div class="panel panel-default panel-block">
        <div class="list-group-item">
        
        	<!--<ul class="team-lead-section">
            	<li>
                	<ul>
                    	<li><h3>Team A</h3></li>
                        <li><strong>Team Lead Name</strong></li>
                        <li>Name 1</li>
                        <li>Name 2</li>
                        <li>Name 3</li>
                        <li>Name 4</li>
                    </ul>
                </li>
                
                
                <li>
                	<ul>
                        <li><h3>Team B</h3></li>
                        <li><strong>Team Lead Name</strong></li>
                        <li>Name 9</li>
                        <li>Name 8</li>
                        <li>Name 7</li>
                        <li>Name 6</li>
                    </ul>
                </li>
                <li>
                	<ul>
                    	<li><h3>Team C</h3></li>
                        <li><strong>Team Lead Name</strong></li>
                        <li>Name 4</li>
                        <li>Name 9</li>
                        <li>Name 2</li>
                        <li>Name 8</li>
                    </ul>
                </li>
                
                <div class="clearfix"></div>
            </ul>-->
            <!--<ul class="team-lead-section">
            	<li>
                	<ul>
                    	<li><h3>Team A</h3></li>
                        <li><strong>Team Lead Name</strong></li>
                        <li>Name 1</li>
                        <li>Name 2</li>
                        <li>Name 3</li>
                        <li>Name 4</li>
                    </ul>
                </li>
                
                
                <li>
                	<ul>
                        <li><h3>Team B</h3></li>
                        <li><strong>Team Lead Name</strong></li>
                        <li>Name 9</li>
                        <li>Name 8</li>
                        <li>Name 7</li>
                        <li>Name 6</li>
                    </ul>
                </li>
                <li>
                	<ul>
                    	<li><h3>Team C</h3></li>
                        <li><strong>Team Lead Name</strong></li>
                        <li>Name 4</li>
                        <li>Name 9</li>
                        <li>Name 2</li>
                        <li>Name 8</li>
                    </ul>
                </li>
                
                <div class="clearfix"></div>
            </ul>-->
            
            <?php 
										$team_leads = $db->select("users","*","level_id = 12 and is_active = 1 ");
										if(mysql_num_rows($team_leads)>0){
											$index = 0;
											$ist = '';
											$second = '';
											$third = '';?>
											<ul class="team-lead-section">
											<?php while($tlead = mysql_fetch_array($team_leads)){ 
											
												$ist .= ($index==0) ? $tlead['user_id']:'';
												$second .= ($index==1) ? $tlead['user_id']:'';
												$third .= ($index==2) ? $tlead['user_id']:'';
												$count = $index +1 ;
											?>
                                            <li>
                                                <ul>
                                                	<li><h3><?php echo $tlead['first_name']; ?></h3></li>
                                                	<?php /*?><li><strong><?php echo $tlead['first_name'];?></strong></li><?php */?>
														<?php 
														$get_analyst = $db->select("tl_analyst_rel","*","tl_id = ".$tlead['user_id']." ");
                                                        if(mysql_num_rows($get_analyst)>0){
                                                        while($getData = mysql_fetch_array($get_analyst)){ 
                                                        $lead_users = $db->select("users","*","user_id = ".$getData['analyst_id']." ");
                                                        while($leadData = mysql_fetch_array($lead_users)){ 
                                                        ?>
                                                       <li><?=ucwords($leadData['first_name']);?> <a href="javascript:;" style="float:right;" onclick="removeRec(<?=$leadData['user_id']?>,<?=$getData['ta_id']?>);" title="Remove"><i class="icon-remove"></i></a></li>
                                                        <?php 
                                                        }
                                                        }
                                                        }else{
                                                        echo '<td>No Analyst in this team</td>';
                                                        }
                                                        ?> 
                                                </ul>
											</li>
                                            <?php 	
												$index++;
											}
											?>
                                            	<div class="clearfix"></div>
                                            </ul>
                                            
										<?php 
										}
									 ?>
            
                    <?php /*?><div class="list-group-item">
                      
                            <table>
                                <thead>
                                    <tr>
                                        <th>Team Lead A</th>
                                        <th>Team Lead B</th>
                                        <th>Team Lead C</th>
                                    </tr>
                                    <tr>
                                   	<?php 
										$team_leads = $db->select("users","*","level_id = 12 and is_active = 1 limit 0,3");
										if(mysql_num_rows($team_leads)>0){
											$index = 0;
											$ist = '';
											$second = '';
											$third = '';
											while($tlead = mysql_fetch_array($team_leads)){ 
												echo '<th>'.$tlead['first_name'].'</th>';
												
												$ist .= ($index==0) ? $tlead['user_id']:'';
												$second .= ($index==1) ? $tlead['user_id']:'';
												$third .= ($index==2) ? $tlead['user_id']:'';
												$index++;
											}
										
										}
									 ?>
                                     
                                    </tr>
                                </thead>
                                <tbody>
									<?php	
                                    $ist_tl = $db->select("tl_analyst_rel","*","tl_id = '$ist' ");
									$second_tl = $db->select("tl_analyst_rel","*","tl_id = '$second' ");
									$third_tl = $db->select("tl_analyst_rel","*","tl_id = '$third' ");
									
									?>
                                    
										<tr>
											<?php 
											if(mysql_num_rows($ist_tl)>0){
												while($ist_d = mysql_fetch_array($ist_tl)){ 
													$first_lead_users = $db->select("users","*","user_id = ".$ist_d['analyst_id']." ");
													while($first_lead = mysql_fetch_array($first_lead_users)){ 
												?>
                                            		<td><?=ucwords($first_lead['first_name']);?></td>
                                            <?php 
													}
											}
											}else{
												echo '<td>No Analyst in this team</td>';
											}
											?>   
                                            <?php 
											if(mysql_num_rows($second_tl)>0){
												while($second_d = mysql_fetch_array($second_tl)){ 
													$second_lead_users = $db->select("users","*","user_id = ".$ist_d['analyst_id']." ");
													while($second_lead = mysql_fetch_array($second_lead_users)){ 
												?>
                                            		<td><?=ucwords($second_lead['first_name']);?></td>
                                            <?php 
													}
												}
											}else{
												echo '<td>No Analyst in this team</td>';
											}
											?> 
                                            <?php 
											if(mysql_num_rows($third_tl)>0){
												while($third_d = mysql_fetch_array($third_tl)){ 
                                            		$third_lead_users = $db->select("users","*","user_id = ".$ist_d['analyst_id']." ");
													while($third_lead = mysql_fetch_array($third_lead_users)){ 
												?>
                                            		<td><?=ucwords($third_lead['first_name']);?></td>
                                            <?php 
													}
                                             }
											}else{
												echo '<td>No Analyst in this team</td>';
											}
											?> 
                                                                                     
										</tr>
			
                                </tbody>
                            </table>
                    </div><?php */?>

        </div>
       
        
      </div>
    </div>
   
    
        

    
  </div>
</div>
<script type="text/javascript">

function removeRec(an_id,ta_id){
	
	if(confirm("Are you sure want to remove this analyst?")){
		
		document.location="?action=teamlead&atype=lead&an_id="+an_id+"&ta_id="+ta_id;
	}
	
	
}
</script>