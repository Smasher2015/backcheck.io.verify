<?php 

	if(is_numeric($USERID)){
		$tUinfo = getUserInfo($USERID);
		$_REQUEST['comid']  = $tUinfo['com_id'];
		$_REQUEST['ulevel'] = $tUinfo['level_id'];
		$_REQUEST['fname']  = $tUinfo['first_name'];
		$_REQUEST['lname']  = $tUinfo['last_name'];
		$_REQUEST['email']  = $tUinfo['email'];
		
	}
?>

<section class="retracted scrollable">
    <div class="row">
        <div class="col-md-12">
            <div class="manager-report-sec">
            	<!--First Step-->	
                <div class="panel panel-default panel-block" style="display:<?php echo (is_array($UserDataEmail) && !empty($UserDataEmail) ? 'none' : 'block'); ?> ">
                    <div class="list-group-item">
						<div class="page-section-title">
                            <h2 class="box_head">Candidate Profile</h2>
                        </div>
            
									
									
				<form class="cstm validate_form" name="" method="post" enctype="multipart/form-data">
  	
   	
					     
      <script>
	  
			
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
	  
	  
           
            					<fieldset class="form-group">
									<label>First Name:</label>
									<div>
										<input class="form-control" type="text" name="fname" value="<?=$_REQUEST['fname']?>" >
									</div>
								</fieldset>
								<fieldset class="form-group">
									<label>Last Name:</label>
									<div>
										<input class="form-control" type="text" name="lname" value="<?=$_REQUEST['lname']?>" >
									</div>
								</fieldset>
								<fieldset class="form-group">
									<label>Email Address:</label>
									<div>
										<input class="form-control" type="text" readonly="readonly" name="email" value="<?=$_REQUEST['email']?>" >
									</div>
								</fieldset>
								
								
								
								
								
								<fieldset class="form-group">
									<label><input type="checkbox" name="changepass" id="changepass" value="1" > Change Password</label>
									
								</fieldset>
								
								
								
								<fieldset class="form-group">
									<label>Password:</label>
									<div>
										<input class="form-control" type="password" name="passa" id="passa"  value="" disabled="disabled" >
									</div>
								</fieldset>
								<fieldset class="form-group">
									<label>Confirm Password:</label>
									<div>
										<input class="form-control" type="password" name="passb" id="passb"  value="" disabled="disabled" >
									</div>
								</fieldset>
				
				
				<?php if(is_numeric($USERID)){ ?>
                	<input type="hidden" name="uid" value="<?=$USERID?>"  />
                <?php } ?>
                 <div class="list-group-item" style="margin-bottom:30px;">
			<div class="form-group">					
            <button type="submit" class="btn btn-lg btn-success" style="float:right;" name="register" >	
			<input type="hidden" name="ulevel" value="applicant"  />
                           
                            <span>Edit Profile</span>
            </button>
            </div>
            </div>
    </form>

						
									
									
									
									
									
									
									
									
					</div>
               </div>
           </div>
        </div>
    </div>
