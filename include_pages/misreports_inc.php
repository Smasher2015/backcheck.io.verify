<div class="box grid_16 tabs">		
        <h2 class="box_head"><?=$PTITLE?></h2>
        <a href="#" class="grabber">&nbsp;</a>
        <a href="#" class="toggle">&nbsp;</a>
        <div class="toggle_container">
            <div class="block">
             <div id="dt2">
                <table class="display datatable">
                    <thead>
                        <tr>
                            <th>Applicant's ID</th>
                            <th>Client's name</th>
                            <th>Applicant's Name</th>
                            <th>Case Status</th>
                            <?php 
                
                                $CHKA = array();
                                $db = new DB();
                                $tbl="ver_checks vc INNER JOIN ver_data vd ON vd.v_id=vc.v_id INNER JOIN checks ck ON vc.checks_id=ck.checks_id";
                                $twhere = "vd.v_isdlt=0 AND vc.as_isdlt=0 AND vc.user_id=$USERID ORDER BY ck.checks_id";
                                $ch=$db->select($tbl,"DISTINCT ck.checks_id,ck.checks_title",$twhere);        
                                while($checks=mysql_fetch_array($ch)){ 
                                      $CHKA[count($CHKA)]=$checks['checks_id'];?>
                                      <th><?=mb_convert_encoding($checks['checks_title'], 'HTML-ENTITIES','UTF-8');?></th>
                            <?php } ?>   
                            <th>Date of Receiving</th>
                            <th>Date of Submission</th>         
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $tbl="ver_checks vc INNER JOIN ver_data vd ON vd.v_id=vc.v_id INNER JOIN checks ck ON vc.checks_id=ck.checks_id";
                                $twhere = "vd.v_isdlt=0 AND vc.as_isdlt=0 AND vc.user_id=$USERID ORDER BY ck.checks_id";
                                $company = array();   
                                $records = $db->select($tbl,"DISTINCT vd.v_id,vd.emp_id,vd.v_name,vd.com_id,vd.v_rlevel,vd.v_date,vd.v_stdate",$twhere);
                                while($record = mysql_fetch_assoc($records)){ ?>
                                    <tr>
                                        <td><?=$record['emp_id']?></td>
                                        <td><?php
												if(!isset($company[$record['com_id']])){
                                        			$company[$record['com_id']] = getcompany($record['com_id']);
													$company[$record['com_id']] = mysql_fetch_assoc($company[$record['com_id']]);
													$company[$record['com_id']] = $company[$record['com_id']]['name'];
												}
												echo $company[$record['com_id']];
										?></td>
                                        <td><?=$record['v_name']?></td>
                                        <td><?=$record['v_rlevel']?></td>
                                        <?php foreach($CHKA as $chk){ 
                                                    $checks = $db->select("ver_checks","*","checks_id=$chk AND v_id=$record[v_id]"); ?>
                                                    <td><?php
                                                        $cellv=""; $cnt=1;
                                                        $num = mysql_num_rows($checks);
                                                        $isC = ($num>1)?true:false; 
                                                        if($num>0){
                                                            while($check = mysql_fetch_assoc($checks)){
                                                                $cellv .=  (($cellv!='')?'
                ':'').(($isC)?"<strong>$cnt :</strong>":'').$check['as_vstatus'];	
                                                                $cnt=$cnt+1;	
                                                            }
                                                            echo $cellv;
                                                        }else echo '-----';
                                                    ?></td>
                                        <?php } ?>                                
                                        <td><?=date("j-M-Y",strtotime($record['v_date']))?></td>
                                        <td><?php
                                                if($record['v_stdate']!=''){
                                                    echo date("j-M-Y",strtotime($record['v_stdate']));
                                                }else echo 'N/A';
                                            ?></td>
                                    </tr>	
                        <?php		} ?>
                    </tbody>
                </table>

            </div>
            </div>
        </div>
    </div>