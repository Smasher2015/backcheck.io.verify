<?php include("include_pages/checks_counter_inc.php"); ?>
<ul>
    <li><a href="?action=dashboard" class="dashboard no-submenu">Dashboard</a></li>
    <li><a href="?action=case&atype=add" class="addcase no-submenu">Add a Case</a></li>
    <li>
        <ul style="padding-top:10px;">
        <?php if($LEVEL==2){?>
            <li class="<?=($_SESSION['slink']=="assign")?'current':'normal'?>">
                <a href="?action=assign&atype=case" title="">Checks for Assign
                	<span title="You have <?=$nAsgchk?> Checks for Assign"><?=$nAsgchk?></span>
                </a>
            </li> 
            <li class="<?=($_SESSION['slink']=="close" && $_SESSION['stype']=='remark')?'current':'normal';?>">
                <a href="?action=close&atype=remark" title="">Checks for Remark
                	<span title="You have <?=$admrmks?>Checks for Remark"><?=$admrmks?></span>
                </a>
            </li>
            <li class="<?=($_SESSION['slink']=="close" && $_SESSION['stype']=='ready')?'current':'normal';?>">
                <a href="?action=close&atype=ready" title="">Ready Checks
                	<span title="You have <?=$ckTosnt?> Ready Checks"><?=$ckTosnt?></span>
                </a>
            </li>
            <li class="<?=($_SESSION['slink']=="close" && $_SESSION['stype']=='send')?'current':'normal'?>">
                <a href="?action=close&atype=send" title="">Sent Checks
                	<span title="You have <?=$cksntdd?> Send Checks"><?=$cksntdd?></span>
                </a>
            </li>                         
        <?php } ?>
			<li class="<?=($_SESSION['slink']=="assigned")?'current':'normal';?>">
                <a href="?action=assigned&atype=case" title="">Assigned Checks
                	<span title="You have <?=$asgnchk?> Assign Checks"><?=$asgnchk?></span>
                </a>
            </li>
            <li class="<?=($_SESSION['slink']=="notin")?'current':'normal';?>">
                <a href="?action=notin&atype=case" title="">Not Initiated Checks
                	<span title="You have <?=$notinst?> Not Initiated Checks"><?=$notinst?></span>
                </a>
            </li>        
            <li class="<?=($_SESSION['slink']=="problem")?'current':'normal'?>">
                <a href="?action=problem&atype=case" title="">Problem Checks
                	<span title="You have <?=$probchk?> Problem Checks"><?=$probchk?></span>
                </a>
            </li>
			<li class="<?=($_SESSION['slink']=="wip")?'current':'normal'?>">
                <a href="?action=wip&atype=case" title="">WIP Checks
                	<span title="You have <?=$pendgchk?> Work in Process Checks"><?=$pendgchk?></span>
                </a>
            </li>                
            <li class="<?=($_SESSION['slink']=="close" && $_SESSION['stype']=='case')?'current':'normal'?>">
                <a href="?action=close&atype=case" title="">Close Checks
                	<span title="You have <?=$closechk?> Close Check(s)"><?=$closechk?></span>
                </a>
            </li>
            <li class="<?=($action=="case" && $aType=='add')?'current':'normal'?>">
                <a href="?action=case&atype=add" title="">Saved Cases
                	<span title="You have <?=$savecass?> Saved Cases"><?=$savecass?></span>
                </a>
            </li> 
            <li class="<?=($action=="unies" && $aType=='list')?'current':'normal'?>">
                <a href="?action=unies&atype=list" title="">Universities
                	<span title="You have <?=$cntunies?> Universities"><?=$cntunies?></span>
                </a>
            </li> 
            <?php if($LEVEL==2){?>
            <li class="<?=($action=="company" && $aType=='list')?'current':'normal'?>">
                <a href="?action=company&atype=list" title="">Companies
                    <span title="You have <?=$cmCnts?> Companies"><?=$cmCnts?></span>
                </a>
            </li> 
            <li class="<?=($action=="project" && $aType=='list')?'current':'normal'?>">
                <a href="?action=project&atype=list" title="">Projects
                    <span title="You have <?=$cpCnts?> Projects"><?=$cpCnts?></span>
                </a>
            </li>                           
			<?php } ?>                             
        </ul>
   </li>
</ul>