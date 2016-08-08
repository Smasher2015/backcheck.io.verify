<?php include 'includes/document_head.php'; ?>
<style type="text/css"> 
.login-bg
{
	background-image: url(images/1.jpg);
}
.login-page .wrapper .panel{
	float:left !important;
	left:477px !important;
	top:152px !important;
}
</style>
<div id="wrapper">	
    <div class="isolate">
        <div id="login_box" class="center">
            <img src="images/rdlogo_active.png" width="420" style="margin-left:7%; margin-top:16px;" />
            <div class="main_container clearfix">
                <div class="box">
                    <div class="block">
                        <div class="section">
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
                            } 
							$uInfo = $db->select("users","*","username='$_REQUEST[user]'");
							if(mysql_num_rows($uInfo)>0){
								$uInfo =   mysql_fetch_array($uInfo);
								$comInfo = getcompany($uInfo['com_id']);
								$comInfo = mysql_fetch_array($comInfo);
							}
							?>  									                                    
                        </div>	
                        <form name="dologin" class="validate_form" method="post">
						<section class="wrapper scrollable animated fadeInDown">
                <section class="panel panel-default">
                    <div class="panel-heading">
                        <div>
                            <h1>Risk Discovered System</h1>
							<?php if($comInfo['logo']!=''){ ?>
                        <fieldset class="label_side">
                            <div style="margin-left:0;text-align:center;">
                                <img src="<?=SURL.$comInfo['logo']?>" width="200px" />
                            </div>
                        </fieldset>
						<?php } ?>
                            
                        </div>
                    </div>
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
                                                         <div class="form-group">
                                <label for="email">Email</label>
                               <input type="text" id="user" name="user" class="required" value="<?=$_REQUEST["user"]?>" disabled="disabled">
                                <input type="hidden" name="username" value="<?=$_REQUEST["user"]?>" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="required">
                            </div>
                        </li>
                    </ul>
                    <div class="panel-footer">
                   		 <button class="btn btn-lg btn-success" type="submit" name="subdologin">LOGIN TO DOWNLOAD REPORT</button>
                    </div>
                </section>
            </section>
                        </form>	
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
	
<script type="text/javascript">
	$(".validate_form").validate();
	function getpass(){
		var elm = document.getElementById('getpass');
		if(elm.style.display=='none'){
			elm.style.display='block';	
		}else{
			elm.style.display='none';	
		}
		
	}
</script>

<?php include 'includes/closing_items.php'?>