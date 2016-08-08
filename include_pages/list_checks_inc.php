<style type="text/css">
/*.nstyle ul li{
	list-style:none;
	margin:5px 0px;
	padding:0;
}
.mainUH tr td:first-child{
	width:30%;
}*/
#showDataimage img{ width:100%;}
</style>
<section class="retracted scrollable">
<div class="row">
  <div class="col-md-12">
    <div class="manager-report-sec">
       <div class="page-section-title">
                    <h2 class="box_head"><?=$verCheck['checks_title']?></h2>
                    </div>
      <div class="panel panel-default panel-block">
    	
  
    <div class="block">	
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
	$ISEDIT = ($LEVEL==2)?true:(($csSts=='close')?false:true);
	$mPrm="ascase=$verCheck[as_id]&fkey=$verCheck[as_id]&key="; ?>
<div class="list-group-item">
<table class="table table-bordered table-striped dataTable" id="tableSortable">
    <tbody>
        <tr class="shover">
            <td>Verification Status:</td>
            <td class="f<?=vs_Status(strtolower($verCheck['as_vstatus']));?>">
				<?php echo  $verCheck['as_vstatus'].' [ '.$verCheck['as_status'].' ]'; ?>
            </td>
        </tr>
		<?php if($verCheck['as_status']=="Close" || $verCheck['as_qastatus']=="Rejected"){ 
		switch($verCheck['as_qastatus']){
												 	case  "Approved":
													$color = '#8DC655';
													break;
													case  "Rejected":
													$color = '#e8511a';
													break;
													case  "QA":
													$color = '#00b9f7';
													break;

												}
												
		if($verCheck['as_qastatus']){?>
		<tr class="shover">
            <td>QC Status:</td>
			
            <td class="f">
			
			
			
				<span class="detail-report-check-status green-risk-sts" style="background-color:<?php echo $color; ?>">
                <?php echo ($verCheck['as_qastatus']=='QA')?'QC':$verCheck['as_qastatus'];?>
                </span>
            </td>
        </tr>
		<?php }
		}		?>
        <tr class="shover">
            <td >Manager Remarks:</td>
            <td class="algleft">
				
						<span id="as_remarks<?=$verCheck[as_id]?>"><?=$verCheck['as_remarks']?></span>
                        <?php if($ISEDIT && $LEVEL==2){?>
                        	<img class="edit" onclick="showEdit('edit','Manager Remarks','<?= $mPrm ?>as_remarks')" src="img/edit-icon.png"  />
                        <?php } ?>
                
            </td>
        </tr>
        <tr class="shover">
            <td >Country :</td>
            <td class="algleft">
			
						<?php
                        	$country = $db->select("country","printable_name","country_id=$verCheck[country_id]");
							if(mysql_num_rows($country)>0){
								$country = mysql_fetch_assoc($country); echo $country['printable_name'];	
							}else{
								echo "N/A";
							}
                        ?>
                
            </td>
        </tr>
        <tr class="shover">
            <td >City / State :</td>
            <td class="algleft">
			
						<?php
                        	$city = $db->select("statescity","citystats","citystate_id=$verCheck[citystate_id]");
							if(mysql_num_rows($city)>0){
								$city = mysql_fetch_assoc($city); echo $city['citystats'];	
							}else{
								echo "N/A";
							}
                        ?>						
                  
            </td>
        </tr>        
    </tbody>
</table>
</div>
<?php

$checkid = getcheckP($verCheck['checks_id']);
$sfields = $db->select("fields_maping","*","checks_id=$checkid AND fl_type='s' ORDER BY t_id,fl_ord");

