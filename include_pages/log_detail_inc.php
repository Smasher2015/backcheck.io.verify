<?php 
if(is_numeric($_REQUEST['uid']) && $_REQUEST['status']!=''){
	$user_id=$_REQUEST['uid'];
	switch($_REQUEST['status']){
		case "received":
		$where="`as_addate` LIKE '%".date('Y-m-d')."%' AND user_id=$user_id";
		break;
		case "closed":
		$where="`as_status`='CLOSE' AND user_id=$user_id AND `as_pdate` LIKE '%".date('Y-m-d')."%'";
		break;
		case "open":
		$where="`as_status`='OPEN' AND user_id=$user_id AND `as_pdate` LIKE '%".date('Y-m-d')."%'";
		break;
		case "insufficient":
		$where="`as_vstatus`='Insufficient' AND user_id=$user_id AND `as_pdate` LIKE '%".date('Y-m-d')."%'";
		break;
		case "initiated":
		$where="`as_vstatus`='Initiated' AND user_id=$user_id AND `as_pdate` LIKE '%".date('Y-m-d')."%'";
		break;
		case "originally_required":
		$where="`as_vstatus`='Original Required' AND user_id=$user_id AND `as_pdate` LIKE '%".date('Y-m-d')."%'";
		break;
		case "followup":
		$where="`as_vstatus`='Followup' AND user_id=$user_id AND `as_pdate` LIKE '%".date('Y-m-d')."%'";
		break;
		default:
		return "N/A";
}
	$log_info=$db->select("ver_checks","*",$where);
?>
<section class="retracted scrollable">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
        <div id="filters" class="section" >
          <div class="list-group-item" >
                <div class="box grid_16 tabs">		
        <h2 class="box_head"><?=mysql_num_rows($log_info)?> checks Found</h2>
        <a href="#" class="grabber">&nbsp;</a>
        <a href="#" class="toggle">&nbsp;</a>
        <div class="toggle_container">
            <div class="block">
             <div id="dt2">  
<table class="table table-bordered table-striped" id="">    	<thead>
    		<tr>
            	<th>Check Id</th>
                <th>Check Name</th>
        		<th>Analyst Name</th>
       			<th>Candidate Name</th>
                <th>Client Name</th>
        	</tr>
        </thead>
        <tbody>
          <?php	
		  $userinfo=getUserInfo($user_id);
        if(mysql_num_rows($log_info)>0){
        while($log_info_arr = mysql_fetch_array($log_info)){
				$caseinfo=getInfo("ver_data","v_id=".$log_info_arr['v_id']."");
				$checkinfo=getInfo("checks","checks_id=".$log_info_arr['checks_id']."");
				$clientinfo=getInfo("company","id=".$caseinfo['com_id']."");
			 ?>
            <tr>
            	<td><?=$log_info_arr['as_id']?></td>
                <td><?=$checkinfo['checks_title']?></td>
                 <td><?=$userinfo['first_name']." ".$userinfo['last_name']?></td>
                 <td><?=$caseinfo['v_name']?></td>
                  <td><?=$clientinfo['name']?></td>
            </tr>	    
    	<?php }}else{?>
				<tr>
                	<td align="center" colspan="5">No Record Found</td>
                </tr>
		<?php 
			
			}?>
            </tr>
        </tbody>
        
    </table>
        </div>
            </div>
        </div>
    </div>

              </div>
            </div>
          </div>
        </div>
      </div>
  <div class="clear"></div> 
</section>
<?php } ?>