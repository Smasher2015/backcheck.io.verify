<?php
//print_r($_REQUEST);
if(isset($_REQUEST['edur'])){
	if(is_numeric($_REQUEST['comid'])){
		enabdisb("company","id=$_REQUEST[comid]");
	}
}
 if(isset($_REQUEST['add'])){
	if(is_numeric($_REQUEST['comid'])){
		$data = getInfo('company',"id=$_REQUEST[comid]");
		$_REQUEST['cName'] =$data['name'];
		$_REQUEST['cEmail'] =$data['email'];
		$_REQUEST['ind'] =$data['ind_id'];
			
		$_REQUEST['cType'] = $data['type'];
		$_REQUEST['cerp'] = $data['erpid'];
		$_REQUEST['paid'] = $data['paid'];
		$_REQUEST['credits'] = $data['credits'];
		$_REQUEST['mode_of_payment'] = $data['mode_of_payment'];
		$_REQUEST['account_type'] = $data['account_type'];
		$_REQUEST['is_check_wise_pay'] = $data['is_check_wise_pay'];
		$_REQUEST['can_download_reports'] = $data['can_download_reports'];
		$_REQUEST['location_wise'] = $data['location_wise'];
		$_REQUEST['monthly_credits_allowed'] = $data['monthly_credits_allowed'];
		
		
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
		$_REQUEST['mode_of_payment'] = $data['mode_of_payment'];
		$_REQUEST['account_type'] = $data['account_type'];
		$_REQUEST['is_check_wise_pay'] = $data['is_check_wise_pay'];
		$_REQUEST['can_download_reports'] = $data['can_download_reports'];
		$_REQUEST['location_wise'] = $data['location_wise'];
		$_REQUEST['monthly_credits_allowed'] = $data['monthly_credits_allowed'];
		
		
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
		
<?php
if($_REQUEST['client_id'])
{
?>
$(document).ready(function(){
  $('.icon-plus3').trigger('click');
});
  	
<?php
}
?>	

function suspend_agreement(id)
{
	  var param = 'fedit=1&suspended_agrement=1&comp_id='+id;
 ajaxServices('actions.php',param,'response_'+id);

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
        <?php
        if(isset($_REQUEST['edit'])){
		$agreement_heading = 'Edit';
		}
        else if(isset($_REQUEST['add'])){
		$agreement_heading = 'Add';
		}
        else if(isset($_REQUEST['view'])){
		$agreement_heading = 'View';
		}
		?>
        
        
        	<h2 class="box-head"><?=$agreement_heading?> Agreement</h2>
        </div>
                    <div class="list-group">
                    
                        <div class="list-group-item">
						<?php 
						if(isset($_REQUEST['add']) || isset($_REQUEST['edit']))
						{		
						
						
						if(isset($_POST['asdxxx'])){
							 
						}
                        if(isset($_REQUEST['add'])){
							$clients_query= $db->select("company","*","is_active=1");
                                 //  print_r($clients_query);
								if($_REQUEST['client_id']){$cc = $_REQUEST['client_id'];}else{$cc = 0;} $link="comid=".$cc;
						?>
                        <form id="forgeteclients" method="post">
                        <select name="client_id"  id="client_id"  onchange="document.getElementById('forgeteclients').submit();"  class="form-control">
                        <option value="0"> --Select Client-- </option>
                        <?php
						while($clients = mysql_fetch_array($clients_query)) { 
						if($_REQUEST['comid'] == $clients['id'])
						{$selected = "selected";}else{$selected = '';} 
                                     echo '<option '.$selected.' value="'.$clients['id'].'">'.$clients['name'].'</option>';
                                     }
 									  ?>
                      </select>
                      
                      
                        </form>
                        <?php
                        }
						?>
                       <form class="cstm form-horizontal" action="" name="myformagree" method="post"  >
                          
                          <div class="row">   
                            	<div class="col-md-3"></div>
                          		<div class="col-md-9">
                           <div class="form-group">
                                <div class="col-lg-3 "><label for="cType">Client Type:</label></div>
                           			<div class="col-lg-9">
                                    <select name="cType" class="form-control" onchange="unpaid(this)" disabled="disabled">
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
                            <div class="col-lg-3 "><label for="cName" id="cnm"><?=($_REQUEST['cType']=='Individual')?'':'Client '?>Name<sup class="sreq">*</sup>:</label></div>
                            <div>
                              <div class="col-lg-9"><input class="form-control" title="Input Company Name" type="text" name="cName" value="<?=$_REQUEST['cName']?>" required disabled="disabled"></div>
                            </div>
                          </div>
						  
                           </div>
                          </div>
                          
                           <h4 class="section-title">Contract / Agreement Information</h4>
                        	                         	<div class="row">   
                            	<div class="col-md-3"></div>
                          		<div class="col-md-9">
                                <div class="form-group">
                            <div class="col-lg-3 "><label for="sdate">Effective Date:</label></div>
                            <div>
                              <div class="col-lg-9"><input class="form-control datetimepicker-month1" title="Input agreement start date" type="text" name="sdate" value="<?=$_REQUEST['sdate']?>"  disabled="disabled"></div>
                            </div>
                          </div>
                          		 
                           		<div class="form-group">
                            <div class="col-lg-3 "><label for="pterm">Payment:<span>Term in Days</span></label></div>
                            <div>
                              <div class="col-lg-9"><input class="input form-control" title="Input payment term in numbers" type="text" name="pterm" value="<?=$_REQUEST['pterm']?>"  disabled="disabled"> </div>
                            </div>
                          </div>
						  <div class="form-group">
                            <div class="col-lg-3 "><label for="pterm">Billing Account Type:</label></div>
                            <div>
                              <div class="col-lg-9">
							  
							 <select name="account_type" class="form-control" id="account_type"  disabled="disabled">
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
							  
							 <select name="mode_of_payment" class="form-control" id="mode_of_payment"  disabled="disabled">
							
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
							  
							 <select name="is_check_wise_pay" class="form-control" id="is_check_wise_pay"  disabled="disabled">
							
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
							  <input id="monthly_credits_allowed" class="form-control" title="Enter Monthly Credits Allowed" type="number" name="monthly_credits_allowed" value="<?=$_REQUEST['monthly_credits_allowed']?>" size="5"  disabled="disabled">
							
							  
							  </div>
                            </div>
                          </div>
						  
						   <div class="form-group">
                                     <div class="col-lg-3 "><label for="slab_id">Slab:</label></div>
                                    <div>
                                        <div class="col-lg-9"><select name="slab_id" id="slab_id" class="form-control"   disabled="disabled">
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
													$checked_check = array();
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
                                                                    $checked=false;
                                                                }
                                                            } 
                                                            if($checked)
															{
																$checked_check[] = $check['checks_id'];
                                                            ?>							
                                                            <li>
                                                                <a href="javascript:void(0)" class="handle">&nbsp;</a>
                                                                
                                                                <div class="content" style="padding:2px;">
                                                                    <div class="row">
                                                                    <div class="col-md-3">&nbsp;</div>
                                                                     <div class="col-md-9"><div class="form-group">
                                                                     
                                                                     <div class="col-lg-5"><label>
                                                                   <?php /*?> <input type="checkbox" name="checks[]" value="<?=$check['checks_id']?>" <?=($checked)?'checked="checked"':''?> /><?php */?>
                                                                        <?=$check['checks_title']?>
                                                                </label> </div>
                                                                     <div class="col-lg-1"><label for="cost_<?=$check['checks_id']?>">Cost:</label></div>
                                                                      <div class="col-lg-2"> <?=$check['clt_cost']?> 							
																	
																		</div>
																		<div class="col-lg-2">
																	<?php echo $record['clt_currency']; /*?><select name="clt_currency<?=$check['checks_id']?>" class="form-control" title="Select Currency" disabled="disabled">
																	<option value="PKR" <?=($record['clt_currency']=='PKR')?'selected':''?>>PKR</option>
																	<option value="USD" <?=($record['clt_currency']=='USD')?'selected':''?>>USD</option>
																	</select><?php */?>
																																	
																	</div>
																		
																		
																		
																		
                                                                    
                                                                  </div></div>                                              
                                                                   	</div>
                                                                  <div class="form-group" style="display:<?=($check['is_multi']==1)?'none':'none'?>">
                                                                    <div class="col-lg-3 "><label for="units">Units:<span># of units as per agreement</span></label></div>
                                                                    
                                                              <div class="col-lg-9"> <?=$check['clt_units']?> </div> 
                                                                   
                                                                  </div>   
                                                                   
                                                                </div>
                                                            </li>
                                                            
                                                 <?php }
												 
												 
												 
												 $rw++;}
                                                 }
												 //print_r($checked_check);
												 ?>
                                            </ul>
                                            
                                           
                                            
                                        </div>
                            </div>
                          </div>
                          
                    
                           
                          
                    <div class="clearfix"></div>
                            
                          
                            
							<h4 class="section-title">Point of Contact <span class="badge"><?=$email_from?></span></h4>
                    		<div class="row">
                            <div class="col-md-3">&nbsp;</div>
                            <div class="col-md-9">
                          <?php /*?><div class="form-group">
                            <div class="col-lg-3 "><label for="pname">Name :</label> </div>
                            <div>
                              <div class="col-lg-9"><input class="input form-control" title="Input point of contact name" type="text" name="pname" value="<?=$_REQUEST['pname']?>" ></div>
                            </div>
                          </div><?php */?>
                         <?php
						 
						 
							if(isset($_REQUEST['edit'])){	 	 
							$companies = $db->select("client_agreement_confg","*","comps_id = $_REQUEST[comid] and is_expired = '0'");
							$companyx = mysql_fetch_array($companies);
							$agr_poc = $companyx['agr_poc'];
							$agr_poc2 = $companyx['agr_poc2'];
							}
							else
							{
							$agr_poc = '';
							$agr_poc2 = '';
							}
						
						if($checked)
						{
						 
						
						 ?>
                         
                         
                          <div class="form-group">
                            <div class="col-lg-3 "><label for="cEmail">Select User # 1 </label></div>
                           
                               <div class="col-lg-9">
                               <select name="agr_poc" class="form-control" >
                                <?php  
                          $getClUser = getClUser($_REQUEST['comid']);
						  while($usersx = mysql_fetch_array($getClUser))
						  {
							  if($agr_poc == $usersx['user_id'])
							  {$selected = "selected";}else{$selected = '';}
							   echo '<option '.$selected.' value="'.$usersx['user_id'].'">'.$usersx['first_name'].' '.$usersx['last_name'].'</option>';
						  }
						  ?>
                                </select>
                               
                              <?php /*?> <input class="input form-control" title="Input point of contact email" type="email" name="cEmail" value="<?php if($email != ""){echo $email; }?>" ><?php */?>
                               </div>
                           
                          </div>
                    
                          <div class="form-group">
                            <div class="col-lg-3 "><label for="cEmail2">Select User # 2</label></div>
                           
                               <div class="col-lg-9">
                               <select name="agr_poc2" class="form-control" >
                                <?php  
                          $getClUser = getClUser($_REQUEST['comid']);
						  while($usersx = mysql_fetch_array($getClUser))
						  {
							  if($agr_poc2 == $usersx['user_id'])
							  {$selected = "selected";}else{$selected = '';}
							   echo '<option '.$selected.' value="'.$usersx['user_id'].'">'.$usersx['first_name'].' '.$usersx['last_name'].'</option>';
						  }
						  ?>
                                </select>
                               
                               
                               </div>
                           
                          </div>
                    <?php
                    	}
						else
						{
							
					?>
                    
                    <?php
                     $getClUser = getClUser($_REQUEST['comid']);
					 if(!empty($getClUser))
					 {
					?>
                    <div class="form-group">
                            <div class="col-lg-3 "><label for="cEmail">Select User # 1 </label></div>
                           
                               <div class="col-lg-9">
                               <select name="agr_poc" class="form-control" >
                                <?php  
                          //$getClUser = getClUser($_REQUEST['comid']);
						  while($usersx = mysql_fetch_array($getClUser))
						  {
							  if($agr_poc == $usersx['user_id'])
							  {$selected = "selected";}else{$selected = '';}
							   echo '<option '.$selected.' value="'.$usersx['user_id'].'">'.$usersx['first_name'].' '.$usersx['last_name'].'</option>';
						  }
						  ?>
                                </select>
                               
                              <?php /*?> <input class="input form-control" title="Input point of contact email" type="email" name="cEmail" value="<?php if($email != ""){echo $email; }?>" ><?php */?>
                               </div>
                           
                          </div>
                         <?php
					 }
					 else
					 {
						 ?> 
                          
                          
                          
                    <input type="hidden" name="newuseradd" value="yes"/>
                    <input type="text" name="agr_poc" placeholder="User Email" value="<?=$companyx['agr_receiver']?>" />
                    <?php		
						}
						}
					?>
                           
                        
                        </div>
                        </div>
						
						
						
						 
                          <?php if(isset($_REQUEST['comid'])){ ?>
                                <input type="hidden" name="comid" value="<?=$_REQUEST['comid']?>" >
                                
                               <!-- <input type="hidden" name="addcheck_agreements" value="yes" >-->
                                
                          <?php	}
						  
						  if(isset($_REQUEST['add']))
						  {
							  $buttons_name = "Send";
						   ?>
                           <input type="hidden" name="add" value="yes" >
                           <?php
						  }
						   if(isset($_REQUEST['edit']))
						   {
							   $buttons_name = "Resend";
						   ?>
                           <input type="hidden" name="edit" value="yes" >
                           <input type="hidden" name="agr_receiver" value="<?=$companyx['agr_receiver']?>" >
                           <!--<textarea name="feedback_agreement"></textarea>--> 
                           <?php
						   }
						   ?>
                            
                           
                           
                          <div class="button_bar clearfix">
                              <!--<button type="submit" class="btn btn-success has_text" style="float:right;" name="addcheck_agreements" > 
                                    <span>Save And Send </span> 
                              </button>-->
                               <button type="submit" class="btn btn-success has_text" style="float:right;" name="addcheck_agreements" > <?php //isset($_REQUEST['comid'])?'Save':'Add'?>
                                    <span> <?=$buttons_name?> </span> 
                              </button>
                           <?php /*?><?php
						  
						   if(isset($_REQUEST['edit']))
						   {
						   ?>
                            <button type="submit" class="btn btn-success has_text" style="float:right;" name="sendfeedback_mang" > 
                                    <span>Send Feedback</span> 
                              </button>
                           <?php
						   }
						   ?><?php */?>
                              
                              
                          </div>
                        </form>
                        
                        <?php
						}
						else if(isset($_REQUEST['view']))
						{$com_id = $_REQUEST['comid'];
							 $where = "com_id='".$_REQUEST['comid']."' ";
 $Q = getInfo('company',"id=$com_id");
 $agreement_confg = $db->select("client_agreement_confg","*","comps_id='".$com_id."' ");
 $data2 = mysql_fetch_assoc($agreement_confg);
 ?> <section class="retracted scrollable">
<div class="row">
  <div class="col-md-12">
    <div class="report-sec">
    <div><div class="page-header">
       		<div class="page-header-content">
        		<div class="page-title3">	
       <!-- <h3>Agreement Approval</h3>-->
     
     </div>
     </div>
     </div>
      <div class="panel panel-flat">
       <?php
       if($data2['is_suspend_active'] != 1)
	   {
	   ?>
       
        <div class="panel-body">
			 
        		<?php
				 
		
        if($data2['agr_status'] == 1 && $data2['is_send'] == 1)
		{
			$image_path = "pend.jpg";
		}
        else if($data2['agr_status'] == 2 && $data2['is_send'] == 1)
		{
			$image_path = "approv.jpg";
		}
        else if($data2['agr_status'] == 3 && $data2['is_send'] == 1)
		{
			$image_path = "rej.jpg";
		}
		else{$image_path = '';}
		
		if($image_path != '')
		{
		?>	 
         <div class="agreement_stamp">
         <img src="images/<?=$image_path?>" width="100" height="60" />
         </div>
         <?php
		}
		 ?>   
 
            
<h3 class="text-center text-semibold">MASTER SERVICES AGREEMENT BACKCHECKGROUP.COM</h3>
<p>Agreement for <b>the Supply of Employee Background Screening Services</b> (“Master Agreement”) is entered into as of the date signed below (the “<?=$Q['agsdate']?>”) by the company identified below (“<?=$COMINF['name']?>”) and <b>BACKGROUND CHECK PRIVATE LIMITED,</b>  hereafter referred to as service provider (“SERVICE PROVIDER”).</p>

<h3 class="text-center text-semibold"><u>WITNESSETH:</u></h3>
   

<p>CLIENT may be a requestor of certain employment and income verification reports from Service Provider pursuant to the terms and conditions of an Addendum entered into between CLIENT and SERVICE PROVIDER; and/or</p>
<p>CLIENT may be a furnisher of certain information who desires to provide SERVICE PROVIDER with certain data including but not limited to income and employment verification information relating to current and/or former employees and to have the SERVICE PROVIDER collect, administer and retain the data strictly on behalf of the Furnisher.</p>
<p>CLIENT wishes to obtain these services from SERVICE PROVIDER, and SERVICE PROVIDER desires to provide to CLIENT such services as further described in Section 1 below;</p>
<p>NOW, THEREFORE, CLIENT and SERVICE PROVIDER agree as follows:</p>

<ul class="list" style="list-style-type:decimal">
	<li><b><u>Designation of Services.</u></b>
    	<ul class="list" style="list-style-type:lower-alpha">
        	<li><b><u>Form of Service Addendum.</u></b>
            	<p>All services provided to CLIENT by SERVICE PROVIDER pursuant to this Master Agreement will be provided in accordance with, and will be governed by, this Master Agreement and the addendum(s) designated pursuant to Section 1(b) below (individually and collectively, “Service Addendum”). Accordingly, the Service Addendum shall include:</p>
                <ul>
               		<li>i. The effective date of the Services described under the Service Addendum and, if applicable, the term or period of time during which SERVICE PROVIDER will provide services or resources to CLIENT pursuant to the Service Addendum; and</li>
               
                <li>ii.	The description of the services or resources to be provided by SERVICE PROVIDER to CLIENT</li>
                </ul>
            
            </li>
                       <li><b><u>Election of Services.</u></b> SERVICE PROVIDER shall provide the following services as provided in the following Service Addendum:
Requestor Service Addendum
</li>
        
        </ul>
    
    </li>
    
    <li><b><u>Term.</u></b><br />
This Master Agreement will become effective on the Effective Date and will continue in full force and effect until the expiration of all Service Addendums. The term of each Service Addendum will commence on the Effective Date and will terminate on such date, if any, specified in the applicable Service Addendum (“Termination Date”). Notwithstanding the termination of a Service Addendum the terms and conditions of this Master Agreement will remain in full force and effect. In the event this Master Agreement is terminated, then all the Service Addendums shall be terminated as well. CLIENT is liable for all agreed fees and expenses incurred up to and including the date that the termination is communicated in writing to SERVICE PROVIDER.
</li>

<li><b><u>Service Fee; Invoicing.</u></b><br />
In consideration for the services provided pursuant to a Service Addendum, CLIENT shall pay to SERVICE PROVIDER such amounts as set forth in the applicable Service Addendum as may be mutually agreed between the parties.
Taxes as applicable will be charged at actual and will be borne by CLIENT.
</li>

<li><b><u>Conflicts.</u></b><br />
In the event of a conflict between the provisions of a Service Addendum and this Master Agreement, the provisions of this Master Agreement will control; provided, however, that the provisions of this Master Agreement will be so construed to give effect to the applicable provisions of the Service Addendum to the fullest extent possible. </li>
    
    <li><b><u>DISCLAIMER OF CONDITIONS AND WARRANTIES.</u></b><br />
ALL GOODS AND SERVICES ARE PROVIDED “AS IS”. EXCEPT AS EXPRESSLY PROVIDED IN AN APPLICABLE SERVICE ADDENDUM, SERVICE PROVIDER AND ITS AFFILIATES MAKE NO AND DISCLAIM ANY AND ALL CONDITIONS, WARRANTIES AND REPRESENTATIONS WITH RESPECT TO THE GOODS OR SERVICES, PROVIDED PURSUANT TO THIS MASTER AGREEMENT AND THE SERVICE ADDENDUMS, WHETHER SUCH CONDITIONS, WARRANTIES AND REPRESENTATIONS ARE EXPRESS OR IMPLIED IN FACT OR BY OPERATION OF LAW OR OTHERWISE, CONTAINED IN OR DERIVED FROM THIS MASTER AGREEMENT, ANY SERVICE ADDENDUM, ANY OTHER DOCUMENTS REFERENCED IN THIS MASTER AGREEMENT OR ANY SERVICE ADDENDUM, OR ANY OTHER MATERIALS OR COMMUNICATIONS WHETHER ORAL OR WRITTEN, INCLUDING WITHOUT LIMITATION IMPLIED CONDITIONS AND WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE AND IMPLIED CONDITIONS AND WARRANTIES ARISING FROM THE COURSE OF DEALING OR A COURSE OF PERFORMANCE WITH RESPECT TO THE ACCURACY, VALIDITY, OR COMPLETENESS OF ANY SERVICE OR REPORT, FURTHERMORE, SERVICE PROVIDER AND ITS AFFILIATES EXPRESSLY DISCLAIM THAT THE GOODS OR SERVICES WILL MEET CLIENT’S NEEDS, OR THAT SERVICES WILL BE PROVIDED ON AN UNINTERRUPTED BASIS, AND SERVICE PROVIDER AND ITS AFFILIATES EXPRESSLY DISCLAIMS ALL SUCH REPRESENTATIONS, CONDITIONS AND WARRANTIES.
</li>

<li><b><u>Limitation of Liability.</u></b><br />
Except as expressly provided in an applicable Service Addendum, SERVICE PROVIDER and its affiliates shall not be liable for any indirect, incidental, contingent, consequential, punitive, exemplary, special or similar damages, including but not limited to, loss of profits, loss of opportunity or loss of data, whether incurred as a result of negligence or otherwise, irrespective of whether service provider has been advised of the possibility of the incurrence by CLIENT of any such damages. Notwithstanding anything stated elsewhere in this Master Agreement or any Service Addendums SERVICE PROVIDER’s liability damages incurred in connection with services provided pursuant to this Master Agreement or any Service Addendum, including as a result of any negligence on the part of the SERVICE PROVIDER or its affiliates, shall not exceed three times the amount paid by client to SERVICE PROVIDER for the particular service giving rise to such damages. Further, SERVICE PROVIDER will have no liability for any cause of action against CLIENT which became known to CLIENT, or should have been known by CLIENT with reasonable investigation, within six months from the expiration or termination of this Master Agreement or applicable Service Addendum.
</li>

<li><b><u>Early Termination.</u></b><br />
SERVICE PROVIDER may terminate or suspend, upon reasonable notice, this Master Agreement and/or any and all Service Addendums or CLIENT’s right to receive any or all services under this Master Agreement and/or any Service Addendum if CLIENT fails to comply with the terms and conditions of this Master Agreement and/or Service Addendum. SERVICE PROVIDER may terminate or immediately suspend this Master Agreement and/or any and all Service Addendums or CLIENT’s right to receive any or all services under this Master Agreement and/or any Service Addendum if CLIENT fails to comply with any law applicable to the services provided to CLIENT pursuant to this Master Agreement and/or any and all Service Addendums.
</li>

<li><b><u>Binding Nature and Assignment.</u></b><br />
CLIENT may not assign or transfer this Master Agreement or any rights or obligations under this Master Agreement or any Service Addendum without the prior written consent of SERVICE PROVIDER, which may be withheld in the sole and unfettered discretion of SERVICE PROVIDER. This Master Agreement and each Service Addendum will bind and inure to the benefit of the parties and their respective successors and permitted assigns.
</li>

<li><b><u>Relationship of Parties; Affiliates.</u></b><br />
SERVICE PROVIDER is acting only as an independent contractor. Neither party shall act nor represent itself, directly or by implication, as an agent of the other. Each party shall be responsible for the direction and control of its employees, subcontractors, and/or consultants and nothing under this Master Agreement or Service Addendum shall create any relationship between the employees, subcontractors and/or consultants of SERVICE PROVIDER and CLIENT respectively. Each party shall ensure that each of its affiliates accepts and complies with all of the terms and conditions of this Master Agreement and each Service Addendum as if each such affiliate were a party to this Master Agreement and each Service Addendum.</li>

<li><b><u>Additional Documents.</u></b><br />
The parties hereto agree to execute any additional documents reasonably required to effectuate the terms, provisions and purposes of this Master Agreement and each Service Addendum.
</li>

<li><b><u>Representation of Authority; Authorization and Corporate Consents.</u></b><br />
CLIENT hereby represents and warrants to SERVICE PROVIDER that this Master Agreement and each Service Addendum has been duly executed and delivered by CLIENT and that this Master Agreement and each Service Addendum constitutes a legal, valid and binding obligation of CLIENT, enforceable against CLIENT in accordance with its terms. The signatories to this Master Agreement are duly authorized to do so by the respective parties and have all necessary corporate or legal consents to enter into this Master Agreement.
</li>
<li><b><u>Force Majeure.</u></b><br />
The SERVICE PROVIDER will not be liable to the CLIENT for any delay or non-performance of its obligations under this Master Agreement arising form an act of God, governmental act, war, fire, flood, explosion or civil commotion. Subject to the SERVICE PROVIDER notifying the CLIENT of the cause and likely duration of the cause, the performance of the SERVICE PROVIDER’s obligations, to the extent affected by the cause, shall be suspended during the period that the cause persists provided that if performance is not resumed within 30 days after that notice the CLIENT may by notice in writing terminate this Master Agreement.
</li>

<li><b><u>Entire Agreement.</u></b><br />
This Master Agreement, Service Addendums and the exhibits attached hereto and thereto constitute the final, entire, and exclusive agreement between the parties with respect to the subject matter contained herein and therein. There are no representations, warranties, understandings or agreements among the parties with respect to the subject matter contained herein and therein, which are not fully expressed in the Master Agreement, Service Addendums and the exhibits attached hereto and thereto. This Master Agreement, the Service Addendums, and the exhibits attached hereto and thereto supersede all prior agreements and understandings between the parties with respect to such subject matter.
</li>

<li><b><u>Validity.</u></b><br />
If any provision of this Master Agreement or any Service Addendum is held to be unenforceable, the remaining provisions shall be unaffected. Each provision of this Master Agreement and each Service Addendum, which provides for a limitation of liability, disclaimer of warranties, or exclusion of remedies is severable from and independent of any other provision.
</li>
<li><b><u>Choice of Law and Jurisdiction.</u></b><br />
This Master Agreement is subject to the laws and the exclusive jurisdiction of courts of the country where the SERVICE PROVIDER’s address set forth in the first paragraph is located.
</li>

</ul>


<p>Signed: <?=$data2['sender_ip']?> ON Background Check Pte Ltd, Date: <?=date("l jS \of F, Y",strtotime($data2['send_date']))?> </p>

<p>Name: Khalid Siddiqui, Title: CEO    Email:   kks@backcheckgroup.com</p>
<p>For and on behalf of Background Check Pte Ltd</p>
<p>Signed: <?=$data2['client_ip']?> ON <?=$COMINF['name']?>, Date:  <?php if($data2['app_rej_date'] != ''){echo date("l jS \of F, Y",strtotime($data2['app_rej_date']));}else {echo '-';}?> </p>
<p>Name: Authorize Person, Title: CEO    Email: <?=$COMINF['email']?> </p>
<p>For and on behalf of <?=$COMINF['name']?> </p>
<p>Effective Date: <?=date("l jS \of F, Y",strtotime($Q['agsdate']))?> </p>
<!--<p>Deployment Date: Tuesday, April 12, 2016</p>-->
<p>BY PRESSING THE SUBMIT BUTTON, I HEREBY ACKNOWLEDGE THAT I HAVE READ AND UNDERSTOOD THE INFORMATION PRESENTED ABOVE AND AGREE TO THE TERMS AND CONDITIONS SET FORTH HEREIN</p>

<h3>Backcheck.io/BackCheckGroup.com</h3>
<h3>REQUESTOR SERVICE ADDENDUM</h3>

<p>This Data Requestor Service Addendum to the Verify Direct Master Services Agreement (the “Addendum”) is effective as of the acceptance date signed below by the Service Provider. Client is identified in the BackcheckGroup.com Master Services Agreement which is dated Tuesday, April 12, 2016 (“Master Agreement’) and is herein after referred to as requestor ("<?=$COMINF['name']?>") and agrees to enter into this Addendum with <b>Background Check Pte LTd,</b> (“Service Provider”) for a web-based service designed to provide employment and income verification services ("Verification Services").</p>

<ul>
<li>
<b><u>Purpose, Scope of Services & Fees</u></b><br />
Requestor may order employment and income verification reports<b>(“Reports”)</b> from Service Provider pursuant to the terms and conditions of this Addendum.


<p>The Reports will contain information, as furnished to Service Provider by employers <b>(“Furnishers”)</b> relating to the employment and/or income verification information and other relevant data (“Verification Data”) related to the subject of the Report <b>(the “Applicant”).</b> Service Provider may modify this scope of services at any time effective upon notice to Requestor. </p>
<p>The Report will not be released to the Requestor until the authorization to disclose the Service Provider receives the Report. Each Applicant will be provided a confidential password to access and transmit the required authorization to Service Provider. </p>
<p>Requestor agrees as compensation for the Verification Services performed under this Addendum to pay to the Service Provider such sums as set forth in Annexure A attached hereto as may be amended from time to time</p>
</li>



	<li><b>Requestor Obligations</b>
		<ul>
			<li>i. Requestor acknowledges that it will comply with applicable laws, rules and regulations when using Reports provided pursuant to this Addendum.
</li>
<li>ii.	Requestor certifies that it will order and use the Reports for the purpose which was approved by the Applicant for each order and for no other purpose (“).</li>
<li>iii.	Requestor certifies it shall base its related decisions or action on its lawful policies and procedures and all local laws, statutes and regulations.</li>
<li>iv.	Requestor acknowledges and agrees that the Verification Data provided by Furnisher may be maintained and stored by Service Provider in other jurisdictions or countries. The Requestor acknowledges that the Report and any information contained therein, including the Verification Data is in the nature of confidential information. Requestor certifies that it shall hold the Report in strict confidence and not disclose the Report or any information contained therein, including the Verification Data, to any party not involved in the transaction for which the information is requested.</li>
<li>v.	Requestor certifies that it shall obtain the online consent of the Applicant prior to ordering any Report from Service Provider.</li>
<li>vi.	Requestor agrees that each time it orders a Report, the order constitutes Requestor’s reaffirmation of its certifications in Annexure C “Access Security Requirements” with respect to such Report.</li>
		</ul>
       
       
       
        
    
	</li>
    
    <li>
    <b>Other Obligations</b>
    <ul>
    <li>i. Requestor agrees it is the end-user of all Reports, and will not resell, sub-license, deliver, display, or otherwise distribute any Report, or provide any information in any Report, to any third party, except to the Applicant or as otherwise required under law. Requestor agrees that it will be responsible and liable for any actions or inactions of its agent or representative acting on its behalf with respect to requesting and obtaining the Report or accessing and/or viewing the Reports in the Service Provider system and/or using the Report or any information contained therein.</li>
    <li>ii. Requestor shall not use the data from the Report supplied by Service Provider to directly or indirectly compile, store, or maintain the data to develop its own source or database of Reports. Requestor agrees not to market the Reports through the Internet or in any other manner.</li>
    <li>iii. Service Provider may impose additional requirements in connection with Requestor orders and use of Reports in order to comply with changes in laws, to better protect the security and privacy of the information Service Provider provide or as Service Provider otherwise reasonably believes to be prudent or as required under the circumstances. Requestor agrees to comply with all such additional requirements after Requestor has received notice of them.</li>
    <li>iv. Service Provider acknowledges that it will comply with applicable laws, rules and regulations when providing and using the data provided pursuant to this Agreement.</li>
    </ul>
    </li>
    
    <li><b><u>Indemnification</u></b><br />
    Requestor shall indemnify, defend and hold harmless Service Provider and its affiliates from and against any and all claims, suits, proceedings, damages, costs, expenses (including, without limitation, reasonable attorneys’ fees and court costs) brought against, or suffered by, any third party arising or resulting from, or otherwise in connection with Requestor’s: i) use of the Reports, ii) breach of any of its representations, warranties, or agreements as stated herein, iii) NEGLIGENCE or WILLFUL misconduct and/or iv) if applicable the administration of Requestor’s hiring criteria or company policies or procedures.</li>
    
    <li><b><u>Termination</u></b><br />
     This Addendum will become effective on the date entered below by Service Provider and will continue in full force and effect until terminated by BackcheckGroup.com Notwithstanding the termination of this Service Addendum the terms and conditions of this Master Agreement will remain in full force and effect. In the event this Master Agreement is terminated, then all the Service Addendum including this Addendum shall be terminated as well. Requestor is liable for all agreed fees and expenses incurred up to and including the date that the termination is communicated in writing to Service Provider.</li>
    
    <li><b><u>Force Majeure.</u></b><br />
     The Service Provider will not be liable to the Furnisher for any delay or non-performance of its obligations under this Addendum arising form an act of God, governmental act, war, fire, flood, explosion or civil commotion. Subject to the Service Provider notifying the Furnisher of the cause and likely duration of the cause, the performance of the Service Provider’s obligations, to the extent affected by the cause, shall be suspended during the period that the cause persists provided that if performance is not resumed within 30 days after that notice the Furnisher may by notice in writing terminate this Addendum.</li>
   
    <li><b><u>Exhibits (“Annexure”):</u></b><br />
     The following exhibits are attached hereto and incorporated by reference herein.</li>
   
   <p><b>Exhibit B – Requestor Certification</b></p>
   <p><b>Exhibit C – Access Security</b></p>
   
  <p>BY PRESSING THE SUBMIT BUTTON, I HEREBY ACKNOWLEDGE THAT I HAVE READ AND UNDERSTOOD THE INFORMATION PRESENTED ABOVE AND AGREE TO THE TERMS AND CONDITIONS SET FORTH HEREIN.</p>
  
  <p>ANNEXURE A – FEES, SET UP AND IMPLEMENTATION</p>
  
  <p>ANNEXURE A –FEES</p>
  <p><b>Fees:</b></p> 
  
  <h3>Backcheck.io / Backcheckgroup.com</h3>
  <p><b>[ Note:</b> Draw a Table like This, with All Services, as soon as we Add Services it will be added into the Agreement ]</p> 
    
    