$oTitle='';
$istbl = false;
$Fileds =  array();
$c=0;
while($sfield = mysql_fetch_array($sfields)){
	
$efields = $db->select("add_data","*","(as_id=$verCheck[as_id] and d_type='$sfield[fl_key]' AND d_isdlt=0) ORDER BY d_id ASC ");
if(mysql_num_rows($efields)>0){ 
	if($sfield['t_id']!=$oTitle){ ?>
	<div class="list-group-item">
   
                    <h2 class="box_head">
						<?php
                        $oTitle = $sfield['t_id'];
						$istbl=true;
                        $title = $db->select("titles","*","t_id=$sfield[t_id]");
                        $title = mysql_fetch_array($title);
                        $title = $title['t_title'];
                        echo $title;
                ?>
                </h2>
           <?php } ?>
<table class="table two_col table-bordered table-striped dataTable">
<?php if($sfield['fl_key']=='multy'){ ?>
	<tr>
		<td colspan="2">
			<table class="three_col table table-bordered table-striped dataTable " cellpadding="0" cellspacing="0">
				<thead>
                <tr>
					<th><b>Information Title</b></th>
					<th><b>Information Provided</b></th>
					<th><b>Information Verified</b></th>
				</tr>
                </thead>
<?php   $ind=1;
		while($efield = mysql_fetch_array($efields)){ 
			$mPrm="typ=multy&ascase=$verCheck[as_id]&data=$efield[d_id]&fkey=$ind&key="; ?>                        
				<tr>
					<td id="mtt1<?=$ind?>">
						<?=$efield['d_mtitle'];?>
                    </td>
					<td id="stt1<?=$ind?>">
						<?=$efield['d_stitle'];?>
                    </td>
					<td>
						<span id="val1<?=$ind?>"><?=$efield['d_value'];?></span>
                     	<?php if($ISEDIT){ ?>
                        	<img class="edit" onclick="showEdit('edit','','<?= $mPrm ?>d_value',500,270)" src="img/edit-icon.png"  />
                            <img class="edit" onclick="dataActions(<?=$efield['d_id']?>,'<?=$sfield['fl_title']?>')" title="<?=$sfield['fl_title']?>" src="images/icons/small/grey/cross.png" />	
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
      <?php 
				while($efield = mysql_fetch_array($efields)){
					$Fileds[] = $efield[d_type];
					
					$mPrm="ascase=$verCheck[as_id]&data=$efield[d_id]&fkey=$efield[d_id]&key="; ?>
					<div><?php if($sfield['in_id']==5){ $c++;?>
                        	<div style="float:left;padding-top:3px;color:#090;">
							<?php if($efield['d_stitle']!='') $title = $efield['d_stitle']; else $title = $efield['d_mtitle']; ?>
								<span id="d_stitle<?=$efield['d_id']?>"><?=$title?></span>
                            </div>
                            <div style="float:right;">        
                            <?php if($ISEDIT){?>
                            		<img class="edit" onclick="showEdit('edit','','<?= $mPrm ?>d_stitle')" src="img/edit-icon.png"  />    
                                    <img class="edits" src="images/icons/small/grey/cross.png" title="<?=$title?>"
                                    onclick="dataActions(<?=$efield['d_id']?>,'<?=$title?>')"/>	
                            <?php } ?>
	<a href="javascript:void(0)"  data-toggle="modal" data-target="#myModal<?php echo $c;?>">View Proof</a>
                                    <img class="edits" src="images/icons/small/grey/paperclip.png" title="<?=$title?>"
                                    
                                <!-- Modal -->
<div id="myModal<?php echo $c;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"><i class="icon-attachment"></i><span><?=$title?></span></h4>
      </div>
      <div id="showDataimage" class="modal-body">
	  <?php if(file_exists(getcwd().'/'.$efield['d_value'])){?>
        <img class="" src="<?=SURL.$efield['d_value']?>" title="<?=$title?>" width="100%">
	  <?php }else{ 
		  echo "<h3>No Attachment available !</h3>";
	  } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  </div>
</div>
                            </div>
					<?php }else if($sfield['in_id']==4){ ?>
                    	<?=$efield['d_value']?>           
                    <?php if($ISEDIT){?> 
                        <img onclick="dataActions(<?=$efield['d_id']?>,'<?=$sfield['fl_title']?>')" title="<?=$sfield['fl_title']?>" class="edit" src="images/icons/small/grey/cross.png" />      
                    <?php } ?>
					<?php }else{ ?>
							<?php if($sfield['fl_key']=='followup'){?>
                            		[ <?=date("j-F-Y",strtotime($efield['data_date']))?> ] 
							<?php } ?>
                            <span id="d_value<?=$efield['d_id']?>"><?=change_url_in_text(trim($efield['d_value']))?></span>
							<div style="float:right;">
							<?php if($ISEDIT){
								
								if($efield['d_type']!='vuni'){?>                            
                            		<img class="edit" onclick="showEdit('edit','','<?=$mPrm?>d_value')" src="img/edit-icon.png"  />
								<?php }
							if($sfield['is_multy']==1){ ?>
                            		<img class="edit" src="images/icons/small/grey/cross.png" title="<?=$title?>"
                                    onclick="dataActions(<?=$efield['d_id']?>,'<?=$efield['d_value']?>')"/>
                            <?php }} ?>
                            </div>
					<?php } ?>
                    		<div class="clear"></div>
                    	</div>
                 	<?php
				}
		?>
        </td>
	</tr>
<?php }
	  if($sfield['t_id']!=$oTitle){ ?>
	</table>
<?php } }
if($istbl){ ?>
	</table>
<?php }
} 
/* if($istbl){ ?>
	</table>
<?php } */ 
} ?>
    </div>
    </div>
</div>
</div>
</div>
</div>
</section>