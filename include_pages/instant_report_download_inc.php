<style>
@import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);
.header .inputs-txt {
	display: inline-block;
	width: 95%;
}
.header .inputs-txt input {
	width: 100% !important;
}
.header .inputs-img {
	display: inline-block;
}
.dash-pages input[type="image"] {
	width: 24px;
	display: inline-block;
}
.dash-pages .header {
	background: #FFF;
	padding: 10px;
}
ul.companyinfo li {
	display: table;
	font-size: 14px;
	line-height: 22px;
	margin-bottom: 14px;
}
.sideInputs {
	margin-bottom: 10px;
}
.love-count h1 {
	margin: 0;
	padding: 0;
}
.submit-button-container input[type="submit"]:disabled {
	background: #dddddd;
}
.inputs-img {
	width: 36px;
	height: 36px;
	background: url("/wp-content/themes/taskrocket/images/sprite.png");
	background-position: -1009px 0px;
	background-size: cover;
	-moz-transform: scaleX(-1);
	-o-transform: scaleX(-1);
	-webkit-transform: scaleX(-1);
	transform: scaleX(-1);
	filter: FlipH;
	-ms-filter: "FlipH";
	display: none;
}
.inputs-img input {
	background: none !important;
}
.search_overly {
	position: fixed;
	background: rgba(250,250,250,.9);
	left: 0;
	right: 0;
	top: 0;
	bottom: 0;
	z-index: 1000;
	display: none;
}
.search_overly .close_btn {
	position: absolute;
	right: 37px;
    top: 24px;
    /* width: 50px; */
    /* height: 50px; */
    /* font-size: 36px; */
    color: #b2b2b2;
}
.solvency_in{position:relative;}
.solvency_in img{width:100%; height:auto;}
.solvency_in span{    position: absolute;
    color: #333;
    font-weight: 700;
    font-size: 17px;
    top: -15px;}
.solvency_in span:after{    width: 1px;
    height: 36px;
    background: #fff;
    display: inline-block;
    content: "";
    position: absolute;
    top: 16px;
    left: 13px;}
.search_overly .close_btn i{font-size: 65px;}
.searchForms {
	/*width: 50%;
	max-height: 250px;
	margin: auto;
	position:absolute;
	left: 0;
	right: 0;
	top: 0;
	bottom: 0;
	*/
}
.searchForms{
	text-align:center;
	height: 100%;
	}
.search_overly .inputs-txt {
	font-size: 24px;
}
.search_overly .inputs-txt input {position: relative;z-index: 20;background-color: transparent;font-size: 40px;border: 0;-webkit-appearance: none;font-weight: 700;}

.search_overly .inputs-txt.w-select select{position: relative;float: left;width: 386px;height: 60px;border: none;margin-right: 40px;font-size: 40px;border: 0;background-color: transparent;-webkit-appearance: none;font-weight: 700;background-image: url("https://backcheckgroup.com/dashboard/wp-content/themes/taskrocket/images/downarrow.png");background-size: 34px;background-repeat: no-repeat;background-position: right 15px;}
.search_overly .inputs-txt.w-select select option{font-size:15px;}
.search_overly .inputs-txt.w-select input{width: auto;float: left;}

.slider .flex-direction-nav {
	display: none;
}
.flexslider-controls{
	margin-top:25px;
	}
ul.nav-tab li{
	text-align:center; 
	paddding:20px;
	display:inline-block;
	border-right: 1px solid #cccccc;	
	}
