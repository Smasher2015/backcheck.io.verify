<?php if(isset($_SESSION['user_id'])){ //action=userinfo?>   
<?php if( $LEVEL!=5){?>  
    <div class="sidebar sidebar-main">
                <div class="sidebar-content">
    			<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<?php 
			$logo = getlogo();
			
		?>
                                <a href="#" class="media-left" href="?action=edit&atype=profile" title="<?=($LEVEL == 4)?$COMINF['name']:'BCG';?>">
                                <img src="<?php echo $logo;?>" class="img-circle img-sm" alt="<?=($LEVEL == 4)?$COMINF['name']:'BCG';?>">
                                </a>
                                
								<div class="media-body">
									<span class="media-heading text-semibold"><?php echo ucfirst($_SESSION['fname']);?></span>
									<div class="text-size-mini text-muted">
                                    <?php 
						// team lead 12 level id
						if($LEVEL_TL==12) $lev = getLevel($LEVEL_TL); else $lev = getLevel($LEVEL);
						
						echo $lev['level_name'];
						if($LEVEL == 4){ ?>
                       
                        
                       <?php }
						if($LEVEL == 4){ 
						if(in_array($COMINF['id'],unserialize(CHECK_COMIDS))){ 
						
						if(isset($_SESSION['loc_id']) && $_SESSION['loc_id']!=0){
						$Loc =	getInfo("users_locations","loc_id=$_SESSION[loc_id]");
						echo '<i class="icon-pin text-size-small"></i> &nbsp;'.$Loc['location'];
						}
						}
						}?>
										
									</div>
								</div>

								<div class="media-right media-middle">
									<ul class="icons-list">
										<li>
											<a href="javascript:;" onclick="window.location='?action=logout';"><i class=" icon-switch"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
    
    <div class="sidebar sidebar-main sidebar-fixed">
        <div class="category-content no-padding">
        <ul id="main-menu" class="navigation navigation-main navigation-accordion">
        
        
       <!--<li class="has-subnav">
                <a href="javascript:;">
                    <i class="icon-warning-sign nav-icon"></i>
                    <span class="nav-text">
                        Error Pages
                    </span>
                    <i class="icon-angle-right"></i>
                </a>
                <ul>
                    <li>
                        <a class="subnav-text" href="401-unauthorized-error.html">
                            401 Unauthorized
                        </a>
                    </li>
                </ul>
            </li>-->
            <?php if($MENUS){
            foreach($MENUS as $menu){
                if($menu['m_lrb']==0 || $menu['m_lrb']==2){
				if($menu['m_include']!='#'){
						$aLink= "?action=$menu[m_action]".(($menu['m_atype']!='')?"&atype=$menu[m_atype]":"");
				}else 	$aLink="#";				
				if($menu['m_img']=='') $menu['m_img']='images/icons/small/grey/users.png';
				$smenus=getSubMenus($menu['m_id']);
				?>
    	<li <?php echo ($smenus) ? 'class="has-subnav"' : ''; if($_REQUEST['action'] == $menu[m_action]){echo 'class="active"'; } ?> > 
            <a href="<?=$aLink?>"> 
            	<i class="<?=$menu['m_img']?> nav-icon"></i> 
                <span class="nav-text">
                <?="$menu[m_actitle] $menu[m_attitle]"?> 
                <?php if($menu['m_scnt']==1){?>
                <span class="label bg-red">
				
                <?php
				if($menu['m_action'] == 'applicantinsufficient')
		{
		echo countInsuff_applicant($COMINF['id'],$_SESSION['user_id']);
		 
		 }else if($menu['m_action'] == 'insufficient') {
		
		$com_id = ($LEVEL==4)?$COMINF['id']:1; // deaflut mobilink id
		echo countInsuffDocsByClient($com_id);
		  }
		  else
		  {	
	 
	  echo countChecks($menu['m_where'],true,$menu['m_action'],$menu['m_orderby']);
		  }?>
                </span>
                <?php }?>
                </span>
				
                <?php //echo ($smenus) ? '<i class="icon-angle-right"></i>' : ''; ?>
            	
            </a>
      <?php //$smenus=getSubMenus($menu['m_id']);?>
		 <?php if($smenus){ ?>
      <ul>
        <?php		
				while($smenu = mysql_fetch_array($smenus)){
					if($smenu['m_include']!='' || $smenu['m_include']!='#'){
					$sLink= "?action=$smenu[m_action]".(($smenu['m_atype']!='')?"&atype=$smenu[m_atype]":"");
					}else $sLink="#"; ?>
				<li> 
                    <a class="subnav-text" href="<?=$sLink?>">
                    <?php /*?><?php if(trim($smenu['m_img']!='')){?>
                    <img src="<?=$smenu['m_img']?>"/>
                    <?php }?><?php */?>
                    <?="$smenu[m_actitle] $smenu[m_attitle]"?>
                    <?php if($smenu['m_scnt']==1){?>
                        <span class="label bg-red">
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

            
            
        </ul>
    
    </div>
    </div>
    </div></div>
  <?php }?>
  <?php }?>
