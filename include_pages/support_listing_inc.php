<section class="retracted scrollable">
<div class="row">
  <div class="col-md-12">
    <div class="report-sec">
    <div><div class="page-header">
       		<div class="page-header-content">
        		<div class="page-title3">	
        <h2>Ticket Listing</h2>
     
     </div>
     </div>
     </div>
      <div class="panel panel-default panel-block">
        <div class="panel-body">
			<div>
                 
                    
                            <table class="table datatable-basic" id="tableSortable">
                                <thead>
                                    <tr>
									<th>Ticket</th>
                                        <th>Subject</th>
										<th>Departement</th>
										<?php if($lEVEL!=4) echo '<th>User</th><th>Client</th><th>Check</th>'; ?>
                                        <th>Priority</th>
                                        <th>Added Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php	
										$company_id = $COMINF['id'];
										if($LEVEL == 4){
                                    		$system_support = $db->select("`system_support` sp LEFT JOIN `users` us ON sp.user_id=us.user_id ","*", "us.com_id=$company_id ORDER BY sp_id DESC");
                                    	}elseif($LEVEL == 6){
											$system_support = $db->select("`system_support`","*","sp_department = 'finance'");
										}else{
											$system_support = $db->select("`system_support`","*");
										}
                                    if(mysql_num_rows($system_support)>0){
										while($ticket = mysql_fetch_array($system_support)){ ?>
										<tr>
										 <td><?=$ticket['sp_ticker_number'];?></td>
                                            <td><?=ucwords($ticket['sp_title']);?></td>
											<td><?=strtoupper($ticket['sp_department']);?></td>
											<?php if($lEVEL!=4) { 
											$userInfo = getUserInfo($ticket['user_id']);
											echo '<td>'.$userInfo['first_name'].'</td>';
											
											if($userInfo['com_id']!="" && $userInfo['com_id']!=0 && $company_id==$userInfo['com_id']) {
											$getcompany = getcompany($userInfo['com_id']);
											$rsComInfo = mysql_fetch_assoc($getcompany);
												echo '<td>'.$rsComInfo['name'].'</td>';
											}else{
												echo '<td>N/A</td>';
											}
											
											if($ticket['as_id']!="" && $ticket['as_id']!=0) {
												
											
											$selChecks = $db->select("ver_checks vc INNER JOIN checks c ON vc.checks_id=c.checks_id ","c.checks_title","vc.as_id=".$ticket['as_id']);
											$rsCheckInfo = mysql_fetch_assoc($selChecks);
											echo '<td><a href="?action=start&ascase='.$ticket['as_id'].'&_pid=24" >'.$rsCheckInfo['checks_title'].'</a></td>';
											}else{
												echo '<td>N/A</td>';
											}
											
											}
											?>
                                            <td style="text-align:left"><?=ucwords($ticket['sp_priorty'])?></td>
                                            <td><?=date('d M Y',strtotime($ticket['sp_add_date']))?></td>
                                            <td align="center">
												<?php  
                                                    if($ticket['sp_status']==1) {
                                                    $img="accept.png";
                                                    $tit="Disable"; 
                                                    }else{
                                                    $img="cog_3.png";
                                                    $tit="Enable";
                                                    } 
                                                    $link=SURL.'?action=supportdetails&atype=support&ticket='.$ticket['sp_id'];
                                                ?>
                                                <a href="<?=$link?>" ><i class="icon-search4" ></i> </a>
                                            </td>
										</tr>
										<?php }
									}else{ ?>
                                        <tr>
                                        	<td></td>
                                       		<td ></td>
                                        	<td ></td>
                                       		<td ><h2 align="center">No Ticket</h2></td>
                                        	<td ></td>
                                       		<td ></td>
                                        	<td ></td>
                                       		<td ></td>
                                            
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                  
        		</div>
        </div>
       
        
      </div>
    </div>
   
    
        

    
  </div>
</div>

