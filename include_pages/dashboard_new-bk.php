<link rel="stylesheet" type="text/css" href="scripts/dslider/slidedeck.skin.css" media="screen" />
<script type="text/javascript" src="scripts/dslider/slidedeck.jquery.lite.pack.js"></script>
<script type="text/javascript" src="js/highcharts.js"></script>

			<?php include("include_pages/charts_vsst_inc.php"); ?>
            
			<?php include("include_pages/cases-main_inc.php")?>
            					
				<div class="box grid_8">
					<h2 class="box_head">Quick Invitaton</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<div class="block" style="opacity: 1;">	
                        	<form action="" method="post">
                            <fieldset class="label_side">
                                <label for="required_field">Package<span>Select Your Package</span></label>
                                <div>
                                    <select name="pkgg_id_case" onchange="getChecks(this.value)">
										<?php 	$pack=$db->select("packages","*","pkg_type=0 or user_id=$_SESSION[user_id]");
                                                while($package=mysql_fetch_array($pack)){ ?>
                                                    <option value="<?=$package['pkg_id']?>"><?=$package['pk_name']?></option>
                                        <?php 	} ?>
                                    </select>
                                </div>
                            </fieldset>
                            <fieldset class="label_side">
                                <label  for="required_field">Email<span>Input Applicant Eamil</span></label>
                                <div>
                                    <input type="text" name="v_email"  id="v_email" class="required text">
                                </div>
                            </fieldset>
                            <div class="button_bar clearfix">
                                <button type="submit" name="sdsds" value="Next Step" class="next_step move send_right">Send Invitation</button>
                            </div>                   
                            </form>         
						</div>
					</div>
				</div>
                
                <div class="box grid_8">
					<h2 class="box_head">Invitatons</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<div class="block" style="opacity: 1;">	
                            <table class="static"> 
                                 <thead>
                                        <tr> 
                                            <th>Applicant Email</th> 
                                            <th>Status</th> 
                                            <th>Date</th> 
                                        </tr> 
                                </thead>	
									<?php $inv=$db->select("invitation","*","com_id=$COMINF[id] order by inv_date desc");
                                            while($invitation=mysql_fetch_array($inv)){ ?>
                                                <tr>
                                                    <td><?php echo $invitation['email']?></td>
                                                     <td><?php if($invitation['inv_status']==1) echo 'Joined';else echo 'Invited'; ?></td>
                                                    <td><?=date("j-M-Y",strtotime($invitation['inv_date']))?></td>
                                                 </tr><?php
                                                }
                                      ?>	
                            </table>
						</div>
					</div>
				</div>

                <div class="box grid_8">
                    <h2 class="box_head">Statistics Graph [ Cases ]</h2>
                    <a href="#" class="grabber">&nbsp;</a>
                    <a href="#" class="toggle">&nbsp;</a>
                    <div class="toggle_container">
                        <div class="block" style="opacity: 1;">	
							<?php include("include_pages/chart_prog_inc.php");?>
                        </div>
                    </div>
                </div>

                </div>
                 
<script type='text/javascript' src='scripts/flot/excanvas.min.js'></script>
<script type='text/javascript' src='scripts/flot/jquery.flot.min.js'></script>
<script type='text/javascript' src='scripts/flot/jquery.flot.resize.min.js'></script>				