
<?php 
 $all_Req=1;
	 if($all_Req==1){
	 $parsley_validated_class = 'parsley-validated';
	 $parsley_validated_true = 'data-parsley-required="true"';
	  $aesteric = '*';
	 }
	 
	 
//echo 'check_ids';
//$employeCodes =  $_REQUEST['emp_code'];
//$hash =  $_REQUEST['hash'];
//$idValues = array();
//foreach( $_REQUEST['check_ids'] as $ids){
	//$idValues[] = $ids;
//}
//$checkIds =  implode(",",$idValues);
//die;
	$user_id = $_SESSION['user_id'];
	$uInfo = $db->select("users","*","user_id=$user_id");
	$userInfo = mysql_fetch_assoc($uInfo);
	
	$company_id = $userInfo['com_id'];
	
	$hashInfo = $db->select("check_date","*","user_id='$user_id'");
	if(mysql_num_rows($hashInfo)>0){
		$hInfo = mysql_fetch_assoc($hashInfo);
		$userHash = $hInfo['cd_hash'];
		$userHashDate = $hInfo['cd_date'];
		$userHashExpDate 	= $hInfo['cd_exp_date'];
		$checkIds =  $hInfo['checks_ids'];
		$checks_qtys =  $hInfo['checks_qtys'];
		$employeCodes =  $hInfo['cd_employee_code'];
	}
	$curr_date =  date('Y-m-d');


?>

<link rel="stylesheet" href="css/jquery.fileupload.css">

<div class="page-header">
  	<div class="page-header-content">
          <div class="page-title2">
            <h1><?php include('include_pages/pages_breadcrumb_inc.php'); ?></h1>
          </div>
		  
  	</div>
  </div>


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
            </script>            
            <div class="content" style="padding-top:0;">
                <div>
                  	<div class="">
                    <div class="panel panel-flat">
                  
             
