<?php 

//if($numChkes>0){ 
$fnos=$fnos+1;
?>

<?php while($asData = mysql_fetch_array($asDatas)){ 
		
		
 
                                        $data = getData($asData['as_id'],"dmain");
                                        if(mysql_num_rows($data)>0){
                                            $data = mysql_fetch_array($data);
                                            //echo $data['d_value'];
                                        }else{
                                            $data = $db->select("fields_maping","fl_title","fl_key='dmain' AND checks_id=$asData[checks_id] AND t_id=-1");
                                            $data = mysql_fetch_array($data);
                                            //echo $data['fl_title'];
                                        }
                              
                                        $vStatus = strtolower(trim($asData['as_vstatus']));
                                        $vSts = vs_Status($vStatus);
                                  
                                        $nos=0;
										$counter=-1;
                                        for($i=-1; $i<12; $i++){
										
														if($i==0){
													  $proofs = getData($asData['as_id'],"file");	
														$abc="";
														}else{
															
														$counter++;	
															
													  $proofs = getData($asData['as_id'],"file$i");	
													  
													  if($asData['checks_id']==39){
														$abc="-A"; 
													
													  }
													  if($asData['checks_id']==41){
														$abc="-B";
																											
													  }
													  
													
														}
                                        $pNums = mysql_num_rows($proofs);
                                        if($pNums>0){ 
                                                     while($proof = mysql_fetch_array($proofs)){
														
														
															
														
                                                                if($ascase==0){
                                                                    
																	 if($asData['checks_id']==39 || $asData['checks_id']==41){
																	 $tLbl= $nos;
																 }else{
																	 $tLbl = ($fnos).(($pNums>1)?froofLbl($nos):'');
																 }
                                                                }else 
																 if($asData['checks_id']==39 || $asData['checks_id']==41){
																	 $tLbl= $nos;
																 }else{
																	 $tLbl = ($fnos+$nos);
																 }
                                                                (($nos>0)?"-":"").$tLbl.$abc;
                                                                $FILES[$cnts]['proof'] = $proof['d_value'];
                                                                $FILES[$cnts]['title'] = $proof['d_stitle'];
                                                                $FILES[$cnts]['pno'] = $tLbl.$abc;
                                                                $nos=$nos+1;
                                                                $cnts = $cnts+1;
                                                            }
                                                   
                                   }
								} 
		$fnos=$fnos+1;
			} ?>
	<?php /*?><div class="pg">
		<div class="ipg">
		<h1 class="for-large-heading">Report Summary</h1>
		
<?php 

		while($asData = mysql_fetch_array($asDatas)){ 
		
		
 

?>
 
				<div class="headline">
                	<span style="margin-left:20px;">
                    	<?php if($ascase==0) echo "$fnos-"; echo $asData['checks_title'];?>
                    </span>
                 </div>
				<div class="tbl">
				<div class="reportWrapperCivil">
				<div class="tableWrapperCivil">
				<h3 class="summary-heading"><?php if($ascase==0) echo "$fnos-"; echo $asData['checks_title'];?></h3>
                    <table class="table_OddEven" width="890" border="0"  cellpadding="0" cellspacing="0">
                            <tr >
                             	<td class="tdc">
                                <strong>
									<?php 
                                        $data = getData($asData['as_id'],"dmain");
                                        if(mysql_num_rows($data)>0){
                                            $data = mysql_fetch_array($data);
                                            echo $data['d_value'];
                                        }else{
                                            $data = $db->select("fields_maping","fl_title","fl_key='dmain' AND checks_id=$asData[checks_id] AND t_id=-1");
                                            $data = mysql_fetch_array($data);
                                            echo $data['fl_title'];
                                        }
                                     ?>
                                </strong>
                                </td>
                              	<td class="tdd">
                                <p style="font-weight:bold; color:#030; font-size:18px;">
									<?php 
                                        $vStatus = strtolower(trim($asData['as_vstatus']));
                                        $vSts = vs_Status($vStatus);
                                    ?>
                                    <span class="<?php //echo "f$vSts"; ?>" style="color: #595959;"><?php echo $asData['as_vstatus']; ?></span>                                
                                </p>
                                <?php  
                                        $nos=0;
										$counter=-1;
                                        for($i=-1; $i<12; $i++){
										
														if($i==0){
													  $proofs = getData($asData['as_id'],"file");	
														$abc="";
														}else{
															
														$counter++;	
															
													  $proofs = getData($asData['as_id'],"file$i");	
													  
													  if($asData['checks_id']==39){
														$abc="-A"; 
													
													  }
													  if($asData['checks_id']==41){
														$abc="-B";
																											
													  }
													  
													
														}
                                        $pNums = mysql_num_rows($proofs);
                                        if($pNums>0){ ?>                                
                                                <p>Please refer to
                                                <a href="javascript:void(0);">
                                                    Annexure-[ 
                                                    <?php  while($proof = mysql_fetch_array($proofs)){
														
														
															
														
                                                                if($ascase==0){
                                                                    
																	 if($asData['checks_id']==39 || $asData['checks_id']==41){
																	 $tLbl= $nos;
																 }else{
																	 $tLbl = ($fnos).(($pNums>1)?froofLbl($nos):'');
																 }
                                                                }else 
																 if($asData['checks_id']==39 || $asData['checks_id']==41){
																	 $tLbl= $nos;
																 }else{
																	 $tLbl = ($fnos+$nos);
																 }
                                                                echo (($nos>0)?"-":"").$tLbl.$abc;
                                                                $FILES[$cnts]['proof'] = $proof['d_value'];
                                                                $FILES[$cnts]['title'] = $proof['d_stitle'];
                                                                $FILES[$cnts]['pno'] = $tLbl.$abc;
                                                                $nos=$nos+1;
                                                                $cnts = $cnts+1;
                                                            }
                                                    ?> ]                                
                                                </a> below.</p>
                                <?php   }
								} ?>
                                </td>
                            </tr>
                    </table>            		
        			<div class="clear"></div>
               </div>
				</div>
			   </div>
<?php  			$fnos=$fnos+1;
			} ?>
		</div>
	</div><?php */?>			
