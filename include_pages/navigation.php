<style type="text/css">
  @media (min-width: 768px) {
      ul#nav     { display: block; }
      select.dropdown { display: none; }
    }
  @media (max-width: 768px) {
      ul#nav, #validateSearch{ display: none; }
      select.dropdown { display: inline-block; width:90%; margin:auto; }
	  select.dropdown{ margin:10px; padding:5px; font-size:16px;}
    }
#hideImage {
	width:100px;
	height:120px;
	background:#000000;
	color:#ffffff;
}
.report-issue-text{
    position: fixed;
    z-index: 10000;
    margin-left: 93%;
    margin-top: 14%;
    transform: rotate(-90deg);
    transform-origin: left top 0;
    width: 175px;
    height: auto;
    text-align: center;
    font-size: 20px;
    color: #999999;
    background: #333333;
	padding:5px;
}
.report-issue-text i{
	margin-right:7px; 
}
</style>

<div class="modal fade" id="ReportIssue" role="dialog">
    <div class="modal-dialog">
    <form action="" name="" method="post" enctype="multipart/form-data">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
            <div class="form-group">
                <div class="alert alert-dismissable alert-info fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                   <i class="icon-info-sign" style="color:#a5c8e5;"></i>
                    We regret that you are facing problem in using <?php echo SITE_URL; ?>. Please let us know more details of the problem by using the form below.
                </div>
           </div>
           <input type="hidden" name="sp_title" value="operation">
           <div class="form-group">
                <textarea class="form-control parsley-validated" name="sp_description" rows="4" data-parsley-minwords="4" data-parsley-required="true" placeholder="Type details here"></textarea>
          </div>
       	 <div class="form-group">
       		 <p class="text-success">Automatic snapshot of current page will be attached with the current file, it will help us better understand your problem. You can add more snapshots by clicking the 'Attach Snapshot' button below.</p>
       	 </div>
         <div class="form-group">
            <label>Attach Snapshot</label>
            <div>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <span class="btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="sp_attachment" /></span>
                  <span class="fileinput-filename"></span>
                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                </div>
            </div>
        </div>
        	<div class="form-group">
        		<p class="text-info">(Only png.jpg.gif file allowed. File size up to 1Mb)</p>
		 	</div>
             <input type="hidden" name="sp_department" value="operation">
          <input type="hidden" name="img_val" id="img_val" value=""/>
          <label><input type="checkbox" checked="checked" id="img_chk" name="send_sim" value="1"> Attach auto snapshot.</label>
          	<div id="showImage">	
            	<img id="captured_img" src=""  height="120" width="100"/>
            </div>
            <div id="hideImage">	
            	<p>No Snap Shot</p>
            </div>
        </div>
        <div class="modal-footer">
        	<button type="submit" class="btn btn-default" name="addticket">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
