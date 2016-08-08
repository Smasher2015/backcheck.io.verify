<?php /*?><div id="nav_top" class="clearfix round_top">
	<ul class="clearfix">
		<li class="<?=($action=='dashboard')?'current':''?>">
        	<a href="?action=dashboard">
            <img src="images/icons/small/grey/laptop.png"/></a>
        </li>
<?php if(isset($_SESSION['user_id'])){ ?>
		
        <?php if($MENUS){
            foreach($MENUS as $menu){
                if($menu['m_lrb']==0 || $menu['m_lrb']==1){
				if($menu['m_include']!='#'){
						$aLink= "?action=$menu[m_action]".(($menu['m_atype']!='')?"&atype=$menu[m_atype]":"");
				}else 	$aLink="#";				
				if($menu['m_img']=='') $menu['m_img']='images/icons/small/grey/users.png';?> 
               <li class="<?=($IPAGE['m_id']==$menu['m_id'])?'current':''?>">
                    <a href="<?=$aLink?>">
                        <img src="<?=$menu['m_img']?>"/>
                        <span><?="$menu[m_actitle] $menu[m_attitle]"?></span>
						<?php if($menu['m_scnt']==1){?>    
                            <span class="alert badge alert_red">
                                <?=countChecks($menu['m_where'],true,$menu['m_action']);?>
                            </span>
                        <?php }?>                        
                    </a>
                    <?php $smenus=getSubMenus($menu['m_id']);
							if($smenus){ ?>
                            <ul class="dropdown"><?php		
								while($smenu = mysql_fetch_array($smenus)){
									if($smenu['m_include']!='' || $smenu['m_include']!='#'){
										$sLink= "?action=$smenu[m_action]".(($smenu['m_atype']!='')?"&atype=$smenu[m_atype]":"");
									}else $sLink="#"; ?>
                                    <li style="width:160px;">
                                        <a href="<?=$sLink?>">
                                        	<?php if(trim($smenu['m_img']!='')){?>
                                            		<img src="<?=$smenu['m_img']?>"/>
                                            <?php }?>
                                            <span><?="$smenu[m_actitle] $smenu[m_attitle]"?></span>
                                            <?php if($smenu['m_scnt']==1){?>    
                                                <span class="alert badge alert_red">
                                                    <?=countChecks($smenu['m_where']);?>
                                                </span>
                                            <?php }?>
                                        </a>
                                    </li>
					<?php 		} ?>
							</ul>	
					<?php   }?>
               </li>
        <?php }
			}
        } ?>

            <li>
                <a href="?action=logout" >
                    <img src="images/icons/small/grey/locked_2.png"/>
                </a>
            </li>
             
<?php }else{ ?>           
		<li class="">
        	<a href="?action=contactus">
            	<img src="images/icons/small/grey/users.png"/>
                <span>Contact Us</span>
            </a>
       </li>  
<?php } ?>
	</ul>
	<?php include 'includes/dialog_logout.php'?>		

	
	
<script type="text/javascript">
	
	//var currentPage = <?php echo $keyphrase ?> - 1; // This is only used in php to tell the nav what the current page is
	//$('#nav_top > ul > li').eq(currentPage).addClass("current");
	$('#nav_top > ul > li').addClass("icon_only").children("a").children("span").parent().parent().removeClass("icon_only");
</script>

	
	<div id="mobile_nav">
		<div class="main"></div>
		<div class="side"></div>
	</div>
	
</div><?php */?><!-- #nav_top -->