<?php //} ?>

<?php
$files = array();
		for($i=0; $i<12; $i++){
			$files[] = 'file'.$i;
		}
$asDatas = $db->select("ver_checks vc INNER JOIN checks ck ON vc.checks_id=ck.checks_id","DISTINCT *","$asWhere ORDER BY checks_title");
$fnos = 1;
while($asData = mysql_fetch_array($asDatas)){?>
<?php 

	// For CIC CHECK New Format
	if($asData['checks_id']==39 || $asData['checks_id']==40 || $asData['checks_id']==41 || $asData['checks_id']==9){
	//PAKISTAN CRIMINALITY, TERRORISM & FRAUD SEARCH = 39
	if($asData['checks_id']==39){?>
                       <div class="pg">
                            <div class="ipg">
                        <div class="tbl">
                        <!--NEW FORMAT-->
                          <div class="reportWrapper">

                            <h3><?php 
                                        if($ascase==0) echo "$fnos-";
                                        echo $asData['checks_title']; 
                                        ?></h3>
                              
                            <div class="tableWrapper">
                                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="text-transform:capitalize;" >
                                    <tr>
                                        <td colspan="3" valign="top">
                                        
                                        Millions of records of criminality, fraud and high  risk entities, Corrupt Government Officials, Terrorist &amp; high profile  criminals, Corruption Data, violent crime, crimes of dishonesty etc., sourced  from local police departments, criminal courts, sanctions, NGOs, Special  Investigation Agencies and other public media data sources, covering over 208  cities and towns of Pakistan, translated from Urdu language into English
                                    </tr>
                                    <tr>
                                        <td width="272" valign="top" class="new_rpt_table_th">Database</td>
                                        <td width="400" valign="top" class="new_rpt_table_th">Description of Content</td>
                                        <td width="228" valign="top" class="new_rpt_table_th">Findings</td>
                                    </tr>
                                <?php 
                                $pCheck = getcheckP($asData[checks_id]);
                                $titles = $db->select("titles","t_id,t_title,t_show","checks_id=$pCheck AND is_dsp=1 ORDER BY t_pos");
                                if(mysql_num_rows($titles)>0){
                                        while($title = mysql_fetch_array($titles)){
                                                $fDatas = $db->select("fields_maping","fl_title,fl_desc,fl_key,fl_algn,is_multy","checks_id=$pCheck AND t_id=$title[t_id] AND fl_type='s' AND fl_show=1 ORDER BY fl_ord");
                                                $c=-1; 
                                                $cnts=0;
                                                while($fData = mysql_fetch_array($fDatas)){ 
                                            
                                                
                                                        $datas = getData($asData['as_id'],$fData['fl_key']);
                                                        
                                                        if($fData['fl_key']!='file' && (!in_array($fData['fl_key'],$files))){
                                                                ?>
                                                                <tr>	
                                                                    <td width="272" valign="top">
                                                                    <?=$fData['fl_title']?>:
                                                                    </td>
                                                                    <td width="400" valign="top">
                                                                    <?=$fData['fl_desc']?>:
                                                                    </td>
                                                                    <td width="228" valign="top">
                                                                    <?php /*?><ul class="ul-list <?=($fData['is_multy']==1)?'mt':'nt'?>" ><?php */?>
                                                                    <?php	
                                                                    if(mysql_num_rows($datas)>0){
                                                                        
                                                                        while($data = mysql_fetch_array($datas)){
                                                                                ?>
                                                                            <!--<li>-->
                                                                            <?php if($fData['fl_key']=='followup'){?>
                                                                            [ <?=date("j-F-Y",strtotime($data['data_date']))?> ] 
                                                                            <?php }?>
                                                                            <?php $d_value =  change_url_in_text(trim($data['d_value']));
                                                                            $d_value = strtolower($d_value);									
                                                                            if($d_value == 'yes'){ 
                                                                            $c++;
                                                                            ?>
                                                                                <img src="/img/concern.png" /><br />
                                                                                Serious Concern<br />
                                                                                <strong>refer to Annexure-<?php echo $c;?>-A below</strong>
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                            <?php  }else{?>
                                                                                <p class="no_found">No Match Found.</p>
                                                                            <?php }
                                                                            ?>
                                                                            <!--</li>-->  
                                                                        <?php 	}
                                                                    }else echo '<li class="nt">No Match Found.</li>';
                                                                    ?>
                                                                    <!--</ul>-->
                                                                    </td>
                                                                </tr>	
                                                        <?php }//end while
                                                
                                                }//end while
                                        }//end while
                                }//end if ?>
                                </table>
                           </div>                       

                       </div>
                        </div>
                    
                    <div class="sdisclaimer">
						<?php 
                        if($asData['checks_scomt']==1 && isset($_REQUEST['t'])){?>
                        	<div class="ftxt" style="margin-bottom:15px;"><?=$asData['checks_commt']?></div> 
                        	<p>&nbsp;</p>    
                        <?php } 
                        if($asData['checks_sdisc']==1 && isset($_REQUEST['t'])){?>
                       		<div class="ftxt"><strong>Disclaimer: </strong> <?=$asData['checks_discl']?></div>     
                        <?php } ?>
                    </div>
                    
                    </div>
                    </div>
                    

		<?php }//end if
	//CIVIL AND CRIMINAL LITIGATION SEARCH=40
	if($asData['checks_id']==40){
	// This is OLD Format	
	
	?>
    
                    
                            <?php
                            $pCheck = getcheckP($asData[checks_id]);
                            $titles = $db->select("titles","t_id,t_title,t_show","checks_id=$pCheck AND is_dsp=1 ORDER BY t_pos");
                            if(mysql_num_rows($titles)>0){
								while($title = mysql_fetch_array($titles)){
							?>
                            <div class="pg">
                            <div class="ipg">
                                     <div class="tbl">  
                                        <div class="reportWrapper">
                                        <div class="topsection">
                                        <h3>                                    
											<?php 
                                            if($ascase==0) echo "$fnos-";
                                            echo $asData['checks_title']; 
                                            ?>
                                        </h3>
                                        <p>Litigation Checks Search for the subject individual’s recent criminal convictions or pending investigations for bribery, tax evasion, and all civil and criminal litigation history through available <?php echo cicReportCourtsTitle($title['t_title']);?> sources</p>
                                        </div>
                                        <div class="tableWrapper">
                                        <?php 
										$fDatas = $db->select("fields_maping","fl_title,fl_key,fl_algn,is_multy","checks_id=$pCheck AND t_id=$title[t_id] AND fl_type='s' AND fl_show=1 ORDER BY fl_ord");
										
										
										
										?>
                                        <ul>
                                        <li class="verifyul">Verification Result</li>
										
										
										<?php 
										while($fData = mysql_fetch_array($fDatas)){ 
														$data = getData($asData['as_id'],$fData['fl_key']);
														$rsData = mysql_fetch_array($data);
														if($fData['fl_key']=='rc_found79' || $fData['fl_key']=='rc_found80' || $fData['fl_key']=='rc_found81' || $fData['fl_key']=='rc_found82' || $fData['fl_key']=='rc_found83'){
															if($rsData['d_value']=='Yes'){?>
																 <li><img src="/img/Icon-warning.png" width="64" />
                                        <div class="redflag">Serious Concern</div>
                                        <div>Record found at 
                                        <?php 
										echo cicReportCourtsTitle($title['t_title']);
											 ?>
                                        </div>
                                        </li>
																
															<?php }else{?>
															
															<li>
                                       
                                        <div>No Record found at 
                                        <?php 
										echo cicReportCourtsTitle($title['t_title']);
											 ?>
                                        </div>
                                        </li>
															
															
															
															<?php }
														}
										}?>
										
                                       
										
										
										
										
										
                                        </ul>
                                        
                                        </div>
                                        <div style="clear:both;"></div>
                                        
                                        <div class="tableWrapper">
                                        
                                        <table cellpadding="0" cellspacing="0">
                                      
                                        <tr>
                                        <td>Name of Employee</td>
                                        <td>
											<?php 
												$v_id = $asData['v_id'];
                                                $applicant = $db->select("ver_data","*","v_id=$v_id");
												$applicant_info = mysql_fetch_array($applicant);
												echo $applicant_info['v_name'];
                                            ?>
                                        </td>
                                        </tr>
                                        <tr>
                                        <td>Jurisdiction</td>
                                        <td>
										<?php 
											$court_titles = strtolower($title['t_title']);
											switch($court_titles){
												case "high court sindh":
												echo '<span class="redbadge">High Court Sindh,</span> High Court Lahore, High Court Quetta, High Court Peshawar, High Court Islamabad';
												break;
												case "high court lahore":
												echo 'High Court Sindh, <span class="redbadge">High Court Lahore,</span> High Court Quetta, High Court Peshawar, High Court Islamabad';
												break;
												case "high court quetta":
												echo 'High Court Sindh, High Court Lahore, <span class="redbadge">High Court Quetta</span>, High Court Peshawar, High Court Islamabad';
												break;
												case "high court peshawar":
												echo 'High Court Sindh, High Court Lahore, High Court Quetta, <span class="redbadge">High Court Peshawar,</span> High Court Islamabad';
												break;
												case "high court islamabad":
												echo 'High Court Sindh, High Court Lahore, High Court Quetta, High Court Peshawar, <span class="redbadge">High Court Islamabad</span>';
												break;
												
											}//end switch ?>
                                        </td>
                                        </tr>
                                        <tr><td style="padding:0;" colspan="2"><div class=""><h3>Case Details</h3></div></td></tr>
                                        <tr>
                                            <td>See Manager Remarks:</td>
                                            <td><?=$asData['as_remarks']?></td>
                                        </tr>
                                        
											<?php 
											$fDatas2 = $db->select("fields_maping","fl_title,fl_key,fl_algn,is_multy","checks_id=$pCheck AND t_id=$title[t_id] AND fl_type='s' AND fl_show=1 ORDER BY fl_ord");
											
											while($fData = mysql_fetch_array($fDatas2)){ 
											
														$datas = getData($asData['as_id'],$fData['fl_key']);
														if($fData['fl_key']=='multy'){?>
                                                                <tr>
                                                                    <td colspan="2" style="margin:0;padding:0">
                                                                        <table class="table_OddEven" cellpadding="0" cellspacing="0">
                                                                        <thead>
                                                                        <tr  class="shead">
                                                                        <th>Information Title</th>
                                                                        <th>Information Provided</th>
                                                                        <th>Information Verified</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php while($data = mysql_fetch_array($datas)){ ?>                        
                                                                        <tr>
                                                                        <td class="tda"><?=$data['d_mtitle'];?>:</td>
                                                                        <td class="tdy"><?=$data['d_stitle'];?></td>
                                                                        <td class="tdz"><?=$data['d_value'];?></td>
                                                                        </tr>
                                                                        <?php  } ?>     
                                                                        </tbody>                    
                                                                        </table>
                                                                    </td>
                                                                </tr>
														<?php }else if($fData['fl_key']!='file'){ ?>
                                                            <tr>	
                                                                <td class="tda">
                                                                <?=$fData['fl_title']?>:
                                                                </td>
                                                                <td class="tdb">
                                                                <?php /*?><ul class="ul-list <?=($fData['is_multy']==1)?'mt':'nt'?>" ><?php */?>
                                                                <?php	
																//var_dump("datas",$datas);
																
                                                                if(mysql_num_rows($datas)>0){
                                                                while($data = mysql_fetch_array($datas)){ ?>
                                                                <!--<li>-->
                                                                <?php if($fData['fl_key']=='followup'){?>
                                                                [ <?=date("j-F-Y",strtotime($data['data_date']))?> ] 
                                                                <?php }?>
                                                                <?=change_url_in_text(trim($data['d_value']))?>
                                                                <!--</li>-->  
                                                                <?php 	}
                                                                }else echo '<li class="nt">No Match Found.</li>';
                                                                ?>
                                                                <!--</ul>-->
                                                                </td>
                                                            </tr>	
														<?php }
                                            }//end while
											?>
                                        </table>
                                        
                                        </div>
                                        
                                        
                                        </div>
                                     </div>
                                     </div>
                    			</div>

                            <?php 
								}// end while
							}//end if ?>
									
<?php $fnos=$fnos + 1;
	}//end if
	//PAKISTAN CREDIT AND BANKRUPTCY SEARCH=41
	if($asData['checks_id']==41){?>
            <div class="pg">
            <div class="ipg">
            <div class="tbl">
                        <!--NEW FORMAT-->
                          <div class="reportWrapper">
                           <h3><?php if($ascase==0) echo "$fnos-"; echo $asData['checks_title']; ?></h3>
                          
                        <div class="tableWrapper">
                            <table border="0" cellspacing="0" cellpadding="0" width="100%" style="text-transform:capitalize;" >
                                <tr>
                                    <td colspan="3" valign="top">
                                    
                                   Proprietary database used by credit rating agencies and finical intuitions to access their applicants. It contains several millions of records of Compliance Data, Money Laundering Data, Financial Regulatory Data credit default, bankruptcy and bankruptcy protect, loan defaulters, disqualification of directors, Financial embezzlement records from Pakistan and other public records that provides up to date access to the most inclusive, government provided and public lists persons barred or received censor local financial and regulatory authority entities.
                                </tr>
                                <tr>
                                    <td width="272" valign="top" class="new_rpt_table_th">Database</td>
                                    <td width="400" valign="top" class="new_rpt_table_th">Description of Content</td>
                                    <td width="228" valign="top" class="new_rpt_table_th">Findings</td>
                                </tr>
                            <?php 
                            $pCheck = getcheckP($asData[checks_id]);
                            $titles = $db->select("titles","t_id,t_title,t_show","checks_id=$pCheck AND is_dsp=1 ORDER BY t_pos");
                            if(mysql_num_rows($titles)>0){
									while($title = mysql_fetch_array($titles)){
											$fDatas = $db->select("fields_maping","fl_title,fl_desc,fl_key,fl_algn,is_multy","checks_id=$pCheck AND t_id=$title[t_id] AND fl_type='s' AND fl_show=1 ORDER BY fl_ord");
											$c=-1;
											$cnts=0;
											while($fData = mysql_fetch_array($fDatas)){ 
											
													$datas = getData($asData['as_id'],$fData['fl_key']);
													
													if($fData['fl_key']!='file' && (!in_array($fData['fl_key'],$files))){ ?>
                                                            <tr>	
                                                                <td width="272" valign="top">
                                                                <?=$fData['fl_title']?>:
                                                                </td>
                                                                <td width="400" valign="top">
                                                                <?=$fData['fl_desc']?>:
                                                                </td>
                                                                <td width="228" valign="top">
                                                                <?php /*?><ul class="ul-list <?=($fData['is_multy']==1)?'mt':'nt'?>" ><?php */?>
                                                                <?php	
                                                                if(mysql_num_rows($datas)>0){
																	
																	
																	while($data = mysql_fetch_array($datas)){
																		
																																		?>
                                                                        <!--<li>-->
                                                                        <?php if($fData['fl_key']=='followup'){?>
                                                                        [ <?=date("j-F-Y",strtotime($data['data_date']))?> ] 
                                                                        <?php }?>
                                                                        <?php $d_value =  change_url_in_text(trim($data['d_value']));
                                                                        $d_value = strtolower($d_value);									
                                                                        if($d_value == 'yes'){
																			$c++; ?>
                                                                            <img src="/img/concern.png" /><br />
                                                                            Serious Concern<br />
                                                                            <strong>refer to Annexure-<?php echo $c; ?>-B below</strong>
																			
												
																			
																			
																			
																			
                                                                        <?php  }else{?>
                                                                        	<p class="no_found">No Match Found.</p>
                                                                        <?php }
                                                                        ?>
                                                                        <!--</li>-->  
																	<?php 	}
                                                                }else echo '<li class="nt">No Match Found.</li>';
                                                                ?>
                                                                <!--</ul>-->
                                                                </td>
                                                            </tr>	
													<?php }//end while
											
											}//end while
									}//end while
							}//end if ?>
                            </table>
                        <!--NEW FORMAT-->
                        </div>
                        </div>
                        </div>
                 
    <div class="sdisclaimer">
     <?php 
          if($asData['checks_scomt']==1 && isset($_REQUEST['t'])){?>
            <div class="ftxt" style="margin-bottom:15px;"><?=$asData['checks_commt']?></div> 
            <p>&nbsp;</p>    
    <?php } 
            
          if($asData['checks_sdisc']==1 && isset($_REQUEST['t'])){?>
            <div class="ftxt"><strong>Disclaimer: </strong> <?=$asData['checks_discl']?></div>     
    <?php } ?>
    </div>
            </div>
        </div>
	
	<?php $fnos=$fnos + 1;
	}//end if 
	//National ID Verification = 9
	if($asData['checks_id']==9){?>
		<div class="pg">
        <div class="ipg">
           <?php   /* <div class="headline">
                <span style="margin-left:20px;">
                
                </span>
             </div> */  ?>     
				<div class="tbl">
                <div class="reportWrapper">
					<h3><?php 
                    if($ascase==0) echo "$fnos-";
                    echo $asData['checks_title']; 
                ?>
				</h3>
                <div class="tableWrapper">
				
				<table width="100%" border="0"  cellpadding="0" cellspacing="0">
				<?php 
                        $vStatus = strtolower(trim($asData['as_vstatus']));
                        $vSts = vs_Status($vStatus);
                 ?>
            <tr>
                <td>Verification Status:</td>
                <td>
                    <?=$asData['as_vstatus']?>
                 </td>
            </tr>
            <tr>
                <td>Manager Remarks:</td>
                <td><?=$asData['as_remarks']?></td>
            </tr>
        <?php
            $pCheck = getcheckP($asData[checks_id]);
            $titles = $db->select("titles","t_id,t_title,t_show","checks_id=$pCheck AND is_dsp=1 ORDER BY t_pos");
            if(mysql_num_rows($titles)>0){
                while($title = mysql_fetch_array($titles)){
                    $fDatas = $db->select("fields_maping","fl_title,fl_key,fl_algn,is_multy","checks_id=$pCheck AND t_id=$title[t_id] AND fl_type='s' AND fl_show=1 ORDER BY fl_ord");
                    if($title['t_show']==1){ ?>
                    <tr class="shead">
                        <th colspan="2">
                            <?php  //echo $title['t_title'] Verified By Section ?>
                        </th>
                    </tr> 
        <?php			} 
                while($fData = mysql_fetch_array($fDatas)){ 
                    $datas = getData($asData['as_id'],$fData['fl_key']);
                    if($fData['fl_key']=='multy'){?>
                    <tr>
                        <td colspan="2" style="margin:0;padding:0">
                            <table class="rp_second_table" cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Information Title</th>
                                        <th>Information Provided</th>
                                        <th>Information Verified</th>
                                    </tr>
                                </thead>
                                <tbody>
                				<?php while($data = mysql_fetch_array($datas)){ ?>                        
                                <tr>
                                    <td class="tda"><?=$data['d_mtitle'];?>:</td>
                                    <td class="tdy"><?=$data['d_stitle'];?></td>
                                    <td class="tdz"><?=$data['d_value'];?></td>
                                </tr>
                				<?php  } ?>     
                			</tbody>                    
                            </table>
                        </td>
                    </tr>
              <?php }else if($fData['fl_key']!='file'){ ?>
                        <tr>	
                            <td class="tda">
                                <?=$fData['fl_title']?>:
                            </td>
                            <td class="tdb">
                            <ul class="ul-list <?=($fData['is_multy']==1)?'mt':'nt'?>" >
                        <?php	
                            if(mysql_num_rows($datas)>0){
                                while($data = mysql_fetch_array($datas)){ ?>
                                   <li>
                                    <?php if($fData['fl_key']=='followup'){?>
                                    [ <?=date("j-F-Y",strtotime($data['data_date']))?> ] 
                                    <?php }?>
                                    <?=change_url_in_text(trim($data['d_value']))?>
                                   </li>  
                         <?php 	}
                             }else echo '<li class="nt">---</li>';
                              ?>
                            </ul>
                            </td>
                        </tr>	
        <?php }}}
            }
        ?>
        </table>
        		</div>
                </div>
        		</div>
		
<div class="sdisclaimer">
 <?php 
	  if($asData['checks_scomt']==1 && isset($_REQUEST['t'])){?>
		<div class="ftxt" style="margin-bottom:15px;"><?=$asData['checks_commt']?></div> 
        <p>&nbsp;</p>    
<?php } 
	    
	  if($asData['checks_sdisc']==1 && isset($_REQUEST['t'])){?>
		<div class="ftxt"><strong>Disclaimer: </strong> <?=$asData['checks_discl']?></div>     
<?php } ?>
</div>
        </div>
    </div>
	
	<?php $fnos=$fnos + 1;}//end if// For CIC CHECK New Format
	
	
	
	


	
	
	}else{?>
		<div class="pg">
        <div class="ipg">
                   
				<div class="tbl">
				<div class="reportWrapper">
					<h3><?php 
                    if($ascase==0) echo "$fnos-";
                    echo $asData['checks_title']; 
                ?>
				</h3>
                <div class="tableWrapper">
				
				<table width="100%" border="0"  cellpadding="0" cellspacing="0">
				<?php 
                        $vStatus = strtolower(trim($asData['as_vstatus']));
                        $vSts = vs_Status($vStatus);
                 ?>
            <tr>
                <td class="">Verification Status:</td>
                <td class=" <?php // "f$vSts" ?>">
                    <?=$asData['as_vstatus']?>
                 </td>
            </tr>
            <tr>
                <td class="">Manager Remarks:</td>
                <td class=""><?=$asData['as_remarks']?></td>
            </tr>
        <?php
            $pCheck = getcheckP($asData[checks_id]);
            $titles = $db->select("titles","t_id,t_title,t_show","checks_id=$pCheck AND is_dsp=1 ORDER BY t_pos");
            if(mysql_num_rows($titles)>0){
                while($title = mysql_fetch_array($titles)){
                    $fDatas = $db->select("fields_maping","fl_title,fl_key,fl_algn,is_multy","checks_id=$pCheck AND t_id=$title[t_id] AND fl_type='s' AND fl_show=1 ORDER BY fl_ord");
                    if($title['t_show']==1){ ?>
                    <tr class="shead">
                        <th colspan="2">
                            <?php  //echo $title['t_title'] Verified By Section ?>
                        </th>
                    </tr> 
        <?php			} 
                while($fData = mysql_fetch_array($fDatas)){ 
                    $datas = getData($asData['as_id'],$fData['fl_key']);
                    if($fData['fl_key']=='multy'){?>
                    <tr>
                        <td colspan="2" style="margin:0;padding:0">
                            <table class="rp_second_table" cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr class="">
                                        <th>Information Title</th>
                                        <th>Information Provided</th>
                                        <th>Information Verified</th>
                                    </tr>
                                </thead>
                                <tbody>
                				<?php while($data = mysql_fetch_array($datas)){ ?>                        
                                <tr>
                                    <td class="tda"><?=$data['d_mtitle'];?>:</td>
                                    <td class="tdy"><?=$data['d_stitle'];?></td>
                                    <td class="tdz"><?=$data['d_value'];?></td>
                                </tr>
                				<?php  } ?>     
                			</tbody>                    
                            </table>
                        </td>
                    </tr>
              <?php }else if($fData['fl_key']!='file'){ ?>
                        <tr>	
                            <td class="tda">
                                <?=$fData['fl_title']?>:
                            </td>
                            <td class="tdb">
                            <ul class="ul-list <?=($fData['is_multy']==1)?'mt':'nt'?>" >
                        <?php	
                            if(mysql_num_rows($datas)>0){
                                while($data = mysql_fetch_array($datas)){ ?>
                                   <li>
                                    <?php if($fData['fl_key']=='followup'){?>
                                    [ <?=date("j-F-Y",strtotime($data['data_date']))?> ] 
                                    <?php }?>
                                    <?=change_url_in_text(trim($data['d_value']))?>
                                   </li>  
                         <?php 	}
                             }else echo '<li class="nt">---</li>';
                              ?>
                            </ul>
                            </td>
                        </tr>	
        <?php }}}
            }
        ?>
        </table>
        		</div>
				</div>
				</div>
		
<div class="sdisclaimer">
 <?php 
	  if($asData['checks_scomt']==1 && isset($_REQUEST['t'])){?>
		<div class="ftxt" style="margin-bottom:15px;"><?=$asData['checks_commt']?></div> 
        <p>&nbsp;</p>    
<?php } 
	    
	  if($asData['checks_sdisc']==1 && isset($_REQUEST['t'])){?>
		<div class="ftxt"><strong>Disclaimer: </strong> <?=$asData['checks_discl']?></div>     
<?php } ?>
</div>
        </div>
    </div>
		
	<?php $fnos=$fnos + 1; }//else if
	?>


<?php }//end while ?>




