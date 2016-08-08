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
<!-- jplist core -->
<script src="js/jplist-core.min.js"></script>	

<!-- jplist bootstrap pagination bundle -->			
<script src="js/jplist.boot-pagination-bundle.min.js"></script>

<script>

$('document').ready(function(){

   $('#demo').jplist({				
      itemsBox: '.list' 
      ,itemPath: '.list-item' 
      ,panelPath: '.jplist-panel'	
   });
   
});
</script>			
            <div class="row">
                <div class="col-md-12">
                  	<div class="report-sec-bulk">
                    <div class="page-section-title">
                    	<?php include('include_pages/pages_breadcrumb_inc.php'); ?>
                    </div>
             
<div class="bulk-dev" id="demo">
<div id="error_box" class="error_box"></div>



   <?php
	if(isset($_FILES['bulk_file'])){
		?>
		
		
		 <div class="jplist-panel">						
      
      <!-- bootstrap pagination control -->
      <ul 
          class="pagination pull-left jplist-pagination"
          data-control-type="boot-pagination" 
          data-control-name="paging" 
          data-control-action="paging"
          data-range="4"
          data-mode="google-like">
      </ul>
      
      <!-- pagination info label -->
      <div 
         class="pull-left jplist-pagination-info"
         data-type="<strong>Page {current} of {pages}</strong><br/> <small>{start} - {end} of {all}</small>" 
         data-control-type="pagination-info" 
         data-control-name="paging" 
         data-control-action="paging"></div>
         
      <!-- items per page dropdown -->
      <div style="display:none;" 
         class="dropdown pull-left jplist-items-per-page"
         data-control-type="boot-items-per-page-dropdown" 
         data-control-name="paging" 
         data-control-action="paging">

         <button 
            class="btn btn-primary dropdown-toggle" 
            type="button" 
            data-toggle="dropdown" 
            id="dropdown-menu-1"
            aria-expanded="true">					
            <span data-type="selected-text">Items per Page</span>
            <span class="caret"></span>						
         </button>

         <ul class="dropdown-menu" role="menu" aria-labelledby="dropdown-menu-1">

            <li role="presentation">
               <a role="menuitem" tabindex="-1" href="#" data-number="3">3 per page</a>
            </li>

            <li role="presentation">
               <a role="menuitem" tabindex="-1" href="#" data-number="6" >6 per page</a>
            </li>
            
            <li role="presentation">
               <a role="menuitem" tabindex="-1" href="#" data-number="10" data-default="true">10 per page</a>
            </li>

            <li role="presentation" class="divider"></li>

            <li role="presentation">
               <a role="menuitem" tabindex="-1" href="#" data-number="all">View All</a>
            </li>
         </ul>						  
      </div>

   </div>
	
		<div class="list">
		
		
		
		
		
		
		
		
		
		
		
		
		
		<?php
		
		$uID = $_SESSION['user_id'];
		
	
		if ($_FILES["bulk_file"]["error"] <= 0){ 

			$len = strlen($_FILES["bulk_file"]["name"]);
			$ext = strtolower(substr($_FILES["bulk_file"]["name"],($len-3)));
			if($ext=='csv'){
		
			$fp = fopen($_FILES["bulk_file"]["tmp_name"],'r');
			
			$lCount = 0;
			$c=-1;
			$specialCount = 0;
			
			while($csv_line = fgetcsv($fp,1024)) {
			
				$values='';
				$lCount = $lCount+1;
				
				if($lCount==1) continue;
				for ($i = 0, $j = 4; $i <= $j; $i++) {
					$csv_line[$i] = addslashes($csv_line[$i]);
					
				}
				
				if(trim($csv_line[0])!=""){		
				$c++;	
			   $specialCount++;	
			   if($specialCount==10){
			   $specialCount=0;
			   
			   }
			   
			   ?>	
   

					
				
				
				
				
				
				
				<div class="list-item" >
				
                <div class="list-group">
				
                            <div class="list-group-item" id="input-fields-horizontal">
							<?php if($specialCount==10){
						?>
					
					<form enctype="multipart/form-data" <?php if(isset($_FILES['bulk_file'])){ ?> id="addCheckFrm"  <?php } ?> method="post" data-parsley-namespace="data-parsley-" data-parsley-validate="">
					<?php			
					}?>
							<div class="case_data">
							<h3><?=($lCount-1)?></h3>
                            	<div class="bulk-form-sec-left">
                                 
                                    <div class="user-profile-area">
                                    <input type="checkbox" name="case<?=($lCount-1)?>" value="1"  style="position:absolute;margin:5px;display:none;" checked="checked" data-name="order" />
                                	<div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                <img src="images/user-pro.png" alt="photo" >
                                          </div>
                                        <div id="progress<?=($lCount-1)?>" class="progress" style="display:none">
                                            <div class="progress-bar prg-profile progress-bar-success"></div>
                                        </div>                                          
                                        <div class="thumbnail_btn">
                                          <div id="files<?=($lCount-1)?>" class="files"></div>
                                            <span class="btn btn-primary btn-file user-pro-btn">
                                            	<span class="fileinput-new">Select image</span>
                                                <input type="file" name="files[]" id="v_image<?=($lCount-1)?>" data-id="<?=($lCount-1)?>" class="user_images">
                                                </span>
                                          </div>
                                        </div>
                                	</div>
                                   
                                </div>
                                <div class="bulk-form-sec-right">
                                	<div class="sub-bulk-right-sec">
                                        <fieldset class="mrg-bottom custom-input float-left">
                                            <div class="form-group">
                                                <input type="text" name="ename<?=($lCount-1)?>"  class="form-control countrec ename" placeholder="Applicant Name" title="Applicant Name" value="<?=$csv_line[0]?>" id="ename<?=$c?>" >
												<span class="validate_ename<?=$c?>"></span>
                                            </div>
                                            <div class="clearFix"></div>
                                       </fieldset>
                                       <fieldset class="mrg-bottom custom-input float-left">
                                            <div class="form-group ">
                                                <input type="text" name="fname<?=($lCount-1)?>" class="form-control fname" placeholder="Father Name" title="Father Name" value="<?=$csv_line[1]?>" id="fname<?=$c?>" >
												<span class="validate_fname<?=$c?>"></span>
                                            </div>
                                            <div class="clearFix"></div>
                                        </fieldset>
										
										
										
										
										
                                        <fieldset class="mrg-bottom custom-input float-left">
                                            <div class="form-group">
                                                <input type="text" name="cnic<?=($lCount-1)?>" id="cnic<?=$c?>" class="form-control parsley-validated cnic" placeholder="CNIC Numbers" data-parsley-maxlength-message="Sorry. You must type 13 digits of CNIC" data-parsley-minlength-message="Sorry. You must type 13 digits of CNIC" data-parsley-type="digits" data-parsley-maxlength="13" data-parsley-minlength="13"  data-parsley-required="true" onkeyup="this.value=this.value.replace(/[^\d]/,'');" value="<?=$csv_line[3]?>" data-case="<?=($lCount-1)?>" title="CNIC Numbers" onblur="checkCnic(this.value,'cnic','validate_cnic<?=$c?>',13,'check_cnic','nic');"  maxlength="13">
												<span class="validate_cnic<?=$c?>"></span>
                                            </div>
                                            <div class="clearFix"></div>
                                         </fieldset>
                                         
                                         <fieldset class="mrg-bottom custom-input float-left">
                                            <div class="form-group">
                                                <input type="text" name="dob<?=($lCount-1)?>" class="form-control datetimepicker-month" placeholder="Date of Birth" value="<?=$csv_line[4]?>" title="Date of Birth">
                                            </div>
                                            <div class="clearFix"></div>
                                        </fieldset>
                                        
                                        <div class="clearFix"></div>
										
										<fieldset class="mrg-bottom custom-input float-left">
                                            <div class="form-group ">
                                                <input type="text" name="empcode<?=($lCount-1)?>" id="empcode<?=$c?>" class="form-control parsley-validated emp_id" placeholder="Employee Code" title="Employee Code" value="<?=$csv_line[2]?>" data-parsley-type="digits" onkeyup="this.value=this.value.replace(/[^\d]/,'');" data-parsley-required="true"   onblur="checkCnic(this.value,'emp_id','validate_emp_code<?=$c?>',1,'check_cnic','emp');"   maxlength="10">
												<span class="validate_emp_code<?=$c?>" ></span>
                                            </div>
                                            <div class="clearFix"></div>
                                        </fieldset>
										
                                    </div>
                                </div>
                             	<div class="clearFix"></div>
                                <?php 
								$where = "cc.com_id=$COMINF[id] AND ck.is_active=1";
								$tabls = "checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id";
								$checks = $db->select($tabls,"*",$where);
								if(mysql_num_rows($checks)>0){
									$num_check = 100;
                    				while($check = mysql_fetch_assoc($checks)){?>
                                        <div class="progress-bar-parent">
                                            <h4 class="section-title"><?=$check['checks_title']?> 
                                            <?php if(!empty($check['checks_tooltip'])){ ?>
                                            	<a class="ctooltips" href="#"><i class="icon-info-sign"></i><span><?=$check['checks_tooltip']?></span></a>
                                            <?php }?>
                                            <?php if($check['is_multi']==1){?>
                                            <a href="javascript:void(0);" onclick="addmorecheck(this,<?=$check['checks_id']?>,<?=($lCount-1)?>,'<?=addslashes($check['checks_title'])?>')"><i class="icon-plus"></i></a> 
                                            <?php }?>
                                            
                                            	<input style="float:right;" type="checkbox" name="ischeck<?=($lCount-1)?>[]" value="<?=$check['checks_id']?>_1" checked="checked"  data-parsley-required="true" data-parsley-error-message="You must select at least one check" class="parsley-validated parsley-error tickbox" id="<?=($lCount-1)?><?=$num_check?>" />
                                            </h4>
                                        <div>
                                        <div>
										<p class="text-muted " style="float:right;">
										<a class="ctooltips" href="#"><i class="icon-info-sign"></i><span>Allowed file types:<br />(<?php echo FILE_TYPES_ALLOWED;?>)<br />
										Max file size:<br />(<?php echo FILE_SIZE_ALLOWED;?>)</span></a>
										
										</p>
                                        <div id="dprogress<?=($lCount-1)?><?=$num_check?>" class="progress bulk-upload-prgs" style="width:70%">
                                        <div class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <span style="float:right;" class="btn btn-primary btn-file"><span class="fileinput-new">Select file</span>
                                        <input type="hidden" value="<?=$check['checks_id']?>_1" name="checks<?=($lCount-1)?>[]"  />
                                        <input type="file" name="files[]" id="docs<?=($lCount-1)?><?=$num_check?><?=$check['checks_id']?>" multiple="multiple" class="docs_files" data-id="<?=$num_check?>" data-check="<?=$check['checks_id']?>" data-count="<?=($lCount-1)?>" data-ccounter="_1" /></span>
                                        </div>
                                        <div style="clear:both"></div>
                                        <div id="docs_file<?=($lCount-1)?><?=$num_check?>" class="files"></div>
										<input name="see_checks_<?=$check['checks_id']?>" value="1"  type="hidden" >
                                        	
                                         <div class="clearFix"></div>
                                        </div>
                                       
                                        </div>
                             			<div class="clearFix"></div>
                                        <script>
                                         	checks[<?=$check['checks_id']?>] = <?=$num_check?>;
											ccount[<?=$check['checks_id']?>] = 1;
                                        </script>
                             		<?php   
									$num_check++;
									}
								}?>
                             </div>  
							<?php if($specialCount==10){?>
							<div class="clearFix"></div> 
            <div class="error_box"></div>
				<button type="submit" class="btn btn-success float-left check_cnic" name="submit_bulk">Submit</button>
				<input type="hidden"  name="is_bulk" value="1"  />	
				<input type="hidden"  id="attachment_counter" name="attachment_counter" value="0"  />	
				<div class="clearFix"></div> 
							
							
				</form>
				
							<?php }	?>
							  
							 </div>
							 </div>
							 </div>
                    
				
                <?php 
				} 
			}?>
			
				

			<?php
			fclose($fp);			
			}else{ 
				msg('err',"Invalid file type please upload correct file!");
				?>
		    <form enctype="multipart/form-data"  method="post" data-parsley-namespace="data-parsley-" data-parsley-validate="">
                <div class="list-group-item">
				<button type="button" class="btn btn-success" onclick="document.location='files/format/applicant-bulkupload-sample.csv'"    ><i class="icon-file-text-alt"></i>   Download Sample Format</button><br />
								
                                <div class="form-group">
                                    <label>Please Upload CSV File</label>
                                    <div>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                          <div class="input-group">
                                            <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                            <span class="input-group-addon btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="bulk_file"></span>
                                            <a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                

                                							<!--<input type="file" name="bulk_file" />-->
							<input type="submit" class="btn btn-success" name="upload_bulk" value="Submit"  />		

                            </div>
                
				</form>
				<?php
			}
		}else{
			msg('err',"Please select a csv file to upload!");
			?>
			
			<form enctype="multipart/form-data"  method="post" data-parsley-namespace="data-parsley-" data-parsley-validate="">
            <div class="list-group-item">
								<button type="button" class="btn btn-success"   onclick="document.location='files/format/applicant-bulkupload-sample.csv'" ><i class="icon-file-text-alt"></i>  Download Sample Format</button><br />
                                <div class="form-group">
                                    <label>Please Upload CSV File</label>
                                    <div>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                          <div class="input-group">
                                            <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                            <span class="input-group-addon btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="bulk_file"></span>
                                            <a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                

                                							<!--<input type="file" name="bulk_file" />-->
							<input type="submit" class="btn btn-success" name="upload_bulk" value="Submit"  />		

                            </div>
							</form>
            <?php
		}
	}else{ ?>     
			<form enctype="multipart/form-data"  method="post" data-parsley-namespace="data-parsley-" data-parsley-validate="">
    			      <div class="list-group-item">
								<button type="button" class="btn btn-success"   onclick="document.location='files/format/applicant-bulkupload-sample.csv'" ><i class="icon-file-text-alt"></i>  Download Sample Format</button><br />
                                <div class="form-group">
                                    <label>Please Upload CSV File</label>
                                    <div>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                          <div class="input-group">
                                            <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                            <span class="input-group-addon btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="bulk_file"></span>
                                            <a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                

                                							<!--<input type="file" name="bulk_file" />-->
							<input type="submit" class="btn btn-success" name="upload_bulk" value="Submit"  />		

                            </div>
							</form>
		<?php
	}
   ?>  	</div>
           

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
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 
 

