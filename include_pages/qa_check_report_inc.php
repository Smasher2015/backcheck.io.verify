
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
	
	
?>
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
<script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
	var orderby = <?php echo (!empty($m_orderby))?4:2;?>;
	
	var table = $('#example').DataTable( {
		"processing": true,
        "serverSide": true,
		"ajax": "actions.php?json_param=1&json_call=qa_cases&action=fedit&fedit=s&pm_where=<?=base64_encode($pm_where)?>&m_orderby=<?=$m_orderby?>",
		
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
			$.ajax({url: "actions.php",data:{'case':d.v_id,'ePage':'qa_report_checksinfo','pm_where':"<?=base64_encode($pm_where)?>"}, success: function(result){
				//$("#div1").html(result);
				row.child(result).show();
				tr.addClass('shown');
			}});

		}
	} );
} );


	</script>

	
	
	<?php /*
	<div class="report-sec">
               
                      <div class="panel panel-default panel-block">
                        <div class="list-group">
                            <div class="list-group-item">
                                <h4 class="section-title">Monthly Volume (This Year)</h4>
                                <div class="form-group">
                                    <!--<div id="myfirstchart" class="graph" style="height: 250px;"></div>-->
                                     <?php 
 
 $pm_where = ($pm_where)?$pm_where." AND ":"";
 $last_year = strtotime("1 year ago"); 
 $last_year = date("y",$last_year);
 $comField="";
 if($LEVEL==4) $comField = "vd.com_id=$COMINF[id] AND";
 
 	$vcols = "COUNT(as_id) AS nums ,DATE_FORMAT(as_addate,'%b-%y') AS mmyy, DATE_FORMAT(as_addate,'%m') AS vmonth, DATE_FORMAT(as_addate,'%m-%y') AS addate,DATE_FORMAT(as_addate,'%y') AS vyear ";
	$vtble = "`ver_data` AS vd INNER JOIN `ver_checks` AS vc ON vd.v_id = vc.v_id";
	
	$volume_data = $db->select($vtble ,$vcols," $pm_where $comField DATE_FORMAT(as_addate,'%y')  = ".date('y')."   GROUP BY addate ORDER BY vmonth ASC");
	//echo  " $pm_where  DATE_FORMAT(as_addate,'%y')  = ".date('y')."   GROUP BY addate ORDER BY vmonth ASC";
	$loopV = '';
	$vdate = '';
	while($v_data = mysql_fetch_assoc($volume_data)){
		
		$vdate .= "'".$v_data['mmyy']." '" . ",";
		$loopV .= $v_data['nums'] . ',';
			//echo $vcount . ',';

	}
	$loopV = rtrim($loopV,',');
	$vdate = rtrim($vdate,',');
	//print_r($loopV);
	//print_r($vdate);die;
 
 ?>   
   
    <script type="text/javascript">
    
    
    $(function () {
    $('#container_vo').highcharts({
		credits: {
      		enabled: false
	  	},
        title: {
            text: '',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: [<?php echo $vdate;?>]
        },
        yAxis: {
            title: {
                text: 'Monthly Volume'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' Check(s)'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0,
			enabled : false,
        },
        series: [
		{
            name: 'This Month',
            data: [<?php echo $loopV;?>]
        }
		]
    });
});
    
    </script>
     <div id="container_vo" style="min-width: 280px; height: 250px; margin: 0 auto"></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                 
               
                	<div class="clearfix"></div>
            </div>
            
           */?>
		   
	
	
	
	
	
	
	
	
        </section>
        
        
        
        
        
      

        <!-- Page-specific scripts: -->
        <!--<script src="scripts/proton/graphsStats.js"></script>-->
        <!-- Page-specific scripts: -->
        <script src="scripts/proton/tables.js"></script>
		<script src="js/rate.js"></script>

