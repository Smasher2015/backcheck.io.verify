    <section class="retracted scrollable">
        <div class="row">
            <div class="col-md-12">
                <div class="report-sec">
                      <div class="page-header">
            <div class="page-header-content">
                <div class="page-title3">
                    	<h2>Follow Up Alert</h2>
                    </div>
                    </div>
                    </div>
                
                    <div class="panel panel-default panel-block">
                     <div class="panel-body">
                    
                        <!--<div id="data-table" class="panel-heading datatable-heading">
                        <h4 class="section-title">Follow Up Alert</h4>
                        </div>-->
                        <table class="table datatable-basic dataTable" id="tableSortable">
                            <thead>
                                <tr>
                                   
                                    <th>ID #</th>
                                    <th>Candidate Name</th>
                                    <th>Analyst</th>
                                    <th>Check Title</th>
                                    <th>Last Process Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 		
                                $cols = "vc.user_id,vd.v_id,vd.emp_id,vd.v_name,cc.checks_title,vc.as_status, IF(ISNULL(vc.as_pdate),vc.as_date,vc.as_pdate) AS pdate";
                                $tbls = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id INNER JOIN checks cc ON cc.checks_id=vc.checks_id";
                                $where = "vc.as_status!='close' AND vc.as_status!='Not Assign' AND vc.as_isdlt=0 AND vd.v_isdlt=0 AND vd.v_status!='close' AND DATEDIFF(NOW(),IF(ISNULL(vc.as_pdate),vc.as_date,vc.as_pdate))>2";
                                if($LEVEL==3) $where = $where." AND vc.user_id='". $USERID ."'";
                                $data = $db->select($tbls,$cols,$where);
                                while($re = mysql_fetch_array($data)) {?>
                                <tr>
                                    <td><?=$re['emp_id']?></td>
                                    <td><a href="?action=details&case=<?=$re['v_id']?>"><?=$re['v_name']?></a></td>
                                    <td><?php 
                                    $userInfo = getUserInfo($re['user_id']);
                                    echo trim($userInfo['first_name'].' '.$userInfo['last_name']);
                                    ?>
                                    </td>
                                    <td><?=$re['checks_title']?></td>
                                    <td><?=date("j-M-Y",strtotime($re['pdate']))?></td>
                                    <td><span class="label label-warning"><?=$re['as_status']?></span></td>
                                </tr>        
                                <?php }?>
                            </tbody>
                        
                           
                        </table>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script src="scripts/proton/tables.js"></script>