<div id="nav_top" class="clearfix round_top">
	<ul class="clearfix">
		<li><a href="?action=dashboard"><img src="images/icons/small/grey/laptop.png"/></a></li>

		<li>
        	<a href="?action=close&atype=ready">
            	<img src="images/icons/small/grey/month_calendar.png"/>
                <span>Download Now</span><span class="alert badge alert_blue"><?=$redyecas?></span>
            </a>
       </li>
       
		<li>
        	<a href="?action=wip&atype=cases">
            	<img src="images/icons/small/grey/month_calendar.png"/>
                <span>In Progress</span><span class="alert badge alert_blue"><?=$wipcas?></span>
            </a>
       </li>       
		
		<li>
        	<a href="?action=notyet&atype=cases">
            	<img src="images/icons/small/grey/month_calendar.png"/>
                <span>Not Yet Started</span><span class="alert badge alert_blue"><?=$notyets?></span>
            </a>
       </li> 
       
		<li>
        	<a href="?action=attention&atype=cases">
            	<img src="images/icons/small/grey/month_calendar.png"/>
                <span>Need Attention</span><span class="alert badge alert_blue"><?=$nattent?></span>
            </a>
       </li> 
       
       <li>
            <a href="?action=alert&atype=cases">
                <img src="images/icons/small/grey/month_calendar.png"/>
                <span>Be Alert</span><span class="alert badge alert_blue"><?=$balrte?></span>
            </a>
       </li>       
               
       <li>
            <a href="?action=close&atype=archived">
                <img src="images/icons/small/grey/month_calendar.png"/>
                <span>Archived</span><span class="alert badge alert_blue"><?=$closecas?></span>
            </a>
       </li>                
               
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