<script type="text/javascript">
$(document).ready(function(){

 $("#addCheckFrm").submit(function(e){
	 
	 var valid = true;
	 var listOfCnic = [];
	 var listOfEmp = [];
	 
	 $('.countrec').each(function(i,o){
		
	 var ename = document.getElementById('ename'+i).value;
	 var fname = document.getElementById('fname'+i).value;
	 
	if(ename.match("((^[0-9 ]+[a-z]+)|(^[a-z]+[0-9 ]+))+[0-9a-z ]+$")){
  //return true; 
  $('.validate_ename'+i).html('');
}else if(ename.match("^[a-zA-Z ]*$")){
 //return true;
  $('.validate_ename'+i).html('');
}
else{

 
   $('#ename'+i).addClass("parsley-error");
  $('.validate_ename'+i).html('<ul   class="parsley-error-list"><li class="required" style="display: list-item;">Please type alphanumeric or alphabets characters only !</li></ul>');
  // alert("Please type alphanumeric or alphabets characters only !");
   
   valid = false;
   return valid;
}
	if(fname.match("((^[0-9 ]+[a-z]+)|(^[a-z]+[0-9 ]+))+[0-9a-z ]+$")){
  //return true; 
   $('.validate_fname'+i).html('');
}else if(fname.match("^[a-zA-Z ]*$")){
 //return true;
  $('.validate_fname'+i).html('');
}
else{

 
   $('#fname'+i).addClass("parsley-error");
  $('.validate_fname'+i).html('<ul   class="parsley-error-list"><li class="required" style="display: list-item;">Please type alphanumeric or alphabets characters only !</li></ul>');
  // alert("Please type alphanumeric or alphabets characters only !");
   
   valid = false;
   return valid;
} 


	$.ajax({
	url: "actions.php",
	data:'ePage=add_rating&cnic='+$("#cnic"+i).val()+'&chk=nic',
	type: "POST",
	success: function(res){
    if(res=='not-found'){
		$('.validate_cnic'+i).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item; color:green;"><i class="icon-ok-circle"></i></li></ul>');
				
	}else{
		
		$('.validate_cnic'+i).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item;"><i class="icon-remove-circle"></i> '+res+'</li></ul>');
			
		valid = false;
		return valid;
	}
	}
	});
	
	
	$.ajax({
	url: "actions.php",
	data:'ePage=add_rating&emp_id='+$("#empcode"+i).val(),
	type: "POST",
	success: function(res){
    if(res=='not-found'){
		$('.validate_emp_code'+i).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item; color:green;"><i class="icon-ok-circle"></i></li></ul>');
				
	}else{
		
		$('.validate_emp_code'+i).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item;"><i class="icon-remove-circle"></i> '+res+'</li></ul>');
			
		valid = false;
		return valid;
	}
	}
	});

    

		if($("#cnic"+i).val()!='') listOfCnic.push($("#cnic"+i).val());
        if($("#empcode"+i).val()!='') listOfEmp.push($("#empcode"+i).val());
		
    
	}); 
	 
	 var duplicatesCnic = find_duplicates(listOfCnic);
	 var duplicatesEmp = find_duplicates(listOfEmp);
	var msgBox = "";
	var isCorect = 0;
    if(duplicatesCnic.length>0)
    {
		msgBox += 'Duplicates CNIC are: <br>'+JSON.stringify(duplicatesCnic)+'<br>';
     
		
		isCorect = 1;
    }
    else
    {
		msgBox += '';
		
    }
	 
	  if(duplicatesEmp.length>0)
    {
      
		msgBox += 'Duplicates Employee Code are: <br> '+JSON.stringify(duplicatesEmp)+'<br>';
		
		
		isCorect = 1;
    }
    else
    {
		msgBox += '';
		
		
    }
	
	
	 if(isCorect==1){
		 	//$("html, body").animate({ scrollTop: $('#error_box').offset().top }, 5000);
			location.hash = "#error_box";
		 $(".error_box").html('<div class="alert alert-dismissable alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button><span class="title"><i class="icon-remove-sign"></i> ERROR</span>'+msgBox+'</div>');
		  valid=false; 
		  return valid;
	
	 }else{
		$(".error_box").html(''); 
	 }
	 
	 
	 
	 $('.tickbox').each(function (ind,obj){
		 if(this.checked == true){
			
			  var abc = obj.id;
			 
			
					if($('#docs_file'+abc).html()=="")
							{
								alert("Please add attachement !");
								valid = false;
								return valid;
							};    
		  };                        
		});
		
		
		
		
		
		
		
		return valid;
});




});
		
		
		 					
		$(function () {
			$( ".datetimepicker-month").datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			yearRange: "1980:2015"
			});
		});
		

				
		$(".user_images").each(function(index, element) {
            set_image($(this).data('id'));
        });

		$(".docs_files").each(function(index, element) {
            set_docs($(this).data('id'),$(this).data('count'),$(this).data('check'),$(this).data('ccounter'));
        });
