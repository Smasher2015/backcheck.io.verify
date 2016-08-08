<?php include 'includes/document_head.php'?>

<script type="text/javascript" src="js/js_functions-2.js?var=4"></script>

<script>
$( document ).ready(function() {
	$('input').focus(
    function(){
        $('.log-field').css('background','#fff');
    }).blur(
    function(){
        $('.log-field').css('background','rgba(255,255,255,0.8)');
    });
	
});
</script>


        <script>
	        var theme = $.cookie('protonTheme') || 'default';
	        $('body').removeClass (function (index, css) {
	            return (css.match (/\btheme-\S+/g) || []).join(' ');
	        });
	        if (theme !== 'default') $('body').addClass(theme);
        </script>
		
		<script type="text/javascript">
$(document).ready( function() {
	$('a.forgot-pass').click(function() {
		
		$('.validate_form').css("display", "none");
		$('.forgot').css("display", "block");
	});
	$('a.forgot-pass2').click(function() {
		$('.forgot').css("display", "none");
		$('.validate_form').css("display", "block");
	});
	
	
	/* -------------------------------- 		*/
	/* Developed & Analyzed By : Rizwan Hidayat	*/
	/* -------------------------------- 		*/
	var input = document.getElementsByTagName('input');
	for(var i=0;i < input. length;i++){
		if(input.item(i).name=='password' || input.item(i).name=='username'){
				input.item(i).onkeydown = function(e){
						var keycode = null;
						if(window.event) keycode = window.event.keyCode; else if(e) keycode = e.which;
						if(keycode==13){
							document.getElementById('subdologin').click();							
						}
				}
		}
	}
	
	function getPass(){
		var elm = document.getElementById('getpass');
		var img = document.getElementById('psimg');
		if(elm.style.display=='none'){
			elm.style.display='block';	
			img.src = "img/br_down.png";
		}else{
			elm.style.display='none';	
			img.src = "img/br_down_right.png";
		}
	}
	var frms = document.forms;
	for(var i=0;i<frms.length;i++){
		if(!(frms.item(i).className.match(/exit/i))){
			frms.item(i).onsubmit = valdateForums;
		}
	}
});		
</script>
		
	
		
		
        <!--[if lt IE 8]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        

        <form role="form" name="dologin" class="validate_form" method="post" autocomplete="off">
            <section class="wrapper scrollable animated fadeInDown">
                <section class="panel panel-default">
                    <div class="panel-heading">
                    	<div class="client_login_header">
        	<div class="client_login_logo">
            	<img src="images/login_logo3.png" alt="Backcheck.io">
            </div>
        	
        </div>
        	<div class="heading-elements hidden-xs hidden-sm">
            	 <ul class="list-inline">
					<li><a href="https://backcheckgroup.com/global-coverage/" target="_blank" class="text-white"><i class="icon-sphere position-left"></i> Global Coverage</a></li>  
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li><a href="https://backcheckgroup.com/contact/" target="_blank" class="text-white"><i class="icon-paperplane position-left"></i> Contact Us</a></li>                </ul>
            </div>
        
                    </div>
                 <!--  <p style="text-align:center; font-size:14px;">Enter your Backgroundcheck365 Username and Password</p>-->
                    <div class="panel panel-body login-form">
                    	
                        <div class="text-left">
							<h2 class="content-group">Sign in Verification System <small class="display-block">Enter your credentials below</small></h2>
						</div>
                     <?php
                            if($_REQUEST['CNT']>0){
                                    if($_REQUEST['TERR']!='') { 
                                    foreach($_REQUEST['TERR'] as $ERR){?>
                                        <p class="text-danger">
                                            <?=$ERR?>
                                           
                                        </p>
                            <?php 	}}	
									if($_REQUEST['TSCS']!='') { 
									foreach($_REQUEST['TSCS'] as $SCS){?>
										<p class="text-success">
											<?=$SCS?>
										</p>
							<?php 	}}								
                            }
							
							?>
                                            
                         <div class="form-group log-field">
                                <small>Email Address</small>
                                <input type="text" name="username" class="form-control input-lg" id="email" placeholder="Email@example.com" data-parsley-required="true" autocomplete="off" value="<?=(isset($_REQUEST['username'])?$_REQUEST['username']:'')?>">
                                                                
                            </div>
                            
                            <div class="form-group log-field">
                            	<small>Your Password</small>
                                <input type="password" name="password" class="form-control input-lg" id="password" placeholder="Password" autocomplete="off">
                               
                            </div>
                    
                    		 <div class="form-group">
                             	<button class="btn btn-block bg-red" type="submit"  name="subdologin">
                                <span class="pull-left">Sign in</span> <i class="icon-circle-right2 pull-right"></i></button>
                             </div>
                             
                            <div class="text-left">
                            	<a href="javascript:;" class="forgot-pass text-white">Forgot Your Password?</a>
                            </div>
                    
                    
                    </div>
                   
                    <div class="client_login_righ">
            		<div class="col-md-6 col-sm-12 col-xs-12 copyright_log">Copyright © <?=date('Y')?> Background Check Pte Ltd All rights reserved.</div>
                <ul class="col-md-6 col-sm-12 col-xs-12">
                	<li><a href="#" class="text-white"><i class="icon-facebook2"></i></a></li>
                    <li><a href="#" class="text-white"><i class="icon-twitter2"></i></a></li>
                    <li><a href="#" class="text-white"><i class="icon-google-plus2"></i></a></li>
                    <li><a href="#" class="text-white"><i class="icon-linkedin"></i></a></li>
                    <li><a href="#" class="text-white"><i class="icon-pinterest2"></i></a></li>
                </ul>
               
            </div>
                </section>
            </section>
        </form>
   

		
		
		 <form role="form" class="forgot" name="resetpass" style="display:none;" method="post">
            <section class="wrapper scrollable animated fadeInDown">
                <div class="panel panel-body login-form">
                      <div class="text-left">
							<h2 class="content-group">Password recovery <small class="display-block">We'll send you instructions in email</small></h2>
						</div>
                   
                   	<div class="form-group log-field">
							<small>Recovery Email</small>
                            <input type="email" name="email" class="form-control input-lg" id="email" placeholder="Your Email" data-parsley-required="true" >
						</div>
                        
                        <div class="form-group">
                        <button class="btn btn-block bg-red" type="submit"  name="subremail">
                        <span class="pull-left">Reset password</span> <i class="icon-arrow-right14 pull-right"></i></button>
                        
                        <a class="forgot-pass2 text-white mt-10 text-center display-block" href="javascript:;"><i class="icon-arrow-left13 position-left"></i> Back</a>
                        </div>
                </div>
            </section>
        </form>
		
		
	
		





                        <?php /*?><div class="section">
                            <?php
                            if($_REQUEST['CNT']>0){
                                    if($_REQUEST['TERR']!='') { 
                                    foreach($_REQUEST['TERR'] as $ERR){?>
                                        <div class="alert dismissible alert_blue">
                                            <img height="24" width="24" src="images/icons/small/white/alert_2.png">
                                            <?=$ERR?>
                                            <div class="clearfix"></div>
                                        </div>
                            <?php 	}}	
									if($_REQUEST['TSCS']!='') { 
									foreach($_REQUEST['TSCS'] as $SCS){?>
										<div class="alert dismissible alert_green">
											<img height="24" width="24" src="images/icons/small/white/cog_3.png">
											<?=$SCS?>
											<div class="clearfix"></div>
										</div>
							<?php 	}}								
                            } ?>  									                                    
                        </div>	
                        <form name="dologin" role="form" method="post">
                        <fieldset class="label_side">
                            <label for="username">Username<span>or email address</span></label>
                            <div>
                                <input type="text" id="username"  class="form-control input-lg" name="username">
                            </div>
                        </fieldset>						
                        <fieldset class="label_side">
                            <label for="password">Password<span><a href="javascript:void(0)" onclick="getpass()">Forgot Password?</a></span></label>
                            <div>
                                <input type="password" id="password" name="password" class="required">
                            </div>
                        </fieldset>
                        <fieldset class="no_label">																											
                            <div >
                                <button class="btnright icon_only text_only" type="submit"  name="subdologin">LOGIN >></button>
                            </div>
                        </fieldset>
                        
                        </form>	
                        <form enctype="multipart/form-data" method="post" id="getpass" style="display:none;" name="resetpass">
                               <fieldset class="label_side">
                                    <label for="email">Email Address</label>
                                    <div>
                                        <input type="text" id="email" name="email" class="req title" title="Input Email Address">
                                    </div>
                                </fieldset>	
                                <fieldset class="no_label">																											
                                    <div style="float:right">
                                        <button type="submit"  name="subremail" >Submit</button>
                                    </div>
                                </fieldset>
                        </form><?php */?>

                <?php 	if(isset($_POST)){
            foreach($_POST as $key=>$p){ 
                if(($key!='username') && ($key!='password') && ($key!='subdologin')){ ?>
                    <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $p; ?>" />	
          <?php }
          }
        }?>  
        


	
<?php include 'includes/closing_items.php'?>