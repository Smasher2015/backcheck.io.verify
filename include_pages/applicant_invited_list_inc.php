<!--<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">-->
<style type="text/css" class="init">

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
#chartdivtog{display:none;}
.dataTables_length{margin-right:115px !important;}
.dataTables_paginate {margin-right: 20px;}
.dataTables_info {margin-left: 20px;}


</style>

<?php 
	$com_id = ($LEVEL==4)?$COMINF[id]:1;
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
	
	$pm_where = ($pm_where!='')?$pm_where." AND com_id=$com_id":" level_id=5 AND is_active=1 AND com_id=$com_id";
?>
<script type="text/javascript" language="javascript" src="scripts/jquery.dataTables.js"></script>


        <section class="retracted scrollable">
           <script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
	var orderby = <?php echo (!empty($m_orderby))?4:2;?>;
	
	var table = $('#example').DataTable( {
		"ajax": "actions.php?json_param=1&json_call=invited_applicant&action=fedit&fedit=s&pm_where=<?=base64_encode($pm_where)?>&m_orderby=<?=$m_orderby?>",
		
		"columns": [
			
			{ "data": "v_name",
			  "className":      'details-show abc'
			},
			{ "data": "email",
			  "className":      'details-show'
			},
			{ "data": "invited",
			  "className":      'details-show'
			},
			{ "data": "is_responed",
			  "className":      'details-show'
			},
			{ "data": "statuss",
			  "className":      'details-show'
			},
			
			{ "data": "cd_date",
			"className":      'details-show'}
			
		],
		
		"order": [[<?php echo (!empty($m_orderby))?4:4;?>, 'desc']],
		 "sDom": 'T<"clear">lfrtip',
		fnInitComplete:function() {
		$('#example tbody tr:first-child > td:first-child').click(); 
		} 

	} );


	$('#example tbody').on('click', 'td.abc', function () {
			var tr = $(this).closest('tr');
			var row = table.row( tr );	
			var d = row.data();
			//window.location = "?action=details&case="+d.v_id+"&_pid=81";	
	});
		
	// Add event listener for opening and closing details	

} );

function sendNewLinkToApplicant(frmid){
console.log(frmid);
	$('#'+frmid).submit();
	
}

	</script>

    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title2">
	            <h1><?php include('include_pages/pages_breadcrumb_inc.php'); ?></h1>
            </div>
                                                                <?php
                        include("headers_right_menu_inc.php");
						?>


            <!--<div class="heading-elements">
							<div class="heading-btn-group">
								<a href="javascript:;" class="btn btn-link btn-float has-text" id="graphtog"><i class="icon-stats-dots text-info"></i><span>Checks Chart</span></a>
                               <a href="javascript:;" class="btn btn-link btn-float has-text" data-toggle="modal" data-target="#openticket"><i class="icon-ticket text-primary"></i> <span>New Support</span></a>
                                <a href="javascript:;" class="btn btn-link btn-float has-text LiveHelpButton" id="LiveHelpStatusDefault" name="LiveHelpStatusDefault"><i class="icon-bubbles6 text-primary LiveHelpStatus" id="LiveHelpStatusDefault"></i><span>Live chat</span></a>
                                                         
							</div>
			</div>-->
            
        </div>
    </div>

<div class="content">	
	
	
	
           
		   
            <div class="panel panel-flat" style="position:relative;">   	
                    
                    	<!--<div id="data-table" class="panel-heading datatable-heading">
                            <h4 class="section-title">Cases</h4>
                    	</div>-->
                        <div class="table-reponsive">
                     	
                        
                        
	                    <table id="example" class="table table-hover table-striped datatable-basic dataTable no-footer" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                   
                                    <th>Applicant Name</th>
                                    <th>Email</th>
									
                                    <th>Invited</th>
                                    <th>Response</th>
									<th>Action</th>
									 <th>Dated</th>
									
                                    
                                </tr>
                            </thead>
            
                            
                        </table>
                        
                        </div>
		           
                   
              
            </div>	
	
        </div>
        
        
        
        


        <!-- Page-specific scripts: -->
        <!--<script src="scripts/proton/graphsStats.js"></script>-->
        <!-- Page-specific scripts: -->
        
		<script src="js/rate.js"></script>

