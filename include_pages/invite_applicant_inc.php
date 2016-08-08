<section class="retracted scrollable">
    <div class="row">
        <div class="col-md-12">
            <div class="manager-report-sec">
            	<!--First Step-->	
                <div class="panel panel-default panel-block" >
                    <div class="list-group-item">
                        <div class="page-section-title">
                        

                            <h2 class="box_head">Add Applicant</h2>
                        </div>
                        <form class="cstm" action="" name="" method="post" >
                        	<a class="add_field_button " href="javascript:;"><i class="icon-plus"></i> Add Applicant</a>
                            <div class="input_fields_wrap">
                            <div class="panel panel-default panel-block">
                            	<div class="list-group">
                                	<div class="list-group-item" >
                                    	<div class="form-group"><label>Applicant First Name: </label><input name="first_name[]" class="form-control" placeholder="Applicant First Name"></div>
                                            
                                            <div class="form-group"><label>Applicant Email: </label><input type="text" name="email[]" class="form-control parsley-validated parsley-error" placeholder="Applicant Email" data-parsley-type="email" data-parsley-required="true"> </div>
                                            <input type="hidden" name="ids[]" value="1">
                                            
                                         </div>
                                    </div>
                                </div>
                            </div>
							
                            <fieldset class="form-group">
                                <button type="submit" class=" btn btn-success dropdown-toggle" style="float:right;" name="inviteApplicantVerify" > <span>Verify Applicant </span> </button>
                            </fieldset>
                        </form>
                    </div>
                
                </div>
                <!--First Step-->
                 <?php /*?><!--Second Step-->
                	<div class="panel panel-default panel-block" style="display:<?php echo (is_array($UserDataEmail) && !empty($UserDataEmail) ? 'block' : 'none'); ?> ">
                    <div class="list-group-item">
                        <div class="page-section-title">
                            <h2 class="box_head">Assign Checks To Added Users</h2>
                        </div>
                        <form class="cstm" action="" name="" method="post" >
                        
                        <?php foreach($UserDataEmail as $su){?>
							<div class="panel panel-default panel-block">
                            	<div class="list-group">
                                	<div class="list-group-item" >
                                    
                                    	<div class="form-group">
                                            <label>Select User :</label>
                                            <select class="form-control" id="source" name="selectedUsers[]">
                                            <?php foreach($UserDataEmail as $user){?>
                                            	<option value="<?=$user['user_id']?>" ><?=$user['first_name']?></option>
                                            <?php }// end foreach ?>                                    
                                            </select>
                                            <input type="hidden" name="userPass[]" value="<?=$su['password']?>"  />
                                            <input type="hidden" name="userEmail[]" value="<?=$su['email']?>"  />
                                            <input type="hidden" name="userFirstName[]" value="<?=$su['first_name']?>"  />
                                		</div>
                                        <div class="form-group">
                                    		<label>Select Check(s) :</label>
                                    		<select multiple class="form-control select2 placeholder populate" name="selectedChecks[<?=$su['user_id']?>][]">
                                            	 <?php 
													 $company_id = $COMINF['id'];
													 $checks = $db->select("checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id","*","cc.com_id= $company_id AND ck.is_active=1");
													 if(mysql_num_rows($checks)>0){
						
															while($check = mysql_fetch_array($checks)){?>
																<option value="<?=$check['checks_id']?>"><?=$check['checks_title']?></option>
															<?php }
													 }
											?>
                                            </select>
                               		 	</div>
                                    		<input type="hidden" name="employeCodes[]"  value="<?=$su['employeCode']?>">
                                    
                                    </div>
                               </div>
                            </div>
                        <?php }?>
                            <fieldset class="form-group">
                                <button type="submit" class=" btn btn-success dropdown-toggle" style="float:right;" name="verifyApplicants" > <span>Verify Applicant </span> </button>
                            </fieldset>
                        </form>
                    </div>
                
                </div>
                 <!--Second Step--><?php */?>
                
            </div>
        
        
        
        	
        
        </div>
        
        
    </div>
<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="panel panel-default panel-block"><div class="list-group"><div class="list-group-item" ><div class="form-group"><label>Applicant First Name: </label><input name="first_name[]" class="form-control" placeholder="Applicant First Name"></div><div class="form-group"><label>Applicant Email: </label><input type="text" name="email[]" class="form-control parsley-validated parsley-error" placeholder="Applicant Email" data-parsley-type="email" data-parsley-required="true"></div></div></div><a href="#" class="remove_field">Remove</a></div><input type="hidden" name="ids[]" value="'+x+'">'
							); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

</script>
<!-- uniformJs -->
