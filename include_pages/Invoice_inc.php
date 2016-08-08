<div class="innerdiv">
     <h2 class="head-alt">Invoice Detail</h2>
        <div class="innercontent">
<?php 
            if(isset($_REQUEST['subdoinvoice'])){
                echo updateInvoice($_POST);	
            }
        	$invoice  =	getInvoice();
?>        
            <form action="" method="post" name="doinvoice" enctype="application/x-www-form-urlencoded">
                    <div class="dataFields">
                        <div>
                            <label>First Name:</label>
                            <input type="text" id="fname" name="fname" value="<?php echo $invoice['inv_fname']; ?>" />
                            <div class="clear" ></div>  
                        </div>  
                        <div>
                            <label>Last Name:</label>
                            <input type="text" id="lname" name="lname" value="<?php echo $invoice['inv_lname']; ?>" />
                            <div class="clear" ></div>
                        </div>                                       
                        <div>
                            <label>Email:</label>
                            <input type="text" id="email" name="email" value="<?php echo $invoice['inv_email']; ?>" />
                            <div class="clear" ></div>
                        </div>
                        <div>
                            <label>Company:</label>
                            <input type="text" id="comp" name="comp" value="<?php echo $invoice['inv_comp']; ?>" />
                            <div class="clear" ></div>
                        </div>
                        <div>
                            <label>Address:</label>
                            <textarea  name="adrs" rows="3" ><?php echo $invoice['inv_adrs']; ?></textarea>
                            <div class="clear" ></div>
                        </div> 
                        <div>
                            <label>Zip Code/ PO Box:</label>
                            <input type="text" class="input" name="zcod" value="<?php echo $invoice['inv_zcod']; ?>" />
                            <div class="clear" ></div>
                        </div>   
                        <div>
                            <label>Mobile Number:</label>
                            <input type="text" class="input" name="mfon" value="<?php echo $invoice['inv_mbl']; ?>" />
                            <div class="clear" ></div>
                        </div> 
                        <div>
                            <label>Office Phone:</label>
                            <input type="text" class="input" name="sfon" value="<?php echo $invoice['inv_fon']; ?>" />
                            <div class="clear" ></div>
                        </div>                 
                        <div>
                            <label>Town:</label>
                            <input type="text" id="town" name="town" value="<?php echo $invoice['inv_twn']; ?>" />
                            <div class="clear" ></div>
                        </div> 
                        <div>
                            <label>Fax:</label>
                            <input type="text" id="fax" name="fax" value="<?php echo $invoice['inv_fax']; ?>" />
                            <div class="clear" ></div>
                        </div>                                                                                
                        <button type="submit" class="button btnright"  name="subdoinvoice">Update Invoice >></button>
                        <div class="clear" ></div>
                    </div>
            </form>  
        </div>
</div>