<?php 

if(isset($FILES)){  
		foreach($FILES as $no=>$FILE){?>
		<div class="pg">
			<div class="ipg">
                    <div class="headline" style="margin-bottom:0">
                        <span style="margin-left:20px;">Annexure-<?=$FILE['pno']?></span>
                    </div>
                    <div style="text-align:center;margin-bottom:10px;padding:5px;" class="shead">
						<?=$FILE['title']?>
                    </div>                           
					<div class="main" align="center">
						<img style="width:700px;" src="<?php echo $FILE['proof'];  ?>"  />
					</div>
			</div>
	   	</div>                    
<?php }
	} ?>

<?php if(isset($_REQUEST['certi']) && $vSts=='Green' && $varData['v_sent']==4){?>
		<div class="clear"></div>
 		<style type="text/css">
	.page{ 
		
		min-height:950px; 
		
		background:url('images/rd-certificate-BG.png') no-repeat center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
  
		border:1px solid #ccc;
		
		font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
		position:relative;
	}
	.clear{ clear:both;}
	.alignright{ text-align:right;}
		/* top bar*/
	.green, .lightgreen, .red, .lightred{ height:15px; float:left;}
	 ul.topbar{ padding:0; margin:0;}
	 ul.topbar li{ margin:0; display:inline-block; width:25%;} 
	.green{ background-color:#00713d;}
	.lightgreen{background-color:#118a61;}
	.red{background-color:#8c0b05;}
	.lightred{background-color:#e41b23;}
	ul.rd-ref li{ list-style:none;}
	ul.rd-ref li span{ color:#666; }
	ul.rd-ref li:first-child{ margin-bottom:15px;}
	/* top bar*/
	
	/* header section*/
	.rep-logo{background:url('images/rd-report-logo.png');}
	.halfwidth{ width:48%; margin-right:1%; float:left;}
	.largheading{ font-size:48px; color:#ffffff; background:#000; text-align:center;}
	/* header section*/
	/* body section*/
	.certifytxt{ 
	width:100%;
	text-align:center;
	font-size:20px;
	color:#666666;
	font-family:Arial, 'Helvetica', sans-serif;
	 }
	 .certifynam{
	width:100%;
	text-align:center;
	font-size:32px;
	color:#006633;	
	font-family:Arial, 'Helvetica', sans-serif;
	}
	
	.certifybag{
	width:100%;
	text-align:center;
	font-size:32px;
	color:#000000;	
	font-family:Arial, 'Helvetica', sans-serif;
	}
	
	.certifytxt span{ color:#000000;}
	
	/* body section*/
	
	.pinfor{ width:60%; margin:auto; font-style:italic; color:#666666; font-size:22px; border-top:2px solid #ccc; border-bottom:2px solid #ccc; padding-top:10px; padding-bottom:10px;}
	.pinfor table tr td{ padding-bottom:10px;}
	img.seal{ position:absolute; right:15px; bottom:75px;}
	/*footer area*/
	.repfooter{ background:#8c0b05; position:absolute; bottom:0; width:100%;}
	.repfooter ul{ padding:0; margin:0;}
	.repfooter li{ float:left; list-style:none; font-size:14px; text-align:center; color:#ffffff; padding:10px 5px;} 
	.phone{ width:20%;}
	.email{ width:25%; }
	.web{ width:50%;}
	.web span{}
	
	.rotate{
    -ms-transform: rotate(270deg); /* IE 9 */
    -webkit-transform: rotate(270deg); /* Chrome, Safari, Opera */
    transform: rotate(270deg);
	margin-top:190px;
} 

</style>
        <div class="pg " style="border:none;">
			<div class="ipg" style="width:950px;margin:0;border:none;">
            	<div class="clear"></div>
                <div class="rotate">
            	<?php 
				$_REQUEST['id'] = $varData['v_id'];
				include("include_pages/certificate_inc.php")?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
<?php }?>

<div class="pg">
			<div class="ipg" style="width:950px;margin:0;border:none;">
          
            <div class="report-term-and-condition">
    	<h2 class="for-blue-text">REPORT TERMS AND CONDITIONS</h2>
        <p>IT IS IMPORTANT THAT YOU READ THE TERMS AND CONDITIONS BELOW, AS THEY APPLY TO THIS REPORT. IF YOU DO NOT UNDERSTAND AND AGREE TO ALL THESE TERMS AND CONDITIONS, PLEASE NOTIFY US IMMEDIATELY. </p>
        <div class="report-section">
        	<span>1. LICENCE TO USE.</span>
        	<p>This Report is confidential and copyrighted. Title to the Report and all associated intellectual property rights is retained by BCG. No right, license, title or interest in or to any trademark, service mark, logo or trade name of BCG or its licensors is granted under these Terms and Conditions.</p>
        </div>
        <div class="report-section">
        	<span>2. RESTRICTIONS.</span>
        	<p>BCG grants you a non-exclusive and non-transferable license to use this report and any error corrections provided by BCG (collectively "Report") for internal purposes only. You must not at any time-share this Report with the Subject of the Report or with any other third party, without our prior written agreement. BY REQUESTING AND RECEIVING THIS REPORT, YOU ACKNOWLEDGE AND AGREE THAT BCG’S INTERESTS WOULD BE SIGNIFICANTLY JEOPARDISED, WERE THIS REPORT OR ITS CONTENTS TO COME INTO THE POSSESSION OF THE SUBJECT OF THE REPORT. </p>
        </div>
        <div class="report-section">
        	<span>3. LIMITED WARRANTY.</span>
        	<p>This Report is provided "AS IS". Your exclusive remedy and BCG's entire liability under this limited warranty will be at BCG's option to re-do this Report or refund the fee paid for the Report. You acknowledge that in producing this Report, BCG has obtained information from various sources. Whilst every attempt is made to ensure that such sources are reputable and accurate, BCG cannot be held liable for such sources and the material that they provide. You also acknowledge that if the Report refers to ‘unable to be obtained’ (or words to that effect), the representation by BCG is that the information could not be obtained from reputable and accurate sources, not that certain information does not exist. </p>
        </div>
        <div class="report-section">
        	<span>4. DISCLAIMER OF WARRANTY.</span>
        	<p>UNLESS SPECIFIED IN THESE TERMS AND CONDITIONS, ALL EXPRESS OR IMPLIED CONDITIONS, REPRESENTATIONS AND WARRANTIES, WHETHER ORAL OR WRITTEN, INCLUDING ANY IMPLIED WARRANTY OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE OR NON-INFRINGEMENT ARE DISCLAIMED, EXCEPT TO THE EXTENT THAT THESE DISCLAIMERS ARE HELD TO BE LEGALLY INVALID. </p>
        </div>
        <div class="report-section">
        	<span>5. LIMITATION OF LIABILITY.</span>
        	<p>IN NO EVENT WILL BCG OR ITS LICENSORS BE LIABLE FOR ANY LOST REVENUE, PROFIT OR DATA, OR FOR SPECIAL, INDIRECT, CONSEQUENTIAL, INCIDENTAL OR PUNITIVE DAMAGES, HOWEVER CAUSED AND REGARDLESS OF THE THEORY OF LIABILITY, ARISING OUT OF OR RELATED TO THE USE OF OR INABILITY TO USE THIS REPORT, EVEN IF BCG HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. In no event will BCG's liability to you, whether it arises in contract, tort (including negligence) or otherwise, exceed the amount paid by you for this Report. The foregoing limitations will apply even if the above-stated warranty fails of its essential purpose. </p>
        </div>
        <div class="report-section">
        	<span>6. TERMINATION. </span>
        	<p>These Terms and Conditions will apply until all copies of this Report in your possession are destroyed and such destruction has been confirmed to BCG in writing, which you may do at any time. Should you fail to comply materially with any of these Terms and Conditions, BCG may in writing terminate your right to use or retain this Report, in which case you must promptly destroy all copies of the Report. Even if the applicability of these Terms and Conditions is terminated, any provisions which by their nature should survive will remain in effect. </p>
        </div>
        <div class="report-section">
        	<span>7. WAIVER. </span>
        	<p>The waiver by either you or BCG of a breach of any provision of these Terms and Conditions by the other party will not be construed as a waiver of any succeeding breach of the same or any other provision, nor will any delay or omission on the part of either you or BCG to exercise any right that we respectively have, operate as a waiver of any such right. </p>
        </div>
        <div class="report-section">
        	<span>8. ASSIGNMENT. </span>
        	<p>You may not assign any of your rights or obligations under these Terms and Conditions to anyone else, in whole or in part, without the prior written agreement of BCG. </p>
        </div><div class="report-section">
        	<span>9. GOVERNING LAW. </span>
        	<p>Any action related to these Terms and Conditions will be governed by Singapore law. No choice of law rules of any jurisdiction will apply.</p>
        </div><div class="report-section">
        	<span>10. SEVERABILITY. </span>
        	<p>If any provision of these Terms and Conditions, in whole or in part, is held to be illegal, invalid or unenforceable for any reason, such determination will only affect such portion of such provision as is held to be illegal, invalid or unenforceable and will not in any way affect the remainder of such provision or any other provision of these Terms and Conditions. </p>
        </div>
        <div class="report-section">
        	<span>11. INTEGRATION. </span>
        	<p>These Terms and Conditions are supplementary to, and governed by, the existing Master Services Agreement (MSA) between you and BCG, and relate specifically to the use of this Report. If there are any conflicting terms between that of the MSA and these Terms and Conditions, the terms of the MSA shall take precedence.</p>
        </div>
    </div>
            </div>
 </div>