<div class="panel-body">
<form enctype="multipart/form-data" method="post" id="addCheckFrm"  data-parsley-namespace="data-parsley-" data-parsley-validate="" >
   <?php
	
		$uID = $_SESSION['user_id'];
		
			
			
				/*if($LEVEL!=4){?>
							<div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label>Select Client:</label>
                  </div>
                  <div class="col-md-9">
                    <select id="clntid" name="clntid" class="form-control" onchange="document.getElementById('addCheckFrm').submit();">
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
                    <select id="how_rec_checks" name="how_rec_checks" class="form-control parsley-validated" data-parsley-required="true" >
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
							<?php }*/
							
 			if(!empty($userHash) && $userHashExpDate > $curr_date ){
				if($company_id){?>	
							<div class="">
							
							
                            	<div class="col-lg-2">
								
                                    <div>
                                    <input type="hidden" name="case1" value="1" checked="checked" data-name="order"/>
									 <input type="hidden" name="clntid" value="<?php echo  $company_id;?>"  />
									 <input type="hidden" name="how_rec_checks" value="by_applicant"  />
                                	<div class="thumbnail fileinput fileinput-new" data-provides="fileinput">
                                        <div class="thumb fileinput-preview" data-trigger="fileinput">
                                                <img src="images/user-pro.png" alt="photo" >
                                          </div>
                                        <div id="progress1" class="progress" style="display:none">
                                            <div class="progress-bar prg-profile progress-bar-success"></div>
                                        </div>                                          
                                        <div class="caption">
                                          <div id="files1" class="files"></div>
                                            <span class="btn-file user-pro-btn">
                                            	<span class="fileinput-new">Select image
                                                	<i class="text-primary icon-plus2 pull-right"></i>
                                                </span>
                                                <input type="file" name="files[]" id="v_image1" data-id="1" class="user_images">
                                             </span>
                                          </div>
                                        </div>
                                	</div>
                                  
                                </div>
                                <div class="col-lg-10">
                                	<div class="sub-bulk-right-sec">
                                        
                                        <fieldset class="col-md-6">
                                            <div class="form-group ">
                                                <input type="text" name="ename1" class="form-control  parsley-validated" placeholder="Applicant Name" title="Applicant Name" value="<?=$userInfo['first_name']. ' '. $userInfo['last_name'] ?>" readonly  data-parsley-required="true" id="ename1">
												<span class="validate_ename"></span>
                                            </div>
											 </fieldset>
										
                                        <fieldset class="col-md-6">
                                            <div class="form-group ">
                                                <input type="text" name="fname1" class="form-control  parsley-validated" placeholder="Father Name" title="Father Name" value="" data-parsley-required="true" id="fname1">
												<span class="validate_fname"></span>
                                            </div>
                                        </fieldset>

										
                                        <fieldset class="col-md-6">
                                            <div class="form-group">
                                                <input type="text"  name="cnic1" class="form-control parsley-validated cnic" placeholder="<?php echo ID_CARD_NUM;?>" title="<?php echo ID_CARD_NUM;?>" value=""  data-parsley-maxlength-message="Sorry. You must type maximum 50 digits of ID Card" data-parsley-type="digits" data-parsley-maxlength="50" data-parsley-required="true"   onkeyup="this.value=this.value.replace(/[^\d]/,'');" maxlength="50" >
												<span class="validate_cnic"></span>
                                            </div>
											
										</fieldset>
										
										<fieldset class="col-md-6">
                                            <div class="form-group ">
                                                <input type="text" name="dob1" class="form-control datetimepicker-month1" placeholder="Date of Birth" title="Date of Birth" value="">
												
												
											<!--	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
											  
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
                                            <div class="clearFix"></div>
                                        </fieldset>
									
										
										<fieldset class="col-md-6">
                                            <div class="form-group ">
											<!-- onkeyup="this.value=this.value.replace(/[^\d]/,'');" -->
                                                <input type="text" value="<?=$employeCodes?>" readonly name="empcode1" class="form-control parsley-validated emp_id" placeholder="<?php echo CLIENT_REF_NUM;?>" title="<?php echo CLIENT_REF_NUM;?> / Employee ID" value=""  data-parsley-required="true" maxlength="20">
												<span class="validate_emp_code"></span>
                                            </div>
                                            <div class="clearFix"></div>
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
                                  <div class="clearFix"></div>
                                  <fieldset class="col-md-6">
                                            <div class="form-group ">
                                                <input type="text" name="v_address1" class="form-control  parsley-validated" placeholder="Current Resident Address" title="Current Resident Address" value="<?php if(trim($_REQUEST['v_address'])){echo $_REQUEST['v_address'];}?>" />
												 
                                            </div>
											 </fieldset>
                                        <fieldset class="col-md-6">
                                            <div class="form-group float-left free-margin">
                                            <div>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                  
                                                  <span class="fileinput-filename"></span>
                                                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                </div>
                                            </div>
                                            
                                            </div>
                                        </fieldset>
                                        
                                    </div>
                                </div>
                             	<div class="clearFix"></div>
                               
                                <?php 
								$where = "cc.com_id=$company_id AND ck.is_active=1 AND cc.clt_active=1 AND cc.checks_id IN($checkIds) ORDER BY ck.checks_id";
								$tabls = "checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id";
								//echo "select * from $tabls where $where";
								$checks = $db->select($tabls,"*",$where);
								$checks_idss = explode(",",$checkIds);
									$checks_qtyss = explode(",",$checks_qtys);
								if(mysql_num_rows($checks)>0){
									$num_check = 100;
									$cc=-1;
                    				while($check = mysql_fetch_assoc($checks)){ //print_r($check).'<br><br>';
									$cc++;
									
									if(in_array($check['checks_id'],$checks_idss)){
										
										for($i=1; $i<=$checks_qtyss[$cc]; $i++){
											
									?>
                                    <div class="col-lg-12">
                                        <div class="progress-bar-parent mainDivchecks"  >
                                            <h4 class="section-title"><?=convertUCWords($check['checks_title'])?> 
                                            <?php if(!empty($check['checks_tooltip'])){ ?>
                                            	<a class="ctooltips" href="#"><i class="icon-info22"></i><span><?=$check['checks_tooltip']?></span></a>
                                            <?php } ?>
                                             <?php /*?><a href="#" class="checktooltip" title="<?=$check['checks_tooltip']?>"><i class="icon-info-sign"></i></a><?php */?>
                                            <?php if($check['is_multi']==1){?>
                                            <a href="javascript:void(0);" onclick="addmorecheck(this,<?=$check['checks_id']?>,1,'<?=addslashes(convertUCWords($check['checks_title']))?>')" style="display:none;"><i class="icon-plus"></i></a> 
                                            <?php }?>
                                            
                                            	<input style="float:right; display:none;" type="checkbox" name="ischeck1[]" data-parsley-required="true" data-parsley-error-message="You must select at least one check" class="parsley-validated parsley-error tickbox" value="<?=$check['checks_id']?>_<?php echo $i;?>" checked="checked" id="<?=$num_check?>"  />
                                            </h4>
                                        <div <?php if(!in_array($check['checks_id'],array(1,2))){ ?> style="display:none;" <?php } ?>>
										
										
                                        <div>
										<p class="text-muted ml-5" style="float:right;">
										<a class="" href="#" data-popup="tooltip" data-popup="tooltip"data-trigger="hover" data-container="body" data-placement="left" title="Allowed file types:(<?php echo FILE_TYPES_ALLOWED;?>)
										Max file size (<?php echo FILE_SIZE_ALLOWED;?>)"><i class="icon-info22"></i><span></a>
										
										</p>
                                        <div id="dprogress<?php echo $i;?><?=$num_check?><?=$num_check?>" class="progress bulk-upload-prgs" style="width:70%">
                                        <div class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <span style="float:right;" class="btn btn-primary btn-file"><span class="fileinput-new">Select file </span>
                                        <input type="hidden" value="<?=$check['checks_id']?>_<?php echo $i;?>" name="checks<?php echo $i;?>[]"  />
                                        <input type="file" name="files[]" id="docs<?php echo $i;?><?=$num_check?><?=$check['checks_id']?>" multiple class="docs_files" data-id="<?=$num_check?>" data-check="<?=$check['checks_id']?>" data-count="<?php echo $i;?>" data-ccounter="_<?php echo $i;?>" data-attchid="<?=$num_check?>" /></span>
                                        </div>
                                        <div style="clear:both"></div>
                                        <div id="docs_file<?php echo $i;?><?=$num_check?><?=$num_check?>" class="files checkAttached"></div>
										<input name="see_checks_<?=$check['checks_id']?>" value="<?php echo $i;?>"  type="hidden" >
                                        	
                                         <div class="clearFix"></div>
                                         
                                         
							<?php
                           if($check['checks_id'] == 1)
                           { 
						   ?>
						     <div class="col-md-12">
                            <h4>Education Details</h4>
                            <div class="col-md-6">
                            <div class="form-group">
                             
                            <input type="text" name="uni_name1_<?php echo $i;?>" placeholder="University Name<?php echo $aesteric;?>" value="" class="form-control  <?php echo $parsley_validated_class; ?> typeahead-basic" <?php echo $parsley_validated_true; ?>  >
                            </div></div>
                            <div class="col-md-6">
                            <div class="form-group">
                            
                            <input type="text" name="reg_num1_<?php echo $i;?>" placeholder="Registration Number<?php echo $aesteric;?>" value="" class="form-control  <?php echo $parsley_validated_class; ?>" <?php echo $parsley_validated_true; ?>  >
                            </div></div>
                            
                            
                            <div class="col-md-6">
                            <div class="form-group">
                             
                            <input type="text" name="degree1_<?php echo $i;?>" placeholder="Degree Title<?php echo $aesteric;?>" value="" class="form-control <?php echo $parsley_validated_class; ?>" <?php echo $parsley_validated_true; ?>   title="Type Qualification e.g: BSC,MSC,BCS">
                            </div></div>
                            <div class="col-md-6">
                            <div class="form-group">
                            
                            <input type="text" name="remarks1_<?php echo $i;?>" placeholder="Remarks<?php echo $aesteric;?>" value="" class="form-control <?php echo $parsley_validated_class; ?>" <?php echo $parsley_validated_true; ?>   title="Type Remarks e.g: Passed,Fail">
                            
                            </div></div>
                            
                            <div class="col-md-6">
                            <div class="form-group">
                             
                            <input type="text" name="pass_year1_<?php echo $i;?>" placeholder="Passing Year<?php echo $aesteric;?>" value="" class="form-control <?php echo $parsley_validated_class; ?>" <?php echo $parsley_validated_true; ?>title="">
                            </div></div>
                            <div class="col-md-6">
                            <div class="form-group">
                             
                            <input type="text" name="serial_no1_<?php echo $i;?>" placeholder="Serial No<?php echo $aesteric;?>" value="" class="form-control <?php echo $parsley_validated_class; ?>" <?php echo $parsley_validated_true; ?>   title="">
                            </div></div>
                            
                             <div id="appendforeducation"></div>  
                            </div> 
							 
							<?php  } ?>

                           <?php
                           if($check['checks_id'] == 2)
                           { 
						   ?>
                            <div class="col-md-12">
                            <h4>Previous Employment Details</h4>
                            <div class="col-md-6">
                            <div class="form-group">
                            
                            <input type="text" name="company_name1_<?php echo $i;?>" placeholder="Company Name<?php //echo $aesteric;?>" value="" class="form-control  <?php //echo $parsley_validated_class; ?> typeahead-basic2 " <?php //echo $parsley_validated_true; ?> >
                            </div></div>
                            
                            <div class="col-md-6">
                            <div class="form-group">
                             
                            <input type="text" name="date_of_join1_<?php echo $i;?>" id="date_of_join0" placeholder="Date of Joining (YYYY-MM-DD)<?php //echo $aesteric;?>" value="" class="form-control  date datetimepicker-month <?php //echo $parsley_validated_class; ?>" <?php //echo $parsley_validated_true; ?>   title="Type Date of Joining (YYYY-MM-DD)">
                            </div></div>
                            <!--]-->
                            
                            <div class="col-md-6">
                            <div class="form-group">
                             
                            <input type="text" name="emp_status1_<?php echo $i;?>" placeholder="Employement Status<?php //echo $aesteric;?>" value="" class=" form-control  <?php //echo $parsley_validated_class; ?>" <?php //echo $parsley_validated_true; ?>  >
                            </div></div>
                            <div class="col-md-6">
                            <div class="form-group">
                             
                            <input type="text" name="last_work_day1_<?php echo $i;?>" placeholder="Last Working Day<?php //echo $aesteric;?>" value="" class=" form-control  <?php //echo $parsley_validated_class; ?>" <?php //echo $parsley_validated_true; ?>   >
                            </div></div>
                            
                            <div class="col-md-6">
                            <div class="form-group">
                             
                            <input type="text" name="last_designation1_<?php echo $i;?>" placeholder="Last Designation<?php //echo $aesteric;?>" value="" class=" form-control  <?php //echo $parsley_validated_class; ?>" <?php //echo $parsley_validated_true; ?>   >
                            </div></div>
                            <div class="col-md-6">
                            <div class="form-group">
                             
                            <input type="text" name="last_place_posted1_<?php echo $i;?>" placeholder="Last Place of Posting<?php //echo $aesteric;?>" value="" class=" form-control  <?php //echo $parsley_validated_class; ?>" <?php //echo $parsley_validated_true; ?>  >
                            </div></div>
                           
                            
                            <div id="appendforpreemploy"></div>
                            </div>							 
							<?php
                            }  
							?>
                          
                           <!--  // by ata end  -->                                            
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                        </div>
                                       
                                        </div>
                             		</div>
									<?php 
									}
									} ?>
									
									
									
									
									
									
									
									
									
									
									
                                        <div class="clearFix"></div>
										<script>
                                         	checks[<?=$check['checks_id']?>] = <?=$num_check?>;
											ccount[1<?=$check['checks_id']?>] = 1;
                                        </script>
                             		<?php   
									$num_check++;
									}
								}?>
                             </div>  
                             <div class="clearFix"></div>        
					<div class="col-lg-12">               
                      <button type="submit" class="btn filebtn bg-success float-right check_cnic" name="submit_bulk"  >Submit <i class="icon-arrow-right14 position-right"></i></button>
                      <input type="hidden"  name="is_bulk" value="0"  />
                      <input type="hidden"  id="attachment_counter" name="attachment_counter" value="0"  />		
		  			</div>
			<?php
						
			
								}
			}else{
				
				echo 'Date is Expire';
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
		 var cc = (ind==0)?1:ind;
		 if($(abd).is(":checked") == true){
		  if($(abd).val() == '1_'+cc){
			if($(this).find('.checkAttached').html()==""){
				alert("Please add attachment for education check!");
								valid = false;
							   return valid;
			}
			 }
		 }else{
			 //console.log(abd);
		 }
		 
	                        
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
    
       
    var response = false;
	if(vl.length >= len){
		$("."+div_cl).html('<img align="right" src="images/spinners/3.gif" />');
              $.ajax({
	url: "actions.php",
	data:'ePage=add_rating&'+ur+'='+vl+'&chk='+chk,
	type: "POST",
	success: function(res){
    if(res=='not-found'){
		$('.'+div_cl).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item; color:green;"><i class="icon-ok-circle"></i></li></ul>');
		
		$('.'+att).removeAttr('onclick');
		$('.'+att).attr('type','submit');
		valDate(att);

		return true;

	}else{
		
		$('.'+div_cl).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item;"><i class="icon-remove-circle"></i> '+res+'</li></ul>');
		$('.'+att).attr('onclick','stopThis("'+ur+'")');
		$('.'+att).attr('type','button');
		
		
		return false;
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
	if(validate_cnic!="" || validate_emp_code!=""){
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



</script>
   
     