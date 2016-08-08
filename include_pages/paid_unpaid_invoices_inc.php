<section class="retracted scrollable">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
      <div class="page-section-title">
              <h2 class="box_head">Paid Unpaid Invoices List</h2>
            </div>
        <div id="filters" class="section" >
          <div class="list-group-item" >
                       
             <div style="clear:both; margin-bottom:30px;"></div>
 
			   
			          <div class="box grid_16">
	    <div class="list-group-item">
        
                        <div class="toggle_container"> 
              <div class="block">
             <div id="dt2">  

   <table class="table table-bordered table-striped dataTable" id="tableSortable" aria-describedby="tableSortable_info">
        <thead>
            <tr class="full">
              <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="tableSortable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Title: activate to sort column descending" style="width: 25%;">Client</th>
		
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="tableSortable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Title: activate to sort column descending" style="width: 20%;">Invoice Number</th>
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="tableSortable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Title: activate to sort column descending" style="width: 20%;">Invoiced Date</th>
				
				
				<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="tableSortable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Title: activate to sort column descending" style="width: 20%;">Due Date</th>
				<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="tableSortable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Title: activate to sort column descending" style="width: 10%;">Amount</th>
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="tableSortable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Title: activate to sort column descending" style="width: 5%;">Paid/Unpaid</th>
                 
            </tr>
        </thead>
        <tbody>
     <?php 
							
							// DATE_FORMAT($cols_date, '%Y-%m-%d')
							
							
							$selInvoice = $db->select("ver_checks","DISTINCT(invoice_number)"," invoice_number <> '' AND invoiced=1 ORDER BY invoiced_date DESC ");
							
                            if(mysql_num_rows($selInvoice)>0){
								$index = 0;
                                while($re = mysql_fetch_array($selInvoice)) {
							
							$cols = " is_tax,tax,SUM(check_cost) AS total_amount, co.name as com_name, co.disabled_id as com_status, co.id as com_id, co.pymterm, invoiced_date,invoice_number, vc.paid as paid_unpaid";
							$tbls = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id INNER JOIN company co ON vd.com_id=co.id";
							$whre = " invoice_number='".$re['invoice_number']."' ";
							$sel = $db->select($tbls,$cols,"$whre");
							$rs = mysql_fetch_assoc($sel);
							$invoiced_date = date("Y-M-d",strtotime($rs['invoiced_date']));
							preg_match('/(\d+)/', $rs['pymterm'], $m);
							$pymterm = ($m[1]!="")?(int)$m[1]:30;
							
							$dueDate = date("Y-M-d",strtotime($rs['invoiced_date'] . "+$pymterm day"));
							$expDay = strtotime($dueDate)-strtotime(date("Y-M-d"));
							if($rs['paid_unpaid']==1){
							//$cls = "class='green_cheks' style='background-color:#92c83e;' title='Paid'";
							$cls = '<td class="green_cheks"style="background-color:#92c83e;" ><a class="ctooltips" href="javascript:void(0);" style="color:#fff;">'. $dueDate.'<span>Paid</span></a></td> ';							
							}else{
								if($expDay<0){
									$cls = '<td class="red_cheks"style="background-color:#FF0000;" ><a class="ctooltips" href="javascript:void(0);" style="color:#fff;">'. $dueDate.'<span>Due Unpaid</span></a></td> ';
									
								//$cls = "class='red_cheks' style='background-color:#FF0000;' title='Due Unpaid'";
								}else{
									
									$cls = '<td class="orange_cheks"style="background-color:#ffae00;" ><a class="ctooltips" href="javascript:void(0);" style="color:#fff;">'. $dueDate.'<span>Unpaid</span></a></td> ';
								//$cls = "class='orange_cheks' style='background-color:#ffae00;' title='Unpaid'";	
								}
							}
							
						    if($rs['com_status']==0) $com_status=1; else  $com_status=0; ?>
                            <tr>
							
							
							
							
							
							
							
							
							
                             
							<td  ><?php echo $rs['com_name']; /* <span style="float: right;"> <a href="javascript:void(0)" onclick="updateClientStatus(<?php echo $rs['com_id'];?>,<?php echo $com_status;?>,'com<?php echo $index;?>');" class="com<?php echo $index;?>"><i  class="icon-ban-circle"  <?php if($rs['com_status']==0){ echo ' style="color:green;font-size:18px;" title="Enabled"'; }else{ echo ' style="color:#ff0000;font-size:18px;" title="Disabled" ';}?>></i></a> <span class="error_com<?php echo $index;?>"></span></span> */ ?> <span style="float: right;"><i  class="icon-blocked"  <?php if($rs['com_status']==0){ echo ' style="color:green;font-size:18px;" title="Enabled"'; }else{ echo ' style="color:#ff0000;font-size:18px;" title="Disabled" ';}?>></i></span></td>
							
							<td><strong><a href="?action=invoicedchecks&atype=checks&inv=<?php echo $rs['invoice_number'];?>" ><?php echo $rs['invoice_number'];?></a></strong></td>
							
							
                            <td><?php echo $invoiced_date;?></td>
						<?php echo $cls;?>
							
							
							<td><?php 
							$total = $rs['total_amount'];
							  if($rs['is_tax']==1){
								   $Tax  = $rs['tax'];
								   $netTax = 100-$Tax;
									$netTax =  $total / $netTax;
									$taxAmount = $Tax * $netTax;
								   //$taxAmount = $Tax * $total / 100;
								    $tax = "Tax ".round($taxAmount,2)."  ( ".$Tax." % ) <br />";
								   $subTotal = $taxAmount+$total;
							   }else{
								   
								   $tax = "";
								    $subTotal = $total;
							 }
							
							echo  round($subTotal,2);?></td>
							
							
							
							
							
							
							<td align="center" >
							<?php if($rs['paid_unpaid']==0) $paid=1; else  $paid=0; ?>
							
							<a href="javascript:void(0);" class="ctooltips" onclick="updatePaid('<?php echo $rs['invoice_number'];?>','<?php echo $rs['com_id'];?>','<?php echo $paid;?>','div_id<?php echo $index;?>')" class="div_id<?php echo $index;?>">
							
							<i <?php if($rs['paid_unpaid']==1){ echo 'class="icon-checkmark3" style="color:green;font-size:18px;" title=""'; }else{ echo 'class="icon-cross3" style="color:#ff0000;font-size:18px;" title="" ';}?>></i><span class="error_div_id<?php echo $index;?>">
							
							
							
							
							
							
							<?php if($rs['paid_unpaid']==1){ echo 'Paid'; }else{ echo 'Un-Paid';}?>
							
							
							
							
							
							
							
							</span></a></td>
							
							
							
							 
							</tr>
                          
                            <?php 
									$index = $index+1;
								} }else{ ?>
                            <tr>
                              <td colspan="9" align="center"><strong>No Record Found</strong></td>
                            </tr>
                            <?php } ?>
        </tbody>
    </table>
    <div class="clear"></div>
    </div>
    </div>
