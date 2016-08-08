<?php include ('include/config.php');
include ('include/config_actions.php');

//$v_id = 11492;
//$_REQUEST['ascase'] = $_REQUEST['ascase'];
//$_REQUEST['case'] = $v_id;

include ('include_pages/boxex_inc.php');

?>
		

	<link href="<?php echo SURL; ?>dashboard/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/colors.min.css" rel="stylesheet" type="text/css">
    <link rel="<?php echo SURL; ?>stylesheet" href="styles/jquery.mCustomScrollbar.min.css">
    <link href="styles/proton.css" rel="stylesheet" type="text/css">
	<link href="styles/bt_chcks.css" rel="stylesheet" type="text/css">
	<script> var SURL = "<?php echo SURL;?>";</script>
 <script type="text/javascript" src="<?php echo SURL;?>scripts/jquery-latest.js"></script>
 
<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/core/libraries/bootstrap.min.js"></script>
  <script src="<?php echo SURL; ?>scripts/vendor/modernizr.js"></script>
	<script src="<?php echo SURL; ?>js/ajax_script-2.js?ver=3.4"></script>
    <script src="<?php echo SURL; ?>js/js_functions-2.js?ver=3.4"></script>
    <script src="<?php echo SURL; ?>js/encoder.js?ver=3.4"></script>
	
        <!-- Common Scripts: -->
        <script> var SURL = "http://backcheck.io/verify/";</script>
      
	   
<!--<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">-->
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
		$pm_where = "as_sent=4 AND as_cdnld=0 AND as_status='Close' AND as_qastatus = 'Approved'";	
	}
	if($IPAGE['m_orderby']!='') {
		$m_orderby = $IPAGE['m_orderby'];
	}else{
		$m_orderby = '';	
	}
	
	//echo $pm_where;
?>
<script type="text/javascript" language="javascript" src="<?php echo SURL; ?>scripts/jquery.dataTables.js"></script>
        
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
			<?php if($LEVEL!=4){?>
			{ "data": "com_name",
			  "className":      'details-show'
			},
			<?php } ?>
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
			$.ajax({url: "actions.php",data:{'case':d.v_id,'ePage':'report_checksinfo','pm_where':"<?=base64_encode($pm_where)?>"}, success: function(result){
				//$("#div1").html(result);
				row.child(result).show();
				tr.addClass('shown');
			}});

		}
	} );
} );


	</script>
    
  

<div class="content">	
	
       
		   
            <div class="panel panel-flat">   	
                  
                    
                    	<!--<div id="data-table" class="panel-heading datatable-heading">
                            <h4 class="section-title">Cases</h4>
                    	</div>-->
                        <div class="panel-body">
                     	
	                    <table id="example" class="table datatable-basic dataTable no-footer" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="sorting">+/-</th>
									<?php if($LEVEL!=4){?>
									 <th>Client Name</th>
									<?php } ?>
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
        
        
        
        
     
      

        <!-- Page-specific scripts: -->
        <!--<script src="scripts/proton/graphsStats.js"></script>-->
        <!-- Page-specific scripts: -->
        
		<script src="<?php echo SURL; ?>js/rate.js"></script>
		<script src="<?php echo SURL; ?>scripts/main.js"></script>
        <script src="<?php echo SURL; ?>scripts/proton/common.js"></script>
         
        <!-- Page-specific scripts: -->
      	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

        <script src="<?php echo SURL; ?>scripts/proton/dashboard.js"></script>
        <script src="<?php echo SURL; ?>scripts/proton/dashdemo.js"></script>
               
        <!-- Notifications -->
        <!-- http://pinesframework.org/pnotify/ -->
        <script src="<?php echo SURL; ?>scripts/vendor/jquery.pnotify.min.js"></script>
     
<script type="text/javascript">
		
		 
			<?php if($_REQUEST['CNT']>0){
					if($_REQUEST['TERR']!='') { 
					foreach($_REQUEST['TERR'] as $ERR){?>
					   proton.dashboard.alerts('<?=$ERR?>','Error!','error');
			<?php 	}}
					if($_REQUEST['TSCS']!='') { 
					foreach($_REQUEST['TSCS'] as $SCS){?>
						 proton.dashboard.alerts('<?=$SCS?>','Success','success');
			<?php 	}}		
				   } ?>
				   
</script>
	
	<script >

	function downloadPDF(url){
		var SURL = "<?php echo SURL;?>";
		//alert(SURL);
		var level = '<?php echo $LEVEL; ?>';
		var can_download_reports = '<?php echo $COMINF['can_download_reports']; ?>';
		
		if(level=='4' && can_download_reports=='1'){
		alertBox("Your report download feature is disabled due to non payment! <br /><br /> Please contact our  <a href='?action=adsupport&atype=support' target='_blank'>support</a> team.");
		return false; 
		}else{

		try{


			if(document.getElementById('pdfLoader')!= null){


				document.body.removeChild(document.getElementById('pdfLoader'));


			}


		}catch(err){}


		var ifrm = document.createElement('iframe');


		ifrm.style.display='none';

		ifrm.id = 'pdfLoader';

		ifrm.src = SURL+url;

		document.body.appendChild(ifrm);


		ifrm.onload = function() {
			var loader = document.getElementById('loading_overlay');

				loader.style.display='none';


				loader.getElementsByTagName('div').item(0).style.display='none';

	   }

			var loader = document.getElementById('loading_overlay');

			loader.style.display='block';

			loader.getElementsByTagName('div').item(0).style.display='block';

	}

	}


</script>