</script>
<script src="scripts/vendor/bootstrap-datetimepicker.js"></script>

<script src="scripts/vendor/fileinput.js"></script>

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
		//$('.'+att).removeAttr('onclick');
		//$('.'+att).attr('type','submit');
		valDate(att);
		return true;

	}else{
		
		$('.'+div_cl).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item;"><i class="icon-remove-circle"></i> '+res+'</li></ul>');
		//$('.'+att).attr('onclick','stopThis()');
		//$('.'+att).attr('type','button');
		
		
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

function stopThis(){
	$('.cnic').focus();
	return false;
}

function valDate(att){
	
	var validate_cnic;
	var validate_emp_code;
	$('.countrec').each(function(ind){
		//console.log("ind: "+ind+"vl:"+vl);
	validate_cnic = $('.validate_cnic'+ind).text();
	validate_emp_code = $('.validate_emp_code'+ind).text();	
	
/* 	if($(this).val()==$('#cnic'+ind).val()){
		
	} */
	
	//console.log("validate_cnic: "+validate_cnic+"validate_emp_code:"+validate_emp_code);
	});
	
	
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

$(document).ready(function(){
    
       $('.countrec').each(function(ind){
   
	
		$(".validate_cnic"+ind).html('<img align="right" src="images/spinners/3.gif" />');
		$(".validate_emp_code"+ind).html('<img align="right" src="images/spinners/3.gif" />');
		var cnic = $("#cnic"+ind).val();
		var emp_id = $("#empcode"+ind).val();
		
		
		
		
		
        $.ajax({
	url: "actions.php",
	data:'ePage=add_rating&cnic='+cnic+'&chk=nic',
	type: "POST",
	success: function(res){
    if(res=='not-found'){
		
		if(!(cnic.match("/^\d+$/"))){
		$(".validate_cnic"+ind).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item;"><i class="icon-remove-circle"></i> Please type alphanumeric or alphabets characters only !</li></ul>');	
		return false;	
		}
		
		
		
		
		
		
		$(".validate_cnic"+ind).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item; color:green;"><i class="icon-ok-circle"></i></li></ul>');
		//$('.check_cnic').removeAttr('onclick');
		//$('.check_cnic').attr('type','submit');
		//valDate('check_cnic');
		return true;

	}else{
		
		$(".validate_cnic"+ind).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item;"><i class="icon-remove-circle"></i> '+res+'</li></ul>');
		//$('.check_cnic').attr('onclick','stopThis()');
		//$('.check_cnic').attr('type','button');
		
		
		return false;
	}
	},
	error: function(){
    alert('failure');
	}
	
	
	});
	
	
	$.ajax({
	url: "actions.php",
	data:'ePage=add_rating&emp_id='+emp_id,
	type: "POST",
	success: function(res){
    if(res=='not-found'){
		
		if(!(emp_id.match("/^\d+$/"))){
		$(".validate_emp_code"+ind).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item;"><i class="icon-remove-circle"></i> Please type alphanumeric or alphabets characters only !</li></ul>');	
		return false;	
		}
		
		
		$('.validate_emp_code'+ind).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item; color:green;"><i class="icon-ok-circle"></i></li></ul>');
		//$('.check_cnic').removeAttr('onclick');
		//$('.check_cnic').attr('type','submit');
		//valDate('check_cnic');
		return true;

	}else{
		
		$('.validate_emp_code'+ind).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item;"><i class="icon-remove-circle"></i> '+res+'</li></ul>');
		//$('.check_cnic').attr('onclick','stopThis()');
		//$('.check_cnic').attr('type','button');
		
		
		return false;
	}
	},
	error: function(){
    alert('failure');
	}
	
	
	});


    
	   });
});

function find_duplicates(arr) {
  var len=arr.length,
      out=[],
      counts={};

  for (var i=0;i<len;i++) {
    var item = arr[i];
    var count = counts[item];
    counts[item] = counts[item] >= 1 ? counts[item] + 1 : 1;
  }

  for (var item in counts) {
    if(counts[item] > 1)
      out.push(item);
  }

  return out;
}

</script>
   
     
     