<div class="flat_area grid_16">
    <h2>Step by Step <?=$PTITLE?></h2>
</div>
<?php  $_POST['step'] = (isset($_POST['step']))?$_POST['step']:1; ?>                  
<div class="box grid_16">
    <h2 class="box_head"><?=$PTITLE?></h2>
    <a href="#" class="grabber">&nbsp;</a>
    <a href="#" class="toggle">&nbsp;</a>
    <div class="toggle_container">
        <div class="wizard">
        <div class="wizard_progressbar ui-progressbar ui-widget ui-widget-content ui-corner-all" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="100">
        	<div class="ui-progressbar-value ui-widget-header ui-corner-left ui-corner-right" style="width:<?=($_POST['step']*25)?>%;"></div>
        </div>
        
            <div class="wizard_steps">
                <ul class="clearfix">
                    <li <?=($_POST['step']==1)?'class="current"':''?>>
                        <a href="" class="clearfix">
                            <span>1. <strong>Package</strong></span>
                            <small>Select your package</small>
                        </a>
                    </li>
                    <li <?=($_POST['step']==2)?'class="current"':''?>>
                        <a href="#step_2" class="clearfix">
                            <span>2. <strong>Information</strong></span>
                            <small>Information Provider</small>
                        </a>
                    </li>
                    <li <?=($_POST['step']==3)?'class="current"':''?>>
                        <a href="#step_3" class="clearfix">
                            <span>3. <strong>Provide Information</strong></span>
                            <small>Provide Information</small>
                        </a>
                    </li>
                    <li <?=($_POST['step']==4)?'class="current"':''?>>
                        <a href="#step_4" class="clearfix">
                            <span>4. <strong>Finish</strong></span>
                            <small>Confirm and complete</small>
                        </a>
                    </li>
                </ul>		
            </div>
							
			<div class="wizard_content">
<form name="pkgfrm" method="post" enctype="multipart/form-data" <?=(isset($SUSER)?(!in_array(1,$RIGHTS)?'class="exit" onsubmit="return noAccess()"':''):'')?> >

<?php if($_POST['step']==1){?>
        <div id="step_1" class="step block" style="display:block;">
            <h1 class="section">1. Packages</h1>
        
            <fieldset class="label_side">
                <label>Select Package<span>Please Select Your Package</span></label>
                <div>
                    <select name="pkg" onchange="getChecks(this.value)" class="select_box req title"  title="Select Any Package">
                    	<option value="" >---Select Package---</option>
                    	<?php
                            $packages=$db->select("packages","*","(pkg_type=0 OR (user_id=$_SESSION[user_id] AND is_active=1)) AND a_active=1");
                             while($package=mysql_fetch_array($packages)){ ?>
                    			<option value="<?=$package['pkg_id']?>" <?=($package['pkg_id']==$_REQUEST['pkg'])?'selected="selected"':''?>>
									<?=$package['pk_name']?>
                                </option>
                    	<?php }?>
                    </select>                 
                   <div id="crpkg" style="margin-top:10px;">
                    	<span>OR</span>
                        <a style="margin-left:10px;" href="?action=package&atype=request" >Request a Package</a>
                   </div>
                    <div id="showChecks" style="margin-top:10px;">
                    		<?php if(is_numeric($_REQUEST['pkg'])){?>
                            	<?php include("include_pages/getchecks_inc.php"); ?>
                            <?php }?>
                    </div>
                </div>
            </fieldset>
        </div>
<?php } ?>

<?php if($_POST['step']==2){?>
        <div id="step_2" class="step block" style="display:block">
            <h1 class="section">2. Information</h1>
            <h2 class="section">Package Name: 
            <?php $pckg_1=$db->select("packages","pk_name","pkg_id=$_POST[pkg]");
                  $pckg_name=mysql_fetch_array($pckg_1);
                  echo $pckg_name['pk_name'];
            ?>
            </h2>
            <div style="margin:20px;">        
                <?php include('include_pages/getchecks_inc.php'); ?>
            </div>         
            
        <fieldset class="label_side">
            <label>Upload Information<span>Please Checkout, Who will Upload the Information</span></label>
            <div>
                <div>
                	<?php $_POST['type_data'] = (isset($_POST['type_data']))?$_POST['type_data']:1;?>
                	<input type="radio" name="type_data" id="type_data1" <?=($_POST['type_data']==1)?'checked="checked"':''?> value="1">
                	<label for="type_data1" >Applicant will upload data</label>
                </div>
                <div>
                	<input type="radio"  name="type_data" id="type_data2" <?=($_POST['type_data']==2)?'checked="checked"':''?> value="2">
                	<label for="type_data2" >Upload data you self</label>
                 </div>
                <div>
                	<input type="radio"  name="type_data" id="type_data3" <?=($_POST['type_data']==3)?'checked="checked"':''?> value="3">
                    <label for="type_data3" >Upload bulk records</label>
                </div>
            </div>
        </fieldset>
        
        </div>		
<?php }?>

