
<script>
$(document).ready(function(){
	 $("#searcha").on( "keypress", function(event) {
    if (event.which == 13 && !event.shiftKey) {
        event.preventDefault();
		if($('#searcha').val()==""){
		$('#searcha').css('border','1px solid #ff0000');
		return false;
	}else{
		 $("#validateSearchform").submit();
		return true;
	}
       
    }
    });
});

$(document).ready(function(){

 $("#validateSearch").submit(function(e){
	
	if($('#search').val()==""){
		$('#search').css('border','1px solid #ff0000');
		return false;
	}else{
		$('#search').css('border','');
		return true;
	}
	
});
});

//$(document).ready( function(){
//	
//	$( "#sweet_basic" ).click(function() {
//	
//		$( "#sweet_basic_s" ).toggle('drop', {direction: 'up'}, 150 );
//});
//	$( "#canecl" ).click(function() {
//	
//				$( "#sweet_basic_s" ).hide('drop', {direction: 'up'}, 150 );
//});
//
//});
</script>
<script type="text/javascript">
$(function() {

    // Toggle animations
    $("body").on("click", ".velocity-transition", function (e) {

        // Get animation class from "data" attribute
        var animation = $(this).data("animation");

        // Apply animation once per click
        $(".dropdown-content").addClass("animated " + animation).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
            $(".dropdown-content").removeClass("animated " + animation);
        });
        e.preventDefault();
    });

});

