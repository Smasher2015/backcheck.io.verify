<div id="main_container" class="main_container container_16 clearfix">
      <?php
if(($_REQUEST['action']=="nadra_skipped")){
		
	$UserInfo = getUserInfo($_SESSION['user_id']);
	if($LEVEL==2){
		if($UserInfo){
			$uName = trim($UserInfo['first_name'].' '.$UserInfo['last_name']);
		}else{
			$uName="Not Assigned";	
		}						
		$dTitle="Analyst Name";
	}else{
		$uName = $verCheck['emp_id'].'-'.$verCheck['v_name'];
		$dTitle="Candidate Name";
	} 
?>
<section class="retracted">
  <div class="row">
    <div class="col-md-12">
<?php //include("include_pages/basic_info_inc.php"); ?>

<?php //include("include_pages/list_checks_inc.php"); ?>

<?php if($LEVEL==2 || $LEVEL==3 || $LEVEL==12){
		if($UserInfo){
			// if user id soecial analyst id jameel
			if($_SESSION['user_id']==262) {
			 include("include_pages/nadra_skipped_checks_inc.php");
			}else{
			include("include_pages/check_inc.php");	
			}
	  	}
	  }
?>  
<?php //include("include_pages/comments_inc.php"); ?> 

<?php 	}else{ 
			include("include_pages/access_inc.php");
		} ?>                                            
       </div>
  <div style="clear:both"></div>     
