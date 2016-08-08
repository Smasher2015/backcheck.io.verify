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

</style>

<section class="retracted scrollable">
    <?php //print_r($UserDataEmail); print_r($UserDataEmail).' xxx';echo '<br><br><br>';  print_r($_REQUEST).' ssss'; ?>
   
        <script>
		$( document ).ready(function() {
			 <?php if(!empty($UserDataEmail)){
		?>
		$("#steps-uid-0-p-0").hide();
		$("#steps-uid-0-p-1").show();

		$("#steps-uid-0-p-0").removeClass("current");
		$("#steps-uid-0-p-1").addClass("current");

		$("#steps-uid-0-t-0").attr('href', '#');

		
		$(".wizard .first").attr('aria-disabled', true)
		$(".wizard .first").attr('aria-selected', false)
 		$(".wizard .first").removeClass("current");
		
		
		$(".wizard .last").addClass("current");
		 $(".wizard .last").attr('aria-disabled', false)
		$(".wizard .last").attr('aria-selected', true)
		$(".wizard .last a").css('background', '#fb6e52')

   //background: #fb6e52;
/*<ul role="tablist"><li role="tab" class="first current" aria-disabled="false" aria-selected="true"><a id="steps-uid-0-t-0" href="#steps-uid-0-h-0" aria-controls="steps-uid-0-p-0"><span class="current-info audible">current step: </span><span class="number">1</span> Add Applicant</a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="steps-uid-0-t-1" href="#steps-uid-0-h-1" aria-controls="steps-uid-0-p-1"><span class="number">2</span> Assign Checks</a></li></ul>
*/		 
  <?php
		
		}else{
		?>
		$("#steps-uid-0-p-0").show();
		$("#steps-uid-0-p-1").hide();

		$("#steps-uid-0-p-0").addClass("current");
		$("#steps-uid-0-p-1").removeClass("current");
 <?php
			 }?>
});
		
		</script>
       
        
    <div class="page-header">
    <div class="page-header-content">
        <div class="page-title2">
        	<h1> Add Applicant</h1>
        </div>
          <!--<div class="heading-elements">
							<div class="heading-btn-group">
					          <a href="javascript:;" class="btn btn-link btn-float has-text" data-toggle="modal" data-target="#openticket"><i class="icon-ticket text-primary"></i> <span>New Support</span></a>
                               <a href="javascript:;" class="btn btn-link btn-float has-text LiveHelpButton" id="LiveHelpStatusDefault" name="LiveHelpStatusDefault"><i class="icon-bubbles6 text-primary LiveHelpStatus" id="LiveHelpStatusDefault"></i><span>Live chat</span></a>                               
							</div>
						</div>-->
                        <?php
                        include("headers_right_menu_inc.php");
						?>
        
    </div>
