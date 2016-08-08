
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

/*if($IPAGE['m_where']!='') {
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
*/	
$inv_num_from_other = $_REQUEST['invoice_number'];



if(isset($_REQUEST['search_status'])){
	//print_r($_REQUEST);
/*	$from_dt  		= $_REQUEST['from_dt'];
	$to_dt  		= $_REQUEST['to_dt'];
	$selectmonth  	= $_REQUEST['selectmonth'];
	$selectyear  	= $_REQUEST['selectyear'];
*/
	$selectcom  	= $_REQUEST['selectcom'];
	$invoice_number  	= $_REQUEST['invoice_number'];
	
	if($selectcom)
	{
		$select_company = " and cinv.com_id=".$selectcom;
	}
	else{$select_company = "";}
	
	
	
	if($invoice_number || $inv_num_from_other){
		
	$wh = "cinv.invoice_number = '".$invoice_number."'".$select_company;
	}
	/*else if($selectmonth && $selectyear){
		
	$wh = "DATE_FORMAT(cinv.add_date, '%Y-%m') = '".$selectyear."-".$selectmonth."'".$select_company;
	}
	else if($from_dt && $to_dt){
	$wh = "DATE_FORMAT(cinv.add_date, '%Y-%m-%d') BETWEEN '".$from_dt."' AND '".$to_dt."'".$select_company;
	}*/
	else if(!empty($selectcom) && empty($invoice_number)){
	$wh = "cinv.com_id=".$selectcom;
	}
	else
	{
		$wh = '';
	}
	 
	
}
	
	
?>
<script type="text/javascript" language="javascript" src="scripts/jquery.dataTables.js"></script>
        
           <script type="text/javascript" language="javascript" class="init">
<?php /*?>
$(document).ready(function() {
	var orderby = <?php //echo (!empty($m_orderby))?4:2;?>;
	
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
 
		 
			var d = row.data();
			$.ajax({url: "actions.php",data:{'case':d.v_id,'ePage':'invoice_list'}, success: function(result){
				//$("#div1").html(result);
				row.child(result).show();
				tr.addClass('shown');
			}});

		 
	} );
} );

<?php */?>


	</script>

	
	<div class="page-header">
        <div class="page-header-content">
            <div class="page-title2">
	            <h4><i class="icon-arrow-left52 position-left"></i> Invoice List</h4>
            </div>
        </div>
    </div>
	
	<div class="content">
	
	<?php include('include_pages/myaccount_sidebar.php');?>
	
         <div class="container-detached adv_rep">
		<div class="content-detached">             
        <div id="filters" class="panel panel-white">
                  	<div class="panel-heading">
                    	<h5 class="panel-title">Search Invoice</h5>
                    
                    </div>
                  
                  
          <div class="panel-body" >
            
						
            <div class="col-md-12 search_invoice">
              <form action="" class="table-form" id="searchforms"  method="post">
             
             <?php
			  if($LEVEL != 4)
			  {
				  ?>
              <div class="col-md-5">
                <div class="row">
                
                  <div class="form-group">
                   <label>Select Company:</label>
                  <?php
				 
				  $allusers= $db->select("company","*","1=1");
					
					 
				  ?>
                    <select id="selectcom" data-placeholder="Select Company" name="selectcom" class="select" onchange="document.getElementById('searchforms').submit();">
                    <option>Select Company</option>
                       
					 <?php
                     while($user2 = mysql_fetch_array($allusers))
					 {  
					 ?>
        <option value="<?=$user2['id']?>" <?php echo chk_or_sel($user2['id'],$_REQUEST['selectcom'],'selected'); ?> >
                     	<?=$user2['name']?>
                      </option>
                      <?php
					 }
					  ?>
                     </select>
                  </div>
                </div>
				</div>
              <?php $requestcomid = $_REQUEST['selectcom'];
			  }
			  else
			  {
				  ?><input type="hidden" name="selectcom" value="<?=$COMINF['id']?>" />
                   <?php
				   
				   $requestcomid = $COMINF['id'];
			  }
			  ?>
               
               
                <div class="col-md-5">
                <div class="row">
                  
                  <div class="form-group">
                   <label>Select Invoice # :</label>
                  <?php
				 
				 // $monthly_invoices= $db->select("client_invoices","invoice_number,add_date","com_id= $_REQUEST[selectcom] and invoice_number <> '' group by invoice_number");
					
