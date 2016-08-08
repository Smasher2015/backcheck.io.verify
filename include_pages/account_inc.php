<?php include("include/config_client.php");?>
<?php include 'includes/document_head.php'?>
<script src="<?php echo SURL; ?>js/js_functions-2.js?var=5"></script>
    <div id="wrapper" >	
    	<?php include("include_pages/boxex_inc.php"); ?>
        <?php include 'includes/topbar.php'?>		
        <?php include 'includes/sidebar.php'?>
        <div id="main_container" class="main_container container_16 clearfix">
            <?php include 'includes/navigation.php'; ?>
			<?php
            if($_REQUEST['CNT']==1){
                    if($_REQUEST['TERR']!='') { 
                    foreach($_REQUEST['TERR'] as $ERR){?>
                        <div class="alert dismissible alert_red">
                            <img height="24" width="24" src="images/icons/small/white/alert.png">
                            <?=$ERR?>
                            <div class="clearfix"></div>
                        </div>
            <?php 	}}
                    if($_REQUEST['TSCS']!='') { 
                    foreach($_REQUEST['TSCS'] as $SCS){?>
                        <div class="alert dismissible alert_green">
                            <img height="24" width="24" src="images/icons/small/white/cog_3.png">
                            <?=$SCS?>
                            <div class="clearfix"></div>
                        </div>
            <?php 	}}		
            } 
            ?> 
               <?php
			   	switch($action){
					case"invitation":
						include("include_pages/register_inc.php");
					break;
					case"contactus":
						include("include_pages/contactus_inc.php");
					break;										
				}
			   ?> 
        </div>
        </div>
		<script type="text/javascript">
            var frms = document.forms;
            for(var i=0;i<frms.length;i++){
                if(!(frms.item(i).className.match(/exit/i))){
                    frms.item(i).onsubmit = valdateForums;
                }
            }
            setObject(document.getElementsByTagName("input"));
            setObject(document.getElementsByTagName("textarea"));
        </script>
<?php include 'includes/closing_items.php'?>