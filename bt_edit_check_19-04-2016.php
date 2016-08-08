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
 
<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/loaders/blockui.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/core/libraries/jasny_bootstrap.min.js"></script>



<script src="<?php echo SURL; ?>js/ajax_script-2.js?ver=3.4"></script>
<script src="<?php echo SURL; ?>js/js_functions-2.js?ver=3.4"></script>
<script src="<?php echo SURL; ?>js/encoder.js?ver=3.4"></script>
        
        
        </head>
<?php
//$v_id = 11492;
//$_REQUEST['ascase'] = $_REQUEST['ascase'];
//$_REQUEST['case'] = $v_id;

include ('include_pages/boxex_inc.php');
?>
		

	

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
<script src="<?php echo SURL;?>js/jquery.mCustomScrollbar.js"></script>
 <script type="text/javascript">
    (function(jQuery){
        jQuery(window).load(function(){
            jQuery("body").mCustomScrollbar({
				theme:"light-3",
				mouseWheel:{scrollAmount:188},		
	});
        });
		/* var metainfo = '<meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge">';
		$('head', window.frames['tabsFrame'].document).append(metainfo); */
    })(jQuery);
	
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