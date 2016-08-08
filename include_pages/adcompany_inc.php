<?php

if(isset($_REQUEST['edur'])){
	if(is_numeric($_REQUEST['comid'])){
		enabdisb("company","id=$_REQUEST[comid]");
	}
}

if(isset($_REQUEST['edit'])){
	if(is_numeric($_REQUEST['comid'])){
		$data = getInfo('company',"id=$_REQUEST[comid]");
		$_REQUEST['cName'] =$data['name'];
		$_REQUEST['cEmail'] =$data['email'];
		$_REQUEST['ind'] =$data['ind_id'];
			
		$_REQUEST['cType'] = $data['type'];
		$_REQUEST['cerp'] = $data['erpid'];
		$_REQUEST['paid'] = $data['paid'];
		$_REQUEST['credits'] = $data['credits'];
		$_REQUEST['address'] = $data['address'];
		$_REQUEST['mode_of_payment'] = $data['mode_of_payment'];
		$_REQUEST['account_type'] = $data['account_type'];
		$_REQUEST['is_check_wise_pay'] = $data['is_check_wise_pay'];
		$_REQUEST['can_download_reports'] = $data['can_download_reports'];
		$_REQUEST['location_wise'] = $data['location_wise'];
		$_REQUEST['allow_custom_order'] = $data['allow_custom_order'];
		$_REQUEST['monthly_credits_allowed'] = $data['monthly_credits_allowed'];
		$_REQUEST['state_province_id'] = $data['state_province_id'];
		
		 
		$_REQUEST['location'] = $data['location'];
		$_REQUEST['pname'] = $data['pname'];
		$_REQUEST['phone'] = $data['phone'];
		$_REQUEST['pterm'] = $data['pymterm'];
		$_REQUEST['comments'] = $data['comment'];
		
		$_REQUEST['sdate'] = $data['agsdate'];
		$_REQUEST['edate'] = $data['agedate'];
		$_REQUEST['disabled_id'] = $data['disabled_id'];
		$_REQUEST['slab_id'] = $data['slab_id'];
		
		$poc_operation = mysql_fetch_assoc($db->select("clients_poc","*","com_id=$_REQUEST[comid] AND poc_designation='operation'"));
		$poc_sales = mysql_fetch_assoc($db->select("clients_poc","*","com_id=$_REQUEST[comid] AND poc_designation='sales'"));
		$_REQUEST['poc_sales_name'] = $poc_sales['poc_name'];
		$_REQUEST['poc_sales_phone'] = $poc_sales['poc_phone'];
		$_REQUEST['poc_sales_email'] = $poc_sales['poc_email'];
		
		$poc_finance= mysql_fetch_assoc($db->select("clients_poc","*","com_id=$_REQUEST[comid] AND poc_designation='finance'"));
		
		
		
		//$_REQUEST['poc_operation_name'] = $poc_operation['poc_operation_name'];
		//$_REQUEST['poc_operation_phone'] = $poc_operation['poc_operation_phone'];
		//$_REQUEST['poc_operation_email'] = $poc_operation['poc_operation_email'];
		
		$_REQUEST['poc_finance_name']=$poc_finance['poc_name'];
		$_REQUEST['poc_finance_phone']=$poc_finance['poc_phone'];
		$_REQUEST['poc_finance_email'] = $poc_finance['poc_email'];
						
	}
}
?>
<script type="text/javascript">
	function unpaid(ths){
		if(ths.options[ths.selectedIndex].value=='Test'){
			jQuery("#upaid").show();
		}else{
			jQuery("#upaid").hide();
		}
		
		if(ths.options[ths.selectedIndex].value=='Individual'){
			jQuery("#cnm").html('Name<sup class="sreq">*</sup>:');
			jQuery("#public").show();
			jQuery("#mainind").hide();
		}else{
			jQuery("#cnm").html('Client Name<sup class="sreq">*</sup>:');
			jQuery("#public").hide();
			jQuery("#mainind").show();			
		}
	}
	var attcnt=1;
	function deleteattach(ths){
		attcnt=attcnt-1;
		jQuery(ths).parent().parent().remove();
		
	}

	function addattach(){
		
		if(attcnt<3){ 
			jQuery("#doattach").append('<div>'+jQuery("#doattach #attchfile").html()+'</div>');
			attcnt++;
		}
		
	}
		
