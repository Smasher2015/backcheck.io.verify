
<?php include("include_pages/attachments_inc.php"); ?> 
<section class="retracted scrollable">
<div class="row">
  <div class="col-md-12">
    <div class="report-sec">
      <div class="panel panel-default panel-block">
    <div class="page-section-title"><h2 class="box_head">Add Comments</h2></div>	
    <div class="list-group-item">
        <form enctype="multipart/form-data" name="comments" method="post">
            <div class="form-group">
            <label for="label_side">Comments Title:</label>
            <input class="form-control" name="comTit" placeholder="Please type Comments Title" value="<?=$_REQUEST['comTit']?>">
            </div>
            <?php /*?><fieldset class="label_side">
                <label>Comments Title:<span>Please type Comments Title</span></label>
                <div>
                <input class="input" type="text" name="comTit" value="<?=$_REQUEST['comTit']?>" >
                    <!--<input type="text">-->
                </div>
            </fieldset><?php */?>  
			
            <div class="form-group">
            <label for="basic-text-area">Description :<span>Please type Description </span></label>
            <div>
            <textarea  class="form-control" name="comTxt"><?=$_REQUEST['comTxt']?></textarea>
            </div>
            </div>
            <?php /*?><fieldset class="label_side">
                <label>Description :<span>Please type Description </span></label>
                <div>
                <textarea class="input"  name="comTxt" ><?=$_REQUEST['comTxt']?></textarea>
                    <!--<input type="text">-->
                </div>
            </fieldset><?php */?>
            
            <fieldset class="label_side">
                <label>&nbsp;</label>
                <div>
					<?php if($LEVEL==3 || $LEVEL==2){ ?>
                        <input type="checkbox" name="adprob" value="1" id="adprob" />
                        <label for="adprob" style="display:inline">Add this Check as Problem Check...</label>
                    <?php } ?>
                </div>
            </fieldset>
            <br />
			<div class="button_bar clearfix">
                <button class="btnright btn btn-success" type="submit" value="Add Comments" name="subProblem" >
                	<span>Add Comments</span>
                </button>
            </div>
        </form>
    </div>
    </div>
    </div>
</div>
</div>
</section>

<?php $comments = getComments(0,$_REQUEST['ascase']);
      if($comments){ ?>
                   <section class="retracted scrollable">
<div class="row">
  <div class="col-md-12">
    <div class="report-sec">
      <div class="panel panel-default panel-block">
    <div class="page-section-title"><h2 class="box_head">Add Comments / Problem</h2></div>
    
        <div id="comments">
            	
            <div class="list-group-item">
            <?php
                        while($comment = mysql_fetch_array($comments)){ 
                            $uInfo = getUserInfo($comment['user_id']);?>
                            <div class="mainCmt">
                                <img class="photo" src="images/default.png" width="50" >
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
                                        <form id="com-<?php echo $comment['com_id'];?>" style="display:none;" enctype="multipart/form-data" method="post">
                                            <div class="reply-tarea bRadius">
                                               <fieldset class="label_side">
                                                    <label>Add Reply :<span>Please type your reply </span></label>
                                                    <div> 
                                                    <textarea  class="form-control"  name="reply" ><?=$_REQUEST['reply']?></textarea>
                                                    </div>
                                                </fieldset>
												 <input type="hidden" name="comID" value="<?php echo $comment['com_id'];?>"  />
                                                <input type="hidden" name="typ" value="case"  />
                                                <div class="button_bar clearfix">
                                                	<button type="submit" class="btnright btn btn-success" name="addreply"><span>Add Reply</span></button>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </form>
                                        <div class="clear"></div>
                                    </div>
                                    
                                    <div id="replys" class="section">
                                        <?php  $replys = getComments($comment['com_id'],0); 
										
                                        if($replys){
                                        while($reply = mysql_fetch_array($replys)){
                                            $uInfo = getUserInfo($reply['user_id']);?>
                                            <div class="mainRpl">
                                                <img class="rphoto" src="images/default.png" width="50" >
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
            <?php		} ?>
            </div>
        </div>
        </div>
      </div>
   </div>
</div>
</section> 
      
<?php } ?>
