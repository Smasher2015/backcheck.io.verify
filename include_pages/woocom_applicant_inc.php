<?php include("include/config_client.php"); 

// use ajax here
if($_REQUEST['emCode']==1){
		
		if(!empty($_POST["emp_id"])) {

	 checkEmpId($_POST["emp_id"],0,$_POST["com_id"]); exit;

		}
		
		if(!empty($_POST["cnic"])) {

	 checkCnic($_POST["cnic"],0,$_POST["com_id"]); exit;

		}
	
	}
	
include 'includes/document_head.php' ?>
<style>
.login-bg {
    background-image: url(images/body_bg.png);
}
</style>
<script src="<?php echo SURL; ?>js/js_functions-2.js?var=5"></script>
   	
    	<?php include("include_pages/sidebar.php"); ?>
        <?php //include 'includes/topbar.php'?>		
        <?php //include 'includes/sidebar.php'?>
        
            <?php //include 'include_pages/navigation.php'; ?>
		
               <?php
			   	switch($action){
					case"userinfo":
						include("include_pages/woocom_app_case_inc.php");
					break;
												
				}
			   ?> 
        
      </section>
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

