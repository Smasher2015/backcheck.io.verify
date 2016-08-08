<?php
$iinfo = $db->select("invitation","*","(inv_hash='$_REQUEST[invitation]')");
if(mysql_num_rows($iinfo)>0){
		$iinfo = mysql_fetch_assoc($iinfo);
		
		$user = $db->select("users","*","validation='$_REQUEST[invitation]' AND level_id=5");
		$uNum = mysql_num_rows($user);
		
		if($iinfo['inv_status']==1){
			$user = mysql_fetch_assoc($user);
			$is_active=$user['is_active'];
		}else{
			$is_active=0;
		}

		$comInf = $db->select("company","*","id=$iinfo[com_id]");
		$comInf = mysql_fetch_assoc($comInf); ?>
        
        <div class="flat_area grid_16">
            <h2><?=$comInf['pagetitle']?> <small><?=$comInf['pagesolgan']?></small></h2>
            <p><div style="float:left;"><img src="<?=$comInf['logo']?>" alt="Profile Pic" width="100" border="1" /></div>
            <?=$comInf['pagedesc']?></p>
            <div style=" clear:both;"></div>
        </div>
            												
<?php 	if($is_active==0){ ?>    
		<div class="box grid_16">
	<h2 class="box_head">Applicant Information</h2>
	<a href="#" class="grabber">&nbsp;</a>
	<a href="#" class="toggle">&nbsp;</a>
	<div class="block">
		 <h2 class="section">Personal Information for Verification</h2>
        <form class="validate_form" method="post">
            <fieldset class="label_side">
              <label for="v_name">Full Name</label>
                <div>
                    <input disabled="disabled" type="text" id="v_name" name="v_name" value="<?=$iinfo['name']?>" > 
                </div>
            </fieldset>
            <fieldset class="label_side">
              <label for="v_email">Email Address</label>
                <div>
                    <input disabled="disabled" type="text" id="v_email" name="v_email" value="<?=$iinfo['email']?>" > 
                </div>
            </fieldset>                            
        <?php if($uNum==0){?>    
            <fieldset class="label_side">
                <label for="required_textarea">Street Address</label>
                <div >
                    <textarea id="textarea" name="address" class="autogrow"><?=$_REQUEST['address']?></textarea>
                </div>
            </fieldset>    
            <div class="columns clearfix">
                <div class="col_50">
                    <fieldset>
                        <label for="passa">Password</label>
                        <div>
                            <input type="password" class="req title" title="Input Password" id="passa" name="passa" value="">
                        </div>
                   </fieldset>
                </div>
                <div class="col_50">
                    <fieldset>
                        <label for="passb">Confirm Password</label>
                        <div>
                            <input type="password" id="passb" class="req title" title="Input Confirm Password" name="passb" value="">
                        </div>
                   </fieldset>
                </div>
            </div>
        <?php }else{?>
            <div class="columns clearfix">
                <div class="col_50">
                    <fieldset>
                        <label for="v_ftname">Father's Name</label>
                        <div>
                            <input type="text" id="v_ftname" name="v_ftname" class="req title" title="Input Your Fathers Name" value="<?=$_REQUEST['v_ftname']?>">
                        </div>
                   </fieldset>
                </div>
                <div class="col_50">
                    <fieldset>
                        <label for="v_nic">N.I.C</label>
                        <div>
                          <input type="text" id="v_nic" size="40" name="v_nic" class="req title" title="Input Your NIC" value="<?=$_REQUEST['v_nic']?>">
                        </div>
                    </fieldset>
                </div>
                <div class="col_50">
                    <fieldset>
                      <label>Date of Birth</label>
                        <div>
                          <input type="text" class="datepicker req title" title="Input Your Date of Birth" name="v_dob" value="<?=$_REQUEST['v_dob']?>"> 
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="button_bar clearfix">
                <?php $_REQUEST['pkg'] = $iinfo['pkg_id'] ; include('include_pages/getchecks_inc.php');?> 
            </div>
        <?php } ?>
            <div class="button_bar clearfix">
                <button class="red send_right" type="submit" name="subinvitation">
                    <img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/grey/bended_arrow_right.png">
                    <span>Next Step</span>
                </button>
            </div>
        </form>
  </div>	
</div>
<?php }else{ ?>
		<div class="alert dismissible alert_red">
			<img height="24" width="24" src="images/icons/small/white/alert.png">
			You Already have Accepted the Invitation, And Process The Information
			<div class="clearfix"></div>
		</div>
<?php }
 }else{ ?>
	<div class="alert dismissible alert_red">
		<img height="24" width="24" src="images/icons/small/white/alert.png">
		Invalid Invitation Link !
		<div class="clearfix"></div>
	</div>
<?php }
?>
