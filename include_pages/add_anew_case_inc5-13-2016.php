		 <script type="text/javascript">
     </script>  
	 
	 
	 <?php 
	 $all_Req=1;
	 if($all_Req==1){
	 $parsley_validated_class = 'parsley-validated';
	 $parsley_validated_true = 'data-parsley-required="true"';
	  $aesteric = '*';
	 }
	 if($_REQUEST['ERR']==""){
	
	$_REQUEST['ename1']="";
	$_REQUEST['fname1']="";
	$_REQUEST['cnic1']="";
	$_REQUEST['dob1']="";
	$_REQUEST['empcode1']="";
	$_REQUEST['ischeck1']=array();
}
if(is_numeric($_REQUEST['case']) && $_REQUEST['case']!=0){ 
	$ver_data = getVerdata($_REQUEST['case']);
	$readOnly = "readonly='readonly'";
	$company_id = $ver_data['com_id'];
	$_REQUEST['clntid'] = $company_id;
	$_REQUEST['ename1'] = $ver_data['v_name'];
	$_REQUEST['fname1'] = $ver_data['v_ftname'];
	$_REQUEST['cnic1'] = $ver_data['v_nic'];
	$_REQUEST['dob1']= $ver_data['v_dob'];
	$_REQUEST['empcode1'] = $ver_data['emp_id'];
	$_REQUEST['v_country'] = $ver_data['v_country'];
	$_REQUEST['v_uadd'] = $ver_data['v_uadd'];
	$_REQUEST['v_image'] = $ver_data['image'];
	
	if($_REQUEST['fname1']=='' || strtolower($_REQUEST['fname1'])=='n/a' || strtolower($_REQUEST['fname1'])=='na'){
	$readOnly1 = "";
	}else{
	$readOnly1 = $readOnly;	
	}
	if($_REQUEST['cnic1']==''){
	$readOnly2 = "";
	}else{
	$readOnly2 = $readOnly;		
	}
	
	if($_REQUEST['dob1']=='' || strtolower($_REQUEST['dob1'])=='n/a' || strtolower($_REQUEST['dob1'])=='na'){
	$readOnly3 = "";
	}else{
	$readOnly3 = $readOnly;		
	}
	if($_REQUEST['empcode1']==''){
	$readOnly4 = "";
	}else{
	$readOnly4 = $readOnly;		
	}
	
	$checkCnic_onclick = "";
	$checkEmpcode_onclick = "";
	
}else{
	$checkCnic_onclick = "onblur=\"checkCnic(this.value,'cnic','validate_cnic',1,'check_cnic','nic');\"";
	$checkEmpcode_onclick = "onblur=\"checkCnic(this.value,'emp_id','validate_emp_code',1,'check_cnic','emp');\"";
}
if($LEVEL!=4){
	$company_id = $_REQUEST['clntid'];
	$lev = getLevel($LEVEL);
	$info_title = $lev['level_name'];
	
}else {
	$company_id = $COMINF['id'];
	$info_title = $COMINF['name'];
}



?>

<link rel="stylesheet" href="css/jquery.fileupload.css">

<section class="retracted scrollable">
            <script>
                if (!($('body').is('.dashboard-page') || $('body').is('.login-page'))){
                    if ($.cookie('protonSidebar') == 'retracted') {
                        $('.wrapper').removeClass('retracted').addClass('extended');
                    }
                    if ($.cookie('protonSidebar') == 'extended') {
                        $('.wrapper').removeClass('extended').addClass('retracted');
                    }
                }
				var checks = [];
				var ccount = [];
function submitmychecks()
{				
				
 $.ajax({
	url: "actions.php",
	data:'ePage=add_rating&addnewcheckssingle=yes',
	type: "POST",
	success: function(res){console.log("");},
	error: function(){
    alert('failure');
	}
	
	
	});				
				
				
				
}
				
				
				
            </script> 
            
             <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title2">
                    	<h1><?php include('include_pages/pages_breadcrumb_inc.php'); ?></h1>
                    </div>
                    
                    <?php include("headers_right_menu_inc.php"); ?>
                    
                    </div>
                    </div>
            
                       
            <div class="content">
               
                    <div class="panel panel-flat">
                  
                    
<div class="bulk-dev panel-body">
<form enctype="multipart/form-data" method="post" id="addCheckFrm"  data-parsley-namespace="data-parsley-" data-parsley-validate="" >

