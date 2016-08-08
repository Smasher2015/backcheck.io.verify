<!doctype html public "✰">
<!--[if lt IE 7]> <html lang="en-us" class="no-js ie6"> <![endif]-->
<!--[if IE 7]>    <html lang="en-us" class="no-js ie7"> <![endif]-->
<!--[if IE 8]>    <html lang="en-us" class="no-js ie8"> <![endif]-->
<!--[if IE 9]>    <html lang="en-us" class="no-js ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en-us" class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		
		<title><?=$PTITLE?> | <?=PORTAL?> </title>

	<!-- iPhone, iPad and Android specific settings -->	
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1;">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		<link rel="apple-touch-icon" href="images/iOS_icon.png">
		<link rel="apple-touch-startup-image" href="images/iOS_startup.png">
				
	<!-- Styles -->

		<link rel="stylesheet" type="text/css" href="styles/reset.css?ver=<?=$BCPV?>">
			<!-- <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700"> -->
		
		<link rel="stylesheet" type="text/css" href="scripts/fancybox/jquery.fancybox-1.3.4.css">
		<link rel="stylesheet" type="text/css" href="scripts/tinyeditor/style.css">
		<link rel="stylesheet" type="text/css" href="scripts/slidernav/slidernav.css">
		<link rel="stylesheet" type="text/css" href="scripts/syntax_highlighter/styles/shCore.css">
		<link rel="stylesheet" type="text/css" href="scripts/syntax_highlighter/styles/shThemeDefault.css">
		<link rel="stylesheet" type="text/css" href="scripts/uitotop/css/ui.totop.css">
		<link rel="stylesheet" type="text/css" href="scripts/fullcalendar/fullcalendar.css">
		<link rel="stylesheet" type="text/css" href="scripts/isotope/isotope.css">
		<link rel="stylesheet" type="text/css" href="scripts/elfinder/css/elfinder.css">
		
		<link rel="stylesheet" type="text/css" href="scripts/tiptip/tipTip.css">
		<link rel="stylesheet" type="text/css" href="scripts/uniform/css/uniform.aristo.css">
		<link rel="stylesheet" type="text/css" href="scripts/multiselect/css/ui.multiselect.css">
		<link rel="stylesheet" type="text/css" href="scripts/selectbox/jquery.selectBox.css">
		<link rel="stylesheet" type="text/css" href="scripts/colorpicker/css/colorpicker.css">
		<link rel="stylesheet" type="text/css" href="scripts/uistars/jquery.ui.stars.min.css">
		
		<link rel="stylesheet" type="text/css" href="scripts/themeroller/Aristo.css">
		
		<link rel="stylesheet" type="text/css" href="styles/text.css">
		<link rel="stylesheet" type="text/css" href="styles/grid.css">
		<link rel="stylesheet" type="text/css" href="styles/main.css">
		<link rel="stylesheet" type="text/css" href="styles/theme/theme_base.css?ver=<?=$BCPV?>">

		<!-- Style Switcher  
		
		The following stylesheet links are used by the styleswitcher to allow for dynamically changing how Adminica looks and acts.
		Styleswitcher documentation: http://style-switcher.webfactoryltd.com/documentation/
		
		switcher1.php : layout - fluid by default.								(eg. styles/theme/switcher1.php?default=layout_fixed.css)
		switcher2.php : header and sidebar positioning - sidebar by default.	(eg. styles/theme/switcher1.php?default=header_top.css)
		switcher3.php : colour skin - black/grey by default.					(eg. styles/theme/switcher1.php?default=theme_red.css)
		switcher4.php : background image - dark boxes by default.				(eg. styles/theme/switcher1.php?default=bg_honeycomb.css)
		switcher5.php : controls the theme - dark by default.					(eg. styles/theme/switcher1.php?default=theme_light.css)
		
		-->
		<link rel="stylesheet" type="text/css" href="styles/theme/switcher.css" media="screen">
		<link rel="stylesheet" type="text/css" href="styles/theme/switcher1.php?default=switcher.css" media="screen" > 
		<link rel="stylesheet" type="text/css" href="styles/theme/switcher2.php?default=switcher.css" media="screen" >
        
		<link rel="stylesheet" type="text/css" href="styles/theme/switcher3.php?default=theme_red.css" media="screen" >
		<link rel="stylesheet" type="text/css" href="styles/theme/switcher4.php?default=bg_wood.css" media="screen" >
		<link rel="stylesheet" type="text/css" href="styles/theme/switcher5.php?default=switcher.css" media="screen" >
		
		<link rel="stylesheet" type="text/css" href="styles/colours.css">
		<link rel="stylesheet" type="text/css" href="styles/ie.css">
        <link rel="stylesheet" type="text/css" href="css/new_css.css?ver=<?=$BCPV?>">
		
	<!-- Scripts -->

		<!-- Load JQuery -->		
		<script src="js/jquery.min.js" type="text/javascript"></script>

		<!-- Load JQuery UI -->
		<script src="js/jquery-ui.min.js" type="text/javascript"></script>
		
		<!-- Global -->
		<script src="scripts/touchPunch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
		<script src="scripts/uitotop/js/jquery.ui.totop.js" type="text/javascript"></script>
				
        <!--bar-->
        <!--<script type="text/javascript" src="js/prototype.js"></script>
		<script type="text/javascript" src="js/jsProgressBarHandler.js"></script>-->
        
		<!-- Forms -->
		<script src="scripts/uniform/jquery.uniform.min.js"></script>
		<script src="scripts/autogrow/jquery.autogrowtextarea.js"></script>
		<script src="scripts/multiselect/js/ui.multiselect.js"></script>
		<script src="scripts/selectbox/jquery.selectBox.min.js"></script>
		<script src="scripts/timepicker/jquery.timepicker.js"></script>
		<script src="scripts/colorpicker/js/colorpicker.js"></script>
		<script src="scripts/uistars/jquery.ui.stars.min.js"></script>
		<script src="scripts/tiptip/jquery.tipTip.minified.js"></script>
		<script src="scripts/validation/jquery.validate.min.js" type="text/javascript"></script>	
        <script src="scripts/rss/jquery.zrssfeed.min.js" type="text/javascript"></script>	

		<!-- Configuration Script -->
		<script type="text/javascript" src="scripts/adminica/adminica_ui.js"></script>
		<script type="text/javascript" src="scripts/adminica/adminica_forms.js"></script>
		<script type="text/javascript" src="scripts/adminica/adminica_mobile.js"></script>
		
        <!-- tooltip css and jquery !-->
        <script type="text/javascript" src="scripts/tiptip/jquery.tipTip.js"></script>
		<script type="text/javascript" src="scripts/tiptip/jquery.tipTip.minified.js"></script>
		<script type="text/javascript" src="scripts/tiptip/tipTip.css"></script>
		 <!-- tooltip css and jquery !-->
	</head>
	<body>