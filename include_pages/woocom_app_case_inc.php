
<?php 
	

	$company_id = 103;
	
	$info = explode("|",base64_decode($_REQUEST['info']));
	
	$applicant_name = $info[0];
	$wp_user_id = $info[1];
	$applicant_email = $info[2];
	
	$check_code = strtoupper(end(explode("-",$info[3])));
	//echo $check_code; exit;
	$check_code = ($check_code=='EDU')?"ED":$check_code;
	$tracking_code = $info[4];
	
	$selCod = $db->select("wp_applicant_tracking_code","id,status","tracking_code='$tracking_code'");
	$rsCod = mysql_fetch_assoc($selCod);
	 if(mysql_num_rows($selCod)==0){ $show='yes';}else if($rsCod['status']==0) { $show='yes';}else{ $show='no'; }
	
	$where_check = " checks_sname='$check_code' ";
	
	$selC = $db->select("checks","checks_id",$where_check);
	$rsCheck = mysql_fetch_assoc($selC);
	
	if($rsCheck['checks_id'])	$check_id = " AND cc.checks_id=".$rsCheck['checks_id']; else $check_id="";




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
            </script>            
            <div class="row">
                <div class="col-md-12">
                  	<div class="report-sec">
                    <div class="panel panel-default panel-block">
                    <div class="page-section-title">
                    	<h3>Upload Documents</h3>
                    </div>
             
<div class="bulk-dev">


