<?php 
  if(isset($error) and $error != "No"){ ?>
                <div class="block">
       <div class="alert  alert_red">
         <img height="24" width="24" src="images/icons/small/white/alarm_bell.png">
         <?php echo $error; ?>
         </div>
                                    </div>
                <?php } ?>
                                             <?php 
  if(isset($success) and $success != ""){ ?>
                <div class="block">
       <div class="alert  alert_green">
         <img height="24" width="24" src="images/icons/small/white/alarm_bell.png">
         <?php echo $success; ?>
         </div>
                                    </div>
                <?php } ?>
             <div class="box grid_16">
						<h2 class="box_head">Edit Package</h2>
						<a href="#" class="grabber">&nbsp;</a>
						<a href="#" class="toggle">&nbsp;</a>
						<div class="toggle_container">
							<div class="block">
								<h2 class="section">
                                <?php 
								$chc=$db->select("packages","*","pkg_id=$_REQUEST[pkg_id]");
											$ch_na=mysql_fetch_array($chc);
											echo $ch_na['pk_name'];
								?>
                                </h2>
								
						<form class="validate_form" method="post">
									 
								<fieldset class="label_side">
										
											<label for="required_field">Checks</label>
											
												
                                                <div class="uniform"> 
                                                	      
                                                     <?php 
													 $ch=$db->select("checks","*","is_active=1");
													// $ch=mysql_query("select * from checks where is_active=1");
												   while($checks=mysql_fetch_array($ch)){
													   
													   $chck_pack=$db->select("package_items","*","checks_id=$checks[checks_id] and pkg_id=$_REQUEST[pkg_id]");
													   $check_pacakage=mysql_num_rows($chck_pack);
												?>
                                          
                                <label for="<?=$checks['checks_id']?>">
                                <div class="checker" id="uniform-<?=$checks['checks_id']?>">
									<span class="">
<input name="checks[]"  type="checkbox" id="required_field<?=$checks['checks_id']?>" value="<?=$checks['checks_id']?>"  style="opacity: 0;"  class="required text" <?php if($check_pacakage>0) {?> checked="checked" <? }?>></span>
                    			</div> <span class="tooltip" title="<?=mb_convert_encoding($checks['checks_title'], 'HTML-ENTITIES','UTF-8')?>"><?=mb_convert_encoding($checks['checks_title'], 'HTML-ENTITIES','UTF-8')?></span>
                                </label>
                            
                                                  
                                             
                                <!--<div class="required_tag tooltip hover left" title="This field is required"></div>-->
                                                     
                                                      <?php }?>
                                                      </div>  
                                               
											
										</fieldset>
                                        <div class="button_bar clearfix">
									<!--	<button class="next_step move send_right" data-goto="step_2">
											<img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/bended_arrow_right.png">
											<span>Next Step</span>
										</button>-->
                                        <button type="submit" class="next_step move send_right" name="edit_package"  id="normForm" />Edit Package</button>
									</div>
                                    </form>
							</div>
						</div>
					</div>
                  </div>
 
             <script type="text/javascript">
	$(".validate_form").validate();
</script>