/*$tabl = "client_invoices cinv INNER JOIN monthly_invoice moninv ON cinv.invoice_number=moninv.invoice_number";
			$cols = "cinv.invoice_number as cinvinvoice,moninv.add_date as moninvadd_date";
			 $monthly_invoices = $db->select($tabl,$cols,"cinv.com_id= $requestcomid and cinv.invoice_number <> '') group by cinv.invoice_number");	
*/			 
			 
			 
		$monthly_invoices =	 mysql_query("select cinv.invoice_number as cinvinvoice,moninv.add_date as moninvadd_date from  client_invoices cinv INNER JOIN monthly_invoice moninv ON cinv.invoice_number=moninv.invoice_number where(cinv.com_id= $requestcomid and cinv.invoice_number <> '') group by cinv.invoice_number");
			 
			// if(mysql_num_rows($monthly_invoices)){
			 
			 			  ?>
                    <select data-placeholder="Select Invoice" id="invoice_number" name="invoice_number" class="select" >
                       <option>Select Invoice</option>
					 <?php
                     while($monthly_invoice = mysql_fetch_array($monthly_invoices))
					 {  
					 ?>
                      <option value="<?=$monthly_invoice['cinvinvoice']?>" <?php echo chk_or_sel($monthly_invoice['cinvinvoice'],$_REQUEST['invoice_number'],'selected'); ?> >
                     	<?php echo $monthly_invoice['cinvinvoice']." (".date("F-Y",strtotime($monthly_invoice['moninvadd_date'])).")"; ?>
                      </option>
                      <?php
					 }
					  ?>
                     </select> 
                     
                      <?php
				//}  
				//else
				//{
				//	echo "No Invoice Found";
				//}
					  ?>
                  </div>
                </div>
				</div>
                
                
				<!--<div class="form-group">&nbsp;</div>-->
				<?php /*?><div class="form-group">
                <div class="row" id="date-range">
                  <div class="col-md-3">
                    <label>Select Date:</label>
                  </div>
                
                                        <label for="" class="col-lg-1 control-label">From:</label>
                                        <div class="col-lg-2">
                                            <input id="from_dt" type="text" name="from_dt" value="<?php echo $from_dt;?>" class="datetimepicker-month1 form-control" placeholder="Start Date" readonly='readonly'>
                                        </div>
                                    
                                    
                                        <label for="" class="col-lg-1 control-label">To:</label>
                                        <div class="col-lg-2">
                                            <input id="to_dt" type="text" name="to_dt" value="<?php echo $to_dt;?>" class="datetimepicker-month2 form-control" placeholder="End Date" readonly='readonly'>
                                        </div>
                                         
                </div>
              </div><?php */?>
              
              
              <div class="col-md-1">
                <div class="row" id="date-range">
                  <!--<div class="col-md-3">
                    <label>Select Month And Year:</label>
                  </div>
                
                                        <label for="" class="col-lg-1 control-label">Month:</label>
                                        <div class="col-lg-2">
                                            <select id="selectmonth" name="selectmonth" class="form-control" >
                                                <option value="">Select Month</option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                    
                                    
                                        <label for="" class="col-lg-1 control-label">Year:</label>
                                        <div class="col-lg-2">
                                            <select id="selectyear" name="selectyear" class="form-control" >
                                            	<option value="">Select Year</option>
                                            	<option value="2016">2016</option>
                                            	<option value="2015">2015</option>
                                            	<option value="2014">2014</option>
                                            	<option value="2013">2013</option>
                                            	<option value="2012">2012</option>
                                            	<option value="2011">2011</option>
                                            	<option value="2010">2010</option>
                                            	<option value="2009">2009</option>
                                            	<option value="2008">2008</option>
                                                <option value="2007">2007</option>
                                                <option value="2006">2006</option>
                                                <option value="2005">2005</option>
                                                <option value="2004">2004</option>
                                                <option value="2003">2003</option>
                                                <option value="2002">2002</option>
                                                <option value="2001">2001</option>
                                                <option value="2000">2000</option>                                          
                                            </select>
                                          
                                        </div>-->
                                        <div class="form-group"><button class="btn btn-success" type="submit" name="search_status"> <span>   Search  </span> </button></div>
                </div>
              </div>
              
              
              
            </form>
            
            </div>
             
             
               </div>
            </div>
            
            
        <div class="panel panel-white">
        <div>
        <div>
			<div class="panel-heading">    
            <h5 class="panel-title">Invoice Listing</h5>
            </div>
           <div class="panel panel-white">
                     
                        <div class="panel-body">
                        <div>
 		<table class="table datatable-basic dataTable no-footer" id="tableSortable">
        <thead>
            <tr><?php if($LEVEL != 4)
			{ ?>
                <th>Company Name</th>
                <?php } ?>
                <th>Candidate Name</th>
                <th>Invoice Number</th>
                <th>Credits</th>
                <th>Transaction Date</th>
               <!-- <th>View Invoice</th>-->
                
            </tr>
        </thead>
        <tbody>
    <?php	 
			//$users= $db->select("client_invoices","*","1=1"); //com_id=".$_SESSION['user_id']."
			
		if($LEVEL == 4 || isset($_REQUEST['selectcom'])){
		$com_id = (!empty($_REQUEST['selectcom']))?$_REQUEST['selectcom']:$COMINF['id'];
		$whereforclient = " and cinv.com_id=".$com_id."";	
		$uids = getUseridsLocation();
		if(!empty($uids)){
		$whrSubUser = " AND vdt.v_uadd IN (".implode(",",$uids).") ";	
		}
		}
		else
		{
		$whereforclient = "";
		}
		  
	
		 if($wh){$wherex = $wh.$whrSubUser;}else{$wherex = "DATE_FORMAT(cinv.add_date, '%Y-%m') = '".date("Y")."-".date("m")."'  $whereforclient $whrSubUser";}
		  //DATE_FORMAT(cinv.add_date, '%Y-%m') = '".$selectyear."-".$selectmonth."'".$select_company
		 
			$tabl = "client_invoices cinv INNER JOIN company co ON cinv.com_id=co.id INNER JOIN ver_data vdt ON cinv.v_id= vdt.v_id";
			$cols = "*";
			//echo "select * from $tabl where $wherex";
			 $selRoles = $db->select($tabl,$cols,"$wherex");
			//$selRoles = mysql_query("SELECT * FROM client_invoices cinv INNER JOIN company co ON cinv.com_id=co.id INNER JOIN ver_data vdt ON cinv.v_id= vdt.v_id $wherex");
		 //echo $wherex;
            if(mysql_num_rows($selRoles)>0){
            while($user = mysql_fetch_array($selRoles)){// print_r($user);?>
                <tr>
                <?php if($LEVEL != 4)
			{ ?>
                    <td><?php 
					/*$users2= $db->select("users","*","user_id=".$user['com_id']."");
					$user2 = mysql_fetch_array($users2);
					echo $user2['first_name']." ".$user2['last_name'];*/
					echo $user['name'];
					?>
                    
                    </td>
                    <?php } ?>
                    <td style="text-align:left"><a href="#"  data-toggle="modal" data-target=".bs-example-modal-lg_<?php echo $user['v_id']; ?>"><?php echo $user['v_name']; ?></a></td>
                    <td><?php 
                           /* $levelInf = $db->select("levels","*","level_id=$user[level_id]");
                            $levelInf = mysql_fetch_array($levelInf);*/
                             
							 if($user['invoice_number'])
							 {
							 echo '<a href="?action=calcinv&atype=view&invoicenum='.$user['invoice_number'].'" target="_blank">'.$user['invoice_number'].'</a>';
							 }
							 else
							 {echo '--';}
                        
						?>    
                    </td>
                    <td><?=$user['cost']?></td>
                     <td><?=$user['add_date']?></td>
                     <?php /*?><td>
					 <?php
                     if($user['invoice_number'])
					 {
						 ?>
                         <a href="?action=calcinv&atype=view&cid=<?=$user['com_id']?>" target="_blank">View</a>
                         <?php
					 }
					 else{echo "-";}
					 ?>
                     </td><?php */?>
                             
<div class="modal fade bs-example-modal-lg_<?php echo $user['v_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
   
 
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Checks Detail</h4>
      </div>
      <div class="modal-body">
      <?php
		$tabl2 = "ver_checks vcheck INNER JOIN checks chks ON vcheck.checks_id=chks.checks_id";

		$cols2 = "as_cost2,checks_title";
		$selRoles2 = $db->select($tabl2,$cols2,"v_id = ".$user['v_id']."");
		echo '<ul class="checksdetailpop">';
		while($res2 = mysql_fetch_array($selRoles2))
		{
			?>
                 
                <li><?=$res2['checks_title']?></li> 
                <li><?=$res2['as_cost2']?></li> 
                 
 			<?php
		}
		echo "</ul>";
	 ?>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Hide</button>
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
    
   
   
   
</div>




                </tr>	    
        <?php }} ?>
        </tbody>
    </table>
    	</div>
        </div>
        </div>
    	</div>
        </div>
        </div>
               
            </div>
            </div>
            </div>
              
	
	
       <!-- Large modal -->
 
