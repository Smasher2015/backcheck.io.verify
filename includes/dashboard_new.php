<div id="main_container" class="main_container container_16 clearfix">
<?php $keyphrase = '1'; include 'includes/navigation.php';?>

 <?php 
 $che=$db->select("add_data","user_id","user_id=$_SESSION[user_id]");
 $che_us=mysql_num_rows($che);
  if($che_us==0){ ?>
                <div class="block">
       <div class="alert  alert_green">
         <img height="24" width="24" src="images/icons/small/white/alarm_bell.png">
         <a href="?action=verification&atype=complete" style="color:yellow">Click here to complete your verification process</a>
         </div>
                                    </div>
                <?php } ?>

				<div class="flat_area grid_16">
					<h2>Fixed Height Content</h2>
					<p>Boxes can be given<strong> fixed heights</strong> and the content can be viewed by scrolling up and down. This can be handy if you want to keep the main interface above the fold or you want to avoid really long pages. This can have a header or be just a plain box. </p>
					<p><strong>Note: </strong>A two finger <strong>dragging gesture</strong> is used to navigate the content on a <strong>touchscreen</strong> such as iPhone or Android. </p>
				</div>
				<div class="box grid_8">
					<h2 class="box_head">Access Your Reports</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<div class="block" style="height:235px; overflow:auto;">
							
<div class="indent gallery" style="margin-bottom:0"> 
 <ul class="clearfix feature_tiles">                           
	<li class="new">
		<a href="?action=wip&atype=cases" class="features">
			<img src="images/icons/large/grey/go_back_from_screen_top.png">
			<span class="name">In Progress</span>
			<span class="update">1</span>
		<div class="starred blue"></div>
		</a>
	</li>

	<li class="all">
		<a href="?action=close&atype=ready" class="features">
			<img src="images/icons/large/grey/go_back_from_screen.png">
			<span class="name">Completed</span>
			<span class="update">0</span>
		</a>
	</li>							
		
	<li class="all">
		<a href="?action=close&atype=archived" class="features">
			<img src="images/icons/large/grey/expose.png">
			<span class="name">Archived</span>
			<span class="update">0</span>
		</a>
	</li>
				
	<li class="new">
		<a href="?action=attention&atype=cases" class="features">
			<img src="images/icons/large/grey/chart_8.png">
			<span class="name">Needs Attn</span>
			<span class="update">2</span>
		<div class="starred green"></div></a>
	</li>
		
	<li class="new">
		<a href="?action=alert&atype=cases" class="features">
			<img src="images/icons/large/grey/alarm_bell.png">
			<span class="name">Discrepancy</span>
			<span class="update">2</span>
		<div class="starred green"></div></a>
	</li>                            
