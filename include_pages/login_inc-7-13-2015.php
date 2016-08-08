<?php include 'includes/document_head.php'?>

<script type="text/javascript" src="js/js_functions-2.js?var=4"></script>
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
		
<style type="text/css"> 
.login-bg
{
	background-image: url(images/1.jpg);
}

</style>	
		
		
        <!--[if lt IE 8]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <div class="client_login_header">
        	<div class="client_login_logo">
            	<img src="images/rdlogo_active.png" alt="Risk Discovered">
            </div>
        	<div class="client_login_righ">
            	<ul>
					<li><a href="#"><i class="icon-map-marker"></i> Global Coverage</a></li>  
                    <li><a href="#"><i class="icon-phone"></i> Contact Us</a></li>                
                </ul>
            </div>
        </div>

        <form role="form" name="dologin" class="validate_form" method="post">
            <section class="wrapper scrollable animated fadeInDown">
                <section class="panel panel-default">
                    <div class="panel-heading">
                        <div>
                            <h1>Risk Discovered System</h1>
                            
                        </div>
                    </div>
                   <b style="  margin-left: 23px;">Enter your Backgroundcheck365 Username and Password</b>
                    <ul class="list-group">
                        <!--<li class="list-group-item">
                            <span class="welcome-text">
                                Welcome back to Proton CMS!
                            </span>
                            <span class="member">
                                Not a Member?
                            </span>
                            <a href="javascript:;">Sign Up »</a>
                        </li>-->
                        <li class="list-group-item">
                            <!--<span class="login-text">
                                Login with your Proton account
                            </span>-->
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
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="username" class="form-control input-lg" id="email" placeholder="Email" data-parsley-required="true">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control input-lg" id="password" placeholder="Password">
                            </div>
                        </li>
                    </ul>
                    <div class="panel-footer">
                   		 <button class="btn btn-lg btn-success" type="submit"  name="subdologin">LOGIN</button>
                        <!--<a class="btn btn-lg btn-success" href=".">LOGIN TO YOUR ACCOUNT</a>-->
                        <br>
                        <a class="forgot-pass" href="javascript:;">Forgot Your Password?</a>
                    </div>
                </section>
            </section>
        </form>
   

		
		
		 <form role="form" class="forgot" name="resetpass" style="display:none;" method="post">
            <section class="wrapper scrollable animated fadeInDown">
                <section class="panel panel-default">
                    <div class="panel-heading">
                        <div>
                            <h1>Forgot Your Password</h1>
                        </div>
                    </div>
                   
                    <ul class="list-group">
                        
                        <li class="list-group-item">
                           
                           
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control input-lg" id="email" placeholder="Email" data-parsley-required="true" >
                            </div>
                           
                        </li>
                    </ul>
                    <div class="panel-footer">
                   		 <button class="btn btn-lg btn-success" type="submit"  name="subremail">Submit</button>
                     
                        <br>
                        <a class="forgot-pass2" href="javascript:;">Back</a>
                    </div>
                </section>
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
        
<div class="client_login_footer">
    <ul class="links">
        <li><a href="#">Terms & Conditions</a></li>  
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Data Security</a></li>
        <li><a href="#">Legal Policy</a></li>   
        <li> &copy; 2007 - 2015 | Powered by <a href="https://www.backcheckgroup.com/">Background Check Pte Ltd</a>  - All rights reserved</li>             
    </ul>
    
    <ul class="scail">
        <li><a href="#"><i class="icon-facebook"></i></a></li>  
        <li><a href="#"><i class="icon-twitter"></i></a></li>
        <li><a href="#"><i class="icon-google-plus"></i></a></li>
        <li><a href="#"><i class="icon-linkedin"></i></a></li> 
        <li><a href="#"><i class="icon-pinterest"></i></a></li>                
    </ul>
    
</div>

	
<?php include 'includes/closing_items.php'?>