</ul>
<div class="table"><!--table start-->
	
    <table border="1" width="100%">
    	<thead>
        		<th><b>Components</b></th>
                <th><b>Description (All rates are exclusive of taxes)</b></th>
                <th><b>Jurisdiction</b></th>
                <th><b>Cost Per Check (Rupees)</b></th>
                
        </thead>
        
        <tbody>
            	<!--<tr>
              
                	<td align="center" colspan="8">A)	FOR NEW HIRING</td>
                
                </tr>	-->
                <?php
				 $clients_checks = $db->select("clients_checks","*",$where);
                while($res = mysql_fetch_array($clients_checks))
				{
					$checks = getCheck($res['checks_id']); 
				//print_r($checks);
				?>
                <tr>
                	<td><b><?=$checks['checks_title']?></b></td>
                    <td><?=$checks['checks_desc']?></td>
                    <td><?=$res['clt_currency']?></td>
                    <td><?=$res['clt_cost']?></td>
               
               </tr>
               <?php
				}
			   ?>
                 
                	
        </tbody>
        
    </table>

</div><!--table end-->

	<p>Note – I am aware that the pricing may change any moment without any notice and I agree to comply with the revised pricing prevailing at the time of placing the order.</p>
    <p>BY PRESSING THE SUBMIT BUTTON, I HEREBY ACKNOWLEDGE THAT I HAVE READ AND UNDERSTOOD THE INFORMATION PRESENTED ABOVE AND AGREE TO THE TERMS AND CONDITIONS SET FORTH HEREIN.</p>
   <span class="text-center"><h3>ANNEXURE B – REQUESTOR CERTIFICATION</h3></span>
    <span class="text-center"><h3>REQUESTOR CERTIFICATION</h3></span>
    <p>As a condition to ordering and obtaining Reports from Service Provider, Requestor agrees as follows:</p>
    
    <ul>
    	<li>You certify to Service Provider that with respect to each Report ordered from Service Provider:</li>
        <li>a.	a. You will use such Report solely for the purpose as approved by the employee. The subject of the report includes any employee who is a current employee, potential employee or ex-employee (the “Applicant”). You understand and agree that the Service Provider is not responsible for the accuracy of the content of the Report;</li>
        <li>b.	Prior to ordering the Report, or causing the Report to be ordered:
i.	You have obtained the Applicant’s authorization to obtain the Report
</li>
    </ul>
    
    
    <ul>
    	<li>You agree that all certifications and agreements herein are of a continuing nature and are intended to apply to an applicant and/or Employee Report that you order from Service Provider.</li>
    </ul>
    
    <h3>I, ON BEHALF OF THE COMPANY/I (in case of an individual Requestor) , HEREBY AGREE TO COMPLY WITH THE REQUESTOR CERTIFICATION NOTED HEREIN. I FURTHER CERTIFY THAT I HAVE DIRECT KNOWLEDGE OF THE FACTS CERTIFIED HEREIN AND AM AUTHORIZED BY THE COMPANY (in case of a company) TO AGREE TO THESE ITEMS HEREIN ON ITS BEHALF.</h3>
    
    <p>BY PRESSING THE SUBMIT BUTTON, I HEREBY ACKNOWLEDGE THAT I HAVE READ AND UNDERSTOOD THE INFORMATION PRESENTED ABOVE AND AGREE TO THE TERMS AND CONDITIONS SET FORTH HEREIN.</p>


<span class="text-center"><h3>ANNEXURE C – ACCESS SECURITY REQUIREMENTS</h3></span>
<span class="text-center"><h3>ACCESS SECURITY REQUIREMENTS</h3></span>

