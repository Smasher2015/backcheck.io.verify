<?php if($numChkes>3){
			$fnos=$fnos+1;?>
<div style="page-break-after:always;"></div>
<div class="mainPage" style="margin-top:20px;">
    	<img style="margin-bottom:10px;" src="img/header_img.png"  />
    	<div class="clearfix"></div>
		<div style="text-align:center;" align="center">
            <div style="margin:8px;">          
            <?php
				while($asData = mysql_fetch_array($asDatas)){ ?>
					<table cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
							<thead>
								<tr>
									<th colspan="2" align="left">
										<?php
											if($ascase==0) echo "$fnos-";
											$check = getCheck($asData['checks_id']);
											echo $check['checks_title'];
										?>
									</th>
								</tr>
							</thead>
						<tr>
							<td align="left">
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
							</td>
							<td>
								<?php 
									$vStatus = strtolower(trim($asData['as_vstatus']));
									$vSts = vs_Status($vStatus);
								?>
								<span class="<?php echo "f$vSts"; ?>">
									<?php echo $asData['as_vstatus']; ?>
								</span>
								<?php  
									$nos=0;
									$proofs = getData($asData['as_id'],"file");
									$pNums = mysql_num_rows($proofs);
									if($pNums>0){ ?>
								<br/>Please refer to <span style="color:#00F; font-weight:bold;">Annexure-[ 
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
								?> ]</span> below
							<?php  } ?>
							</td>        
						</tr>                    		
					</table>
			<?php $fnos=$fnos+1;} ?>			
       		</div>        	
       		<div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>    
</div>
<?php } ?>

<?php

$asDatas = $db->select("ver_checks vc INNER JOIN checks ck ON vc.checks_id=ck.checks_id","DISTINCT *","$asWhere ORDER BY checks_title");
$fnos = 1;
while($asData = mysql_fetch_array($asDatas)){?>
    <div style="page-break-after:always;"></div>
	<div class="mainPage" style="margin-top:20px;">
    	<img style="margin-bottom:10px;" src="img/header_img.png"  />
    	<div class="clearfix"></div>
		<div style="text-align:center;" align="center">
            <div style="margin:8px;">          
                <h2 align="left">
                    <?php 
                        if($ascase==0) echo "$fnos-";
                        echo $asData['checks_title']; 
                    ?>
                </h2>
            <table cellspacing="0" cellpadding="0">
            <?php 
					$vStatus = strtolower(trim($asData['as_vstatus']));
					$vSts = vs_Status($vStatus);
             ?>
                <tr>
                    <td align="left">Verification Status:</td>
                    <td class="<?php echo "f$vSts"; ?>">
						<?php echo  $asData['as_vstatus']; ?>
                     </td>
                </tr>
                <tr>
                    <td align="left">Manager Remarks:</td>
                    <td class="algleft">
                        <ul class="nt">
                        	<li>
								<?php echo  $asData['as_remarks']; ?> 
                        	</li>
                        </ul>
                    </td>
                </tr>
            <?php
				$pCheck = getcheckP($asData[checks_id]);
                $titles = $db->select("titles","t_id,t_title,t_show","checks_id=$pCheck AND is_dsp=1 ORDER BY t_pos");
                if(mysql_num_rows($titles)>0){
                    while($title = mysql_fetch_array($titles)){
                        $fDatas = $db->select("fields_maping","fl_title,fl_key,fl_algn,is_multy","checks_id=$pCheck AND t_id=$title[t_id] AND fl_type='s' AND fl_show=1 ORDER BY fl_ord");
                        if($title['t_show']==1){ ?>
                        <tr>
                            <th align="left" colspan="2">
                                <?php  echo $title['t_title']; ?>
                            </th>
                        </tr> 
            <?php			} 
                    while($fData = mysql_fetch_array($fDatas)){ 
                        $datas = getData($asData['as_id'],$fData['fl_key']);
                        if($fData['fl_key']=='multy'){?>
                        <tr>
                            <td colspan="2" style="margin:0;padding:0">
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th style="text-align:center">Information Provided</th>
                                        <th style="text-align:center">Information Verified</th>
                                    </tr>
                    <?php while($data = mysql_fetch_array($datas)){ ?>                        
                                    <tr>
                                        <td align="left"><?php echo $data['d_mtitle'];?>:</td>
                                        <td><?php echo $data['d_stitle'];?></td>
                                        <td><?php echo $data['d_value'];?></td>
                                    </tr>
                    <?php  } ?>                         
                                </table>
                            </td>
                        </tr>
                  <?php }else if($fData['fl_key']!='file'){ ?>
                            <tr>	
                                <td align="left">
                                    <?=$fData['fl_title']?>:
                                </td>
                                <td class="<?=$fData['fl_algn'] ?>">
                                <ul class="<?=($fData['is_multy']==1)?'mt':'nt'?>" >
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
            <?php 
                $analystInf = $db->select("users","*","user_id=$asData[user_id]");
                $analystInf = mysql_fetch_array($analystInf);
            ?>
            <table cellpadding="0" cellspacing="0">              
                        <thead>
                            <tr>
                                <th colspan="2" align="left">Verifier Information</th>
                            </tr>
                        </thead>
                        <tr>
                            <td align="left">Name:</td>
                            <td ><?php echo trim($analystInf['first_name']." ".$analystInf['middle_name']." ".$analystInf['last_name']); ?></td>
                        </tr>  
                        <tr>
                            <td align="left">Email:</td>
                            <td><a href="mailto:<?=$analystInf['email']?>"><?=$analystInf['email']?></a></td>
                        </tr>   
                        <tr>
                            <td align="left">Contact #</td>
                            <td><?=$analystInf['fone_no']?></td>
                        </tr>
                </table>
       </div>        	
       <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>    
</div> 
<?php 
$fnos=$fnos + 1;
} ?>