
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
	$risk_type = 'no_risk';
	
if(isset($_REQUEST['search_risk'])){
	
	$from_dt  		= $_REQUEST['from_dt'];
	$to_dt  		= $_REQUEST['to_dt'];
	$risk_type  	= $_REQUEST['risk_type'];
	if($from_dt && $to_dt){
	$wh = "AND DATE_FORMAT(as_cldate, '%Y-%m-%d') BETWEEN '".$from_dt."' AND '".$to_dt."'";
	}
	switch($risk_type){
		case 'no_risk':
		$pm_where = "as_status = 'Close' AND as_sent=4 AND as_isdlt=0 AND as_vstatus NOT IN ('negative', 'match found', 'record found') $wh";
		break;
		case 'low_risk':
		$pm_where = "as_status = 'Close' AND as_sent=4 AND as_isdlt=0 AND as_vstatus IN ('unable to verify', 'discrepancy') $wh";
		break;
		case 'high_risk':
		$pm_where = "as_sent=4 AND as_status='Close' AND as_isdlt=0 AND (as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found') $wh";
		break;
	}
	
}
	
	
	
?>
<script type="text/javascript" language="javascript" src="scripts/jquery.dataTables.js"></script>
        <section class="retracted scrollable">
           <script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
	var orderby = <?php echo (!empty($m_orderby))?4:2;?>;
	
	var table = $('#example').DataTable( {
		"ajax": "actions.php?json_param=1&json_call=custom_cases&action=fedit&fedit=s&pm_where=<?=base64_encode($pm_where)?>&m_orderby=<?=$m_orderby?>",
		
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
			{ "data": "v_ftname",
			  "className":      'details-show'
			},			
			{ "data": "ndate",
			"className":      'details-show'},
			{ "data": "v_status",
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
			var d = row.data();
			$.ajax({url: "actions.php",data:{'case':d.v_id,'ePage':'report_checksinfo','riskwise':'1','pm_where':"<?=base64_encode($pm_where)?>"}, success: function(result){
				//$("#div1").html(result);
				row.child(result).show();
				tr.addClass('shown');
			}});

		}
	} );
} );


	</script>

	
	
	
	<div class="report-sec">
                 <div class="page-section-title">
                	<h2 class="box_head">Search Risk Wise Checks</h2>
					
					
                </div>
                      
                  <div id="filters" class="section" >
          <div class="list-group-item" >
            
						
            <div style="margin-bottom:30px;">
              <form action="?action=riskwise&atype=checks" class="table-form"  method="post">
             
             
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label>Select Option:</label>
                  </div>
                  <div class="col-md-9">
                    <select id="risk_type" name="risk_type" class="form-control" >
                      <option value=""> --------Select Option-------- </option>
                       <option value="no_risk" <?php echo ($risk_type=='no_risk')?'selected="selected"':'';?>>
                      No Risk
                      </option>
					    <option value="low_risk" <?php echo ($risk_type=='low_risk')?'selected="selected"':'';?>>
                      Potential Risk
                      </option>
                      <option value="high_risk" <?php echo ($risk_type=='high_risk')?'selected="selected"':'';?>>
                      High Risk
                      </option>
					 
					  
                     
                    </select>
                  </div>
                </div>
				</div>
              
				<div class="form-group">&nbsp;</div>
				<div class="form-group">
                <div class="row" id="date-range">
                  <div class="col-md-3">
                    <label>Select Date:</label>
                  </div>
                
                                        <label for="" class="col-lg-1 control-label">From:</label>
                                        <div class="col-lg-2">
                                            <input id="" type="text" name="from_dt" value="<?php echo $from_dt;?>" class="datetimepicker-month1 form-control" placeholder="Start Date" readonly='readonly'>
                                        </div>
                                    
                                    
                                        <label for="" class="col-lg-1 control-label">To:</label>
                                        <div class="col-lg-2">
                                            <input id="" type="text" name="to_dt" value="<?php echo $to_dt;?>" class="datetimepicker-month2 form-control" placeholder="End Date" readonly='readonly'>
                                        </div>
                                        <div class="col-lg-2"><button class="btn btn-lg btn-success" style="float:right;" type="submit" name="search_risk"> <span>   Search  </span> </button></div>
                </div>
              </div>
            </form>
            
            </div>
             <div style="clear:both; margin-bottom:30px;"></div>
             
             
               </div>
            </div>
               
                	<div class="clearfix"></div>
            </div>
            
           
		   
            <div class="row">
                <div class="col-md-12">
                  	<div class="report-sec">
                    <div class="page-section-title">
                    		<h2 class="box_head"><?php include('include_pages/pages_breadcrumb_inc.php'); ?></h2>
							<?php if($LEVEL==4){?>
							<form method="post">
							<span style="float:right; margin-top:-28px;"><a class="ctooltips" href="javascript:;">					
						<button type="submit" class="btn btn-default" onclick="#" name="downloadxcl"><i class="icon-cloud-download"></i> Download Data in Excel File</button><span>Download Data in Excel File</span></a></span>
						<input type="hidden" name="pmwhere" value="<?=base64_encode($pm_where)?>">
						<input type="hidden" name="pmorder" value="<?php echo base64_encode(($IPAGE['m_orderby']=="")?'v_name ASC':$IPAGE['m_orderby']);?>">
						<input type="hidden" name="pmlimit" value="">
						<input type="hidden" name="xcl_file_name" value="<?php echo $risk_type;?>">
						</form>
							<?php } ?>
                    	</div>
                     <div class="panel panel-default panel-block">
                    	<!--<div id="data-table" class="panel-heading datatable-heading">
                            <h4 class="section-title">Cases</h4>
                    	</div>-->
                     	
	                    <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Father's Name</th>
                                    <th>Date Submitted</th>
                                    <th>Status</th>
                                    
                                </tr>
                            </thead>
            
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Father's Name</th>
                                    <th>Date Submitted</th>
                                    <th>Status</th>
                                    
                                </tr>
                            </tfoot>
                        </table>
		            </div>
                    </div>
                </div>
            </div>

	
	
	
	
	
	
	
	
        </section>
        
        
        
        
        
      

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
		yearRange: "1980:2015"
		});
		});
		</script>