<?php if($_REQUEST['err']==1){ ?>
<div class="alert alert-dismissable alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-diff-removed"></i></button><span class="title"><i class="icon-diff-removed"></i> ERROR</span><?=$_REQUEST['msg']?></div>
<?php }?>



   <?php
	
		$uID = $_SESSION['user_id'];
		
			
			
									 if($LEVEL!=4){?>
							<div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label>Select Client:</label>
                  </div>
                  <div class="col-md-9">
                    <select id="clntid" name="clntid" class="select" onchange="document.getElementById('addCheckFrm').submit();">
                      <option value=""> --------Select Client-------- </option>
                      <?php 	$db = new DB();
                                                $dWhere="1=1 order by name asc";							
                                                $coms = $db->select("company","*",$dWhere);
                                              //   echo "select * from company where $dWhere";
                                                $coid = (isset($_REQUEST['clntid']))?$_REQUEST['clntid']:0;
                                                while($com =mysql_fetch_array($coms)){  ?>
                      <option value="<?=$com['id']?>" <?php echo ($com['id']==$_REQUEST['clntid'])?'selected="selected"':'';?>>
                      <?=$com['name']?>
                      </option>
                      <?php	} ?>
                    </select>
                  </div>
                </div>
				</div>
				
				<div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label>How Receive Checks?:</label>
                  </div>
                  <div class="col-md-9">
                    <select id="how_rec_checks" name="how_rec_checks" class="select parsley-validated" data-parsley-required="true" >
                      <option value=""> --------How Receive Checks?-------- </option>
                     
                      <option value="by_email" <?php echo ($_REQUEST['how_rec_checks']=='by_email')?'selected="selected"':'';?>>
                      By Email
                      </option>
					  <option value="by_courier" <?php echo ($_REQUEST['how_rec_checks']=='by_courier')?'selected="selected"':'';?>>
                      By Courier
                      </option>
					  
                      
                    </select>
                  </div>
                </div>
				</div>
							<?php }
						
							

								if($company_id){
										
									?>	
							<!--<div class="case_data">-->
                           
                            <div class="row">
                            	
                                <div class="col-lg-2 col-sm-6">
								
                                <input type="hidden" name="case1" value="1"  data-name="order"/>
							<div class="thumbnail fileinput fileinput-new" data-provides="fileinput">
								<div class="thumb fileinput-preview" data-trigger="fileinput">
                                    <?php 
									
									if(isset($_REQUEST['v_image']) && $_REQUEST['v_image']!='images/default.png' && file_exists(getcwd().'/files/'.basename($_REQUEST['v_image']))){?>
									<img src="<?php echo $_REQUEST['v_image'];?>" alt="" >	
									<?php }else{ ?><img src="images/user-pro.png" alt="" ><?php } ?>
								</div>
								<div id="progress1" class="progress" style="display:none">
                                            <div class="progress-bar prg-profile progress-bar-success"></div>
                                        </div>
								<div class="caption">
									<h6 class="no-margin"> 
									<div id="files1" class="files"></div>
                                    <span class="btn-file user-pro-btn">
                                            	<span class="fileinput-new">Select Image <i class="text-primary icon-plus2 pull-right"></i></span>
                                                <input type="file" name="files[]" id="v_image1" data-id="1" class="user_images">
                                                </span></h6>
								</div>
							</div>
						</div>
                        
                        <div class="col-lg-10">
                        	<div class="sub-bulk-right-sec">
							<?php
                                if($LEVEL==4){
    
                                if(in_array($COMINF[id],unserialize(CHECK_COMIDS))){
                                    
                                    $getUserInf = getUserInfo($uID);
                                    if($getUserInf['puser_id']==0 && $getUserInf['is_subuser']==0){
                                    ?>
                            <div class="col-md-6">
                        	<fieldset>
								
                                
                                <div class="form-group">
                    <div>
                      <div>
                        <select id="user_id" name="user_id" class="select parsley-validated" data-parsley-required="true" >
                          <option value="">Select User</option>
                           <optgroup label="Head Office">
                          
                          <?php $db = new DB();
                          $usersMain = $db->select("users","user_id,concat(first_name,' ',last_name) as fullname","is_active=1 AND loc_id=0 AND com_id=$COMINF[id] AND is_subuser=0");
                          while($rsUsers2 = mysql_fetch_assoc($usersMain)){ ?>
                          <option value="<?php echo $rsUsers2['user_id'];?>" <?php echo chk_or_sel($rsUsers2['user_id'],$_REQUEST['v_uadd'],'selected');?>><?php echo $rsUsers2['fullname'];?></option>
                          
                          <?php } ?>
                         
                          </optgroup>
                          
                          
                          
                          <?php 	
                        $dWhere=" com_id=$COMINF[id] AND status=0 order by location asc";							
                        $locs = $db->select("users_locations","*",$dWhere);
                                                    
                                                
                                                   
                         while($loc =mysql_fetch_array($locs)){  
                        $users = $db->select("users","user_id,concat(first_name,' ',last_name) as fullname","is_active=1 AND loc_id=$loc[loc_id] AND com_id=$COMINF[id]");?>
                          <optgroup label="<?=$loc['location']?>">
                          
                          <?php while($rsUsers = mysql_fetch_assoc($users)){ ?>
                          <option value="<?php echo $rsUsers['user_id'];?>" <?php echo chk_or_sel($rsUsers['user_id'],$_REQUEST['v_uadd'],'selected');?>><?php echo $rsUsers['fullname'];?></option>
                          
                          <?php } ?>
                         
                          </optgroup>
                          <?php	} ?>
                          
                         
                          
                          
                        </select>
                      </div>
                    </div>
                    </div>
                            
                             </fieldset>
                        </div>
						<?php	
                                        }
                                    } 
                                }
                                 ?>
                                         
                             <fieldset class="col-md-6">
                                            <div class="form-group ">
                                                <input type="text" name="ename1" class="form-control  parsley-validated" placeholder="Applicant Name" 
												value="<?php echo $_REQUEST['ename1'];?>"  data-parsley-required="true" id="ename1" <?php echo $readOnly;?> title="Applicant Name">
												<span class="validate_ename"></span>
                                            </div>
											 </fieldset>
											
                              <fieldset class="col-md-6">
                                <div class="form-group ">
                                    <input type="text" name="fname1" class="form-control  parsley-validated" placeholder="Father Name" value="<?php echo $_REQUEST['fname1'];?>" data-parsley-required="true" id="fname1" <?php echo $readOnly1;?> title="Father Name">
                                    <span class="validate_fname"></span>
                                </div>
                               </fieldset>
										
										
										
										
										
                                        <fieldset class="col-md-6">
                                            <div class="form-group">
                                                <input type="text"  name="cnic1" class="form-control parsley-validated cnic" placeholder="<?php echo ID_CARD_NUM;?>" value="<?php echo $_REQUEST['cnic1'];?>"  data-parsley-maxlength-message="Sorry. You must type maximum 50 digits of ID Card" data-parsley-type="digits" data-parsley-maxlength="50" data-parsley-required="true"    
												<?php echo $checkCnic_onclick; ?>
												onkeyup="this.value=this.value.replace(/[^\d]/,'');" maxlength="50" <?php echo $readOnly2;?> title="<?php echo ID_CARD_NUM;?>">
												<span class="validate_cnic check-at-code"></span>
                                            </div>
											
										</fieldset>
										
										<fieldset class="col-md-6">
                                            <div class="form-group ">
                                                <input type="text" name="dob1" class="form-control <?php echo ($readOnly3=='')?'datetimepicker-month1':'';?>" placeholder="Date of Birth" value="<?php echo $_REQUEST['dob1'];?>" <?php echo $readOnly3;?> readonly title="Date of Birth">
												
												
												<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
											  
                                              <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
                                                <script type="text/javascript">
												$(function () {
												$( ".datetimepicker-month1").datepicker({
												dateFormat: 'yy-mm-dd',
												changeMonth: true,
												changeYear: true,
												yearRange: "1900:<?php echo date("Y");?>"
												});
												});
												</script>
													
                                            </div>
                                        </fieldset>
																			
										<fieldset class="col-md-6">
                                            <div class="form-group ">
                                                <input type="text" name="empcode1" class="form-control parsley-validated emp_id" placeholder="<?php echo CLIENT_REF_NUM;?>" title="<?php echo CLIENT_REF_NUM;?> / Employee ID" value="<?php echo $_REQUEST['empcode1'];?>"  <?php echo $checkEmpcode_onclick;?> data-parsley-required="true" maxlength="20" <?php //echo $readOnly4;?>>
												<span class="validate_emp_code check-at-code"></span>
                                            </div>
                                        </fieldset>
                                        
                                        
										
										<!--
                                        <fieldset class="col-md-6">
                                            <div class="form-group float-left free-margin">
                                            <div>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                  
                                                  <span class="fileinput-filename"></span>
                                                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                </div>
                                            </div>
                                            
                                            </div>
                                        </fieldset>-->
                                      <fieldset class="col-md-6">
                                            <div class="form-group ">
                                                <input type="text" name="v_address1" class="form-control  parsley-validated" placeholder="Current Resident Address" value="<?php if(trim($_REQUEST['v_address'])){echo $_REQUEST['v_address'];}?>" title="Current Resident Address">
												 
                                            </div>
											 </fieldset>                                          
                                   <fieldset class="col-md-6">     
                                        <select name="country" class="select">
                      <option value="0" >--Select Country--</option>
                      <?php 
                                        $countries = $db->select("country","country_id,printable_name");
                                        while($country = mysql_fetch_assoc($countries)){ ?>
                      <option value="<?=$country['country_id']?>" <?=($_REQUEST['v_country']==$country['country_id'])?'selected="selected"':($country['country_id']==171)?'selected="selected"':''?> >
                      <?=$country['printable_name']?>
                      </option>
                      <?php } ?>
                    					</select>
                                  </fieldset>
                                  
                                  
                                  
                                  
                                        
                                    <?php /*?> <div id="updatecity">
                    <?php
                                    $_REQUEST['cntid'] = $verCheck['country_id'];
                                    include("include_pages/getcity_inc.php");                            
                                ?>
   
                                    </div><?php */?>
                        
                        </div>
                        
                            
                            </div>
                            <?php 
							
							
							
							$getClientPkgChecks = getClientPkgChecks($company_id);
							$cicChecks =array(39,40,41);
							$ccc=0;
							foreach($getClientPkgChecks['checks_ids'] as $CHKS){
							
							if(in_array($CHKS,$cicChecks)){
							$ccc++;	
							}	
							}
							if($ccc < 3){
														
							?>
							
							 <div class="col-lg-12 progress-bar-parent" >
                                           <div>
                                        	<div class="panel panel-white">
                                       <div class="panel-heading">
                                              <h6 class="panel-title text-semibold"> 
										<label><input type="checkbox" name="cic_check_needed"  class="styled" value="cic_req" /> 
								
                                             
                                            Criminal Intelligence Check (Optional) <a class="text-grey" href="javascript:;" title="" data-popup="tooltip" data-trigger="hover" data-container="body" data-placement="bottom" data-original-title="Add CIC check for this applicant."><i class="icon-info22 position-right"></i></a></label>
                                                    </h6>
                                                   
                                                </div>
												</div>
												</div>
												</div>
                          
							   
                                <?php 
								}
								$where = "cc.com_id=$company_id AND ck.is_active=1 AND cc.clt_active=1 order by ck.checks_id";
								$tabls = "checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id";
								$checks = $db->select($tabls,"*",$where);
								if(mysql_num_rows($checks)>0){
									$num_check = 100;
									$cc=0;
                    				while($check = mysql_fetch_assoc($checks)){
									$cc++;?>
									












									   
                                        <div class="col-lg-12 progress-bar-parent mainDivchecks" >
                                           <div>
                                        	<div class="panel panel-white">
                                            	<div class="panel-heading">
                                              <h6 class="panel-title text-semibold"> 
										<input type="checkbox" name="ischeck1[]" data-parsley-required="true" data-parsley-error-message="You must select at least one check" data-att-req="<?=$check['is_attachment']?>" class="styled parsley-validated parsley-error tickbox checknum_<?=$check['checks_id']?>" value="<?=$check['checks_id']?>_1"  id="<?=$num_check?>" <?=(in_array($check['checks_id'].'_1',$_REQUEST['ischeck1']))?'checked':''?> checked="checked"  onclick="this.checked=!this.checked;" /> 
										
										<?=convertUCWords($check['checks_title'])?>   
													<?php if(!empty($check['checks_tooltip'])){ ?>
                                            	<a class="ctooltips text-grey" href="#"><i class="icon-info22"></i><span><?=$check['checks_tooltip']?></span></a>
                                            <?php }?>
                                             <?php /*?><a href="#" class="checktooltip" title="<?=$check['checks_tooltip']?>"><i class="icon-info-sign"></i></a><?php */?>
                                            <?php if($check['is_multi']==1){?>
                                            <a href="javascript:void(0);" class="text-primary" onclick="addmorecheck(this,<?=$check['checks_id']?>,1,'<?=addslashes(convertUCWords($check['checks_title']))?>')"><i class="icon-plus22"></i></a> 
                                            <?php } ?>
                                                    </h6>
                                                   
                                                </div>
                                                
                                                <div class="panel-body" <?php if(!in_array($check['checks_id'],array(1,2))){ ?> style="display:none;" <?php } ?>>
                                                	<div>
                                        <div>
										<p class="text-muted ml-5" style="float:right;">
										<a class="ctooltips text-grey" href="#" title="Allowed file types:(<?php echo FILE_TYPES_ALLOWED;?>)
										Max file size (<?php echo FILE_SIZE_ALLOWED;?>)" data-popup="tooltip" data-trigger="hover" data-container="body" data-placement="left"><i class="icon-info22"></i></a>
										
										</p>
                                        <div id="dprogress1<?=$num_check?><?=$num_check?>" class="progress bulk-upload-prgs" style="width:70%">
                                        <div class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <span style="float:right;" class="btn bg-info-400 btn-file"><span class="fileinput-new">Select file</span>
                                        <input type="hidden" value="<?=$check['checks_id']?>_1" name="checks1[]"  />
                                        <input type="file" name="files[]" id="docs1<?=$num_check?><?=$check['checks_id']?>" multiple class="docs_files" data-id="<?=$num_check?>" data-check="<?=$check['checks_id']?>" data-count="1" data-ccounter="_1" data-attchid="<?=$num_check?>" /></span>
                                        </div>
                                        <div style="clear:both"></div>
                                        <div id="docs_file1<?=$num_check?><?=$num_check?>" class="files checkAttached"></div>
										<input name="see_checks_<?=$check['checks_id']?>" value="1"  type="hidden" >
                                        	
                                         <div class="clearFix"></div>
                          <!--  // by ata   -->               
						 
                          <?php
                           if($check['checks_id'] == 1)
                           { 
						   ?>
						     <!--<div class="col-md-12">
                            <h6>Education Details</h6>
                            <div class="row">
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="uni_name1_1" placeholder="University Name" value="" class="form-control clss_hide_remov1"  >
                            </div>
                            -->
                               <div class="col-md-4">
                            <div class="form-group" id="foruniselect">
                            
                            <input type="text" class="form-control typeahead-basic <?php echo $parsley_validated_class; ?>" name="uni_name1_1" placeholder="University Name<?php echo $aesteric;?>"   >
                             
                            
                            
                           <?php /*?> <select name="uni_name1_1" id="unidropdowns" class="select clss_hide_remov1" onchange="selectinguni();" >
                            <option value="">-- Select University --</option>
                            <option value="other">Other</option>
                            <?php
                            $Fields = $db->select("uni_info","*",'1=1');
                             while($unis = mysql_fetch_array($Fields))
                            { 
                            echo '<option value="'.$unis['uni_Name'].'">'.$unis['uni_Name'].'</option>';
                            }
                            ?>
                            
                            </select><?php */?>
                             
                             
                             
                             
                            </div>
                             
                            </div>
                            
                                                        <!-- <div class="col-md-4" id="foruniother_1" style="display:none">
                            <div class="form-group" id="fieldappends_1">
                            <input type="text" name="uni_name1_1_other" placeholder="University Name" value="" class="form-control clss_hide_remov1"  >
                            </div>
                            </div>-->
                            
                            
                            
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="reg_num1_1" placeholder="Registration Number<?php echo $aesteric;?>" value="" class="form-control clss_hide_remov1 <?php echo $parsley_validated_class; ?>" <?php echo $parsley_validated_true; ?> >
                            </div></div>
                            
                            
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="degree1_1" placeholder="Degree Title<?php echo $aesteric;?>" value="" class="form-control clss_hide_remov1 <?php echo $parsley_validated_class; ?>" <?php echo $parsley_validated_true; ?> title="Type Qualification e.g: BSC,MSC,BCS">
                            </div></div>
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="remarks1_1" placeholder="Remarks<?php echo $aesteric;?>" value="" class="form-control clss_hide_remov1 <?php echo $parsley_validated_class; ?>" <?php echo $parsley_validated_true; ?>    title="Type Remarks e.g: Passed,Fail">
                            
                            </div></div>
                            
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="pass_year1_1" placeholder="Passing Year<?php echo $aesteric;?>" value="" class="form-control clss_hide_remov1 <?php echo $parsley_validated_class; ?>" <?php echo $parsley_validated_true; ?> title="">
                            </div></div>
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="serial_no1_1" placeholder="Serial No<?php echo $aesteric;?>" value="" class="form-control clss_hide_remov1 <?php echo $parsley_validated_class; ?>" <?php echo $parsley_validated_true; ?>  title="">
                            </div></div>
                            
                            
                            
                            <!--<div class="col-md-4">
                            <div class="form-group">
                            Other University? <input type="checkbox" name="otheruni" id="otheruni" >
                            </div></div>-->
                            
                            
                             <div id="appendforeducation"></div>
							
                            
                           <script>
			/*				 function selectinguni()
						 { var uniselect = $("#unidropdowns").val();
							 if(uniselect == 'other')
							 {
							$("#foruniother_1").show(); 
							$("#fieldappends_1").html('<input type="text" name="uni_name1_1_other" placeholder="University Name" value="" class="form-control clss_hide_remov1"  >');
							
 							 }
							 else
							 {
								//$("#s2id_unidropdowns").show();
							$("#foruniother_1").hide(); 
							$("#fieldappends_1").html('');
							}
 							}  
						   
					    
$("#otherunxxxi").click(function() {
    if($(this).is(":checked")) {
        
        $("#foruniother").html("<input type='text' name='uni_name1_1' placeholder='University Name' value='' class='form-control clss_hide_remov1' >");
		 
		$("#unidropdowns").attr('disabled','disabled');
		$("#s2id_unidropdowns").hide();
    } 
	else {
       $("#s2id_unidropdowns").show();
        
	    $("#foruniother").html("");
		//$("#foruniselect").prop('disabled', false);
		$("#unidropdowns").removeAttr('disabled');
   
   
    }
});
*/						   </script> 
<?php /*?>                 <select name='uni_name1_1' class='select clss_hide_remov1' >
                            <option value=''>-- Select University --</option>
                            <?php
                            $Fields = $db->select("uni_info","*",'1=1');
                             while($unis = mysql_fetch_array($Fields))
                            { 
                            echo "<option value='".$unis['uni_id']."'>'".$unis['uni_Name']."'</option>";
                            }
                            ?>
                            </select>         
<?php */?>                          
                          
                          
                          
                             
							<?php
                            }  
							?>

                           <?php
                           if($check['checks_id'] == 2)
                           { 
						   ?>
                            <div class="col-md-12">
                            <h6>Previous Employment Details</h6>
                            <div class="row">
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="company_name1_1" placeholder="Company Name<?php //echo $aesteric;?>" value="" class="form-control clss_hide_remov1 typeahead-basic2 <?php // echo $parsley_validated_class; ?>" <?php // echo $parsley_validated_true; ?>>
                            </div></div>
                            
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="date_of_join1_1" id="date_of_join0" placeholder="Date of Joining (YYYY-MM-DD)<?php //echo $aesteric;?>" value="" class="form-control clss_hide_remov1 date datetimepicker-month <?php // echo $parsley_validated_class; ?>" <?php // echo $parsley_validated_true; ?>   title="Type Date of Joining (YYYY-MM-DD)">
                            </div></div>
                            <!--]-->
                            
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="emp_status1_1" placeholder="Employement Status<?php //echo $aesteric;?>" value="" class="form-control clss_hide_remov1 <?php // echo $parsley_validated_class; ?>" <?php // echo $parsley_validated_true; ?> >
                            </div></div>
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="last_work_day1_1" placeholder="Last Working Day<?php //echo $aesteric;?>" value="" class="form-control clss_hide_remov1 <?php // echo $parsley_validated_class; ?>" <?php // echo $parsley_validated_true; ?> >
                            </div></div>
                            
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="last_designation1_1" placeholder="Last Designation<?php //echo $aesteric;?>" value="" class="form-control clss_hide_remov1 <?php // echo $parsley_validated_class; ?>" <?php // echo $parsley_validated_true; ?> >
                            </div></div>
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="last_place_posted1_1" placeholder="Last Place of Posting<?php //echo $aesteric;?>" value="" class="form-control clss_hide_remov1 <?php // echo $parsley_validated_class; ?>" <?php // echo $parsley_validated_true; ?> >
                            </div></div>
                            
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="last_drawn_salary1_1" placeholder="Last Drawn Salary<?php //echo $aesteric;?>" value="" class="form-control clss_hide_remov1 <?php // echo $parsley_validated_class; ?>" <?php // echo $parsley_validated_true; ?> >
                            </div></div>
                            
                            </div>
                            
                            <div id="appendforpreemploy"></div>
                            </div>							 
							<?php
                            }  
							?>
                          
                           <!--  // by ata end  -->                  
                                    
                                        </div>
                                                </div>
                                                
                                            
                                            </div>
                                        
                                        </div>
                               
                                       
                                        </div>

										<script>
                                         	checks[<?=$check['checks_id']?>] = <?=$num_check?>;
											ccount[1<?=$check['checks_id']?>] = 1;
                                        </script>
                             		<?php   
									$num_check++;
									}
								} ?>
                             
                             
                             </div>  
                             
                             <div class="clearFix"></div>        
               
          <button type="submit" class="btn bg-success check_cnic pull-right" name="submit_bulk"  ><i class="icon-arrow-right14 position-left"></i> Submit</button> <!--<input type="button"  name="asd" onclick="submitmychecks();" value="checksubmiy"  />-->
		  <input type="hidden"  name="is_bulk" value="0"  />
		 
		  <input type="hidden"  id="attachment_counter" name="attachment_counter" value="0"  />	
		  
			<?php
						
			
								}
	
   ?>  	
                             </form>
 