</script>
<style>
	#attchfile .doclose{
		display:none !important;
	}
.whiteBackground{ padding:15px;}
ul.block content_accordion{ padding:0; margin:0;}
ul.content_accordion li{ list-style:none;}	
h2.box-head{ margin:0; padding:0;} 
</style>

<section class="retracted scrollable content-body" <?=(isset($_REQUEST['addnew']) || isset($_REQUEST['comid']))?'style="display:block;"':'style="display:none;"'?>>
<div class="row">
 	<div class="col-md-12">
        <div class="manager-report-sec">
        <div class="panel panel-default panel-block">
        <div class="page-section-title">
        	<h2 class="box-head"><?=(isset($_REQUEST['comid']))?'Edit':'Add'?> Client</h2>
        </div>
                    <div class="list-group">
                    
                        <div class="list-group-item">

                       <form class="cstm form-horizontal" action="" name="myform" method="post" enctype="multipart/form-data" >
                          
                          <div class="row">   
                            	<div class="col-md-3"></div>
                          		<div class="col-md-9">
                           <div class="form-group">
                                <div class="col-lg-3 "><label for="cType">Client Type:</label></div>
                           			<div class="col-lg-9">
                                    <select name="cType" class="form-control" onchange="unpaid(this)">
                                        <option value="Company" <?=($_REQUEST['cType']=='Company')?'selected="selected"':''?> >Company</option>
                                        <option value="Individual" <?=($_REQUEST['cType']=='Individual')?'selected="selected"':''?>>Individual</option>
                                        <option value="Test" <?=($_REQUEST['cType']=='Test')?'selected="selected"':''?>>Test</option>
                                    </select>
                                    <div style="display:<?=($_REQUEST['cType']=='Test')?'block':'none'?>;padding:10px 0;" id="upaid" >
                                         <input type="radio" value="1" title="Paid" name="paid" <?=($_REQUEST['paid']==1)?'checked="checked"':''?> /> Paid
                                         <input type="radio" value="0" title="unPaid" name="paid" <?=($_REQUEST['paid']==0)?'checked="checked"':''?> /> unPaid
                                    </div>
                                </div>
                            </div>
                           <div class="form-group">
                            <div class="col-lg-3 "><label for="cerp">Client ERP ID:</label></div>
                                <div class="col-lg-9"><input class="form-control" type="text" name="cerp" value="<?=$_REQUEST['cerp']?>" > </div>
                            </div>
                           <div class="form-group">
                            <div class="col-lg-3 "><label for="cName" id="cnm"><?=($_REQUEST['cType']=='Individual')?'':'Client '?>Name<sup class="sreq">*</sup>:</label></div>
                            <div>
                              <div class="col-lg-9"><input class="form-control" title="Input Company Name" type="text" name="cName" value="<?=$_REQUEST['cName']?>" required></div>
                            </div>
                          </div>
						  
						  <div class="form-group">
                            <div class="col-lg-3 "><label for="cred" id="cred">Credits:</label></div>
                            <div>
                              <div class="col-lg-9"><input id="cred" class="form-control" title="Input Credits" type="number" name="credits" value="<?=$_REQUEST['credits']?>" size="5" ></div>
                            </div>
                          </div>
						  
						  
						  
						  
                           <div class="form-group">
                                     <div class="col-lg-3 "><label for="location">Location:</label></div>
                                    <div>
                                        <div class="col-lg-9"><select name="location" id="location" class="form-control" onchange="updatecity(this)">
                                            <?php							
                                            $countries = $db->select("country","*","1=1 ORDER BY printable_name"); 
                                            if(!isset($_REQUEST['location'])) $_REQUEST['location']=171;
                                            while($country =mysql_fetch_array($countries)){ ?>
                                                <option value="<?=$country['country_id']?>" <?=($_REQUEST['location']==$country['country_id'])?'selected="selected"':''?>>
                                                <?=trim($country['printable_name'])?>
                                                </option>
                                            <?php } ?>
                                        </select>
										</div>
                                    </div>
                          </div>  
						
						 <div class="form-group">
                                     <div class="col-lg-3 "><label for="location">City/State/Province:</label></div>
                                    <div class="col-lg-9">
                                         <div id="updatecity">
					 
								<?php
                                    $_REQUEST['cntid'] = $_REQUEST['location'];
                                    $_REQUEST['state_province_id'] = $_REQUEST['state_province_id'] ;
                                    include("include_pages/getcity_inc.php");                            
                                ?>
								</div>
                                    </div>
                          </div> 
						  
						  <div class="form-group">
                            <div class="col-lg-3 "><label for="address" id="cred">Address:</label></div>
                            <div>
                              <div class="col-lg-9"><input id="address" class="form-control" title="Input address" type="text" name="address" value="<?=$_REQUEST['address']?>" size="5" ></div>
                            </div>
                          </div>
						  
						  
                           <div class="form-group">
                            <div class="col-lg-3 "><label for="ind">Industry:</label></div>
                            <div id="mainind"  style="display:<?=($_REQUEST['cType']!='Individual')?'block':'none'?>">
							<div class="col-lg-9">
                            <select name="ind" class="form-control" id="ind">
                            <option value="0">Other</option>
                          <?php
                                $inds= $db->select("industries","*","ind_active=1 ORDER BY ind_name");
                                if(mysql_num_rows($inds)>0){
                                while($ind = mysql_fetch_array($inds)){ ?>
                                    <option value="<?=$ind['ind_id']?>" <?=($ind['ind_id']==$_REQUEST['ind'])?'selected="selected"':''?>><?=$ind['ind_name']?></option>
                    
                          <?php }}?>
                          </select>
						  </div>
                           </div>
                            <div style="display:<?=($_REQUEST['cType']=='Individual')?'block':'none'?>" id="public">
                                <select disabled="disabled" class="form-control" >
                                    <option value="0">Public</option>
                                </select>
                            </div>
                           
                          </div>
						  
						  
						  <div class="form-group">
                            <div class="col-lg-3 "><label for="attch">Attachments:</label></div>
                            <div id="doattach">
                                <div style="float:right;">
                                    <a class="light icon_only div_icon" href="javascript:void(0)" onclick="addattach()">
                                    <div class="ui-icon ui-icon-circle-plus"></div>
                                  </a>
                                </div>
                                <div class="col-lg-9"><div id="attchfile">
                                  <input style="width:40% !important" class="input form-control" title="Input attachment title" type="text" name="title[]" > 
                                  <input type="file" name="attch[]" />
                                  <div style="float:right;">
                                      <a style="float:left;" class="red icon_only div_icon doclose" href="javascript:void(0)" onclick="deleteattach(this)">
                                        <div class="ui-icon ui-icon-circle-close"></div>
                                      </a>
                                </div>
                                </div>
						</div>
                            </div>
                          </div>
                          </div>
                          </div>
                          
                           <h4 class="section-title">Contract / Agreement Information</h4>
                        	<div class="row">   
                            	<div class="col-md-3"></div>
                          		<div class="col-md-9">
                                <div class="form-group">
                            <div class="col-lg-3 "><label for="sdate">Start Date:</label></div>
                            <div>
                              <div class="col-lg-9"><input class="form-control datetimepicker-month1" title="Input agreement start date" type="text" name="sdate" value="<?=$_REQUEST['sdate']?>" ></div>
                            </div>
                          </div>
                          		<div class="form-group">
                            <div class="col-lg-3 "><label for="edate">End Date:</label></div>
                            <div>
                             <div class="col-lg-9"> <input class="form-control datetimepicker-month2" title="Input agreement start date" type="text" name="edate" value="<?=$_REQUEST['edate']?>" ></div>
                            </div>
                          </div>
                           		<div class="form-group">
                            <div class="col-lg-3 "><label for="pterm">Payment:<span>Term in Days</span></label></div>
                            <div>
                              <div class="col-lg-9"><input class="input form-control" title="Input payment term in numbers" type="text" name="pterm" value="<?=$_REQUEST['pterm']?>" > </div>
                            </div>
                          </div>
						  <div class="form-group">
                            <div class="col-lg-3 "><label for="pterm">Billing Account Type:</label></div>
                            <div>
                              <div class="col-lg-9">
							  
							 <select name="account_type" class="form-control" id="account_type">
							<option value="0" <?=($_REQUEST['account_type']==0)?'selected="selected"':''?>>Postpaid</option>
                            <option value="1" <?=($_REQUEST['account_type']==1)?'selected="selected"':''?>>Prepaid</option>
							 
							</select>
							  
							  </div>
                            </div>
                          </div>
						  <div class="form-group">
                            <div class="col-lg-3 "><label for="pterm">Mode of Payment:</label></div>
                            <div>
                              <div class="col-lg-9">
							  
							 <select name="mode_of_payment" class="form-control" id="mode_of_payment">
							
                            <option value="0" <?=($_REQUEST['mode_of_payment']==0)?'selected="selected"':''?>>Bank Transfer</option>
							 <option value="1" <?=($_REQUEST['mode_of_payment']==1)?'selected="selected"':''?>>Paypal</option>
							</select>
							  
							  </div>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <div class="col-lg-3 "><label for="pterm">Invoice Type:</label></div>
                            <div>
                              <div class="col-lg-9">
							  
							 <select name="is_check_wise_pay" class="form-control" id="is_check_wise_pay">
							
                            <option value="0" <?=($_REQUEST['is_check_wise_pay']==0)?'selected="selected"':''?>>Check Wise</option>
							 <option value="1" <?=($_REQUEST['is_check_wise_pay']==1)?'selected="selected"':''?>>Case Wise</option>
							</select>
							  
							  </div>
                            </div>
                          </div>
						  
						   <div class="form-group">
                            <div class="col-lg-3 "><label for="pterm">Monthly Credits Allowed:</label></div>
                            <div>
                              <div class="col-lg-9">
							  <input id="monthly_credits_allowed" class="form-control" title="Enter Monthly Credits Allowed" type="number" name="monthly_credits_allowed" value="<?=$_REQUEST['monthly_credits_allowed']?>" size="5" >
							
							  
							  </div>
                            </div>
                          </div>
						  
						   <div class="form-group">
                                     <div class="col-lg-3 "><label for="slab_id">Slab:</label></div>
                                    <div>
                                        <div class="col-lg-9"><select name="slab_id" id="slab_id" class="form-control" >
                                                <option value="1" <?=($_REQUEST['slab_id']=='1')?'selected="selected"':''?>>Total Cost</option>
                                                 <option value="2" <?=($_REQUEST['slab_id']=='2')?'selected="selected"':''?>>Total Cost + University Cost</option>
                                        </select>
										</div>
                                    </div>
                          </div>
						  
						  
						  
						  
                          		</div>
                    		</div>
						<h4 class="section-title">Components:</h4>
                           <div class="form-group">
                             
                            <div>
                              <div class="components_box">
                                            <ul class="panel-group" id="demo-accordion">
                                                <?php 
                                                    $checks= $db->select("checks","*","is_active=1 ORDER BY checks_title");
                                                    if(mysql_num_rows($checks)>0){
                                                        $rw = 0;
                                                        while($check = mysql_fetch_array($checks)){
                                                            $checked=false;
                                                            $check['clt_cost']='0';
                                                            $check['clt_units']='1';
                                                            if(isset($_REQUEST['comid'])){
                                                                $record = $db->select("clients_checks","*","com_id=$_REQUEST[comid] AND checks_id=$check[checks_id] AND clt_active=1");
                                                                if(mysql_num_rows($record)>0){
                                                                    $record = mysql_fetch_assoc($record);
                                                                    $check['clt_cost']=$record['clt_cost'];
                                                                    $check['clt_units']=$record['clt_units'];
                                                                    $checked=true;
                                                                }
                                                            } 
                                                            
                                                            ?>							
                                                            <li>
                                                                <a href="javascript:void(0)" class="handle">&nbsp;</a>
                                                                
                                                                <div class="content" style="padding:2px;">
                                                                    <div class="row">
                                                                    <div class="col-md-3">&nbsp;</div>
                                                                     <div class="col-md-9"><div class="form-group">
                                                                     
                                                                     <div class="col-lg-5"><label>
                                                                    <input type="checkbox" name="checks[]" value="<?=$check['checks_id']?>" <?=($checked)?'checked="checked"':''?> />
                                                                        <?=$check['checks_title']?>
                                                                </label> </div>
                                                                     <div class="col-lg-1"><label for="cost_<?=$check['checks_id']?>">Cost:</label></div>
                                                                      <div class="col-lg-2"><input type="number" class="form-control" id="cost_<?=$check['checks_id']?>" name="cost<?=$check['checks_id']?>" value="<?=$check['clt_cost']?>" />
																	
																	
																		</div>
																		<div class="col-lg-2">
																	<select name="clt_currency<?=$check['checks_id']?>" class="form-control" title="Select Currency"  >
																	<option value="PKR" <?=($record['clt_currency']=='PKR')?'selected':''?>>PKR</option>
																	<option value="USD" <?=($record['clt_currency']=='USD')?'selected':''?>>USD</option>
																	</select>
																																	
																	</div>
																		
																		
																		
																		
                                                                    
                                                                  </div></div>                                              
                                                                   	</div>
                                                                  <div class="form-group" style="display:<?=($check['is_multi']==1)?'none':'none'?>">
                                                                    <div class="col-lg-3 "><label for="units">Units:<span># of units as per agreement</span></label></div>
                                                                    
                                                                      <div class="col-lg-9"><input type="text" class="form-control" name="units<?=$check['checks_id']?>" value="<?=$check['clt_units']?>" /></div> 
                                                                   
                                                                  </div>   
                                                                   
                                                                </div>
                                                            </li>
                                                 <?php $rw++;}
                                                 }?>
                                            </ul>
                                        </div>
                            </div>
                          </div>
                          
                    
                           
                          
                    <div class="clearfix"></div>
                           <div class="row">
                            <div class="col-md-3">&nbsp;</div>
                            <div class="col-md-9">
                           <div class="form-group">
                            <div class="col-lg-3 "><label for="comments">Comments:</label></div>
                            <div class="clearfix">
                             <div class="col-lg-9"><textarea class="input form-control" title="Input comments"  name="comments" rows="5" ><?=$_REQUEST['comments']?></textarea></div>
                            </div>
                          </div>
                          </div>
                          </div>
                         
                          
                            
							<h4 class="section-title">Point of Contact <span class="badge">Operation</span></h4>
                    		<div class="row">
                            <div class="col-md-3">&nbsp;</div>
                            <div class="col-md-9">
                          <div class="form-group">
                            <div class="col-lg-3 "><label for="pname">Name :</label> </div>
                            <div>
                              <div class="col-lg-9"><input class="input form-control" title="Input point of contact name" type="text" name="pname" value="<?=$_REQUEST['pname']?>" ></div>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <div class="col-lg-3 "><label for="cEmail">Email :</label></div>
                           
                               <div class="col-lg-9">
                               <input class="input form-control" title="Input point of contact email" type="email" name="cEmail" value="<?=$_REQUEST['cEmail']?>" >
                               </div>
                           
                          </div>
                    
                           <div class="form-group">
                            <div class="col-lg-3 "><label for="phone">Phone :</label></div>
                           
                              <div class="col-lg-9"><input class="input form-control" title="Input point of contact phone" type="text" name="phone" value="<?=$_REQUEST['phone']?>" ></div>
                           
                          </div>
                          
                        
                        </div>
                        </div>
						
						
						
						 <h4 class="section-title">Point of Contact <span class="badge">Finance</span></h4>
                    		<div class="row">
                            <div class="col-md-3">&nbsp;</div>
                            <div class="col-md-9">
                          <div class="form-group">
                            <div class="col-lg-3 "><label for="poc_finance_name">Name :</label> </div>
                            <div>
                              <div class="col-lg-9"><input class="input form-control" title="Input point of contact name" type="text" name="poc_finance_name" value="<?=$_REQUEST['poc_finance_name']?>" ></div>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <div class="col-lg-3 "><label for="poc_finance_email">Email :</label></div>
                           
                               <div class="col-lg-9">
                               <input class="input form-control" title="Input point of contact email" type="email" name="poc_finance_email" value="<?=$_REQUEST['poc_finance_email']?>" >
                               </div>
                           
                          </div>
                    
                           <div class="form-group">
                            <div class="col-lg-3 "><label for="poc_finance_phone">Phone :</label></div>
                           
                              <div class="col-lg-9"><input class="input form-control" title="Input point of contact phone" type="text" name="poc_finance_phone" value="<?=$_REQUEST['poc_finance_phone']?>" ></div>
                           
                          </div>
                          
                        
                        </div>
                        </div>
						
						
						
						<h4 class="section-title">Point of Contact <span class="badge">Sales</span></h4>
                    		<div class="row">
                            <div class="col-md-3">&nbsp;</div>
                            <div class="col-md-9">
                          <div class="form-group">
                            <div class="col-lg-3 "><label for="poc_sales_name">Name :</label> </div>
                            <div>
                              <div class="col-lg-9"><input class="input form-control" title="Input point of contact name" type="text" name="poc_sales_name" value="<?=$_REQUEST['poc_sales_name']?>" ></div>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <div class="col-lg-3 "><label for="poc_sales_email">Email :</label></div>
                           
                               <div class="col-lg-9">
                               <input class="input form-control" title="Input point of contact email" type="email" name="poc_sales_email" value="<?=$_REQUEST['poc_sales_email']?>" >
                               </div>
                           
                          </div>
                    
                           <div class="form-group">
                            <div class="col-lg-3 "><label for="poc_sales_phone">Phone :</label></div>
                           
                              <div class="col-lg-9"><input class="input form-control" title="Input point of contact phone" type="text" name="poc_sales_phone" value="<?=$_REQUEST['poc_sales_phone']?>" ></div>
                           
                          </div>
                          
                        
                        </div>
                        </div>
						
							
							
							
							
							
							
							
							
							
							
						<h4 class="section-title">
						<label><input type="checkbox" value="1" name="can_download_reports" id="can_download_reports" <?=($_REQUEST['can_download_reports']=='1')?'checked="checked"':''?> > Disable Downloading Reports</label>
						</h4>
						<h4 class="section-title">
						<label><input type="checkbox" value="1" name="location_wise" id="location_wise" <?=($_REQUEST['location_wise']=='1')?'checked="checked"':''?> > Location Wise Reports</label>
						</h4>
						<h4 class="section-title">
						<label><input type="checkbox" value="1" name="allow_custom_order" id="allow_custom_order" <?=($_REQUEST['allow_custom_order']=='1')?'checked="checked"':''?> > Allow Custom Order </label><a href="javascript:;" class="ctooltips" ><i class="icon-help"></i><span> Allow client to give custom order rather than package only.</span></a>
						</h4>
						<h4 class="section-title">
						<label><input type="checkbox" value="1" name="updateclient_status" id="updateclient_status"> Update Client Status</label>
						</h4>
                    		<div class="row">
                            <div class="col-md-3">&nbsp;</div>
                            <div class="col-md-9">
						<div class="form-group">
						<div class="col-lg-5"><label for="enabled_id">
							<input type="radio" id="enabled_id" name="disabled_id" value="0" class="" <?=($_REQUEST['disabled_id']==0?'checked':'')?> disabled="disabled" > Enabled </label>
							
							
							
							</div>
							</div>
						
						
						<div class="form-group">
						<div class="col-lg-5">
							
							<label for="disabled_id">
							<input type="radio" id="disabled_id" name="disabled_id" value="1" class="" <?=($_REQUEST['disabled_id']==1?'checked':'')?> disabled="disabled" > Disabled (Non payment) </label>
							
							</div>
							</div>
                          </div>
						  </div>
                          <?php if(isset($_REQUEST['comid'])){ ?>
                                <input type="hidden" name="comid" value="<?=$_REQUEST['comid']?>" >
                                <input type="hidden" name="edit" value="" >
                          <?php	} ?>
                          <div class="button_bar clearfix">
                              <button type="submit" class="btn btn-success has_text" style="float:right;" name="addCompany" > 
                                    <span><?=isset($_REQUEST['comid'])?'Save':'Add'?> Client </span> 
                              </button>
                          </div>
                        </form>
            			</div>
                	</div>
           </div>



		</div>
	</div>