<?php if($_POST['step']==3){?>
        <div id="step_3" class="step block" style="display:block">
            <h1 class="section">3. Provide Information</h1>
            <h2 class="section">Package Name: 
            <?php $pckg_1=$db->select("packages","pk_name","pkg_id=$_POST[pkg]");
                  $pckg_name=mysql_fetch_array($pckg_1);
                  echo $pckg_name['pk_name'];
            ?>
            </h2>
            <div style="margin:20px;">        
                <?php include('include_pages/getchecks_inc.php');?>
            </div>         

	<?php if($_POST['type_data']==1){?>
            <div id="apList">
			<?php include("include_pages/applicantinfo_inc.php");?>
            </div>
            <input type="hidden" name="uoptn" value="applicant"/>
	<?php } ?>
                    
	<?php if($_POST['type_data']==2){?>
                <fieldset class="label_side">
                    <label for="required_field">Name<span>Please Input Applicant Name</span></label>
                    <div>
                    <input type="text"  name="v_name" id="v_name" class="req text title" title="Input Applicant Name" >
                    </div>
                </fieldset>
                <!--<fieldset class="label_side">
                    <label  for="required_field">Email<span>Please Input Applicant Email</span></label>
                    <div>
                    <input type="text" name="v_email"  id="v_email" class="required text">
                    </div>
                </fieldset>-->
                <fieldset class="label_side">
                    <label >Father's Name<span>Please Input Applicant Father's Name</span></label>
                    <div>
                    <input type="text" name="v_ftname" id="v_ftname" class="req text title" title="Input Applicant Applicant Fathers Name">
                    </div>
                </fieldset>
                <fieldset class="label_side">
                    <label for="required_field">NIC No:<span>Please Input Applicant NIC</span></label>
                    <div>
                    <input type="text" name="v_nic" id="v_nic" class="req text title" title="Input Applicant NIC">
                    </div>
                </fieldset>
            
                <!--<fieldset class="label_side">
                    <label for="required_field">Address:<span>Please Input Applicant Address</span></label>
                    <div>
                    <input type="text" name="address" id="address" class="required text">
                    </div>
                </fieldset>-->
                <fieldset class="label_side">
                    <label for="required_field">Date Of Birth:<span>Please Input Date of Birth</span></label>
                    <div>
                    <input type="text" name="v_dob" id="v_dob" class="datepicker req text title" title="Input Date of Birth" readonly="readonly">
                    </div>
                </fieldset>
                <!--<fieldset class="label_side">
                    <label for="required_field">Email To Applicant:<span>Do You Want to send an Email to Applicant</span></label>
                    <div>
                    <input type="radio" name="notify" checked="checked" value="1"> Yes
                    &nbsp;&nbsp;&nbsp;
                    <input type="radio"  name="notify" value="2"> No
                     &nbsp;&nbsp;&nbsp;
                    </div>
                </fieldset>-->
                <input type="hidden" name="uoptn" value="upload"/>
	<?php } ?>
            
	<?php if($_POST['type_data']==3){?>
                <fieldset class="label_side" >
                    <label  for="required_field">Upload Zip File<span>Label placed beside the Input</span></label>
                    <div >
                        <input type="file" name="bulkfile" style="opacity: 0;"  size="21" id="fileupload" class="uniform">
                    </div>
                </fieldset>
                <input type="hidden" name="uoptn" value="bulk"/>
	<?php } ?>
            </div>
            <input type="hidden" name="type_data" value="<?=$_POST['type_data']?>"/>
     <?php }?>
     
<?php if($_POST['step']==4){?>
        <div id="step_4" class="step block" style="display:block">
            <h1 class="section">Thanks</h1>

        <div class="section">
            <P>Thanks For Using Application</P>
        </div>
        <div class="button_bar clearfix">
        	<input type="hidden" name="type_data" value="<?=$_POST['type_data']?>"/>
        </div>
	</div>
         <?php }?>
         
            <div class="button_bar clearfix">
            	<?php if(isset($_POST['pkg'])){ ?>
					<input type="hidden" name="pkg" value="<?=$_POST['pkg']?>"/>
                <?php } ?>
                <?php  if($_POST['step']>1){?>   
                	<input type="hidden" name="step" value="<?=($_POST['step']-1)?>"/>
                    <button onclick="pervFn()" class="next_step move light img_icon has_text" name="pervious">
                        <img width="24" height="24" src="images/icons/small/grey/bended_arrow_left.png" alt="Bended Arrow Right">
                        <span>Prev Step</span>
                    </button>
                <?php }?>
                    <button <?=($_POST['step']==4)?'onclick="finishInf()"':''?> type="submit" name="caseWizard" value="Next Step" class="next_step move send_right">
                        <img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/bended_arrow_right.png">
                        <span>
							<?=($_POST['step']==4)?'Finish':'Next Step'?>
                        </span>
                    </button>
            </div>
</form>
							</div>										
						</div>
				  </div>
  </div>
	<script type="text/javascript" >
		function finishInf(){
				document.forms['pkgfrm'].onsubmit = function (){return false;}
				window.location = "?action=manage&atype=applications";
		}
		
        function pervFn(){
                document.forms['pkgfrm'].onsubmit = function (){return true;}		
        }
    </script>
<script type="text/javascript" src="scripts/adminica/adminica_wizard.js"></script>