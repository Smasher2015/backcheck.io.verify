<?php
if(isset($_REQUEST['edur'])){
	if(is_numeric($_REQUEST['pid'])){
		enabdisb("packages","pkg_id=$_REQUEST[pid] AND user_id=$_SESSION[user_id]");
	}
}
?>

<div class="box grid_16">		
    <h2 class="box_head">Package Listing</h2>
    <a href="#" class="grabber">&nbsp;</a>
    <a href="#" class="toggle">&nbsp;</a>
    <div class="toggle_container">
        <div class="block">
         <div id="dt2">
            <table class="display datatable">
                    <thead>
                        <tr>
                            <th>Package Name</th>
                            <th>Date Created</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php	$users= $db->select("packages","*"," user_id = $_SESSION[user_id] ORDER BY pkg_id DESC");
                        if($users){
                        while($user = mysql_fetch_array($users)){ ?>
                            <tr>
                                <td><?=trim($user['pk_name'])?></td>
                                <td style="text-align:left"><?=date("j-M-Y",strtotime($user['pk_date']))?></td>
                                <td> <?=($user['a_active']==0)?"Pending":"Approved"?></td>
                                <td >
                                    <?php  if($user['is_active']==1) {
                                             $img="accept.png";
                                              $tit="Active"; 
                                            }else{
                                              $img="exit.png";
                                              $tit="Disable";
                                            } 
                                            $link="pid=$user[pkg_id]";
                                    ?>
                                   <a href="javascript:void(0)" >
                                        <img onclick="submitLink('<?=$link?>&edur')" src="images/icons/small/grey/<?=$img?>" class="edits" title="<?=$tit?>"  />
                                    </a>
                                </td>
                            </tr>	    
                    <?php }} ?>
                    </tbody>
                </table>
        </div>
        </div>
    </div>
</div>
    
<div class="box grid_16">
        <h2 class="box_head">Add Package</h2>
        <a href="#" class="grabber">&nbsp;</a>
        <a href="#" class="toggle">&nbsp;</a>
                        
        <div class="toggle_container" >	
            <div class="block">
                <form method="post" enctype="multipart/form-data" <?=(isset($SUSER)?(!in_array(6,$RIGHTS)?'class="exit" onsubmit="return noAccess()"':''):'')?> >
                       <fieldset class="label_side">
                            <label for="required_field">Package Name<span>please Input Package Name</span></label>
                            <div>
                                <input type="text" name="pname" id="required_field" title="Input Package Name" class="req text title">
                            </div>
                        </fieldset>
                                    
                        <fieldset class="label_side">
                            <label for="required_field">Select Checks</label>
                            <div class="uniform">
								<?php 
                                	$checks=$db->select("checks","*","is_active=1");
									while($check=mysql_fetch_array($checks)){ ?>
                                   		<label for="<?=$check['checks_id']?>">
                                        <div class="checker" id="uniform-<?=$check['checks_id']?>">
                                            <span class="">
                                            <input title="Select Any Check" name="checks[]"  type="checkbox" id="<?=$check['checks_id']?>" value="<?=$check['checks_id']?>"  class="req title" style="opacity: 0;">
                                            </span>
                                        </div> 
                                        <span class="tooltip" title="<?=mb_convert_encoding($check['checks_desc'], 'HTML-ENTITIES','UTF-8')?>">
                                            <?=mb_convert_encoding($check['checks_title'], 'HTML-ENTITIES','UTF-8')?>
                                        </span>
                                		</label>
								<?php }?>
                            </div>
                        </fieldset>
                        
                        <div class="button_bar clearfix" >
                            <button class="next_step move send_right" name="create_pkg">
                                <img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/bended_arrow_right.png">
                                    <span>Package Request</span>
                            </button>
                        </div>        
                </form>
            </div>
		</div>
</div>

<script type="text/javascript">
	$(function(){
		$(".tooltip").tipTip({maxWidth:"200px", edgeOffset: 10});
	});
</script>

