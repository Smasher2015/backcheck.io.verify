<div id="main_container" class="main_container container_16 clearfix">
<?php $keyphrase = '1'; include 'includes/navigation.php';?>
	<?php
    if($_REQUEST['CNT']>0){
            if($_REQUEST['TERR']!='') { 
            foreach($_REQUEST['TERR'] as $ERR){?>
                <div class="alert dismissible alert_blue">
                    <img height="24" width="24" src="images/icons/small/white/alert_2.png">
                    <?=$ERR?>
                    <div class="clearfix"></div>
                </div>
    <?php 	}}	
    } ?>    
    <?php include("includes/cases-main_inc.php")?>
    
</div> 