<?php 
if(isset($cCheck)) $_REQUEST['ascase']=$cCheck; 
	if(is_numeric($_REQUEST['ascase'])){ ?>
<div id="comments" >
    <?php
            $comments = getComments(0,$_REQUEST['ascase']);
            if($comments){
                while($comment = mysql_fetch_array($comments)){ 
                    $uInfo = getUserInfo($comment['user_id']); ?>
                    <div class="mainCmt">
                       	<img class="photo" src="img/default_thumb.png" >
                        <div class="content">    
							<div>
                                <div class="comTitle"><?php echo $comment['com_title']; ?></div>
                                <div class="comText"><?php echo $comment['com_text']?>
                                <div class="time"> Posted by <?php echo trim($uInfo['first_name'].' '.$uInfo['last_name']);?>  
                                <?php echo time_ago(strtotime($comment['com_date'])); ?></div></div>
                                <div class="clear"></div>                            
                            </div>
                            <div class="replyBox">
                            	<div class="replyBtn" style="margin-right:3px;" >
                                	<img src="images/icons/small/grey/pluse.png" title="Add Reply" onclick="showSHR(this,'<?php echo $comment['com_id'];?>')" />
                                	<div class="clear"></div>
                                </div>
                        		<form class="validate_form" id="com-<?php echo $comment['com_id'];?>" style="display:none;" enctype="multipart/form-data" method="post">
                                	<div class="reply-tarea bRadius">
                                        <fieldset class="label_side">
                                            <label>Reply<span>Please Type Your Reply</span></label>
                                            <div class="clearfix">
                                                <textarea class="textarea req title" title="Add Reply" name="reply"></textarea>
                                            </div>
                                        </fieldset>
                                        <input type="hidden" name="ascase" value="<?=$_REQUEST['ascase']?>" > 
                                    	<input type="hidden" name="comID" value="<?php echo $comment['com_id'];?>"  />
                                        <input type="submit" class="button btnright" style="margin-right:3px;" name="addreply" value="Add Repley" />
                                        <div class="clear"></div>
                                    </div>
                                </form>
                        		<div class="clear"></div>
                            </div>
                            <div id="replys">
								<?php  $replys = getComments($comment['com_id'],0); 
								if($replys){
								while($reply = mysql_fetch_array($replys)){
									$uInfo = getUserInfo($reply['user_id']);?>
                                    <div class="mainRpl">
                                        <img class="rphoto" src="img/default_thumb.png" >
                                        <div class="comreply">
                                            <?php echo $reply['com_text']?>
                                            <div class="time"> Posted by <?php echo trim($uInfo['first_name'].' '.$uInfo['last_name']);?>  
                                        <?php echo time_ago(strtotime($reply['com_date'])); ?></div>
                                        <div class="clear"></div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                <?php }} ?>	
                            </div>
                        </div>    
                    	<div class="clear"></div>
                    </div>
    <?php		}
            }else{ ?>
           <p style="text-align:center"> No Comments </p>
        <?php    } ?>
        <div class="clear"></div>
    </div> 
  
<div>
        <form class="validate_form" enctype="multipart/form-data" name="comments" method="post">
            
            <fieldset class="label_side">
                <label>Comments Title<span>Please Type Your Comments</span></label>
                <div>
                    <input type="text" class="text req title" title="Add Comments Title" name="comTit" >
                </div>
            </fieldset>            

            <fieldset class="label_side">
                <label>Description<span></span></label>
                <div class="clearfix">
                    <textarea class="textarea req title" title="Add Comments Description"  name="comTxt"></textarea>
                </div>
            </fieldset>
             <input type="hidden" name="ascase" value="<?=$_REQUEST['ascase']?>" >           
            <div style="margin-top:5px;">
                <button name="subProblem" type="submit" class="btnright img_icon has_text text_only">
                    <span>Add Comments</span>
                </button>
            </div>
        </form>
        <div class="clear"></div>
    </div>

<?php } ?>    