 <?php  include('include/config.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
	.page{ 
		 
		width:1105px;
		min-height:770px; 
		
		background:url('images/rd-certificate-BG.png') no-repeat center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
  
		border:1px solid #ccc;
		
		font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
		position:relative;
	}
	.clear{ clear:both;}
	.alignright{ text-align:right;}
		/* top bar*/
	.green, .lightgreen, .red, .lightred{ height:15px; float:left;}
	 ul.topbar{ padding:0; margin:0;}
	 ul.topbar li{ margin:0; display:inline-block; width:25%;} 
	.green{ background-color:#00713d;}
	.lightgreen{background-color:#118a61;}
	.red{background-color:#8c0b05;}
	.lightred{background-color:#e41b23;}
	ul.rd-ref li{ list-style:none;}
	ul.rd-ref li span{ color:#666; }
	ul.rd-ref li:first-child{ margin-bottom:15px;}
	/* top bar*/
	
	/* header section*/
	.rep-logo{background:url('images/rd-report-logo.png');}
	.halfwidth{ width:48%; margin-right:1%; float:left;}
	.largheading{ font-size:48px; color:#ffffff; background:#000; text-align:center;}
	/* header section*/
	/* body section*/
	.certifytxt{ 
	width:100%;
	text-align:center;
	font-size:20px;
	color:#666666;
	font-family:Arial, 'Helvetica', sans-serif;
	 }
	 .certifynam{
	width:100%;
	text-align:center;
	font-size:32px;
	color:#006633;	
	font-family:Arial, 'Helvetica', sans-serif;
	}
	
	.certifybag{
	width:100%;
	text-align:center;
	font-size:32px;
	color:#000000;	
	font-family:Arial, 'Helvetica', sans-serif;
	}
	
	.certifytxt span{ color:#000000;}
	
	/* body section*/
	
	.pinfor{ width:60%; margin:auto; font-style:italic; color:#666666; font-size:22px; border-top:2px solid #ccc; border-bottom:2px solid #ccc; padding-top:10px; padding-bottom:10px;}
	.pinfor table tr td{ padding-bottom:10px;}
	img.seal{ position:absolute; right:15px; bottom:75px;}
	/*footer area*/
	.repfooter{ background:#8c0b05; position:absolute; bottom:0; width:100%;}
	.repfooter ul{ padding:0; margin:0;}
	.repfooter li{ float:left; list-style:none; font-size:14px; text-align:center; color:#ffffff; padding:10px 5px;} 
	.phone{ width:20%;}
	.email{ width:25%; }
	.web{ width:50%;}
	.web span{}
</style>
</head>

<body>
	<?php include("include_pages/certificate_inc.php")?>
</body>
</html>