</div>
    
    <div class="content">
        <div>
            <div>
            	<!--First Step-->
                <div class="panel panel-white">
                        
                    <div class="panel-body">
                    	<div class="steps-basic" action="#">
                 	<h6>Add Applicant</h6>
                    
                    <fieldset style="display:<?php if(!empty($UserDataEmail)){echo 'none';}else{echo 'block' ; }?> ">
                    	<div class="stepy_border border-grey">
                        	<form class="cstm" action="" name="" method="post" >
                           
                                	<div class="row">
									<?php $selNonInvite = $db->select("users","*","level_id=5 AND com_id=$COMINF[id] AND is_responed=0 AND invited=0");
									$NonInvcnt = (@mysql_num_rows($selNonInvite));
									if($NonInvcnt){
										$c=0;
									while($rs = @mysql_fetch_assoc($selNonInvite)){
										$c++;
										?>
										<h2>Applicant # <?php echo $c;?></h2>
									<div id="formsec">
                                    	<div class="col-md-6">
                                        <div class="form-group">
                                        	<label>First Name: </label>
                                            <input name="first_name[]" class="form-control" value="<?php echo $rs['first_name'];?>"  required></div>
                                          </div>
                                          <div class="col-md-6">  
                                            <div class="form-group"><label>Last Name: </label><input name="last_name[]"  class="form-control" value="<?php echo $rs['last_name'];?>" required></div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group"><label>Email Address: </label><input type="email" name="email[]" class="form-control parsley-validated parsley-error" data-parsley-type="email" data-parsley-required="true" value="<?php echo $rs['email'];?>" required > </div>
                                           </div>
                                            <input type="hidden" name="ids[]" value="<?php echo $c;?>">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                            	<label for="emp-code">Employee Code :</label>
                                            	<input type="text" name="employeCode[]"  class="form-control"  value="<?php echo $rs['emp_code'];?>" >
                                            </div>
                                            </div>
                                            </div>
									<?php }
									}else{?>
									<div id="formsec">
                                    	<div class="col-md-6">
                                        <div class="form-group">
                                        	<label>First Name: </label>
                                            <input name="first_name[]" class="form-control"   required></div>
                                          </div>
                                          <div class="col-md-6">  
                                            <div class="form-group"><label>Last Name: </label><input name="last_name[]"  class="form-control"  required></div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group"><label>Email Address: </label><input type="email" name="email[]" class="form-control parsley-validated parsley-error" data-parsley-type="email" data-parsley-required="true"  required > </div>
                                           </div>
                                            <input type="hidden" name="ids[]" value="1">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                            	<label for="emp-code">Employee Code :</label>
                                            	<input type="text" name="employeCode[]"  class="form-control"   >
                                            </div>
                                            </div>
                                            </div>
									
									<?php }	?>
                                            <div class="input_fields_wrap">
                            				</div>
                                            
                                            
                                            <div class="col-md-12">
                                             <div class="form-group">
                                <button type="submit" class="btn bg-success pull-right ml-10 dropdown-toggle" name="addApplicantVerify" ><i class="  icon-arrow-right14 position-left"></i> Add Applicant</button>
                                <a class="btn bg-info-400 pull-right" id="add_field_button" href="javascript:;"><i class="icon-user-plus position-left"></i> Add More Applicant</a>
                            </div>
                            </div>
                                            
                                         </div>
                             
                           
                        </form>
                        </div>
                        
                    </fieldset>
                   
                    <h6>Assign Checks</h6>
                    <fieldset style="display:<?php echo (is_array($UserDataEmail) && !empty($UserDataEmail) ? 'block' : 'none'); ?> ">
                    	<form class="cstm" action="" name="" method="post" >
                        
                        <?php 
						$cc=0;
						foreach($UserDataEmail as $su){
							$cc++;?>
							<div class="panel panel-default panel-block">
                            	<div class="list-group">
                                	<div class="list-group-item" >
                                    
                                    	<div class="form-group">
                                            <label>Applicant # <?php echo $cc;?>:</label>
                                           <h2><?=$su['first_name']?></h2>
											<input type="hidden" name="selectedUsers[]" value="<?=$su['user_id']?>"  />
                                            <input type="hidden" name="userPass[]" value="<?=$su['password']?>"  />
                                            <input type="hidden" name="userEmail[]" value="<?=$su['email']?>"  />
                                            <input type="hidden" name="userFirstName[]" value="<?=$su['first_name']?>"  />
                                		</div>
                                        <div class="form-group">
									 <div class="col-md-4">
									
                                    	<label>Select Check(s) :</label>
										
                                    		
                                            	 <?php 
													 $company_id = $COMINF['id'];
													 $checks = $db->select("checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id","*","cc.com_id= $company_id AND ck.is_active=1 AND cc.clt_active=1 ORDER BY ck.checks_id");
								if(mysql_num_rows($checks)>0){
						
								while($check = mysql_fetch_array($checks)){?>
								<div class="mb-20"><label><input type="checkbox" name="selectedChecks[<?=$su['user_id']?>][]" value="<?=$check['checks_id']?>" checked class="styled chkBox" onchange="disableInpBox(this,<?=$cc?>);"> <?=convertUCWords($check['checks_title'])?></label></div>
																
								<?php } 
								
								$getClientPkgChecks = getClientPkgChecks($COMINF['id']);
							$cicChecks =array(39,40,41);
							$ccc=0;
							foreach($getClientPkgChecks['checks_ids'] as $CHKS){
							
							if(in_array($CHKS,$cicChecks)){
							$ccc++;	
							}	
							}
							if($ccc < 3){
								?>
								<div class="mb-20"><label ><input type="checkbox" name="is_cic[<?=$su['user_id']?>][]" value="1"  class="styled" > <span data-popup="tooltip" data-trigger="hover" data-container="body" data-placement="bottom" data-original-title="Add CIC check for this applicant.">Criminal Intelligence Check (Optional)</span></label></div>				 
							<?php }
								}	?>
                                           
                               		 	
										</div>
										 <div class="col-md-4">
									
                                    	<label>Qty :</label>
										
                                    		
                                            	 <?php 
													 $company_id = $COMINF['id'];
													 $checks = $db->select("checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id","*","cc.com_id= $company_id AND ck.is_active=1 AND cc.clt_active=1 ORDER BY ck.checks_id");
													 if(@mysql_num_rows($checks)>0){
						
													while($check = @mysql_fetch_array($checks)){?>
								<div class="mb-10"><input  type="number" name="number_of_checks[<?=$su['user_id']?>][]" value="1" min="1" max="4"   <?php echo ($check['is_multi']==1)?'':'readonly';?> class="form-control inpBox_<?=$check['checks_id'].'_'.$cc?>"></div>
																
															<?php }
													 }
											?>
                                           
                               		 	
										</div>
										<div class="clear"></div>
										</div>
										
                                    		<input type="hidden" name="employeCodes[]"  value="<?=$su['employeCode']?>">
                                    
                                    </div>
                               </div>
                            </div>
                        <?php }?>
                            <div class="form-group">
                                <button type="submit" class=" btn btn-success dropdown-toggle" style="float:right;" name="verifyApplicants" > <span>Invite Applicant </span> </button>
                            </div>
                        </form>
                    
                    </fieldset>
                    
                	</div>
                      
                        
                    </div>
                
                </div>
                <!--First Step-->
                 <!--Second Step-->
                	
                 <!--Second Step-->
                
            </div>
        
        
        
        	
        
        </div>
        
        
    </div>