</script>
<style>
	#sweet_basic_s{width: 430px;
    z-index: 20000;
    margin-top: 7px;margin-left: 7px;}
	#sweet_basic_s input{width: 100%;
    height: 30px;
    border: 1px solid #ddd;
    font-size: 13px;
    color: #333;
    border-radius: 76px;
    padding-left: 12px;
    background: #f3f3e7;}
	#sweet_basic_s input:focus{background:#fff;}
	#sweet_basic_s button{position: absolute;
    top: 14px;
    right: 7px;
    background: none;
    border: none;
    color: #999;
    font-size: 9px;}
	#sweet_basic_s button i{font-size: 13px;}
	
	@-webkit-keyframes flipInY{from{-webkit-transform:perspective(400px) rotate3d(0,1,0,90deg);transform:perspective(400px) rotate3d(0,1,0,90deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in;opacity:0}40%{-webkit-transform:perspective(400px) rotate3d(0,1,0,-20deg);transform:perspective(400px) rotate3d(0,1,0,-20deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}60%{-webkit-transform:perspective(400px) rotate3d(0,1,0,10deg);transform:perspective(400px) rotate3d(0,1,0,10deg);opacity:1}80%{-webkit-transform:perspective(400px) rotate3d(0,1,0,-5deg);transform:perspective(400px) rotate3d(0,1,0,-5deg)}100%{-webkit-transform:perspective(400px);transform:perspective(400px)}}@keyframes flipInY{from{-webkit-transform:perspective(400px) rotate3d(0,1,0,90deg);transform:perspective(400px) rotate3d(0,1,0,90deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in;opacity:0}40%{-webkit-transform:perspective(400px) rotate3d(0,1,0,-20deg);transform:perspective(400px) rotate3d(0,1,0,-20deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}60%{-webkit-transform:perspective(400px) rotate3d(0,1,0,10deg);transform:perspective(400px) rotate3d(0,1,0,10deg);opacity:1}80%{-webkit-transform:perspective(400px) rotate3d(0,1,0,-5deg);transform:perspective(400px) rotate3d(0,1,0,-5deg)}100%{-webkit-transform:perspective(400px);transform:perspective(400px)}} .flipInY{-webkit-backface-visibility:visible!important;backface-visibility:visible!important;-webkit-animation-name:flipInY;animation-name:flipInY}
	
</style>
       
<div class="navbar navbar-default header-highlight top-header">
	
        <div class="navbar-header">
			<a class="navbar-brand" href="?action=dashboard"><img src="images/backcheckionew.png" alt="Back Check"></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>
        
     <!--   <div class="col-md-3">
        	<a href="?action=dashboard"><img src="images/rdlogo_active.png" alt="Risk Discovered" class="rd-client-logo"></a>
        </div>-->
        
        <div class="navbar-collapse collapse" id="navbar-mobile">
        	<ul class="nav navbar-nav">
            	<li><a class="sidebar-control sidebar-main-toggle hidden-xs" data-popup="tooltip" title="Menu"><i class="icon-paragraph-justify3"></i></a></li>
                 <li>
                <div id="sweet_basic_s">
                <?php 
				if($LEVEL == 5 || $LEVEL == 4 || $LEVEL == 3 || $LEVEL == 2){ ?>
                                    <?php if($LEVEL != 5){ ?>
                <form action="?action=search&atype=record" method="POST"  id="validateSearchform">
                <input type="text" name="search" id="searcha" placeholder="Search by <?php echo CLIENT_REF_NUM;?> or <?php echo ID_CARD_NUM;?> or Name" value="<?php echo $_REQUEST['search']; ?>">
                	<button type="submit" id="canecl"><i class="icon-search4"></i></button>
                </form>
                <?php } ?>
    
        <?php }?> </div>
                 
                </li>
            
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
            	<?php if($LEVEL == 4){ 
				$data = client_checks_info("as_sent=4 AND as_cdnld=0 AND as_status='Close' AND as_qastatus = 'Approved'","LIMIT 10"); 
				$alldata = client_checks_info("as_sent=4 AND as_cdnld=0 AND as_status='Close' AND as_qastatus = 'Approved'",""); 
				 ?>
            <li class="dropdown">
			
					<a href="#" class="dropdown-toggle velocity-transition top-header-ico" data-animation="fadeIn" data-toggle="dropdown" data-popup="tooltip" title="Downloads" data-placement="bottom" data-container="" data-trigger="hover">
						<i class="icon-file-download2"></i>
						<span class="visible-xs-inline-block position-right">Completed Checks</span>
						<span class="badge bg-red"><?php if(@mysql_num_rows($alldata)>10){ echo '10+'; } else { echo @mysql_num_rows($alldata); }?></span>
					</a>
					
					<div class="dropdown-menu dropdown-content">
						<div class="dropdown-content-heading">
							Completed Checks
							
						</div>
						<ul class="media-list dropdown-content-body width-350">
                                <?php
							
								
								
								//echo $addFilter;
								
								
								if($data){
									  while($row = mysql_fetch_assoc($data)){
										$pdfClick = "downloadPDF('pdf.php?pg=case&ascase=$row[as_id]')";
									    $pdfClickFullCase = "downloadPDF('pdf.php?pg=case&case=$row[v_id]')";
											?>
                                            
                                            
                                                                        
                                            <li class="media">
												<div class="media-left">
									<a href="<?php echo SURL;?>?action=details&case=<?=$row['v_id']?>&_pid=81" class="" data-popup="tooltip" data-placement="bottom" data-container="" data-trigger="hover" target="_blank" title="View Details"><img src="<?=$row['thum']?>" alt="<?=$row['v_name']?>" class="img-circle img-sm"></a>
								</div>
                                            
                                                <div class="media-body">
                                                    <span class="media-heading">
                                                    
                                                    <span class="text-semibold" title="Check: <?=convertUCWords($row['checks_title'])?>" data-popup="tooltip" data-placement="bottom" data-container="" data-trigger="hover">
                                                        <?=$row['v_name']?>
                                                    </span>
                                                    <span class="media-annotation pull-right">
                                                      <?php echo dateTimeExe($row['as_stdate']);?>
                                                     <?php //echo time_ago(strtotime($row['as_stdate']))?>
                                                    </span>
                                                    
                                                    </span>
                                                    <span class="">
													<small class="text-grey"><?=convertUCWords($row['checks_title'])?></small>
                                                     <span class="pull-right"><a class="" title="Download Single Check Report" data-popup="tooltip" href="javascript:;" onclick="<?=$pdfClick?>" data-placement="bottom" data-container="" data-trigger="hover"><i class="icon-download4 text-success"></i></a>
													 <?php if($row['v_status']=='Close'){
													
													?>
			  
			  										&nbsp;&nbsp;&nbsp;<a title="Download Complete Case Report" data-popup="tooltip" href="javascript:;"  onclick="<?=$pdfClickFullCase?>" data-placement="bottom" data-container="" data-trigger="hover"><i class="icon-download4 text-red"></i></a></span>
													 <?php } ?>
                                                </span>
                                                    
                                                    
                                                </div>
                                                
                                            </li>
                                <?php }
								}else { ?>
								<li class="list-group-item">No record available !</li>
								<?php } ?>
                            </ul>

						

						<div class="dropdown-content-footer">
							<a href="<?php echo SURL.'?action=readyfordownload&atype=checks';?>" data-popup="tooltip" title="Completed Checks"><i class="icon-menu display-block"></i></a>
						</div>
					</div>
				</li>
                <?php } if($LEVEL != 5){ // not for applicant  ?>
             <li class="dropdown">
					<a href="#" class="dropdown-toggle velocity-transition top-header-ico" data-animation="fadeIn" data-toggle="dropdown" data-popup="tooltip" title="Notifications" data-placement="bottom" data-container="" data-trigger="hover">
						<i class="icon-bell2"></i>
						<span class="visible-xs-inline-block position-right">Notification</span>
					</a>
					
					<div class="dropdown-menu dropdown-content">
						<div class="dropdown-content-heading">
							Notification
							
						</div>

						<ul class="media-list dropdown-content-body width-350">
	  <?php 
	 
	  $notifications = get_notifications("a_type='notification'  AND ","LIMIT 5"); 
 	  		if($notifications){
	  			while($notify = mysql_fetch_assoc($notifications)){
					
					$user_info=getUserInfo($notify['user_id']);
					$userName = $user_info['first_name']." ".$user_info['last_name'];
					
					?>
                            
                            <li class="media">
								<div class="media-left">
									<a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
								</div>

								<div class="media-body"><a href="#"><?=$userName?></a> <?=$notify['a_info']?>
									<div class="media-annotation"><?=time_ago(strtotime($notify['a_date']))?></div>
								</div>
							</li>
                            <?php 	}
	  		}?>							

						</ul>

						<div class="dropdown-content-footer">
							<a href="#" data-popup="tooltip" title="All activity"><i class="icon-menu display-block"></i></a>
						</div>
					</div>
				</li>
                
                <li class="dropdown">
					<a href="#" class="dropdown-toggle velocity-transition top-header-ico" data-animation="fadeIn" data-toggle="dropdown" data-popup="tooltip" title="Announcement" data-placement="bottom" data-container="" data-trigger="hover">
						<i class="icon-megaphone"></i>
						<span class="visible-xs-inline-block position-right">Announcement</span>
                        <?php $postfields["action"] = "getannouncements";
						$postfields["limitstart"] = "0";
						$postfields["limitnum"] = "4";
						$URL= WHMCS_APIURL;
						
						$xml=whmcs_api($URL,$postfields);
						$arr=whmcsapi_xml_parser($xml);  ?>
						<span class="badge bg-red"><?=$arr['WHMCSAPI']['TOTALRESULTS']?></span>
					</a>
					
					<div class="dropdown-menu dropdown-content">
						<div class="dropdown-content-heading">
							Announcement
							
						</div>

						<ul class="media-list dropdown-content-body width-350">
	 						<?php
							
							$announcements=$arr['WHMCSAPI']['ANNOUNCEMENTS'];
						if($arr['WHMCSAPI']['TOTALRESULTS']>0){
						foreach($announcements as $val){ 
						$time_diff = time_ago(strtotime($val['DATE']));
							?>
                            <li class="media">
								<div class="media-left">
									<a href="https://backcheckgroup.com/support/announcements.php?id=<?=$val['ID']?>" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
								</div>

								<div class="media-body"><a target="_blank" href="https://backcheckgroup.com/support/announcements.php?id=<?=$val['ID']?>"><?=$val['TITLE']?></a> <br /><?=strip_tags($val['ANNOUNCEMENT'])?>
									<div class="media-annotation"><?=$time_diff?></div>
								</div>
							</li>
                          <?php }} ?>

						</ul>

						<div class="dropdown-content-footer">
							<a href="<?=SITE_URL?>?action=announcements&atype=view" data-popup="tooltip" title="All Announcements"><i class="icon-menu display-block"></i></a>
						</div>
					</div>
				</li>

            
          <?php /*?>  <?php
            if($COMINF['account_type']==1 && $LEVEL==4){?>
                            <li>
                            <a href="#" class="dropdown-toggle animation" data-animation="flipInX" data-toggle="dropdown" title="Messages" style="padding-top: 6px;
    padding-bottom: 0;">
                                    <span class="btn bg-warning-800 btn-labeled btn-rounded btn-xs"><b><i class=" icon-cart5"></i></b> <span class="">
									<?php echo (getCredits());?></span></span>
                                </a>
                        	</li>
                            
                        <?php } ?><?php */?>
            
    					
                            
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle velocity-transition top-header-ico" data-animation="fadeIn" data-toggle="dropdown" data-popup="tooltip" title="Message" data-placement="bottom" data-container="" data-trigger="hover">
                                <i class="icon-bubbles4"></i>
                                <span class="visible-xs-inline-block position-right">Messages</span>
                            </a>
                            
                            <div class="dropdown-menu dropdown-content width-350">
                                <div class="dropdown-content-heading">
                                    Messages
                                    <ul class="icons-list">
                                        <li><a href="#"><i class="icon-compose"></i></a></li>
                                    </ul>
                                </div>
        
                                <ul class="media-list dropdown-content-body">
                                    
                                    <?php 
	
	  $messages = get_messages("com_type='case' AND","LIMIT 5"); 
 	  		if($messages){
	  			while($message = mysql_fetch_assoc($messages)){
					if(trim($message['uimg'])=='') $message['uimg'] = "images/default.png";?>
                                    
                                    <li class="media" onclick="goto_case(<?=$message['v_id']?>,true)">
                                        <div class="media-left">
                                            <img src="<?=$message['uimg']?>" title="<?="$message[first_name] $message[last_name]"?>" class="img-circle img-sm" alt="">
                                        </div>
        
                                        <div class="media-body">
                                            <a href="javascript:;" class="media-heading">
                                                <span class="text-semibold"><?=$message['com_title']?></span>
                                                <span class="media-annotation pull-right"><?=time_ago(strtotime($message['com_date']))?></span>
                                            </a>
        
                                            <span class="text-muted"><?=$message['com_text']?></span>
                                        </div>
                                    </li>
                                    
                                    <?php 	}
	  		}?>
        
                                    
                                </ul>
        
                                <div class="dropdown-content-footer">
                                    <a href="#" data-popup="tooltip" title="All messages" data-placement="bottom" ><i class="icon-menu display-block"></i></a>
                                </div>
                            </div>
                        </li>
				<?php } // not for applicant ?>
                    <li class="dropdown dropdown-user">
                    
		<?php 
			$logo = getlogo();
			
		?>

                        <a class="dropdown-toggle" href="?action=edit&atype=profile" data-toggle="dropdown" title="<?=($LEVEL == 4 || $LEVEL == 5)?$COMINF['name']:'BCG';?>">
                            <img src="<?php echo $logo;?>" alt="<?=($LEVEL == 4 || $LEVEL == 5)?$COMINF['name']:'BCG';?>" data-popup="tooltip" title="" data-placement="bottom" data-container="" data-trigger="hover" data-original-title="<?=($LEVEL == 4 || $LEVEL == 5)?$COMINF['name']:'BCG';?>" aria-expanded="true" >
                            <span><?php  echo ucfirst($_SESSION['first_name'])." ";?>
                            <small class="label bg-success" style="margin-left: 5px;"><?php 
						// team lead 12 level id
						if($LEVEL_TL==12) $lev = getLevel($LEVEL_TL); else $lev = getLevel($LEVEL);
						
						echo " ".$lev['level_name'];
						if($LEVEL == 4){ ?>
                       
                        
                       <?php }?>
                       </small>
                            </span>
                            <i class="caret"></i>
                        </a>
    
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="?action=profile&atype=view"><i class="icon-user-tie"></i> My profile</a></li>
						<?php 
                        
                        
                        if($COMINF['account_type']==1 && $LEVEL==4){?>
                            <li>
                            <a href="javascript:;"><i class="icon-cart5"></i> My Bucket <span class="badge bg-warning-400"><?php echo (getCredits());?></span></a>
                            </li>
                        <?php } ?>

                            <li><a href="javascript:;" onclick="window.location='?action=logout';"><i class="icon-switch2"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            
            
        </div>
        
		 
    </div>
    <?php if($LEVEL == 4){ ?>
<!-- Floating menu -->
		<ul class="fab-menu fab-menu-top-right" data-fab-toggle="click">
			<li>
				<a class="fab-menu-btn btn bg-success btn-float btn-rounded btn-icon">
					<i class="fab-icon-open icon-plus3"></i>
					<i class="fab-icon-close icon-cross2"></i>
				</a>

				<ul class="fab-menu-inner">
					<li>
						<div data-fab-label="Bulk upload">
							<a href="?action=advanced_bulk&atype=upload" class="btn btn-default btn-rounded btn-icon btn-float">
								<i class="icon-database-upload"></i>
							</a>
						</div>
					</li>
					<li>
						<div data-fab-label="Add applicant">
							<a href="?action=add&atype=newcase" class="btn btn-default btn-rounded btn-icon btn-float">
								<i class="icon-user-plus"></i>
							</a>
							<!--<span class="badge bg-primary-400">5</span>-->
						</div>
					</li>
					<li>
						<div data-fab-label="Invite applicant">
							<a href="?action=addapplicant&atype=applicant" class="btn bg-pink-400 btn-rounded btn-icon btn-float">
								<i class="icon-user"></i>
							</a>
						</div>
					</li>
				</ul>
			</li>
		</ul>
		<!-- /floating menu -->
<?php
	}
?>

    
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
  
  <?php /*?><nav class="user-menu"> <a href="javascript:;" class="main-menu-access"> <i class="icon-proton-logo"></i> <i class="icon-reorder"></i> </a>
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
</nav><?php */ ?>
</div>
	 <!-- Page container -->

<?php  if($browser_name=='msie' && $browser_version<=8){?>
  <div class="alert bg-danger alert-styled-left">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Alert!</span> Please Update your browser version this is not compatible with our site. <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie" class="alert-link">Click Here</a> to download a new version of IE.
  </div>

<?php } if($LEVEL==4 && $COMINF['can_download_reports']==1){?>
  <div class="alert bg-danger alert-styled-left">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Your report download feature is disabled due to non payment!</span> Please contact our <a href="?action=adsupport&atype=support" class="alert-link">Support</a> team.
  </div>

<?php } ?>

	<div class="page-container">



		<!-- Page content -->

		<div class="page-content">
		<?php include('include_pages/navigation_main.php'); ?>
<div class="content-wrapper" style="display:inline-block; padding-bottom:0;" id="main_container">

<?php include('include_pages/navigation.php');?>
  

</div>
 

<div class="clear"></div>

<div class="modal fade" id="openticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New Open Ticket</h4>
      </div>
      <div class="modal-body">
        <form method="post">
           <div class="form-group">
            <label for="message-text" class="control-label">Subject:</label>
            <input type="text" class="form-control" name="ticketsubject" id="message-text" /> 
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Priority:</label>
            
            <select name="inputpriority" id="inputpriority" class="form-control">
                <option value="High">
                    High
                </option>
                <option value="Medium" selected="selected">
                    Medium
                </option>
                <option value="Low">
                    Low
                </option>
            </select>            
            
            
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" name="ticketmessage" id="message-text"></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="submitopenticket" class="btn btn-primary" value="Open Ticket"> 
      </div>
        </form>
         
      </div>
     
    </div>
  </div>
</div>