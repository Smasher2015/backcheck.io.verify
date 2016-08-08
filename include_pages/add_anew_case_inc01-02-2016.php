<?php if($LEVEL!=4){
	$company_id = $_REQUEST['clntid'];
	$lev = getLevel($LEVEL);
	$info_title = $lev['level_name'];
	
}else {
	$company_id = $COMINF['id'];
	$info_title = $COMINF['name'];
}

if($_REQUEST['ERR']==""){
	
	$_REQUEST['ename1']="";
	$_REQUEST['fname1']="";
	$_REQUEST['cnic1']="";
	$_REQUEST['dob1']="";
	$_REQUEST['empcode1']="";
	
	$_REQUEST['ischeck1']=array();
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
            </script>            
            <div class="row">
                <div class="col-md-12">
                  	<div class="report-sec">
                    <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title3">
                    	<h2><?php include('include_pages/pages_breadcrumb_inc.php'); ?></h2>
                    </div>
                    </div></div>
                    <div class="panel panel-default panel-block">
                 
             
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
							<?php }
							

								if($company_id){?>	
							<div class="case_data">
							
							
							
							
							
							
							
							
                            	<div class="bulk-form-sec-left">
								
                                    <div class="user-profile-area">
                                    <input type="hidden" name="case1" value="1"  data-name="order"/>
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
                                                <input type="text" name="ename1" class="form-control  parsley-validated" placeholder="Employee Name" 
												value="<?php echo $_REQUEST['ename1'];?>"  data-parsley-required="true" id="ename1">
												<span class="validate_ename"></span>
                                            </div>
											 </fieldset>
											<fieldset class="mrg-bottom custom-input float-left">
                                            <div class="form-group ">
                                                <input type="text" name="fname1" class="form-control  parsley-validated" placeholder="Father Name" value="<?php echo $_REQUEST['fname1'];?>" data-parsley-required="true" id="fname1">
												<span class="validate_fname"></span>
                                            </div>
                                            <div class="clearFix"></div>
                                        </fieldset>
										
										
										
										
										
                                        <fieldset class="mrg-bottom custom-input float-left">
                                            <div class="form-group">
                                                <input type="text"  name="cnic1" class="form-control parsley-validated cnic" placeholder="CNIC Numbers" value="<?php echo $_REQUEST['cnic1'];?>"  data-parsley-maxlength-message="Sorry. You must type 13 digits of CNIC" data-parsley-minlength-message="Sorry. You must type 13 digits of CNIC" data-parsley-type="digits" data-parsley-maxlength="13" data-parsley-minlength="13"   onblur="checkCnic(this.value,'cnic','validate_cnic',13,'check_cnic','nic');"  onkeyup="this.value=this.value.replace(/[^\d]/,'');" maxlength="13" >
												<span class="validate_cnic"></span>
                                            </div>
											
										</fieldset>
										
											<fieldset class="mrg-bottom custom-input float-left">
                                            <div class="form-group ">
                                                <input type="text" name="dob1" class="form-control datetimepicker-month1" placeholder="Date of Birth" value="<?php echo $_REQUEST['dob1'];?>">
												
												
												<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
											  
                                              <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
                                                <script type="text/javascript">
												$(function () {
												$( ".datetimepicker-month1").datepicker({
												dateFormat: 'yy-mm-dd',
												changeMonth: true,
												changeYear: true,
												yearRange: "1900:2030"
												});
												});
												</script>
													
                                            </div>
                                            <div class="clearFix"></div>
                                        </fieldset>
									
									<div class="clearFix"></div>
										
										<fieldset class="mrg-bottom custom-input float-left">
                                            <div class="form-group ">
                                                <input type="text" name="empcode1" class="form-control parsley-validated emp_id" placeholder="Employee Code" title="Employee Code" value="<?php echo $_REQUEST['empcode1'];?>" data-parsley-type="digits" onkeyup="this.value=this.value.replace(/[^\d]/,'');" onblur="checkCnic(this.value,'emp_id','validate_emp_code',1,'check_cnic','emp');" data-parsley-required="true" maxlength="10">
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
								$where = "cc.com_id=$company_id AND ck.is_active=1 AND cc.clt_active=1";
								$tabls = "checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id";
								$checks = $db->select($tabls,"*",$where);
								if(mysql_num_rows($checks)>0){
									$num_check = 100;
									$cc=0;
                    				while($check = mysql_fetch_assoc($checks)){
									$cc++;?>
                                        <div class="progress-bar-parent mainDivchecks">
                                            <h4 class="section-title"><?=$check['checks_title']?> 
                                            <?php if(!empty($check['checks_tooltip'])){ ?>
                                            	<a class="ctooltips" href="#"><i class="icon-info22"></i><span><?=$check['checks_tooltip']?></span></a>
                                            <?php }?>
                                             <?php /*?><a href="#" class="checktooltip" title="<?=$check['checks_tooltip']?>"><i class="icon-info-sign"></i></a><?php */?>
                                            <?php if($check['is_multi']==1){?>
                                            <a href="javascript:void(0);" onclick="addmorecheck(this,<?=$check['checks_id']?>,1,'<?=addslashes($check['checks_title'])?>')"><i class="icon-plus22"></i></a> 
                                            <?php } ?>
                                            
                                            	<input style="float:right;" type="checkbox" name="ischeck1[]" data-parsley-required="true" data-parsley-error-message="You must select at least one check" class="parsley-validated parsley-error tickbox checknum_<?=$check['checks_id']?>" value="<?=$check['checks_id']?>_1"  id="<?=$num_check?>" <?=(in_array($check['checks_id'].'_1',$_REQUEST['ischeck1']))?'checked':''?>  />
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
                                        <input type="file" name="files[]" id="docs1<?=$num_check?><?=$check['checks_id']?>" multiple class="docs_files" data-id="<?=$num_check?>" data-check="<?=$check['checks_id']?>" data-count="1" data-ccounter="_1" data-attchid="<?=$num_check?>" /></span>
                                        </div>
                                        <div style="clear:both"></div>
                                        <div id="docs_file1<?=$num_check?><?=$num_check?>" class="files checkAttached"></div>
										<input name="see_checks_<?=$check['checks_id']?>" value="1"  type="hidden" >
                                        	
                                         <div class="clearFix"></div>
                                        </div>
                                       
                                       
                                       
                                       
                   <!--  // by ata   -->               
                                       
                                       <div class="previousemp_form">
                                       <?php
                                       if($check['checks_id'] == 47)
									   {
 //			  	$tcheck = checkAction($check['checks_id'],$_REQUEST);
//	//print_r($tcheck);
//	$csSts = strtolower(trim($verCheck['as_status']));
//	$as_qastatus = strtolower(trim($verCheck['as_qastatus']));
//	$csrmk = strtolower(trim($verCheck['as_remarks']));
	//if(is_array($tcheck)){ 
		$fields = actionFields(96,47);
		
		//$input = $db->select("fields_maping","*","checks_id=47" );
		//$input = $db->select("inputs","*","in_id=$field[in_id]" );
		$querydata = mysql_query("select * from fields_maping as fmap, inputs as inp where (fmap.checks_id = 47 and fmap.in_id=inp.in_id)");
		// if(mysql_num_rows($fields)>0){ 
 		
			  while($field = mysql_fetch_array($querydata)){
				    print_r($field);  echo "<br>";
                           // if($field['fl_key']!='multy'){
                               // if($field['is_multy']==1) $is_multy=$field['fl_title'];
                                //$tFld = renderFields($field);
                               /// if($tFld){ ?>
              <fieldset class="label_side" style="padding:10px;">
                
                <label style="float:left; margin-right:15px;">
                  <?php //$field['fl_title']?>
                  :</label>
                  <?php //$tFld?>
                </fieldset>
              <?php //} }else{ ?>
              
              <?php  //}
			  
			  } 
									  
 									//  }   //mysql_num_rows
 									 //  } // is_array
 									   } // if($check['checks_id']
									   ?>
                                       </div>
                  <!--  // by ata end  -->                                
                                       
                                       
                                       
                                       
                                       
                                       
                                       
                                       
                                       
                                       
                                       
                                       
                                       
                                       
                                       
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
               
          <button type="submit" class="btn filebtn btn-success float-left check_cnic" name="submit_bulk"  >Submit</button>
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
		var ext_msg = ".<br />Selected checks will be added to this employee";
	
		$('.'+div_cl).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item;"><i class="icon-cross3"></i> '+res+ext_msg+'</li></ul>');
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

$(".previousemp_form").hide();
$(".checknum_47").click(function() {
    if($(this).is(":checked")) {
        $(".previousemp_form").show();
    } else {
        $(".previousemp_form").hide();
    }
});



</script>
   
     