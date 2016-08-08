<div id="topbar" class="clearfix">
	
	<a href="?action=dashboard" class="logo"></a>
	<?php if(isset($_SESSION['user_id'])){ ?>
	<div class="user_box dark_box clearfix">
		<img src="images/profile.jpg" width="55" alt="Profile Pic" />
		<h2>Administrator</h2>
		<h3><a class="text_shadow" href="#">John Smith</a></h3>
		<ul>
			<li><a href="#">profile</a><span class="divider">|</span></li>
			<li><a href="#">settings</a><span class="divider">|</span></li>
			<li><a href="?action=logout">logout</a></li>
		</ul>
	</div><!-- #user_box -->
    <?php } ?>	
</div><!-- #topbar -->