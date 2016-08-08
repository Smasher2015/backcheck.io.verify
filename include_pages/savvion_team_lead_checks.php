<?php 

$db = new DB();
$id = (int) $_REQUEST['id'];


//echo "ssss".$res['team_lead_id'];
//$team_lead_id 	= ($res['team_lead_id'])?$res['team_lead_id']:0;
//$checks_id	= ($res['checks_id'])?$res['checks_id']:0;

//echo $checks_id." ".$team_lead_id; exit;




if($_REQUEST['saveRoles']){
	
	
	$team_lead_id 	= ($_REQUEST['team_lead_id'])?$_REQUEST['team_lead_id']:0 ;
	$checks_id 	= ($_REQUEST['checks_id'])?$_REQUEST['checks_id']:0;
	
	$selRoles = $db->select("savvion_teamlead_checks","id"," checks_id=$checks_id");
	$rows = mysql_num_rows($selRoles);
	if($rows>0){
		
		msg('err',"This check already assigned to team lead !");
	}else{
		$Cols = "checks_id,team_lead_id";
		$Vals = " $checks_id, $team_lead_id ";
		$db->insert($Cols,$Vals,"savvion_teamlead_checks");
		
		msg('sec',"Check Assigned Successfully.");
		}

}


	
if($_REQUEST['updateRoles']){
	if($id){
	$team_lead_id 	= ($_REQUEST['team_lead_id'])?$_REQUEST['team_lead_id']:0 ;
	$checks_id 	= ($_REQUEST['checks_id'])?$_REQUEST['checks_id']:0;

	$ColsVals = "checks_id=$checks_id,team_lead_id=$team_lead_id";
	
	$selRoles = $db->select("savvion_savvion_teamlead_checks","id"," checks_id=$checks_id");
	$rows = mysql_num_rows($selRoles);
	if($rows>0){
		
		msg('err',"This check already assigned to team lead !");
	}else{
		
		$db->update($ColsVals,"savvion_teamlead_checks"," id=$id");
		msg('sec',"Record updated successfully.");
	}
}

}

if($_REQUEST['del']==1){
	$id = (int) $_REQUEST['role'];
	if($id ){
	
		
		if($db->delete("savvion_teamlead_checks"," id=$id")){
		
		msg('sec','Record Successfully deleted.');
		}else{
		msg('sec','Already deleted.');	
		}
	
}

}
if($_REQUEST['edit']==1){

$selRoles = $db->select("savvion_teamlead_checks","team_lead_id,checks_id"," id=$id");
$res = mysql_fetch_assoc($selRoles);
$team_lead_id 	= ($res['team_lead_id'])?$res['team_lead_id']:0;
$checks_id	= ($res['checks_id'])?$res['checks_id']:0;
}
?>