<?php if(isset($_SESSION['user_id'])){ ?>   
 

<nav class="navbar navbar-inverse bg-info-400 navbar-xs no-padding nav-secon-head">
 <div>
  <div class="">
  	<div class="col-md-12">
  <ul id="nav" class="nav navbar-nav no-margin">
   
    <?php if($MENUS){
            foreach($MENUS as $menu){
                if($menu['m_lrb']==0 || $menu['m_lrb']==1){
				if($menu['m_include']!='#'){
						$aLink= "?action=$menu[m_action]".(($menu['m_atype']!='')?"&atype=$menu[m_atype]":"");
				}else 	$aLink="#";				
				if($menu['m_img']=='') $menu['m_img']='images/icons/small/grey/users.png';?>
    <li class="dropdown <?=($IPAGE['m_id']==$menu['m_id'])?'current':''?> pos-rel"> 
	<?php if(getSubMenus($menu['m_id'])){ $data_toggle = "data-toggle='dropdown'"; } else { $data_toggle = ""; } ?>
    		<a href="<?=$aLink?>" class="dropdown-toggle" <?php echo $data_toggle;?> aria-expanded="true" data-placement="bottom" title="<?="$menu[m_actitle] $menu[m_attitle]"?>" data-original-title="<?="$menu[m_actitle] $menu[m_attitle]"?>" data-popup="tooltip" data-trigger="hover" data-container="body" ><i class="<?=$menu['m_img']?>"></i>
               <span class="visible-xs-inline-block position-right">
			   
                  <?php echo "$menu[m_actitle] $menu[m_attitle]";?>
                </span> <?php if(getSubMenus($menu['m_id'])){ ?><span class="caret"></span><?php } ?>
      <?php if($menu['m_scnt']==1){
		 if($LEVEL==5){ 
		 	$uid = $_SESSION['user_id'];
			$applicant_where = ' and user_id = '.$uid;
		 }else{
			$applicant_where = ' ';
		}
		 ?>
      <?php ?>  <span class="badge bg-yellow">
        
          <?php  
		if($menu['m_action'] == 'applicantinsufficient')
		{
		echo countInsuff_applicant($COMINF['id'],$_SESSION['user_id']);
		 
		 }else if($menu['m_action'] == 'insufficient') {
		
		$com_id = ($LEVEL==4)?$COMINF['id']:1; // deaflut mobilink id
		echo countInsuffDocsByClient($com_id);
		  }else if($menu['m_action'] == 'cases' && $menu['m_atype'] == 'list') {
		
		echo "<span class='load-count'></span>";
		  }
         else
		  {  
	   
		 echo countChecks($menu['m_where'].$applicant_where,true,$menu['m_action'],$menu['m_orderby']);
	 	  }
		  ?>
         </span><?php ?>
      <?php }?>
      </a>
     <?php /* <ul class="dropdown-menu dropdown-menu-left width-250">
													<li><a href="#">Action</a></li>
													<li><a href="#">Another action</a></li>
													<li><a href="#">Something else here</a></li>
													<li><a href="#">One more line</a></li>
												</ul> */?>
												
      
      <?php $smenus=getSubMenus($menu['m_id']);
		if($smenus){ ?>
              <ul class="dropdown-menu dropdown-menu-left width-250">
                <?php		
				while($smenu = mysql_fetch_array($smenus)){
					if($smenu['m_include']!='' || $smenu['m_include']!='#'){
						$sLink= "?action=$smenu[m_action]".(($smenu['m_atype']!='')?"&atype=$smenu[m_atype]":"");
					}else $sLink="#"; ?>
                <li> <a href="<?=$sLink?>">
                  <?php if(trim($smenu['m_img']!='')){?>
                  
                  <i class="<?=$smenu['m_img']?>"></i>
                  <?php }?>
                 
                  <?="$smenu[m_actitle] $smenu[m_attitle]"?>
                 
                  <?php if($smenu['m_scnt']==1){?>
                 
                   <span class="badge bg-danger position-right"> <?=countChecks($smenu['m_where']);?></span>
                  
                  <?php } ?>
                  </a> </li>
                <?php 		} ?>
              </ul>
      <?php   }?>
    </li>
    <?php }
			}
        } 
		
		 /*?>if($LEVEL == 4 && $_REQUEST['action'] == 'dashboard'){
			?>
			<li><a href="javascript:void(0);" class="tour" >Tour</a></li>
            <!--<li><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" >Training Video</a></li>-->
			
		<?php 
		}
		?><?php */?>
        
        <?php if($_SESSION['user_id']==201){?>
			 <?php /* <li><a href="javascript:void(0);" data-toggle="modal" data-target="#ReportIssue" >Report Problem</a></li> */?>
		<?php 	

		} if($LEVEL==2){?>
			 <li><a href="<?php echo SURL;?>daily_report_catwise.php" target="_blank" aria-expanded="true" data-placement="bottom" title="Monthly Advance Portal Report" data-original-title="Monthly Advance Portal Report" data-popup="tooltip" data-trigger="hover" data-container="body"  ><i class=" icon-list3"></i></a></li> 
		<?php 	

		}?>
 		
 
 
  </ul>
  <?php if($_SESSION['user_id']==201){?>
			<?php /* <a href="javascript:void(0);" data-toggle="modal" data-target="#ReportIssue" title="Report An Issue" class="report-issue-text" ><i class="icon-comments-alt position-left"></i>Report An Issue</a> */ ?>
		<?php 	

		}?>
  
  
  <select class='dropdown'>
  </select>
  	</div>
    
    <!--<div class="col-md-3 text-right" style="padding-top:4px;">
    	<ul id="nav" class="nav navbar-nav no-margin pull-right">
        	<li><a href="#"><i class="icon-ticket position-left"></i></a></li>
            <li><a href="#" id="LiveHelpStatusDefault" name="LiveHelpStatusDefault"><i class="icon-bubbles6 position-left"></i></a></li>
        </ul>
        
    </div>-->
    
  <?php /*?><div class="col-md-2 pull-right">
  <nav class="user-menu"> <a href="javascript:;" class="main-menu-access"> <i class="icon-proton-logo"></i> <i class="icon-reorder"></i> </a>
  <section class="user-menu-wrapper"> 
  <?php 
  
  
  if($COMINF['id']==96 && $LEVEL==4){?>
  <a href="javascript:;"  class="messages-access credits_money" title="My Credits"><i class="icon-coins"></i><span class="credit_label"><?php echo (getCredits());?></span></a>
  <?php } ?>
  <a href="javascript:;" data-expand=".messages-view" class="messages-access"> <i class="icon-comment-discussion"></i> </a> 
  <a href="javascript:;" data-expand=".notifications-view" class="notifications-access unread"> <i class="icon-bubble-notification"></i>
  <!--<div class="menu-counter">6</div> <$COMINFa>--></a>
  <a href="javascript:;" onclick="window.location='?action=logout';" class="" title="Signout"><i class="icon-switch" ></i>
   
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
  </div><?php */?>
  </div>
  </div>
</nav>
   <?php } ?>
 
   
   
