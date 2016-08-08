
<link rel="stylesheet"  href="css/jquery.dataTables.css">
<style>

td.details-control {
	background: url('images/details_open.png') no-repeat center center;
	background-size:16px 16px;
}

tr.shown td.details-control {
	background: url('images/details_close.png') no-repeat center center;
	background-size:16px 16px;
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
</style>

<?php 
$company_id=($LEVEL==4)?$COMINF[id]:1;
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
	
if(isset($_REQUEST['search_status'])){
	
	$whDates="";
	$from_dt  		= $_REQUEST['from_dt'];
	$to_dt  		= $_REQUEST['to_dt'];
	$check_status  	= $_REQUEST['check_status'];
	if($from_dt && $to_dt){
	$whDates = " BETWEEN '".$from_dt."' AND '".$to_dt."'";
	}
	
	switch($check_status){
		case 'no_risk':
		$pm_where = "as_status = 'Close' AND as_qastatus!='Rejected' AND  as_sent=4 AND as_isdlt=0 AND as_vstatus IN ('verified', 'satisfactory', 'no match found', 'no record found') ";
		$asDate = "as_cldate";
		break;
		case 'low_risk':
		$pm_where = "as_status = 'Close' AND as_qastatus!='Rejected' AND as_sent=4 AND as_isdlt=0 AND as_vstatus IN ('unable to verify', 'discrepancy' , 'processed but cancelled by client', 'objection by source', 'addition information not provided by client','partially verified','original required','not verified by source') ";
		$asDate = "as_cldate";
		break;
		case 'high_risk':
		$pm_where = "as_sent=4 AND as_status='Close' AND as_qastatus!='Rejected' AND as_isdlt=0 AND (as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found' OR as_vstatus='unsatisfactory' OR as_vstatus='positive match found') ";
		$asDate = "as_cldate";
		break;
		case 'all':
		$pm_where = " as_isdlt=0  ";
		$asDate = "as_addate";
		break;
		case 'no_risk':
		$pm_where = "as_status = 'Close' AND as_qastatus!='Rejected' AND  as_sent=4 AND as_isdlt=0 AND as_vstatus NOT IN ('negative', 'match found', 'record found') ";
		$asDate = "as_cldate";
		break;
		case 'not_initiated':
		$pm_where = "as_status = 'Open' AND as_vstatus='Not Initiated' AND as_isdlt=0  ";
		$asDate = "as_addate";
		break;
		case 'insufficient':
		$pm_where = "as_status = 'Insufficient' AND as_vstatus='Not Initiated' AND as_isdlt=0  ";
		$asDate = "as_addate";
		break;
		case 'open':
		$pm_where = "as_status = 'Open' AND as_vstatus!='Not Initiated' AND as_isdlt=0 AND as_cldate IS NULL ";
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
	
	if($from_dt && $to_dt){
	$whDates = " AND DATE_FORMAT($asDate, '%Y-%m-%d')".$whDates;
	}
	
	$pm_where = $pm_where.$whDates;
	
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
		"ajax": "actions.php?json_param=1&json_call=client_case_info_serverside&action=fedit&fedit=s&pm_where=<?=base64_encode($pm_where)?>&m_orderby=<?=$m_orderby?>",
		
		"columns": [
			{
				"className":      'details-control',
				"orderable":      false,
				"data":           null,
				"defaultContent": ''
			},
			{ "data": "v_name",
			  "className":      'details-show'
			},
			{ "data": "emp_id",
			  "className":      'details-show'
			},
			{ "data": "v_ftname",
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
			$('[data-popup="tooltip"]').tooltip();
		}
		else {
			var d = row.data();
			$.ajax({url: "actions.php",data:{'case':d.v_id,'ePage':'report_checksinfo','riskwise':'1','pm_where':"<?=base64_encode($pm_where)?>"}, success: function(result){
				//$("#div1").html(result);
				row.child(result).show();
				tr.addClass('shown');
				$('[data-popup="tooltip"]').tooltip();
			}});

		}
	} );
} );


	</script>

	 <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title2">
                        <h1><?php include('include_pages/pages_breadcrumb_inc.php'); ?></h1>
                </div>
                </div>
                </div>
	
	
	<div class="content">
	<?php include("include_pages/applicant_overview_chart.php");?>
                     
                        <div class="sidebar-detached" id="filters">
						<div class="sidebar sidebar-default">
							<div class="sidebar-content">

								<!-- Sidebar search -->
								<div class="sidebar-category">
									<div class="category-title">
										<span>Search Checks</span>
										<ul class="icons-list">
											<li><a href="#" data-action="collapse"></a></li>
										</ul>
									</div>

									<div class="category-content">
                                    	<form action="?action=<?php echo $_REQUEST['action'];?>&atype=<?php echo $_REQUEST['atype'];?>" class="table-form"  method="post">
             
             <div class="row">
                
                 <div class="form-group">
                  <label>Select Option:</label>
                    <select id="check_status" name="check_status" class="select populate" >
                      <option value=""> Select Status </option>
					  <option value="all" <?php echo ($check_status=='all')?'selected="selected"':'';?>>
                     All
                      </option>
					   <option value="open" <?php echo ($check_status=='open')?'selected="selected"':'';?>>
                     Work in progress
                      </option>
					   <option value="not_initiated" <?php echo ($check_status=='not_initiated')?'selected="selected"':'';?>>
                     Not Initiated
                      </option>
					  <option value="insufficient" <?php echo ($check_status=='insufficient')?'selected="selected"':'';?>>
                     Insufficient
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
                
                <div class="form-group" id="date-range">
                                        
                                        <div class="col-xs-6">
                                        <label for="" class="control-label">From:</label>
                                            <input id="" type="text" name="from_dt" value="<?php echo $from_dt;?>" class="datetimepicker-month1 form-control" placeholder="Start Date" readonly='readonly'>
                                        </div>
                                    
                                    
                                        <div class="col-xs-6">
                                            <label for="" class="control-label">To:</label>
                                            <input id="" type="text" name="to_dt" value="<?php echo $to_dt;?>" class="datetimepicker-month2 form-control" placeholder="End Date" readonly='readonly'>
                                        </div>
                                        <div class="col-xs-12 mt-20"><button class="btn bg-success btn-block" type="submit" name="search_status"> Search </button></div>
                                       
                </div>
                
              				
            </form>
                                    
                                    </div>
                                 </div>
                             </div>
                         </div>
                         </div>
                      </div>
               <div class="container-detached adv_rep">            
          			<div class="content-detached">
               
               			<div class="panel panel-white">
               
                  
                        <div class="panel-heading">
                    		<h5 class="panel-title"><?php include('include_pages/pages_breadcrumb_inc.php'); ?></h5>
							
							<?php if($LEVEL==4){?>
							<div class="heading-elements">
                            <form method="post">
							<span class="heading-text no-margin"><a class="ctooltips" href="javascript:;">					
						<button type="submit" class="btn btn-default" onclick="#" name="downloadxcl" data-popup="toogle" title="Download Data in Excel File" data-placement="top">
                        <i class="icon-cloud-download position-left text-success"></i> Excel File</button></a></span>
						<input type="hidden" name="pmwhere" value="<?=base64_encode($pm_where)?>">
						<input type="hidden" name="pmorder" value="<?php echo base64_encode(($IPAGE['m_orderby']=="")?'v_name ASC':$IPAGE['m_orderby']);?>">
						<input type="hidden" name="pmlimit" value="">
						<input type="hidden" name="xcl_file_name" value="<?php echo $check_status;?>">
						</form></div>
							<?php } ?>
                    	</div>
                   
                    	<!--<div id="data-table" class="panel-heading datatable-heading">
                            <h4 class="section-title">Cases</h4>
                    	</div>-->
                     	<div class="table-responsive">
	                    <table id="example" class="table datatable-basic dataTable no-footer" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>+/-</th>
                                    <th>Name</th>
									<th>Employee ID</th>
                                    <th>Father's Name</th>
                                    <th>Date Submitted</th>
                                    <th>Status</th>
                                    
                                </tr>
                            </thead>
            
                           
                        </table>
                        </div>
		          
                   
              
            </div>
               
           			</div>
           </div><!--over all checks-->    
               
            </div>
    
            
	
	
        </section>
        
        
        
        
        
      

        <!-- Page-specific scripts: -->
        <!--<script src="scripts/proton/graphsStats.js"></script>-->
        <!-- Page-specific scripts: -->
        
		<script src="js/rate.js"></script>
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
-->		
									  
		<script type="text/javascript">
		
		$(function () {
		$( ".datetimepicker-month1, .datetimepicker-month2").datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1980:2015"
		});
		});



		</script>
