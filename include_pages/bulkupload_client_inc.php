<?php if($LEVEL!=4){
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
<style type="text/css">
ul.pagination{ margin:0 10px;}
</style>
  <div id="error_box" class="row">
  <div class="col-md-12">
    <div class="report-sec">
      
        <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title3">
          				<h2><?php include('include_pages/pages_breadcrumb_inc.php'); ?></h2>
        </div>
        </div></div>
        <div class="panel panel-default panel-block">
        <div class="bulk-dev panel-body" id="demo">
          <div  class="error_box"></div>
          <form enctype="multipart/form-data" <?php if(isset($_FILES['bulk_file'])){ ?> id="addCheckFrm" name="addCheckFrm"  <?php } ?> method="post" 
		  data-parsley-namespace="data-parsley-" data-parsley-validate="">
		  
		 <?php if($LEVEL!=4){ ?>
							<div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label>Select Client:</label>
                  </div>
                  <div class="col-md-9">
                    <select id="clntid" name="clntid" class="form-control" >
                      <option value=""> --------Select Client-------- </option>
                      <?php 	$db = new DB();
                                                $dWhere="1=1 order by name asc";							
                                                $coms = $db->select("company","*",$dWhere);
                                             // echo "select * from company where $dWhere";
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
							<?php } ?>
            <?php
	if(isset($_FILES['bulk_file'])){?>
		
		
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
         data-type="<span>Page {current} of {pages}</span> <span style='display:none;'>{start} - {end} of {all}</span>" 
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
            aria-expanded="true"> <span data-type="selected-text">Items per Page</span> <span class="caret"></span> </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdown-menu-1">
                  <li role="presentation"> <a role="menuitem" tabindex="-1" href="#" data-number="3">3 per page</a> </li>
                  <li role="presentation"> <a role="menuitem" tabindex="-1" href="#" data-number="6" >6 per page</a> </li>
                  <li role="presentation"> <a role="menuitem" tabindex="-1" href="#" data-number="10" data-default="true">10 per page</a> </li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"> <a role="menuitem" tabindex="-1" href="#" data-number="all">View All</a> </li>
                </ul>
              </div>
            </div>
            <div class="list">
              <?php
		$uID = $_SESSION['user_id'];
		if ($_FILES["bulk_file"]["error"] <= 0){ 
			$len = strlen($_FILES["bulk_file"]["name"]);
			$ext = strtolower(substr($_FILES["bulk_file"]["name"],($len-3)));
			if($ext=='csv'){?>
		<div class="clearFix"></div>
              <div class="form-group">
                <fieldset class="panel-footer text-right">
                  <button type="submit" class="btn btn-success float-left check_cnic" style="position: absolute;
    bottom: 55px;
    right: 155px;" >Submit Checks</button>
                  
                  <div class="clearFix"></div>
                </fieldset>
              </div>
			<?php $fp = fopen($_FILES["bulk_file"]["tmp_name"],'r');
			
			$lCount = 0;
			$c=-1;
			$cc=0;
			while($csv_line = fgetcsv($fp,1024)) {
				
				
			
				$values='';
				$lCount = $lCount+1;
				
				if($lCount==1) continue;
				for ($i = 0, $j = 4; $i <= $j; $i++) {
					$csv_line[$i] = addslashes($csv_line[$i]);
					
				}
				
				if(trim($csv_line[0])!=""){		
				$c++;
				$cc++;				
				
					?>
              <div class="list-item" >
                <div class="list-group">
                  <div class="" id="input-fields-horizontal">
                    <div class="case_data">
                      <h3>
                        <?=$cc?>
                      </h3>
                      <div class="bulk-form-sec-left">
                        <div class="user-profile-area">
                          <input type="checkbox" name="case<?=($lCount-1)?>" value="1"  style="position:absolute;margin:5px;display:none;" checked="checked" data-name="order" />
                          <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput"> <img src="images/user-pro.png" alt="photo" > </div>
                            <div id="progress<?=($lCount-1)?>" class="progress" style="display:none">
                              <div class="progress-bar prg-profile progress-bar-success"></div>
                            </div>
                            <div class="thumbnail_btn">
                              <div id="files<?=($lCount-1)?>" class="files"></div>
                              <span class="btn btn-primary btn-file user-pro-btn"> <span class="fileinput-new">Select image</span>
                              <input type="file" name="files[]" id="v_image<?=($lCount-1)?>" data-id="<?=($lCount-1)?>" class="user_images">
                              </span> </div>
                          </div>
                        </div>
                      </div>
                      <div class="bulk-form-sec-right">
                        <div class="sub-bulk-right-sec">
                          <fieldset class="mrg-bottom custom-input float-left">
                            <div class="form-group">
                              <input type="text" name="ename<?=($lCount-1)?>"  class="form-control countrec ename" placeholder="Applicant Name" title="Applicant Name" value="<?=$csv_line[0]?>" id="ename<?=$c?>" >
                              <span class="validate_ename<?=$c?>"></span> </div>
                            <div class="clearFix"></div>
                          </fieldset>
                          <fieldset class="mrg-bottom custom-input float-left">
                            <div class="form-group ">
                              <input type="text" name="fname<?=($lCount-1)?>" class="form-control fname" placeholder="Father Name" title="Father Name" value="<?=$csv_line[1]?>" id="fname<?=$c?>" >
                              <span class="validate_fname<?=$c?>"></span> </div>
                            <div class="clearFix"></div>
                          </fieldset>
                          <fieldset class="mrg-bottom custom-input float-left">
                            <div class="form-group">
                              <input type="text" name="cnic<?=($lCount-1)?>" id="cnic<?=$c?>" class="form-control parsley-validated cnic" placeholder="CNIC Numbers" data-parsley-maxlength-message="Sorry. You must type 13 digits of CNIC" data-parsley-minlength-message="Sorry. You must type 13 digits of CNIC" data-parsley-type="digits" data-parsley-maxlength="13" data-parsley-minlength="13"   onkeyup="this.value=this.value.replace(/[^\d]/,'');" value="<?=$csv_line[3]?>" data-case="<?=($lCount-1)?>" title="CNIC Numbers"   maxlength="13">
                              <span class="validate_cnic<?=$c?>"></span> </div>
                            <div class="clearFix"></div>
                          </fieldset>
                          <fieldset class="mrg-bottom custom-input float-left">
                            <div class="form-group">
                              <input type="text" name="dob<?=($lCount-1)?>" class="form-control datetimepicker-month" placeholder="Date of Birth" value="<?=$csv_line[4]?>" title="Date of Birth"  id="dob<?=$c?>">
                            </div>
                            <div class="clearFix"></div>
                          </fieldset>
                          <div class="clearFix"></div>
                          <fieldset class="mrg-bottom custom-input float-left">
                            <div class="form-group ">
                              <input type="text" name="empcode<?=($lCount-1)?>" id="empcode<?=$c?>" class="form-control parsley-validated emp_id" placeholder="Employee Code" title="Employee Code" value="<?=$csv_line[2]?>" data-parsley-type="digits" onkeyup="this.value=this.value.replace(/[^\d]/,'');"  data-parsley-required="true"     maxlength="10">
                              <span class="validate_emp_code<?=$c?>" ></span> </div>
                            <div class="clearFix"></div>
                          </fieldset>
                        </div>
                      </div>
                      <div class="clearFix"></div>
                      <?php 
								$where = "cc.com_id=$company_id AND ck.is_active=1 AND cc.clt_active=1";
								
								$tabls = "checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id";
								$checks = $db->select($tabls,"*",$where);
								if(mysql_num_rows($checks)>0){
									$num_check = 100;
                    				while($check = mysql_fetch_assoc($checks)){?>
                      <div class="progress-bar-parent">
                        <h4 class="section-title">
                          <?=$check['checks_title']?>
                          <?php if(!empty($check['checks_tooltip'])){ ?>
                          <a class="ctooltips" href="#"><i class="icon-info-sign"></i><span>
                          <?=$check['checks_tooltip']?>
                          </span></a>
                          <?php }?>
                          <?php if($check['is_multi']==1){?>
                          <a href="javascript:void(0);" onclick="addmorecheck(this,<?=$check['checks_id']?>,<?=($lCount-1)?>,'<?=addslashes($check['checks_title'])?>')"><i class="icon-plus"></i></a>
                          <?php }?>
                          <input style="float:right;" type="checkbox" name="ischeck<?=($lCount-1)?>[]" value="<?=$check['checks_id']?>_1"   data-parsley-required="true" data-parsley-error-message="You must select at least one check" class="parsley-validated parsley-error tickbox" id="<?=($lCount-1)?><?=$num_check?>" />
                        </h4>
                        <div>
                          <div>
                            <p class="text-muted " style="float:right;"> <a class="ctooltips" href="#"><i class="icon-info-sign"></i><span>Allowed file types:<br />
                              (<?php echo FILE_TYPES_ALLOWED;?>)<br />
                              Max file size:<br />
                              (<?php echo FILE_SIZE_ALLOWED;?>)</span></a> </p>
                            <div id="dprogress<?=($lCount-1)?><?=$num_check?><?=$num_check?>" class="progress bulk-upload-prgs" style="width:70%">
                              <div class="progress-bar progress-bar-success"></div>
                            </div>
                            <span style="float:right;" class="btn btn-primary btn-file"><span class="fileinput-new">Select file</span>
                            <input type="hidden" value="<?=$check['checks_id']?>_1" name="checks<?=($lCount-1)?>[]"  />
                            <input type="file" name="files[]" id="docs<?=($lCount-1)?><?=$num_check?><?=$check['checks_id']?>" multiple class="docs_files" data-id="<?=$num_check?>" data-check="<?=$check['checks_id']?>" data-count="<?=($lCount-1)?>" data-ccounter="_1" data-attchid="<?=$num_check?>" onclick="uploadAttach('docs<?=($lCount-1)?><?=$num_check?><?=$check['checks_id']?>')"/>
                            </span>
                            <input type="hidden" id="limit_docs<?=($lCount-1)?><?=$num_check?><?=$check['checks_id']?>" value="0">
                          </div>
                          <div style="clear:both"></div>
                          <div id="docs_file<?=($lCount-1)?><?=$num_check?><?=$num_check?>" class="files"></div>
                          <input name="see_checks_<?=$check['checks_id']?>" value="1"  type="hidden" >
                          <div class="clearFix"></div>
                        </div>
                      </div>
                      <div class="clearFix"></div>
                      <script>
                                         	checks[<?=$check['checks_id']?>] = <?=$num_check?>;
											ccount[<?=($lCount-1)?><?=$check['checks_id']?>] = 1;
											
                                        </script>
                      <?php   
									$num_check++;
									}
								}?>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
				if($lCount-1 > 9 ){
					
				$lCount = 1;
				
				
				}
				} 
			}?>
              <div class="clearFix"></div>
              <div class="form-group">
                <fieldset class="panel-footer text-right">
                  <button type="submit" class="btn btn-success float-left check_cnic" style="position: absolute;
    bottom: 55px;
    right: 155px;" name="submit_bulk">Submit Checks</button>
                  <input type="hidden"  name="is_bulk" value="1"  />
                  <input type="hidden"  id="attachment_counter" name="attachment_counter" value="0"  />
                  <div class="clearFix"></div>
                </fieldset>
              </div>
              <?php
			fclose($fp);			
			}else{ 
				msg('err',"Invalid file type please upload correct file!");
				?>
              <div class="list-group-item2">
               <div class="form-group col-md-3">
                  <label>Download Sample Format</label>
                <button type="button" class="btn btn-success btn-labeled" onclick="document.location='files/format/applicant-bulkupload-sample.csv'"    ><b><i class="icon-file-download"></i></b> Download </button></div>
               
                <div class="form-group col-md-9">
                  <label>Please Upload CSV File</label>
                  <div>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="input-group">
                        <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                        <span class="input-group-addon btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
                        <input type="file" name="bulk_file">
                        </span> <a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                    </div>
                  </div>
                </div>
                
                <!--<input type="file" name="bulk_file" />-->
                <input type="submit" class="btn btn-success" name="upload_bulk" value="Submit"  />
              </div>
              <?php
			}
		}else{
			msg('err',"Please select a csv file to upload!");
			?>
              <div class="list-group-item2">
                <div class="form-group col-md-3">
                  <label>Download Sample Format</label>
                <button type="button" class="btn btn-success btn-labeled"   onclick="document.location='files/format/applicant-bulkupload-sample.csv'" ><b><i class="icon-file-download"></i></b> Download</button>
				</div>
                <div class="form-group col-md-9">
                  <label>Please Upload CSV File</label>
                  <div>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="input-group">
                        <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                        <span class="input-group-addon btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
                        <input type="file" name="bulk_file">
                        </span> <a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                    </div>
                  </div>
                </div>
                
                <!--<input type="file" name="bulk_file" />-->
                <input type="submit" class="btn btn-success" name="upload_bulk" value="Submit"  />
              </div>
              <?php
		}
	}else{ ?>
              <div class="list-group-item2">
                <div class="form-group col-md-3">
                  <label>Download Sample Format</label>
                <button type="button" class="btn btn-success btn-labeled"   onclick="document.location='files/format/applicant-bulkupload-sample.csv'" ><b><i class="icon-file-download"></i></b> Download</button></div>
                <div class="form-group col-md-9">
                  <label>Please Upload CSV File</label>
                  <div>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="input-group">
                        <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                        <span class="input-group-addon btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
                        <input type="file" name="bulk_file">
                        </span> <a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                    </div>
                  </div>
                </div>
                
                <!--<input type="file" name="bulk_file" />-->
                <input type="submit" class="btn btn-success" name="upload_bulk" value="Submit"  />
              </div>
              <?php
	}
	
	
   ?>
            </div>
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
         data-type="<span>Page {current} of {pages}</span> <span style='display:none;'>{start} - {end} of {all}</span>" 
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
            aria-expanded="true"> <span data-type="selected-text">Items per Page</span> <span class="caret"></span> </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdown-menu-1">
                  <li role="presentation"> <a role="menuitem" tabindex="-1" href="#" data-number="3">3 per page</a> </li>
                  <li role="presentation"> <a role="menuitem" tabindex="-1" href="#" data-number="6" >6 per page</a> </li>
                  <li role="presentation"> <a role="menuitem" tabindex="-1" href="#" data-number="10" data-default="true">10 per page</a> </li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"> <a role="menuitem" tabindex="-1" href="#" data-number="all">View All</a> </li>
                </ul>
              </div>
            </div>
          </form>
          
          <!--                            <div class="add-row-bulk">
                         		<a href="javascript:;"><i class="icon-plus"></i></a>
                         	</div>
                            <div></div>-->
          
          <div class="clearFix"></div>
		  <div  class="error_box"></div>
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
	$('#addCheckFrm').parsley(); 
	 var valid = true;
	 
	 
		
		var myData = $("#addCheckFrm").serialize();
		//$("#ajaxLoader").show();
		$(".error_box").html('<img align="center" src="images/spinners/332.gif" />');
		
		
		
	$.ajax({
	url: "?action=manage&atype=bulkupload&submit_bulk=yes&ajaxupload=1",
	
	data:myData,
	type: "POST",
	success: function(res){
		
		//$("#ajaxLoader").hide();
 
   
   if(res!='added'){
		 	$("html, body").animate({ scrollTop: $('#error_box').offset().top }, 5000);
			//location.hash = "#error_box";
			//proton.dashboard.errors(res,"Error!");
		 $(".error_box").html('<div class="alert alert-dismissable alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button><span class="title"><i class="icon-remove-sign"></i> ERROR</span>'+res+'</div>');
		  valid=false; 
		  return valid;
	
	 }else{
		$(".error_box").html('<div class="alert alert-dismissable alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button><span class="title"><i class="icon-remove-sign"></i> SUCCESS</span>Records added successfully.</div>');
		//$(".error_box").html(''); 
		//document.addCheckFrm.reset();
		
		$(".ename").each(function(ind,obj){
			//console.log(ind);
		$("#ename"+ind).val('');
		$("#fname"+ind).val('');
		$("#cnic"+ind).val('');
		$("#dob"+ind).val('');
		$("#empcode"+ind).val('');
			
		});
		//$('#addCheckFrm').reset();
		
	 }
   
   
   
   
   
   
	}
	});
		
return false;		
});




});
		
		$(document).on('click','.datetimepicker-month',function(e){
		e.preventDefault();
		$( ".datetimepicker-month").datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			yearRange: "1900:2015"
			});
		});
		 					
			

				
		$(".user_images").each(function(index, element) {
            set_image($(this).data('id'));
        });
		var myCount = '<?php echo $cc;?>';
		function uploadAttach(id){
			
			var chk = $("#limit_"+id).val();
			
			if(chk==0){
            set_docs($("#"+id).data('id'),$("#"+id).data('count'),$("#"+id).data('check'),$("#"+id).data('ccounter'),$("#"+id).data('attchid'));
			$("#limit_"+id).val(1);
			}
			

      
		}
		function clearFields(){
	document.addCheckFrm.reset();
}
</script> 
<script src="scripts/vendor/bootstrap-datetimepicker.js"></script> 
<script src="scripts/vendor/fileinput.js"></script> 
<script src="scripts/vendor/parsley.min.js"></script> 
<script src="scripts/vendor/parsley.extend.min.js"></script> 
<script type="text/javascript">
function checkCnic(vl,ur,div_cl,len,att,chk){
    //images/spinners/332.gif
       
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



</script> 