</ul>
</div>
                            
                           
						</div>
					</div>
				</div>	
				<div class="box grid_8">
					<div class="block" style="height:271px; overflow:auto;">
						<div class="section">
							slider
						</div>
					</div>
				</div>

            <?php include("include_pages/cases-main_inc.php")?>
  
                </div>
                <div id="main_container" class="main_container container_16 clearfix">
					
                    <div class="box grid_8">
					<h2 class="box_head">Invitatons</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<div class="block" style="height:235px; overflow:auto;">
							

                            
                           
						</div>
					</div>
				</div>
                    <div class="box grid_8">
					<h2 class="box_head">Quick Submit</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<div class="block" style="height:235px; overflow:auto;">
                     <?php   if(isset($_POST['upload'])){
	$error='No';
	if($_POST['v_name']=='')
	{
		$error='Please Insert Name';
		$_POST['pkgg_id']= $_POST['pkgg_id_case'];
		}
	if($_POST['v_email']=='')
	{
		$error='Please Insert Email';
		$_POST['pkgg_id']= $_POST['pkgg_id_case'];
		}
	if($_POST['v_dob']=='')
	{
		$error='Please Insert Date Of Birth';
		$_POST['pkgg_id']= $_POST['pkgg_id_case'];
		}
	if($_POST['address']=='')
	{
		$error='Please Insert Address';
		$_POST['pkgg_id']= $_POST['pkgg_id_case'];
		}
		if($_POST['v_nic']=='')
	{
		$error='Please Insert NIC no';
		$_POST['pkgg_id']= $_POST['pkgg_id_case'];
		}
		 if(isset($_REQUEST['v_email'])){
  if (empty($_REQUEST['v_email'])){ 
  $error = "please type your e-mail address.";
  }
  $email_valid = check_user_email($_REQUEST['v_email']);
  if($email_valid > 0){
  $error = "Email address is already registered."; 
  $_POST['pkgg_id']= $_POST['pkgg_id_case'];
  }
		 }
		if($error=='No'){
	
	$comm_ids=$db->select("users","com_id","user_id=$_SESSION[user_id]");
	$comm_id=mysql_fetch_array($comm_ids);
	$cols ="fullname,first_name,last_name,email,username,password,salt,level_id,dofb,address,nic,com_id";
  $fullname =  $_REQUEST['v_name'];
  $name = explode(" ", $_REQUEST['v_name']);
  $_REQUEST['fname'] = $name[0];
  $_REQUEST['lname'] = $name[1].' '.$name[2].' '.$name[3].' '.$name[4];
  $_REQUEST['passa'] = get_rand_val(8);
  $salt = get_rand_val(8);
  $pass = md5(md5($_REQUEST['passa']).md5($salt));
  $vals = "'$fullname','$_REQUEST[fname]','$_REQUEST[lname]','$_REQUEST[v_email]','$_REQUEST[v_email]','$pass','$salt',6,'$_REQUEST[v_dob]','$_REQUEST[address]','$_REQUEST[v_nic]',$comm_id[com_id]";
  $isRegister = $db->insert($cols,$vals,'users');
  $reg_id=mysql_insert_id();
  $to=$_POST['v_email'];
	$subject="Registration At verify";
	$message=$_POST['v_name']."\r\n";
	$message.="Registration At verify";
	$headers = 'From: admin@verify.com.pk' . "\r\n" .'Reply-To: admin@verify.com.pk' . "\r\n";
	if($_POST['notify']==1){
	mail($to, $subject, $message, $headers);
	}

//mysql_query("insert into tver_data (v_name,v_nic,v_ftname,v_dob,v_save) Values ('$_POST[v_name]','$_POST[v_nic]','$_POST[v_ftname]','$_POST[v_dob]',0) ");

$values="'$_POST[v_name]','$_POST[v_nic]','$_POST[v_ftname]','$_POST[v_dob]','0',$_POST[pkgg_id_case], $reg_id,$comm_id[com_id],$_SESSION[user_id]";
$isInsUp = $db->insert('v_name,v_nic,v_ftname,v_dob,v_save,qt_id,v_apid,com_id,v_uadd',$values,"ver_data");
//echo $db->query;
$ins_v_id=mysql_insert_id();
$checks_id=$db->select("package_items","checks_id","pkg_id=$_POST[pkgg_id_case]");
//echo $db->query;
while($chek=mysql_fetch_array($checks_id)){
	
	$db->insert("v_id,checks_id,as_uadd","$ins_v_id,$chek[checks_id],$_SESSION[user_id]","ver_checks");
	//echo $db->query;
	}
		}
} ?>

          <?php 
  if(isset($error) and $error != "No"){ ?>
                <div class="block">
       <div class="alert  alert_red">
         <img height="24" width="24" src="images/icons/small/white/alarm_bell.png">
         <?php echo $error; ?>
         </div>
                                    </div>
                <?php } ?>
                                             <?php 
  if($error == "No"){ ?>
                <div class="block">
       <div class="alert  alert_green">
         <img height="24" width="24" src="images/icons/small/white/alarm_bell.png">
        Succefully Submitted
         </div>
                                    </div>
                <?php } ?>
                <script type="text/javascript">
			
			function getChecks(i){
				
				var param='ePage=getchecks&type=ajax&pkg_id='+i;
				 ajaxServices('actions.php',param,'checks');
				
				}
				function getChecks1(i){
				
				var param='ePage=getchecks&type=ajax&pkg_id='+i;
				 ajaxServices('actions.php',param,'checks1');
				
				}
                                        function showDiv(frm){
											var ap;
											document.getElementById(frm).style.display='block';
											
											if(frm=='app') ap='upl';else ap='app';
											document.getElementById(ap).style.display='none';
											
											
										}
										function addMore(addi){
											document.getElementById(addi).style.display='block';
											return false;
										}
											function remove1(addi){
											document.getElementById(addi).style.display='none';
											return false;
										}
										</script>
                        <form method="post">
								<fieldset class="label_side">
										<label>Select Package<span>Label placed beside the Input</span></label>
                                       
										<div>
											<select name="pkgg_id_case" onchange="getChecks(this.value)">
                                        
                                            <?php
                                            		$pack=$db->select("packages","*","pkg_type=0 or user_id=$_SESSION[user_id]");
													 while($package=mysql_fetch_array($pack)){
												?>
                                            <option value="<?=$package['pkg_id']?>"><?=$package['pk_name']?></option>
                                            <?php }?>
                                            </select>
                                         
                                            &nbsp;
                                            
										</div>
                                        
									</fieldset>
                                    <div id="checks">
                                   </div>
                                          <fieldset class="label_side">
										<label for="required_field">Name<span>Label placed beside the Input</span></label>
										<div>
											<input type="text"  name="v_name" id="v_name" class="required text" >
										</div>
									</fieldset>
                                    <fieldset class="label_side">
										<label  for="required_field">Email<span>Label placed beside the Input</span></label>
										<div>
											<input type="text" name="v_email"  id="v_email" class="required text">
										</div>
									</fieldset>
                                      <fieldset class="label_side">
										<label >Father's Name<span>Label placed beside the Input</span></label>
										<div>
											<input type="text" name="v_ftname" id="v_ftname" class="required text">
										</div>
									</fieldset>
                                     <fieldset class="label_side">
										<label for="required_field">NIC No.<span>Label placed beside the Input</span></label>
										<div>
											<input type="text" name="v_nic" id="v_nic" class="required text">
										</div>
									</fieldset>
                                   
                                     <fieldset class="label_side">
										<label for="required_field">Address.<span>Label placed beside the Input</span></label>
										<div>
											<input type="text" name="address" id="address" class="required text">
										</div>
									</fieldset>
                                       <fieldset class="label_side">
										<label for="required_field">Date Of Birth.<span>Label placed beside the Input</span></label>
										<div>
											<input type="text" name="v_dob" id="v_dob" class="datepicker required text " readonly="readonly">
										</div>
									</fieldset>
                                     <fieldset class="label_side">
										<label for="required_field">Email To Applicant.<span>Label placed beside the Input</span></label>
										<div>
											<input type="radio" name="notify" checked="checked" value="1"> Yes
                                           &nbsp;&nbsp;&nbsp;
                                            <input type="radio"  name="notify" value="2"> No
                                             &nbsp;&nbsp;&nbsp;
										</div>
									</fieldset>
                                    <div class="button_bar clearfix">
                                    	<button type="submit" name="upload" value="Next Step" class="next_step move send_right">Next Step</button>
                                    </div>  
                                    </form>

                            
                           
						</div>
					</div>
				</div>
                	
                
                <div class="box grid_8 tabs">
					<ul class="tab_header clearfix">
						<li><a href="#tabs-1">News Section</a></li>
						<li><a href="#tabs-2">News Section</a></li>
					</ul>
					<a href="#" class="grabber"></a>
					<a href="#" class="toggle"></a>
					<div class="toggle_container">
						<div id="tabs-1" class="block">
							details1
						</div>
						<div id="tabs-2" class="block">
							detail2
						</div>
					</div>
				</div>
                
                
                
                    <div class="box grid_8">
					<h2 class="box_head">Package Detail</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<div class="block" style="height:235px; overflow:auto;">
								<fieldset class="label_side">
										<label>Select Package<span>Label placed beside the Input</span></label>
                                       
										<div>
											<select name="pkgg_id_case" onchange="getChecks1(this.value)">
                                        
                                            <?php
                                            		$pack=$db->select("packages","*","pkg_type=0 or user_id=$_SESSION[user_id]");
													 while($package=mysql_fetch_array($pack)){
												?>
                                            <option value="<?=$package['pkg_id']?>"><?=$package['pk_name']?></option>
                                            <?php }?>
                                            </select>
                                         
                                            &nbsp;
                                            
										</div>
                                        
									</fieldset>
                                    <div id="checks1">
                                   </div>
                            
                           
						</div>
					</div>
				</div>
                
                	
				</div>
