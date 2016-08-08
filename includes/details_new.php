<div id="main_container" class="main_container container_16 clearfix">
<?php $keyphrase = '1'; include 'includes/navigation.php';?>
<div class="box grid_16">
					 
                    <h2 class="box_head">Applicant: Detailed View</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<?php $data = getVerdata($_REQUEST['case']);?>
                    <div class="toggle_container">	
						<div class="block">
							<div class="columns clearfix">
							<div class="section">
                                <h1><?=$data['v_name']?></h1>
                                <div class="col_33">
									<div class="section">
										<?php echo $_REQUEST['url'];?>
                                        <p><strong>NIC:</strong> <?=$data['v_nic']?></p>
                                        <p><strong>BCD:</strong> <?=$data['v_bcode']?></p>
									</div>
								</div>
								<div class="col_33">
									<div class="section">
										<p><strong>Order Date :</strong> <?=date("j-F-Y",strtotime($data['v_date']))?></p>
                                        <p><strong>Case Status:</strong> <?=(strtolower($data['v_status'])!='close')?'In Progress':'Completed'?></p>
									</div>
								</div>
                                
                                <div class="col_33">
									<div class="section">
										<?php
                                        $tnt = countChecks("vc.v_id=$data[v_id]");
                                        $cnt = countChecks("vc.as_sent=4 AND vc.as_status='close' AND vc.v_id=$data[v_id]");
										$pbr = @($cnt/($tnt))*100;
										updateData($data['v_id'],"v_crd=1");
                                        ?>
										<p style="text-align:center"> 
												<?php 
                                                $cmts = $db->select("comments","COUNT(_mid) cnt","_mid=$data[v_id]");
                                                $cmts = mysql_fetch_assoc($cmts);
                                                if($cmts['cnt']>0) { ?>
                                                    <img src="images/icons/comment_b.png" title="You have Comments on this Check" />
                                                <?php } ?> 
                                                
												<?php
                                                $prbs = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$data[v_id] AND as_status='problem'");
                                                $prbs = mysql_fetch_assoc($prbs);					
                                                if($prbs['cnt']>0){ ?>
                                                    <img src="images/icons/warning_b.png" title="You need to submit additional information" />
                                                <?php } ?> 
                                                
                                                <?php
                                                $disp="(as_vstatus='negative' OR as_vstatus='match found' OR ";
												$disp= "$disp as_vstatus='record found' OR as_vstatus='unable to verify' OR as_vstatus='discrepancy')";
                                                $alrt = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$data[v_id] AND $disp");
                                                $alrt = mysql_fetch_assoc($alrt);					
                                                 if($alrt['cnt']>0) {?>
                                                    <img src="images/icons/discrep_b.png" title="There is a discrepancy in the applicant's record" />
                                                <?php } ?>   
                                                <?php if((strtolower($data['v_status'])=='close') && ($data['v_sent']==4)) { 
															$pdfClick = "downloadPDF('pdf.php?pg=case&case=$data[v_id]')";
															$tWhr = "a_type='pdf' AND user_id=$USERID AND v_id=$data[v_id] AND ISNULL(ext_id)";
															$acPdf = $db->select("activity","COUNT(a_type) cnt",$tWhr);
															$acPdf = mysql_fetch_array($acPdf);
															if($acPdf['cnt']>0) $PdfIcon="pdf_icn_b.png"; else $PdfIcon="PDF_download_b.png";?>	
                                                    <img onclick="<?=$pdfClick?>" title="Generate PDF" src="images/icons/<?=$PdfIcon?>">
                                                 <?php } ?>                                                                           
                                        </p>
                                        
                                        <p>
                                        	<div class="progress_bar">
                                                <div class="bar <?=($pbr==100)?'green':'yellow'?>" style="width:<?=$pbr?>%"></div>
                                        	</div>

                                            <div style="float:right;">
                                            	<?=$cnt?> of <?=$tnt?> Completed
                                                <div class="clearfix"></div>
                                            </div>
                                        </p>
									</div>
								</div>
							</div>
                           </div>
						</div>
					</div>					
				</div>
</div>

