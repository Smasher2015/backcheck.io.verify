<?php 
$where = "com_id=$COMINF[id] AND c.as_status<>'close'";
$cols = "COUNT(d.v_id) AS cnt,d.v_stdate,d.v_date,d.v_cldate,d.emp_id, d.v_id,.d.v_name,d.v_nic,d.com_id";
$cols = "$cols,d.v_ftname,d.v_status,d.v_rlevel,p.name,p.id,d.v_sent";
$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN company p ON p.id=d.com_id";

$data = $db->select($tbls,$cols,"$where GROUP BY d.v_id ORDER BY d.v_date DESC");
$applic = array();$row=0;
while($re = mysql_fetch_assoc($data)){ 
	$docs = docStatus($re['v_id']);
	$pbr = @(($docs['docs']/$docs['tdcs'])*100);
	if($pbr==100) $aind = 'complete'; else $aind = 'pending'; 
	foreach($re as $key=>$value){
		$applic[$aind][$row][$key] = $value;
	}
	$applic[$aind][$row]['docs'] = $docs['docs'];
	$applic[$aind][$row]['tdcs'] = $docs['tdcs'];
	$applic[$aind][$row]['pbar'] = $pbr;
	$row=$row+1;
}
?>

<div class="box grid_16 tabs">		
        <h2 class="box_head">Pending Applications</h2>
        <a href="#" class="grabber">&nbsp;</a>
        <a href="#" class="toggle">&nbsp;</a>
        <div class="toggle_container">
            <div class="block">
             <div id="dt2">
            
<form class="table-form" action="" method="post" name="assignTask" enctype="multipart/form-data">
    <table class="display datatable">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Candidate Name</th>
                <th>Submitted Date</th>
                <th>Doc. Status</th>
                <th>Done</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
				<?php 
				if(count($applic['pending'])>0){
				foreach($applic['pending'] as $re){
						$onClick="?action=details&case=$re[v_id]&_pid=$IPAGE[m_id]";?>
                <tr class="shover">
                    <td>&nbsp;</td>
                    <td style="text-align:left">
                        <a href="<?=$onClick?>"><?=$re['v_name']?></a>
                    </td>
                    
                    <td >
                        <?=date("j-M-Y",strtotime($re['v_date']))?>
                    </td>
                    <td>                
                        <div class="progress_bar">
                            <div class="bar yellow" style="width:<?=$re['pbar']?>%"></div>
                        </div>
                    </td>
                    <td ><?="$re[docs] of $re[tdcs]"?></td>
                    <td >
                        <span>
                            <?=($re['v_status']=='Not Assign')?'Not Initiated':'Work in Progress'?>
                        </span>
                    </td>
                </tr>        
                <?php }
				}?>
        </tbody>
    </table>    
</form>
            </div>
            </div>
        </div>
    </div>
    
<div class="box grid_16 tabs">		
        <h2 class="box_head">Completed Applications</h2>
        <a href="#" class="grabber">&nbsp;</a>
        <a href="#" class="toggle">&nbsp;</a>
        <div class="toggle_container">
            <div class="block">
             <div id="dt2">
            
<form class="table-form" action="" method="post" name="assignTask" enctype="multipart/form-data">
    <table class="display datatable">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Candidate Name</th>
                <th>Submitted Date</th>
                <th>Doc. Status</th>
                <th>Done</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
				<?php
				if(count($applic['complete'])>0){
				foreach($applic['complete'] as $re){
							$onClick="?action=details&case=$re[v_id]";?>
                <tr class="shover">
                    <td>&nbsp;</td>
                    <td style="text-align:left">
                        <a href="<?=$onClick?>"><?=$re['v_name']?></a>
                    </td>
                    
                    <td >
                        <?=date("j-M-Y",strtotime($re['v_date']))?>
                    </td>
                    <td>                
                        <div class="progress_bar">
                            <div class="bar green" style="width:<?=$re['pbar']?>%"></div>
                        </div>
                    </td>
                    <td ><?="$re[docs] of $re[tdcs]"?></td>
                    <td >
                        <span>
                            <?=($re['v_status']=='Not Assign')?'Not Initiated':'Work in Progress'?>
                        </span>
                    </td>
                </tr>        
                <?php }
				}?>
        </tbody>
    </table>    
</form>
            </div>
            </div>
        </div>
    </div>