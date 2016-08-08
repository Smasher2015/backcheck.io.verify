<script type="text/javascript" src="js/bsn.AutoSuggest_2.1.3.js" charset="utf-8"></script>
<link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<div id="sidebar">
	<div class="cog">+</div>
	<a href="?action=dashboard" class="logo"></a>
<?php if(isset($_SESSION['user_id'])){ ?>
	<div class="user_ibox user_box gray_ibox clearfix">
		<?php 
			if($LEVEL==4) $timg=$COMINF['logo']; else $timg=$USER['uimg'];
			if($timg=='') $timg='profile.png';
		?>
        <div style="width:100%; margin:auto; height:auto;">
        	<img src="<?=$timg?>" width="145" style="margin:auto;" />
        </div>
        <div style="width:100%; margin:auto;"> 
            <h2 class="lTitle">
            <?php 
                if(isset($_SESSION['user_id'])){
                    $user_info=getUserInfo($_SESSION['user_id']);
                    $level_info=getLevelInfo($user_info['level_id']);
                    echo $level_info['level_name'];
                }
            ?>
        	</h2>
            <div class="userNameBox clearfix">
            	<h3 style="font-weight:bold; text-align:center;"><a href="#"><?="$user_info[first_name] $user_info[last_name]";?></a></h3>
                <ul style="text-align:center;">
                	<li><a style="color:#FF0000" href="?action=changepass">Settings</a><span class="divider">|</span></li>
                	<li><a style="color:#FF0000" href="?action=logout">Logout</a></li>
            	</ul>
        	</div>
        </div>
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
    <?php if($LEVEL==4 || $LEVEL==3 || $LEVEL==2){?>
	<div id="search_side" class="dark_box">
       <form action="<?=($LEVEL==4)?'?action=advance&atype=search':'javascript:void(0)'?>" method="post" >
            <input type="hidden" name="advance_search" value="advance_search"  />
          	<input type="hidden" id="testid"  name="users"  />
        	<input name="v_name" class="" type="text" value="Search Applicant..." onclick="value=''" id="testinput" >
        </form>
    <script type="text/javascript">
        var options = {
            script:"actions.php?&ePage=sresults&json=true&limit=6&",
            varname:"input",
            json:true,
            shownoresults:false,
            maxresults:6,
			timeout:5000,
			delay:100,			
            callback: function (obj) { document.location = "?action=details&case="+obj.id; }
        };
        var as_json = new bsn.AutoSuggest('testinput', options);
    </script>
    </div>    
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
                        	<?=($menu['m_where']!='')?countCases($menu['m_where'],true,$menu['m_atype']):0;?>
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