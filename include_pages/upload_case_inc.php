		
	 <?php 
	 if($_REQUEST[errr]==1){
		 msg('err',"Please select a csv file to upload!");
	 }
	 $uID = $_SESSION['user_id'];
	 
	 $comids_allow_uncheck = getComidsCustomOrder();
	 //var_dump($comids_allow_uncheck);
	 //$comids_allow_uncheck = array(1,94,71,87,102); //1=mobilink 94=OBS 71=Philip Morris 87=engro foods 102=Beltexco
	 $all_Req=0;
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
	if($_REQUEST['cnic1']=='' || $_REQUEST['cnic1']=='N/A' || $_REQUEST['cnic1']=='n/a'){
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
<style>
.fileinput {width: 86%;float: left;}
.bulk-upl .btn-primary{background-color: #43bce9;border-color: #43bce9;padding: 9px 0;}
.bulk-upl .btn-primary:hover{background-color: #b7b7b8;border-color: #b7b7b8;}
.bulk-upl .form-control{background: #eae9e8;border: none;float: left;display: inline-block;width: 77%;}
.bulk-upl .input-group {position: relative;display: inline-block;width: 100%;}
.bulk-upl .form-group.bul_up_sec{margin-top: 30px;}
.bulk_field .form-group{width: 100%; display: inline-block;}

.bulk_check .checker, .bulk_check .checker span, .bulk_check .checker input{
	width: 25px;
    height: 25px;
}
.bulk_check .checker span{    color: green;
    border: 2px solid #eee;
    display: inline-block;

    text-align: center;
    position: relative;
    background: #eee;}
    
.bulk_check .checker span:after{font-size: 23px;color: green;left: -2px;}
.checkbox.bulk_check label{padding-left: 36px;font-size: 16px;}
table.field_data{border: 1px solid #b7b7b8;}
table.field_data th {
    font-weight: 700;
    color: #808285;
    padding: 4px;
}
table.field_data td {
    color: #808285;
    padding: 4px;
}
table.field_data td select{
	border: none;
    background: #eae9e8;
    color: #808285;
    width: 83%;
    padding: 2px;	
}
.crd_adv{position: absolute;right: 32px;}
.crd_adv .well{padding: 13px;}

</style>
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
			
			<!-- Single Case Upload Section Start-->
			<form ></form>
<form enctype="multipart/form-data" method="post" id="addCheckFrm"  data-parsley-namespace="data-parsley-" data-parsley-validate="" >
	<div class="col-md-6">
    	<h5> <label class="radio-inline">
				<input type="radio" name="uploadtype" class="styled" id="uploadtype1" onchange="checkRadio(2,1);"> Upload a single case
                </label>
        </h5>
    
    <div class="col-md-12">
	
	
	
		<?php
							if($LEVEL!=4){?>
								<div class="col-md-6">
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
								</div>
									
								<div class="col-md-6">			
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
								</div>
							<?php }
	
	
		
                                if($LEVEL==4){
    
                                if(in_array($COMINF[id],unserialize(CHECK_COMIDS))){
                                    
                                    $getUserInf = getUserInfo($uID);
                                    if($getUserInf['puser_id']==0 && $getUserInf['is_subuser']==0){
                                    ?>
                            <div class="col-md-12">
                        	
								
                                
                                <div class="form-group">
                    
                        <select id="user_id" name="user_id" class="select parsley-validated" data-parsley-required="true" >
                          <option value="">Select User</option>
                           <optgroup label="Head Office">
                          
                          <?php $db = new DB();
                          $usersMain = $db->select("users","user_id,concat(first_name,' ',last_name) as fullname","is_active=1 AND loc_id=0 AND level_id=4 AND com_id=$COMINF[id] AND is_subuser=0");
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
						<?php	
                                        }
                                    } 
                                }
								
			if($company_id){					
                                 ?>
	
		 <div class="col-md-12">
    	<div class="col-md-6">
        	<div class="form-group">
            	<label class="display-block">Applicant Name<span>*</span></label>
				 <input type="hidden" name="case1" value="1"  data-name="order"/>
               <input type="text" name="ename1" class="form-control  parsley-validated" placeholder="Applicant Name" 
												value="<?php echo $_REQUEST['ename1'];?>"  data-parsley-required="true" id="ename1" <?php echo $readOnly;?> title="Applicant Name">
												<span class="validate_ename"></span>
            </div>
        </div>
        <div class="col-md-6">
        	<div class="form-group">
            	<label class="display-block">Father Name</label>
                 <input type="text" name="fname1" class="form-control" placeholder="Father Name" value="<?php echo $_REQUEST['fname1'];?>" id="fname1" <?php echo $readOnly1;?> title="Father Name">
                                    <span class="validate_fname"></span>
            </div>
        </div>
        </div>
		 <div class="col-md-12">
		<div class="col-md-6">
        	<div class="form-group">
            	<label class="display-block"><?php echo ID_CARD_NUM;?><span>*</span></label>
                 <input type="text"  name="cnic1" class="form-control parsley-validated cnic" placeholder="<?php echo ID_CARD_NUM;?>" value="<?php echo $_REQUEST['cnic1'];?>"  data-parsley-maxlength-message="Sorry. You must type maximum 50 digits of ID Card" data-parsley-type="digits" data-parsley-maxlength="50" data-parsley-required="true"    
												<?php echo $checkCnic_onclick; ?>
												onkeyup="this.value=this.value.replace(/[^\d]/,'');" maxlength="50" <?php echo $readOnly2;?> title="<?php echo ID_CARD_NUM;?>">
												<span class="validate_cnic check-at-code"></span>
            </div>
        </div>
        <div class="col-md-6">
        	<div class="form-group">
            	<label class="display-block"><?php echo CLIENT_REF_NUM;?><span>*</span></label>
                <input type="text" name="empcode1" class="form-control parsley-validated emp_id" placeholder="<?php echo CLIENT_REF_NUM;?>" title="<?php echo CLIENT_REF_NUM;?> / Employee ID" value="<?php echo $_REQUEST['empcode1'];?>"  <?php echo $checkEmpcode_onclick;?> data-parsley-required="true" maxlength="20" <?php //echo $readOnly4;?>>
												<span class="validate_emp_code check-at-code"></span>
            </div>
        </div>
		</div>
		 <div class="col-md-12">
		<div class="col-md-6">
        	<div class="form-group">
            	<label class="display-block">Select Country<span>*</span></label>
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
            </div>
        
		</div>
		<div class="col-md-6">
        	<div class="form-group">
            	<label class="display-block">Comments</label>
                <textarea name="comments1" class="form-control" placeholder="Comments" title="Type your comments" ><?php echo $_REQUEST['comments1'];?></textarea>
												
            </div>
        </div>
		</div>
		<div class="col-md-12">
	<?php $num_check = 100; 
	$lCount=2;?>
        	<div class="form-group">
            	<p class="text-muted float-right ml-5"  > <a class="text-grey"  href="#" title="Allowed file types:(<?php echo FILE_TYPES_ALLOWED;?>)	Max file size (<?php echo FILE_SIZE_ALLOWED;?>)" data-popup="tooltip" data-trigger="hover" data-container="body" data-placement="left"><i class="icon-info22"></i></a> </p>
                            <div id="dprogress<?=($lCount-1)?><?=$num_check?><?=$num_check?>" class="progress bulk-upload-prgs" style="width:70%">
                              <div class="progress-bar progress-bar-success"></div>
                            </div>
                            <span style="float:right;" class="btn btn-primary btn-file"><span class="fileinput-new">Select file</span>
                            <input type="hidden" value="<?=($lCount-1)?>_1" name="checks<?=($lCount-1)?>[]"  />
                            <input type="file" name="files[]" id="docs<?=($lCount-1)?><?=$num_check?><?=($lCount-1)?>" multiple class="docs_files parsley-validated" data-id="<?=$num_check?>" data-check="<?=($lCount-1)?>" data-count="<?=($lCount-1)?>" data-ccounter="_1" data-attchid="<?=$num_check?>" onclick="uploadAttach('docs<?=($lCount-1)?><?=$num_check?><?=($lCount-1)?>')" data-parsley-required="true"  />
                            </span>
                            <input type="hidden" id="limit_docs<?=($lCount-1)?><?=$num_check?><?=($lCount-1)?>" value="0">
                          <div style="clear:both"></div>
                          <div id="docs_file<?=($lCount-1)?><?=$num_check?><?=$num_check?>" class="files checkAttached"></div>
                          <input name="see_checks_<?=($lCount-1)?>" value="1"  type="hidden" >
                          <div class="clearFix"></div>
            </div>
        </div>
		 
		<script>
		checks[<?=($lCount-1)?>] = <?=$num_check?>;
		ccount[<?=($lCount-1)?><?=($lCount-1)?>] = 1;
		</script>
										
		<div class="col-md-10">
        	<div class="form-group">
            	<button type="submit" class="btn bg-success check_cnic pull-right" name="upload_case_only"  ><i class="icon-arrow-right14 position-left"></i> Submit</button> <!--<input type="button"  name="asd" onclick="submitmychecks();" value="checksubmiy"  />-->
		  <input type="hidden"  name="is_bulk" value="0"  />
		 
		  <input type="hidden"  id="attachment_counter" name="attachment_counter" value="0"  />	
                 
            </div>
        </div>
			<?php } ?>
	</div>
	

	
	
	
	
	
	
    
    </div>
	</form>
	<!-- Single Case Upload Section End-->
    
	
	<!-- Bulk Upload Section Start-->
	
	<form method="post" enctype="multipart/form-data" id="addCheckFrm2" action="?action=advanced_bulk&atype=easy_upload"  data-parsley-namespace="data-parsley-" data-parsley-validate="">
	<div class="col-md-6">
    	<h5> <label class="radio-inline">
				<input type="radio" name="uploadtype" class="styled" id="uploadtype2" onchange="checkRadio(1,2);"> Upload bulk cases
                </label>
        </h5>
		<?php
					if($LEVEL!=4){?>
								<div class="col-md-6">
									<div class="form-group">
										<div class="row">
										  <div class="col-md-3">
											<label>Select Client:</label>
										  </div>
										  <div class="col-md-9">
											<select id="clntid" name="clntid" class="select" >
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
								</div>
									
								<div class="col-md-6">			
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
								</div>
							<?php }
		 if($LEVEL==4){
    
                                if(in_array($COMINF[id],unserialize(CHECK_COMIDS))){
                                    
                                    $getUserInf = getUserInfo($uID);
                                    if($getUserInf['puser_id']==0 && $getUserInf['is_subuser']==0){
                                    ?>
                            <div class="col-md-12">
                        	
								
                                
                                <div class="form-group">
                    
                        <select id="user_id" name="user_id" class="select parsley-validated" data-parsley-required="true" >
                          <option value="">Select User</option>
                           <optgroup label="Head Office">
                          
                          <?php $db = new DB();
                          $usersMain = $db->select("users","user_id,concat(first_name,' ',last_name) as fullname","is_active=1 AND loc_id=0 AND level_id=4 AND com_id=$COMINF[id] AND is_subuser=0");
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
						<?php	
                                        }
                                    } 
                                } ?>
    <div class="col-md-12">
    	<div class="form-group">
                                    <div class="row">	
									<label class="col-lg-3 control-label">Choose File:</label>
									<div class="col-lg-9">
										
					<div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="input-group">
                        <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                        <span class="input-group-addon btn btn-primary btn-file">
                        <span class="fileinput-new"><i class="icon-plus2  icon-rotate-cw3"></i></span>
                        <span class="fileinput-exists"><i class="icon-rotate-cw3"></i></span>
                        <input type="file" class="files" name="bulk_file">
                        </span> <a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                    </div><!--<span class="help-block pull-right">Choose File (Format)</span>-->
                                        <button type="submit" class="btn bg-success" name="upload_bulk" value="" ><i class="icon-check"></i></button>
									</div>
                                    </div>
                                    </div>
    </div>
	 <div class="col-md-12">
	 <div class="form-group">
	<button type="button" class="btn bg-red" onclick="document.location='files/format/applicant-easy-bulkupload-sample.csv'"><i class="icon-file-download position-left"></i> Download Sample Format</button>
	  </div>
    </div>
	
    </div>
	</form>
	<!-- Bulk Upload Section End-->


 
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
	 
	 
	 
	if($('.checkAttached').html()==""){
				alert("Please add atleast one attachment !");
								valid = false;
							   return valid;
			}
		
		
	return valid;	
});
});



 
		$(".user_images").each(function(index, element) {
            set_image($(this).data('id'));
        });

		/* $(".docs_files").each(function(index, element) {
            set_docs($(this).data('id'),$(this).data('count'),$(this).data('check'),$(this).data('ccounter'),$(this).data('attchid'));
        }); */
		
		function uploadAttach(id){
			
		
			
			var chk = $("#limit_"+id).val();
			
			if(chk==0){
            set_docs($("#"+id).data('id'),$("#"+id).data('count'),$("#"+id).data('check'),$("#"+id).data('ccounter'),$("#"+id).data('attchid'));
			$("#limit_"+id).val(1);
			}
			

      
		}
		
</script>
<script src="scripts/vendor/bootstrap-datetimepicker.js"></script>
<script src="scripts/vendor/fileinput.js"></script>
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

function checkRadio(idd,chk){
	$("#uploadtype"+idd).removeAttr('checked');
	$("#uniform-uploadtype"+idd+" span").removeClass('checked');
	
}

</script>
   
     