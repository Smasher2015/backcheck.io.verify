<?php $where = "com_id=$COMINF[id] AND c.as_status<>'close'"; ?>
<div class="box grid_16 tabs">		
        <h2 class="box_head"><?=$PTITLE?></h2>
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
                $cols = "COUNT(d.v_id) AS cnt,d.v_stdate,d.v_date,d.v_cldate,d.emp_id, d.v_id,.d.v_name,d.v_nic,d.com_id";
				$cols = "$cols,d.v_ftname,d.v_status,d.v_rlevel,p.name,p.id,d.v_sent";
                $tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN company p ON p.id=d.com_id";
               
                $data = $db->select($tbls,$cols,"$where GROUP BY d.v_id ORDER BY d.v_date DESC");
                while($re = mysql_fetch_array($data)) { 
                if($LEVEL==2 || $LEVEL==3 || $LEVEL==4){
                    $onClick="?action=details&case=$re[v_id]";
                }else $onClick = " class=\"shover\" ";
                $showChk="showData(this,'ePage=checksinfo&case=$re[v_id]&action=$action&atype=$aType','v$re[v_id]')";
                $csSts = strtolower($re['v_status']);
                if($LEVEL==4) $csSts = (($csSts=='close') && ($re['v_sent']==4))?'close':'';
                ?>
                <tr class="shover">
                    <td>&nbsp;</td>
                    <td style="text-align:left">
                        <a href="<?=$onClick?>"><?=$re['v_name']?></a>
                    </td>
                    
                    <td >
                        <?=date("j-M-Y",strtotime($re['v_date']))?>
                    </td>
                    <td>
                        <?php 
								$docs = docStatus($re['v_id']);
								$pbr = @(($docs['docs']/$docs['tdcs'])*100);
						?>                
                        <div class="progress_bar">
                            <div class="bar <?=($pbr==100)?'green':'yellow'?>" style="width:<?=$pbr?>%"></div>
                        </div>
                    </td>
                    <td ><?="$docs[docs] of $docs[tdcs]"?></td>
                    <td >
                        <span>
                            <?=($re['v_status']=='Not Assign')?'Not Initiated':'Work in Progress'?>
                        </span>
                    </td>
                </tr>        
                <?php }?>
        </tbody>
    </table>    
</form>
            </div>
            </div>
        </div>
    </div>
