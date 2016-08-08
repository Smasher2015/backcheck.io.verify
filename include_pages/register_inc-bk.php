<?php if(isset($erMsg)){ 
	 echo $erMsg;
}?>
<div class="mainLogim">
    <form method="post" name="doregister" enctype="multipart/form-data">
                <div>
                    <label>First Name:</label>
                    <input type="text" id="fname" name="fname" />
                    <div class="clear" ></div>  
                </div>  
                <div>
                    <label>Last Name:</label>
                    <input type="text" id="lname" name="lname" />
                    <div class="clear" ></div>
                </div>                                       
                <div>
                    <label>Email:</label>
                    <input type="text" id="email" name="email" />
                    <div class="clear" ></div>
                </div>
                <div>
                    <label>Password:</label>
                    <input type="password" id="passa" name="passa" />
                    <div class="clear" ></div>
                </div>
                <div>
                    <label>Re-Password:</label>
                    <input type="password" id="passb" name="passb" />
                    <div class="clear" ></div>
                </div> 
                <div>
                    <label>Client Type:</label>
                    <select style="width:264px;" name="utype" >
                        <option value="0" >--Select--</option>
                        <option value="1" >Corporate</option>
                        <option value="2" >Individual</option>
                    </select>
                    <div class="clear" ></div>
                </div>
                <?php 	if(isset($_POST)){
                            foreach($_POST as $key=>$p){ 
                                if(!isset($_POST['ajax']) && ($key!='action')){ ?>
                                    <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $p; ?>" />	
                          <?php }?>		
                <?			}
                        } ?>            
                <div>                                               
                    <button style="float:right; width:250px;" class="button" type="submit" name="subdoregister">Register >></button>
                    <div class="clear"></div>
                </div>
    </form>
    <div class="clear" ></div>
</div>
