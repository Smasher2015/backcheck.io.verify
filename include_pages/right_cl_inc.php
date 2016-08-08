<ul>
    <li><a href="?action=dashboard" class="dashboard no-submenu">Dashboard</a></li>
    <li>
        <ul style="padding-top:10px;">   
            <li class="<?php if($_SESSION['slink']=="close" && $_SESSION['stype']=='ready') echo 'current'; else echo 'normal';?>">
                <a href="?action=close&atype=ready" title="">Download Now 
                	<span title="You have <?php  echo $redyecas; ?> Ready for Download"><?php echo $redyecas; ?></span>
                </a>
            </li> 
            <li class="<?php if($_SESSION['slink']=="wip" && $_SESSION['stype']=='cases') echo 'current'; else echo 'normal';?>">
                <a href="?action=wip&atype=cases" title="">In Progress 
                	<span title="You have <?php  echo $wipcas; ?> Work in Progress"><?php echo $wipcas ; ?></span>
                </a>
            </li>    
            <li class="<?php if($_SESSION['slink']=="close" && $_SESSION['stype']=='history') echo 'current'; else echo 'normal';?>">
                <a href="?action=close&atype=history" title="">Archived 
                	<span title="You have <?php  echo $closecas; ?> Archived"><?php echo $closecas; ?></span>
                </a>
            </li>                                 
        </ul>
   </li>
</ul>