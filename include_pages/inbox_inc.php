<style>
/* CSS used here will be applied after bootstrap.css */



.nav-tabs .glyphicon:not(.no-margin) {
	margin-right: 10px;
}
.tab-pane .list-group-item:first-child {
	border-top-right-radius: 0px;
	border-top-left-radius: 0px;
}
.tab-pane .list-group-item:last-child {
	border-bottom-right-radius: 0px;
	border-bottom-left-radius: 0px;
}
.tab-pane .list-group .checkbox {
	display: inline-block;
	margin: 0px;
}
.tab-pane .list-group input[type="checkbox"] {
	margin-top: 2px;
}
.tab-pane .list-group .glyphicon {
	margin-right: 5px;
}
.tab-pane .list-group .glyphicon:hover {
	color: #FFBC00;
}
a.list-group-item.read {
	color: #222;
	background-color: #F3F3F3;
}
hr {
	margin-top: 5px;
	margin-bottom: 10px;
}

.ad {
	padding: 5px;
	background: #F5F5F5;
	color: #222;
	font-size: 80%;
	border: 1px solid #E5E5E5;
}
.ad a.title {
	color: #15C;
	text-decoration: none;
	font-weight: bold;
	font-size: 110%;
}
.ad a.url {
	color: #093;
	text-decoration: none;
}


span.no-msg {
	width: 100%;
	display: block;
	text-align: center;
	/*border: 1px solid #ccc;
	padding: 10px;
	margin-top: 15px;*/
}

