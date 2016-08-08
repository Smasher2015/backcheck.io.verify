<?php include ('include/config.php');
include ('include/config_actions.php');
?><head> <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="<?php echo SURL; ?>dashboard/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/colors.min.css" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" href="<?php echo SURL; ?>styles/jquery.mCustomScrollbar.min.css">
    
    <link href="<?php echo SURL; ?>styles/proton.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>styles/bt_chcks.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
	<script> var SURL = "<?php echo SURL;?>";</script>
 <script type="text/javascript" src="<?php echo SURL;?>scripts/jquery-latest.js"></script>
 <script type="text/javascript" src="<?php echo SURL;?>js/jquery.scrollbar.min.js"></script>
 <script type="text/javascript">
jQuery(document).ready(function(){
   jQuery('.scrollbar-inner').scrollbar();
});
</script>
<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/loaders/blockui.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/core/libraries/jasny_bootstrap.min.js"></script>



<script src="<?php echo SURL; ?>js/ajax_script-2.js?ver=3.4"></script>
<script src="<?php echo SURL; ?>js/js_functions-2.js?ver=3.4"></script>
<script src="<?php echo SURL; ?>js/encoder.js?ver=3.4"></script>

<style>
/*************** SCROLLBAR BASE CSS ***************/
 
.scroll-wrapper {
    overflow: hidden !important;
    padding: 0 !important;
    position: relative;
}
 
.scroll-wrapper > .scroll-content {
    border: none !important;
    box-sizing: content-box !important;
    height: auto;
	max-height:1600px !important;
    left: 0;
    margin: 0;
    max-height: none;
    max-width: none !important;
    overflow: scroll !important;
    padding: 0;
    position: relative !important;
    top: 0;
    width: auto !important;
}
 
.scroll-wrapper > .scroll-content::-webkit-scrollbar {
    height: 0;
    width: 0;
}
 
.scroll-element {
    display: none;
}
.scroll-element, .scroll-element div {
    box-sizing: content-box;
}
 
.scroll-element.scroll-x.scroll-scrollx_visible,
.scroll-element.scroll-y.scroll-scrolly_visible {
    display: block;
}
 
.scroll-element .scroll-bar,
.scroll-element .scroll-arrow {
    cursor: default;
}
 
.scroll-textarea {
    border: 1px solid #cccccc;
    border-top-color: #999999;
}
.scroll-textarea > .scroll-content {
    overflow: hidden !important;
}
.scroll-textarea > .scroll-content > textarea {
    border: none !important;
    box-sizing: border-box;
    height: 100% !important;
    margin: 0;
    max-height: none !important;
    max-width: none !important;
    overflow: scroll !important;
    outline: none;
    padding: 2px;
    position: relative !important;
    top: 0;
    width: 100% !important;
}
.scroll-textarea > .scroll-content > textarea::-webkit-scrollbar {
    height: 0;
    width: 0;
}
 
 
 
 
/*************** SIMPLE INNER SCROLLBAR ***************/
 
.scrollbar-inner > .scroll-element,
.scrollbar-inner > .scroll-element div
{
    border: none;
    margin: 0;
    padding: 0;
    position: absolute;
    z-index: 10;
}
 
.scrollbar-inner > .scroll-element div {
    display: block;
    height: 100%;
    left: 0;
    top: 0;
    width: 100%;
}
 
.scrollbar-inner > .scroll-element.scroll-x {
    bottom: 2px;
    height: 8px;
    left: 0;
    width: 100%;
}
 
.scrollbar-inner > .scroll-element.scroll-y {
    height: 100%;
    right: 2px;
    top: 0;
    width: 8px;
}
 
.scrollbar-inner > .scroll-element .scroll-element_outer {
    overflow: hidden;
}
 
.scrollbar-inner > .scroll-element .scroll-element_outer,
.scrollbar-inner > .scroll-element .scroll-element_track,
.scrollbar-inner > .scroll-element .scroll-bar {
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
}
 
.scrollbar-inner > .scroll-element .scroll-element_track,
.scrollbar-inner > .scroll-element .scroll-bar {
    -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=40)";
    filter: alpha(opacity=40);
    opacity: 0.4;
}
 