<script>
$(document).ready(function(e) {
 $("<option />", {
   "selected": "selected",
   "value"   : "",
   "text"    : "Go to..."
}).appendTo("nav select");

// Populate dropdown with menu items
$("nav a").each(function() {
 var el = $(this);
 $("<option />", {
     "value"   : el.attr("href"),
     "text"    : el.text()
 }).appendTo("nav select");
});

	/* Report Issue By Ayaz*/
	$('#hideImage').hide();
	$(function() { 
		$("#ReportIssue").click(function() { 
			html2canvas($(".retracted "), {
				onrendered: function(canvas) {
					theCanvas = canvas;
					var image = canvas.toDataURL("image/png");
	
					// Convert and download as image 
					$('#captured_img').attr("src", image);
					$('#img_val').attr("value", image);
				}
			});
		});
	
		
		$('#img_chk').change(function(){
		
						if(this.checked){
							html2canvas($(".retracted"), {
								onrendered: function(canvas) {
									theCanvas = canvas;
									var image = canvas.toDataURL("image/png");
									$('#captured_img').attr("src", image);
									$('#img_val').attr("value", image);
									$('#showImage').show();
									$('#hideImage').hide();
								}
							});
							
						}else{
							var blank = "";
							$('#captured_img').attr("src", blank);
							$('#img_val').attr("value", "");
							$('#showImage').hide();
							$('#hideImage').show();
							
							}
					});
	}); 

	/* Report Issue By Ayaz*/


});
$("nav select").change(function() {
  window.location = $(this).find("option:selected").val();
});
		function get_notification(){
			
			$.ajax({url: "actions.php",data:{'json_param':1,'json_call':'dashboard','action':'fedit','fedit':'s'}, success: function(result){
				
				$(result.msgs).each(function(index, element) {
					if (typeof element[index] !== 'undefined') {
                   	//proton.dashboard.alerts(element[index].com_text,element[index].com_title);
					 $.jGrowl(element[index].com_text, {
						header: element[index].com_title,
						theme: 'bg-info'
						});
					}
                });
				
				$(result.notify).each(function(index, element) {
					if (typeof element[index] !== 'undefined') {
                   	//proton.dashboard.alerts(element[index].a_info,element[index].notify_sender);
					$.jGrowl(element[index].a_info, {
						header: element[index].notify_sender,
						theme: 'bg-info'
						});
					}
                });
				
				
			}});			
		}
		$(document).ready(function(e) {
				get_notification();
				setInterval(get_notification,30000);
		});
		
		function goto_case(v_id){
			window.location = "?action=details&case="+v_id+"&_pid=1";	
		}
		
		$(".tour").click(function(){
		proton.intro.build();
		});
		

		
</script>

