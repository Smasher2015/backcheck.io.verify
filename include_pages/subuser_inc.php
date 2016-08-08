<?php
$no_rights = array();
if(is_numeric($_REQUEST['uid'])){
	$tUinfo = getUserInfo($_REQUEST['uid']);
	$_REQUEST['comid']  = $tUinfo['com_id'];
	$_REQUEST['fname']  = $tUinfo['first_name'];
	$_REQUEST['lname']  = $tUinfo['last_name'];
	$_REQUEST['country']  = $tUinfo['country'];
	$_REQUEST['email']  = $tUinfo['email'];
	$_REQUEST['no_rights']  = $tUinfo['no_rights'];
	$no_rights = explode('|',$_REQUEST['no_rights']);
}
?>

<div class="box grid_16">		
    <h2 class="box_head">Sub Users Listing</h2>
    <a href="#" class="grabber">&nbsp;</a>
    <a href="#" class="toggle">&nbsp;</a>
    <div class="toggle_container">
        <div class="block">
         <div id="dt2">
            <table class="display datatable">
                    <thead>
                        <tr>
                            <th>Sub User Name</th>
                            <th>Email</th>              
                            <th>Country</th>
                             <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php	$users= $db->select("users","*","puser_id=$_SESSION[user_id] AND is_subuser=1");
                        if($users){
                        while($user = mysql_fetch_array($users)){ 
                            $name=trim("$user[first_name] $user[last_name]");?>
                            <tr>
                                <td><?=$name?></td>
                                <td style="text-align:left"><?=$user['email']?></td>
                                <td><?=$user['country']?></td>
                                <td >
                                    <?php  if($user['is_active']==1) {
                                             $img="accept.png";
                                                $tit="Disable"; 
                                            }else{
                                                 $img="exit.png";
                                                 $tit="Enable";
                                            } 
                                            $link="uid=$user[user_id]";
                                    ?>
                                    <a href="javascript:void(0)" >
                                        <img onclick="submitLink('<?=$link?>&msg=<?=$name?>&eduser')" src="images/icons/small/grey/<?=$img?>" class="edits" title="<?=$tit?>"  />
                                    </a>
                                    <a href="javascript:void(0)" >
                                        <img onclick="submitLink('<?=$link?>&edit')" src="images/icons/small/grey/pencil.png"  class="edits" title="Edit"  />
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
        <h2 class="box_head"><?=isset($_REQUEST['uid'])?'Edit':'Add'?> Sub User</h2>
        <a href="#" class="grabber">&nbsp;</a>
        <a href="#" class="toggle">&nbsp;</a>
                        
        <div class="toggle_container" >	
                 <div class="block">
                <form method="post" enctype="multipart/form-data" <?=(isset($SUSER)?'class="exit" onsubmit="return noAccess()"':'')?> >
                        <fieldset class="label_side">
                            <label>First Name:</label>
                            <div>
                                <input class="req title" type="text" name="fname" title="Input First Name" value="<?=$_REQUEST['fname']?>" >
                            </div>
                        </fieldset>
                        <fieldset class="label_side">
                            <label>Last Name:</label>
                            <div>
                                <input class="req title" type="text" name="lname" title="Input Last Name" value="<?=$_REQUEST['lname']?>" >
                            </div>
                        </fieldset>
                        <fieldset class="label_side">
                            <label>Email Address:</label>
                            <div>
                                <input class="req title" type="text" name="email" title="Input Email Address" value="<?=$_REQUEST['email']?>" >
                            </div>
                        </fieldset>
                        <fieldset class="label_side">
                            <label>Country:</label>
                            <div>
                                <input class="req title" type="text" name="country" title="Input Country" value="<?=$_REQUEST['country']?>" >
                            </div>
                        </fieldset>    
                        <?php if(isset($_REQUEST['uid'])){ ?>
                        <div id="shpass" style="display:block;">
                        <fieldset class="label_side">
                            <label>Password:</label>
                            <div>
                                <a href="javascript:void(0)" onclick="showcpass()">Click Here to Change Password</a>
                            </div>
                            <script type="text/javascript">
                            	function showcpass(){
									document.getElementById('uRight').style.display = 'block';
									document.getElementById('shpass').style.display = 'none';
								}
                            </script>
                        </fieldset>		
                        </div>						
						<?php } ?>                    
                        <div id="uRight" style="display:<?=isset($_REQUEST['uid'])?'none':'block'?>;">
                        <fieldset class="label_side">
                            <label>Password:</label>
                            <div>
                                <input class="<?=isset($_REQUEST['uid'])?'':'req'?> title" type="password" name="passa" title="Input Password" value="" >
                            </div>
                        </fieldset>
                        <fieldset class="label_side">
                            <label>Confirm Password:</label>
                            <div>
                                <input class="<?=isset($_REQUEST['uid'])?'':'req'?> title" type="password" name="passb" title="Input Confirm Password" value="" >
                            </div>
                        </fieldset>
                        </div>
						<fieldset class="label_side" >
                                <label>Sub User Rights:</label>
                                <div>					
                                   <?php 
                                    $srights = $db->select("subuser_rights","*","is_active=1");
                                    if(mysql_num_rows($srights)>0){
                                        while($sright = mysql_fetch_array($srights)){?>
                                            <div>
                                                <input type="checkbox" name="no_rights[]" value="<?=$sright['sr_id']?>" 
                                                <?=(in_array($sright['sr_id'], $no_rights))?'checked="checked"':''?> />
                                                <?=$sright['sr_name']?>
                                            </div>             
                                   <?php }
                                    } ?>                                    
                                </div>
                       </fieldset>
                    
                    <?php if(is_numeric($_REQUEST['uid'])){ ?>
                        <input type="hidden" name="uid" value="<?=$_REQUEST['uid']?>"  />
                    <?php } ?>
                    <div class="button_bar clearfix">               
                        <button type="submit" class=" div_icon has_text" style="float:right;" name="addsubuser" >	 
                                    <span><?=isset($_REQUEST['uid'])?'Edit':'Add'?> Sub User</span>
                        </button>
                    </div>
                </form>
                </div>
		</div>
</div>


