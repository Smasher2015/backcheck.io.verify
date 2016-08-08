<div class="box grid_16" style="opacity: 1;">		
    <h2 class="box_head">My Account &nbsp;&nbsp;<a href="?action=edit&atype=profile">Edit Info</a></h2>
    <a href="#" class="grabber">&nbsp;</a>
    <a href="#" class="toggle">&nbsp;</a>
    <div class="toggle_container">
        <div class="block" style="opacity: 1;" >
        <div class="section">
              	<div>
                	<h2 style="float:left"><?=$COMINF['title']?></h2>
             		<span style="float:right;"><?=$COMINF['pagesolgan']?></span>
                	<div style="clear:both;"></div>
                </div>
              
              <div style="float:left; width:10%;" >
              	<img src="<?=$COMINF['logo']?>" alt="<?=$COMINF['name']?>" />
              </div>
              	
              <div style="float:right; width:87%; padding-left:10px; border-left:2px solid #eeeeee;">
			  	<h3 style="padding:0px;"><?=$COMINF['name']?></h3>
                <span><?=$COMINF['email']?><br /><?=$COMINF['address']?></span>
                    
                    <div>
                    	<P></p>
                        <P><?=$COMINF['pagedesc']?></P>
                        <h3>Company Agreement</h3>
                        <P><?=$COMINF['agreement']?></P>
                	</div>
              </div>
             		<div style="clear:both;"></div>
             </div>
        </div>
    </div>
</div>
