<section class="title-bar transp-header">
	<div class="row">
        <div class="col-md-3">
        	<a href="?action=dashboard"><img src="images/rdlogo_active.png" alt="Risk Discovered" class="rd-client-logo"></a>
        </div>
        <?php if($LEVEL == 4){ ?>
        <div class="col-md-4">
        	<div class="search_top">
				<form action="?action=search&atype=record" method="POST">
				<input type="search" name="search" placeholder="Type keyword">
                <button type="submit"><i class="icon-search"></i></button>    
				</form>
            </div>
        </div>
        
        <div class="col-md-3">
		<?php 
			$logo = getlogo();
		?>
        	<div class="client_logo">
            	<img src="<?php echo $logo;?>" alt="Client Logo">
            </div>
        </div>
        <?php }?>
	</div>
    
    
  <!--<div>  
    <span>DASHBOARD</span>--> 
    <!--<nav class="dashboard-menu">
                        <a href="javascript:;">
                            <i class="icon-cog toggle-widget-setup"></i>
                            <i class="menu-state-icon icon-sort-up"></i>
                            <i class="menu-state-icon icon-caret-down active"></i>
                        </a>
                        <ul>
                            
                            <li><a data-toggle="modal" href="#quickLaunchModal">Add Quick Launch Icon</a></li>
                            <li><a data-toggle="modal" href="#quickLaunchModal">Remove Quick Launch Icon</a></li>
                            <li><a href="javascript:;">Third Menu Item</a></li>
                        </ul>
                    </nav>
  </div>--> 
  
  <nav class="user-menu"> <a href="javascript:;" class="main-menu-access"> <i class="icon-proton-logo"></i> <i class="icon-reorder"></i> </a>
  <section class="user-menu-wrapper"> <a href="javascript:;" data-expand=".messages-view" class="messages-access"> <i class="icon-envelope-alt"></i> </a> <a href="javascript:;" data-expand=".notifications-view" class="notifications-access unread"> <i class="icon-comment-alt"></i>
   
    <!--<div class="menu-counter">6</div>-->
    </a> <a href="javascript:;"  onclick="window.location='?action=logout';"   class="" title="Signout"><i class="icon-signout" ></i>
   
    </a> </section>
  <div class="panel panel-default nav-view messages-view">
    <div class="arrow user-menu-arrow"></div>
    <div class="panel-heading"> <i class="icon-envelope-alt"></i> <span>Messages</span> <a href="javascript:;" class="close-user-menu"><i class="icon-remove"></i></a> </div>
    <ul class="list-group">
      <?php 
	
	  $messages = get_messages("com_type='case' AND","LIMIT 5"); 
 	  		if($messages){
	  			while($message = mysql_fetch_assoc($messages)){
					if(trim($message['uimg'])=='') $message['uimg'] = "images/default.png";?>
      				<li class="list-group-item" onclick="goto_case(<?=$message['v_id']?>,true)"> <i>
                    	<img src="<?=$message['uimg']?>" title="<?="$message[first_name] $message[last_name]"?>"></i>
        				<div class="text-holder"> 
                        <span class="title-text"><?=$message['com_title']?></span> 
                        <span class="description-text"><?=$message['com_text']?></span> 
                        </div>
        				<span class="time-ago">  <?=time_ago(strtotime($message['com_date']))?> </span> 
                   </li>
       <?php 	}
	  		}?>
    </ul>
  </div>
  <div class="panel panel-default nav-view notifications-view">
    <div class="arrow user-menu-arrow"></div>
    <div class="panel-heading"> <i class="icon-comment-alt"></i> <span>Notifications</span> <a href="javascript:;" class="close-user-menu"><i class="icon-remove"></i></a> </div>
    <ul class="list-group">
	
	  <?php 
	 
	  $notifications = get_notifications("a_type='notification'  AND ","LIMIT 5"); 
 	  		if($notifications){
	  			while($notify = mysql_fetch_assoc($notifications)){
					
					$user_info=getUserInfo($notify['user_id']);
					$userName = $user_info['first_name']." ".$user_info['last_name'];
					
					?>
					
					<li class="list-group-item"> <i  class="icon-info-sign"></i>
        <div class="text-holder"> <span class="title-text"><?=$userName?></span> <span class="description-text"><?=$notify['a_info']?></span> </div>
        <span class="time-ago"><?=time_ago(strtotime($notify['a_date']))?> </span> </li>
					
					
					
					
					
					
       <?php 	}
	  		}?>
	
      
		
		
		
    </ul>
  </div>
</nav>
  
</section>