<section class="retracted scrollable">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
        <div id="filters" class="section" >
          <div class="page-section-title">
              <h2 class="box_head">Set Savvion Checks to Team Lead</h2>
            </div>
          <div class="list-group-item" >
          
            <div style="margin-bottom:30px;">
            <form action="<?="?action=$action&atype=$aType"?>" class="table-form"  method="post">
             
             
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label>Select Savvion Team Lead:</label>
                  </div>
                  <div class="col-md-9">
                    <select id="team_lead_id" name="team_lead_id" class="form-control" >
                      <option value="0"> --------Select Team Lead-------- </option>
                      <?php 	
                       
					   $dWhere="level_id=13 AND is_active=1 AND user_id NOT IN (SELECT team_lead_id FROM `savvion_teamlead_checks`)";
														
                	$users = $db->select("users","*","$dWhere "); 
                	while($user =mysql_fetch_assoc($users)){ ?>
                    	<option value="<?=$user['user_id']?>" <?php echo ($user['user_id']==$team_lead_id)?'selected="selected"':'';?>><?=trim($user['first_name'].' '.$user['last_name'])?></option>
               		<?php } ?>
                    </select>
                  </div>
                </div>
				</div>
				<div class="form-group">&nbsp;</div>
				  <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label>Select Savvion Checks:</label>
                  </div>
                  <div class="col-md-9">
                    <select id="checks_id" name="checks_id" class="form-control" >
                      <option value=""> --------Select Checks-------- </option>
                      <?php 	
                                                //$dWhere=" ORDER BY checks_title ASC";							
                                                $selChecks = $db->select("checks_savvion","*",'is_active=0 AND checks_id NOT IN (SELECT checks_id FROM `savvion_teamlead_checks`) ','','ORDER BY checks_title ASC');
                                                
                                                while($st = mysql_fetch_assoc($selChecks) ){  ?>
                      <option value="<?=$st['checks_id']?>" <?php echo ($st['checks_id']==$checks_id)?'selected="selected"':'';?>>
                      <?=$st['checks_title']?>
                      </option>
                      <?php	} ?>
					  
                    </select>
                  </div>
                </div>
				</div>
				
				
			  <div class="col-lg-9"><button class="btn btn-lg btn-success" style="float:right;" type="submit" 
			  name="<?php echo (!empty($_REQUEST['id']))?'updateRoles':'saveRoles'?>" value="1"> <span>  <?php echo ($_GET['id'])?'Update Assigned Check':'Assign Check'?>  </span> </button></div>
			  <input type="hidden" name="id" value="<?php echo $id;?>" >

            </form>
            </div>
            <style type="text/css">
			.page-section-title h2{ padding:0; margin:0;}
			</style>
             <div style="clear:both; margin-bottom:30px;"></div>
              <!--<div id="titleBar" class="page-section-title"> 
              <div class="row">
             
             
              
                </div>
                </div>-->
                
              </div>
            </div>
          </div>
        </div>
      </div>
  <div class="clear"></div>
  
  <div class="row">
    <div class="col-md-12">
      <div class="report-sec">
          <div class="page-section-title">
              <h2 class="box_head">Assigned Checks</h2>
            </div>
            <div class="list-group-item">
            <div class="block">
                  <div id="dt2">
                    <form class="table-form" action="" method="post" name="assignTask" enctype="multipart/form-data" id="checks_ids">
                      <div class="panel panel-default panel-block">
                        <table class="table table-bordered table-striped" id="<?php echo $_REQUEST['roles_id'];?>">
                          <thead>
                            <tr>
                           
							<th>Checks Title</th>
                            <th>Team Lead</th>
							<th>Action</th>
							
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
							
								
							
							$tbls = "savvion_teamlead_checks ar  INNER JOIN checks_savvion ch ON ar.checks_id=ch.checks_id INNER JOIN users u ON ar.team_lead_id=u.user_id ";
							
							$cols = "ar.id, ch.checks_title, u.first_name, u.last_name";
							//echo "SELECT $cols FROM $tbls WHERE $where ORDER BY c.as_id DESC";
							$data = $db->select($tbls,$cols,"");	
							
						
                            $db_count =  mysql_num_rows($data);
                           
                            if($db_count>0){
                               
                              
								$index = 0;
                                while($re = mysql_fetch_array($data)) {  
								
								
									 ?>
                            <tr>
                             
                            
                              <td ><?=$re['checks_title']?></td>
							    <td ><?=$re['first_name']." ".$re['last_name']?></td>
							  <td><a href="<?="?action=$action&atype=$aType&edit=1&id=".$re['id']?>"><i class="icon-edit"></i> Edit</a> | <a href="javascript:void(0);" onclick="deleteAssignedRol(<?php echo $re['id'];?>)"><i class="icon-remove-circle"></i> Delete</a></td>
							  
                            </tr>
                          
                            <?php 
									$index = $index+1;
								} }else{ ?>
                            <tr>
                              <td colspan="8" align="center"><strong>No Record Found</strong></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </form>
                   
                  </div>
                </div>
            </div>
      </div>
   </div>
</div>            
 
  
</section>
<script type="text/javascript">

function deleteAssignedRol(id){
	
	if(confirm("Are you sure want to delete this record ?")){
		document.location="<?="?action=$action&atype=$aType"?>&del=1&role="+id;
	}
}

</script>