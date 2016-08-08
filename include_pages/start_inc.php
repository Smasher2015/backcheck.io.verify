<div id="main_container" class="main_container container_16 clearfix">
      <?php
if(is_numeric($_REQUEST['ascase'])){
	$check = $_REQUEST['check'];
	
	if($LEVEL==2 || $LEVEL==3 || $LEVEL_TL==12){	
		if(isset($_REQUEST['daction'])){
			if($_REQUEST['daction']=='delete'){
				if(is_numeric($_REQUEST['datav'])){
					edData($_REQUEST['datav'],$_REQUEST['daction']);
				}
			}
		}	
	}
	if($LEVEL==2 || $LEVEL==4){
		$where = "vc.as_id=$_REQUEST[ascase]";
	}else{
		$where = "user_id=$_SESSION[user_id] AND vc.as_id=$_REQUEST[ascase]";
	}		

	$verCheck = checkDetails($_REQUEST['case'],'',$where);
	$verCheck = mysql_fetch_array($verCheck);
	if(isset($_REQUEST['checksub'])){
		if((strtolower($verCheck['as_vstatus'])=='not initiated') && strtolower($verCheck['as_status'])=='open'){
			if(updateCheck($verCheck['as_id'],"as_vstatus='Initiated'")){
				$verCheck['as_vstatus']='Initiated';
			}
		}
	}	
	$UserInfo = getUserInfo($verCheck['user_id']);
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
	<div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title2">
                    	<h4><i class="icon-arrow-left52 position-left"></i> Check Detail </h4>
                    </div>
                    </div>
                    </div>


  <div class="content">
    <div>
<?php include("include_pages/basic_info_inc.php"); ?>

<?php include("include_pages/list_checks_inc.php"); ?>

<?php if($LEVEL==2 || $LEVEL==3 || $LEVEL==12){
		if($UserInfo){
			// if user id soecial analyst id jameel
			
			
			include("include_pages/check_inc.php");	
			
	  	}
	  }
?>  
<?php include("include_pages/comments_inc.php"); ?> 

<?php 	}else{ 
			include("include_pages/access_inc.php");
		} ?>                                            
       </div>
  <div style="clear:both"></div>     
<script>
	$(document).ready( function(){
	
	$( "#sweet_basic" ).click(function() {
	
		$( "#sweet_basic_s" ).toggle('drop', {direction: 'up'}, 150 );
});
	$( "#canecl" ).click(function() {
	
				$( "#sweet_basic_s" ).hide('drop', {direction: 'up'}, 150 );
});

});
</script>