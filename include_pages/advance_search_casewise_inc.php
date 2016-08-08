<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<style type="text/css" class="init">

td.details-control {
	background: url('images/details_open.png') no-repeat center center;
}

tr.shown td.details-control {
	background: url('images/details_close.png') no-repeat center center;
}

td.details-control, td.details-show {
	cursor: pointer;
}
.highcharts-button {
	display:none !important;
}
.rating-checks {
	width: auto;
	border-spacing: initial;
	margin: 0;
	word-break: break-word;
	table-layout: auto;
	line-height: 1.8em;
	color: #333;
    float: none;
   text-align: inherit;
  position: relative;
}
.rating-checks ul {
  margin-left: -50px;
}
.rating-checks ul li {
 
  color:#999999;
}
div.green_cheks{ background:#92c83e;color:#ffffff; text-align:center; border-top:1px solid #ffffff;} 
div.orange_cheks{ background:#ffae00;color:#ffffff; text-align:center; border-top:1px solid #ffffff;}
div.red_cheks{ background:#F00;color:#ffffff; text-align:center; border-top:1px solid #ffffff;}
</style>

<?php 

if($IPAGE['m_where']!='') {
		$pm_where = $IPAGE['m_where'];
	}else{
		$pm_where = '';	
	}
	if($IPAGE['m_orderby']!='') {
		$m_orderby = $IPAGE['m_orderby'];
	}else{
		$m_orderby = '';	
	}
	$check_status = 'all';
	
if(isset($_REQUEST['search_status']) || isset($_REQUEST['save_search_resuts'])){
	
	$from_dt  		= $_REQUEST['from_dt'];
	$to_dt  		= $_REQUEST['to_dt'];
	$check_status  	= $_REQUEST['check_status'];
	$name_id  		= $_REQUEST['name_id'];
	$s_checks_id  	= $_REQUEST['s_checks_id'];
	$user_id  		= (int) $_REQUEST['user_id'];
	$client_id  	= (int) $_REQUEST['client_id'];
	$loc_id  		= (int) $_REQUEST['loc_id'];
	$_days  		= (int) $_REQUEST['_days'];
	
	$whDates="";
	$clientWhere="";
	$userWhere="";
	$name_idWhere="";
	
	if($from_dt && $to_dt){
	$whDates = " BETWEEN '".$from_dt."' AND '".$to_dt."'";
	}
	switch($check_status){
		case 'no_risk':
		$pm_where = "as_status = 'Close' AND as_qastatus!='Rejected' AND  as_sent=4 AND as_isdlt=0 AND as_vstatus NOT IN ('negative', 'match found', 'record found') ";
		$asDate = "as_cldate";
		break;
		case 'low_risk':
		$pm_where = "as_status = 'Close' AND as_qastatus!='Rejected' AND as_sent=4 AND as_isdlt=0 AND as_vstatus IN ('unable to verify', 'discrepancy') ";
		$asDate = "as_cldate";
		break;
		case 'high_risk':
		$pm_where = "as_sent=4 AND as_status='Close' AND as_qastatus!='Rejected' AND as_isdlt=0 AND (as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found') ";
		$asDate = "as_cldate";
		break;
		case 'all':
		$pm_where = " as_isdlt=0  ";
		$asDate = "as_addate";
		break;
		case 'open':
		$pm_where = "as_status = 'Open'  AND as_isdlt=0 AND as_cldate IS NULL ";
		$asDate = "as_addate";
		break;
		case 'close':
		$pm_where = "as_status = 'Close' AND as_qastatus!='Rejected' AND as_isdlt=0  ";
		$asDate = "as_cldate";
		break;
		case 'invoiced':
		$pm_where = "invoiced=1 AND as_status = 'Close' AND as_qastatus!='Rejected' AND as_sent=4 AND v_status='Close' AND as_isdlt=0  ";
		$asDate = "as_cldate";
		break;
	}
	//AND DATE_FORMAT(as_cldate, '%Y-%m-%d')
	
	if($from_dt && $to_dt){
	$whDates = " AND DATE_FORMAT($asDate, '%Y-%m-%d')".$whDates;
	}
	
	if(is_numeric($client_id) && $client_id!=0){
	
	$clientWhere =	" AND vd.com_id=$client_id ";
		
	}
	if(is_numeric($user_id) && $user_id!=0){
	
	$userWhere =	" AND vc.user_id=$user_id ";
		
	}
	
	if(!empty($name_id) ){
	
	$name_idWhere =	" AND ( vd.v_name LIKE '%".$name_id."%' OR vd.emp_id = '".$name_id."' ) ";
		
	}
	if(is_numeric($s_checks_id) && $s_checks_id!=0){
		
	$s_checks_idWhere =	" AND  vc.checks_id  = '".$s_checks_id."'  ";
		
	}
	
	if(is_numeric($loc_id) && $loc_id!=0 && $client_id!=0){
	$uids =	getUseridsByLocationId($loc_id,$client_id);
	$locationInf = getInfo("users_locations","loc_id=$loc_id AND com_id=$client_id");
	if(!empty($uids)){
	$v_uadd_checks_idWhere =	" AND v_uadd IN (".implode(",",$uids).") AND as_uadd IN (".implode(",",$uids).")  ";
	}else{
	msg("err","No users in $locationInf[location] location!");
	}
	
	}
	
	
	$pm_where = $pm_where.$whDates.$clientWhere.$userWhere.$name_idWhere.$s_checks_idWhere.$v_uadd_checks_idWhere;
	//echo  $pm_where;
		
}
	
	
?>
<script type="text/javascript" language="javascript" src="scripts/jquery.dataTables.js"></script>
        <section class="retracted scrollable">
           <script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
	var orderby = <?php echo (!empty($m_orderby))?4:2;?>;
	
	var table = $('#example').DataTable( {
		
		"processing": true,
        "serverSide": true,
		
		/*"language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)"
        },*/
		
		"ajax": "actions.php?json_param=1&json_call=advance_search_casewise_info&action=fedit&fedit=s&pm_where=<?=base64_encode($pm_where)?>&m_orderby=<?=$m_orderby?>&_days=<?=$_days?>&check_status=<?=$check_status?>",
		
		"columns": [
			{
				"className":      'details-controlxxxx',
				"orderable":      false,
				"data":           null,
				"defaultContent": ''
			},
			<?php if($LEVEL!=4){?>
			{ "data": "com_name",
			  "className":      'details-show'
			},
			<?php } ?>
			
			{ "data": "emp_id",
			  "className":      'details-show'
			},
			{ "data": "v_name",
			  "className":      'details-show'
			},
			{ "data": "check_count",
			  "className":      'details-show'
			},
						
			{ "data": "ndate",
			"className":      'details-show'},
			 
			 { "data": "modify_status",
			"className":      'details-show details-progress' }
		],
		
		"order": [[<?php echo (!empty($m_orderby))?4:4;?>, 'desc']],
		 "sDom": 'T<"clear">lfrtip',
		fnInitComplete:function() {
		$('#example tbody tr:first-child > td:first-child').click(); 
		}

	} );


	$('#example tbody').on('click', 'td.details-show', function () {
			var tr = $(this).closest('tr');
			var row = table.row( tr );	
			var d = row.data();
			window.location = "?action=details&case="+d.v_id+"&_pid=81";	
	});
		
	// Add event listener for opening and closing details	
	$('#example tbody').on('click', 'td.details-control', function () {
		var tr = $(this).closest('tr');
		var row = table.row( tr );

		if ( row.child.isShown() ) {
			// This row is already open - close it
			row.child.hide();
			tr.removeClass('shown');
		}
		else {
			<?php /*?>var d = row.data();
			$.ajax({url: "actions.php",data:{'case':d.v_id,'ePage':'report_checksinfo_search','riskwise':'1','pm_where':"<?=base64_encode($pm_where)?>",'_days':'<?php echo $_days;?>','check_status':'<?php echo $check_status;?>'}, success: function(result){
				//$("#div1").html(result);
				row.child(result).show();
				tr.addClass('shown');
			}});<?php */?>

		}
	} );
} );


	</script>

	
	
	 <div class="page-header">
            <div class="page-header-content">
                <div class="page-title2">
                	<h4><i class="icon-arrow-left52 position-left"></i> <?php include('include_pages/pages_breadcrumb_inc.php'); ?></h4>
                </div>
             </div>
      </div>
    
	<div class="content">
                      
                  <div id="filters" class="panel panel-white" >
          
          		<div class="panel-heading">
                	<h5 class="panel-title">Search For Result</h5>
                </div>
          
          <div class="panel-body">
						
            <div>
              <form action="?action=<?php echo $_REQUEST['action'];?>&atype=<?php echo $_REQUEST['atype'];?>" class="table-form"  method="post">
			 
			 <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Candidate Name/ID#:</label>
            <input type="text" class="form-control" name="name_id" value="<?=$name_id?>" placeholder="Search by Candidate Name / ID#" >
                      
					  
                     
                    
                  </div>
				  
				  
				  <div class="col-md-6">
                   <label>Select Component:</label>
                     <select name="s_checks_id" class="select">
            <option value=""> Select Component </option>
            <?php 
			if($LEVEL!=4) {
			$checks = $db->select("checks","*","is_active=1");	
			}else{
			$company_id = $COMINF['id'];
			$where = "cc.com_id=$company_id AND ck.is_active=1 AND cc.clt_active=1";
			$tabls = "checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id";
			$checks = $db->select($tabls,"*",$where);	
			}										 
			
			 if(mysql_num_rows($checks)>0){

					while($check = mysql_fetch_array($checks)){?>
						<option value="<?=$check['checks_id']?>" <?php echo ($check['checks_id']==$_REQUEST['s_checks_id'])?'selected="selected"':'';?>><?=$check['checks_title']?></option>
					<?php }
			 }
											?>
            </select>
                  </div>
				  
				  
				  
				  
				   </div>
				</div>
			 
			 
			 
			 
			 <?php if($LEVEL!=4){?>
             
              <div class="form-group">
                <div class="row">
				
                  <div class="col-md-6">
                  <label>Select Client:</label>
                    <select id="source" name="client_id" class="select" onchange="getLocUsers(this.value);">
                      <option value=""> Select Client </option>
					  <?php 
					  $clients = $db->select("company","name,id","is_active=1 ORDER BY name ASC");
					  while($client = @mysql_fetch_assoc($clients)){?>
					  <option value="<?php echo $client['id'];?>" <?php echo ($client['id']==$_REQUEST['client_id'])?'selected="selected"':'';?>>
                     <?php echo $client['name'];?>
                      </option>
					  <?php } ?>
					 
					  
                     
                    </select>
                  </div>
				  
                  <div class="col-md-6">
                  <label>Select Location:</label>
                   <select name="loc_id" class="select" id="loca_id">
							<option value="">Select Location</option>
							<?php 
							if(isset($_REQUEST['client_id'])){
							$where = " com_id=$_REQUEST[client_id] AND status=0 ORDER BY location ASC";
							
							$getuLocations = $db->select("users_locations","*",$where);
							
							while($rsLocations =	mysql_fetch_array($getuLocations)){ ?>
						
							<option value='<?=$rsLocations['loc_id']?>' <?php echo chk_or_sel($_REQUEST['loc_id'],$rsLocations['loc_id'],'selected'); ?> >
							<?php echo $rsLocations['location'];?>
							</option>
							
							<?php 
							}
							} ?>
					</select>
                  </div></div>
				</div>
				
				
				
				<div class="form-group">
                <div class="row">
				  
                    
                  
                  <div class="col-md-6">
				  <label>Select Ops User:</label>
                    <select id="user_id" name="user_id" class="select" >
                      <option value="">Select Ops User</option>
					  <?php 
					 $levels = $db->select("levels","level_name,level_id","is_active=1 AND level_id NOT IN (1,4,5,11,10,13,6) ORDER BY level_name DESC");
					 while($level = @mysql_fetch_assoc($levels)){?>
						 
					<optgroup label="<?php echo $level['level_name'];?>">
					<?php
					  $users = $db->select("users","user_id, CONCAT(first_name,' ',last_name) AS fullname","is_active=1 AND level_id = $level[level_id] AND user_id NOT IN (23,302,303) ORDER BY first_name ASC");
					  
					  while($user = @mysql_fetch_assoc($users)){?>
					  <option value="<?php echo $user['user_id'];?>" <?php echo ($user['user_id']==$_REQUEST['user_id'])?'selected="selected"':'';?>>
                     <?php echo $user['fullname'];?>
                      </option>
					  <?php } ?>
					  </optgroup>
					 <?php 
					 
					 } ?>
					 
					  
                     
                    </select>
                  </div>
				  
				  </div>
				</div>
				
				
				
                <?php }else{ 
				$company_id = $COMINF['id'];
				?> 
				<input type="hidden" name="client_id" value="<?php echo $company_id;?>" >
				<?php } ?>
                 
                
				 <div class="form-group">
                <div class="row">
              
                  <div class="col-md-6">
                   <label>Select Status:</label>
                    <select id="check_status" name="check_status" class="select" >
                      <option value=""> Select Status </option>
					  <option value="all" <?php echo ($check_status=='all')?'selected="selected"':'';?>>
                     All
                      </option>
					   <option value="open" <?php echo ($check_status=='open')?'selected="selected"':'';?>>
                     Open
                      </option>
					  <option value="close" <?php echo ($check_status=='close')?'selected="selected"':'';?>>
                     Close
                      </option>
					   <option value="invoiced" <?php echo ($check_status=='invoiced')?'selected="selected"':'';?>>
                     Invoiced
                      </option>
                       <option value="no_risk" <?php echo ($check_status=='no_risk')?'selected="selected"':'';?>>
                      No Risk
                      </option>
					    <option value="low_risk" <?php echo ($check_status=='low_risk')?'selected="selected"':'';?>>
                      Potential Risk
                      </option>
                      <option value="high_risk" <?php echo ($check_status=='high_risk')?'selected="selected"':'';?>>
                      High Risk
                      </option>
					 
					  
                     
                    </select>
                  </div>
				  
				  <div class="col-md-6">
                  <label>Enter Days:</label>
                     <input id="" type="text" name="_days" value="<?php echo $_days;?>" class="form-control" placeholder="Enter Days" >
                  </div>
				  
				  
				  
				  
				   </div>
				</div>
				 <div class="form-group">
                <div class="row" id="date-range">
            
                                        <div class="col-md-6">
                                        <label for="">Select Date: From:</label>
                                            <input id="" type="text" name="from_dt" value="<?php echo $from_dt;?>" class="datetimepicker-month1 form-control" placeholder="Start Date" readonly='readonly'>
                                        </div>
                                    
                                    
                                        <div class="col-md-6">
                                        <label for="">To:</label>
                                            <input id="" type="text" name="to_dt" value="<?php echo $to_dt;?>" class="datetimepicker-month2 form-control" placeholder="End Date" readonly='readonly'>
                                        </div>
										 
                </div>
              </div>
			  <div class="form-group">
                <div class="row">
				
				<div class="col-md-5">
				<input type="checkbox" class="styled" name="send_weekly_update" id="send_weekly_update" value="1" <?=($_REQUEST['send_weekly_update']==1)?'checked="checked"':''?>> <label for="send_weekly_update" style="font-size:14px;"> Send me daily email of the saved search criteria.</label></div>
										 
				<div class="col-md-6 pull-right text-right">
				<button class="btn bg-danger-600 btn-lg" type="submit" name="save_search_resuts"><i class="icon-floppy-disk position-left"></i> Save This Search</button>
				&nbsp;&nbsp;					 
				<button class="btn bg-success-600 btn-lg" type="submit" name="search_status"><i class="icon-search4 position-left"></i> Search</button>
				
				</div>
				
				</div>
				</div>
			 
			  
            </form>
            
            </div>             
             
               </div>
            </div>
          
          		<div>
                <div>
               <div class="">
                
                     <div class="panel panel-white">
                     	
                        <div class="panel-heading">
                    		<h5 class="panel-title">SEARCH RESULT</h5>
							<div class="heading-elements">
							<?php if($LEVEL==2 || $LEVEL==1){?>
							<form method="post">
							<span class="heading-text no-margin">
                            <a class="ctooltips" href="javascript:;">					
						<button type="submit" class="btn btn-success-600 btn-xs" onclick="#" name="downloadxcl"><i class="icon-cloud-download position-left"></i> Download Data in Excel File</button></a></span>
						<input type="hidden" name="pmwhere" value="<?=base64_encode($pm_where)?>">
						<input type="hidden" name="pmorder" value="<?php echo base64_encode(($IPAGE['m_orderby']=="")?'v_name ASC':$IPAGE['m_orderby']);?>">
						<input type="hidden" name="pmlimit" value="">
						<input type="hidden" name="xcl_file_name" value="<?php echo $check_status;?>">
						<input type="hidden" name="cal_days" value="<?php echo $_days;?>">
						</form>
							<?php } ?>
                            
                         </div>
                       </div>
                    	
                     <div class="panel-body">
                    	<!--<div id="data-table" class="panel-heading datatable-heading">
                            <h4 class="section-title">Cases</h4>
                    	</div>-->
                     	
	                    <table id="example" class="table datatable-basic dataTable no-footer" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
									<?php if($LEVEL!=4){?>
									 <th>Client Name</th>
									<?php } ?>
                                    <th>Employer ID</th>
                                    <th>Applicant Name</th>
                                    <th>Check Count</th>
                                    <th>Submitted</th>
                                    <th>Status</th>
                                    
                                </tr>
                            </thead>
            
                         
                        </table>
		            </div>
                    </div>
                    </div>
                </div>
            </div>
          
               
            </div>
            
                  
        
        
        
        
      

        <!-- Page-specific scripts: -->
        <!--<script src="scripts/proton/graphsStats.js"></script>-->
        <!-- Page-specific scripts: -->
        
		<script src="js/rate.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
											  
	  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script type="text/javascript">
		
		$(function () {
		$( ".datetimepicker-month1, .datetimepicker-month2").datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1990:2020"
		});
		
		
		});
		
		function getLocUsers(com_id){//alert("asdasdasasdasd");     
		// alert(com_id);alert("ssdvds");
	   var param2="action=ePage&ePage=add_rating&getlocusers=2&com_id="+com_id;
	   
		//ajaxServices("actions.php",param2,'loca_id');
		$.ajax({    
		type: "POST",
		url: "actions.php",
		data: param2,
		success: function(response){
		$("#loca_id").html(response);
	   
		}
		});
		
	   }
		</script>

