<div class="box grid_16">
       <?php /*?> <h2 class="box_head"><?=$PTITLE?></h2><?php */?>
        <a href="#" class="grabber">&nbsp;</a>
        <a href="#" class="toggle">&nbsp;</a>
        <div class="toggle_container">
            <form  method="post" enctype="multipart/form-data">

                <div class="col-md-6">
                <fieldset class="form-group">
                    <label>Old Password</label>
                    <div>
						<input type="password" id="opass" class="form-control" name="opass" value="" />
                    </div>
                </fieldset>
                </div>

                <div class="col-md-6">
                <fieldset class="form-group">
                    <label>New Password</span></label>
                    <div>
						<input type="password" id="npass" class="form-control" name="npass" value="" />
                    </div>
                </fieldset>
                </div>

                <div class="col-md-6">
                <fieldset class="form-group">
                    <label>Confirm New Password</label>
                    <div>
						<input type="password" id="cpass" name="cpass" class="form-control" value="" />
                    </div>
                </fieldset>
                </div>

                <div class="col-md-12">
                <button type="submit" class="btn bg-success pull-right" name="subchgps" ><i class="icon-reset position-left"></i> Change Password
                </button> 
                </div>
                
            </form>

        <div class="clear"></div>
        </div>
</div>
