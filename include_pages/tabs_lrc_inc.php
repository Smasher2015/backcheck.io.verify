<div id="lrcTabs">
	<a class="<?php if($_REQUEST['tab']=='login') echo 'current'; else echo 'normal';?>" href="javascript:void(0)" id="login" onclick="switchTabs(this)">Login</a>
    <a class="<?php if($_REQUEST['tab']=='register') echo 'current'; else echo 'normal';?>" href="javascript:void(0)" id="register" onclick="switchTabs(this)">Register</a>
    <a class="<?php if($_REQUEST['tab']=='contactus') echo 'current'; else echo 'normal';?>" href="javascript:void(0)" id="contactus" onclick="switchTabs(this)">Contact Us</a>
    <div class="clear"></div>
</div>
<div>
	<div id="lrclogin" style="display:<?php if($_REQUEST['tab']=='login') echo 'block'; else echo 'none';?>;">
		<?php include('include_pages/login_inc.php'); ?>
	</div>
    <div id="lrcregister" style="display:<?php if($_REQUEST['tab']=='register') echo 'block'; else echo 'none';?>;">
		<?php include('include_pages/register_inc.php');?>
	</div>
    <div id="lrccontactus" style="display:<?php if($_REQUEST['tab']=='contactus') echo 'block'; else echo 'none';?>;">
    	<?php include('include_pages/contactus_inc.php');?>
    </div>
</div>