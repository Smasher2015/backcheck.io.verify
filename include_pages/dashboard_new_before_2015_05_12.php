<link rel="stylesheet" type="text/css" href="scripts/dslider/slidedeck.skin.css" media="screen" />
<script type="text/javascript" src="scripts/dslider/slidedeck.jquery.lite.pack.js"></script>
<script type="text/javascript" src="js/highcharts.js"></script>

			<?php include("include_pages/charts_vsst_inc.php"); ?>
			<?php
				$PTITLE = "In Progress";
				$TWHERE="v_status<>'Close'";
				include("include_pages/cases-main_inc.php");
				unset($TWHERE);
			?>
            
			<?php
				$PTITLE = "Ready for Download";
				include("include_pages/cases-main_inc.php");
			?>
                <div class="box grid_8">
                    <h2 class="box_head">By Status</h2>
                    <a href="#" class="grabber">&nbsp;</a>
                    <a href="#" class="toggle">&nbsp;</a>
                    <div class="toggle_container">
                        <div class="block" style="opacity: 1;">	
                            <?php include("include_pages/chart_prog_inc.php");?>
                        </div>
                    </div>
                </div>
                
                <div class="box grid_8">
                    <h2 class="box_head">By Download</h2>
                    <a href="#" class="grabber">&nbsp;</a>
                    <a href="#" class="toggle">&nbsp;</a>
                    <div class="toggle_container">
                        <div class="block" style="opacity: 1;">	
                            <?php include("include_pages/chart_cps_inc.php");?>
                        </div>
                    </div>
                </div>
                		
				<div class="box grid_8">
					<h2 class="box_head">Quick Invitaton</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<div class="block" style="opacity: 1;">	

                        	<form action="" method="post" <?=(isset($SUSER)?(!in_array(2,$RIGHTS)?'class="exit" onsubmit="return noAccess()"':''):'')?> >
                            <fieldset class="label_side">
                                <label for="required_field">Package<span>Select a Package</span></label>
                                <div>
                                    <select name="pkg" class="select_box req title" title="Select Your Package" onchange="getChecks(this.value)">
                                    			<option value="">---Select Package---</option>
										<?php 	$pack=$db->select("packages","*","(pkg_type=0 or user_id=$_SESSION[user_id]) AND (a_active=1 AND is_active=1)");
                                                while($package=mysql_fetch_array($pack)){ ?>
                                                    <option value="<?=$package['pkg_id']?>"><?=$package['pk_name']?></option>
                                        <?php 	} ?>
                                    </select>
                                </div>
                            </fieldset>
                            <fieldset class="label_side">
                                <label  for="name">Name<span>Applicant Name</span></label>
                                <div>
                                    <input type="text" name="name[]"  id="name" class="text req title" title="Input Applicant Name">
                                </div>
                            </fieldset>
                            <fieldset class="label_side">
                                <label  for="email">Email<span>Applicant Eamil</span></label>
                                <div>
                                    <input type="text" name="email[]"  id="email" class="text req title" title="Input Applicant Eamil">
                                </div>
                            </fieldset>
                            <div class="button_bar clearfix">
                                <button type="submit" name="quickInvitation" value="Next Step" class="next_step move send_right">Send Invitation</button>
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
                                            <th>Applicant Name</th> 
                                            <th>Status</th> 
                                            <th>Date</th> 
                                        </tr> 
                                </thead>
                                <tbody>	
									<?php $inv=$db->select("invitation","*","com_id=$COMINF[id] order by inv_date desc");
											if(mysql_num_rows($inv)>0){
                                            while($invitation=mysql_fetch_array($inv)){ ?>
                                                <tr>
                                                    <td><?php echo $invitation['name']?></td>
                                                     <td><?php if($invitation['inv_status']==1) echo 'Joined';else echo 'Invited'; ?></td>
                                                    <td><?=date("j-M-Y",strtotime($invitation['inv_date']))?></td>
                                                 </tr><?php
                                                }
											}else{ ?>
											<tr><td colspan="3" align="center">No Record Found</td></tr>
									<?php	} ?>
                               </tbody>	
                            </table>
						</div>
					</div>
				</div>

                </div>
                 
<script type='text/javascript' src='scripts/flot/excanvas.min.js'></script>
<script type='text/javascript' src='scripts/flot/jquery.flot.min.js'></script>
<script type='text/javascript' src='scripts/flot/jquery.flot.resize.min.js'></script>				