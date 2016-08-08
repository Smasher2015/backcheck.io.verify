<?php 	if(is_numeric($_REQUEST['case'])){ ?>
<style type="text/css">
.checksSec{
	padding:0 5px;
}
.checksSec span{
	padding-top:8px;
	display:inline-block;
}
.checksSec:hover{
	background:#E6ECEF;
	cursor:pointer;
}

.searchEle .status{
	float:right;
	height:22px;
}


.searchEle .pointer{
	cursor:pointer;
}


.bigimgs .imBg{
	width:40px;
	height:40px;
}

</style>
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
										<?php
											$tcheck = $db->select('ver_checks','*',"v_id=$_REQUEST[case]");
											$tcheck = mysql_fetch_assoc($tcheck);
											$cominfo = getcompany($data['com_id']);
											$cominfo = mysql_fetch_assoc($cominfo);
											$mngr = getUserInfo($data['v_mngr']);
										?>
                                        <p><strong>Tracking#:</strong> <?=bcplcode($data['v_id'])?></p>                                    
                                        <p><strong>ID#:</strong> <?=$data['emp_id']?></p>
                                        <?php  if($cominfo['id']==37){?>
                                        <p><strong>Reference ID#:</strong> <?=$data['v_refid']?></p>
                                        <?php } ?>
                                        <p><strong>NIC:</strong> <?=$data['v_nic']?></p>
                                        <p><strong>BCD:</strong> <?=$data['v_bcode']?></p>
									</div>
								</div>
								<div class="col_33">
									<div class="section">
                                        <p>&nbsp;</p>
										<p><strong>Client name:</strong> <?=$cominfo['name']?></p>
                                        <p><strong>Order Date :</strong> <?=date("j-F-Y",strtotime($data['v_date']))?></p>
                                        <p><strong>Case Status:</strong> 
											<?=$data['v_rlevel']?> 
											[ <?=(strtolower($data['v_status'])!='close')?'In Progress':'Completed'?> ]
                                         </p>
									</div>
								</div>
                                
                                <div class="col_33">
									<div class="section">
										<div style="min-height:50px;">
										<?php
										if($LEVEL==4){
											updateData($data['v_id'],"v_crd=1");
										}
                                        $tnt = countChecks("vc.v_id=$data[v_id] AND as_isdlt=0");
                                        $cnt = countChecks("vc.as_status='close' AND vc.v_id=$data[v_id] AND as_isdlt=0");
										$pbr = @($cnt/($tnt))*100;
                                        ?>
										<p style="text-align:center" class="bigimgs"> 
												<?php 
                                                $cmts = $db->select("comments","COUNT(_mid) cnt","_mid=$data[v_id]");
                                                $cmts = mysql_fetch_assoc($cmts);
                                                if($cmts['cnt']>0) { ?>
                                                    <img src="images/icons/comment_b.png" title="You have Comments on this Check" class="imBg" />
                                                <?php } ?> 
                                                
												<?php
                                                $prbs = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$data[v_id] AND as_status='problem' AND as_isdlt=0");
                                                $prbs = mysql_fetch_assoc($prbs);					
                                                if($prbs['cnt']>0){ ?>
                                                    <img src="images/icons/warning_b.png" title="You need to submit additional information" class="imBg" />
                                                <?php } ?> 
                                                
                                                <?php
													$red="(as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found' OR as_vstatus='unsatisfactory')";
													$red = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$data[v_id] AND $red AND as_isdlt=0");
													$red = mysql_fetch_assoc($red);
																	
													$disp = "(as_vstatus='unable to verify' OR as_vstatus='discrepancy' OR as_vstatus='original required')";
													$disp = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$data[v_id] AND $disp AND as_isdlt=0");
													$disp = mysql_fetch_assoc($disp);					
                                                 if($disp['cnt']>0) {?>
                                                    <img src="images/icons/discrep_b.png" title="There is a discrepancy in the applicant's record" class="imBg" />
                                                <?php } ?>   
                                                <?php if((strtolower($data['v_status'])=='close') && ($data['v_sent']==4 || $LEVEL==2)) { 
															$vname= addslashes($data['v_name']);
															$pdfClick = "downloadPDF('pdf.php?pg=case&case=$data[v_id]')";
															
															$certClick = "downloadPDF('pdf.php?pg=certificate&id=$data[v_id]&name=$data[v_name]')";
															
															$rptLink = "showAuto('report','$vname','case=$data[v_id]',20)";
															$tWhr = "a_type='pdf' AND user_id=$USERID AND v_id=$data[v_id] AND ISNULL(ext_id)";
															$acPdf = $db->select("activity","COUNT(a_type) cnt",$tWhr);
															$acPdf = mysql_fetch_array($acPdf);
															if($acPdf['cnt']>0) $PdfIcon="pdf_icn.png"; else $PdfIcon="PDF_download_icn.png";?>	
                                                    <img style="cursor:pointer" onclick="<?=$rptLink?>"  title="View Report" class="imBg"  src="img/report_view.png">
                                                    <img style="cursor:pointer" onclick="<?=$pdfClick?>" title="Generate PDF" class="imBg" src="images/icons/<?=$PdfIcon?>">
                                                    
                                                    <?php 
													//$vSts = vs_Status(strtolower($data['v_rlevel']));
													if(isset($_REQUEST['certificate']) && ($disp['cnt']==0 && $red['cnt']==0)){ ?>
                                                    	<img style="cursor:pointer" onclick="<?=$certClick?>" title="Generate Certificate" class="imBg" src="images/certificate.png?>">	
                                                    <?php }?>
                                                    
                                                 <?php } ?>                                                                           
                                        </p>
                                        </div>
                                        <p>
                                        <div class="progress_bar" style="width:100%;height:26px;">
                                            <span style="margin:2px 0 0 40%;"><?=round($pbr,2)?>%</span>
                                            <div class="bar <?=(($red['cnt']>0)?'red':(($disp['cnt']>0)?'yellow':'green'))?>" style="width:<?=$pbr?>%;height:26px;"></div>
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

<div class="box grid_16">
            <h2 class="box_head">Checks</h2>
            <a href="#" class="grabber">&nbsp;</a>
            <a href="#" class="toggle">&nbsp;</a>
            <div class="toggle_container">	
                <div class="block">
                    <div class="section" >  
                        <ol class="searchEle">
                            <?php
                                if($LEVEL==3) $eCl="user_id=$_SESSION[user_id]"; else $eCl="";
                                $checks = checkDetails($data['v_id'],'',$eCl);
                                while($check = mysql_fetch_assoc($checks)){
									$rptLink = "showAuto('report','$check[checks_title]','ascase=$check[as_id]',20)";
									$startCs=($LEVEL==4)?"javascript:void(0)":"?action=start&ascase=$check[as_id]&_pid=$_REQUEST[_pid]";
									if(is_numeric($check['user_id'])){
										$userInfo = getUserInfo($check['user_id']);
										$analyst="<strong>Analyst : </strong> $userInfo[first_name] $userInfo[last_name]";
									}else $analyst=""; ?>
                                        <li style="height:30px">
                                           	<a href="<?=$startCs?>">
                                           		 <span><?=$check['checks_title']?></span>
                                           	</a>
                                            <span style="margin-left:20px;">
                                                 <?=$analyst?>
                                                 <strong> Status : </strong> <?=$check['as_vstatus']?> [ <?=$check['as_status']?> ]                                            
                                            </span>
                                            <span class="status" title="Search Status" style="float:right" >                                                  
                                            <?php 
                                            $cmts = $db->select("comments","COUNT(_mid) cnt","_id=$check[as_id]");
                                            $cmts = mysql_fetch_assoc($cmts);
                                            if($cmts['cnt']>0) { ?>
                                                <img style="width:22px; height:22px;" src="images/icons/comment.png" class="imFr" title="You have Comments on this Check" />
                                            <?php } ?> 
                                            <?php					
                                            if(strtolower($check['as_status'])=='problem'){ ?>
                                                <img style="width:22px; height:22px;" src="images/icons/warning.png" class="imFr" title="You need to submit additional information" />
                                            <?php } ?> 
                                            <?php
                                            $disp= array('unable to verify','discrepancy','original required');				
                                            if(in_array(strtolower(trim($check['as_vstatus'])),$disp)) {?>
                                                <img style="width:22px; height:22px;" src="images/icons/discrep.png" class="imFr" title="There is a discrepancy in the applicant's record" />
                                            <?php }?> 
                                            <?php if((strtolower($check['as_status'])=='close') && ($check['as_sent']==4 || $LEVEL==2)) { 
                                                    $pdfClick = "downloadPDF('pdf.php?pg=case&ascase=$check[as_id]')";
                                                    $tWhr = "a_type='pdf' AND user_id=$USERID AND ext_id=$check[as_id]";
                                                    $acPdf = $db->select("activity","COUNT(a_type) cnt",$tWhr);
													
                                                    $acPdf = mysql_fetch_array($acPdf);
                                                    if($acPdf['cnt']>0) $PdfIcon="pdf_icn.png"; else $PdfIcon="PDF_download_icn.png";?>	
                                            <img style="cursor:pointer;width:22px; height:22px;" onclick="<?=$rptLink?>"  title="View Report" class="imFr"  src="img/report_view.png">
                                            <img style="cursor:pointer;width:22px; height:22px;" onclick="<?=$pdfClick?>" title="Generate PDF" class="imFr" src="images/icons/<?=$PdfIcon?>">
                                            
                                            
                                            <?php if(isset($_REQUEST['certificate']) && $data['com_id']==49 && $check['checks_id']==1 && ($disp['cnt']==0 && $red['cnt']==0)){
														$certClick = "downloadPDF('pdf.php?pg=certificate_ed&id=$data[v_id]&name=$data[v_name]')"; ?>
                                                    	<img style="cursor:pointer;width:22px; height:22px;" onclick="<?=$certClick?>" title="Generate Certificate" class="imBg" src="images/certificate.png?>">	
                                           <?php } ?>
                                            
                                       <?php } ?>
                                       <?php if(strtolower($check['as_status'])=='close') $img='chk_bx.png'; else $img='box.png'; ?>
                                            <img style="width:22px; height:22px;" src="images/icons/<?=$img?>" class="imFr" />
                                            </span>
                                           
                                        </li>
                            <?php } ?>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
</div>
<?php 	} ?>
