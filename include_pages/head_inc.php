    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Dataflow Group - Verification Management and Information System</title>
    <meta name="description" content="">	
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <?php /*?><link rel="stylesheet" href="<?php echo SURL; ?>css/new_css.css?var=4"><?php */?>
    <script src="<?php echo SURL; ?>js/ajax_script.js?var=3"></script> 
    <script src="<?php echo SURL; ?>js/encoder.js?var=3"></script>
    <script src="<?php echo SURL; ?>js/js_functions.js?var=3"></script>
    <script type="text/javascript">
	<!--<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>-->
<?php
    if(!isset($_SESSION['BR'])) $_SESSION['BR'] = browserInf();
	if($_SESSION['BR']=='IE'){ 	?>
	<script src="<?php echo SURL; ?>js/libs/modernizr-1.7.min.js?var=3"></script> 
<?php } ?>

<?php if($action!='login' && $action!='changepass'){?>  	
  	<link rel="stylesheet" href="<?php echo SURL; ?>css/style.css?var=3">
<?php } ?>
    <link rel="stylesheet" href="<?php echo SURL; ?>css/colors.css?var=3">
    
    