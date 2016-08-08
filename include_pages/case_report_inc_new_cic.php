<?php if($numChkes>3){ $fnos=$fnos+1;?>
	<div class="pg">
		<div class="ipg">
<?php 		while($asData = mysql_fetch_array($asDatas)){ ?>
 
				<div class="headline">
                	<span style="margin-left:20px;">
                    	<?php if($ascase==0) echo "$fnos-"; echo $asData['checks_title'];?>
                    </span>
                 </div>
				<div class="tbl">
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
                                    <span class="<?php echo "f$vSts"; ?>"><?php echo $asData['as_vstatus']; ?></span>                                
                                </p>
                                <?php 
								$nos=0;
								$proofs = getData($asData['as_id'],"file");
								$pNums = mysql_num_rows($proofs);								
								if($pNums>0){ ?>
                                <p>Please refer to 
                                <a href="#">
									Annexure-[ 
                					<?php  while($proof = mysql_fetch_array($proofs)){
												if($ascase==0){
													$tLbl = ($fnos).(($pNums>1)?froofLbl($nos):'');
												}else $tLbl = ($fnos+$nos);
												echo (($nos>0)?"-":"").$tLbl;
												$FILES[$cnts]['proof'] = $proof['d_value'];
												$FILES[$cnts]['title'] = $proof['d_stitle'];
												$FILES[$cnts]['pno'] = $tLbl;
												$nos=$nos+1;
												$cnts = $cnts+1;
											}
                    				?> ]                                
                                </a> below.</p>
                                <?php } ?>
                                </td>
                            </tr>
                    </table>            		
        			<div class="clear"></div>
                </div>
<?php  			$fnos=$fnos+1;
			} ?>
		</div>
	</div>			
<?php } ?>

<?php