.searchForms ul.tabs{position: absolute;top: 24px;right: 100px;padding: 20px;z-index: 80;}
.searchForms .content_area{max-width: 1440px;padding: 30px;margin: 0 auto;vertical-align: middle;position: relative;top: 50%;-webkit-transform: translateY(-50%);-ms-transform: translateY(-50%);transform: translateY(-50%);transition: top 250ms ease-out,-webkit-transform 250ms ease-out;transition: top 250ms ease-out,transform 250ms ease-out;transition: top 250ms ease-out,transform 250ms ease-out,-webkit-transform 250ms ease-out;}
.searchForms ul.tabs li{display: inline;font-size: 22px;color: #a4afba;font-weight: 400;margin-right: 6px;cursor: pointer;}
.searchForms ul.tabs li:hover{color: #414042;}
.searchForms ul.tabs li.current{color: #414042;font-weight: 700;cursor: default;font-family: RobotoMedium;}
.searchForms .progressbar{ background:#ccc; width:100%; height:15px;}
.searchForms .progress{ background:#399; height:20px; width:0;}	
.searchForms .tab_content{ display:none;}
.searchForms .current{ display:inline-block !important;}
.searchForms .tab_content.current{display:block !important;}
.tab_content .searchform{width: 100%;text-align: left;}
.tab_content .searchform #s{width: 93.5%;font-size: 40px; padding:10px 0;}

.tab_content .searchform .advanced-cats {width: 95%;padding: 37px 18px 18px 18px;background: transparent;position: absolute;top: 50px;left: -21px;z-index: 20;border: 0;box-shadow: none;}
.tab_content .searchform .advanced-cats label{display: inline-block;font-size: 18px;font-weight: 700;padding: 5px 64px 4px 12px;}
.tab_content .searchform .advanced-cats .sep{display:inline-block;}
.tab_content .searchform .advanced-cats label:before{width: 12px;height: 12px;left: -6px;top: 8px;}
.tab_content .searchform .advanced-cats label.active:before{background-position: -60px 0;}
.tab_content .searchform #s:focus{background:transparent;}

.header .inputs-txt{
	display:inline-block;
	width:90%;
	}
.header .inputs-img{
	display:inline-block;
	}	

		
.dash-pages input[type="image"]{ width:24px; display:inline-block;}	
.dash-pages .header{
	background:#FFF;
	padding:10px;
	}
ul.companyinfo li{
	    display: table;
    font-size: 14px;
    line-height: 22px;
    margin-bottom: 14px;
	}
.sideInputs{ margin-bottom:10px;}
.love-count h1{ margin:0; padding:0;}
.submit-button-container input[type="submit"]:disabled {
    background: #dddddd;
}
.rpot-list .author{background: #358c8a;height: 40px;width: 40px;border-radius: 60%;color: #fff;font-size: 18px;text-align: center;vertical-align: middle;line-height: 40px;font-weight: 700;top: 27px;}
.rpot-list a{cursor:pointer;}

.report-page{width:100%;position:relative;font-size:12px; padding:13px; background:#fff; float:left;font-family: 'Montserrat', sans-serif;}
.report-page .head_logo{/*background: #f2f4f6;*/border-bottom: 4px solid #4e67c8;width: 100%;float: left;}
.report-page h1{font-weight: 400;font-size: 23px;color: #fff;background: #4e67c8;padding: 10px;float: left;width: 100%;margin-top: 20px;}
.report-page .add_rep{font-size:13px;color: #333;float: right;margin-bottom: 35px;vertical-align: middle;padding-top: 13px;width:100%; margin-top:0;}
.report-page .col-6{width:49%; float:left;}
.report-page .comp-no{float: right;padding-top: 6px;}
.report-page .pull-right{float:right;}
.report-page .logo{margin-left: 0;padding-top: 8px;width:316px;float:left;}
.report-page .logo img{float:left;width:74px;}
.report-page .accrd{border:1px solid #ccc; margin-bottom:20px;}
.report-page .accrd h5{    margin: 0;
    padding: 10px 25px;
    background: #f2f4f6;
    font-size: 15px;
    font-weight: 400;
    margin-bottom: 20px;
    border-bottom: 1px solid #4e67c8;color: #333;}
.report-page .accrd_inner{padding:0px 24px 10px;display:inline-block;}
.report-page .accrd_inner ul{margin: 0;padding: 0;font-size: 13px;list-style: none;font-weight: 400;color: #7e8385; display:inline-block;}
.report-page .accrd_inner ul li{background: transparent;border: none;font-size: 14px;padding: 0;padding-bottom: 10px;line-height: 24px; }
.report-page .accrd_inner ul li span{width: 198px;display:inline-block;}
.report-page .col-12{width:100%; float:left;}
.report-page .accrd_inner p{color: #7e8385;line-height: 18px;font-size: 12px;margin: 10px 0;}
.report-page .accrd_inner p.color-dark{color:#333 !important;font-size: 15px;}
.report-page .report-page .cover{background:url(../images/cover.png); height:100%;float:left;}
.report-page .logo_in{width: 242px;float: left;color: #808083;font-size: 12px;font-family: 'Montserrat', sans-serif;line-height: 16px;padding-top: 10px;}
.text-right{text-align:right;}
.report-page .right-customer{font-size: 14px;line-height: 17px;padding-top: 17px;color: #808083;}
.text-red{color:#c31e24;}
.foter_bot{width: 100%;float: left;font-size: 11px;color: #808083;font-weight: 700;position: absolute;bottom: 0;}
.report-page .table-report th{padding: 10px; text-align:left;font-size: 14px;}
.report-page .table-report tr td{padding: 10px;background: #f1f1f1;border-bottom: 1px solid #ddd;font-size: 13px;}
.report-page .table-report{margin-bottom: 10px;}
.check-if-no{margin-top:20px;}

.header .inputs-txt{
	display:inline-block;
	width:90%;
	}
.header .inputs-img{
	display:inline-block;
	}	

		
.dash-pages input[type="image"]{ width:24px; display:inline-block;}	
.dash-pages .header{
	background:#FFF;
	padding:10px;
	}
ul.companyinfo li{
	    display: table;
    font-size: 14px;
    line-height: 22px;
    margin-bottom: 14px;
	}
.sideInputs{ margin-bottom:10px;}
.love-count h1{ margin:0; padding:0;}
.submit-button-container input[type="submit"]:disabled {
    background: #dddddd;
}		
/*p{
	margin-bottom:20px;
	font-size:18px;
	background-color:#CCC;

}
*/
.circle_detail{
	width:85px;
	height:85px;
	border-radius:100%;
	-webkit-border-radius:100%;
	-moz-border-radius:100%;
	border:1px solid #000;
	font-size:36px;
	text-align:center;
	position:relative;
	padding-top:2%;
	}
.user-pane{width:39%;}
.user-content{width:60%;}
.user-pane, .user-content{ display:inline-block; float:left;}
.user-content{ padding:10px;}	
.user-pane .no-photo {
    width: 300px;
    height: 300px;
    display: block;
    background: rgba(72,87,119,0.1) url("<?=SURL?>img/logo3.png") no-repeat bottom center;
    border-radius: 2px;
    margin: 0 0 25px 0;
}

.width-100{width:100% !important;}
.clear{ clear:both;}
p.sumery{font-size: 14px;background-color: transparent;line-height: 23px;}
.mb-15{margin-bottom:15px;}
.social-facebook_photo{ display:inline-block; float:left; position:relative; width:160px;}
.social-content{ 
	float: left;
    display: inline-table;
    width: 80%;
    padding:2%;
}
.social-facebook_photo span{ position:absolute; right:1px; bottom:0; z-index:1;color: #fff;}
.clear{ clear:both;}
.social-facebook_photo a{position:relative;}
.social-content ul.userinfo li{font-size: 13px;display: inline-block;width: 32%;padding: 0;line-height: 24px;font-weight: 400 !important;}
.social-content ul.userinfo li span{display:block;font-family: RobotoLtRegular;}
.social-content  ul.user_photos li{display:inline-block; padding:0;width: 90px;height: 90px;overflow: hidden;}
.social-content  ul.user_photos li img{vertical-align:middle;}
.user-profile .social-content{padding-top:0;}
.user-profile .social-content .user_name h1{margin: 0;font-size: 28px;text-transform: uppercase;}
.user-profile .social-content .user_name span{font-size: 13px;color: #666;}
.user-profile .social-content h6{margin: 20px 0 15px;font-size: 18px;color: #43bce9;}
.user-profile .social-content .user-add{font-size: 13px;}
.user-profile .social-facebook_photo.bioo{font-size: 1.4em;color: #43bce9;text-align: left;}
.user-profile .social-content p.description{font-size: 13px;line-height: 22px;text-transform: none;font-family: RobotoLtRegular;margin-bottom: 8px;}
.social_links ul li{font-size: 14px;padding: 0 0 17px;}
.social_links ul li a i{font-size:14px;width: 30px; text-align:left;}
.pages-nav a{text-transform:capitalize;}
.spinner-wrapper::before{-webkit-animation: none;animation: none;}
.task-detail-field div{font-size: 1em;}
.pg {
    /* border: 1px solid #cccccc; */
    width: 100%;
    min-height: 1150px;
    float: left;
    margin-left: 0px;
    page-break-after: always;
    margin-top: 20px;
    /* margin: auto; */
}
.ipg{}
.bg {margin: 0 0 0 0;width: 100%;min-height: 1050px;}
.sec_header {
    width: 100%;
    height: auto;
    margin: auto;
    display: inline-block;
    height: 400px;
    color: #c31e24;
    text-align: right;
    background-image: url(img/pdf_head_bg.jpg);
	background-repeat:no-repeat;
	background-position:top center;
	background-size:cover;
}
.logo_main {
    background-image: url(img/lion-trans.png);
    height: 100%;
    background-size: 48%;
    line-height: 100px;
    padding: 128px 48px 0 0;
	background-repeat:no-repeat;
    background-position: -123px 17px;
}
.logo_main img {
    width: 524px;
    height: auto;
}
.firstpag_left {
    width: /*571px*/100%;
    float: left;
    display: inline-block;
    margin: 0;
}
.appli_name {
    background-color: #d8eaf9;
    color: #394b72;
    font-size: 16px;
    text-align: center;
    padding: 23px 0;
    font-weight: 400;
    width: 49.8%;
    height: 170px;
    float: left;
    border-radius: 0;
    /* font-family: arial; */
    margin: 0;
    text-transform: uppercase;
    border-right: 1px solid #ccc;
}
.firstpag_left h1 {
    margin: 56px 0 0;
    padding: 0;
	background: transparent;
    font-size: 22px;
    color: #c31e24;
    font-weight: 400;
    font-family: 'Montserrat', sans-serif;
}
.appli_name h3 {
    margin: 0;
}
.report-down {
    background-color: #d8eaf9;
    color: #394b72;
    font-size: 16px;
    text-align: center;
    padding: 23px 0;
    font-weight: 400;
    width: 50%;
    height: 170px;
    float: right;
    border-radius: 0;
    margin: 0;
}
.firstpag_left h4 {
    color: #c31e24;
    /* font-family: arial; */
    font-size: 22px;
    font-weight: 400;
    text-transform: uppercase;
    margin: 52px 0 0;
}
.disclaimer {
    width: 100%;
    display: inline-block;
    font-family: 'Montserrat', sans-serif;
}
.disclaimer h5 {
    font-size: 18px;
    color: #666;
    margin-bottom: 10px;
}
.disclaimer p {
    font-size: 13px;
    color: #666;
    margin-bottom: 18px;
    line-height: 22px;
}

@media print{
body {-webkit-print-color-adjust: exact;}
.client_login_footer{display:none;}


}


</style>

<?php   
  	 function getdataset_single($datasetID){
 
	 $maxposts = 1;
 	  $url = 'http://compliant.one/dashboard/api.php?token=sdsvdsvb]3.bg%3E8%3E&method=dataset&id='.$datasetID.'';
 
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_URL,$url);
 $result=curl_exec($ch);
 curl_close($ch);
  $asd =  json_decode($result);
	return $asd;
 }
 
  	 function getrecord_single($userID){
if($country != "")
{$getcountry = '&country='.$country;}
else{$getcountry ="";}

	 $maxposts = 1;
 	 $url = 'http://compliant.one/dashboard/api.php?token=sdsvdsvb]3.bg%3E8%3E&method=getrecord&alloweddatasets=1,2,3,4,5,6,7,8,9&id='.$userID.'';
 
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_URL,$url);
 $result=curl_exec($ch);
 curl_close($ch);
  $asd =  json_decode($result);
	return $asd;
 }


  
$getrecord_single = getrecord_single($_REQUEST['id']);   
$getdataset_single = getdataset_single($getrecord_single->result[0]->filename);
  
?>




<div class="content-wrapper">
  
  
  <section class="instanat_report">
  
  	 <div class="page-header">
        <div class="page-header-content">
            <div class="page-title2">
                <h1>Report Page</h1>
            </div>
            <div class="heading-elements">
			<div class="heading-btn-group">
				<a href="javascript:;" class="btn btn-link btn-float has-text sidebar-control sidebar-secondary-hide hidden-xs" onClick="window.print()"><i class="icon-printer text-primary"></i><span>Print this page</span></a>

            </div>
            </div>
            
            
        </div>             
     </div>	
 
 
<?php

 ?>
 
 <div class="report-page" id="exPDF">
<!--[if lte IE 8]>
		<p class="iemessage">We noticed that you are using old version of  Internet Explorer. BackCheckGroup is designed to work best with Internet Explorer 9 and higher.<br />We recommend you visit the <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie"> Internet Explorer website</a> to upgrade to a newer version of the browser.</p>
		<![endif]-->
        
        <div class="pg " style="border:none;">

			<div class="ipg" style="width:100%;margin:0;border:none;">
            
            <div class="bg">
    	<div class="sec_header">
        	<div class="logo_main">
            	<img src="<?=SURL?>img/logo2_pdf.png" alt="logo">
            </div>
        </div>
        
        <div class="firstpag_left">
       <?php
	$Address1 = $getrecord_single->result[0]->Address1;
	$Country1 = $getrecord_single->result[0]->Country1;
	$Address2 = $getrecord_single->result[0]->Address2;
	$ActualRelationship = $getrecord_single->result[0]->ActualRelationship;
	$Dateofresearch = $getrecord_single->result[0]->Dateofresearch;
	$Source1 = $getrecord_single->result[0]->Source1;
	$filename = $getrecord_single->result[0]->filename;
	$Country2 = $getrecord_single->result[0]->Country2;
	$Nationality = $getrecord_single->result[0]->Nationality;
	$PhotographUrl = $getrecord_single->result[0]->PhotographUrl;
	$EntityType = $getrecord_single->result[0]->EntityType;
	 
	$id = $getrecord_single->result[0]->id;
 
?>				
        	
        	
        	
            <div class="appli_name">
			

        		<h1><?=$getdataset_single->dataset[0]->name?></h1>
			
			<h3>Full Name</h3></div>
<!--            <h5>Countries Researched for Directorship Profiles: </h5>
            <ul>
                <li>FINLAND</li>
                <li>SWEDEN</li>
            </ul>
            
            
-->          

		  	<div class="report-down">
                <h4>Report Downloaded</h4>
                <p>Date: <span><time datetime="2012-10-20"><?=date("d-M-Y")?></time></span></p>
                <!--<p>RESEARCH COMPLETED: <span>31/10/2015</span></p>-->
			</div>
            
            
        </div>
    		
            <div class="disclaimer">
            	<h5>Disclaimer</h5>
                    <p>This report sets out information obtained by Background Check Pte Ltd (BCP) from third-party sources as well as BCP objective analysis of the same, and should in no way be construed as a recommendation as to what course of action the client should take, or a personal opinion of BCP with respect to any of the corporate entities or individuals named in this report</p>

                    <p>BCP takes all due care to ensure the accuracy of the information provided, but cannot guarantee with absolute finality the validity or accuracy of all sources of information.</p>

                    <p>All actions taken by the client subsequent to receiving our report shall be understood to be the result of its decision alone, and the client shall hold BCP free and harmless from any and all liability to itself or to any other party as a result of said decision. All personal data supplied in this report is intended to be for the sole purpose of client's evaluation and is not intended for public dissemination.</p>

                    <p>Copyright 2007 - 2015 Background Check Pte Ltd. All rights reserved. No part of this publication may be reproduced, photo copied, stored on a retrieval system, or transmitted without the express prior consent of Background Check Pte Ltd.</p>
                
            
            </div>
            
            
            
    	</div>
            
            
            </div>
            
            </div>
        
        
  <header class="head_logo">
	  <div class="logo"><img src="<?=SURL?>img/logo3.png" alt="BackCheckGroup" width="74px"> 
		  <div class="logo_in"><strong> Background Check Pte Ltd</strong><br>
				  30 Cecil Street, #19-08 Prudential
				  Tower, Singapore 049712<br>
				  Phone: +65 3108 0343</div>
	  </div>
	  <div class="col-6 pull-right text-right right-customer">
		  <strong>Customer Care</strong><br>
support@backcheckgroup.com<br>
Toll Free +1 888 983 0869<br>
<span class="text-red">CONFIDENTIAL</span>
	  </div>
  </header>

	 <?php /*?> <h1 class="fl h5">
		  <?php 
		  foreach ($mypix->names->name as $pixinfo):
		  if($pixinfo['nameTypeCode']=='AN'){ echo $pixinfo['name'];}
		  endforeach;
		  ?>
		<span class="comp-no">Company No.: <?=$mypix['crefoid']?></span>
	 </h1><?php */?>
	 
	 
	  
	  <section class="col-12">
	  <div class="accrd">
		  <h5>Verification Summary<span class="pull-right">Date Ordered: <time datetime="2012-10-20"><?=date("d-M-Y")?></time></span></h5>
		  
		  <div class="accrd_inner">
			  <ul>
	 
			  
			  
			   <li class="col-6"><span>Crime: </span><?=$getdataset_single->dataset[0]->name?></li>
			   <li class="col-6 pull-right"><span>Address 1 : </span><?=($Address1!=''?$Address1:'-')?></li>
			   <li class="col-6"><span>Country1: </span><?=($Country1!=''?$Country1:'-')?></li>
			   <li class="col-6 pull-right"><span> Address2
: </span><?=($Address2!=''?$Address2:'-')?></li>
			  
			   <li class="col-6"><span>ActualRelationship: </span><?=($ActualRelationship!=''?$ActualRelationship:'-')?></li>
			   <li class="col-6 pull-right"><span>Dateofresearch: </span><?=($Dateofresearch!=''?$Dateofresearch:'-')?></li>
			   <li class="col-6"><span>Source1: </span><?=($Source1!=''?$Source1:'-')?></li>
			   <li class="col-6 pull-right"><span> Country2: </span><?=($Country2!=''?$Country2:'-')?></li>
			   <li class="col-6"><span> Nationality:</span> <?=($Nationality!=''?$Nationality:'-')?></li>
			   <li class="col-6 pull-right"><span> PhotographUrl: </span><?php if($PhotographUrl!='')
			   ?>
               <img src="<?=$PhotographUrl?>" />
               <?php
			   ?></li>
			   <li class="col-6"><span> EntityType: </span><?=($EntityType!=''?$EntityType:'-')?></li>
			    
			  </ul>
			  
			  <div style="clear:both;"></div>
				 
		  </div>
	  
	  </div>
	  </section>
	  
 	  
		  <section class="footer_rep">
			  <p style="font-size: 12px;text-align: center;">All BackGround Check services are fully Compliant.</p>
		  </section>
	   
	  </div>
      
<?php
?>

  
  
  </section>
            
 </div>
 
<script>
 window.onload = function(){
  jQuery("#asdasdsad").trigger('click');
};	
</script>