<p><b>It is a requirement that all end users take precautions to secure any system or device used to access Applicant credit information. To that end, the following requirements have been established:</b></p>

<p><b>Your user ID and password must be protected in such a way that this sensitive information is known only to key personnel. Under no circumstances should unauthorized persons have knowledge of your password. The information should not be posted in any manner within your facility.</b></p>

<p><b>Any system access software you may use, whether developed by your company or purchased from a third party vendor, must have your user ID and password “hidden” or embedded so that the password is known only to supervisory personnel. Each user of your system access software must then be assigned unique log-on passwords.</b></p>

<p><b>Your user ID and passwords are not to be discussed by telephone to any unknown caller, even if the caller claims to be an employee.</b>
</p>

<p><b>The ability to obtain credit information must be restricted to a few key personnel.</b></p>   
<p><b>Any terminal devices used to obtain credit information should be placed in a secure location within your facility. Access to the devices should be difficult for unauthorized persons.</b></p>  

<p><b>Any devices/systems used to obtain Applicant reports should be turned off and locked after normal business hours, when unattended by your key personnel.</b></p>    

<p><b>Hard copies and electronic files of Applicant reports are to be secured within your facility and protected against release or disclosure to unauthorized persons.</b></p>   

<p><b>Hard copy Applicant reports are to be shredded or destroyed, rendered unreadable, when no longer needed and when it is permitted to do so by applicable regulations(s).</b></p>

