<section id="widgets-container" style="min-height:120px;">
<?php if($MENUS){
	 	foreach($MENUS as $menu){
			$aLink= "?action=$menu[m_action]".(($menu['m_atype']!='')?"&atype=$menu[m_atype]":""); ?>
            <a class="widget increase" id="new-hp" href="<?=$aLink?>">
                <span>0</span>
                <p><strong><?=$menu['m_actitle']?></strong>
                   <?=$menu['m_attitle']?>
                </p>
            </a>
	<?php }
	} ?>
	<?php if($_REQUEST['CNT']>0){?>	
    <a class="widget increase" id="new-hp" style="background-color:#FFC;" href="javascript:void(0)" onclick="showNotific()">
        <span><?=$_REQUEST['CNT']?></span>
        <p><strong>Notification</strong>
           Message(s)
        </p>
    </a>    
	<?php } ?>   
	<div class="clearfix"></div>		
</section>