<?php 
$db = new DB();
$id = (int) $_REQUEST['id'];
if($_REQUEST['saveRoles']){
	$team_lead_id 	= ($_REQUEST['team_lead_id'])?$_REQUEST['team_lead_id']:0 ;
	$checks_id 	= ($_REQUEST['checks_id'])?$_REQUEST['checks_id']:0;
	$selRoles = $db->select("teamlead_checks","id","checks_id=$checks_id");
	$rows = mysql_num_rows($selRoles);
	if(!is_numeric($team_lead_id) || !is_numeric($checks_id)){
		msg('err',"Please Select Required Values!");
	}else{
		$Cols = "checks_id,team_lead_id";
		$Vals = " $checks_id, $team_lead_id ";
		$db->insert($Cols,$Vals,"teamlead_checks");
		msg('sec',"Check Assigned Successfully.");
		}
}
if($_REQUEST['updateRoles']){
	if($id){
	$team_lead_id 	= ($_REQUEST['team_lead_id'])?$_REQUEST['team_lead_id']:0 ;
	$checks_id 	= ($_REQUEST['checks_id'])?$_REQUEST['checks_id']:0;

	$ColsVals = "checks_id=$checks_id,team_lead_id=$team_lead_id";
	
	$selRoles = $db->select("teamlead_checks","id"," checks_id=$checks_id");
	$rows = mysql_num_rows($selRoles);

		$db->update($ColsVals,"teamlead_checks"," id=$id");
		msg('sec',"Record updated successfully.");
}
}

if($_REQUEST['del']==1){
	$id = (int) $_REQUEST['role'];
	if($id ){
	
		
		if($db->delete("teamlead_checks"," id=$id")){
		
		msg('sec','Record Successfully deleted.');
		}else{
		msg('sec','Already deleted.');	
		}
}
}
if($_REQUEST['edit']==1){
$selRoles = $db->select("teamlead_checks","team_lead_id,checks_id"," id=$id");
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
              <h2 class="box_head">Assign WorkGroups to Team Lead</h2>
            </div>
          <div class="list-group-item" >
          
            <div style="margin-bottom:30px;">
            <form action="<?="?action=$action&atype=$aType"?>" class="table-form"  method="post">
             
             
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label>Select Team Lead: *</label>
                  </div>
                  <div class="col-md-9">
                    <select id="team_lead_id" name="team_lead_id" class="form-control" >
                      <option value="0"> --------Select Team Lead-------- </option>
                      <?php 	
					   $dWhere="level_id=12";
                	$users = $db->select("users","*","$dWhere AND is_active=1"); 
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
                    <label>Select WorkGroup:*</label>
                  </div>
                  <div class="col-md-9">
                    <select id="checks_id" name="checks_id" class="form-control" >
                      <option value=""> --------Select WorkGroup-------- </option>
                      <?php 	
                      //$dWhere=" ORDER BY checks_title ASC";							
                  //    $selChecks = $db->select("checks","*",'','','ORDER BY checks_title ASC');
                    //  while($st =mysql_fetch_array($selChecks)){
					   $groups_arr=getworkgroup();
					  foreach($groups_arr as $key => $group){?>
						  ?>
                      <option value="<?=$key?>" <?php echo ($key==$checks_id)?'selected="selected"':'';?>>
                      <?=$group?>
                      </option>
                      <?php	} ?>
					  
                    </select>
                  </div>
                </div>
				</div>
				
				
			  <div class="col-lg-9"><button class="btn btn-lg btn-success" style="float:right;" type="submit" 
			  name="<?php echo (!empty($_REQUEST['id']))?'updateRoles':'saveRoles'?>" value="1"> <span>  <?php echo ($_GET['id'])?'Update Assigned WorkGroups':'Assign WorkGroups'?>  </span> </button></div>
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
              <h2 class="box_head">Assigned WorkGroups</h2>
            </div>
            <div class="list-group-item">
            <div class="block">
                  <div id="dt2">
                    <form class="table-form" action="" method="post" name="assignTask" enctype="multipart/form-data" id="checks_ids">
                      <div class="panel panel-default panel-block">
                        <table class="table table-bordered table-striped" id="<?php echo $_REQUEST['roles_id'];?>">
                          <thead>
                            <tr>
                           
							<th>WorkGroups</th>
                            <th>Team Lead</th>
							<th>Action</th>
							
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
							
								
							
							$tbls = "teamlead_checks ar   INNER JOIN users u ON ar.team_lead_id=u.user_id ";
							
							$cols = "ar.id,checks_id, u.first_name, u.last_name";
							//echo "SELECT $cols FROM $tbls WHERE $where ORDER BY c.as_id DESC";
							$data = $db->select($tbls,$cols,"");	
							
						
                            $db_count =  mysql_num_rows($data);
                           
                            if($db_count>0){
                               
                              
								$index = 0;
                                while($re = mysql_fetch_array($data)) {  
								
								
									 ?>
                            <tr>
                             
                            
                              <td >
                              	<?php
							$check_id=$re['checks_id'];
							if(isset($groups_arr->$check_id)){
								echo $groups_arr->$check_id;
							}
								?>
                              </td>
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