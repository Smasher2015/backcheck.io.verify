<?php 
if($_REQUEST['date']==''){
	$_REQUEST['date']=date("Y-m-d");
}else{
	 $_REQUEST['date']=$_REQUEST['date'];
}
function count_checks_total($user_id,$status){
	global $db;
	switch($status){
		case "received":
		$where="`as_addate` LIKE '%".date('Y-m-d')."%' AND user_id=$user_id";
		break;
		case "closed":
		$where="`as_status`='CLOSE' AND user_id=$user_id AND `as_pdate` LIKE '%".$_REQUEST['date']."%'";
		break;
		case "open":
		$where="`as_status`='OPEN' AND user_id=$user_id AND `as_pdate` LIKE '%".$_REQUEST['date']."%'";
		break;
		case "insufficient":
		$where="`as_vstatus`='Insufficient' AND user_id=$user_id AND `as_pdate` LIKE '%".$_REQUEST['date']."%'";
		break;
		case "initiated":;	
		$where="`as_vstatus`='Initiated' AND user_id=$user_id AND `as_pdate` LIKE '%".$_REQUEST['date']."%'";
		break;
		case "originally_required":
		$where="`as_vstatus`='Original Required' AND user_id=$user_id AND `as_pdate` LIKE '%".$_REQUEST['date']."%'";
		break;
		case "followup":
		$where="`as_vstatus`='Followup' AND user_id=$user_id AND `as_pdate` LIKE '%".$_REQUEST['date']."%'";
		break;
		default:
		return "N/A";
}
	$log_info=$db->select("ver_checks","count(as_id) as count_return",$where);
	$log_info=mysql_fetch_array($log_info);
	return $log_info['count_return'];
}
?>
<section class="retracted scrollable">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
        <div id="filters" class="section" >
          <div class="list-group-item" >
                <div class="box grid_16 tabs">		
        <h2 class="box_head">Today Logs ( <?php echo $_REQUEST['date'];?> )</h2>
        <a href="#" class="grabber">&nbsp;</a>
        <a href="#" class="toggle">&nbsp;</a>
        <div class="toggle_container">
            <div class="block">
             <div id="dt2">  
<table class="table table-bordered table-striped" id="">    	<thead>
    		<tr>
        		<th>Analyst Name</th>
            	<th>Recieved</th>
                <th>Closed</th>
                <th>Open</th>
                <th>Insufficient</th>
                <th>Original Required</th>
                <th>Initiated</th>
                <th>Follow Up</th>
        	</tr>
        </thead>
        <tbody>
          <?php	$analyst= $db->select("users","first_name,last_name,user_id","is_active=1 and level_id=3");
        if(mysql_num_rows($analyst)>0){
        while($analyst_arr = mysql_fetch_array($analyst)){ ?>
            <tr>
                <td><?=$analyst_arr['first_name']." ".$analyst_arr['last_name']?></td>
                <td><a href="?action=logdetail&atype=checks&uid=<?=$analyst_arr['user_id']?>&status=received" target="_blank"><?=count_checks_total($analyst_arr['user_id'],"received")?></a></td>
                <td><a href="?action=logdetail&atype=checks&uid=<?=$analyst_arr['user_id']?>&status=closed" target="_blank"><?=count_checks_total($analyst_arr['user_id'],"closed")?></a></td>
                <td><a href="?action=logdetail&atype=checks&uid=<?=$analyst_arr['user_id']?>&status=open" target="_blank"><?=count_checks_total($analyst_arr['user_id'],"open")?></a></td>
                <td><a href="?action=logdetail&atype=checks&uid=<?=$analyst_arr['user_id']?>&status=insufficient" target="_blank"><?=count_checks_total($analyst_arr['user_id'],"insufficient")?></a></td>
                <td><a href="?action=logdetail&atype=checks&uid=<?=$analyst_arr['user_id']?>&status=originally_required" target="_blank"><?=count_checks_total($analyst_arr['user_id'],"originally_required")?></a></td>
                <td><a href="?action=logdetail&atype=checks&uid=<?=$analyst_arr['user_id']?>&status=initiated" target="_blank"><?=count_checks_total($analyst_arr['user_id'],"initiated")?></a></td>
                <td><a href="?action=logdetail&atype=checks&uid=<?=$analyst_arr['user_id']?>&status=followup" target="_blank"><?=count_checks_total($analyst_arr['user_id'],"followup")?></a></td>
            </tr>	    
    	<?php }}else{?>
				<tr>
                	<td align="center" colspan="8">No Record Found</td>
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