<?php 
include 'include/config_index.php';?>
<?php 
if($_REQUEST['action']=='dashboard'){
	
	if($LEVEL == 5)
	{
	//include 'include_pages/document_head.php';
 	 @header("Location:?action=applicant&atype=dashboard");
	}
	else{
	include 'dashboard/document_head.php';
	include("include_pages/demo_dashboard_inc.php");
	}
	
	}else{
	include 'include_pages/document_head.php';
	
?>
	<script src="<?=SURL?>js/ajax_script-2.js?ver=<?=$BCPV?>"></script>
    <script src="<?=SURL?>js/js_functions-2.js?ver=<?=$BCPV?>"></script>
    <script src="<?=SURL?>js/encoder.js?ver=<?=$BCPV?>"></script>

	<?php include("include_pages/boxex_inc.php"); ?>
  
    <?php include 'include_pages/sidebar.php'?>

    <?php include("include_pages/index_new_inc.php"); ?>
   	<?php } ?>
          
	<script type="text/javascript">
	/* -------------------------------- 		*/
	/* Developed & Analyzed By : KHL	*/
	/* -------------------------------- 		*/	
        var frms = document.forms;
        for(var i=0;i<frms.length;i++){
            if(!(frms.item(i).className.match(/exit/i))){
                frms.item(i).onsubmit = valdateForums;
            }
        }
        setObject(document.getElementsByTagName("input"));
        setObject(document.getElementsByTagName("textarea"));
    </script>

    	 
<?php
if($_REQUEST['action']=='dashboard'){
 include('include_pages/closing_items.php');
}else{
	include('include_pages/closing_items.php'); 
	}?>
    
    
    </div></div>