.scrollbar-inner > .scroll-element .scroll-element_track { background-color: #e0e0e0; }
.scrollbar-inner > .scroll-element .scroll-bar { background-color: #c2c2c2; }
.scrollbar-inner > .scroll-element:hover .scroll-bar { background-color: #919191; }
.scrollbar-inner > .scroll-element.scroll-draggable .scroll-bar { background-color: #919191; }
 
 
/* update scrollbar offset if both scrolls are visible */
 
.scrollbar-inner > .scroll-element.scroll-x.scroll-scrolly_visible .scroll-element_track { left: -12px; }
.scrollbar-inner > .scroll-element.scroll-y.scroll-scrollx_visible .scroll-element_track { top: -12px; }
 
 
.scrollbar-inner > .scroll-element.scroll-x.scroll-scrolly_visible .scroll-element_size { left: -12px; }
.scrollbar-inner > .scroll-element.scroll-y.scroll-scrollx_visible .scroll-element_size { top: -12px; }

</style>
        
        </head>
<?php
//$v_id = 11492;
//$_REQUEST['ascase'] = $_REQUEST['ascase'];
//$_REQUEST['case'] = $v_id;

include ('include_pages/boxex_inc.php');
?>
		

	

<div id="main_container" class="main_container container_16 clearfix scrollbar-inner" style="height:1600px; overflow:auto;">
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
  <div class="row">
    <div class="col-md-12">
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
			//include("include_pages/access_inc.php");
		} ?>                                            
       </div>
  <div style="clear:both"></div> </div></section></div>   
  
  
  <!-- Page-specific scripts: -->
        <!--<script src="scripts/proton/graphsStats.js"></script>-->
        <!-- Page-specific scripts: -->
        
		
		<script src="<?php echo SURL; ?>scripts/main.js"></script>
        <script src="<?php echo SURL; ?>scripts/proton/common.js"></script>
         
        <!-- Page-specific scripts: -->
      	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

        <script src="<?php echo SURL; ?>scripts/proton/dashboard.js"></script>
        <script src="<?php echo SURL; ?>scripts/proton/dashdemo.js"></script>
               
        <!-- Notifications -->
        <!-- http://pinesframework.org/pnotify/ -->
        <script src="<?php echo SURL; ?>scripts/vendor/jquery.pnotify.min.js"></script>
     
<script type="text/javascript">
		
		 
			<?php if($_REQUEST['CNT']>0){
					if($_REQUEST['TERR']!='') { 
					foreach($_REQUEST['TERR'] as $ERR){?>
					   proton.dashboard.alerts('<?=$ERR?>','Error!','error');
			<?php 	}}
					if($_REQUEST['TSCS']!='') { 
					foreach($_REQUEST['TSCS'] as $SCS){?>
						 proton.dashboard.alerts('<?=$SCS?>','Success','success');
			<?php 	}}		
				   } ?>
				   
</script>
  
  
  
  


<script type="text/javascript">
  $('select').select2();
</script>

<script >

	function downloadPDF(url){
		var SURL = "<?php echo SURL;?>";
		var level = '<?php echo $LEVEL; ?>';
		var can_download_reports = '<?php echo $COMINF['can_download_reports']; ?>';
		
		if(level=='4' && can_download_reports=='1'){
		alertBox("Your report download feature is disabled due to non payment! <br /><br /> Please contact our  <a href='?action=adsupport&atype=support' target='_blank'>support</a> team.");
		return false; 
		}else{

		try{


			if(document.getElementById('pdfLoader')!= null){


				document.body.removeChild(document.getElementById('pdfLoader'));


			}


		}catch(err){}


		var ifrm = document.createElement('iframe');


		ifrm.style.display='none';

		ifrm.id = 'pdfLoader';

		ifrm.src = SURL+url;

		document.body.appendChild(ifrm);


		ifrm.onload = function() {
			var loader = document.getElementById('loading_overlay');

				loader.style.display='none';


				loader.getElementsByTagName('div').item(0).style.display='none';

	   }

			var loader = document.getElementById('loading_overlay');

			loader.style.display='block';

			loader.getElementsByTagName('div').item(0).style.display='block';

	}

	}


</script>