<div id="main_container" class="main_container container_16 clearfix">

<div class="box grid_16">

    <h2 class="box_head">Line Graphg</h2>
    <a href="#" class="grabber"></a>
    <a href="#" class="toggle"></a>
    <div class="toggle_container">
						
							<div class="section">
                <div id="flot_line" class="flot"></div>
            </div>
						
					
					</div>
    
 </div>

<div class="box grid_16">
    <h2 class="box_head">Point Graph with Pie chart</h2>
    <a href="#" class="grabber"></a>
    <a href="#" class="toggle"></a>
    <div class="toggle_container">					
        <div class="block">
            <div class="columns">
                <div class="col_66">
                    <div class="section">
                        <div id="flot_points" class="flot"></div>
                    </div>								
                </div>
                <div class="col_33">
                    <div class="section">
                        <div id="flot_pie_1" class="flot"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box grid_16">
    <h2 class="box_head">Bar Graph</h2>
    <a href="#" class="grabber"></a>
    <a href="#" class="toggle"></a>
    <div class="toggle_container">					
        <div class="block">
            <div class="section">
                <div id="flot_bar" class="flot"></div>
            </div>
        </div>
    </div>
</div>												
</div>
<script type='text/javascript' src='scripts/flot/excanvas.min.js'></script>
<script type='text/javascript' src='scripts/flot/jquery.flot.min.js'></script>
<script type='text/javascript' src='scripts/flot/jquery.flot.resize.min.js'></script>		
<script type='text/javascript' src='scripts/flot/jquery.flot.pie.min.js'></script>
<script type='text/javascript' src='scripts/flot/jquery.flot.pie.resize_update.js'></script>			
<script type="text/javascript" src="scripts/adminica/adminica_charts.js"></script>			