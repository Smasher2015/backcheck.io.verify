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
                    	<div id="data-table" class="panel-heading datatable-heading">
                            <h4 class="section-title">Cases</h4>
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
        
            <div class="container"> 
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
            </div>
        </section>
        
        
        
        
        
      

        <!-- Page-specific scripts: -->
        <script src="scripts/proton/graphsStats.js"></script>
        <!-- Page-specific scripts: -->
        <script src="scripts/proton/tables.js"></script>

