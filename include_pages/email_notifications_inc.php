		<div class="box grid_16">		<?php /*?> <h2 class="box_head"><?=$PTITLE?></h2><?php */?>		  
		<a href="#" class="grabber">&nbsp;</a>		
		 <a href="#" class="toggle">&nbsp;</a>		  
		 <div class="toggle_container">			
		 <form  method="post" enctype="multipart/form-data">				   
		 <div class="col-md-12">							 
		 <div class="form-group">							 
		 <label>
		 <input type="checkbox" class="styled"  name="is_send_searched" value="1" <?php echo ($userInfo['is_send_searched']==1)?'checked="checked"':''; ?> />
		 Do you want to receive daily saved searched emails?
		 </label>														
		 <div class="clear" ></div>						  
		 </div>					
		 </div>				
		 <div class="col-md-12">							
		 <div class="form-group">							 
		 <label><input type="checkbox" class="styled"  name="is_weekly_updates" value="1" <?php echo ($userInfo['is_weekly_updates']==1)?'checked="checked"':''; ?> /> Weekly Updates
		 </label>														 
		 <div class="clear" ></div>						   
		 </div>					
		 </div>

		<div class="col-md-12">							
		 <div class="form-group">							 
		 <label><input type="checkbox" class="styled"  name="is_insuff_notify" value="1" <?php echo ($userInfo['is_insuff_notify']==1)?'checked="checked"':''; ?> /> Insufficiency Notification
		 </label>														 
		 <div class="clear" ></div>						   
		 </div>					
		 </div>
		 
		 <div class="col-md-12">							
		 <div class="form-group">							 
		 <label><input type="checkbox" class="styled"  name="is_checks_added_notify" value="1" <?php echo ($userInfo['is_checks_added_notify']==1)?'checked="checked"':''; ?> /> Notify me when a new check submitted against an applicant.
		 </label>														 
		 <div class="clear" ></div>						   
		 </div>					
		 </div>
		 
		 
		 <div class="col-md-12">							 
		 <div class="form-group">							 
		 <label><input type="checkbox" class="styled"  name="is_other_notify" value="1" <?php echo ($userInfo['is_other_notify']==1)?'checked="checked"':''; ?> /> Other all notifications?</label>														   
		 <div class="clear" ></div>						 
		 </div>					
		 </div>											  
		 <div class="col-md-12"> <button type="submit" class="btn bg-success pull-right" name="sub_email_notify" ><i class="icon-reset position-left"></i> Update Settings				 </button>				   
		 </div>							 
		 </form>		
		 <div class="clear"></div>		 
		 </div>
		 </div>