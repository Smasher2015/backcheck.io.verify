<?php
if(isset($_REQUEST['edur'])){
	if(is_numeric($_REQUEST['uid'])){
		enabdisb("users","user_id=$_REQUEST[uid]");
	}
}

if(isset($_REQUEST['edit'])){
	
	if(is_numeric($_REQUEST['uid'])){
		$tUinfo = getUserInfo($_REQUEST['uid']);
		
		$_REQUEST['comid']  = $tUinfo['com_id'];
		$_REQUEST['ulevel'] = $tUinfo['level_id'];
		$_REQUEST['fname']  = $tUinfo['first_name'];
		$_REQUEST['lname']  = $tUinfo['last_name'];
		$_REQUEST['email']  = $tUinfo['email'];
		$_REQUEST['kpi']  = $tUinfo['kpi'];
		$_REQUEST['puser_id']  = $tUinfo['puser_id'];
		$_REQUEST['loc_id']  = $tUinfo['loc_id'];
	}
}else{
	
	if(is_numeric($_REQUEST['uid'])){
		$tUinfo = getUserInfo($_REQUEST['uid']);
		
		$_REQUEST['comid']  = $tUinfo['com_id'];
		$_REQUEST['ulevel'] = $tUinfo['level_id'];
		$_REQUEST['fname']  = $tUinfo['first_name'];
		$_REQUEST['lname']  = $tUinfo['last_name'];
		$_REQUEST['email']  = $tUinfo['email'];
		$_REQUEST['kpi']  = $tUinfo['kpi'];
		$_REQUEST['puser_id']  = $tUinfo['puser_id'];
		$_REQUEST['loc_id']  = $tUinfo['loc_id'];
	}
	
	
}
?>

  <section class="retracted scrollable">
        <div class="row">
        <div class="col-md-12">
        <div class="report-sec">
         <div class="page-header">
            <div class="page-header-content">
                <div class="page-title3">
                        <h2><?=isset($_REQUEST['uid'])?'Edit':'Add'?> Users</h2>
                    </div></div></div>
                     
                     <div class="panel panel-default panel-block">
                     
                        <div class="">
                        <div class="panel-body">
                        <div class="toggle_container">	
    <form class="cstm" name="" method="post" >
  	<div class="col-md-6">
   		<fieldset class="form-group">
											<label>User Level:</label>
											
												<select class="select_box form-control" name="ulevel" id="user_level">
													<option value="0" <?php if(!isset($_REQUEST['ulevel'])) echo 'selected="selected"'; ?> >--Select Level--</option>
                        <?php
						$levels= $db->select("levels","*","is_active=1");
						if(mysql_num_rows($levels)>0){
							while($level = mysql_fetch_array($levels)){ ?>
                        		<option value="<?php echo $level['level_id']; ?>" 
									<?php if(isset($_REQUEST['ulevel'])) if($level['level_id']==$_REQUEST['ulevel']) echo 'selected="selected"'; ?>>
									<?php echo $level['level_name']; ?>
                                </option>
                        <?php }
						} ?>
												</select>				
																					</fieldset> </div>
																					
					<div class="col-md-6">																
					<fieldset class="form-group"  id="kpi_option" style="display:<?php if(isset($_REQUEST['ulevel'])) if($_REQUEST['ulevel']==12 || $_REQUEST['ulevel']==3) echo "block"; else echo 'none"'; ?>;">
									<label>KPI:</label>
									<div>
										<input class="form-control" onkeyup="this.value=this.value.replace(/[^\d]/,'');" type="text" name="kpi" value="<?=$_REQUEST['kpi']?>" id="kpi" maxlength="4" >
									</div>
								</fieldset>
                                </div>
       
       
       <div class="col-md-6">
       <fieldset class="form-group" id="select_company" style="display:<?php if(isset($_REQUEST['comid'])) if($_REQUEST['comid']!=0) echo "block"; else echo 'none"'; ?>;" >
											<label>Select Client:</label>
											<div>
												<select class="select_box form-control" name="com_id" onchange="getCLUsers(this.value), getLocUsers(this.value);">
													<option value="0">--Select Client--</option>
                        <?php
						$companys = $db->select("company","*");
						if(mysql_num_rows($companys)>0){
							while($company = mysql_fetch_array($companys)){ ?>
                        		<option value="<?php echo $company['id']; ?>" 
									<?php if(isset($_REQUEST['comid'])) if($company['id']==$_REQUEST['comid']) echo 'selected="selected"'; ?>>
									<?php echo $company['name']; ?>
                                </option>
                        <?php }
						} ?>
												</select>				
											</div>
										</fieldset>
                                        </div>
		
		
		
		<div class="col-md-6">
		<fieldset class="form-group" id="puser_fieldset" style="display:<?php if(isset($_REQUEST['com_id'])) if($_REQUEST['com_id']!=0) echo "block"; else echo 'none"'; ?>;" >
											<label>Select Parent:</label>
											<div>
												<select class="select_box form-control" name="puser_id" id="puser_id" >
													<option value="0">--Select Parent User--</option>
													<?php 
			if(isset($_REQUEST['comid'])){
		$where = " com_id=$_REQUEST[comid] AND user_id!=$_REQUEST[uid] AND is_active=1 ORDER BY first_name ASC";
			
		$getClUser = $db->select("users","*",$where);
			
			while($rsUsers =	mysql_fetch_array($getClUser)){ ?>
		
		<option value='<?=$rsUsers['user_id']?>' <?php if ($_REQUEST['puser_id']==$rsUsers['user_id']){ echo " selected='selected'"; } ?> >
		<?php echo $rsUsers['first_name']." ".$rsUsers['last_name']?>
		</option>
			
		<?php } 
	
			} ?>
			</select>				
											</div>
										</fieldset>
		
		
		</div>
		
		<div class="col-md-6">
		<fieldset class="form-group" id="location_fieldset" style="display:<?php if(isset($_REQUEST['com_id'])) if($_REQUEST['com_id']!=0) echo "block"; else echo 'none"'; ?>;" >
											<label>Select Location:</label>
											<div>
												<select class="select_box form-control" name="loc_id" id="loca_id">
													<option value="0">--Select Location--</option>
													<?php 
			if(isset($_REQUEST['comid'])){
		$where = " com_id=$_REQUEST[comid] AND status=0 ORDER BY location ASC";
			
		$getuLocations = $db->select("users_locations","*",$where);
			
			while($rsLocations =	mysql_fetch_array($getuLocations)){ ?>
		
		<option value='<?=$rsLocations['loc_id']?>' <?php if ($_REQUEST['loc_id']==$rsLocations['loc_id']){ echo " selected='selected'"; } ?> >
		<?php echo $rsLocations['location'];?>
		</option>
			
		<?php } 
			} ?>
			</select>				
											</div>
										</fieldset>
		</div>
		
            <script>
	  
			$("#user_level").on("change",function () {
			
				if($(this).val()==4){
					$("#select_company").css("display","block");
					$("#puser_fieldset").css("display","block");
					$("#location_fieldset").css("display","block");
					
				}else{
					$("#select_company").css("display","none");
					$("#puser_fieldset").css("display","none");
					$("#location_fieldset").css("display","none");
				}
				// if analyst or team lead
				if($(this).val()==12 || $(this).val()==3){
					$("#kpi_option").css("display","block");
				}else{
					$("#kpi_option").css("display","none");
					$("#kpi").val("");
				}
			});
			$(function(){
			$("#changepass").on("click",function () {
				
			if($('#changepass').is(':checked')){
				$('#passa').removeAttr('disabled');
				$('#passb').removeAttr('disabled');
			}else{
				$('#passa').attr('disabled','disabled');
				$('#passb').attr('disabled','disabled');
			}
			
			});
			});
		
      </script> 	
	  
	  
           						<div class="col-md-6">
            					<fieldset class="form-group">
									<label>First Name:</label>
									<div>
										<input class="form-control" type="text" name="fname" value="<?=$_REQUEST['fname']?>" >
									</div>
								</fieldset>
                                </div>
                                <div class="col-md-6">
								<fieldset class="form-group">
									<label>Last Name:</label>
									<div>
										<input class="form-control" type="text" name="lname" value="<?=$_REQUEST['lname']?>" >
									</div>
								</fieldset>
                                </div>
                                <div class="col-md-6">
								<fieldset class="form-group">
									<label>Email Address:</label>
									<div>
										<input class="form-control" type="text" name="email" value="<?=$_REQUEST['email']?>" >
									</div>
								</fieldset>
                                </div>
								
								
								
								
								<div class="col-md-12">
								<fieldset class="form-group">
									<label><input type="checkbox" name="changepass" id="changepass" value="1" > Change Password</label>
									
								</fieldset>
								
								
								<div class="col-md-6">
								<fieldset class="form-group">
									<label>Password:</label>
									<div>
										<input class="form-control" type="password" name="passa" id="passa"  value="" disabled="disabled" >
									</div>
								</fieldset>
                                </div>
                                <div class="col-md-6">
								<fieldset class="form-group">
									<label>Confirm Password:</label>
									<div>
										<input class="form-control" type="password" name="passb" id="passb"  value="" disabled="disabled" >
									</div>
								</fieldset>
                                </div>
                                </div>
				
				
				<?php if(is_numeric($_REQUEST['uid'])){ ?>
                	<input type="hidden" name="uid" value="<?=$_REQUEST['uid']?>"  />
                <?php } ?>
                 <div class="list-group-item" style="margin-bottom:30px;">
			<div class="form-group">					
            <button type="submit" class="btn btn-lg btn-success" style="float:right;" name="register" >	
                           
                            <span><?=isset($_REQUEST['uid'])?'Edit':'Add'?> User</span>
            </button>
            </div>
            </div>
    </form>