<!-- Small modal -->
          
        
      

        <!-- Page-specific scripts: -->
        <!--<script src="scripts/proton/graphsStats.js"></script>-->
        <!-- Page-specific scripts: -->
        
		<script src="js/rate.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
											  
	  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script type="text/javascript">
		
		<?php /*?><?php
			$from_dt  		= $_REQUEST['from_dt'];
	$to_dt  		= $_REQUEST['to_dt'];
	$selectcom  	= $_REQUEST['selectcom'];
	$selectmonth  	= $_REQUEST['selectmonth'];
	$selectyear  	= $_REQUEST['selectyear'];

		if(!empty($selectmonth) && !empty($selectyear))
		{
		?>
		$("#selectmonth").val("<?=$selectmonth?>");
		$("#selectyear").val("<?=$selectyear?>");

		$("#to_dt").val("");
		$("#from_dt").val("");
		<?php
		}
		else
		{
		?>
		$("#selectmonth").val("");
		$("#selectyear").val("");

		$("#from_dt").val("<?=$from_dt?>");
		$("#to_dt").val("<?=$to_dt?>");
		<?php
			
		}
		?><?php */?>
 

		$(function () {
		$( ".datetimepicker-month1, .datetimepicker-month2").datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1980:2015"
		});
		});
 		
		</script>
