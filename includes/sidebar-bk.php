<script type="text/javascript" src="js/bsn.AutoSuggest_2.1.3.js" charset="utf-8"></script>
<link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<div id="sidebar">
	<div class="cog">+</div>
	<a href="?action=dashboard" class="logo"></a>
<?php if(isset($_SESSION['user_id'])){ ?>
	<div class="user_box gray_box clearfix">
		<?php 
			if($LEVEL==4) $timg=$COMINF['logo']; else $timg=$USER['uimg'];
			if($timg=='') $timg='profile.png';
		?>
        <img src="<?=$timg?>" width="55" />
        <h2 style="width:100px; font-weight:bold;">
			<?php 
				if(isset($_SESSION['user_id'])){
					$user_info=getUserInfo($_SESSION['user_id']);
					$level_info=getLevelInfo($user_info['level_id']);
					echo $level_info['level_name'];
				}
			?>
        </h2>
		<h3 style="font-weight:bold;"><a href="#"><?="$user_info[first_name] $user_info[last_name]";?></a></h3>
		<ul>
			<li><a href="?action=changepass">Settings</a><span class="divider">|</span></li>
			<li><a href="?action=logout">Logout</a></li>
		</ul>
        
	</div>
    
    <div class="user_box red_box clearfix timer" style="font-weight:bold;text-align:center;padding-left:0;">
        <div>
            <span>Login&nbsp;&nbsp;Time:</span> [ <?php include("include_pages/timer_inc.php"); ?> ]
        </div>
    <?php if($LEVEL==3){?>
        <div>
            <span>
            	<a href="javascript:void(0)" style="color:#1389FF;" id="ssbTimer" onclick="breakTimer(this)" >Break Start:</a>
            </span>
            [ <?php include("include_pages/break_timer_inc.php");?> ]    	
        </div>
    <?php } ?>
    </div>
    <?php if($LEVEL==4){?>
	<div id="search_side" class="dark_box">
       <form action="?action=advance&atype=search" method="post" >
            <input type="hidden" name="advance_search" value="advance_search"  />
          	<input type="hidden" id="testid"  name="users"  />
        	<input name="v_name" class="" type="text" value="Search Applicant..." onclick="value=''" id="testinput" >
        </form>
    </div>
	<script type="text/javascript">
        var options = {
            script:"actions.php?&ePage=sresults&json=true&limit=6&",
            varname:"input",
            json:true,
            shownoresults:false,
            maxresults:6,
            callback: function (obj) { document.location = "?action=details&case="+obj.id; }
        };
        var as_json = new bsn.AutoSuggest('testinput', options);
        
        
        var options_xml = {
            script: function (input) { return "actions.php?&ePage=sresults&input="+input+"&testid="+document.getElementById('testid').value; },
            varname:"input"
        };
        var as_xml = new bsn.AutoSuggest('testinput_xml', options_xml);
    </script>    
    <?php } ?>
	<ul class="side_accordion">

        <?php if($MENUS){
            foreach($MENUS as $menu){
                if($menu['m_lrb']==0 || $menu['m_lrb']==2){
				if($menu['m_include']!='#'){
						$aLink= "?action=$menu[m_action]".(($menu['m_atype']!='')?"&atype=$menu[m_atype]":"");
				}else 	$aLink="#";	
				if($menu['m_img']=='') $menu['m_img']='images/icons/small/grey/documents.png';?>                
                <li class="<?=($IPAGE['m_id']==$menu['m_id'])?'current_tab':''?>">
                    <a href="<?=$aLink?>">
                        <img src="<?=$menu['m_img']?>"/>
                        <?="$menu[m_actitle] $menu[m_attitle]"?>
                    <?php if($menu['m_scnt']==1){?>    
                        <span class="alert badge alert_red">
                        	<?=($menu['m_where']!='')?countCases($menu['m_where']):0;?>
                        </span>
                    <?php }?>
                    </a>
                    <?php $smenus=getSubMenus($menu['m_id']);
							if($smenus){ ?>
                            <ul class="drawer"><?php		
								while($smenu = mysql_fetch_array($smenus)){
									if($smenu['m_include']!='' || $smenu['m_include']!='#'){
										$sLink= "?action=$smenu[m_action]".(($smenu['m_atype']!='')?"&atype=$smenu[m_atype]":"");
									}else $sLink="#";?>
                                        <li>
                                        	<a href="<?=$sLink?>"><?="$smenu[m_actitle] $smenu[m_attitle]"?></a>
                                        </li>
					<?php 		} ?>
							</ul>	
					<?php   }?>

                </li>
        <?php }
			}
        } ?>
	</ul>
<?php } ?>
</div>