<!--                            <div class="add-row-bulk">
                         		<a href="javascript:;"><i class="icon-plus"></i></a>
                         	</div>
                            <div></div>-->
                            <div class="clearFix"></div>
                        </div>
                    	<div class="clearFix"></div>
                    </div>
                
            </div>
                </section>
<script src="js/load-image.all.min.js"></script>
<script src="js/jquery.ui.widget.js"></script>
<script src="js/canvas-to-blob.min.js"></script>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.fileupload.js"></script>
<script src="js/jquery.fileupload-process.js"></script>
<script src="js/jquery.fileupload-image.js"></script>
<script src="js/jquery.fileupload-audio.js"></script>
<script src="js/jquery.fileupload-video.js"></script>
<script src="js/jquery.fileupload-validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){

 var country = $("#addCheckFrm").val();
 updatecity(country);


 $("#addCheckFrm").submit(function(e){
 var valid = true;
	 var ename = document.getElementById('ename1').value;
	 var fname = document.getElementById('fname1').value;
	 
	if(ename.match("((^[0-9 ]+[a-z]+)|(^[a-z]+[0-9 ]+))+[0-9a-z ]+$")){
  //return true; 
  $('.validate_ename').html('');
}else if(ename.match("^[a-zA-Z ]*$")){
 //return true;
 $('.validate_ename').html('');
}
else{

   document.getElementById('ename1').focus();
   $('#ename1').addClass("parsley-error");
  $('.validate_ename').html('<ul   class="parsley-error-list"><li class="required" style="display: list-item;">Please type aplhanumeric or alphbets characters only !</li></ul>');
   //alert("Please type aplhanumeric or alphbets characters only !");
   valid = false;
   return valid;
} 
	 
if(fname.match("((^[0-9 ]+[a-z]+)|(^[a-z]+[0-9 ]+))+[0-9a-z ]+$")){
  //return true;
  $('.validate_fname').html('');
}else if(fname.match("^[a-zA-Z ]*$")){
//return true;
$('.validate_fname').html('');
}
else{

   document.getElementById('fname1').focus();
   $('#fname1').addClass("parsley-error");
  
   $('.validate_fname').html('<ul   class="parsley-error-list"><li class="required" style="display: list-item;">Please type aplhanumeric or alphbets characters only !</li></ul>');
   // alert("Please type aplhanumeric or alphbets characters only !");
   
   valid = false;
   return valid;
}
	 
	 
	 
	 $('.mainDivchecks').each(function (ind,obj){
		 var abd = $(this).find('.tickbox');
		 var is_doc_req  = $(".tickbox").attr("data-att-req");
		 var vl = $(abd).val().split("_");
		// console.log(vl);
		 if($(abd).is(":checked") == true){
		 if(vl[0] == 1 || vl[0] == 2)
		 {
			if($(this).find('.checkAttached').html()==""){
				alert("Please add attachment for Education and Previous Employment!");
								valid = false;
							   return valid;
			}
		 }
		 }
		 
		 
		 
			/*  if($('.tickbox').checked == true){
				 alert("found");
				 
			 }  */
			 
		 
		 /* if(this.checked == true){
			 $('.checkAttached').each(function(){
			
			  //var abc = obj.id;
			 
			alert($(this).html());
					if($(this).html()=="")
							{
								alert("Please add attachment !");
								valid = false;
							   return valid;
							}   
			 });							
		  }; */                        
		});
		
		
	return valid;	
});
});


