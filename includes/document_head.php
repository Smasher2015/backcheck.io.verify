<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7 lt-ie10"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8 lt-ie10"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
       <title><?=$PTITLE?> | <?=PORTAL?> </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic,900,900italic,300italic,300,100italic,100' rel='stylesheet' type='text/css'>
        <link href="<?php echo SURL; ?>dashboard/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="<?php echo SURL; ?>dashboard/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo SURL; ?>dashboard/assets/css/core.min.css?v1=1.1" rel="stylesheet" type="text/css">
        <link href="<?php echo SURL; ?>dashboard/assets/css/components.min.css?v1=1.1" rel="stylesheet" type="text/css">
        <link href="<?php echo SURL; ?>dashboard/assets/css/colors.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo SURL; ?>dashboard/assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
     
        <!-- Page-specific Plugin CSS: -->
        <link rel="stylesheet" href="styles/vendor/jquery.pnotify.default.css">
        <link rel="stylesheet" href="styles/vendor/select2/select2.css">


        <!-- Proton CSS: -->
        <link rel="stylesheet" href="styles/proton.css?v1=1.1">
        <link rel="stylesheet" href="styles/vendor/animate.css">
         <link rel="stylesheet" href="styles/my-style.css?v1=1.1">

        <!-- adds CSS media query support to IE8   -->
        <!--[if lt IE 9]>
            <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
            <script src="scripts/vendor/respond.min.js"></script>
        <![endif]-->

        <!-- Fonts CSS: -->
       <style>
       	a{text-shadow:1px 1px 1px #000;}
       </style>
	
        <!-- Common Scripts: -->
        <script>
        (function () {
          var js;
          if (typeof JSON !== 'undefined' && 'querySelector' in document && 'addEventListener' in window) {
            js = 'https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js';
          } else {
            js = 'https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js';
          }
          document.write('<script src="' + js + '"><\/script>');
        }());
        </script>
        <script src="scripts/vendor/modernizr.js"></script>
        <script src="scripts/vendor/jquery.cookie.js"></script>
         <?php /*?><link rel="stylesheet" type="text/css" href="styles/new_css.css?ver=<?=$BCPV?>"><?php */
		 	switch(date('w'))
			 {
			  case '1':
			  $src="images/logbg2.jpg";
			   //Monday
			   break;
			  case '2':
			  $src="images/loginchang3.jpg";
			   //Tuesday:
			   break;
			    case '3':
				$src="images/loginchang2.jpg";
			   //Wednesday:
			   break;
			    case '4':
				$src="images/loginchang4.jpg";
			   //Thursday:
			   break;
			    case '5':
				$src="images/loginchang5.jpg";
			   //Friday:
			   break;
			    case '6':
				$src="images/loginchang6.jpg";
			   //Saturday:
			   break;
			    case '0':
				$src="images/loginchang7.jpg";
			   //Sunday:
			   break;
			
			}
		 
		 ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-61081829-15', 'auto');
  ga('send', 'pageview');

</script>
    </head>
	<body class="login-page login-bg" style="background-image: url(<?=$src?>)">
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