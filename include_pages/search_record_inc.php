
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


	$m_orderby = '';
	$search=$_REQUEST["search"];
	
	if($_REQUEST["search"]!='') {
		$pm_where = "     (v_name like '%".$search."%' OR emp_id like '%".$search."%' OR v_nic like '%".$search."%' OR v_bcode like '%".$search."%' OR as_bcode like '%".$search."%' )  ";
		$isSearch = 'yes';
	}else{
		?>
		<script> 
	
		window.location='?action=dashboard'; 
		</script>
		<?php
		
		
		exit;
		$pm_where = '';	
		$isSearch = '';
	}
	

	
		

	
?>
<script type="text/javascript" language="javascript" src="scripts/jquery.dataTables.js"></script>
        <section class="retracted scrollable">
            
            <div>
                <div>
               
                        <div class="page-header">
    <div class="page-header-content">
        <div class="page-title2">
        	<h1><?php include('include_pages/pages_breadcrumb_inc.php'); ?></h1>
        </div>
        
    </div>
</div>
                  	<div class="content">
                    	<?php /*?><div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Search Record</h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>

						
                        <div class="panel-body">
               
                            <?php if($LEVEL == 5 || $LEVEL == 4 || $LEVEL == 3 || $LEVEL == 2){ ?>
                                    <?php if($LEVEL != 5){ ?>
                            <form action="?action=search&atype=record" method="POST" class="main-search" id="validateSearchform">
								<div class="input-group content-group">
									<div class="has-feedback has-feedback-left">
										<input type="text" name="search" id="searcha" placeholder="Search Candidate & Employee" class="form-control input-xlg" value="<?php echo $_REQUEST['search']; ?>">
										<div class="form-control-feedback">
											<i class="icon-search4 text-muted text-size-base"></i>
										</div>
									</div>

									<div class="input-group-btn">
										<button type="submit" class="btn bg-primary-600 btn-xlg">Search</button>
									</div>
								</div>
							</form>
                             <?php } ?>
                
        
        	
        
        
        
        <?php }?>
                            
						</div>
					</div><?php */?>
                    
                     <div class="panel panel-flat">
                     	
                    	<!--<div id="data-table" class="panel-heading datatable-heading">
                            <h4 class="section-title">Cases</h4>
                    	</div>-->
                        <div class="table-reponsive">
	                    
                        <table id="example" class="display table table-striped table-hover table-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Father's Name</th>
									<?php if($LEVEL!=4) { ?><th>Client</th><?php }?>
									 <th>Employee ID</th>
									 <th><?php echo ID_CARD_NUM;?></th>
                                    <th>Date Submitted</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                          
                        </table>
                        
                        </div>
                        
                        
		            </div>
                    </div>
                </div>
            </div>
<script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
	var orderby = <?php echo (!empty($m_orderby))?4:2;?>;
	
	var table = $('#example').DataTable( {
		"ajax": "actions.php?json_param=1&json_call=custom_cases&action=fedit&fedit=s&pm_where=<?=base64_encode($pm_where)?>&m_orderby=<?=$m_orderby?>&search=<?=$isSearch?>",
		
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
			<?php if($LEVEL!=4) { ?>
			{ "data": "name",
			  "className":      'details-show'
			},	
			<?php } ?>
			{ "data": "emp_id",
			  "className":      'details-show'
			},
			{ "data": "v_nic",
			  "className":      'details-show'
			},
					
			{ "data": "ndate",
			"className":      'details-show'},
			{ "data": "modify_status",
			"className":      'details-progress' }
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
			$.ajax({url: "actions.php",data:{'case':d.v_id,'ePage':'report_checksinfo_search','pm_where':"<?=base64_encode($pm_where)?>"}, success: function(result){
				//$("#div1").html(result);
				row.child(result).show();
				tr.addClass('shown');
			}});

		}
	} );
} );


	</script>

	
	
	
        </section>
        
        
        
        
        
      

        <!-- Page-specific scripts: -->
        <!--<script src="scripts/proton/graphsStats.js"></script>-->
        <!-- Page-specific scripts: -->
        <script src="scripts/proton/tables.js"></script>
		<script src="js/rate.js"></script>