</div>
</div>
</div>


              </div>
            </div>
          </div>
        </div>
      </div>
  <div class="clear"></div>
  

  
</section>

<script type="text/javascript">
function updatePaid(inv_id,com_id,paid,div_cl){
    
       
     if(confirm("Are you sure want to update the status of invoice ?")){
	
	$("."+div_cl).html('<img align="center" src="images/spinners/3.gif" />');
	
	   
    $.ajax({
	url: "actions.php",
	data:'ePage=add_rating&inv_id='+inv_id+'&com_id='+com_id+'&paid='+paid+'&upd=1',
	type: "POST",
	success: function(res){
		if(res!='Updated'){
			 $(".error_"+div_cl).html(' <span  style="color:#ff0000;font-size:11px;padding-left:5px;" >'+res+'</span>');
			 if(paid==1){
		    $("."+div_cl).html('<i class="icon-check-minus" style="color:#ff0000;font-size:18px;" title="Un-Paid"></i>');
		  
	   }else{
		   $("."+div_cl).html('<i class="icon-check-sign" style="color:green;font-size:18px;" title="Paid"></i>');
		  
	   }
			 return false;
		}
		if(paid==1){
		   $("."+div_cl).html('<i class="icon-check-sign" style="color:green;font-size:18px;" title="Paid"></i>');
		  
	   }else{
		   $("."+div_cl).html('<i class="icon-check-minus" style="color:#ff0000;font-size:18px;" title="Un-Paid"></i>');
	   }
	   if(res=='Updated'){
	   setTimeout(function() {
		window.location.href = "?action=paid_unpaid&atype=invoices";
		}, 500);
	   }
   
	},
	error: function(){
    alert('failure');
	}
	
	
	});

	 }

   
        
}

function updateClientStatus(com_id,com_stauts,div_cl){
    
       
    if(confirm("Are you sure want to update the status of client ?")){
	
	$("."+div_cl).html('<img align="center" src="images/spinners/3.gif" />');
	
	   
    $.ajax({
	url: "actions.php",
	data:'ePage=add_rating&com_id='+com_id+'&com_stauts='+com_stauts+'&comupd=1',
	type: "POST",
	success: function(res){
		if(res!='Updated'){
			 $(".error_"+div_cl).html(' <span  style="color:#ff0000;font-size:11px;padding-left:5px;" >'+res+'</span>');
			 if(com_stauts==0){
		    $("."+div_cl).html('<i class="icon-ban-circle" style="color:#ff0000;font-size:18px;" title="Disabled"></i>');
		  
	   }else{
		   $("."+div_cl).html('<i class="icon-ban-circle" style="color:green;font-size:18px;" title="Enabled"></i>');
		  
	   }
			 return false;
		}
		if(com_stauts==0){
		   $("."+div_cl).html('<i class="icon-ban-circle" style="color:green;font-size:18px;" title="Enabled"></i>');
		  
	   }else{
		   $("."+div_cl).html('<i class="icon-ban-circle" style="color:#ff0000;font-size:18px;" title="Disabled"></i>');
	   }
	   if(res=='Updated'){
	   setTimeout(function() {
		window.location.href = "?action=paid_unpaid&atype=invoices";
		}, 500);
	   }
   
	},
	error: function(){
    alert('failure');
	}
	
	
	});

}

   
        
}
</script>											
												




