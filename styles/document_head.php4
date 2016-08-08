<!DOCTYPE HTML>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7 lt-ie10"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8 lt-ie10"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php if($LEVEL==4) $PTITLE = str_replace("Case",APPLICANT,$PTITLE);?>
       <title><?=$PTITLE?> | <?=PORTAL?> </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		<?php define(DURL,'http://backgroundcheck.global/verify/dashboard/assets'); ?>
        
    <link rel="stylesheet" href="styles/vendor/select2/select2.css"> 

    <!-- Fonts CSS: -->
    <link rel="stylesheet" href="styles/font-awesome.css" type="text/css" />
    <link rel="stylesheet" href="styles/font-titillium.css" type="text/css" />
           
    <link href="<?php echo DURL; ?>/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo DURL; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    
	<link href="<?php echo DURL; ?>/css/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo DURL; ?>/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo DURL; ?>/css/colors.min.css" rel="stylesheet" type="text/css">
        
        
        <!-- Page-specific Plugin CSS: -->
        <link rel="stylesheet" href="styles/vendor/jquery.pnotify.default.css">

        <!-- Proton CSS: -->
        <link rel="stylesheet" href="styles/proton.css">
        <link rel="stylesheet" href="styles/vendor/animate.css">

        <!-- adds CSS media query support to IE8   -->
        <!--[if lt IE 9]>
            <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
            <script src="scripts/vendor/respond.min.js"></script>
        <![endif]-->


        <!-- Common Scripts: -->
        <script> var SURL = "<?php echo SURL;?>";</script>
      
    <script type="text/javascript" src="<?php echo DURL; ?>/js/core/libraries/jquery.min.js"></script>
        
        <script src="scripts/vendor/modernizr.js"></script>
        <script src="scripts/vendor/jquery.cookie.js"></script>
        
                
           
       
         <?php /*?><link rel="stylesheet" type="text/css" href="styles/new_css.css?ver=<?=$BCPV?>"><?php */ 
		 
		 if($_REQUEST['action']=='add' && $_REQUEST['atype']=='newcase' && $_REQUEST['case']!='' ){ //=add&atype=newcase
		 ?>
		 <link rel="stylesheet" href="css/jquery.fileupload.css">
		<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
		<script src="js/jquery.ui.widget.js"></script>
	

		<script src="js/jquery.iframe-transport.js"></script>
		<!-- The basic File Upload plugin -->
		<script src="js/jquery.fileupload.js"></script>
		<!-- The File Upload processing plugin -->
		<script src="js/jquery.fileupload-process.js"></script>
		<!-- The File Upload image preview & resize plugin -->
		<script src="js/jquery.fileupload-image.js"></script>
		<!-- The File Upload audio preview plugin -->
		<script src="js/jquery.fileupload-audio.js"></script>
		<!-- The File Upload video preview plugin -->
		<script src="js/jquery.fileupload-video.js"></script>
		<!-- The File Upload validation plugin -->
		<script src="js/jquery.fileupload-validate.js"></script>
		 
		
		 <?php } ?>
         
         
         <script src="scripts/highchart/highcharts.js"></script>
         <script src="scripts/highchart/data.js"></script>
         <script src="scripts/highchart/drilldown.js"></script>
         <script src="scripts/highchart/exporting.js"></script>
	    
        <!-- Core JS files -->	
<script type="text/javascript" src="<?php echo DURL; ?>/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo DURL; ?>/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo DURL; ?>/js/plugins/loaders/blockui.min.js"></script>
	<script type="text/javascript" src="<?php echo DURL; ?>/js/plugins/ui/nicescroll.min.js"></script>
	<script type="text/javascript" src="<?php echo DURL; ?>/js/plugins/ui/drilldown.js"></script>
	<!-- /core JS files -->
	 
  		<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo DURL; ?>/js/plugins/forms/wizards/steps.min.js"></script>
	<script type="text/javascript" src="<?php echo DURL; ?>/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo DURL; ?>/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo DURL; ?>/js/core/libraries/jasny_bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo DURL; ?>/js/plugins/forms/validation/validate.min.js"></script>
	<script type="text/javascript" src="<?php echo DURL; ?>/js/plugins/uploaders/fileinput.min.js"></script>

	<script type="text/javascript" src="<?php echo DURL; ?>/js/core/app.js"></script>
	
	<script type="text/javascript" src="<?php echo DURL; ?>/js/pages/wizard_steps.js"></script>
	<script type="text/javascript" src="<?php echo DURL; ?>/js/pages/uploader_bootstrap.js"></script>

	<!-- /theme JS files -->
		 
		 
    </head>
	<body class="dashboard-page">
	
            <script>
	        var theme = $.cookie('protonTheme') || 'default';
	        $('body').removeClass (function (index, css) {
	            return (css.match (/\btheme-\S+/g) || []).join(' ');
	        });
	        if (theme !== 'default') $('body').addClass(theme);
        </script>
        <!--[if lt IE 8]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!--<section class="wrapper scrollable">-->
        <?php //include('include_pages/navigation_main.php');?>
        <section class="wrapper scrollable">