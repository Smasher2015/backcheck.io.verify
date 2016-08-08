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
.stepy_border{border: 1px solid #b7b7b8; padding: 39px 32px; margin: 0 0 28px 0}
.bulk-upl .btn-primary{background-color: #b7b7b8;border-color: #b7b7b8;padding: 9px 0;}
.bulk-upl .btn-primary:hover{background-color: #b7b7b8;border-color: #b7b7b8;}
.bulk-upl .form-control{background: #eae9e8;border: none;border-radius: 0; float: left;display: inline-block;width: 77%;}
.bulk-upl .input-group {position: relative;display: inline-block;width: 100%;}
.bulk-upl .form-group.bul_up_sec{margin-top: 30px;}
.wizard>.steps>ul>li:before, .wizard>.steps>ul>li:after{background-color: #fff !important;}
.fileinput {width: 86%;float: left;}
.wizard>.steps>ul{text-align: center;}
.field_data .form-control{height: 30px;font-size: 12px; background:#f2f2f2;}
.field_data .form-group{margin-bottom:10px;}
.wizard>.steps>ul>li{display: inline-block;margin-right: 22px;}
.radio-inline, .checkbox-inline{padding-left:8px;}
.wizard>.steps .number{position: static; margin-right: 19px;margin-left: 0px;font-size: 26px;}
.bar-prog{background: #f5f5f5;padding: 11px;}
.wizard>.steps>ul>li a{background: #b7b7b8;padding: 7px 57px 7px 14px;color: #fff !important;font-weight: 700;border-radius: 1px;margin-top: 68px; font-size: 20px;}
.wizard>.steps>ul>li.current>a{background: #d3202a;}

.wizard>.steps>ul>li.current .number{border-color: #fff;color: #961b1e;}

.wizard>.steps>ul>li.disabled a{background-color: #b7b7b8;}

.wizard>.steps>ul>li.done .number{background-color: #fff; color: #b7b7b8; border: #fff;}
.wizard>.steps>ul>li.done .number:after{line-height: 39px;}
.wizard>.steps>ul>li.current a:before {
    border-color: rgba(0, 0, 0, 0);
    border-top-color: #d3202a;
    border-width: 10px;
    margin-left: -10px;
}
.wizard>.steps>ul>li.current a:after, .wizard>.steps>ul>li.current a:before {
    top: 100%;
    left: 50%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
}
.wizard>.steps>ul>li.current a:after {
    border-color: rgba(0, 0, 0, 0);
    border-top-color: #d3202a;
    border-width: 10px;
    margin-left: -10px;
}


.wizard>.actions>ul>li+li{margin-right: 21px;}
.wizard>.actions>ul>li>a {
	position: relative;
    margin: 0;
    padding-left: 28px;
    padding-right: 26px;
    padding-top: 8px;
    padding-bottom: 6px;
    background: #d3202a;
    color: #fff;
    font-size: 18px;
    font-weight: 700;
}
.section-sprate{width: 100%;float: left;border-bottom: 1px solid #999;padding-bottom: 15px;margin-bottom: 10px;}
.wizard>.actions>ul>li>a::after {
  content: '';
  position: absolute;
  top: 0;
  width: 0;
  height: 0;
}

.wizard>.actions>ul>li>a:hover { background: #000; }

/* Arrow Buttons */
/* ------------- */
.wizard>.actions>ul>li>a::after{ border-style: solid; }

/* Next Button */
/* ----------- */
.wizard>.actions>ul>li>a[href="#next"]::after, .wizard>.actions>ul>li>a[href="#finish"]::after {
    right: -43px;
    border-width: 21px;
    border-color: transparent transparent transparent #d3202a;
}

.wizard>.actions>ul>li>a[href="#next"]:hover::after, .wizard>.actions>ul>li>a[href="#finish"]:hover::after {
  border-left-color: #000;
}

/* Prev Button */
/* ----------- */
.wizard>.actions>ul>li>a[href="#previous"]{background-color: #b7b7b8;color: #fff;border: none;}

.wizard>.actions>ul>li>a[href="#previous"]::after {
  left: -40px;
  border-color: transparent #b7b7b8 transparent transparent;
  border-width: 20px;
}

.prev:hover::after {
  border-right-color: #000;
}
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

</style>
  <div id="error_box" class="row">
  <div class="col-md-12">
    <div class="report-sec">
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title3">
          		<h2><?php include('include_pages/pages_breadcrumb_inc.php'); ?></h2>
        	</div>
        </div>
        </div>
        
      <div class="panel panel-default panel-block">
       
        <div class="bulk-dev" id="demo">
          <div  class="error_box"></div>
          <div class="steps-basic" action="#">
							<h6>Upload</h6>
							<fieldset>
								<div class="stepy_border border-grey">

								
								
								
								
								
								
								
								
								
								
								
								
								
								

								<div class="row">
									<div class="col-md-6 bulk-upl">
										<div class="col-md-11">
										<h4 class="border-bottom border-grey" style="padding-bottom:7px">Document Upload</h4>

										<div class="form-group bul_up_sec">
										<form method="post" enctype="multipart/form-data">
										
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
										
										
										
										
										
									<label class="col-lg-2 control-label text-semibold">Choose File:</label>
									<div class="col-lg-10">
										
					<div class="fileinput form-group fileinput-new" data-provides="fileinput">
                      <div class="input-group">
                        <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                        <span class="input-group-addon btn btn-primary btn-file">
                        <span class="fileinput-new"><i class="icon-plus2  icon-rotate-cw3"></i></span>
                        <span class="fileinput-exists"><i class="icon-rotate-cw3"></i></span>
                        <input type="file" class="files" name="bulk_file">
                        </span> <a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                    </div><!--<span class="help-block pull-right">Choose File (Format)</span>-->
                                        <button type="submit" class="btn btn-success" name="upload_bulk" value="" ><i class="icon-check"></i></button>
									</div>
									</form>
			<?php if(isset($_FILES['bulk_file'])){ ?>
			
			<?php
			
		if ($_FILES["bulk_file"]["error"] <= 0){ 
		$len = strlen($_FILES["bulk_file"]["name"]);
			$ext = strtolower(substr($_FILES["bulk_file"]["name"],($len-3)));
			if($ext=='csv'){ ?>
			<script>
			var c=0;
			 $(document).ready(function(){
				c++;
				if(c==1){
					
			$('a[href="#next"]').trigger( "click" );
				}
			 });
			</script>
			<?php } } } ?>
								</div>

									</div>
								</div>
									
									<div class="col-md-6 blk_adv_right" id="thisdiv">
										<h4 class="" style="padding-bottom:7px">Text</h4>
										<p><b>Verification Result Access</b>
 The verified document will be available for download or viewing for a period of three years from the date completing the verification.</p>
										<p><b>Verifying Authority</b>
Controller of Examination will verify authenticity of the paper based document and BackCheck team will upload the verification result.
</p>
                                        <p><b>Response Time</b> 
Response time for verification is based on the record search time by the verifying institution and the availability of the verifying authority.</p>
                                        <p><b>Refund</b>
Once payment is done, no refund will be made under any circumstances.</p>
                                        <p><b>Email</b> 
The verification result will be sent only to the registered email-id.</p>
                                        <p><b>Declined Transaction</b>
The verifying institution will not verify provisional certificate if the degree certificate has been issued. The verification request will be declined if the information entered by the user does not match the content of the uploaded documents. Verification requests that are declined by the verifying authority will be allowed to be re-initiated at the sole discretion of the verifying authority. The verification request will be declined if the image uploaded is having:-
<br>a.Multiple documents
<br>b.Image is not clear
<br>c.Document does not pertain to the requesting university.</p>
                                        <p><b>Supporting Documents 
</b>Provisional certificate that does not contain the college name has to be supported by documents such as mark-sheets or marks card before raising a verification request. Furthermore, the provisional certificate and supporting documents should be uploaded in a single file format.</p>
                                        <p><p>Information </b>
Kindly enter all information mentioned in the certificate while requesting verification</p>
                                       
									</div>
								</div>

								</div>
							</fieldset>

							<h6>Fields</h6>
							<fieldset>
							<form method="post" enctype="multipart/form-data"   id="addCheckFrm" name="addCheckFrm" >
								<div class="stepy_border border-grey bulk_field">
								<?php if($LEVEL!=4){ ?>
								<input type="hidden" name="clntid" value="<?php echo $company_id;?>">
								<input type="hidden" name="how_rec_checks" value="<?php echo $_REQUEST['how_rec_checks'];?>">
								<?php } ?>
						
							<h4 class="border-bottom border-grey" style="padding-bottom:7px;margin-bottom:18px;">Select Checks</h4>
							<div class="row">
							<?php 
							$allchecks = array();
							$where = "cc.com_id=$company_id AND ck.is_active=1 AND cc.clt_active=1";
								$tabls = "checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id";
								$checks = $db->select($tabls,"*",$where);
								if(mysql_num_rows($checks)>0){
								$cc=0;
                    				while($check = mysql_fetch_assoc($checks)){
									$cc++;	
									$allchecks[]=$check['checks_id'];
									?>
							
							
							
								<div class="checkbox bulk_check col-md-3">
											<label>
												<input type="checkbox" class="styled" checked="checked"  onclick="this.checked=!this.checked;" value="<?=$check['checks_id']?>" name="checks[]" >
												<?=$check['checks_title']?>   <?php if(!empty($check['checks_tooltip'])){ ?>
                                            	<a class="ctooltips" href="#"><i class="icon-info22"></i><span><?=$check['checks_tooltip']?></span></a>
                                            <?php }?>
											</label>
								</div>
								<?php 
									if($cc==4){
										echo '</div><div class="row">';
										$cc=0;
									}
								
								}
								} ?>
								
								
								

							</div>

							

							<h4 class="border-bottom border-grey" style="padding-bottom:7px;margin-bottom:18px;margin-top:35px;">Fields Data</h4>
						
							<div class="row">
								<div class="col-md-12">
									<div class="field_data">
										
										<?php 
										if(in_array(1,$allchecks) && in_array(2,$allchecks)){
											$colspan=2;
										}else{
											$colspan=4;
										}
										
										
		if(isset($_FILES['bulk_file'])){ ?>
		
		
		<div class="clearFix"></div>
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
                  <li role="presentation"> <a role="menuitem" tabindex="-1" href="#" data-number="2" data-default="true">2 per page</a> </li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"> <a role="menuitem" tabindex="-1" href="#" data-number="all">View All</a> </li>
                </ul>
              </div>
            </div>
		<div class="clearFix"></div>
		<div class="list">
		
		<div class="clearFix"></div>
			<div class="col-md-12"><fieldset class="text-right">
                  <button type="submit" class="btn btn-success check_cnic" name="submit_bulk" >Submit Checks</button>
                  <input type="hidden"  name="is_bulk" value="1" >
                  <input type="hidden"  id="attachment_counter" name="attachment_counter" value="0" >
                  <div class="clearFix"></div>
                </fieldset></div>
                <div class="clearFix"></div>
		
		
		
		<?php				
		$uID = $_SESSION['user_id'];
		if ($_FILES["bulk_file"]["error"] <= 0){ 
		$len = strlen($_FILES["bulk_file"]["name"]);
			$ext = strtolower(substr($_FILES["bulk_file"]["name"],($len-3)));
			if($ext=='csv'){   
			
			 $fp = fopen($_FILES["bulk_file"]["tmp_name"],'r');
			
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
				$num_check = 100;
				?>
				 <div class="list-item" >
                <div class="list-group">
				<div class="clearFix"></div>
                <div class="section-sprate">
									<div class="col-md-12">
                                    		<div class="col-md-12">
											<div class="form-group">
											<?php /*?><?=$cc?><?php */?> <h6><label class="checkbox-inline"><input type="checkbox" class="styled" name="skip_case[<?=($lCount-1)?>]" value="<?=($lCount-1)?>">Skip this case</label></h6>
                                            </div></div>
										
												<div class="col-md-4">
												<div class="form-group">
                                                <label>First Name <span>*</span>:</label>
												
                                                <input type="text" name="first_name<?=($lCount-1)?>" placeholder="First Name" value="<?=$csv_line[0]?>" id="first_name<?=$c?>" class="req form-control" required>
												 <input type="hidden" name="case<?=($lCount-1)?>" value="1"  data-name="order" />
												</div></div>
												<div class="col-md-4">
                                                <div class="form-group">
												<label>Last Name:</label>
												<input type="text" name="last_name<?=($lCount-1)?>" placeholder="Last Name"  value="<?=$csv_line[1]?>" class="req form-control" required></div></div>
												<div class="col-md-4">
                                                <div class="form-group">
												<label>Father Name:</label>
												<input type="text" name="fname<?=($lCount-1)?>" placeholder="Father Name"  value="<?=$csv_line[2]?>" class="req form-control" required></div></div>
												<div class="col-md-4">
                                                <div class="form-group">
												<label>ID Card:</label>
												<input type="text" name="cnic<?=($lCount-1)?>" placeholder="ID Card"  value="<?=$csv_line[3]?>" class="req form-control" required pattern="[0-9]+" maxlength="13" title="Type ID Card 13 Digits">
												 <span class="validate_cnic<?=$c?>"></span></div></div>
											
												
												<div class="col-md-4">
                                                <div class="form-group">
												<label>Date of birth:</label>
												<input type="text" name="dob<?=($lCount-1)?>" placeholder="Date of birth (YYYY-MM-DD)"  value="<?=$csv_line[4]?>" class="req form-control" required pattern="\d{4}-\d{1,2}-\d{1,2}" title="Type Date of birth (YYYY-MM-DD)"></div></div>
												<div class="col-md-4">
                                                <div class="form-group">
												<label>Ref No.</label>
												<input type="text" name="empcode<?=($lCount-1)?>" placeholder="Ref No."   value="<?=$csv_line[5]?>" class="req form-control" required maxlength="10"></div></div>
											
                                            
                                    </div><!--12-->
										<?php if(in_array(1,$allchecks)){?>
                                        <div class="col-md-6">
                                                
												<h4>Education Info</h4>
												<div class="col-md-6">
                                                <div class="form-group">
												<label>University Name:</label>
												<input type="text" name="uni_name<?=($lCount-1)?>" placeholder="University Name"  value="<?=$csv_line[6]?>" class="req form-control" required>
                                                </div></div>
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Registration Number:</label>
												<input type="text" name="reg_num<?=($lCount-1)?>" placeholder="Registration Number"  value="<?=$csv_line[7]?>" class="req form-control" required>
                                                </div></div>
												
												
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Degree Title:</label>
												<input type="text" name="degree<?=($lCount-1)?>" placeholder="Degree Title"  value="<?=$csv_line[8]?>" class="req form-control" required>
                                                </div></div>
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Remarks:</label>
												<input type="text" name="remarks<?=($lCount-1)?>" placeholder="Remarks"  value="<?=$csv_line[9]?>" class="req form-control" required>
                                                
                                                </div></div>
												
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Passing Year:</label>
												<input type="text" name="pass_year<?=($lCount-1)?>" placeholder="Passing Year"  value="<?=$csv_line[10]?>" class="req form-control" required>
                                                </div></div>
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Serial No:</label>
												<input type="text" name="serial_no<?=($lCount-1)?>" placeholder="Serial No"  value="<?=$csv_line[11]?>" class="req form-control" required>
                                                </div></div>
												
                                        
                                        </div>
										
											<?php } if(in_array(2,$allchecks)){?>
												<div class="col-md-6">
                                                
												
                                                <h4>Company Info</h4>
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Company Name:</label>
												<input type="text" name="company_name<?=($lCount-1)?>" placeholder="Company Name"  value="<?=$csv_line[12]?>" class="req form-control" required>
                                                </div></div>
                                                
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Date of Joining:</label>
												<input type="text" name="date_of_join<?=($lCount-1)?>" placeholder="Date of Joining (YYYY-MM-DD)"  value="<?=$csv_line[13]?>" class="req form-control" required pattern="\d{4}-\d{1,2}-\d{1,2}" title="Type Date of Joining (YYYY-MM-DD)">
                                                </div></div>
												<!--]-->
												
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Employement Status:</label>
												<input type="text" name="emp_status<?=($lCount-1)?>" placeholder="Employement Status"  value="<?=$csv_line[14]?>" class="req form-control" required>
                                                </div></div>
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Last Working Day:</label>
												<input type="text" name="last_work_day<?=($lCount-1)?>" placeholder="Last Working Day"  value="<?=$csv_line[15]?>" class="req form-control" required>
                                                </div></div>
												
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Last Designation:</label>
												<input type="text" name="last_designation<?=($lCount-1)?>" placeholder="Last Designation"  value="<?=$csv_line[16]?>" class="req form-control" required>
                                                </div></div>
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Last Place of Posting:</label>
												<input type="text" name="last_place_posted<?=($lCount-1)?>" placeholder="Last Place of Posting"  value="<?=$csv_line[17]?>" class="req form-control" required>
                                                </div></div>
												
												
												
                                                </div>
												<?php } ?>
											
										<div class="col-md-12 bar-prog">
                          
                            <p class="text-muted " style="float:right;"> <a class="ctooltips" href="#"><i class="icon-info-sign"></i><span>Allowed file types:<br />
                              (<?php echo FILE_TYPES_ALLOWED;?>)<br />
                              Max file size:<br />
                              (<?php echo FILE_SIZE_ALLOWED;?>)</span></a> </p>
                            <div id="dprogress<?=($lCount-1)?><?=$num_check?><?=$num_check?>" class="progress bulk-upload-prgs" style="width:70%">
                              <div class="progress-bar progress-bar-success"></div>
                            </div>
                            <span style="float:right;" class="btn btn-primary btn-file"><span class="fileinput-new">Select file</span>
                            <input type="hidden" value="<?=($lCount-1)?>_1" name="checks<?=($lCount-1)?>[]"  />
                            <input type="file" name="files[]" id="docs<?=($lCount-1)?><?=$num_check?><?=($lCount-1)?>" multiple class="docs_files" data-id="<?=$num_check?>" data-check="<?=($lCount-1)?>" data-count="<?=($lCount-1)?>" data-ccounter="_1" data-attchid="<?=$num_check?>" onclick="uploadAttach('docs<?=($lCount-1)?><?=$num_check?><?=($lCount-1)?>')"/>
                            </span>
                            <input type="hidden" id="limit_docs<?=($lCount-1)?><?=$num_check?><?=($lCount-1)?>" value="0">
                          <div style="clear:both"></div>
                          <div id="docs_file<?=($lCount-1)?><?=$num_check?><?=$num_check?>" class="files"></div>
                          <input name="see_checks_<?=($lCount-1)?>" value="1"  type="hidden" >
                          <div class="clearFix"></div>
                        </div>
                      </div>
					   <script>
                                         	checks[<?=($lCount-1)?>] = <?=$num_check?>;
											ccount[<?=($lCount-1)?><?=($lCount-1)?>] = 1;
											
											
                                        </script>
					  
											<?php 
											$num_check++;
											?>
						</div>
				</div>
											<?php
											
				if($lCount-1 > 1 ){
					
				$lCount = 1;
				
				
				}
				}
			}// end while
			?>
			<div class="clearFix"></div>
			<div class="col-md-12"><fieldset class="text-right">
                  <button type="submit" class="btn btn-success check_cnic" name="submit_bulk" >Submit Checks</button>
                  <input type="hidden"  name="is_bulk" value="1" >
                  <input type="hidden"  id="attachment_counter" name="attachment_counter" value="0" >
                  <div class="clearFix"></div>
                </fieldset></div>
                <div class="clearFix"></div>
			<?php
			fclose($fp);
			}else{
				msg('err',"Please select a csv file to upload!");
			}
						}else{
							msg('err',"Please select a csv file to upload!");
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
                  <li role="presentation"> <a role="menuitem" tabindex="-1" href="#" data-number="2" data-default="true">2 per page</a> </li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"> <a role="menuitem" tabindex="-1" href="#" data-number="all">View All</a> </li>
                </ul>
              </div>
            </div>
          
									
						
						<?php
						}						?>
	                                      
									</div>


								</div>

							</div>

									


						</div>
						</form>
							</fieldset>

							<h6>Import</h6>
							<fieldset>
								<div class="stepy_border border-grey">
								<div class="row">
									<div class="col-md-12">
										<ul class="media-list">
											<li class="media">
											<div class="media-left">
												<a href="#" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-xs"><i class="icon-checkmark3"></i></a>
											</div>
											
											<h2 class="media-body text-success text-bold">100 Import successfully,</h2>

											
										</li>

										<li class="media">
											<div class="media-left">
												<a href="#" class="btn border-danger-400 text-danger-400 btn-flat btn-rounded btn-icon btn-xs"><i class="icon-cross2"></i></a>
											</div>
											
											<h2 class="media-body text-danger-400 text-bold">20 Unsuccessfully,</h2>

											
										</li>


										</ul>
									</div>

								
								</div>

							</div>
							</fieldset>

							
						</div>
          
          
          
          
       
        
          
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
	
	 var valid = true;
	 
	 
		
		var myData = $("#addCheckFrm").serialize();
		$("#ajaxLoader").show();
		//$(".error_box").html('<img align="center" src="images/spinners/332.gif" />');
		
		//?action=advanced_bulk&atype=upload
		
	$.ajax({
	url: "?action=advanced_bulk&atype=upload&submit_bulk=yes&ajaxupload2=1",
	
	data:myData,
	type: "POST",
	success: function(res){
		
		$("#ajaxLoader").hide();
 
   
   if(res!='added'){
		 	$("html, body").animate({ scrollTop: $('#error_box').offset().top }, 5000);
			//location.hash = "#error_box";
			//proton.dashboard.errors(res,"Error!");
		 $(".error_box").html('<div class="alert alert-dismissable alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button><span class="title"><i class="icon-remove-sign"></i> ERROR</span>'+res+'</div>');
		  valid=false; 
		  return valid;
	
	 }else{
		$(".error_box").html('<div class="alert alert-dismissable alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button><span class="title"><i class="icon-remove-sign"></i> SUCCESS</span>Records added successfully.</div>');
		
		/* $(".req").each(function( index ) {
		console.log( index + ": " + $( this ).text() );
		}); */
		
		//$(".error_box").html(''); 
		//document.addCheckFrm.reset();
		
		/*  $(".ename").each(function(ind,obj){
			
		$("#ename"+ind).val('');
		$("#fname"+ind).val('');
		$("#cnic"+ind).val('');
		$("#dob"+ind).val('');
		$("#empcode"+ind).val('');
			
		}); */
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

$(document).ready(function() {  
        $("#thisdiv").niceScroll({cursorcolor:"#00F"});
    });

</script> 
