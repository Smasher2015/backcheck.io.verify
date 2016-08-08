<?php if($LEVEL!=4){
	$company_id = $_REQUEST['clntid'];
	$comInfo = getcompany($company_id);
	$COMINF = @mysql_fetch_array($comInfo);
	$lev = getLevel($LEVEL);
	$info_title = $lev['level_name'];
	
}else {
	$company_id = $COMINF['id'];
	$info_title = $COMINF['name'];
}

function getTotalPkgAmount($company_id){
	global $db;
	$totalAmount = 0;
	$where = "cc.com_id=$company_id AND ck.is_active=1 AND cc.clt_active=1";
		$tabls = "checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id";
		$checks = $db->select($tabls,"*",$where);
		if(mysql_num_rows($checks)>0){
		
			while($check = mysql_fetch_assoc($checks)){
				
			$totalAmount += getCheckAmount($company_id,$check['checks_id']);
											
		}
		}
		
		return $totalAmount;
	
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
.bulk-upl .btn-primary{background-color: #43bce9;border-color: #43bce9;padding: 9px 0;}
.bulk-upl .btn-primary:hover{background-color: #b7b7b8;border-color: #b7b7b8;}
.bulk-upl .form-control{background: #eae9e8;border: none;float: left;display: inline-block;width: 77%;}
.bulk-upl .input-group {position: relative;display: inline-block;width: 100%;}
.bulk-upl .form-group.bul_up_sec{margin-top: 30px;}
.wizard>.steps>ul>li:before, .wizard>.steps>ul>li:after{background-color: transparent !important;}
.fileinput {width: 86%;float: left;}
.wizard>.steps>ul{text-align: center;}
.field_data .form-control{height: 30px;font-size: 12px; background:#f2f2f2;}
.field_data .form-group{margin-bottom:10px;}
.list-group{border:none;}
.wizard>.steps>ul>li{display: inline-block;margin-right: 0;}
.wizard>.steps>ul>li:first-child a{border-radius: 3px 0 0 3px;}
.wizard>.steps>ul>li:last-child a{border-radius: 0 3px 3px 0;}
.radio-inline, .checkbox-inline{padding-left:8px;}
.wizard>.steps .number{position: static; margin-right: 7px;margin-left: 0px;font-size: 16px;line-height: 29px;width: 32px;height: 32px;}
.wizard>.steps>ul>li.current .number:after{    font-size: 13px;line-height: 29px;}
.bar-prog{background: #f5f5f5;padding: 11px;}
.wizard>.steps>ul>li a{background: #b7b7b8;padding: 7px 18px 7px 14px;color: #fff !important;font-weight: 700;border-radius: 1px;margin-top: 0; font-size: 16px;}
.wizard>.steps>ul>li.current>a{background: #fb6e52;}

.wizard>.steps>ul>li.current .number{border-color: #fff;color: #fb6e52;}

.wizard>.steps>ul>li.disabled a{background-color: #b7b7b8;}

.wizard>.steps>ul>li.done .number{background-color: #fff; color: #b7b7b8; border: #fff;}
.wizard>.steps>ul>li.done .number:after{line-height: 39px;}
.wizard>.steps>ul>li.current a:before {
    border-color: rgba(0, 0, 0, 0);
    border-top-color: #fb6e52;
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
    border-top-color: #fb6e52;
    border-width: 10px;
    margin-left: -10px;
}

.wizard>.actions { display:none;}
.wizard>.actions>ul>li+li{margin-right: 21px;}
.wizard>.actions>ul>li>a {
	position: relative;
    margin: 0;
    padding-left: 28px;
    padding-right: 26px;
    padding-top: 8px;
    padding-bottom: 6px;
    background: #fb6e52;
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
.crd_adv{position: absolute;right: 32px;}
.crd_adv .well{padding: 13px;}
</style>
	
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title2">
          		<h1><?php include('include_pages/pages_breadcrumb_inc.php'); ?></h1>
        	</div>
                                    <?php
                        include("headers_right_menu_inc.php");
						?>

            
        </div>
        </div>

  <div id="error_box" class="content">
  <div class="">
    <div class="">
        <div  class="error_box"></div>
      <div class="panel panel-white">
       
        <div class="bulk-dev" id="demo">
		  <?php  if($COMINF['account_type']==1){ ?>
		 <div class="col-md-2 crd_adv text-center">
         <div class="well border-top-lg border-top-danger"><i class="icon-cart5 position-left"></i>In Bucket: <span class="text-semibold text-red" id="loadCredits"><?php echo getCredits($company_id);?></span></div>
		 
	
		 </div>
		
		 
		  <?php } ?>
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
                    <select id="clntid" name="clntid" class="select" required>
                      <option value="">Select Client</option>
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
                    <select id="how_rec_checks" name="how_rec_checks" class="select" required >
                      <option value="">How Receive Checks?</option>
                     
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
							<?php } if($LEVEL==4){

							if(in_array($COMINF[id],unserialize(CHECK_COMIDS))){
								
								$getUserInf = getUserInfo($uID);
								if($getUserInf['puser_id']==0 && $getUserInf['is_subuser']==0){
								?>
							
							<div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label>Select User:</label>
                  </div>
                  <div class="col-md-9">
                    <select id="user_id" name="user_id" class="select" required >
                      <option value="">Select User</option>
					  
					   <optgroup label="Head Office">
					  
					  <?php $db = new DB();
					  $usersMain = $db->select("users","user_id,concat(first_name,' ',last_name) as fullname","is_active=1 AND loc_id=0 AND com_id=$COMINF[id] AND is_subuser=0");
					  while($rsUsers2 = mysql_fetch_assoc($usersMain)){ ?>
					  <option value="<?php echo $rsUsers2['user_id'];?>" <?php echo chk_or_sel($rsUsers2['user_id'],$_REQUEST['user_id'],'selected');?>><?php echo $rsUsers2['fullname'];?></option>
					  
					  <?php } ?>
                     
                      </optgroup>
					  
					  
					  
                      <?php 	
					$dWhere=" com_id=$COMINF[id] AND status=0 order by location asc";							
					$locs = $db->select("users_locations","*",$dWhere);
												
                                            
                                               
                     while($loc =mysql_fetch_array($locs)){  
					$users = $db->select("users","user_id,concat(first_name,' ',last_name) as fullname","is_active=1 AND loc_id=$loc[loc_id] AND com_id=$COMINF[id]");?>
                      <optgroup label="<?=$loc['location']?>">
					  
					  <?php while($rsUsers = mysql_fetch_assoc($users)){ ?>
					  <option value="<?php echo $rsUsers['user_id'];?>"><?php echo $rsUsers['fullname'];?></option>
					  
					  <?php } ?>
                     
                      </optgroup>
                      <?php	} ?>
					  
					 
					  
					  
                    </select>
                  </div>
                </div>
				</div>
						<?php	
									}
								} 
							} ?>
										
					<div class="form-group ">
					 <div class="row">
					 <div class="col-md-3">
                    <label>Select Order Type:</label>
					</div>
					 <div class="col-md-9">
						<select placeholder="Select Order Type"  title="Select Order Type" name="ord_typ" id="ord_typ" class="form-control  parsley-validated" data-layout="topRight" data-type="confirm">
						<option value="pkg_ord" <?php echo chk_or_sel($_REQUEST['ord_typ'],'pkg_ord','selected');?>>Package Order</option>
						<option value="custom_ord" <?php echo chk_or_sel($_REQUEST['ord_typ'],'custom_ord','selected');?>>Custom Order</option>
						</select>
						<input type="hidden" name="is_sub_pkg_drop" id="is_sub_pkg_drop">
					</div>	
					</div>	
					</div>
										
										
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
			
			<div class="form-group mt-20">
                  
                <button type="button" class="btn bg-red" onclick="document.location='files/format/applicant-bulkupload-sample.csv'"><i class="icon-file-download position-left"></i> Download Sample Format</button></div>
								</div>

									</div>
								</div>
									
									<div class="col-md-6 blk_adv_right" id="thisdiv">
										<h4 class="" style="padding-bottom:7px">User Instructions</h4>
										<p>Add a new check is the option to add different checks of one candidate only in one time. However, Advanced Bulk Upload makes easier the uploading of checks of more than one candidate in the same time.</p>
										<p>A sample could be downloaded in excel sheet by clicking Download Sample Format or file could be chosen from Choose File option from own machine/system and a bulk of candidates could be uploaded.</p>
                                        <p>The format of the file should be same as given in sample sheet.</p>
                                        <p>Necessary fields are subject to be filled mandatorily.</p>
                                        <p>If in case no information is available put N/A, don’t leave any field blank else it will not let you move ahead.</p>
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
								
								<?php } if(isset($_REQUEST['user_id']) && is_numeric($_REQUEST['user_id'])){ ?>
								<input type="hidden" name="user_id" value="<?php echo $_REQUEST['user_id'];?>">
								<?php } if(isset($_REQUEST['ord_typ'])){ ?>
								<input type="hidden" name="ord_typ" value="<?php echo $_REQUEST['ord_typ'];?>">

								<?php  } $allchecks = array();
								if($company_id){ ?>
						
							<h4 class="border-bottom border-grey" style="padding-bottom:7px;margin-bottom:18px;">Select Checks</h4>
							<div class="row">
							<?php 
							$allchecks = array();
							$where = "cc.com_id=$company_id AND ck.is_active=1 AND cc.clt_active=1";
								$tabls = "checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id";
								$checks = $db->select($tabls,"*",$where);
								if(isset($_REQUEST['ord_typ']) && $_REQUEST['ord_typ']=='custom_ord'){
									$attrs = '';	
									}else{
									$attrs = 'checked="checked"  onclick="this.checked=!this.checked;"';
									}
								if(@mysql_num_rows($checks)>0){
								$cc=0;
                    				while($check = @mysql_fetch_assoc($checks)){
									$cc++;	
									$allchecks[]=$check['checks_id'];
									if(isset($_REQUEST['ord_typ']) && $_REQUEST['ord_typ']=='custom_ord'){
									$chk_price = $check['checks_amt'];	
									}else{
									$chk_price = getCheckAmount($company_id,$check['checks_id']);	
									}
									?>
							
							
							
								<div class="checkbox bulk_check col-md-4">
											<label>
												<input type="checkbox" class="styled parsley-validated parsley-error" <?php echo $attrs;?> value="<?=$check['checks_id']?>" name="checks[]" data-parsley-required="true" data-parsley-error-message="You must select at least one check">
												<?=$check['checks_title']?>   <?php if(!empty($check['checks_info'])){ ?>
                                            	<a class="ctooltips" href="#"><i class="icon-info22"></i><span><?=$check['checks_info']?> </br> 
												Amount: <?php echo $chk_price;?>
												</span></a>
                                            <?php }?>
											</label>
								</div>
								<?php 
									if($cc==3){
										echo '</div><div class="row">';
										$cc=0;
									}
								
								}
								}else{?>
								<div class="checkbox bulk_check col-md-4">No Checks in package.</div>
								<?php } ?>
								
								
								

							</div>
								<?php } ?>

							

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
                  <li role="presentation"> <a role="menuitem" tabindex="-1" href="#" data-number="10" data-default="true">10 per page</a> </li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"> <a role="menuitem" tabindex="-1" href="#" data-number="all">View All</a> </li>
                </ul>
              </div>
            </div>
		<div class="clearFix"></div>
		<div class="list">
		
		<div class="clearFix"></div>
			<div class="col-md-12" style="position: absolute;right: 0;width: auto;top: 0;"><fieldset class="text-right">
                  <button type="submit" class="btn bg-success-600 btn-lg check_cnic" name="submit_bulk" ><i class="icon-add-to-list position-left"></i> Submit Checks</button>
                  <input type="hidden"  name="is_bulk" value="1" >
                  <input type="hidden"  id="attachment_counter" name="attachment_counter" value="0" >
                  <div class="clearFix"></div>
                </fieldset></div>
		
		
		
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
											<?php /*?><?=$cc?><?php */?> <h6><label class="checkbox-inline"><input type="checkbox" class="styled clss_hide_remov" name="skip_case[<?=($lCount-1)?>]" value="<?=($lCount-1)?>">Skip this case</label></h6>
                                            </div></div>
										
												<div class="col-md-4">
												<div class="form-group">
                                                <label>First Name <span>*</span>:</label>
												
                                                <input type="text" name="first_name<?=($lCount-1)?>" placeholder="First Name" value="<?=$csv_line[0]?>" id="first_name<?=$c?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required>
												 <input type="hidden" name="case<?=($lCount-1)?>" value="1"  data-name="order" />
												</div></div>
												<div class="col-md-4">
                                                <div class="form-group">
												<label>Last Name:</label>
												<input type="text" name="last_name<?=($lCount-1)?>" placeholder="Last Name"  value="<?=$csv_line[1]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required></div></div>
												<div class="col-md-4">
                                                <div class="form-group">
												<label>Father Name:</label>
												<input type="text" name="fname<?=($lCount-1)?>" placeholder="Father Name"  value="<?=$csv_line[2]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required></div></div>
												<div class="col-md-4">
                                                <div class="form-group">
												<label><?php echo ID_CARD_NUM;?>:</label>
												<input type="text" name="cnic<?=($lCount-1)?>" placeholder="<?php echo ID_CARD_NUM;?>"  value="<?=$csv_line[3]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" maxlength="50" title="<?php echo ID_CARD_NUM;?>">
												 <span class="validate_cnic<?=$c?>"></span></div></div>
											
												
												<div class="col-md-4">
                                                <div class="form-group">
												<label>Date of birth:</label>
												<input type="text" name="dob<?=($lCount-1)?>" id="dob<?=$c?>" placeholder="Date of birth (YYYY-MM-DD)"  value="<?=$csv_line[4]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?> date datetimepicker-month" required  title="Type Date of birth (YYYY-MM-DD)" ></div></div>
												<div class="col-md-4">
                                                <div class="form-group">
												<label><?php echo CLIENT_REF_NUM;?>.</label>
												<input type="text" name="empcode<?=($lCount-1)?>" placeholder="<?php echo CLIENT_REF_NUM;?>"   value="<?=$csv_line[5]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required maxlength="20"></div></div>
												
												<div class="col-md-4">
                                                <div class="form-group">
												<label>Address:</label>
												<input type="text" name="address<?=($lCount-1)?>" placeholder="Address"   value="<?=$csv_line[6]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required maxlength="20"></div></div>
												
                                                <div class="col-md-4">
                                                <div class="form-group">
												<label>Country</label>
												 
                                                <select name="country<?=($lCount-1)?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required  >
                                
                                <?php 
                                $countries = $db->select("country","country_id,printable_name");
                                while($country = mysql_fetch_assoc($countries)){ ?>
                                    <option value="<?=$country['country_id']?>" <?=($country['country_id']==171)?'selected="selected"':''?> >
                                    <?=$country['printable_name']?>
                                    </option>
                                <?php } ?>
                                                              
                                                 </select>
                                                
                                                
                                                </div></div>
												
												
												
											
                                            
                                    </div><!--12-->
										<?php if(in_array(1,$allchecks)){?>
                                        <div class="col-md-6">
                                                
												<h4>Education Details</h4>
												<div class="col-md-6">
                                                <div class="form-group">
												<label>University Name:</label>
												<input type="text" name="uni_name<?=($lCount-1)?>" placeholder="University Name"  value="<?=$csv_line[7]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required>
                                                </div></div>
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Registration Number:</label>
												<input type="text" name="reg_num<?=($lCount-1)?>" placeholder="Registration Number"  value="<?=$csv_line[8]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required>
                                                </div></div>
												
												
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Degree Title:</label>
												<input type="text" name="degree<?=($lCount-1)?>" placeholder="Degree Title"  value="<?=$csv_line[9]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required title="Type Qualification e.g: BSC,MSC,BCS">
                                                </div></div>
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Remarks:</label>
												<input type="text" name="remarks<?=($lCount-1)?>" placeholder="Remarks"  value="<?=$csv_line[10]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required title="Type Remarks e.g: Passed,Fail">
                                                
                                                </div></div>
												
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Passing Year:</label>
												<input type="text" name="pass_year<?=($lCount-1)?>" placeholder="Passing Year"  value="<?=$csv_line[11]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required title="">
                                                </div></div>
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Serial # / Seat # / Roll #</label>
												<input type="text" name="serial_no<?=($lCount-1)?>" placeholder="Serial No"  value="<?=$csv_line[12]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required title="">
                                                </div></div>
												
                                        
                                        </div>
										
											<?php } if(in_array(2,$allchecks)){?>
												<div class="col-md-6">
                                                
												
                                                <h4>Previous Employment Details</h4>
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Company Name:</label>
												<input type="text" name="company_name<?=($lCount-1)?>" placeholder="Company Name"  value="<?=$csv_line[13]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required>
                                                </div></div>
                                                
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Date of Joining:</label>
												<input type="text" name="date_of_join<?=($lCount-1)?>" id="date_of_join<?=$c?>" placeholder="Date of Joining (YYYY-MM-DD)"  value="<?=$csv_line[14]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?> date datetimepicker-month" required  title="Type Date of Joining (YYYY-MM-DD)">
                                                </div></div>
												<!--]-->
												
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Employement Status:</label>
												<input type="text" name="emp_status<?=($lCount-1)?>" placeholder="Employement Status"  value="<?=$csv_line[15]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required>
                                                </div></div>
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Last Working Day:</label>
												<input type="text" name="last_work_day<?=($lCount-1)?>" placeholder="Last Working Day"  value="<?=$csv_line[16]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required>
                                                </div></div>
												
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Last Designation:</label>
												<input type="text" name="last_designation<?=($lCount-1)?>" placeholder="Last Designation"  value="<?=$csv_line[17]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required>
                                                </div></div>
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Last Place of Posting:</label>
												<input type="text" name="last_place_posted<?=($lCount-1)?>" placeholder="Last Place of Posting"  value="<?=$csv_line[18]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required>
                                                </div></div>
												<div class="col-md-6">
                                                <div class="form-group">
												<label>Last Drawn Salary:</label>
												<input type="text" name="last_drawn_salary<?=($lCount-1)?>" placeholder="Last Drawn Salary"  value="<?=$csv_line[19]?>" class="blnk form-control clss_hide_remov<?=($lCount-1)?>" required>
                                                </div></div>
												
												
												
                                                </div>
												<?php } ?>
											
										<div class="col-md-12 bar-prog">
                          
                            <p class="text-muted float-right ml-5"  > <a class="text-grey"  href="#" title="Allowed file types:(<?php echo FILE_TYPES_ALLOWED;?>)	Max file size (<?php echo FILE_SIZE_ALLOWED;?>)" data-popup="tooltip" data-trigger="hover" data-container="body" data-placement="left"><i class="icon-info22"></i></a> </p>
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
											
				if($lCount-1 > 9 ){
					
				$lCount = 1;
				
				
				}
				}
			}// end while
			?>
			<div class="clearFix"></div>
			<div class="col-md-12" style="position: absolute;bottom: -5px;right: 0;"><fieldset class="text-right">
                  <button type="submit" class="btn bg-success-600 btn-lg check_cnic" name="submit_bulk" ><i class="icon-add-to-list position-left"></i> Submit Checks</button>
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
                  <li role="presentation"> <a role="menuitem" tabindex="-1" href="#" data-number="10" data-default="true">10 per page</a> </li>
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

							<?php /* <h6>Import</h6>
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
							</fieldset> */?>

							
						</div>
          
          
          
          
       
        
          
          <div class="clearFix"></div>
		  <div  class="error_box"></div>
        </div>
        <div class="clearFix"></div>
      </div>
    </div>
  </div>
</section>
<?php include("include_pages/bulkupload_scripts.php")?>





