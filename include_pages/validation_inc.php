<?php
if(isset($userInfo)){ 
	if($userInfo['validation']==$_REQUEST['key']){
		if(($userInfo['u_type']==1) || ($userInfo['u_type']==2)){   ?>
        <div class="mainLogim">
        <?php if(isset($erMsg)) echo $erMsg;?>
            <form action="" method="post" name="dovalidate" enctype="application/x-www-form-urlencoded">
                   <?php if($userInfo['u_type']==1){ ?>
                        <div>
                            <label>Company Name:</label>
                            <input type="text" id="comname" name="comname" />
                            <div class="clear" ></div>
                        </div>  
                        <div>
                            <label>Designation:</label>
                            <input type="text" id="desig" name="desig" />
                            <div class="clear" ></div>
                        </div>
                     <?php } ?>                             
                        <div>
                            <label>Country:</label>
                            <input type="text" id="cntry" name="cntry" />
                            <div class="clear" ></div>
                        </div> 
                        <div>
                            <label>City:</label>
                            <input type="text" id="city" name="city" />
                            <div class="clear" ></div>
                        </div>   
                        <div>
                            <label>Zip Code/PO Box:</label>
                            <input type="text" id="zip" name="zip" />
                            <div class="clear" ></div>
                        </div> 
                        <div>
                            <label><?php if($userInfo['u_type']==1){ ?>Company <?php } ?>Address:</label>
                            <input type="text" id="comads" name="comads" />
                            <div class="clear" ></div>
                        </div>                                
                        <div>
                            <label>Phone Number:</label>
                            <input type="text" id="mfone" name="mfone" />
                            <div class="clear" ></div>
                        </div>                                                                             	
                     <?php if($userInfo['u_type']==1){ ?>   
                        <div>
                            <label>Office Phone:</label>
                            <input type="text" id="ofone" name="ofone" />
                            <div class="clear" ></div>
                        </div>  
                     <?php } ?>
                        <input type="hidden" name="key" value="<?php echo $_REQUEST['key']; ?>" >                                                                            
                        <button type="submit" class="right" name="subdovalidate">Validate</button>
            </form>
            <div class="clear" ></div>
        </div>
<?php 	}else{ ?>
			
<?php }}} ?>