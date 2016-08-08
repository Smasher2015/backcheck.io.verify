

<?php if(isset($_SESSION['user_id'])){ ?>   
 

<nav class="quick-launch-bar">
  <ul id="nav">
   
    <?php if($MENUS){
            foreach($MENUS as $menu){
                if($menu['m_lrb']==0 || $menu['m_lrb']==1){
				if($menu['m_include']!='#'){
						$aLink= "?action=$menu[m_action]".(($menu['m_atype']!='')?"&atype=$menu[m_atype]":"");
				}else 	$aLink="#";				
				if($menu['m_img']=='') $menu['m_img']='images/icons/small/grey/users.png';?>
    <li class="<?=($IPAGE['m_id']==$menu['m_id'])?'current':''?> pos-rel"> 
    		<a href="<?=$aLink?>"><span>
      <?="$menu[m_actitle] $menu[m_attitle]"?>
      </span>
      <?php if($menu['m_scnt']==1){?>
        <span class="top-menu-counter">
          <?=countChecks($menu['m_where'],true,$menu['m_action']);?>
         </span>
      <?php }?>
      </a>
      <?php /*?><?php $smenus=getSubMenus($menu['m_id']);
		if($smenus){ ?>
              <ul class="dropdown">
                <?php		
                                        while($smenu = mysql_fetch_array($smenus)){
                                            if($smenu['m_include']!='' || $smenu['m_include']!='#'){
                                                $sLink= "?action=$smenu[m_action]".(($smenu['m_atype']!='')?"&atype=$smenu[m_atype]":"");
                                            }else $sLink="#"; ?>
                <li style="width:160px;"> <a href="<?=$sLink?>">
                  <?php if(trim($smenu['m_img']!='')){?>
                  <img src="<?=$smenu['m_img']?>"/>
                  <i class="icon-code"></i>
                  <?php }?>
                  <span>
                  <?="$smenu[m_actitle] $smenu[m_attitle]"?>
                  </span>
                  <?php if($smenu['m_scnt']==1){?>
                  <!--<span class="alert badge alert_red">
                    <?=countChecks($smenu['m_where']);?>
                  </span>-->
                  <?php }?>
                  </a> </li>
                <?php 		} ?>
              </ul>
      <?php   }?><?php */?>
    </li>
    <?php }
			}
        } ?>
 
  </ul>
</nav>
   <?php } ?>
<script>
		function get_notification(){
			
			$.ajax({url: "actions.php",data:{'json_encode':1,'json_call':'dashboard','action':'fedit','fedit':'s'}, success: function(result){
				
				$(result.msgs).each(function(index, element) {
					if (typeof element[index] !== 'undefined') {
                   	proton.dashboard.alerts(element[index].com_text,element[index].com_title);
					}
                });
				
				$(result.notify).each(function(index, element) {
					if (typeof element[index] !== 'undefined') {
                   	proton.dashboard.alerts(element[index].a_info,element[index].notify_sender);
					}
                });
				
				
			}});			
		}
		$(document).ready(function(e) {
				get_notification();
				setInterval(get_notification,30000);
		});
		
		function goto_case(v_id){
			window.location = "?action=details&case="+v_id+"&_pid=1";	
		}
		

		
</script>