</div>
</section>
<section class="retracted scrollable">
	<div class="row">
    <div class="col-md-12">
    	<div class="manager-report-sec">
                   
<div class="panel panel-default panel-block">
 <div class="page-section-title">
<h2 class="box-head">Companies Listing </h2>
<a href="?action=client&atype=add/edit&addnew"><button  class="btn btn-success has_text"   title="Add New Client" ><span><i class="icon-plus3"></i></span></button></a>
                    </div>
       <table class="table table-bordered table-striped" id="tableSortable">
          <thead>
            <tr>
              
              <th>Company Name</th>
              <th>Industry</th>
              <th>Email Address</th>
              <th>Description</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php	
			if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){
					$dWhere="id=20";
			}else $dWhere="1=1";	
			
			$companies= $db->select("company","*","$dWhere ORDER BY `id` DESC");
			if(mysql_num_rows($companies)>0){
			while($company = mysql_fetch_array($companies)){ ?>
            <tr class="gradeX">
             
              <td><?=$company['name']?></td>
              <td><?php
              		if($company['ind_id']!=0){
						$ind= $db->select("industries","*","ind_id=$company[ind_id]");
						$ind = mysql_fetch_array($ind);
						echo $ind['ind_name'];
					}else{
						echo "Other";
					}
			  ?></td>
              <td><?=$company['email']?></td>
              <td style="text-align:left;"><?=$company['title']?></td>
              <td align="center"><?php  if($company['is_active']==1 && $company['disabled_id']==0) {
                                    $img="accept.png";
                                    $tit="Disable"; 
									$color="style='color:#0DAF0D;'";
                                }else{
									 $img="acces_denied_sign.png";
                                     $tit="Enable";
									 
									 $color="style='color:#ff0000;'";
                                } 
                                $link="comid=$company[id]";
                        ?>
                <a href="javascript:void(0)" > <?php /*?><img onclick="submitLink('<?=$link?>&edur')" src="images/icons/small/grey/<?=$img?>" class="edits" title="<?=$tit?>"  /><?php */?> <i onclick="submitLink('<?=$link?>&edur')" class="icon-blocked" title="<?=$tit?>" <?=$color?>></i></a> <a href="javascript:void(0)" > <?php /*?><img onclick="submitLink('<?=$link?>&edit')" src="images/icons/small/grey/pencil.png"  class="edits" title="Edit"  /><?php */?> <i onclick="submitLink('<?=$link?>&edit')"  class="icon-pencil5"  title="Edit" ></i></a></td>
            </tr>
            <?php }} ?>
          </tbody>
        </table>
</div>
</div>
</div>
</div>
</section>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>

$(function(){
			$("#updateclient_status").on("click",function () {
				
			if($('#updateclient_status').is(':checked')){
				$('#disabled_id').removeAttr('disabled');
				$('#enabled_id').removeAttr('disabled');
			}else{
				$('#disabled_id').attr('disabled','disabled');
				$('#enabled_id').attr('disabled','disabled');
			}
			
			});
			
			
			$( ".datetimepicker-month1, .datetimepicker-month2").datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1980:2050"
		});
		
		
		
			});
			
		
		
		
		
		
</script>