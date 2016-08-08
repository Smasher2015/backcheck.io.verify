<?php 	if(is_numeric($_REQUEST['case'])){ 
?>
<link rel="stylesheet" href="css/jquery.fileupload.css">

<script src="js/rate.js"></script>
<script>

	var checks = [];
	var ccount = [];
	
	$(function() { 
	// on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    $('ul.my-new-deatil-tab li a[href="' + hash + '"]').tab('show');
		});
	
</script>
<style type="text/css">
.checksSec {
	padding: 0 5px;
}
.checksSec span {
	padding-top: 8px;
	display: inline-block;
}
.checksSec:hover {
	background: #E6ECEF;
	cursor: pointer;
}
.searchEle .status {
	float: right;
	height: 22px;
}
.searchEle .pointer {
	cursor: pointer;
}
.bigimgs .imBg {
	width: 40px;
	height: 40px;
}
.rating-checks {
	width: auto;
	border-spacing: initial;
	margin: 0;
	word-break: break-word;
	table-layout: auto;
	line-height: 1.8em;
	color: #333;
	float: none;
	text-align: inherit;
	position: relative;
}
.rating-checks ul li {
	width: auto;
	padding: 0;
	list-style: inherit;
	border-bottom: none;
	color: #999999;
}
</style>
<?php $data = getVerdata($_REQUEST['case']);
function getactivityoflead($leadid){
$ch = curl_init();
 $query_string="action=get_activity&leadid=".urlencode($leadid);
    curl_setopt($ch, CURLOPT_URL,BITRIX_URL);
    // Set a referer
   curl_setopt($ch, CURLOPT_HEADER, FALSE);
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
    // Download the given URL, and return output
    $output = curl_exec($ch);
	curl_close($ch);
	//print_r($output);
	return json_decode($output);
}
	$leadid=$data['bitrixlid'];
	$leadac_arry=getactivityoflead($leadid);
?>


<div class="report-sec">
 <div class="page-header">
  	<div class="page-header-content">
          <div class="page-title3">
            <h2><?php include('include_pages/pages_breadcrumb_inc.php'); ?></h2>
          </div>
  	</div>
  </div>
  
  <div class="panel panel-flat">
  	<div class="panel-body case_profile">
    	<div class="row">
        <div class="col-md-12">
        	<div class="col-md-2">
            	<div class="thumb thumb-rounded thumb-slide">
					<img src="<?php echo SURL; ?>images/avtr_case.png" alt="">	
				</div>
                <div class="label bg-primary heading-text text-semibold" style="width: 130px;font-size: 11px;margin-top: 5px;"><?=$data['v_rlevel']?>
                [
                <?=(strtolower($data['v_status'])!='close')?'In Progress':'Completed'?>
                ]</div>
            </div>
            <div class="col-md-10">
            	<h2><?=$data['v_name']?></h2>
                <div class="col-md-12">
                	<div class="col-md-4">
                    	<ul>
                        <?php
                                $tcheck = $db->select('ver_checks','*',"v_id=$_REQUEST[case]");
                                $tcheck = mysql_fetch_assoc($tcheck);
                                $cominfo = getcompany($data['com_id']);
                                $cominfo = mysql_fetch_assoc($cominfo);
                                $mngr = getUserInfo($data['v_mngr']);
                            ?>
                            
                            <li><span>Tracking # :</span> <?=bcplcode($data['v_id'])?></li>
                            <li><span>ID # :</span> <?=$data['emp_id']?></li>
                             <?php  if($cominfo['id']==37){?>
                            <li><span>Reference ID # :</span> <?=$data['v_refid']?></li>
           					 <?php } ?>
                            <li><span>NIC Number :</span> <?=$data['v_nic']?></li>
                        </ul>
                    
                    </div>
                    
                    <div class="col-md-4">
                    <ul>
                            <li><span>Bar Code :</span> <?=$data['v_bcode']?></li>
                            <li><span>Client name :</span> <?=$cominfo['name']?></li>
                            <li><span>Order Date :</span> <?=date("j-F-Y",strtotime($data['v_date']))?></li>
                        </ul>
                    </div>
                <div class="col-md-4">
                	<h6 class="no-margin" style="padding-bottom:5px">Case Document</h6>
                    <ul>
                    	<?php 
			  // case attachments
				$CaseAttachWhere = "case_id=".$_REQUEST['case']." AND checks_id IS NULL ";
										//echo $AttachWhere;
										$CaseAttachments = getAttachments($CaseAttachWhere);
				if($CaseAttachments){ 
				$cc=0;
				while($attach = mysql_fetch_assoc($CaseAttachments) ){
					$cc++;
											if($attach['att_file_path']){
												?>
                        <li><h6 class="text-semibold no-margin text-primary"><a href="#" class="text-primary" onclick="downloadAttachedFile('<?php echo basename($attach['att_file_path']);?>');"><i class=" icon-image2 position-left text-slate"></i> <?php echo '<strong>'.$cc.'.</strong> '.$attach['att_file_name'];?> <span class="label bg-success pull-right text-semibold">Download</span></a></h6></li>
                         <?php }
											}	 }else{?>
                           <li>No attachment added.</li>
              			<?php } ?>        
                    </ul>
                
                </div>
                
                </div>
                
            </div>
            
        </div>
        </div>
    </div>
  </div>
  
  <div class="panel panel-flat">
									

									<div class="panel-body">
										<?php if($_REQUEST['added']==1){?>
  <div class="cust_style">
    <div class="alert alert-dismissable alert-success fade in ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button>
      <span class="title"><i class="icon-check-sign"></i> SUCCESS</span> New checks added successfully. </div>
  </div>
  <?php }?>
  <?php if($_REQUEST['att_added']==1){?>
  <div class="cust_style">
    <div class="alert alert-dismissable alert-success fade in ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button>
      <span class="title"><i class="icon-check-sign"></i> SUCCESS</span> Attachment added successfully. </div>
  </div>
  <?php }?>
  
  
  <div class="row">
  <div class="col-md-12">
    <div class="col-md-3">
      <div class="preface case-sec case-sec2">
        <div class="">
          <?php 
		  			
						
						if($LEVEL==3) $eCl="user_id=$_SESSION[user_id]"; else $eCl="";
						$check_tab= checkDetails($data['v_id'],'',$eCl);
						$checkv_id = $data['v_id'];
						$check_count =  countChecks("vc.v_id = $checkv_id");

					?>
          <?php /*?><h5>
            <span class="label count-check label-new"><?php echo ($check_count > 1) ? $check_count : ''; ?></span>
          </h5><?php */?>
        </div>
        
          <!--<h3 class="section-title preface-title">Check Detail</h3>-->
          <ul class="my-new-deatil-tab d-case-tab list-group ">
            <li class="active"><a href="#overview" data-toggle="tab">Over View </a></li>
            <li><a href="#tested" data-toggle="tab">Activity Stream</a></li>
            <?php 
                                
								$index = 0;
								$cont = mysql_num_rows($check_tab);
								$product_ids = array();
								$approved_checks = array();
                                while($check = mysql_fetch_assoc($check_tab)){
									$product_ids[] = $check['checks_id'];
									$approved_checks[] = $check['as_qastatus'];
									$index ++;
									$cindex = ($cont>1)?'-'.$index : ''; 
									
									?>
            <li> <a href="#check_tab_<?=$check['as_id']?>" data-toggle="tab"><?php echo $check['checks_title']; echo $cindex;?></a> </li>
            <?php 
									
								}
								//$product_ids =sort($product_ids);
								//print_r($product_ids);
								$productID = array(9,39,40,41);
								$result = array_intersect($product_ids, $productID);
								$count_arr_product = count($result);
								//echo 'Count == ' . $count_arr_product;
								//print_r($result);
								if($LEVEL!=5){?>
            <li class="add_check_btn"><a href="#addmorechcks_area" data-toggle="tab"><i class="icon-plus"></i> Add More Checks</a></li>
			
								<?php } if($count_arr_product == 4){ 
							   if(count($approved_checks)==4){?>
            <li  ><a href="#cic_report_tab" data-toggle="tab"> Criminal Intelligence Check </a></li>
            <?php }
							   }?>
          </ul>
       
      </div>
    </div>
    
    <div class="col-md-6">
      <div class="tab-content case-sec2">
        <div class="">
          <h5>Case Detail</h5>
        </div>
        
        <!--<h3 class="section-title preface-title">Applicant Detail</h3>-->
        <div class="case-data-sec tab-pane active" id="overview">
          <ul>
            <li>
              <div class="left-data-sec">Applicant Name :</div>
              <div class="right-data-sec">
                <?=$data['v_name']?>
              </div>
              <div class="clearFix"></div>
            </li>
            <?php
                                $tcheck = $db->select('ver_checks','*',"v_id=$_REQUEST[case]");
                                $tcheck = mysql_fetch_assoc($tcheck);
                                $cominfo = getcompany($data['com_id']);
                                $cominfo = mysql_fetch_assoc($cominfo);
                                $mngr = getUserInfo($data['v_mngr']);
                            ?>
            <li>
              <div class="left-data-sec">Tracking # :</div>
              <div class="right-data-sec">
                <?=bcplcode($data['v_id'])?>
              </div>
              <div class="clearFix"></div>
            </li>
            <li>
              <div class="left-data-sec">ID # :</div>
              <div class="right-data-sec">
                <?=$data['emp_id']?>
              </div>
              <div class="clearFix"></div>
            </li>
            <?php  if($cominfo['id']==37){?>
            <li>
              <div class="left-data-sec">Reference ID # :</div>
              <div class="right-data-sec">
                <?=$data['v_refid']?>
              </div>
              <div class="clearFix"></div>
            </li>
            <?php } ?>
            <li>
              <div class="left-data-sec">NIC Number :</div>
              <div class="right-data-sec">
                <?=$data['v_nic']?>
              </div>
              <div class="clearFix"></div>
            </li>
            <li>
              <div class="left-data-sec">BCD :</div>
              <div class="right-data-sec">
                <?=$data['v_bcode']?>
              </div>
              <div class="clearFix"></div>
            </li>
            <li>
              <div class="left-data-sec">Client name :</div>
              <div class="right-data-sec">
                <?=$cominfo['name']?>
              </div>
              <div class="clearFix"></div>
            </li>
            <li>
              <div class="left-data-sec">Order Date :</div>
              <div class="right-data-sec">
                <?=date("j-F-Y",strtotime($data['v_date']))?>
              </div>
              <div class="clearFix"></div>
            </li>
            <li>
              <div class="left-data-sec"><?php echo ($LEVEL==4?APPLICANT:'Case');?> Status :</div>
              <div class="right-data-sec">
                <?=$data['v_rlevel']?>
                [
                <?=(strtolower($data['v_status'])!='close')?'In Progress':'Completed'?>
                ] </div>
              <div class="clearFix"></div>
            </li>
			
			
			<?php if($LEVEL!=4) {?>
			
			 <li>
              <div class="left-data-sec">Case Ducuments :</div>
              <div class="right-data-sec">&nbsp;</div>
              <div class="clearFix"></div>
            </li>
			<li>
			
			<div class="progress-bar-parent mainDivchecks" >
			<ul>
              <?php 
			  // case attachments
				$CaseAttachWhere = "case_id=".$_REQUEST['case']." AND checks_id IS NULL ";
										//echo $AttachWhere;
										$CaseAttachments = getAttachments($CaseAttachWhere);
				if($CaseAttachments){ 
				$cc=0;
				while($attach = mysql_fetch_assoc($CaseAttachments) ){
					$cc++;
											if($attach['att_file_path']){
												?>
              <li>
                <div class="left-data-sec"><?php echo '<strong>'.$cc.'.</strong> '.$attach['att_file_name'];?> : </div>
                <div class="right-data-sec">
                  <a class="ctooltips" href="javascript:;" data-placement="top"><button type="button" class="btn btn-success btn-labeled pull-right" title=""     onclick="downloadAttachedFile('<?php echo basename($attach['att_file_path']);?>');"><b><i class="icon-cloud-download"></i></b> Download </button><span>Download Attachment</span></a>
                </div>
                <div class="clearFix"></div>
              </li>
              <?php }
											}	 }else{?>
              <li>
                <div class="left-data-sec">No attachment added.</div>
                <div class="clearFix"></div>
              </li>
              <?php } ?>
			  </ul>
            </div>
			
			</li>
			<?php } ?>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
          </ul>
        </div>
        <div class="case-data-sec tab-pane" id="tested">
        	                               
  <div class="content custom_time_me">
  	<div class="panel-body">
    	
    	<div class="timeline timeline-center content-group">
						<div class="timeline-container">

							<!-- Sales stats -->
							<div class="timeline-row post-full">
								<div class="timeline-icon">
									<div class="bg-info-400">
                                   		<i class="icon-stack"></i>
                                    </div>
								</div>

							</div>
							<!-- /sales stats -->


							<!-- Blog post -->
                            <?php
							$i=0;
							if(is_array($leadac_arry)){
								foreach($leadac_arry as $info){
									if($info->type_act==2){
										$type="Call Conducted ";$icon="icon-phone";  $class="bg-teal-400";
									}else{$type="Email Send  ";$icon="icon-envelop3";$class="bg-danger-400";}
							?>
							<div class="timeline-row <?=($i % 2 === 0?"":'post-even')?>">
								<div class="timeline-icon">
									<div class="<?=$class?>">
										<i class="<?=$icon?>"></i>
									</div>
								</div>

								<div class="timeline-time">
									
									<span class="text-muted"><?=dateTimeExe($info->date)?></span>
								</div>
								<div class="panel panel-flat timeline-content">
                                 <?php if($LEVEL != 4 ){?>
									<div class="panel-heading">
										<h6 class="panel-title"><?=$type." : ".$info->subject?></h6>
											
									</div>
                                    <div class="panel-body">
										

										

										<blockquote>
											<p><?=$info->desc?></p>
											<footer><cite title="Source Title"><?=date("H:i:s",strtotime($info->date))?></cite></footer>
										</blockquote>
									</div>
                                    <?php }else{ ?>
                                    <div class="panel-heading">
										<h6 class="panel-title"><?=$type?></h6>
											
									</div>
                                    <div class="panel-body">
										

										

										<blockquote>
											<footer><cite title="Source Title"><?=date("H:i:s",strtotime($info->date))?></cite></footer>
										</blockquote>
									</div>
                                    <?php }?>

									

									
								</div>
							</div>
							<!-- /blog post -->
							<?php $i++; } } ?>

 

								
							</div>
							<!-- /task -->


							


							<!-- Weekly stats -->
							
							<!-- /weekly stats -->


							<!-- Invoices -->
							
							<!-- /invoices -->


							
						</div>
				    </div>
                    
                    
   </div>
   
        </div>
        <div class="case-data-sec tab-pane" id="addmorechcks_area">
          <form enctype="multipart/form-data" id="addCheckFrm" method="post" data-parsley-namespace="data-parsley-" data-parsley-validate="" >
            <?php // echo get_client_orderchecks($data['com_id']);?>
            <?php 
								$where = "cc.com_id=".$data['com_id']." AND ck.is_active=1";
								$tabls = "checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id";
								$checks = $db->select($tabls,"*",$where);
								if(mysql_num_rows($checks)>0){
									$num_check = 100;
                    				while($check = mysql_fetch_assoc($checks)){?>
            <div class="progress-bar-parent mainDivchecks">
              <h4 class="section-title">
               <input style="float:left;" type="checkbox" name="ischeck1[]" data-parsley-required="true" data-parsley-error-message="You must select at least one check" class="parsley-validated parsley-error styled" value="<?=$check['checks_id']?>_1" id="<?=$num_check?>"  /> 
               <?=$check['checks_title']?>
                <?php if(!empty($check['checks_tooltip'])){ ?>
                <a class="ctooltips" href="#"><i class="icon-info-sign"></i><span>
                <?=$check['checks_tooltip']?>
                </span></a>
                <?php }?>
                <?php if($check['is_multi']==1){?>
                <a href="javascript:void(0);" onclick="addmorecheck(this,<?=$check['checks_id']?>,1,'<?=addslashes($check['checks_title'])?>')"><i class="icon-plus22 text-success"></i></a>
                <?php }?>
                
              </h4>
              <div>
                <div>
                  <p class="text-muted " style="float:right;"> <a class="ctooltips" href="#"><i class="icon-info-sign"></i><span>Allowed file types:<br />
                    (<?php echo FILE_TYPES_ALLOWED;?>)<br />
                    Max file size:<br />
                    (<?php echo FILE_SIZE_ALLOWED;?>)</span></a> </p>
                  <div id="dprogress1<?=$num_check?><?=$num_check?>" class="progress bulk-upload-prgs" style="width:70%">
                    <div class="progress-bar progress-bar-success"></div>
                  </div>
                  <span style="float:right;" class="btn btn-primary btn-file"><span class="fileinput-new">Select file</span>
                  <input type="hidden" value="<?=$check['checks_id']?>_1" name="checks1[]"  />
                  <input type="file" name="files[]" id="docs1<?=$num_check?><?=$check['checks_id']?>" multiple class="docs_files" data-id="<?=$num_check?>" data-check="<?=$check['checks_id']?>" data-count="1" data-ccounter="_1" data-attchid="<?=$num_check?>" />
                  </span> </div>
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
            <footer class="panel-footer text-right">
              <input type="hidden" name="addmore" value="1" >
              <input type="hidden" name="case_id" value="<?php echo  $_REQUEST['case'];?>" >
              <button type="submit" class=" btnright div_icon has_text btn btn-success" name="submit_bulk" >
              <input type="hidden"  id="attachment_counter" name="attachment_counter" value="0"  />
              <span> &nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp; </span>
              </button>
            </footer>
          </form>
        </div>
        <?php if($count_arr_product == 4){ ?>
        <div class="case-data-sec tab-pane" id="cic_report_tab">
          <ul>
            <li>
              <div class="left-data-sec">Criminal Intelligence Check :</div>
              <div class="right-data-sec">
                <?php
                                    $pdfClick = "downloadPDF('pdf.php?pg=case&case=$checkv_id&rp_cic=1')";
                                    /* $tWhr = "a_type='pdf' AND user_id=$USERID AND ext_id=$check[as_id]";
									echo $tWhr;
                                    $acPdf = $db->select("activity","COUNT(a_type) cnt",$tWhr);
                                    if(mysql_num_rows($acPdf)>0){
                                    $acPdf = mysql_fetch_array($acPdf);
                                    $PdfIcon="pdf_icn.png"; 
									}else $PdfIcon="PDF_download_icn.png"; */
                                    ?>
                <button type="button" class="btn btn-success" onclick="<?=$pdfClick?>"><i class="icon-cloud-download"></i> Download Report</button>
              </div>
              <div class="clearFix"></div>
            </li>
          </ul>
        </div>
        <?php }?>
        
        <!--<div class="tab-content panel panel-default panel-block">
                        <div class="tab-pane list-group active" id="tabsdemo-home">
                            <div class="list-group-item">
                                <h4 class="section-title">Tabs</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, numquam, fuga, at, laudantium nihil nulla deleniti minus animi nisi quidem incidunt praesentium dignissimos reiciendis atque repellat dicta suscipit in voluptate eveniet provident asperiores culpa temporibus cumque placeat vero. Error, cupiditate, accusantium.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, illo quo aspernatur quis provident libero ratione voluptatem cupiditate veniam error saepe quas aperiam sequi magni mollitia obcaecati iusto repudiandae quae aliquid laborum dicta similique voluptatum explicabo maiores natus. Dolor, repellendus, illum architecto iste nulla quo alias repellat vitae consectetur voluptatibus necessitatibus temporibus incidunt sint.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, illo quo aspernatur quis provident libero ratione voluptatem cupiditate veniam error saepe quas aperiam sequi magni mollitia obcaecati iusto repudiandae quae aliquid laborum dicta similique voluptatum explicabo maiores natus. Dolor, repellendus, illum architecto iste nulla quo alias repellat vitae consectetur voluptatibus necessitatibus temporibus incidunt sint.
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane list-group" id="tabsdemo-profile">
                            <div class="list-group-item form-horizontal">
                                <h4 class="section-title preface-title">Profile</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, illo quo aspernatur quis provident libero ratione voluptatem cupiditate veniam error saepe quas aperiam sequi magni mollitia obcaecati iusto repudiandae quae aliquid laborum dicta similique voluptatum explicabo maiores natus. Dolor, repellendus, illum architecto iste nulla quo alias repellat vitae consectetur voluptatibus necessitatibus temporibus incidunt sint.
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane list-group" id="tabsdemo-messages">
                            <div class="list-group-item">
                                <h4 class="section-title preface-title">Messages</h4>
                                <p>
                                    Lorem aperiam sequi magni mollitia obcaecati iusto repudiandae quae aliquid laborum dicta similique voluptatum explicabo maiores natus. Dolor, repellendus, illum architecto iste nulla quo alias repellat vitae consectetur voluptatibus necessitatibus temporibus incidunt sint.
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane list-group" id="tabsdemo-settings">
                            <div class="list-group-item">
                                <h4 class="section-title preface-title">Settings</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, dolor, aliquid libero cumque enim voluptates deleniti esse iusto aperiam minus molestiae reiciendis nihil modi vel vero at sapiente quisquam repellendus officia facere blanditiis iure placeat tempore rerum ut eum quasi illo harum sunt sed quos perspiciatis vitae natus eligendi earum iste quaerat saepe autem cum et sint amet! Odio, unde, quo, sapiente similique deserunt voluptates sit earum quisquam impedit totam voluptas in tempora.
                                </p>
                            </div>
                        </div>
                    </div>-->
        <?php
                                if($LEVEL==3) $eCl="user_id=$_SESSION[user_id]"; else $eCl="";
                                $checks = checkDetails($data['v_id'],'',$eCl);
								$index_tab = 0;
                                while($check = mysql_fetch_assoc($checks)){
									$CheckID 	= $check['as_id'];
									$CaseID 	= $check['v_id'];
									$rptLink = "showAuto('report','$check[checks_title]','ascase=$check[as_id]',20)";
									$startCs=($LEVEL==4)?"javascript:void(0)":"?action=start&ascase=$check[as_id]&_pid=$_REQUEST[_pid]";
									?>
        <div class="tab-pane list-group case-data-sec sec-free-space " id="check_tab_<?=$check['as_id']?>">
          <ul>
            <?php /*?><strong><?=$check['checks_title']?></strong><?php */?>
            <li>
              <div class="left-data-sec">Check Title :</div>
              <div class="right-data-sec">
                <?=$check['checks_title']?>
              </div>
              <div class="clearFix"></div>
            </li>
            <?php if(is_numeric($check['user_id']) && $check['user_id']!=0){
										$userInfo = getUserInfo($check['user_id']);
										$analyst=" $userInfo[first_name]   $userInfo[last_name]";
										}else $analyst="Not Assigned"; ?>
            <li>
              <div class="left-data-sec">Analyst  :</div>
              <div class="right-data-sec"><?php echo $analyst;?></div>
              <div class="clearFix"></div>
            </li>
            <?php  if($LEVEL == 4){?>
            <li>
              <div class="left-data-sec">Is problem in check? </div>
              <div class="right-data-sec"><a href="<?php echo SURL.'?action=adsupport&atype=support&as_id='.$CheckID; ?>">Submit your query</a></div>
              <div class="clearFix"></div>
            </li>
            <?php }?>
            <li>
              <div class="left-data-sec">Status :</div>
              <div class="right-data-sec">
                <?php 
															if($check['as_qastatus'] == 'Rejected' ||  $check['as_qastatus'] =='QA'){
																echo 'QC [In Progress]';
															}else{
																echo $check['as_vstatus'] . '[ '. $check['as_status'].' ]';
                                                            }?>
              </div>
              <div class="clearFix"></div>
            </li>
            <?php  if($LEVEL == 4 && $check['as_qastatus'] == 'Approved' && $check['as_status']=='Close'){?>
            <li>
              <div class="left-data-sec">Rating :</div>
              <div class="right-data-sec">
                <div class="rating-div rating-checks">
                  <div id="rating-<?php echo $check['as_id']; ?>">
                    <input type="hidden" name="rating" id="rating" value="<?php echo $check["as_rating"]; ?>" />
                    <ul onMouseOut="resetRating(<?php echo $check['as_id']; ?>);">
                      <?php
                        for($i=1;$i<=5;$i++) {
                        $selected = "";
							if(!empty($check["as_rating"]) && $i<=$check["as_rating"]) {
							$selected = "selected";
							}
                        ?>
                      <li class='<?php echo $selected; ?>' onmouseover="highlightStar(this,<?php echo $check['as_id']; ?>);" onmouseout="removeHighlight(<?php echo $check['as_id']; ?>);" onClick="addRatingOnChecks(this,<?php echo $check['as_id']; ?>);">&#9733;</li>
                      <?php }  ?>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="clearFix"></div>
            </li>
            <?php  } ?>
            <?php if((strtolower($check['as_status'])=='close') && ($check['as_sent']==4 && (strtolower($check['as_qastatus'])=='approved') || $LEVEL==2)) { ?>
            <li>
              <div class="left-data-sec">Download Report :</div>
              <?php
                                                        $pdfClick = "downloadPDF('pdf.php?pg=case&ascase=$check[as_id]')";
														$pdfClickFullCase = "downloadPDF('pdf.php?pg=case&case=$_REQUEST[case]')";
                                                        /* $tWhr = "a_type='pdf' AND user_id=$USERID AND ext_id=$check[as_id]";
                                                        $acPdf = $db->select("activity","COUNT(a_type) cnt",$tWhr);
                                                        
                                                       if(mysql_num_rows($acPdf)>0){
														$acPdf = mysql_fetch_array($acPdf);
														$PdfIcon="pdf_icn.png"; 
														}else $PdfIcon="PDF_download_icn.png"; */
														?>
													  
														
              <a class="ctooltips" href="javascript:;"><button type="button"   class="btn btn-success" title=""      onclick="<?=$pdfClick?>"><i class="icon-cloud-download"></i> Check Report</button><span>Download Single Check Report </span></a>
			  &nbsp;&nbsp;&nbsp;
			  
			  <a class="ctooltips" href="javascript:;"><button type="button" class="btn btn-success"   title=""  onclick="<?=$pdfClickFullCase?>"><i class="icon-cloud-download"></i> Full Report</button><span>Download Full Case Report </span></a>
			  
			    <div class="clearFix"></div>
				
				
				
            
            </li>
            <?php } ?>
            <?php if ($LEVEL==2 || $LEVEL==3) { 
										 	//if($check['as_vstatus'] != 'Not Initiated'){
											if(strtolower($check['as_status'])=='close'){
										 
										 	 switch($check['as_qastatus']){
												 	case  "Approved":
													$color = '#8DC655';
													break;
													case  "Rejected":
													$color = '#e8511a';
													break;
													case  "QA":
													$color = '#00b9f7';
													break;

												}
										 ?>
            <div class="page-section-title">
              <h5 class="box_head"> QA </h5>
              <div class="clearFix"></div>
            </div>
            <li>
              <div class="left-data-sec">QA Level :</div>
              <div class="right-data-sec"><span class="detail-report-check-status green-risk-sts" style="background-color:<?php echo $color; ?>">
                <?=$check['as_qastatus']?>
                </span></div>
              <div class="clearFix"></div>
            </li>
            <li> 
              <!--<div class="left-data-sec">Check Status</div>-->
              
              <?php $user_analyst =  $check['user_id']; ?>
              <?php if($LEVEL == 3 ){?>
              <form  method="post">
                <input type="hidden" name="chck_qa" value="QA"  />
                <input type="hidden" name="as_id" value="<?=$CheckID?>"  />
                <input type="hidden" name="analyst_id" value="<?=$user_analyst?>"  />
                <div class="form-group">
                  <label for="basic-text-area">Analyst Comments</label>
                  <div>
                    <textarea id="basic-text-area" rows="2" name="qa_comments"  class="form-control"></textarea>
                  </div>
                </div>
                <button type="submit" class="btn btn-success"  name="check_sumb_qa"><i class="icon-ok"></i> Enter</button>
              </form>
              <?php }?>
              <?php if($LEVEL == 2 &&  $check['as_qastatus'] != 'Work In Progress' ){?>
              <form  method="post">
                <input type="hidden" name="chck_app" value="Approved"  />
                <input type="hidden" name="as_id" value="<?=$CheckID?>"  />
                <input type="hidden" name="analyst_id" value="<?=$user_analyst?>"  />
                <div class="form-group">
                  <label for="basic-text-area">QA Comments</label>
                  <div>
                    <textarea id="basic-text-area" rows="2" name="app_comments"  class="form-control"></textarea>
                  </div>
                </div>
                <button type="submit" class="btn btn-success"  name="check_approve"><i class="icon-ok"></i> Approve</button>
              </form>
              <form  method="post">
                <input type="hidden" name="chck_rej" value="Rejected"  />
                <input type="hidden" name="as_id" value="<?=$CheckID?>"  />
                <input type="hidden" name="analyst_id" value="<?=$user_analyst?>"  />
                <div class="form-group">
                  <label for="basic-text-area">QA Comments (Why you're going to Reject)</label>
                  <div>
                    <textarea id="basic-text-area" rows="2" name="rej_comments"  class="form-control"></textarea>
                  </div>
                </div>
                <button type="submit" class="btn btn-danger" name="check_reject"><i class="icon-remove"></i> Reject</button>
              </form>
              <div class="clearFix"></div>
              <?php }?>
              <div style="margin-top:10px;">
                <?php 
													   	$whr = "_id = $CheckID and com_type='qa' ORDER BY com_id DESC";
													   	$qa_comments = $db->select("comments","*",$whr); 
														$qa_data = mysql_num_rows($qa_comments);
														if(count($qa_data)>0){
																
																while($qrow = mysql_fetch_assoc($qa_comments)){
																	$CommmentUInfo = getUserInfo($qrow['user_id']);
																	?>
                <div class="comment-data-sec">
                  <div class="comment-left-data-sec"> <img src="<?=$CommmentUInfo['uimg']?>" title="<?="$ComUInfo[first_name] $ComUInfo[last_name]"?>"> </div>
                  <div class="comment-right-data-sec"> <strong><?php echo $qrow['com_title']; ?></strong>
                    <p><?php echo $qrow['com_text']; ?></p>
                    <span><?php echo ($qrow['user_id'] != 0) ? 'Posted by '.  trim($CommmentUInfo['first_name'].' '.$CommmentUInfo['last_name']) : '';?> <?php echo time_ago(strtotime($qrow['com_date'])); ?></span> </div>
                  <div class="clearFix"></div>
                </div>
                <div class="clearFix"></div>
                <?php }
														}
														?>
              </div>
            </li>
            <?php } ?>
            <?php }?>
            <?php   
								  		// For Manager Remarks
			if($LEVEL==2 && ($check['as_adcls']==0 && strtolower($check['as_status'])=='close')  && $check['as_qastatus']=='Approved'){ ?>
            <div class="list-group">
              <div class="page-section-title">
                <h5> Manager Remarks </h5>
              </div>
            
              <div class="clearFix"></div>
            </div>
            <div class="panel panel-block">
              <div class="list-group-item">
                <div class="toggle_container">
                  <div class="block">
                    <form action="" method="post" enctype="multipart/form-data">
                      <fieldset class="label_side">
                        <label>Case Status :<span>Please select case status</span></label>
                        <div>
                          <select class="input req" name="vStatus" >
                            <option value="">--Select Verification Status--</option>
                            <option value="Verified" <?php echo ($vmSts=='verified')?'selected="selected"':''; ?> >Verified</option>
                            <option value="Negative" <?php echo ($vmSts=='negative')?'selected="selected"':''; ?> >Negative</option>
                            <option value="Discrepancy" <?php echo ($vmSts=='discrepancy')?'selected="selected"':''; ?>>Discrepancy</option>
                            <!-- <option value="Unable to Verify" <?php //echo ($vmSts=='unable to verify')?'selected="selected"':''; ?>>Unable to Verify</option>-->
                            <option value="Not Verified By Source" <?php echo ($vmSts=='not Verified By Source')?'selected="selected"':''; ?>>Not Verified By Source</option>
                            <option value="Addition Information Not Provided By Client" <?php echo ($vmSts=='addition Information Not Provided By Client')?'selected="selected"':''; ?>>Addition Information Not Provided By Client</option>
                            <option value="Partially Verified" <?php echo ($vmSts=='partially Verified')?'selected="selected"':''; ?>>Partially Verified</option>
                            <option value="Objection by Source" <?php echo ($vmSts=='objection by Source')?'selected="selected"':''; ?>>Objection by Source</option>
                            <option value="Processed But Cancelled By Client" <?php echo ($vmSts=='processed But Cancelled By Client')?'selected="selected"':''; ?>>Processed But Cancelled By Client</option>
                           <?php /* <option value="Insufficient" <?php echo ($vmSts=='insufficient')?'selected="selected"':''; ?>>Insufficient</option> */ ?>
                            <option value="original required" <?php echo ($vmSts=='original required')?'selected="selected"':''; ?>>Original Required</option>
                          </select>
                        </div>
                      </fieldset>
                      <fieldset class="label_side">
                        <br />
                        <label>Remark :<span>Please type Remarks for
                          <?=$verCheck['checks_title']?>
                          </span></label>
                        <br />
                        <div>
                          <textarea class="input form-control" rows="5" name="remarks"></textarea>
                        </div>
                      </fieldset>
                      <div class="button_bar clearfix">
                        <input type="hidden" value="<?php echo $check['as_id']; ?>" name="ascase"  />
                        <button type="submit" class="btn btn-success" name="sbremarks"> <span>Submit [ Remarks ] & Send to [ Ready Check(s) ]</span> </button>
                        <div class="clear"></div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php } 
										// For Manager Remarks
									?>
            <?php   
										$AttachWhere = "case_id=".$_REQUEST['case']." AND checks_id=".$check['as_id'];
										//echo $AttachWhere;
										$Attachments = getAttachments($AttachWhere);
										
										
										?>
            <div class="page-section-title">
              <h5 class="box_head"> Attachments </h5>
              <?php if($check['as_status']!='Close'){?>
              <div class="rating-div">
                <button type="button" class="btn btn-info btn-labeled btn-xs" onclick="addMoreAttach(<?php echo $check['as_id'];?>);"><b><i class="icon-attachment"></i></b> Add Attachments</button>
              </div>
              <?php } ?>
              <div class="clearFix"></div>
            </div>
            <div class="more_attachemnts_<?php echo $check['as_id'];?> moreattachment" style="display:none;">
              <form enctype="multipart/form-data" method="post" data-parsley-namespace="data-parsley-" data-parsley-validate="" >
                <div class="progress-bar-parent mainDivchecks">
                  <h4 class="section-title">
                    <?=$check['checks_title']?>
                  </h4>
                  <div>
                    <div>
                      <p class="text-muted " style="float:right;"> <a class="ctooltips" href="#"><i class="icon-info-sign"></i><span>Allowed file types:<br />
                        (<?php echo FILE_TYPES_ALLOWED;?>)<br />
                        Max file size:<br />
                        (<?php echo FILE_SIZE_ALLOWED;?>)</span></a> </p>
                      <div id="dprogress1<?php echo $check['as_id'];?><?php echo $check['as_id'];?>" class="progress bulk-upload-prgs" style="width:70%">
                        <div class="progress-bar progress-bar-success"></div>
                      </div>
                      <span style="float:right;" class="btn btn-primary btn-file">
                      <span class="fileinput-new">Select file</span>
                      <input type="file" name="files[]" id="docs1<?php echo $check['as_id'];?><?php echo $check['as_id'];?>" multiple class="docs_files" data-id="<?php echo $check['as_id'];?>" data-check="<?php echo $check['as_id'];?>" data-count="1" data-ccounter="_1" data-attchid="<?php echo $check['as_id'];?>" data-parsley-required="true" data-parsley-error-message="You must select a file !" class="parsley-validated parsley-error" />
                      </span> </div>
                    <div style="clear:both"></div>
                    <div id="docs_file1<?php echo $check['as_id'];?><?php echo $check['as_id'];?>" class="files checkAttached"></div>
                    <input name="see_checks_<?=$check['checks_id']?>" value="1"  type="hidden" >
                    <div class="clearFix"></div>
                  </div>
                  <footer class="panel-footer text-right">
                    <input type="hidden" name="addmore_attachments" value="1" >
                    <input type="hidden" name="check_id" value="<?php echo $check['as_id'];?>" >
                    <input type="hidden" name="case_id" value="<?php echo $_REQUEST['case'];?>" >
                    <button type="submit" class=" btnright div_icon has_text btn btn-success" name="submit_bulk" > <span> &nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp; </span> </button>
                    <input type="hidden"  id="attachment_counter" name="attachment_counter" value="0"  />
                  </footer>
                </div>
                <div class="clearFix"></div>
                <?php   
									
									
								?>
              </form>
            </div>
            <div class="progress-bar-parent mainDivchecks" >
              <?php 
				
				if($Attachments){ 
				$cc=0;
				while($attach = mysql_fetch_assoc($Attachments) ){
					$cc++;
			if($attach['att_file_path']){
				
					if($attach['att_insuff']==1){
					$btn = 'danger';
					$attTitle = "<span class='label label-danger'>Insufficient</span>";
					}else{
					$btn = 'success';
					$attTitle = "<span class='label label-success'>Sufficient</span>";					
					}
												?>
              <li>
                <div class="left-data-sec"><?php echo '<strong>'.$cc.'.</strong> '.$attach['att_file_name'];?> <?php echo $attTitle;?>: </div>
                <div class="right-data-sec">
                  <a class="ctooltips" href="javascript:;" data-placement="top"><button type="button" class="btn btn-<?php echo $btn;?> btn-labeled pull-right" title=""     onclick="downloadAttachedFile('<?php echo basename($attach['att_file_path']);?>');"><b><i class="icon-cloud-download"></i></b> Download </button><span>Download Attachment</span></a>
                </div>
                <div class="clearFix"></div>
              </li>
              <?php }
											}	 }else{?>
              <li>
                <div class="left-data-sec">No attachment added.</div>
                <div class="clearFix"></div>
              </li>
              <?php } ?>
            </div>
            <?php /// When Not in QA MODE
								if(($LEVEL == 4 && $check['as_qastatus'] == 'Approved') || $LEVEL == 2  || $LEVEL == 3){ 
                                     
										include("include_pages/details_internal_inc.php");
										
								}	
									?>
            <?php 	
									$comments = getComments(0,$CheckID);
									if($comments){ ?>
            <div class="report-detail-section-title rpdc-green">
              <h5>Comments</h5>
              <div class="clearFix"></div>
            </div>
            <?php 
											
											while($comment = mysql_fetch_assoc($comments) ){
											$ComUInfo = getUserInfo($comment['user_id']);	
											 if(trim($ComUInfo['uimg'])=='') $ComUInfo['uimg'] = "images/default.png";
											?>
            <li>
              <div class="comment-data-sec">
                <div class="comment-left-data-sec"> <img src="<?=$ComUInfo['uimg']?>" title="<?="$ComUInfo[first_name] $ComUInfo[last_name]"?>"> </div>
                <div class="comment-right-data-sec"> <strong><?php echo $comment['com_title']; ?></strong>
                  <p><?php echo $comment['com_text']; ?></p>
                  <span><?php echo ($comment['user_id'] != 0) ? 'Posted by '.  trim($ComUInfo['first_name'].' '.$ComUInfo['last_name']) : '';?> <?php echo time_ago(strtotime($comment['com_date'])); ?></span> </div>
                <div class="clearFix"></div>
              </div>
              <div class="clearFix"></div>
            </li>
			
			 <li>
			 <div class="replyBox">
                                        <div class="replyBtn" style="margin-right:3px;" >
                                            <img src="images/icons/small/grey/pluse.png" title="Add Reply" onclick="showSHR(this,'<?php echo $comment['com_id'];?>')" />
                                            <div class="clear"></div>
                                        </div>
                                        <form id="com-<?php echo $comment['com_id'];?>" style="display:none;" enctype="multipart/form-data" method="post">
                                            <div class="reply-tarea bRadius">
                                               <fieldset class="label_side">
                                                    <label>Add Reply :<span>Please type your reply </span></label>
                                                    <div> 
                                                    <textarea  class="form-control"  name="reply" ><?=$_REQUEST['reply']?></textarea>
                                                    </div>
                                                </fieldset>
                                                 <input type="hidden" name="typ" value="case"  />
                                                <input type="hidden" name="comID" value="<?php echo $comment['com_id'];?>"  />
                                                <div class="button_bar clearfix">
                                                	<button type="submit" class="btnright btn btn-success" name="addreply"><span>Add Reply</span></button>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </form>
                                        <div class="clear"></div>
                                    </div>
			
			 </li>
			
			
			
            <?php $replyComments =   getComments($comment['com_id'],0,'ASC');?>
            <?php if($replyComments){
															
															///$comIndex = 100;
															//$count_com = mysql_num_rows($replyComments);
															while($rcomment = mysql_fetch_assoc($replyComments) ){
																//$comIndex;
																//$CMIndex = ($count_com>0)?$comIndex-10 : ''; 
															$RepUInfo = getUserInfo($rcomment['user_id']);	
															if(trim($RepUInfo['uimg'])=='') $RepUInfo['uimg'] = "images/default.png";
															?>
            <li>
              <div class="reply-comment-data-sec" style="width:<?=$CMIndex?>%;">
                <div class="comment-left-data-sec"> <img src="<?=$RepUInfo['uimg']?>" title="<?="$ComUInfo[first_name] $ComUInfo[last_name]"?>"> </div>
                <div class="comment-right-data-sec"> <strong><?php echo $rcomment['com_title']; ?></strong>
                  <p><?php echo $rcomment['com_text']; ?></p>
                  <span><?php echo ($rcomment['user_id'] != 0) ? 'Posted by '.  trim($RepUInfo['first_name'].' '.$RepUInfo['last_name']) : '';?> <?php echo time_ago(strtotime($comment['com_date'])); ?></span> </div>
                <div class="clearFix"></div>
              </div>
              <div class="clearFix"></div>
            </li>
            <?php 
																} // end while
																?>
            <?php }?>
            <?php 	} // end while?>
			
			
			
			
			
            <?php } ?>
            <?php 
										/// End When In QA MODE
										?>
          </ul>
        </div>
        <?php 
							$index_tab++;
						} ?>
      </div>
    </div>
    
    <div class="col-md-3">
    	<ul class="media-list">
        	<li class="media">
												<div class="media-left">
													<img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt="">
													<span class="badge bg-danger-400 media-badge">8</span>
												</div>

												<div class="media-body">
													<a href="#">
														James Alexander
														<span class="media-annotation pull-right">14:58</span>
													</a>

													<span class="display-block text-muted">The constitutionally inventoried precariously...</span>
												</div>
											</li>
        
        </ul>
    </div>
    </div>
  </div>
  
  
  
									</div>
								</div>
                                
  
  
  
  
  
  
  <div class="clearFix"></div>
</div>
<?php 	} ?>
<!--<script src="js/load-image.all.min.js"></script> -->
<script src="js/jquery.ui.widget.js"></script> 
<!--<script src="js/canvas-to-blob.min.js"></script> -->
<script src="js/jquery.iframe-transport.js"></script> 
<script src="js/jquery.fileupload.js"></script> 
<script src="js/jquery.fileupload-process.js"></script> 
<script src="js/jquery.fileupload-image.js"></script> 
<script src="js/jquery.fileupload-audio.js"></script> 
<script src="js/jquery.fileupload-video.js"></script> 
<script src="js/jquery.fileupload-validate.js"></script> 
<script>

        $(".docs_files").each(function(index, element) {
            set_docs($(this).data('id'),$(this).data('count'),$(this).data('check'),$(this).data('ccounter'),$(this).data('attchid'));
        });
		
		
		$(document).ready(function(){

 $("#addCheckFrm").submit(function(e){
 var valid = true;
 
	  
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


		</script> 
<script src="scripts/vendor/fileinput.js"></script> 
<script src="scripts/vendor/parsley.min.js"></script> 
<script src="scripts/vendor/parsley.extend.min.js"></script> 