<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $("#add_field_button"); //Add button ID
    
    var x = <?php echo ($NonInvcnt>0)?$NonInvcnt:1;?>; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div id="formsec"><h2>Applicant # '+x+'</h2><div class="col-md-6"><div class="form-group"><label>First Name: </label><input name="first_name[]" class="form-control" required></div></div><div class="col-md-6"><div class="form-group"><label>Last Name: </label><input name="last_name[]"  class="form-control" required></div></div><div class="col-md-6"><div class="form-group"><label>Email: </label><input type="email" name="email[]" class="form-control parsley-validated parsley-error" data-parsley-type="email" data-parsley-required="true" required></div></div><div class="col-md-6"><div class="form-group"><label for="emp-code">Employee Code :</label><input type="text" name="employeCode[]"  class="form-control" onkeyup="this.value=this.value.replace(/[^\d]/,"");" ></div></div> <a href="#" class="remove_field">Remove</a></div><input type="hidden" name="ids[]" value="'+x+'">'
							); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });
	
	
	/* $(".chkBox").each(function(){
		 if($(this).is(":checked") == true){
		$(".inpBox_"+$(this).val()).removeAttr('disabled');	 
		 }else{
		if($(this).val()==$(".inpBox_"+$(this).val()).val()){
		$(".inpBox_"+$(this).val()).attr('disabled');	
		}
		 }
		
	});	 */
	
});

function disableInpBox(ths,idd){
	
	 if($(ths).is(":checked") == true){
		
	$(".inpBox_"+$(ths).val()+'_'+idd).removeAttr('disabled');	 
	 }else{
	
	$(".inpBox_"+$(ths).val()+'_'+idd).attr('disabled','disabled');	 
	 }
	
}

</script>
<!-- uniformJs -->