$asDatas = $db->select("ver_checks vc INNER JOIN checks ck ON vc.checks_id=ck.checks_id","DISTINCT *","$asWhere ORDER BY checks_title");
$fnos = 1;
while($asData = mysql_fetch_array($asDatas)){?>
<?php // For CIC CHECK New Format
	if($asData['checks_id']==39){?>
                <div class="pg">
                    <div class="ipg">      
                        <div class="tbl">
                        <!--NEW FORMAT-->
                            <table border="0" cellspacing="0" cellpadding="0" width="900" class="new_rpt_table" >
                                <tr>
                                    <td colspan="3" valign="top">
                                    <h2><?php 
                                    if($ascase==0) echo "$fnos-";
                                    echo $asData['checks_title']; 
                                    ?></h2>
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
											
											while($fData = mysql_fetch_array($fDatas)){ 
													$datas = getData($asData['as_id'],$fData['fl_key']);
													if($fData['fl_key']!='file'){ ?>
                                                            <tr>	
                                                                <td width="272" valign="top" class="new_rpt_table_td_1">
                                                                <?=$fData['fl_title']?>:
                                                                </td>
                                                                <td width="400" valign="top" class="new_rpt_table_td_2">
                                                                <?=$fData['fl_desc']?>:
                                                                </td>
                                                                <td width="228" valign="top"  class="new_rpt_table_td_3">
                                                                <?php /*?><ul class="ul-list <?=($fData['is_multy']==1)?'mt':'nt'?>" ><?php */?>
                                                                <?php	
                                                                if(mysql_num_rows($datas)>0){
																	while($data = mysql_fetch_array($datas)){ ?>
                                                                        <!--<li>-->
                                                                        <?php if($fData['fl_key']=='followup'){?>
                                                                        [ <?=date("j-F-Y",strtotime($data['data_date']))?> ] 
                                                                        <?php }?>
                                                                        <?php $d_value =  change_url_in_text(trim($data['d_value']));
                                                                        $d_value = strtolower($d_value);									
                                                                        if($d_value == 'yes'){?>
                                                                            <img src="/img/concern.png" /><br />
                                                                            Serious Concern<br />
                                                                            <strong>refer to Annexure-1 A and1B below</strong>
                                                                        <?php }else{?>
                                                                        	<p class="no_found">No Match Found.</p>
                                                                        <?php }
                                                                        ?>
                                                                        <!--</li>-->  
																	<?php 	}
                                                                }else echo '<li class="nt">---</li>';
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
                        <?php /*?><table class="table_OddEven" width="890" border="0"  cellpadding="0" cellspacing="0">
                        <?php 
                        $vStatus = strtolower(trim($asData['as_vstatus']));
                        $vSts = vs_Status($vStatus);
                        ?>
                        <tr>
                        <td class="tda">Verification Status:</td>
                        <td class="tdb <?="f$vSts"?>">
                        <?=$asData['as_vstatus']?>
                        </td>
                        </tr>
                        <tr>
                        <td class="tda">Manager Remarks:</td>
                        <td class="tdb"><?=$asData['as_remarks']?></td>
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
                        <ul class="ul-list <?=($fData['is_multy']==1)?'mt':'nt'?>" >
                        <?php	
                        if(mysql_num_rows($datas)>0){
                        while($data = mysql_fetch_array($datas)){ ?>
                        <li>
                        <?php if($fData['fl_key']=='followup'){?>
                        [ <?=date("j-F-Y",strtotime($data['data_date']))?> ] 
                        <?php }?>
                        <?php $d_value =  change_url_in_text(trim($data['d_value']));
                        $d_value = strtolower($d_value);									
                        if($d_value == 'yes'){
                        echo 'ICON';
                        }else{echo $d_value;}
                        ?>
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
                        </table><?php */?>
                        </div>
                    <!--- START ---><?php /*?><?php 
                    if($asData['checks_sveri']==1){
                    $analystInf = $db->select("users","*","user_id=$asData[user_id]");
                    $analystInf = mysql_fetch_array($analystInf); ?>
                    <div class="headline">
                    <span style="margin-left:20px;">Verifier Information</span>
                    </div>            
                    <div class="tbl">
                    <table class="table_OddEven" width="890" border="0"  cellpadding="0" cellspacing="0">            
                    <tr>
                    <td class="tda">Name:</td>
                    <td class="tdb"><?=trim($analystInf['first_name']." ".$analystInf['middle_name']." ".$analystInf['last_name']);?></td>
                    </tr>  
                    <tr>
                    <td class="tda">Email:</td>
                    <td class="tdb"><a href="mailto:<?=$analystInf['email']?>"><?=$analystInf['email']?></a></td>
                    </tr>   
                    <tr>
                    <td class="tdc">Contact #</td>
                    <td class="tdd"><?=$analystInf['fone_no']?></td>
                    </tr>
                    </table>
                    </div>
                    <?php } ?><?php */?><!--- END --->
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
	<?php }//end else
	if($asData['checks_id']==40){
	// This is OLD Format	
	
	?>
                    <div class="pg">
                    <div class="ipg">
                    <div class="headline">
                    <span style="margin-left:20px;">
                    <?php 
                    if($ascase==0) echo "$fnos-";
                    echo $asData['checks_title']; 
                    ?>
                    
                    </span>
                    </div>       
                    <div class="tbl">
                    <table class="table_OddEven" width="890" border="0"  cellpadding="0" cellspacing="0">
                    <?php 
                    $vStatus = strtolower(trim($asData['as_vstatus']));
                    $vSts = vs_Status($vStatus);
                    ?>
                    <tr>
                    <td class="tda">Verification Status:</td>
                    <td class="tdb <?="f$vSts"?>">
                    <?=$asData['as_vstatus']?>
                    </td>
                    </tr>
                    <tr>
                    <td class="tda">Manager Remarks:</td>
                    <td class="tdb"><?=$asData['as_remarks']?></td>
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
                    <!--- START ---><?php /*?><?php 
                    if($asData['checks_sveri']==1){
                    $analystInf = $db->select("users","*","user_id=$asData[user_id]");
                    $analystInf = mysql_fetch_array($analystInf); ?>
                    <div class="headline">
                    <span style="margin-left:20px;">Verifier Information</span>
                    </div>            
                    <div class="tbl">
                    <table class="table_OddEven" width="890" border="0"  cellpadding="0" cellspacing="0">            
                    <tr>
                    <td class="tda">Name:</td>
                    <td class="tdb"><?=trim($analystInf['first_name']." ".$analystInf['middle_name']." ".$analystInf['last_name']);?></td>
                    </tr>  
                    <tr>
                    <td class="tda">Email:</td>
                    <td class="tdb"><a href="mailto:<?=$analystInf['email']?>"><?=$analystInf['email']?></a></td>
                    </tr>   
                    <tr>
                    <td class="tdc">Contact #</td>
                    <td class="tdd"><?=$analystInf['fone_no']?></td>
                    </tr>
                    </table>
                    </div>
                    <?php } ?><?php */?><!--- END --->
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
	}//end else
	if($asData['checks_id']==41){?>
            <div class="pg">
            <div class="ipg">
            <div class="reportWrapperCivil">
<div class="topsection">
<h1>CIVIL AND CRMINAL LITIGATION SEARCH</h1>
<p>Litigation Checks Search for the subject individual’s recent criminal convictions or pending investigations for bribery, tax evasion, and all civil and criminal litigation history through available Sindh High Court sources</p>
</div>
<div class="resultdivCivil">
    <ul>
        <li>Verification Result</li><li><img src="Icon-warning.png" width="64" />
            <div class="redflag">Serious Concern</div>
            <div>Record found at High Court Sindh</div>
       </li>
    </ul>
</div>
    <div style="clear:both;"></div>

<div class="tableWrapperCivil">

<table cellpadding="0" cellspacing="0">
<tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
	<td>Name of Employee</td>
    <td>Sample</td>
</tr>
<tr>
	<td>Jurisdiction</td>
    <td><span class="redbadge">High Court Sindh,</span> High Court Lahore, High Court Quetta, High Court Peshawar, High Court Islamabad</td>
</tr>
<tr><td style="padding:0;" colspan="2"><div class="sepration"><h1>Case Details</h1></div></td></tr>
<tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp; </td>
    <td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
    <td>&nbsp;
    		
    </td>
</tr>
<tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    
</tr>
<tr>
	<td>&nbsp;</td>
    
    <td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp; </td>
    <td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
    <td>&nbsp;
    		
    </td>
</tr>
<tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    
</tr>
<tr>
	<td>&nbsp;</td>
    
    <td>&nbsp;</td>
</tr>
</table>

</div>


</div>
                  <div class="headline">
                    <span style="margin-left:20px;">
                    <?php 
                        if($ascase==0) echo "$fnos-";
                        echo $asData['checks_title']; 
                    ?>
                    </span>
                 </div>       
                    <div class="tbl">
                    <table class="table_OddEven" width="890" border="0"  cellpadding="0" cellspacing="0">
                    <?php 
                            $vStatus = strtolower(trim($asData['as_vstatus']));
                            $vSts = vs_Status($vStatus);
                     ?>
                <tr>
                    <td class="tda">Verification Status:</td>
                    <td class="tdb <?="f$vSts"?>">
                        <?=$asData['as_vstatus']?>
                     </td>
                </tr>
                <tr>
                    <td class="tda">Manager Remarks:</td>
                    <td class="tdb"><?=$asData['as_remarks']?></td>
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
            <!--- START ---><?php /*?><?php 
                if($asData['checks_sveri']==1){
                    $analystInf = $db->select("users","*","user_id=$asData[user_id]");
                    $analystInf = mysql_fetch_array($analystInf); ?>
                    <div class="headline">
                        <span style="margin-left:20px;">Verifier Information</span>
                    </div>            
                    <div class="tbl">
                    <table class="table_OddEven" width="890" border="0"  cellpadding="0" cellspacing="0">            
                        <tr>
                            <td class="tda">Name:</td>
                            <td class="tdb"><?=trim($analystInf['first_name']." ".$analystInf['middle_name']." ".$analystInf['last_name']);?></td>
                        </tr>  
                        <tr>
                            <td class="tda">Email:</td>
                            <td class="tdb"><a href="mailto:<?=$analystInf['email']?>"><?=$analystInf['email']?></a></td>
                        </tr>   
                        <tr>
                            <td class="tdc">Contact #</td>
                            <td class="tdd"><?=$analystInf['fone_no']?></td>
                        </tr>
                </table>
                    </div>
          <?php } ?><?php */?><!--- END --->
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
	}//end else 
	if($asData['checks_id']==9){?>
		<div class="pg">
        <div class="ipg">
              <div class="headline">
                <span style="margin-left:20px;">
                <?php 
                    if($ascase==0) echo "$fnos-";
                    echo $asData['checks_title']; 
                ?>
                </span>
             </div>       
				<div class="tbl">
				<table class="table_OddEven" width="890" border="0"  cellpadding="0" cellspacing="0">
				<?php 
                        $vStatus = strtolower(trim($asData['as_vstatus']));
                        $vSts = vs_Status($vStatus);
                 ?>
            <tr>
                <td class="tda">Verification Status:</td>
                <td class="tdb <?="f$vSts"?>">
                    <?=$asData['as_vstatus']?>
                 </td>
            </tr>
            <tr>
                <td class="tda">Manager Remarks:</td>
                <td class="tdb"><?=$asData['as_remarks']?></td>
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
		<!--- START ---><?php /*?><?php 
			if($asData['checks_sveri']==1){
                $analystInf = $db->select("users","*","user_id=$asData[user_id]");
                $analystInf = mysql_fetch_array($analystInf); ?>
				<div class="headline">
                	<span style="margin-left:20px;">Verifier Information</span>
             	</div>            
				<div class="tbl">
				<table class="table_OddEven" width="890" border="0"  cellpadding="0" cellspacing="0">            
                    <tr>
                        <td class="tda">Name:</td>
                        <td class="tdb"><?=trim($analystInf['first_name']." ".$analystInf['middle_name']." ".$analystInf['last_name']);?></td>
                    </tr>  
                    <tr>
                        <td class="tda">Email:</td>
                        <td class="tdb"><a href="mailto:<?=$analystInf['email']?>"><?=$analystInf['email']?></a></td>
                    </tr>   
                    <tr>
                        <td class="tdc">Contact #</td>
                        <td class="tdd"><?=$analystInf['fone_no']?></td>
                    </tr>
            </table>
            	</div>
      <?php } ?><?php */?><!--- END --->
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
	
	<?php $fnos=$fnos + 1;}//end else// For CIC CHECK New Format?>
	
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

<!--<div class="pg " style="border:none;">
			<div class="ipg" style="width:950px;margin:0;border:none;">
          
            <div class="map-main-header">
            <h2 class="h2-txt">BACKGROUND CHECK<span class="for-blue-text"> GROUP OF COMPANIES</span></h2>
            <div class="txt-container">
            <div class="left-cont">
            <div class="left-cont-txt-box">
                <strong>BACKGROUND CHECK SINGAPORE</strong><br />
                <span>30 Cecil Street, #19-08 Prudential Tower, <br />
                Singapore 049712<br />
                Phone: +65 3108 0343</span>
            </div>
            <div class="left-cont-txt-box">
                <strong>BACKGROUND CHECK CANADA</strong><br />
                <span>3380, Sunlight Street, Mississauga, Canada  <br />
               Postal Code L5M 0G9<br />
                Phone: +1 647 849 0983</span>
            </div>
            <div class="left-cont-txt-box">
                <strong>BACKGROUND CHECK ROMANIA</strong><br />
                <span>Povernei 20, 4th floor, Interphone 9, Bucharest, <br />
                District 1, 106444, Romania</span>
            </div>
            </div>
            <div class="right-cont">
            <div class="right-cont-txt-box">
                <strong>BACKGROUND CHECK PAKISTAN</strong><br />
                <span>
                    3rd Floor GSA House 19 Timber Pond, East<br /> Wharf, Keamari, Karachi 75620, Pakistan<br />
                    Phone: +21 111-92-92-92 <br />
                    +92-21-32863920 – 30 Fax: +92-21-3-2863931 
                </span>
            </div>
            <div class="right-cont-txt-box">
                <strong>BACKGROUND CHECK USA</strong><br />
                <span>
                    3901 Kimberly Drive, Flower Mound, <br /> TX, 75022 <br />
                    Toll Free: +1 888 983 0869<br />
                    Phone: +1 469 628 0432 
                </span>
            </div>
            <div class="right-cont-txt-box">
                <strong>BACKGROUND CHECK MALAYSIA</strong><br />
                <span>
                    Lot A020, Level 1, Podium Level, Financial Park, <br />
                     JalanMerdeka, 87000 Labuan F.T. Malaysia.
                </span>
            </div>
            </div>
            <div style="clear:both;"></div>
            <h2 class="h2-txt">GLOBAL REACH, <span class="for-blue-text">LOCAL INSIGHT</span></h2>
             <h3>NOW COVERING OVER <span class="for-blue-text">200 COUNTRIES</span> ACROSS THE WORLD</h3>
             
             <div class="support-cont"></div>
             
            <h4 class="who-weare">WHO <span class="for-blue-text">WE ARE</span></h4>
            
            <div style="clear:both;"></div>
            </div>
            <div class="blue-cont">
            <div class="blue-left-cont">
            <p>Background Check Group is a group of <b>technology driven</b> companies providing <b>Risk Mitigation, Compliance</b> and <b>Critical HR management</b> solutions to the clients in more than <b>200 countries</b>, covering from frontier to emerging markets.As the trusted partner <b>of hundreds of organizations worldwide</b>, we at Background Check Group provide to the point and <b>easy-to-understand</b> reports so you can <b>confidently make decisions</b> about prospective <b>employees, vendors and partners</b>. Not only does this <b>safeguard your brand</b>, but you also arrive at <b>dramatically better background insights</b> –<span class="orange-txt">INSIGHTS YOU CAN RELY ON</span>. It’s time to partner with Background Check Group</p>
            </div>
            <div class="blue-right-cont">
            <img src="img/logo12.png" alt="Risk Discovered" width="250" />
            </div>
            <div style="clear:both;"></div>
            </div>
			<div style="clear:both;"></div>
            </div>
            </div>
 </div>-->