<p><b>Electronic files containing Applicant report data and/or information will be completely erased or rendered unreadable when no longer needed and when destruction is permitted by applicable regulation(s).</b></p>
            <p><b>Software cannot be copied. Software is issued explicitly to you solely to access reports for permissible purposes.</b></p>
            
            <p><b>Your employees will be forbidden to attempt to obtain credit reports on themselves, associates or any other persons, except in the exercise of their official duties.</b></p>
            
            <p>I, ON BEHALF OF THE COMPANY, HEREBY AGREE TO COMPLY WITH THE ACCESS SECURITY REQUIREMENTS NOTED HEREIN. I FURTHER CERTIFY THAT I HAVE DIRECT KNOWLEDGE OF THE FACTS CERTIFIED HEREIN AND AM AUTHORIZED BY THE COMPANY TO AGREE TO THESE ITEMS HEREIN ON ITS BEHALF.</p>
            <p>BY PRESSING THE SUBMIT BUTTON, I HEREBY ACKNOWLEDGE THAT I HAVE READ AND UNDERSTOOD THE INFORMATION PRESENTED ABOVE AND AGREE TO THE TERMS AND CONDITIONS SET FORTH HEREIN</p>
            
        </div>
       <?php
	   }
	   else
	   {
		   echo "<font color='#FF0000'>Your Agreement Have Suspended By BCG. For Further information please contact.</font>";
	   }
	   ?>
        
      </div>
    </div>
                        <?php  //print_r($for_buttons);
				 if(!empty($data2) && $data2['is_suspend_active'] != 1 && $data2['agr_status'] != 2 && $data2['agr_status'] != 3 && $data2['is_send'] == 1)
				 {
				 ?>
                  <div>
                  
                   
                  	<input type="button" name="acceptgreement_forview" class="btn bgc-success btn-xs "  value="Accept" />
                  	<input type="button" name="rejectagreement_forview" class="btn bgc-red btn-xs mr-5"  value="Reject" />
                  
                  </div>
        		<?php
				 }
				  
				?>
  

    
  </div>
