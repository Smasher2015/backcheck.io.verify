<div class="logo">	
   <a href="<?php echo SURL; ?>">
   		<img src="img/logo.png"  />
   </a>
    <h4 class="info">Verification Management and Information System</h4>
    <div class="clear"></div>
</div>
<div class="header">
   <div class="bottom">
   <?php if(isset($_SESSION['user_id'])){?>
   <div class="sbld" style="margin-left:10px; float:left;" >
        Welcome: <?php echo $UNAME; ?>
        <span>[ <?php include("include_pages/timer_inc.php"); ?> ]</span>
   </div>	
   <?php } ?>
   <div class="hld">
        <span class="sbld">
        <?php if(!isset($_SESSION['user_id'])){?>
            <a href="?action=login" onclick="return showAjax('login','User Login','action=login',430,300)">Login</a> |
            <a href="?action=register" onclick="return showAjax('register','User Register','action=register',430)">Register</a>
         <?php }else{ ?>
            <a href="?action=logout" >Logout</a>         
		 <?php } ?>
        </span>
    </div>
   </div>
   <div class="clear"></div>
</div>