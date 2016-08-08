
<?php 
/*if(isset($_POST['create_pkg'])){
	$error='No';
	$cols='pk_name,pkg_type,user_id';
	$values="'$_POST[pname]',1,$_SESSION[user_id]";
	if($_POST['pname']!=''){
	$isInsUp = $db->insert($cols,$values,"packages");
	$insert_id=mysql_insert_id();
	if(is_array($_POST['checks'])){
	foreach($_POST['checks'] as $checks)
		{
			$isInsUp = $db->insert('pkg_id,checks_id',"$insert_id,$checks","package_items");
			
		}
		
	$_POST['pkg']=$insert_id;
		}else{
		$error='Please select at least one check';
		}
	}
	else{
		  $error = "Please Insert Package name"; 
		}
	
}
if(isset($_POST['pkg']))
{
	$error='No';
	if($_POST['pkg']==''){
		$error='Please Select Package';
		}
	}

if(isset($_POST['upload'])){
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
}
if(isset($_POST['applicant'])){
	$error='No';

for($i=0;$i<=count($_POST['email']);$i++)
{
	$error='No';
	if($_POST['email'][$i]!=''){
	$to=$_POST['email'][$i];
	$subject="Invite URL";
	$message=$_POST['name'][$i]."\r\n";
	$message.="Invite URl: ".$_POST['url'];
	$headers = 'From: admin@verify.com.pk' . "\r\n" .'Reply-To: admin@verify.com.pk' . "\r\n";
	mail($to, $subject, $message, $headers);

	}else{
		
		
		}
	
	}

}
if(isset($_POST['bulk'])){
	  $_POST['pkgg_id']= $_POST['pkgg_id_case'];
	$error='No';
if(isset($_FILES["bulkfile"])){
if ($_FILES["bulkfile"]["error"] <= 0){
		$len = strlen($_FILES["bulkfile"]["name"]);
		$ext = strtolower(substr($_FILES["bulkfile"]["name"],($len-3)));
		if($ext=='zip'){
			$indx=rand(10,99).strtoupper(get_rand_val(10)).rand(10,99);
			$fPath = "upload/-$indx.zip";
			$fName = $_FILES["bulkfile"]["name"];
			if(move_uploaded_file($_FILES["bulkfile"]["tmp_name"], $fPath)){
				//$_REQUEST['SCS'].= msg('sec',"File Uploaded Successfully [ $fName ]...");
					//$_REQUEST['CNT'] = $_REQUEST['CNT']+1;
					//return true;
					$to="kzahid@dataflowgroup.com,mtalal16@yahoo.com";
	$subject="File Upload";
	$message.="File Path: ".SURL.$fPath;
	$headers = 'From: admin@verify.com.pk' . "\r\n" .'Reply-To: admin@verify.com.pk' . "\r\n";
	 mail($to, $subject, $message, $headers);
				
			}
		}else{
			//$_REQUEST['ERR'].= msg('err',"Only zip File is allowed! [ $fName ]");
			//$_REQUEST['CNT'] = $_REQUEST['CNT']+1;
			 $error = "Only zip File is allowed!"; 
			//return false;	
		}
	}
}else{
	$error='Please Upload zip File';
	
	}
	

}*/
?>


