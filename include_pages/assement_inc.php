<div style="margin:8px;">
<h2 align="left">RISK ASSESSMENT REPORT</h2>
<table cellpadding="0" cellspacing="0">
	<tr>
    	<td align="left" >NAME OF EMPLOYEE:</td>
        <td><?php echo $varData['v_name']; ?></td>
    </tr> 
	<tr>
    	<td align="left" >EMPLOYEE ID:</td>
        <td><?php echo $varData['emp_id']; ?></td>
    </tr>    
	<tr>
    	<td align="left" >LEVEL OF SCREENING:</td>
        <td><?php 
				if(mysql_num_rows($asDatas)==1){
					$asData = mysql_fetch_array($asDatas);
					$ascase = $asData['as_id']; 	
				}else $asData = mysql_fetch_array($asDatas);
				if($ascase!=0){
					$check = getCheck($asData['checks_id']);
					echo $check['checks_title'];
				}else{
					echo 'LEVEL 1';
				}
				?></td>
    </tr> 
	<tr>
    	<td align="left" >DATE OF REPORT:</td>
        <td><?php echo date("j-F-Y",time()); ?></td>
    </tr>    
	<tr>
    	<td align="left" >CLIENT'S NAME:</td>
        <td>
			<?php
                 $comInfo = $db->select("company","name","id=$varData[com_id]");
                 $comInfo = mysql_fetch_array($comInfo);											 
                 echo $comInfo['name']; 
            ?>		
        </td>
    </tr>
	<tr>
    	<td align="center" >
        	<span style="font-size:17px; color:#000;">
            	RISK LEVEL:
            </span>
        </td>
        <td class="<?php
				if($ascase!=0) $vStatus = $asData['as_vstatus']; else $vStatus =$varData['v_rlevel']; 
				$vStatus = strtolower(trim($vStatus));
				$vSts = vs_Status($vStatus);
				echo $vSts;
				?>">
			<span style="font-size:17px; font-weight:bold;">
        		<?php echo $vSts; ?>
            </span>
        </td>
    </tr>                    		
</table>
</div>

<div style="margin:8px;height:412px;">
	<h2 align="left">Assessment Summary</h2>
<?php
	$asDatas = $db->select("ver_checks vc INNER JOIN checks ck ON vc.checks_id=ck.checks_id","DISTINCT *","$asWhere ORDER BY checks_title");
	$numChkes = mysql_num_rows($asDatas);
	$fnos = 1;
	$cnts = 0;
 	while($asData = mysql_fetch_array($asDatas)){ ?>
        <table cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
                <thead>
                    <tr>
                        <th colspan="2" align="left">
                            <?php
								if($ascase==0) echo "$fnos-";
                                echo $asData['checks_title'];
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
<?php if($fnos==3) break;
		$fnos=$fnos+1;			
} ?>
</div>
