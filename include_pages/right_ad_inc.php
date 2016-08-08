<ul>
    <li><a href="?action=dashboard" class="dashboard no-submenu">Dashboard</a></li>
    <li>
        <ul style="padding-top:10px;">          
            <li <?php if($action=='users'){?>class="current"<?php }?>>
                <a href="?action=users&atype=list" title="">User(s)
                	<span title="You have <?=$usCnts?> User(s)"><?=$usCnts?></span>
                </a>
            </li>
            <li <?php if($action=='checks'){?>class="current"<?php }?>>
                <a href="?action=checks&atype=list" title="">Check(s)
                	<span title="You have <?=$chCnts?> Check(s)"><?=$chCnts?></span>
                </a>
            </li>
            <li <?php if($action=='company'){?>class="current"<?php }?>>
                <a href="?action=company&atype=list" title="">Company(s)
                	<span title="You have <?=$cmCnts?> Company(s)"><?=$cmCnts?></span>
                </a>
            </li>                                     
        </ul>
   </li>
</ul>