</div>
</div>
</section>
<?php
						}
						?>
                        
                        
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
<h2 class="box-head">Agreement Listing </h2><!--
<a href="?action=client&atype=add/edit&addnew"><button  class="btn btn-success has_text"   title="Add New Client" ><span><i class="icon-plus3"></i></span></button></a>-->
<?php if($_REQUEST['client_id']){$cc = $_REQUEST['client_id'];}else{$cc = 0;} $link="comid=".$cc; ?>
<?php  ?><a href="javascript:void(0)" > <i onclick="submitLink('<?=$link?>&add')"  class="icon-plus3"  title="Add New" ></i></a><?php  ?>
                    </div>
       <table class="table table-bordered table-striped" id="tableSortable">
          <thead>
            <tr>
              
              <th>Company Name</th>
              <th>Active</th>
              <th>Agreement Status</th>
               <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php	
			if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){
					$dWhere="id=20";
			}else $dWhere="1=1";	
	 $tabl = "client_agreement_confg as cagr INNER JOIN company as c ON cagr.comps_id=c.id";
	//$cols = "cm.com_title,cm.com_text,cm.com_date,ur.uimg,ur.first_name,ur.last_name,cm._id,vd.v_id";
	$companies = $db->select($tabl,"*","c.is_active=1 and cagr.is_expired = 0 ORDER BY cagr.agrID ");

			//$companies= $db->select("company","*","$dWhere ORDER BY `id` DESC");
			if(mysql_num_rows($companies)>0){
			while($company = mysql_fetch_array($companies)){ ?>
            <tr class="gradeX">
             
              <td><?=$company['name']?></td>
              <td id="response_<?=$company['id']?>">
			  <?php if($company['is_suspend_active'] == "1"){echo "Suspended";}else{echo "Active";}?>
              </td>
              <td>
			  <?php if($company['agr_status'] == "1"){echo "Waiting For Approval";}else if($company['agr_status'] == "2"){echo "Agreement Approved";}else if($company['agr_status'] == "3"){echo "Agreement Rejected";}
			  else{echo 'Pending';}?>
			  </td>
              
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
                 <a href="javascript:void(0)" > <i onclick="suspend_agreement('<?=$company['id']?>')"  class="icon-blocked"  title="Suspend" ></i></a>
                 <a href="javascript:void(0)" > <i onclick="submitLink('<?=$link?>&edit')"  class="icon-pencil5"  title="Edit" ></i></a>
                 <?php /* ?><a href="javascript:void(0)" > <i onclick="submitLink('<?=$link?>&view')"  class="icon-eye2"  title="View" ></i></a><?php */ ?>
                 </td>
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
/*			$("#updateclient_status").on("click",function () {
				
			if($('#updateclient_status').is(':checked')){
				$('#disabled_id').removeAttr('disabled');
				$('#enabled_id').removeAttr('disabled');
			}else{
				$('#disabled_id').attr('disabled','disabled');
				$('#enabled_id').attr('disabled','disabled');
			}
			
			});
*/			
			
			$( ".datetimepicker-month1, .datetimepicker-month2").datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1980:2050"
		});
		
		
		
			});
			
		
		
function submitLink2(strLink){
 
	var frm = document.createElement("form");
 	frm.method = "post"
 	frm.style.display = "none";



	document.body.appendChild(frm);



	var params = strLink.split('&');







	for(var ind=0; ind<params.length;ind++){



		var input = document.createElement("input");



		var iVal = params[ind].split('=')



		input.name=iVal[0];



		if(iVal.length>1){



			  input.value=params[ind].split('=')[1];



		}else input.value='';



		input.type = "hidden"	



		frm.appendChild(input);



	}



	frm.submit();



}


		
		
		
</script>