</style>
<section class="retracted scrollable content-body">
  <div class="report-sec">
      <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title3">
           <h2> <ul class="breadcrumb clearfix">
              <!--<li class="first">
                	<a href="?action=dashboard">Dashboard</a>   
                </li>-->
              <li> <a href="?action=manage&amp;atype=reports">Inbox</a> </li>
            </ul></h2>
          </div>
          </div>
          </div>
    <div class="">
      <div class="">
        <div class="panel panel-default panel-block">
        
        <div class="panel-body">
          
             
                <div class="">
                  <div class="row" id="inbox_reloader">
                    <?php /*?><div class="col-sm-3 col-md-3">
                      <div class="my-side-bar inbox_left">
                     
                      <ul class="nav nav-pills nav-stacked">
                          <?php 
			$cur_user_id = $_SESSION['user_id'];
			$inb_count =  get_messages("com_type='case' AND","");;
			$inboxCount = mysql_num_rows($inb_count);
			$sent_count = $db->select("message","count(`msg_id`) as cnt","`from_id` = $cur_user_id");
			$sentCount = mysql_fetch_assoc($sent_count);

		?>					 <li><a data-toggle="modal" href="#messageModel" class="" role="button">Compose</a></li>
        				
                          <li class="active"><a href="#home" data-toggle="tab"><span class="badge pull-right"><?php echo ($inboxCount>0)?$inboxCount:0;?> </span> Inbox </a> </li>
                          
                          <li><a href="#sent" data-toggle="tab"><span class="badge pull-right"> <?php echo ($sentCount['cnt']>0)?$sentCount['cnt']:0;?> </span>Sent</a></li>
                          
                        </ul>
                      </div>
                    </div><?php */?>
                    <div class="col-sm-12 col-md-12 inbox_right" > 
                      <!-- Nav tabs -->
                      <ul class="nav nav-lg nav-tabs nav-justified no-margin no-border-radius bg-indigo-400 border-top border-top-indigo-300">
                        <?php 
			$cur_user_id = $_SESSION['user_id'];
			$inb_count =  get_messages("com_type='case' AND","");;
			$inboxCount = mysql_num_rows($inb_count);
			$sent_count = $db->select("message","count(`msg_id`) as cnt","`from_id` = $cur_user_id");
			$sentCount = mysql_fetch_assoc($sent_count);

		?>	
                        <li class="active"><a href="#home" class="text-size-small text-uppercase" data-toggle="tab"><span class="icon-mail5"> </span>Inbox <span class="badge pull-right"><?php echo ($inboxCount>0)?$inboxCount:0;?> </span></a></li>
                        
                        <li><a href="#sent" class="text-size-small text-uppercase" data-toggle="tab"><span class="icon-paperplane"> </span> Sent <span class="badge pull-right"> <?php echo ($sentCount['cnt']>0)?$sentCount['cnt']:0;?> </span></a></li>
                        <li><a data-toggle="modal" href="#messageModel" class="text-size-small text-uppercase" role="button"><span class="icon-pencil5"> </span> Compose</a></li>
                      </ul>
                      <!--  Tab panes -->
                      <div class="tab-content"> 
                        <!------------------------ This Is Inbox Section   ---------------->
                        <div class="tab-pane fade has-padding active in" id="home">
                          <ul class="media-list">
                            <?php 
				//$get_messages = $db->select("message","*","`user_id` = $cur_user_id");
				$get_messages = get_messages("com_type='case' AND","");
				if(@mysql_num_rows($get_messages)>0){
					
				while($imessage = mysql_fetch_array($get_messages)){?>
                            <li class="media">
                           	 <div class="media-left">
                            <span class="name" style="min-width: 120px; display: inline-block;"> <?php echo $imessage['first_name'];?></span>
                            </div>
                            <div class="media-body">
                           
                            <a href="#view_inb_<?=$imessage['com_id']?>" onclick="goto_case(<?=$imessage['v_id']?>,true)" class="chk_<?=$imessage['com_id']?>" >
                            <label for="inbox_<?=$imessage['com_id']?>" class="lbl_<?=$imessage['com_id']?>" >
                              <?php //$user_info=getUserInfo($imessage['from_id']);	 ?>
                               <span class="" style=" font-weight: <?php echo ($imessage['is_read']==1) ? 'bold' : '400';?> ;   font-size: 15px;">
                              <?=$imessage['com_title']?>
                              </span>
                              <span class="media-annotation pull-right">
                            <?=dateTimeExe($imessage['com_date'])?>
                            </span>
                            </label>
                           </span>
                           </a>
                              <span class="display-block text-muted" style="font-size: 11px;">-
                              <?=$imessage['com_text']?>
                              </span>
                            </div>
                            </li>
                            <div id="view_inb_<?=$imessage['com_id']?>" tabindex="-1" role="dialog" class="modal fade">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i class="icon-user"></i><span> <?php echo $imessage['first_name'];?> </span></h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="panel panel-default panel-block">
                                      <div class="">
                                        <div class="">
                                          <h4 class="section-title"><span class="icon-envelope"></span> Message</h4>
                                          <div class="form-group">
                                            <div>
                                              <?=$imessage['com_text']?>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Hide</button>
                                  </div>
                                </div>
                                <!-- /.modal-content --> 
                              </div>
                              <!-- /.modal-dialog --> 
                            </div>
                            <?php }
				}else{
				?>
                            <span class="text-center no-msg">Inbox is empty.</span>
                            <?php }?>
                          </ul>
                        </div>
                        
                        <!------------------------ End This Is Inbox Section   ----------------> 
                        <!------------------------ This Is Sent Item Section   ---------------->
                        <div class="tab-pane fade has-padding" id="sent">
                           <ul class="media-list">
                            <?php 
				$get_sentmsg = $db->select("message","*","`from_id` = $cur_user_id");
				if(mysql_num_rows($get_sentmsg)>0){
					
				while($smessage = mysql_fetch_array($get_sentmsg)){?>
                			
                             <li class="media">
                            <div class="media-left">
                				  <span class="name" style="min-width: 120px; display: inline-block;"><?php echo $user_info['first_name'];?> </span> 
                            </div>
                            
                            <div class="media-body">
                            
                            <a href="#view_sent_<?=$smessage['msg_id']?>" class="" data-toggle="modal">
                           
                              <?php $user_info=getUserInfo($smessage['user_id']);	 ?>
                            
                              <?=$smessage['msg_subject']?>
                            
                            <span class="media-annotation pull-right">
                            <?=dateTimeExe($smessage['msg_date'])?>
                            </span> </span></a>
                            <span class="text-muted display-block" style="font-size: 11px;">-
                              <?=$smessage['msg_message']?>
                              </span>
                              
                            </div>
                            </li>
                            <div id="view_sent_<?=$smessage['msg_id']?>" tabindex="-1" role="dialog" class="modal fade">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i class="icon-user"></i><span> <?php echo $user_info['first_name'];?> </span></h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="panel panel-default panel-block">
                                      <div class="list-group">
                                        <div class="list-group-item">
                                          <h4 class="section-title"><span class="icon-envelope"></span> Message</h4>
                                          <div class="form-group">
                                            <div>
                                              <?=$smessage['msg_message']?>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Hide</button>
                                  </div>
                                </div>
                                <!-- /.modal-content --> 
                              </div>
                              <!-- /.modal-dialog --> 
                            </div>
                            <?php }
				}else{
				?>
                            <span class="text-center">Sent items empty.</span>
                            <?php }?>
                          </ul>
                        </div>
                        
                        <!------------------------ End This Is Sent Item Section   ----------------> 
                      </div>
                    </div>
                  </div>
                </div>
             
        </div>
        </div>
      </div>
    </div>
  </div>
  <div id="messageModel" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form name="" method="post" id="sendmsgs">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="icon-plus"></i><span>Compose Message</span></h4>
          </div>
          <div class="modal-body">
            <div id="msg-inbox"></div>
            <?php /*   <div class="form-group">
            <label>To</label>
            <select id="source" name="to_msg" class="form-control parsley-validated" data-parsley-required="true">
				<option value="">Please Select</option>
			<?php 
				$get_managers = $db->select("users","*","`level_id` = 2 AND `is_active` = 1");
				while($manager = mysql_fetch_array($get_managers)){?>
                  <option value="<?=$manager['user_id']?>"><?php echo $manager['first_name'] .' '. $manager['last_name'];?> </option>
              <?php }?>
            </select>
          </div> */ ?>
            <div class="form-group">
              <label for="basic-input">Subject</label>
              <input id="basic-input"  placeholder="Subject" name="subject" class="form-control parsley-validated" data-parsley-required="true">
            </div>
            <div class="panel panel-default panel-block">
              <div class="list-group">
                <div class="list-group-item">
                  <h4 class="section-title">Message</h4>
                  <div class="form-group">
                    <div>
                      <textarea id="wysiwyg" rows="6" class="form-control" name="message"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-lg btn-success sendMsg" name="sendmsgs" value="SEND MESSAGE" >SEND MESSAGE</button>
            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">CANCEL</button>
            <input type="hidden" name="cc_email" value="khalique@xcluesiv.com" />
            <input type="hidden" name="to_msg" value="18">
            <!-- rizwan@xcluesiv.com  --> 
          </div>
        </form>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>
</section>
