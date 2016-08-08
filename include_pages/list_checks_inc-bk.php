<?php 
if(is_numeric($_REQUEST['ascase'])){
	
	if(isset($_REQUEST['ePage'])){		
		if($LEVEL==2 || $LEVEL==4){
			$where = "vc.as_id=$_REQUEST[ascase]";
		}else{
			$where = "user_id=$_SESSION[user_id] AND vc.as_id=$_REQUEST[ascase]";
		}	
		$verCheck = checkDetails($_REQUEST['case'],'',$where);
		$verCheck = mysql_fetch_array($verCheck);
	}
	
	$csSts = strtolower($verCheck['as_status']);
	$ISEDIT = ($LEVEL==4)?false:(($csSts=='close')?false:true);
	$mPrm="ascase=$verCheck[as_id]&fkey=$verCheck[as_id]&key="; ?>
<table>
    <tbody>
        <tr class="shover">
            <td>Verification Status:</td>
            <td class="f<?=vs_Status(strtolower($verCheck['as_vstatus']));?>">
				<?php echo  $verCheck['as_vstatus'].' [ '.$verCheck['as_status'].' ]'; ?>
            </td>
        </tr>
        <tr class="shover">
            <td >Manager Remarks:</td>
            <td class="algleft">
				<ul class="nt">
            		<li>
						<span id="as_remarks<?=$verCheck[as_id]?>"><?=$verCheck['as_remarks']?></span>
                        <?php if($ISEDIT && $LEVEL==2){?>
                        	<img class="edit" onclick="showEdit('edit','Manager Remarks','<?= $mPrm ?>as_remarks')" src="img/edit-icon.png"  />
                        <?php } ?>
                    </li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>

<?php

$checkid = getcheckP($verCheck['checks_id']);
$sfields = $db->select("fields_maping","*","checks_id=$checkid AND fl_type='s' ORDER BY t_id,fl_ord");

$oTitle='';
$istbl = false;
while($sfield = mysql_fetch_array($sfields)){ 
$efields = $db->select("add_data","*","(as_id=$verCheck[as_id] and d_type='$sfield[fl_key]' AND d_isdlt=0)");
if(mysql_num_rows($efields)>0){ 
	if($sfield['t_id']!=$oTitle){ ?>
	<table class="stable">
            <tr>
                <th colspan="2"><?php
                        $oTitle = $sfield['t_id'];
						$istbl=true;
                        $title = $db->select("titles","*","t_id=$sfield[t_id]");
                        $title = mysql_fetch_array($title);
                        $title = $title['t_title'];
                        echo $title;
                ?></th>
            </tr>
<?php } ?>
<?php if($sfield['fl_key']=='multy'){ ?>
	<tr>
		<td colspan="2" style="margin:0;padding:0">
			<table>
				<tr>
					<th>Information Title</th>
					<th style="text-align:center">Information Provided</th>
					<th style="text-align:center">Information Verified</th>
				</tr>
<?php   $ind=1;
		while($efield = mysql_fetch_array($efields)){ 
			$mPrm="typ=multy&ascase=$verCheck[as_id]&data=$efield[d_id]&fkey=$ind&key="; ?>                        
				<tr class="shover">
					<td id="mtt1<?=$ind?>">
						<?=$efield['d_mtitle'];?>
                    </td>
					<td id="stt1<?=$ind?>">
						<?=$efield['d_stitle'];?>
                    </td>
					<td>
						<span id="val1<?=$ind?>"><?=$efield['d_value'];?></span>
                     	<?php if($ISEDIT){ ?>
                        	<img class="edit" onclick="showEdit('edit','','<?= $mPrm ?>d_value',500,260)" src="img/edit-icon.png"  />
                            <img class="edit" onclick="dataActions(<?=$efield['d_id']?>,'<?=$sfield['fl_title']?>')" title="<?=$sfield['fl_title']?>" src="img/delete.png" />	
                        <?php } ?>
                     </td>
				</tr>
<?php  $ind=$ind+1;} ?>                         
			</table>
		</td>
	</tr>
<?php }else{ ?>
	<tr class="shover">
		<td><?=$sfield['fl_title']?></td>
		<td class="<?=$sfield['fl_algn']?>">
        <ul class="<?=($sfield['is_multy']==1)?'mt':'nt'?>" ><?php 
				while($efield = mysql_fetch_array($efields)){
					$mPrm="ascase=$verCheck[as_id]&data=$efield[d_id]&fkey=$efield[d_id]&key="; ?>
					<li><div><?php if($sfield['in_id']==5){ ?>
                        	<div style="float:left;padding-top:3px;color:#090;">
							<?php if($efield['d_stitle']!='') $title = $efield['d_stitle']; else $title = $efield['d_mtitle']; ?>
								<span id="d_stitle<?=$efield['d_id']?>"><?=$title?></span>
                            </div>
                            <div style="float:right;">        
                            <?php if($ISEDIT){?>
                            		<img class="edit" onclick="showEdit('edit','','<?= $mPrm ?>d_stitle')" src="img/edit-icon.png"  />    
                                    <img class="edits" src="img/delete.png" title="<?=$title?>"
                                    onclick="dataActions(<?=$efield['d_id']?>,'<?=$title?>')"/>	
                            <?php } ?>
                            		<img class="edits" src="img/attachment.png" title="<?=$title?>"
                                    onclick="showAuto('showproof','<?=$title?>','attach=<?=$efield['d_value']?>')" />
                            </div>
					<?php }else if($sfield['in_id']==4){ ?>
                    	<?=$efield['d_value']?>           
                    <?php if($ISEDIT){?> 
                        <img onclick="dataActions(<?=$efield['d_id']?>,'<?=$sfield['fl_title']?>')" title="<?=$sfield['fl_title']?>" class="edit" src="img/delete.png" />      
                    <?php } ?>
					<?php }else{ ?>
							<?php if($sfield['fl_key']=='followup'){?>
                            		[ <?=date("j-F-Y",strtotime($efield['data_date']))?> ] 
							<?php } ?>
                            <span id="d_value<?=$efield['d_id']?>"><?=change_url_in_text(trim($efield['d_value']))?></span>
							<div style="float:right;">
							<?php if($ISEDIT){?>                            
                            		<img class="edit" onclick="showEdit('edit','','<?=$mPrm?>d_value')" src="img/edit-icon.png"  />
                            <?php if($sfield['is_multy']==1){ ?>
                            		<img class="edit" src="img/delete.png" title="<?=$title?>"
                                    onclick="dataActions(<?=$efield['d_id']?>,'<?=$efield['d_value']?>')"/>
                            <?php }} ?>
                            </div>
					<?php } ?>
                    		<div class="clear"></div>
                    	</div>
                 	</li><?php
				}
		?></ul>
        </td>
	</tr>
<?php }
	  if($sfield['t_id']!=$oTitle){ ?>
	</table>
<?php }}} 
if($istbl){?>
	</table>
<?php }} ?>