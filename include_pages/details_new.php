<?php 	if(is_numeric($_REQUEST['case'])){ 
?>
<link rel="stylesheet" href="css/jquery.fileupload.css">
<script type="text/javascript" src="<?php echo SURL; ?>dashboard/starters/assets/js/sidebar_detached_sticky_custom.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SURL; ?>js/jquery.localscroll-1.2.7-min.js"></script>
<script type="text/javascript" src="<?php echo SURL; ?>js/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript" src="<?php echo SURL; ?>js/jquery.scrollTo-1.4.2-min.js"></script>

<script type="text/javascript">
 var newJQuery = jQuery.noConflict(true);
newJQuery(document).ready(function(){
	newJQuery('#nav_iner').localScroll(800);
	
	//.parallax(xPosition, speedFactor, outerHeight) options:
	//xPosition - Horizontal position of the element
	//inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
	//outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
	newJQuery('#overview').parallax("50%", 0.1);
	newJQuery('#tested').parallax("50%", 0.1);
	newJQuery('.case-data-sec').parallax("50%", 0.4);
	newJQuery('#third').parallax("50%", 0.3);

})

function showInsuffReason(ths,ids){
	console.log(ids);
	if ($('#is_insuff_'+ids).is(':checked')) {
	$('#insuff_reason_div_'+ids).slideDown('slow');
	}else{
	$('#insuff_reason_div_'+ids).slideUp('slow');	
	}
}

</script>
<script src="js/rate.js"></script>
<script>

	var checks = [];
	var ccount = [];
	
	$(function() { 
	// on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    $('.navigation-accordion li a[href="' + hash + '"]').tab('show');
		});
	
</script>

<script>
	 $(document).ready(function(){
    $("#graphtog, .add_check_btn").click(function(){
        $("#chartdivtog").slideToggle(400);
		$("html, body").animate({ scrollTop: $('#graphtog').offset().top }, 1000);
    });
	
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
.map-container {
    height: 300px;
}
</style>
<?php $data = getVerdata($_REQUEST['case']); 
 

/*$getAttachments = getAttachments('case_id = '.$_REQUEST['case']);

$attachment = mysql_fetch_array($getAttachments);
*/


	

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

<div class="page-header">
  	<div class="page-header-content">
          <div class="page-title2">
            <h1>            	
                	<a href="?action=dashboard">Dashboard</a>   <i class="icon-arrow-right8"></i>   
					<a href="?action=details&case=<?php echo $data['v_id'];?>&_pid=183"><?php echo $data[v_name]?></a>
               
				                                
                                    
                                
                                                
                                  
                                
                                                                
                                
 </h1>
          </div>
		    <?php
                        include("headers_right_menu_inc.php");
			?>
         
          
  	</div>
  </div>
  
  
                 <!-- Basic modal -->
					<?php /*?><div id="model_inscidh" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h5 class="modal-title">Case Attachments</h5>
								</div>

								<div class="modal-body">
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

								<div class="modal-footer">
									<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div><?php */?>
					<!-- /basic modal -->

  
<div class="content">
   <?php
                                $tcheck = $db->select('ver_checks','*',"v_id=$_REQUEST[case]");
                                $tcheck = mysql_fetch_assoc($tcheck);
                                $cominfo = getcompany($data['com_id']);
                                $cominfo = mysql_fetch_assoc($cominfo);
                                $mngr = getUserInfo($data['v_mngr']);
                            ?>
                            
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
  
  
 
      
   <div class="sidebar-detached" id="s_detached">
    
    <div class="sidebar sidebar-default">
				<div class="sidebar-content">
					<div class="thumbnail">
					<div class="thumb thumb-rounded thumb-slide">
							<?php if($data['image']!='images/default.png'){ ?>
                                <img src="<?php echo SURL.'files/'.basename($data['image']); ?>" alt="">
                            <?php }else{ ?>
                                <img src="<?php echo SURL; ?>images/avtr_case.png" alt="">
                            <?php } ?>
					</div>
                    
                    <?php
                            $tcheck = $db->select('ver_checks','*',"v_id=$_REQUEST[case]");
                            $tcheck = mysql_fetch_assoc($tcheck);
                            $cominfo = getcompany($data['com_id']);
                            $cominfo = mysql_fetch_assoc($cominfo);
                            $mngr = getUserInfo($data['v_mngr']);
                        ?>
							
						    	<div class="caption text-center">
						    		<h6 class="text-semibold no-margin"><?=$data['v_name']?> <small class="display-block"><?=$cominfo['name']?></small></h6>
						    	</div>
					    	</div>
                    
					<!-- Sub navigation -->
					<div class="sidebar-category">
						<div class="category-title">
							<span>Navigation</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>
						 <?php 
		  			
						
						if($LEVEL==3) $eCl="user_id=$_SESSION[user_id]"; else $eCl="";
						$check_tab= checkDetails($data['v_id'],'',$eCl);
						$checkv_id = $data['v_id'];
						$check_count =  countChecks("vc.v_id = $checkv_id");

					?>
          <?php /*?><h5>Check Details
            <span class="label count-check label-new"><?php echo ($check_count > 1) ? $check_count : ''; ?></span>
          </h5><?php */?>
						<div class="category-content no-padding">
							<ul class="nav navigation" id="nav_iner">
								<li data-slide="1"><a href="#overview"><i class="icon-googleplus5"></i> Overview</a></li>
									 <?php 
                                
						$index = 0;
						$slide = 4;
						$cont = mysql_num_rows($check_tab);
						$product_ids = array();
						$approved_checks = array();
						while($check = mysql_fetch_assoc($check_tab)){
						$product_ids[] = $check['checks_id'];
						$approved_checks[] = $check['as_qastatus'];
						$index ++;
						$cindex = ($cont>1)?''.$index : ''; 
						if($check['as_status']=='Open'){
						$statusTitle = 'Work In Progress';	
						$closeClas = 'bg-grey-300';
						}else if($check['as_status']=='Close'){
							
						if($check['as_qastatus'] == 'Rejected' ||  $check['as_qastatus'] =='QA'){
						$statusTitle = 'QC [In Progress]';
						
						$closeClas = 'bg-grey-300';						
						}else{
						$statusTitle = $check['as_vstatus'];
						$color = vs_Status(strtolower($statusTitle)); 
						$closeClas = getColorClass($color);		
						}	
							
							
							
							
							
											
						}else{
						$statusTitle = $check['as_status'];	
						if($statusTitle=='Insufficient'){
						$closeClas = 'bg-red';
						}else{
						$closeClas = 'bg-grey-300';	
						}
						}
						$closeClas = str_replace('bg-','text-',$closeClas);
									?>
            <li data-slide="<?php echo $slide; ?>" > <a href="#check_tab_<?=$check['as_id']?>"><i class="<?php echo $closeClas;?> icon-checkmark-circle position-left" data-original-title="<?php echo $statusTitle;?>" data-popup="tooltip" data-trigger="hover" data-container="body"></i> 
			
			<span data-original-title="<?php echo convertUCWords($check['checks_title']);?>" data-popup="tooltip" data-trigger="hover" data-container="body"><?php echo $cindex.'. '.substr(convertUCWords($check['checks_title']),0,25).'...';?></span></a> </li>
		
            <?php 	$slide ++;				
								}
								//$product_ids =sort($product_ids);
								//print_r($product_ids);
								$productID = array(9,39,40,41);
								$result = array_intersect($product_ids, $productID);
								$count_arr_product = count($result);
								//echo 'Count == ' . $count_arr_product;
								//print_r($result);
								if($LEVEL==2){?>
           <li class="add_check_btn"><a href="#addmorechcks_area"><i class="icon-plus22"></i> Add More Checks</a></li>		
								<?php } if($count_arr_product == 4){ 
							   if(count($approved_checks)==4){?>
            <li><a href="#cic_report_tab"><i class="icon-shield-check"></i> Criminal Intelligence Check </a></li>
            <?php }
							   }?>
                               
             <li data-slide="2"><a href="#tested"><i class="icon-stats-bars2"></i> Case Activity</a></li>
							</ul>
						</div>
					</div>
					<!-- /sub navigation -->



				</div>
			</div>
    </div>
    
<div class="container-detached">
    
  <div class="content-detached">
    <div class="col-lg-12" id="chartdivtog" style="display:none;">
    	 <?php
 if($LEVEL != 5)
 {
 ?> 	
<div class="case-data-sec tab-pane" id="addmorechcks_area" data-slide="3">
      
    <div class="col-lg-12">  
        <div class="panel panel-flat">
        	<div class="panel-heading">
            	<h6 class="panel-title text-semibold">Add More Checks</h6>
            </div>
        
        <div class="panel-body">
		<?php 
	 $all_Req=0;
	 if($all_Req==1){
	 $parsley_validated_class = 'parsley-validated';
	 $parsley_validated_true = 'data-parsley-required="true"';
	  $aesteric = '*';
	 }?>
          <form enctype="multipart/form-data" id="addCheckFrm" method="post" data-parsley-namespace="data-parsley-" data-parsley-validate="" >
        <?php // echo get_client_orderchecks($data['com_id']);?>
        <?php 
                            $where = "cc.com_id=".$data['com_id']." AND ck.is_active=1 ORDER BY ck.checks_id";
                            $tabls = "checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id ";
							//echo "select * from $tabls where  $where";
                            $checks = $db->select($tabls,"*",$where);
                            if(mysql_num_rows($checks)>0){
                                $num_check = 100;
                                while($check = mysql_fetch_assoc($checks)){?>
        <div class="progress-bar-parent mainDivchecks">
          <h6 class="text-semibold">
           <input style="float:left;" type="checkbox" name="ischeck1[]" data-parsley-required="true" data-parsley-error-message="You must select at least one check" class="parsley-validated parsley-error styled" value="<?=$check['checks_id']?>_1" id="<?=$num_check?>"  /> 
           <label for="<?=$num_check?>"><?=$check['checks_title']?></label>
            <?php if(!empty($check['checks_tooltip'])){ ?>
            <a class="ctooltips" href="#"><i class="icon-info22"></i><span>
            <?=$check['checks_tooltip']?>
            </span></a>
            <?php }?>
            <?php
			
			if($check['is_multi']==1){?>
            <a href="javascript:void(0);" onclick="addmorecheck(this,<?=$check['checks_id']?>,1,'<?=addslashes($check['checks_title'])?>')"><i class="icon-plus22 text-success"></i></a>
            <?php } ?>
            
          </h6>
		  <div>

	<input style="float:left;" type="checkbox" name="isinsuff_<?=$check['checks_id']?>_1" class="styled" value="1" id="is_insuff_<?=$num_check?>" onchange="showInsuffReason(this,<?=$num_check?>);"><label for="is_insuff_<?=$num_check?>">Is Insufficient?</label>
	<div id="insuff_reason_div_<?=$num_check?>" style="display:none;">
	<textarea name="insuff_reason_<?=$check['checks_id']?>_1" id="insuff_reason_<?=$num_check?>" cols="40" rows="5" class="form-group" placeholder="Type Reason"></textarea>
	</div>
	</div>
          <div>
            <div>
              <p class="text-muted " style="float:right;"> <a class="ctooltips text-grey ml-10" href="#" data-popup="tooltip" title="Allowed file types: (<?php echo FILE_TYPES_ALLOWED;?>)
                Max file size:
                (<?php echo FILE_SIZE_ALLOWED;?>)"><i class="icon-info22"></i></a> </p>
              <div id="dprogress1<?=$num_check?><?=$num_check?>" class="progress bulk-upload-prgs" style="width:70%">
                <div class="progress-bar progress-bar-success"></div>
              </div>
              <span style="float:right;" class="btn btn-xs bg-info-400 btn-file"><span class="fileinput-new">Select file</span>
              <input type="hidden" value="<?=$check['checks_id']?>_1" name="checks1[]"  />
              <input type="file" name="files[]" id="docs1<?=$num_check?><?=$check['checks_id']?>" multiple class="docs_files" data-id="<?=$num_check?>" data-check="<?=$check['checks_id']?>" data-count="1" data-ccounter="_1" data-attchid="<?=$num_check?>" />
              </span> </div>
            <div style="clear:both"></div>
            <div id="docs_file1<?=$num_check?><?=$num_check?>" class="files checkAttached"></div>
            <input name="see_checks_<?=$check['checks_id']?>" value="1"  type="hidden" >
            <div class="clearFix"></div>
			
			
			
			<?php
                           if($check['checks_id'] == 1)
                           { 
						   ?>
						    
                            <div class="col-md-4">
                            <div class="form-group" id="foruniselect">
                            
                            <input type="text" class="form-control typeahead-basic <?php echo $parsley_validated_class; ?>" name="uni_name1_1" placeholder="University Name<?php echo $aesteric;?>"  <?php echo $parsley_validated_true; ?> >
                             
                            </div>
                             
                            </div>
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
                            <input type="text" name="remarks1_1" placeholder="Remarks<?php //echo $aesteric;?>" value="" class="form-control clss_hide_remov1 <?php //echo $parsley_validated_class; ?>" <?php //echo $parsley_validated_true; ?>    title="Type Remarks e.g: Passed,Fail">
                            
                            </div></div>
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="pass_year1_1" placeholder="Passing Year<?php echo $aesteric;?>" value="" class="form-control clss_hide_remov1 <?php echo $parsley_validated_class; ?>" <?php echo $parsley_validated_true; ?> title="">
                            </div></div>
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="serial_no1_1" placeholder="Serial No<?php echo $aesteric;?>" value="" class="form-control clss_hide_remov1 <?php echo $parsley_validated_class; ?>" <?php echo $parsley_validated_true; ?>  title="">
                            </div></div>
                            
                             <div id="appendforeducation"></div>
							
                             
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
        <footer class="panel-footer text-right" style="background:none;">
          <input type="hidden" name="addmore" value="1" >
          <input type="hidden" name="case_id" value="<?php echo  $_REQUEST['case'];?>" >
          <button type="submit" class="mt-15 btnright div_icon has_text btn bg-success" name="submit_bulk" >

          <input type="hidden"  id="attachment_counter" name="attachment_counter" value="0"  />
          <span> &nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp; </span>
          </button>
        </footer>
      </form>
        </div>
        </div>
    </div>
    
    
    </div><!--add more checks-->
  <?php
 }
  ?>  
<div style="clear:both;"></div> 
    
    </div>
    
    
    <div class="col-lg-9">
  <?php $data = getVerdata($_REQUEST['case']);
 ?>
  	 <!--<h3 class="section-title preface-title">Applicant Detail</h3>-->
    <div class="case-data-sec" id="overview" data-slide="1">
    <div class="col-lg-12">
    	<div class="row">
		<?php  // case attachments
            $CaseAttachWhere = "case_id=".$_REQUEST['case']." AND checks_id IS NULL ";
            //echo $AttachWhere;
            $CaseAttachments = getAttachments($CaseAttachWhere);
			if(@mysql_num_rows($CaseAttachments)>0){
			$div_width = 6;
			$div_cls = '';
			}else{
			$div_width = 12;	
			$div_cls = 'hidden';
			}				?>
        	<div class="col-lg-<?php echo $div_width;?>">
            	<div class="panel panel-flat">
            	     <?php
                            $tcheck = $db->select('ver_checks','*',"v_id=$_REQUEST[case]");
                            $tcheck = mysql_fetch_assoc($tcheck);
                            $cominfo = getcompany($data['com_id']);
                            $cominfo = mysql_fetch_assoc($cominfo);
                            $mngr = getUserInfo($data['v_mngr']);
                        ?>
            <div class="panel-heading">
            	
            <h6 class="text-semibold panel-title">Overview</h6>
            	 <div class="heading-elements">
            	<ul class="icons-list">
				                    	 <!--<li><a href="javascript:;" class="btn btn-default" data-toggle="modal" data-target="#model_inscidh"><i class="icon-attachment position-left"></i> View Attachment</a> -->                       
               <?php if($data['v_status']=='Close'){?>         
   <li><a href="javascript:;"  class="btn btn-default bg-success text-white" data-trigger="hover" data-container="body" data-popup="tooltip" title="Download Complete Case Report" onclick="downloadPDF('pdf.php?pg=case&case=<?php echo $data['v_id'];?>');"><i class="icon-download"></i></a></li>
               <?php } ?>
               		
               
			                    	</ul>
            </div>
            
            </div>
            <?php
				$color = vs_Status(strtolower($data['v_rlevel'])); 
				$closeClas = getColorClass($color);		
				$tnt = countChecks("vc.v_id=$data[v_id]");
				$cnt = countChecks("vc.as_status='Close' AND vc.as_qastatus='Approved' AND vc.v_id=$data[v_id]");
				$pbr = @($cnt/($tnt))*100; 
				$pbr = number_format($pbr);?>
          
            	<table class="table datatable-basic table-striped text-semibold">
				<tr>
                    	<td>Case Status</td>
                        <td class=""><span class="label <?php echo  $closeClas;?>">
					<?=(strtolower($data['v_status'])!='close')?'Work In Progress':$data['v_rlevel'];?>
                        </span></td>
                    </tr>
					<tr>
                    	<td>Case Progress</td>
                        <td class="">
						<div class="progress progress-sm" data-original-title="<?php echo $cnt.' of '.$tnt.' checks completed '.$pbr;?>% Done" data-popup="tooltip" data-trigger="hover" data-container="body">
								<div class="progress-bar progress-bar-success <?php echo $closeClas; ?>" style="width: <?php echo $pbr;?>%">
									<span class="sr-only"><?php echo $pbr;?>% Complete</span>
								</div>
							</div>
						
						</td>
                    </tr>
                	<tr>
                    	<td>Tracking #</td>
                        <td class="text-red"><?=bcplcode($data['v_id'])?></td>
                    </tr>
                    <tr>
                    	<td>ID # </td>
                        <td class="text-red"><?=$data['emp_id']?></td>
                    </tr>
                    <?php  if($cominfo['id']==37){?>
                    <tr>
                    	<td>Reference ID # </td>
                        <td class="text-red"><?=$data['v_refid']?></td>
                    </tr>
                      <?php } ?>
                    <tr>
                    	<td><?php echo  ID_CARD_NUM;?></td>
                        <td class="text-red"><?=$data['v_nic']?></td>
                    </tr>
                    <tr>
                    	<td>BCD</td>
                        <td class="text-red"><?=$data['v_bcode']?></td>
                    </tr>
                   <!-- <tr>
                    	<td>Client name</td>
                        <td><?php /*?><?=$cominfo['name']?><?php */?></td>
                    </tr>-->
                    
                     <tr>
                    	<td>Order Date</td>
                        <td class="text-red"><?=date("j-F-Y",strtotime($data['v_date']))?></td>
                    </tr>
					<?php if($data['v_comments']!=''){?>
					 <tr>
                    	<td colspan="2">Client's Comments:<br /><br /><em><?=$data['v_comments']?></em></td>
                       
                    </tr>
					<?php } ?>
                </table>

            
            
            </div>
            
            </div><!--Overview-->
            
            <div class="col-lg-6" <?php echo $div_cls;?>>
            <div class="panel panel-flat cas-doc">
				<div class="panel-heading">
                    <h6 class="panel-title text-semibold">Case Documents</h6>
                </div>   
            <div class="panel-body">
                <?php //if($LEVEL!=4) { ?>
                 
       
        
        <div class="progress-bar-parent mainDivchecks" >
        	
		  <?php 
         
            if($CaseAttachments){ 
            $cc=0;
            while($attach = @mysql_fetch_assoc($CaseAttachments) ){
                $cc++;
                                        if($attach['att_file_path']){
                                            ?>
          <div class="col-md-3 col-sm-4">
          	<a href="javascript:;" data-placement="top" onclick="downloadAttachedFile('<?php echo basename($attach['att_file_path']);?>');"><i class="con-move-down"></i> test<?php echo '<strong>'.$cc.'.</strong> '.$attach['att_file_name'];?> : </a>
          </div>
         
          <?php }
                                        }	 }else{?>
          <div class="col-md-12 col-sm-12 no-attch" style="padding-top:80px;">No attachment added.</div>
           
          <?php } ?>
          
        </div>
        
       
        <?php //} ?>
	        </div>
      
            </div>
            </div><!--document-->
            
        </div>
    </div>
            
            </div><!-- area one-->
  
  <div style="clear:both;"></div>
            
	<div class="case-data-sec" id="tested" data-slide="2">
                                       
<?php /*?><div class="content custom_time_me">
<div class="panel-body">
    
    <div class="timeline timeline-left content-group">
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

                
                
</div><?php */?>

<div class="content custom_time_me">
<h6 class="panel-title text-semibold">Case Activities</h6>


<div class="panel-body" style="padding-left:0;">
    
    <div class="timeline timeline-left content-group">
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
							
						<?php
		 

//OR ext_id= $as_id 
	$activityquery = $db->select("activity","*","v_id = $_REQUEST[case]  ORDER BY a_date DESC LIMIT 0,7");	
	   //echo "select * from activity where (v_id = $_REQUEST[case]) ORDER BY a_id LIMIT 0,7";
	if(mysql_num_rows($activityquery))
	{
	while($rec = mysql_fetch_array($activityquery))
	{  
		//echo $rec['ext_id'];
 /* $data = getVerdata($rec['v_id']);
  $v_id = $data['v_id'];*/
  $getVerdata = getVerdata($_REQUEST['case']); //print_r($getVerdata);
  if($rec['ext_id'] != "" && $rec['ext_id'] != 0)
  {
  $getCheck = getCheck('',$rec['v_id'],$rec['ext_id']); 
 // echo $rec['v_id'].'v_id'; echo $rec['ext_id'].'ext_id';
	$checks = $db->select("checks","*","checks_id = $getCheck[checks_id]");
	$check =  mysql_fetch_assoc($checks);	
	$checkName = $check['checks_title'];
 
  }
  else
  {$checkName = '';}
 		//checks_id 
		if($rec['a_actn'] == 'remark')
		{
			$detail = "Manager Remarks On ".$checkName.".";
			$class = "icon-user-tie";
			$clasbg ="bg-danger-400";
		}
		else if($rec['a_actn'] == 'close')
		{
			if($rec['a_type'] == 'case')
			{
				$detail = $getVerdata['v_name']." Case Close.";
			}
			else
			{
				$detail = $checkName." check Close.";
			}
			$class = "icon-user-tie";
			$clasbg ="bg-success";
		}
		else if($rec['a_actn'] == 'edit')
		{
			$detail = 'Check '.$rec['a_info'];
			$class = "icon-info3";
			$clasbg ="bg-info-400";
		}
		else if($rec['a_type'] == 'pdf')
		{
			$detail = $checkName." Case Report Download.";
			$class = "icon-file-pdf";
			$clasbg ="bg-red";
		}
		else if($rec['a_type'] == 'notification')
		{
			//$detail =  str_replace("id ".$rec['v_id'],$getVerdata['v_name'],$rec['a_info']);
			//$class = "icon-googleplus5";
			//$clasbg ="bg-yellow";
		}
		else if($rec['a_type'] == 'qastatus')
		{
			$detail = strip_tags($rec['a_info']);
			$class = "icon-search4";
			$clasbg ="bg-teal";
		} 
		else if($rec['a_type'] == 'insufficient')
		{
			$detail = strip_tags($rec['a_info']);
			$class = "icon-flag4";
			$clasbg ="bg-danger";
		} 
		else
		{ 
			 $detail = strip_tags($rec['a_info']);
			$class = "icon-info3";
			$clasbg ="bg-info-400";
		}
 
		$time_diff = time_ago(strtotime($rec['a_date']));
	?>
                        <!-- Blog post -->
                      
                        <div class="timeline-row">
                            <div class="timeline-icon">
                                <div class="<?=$clasbg?>">
                                    <i class="<?=$class?>"></i>
                                </div>
                            </div>

                            <div class="panel panel-flat timeline-content">
                            
                                <div class="panel-body">
                                    
									<?php echo $detail; ?>
                   					
                                   <div class="text-muted"><i class="icon-history position-left text-success"></i><?=$time_diff?></div>
                                    
                                </div>

                                
                            </div>
                        </div>
                        <!-- /blog post -->
                       
                       <?php
 	}
	}
	else
	{
		echo '<li class="media" style="text-align:center">No Activity Found</li>';
	}
	?>        

                            
                        </div>
                        <!-- /task -->




                        
                    </div>
                    
                </div>

                
                
</div>


    </div>		

  
  </div>
  
  
  
  <div class="col-lg-3">
  <div class="row">  	<!-- Daily financials -->
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Checks Progress</h6>
								</div>

								<div class="panel-body">
									<div class="content-group-sm">
									
								<?php 
								
						
						
								
								$checkss = checkDetails($data['v_id']);	
								$ccc=0;
								while($rss = @mysql_fetch_assoc($checkss)){
									$ccc++;
								$CheckProgress = get_check_progress($rss);
								if($rss['as_status']=='Open'){
								$statusTitle = 'Work In Progress';	
								$closeClas = 'bg-grey-300';
								}else if($rss['as_status']=='Close'){
								
								if($rss['as_qastatus'] == 'Rejected' ||  $rss['as_qastatus'] =='QA'){
								$statusTitle = 'QC [In Progress]';
								
								$closeClas = 'bg-grey-300';						
								}else{
								$statusTitle = $rss['as_vstatus'];
								$color = vs_Status(strtolower($statusTitle)); 
								$closeClas = getColorClass($color);		
								}						
								}else{
								$statusTitle = $rss['as_status'];	
								if($statusTitle=='Insufficient'){
								$closeClas = 'bg-red';
								}else{
								$closeClas = 'bg-grey-300';	
								}
								}
								?>
								<p class="text-semibold"><?php echo $ccc.' '.convertUCWords($rss['checks_title'])?></p>
								<div class="progress progress-xxs" data-original-title="<?php echo $CheckProgress;?>% Completed (<?php echo $statusTitle;?>)" data-popup="tooltip" data-trigger="hover" data-container="body">
									<div class="progress-bar <?php
									
								echo $closeClas; ?>"

 style="width: <?php echo $CheckProgress;?>%" >
										<span class="sr-only"><?php echo $CheckProgress;?>% Completed</span>
									</div>
								</div>
								<?php } ?>
								
							</div>
								</div>
							</div>
	</div>				<!-- /daily financials -->
  </div>
  
  <div class="col-lg-12">

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
    <?php }?><!--area four-->
    
    
     <?php
                            if($LEVEL==3) $eCl="user_id=$_SESSION[user_id]"; else $eCl="";
                            $checks = checkDetails($data['v_id'],'',$eCl);
                            $index_tab = 0;
							$slide = 4;
                            while($check = mysql_fetch_assoc($checks)){
                                $CheckID 	= $check['as_id'];
                                $CaseID 	= $check['v_id'];
								$data = getVerdata($CaseID);
							
                                $rptLink = "showAuto('report','$check[checks_title]','ascase=$check[as_id]',20)";
                                $startCs=($LEVEL==4)?"javascript:void(0)":"?action=start&ascase=$check[as_id]&_pid=$_REQUEST[_pid]";
								if($check['as_status']=='Open'){
								$statusTitle = 'Work In Progress';	
								$closeClas = 'bg-grey-300';
								}else if($check['as_status']=='Close'){
									
								if($check['as_qastatus'] == 'Rejected' ||  $check['as_qastatus'] =='QA'){
								$statusTitle = 'QC [In Progress]';
								
								$closeClas = 'bg-grey-300';						
								}else{
								$statusTitle = $check['as_vstatus'];
								$color = vs_Status(strtolower($statusTitle)); 
								$closeClas = getColorClass($color);		
								}	
								}else{
								$statusTitle = $check['as_status'];	
								if($statusTitle=='Insufficient'){
								$closeClas = 'bg-red';
								}else{
								$closeClas = 'bg-grey-300';	
								}
								}
								
                                ?>
    <div class="tab-pane case-data-sec sec-free-space " id="check_tab_<?=$check['as_id']?>" data-slide="<?php echo $slide ?>">
   	<div class="col-lg-12">
   <?php /*?> <div class="panel-heading">
        <h5 class="panel-title"><?=$check['checks_title']?></h5>
    </div><?php */?>
   
   
        <div class="panel border-left-lg border-left-danger">
        	<div class="panel-heading">
            	<h6 class="text-semibold panel-title"><?=$check['checks_title']?></h6>
                <div class="heading-elements">
                	
                        <ul class="list-icon heading-text">
                          <span class="label <?php echo $closeClas;?>"><?php 
															echo $statusTitle;
                                                       /*  if($check['as_qastatus'] == 'Rejected' ||  $check['as_qastatus'] =='QA'){
                                                            echo 'QC [In Progress]';
                                                        }else{
                                                            if($check['as_status'] == 'Close')
                                                            {$status = ' ['.$check['as_status'].']';
                                                            }else{$status = '';}
                                                            echo $check['as_vstatus'].$status;
                                                        } */ ?></span>
                    	</ul>
                
               </div>
                
            </div>
        
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel invoice-grid">
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-6">
										<ul class="list list-unstyled">
											<li>Analyst : <?php if(is_numeric($check['user_id']) && $check['user_id']!=0){
                                    $userInfo = getUserInfo($check['user_id']);
                                    $analyst=" $userInfo[first_name]   $userInfo[last_name]";
                                    }else $analyst="Not Assigned";  ?>
                                    &nbsp;<span class="text-semibold"><?php echo $analyst;?></span>
                                    <?php // if($LEVEL == 4){?>
      <!--  <li>
          <div class="left-data-sec">Is problem in check? </div>
          <div class="right-data-sec"><a href="<?php //echo SURL.'?action=adsupport&atype=support&as_id='.$CheckID; ?>">Submit your query</a></div>
          <div class="clearFix"></div>
        </li>-->
        <?php //}?></li>
											<li>Added on: <span class="text-semibold"><?php echo dateTimeExe($check['as_addate']);?></span></li>
										</ul>
									</div>

									<div class="col-sm-6">
										<?php /* <h6 class="text-semibold text-right no-margin-top">PKR <?php echo number_format(getCheckAmount($data[com_id],$check['checks_id']));?></h6> */ ?>
										<ul class="list list-unstyled text-right">
											 <?php if((strtolower($check['as_status'])=='close') && ($check['as_sent']==4 && (strtolower($check['as_qastatus'])=='approved') || $LEVEL==2)) { ?>
        <li>
         
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
                                                  
                                                 
          <a href="javascript:;" class="btn btn-xs bg-success" onclick="<?=$pdfClick?>">
          	<i class="icon-move-down"></i> Download Check Report
          </a>
         <?php /*  &nbsp;&nbsp;&nbsp; <a class="ctooltips" href="javascript:;"><button type="button" class="btn bg-danger-400 btn-xs" title=""  onclick="<?=$pdfClickFullCase?>"><i class="icon-file-stats position-left"></i> Full Report</button><span>Download Full Case Report </span></a> */ ?>
          
        </li>
        <?php } ?>
                                            
                                            
                                           
										</ul>
									</div>
								</div>
							</div>

							<div class="panel-footer panel-footer-condensed">
								
									<ul>
										 <li class="position-left"><span class="status-mark border-danger position-left"></span> Rating: <div class="pull-right ml-10"><?php  if($LEVEL == 4 && $check['as_qastatus'] == 'Approved' && $check['as_status']=='Close'){?>
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
                            </div><?php  }else{ ?><div class="rating-div rating-checks text-grey">Only client can rate<div><?php } ?></div></li>
                                        
									</ul>

									<ul class="list-inline list-inline-condensed heading-text pull-right">
										<li><a href="#" class="text-default" data-toggle="modal" data-target="#invoice"><i class="icon-eye8"></i></a></li>
										
									</ul>
								</div>
							</div>
						</div>
                       
                    </div>

                <?php
 if($LEVEL != 5)
 {
 ?> 	
    
                
             <div class="row"> <div class="col-lg-12">
    <?php   
                                    $AttachWhere = "case_id=".$_REQUEST['case']." AND checks_id=".$check['as_id'];
                                    //echo $AttachWhere;
                                    $Attachments = getAttachments($AttachWhere);
                                    
                                    
                                    ?>
                                    
                                    
                                    
    <div class="panel panel-flat panel-addatch">
      <div class="panel-heading">
          <h6 class="text-semibold panel-title"> Attachments</h6>
          <div class="heading-elements">
          <?php if($check['as_status']!='Close'){?>
          <span class="heading-text">
            <button type="button" class="btn bg-info-400 btn-xs" onclick="addMoreAttach(<?php echo $check['as_id'];?>);"><b><i class="icon-attachment position-left"></i></b> Add Attachments</button>
          </span>
          <?php } ?>
          </div>
      </div>
      
      <div class="panel-body">
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
                  <input type="file" name="files[]" id="docs1<?php echo $check['as_id'];?><?php echo $check['as_id'];?>" multiple data-id="<?php echo $check['as_id'];?>" data-check="<?php echo $check['as_id'];?>" data-count="1" data-ccounter="_1" data-attchid="<?php echo $check['as_id'];?>" data-parsley-required="true" data-parsley-error-message="You must select a file !" class="docs_files parsley-validated parsley-error" />
                  </span> </div>
                <div style="clear:both"></div>
                <div id="docs_file1<?php echo $check['as_id'];?><?php echo $check['as_id'];?>" class="files checkAttached"></div>
                <input name="see_checks_<?=$check['checks_id']?>" value="1"  type="hidden" >
                <div class="clearFix"></div>
              </div>
              <div class="panel-footer text-right">
                <input type="hidden" name="addmore_attachments" value="1" >
                <input type="hidden" name="check_id" value="<?php echo $check['as_id'];?>" >
                <input type="hidden" name="case_id" value="<?php echo $_REQUEST['case'];?>" >
                <button type="submit" class=" btnright div_icon has_text btn btn-success" name="submit_bulk" > <span> &nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp; </span> </button>
                <input type="hidden"  id="attachment_counter" name="attachment_counter" value="0"  />
              </div>
            </div>
            <div class="clearFix"></div>
           
          </form>
        </div>
      <ul class="list list-inline">
         <?php 
            if($Attachments){ 
            $cc=0;
            while($attach = mysql_fetch_assoc($Attachments) ){
                $cc++;
        if($attach['att_file_path']){
            
                if($attach['att_insuff']==1){
                $btn = 'danger-400';
                $attTitle = "<span class='text-danger'>Insufficient</span>";
                }else{
                $btn = 'success-400';
                $attTitle = "<span class='text-success'>Sufficient</span>";					
                }
                                            ?>
        <li class="col-md-4 text-semibold">
            <div class="media-body">
                <i class="icon-move-down"></i> <a href="javascript:;" class="text-grey-700" onclick="downloadAttachedFile('<?php echo basename($attach['att_file_path']);?>');"><?php echo $attach['att_file_name'];?> &nbsp;&nbsp;<?php echo $attTitle;?></a>
                <?php if($attach['att_comments'] != ""){?>
            <span class="display-block comments"><strong>Comment</strong> :<span class="text-muted"> <?=$attach['att_comments']?></span></span><?php } ?>
            </div>
        </li>
        
          <?php }
                                        }	 }else{ ?>
                     <li class="media">
            <div class="media-body">No attachment added.</div>
          </li>
         <?php } ?>
      </ul>
      
      
      
      
      </div>
      
      
                                    
    </div>
    
    
    
    
                                    
    </div></div> 
     <?php
 }
 ?> 	

  <?php /*  // QA section disabled for now Mar-2016
    <div class="row">
    	<div class="col-lg-12">
          <?php if ($LEVEL==2 || $LEVEL==3) { 
                                       
                                        if(strtolower($check['as_status'])=='close'){
                                     
                                         switch($check['as_qastatus']){
                                                case  "Approved":
                                                $color = 'bg-success-400';
                                                break;
                                                case  "Rejected":
                                                $color = 'bg-warning-400';
                                                break;
                                                case  "QA":
                                                $color = 'bg-primary-400';
                                                break;

                                            }
                                     ?>
        <div class="panel panel-flat panel-qa">
            <div class="panel-heading">
                <h6 class="text-semibold panel-title">QA</h6>
                <div class="heading-elements">
                    <span class="heading-text no-margin">QA Level : <span class="label <?php echo $color; ?>">
            <?=$check['as_qastatus']?>
            </span>
            </span>
                </div>
            </div>
            <div class="panel-body">
            <div class="row">
            <div class="col-md-12">
           
            
                 <ul class="media-list chat-list content-group">
            <?php 
					$whr = "_id = $CheckID and com_type='qa' ORDER BY com_id DESC";
					$qa_comments = $db->select("comments","*",$whr); 
					$qa_data = mysql_num_rows($qa_comments);
					if(count($qa_data)>0){
							
							while($qrow = mysql_fetch_assoc($qa_comments)){
								$CommmentUInfo = getUserInfo($qrow['user_id']);
								?>
                                <li class="media">
                                    <div class="media-left">
                                        <img src="<?=$CommmentUInfo['uimg']?>" class="img-circle" title="<?="$ComUInfo[first_name] $ComUInfo[last_name]"?>">
                                    </div>
                                
                                    <div class="media-body">
                                        <div class="media-content"><span class="text-semibold"><?php echo $qrow['com_title']; ?></span> <?php echo $qrow['com_text']; ?></div>
                                        <span class="media-annotation display-block mt-10"><?php echo ($qrow['user_id'] != 0) ? 'Posted by '.  trim($CommmentUInfo['first_name'].' '.$CommmentUInfo['last_name']) : '';?> <?php echo time_ago(strtotime($qrow['com_date'])); ?> </span>
                                    </div>
                                </li>
            <?php }
                                                    }
                                                    ?>
          </ul>
            </div>
            </div>
                <div class="row">
                    <div class="col-md-12"> 
          <?php $user_analyst =  $check['user_id']; ?>
          <?php if($LEVEL == 3 ){ ?>
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
                </div>
                </div>
                <!--   <div class="row">
                <div class="col-md-12"> 
                     <?php if($LEVEL == 2 &&  $check['as_qastatus'] != 'Work In Progress' ){?>
          <form  method="post">
            
            <input type="hidden" name="as_id" value="<?=$CheckID?>"  />
            <input type="hidden" name="analyst_id" value="<?=$user_analyst?>"  />
            <div class="form-group">
              <label for="basic-text-area">QA Comments</label>
                <textarea id="basic-text-area" rows="7" name="app_comments"  class="form-control" placeholder="QA Comments"></textarea>
            </div>
            <div class="form-group text-right">
            <button type="submit" class="btn bg-success-400"  name="check_approve"><i class="icon-thumbs-up2 position-left"></i> Approve</button>
            <button type="submit" class="btn bg-danger-400" name="check_reject"><i class="icon-thumbs-down2 position-left"></i> Reject</button>
            </div>
            
          </form>
          
          <?php }?>
                
                </div>
                 </div>   -->
                
            </div>
        </div>
     <?php } ?>
        <?php }?>
    </div>
    
    </div>
    
    <?php   */ 
                                            // For Manager Remarks
                if($LEVEL==2 && ($check['as_adcls']==0 && strtolower($check['as_status'])=='close')  && $check['as_qastatus']=='Approved'){ ?>
            <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-flat panel-qa">
                 <div class="panel-heading">
                    <h6 class="text-semibold panel-title"> Manager Remarks </h6>
                  </div>
                    
                      <div class="panel-body">
                        <form action="" method="post" enctype="multipart/form-data">
                          <fieldset class="label_side">
                            <label>Case Status :<span>Please select case status</span></label>
                            <div>
                              <select class="select input req" name="vStatus" >
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
			<?php } ?>
    
    
    		<div class="row">
            	 <div class="col-lg-12">
         <?php if(($LEVEL == 4 && $check['as_qastatus'] == 'Approved') || $LEVEL == 2  || $LEVEL == 3){ 
                                 
                                    include("include_pages/details_internal_inc.php");
                                    
                            }	
                               /// When Not in QA MODE  ?>
    </div>
            </div>
    
              
            </div><!--body-->

        </div>
                                                    
    
      <ul>
        
                        <?php 	
                                $comments = getComments(0,$CheckID);
                                if($comments){ ?>
        <div class="report-detail-section-title rpdc-green">
          <h6 class="text-semibold">Comments</h6>
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
    </div>
    <?php 
	         $index_tab++;
						$slide ++;
                    } ?>
    
  </div>
  
  </div><!--content detech-->
    
    
   
    </div><!--container-->
    

</div>

<?php 	} //if case id not found ?>
    
    <!-- case activity-->
    
   

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
        
        
        
        
        
    <!--  BY ATA -->   
        
        
<script type="text/javascript">
//$('#loadingimage').hide();
$(document).ready(function(){
   
	  $(".case_activity").scroll(function(){
	
	
	
	
	  var elmnt = document.getElementById("datascroll");
    var x = elmnt.scrollLeft;
    var y = elmnt.scrollTop; 
	
 	if(y == 55)
	{ var pagination = '7,14';  $('#loadingimage').show();}
 	else if(y == 70)
	{ var pagination = '14,21';  $('#loadingimage').show();}
	 
 if(y == 55){  lastAddedLiveFunc(pagination);}
 console.log(y);
 
  });
   
   
   
    function lastAddedLiveFunc(pagination)
    {
   
	
  $.ajax({
  type: 'POST',
  url: 'actions.php',
  data: 'ePage=add_rating&caseactstream=yes&case=<?=$_REQUEST['case']?>&paginations='+pagination,
    
   
  success: function (response) 	
	{ // $('#loadingimage').hide();
	
	//$(".items").append(response);
	
	
	
	$( "#loadingimage" ).delay( 1600 ).fadeOut( 400 );
  $( ".items" ).fadeIn( 400 ).append(response);
  }
	// $('div#lastPostsLoader').empty();
	
	});
	
	 };
	
 

	
	
});

</script>        
        
     <!-- END  BY ATA -->      
        
        
        
        
        
        
        
        
        
        
        
<script src="scripts/vendor/fileinput.js"></script> 
<script src="scripts/vendor/parsley.min.js"></script> 
<script src="scripts/vendor/parsley.extend.min.js"></script> 