<?php if(isset($_REQUEST['err'])){?>
  <div class="cust_style">
    <div class="alert alert-dismissable alert-danger fade in ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button>
      <span class="title"><i class="icon-check-sign"></i> ERROR</span> <?php echo $_REQUEST['err'];?> </div>
  </div>
  <?php }?>
  <?php if(isset($_REQUEST['sec'])){?>
  <div class="cust_style">
    <div class="alert alert-dismissable alert-success fade in ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button>
      <span class="title"><i class="icon-check-sign"></i> SUCCESS</span> <?php echo $_REQUEST['sec'];?> </div>
  </div>
  <?php } 
  if($wp_user_id!=''){
if($show=='yes'){
  ?>



<form enctype="multipart/form-data" method="post" id="addCheckFrm"  data-parsley-namespace="data-parsley-" data-parsley-validate="" >
   <?php
	
	
		

								if($company_id){?>	
							<div class="case_data">
							
							
                            	<div class="bulk-form-sec-left">
								
                                    <div class="user-profile-area">
                                    <input type="hidden" name="case1" value="1"  data-name="order"/>
									<input type="hidden" name="clntid" value="<?php echo $company_id;?>"   />
									<input type="hidden" name="how_rec_checks" value="woocomerce_applicant"   />
									<input type="hidden" name="wp_user_id" value="<?php echo $wp_user_id;?>"   />
									<input type="hidden" name="applicant_name" value="<?php echo $applicant_name;?>"   />
									<input type="hidden" name="applicant_email" value="<?php echo $applicant_email;?>"   />
									<input type="hidden" name="tracking_code" value="<?php echo $tracking_code;?>"   />
									
									
                                	<div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                <img src="images/user-pro.png" alt="photo" >
                                          </div>
                                        <div id="progress1" class="progress" style="display:none">
                                            <div class="progress-bar prg-profile progress-bar-success"></div>
                                        </div>                                          
                                        <div class="thumbnail_btn">
                                          <div id="files1" class="files"></div>
                                            <span class="btn btn-primary btn-file user-pro-btn">
                                            	<span class="fileinput-new">Select image</span>
                                                <input type="file" name="files[]" id="v_image1" data-id="1" class="user_images">
                                                </span>
                                          </div>
                                        </div>
                                	</div>
                                  
                                </div>
                                <div class="bulk-form-sec-right">
                                	<div class="sub-bulk-right-sec">
                                        <fieldset class="mrg-bottom custom-input float-left">
                                            <div class="form-group ">
                                                <input type="text" name="ename1" class="form-control  parsley-validated" placeholder="Employee Name" value="<?php echo $applicant_name;?>"  data-parsley-required="true" id="ename1">
												<span class="validate_ename"></span>
                                            </div>
											 </fieldset>
											<fieldset class="mrg-bottom custom-input float-left">
                                            <div class="form-group ">
                                                <input type="text" name="fname1" class="form-control  parsley-validated" placeholder="Father Name" value="" data-parsley-required="true" id="fname1">
												<span class="validate_fname"></span>
                                            </div>
                                            <div class="clearFix"></div>
                                        </fieldset>
										
										
										
										
										
                                        <fieldset class="mrg-bottom custom-input float-left">
                                            <div class="form-group">
                                                <input type="text"  name="cnic1" class="form-control parsley-validated cnic" placeholder="CNIC Numbers" value=""  data-parsley-maxlength-message="Sorry. You must type 13 digits of CNIC" data-parsley-minlength-message="Sorry. You must type 13 digits of CNIC" data-parsley-type="digits" data-parsley-maxlength="13" data-parsley-minlength="13"   onblur="checkCnic(this.value,'cnic','validate_cnic',13,'check_cnic','nic');"  onkeyup="this.value=this.value.replace(/[^\d]/,'');" maxlength="13" >
												<span class="validate_cnic"></span>
                                            </div>
											
										</fieldset>
										
											<fieldset class="mrg-bottom custom-input float-left">
                                            <div class="form-group ">
                                                <input type="text" name="dob1" class="form-control datetimepicker-month1" placeholder="Date of Birth" value="">
												
												
												<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
											  
                                              <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
                                                <script type="text/javascript">
												$(function () {
												$( ".datetimepicker-month1").datepicker({
												dateFormat: 'yy-mm-dd',
												changeMonth: true,
												changeYear: true,
												yearRange: "1980:2015"
												});
												});
												</script>
													
                                            </div>
                                            <div class="clearFix"></div>
                                        </fieldset>
									
									<div class="clearFix"></div>
										
										<fieldset class="mrg-bottom custom-input float-left">
                                            <div class="form-group ">
                                                <input type="text" name="empcode1" class="form-control parsley-validated emp_id" placeholder="Employee Code" title="Employee Code" value="" data-parsley-type="digits" onkeyup="this.value=this.value.replace(/[^\d]/,'');" onblur="checkCnic(this.value,'emp_id','validate_emp_code',1,'check_cnic','emp');" data-parsley-required="true" maxlength="10">
												<span class="validate_emp_code"></span>
                                            </div>
                                            <div class="clearFix"></div>
                                        </fieldset>
										
										
                                        <fieldset>
                                            <div class="form-group float-left free-margin">
                                            <div>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                  
                                                  <span class="fileinput-filename"></span>
                                                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                </div>
                                            </div>
                                            
                                            </div>
                                            <div class="clearFix"></div>
                                        </fieldset>
                                        <div class="clearFix"></div>
                                    </div>
                                </div>
                             	<div class="clearFix"></div>
                               
                                <?php 
								
								
								
								
								$where = "cc.com_id=$company_id AND ck.is_active=1 AND cc.clt_active=1 $check_id ";
								$tabls = "checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id";
								$checks = $db->select($tabls,"*",$where);
								if(mysql_num_rows($checks)>0){
									$num_check = 100;
                    				while($check = mysql_fetch_assoc($checks)){?>
                                        <div class="progress-bar-parent mainDivchecks">
                                            <h4 class="section-title"><?=$check['checks_title']?> 
                                            <?php if(!empty($check['checks_tooltip'])){ ?>
                                            	<a class="ctooltips" href="#"><i class="icon-info-sign"></i><span><?=$check['checks_tooltip']?></span></a>
                                            <?php }?>
                                             <?php /*?><a href="#" class="checktooltip" title="<?=$check['checks_tooltip']?>"><i class="icon-info-sign"></i></a><?php */?>
                                            <?php if($check['is_multi']==1){?>
                                            <a href="javascript:void(0);" onclick="addmorecheck(this,<?=$check['checks_id']?>,1,'<?=addslashes($check['checks_title'])?>')"><i class="icon-plus"></i></a> 
                                            <?php }?>
                                            
                                            	<input style="float:right;" type="checkbox" name="ischeck1[]" data-parsley-required="true" data-parsley-error-message="You must select at least one check" class="parsley-validated parsley-error tickbox" value="<?=$check['checks_id']?>_1"  id="<?=$num_check?>"  />
                                            </h4>
                                        <div>
                                        <div>
										<p class="text-muted " style="float:right;">
										<a class="ctooltips" href="#"><i class="icon-info-sign"></i><span>Allowed file types:<br />(<?php echo FILE_TYPES_ALLOWED;?>)<br />
										Max file size:<br />(<?php echo FILE_SIZE_ALLOWED;?>)</span></a>
										
										</p>
                                        <div id="dprogress1<?=$num_check?><?=$num_check?>" class="progress bulk-upload-prgs" style="width:70%">
                                        <div class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <span style="float:right;" class="btn btn-primary btn-file"><span class="fileinput-new">Select file</span>
                                        <input type="hidden" value="<?=$check['checks_id']?>_1" name="checks1[]"  />
                                        <input type="file" name="files[]" id="docs1<?=$num_check?><?=$check['checks_id']?>" multiple="multiple" class="docs_files" data-id="<?=$num_check?>" data-check="<?=$check['checks_id']?>" data-count="1" data-ccounter="_1" data-attchid="<?=$num_check?>" /></span>
                                        </div>
                                        <div style="clear:both"></div>
                                        <div id="docs_file1<?=$num_check?><?=$num_check?>" class="files checkAttached"></div>
										<input name="see_checks_<?=$check['checks_id']?>" value="1"  type="hidden" >
                                        	
                                         <div class="clearFix"></div>
                                        </div>
                                       
                                        </div>
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
               
          <button type="submit" class="btn filebtn btn-success float-left check_cnic" name="woocom_applicant"  >Submit</button>
		  <input type="hidden"  name="is_bulk" value="0"  />
		  <input type="hidden"  id="attachment_counter" name="attachment_counter" value="0"  />	
		  
			<?php
						
			
								}
	
   ?>  	
                             </form>

<?php }else {
	
	
	?>
	
	 <div class="cust_style">
    <div class="alert alert-dismissable alert-success fade in ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button>
      <span class="title"><i class="icon-check-sign"></i>SUCCESS</span>  You have submitted all your information. This url is not useable anymore. Thanks for being with us.</div>
  </div>
	
<?php 
  } 
  
  }else{?>
  
  <div class="cust_style">
    <div class="alert alert-dismissable alert-danger fade in ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button>
      <span class="title"><i class="icon-cross-sign"></i> NO ACCESS</span>  You have no access to this page.</div>
  </div>
  
  <?php }?>
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
		  
		 if($(abd).is(":checked") == true){
			if($(this).find('.checkAttached').html()==""){
				alert("Please add attachment !");
								valid = false;
							   return valid;
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
    
      var com_id = '<?php echo $company_id;?>';
    var response = false;
	if(vl.length >= len){
		$("."+div_cl).html('<img align="right" src="images/spinners/3.gif" />');
              $.ajax({
	url: "?action=userinfo&atype=woocom",
	data:'emCode=1&'+ur+'='+vl+'&chk='+chk+'&com_id='+com_id,
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
   
   