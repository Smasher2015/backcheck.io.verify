
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
	
	//echo $pm_where;
?>
<script type="text/javascript" language="javascript" src="scripts/jquery.dataTables.js"></script>
<script>
	 $(document).ready(function(){
    $("#graphtog").click(function(){
        $("#chartdivtog").slideToggle(400);
    });
	
}); 
</script>

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
			  "className":      'details-show abc'
			},
			{ "data": "v_ftname",
			  "className":      'details-show'
			},
			{ "data": "done_checks",
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


	$('#example tbody').on('click', 'td.abc', function () {
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
			$.ajax({url: "actions.php",data:{'case':d.v_id,'ePage':'report_checksinfo','pm_where':"<?=base64_encode($pm_where)?>"}, success: function(result){
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
	
	
	<div>
                 
                      <div class="panel panel-flat" id="chartdivtog">
                       
                            <div class="panel-body">
                               
                               
                                    <!--<div id="myfirstchart" class="graph" style="height: 250px;"></div>-->
                                     <?php 
 
 $pm_where = ($pm_where)?$pm_where." AND ":"";
 
 if($LEVEL==4){
	$uids = getUseridsLocation();
	if(!empty($uids)){
	$pm_where = "$pm_where v_uadd IN (".implode(",",$uids).") AND ";	
	}
	$col_com_id = " vd.com_id=$COMINF[id] AND ";
	}else{
	$col_com_id = "";	
	}
 
 $last_year = strtotime("1 year ago"); 
 $last_year = date("y",$last_year);
 
 	$vcols = "COUNT(as_id) AS nums ,DATE_FORMAT(as_addate,'%b-%y') AS mmyy, DATE_FORMAT(as_addate,'%m') AS vmonth, DATE_FORMAT(as_addate,'%m-%y') AS addate,DATE_FORMAT(as_addate,'%y') AS vyear ";
	$vtble = "`ver_data` AS vd INNER JOIN `ver_checks` AS vc ON vd.v_id = vc.v_id";
	
	$volume_data = $db->select($vtble ,$vcols," $pm_where $col_com_id DATE_FORMAT(as_addate,'%y')  = ".date('y')."   GROUP BY addate ORDER BY vmonth ASC");
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
    <div id="container_vo" style="min-width: 800px; height: 250px; margin: 0 auto"></div>
                                    
                                
                            </div>
                       
                    </div>
                 
               
            </div>
            
           
		   
            <div class="panel panel-flat" style="position:relative;">   	
                    
                    	<!--<div id="data-table" class="panel-heading datatable-heading">
                            <h4 class="section-title">Cases</h4>
                    	</div>-->
                        <div class="table-reponsive">
                     	<div class="exl-btn" style="position:absolute; right:1.5%; top:21px; z-index:1000;">
                            	<?php if($LEVEL==4){?>
							<form method="post">
							<span class="heading-text no-margin">			
						<button type="submit" class="btn btn-default" onclick="javascript:void(0);" name="downloadxcl" data-popup="tooltip" title="Download excel file" data-placement="top"><i class="icon-file-excel position-left text-success"></i> Excel</button></span>
						<input type="hidden" name="pmwhere" value="<?=base64_encode($IPAGE['m_where'])?>">
						<input type="hidden" name="pmorder" value="<?php echo base64_encode(($IPAGE['m_orderby']=="")?'v_name ASC':$IPAGE['m_orderby']);?>">
						<input type="hidden" name="pmlimit" value="">
						<input type="hidden" name="xcl_file_name" value="<?php echo $_REQUEST['action'];?>">
						</form>
							<?php } ?>
                            </div>
                        
                        
	                    <table id="example" class="table table-hover table-striped datatable-basic dataTable no-footer" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="sorting">+/-</th>
                                    <th>Name</th>
                                    <th>Father's Name</th>
									<th>Done</th>
                                    <th>Date Submitted</th>
                                    <th>Status</th>
                                    
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