<?php /* 	$(document).ready(function(){
     $(".filebtn").click(function(e){
 $('.tickbox').each(function (){
		 if(this.checked == true){
					if($('.docs_files').val()=="")
							{
								alert("Please Insert file");
							};	   
		  };                        
		});
       });
     }); */
 ?>    	
 
 
		$(".user_images").each(function(index, element) {
            set_image($(this).data('id'));
        });

		$(".docs_files").each(function(index, element) {
            set_docs($(this).data('id'),$(this).data('count'),$(this).data('check'),$(this).data('ccounter'),$(this).data('attchid'));
        });
		
</script>
<script src="scripts/vendor/bootstrap-datetimepicker.js"></script>

<script src="scripts/vendor/fileinput.js"></script>
<!-- <script href="scripts/vendor/parsley.remote.js"></script> -->
<script src="scripts/vendor/parsley.min.js"></script>

<script src="scripts/vendor/parsley.extend.min.js"></script>
<script type="text/javascript">
function checkCnic(vl,ur,div_cl,len,att,chk){
    
    var ext_msg="";  
    var response = false;
	if(vl.length >= len){
		$("."+div_cl).html('<img align="right" src="images/spinners/3.gif" />');
              $.ajax({
	url: "actions.php",
	data:'ePage=add_rating&'+ur+'='+vl+'&chk='+chk+'&com_id=<?php echo $company_id;?>',
	type: "POST",
	success: function(res){
    if(res=='not-found'){
		$('.'+div_cl).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item; color:green;"><i class="icon-checkmark4"></i></li></ul>');
		
		$('.'+att).removeAttr('onclick');
		$('.'+att).attr('type','submit');
		valDate(att);

		return true;

	}else{
	if(ur=='emp_id'){
		//var ext_msg = ".<br />Selected checks will be added to this employee";
	
		$('.'+div_cl).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item;"><i class="icon-cross3"></i> '+res+'</li></ul>');
		return true;
	}else{
		$('.'+div_cl).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item;"><i class="icon-cross3"></i> '+res+'</li></ul>');
		$('.'+att).attr('onclick','stopThis("'+ur+'")');
		$('.'+att).attr('type','button');
		return false;
	}
		
		
	}
	},
	error: function(){
    alert('failure');
	}
	
	
	});
	}else{
	$('.'+div_cl).html('');
	//$('.check_cnic').removeAttr('onclick');	
	}

    return response;
        
}

function stopThis(ur){
	$('.'+ur).focus();
	return false;
}

function valDate(att){
	var validate_cnic = $('.validate_cnic').text();
	var validate_emp_code = $('.validate_emp_code').text();
	if(validate_cnic!=""){
		$('.'+att).attr('onclick','stopThis()');
		$('.'+att).attr('type','button');
		
	}else{
		$('.'+att).removeAttr('onclick');
		$('.'+att).attr('type','submit');
	}
	return false;
	//alert(validate_cnic + validate_emp_code);
}



/* $('.cnic').parsley()
  .addAsyncValidator('mycustom', function (xhr) {
    console.log(this.$element); // jQuery Object[ input[name="q"] ]

    return 404 === xhr.status;
  }, 'actions.php'); */

// by ata

/*$(".previousemp_form").hide();
$(".checknum_47").click(function() {
    if($(this).is(":checked")) {
        $(".previousemp_form").show();
    } else {
        $(".previousemp_form").hide();
    }
});

*/

</script>
   
     