</div>

					
                        

            
                        
                       
						</div>
						</div>
					</div>
                    
        	
    </div>
    
    	</div>
        </div>
</section>
  <section class="retracted scrollable">
        <div class="row">
        <div class="col-md-12">
        <div class="manager-report-sec">
			<div class="page-header">
            <div class="page-header-content">
                <div class="page-title3">
        <h2>User Listing</h2>
        </div></div></div>
           <div class="panel panel-default panel-block">
                     
                        <div class="panel-body">
                        <div class="list-group-item">
 		<table class="table datatable-basic dataTable no-footer" id="tableSortable">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Country</th>
                 <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php	
			$users= $db->select("users","*","1=1 $SSTR");
		 
            if(mysql_num_rows($users)>0){
            while($user = mysql_fetch_array($users)){ ?>
                <tr>
                    <td><?=trim($user['first_name']." ".$user['last_name'])?></td>
                    <td style="text-align:left"><?=$user['email']?></td>
                    <td><?php 
                            $levelInf = $db->select("levels","*","level_id=$user[level_id]");
                            $levelInf = mysql_fetch_array($levelInf);
                            echo $levelInf['level_name'];
                        ?>    
                    </td>
                    <td><?=$user['country']?></td>
                    <td align="center">
						<?php  if($user['is_active']==1) {
                                 $img="icon-blocked";
                                    $tit="Disable"; 
									$color = "style='color:#0DAF0D;'";
                                }else{
                                     $img="icon-check";
                                     $tit="Enable";
									 $color = "style='color:#ff0000;'";
                                } 
                                $link="uid=$user[user_id]";
                        ?>
	

					<ul class="icons-list">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="icon-menu9"></i>
                </a>
        
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="javascript:void(0)" onclick="submitLink('<?=$link?>&edit')"><i class="icon-pencil5"></i> Edit</a></li>     
                    <li><a href="javascript:void(0)" onclick="submitLink('<?=$link?>&edur')"><i class="<?=$img?>" <?=$color?>></i>  <?=$tit?></a></li>
                   
                    
                </ul>
            </li>
        </ul>

                    </td>
                </tr>	    
        <?php }} ?>
        </tbody>
    </table>
    	</div>
        </div>
        </div>
    	</div>
        </div>
        </div>
     </section>   
<script src="scripts/proton/tables.js"></script>

<script>
   function getCLUsers(com_id){
	//alert(com_id);   
	   
   var param="action=ePage&ePage=add_rating&getclusers=1&com_id="+com_id;
   
	ajaxServices("actions.php",param,'puser_id');
	//getLocUsers(com_id); 
	
	
  // var param="action=ePage&ePage=add_rating&getlocusers=1&com_id="+com_id;
   
	//ajaxServices("actions.php",param,'loc_id');
	
   }


   function getLocUsers(com_id){//alert("asdasdasasdasd");     
	  // alert(com_id);alert("ssdvds");
   var param2="action=ePage&ePage=add_rating&getlocusers=2&com_id="+com_id;
   
	//ajaxServices("actions.php",param2,'loca_id');
	$.ajax({    
    type: "POST",
    url: "actions.php",
    data: param2,
    success: function(response){
	$("#loca_id").html(response);
   
	}
	});
	
   }
   </script>