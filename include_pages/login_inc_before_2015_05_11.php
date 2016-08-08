<?php include 'includes/document_head.php'?>
<div id="wrapper">	
    <div class="isolate">
        <div id="login_box" class="center">
            <?php /*?><img src="images/logo.png" width="420" style="margin-left:7%;" /><?php */?>
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
                        <form name="dologin" class="validate_form" method="post">
                        <fieldset class="label_side">
                            <label for="username">Username<span>or email address</span></label>
                            <div>
                                <input type="text" id="username" name="username" class="required">
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
                        </form>
                    </div>
                </div>
                <?php 	if(isset($_POST)){
            foreach($_POST as $key=>$p){ 
                if(($key!='username') && ($key!='password') && ($key!='subdologin')){ ?>
                    <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $p; ?>" />	
          <?php }
          }
        }?>  
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