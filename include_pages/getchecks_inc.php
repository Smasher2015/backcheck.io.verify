<?php if(is_numeric($_REQUEST['pkg'])){?>
<ul class="block content_accordion ui-accordion ui-widget ui-helper-reset ui-sortable" role="tablist" style="opacity: 1;">
	 <?php 
        $tbl = "package_items pi INNER JOIN checks ck ON ck.checks_id=pi.checks_id";
        $checks=$db->select($tbl,"*","pkg_id=$_REQUEST[pkg] AND ck.is_active=1");
        while($check=mysql_fetch_array($checks)){?>
                <li class="ui-accordion-li-fix" style="position: relative; top: 0px; left: 0px;">
                    <a class="handle" href="#">&nbsp;</a>
                    <h3 class="bar ui-accordion-header ui-helper-reset ui-state-default ui-corner-all" role="tab" aria-expanded="false" aria-selected="false" tabindex="0">
                    <?php echo mb_convert_encoding($check['checks_title'], 'HTML-ENTITIES','UTF-8');?>
                    </h3>
                </li>
     <?php } ?>                                
</ul>
<?php } ?>
