<!doctype html>
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
    <!--<link rel="stylesheet" href="styles/vendor/select2/select2.css"> -->
    	<link rel="icon" href="<?php echo SURL; ?>images/favconblack.png" type="image/x-icon" />

    <!-- Fonts CSS: -->
    <link rel="stylesheet" href="styles/font-awesome.css" type="text/css" />
    <link rel="stylesheet" href="styles/font-titillium.css" type="text/css" />
           
    <link href="<?php echo SURL; ?>dashboard/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/components.min.css?v1=1.1" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/colors.min.css" rel="stylesheet" type="text/css">
        
        
        <!-- Page-specific Plugin CSS: -->
        <link rel="stylesheet" href="styles/jquery.mCustomScrollbar.min.css">
        <link rel="stylesheet" href="styles/vendor/jquery.pnotify.default.css">

        <!-- Proton CSS: -->
        <link rel="stylesheet" href="styles/proton.css?v1=1.1">
        <link rel="stylesheet" href="styles/vendor/animate.css">
         <link rel="stylesheet" href="styles/my-style.css?v1=1.1">

        <!-- adds CSS media query support to IE8   -->
        <!--[if lt IE 9]>
            <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
            <script src="scripts/vendor/respond.min.js"></script>
        <![endif]-->


        <!-- Common Scripts: -->
        <script> var SURL = "<?php echo SURL;?>";</script>
      
	    <script type="text/javascript" src="scripts/jquery-latest.js"></script>
        <?php if($LEVEL==4){?>
 <script type="text/javascript">
<!--
    var LiveHelpSettings = {};
    LiveHelpSettings.server = 'http://backcheckgroup.com/support/modules/';
    LiveHelpSettings.embedded = true;
    (function($) { 
        // JavaScript
        LiveHelpSettings.server = LiveHelpSettings.server.replace(/[a-z][a-z0-9+\-.]*:\/\/|\/livehelp\/*(\/|[a-z0-9\-._~%!$&'()*+,;=:@\/]*(?![a-z0-9\-._~%!$&'()*+,;=:@]))|\/*$/g, '');
        var LiveHelp = document.createElement('script'); LiveHelp.type = 'text/javascript'; LiveHelp.async = true;
        LiveHelp.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + LiveHelpSettings.server + '/livehelp/scripts/jquery.livehelp.min.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(LiveHelp, s);
    })(jQuery);
-->


</script>   
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-61081829-15', 'auto');
  ga('send', 'pageview');

</script>

<?php } ?>      
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
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/loaders/pace.min.js"></script>
    
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/loaders/blockui.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/ui/nicescroll.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/ui/drilldown.js"></script>
   	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/ui/fab.min.js"></script>

	<!-- /core JS files -->

  		<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/forms/wizards/steps.min.js"></script>
	
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/core/libraries/jasny_bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/forms/validation/validate.min.js"></script>
   	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/starters/assets/js/plugins/ui/nicescroll.min.js"></script>
    <script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/media/fancybox.min.js"></script>
    <script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/core/libraries/jquery_ui/datepicker.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/core/libraries/jquery_ui/effects.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/pickers/anytime.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/pickers/pickadate/picker.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/pickers/pickadate/picker.time.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/pickers/pickadate/legacy.js"></script>
    <script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/notifications/pnotify.min.js"></script>

	
 <script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>
 <script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/forms/inputs/typeahead/handlebars.js"></script>
            


	
<?php /*?>	<script type="text/javascript" src="<?php echo SURL; ?>/js/plugins/uploaders/fileinput.min.js"></script>
<?php */?>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/pages/wizard_steps.js"></script>
    <script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/pages/user_pages_team.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/pages/picker_date.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/notifications/jgrowl.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/pages/components_notifications_pnotify.js"></script>

	<script type="text/javascript">
	 var substringMatcher = '';
	 var states ='';
	 $(function() {
		 
		  // Substring matches<h6></h6>
  substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {

                    // the typeahead jQuery plugin expects suggestions to a
                    // JavaScript object, refer to typeahead docs for more info
                    matches.push({ value: str });
                }
            });

            cb(matches);
        };
    };
      // Add data
	  
	 <?php
                            $Fields = $db->select("uni_info","*",'1=1');
							$total = mysql_num_rows($Fields);
							$asd = 0;
							$dataxxs = array();
                             while($unis = mysql_fetch_array($Fields))
                            { 
							if($asd != $total){$coma = ',';}else{$coma = '';}
                            $dataxxs[] = "'".addslashes($unis['uni_Name'])."'";
							$asd++;
                            }
							 //print_r($dataxxs); 
                            ?> 
	  <?php //$axxxxsd = implode(',',$dataxxs);    
	  $savvionIANames = getAllSavvionIANames();
	  if(is_array($savvionIANames) && !empty($savvionIANames)){
	  //$dataxxs = array_merge($dataxxs,$savvionIANames);
	  }
	  ?>
      states = [<?php echo implode(',',$dataxxs);?>
    ];


/*    var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
        'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
        'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
        'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
        'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
        'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
        'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
        'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
        'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
    ];*/

    // Initialize
    $('.typeahead-basic').typeahead(
        {
            //hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'states',
            displayKey: 'value',
            source: substringMatcher(states)
        }
    );

     });

     function tesxx(cc)
	 {
		     $('.typeahead-basic_edu'+cc).typeahead(
        {
           // hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'states',
            displayKey: 'value',
            source: substringMatcher(states)
        }
    );

		 }
		 
		 
		 
		 
	 var substringMatcher2 = '';
	 var states2 ='';
	 $(function() {
		 
		  // Substring matches<h6></h6>
  substringMatcher2 = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {

                    // the typeahead jQuery plugin expects suggestions to a
                    // JavaScript object, refer to typeahead docs for more info
                    matches.push({ value: str });
                }
            });

            cb(matches);
        };
    };
      // Add data
	  
	 <?php
                            $Fields = $db->select("comp_info","cname",'1=1 group by cname');
							$total = mysql_num_rows($Fields);
							$asd = 0;
							$dataxxs = array();
                             while($unis = mysql_fetch_array($Fields))
                            { 
							if($asd != $total){$coma = ',';}else{$coma = '';}
                            $dataxxs[] = "'".addslashes($unis['cname'])."'";
							$asd++;
                            }
							 //print_r($dataxxs); 
                            ?> 
	  <?php //$axxxxsd = implode(',',$dataxxs);?>
      states2 = [<?php echo implode(',',$dataxxs);?>
    ];


 

    // Initialize
    $('.typeahead-basic2').typeahead(
        {
            //hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'states2',
            displayKey: 'value',
            source: substringMatcher2(states2)
        }
    );

     });
      function tesxx2(cc)
	 {
		     $('.typeahead-basic_emp'+cc).typeahead(
        {
           // hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'states2',
            displayKey: 'value',
            source: substringMatcher2(states2)
        }
    );

		 }
		 
		 
		 
		 
     </script>
        
  <script src="<?php echo SURL; ?>js/viewportchecker.js"></script>

	<script>
        $(document).ready(function() {
        $('.timeline-row').addClass("hidden-timeline").viewportChecker({
            classToAdd: 'visible-timeline animated fadeInDown',
            offset: 100
           });
    });
    </script>

<?php /*?>	<script type="text/javascript" src="<?php echo SURL; ?>/js/pages/uploader_bootstrap.js"></script>
<?php */?>	<!-- /theme JS files -->

<style>
	.hidden-timeline{
		opacity:0;
	}
	.visible-timeline{
		 opacity:1;
	}
</style>
		 
    </head>
	<body class="dashboard-page sidebar-xs has-detached-left" style="overflow-x:hidden">
	
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
        <section> <div id="open_ticket_response" class="modal fade" tabindex="-1"></div>