<div id="main_container" class="main_container container_16 clearfix">
				<div class="box grid_16">
					<h2 class="box_head">Checks</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">	
						<div class="block">
                     <div class="columns clearfix">
								<div class="col_50">
									<div class="section" id="checkScn">
									<?php
                                        $checks = checkDetails($data['v_id']);
										$cCheck = 0;
										$cCkTtl= '';
										while($check = mysql_fetch_assoc($checks)){
												if($cCheck==0){
													 $cCkTtl=$check['checks_title'];
													 $cCheck=$check['as_id'];
												}?>
                                        		<div onclick="getCheckData(this,<?=$check['as_id']?>,'<?=$check['checks_title']?>')">
													<?=$check['checks_title']?>
												<img src="images/icons/arrow_hd.png" class="arrow imFr" style="visibility:<?=($cCheck==$check['as_id'])?'visible':'hidden'?>" />                                                    
                                                    <?php if(strtolower($check['as_status'])=='close') $img='chk_bx.png'; else $img='box.png'; ?>
                                                        <img src="images/icons/<?=$img?>" class="imFr" />                                                   	

                                               <?php if((strtolower($check['as_status'])=='close') && ($check['as_sent']==4)) { 
															$pdfClick = "downloadPDF('pdf.php?pg=case&ascase=$check[as_id]')";
															$tWhr = "a_type='pdf' AND user_id=$USERID AND ext_id=$check[as_id]";
															$acPdf = $db->select("activity","COUNT(a_type) cnt",$tWhr);
															$acPdf = mysql_fetch_array($acPdf);
															if($acPdf['cnt']>0) $PdfIcon="pdf_icn.png"; else $PdfIcon="PDF_download_icn.png";?>	
                                                    
                                               <img onclick="<?=$pdfClick?>" title="Generate PDF" class="imFr" src="images/icons/<?=$PdfIcon?>">
                                               <?php } ?> 
                                               
													<?php 
                                                    $cmts = $db->select("comments","COUNT(_mid) cnt","_id=$check[as_id]");
                                                    $cmts = mysql_fetch_assoc($cmts);
                                                    if($cmts['cnt']>0) { ?>
                                                        <img src="images/icons/comment.png" class="imFr" title="You have Comments on this Check" />
                                                    <?php } ?> 
                                                    
                                                    <?php					
                                                    if(strtolower($check['as_status'])=='problem'){ ?>
                                                        <img src="images/icons/warning.png" class="imFr" title="You need to submit additional information" />
                                                    <?php } ?> 
                                                    
                                                    <?php
                                                    $disp= array('negative','match found','record found','unable to verify','discrepancy');				
													if(in_array(strtolower(trim($check['as_vstatus'])),$disp)) {?>
                                                        <img src="images/icons/discrep.png" class="imFr" title="There is a discrepancy in the applicant's record" />
                                                    <?php }?> 
                                                   <div class="clearfix"></div>
                                                </div>
                                    <?php } ?>
									</div>
								</div>
								<div class="col_50">
									<div class="section">
										<p>
                                        	<p id="checkT1"><?=$cCkTtl?></p>
                                        	<div id="checkInfo">
                                            		<?php if($cCheck!=0) include("include_pages/checkinfo_inc.php"); ?>
                                            </div>
                                        </p>
									</div>
								</div>
							</div>
                        </div>
                    </div>
               </div>


</div>


<div id="main_container" class="main_container container_16 clearfix">
									
					<div class="box grid_8">
					<h2 class="box_head" ><span id="checkT2"><?=$cCkTtl?></span> Documents</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">	
						<div class="block">
							<div class="section" id="checkDoc">
                            	<?php if($cCheck!=0) include("include_pages/uploaddoc_inc.php"); ?>
                            </div>
						</div>
					</div>
				</div>
				<div class="box grid_8"  style="width:48%;">
					<h2 class="box_head" ><span id="checkT3"><?=$cCkTtl?></span> Notes</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<div class="block">
							<div class="section" id="checkCmts">
                            	<?php if($cCheck!=0) include("include_pages/checkcmts_inc.php"); ?>
                            </div>
						</div>
					</div>
				</div>
	

</div>