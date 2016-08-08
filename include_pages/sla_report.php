    <section class="retracted scrollable">
        <div class="row">
            <div class="col-md-12">
                <div class="manager-report-sec">
                    
                
                    <div class="panel panel-default panel-block">
                     <div class="list-group-item">
                    <div class="page-section-title">
                    	<h2 class="box_head">SLA Report</h2>
                    </div>
                        <!--<div id="data-table" class="panel-heading datatable-heading">
                        <h4 class="section-title">Follow Up Alert</h4>
                        </div>-->
                        <table class="table table-bordered table-striped" id="tableSortable">
                            <thead>
                                <tr>
                                    <th>ID #</th>
                                    <th>Candidate Name</th>
                                    <th>Check Title</th>
                                    <th>Check Open Date</th>
                                    <th>Check Close Date</th>
                                    <th>Due Date</th>
                                    <th>Total Days</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 		
								$tbls = "company com LEFT JOIN ver_data vd ON vd.com_id = com.id LEFT JOIN ver_checks vc ON vc.v_id = vd.v_id LEFT JOIN checks ch ON vc.checks_id = ch.checks_id";
                                $where = "vc.as_status='Close' AND vc.as_isdlt=0 AND vd.v_isdlt=0 AND vd.v_status='Close' order by vc.as_id desc limit 0,1000";
                                $data = $db->select($tbls,"*",$where);
                                while($re = mysql_fetch_array($data)) {?>
                                <tr>
                                    <td><?=$re['emp_id']?></td>
                                    <td><a href="?action=details&case=<?=$re['v_id']?>"><?=$re['v_name']?></a></td>
                                    <td><?=$re['checks_title']?></td>
                                    <td><?=date("j-M-Y",strtotime($re['as_addate']))?></td>
                                    <td><?=date("j-M-Y",strtotime($re['as_cldate']))?></td>
                                    <td><?=getdatedifference($re['as_addate'], TAT)?></td>
                                    <td><?=getDaysFromDates($re['as_cldate'],$re['as_addate'])?></td>
                                </tr>        
                                <?php }
								
								
	
	
		
								
	
								?>
                            </tbody>
                        
                           
                        </table>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script src="scripts/proton/tables.js"></script>