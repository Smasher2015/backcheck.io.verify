<div id="nav_top" class="clearfix round_top">
	<ul class="clearfix">
		<li class="<?=($action=='dashboard')?'current':''?>">
        	<a href="?action=dashboard">
            <img src="images/icons/small/grey/laptop.png"/></a>
        </li>
<?php if(isset($_SESSION['user_id'])){ ?>
		<li class="<?php if($action=='reports') echo 'current';else echo'';?> has_dropdown">
       
        	<a href="?action=reports&atype=order">
            	<img src="images/icons/small/grey/documents.png"/>
                <span>Order Reports</span>
            </a>
            <ul class="dropdown">
				<li><a href="?action=reports&atype=order"><span>Ordering a new case</span></a></li>
				<li><a href="action=reports&atype=order"><span>Bulk Ordering</span></a></li>				
				<li><a href="?action=order&atype=certificate"><span>Order Certificates</span></a></li>
			</ul>
       </li>       
		
		<li class="<?php if($action=='manage') echo 'current';else echo'';?>">
        	<a href="?action=manage&atype=applicants">
            	<img src="images/icons/small/grey/users.png"/>
                <span>Manage Applicants</span>
            </a>
       </li> 
       
       
		<li class="<?=($action=='sub')?'current':''?>">
        	<a href="?action=sub&atype=users">
            	<img src="images/icons/small/grey/users.png"/>
                <span>Manage Sub Users</span>
            </a>
       </li>        
       
		<li class="<?=($action=='my')?'current':''?>">
        	<a href="?action=my&atype=account">
            	<img src="images/icons/small/grey/file_cabinet.png"/>
                <span>My Account</span>
            </a>
       </li> 
       <li>
       		<a href="?action=logout" >
       			<img src="images/icons/small/grey/locked_2.png"/>
            </a>
      </li>
           
<?php }else{ ?>           
		<li class="">
        	<a href="?action=contactus">
            	<img src="images/icons/small/grey/users.png"/>
                <span>Contact Us</span>
            </a>
       </li>  
<?php } ?>
	</ul>
	<?php include 'includes/dialog_logout.php'?>		

	
	
<script type="text/javascript">
	
	var currentPage = <?php echo $keyphrase ?> - 1; // This is only used in php to tell the nav what the current page is
	$('#nav_top > ul > li').eq(currentPage).addClass("current");
	$('#nav_top > ul > li').addClass("icon_only").children("a").children("span").parent().parent().removeClass("icon_only");
</script>

	
	<div id="mobile_nav">
		<div class="main"></div>
		<div class="side"></div>
	</div>
	
</div><!-- #nav_top -->
