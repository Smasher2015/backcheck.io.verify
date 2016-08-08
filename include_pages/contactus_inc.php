<div class="box grid_16">
	<h2 class="box_head"><?=$PTITLE?></h2>
	<a href="#" class="grabber">&nbsp;</a>
	<a href="#" class="toggle">&nbsp;</a>
	<div class="block">
        <form action="" method="post" name="contactus" enctype="application/x-www-form-urlencoded" >
                <fieldset class="label_side">
                  <label for="name">Full Name:</label>
                    <div>
                        <input type="text" id="v_name" name="name" class="req title" title="Input Full Name" value="<?=$_REQUEST['name']?>" > 
                    </div>
                </fieldset>
                <fieldset class="label_side">
                  <label for="email">Email Address:</label>
                    <div>
                        <input type="text" id="email" name="email" class="req title" title="Input Email Address" value="<?=$_REQUEST['email']?>" > 
                    </div>
                </fieldset>  
                <fieldset class="label_side">
                  <label for="comtit">Subject:</label>
                    <div>
                        <input type="text" id="comtit" name="comtit" class="req title" title="Input Subject" value="<?=$_REQUEST['comtit']?>" > 
                    </div>
                </fieldset>
                <fieldset class="label_side">
                  <label for="comtxt">Message:</label>
                    <div>
                        <textarea name="comtxt" id="comtxt" rows="5" class="req title" title="Input Message" ><?=$_REQUEST['comtxt']?></textarea> 
                    </div>
                </fieldset>      
                <div class="button_bar clearfix">
                    <button class="red send_right" type="submit" name="subcontactus">
                        <img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/grey/bended_arrow_right.png">
                        <span>Contact Us</span>
                    </button>
            	</div>     
        </form>
    </div>
</div>
          