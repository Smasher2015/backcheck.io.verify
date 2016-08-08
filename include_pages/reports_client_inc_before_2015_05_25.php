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

</style>
<script type="text/javascript" language="javascript" src="scripts/jquery.dataTables.js"></script>
        <section class="retracted scrollable">
            
            <div class="row">
                <div class="col-md-12">
                  	<div class="report-sec">
                     <div class="panel panel-default panel-block">
                    	<!--<div id="data-table" class="panel-heading datatable-heading">
                            <h4 class="section-title">Cases</h4>
                    	</div>-->
                     	<div class="page-section-title">
                    		<?php include('include_pages/pages_breadcrumb_inc.php'); ?>
                    	</div>
	                    <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Date Submitted</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
            
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Date Submitted</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                </tr>
                            </tfoot>
                        </table>
		            </div>
                    </div>
                </div>
            </div>
<script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
	var table = $('#example').DataTable( {
		"ajax": "actions.php?json_encode=1&json_call=all_cases&action=fedit&fedit=s",
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
			{ "data": "v_date",
			"className":      'details-show'},
			{ "data": "v_status",
			"className":      'details-show details-progress' },
			{ "data": null,
			"className":      'details-show' }
		],
		"order": [[2, 'desc']],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
				$('td:eq(4)', nRow).html( '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="'+aData.progress+'" aria-valuemin="0" aria-valuemax="100" style="width:'+aData.progress+'%;" ><span class="sr-only"></span></div></div>' );
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
			$.ajax({url: "actions.php",data:{'case':d.v_id,'ePage':'checksinfo'}, success: function(result){
				//$("#div1").html(result);
				row.child(result).show();
				tr.addClass('shown');
			}});

		}
	} );
} );


	</script>
        
            <!--<div class="container"> 
                        <div class="row">
                        <div class="col-md-6 col-lg-8">
                            <div class="panel panel-default panel-block">
                                <div class="list-group">
                                    <div class="list-group-item">
                                        <h4 class="section-title">Bar Chart</h4>
                                        <div class="form-group">
                                            <div id="hero-bar" class="graph" style="height: 250px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default panel-block">
                                <div class="list-group">
                                    <div class="list-group-item">
                                        <h4 class="section-title">Area Chart</h4>
                                        <div class="form-group">
                                            <div id="hero-area" class="graph" style="height: 250px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="panel panel-default panel-block">
                                <div class="list-group">
                                    <div class="list-group-item">
                                        <h4 class="section-title">Basic Chart</h4>
                                        <div class="form-group">
                                            <div id="myfirstchart" class="graph" style="height: 250px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                         
                                                
                        </div>
                    </div>
            </div>-->
            
            <section class="widget-group">
                
                
                <div id="task-completion-widget" class="proton-widget task-completion">
                    <div class="panel panel-default back">
                        <div class="panel-heading">
                            <i class="icon-cog"></i>
                            <span>Settings</span>
                            <div class="toggle-widget-setup">
                                <i class="icon-ok"></i>
                                <span>DONE</span>
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Origin</label>
                                    <div>
                                        <select class="select2">
                                            <option value="Any">Any</option>
                                            <option value="Europe">Europe</option>
                                            <option value="Asia">Asia</option>
                                            <option selected="" value="North America">North America</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Time</label>
                                    <div>
                                        <select class="select2">
                                            <option>Any</option>
                                            <option>Last Hour</option>
                                            <option>Today</option>
                                            <option>This Week</option>
                                            <option selected="">This Month</option>
                                            <option>This Year</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="panel panel-success front">
                        <div class="panel-heading">
                            <i class="icon-envelope-alt"></i>
                            <span>Ready for Download</span>
                            <i class="icon-cog toggle-widget-setup"></i>
                        </div>
                        <div>
                            <ul class="list-group pending">
                                <?php
								$data = client_checks_info("as_sent=4 AND as_cdnld=0 AND as_status='Close'","LIMIT 4");
								if($data){
									  while($row = mysql_fetch_assoc($data)){ ?>                            
                                            <li class="list-group-item" onclick="downloadPDF('pdf.php?pg=case&ascase=<?=$row['as_id']?>')">
                                                <i><img src="<?=$row['image']?>" alt="<?=$row['v_name']?>"></i>
                                                <div class="text-holder">
                                                    <span class="title-text">
                                                         <?=$row['v_name']?>
                                                    </span>
                                                    <span class="description-text">
                                                       Check: <?=$row['checks_title']?>
                                                    </span>
                                                </div>
                                                <span class="stat-value">
                                                     <?=time_ago(strtotime($row['as_stdate']))?>
                                                </span>
                                            </li>
                                <?php }
								}?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="sales-income-widget" class="proton-widget">
                    <div class="panel panel-default back">
                        <div class="panel-heading">
                            <i class="icon-cog"></i>
                            <span>Settings</span>
                            <div class="toggle-widget-setup">
                                <i class="icon-ok"></i>
                                <span>DONE</span>
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Products</label>
                                    <div>
                                        <select class="select2">
                                            <option>All</option>
                                            <option selected="">Digital Media</option>
                                            <option>Books</option>
                                            <option>Shopping Carts</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Origin</label>
                                    <div>
                                        <select class="select2">
                                            <option value="Any">Any</option>
                                            <option value="Europe">Europe</option>
                                            <option value="Asia">Asia</option>
                                            <option selected="" value="North America">North America</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Time Unit</label>
                                    <div>
                                        <select class="select2">
                                            <option>Day</option>
                                            <option>Week</option>
                                            <option>Month</option>
                                            <option selected="">Year</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="panel panel-warning front">
                        <div class="panel-heading">
                            <i class="icon-shopping-cart"></i>
                            <span>By Status</span>
                            <i class="icon-cog toggle-widget-setup"></i>
                        </div>
                        <div>
                            <div class="form-group">
                                <div id="hero-bar" class="graph" style="height: 225px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="expenses-widget" class="proton-widget">
                    <div class="panel panel-default back">
                        <div class="panel-heading">
                            <i class="icon-cog"></i>
                            <span>Settings</span>
                            <div class="toggle-widget-setup">
                                <i class="icon-ok"></i>
                                <span>DONE</span>
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Division</label>
                                    <div>
                                        <select class="select2">
                                            <option selected="" value="All">All Divisions</option>
                                            <option value="RnD">R&amp;D</option>
                                            <option value="Production">Production</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Sales">Sales</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Products</label>
                                    <div>
                                        <select class="select2">
                                            <option selected="">All</option>
                                            <option>Digital Media</option>
                                            <option>Books</option>
                                            <option>Shopping Carts</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Time</label>
                                    <div>
                                        <select class="select2">
                                            <option>Any</option>
                                            <option>This Week</option>
                                            <option>This Month</option>
                                            <option selected="">This Year</option>
                                            <option>Ten Years</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="panel panel-danger front">
                        <div class="panel-heading">
                            <i class="icon-chevron-sign-down"></i>
                            <span>By Risk</span>
                            <i class="icon-cog toggle-widget-setup"></i>
                        </div>
                        <div>
                            <div class="form-group">
                                <div id="hero-donut" class="graph" style="margin-top: 10px; height: 185px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php include('include_pages/dash_charts_inc.php'); ?>
        </section>
        
        
        
        
        
      

        <!-- Page-specific scripts: -->
        <!--<script src="scripts/proton/graphsStats.js"></script>-->
        <!-- Page-specific scripts: -->
        <script src="scripts/proton/tables.js"></script>