<div id="main_container" class="main_container container_16 clearfix">
				<?php $keyphrase = '3'; include 'includes/navigation.php'?>
                <?php 
  if(isset($error) and $error != "No"){ ?>
                <div class="block">
       <div class="alert  alert_red">
         <img height="24" width="24" src="images/icons/small/white/alarm_bell.png">
         <?php echo $error; ?>
         </div>
                                    </div>
                <?php } ?>
				<div class="flat_area grid_16">
					<h2>Step by Step Ordering a report</h2>
				</div>
				<div class="box grid_16">
					<h2 class="box_head">Ordering a report</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<div class="wizard">
							<div class="wizard_progressbar"></div>
							
							<div class="wizard_steps">
								<ul class="clearfix">
                                
									<li      <?php if(empty($_POST)  || (isset($_POST['pkg']) && isset($error) &&  $error!='No')){?> class="current"   <?php }?>>
										<a href="" class="clearfix">
											<span>1. <strong>Package</strong></span>
											<small>Select your package</small>
										</a>
									</li>
									<li <?php if(isset($_POST['pkg']) && $_POST['pkg']!=''){?> class="current"   <?php }?>>
										<a href="#step_2" class="clearfix">
											<span>2. <strong>Information</strong></span>
											<small>Fill out our form</small>
										</a>
									</li>
									<li <?php if(isset($_POST['type']) || (isset($_POST['upload']) && isset($error) &&  $error!='No') || (isset($_POST['bulk'])  && isset($error) &&  $error!='No')){?> class="current"   <?php }?>>
										<a href="#step_3" class="clearfix">
											<span>3. <strong>Another Step</strong></span>
											<small>Were nearly there</small>
										</a>
									</li>
									<li <?php if((isset($_POST['upload']) &&  $error=='No')|| isset($_POST['applicant']) || isset($_REQUEST['addAttach'])  || (isset($_POST['bulk']) &&  $error=='No')){?> class="current"   <?php }?>>
										<a href="#step_4" class="clearfix">
											<span>4. <strong>Finish</strong></span>
											<small>Confirm and complete</small>
										</a>
									</li>
								</ul>		
							</div>
							
							<div class="wizard_content">
								<form class="validate_form" method="post" enctype="multipart/form-data">
                         <?php if(empty($_POST)  || (isset($_POST['pkg']) && isset($error) && $error!='No')){?>
								<div id="step_1" class="step block" style="display:block;">
									<h1 class="section">1. Packages</h1>
								
									<fieldset class="label_side">
										<label>Select Package<span>Label placed beside the Input</span></label>
                                       
										<div>
											<select name="pkg" onchange="getChecks(this.value)">
                                            <?php if($insert_id!='') {
												 //$pckg_name=mysql_fetch_array(mysql_query("select pk_name from packages where pkg_id=$insert_id"));
													$pckg_1=$db->select("packages","pk_name","pkg_id=$insert_id");
													$pckg_name=mysql_fetch_array($pckg_1);
												?>
                                             <option value="<?=$insert_id?>" selected="selected"><?=$pckg_name['pk_name'];?></option>
                                             <?php }else{?>
                                            <option value="" selected="selected">Select Package</option>
                                            <?php }?>
                                            <?php
                                            		$pack=$db->select("packages","*","pkg_type=0 or user_id=$_SESSION[user_id]");
													 while($package=mysql_fetch_array($pack)){
												?>
                                            <option value="<?=$package['pkg_id']?>"><?=$package['pk_name']?></option>
                                            <?php }?>
                                            </select>
                                         
                                            &nbsp;
                                            <div id="crpkg">
                                            	OR&nbsp;
                                            <a  href="javascript:void(0)" onclick="showForm('pkg')">
                                           Create Package
                                            </a>
                                           </div>
										</div>
                                        
									</fieldset>
                                    <div id="checks">
                                  
                                    </div>
                                   	
                                    <!--<a class="tooltip" title="this is packag consist on many checks" >package</a>-->
                                    <div id="pkg" style="display:none">
                                    <fieldset class="label_side">
										<label for="required_field">Package Name<span>Label placed beside the Input</span></label>
										<div>
											<input type="text" name="pname" id="required_field" class="required text">
                                           
                               
										</div>
									</fieldset>
                                    
                                      <fieldset class="label_side">
										
											<label for="required_field">Select Checks</label>
											
												
                                                	        <div class="uniform">
                                                     <?php 
													 $ch=$db->select("checks","*","is_active=1");
													// $ch=mysql_query("select * from checks where is_active=1");
												   while($checks=mysql_fetch_array($ch)){
												?>
                                      
                                             
                               
                               
                                <label for="<?=$checks['checks_id']?>">
                                <div class="checker" id="uniform-<?=$checks['checks_id']?>">
									<span class="">
								<input name="checks[]"  type="checkbox" id="<?=$checks['checks_id']?>" value="<?=$checks['checks_id']?>"  style="opacity: 0;"></span>
                    			</div> <span class="tooltip" title="<?=mb_convert_encoding($checks['checks_info'], 'HTML-ENTITIES','UTF-8')?>"><?=mb_convert_encoding($checks['checks_title'], 'HTML-ENTITIES','UTF-8')?></span>
                                </label>
                                                    
                                             
                                <!--<div class="required_tag tooltip hover left" title="This field is required"></div>-->
                                                     
                                                      <?php }?>
                                                     </div>
                                                
                                               
											
										</fieldset>
                                        <div class="button_bar clearfix" >
										<button class="next_step move send_right" name="create_pkg">
											<img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/bended_arrow_right.png">
											<span>Create Package</span>
										</button>
                                       <!--  <input type="submit" class="next_step move send_right" name="create_pkg" value="Next Step"/>-->
                                       <button type="submit" class="next_step move send_right" name="close" onclick="return closeForm('pkg')"/>
                                       Close
                                       </button>
                                       
									</div>
                                    
                                    </div>
									<div class="button_bar clearfix">
									<button class="next_step move send_right" name="form" data-goto="step_2" id="normForm">
											<img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/bended_arrow_right.png">
											<span>Next Step</span>
										</button>
                                      <!--  <input type="submit" class="next_step move send_right input_btn" name="form" value="Next Step" id="normForm" />-->
									</div>
								</div>
                             <?php }?>
							<?php if(isset($_POST['pkg']) && $_POST['pkg']!=''){?>
								<div id="step_2" class="step block" style="display:block">
									<h1 class="section">2. Information</h1>
								<h2 class="section">Package:&nbsp;<?php 
												 $pckg_1=$db->select("packages","pk_name","pkg_id=$_POST[pkg]");
													$pckg_name=mysql_fetch_array($pckg_1);
													  echo $pckg_name['pk_name'];
								?></h2>
                                   <fieldset class="label_side">
										<label for="required_field">List Of Included Checks</label>
										<div><ul>
											<?php 
											$cid=$db->select("package_items","checks_id","pkg_id=$_POST[pkg]");
											
											while($chid=mysql_fetch_array($cid)){
												
												$cnames=$db->select("checks","checks_title","checks_id=$chid[checks_id]");
												$cname=mysql_fetch_array($cnames);
												echo '<li>'.mb_convert_encoding($cname['checks_title'], 'HTML-ENTITIES','UTF-8')."</li>";
												
												}
											
											
											?>
                               					</ul>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>How to upload data<span>Label placed beside the Input</span></label>
										<div>
											<input type="radio" name="type_data" checked="checked" value="1"> Applicant will upload data
                                           &nbsp;&nbsp;&nbsp;
                                            <input type="radio"  name="type_data" value="2"> Upload data you self
                                             &nbsp;&nbsp;&nbsp;
                                            <input type="radio"  name="type_data" value="3"> Upload bulk records
										</div>
									</fieldset>
                                    <input type="hidden" name="pkgg_id" value="<?=$_POST['pkg']?>"/>
									<div class="button_bar clearfix">
                                    	 
									<!--<button class="next_step move light" type="submit"  data-goto="step_1">
											<img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/grey/bended_arrow_left.png">
											<span>Prev Step</span>
										</button>-->
										<button class="next_step move send_right" type="submit"  name="type" data-goto="step_3">
											<img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/bended_arrow_right.png">
											<span>Next Step</span>
										</button>
                                       <!-- <input type="submit" name="type" value="Next Step" class="next_step move send_right input_btn">-->
									</div>
								</div>		
							 <?php }?>
                             <?php if(isset($_POST['type_data']) || (isset($_POST['upload']) && isset($error) &&  $error!='No')  || (isset($_POST['bulk'])  && isset($error) &&  $error!='No')){?>
								<div id="step_3" class="step block" style="display:block">
                                <h2 class="section">Package:&nbsp;<?php 
												 $pckg_1=$db->select("packages","pk_name","pkg_id=$_POST[pkgg_id]");
													$pckg_name=mysql_fetch_array($pckg_1);
													  echo $pckg_name['pk_name'];
								?></h2>
                                   <fieldset class="label_side">
										<label for="required_field">List Of Included Checks</label>
										<div><ul>
											<?php 
											$cid=$db->select("package_items","checks_id","pkg_id=$_POST[pkgg_id]");
											while($chid=mysql_fetch_array($cid)){
												
												$cnames=$db->select("checks","checks_title","checks_id=$chid[checks_id]");
												$cname=mysql_fetch_array($cnames);
												echo '<li>'.mb_convert_encoding($cname['checks_title'], 'HTML-ENTITIES','UTF-8')."</li>";
												
												}
											
											
											?>
                               				</ul>
										</div>
									</fieldset>
                                 <input type="hidden" name="pkgg_id_case" value="<?=$_POST['pkgg_id']?>"/>
									<h1 class="section">3. Another Step</h1>
								
									 	  <div id="app" style="display: <?php if(($_POST['type_data']==1)) echo 'block'; else echo 'none';?>">
									<fieldset class="label_side">
										<label>Copy URL<span>Label placed beside the Input</span></label>
										<div>
                                        <?php 	 $hash=$db->select("users","hash","user_id=$_SESSION[user_id]");
												$hash_key=mysql_fetch_array($hash);
										?>
											<input type="text" name="url" value="<?=SURL.'invite/'.trim($hash_key['hash']).'/'.$_POST['pkgg_id']?>" readonly="readonly">
                                            
										</div>
									</fieldset>
                                    <fieldset class="label_side" >
										<label  for="required_field">Name<span>Label placed beside the Input</span></label>
										<div>
										 <input type="text" name="name[]" id="name" class="required text">
                                         
										</div>
                                      
									</fieldset>
                                    <fieldset class="label_side" >
										<label for="required_field">Email<span>Label placed beside the Input</span></label>
										<div>
										 <input type="text" name="email[]" id="email" class="required text" >
										</div>
                                      <fieldset class="label_side">
										<label></label>
										<div>
										 <button type="submit" name="addmore" value="Add More" onclick="return addMore('add-0')">Add More</button>
										</div>
                                      
									</fieldset>
									</fieldset>
                                    <?php for($i=0;$i<5;$i++){?>
                                    <div id="add-<?=$i;?>" style="display:none">
                                    <fieldset class="label_side">
										<label>Name<span>Label placed beside the Input</span></label>
										<div>
										 <input type="text" name="name[]">
										</div>
                                      
									</fieldset>
                                    <fieldset class="label_side">
										<label>Email<span>Label placed beside the Input</span></label>
										<div>
										 <input type="text" name="email[]">
										</div>
                                      
									</fieldset>
                                    <fieldset class="label_side">
										<label></label>
										<div>
										 <button type="button" name="addmore" value="Add More" onclick="return addMore('add-<?=$i+1;?>')"> Add More</button>
                                         <button type="button" name="remove" value="Remove" onclick="return remove1('add-<?=$i;?>')">Remove</button>
										</div>
                                      
									</fieldset>
                                     
                                    </div>
                                    <? }?>
                                      <div class="button_bar clearfix">
                                     <button type="submit" name="applicant" value="Next Step" class="next_step move send_right">
                                     <img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/bended_arrow_right.png">
                                     <span>Next Step</span>
                                     </button>
                                        
                                    </div>
                                    
                                    </div>
                                    		
                                            <div id="upl" style="display:<?php if(($_POST['type_data']==2) || (isset($_POST['upload']) && isset($error) &&  $error!='No')) echo 'block'; else echo 'none';?>">
									
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
                                    	<button type="submit" name="upload" value="Next Step" class="next_step move send_right">
                                         <img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/bended_arrow_right.png">
                                        <span>Next Step</span></button>
                                    </div>
                                    </div>
                                    
                                    <div id="bulk" style="display: <?php if(($_POST['type_data']==3) || (isset($_POST['bulk'])  && isset($error) &&  $error!='No')) echo 'block'; else echo 'none';?>">
									
                                    <fieldset class="label_side" >
										<label  for="required_field">Upload Zip File<span>Label placed beside the Input</span></label>
										
                                        <div >
										 	
                                            <input type="file" name="bulkfile" style="opacity: 0;"  size="21" id="fileupload" class="uniform">
                                         
										</div>
                                      
									</fieldset>
                                  
                                   <div class="button_bar clearfix">
                                    	 <button type="submit" name="bulk" value="Next Step" class="next_step move send_right">
                                          <img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/bended_arrow_right.png">
                                         <span>Next Step</span></button>
                                    </div>
                                    
                                    </div>
									
									<div class="button_bar clearfix">
										<!--<button class="next_step move light" data-goto="step_2">
											<img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/grey/bended_arrow_left.png">
											<span>Prev Step</span>
										</button>
										<button class="next_step move send_right" type="submit" data-goto="step_4"  name="bulk">
											<img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/bended_arrow_right.png">
											<span>Next Step</span>
										</button>-->
									
                                    </div>
								
							 <?php }?>
                             <?php if((isset($_POST['upload']) &&  $error=='No') || isset($_POST['applicant']) || isset($_REQUEST['addAttach']) || (isset($_POST['bulk']) &&  $error=='No') ){?>
								<div id="step_4" class="step block" style="display:block">
                                
									<h1 class="section">Thanks For Application</h1>
                                    <input type="hidden" name="casid" value="<?=$ins_v_id?>"/>
                                                         
					<?php  
					if(isset($_POST['upload'])){
						$checks = checkDetails($ins_v_id);
						//$check=mysql_fetch_array($checks);
							?>
						<input type="hidden" name="case" value="<?php echo $ins_v_id; ?>" />       
						<?
						$isAtch=false;
						
		while($check = mysql_fetch_array($checks)){ 
		?>
		
		<?
				$chkSts = strtolower($check['as_status']);   
					 $pCheck = getcheckP($check['checks_id']);
					 $fields = $db->select("fields_maping","*","checks_id=$pCheck AND fl_face=4");
					 ?><div class="box grid_16">
					<h2 class="box_head"><?=mb_convert_encoding($check['checks_title'], 'HTML-ENTITIES','UTF-8')?></h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					 			    <div class="toggle_container">	
						<div class="block">
							<div class="columns clearfix">
							<div class="section">
                                <h1><?php //echo $check['checks_title']?></h1>
					 <?
							while($field = mysql_fetch_array($fields)){
									
									if($field['in_id']==5){ 
											$isAtch=true;?>
												
									<div class="section">
												  
                                                        <fieldset class="label_side">
										<label><?php echo $field['fl_title']; ?>:<span>Label placed beside the Input</span></label>
										<div>
												<?php echo renderFields($field,$check['as_id']);  ?>
										</div>
									</fieldset>
                                                  <fieldset class="label_side">
										<label>File Title:<span>Label placed beside the Input</span></label>
										<div>
												<input type="text" value="<?php echo $field['fl_dval']; ?>" name="stitle<?=$check['as_id']?>" />
										</div>
									</fieldset>
														
														
													
													<input type="hidden" name="casev[]" value="<?php echo "$check[as_id]|$field[fl_key]"; ?>" />                                                <div class="clear" ></div>  
											
											
                                                <div class="nstyle" style="margin:5px 0;" >
									<?php			$attachments = getData($check['as_id'],$field['fl_key']);
													if(mysql_num_rows($attachments)>0){ ?>
													
									<?php				while($att =mysql_fetch_array($attachments)){ 
															if($att['d_stitle']!='') $title=$att['d_stitle']; else $title=$att['d_mtitle'];?>    
															
                                                               <fieldset class="label_side">
										<label><?php echo $title;?><span>Label placed beside the Input</span></label>
										<div>
												<img class="edits" src="img/attachment.png" title="<?=$title?>"
																onclick="showAuto('showproof','<?=$title?>','attach=<?=$att['d_value']?>')" />                                                            
																<!--<img class="edits" src="img/delete.png" title="<?=$title?>"
																onclick="dataActions(<?php echo $att['d_id'];?>,'<?=$title?>')"/> --> 
										</div>
									</fieldset>
											<?php		} ?>
													
											<?php	}  ?>  
												  </div>    
                                                  </div>                                 
								<?php }
								
								
								}
								?>
								</div></div></div></div></div>
								<?
							}
							?>
							<div class="button_bar clearfix">
									<!--	<button class="next_step move light" data-goto="step_3">
											<img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/grey/bended_arrow_left.png">
											<span>Prev Step</span>
										</button>
										<button type="submit" class="next_step green send_right">
											<img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/bended_arrow_right.png">
											<span>Complete</span>
										</button>-->
                                       	<input type="submit" class="input_btn " name="addAttach" value="Submit [ Attachments ] "  />
									</div>
							<?
					}else{
						
						?>
						<div class="section">
					
                                    <P>Thanks For using Application</P>
                                </div>  
						<?
						
						
						}
							?>
                                    
								
									
									
								</div>
                                 <?php }?>
                               </form>
							</div>										
						</div>
				  </div>
  </div>
			
<script type="text/javascript" src="scripts/adminica/adminica_wizard.js"></script>
            
       